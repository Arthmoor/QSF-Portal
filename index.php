<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2019 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * https://github.com/Arthmoor/Quicksilver-Forums
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
 
define( 'QUICKSILVERFORUMS', true );
define( 'QSF_PUBLIC', true );

date_default_timezone_set( 'UTC' );

$time_now   = explode( ' ', microtime() );
$time_start = $time_now[1] + $time_now[0];

srand( (double)microtime() * 1234567 );

$_REQUEST = array();

require './settings.php';
$set['include_path'] = '.';
require_once $set['include_path'] . '/defaultutils.php';

if( !$set['installed'] ) {
	header( 'Location: ./install/index.php' );
}

set_error_handler( 'error' );

error_reporting( E_ALL );

// Open connection to database
$db = new $modules['database']( $set['db_host'], $set['db_user'], $set['db_pass'], $set['db_name'], $set['db_port'], $set['db_socket'], $set['prefix'] );
if( !$db->connection ) {
	error( QUICKSILVER_ERROR, 'A connection to the database could not be established and/or the specified database could not be found.', __FILE__, __LINE__ );
}

/*
 * Logic here:
 * If 'a' is not set, but some other query is, it's a bogus request for this software.
 * If 'a' is set, but the module doesn't exist, it's either a malformed URL or a bogus request.
 * Otherwise $missing remains false and no error is generated later.
 */
$missing = false;
$terms_module = '';
if( !isset( $_GET['a'] ) ) {
	$module = $modules['default_module'];
	if( isset( $_SERVER['QUERY_STRING'] ) && !empty( $_SERVER['QUERY_STRING'] ) )
		$missing = true;
} elseif( !file_exists( 'func/' . $_GET['a'] . '.php' ) ) {
	$module = $modules['default_module'];

	if( $_GET['a'] != 'forum_rules' && $_GET['a'] != 'upload_rules' )
		$missing = true;
	else
		$terms_module = $_GET['a'];
} else {
	$module = $_GET['a'];
}

if( strstr( $module, '/' ) || strstr( $module, '\\' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	exit( 'You have been banned from this site.' );
}

require './func/' . $module . '.php';

$qsf = new $module( $db );
$qsf->pre = $set['prefix'];

$qsf->get['a'] = $module;
$qsf->sets     = $qsf->get_settings( $set );
$qsf->site     = $qsf->sets['loc_of_board']; // Will eventually replace $qsf->self once the SEO URL changes are done.
$qsf->modules  = $modules;

session_start();

$qsf->user_cl = new $modules['user']( $qsf );
$qsf->user    = $qsf->user_cl->login();
$qsf->lang    = $qsf->get_lang( $qsf->user['user_language'], $qsf->get['a'] );

if( !isset( $qsf->get['skin'] ) ) {
	$qsf->skin = $qsf->user['skin_dir'];
} else {
	$qsf->skin = $qsf->get['skin'];
}

$qsf->init();

if( $qsf->is_banned() ) {
	error( QUICKSILVER_NOTICE, $qsf->lang->main_banned );
}

$qsf->tree( $qsf->sets['forum_name'], "$qsf->self?a=board" );

$reminder = null;
$reminder_text = null;

if( $qsf->sets['closed'] ) {
	if( !$qsf->perms->auth( 'board_view_closed' ) ) {
		if( $qsf->get['a'] != 'login' ) {
			error( QUICKSILVER_NOTICE, $qsf->sets['closedtext'] . "<br /><hr />If you are an administrator, <a href='$qsf->self?a=login&amp;s=on'>click here</a> to login." );
		}
	} else {
		$reminder_text = $qsf->lang->main_reminder_closed . '<br />&quot;' . $qsf->sets['closedtext'] . '&quot;';
	}
}

if( $qsf->user['user_group'] == USER_AWAIT ) {
	$reminder_text = "{$qsf->lang->main_activate}<br /><a href='{$qsf->self}?a=register&amp;s=resend'>{$qsf->lang->main_activate_resend}</a>";
}

if( $reminder_text ) {
	$reminder = eval( $qsf->template( 'MAIN_REMINDER' ) );
}

$qsf->add_feed( $qsf->site . '/index.php?a=rssfeed' );

if( $missing ) {
	header( 'HTTP/1.0 404 Not Found' );
	$output = $qsf->message( $qsf->lang->error, $qsf->lang->error_404 );
} else {
	if( $terms_module == 'forum_rules' ) {
		$tos = $qsf->db->fetch( 'SELECT settings_tos FROM %psettings' );

		$message = $qsf->format( $tos['settings_tos'], FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_MBCODE );
		$output = $qsf->message( $qsf->lang->main_tos_forums, $message );
	} elseif ( $terms_module == 'upload_rules' ) {
		$tos = $qsf->db->fetch( 'SELECT settings_tos_files FROM %psettings' );

		$message = $qsf->format( $tos['settings_tos_files'], FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_MBCODE );
		$output = $qsf->message( $qsf->lang->main_tos_files, $message );
	} else {
		$output = $qsf->execute();
	}
}

if( ( $qsf->get['a'] == 'forum' ) && isset( $qsf->get['f'] ) ) {
	$searchlink = '&amp;f=' . intval( $qsf->get['f'] );
} else {
	$searchlink = null;
}

$spam_style = null;
if( $qsf->sets['spam_pending'] > 0 )
	$spam_style = ' class="attention"';
$can_spam = false;
if( $qsf->perms->auth('is_admin') || $qsf->user['user_group'] == USER_MODS )
	$can_spam = true;

$new_pm = null;
if( $qsf->get_messages() > 0 )
	$new_pm = ' class="attention"';

$new_files = null;
if( $qsf->get_files() > 0 )
	$new_files = ' class="attention"';
$userheader = eval( $qsf->template( 'MAIN_HEADER_' . ( $qsf->perms->is_guest ? 'GUEST' : 'MEMBER' ) ) );

$title = isset( $qsf->title ) ? $qsf->title : $qsf->sets['forum_name'];

$time_now  = explode( ' ', microtime() );
$qsf->time_exec = round( $time_now[1] + $time_now[0] - $time_start, 4 );

if( !$qsf->nohtml ) {
	ob_start( 'ob_gzhandler' );

	$google = null;
	if( isset( $qsf->sets['analytics_code'] ) && !empty( $qsf->sets['analytics_code'] ) ) {
		$google = $qsf->sets['analytics_code'];
	}
	$meta_keywords = $qsf->sets['meta_keywords'];
	$meta_desc = $qsf->sets['meta_description'];
	$servertime = $qsf->mbdate( DATE_LONG, $qsf->time, false );
	$copyright = eval( $qsf->template( 'MAIN_COPYRIGHT' ) );

	$quicksilverforums = $output;
	echo eval( $qsf->template( 'MAIN' ) );

	@ob_end_flush();
	@flush();
} else {
	echo $output;
}

// Do post output stuff
$qsf->cleanup();

// Close the DB connection.
$qsf->db->close();
?>