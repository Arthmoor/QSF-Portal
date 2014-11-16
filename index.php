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
 
define('QUICKSILVERFORUMS', true);
define('QSF_PUBLIC', true);

$time_now   = explode(' ', microtime());
$time_start = $time_now[1] + $time_now[0];

srand((double)microtime() * 1234567);

require './settings.php';
$set['include_path'] = '.';
require_once $set['include_path'] . '/defaultutils.php';

if (!$set['installed']) {
	header('Location: ./install/index.php');
}

set_error_handler('error');

error_reporting(E_ALL);
set_magic_quotes_runtime(0);

// Check for any addons available
include_addons($set['include_path'] . '/addons/');

// Open connection to database
$db = new $modules['database']($set['db_host'], $set['db_user'], $set['db_pass'], $set['db_name'], $set['db_port'], $set['db_socket'], $set['prefix']);
if (!$db->connection) {
    error(QUICKSILVER_ERROR, 'A connection to the database could not be established and/or the specified database could not be found.', __FILE__, __LINE__);
}
$settings = $db->fetch("SELECT settings_data FROM %psettings LIMIT 1");
$set = array_merge($set, unserialize($settings['settings_data']));

if (!isset($_GET['a']) || !in_array($_GET['a'], 
		array_merge($set['optional_modules'], $modules['public_modules']))) {
	$module = $modules['default_module'];
} else {
	$module = $_GET['a'];
}

require './func/' . $module . '.php';

$qsf = new $module($db);
$qsf->pre = $set['prefix'];

$qsf->get['a'] = $module;
$qsf->sets     = $set;
$qsf->modules  = $modules;

if ($qsf->sets['output_buffer'] && isset($qsf->server['HTTP_ACCEPT_ENCODING']) && stristr($qsf->server['HTTP_ACCEPT_ENCODING'], 'gzip')) {
	if( !@ob_start('ob_gzhandler') ) {
		ob_start();
	}
}

header( 'P3P: CP="CAO PSA OUR"' );
session_start();

$qsf->user_cl = new $modules['user']($qsf);
$qsf->user    = $qsf->user_cl->login();
$qsf->lang    = $qsf->get_lang($qsf->user['user_language'], $qsf->get['a']);
$qsf->session = &$_SESSION;
$qsf->session['id'] = session_id();

if (!isset($qsf->get['skin'])) {
	$qsf->skin = $qsf->user['skin_dir'];
} else {
	$qsf->skin = $qsf->get['skin'];
}

$qsf->init();

$server_load = $qsf->get_load();

$qsf->tree($qsf->sets['forum_name'], "$qsf->self?a=board");

if ($qsf->is_banned()) {
	error(QUICKSILVER_NOTICE, $qsf->lang->main_banned);
}

$reminder = null;
$reminder_text = null;

if ($qsf->sets['closed']) {
	if (!$qsf->perms->auth('board_view_closed')) {
		if ($qsf->get['a'] != 'login') {
			error(QUICKSILVER_NOTICE, $qsf->sets['closedtext'] . "<br /><hr />If you are an administrator, <a href='$qsf->self?a=login&amp;s=on'>click here</a> to login.");
		}
	} else {
		$reminder_text = $qsf->lang->main_reminder_closed . '<br />&quot;' . $qsf->sets['closedtext'] . '&quot;';
	}
}

if ($qsf->user['user_group'] == USER_AWAIT) {
	$reminder_text = "{$qsf->lang->main_activate}<br /><a href='{$qsf->self}?a=register&amp;s=resend'>{$qsf->lang->main_activate_resend}</a>";
}

if ($reminder_text) {
	$reminder = eval($qsf->template('MAIN_REMINDER'));
}

if ($qsf->sets['max_load'] && ($server_load > $qsf->sets['max_load'])) {
	error(QUICKSILVER_NOTICE, sprintf($qsf->lang->main_max_load, $qsf->sets['forum_name']));
}

$qsf->add_feed($qsf->sets['loc_of_board'] . $qsf->mainfile . '?a=rssfeed');

$output = $qsf->execute();

if (($qsf->get['a'] == 'forum') && isset($qsf->get['f'])) {
	$searchlink = '&amp;f=' . intval($qsf->get['f']);
} else {
	$searchlink = null;
}

$userheader = eval($qsf->template('MAIN_HEADER_' . ($qsf->perms->is_guest ? 'GUEST' : 'MEMBER')));

$title = isset($qsf->title) ? $qsf->title : $qsf->sets['forum_name'];

$time_now  = explode(' ', microtime());
$time_exec = round($time_now[1] + $time_now[0] - $time_start, 4);

if (isset($qsf->get['debug'])) {
	$output = $qsf->show_debug($server_load, $time_exec);
}

if (!$qsf->nohtml) {
	$servertime = $qsf->mbdate( DATE_LONG, $qsf->time, false );
	$copyright = eval($qsf->template('MAIN_COPYRIGHT'));
	$quicksilverforums = $output;
	echo eval($qsf->template('MAIN'));
} else {
	echo $output;
}

@ob_end_flush();
@flush();

// Do post output stuff
$qsf->cleanup();

?>
