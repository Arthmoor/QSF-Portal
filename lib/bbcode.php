<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2010 The QSF Portal Development Team
 * http://www.qsfportal.com/
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2008 The Quicksilver Forums Development Team
 * http://www.quicksilverforums.com/
 * 
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 * http://www.mercuryboard.com/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 **/

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

class bbcode
{
	public function __construct(&$module)
	{
		$this->settings = &$module->settings; // <---- When you figure out why this works, you let me know. -- Samson
		$this->skin = &$module->skin;
		$this->db = &$module->db;
		$this->censor = &$module->censor;
	}

	public function get_bbcode_menu()
	{
		$bbcode_menu = file_get_contents( './lib/bbcode_menu.txt' );

		if( $bbcode_menu === false )
			return '';
		return $bbcode_menu;
	}

	public function generate_emote_links()
	{
		include( './skins/' . $this->skin . '/emoticons.php' );

		$links = '';
		foreach( $this->emotes['click_replacement'] as $key => $value )
			$links .= '<a href="#" onclick="return insertSmiley(\'' . $key . '\', textarea)">' . $value . '</a>';

		return $links;
	}

	public function format( $in, $options = FORMAT_MBCODE )
	{
		$strtr = array();

		if ($options & FORMAT_CENSOR) {
			$in = $this->process_censors($in);
		}

		if( ($options & FORMAT_HTMLCHARS) ) {
			$in = htmlentities($in, ENT_COMPAT, 'UTF-8');
		}

		if( ($options & FORMAT_MBCODE) ) {
			$in = $this->pre_parse_links( $in );
			$in = $this->bbcode_parse( $in );
		}

		// Yes, this looks silly, but trust me.
		if ( !( $options & FORMAT_HTMLCHARS ) || ( ($options & FORMAT_HTMLCHARS) && ($options & FORMAT_BREAKS) ) )
			$strtr["\n"] = "<br />\n";

		// Don't format emoticons!
		if( $options & FORMAT_EMOTICONS ) {
			include( './skins/' . $this->skin . '/emoticons.php' );
			$strtr = array_merge($strtr, $this->emotes['click_replacement']);
			$strtr = array_merge($strtr, $this->emotes['replacement']);
		}

		$in = strtr($in, $strtr);

		$in = str_replace( '[tm]', '&reg;', $in );
		$in = str_replace( '[c]', '&copy;', $in );

		return $in;
	}

	/**
	 * Handle formatting out censored words
	 *
	 * PROTECTED
	 *
	 * @param string $in Unformatted input
	 * @return string result with censored words replaced
	 **/
	private function process_censors($in)
	{
		if ($this->censor) {
			$in = preg_replace($this->censor, '####', $in);
		}
		return $in;
	}

	private function bbcode_parse( $in )
	{
		$search = array(
			'/\\[code\\](.*?)\\[\\/code\\]/ise',
			'/\\[codebox\\](.*?)\\[\\/codebox\\]/ise',
			'/\\[php\\](.*?)\\[\\/php\\]/ise',
			'/\\[spoiler\\](.*)\\[\\/spoiler\\]/is',
			'/\\[b\\](.*)\\[\\/b\\]/isU',
			'/\\[i\\](.*)\\[\\/i\\]/isU',
			'/\\[u\\](.*)\\[\\/u\\]/isU',
			'/\\[s\\](.*)\\[\\/s\\]/isU',
			'/\\[pre\\](.*?)\\[\\/pre\\]/isU',
			'/\\[url=(.*)\\](.*)\\[\\/url\\]/ieU',
			'/\\[img\\](.*)\\[\\/img\\]/isU',
			'/\\[img=(.*)\\](.*)\\[\\/img\\]/iU',
			'/\\[email=(.*)\\](.*)\\[\\/email\\]/iU',
			'/\\[font=(.*)\\](.*)\\[\\/font]/isU',
			'/\\[color=(.*)\\](.*)\\[\\/color\\]/isU',
			'/\\[size=(.*)\\](.*)\\[\\/size]/ise',
			'/\\[h1\\](.*)\\[\\/h1]/isU',
			'/\\[h2\\](.*)\\[\\/h2]/isU',
			'/\\[h3\\](.*)\\[\\/h3]/isU',
			'/\\[h4\\](.*)\\[\\/h4]/isU',
			'/\\[h5\\](.*)\\[\\/h5]/isU',
			'/\\[h6\\](.*)\\[\\/h6]/isU',
			'/\\[right\\](.*)\\[\\/right\\]/isU',
			'/\\[center\\](.*)\\[\\/center\\]/isU',
			'/\\[sup\\](.*)\\[\\/sup\\]/isU',
			'/\\[sub\\](.*)\\[\\/sub\\]/isU',
			'/\\[ul\\](.*)\\[\\/ul\\]/isU',
			'/\\[li\\](.*)\\[\\/li\\]/isU',
			'/\\[p\\](.*)\\[\\/p]/isU',
			'/\\[br\\]/isU',
			'/\\[youtube\\](.*?)\\[\\/youtube\\]/ise'
			 );
		$replace = array(
			'$this->format_code(\'$1\', false, false)',
			'$this->format_code(\'$1\', false, true)',
			'$this->format_code(\'$1\', true, false)',
			'<div class="spoilerbox"><strong>Spoiler:</strong><div class="spoiler">$1</div></div>',
			'<strong>$1</strong>',
			'<em>$1</em>',
			'<span style="text-decoration:underline">$1</span>',
			'<s>$1</s>',
			'<pre>$1</pre>',
			'$this->process_url(\'$1\', \'$2\')',
			'<img src="$1" alt="" />',
			'<img src="$1" alt="$2" />',
			'<a href="mailto:$1">$2</a>',
			'<span style="font-family:$1">$2</span>',
			'<span style="color:$1">$2</span>',
			'$this->process_size(\'$1\', \'$2\')',
			'<h1>$1</h1>', '<h2>$1</h2>', '<h3>$1</h3>', '<h4>$1</h4>', '<h5>$1</h5>', '<h6>$1</h6>',
			'<div style="text-align:right">$1</div>',
			'<div style="text-align:center">$1</div>',
			'<sup>$1</sup>',
			'<sub>$1</sub>',
			'<ul>$1</ul>',
			'<li>$1</li>',
			'<p>$1</p>',
			'<br />',
			'$this->process_youtube(\'$1\')'
			 );
		$in = preg_replace( $search, $replace, $in );
		return $this->parse_quotes( $in );
	}

	private function pre_parse_links( $in )
	{
		$parse = array(
			'matches' => array('~(^|\s)([a-z0-9-_.]+@[a-z0-9-.]+\.[a-z0-9-_.]+)~i',
				'~(^|\s)(http|https|ftp)://(\w+[^\s\[\]]+)~ise'),
			'replacements' => array('\\1[email=\\2]\\2[/email]',
				'\'\\1[url=\\2://\\3]\\2://\\3[/url]\'')
		);

		return preg_replace($parse['matches'], $parse['replacements'], $in);
	}

	private function parse_quotes( $in )
	{
		$old = $in;

		$search = array();
		$replace = array();

		$search[] = '~\[quote=(.+?)]~i';
		$search[] = '~\[quote]~i';

		$replace[] = '<div class="quote"><span class="quote">$1 said:</span><br /><br /><span class="left-quote"></span>';
		$replace[] = '<div class="quote"><span class="left-quote"></span>';

		$startCount = preg_match_all($search[0], $in, $matches);
		$startCount += preg_match_all($search[1], $in, $matches);
		$in = preg_replace($search, $replace, $in);

		$search = '~\[/quote]~i';
		$replace = '<span class="right-quote"></span></div>';

		$endCount = preg_match_all( $search, $in, $matches);
		$in = preg_replace($search, $replace, $in);
		
		if ($startCount != $endCount) {
			return $old;
		}
		return $in;
	}

	private function get_code_html( $largebox )
	{
		$code_html = array();
		$code_html['start_php'] = '<pre class="phpcode">';

		if( $largebox )
			$code_html['start_code'] = '<pre class="codebox">';
		else
			$code_html['start_code'] = '<pre class="code">';
		$code_html['end'] = '</pre>';
		return $code_html;
	}

	/**
	 * Formats code with line numbers and optionally syntax highlighting
	 *
	 * PRIVATE
	 *
	 * @param string $input Code to be formatted
	 * @param bool $php True to format as PHP
	 * @param int $start Starting line to count from
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string PHP-highlighted string
	 **/
	private function format_code( $input, $php, $largebox = false, $start = 1 )
	{
		if ($php) {
			$input = html_entity_decode($input, ENT_COMPAT, 'UTF-8'); // contents is html so undo it

			if (strpos($input, '<?') === false) {
				$input  = '<?php ' . $input . '?>';
				$tagged = true;
			}

			ob_start();

			@highlight_string($input);
			$input = ob_get_contents();

			ob_end_clean();

			// Trim pointless space
			$input = preg_replace('/^<code><span style="color: #000000">\s(.+)\s<\/span>\s<\/code>$/', '<span style="color: #000000">$1</span>', $input);
		}

		if (isset($tagged)) {
			$input = str_replace(array('&lt;?php&nbsp;', '?&gt;'), '', $input);
		}
		
		if ($php) {
			$lines = explode('<br />', $input);
		} else {
			$lines = explode("\n", $input);
		}
		$count = count($lines);

		$col1 = '';
		$col2 = '';

		for ($i = 0; $i < $count; $i++)
		{
			$col1 .= $start . "\n";
			$col2 .= $lines[$i];
			$start++;
		}
		
		$codehtml = $this->get_code_html($largebox);

		$return = '';
		if ($php) {
			$return = $codehtml['start_php'];
		} else {
			$return = $codehtml['start_code'];
		}
		$return .= $col2;
		$return .= $codehtml['end'];

		return $return;
	}

	private function process_url( $url, $text )
	{
		// Check for a query string.
		if ( !empty( $_SERVER['QUERY_STRING'] ) ) {
			$queryString = '?' . $_SERVER['QUERY_STRING'];
		} else {
			$queryString = null;
		}

		// Find the forum's URL base (host without www/directory forum is in)
		if( isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST']) ){ 
			$forumURLBase = str_replace( 'www.', null, $_SERVER['HTTP_HOST'] ) . dirname( $_SERVER['SCRIPT_NAME'] );

			// Check if the URL is external.
			if ( ( strpos( $url, $forumURLBase ) === false ) ) {
				return '<a href="' . $url . '" onclick="window.open(this.href, \'_blank\'); return false;">' . $text . '</a>';
			} else {
				return '<a href="' . $url . '">' . $text . '</a>';
			}
		}
		return '<a href="' . $url . '">' . $text . '</a>';
	}

	private function process_youtube($in)
	{
		$in = str_replace( 'watch?v=', 'v/', $in );
		return '<object type="application/x-shockwave-flash" width="640" height="400" data="'.$in.'"><param name="movie" value="'.$in.'" /><param name="allowscriptaccess" value="always" /><param name="wmode" value="transparent" /></object>';
	}

	private function process_size($size, $in)
	{
		$value = $size;
		if( intval($value) > 10 )
			$value = "10";
		return '<span style="font-size:' . $value . 'ex">' . $in . '</span>';
	}
}