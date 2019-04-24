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
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

require_once $set['include_path'] . '/global.php';

/**
 * Displays a list of registered members
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class members extends qsfglobal
{
	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->site ) : $this->lang->board_noview
			);
		}

		$this->set_title( $this->lang->members_list );
		$this->tree( $this->lang->members_list );

		$this->get['min'] = isset( $this->get['min'] ) ? intval( $this->get['min'] ) : 0;
		$this->get['num'] = isset( $this->get['num'] ) ? intval( $this->get['num'] ) : 25;
		$asc = 0;

		if( isset( $this->get['order'], $this->get['asc'] ) ) {
			$order = $this->get['order'];

			switch( $this->get['order'] )
			{
			case 'posts':
				$sortby = 'm.user_posts';
				break;

			case 'group':
				$sortby = 'm.user_group';
				break;

			case 'joined':
				$sortby = 'm.user_joined';
				break;

			default:
				$order = 'member';
				$sortby = 'm.user_name';
				break;
			}

			if( !$this->get['asc'] ) {
				$sortby .= ' DESC';
			}

			$asc  = ( $this->get['asc'] == 0 ) ? 1 : 0;
			$lasc = ( $this->get['asc'] == 0 ) ? 0 : 1;

		} else {
			$lasc = 1;
			$order = 'member';
			$sortby = 'm.user_name ASC';
		}

		if( !isset( $this->get['l'] ) ) {
			$l = null;
		} else {
			$l = strtoupper( preg_replace( '/[^A-Za-z]/', '', $this->get['l'] ) );
		}

		if( $l ) {
			$PageNums = $this->htmlwidgets->get_pages(
				array( "SELECT user_id FROM %pusers m, %pgroups g
				WHERE m.user_group = g.group_id AND m.user_id != %d AND UPPER(LEFT(LTRIM(m.user_name), 1)) = '%s'", USER_GUEST_UID, $l ),
				"a=members&amp;l={$l}&amp;order=$order&amp;asc=$lasc", $this->get['min'], $this->get['num'] );
		} else {
			$PageNums = $this->htmlwidgets->get_pages(
				array( "SELECT user_id FROM %pusers m, %pgroups g WHERE m.user_group = g.group_id AND m.user_id != %d", USER_GUEST_UID ),
				"a=members&amp;l={$l}&amp;order=$order&amp;asc=$lasc", $this->get['min'], $this->get['num'] );
		}

		$result = $this->db->query ( "SELECT m.user_joined, m.user_email_show, m.user_email_form, m.user_email, m.user_pm, m.user_name, m.user_id,
				m.user_posts, m.user_title, m.user_homepage, m.user_facebook, m.user_twitter, m.user_group, g.group_name
			FROM %pusers m,	%pgroups g
			WHERE m.user_group = g.group_id AND m.user_id != %d" . ( $l ? " AND UPPER(LEFT(LTRIM(m.user_name), 1)) = '{$l}'" : '' ) . "
			ORDER BY {$sortby}
			LIMIT %d, %d",
			USER_GUEST_UID, $this->get['min'], $this->get['num'] );

		$xtpl = new XTemplate( './skins/' . $this->skin . '/members.xtpl' );

		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'members_list', $this->lang->members_list );
		$xtpl->assign( 'members_member', $this->lang->members_member );
		$xtpl->assign( 'members_posts', $this->lang->members_posts );
		$xtpl->assign( 'members_joined', $this->lang->members_joined );
		$xtpl->assign( 'members_title', $this->lang->members_title );
		$xtpl->assign( 'members_group', $this->lang->members_group );
		$xtpl->assign( 'members_www', $this->lang->members_www );
		$xtpl->assign( 'members_all', $this->lang->members_all );
		$xtpl->assign( 'members_email_member', $this->lang->members_email_member );
		$xtpl->assign( 'members_send_pm', $this->lang->members_send_pm );
		$xtpl->assign( 'members_visit_twitter', $this->lang->members_visit_twitter );
		$xtpl->assign( 'members_visit_facebook', $this->lang->members_visit_facebook );
		$xtpl->assign( 'members_visit_www', $this->lang->members_visit_www );

		while( $member = $this->db->nqfetch( $result ) )
		{
			$member['user_joined'] = $this->mbdate( DATE_ONLY_LONG, $member['user_joined'] );

			// Do not display members awaiting activation, or members with zero posts to guests or other members awaiting activation. Discourages spambots.
			if( $this->user['user_id'] == USER_GUEST_UID || $this->user['user_group'] == USER_AWAIT ) {
				if( $member['user_group'] == USER_AWAIT )
					continue;

				if( $member['user_posts'] < 1 )
					continue;
			}

			if( $this->perms->auth( 'email_use' ) ) {
				if( $member['user_email_show'] ) {
					$member['email'] = $member['user_email'];
				}
			}

			if( !$member['user_pm'] || $this->perms->is_guest ) {
				$member['user_pm'] = null;
			}

			$xtpl->assign( 'user_id', $member['user_id'] );
			$xtpl->assign( 'user_name', $member['user_name'] );
			$xtpl->assign( 'profile_link_name', $this->clean_url( $member['user_name'] ) );

			if( $member['user_email_show'] && $this->perms->auth('email_use') ) {
				$xtpl->assign( 'user_email', $member['user_email'] );

				$xtpl->parse( 'Members.User.EmailShow' );
			}

			if( !$member['user_email_show'] && $member['user_email_form'] && $this->perms->auth( 'email_use' ) ) {
				$xtpl->assign( 'email_link_name', $this->clean_url( $member['user_name'] ) );
				$xtpl->assign( 'user_id', $member['user_id'] );

				$xtpl->parse( 'Members.User.EmailForm' );
			}

			if( $member['user_pm'] ) {
				$xtpl->assign( 'user_id', $member['user_id'] );

				$xtpl->parse( 'Members.User.PM' );
			}

			if( $member['user_twitter'] ) {
				$xtpl->assign( 'twitter', 'https://twitter.com/' . $member['user_twitter'] );

				$xtpl->parse( 'Members.User.Twitter' );
			}

			if( $member['user_facebook'] ) {
				$xtpl->assign( 'facebook', $member['user_facebook'] );

				$xtpl->parse( 'Members.User.Facebook' );
			}

			if( $member['user_homepage'] ) {
				$xtpl->assign( 'homepage', $member['user_homepage'] );

				$xtpl->parse( 'Members.User.Homepage' );
			}

			$xtpl->assign( 'user_posts', $member['user_posts'] );
			$xtpl->assign( 'user_joined', $member['user_joined'] );
			$xtpl->assign( 'user_title', $member['user_title'] );
			$xtpl->assign( 'group_name', $member['group_name'] );

			$xtpl->parse( 'Members.User' );
		}

		$xtpl->assign( 'l', $l );
		$xtpl->assign( 'asc', $asc );
		$xtpl->assign( 'order', $order );
		$xtpl->assign( 'lasc', $lasc );
		$xtpl->assign( 'PageNums', $PageNums );

		$xtpl->parse( 'Members' );
		return $xtpl->text( 'Members' );
	}
}
?>