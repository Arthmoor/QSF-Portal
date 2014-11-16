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

/**
 * User class
 *
 * @author Mark Elliot <mark.elliot@mercuryboard.com>
 * @since 1.0.1
 **/
class user
{
	/**
	 * Constructor
	 *
	 * @param $qsf - Quicksilver Forums module
	 **/
	function user(&$qsf)
	{
		$this->db  = &$qsf->db;
		$this->pre = &$qsf->pre;
		$this->session = &$qsf->session;
		$this->server  = &$qsf->server;
		$this->cookie  = &$qsf->cookie;
		$this->sets    = &$qsf->sets;
		$this->time    = &$qsf->time;
		$this->ip      = &$qsf->ip;
	}

	/**
	 * Check for a session or cookie for a logged in user and return it or return
	 * the guest user using USER_GUEST_UID
	 *
	 * @return user record set
	 **/
	function login()
	{
		if(isset($this->cookie[$this->sets['cookie_prefix'] . 'user']) && isset($this->cookie[$this->sets['cookie_prefix'] . 'pass'])) {
			$cookie_user = intval($this->cookie[$this->sets['cookie_prefix'] . 'user']);
			$cookie_pass = $this->cookie[$this->sets['cookie_prefix'] . 'pass'];
			$user = $this->db->fetch("SELECT m.*, s.skin_dir, g.group_perms, g.group_name, t.membertitle_icon, z.*
				FROM %ptimezones z, %pusers m, %pskins s, %pgroups g, %pmembertitles t
				WHERE m.user_id='%s' AND m.user_password='%s' AND s.skin_dir=m.user_skin AND g.group_id=m.user_group AND t.membertitle_id=m.user_level AND z.zone_id=m.user_timezone LIMIT 1",
				$cookie_user, $cookie_pass);

		}else if(isset($this->session['user']) && isset($this->session['pass'])) {
			$session_user = intval($this->session['user']);
			$session_pass = $this->session['pass'];
			$user = $this->db->fetch("SELECT m.*, s.skin_dir, g.group_perms, g.group_name, t.membertitle_icon, z.*
				FROM %ptimezones z, %pusers m, %pskins s, %pgroups g, %pmembertitles t
				WHERE m.user_id='%s' AND MD5(CONCAT(m.user_password,'%s'))='%s' AND s.skin_dir=m.user_skin AND g.group_id=m.user_group AND t.membertitle_id=m.user_level AND z.zone_id=m.user_timezone LIMIT 1",
				$session_user, $this->ip, $session_pass);

		}else {
			$user = $this->db->fetch("SELECT m.*, s.skin_dir, g.group_perms, g.group_name, t.membertitle_icon, z.* FROM {$this->pre}timezones z, {$this->pre}users m, {$this->pre}skins s, {$this->pre}groups g, {$this->pre}membertitles t WHERE m.user_id=" . USER_GUEST_UID . " AND s.skin_dir=m.user_skin AND g.group_id=m.user_group AND t.membertitle_id=m.user_level AND z.zone_id=m.user_timezone LIMIT 1");
			$user['user_language'] = $this->get_browser_lang($this->sets['default_lang']);
		}

		if (!isset($user['user_id'])) {
			$user = $this->db->fetch("SELECT m.*, s.skin_dir, g.group_perms, g.group_name, t.membertitle_icon, z.*
			FROM %ptimezones z, %pusers m, %pskins s, %pgroups g, %pmembertitles t
			WHERE m.user_id=%d AND s.skin_dir=m.user_skin AND g.group_id=m.user_group AND t.membertitle_id=m.user_level AND z.zone_id=m.user_timezone LIMIT 1",
			USER_GUEST_UID);
			setcookie($this->sets['cookie_prefix'] . 'user', '', $this->time - 9000, $this->sets['cookie_path']);
			setcookie($this->sets['cookie_prefix'] . 'pass', '', $this->time - 9000, $this->sets['cookie_path']);
			unset($_SESSION['user']);
			unset($_SESSION['pass']);
			$user['user_language'] = $this->get_browser_lang($this->sets['default_lang']);
		}
		return $user;
	}
    
   	/**
	 * Look at the information the browser has sent and try and find a language
	 *
	 * @param $deflang Fallback language to use
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return character code for language to use
	 **/
	function get_browser_lang($deflang)
	{
		if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && strlen($_SERVER['HTTP_ACCEPT_LANGUAGE']) >= 2) {
			return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		}
		return $deflang;
	}
}
?>
