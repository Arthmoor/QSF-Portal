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

// Upgrade from QSF Portal 1.4.2 to QSF Portal 1.4.3

// Template changes - Don't forget to enclose them inside single quotes!!!
$need_templates = array(
	// Added templates
	'RSSFEED_FILE_ITEM',
	// Changed templates
	'FORUM_TOPICS_MAIN',
	'ADMIN_INSTALL_SKIN',
	'ADMIN_EDIT_BOARD_SETTINGS',
	'ADMIN_BAN_FORM',
	'PAGE_EDIT',
	'PAGE_CREATE',
	'RECENT_MAIN',
	'FILE_ADD_CAT',
	'FILE_EDIT_CAT',
	'TOPIC_POSTER_MEMBER',
	'BOARD_MAIN',
	'FILES_MAIN',
	'PM_FOLDER_MESSAGE'
	);

$this->sets['edit_post_age'] = 0;

// Forum permission changes	
$new_permissions['post_edit_old'] = false;
$new_permissions['post_delete_old'] = false;

// File permission changes

// Queries to run
$queries[] = "INSERT INTO %pfile_categories (fcat_id, fcat_name, fcat_longpath) VALUES( 0, 'Root', '/' )";
$queries[] = "UPDATE %pfile_categories SET fcat_id=0 WHERE fcat_name='Root'";
$queries[] = "ALTER TABLE %psettings ADD settings_tos_files text AFTER settings_tos";
?>