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

// Upgrade from 1.1.3 to 1.1.4

$need_templates = array(
	'BOARD_CATEGORY',
	'BOARD_FORUM',
	'BOARD_LAST_POST_BOX',
	'CP_AVATAR',
	'EMAIL_MAIN',
	'FORUM_MAIN',
	'FORUM_SUBFORUM_MAIN',
	'LOGIN_MAIN',
	'LOGIN_PASS',
	'MAIN_ETABLE',
	'MAIN_HEADER_MEMBER',
	'MAIN_MESSAGE',
	'MAIN_TABLE',
	'MEMBERS_MAIN',
	'MOD_EDIT_TOPIC',
	'MOD_MOVE_TOPIC',
	'MOD_SPLIT_TOPIC',
	'PM_SEND',
	'PM_VIEW',
	'POLL_MAIN',
	'POLL_OPTION',
	'POLL_RESULTS_ENTRY',
	'POLL_RESULTS_MAIN',
	'POST_BOX_PLAIN',
	'POST_BOX_RICH',
	'POST_PREVIEW',
	'POST_REVIEW_ENTRY',
	'PRINTER_MAIN',
	'PRINTER_POST',
	'PROFILE_MAIN',
	'SEARCH_RESULTS_MAIN',
	'SEARCH_RESULTS_MEMBER_INFO',
	'SEARCH_RESULTS_POST',
	'TOPIC_MAIN',
	'TOPIC_POST',
	'TOPIC_POSTER_MEMBER'
);

$this->sets['default_email_shown'] = 1;
$this->sets['default_lang'] = 'en';
$this->sets['default_group'] = USER_MEMBER;
$this->sets['default_timezone'] = 0;
$this->sets['default_pm'] = 1;
$this->sets['default_view_avatars'] = 1;
$this->sets['default_view_sigs'] = 1;
$this->sets['default_view_emots'] = 1;
$this->sets['flood_time_pm'] = 30;
$this->sets['flood_time_search'] = 10;

$queries[] = "ALTER TABLE %ppmsystem ADD pm_bcc text NOT NULL AFTER pm_from";
$queries[] = "ALTER TABLE %pusers ADD user_lastsearch INT(10) UNSIGNED NOT NULL AFTER user_lastpost";
$queries[] = "ALTER TABLE %pusers ADD user_lastpm INT(10) UNSIGNED NOT NULL AFTER user_lastpost";
?>
