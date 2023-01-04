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
 * Form to email a member
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since RC1
 **/
class email extends qsfglobal
{
	/**
	 * Form to email a member
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since RC1
	 **/
	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->site ) : $this->lang->board_noview
			);
		}

		$this->set_title( $this->lang->email_email );
		$this->tree( $this->lang->email_email );

		if( !$this->perms->auth( 'email_use' ) ) {
			header( 'HTTP/1.0 403 Forbidden' );
			return $this->message( $this->lang->email_email, $this->lang->email_no_perm );
		}

		if( !isset( $this->post['submit'] ) ) {
			$to = 0;

			if( isset( $this->get['to'] ) ) {
				if( !$this->validator->validate( $this->get['to'], TYPE_INT ) ) {
					header( 'HTTP/1.0 404 Not Found' );
					return $this->message( $this->lang->email_email, $this->lang->email_no_member );
				}

				$to = intval( $this->get['to'] );
			}

			$mailto = null;
			if( $to ) {
				if( !isset( $this->get['tname'] ) || !$this->validator->validate( $this->get['tname'], TYPE_STRING ) ) {
					header( 'HTTP/1.0 404 Not Found' );
					return $this->message( $this->lang->email_email, $this->lang->email_no_member );
				}

				$tname = strtolower( $this->get['tname'] );

				$target = $this->db->fetch( "SELECT user_name FROM %pusers WHERE user_id=%d", $to );

				if( !isset( $target['user_name'] ) || ( $to == USER_GUEST_UID ) || $tname != $this->htmlwidgets->clean_url( $target['user_name'] ) ) {
					return $this->message( $this->lang->email_email, $this->lang->email_no_member );
				}

				$mailto = $target['user_name'];
			}

			$xtpl = new XTemplate( './skins/' . $this->skin . '/email.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'email_email', $this->lang->email_email );
			$xtpl->assign( 'email_to', $this->lang->email_to );

			$xtpl->assign( 'mailto', $mailto );
			$xtpl->assign( 'email_subject', $this->lang->email_subject );
			$xtpl->assign( 'email_msgtext', $this->lang->email_msgtext );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'Email' );
			return $xtpl->text( 'Email' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->email_email, $this->lang->invalid_token );
			}

			if( empty( $this->post['to'] ) || empty( $this->post['message'] ) || empty( $this->post['subject'] ) ) {
				return $this->message( $this->lang->email_email, $this->lang->email_no_fields );
			}

			$target = $this->db->fetch( "SELECT user_id, user_email, user_email_form FROM %pusers WHERE user_name='%s'", $this->post['to'] );

			if( !$target['user_email_form'] ) {
				return $this->message( $this->lang->email_email, $this->lang->email_blocked );
			}

			if( !isset( $target['user_id'] ) || ( $target['user_id'] == USER_GUEST_UID ) ) {
				return $this->message( $this->lang->email_email, $this->lang->email_no_member );
			}

			// I'm not sure if the anti-spam code needs to use the escaped strings or not, so I'll feed them whatever the spammer fed me.
			if( !empty( $this->sets['wordpress_api_key'] ) && $this->sets['akismet_email'] ) {
				require_once $this->sets['include_path'] . '/lib/akismet.php';

				$spam_checked = false;
				$akismet = null;

				try {
					$akismet = new Akismet( $this );
					$akismet->set_comment_author( $this->user['user_name'] );
					$akismet->set_comment_author_email( $this->user['user_email'] );
					$akismet->set_comment_content( $this->post['message'] );
					$akismet->set_comment_type( 'contact-form' );

					$spam_checked = true;
				}
				// Try and deal with it rather than say something.
				catch( Exception $e ) {}

				if( $spam_checked && $akismet != null ) {
               $response = $akismet->is_this_spam();

               if( isset( $response[1] ) && $response[1] == 'true' ) {
                  $this->log_action( 'Spam Email Caught', 0, 0, 0 );

                  $this->sets['spam_email_count']++;
                  $this->write_sets();

                  return $this->message( $this->lang->email_email, $this->lang->email_akismet_email_spam );
               }
				}
			}

			$mailer = new mailer( $this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false );

			$mailer->setSubject( "{$this->sets['forum_name']} - {$this->post['subject']}" );
			$mailer->setMessage( "This mail has been sent by {$this->user['user_name']} via {$this->sets['forum_name']}\n\n" . $this->post['message'] );
			$mailer->setRecipient( $target['user_email'] );
			$mailer->setServer( $this->sets['mailserver'] );
			$mailer->setHeader( 'User-IP: ' . $this->ip );

			$mailer->doSend();

			return $this->message( $this->lang->email_email, $this->lang->email_sent );
		}
	}
}
?>