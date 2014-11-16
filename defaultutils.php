<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005 The Quicksilver Forums Development Team
 *  http://www.quicksilverforums.com/
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
 
$modules = array();

// The below libraries can be replaced with children that customise behavior
require_once $set['include_path'] . '/lib/' . $set['dbtype'] . '.php';
$modules['database'] = 'db_' . $set['dbtype'];
require_once $set['include_path'] .  '/lib/perms.php';
$modules['permissions'] = 'permissions';
require_once $set['include_path'] .  '/lib/user.php';
$modules['user'] = 'user';
require_once $set['include_path'] .  '/lib/mailer.php';
$modules['mailer'] = 'mailer';
require_once $set['include_path'] . '/lib/attachutil.php';
$modules['attach'] = 'attachutil';
require_once $set['include_path'] . '/lib/tz_decode2.php';
$modules['timezone'] = 'tz_decode2';
require_once $set['include_path'] . '/lib/htmlwidgets.php';
$modules['widgets'] = 'htmlwidgets';
require_once $set['include_path'] . '/lib/templater.php';
$modules['templater'] = 'templater';
require_once $set['include_path'] . '/lib/bbcode.php';
$modules['bbcode'] = 'bbcode';
require_once $set['include_path'] . '/lib/tool.php';
$modules['validator'] = 'tool';
require_once $set['include_path'] . '/lib/readmarker.php';
$modules['readmarker'] = 'readmarker';
require_once $set['include_path'] . '/lib/activeutil.php';
$modules['active'] = 'activeutil';


// Other variables that we can allow addons to change
$modules['default_module'] = 'main';
$modules['default_admin_module'] = 'home';
$modules['public_modules'] = array(
	'help',
	'jsdata',
	'jslang',
	'mod',
	'post',
	'register',
	'login',
	'forum',
	'topic');
$modules['admin_modules'] = array(
	'backup',
	'ban',
	'censoring',
	'cms',
	'emot_control',
	'forums',
	'groups',
	'help',
	'Admin',
	'logs',
	'mass_mail',
	'membercount',
	'member_control',
	'optimize',
	'perms',
	'php_info',
	'prune',
	'query',
	'settings',
	'stats',
	'templates',
	'titles');

// These are generic enough that you shouldn't need to customise them
require_once $set['include_path'] . '/lib/modlet.php';
require_once $set['include_path'] . '/lib/xmlparser.php';
require_once $set['include_path'] . '/func/constants.php';
require_once $set['include_path'] . '/lib/globalfunctions.php';

?>
