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

if( !defined( 'QUICKSILVERFORUMS') || !defined('QSF_ADMIN' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

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
	public function execute()
	{
		$this->set_title( $this->lang->ban_ip );
		$this->tree( $this->lang->ban_ip );

		if( !isset( $this->post['submit'] ) ) {
			$token = $this->generate_token();

			$ips = implode( "\n", $this->sets['banned_ips'] );
			$ips = stripslashes( $ips ); // Leave here. IP ban data is stored with leading slashes.

			$stmt = $this->db->prepare_query( 'SELECT group_name FROM %pgroups WHERE group_id=?' );

         $group_id = intval( USER_BANNED );
         $stmt->bind_param( 'i', $group_id );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $banned_group = $this->db->nqfetch( $result );
         $stmt->close();

			$banned_group = $this->format( $banned_group['group_name'], FORMAT_HTMLCHARS );

			$banned = null;

			$stmt = $this->db->prepare_query( 'SELECT user_name FROM %pusers WHERE user_group=? ORDER BY user_name ASC' );

         $group_id = intval( USER_BANNED );
         $stmt->bind_param( 'i', $group_id );
         $this->db->execute_query( $stmt );

         $banned_query = $stmt->get_result();
         $stmt->close();

			while( $user = $this->db->nqfetch( $banned_query ) )
			{
				$banned .= htmlspecialchars( $user['user_name'] ) . "<br>";
			}

			if( !$banned ) {
				$banned = $this->lang->ban_nomembers . '<br>';
			}

			$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/ban.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'ban_settings', $this->lang->ban_settings );
			$xtpl->assign( 'ban_member_explain1', $this->lang->ban_member_explain1 );
			$xtpl->assign( 'banned_group', $banned_group );
			$xtpl->assign( 'ban_member_explain2', $this->lang->ban_member_explain2 );
			$xtpl->assign( 'ban_banned_members', $this->lang->ban_banned_members );
			$xtpl->assign( 'banned', $banned );
			$xtpl->assign( 'ban_banned_ips', $this->lang->ban_banned_ips );
			$xtpl->assign( 'ban_one_per_line', $this->lang->ban_one_per_line );
			$xtpl->assign( 'ban_regex_allowed', $this->lang->ban_regex_allowed );
			$xtpl->assign( 'ban_cidr', $this->lang->ban_cidr );
			$xtpl->assign( 'ips', $ips );
			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'ban', $this->lang->ban );


			$xtpl->parse( 'Ban' );
			return $xtpl->text( 'Ban' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->ban_ip, $this->lang->invalid_token );
			}

			$banned_ips = trim( $this->post['banned_ips'] );

			if($banned_ips ) {
				$banned_ips = preg_quote( $banned_ips, '/' );
				$banned_ips = explode( "\n", $banned_ips );

				$count = count( $banned_ips );
				for( $i =0 ; $i < $count; $i++ )
				{
					$banned_ips[$i] = trim( $banned_ips[$i] );
					$banned_ips[$i] = str_replace( '\\*', '*', $banned_ips[$i] );

					if( !$banned_ips[$i] || ( @preg_match( "/{$banned_ips[$i]}/", 'anything' ) === false ) ) {
						unset( $banned_ips[$i] );
					}
				}
			} else {
				$banned_ips = array();
			}

			$this->sets['banned_ips'] = $banned_ips;
			$this->write_sets();

			return $this->message( $this->lang->ban_ip, $this->lang->ban_users_banned );
		}
	}
}
?>