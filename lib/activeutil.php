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

require_once $set['include_path'] . '/lib/bbcode.php';

/**
 * Contains handler for tracking and fetching active users
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @since 1.2
 **/
class activeutil extends bbcode
{
	var $activeUsers    = array();
	var $doneUpdate     = false;
	var $totalGuests    = 0; // Total guest users online
	var $totalMembers   = 0; // Total members online
	
	var $sessionid = null;

	/**
	 * Constructor
	 *
	 * @param $qsf - Quicksilver Forums module
	 **/
	function activeutil(&$qsf)
	{
		parent::bbcode($qsf);
		
		$this->get = &$qsf->get;
		$this->user_id = $qsf->user['user_id'];
		$this->time = $qsf->time;
		$this->ip = $qsf->ip;
		$this->agent = $qsf->agent;
		$this->self = $qsf->self;
		if (isset($qsf->session['id'])) $this->sessionid = $qsf->session['id'];
	}

	/**
	 * Update our active user table
	 *
	 * @param string $action Modual we have displayed
	 * @param integer $user_id User who are logged in as
	 **/
	function update($action, $userid = USER_GUEST_UID)
	{
		if (!$this->doneUpdate) {
			$item = $this->_get_item($action);
	
			$this->db->query("REPLACE INTO %pactive (active_id, active_action, active_item, active_time, active_ip, active_user_agent, active_session) 
				VALUES (%d, '%s', %d, %d, INET_ATON('%s'), '%s', '%s')",
				$userid, $action, $item, $this->time, $this->ip, $this->agent, $this->sessionid);
			$this->doneUpdate = true; // Flag to make sure we only call once
		}
	}
	
	/**
	 * Remove the active entry for a member when logging out or being deleted
	 *
	 * @param integer $user_id User who are logged in as
	 **/
	function delete($userid)
	{
		$this->db->query("DELETE FROM %pactive WHERE active_id=%d", $userid);
		if ($userid == $this->user_id)
			$this->user_id = USER_GUEST_UID;
	}

	/**
	 * Get the full active data information
	 *
	 * @return array Full information on active users, links, and their actions
	 **/
	function get_active()
	{
		$this->_load_active_users();
		return $this->activeUsers;
	}
	
	/**
	 * Returns a total number for members on the site
	 *
	 * @return integer Total count for members active on the site
	 **/
	function get_members_online()
	{
		$this->_load_active_users();
		return $this->totalMembers;
	}
	
	/**
	 * Returns a total number for guests
	 *
	 * @return integer Total count for guests active on the site
	 **/
	function get_guests_online()
	{
		$this->_load_active_users();
		return $this->totalGuests;
	}

	/**
	 * Returns a total number for active users and guests
	 *
	 * @return integer Total count for people active on the site
	 **/
	function get_users_online()
	{
		return $this->get_members_online() + $this->get_guests_online();
	}
	
	/**
	 * Asks if a user is active and has allowed their activity to be shown
	 *
	 * @param integer $user_id User we want to check if they are online
	 * @return boolean True if the user is active
	 **/
	function is_user_online($user_id)
	{
		foreach ($this->get_active() as $active) {
			if ($active['id'] == $user_id) return true;
		}
		return false;
	}
	
	/**
	 * Load enough data to be able to generate a list of active users and link to where they are
	 *
	 * PRIVATE
	 **/
	function _load_active_users()
	{
		if (count($this->activeUsers)) return;

		$oldtime   = $this->time - 900;
		$botformat = '<i>%s</i>';
				
		$oldusers = array(); // Collect timed out users

		// Add self to top of list
		$this->update($this->get['a'], $this->user_id);

		$query = $this->db->query("
			SELECT a.*, INET_NTOA(a.active_ip) as active_ip, u.user_name, u.user_active, g.group_format, f.forum_name, t.topic_title, t.topic_forum, u2.user_name AS profile_name
			FROM (%pactive a, %pgroups g, %pusers u)
			LEFT JOIN %pforums f ON f.forum_id=a.active_item
			LEFT JOIN %ptopics t ON t.topic_id=a.active_item
			LEFT JOIN %pusers u2 ON u2.user_id=a.active_item
			WHERE
			  a.active_id = u.user_id AND
			  u.user_group = g.group_id
			ORDER BY
			  a.active_time DESC");
			  
		while ($user = $this->db->nqfetch($query))
		{
			if ($user['active_time'] < $oldtime) {
				$oldusers[] = $user['active_id'];
			} else {
				if (!$user['user_active'] && !$this->perms->auth('is_admin')) {
					continue;
				}

				// Build up link
				$link = '';
				$name = '';
				$action_link = '';
				$forum = null;
				$topic = null;
				$is_bot = false;

				$title = (!$this->perms->auth('post_viewip') ? null : $user['active_ip'] . ' --- ') .  htmlspecialchars($user['active_user_agent']);

				if ($user['active_id'] != USER_GUEST_UID) {
					$link = "href=\"{$this->self}?a=profile&amp;w={$user['active_id']}\"";
					$name = sprintf($user['group_format'], $user['user_name']);
					if( !$user['user_active'] ) {
						$name = sprintf( '<i>%s</i>', $name );
					}
					$this->totalMembers++;
				} else {
					$name = $user['user_name'];

					$spider_name = $this->_spider_check($user['active_user_agent']);
					if ($spider_name) {
						$name = sprintf($botformat, $spider_name);
						$is_bot = true;
					} else {
						$this->totalGuests++;
					}
				}

				switch ($user['active_action'])
				{
				case 'topic':
					if ($this->perms->auth('topic_view', $user['topic_forum']) || $this->perms->auth('forum_view', $user['topic_forum'])) {
						$topic = $user['topic_forum'];
						$action_link = "<a href='{$this->self}?a=topic&amp;t={$user['active_item']}'>" . $this->format($user['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS) . '</a>';
					}
					break;

				case 'forum':
					if ($this->perms->auth('forum_view', $user['topic_forum'])) {
						$forum = $user['topic_forum'];
						$action_link = "<a href='{$this->self}?a=forum&amp;f={$user['active_item']}'>{$user['forum_name']}</a>";
					}
					break;

				case 'profile':
					$action_link = "<a href='{$this->self}?a=profile&amp;w={$user['active_item']}'>{$user['profile_name']}</a>";
					break;
				}

				$this->activeUsers[] = array('id' => $user['active_id'], 'name' => $name, 'link' => $link, 'title' => $title,
					'action' => $user['active_action'], 'action_link' => $action_link, 'topic' => $topic, 'forum' => $forum,
					'time' => $user['active_time'], 'bot' => $is_bot);
			}
		}

		if ($oldusers) {
			$this->db->query("UPDATE %pusers SET user_lastvisit=%d WHERE user_id IN (%s)",
				$oldtime, implode(', ', $oldusers));
			$this->db->query("DELETE FROM %pactive WHERE active_time < %d", $oldtime);
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
	function _spider_check($user_agent)
	{
		$user_agent = strtolower($user_agent);
		if ($this->sets['spider_active']) {
			foreach (array_keys($this->sets['spider_name']) as $spiderstring) {
				if (preg_match("#($spiderstring)#is", $user_agent, $agent))
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
	function _get_item($action)
	{
		$item = 0;
		switch($action)
		{
		case 'forum': $item = isset($this->get['f']) ? intval($this->get['f']) : 0; break;
		case 'topic': $item = isset($this->get['t']) ? intval($this->get['t']) : 0; break;
		case 'printer': $item = isset($this->get['t']) ? intval($this->get['t']) : 0; break;
		case 'profile': $item = isset($this->get['w']) ? intval($this->get['w']) : 0; break;
		}
		return $item;
	}
}

?>
