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

// Upgrade from QSF Portal 1.5.1 to QSF Portal 1.5.2

// Template changes - Don't forget to enclose them inside single quotes!!!
$need_templates = array(
	// Added templates
	'ADMIN_ADD_CAPTCHA',
	'ADMIN_CAPTCHA_DISPLAY',
	'ADMIN_CAPTCHA_PAIR',
	'ADMIN_DELETE_CAPTCHA',
	'ADMIN_EDIT_CAPTCHA',
	'ADMIN_MEMBER_SPAMBOT',
	// Changed templates
	'ADMIN_COPYRIGHT',
	'ADMIN_EDIT_BOARD_SETTINGS',
	'ADMIN_HOME',
	'ADMIN_MEMBER_PROFILE',
	'CP_AVATAR',
	'CP_PROFILE',
	'FILE_APPROVAL',
	'FILE_CATEGORY',
	'FILE_CATITEM',
	'FILE_DETAILS',
	'FILE_EDIT',
	'FILE_RATING',
	'FILE_RECENT',
	'FILE_UPLOAD',
	'FILES_SEARCHRESULT',
	'HELP_DESCRIPTIVE_ENTRY',
	'HELP_FULL',
	'HELP_SIMPLE_ENTRY',
	'MAIN_COPYRIGHT',
	'TOPIC_POSTER_MEMBER',
	'PM_FOLDER',
	'PROFILE_MAIN',
	'STAT_SPAM'
	);

// New settings
$this->sets['akismet_profiles'] = 0;
$this->sets['spam_profile_count'] = 0;

// Deleted settings

// Forum permission changes	

// File permission changes

// Queries to run
$queries[] = "ALTER TABLE %pusers CHANGE user_avatar_type user_avatar_type enum('local','url','uploaded','gravatar','none') NOT NULL default 'none'";
$queries[] = "ALTER TABLE %pfiles CHANGE file_name file_name varchar(50) NOT NULL default ''";
$queries[] = "ALTER TABLE %pusers CHANGE user_gtalk user_twitter varchar(50) NOT NULL default ''";
$queries[] = "UPDATE %pusers SET user_twitter=''";

$queries[] = "DROP TABLE IF EXISTS %pcaptcha";
$queries[] = "CREATE TABLE %pcaptcha (
  cap_id int(10) unsigned NOT NULL auto_increment,
  cap_question text NOT NULL default '',
  cap_answer text NOT NULL default '',
  PRIMARY KEY (cap_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$queries[] = "DROP TABLE IF EXISTS %pconversations";
$queries[] = "CREATE TABLE %pconversations (
  conv_id int(10) unsigned NOT NULL auto_increment,
  conv_title varchar(75) NOT NULL default '0',
  conv_description varchar(75) NOT NULL default '',
  conv_starter int(10) unsigned NOT NULL default '0',
  conv_last_post int(10) unsigned NOT NULL default '0',
  conv_last_poster int(10) unsigned NOT NULL default '0',
  conv_icon varchar(32) NOT NULL default '',
  conv_posted int(10) unsigned NOT NULL default '0',
  conv_edited int(10) unsigned NOT NULL default '0',
  conv_replies smallint(5) unsigned NOT NULL default '0',
  conv_views smallint(5) unsigned NOT NULL default '0',
  conv_users varchar(255) NOT NULL default '',
  PRIMARY KEY  (conv_id),
  KEY User (conv_starter)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

// Nice mess we made here! Time to clean it up. IPv6 support will be possible once this is done.
$db->query( 'ALTER TABLE %pactive CHANGE active_ip active_ip varchar(40) NOT NULL' );

$db->query( 'ALTER TABLE %ppmsystem CHANGE pm_ip pm_ip varchar(40) NOT NULL' );
$query = $db->query( 'SELECT pm_id, INET_NTOA(pm_ip) as pm_ip FROM %ppmsystem' );
while( $row = $db->nqfetch($query) )
{
	$db->query( "UPDATE %ppmsystem SET pm_ip='%s' WHERE pm_id=%d", $row['pm_ip'], $row['pm_id'] );
}

$db->query( 'ALTER TABLE %pposts CHANGE post_ip post_ip varchar(40) NOT NULL' );
$query = $db->query( 'SELECT post_id, INET_NTOA(post_ip) as post_ip FROM %pposts' );
while( $row = $db->nqfetch($query) )
{
	$db->query( "UPDATE %pposts SET post_ip='%s' WHERE post_id=%d", $row['post_ip'], $row['post_id'] );
}

$db->query( 'ALTER TABLE %pspam CHANGE spam_ip spam_ip varchar(40) NOT NULL' );
$query = $db->query( 'SELECT spam_id, INET_NTOA(spam_ip) as spam_ip FROM %pspam' );
while( $row = $db->nqfetch($query) )
{
	$db->query( "UPDATE %pspam SET spam_ip='%s' WHERE spam_id=%d", $row['spam_ip'], $row['spam_id'] );
}

$db->query( 'ALTER TABLE %pusers CHANGE user_regip user_regip varchar(40) NOT NULL' );
$query = $db->query( 'SELECT user_id, INET_NTOA(user_regip) as user_regip FROM %pusers' );
while( $row = $db->nqfetch($query) )
{
	$db->query( "UPDATE %pusers SET user_regip='%s' WHERE user_id=%d", $row['user_regip'], $row['user_id'] );
}
?>