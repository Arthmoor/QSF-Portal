<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2025 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * https://github.com/Arthmoor/Quicksilver-Forums
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

if( !defined( 'QUICKSILVERFORUMS' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

/**
 * Handles error messages
 *
 * @param int $type The error code
 * @param string $message A string describing the error
 * @param string $file The filename in which the error occurred
 * @param int $line The line number on which the error occurred
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 * @return void
 **/
function error( $type, $message, $file = null, $line = 0 )
{
	global $set; // Get the settings!

	if( function_exists( 'error_fatal' ) || !( error_reporting() & $type ) ) {
		return;
	}

	include $set['include_path'] . '/lib/error.php';

	switch( $type )
	{
	// Triggered Quicksilver Forums errors
	case QUICKSILVER_ERROR:
		exit( error_warning( $message, $file, $line ) );
		break;

	// Triggered Quicksilver Forums notices and alerts
	case QUICKSILVER_NOTICE:
		exit( error_notice( $message ) );
		break;

	// Database errors
	case QUICKSILVER_QUERY_ERROR:
		exit( error_fatal( $type, $message, $file, $line ) );
		break;

	// PHP errors
	default:
		exit( error_fatal( $type, $message, $file, $line ) );
		break;
	}
}
?>