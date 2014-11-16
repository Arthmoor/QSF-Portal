<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2015 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * http://code.google.com/p/quicksilverforums/
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

if (!defined('QSF_INSTALLER')) {
	exit('Use index.php to upgrade.');
}

// Upgrade from QSF Portal 1.4.5 to QSF Portal 1.4.6

// Template changes - Don't forget to enclose them inside single quotes!!!
$need_templates = array(
	'ADMIN_FORUM_DELETE',	// Added templates
	'ADMIN_MEMBER_DELETE',
	'MAIN', // Changed templates
	'ADMIN_INDEX',
	'PROFILE_POST_INFO',
	'POST_PREVIEW',
	'TOPIC_POST',
	'RSSFEED_FORUM',
	'FILE_CATLINK',
	'FORUM_TOPICS_MAIN',
	'SEARCH_MAIN',
	'FILE_SEARCH',
	'PM_FOLDER',
	'RECENT_MAIN',
	'FILES_MAIN',
	'ADMIN_BAN_FORM',
	'ADMIN_CENSOR_FORM',
	'ADMIN_FORUM_EDIT',
	'ADMIN_FORUM_ADD',
	'ADMIN_FORUM_ORDER',
	'ADMIN_GROUP_EDIT',
	'ADMIN_MASS_MAIL',
	'ADMIN_MEMBER_PROFILE',
	'ADMIN_PRUNE_FORM',
	'ADMIN_PRUNE_TOPICLIST',
	'ADMIN_EDIT_DB_SETTINGS',
	'ADMIN_EDIT_BOARD_SETTINGS',
	'ADMIN_EDIT_SKIN',
	'ADMIN_CSS_EDIT',
	'ADMIN_ADD_TEMPLATE',
	'ADMIN_EDIT_TEMPLATE',
	'CP_PASS',
	'CP_PREFS',
	'CP_PROFILE',
	'CP_AVATAR',
	'CP_EDIT_SIG',
	'EMAIL_MAIN',
	'FILE_EDIT',
	'FILE_EDIT_CAT',
	'FILE_ADD_CAT',
	'FILE_DELETE',
	'FILE_UPDATE',
	'FILE_UPLOAD'
	);

// Forum permission changes	

// File permission changes

// Queries to run
?>