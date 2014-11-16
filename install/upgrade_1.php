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

/* active */
$queries[] = "ALTER TABLE active MODIFY Member TINYINT(1) unsigned NOT NULL default '1'";
$queries[] = "ALTER TABLE active MODIFY Action VARCHAR(32) NOT NULL";
$queries[] = "ALTER TABLE active MODIFY Time INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE active RENAME %pactive";

/* forums */
$queries[] = "ALTER TABLE forums MODIFY FID SMALLINT(3) unsigned NOT NULL auto_increment";
$queries[] = "ALTER TABLE forums MODIFY Parent SMALLINT(3) unsigned NOT NULL";
$queries[] = "ALTER TABLE forums MODIFY Tree VARCHAR(100) NOT NULL";
$queries[] = "ALTER TABLE forums MODIFY Position TINYINT(3) unsigned NOT NULL";
$queries[] = "ALTER TABLE forums MODIFY Description VARCHAR(255) NOT NULL";
$queries[] = "ALTER TABLE forums MODIFY Topics INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE forums MODIFY Replies INT(12) unsigned NOT NULL";
$queries[] = "ALTER TABLE forums DROP INDEX Cat";
$queries[] = "ALTER TABLE forums ADD INDEX Parent (Parent)";
$queries[] = "ALTER TABLE forums RENAME %pforums";

/* members */
$queries[] = "ALTER TABLE members MODIFY Joined INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE members MODIFY Level TINYINT(3) unsigned NOT NULL default '1'";
$queries[] = "ALTER TABLE members MODIFY MemTitle VARCHAR(100) NOT NULL";
$queries[] = "ALTER TABLE members MODIFY MemberGroup VARCHAR(100) NOT NULL default '4'";
$queries[] = "ALTER TABLE members MODIFY AvWidth SMALLINT(3) unsigned NOT NULL";
$queries[] = "ALTER TABLE members MODIFY AvHeight SMALLINT(3) unsigned NOT NULL";
$queries[] = "ALTER TABLE members MODIFY Email VARCHAR(100) NOT NULL";
$queries[] = "ALTER TABLE members MODIFY Birthday DATE NOT NULL";
$queries[] = "ALTER TABLE members MODIFY ICQ INT(16) unsigned NOT NULL";
$queries[] = "ALTER TABLE members MODIFY MSN VARCHAR(32) NOT NULL";
$queries[] = "ALTER TABLE members MODIFY AIM VARCHAR(16) NOT NULL";
$queries[] = "ALTER TABLE members MODIFY Interests VARCHAR(255) NOT NULL";
$queries[] = "ALTER TABLE members MODIFY LastVisit INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE members MODIFY cf TINYINT(1) unsigned NOT NULL  default '1'";
$queries[] = "ALTER TABLE members ADD Skin VARCHAR(32) NOT NULL default 'default' AFTER MemberGroup";
$queries[] = "ALTER TABLE members ADD ShowEmail TINYINT(1) unsigned NOT NULL default '1' AFTER Email";
$queries[] = "ALTER TABLE members ADD TimeAdjust FLOAT(3,1) NOT NULL default '0.0' AFTER Birthday";
$queries[] = "ALTER TABLE members ADD PM TINYINT(1) unsigned NOT NULL default '1' AFTER AIM";
$queries[] = "ALTER TABLE members ADD LastPost INT(10) unsigned NOT NULL AFTER LastVisit";
$queries[] = "ALTER TABLE members ADD ViewAvs TINYINT(1) unsigned NOT NULL default '1' AFTER LastPost";
$queries[] = "ALTER TABLE members ADD ViewSigs TINYINT(1) unsigned NOT NULL default '1' AFTER ViewAvs";
$queries[] = "ALTER TABLE members ADD ViewEmots TINYINT(1) unsigned NOT NULL default '1' AFTER ViewSigs";
$queries[] = "ALTER TABLE members ADD Flood TINYINT(3) NOT NULL AFTER ViewEmots";
$queries[] = "ALTER TABLE members DROP INDEX Name";
$queries[] = "ALTER TABLE members RENAME %pmembers";
$queries[] = "DELETE FROM %pmembers WHERE Name='Guest' OR UID=0";
$queries[] = "INSERT INTO %pmembers VALUES (1, 'Guest', '', 0, 3, 'Droplet', '3', 'default', '', 0, 0, 'guest@quicksilverforums.com', 1, '0000-00-00', '-5.0', '', 133, '', 0, '', '', 1, '', '', '', 1013503450, 1013739454, 1, 1, 1, 0, 1)";

/* pmsystem */
$queries[] = "ALTER TABLE pmsystem MODIFY ToWho INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE pmsystem MODIFY FromWho INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE pmsystem MODIFY Time INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE pmsystem MODIFY Viewed TINYINT(1) unsigned NOT NULL";
$queries[] = "ALTER TABLE pmsystem MODIFY Folder TINYINT(1) unsigned NOT NULL";
$queries[] = "ALTER TABLE pmsystem DROP INDEX ToWho";
$queries[] = "ALTER TABLE pmsystem ADD INDEX NewPMs (ToWho, Viewed, Folder)";
$queries[] = "ALTER TABLE pmsystem RENAME %ppmsystem";

/* poll_votes */
$queries[] = "ALTER TABLE poll_votes MODIFY Vote_ID INT(10) unsigned NOT NULL auto_increment";
$queries[] = "ALTER TABLE poll_votes MODIFY Vote_Poll_ID INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE poll_votes MODIFY Vote_Poll_Forum SMALLINT(3) unsigned NOT NULL";
$queries[] = "ALTER TABLE poll_votes MODIFY VotedFor TINYINT(3) NOT NULL";
$queries[] = "ALTER TABLE poll_votes RENAME %pvotes";

/* polls */
$queries[] = "ALTER TABLE polls MODIFY Poll_ID INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE polls MODIFY Poll_Forum SMALLINT(3) unsigned NOT NULL";
$queries[] = "ALTER TABLE polls MODIFY Votes SMALLINT(4) unsigned NOT NULL";
$queries[] = "ALTER TABLE polls MODIFY PollOnly TINYINT(1) unsigned NOT NULL";
$queries[] = "ALTER TABLE polls RENAME %ppolls";

/* posts */
$queries[] = "ALTER TABLE posts MODIFY Forum SMALLINT(3) unsigned NOT NULL";
$queries[] = "ALTER TABLE posts MODIFY Topic INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE posts MODIFY PStarter INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE posts MODIFY Emoticons TINYINT(1) unsigned NOT NULL default '1'";
$queries[] = "ALTER TABLE posts MODIFY Code TINYINT(1) unsigned NOT NULL default '1'";
$queries[] = "ALTER TABLE posts MODIFY Time INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE posts DROP INDEX Topic";
$queries[] = "ALTER TABLE posts DROP INDEX Forum";
$queries[] = "ALTER TABLE posts DROP INDEX Time";
$queries[] = "ALTER TABLE posts ADD PostIcon TINYINT(3) NOT NULL default '-1' AFTER Time";
$queries[] = "ALTER TABLE posts ADD INDEX TopicForum (Topic, Forum)";
$queries[] = "ALTER TABLE posts RENAME %pposts";

/* replacements */
$queries[] = "ALTER TABLE replacements MODIFY RID SMALLINT(3) unsigned NOT NULL auto_increment";
$queries[] = "ALTER TABLE replacements MODIFY Search VARCHAR(50) NOT NULL";
$queries[] = "ALTER TABLE replacements ADD Clickable TINYINT(1) unsigned NOT NULL AFTER Type";
$queries[] = "ALTER TABLE replacements RENAME %preplacements";
$queries[] = "INSERT INTO %preplacements VALUES (1, 'shit', '', 'censor', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (2, 'fuck', '', 'censor', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (130, ':love:', 'love.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (131, ':alien:', 'alien.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (132, ':D', 'biggrin.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements VALUES (133, ':blush:', 'blush.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (134, ':bored:', 'bored.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (135, ':confused:', 'confused.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements VALUES (136, ':cool:', 'cool.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements VALUES (137, ':crazy:', 'crazy.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (138, ':eh:', 'eh.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements VALUES (139, ':evil:', 'evil.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (140, ':happy:', 'happy.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (141, ':laugh:', 'laugh.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (142, ':!:', '!.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements VALUES (143, ':mad:', 'mad.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements VALUES (144, ':plain:', 'plain.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (145, ':rolleyes:', 'rolleyes.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (146, ':(', 'sad.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements VALUES (147, ':shocked:', 'shocked.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements VALUES (148, ':sleeping:', 'sleeping.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (149, ':sly:', 'sly.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements VALUES (150, ':)', 'smile.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements VALUES (151, ':stupid:', 'stupid.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (152, ':thumbs:', 'thumbs.gif', 'emoticon', 0)";
$queries[] = "INSERT INTO %preplacements VALUES (153, ':p', 'tongue.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements VALUES (154, ';)', 'wink.gif', 'emoticon', 1)";

/* templates */
$queries[] = "DROP TABLE IF EXISTS templates";
$queries[] = "CREATE TABLE %ptemplates (
  Template varchar(32) NOT NULL default 'DEFAULT',
  Section varchar(20) NOT NULL default '',
  Piece varchar(36) NOT NULL default '',
  Code text NOT NULL,
  printName varchar(255) NOT NULL default '',
  Description varchar(255) NOT NULL default '',
  Position tinyint(2) unsigned NOT NULL default '0',
  UNIQUE KEY Piece (Piece,Template),
  KEY Section (Section,Template)
)";

/* topics */
$queries[] = "ALTER TABLE topics MODIFY Forum SMALLINT(3) unsigned NOT NULL";
$queries[] = "ALTER TABLE topics MODIFY Icon TINYINT(3) NOT NULL default '-1'";
$queries[] = "ALTER TABLE topics MODIFY Edited INT(10) unsigned NOT NULL";
$queries[] = "ALTER TABLE topics MODIFY Replies SMALLINT(5) unsigned NOT NULL";
$queries[] = "ALTER TABLE topics MODIFY Views SMALLINT(5) unsigned NOT NULL";
$queries[] = "ALTER TABLE topics MODIFY State TINYINT(1) unsigned NOT NULL";
$queries[] = "ALTER TABLE topics MODIFY Pinned TINYINT(1) unsigned NOT NULL";
$queries[] = "ALTER TABLE topics MODIFY Poll TINYINT(1) unsigned NOT NULL";
$queries[] = "ALTER TABLE topics DROP INDEX Edited";
$queries[] = "ALTER TABLE topics RENAME %ptopics";

/* settings */
$queries[] = "DROP TABLE IF EXISTS settings";

/* groups */
$queries[] = "DROP TABLE IF EXISTS groups";
$queries[] = "CREATE TABLE %pgroups (
  GID TINYINT(3) unsigned NOT NULL auto_increment,
  Internal VARCHAR(20) NOT NULL default '',
  GName VARCHAR(255) NOT NULL default '',
  AdminCP TINYINT(1) unsigned NOT NULL default '0',
  Reply TINYINT(1) unsigned NOT NULL default '1',
  NewTopic TINYINT(1) unsigned NOT NULL default '1',
  NewPoll TINYINT(1) unsigned NOT NULL default '1',
  ViewAnything TINYINT(1) unsigned NOT NULL default '1',
  ViewBoard TINYINT(1) unsigned NOT NULL default '1',
  ViewForum TINYINT(1) unsigned NOT NULL default '1',
  ViewTopic TINYINT(1) unsigned NOT NULL default '1',
  ViewClosed TINYINT(1) unsigned NOT NULL default '0',
  EditPosts TINYINT(1) unsigned NOT NULL default '0',
  EditOwnPosts TINYINT(1) unsigned NOT NULL default '1',
  DeletePosts TINYINT(1) unsigned NOT NULL default '0',
  DeleteOwnPosts TINYINT(1) unsigned NOT NULL default '1',
  PinTopics TINYINT(1) unsigned NOT NULL default '0',
  PinOwnTopics TINYINT(1) unsigned NOT NULL default '0',
  UnpinTopics TINYINT(1) unsigned NOT NULL default '0',
  UnpinOwnTopics TINYINT(1) unsigned NOT NULL default '0',
  LockTopics TINYINT(1) unsigned NOT NULL default '0',
  LockOwnTopics TINYINT(1) unsigned NOT NULL default '0',
  UnlockTopics TINYINT(1) unsigned NOT NULL default '0',
  UnlockOwnTopics TINYINT(1) unsigned NOT NULL default '0',
  UnlockMod TINYINT(1) unsigned NOT NULL default '0',
  DeleteTopics TINYINT(1) unsigned NOT NULL default '0',
  DeleteOwnTopics TINYINT(1) unsigned NOT NULL default '0',
  EditTopics TINYINT(1) unsigned NOT NULL default '0',
  EditOwnTopics TINYINT(1) unsigned NOT NULL default '1',
  NoFlood TINYINT(1) unsigned NOT NULL default '0',
  ViewIP TINYINT(1) unsigned NOT NULL default '0',
  Vote TINYINT(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (GID)
)";
$queries[] = "INSERT INTO %pgroups VALUES (1, 'ADMIN', 'Administrators', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)";
$queries[] = "INSERT INTO %pgroups VALUES (2, 'MEMBER', 'Members', 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 1)";
$queries[] = "INSERT INTO %pgroups VALUES (3, 'GUEST', 'Guests', 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1)";
$queries[] = "INSERT INTO %pgroups VALUES (5, 'AWAITING', 'Awaiting Activation', 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1)";
$queries[] = "INSERT INTO %pgroups VALUES (6, 'MOD', 'Global Moderators', 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)";
$queries[] = "INSERT INTO %pgroups VALUES (7, 'BANNED', 'Banned', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";

/* membertitles */
$queries[] = "CREATE TABLE %pmembertitles (
  TitleID TINYINT(3) unsigned NOT NULL auto_increment,
  Title VARCHAR(50) NOT NULL default '',
  Posts INT(10) unsigned NOT NULL default '0',
  Icon VARCHAR(25) NOT NULL default '',
  KEY TitleID (TitleID),
  KEY Posts (Posts)
)";
$queries[] = "INSERT INTO %pmembertitles VALUES (1, 'Newbie', 0, '1.gif')";
$queries[] = "INSERT INTO %pmembertitles VALUES (2, 'Member', 25, '2.gif')";
$queries[] = "INSERT INTO %pmembertitles VALUES (3, 'Droplet', 100, '3.gif')";
$queries[] = "INSERT INTO %pmembertitles VALUES (4, 'Puddle', 250, '4.gif')";
$queries[] = "INSERT INTO %pmembertitles VALUES (5, 'Pool', 500, '5.gif')";
$queries[] = "INSERT INTO %pmembertitles VALUES (6, 'Addict', 1000, '6.gif')";

/* mods */
$queries[] = "CREATE TABLE %pmods (
  Forum SMALLINT(3) unsigned NOT NULL default '0',
  ModID INT(10) unsigned NOT NULL default '0',
  CanLock TINYINT(1) unsigned NOT NULL default '0',
  ViewIP TINYINT(1) unsigned NOT NULL default '0',
  CanUnlock TINYINT(1) unsigned NOT NULL default '0',
  Pin TINYINT(1) unsigned NOT NULL default '0',
  Unpin TINYINT(1) unsigned NOT NULL default '0',
  CanDelete TINYINT(1) unsigned NOT NULL default '0',
  Move TINYINT(1) unsigned NOT NULL default '0',
  Edit TINYINT(1) unsigned NOT NULL default '0',
  EditPosts TINYINT(1) unsigned NOT NULL default '0',
  DeletePosts TINYINT(1) unsigned NOT NULL default '0',
  KEY Forum (Forum,ModID)
)";

/* skins */
$queries[] = "CREATE TABLE %pskins (
  SkinName VARCHAR(32) NOT NULL default '',
  SkinDir VARCHAR(32) NOT NULL default '',
  KEY Dir (SkinDir)
)";
$queries[] = "INSERT INTO %pskins VALUES ('Candy Corn (Default)', 'default')";
?>
