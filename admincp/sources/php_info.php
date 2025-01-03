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

if( !defined( 'QUICKSILVERFORUMS') || !defined('QSF_ADMIN' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

/**
 * PHP Info Page
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 3.0
 **/
class php_info extends admin
{
	public function execute()
	{
		$this->nohtml = true;

		if( !function_exists( 'phpinfo' ) ) {
			return $this->message( $this->lang->php_error, $this->lang->php_error_msg );
		}

		ob_start();
		phpinfo();
		$phpinfo = ob_get_contents();
		ob_end_clean();

		return $phpinfo;
	}
}
?>