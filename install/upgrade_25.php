<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2008 The QSF Portal Development Team
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

// Upgrade from QSF Portal 1.3.2 to QSF Portal 1.3.3

// Template changes - Don't forget to enclose them inside single quotes!!!
$need_templates = array(
	// Added templates
	'ADMIN_BACKUP',
	'POST_OPTIONS',
	'BOARD_FORUM_URL',
	// Changed templates
	'FILES_MAIN',
	'FILES_SEARCHRESULT',
	'FILE_ADD_CAT',
	'FILE_APPROVAL',
	'FILE_CATEGORY',
	'FILE_CATS',
	'FILE_COMMENT',
	'FILE_COMMENT_ADD',
	'FILE_COMMENT_LIST',
	'FILE_DELETE',
	'FILE_DETAILS',
	'FILE_EDIT',
	'FILE_EDIT_CAT',
	'FILE_RATING',
	'FILE_RECENT',
	'FILE_SEARCH',
	'FILE_UPDATE',
	'FILE_UPLOAD',
	'PROFILE_UPLOADS',
	'PROFILE_MAIN',
	'PAGE_CREATE',
	'PAGE_EDIT',
	'PAGE_LIST',
	'PAGE_NONE',
	'PAGE_PAGE',
	'MAIN_COPYRIGHT',
	'ADMIN_COPYRIGHT',
	'ADMIN_HOME',
	'ADMIN_INDEX',
	'MAIN_AFFILIATES',
	'MAIN_HEADER_GUEST',
	'MAIN_HEADER_MEMBER',
	'MAIN_NEWS_ITEM',
	'MAIN_PORTAL',
	'MAIN_RECENT_POSTS',
	'MAIN_RECENT_UPLOADS',
	'MAIN_STATS',
	'MAIN_TOP_POSTERS',
	'MAIN_USERS',
	'MAIN_USER_LOGIN',
	'POLL_RESULTS_MAIN',
	'POST_CLICKABLE_SMILIES',
	'TOPIC_QUICKREPLY',
	'ADMIN_EDIT_BOARD_SETTINGS',
	'POST_POLL',
	'POST_REPLY',
	'POST_TOPIC',
	'ADMIN_FORUM_ADD',
	'ADMIN_FORUM_EDIT',
	'FORUM_TOPIC',
	'BOARD_LAST_POST_BOX',
	'RECENT_TOPIC',
	'ADMIN_CSS_EDIT',
	'POST_BOX_PLAIN'
	);

$this->sets['cookie_domain'] = '';
$this->sets['cookie_secure'] = 0;

// Forum permission changes	

// File permission changes

// Queries to run
$queries[] = "ALTER TABLE %pforums ADD forum_redirect tinyint(1) NOT NULL default '0' AFTER forum_subcat";

// New Timezones

?>
