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

$queries[] = "DROP TABLE IF EXISTS %pactive";
$queries[] = "CREATE TABLE %pactive (
  active_id int(10) unsigned NOT NULL default '0',
  active_name varchar(32) NOT NULL default '',
  active_ip varchar(15) NOT NULL default 'Unknown',
  active_user_agent varchar(100) NOT NULL default 'Unknown',
  active_is_member tinyint(1) unsigned NOT NULL default '1',
  active_action varchar(32) NOT NULL default '',
  active_time int(10) unsigned NOT NULL default '0',
  PRIMARY KEY (active_id)
) TYPE=MyISAM";

$queries[] = "ALTER TABLE %pforums
CHANGE FID forum_id smallint(4) unsigned NOT NULL auto_increment,
CHANGE Parent forum_parent smallint(4) unsigned NOT NULL DEFAULT '0',
CHANGE Tree Tree varchar(255) NOT NULL,
CHANGE FName forum_name varchar(255) NOT NULL,
CHANGE Position Position smallint(4) unsigned NOT NULL DEFAULT '0',
CHANGE LastPostID forum_lastpost int(12) unsigned NOT NULL DEFAULT '0',
DROP VisibleTo,
DROP allow_reply,
DROP allow_create,
DROP allow_poll,
DROP cf,
DROP INDEX Parent, ADD INDEX Parent (forum_parent),
DROP PRIMARY KEY, ADD PRIMARY KEY (forum_id)";

$queries[] = "DROP TABLE IF EXISTS %pgroups";
$queries[] = "CREATE TABLE %pgroups (
  group_id tinyint(3) unsigned NOT NULL auto_increment,
  group_name varchar(255) NOT NULL default '',
  group_type varchar(20) NOT NULL default '',
  PRIMARY KEY (group_id)
) TYPE=MyISAM AUTO_INCREMENT=5";

$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type) VALUES (1, 'Administrators', 'ADMIN')";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type) VALUES (2, 'Members', 'MEMBER')";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type) VALUES (3, 'Guests', 'GUEST')";
$queries[] = "INSERT INTO %pgroups (group_id, group_name, group_type) VALUES (4, 'Banned', 'BANNED')";

$queries[] = "ALTER TABLE %phelp
CHANGE hid help_id smallint(3) NOT NULL auto_increment,
CHANGE title help_title varchar(255) NOT NULL,
CHANGE article help_article text NOT NULL,
DROP PRIMARY KEY, ADD PRIMARY KEY (help_id)";

$queries[] = "ALTER TABLE %pmembertitles
ADD PRIMARY KEY (TitleID),
DROP INDEX TitleID";

$queries[] = "RENAME TABLE %pmembers TO %pusers";
$queries[] = "ALTER TABLE %pusers
CHANGE MemberGroup MemberGroup tinyint(3) unsigned NOT NULL default '2',
DROP Flood,
DROP cf";

$queries[] = "UPDATE %pusers SET MemberGroup=2 WHERE MemberGroup > 4";
$queries[] = "DELETE FROM %pusers WHERE UID=0 OR Name='Guest'";
$queries[] = "INSERT INTO %pusers (UID, Name, Password, Joined, Level, MemTitle, MemberGroup, Skin, language, Avatar, avatar_type, AvWidth, AvHeight, Email, ShowEmail, Birthday, TimeAdjust, Homepage, Posts, Location, ICQ, MSN, AIM, PM, Yahoo, Interests, Signature, LastVisit, LastPost, ViewAvs, ViewSigs, ViewEmots) VALUES (1, 'Guest', '', 0, 0, '', 3, 'default', 'en', '', 'none', 0, 0, '', 0, '0000-00-00', '0.0', '', 0, '', 0, '', '', 0, '', '', '', 0, 0, 1, 1, 1)";

$queries[] = "DROP TABLE IF EXISTS %pmods";

$queries[] = "CREATE TABLE %pperms (
perms_perm varchar(255) NOT NULL,
perms_forum_id smallint(4) unsigned NOT NULL DEFAULT '0',
perms_group_id tinyint(3) unsigned NOT NULL DEFAULT '0',
perms_user_id int(10) unsigned NOT NULL DEFAULT '0'
) TYPE=MyISAM";

$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('board_view', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('board_view_closed', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('do_anything', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('forum_view', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('is_admin', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('poll_create', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('poll_vote', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('post_create', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('post_delete', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('post_delete_own', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('post_edit', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('post_edit_own', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('post_noflood', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('post_viewip', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_create', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_delete', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_delete_own', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_edit', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_edit_own', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_lock', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_lock_own', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_move', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_move_own', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_pin', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_pin_own', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_unlock', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_unlock_mod', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_unlock_own', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_unpin', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_unpin_own', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_view', 0, 1, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('board_view', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('do_anything', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('forum_view', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('poll_create', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('poll_vote', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('post_create', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('post_delete_own', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('post_edit_own', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_create', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_delete_own', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_edit_own', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_lock_own', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_move_own', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_pin_own', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_unlock_own', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_unpin_own', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_view', 0, 2, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('board_view', 0, 3, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('do_anything', 0, 3, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('forum_view', 0, 3, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('poll_vote', 0, 3, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('post_create', 0, 3, 0)";
$queries[] = "INSERT INTO %pperms (perms_perm, perms_forum_id, perms_group_id, perms_user_id) VALUES ('topic_view', 0, 3, 0)";

$queries[] = "DROP TABLE IF EXISTS %ppolls";

$queries[] = "ALTER TABLE %pposts
CHANGE PID post_id int(12) unsigned NOT NULL auto_increment,
DROP Forum,
CHANGE PStarter post_author int(10) unsigned NOT NULL DEFAULT '0',
CHANGE Emoticons post_emoticons tinyint(1) unsigned NOT NULL DEFAULT '1',
CHANGE Code post_mbcode tinyint(1) unsigned NOT NULL DEFAULT '1',
CHANGE Post_IP post_ip varchar(15) NOT NULL default 'Unknown',
CHANGE PostIcon post_icon tinyint(3) NOT NULL DEFAULT '-1',
CHANGE EditedBy post_edited_by varchar(32) NOT NULL,
CHANGE EditedTime post_edited_time int(10) unsigned NOT NULL DEFAULT '0',
DROP INDEX ID,
ADD PRIMARY KEY (post_id),
ADD INDEX Topic (Topic),
DROP INDEX TopicForum";

$queries[] = "UPDATE %pposts SET post_author=1 WHERE post_author=0";

$queries[] = "ALTER TABLE %preplacements
ADD PRIMARY KEY (RID),
DROP INDEX RID";

$queries[] = "ALTER TABLE %psearchwords
CHANGE post searchwords_post int(12) unsigned NOT NULL DEFAULT '0',
CHANGE word searchwords_word varchar(50) NOT NULL,
ADD INDEX searchwords_word (searchwords_word),
DROP INDEX word";

$queries[] = "ALTER TABLE %pskins
CHANGE SkinName skin_name varchar(32) NOT NULL,
CHANGE SkinDir skin_dir varchar(32) NOT NULL,
DROP INDEX Dir,
ADD PRIMARY KEY (skin_dir)";

$queries[] = "ALTER TABLE %ptemplates
CHANGE Template template_skin varchar(32) NOT NULL DEFAULT 'default',
CHANGE Section template_set varchar(20) NOT NULL,
CHANGE Piece template_name varchar(36) NOT NULL,
CHANGE Code template_html text NOT NULL,
CHANGE printName template_displayname varchar(255) NOT NULL,
DROP INDEX Piece, ADD UNIQUE Piece (template_name,template_skin),
DROP INDEX Section, ADD INDEX Section (template_set,template_skin)";

$queries[] = "ALTER TABLE %ptopics
CHANGE Description Description varchar(35) NOT NULL,
ADD modes int(10) unsigned NOT NULL DEFAULT '0',
DROP State,
ADD moved smallint(3) unsigned NOT NULL DEFAULT '0',
DROP Pinned,
DROP Poll,
ADD poll_options text NOT NULL,
DROP INDEX ID,
ADD PRIMARY KEY (TID)";

$queries[] = "ALTER TABLE %pvotes
DROP Vote_ID,
CHANGE User_ID vote_user int(10) unsigned NOT NULL DEFAULT '0',
CHANGE Vote_Poll_ID vote_topic int(10) unsigned NOT NULL DEFAULT '0',
CHANGE VotedFor vote_option smallint(4) NOT NULL DEFAULT '-1',
DROP Vote_Poll_Forum,
DROP PRIMARY KEY, ADD PRIMARY KEY (vote_user,vote_topic),
DROP INDEX Vote_Poll_ID";
?>
