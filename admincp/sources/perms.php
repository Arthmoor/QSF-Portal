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

if( !defined( 'QUICKSILVERFORUMS' ) || !defined( 'QSF_ADMIN' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

/**
 * Member permissions
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 3.0
 **/
class perms extends admin
{
	public function execute()
	{
		$perms_obj = new permissions( $this );

		if( isset( $this->get['s'] ) && ( $this->get['s'] == 'user' ) ) {
			if( !isset( $this->get['id'] ) ) {
				header( "Location: {$this->site}/admincp/index.php?a=member&amp;s=perms" );
			}

			$this->post['group'] = intval( $this->get['id'] );

			$mode  = 'user';
			$title = 'User Control';
			$link  = '&amp;s=user&amp;id=' . $this->post['group'];

			$perms_obj->get_perms( -1, $this->post['group'] );
		} else {
			if( !isset( $this->post['group'] ) ) {
				return $this->message( 'User Groups', "
				<form action='$this->site/admincp/index.php?a=perms' method='post'><div>
					{$this->lang->perms_edit_for}
					<select name='group'>
					" . $this->htmlwidgets->select_groups(-1) . "
					</select>
					<input type='submit' value='{$this->lang->submit}'></div>
				</form>" );
			}

			$this->post['group'] = intval( $this->post['group'] );

			$mode  = 'group';
			$title = $this->lang->perms_title;
			$link  = null;

			$perms_obj->get_perms( $this->post['group'], -1 );
		}

		$this->set_title( $title );
		$this->tree( $title );

		$forums_only = $this->db->query( 'SELECT forum_id, forum_name FROM %pforums ORDER BY forum_name' );

		$forums_list = array();
		while( $forum = $this->db->nqfetch( $forums_only ) )
		{
			$forums_list[] = $forum;
		}

		$perms = array(
				'board_view'		=> $this->lang->perms_board_view,
				'board_view_closed'	=> $this->lang->perms_board_view_closed,
				'do_anything'		=> $this->lang->perms_do_anything,
				'is_admin'		=> $this->lang->perms_is_admin,
				'edit_avatar'		=> $this->lang->perms_edit_avatar,
				'edit_profile'		=> $this->lang->perms_edit_profile,
				'edit_sig'		=> $this->lang->perms_edit_sig,
				'page_edit'             => $this->lang->perms_edit_pages, // Added for CMS
				'page_create'           => $this->lang->perms_create_pages, // Added for CMS
				'page_delete'           => $this->lang->perms_delete_pages, // Added for CMS
				'email_use'		=> $this->lang->perms_email_use,
				'topic_global'		=> $this->lang->perms_topic_global,
				'pm_noflood'		=> $this->lang->perms_pm_noflood,
				'search_noflood'	=> $this->lang->perms_search_noflood,
				'forum_view'		=> $this->lang->perms_forum_view,
				'post_viewip'		=> $this->lang->perms_post_viewip,
				'topic_view'		=> $this->lang->perms_topic_view,
				'topic_view_unpublished' => $this->lang->perms_topic_view_unpublished,
				'poll_create'		=> $this->lang->perms_poll_create,
				'poll_vote'		=> $this->lang->perms_poll_vote,
				'post_create'		=> $this->lang->perms_post_create,
				'topic_create'		=> $this->lang->perms_topic_create,
				'post_inc_userposts'	=> $this->lang->perms_post_inc_userposts,
				'post_noflood'		=> $this->lang->perms_post_noflood,
				'post_delete'		=> $this->lang->perms_post_delete,
				'post_delete_own'	=> $this->lang->perms_post_delete_own,
				'post_delete_old'	=> $this->lang->perms_post_delete_old,
				'topic_delete'		=> $this->lang->perms_topic_delete,
				'topic_delete_own'	=> $this->lang->perms_topic_delete_own,
				'post_edit'		=> $this->lang->perms_post_edit,
				'post_edit_own'		=> $this->lang->perms_post_edit_own,
				'post_edit_old'		=> $this->lang->perms_post_edit_old,
				'topic_edit'		=> $this->lang->perms_topic_edit,
				'topic_edit_own'	=> $this->lang->perms_topic_edit_own,
				'topic_lock'		=> $this->lang->perms_topic_lock,
				'topic_lock_own'	=> $this->lang->perms_topic_lock_own,
				'topic_unlock'		=> $this->lang->perms_topic_unlock,
				'topic_unlock_own'	=> $this->lang->perms_topic_unlock_own,
				'topic_pin'		=> $this->lang->perms_topic_pin,
				'topic_pin_own'		=> $this->lang->perms_topic_pin_own,
				'topic_publish'		=> $this->lang->perms_topic_publish,
				'topic_publish_auto'	=> $this->lang->perms_topic_publish_auto,
				'topic_split'		=> $this->lang->perms_topic_split,
				'topic_split_own'	=> $this->lang->perms_topic_split_own,
				'topic_unpin'		=> $this->lang->perms_topic_unpin,
				'topic_unpin_own'	=> $this->lang->perms_topic_unpin_own,
				'topic_move'		=> $this->lang->perms_topic_move,
				'topic_move_own'	=> $this->lang->perms_topic_move_own,
				'post_attach'		=> $this->lang->perms_post_attach,
				'post_attach_download'	=> $this->lang->perms_post_attach_download
		);

		if( !isset( $this->post['submit'] ) ) {
			$token = $this->generate_token();

			$count = count( $perms ) + 1;

			if( $mode == 'user' ) {
				$stmt = $this->db->prepare_query( 'SELECT user_name, user_perms FROM %pusers WHERE user_id=?' );

            $stmt->bind_param( 'i', $this->post['group'] );
            $this->db->execute_query( $stmt );

            $result = $stmt->get_result();
            $query = $this->db->nqfetch( $result );
            $stmt->close();

				$label = "{$this->lang->perms_user} '{$query['user_name']}'";
			} else {
				$stmt = $this->db->prepare_query( 'SELECT group_name FROM %pgroups WHERE group_id=?' );

            $stmt->bind_param( 'i', $this->post['group'] );
            $this->db->execute_query( $stmt );

            $result = $stmt->get_result();
            $query = $this->db->nqfetch( $result );
            $stmt->close();

				$label = "{$this->lang->perms_group} '{$query['group_name']}'";
			}

			$out = "
			<script src='{$this->site}/javascript/permissions.js' async defer></script>

			<form id='form' action='$this->site/admincp/index.php?a=perms$link' method='post'>
			<div class='article'><div class='title'><img src='$this->site/skins/$this->skin/images/icons/group_edit.png' alt=''> {$this->lang->perms_for} $label</div>";

			if( $mode == 'user' ) {
				$out .= "<br>{$this->lang->perms_override_user}<br><br>
				<div style='border:1px dashed #ff0000; width:25%; padding:5px'><input type='checkbox' name='usegroup' id='usegroup' style='vertical-align:middle'" . (!$query['user_perms'] ? ' checked' : '') . "> <label for='usegroup' style='vertical-align:middle'>{$this->lang->perms_only_user}</label></div>";
			}

			$out .= "</div>
			<div class='article'><table>
			<tr>
				<td colspan='8' class='header'>{$this->lang->perms_global}</td>
			</tr>";

			$globals = array();
			$locals = array();

			foreach( $perms as $perm => $label ) {
				if( isset( $perms_obj->globals[$perm] ) )
					$globals[$perm] = $label;
				else
					$locals[$perm] = $label;
			}

			$i = 0;
			$out .= "<tr>\n";

			foreach( $globals as $perm => $label )
			{
				$out .= "<td style='width:15%'>$label</td>\n<td align='center'>\n" . 
					"<input type='checkbox' name='perms[$perm][-1]' id='perms_{$perm}' onclick='checkrow(\"$perm\", this.checked)'" . ($perms_obj->auth($perm) ? ' checked=\'checked\'' : '') . ">All\n" .
					"</td>\n";
				if ( ++$i == 4 ) {
					$i = 0;
					$out .= '</tr><tr>';
				}
			}

			while( $i++ < 4 ) {
				$out .= "<td></td><td></td>";
			}

			$out .= "</tr>";
			$out .= "<tr>
				<td colspan='8' class='footer' align='center'><input type='hidden' name='group' value='{$this->post['group']}'><input type='submit' name='submit' value='{$this->lang->perms_update}'></td>
			</tr></table></div>";

			$out .= "<div class='article'><table><tr><td colspan='" . ($count + 1) . "' class='header'>{$this->lang->perms_forum}</td></tr>";

			$chunks = array_chunk( $locals, 8, true );

			foreach( $chunks as $perms_chunk ) {
				if( $perms_chunk != $chunks[0] )

				$out .= "
				<tr>
					<td colspan='" . ($count + 1) . "' class='footer' align='center'><input type='hidden' name='group' value='{$this->post['group']}'><input type='submit' name='submit' value='{$this->lang->perms_update}'></td>
				</tr>";

				$out .= "<tr>\n";
				$out .= $this->show_perm_headers( $perms_obj, $perms_chunk );

				$i = count( $perms_chunk );
				while( $i++ < count( $chunks[0] ) )
					$out .= "<td class='subheader'></td>";
				$out .= "</tr>";

				foreach( $forums_list as $forum ) {
					$out .= "<tr>\n";
					$out .= "  <td>{$forum['forum_name']}</td>\n";
					$i = 0;

					foreach( $perms_chunk as $perm => $label ) {
						$checked = ( $perms_obj->auth( $perm, $forum['forum_id'] ) ) ? " checked='checked'" : '';
						$out .= "  <td align='center'>\n";
						$out .= "    <input type='checkbox' name='perms[$perm][{$forum['forum_id']}]' onclick='changeall(\"$perm\", this.checked)'$checked>\n";
						$out .= "  </td>\n";
						$i++;
					}

					while( $i++ < count( $chunks[0] ) )
						$out .= "<td></td>";
					$out .= "</tr>\n";
				}
			}

			$out .= "
			<tr>
				<td colspan='" . ($count + 1) . "' class='footer' align='center'><input type='hidden' name='token' value='{$token}'><input type='hidden' name='group' value='{$this->post['group']}'><input type='submit' name='submit' value='{$this->lang->perms_update}'></td>
			</tr>
			</table></div></form>";

			return $out;
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->perms, $this->lang->invalid_token );
			}

			if( ( $mode == 'user' ) && isset( $this->post['usegroup'] ) ) {
				$perms_obj->cube = '';
				$perms_obj->update();

				return $this->message( $this->lang->perms, $this->lang->perms_user_inherit );
			}

			$perms_obj->reset_cube( false );

			if( !isset( $this->post['perms'] ) ) {
				$this->post['perms'] = array();
			}

			if( $mode == 'user' ) {
				if( ( !isset( $this->post['perms']['do_anything'] ) ) && ( $this->post['group'] == USER_GUEST_UID ) ) {
					return $this->message( $this->lang->perms, $this->lang->perms_guest1 );
				}
			} else {
				if( ( !isset( $this->post['perms']['do_anything'] ) ) && ( $this->post['group'] == USER_GUEST ) ) {
					return $this->message( $this->lang->perms, $this->lang->perms_guest2 );
				}
			}

			foreach( $this->post['perms'] as $name => $data )
			{
				if( isset( $data[-1] ) || isset( $data['-1'] ) || ( count( $data ) == count( $forums_list ) ) ) {
					$perms_obj->set_xy( $name, true );
				} else {
					foreach( $data as $forum => $on )
					{
						$perms_obj->set_xyz( $name, intval( $forum ), true );
					}
				}
			}

			$perms_obj->update();

			$this->check_subscriptions( $mode, $this->post['group'] );

			return $this->message( $this->lang->perms, $this->lang->perms_updated );
		}
	}

	private function show_headers( $forums_list )
	{
		$out = "<tr>
		<td class='subheader' colspan='2' valign='bottom'>{$this->lang->perm}</td>";

		foreach( $forums_list as $forum )
		{
			$out .= "\n<td class='subheader' align='center' valign='middle'>{$forum['forum_name']}</td>";
		}

		return $out . '</tr>';
	}

	private function show_perm_headers( &$perms_obj, $perms )
	{
		$out = "<td class='subheader' valign='bottom'>{$this->lang->perm}</td>\n";

		foreach( $perms as $perm => $label ) {
			if( isset( $perms_obj->globals[$perm] ) )
				continue;
			$out .= "  <td class='subheader' align='center' valign='middle'>$label</td>";
		}
		return $out;
	}

	/**
	 * Delete subscriptions that have now been made
	 * illegal due to permissions change
	 *
	 * @param string $mode contains group or user
	 * @param integer $group group or user id
	 * @author Jonathan West <jon@quicksilverforums.com>
	 * @since 1.3.2
	 **/
	private function check_subscriptions( $mode, $group )
	{
		if( $mode == 'user' ) {
			$stmt = $this->db->prepare_query( 'SELECT s.subscription_user, s.subscription_item, s.subscription_type, u.user_id, u.user_group, u.user_perms
				FROM %psubscriptions s, %pusers u
				WHERE s.subscription_user=?
				AND s.subscription_user=u.user_id' );

         $stmt->bind_param( 'i', $group );
         $this->db->execute_query( $stmt );

         $query = $stmt->get_result();
         $stmt->close();

			while( $sub = $this->db->nqfetch( $query ) ) //if the user has subscriptions
			{
				$perms = new permissions( $this );

				$perms->get_perms( $sub['user_group'], $sub['user_id'], $sub['user_perms'] );

				if( $sub['subscription_type'] == 'forum' ) {
					if( !$perms->auth( 'forum_view', $sub['subscription_item'] ) ) { //if user can no longer view forum
						$stmt = $this->db->prepare_query( 'DELETE FROM %psubscriptions WHERE subscription_user=? AND subscription_item=?' );

                  $stmt->bind_param( 'ii', $sub['user_id'], $sub['subscription_item'] );
                  $this->db->execute_query( $stmt );
                  $stmt->close();
					}
				} else {
					$stmt = $this->db->prepare_query( 'SELECT topic_forum FROM %ptopics WHERE topic_id=?' );

               $stmt->bind_param( 'i', $sub['subscription_item'] );
               $this->db->execute_query( $stmt );

               $result = $stmt->get_result();
               $check = $this->db->nqfetch( $result );
               $stmt->close();

					if( !$perms->auth( 'forum_view', $check['topic_forum'] ) ) { //if user can no longer view forum
						$stmt = $this->db->prepare_query( 'DELETE FROM %psubscriptions WHERE subscription_user=? AND subscription_item=?' );

                  $stmt->bind_param( 'ii', $sub['user_id'], $sub['subscription_item'] );
                  $this->db->execute_query( $stmt );
                  $stmt->close();
					}
				}
			}
		} else { //if a member of the group has subscriptions
			$stmt = $this->db->prepare_query( 'SELECT s.subscription_user, s.subscription_item, s.subscription_type, u.user_id, u.user_group, g.group_perms
				FROM %psubscriptions s, %pusers u, %pgroups g
				WHERE g.group_id=? AND u.user_group=g.group_id AND s.subscription_user=u.user_id' );

         $stmt->bind_param( 'i', $group );
         $this->db->execute_query( $stmt );

         $query = $stmt->get_result();
         $stmt->close();

			while( $sub = $this->db->nqfetch( $query ) )
			{
				$perms = new permissions( $this );

				$perms->get_perms( $sub['user_group'], $sub['user_id'], $sub['group_perms'] );

				if( $sub['subscription_type'] == 'forum' ) {
					if( !$perms->auth( 'forum_view', $sub['subscription_item'] ) ) { //if user can no longer view forum
						$stmt = $this->db->prepare_query( 'DELETE FROM %psubscriptions WHERE subscription_user=? AND subscription_item=?' );

                  $stmt->bind_param( 'ii', $sub['user_id'], $sub['subscription_item'] );
                  $this->db->execute_query( $stmt );
                  $stmt->close();
					}
				} else {
					$stmt = $this->db->prepare_query( 'SELECT topic_forum FROM %ptopics WHERE topic_id=?' );

               $stmt->bind_param( 'i', $sub['subscription_item'] );
               $this->db->execute_query( $stmt );

               $result = $stmt->get_result();
               $check = $this->db->nqfetch( $result );
               $stmt->close();

					if( !$perms->auth( 'forum_view', $check['topic_forum'] ) ) { //if user can no longer view forum
						$stmt = $this->db->prepare_query( 'DELETE FROM %psubscriptions WHERE subscription_user=? AND subscription_item=?' );

                  $stmt->bind_param( 'ii', $sub['user_id'], $sub['subscription_item'] );
                  $this->db->execute_query( $stmt );
                  $stmt->close();
					}
				}
			}
		}
	}
}
?>