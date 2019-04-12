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

if( !defined( 'QUICKSILVERFORUMS') || !defined('QSF_ADMIN' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';

/**
 * Group Controls
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 4.0
 **/
class groups extends admin
{
	/**
	 * Group Controls
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 4.0
	 * @return string HTML
	 **/
	public function execute()
	{
		$this->set_title( $this->lang->groups_controls );

		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = '';
		}

		switch( $this->get['s'] )
		{
		case 'add':
			$this->tree( $this->lang->groups_create );

			if( !isset( $this->post['submit'] ) ) {
				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/groups.xtpl' );

				$xtpl->assign( 'self', $this->self );
				$xtpl->assign( 'groups_create', $this->lang->groups_create );
				$xtpl->assign( 'groups_create_new', $this->lang->groups_create_new );

				$based_on = $this->lang->groups_based_on . " " . $this->list_groups( USER_MEMBER ) . " ";
				$xtpl->assign( 'based_on', $based_on );

				$xtpl->assign( 'token', $this->generate_token() );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'Groups.AddForm' );
				$xtpl->parse( 'Groups' );

				return $xtpl->text( 'Groups' );
			} else {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->groups_create, $this->lang->invalid_token );
				}

				if( !isset( $this->post['user_group'] ) ) {
					$this->post['user_group'] = USER_MEMBER;
				}

				if( !isset( $this->post['group_name'] ) || ( trim( $this->post['group_name'] ) == '' ) ) {
					return $this->message( $this->lang->groups_create, $this->lang->groups_no_name );
				}

				$copying = $this->db->fetch( "SELECT group_format, group_perms FROM %pgroups WHERE group_id=%d", $this->post['user_group'] );

				$this->db->query( "INSERT INTO %pgroups (group_name, group_format, group_perms)
					VALUES ('%s', '%s', '%s')",
					$this->format( $this->post['group_name'], FORMAT_HTMLCHARS ), $copying['group_format'], $copying['group_perms'] );

				return $this->message( $this->lang->groups_create, $this->lang->groups_created );
			}
			break;

		case 'edit':
			$this->tree( $this->lang->groups_edit );

			if( !isset( $this->post['submit'] ) ) {
				if( !isset( $this->post['choose_group'] ) ) {
					$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/groups.xtpl' );

					$xtpl->assign( 'groups_edit', $this->lang->groups_edit );
					$xtpl->assign( 'groups_to_edit', $this->lang->groups_to_edit );

					$group_list = $this->list_groups(-1, 'group');
					$xtpl->assign( 'group_list', $group_list );

					$xtpl->assign( 'submit', $this->lang->submit );

					$xtpl->parse( 'Groups.ChooseForm' );
					$xtpl->parse( 'Groups' );

					return $xtpl->text( 'Groups' );
				} else {
					$token = $this->generate_token();

					if( !isset( $this->post['group'] ) ) {
						return $this->message( $this->lang->groups_edit, $this->lang->groups_no_group );
					}

					$g = intval( $this->post['group'] );

					$old = $this->db->fetch( "SELECT group_name, group_type, group_format FROM %pgroups WHERE group_id=%d", $g );

					if( $old['group_type'] == '' ) {
						$old['group_type'] = 'CUSTOM';
					}
					$oldGroupName = $this->format( $old['group_name'], FORMAT_HTMLCHARS );
					$oldGroupFormat = $this->format( $old['group_format'], FORMAT_HTMLCHARS );

					$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/groups.xtpl' );

					$xtpl->assign( 'groups_edit', $this->lang->groups_edit );
					$xtpl->assign( 'groups_type', $this->lang->groups_type );

					$xtpl->assign( 'g_type', $old['group_type'] );
					$xtpl->assign( 'groups_name', $this->lang->groups_name );
					$xtpl->assign( 'oldGroupName', $oldGroupName );
					$xtpl->assign( 'groups_formatting', $this->lang->groups_formatting );
					$xtpl->assign( 'oldGroupFormat', $oldGroupFormat );
					$xtpl->assign( 'g', $g );
					$xtpl->assign( 'token', $this->generate_token() );
					$xtpl->assign( 'submit', $this->lang->submit );

					$xtpl->parse( 'Groups.EditForm' );
					$xtpl->parse( 'Groups' );

					return $xtpl->text( 'Groups' );
				}
			} else {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->groups_edit, $this->lang->invalid_token );
				}

				if( !isset( $this->post['group'] ) ) {
					return $this->message( $this->lang->groups_edit, $this->lang->groups_no_group );
				}

				$g = intval( $this->post['group'] );

				if( !isset( $this->post['group_name'] ) || ( trim( $this->post['group_name'] ) == '' ) ) {
					return $this->message( $this->lang->groups_edit, $this->lang->groups_no_name );
				}

				if( !isset( $this->post['group_format'] ) || ( strpos( $this->post['group_format'], '%s' ) === false)) {
					return $this->message( $this->lang->groups_edit, $this->lang->groups_bad_format );
				}

				$this->db->query( "UPDATE %pgroups SET group_name='%s', group_format='%s' WHERE group_id=%d",
					$this->format( $this->post['group_name'], FORMAT_HTMLCHARS ), $this->post['group_format'], $g );

				return $this->message( $this->lang->groups_edit, $this->lang->groups_edited );
			}
			break;

		case 'delete':
			$this->tree( $this->lang->groups_delete );

			$test = $this->db->fetch( "SELECT group_id FROM %pgroups WHERE group_type=''" );

			if( !$test ) {
				return $this->message( $this->lang->groups_delete, $this->lang->groups_no_delete );
			}

			if( !isset($this->post['submit'] ) ) {
				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/groups.xtpl' );

				$xtpl->assign( 'self', $this->self );
				$xtpl->assign( 'groups_delete', $this->lang->groups_delete );

				$will_be = "{$this->lang->groups_the} " . $this->list_groups( -1, 'old_group', true ) . " {$this->lang->groups_will_be}";
				$xtpl->assign( 'groups_will_be', $will_be );

				$will_become = "{$this->lang->groups_will_become} " . $this->list_groups( USER_MEMBER, 'new_group' );
				$xtpl->assign( 'groups_will_become', $will_become );

				$xtpl->assign( 'groups_i_confirm', $this->lang->groups_i_confirm );
				$xtpl->assign( 'groups_only_custom', $this->lang->groups_only_custom );

				$xtpl->assign( 'token', $this->generate_token() );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'Groups.DeleteForm' );
				$xtpl->parse( 'Groups' );

				return $xtpl->text( 'Groups' );
			} else {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->groups_delete, $this->lang->invalid_token );
				}

				if( !isset( $this->post['old_group'] ) || !isset( $this->post['confirm'] ) ) {
					return $this->message( $this->lang->groups_delete, $this->lang->groups_no_action );
				}

				if( !isset( $this->post['new_group'] ) ) {
					$this->post['new_group'] = USER_MEMBER;
				}

				$this->db->query( "DELETE FROM %pgroups WHERE group_id=%d AND group_type=''", $this->post['old_group'] );
				$this->db->query( "UPDATE %pusers SET user_group=%d WHERE user_group=%d", $this->post['new_group'], $this->post['old_group'] );

				return $this->message( $this->lang->groups_delete, $this->lang->groups_deleted );
			}
			break;
		}
	}
}
?>