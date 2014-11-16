<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005-2006 The Quicksilver Forums Development Team
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

// Upgrade from 1.2.1 to 1.3.0

// Template changes
$need_templates = array(
	// Added templates
	'TOPIC_POST_ATTACHMENT',
	'BOARD_USERS',
	'BOARD_STATS',
	'ADMIN_CSS_EDIT',
	'ADMIN_INSTALL_SKIN',
	// Changed templates
	'MAIN',
	'MAIN_COPYRIGHT',
	'BOARD_FORUM',
	'BOARD_LAST_POST_BOX',
	'BOARD_MAIN',
	'CP_AVATAR',
	'CP_EDIT_SIG',
	'CP_PREFS',
	'MOD_EDIT_TOPIC',
	'PM_SEND',
	'POST_BOX_PLAIN',
	'POST_CLICKABLE_SMILIES',
	'TOPIC_MAIN',
	'TOPIC_POST',
	'TOPIC_QUICKREPLY',
	'RECENT_TOPIC',
	'RSSFEED_ITEM',
	'ADMIN_LIST_TEMPLATES',
	'ADMIN_EDIT_BOARD_SETTINGS'
	);

$this->sets['debug_mode'] = 0;

// Permission changes	
// $new_permissions['new_perm'] = true;

// Queries to run
$queries[] = "ALTER TABLE %pusers ADD user_posts_page tinyint(2) unsigned NOT NULL DEFAULT '0' AFTER user_view_emoticons";
$queries[] = "ALTER TABLE %pusers ADD user_topics_page tinyint(2) unsigned NOT NULL DEFAULT '0' AFTER user_view_emoticons";

// New Timezones
$queries[] = "INSERT INTO %ptimezones VALUES (387, 'America/North_Dakota/New_Salem', 'CST', -18000, 1143961200)";

// Required update for topic_last_post setting
$db->query( "ALTER TABLE %ptopics ADD topic_last_post int(10) unsigned NOT NULL DEFAULT '0' AFTER topic_starter" );
$query = $db->query( "SELECT * FROM %ptopics" );
while( $row = $db->nqfetch($query) )
{
	$topic_id = $row['topic_id'];
	if ($row['topic_moved']) {
		$topic_id = $row['topic_moved'];
	}
	// Ripped the code from update_last_post_topic in mod.php for this.
	$last = $db->fetch("
	SELECT
		p.post_id, p.post_time
	FROM
		%pposts p,
		%ptopics t
	WHERE
		p.post_topic=t.topic_id AND
		t.topic_id=%d
	ORDER BY
		p.post_time DESC
	LIMIT 1", $topic_id);

	$db->query("UPDATE %ptopics SET topic_last_post=%d WHERE topic_id=%d", $last['post_id'], $topic_id);
}
?>
