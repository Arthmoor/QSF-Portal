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

if( version_compare( PHP_VERSION, "7.0.0", "<" ) ) {
	die( 'PHP version does not meet minimum requirements. Contact your system administrator.' );
}

define( 'QUICKSILVERFORUMS', true );
define( 'QSF_ADMIN', true );

date_default_timezone_set( 'UTC' );

$time_now   = explode( ' ', microtime() );
$time_start = $time_now[1] + $time_now[0];

require '../settings.php';
$set['include_path'] = '..';
require_once $set['include_path'] . '/lib/' . $set['dbtype'] . '.php';
$database = 'db_' . $set['dbtype'];
require_once $set['include_path'] . '/lib/globalfunctions.php';
require_once $set['include_path'] . '/lib/perms.php';
require_once $set['include_path'] . '/lib/file_perms.php';
require_once $set['include_path'] . '/lib/user.php';
require_once $set['include_path'] . '/lib/mailer.php';
require_once $set['include_path'] . '/lib/attachutil.php';
require_once $set['include_path'] . '/lib/htmlwidgets.php';
require_once $set['include_path'] . '/lib/bbcode.php';
require_once $set['include_path'] . '/lib/tool.php';
require_once $set['include_path'] . '/lib/readmarker.php';
require_once $set['include_path'] . '/lib/activeutil.php';
require_once $set['include_path'] . '/lib/modlet.php';
require_once $set['include_path'] . '/lib/zTemplate.php';

if( !$set['installed'] ) {
	header( 'Location: ../install/index.php' );
}

set_error_handler( 'error' );

error_reporting( E_ALL );

/*
 * Logic here:
 * If 'a' is not set, but some other query is, it's a bogus request for this software.
 * If 'a' is set, but the module doesn't exist, it's either a malformed URL or a bogus request.
 * Otherwise $missing remains false and no error is generated later.
 */
$module = null;
$qstring = null;
$missing = false;

if( !isset( $_GET['a'] ) ) {
	$module = 'home';

	if( isset( $_SERVER['QUERY_STRING'] ) && !empty( $_SERVER['QUERY_STRING'] ) ) {
		$qstring = $_SERVER['QUERY_STRING'];

		$missing = true;
	}
} elseif( !empty( $_GET['a'] ) ) {
	$a = trim( $_GET['a'] );

	// Should restrict us to only valid alphabetic characters, which are all that's valid for this software.
	if( !preg_match( '/^[a-zA-Z_]*$/', $a ) ) {
		if( isset( $_SERVER['QUERY_STRING'] ) && !empty( $_SERVER['QUERY_STRING'] ) ) {
			$qstring = $_SERVER['QUERY_STRING'];
		}

		$missing = true;

		$_SESSION = array();

		session_destroy();

		header( 'Clear-Site-Data: "*"' );
	} elseif( !file_exists( 'sources/' . $a . '.php' ) ) {
		$qstring = $_SERVER['REQUEST_URI'];

		$missing = true;
	} else {
		$module = $a;
	}
} else {
	if( isset( $_SERVER['QUERY_STRING'] ) && !empty( $_SERVER['QUERY_STRING'] ) ) {
		$qstring = $_SERVER['QUERY_STRING'];

		$missing = true;
	}
}

// I know this looks corny and all but it mimics the output from a real 404 page.
if( $missing ) {
	header( 'HTTP/1.0 404 Not Found' );

	echo( "<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
	<html><head>
	<title>404 Not Found</title>
	</head><body>
	<h1>Not Found</h1>
	<p>The requested URL $qstring was not found on this server.</p>
	<hr>
	{$_SERVER['SERVER_SIGNATURE']}	</body></html>" );

	exit( );
}

require './sources/' . $module . '.php';

$db = new $database( $set['db_host'], $set['db_user'], $set['db_pass'], $set['db_name'], $set['db_port'], $set['db_socket'], $set['prefix'] );

if( !$db->connection ) {
	error( QUICKSILVER_ERROR, 'A connection to the database could not be established and/or the specified database could not be found.', __FILE__, __LINE__ );
}

$admin = new $module( $db );

$admin->get['a'] = $module;
$admin->pre      = $set['prefix'];
$admin->sets     = $admin->get_settings( $set );
$admin->site     = $admin->sets['loc_of_board']; // Will eventually replace $admin->self once the SEO URL changes are done.
$admin->user_cl  = new user( $admin );
$admin->user     = $admin->user_cl->login();
$admin->lang     = $admin->get_lang( $admin->user['user_language'], $admin->get['a'] );

// Init function also checks permissions and kicks out non-admins
$admin->init();

$options = array( 'cookie_httponly' => true );

if( $qsf->settings['cookie_secure'] ) {
	$options['cookie_secure'] = true;
}

session_start( $options );

// Security header options
if( $admin->sets['htts_enabled'] && $admin->sets['htts_max_age'] > -1 ) {
	header( "Strict-Transport-Security: max-age={$admin->sets['htts_max_age']}" );
}

if( $admin->sets['xss_enabled'] ) {
	if( $admin->sets['xss_policy'] == 0 ) {
		header( 'X-XSS-Protection: 0' );
	}

	if( $admin->sets['xss_policy'] == 1 ) {
		header( 'X-XSS-Protection: 1' );
	}

	if( $admin->sets['xss_policy'] == 2 ) {
		header( 'X-XSS-Protection: 1; mode=block' );
	}
}

if( $admin->sets['xfo_enabled'] ) {
	if( $admin->sets['xfo_policy'] == 0 ) {
		header( 'X-Frame-Options: deny' );
	}

	if( $admin->sets['xfo_policy'] == 1 ) {
		header( 'X-Frame-Options: sameorigin' );
	}

	if( $admin->sets['xfo_policy'] == 2 ) {
		header( "X-Frame-Options: allow-from {$admin->sets['xfo_allowed_origin']}" );
	}
}

if( $admin->sets['xcto_enabled'] ) {
	header( 'X-Content-Type-Options: nosniff' );
}

if( $admin->sets['ect_enabled'] ) {
	header( "Expect-CT: max-age={$admin->sets['ect_max_age']}" );
}

if( $admin->sets['csp_enabled'] ) {
	header( "Content-Security-Policy: {$admin->sets['csp_details']}" );
}

if( !isset( $admin->get['skin'] ) ) {
	$skin = $admin->db->fetch( 'SELECT skin_dir FROM %pskins WHERE skin_id=%d', $admin->user['user_skin'] );

	$admin->skin = $skin['skin_dir'];
} elseif( $admin->perms->auth( 'is_admin' ) ) {
	$admin->skin = 'default';

	// Allow admins to specify a skin manually for development purposes.
	$skin = intval( $admin->get['skin'] );

	$dev_skin = $admin->db->fetch( 'SELECT skin_dir FROM %pskins WHERE skin_id=%d', $skin );

	if( $dev_Skin )
		$admin->skin = $dev_skin['skin_dir'];
}

$xtpl = new XTemplate( '../skins/' . $admin->skin . '/admincp/index.xtpl' );
$admin->xtpl = $xtpl;

$output = $admin->execute();

if( $admin->nohtml ) {
	ob_start( 'ob_gzhandler' );

	echo $output;

	@ob_end_flush();
	@flush();
} else {
	$xtpl->assign( 'language_code', $admin->user['user_language'] );
	$xtpl->assign( 'charset', $admin->lang->charset );
	$xtpl->assign( 'site', $admin->site );
	$xtpl->assign( 'skin', $admin->skin );

	$title = isset( $qsf->title ) ? $qsf->title : $admin->name .' Admin CP';
	$xtpl->assign( 'title', $title );

	$xtpl->assign( 'admin_settings', $admin->lang->admin_settings );
	$xtpl->assign( 'admin_edit_settings', $admin->lang->admin_edit_settings );
	$xtpl->assign( 'admin_settings_add', $admin->lang->admin_settings_add );
	$xtpl->assign( 'admin_new_captcha', $admin->lang->admin_new_captcha );
	$xtpl->assign( 'admin_list_captcha', $admin->lang->admin_list_captcha );
	$xtpl->assign( 'admin_censor', $admin->lang->admin_censor );
	$xtpl->assign( 'admin_emojis', $admin->lang->admin_emojis );
	$xtpl->assign( 'admin_phpinfo', $admin->lang->admin_phpinfo );
	$xtpl->assign( 'admin_logs', $admin->lang->admin_logs );
	$xtpl->assign( 'admin_stats', $admin->lang->admin_stats );

	$xtpl->assign( 'admin_forums', $admin->lang->admin_forums );
	$xtpl->assign( 'admin_create_forum', $admin->lang->admin_create_forum );
	$xtpl->assign( 'admin_edit_forum', $admin->lang->admin_edit_forum );
	$xtpl->assign( 'admin_delete_forum', $admin->lang->admin_delete_forum );
	$xtpl->assign( 'admin_forum_order', $admin->lang->admin_forum_order );
	$xtpl->assign( 'admin_recount_forums', $admin->lang->admin_recount_forums );
	$xtpl->assign( 'admin_prune', $admin->lang->admin_prune );

	$xtpl->assign( 'admin_members', $admin->lang->admin_members );
	$xtpl->assign( 'admin_edit_member', $admin->lang->admin_edit_member );
	$xtpl->assign( 'admin_delete_member', $admin->lang->admin_delete_member );
	$xtpl->assign( 'admin_edit_member_perms', $admin->lang->admin_edit_member_perms );
	$xtpl->assign( 'admin_edit_member_file_perms', $admin->lang->admin_edit_member_file_perms );
	$xtpl->assign( 'admin_add_member_titles', $admin->lang->admin_add_member_titles );
	$xtpl->assign( 'admin_edit_member_titles', $admin->lang->admin_edit_member_titles );
	$xtpl->assign( 'admin_ban_ips', $admin->lang->admin_ban_ips );
	$xtpl->assign( 'admin_mass_mail', $admin->lang->admin_mass_mail );
	$xtpl->assign( 'admin_fix_stats', $admin->lang->admin_fix_stats );

	$xtpl->assign( 'admin_groups', $admin->lang->admin_groups );
	$xtpl->assign( 'admin_create_group', $admin->lang->admin_create_group );
	$xtpl->assign( 'admin_edit_group_name', $admin->lang->admin_edit_group_name );
	$xtpl->assign( 'admin_edit_group_perms', $admin->lang->admin_edit_group_perms );
	$xtpl->assign( 'admin_edit_group_file_perms', $admin->lang->admin_edit_group_file_perms );
	$xtpl->assign( 'admin_delete_group', $admin->lang->admin_delete_group );

	$xtpl->assign( 'admin_skins', $admin->lang->admin_skins );
	$xtpl->assign( 'admin_manage_skins', $admin->lang->admin_manage_skins );

	$xtpl->assign( 'admin_db', $admin->lang->admin_db );
	$xtpl->assign( 'admin_db_backup', $admin->lang->admin_db_backup );
	$xtpl->assign( 'admin_db_restore', $admin->lang->admin_db_restore );
	$xtpl->assign( 'admin_db_optimize', $admin->lang->admin_db_optimize );
	$xtpl->assign( 'admin_db_repair', $admin->lang->admin_db_repair );
	$xtpl->assign( 'admin_db_query', $admin->lang->admin_db_query );

	if( $admin->get['a'] != 'home' ) {
		$xtpl->assign( 'navtree', $admin->htmlwidgets->tree );

		$xtpl->parse( 'Index.NavTree' );
	}

	$xtpl->assign( 'admin_main', $output );

	$xtpl->assign( 'admin_your_board', $admin->lang->admin_your_board );
	$xtpl->assign( 'admin_poweredby', $admin->lang->powered );
	$xtpl->assign( 'admin_name', $admin->name );
	$xtpl->assign( 'admin_version', $admin->version );
	$xtpl->assign( 'admin_based_on', $admin->lang->based_on );

	$time_now  = explode( ' ', microtime() );
	$time_exec = round( ( $time_now[1] + $time_now[0] ) - $time_start, 4 );

	$xtpl->assign( 'time_exec', $time_exec );
	$xtpl->assign( 'query_count', $admin->db->querycount );

	$xtpl->parse( 'Index' );

	ob_start( 'ob_gzhandler' );

	$xtpl->out( 'Index' );

	@ob_end_flush();
	@flush();
}

// Close the DB connection.
$admin->db->close();
?>