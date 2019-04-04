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

class logs extends admin
{
	function execute()
	{
		$this->set_title( $this->lang->logs_view );
		$this->tree( $this->lang->logs_view );

		$data = $this->db->query( "SELECT l.*, u.user_name FROM %plogs l, %pusers u WHERE u.user_id=l.log_user ORDER BY l.log_time DESC" );
		$num = $this->db->num_rows( $data );

		$this->lang->main();

		$this->get['min'] = isset( $this->get['min'] ) ? intval( $this->get['min'] ) : 0;
		$this->get['num'] = isset( $this->get['num'] ) ? intval( $this->get['num'] ) : 60;
		$pages = $this->htmlwidgets->get_pages( $num, 'a=logs', $this->get['min'], $this->get['num'] );

		$data = $this->db->query( "SELECT l.*, u.user_name FROM %plogs l, %pusers u WHERE u.user_id=l.log_user ORDER BY l.log_time DESC LIMIT %d, %d",
                       $this->get['min'], $this->get['num'] );

		$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/logs.xtpl' );

		$xtpl->assign( 'pages', $pages );
		$xtpl->assign( 'logs_view', $this->lang->logs_view );
		$xtpl->assign( 'logs_time', $this->lang->logs_time );
		$xtpl->assign( 'logs_user', $this->lang->logs_user );
		$xtpl->assign( 'logs_action', $this->lang->logs_action );
		$xtpl->assign( 'logs_id', $this->lang->logs_id );

		while( $log = $this->db->nqfetch( $data ) )
		{
			$date = $this->mbdate( DATE_LONG, $log['log_time'] );
			$user = $log['user_name'];
			$action = '';
			$id = '';

			switch( $log['log_action'] )
			{
			case 'spam_delete':
				$action = $this->lang->logs_reported_spam;
				$id = $this->lang->logs_post . " #" . $log['log_data1'];
				break;

			case 'post_delete':
				$action = $this->lang->logs_deleted_post;
				$id = $this->lang->logs_post . " #" . $log['log_data1'];
				break;

			case 'post_edit':
				$action = $this->lang->logs_edited_post;
				$id = $this->lang->logs_post . " #" . $log['log_data1'];
				break;

			case 'topic_publish':
				$action = $this->lang->logs_published_topic;
				$id = $this->lang->logs_topic . ' #' . $log['log_data1'];
				break;

			case 'topic_unpublish':
				$action = $this->lang->logs_unpublished_topic;
				$id = $this->lang->logs_topic . ' #' . $log['log_data1'];
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

			$xtpl->assign( 'date', $date );
			$xtpl->assign( 'user', $user );
			$xtpl->assign( 'action', $action );
			$xtpl->assign( 'id', $id );

			$xtpl->parse( 'Logs.Entry' );
		}

		$xtpl->parse( 'Logs' );
		return $xtpl->text( 'Logs' );
	}
}
?>