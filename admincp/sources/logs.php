<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2007 The QSF Portal Development Team
 * http://www.qsfportal.com/
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2006 The Quicksilver Forums Development Team
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

if (!defined('QUICKSILVERFORUMS') || !defined('QSF_ADMIN')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';

class logs extends admin
{
	function execute()
	{
		$this->set_title($this->lang->logs_view);
		$this->tree($this->lang->logs_view);

		$data = $this->db->query("SELECT l.*, u.user_name FROM %plogs l, %pusers u WHERE u.user_id=l.log_user ORDER BY l.log_time DESC");

		$this->lang->main();

		$this->get['min'] = isset($this->get['min']) ? intval($this->get['min']) : 0;
		$this->get['num'] = isset($this->get['num']) ? intval($this->get['num']) : 60;
		$pages = $this->htmlwidgets->get_pages( $data, 'a=logs', $this->get['min'], $this->get['num'] );

		$data = $this->db->query("SELECT l.*, u.user_name FROM %plogs l, %pusers u WHERE u.user_id=l.log_user ORDER BY l.log_time DESC LIMIT %d, %d",
                       $this->get['min'], $this->get['num']);

		$this->iterator_init('tablelight', 'tabledark');

		$out = null;
		while ($log = $this->db->nqfetch($data))
		{
			$class = $this->iterate();
			$date = $this->mbdate(DATE_LONG, $log['log_time']);
			$user = $log['user_name'];
			$action = '';
			$id = '';

			switch ($log['log_action'])
			{
			case 'post_delete':
				$action = $this->lang->logs_deleted_post;
				$id = $this->lang->logs_post . " #" . $log['log_data1'];
				break;

			case 'post_edit':
				$action = $this->lang->logs_edited_post;
				$id = $this->lang->logs_post . " #" . $log['log_data1'];
				break;

			case 'topic_lock':
				$action = $this->lang->logs_locked_topic;
				$id = $this->lang->logs_topic . " #" . $log['log_data1'];
				break;

			case 'topic_unlock':
				$action = $this->lang->logs_unlocked_topic;
				$id = $this->lang->logs_topic . " #" . $log['log_data1'];
				break;

			case 'topic_move':
				$action = $this->lang->logs_moved_topic;
				$id = $this->lang->logs_moved_topic_num . $log['log_data1'] . " " . $this->lang->logs_moved_from . " #" . $log['log_data2'] . " " . $this->lang->logs_moved_to . " #" . $log['log_data3'];
				break;

			case 'topic_edit':
				$action = $this->lang->logs_edited_topic;
				$id = $this->lang->logs_topic . " #" . $log['log_data1'];
				break;

			case 'topic_pin':
				$action = $this->lang->logs_pinned_topic;
				$id = $this->lang->logs_topic . " #" . $log['log_data1'];
				break;

			case 'topic_unpin':
				$action = $this->lang->logs_unpinned_topic;
				$id = $this->lang->logs_topic . " #" . $log['log_data1'];
				break;

			case 'topic_delete':
				$action = $this->lang->logs_deleted_topic;
				$id = $this->lang->logs_topic . " #" . $log['log_data1'];
				break;

			case 'file_edit':
				$action = $this->lang->logs_file_edited;
				$id = $this->lang->logs_file . " #" . $log['log_data1'];
				break;

			case 'file_delete':
				$action = $this->lang->logs_file_deleted;
				$id = $this->lang->logs_file . " #" . $log['log_data1'];
				break;

			case 'file_move':
				$action = $this->lang->logs_file_moved;
				$id = $this->lang->logs_file . " #" . $log['log_data1'] . " " . $this->lang->logs_category_from . " " . $log['log_data2'] . " to " . $log['log_data3'];
				break;

			case 'file_edit_category':
				$action = $this->lang->logs_category_edited;
				$id = $this->lang->logs_category . " #" . $log['log_data1'];
				break;

			case 'file_delete_category':
				$action = $this->lang->logs_category_deleted;
				$id = $this->lang->logs_category . " #" . $log['log_data1'];
				break;

			case 'file_new_category':
				$action = $this->lang->logs_category_created;
				$id = $this->lang->logs_category . " #" . $log['log_data1'];
				break;

			case 'file_add_moderator':
				$action = $this->lang->logs_mod_add;
				$id = $this->lang->logs_user . " #" . $log['log_data1'] . " " . $this->lang->logs_category_in . " #" . $log['log_data2'];
				break;

			case 'file_rem_moderator':
				$action = $this->lang->logs_mod_remove;
				$id = $this->lang->logs_category . " #" . $log['log_data1'];
				break;

			case 'file_update':
				$action = $this->lang->logs_file_updated;
				$id = $this->lang->logs_file . " #" . $log['log_data1'];
				break;

			case 'file_deny_update':
				$action = $this->lang->logs_file_update_denied;
				$id = $this->lang->logs_file . " #" . $log['log_data1'];
				break;

			case 'file_approve_update':
				$action = $this->lang->logs_file_update_approved;
				$id = $this->lang->logs_file . " #" . $log['log_data1'];
				break;

			default:
				$action = $log['log_action'];
				$id = $log['log_data1'];
			}

			$out .= eval($this->template('ADMIN_MOD_LOGS_ENTRY'));
		}
		return eval($this->template('ADMIN_MOD_LOGS'));
	}
}
?>
