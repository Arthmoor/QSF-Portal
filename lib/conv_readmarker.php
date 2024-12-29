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

require_once $set['include_path'] . '/lib/forumutils.php';

/**
 * Will mark conversations as read and return what conversations are unread
 * or even what posts are unread
 *
 * @author Roger Libiez
 * @since 2.0
 * Derived from the original readmarks for topics.
 **/
class conv_readmarker extends forumutils
{
   private $db;
   private $time;
   private $day_in_seconds;
   private $last_cv_read_all;
	private $last_read_all = 0;           // Time beyond which all conversations are considered read
	private $readmarkers_loaded = false;  // Have we queried the database yet
	private $user_id;                     // What user ID should we use for any queries or updates
	private $readmarkers = array();       // Data for user as pulled from the database
	private $cleanupchance = false;       // Set to true if we want a cleanup operation done

	/**
	 * Constructor. Initalise the read marker for guest (cookie and session)
	 * or user (readmark table)
	 *
	 * @param $qsf - Quicksilver Forums module
	 **/
	public function __construct( &$qsf )
	{
		parent::__construct( $qsf );

      $this->db = &$qsf->db;
		$this->time = &$qsf->time;
		$this->day_in_seconds = 86400;

		// To initalise ourselves we need to look at the user - Guests don't have CVs to track.
		if( $qsf->perms->is_guest ) {
         return;
		}

		// Get the user ID and the lastallread value and prepare to
		if( $qsf->user['user_lastallread'] ) {
			$this->last_cv_read_all = $qsf->user['user_lastcvallread'];
		} elseif( isset( $qsf->cookie[$qsf->sets['cookie_prefix'] . 'lastcvallread'] ) ) {
			$this->last_cv_read_all = intval( $qsf->cookie[$qsf->sets['cookie_prefix'] . 'lastcvallread'] );
		} else {
			$this->last_cv_read_all = $this->time - $this->day_in_seconds;
		}

		$this->user_id = intval( $qsf->user['user_id'] );
	}

	/**
	 * A kind of deconstructor but not always run
	 *
	 * @author Roger Libiez
	 * @since 2.0
	 **/
	public function cleanup()
	{
		if( $this->cleanupchance && Rand( 1, 20 ) == 1 ) {
			$this->_cleanup_readmarks();
		}
	}

	/**
	 * Updates all records of all conversations, marking them as read
	 *
	 * @param int $time Time to mark all conversations as read to the time set
	 * @author Roger Libiez
	 * @since 2.0
	 **/
	public function mark_all_read( $time )
	{
		$time = intval( $time );

		if( $this->last_read_all >= $time )
			return; // Do Nothing

		$this->last_read_all = $time;

		// Clean out unneeded entries
		$stmt = $this->db->prepare_query( 'UPDATE %pusers SET user_lastcvallread=? WHERE user_id=?' );

      $stmt->bind_param( 'ii', $time, $this->user_id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->query( 'DELETE FROM %pconv_readmarks WHERE readmark_user=? AND readmark_lastread < ?' );

      $stmt->bind_param( 'ii', $this->user_id, $time );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$this->readmarkers_loaded = false;
	}

	/**
	 * Mark a conversation as read to the time set
	 *
	 * @param int $conv_id Conversation being read
	 * @param int $time Time of the newest post read
	 * @author Roger Libiez
	 * @since 2.0
	 **/
	public function mark_conv_read( $conv_id, $time )
	{
		$conv_id = intval( $conv_id );
		$time = intval( $time );

		if( $time >= $this->last_read_all ) {
			$this->_load_readmarkers();

			if( !isset( $this->readmarkers[$conv_id] ) || $this->readmarkers[$conv_id] < $time ) {
				$stmt = $this->db->prepare_query( 'REPLACE INTO %pconv_readmarks (readmark_user, readmark_conv, readmark_lastread) VALUES ( ?, ?, ? )' );

            $stmt->bind_param( 'iii', $this->user_id, $conv_id, $time );
            $this->db->execute_query( $stmt );
            $stmt->close();

				$this->readmarkers[$conv_id] = $time;
			}

			// There is a chance of running a cleanup
			$this->cleanupchance = true;
		}
	}

	/**
	 * Query what date was the conversation last read
	 *
	 * @param int $conv_id Conversation to check
	 * @author Roger Libiez
	 * @since 2.0
	 * @return date the topics was last read or all topics were read
	 **/
	public function conv_last_read( $conv_id )
	{
		$conv_id = intval( $conv_id );

		$last_post_time = $this->last_read_all;

		$this->_load_readmarkers();

		if( isset( $this->readmarkers[$conv_id] ) && $this->readmarkers[$conv_id] > $last_post_time ) {
			$last_post_time = $this->readmarkers[$conv_id];
		}
		return $last_post_time;
	}

	/**
	 * Check if there are unread posts in a conversation
	 *
	 * @param int $conv_id Conversation to check
	 * @param int $last_post_time Time of newest post in conversation
	 * @author Roger Libiez
	 * @since 2.0
	 * @return bool True if all posts within have been marked read
	 **/
	public function is_conv_read( $conv_id, $last_post_time )
	{
		$conv_id = intval( $conv_id );
		$last_post_time = intval( $last_post_time );

		if( $last_post_time < $this->last_read_all )
			return true;

		$this->_load_readmarkers();

		if( isset( $this->readmarkers[$conv_id] ) && $this->readmarkers[$conv_id] >= $last_post_time ) {
			return true;
		}
		return false;
	}

	/**
	 * Check if a post has been read
	 *
	 * @param int $conv_id Conversation to check
	 * @param int $post_time Time of newest post in conversation
	 * @author Roger Libiez
	 * @since 2.0
	 * @return bool True if post has been marked read
	 **/
	public function is_post_read( $conv_id, $post_time )
	{
		return $this->is_conv_read( $conv_id, $post_time );
	}

	/**
	 * Check if there are unread posts in conversations
	 *
	 * @author Roger Libiez
	 * @since 2.0
	 **/
	private function _load_readmarkers()
	{
		if( !$this->readmarkers_loaded ) {
			$this->readmarkers = array();

			$stmt = $this->db->prepare_query( 'SELECT * FROM %pconv_readmarks WHERE readmark_user=?' );

         $stmt->bind_param( 'i', $this->user_id );
         $this->db->execute_query( $stmt );

         $query = $stmt->get_result();
         $stmt->close();

			while( $mark = $this->db->nqfetch( $query ) )
			{
				$this->readmarkers[$mark['readmark_conv']] = $mark['readmark_lastread'];
			}
			$this->readmarkers_loaded = true;
		}
	}

	/**
	 * Deletes unneeded records from readmarks because they are for conversations
	 * that are older than the last time we've hit Mark All
	 *
	 * @author Roger Libiez
	 * @since 2.0
	 **/
	private function _cleanup_readmarks()
	{
		// Find the OLDEST unread post
		$stmt = $this->db->prepare_query( 'SELECT conv_id, conv_edited FROM %pconversations WHERE conv_edited > ? AND ? IN (conv_users)' );

      $stmt->bind_param( 'ii', $this->last_read_all, $this->user_id );
      $this->db->execute_query( $stmt );

      $query = $stmt->get_result();
      $stmt->close();

		$oldest_time = $this->time;

		while( $row = $this->db->nqfetch( $query ) )
		{
			if( $row['conv_edited'] < $oldest_time && !$this->is_conv_read( $row['conv_id'], $row['conv_edited'] ) )
			{
				$oldest_time = $row['conv_edited'];
			}
		}

		$this->mark_all_read( $oldest_time - 1 );
	}
}
?>