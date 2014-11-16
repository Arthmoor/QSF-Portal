<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2010 The QSF Portal Development Team
 * http://www.qsfportal.com/
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2009 The Quicksilver Forums Development Team
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

// Upgrade from QSF Portal 1.4.6 to QSF Portal 1.5

// Template changes - Don't forget to enclose them inside single quotes!!!
$need_templates = array(
	// Added templates
	'MAIN_USERS_VISITED',
	// Changed templates
	'BOARD_MAIN',
	'REGISTER_IMAGE',
	'REGISTER_MAIN',
	'ADMIN_BACKUP',
	'ACTIVE_MAIN',
	'ADMIN_ADD_TEMPLATE',
	'ADMIN_COPYRIGHT',
	'ADMIN_DELETE_TEMPLATE',
	'ADMIN_EDIT_TEMPLATE_ENTRY',
	'ADMIN_INDEX',
	'ADMIN_INSTALL_SKIN',
	'ADMIN_MEMBER_DELETE',
	'CP_EDIT_SIG',
	'FILE_CATLINK',
	'MAIN_COPYRIGHT',
	'MAIN_PORTAL',
	'MAIN_USER_LOGIN',
	'MEMBERS_MEMBER',
	'MOD_EDIT_POST',
	'MOD_EDIT_TOPIC',
	'MOD_MOVE_TOPIC',
	'NEWS_POST',
	'PAGE_CREATE',
	'PAGE_EDIT',
	'PM_SEND',
	'POST_BOX_PLAIN',
	'POST_POSTER_MEMBER',
	'TOPIC_POST',
	'TOPIC_POSTER_GUEST',
	'TOPIC_QUICKREPLY'
	);

// Forum permission changes	

// File permission changes

// Queries to run
$queries[] = "DELETE FROM %preplacements WHERE replacement_type = 'emoticon'";
$queries[] = "ALTER TABLE %preplacements DROP replacement_replace";
$queries[] = "ALTER TABLE %preplacements DROP replacement_type";
$queries[] = "ALTER TABLE %preplacements DROP replacement_clickable";
$queries[] = "DELETE FROM %ptemplates WHERE template_set = 'emot_control'";
$queries[] = "DELETE FROM %ptemplates WHERE template_name = 'POST_CLICKABLE_SMILIES'";
?>