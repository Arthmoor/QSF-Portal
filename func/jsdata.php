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

require_once $set['include_path'] . '/global.php';
require_once $set['include_path'] . '/lib/JSON.php';

/**
 * Public interface to fetch board data
 **/
class jsdata extends qsfglobal
{
	/**
	 * Main interface. Get a JSON feed of language variables
	 *
	 * @since 1.3.0
	 * @return string rss output
	 **/
	function execute()
	{
		$this->nohtml = true;
		
		$json = new Services_JSON();
		
		if (!isset($this->get['data'])) $this->get['data'] = '';
		
		$results = null;
		
		switch ($this->get['data']) {
		case 'bbcode':
			$results = array();
			$results['clickablesmilies'] = array();
			$results['buttons'] = array();
			$results['lang'] = $this->lang;
			
			// Load smilies
			$replace = $this->db->query("SELECT replacement_search, replacement_replace
				FROM %preplacements
				WHERE replacement_type = 'emoticon'
				AND replacement_clickable = 1
				ORDER BY LENGTH(replacement_search) DESC");
			while ($r = $this->db->nqfetch($replace)) {
				$results['clickablesmilies'][$r['replacement_search']] = "./skins/{$this->skin}/emoticons/{$r['replacement_replace']}";
			}
			
			// Load button data
			$this->lang->bbcode();
			$results['buttons'][] = array(
				'tag' => 'b',
				'keynum' => 66, // b
				'title' => $this->lang->bbcode_bold,
				'value' => $this->lang->bbcode_bold1,
				'action' => 'bbCode',
				'style' => 'font-weight: bold;'
				);
			$results['buttons'][] = array(
				'tag' => 'i',
				'keynum' => 73, // i
				'title' => $this->lang->bbcode_italic,
				'value' => $this->lang->bbcode_italic1,
				'action' => 'bbCode',
				'style' => 'font-style: italic;'
				);
			$results['buttons'][] = array(
				'tag' => 'u',
				'keynum' => 85, // u
				'title' => $this->lang->bbcode_underline,
				'value' => $this->lang->bbcode_underline1,
				'action' => 'bbCode',
				'style' => 'text-decoration: underline;'
				);
			$results['buttons'][] = array(
				'tag' => 's',
				'keynum' => 83,// s
				'title' => $this->lang->bbcode_strike,
				'value' => $this->lang->bbcode_strike1,
				'action' => 'bbCode',
				'style' => 'text-decoration: line-through;'
				);
			$results['buttons'][] = array(
				'tag' => 'php',
				'keynum' => 75, // k
				'title' => $this->lang->bbcode_php,
				'value' => $this->lang->bbcode_php1,
				'action' => 'bbCode'
				);
			$results['buttons'][] = array(
				'tag' => 'code',
				'keynum' => 76, // l
				'title' => $this->lang->bbcode_code,
				'value' => $this->lang->bbcode_code1,
				'action' => 'bbCode'
				);
			$results['buttons'][] = array(
				'tag' => 'quote',
				'keynum' => 81, // q
				'title' => $this->lang->bbcode_quote,
				'value' => $this->lang->bbcode_quote1,
				'action' => 'bbCode'
				);
			$results['buttons'][] = array(
				'tag' => 'spoiler',
				'keynum' => 81, // r
				'title' => $this->lang->bbcode_spoiler,
				'value' => $this->lang->bbcode_spoiler1,
				'action' => 'bbCode'
				);
			$results['buttons'][] = array(
				'tag' => 'url',
				'keynum' => 72, // h
				'title' => $this->lang->bbcode_url,
				'value' => $this->lang->bbcode_url1,
				'action' => 'bbcURL'
				);
			$results['buttons'][] = array(
				'tag' => 'email',
				'keynum' => 69, // e
				'title' => $this->lang->bbcode_email,
				'value' => '@',
				'action' => 'bbcURL'
				);
			$results['buttons'][] = array(
				'tag' => 'img',
				'keynum' => 74, // j
				'title' => $this->lang->bbcode_image,
				'value' => $this->lang->bbcode_image1,
				'action' => 'bbcURL'
				);
			$results['buttons'][] = array(
				'tag' => 'color',
				'title' => $this->lang->bbcode_color,
				'action' => 'bbcFont',
				'options' => array(
					'skyblue' => $this->lang->bbcode_skyblue,
					'royalblue' => $this->lang->bbcode_royalblue,
					'blue' => $this->lang->bbcode_blue,
					'darkblue' => $this->lang->bbcode_darkblue,
					'yellow' => $this->lang->bbcode_yellow,
					'orange' => $this->lang->bbcode_orange,
					'orangered' => $this->lang->bbcode_orangered,
					'crimson' => $this->lang->bbcode_crimson,
					'red' => $this->lang->bbcode_red,
					'firebrick' => $this->lang->bbcode_firered,
					'darkred' => $this->lang->bbcode_darkred,
					'green' => $this->lang->bbcode_green,
					'limegreen' => $this->lang->bbcode_limegreen,
					'seagreen' => $this->lang->bbcode_seagreen,
					'deeppink' => $this->lang->bbcode_deeppink,
					'tomato' => $this->lang->bbcode_tomato,
					'coral' => $this->lang->bbcode_coral,
					'purple' => $this->lang->bbcode_purple,
					'indigo' => $this->lang->bbcode_indigo,
					'burlywood' => $this->lang->bbcode_wood,
					'sandybrown' => $this->lang->bbcode_sandybrown,
					'sienna' => $this->lang->bbcode_sienna,
					'chocolate' => $this->lang->bbcode_chocolate,
					'teal' => $this->lang->bbcode_teal,
					'silver' => $this->lang->bbcode_silver
					)
				);
			$results['buttons'][] = array(
				'tag' => 'size',
				'title' => $this->lang->bbcode_size,
				'action' => 'bbcFont',
				'options' => array(
					'1' => $this->lang->bbcode_tiny,
					'2' => $this->lang->bbcode_small,
					'3' => $this->lang->bbcode_medium,
					'5' => $this->lang->bbcode_large,
					'7' => $this->lang->bbcode_huge
					)
				);
			$results['buttons'][] = array(
				'tag' => 'font',
				'title' => $this->lang->bbcode_font,
				'action' => 'bbcFont',
				'options' => array(
					'arial' => $this->lang->bbcode_arial,
					'courier' => $this->lang->bbcode_courier,
					'impact' => $this->lang->bbcode_impact,
					'tahoma' => $this->lang->bbcode_tahoma,
					'times' => $this->lang->bbcode_times,
					'verdana' => $this->lang->bbcode_verdana
					)
				);
			
			break;
		}
		return $json->encode($results);
	}
	
}
?>
