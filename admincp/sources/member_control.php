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

if (!defined('QUICKSILVERFORUMS') || !defined('QSF_ADMIN')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';

class member_control extends admin
{
	function execute()
	{
		$this->set_title( $this->lang->mc );
		$this->tree( $this->lang->mc, "$this->self?a=member_control&amp;s=profile" );

		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		if( !isset( $this->get['id'] ) ) {
			if( !isset( $this->post['membername'] ) ) {
				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/member_control.xtpl' );

				$xtpl->assign( 'self', $this->self );
				$xtpl->assign( 's', $this->get['s'] );
				$xtpl->assign( 'mc', $this->lang->mc );
				$xtpl->assign( 'mc_find', $this->lang->mc_find );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'MemberControl.ChooseForm' );
				$xtpl->parse( 'MemberControl' );

				return $xtpl->text( 'MemberControl' );
			} else {
				$query = $this->db->query( "SELECT user_id, user_name FROM %pusers WHERE user_name LIKE '%%%s%%' LIMIT 250", $this->post['membername'] );

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
					$ret .= "<a href='{$this->self}?$link&amp;id=" . $member['user_id'] . "'>{$member['user_name']}</a><br />";
				}

				return $this->message( $this->lang->mc, "{$this->lang->mc_found}<br /><br />$ret" );
			}
		}

		$id = intval( $this->get['id'] );

		switch( $this->get['s'] )
		{
		case 'delete':
			$this->tree ($this->lang->mc_delete );

			if( $id == USER_GUEST_UID) {
				return $this->message( $this->lang->mc_delete, $this->lang->mc_guest_needed );
			}

			if( !isset( $this->post['submit'] ) ) {
				$member = $this->db->fetch( "SELECT user_name FROM %pusers WHERE user_id=%d", $id );

				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/member_control.xtpl' );

				$xtpl->assign( 'self', $this->self );
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
				$member = $this->db->fetch( "SELECT * FROM %pusers WHERE user_id=%d", $id );

				$this->lang->mc_confirm_bot = sprintf( $this->lang->mc_confirm_bot, $member['user_name'] );

				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/member_control.xtpl' );

				$xtpl->assign( 'self', $this->self );
				$xtpl->assign( 'id', $id );
				$xtpl->assign( 'mc_delete', $this->lang->mc_delete );
				$xtpl->assign( 'user_name', $member['user_name'] );
				$xtpl->assign( 'mc_confirm_bot', $this->lang->mc_confirm_bot );
				$xtpl->assign( 'yes', $this->lang->yes );

				$xtpl->parse( 'MemberControl.Spambot' );
				$xtpl->parse( 'MemberControl' );

				return $xtpl->text( 'MemberControl' );
			}

			if( isset( $this->post['confirm_spambot'] ) ) {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->mc_delete, $this->lang->invalid_token );
				}

				$id = intval( $this->post['member'] );
				$member = $this->db->fetch( "SELECT * FROM %pusers WHERE user_id=%d", $id );

				$svars = json_decode( $member['user_server_data'], true );

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
				$member = $this->db->fetch("SELECT * FROM %pusers WHERE user_id=%d", $id );

				$out = '';

				define('U_IGNORE', 0);
				define('U_TEXT', 1);
				define('U_BOOL', 2);
				define('U_BLOB', 3);
				define('U_DATE', 4);
				define('U_TIME', 5);
				define('U_FLOAT', 6);
				define('U_INT', 7);
				define('U_CALLBACK', 8);
				define('U_TZONE', 9);
				define('U_IP', 10);

				$cols = array(
					'user_name'		=> array($this->lang->mc_user_name, U_TEXT, 20),
					'user_email'		=> array($this->lang->mc_user_email, U_TEXT, 100),
					'user_group'		=> array($this->lang->mc_user_group, U_CALLBACK, 'list_groups'),
					'user_title'		=> array($this->lang->mc_user_title, U_TEXT, 100),
					'user_title_custom'	=> array($this->lang->mc_user_title_custom, U_BOOL),
					'user_language'		=> array($this->lang->mc_user_language, U_CALLBACK, 'list_langs'),
					'user_skin'		=> array($this->lang->mc_user_skin, U_CALLBACK, 'list_skins'),
					'user_avatar'		=> array($this->lang->mc_user_avatar, U_TEXT, 150),
					'user_avatar_type'	=> array($this->lang->mc_user_avatar_type, U_CALLBACK, 'list_user_avatar_types'),
					'user_avatar_width'	=> array($this->lang->mc_user_avatar_width, U_INT, 3),
					'user_avatar_height'	=> array($this->lang->mc_user_avatar_height, U_INT, 3),
					'user_level'		=> array($this->lang->mc_user_level, U_TEXT, 2),
					'user_birthday'		=> array($this->lang->mc_user_birthday, U_TEXT, 10),
					'user_timezone'		=> array($this->lang->mc_user_timezone, U_TZONE),
					'user_location'		=> array($this->lang->mc_user_location, U_TEXT, 100),
					'user_homepage'		=> array($this->lang->mc_user_homepage, U_TEXT, 255),
					'user_interests'	=> array($this->lang->mc_user_interests, U_BLOB, 255),
					'user_signature'	=> array($this->lang->mc_user_signature, U_BLOB, 255),
					'user_posts'		=> array($this->lang->mc_user_posts, U_INT, 10),
					'user_uploads'		=> array($this->lang->mc_user_uploads, U_INT, 10),
					'user_icq'		=> array($this->lang->mc_user_icq, U_INT, 16),
					'user_msn'		=> array($this->lang->mc_user_msn, U_TEXT, 32),
					'user_aim'		=> array($this->lang->mc_user_aim, U_TEXT, 32),
					'user_twitter'		=> array($this->lang->mc_user_twitter, U_TEXT, 50),
					'user_yahoo'		=> array($this->lang->mc_user_yahoo, U_TEXT, 100),
					'user_email_show'	=> array($this->lang->mc_user_email_show, U_BOOL),
					'user_pm'		=> array($this->lang->mc_user_pm, U_BOOL),
					'user_pm_mail'		=> array($this->lang->mc_user_pm_mail, U_BOOL),
					'user_view_avatars'	=> array($this->lang->mc_user_view_avatars, U_BOOL),
					'user_view_signatures'	=> array($this->lang->mc_user_view_signatures, U_BOOL),
					'user_view_emoticons'	=> array($this->lang->mc_user_view_emoticons, U_BOOL),
					'user_id'		=> array($this->lang->mc_user_id, U_IGNORE),
					'user_joined'		=> array($this->lang->mc_user_joined, U_TIME),
					'user_lastvisit'	=> array($this->lang->mc_user_lastvisit, U_TIME),
					'user_lastpost'		=> array($this->lang->mc_user_lastpost, U_TIME),
					'user_regip'		=> array($this->lang->mc_user_regip, U_IGNORE),
                                        'user_register_email'   => array($this->lang->mc_user_regemail, U_IGNORE),
					'user_server_data'	=> array($this->lang->mc_user_server_data, U_IGNORE)
				);

				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/member_control.xtpl' );

				foreach( $cols as $var => $data )
				{
					if( !isset( $member[$var] ) ) {
						continue;
					}

					$val = $member[$var];

					if( ( $var == 'user_signature' ) || ( $var == 'user_email' ) || ( $var == 'user_register_email' ) || ( $var == 'user_title' ) ) {
						$val = $this->format( $val, FORMAT_HTMLCHARS );
					} elseif( ( $var == 'user_icq' ) && !$val ) {
						$val = null;
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
						$line = '<input class="input" type="text" name="'. $var . '" value="' . $val . '" size="50" maxlength="' . $cols[$var][2] . '" />';
						break;

					case U_BLOB:
						$line = '<textarea class="input" name="' . $var . '" rows="5" cols="49">' . $val . '</textarea>';
						break;

					case U_CALLBACK:
						$line = $this->{$cols[$var][2]}($val);
						break;

					default:
						$line = $val;
					}

					$xtpl->assign( 'field', $cols[$var][0] );
					$xtpl->assign( 'line', $line );

					$xtpl->parse( 'MemberControl.EditForm.Line' );
				}

				$xtpl->assign( 'self', $this->self );
				$xtpl->assign( 'id', $id );
				$xtpl->assign( 'mc', $this->lang->mc );
				$xtpl->assign( 'mc_report_spambot', $this->lang->mc_report_spambot );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'MemberControl.EditForm' );
				$xtpl->parse( 'MemberControl' );

				return $xtpl->text( 'MemberControl' );
			} else {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->mc_edit, $this->lang->invalid_token );
				}

				$member = $this->db->fetch( "SELECT user_name FROM %pusers WHERE user_id=%d", $id );

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

				if( !isset( $this->post['user_view_emoticons'] ) ) {
					$this->post['user_view_emoticons'] = 0;
				}

				if( !isset( $this->post['user_email_show'] ) ) {
					$this->post['user_email_show'] = 0;
				}

				if( !isset( $this->post['user_pm'] ) ) {
					$this->post['user_pm'] = 0;
				}

				if( !isset( $this->post['user_pm_mail'] ) ) {
					$this->post['user_pm_mail'] = 0;
				}

				if( !empty( $this->post['user_homepage'] ) && ( substr( $this->post['user_homepage'], 0, 7 ) != 'http://' ) ) {
					$this->post['user_homepage'] = 'http://' . $this->post['user_homepage'];
				}

				$user_name = $this->format( $this->post['user_name'], FORMAT_HTMLCHARS | FORMAT_CENSOR );
				$user_group = intval( $this->post['user_group'] );
				$user_title = $this->post['user_title'];
				$user_title_custom = intval( $this->post['user_title_custom'] );
				$user_language = $this->post['user_language'];
				$user_skin = $this->post['user_skin'];
				$user_avatar = $this->post['user_avatar'];
				$user_avatar_type = $this->post['user_avatar_type'];
				$user_avatar_width = intval( $this->post['user_avatar_width'] );
				$user_avatar_height = intval( $this->post['user_avatar_height'] );
				$user_level = intval( $this->post['user_level'] );
				$user_birthday = $this->post['user_birthday'];
				$user_timezone = $this->post['user_timezone'];
				$user_location = $this->format( $this->post['user_location'], FORMAT_HTMLCHARS );
				$user_homepage = $this->format( $this->post['user_homepage'], FORMAT_HTMLCHARS );
				$user_interests = $this->format( $this->post['user_interests'], FORMAT_HTMLCHARS );
				$user_signature = $this->post['user_signature'];
				$user_posts = intval( $this->post['user_posts'] );
				$user_uploads = intval( $this->post['user_uploads'] );
				$user_icq = intval( $this->post['user_icq'] );
				$user_msn = $this->format( $this->post['user_msn'], FORMAT_HTMLCHARS );
				$user_aim = $this->format( $this->post['user_aim'], FORMAT_HTMLCHARS );
				$user_twitter = $this->format( $this->post['user_twitter'], FORMAT_HTMLCHARS );
				$user_yahoo = $this->format( $this->post['user_yahoo'], FORMAT_HTMLCHARS );
				$user_email_show = intval( $this->post['user_email_show'] );
				$user_pm = intval( $this->post['user_pm'] );
				$user_pm_mail = intval( $this->post['user_pm_mail'] );
				$user_view_avatars = intval( $this->post['user_view_avatars'] );
				$user_view_signatures = intval( $this->post['user_view_signatures'] );
				$user_view_emoticons = intval( $this->post['user_view_emoticons'] );

				$this->db->query( "UPDATE %pusers SET user_name='%s', user_email='%s', user_group=%d, user_title='%s',
				  user_title_custom=%d, user_language='%s', user_skin='%s', user_avatar='%s',
				  user_avatar_type='%s', user_avatar_width=%d, user_avatar_height=%d, user_level=%d,
				  user_birthday='%s', user_timezone='%s', user_location='%s', user_homepage='%s',
				  user_interests='%s', user_signature='%s', user_posts=%d, user_uploads=%d,
				  user_icq=%d, user_msn='%s', user_aim='%s', user_twitter='%s', user_yahoo='%s',
				  user_email_show=%d, user_pm=%d, user_pm_mail=%d, user_view_avatars=%d,
				  user_view_signatures=%d, user_view_emoticons=%d WHERE user_id=%d",
				  $user_name, $guest_email, $user_group, $user_title, $user_title_custom, $user_language, $user_skin,
				  $user_avatar, $user_avatar_type, $user_avatar_width, $user_avatar_height, $user_level,
				  $user_birthday, $user_timezone, $user_location, $user_homepage, $user_interests,
				  $user_signature, $user_posts, $user_uploads, $user_icq, $user_msn, $user_aim,
				  $user_twitter, $user_yahoo, $user_email_show, $user_pm, $user_pm_mail, $user_view_avatars,
				  $user_view_signatures, $user_view_emoticons, $id );

				if( $user_group == USER_BANNED ) {
					$this->db->query( "DELETE FROM %psubscriptions WHERE subscription_user=%d", $id );
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
			return $this->message( $this->lang->mc, "<a href='{$this->self}?a=member_control&amp;s=profile'>{$this->lang->mc_edit}</a><br />" );
		}
	}

	function list_skins( $val )
	{
		$out = "<select name='user_skin'>";
		$groups = $this->db->query( "SELECT skin_name, skin_dir FROM %pskins ORDER BY skin_name" );

		while( $group = $this->db->nqfetch( $groups ) )
		{
			$out .= "<option value='{$group['skin_dir']}'" . (($val == $group['skin_dir']) ? ' selected=\'selected\'' : '') . ">{$group['skin_name']}</option>";
		}

		return $out . '</select>';
	}

	function list_user_avatar_types( $val )
	{
		$out = "<select name='user_avatar_type'>";
		$types = array( 'local', 'url', 'uploaded', 'gravatar', 'none' );

		foreach( $types as $type )
		{
			$out .= "<option value='$type'" . (($val == $type) ? ' selected=\'selected\'' : '') . ">$type</option>";
		}

		return $out . '</select>';
	}

	function list_langs( $current )
	{
		$out = "<select name='user_language'>";
		$dir = opendir( '../languages' );

		while( ( $file = readdir( $dir ) ) !== false )
		{
			if( is_dir( '../languages/' . $file ) ) {
				continue;
			}

			$code = substr( $file, 0, -4 );
			$ext  = substr( $file, -4 );
			if( $ext != '.php' ) {
				continue;
			}

			$out .= '<option value="' . $code . '"' . (($code == $current) ? ' selected=\'selected\'' : null) . '>' . $this->htmlwidgets->get_lang_name($code) . "</option>\n";
		}

		return $out . '</select>';
	}

	function delete_member_account( $id )
	{
		$this->db->query( "UPDATE %pposts SET post_author=%d WHERE post_author=%d", USER_GUEST_UID, $id );
		$this->db->query( "UPDATE %pposts SET post_edited_by=%d WHERE post_edited_by=%d", USER_GUEST_UID, $id );
		$this->db->query( "UPDATE %ptopics SET topic_starter=%d WHERE topic_starter=%d", USER_GUEST_UID, $id );
		$this->db->query( "UPDATE %ptopics SET topic_last_poster=%d WHERE topic_last_poster=%d", USER_GUEST_UID, $id );
		$this->db->query( "UPDATE %plogs SET log_user=%d WHERE log_user=%d", USER_GUEST_UID, $id );
		$this->db->query( "UPDATE %pfiles SET file_submitted=%d WHERE file_submitted=%d AND file_approved=1", USER_GUEST_UID, $id );
		$this->db->query( "UPDATE %pfilecomments SET user_id=%d WHERE user_id=%d", USER_GUEST_UID, $id );
		$this->activeutil->delete( $id );
		$this->db->query( "DELETE FROM %psubscriptions WHERE subscription_user=%d", $id );
		$this->db->query( "DELETE FROM %pvotes WHERE vote_user=%d", $id );
		$this->db->query( "DELETE FROM %pfileratings WHERE user_id=%d", $id );
		$this->db->query( "DELETE FROM %pusers WHERE user_id=%d", $id );
		$this->db->query( "DELETE FROM %ppmsystem WHERE pm_to=%d", $id );
		$this->db->query( "DELETE FROM %preadmarks WHERE readmark_user=%d", $id );

		$files = $this->db->query( "SELECT file_id, file_md5name FROM %pfiles WHERE file_submitted=%d AND file_approved=0", $id );
		while( $file = $this->db->nqfetch( $files ) )
		{
			@unlink( "./downloads/" . $file['file_md5name'] );
			$this->db->query( "DELETE FROM %pfiles WHERE file_id=%d", $file['file_id'] );
		}

		$updates = $this->db->query( "SELECT update_id, update_md5name FROM %pupdates WHERE update_updater=%d", $id );
		while( $update = $this->db->nqfetch( $updates ) )
		{
			@unlink( "./updates/" . $update['update_md5name'] );
			$this->db->query( "DELETE FROM %pupdates WHERE update_id=%d", $update['update_id'] );
		}

		$member = $this->db->fetch( "SELECT user_id, user_name FROM %pusers ORDER BY user_id DESC LIMIT 1" );
		$counts = $this->db->fetch( "SELECT COUNT(user_id) AS count FROM %pusers" );

		$this->sets['last_member'] = $member['user_name'];
		$this->sets['last_member_id'] = $member['user_id'];
		$this->sets['members'] = $counts['count']-1;
		$this->write_sets();
	}
}
?>