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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/global.php';

/**
 * Creates a member account
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class register extends qsfglobal
{
	function execute()
	{
		$this->set_title($this->lang->register_reging);
		$this->tree($this->lang->register_reging);

		if (!isset($this->get['s'])) {
			$this->get['s'] = null;
		}

		switch($this->get['s'])
		{
		case 'activate':
			return $this->activateUser();
			break;

		case 'resend':
			return $this->send_activation_email($this->user['user_email'], $this->user['user_name'], $this->user['user_password'], $this->user['user_joined']);
			break;

		default:
			return $this->registration();
		}
	}

	function registration()
	{
		if( $this->sets['registrations_allowed'] == 0 )
			return $this->message($this->lang->register_reging, $this->lang->register_registration_disabled);

		if (!isset($this->post['submit'])) {
			$math = '';
			$tos = $this->db->fetch('SELECT settings_tos FROM %psettings');
			$tos_text = $this->format( $tos['settings_tos'], FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_MBCODE );
			$tos_text .= '<hr>';

			$tos_files = $this->db->fetch('SELECT settings_tos_files FROM %psettings');
			$tos_text .= $this->format( $tos_files['settings_tos_files'], FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_MBCODE );

			$token = $this->generate_token();

			if ($this->sets['register_image']) {
				$captcha = $this->db->fetch( 'SELECT * FROM %pcaptcha ORDER BY RAND() LIMIT 1' );

				// Fallback system for those who haven't added any appropriate captcha pairs. Not terribly effective anymore :(
				if( !$captcha ) {
					$type = mt_rand(1,3);
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
				$math = eval($this->template('REGISTER_IMAGE'));
				$_SESSION['question'] = $math_prompt;
				$_SESSION['answer'] = $answer;
			}
			$_SESSION['allow_register'] = true;

			return eval($this->template('REGISTER_MAIN'));
		} else {
			if (!isset($_SESSION['allow_register'])) {
				// They must allow sessions to register! The session can only be set by loading the form
				return $this->message($this->lang->register_reging, $this->lang->register_cookie_required);
			}

			// Make sure the nasty bots who are deliberately not setting this stuff don't trigger a swarm of error emails!
			if ($this->sets['register_image']) {
				if ( !isset( $this->post['user_math'] ) )
					return $this->message( $this->lang->register_reging, $this->lang->register_math_fail );

				$math = $this->post['user_math'];
				$math = mb_strtolower($math, mb_detect_encoding($math));

				$str = mb_strtolower($_SESSION['answer'], mb_detect_encoding($_SESSION['answer']));
				$acceptable_answers = explode( ',', $str );

				if( !in_array( $math, $acceptable_answers ) )
					return $this->message( $this->lang->register_reging, $this->lang->register_math_fail );
			}

			$username = isset($this->post['desuser']) ? $this->post['desuser'] : '';
			$email    = isset($this->post['email']) ? $this->post['email'] : '';
			$pass     = isset($this->post['passA']) ? $this->post['passA'] : '';
			$pass2    = isset($this->post['passB']) ? $this->post['passB'] : '';

			if ((trim($username) == '')
			|| (trim($email) == '')
			|| (trim($pass) == '')
			|| (trim($pass2) == '')) {
				return $this->message($this->lang->register_reging, $this->lang->register_fields);
			}

			if (strlen($username) > 20) {
				return $this->message($this->lang->register_reging, $this->lang->register_name_invalid);
			}

			if (!isset($this->post['terms'])) {
				return $this->message($this->lang->register_tos, $this->lang->register_tos_not_agree);
			}
		
			// Do some quick checks to prevent flooding registration
			if (isset($_SESSION['last_register']) && $_SESSION['last_register'] > ($this->time - $this->sets['flood_time'])) {
				return $this->message($this->lang->register_reging, $this->lang->register_flood);
			}
			$_SESSION['last_register'] = $this->time;

			$username = str_replace('\\', '&#092;', $this->format($username, FORMAT_HTMLCHARS | FORMAT_CENSOR));

			$exists = $this->db->fetch("SELECT user_id FROM %pusers WHERE REPLACE(LOWER(user_name), ' ', '')='%s'",
				str_replace(' ', '', strtolower($username)));
			if ($exists) {
				return $this->message($this->lang->register_reging, $this->lang->register_name_taken);
			}

			$temp_email = $email;
			if (!$this->validator->validate($temp_email, TYPE_EMAIL)) {
				return $this->message($this->lang->register_reging, $this->lang->register_email_invalid);
			}

			if ($pass != $pass2) {
				return $this->message($this->lang->register_reging, $this->lang->register_pass_match);
			}

			if (!$this->validator->validate($pass, TYPE_PASSWORD)) {
 				return $this->message($this->lang->register_reging, $this->lang->register_pass_invalid);
 			}

			$eexists = $this->db->fetch("SELECT user_email FROM %pusers WHERE user_email='%s'", $email);
			if ($eexists) {
				return $this->message($this->lang->register_reging, $this->lang->register_email_used);
			}

			$pass = md5($pass);
			$level = $this->get_level(0);

			if ($this->sets['emailactivation']) {
				$group_id = USER_AWAIT;
			} else {
				$group_id = $this->sets['default_group'];
			}

                        // Store the contents of the entire $_SERVER array. Along with the captcha question. If bots get past this, knowing which question they got right may be helpful.
			$_SERVER['cap_question'] = $_SESSION['question'];
                        $svars = json_encode($_SERVER);

			// I'm not sure if the anti-spam code needs to use the escaped strings or not, so I'll feed them whatever the spammer fed me.
			if( !empty($this->sets['wordpress_api_key']) && $this->sets['akismet_ureg'] ) {
				require_once $this->sets['include_path'] . '/lib/akismet.php';

				$spam_checked = false;
				$akismet = null;

				try {
					$akismet = new Akismet($this->sets['loc_of_board'], $this->sets['wordpress_api_key'], $this->version);
					$akismet->setCommentAuthor($username);
					$akismet->setCommentAuthorEmail($email);
					$akismet->setCommentType('signup');

					$spam_checked = true;
				}
				// Try and deal with it rather than say something.
				catch(Exception $e) {}

				if( $spam_checked && $akismet != null && $akismet->isCommentSpam() ) {
					$this->log_action('Blocked Registration', 0, 0, 0);

					$this->sets['spam_reg_count']++;
					$this->write_sets();

					return $this->message( $this->lang->register_reging, $this->lang->register_akismet_ureg_spam );
				}
			}

			$this->db->query("INSERT INTO %pusers (user_name, user_password, user_group, user_title, user_joined, user_email, user_skin, user_view_avatars, user_view_emoticons, user_view_signatures,
				user_language, user_email_show, user_pm, user_timezone, user_regip, user_register_email, user_server_data) VALUES ('%s', '%s', %d, '%s', %d, '%s', '%s', %d, %d, %d, '%s', %d, %d, %d, '%s', '%s', '%s')",
				$username, $pass, $group_id, $level['user_title'], $this->time, $email, $this->sets['default_skin'], $this->sets['default_view_avatars'], $this->sets['default_view_emots'], $this->sets['default_view_sigs'],
				$this->user['user_language'], $this->sets['default_email_shown'], $this->sets['default_pm'], $this->sets['default_timezone'], $this->ip, $email, $svars);

			$this->sets['last_member'] = $username;
			$this->sets['last_member_id'] = $this->db->insert_id("users");
			$this->sets['members']++;
			$this->write_sets();

			if ($this->sets['emailactivation']) {
				return $this->send_activation_email($email, $username, $pass, $this->time);
			}

			return $this->message($this->lang->register_reging, $this->lang->register_done);
		}
	}

	function send_activation_email($email, $username, $pass, $jointime)
	{
		$mailer = new $this->modules['mailer']($this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false);

		// todo. Make this more friendly with internationlisation. Currently it's too limiting for grammar.
		$message = "{$this->lang->register_requested} {$username}\n";
		$message .= "{$this->lang->register_initiated} {$this->ip}\n\n";
		$message .= "{$this->lang->register_email_msg}\n";
		$message .= "{$this->lang->register_email_msg2} {$this->sets['forum_name']}.\n\n";
		$message .= "{$this->lang->register_email_msg3}\n";
		$message .= "{$this->sets['loc_of_board']}{$this->mainfile}?a=register&s=activate&e=" . md5($email . $username . $pass . $jointime) ."\n\n";

		$mailer->setSubject("{$this->sets['forum_name']} - {$this->lang->register_activating}");
		$mailer->setMessage($message);
		$mailer->setRecipient($email);
		$mailer->setServer($this->sets['mailserver']);
		$mailer->doSend();

		return $this->message($this->lang->register_reging, sprintf($this->lang->register_must_activate, $email));
	}

	function activateUser()
	{
		if (isset($this->get['e'])) {
			$member = $this->db->fetch("SELECT user_id, user_group FROM %pusers WHERE MD5(CONCAT(user_email, user_name, user_password, user_joined))='%s' LIMIT 1", $this->get['e']);

			if (isset($member['user_id']) && USER_GUEST_UID != $member['user_id'] && USER_AWAIT == $member['user_group']) {
				$this->db->query("UPDATE %pusers SET user_group=%d WHERE user_id=%d",
					 $this->sets['default_group'], $member['user_id']);
				return $this->message($this->lang->register_activating, $this->lang->register_activated);
			}
		}

		return $this->message($this->lang->register_activating, $this->lang->register_activation_error);
	}

	function create_image()
	{
		// Need to get rid of other image files since the names will all be different now.
		foreach( glob("./rss/*.png") as $filename ) {
			unlink($filename);
		}

		require './lib/jpgraph/jpgraph.php';
		require './lib/jpgraph/jpgraph_antispam.php';
		
		if (!function_exists('imagejpeg')) {
			JpGraphError::Raise("This PHP installation is not configured with JPEG support. Please recompile PHP with GD and JPEG support to run JpGraph. (Function imagejpeg() does not exist)");
		}

		$graph = new AntiSpam();
		
		$text  = strtoupper($graph->Rand(6));
		$filename = "./rss/register" . $this->time . ".png";
		$graph->Stroke($filename);

		return array(md5("{$this->sets['db_pass']}{$this->sets['mostonlinetime']}$text"), $filename);
	}
}
?>