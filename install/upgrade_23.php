<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005-2006 The Quicksilver Forums Development Team
 *  http://www.quicksilverforums.com/
 * 
 * based off MercuryBoard
 * Copyright (c) 2001-2005 The Mercury Development Team
 *  http://www.mercuryboard.com/
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

// Upgrade from QSF 1.3.1 to QSF Portal 1.3.1

// Template changes
$need_templates = array(
	// Added templates
	'FILE_CATS',
	'FILE_CATEGORY',
	'FILE_CATITEM',
	'FILE_CATLINK',
	'FILE_SEARCH',
	'FILES_SEARCHRESULT',
	'FILE_UPDATE',
	'FILE_DENY',
	'FILE_DETAILS',
	'FILE_UPLOAD',
	'FILE_DELETE',
	'FILE_EDIT',
	'FILE_COMMENT_ADD',
	'FILE_COMMENT_LIST',
	'FILE_COMMENT',
	'FILE_APPROVAL',
	'FILES_MAIN',
	'FILE_RATING',
	'FILE_RECENT',
	'MAIN_NEWS_ITEM',
	'MAIN_PORTAL',
	'MAIN_USERS',
	'MAIN_STATS',
	'MAIN_AFFILIATES',
	'MAIN_RECENT_POSTS',
	'MAIN_RECENT_UPLOADS',
	'MAIN_TOP_POSTERS',
	'MAIN_TOP_UPLOADERS',
	'MAIN_USER_LOGIN',
	'PAGE_CREATE',
	'PAGE_EDIT',
	'PAGE_ENTRY',
	'PAGE_LIST',
	'PAGE_PAGE',
	'PAGE_NONE',
	'PROFILE_UPLOADS',
	// Changed templates
	'ADMIN_INDEX',
	'ADMIN_COPYRIGHT',
	'MAIN',
	'MAIN_COPYRIGHT',
	'MAIN_HEADER_GUEST',
	'MAIN_HEADER_MEMBER',
	'BOARD_MAIN',
	'BOARD_CATEGORY',
	'FORUM_MAIN',
	'TOPIC_MAIN',
	'PROFILE_MAIN'
	);

// Forum permission changes	
$new_permissions['page_create'] = false;
$new_permissions['page_delete'] = false;
$new_permissions['page_edit'] = false;

// Queries to run
$queries[] = "ALTER TABLE %pusers ADD user_uploads int(10) unsigned NOT NULL DEFAULT '0' AFTER user_posts";

$queries[] = "DROP TABLE IF EXISTS %pfile_categories";
$queries[] = "CREATE TABLE %pfile_categories (
  fcat_id int(10) unsigned NOT NULL auto_increment,
  fcat_parent int(10) unsigned NOT NULL default '0',
  fcat_moderator int(10) unsigned default '0',
  fcat_count int(10) unsigned NOT NULL default '0',
  fcat_restricted tinyint(1) unsigned NOT NULL default '0',
  fcat_name varchar(32) NOT NULL default '',
  fcat_tree varchar(255) NOT NULL default '',
  fcat_longpath varchar(255) NOT NULL default '',
  PRIMARY KEY  (fcat_id)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pfilecomments";
$queries[] = "CREATE TABLE %pfilecomments (
  comment_id int(10) unsigned NOT NULL auto_increment,
  file_id int(10) unsigned NOT NULL default '0',
  user_id int(10) unsigned NOT NULL default '0',
  comment_date int(10) unsigned NOT NULL default '0',
  comment_text text NOT NULL default '',
  PRIMARY KEY  (comment_id)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pfileratings";
$queries[] = "CREATE TABLE %pfileratings (
  file_id int(10) unsigned NOT NULL default '0',
  user_id int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (file_id,user_id)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pfiles";
$queries[] = "CREATE TABLE %pfiles (
  file_id int(12) unsigned NOT NULL auto_increment,
  file_catid int(10) unsigned NOT NULL default '0',
  file_submitted int(10) unsigned NOT NULL default '0',
  file_author varchar(20) NOT NULL default '',
  file_name varchar(32) NOT NULL default '',
  file_filename varchar(255) NOT NULL default '',
  file_md5name varchar(32) NOT NULL default '',
  file_size int(10) unsigned NOT NULL default '0',
  file_date int(10) unsigned NOT NULL default '0',
  file_downloads int(10) unsigned NOT NULL default '0',
  file_rating_votes int(10) unsigned default '0',
  file_rating_total int(10) unsigned default '0',
  file_rating tinyint(1) unsigned default '0',
  file_comments int(10) unsigned default '0',
  file_approved tinyint(1) unsigned NOT NULL default '0',
  file_revision int(10) unsigned NOT NULL default '0',
  file_revdate int(10) unsigned default '0',
  file_description text NOT NULL default '',
  PRIMARY KEY  (file_id)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pupdates";
$queries[] = "CREATE TABLE %pupdates (
  update_id int(10) unsigned NOT NULL auto_increment,
  update_name varchar(32) NOT NULL default '',
  update_updating int(10) unsigned default NULL,
  update_description text NOT NULL,
  update_md5name varchar(32) default NULL,
  update_date int(10) unsigned default NULL,
  update_size int(8) unsigned default NULL,
  update_updater int(10) unsigned default NULL,
  PRIMARY KEY  (update_id)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %ppages";
$queries[] = "CREATE TABLE %ppages (
  page_id int(11) unsigned NOT NULL auto_increment,
  page_title varchar(255) NOT NULL default '',
  page_contents text NOT NULL default '',
  PRIMARY KEY  (page_id)
) TYPE=MyISAM";

$this->sets['file_count'] = 0;
$this->sets['code_approval'] = 0;

// New Timezones

?>
