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
 * Creates a member account
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class register extends qsfglobal
{
   public function execute()
	{
		$this->set_title( $this->lang->register_reging );
		$this->tree( $this->lang->register_reging );

		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		switch( $this->get['s'] )
		{
		case 'activate':
			return $this->activateUser();
			break;

		case 'resend':
			return $this->send_activation_email( $this->user['user_email'], $this->user['user_name'], $this->user['user_password'], $this->user['user_id'] );
			break;

		default:
			return $this->registration();
		}
	}

	private function registration()
	{
		if( $this->sets['registrations_allowed'] == 0 )
			return $this->message( $this->lang->register_reging, $this->lang->register_registration_disabled );

		if( !isset( $this->post['submit'] ) ) {
			$math = '';

			$tos = $this->db->fetch( 'SELECT settings_tos FROM %psettings' );

			if( !$tos || empty( $tos['settings_tos'] ) ) {
				return $this->message( $this->lang->register_reging, $this->lang->register_tos_missing );
			}

			$tos_text = $this->format( $tos['settings_tos'], FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_BBCODE );
			$tos_text .= '<hr>';

			$tos_files = $this->db->fetch( 'SELECT settings_tos_files FROM %psettings' );
			$tos_text .= $this->format( $tos_files['settings_tos_files'], FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_BBCODE );

			$xtpl = new XTemplate( './skins/' . $this->skin . '/register.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );

			$xtpl->assign( 'register_reging', $this->lang->register_reging );
			$xtpl->assign( 'register_new_user', $this->lang->register_new_user );
			$xtpl->assign( 'register_email', $this->lang->register_email );
			$xtpl->assign( 'register_passwd', $this->lang->register_passwd );
			$xtpl->assign( 'register_confirm_passwd', $this->lang->register_confirm_passwd );

			if( $this->sets['register_image'] ) {
				$captcha = $this->db->fetch( 'SELECT * FROM %pcaptcha ORDER BY RAND() LIMIT 1' );

				// Fallback system for those who haven't added any appropriate captcha pairs. Not terribly effective anymore :(
				if( !$captcha ) {
					$type = mt_rand( 1,3 );
					$num1 = mt_rand();
					$num2 = mt_rand();
					$answer = 0;

					switch( $type )
					{
						case 1: $answer = $num1 + $num2; $op = '+'; break;
						case 2: $answer = $num1 - $num2; $op = '-'; break;
						case 3: $answer = $num1 * $num2; $op = '*'; break;
					}
					$math_prompt = $this->lang->register_what_is . " $num1 $op $num2 ?";
				} else {
					$math_prompt = $captcha['cap_question'];
					$answer = $captcha['cap_answer'];
				}

				$xtpl->assign( 'register_math_ask', $this->lang->register_math_ask );
				$xtpl->assign( 'math_prompt', $math_prompt );

				$xtpl->parse( 'Register.Captcha' );

				$_SESSION['question'] = $math_prompt;
				$_SESSION['answer'] = $answer;
			}
			$_SESSION['allow_register'] = true;

			$xtpl->assign( 'register_tos_read', $this->lang->register_tos_read );
			$xtpl->assign( 'tos_text', $tos_text );
			$xtpl->assign( 'register_tos_i_agree', $this->lang->register_tos_i_agree );


			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'register_reg', $this->lang->register_reg );

			$xtpl->parse( 'Register' );
			return $xtpl->text( 'Register' );
		} else {
			if( !isset( $_SESSION['allow_register'] ) ) {
				// They must allow sessions to register! The session can only be set by loading the form
				return $this->message( $this->lang->register_reging, $this->lang->register_cookie_required );
			}

			// Make sure the nasty bots who are deliberately not setting this stuff don't trigger a swarm of error emails!
			if( $this->sets['register_image'] ) {
				if( !isset( $this->post['user_math'] ) )
					return $this->message( $this->lang->register_reging, $this->lang->register_math_fail );

				$math = $this->post['user_math'];
				$math = mb_strtolower( $math, mb_detect_encoding( $math ) );

				$str = mb_strtolower( $_SESSION['answer'], mb_detect_encoding( $_SESSION['answer'] ) );
				$acceptable_answers = explode( ',', $str );

				if( !in_array( $math, $acceptable_answers ) )
					return $this->message( $this->lang->register_reging, $this->lang->register_math_fail );
			}

			$username = isset( $this->post['desuser'] ) ? $this->post['desuser'] : '';
			$email    = isset( $this->post['email'] ) ? $this->post['email'] : '';
			$pass     = isset( $this->post['passA'] ) ? $this->post['passA'] : '';
			$pass2    = isset( $this->post['passB'] ) ? $this->post['passB'] : '';

			if( ( trim( $username ) == '' )
			 || ( trim( $email ) == '' )
			 || ( trim( $pass ) == '' )
			 || ( trim( $pass2 ) == '' ) ) {
				return $this->message( $this->lang->register_reging, $this->lang->register_fields );
			}

			if( !$this->validator->validate( $username, TYPE_USERNAME ) ) {
				return $this->message( $this->lang->register_reging, $this->lang->register_name_invalid );
			}

			if( !isset( $this->post['terms'] ) ) {
				return $this->message( $this->lang->register_tos, $this->lang->register_tos_not_agree );
			}

			// Do some quick checks to prevent flooding registration
			if( isset( $_SESSION['last_register'] ) && $_SESSION['last_register'] > ( $this->time - $this->sets['flood_time'] ) ) {
				return $this->message( $this->lang->register_reging, $this->lang->register_flood );
			}
			$_SESSION['last_register'] = $this->time;

			$stmt = $this->db->prepare_query( 'SELECT user_id FROM %pusers WHERE user_name=?' );

         $stmt->bind_param( 's', $username );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $exists = $this->db->nqfetch( $result );
         $stmt->close();

			if( $exists ) {
				return $this->message( $this->lang->register_reging, $this->lang->register_name_taken );
			}

			$temp_email = $email;
			if( !$this->validator->validate( $temp_email, TYPE_EMAIL ) ) {
				return $this->message( $this->lang->register_reging, $this->lang->register_email_invalid );
			}

         if( !$this->validator->validate( $email, TYPE_EMAIL_DOMAIN ) ) {
            return $this->message( $this->lang->register_reging, $this->lang->register_email_domain_invalid );
         }

			if( $pass != $pass2 ) {
				return $this->message( $this->lang->register_reging, $this->lang->register_pass_match );
			}

			if( !$this->validator->validate( $pass, TYPE_PASSWORD ) ) {
 				return $this->message( $this->lang->register_reging, $this->lang->register_pass_invalid );
 			}

			$stmt = $this->db->prepare_query( 'SELECT user_email FROM %pusers WHERE user_email=?' );

         $stmt->bind_param( 's', $email );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $eexists = $this->db->nqfetch( $result );
         $stmt->close();

			if( $eexists ) {
				return $this->message( $this->lang->register_reging, $this->lang->register_email_used );
			}

         $timezone = $this->post['timezone'];
         if( !in_array( $timezone, timezone_identifiers_list() ) ) {
            $timezone = $this->sets['default_timezone'];
         }

			$pass = $this->qsfp_password_hash( $pass );
			$level = $this->get_level( 0 );

			if( $this->sets['emailactivation'] ) {
				$group_id = USER_AWAIT;
			} else {
				$group_id = $this->sets['default_group'];
			}

         // Store the contents of the entire $_SERVER array. Along with the captcha question. If bots get past this, knowing which question they got right may be helpful.
			$_SERVER['cap_question'] = $_SESSION['question'];
         $svars = json_encode( $_SERVER );

			// I'm not sure if the anti-spam code needs to use the escaped strings or not, so I'll feed them whatever the spammer fed me.
			if( !empty( $this->sets['wordpress_api_key'] ) && $this->sets['akismet_ureg'] ) {
				require_once $this->sets['include_path'] . '/lib/akismet.php';

				$spam_checked = false;
				$akismet = null;

				try {
					$akismet = new Akismet( $this );
					$akismet->set_comment_author( $username );
					$akismet->set_comment_author_email( $email );
					$akismet->set_comment_type( 'signup' );

					$spam_checked = true;
				}
				// Try and deal with it rather than say something.
				catch( Exception $e ) {}

				if( $spam_checked && $akismet != null ) {
               $response = $akismet->is_this_spam();

               if( isset( $response[1] ) && $response[1] == 'true' ) {
                  $this->log_action( 'Blocked Registration', 0, 0, 0 );

                  $this->sets['spam_reg_count']++;
                  $this->write_sets();

                  return $this->message( $this->lang->register_reging, $this->lang->register_akismet_ureg_spam );
               }
				}
			}

			$stmt = $this->db->prepare_query( "INSERT INTO %pusers (user_name, user_password, user_group, user_title, user_joined, user_email, user_skin, user_view_avatars, user_view_emojis, user_view_signatures,
				user_language, user_pm, user_timezone, user_regip, user_register_email, user_file_perms, user_server_data)
            VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '', ? )" );

         $stmt->bind_param( 'ssisissiiisissss', $username, $pass, $group_id, $level['user_title'], $this->time, $email, $this->sets['default_skin'], $this->sets['default_view_avatars'], $this->sets['default_view_emots'], $this->sets['default_view_sigs'],
				$this->user['user_language'], $this->sets['default_pm'], $timezone, $this->ip, $email, $svars );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$this->sets['last_member'] = $username;
			$this->sets['last_member_id'] = $this->db->insert_id( );
			$this->sets['members']++;
			$this->write_sets();

			$options = array( 'expires' => $this->time + $this->sets['logintime'], 'path' => $this->sets['cookie_path'], 'domain' => $this->sets['cookie_domain'], 'secure' => $this->sets['cookie_secure'], 'HttpOnly' => true, 'SameSite' => 'Lax' );

			setcookie( $this->sets['cookie_prefix'] . 'user', $this->sets['last_member_id'], $options );
			setcookie( $this->sets['cookie_prefix'] . 'pass', $pass, $options );

			if( $this->sets['emailactivation'] && $this->sets['emailactivation'] == true ) {
				$this->update_validation_table();
				return $this->send_activation_email( $email, $username, $pass, $this->sets['last_member_id'] );
			}

			return $this->message( $this->lang->register_reging, $this->lang->register_done );
		}
	}

	private function send_activation_email( $email, $username, $pass, $id )
	{
		$vhash = hash( 'sha512', $email . $username . $pass . $this->time );

		$mailer = new mailer( $this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false );

		$message = "{$this->lang->register_requested} {$username}\n";
		$message .= "{$this->lang->register_initiated} {$this->ip}\n\n";
		$message .= "{$this->lang->register_email_msg}\n";
		$message .= "{$this->lang->register_email_msg2} {$this->sets['forum_name']}.\n\n";
		$message .= "{$this->lang->register_email_msg3}\n";
		$message .= "{$this->site}/index.php?a=register&s=activate&e=" . $vhash . "\n\n";

		$mailer->setSubject( "{$this->sets['forum_name']} - {$this->lang->register_activating}" );
		$mailer->setMessage( $message );
		$mailer->setRecipient( $email );
		$mailer->setServer( $this->sets['mailserver'] );
		$mailer->doSend();

		$stmt = $this->db->prepare_query( 'REPLACE INTO %pvalidation (validate_id, validate_hash, validate_time, validate_ip, validate_user_agent) VALUES( ?, ?, ?, ?, ? )' );

      $stmt->bind_param( 'isiss', $id, $vhash, $this->time, $this->ip, $this->agent );
      $this->db->execute_query( $stmt );
      $stmt->close();

		return $this->message( $this->lang->register_reging, sprintf( $this->lang->register_must_activate, $email ) );
	}

	private function activateUser()
	{
		$this->update_validation_table();

		if( isset( $this->get['e'] ) ) {
			$stmt = $this->db->prepare_query( 'SELECT * FROM %pusers WHERE user_id=?' );

         $stmt->bind_param( 'i', $this->user['user_id'] );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $member = $this->db->nqfetch( $result );
         $stmt->close();

			if( $member && $member['user_id'] != USER_GUEST_UID && $member['user_group'] == USER_AWAIT ) {
				$stmt = $this->db->prepare_query( 'SELECT * FROM %pvalidation WHERE validate_id=?' );

            $stmt->bind_param( 'i', $this->user['user_id'] );
            $this->db->execute_query( $stmt );

            $result = $stmt->get_result();
            $valid = $this->db->nqfetch( $result );
            $stmt->close();

				if( $valid ) {
					$vhash = hash( 'sha512', $member['user_email'] . $member['user_name'] . $member['user_password'] . $valid['validate_time'] );

					if( $vhash == $this->get['e'] ) {
						$stmt = $this->db->prepare_query( 'UPDATE %pusers SET user_group=? WHERE user_id=?' );

                  $group = intval( USER_MEMBER );
                  $stmt->bind_param( 'ii', $group, $member['user_id'] );
                  $this->db->execute_query( $stmt );
                  $stmt->close();

						$stmt = $this->db->prepare_query( 'DELETE FROM %pvalidation WHERE validate_id=?' );

                  $stmt->bind_param( 'i', $valid['validate_id'] );
                  $this->db->execute_query( $stmt );
                  $stmt->close();

						return $this->message( $this->lang->register_activating, $this->lang->register_activated );
					}
				}
			}
		}
		return $this->message( $this->lang->register_activating, $this->lang->register_activation_error );
	}

	private function update_validation_table()
	{
		$expire = $this->time - 14400; // 4 hours

		$stmt = $this->db->prepare_query( 'DELETE FROM %pvalidation WHERE validate_time < ?' );

      $stmt->bind_param( 'i', $expire );
      $this->db->execute_query( $stmt );
      $stmt->close();
	}
}
?>