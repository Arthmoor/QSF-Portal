<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2019 The QSF Portal Development Team
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

require_once $set['include_path'] . '/global.php';

class spam_control extends qsfglobal
{
	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->self ) : $this->lang->board_noview
			);
		}

		if( !$this->perms->auth('is_admin') && !$this->user['user_group'] == USER_MODS )
			return $this->message( $this->lang->spam_control, $this->lang->spam_no_view );

		$svars = array();
		$this->set_title( $this->lang->spam_controls );

		if( !isset( $this->get['c'] ) ) {
			return $this->display_spam();
		}

		if( !$this->is_valid_token() ) {
			return $this->message( $this->lang->spam_control, $this->lang->invalid_token );
		}

		$c = intval( $this->get['c'] );

		if( $c == 0 ) {
			$this->db->query( "TRUNCATE TABLE %pspam" );
			$this->sets['spam_pending'] = 0;
			$this->write_sets();

			return $this->message( $this->lang->spam_control, $this->lang->spam_all_deleted, $this->lang->continue, $this->site );
		}

		if( isset( $this->get['s'] ) ) {
			switch( $this->get['s'] )
			{
				case 'delete_spam':	return $this->delete_spam( $c );
				case 'report_ham':	return $this->report_ham( $c );
			}
		}
		return $this->message( $this->lang->spam_control, $this->lang->spam_invalid_option );
	}

	private function delete_spam( $c )
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

	private function report_ham( $c )
	{
		$spam = $this->db->query( "SELECT spam_id, spam_topic, spam_author, spam_emojis, spam_bbcode, spam_count, spam_text, spam_time,
			spam_icon, spam_ip, spam_edited_by, spam_edited_time, spam_svars FROM %pspam WHERE spam_id=%d", $c );
		if( !$spam )
			return $this->message( $this->lang->spam_control, $this->lang->spam_no_post, $this->lang->continue, $this->sets['loc_of_board'] . 'index.php?a=spam_control' );

		$svars = json_decode( $spam['spam_svars'], true );

		$user = $this->db->query( "SELECT user_name, FROM %pusers WHERE user_id=%d", $spam['spam_author'] );

		// Setup and deliver the information to flag this comment as legit with Akismet.
		require_once $this->sets['include_path'] . '/lib/akismet.php';
		$akismet = new Akismet( $this );
		$akismet->set_comment_author( $user['user_name'] );
		$akismet->set_comment_content( $spam['spam_text'] );
		$akismet->set_comment_ip( $spam['spam_ip'] );
		$akismet->set_comment_referrer( $svars['HTTP_REFERER'] );
		$akismet->set_comment_useragent( $svars['HTTP_USER_AGENT'] );
		$akismet->set_comment_type( 'forum-post' );
		$akismet->set_comment_time( $spam['spam_time'] );

		$akismet->submit_ham();

		$this->db->query( "INSERT INTO %pposts (post_topic, post_author, post_text, post_time, post_emojis, post_bbcode, post_count, post_ip, post_icon, post_referrer, post_agent)
			VALUES (%d, %d, '%s', %d, %d, %d, %d, '%s', '%s', '%s', '%s')",
			$spam['spam_topic'], $spam['spam_author'], $spam['spam_text'], $spam['spam_time'], $spam['spam_emojis'], $spam['spam_bbcode'], $spam['spam_count'], $spam['spam_ip'], $spam['spam_icon'], $svars['HTTP_REFERER'], $svars['HTTP_USER_AGENT'] );
		$post_id = $this->db->insert_id( "posts" );

		$this->db->query( "UPDATE %ptopics SET topic_last_post=%d WHERE topic_id=%d", $post_id, $spam['spam_topic'] );

		if( $spam['spam_count'] ) {
			$this->db->query( "UPDATE %pusers SET user_posts=user_posts+1' WHERE user_id=%d", $spam['spam_author'] );
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

	private function display_spam()
	{
		$result = $this->db->query( "SELECT spam_id, spam_topic, spam_author, spam_text, spam_time, spam_ip FROM %pspam ORDER BY spam_time" );

		$xtpl = new XTemplate( './skins/' . $this->skin . '/spam_control.xtpl' );

		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'spam_controls', $this->lang->spam_controls );
		$xtpl->assign( 'spam_message1', $this->lang->spam_message1 );
		$xtpl->assign( 'spam_message2', $this->lang->spam_message2 );
		$xtpl->assign( 'spam_not_spam', $this->lang->spam_not_spam );
		$xtpl->assign( 'delete', $this->lang->delete );

		$xtpl->assign( 'token', $this->generate_token() );

		if( $this->perms->auth( 'is_admin' ) ) {
			$xtpl->assign( 'spam_clear_all', $this->lang->spam_clear_all );

			$xtpl->parse( 'SpamControl.ClearAll' );
		}

		$xtpl->assign( 'spam_action', $this->lang->spam_action );
		$xtpl->assign( 'topic', $this->lang->topic );
		$xtpl->assign( 'spam_author', $this->lang->spam_author );
		$xtpl->assign( 'lang_date', $this->lang->date );
		$xtpl->assign( 'spam_text', $this->lang->spam_text );

		while( $spam = $this->db->nqfetch( $result ) )
		{
			$ham_link = $this->sets['loc_of_board'] . '/index.php?a=spam_control&amp;s=report_ham&amp;c=' . $spam['spam_id'];
			$delete_link = $this->sets['loc_of_board'] . '/index.php?a=spam_control&amp;s=delete_spam&amp;c=' . $spam['spam_id'];

			$topic = $this->db->fetch( "SELECT topic_id, topic_title FROM %ptopics WHERE topic_id=%d", $spam['spam_topic'] );
			$user = $this->db->fetch( "SELECT user_id, user_name FROM %pusers WHERE user_id=%d", $spam['spam_author'] );

			$title = $this->format( $topic['topic_title'], FORMAT_HTMLCHARS );

			$author = $this->format( $user['user_name'], FORMAT_HTMLCHARS );

			$text = ( ( strlen( $spam['spam_text'] ) > 1000 ) ) ? ( substr( $spam['spam_text'], 0, 996 ) . ' ...' ) : $spam['spam_text'];
			$text = $this->format( $text, FORMAT_HTMLCHARS );

			$date = $this->mbdate( DATE_LONG, $spam['spam_time'] );

			$xtpl->assign( 'ham_link', $ham_link );
			$xtpl->assign( 'delete_link', $delete_link );
			$xtpl->assign( 'tid', $topic['topic_id'] );
			$xtpl->assign( 'title', $title );
			$xtpl->assign( 'uid', $user['user_id'] );
			$xtpl->assign( 'author', $author );
			$xtpl->assign( 'link_author', $this->clean_url( $author ) );
			$xtpl->assign( 'ip', $spam['spam_ip'] );
			$xtpl->assign( 'date', $date );
			$xtpl->assign( 'text', $text );

			$xtpl->parse( 'SpamControl.Entry' );
		}

		$xtpl->parse( 'SpamControl' );
		return $xtpl->text( 'SpamControl' );
	}
}
?>