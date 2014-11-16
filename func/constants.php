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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

/* Error Reporting */
define('QUICKSILVER_NOTICE', 3);
define('QUICKSILVER_ERROR', 5);
define('QUICKSILVER_QUERY_ERROR', 6);

/* Uploading */
define('UPLOAD_TOO_LARGE', 1);
define('UPLOAD_NOT_ALLOWED', 2);
define('UPLOAD_FAILURE', 3);
define('UPLOAD_SUCCESS', 4);

/* Password Changing */
define('PASS_NOT_VERIFIED', 1);
define('PASS_NO_MATCH', 2);
define('PASS_INVALID', 3);
define('PASS_SUCCESS', 4);

/* Time Formatting */
define('DATE_LONG', 1);
define('DATE_SHORT', 2);
define('DATE_ONLY_LONG', 3);
define('DATE_ONLY_SHORT', 4);
define('DATE_TIME', 5);
define('DATE_ISO822', 6); // For RSS feeds

/* Text Formatting */
define('FORMAT_MBCODE', 1);
define('FORMAT_EMOTICONS', 2);
define('FORMAT_CENSOR', 4);
define('FORMAT_BREAKS', 16);
define('FORMAT_HTMLCHARS', 32);

/* Topic States */
define('TOPIC_LOCKED', 1);
define('TOPIC_MOVED', 2);
define('TOPIC_POLL', 4);
define('TOPIC_POLL_ONLY', 8);
define('TOPIC_PINNED', 16);
define('TOPIC_GLOBAL', 32);
define('TOPIC_DELETED', 64);
define('TOPIC_PUBLISH', 128);

/* Users */
define('USER_GUEST_UID', 1);

/* User Groups */
define('USER_ADMIN', 1);
define('USER_MEMBER', 2);
define('USER_GUEST', 3);
define('USER_BANNED', 4);
define('USER_AWAIT', 5);
define('USER_MODS', 6);

/* Types for validation */
define('TYPE_BOOLEAN', 1); // Variable should be 1 or 0 and will be changed to true or false
define('TYPE_UINT', 2); // Variable should be an integer that is also >= 0
define('TYPE_INT', 3); // Variable should be an integer
define('TYPE_FLOAT', 4); // Variable is a floating point number
define('TYPE_STRING', 5); // Variable is a string (essentially anything except array or object)
define('TYPE_ARRAY', 6); // Variable is an array. Probably better to use is_array()
define('TYPE_OBJECT', 7); // Variable is an object. Can put in a class in the range to check if object's ancestry
define('TYPE_USERNAME', 8); // Check if it's okay to use as a username
define('TYPE_PASSWORD', 9); // Check if string is okay to use as a password
define('TYPE_EMAIL', 10); // Check if string is a valid email

/* General purpose */
define('DAY_IN_SECONDS', 86400);
define('SECONDS_IN_HOUR', 3600);
?>
