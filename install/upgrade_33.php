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

// Upgrade from QSF Portal 1.4.4 to QSF Portal 1.4.5

// Template changes - Don't forget to enclose them inside single quotes!!!
$need_templates = array(
	// Added templates
	'ADMIN_INDEX', // Changed templates
	'FILE_DETAILS',
	'PROFILE_MAIN',
	'POST_TOPIC',
	'POST_REPLY',
	'POST_POLL',
	'TOPIC_MAIN',
	'FORUM_TOPIC'
	);

$this->sets['wordpress_api_key'] = '';
$this->sets['akismet_email'] = 0;
$this->sets['akismet_ureg'] = 0;

// Forum permission changes	

// File permission changes

// Queries to run
$queries[] = "ALTER TABLE %pusers ADD user_register_email varchar(100) default ''";
$queries[] = "ALTER TABLE %pusers ADD user_server_data text";
?>