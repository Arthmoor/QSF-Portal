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
	exit('Use index.php to upgrade.');
}

$need_templates = true;

$queries[] = "ALTER TABLE %pactive
DROP active_name,
DROP active_is_member";

$queries[] = "DROP TABLE IF EXISTS %pattach";
$queries[] = "CREATE TABLE %pattach (
  attach_id int(12) unsigned NOT NULL auto_increment,
  attach_file varchar(32) NOT NULL default '',
  attach_name varchar(255) NOT NULL default '',
  attach_post int(12) unsigned NOT NULL default '0',
  attach_downloads int(10) unsigned NOT NULL default '0',
  attach_size int(8) unsigned NOT NULL default '0',
  PRIMARY KEY (attach_id),
  KEY attach_post (attach_post)
) TYPE=MyISAM";

$queries[] = "ALTER TABLE %pforums
CHANGE Tree forum_tree varchar(255) NOT NULL default '',
CHANGE Position forum_position smallint(4) unsigned NOT NULL default '0',
CHANGE Description forum_description varchar(255) NOT NULL default '',
CHANGE Topics forum_topics int(10) unsigned NOT NULL default '0',
CHANGE Replies forum_replies int(12) unsigned NOT NULL default '0'";

$queries[] = "ALTER TABLE %pgroups
ADD group_format varchar(255) NOT NULL default ''";

$queries[] = "DROP TABLE IF EXISTS %pmembertitles";
$queries[] = "CREATE TABLE %pmembertitles (
  membertitle_id tinyint(3) unsigned NOT NULL auto_increment,
  membertitle_title varchar(50) NOT NULL default '',
  membertitle_posts int(10) unsigned NOT NULL default '0',
  membertitle_icon varchar(25) NOT NULL default '',
  PRIMARY KEY (membertitle_id),
  KEY Posts (membertitle_posts)
) TYPE=MyISAM";

$queries[] = "ALTER TABLE %ppmsystem
CHANGE PMID pm_id int(10) unsigned NOT NULL auto_increment,
CHANGE ToWho pm_to int(10) unsigned NOT NULL default '0',
CHANGE FromWho pm_from int(10) unsigned NOT NULL default '0',
CHANGE Title pm_title varchar(255) NOT NULL default '[No Title]',
CHANGE Time pm_time int(10) unsigned NOT NULL default '0',
CHANGE Message pm_message text NOT NULL,
CHANGE Viewed pm_read tinyint(1) unsigned NOT NULL default '0',
CHANGE Folder pm_folder tinyint(1) unsigned NOT NULL default '0',
DROP PRIMARY KEY,
DROP INDEX NewPMs,
ADD PRIMARY KEY (pm_id),
ADD KEY NewPMs (pm_to,pm_read,pm_folder)";

$queries[] = "ALTER TABLE %pposts
CHANGE Topic post_topic int(10) unsigned NOT NULL default '0',
CHANGE Post post_text text NOT NULL,
CHANGE Time post_time int(10) unsigned NOT NULL default '0',
CHANGE post_icon post_icon varchar(32) NOT NULL default '',
DROP KEY Topic,
ADD KEY Topic (post_topic)";

$queries[] = "DROP TABLE IF EXISTS %preplacements";
$queries[] = "CREATE TABLE %preplacements (
  replacement_id smallint(3) unsigned NOT NULL auto_increment,
  replacement_search varchar(50) NOT NULL default '',
  replacement_replace varchar(50) NOT NULL default '',
  replacement_type varchar(15) NOT NULL default '',
  replacement_clickable tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY (replacement_id),
  KEY Type (replacement_type)
) TYPE=MyISAM";

$queries[] = "DROP TABLE IF EXISTS %psearchwords";

$queries[] = "DROP TABLE IF EXISTS %psubscriptions";
$queries[] = "CREATE TABLE %psubscriptions (
  subscription_user int(10) unsigned NOT NULL default '0',
  subscription_type varchar(10) NOT NULL default '',
  subscription_item int(10) unsigned NOT NULL default '0',
  subscription_expire int(10) unsigned NOT NULL default '0',
  KEY subscription_item (subscription_item)
) TYPE=MyISAM";

$queries[] = "ALTER TABLE %ptemplates
CHANGE Description template_description varchar(255) NOT NULL default '',
CHANGE Position template_position tinyint(2) unsigned NOT NULL default '0'";

$queries[] = "ALTER TABLE %ptopics
CHANGE TID topic_id int(10) unsigned NOT NULL auto_increment,
CHANGE Forum topic_forum smallint(3) unsigned NOT NULL default '0',
CHANGE Title topic_title varchar(75) NOT NULL default '0',
CHANGE Description topic_description varchar(35) NOT NULL default '',
CHANGE StarterID topic_starter int(10) unsigned NOT NULL default '0',
CHANGE last_poster topic_last_poster int(10) unsigned NOT NULL default '0',
CHANGE Icon topic_icon varchar(32) NOT NULL default '',
CHANGE Edited topic_edited int(10) unsigned NOT NULL default '0',
CHANGE Replies topic_replies smallint(5) unsigned NOT NULL default '0',
CHANGE Views topic_views smallint(5) unsigned NOT NULL default '0',
CHANGE modes topic_modes int(10) unsigned NOT NULL default '0',
CHANGE moved topic_moved smallint(3) unsigned NOT NULL default '0',
CHANGE poll_options topic_poll_options text NOT NULL,
DROP PRIMARY KEY,
DROP KEY Forum,
ADD PRIMARY KEY (topic_id),
ADD KEY Forum (topic_forum)";

$queries[] = "ALTER TABLE %pusers
CHANGE UID user_id int(10) unsigned NOT NULL auto_increment,
CHANGE Name user_name varchar(255) NOT NULL default '',
CHANGE Password user_password varchar(32) NOT NULL default '',
CHANGE Joined user_joined int(10) unsigned NOT NULL default '0',
CHANGE Level user_level tinyint(3) unsigned NOT NULL default '1',
CHANGE MemTitle user_title varchar(100) NOT NULL default '',
CHANGE MemberGroup user_group tinyint(3) unsigned NOT NULL default '2',
CHANGE Skin user_skin varchar(32) NOT NULL default 'default',
CHANGE language user_language varchar(6) NOT NULL default 'en',
CHANGE Avatar user_avatar varchar(150) NOT NULL default '',
CHANGE avatar_type user_avatar_type enum('local','url','uploaded','none') NOT NULL default 'none',
CHANGE AvWidth user_avatar_width smallint(3) unsigned NOT NULL default '0',
CHANGE AvHeight user_avatar_height smallint(3) unsigned NOT NULL default '0',
CHANGE Email user_email varchar(100) NOT NULL default '',
CHANGE ShowEmail user_email_show tinyint(1) unsigned NOT NULL default '1',
CHANGE Birthday user_birthday date NOT NULL default '0000-00-00',
CHANGE TimeAdjust user_timezone float(3,1) NOT NULL default '0.0',
CHANGE Homepage user_homepage varchar(255) NOT NULL default '',
CHANGE Posts user_posts int(10) unsigned NOT NULL default '0',
CHANGE Location user_location varchar(100) NOT NULL default '',
CHANGE ICQ user_icq int(16) unsigned NOT NULL default '0',
CHANGE MSN user_msn varchar(32) NOT NULL default '',
CHANGE AIM user_aim varchar(16) NOT NULL default '',
CHANGE PM user_pm tinyint(1) unsigned NOT NULL default '1',
CHANGE Yahoo user_yahoo varchar(100) NOT NULL default '',
CHANGE Interests user_interests varchar(255) NOT NULL default '',
CHANGE Signature user_signature text NOT NULL,
CHANGE LastVisit user_lastvisit int(10) unsigned NOT NULL default '0',
CHANGE LastPost user_lastpost int(10) unsigned NOT NULL default '0',
CHANGE ViewAvs user_view_avatars tinyint(1) unsigned NOT NULL default '1',
CHANGE ViewSigs user_view_signatures tinyint(1) unsigned NOT NULL default '1',
CHANGE ViewEmots user_view_emoticons tinyint(1) unsigned NOT NULL default '1',
DROP PRIMARY KEY,
ADD PRIMARY KEY  (user_id)";

$queries[] = "UPDATE %pgroups SET group_format='%%s'";
$queries[] = "UPDATE %pgroups SET group_format='<b>%%s</b>' WHERE group_id=1";

$queries[] = "UPDATE %ptopics SET topic_icon='' WHERE topic_icon='-1'";
$queries[] = "UPDATE %pposts SET post_icon='' WHERE post_icon='-1'";

$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (1, 'Newbie', 0, '1.gif')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (2, 'Member', 25, '2.gif')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (3, 'Droplet', 100, '3.gif')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (4, 'Puddle', 250, '4.gif')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (5, 'Pool', 500, '5.gif')";
$queries[] = "INSERT INTO %pmembertitles (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon) VALUES (6, 'Addict', 1000, '6.gif')";

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
?>
