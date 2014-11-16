<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005 The Quicksilver Forums Development Team
 *  http://www.quicksilverforums.com/
 * 
 * based off MercuryBoard
 * Copyright (c) 2001-2005 The Mercury Development Team
 *  http://www.mercuryboard.com/
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
		$this->iterator_init('light', 'dark');

		if (!isset($this->get['s'])) {
			$this->get['s'] = null;
		}

		switch($this->get['s'])
		{
		case 'add':
			$this->set_title($this->lang->settings_new_add);
			$this->tree($this->lang->settings_new_add);

			if(!isset($this->post['submit'])) {
				return $this->message($this->lang->settings_new, "
				<form action='{$this->self}?a=settings&amp;s=add' method='post'>
				<div>
				{$this->lang->settings_new_name}:  <input class='input' name='new_setting' type='text' value='' /><br /><br />
				{$this->lang->settings_new_value}: <input class='input' name='new_value' type='text' value='' /><br />
				<input type='submit' name='submit' value='{$this->lang->submit}' />
				</div>
				</form>" );
			}
			else {
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

			return eval($this->template('ADMIN_EDIT_DB_SETTINGS'));
			break;

		case 'basic':
			$this->set_title($this->lang->settings_basic);
			$this->tree($this->lang->settings_basic);

			$this->sets['closedtext'] = $this->format($this->sets['closedtext'], FORMAT_HTMLCHARS);
			$this->sets['forum_name'] = $this->format($this->sets['forum_name'], FORMAT_HTMLCHARS);

			$group = $this->db->fetch("SELECT group_name FROM %pgroups WHERE group_id=%d", USER_AWAIT);
			$tos = $this->db->fetch("SELECT settings_tos FROM %psettings");
			$tos_text = htmlspecialchars($tos['settings_tos']);

			$attachsize = ($this->sets['attach_upload_size'] / 1024);
			$attachtypes = implode("\r\n", $this->sets['attach_types']);
			$defaultlang = $this->htmlwidgets->select_langs($this->sets['default_lang'], '..');
			$avatarsize = ($this->sets['avatar_upload_size'] / 1024);
			$spideragents = implode("\r\n", array_keys($this->sets['spider_name']));
			$spidernames = implode("\r\n", $this->sets['spider_name']);
			$optionalModules = implode("\r\n", $this->sets['optional_modules']);

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

			$tos_text = $this->post['tos'];
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
				'clickable_per_row' => 'int',
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
				'default_timezone' => 'float',
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
				'flash_avs' => 'bool',
				'avatar_width' => 'int',
				'avatar_height' => 'int',
				'avatar_upload_size' => 'kilobytes',
				'output_buffer' => 'bool',
				'servertime' => 'float',
				'max_load' => 'float',
				'spider_active' => 'bool',
				'spider_agent' => 'array',
				'spider_name' => 'array',
				'rss_feed_posts' => 'int',
				'rss_feed_time' => 'int',
				'rss_feed_title' => 'string',
				'rss_feed_desc' => 'string',
				'optional_modules' => 'array'
			);

			foreach ($this->post as $var => $val)
			{
				if ($var == 'tos')
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
			}

			return $this->message($this->lang->settings, $this->lang->settings_updated);
			break;
		}
	}
}
?>
