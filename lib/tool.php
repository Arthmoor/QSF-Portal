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
 * Generic functions. Mostly validator stuff
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @since 1.2
 **/
class tool
{
	/**
	 * Checks if parameter is valid according to the rules passed
	 *
	 * Typical uses are:
	 * validate( $this->get['f'], TYPE_UINT )
	 * validate( $this->get['order'], TYPE_STRING, array( 'title', 'starter', 'replies', 'views' ), '' )
	 * validate( $this->post['adminemail'], TYPE_EMAIL, null, 'root@localhost' )
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @param mixed $var Variable from the user, typically a get or post
	 * @param int $type Type to check against. See TYPE defaults in constants.php
	 * @param array $range optional A range of values of $type the variable must match
	 * @param mixed $default optional A default value if the check fails
	 * @return true if $var is valid and unchanged, false if a match failed
	 */
	public function validate( &$var, $type, $range = null, $default = null )
	{
		$unchanged = true;

		switch( $type )
		{
			case TYPE_BOOLEAN:
				// $range and $default are unused
				if( !filter_var( $var, FILTER_VALIDATE_BOOLEAN ) ) {
					$unchanged = false;
				}
				$var = ( true && $var ); // Convert to a proper boolean
				break;

			case TYPE_UINT:
				// Clip anything negative for UINTs before validating them.
				if( $var < 0 )
					$var = 0;

				if( !filter_var( $var, FILTER_VALIDATE_INT ) ) {
					$unchanged = false;

					if( $default != null )
						$var = $default;
				}
				break;

			case TYPE_INT:
				if( !filter_var( $var, FILTER_VALIDATE_INT ) ) {
					$unchanged = false;

					if( $default != null )
						$var = $default;
				}
				break;

			case TYPE_FLOAT:
				if( !filter_var( $var, FILTER_VALIDATE_FLOAT ) ) {
					$unchanged = false;

					if( $default != null )
						$var = $default;
				}
				break;

			case TYPE_STRING:
				if( !is_string( $var ) || ( $range != null && !in_array( $var, $range ) ) ) {
					$unchanged = false;

					if( $default != null )
						$var = $default;
				}
				break;

			case TYPE_ARRAY:
				// $range is unused
				if( !is_array( $var ) ) {
					$unchanged = false;

					if( $default != null )
						$var = $default;
				}
				break;

			case TYPE_USERNAME:
				// $range is unused
				if( !is_string( $var ) || strlen( $var ) > 30 ) {
					$unchanged = false;
				}
				break;

			case TYPE_PASSWORD:
				// $range is unused
				if( !is_string( $var ) || strlen( $var ) < 8 || strlen( $var ) > 255 ) {
					$unchanged = false;
				}
				break;

			case TYPE_EMAIL:
				// $range is unused
				if( !filter_var( $var, FILTER_VALIDATE_EMAIL ) ) {
					$unchanged = false;
				}
				break;

         case TYPE_EMAIL_DOMAIN:
            // $range is unused
            list( $username, $domainname ) = explode( '@', $var );

            $response = checkdnsrr( $domainname, 'MX' );

            if( !response )
               $unchanged = false;
            break;

			default:
				// Invalid type! Only developers should ever see this error
				error( QUICKSILVER_ERROR, "Invalid type sent to validate()", __FILE__, __LINE__ );
		}
		return $unchanged;
	}
}
?>