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

require_once $set['include_path'] . '/lib/forumutils.php';

/**
 * Contains functions generic to the different html formatting modules
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @since 1.2
 **/
class htmltools extends forumutils
{
	var $replaces_loaded;
	var $censor;		// Curse words to filter @var array
	var $emotes;            // Text strings to be replaced with images @var array
	
	/**
	 * Constructor
	 *
	 * @param $qsf - Quicksilver Forums module
	 **/
	function htmltools(&$qsf)
	{
		parent::forumutils($qsf);
		
		$this->modules = &$qsf->modules;
		$this->lang = &$qsf->lang;
		$this->self = $qsf->self;
		$this->skin = $qsf->skin;
		
		// Make the properties static (even on PHP 4)
		static $replaces_loaded = false;
		static $censor = array();
		static $emotes = array(
			'replacement' => array(),
			'replacement_clickable' => array());
			
		$this->replaces_loaded =& $replaces_loaded;
		$this->censor =& $censor;
		$this->emotes =& $emotes;
	}

	/**
	 * Generates clickable emoticon HTML
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 3.0
	 * @return string HTML
	 * @todo move to HTMLwidgets
	 **/
	function make_clickable()
	{
		$return = null;

		if (!$this->replaces_loaded) {
			$this->get_replaces();
		}

		foreach ($this->emotes['replacement_clickable'] as $search => $replace)
		{
			$return .= "\n<li><a href=\"javascript:insertSmiley('{$search}');\">{$replace}</a></li>";
		}

		return $return;
	}

	/**
	 * Loads emoticon and censor information from the replacements table
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return void
	 *
	 * @todo Ordering by LENGTH() adds some strain to an otherwise simple query. I'd be good to add
	 * an order column and allow manual ordering from that like we do with forums
	 **/
	function get_replaces()
	{
		$this->replaces_loaded = true;

		$replace = $this->db->query("SELECT * FROM %preplacements ORDER BY LENGTH(replacement_search) DESC");
		while ($r = $this->db->nqfetch($replace))
		{
			if ($r['replacement_type'] == 'emoticon') {
				$this->emotes['replacement'][$r['replacement_search']] = "<img src=\"./skins/$this->skin/emoticons/{$r['replacement_replace']}\" alt=\"{$r['replacement_search']}\" />";

				if ($r['replacement_clickable']) {
					$this->emotes['replacement_clickable'][$r['replacement_search']] = "<img src=\"./skins/$this->skin/emoticons/{$r['replacement_replace']}\" alt=\"{$r['replacement_search']}\" />";
				}
			} elseif ($r['replacement_type'] == 'censor') {
				$this->censor[] = '/' . $r['replacement_search'] . '/i';
			}
		}
	}
	

}

?>
