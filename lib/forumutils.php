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

require_once $set['include_path'] . '/lib/tool.php';

/**
 * Forum related utilities
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @since 1.2
 **/
 class forumutils extends tool
 {
	 var $forum_data;	// Array of forum forum_id, forum_parent, forum_tree, forum_name, forum_position
	 
	/**
	 * Constructor. Initalise the read marker for guest (cookie and session)
	 * or user (readmark table)
	 *
	 * @param $qsf - Quicksilver Forums module
	 **/
	function forumutils(&$qsf)
	{
		static $forum_data = false;
		
		$this->db  = &$qsf->db;
		$this->pre = &$qsf->pre;
		$this->sets = &$qsf->sets;
		$this->perms = &$qsf->perms;
		
		$this->forum_data = &$forum_data;
	}

	/**
	 * Requests the data on a forum given it's id
	 *
	 * @param array $array Array of forums from forum_grab()
	 * @param int $forum_id forum_id for which data is being requested
	 * @return array Row record of forum
	 **/
	function get_forum($forum_id)
	{
		$allForums = $this->forum_grab();
		
		foreach ($allForums as $row)
		{
			if ($row['forum_id'] == $forum_id) {
				return $row;
			}
		}
		return null;
	}

	/**
	 * Finds all subforums of $parent in $array
	 *
	 * @param array $array Array of forums from forum_grab()
	 * @param int $parent forum_id of a parent forum
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 4.0
	 * @return array Array of subforums
	 **/
	function forum_array($array, $parent)
	{
		$arr = array();
		for ($i = 0; $i < count($array); $i++)
		{
			if ($array[$i]['forum_parent'] == $parent) {
				$arr[] = $array[$i];
			}
		}
		return $arr;
	}

	/**
	 * Gets all forums and puts them in an array
	 *
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 4.0
	 * @return array Array of all existing forums to be passed to select_forums()
	 **/
	function forum_grab()
	{
		$this->_load_forum_data();
		return $this->forum_data;
	}

	/**
	 * Returns forum data with keys a sorted array of forum ids
	 * Also factors in forum_view permissions
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return array of forum ids.
	 **/
	function forum_grab_sorted()
	{
		$forums = $this->forum_grab();
		$forumData = array();
		foreach ($forums as $f) {
			if ($this->perms->auth('forum_view',$f['forum_id'])) {
				$forumData[$f['forum_id']] = $f;
			}
		}
		ksort($forumData);
		return $forumData;
	}
	
	/**
	 * Get a list of forums the user can view
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return string comma delimited list for us in SQL
	 **/
	function create_forum_permissions_string()
	{
		$forums = array();
		$allForums = $this->forum_grab();
		
		foreach ($allForums as $row)
		{
			if ($this->perms->auth('forum_view',$row['forum_id']) &&
				$this->perms->auth('topic_view',$row['forum_id']))
			{
				$forums[] = $row['forum_id'];
			}
		}
		return implode(', ', $forums);
	}
	
	/**
	 * Load the forum data into a static array so we don't have to run
	 * multiple queries for the same data
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2.0
	 **/
	function _load_forum_data()
	{
		if ($this->forum_data === false) {
			$this->forum_data = array();
			
			$q = $this->db->query("SELECT forum_id, forum_parent, forum_tree, forum_name, forum_position
				FROM %pforums ORDER BY forum_position");

			while ($f = $this->db->nqfetch($q))
			{
				$this->forum_data[] = $f;
			}
		}
	}
}
?>
