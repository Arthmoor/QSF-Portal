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
	header('HTTP/1.0 403 Forbidden');
	die;
}

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
	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->site ) : $this->lang->board_noview
			);
		}

		$this->set_title( $this->lang->active_users );
		$this->tree( $this->lang->active_users );

		$xtpl = new XTemplate( './skins/' . $this->skin . '/active.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'active_users', $this->lang->active_users );
		$xtpl->assign( 'active_user', $this->lang->active_user );
		$xtpl->assign( 'active_last_action', $this->lang->active_last_action );
		$xtpl->assign( 'active_time', $this->lang->active_time );

		$this->listActive( $xtpl );

		$xtpl->parse( 'Active' );
		return $xtpl->text( 'Active' );
	}

	/**
	 * Formats list of active users and filters out inactive ones
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return string HTML: Active users
	 **/
	private function listActive( $xtpl )
	{
		$act = array(
			'active'  => $this->lang->active_modules_active,
			'board'   => $this->lang->active_modules_board,
			'cp'      => $this->lang->active_modules_cp,
			'files'   => $this->lang->active_modules_files,
			'filerating' => $this->lang->active_modules_file_rating,
			'forum'   => $this->lang->active_modules_forum,
			'login'   => $this->lang->active_modules_login,
			'members' => $this->lang->active_modules_members,
			'mod'     => $this->lang->active_modules_mod,
			'newspost' => $this->lang->active_modules_newspost,
			'page'    => $this->lang->active_modules_pages,
			'profile' => $this->lang->active_modules_profile,
			'pm'      => $this->lang->active_modules_pm,
			'post'    => $this->lang->active_modules_post,
			'recent'  => $this->lang->active_modules_recent,
			'search'  => $this->lang->active_modules_search,
			'topic'   => $this->lang->active_modules_topic
		);

		$all_active_users = $this->activeutil->get_active();

		foreach( $all_active_users as $user )
		{
			if( isset( $act[$user['action']] ) ) {
				$action = $act[$user['action']];

				if( $user['action_link'] ) {
					$action = sprintf( $action, $user['action_link'] );
				}
			} else {
				$action = $act['board'];
			}

			$time = $this->mbdate( DATE_SHORT, $user['time'] );

			if( $user['bot'] ) {
				$icon = 'robot.png';
			} else {
				$icon = 'user_online.png';
			}

			$xtpl->assign( 'icon', $icon );
			$xtpl->assign( 'link', $user['link'] );
			$xtpl->assign( 'title', $user['title'] );
			$xtpl->assign( 'name', $user['name'] );
			$xtpl->assign( 'action', $action );
			$xtpl->assign( 'time', $time );

			$xtpl->parse( 'Active.Item' );
		}
	}
}
?>