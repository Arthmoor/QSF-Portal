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

if (!defined('QUICKSILVERFORUMS') || !defined('QSF_ADMIN')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';

class settings extends admin
{
	function execute()
	{
		if (!isset($this->get['s'])) {
			$this->get['s'] = null;
		}

		switch($this->get['s'])
		{
		case 'showcaptcha':
			$this->set_title($this->lang->settings_captcha_display);
			$this->tree($this->lang->settings_captcha_display);

			$list = $this->db->query( 'SELECT * FROM %pcaptcha' );

			$pairs = '';
			while( $item = $this->db->nqfetch($list) )
			{
				$question = $item['cap_question'];
				$answer = $item['cap_answer'];
				$cap_id = $item['cap_id'];

				$pairs .= eval($this->template('ADMIN_CAPTCHA_PAIR'));
			}

			return eval($this->template('ADMIN_CAPTCHA_DISPLAY'));
			break;

		case 'deletecaptcha':
			$this->set_title($this->lang->settings_captcha_delete);
			$this->tree($this->lang->settings_captcha_delete);

			if(!isset($this->post['submit'])) {
				$token = $this->generate_token();

				$c = intval($this->get['c']);
				if( $c < 1 )
					return $this->message( $this->lang->settings_captcha_delete, $this->lang->settings_captcha_invalid );

				$cap = $this->db->fetch( 'SELECT * FROM %pcaptcha WHERE cap_id=%d', intval($this->get['c']) );

				if( !$cap )
					return $this->message( $this->lang->settings_captcha_delete, $this->lang->settings_captcha_no_pair );

				$cap_id = $cap['cap_id'];
				$question = $cap['cap_question'];
				$answer = $cap['cap_answer'];

				return eval($this->template('ADMIN_DELETE_CAPTCHA'));
			}

			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->settings_captcha_delete, $this->lang->invalid_token );
			}

			$c = intval($this->get['c']);
			$cap = $this->db->fetch( 'SELECT * FROM %pcaptcha WHERE cap_id=%d', $c );

			if( !$cap )
				return $this->message( $this->lang->settings_captcha_delete, $this->lang->settings_captcha_no_pair );

			$this->db->query( "DELETE FROM %pcaptcha WHERE cap_id=%d", $c );

			return $this->message( $this->lang->settings_captcha_delete, $this->lang->settings_captcha_deleted );
			break;

		case 'editcaptcha':
			$this->set_title($this->lang->settings_captcha_edit);
			$this->tree($this->lang->settings_captcha_edit);

			if(!isset($this->post['submit'])) {
				$token = $this->generate_token();

				$c = intval($this->get['c']);
				if( $c < 1 )
					return $this->message( $this->lang->settings_captcha_edit, $this->lang->settings_captcha_invalid );

				$cap = $this->db->fetch( 'SELECT * FROM %pcaptcha WHERE cap_id=%d', intval($this->get['c']) );

				if( !$cap )
					return $this->message( $this->lang->settings_captcha_edit, $this->lang->settings_captcha_no_pair );

				$cap_id = $cap['cap_id'];
				$question = $cap['cap_question'];
				$answer = $cap['cap_answer'];

				return eval($this->template('ADMIN_EDIT_CAPTCHA'));
			}

			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->settings_captcha_edit, $this->lang->invalid_token );
			}

			$c = intval($this->get['c']);
			$cap = $this->db->fetch( 'SELECT * FROM %pcaptcha WHERE cap_id=%d', $c );

			if( !$cap )
				return $this->message( $this->lang->settings_captcha_edit, $this->lang->settings_captcha_no_pair );

			$this->db->query( "UPDATE %pcaptcha SET cap_question='%s', cap_answer='%s' WHERE cap_id=%d", $this->post['cap_question'], $this->post['cap_answer'], $c );

			return $this->message( $this->lang->settings_captcha_edit, $this->lang->settings_captcha_edited );
			break;

		case 'captcha':
			$this->set_title($this->lang->settings_captcha_pair);
			$this->tree($this->lang->settings_captcha_pair);

			if(!isset($this->post['submit'])) {
				$token = $this->generate_token();

				return eval($this->template('ADMIN_ADD_CAPTCHA'));
			}

			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->settings_captcha_pair, $this->lang->invalid_token );
			}

			if( empty( $this->post['cap_question'] ) || empty( $this->post['cap_answer'] ) )
				return $this->message( $this->lang->settings_captcha_pair, $this->lang->settings_captcha_missing );

			$this->db->query( "INSERT INTO %pcaptcha (cap_question, cap_answer) VALUES( '%s', '%s' )", $this->post['cap_question'], $this->post['cap_answer'] );

			return $this->message( $this->lang->settings_captcha_pair, $this->lang->settings_captcha_added );
			break;

		case 'add':
			$this->set_title($this->lang->settings_new_add);
			$this->tree($this->lang->settings_new_add);

			if(!isset($this->post['submit'])) {
				$token = $this->generate_token();

				return $this->message($this->lang->settings_new, "
				<form action='{$this->self}?a=settings&amp;s=add' method='post'>
				<div>
				{$this->lang->settings_new_name}:  <input class='input' name='new_setting' type='text' value='' /><br /><br />
				{$this->lang->settings_new_value}: <input class='input' name='new_value' type='text' value='' /><br />
				<input type='hidden' name='token' value='$token' />
				<input type='submit' name='submit' value='{$this->lang->submit}' />
				</div>
				</form>" );
			}
			else {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->settings_new, $this->lang->invalid_token );
				}

				if(empty($this->post['new_setting'])) {
					return $this->message($this->lang->settings_new, $this->lang->settings_new_required);
				}

				$new_setting = $this->post['new_setting'];
				$new_value = $this->post['new_value'];

				if( isset($this->sets[$new_setting]) ) {
					return $this->message($this->lang->settings_new, $this->lang->settings_new_exists);
				}

				$this->sets[$new_setting] = $new_value;
				$this->write_sets();

				return $this->message($this->lang->settings_new, $this->lang->settings_new_added);
			}
			break;

		case 'db':
			$this->set_title($this->lang->settings_db);
			$this->tree($this->lang->settings_db);

			$token = $this->generate_token();

			return eval($this->template('ADMIN_EDIT_DB_SETTINGS'));
			break;

		case 'basic':
			$this->set_title($this->lang->settings_basic);
			$this->tree($this->lang->settings_basic);

			$token = $this->generate_token();

			$this->sets['closedtext'] = $this->format($this->sets['closedtext'], FORMAT_HTMLCHARS);
			$this->sets['forum_name'] = $this->format($this->sets['forum_name'], FORMAT_HTMLCHARS);

			$group = $this->db->fetch("SELECT group_name FROM %pgroups WHERE group_id=%d", USER_AWAIT);
			$tos = $this->db->fetch("SELECT settings_tos FROM %psettings");
			$tos_text = htmlspecialchars($tos['settings_tos']);
			$tos = $this->db->fetch("SELECT settings_tos_files FROM %psettings");
			$tos_files_text = htmlspecialchars($tos['settings_tos_files']);

			$tos = $this->db->fetch("SELECT settings_tos_files FROM %psettings");
			$tos_files_text = htmlspecialchars($tos['settings_tos_files']);

			$meta_keywords = htmlspecialchars($this->sets['meta_keywords']);
			$meta_desc = htmlspecialchars($this->sets['meta_description']);

			$attachsize = ($this->sets['attach_upload_size'] / 1024);
			$attachtypes = implode("\r\n", $this->sets['attach_types']);
			$defaultlang = $this->htmlwidgets->select_langs($this->sets['default_lang'], '..');
			$avatarsize = ($this->sets['avatar_upload_size'] / 1024);
			$spideragents = implode("\r\n", array_keys($this->sets['spider_name']));
			$spidernames = implode("\r\n", $this->sets['spider_name']);

			// Set data for use in skin
			$selectSkins = $this->htmlwidgets->select_skins($this->sets['default_skin']);
			$selectGroups = $this->htmlwidgets->select_groups($this->sets['default_group']);
			$selectTimezones = $this->htmlwidgets->select_timezones($this->sets['default_timezone']);
			$severTimezones = $this->htmlwidgets->select_timezones($this->sets['servertime']);

			return eval($this->template('ADMIN_EDIT_BOARD_SETTINGS'));
			break;

		case 'update':
			if (!$this->post) {
				return $this->message($this->lang->settings, $this->lang->settings_nodata);
				break;
			}

			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->settings, $this->lang->invalid_token );
			}

			$tos_text = $this->post['tos'];
			$tos_files_text = $this->post['tos_files'];
			$meta_keywords = $this->post['meta_keywords'];
			$meta_description = $this->post['meta_description'];

			$vartypes = array(
				'db_host' => 'string',
				'db_name' => 'string',
				'db_user' => 'string',
				'db_pass' => 'string',
				'db_port' => 'string',
				'db_socket' => 'string',
				'prefix' => 'string',

				'forum_name' => 'string',
				'loc_of_board' => 'string',
				'closed' => 'bool',
				'closedtext' => 'string',
				'attach_upload_size' => 'kilobytes',
				'attach_types' => 'array',
				'topics_per_page' => 'int',
				'posts_per_page' => 'int',
				'hot_limit' => 'int',
				'debug_mode' => 'bool',
				'default_skin' => 'string',
				'default_email_shown' => 'bool',
				'default_lang' => 'string',
				'default_group' => 'int',
				'default_timezone' => 'string',
				'default_pm' => 'bool',
				'default_view_avatars' => 'bool',
				'default_view_sigs' => 'bool',
				'default_view_emots' => 'bool',
				'link_target' => 'string',
				'vote_after_results' => 'bool',
				'register_image' => 'bool',
				'admin_incoming' => 'string',
				'mailserver' => 'string',
				'admin_outgoing' => 'string',
				'emailactivation' => 'bool',
				'logintime' => 'int',
				'flood_time' => 'int',
				'flood_time_pm' => 'int',
				'flood_time_search' => 'int',
				'cookie_prefix' => 'string',
				'cookie_path' => 'string',
				'cookie_domain' => 'string',
				'cookie_secure' => 'bool',
				'avatar_width' => 'int',
				'avatar_height' => 'int',
				'avatar_upload_size' => 'kilobytes',
				'servertime' => 'string',
				'max_load' => 'float',
				'analytics_code' => 'string',
				'spider_active' => 'bool',
				'spider_agent' => 'array',
				'spider_name' => 'array',
				'registrations_allowed' => 'bool',
				'rss_feed_posts' => 'int',
				'rss_feed_time' => 'int',
				'rss_feed_title' => 'string',
				'rss_feed_desc' => 'string',
				'edit_post_age' => 'int',
				'wordpress_api_key' => 'string',
				'akismet_email' => 'bool',
				'akismet_ureg' => 'bool',
				'akismet_sigs' => 'bool',
				'akismet_posts' => 'bool',
				'akismet_profiles' => 'bool',
				'akismet_posts_number' => 'int',
				'file_approval' => 'bool'
			);

			foreach ($this->post as $var => $val)
			{
				if ($var == 'tos' || $var == 'tos_files' || $var == 'token' || $var == 'meta_keywords' || $var == 'meta_description' )
					continue;
				if (($vartypes[$var] == 'int') || ($vartypes[$var] == 'bool')) {
					$val = intval($val);
				} elseif ($vartypes[$var] == 'float') {
					$val = (float)$val;
				} elseif ($vartypes[$var] == 'kilobytes') {
					$val = intval($val) * 1024;
				} elseif ($vartypes[$var] == 'array') {
					$val = explode("\n", $val);
					$count = count($val);

					for ($i = 0; $i < $count; $i++)
					{
						$val[$i] = trim($val[$i]);
					}
				} elseif ($vartypes[$var] == 'string') {
					$val = $val;
				}

				if ($var == 'cookie_path' && $val != '/') {
					$newval = '';
					if ($val{0} != '/')
						$newval .= '/';
					$newval .= $val;
					if ($val{strlen($val)-1} != '/')
						$newval .= '/';
					$val = $newval;
				}

				$this->sets[$var] = $val;
			}

			$new_spider_names = array();
			foreach ($this->sets['spider_agent'] as $key => $spider_name)
			{
				$new_spider_names[strtolower($spider_name)] = $this->sets['spider_name'][$key];
			}
			unset($this->sets['spider_agent']);
			$this->sets['spider_name'] = $new_spider_names;

			if (isset($this->get['db'])) {
				$this->write_db_sets('../settings.php');
			} else {
				$this->db->query("UPDATE %pusers SET user_language='%s', user_skin='%s' WHERE user_id=%d",
					$this->post['default_lang'], $this->post['default_skin'], USER_GUEST_UID);
				$this->write_sets();
				$this->db->query("UPDATE %psettings SET settings_tos='%s'", $tos_text);
				$this->db->query("UPDATE %psettings SET settings_tos_files='%s'", $tos_files_text);
				$this->db->query("UPDATE %psettings SET settings_meta_keywords='%s'", $meta_keywords);
				$this->db->query("UPDATE %psettings SET settings_meta_description='%s'", $meta_description);
			}

			return $this->message($this->lang->settings, $this->lang->settings_updated);
			break;
		}
	}
}
?>