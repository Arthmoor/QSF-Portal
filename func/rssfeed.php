<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005 The Quicksilver Forums Development Team
 *  http://www.quicksilverforums.com/
 * 
 * based off MercuryBoard
 * Copyright (c) 2001-2005 The Mercury Development Team
 *  http://www.mercuryboard.com/
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

/**
 * RSS Feed Generator
 *
 * @author Kristopher Powell <klpowell@trenden.net>
 * @author Roger Libiez (Samson) <samson@afkmud.com>
 * @since 1.1.5
 **/
class rssfeed extends qsfglobal
{
	/**
	 * Main interface. Get a RSS feed of posts
	 *
	 * @since 1.1.5
	 * @return string rss output
	 **/
	function execute()
	{
		$this->nohtml = true;
		$this->templater->debug_mode = false; // or else we end up with invalid XML
		
		$feed = null;
		
		$this->link = "{$this->sets['loc_of_board']}{$this->mainfile}?a=rssfeed";
		
		if (isset($this->get['f'])) {
			$f = intval($this->get['f']);
			$this->link .= "&amp;f=$f";
			if (!$this->perms->auth('forum_view', $f)) {
				return $this->rss_error_message($this->lang->rssfeed_cannot_read_forum);
			}
			$feed = $this->generate_forum_feed($f);
		} else if (isset($this->get['t'])) {
			$t = intval($this->get['t']);
			$this->link .= "&amp;t=$t";
			$feed = $this->generate_topic_feed($t);
		} else {
			$feed = $this->generate_full_feed();
		}

		return $feed;
	}
	
	function cleanup()
	{
		// Do nothing!
	}

	/**
	 * Get a RSS feed of posts for the entire forum
	 *
	 * @since 1.1.5
	 * @return string rss output
	 **/
	function generate_full_feed()
	{
		$forums_str = $this->readmarker->create_forum_permissions_string();
		
		$query = $this->db->query( "SELECT
				t.topic_id,
				t.topic_title,
				t.topic_forum,
				p.post_id,
				p.post_time,
				p.post_text,
				u.user_name,
				u.user_email,
				u.user_email_show
			FROM 
				%ptopics t,
				%pposts p,
				%pusers u
			WHERE t.topic_forum IN (%s) AND
				p.post_topic = t.topic_id AND
				u.user_id = p.post_author
			ORDER BY p.post_time DESC
			LIMIT %d",
			$forums_str, $this->sets['rss_feed_posts']);


		$items = '';
		while( $row = $this->db->nqfetch( $query ) )
		{
			$items .= $this->get_post($row);
		}

		Header( "Content-type: text/xml", 1 );
		return eval($this->template('RSSFEED_ALL_POSTS'));
	}
	
	/**
	 * Get a RSS feed of posts for a specific forum
	 *
	 * @param int $forum id number of the forum to fetch
	 * @since 1.1.9
	 * @return string rss output
	 **/
	function generate_forum_feed($forum)
	{
		$exists = $this->db->fetch("SELECT forum_parent, forum_name, forum_description, forum_subcat FROM %pforums WHERE forum_id=%d", $forum);
		if (!isset($exists['forum_parent']) || !$exists['forum_parent'] || $exists['forum_subcat']) {
			return $this->rss_error_message($this->lang->rssfeed_cannot_find_forum);
		}
		
		$query = $this->db->query( "SELECT
				t.topic_id,
				t.topic_title,
				t.topic_forum,
				p.post_id,
				p.post_time,
				p.post_text,
				u.user_name,
				u.user_email,
				u.user_email_show
			FROM 
				%ptopics t,
				%pposts p,
				%pusers u
			WHERE t.topic_forum = %d AND
				p.post_topic = t.topic_id AND
				u.user_id = p.post_author
			ORDER BY p.post_time DESC
			LIMIT %d",
			$forum, $this->sets['rss_feed_posts']);
			
		$items = '';
		while( $row = $this->db->nqfetch( $query ) )
		{
			$items .= $this->get_post($row);
		}

		Header( "Content-type: text/xml", 1 );
		return eval($this->template('RSSFEED_FORUM'));
	}

	/**
	 * Get a RSS feed of posts for a specific topic
	 *
	 * @param int $topic id number of the topic to fetch
	 * @since 1.1.9
	 * @return string rss output
	 **/
	function generate_topic_feed($topic)
	{
		$topicdata = $this->db->fetch('
			SELECT
			    t.topic_title, t.topic_description, t.topic_modes, t.topic_starter, t.topic_forum, t.topic_replies, t.topic_poll_options, f.forum_name
			FROM
			    %ptopics t, %pforums f
			WHERE
			    t.topic_id=%d AND
			    f.forum_id=t.topic_forum',
			$topic);

		if (!$topicdata) {
			return $this->rss_error_message($this->lang->rssfeed_cannot_find_topic);
		}

		if (!$this->perms->auth('topic_view', $topicdata['topic_forum'])) {
			return $this->rss_error_message($this->lang->rssfeed_cannot_read_topic);
		}

		$topicdata['topic_title'] = $this->format($topicdata['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS);
		$topicdata['topic_description'] = $this->format($topicdata['topic_description'], FORMAT_HTMLCHARS | FORMAT_CENSOR);
		
		$query = $this->db->query( "SELECT
				t.topic_id,
				t.topic_title,
				t.topic_forum,
				p.post_id,
				p.post_time,
				p.post_text,
				u.user_name,
				u.user_email,
				u.user_email_show
			FROM 
				%ptopics t,
				%pposts p,
				%pusers u
			WHERE   t.topic_id = %d AND
				p.post_topic = t.topic_id AND
				u.user_id = p.post_author
			ORDER BY p.post_time DESC
			LIMIT %d",
			$topic, $this->sets['rss_feed_posts']);

		$items = '';
		while( $row = $this->db->nqfetch( $query ) )
		{
			$items .= $this->get_post($row);
		}

		Header( "Content-type: text/xml", 1 );
		return eval($this->template('RSSFEED_TOPIC'));
	}
	
	/**
	 * Display an error in a format acceptable for an RSS reader
	 *
	 * @param string $error The error message to display
	 * @since 1.1.9
	 * @return string rss output
	 **/
	function rss_error_message($error)
	{
		Header( "Content-type: text/xml", 1 );
		return eval($this->template('RSSFEED_ERROR'));
	}
	
	/**
	 * Get the rss information for a single item
	 *
	 * @param array $query_row query information for the post
	 *	topic_id, topic_title, post_time, post_text and user_name
	 * @since 1.1.9
	 * @return string rss item output
	 **/
	function get_post($query_row)
	{
		$title = htmlspecialchars( $query_row['topic_title'] );
		$desc = substr( $query_row['post_text'], 0, 500 );
		$desc = htmlspecialchars( $desc );
		$pubdate = $this->mbdate( DATE_ISO822, $query_row['post_time'], false );
		$forum_name = 'Unknown';
		$forum = $this->readmarker->get_forum($query_row['topic_forum']);
		if ($forum != null) $forum_name = $forum['forum_name'];
		$user_email = '"' . htmlspecialchars($query_row['user_name']) . '" ';
		if ($query_row['user_email_show']) {
			$user_email .= $query_row['user_email'];
		} else {
			$user_email .= 'nobody@example.com';
		}
		
		return eval($this->template('RSSFEED_ITEM'));
	}
}
?>
