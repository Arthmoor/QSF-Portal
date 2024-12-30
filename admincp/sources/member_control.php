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
 * Member Control Panel
 *
 * @author Roger Libiez
 * @since 2.0
 **/
class member_control extends admin
{
	public function execute()
	{
		$this->set_title( $this->lang->mc );
		$this->tree( $this->lang->mc, "{$this->site}/admincp/index.php?a=member_control&amp;s=profile" );

		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		if( !isset( $this->get['id'] ) ) {
			if( !isset( $this->post['membername'] ) ) {
				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/member_control.xtpl' );

				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'skin', $this->skin );
				$xtpl->assign( 's', $this->get['s'] );
				$xtpl->assign( 'mc', $this->lang->mc );
				$xtpl->assign( 'mc_find', $this->lang->mc_find );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'MemberControl.ChooseForm' );
				$xtpl->parse( 'MemberControl' );

				return $xtpl->text( 'MemberControl' );
			} else {
				$stmt = $this->db->prepare_query( 'SELECT user_id, user_name FROM %pusers WHERE user_name LIKE ? LIMIT 250' );

            $name = "%{$this->post['membername']}%";
            $stmt->bind_param( 's', $name );
            $this->db->execute_query( $stmt );

            $query = $stmt->get_result();
            $stmt->close();

				if( !$this->db->num_rows( $query ) ) {
					return $this->message( $this->lang->mc, "{$this->lang->mc_not_found} \"{$this->post['membername']}\"" );
				}

				$ret = null;

				if( $this->get['s'] == 'profile' ) {
					$link = 'a=member_control&amp;s=profile';
				} elseif( $this->get['s'] == 'perms' ) {
					$link = 'a=perms&amp;s=user';
				} elseif( $this->get['s'] == 'file_perms' ) {
					$link = 'a=file_perms&amp;s=user';
				} else {
					$link = 'a=member_control&amp;s=delete';
				}

				while( $member = $this->db->nqfetch( $query ) )
				{
					$ret .= "<a href='{$this->site}/admincp/index.php?$link&amp;id=" . $member['user_id'] . "'>{$member['user_name']}</a><br>";
				}

				return $this->message( $this->lang->mc, "{$this->lang->mc_found}<br><br>$ret" );
			}
		}

		$id = intval( $this->get['id'] );

		switch( $this->get['s'] )
		{
		case 'delete':
			$this->tree( $this->lang->mc_delete );

			if( $id == USER_GUEST_UID ) {
				return $this->message( $this->lang->mc_delete, $this->lang->mc_guest_needed );
			}

			if( !isset( $this->post['submit'] ) ) {
				$stmt = $this->db->prepare_query( 'SELECT user_name FROM %pusers WHERE user_id=?' );

            $stmt->bind_param( 'i', $id );
            $this->db->execute_query( $stmt );

            $result = $stmt->get_result();
            $member = $this->db->nqfetch( $result );
            $stmt->close();

				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/member_control.xtpl' );

				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'skin', $this->skin );
				$xtpl->assign( 'id', $id );
				$xtpl->assign( 'mc_delete', $this->lang->mc_delete );
				$xtpl->assign( 'user_name', $member['user_name'] );
				$xtpl->assign( 'mc_confirm', $this->lang->mc_confirm );
				$xtpl->assign( 'token', $this->generate_token() );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'MemberControl.DeleteForm' );
				$xtpl->parse( 'MemberControl' );

				return $xtpl->text( 'MemberControl' );
			} else {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->mc_delete, $this->lang->invalid_token );
				}

				$this->delete_member_account( $id );

				return $this->message( $this->lang->mc_delete, $this->lang->mc_deleted );
			}
			break;

		case 'profile':
			$this->tree( $this->lang->mc_edit );

			if( isset( $this->post['memberspambot'] ) ) {
				$stmt = $this->db->prepare_query( 'SELECT * FROM %pusers WHERE user_id=?' );

            $stmt->bind_param( 'i', $id );
            $this->db->execute_query( $stmt );

            $result = $stmt->get_result();
            $member = $this->db->nqfetch( $result );
            $stmt->close();

				$this->lang->mc_confirm_bot = sprintf( $this->lang->mc_confirm_bot, $member['user_name'] );

				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/member_control.xtpl' );

				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'skin', $this->skin );
				$xtpl->assign( 'id', $id );
				$xtpl->assign( 'mc_delete', $this->lang->mc_delete );
				$xtpl->assign( 'user_name', $member['user_name'] );
				$xtpl->assign( 'mc_confirm_bot', $this->lang->mc_confirm_bot );
				$xtpl->assign( 'yes', $this->lang->yes );
				$xtpl->assign( 'token', $this->generate_token() );

				$xtpl->parse( 'MemberControl.Spambot' );
				$xtpl->parse( 'MemberControl' );

				return $xtpl->text( 'MemberControl' );
			}

			if( isset( $this->post['confirm_spambot'] ) ) {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->mc_delete, $this->lang->invalid_token );
				}

				$id = intval( $this->post['member'] );
				$stmt = $this->db->prepare_query( 'SELECT * FROM %pusers WHERE user_id=?' );

            $stmt->bind_param( 'i', $id );
            $this->db->execute_query( $stmt );

            $result = $stmt->get_result();
            $member = $this->db->nqfetch( $result );
            $stmt->close();

				require_once $this->sets['include_path'] . '/lib/akismet.php';
				$akismet = new Akismet( $this );
				$akismet->set_comment_author( $member['user_name'] );
				$akismet->set_comment_author_email( $member['user_email'] );
				$akismet->set_comment_author_url( $member['user_homepage'] );
				$akismet->set_comment_ip( $member['user_regip'] );
				if( isset( $member['user_interests'] ) )
					$akismet->set_comment_content( $member['user_interests'] );
				$akismet->set_comment_referrer( $svars['HTTP_REFERER'] );
				$akismet->set_comment_useragent( $svars['HTTP_USER_AGENT'] );
				$akismet->set_comment_type( 'signup' );

				$akismet->submit_spam();

				$this->delete_member_account( $id );

				return $this->message( $this->lang->mc_delete, $this->lang->mc_deleted );
			}

			if( !isset( $this->post['submit'] ) ) {
				$stmt = $this->db->prepare_query( 'SELECT * FROM %pusers WHERE user_id=?' );

            $stmt->bind_param( 'i', $id );
            $this->db->execute_query( $stmt );

            $result = $stmt->get_result();
            $member = $this->db->nqfetch( $result );
            $stmt->close();

				$out = '';

				define( 'U_IGNORE', 0 );
				define( 'U_TEXT', 1 );
				define( 'U_BOOL', 2 );
				define( 'U_BLOB', 3 );
				define( 'U_DATE', 4 );
				define( 'U_TIME', 5 );
				define( 'U_FLOAT', 6 );
				define( 'U_INT', 7 );
				define( 'U_CALLBACK', 8 );
				define( 'U_TZONE', 9 );
				define( 'U_IP', 10 );
				define( 'U_SVARS', 11 );

				$cols = array(
					'user_name'		=> array( $this->lang->mc_user_name, U_TEXT, 20 ),
					'user_email'		=> array( $this->lang->mc_user_email, U_TEXT, 100 ),
					'user_group'		=> array( $this->lang->mc_user_group, U_CALLBACK, 'list_groups' ),
					'user_title'		=> array( $this->lang->mc_user_title, U_TEXT, 100 ),
					'user_title_custom'	=> array( $this->lang->mc_user_title_custom, U_BOOL ),
					'user_language'		=> array( $this->lang->mc_user_language, U_CALLBACK, 'list_langs' ),
					'user_skin'		=> array( $this->lang->mc_user_skin, U_CALLBACK, 'list_skins' ),
					'user_avatar'		=> array( $this->lang->mc_user_avatar, U_TEXT, 150 ),
					'user_avatar_type'	=> array( $this->lang->mc_user_avatar_type, U_CALLBACK, 'list_user_avatar_types' ),
					'user_avatar_width'	=> array( $this->lang->mc_user_avatar_width, U_INT, 3 ),
					'user_avatar_height'	=> array( $this->lang->mc_user_avatar_height, U_INT, 3 ),
					'user_level'		=> array( $this->lang->mc_user_level, U_TEXT, 2 ),
					'user_timezone'		=> array( $this->lang->mc_user_timezone, U_TZONE ),
					'user_location'		=> array( $this->lang->mc_user_location, U_TEXT, 100 ),
					'user_twitter'		=> array( $this->lang->mc_user_twitter, U_TEXT, 50 ),
					'user_facebook'		=> array( $this->lang->mc_user_facebook, U_TEXT, 255 ),
					'user_homepage'		=> array( $this->lang->mc_user_homepage, U_TEXT, 255 ),
					'user_interests'	=> array( $this->lang->mc_user_interests, U_BLOB, 255 ),
					'user_signature'	=> array( $this->lang->mc_user_signature, U_BLOB, 255 ),
					'user_posts'		=> array( $this->lang->mc_user_posts, U_INT, 10 ),
					'user_uploads'		=> array( $this->lang->mc_user_uploads, U_INT, 10 ),
					'user_pm'		=> array( $this->lang->mc_user_pm, U_BOOL ),
					'user_pm_mail'		=> array( $this->lang->mc_user_pm_mail, U_BOOL ),
					'user_view_avatars'	=> array( $this->lang->mc_user_view_avatars, U_BOOL ),
					'user_view_signatures'	=> array( $this->lang->mc_user_view_signatures, U_BOOL ),
					'user_view_emojis'	=> array( $this->lang->mc_user_view_emojis, U_BOOL ),
					'user_id'		=> array( $this->lang->mc_user_id, U_IGNORE ),
					'user_joined'		=> array( $this->lang->mc_user_joined, U_TIME ),
					'user_lastvisit'	=> array( $this->lang->mc_user_lastvisit, U_TIME ),
					'user_lastpost'		=> array( $this->lang->mc_user_lastpost, U_TIME ),
					'user_regip'		=> array( $this->lang->mc_user_regip, U_IGNORE ),
               'user_register_email'   => array( $this->lang->mc_user_regemail, U_IGNORE ),
					'user_server_data'	=> array( $this->lang->mc_user_server_data, U_SVARS )
				);

				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/member_control.xtpl' );

				foreach( $cols as $var => $data )
				{
					if( !isset( $member[$var] ) ) {
						continue;
					}

					$val = $member[$var];

					if( ( $var == 'user_location' ) || ( $var == 'user_signature' ) || ( $var == 'user_email' ) || ( $var == 'user_register_email' ) || ( $var == 'user_title' ) ) {
						$val = $this->format( $val, FORMAT_HTMLCHARS );
					}

					$line = '';

					switch( $data[1] )
					{
					case U_TZONE:
						$time_list  = $this->htmlwidgets->select_timezones( $val );
						$line = '<select class="select timezone" name="user_timezone">' . $time_list . '</select>';
						break;

					case U_IGNORE:
						if( !isset( $cols[$var][2] ) ) {
							$line = $val;
						} else {
							if( $val ) {
								$line = $this->lang->yes;
							} else {
								$line = $this->lang->no;
							}
						}
						break;

					case U_IP:
						$line = $val == 0 ? '127.0.0.1' : long2ip( $val );
						break;

					case U_TIME:
						$line = $val ? date( 'Y-m-d, H:i:s', $val ) : '-';
						break;

					case U_DATE:
						$line = $val ? date( 'Y-m-d', $val ) : '-';
						break;

					case U_BOOL:
						$line = '<select name="' . $var . '"><option value="1"' . ($val ? ' selected="selected"' : '') . '>' . $this->lang->yes .'</option><option value="0"' . (!$val ? ' selected="selected"' : '') . '>' . $this->lang->no . '</option></select>';
						break;

					case U_FLOAT:
						$cols[$var][2] += 3;

					case U_TEXT:
					case U_INT:
						$line = '<input class="input" type="text" name="'. $var . '" value="' . $val . '" size="50" maxlength="' . $cols[$var][2] . '">';
						break;

					case U_BLOB:
						$line = '<textarea class="input" name="' . $var . '" rows="5" cols="49">' . $val . '</textarea>';
						break;

					case U_CALLBACK:
						$line = $this->{$cols[$var][2]}($val);
						break;

					case U_SVARS:
						$svars = json_decode( $val, true );

                  if( $svars != null )
                     foreach( $svars as $name => $value )
                        $line .= $name . ': ' . $value . '<br>';
						break;
					default:
						$line = $val;
					}

					$xtpl->assign( 'field', $cols[$var][0] );
					$xtpl->assign( 'line', $line );

					$xtpl->parse( 'MemberControl.EditForm.Line' );
				}

				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'skin', $this->skin );
				$xtpl->assign( 'id', $id );
				$xtpl->assign( 'mc', $this->lang->mc );
				$xtpl->assign( 'mc_report_spambot', $this->lang->mc_report_spambot );
				$xtpl->assign( 'token', $this->generate_token() );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'MemberControl.EditForm' );
				$xtpl->parse( 'MemberControl' );

				return $xtpl->text( 'MemberControl' );
			} else {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->mc_edit, $this->lang->invalid_token );
				}

				$stmt = $this->db->prepare_query( 'SELECT user_name FROM %pusers WHERE user_id=?' );

            $stmt->bind_param( 'i', $id );
            $this->db->execute_query( $stmt );

            $result = $stmt->get_result();
            $member = $this->db->nqfetch( $result );
            $stmt->close();

				if( ( $this->post['user_group'] == USER_BANNED ) && ( $id == USER_GUEST_UID ) ) {
					return $this->message( $this->lang->mc, $this->lang->mc_guest_banned );
				}

				$guest_email = $this->post['user_email'];
				if( $member['user_name'] != 'Guest' && !$this->validator->validate( $guest_email, TYPE_EMAIL ) ) {
					return $this->message( $this->lang->mc_err_updating, $this->lang->mc_email_invaid );
				}

				if( !isset( $this->post['user_view_avatars'] ) ) {
					$this->post['user_view_avatars'] = 0;
				}

				if( !isset( $this->post['user_view_signatures'] ) ) {
					$this->post['user_view_signatures'] = 0;
				}

				if( !isset( $this->post['user_view_emojis'] ) ) {
					$this->post['user_view_emojis'] = 0;
				}

				if( !isset( $this->post['user_pm'] ) ) {
					$this->post['user_pm'] = 0;
				}

				if( !isset( $this->post['user_pm_mail'] ) ) {
					$this->post['user_pm_mail'] = 0;
				}

				if( !empty( $this->post['user_homepage'] ) && ( ( substr( $this->post['user_homepage'], 0, 7 ) != 'http://' ) && ( substr( $this->post['user_homepage'], 0, 8 ) != 'https://' ) ) ) {
					$this->post['user_homepage'] = 'https://' . $this->post['user_homepage']; // It's 2025 - Assume a secure URL
				}

				$user_name = $this->format( $this->post['user_name'], FORMAT_HTMLCHARS | FORMAT_CENSOR );
				$user_group = intval( $this->post['user_group'] );
				$user_title = $this->post['user_title'];
				$user_title_custom = intval( $this->post['user_title_custom'] );
				$user_language = $this->post['user_language'];
				$user_skin = $this->post['user_skin'];
				$user_avatar_type = $this->post['user_avatar_type'];
            if( $user_avatar_type != 'none' )
               $user_avatar = $this->post['user_avatar'];
            else
               $user_avatar = '';
				$user_avatar_width = intval( $this->post['user_avatar_width'] );
				$user_avatar_height = intval( $this->post['user_avatar_height'] );
				$user_level = intval( $this->post['user_level'] );
				$user_timezone = $this->post['user_timezone'];

            if( isset( $this->post['user_location'] ) )
               $user_location = $this->format( $this->post['user_location'], FORMAT_HTMLCHARS );
            else
               $user_location = '';
            if( isset( $this->post['user_homepage'] ) )
               $user_homepage = $this->format( $this->post['user_homepage'], FORMAT_HTMLCHARS );
            else
               $user_homepage = '';
            if( isset( $this->post['user_facebook'] ) )
               $user_facebook = $this->format( $this->post['user_facebook'], FORMAT_HTMLCHARS );
            else
               $user_facebook = '';
            if( isset( $this->post['user_twitter'] ) )
            	$user_twitter = $this->format( $this->post['user_twitter'], FORMAT_HTMLCHARS );
            else
               $user_twitter = '';
            if( isset( $this->post['user_interests'] ) )
               $user_interests = $this->format( $this->post['user_interests'], FORMAT_HTMLCHARS );
            else
               $user_interests = '';
            if( isset( $this->post['user_signature'] ) )
               $user_signature = $this->post['user_signature'];
            else
               $user_signature = '';

				$user_posts = intval( $this->post['user_posts'] );
				$user_uploads = intval( $this->post['user_uploads'] );
				$user_pm = intval( $this->post['user_pm'] );
				$user_pm_mail = intval( $this->post['user_pm_mail'] );
				$user_view_avatars = intval( $this->post['user_view_avatars'] );
				$user_view_signatures = intval( $this->post['user_view_signatures'] );
				$user_view_emojis = intval( $this->post['user_view_emojis'] );

				$stmt = $this->db->prepare_query( 'UPDATE %pusers SET user_name=?, user_email=?, user_group=?, user_title=?,
				  user_title_custom=?, user_language=?, user_skin=?, user_avatar=?,
				  user_avatar_type=?, user_avatar_width=?, user_avatar_height=?, user_level=?,
				  user_timezone=?, user_location=?, user_homepage=?, user_facebook=?,
				  user_interests=?, user_signature=?, user_posts=?, user_uploads=?,
				  user_twitter=?, user_pm=?, user_pm_mail=?, user_view_avatars=?,
				  user_view_signatures=?, user_view_emojis=? WHERE user_id=?' );

            $stmt->bind_param( 'ssisisissiiissssssiisiiiiii',
              $user_name, $guest_email, $user_group, $user_title, $user_title_custom, $user_language, $user_skin,
				  $user_avatar, $user_avatar_type, $user_avatar_width, $user_avatar_height, $user_level,
				  $user_timezone, $user_location, $user_homepage, $user_facebook, $user_interests,
				  $user_signature, $user_posts, $user_uploads, $user_twitter, $user_pm, $user_pm_mail, $user_view_avatars,
				  $user_view_signatures, $user_view_emojis, $id );

            $this->db->execute_query( $stmt );
            $stmt->close();

				if( $user_group == USER_BANNED ) {
					$this->db->query( 'DELETE FROM %psubscriptions WHERE subscription_user=?' );

               $stmt->bind_param( 'i', $id );
               $this->db->execute_query( $stmt );
               $stmt->close();
				}
				if( ( $id == $this->sets['last_member_id'] )
				&& ( $this->post['user_name'] != $this->sets['last_member'] ) ) {
					$this->sets['last_member'] = $this->post['user_name'];
					$this->write_sets();
				}

				return $this->message( $this->lang->mc_edit, $this->lang->mc_edited );
			}
			break;

		default:
			return $this->message( $this->lang->mc, "<a href='{$this->site}/admincp/index.php?a=member_control&amp;s=profile'>{$this->lang->mc_edit}</a><br>" );
		}
	}

	private function list_skins( $val )
	{
		$out = "<select name='user_skin'>";

		$out .= $this->htmlwidgets->select_skins( $val );

		return $out . '</select>';
	}

	private function list_user_avatar_types( $val )
	{
		$out = "<select name='user_avatar_type'>";

		$types = array( 'local', 'url', 'uploaded', 'gravatar', 'none' );

		foreach( $types as $type )
		{
			$out .= "<option value='$type'" . (($val == $type) ? ' selected=\'selected\'' : '') . ">$type</option>";
		}

		return $out . '</select>';
	}

	private function list_langs( $current )
	{
		$out = "<select name='user_language'>";

		$out .= $this->htmlwidgets->select_langs( $current, '..' );

		return $out . '</select>';
	}

	private function delete_member_account( $id )
	{
      $guest_id = intval( USER_GUEST_UID );

      $stmt = $this->db->prepare_query( 'SELECT user_name FROM %pusers WHERE user_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $name = $this->db->nqfetch( $result );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %pposts SET post_author=? WHERE post_author=?' );

      $stmt->bind_param( 'ii', $guest_id, $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %pposts SET post_edited_by=? WHERE post_edited_by=?' );

      $stmt->bind_param( 'is', $guest_id, $name['user_name'] );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_starter=? WHERE topic_starter=?' );

      $stmt->bind_param( 'ii', $guest_id, $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_last_poster=? WHERE topic_last_poster=?' );

      $stmt->bind_param( 'ii', $guest_id, $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %plogs SET log_user=? WHERE log_user=?' );

      $stmt->bind_param( 'ii', $guest_id, $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %pfiles SET file_submitted=? WHERE file_submitted=? AND file_approved=1' );

      $stmt->bind_param( 'ii', $guest_id, $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %pfilecomments SET user_id=? WHERE user_id=?' );

      $stmt->bind_param( 'ii', $guest_id, $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$this->activeutil->delete( $id );

		$stmt = $this->db->prepare_query( 'DELETE FROM %psubscriptions WHERE subscription_user=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %pvotes WHERE vote_user=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %pfileratings WHERE user_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %pusers WHERE user_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %ppmsystem WHERE pm_to=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %ppmsystem WHERE pm_from=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %pconversations SET conv_starter=? WHERE conv_starter=?' );

      $stmt->bind_param( 'ii', $guest_id, $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %pconversations SET conv_last_poster=? WHERE conv_last_poster=?' );

      $stmt->bind_param( 'ii', $guest_id, $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %pconv_posts SET post_author=? WHERE post_author=?' );

      $stmt->bind_param( 'ii', $guest_id, $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %pconv_posts SET post_edited_by=? WHERE post_edited_by=?' );

      $stmt->bind_param( 'is', $guest_id, $name['user_name'] );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %preadmarks WHERE readmark_user=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %pconv_readmarks WHERE readmark_user=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'SELECT file_id, file_md5name FROM %pfiles WHERE file_submitted=? AND file_approved=0' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );

      $files = $stmt->get_result();
      $stmt->close();

      $file_query = $this->db->prepare_query( 'DELETE FROM %pfiles WHERE file_id=?' );
      $file_query->bind_param( 'i', $file_id );
		while( $file = $this->db->nqfetch( $files ) )
		{
			@unlink( './downloads/' . $file['file_md5name'] );

         $file_id = $file['file_id'];

         $this->db->execute_query( $file_query );
         $stmt->close();
		}
      $file_query->close();

		$stmt = $this->db->prepare_query( 'SELECT update_id, update_md5name FROM %pupdates WHERE update_updater=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );

      $updates = $stmt->get_result();
      $stmt->close();

      $update_query = $this->db->prepare_query( 'DELETE FROM %pupdates WHERE update_id=?' );
      $update_query->bind_param( 'i', $update_id );
		while( $update = $this->db->nqfetch( $updates ) )
		{
			@unlink( './updates/' . $update['update_md5name'] );

         $update_id = $update['update_id'];

         $this->db->execute_query( $update_query );
		}
      $update_query->close();

		$member = $this->db->fetch( 'SELECT user_id, user_name FROM %pusers ORDER BY user_id DESC LIMIT 1' );
		$counts = $this->db->fetch( 'SELECT COUNT(user_id) AS count FROM %pusers' );

		$this->sets['last_member'] = $member['user_name'];
		$this->sets['last_member_id'] = $member['user_id'];
		$this->sets['members'] = $counts['count']-1;
		$this->write_sets();
	}
}
?>