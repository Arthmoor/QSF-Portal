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

// Upgrade from 1.1.9 to 1.2.0
$need_templates = array(
	'TOPIC_QUICKREPLY',	// Added templates
	'RSSFEED_ALL_POSTS',
	'RSSFEED_ERROR',
	'RSSFEED_FORUM',
	'RSSFEED_TOPIC',
	'RSSFEED_ITEM',
	'ACTIVE_USER',  	// Changed templates
	'PM_SEND',
	'PM_FOLDER',
	'CP_PREFS',
	'BOARD_MAIN',
	'FORUM_TOPIC',
	'FORUM_TOPICS_MAIN',
	'FORUM_NO_TOPICS',
	'RECENT_MAIN',
	'RECENT_NO_TOPICS',
	'RECENT_TOPIC',
	'TOPIC_MAIN',
	'TOPIC_POST',
	'MAIN_HEADER_GUEST',
	'MAIN_HEADER_MEMBER',
	'POST_CLICKABLE_SMILIES',
	'POST_MESSAGE_ICONS',
	'SEARCH_MAIN',
	'BOARD_LAST_POST_BOX',
	'ADMIN_INDEX',
	'ADMIN_FORUM_ORDER',
	'ADMIN_MASS_MAIL',
	'ADMIN_EDIT_BOARD_SETTINGS',
	'MAIN'
	);
	
$new_permissions['post_inc_userposts'] = true;
$new_permissions['topic_publish_auto'] = true; // will publish on posting
$new_permissions['topic_publish'] = false;
$new_permissions['topic_view_unpublished'] = false;

$queries[] = "DROP TABLE IF EXISTS %preadmarks";
$queries[] = "CREATE TABLE %preadmarks (
  readmark_user int(10) unsigned NOT NULL default '0',
  readmark_topic int(10) unsigned NOT NULL default '0',
  readmark_lastread int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (readmark_user,readmark_topic)
) TYPE=MyISAM";

// Set up a seperate column for 'mark all read'
$queries[] = "ALTER TABLE %pusers ADD user_lastallread int(10) unsigned NOT NULL default '0' AFTER user_lastvisit";
$queries[] = "ALTER TABLE %pposts ADD post_count tinyint(1) unsigned NOT NULL default '1' AFTER post_mbcode";
$queries[] = "UPDATE %pusers SET user_lastallread=user_lastvisit";
$queries[] = "UPDATE %ptopics SET topic_modes=topic_modes | " . TOPIC_PUBLISH; // Make all topics published

// New timezones
$queries[] = "INSERT INTO %ptimezones VALUES (384, 'America/Moncton', 'AST', -14400, 1143950460)";
$queries[] = "INSERT INTO %ptimezones VALUES (385, 'America/Indiana/Petersburg', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (386, 'America/Indiana/Vincennes', 'EST', -18000, 1143961200)";


?>
