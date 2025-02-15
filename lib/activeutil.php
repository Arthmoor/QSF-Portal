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
	header('HTTP/1.0 403 Forbidden');
	die;
}

/**
 * Contains handler for tracking and fetching active users
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @since 1.2
 **/
class activeutil extends forumutils
{
   private $db;
   private $get;
   private $user_id;
   private $time;
   private $ip;
   private $agent;
   private $site;
   private $bbcode;
   private $sets;
   private $perms;
   private $user;
   private $qsf;
   private $htmlwidgets;
	private $activeUsers    = array();
	private $doneUpdate     = false;
	private $totalGuests    = 0; // Total guest users online
	private $totalMembers   = 0; // Total members online

	private $sessionid = null;

	/**
	 * Constructor
	 *
	 * @param $qsf - Quicksilver Forums module
	 **/
	public function __construct( &$qsf )
	{
		parent::__construct( $qsf );

      $this->db = &$qsf->db;
		$this->get = &$qsf->get;
		$this->user_id = &$qsf->user['user_id'];
		$this->time = &$qsf->time;
		$this->ip = &$qsf->ip;
		$this->agent = &$qsf->agent;
		$this->site = &$qsf->site;
		$this->bbcode = &$qsf->bbcode;
      $this->sets = &$qsf->sets;
      $this->perms = &$qsf->perms;
      $this->user = &$qsf->user;
      $this->htmlwidgets = &$qsf->htmlwidgets;
      $this->qsf = &$qsf;

		$this->sessionid = session_id();
	}

	/**
	 * Update our active user table
	 *
	 * @param string $action Modual we have displayed
	 * @param integer $user_id User who are logged in as
	 **/
	public function update( $action, $userid = USER_GUEST_UID )
	{
		if( !$this->doneUpdate ) {
			$item = $this->_get_item( $action );

			if( $item >= 0 && $item < 4000000000 ) {
				$stmt = $this->db->prepare_query( 'REPLACE INTO %pactive (active_id, active_action, active_item, active_time, active_ip, active_user_agent, active_session) VALUES( ?, ?, ?, ?, ?, ?, ? )' );

            $stmt->bind_param( 'isiisss', $userid, $action, $item, $this->time, $this->ip, $this->agent, $this->sessionid );
            $this->db->execute_query( $stmt );
            $stmt->close();
			}

			$this->purge_unvalidated_users();

			$this->doneUpdate = true; // Flag to make sure we only call once
		}
	}

	/**
	 * Remove the active entry for a member when logging out or being deleted
	 *
	 * @param integer $user_id User who are logged in as
	 **/
	public function delete( $userid )
	{
		$stmt = $this->db->prepare_query( 'DELETE FROM %pactive WHERE active_id=?' );

      $stmt->bind_param( 'i', $userid );
      $this->db->execute_query( $stmt );
      $stmt->close();

		if( $userid == $this->user_id )
			$this->user_id = USER_GUEST_UID;
	}

	/**
	 * Get the full active data information
	 *
	 * @return array Full information on active users, links, and their actions
	 **/
	public function get_active()
	{
		$this->_load_active_users();
		return $this->activeUsers;
	}

	/**
	 * Returns a total number for members on the site
	 *
	 * @return integer Total count for members active on the site
	 **/
	public function get_members_online()
	{
		$this->_load_active_users();
		return $this->totalMembers;
	}

	/**
	 * Returns a total number for guests
	 *
	 * @return integer Total count for guests active on the site
	 **/
	public function get_guests_online()
	{
		$this->_load_active_users();
		return $this->totalGuests;
	}

	/**
	 * Returns a total number for active users and guests
	 *
	 * @return integer Total count for people active on the site
	 **/
	public function get_users_online()
	{
		return $this->get_members_online() + $this->get_guests_online();
	}

	/**
	 * Asks if a user is active and has allowed their activity to be shown
	 *
	 * @param integer $user_id User we want to check if they are online
	 * @return boolean True if the user is active
	 **/
	public function is_user_online( $user_id )
	{
		foreach( $this->get_active() as $active ) {
			if( $active['id'] == $user_id )
				return true;
		}
		return false;
	}

	/**
	 * Deletes all user accounts still in validating mode that are older than 10 days and have contributed no posts or uploads.
	 * This is a more than reasonable amount of time to validate an account in.
	 **/
	private function purge_unvalidated_users()
	{
		$expired = $this->time - ( 86400 * $this->sets['validation_purge_timeout'] ); // Defaults to 10 Days

		$stmt = $this->db->prepare_query( 'SELECT * FROM %pusers WHERE user_group=? AND user_joined < ? AND user_posts=0 AND user_uploads=0' );

      $user_group = intval( USER_AWAIT );
      $stmt->bind_param( 'ii', $user_group, $expired );
      $this->db->execute_query( $stmt );

      $query = $stmt->get_result();
      $stmt->close();

      $user_query = $this->db->prepare_query( 'DELETE FROM %pusers WHERE user_id=?' );
      $user_query->bind_param( 'i', $id );

      $log_query = $this->db->prepare_query( 'DELETE FROM %plogs WHERE log_user=?' );
      $log_query->bind_param( 'i', $id );

      $file_comment_query = $this->db->prepare_query( 'DELETE FROM %pfilecomments WHERE user_id=?' );
      $file_comment_query->bind_param( 'i', $id );

      $subs_query = $this->db->prepare_query( 'DELETE FROM %psubscriptions WHERE subscription_user=?' );
      $subs_query->bind_param( 'i', $id );

      $votes_query = $this->db->prepare_query( 'DELETE FROM %pvotes WHERE vote_user=?' );
      $votes_query->bind_param( 'i', $id );

      $file_ratings_query = $this->db->prepare_query( 'DELETE FROM %pfileratings WHERE user_id=?' );
      $file_ratings_query->bind_param( 'i', $id );

      $pmsystem_to_query = $this->db->prepare_query( 'DELETE FROM %ppmsystem WHERE pm_to=?' );
      $pmsystem_to_query->bind_param( 'i', $id );

      $pmsystem_from_query = $this->db->prepare_query( 'DELETE FROM %ppmsystem WHERE pm_from=?' );
      $pmsystem_from_query->bind_param( 'i', $id );

      $readmark_query = $this->db->prepare_query( 'DELETE FROM %preadmarks WHERE readmark_user=?' );
      $readmark_query->bind_param( 'i', $id );

      $conv_readmark_query = $this->db->prepare_query( 'DELETE FROM %pconv_readmarks WHERE readmark_user=?' );
      $conv_readmark_query->bind_param( 'i', $id );

		while( $user = $this->db->nqfetch( $query ) )
		{
			$id = $user['user_id'];

         $this->db->execute_query( $user_query );

         $this->db->execute_query( $log_query );

         $this->db->execute_query( $file_comment_query );

         $this->db->execute_query( $subs_query );

         $this->db->execute_query( $votes_query );

         $this->db->execute_query( $file_ratings_query );

         $this->db->execute_query( $pmsystem_to_query );

         $this->db->execute_query( $pmsystem_from_query );

         $this->db->execute_query( $readmark_query );

         $this->db->execute_query( $conv_readmark_query );
		}
      $user_query->close();
      $log_query->close();
      $file_comment_query->close();
      $subs_query->close();
      $votes_query->close();
      $file_ratings_query->close();
      $pmsystem_to_query->close();
      $pmsystem_from_query->close();
      $readmark_query->close();
      $conv_readmark_query->close();

		$member = $this->db->fetch( 'SELECT user_id, user_name FROM %pusers ORDER BY user_id DESC LIMIT 1' );
      $counts = $this->db->fetch( 'SELECT COUNT(user_id) AS count FROM %pusers' );

		$this->sets['last_member'] = $member['user_name'];
		$this->sets['last_member_id'] = $member['user_id'];
		$this->sets['members'] = $counts['count']-1;
		$this->qsf->write_sets();
	}

	/**
	 * Load enough data to be able to generate a list of active users and link to where they are
	 *
	 * PRIVATE
	 **/
	private function _load_active_users()
	{
		if( count( $this->activeUsers ) )
			return;

		$oldtime   = $this->time - 900;
		$botformat = '<i>%s</i>';

		$oldusers = array(); // Collect timed out users

		// Add self to top of list
		$this->update( $this->get['a'], $this->user_id );

		$query = $this->db->query( 'SELECT a.*, a.active_ip, u.user_name, u.user_active, g.group_format, f.forum_name, t.topic_title, t.topic_forum, u2.user_name AS profile_name
			FROM (%pactive a, %pgroups g, %pusers u)
			LEFT JOIN %pforums f ON f.forum_id=a.active_item
			LEFT JOIN %ptopics t ON t.topic_id=a.active_item
			LEFT JOIN %pusers u2 ON u2.user_id=a.active_item
			WHERE a.active_id = u.user_id AND u.user_group = g.group_id
			ORDER BY a.active_time DESC' );

		while( $user = $this->db->nqfetch( $query ) )
		{
			if( $user['active_time'] < $oldtime ) {
				$oldusers[] = $user['active_id'];
			} else {
				if( !$user['user_active'] && !$this->perms->auth( 'is_admin' ) ) {
					continue;
				}

				// Build up link
				$link = '';
				$name = '';
				$action_link = '';
				$forum = null;
				$topic = null;
				$is_bot = false;

				$title = ( !$this->perms->auth( 'post_viewip' ) ? null : $user['active_ip'] . ' --- ' ) . htmlspecialchars( $user['active_user_agent'] );

				if( $user['active_id'] != USER_GUEST_UID ) {
					if( $this->user['user_group'] != USER_GUEST && $this->user['user_group'] != USER_AWAIT ) {
						$link_name = $this->htmlwidgets->clean_url( $user['user_name'] );

						$link = "href=\"{$this->site}/profile/{$link_name}-{$user['active_id']}/\"";
					}
					else
						$link = '';

					$name = sprintf( $user['group_format'], $user['user_name'] );
					if( !$user['user_active'] ) {
						$name = sprintf( '<i>%s</i>', $name );
					}

					$this->totalMembers++;
				} else {
					$name = $user['user_name'];

					$spider_name = $this->_spider_check( $user['active_user_agent'] );
					if( $spider_name ) {
						$name = sprintf( $botformat, $spider_name );
						$is_bot = true;
					} else {
						$this->totalGuests++;
					}
				}

				switch( $user['active_action'] )
				{
				case 'newspost':
					$topic = $user['topic_forum'];
					$link_name = $this->htmlwidgets->clean_url( $user['topic_title'] );
					$action_link = "<a href='{$this->site}/newspost/{$link_name}-{$user['active_item']}/'>" . $this->bbcode->format( $user['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS ) . '</a>';
					break;

				case 'topic':
					if( $this->perms->auth( 'topic_view', $user['topic_forum'] ) || $this->perms->auth( 'forum_view', $user['topic_forum'] ) ) {
						$topic = $user['topic_forum'];
						$link_name = $this->htmlwidgets->clean_url( $user['topic_title'] );
						$action_link = "<a href='{$this->site}/topic/{$link_name}-{$user['active_item']}/'>" . $this->bbcode->format( $user['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS ) . '</a>';
					}
					break;

				case 'forum':
					if( $this->perms->auth( 'forum_view', $user['topic_forum'] ) ) {
						$forum = $user['topic_forum'];
						$link_name = $this->htmlwidgets->clean_url( $user['forum_name'] );
						$action_link = "<a href='{$this->site}/forum/{$link_name}-{$user['active_item']}/'>{$user['forum_name']}</a>";
					}
					break;

				case 'profile':
					$link_name = $this->htmlwidgets->clean_url( $user['profile_name'] );
					$action_link = "<a href='{$this->site}/profile/{$link_name}-{$user['active_item']}/'>{$user['profile_name']}</a>";
					break;
				}

				$this->activeUsers[] = array( 'id' => $user['active_id'], 'name' => $name, 'link' => $link, 'title' => $title,
					'action' => $user['active_action'], 'action_link' => $action_link, 'topic' => $topic, 'forum' => $forum,
					'time' => $user['active_time'], 'bot' => $is_bot );
			}
		}

		if( $oldusers ) {
         $old = implode( ', ', $oldusers );
			$stmt = $this->db->prepare_query( 'UPDATE %pusers SET user_lastvisit=? WHERE user_id IN ( ' . $old . ' )' );

         $stmt->bind_param( 'i',  $oldtime );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$stmt = $this->db->prepare_query( 'DELETE FROM %pactive WHERE active_time < ?' );

         $stmt->bind_param( 'i',  $oldtime );
         $this->db->execute_query( $stmt );
         $stmt->close();
		}
	}

	/**
	 * Checks to see if an active user is a Search Spider
	 *
	 * PRIVATE
	 *
	 * @author Matthew Wells <ragnarok@squarehybrid.com>
	 * @param string $user_agent User agent of the browser
	 * @since 1.1.5
	 * @return Spider Name / false
	 **/
	private function _spider_check( $user_agent )
	{
		$user_agent = strtolower( $user_agent );

		if( $this->sets['spider_active'] ) {
			foreach( array_keys( $this->sets['spider_name']) as $spiderstring ) {
				if( preg_match( "#($spiderstring)#is", $user_agent, $agent ) )
				{
					return $this->sets['spider_name'][$agent[1]];
				}
			}
		}
		return false;
	}

	/**
	 * Get an item id from the URL depending on the action
	 *
	 * PRIVATE
	 *
	 * @param string $action Module being run
	 * @return integer Identifier for the item being actioned (eg forum, topic, user)
	 **/
	private function _get_item( $action )
	{
		$item = 0;

		switch( $action )
		{
			case 'forum': $item = isset( $this->get['f'] ) ? intval( $this->get['f'] ) : 0; break;
			case 'topic': $item = isset( $this->get['t'] ) ? intval( $this->get['t'] ) : 0; break;
			case 'profile': $item = isset( $this->get['w'] ) ? intval( $this->get['w'] ) : 0; break;
			case 'newspost': $item = isset( $this->get['t'] ) ? intval( $this->get['t'] ) : 0; break;
		}
		return $item;
	}
}
?>