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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/global.php';

class spam_control extends qsfglobal
{
	function execute()
	{
		if (!$this->perms->auth('board_view')) {
			$this->lang->board();
			return $this->message(
				sprintf($this->lang->board_message, $this->sets['forum_name']),
				($this->perms->is_guest) ? sprintf($this->lang->board_regfirst, $this->self) : $this->lang->board_noview
			);
		}

		if( !$this->perms->auth('is_admin') && !$this->user['user_group'] == USER_MODS )
			return $this->message( $this->lang->spam_control, $this->lang->spam_no_view );

		$svars = array();
		$this->set_title( $this->lang->spam_controls );

		if( !isset($this->get['c']) ) {
			return $this->display_spam();
		}

		if( !$this->is_valid_token() ) {
			return $this->message( $this->lang->spam_control, $this->lang->invalid_token );
		}

		$c = intval($this->get['c']);

		if( $c == 0 ) {
			$this->db->query( "TRUNCATE TABLE %pspam" );
			$this->sets['spam_pending'] = 0;
			$this->write_sets();

			return $this->message( $this->lang->spam_control, $this->lang->spam_all_deleted, $this->lang->continue, $this->sets['loc_of_board'] . 'index.php' );
		}

		if( isset( $this->get['s'] ) ) {
			switch( $this->get['s'] )
			{
				case 'delete_spam':	return $this->delete_spam($c);
				case 'report_ham':	return $this->report_ham($c);
			}
		}
		return $this->message( $this->lang->spam_control, $this->lang->spam_invalid_option );
	}

	function delete_spam( $c )
	{
		$spam = $this->db->fetch( "SELECT spam_topic FROM %pspam WHERE spam_id=%d", $c );

		if( !$spam )
			return $this->message( $this->lang->spam_control, $this->lang->spam_no_post, $this->lang->continue, $this->sets['loc_of_board'] . 'index.php?a=spam_control' );

		$this->db->query( "DELETE FROM %pspam WHERE spam_id=%d", $c );

		// Only post in the topic? Kill the actual topic.
		$topic = $this->db->fetch( "SELECT topic_id, topic_replies FROM %ptopics WHERE topic_id=%d", $spam['spam_topic'] );
		if( $topic['topic_replies'] < 1 )
			$this->db->query( "DELETE FROM %ptopics WHERE topic_id=%d", $topic['topic_id'] );

		$this->sets['spam_pending']--;

		// Now fix the forum stats.
		$this->RecountForums();
		$this->write_sets();

		return $this->message( $this->lang->spam_control, $this->lang->spam_deleted, $this->lang->continue, $this->sets['loc_of_board'] . 'index.php?a=spam_control' );
	}

	function report_ham( $c )
	{
		$spam = $this->db->query( "SELECT spam_id, spam_topic, spam_author, spam_emoticons, spam_mbcode, spam_count, spam_text, spam_time,
			spam_icon, spam_ip, spam_edited_by, spam_edited_time, spam_svars FROM %pspam WHERE spam_id=%d", $c );
		if( !$spam )
			return $this->message( $this->lang->spam_control, $this->lang->spam_no_post, $this->lang->continue, $this->sets['loc_of_board'] . 'index.php?a=spam_control' );

		$svars = json_decode($spam['spam_svars'], true);

		$user = $this->db->query( "SELECT user_name, FROM %pusers WHERE user_id=%d", $spam['spam_author'] );

		// Setup and deliver the information to flag this comment as legit with Akismet.
		require_once $this->sets['include_path'] . '/lib/akismet.php';
		$akismet = new Akismet($this->settings['loc_of_board'], $this->settings['wordpress_api_key'], $this->version);
		$akismet->setCommentAuthor($user['user_name']);
		$akismet->setCommentContent($spam['spam_text']);
		$akismet->setUserIP($spam['spam_ip']);
		$akismet->setReferrer($svars['HTTP_REFERER']);
		$akismet->setUserAgent($svars['HTTP_USER_AGENT']);
		$akismet->setCommentType('forum-post');

		$akismet->submitHam();

		$this->db->query("INSERT INTO %pposts (post_topic, post_author, post_text, post_time, post_emoticons, post_mbcode, post_count, post_ip, post_icon, post_referrer, post_agent)
			VALUES (%d, %d, '%s', %d, %d, %d, %d, '%s', '%s', '%s', '%s')",
			$spam['spam_topic'], $spam['spam_author'], $spam['spam_text'], $spam['spam_time'], $spam['spam_emoticons'], $spam['spam_mbcode'], $spam['spam_count'], $spam['spam_ip'], $spam['spam_icon'], $svars['HTTP_REFERER'], $svars['HTTP_USER_AGENT']);
		$post_id = $this->db->insert_id("posts");

		$this->db->query("UPDATE %ptopics SET topic_last_post=%d WHERE topic_id=%d", $post_id, $spam['spam_topic']);

		if ($spam['spam_count']) {
			$this->db->query("UPDATE %pusers SET user_posts=user_posts+1' WHERE user_id=%d", $spam['spam_author']);
		}

		// Easier to just do this as reporting ham isn't generally repeated that often.
		$this->RecountForums();

		$this->db->query( "DELETE FROM %pspam WHERE spam_id=%d", $spam['spam_id'] );

		$this->sets['spam_post_count']--;
		$this->sets['ham_count']++;
		$this->sets['spam_pending']--;
		$this->write_sets();

		return $this->message( $this->lang->spam_control, $this->lang->spam_false_positive, $this->lang->continue, $this->sets['loc_of_board'] . 'index.php?a=spam_control' );
	}

	function display_spam()
	{
		$token = $this->generate_token();

		$result = $this->db->query( "SELECT spam_id, spam_topic, spam_author, spam_text, spam_time, spam_ip FROM %pspam ORDER BY spam_time" );

		$spams = null;
		while( $spam = $this->db->nqfetch($result) )
		{
			$ham_link = $this->sets['loc_of_board'] . '/index.php?a=spam_control&amp;s=report_ham&amp;c=' . $spam['spam_id'];
			$delete_link = $this->sets['loc_of_board'] . '/index.php?a=spam_control&amp;s=delete_spam&amp;c=' . $spam['spam_id'];

			$topic = $this->db->fetch( "SELECT topic_id, topic_title FROM %ptopics WHERE topic_id=%d", $spam['spam_topic'] );
			$user = $this->db->fetch( "SELECT user_id, user_name FROM %pusers WHERE user_id=%d", $spam['spam_author'] );

			$tid = $topic['topic_id'];
			$title = $this->format( $topic['topic_title'], FORMAT_HTMLCHARS );

			$uid = $user['user_id'];
			$author = $this->format( $user['user_name'], FORMAT_HTMLCHARS );

			$text = ((strlen($spam['spam_text']) > 1000)) ? (substr($spam['spam_text'], 0, 996) . ' ...') : $spam['spam_text'];
			$text = $this->format( $text, FORMAT_HTMLCHARS );

			$date = $this->mbdate( DATE_LONG, $spam['spam_time'] );
			$ip = $spam['spam_ip'];

			$spams .= eval($this->template('SPAM_LIST_ENTRY'));
		}

		$clearall = null;
		if( $this->perms->auth('is_admin') ) {
			$clearall = eval($this->template('SPAM_CLEARALL'));
		}

		return eval($this->template('SPAM_LIST'));
	}
}
?>