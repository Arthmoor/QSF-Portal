<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2025 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * https://github.com/Arthmoor/Quicksilver-Forums
 *
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 * https://github.com/markelliot/MercuryBoard
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

if( !defined( 'QUICKSILVERFORUMS' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

class bbcode
{
   private $site;
   private $censor;
   private $emojis;
   private $lang;

	public function __construct( &$module )
	{
		$this->site = &$module->site;
		$this->censor = &$module->censor;
		$this->emojis = &$module->emojis;
		$this->lang = &$module->lang;
	}

	public function get_bbcode_menu()
	{
		$bbcode_menu = file_get_contents( './lib/bbcode_menu.txt' );

		if( $bbcode_menu === false )
			return '';

		return $bbcode_menu;
	}

	public function generate_emoji_links()
	{
		$links = '';

		foreach( $this->emojis['click_replacement'] as $key => $value )
			$links .= "<button type=\"button\" class=\"clickable_emoji\" name=\"{$key}\">{$value}</button>";

		return $links;
	}

	public function format( $in, $options = FORMAT_BBCODE )
	{
		$strtr = array();

		if( $options & FORMAT_CENSOR ) {
			$in = $this->process_censors( $in );
		}

		if( !( $options & FORMAT_HTMLCHARS ) ) {
			$in = htmlentities( $in, ENT_COMPAT, 'UTF-8' );
		}

		if( $options & FORMAT_BBCODE ) {
			$in = $this->pre_parse_links( $in );
			$in = $this->bbcode_parse( $in );
		}

		// Yes, this looks silly, but trust me.
		if( !( $options & FORMAT_HTMLCHARS ) || ( ( $options & FORMAT_HTMLCHARS ) && ( $options & FORMAT_BREAKS ) ) )
			$strtr["\n"] = "<br>\n";

		// Don't format emojis!
		if( $options & FORMAT_EMOJIS ) {
			if( isset( $this->emojis['click_replacement'] ) )
				$strtr = array_merge( $strtr, $this->emojis['click_replacement'] );
			if( isset( $this->emojis['replacement'] ) )
				$strtr = array_merge( $strtr, $this->emojis['replacement'] );
		}

		$in = strtr( $in, $strtr );

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
	private function process_censors( $in )
	{
		if( $this->censor ) {
			$in = preg_replace( $this->censor, '####', $in );
		}
		return $in;
	}

	private function bbcode_parse_code_callback( $matches = array() )
	{
		$text = $this->format_code( $matches[1], false, false );

		return $text;
	}

	private function bbcode_parse_codebox_callback( $matches = array() )
	{
		$text = $this->format_code( $matches[1], false, true );

		return $text;
	}

	private function bbcode_parse_php_callback( $matches = array() )
	{
		$text = $this->format_code( $matches[1], true, false );

		return $text;
	}

	private function bbcode_parse( $in )
	{
		$search = array(
			'/\\[spoiler\\](.*)\\[\\/spoiler\\]/isU',
			'/\\[b\\](.*)\\[\\/b\\]/isU',
			'/\\[i\\](.*)\\[\\/i\\]/isU',
			'/\\[u\\](.*)\\[\\/u\\]/isU',
			'/\\[s\\](.*)\\[\\/s\\]/isU',
			'/\\[pre\\](.*?)\\[\\/pre\\]/isU',
			'/\\[img\\](.*)\\[\\/img\\]/isU',
			'/\\[img=(.*)\\](.*)\\[\\/img\\]/iU',
			'/\\[email=(.*)\\](.*)\\[\\/email\\]/iU',
			'/\\[size=([1-9])\\](.*)\\[\\/size\\]/isU',
			'/\\[font=(.*)\\](.*)\\[\\/font\\]/isU',
			'/\\[color=(.*)\\](.*)\\[\\/color\\]/isU',
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
			'/\\[li\\](.*)\\[\\/li\\]/isU',
			'/\\[p\\](.*)\\[\\/p]/isU',
			'/\\[br\\]/isU',
			'/\\[tm\\]/isU',
			'/\\[c\\]/isU',
			 );
		$replace = array(
			'<details><summary><strong>' . $this->lang->spoiler . ':</strong></summary><br>$1</details>',
			'<strong>$1</strong>',
			'<em>$1</em>',
			'<span style="text-decoration:underline">$1</span>',
			'<s>$1</s>',
			'<pre>$1</pre>',
			'<img src="$1" alt="">',
			'<img src="$1" alt="$2">',
			'<a href="mailto:$1">$2</a>',
			'<span style="font-size:$1ex">$2</span>',
			'<span style="font-family:$1">$2</span>',
			'<span style="color:$1">$2</span>',
			'<h1>$1</h1>', '<h2>$1</h2>', '<h3>$1</h3>', '<h4>$1</h4>', '<h5>$1</h5>', '<h6>$1</h6>',
			'<div style="text-align:right">$1</div>',
			'<div style="text-align:center">$1</div>',
			'<sup>$1</sup>',
			'<sub>$1</sub>',
			'<li>$1</li>',
			'<p>$1</p>',
			'<br>',
			'&trade;',
			'&copy;',
			 );

			// '/\\[topic=([:digit:])\\](.*)\\[/topic\\]/ise',
			// '$this->process_topic(\'$1\', \'$2\')',

		// This, this right here, all because some yahoo in charge of PHP decision making decided something was wrong with the old ways.
		// If this looks really stupid to you, it's because it *IS* really stupid.
		$in = preg_replace_callback( '/\\[ul\\](.*)\\[\\/ul\\]/isU', function($x) { return $this->process_ul_tag($x); }, $in );
		$in = preg_replace_callback( '/\\[ol\\](.*)\\[\\/ol\\]/isU', function($x) { return $this->process_ol_tag($x); }, $in );
		$in = preg_replace_callback( '/\\[code\\](.*?)\\[\\/code\\]/is', function($x) { return $this->bbcode_parse_code_callback($x); }, $in );
		$in = preg_replace_callback( '/\\[codebox\\](.*?)\\[\\/codebox\\]/is', function($x) { return $this->bbcode_parse_codebox_callback($x); }, $in );
		$in = preg_replace_callback( '/\\[php\\](.*?)\\[\\/php\\]/is', function($x) { return $this->bbcode_parse_php_callback($x); }, $in );
		$in = preg_replace_callback( '/\\[url=(.*)\\](.*)\\[\\/url\\]/iU', function($x) { return $this->process_url($x); }, $in );
		$in = preg_replace_callback( '/\\[youtube\\](.*?)\\[\\/youtube\\]/is', function($x) { return $this->process_youtube($x); }, $in );

		// This is what was always perfectly fine before, yet still seems fine for everything but the precious 'e' tag deprecation.
		$in = preg_replace( $search, $replace, $in );
		return $this->parse_quotes( $in );
	}

	private function pre_parse_links( $in )
	{
		$parse = array(
			'matches' => array('~(^|\s)([a-z0-9-_.]+@[a-z0-9-.]+\.[a-z0-9-_.]+)~i',
				'~(^|\s)(http|https|ftp)://(\w+[^\s\[\]]+)~is'),
			'replacements' => array('\\1[email=\\2]\\2[/email]',
				'\\1[url=\\2://\\3]\\2://\\3[/url]')
		);

		return preg_replace( $parse['matches'], $parse['replacements'], $in );
	}

	private function parse_quotes( $in )
	{
		$old = $in;

		$search = array();
		$replace = array();

		$search[] = '~\[quote=(.+?)]~i';
		$search[] = '~\[quote]~i';

		$replace[] = '<blockquote><span class="quote">$1 said:</span><br><br><span class="left-quote"></span>';
		$replace[] = '<blockquote><span class="left-quote"></span>';

		$startCount = preg_match_all( $search[0], $in, $matches );
		$startCount += preg_match_all( $search[1], $in, $matches );
		$in = preg_replace( $search, $replace, $in );

		$search = '~\[/quote]~i';
		$replace = '<span class="right-quote"></span></blockquote>';

		$endCount = preg_match_all( $search, $in, $matches );
		$in = preg_replace( $search, $replace, $in );

		if( $startCount != $endCount ) {
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
		if( $php ) {
			$input = html_entity_decode( $input, ENT_COMPAT, 'UTF-8' ); // contents is html so undo it

			if( strpos( $input, '<?' ) === false ) {
				$input  = '<?php ' . $input . '?>';
				$tagged = true;
			}

			ob_start();

			@highlight_string( $input );
			$input = ob_get_contents();

			ob_end_clean();

			// Trim pointless space
			$input = preg_replace( '/^<code><span style="color: #000000">\s(.+)\s<\/span>\s<\/code>$/', '<span style="color: #000000">$1</span>', $input );
		} else {
         $input = htmlentities( $input, ENT_COMPAT, 'UTF-8' ); // Regular text, process it as would be done otherwise.
      }

		if( isset( $tagged ) ) {
			$input = str_replace( array( '&lt;?php&nbsp;', '?&gt;' ), '', $input );
		}

		if( $php ) {
			$lines = explode( '<br>', $input );
		} else {
			$lines = explode( "\n", $input );
		}
		$count = count( $lines );

		$col1 = '';
		$col2 = '';

		for( $i = 0; $i < $count; $i++ )
		{
			$col1 .= $start . "\n";
			$col2 .= $lines[$i];
			$start++;
		}

		$codehtml = $this->get_code_html( $largebox );

		$return = '';
		if( $php ) {
			$return = $codehtml['start_php'];
		} else {
			$return = $codehtml['start_code'];
		}
		$return .= $col2;
		$return .= $codehtml['end'];

		return $return;
	}

	private function process_url( $matches = array() )
	{
		$url = $matches[1];
		$text = $matches[2];

		// No HTTP attached? Add it.
		$pos = strpos( $url, 'http://' );
		if( $pos === FALSE ) {
			$pos = strpos( $url, 'https://' );
			if( $pos === FALSE ) {
				$url = 'https://' . $url;
			}
		}

		// Check for a query string.
		if( !empty( $_SERVER['QUERY_STRING'] ) ) {
			$queryString = '?' . $_SERVER['QUERY_STRING'];
		} else {
			$queryString = null;
		}

		// Find the forum's URL base (host without www/directory forum is in)
		if( isset( $_SERVER['HTTP_HOST'] ) && !empty( $_SERVER['HTTP_HOST'] ) ){ 
			$forumURLBase = str_replace( 'www.', '', $_SERVER['HTTP_HOST'] ) . dirname( $_SERVER['SCRIPT_NAME'] );

			// Check if the URL is external.
			if( ( strpos( $url, $forumURLBase ) === false ) ) {
				return "<a href=\"{$url}\" target=\"_blank\">{$text}</a>";
			} else {
				return "<a href=\"{$url}\">{$text}</a>";
			}
		}

		return '<a href="' . $url . '">' . $text . '</a>';
	}

	private function process_ul_tag( $matches = array() )
	{
		$in = $matches[0];

		$strtr["\n"] = null;

		$in = strtr( $in, $strtr );

		$in = str_replace( '[ul]', '<ul>', $in );
		$in = str_replace( '[/ul]', '</ul>', $in );

		return $in;
	}

	private function process_ol_tag( $matches = array() )
	{
		$in = $matches[0];

		$strtr["\n"] = null;

		$in = strtr( $in, $strtr );

		$in = str_replace( '[ol]', '<ol>', $in );
		$in = str_replace( '[/ol]', '</ol>', $in );

		return $in;
	}

	private function process_youtube( $matches = array() )
	{
		$in = $matches[1];

		if( preg_match( '/v=([^&]+)/', $in, $newmatches ) > 0 ) {
			$src = $newmatches[1];

			return '<iframe class="youtube-player" width="640" height="400" src="https://www.youtube.com/embed/'.$src.'"></iframe>';
		}

		if( preg_match( '/youtu.be\/([^&]+)/', $in, $newmatches ) > 0 ) {
			$src = $newmatches[1];

			return '<iframe class="youtube-player" width="640" height="400" src="https://www.youtube.com/embed/'.$src.'"></iframe>';
		}

		return $in;
	}

	private function process_topic( $topic, $in )
	{
		return "<a href='{$this->site}/topic/{$topic['topic_title']}-{$topic['topic_id']}/'>{$in}</a>";
	}
}
?>