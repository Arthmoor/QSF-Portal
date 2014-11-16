<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2010 The QSF Portal Development Team
 * http://www.qsfportal.com/
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2009 The Quicksilver Forums Development Team
 * http://www.quicksilverforums.com/
 * 
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 * http://www.mercuryboard.com/
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
require_once $set['include_path'] . '/lib/imginfo.php';

/**
 * User Control Panel
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class cp extends qsfglobal
{
	/** Files allowed to be used as avatars **/
	var $fileExtensions = array('jpg', 'jpeg', 'gif', 'png');

	function execute()
	{
		if (!$this->perms->auth('board_view')) {
			$this->lang->board();
			return $this->message(
				sprintf($this->lang->board_message, $this->sets['forum_name']),
				($this->perms->is_guest) ? sprintf($this->lang->board_regfirst, $this->self) : $this->lang->board_noview
			);
		}

		if (!isset($this->get['s'])) {
			$this->get['s'] = null;
		}

		if ($this->perms->is_guest) {
			return $this->message($this->lang->cp_cp, $this->lang->cp_login_first);
		}

		$class['avatar']  = 'tablelight';
		$class['cpass']   = 'tablelight';
		$class['prefs']   = 'tablelight';
		$class['profile'] = 'tablelight';
		$class['subs']    = 'tablelight';
		$class['sig']     = 'tablelight';

		switch($this->get['s'])
		{
		case 'cpass':
			$class['cpass'] = 'tabledark';
			$control_page = $this->edit_pass();
			break;

		case 'profile':
			$class['profile'] = 'tabledark';
			$control_page = $this->edit_profile();
			break;

		case 'avatar':
			$class['avatar'] = 'tabledark';
			$control_page = $this->edit_avatar();
			break;

		case 'prefs':
			$class['prefs'] = 'tabledark';
			$control_page = $this->edit_prefs();
			break;

		case 'subs':
			$class['subs'] = 'tabledark';
			$control_page = $this->edit_subs();
			break;

		case 'sig':
			$class['sig'] = 'tabledark';
			$control_page = $this->edit_sig();
			break;

		case 'addsub':
			$control_page = $this->add_sub();
			break;

		default:
			$this->set_title($this->lang->cp_cp);
			$this->tree($this->lang->cp_cp);

			$this->get['s'] = null;
			$control_page = eval($this->template('CP_HOME'));
		}

		return eval($this->template('CP_MAIN'));
	}

	function check_pass($passA, $passB, $old_pass)
	{
		if (md5($old_pass) != $this->user['user_password']) {
			return PASS_NOT_VERIFIED;
		}

		if ($passA != $passB) {
			return PASS_NO_MATCH;
		}

		if (!$this->validator->validate($passA, TYPE_PASSWORD)) {
			return PASS_INVALID;
		}

		return PASS_SUCCESS;
	}

	function edit_pass()
	{
		$this->set_title($this->lang->cp_changing_pass);
		$this->tree($this->lang->cp_cp, $this->self . '?a=cp');
		$this->tree($this->lang->cp_changing_pass);

		if (!isset($this->post['submit'])) {
			$token = $this->generate_token();

			return eval($this->template('CP_PASS'));
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->cp_changing_pass, $this->lang->invalid_token );
			}

			$result = $this->check_pass($this->post['passA'], $this->post['passB'], $this->post['old_pass']);

			switch($result)
			{
			case PASS_NOT_VERIFIED:
				return $this->message($this->lang->cp_changing_pass, $this->lang->cp_old_notmatch);
				break;

			case PASS_INVALID:
				return $this->message($this->lang->cp_changing_pass, $this->lang->cp_pass_notvaid);
				break;

			case PASS_NO_MATCH:
				return $this->message($this->lang->cp_changing_pass, $this->lang->cp_new_notmatch);
				break;

			case PASS_SUCCESS:
				$hashed_pass = md5($this->post['passA']);
				$this->db->query("UPDATE %pusers SET user_password='%s' WHERE user_id=%d", $hashed_pass, $this->user['user_id']);

				if( version_compare( PHP_VERSION, "5.2.0", "<" ) ) {
					setcookie($this->sets['cookie_prefix'] . 'pass', $hashed_pass, $this->time + $this->sets['logintime'], $this->sets['cookie_path'], $this->sets['cookie_domain'].'; HttpOnly', $this->sets['cookie_secure']);
				} else {
					setcookie($this->sets['cookie_prefix'] . 'pass', $hashed_pass, $this->time + $this->sets['logintime'], $this->sets['cookie_path'], $this->sets['cookie_domain'], $this->sets['cookie_secure'], true );
				}
				$_SESSION['pass'] = md5($hashed_pass . $this->ip);
				$this->user['user_password'] = $hashed_pass;

				return $this->message($this->lang->cp_changing_pass, sprintf($this->lang->cp_valided, $this->self));
				break;
			}
		}
	}

	function edit_prefs()
	{
		$this->set_title($this->lang->cp_preferences);
		$this->tree($this->lang->cp_cp, $this->self . '?a=cp');
		$this->tree($this->lang->cp_preferences);

		if (!isset($this->post['submit'])) {
			$token = $this->generate_token();

			$ViewAvCheck    = $this->user['user_view_avatars']   ? ' checked=\'checked\'' : null;
			$ViewSiCheck    = $this->user['user_view_signatures']  ? ' checked=\'checked\'' : null;
			$ViewEmCheck    = $this->user['user_view_emoticons'] ? ' checked=\'checked\'' : null;
			$user_email_showCheck = $this->user['user_email_show'] ? ' checked=\'checked\'' : null;
			$EmailFormCheck = $this->user['user_email_form'] ? ' checked=\'checked\'' : null;
			$user_pmCheck   = $this->user['user_pm'] ? ' checked=\'checked\'' : null;
			$user_pm_mailCheck   = $this->user['user_pm_mail'] ? ' checked=\'checked\'' : null;
			$active_check   = $this->user['user_active'] ? ' checked=\'checked\'' : null;

			$time_list  = $this->htmlwidgets->select_timezones($this->user['user_timezone']);
			$skin_list  = $this->htmlwidgets->select_skins($this->skin);
			$lang_list  = $this->htmlwidgets->select_langs($this->user['user_language']);

			$current_time = sprintf($this->lang->cp_current_time, $this->mbdate(DATE_TIME));

			return eval($this->template('CP_PREFS'));
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->cp_updated_prefs, $this->lang->invalid_token );
			}

			if (!isset($this->post['user_view_avatars'])) {
				$this->post['user_view_avatars'] = 0;
			}

			if (!isset($this->post['user_view_signatures'])) {
				$this->post['user_view_signatures'] = 0;
			}

			if (!isset($this->post['user_view_emoticons'])) {
				$this->post['user_view_emoticons'] = 0;
			}

			if (!isset($this->post['user_email_show'])) {
				$this->post['user_email_show'] = 0;
			}

			if (!isset($this->post['user_email_form'])) {
				$this->post['user_email_form'] = 0;
			}

			if (!isset($this->post['user_pm'])) {
				$this->post['user_pm'] = 0;
			}

			if (!isset($this->post['user_pm_mail'])) {
				$this->post['user_pm_mail'] = 0;
			}

			if (!isset($this->post['user_active'])) {
				$this->post['user_active'] = 0;
			}

			if (!isset($this->post['user_posts_page'])) {
				$this->post['user_posts_page'] = 0;
			} else {
				if ($this->post['user_posts_page'] > 99) {
					$this->post['user_posts_page'] = 99;
				}
			}

			if (!isset($this->post['user_topics_page'])) {
				$this->post['user_topics_page'] = 0;
			} else {
				if ($this->post['user_topics_page'] > 99) {
					$this->post['user_topics_page'] = 99;
				}
			}

			$this->post['user_language'] = preg_replace('/[^a-zA-Z0-9\-]/', '', $this->post['user_language']);

			$this->db->query("
				UPDATE %pusers SET user_view_avatars=%d, user_view_signatures=%d, user_view_emoticons=%d,
				  user_email_show=%d, user_email_form=%d, user_active=%d, user_pm=%d, user_pm_mail=%d,
				  user_timezone='%s', user_skin='%s', user_language='%s',
				  user_topics_page=%d, user_posts_page=%d
				WHERE user_id=%d",
				intval($this->post['user_view_avatars']), intval($this->post['user_view_signatures']), intval($this->post['user_view_emoticons']),
				intval($this->post['user_email_show']), intval($this->post['user_email_form']), intval($this->post['user_active']),
				intval($this->post['user_pm']), intval($this->post['user_pm_mail']), $this->post['user_timezone'], $this->post['user_skin'], $this->post['user_language'],
				intval($this->post['user_topics_page']),  intval($this->post['user_posts_page']), $this->user['user_id']);

			return $this->message($this->lang->cp_updated_prefs, $this->lang->cp_been_updated_prefs);
		}
	}

	function edit_profile()
	{
		if ( !$this->perms->auth('edit_profile')) {
			return $this->message( $this->lang->cp_editing_profile, $this->lang->cp_no_edit_profile );
		}
		$this->set_title($this->lang->cp_editing_profile);
		$this->tree($this->lang->cp_cp, $this->self . '?a=cp');
		$this->tree($this->lang->cp_editing_profile);

		if (!isset($this->post['submit'])) {
			$token = $this->generate_token();

			list($year, $mon, $day) = explode('-', $this->user['user_birthday']);

			$day_list   = $this->htmlwidgets->select_days($day);
			$month_list = $this->htmlwidgets->select_months($mon);
			$year_list  = $this->htmlwidgets->select_years($year);

			if (!$this->user['user_icq']) {
				$this->user['user_icq'] = null;
			}

			return eval($this->template('CP_PROFILE'));
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->cp_updated, $this->lang->invalid_token );
			}

			$this->post['Newuser_name'] = str_replace('\\', '&#092;', $this->format($this->post['Newuser_name'], FORMAT_HTMLCHARS | FORMAT_CENSOR));

			if ($this->db->fetch("SELECT user_id FROM %pusers WHERE REPLACE(LOWER(user_name), ' ', '')='%s' AND user_id != %d",
				$this->post['Newuser_name'], $this->user['user_id']))
			{
				return $this->message($this->lang->cp_err_updating, $this->lang->cp_user_exists);
			}

			if (strtolower(str_replace(' ', '', $this->user['user_name'])) != strtolower(str_replace(' ', '', $this->post['Newuser_name']))) {
				return $this->message($this->lang->cp_err_updating, $this->lang->cp_must_orig);
			}

			if (strlen($this->post['Newuser_name']) > 32) {
				return $this->message($this->lang->cp_err_updating, $this->lang->cp_less_charac);
			}

			$temp_email = $this->post['user_email'];
			if (!$this->validator->validate($temp_email, TYPE_EMAIL)) {
				return $this->message($this->lang->cp_err_updating, $this->lang->cp_email_invaid);
			}

			if ($this->post['user_email'] != $this->user['user_email'] && 
				(!isset($this->post['passA']) || md5($this->post['passA']) != $this->user['user_password'])) {
				return $this->message($this->lang->cp_changing_pass, $this->lang->cp_pass_notmatch);
			}

			if ($this->db->fetch("SELECT user_email FROM %pusers WHERE user_email='%s' AND user_id !=%d",
				 $this->post['user_email'], $this->user['user_id']))
			{
				return $this->message($this->lang->cp_err_updating, $this->lang->cp_already_member);
			}

			if (!empty($this->post['user_homepage']) && (substr($this->post['user_homepage'], 0, 7) != 'http://')) {
				$this->post['user_homepage'] = 'http://' . $this->post['user_homepage'];
			}

			if (strlen($this->post['day']) == 1) {
				$this->post['day'] = '0' . $this->post['day'];
			}

			if (strlen($this->post['month']) == 1) {
				$this->post['month'] = '0' . $this->post['month'];
			}

			$user_birthday = $this->post['year'] . '-' . $this->post['month'] . '-' . $this->post['day'];

			if (!checkdate($this->post['month'], $this->post['day'], $this->post['year']) && ($user_birthday != '0000-00-00')) {
				return $this->message($this->lang->cp_err_updating, sprintf($this->lang->cp_not_exist, $user_birthday));
			}

			$this->post['user_homepage']  = $this->format($this->post['user_homepage'], FORMAT_HTMLCHARS);
			$this->post['user_location']  = $this->format($this->post['user_location'], FORMAT_HTMLCHARS);
			$this->post['user_interests'] = $this->format($this->post['user_interests'], FORMAT_HTMLCHARS);
			$this->post['user_aim']       = $this->format($this->post['user_aim'], FORMAT_HTMLCHARS);
			$this->post['user_msn']       = $this->format($this->post['user_msn'], FORMAT_HTMLCHARS);
			$this->post['user_yahoo']     = $this->format($this->post['user_yahoo'], FORMAT_HTMLCHARS);
			$this->post['user_gtalk']     = $this->format($this->post['user_gtalk'], FORMAT_HTMLCHARS);
			if ($this->perms->auth('is_admin')) {
				$query = $this->db->query("SELECT membertitle_title FROM %pmembertitles");
				if (!isset($this->post['user_title']) || $this->post['user_title'] == '' ) {
					$usertitle = '';
					$custom_title = 0;
				} else {
					$usertitle = $this->format($this->post['user_title'], FORMAT_HTMLCHARS);
					$custom_title = 1;
				}

				while ($u = $this->db->nqfetch($query))
				{
					$utitle = $u['membertitle_title'];
					if (strcmp($utitle,$this->post['user_title'])==0) {
						$custom_title = 0;
						$usertitle = $utitle;
						break;
					}
				}
			} else {
				$usertitle = $this->user['user_title'];
				$custom_title = $this->user['user_title_custom'];
			}

			$icq = isset($this->post['user_icq']) ? intval($this->post['user_icq']) : 0;
			if ($icq < 0 || $icq > 999999999999999)
				$icq = 0;

			$this->db->query("
				UPDATE %pusers SET
				  user_email='%s', user_birthday='%s', user_homepage='%s', user_location ='%s',
				  user_interests='%s', user_icq=%d, user_msn='%s', user_aim='%s', user_yahoo='%s',
				  user_gtalk='%s', user_title='%s', user_title_custom=%d, user_name='%s'
				WHERE user_id=%d",
				$this->post['user_email'], $user_birthday, $this->post['user_homepage'], $this->post['user_location'],
				$this->post['user_interests'], $icq, $this->post['user_msn'], $this->post['user_aim'],
				$this->post['user_yahoo'], $this->post['user_gtalk'], $usertitle, $custom_title, $this->post['Newuser_name'],
				$this->user['user_id']);

			if ($this->post['Newuser_name'] != $this->user['user_name']) {
				$this->db->query("UPDATE %pposts SET post_edited_by='%s' WHERE post_edited_by='%s'",
					$this->post['Newuser_name'], $this->user['user_name']);
			}

			return $this->message($this->lang->cp_updated, $this->lang->cp_been_updated);
		}
	}

	function edit_avatar()
	{
		if ( !$this->perms->auth('edit_avatar')) {
			return $this->message( $this->lang->cp_editing_avatar, $this->lang->cp_no_edit_avatar );
		}
		$this->set_title($this->lang->cp_editing_avatar);
		$this->tree($this->lang->cp_cp, $this->self . '?a=cp');
		$this->tree($this->lang->cp_editing_avatar);

		if (!isset($this->post['submit'])) {
			$token = $this->generate_token();

			$avatar_list = $this->htmlwidgets->select_avatars($this->user['user_avatar']);

			if (empty($this->user['user_avatar'])) {
				$this->user['user_avatar']   = "./skins/{$this->skin}/images/noavatar.png";
				$this->user['user_avatar_width']  = 75;
				$this->user['user_avatar_height'] = 75;
			}

			$checks[0] = ($this->user['user_avatar_type'] == 'local') ? ' checked=\'checked\'' : null;
			$checks[1] = ($this->user['user_avatar_type'] == 'url') ? ' checked=\'checked\'' : null;
			$checks[2] = ($this->user['user_avatar_type'] == 'uploaded') ? ' checked=\'checked\'' : null;
			$checks[3] = ($this->user['user_avatar_type'] == 'none') ? ' checked=\'checked\'' : null;

			// In the HTML 'uploaded' is called 'use_uploaded'
			$init = ($this->user['user_avatar_type'] == 'uploaded') ? 'use_uploaded' : null;

			$avatar_url = ($this->user['user_avatar_type'] == 'url') ? $this->user['user_avatar'] : null;

			return eval($this->template('CP_AVATAR'));
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->cp_label_edit_avatar, $this->lang->invalid_token );
			}

			$this->post['user_avatar_width'] = intval($this->post['user_avatar_width']);
			$this->post['user_avatar_height'] = intval($this->post['user_avatar_height']);

			$temp = explode('.',  $this->user['user_avatar']);
			$fileExtension  = array_pop($temp);
			if (!in_array($fileExtension, $this->fileExtensions)) {
				$fileExtension = 'avtr';
			}

			switch($this->post['user_avatar_type'])
			{
			case 'local':
				if (!isset($this->post['avatar_local'])) {
					return $this->message($this->lang->cp_err_avatar, $this->lang->cp_avatar_must_select);
				}

				$avatar = trim($this->post['avatar_local']);
				$type = 'local';
				$this->delete_avatar();
				break;

			case 'url':
				if (($this->post['user_avatar_width'] > $this->sets['avatar_width']) || ($this->post['user_avatar_height'] > $this->sets['avatar_height'])) {
					return $this->message($this->lang->cp_err_avatar, sprintf($this->lang->cp_size_max, $this->sets['avatar_width'], $this->sets['avatar_height']));
				}

				if (!preg_match('/\.(gif|jpg|jpeg|png|swf)$/i', $this->post['avatar_url'])) {
					return $this->message($this->lang->cp_err_avatar, $this->lang->cp_file_type);
				}

				if ((strtolower(substr($this->post['avatar_url'], 0, 4)) == '.swf') && !$this->sets['flash_avs']) {
					return $this->message($this->lang->cp_err_avatar, $this->lang->cp_no_flash);
				}

				$avatar = $this->format(trim($this->post['avatar_url']), FORMAT_HTMLCHARS);
				$type = 'url';
				$this->delete_avatar();
				break;

			case 'upload':
				if (!isset($this->files['avatar_upload'])) {
					return $this->message($this->lang->cp_avatar_error, $this->lang->cp_avatar_upload_failed);
				}

				// Get extension
				$fileExtension  = array_pop(explode('.',  $this->files['avatar_upload']['name']));
				if (!in_array($fileExtension, $this->fileExtensions)) {
					$fileExtension = 'avtr';
				}
				
				$this->delete_avatar();
				$upload = $this->attachmentutil->upload($this->files['avatar_upload'], './avatars/uploaded/' . $this->user['user_id'] . '.' . $fileExtension, $this->sets['avatar_upload_size'], array('jpg', 'jpeg', 'gif', 'png'));

				switch($upload)
				{
				case UPLOAD_TOO_LARGE:
					return $this->message($this->lang->cp_avatar_error,  sprintf($this->lang->cp_avatar_upload_too_large, round($this->sets['avatar_upload_size']/1024, 1)));
					break 2;

				case UPLOAD_NOT_ALLOWED:
					return $this->message($this->lang->cp_avatar_error, $this->lang->cp_avatar_upload_not_image);
					break 2;

				case UPLOAD_FAILURE:
					return $this->message($this->lang->cp_avatar_error, $this->lang->cp_avatar_upload_failed);
					break 2;
				}

				// Get dimensions of image
				$myImgInfo = new imginfo();
				$data = $myImgInfo->info('./avatars/uploaded/' . $this->user['user_id'] . '.' . $fileExtension);
				if ($data) {
					$this->post['user_avatar_width'] = $data['X'];
					$this->post['user_avatar_height'] = $data['Y'];
				}

				// Allows things such as rsync to backup avatars
				$avatar_uploaded = './avatars/uploaded/' . $this->user['user_id'] . '.' . $fileExtension;
				$this->chmod( $avatar_uploaded , 0644, false );

				// Deliberate fall through
			case 'use_uploaded':
				$avatar = './avatars/uploaded/' . $this->user['user_id'] . '.' . $fileExtension;
				$type = 'uploaded';
				break;

			default:
				$avatar = '';
				$type = 'none';
				$this->delete_avatar();
				break;
			}

			// Quick sanity check on dimensions
			if ($this->post['user_avatar_width'] < 1) {
				$this->post['user_avatar_width'] = 1;
			}

			if ($this->post['user_avatar_height'] < 1) {
				$this->post['user_avatar_height'] = 1;
			}

			if ($this->post['user_avatar_width'] > $this->sets['avatar_width']) {
				$this->post['user_avatar_width'] = $this->sets['avatar_width'];
			}
			if ($this->post['user_avatar_height'] > $this->sets['avatar_height']) {
				$this->post['user_avatar_height'] = $this->sets['avatar_height'];
			}

			$this->db->query("UPDATE %pusers SET
				  user_avatar='%s', user_avatar_type='%s',
				  user_avatar_width=%d, user_avatar_height=%d
				WHERE user_id=%d",
				$avatar, $type, intval($this->post['user_avatar_width']),
				intval($this->post['user_avatar_height']), $this->user['user_id']);

			return $this->message($this->lang->cp_updated1, $this->lang->cp_been_updated1);
		}
	}

	function edit_subs()
	{
		$this->set_title($this->lang->cp_sub_change);
		$this->tree($this->lang->cp_cp, $this->self . '?a=cp');
		$this->tree($this->lang->cp_sub_change);

		$this->db->query("DELETE FROM %psubscriptions WHERE subscription_expire < %d", $this->time);

		if (!isset($this->post['submit'])) {
			$query = $this->db->query("
				SELECT
				  s.subscription_id, s.subscription_type, s.subscription_expire,
				  f.forum_name, f.forum_id,
				  t.topic_title, t.topic_id
				FROM
				  %psubscriptions s
				LEFT JOIN %pforums f ON (s.subscription_type = 'forum' AND f.forum_id = s.subscription_item)
				LEFT JOIN %ptopics t ON (s.subscription_type = 'topic' AND t.topic_id = s.subscription_item)
				WHERE
				  s.subscription_user = %d
				ORDER BY s.subscription_expire", $this->user['user_id']);

			$rows = null;

			while ($sub = $this->db->nqfetch($query))
			{
				if ($sub['subscription_type'] == 'topic') {
					$sub['item_name'] = $sub['topic_title'];
					$link = "a=topic&amp;t={$sub['topic_id']}";
				} else {
					$sub['item_name'] = $sub['forum_name'];
					$link = "a=forum&amp;f={$sub['forum_id']}";
				}

				$sub['item_name'] = $this->format($sub['item_name'], FORMAT_HTMLCHARS | FORMAT_CENSOR);
				$sub['subscription_expire'] = $this->mbdate(DATE_LONG, $sub['subscription_expire']);

				$rows .= eval($this->template('CP_SUB_ROW'));
			}
		} else {
			if (isset($this->post['delete'])) {
				$delSubs = array();

				foreach ($this->post['delete'] as $id => $true)
				{
					$delSubs[] = intval($id);
				}

				$this->db->query("DELETE FROM %psubscriptions WHERE subscription_user=%d AND subscription_id IN (%s)",
					$this->user['user_id'], implode(', ', $delSubs));
			}

			return $this->message($this->lang->cp_sub_change, $this->lang->cp_sub_updated);
		}

		return eval($this->template('CP_SUB_MAIN'));
	}

	/**
	 * Allows better handling over signatures
	 *
	 * @author Jonathan West <jon@quicksilverforums.com>
	 * @since v1.1.6
	 **/
	function edit_sig()
	{
		if (!$this->perms->auth('edit_sig')) {
			return $this->message($this->lang->cp_label_edit_sig, $this->lang->cp_no_edit_sig);
		}
		$this->set_title($this->lang->cp_label_edit_sig);
		$this->tree($this->lang->cp_cp, $this->self . '?a=cp');
		$this->tree($this->lang->cp_label_edit_sig);
		$params = FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_MBCODE | FORMAT_EMOTICONS;
		
		if (isset($this->post['submit'])) {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->cp_label_edit_sig, $this->lang->invalid_token );
			}

			$this->db->query("UPDATE %pusers SET user_signature='%s' WHERE user_id=%d",
				$this->post['sig'],  $this->user['user_id']);
		}

		$token = $this->generate_token();
		$query = $this->db->query("SELECT user_signature FROM %pusers WHERE user_id=%d", $this->user['user_id']);
		$pr = $this->db->nqfetch($query);
		$preview = $this->format($pr['user_signature'], $params);
		$edit = $pr['user_signature'];
		return eval($this->template('CP_EDIT_SIG'));
	}
	 
	function add_sub()
	{
		$this->set_title($this->lang->cp_cp);
		$this->tree($this->lang->cp_cp);

		if (!isset($this->get['item']) || !isset($this->get['type'])) {
			return $this->message($this->lang->cp_cp, $this->lang->cp_sub_no_params);
		}

		$this->get['item'] = intval($this->get['item']);

		$expires = $this->time + 2592000; // 30 days

		$this->db->query("DELETE FROM %psubscriptions WHERE subscription_user=%d AND subscription_type='%s' AND subscription_item=%d",
			$this->user['user_id'], $this->get['type'], $this->get['item']);
		$this->db->query("INSERT INTO %psubscriptions (subscription_user, subscription_type, subscription_item, subscription_expire)
			VALUES (%d, '%s', %d, %d)",
			$this->user['user_id'], $this->get['type'], $this->get['item'], $expires);

		return $this->message($this->lang->cp_cp, sprintf($this->lang->cp_sub_success, $this->get['type']));
	}
	
	/**
	 * Delete the old uploaded avatar if any
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since v1.3.0
	 **/
	function delete_avatar()
	{
		if ($this->user['user_avatar_type'] == 'uploaded') {
			@unlink($this->user['user_avatar']);
		}
	}
}
?>