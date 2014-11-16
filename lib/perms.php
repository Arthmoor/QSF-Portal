<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2007 The QSF Portal Development Team
 * http://www.qsfportal.com/
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2006 The Quicksilver Forums Development Team
 * http://www.quicksilverforums.com/
 * 
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 * http://www.mercuryboard.com/
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

/**
 * Permissions class
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 4.0
 **/
class permissions
{
	var $cube = array();
	var $group;
	var $user;
	var $db;
	var $pre;
	var $is_guest;
	var $standard = array(
		'board_view' => false,
		'board_view_closed' => false,
		'do_anything' => false,
		'email_use' => false,
		'is_admin' => false,
		'edit_avatar' => false,
		'edit_profile' => false,
		'edit_sig' => false,
                'page_edit' => false, // Added for CMS
                'page_create' => false, // Added for CMS
                'page_delete' => false, // Added for CMS
		'topic_global' => false,
		'forum_view' => false,
		'pm_noflood' => false,
		'poll_create' => false,
		'poll_vote' => false,
		'post_attach' => false,
		'post_attach_download' => false,
		'post_create' => false,
		'post_delete' => false,
		'post_delete_own' => false,
		'post_edit' => false,
		'post_edit_own' => false,
		'post_noflood' => false,
		'post_viewip' => false,
		'post_inc_userposts' => false,
		'search_noflood' => false,
		'topic_create' => false,
		'topic_delete' => false,
		'topic_delete_own' => false,
		'topic_edit' => false,
		'topic_edit_own' => false,
		'topic_lock' => false,
		'topic_lock_own' => false,
		'topic_move' => false,
		'topic_move_own' => false,
		'topic_pin' => false,
		'topic_pin_own' => false,
		'topic_publish' => false,
		'topic_publish_auto' => false,
		'topic_split' => false,
		'topic_split_own' => false,
		'topic_unlock' => false,
		'topic_unlock_mod' => false,
		'topic_unlock_own' => false,
		'topic_unpin' => false,
		'topic_unpin_own' => false,
		'topic_view' => false,
		'topic_view_unpublished' => false
	);

	var $globals = array(
		'board_view' => true,
		'board_view_closed' => true,
		'do_anything' => true,
		'email_use' => true,
		'is_admin' => true,
		'edit_avatar' => true,
		'edit_profile' => true,
		'edit_sig' => true,
                'page_edit' => true, // Added for CMS                                              
                'page_create' => true, // Added for CMS                                              
                'page_delete' => true, // Added for CMS 
		'pm_noflood' => true,
		'search_noflood' => true,
		'topic_global' => true
	);
	
	/**
	 * Constructor; sets up variables
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 **/
	function permissions(&$qsf)
	{
		$this->db  = &$qsf->db;
		$this->pre = &$qsf->pre;
		if (!empty($qsf->user)) {
			$this->get_perms($qsf->user['user_group'], $qsf->user['user_id'],
				($qsf->user['user_perms'] ? $qsf->user['user_perms'] : $qsf->user['group_perms']));
		}
	}

	/**
	 * Initialise the permissions object cube
	 *
	 * @param int $group Group id to load perms from. Set to -1 if using user perms
	 * @param int $user User id. Checked against USER_GUEST_UID as loaded as perms if group is set to -1
	 * @param mixed $perms Optional array of permissions to use instead of group or user perms from the database
	 **/
	function get_perms($group, $user, $perms = false)
	{
		if (!$perms) {
			if ($group != -1) {
				$data  = $this->db->fetch("SELECT group_perms FROM %pgroups WHERE group_id=%d", $group);
				$perms = $data['group_perms'];
			} else {
				$data  = $this->db->fetch("SELECT user_perms, user_group FROM %pusers WHERE user_id=%d", $user);
				$perms = $data['user_perms'];
				$group = $data['user_group'];
			}
		}

		$this->cube = unserialize($perms);
		if (!$this->cube) {
			$this->cube = $this->standard;
		}

		$this->is_guest = (($user == USER_GUEST_UID) || ($group == USER_GUEST));
		$this->group = $group;
		$this->user  = $user;
	}

	/**
	 * Query if a permission is turned on or not
	 *
	 * @param string $y Indentifier of the permission being queried
	 * @param mixed $z Forum to check the permission against
	 *
	 * @return true if found the permission and it is on
	 **/
	function auth($y, $z = false)
	{
		if (!isset($this->cube[$y])) {
			return false;
		}

		if ($z === false) {
			return !is_array($this->cube[$y]) ? $this->cube[$y] : !in_array(false, $this->cube[$y]);
		} else {
			return is_array($this->cube[$y]) ? (isset($this->cube[$y][$z]) && $this->cube[$y][$z]) : $this->cube[$y];
		}
	}

	/**
	 * Run through the cube and rebuild all permissions to on or off
	 *
	 * @param bool $bool What value to assign to all permissions
	 **/
	function reset_cube($bool)
	{
		$cube = $this->standard;
		$forums = array();

		$query = $this->db->query("SELECT forum_id FROM %pforums ORDER BY forum_id");
		while ($forum = $this->db->nqfetch($query))
		{
			$forums[$forum['forum_id']] = $bool;
		}

		foreach ($cube as $y => $z)
		{
			if (!isset($this->globals[$y]) && $forums) {
				$cube[$y] = $forums;
			} else {
				$cube[$y] = $bool;
			}
		}

		$this->cube = $cube;
	}

	/**
	 * Turn on or off a specific permission. Also turn on or off for all forums
	 * that permission applies to
	 *
	 * @param string $y Indentifier of the permission being queried
	 * @param bool $bool What value to assign to all permissions
	 **/
	function set_xy($y, $bool)
	{
		if (!isset($this->cube[$y])) {
			if (!isset($this->globals[$y])) {
				// Create an array of all the forums
				$z = $this->cube[reset(array_diff(array_keys($this->standard), array_keys($this->globals)))];

				if (is_array($z)) { // We have forums
					$z = array_keys($array);

					$this->cube[$y] = array();

					foreach ($z as $zkey)
					{
						$this->cube[$y][$zkey] = $bool;
					}
				} else { // No forums
					$this->cube[$y] = $bool;
				}
			} else {
				$this->cube[$y] = $bool;
			}
		} else {
			if (isset($this->globals[$y]) || is_bool($this->cube[$y])) {
				$this->cube[$y] = $bool;
			} else {
				foreach ($this->cube[$y] as $zkey => $zval)
				{
					$this->cube[$y][$zkey] = $bool;
				}
			}
		}
	}

	/**
	 * Turn on or off a specific permission for a specific forum
	 *
	 * @param string $y Indentifier of the permission being queried
	 * @param int $z Forum to check the permission against
	 * @param bool $bool What value to assign to all permissions
	 **/
	function set_xyz($y, $z, $bool)
	{
		// Only allow z modifications on non-global permissions if there are forums
		if (!isset($this->globals[$y]) && is_array($this->cube[$y])) {
			$this->cube[$y][$z] = $bool;
		}
	}

	/**
	 * Run through the cube and add a new forum
	 *
	 * @param int $z Forum to create
	 * @param mixed $bool Forum to copy permissions from. -1 if this is the first
	 *	forum/category and to use a default. true or false to set all values to that
	 **/
	function add_z($z, $bool = -1)
	{
		foreach ($this->cube as $y => $zval)
		{
			if (isset($this->globals[$y])) {
				continue;
			}

			if (!is_bool($this->cube[$y])) {
				$this->cube[$y][$z] = $bool;
			} else {
				if ($bool === -1) {
					$this->cube[$y] = array($z => $this->cube[$y]);
				} else {
					$this->cube[$y] = array($z => $bool);
				}
			}
		}
	}

	/**
	 * Run through the cube and remove the specified forum
	 *
	 * @param int $z Forum to remove
	 **/
	function remove_z($z)
	{
		foreach ($this->cube as $y => $zval)
		{
			if (isset($this->globals[$y])) {
				continue;
			}

			// Removing the last forum?
			if (count($this->cube[$y]) == 1) {
				$this->cube[$y] = $this->cube[$y][$z];
			} else {
				unset($this->cube[$y][$z]);
			}
		}
	}

	/**
	 * This will load a new group for each while iteration
	 *
	 * while ($perms->get_group())
	 * {
	 *     $perms->set_xy();
	 *     $perms->update();
	 * }
	 *
	 * @param bool $users If true load user permissions instead of group permissions
	 **/
	function get_group($users = false)
	{
		static $start = true;
		static $groups = array();
		static $p = 0;

		if ($start) {
			$start = false;

			if ($users) {
				$query = $this->db->query("SELECT user_id, user_perms FROM %pusers WHERE user_perms != ''");
			} else {
				$query = $this->db->query("SELECT group_id, group_perms FROM %pgroups");
			}

			while ($group = $this->db->nqfetch($query))
			{
				$groups[] = $group;
			}
		}

		if ($p < count($groups)) {
			if ($users) {
				$this->get_perms(-1, $groups[$p]['user_id'], $groups[$p]['user_perms']);
			} else {
				$this->get_perms($groups[$p]['group_id'], -1, $groups[$p]['group_perms']);
			}

			$p++;

			return true;
		} else {
			$start = true;
			$groups = array();
			$p = 0;

			return false;
		}
	}
	
	/**
	 * Turn on or off a specific permission for a specific forum
	 *
	 * Note: This is only used for upgrades
	 *
	 * @param string $y Indentifier of the permission being added
	 * @param bool $bool What value to assign to all permissions
	 **/
	function add_perm($y, $bool)
	{
		$new_global = isset($this->globals[$y]);
		if (!isset($this->standard[$y])) return; // Don't allow the action!
		
		$forum_view_array = $this->cube['forum_view']; // Use this to find the exisitng forums
		
		if (!$new_global && is_array($forum_view_array)) {
			foreach (array_keys($forum_view_array) as $forum) {
				$this->cube[$y][$forum] = $bool;
			}
		} else {
			$this->cube[$y] = $bool;
		}
	}

	/**
	 * Save the permissions back to the database
	 **/
	function update()
	{
		if ($this->cube) {
			ksort($this->cube);
			$serialized = serialize($this->cube);
		} else {
			$serialized = '';
		}

		if ($this->user == -1) {
			$this->db->query("UPDATE %pgroups SET group_perms='%s' WHERE group_id=%d",
				$serialized, $this->group);
		} else {
			$this->db->query("UPDATE %pusers SET user_perms='%s' WHERE user_id=%d",
				$serialized, $this->user);
		}
	}
}
?>
