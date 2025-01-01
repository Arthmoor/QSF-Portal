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

if( !defined( 'QUICKSILVERFORUMS' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

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

			$xtpl->assign( 'site', $this->site );
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

			$stmt = $this->db->prepare_query( 'SELECT user_id, user_password FROM %pusers WHERE user_name=? AND user_id != ? LIMIT 1' );

         $uid = intval( USER_GUEST_UID );
         $stmt->bind_param( 'si', $this->post['user'], $uid );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $data = $this->db->nqfetch( $result );
         $stmt->close();

			if( !isset( $data ) )
				return $this->message( $this->lang->login_header, $this->lang->login_cant_logged );

			$pass  = $data['user_password'];
			$user  = $data['user_id'];

			if( password_verify( $this->post['pass'], $pass ) ) {
            $hashcheck = $this->check_hash_update( $this->post['pass'], $data['user_password'] );
            if( $hashcheck != $pass ) {
               $pass = $hashcheck;

               $stmt = $this->db->prepare( 'UPDATE %pusers SET user_password=? WHERE user_id=?' );

               $stmt->bind_param( 'si', $pass, $data['user_id'] );
               $this->db->execute_query( $stmt );
               $stmt->close();
            }

				$options = array( 'expires' => $this->time + $this->sets['logintime'], 'path' => $this->sets['cookie_path'], 'domain' => $this->sets['cookie_domain'], 'secure' => $this->sets['cookie_secure'], 'HttpOnly' => true, 'SameSite' => 'Lax' );

				setcookie( $this->sets['cookie_prefix'] . 'user', $user, $options );
				setcookie( $this->sets['cookie_prefix'] . 'pass', $pass, $options );

				return $this->message( $this->lang->login_header, $this->lang->login_logged, $this->lang->continue, str_replace( '&', '&amp;', $this->post['request_uri'] ), $this->post['request_uri'] );
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
			return $this->message( $this->lang->login_out, sprintf( $this->lang->login_sure, $this->user['user_name'] ), $this->lang->continue, "{$this->site}/index.php?a=login&amp;s=off&amp;sure=1" );
		} else {
			$this->activeutil->delete( $this->user['user_id'] );

			$stmt = $this->db->prepare_query( 'UPDATE %pusers SET user_lastvisit=? WHERE user_id=?' );

         $stmt->bind_param( 'ii', $this->time, $this->user['user_id'] );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$options = array( 'expires' => $this->time - 9000, 'path' => $this->sets['cookie_path'], 'domain' => $this->sets['cookie_domain'], 'secure' => $this->sets['cookie_secure'], 'HttpOnly' => true, 'SameSite' => 'Lax' );

			setcookie( $this->sets['cookie_prefix'] . 'user', '', $options );
			setcookie( $this->sets['cookie_prefix'] . 'pass', '', $options );

			$_SESSION = array();

			session_destroy();

			$this->perms->is_guest = true;

			header( 'Clear-Site-Data: "*"' );
			return $this->message( $this->lang->login_out, sprintf( $this->lang->login_now_out, $this->self, $this->self ) );
		}
	}

	private function reset_pass()
	{
		$this->set_title( $this->lang->login_pass_reset );
		$this->tree( $this->lang->login_pass_reset );

		if( !isset( $this->post['submit'] ) ) {
			$xtpl = new XTemplate( './skins/' . $this->skin . '/login.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'login_pass_reset', $this->lang->login_pass_reset );
			$xtpl->assign( 'login_user', $this->lang->login_user );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'LoginPass' );
			return $xtpl->text( 'LoginPass' );
		} else {
			$stmt = $this->db->prepare_query( 'SELECT user_id, user_name, user_password, user_joined, user_email FROM %pusers WHERE user_name=? AND user_id != ? LIMIT 1' );

         $uname = $this->format( $this->post['user'], FORMAT_HTMLCHARS | FORMAT_CENSOR );
         $uid = intval( USER_GUEST_UID );
         $stmt->bind_param( 'si', $uname, $uid );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $target = $this->db->nqfetch( $result );
         $stmt->close();

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

		$stmt = $this->db->prepare_query( 'SELECT user_id, user_name, user_email FROM %pusers
			WHERE MD5(CONCAT(user_email, user_name, user_password, user_joined))=? AND user_id != ? LIMIT 1' );

      $validate = preg_replace( '/[^a-z0-9]/', '', $this->get['e'] );
      $uid = intval( USER_GUEST_UID );
      $stmt->bind_param( 'si', $validate, $uid );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $target = $this->db->nqfetch( $result );
      $stmt->close();

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

		$stmt = $this->db->prepare_query( 'UPDATE %pusers SET user_password=? WHERE user_id=?' );

      $stmt->bind_param( 'si', $dbpass, $target['user_id'] );
      $this->db->execute_query( $stmt );
      $stmt->close();

		return $this->message( $this->lang->login_pass_reset, $this->lang->login_pass_sent );
	}
}
?>