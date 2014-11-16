<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005 The Quicksilver Forums Development Team
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
	exit('Use index.php to install.');
}

$queries[] = "DROP TABLE IF EXISTS %pactive";
$queries[] = "CREATE TABLE %pactive (
  active_id int(10) unsigned NOT NULL default '0',
  active_ip INT UNSIGNED NOT NULL default '0',
  active_user_agent varchar(100) NOT NULL default 'Unknown',
  active_action varchar(32) NOT NULL default '',
  active_item int(10) unsigned NOT NULL default '0',
  active_time int(10) unsigned NOT NULL default '0',
  active_session varchar(32) NOT NULL default '',
  UNIQUE KEY active_session (active_session),
  UNIQUE KEY active_ip (active_ip)
) TYPE=MyISAM ROW_FORMAT=FIXED";

$queries[] = "DROP TABLE IF EXISTS %pattach";
$queries[] = "CREATE TABLE %pattach (
  attach_id int(12) unsigned NOT NULL auto_increment,
  attach_file varchar(32) NOT NULL default '',
  attach_name varchar(255) NOT NULL default '',
  attach_post int(12) unsigned NOT NULL default '0',
  attach_downloads int(10) unsigned NOT NULL default '0',
  attach_size int(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (attach_id),
  KEY attach_post (attach_post)
) TYPE=MyISAM ROW_FORMAT=FIXED";

$queries[] = "DROP TABLE IF EXISTS %pfile_categories";
$queries[] = "CREATE TABLE %pfile_categories (
  fcat_id int(10) unsigned NOT NULL auto_increment,
  fcat_parent int(10) unsigned NOT NULL default '0',
  fcat_moderator int(10) unsigned default '0',
  fcat_count int(10) unsigned NOT NULL default '0',
  fcat_name varchar(32) NOT NULL default '',
  fcat_description varchar(255) NOT NULL default '',
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

$queries[] = "DROP TABLE IF EXISTS %pforums";
$queries[] = "CREATE TABLE %pforums (
  forum_id smallint(4) unsigned NOT NULL auto_increment,
  forum_parent smallint(4) unsigned NOT NULL default '0',
  forum_tree varchar(255) NOT NULL default '',
  forum_name varchar(255) NOT NULL default '',
  forum_position smallint(4) unsigned NOT NULL default '0',
  forum_description varchar(255) NOT NULL default '',
  forum_topics int(10) unsigned NOT NULL default '0',
  forum_replies int(12) unsigned NOT NULL default '0',
  forum_lastpost int(12) unsigned NOT NULL default '0',
  forum_subcat tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (forum_id),
  KEY Parent (forum_parent)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pgroups";
$queries[] = "CREATE TABLE %pgroups (
  group_id tinyint(3) unsigned NOT NULL auto_increment,
  group_name varchar(255) NOT NULL default '',
  group_type varchar(20) NOT NULL default '',
  group_format varchar(255) NOT NULL default '%%s',
  group_perms text NOT NULL default '',
  group_file_perms text NOT NULL default '',
  PRIMARY KEY  (group_id)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %phelp";
$queries[] = "CREATE TABLE %phelp (
  help_id smallint(3) NOT NULL auto_increment,
  help_title varchar(255) NOT NULL default '',
  help_article text NOT NULL default '',
  PRIMARY KEY  (help_id)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %plogs";
$queries[] = "CREATE TABLE %plogs (
  log_id int(10) unsigned NOT NULL auto_increment,
  log_user int(10) unsigned NOT NULL default '0',
  log_time int(10) unsigned NOT NULL default '0',
  log_action varchar(20) NOT NULL default '',
  log_data1 int(12) unsigned NOT NULL default '0',
  log_data2 smallint(4) unsigned NOT NULL default '0',
  log_data3 smallint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (log_id)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pmembertitles";
$queries[] = "CREATE TABLE %pmembertitles (
  membertitle_id tinyint(3) unsigned NOT NULL auto_increment,
  membertitle_title varchar(50) NOT NULL default '',
  membertitle_posts int(10) unsigned NOT NULL default '0',
  membertitle_icon varchar(25) NOT NULL default '',
  PRIMARY KEY  (membertitle_id),
  KEY Posts (membertitle_posts)
) TYPE=MyISAM ROW_FORMAT=FIXED";

$queries[] = "DROP TABLE IF EXISTS %ppages";
$queries[] = "CREATE TABLE %ppages (
  page_id int(11) unsigned NOT NULL auto_increment,
  page_title varchar(255) NOT NULL default '',
  page_contents text NOT NULL default '',
  PRIMARY KEY  (page_id)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %ppmsystem";
$queries[] = "CREATE TABLE %ppmsystem (
  pm_id int(10) unsigned NOT NULL auto_increment,
  pm_to int(10) unsigned NOT NULL default '0',
  pm_from int(10) unsigned NOT NULL default '0',
  pm_ip INT UNSIGNED NOT NULL default '0',
  pm_bcc text NOT NULL default '',
  pm_title varchar(255) NOT NULL default '[No Title]',
  pm_time int(10) unsigned NOT NULL default '0',
  pm_message text NOT NULL default '',
  pm_read tinyint(1) unsigned NOT NULL default '0',
  pm_folder tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (pm_id),
  KEY NewPMs (pm_to,pm_read,pm_folder)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pposts";
$queries[] = "CREATE TABLE %pposts (
  post_id int(12) unsigned NOT NULL auto_increment,
  post_topic int(10) unsigned NOT NULL default '0',
  post_author int(10) unsigned NOT NULL default '0',
  post_emoticons tinyint(1) unsigned NOT NULL default '1',
  post_mbcode tinyint(1) unsigned NOT NULL default '1',
  post_count tinyint(1) unsigned NOT NULL default '1',
  post_text text NOT NULL default '',
  post_time int(10) unsigned NOT NULL default '0',
  post_icon varchar(32) NOT NULL default '',
  post_ip INT UNSIGNED NOT NULL default '0',
  post_edited_by varchar(32) NOT NULL default '',
  post_edited_time int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (post_id),
  KEY Topic (post_topic),
  FULLTEXT KEY post_text (post_text)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %preadmarks";
$queries[] = "CREATE TABLE %preadmarks (
  readmark_user int(10) unsigned NOT NULL default '0',
  readmark_topic int(10) unsigned NOT NULL default '0',
  readmark_lastread int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (readmark_user,readmark_topic)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %preplacements";
$queries[] = "CREATE TABLE %preplacements (
  replacement_id smallint(3) unsigned NOT NULL auto_increment,
  replacement_search varchar(50) NOT NULL default '',
  replacement_replace varchar(50) NOT NULL default '',
  replacement_type varchar(15) NOT NULL default '',
  replacement_clickable tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (replacement_id),
  KEY `Type` (replacement_type)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %psettings";
$queries[] = "CREATE TABLE %psettings (
  settings_id tinyint(2) unsigned NOT NULL auto_increment,
  settings_tos text NOT NULL default '',
  settings_data text NOT NULL default '',
  PRIMARY KEY  (settings_id)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pskins";
$queries[] = "CREATE TABLE %pskins (
  skin_name varchar(32) NOT NULL default '',
  skin_dir varchar(32) NOT NULL default '',
  PRIMARY KEY  (skin_dir)
) TYPE=MyISAM ROW_FORMAT=FIXED";

$queries[] = "DROP TABLE IF EXISTS %psubscriptions";
$queries[] = "CREATE TABLE %psubscriptions (
  subscription_id int(12) unsigned NOT NULL auto_increment,
  subscription_user int(10) unsigned NOT NULL default '0',
  subscription_type varchar(10) NOT NULL default '',
  subscription_item int(10) unsigned NOT NULL default '0',
  subscription_expire int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (subscription_id),
  KEY subscription_item (subscription_item)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %ptemplates";
$queries[] = "CREATE TABLE %ptemplates (
  template_skin varchar(32) NOT NULL default 'default',
  template_set varchar(20) NOT NULL default '',
  template_name varchar(36) NOT NULL default '',
  template_html text NOT NULL default '',
  template_displayname varchar(255) NOT NULL default '',
  template_description varchar(255) NOT NULL default '',
  UNIQUE KEY Piece (template_name,template_skin),
  KEY Section (template_set,template_skin)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %ptimezones";
$queries[] = "CREATE TABLE %ptimezones (
  zone_id smallint(3) unsigned NOT NULL auto_increment,
  zone_name varchar(30) NOT NULL default '',
  zone_abbrev varchar(6) NOT NULL default 'N/A',
  zone_offset int(15) NOT NULL default '0',
  zone_updated int(15) unsigned NOT NULL default '0',
  PRIMARY KEY  (zone_id),
  KEY name (zone_name)
) TYPE=MyISAM AUTO_INCREMENT=388 ROW_FORMAT=FIXED";

$queries[] = "DROP TABLE IF EXISTS %ptopics";
$queries[] = "CREATE TABLE %ptopics (
  topic_id int(10) unsigned NOT NULL auto_increment,
  topic_forum smallint(3) unsigned NOT NULL default '0',
  topic_title varchar(75) NOT NULL default '0',
  topic_description varchar(35) NOT NULL default '',
  topic_starter int(10) unsigned NOT NULL default '0',
  topic_last_post int(10) unsigned NOT NULL default '0',
  topic_last_poster int(10) unsigned NOT NULL default '0',
  topic_icon varchar(32) NOT NULL default '',
  topic_posted int(10) unsigned NOT NULL default '0',
  topic_edited int(10) unsigned NOT NULL default '0',
  topic_replies smallint(5) unsigned NOT NULL default '0',
  topic_views smallint(5) unsigned NOT NULL default '0',
  topic_modes int(10) unsigned NOT NULL default '0',
  topic_moved smallint(3) unsigned NOT NULL default '0',
  topic_poll_options text NOT NULL default '',
  PRIMARY KEY  (topic_id),
  KEY Forum (topic_forum)
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

$queries[] = "DROP TABLE IF EXISTS %pusers";
$queries[] = "CREATE TABLE %pusers (
  user_id int(10) unsigned NOT NULL auto_increment,
  user_name varchar(255) NOT NULL default '',
  user_password varchar(32) NOT NULL default '',
  user_joined int(10) unsigned NOT NULL default '0',
  user_level tinyint(3) unsigned NOT NULL default '1',
  user_title varchar(100) NOT NULL default '',
  user_title_custom tinyint(1) unsigned NOT NULL default '0',
  user_group tinyint(3) unsigned NOT NULL default '2',
  user_skin varchar(32) NOT NULL default 'default',
  user_language varchar(6) NOT NULL default 'en',
  user_avatar varchar(150) NOT NULL default '',
  user_avatar_type enum('local','url','uploaded','none') NOT NULL default 'none',
  user_avatar_width smallint(3) unsigned NOT NULL default '0',
  user_avatar_height smallint(3) unsigned NOT NULL default '0',
  user_email varchar(100) NOT NULL default '',
  user_email_show tinyint(1) unsigned NOT NULL default '0',
  user_email_form tinyint(1) unsigned NOT NULL default '1',
  user_birthday date NOT NULL default '0000-00-00',
  user_timezone smallint(3) NOT NULL default '151',
  user_homepage varchar(255) NOT NULL default '',
  user_posts int(10) unsigned NOT NULL default '0',
  user_uploads int(10) unsigned NOT NULL default '0',
  user_location varchar(100) NOT NULL default '',
  user_icq int(16) unsigned NOT NULL default '0',
  user_msn varchar(32) NOT NULL default '',
  user_aim varchar(32) NOT NULL default '',
  user_gtalk varchar(32) NOT NULL default '',
  user_pm tinyint(1) unsigned NOT NULL default '1',
  user_pm_mail tinyint(1) unsigned NOT NULL default '0',
  user_active tinyint(1) unsigned NOT NULL default '1',
  user_yahoo varchar(100) NOT NULL default '',
  user_interests varchar(255) NOT NULL default '',
  user_signature text NOT NULL default '',
  user_lastvisit int(10) unsigned NOT NULL default '0',
  user_lastallread int(10) unsigned NOT NULL default '0',
  user_lastpost int(10) unsigned NOT NULL default '0',
  user_lastpm int(10) unsigned NOT NULL default '0',
  user_lastsearch int(10) unsigned NOT NULL default '0',
  user_view_avatars tinyint(1) unsigned NOT NULL default '1',
  user_view_signatures tinyint(1) unsigned NOT NULL default '1',
  user_view_emoticons tinyint(1) unsigned NOT NULL default '1',
  user_topics_page tinyint(2) unsigned NOT NULL DEFAULT '0',
  user_posts_page tinyint(2) unsigned NOT NULL DEFAULT '0',
  user_perms text NOT NULL default '',
  user_file_perms text NOT NULL default '',
  PRIMARY KEY  (user_id)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pvotes";
$queries[] = "CREATE TABLE %pvotes (
  vote_user int(10) unsigned NOT NULL default '0',
  vote_topic int(10) unsigned NOT NULL default '0',
  vote_option smallint(4) NOT NULL default '-1',
  PRIMARY KEY  (vote_user,vote_topic)
) TYPE=MyISAM";

$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type, group_format, group_perms, group_file_perms) VALUES (1, 'Administrators', 'ADMIN', '<b>%%s</b>', 'a:49:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:1;s:11:\"do_anything\";b:1;s:11:\"edit_avatar\";b:1;s:12:\"edit_profile\";b:1;s:8:\"edit_sig\";b:1;s:9:\"email_use\";b:1;s:10:\"forum_view\";b:1;s:8:\"is_admin\";b:1;s:11:\"page_create\";b:1;s:11:\"page_delete\";b:1;s:9:\"page_edit\";b:1;s:10:\"pm_noflood\";b:1;s:11:\"poll_create\";b:1;s:9:\"poll_vote\";b:1;s:11:\"post_attach\";b:1;s:20:\"post_attach_download\";b:1;s:11:\"post_create\";b:1;s:11:\"post_delete\";b:1;s:15:\"post_delete_own\";b:1;s:9:\"post_edit\";b:1;s:13:\"post_edit_own\";b:1;s:18:\"post_inc_userposts\";b:1;s:12:\"post_noflood\";b:1;s:11:\"post_viewip\";b:1;s:14:\"search_noflood\";b:1;s:12:\"topic_create\";b:1;s:12:\"topic_delete\";b:1;s:16:\"topic_delete_own\";b:1;s:10:\"topic_edit\";b:1;s:14:\"topic_edit_own\";b:1;s:12:\"topic_global\";b:1;s:10:\"topic_lock\";b:1;s:14:\"topic_lock_own\";b:1;s:10:\"topic_move\";b:1;s:14:\"topic_move_own\";b:1;s:9:\"topic_pin\";b:1;s:13:\"topic_pin_own\";b:1;s:13:\"topic_publish\";b:1;s:18:\"topic_publish_auto\";b:1;s:11:\"topic_split\";b:1;s:15:\"topic_split_own\";b:1;s:12:\"topic_unlock\";b:1;s:16:\"topic_unlock_mod\";b:1;s:16:\"topic_unlock_own\";b:1;s:11:\"topic_unpin\";b:1;s:15:\"topic_unpin_own\";b:1;s:10:\"topic_view\";b:1;s:22:\"topic_view_unpublished\";b:1;}', 'a:11:{s:12:\"add_category\";b:1;s:13:\"approve_files\";b:1;s:13:\"category_view\";b:1;s:15:\"delete_category\";b:1;s:12:\"delete_files\";b:1;s:14:\"download_files\";b:1;s:13:\"edit_category\";b:1;s:10:\"edit_files\";b:1;s:10:\"move_files\";b:1;s:12:\"post_comment\";b:1;s:12:\"upload_files\";b:1;}')";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type, group_format, group_perms, group_file_perms) VALUES (2, 'Members', 'MEMBER', '%%s', 'a:49:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:1;s:11:\"edit_avatar\";b:1;s:12:\"edit_profile\";b:1;s:8:\"edit_sig\";b:1;s:9:\"email_use\";b:1;s:10:\"forum_view\";b:1;s:8:\"is_admin\";b:0;s:11:\"page_create\";b:0;s:11:\"page_delete\";b:0;s:9:\"page_edit\";b:0;s:10:\"pm_noflood\";b:0;s:11:\"poll_create\";b:1;s:9:\"poll_vote\";b:1;s:11:\"post_attach\";b:0;s:20:\"post_attach_download\";b:1;s:11:\"post_create\";b:1;s:11:\"post_delete\";b:0;s:15:\"post_delete_own\";b:1;s:9:\"post_edit\";b:0;s:13:\"post_edit_own\";b:1;s:18:\"post_inc_userposts\";b:1;s:12:\"post_noflood\";b:0;s:11:\"post_viewip\";b:0;s:14:\"search_noflood\";b:0;s:12:\"topic_create\";b:1;s:12:\"topic_delete\";b:0;s:16:\"topic_delete_own\";b:1;s:10:\"topic_edit\";b:0;s:14:\"topic_edit_own\";b:1;s:12:\"topic_global\";b:0;s:10:\"topic_lock\";b:0;s:14:\"topic_lock_own\";b:0;s:10:\"topic_move\";b:0;s:14:\"topic_move_own\";b:0;s:9:\"topic_pin\";b:0;s:13:\"topic_pin_own\";b:0;s:13:\"topic_publish\";b:0;s:18:\"topic_publish_auto\";b:1;s:11:\"topic_split\";b:0;s:15:\"topic_split_own\";b:0;s:12:\"topic_unlock\";b:0;s:16:\"topic_unlock_mod\";b:0;s:16:\"topic_unlock_own\";b:0;s:11:\"topic_unpin\";b:0;s:15:\"topic_unpin_own\";b:0;s:10:\"topic_view\";b:1;s:22:\"topic_view_unpublished\";b:0;}', 'a:11:{s:12:\"add_category\";b:0;s:13:\"approve_files\";b:0;s:13:\"category_view\";b:1;s:15:\"delete_category\";b:0;s:12:\"delete_files\";b:0;s:14:\"download_files\";b:1;s:13:\"edit_category\";b:0;s:10:\"edit_files\";b:0;s:10:\"move_files\";b:0;s:12:\"post_comment\";b:1;s:12:\"upload_files\";b:1;}')";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type, group_format, group_perms, group_file_perms) VALUES (3, 'Guests', 'GUEST', '%%s', 'a:49:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:1;s:11:\"edit_avatar\";b:0;s:12:\"edit_profile\";b:0;s:8:\"edit_sig\";b:0;s:9:\"email_use\";b:0;s:10:\"forum_view\";b:1;s:8:\"is_admin\";b:0;s:11:\"page_create\";b:0;s:11:\"page_delete\";b:0;s:9:\"page_edit\";b:0;s:10:\"pm_noflood\";b:0;s:11:\"poll_create\";b:0;s:9:\"poll_vote\";b:0;s:11:\"post_attach\";b:0;s:20:\"post_attach_download\";b:0;s:11:\"post_create\";b:0;s:11:\"post_delete\";b:0;s:15:\"post_delete_own\";b:0;s:9:\"post_edit\";b:0;s:13:\"post_edit_own\";b:0;s:18:\"post_inc_userposts\";b:0;s:12:\"post_noflood\";b:0;s:11:\"post_viewip\";b:0;s:14:\"search_noflood\";b:0;s:12:\"topic_create\";b:0;s:12:\"topic_delete\";b:0;s:16:\"topic_delete_own\";b:0;s:10:\"topic_edit\";b:0;s:14:\"topic_edit_own\";b:0;s:12:\"topic_global\";b:0;s:10:\"topic_lock\";b:0;s:14:\"topic_lock_own\";b:0;s:10:\"topic_move\";b:0;s:14:\"topic_move_own\";b:0;s:9:\"topic_pin\";b:0;s:13:\"topic_pin_own\";b:0;s:13:\"topic_publish\";b:0;s:18:\"topic_publish_auto\";b:0;s:11:\"topic_split\";b:0;s:15:\"topic_split_own\";b:0;s:12:\"topic_unlock\";b:0;s:16:\"topic_unlock_mod\";b:0;s:16:\"topic_unlock_own\";b:0;s:11:\"topic_unpin\";b:0;s:15:\"topic_unpin_own\";b:0;s:10:\"topic_view\";b:1;s:22:\"topic_view_unpublished\";b:0;}', 'a:11:{s:12:\"add_category\";b:0;s:13:\"approve_files\";b:0;s:13:\"category_view\";b:1;s:15:\"delete_category\";b:0;s:12:\"delete_files\";b:0;s:14:\"download_files\";b:1;s:13:\"edit_category\";b:0;s:10:\"edit_files\";b:0;s:10:\"move_files\";b:0;s:12:\"post_comment\";b:0;s:12:\"upload_files\";b:0;}')";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type, group_format, group_perms, group_file_perms) VALUES (4, 'Banned', 'BANNED', '%%s', 'a:49:{s:10:\"board_view\";b:0;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:0;s:11:\"edit_avatar\";b:0;s:12:\"edit_profile\";b:0;s:8:\"edit_sig\";b:0;s:9:\"email_use\";b:0;s:10:\"forum_view\";b:0;s:8:\"is_admin\";b:0;s:11:\"page_create\";b:0;s:11:\"page_delete\";b:0;s:9:\"page_edit\";b:0;s:10:\"pm_noflood\";b:0;s:11:\"poll_create\";b:0;s:9:\"poll_vote\";b:0;s:11:\"post_attach\";b:0;s:20:\"post_attach_download\";b:0;s:11:\"post_create\";b:0;s:11:\"post_delete\";b:0;s:15:\"post_delete_own\";b:0;s:9:\"post_edit\";b:0;s:13:\"post_edit_own\";b:0;s:18:\"post_inc_userposts\";b:0;s:12:\"post_noflood\";b:0;s:11:\"post_viewip\";b:0;s:14:\"search_noflood\";b:0;s:12:\"topic_create\";b:0;s:12:\"topic_delete\";b:0;s:16:\"topic_delete_own\";b:0;s:10:\"topic_edit\";b:0;s:14:\"topic_edit_own\";b:0;s:12:\"topic_global\";b:0;s:10:\"topic_lock\";b:0;s:14:\"topic_lock_own\";b:0;s:10:\"topic_move\";b:0;s:14:\"topic_move_own\";b:0;s:9:\"topic_pin\";b:0;s:13:\"topic_pin_own\";b:0;s:13:\"topic_publish\";b:0;s:18:\"topic_publish_auto\";b:0;s:11:\"topic_split\";b:0;s:15:\"topic_split_own\";b:0;s:12:\"topic_unlock\";b:0;s:16:\"topic_unlock_mod\";b:0;s:16:\"topic_unlock_own\";b:0;s:11:\"topic_unpin\";b:0;s:15:\"topic_unpin_own\";b:0;s:10:\"topic_view\";b:0;s:22:\"topic_view_unpublished\";b:0;}', 'a:11:{s:12:\"add_category\";b:0;s:13:\"approve_files\";b:0;s:13:\"category_view\";b:0;s:15:\"delete_category\";b:0;s:12:\"delete_files\";b:0;s:14:\"download_files\";b:0;s:13:\"edit_category\";b:0;s:10:\"edit_files\";b:0;s:10:\"move_files\";b:0;s:12:\"post_comment\";b:0;s:12:\"upload_files\";b:0;}')";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type, group_format, group_perms, group_file_perms) VALUES (5, 'Awaiting Activation', 'AWAIT', '%%s', 'a:49:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:1;s:11:\"edit_avatar\";b:1;s:12:\"edit_profile\";b:1;s:8:\"edit_sig\";b:1;s:9:\"email_use\";b:0;s:10:\"forum_view\";b:1;s:8:\"is_admin\";b:0;s:11:\"page_create\";b:0;s:11:\"page_delete\";b:0;s:9:\"page_edit\";b:0;s:10:\"pm_noflood\";b:0;s:11:\"poll_create\";b:0;s:9:\"poll_vote\";b:0;s:11:\"post_attach\";b:0;s:20:\"post_attach_download\";b:0;s:11:\"post_create\";b:0;s:11:\"post_delete\";b:0;s:15:\"post_delete_own\";b:0;s:9:\"post_edit\";b:0;s:13:\"post_edit_own\";b:0;s:18:\"post_inc_userposts\";b:0;s:12:\"post_noflood\";b:0;s:11:\"post_viewip\";b:0;s:14:\"search_noflood\";b:0;s:12:\"topic_create\";b:0;s:12:\"topic_delete\";b:0;s:16:\"topic_delete_own\";b:0;s:10:\"topic_edit\";b:0;s:14:\"topic_edit_own\";b:0;s:12:\"topic_global\";b:0;s:10:\"topic_lock\";b:0;s:14:\"topic_lock_own\";b:0;s:10:\"topic_move\";b:0;s:14:\"topic_move_own\";b:0;s:9:\"topic_pin\";b:0;s:13:\"topic_pin_own\";b:0;s:13:\"topic_publish\";b:0;s:18:\"topic_publish_auto\";b:0;s:11:\"topic_split\";b:0;s:15:\"topic_split_own\";b:0;s:12:\"topic_unlock\";b:0;s:16:\"topic_unlock_mod\";b:0;s:16:\"topic_unlock_own\";b:0;s:11:\"topic_unpin\";b:0;s:15:\"topic_unpin_own\";b:0;s:10:\"topic_view\";b:1;s:22:\"topic_view_unpublished\";b:0;}', 'a:11:{s:12:\"add_category\";b:0;s:13:\"approve_files\";b:0;s:13:\"category_view\";b:1;s:15:\"delete_category\";b:0;s:12:\"delete_files\";b:0;s:14:\"download_files\";b:1;s:13:\"edit_category\";b:0;s:10:\"edit_files\";b:0;s:10:\"move_files\";b:0;s:12:\"post_comment\";b:0;s:12:\"upload_files\";b:0;}')";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type, group_format, group_perms, group_file_perms) VALUES (6, 'Moderators', 'MODS', '<b>%%s</b>', 'a:49:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:1;s:11:\"edit_avatar\";b:1;s:12:\"edit_profile\";b:1;s:8:\"edit_sig\";b:1;s:9:\"email_use\";b:1;s:10:\"forum_view\";b:1;s:8:\"is_admin\";b:0;s:11:\"page_create\";b:1;s:11:\"page_delete\";b:0;s:9:\"page_edit\";b:1;s:10:\"pm_noflood\";b:0;s:11:\"poll_create\";b:1;s:9:\"poll_vote\";b:1;s:11:\"post_attach\";b:1;s:20:\"post_attach_download\";b:1;s:11:\"post_create\";b:1;s:11:\"post_delete\";b:1;s:15:\"post_delete_own\";b:1;s:9:\"post_edit\";b:1;s:13:\"post_edit_own\";b:1;s:18:\"post_inc_userposts\";b:1;s:12:\"post_noflood\";b:0;s:11:\"post_viewip\";b:1;s:14:\"search_noflood\";b:0;s:12:\"topic_create\";b:1;s:12:\"topic_delete\";b:1;s:16:\"topic_delete_own\";b:1;s:10:\"topic_edit\";b:1;s:14:\"topic_edit_own\";b:1;s:12:\"topic_global\";b:1;s:10:\"topic_lock\";b:1;s:14:\"topic_lock_own\";b:1;s:10:\"topic_move\";b:1;s:14:\"topic_move_own\";b:1;s:9:\"topic_pin\";b:1;s:13:\"topic_pin_own\";b:1;s:13:\"topic_publish\";b:1;s:18:\"topic_publish_auto\";b:1;s:11:\"topic_split\";b:1;s:15:\"topic_split_own\";b:1;s:12:\"topic_unlock\";b:1;s:16:\"topic_unlock_mod\";b:1;s:16:\"topic_unlock_own\";b:1;s:11:\"topic_unpin\";b:1;s:15:\"topic_unpin_own\";b:1;s:10:\"topic_view\";b:1;s:22:\"topic_view_unpublished\";b:1;}', 'a:11:{s:12:\"add_category\";b:0;s:13:\"approve_files\";b:0;s:13:\"category_view\";b:1;s:15:\"delete_category\";b:0;s:12:\"delete_files\";b:0;s:14:\"download_files\";b:1;s:13:\"edit_category\";b:1;s:10:\"edit_files\";b:1;s:10:\"move_files\";b:1;s:12:\"post_comment\";b:1;s:12:\"upload_files\";b:1;}')";

$queries[] = "INSERT INTO %phelp (help_id, help_title, help_article) VALUES (1, 'What is MbCode and how do I use it?', '
MbCode is a way to format your posts without HTML.  You can use MbCode by pressing the buttons above the message text area, but here is a short help guide.
<hr />

<b>Bold</b><br />
[b]This text will be bold.[/b]<br />
Text enclosed in these tags will be <b>bold</b>.<br />
<hr />

<b>Italics</b><br />
[i]This text will be italicized.[/i]<br />
Text enclosed in these tags will be <i>italicized</i>.<br />
<hr />

<b>Underline</b><br />
[u]This text will be underlined.[/u]<br />
Text enclosed in these tags will be <span style=\'text-decoration:underline\'>underlined</span>.<br />
<hr />

<b>Strikethrough</b><br />
[s]This text will have a strike through it.[/s]<br />
Text enclosed in these tags will be <span style=\'text-decoration:line-through\'>crossed out</span>.<br />
<hr />

<b>PHP</b><br />
[php]Code here.[/php]<br />
The PHP tag allows you to add PHP code to your post. The code will show up with line numbers and syntax highlighting.<br />
<hr />

<b>Code</b><br />
[code]Code here.[/code]<br />
A more generic code tag than the PHP tag. You can add any type of code (such as HTML) or text into the tag and it will display exactly as you entered it.<br />
<hr />

<b>Quote</b><br />
[quote]Quote here.[/quote]<br />
Allows you to insert quoted text into a post.<br />
<hr />

<b>URL</b><br />[url=http://www.quicksilverforums.com]Quicksilver Forums[/url]<br />
Allows you to insert a link into a post. All you normally need to do to use this tag is add a URL and description into two popup prompts.<br />
<hr />

<b>Email</b><br />
[email=mb@example.com]Email me![/email]<br />
This allows you to insert a link to an email address into a post.<br />
<hr />

<b>Image</b><br />
[img]http://quicksilverforums.com/skins/default/logo.png[/img]<br />
This tag allows you to add an image into your post.<br />
<hr />

<b>Color</b><br />
[color=red]This text will be <span style=\'color:#ff0000\'>red</span>.[/color]<br />
Text enclosed in the color tag will be a color you specify. You can select the color using the drop-down list at the post screen.<br />
<hr />

<b>Size</b><br />
[size=3]This text will be <span style=\'font-size:16px\'>large</span>.[/size]<br />
This tag changes the font size of the text enclosed in this tag to a specified size.<br />
<hr />

<b>Font</b><br />
[font=Tahoma]This text will be <span style=\'font-family:Tahoma\'>Tahoma</span>.[/font]<br />
This allows you to change the font of text enclosed in this tag to a specified font.
')";

$queries[] = "INSERT INTO %phelp (help_id, help_title, help_article) VALUES (2, '
Why should I register?', 'Registration will allow you to use all of the features on this board.  Registration will allow you to customize your account, edit your profile, use the private messenger to contact other users, and may open up new posting rights and forums.<br /><br />

Registration is completely free and very fast.  Sometimes the administrator may require you to verify your account in an email, so be sure you provide a correct email address! <br /><br />

Once you are registered, you can start using the full features of the board.
')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (1, 'Newbie', 0, '1.png')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (2, 'Member', 25, '2.png')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (3, 'Droplet', 100, '3.png')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (4, 'Puddle', 250, '4.png')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (5, 'Pool', 500, '5.png')";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (1, 'shit', '', 'censor', 0)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (2, 'fuck', '', 'censor', 0)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (3, ';)', 'wink.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (4, ':thinking:', 'thinking.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (5, ':p', 'tongue.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (6, ':rolleyes:', 'rolleyes.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (7, ':(', 'sad.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (8, ':D', 'smile.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (9, ':)', 'smirk.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (10, ':stare:', 'stare.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (11, ':o', 'surprised.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (12, ':mad:', 'mad.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (13, 'B)', 'cool.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (replacement_id, replacement_search, replacement_replace, replacement_type, replacement_clickable) VALUES (14, ':cyclops:', 'cyclops.gif', 'emoticon', 1)";

$queries[] = "INSERT INTO %ptimezones VALUES (1, 'Europe/Andorra', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (2, 'Asia/Dubai', 'GST', 14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (3, 'Asia/Kabul', 'AFT', 16200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (4, 'America/Antigua', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (5, 'America/Anguilla', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (6, 'Europe/Tirane', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (7, 'Asia/Yerevan', 'AMT', 14400, 1143324000)";
$queries[] = "INSERT INTO %ptimezones VALUES (8, 'America/Curacao', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (9, 'Africa/Luanda', 'WAT', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (10, 'Antarctica/McMurdo', 'NZDT', 46800, 1142690400)";
$queries[] = "INSERT INTO %ptimezones VALUES (11, 'Antarctica/South_Pole', 'NZDT', 46800, 1142690400)";
$queries[] = "INSERT INTO %ptimezones VALUES (12, 'Antarctica/Rothera', 'ROTT', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (13, 'Antarctica/Palmer', 'CLST', -10800, 1142132400)";
$queries[] = "INSERT INTO %ptimezones VALUES (14, 'Antarctica/Mawson', 'MAWT', 21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (15, 'Antarctica/Davis', 'DAVT', 25200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (16, 'Antarctica/Casey', 'WST', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (17, 'Antarctica/Vostok', 'VOST', 21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (18, 'Antarctica/DumontDUrville', 'DDUT', 36000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (19, 'Antarctica/Syowa', 'SYOT', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (20, 'America/Argentina/Buenos_Aires', 'ART', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (21, 'America/Argentina/Cordoba', 'ART', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (22, 'America/Argentina/Jujuy', 'ART', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (23, 'America/Argentina/Tucuman', 'ART', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (24, 'America/Argentina/Catamarca', 'ART', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (25, 'America/Argentina/La_Rioja', 'ART', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (26, 'America/Argentina/San_Juan', 'ART', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (27, 'America/Argentina/Mendoza', 'ART', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (28, 'America/Argentina/Rio_Gallegos', 'ART', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (29, 'America/Argentina/Ushuaia', 'ART', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (30, 'Pacific/Pago_Pago', 'SST', -39600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (31, 'Europe/Vienna', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (32, 'Australia/Lord_Howe', 'LHST', 39600, 1143903600)";
$queries[] = "INSERT INTO %ptimezones VALUES (33, 'Australia/Hobart', 'EST', 39600, 1143907200)";
$queries[] = "INSERT INTO %ptimezones VALUES (34, 'Australia/Currie', 'EST', 39600, 1143907200)";
$queries[] = "INSERT INTO %ptimezones VALUES (35, 'Australia/Melbourne', 'EST', 39600, 1143907200)";
$queries[] = "INSERT INTO %ptimezones VALUES (36, 'Australia/Sydney', 'EST', 39600, 1143907200)";
$queries[] = "INSERT INTO %ptimezones VALUES (37, 'Australia/Broken_Hill', 'CST', 37800, 1143909000)";
$queries[] = "INSERT INTO %ptimezones VALUES (38, 'Australia/Brisbane', 'EST', 36000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (39, 'Australia/Lindeman', 'EST', 36000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (40, 'Australia/Adelaide', 'CST', 37800, 1143909000)";
$queries[] = "INSERT INTO %ptimezones VALUES (41, 'Australia/Darwin', 'CST', 34200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (42, 'Australia/Perth', 'WST', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (43, 'America/Aruba', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (44, 'Europe/Mariehamn', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (45, 'Asia/Baku', 'AZT', 14400, 1143320400)";
$queries[] = "INSERT INTO %ptimezones VALUES (46, 'Europe/Sarajevo', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (47, 'America/Barbados', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (48, 'Asia/Dhaka', 'BDT', 21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (49, 'Europe/Brussels', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (50, 'Africa/Ouagadougou', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (51, 'Europe/Sofia', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (52, 'Asia/Bahrain', 'AST', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (53, 'Africa/Bujumbura', 'CAT', 7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (54, 'Africa/Porto-Novo', 'WAT', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (55, 'Atlantic/Bermuda', 'AST', -14400, 1143957600)";
$queries[] = "INSERT INTO %ptimezones VALUES (56, 'Asia/Brunei', 'BNT', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (57, 'America/La_Paz', 'BOT', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (58, 'America/Noronha', 'FNT', -7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (59, 'America/Belem', 'BRT', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (60, 'America/Fortaleza', 'BRT', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (61, 'America/Recife', 'BRT', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (62, 'America/Araguaina', 'BRT', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (63, 'America/Maceio', 'BRT', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (64, 'America/Bahia', 'BRT', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (65, 'America/Sao_Paulo', 'BRT', -10800, 1160881200)";
$queries[] = "INSERT INTO %ptimezones VALUES (66, 'America/Campo_Grande', 'AMT', -14400, 1160884800)";
$queries[] = "INSERT INTO %ptimezones VALUES (67, 'America/Cuiaba', 'AMT', -14400, 1160884800)";
$queries[] = "INSERT INTO %ptimezones VALUES (68, 'America/Porto_Velho', 'AMT', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (69, 'America/Boa_Vista', 'AMT', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (70, 'America/Manaus', 'AMT', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (71, 'America/Eirunepe', 'ACT', -18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (72, 'America/Rio_Branco', 'ACT', -18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (73, 'America/Nassau', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (74, 'Asia/Thimphu', 'BTT', 21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (75, 'Africa/Gaborone', 'CAT', 7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (76, 'Europe/Minsk', 'EET', 7200, 1143331200)";
$queries[] = "INSERT INTO %ptimezones VALUES (77, 'America/Belize', 'CST', -21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (78, 'America/St_Johns', 'NST', -12600, 1143948660)";
$queries[] = "INSERT INTO %ptimezones VALUES (79, 'America/Halifax', 'AST', -14400, 1143957600)";
$queries[] = "INSERT INTO %ptimezones VALUES (80, 'America/Glace_Bay', 'AST', -14400, 1143957600)";
$queries[] = "INSERT INTO %ptimezones VALUES (81, 'America/Goose_Bay', 'AST', -14400, 1143950460)";
$queries[] = "INSERT INTO %ptimezones VALUES (82, 'America/Montreal', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (83, 'America/Toronto', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (84, 'America/Nipigon', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (85, 'America/Thunder_Bay', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (86, 'America/Pangnirtung', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (87, 'America/Iqaluit', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (88, 'America/Coral_Harbour', 'EST', -18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (89, 'America/Rankin_Inlet', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (90, 'America/Winnipeg', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (91, 'America/Rainy_River', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (92, 'America/Cambridge_Bay', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (93, 'America/Regina', 'CST', -21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (94, 'America/Swift_Current', 'CST', -21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (95, 'America/Edmonton', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (96, 'America/Yellowknife', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (97, 'America/Inuvik', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (98, 'America/Dawson_Creek', 'MST', -25200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (99, 'America/Vancouver', 'PST', -28800, 1143972000)";
$queries[] = "INSERT INTO %ptimezones VALUES (100, 'America/Whitehorse', 'PST', -28800, 1143972000)";
$queries[] = "INSERT INTO %ptimezones VALUES (101, 'America/Dawson', 'PST', -28800, 1143972000)";
$queries[] = "INSERT INTO %ptimezones VALUES (102, 'Indian/Cocos', 'CCT', 23400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (103, 'Africa/Kinshasa', 'WAT', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (104, 'Africa/Lubumbashi', 'CAT', 7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (105, 'Africa/Bangui', 'WAT', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (106, 'Africa/Brazzaville', 'WAT', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (107, 'Europe/Zurich', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (108, 'Africa/Abidjan', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (109, 'Pacific/Rarotonga', 'CKT', -36000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (110, 'America/Santiago', 'CLST', -10800, 1142132400)";
$queries[] = "INSERT INTO %ptimezones VALUES (111, 'Pacific/Easter', 'EASST', -18000, 1142132400)";
$queries[] = "INSERT INTO %ptimezones VALUES (112, 'Africa/Douala', 'WAT', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (113, 'Asia/Shanghai', 'CST', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (114, 'Asia/Harbin', 'CST', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (115, 'Asia/Chongqing', 'CST', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (116, 'Asia/Urumqi', 'CST', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (117, 'Asia/Kashgar', 'CST', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (118, 'America/Bogota', 'COT', -18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (119, 'America/Costa_Rica', 'CST', -21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (120, 'Europe/Belgrade', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (121, 'America/Havana', 'CST', -18000, 1143954000)";
$queries[] = "INSERT INTO %ptimezones VALUES (122, 'Atlantic/Cape_Verde', 'CVT', -3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (123, 'Indian/Christmas', 'CXT', 25200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (124, 'Asia/Nicosia', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (125, 'Europe/Prague', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (126, 'Europe/Berlin', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (127, 'Africa/Djibouti', 'EAT', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (128, 'Europe/Copenhagen', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (129, 'America/Dominica', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (130, 'America/Santo_Domingo', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (131, 'Africa/Algiers', 'CET', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (132, 'America/Guayaquil', 'ECT', -18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (133, 'Pacific/Galapagos', 'GALT', -21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (134, 'Europe/Tallinn', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (135, 'Africa/Cairo', 'EET', 7200, 1146175200)";
$queries[] = "INSERT INTO %ptimezones VALUES (136, 'Africa/El_Aaiun', 'WET', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (137, 'Africa/Asmera', 'EAT', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (138, 'Europe/Madrid', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (139, 'Africa/Ceuta', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (140, 'Atlantic/Canary', 'WET', 0, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (141, 'Africa/Addis_Ababa', 'EAT', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (142, 'Europe/Helsinki', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (143, 'Pacific/Fiji', 'FJT', 43200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (144, 'Atlantic/Stanley', 'FKST', -10800, 1145163600)";
$queries[] = "INSERT INTO %ptimezones VALUES (145, 'Pacific/Truk', 'TRUT', 36000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (146, 'Pacific/Ponape', 'PONT', 39600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (147, 'Pacific/Kosrae', 'KOST', 39600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (148, 'Atlantic/Faeroe', 'WET', 0, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (149, 'Europe/Paris', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (150, 'Africa/Libreville', 'WAT', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (151, 'Europe/London', 'GMT', 0, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (152, 'America/Grenada', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (153, 'Asia/Tbilisi', 'GET', 10800, 1143327600)";
$queries[] = "INSERT INTO %ptimezones VALUES (154, 'America/Cayenne', 'GFT', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (155, 'Africa/Accra', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (156, 'Europe/Gibraltar', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (157, 'America/Godthab', 'WGT', -10800, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (158, 'America/Danmarkshavn', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (159, 'America/Scoresbysund', 'EGT', -3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (160, 'America/Thule', 'AST', -14400, 1143957600)";
$queries[] = "INSERT INTO %ptimezones VALUES (161, 'Africa/Banjul', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (162, 'Africa/Conakry', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (163, 'America/Guadeloupe', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (164, 'Africa/Malabo', 'WAT', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (165, 'Europe/Athens', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (166, 'Atlantic/South_Georgia', 'GST', -7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (167, 'America/Guatemala', 'CST', -21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (168, 'Pacific/Guam', 'ChST', 36000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (169, 'Africa/Bissau', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (170, 'America/Guyana', 'GYT', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (171, 'Asia/Hong_Kong', 'HKT', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (172, 'America/Tegucigalpa', 'CST', -21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (173, 'Europe/Zagreb', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (174, 'America/Port-au-Prince', 'EST', -18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (175, 'Europe/Budapest', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (176, 'Asia/Jakarta', 'WIT', 25200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (177, 'Asia/Pontianak', 'WIT', 25200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (178, 'Asia/Makassar', 'CIT', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (179, 'Asia/Jayapura', 'EIT', 32400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (180, 'Europe/Dublin', 'GMT', 0, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (181, 'Asia/Jerusalem', 'IST', 7200, 1143763200)";
$queries[] = "INSERT INTO %ptimezones VALUES (182, 'Asia/Calcutta', 'IST', 19800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (183, 'Indian/Chagos', 'IOT', 21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (184, 'Asia/Baghdad', 'AST', 10800, 1143849600)";
$queries[] = "INSERT INTO %ptimezones VALUES (185, 'Asia/Tehran', 'IRST', 12600, 1142973000)";
$queries[] = "INSERT INTO %ptimezones VALUES (186, 'Atlantic/Reykjavik', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (187, 'Europe/Rome', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (188, 'America/Jamaica', 'EST', -18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (189, 'Asia/Amman', 'EET', 7200, 1143669600)";
$queries[] = "INSERT INTO %ptimezones VALUES (190, 'Asia/Tokyo', 'JST', 32400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (191, 'Africa/Nairobi', 'EAT', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (192, 'Asia/Bishkek', 'KGT', 21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (193, 'Asia/Phnom_Penh', 'ICT', 25200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (194, 'Pacific/Tarawa', 'GILT', 43200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (195, 'Pacific/Enderbury', 'PHOT', 46800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (196, 'Pacific/Kiritimati', 'LINT', 50400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (197, 'Indian/Comoro', 'EAT', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (198, 'America/St_Kitts', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (199, 'Asia/Pyongyang', 'KST', 32400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (200, 'Asia/Seoul', 'KST', 32400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (201, 'Asia/Kuwait', 'AST', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (202, 'America/Cayman', 'EST', -18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (203, 'Asia/Almaty', 'ALMT', 21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (204, 'Asia/Qyzylorda', 'QYZT', 21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (205, 'Asia/Aqtobe', 'AQTT', 18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (206, 'Asia/Aqtau', 'AQTT', 18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (207, 'Asia/Oral', 'ORAT', 18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (208, 'Asia/Vientiane', 'ICT', 25200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (209, 'Asia/Beirut', 'EET', 7200, 1143324000)";
$queries[] = "INSERT INTO %ptimezones VALUES (210, 'America/St_Lucia', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (211, 'Europe/Vaduz', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (212, 'Asia/Colombo', 'LKT', 21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (213, 'Africa/Monrovia', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (214, 'Africa/Maseru', 'SAST', 7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (215, 'Europe/Vilnius', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (216, 'Europe/Luxembourg', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (217, 'Europe/Riga', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (218, 'Africa/Tripoli', 'EET', 7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (219, 'Africa/Casablanca', 'WET', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (220, 'Europe/Monaco', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (221, 'Europe/Chisinau', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (222, 'Indian/Antananarivo', 'EAT', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (223, 'Pacific/Majuro', 'MHT', 43200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (224, 'Pacific/Kwajalein', 'MHT', 43200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (225, 'Europe/Skopje', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (226, 'Africa/Bamako', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (227, 'Asia/Rangoon', 'MMT', 23400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (228, 'Asia/Ulaanbaatar', 'ULAT', 28800, 1143223200)";
$queries[] = "INSERT INTO %ptimezones VALUES (229, 'Asia/Hovd', 'HOVT', 25200, 1143226800)";
$queries[] = "INSERT INTO %ptimezones VALUES (230, 'Asia/Choibalsan', 'CHOT', 32400, 1143219600)";
$queries[] = "INSERT INTO %ptimezones VALUES (231, 'Asia/Macau', 'CST', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (232, 'Pacific/Saipan', 'ChST', 36000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (233, 'America/Martinique', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (234, 'Africa/Nouakchott', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (235, 'America/Montserrat', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (236, 'Europe/Malta', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (237, 'Indian/Mauritius', 'MUT', 14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (238, 'Indian/Maldives', 'MVT', 18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (239, 'Africa/Blantyre', 'CAT', 7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (240, 'America/Mexico_City', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (241, 'America/Cancun', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (242, 'America/Merida', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (243, 'America/Monterrey', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (244, 'America/Mazatlan', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (245, 'America/Chihuahua', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (246, 'America/Hermosillo', 'MST', -25200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (247, 'America/Tijuana', 'PST', -28800, 1143972000)";
$queries[] = "INSERT INTO %ptimezones VALUES (248, 'Asia/Kuala_Lumpur', 'MYT', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (249, 'Asia/Kuching', 'MYT', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (250, 'Africa/Maputo', 'CAT', 7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (251, 'Africa/Windhoek', 'WAST', 7200, 1143936000)";
$queries[] = "INSERT INTO %ptimezones VALUES (252, 'Pacific/Noumea', 'NCT', 39600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (253, 'Africa/Niamey', 'WAT', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (254, 'Pacific/Norfolk', 'NFT', 41400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (255, 'Africa/Lagos', 'WAT', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (256, 'America/Managua', 'CST', -21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (257, 'Europe/Amsterdam', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (258, 'Europe/Oslo', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (259, 'Asia/Katmandu', 'NPT', 20700, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (260, 'Pacific/Nauru', 'NRT', 43200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (261, 'Pacific/Niue', 'NUT', -39600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (262, 'Pacific/Auckland', 'NZDT', 46800, 1142690400)";
$queries[] = "INSERT INTO %ptimezones VALUES (263, 'Pacific/Chatham', 'CHADT', 49500, 1142690400)";
$queries[] = "INSERT INTO %ptimezones VALUES (264, 'Asia/Muscat', 'GST', 14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (265, 'America/Panama', 'EST', -18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (266, 'America/Lima', 'PET', -18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (267, 'Pacific/Tahiti', 'TAHT', -36000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (268, 'Pacific/Marquesas', 'MART', -34200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (269, 'Pacific/Gambier', 'GAMT', -32400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (270, 'Pacific/Port_Moresby', 'PGT', 36000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (271, 'Asia/Manila', 'PHT', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (272, 'Asia/Karachi', 'PKT', 18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (273, 'Europe/Warsaw', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (274, 'America/Miquelon', 'PMST', -10800, 1143954000)";
$queries[] = "INSERT INTO %ptimezones VALUES (275, 'Pacific/Pitcairn', 'PST', -28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (276, 'America/Puerto_Rico', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (277, 'Asia/Gaza', 'EET', 7200, 1145570400)";
$queries[] = "INSERT INTO %ptimezones VALUES (278, 'Europe/Lisbon', 'WET', 0, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (279, 'Atlantic/Madeira', 'WET', 0, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (280, 'Atlantic/Azores', 'AZOT', -3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (281, 'Pacific/Palau', 'PWT', 32400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (282, 'America/Asuncion', 'PYST', -10800, 1142132400)";
$queries[] = "INSERT INTO %ptimezones VALUES (283, 'Asia/Qatar', 'AST', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (284, 'Indian/Reunion', 'RET', 14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (285, 'Europe/Bucharest', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (286, 'Europe/Kaliningrad', 'EET', 7200, 1143331200)";
$queries[] = "INSERT INTO %ptimezones VALUES (287, 'Europe/Moscow', 'MSK', 10800, 1143327600)";
$queries[] = "INSERT INTO %ptimezones VALUES (288, 'Europe/Samara', 'SAMT', 14400, 1143324000)";
$queries[] = "INSERT INTO %ptimezones VALUES (289, 'Asia/Yekaterinburg', 'YEKT', 18000, 1143320400)";
$queries[] = "INSERT INTO %ptimezones VALUES (290, 'Asia/Omsk', 'OMST', 21600, 1143316800)";
$queries[] = "INSERT INTO %ptimezones VALUES (291, 'Asia/Novosibirsk', 'NOVT', 21600, 1143316800)";
$queries[] = "INSERT INTO %ptimezones VALUES (292, 'Asia/Krasnoyarsk', 'KRAT', 25200, 1143313200)";
$queries[] = "INSERT INTO %ptimezones VALUES (293, 'Asia/Irkutsk', 'IRKT', 28800, 1143309600)";
$queries[] = "INSERT INTO %ptimezones VALUES (294, 'Asia/Yakutsk', 'YAKT', 32400, 1143306000)";
$queries[] = "INSERT INTO %ptimezones VALUES (295, 'Asia/Vladivostok', 'VLAT', 36000, 1143302400)";
$queries[] = "INSERT INTO %ptimezones VALUES (296, 'Asia/Sakhalin', 'SAKT', 36000, 1143302400)";
$queries[] = "INSERT INTO %ptimezones VALUES (297, 'Asia/Magadan', 'MAGT', 39600, 1143298800)";
$queries[] = "INSERT INTO %ptimezones VALUES (298, 'Asia/Kamchatka', 'PETT', 43200, 1143295200)";
$queries[] = "INSERT INTO %ptimezones VALUES (299, 'Asia/Anadyr', 'ANAT', 43200, 1143295200)";
$queries[] = "INSERT INTO %ptimezones VALUES (300, 'Africa/Kigali', 'CAT', 7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (301, 'Asia/Riyadh', 'AST', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (302, 'Pacific/Guadalcanal', 'SBT', 39600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (303, 'Indian/Mahe', 'SCT', 14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (304, 'Africa/Khartoum', 'EAT', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (305, 'Europe/Stockholm', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (306, 'Asia/Singapore', 'SGT', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (307, 'Atlantic/St_Helena', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (308, 'Europe/Ljubljana', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (309, 'Arctic/Longyearbyen', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (310, 'Atlantic/Jan_Mayen', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (311, 'Europe/Bratislava', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (312, 'Africa/Freetown', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (313, 'Europe/San_Marino', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (314, 'Africa/Dakar', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (315, 'Africa/Mogadishu', 'EAT', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (316, 'America/Paramaribo', 'SRT', -10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (317, 'Africa/Sao_Tome', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (318, 'America/El_Salvador', 'CST', -21600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (319, 'Asia/Damascus', 'EET', 7200, 1143842400)";
$queries[] = "INSERT INTO %ptimezones VALUES (320, 'Africa/Mbabane', 'SAST', 7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (321, 'America/Grand_Turk', 'EST', -18000, 1143954000)";
$queries[] = "INSERT INTO %ptimezones VALUES (322, 'Africa/Ndjamena', 'WAT', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (323, 'Indian/Kerguelen', 'TFT', 18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (324, 'Africa/Lome', 'GMT', 0, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (325, 'Asia/Bangkok', 'ICT', 25200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (326, 'Asia/Dushanbe', 'TJT', 18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (327, 'Pacific/Fakaofo', 'TKT', -36000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (328, 'Asia/Dili', 'TLT', 32400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (329, 'Asia/Ashgabat', 'TMT', 18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (330, 'Africa/Tunis', 'CET', 3600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (331, 'Pacific/Tongatapu', 'TOT', 46800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (332, 'Europe/Istanbul', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (333, 'America/Port_of_Spain', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (334, 'Pacific/Funafuti', 'TVT', 43200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (335, 'Asia/Taipei', 'CST', 28800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (336, 'Africa/Dar_es_Salaam', 'EAT', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (337, 'Europe/Kiev', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (338, 'Europe/Uzhgorod', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (339, 'Europe/Zaporozhye', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (340, 'Europe/Simferopol', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (341, 'Africa/Kampala', 'EAT', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (342, 'Pacific/Johnston', 'HST', -36000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (343, 'Pacific/Midway', 'SST', -39600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (344, 'Pacific/Wake', 'WAKT', 43200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (345, 'America/New_York', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (346, 'America/Detroit', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (347, 'America/Kentucky/Louisville', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (348, 'America/Kentucky/Monticello', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (349, 'America/Indiana/Indianapolis', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (350, 'America/Indiana/Marengo', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (351, 'America/Indiana/Knox', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (352, 'America/Indiana/Vevay', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (353, 'America/Chicago', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (354, 'America/Menominee', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (355, 'America/North_Dakota/Center', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (356, 'America/Denver', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (357, 'America/Boise', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (358, 'America/Shiprock', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (359, 'America/Phoenix', 'MST', -25200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (360, 'America/Los_Angeles', 'PST', -28800, 1143972000)";
$queries[] = "INSERT INTO %ptimezones VALUES (361, 'America/Anchorage', 'AKST', -32400, 1143975600)";
$queries[] = "INSERT INTO %ptimezones VALUES (362, 'America/Juneau', 'AKST', -32400, 1143975600)";
$queries[] = "INSERT INTO %ptimezones VALUES (363, 'America/Yakutat', 'AKST', -32400, 1143975600)";
$queries[] = "INSERT INTO %ptimezones VALUES (364, 'America/Nome', 'AKST', -32400, 1143975600)";
$queries[] = "INSERT INTO %ptimezones VALUES (365, 'America/Adak', 'HAST', -36000, 1143979200)";
$queries[] = "INSERT INTO %ptimezones VALUES (366, 'Pacific/Honolulu', 'HST', -36000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (367, 'America/Montevideo', 'UYST', -7200, 1142136000)";
$queries[] = "INSERT INTO %ptimezones VALUES (368, 'Asia/Samarkand', 'UZT', 18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (369, 'Asia/Tashkent', 'UZT', 18000, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (370, 'Europe/Vatican', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (371, 'America/St_Vincent', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (372, 'America/Caracas', 'VET', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (373, 'America/Tortola', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (374, 'America/St_Thomas', 'AST', -14400, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (375, 'Asia/Saigon', 'ICT', 25200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (376, 'Pacific/Efate', 'VUT', 39600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (377, 'Pacific/Wallis', 'WFT', 43200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (378, 'Pacific/Apia', 'WST', -39600, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (379, 'Asia/Aden', 'AST', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (380, 'Indian/Mayotte', 'EAT', 10800, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (381, 'Africa/Johannesburg', 'SAST', 7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (382, 'Africa/Lusaka', 'CAT', 7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (383, 'Africa/Harare', 'CAT', 7200, 1144190569)";
$queries[] = "INSERT INTO %ptimezones VALUES (384, 'America/Moncton', 'AST', -14400, 1143950460)";
$queries[] = "INSERT INTO %ptimezones VALUES (385, 'America/Indiana/Petersburg', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (386, 'America/Indiana/Vincennes', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (387, 'America/North_Dakota/New_Salem', 'CST', -18000, 1143961200)";

// Build settings step by step
$sets = array();
$sets['admin_incoming'] = 'root';
$sets['admin_outgoing'] = 'root';
$sets['attach_types'] = array('jpg', 'gif', 'png', 'bmp', 'zip', 'tgz', 'gz', 'rar');
$sets['attach_upload_size'] = 25600;
$sets['avatar_height'] = 75;
$sets['avatar_upload_size'] = 51200;
$sets['avatar_width'] = 75;
$sets['banned_ips'] = array();
$sets['clickable_per_row'] = 5;
$sets['closed'] = 0;
$sets['closedtext'] = 'We are upgrading to the latest version of QSF Portal. Please check back later.';
$sets['cookie_path'] = '/';
$sets['cookie_prefix'] = 'qsf_';
$sets['emailactivation'] = 1;
$sets['flash_avs'] = 1;
$sets['flood_time'] = 30;
$sets['forum_name'] = 'QSF Portal';
$sets['hot_limit'] = 20;
$sets['loc_of_board'] = '';
$sets['last_member'] = '';
$sets['last_member_id'] = 0;
$sets['link_target'] = '_blank';
$sets['logintime'] = 31536000;
$sets['mailserver'] = 'localhost';
$sets['max_load'] = 0;
$sets['mostonline'] = 0;
$sets['mostonlinetime'] = 0;
$sets['output_buffer'] = 1;
$sets['posts'] = 0;
$sets['posts_per_page'] = 15;
$sets['register_image'] = 0;
$sets['servertime'] = 151;
$sets['topics'] = 0;
$sets['topics_per_page'] = 20;
$sets['vote_after_results'] = 0;
$sets['default_skin'] = 'default';
$sets['default_email_shown'] = 0;
$sets['default_lang'] = 'en';
$sets['default_group'] = 2;
$sets['default_timezone'] = 151;
$sets['default_pm'] = 1;
$sets['default_view_avatars'] = 1;
$sets['default_view_sigs'] = 1;
$sets['default_view_emots'] = 1;
$sets['flood_time_pm'] = 30;
$sets['flood_time_search'] = 10;
$sets['members'] = 0;
$sets['spider_active'] = 1;
$sets['spider_name'] = array(
	'googlebot' 	=> 'Google',
	'yahoo'		=> 'Yahoo! Slurp',
	'msnbot'	=> 'MSN Search'
);
$sets['debug_mode'] = 0;
$sets['file_count'] = 0;
$sets['code_approval'] = 0;
$sets['rss_feed_title'] = '';
$sets['rss_feed_desc'] = '';
$sets['rss_feed_posts'] = 5;
$sets['rss_feed_time'] = 60;
$sets['optional_modules'] = array(
	'active',
	'board',
	'cp',
	'email',
	'files',
	'filerating',
	'help',
	'members',
	'mod',
	'page',
	'pm',
	'profile',
	'search',
	'recent',
	'rssfeed'
);
$settings = serialize($sets);
$queries[] = "INSERT INTO %psettings (settings_id, settings_data) VALUES (1, '{$settings}')";
$queries[] = "INSERT INTO %pskins (skin_name, skin_dir) VALUES ('QSF Comet Portal', 'default')";
$queries[] = "INSERT INTO %pusers (user_id, user_name, user_group) VALUES (1, 'Guest', 3)";
?>
