<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2015 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * http://code.google.com/p/quicksilverforums/
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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/global.php';

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
			$control_page = $this->edit_pass();
			break;

		case 'profile':
			$control_page = $this->edit_profile();
			break;

		case 'avatar':
			$control_page = $this->edit_avatar();
			break;

		case 'prefs':
			$control_page = $this->edit_prefs();
			break;

		case 'subs':
			$control_page = $this->edit_subs();
			break;

		case 'sig':
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
		if( !password_verify( $old_pass, $this->user['user_password'] ) ) {
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
				$hashed_pass = $this->qsfp_password_hash($this->post['passA']);
				$this->db->query("UPDATE %pusers SET user_password='%s' WHERE user_id=%d", $hashed_pass, $this->user['user_id']);

				setcookie($this->sets['cookie_prefix'] . 'pass', $hashed_pass, $this->time + $this->sets['logintime'], $this->sets['cookie_path'], $this->sets['cookie_domain'], $this->sets['cookie_secure'], true );

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
			$view_avatars = $view_sigs = $view_emotes = $show_email = $email_form = $user_pm = $pm_mail = $active = 0;

			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->cp_updated_prefs, $this->lang->invalid_token );
			}

			if (isset($this->post['user_view_avatars'])) {
				$view_avatars = 1;
			}

			if (isset($this->post['user_view_signatures'])) {
				$view_sigs = 1;
			}

			if (isset($this->post['user_view_emoticons'])) {
				$view_emotes = 1;
			}

			if (isset($this->post['user_email_show'])) {
				$show_email = 1;
			}

			if (isset($this->post['user_email_form'])) {
				$email_form = 1;
			}

			if (isset($this->post['user_pm'])) {
				$user_pm = 1;
			}

			if (isset($this->post['user_pm_mail'])) {
				$pm_mail = 1;
			}

			if (isset($this->post['user_active'])) {
				$active = 1;
			}

			$posts_per_page = $this->sets['posts_per_page'];
			if (isset($this->post['user_posts_page'])) {
				$posts_per_page = intval($this->post['user_posts_page']);
			}
			if ( $posts_per_page < 0 )
				$posts_per_page = 0;
			if ($posts_per_page > 99)
				$post_per_page = 99;

			$topic_per_page = $this->sets['topics_per_page'];
			if (isset($this->post['user_topics_page'])) {
				$topics_per_page = intval($this->post['user_topics_page']);
			}
			if( $topics_per_page < 0 )
				$topics_per_page = 0;
			if( $topics_per_page > 99 )
				$topics_per_page = 99;

			$this->post['user_language'] = preg_replace('/[^a-zA-Z0-9\-]/', '', $this->post['user_language']);

			$this->db->query("
				UPDATE %pusers SET user_view_avatars=%d, user_view_signatures=%d, user_view_emoticons=%d,
				  user_email_show=%d, user_email_form=%d, user_active=%d, user_pm=%d, user_pm_mail=%d,
				  user_timezone='%s', user_skin='%s', user_language='%s',
				  user_topics_page=%d, user_posts_page=%d
				WHERE user_id=%d",
				$view_avatars, $view_sigs, $view_emotes, $show_email, $email_form, $active,
				$user_pm, $pm_mail, $this->post['user_timezone'], $this->post['user_skin'], $this->post['user_language'],
				$topic_per_page, $posts_per_page, $this->user['user_id']);

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

			// I'm not sure if the anti-spam code needs to use the escaped strings or not, so I'll feed them whatever the spammer fed me.
			if( !empty($this->sets['wordpress_api_key']) && $this->sets['akismet_profiles'] && !empty($this->post['user_homepage']) ) {
				require_once $this->sets['include_path'] . '/lib/akismet.php';

				$spam_checked = false;
				$akismet = null;

				try {
					$akismet = new Akismet($this->sets['loc_of_board'], $this->sets['wordpress_api_key'], $this->version);
					$akismet->setCommentAuthor($this->user['user_name']);
					$akismet->setCommentAuthorEmail($this->user['user_email']);
					$akismet->setCommentAuthorURL($this->post['user_homepage']);
					$akismet->setCommentContent($this->post['user_interests']);
					$akismet->setCommentType('user-profile');

					$spam_checked = true;
				}
				// Try and deal with it rather than say something.
				catch(Exception $e) {}

				if( $spam_checked && $akismet != null && $akismet->isCommentSpam() ) {
					$this->log_action('Blocked Profile Update', 0, 0, 0);

					$this->sets['spam_profile_count']++;
					$this->write_sets();

					return $this->message( $this->lang->cp_err_updating, $this->lang->cp_profile_spam );
				}
			}

			$this->post['user_homepage']  = $this->format($this->post['user_homepage'], FORMAT_HTMLCHARS);
			$this->post['user_location']  = $this->format($this->post['user_location'], FORMAT_HTMLCHARS);
			$this->post['user_interests'] = $this->format($this->post['user_interests'], FORMAT_HTMLCHARS);
			$this->post['user_aim']       = $this->format($this->post['user_aim'], FORMAT_HTMLCHARS);
			$this->post['user_msn']       = $this->format($this->post['user_msn'], FORMAT_HTMLCHARS);
			$this->post['user_yahoo']     = $this->format($this->post['user_yahoo'], FORMAT_HTMLCHARS);
			$this->post['user_twitter']   = $this->format($this->post['user_twitter'], FORMAT_HTMLCHARS);
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
				  user_twitter='%s', user_title='%s', user_title_custom=%d, user_name='%s'
				WHERE user_id=%d",
				$this->post['user_email'], $user_birthday, $this->post['user_homepage'], $this->post['user_location'],
				$this->post['user_interests'], $icq, $this->post['user_msn'], $this->post['user_aim'],
				$this->post['user_yahoo'], $this->post['user_twitter'], $usertitle, $custom_title, $this->post['Newuser_name'],
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
				$this->user['user_avatar_width']  = $this->sets['avatar_width'];
				$this->user['user_avatar_height'] = $this->sets['avatar_height'];
			}

			$checks[0] = ($this->user['user_avatar_type'] == 'local') ? ' checked=\'checked\'' : null;
			$checks[1] = ($this->user['user_avatar_type'] == 'url') ? ' checked=\'checked\'' : null;
			$checks[2] = ($this->user['user_avatar_type'] == 'gravatar') ? ' checked=\'checked\'' : null;
			$checks[3] = ($this->user['user_avatar_type'] == 'uploaded') ? ' checked=\'checked\'' : null;
			$checks[4] = ($this->user['user_avatar_type'] == 'none') ? ' checked=\'checked\'' : null;

			// In the HTML 'uploaded' is called 'use_uploaded'
			$init = ($this->user['user_avatar_type'] == 'uploaded') ? 'use_uploaded' : null;

			$avatar = $this->user['user_avatar'];
			$avatar_url = null;
			$gravatar_url = null;
			if( $this->user['user_avatar_type'] == 'url' ) {
				$avatar_url = $avatar;
			} elseif( $this->user['user_avatar_type'] == 'gravatar' )  {
				$avatar = $this->htmlwidgets->get_gravatar( $avatar );
				$gravatar_url = $avatar;
			}

			return eval($this->template('CP_AVATAR'));
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->cp_label_edit_avatar, $this->lang->invalid_token );
			}

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

				$image = getimagesize( $this->post['avatar_local'] );

				if( $image[0] > $this->sets['avatar_width'] )
					$image[0] = $this->sets['avatar_width'];
				if( $image[1] > $this->sets['avatar_height'] )
					$image[1] = $this->sets['avatar_height'];

				$this->user['user_avatar_width']  = $image[0];
				$this->user['user_avatar_height'] = $image[1];

				$avatar = trim($this->post['avatar_local']);
				$type = 'local';
				$this->delete_avatar();
				break;

			case 'url':
				if (!preg_match('/\.(gif|jpg|jpeg|png)$/i', $this->post['avatar_url'])) {
					return $this->message($this->lang->cp_err_avatar, $this->lang->cp_file_type);
				}

				$image = getimagesize( $this->post['avatar_url'] );
				if( $image === false ) {
					return $this->message($this->lang->cp_err_avatar, $this->lang->cp_file_type);
				}

				if( $image[0] > $this->sets['avatar_width'] )
					$image[0] = $this->sets['avatar_width'];
				if( $image[1] > $this->sets['avatar_height'] )
					$image[1] = $this->sets['avatar_height'];

				$this->user['user_avatar_width']  = $image[0];
				$this->user['user_avatar_height'] = $image[1];

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
					return $this->message( $this->lang->cp_label_edit_avatar, $this->lang->cp_avatar_upload_not_image );
				}

				$this->delete_avatar();
				$new_fname = './avatars/uploaded/' . $this->user['user_id'] . '.' . $fileExtension;
				$upload = $this->attachmentutil->upload($this->files['avatar_upload'], $new_fname, $this->sets['avatar_upload_size'], array('jpg', 'jpeg', 'gif', 'png'));

				switch($upload)
				{
				case UPLOAD_TOO_LARGE:
					return $this->message($this->lang->cp_avatar_error, sprintf($this->lang->cp_avatar_upload_too_large, round($this->sets['avatar_upload_size']/1024, 1)));
					break 2;

				case UPLOAD_NOT_ALLOWED:
					return $this->message($this->lang->cp_avatar_error, $this->lang->cp_avatar_upload_not_image);
					break 2;

				case UPLOAD_FAILURE:
					return $this->message($this->lang->cp_avatar_error, $this->lang->cp_avatar_upload_failed);
					break 2;
				}

				// Force resize the new avatar
				$image = $this->resize_avatar( $new_fname, $new_fname, $fileExtension, $this->sets['avatar_width'], $this->sets['avatar_height'] );

				$this->user['user_avatar_width']  = $image['width'];
				$this->user['user_avatar_height'] = $image['height'];

				// Allows things such as rsync to backup avatars
				$this->chmod( $new_fname, 0644, false );

				// Deliberate fall through
			case 'use_uploaded':
				$avatar = './avatars/uploaded/' . $this->user['user_id'] . '.' . $fileExtension;
				$type = 'uploaded';
				break;

			case 'gravatar':
				if (!$this->validator->validate($this->post['avatar_gurl'], TYPE_EMAIL)) {
					return $this->message($this->lang->cp_avatar_error, $this->lang->cp_gravatar_upload_failed);
				}

				$avatar = trim( $this->post['avatar_gurl'] );
				$type = 'gravatar';
				$this->delete_avatar();
				break;

			default:
				$avatar = '';
				$type = 'none';
				$this->delete_avatar();
				break;
			}

			$this->db->query("UPDATE %pusers SET
				  user_avatar='%s', user_avatar_type='%s',
				  user_avatar_width=%d, user_avatar_height=%d
				WHERE user_id=%d",
				$avatar, $type, $this->user['user_avatar_width'], $this->user['user_avatar_height'], $this->user['user_id']);

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

		if( $this->user['user_group'] == USER_MEMBER && $this->user['user_posts'] < 5 ) {
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

			// I'm not sure if the anti-spam code needs to use the escaped strings or not, so I'll feed them whatever the spammer fed me.
			if( !empty($this->sets['wordpress_api_key']) && $this->sets['akismet_sigs'] ) {
				if( !$this->perms->auth('is_admin') && $this->user['user_posts'] < $this->sets['akismet_posts_number'] ) {
					require_once $this->sets['include_path'] . '/lib/akismet.php';

					$spam_checked = false;
					$akismet = null;

					try {
						$akismet = new Akismet($this->sets['loc_of_board'], $this->sets['wordpress_api_key'], $this->version);
						$akismet->setCommentAuthor($this->user['user_name']);
						$akismet->setCommentAuthorEmail($this->user['user_email']);
						$akismet->setCommentContent($this->post['sig']);
						$akismet->setCommentType('user-signature');

						$spam_checked = true;
					}
					// Try and deal with it rather than say something.
					catch(Exception $e) {}

					if( $spam_checked && $akismet != null && $akismet->isCommentSpam() ) {
						$this->log_action('Blocked Signature Update', 0, 0, 0);

						$this->sets['spam_sig_count']++;
						$this->write_sets();

						return $this->message( $this->lang->cp_label_edit_sig, $this->lang->cp_label_edit_sig_spam );
					}
				}
			}
			$this->db->query("UPDATE %pusers SET user_signature='%s' WHERE user_id=%d", $this->post['sig'], $this->user['user_id']);
		}

		$token = $this->generate_token();
		$query = $this->db->query("SELECT user_signature FROM %pusers WHERE user_id=%d", $this->user['user_id']);
		$pr = $this->db->nqfetch($query);
		$preview = $this->format($pr['user_signature'], $params);
		$edit = $pr['user_signature'];
		$smilies = $this->bbcode->generate_emote_links();
		return eval($this->template('CP_EDIT_SIG'));
	}
	 
	function add_sub()
	{
		$this->set_title($this->lang->cp_cp);
		$this->tree($this->lang->cp_cp);

		if (!isset($this->get['item']) || !isset($this->get['type'])) {
			return $this->message($this->lang->cp_cp, $this->lang->cp_sub_no_params);
		}

		$item = intval($this->get['item']);

		$expires = $this->time + 2592000; // 30 days

		$this->db->query("DELETE FROM %psubscriptions WHERE subscription_user=%d AND subscription_type='%s' AND subscription_item=%d",
			$this->user['user_id'], $this->get['type'], $item);
		$this->db->query("INSERT INTO %psubscriptions (subscription_user, subscription_type, subscription_item, subscription_expire)
			VALUES (%d, '%s', %d, %d)",
			$this->user['user_id'], $this->get['type'], $item, $expires);

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

	function resize_avatar( $name, $filename, $ext, $new_w, $new_h )
	{
		$thumb_w = 1;
		$thumb_h = 1;

		$system = explode( '.', $name );
		$src_img = null;

		if( preg_match( '/jpg|jpeg/', $ext ) )
			$src_img = imagecreatefromjpeg($name);
		else if ( preg_match( '/png/', $ext ) )
			$src_img = imagecreatefrompng($name);
		else if ( preg_match( '/gif/', $ext ) )
			$src_img = imagecreatefromgif($name);
		$old_x = imageSX( $src_img );
		$old_y = imageSY( $src_img );

		if( $old_x <= $new_w && $old_y <= $new_h ) {
			$thumb_w = $old_x;
			$thumb_h = $old_y;
		} else {
			if ($old_x > $old_y) {
				$thumb_w = $new_w;
				$thumb_h = $old_y * ( $new_h / $old_x );
			}
			if ($old_x < $old_y) {
				$thumb_w = $old_x * ( $new_w / $old_y );
				$thumb_h = $new_h;
			}
			if ($old_x == $old_y) {
				$thumb_w = $new_w;
				$thumb_h = $new_h;
			}
		}

		$dst_img = ImageCreateTrueColor( $thumb_w, $thumb_h );
		imagecopyresampled( $dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y );
		if (preg_match( '/png/', $ext ) )
			imagepng( $dst_img, $filename );
		else if ( preg_match( '/jpg|jpeg/', $ext ) )
			imagejpeg( $dst_img, $filename );
		else
			imagegif( $dst_img, $filename );
		imagedestroy( $dst_img );
		imagedestroy( $src_img );
		return array( 'width' => $thumb_w, 'height' => $thumb_h );
	}
}
?>