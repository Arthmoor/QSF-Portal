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

// Upgrade from QSF Portal 1.5.2 to QSF Portal 1.6

// Template changes - Don't forget to enclose them inside single quotes!!!
$need_templates = true;

// New settings
$this->sets['registrations_allowed'] = 1;

// Deleted settings

// Forum permission changes	

// File permission changes

// Queries to run
$queries[] = "ALTER TABLE %psettings ADD settings_version smallint(2) NOT NULL default 1 AFTER settings_id";

$queries[] = "CREATE TABLE %pemoticons (
  emote_id int(10) unsigned NOT NULL auto_increment,
  emote_string varchar(15) NOT NULL default '',
  emote_image varchar(255) NOT NULL default '',
  emote_clickable tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (emote_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':alien:', 'alien.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':biggrin:', 'biggrin.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':blues:', 'blues.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':cool:', 'cool.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':cry:', 'cry.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':cyclops:', 'cyclops.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':devil:', 'devil.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':evil:', 'evil.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':ghostface:', 'ghostface.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':grinning:', 'grinning.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':lol:', 'lol.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':mad:', 'mad.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':redface:', 'redface.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':robot:', 'robot.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':rolleyes:', 'rolleyes.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':sad:', 'sad.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':smile:', 'smile.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':stare:', 'stare.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':surprised:', 'surprised.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':thinking:', 'thinking.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':tongue:', 'tongue.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':unclesam:', 'unclesam.gif', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':wink:', 'wink.gif', 1 )";
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
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':banana:', 'dancingbanana.gif"', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':cricket:', 'cricket.png', 1 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':(', 'sad.gif', 0 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':P', 'tongue.gif', 0 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (';)', 'wink.gif', 0 )";
$queries[] = "INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES (':)', 'smile.gif', 0 )";
?>