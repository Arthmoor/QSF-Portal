<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005 The Quicksilver Forums Development Team
 *  http://www.quicksilverforums.com/
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

require_once $set['include_path'] . '/lib/htmltools.php';

/**
 * BB Code formatter
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @since 1.2
 **/
class bbcode extends htmltools
{
	var $user_view_emoticons = true;
	
	var $max_url_length = 60; // Maximum length of a url before applying trimming
	
	/**
	 * Constructor
	 *
	 * @param object $qsf Main action object
	 **/
	function bbcode(&$qsf)
	{
		parent::htmltools($qsf);
		
		$this->user_view_emoticons = $qsf->user['user_view_emoticons'];
	}
	
	/**
	 * Formats a string
	 *
	 * @param string $in Input
	 * @param int $options Options
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 3.0
	 * @return string Formatted string
	 **/
	function format($in, $options = 0)
	{
		$maxwordsize = 40; // Maximum size a word can get before it's cut into a abbr tag
		
		if (!$options) {
			$options = FORMAT_BREAKS | FORMAT_HTMLCHARS | FORMAT_CENSOR;
		}

		if ($options & FORMAT_CENSOR) {
			if (!$this->replaces_loaded) {
				$this->get_replaces();
			}

			$in = $this->_do_censor($in);
		}

		if ($options & FORMAT_MBCODE) {
			$in = $this->_pre_parse_bbcode($in);

			$brackets = (strpos($in, '[') !== false) && (strpos($in, ']') !== false); //We may have auto-parsed a URL, adding a bracket
		}

		$strtr = array();

		if ($options & FORMAT_HTMLCHARS) {
			$strtr['&'] = '&amp;';
			$strtr['"'] = '&quot;';
			$strtr['\''] = '&#039;';
			$strtr['<'] = '&lt;';
			$strtr['>'] = '&gt;';
		}

		if ($options & FORMAT_BREAKS) {
			$strtr["\n"] = "<br />\n";
		}

		if ($this->user_view_emoticons && ($options & FORMAT_EMOTICONS)) {
			if (!$this->replaces_loaded) {
				$this->get_replaces();
			}

			$strtr = array_merge($strtr, $this->emotes['replacement']);
		}

		$in = strtr($in, $strtr);

		if (($options & FORMAT_MBCODE) && $brackets) {
			$in = $this->_parse_quotes($in);

			$in = $this->_parse_bbcode($in);

			$in = str_replace(array('  ', "\t", '&amp;#'), array('&nbsp; ', '&nbsp; &nbsp; ', '&#'), $in);
		}

		return $in;
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
	function _format_code($input, $php, $start = 1)
	{
		$input = base64_decode($input);

		$input = rtrim($input);
		
		if ($php) {
			if (strpos($input, '<?') === false) {
				$input  = '<?php ' . $input . '?>';
				$tagged = true;
			}

			$input = str_replace(array('\"', '\\'), array('"', '&#092;'), $input);

			ob_start();

			@highlight_string($input);
			$input = ob_get_contents();

			ob_end_clean();
			// Replace php4 font tags with span tags
			$input = preg_replace('/<font color="#([0-9A-F]+)">/', '<span style="color: #$1">', $input);
			$input = preg_replace('/<\/font>/', '</span>', $input);
			// Trim pointless space
			$input = preg_replace('/^<code><span style="color: #000000">\s(.+)\s<\/span>\s<\/code>$/', '<span style="color: #000000">$1</span>', $input);
		} else {
			$input = htmlspecialchars(str_replace(array('\'', '\"'), array('&#039;', '"'), $input));
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
		
		$codehtml = $this->_get_code_html($count);

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
	

	/**
	 * Checks for quote tag formatting
	 *
	 * @param string $in Input
	 * @author Jared Kuolt <jared.kuolt@gmail.com>
	 * @since 1.1.3
	 * @return bool Returns true if all quote tags have corresponding end tags
	 **/
	function quote_check($in)
	{
		$preg_begin = array();

		preg_match_all('#\[quote=(.+?)]#i', $in, $out, PREG_PATTERN_ORDER);

		if (!empty($out[0])) {
			foreach ($out[0] as $match)
			{
				$preg_begin[] = strpos($in, $match);
			}
		}

		$begin = $this->_strpos_array($in, '[quote]'); // Retrieve array for tag beginning
		$begin = array_merge($begin, $preg_begin); // Add those with preg_match'd quotes
		sort($begin);

		$end = $this->_strpos_array($in, '[/quote]');

		if (count($begin) != count($end)) { // If the counts don't match, return value is false
			return false;
		}

		foreach ($begin as $count => $pos) // Check each occurence
		{
			if ($pos > $end[$count]) { // If position of the same occurence count of end tag
				return false; // is before the begin tag, return value is false
			}
		}

		return true;
	}

	/**
	 * Handle formatting out censored workds
	 *
	 * PROTECTED
	 *
	 * @param string $in Unformatted input
	 * @return string result with censored words replaced
	 **/
	function _do_censor($in)
	{
		if ($this->censor) {
			$in = preg_replace($this->censor, '####', $in);
		}
		return $in;
	}
	
	/**
	 * Pre parsing is to help preserve contents of urls and code type blocks
	 *
	 * PROTECTED
	 *
	 * @param string $in Unformatted input
	 * @return string result with pre parsing applied
	 **/
	function _pre_parse_bbcode($in)
	{
		$link_matches = $this->_get_link_matches();
		$search = $link_matches['matches'];
	
		$replace = $link_matches['replacements'];
	
		$brackets = (strpos($in, '[') !== false) && (strpos($in, ']') !== false);
	
		if ($brackets) {
			$b_search = array(
				'~\[code](.*?)\[/code]~ise',
				'~\[php](.*?)\[/php]~ise',
				'~\[php=([0-9]+?)](.*?)\[/php]~ise',
				'~\[img](http|https|ftp)://(.*?)\[/img]~ise',
				'~\[url](.*?)\[/url]~ise',
				'~\[url=(http|https|ftp)://(.+?)](.+?)\[/url]~ise'
			);
	
			$b_replace = array(
				'\'[code]\' . base64_encode(\'\\1\') . \'[/code]\'',
				'\'[php]\' . base64_encode(\'\\1\') . \'[/php]\'',
				'\'[php=\\1]\' . base64_encode(\'\\2\') . \'[/php]\'',
				'\'[img]\' . wordwrap(\'\\1://\\2\', 1, \' \', 1) . \'[/img]\'',
				'\'[url]\' . wordwrap(\'\\1\\2\', 1, \' \', 1) . \'[/url]\'',
				'\'[url=\' . wordwrap(\'\\1://\\2\', 1, \' \', 1) . \']\\3[/url]\''
			);
	
			$search  = array_merge($search, $b_search);
			$replace = array_merge($replace, $b_replace);
		}
	
		return preg_replace($search, $replace, $in);
	}
	
	/**
	 * Parsing BB code tags
	 *
	 * PROTECTED
	 *
	 * @param string $in Partially formatted input
	 * @return string result with quote html applied
	 **/
	function _parse_bbcode($in)
	{
		$bbcode_matches = $this->_get_bbcode_matches();

		$search = $bbcode_matches['matches'];

		$replace = $bbcode_matches['replacements'];

		return preg_replace($search, $replace, $in);
	}
	
	/**
	 * Parsing for quote BB code
	 *
	 * PROTECTED
	 *
	 * @param string $in Partially formatted input
	 * @return string result with quote html applied
	 **/
	function _parse_quotes($in)
	{
		$old_in = $in; // backup text in case quote tags fail
		
		$quotehtml = $this->_get_quote_html();
		
		$search = array();
		$replace = array();
		
		$search[] = '~\[quote=(.+?)]~i';
		$search[] = '~\[quote]~i';

		$replace[] = $quotehtml['start_named'];
		$replace[] = $quotehtml['start'];

		$startCount = preg_match_all($search[0], $in, $matches);
		$startCount += preg_match_all($search[1], $in, $matches);
		$in = preg_replace($search, $replace, $in);

		$search = '~\[/quote]~i';
		$replace = $quotehtml['end'];

		// Count matches first
		$endCount = preg_match_all($search, $in, $matches);
		$in = preg_replace($search, $replace, $in);
		
		// Match failed. Ignore quote tags!
		if ($startCount != $endCount) {
			return $old_in;
		}
		return $in;
	}

	/**
	 * Get the array of matches to check for links or urls
	 *
	 * PROTECTED
	 *
	 * @return array matches and replacements to check for links or emails
	 **/
	function _get_link_matches()
	{
		return array(
			'matches' => array('~(^|\s)([a-z0-9-_.]+@[a-z0-9-.]+\.[a-z0-9-_.]+)~i',
				'~(^|\s)(http|https|ftp)://(\w+[^\s\[\]]+)~ise'),
			'replacements' => array('\\1[email]\\2[/email]',
				'\'\\1[url]\' . wordwrap(\'\\2://\\3\', 1, \' \', 1) . \'[/url]\''));
	}
	
	/**
	 * Get the array of matches to check for basic bb code
	 *
	 * PROTECTED
	 *
	 * @return array matches and replacements to check for links or emails
	 **/
	function _get_bbcode_matches()
	{
		$bbcode_matches = array('~\[b](.*?)\[/b]~is',
			'~\[i](.*?)\[/i]~is',
			'~\[u](.*?)\[/u]~is',
			'~\[s](.*?)\[/s]~is',
			'~\[sup](.*?)\[/sup]~is',
			'~\[sub](.*?)\[/sub]~is',
			'~\[indent](.*?)\[/indent]~is',
			'~\[email]([a-z0-9-_.]+@[a-z0-9-.]+\.[a-z0-9-_.]+)?\[/email]~i',
			'~\[email=([^<]+?)](.*?)\[/email]~i',
			'~\[img](h t t p|h t t p s|f t p) : / /(.*?)\[/img]~ise',
			'~\[(left|right|center|justify)](.*?)\[/\1]~is',
			'~\[color=(#?[a-zA-Z0-9]+?)](.*?)\[/color]~is',
			'~\[font=([a-zA-Z0-9 \-]+?)](.*?)\[/font]~is',
			'~\[size=([0-9]+?)](.*?)\[/size]~is',
			'~\[spoiler](.*?)\[/spoiler]~is',
			'~\[code](.*?)\[/code]~ise',
			'~\[php](.*?)\[/php]~ise',
			'~\[php=([0-9]+?)](.*?)\[/php]~ise',
			'~\[url](h t t p|h t t p s|f t p) : / /(.+?)\[/url]~ise',
			'~\[url=(h t t p|h t t p s|f t p) : / /(.+?)](.+?)\[/url]~ise');

		$bbcode_replacements = array('<strong>\\1</strong>',
			'<em>\\1</em>',
			'<span style="text-decoration:underline;">\\1</span>',
			'<span style="text-decoration:line-through;">\\1</span>',
			'<sup>\\1</sup>',
			'<sub>\\1</sub>',
			'<p style=\'text-indent:2em\'>\\1</p>',
			'<a href="mailto:\\1">\\1</a>',
			'<a href="mailto:\\1">\\2</a>',
			'\'<img src=\\\'\' . str_replace(\' \', \'\', \'\\1://\\2\') . \'\\\' alt=\\\'\' . str_replace(\' \', \'\', \'\\1://\\2\') . \'\\\' />\'',
			'<p style=\'text-align:\\1\'>\\2</p>',
			'<span style=\'color:\\1\'>\\2</span>',
			'<span style=\'font-family:\\1\'>\\2</span>',
			'<span style=\'font-size:\\1ex\'>\\2</span>',
			'<div class="spoilerbox"><strong>' . $this->lang->spoiler . ':</strong><div class="spoiler">\\1</div></div>',
			'$this->_format_code(\'\\1\', 0)',
			'$this->_format_code(\'\\1\', 1)',
			'$this->_format_code(\'\\2\', 1, \'\\1\')',
			'\'<a href="\' . str_replace(\' \', \'\', \'\\1://\\2\') . \'" onclick="window.open(this.href,\\\'' . $this->sets['link_target'] . '\\\');return false;" rel="nofollow">\' . $this->_trim_string(str_replace(\' \', \'\', \'\\1://\\2\'), $this->max_url_length) . \'</a>\'',
			'\'<a href="\' . str_replace(\' \', \'\', \'\\1://\\2\') . \'" onclick="window.open(this.href,\\\'' . $this->sets['link_target'] . '\\\');return false;" rel="nofollow">\\3</a>\'');
			
		return array('matches' => $bbcode_matches,
			'replacements' => $bbcode_replacements);
	}
	
	/**
	 * Get the array of html to wrap quotes in
	 *
	 * PROTECTED
	 *
	 * @return array HTML to use at start and end of quotes
	 **/
	function _get_quote_html()
	{
		$quote_html = array();
		$quote_html['start_named'] = '<div class="quotebox"><strong>\\1 ' . $this->lang->main_said . ':</strong><div class="quote">';
		$quote_html['start'] = '<div class="quotebox"><strong>' . $this->lang->main_quote . ':</strong><div class="quote">';
		$quote_html['end'] = '</div></div>';
		return $quote_html;
	}
	
	/**
	 * Get the array of html to wrap code and php in
	 *
	 * PROTECTED
	 *
	 * @param int $lines Number of lines of code to help estimate height
	 * @return array HTML to use at start and end of quotes
	 **/
	function _get_code_html($lines)
	{
		$height = ($lines * 14) + 14;
		
		$code_html = array();
		$code_html['start_php'] = '<div class="code phpcode"><div class="codetitle">PHP:</div><pre style="height:' . $height . 'px;" class="codedata">';
		$code_html['start_code'] = '<div class="code"><div class="codetitle">' . $this->lang->main_code . ':</div><pre style="height:' . $height . 'px;" class="codedata">';
		$code_html['end'] = '</pre></div>';
		return $code_html;
	}
	
	/**
	 * Returns an array of all the positions of needles in a haystack
	 *
	 * PRIVATE
	 *
	 * @param string $haystack Haystack
	 * @param string $needle Needle
	 * @author Jared Kuolt <jared.kuolt@gmail.com>
	 * @since 1.1.3
	 * @return array Array of positions of needles
	 **/
	function _strpos_array($haystack, $needle)
	{
		$array  = array();
		$kill   = false;
		$offset = 0;

		while (!$kill)
		{
			$result = strpos($haystack, $needle, $offset);

			if ($result === false) { // If result is false (no more instances found), kill the while loop
				$kill = true;
			} else {
				$array[] = $result; // Set array
				$offset = $result + 1; // Offset is set 1 character after previous occurence
			}
		}

		return $array;
	}

	/**
	 * Breaks down a long url into part...part
	 *
	 * PRIVATE
	 *
	 * @param string $url Url to trimp down
	 * @param integer $trimLength Max length of string to allow (default 60)
	 * @author ArticleTrader http://www.articletrader.com
	 * @since 1.2.0
	 * @return string The cut down string
	 **/
	function _trim_string($url, $trimLength = 60)
	{
		if (strlen($url) > $trimLength){
			$url = substr($url,0,floor($trimLength*0.68)) . '..' . 
				substr($url,-floor($trimLength*0.3));
		}
		return $url;
	}
	
}

?>
