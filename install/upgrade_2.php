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

/* %pactive */
$queries[] = "ALTER TABLE %pactive
CHANGE ID id int(10) unsigned NOT NULL default '0',
CHANGE Name name varchar(32) NOT NULL default '',
CHANGE IP ip varchar(15) NOT NULL default 'Unknown',
CHANGE UserAgent user_agent varchar(100) NOT NULL default 'Unknown',
CHANGE Member is_member tinyint(1) unsigned NOT NULL default '1',
CHANGE Action action varchar(32) NOT NULL default '',
CHANGE Time time int(10) unsigned NOT NULL default '0',
DROP INDEX ID,
ADD UNIQUE ID (id)";

/* %pforums */
$queries[] = "ALTER TABLE %pforums
DROP LastTime,
DROP LastPost,
DROP LastPoster,
DROP LastPosterID,
ADD VisibleTo varchar(255) NOT NULL default '*' AFTER LastPostID,
ADD allow_reply varchar(255) NOT NULL default '*' AFTER VisibleTo,
ADD allow_create varchar(255) NOT NULL default '*' AFTER allow_reply,
ADD allow_poll varchar(255) NOT NULL default '*' AFTER allow_create";

/* %phelp */
$queries[] = "DROP TABLE IF EXISTS %phelp";
$queries[] = "CREATE TABLE %phelp (
  hid int(11) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  article tinytext NOT NULL,
  PRIMARY KEY  (hid)
)";

/* %pmembers */
$queries[] = "ALTER TABLE %pmembers
ADD language varchar(6) NOT NULL default 'en' AFTER Skin,
ADD avatar_type enum('local','url','uploaded','none') NOT NULL default 'none' AFTER Avatar";
$queries[] = "UPDATE %pmembers SET avatar_type='url' WHERE Avatar != ''";

/* %preplacements */
$queries[] = "DELETE FROM %preplacements WHERE Type='emoticon'";
$queries[] = "INSERT INTO %preplacements (Search, Replacement, Type, Clickable) VALUES (';)', 'wink.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (Search, Replacement, Type, Clickable) VALUES (':thinking:', 'thinking.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (Search, Replacement, Type, Clickable) VALUES (':p', 'tongue.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (Search, Replacement, Type, Clickable) VALUES (':rolleyes:', 'rolleyes.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (Search, Replacement, Type, Clickable) VALUES (':(', 'sad.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (Search, Replacement, Type, Clickable) VALUES (':D', 'smile.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (Search, Replacement, Type, Clickable) VALUES (':)', 'smirk.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (Search, Replacement, Type, Clickable) VALUES (':stare:', 'stare.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (Search, Replacement, Type, Clickable) VALUES (':o', 'surprised.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (Search, Replacement, Type, Clickable) VALUES (':mad:', 'mad.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (Search, Replacement, Type, Clickable) VALUES ('B)', 'cool.gif', 'emoticon', 1)";
$queries[] = "INSERT INTO %preplacements (Search, Replacement, Type, Clickable) VALUES (':cyclops:', 'cyclops.gif', 'emoticon', 1)";

/* %psearchwords */
$queries[] = "DROP TABLE IF EXISTS %psearchwords";
$queries[] = "CREATE TABLE %psearchwords (
  post int(12) unsigned NOT NULL default '0',
  word varchar(50) NOT NULL default '',
  KEY word (word)
)";

/* %pskins */
$queries[] = "UPDATE %pskins SET SkinName='Candy Corn' WHERE SkinDir='default'";

/* %ptemplates */
$queries[] = "ALTER TABLE %ptemplates MODIFY Template varchar(32) NOT NULL default 'default'";

/* %ptopics */
$queries[] = "ALTER TABLE %ptopics
DROP Starter,
DROP TLastPoster,
DROP TLastPosterID,
ADD last_poster int(10) unsigned NOT NULL default '0' AFTER StarterID";
?>
