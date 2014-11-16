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
		if (!isset($this->post['submit'])) {
			if ($this->sets['register_image']) {
				$imagesrc = $this->create_image();
				$image = eval($this->template('REGISTER_IMAGE'));
			} else {
				$image = null;
			}
			$tos = $this->db->fetch("SELECT settings_tos FROM %psettings");
			$tos_text = $tos['settings_tos'];
			$tos_text = nl2br($tos_text);

			$_SESSION['allow_register'] = true;

			return eval($this->template('REGISTER_MAIN'));
		} else {
			$username = $this->post['desuser'];
			$email    = $this->post['email'];
			$pass     = $this->post['passA'];
			$pass2    = $this->post['passB'];

			if ($this->sets['register_image']) {
				$image = strtoupper($this->post['imagetext']);
			} else {
				$image = '-';
			}

			if ((trim($username) == '')
			|| (trim($email) == '')
			|| (trim($pass) == '')
			|| (trim($pass2) == '')
			|| (trim($image) == '')) {
				return $this->message($this->lang->register_reging, $this->lang->register_fields);
			}

			if (strlen($username) > 20) {
				return $this->message($this->lang->register_reging, $this->lang->register_name_invalid);
			}

			if (!isset($this->post['terms'])) {
				return $this->message($this->lang->register_tos, $this->lang->register_tos_not_agree);
			}

			if ($this->sets['register_image']) {
				if (md5("{$this->sets['db_pass']}{$this->sets['mostonlinetime']}$image") != $this->post['imagestring']) {
					return $this->message($this->lang->register_reging, $this->lang->register_image_invalid);
				}
			}
			
			if (!isset($this->session['allow_register'])) {
				// They must allow sessions to register! The session can only be set by loading the form
				return $this->message($this->lang->register_reging, sprintf($this->lang->register_flood, $this->sets['flood_time']));
			}
			// Do some quick checks to prevent flooding registration
			if (isset($this->session['last_register']) && $this->session['last_register'] > ($this->time - $this->sets['flood_time'])) {
				return $this->message($this->lang->register_reging, sprintf($this->lang->register_flood, $this->sets['flood_time']));
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

			if (!preg_match("/^[a-z0-9_\- ]{5,}$/i", $pass)) {
				return $this->message($this->lang->register_reging, $this->lang->register_pass_invalid);
			}

			$eexists = $this->db->fetch("SELECT user_email FROM %pusers WHERE user_email='%s'", $email);
			if ($eexists) {
				return $this->message($this->lang->register_reging, $this->lang->register_email_used);
			}

			if ($pass != $pass2) {
				return $this->message($this->lang->register_reging, $this->lang->register_pass_match);
			}

			$pass = md5($pass);
			$level = $this->get_level(0);

			if ($this->sets['emailactivation']) {
				$group_id = USER_AWAIT;
			} else {
				$group_id = $this->sets['default_group'];
			}

			$this->db->query("INSERT INTO %pusers (user_name, user_password, user_group, user_title, user_joined, user_email, user_skin, user_view_avatars, user_view_emoticons, user_view_signatures,
				user_language, user_email_show, user_pm, user_timezone) VALUES ('%s', '%s', %d, '%s', %d, '%s', '%s', %d, %d, %d, '%s', %d, %d, %d)",
				$username, $pass, $group_id, $level['user_title'], $this->time, $email, $this->sets['default_skin'], $this->sets['default_view_avatars'], $this->sets['default_view_emots'], $this->sets['default_view_sigs'],
				$this->user['user_language'], $this->sets['default_email_shown'], $this->sets['default_pm'], $this->sets['default_timezone']);

			$this->sets['last_member'] = $username;
			$this->sets['last_member_id'] = $this->db->insert_id("users");
			$this->sets['members']++;
			$this->write_sets();

			if ($this->sets['emailactivation']) {
				return $this->send_activation_email($email, $username, $pass, $this->time);
			}

			return $this->message($this->lang->register_reging, sprintf($this->lang->register_done, $this->self));
		}
	}

	function send_activation_email($email, $username, $pass, $jointime)
	{
		$mailer = new $this->modules['mailer']($this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false);

		// todo. Make this more friendly with internationlisation. Currenlty it's too limiting for Currently in grammar.
		$message = "{$this->lang->register_requested} {$username}\n";
		$message .= "{$this->lang->register_initiated} {$_SERVER['REMOTE_ADDR']}\n\n";
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
		foreach( glob("./stats/*.png") as $filename ) {
			unlink($filename);
		}

		require './lib/jpgraph/jpgraph.php';
		require './lib/jpgraph/jpgraph_antispam.php';
		
		if (!function_exists('imagejpeg')) {
			JpGraphError::Raise("This PHP installation is not configured with JPEG support. Please recompile PHP with GD and JPEG support to run JpGraph. (Function imagejpeg() does not exist)");
		}

		$graph = new AntiSpam();
		
		$text  = strtoupper($graph->Rand(6));
		$filename = "./stats/register" . $this->time . ".png";
		$graph->Stroke($filename);

		return array(md5("{$this->sets['db_pass']}{$this->sets['mostonlinetime']}$text"), $filename);
	}
}
?>
