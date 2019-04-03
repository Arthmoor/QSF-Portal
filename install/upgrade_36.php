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
 * https://github.com/Arthmoor/Quicksilver-Forums
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

// Upgrade from QSF Portal 1.5 to QSF Portal 1.5.1

// Template changes - Don't forget to enclose them inside single quotes!!!
$need_templates = array(
	// Added templates
	'SPAM_CLEARALL',
	'SPAM_LIST',
	'SPAM_LIST_ENTRY',
	'STAT_SPAM',
	// Changed templates
	'ADMIN_COPYRIGHT',
	'ADMIN_EDIT_BOARD_SETTINGS',
	'ADMIN_INDEX',
	'CP_AVATAR',
	'FILE_CATEGORY',
	'FILE_CATITEM',
	'FILE_DETAILS',
	'FILE_EDIT',
	'FILE_RECENT',
	'FILE_UPDATE',
	'FILE_UPLOAD',
	'MAIN',
	'MAIN_COPYRIGHT',
	'MAIN_HEADER_MEMBER',
	'MAIN_NEWS_ITEM',
	'MAIN_STATS',
	'MAIN_USERS',
	'MEMBERS_MEMBER',
	'NEWS_COMMENT',
	'NEWS_POST',
	'PROFILE_MAIN',
	'TOPIC_POST',
	'TOPIC_POSTER_MEMBER'
	);

// New settings
$this->sets['file_approval'] = 0;
$this->sets['akismet_sigs'] = 0;
$this->sets['akismet_posts'] = 0;
$this->sets['akismet_posts_number'] = 5;
$this->sets['spam_post_count'] = 0;
$this->sets['spam_email_count'] = 0;
$this->sets['spam_reg_count'] = 0;
$this->sets['spam_sig_count'] = 0;
$this->sets['ham_count'] = 0;
$this->sets['spam_false_count'] = 0;
$this->sets['spam_pending'] = 0;

// Deleted settings
unset($this->sets['optional_modules']);
unset($this->sets['clickable_per_row']);
unset($this->sets['output_buffer']);
unset($this->sets['flash_avs']);

// Forum permission changes	

// File permission changes

// Queries to run
$queries[] = "ALTER TABLE %pfiles ADD file_fileversion varchar(10) NOT NULL default '' AFTER file_filename";
$queries[] = "ALTER TABLE %pupdates ADD update_fileversion varchar(10) NOT NULL default '' AFTER update_name";
$queries[] = "ALTER TABLE %ptopics ADD topic_type smallint(2) NOT NULL default '1' AFTER topic_id";
$queries[] = "UPDATE %ptopics SET topic_type=1";
$queries[] = "ALTER TABLE %ptopics MODIFY topic_description varchar(75) NOT NULL default ''";
$queries[] = "ALTER TABLE %ptopics MODIFY topic_replies int(10) unsigned NOT NULL default '0'";
$queries[] = "ALTER TABLE %ptopics MODIFY topic_views int(10) unsigned NOT NULL default '0'";
$queries[] = "ALTER TABLE %pposts ADD post_referrer tinytext";
$queries[] = "ALTER TABLE %pposts ADD post_agent tinytext";
$queries[] = "ALTER TABLE %psettings ADD settings_meta_keywords tinytext AFTER settings_tos_files";
$queries[] = "ALTER TABLE %psettings ADD settings_meta_description tinytext AFTER settings_meta_keywords";

$queries[] = "DROP TABLE IF EXISTS %pspam";
$queries[] = "CREATE TABLE %pspam (
  spam_id int(12) unsigned NOT NULL auto_increment,
  spam_topic int(10) unsigned NOT NULL default '0',
  spam_author int(10) unsigned NOT NULL default '0',
  spam_emoticons tinyint(1) unsigned NOT NULL default '1',
  spam_mbcode tinyint(1) unsigned NOT NULL default '1',
  spam_count tinyint(1) unsigned NOT NULL default '1',
  spam_text text NOT NULL default '',
  spam_time int(10) unsigned NOT NULL default '0',
  spam_icon varchar(32) NOT NULL default '',
  spam_ip INT UNSIGNED NOT NULL default '0',
  spam_edited_by varchar(32) NOT NULL default '',
  spam_edited_time int(10) unsigned NOT NULL default '0',
  spam_svars text,
  PRIMARY KEY  (spam_id),
  KEY Topic (spam_topic),
  FULLTEXT KEY spam_text (spam_text)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";
?>