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

if( !defined( 'QUICKSILVERFORUMS' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

require_once $set['include_path'] . '/global.php';

/**
 * Allows user to log in and out of their accounts
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class login extends qsfglobal
{
	public function execute()
	{
		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		switch( $this->get['s'] )
		{
		case 'off':
			return $this->do_logout();
			break;

		case 'pass':
			return $this->reset_pass();
			break;

		case 'request':
			return $this->request_pass();
			break;

		default: //logon
			return $this->do_login();
		}
	}

	private function do_login()
	{
		$this->set_title( $this->lang->login_header );
		$this->tree( $this->lang->login_header );

		if( !isset( $this->post['submit'] ) ) {
			$request_uri = $this->get_uri();

			if( substr( $request_uri, -8 ) == 'register' ) {
				$request_uri = $this->self;
			}

			$xtpl = new XTemplate( './skins/' . $this->skin . '/login.xtpl' );

			$xtpl->assign( 'self', $this->self );
			$xtpl->assign( 'loc_of_board', $this->sets['loc_of_board'] );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'login_header', $this->lang->login_header );
			$xtpl->assign( 'login_user', $this->lang->login_user );
			$xtpl->assign( 'login_pass', $this->lang->login_pass );
			$xtpl->assign( 'login_forgot_pass', $this->lang->login_forgot_pass );
			$xtpl->assign( 'request_uri', $request_uri );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'LoginMain' );
			return $xtpl->text( 'LoginMain' );
		} else {
			if( !isset( $this->post['user'] ) )
				return $this->message( $this->lang->login_header, $this->lang->login_cant_logged );

			if( !isset( $this->post['pass'] ) )
				return $this->message( $this->lang->login_header, $this->lang->login_cant_logged );

			$username = str_replace( '\\', '&#092;', $this->format( $this->post['user'], FORMAT_HTMLCHARS | FORMAT_CENSOR ) );

			$data  = $this->db->fetch( "SELECT user_id, user_password FROM %pusers WHERE REPLACE(LOWER(user_name), ' ', '')='%s' AND user_id != %d LIMIT 1",
				str_replace( ' ', '', strtolower( $username ) ), USER_GUEST_UID );
			$pass  = $data['user_password'];
			$user  = $data['user_id'];

			if( password_verify( $this->post['pass'], $pass ) ) {
				setcookie( $this->sets['cookie_prefix'] . 'user', $user, $this->time + $this->sets['logintime'], $this->sets['cookie_path'], $this->sets['cookie_domain'], $this->sets['cookie_secure'], true );
				setcookie( $this->sets['cookie_prefix'] . 'pass', $pass, $this->time + $this->sets['logintime'], $this->sets['cookie_path'], $this->sets['cookie_domain'], $this->sets['cookie_secure'], true );

				$_SESSION['user'] = $user;
				$_SESSION['pass'] = md5( $pass . $this->ip );

				return $this->message( $this->lang->login_header, $this->lang->login_logged, $this->lang->continue, str_replace('&', '&amp;', $this->post['request_uri']), $this->post['request_uri'] );
			} else {
				return $this->message( $this->lang->login_header, sprintf( $this->lang->login_cant_logged, $this->self ) );
			}
		}
	}

	private function do_logout()
	{
		$this->set_title( $this->lang->login_out );
		$this->tree( $this->lang->login_out );

		if( !isset( $this->get['sure'] ) && !$this->perms->is_guest ) {
			return $this->message( $this->lang->login_out, sprintf( $this->lang->login_sure, $this->user['user_name'] ), $this->lang->continue, "$this->self?a=login&amp;s=off&amp;sure=1" );
		} else {
			$this->activeutil->delete( $this->user['user_id'] );

			$this->db->query( "UPDATE %pusers SET user_lastvisit=%d WHERE user_id=%d", $this->time, $this->user['user_id'] );

			setcookie( $this->sets['cookie_prefix'] . 'user', '', $this->time - 9000, $this->sets['cookie_path'], $this->sets['cookie_domain'], $this->sets['cookie_secure'], true );
			setcookie( $this->sets['cookie_prefix'] . 'pass', '', $this->time - 9000, $this->sets['cookie_path'], $this->sets['cookie_domain'], $this->sets['cookie_secure'], true );

			unset( $_SESSION['user'] );
			unset( $_SESSION['pass'] );

			$this->perms->is_guest = true;

			return $this->message( $this->lang->login_out, sprintf( $this->lang->login_now_out, $this->self, $this->self ) );
		}
	}

	private function reset_pass()
	{
		$this->set_title( $this->lang->login_pass_reset );
		$this->tree( $this->lang->login_pass_reset );

		if( !isset( $this->post['submit'] ) ) {
			$xtpl = new XTemplate( './skins/' . $this->skin . '/login.xtpl' );

			$xtpl->assign( 'self', $this->self );
			$xtpl->assign( 'loc_of_board', $this->sets['loc_of_board'] );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'login_pass_reset', $this->lang->login_pass_reset );
			$xtpl->assign( 'login_user', $this->lang->login_user );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'LoginPass' );
			return $xtpl->text( 'LoginPass' );
		} else {
			$target = $this->db->fetch( "SELECT user_id, user_name, user_password, user_joined, user_email
				FROM %pusers WHERE user_name='%s' AND user_id != %d LIMIT 1",
				$this->format( $this->post['user'], FORMAT_HTMLCHARS | FORMAT_CENSOR), USER_GUEST_UID );

			if( !isset( $target['user_id'] ) ) {
				return $this->message( $this->lang->login_pass_reset, $this->lang->login_pass_no_id );
			}

			$mailer = new mailer( $this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false );

			$message  = "{$this->sets['forum_name']}\n\n";
			$message .= "{$this->lang->login_someome_requested} {$this->post['user']}.\n";
			$message .= "{$this->lang->login_did_not_request}\n\n";
			$message .= "{$this->lang->login_did_request}\n";
			$message .= "{$this->sets['loc_of_board']}/index.php?a=login&s=request&e=" . md5( $target['user_email'] . $target['user_name'] . $target['user_password'] . $target['user_joined'] ) . "\n\n";
			$message .= "{$this->lang->login_request_ip} {$this->ip}";

			$mailer->setSubject( "{$this->sets['forum_name']} - {$this->lang->login_pass_reset}" );
			$mailer->setMessage( $message );
			$mailer->setRecipient( $target['user_email'] );
			$mailer->setServer( $this->sets['mailserver'] );
			$mailer->doSend();

			return $this->message( $this->lang->login_pass_reset, $this->lang->login_pass_request );
		}
	}

	private function request_pass()
	{
		$this->set_title( $this->lang->login_pass_reset );
		$this->tree( $this->lang->login_pass_reset );

		if( !isset( $this->get['e'] ) ) {
			$this->get['e'] = null;
		}

		$target = $this->db->fetch( "SELECT user_id, user_name, user_email FROM %pusers
			WHERE MD5(CONCAT(user_email, user_name, user_password, user_joined))='%s' AND user_id != %d LIMIT 1",
			 preg_replace( '/[^a-z0-9]/', '', $this->get['e'] ), USER_GUEST_UID );

		if( !isset( $target['user_id'] ) ) {
			return $this->message( $this->lang->login_pass_reset, $this->lang->login_pass_no_id );
		}

		$mailer = new mailer( $this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false );

		$newpass = $this->generate_pass( 8 );
		$dbpass = $this->qsfp_password_hash( $newpass );

		$message  = "{$this->sets['forum_name']}\n\n";
		$message .= "{$this->lang->login_request_done}\n\n$newpass\n\n";
		$message .= "{$this->lang->login_request_done2}\n\n";
		$message .= "{$this->sets['loc_of_board']}/index.php?a=login";

		$mailer->setSubject( "{$this->sets['forum_name']} - {$this->lang->login_pass_reset}" );
		$mailer->setMessage( $message );
		$mailer->setRecipient( $target['user_email'] );
		$mailer->setServer( $this->sets['mailserver'] );
		$mailer->doSend();

		$this->db->query( "UPDATE %pusers SET user_password='%s' WHERE user_id=%d", $dbpass, $target['user_id'] );

		return $this->message( $this->lang->login_pass_reset, $this->lang->login_pass_sent );
	}
}
?>