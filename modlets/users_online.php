<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2019 The QSF Portal Development Team
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

/**
 * Generate the list of active users
 *
 * @author Roger Libiez [Samson] 
 * @since 1.2.2
 **/
class users_online extends modlet
{
	public function __construct( $forumobject )
	{
		parent::__construct( $forumobject );
	}

	/**
	* Display a listing of who is online.
	*
	* @arg bool
	* @author Geoffrey Dunn <geoff@warmage.com>
	* @since 1.2.0
	* @return string HTML with current online users and total membercount
	**/
	public function execute( $arg )
	{
		if( !isset( $this->qsf->lang->board_members ) ) {
			$this->qsf->lang->board();
		}

		$users = $this->doActive();

		$userlist = '';
		if( $arg == true ) {
			$this->userlist = $this->usersonline();
			$userlist = $this->userlist['TITLEONTABLE'] . "<br /><br />" . $this->userlist['USERNAMES'];
			$date = $this->qsf->mbdate( DATE_ONLY_LONG, $this->qsf->time, false );

			$xtpl = new XTemplate( './skins/' . $this->qsf->skin . '/modlets/users_online.xtpl' );

			$xtpl->assign( 'userlist', $userlist );
			$xtpl->assign( 'main_visitors', $this->qsf->lang->main_visitors );
			$xtpl->assign( 'date', $date );

			$xtpl->parse( 'UsersOnlineMain' );
			return $xtpl->text( 'UsersOnlineMain' );
		}

		$link = "<a href=\"{$this->qsf->site}/active_users/\" class=\"activeusers\">{$this->qsf->lang->main_users_online}</a>";
		if( $this->qsf->perms->is_guest )
			$link = $this->qsf->lang->main_users_online;

		$xtpl = new XTemplate( './skins/' . $this->qsf->skin . '/modlets/users_online.xtpl' );

		$xtpl->assign( 'site', $this->qsf->site );
		$xtpl->assign( 'skin', $this->qsf->skin );
		$xtpl->assign( 'link', $link );
		$xtpl->assign( 'users', $users['USERS'] );
		$xtpl->assign( 'main_members', $this->qsf->lang->main_members );
		$xtpl->assign( 'membercount', $users['MEMBERCOUNT'] );
		$xtpl->assign( 'main_guests', $this->qsf->lang->main_guests );
		$xtpl->assign( 'guestcount', $users['GUESTCOUNT'] );

		$xtpl->parse( 'UsersOnlineBlock' );
		return $xtpl->text( 'UsersOnlineBlock' );
	}

	/**
	 * Formats list of active users
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return array Active users: USERS, MEMBERCOUNT, GUESTCOUNT, TOTALCOUNT
	 **/
	private function doActive()
	{
		/**
		 * If it exists, perhaps do something like UPDATE ... SELECT
		 */
		$Active = $this->getActive();

		if( $Active ) {
			$Active = implode( ', ', $Active );
		} else {
			$Active = $this->qsf->lang->board_nobody;
		}

		$OnGuests = $this->qsf->activeutil->get_guests_online();
		$OnMembers = $this->qsf->activeutil->get_members_online();
		$OnTotal = $OnMembers + $OnGuests;

		if( $OnTotal > $this->qsf->sets['mostonline'] ) {
			$this->qsf->sets['mostonline']     = $OnTotal;
			$this->qsf->sets['mostonlinetime'] = $this->qsf->time;
			$this->qsf->write_sets();
		}

		return array(
			'USERS'       => $Active,
			'MEMBERCOUNT' => $OnMembers,
			'GUESTCOUNT'  => $OnGuests,
			'TOTALCOUNT'  => $OnTotal
		);
	}

	/**
	 * Makes list of active users and filters out inactive ones - see doActive()
	 *
	 * @access protected
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return array Array of active members
	 **/
	private function getActive()
	{
		$allusers = array();
		$allnames = array();
		$all_active_users = $this->qsf->activeutil->get_active();

		foreach( $all_active_users as $user )
		{
			if( ( $user['id'] != USER_GUEST_UID || $user['bot'] ) && !in_array( $user['name'], $allnames ) ) {
				if( $user['bot'] ) {
					$allusers[] = $user['name'];
				} else {
					if( $this->qsf->user['user_group'] != USER_GUEST && $this->qsf->user['user_group'] != USER_AWAIT )
						$allusers[] = "<a {$user['link']} title=\"{$user['title']}\">{$user['name']}</a>";
					else
						$allusers[] = $user['name'];
				}
				$allnames[] = $user['name'];
			}
		}
		return $allusers;
	}

	private function usersonline()
	{
		$which_day = date( "d F Y", $this->qsf->time );
		$today_date = strtotime( "$which_day" );

		if( $this->qsf->user['user_group'] == USER_GUEST || $this->qsf->user['user_group'] == USER_AWAIT )
			$query = $this->qsf->db->query( "SELECT user_id, user_name, user_lastvisit FROM %pusers WHERE user_lastvisit >= '%s' AND user_group !=%d AND user_group !=%d AND user_posts >= 1 ORDER BY user_name", $today_date, USER_GUEST, USER_AWAIT );
		else
			$query = $this->qsf->db->query( "SELECT user_id, user_name, user_lastvisit FROM %pusers WHERE user_lastvisit >= '%s' AND user_group !=%d ORDER BY user_name", $today_date, USER_GUEST );

		$count_users = $this->qsf->db->num_rows( $query );
		$user_names = '';

		if( $count_users == '0' ) {
			$title_onlinetd_table = '<strong>There have been no members online today.</strong>';
		} else {
			$i = 0;
			while( $row = $this->qsf->db->nqfetch( $query ) )
			{
				$user_id = $row['user_id'];
				$user_name = $row['user_name'];

				if( $i == ( $count_users - 1 ) ) {
					$comma = "";
				} else {
					$comma = ", ";
				}

               			if( $count_users == '1' ) {
					$title_onlinetd_table = "<strong>There has been " . $count_users . " member online today:</strong>";
				}
				if( $count_users > '1' ) {
					$title_onlinetd_table = "<strong>There have been " . $count_users . " members online today:</strong>";
				}
				$user_names = $user_names . '<a href="' . $this->qsf->self . '?a=profile&amp;w=' . $user_id . '">' . $user_name . '</a>' . $comma;
			}
		}
		return array( 'TITLEONTABLE'  => $title_onlinetd_table, 'USERNAMES' => $user_names );
	}
}
?>