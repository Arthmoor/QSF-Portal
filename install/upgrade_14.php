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

$query = $db->query("DELETE FROM %pactive;");

$need_templates = array(
    'MAIN',			// Changed templates
    'MAIN_COPYRIGHT',
    'MAIN_HEADER_MEMBER',
    'MAIN_HEADER_GUEST',
    'MAIN_REMINDER',
    'MAIN_TABLE',
    'MAIN_ETABLE',
    'BOARD_CATEGORY',
    'BOARD_LAST_POST_BOX',
    'BOARD_MAIN',
    'CP_PROFILE',
    'FORUM_MAIN',
    'FORUM_TOPIC',
    'FORUM_TOPIC_PINNED',
    'MEMBERS_MEMBER',
    'PM_FOLDER',
    'PM_FOLDER_MESSAGE',
    'PM_NO_MESSAGES',
    'PM_SEND',
    'PM_VIEW',
    'POST_PREVIEW',
    'POST_REVIEW_ENTRY',
    'PROFILE_MAIN',
    'REGISTER_MAIN',
    'TOPIC_MAIN',
    'TOPIC_POST',
    'TOPIC_POSTER_MEMBER',
    'ADMIN_ADD_TEMPLATE',	// New templates
    'ADMIN_CENSOR_FORM',
    'ADMIN_COPYRIGHT',
    'ADMIN_EDIT_BOARD_SETTINGS',
    'ADMIN_EDIT_DB_SETTINGS',
    'ADMIN_EDIT_SKIN',
    'ADMIN_EDIT_TEMPLATE',
    'ADMIN_EMOTICON_EDIT',
    'ADMIN_ETABLE',
    'ADMIN_FORUM_ADD',
    'ADMIN_FORUM_EDIT',
    'ADMIN_FORUM_ORDER',
    'ADMIN_GROUP_EDIT',
    'ADMIN_HOME',
    'ADMIN_INDEX',
    'ADMIN_LIST_TEMPLATES',
    'ADMIN_LIST_TEMPLATES_DELETE',
    'ADMIN_MASS_MAIL',
    'ADMIN_MEMBER_PROFILE',
    'ADMIN_MESSAGE',
    'ADMIN_MOD_LOGS',
    'ADMIN_RSSREADER_TITLE',
    'ADMIN_RSSREADER_ITEM',
    'ADMIN_RSSREADER_MAIN',
    'ADMIN_TABLE',
    'ADMIN_TITLE_FORM',
    'FORUM_TOPICS_MAIN',
    'RECENT_MAIN',
    'RECENT_NO_TOPICS',
    'RECENT_TOPIC',
    'RECENT_TOPIC_PINNED',
    'PM_PREVIEW'
);

$this->sets['default_timezone'] = 151;
$this->sets['servertime'] = 151;
$this->sets['rss_feed_posts'] = 5;
$this->sets['rss_feed_time'] = 60;
$this->sets['rss_feed_title'] = "";
$this->sets['rss_feed_desc'] = "";
$this->sets['spider_active'] = 1;
$this->sets['spider_name'] = array(
	'googlebot' 	=> 'Google',
	'lycos' 	=> 'Google',
	'ask jeeves' 	=> 'Google',
	'scooter'	=> 'Altavista',
	'fast-webcrawler'=>'AlltheWeb',
	'slurp@inktomi' => 'Inktomi',
	'turnitinbot'	=> 'Turnitin.com',
	'gigabot'	=> 'Gigabot',
	'yahoo'		=> 'Yahoo! Slurp',
	'msnbot'	=> 'MSN Search',
	'mediapartners-google'=>'AdSense',
	'naverbot'	=> 'Naver',
	'jetbot'	=> 'JetEye',
	'alexa'		=> 'Alexa',
	'ArchitextSpider'=>'Excite-Bot',
	'pipeLiner'	=> 'PipeLine Spider'
);
$this->sets['optional_modules'] = array(
	'active',
	'cp',
	'email',
	'help',
	'members',
	'mod',
	'pm',
	'printer',
	'profile',
	'search',
	'recent',
	'rssfeed'
);

$queries[] = "DROP TABLE IF EXISTS %ptimezones";
$queries[] = "CREATE TABLE %ptimezones (
  zone_id smallint(3) unsigned NOT NULL auto_increment,
  zone_name varchar(30) NOT NULL default '',
  zone_abbrev varchar(6) NOT NULL default 'N/A',
  zone_offset int(15) NOT NULL default '0',
  zone_updated int(15) unsigned NOT NULL default '0',
  PRIMARY KEY  (zone_id),
  KEY name (zone_name)
) TYPE=MyISAM AUTO_INCREMENT=384";

$queries[] = "UPDATE %pusers SET user_skin='default' WHERE user_group='1'";
$queries[] = "INSERT INTO %ptimezones VALUES (1, 'Europe/Andorra', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (2, 'Asia/Dubai', 'GST', 14400, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (3, 'Asia/Kabul', 'AFT', 16200, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (4, 'America/Antigua', 'AST', -14400, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (5, 'America/Anguilla', 'AST', -14400, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (6, 'Europe/Tirane', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (7, 'Asia/Yerevan', 'AMT', 14400, 1143324000)";
$queries[] = "INSERT INTO %ptimezones VALUES (8, 'America/Curacao', 'AST', -14400, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (9, 'Africa/Luanda', 'WAT', 3600, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (10, 'Antarctica/McMurdo', 'NZDT', 46800, 1142690400)";
$queries[] = "INSERT INTO %ptimezones VALUES (11, 'Antarctica/South_Pole', 'NZDT', 46800, 1142690400)";
$queries[] = "INSERT INTO %ptimezones VALUES (12, 'Antarctica/Rothera', 'ROTT', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (13, 'Antarctica/Palmer', 'CLST', -10800, 1142132400)";
$queries[] = "INSERT INTO %ptimezones VALUES (14, 'Antarctica/Mawson', 'MAWT', 21600, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (15, 'Antarctica/Davis', 'DAVT', 25200, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (16, 'Antarctica/Casey', 'WST', 28800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (17, 'Antarctica/Vostok', 'VOST', 21600, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (18, 'Antarctica/DumontDUrville', 'DDUT', 36000, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (19, 'Antarctica/Syowa', 'SYOT', 10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (20, 'America/Argentina/Buenos_Aires', 'ART', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (21, 'America/Argentina/Cordoba', 'ART', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (22, 'America/Argentina/Jujuy', 'ART', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (23, 'America/Argentina/Tucuman', 'ART', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (24, 'America/Argentina/Catamarca', 'ART', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (25, 'America/Argentina/La_Rioja', 'ART', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (26, 'America/Argentina/San_Juan', 'ART', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (27, 'America/Argentina/Mendoza', 'ART', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (28, 'America/Argentina/Rio_Gallegos', 'ART', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (29, 'America/Argentina/Ushuaia', 'ART', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (30, 'Pacific/Pago_Pago', 'SST', -39600, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (31, 'Europe/Vienna', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (32, 'Australia/Lord_Howe', 'LHST', 39600, 1143903600)";
$queries[] = "INSERT INTO %ptimezones VALUES (33, 'Australia/Hobart', 'EST', 39600, 1143907200)";
$queries[] = "INSERT INTO %ptimezones VALUES (34, 'Australia/Currie', 'EST', 39600, 1143907200)";
$queries[] = "INSERT INTO %ptimezones VALUES (35, 'Australia/Melbourne', 'EST', 39600, 1143907200)";
$queries[] = "INSERT INTO %ptimezones VALUES (36, 'Australia/Sydney', 'EST', 39600, 1143907200)";
$queries[] = "INSERT INTO %ptimezones VALUES (37, 'Australia/Broken_Hill', 'CST', 37800, 1143909000)";
$queries[] = "INSERT INTO %ptimezones VALUES (38, 'Australia/Brisbane', 'EST', 36000, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (39, 'Australia/Lindeman', 'EST', 36000, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (40, 'Australia/Adelaide', 'CST', 37800, 1143909000)";
$queries[] = "INSERT INTO %ptimezones VALUES (41, 'Australia/Darwin', 'CST', 34200, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (42, 'Australia/Perth', 'WST', 28800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (43, 'America/Aruba', 'AST', -14400, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (44, 'Europe/Mariehamn', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (45, 'Asia/Baku', 'AZT', 14400, 1143320400)";
$queries[] = "INSERT INTO %ptimezones VALUES (46, 'Europe/Sarajevo', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (47, 'America/Barbados', 'AST', -14400, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (48, 'Asia/Dhaka', 'BDT', 21600, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (49, 'Europe/Brussels', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (50, 'Africa/Ouagadougou', 'GMT', 0, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (51, 'Europe/Sofia', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (52, 'Asia/Bahrain', 'AST', 10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (53, 'Africa/Bujumbura', 'CAT', 7200, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (54, 'Africa/Porto-Novo', 'WAT', 3600, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (55, 'Atlantic/Bermuda', 'AST', -14400, 1143957600)";
$queries[] = "INSERT INTO %ptimezones VALUES (56, 'Asia/Brunei', 'BNT', 28800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (57, 'America/La_Paz', 'BOT', -14400, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (58, 'America/Noronha', 'FNT', -7200, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (59, 'America/Belem', 'BRT', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (60, 'America/Fortaleza', 'BRT', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (61, 'America/Recife', 'BRT', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (62, 'America/Araguaina', 'BRT', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (63, 'America/Maceio', 'BRT', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (64, 'America/Bahia', 'BRT', -10800, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (65, 'America/Sao_Paulo', 'BRST', -7200, 1140314400)";
$queries[] = "INSERT INTO %ptimezones VALUES (66, 'America/Campo_Grande', 'AMST', -10800, 1140318000)";
$queries[] = "INSERT INTO %ptimezones VALUES (67, 'America/Cuiaba', 'AMST', -10800, 1140318000)";
$queries[] = "INSERT INTO %ptimezones VALUES (68, 'America/Porto_Velho', 'AMT', -14400, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (69, 'America/Boa_Vista', 'AMT', -14400, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (70, 'America/Manaus', 'AMT', -14400, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (71, 'America/Eirunepe', 'ACT', -18000, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (72, 'America/Rio_Branco', 'ACT', -18000, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (73, 'America/Nassau', 'EST', -18000, 1143961200)";
$queries[] = "INSERT INTO %ptimezones VALUES (74, 'Asia/Thimphu', 'BTT', 21600, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (75, 'Africa/Gaborone', 'CAT', 7200, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (76, 'Europe/Minsk', 'EET', 7200, 1143331200)";
$queries[] = "INSERT INTO %ptimezones VALUES (77, 'America/Belize', 'CST', -21600, 1134774053)";
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
$queries[] = "INSERT INTO %ptimezones VALUES (88, 'America/Coral_Harbour', 'EST', -18000, 1134774053)";
$queries[] = "INSERT INTO %ptimezones VALUES (89, 'America/Rankin_Inlet', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (90, 'America/Winnipeg', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (91, 'America/Rainy_River', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (92, 'America/Cambridge_Bay', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (93, 'America/Regina', 'CST', -21600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (94, 'America/Swift_Current', 'CST', -21600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (95, 'America/Edmonton', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (96, 'America/Yellowknife', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (97, 'America/Inuvik', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (98, 'America/Dawson_Creek', 'MST', -25200, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (99, 'America/Vancouver', 'PST', -28800, 1143972000)";
$queries[] = "INSERT INTO %ptimezones VALUES (100, 'America/Whitehorse', 'PST', -28800, 1143972000)";
$queries[] = "INSERT INTO %ptimezones VALUES (101, 'America/Dawson', 'PST', -28800, 1143972000)";
$queries[] = "INSERT INTO %ptimezones VALUES (102, 'Indian/Cocos', 'CCT', 23400, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (103, 'Africa/Kinshasa', 'WAT', 3600, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (104, 'Africa/Lubumbashi', 'CAT', 7200, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (105, 'Africa/Bangui', 'WAT', 3600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (106, 'Africa/Brazzaville', 'WAT', 3600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (107, 'Europe/Zurich', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (108, 'Africa/Abidjan', 'GMT', 0, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (109, 'Pacific/Rarotonga', 'CKT', -36000, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (110, 'America/Santiago', 'CLST', -10800, 1142132400)";
$queries[] = "INSERT INTO %ptimezones VALUES (111, 'Pacific/Easter', 'EASST', -18000, 1142132400)";
$queries[] = "INSERT INTO %ptimezones VALUES (112, 'Africa/Douala', 'WAT', 3600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (113, 'Asia/Shanghai', 'CST', 28800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (114, 'Asia/Harbin', 'CST', 28800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (115, 'Asia/Chongqing', 'CST', 28800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (116, 'Asia/Urumqi', 'CST', 28800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (117, 'Asia/Kashgar', 'CST', 28800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (118, 'America/Bogota', 'COT', -18000, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (119, 'America/Costa_Rica', 'CST', -21600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (120, 'Europe/Belgrade', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (121, 'America/Havana', 'CST', -18000, 1143954000)";
$queries[] = "INSERT INTO %ptimezones VALUES (122, 'Atlantic/Cape_Verde', 'CVT', -3600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (123, 'Indian/Christmas', 'CXT', 25200, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (124, 'Asia/Nicosia', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (125, 'Europe/Prague', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (126, 'Europe/Berlin', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (127, 'Africa/Djibouti', 'EAT', 10800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (128, 'Europe/Copenhagen', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (129, 'America/Dominica', 'AST', -14400, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (130, 'America/Santo_Domingo', 'AST', -14400, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (131, 'Africa/Algiers', 'CET', 3600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (132, 'America/Guayaquil', 'ECT', -18000, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (133, 'Pacific/Galapagos', 'GALT', -21600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (134, 'Europe/Tallinn', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (135, 'Africa/Cairo', 'EET', 7200, 1146175200)";
$queries[] = "INSERT INTO %ptimezones VALUES (136, 'Africa/El_Aaiun', 'WET', 0, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (137, 'Africa/Asmera', 'EAT', 10800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (138, 'Europe/Madrid', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (139, 'Africa/Ceuta', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (140, 'Atlantic/Canary', 'WET', 0, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (141, 'Africa/Addis_Ababa', 'EAT', 10800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (142, 'Europe/Helsinki', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (143, 'Pacific/Fiji', 'FJT', 43200, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (144, 'Atlantic/Stanley', 'FKST', -10800, 1145163600)";
$queries[] = "INSERT INTO %ptimezones VALUES (145, 'Pacific/Truk', 'TRUT', 36000, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (146, 'Pacific/Ponape', 'PONT', 39600, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (147, 'Pacific/Kosrae', 'KOST', 39600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (148, 'Atlantic/Faeroe', 'WET', 0, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (149, 'Europe/Paris', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (150, 'Africa/Libreville', 'WAT', 3600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (151, 'Europe/London', 'GMT', 0, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (152, 'America/Grenada', 'AST', -14400, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (153, 'Asia/Tbilisi', 'GET', 10800, 1143327600)";
$queries[] = "INSERT INTO %ptimezones VALUES (154, 'America/Cayenne', 'GFT', -10800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (155, 'Africa/Accra', 'GMT', 0, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (156, 'Europe/Gibraltar', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (157, 'America/Godthab', 'WGT', -10800, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (158, 'America/Danmarkshavn', 'GMT', 0, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (159, 'America/Scoresbysund', 'EGT', -3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (160, 'America/Thule', 'AST', -14400, 1143957600)";
$queries[] = "INSERT INTO %ptimezones VALUES (161, 'Africa/Banjul', 'GMT', 0, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (162, 'Africa/Conakry', 'GMT', 0, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (163, 'America/Guadeloupe', 'AST', -14400, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (164, 'Africa/Malabo', 'WAT', 3600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (165, 'Europe/Athens', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (166, 'Atlantic/South_Georgia', 'GST', -7200, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (167, 'America/Guatemala', 'CST', -21600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (168, 'Pacific/Guam', 'ChST', 36000, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (169, 'Africa/Bissau', 'GMT', 0, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (170, 'America/Guyana', 'GYT', -14400, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (171, 'Asia/Hong_Kong', 'HKT', 28800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (172, 'America/Tegucigalpa', 'CST', -21600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (173, 'Europe/Zagreb', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (174, 'America/Port-au-Prince', 'EST', -18000, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (175, 'Europe/Budapest', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (176, 'Asia/Jakarta', 'WIT', 25200, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (177, 'Asia/Pontianak', 'WIT', 25200, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (178, 'Asia/Makassar', 'CIT', 28800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (179, 'Asia/Jayapura', 'EIT', 32400, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (180, 'Europe/Dublin', 'GMT', 0, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (181, 'Asia/Jerusalem', 'IST', 7200, 1143763200)";
$queries[] = "INSERT INTO %ptimezones VALUES (182, 'Asia/Calcutta', 'IST', 19800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (183, 'Indian/Chagos', 'IOT', 21600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (184, 'Asia/Baghdad', 'AST', 10800, 1143849600)";
$queries[] = "INSERT INTO %ptimezones VALUES (185, 'Asia/Tehran', 'IRST', 12600, 1142973000)";
$queries[] = "INSERT INTO %ptimezones VALUES (186, 'Atlantic/Reykjavik', 'GMT', 0, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (187, 'Europe/Rome', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (188, 'America/Jamaica', 'EST', -18000, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (189, 'Asia/Amman', 'EET', 7200, 1143669600)";
$queries[] = "INSERT INTO %ptimezones VALUES (190, 'Asia/Tokyo', 'JST', 32400, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (191, 'Africa/Nairobi', 'EAT', 10800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (192, 'Asia/Bishkek', 'KGT', 21600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (193, 'Asia/Phnom_Penh', 'ICT', 25200, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (194, 'Pacific/Tarawa', 'GILT', 43200, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (195, 'Pacific/Enderbury', 'PHOT', 46800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (196, 'Pacific/Kiritimati', 'LINT', 50400, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (197, 'Indian/Comoro', 'EAT', 10800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (198, 'America/St_Kitts', 'AST', -14400, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (199, 'Asia/Pyongyang', 'KST', 32400, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (200, 'Asia/Seoul', 'KST', 32400, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (201, 'Asia/Kuwait', 'AST', 10800, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (202, 'America/Cayman', 'EST', -18000, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (203, 'Asia/Almaty', 'ALMT', 21600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (204, 'Asia/Qyzylorda', 'QYZT', 21600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (205, 'Asia/Aqtobe', 'AQTT', 18000, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (206, 'Asia/Aqtau', 'AQTT', 18000, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (207, 'Asia/Oral', 'ORAT', 18000, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (208, 'Asia/Vientiane', 'ICT', 25200, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (209, 'Asia/Beirut', 'EET', 7200, 1143324000)";
$queries[] = "INSERT INTO %ptimezones VALUES (210, 'America/St_Lucia', 'AST', -14400, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (211, 'Europe/Vaduz', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (212, 'Asia/Colombo', 'LKT', 21600, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (213, 'Africa/Monrovia', 'GMT', 0, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (214, 'Africa/Maseru', 'SAST', 7200, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (215, 'Europe/Vilnius', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (216, 'Europe/Luxembourg', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (217, 'Europe/Riga', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (218, 'Africa/Tripoli', 'EET', 7200, 1134774054)";
$queries[] = "INSERT INTO %ptimezones VALUES (219, 'Africa/Casablanca', 'WET', 0, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (220, 'Europe/Monaco', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (221, 'Europe/Chisinau', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (222, 'Indian/Antananarivo', 'EAT', 10800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (223, 'Pacific/Majuro', 'MHT', 43200, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (224, 'Pacific/Kwajalein', 'MHT', 43200, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (225, 'Europe/Skopje', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (226, 'Africa/Bamako', 'GMT', 0, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (227, 'Asia/Rangoon', 'MMT', 23400, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (228, 'Asia/Ulaanbaatar', 'ULAT', 28800, 1143223200)";
$queries[] = "INSERT INTO %ptimezones VALUES (229, 'Asia/Hovd', 'HOVT', 25200, 1143226800)";
$queries[] = "INSERT INTO %ptimezones VALUES (230, 'Asia/Choibalsan', 'CHOT', 32400, 1143219600)";
$queries[] = "INSERT INTO %ptimezones VALUES (231, 'Asia/Macau', 'CST', 28800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (232, 'Pacific/Saipan', 'ChST', 36000, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (233, 'America/Martinique', 'AST', -14400, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (234, 'Africa/Nouakchott', 'GMT', 0, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (235, 'America/Montserrat', 'AST', -14400, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (236, 'Europe/Malta', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (237, 'Indian/Mauritius', 'MUT', 14400, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (238, 'Indian/Maldives', 'MVT', 18000, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (239, 'Africa/Blantyre', 'CAT', 7200, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (240, 'America/Mexico_City', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (241, 'America/Cancun', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (242, 'America/Merida', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (243, 'America/Monterrey', 'CST', -21600, 1143964800)";
$queries[] = "INSERT INTO %ptimezones VALUES (244, 'America/Mazatlan', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (245, 'America/Chihuahua', 'MST', -25200, 1143968400)";
$queries[] = "INSERT INTO %ptimezones VALUES (246, 'America/Hermosillo', 'MST', -25200, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (247, 'America/Tijuana', 'PST', -28800, 1143972000)";
$queries[] = "INSERT INTO %ptimezones VALUES (248, 'Asia/Kuala_Lumpur', 'MYT', 28800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (249, 'Asia/Kuching', 'MYT', 28800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (250, 'Africa/Maputo', 'CAT', 7200, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (251, 'Africa/Windhoek', 'WAST', 7200, 1143936000)";
$queries[] = "INSERT INTO %ptimezones VALUES (252, 'Pacific/Noumea', 'NCT', 39600, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (253, 'Africa/Niamey', 'WAT', 3600, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (254, 'Pacific/Norfolk', 'NFT', 41400, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (255, 'Africa/Lagos', 'WAT', 3600, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (256, 'America/Managua', 'CST', -21600, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (257, 'Europe/Amsterdam', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (258, 'Europe/Oslo', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (259, 'Asia/Katmandu', 'NPT', 20700, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (260, 'Pacific/Nauru', 'NRT', 43200, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (261, 'Pacific/Niue', 'NUT', -39600, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (262, 'Pacific/Auckland', 'NZDT', 46800, 1142690400)";
$queries[] = "INSERT INTO %ptimezones VALUES (263, 'Pacific/Chatham', 'CHADT', 49500, 1142690400)";
$queries[] = "INSERT INTO %ptimezones VALUES (264, 'Asia/Muscat', 'GST', 14400, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (265, 'America/Panama', 'EST', -18000, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (266, 'America/Lima', 'PET', -18000, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (267, 'Pacific/Tahiti', 'TAHT', -36000, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (268, 'Pacific/Marquesas', 'MART', -34200, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (269, 'Pacific/Gambier', 'GAMT', -32400, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (270, 'Pacific/Port_Moresby', 'PGT', 36000, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (271, 'Asia/Manila', 'PHT', 28800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (272, 'Asia/Karachi', 'PKT', 18000, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (273, 'Europe/Warsaw', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (274, 'America/Miquelon', 'PMST', -10800, 1143954000)";
$queries[] = "INSERT INTO %ptimezones VALUES (275, 'Pacific/Pitcairn', 'PST', -28800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (276, 'America/Puerto_Rico', 'AST', -14400, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (277, 'Asia/Gaza', 'EET', 7200, 1145570400)";
$queries[] = "INSERT INTO %ptimezones VALUES (278, 'Europe/Lisbon', 'WET', 0, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (279, 'Atlantic/Madeira', 'WET', 0, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (280, 'Atlantic/Azores', 'AZOT', -3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (281, 'Pacific/Palau', 'PWT', 32400, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (282, 'America/Asuncion', 'PYST', -10800, 1142132400)";
$queries[] = "INSERT INTO %ptimezones VALUES (283, 'Asia/Qatar', 'AST', 10800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (284, 'Indian/Reunion', 'RET', 14400, 1134774055)";
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
$queries[] = "INSERT INTO %ptimezones VALUES (300, 'Africa/Kigali', 'CAT', 7200, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (301, 'Asia/Riyadh', 'AST', 10800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (302, 'Pacific/Guadalcanal', 'SBT', 39600, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (303, 'Indian/Mahe', 'SCT', 14400, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (304, 'Africa/Khartoum', 'EAT', 10800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (305, 'Europe/Stockholm', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (306, 'Asia/Singapore', 'SGT', 28800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (307, 'Atlantic/St_Helena', 'GMT', 0, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (308, 'Europe/Ljubljana', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (309, 'Arctic/Longyearbyen', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (310, 'Atlantic/Jan_Mayen', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (311, 'Europe/Bratislava', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (312, 'Africa/Freetown', 'GMT', 0, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (313, 'Europe/San_Marino', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (314, 'Africa/Dakar', 'GMT', 0, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (315, 'Africa/Mogadishu', 'EAT', 10800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (316, 'America/Paramaribo', 'SRT', -10800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (317, 'Africa/Sao_Tome', 'GMT', 0, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (318, 'America/El_Salvador', 'CST', -21600, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (319, 'Asia/Damascus', 'EET', 7200, 1143842400)";
$queries[] = "INSERT INTO %ptimezones VALUES (320, 'Africa/Mbabane', 'SAST', 7200, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (321, 'America/Grand_Turk', 'EST', -18000, 1143954000)";
$queries[] = "INSERT INTO %ptimezones VALUES (322, 'Africa/Ndjamena', 'WAT', 3600, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (323, 'Indian/Kerguelen', 'TFT', 18000, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (324, 'Africa/Lome', 'GMT', 0, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (325, 'Asia/Bangkok', 'ICT', 25200, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (326, 'Asia/Dushanbe', 'TJT', 18000, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (327, 'Pacific/Fakaofo', 'TKT', -36000, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (328, 'Asia/Dili', 'TLT', 32400, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (329, 'Asia/Ashgabat', 'TMT', 18000, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (330, 'Africa/Tunis', 'CET', 3600, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (331, 'Pacific/Tongatapu', 'TOT', 46800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (332, 'Europe/Istanbul', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (333, 'America/Port_of_Spain', 'AST', -14400, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (334, 'Pacific/Funafuti', 'TVT', 43200, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (335, 'Asia/Taipei', 'CST', 28800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (336, 'Africa/Dar_es_Salaam', 'EAT', 10800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (337, 'Europe/Kiev', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (338, 'Europe/Uzhgorod', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (339, 'Europe/Zaporozhye', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (340, 'Europe/Simferopol', 'EET', 7200, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (341, 'Africa/Kampala', 'EAT', 10800, 1134774055)";
$queries[] = "INSERT INTO %ptimezones VALUES (342, 'Pacific/Johnston', 'HST', -36000, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (343, 'Pacific/Midway', 'SST', -39600, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (344, 'Pacific/Wake', 'WAKT', 43200, 1134778039)";
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
$queries[] = "INSERT INTO %ptimezones VALUES (359, 'America/Phoenix', 'MST', -25200, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (360, 'America/Los_Angeles', 'PST', -28800, 1143972000)";
$queries[] = "INSERT INTO %ptimezones VALUES (361, 'America/Anchorage', 'AKST', -32400, 1143975600)";
$queries[] = "INSERT INTO %ptimezones VALUES (362, 'America/Juneau', 'AKST', -32400, 1143975600)";
$queries[] = "INSERT INTO %ptimezones VALUES (363, 'America/Yakutat', 'AKST', -32400, 1143975600)";
$queries[] = "INSERT INTO %ptimezones VALUES (364, 'America/Nome', 'AKST', -32400, 1143975600)";
$queries[] = "INSERT INTO %ptimezones VALUES (365, 'America/Adak', 'HAST', -36000, 1143979200)";
$queries[] = "INSERT INTO %ptimezones VALUES (366, 'Pacific/Honolulu', 'HST', -36000, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (367, 'America/Montevideo', 'UYST', -7200, 1142136000)";
$queries[] = "INSERT INTO %ptimezones VALUES (368, 'Asia/Samarkand', 'UZT', 18000, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (369, 'Asia/Tashkent', 'UZT', 18000, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (370, 'Europe/Vatican', 'CET', 3600, 1143334800)";
$queries[] = "INSERT INTO %ptimezones VALUES (371, 'America/St_Vincent', 'AST', -14400, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (372, 'America/Caracas', 'VET', -14400, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (373, 'America/Tortola', 'AST', -14400, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (374, 'America/St_Thomas', 'AST', -14400, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (375, 'Asia/Saigon', 'ICT', 25200, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (376, 'Pacific/Efate', 'VUT', 39600, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (377, 'Pacific/Wallis', 'WFT', 43200, 1134778039)";
$queries[] = "INSERT INTO %ptimezones VALUES (378, 'Pacific/Apia', 'WST', -39600, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (379, 'Asia/Aden', 'AST', 10800, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (380, 'Indian/Mayotte', 'EAT', 10800, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (381, 'Africa/Johannesburg', 'SAST', 7200, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (382, 'Africa/Lusaka', 'CAT', 7200, 1134774056)";
$queries[] = "INSERT INTO %ptimezones VALUES (383, 'Africa/Harare', 'CAT', 7200, 1134774056)";

$queries[] = "ALTER TABLE %pposts ADD post_ip_new INT UNSIGNED NOT NULL DEFAULT '0'";
$queries[] = "UPDATE %pposts SET post_ip_new=INET_ATON(post_ip)";
$queries[] = "ALTER TABLE %pposts DROP post_ip";
$queries[] = "ALTER TABLE %pposts CHANGE post_ip_new post_ip INT UNSIGNED NOT NULL DEFAULT '0'";
$queries[] = "ALTER TABLE %pactive CHANGE active_ip active_ip INT UNSIGNED NOT NULL DEFAULT '0'";
$queries[] = "ALTER TABLE %psettings ADD settings_tos text AFTER settings_id";
$queries[] = "ALTER TABLE %pusers ADD user_title_custom TINYINT(1) UNSIGNED NOT NULL AFTER user_title";
$queries[] = "ALTER TABLE %pusers MODIFY user_aim VARCHAR(32) NOT NULL";
$queries[] = "ALTER TABLE %pusers ADD user_gtalk varchar(32) NOT NULL AFTER user_aim";
// Update the users table so the guest has a user level of 1. To avoid problems where guests still have a user level of 0
$queries[] = "UPDATE %pusers SET user_level = 1 WHERE user_id = 1";
// Update forum table to include subcat data
$queries[] = "ALTER TABLE %pforums ADD forum_subcat tinyint(1) NOT NULL AFTER forum_lastpost";

// Alter the user timezones in careful steps
$queries[] = "ALTER TABLE %pusers CHANGE user_timezone user_timezone FLOAT(4,1) NOT NULL DEFAULT '0.0'";
// Adjust timezones to new settings (not 100% accurate. Just a guess!)
$queries[] = "UPDATE %pusers SET user_timezone=223 WHERE user_timezone=12.0"; // Pacific/Majuro
$queries[] = "UPDATE %pusers SET user_timezone=297 WHERE user_timezone=11.0"; // Asia/Magadan
$queries[] = "UPDATE %pusers SET user_timezone=168 WHERE user_timezone=10.0"; // Pacific/Guam
$queries[] = "UPDATE %pusers SET user_timezone=41 WHERE user_timezone=9.5";   // Australia/Darwin
$queries[] = "UPDATE %pusers SET user_timezone=190 WHERE user_timezone=9.0";  // Asia/Tokyo
$queries[] = "UPDATE %pusers SET user_timezone=171 WHERE user_timezone=8.0";  // Asia/Hong_Kong
$queries[] = "UPDATE %pusers SET user_timezone=325 WHERE user_timezone=7.0";  // Asia/Bangkok
$queries[] = "UPDATE %pusers SET user_timezone=48 WHERE user_timezone=6.0";   // Asia/Dhaka
$queries[] = "UPDATE %pusers SET user_timezone=182 WHERE user_timezone=5.5";  // Asia/Calcutta
$queries[] = "UPDATE %pusers SET user_timezone=238 WHERE user_timezone=5.0";  // Indian/Maldives
$queries[] = "UPDATE %pusers SET user_timezone=185 WHERE user_timezone=3.5";  // Asia/Tehran
$queries[] = "UPDATE %pusers SET user_timezone=287 WHERE user_timezone=3.0";  // Europe/Moscow
$queries[] = "UPDATE %pusers SET user_timezone=135 WHERE user_timezone=2.0";  // Africa/Cairo
$queries[] = "UPDATE %pusers SET user_timezone=257 WHERE user_timezone=1.0";  // Europe/Amsterdam
$queries[] = "UPDATE %pusers SET user_timezone=151 WHERE user_timezone=0.0";  // Europe/London
$queries[] = "UPDATE %pusers SET user_timezone=280 WHERE user_timezone=-1.0"; // Atlantic/Azores
$queries[] = "UPDATE %pusers SET user_timezone=159 WHERE user_timezone=-2.0"; // America/Scoresbysund
$queries[] = "UPDATE %pusers SET user_timezone=20 WHERE user_timezone=-3.0";  // America/Argentina/Buenos_Aires
$queries[] = "UPDATE %pusers SET user_timezone=78 WHERE user_timezone=-3.5";  // America/St_Johns
$queries[] = "UPDATE %pusers SET user_timezone=55 WHERE user_timezone=-4.0";  // Atlantic/Bermuda
$queries[] = "UPDATE %pusers SET user_timezone=83 WHERE user_timezone=-5.0";  // America/Toronto
$queries[] = "UPDATE %pusers SET user_timezone=240 WHERE user_timezone=-6.0"; // America/Mexico_City
$queries[] = "UPDATE %pusers SET user_timezone=356 WHERE user_timezone=-7.0"; // America/Denver
$queries[] = "UPDATE %pusers SET user_timezone=360 WHERE user_timezone=-8.0"; // America/Los_Angeles
$queries[] = "UPDATE %pusers SET user_timezone=275 WHERE user_timezone=-9.0"; // Pacific/Pitcairn
$queries[] = "UPDATE %pusers SET user_timezone=366 WHERE user_timezone=-10.0";// Pacific/Honolulu
$queries[] = "UPDATE %pusers SET user_timezone=343 WHERE user_timezone=-11.0";// Pacific/Midway
$queries[] = "UPDATE %pusers SET user_timezone=262 WHERE user_timezone=-12.0";// Pacific/Auckland

// Do these last to avoid conflicts
$queries[] = "UPDATE %pusers SET user_timezone=2 WHERE user_timezone=4.0";    // Asia/Dubai
$queries[] = "UPDATE %pusers SET user_timezone=3 WHERE user_timezone=4.5";    // Asia/Kabul

// Adjust the table to it's final point
$queries[] = "ALTER TABLE %pusers CHANGE user_timezone user_timezone SMALLINT(3) NOT NULL DEFAULT '151'";
?>
