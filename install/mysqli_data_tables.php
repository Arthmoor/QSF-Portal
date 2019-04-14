<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2019 The QSF Portal Development Team
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

if( !defined( 'QSF_INSTALLER' ) ) {
	exit( 'Use index.php to install.' );
}

$queries[] = "DROP TABLE IF EXISTS %pactive";
$queries[] = "CREATE TABLE %pactive (
  active_id int(10) unsigned NOT NULL default '0',
  active_ip varchar(40) NOT NULL default '127.0.0.1',
  active_user_agent varchar(255) NOT NULL default 'Unknown',
  active_action varchar(32) NOT NULL default '',
  active_item int(10) unsigned NOT NULL default '0',
  active_time int(10) unsigned NOT NULL default '0',
  active_session varchar(32) NOT NULL default '',
  UNIQUE KEY active_session (active_session),
  UNIQUE KEY active_ip (active_ip)
) ENGINE=MyISAM ROW_FORMAT=FIXED";

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
) ENGINE=MyISAM ROW_FORMAT=FIXED";

$queries[] = "DROP TABLE IF EXISTS %pcaptcha";
$queries[] = "CREATE TABLE %pcaptcha (
  cap_id int(10) unsigned NOT NULL auto_increment,
  cap_question text NOT NULL,
  cap_answer text NOT NULL,
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

$queries[] = "DROP TABLE IF EXISTS %pemoticons";
$queries[] = "CREATE TABLE %pemoticons (
  emote_id int(10) unsigned NOT NULL auto_increment,
  emote_string varchar(15) NOT NULL default '',
  emote_image varchar(255) NOT NULL default '',
  emote_clickable tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (emote_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

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
) ENGINE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pfilecomments";
$queries[] = "CREATE TABLE %pfilecomments (
  comment_id int(10) unsigned NOT NULL auto_increment,
  file_id int(10) unsigned NOT NULL default '0',
  user_id int(10) unsigned NOT NULL default '0',
  comment_date int(10) unsigned NOT NULL default '0',
  comment_text text NOT NULL,
  PRIMARY KEY  (comment_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$queries[] = "DROP TABLE IF EXISTS %pfileratings";
$queries[] = "CREATE TABLE %pfileratings (
  file_id int(10) unsigned NOT NULL default '0',
  user_id int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (file_id,user_id)
) ENGINE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pfiles";
$queries[] = "CREATE TABLE %pfiles (
  file_id int(12) unsigned NOT NULL auto_increment,
  file_catid int(10) unsigned NOT NULL default '0',
  file_submitted int(10) unsigned NOT NULL default '0',
  file_author varchar(30) NOT NULL default '',
  file_name varchar(50) NOT NULL default '',
  file_filename varchar(255) NOT NULL default '',
  file_fileversion varchar(10) NOT NULL default '',
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
  file_description text NOT NULL,
  PRIMARY KEY  (file_id)
) ENGINE=MyISAM";

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
  forum_redirect tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (forum_id),
  KEY Parent (forum_parent)
) ENGINE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pgroups";
$queries[] = "CREATE TABLE %pgroups (
  group_id tinyint(3) unsigned NOT NULL auto_increment,
  group_name varchar(255) NOT NULL default '',
  group_type varchar(20) NOT NULL default '',
  group_format varchar(255) NOT NULL default '%%s',
  group_perms text NOT NULL,
  group_file_perms text NOT NULL,
  PRIMARY KEY  (group_id)
) ENGINE=MyISAM";

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
) ENGINE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pmembertitles";
$queries[] = "CREATE TABLE %pmembertitles (
  membertitle_id tinyint(3) unsigned NOT NULL auto_increment,
  membertitle_title varchar(50) NOT NULL default '',
  membertitle_posts int(10) unsigned NOT NULL default '0',
  membertitle_icon varchar(25) NOT NULL default '',
  PRIMARY KEY  (membertitle_id),
  KEY Posts (membertitle_posts)
) ENGINE=MyISAM ROW_FORMAT=FIXED";

$queries[] = "DROP TABLE IF EXISTS %ppages";
$queries[] = "CREATE TABLE %ppages (
  page_id int(11) unsigned NOT NULL auto_increment,
  page_title varchar(255) NOT NULL default '',
  page_flags int(10) unsigned NOT NULL default '0',
  page_contents text NOT NULL,
  PRIMARY KEY  (page_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$queries[] = "DROP TABLE IF EXISTS %ppmsystem";
$queries[] = "CREATE TABLE %ppmsystem (
  pm_id int(10) unsigned NOT NULL auto_increment,
  pm_to int(10) unsigned NOT NULL default '0',
  pm_from int(10) unsigned NOT NULL default '0',
  pm_ip varchar(40) NOT NULL default '127.0.0.1',
  pm_bcc text,
  pm_title varchar(255) NOT NULL default '[No Title]',
  pm_time int(10) unsigned NOT NULL default '0',
  pm_message text NOT NULL,
  pm_read tinyint(1) unsigned NOT NULL default '0',
  pm_folder tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (pm_id),
  KEY NewPMs (pm_to,pm_read,pm_folder)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$queries[] = "DROP TABLE IF EXISTS %pposts";
$queries[] = "CREATE TABLE %pposts (
  post_id int(12) unsigned NOT NULL auto_increment,
  post_topic int(10) unsigned NOT NULL default '0',
  post_author int(10) unsigned NOT NULL default '0',
  post_emoticons tinyint(1) unsigned NOT NULL default '1',
  post_mbcode tinyint(1) unsigned NOT NULL default '1',
  post_count tinyint(1) unsigned NOT NULL default '1',
  post_text text NOT NULL,
  post_time int(10) unsigned NOT NULL default '0',
  post_icon varchar(32) NOT NULL default '',
  post_ip varchar(40) NOT NULL default '127.0.0.1',
  post_edited_by varchar(32) NOT NULL default '',
  post_edited_time int(10) unsigned NOT NULL default '0',
  post_referrer tinytext,
  post_agent tinytext,
  PRIMARY KEY  (post_id),
  KEY Topic (post_topic),
  FULLTEXT KEY post_text (post_text)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$queries[] = "DROP TABLE IF EXISTS %preadmarks";
$queries[] = "CREATE TABLE %preadmarks (
  readmark_user int(10) unsigned NOT NULL default '0',
  readmark_topic int(10) unsigned NOT NULL default '0',
  readmark_lastread int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (readmark_user,readmark_topic)
) ENGINE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %preplacements";
$queries[] = "CREATE TABLE %preplacements (
  replacement_id smallint(3) unsigned NOT NULL auto_increment,
  replacement_search varchar(50) NOT NULL default '',
  PRIMARY KEY  (replacement_id)
) ENGINE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %psettings";
$queries[] = "CREATE TABLE %psettings (
  settings_id tinyint(2) unsigned NOT NULL auto_increment,
  settings_version smallint(2) NOT NULL default 2,
  settings_data text NOT NULL,
  settings_tos text,
  settings_tos_files text,
  settings_meta_keywords tinytext,
  settings_meta_description tinytext,
  settings_mobile_icons text,
  PRIMARY KEY  (settings_id)
) ENGINE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pskins";
$queries[] = "CREATE TABLE %pskins (
  skin_id int(12) unsigned NOT NULL auto_increment,
  skin_name varchar(255) NOT NULL default '',
  skin_dir varchar(255) NOT NULL default '',
  skin_enabled tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (skin_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$queries[] = "DROP TABLE IF EXISTS %pspam";
$queries[] = "CREATE TABLE %pspam (
  spam_id int(12) unsigned NOT NULL auto_increment,
  spam_topic int(10) unsigned NOT NULL default '0',
  spam_author int(10) unsigned NOT NULL default '0',
  spam_emoticons tinyint(1) unsigned NOT NULL default '1',
  spam_mbcode tinyint(1) unsigned NOT NULL default '1',
  spam_count tinyint(1) unsigned NOT NULL default '1',
  spam_text text NOT NULL,
  spam_time int(10) unsigned NOT NULL default '0',
  spam_icon varchar(32) NOT NULL default '',
  spam_ip varchar(40) NOT NULL default '127.0.0.1',
  spam_edited_by varchar(32) NOT NULL default '',
  spam_edited_time int(10) unsigned NOT NULL default '0',
  spam_svars text,
  PRIMARY KEY  (spam_id),
  KEY Topic (spam_topic),
  FULLTEXT KEY spam_text (spam_text)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$queries[] = "DROP TABLE IF EXISTS %psubscriptions";
$queries[] = "CREATE TABLE %psubscriptions (
  subscription_id int(12) unsigned NOT NULL auto_increment,
  subscription_user int(10) unsigned NOT NULL default '0',
  subscription_type varchar(10) NOT NULL default '',
  subscription_item int(10) unsigned NOT NULL default '0',
  subscription_expire int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (subscription_id),
  KEY subscription_item (subscription_item)
) ENGINE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %ptemplates";

$queries[] = "DROP TABLE IF EXISTS %ptopics";
$queries[] = "CREATE TABLE %ptopics (
  topic_id int(10) unsigned NOT NULL auto_increment,
  topic_type smallint(2) unsigned NOT NULL default '1',
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
  topic_poll_options text,
  PRIMARY KEY  (topic_id),
  KEY Forum (topic_forum)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$queries[] = "DROP TABLE IF EXISTS %pupdates";
$queries[] = "CREATE TABLE %pupdates (
  update_id int(10) unsigned NOT NULL auto_increment,
  update_name varchar(32) NOT NULL default '',
  update_fileversion varchar(10) NOT NULL default '',
  update_updating int(10) unsigned default NULL,
  update_description text NOT NULL,
  update_md5name varchar(32) default NULL,
  update_date int(10) unsigned default NULL,
  update_size int(8) unsigned default NULL,
  update_updater int(10) unsigned default NULL,
  PRIMARY KEY  (update_id)
) ENGINE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pusers";
$queries[] = "CREATE TABLE %pusers (
  user_id int(10) unsigned NOT NULL auto_increment,
  user_name varchar(255) NOT NULL default '',
  user_password varchar(255) NOT NULL default '',
  user_joined int(10) unsigned NOT NULL default '0',
  user_level tinyint(3) unsigned NOT NULL default '1',
  user_title varchar(100) NOT NULL default '',
  user_title_custom tinyint(1) unsigned NOT NULL default '0',
  user_group tinyint(3) unsigned NOT NULL default '2',
  user_skin int(10) unsigned NOT NULL default '1',
  user_language varchar(6) NOT NULL default 'en',
  user_avatar varchar(150) NOT NULL default '',
  user_avatar_type enum('local','url','uploaded','gravatar','none') NOT NULL default 'none',
  user_avatar_width smallint(3) unsigned NOT NULL default '0',
  user_avatar_height smallint(3) unsigned NOT NULL default '0',
  user_email varchar(100) NOT NULL default '',
  user_email_show tinyint(1) unsigned NOT NULL default '0',
  user_email_form tinyint(1) unsigned NOT NULL default '1',
  user_birthday date NOT NULL default '1900-01-01',
  user_timezone varchar(255) NOT NULL default 'Europe/London',
  user_posts int(10) unsigned NOT NULL default '0',
  user_uploads int(10) unsigned NOT NULL default '0',
  user_location varchar(100) NOT NULL default '',
  user_twitter varchar(50) NOT NULL default '',
  user_facebook varchar(255) NOT NULL default '',
  user_homepage varchar(255) NOT NULL default '',
  user_pm tinyint(1) unsigned NOT NULL default '1',
  user_pm_mail tinyint(1) unsigned NOT NULL default '0',
  user_active tinyint(1) unsigned NOT NULL default '1',
  user_interests varchar(255) NOT NULL default '',
  user_signature text NOT NULL,
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
  user_regip varchar(40) NOT NULL default '127.0.0.1',
  user_register_email varchar(100) default '',
  user_server_data text,
  user_perms text,
  user_file_perms text,
  PRIMARY KEY  (user_id)
) ENGINE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %pvotes";
$queries[] = "CREATE TABLE %pvotes (
  vote_user int(10) unsigned NOT NULL default '0',
  vote_topic int(10) unsigned NOT NULL default '0',
  vote_option smallint(4) NOT NULL default '-1',
  PRIMARY KEY  (vote_user,vote_topic)
) ENGINE=MyISAM";

$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type, group_format, group_perms, group_file_perms) VALUES (1, 'Administrators', 'ADMIN', '<b>%%s</b>',
				'{\"board_view\":true,\"board_view_closed\":true,\"do_anything\":true,\"edit_avatar\":true,\"edit_profile\":true,\"edit_sig\":true,\"email_use\":true,\"forum_view\":{\"1\":true,\"2\":true,\"3\":true},\"is_admin\":true,\"page_create\":true,\"page_delete\":true,\"page_edit\":true,\"pm_noflood\":true,\"poll_create\":{\"1\":true,\"2\":true,\"3\":true},\"poll_vote\":{\"1\":true,\"2\":true,\"3\":true},\"post_attach\":{\"1\":true,\"2\":true,\"3\":true},\"post_attach_download\":{\"1\":true,\"2\":true,\"3\":true},\"post_create\":{\"1\":true,\"2\":true,\"3\":true},\"post_delete\":{\"1\":true,\"2\":true,\"3\":true},\"post_delete_old\":{\"1\":true,\"2\":true,\"3\":true},\"post_delete_own\":{\"1\":true,\"2\":true,\"3\":true},\"post_edit\":{\"1\":true,\"2\":true,\"3\":true},\"post_edit_old\":{\"1\":true,\"2\":true,\"3\":true},\"post_edit_own\":{\"1\":true,\"2\":true,\"3\":true},\"post_inc_userposts\":{\"1\":true,\"2\":true,\"3\":true},\"post_noflood\":{\"1\":true,\"2\":true,\"3\":true},\"post_viewip\":{\"1\":true,\"2\":true,\"3\":true},\"search_noflood\":true,\"topic_create\":{\"1\":true,\"2\":true,\"3\":true},\"topic_delete\":{\"1\":true,\"2\":true,\"3\":true},\"topic_delete_own\":{\"1\":true,\"2\":true,\"3\":true},\"topic_edit\":{\"1\":true,\"2\":true,\"3\":true},\"topic_edit_own\":{\"1\":true,\"2\":true,\"3\":true},\"topic_global\":true,\"topic_lock\":{\"1\":true,\"2\":true,\"3\":true},\"topic_lock_own\":{\"1\":true,\"2\":true,\"3\":true},\"topic_move\":{\"1\":true,\"2\":true,\"3\":true},\"topic_move_own\":{\"1\":true,\"2\":true,\"3\":true},\"topic_pin\":{\"1\":true,\"2\":true,\"3\":true},\"topic_pin_own\":{\"1\":true,\"2\":true,\"3\":true},\"topic_publish\":{\"1\":true,\"2\":true,\"3\":true},\"topic_publish_auto\":{\"1\":true,\"2\":true,\"3\":true},\"topic_split\":{\"1\":true,\"2\":true,\"3\":true},\"topic_split_own\":{\"1\":true,\"2\":true,\"3\":true},\"topic_unlock\":{\"1\":true,\"2\":true,\"3\":true},\"topic_unlock_own\":{\"1\":true,\"2\":true,\"3\":true},\"topic_unpin\":{\"1\":true,\"2\":true,\"3\":true},\"topic_unpin_own\":{\"1\":true,\"2\":true,\"3\":true},\"topic_view\":{\"1\":true,\"2\":true,\"3\":true},\"topic_view_unpublished\":{\"1\":true,\"2\":true,\"3\":true}}',
				'{\"add_category\":true,\"approve_files\":true,\"category_view\":true,\"delete_category\":true,\"delete_files\":true,\"download_files\":true,\"edit_category\":true,\"edit_files\":true,\"move_files\":true,\"post_comment\":true,\"upload_files\":true}'
)";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type, group_format, group_perms, group_file_perms) VALUES (2, 'Members', 'MEMBER', '%%s',
				'{\"board_view\":true,\"board_view_closed\":false,\"do_anything\":true,\"edit_avatar\":true,\"edit_profile\":true,\"edit_sig\":true,\"email_use\":true,\"forum_view\":{\"1\":true,\"2\":false,\"3\":true},\"is_admin\":false,\"page_create\":false,\"page_delete\":false,\"page_edit\":false,\"pm_noflood\":false,\"poll_create\":{\"1\":true,\"2\":false,\"3\":true},\"poll_vote\":{\"1\":true,\"2\":false,\"3\":true},\"post_attach\":{\"1\":true,\"2\":false,\"3\":true},\"post_attach_download\":{\"1\":true,\"2\":false,\"3\":true},\"post_create\":{\"1\":true,\"2\":true,\"3\":true},\"post_delete\":{\"1\":false,\"2\":false,\"3\":false},\"post_delete_old\":{\"1\":false,\"2\":false,\"3\":false},\"post_delete_own\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit_old\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit_own\":{\"1\":true,\"2\":false,\"3\":true},\"post_inc_userposts\":{\"1\":true,\"2\":false,\"3\":true},\"post_noflood\":{\"1\":false,\"2\":false,\"3\":false},\"post_viewip\":{\"1\":false,\"2\":false,\"3\":false},\"search_noflood\":false,\"topic_create\":{\"1\":true,\"2\":false,\"3\":true},\"topic_delete\":{\"1\":false,\"2\":false,\"3\":false},\"topic_delete_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_edit\":{\"1\":false,\"2\":false,\"3\":false},\"topic_edit_own\":{\"1\":true,\"2\":false,\"3\":true},\"topic_global\":false,\"topic_lock\":{\"1\":false,\"2\":false,\"3\":false},\"topic_lock_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_move\":{\"1\":false,\"2\":false,\"3\":false},\"topic_move_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_pin\":{\"1\":false,\"2\":false,\"3\":false},\"topic_pin_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_publish\":{\"1\":false,\"2\":false,\"3\":false},\"topic_publish_auto\":{\"1\":true,\"2\":false,\"3\":true},\"topic_split\":{\"1\":false,\"2\":false,\"3\":false},\"topic_split_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unlock\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unlock_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unpin\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unpin_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_view\":{\"1\":true,\"2\":false,\"3\":true},\"topic_view_unpublished\":{\"1\":false,\"2\":false,\"3\":false}}',
				'{\"add_category\":false,\"approve_files\":false,\"category_view\":true,\"delete_category\":false,\"delete_files\":false,\"download_files\":true,\"edit_category\":false,\"edit_files\":false,\"move_files\":false,\"post_comment\":true,\"upload_files\":true}'
)";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type, group_format, group_perms, group_file_perms) VALUES (3, 'Guests', 'GUEST', '%%s',
				'{\"board_view\":true,\"board_view_closed\":false,\"do_anything\":true,\"edit_avatar\":false,\"edit_profile\":false,\"edit_sig\":false,\"email_use\":false,\"forum_view\":{\"1\":true,\"2\":true,\"3\":true},\"is_admin\":false,\"page_create\":false,\"page_delete\":false,\"page_edit\":false,\"pm_noflood\":false,\"poll_create\":{\"1\":false,\"2\":false,\"3\":false},\"poll_vote\":{\"1\":false,\"2\":false,\"3\":false},\"post_attach\":{\"1\":false,\"2\":false,\"3\":false},\"post_attach_download\":{\"1\":false,\"2\":false,\"3\":false},\"post_create\":{\"1\":false,\"2\":false,\"3\":false},\"post_delete\":{\"1\":false,\"2\":false,\"3\":false},\"post_delete_old\":{\"1\":false,\"2\":false,\"3\":false},\"post_delete_own\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit_old\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit_own\":{\"1\":false,\"2\":false,\"3\":false},\"post_inc_userposts\":{\"1\":false,\"2\":false,\"3\":false},\"post_noflood\":{\"1\":false,\"2\":false,\"3\":false},\"post_viewip\":{\"1\":false,\"2\":false,\"3\":false},\"search_noflood\":false,\"topic_create\":{\"1\":false,\"2\":false,\"3\":false},\"topic_delete\":{\"1\":false,\"2\":false,\"3\":false},\"topic_delete_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_edit\":{\"1\":false,\"2\":false,\"3\":false},\"topic_edit_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_global\":false,\"topic_lock\":{\"1\":false,\"2\":false,\"3\":false},\"topic_lock_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_move\":{\"1\":false,\"2\":false,\"3\":false},\"topic_move_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_pin\":{\"1\":false,\"2\":false,\"3\":false},\"topic_pin_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_publish\":{\"1\":false,\"2\":false,\"3\":false},\"topic_publish_auto\":{\"1\":false,\"2\":false,\"3\":false},\"topic_split\":{\"1\":false,\"2\":false,\"3\":false},\"topic_split_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unlock\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unlock_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unpin\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unpin_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_view\":{\"1\":true,\"2\":true,\"3\":true},\"topic_view_unpublished\":{\"1\":false,\"2\":false,\"3\":false}}',
				'{\"add_category\":false,\"approve_files\":false,\"category_view\":true,\"delete_category\":false,\"delete_files\":false,\"download_files\":true,\"edit_category\":false,\"edit_files\":false,\"move_files\":false,\"post_comment\":false,\"upload_files\":false}'
)";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type, group_format, group_perms, group_file_perms) VALUES (4, 'Banned', 'BANNED', '%%s',
				'{\"board_view\":false,\"board_view_closed\":false,\"do_anything\":false,\"edit_avatar\":false,\"edit_profile\":false,\"edit_sig\":false,\"email_use\":false,\"forum_view\":{\"1\":false,\"2\":false,\"3\":false},\"is_admin\":false,\"page_create\":false,\"page_delete\":false,\"page_edit\":false,\"pm_noflood\":false,\"poll_create\":{\"1\":false,\"2\":false,\"3\":false},\"poll_vote\":{\"1\":false,\"2\":false,\"3\":false},\"post_attach\":{\"1\":false,\"2\":false,\"3\":false},\"post_attach_download\":{\"1\":false,\"2\":false,\"3\":false},\"post_create\":{\"1\":false,\"2\":false,\"3\":false},\"post_delete\":{\"1\":false,\"2\":false,\"3\":false},\"post_delete_old\":{\"1\":false,\"2\":false,\"3\":false},\"post_delete_own\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit_old\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit_own\":{\"1\":false,\"2\":false,\"3\":false},\"post_inc_userposts\":{\"1\":false,\"2\":false,\"3\":false},\"post_noflood\":{\"1\":false,\"2\":false,\"3\":false},\"post_viewip\":{\"1\":false,\"2\":false,\"3\":false},\"search_noflood\":false,\"topic_create\":{\"1\":false,\"2\":false,\"3\":false},\"topic_delete\":{\"1\":false,\"2\":false,\"3\":false},\"topic_delete_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_edit\":{\"1\":false,\"2\":false,\"3\":false},\"topic_edit_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_global\":false,\"topic_lock\":{\"1\":false,\"2\":false,\"3\":false},\"topic_lock_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_move\":{\"1\":false,\"2\":false,\"3\":false},\"topic_move_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_pin\":{\"1\":false,\"2\":false,\"3\":false},\"topic_pin_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_publish\":{\"1\":false,\"2\":false,\"3\":false},\"topic_publish_auto\":{\"1\":false,\"2\":false,\"3\":false},\"topic_split\":{\"1\":false,\"2\":false,\"3\":false},\"topic_split_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unlock\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unlock_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unpin\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unpin_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_view\":{\"1\":false,\"2\":false,\"3\":false},\"topic_view_unpublished\":{\"1\":false,\"2\":false,\"3\":false}}',
				'{\"add_category\":false,\"approve_files\":false,\"category_view\":false,\"delete_category\":false,\"delete_files\":false,\"download_files\":false,\"edit_category\":false,\"edit_files\":false,\"move_files\":false,\"post_comment\":false,\"upload_files\":false}'
)";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type, group_format, group_perms, group_file_perms) VALUES (5, 'Awaiting Activation', 'AWAIT', '%%s',
				'{\"board_view\":true,\"board_view_closed\":false,\"do_anything\":true,\"edit_avatar\":true,\"edit_profile\":false,\"edit_sig\":false,\"email_use\":false,\"forum_view\":{\"1\":false,\"2\":false,\"3\":true},\"is_admin\":false,\"page_create\":false,\"page_delete\":false,\"page_edit\":false,\"pm_noflood\":false,\"poll_create\":{\"1\":false,\"2\":false,\"3\":false},\"poll_vote\":{\"1\":false,\"2\":false,\"3\":false},\"post_attach\":{\"1\":false,\"2\":false,\"3\":false},\"post_attach_download\":{\"1\":false,\"2\":false,\"3\":false},\"post_create\":{\"1\":false,\"2\":false,\"3\":false},\"post_delete\":{\"1\":false,\"2\":false,\"3\":false},\"post_delete_old\":{\"1\":false,\"2\":false,\"3\":false},\"post_delete_own\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit_old\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit_own\":{\"1\":false,\"2\":false,\"3\":false},\"post_inc_userposts\":{\"1\":false,\"2\":false,\"3\":false},\"post_noflood\":{\"1\":false,\"2\":false,\"3\":false},\"post_viewip\":{\"1\":false,\"2\":false,\"3\":false},\"search_noflood\":false,\"topic_create\":{\"1\":false,\"2\":false,\"3\":false},\"topic_delete\":{\"1\":false,\"2\":false,\"3\":false},\"topic_delete_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_edit\":{\"1\":false,\"2\":false,\"3\":false},\"topic_edit_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_global\":false,\"topic_lock\":{\"1\":false,\"2\":false,\"3\":false},\"topic_lock_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_move\":{\"1\":false,\"2\":false,\"3\":false},\"topic_move_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_pin\":{\"1\":false,\"2\":false,\"3\":false},\"topic_pin_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_publish\":{\"1\":false,\"2\":false,\"3\":false},\"topic_publish_auto\":{\"1\":false,\"2\":false,\"3\":false},\"topic_split\":{\"1\":false,\"2\":false,\"3\":false},\"topic_split_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unlock\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unlock_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unpin\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unpin_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_view\":{\"1\":false,\"2\":false,\"3\":true},\"topic_view_unpublished\":{\"1\":false,\"2\":false,\"3\":false}}',
				'{\"add_category\":false,\"approve_files\":false,\"category_view\":true,\"delete_category\":false,\"delete_files\":false,\"download_files\":true,\"edit_category\":false,\"edit_files\":false,\"move_files\":false,\"post_comment\":false,\"upload_files\":false}'
)";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type, group_format, group_perms, group_file_perms) VALUES (6, 'Moderators', 'MODS', '<b>%%s</b>',
				'{\"board_view\":true,\"board_view_closed\":true,\"do_anything\":true,\"edit_avatar\":true,\"edit_profile\":true,\"edit_sig\":true,\"email_use\":true,\"forum_view\":{\"1\":true,\"2\":false,\"3\":true},\"is_admin\":false,\"page_create\":false,\"page_delete\":false,\"page_edit\":true,\"pm_noflood\":true,\"poll_create\":{\"1\":true,\"2\":false,\"3\":true},\"poll_vote\":{\"1\":true,\"2\":false,\"3\":true},\"post_attach\":{\"1\":true,\"2\":false,\"3\":true},\"post_attach_download\":{\"1\":true,\"2\":true,\"3\":true},\"post_create\":{\"1\":true,\"2\":true,\"3\":true},\"post_delete\":{\"1\":true,\"2\":false,\"3\":true},\"post_delete_old\":{\"1\":true,\"2\":false,\"3\":true},\"post_delete_own\":{\"1\":false,\"2\":false,\"3\":false},\"post_edit\":{\"1\":true,\"2\":false,\"3\":true},\"post_edit_old\":{\"1\":true,\"2\":false,\"3\":true},\"post_edit_own\":{\"1\":false,\"2\":false,\"3\":false},\"post_inc_userposts\":{\"1\":true,\"2\":false,\"3\":true},\"post_noflood\":{\"1\":true,\"2\":false,\"3\":true},\"post_viewip\":{\"1\":true,\"2\":false,\"3\":true},\"search_noflood\":true,\"topic_create\":{\"1\":true,\"2\":false,\"3\":true},\"topic_delete\":{\"1\":true,\"2\":false,\"3\":true},\"topic_delete_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_edit\":{\"1\":true,\"2\":false,\"3\":true},\"topic_edit_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_global\":true,\"topic_lock\":{\"1\":true,\"2\":false,\"3\":true},\"topic_lock_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_move\":{\"1\":true,\"2\":false,\"3\":true},\"topic_move_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_pin\":{\"1\":true,\"2\":false,\"3\":true},\"topic_pin_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_publish\":{\"1\":true,\"2\":false,\"3\":true},\"topic_publish_auto\":{\"1\":true,\"2\":false,\"3\":true},\"topic_split\":{\"1\":true,\"2\":false,\"3\":true},\"topic_split_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unlock\":{\"1\":true,\"2\":false,\"3\":true},\"topic_unlock_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_unpin\":{\"1\":true,\"2\":false,\"3\":true},\"topic_unpin_own\":{\"1\":false,\"2\":false,\"3\":false},\"topic_view\":{\"1\":true,\"2\":false,\"3\":true},\"topic_view_unpublished\":{\"1\":true,\"2\":false,\"3\":true}}',
				'{\"add_category\":true,\"approve_files\":true,\"category_view\":true,\"delete_category\":true,\"delete_files\":true,\"download_files\":true,\"edit_category\":true,\"edit_files\":true,\"move_files\":true,\"post_comment\":true,\"upload_files\":true}'
)";

$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (1, 'Newbie', 0, '1.png')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (2, 'Member', 25, '2.png')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (3, 'Droplet', 100, '3.png')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (4, 'Puddle', 250, '4.png')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (5, 'Pool', 500, '5.png')";

$sets = array();
$settings = json_encode( $sets );
$queries[] = "INSERT INTO %psettings (settings_id, settings_version, settings_data, settings_tos, settings_tos_files, settings_meta_keywords, settings_meta_description, settings_mobile_icons) VALUES (1, 2, '{$settings}', '', '', '', '', '')";
$queries[] = "INSERT INTO %pskins (skin_name, skin_dir, skin_enabled) VALUES ('Ashlander 4', 'default', 1)";
$queries[] = "INSERT INTO %pusers (user_id, user_name, user_group, user_signature) VALUES (1, 'Guest', 3, '')";
$queries[] = "INSERT INTO %pfile_categories (fcat_id, fcat_name, fcat_longpath) VALUES (0, 'Root', '/')";
$queries[] = "UPDATE %pfile_categories SET fcat_id=0";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':alien:', 'alien.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':biggrin:', 'biggrin.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':blues:', 'blues.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':cool:', 'cool.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':cry:', 'cry.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':cyclops:', 'cyclops.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':devil:', 'devil.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':evil:', 'evil.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':ghostface:', 'ghostface.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':grinning:', 'grinning.png', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':lol:', 'lol.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':mad:', 'angry.png', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':redface:', 'redface.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':robot:', 'robot.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':rolleyes:', 'rolleyes.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':sad:', 'sad.png', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':smile:', 'smile.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':stare:', 'stare.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':surprised:', 'surprised.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':thinking:', 'thinking.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':tongue:', 'tongue.png', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':unclesam:', 'unclesam.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':wink:', 'wink.png', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':huh:', 'huh.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':blink:', 'blink.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':facepalm:', 'facepalm.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':whistle:', 'whistle.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':sick:', 'sick.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':headbang:', 'headbang.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':innocent:', 'innocent.png', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':crazy:', 'crazy.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':rofl:', 'rofl.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':lmao:', 'lmao.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':shrug:', 'shrug.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':ninja:', 'ninja.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':nuke:', 'nuke.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':wub:', 'wub.png', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':imp:', 'imp.png', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':banana:', 'dancingbanana.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':cricket:', 'cricket.png', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':troll:', 'trollface.png', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':(', 'sad.png', 0 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':P', 'tongue.png', 0 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (';)', 'wink.png', 0 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':)', 'smile.gif', 0 )";
?>