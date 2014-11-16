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
 * Will mark topics as read and return what topics are unread
 * or even what posts are unread
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @since 1.2
 **/
class readmarker extends forumutils
{
	var $last_read_all = 0;		// Time beyond which all posts are considered read
	var $guest_mode = true;		// Mark if we're using a cookie or database records
	var $readmarkers_loaded = false; // Have we queried the database yet
	var $forum_topics_loaded = false; // Same as above execpt for the forums not the topics
	var $user_id;			// What user ID should we use for any queries or updates
	var $readmarkers = array();	// Data for user as pulled from the database
	var $forumtopics = array();	// Cache of topics within forums
	var $cleanupchance = false;	// Set to true if we want a cleanup operation done
	
	/**
	 * Constructor. Initalise the read marker for guest (cookie and session)
	 * or user (readmark table)
	 *
	 * @param $qsf - Quicksilver Forums module
	 **/
	function readmarker(&$qsf)
	{
		parent::forumutils($qsf);

		$this->time = &$qsf->time;
		
		// To initalise ourselves we need to look at the user
		if ($qsf->perms->is_guest) {
			// With a guest user we can try and read/set a cookie but that's all!
			if (isset($qsf->cookie[$this->sets['cookie_prefix'] . 'lastallread']) && $qsf->cookie[$this->sets['cookie_prefix'] . 'lastallread'] < ($this->time - (DAY_IN_SECONDS * 2))) {
				$this->last_read_all = intval($qsf->cookie[$this->sets['cookie_prefix'] . 'lastallread']);
			} else {
				$this->last_read_all = $this->time - DAY_IN_SECONDS;
				setcookie($this->sets['cookie_prefix'] . 'lastallread', $this->last_read_all, $qsf->time + $this->sets['logintime'], $this->sets['cookie_path']);
			}
			if (!isset($_SESSION[$this->sets['cookie_prefix'] . 'read_topics'])) {
				$_SESSION[$this->sets['cookie_prefix'] . 'read_topics'] = array();
			}

			$this->guest_mode = true;
		} else {
			// Get the user ID and the lastallread value and prepare to
			if ($qsf->user['user_lastallread']) {
				$this->last_read_all = $qsf->user['user_lastallread'];
			} elseif (isset($qsf->cookie[$this->sets['cookie_prefix'] . 'lastallread'])) {
				$this->last_read_all = intval($qsf->cookie[$this->sets['cookie_prefix'] . 'lastallread']);
			} else {
				$this->last_read_all = $this->time - DAY_IN_SECONDS;
			}
			
			$this->guest_mode = false;
			$this->user_id = intval($qsf->user['user_id']);
		}
	}
	
	/**
	 * A kind of deconstructor but not always run
	 *
	 * @param int $time Time to mark all topics as read to the time set
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2.0
	 **/
	function cleanup()
	{
		if ($this->cleanupchance && Rand(1,20) == 1) {
			$this->_cleanup_readmarks();
		}
	}
	
	/**
	 * Updates all records of all topics, marking them as read
	 *
	 * @param int $time Time to mark all topics as read to the time set
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2.0
	 **/
	function mark_all_read($time)
	{
		$time = intval($time);
		
		if ($this->last_read_all >= $time) return; // Do Nothing
		
		$this->last_read_all = $time;
		// Clean out unneeded entries
		if ($this->guest_mode) {
			foreach (array_keys($_SESSION[$this->sets['cookie_prefix'] . 'read_topics']) as $topic) {
				if ($_SESSION[$this->sets['cookie_prefix'] . 'read_topics'][$topic] < $time) {
					unset($_SESSION[$this->sets['cookie_prefix'] . 'read_topics'][$topic]);
				}
			}
			setcookie($this->sets['cookie_prefix'] . 'lastallread', $time, $this->time + $this->sets['logintime'], $this->sets['cookie_path']);
		} else {
			$this->db->query("UPDATE %pusers SET user_lastallread=%s WHERE user_id=%d", $time, $this->user_id);
			$this->db->query("DELETE FROM %preadmarks 
				WHERE readmark_user=%d AND readmark_lastread<%d", $this->user_id, $time);
		}
		$this->readmarkers_loaded = false;
	}

	/**
	 * Mark all topics within a forum as read to the time set
	 *
	 * @param int $forum_id Forum being marked as read
	 * @param int $time Time of the newest post read
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.3.0
	 **/
	function mark_forum_read($forum_id, $time)
	{
		$query = $this->db->query("SELECT topic_id, topic_edited FROM %ptopics
			WHERE topic_edited > %d AND topic_forum = %d",
			$this->last_read_all, $forum_id);
		
		while ($row = $this->db->nqfetch($query)) {
			$this->mark_topic_read($row['topic_id'], $time);
		}
	}
	
	/**
	 * Mark a topic as read to the time set
	 *
	 * @param int $topic_id Topic being read
	 * @param int $time Time of the newest post read
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 **/
	function mark_topic_read($topic_id, $time)
	{
		$topic_id = intval($topic_id);
		$time = intval($time);
		
		if ($time >= $this->last_read_all) {
			if ($this->guest_mode) {
				if (!isset($_SESSION[$this->sets['cookie_prefix'] . 'read_topics'][$topic_id]) ||
						$_SESSION[$this->sets['cookie_prefix'] . 'read_topics'][$topic_id] < $time) {
					$_SESSION[$this->sets['cookie_prefix'] . 'read_topics'][$topic_id] = $time;
				}
			} else {
				$this->_load_readmarkers();
				if (!isset($this->readmarkers[$topic_id]) || $this->readmarkers[$topic_id] < $time) {
					$this->db->query("REPLACE INTO %preadmarks
						(readmark_user, readmark_topic, readmark_lastread)
						VALUES (%d, %d, %d)", $this->user_id, $topic_id, $time);
					$this->readmarkers[$topic_id] = $time;
				}
				
				// There is a chance of running a cleanup
				$this->cleanupchance = true;
			}
		}
	}

	/**
	 * Query what date was the topic last read
	 *
	 * @param int $topic_id Topic to check
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2.0
	 * @return date the topics was last read or all topics were read
	 **/
	function topic_last_read($topic_id)
	{
		$topic_id = intval($topic_id);
		
		$last_post_time = $this->last_read_all;
		
		if ($this->guest_mode) {
			if (isset($_SESSION[$this->sets['cookie_prefix'] . 'read_topics'][$topic_id]) &&
					$_SESSION[$this->sets['cookie_prefix'] . 'read_topics'][$topic_id] > $last_post_time) {
				$last_post_time = $_SESSION[$this->sets['cookie_prefix'] . 'read_topics'][$topic_id];
			}
		} else {
			$this->_load_readmarkers();
			if (isset($this->readmarkers[$topic_id]) && $this->readmarkers[$topic_id] > $last_post_time) {
				$last_post_time = $this->readmarkers[$topic_id];
			}
		}
		return $last_post_time;
	}

	/**
	 * Check if there are unread posts in a topic
	 *
	 * @param int $topic_id Topic to check
	 * @param int $last_post_time Time of newest post in topic
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 * @return bool True if all posts within have been marked read
	 **/
	function is_topic_read($topic_id, $last_post_time)
	{
		$topic_id = intval($topic_id);
		$last_post_time = intval($last_post_time);

		if ($last_post_time < $this->last_read_all) return true;
		
		if ($this->guest_mode) {
			if (isset($_SESSION[$this->sets['cookie_prefix'] . 'read_topics'][$topic_id]) &&
					$_SESSION[$this->sets['cookie_prefix'] . 'read_topics'][$topic_id] >= $last_post_time) {
				return true;
			}
		} else {
			$this->_load_readmarkers();
			if (isset($this->readmarkers[$topic_id]) && $this->readmarkers[$topic_id] >= $last_post_time) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Check if a post has been read
	 *
	 * @param int $topic_id Forum to check
	 * @param int $last_post_time Time of newest post in forum
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 * @return bool True if post has been marked read 
	 **/
	function is_post_read($topic_id, $post_time)
	{
		return $this->is_topic_read($topic_id, $post_time);
	}
	
	/**
	 * Check if there are unread posts in the forum
	 * This is a tricky one because we may have to query the topics in the forum
	 *
	 * @param int $forum_id Forum to check
	 * @param int $last_post_time Time of newest post in forum
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 * @return bool True if all topics within have been marked read 
	 **/
	function is_forum_read($forum_id, $last_post_time)
	{
		$forum_id = intval($forum_id);
		$last_post_time = intval($last_post_time);
		
		if ($last_post_time < $this->last_read_all) return true;
		
		$this->_load_forum_topics();

		if (isset($this->forumtopics[$forum_id]) && (0 != $this->forumtopics[$forum_id]))
			return false;

		$forums = $this->forum_array($this->forum_grab(), $forum_id);
		if (!$forums)
			return true;

		foreach ($forums as $f)
		{
			if (!$this->is_forum_read($f['forum_id'], $last_post_time)) {
				return false;
			}
		}
		return true;
	}
	
	/**
	 * Check if there are unread posts in the forum
	 * This is a tricky one because we may have to query the topics in the forum
	 *
	 * @param int $forum_id Forum to check
	 * @param int $last_post_time Time of newest post in forum
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 * @return bool True if all topics within have been marked read 
	 **/
	function _load_readmarkers()
	{
		if (!$this->readmarkers_loaded) {
			$this->readmarkers = array();
			$query = $this->db->query("SELECT * FROM %preadmarks WHERE readmark_user=%d", $this->user_id);
			while ($mark = $this->db->nqfetch($query))
			{
				$this->readmarkers[$mark['readmark_topic']] = $mark['readmark_lastread'];
			}
			$this->readmarkers_loaded = TRUE;
		}
	}
	
	/**
	 * Loads in a list of topic ids for a forum so we can check if the topics have been read
	 * 
	 * PRIVATE
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 * @version 1.3.0 - Altered by Matt L to use fewer querys and removed unused parameter $forum_id.
	 **/
	function _load_forum_topics()
	{
		if (!$this->forum_topics_loaded)
		{
			/* find all topics since we pressed mark all read */
			$query = $this->db->query("SELECT topic_id, topic_edited, topic_forum FROM %ptopics
			   WHERE topic_edited > %d", $this->last_read_all);

			/* read all the records*/
			while ($row = $this->db->nqfetch($query))
			{
				/* Set to 0 if not set */
				if(!isset($this->forumtopics[$row['topic_forum']]))
					$this->forumtopics[$row['topic_forum']] = 0;

				/* increase un-read count */
				if (!$this->is_topic_read($row['topic_id'], $row['topic_edited']))
				{
					$this->forumtopics[$row['topic_forum']]++;
				}
			}
			$this->forum_topics_loaded = true;
		}
	}
	
	/**
	 * Deletes unneeded records frop readmarks because they are for topics
	 * that are older than the last time we've hit Mark All
	 *
	 * PRIVATE
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 **/
	function _cleanup_readmarks()
	{
		$readable_forums = $this->create_forum_permissions_string();
		// Find the OLDEST unread post
		$query = $this->db->query("SELECT topic_id, topic_edited FROM %ptopics
			WHERE topic_edited > %d AND topic_forum IN (%s)",
			$this->last_read_all, $readable_forums);
		
		$oldest_time = $this->time;
		while ($row = $this->db->nqfetch($query))
		{
			if ($row['topic_edited'] < $oldest_time && !$this->is_topic_read($row['topic_id'], $row['topic_edited']))
			{
				$oldest_time = $row['topic_edited'];
			}
		}
		$this->mark_all_read($oldest_time - 1);
	}
}

?>
