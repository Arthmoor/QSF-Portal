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

define('QUICKSILVERFORUMS', true);
define('QSF_ADMIN', true);

date_default_timezone_set('America/Los_Angeles');

$time_now   = explode(' ', microtime());
$time_start = $time_now[1] + $time_now[0];

require '../settings.php';
$set['include_path'] = '..';
require_once $set['include_path'] . '/defaultutils.php';

if (!$set['installed']) {
	header('Location: ../install/index.php');
}

ob_start('ob_gzhandler');

session_start();

set_error_handler('error');

error_reporting(E_ALL);

// Check for any addons available
include_addons($set['include_path'] . '/addons/');

/*
 * Logic here:
 * If 'a' is not set, but some other query is, it's a bogus request for this software.
 * If 'a' is set, but the module doesn't exist, it's either a malformed URL or a bogus request.
 * Otherwise $missing remains false and no error is generated later.
 */
$missing = false;
if (!isset($_GET['a']) ) {
	$module = $modules['default_admin_module'];
	if( isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']) )
		$missing = true;
} elseif ( !file_exists( 'sources/' . $_GET['a'] . '.php' ) ) {
	$module = $modules['default_admin_module'];

	$missing = true;
} else {
	$module = $_GET['a'];
}

if ( strstr($module, '/') || strstr($module, '\\') ) {
	header('HTTP/1.0 403 Forbidden');
	exit( 'You have been banned from this site.' );
}

require './sources/' . $module . '.php';

$db = new $modules['database']($set['db_host'], $set['db_user'], $set['db_pass'], $set['db_name'], $set['db_port'], $set['db_socket'], $set['prefix']);

if (!$db->connection) {
	exit('<center><font face="verdana" size="4" color="#000000"><b>A connection to the database could not be established and/or the specified database could not be found.</font></center>');
}

$admin = new $module($db);

$admin->get['a'] = $module;
$admin->pre      = $set['prefix'];
$admin->sets     = $admin->get_settings($set);
$admin->site     = $admin->sets['loc_of_board']; // Will eventually replace $admin->self once the SEO URL changes are done.
$admin->modules  = $modules;
$admin->user_cl  = new $admin->modules['user']($admin);
$admin->user     = $admin->user_cl->login();
$admin->lang     = $admin->get_lang($admin->user['user_language'], $admin->get['a']);
$server_load     = $admin->get_load();

if (!isset($admin->get['skin'])) {
	$admin->skin = $admin->user['skin_dir'];
} else {
	$admin->skin = $admin->get['skin'];
}

$admin->init();

$output = $admin->execute();

$title = isset($qsf->title) ? $qsf->title : $admin->name .' Admin CP';

$time_now  = explode(' ', microtime());
$time_exec = round(($time_now[1] + $time_now[0]) - $time_start, 4);

if (!$admin->nohtml) {
	$admin_main = $output . eval($admin->template('ADMIN_COPYRIGHT'));
	echo eval($admin->template('ADMIN_INDEX'));
} else {
	echo $output;
}
@ob_end_flush();
@flush();

// Close the DB connection.
$admin->db->close();
?>