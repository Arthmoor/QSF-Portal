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
require_once $set['include_path'] .  '/lib/file_perms.php';
$modules['file_permissions'] = 'file_permissions';
require_once $set['include_path'] .  '/lib/user.php';
$modules['user'] = 'user';
require_once $set['include_path'] .  '/lib/mailer.php';
$modules['mailer'] = 'mailer';
require_once $set['include_path'] . '/lib/attachutil.php';
$modules['attach'] = 'attachutil';
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

// These are generic enough that you shouldn't need to customise them
require_once $set['include_path'] . '/lib/modlet.php';
require_once $set['include_path'] . '/func/constants.php';
require_once $set['include_path'] . '/lib/globalfunctions.php';
?>