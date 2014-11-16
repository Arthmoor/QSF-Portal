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

// Upgrade from QSF Portal 1.3.3 to QSF Portal 1.3.4

// Template changes - Don't forget to enclose them inside single quotes!!!
$need_templates = array(
	// Added templates
	// Changed templates
	'FILES_MAIN',
	'FILE_CATEGORY',
	'FILE_CATS',
	'FILE_EDIT',
	'FILE_RECENT',
	'FILE_UPDATE',
	'FILE_UPLOAD',
	'CP_PROFILE',
	'CP_MAIN',
	'ADMIN_EDIT_BOARD_SETTINGS',
	'MAIN'
	);

$this->sets['analytics_id'] = '';

// Forum permission changes	

// File permission changes

// Queries to run
$queries[] = "ALTER TABLE %pusers ADD user_regip INT UNSIGNED NOT NULL default '0' AFTER user_posts_page";

// New Timezones

?>
