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
 * https://github.com/Arthmoor/Quicksilver-Forums
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

/**
 * RSS Feed Generator
 *
 * @author Kristopher Powell <klpowell@trenden.net>
 * @author Roger Libiez [Samson] 
 * @since 1.1.5
 **/
class rssfeed extends qsfglobal
{
	private $cat_data;

	/**
	 * Main interface. Get a RSS feed of posts
	 *
	 * @since 1.1.5
	 * @return string rss output
	 **/
	function execute()
	{
		$this->nohtml = true;

		$this->cat_data = false;

		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();
			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				($this->perms->is_guest) ? sprintf( $this->lang->board_regfirst, $this->site ) : $this->lang->board_noview
			);
		}

		$feed = null;

		$this->link = "{$this->site}/index.php?a=rssfeed";

		if( isset( $this->get['f'] ) ) {
			$f = intval( $this->get['f'] );

			$this->link .= "&amp;f=$f";

			if( !$this->perms->auth( 'forum_view', $f ) ) {
				return $this->rss_error_message( $this->lang->rssfeed_cannot_read_forum );
			}

			$feed = $this->generate_forum_feed( $f );
		} else if( isset( $this->get['t'] ) ) {
			$t = intval( $this->get['t'] );

			$this->link .= "&amp;t=$t";

			$feed = $this->generate_topic_feed( $t );
		} else if( isset( $this->get['files'] ) ) {
			$feed = $this->generate_files_feed();
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
	 * Display an error in a format acceptable for an RSS reader
	 *
	 * @param string $error The error message to display
	 * @since 1.1.9
	 * @return string rss output
	 **/
	function rss_error_message( $error )
	{
		$xtpl = new XTemplate( './skins/' . $this->skin . '/rssfeed.xtpl' );

		$title = "{$this->sets['rss_feed_title']} - {$this->lang->rssfeed_error}";
		$xtpl->assign( 'title', htmlspecialchars( $title ) );

		$xtpl->assign( 'link', $this->link );
		$xtpl->assign( 'error', htmpspecialchars( $error ) );
		$xtpl->assign( 'language', $this->user['user_language'] );
		$xtpl->assign( 'generator', htmlspecialchars( $this->sets['forum_name'] ) );
		$xtpl->assign( 'ttl', $this->sets['rss_feed_time'] );

		$xtpl->parse( 'RSSFeedError' );

		Header( 'Content-type: text/xml', 1 );
		return $xtpl->text( 'RSSFeedError' );
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
		
		$query = $this->db->query( "SELECT t.topic_id, t.topic_title, t.topic_forum, p.post_id, p.post_time, p.post_text, u.user_name, u.user_email, u.user_email_show
			FROM %ptopics t, %pposts p, %pusers u
			WHERE t.topic_forum IN (%s) AND t.topic_modes & %d AND p.post_topic = t.topic_id AND u.user_id = p.post_author
			ORDER BY p.post_time DESC LIMIT %d", $forums_str, TOPIC_PUBLISH, $this->sets['rss_feed_posts'] );

		$xtpl = new XTemplate( './skins/' . $this->skin . '/rssfeed.xtpl' );

		$xtpl->assign( 'title', htmlspecialchars( $this->sets['rss_feed_title'] ) );
		$xtpl->assign( 'link', $this->link );
		$xtpl->assign( 'description', htmlspecialchars( $this->sets['rss_feed_desc'] ) );
		$xtpl->assign( 'language', $this->user['user_language'] );
		$xtpl->assign( 'generator', htmlspecialchars( $this->sets['forum_name'] ) );
		$xtpl->assign( 'ttl', $this->sets['rss_feed_time'] );

		while( $row = $this->db->nqfetch( $query ) )
		{
			$this->get_post( $row, $xtpl, 'RSSFeedFull' );
		}

		$xtpl->parse( 'RSSFeedFull' );

		Header( 'Content-type: text/xml', 1 );
		return $xtpl->text( 'RSSFeedFull' );
	}

	/**
	 * Get a RSS feed of posts for a specific forum
	 *
	 * @param int $forum id number of the forum to fetch
	 * @since 1.1.9
	 * @return string rss output
	 **/
	function generate_forum_feed( $forum )
	{
		$exists = $this->db->fetch( "SELECT forum_parent, forum_name, forum_description, forum_subcat FROM %pforums WHERE forum_id=%d", $forum );

		if( !isset( $exists['forum_parent'] ) || !$exists['forum_parent'] || $exists['forum_subcat'] ) {
			return $this->rss_error_message( $this->lang->rssfeed_cannot_find_forum );
		}

		$xtpl = new XTemplate( './skins/' . $this->skin . '/rssfeed.xtpl' );

		$rss_title_block = htmlspecialchars( $this->sets['rss_feed_title'] . ' - ' . $this->lang->rssfeed_forum . ' ' . $exists['forum_name'] );
		$xtpl->assign( 'title', $rss_title_block );

		$xtpl->assign( 'link', $this->link );

		$rss_desc_block = htmlspecialchars( $this->sets['rss_feed_desc'] . ' - ' . $exists['forum_description'] );
		$xtpl->assign( 'description', $rss_desc_block );

		$xtpl->assign( 'language', $this->user['user_language'] );
		$xtpl->assign( 'generator', htmlspecialchars( $this->sets['forum_name'] ) );
		$xtpl->assign( 'ttl', $this->sets['rss_feed_time'] );

		$query = $this->db->query( "SELECT t.topic_id, t.topic_title, t.topic_forum, p.post_id, p.post_time, p.post_text, u.user_name, u.user_email, u.user_email_show
			FROM %ptopics t, %pposts p, %pusers u
			WHERE t.topic_forum = %d AND t.topic_modes & %d AND p.post_topic = t.topic_id AND u.user_id = p.post_author
			ORDER BY p.post_time DESC
			LIMIT %d",
			$forum, TOPIC_PUBLISH, $this->sets['rss_feed_posts'] );
			
		while( $row = $this->db->nqfetch( $query ) )
		{
			$this->get_post( $row, $xtpl, 'RSSFeedForum' );
		}

		$xtpl->parse( 'RSSFeedForum' );

		Header( 'Content-type: text/xml', 1 );
		return $xtpl->text( 'RSSFeedForum' );
	}

	/**
	 * Get a RSS feed of posts for a specific topic
	 *
	 * @param int $topic id number of the topic to fetch
	 * @since 1.1.9
	 * @return string rss output
	 **/
	function generate_topic_feed( $topic )
	{
		$topicdata = $this->db->fetch( "SELECT t.topic_title, t.topic_description, t.topic_modes, t.topic_starter, t.topic_forum, t.topic_replies, t.topic_poll_options, f.forum_name
			FROM %ptopics t, %pforums f
			WHERE t.topic_id=%d AND f.forum_id=t.topic_forum", $topic );

		if( !$topicdata ) {
			return $this->rss_error_message( $this->lang->rssfeed_cannot_find_topic );
		}

		if( !$this->perms->auth( 'topic_view', $topicdata['topic_forum'] ) ) {
			return $this->rss_error_message( $this->lang->rssfeed_cannot_read_topic );
		}

		$xtpl = new XTemplate( './skins/' . $this->skin . '/rssfeed.xtpl' );

		$title = "{$this->sets['rss_feed_title']} - {$this->lang->rssfeed_topic} {$topicdata['topic_title']}";
		$xtpl->assign( 'title', htmlspecialchars( $title ) );

		$xtpl->assign( 'link', $this->link );

		$description = "{$this->sets['rss_feed_desc']} - {$topicdata['topic_description']}";
		$xtpl->assign( 'description', htmlspecialchars( $description ) );

		$xtpl->assign( 'language', $this->user['user_language'] );
		$xtpl->assign( 'generator', htmlspecialchars( $this->sets['forum_name'] ) );
		$xtpl->assign( 'ttl', $this->sets['rss_feed_time'] );

		$query = $this->db->query( "SELECT t.topic_id, t.topic_title, t.topic_forum, p.post_id, p.post_time, p.post_text, u.user_name, u.user_email, u.user_email_show
			FROM %ptopics t, %pposts p, %pusers u
			WHERE t.topic_id = %d AND p.post_topic = t.topic_id AND	u.user_id = p.post_author ORDER BY p.post_time DESC LIMIT %d", $topic, $this->sets['rss_feed_posts'] );

		while( $row = $this->db->nqfetch( $query ) )
		{
			$this->get_post( $row, $xtpl, 'RSSFeedTopic' );
		}

		$xtpl->parse( 'RSSFeedTopic' );

		Header( 'Content-type: text/xml', 1 );
		return $xtpl->text( 'RSSFeedTopic' );
	}

	function remove_breaks( $in )
	{
		return preg_replace( "/(<br\s*\/?>\s*)+/", ' ', $in );
	}

	/**
	 * Get the rss information for a single item
	 *
	 * @param array $query_row query information for the post
	 *	topic_id, topic_title, post_time, post_text and user_name
	 * @since 1.1.9
	 * @return string rss item output
	 **/
	function get_post( $query_row, $xtpl, $block )
	{
		$item_title = $this->format( $query_row['topic_title'], FORMAT_CENSOR );
		$item_title = htmlspecialchars( $item_title );
		$xtpl->assign( 'item_title', $item_title );

		$item_link = "{$this->site}/index.php?a=topic&amp;t={$query_row['topic_id']}&amp;p={$query_row['post_id']}#p{$query_row['post_id']}";
		$xtpl->assign( 'item_link', $item_link );

		$item_desc = substr( $query_row['post_text'], 0, 500 );
		$item_desc = $this->format( $item_desc, FORMAT_CENSOR );
		$item_desc = $this->remove_breaks( $item_desc );
		$item_desc = htmlspecialchars( $item_desc );
		$xtpl->assign( 'item_desc', $item_desc );

		$pubdate = $this->mbdate( DATE_ISO822, $query_row['post_time'], false );
		$xtpl->assign( 'pubdate', $pubdate );

		$forum_name = 'Unknown';
		$forum = $this->readmarker->get_forum( $query_row['topic_forum'] );
		if( $forum != null ) $forum_name = htmlspecialchars( $forum['forum_name'] );
		$xtpl->assign( 'forum_name', $forum_name );

		$user_email = '';
		if( $query_row['user_email_show'] ) {
			$user_email .= $query_row['user_email'];
		} else {
			$user_email .= 'nobody@example.com';
		}
		$user_email .= ' (';
		$user_email .= $this->format( $query_row['user_name'], FORMAT_CENSOR );
		$user_email .= ')';
		$user_email = htmlspecialchars( $user_email );
		$xtpl->assign( 'user_email', $user_email );

		$xtpl->parse( "$block.Item" );
		return $xtpl->text( "$block.Item" );
	}

	/**
	 * Get a RSS feed of recent files uploaded to the site
	 *
	 * @since 1.4.3
	 * @return string rss output
	 **/
	function generate_files_feed()
	{
		$cat_str = $this->create_category_permissions_string();

		if( $cat_str != '' ) {
			$query = $this->db->query( "SELECT f.file_id, f.file_name, f.file_description, f.file_date, c.fcat_id, c.fcat_name, u.user_name, u.user_email, u.user_email_show
			FROM %pfiles f, %pfile_categories c, %pusers u
			WHERE c.fcat_id IN (%s) AND f.file_catid = c.fcat_id AND u.user_id = f.file_submitted AND f.file_approved = 1
			ORDER BY f.file_date DESC	LIMIT %d", $cat_str, $this->sets['rss_feed_posts'] );

			$xtpl = new XTemplate( './skins/' . $this->skin . '/rssfeed.xtpl' );

			$xtpl->assign( 'title', htmlspecialchars( $this->sets['rss_feed_title'] ) );

			$xtpl->assign( 'link', $this->link );
			$xtpl->assign( 'description', htmlspecialchars( $this->sets['rss_feed_desc'] ) );
			$xtpl->assign( 'language', $this->user['user_language'] );
			$xtpl->assign( 'generator', htmlspecialchars( $this->sets['forum_name'] ) );
			$xtpl->assign( 'ttl', $this->sets['rss_feed_time'] );

			while( $row = $this->db->nqfetch( $query ) )
			{
				$this->get_file( $row, $xtpl );
			}
		}

		$xtpl->parse( 'RSSFeedFile' );

		Header( 'Content-type: text/xml', 1 );
		return $xtpl->text( 'RSSFeedFile' );
	}

	/**
	 * Get the rss information for a single item
	 *
	 * @param array $query_row query information for the file
	 *	topic_id, topic_title, post_time, post_text and user_name
	 * @since 1.4.3
	 * @return string rss item output
	 **/
	function get_file( $query_row, $xtpl )
	{
		$item_title = $this->format( $query_row['file_name'], FORMAT_CENSOR );
		$item_title = $this->remove_breaks( $item_title );
		$xtpl->assign( 'item_title', htmlspecialchars( $item_title ) );

		$fid = $query_row['file_id'];
		$furl = $this->clean_url( $item_title );

		$item_link = "{$this->site}/files/{$furl}-{$fid}/";
		$xtpl->assign( 'item_link', $item_link );

		$item_desc = substr( $query_row['file_description'], 0, 500 );
		$item_desc = $this->format( $item_desc, FORMAT_CENSOR );
		$item_desc = $this->remove_breaks( $item_desc );
		$xtpl->assign( 'item_desc', htmlspecialchars( $item_desc ) );

		$pubdate = $this->mbdate( DATE_ISO822, $query_row['file_date'], false );
		$xtpl->assign( 'pubdate', $pubdate );

		$cat_name = $this->format( $query_row['fcat_name'], FORMAT_CENSOR );
		$cat_name = $this->remove_breaks( $cat_name );
		$xtpl->assign( 'cat_name', htmlspecialchars( $cat_name ) );

		$user_email = '';
		if( $query_row['user_email_show'] ) {
			$user_email .= $query_row['user_email'];
		} else {
			$user_email .= 'nobody@example.com';
		}
		$user_email .= ' (';
		$user_email .= $this->format( $query_row['user_name'], FORMAT_CENSOR );
		$user_email .= ')';
		$xtpl->assign( 'user_email',  htmlspecialchars( $user_email ) );

		$xtpl->parse( 'RSSFeedFile.Item' );
		return $xtpl->text( 'RSSFeedFile.Item' );
	}

	/**
	 * Get a list of forums the user can view
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.4.3
	 * @return string comma delimited list for us in SQL
	 **/
	function create_category_permissions_string()
	{
		$categories = array();
		$allCats = $this->_load_cat_data();

		foreach( $allCats as $row )
		{
			if( $this->file_perms->auth( 'category_view', $row['fcat_id'] ) )
			{
				$categories[] = $row['fcat_id'];
			}
		}
		return implode( ', ', $categories );
	}

	/**
	 * Load the forum data into a static array so we don't have to run
	 * multiple queries for the same data
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.4.3
	 **/
	function _load_cat_data()
	{
		if( $this->cat_data === false ) {
			$this->cat_data = array();

			$q = $this->db->query( "SELECT * FROM %pfile_categories" );

			while( $f = $this->db->nqfetch( $q ) )
			{
				$this->cat_data[] = $f;
			}
		}
		return $this->cat_data;
	}
}
?>