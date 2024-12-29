<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2025 The QSF Portal Development Team
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

require_once $set['include_path'] . '/lib/tool.php';

/**
 * Forum related utilities
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @since 1.2
 **/
 class forumutils extends tool
 {
   private $qsf;
   private $db;
   private $sets;
   private $perms;
   private $forum_data;	// Array of forum forum_id, forum_parent, forum_tree, forum_name, forum_position

	/**
	 * Constructor. Initalise the read marker for guest (cookie and session)
	 * or user (readmark table)
	 *
	 * @param $qsf - Quicksilver Forums module
	 **/
	public function __construct( &$qsf )
	{
		static $forum_data = false;

		$this->qsf = &$qsf;
		$this->db  = &$qsf->db;
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
	public function get_forum( $forum_id )
	{
		$allForums = $this->forum_grab();

		foreach( $allForums as $row )
		{
			if( $row['forum_id'] == $forum_id ) {
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
	public function forum_array( $array, $parent )
	{
		$arr = array();
		for( $i = 0; $i < count( $array ); $i++ )
		{
			if( $array[$i]['forum_parent'] == $parent ) {
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
	public function forum_grab()
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
	public function forum_grab_sorted()
	{
		$forums = $this->forum_grab();
		$forumData = array();

		foreach( $forums as $f ) {
			if( $this->perms->auth( 'forum_view', $f['forum_id'] ) ) {
				$forumData[$f['forum_id']] = $f;
			}
		}
		ksort( $forumData );

		return $forumData;
	}

	/**
	 * Get a list of forums the user can view
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return string comma delimited list for us in SQL
	 **/
	public function create_forum_permissions_string()
	{
		$forums = array();
		$allForums = $this->forum_grab();

		foreach( $allForums as $row )
		{
			if( $this->perms->auth( 'forum_view', $row['forum_id'] ) && $this->perms->auth( 'topic_view', $row['forum_id'] ) )
			{
				$forums[] = $row['forum_id'];
			}
		}
		return implode( ', ', $forums );
	}

	/**
	 * Load the forum data into a static array so we don't have to run
	 * multiple queries for the same data
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2.0
	 **/
	private function _load_forum_data()
	{
		if( $this->forum_data === false ) {
			$this->forum_data = array();

			$q = $this->db->query( 'SELECT forum_id, forum_parent, forum_tree, forum_name, forum_position FROM %pforums ORDER BY forum_position' );

			while( $f = $this->db->nqfetch( $q ) )
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
	public function delete_topic( $t )
	{
		$stmt = $this->db->prepare_query( 'SELECT DISTINCT t.topic_forum, t.topic_id, a.attach_file, p.post_author, p.post_id, p.post_count
			FROM (%ptopics t, %pposts p)
			LEFT JOIN %pattach a ON p.post_id=a.attach_post
			WHERE t.topic_id=? AND t.topic_id=p.post_topic' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $posts = $stmt->get_result();
      $stmt->close();

		$deleted = -1;

      $user_query = $this->db->prepare_query( 'UPDATE %pusers SET user_posts=user_posts-1 WHERE user_id=?' );
      $user_query->bind_param( 'i', $user_id );

      $attach_query = $this->db->prepare_query( 'DELETE FROM %pattach WHERE attach_post=?' );
      $attach_query->bind_param( 'i', $attach_id );

		while( $post = $this->db->nqfetch( $posts ) )
		{
			if( $post['post_count'] ) {
            $user_id = $post['post_author'];
            $this->db->execute_query( $user_query );
			}

			if( $post['attach_file'] ) {
            $attach_id = $post['post_id'];
            $this->db->execute_query( $attach_query );

				@unlink( './attachments/' . $post['attach_file'] );
			}

			$deleted++;
		}
      $user_query->close();
      $attach_query->close();

		$stmt = $this->db->prepare_query( 'SELECT topic_forum FROM %ptopics WHERE topic_id=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $topic = $this->db->nqfetch( $result );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %pvotes WHERE vote_topic=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %ptopics WHERE topic_id=? OR topic_moved=?' );

      $stmt->bind_param( 'ii', $t, $t );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %pposts WHERE post_topic=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %preadmarks WHERE readmark_topic=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$this->update_reply_count( $topic['topic_forum'], $deleted );

		// Update all parent forums if any
		$stmt = $this->db->prepare_query( 'SELECT forum_tree FROM %pforums WHERE forum_id=?' );

      $stmt->bind_param( 'i', $topic['topic_forum'] );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $forums = $this->db->nqfetch( $result );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %pforums SET forum_topics=forum_topics-1	WHERE forum_parent > 0 AND forum_id IN (?) OR forum_id=?' );

      $stmt->bind_param( 'si', $forums['forum_tree'], $topic['topic_forum'] );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$this->update_last_post( $topic['topic_forum'] );

		$this->sets['posts'] -= ( $deleted + 1 );
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
	public function delete_post( $p )
	{
		$stmt = $this->db->prepare_query( 'SELECT t.topic_forum, t.topic_id, t.topic_replies, a.attach_file, p.post_author, p.post_count, u.user_posts
			FROM (%ptopics t, %pposts p, %pusers u)
			LEFT JOIN %pattach a ON p.post_id=a.attach_post
			WHERE p.post_id=? AND t.topic_id=p.post_topic AND u.user_id=p.post_author' );

      $stmt->bind_param( 'i', $p );
      $this->db->execute_query( $stmt );

      $tresult = $stmt->get_result();
      $result = $this->db->nqfetch( $tresult );
      $stmt->close();

      // If the topic has only one post, run this through topic deletion instead. That will remove all the relevant data.
      if( $result['topic_replies'] == 0 ) {
         $this->delete_topic( $result['topic_id'] );
         return;
      }

		$stmt = $this->db->prepare_query( 'UPDATE %pforums SET forum_replies=forum_replies-1 WHERE forum_id=?' );

      $stmt->bind_param( 'i', $result['topic_forum'] );
      $this->db->execute_query( $stmt );
      $stmt->close();

      $stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_replies=topic_replies-1 WHERE topic_id=?' );

      $stmt->bind_param( 'i', $result['topic_id'] );
      $this->db->execute_query( $stmt );
      $stmt->close();

		if( $result['post_count'] ) {
			$posts = $result['user_posts'] - 1;

			if( $posts < 0 ) {
				$posts = 0;
			}
			$stmt = $this->db->prepare_query( 'UPDATE %pusers SET user_posts=%d WHERE user_id=?' );

         $stmt->bind_param( 'ii', $posts, $result['post_author'] );
         $this->db->execute_query( $stmt );
         $stmt->close();
		}

		$stmt = $this->db->prepare_query( 'DELETE FROM %pposts WHERE post_id=?' );

      $stmt->bind_param( 'i', $p );
      $this->db->execute_query( $stmt );
      $stmt->close();

		if( $result['attach_file'] ) {
			$this->db->prepare_query( 'DELETE FROM %pattach WHERE attach_post=?' );

         $stmt->bind_param( 'i', $p );
         $this->db->execute_query( $stmt );
         $stmt->close();

			@unlink( './attachments/' . $result['attach_file'] );
		}

		$this->update_last_post( $result['topic_forum'] );
		$this->update_last_post_topic( $result['topic_id'] );
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
	public function update_last_post( $f )
	{
		/* update any parent forums */
		$stmt = $this->db->prepare_query( 'SELECT forum_tree FROM %pforums WHERE forum_id=?' );

      $stmt->bind_param( 'i', $f );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $forums = $this->db->nqfetch( $result );
      $stmt->close();

		if( isset( $forums['forum_tree'] ) && 0 != strlen( $forums['forum_tree'] ) )
		{
			$wip = explode( ',', $forums['forum_tree'] );

			foreach( $wip as $fid )
			{
				$fid = intval( $fid );

				/* handle weird cases */
				if( 0 == $fid )
					continue;

				$this->_update_last_post( $fid );
			}
		}

		/* update the specified forum */
		$this->_update_last_post( $f );
	}

	private function _update_last_post( $f )
	{
		$stmt = $this->db->prepare_query( 'SELECT p.post_id FROM (%pposts p, %ptopics t)
			WHERE t.topic_id=p.post_topic AND t.topic_forum=?
			ORDER BY t.topic_edited DESC, p.post_id DESC	LIMIT 1' );

      $stmt->bind_param( 'i', $f );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $post = $this->db->nqfetch( $result );
      $stmt->close();

		if( !isset( $post['post_id'] ) ) {
			$post['post_id'] = 0;
		}

		$stmt = $this->db->prepare_query( 'UPDATE %pforums SET forum_lastpost=? WHERE forum_id=?' );

      $stmt->bind_param( 'ii', $post['post_id'], $f );
      $this->db->execute_query( $stmt );
      $stmt->close();

	}

	/**
	 * Updates the last post of a topic
	 *
	 * @param int $t Topic ID
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.1.1
	 * @return void
	 **/
	public function update_last_post_topic( $t )
	{
		$stmt = $this->db->prepare_query( 'SELECT p.post_id, p.post_author, p.post_time
			FROM %pposts p, %ptopics t
			WHERE p.post_topic=t.topic_id AND t.topic_id=?
			ORDER BY p.post_time DESC LIMIT 1' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $last = $this->db->nqfetch( $result );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_last_post=?, topic_last_poster=?, topic_edited=? WHERE topic_id=?' );

      $stmt->bind_param( 'iiii', $last['post_id'], $last['post_author'], $last['post_time'], $t );
      $this->db->execute_query( $stmt );
      $stmt->close();
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
	private function update_reply_count( $f, $ammount, $topic = 0 )
	{
		if( 0 == $ammount && 0 == $topic ) // nothing to do
			return;

		/* decrement the parent forums */
		$stmt = $this->db->prepare_query( 'SELECT forum_tree FROM %pforums WHERE forum_id=?' );

      $stmt->bind_param( 'i', $f );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $forums = $this->db->nqfetch( $result );
      $stmt->close();

		if( isset( $forums['forum_tree'] ) && 0 != strlen( $forums['forum_tree'] ) )
		{
			$wip = explode( ',', $forums['forum_tree'] );

			array_push( $wip, $f );

         $replies_query = $this->db->prepare_query( 'UPDATE %pforums SET forum_replies=forum_replies-? WHERE forum_id=?' );
         $replies_query->bind_param( 'ii', $ammount, $fid );

         $topics_query = $this->db->prepare_query( 'UPDATE %pforums SET forum_topics=forum_topics-? WHERE forum_id=?' );
         $topics_query->bind_param( 'ii', $topic, $fid );

			foreach( $wip as $fid )
			{
				$fid = intval( $fid );

				if( 0 == $fid )
					continue;

            $this->db->execute_query( $replies_query );

				if( 0 != $topic )
               $this->db->execute_query( $topics_query );
			}
         $replies_query->close();
         $topics_query->close();
		}
	}

	public function update_count_move( $f_from, $f_to, $ammount )
	{
		$this->update_reply_count( $f_from, $ammount,  1 );
		$this->update_reply_count( $f_to, 0 - $ammount, -1 );
	}
}
?>