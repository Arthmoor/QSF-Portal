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

if (!defined('INSTALLER')) {
	exit('Use index.php to upgrade.');
}

// Upgrade from 1.0.1 to 1.0.2

// Template changes
$need_templates = array(
	// Added templates
	// Changed templates
	'MAIN_COPYRIGHT',
	'PM_VIEW',
	'PROFILE_MAIN'
	);

$queries[] = "DELETE FROM %pactive";
$queries[] = "ALTER TABLE %pactive ADD active_session varchar(32) NOT NULL default '',
DROP PRIMARY KEY,
ADD UNIQUE KEY active_session (active_session),
ADD UNIQUE KEY active_ip (active_ip)";

$queries[] = "ALTER TABLE %pgroups
MODIFY group_format varchar(255) NOT NULL default '%%s',
ADD group_perms text NOT NULL";

$queries[] = "DROP TABLE IF EXISTS %pperms";

$queries[] = "ALTER TABLE %pusers ADD user_perms text NOT NULL AFTER user_view_emoticons";

$queries[] = "UPDATE %pgroups SET group_perms='a:34:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:1;s:11:\"do_anything\";b:1;s:8:\"is_admin\";b:1;s:9:\"email_use\";b:1;s:10:\"forum_view\";b:1;s:11:\"post_viewip\";b:1;s:10:\"topic_view\";b:1;s:11:\"poll_create\";b:1;s:9:\"poll_vote\";b:1;s:11:\"post_create\";b:1;s:12:\"topic_create\";b:1;s:12:\"post_noflood\";b:1;s:11:\"post_delete\";b:1;s:15:\"post_delete_own\";b:1;s:12:\"topic_delete\";b:1;s:16:\"topic_delete_own\";b:1;s:9:\"post_edit\";b:1;s:13:\"post_edit_own\";b:1;s:10:\"topic_edit\";b:1;s:14:\"topic_edit_own\";b:1;s:10:\"topic_lock\";b:1;s:14:\"topic_lock_own\";b:1;s:12:\"topic_unlock\";b:1;s:16:\"topic_unlock_mod\";b:1;s:16:\"topic_unlock_own\";b:1;s:9:\"topic_pin\";b:1;s:13:\"topic_pin_own\";b:1;s:11:\"topic_unpin\";b:1;s:15:\"topic_unpin_own\";b:1;s:10:\"topic_move\";b:1;s:14:\"topic_move_own\";b:1;s:11:\"post_attach\";b:1;s:20:\"post_attach_download\";b:1;}' WHERE group_id=1";
$queries[] = "UPDATE %pgroups SET group_perms='a:34:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:1;s:8:\"is_admin\";b:0;s:9:\"email_use\";b:1;s:10:\"forum_view\";b:1;s:11:\"post_viewip\";b:0;s:10:\"topic_view\";b:1;s:11:\"poll_create\";b:1;s:9:\"poll_vote\";b:1;s:11:\"post_create\";b:1;s:12:\"topic_create\";b:1;s:12:\"post_noflood\";b:0;s:11:\"post_delete\";b:0;s:15:\"post_delete_own\";b:1;s:12:\"topic_delete\";b:0;s:16:\"topic_delete_own\";b:1;s:9:\"post_edit\";b:0;s:13:\"post_edit_own\";b:1;s:10:\"topic_edit\";b:0;s:14:\"topic_edit_own\";b:1;s:10:\"topic_lock\";b:0;s:14:\"topic_lock_own\";b:1;s:12:\"topic_unlock\";b:0;s:16:\"topic_unlock_mod\";b:0;s:16:\"topic_unlock_own\";b:1;s:9:\"topic_pin\";b:0;s:13:\"topic_pin_own\";b:0;s:11:\"topic_unpin\";b:0;s:15:\"topic_unpin_own\";b:1;s:10:\"topic_move\";b:0;s:14:\"topic_move_own\";b:1;s:11:\"post_attach\";b:1;s:20:\"post_attach_download\";b:1;}' WHERE group_id=2";
$queries[] = "UPDATE %pgroups SET group_perms='a:34:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:1;s:8:\"is_admin\";b:0;s:9:\"email_use\";b:0;s:10:\"forum_view\";b:1;s:11:\"post_viewip\";b:0;s:10:\"topic_view\";b:1;s:11:\"poll_create\";b:0;s:9:\"poll_vote\";b:1;s:11:\"post_create\";b:0;s:12:\"topic_create\";b:0;s:12:\"post_noflood\";b:0;s:11:\"post_delete\";b:0;s:15:\"post_delete_own\";b:0;s:12:\"topic_delete\";b:0;s:16:\"topic_delete_own\";b:0;s:9:\"post_edit\";b:0;s:13:\"post_edit_own\";b:0;s:10:\"topic_edit\";b:0;s:14:\"topic_edit_own\";b:0;s:10:\"topic_lock\";b:0;s:14:\"topic_lock_own\";b:0;s:12:\"topic_unlock\";b:0;s:16:\"topic_unlock_mod\";b:0;s:16:\"topic_unlock_own\";b:0;s:9:\"topic_pin\";b:0;s:13:\"topic_pin_own\";b:0;s:11:\"topic_unpin\";b:0;s:15:\"topic_unpin_own\";b:0;s:10:\"topic_move\";b:0;s:14:\"topic_move_own\";b:0;s:11:\"post_attach\";b:0;s:20:\"post_attach_download\";b:0;}' WHERE group_id=3";
$queries[] = "UPDATE %pgroups SET group_perms='a:34:{s:10:\"board_view\";b:0;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:0;s:8:\"is_admin\";b:0;s:9:\"email_use\";b:0;s:10:\"forum_view\";b:0;s:11:\"post_viewip\";b:0;s:10:\"topic_view\";b:0;s:11:\"poll_create\";b:0;s:9:\"poll_vote\";b:0;s:11:\"post_create\";b:0;s:12:\"topic_create\";b:0;s:12:\"post_noflood\";b:0;s:11:\"post_delete\";b:0;s:15:\"post_delete_own\";b:0;s:12:\"topic_delete\";b:0;s:16:\"topic_delete_own\";b:0;s:9:\"post_edit\";b:0;s:13:\"post_edit_own\";b:0;s:10:\"topic_edit\";b:0;s:14:\"topic_edit_own\";b:0;s:10:\"topic_lock\";b:0;s:14:\"topic_lock_own\";b:0;s:12:\"topic_unlock\";b:0;s:16:\"topic_unlock_mod\";b:0;s:16:\"topic_unlock_own\";b:0;s:9:\"topic_pin\";b:0;s:13:\"topic_pin_own\";b:0;s:11:\"topic_unpin\";b:0;s:15:\"topic_unpin_own\";b:0;s:10:\"topic_move\";b:0;s:14:\"topic_move_own\";b:0;s:11:\"post_attach\";b:0;s:20:\"post_attach_download\";b:0;}' WHERE group_id=4";
$queries[] = "UPDATE %pgroups SET group_perms='a:34:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:1;s:8:\"is_admin\";b:0;s:9:\"email_use\";b:0;s:10:\"forum_view\";b:1;s:11:\"post_viewip\";b:1;s:10:\"topic_view\";b:1;s:11:\"poll_create\";b:0;s:9:\"poll_vote\";b:1;s:11:\"post_create\";b:1;s:12:\"topic_create\";b:0;s:12:\"post_noflood\";b:0;s:11:\"post_delete\";b:0;s:15:\"post_delete_own\";b:0;s:12:\"topic_delete\";b:0;s:16:\"topic_delete_own\";b:0;s:9:\"post_edit\";b:0;s:13:\"post_edit_own\";b:0;s:10:\"topic_edit\";b:0;s:14:\"topic_edit_own\";b:0;s:10:\"topic_lock\";b:0;s:14:\"topic_lock_own\";b:0;s:12:\"topic_unlock\";b:0;s:16:\"topic_unlock_mod\";b:0;s:16:\"topic_unlock_own\";b:0;s:9:\"topic_pin\";b:0;s:13:\"topic_pin_own\";b:0;s:11:\"topic_unpin\";b:0;s:15:\"topic_unpin_own\";b:0;s:10:\"topic_move\";b:0;s:14:\"topic_move_own\";b:0;s:11:\"post_attach\";b:0;s:20:\"post_attach_download\";b:0;}' WHERE group_id=5";

/**
 * To do:
 * Add forums to the group permissions cube
 */

$queries[] = "UPDATE %pusers SET user_email_form=0 WHERE user_id=1";
?>
