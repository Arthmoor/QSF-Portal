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

require_once $set['include_path'] . '/global.php';

/**
 * Active Users Viewer
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class active extends qsfglobal
{
	/**
	 * Sets up title, tree, and HTML
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return void
	 **/
	function execute()
	{
		$this->set_title($this->lang->active_users);
		$this->tree($this->lang->active_users);

		$ActiveList = $this->listActive();
		return eval($this->template('ACTIVE_MAIN'));
	}

	/**
	 * Formats list of active users and filters out inactive ones
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return string HTML: Active users
	 **/
	function listActive()
	{
		$allusers  = null;

		$act = array(
			'active'  => $this->lang->active_modules_active,
			'board'   => $this->lang->active_modules_board,
			'cp'      => $this->lang->active_modules_cp,
			'forum'   => $this->lang->active_modules_forum,
			'help'    => $this->lang->active_modules_help,
			'login'   => $this->lang->active_modules_login,
			'members' => $this->lang->active_modules_members,
			'mod'     => $this->lang->active_modules_mod,
			'printer' => $this->lang->active_modules_printer,
			'profile' => $this->lang->active_modules_profile,
			'pm'      => $this->lang->active_modules_pm,
			'post'    => $this->lang->active_modules_post,
			'recent'  => $this->lang->active_modules_recent,
			'search'  => $this->lang->active_modules_search,
			'topic'   => $this->lang->active_modules_topic
		);
		
		$all_active_users = $this->activeutil->get_active();

		foreach ($all_active_users as $user)
		{
			if (isset($act[$user['action']])) {
				$action = $act[$user['action']];
				if ($user['action_link']) {
					$action = sprintf($action, $user['action_link']);
				}
			} else {
				$action = $act['board'];
			}

			$time = $this->mbdate(DATE_SHORT, $user['time']);
				
			$allusers .= eval($this->template('ACTIVE_USER'));
		}

		return $allusers;
	}
}
?>
