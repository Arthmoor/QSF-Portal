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

// Upgrade from 1.1.8 to 1.1.9

$need_templates = array(
	'BOARD_CATEGORY_END',	// New Templates
	'PM_FOLDER',		// Changed Templates
	'FORUM_TOPICS_MAIN',
	'MAIN',
	'MAIN_MBCODE',
	'MOD_EDIT_POST',
	'RECENT_MAIN',
	'SEARCH_MAIN',
	'TOPIC_MAIN',
	'ADMIN_HOME',
	'ADMIN_EDIT_TEMPLATE',
	'ADMIN_PRUNE_TOPICLIST'
	);

$queries[] = "ALTER TABLE %pgroups CHANGE group_perms group_perms TEXT NOT NULL DEFAULT ''";
$queries[] = "ALTER TABLE %phelp CHANGE help_article help_article TEXT NOT NULL DEFAULT ''";
$queries[] = "ALTER TABLE %ppmsystem CHANGE pm_bcc pm_bcc TEXT NOT NULL DEFAULT ''";
$queries[] = "ALTER TABLE %ppmsystem CHANGE pm_message pm_message TEXT NOT NULL DEFAULT ''";
$queries[] = "ALTER TABLE %ppmsystem ADD pm_ip INT UNSIGNED NOT NULL default '0' AFTER pm_from";
$queries[] = "ALTER TABLE %pposts CHANGE post_text post_text TEXT NOT NULL DEFAULT ''";
$queries[] = "ALTER TABLE %psettings CHANGE settings_data settings_data TEXT NOT NULL DEFAULT ''";
$queries[] = "ALTER TABLE %psettings CHANGE settings_tos settings_tos TEXT NOT NULL DEFAULT ''";
$queries[] = "ALTER TABLE %ptemplates CHANGE template_html template_html TEXT NOT NULL DEFAULT ''";
$queries[] = "ALTER TABLE %ptopics CHANGE topic_poll_options topic_poll_options TEXT NOT NULL DEFAULT ''";
$queries[] = "ALTER TABLE %pusers CHANGE user_signature user_signature TEXT NOT NULL DEFAULT ''";
$queries[] = "ALTER TABLE %pusers CHANGE user_perms user_perms TEXT NOT NULL DEFAULT ''";
?>
