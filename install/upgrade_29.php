<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2007 The QSF Portal Development Team
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

// Upgrade from QSF Portal 1.4.0 to QSF Portal 1.4.1

// Template changes - Don't forget to enclose them inside single quotes!!!
$need_templates = array(
	// Added templates
	// Changed templates
	'TOPIC_MAIN',
	'TOPIC_POST',
	'TOPIC_QUICKREPLY',
	'PAGE_EDIT',
	'PAGE_CREATE',
	'POST_ATTACH_REMOVE'
	);

// Forum permission changes	

// File permission changes

// Queries to run
$queries[] = "ALTER TABLE %ppages ADD page_flags int(10) unsigned NOT NULL default '0' AFTER page_title";
?>