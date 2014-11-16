<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2010 The QSF Portal Development Team
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

if (!defined('INSTALLER')) {
	exit('Use index.php to upgrade.');
}

// Upgrade from QSF Portal 1.3.1 to QSF Portal 1.3.2

// Template changes
$need_templates = array(
	// Added templates
	'FILE_ADD_CAT',
	'FILE_EDIT_CAT',
	'MAIN_STATIC_CONTENT',
	'STAT_STAT',
	'STAT_GRAPH',
	'STAT_PAGE',
	// Changed templates
	'ADMIN_INDEX',
	'ADMIN_HOME',
	'FILES_MAIN',
	'FILE_COMMENT_LIST',
	'FILE_DETAILS',
	'CP_PREFS',
	'FORUM_TOPIC',
	'RECENT_TOPIC'
	);

// Forum permission changes	

// File permission changes
$new_file_perms['download_files'] = true;
$new_file_perms['upload_files'] = false;
$new_file_perms['approve_files'] = false;
$new_file_perms['edit_files'] = false;
$new_file_perms['move_files'] = false;
$new_file_perms['delete_files'] = false;
$new_file_perms['post_comment'] = false;
$new_file_perms['category_view'] = true;
$new_file_perms['edit_category'] = false;
$new_file_perms['delete_category'] = false;
$new_file_perms['ad_category'] = false;

// Queries to run
$queries[] = "ALTER TABLE %pfile_categories ADD fcat_description varchar(255) NOT NULL default '' AFTER fcat_name";
$queries[] = "ALTER TABLE %pusers ADD user_pm_mail tinyint(1) NOT NULL default '0' AFTER user_pm";
$queries[] = "ALTER TABLE %pusers ADD user_file_perms text NOT NULL default '' AFTER user_perms";
$queries[] = "ALTER TABLE %pgroups ADD group_file_perms text NOT NULL default '' AFTER group_perms";
$queries[] = "ALTER TABLE %pfile_categories DROP fcat_restricted";

// Required update for topic_posted setting
$db->query( "ALTER TABLE %ptopics ADD topic_posted int(10) unsigned NOT NULL DEFAULT '0' AFTER topic_icon" );
$query = $db->query( "SELECT * FROM %ptopics" );
while( $row = $db->nqfetch($query) )
{
	$topic_id = $row['topic_id'];
	if ($row['topic_moved']) {
		$topic_id = $row['topic_moved'];
	}
	// Ripped the code from update_last_post_topic in mod.php for this.
	$first = $db->fetch("
	SELECT
		p.post_id, p.post_time
	FROM
		%pposts p,
		%ptopics t
	WHERE
		p.post_topic=t.topic_id AND
		t.topic_id=%d
	ORDER BY
		p.post_time ASC
	LIMIT 1", $topic_id);

	$db->query("UPDATE %ptopics SET topic_posted=%d WHERE topic_id=%d", $first['post_time'], $topic_id);
}

// New Timezones

?>
