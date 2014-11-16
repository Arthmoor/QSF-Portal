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

if (!defined('QUICKSILVERFORUMS') || !defined('QSF_ADMIN')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';

/**
 * User banning controls
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 3.0
 **/
class ban extends admin
{
	/**
	 * Recounts the number of members
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 3.0
	 * @return string HTML form or message
	 **/
	function execute()
	{
		$this->set_title($this->lang->ban_ip);
		$this->tree($this->lang->ban_ip);

		if (!isset($this->post['submit'])) {
			$ips = implode("\n", $this->sets['banned_ips']);
			$ips = stripslashes($ips); // why do we strip slashes?

			$banned_group = $this->db->fetch("SELECT group_name FROM %pgroups WHERE group_id=%d", USER_BANNED);
			$banned_group = $this->format($banned_group['group_name'], FORMAT_HTMLCHARS);

			$banned = null;

			$banned_query = $this->db->query('SELECT user_name FROM %pusers WHERE user_group=%d ORDER BY user_name ASC', USER_BANNED);
			while ($user = $this->db->nqfetch($banned_query))
			{
				$banned .= htmlspecialchars($user['user_name']) . "<br />";
			}

			if (!$banned) {
				$banned = $this->lang->ban_nomembers . '<br />';
			}

			return eval($this->template('ADMIN_BAN_FORM'));
		} else {
			$banned_ips = trim($this->post['banned_ips']);

			if ($banned_ips) {
				$banned_ips = preg_quote($banned_ips, '/');
				$banned_ips = explode("\n", $banned_ips);

				$count = count($banned_ips);
				for($i=0; $i<$count; $i++)
				{
					$banned_ips[$i] = trim($banned_ips[$i]);
					$banned_ips[$i] = str_replace('\\*', '*', $banned_ips[$i]);

					if (!$banned_ips[$i] || (@preg_match("/{$banned_ips[$i]}/", 'anything') === false)) {
						unset($banned_ips[$i]);
					}
				}
			} else {
				$banned_ips = array();
			}

			$this->sets['banned_ips'] = $banned_ips;
			$this->write_sets();

			return $this->message($this->lang->ban_ip, $this->lang->ban_users_banned);
		}
	}
}
?>
