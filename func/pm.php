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
 * User's system for sending and receiving personal messages
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class pm extends qsfglobal
{
	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->site ) : $this->lang->board_noview
			);
		}

		$this->set_title( $this->lang->pm_messenger );
		$this->tree( $this->lang->pm_messenger );

		if( $this->perms->is_guest ) {
			return $this->message( $this->lang->pm_personal, sprintf( $this->lang->pm_guest, $this->site, $this->site ) );
		}

		// FIXME: Need permission check for members

		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		switch( $this->get['s'] )
		{
		case 'send':
			return $this->send();
			break;

		case 'view':
			return $this->view();
			break;

		case 'delete':
			return $this->delete_pm();
			break;

		case 'clear':
			return $this->clear();
			break;

		case 'unread':
			return $this->mark_unread();
			break;

		default:
			$this->get['s'] = null;
			return $this->folder();
			break;
		}
	}

	private function folder()
	{
		$f = isset( $this->get['f'] ) ? intval( $this->get['f'] ) : 0;

		$folderjump = $this->select_folder( $f );

		if( !$f ) {
			$foldername = $this->lang->pm_folder_inbox;
		} else {
			$foldername = $this->lang->pm_folder_sentbox;
		}

		$xtpl = new XTemplate( './skins/' . $this->skin . '/pm.xtpl' );

		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'pm_sendamsg', $this->lang->pm_sendamsg );
		$xtpl->assign( 'new_message', $this->lang->new_message );
		$xtpl->assign( 'folderjump', $folderjump );
		$xtpl->assign( 'foldername', $foldername );
		$xtpl->assign( 'lang_pm_title', $this->lang->pm_title );
		$xtpl->assign( 'lang_pm_from', $this->lang->pm_from );
		$xtpl->assign( 'pm_sendon', $this->lang->pm_sendon );
		$xtpl->assign( 'pm_delete', $this->lang->pm_delete );
		$xtpl->assign( 'pm_pm', $this->lang->pm_pm );

		if( !isset( $this->post['submit'] ) ) {
			$messages = 0;

			$query = $this->db->query( "SELECT p.*, m.user_name FROM %ppmsystem p, %pusers m
				WHERE p.pm_to = %d AND p.pm_folder = %d AND m.user_id = p.pm_from
				ORDER BY p.pm_time DESC",
				$this->user['user_id'], $f );

			while( $pm = $this->db->nqfetch( $query ) )
			{
				$messages++;

				if( !$pm['pm_read'] ) {
					$pm['pm_read'] = 'new';
				} else {
					$pm['pm_read'] = null;
				}

				// aWest's PM Preview mod
				$preview = ( ( strlen( $pm['pm_message'] ) > 200 ) ) ? ( substr( $pm['pm_message'], 0, 197 ) . '...' ) : $pm['pm_message'];
				$preview = $this->format( $preview, FORMAT_HTMLCHARS | FORMAT_CENSOR );

				$pm['pm_title'] = $this->format( $pm['pm_title'], FORMAT_HTMLCHARS | FORMAT_CENSOR );
				$pm['pm_message'] = $this->format( $pm['pm_message'], FORMAT_HTMLCHARS | FORMAT_CENSOR );
				$pm['pm_time']  = $this->mbdate( DATE_LONG, $pm['pm_time'] );

				$xtpl->assign( 'pm_id', $pm['pm_id'] );

				if( $pm['pm_read'] == 'new' ) {
					$xtpl->parse( 'PMFolder.Message.New' );
				} else {
					$xtpl->parse( 'PMFolder.Message.Old' );
				}

				$xtpl->assign( 'preview', $preview );
				$xtpl->assign( 'pm_title', $pm['pm_title'] );
				$xtpl->assign( 'pm_from', $pm['pm_from'] );
				$xtpl->assign( 'user_name', $pm['user_name'] );
				$xtpl->assign( 'link_name', $this->clean_url( $pm['user_name'] ) );
				$xtpl->assign( 'pm_time', $pm['pm_time'] );

				$xtpl->parse( 'PMFolder.Message' );
			}
		} else {
			if( isset( $this->post['delete'] ) ) {
				$deleteMessages = array();

				foreach( $this->post['delete'] as $id => $true )
				{
					$deleteMessages[] = intval( $id );
				}

				$this->db->query( 'DELETE FROM %ppmsystem WHERE pm_id IN (%s) AND pm_to=%d', implode(', ', $deleteMessages), $this->user['user_id'] );
			}

			return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_deleted_all );
		}

		if( !$messages ) {
			$xtpl->assign( 'pm_nomsg', $this->lang->pm_nomsg );

			$xtpl->parse( 'PMFolder.NoMessages' );
		}

		$xtpl->assign( 'select_all', $this->lang->select_all );
		$xtpl->assign( 'pm_delete_selected', $this->lang->pm_delete_selected );

		$xtpl->parse( 'PMFolder' );
		return $xtpl->text( 'PMFolder' );
	}

	private function send()
	{
		if( !isset( $this->post['submit'] ) ) {
			$to    = null;
			$title = null;
			$msg   = null;
			$preview = '';

			$xtpl = new XTemplate( './skins/' . $this->skin . '/pm.xtpl' );

			$xtpl->assign( 'self', $this->self );
			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );

			if( isset( $this->post['preview'] ) ) {
				$preview_text = $this->post['message'];
				$msg = $this->format( $preview_text, FORMAT_HTMLCHARS );
				$preview_text = $this->format( $preview_text, FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_BBCODE | FORMAT_EMOJIS );

				$to = $this->format( $this->post['to'], FORMAT_HTMLCHARS );
				$title = $this->format( $this->post['title'], FORMAT_HTMLCHARS | FORMAT_CENSOR );
				$preview_title = $title;

				$xtpl->assign( 'preview_title', $preview_title );
				$xtpl->assign( 'preview_text', $preview_text );

				$xtpl->parse( 'PMSend.Preview' );
			} else {
				if( !isset( $this->get['re'] ) ) {
					if( isset( $this->get['to'] ) ) {
						$to = intval( $this->get['to'] );

						$query = $this->db->fetch( "SELECT user_name FROM %pusers WHERE user_id=%d", $to );

						if( !isset( $query['user_name'] ) || ( $to == USER_GUEST_UID ) ) {
							return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_no_member );
						}

						$to = $query['user_name'];
					}
				} else {
					$re = intval( $this->get['re'] );

					$reply = $this->db->fetch( "SELECT p.pm_to, p.pm_title, p.pm_message, m.user_name
						FROM %ppmsystem p, %pusers m WHERE p.pm_id=%d AND p.pm_from=m.user_id", $re );

					if( $reply['pm_to'] == $this->user['user_id'] ) {
						$to    = $reply['user_name'];
						$title = $this->format( $reply['pm_title'], FORMAT_HTMLCHARS | FORMAT_CENSOR );

						if( strpos($title, 'Re:' ) === false) {
							$title = 'Re: ' . $title;
						}
						$msg = '[quote]' . $this->format( $reply['pm_message'], FORMAT_HTMLCHARS | FORMAT_CENSOR ) . "[/quote]\n\n";
					}
				}
			}
			$this->lang->post();

			$xtpl->assign( 'pm_sendingpm', $this->lang->pm_sendingpm );
			$xtpl->assign( 'pm_to', $this->lang->pm_to );
			$xtpl->assign( 'pm_multiple', $this->lang->pm_multiple );
			$xtpl->assign( 'to', $to );
			$xtpl->assign( 'pm_title', $this->lang->pm_title );
			$xtpl->assign( 'title', $title );
			$xtpl->assign( 'msg', $msg );

			$xtpl->assign( 'smilies', $this->bbcode->generate_emoji_links() );
			$xtpl->assign( 'bbcode_menu', $this->bbcode->get_bbcode_menu() );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'pm_send', $this->lang->pm_send );
			$xtpl->assign( 'pm_preview', $this->lang->pm_preview );

			$xtpl->parse( 'PMSend' );
			return $xtpl->text( 'PMSend' );
		} else {
			if( !$this->perms->auth( 'pm_noflood' ) && ( $this->user['user_lastpm'] > ( $this->time - $this->sets['flood_time_pm'] ) ) ) {
				return $this->message( $this->lang->pm_personal_msging, sprintf( $this->lang->pm_flood, $this->sets['flood_time_pm'] ) );
			}

			if( empty( $this->post['to'] ) || empty( $this->post['message'] ) ) {
				return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_fields );
			}

			if( empty( $this->post['title'] ) ) {
				$this->post['title'] = $this->lang->pm_no_title;
			}

			$users = explode( ';', $this->post['to'] );
			$bad_name = array();
			$bad_pm = array();
			$ok_pm = array();

			$mailer = new mailer( $this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false );
			$mailer->setSubject( "{$this->sets['forum_name']} - {$this->lang->pm_personal}" );
			$mailer->setServer( $this->sets['mailserver'] );

			foreach( $users as $username )
			{
				$username = str_replace( '\\', '&#092;', $this->format( trim( $username ), FORMAT_HTMLCHARS | FORMAT_CENSOR ) );
				$who = $this->db->fetch( "SELECT user_id, user_pm, user_name, user_email, user_pm_mail FROM %pusers
					WHERE REPLACE(LOWER(user_name), ' ', '')='%s' AND user_id != %d LIMIT 1",
					str_replace( ' ', '', strtolower( $username ) ), USER_GUEST_UID );

				if( !isset( $who['user_id'] ) ) {
					$bad_name[] = $username;
					continue;
				}

				if( !$who['user_pm'] ) {
					$bad_pm[] = $who['user_name'];
					continue;
				}

				$ok_pm[] = $who['user_id'];

				$this->db->query( "INSERT INTO %ppmsystem (pm_to, pm_from, pm_ip, pm_title, pm_time, pm_message, pm_folder)
					VALUES (%d, %d, '%s', '%s', %d, '%s', 0)",
					$who['user_id'], $this->user['user_id'], $this->ip, $this->post['title'], $this->time, $this->post['message'] );

				$message_id = $this->db->insert_id( "pmsystem" );
				if( $who['user_pm_mail'] ) {
					$message  = "{$this->sets['forum_name']}\n";
					$message .= "{$this->site}/index.php?a=pm&s=view&m={$message_id}\n\n";
					$message .= $this->user['user_name'] . " " . $this->lang->pm_sent_mail . "\n\n";
					$message .= $this->lang->pm_title . ": " . $this->format( $this->post['title'], FORMAT_CENSOR );

					$mailer->setMessage( $message );
					$mailer->setRecipient( $who['user_email'] );
					$mailer->doSend();
				}
			}

			$this->db->query( "INSERT INTO %ppmsystem (pm_to, pm_from, pm_ip, pm_bcc, pm_title, pm_time, pm_message, pm_folder, pm_read)
				VALUES (%d, %d, '%s', '%s', '%s', %d, '%s', 1, 1)",
				$this->user['user_id'], $this->user['user_id'], $this->ip, implode(';', $ok_pm), $this->post['title'], $this->time, $this->post['message'] );
			$this->db->query( "UPDATE %pusers SET user_lastpm=%d WHERE user_id=%d", $this->time, $this->user['user_id'] );

			if( $bad_name || $bad_pm ) {
				return $this->message( $this->lang->pm_personal_msging, sprintf( $this->lang->pm_error, implode( '; ', $bad_name ), implode( '; ', $bad_pm ) ) );
			} else {
				return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_success );
			}
		}
	}

	private function view()
	{
		if( !isset( $this->get['m'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_no_number );
		}

		$m = intval( $this->get['m'] );

		$pm = $this->db->fetch( "SELECT p.*, m.user_name, m.user_signature, g.group_name, m.user_posts, m.user_joined, m.user_title, m.user_avatar,
			 m.user_avatar_type, m.user_avatar_width, m.user_avatar_height, m.user_active, a.active_time
			FROM (%ppmsystem p, %pusers m, %pgroups g)
			LEFT JOIN %pactive a ON a.active_id=m.user_id
			WHERE p.pm_id = %d AND m.user_id = p.pm_from AND
			  m.user_group = g.group_id", $m );

		if( !$pm ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_no_number );
		}

		if( !$this->checkOwner( $m ) ) {
			return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_noview );
		}

		$pm['user_avatar'] = $this->htmlwidgets->display_avatar( $pm );

		if( $pm['user_signature'] && $this->user['user_view_signatures'] ) {
			$pm['user_signature'] = '.........................<br />' . $this->format( $pm['user_signature'], FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_BBCODE | FORMAT_EMOJIS );
		} else {
			$pm['user_signature'] = null;
		}

		$pm['pm_title']    = $this->format( $pm['pm_title'], FORMAT_HTMLCHARS | FORMAT_CENSOR );
		$pm['pm_message']  = $this->format( $pm['pm_message'], FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_BBCODE | FORMAT_EMOJIS );
		$pm['pm_time']     = $this->mbdate( DATE_LONG, $pm['pm_time'] );
		$pm['user_joined'] = $this->mbdate( DATE_ONLY_LONG, $pm['user_joined'] );

		$online = ( $pm['active_time'] && ( $pm['active_time'] > ( $this->time - 900 ) ) && $pm['user_active'] );

		$recipients = null;
		$foldername = $this->lang->pm_folder_inbox;

		if( $pm['pm_folder'] == 1 ) {
			$names = $this->db->query( "SELECT user_name FROM %pusers WHERE user_id IN (%s)", implode( ',', explode( ';', $pm['pm_bcc'] ) ) );

			while( $name = $this->db->nqfetch( $names ) )
			{
				$recipients .= $name['user_name'] . '; ';
			}

			$recipients = substr( $recipients, 0, -2 );
			$foldername = $this->lang->pm_folder_sentbox;
		}

		$this->db->query( "UPDATE %ppmsystem SET pm_read=1 WHERE pm_id=%d", $m );

		$xtpl = new XTemplate( './skins/' . $this->skin . '/pm.xtpl' );

		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'pm_sendamsg', $this->lang->pm_sendamsg );
		$xtpl->assign( 'new_message', $this->lang->new_message );
		$xtpl->assign( 'pm_id', $pm['pm_id'] );
		$xtpl->assign( 'pm_reply', $this->lang->pm_reply );
		$xtpl->assign( 'reply', $this->lang->reply );
		$xtpl->assign( 'pm_delete', $this->lang->pm_delete );
		$xtpl->assign( 'delete', $this->lang->delete );
		$xtpl->assign( 'pm_title', $pm['pm_title'] );

		$xtpl->assign( 'user_avatar', $pm['user_avatar'] );

		if( $online ) {
			$xtpl->assign( 'pm_online', $this->lang->pm_online );

			$xtpl->parse( 'PMView.Online' );
		} else {
			$xtpl->assign( 'pm_offline', $this->lang->pm_offline );

			$xtpl->parse( 'PMView.Offline' );
		}

		$xtpl->assign( 'pm_from', $pm['pm_from'] );
		$xtpl->assign( 'user_name', $pm['user_name'] );
		$xtpl->assign( 'link_name', $this->clean_url( $pm['user_name'] ) );
		$xtpl->assign( 'user_title', $pm['user_title'] );
		$xtpl->assign( 'pm_group', $this->lang->pm_group );
		$xtpl->assign( 'group_name', $pm['group_name'] );
		$xtpl->assign( 'pm_posts', $this->lang->pm_posts );
		$xtpl->assign( 'user_posts', $pm['user_posts'] );
		$xtpl->assign( 'pm_joined', $this->lang->pm_joined );
		$xtpl->assign( 'user_joined', $pm['user_joined'] );

		$avatar_center = ( $pm['user_avatar_width'] ? ( ( $pm['user_avatar_width'] / 2 ) - 3 ) : 22 );
		$xtpl->assign( 'avatar_center', $avatar_center );

		if( $recipients )
			$xtpl->assign( 'recipients', "{$this->lang->pm_recipients}: {$recipients}<hr />" );

		$xtpl->assign( 'pm_message', $pm['pm_message'] );
		$xtpl->assign( 'user_signature', $pm['user_signature'] );
		$xtpl->assign( 'pm_sendon', $this->lang->pm_sendon );
		$xtpl->assign( 'pm_time', $pm['pm_time'] );

		$xtpl->parse( 'PMView' );
		return $xtpl->text( 'PMView' );
	}

	private function delete_pm()
	{
		if( !isset( $this->get['m'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_no_number );
		}
		$m = intval( $this->get['m'] );

		if( !$this->checkOwner( $m ) ) {
			return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_cant_del );
		}

		if( !isset( $this->get['confirm'] ) ) {
			return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_sure_del, $this->lang->continue, "$this->self?a=pm&amp;s=delete&amp;m={$m}&amp;confirm=1" );
		} else {
			$query = $this->db->query( "DELETE FROM %ppmsystem WHERE pm_to=%d AND pm_id=%d", $this->user['user_id'], $m );
			return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_deleted );
		}
	}

	private function clear()
	{
		if( !isset( $this->get['f'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_no_folder );
		}

		$f = intval( $this->get['f'] );

		if( !isset( $this->get['confirm'] ) ) {
			return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_sure_delall, $this->lang->continue, "$this->self?a=pm&amp;s=clear&amp;f={$f}&amp;confirm=1" );
		} else {
			$query = $this->db->query( "DELETE FROM %ppmsystem WHERE pm_to=%d AND pm_folder=%d", $this->user['user_id'], $f );
			return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_deleted_all );
		}
	}

	/**
	 * Mark a message as unread
	 *
	 * @author Jonathan West <jon@quicksilverforums.com>
	 * @since 1.4.3
	 * @return HTML message
	 **/
	private function mark_unread()
	{
		if( !isset( $this->get['m'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_no_number );
		}

		$m = intval( $this->get['m'] );

		$this->db->query( 'UPDATE %ppmsystem SET pm_read=0 WHERE pm_id=%d AND pm_to=%d', $m, $this->user['user_id'] );

		return $this->message( $this->lang->pm_personal_msging, $this->lang->pm_mark_unread );
	}

	private function checkOwner( $id )
	{
		$data = $this->db->fetch( "SELECT pm_to FROM %ppmsystem WHERE pm_id=%d", $id );
		return( $data['pm_to'] == $this->user['user_id'] );
	}

	private function select_folder( $folder )
	{
		return "<option value='0'" . (($folder == 0) ? ' selected=\'selected\'' : '') . ">{$this->lang->pm_folder_inbox} (" . sprintf($this->lang->pm_folder_new, $this->get_messages(false, 0)) . ")</option>
		<option value='1'" . (($folder == 1) ? ' selected=\'selected\'' : '') . ">{$this->lang->pm_folder_sentbox}</option>";
	}
}
?>