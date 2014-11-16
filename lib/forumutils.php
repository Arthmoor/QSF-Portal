<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2015 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * http://code.google.com/p/quicksilverforums/
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

		$this->qsf = &$qsf;
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

	/**
	 * Deletes a single topic
	 *
	 * @param int $t Topic ID
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 4.0
	 * @return void
	 **/
	function delete_topic($t)
	{
		$posts = $this->db->query("
			SELECT DISTINCT t.topic_forum, t.topic_id, a.attach_file, p.post_author, p.post_id, p.post_count
			FROM (%ptopics t, %pposts p)
			LEFT JOIN %pattach a ON p.post_id=a.attach_post
			WHERE t.topic_id=%d AND t.topic_id=p.post_topic", $t);

		$deleted = -1;

		while ($post = $this->db->nqfetch($posts))
		{
			if ($post['post_count']) {
				$this->db->query("UPDATE %pusers SET user_posts=user_posts-1 WHERE user_id=%d", $post['post_author']);
			}

			if ($post['attach_file']) {
				$this->db->query("DELETE FROM %pattach WHERE attach_post=%d", $post['post_id']);
				@unlink('./attachments/' . $post['attach_file']);
			}

			$deleted++;
		}

		$result = $this->db->fetch("SELECT topic_forum FROM %ptopics WHERE topic_id=%d", $t);

		$this->db->query("DELETE FROM %pvotes WHERE vote_topic=%d", $t);
		$this->db->query("DELETE FROM %ptopics WHERE topic_id=%d OR topic_moved=%d", $t, $t);
		$this->db->query("DELETE FROM %pposts WHERE post_topic=%d", $t);
		$this->db->query("DELETE FROM %preadmarks WHERE readmark_topic=%d", $t);

		$this->update_reply_count($result['topic_forum'], $deleted);

		// Update all parent forums if any
		$forums = $this->db->fetch("SELECT forum_tree FROM %pforums WHERE forum_id=%d", $result['topic_forum']);
		$this->db->query("UPDATE %pforums SET forum_topics=forum_topics-1
			WHERE forum_parent > 0 AND forum_id IN (%s) OR forum_id=%d",
			$forums['forum_tree'], $result['topic_forum']);

		$this->update_last_post($TopicForum);

		$this->sets['posts'] -= ($deleted+1);
		$this->sets['topics'] -= 1;
		$this->qsf->write_sets();
	}

	/**
	 * Deletes a single post
	 *
	 * @param int $p Post ID
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 4.0
	 * @return void
	 **/
	function delete_post($p)
	{
		$result = $this->db->fetch("SELECT t.topic_forum, t.topic_id, a.attach_file, p.post_author, p.post_count, u.user_posts
			FROM (%ptopics t, %pposts p, %pusers u)
			LEFT JOIN %pattach a ON p.post_id=a.attach_post
			WHERE p.post_id=%d AND t.topic_id=p.post_topic AND u.user_id=p.post_author", $p);

		$this->db->query("UPDATE %pforums SET forum_replies=forum_replies-1 WHERE forum_id=%d", $result['topic_forum']);
		$this->db->query("UPDATE %ptopics SET topic_replies=topic_replies-1 WHERE topic_id=%d", $result['topic_id']);
		if ($result['post_count']) {
			$posts = $result['user_posts'] - 1;

			if ($posts < 0) {
				$posts = 0;
			}
			$this->db->query("UPDATE %pusers SET user_posts=%d WHERE user_id=%d", $posts, $result['post_author']);
		}

		$this->db->query("DELETE FROM %pposts WHERE post_id=%d", $p);

		if ($result['attach_file']) {
			$this->db->query("DELETE FROM %pattach WHERE attach_post=%d", $p);
			@unlink('./attachments/' . $result['attach_file']);
		}

		$this->update_last_post($result['topic_forum']);
		$this->update_last_post_topic($result['topic_id']);
		$this->sets['posts'] -= 1;
		$this->qsf->write_sets();
	}

	/**
	 * Updates the last post of a forum
	 *
	 * @param int $f Forum ID
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 4.0
	 * @return void
	 **/
	function update_last_post($f)
	{
		/* update any parent forums */
		$forums = $this->db->fetch("SELECT forum_tree FROM %pforums WHERE forum_id=%d", $f);

		if (isset($forums['forum_tree']) && 0 != strlen($forums['forum_tree']))
		{
			$wip = explode(',', $forums['forum_tree']);

			foreach ($wip as $fid)
			{
				$fid = intval($fid);

				/* handle weird cases */
				if (0 == $fid)
					continue;

				$this->_update_last_post($fid);
			}
		}

		/* update the specified forum */
		$this->_update_last_post($f);
	}

	function _update_last_post($f)
	{
		$post = $this->db->fetch("SELECT p.post_id FROM (%pposts p, %ptopics t)
			WHERE t.topic_id=p.post_topic AND t.topic_forum=%d
			ORDER BY t.topic_edited DESC, p.post_id DESC
			LIMIT 1", $f);

		if (!isset($post['post_id'])) {
			$post['post_id'] = 0;
		}

		$this->db->query("UPDATE %pforums SET forum_lastpost=%d WHERE forum_id=%d", $post['post_id'], $f);
	}

	/**
	 * Updates the last post of a topic
	 *
	 * @param int $t Topic ID
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.1.1
	 * @return void
	 **/
	function update_last_post_topic($t)
	{
		$last = $this->db->fetch("SELECT p.post_id, p.post_author, p.post_time
			FROM %pposts p, %ptopics t
			WHERE p.post_topic=t.topic_id AND t.topic_id=%d
			ORDER BY p.post_time DESC
			LIMIT 1", $t);

		$this->db->query("UPDATE %ptopics SET topic_last_post=%d, topic_last_poster=%d, topic_edited=%d WHERE topic_id=%d",
			$last['post_id'], $last['post_author'], $last['post_time'], $t);
	}

	/**
	 * Decrements a forum and all it's parents by the given value.
	 *
	 * @param int $f the forum identifier
	 * @param int $ammount how much to decrement by
	 * @author Matthew Lawrence <matt@quicksilverforums.co.uk>
	 * @since 1.3.0
	 * @returns void
	**/
	function update_reply_count($f, $ammount, $topic = 0)
	{
		if (0 == $ammount && 0 == $topic) // nothing to do
			return;

		/* decrement the parent forums */
		$forums = $this->db->fetch("SELECT forum_tree FROM %pforums WHERE forum_id=%d", $f);

		if (isset($forums['forum_tree']) && 0 != strlen($forums['forum_tree']))
		{
			$wip = explode(',', $forums['forum_tree']);

			array_push($wip, $f);

			foreach ($wip as $fid)
			{
				$fid = intval($fid);

				if (0 == $fid)
					continue;

				$this->db->query("UPDATE %pforums SET forum_replies=forum_replies-%d WHERE forum_id=%d", $ammount, $fid);

				if (0 != $topic)
					$this->db->query("UPDATE %pforums SET forum_topics=forum_topics-%d WHERE forum_id=%d",
						intval($topic), $fid);
			}
		}
	}

	function update_count_move($f_from, $f_to, $ammount)
	{
		$this->update_reply_count($f_from, $ammount,  1);
		$this->update_reply_count($f_to, 0-$ammount, -1);
	}
}
?>