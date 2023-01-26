<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2020 The QSF Portal Development Team
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

class conversations extends qsfglobal
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

		$this->set_title( $this->lang->cv_conversations );
		$this->tree( $this->lang->cv_conversations, "{$this->site}/index.php?a=conversations" );

		if( $this->perms->is_guest ) {
			return $this->message( $this->lang->cv_conversations, sprintf( $this->lang->cv_guest, $this->site, $this->site ) );
		}

		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		switch( $this->get['s'] )
		{
         case 'newconvo':
            return $this->start_conversation();
            break;

         case 'viewconvo':
            return $this->view_conversation();
            break;

         case 'reply':
            return $this->reply();
            break;
 
         case 'invite':
            return $this->invite_users();
            break;

         default: // Falls down to the view page for all of a user's conversations.
            break;
      }

		if( isset( $this->get['num'] ) ) {
			$n = intval( $this->get['num'] );
		} elseif( $this->user['user_topics_page'] > 0 ) {
			$n = $this->user['user_topics_page'];
		} else {
			$n = $this->sets['topics_per_page'];
		}

		if( $this->user['user_posts_page'] != 0 ) {
			$m = $this->user['user_posts_page'];
		} else {
			$m = $this->sets['posts_per_page'];
		}

		$min = isset( $this->get['min'] ) ? intval( $this->get['min'] ) : 0;
		$asc = isset( $this->get['asc'] ) ? intval( !$this->get['asc'] ) : 1;
		$lasc = $asc ? 0 : 1;

		if( isset( $this->get['order'] ) ) {
			if( $this->get['order'] == 'title' ) {
				$order = 'c.conv_title';
			} elseif( $this->get['order'] == 'starter' ) {
				$order = 'conv_starter_name';
			} elseif( $this->get['order'] == 'replies' ) {
				$order = 'c.conv_replies';
			} elseif( $this->get['order'] == 'views' ) {
				$order = 'c.conv_views';
			} else {
				$this->get['order'] = '';
				$order = 'c.conv_edited';
			}

			if( !$this->get['asc'] ) {
				$order .= ' DESC';
			}
		} else {
			$this->get['order'] = '';
			$order = 'c.conv_edited DESC';
		}

		// Figure out if it will need page navigation links
		$conv = $this->db->fetch( "SELECT COUNT(conv_id) AS count FROM %pconversations WHERE FIND_IN_SET( '%s', conv_users )", $this->user['user_id'] );
		$pagelinks = $this->htmlwidgets->get_pages( $conv['count'], "index.php?a=conversations&amp;order={$this->get['order']}&amp;asc=$lasc", $min, $n );

		$xtpl = new XTemplate( './skins/' . $this->skin . '/conversations.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'tree', $this->htmlwidgets->tree );
		$xtpl->assign( 'main_forum_rules', $this->lang->main_forum_rules );
      $xtpl->assign( 'cv_conversations', $this->lang->cv_conversations );
      $xtpl->assign( 'cv_new_convo', $this->lang->cv_new_convo );
		$xtpl->assign( 'cv_topic', $this->lang->cv_topic );
		$xtpl->assign( 'cv_starter', $this->lang->cv_starter );
		$xtpl->assign( 'cv_replies', $this->lang->cv_replies );
		$xtpl->assign( 'cv_views', $this->lang->cv_views );
		$xtpl->assign( 'cv_last', $this->lang->cv_last );
      $xtpl->assign( 'cv_pages', $this->lang->cv_pages );
      $xtpl->assign( 'conv_jump', $this->lang->cv_jump );
      $xtpl->assign( 'conv_topic_posted', $this->lang->cv_topic_posted );
      $xtpl->assign( 'cv_old_pmsystem', $this->lang->cv_old_pmsystem );
      $xtpl->assign( 'pagelinks', $pagelinks );

		$convos = $this->getConvos( $xtpl, $min, $n, $m, $order );
		if( !$convos ) {
         $xtpl->assign( 'cv_no_convos', $this->lang->cv_no_convos );
			$xtpl->parse( 'Conversations.Topics.NoTopics' );
      }

      $xtpl->parse( 'Conversations.Topics' );
      $xtpl->parse( 'Conversations' );
		return $xtpl->text( 'Conversations' );
	}

	private function getConvos( $xtpl, $min, $n, $m, $order )
	{
		$has_topics = false;

		$query = $this->db->query( "SELECT c.conv_id, c.conv_title, c.conv_description, c.conv_starter, c.conv_last_poster, c.conv_replies, c.conv_posted, c.conv_edited,
				c.conv_icon, c.conv_views, c.conv_users, c.conv_last_post
			FROM (%pconversations c)
			WHERE FIND_IN_SET( '%s', c.conv_users )
			ORDER BY $order
			LIMIT %d, %d", $this->user['user_id'], $min, $n );

      $xtpl->assign( 'conv_by', $this->lang->cv_by );

		while( $row = $this->db->nqfetch( $query ) )
		{
         $has_topics = true;

         // There's almost certainly a better way to do this but I can't come up with it, so we're going to very hackishly do this the ugly way.
         $cv_starter = $this->db->fetch( 'SELECT user_id, user_name FROM %pusers WHERE user_id=%d', $row['conv_starter'] );
         $cv_last_poster = $this->db->fetch( 'SELECT user_id, user_name FROM %pusers WHERE user_id=%d', $row['conv_last_poster'] );

			$row['conv_title'] = $this->format( $row['conv_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS );

			$row['newpost'] = !$this->conv_readmarker->is_conv_read( $row['conv_id'], $row['conv_edited'] );

			$Pages = $this->htmlwidgets->get_pages_topic( $row['conv_replies'], 'index.php?a=conversations&amp;s=viewconvo&amp;id=' . $row['conv_id'], ', ', 0, $m );

			if( $cv_last_poster != null && $cv_last_poster['user_id'] != USER_GUEST_UID ) {
				$last_poster = '<a href="' . $this->site . '/profile/' . $this->htmlwidgets->clean_url( $cv_last_poster['user_name'] ) . '-' . $cv_last_poster['user_id'] . '/" class="small">' . $cv_last_poster['user_name'] . '</a>';
			} else {
				$last_poster = $this->lang->cv_guest_user;
			}

			$state = null;
			$row['newpost'] = null;

			if( $row['newpost'] ) {
				$state = 'new';
			}

			if( $row['conv_replies'] < $this->sets['hot_limit'] ) {
				$state .= 'open';
			} else {
				$state .= 'hot';
			}

			$jump = '&amp;p=' . $row['conv_last_post'] . '#p' . $row['conv_last_post'];

			$row['edited'] = $row['conv_edited']; // Store so skin can access
			$row['conv_edited'] = $this->mbdate( DATE_LONG, $row['conv_edited'] );

			$row['conv_replies'] = number_format( $row['conv_replies'], 0, null, $this->lang->sep_thousands );
			$row['conv_views'] = number_format( $row['conv_views'], 0, null, $this->lang->sep_thousands );

			$icon = $row['conv_icon']; // Store so skin can still access
			if( $row['conv_icon'] ) {
            $xtpl->assign( 'conv_icon', "<img src=\"{$this->site}/skins/{$this->skin}/mbicons/{$icon}\" alt=\"{$this->lang->cv_icon}\" class=\"left\">" );
			} else {
            $xtpl->assign( 'conv_icon', null );
         }

			$conv_posted = $this->mbdate( DATE_LONG, $row['conv_posted'] );

         $xtpl->assign( 'state', $state );
         $xtpl->assign( 'conv_id', $row['conv_id'] );
         $xtpl->assign( 'conv_posted', $this->mbdate( DATE_LONG, $row['conv_posted'] ) );
         $xtpl->assign( 'conv_title', $row['conv_title'] );

         if( trim( $row['conv_description'] ) != '' ) {
            $row['conv_description'] = '<br>&raquo; ' . $this->format( $row['conv_description'], FORMAT_CENSOR | FORMAT_HTMLCHARS );
         } else {
            $row['conv_description'] = null;
         }

         $xtpl->assign( 'conv_description', $row['conv_description'] );

         $Pages = $this->htmlwidgets->get_pages_topic( $row['conv_replies'], "index.php?a=conversations&amp;s=viewconvo&amp;id={$row['conv_id']}", ', ', 0, $m );
         $xtpl->assign( 'Pages', $Pages );

         $xtpl->assign( 'conv_unread', 'conv_unread' );

			if( $row['conv_starter'] != USER_GUEST_UID ) {
				$xtpl->assign( 'conv_starter', $row['conv_starter'] );
				$xtpl->assign( 'conv_starter_name', $cv_starter['user_name'] );
				$xtpl->assign( 'link_name', $this->htmlwidgets->clean_url( $cv_starter['user_name'] ) );

				$xtpl->parse( 'Conversations.Topics.ConvoTopic.ConvoStarterMember' );
			} else {
				$xtpl->assign( 'conv_starter_name', $this->lang->cv_guest_user );
 
				$xtpl->parse( 'Conversations.Topics.ConvoTopic.ConvoStarterGuest' );
			}

         $xtpl->assign( 'conv_replies', $row['conv_replies'] );
         $xtpl->assign( 'conv_views', $row['conv_views'] );
         $xtpl->assign( 'conv_edited', $row['conv_edited'] );
         
         $jump = '&amp;p=' . $row['conv_last_post'] . '#p' . $row['conv_last_post'];

         $xtpl->assign( 'jump', $jump );

			if( $cv_last_poster['user_id'] != USER_GUEST_UID ) {
				$xtpl->assign( 'conv_last_poster', $cv_last_poster['user_id'] );
				$xtpl->assign( 'conv_last_poster_name', $cv_last_poster['user_name'] );
				$xtpl->assign( 'link_name_last', $this->htmlwidgets->clean_url( $cv_last_poster['user_name'] ) );

				$xtpl->parse( 'Conversations.Topics.ConvoTopic.LastPosterMember' );
			} else {
				$xtpl->assign( 'conv_last_poster_name', $this->lang->cv_guest_user );

				$xtpl->parse( 'Conversations.Topics.ConvoTopic.LastPosterGuest' );
			}

         $xtpl->parse( 'Conversations.Topics.ConvoTopic' );
		}
		return $has_topics;
	}

   private function start_conversation()
   {
      if( !isset( $this->post['submit'] ) ) {
         $to    = null;
			$title = null;
			$msg   = null;
         $desc  = null;
			$preview = '';
         $attached = null;
			$attached_data = null;
			$upload_error = null;
			$icon = -1;
         $checkEmot = ' checked="checked"';
			$checkCode = ' checked="checked"';

			if( !isset( $this->post['attached_data'] ) ) {
				$this->post['attached_data'] = array();
			}

			// if( $this->perms->auth( 'post_attach', $f ) ) {
				// Attach
				if( isset( $this->post['attach'] ) ) {
					$upload_error = $this->attachmentutil->attach( $this->files['attach_upload'], $this->post['attached_data'] );
				// Detach
				} elseif( isset( $this->post['detach'] ) ) {
					$this->attachmentutil->delete( $this->post['attached'], $this->post['attached_data'] );
				}

				$this->attachmentutil->getdata( $attached, $attached_data, $this->post['attached_data'] );
			// }

			$xtpl = new XTemplate( './skins/' . $this->skin . '/conversations.xtpl' );

         $xtpl->assign( 'site', $this->site );
         $xtpl->assign( 'skin', $this->skin );
         $xtpl->assign( 'tree', $this->htmlwidgets->tree );
         $xtpl->assign( 'main_forum_rules', $this->lang->main_forum_rules );
         $xtpl->assign( 'cv_conversations', $this->lang->cv_conversations );
         $xtpl->assign( 'cv_old_pmsystem', $this->lang->cv_old_pmsystem );
         $xtpl->assign( 'cv_new_convo', $this->lang->cv_new_convo );
         $xtpl->assign( 'cv_to', $this->lang->cv_to );
         $xtpl->assign( 'cv_multiple', $this->lang->cv_multiple );
         $xtpl->assign( 'cv_title', $this->lang->cv_title );

			$icon = isset( $this->post['icon'] ) ? $this->post['icon'] : -1;
			$msg_icons = $this->htmlwidgets->get_icons( $icon );

			$xtpl->assign( 'cv_icon', $this->lang->cv_icon );
			$xtpl->assign( 'msg_icons', $msg_icons );

			$xtpl->assign( 'smilies', $this->bbcode->generate_emoji_links() );
			$xtpl->assign( 'bbcode_menu', $this->bbcode->get_bbcode_menu() );

         if( isset( ( $this->get['to'] ) ) ) {
            $to = base64_decode( $this->get['to'] );
            $to = $this->format( $to, FORMAT_HTMLCHARS );
         }
 
         if( isset( $this->get['title'] ) && isset( $this->get['text'] ) ) {
            $title = base64_decode( $this->get['title'] );
            $title = $this->format( $title, FORMAT_HTMLCHARS | FORMAT_CENSOR );

				$text = base64_decode( $this->get['text'] );
				$msg = $this->format( $text, FORMAT_HTMLCHARS );
         }

         if( isset( $this->post['preview'] ) ) {
				$preview_text = $this->post['message'];
				$msg = $this->format( $preview_text, FORMAT_HTMLCHARS );
				$preview_text = $this->format( $preview_text, FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_BBCODE | FORMAT_EMOJIS );

				$to = $this->format( $this->post['to'], FORMAT_HTMLCHARS );
				$title = $this->format( $this->post['title'], FORMAT_HTMLCHARS | FORMAT_CENSOR );
				$preview_title = $title;

            $preview_desc = $this->post['description'];
            $desc = $this->format( $preview_desc, FORMAT_HTMLCHARS );
            $preview_desc = $desc;

				$xtpl->assign( 'preview_title', $preview_title );
				$xtpl->assign( 'preview_text', $preview_text );

            $params = FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_HTMLCHARS;

				if( isset( $this->post['parseCode'] ) ) {
					$params |= FORMAT_BBCODE;
					$checkCode = ' checked=\'checked\'';
				} else {
					$checkCode = '';
				}

				if( isset( $this->post['parseEmot'] ) ) {
					$params |= FORMAT_EMOJIS;
					$checkEmot = ' checked=\'checked\'';
				} else {
					$checkEmot = '';
				}

				$xtpl->parse( 'Conversations.NewConvo.Preview' );
         }

         $xtpl->assign( 'to', $to );
         $xtpl->assign( 'title', $title );
         $xtpl->assign( 'description', $desc );
			$xtpl->assign( 'msg', $msg );

			$xtpl->assign( 'cv_options', $this->lang->cv_options );
			$xtpl->assign( 'checkEmot', $checkEmot );
			$xtpl->assign( 'cv_option_emojis', $this->lang->cv_option_emojis );
			$xtpl->assign( 'checkCode', $checkCode );
			$xtpl->assign( 'cv_option_bbcode', $this->lang->cv_option_bbcode );

			// if( $this->perms->auth( 'post_attach', $f ) ) {
				if( $attached ) {
					$xtpl->assign( 'cv_attach', $this->lang->cv_attach );
					$xtpl->assign( 'attached', $attached );
					$xtpl->assign( 'cv_attach_remove', $this->lang->cv_attach_remove );
					$xtpl->assign( 'attached_data', $attached_data );

					$xtpl->parse( 'Conversations.NewConvo.AttachBox.Remove' );
				}

				$xtpl->assign( 'cv_attach_add', $this->lang->cv_attach_add );
				$xtpl->assign( 'cv_attach_disrupt', $this->lang->cv_attach_disrupt );
				$xtpl->assign( 'upload_error', $upload_error );

				$xtpl->parse( 'Conversations.NewConvo.AttachBox' );
			// }

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'cv_post', $this->lang->cv_post );
			$xtpl->assign( 'cv_preview', $this->lang->cv_preview );

			$xtpl->parse( 'Conversations.NewConvo' );
         $xtpl->parse( 'Conversations' );
			return $xtpl->text( 'Conversations' );
      }

		if( !$this->perms->auth( 'pm_noflood' ) && ( $this->user['user_lastpm'] > ( $this->time - $this->sets['flood_time_pm'] ) ) ) {
			return $this->message( $this->lang->cv_private_conversations, sprintf( $this->lang->cv_flood, $this->sets['flood_time_pm'] ) );
		}

		if( empty( $this->post['to'] ) ) {
			return $this->message( $this->lang->cv_private_conversations, $this->lang->cv_no_recipients );
		}

		if( empty( $this->post['title'] ) ) {
			return $this->message( $this->lang->cv_private_conversations, $this->lang->cv_no_title );
		}

      if( empty( $this->post['message'] ) ) {
         return $this->message( $this->lang->cv_private_conversations, $this->lang->cv_no_message );
      }

      $icon = '';
      if( isset( $this->post['icon'] ) )
         $icon = $this->post['icon'];

		$users = explode( ',', $this->post['to'] );
		$bad_name = array();
		$bad_pm = array();
		$ok_pm = array();

      foreach( $users as $username )
      {
         	$username = str_replace( '\\', '&#092;', $this->format( trim( $username ), FORMAT_HTMLCHARS | FORMAT_CENSOR ) );
				$who = $this->db->fetch( "SELECT user_id, user_pm, user_name FROM %pusers
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

            // User who started this should be excluded from the list.
            if( $who['user_id'] != $this->user['user_id'] )
               $ok_pm[] = $who['user_id'];
      }

      if( empty( $ok_pm ) ) {
         return $this->message( $this->lang->cv_private_conversations, $this->lang->cv_cannot_send );
      }

      $recipients = implode( ',', $ok_pm );
      $recipients = $this->user['user_id'] . ',' . $recipients;

      $this->db->query( "INSERT INTO %pconversations (conv_title, conv_description, conv_starter, conv_last_poster, conv_icon, conv_posted, conv_edited, conv_users)
			VALUES ('%s', '%s', %d, %d, '%s', %d, %d, '%s')", $this->post['title'], $this->post['description'], $this->user['user_id'], $this->user['user_id'], $icon, $this->time, $this->time, $recipients );

      $conv_id = $this->db->insert_id( 'conversations', 'conv_id' );

      $this->db->query( "INSERT INTO %pconv_posts (post_convo, post_author, post_time, post_bbcode, post_emojis, post_ip, post_icon, post_text, post_referrer, post_agent)
         VALUES (%d, %d, %d, %d, %d, '%s', '%s', '%s', '%s', '%s')", $conv_id, $this->user['user_id'], $this->time, $this->post['parseCode'], $this->post['parseEmot'], $this->ip, $icon, $this->post['message'], $this->referrer, $this->agent );

      $post_id = $this->db->insert_id( 'conv_posts', 'post_id' );

      $this->db->query( "UPDATE %pconversations SET conv_last_post=%d WHERE conv_id=%d", $post_id, $conv_id );
      
		$mailer = new mailer( $this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false );
		$mailer->setSubject( "{$this->sets['forum_name']} - {$this->lang->cv_private_conversations}" );
		$mailer->setServer( $this->sets['mailserver'] );

      foreach( $ok_pm as $user )
      {
         // The user who started the conversation already knows and doesn't need to be notified.
         if( $user == $this->user['user_id'] )
            continue;

         $who = $this->db->fetch( "SELECT user_email, user_pm_mail FROM %pusers WHERE user_id=%d", $user );

         if( $who['user_pm_mail'] ) {
            $message  = "{$this->sets['forum_name']}\n";
				$message .= "{$this->site}/index.php?a=conversations&s=viewconvo&id={$conv_id}\n\n";
				$message .= $this->user['user_name'] . " " . $this->lang->cv_sent_mail . "\n\n";
				$message .= $this->lang->cv_title . ": " . $this->format( $this->post['title'], FORMAT_CENSOR );

				$mailer->setMessage( $message );
				$mailer->setRecipient( $who['user_email'] );
				$mailer->doSend();
         }
      }

		if( $bad_name || $bad_pm ) {
			return $this->message( $this->lang->cv_private_conversations, sprintf( $this->lang->cv_error, implode( '; ', $bad_name ), implode( '; ', $bad_pm ) ) );
		}

      return $this->message( $this->lang->cv_private_conversations, $this->lang->cv_started );
   }

   private function view_conversation()
   {
		if( !isset( $this->get['id'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->cv_conversations, $this->lang->cv_not_found_message );
		}

		if( !$this->validator->validate( $this->get['id'], TYPE_INT ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->cv_conversations, $this->lang->cv_not_found_message );
		}

		$num = $min = $postnum = 0;
		$unread = false;

		$conv_id = intval( $this->get['id'] );

		if( isset( $this->get['num'] ) ) {
			$num = intval( $this->get['num'] );
		} elseif( $this->user['user_posts_page'] > 0 ) {
			$num = $this->user['user_posts_page'];
		} else {
			$num = $this->sets['posts_per_page'];
		}

		$min = isset( $this->get['min'] ) ? intval( $this->get['min'] ) : 0;

		if( $min < 0 )
			$min = 0;
		if( $num <= 0 )
			$num = $this->sets['posts_per_page'];
		if( $conv_id < 0 )
			$conv_id = 0;

		if( isset( $this->get['view'] ) ) {
         $this->validator->validate( $this->get['view'], TYPE_STRING, array('newer', 'older'), false );
      } else {
         $this->get['view'] = false;
      }

		if( isset( $this->get['p'] ) ) {
			$postnum = intval( $this->get['p'] );
         $this->validator->validate( $postnum, TYPE_UINT );
      } else {
         $postnum = false;
      }

		if( isset( $this->get['unread'] ) ) {
         $unread = true;
      }

		$conv = $this->db->fetch( "SELECT c.conv_title, c.conv_description, c.conv_starter, c.conv_last_post, c.conv_last_poster, 
         c.conv_icon, c.conv_posted, c.conv_edited, c.conv_replies, c.conv_users
			FROM %pconversations c
			WHERE FIND_IN_SET( '%s', c.conv_users )
         AND c.conv_id=%d", $this->user['user_id'], $conv_id );

		if( !$conv ) {
			$this->set_title( $this->lang->cv_conversations );

			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->cv_conversations, $this->lang->cv_not_found_message );
		}

		if( $this->get['view'] ) {
			if( $this->get['view'] == 'older' ) {
				$order = 'DESC';
				$where = "conv_edited < %d";
			} else {
				$order = 'ASC';
				$where = "conv_edited > %d";
			}
 
			$new_conv = $this->db->fetch( "SELECT conv_id, conv_title FROM %pconversations
					WHERE FIND_IN_SET( '%s', conv_users ) AND ($where)
					ORDER BY conv_edited $order
					LIMIT 1", $this->user['user_id'], $conv['conv_edited'] );

			if( $new_conv ) {
            // Move to that topic
				header( "Location: {$this->site}/index.php?a=conversations&id={$new_conv['conv_id']}" );
				return;
         } else {
				header( 'HTTP/1.0 404 Not Found' );

				if( $this->get['view'] == 'older' ) {
					return $this->message( $this->lang->cv_not_found_message, $this->lang->cv_no_older );
				} else {
					return $this->message( $this->lang->cv_not_found_message, $this->lang->cv_no_newer );
				}
			}
      }

		if( $unread ) {
			// Jump to the first unread post (or the last post)
			$timeread = $this->conv_readmarker->conv_last_read( $conv_id );

			$posts = $this->db->fetch( "SELECT COUNT(post_id) posts FROM %pconv_posts WHERE post_convo=%d AND post_time < %d", $conv_id, $timeread );

			if( $posts )
				$postCount = $posts['posts'] + 1;
			else
				$postCount = 0;

			$min = 0; // Start at the first page regardless
			while( $postCount >= ( $min + $num ) ) {
				$min += $num;
			}
		}

		if( $postnum ) {
			// We need to find what page this post exists on!
			$posts = $this->db->fetch( "SELECT COUNT(post_id) posts FROM %pconv_posts WHERE post_convo=%d AND post_id < %d", $conv_id, $postnum );

			if( $posts )
				$postCount = $posts['posts'] + 1;
			else
				$postCount = 0;

			$min = 0; // Start at the first page regardless
			while( $postCount > ( $min + $num ) ) {
				$min += $num;
			}
		}

		$this->db->query( "UPDATE %pconversations SET conv_views=conv_views+1 WHERE conv_id=%d", $conv_id );

		$conv['conv_title'] = $this->format( $conv['conv_title'], FORMAT_CENSOR );
		$title_html = $this->format( $conv['conv_title'], FORMAT_HTMLCHARS );

      $title_short = $conv['conv_title'];

		if( strlen( $conv['conv_title'] ) > 30 ) {
			$title_short = substr( $conv['conv_title'], 0, 29 ) . '...';
		}

		$this->set_title( $this->lang->cv_viewing . ': ' . $title_html );
		$this->tree( $title_short );

		if( trim( $conv['conv_description'] ) != '' ) {
			$conv['conv_description'] = $this->format( $conv['conv_description'], FORMAT_HTMLCHARS | FORMAT_CENSOR );
		} else {
			$conv['conv_description'] = null;
		}

		$user_started_topic = ( $this->user['user_id'] == $conv['conv_starter'] );
		$opts = array();
 
      // Link options get built here
      
      if( !$opts ) {
			$mod_opts = '&nbsp;';
		} else {
			$mod_opts = $this->lang->topic_options . ': [ ' . implode(' | ', $opts) . ' ]';
		}

		$conv_icon = null;
		if( $conv['conv_icon'] ) {
			$conv_icon = $conv['conv_icon'];
		}

		$query = $this->db->query( "SELECT a.attach_id, a.attach_name, a.attach_downloads, a.attach_size, p.post_id
			FROM %pconv_posts p, %pattach a
			WHERE p.post_convo = %d AND a.attach_post = p.post_id AND attach_pm = 1", $conv_id );

		$attachments = array();

		while( $attach = $this->db->nqfetch( $query ) )
		{
			if( !isset( $attachments[$attach['post_id']] ) ) {
				$attachments[$attach['post_id']] = array();
			}

			$attachments[$attach['post_id']][] = $attach;
		}

		$query = $this->db->query( "SELECT p.post_emojis, p.post_bbcode, p.post_time, p.post_text, p.post_author, p.post_id, p.post_ip, p.post_icon, p.post_edited_by, p.post_edited_time,
			  m.user_joined, m.user_signature, m.user_posts, m.user_id, m.user_title, m.user_group, m.user_avatar, m.user_name, m.user_email, m.user_twitter, m.user_facebook,
			  m.user_homepage, m.user_avatar_type, m.user_avatar_width, m.user_avatar_height, m.user_pm, m.user_email_show, m.user_email_form, m.user_active,
			  t.membertitle_icon,
			  g.group_name,
			  a.active_time
			FROM (%pconv_posts p, %pusers m, %pgroups g)
			LEFT JOIN %pactive a ON a.active_id=m.user_id
			LEFT JOIN %pmembertitles t ON t.membertitle_id=m.user_level
			WHERE p.post_convo = %d AND p.post_author = m.user_id AND m.user_group = g.group_id
			GROUP BY p.post_id
			ORDER BY p.post_time
			LIMIT %d, %d",
			$conv_id, $min, $num );

		$i = 0;
		$oldtime = $this->time - 900;
		$newest_post_read = 0;
		$first_unread_post = false;

		$this->lang->members();

		$xtpl = new XTemplate( './skins/' . $this->skin . '/convo_posts.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'tree', $this->htmlwidgets->tree );
		$xtpl->assign( 'main_forum_rules', $this->lang->main_forum_rules );
		$xtpl->assign( 'main_mark1', $this->lang->main_mark1 );
		$xtpl->assign( 'main_mark', $this->lang->main_mark );
		$xtpl->assign( 'conv_id', $conv_id );
      $xtpl->assign( 'cv_conversations', $this->lang->cv_conversations );
      $xtpl->assign( 'cv_new_convo', $this->lang->cv_new_convo );
		$xtpl->assign( 'reply', $this->lang->reply );
		$xtpl->assign( 'cv_quote', $this->lang->cv_quote );
      $xtpl->assign( 'cv_new_post', $this->lang->cv_new_post );
      $xtpl->assign( 'cv_top', $this->lang->cv_top );
		$xtpl->assign( 'cv_bottom', $this->lang->cv_bottom );
      $xtpl->assign( 'title_html', $title_html );
		$xtpl->assign( 'cv_newer', $this->lang->cv_newer );
		$xtpl->assign( 'cv_older', $this->lang->cv_older );
      $xtpl->assign( 'quote', $this->lang->quote );
      $xtpl->assign( 'cv_unreg', $this->lang->cv_unreg );
		$xtpl->assign( 'cv_online', $this->lang->cv_online );
		$xtpl->assign( 'cv_offline', $this->lang->cv_offline );
      $xtpl->assign( 'cv_group', $this->lang->cv_group );
      $xtpl->assign( 'cv_posts', $this->lang->cv_posts );
      $xtpl->assign( 'cv_joined', $this->lang->cv_joined );
		$xtpl->assign( 'members_email_member', $this->lang->members_email_member );
		$xtpl->assign( 'members_send_pm', $this->lang->members_send_pm );
		$xtpl->assign( 'members_visit_twitter', $this->lang->members_visit_twitter );
		$xtpl->assign( 'members_visit_facebook', $this->lang->members_visit_facebook );
		$xtpl->assign( 'members_visit_www', $this->lang->members_visit_www );
		$xtpl->assign( 'cv_attached', $this->lang->cv_attached );
		$xtpl->assign( 'cv_attached_filename', $this->lang->cv_attached_filename );
		$xtpl->assign( 'cv_attached_size', $this->lang->cv_attached_size );
		$xtpl->assign( 'cv_attached_downloads', $this->lang->cv_attached_downloads );
      $xtpl->assign( 'cv_invite', $this->lang->cv_invite );
      $xtpl->assign( 'cv_invite_others', $this->lang->cv_invite_others );
      $xtpl->assign( 'cv_users', $this->lang->cv_users );
      $xtpl->assign( 'cv_separate_names', $this->lang->cv_separate_names );
      $xtpl->assign( 'cv_participants', $this->lang->cv_participants );

      $xtpl->assign( 'conv_description', $conv['conv_description'] );

      // Participants
      $conv_users = explode( ',', $conv['conv_users'] );
      foreach( $conv_users as $user )
      {
         $result = $this->db->fetch( 'SELECT user_name, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height FROM %pusers WHERE user_id=%d', $user );

         if( $result ) {
            $xtpl->assign( 'list_avatar', $this->htmlwidgets->display_avatar( $result, 35, 35 ) );
            $xtpl->assign( 'list_name', $result['user_name'] );

            $xtpl->parse( 'Conversation.Participant' );
         }
      }

      // Page Links
      $xtpl->assign( 'cv_pages', $this->lang->cv_pages );
		$pagelinks = $this->htmlwidgets->get_pages( $conv['conv_replies'] + 1, "index.php?a=conversations&amp;s=viewconvo&amp;id={$conv_id}", $min, $num );
		$xtpl->assign( 'pagelinks', $pagelinks );

		$xtpl->assign( 'cv_reply', $this->lang->cv_reply );

      // Moderator Controls
		if( strpos( $mod_opts, '&nbsp' ) === false ) {
			$xtpl->assign( 'mod_opts', $mod_opts );

			$xtpl->parse( 'Conversation.ModPageLinksTop' );
			$xtpl->parse( 'Conversation.ModPageLinksBottom' );
		} else {
			$xtpl->parse( 'Conversation.PageLinksTop' );
			$xtpl->parse( 'Conversation.PageLinksBottom' );
		}

      // Quick Reply
      $xtpl->assign( 'cv_quickreply', $this->lang->cv_quickreply );
		$xtpl->assign( 'cv_msg', $this->lang->cv_msg );
      $xtpl->assign( 'cv_options', $this->lang->cv_options );
		$xtpl->assign( 'cv_option_emojis', $this->lang->cv_option_emojis );
		$xtpl->assign( 'cv_option_bbcode', $this->lang->cv_option_bbcode );

      $checkEmot = ' checked="checked"';
      $checkCode = ' checked="checked"';
		$xtpl->assign( 'checkEmot', $checkEmot );
      $xtpl->assign( 'checkCode', $checkCode );

		$xtpl->assign( 'cv_preview', $this->lang->cv_preview );
		$xtpl->assign( 'bbcode_menu', $this->bbcode->get_bbcode_menu() );
		$xtpl->assign( 'smilies', $this->bbcode->generate_emoji_links() );

		$xtpl->parse( 'Conversation.QuickReplyBox' );

		while( $post = $this->db->nqfetch( $query ) )
		{
			$newest_post_read = $post['post_time'];
			$post['newpost'] = !$this->conv_readmarker->is_post_read( $conv_id, $post['post_time'] );

			if( $first_unread_post === false && $post['newpost'] ) {
				$xtpl->parse( 'Conversation.Post.FirstUnread' );

				$first_unread_post = true;
			} else if( $first_unread_post === true ) {
				$first_unread_post = false;
			}

			if( $post['newpost'] ) {
				$xtpl->parse( 'Conversation.Post.NewPost' );
			}

			if( !( $post['newpost'] ) && !( $post['post_icon'] ) ) {
				$xtpl->parse( 'Conversation.Post.NewPostTopic' );
			} elseif( $post['post_icon'] ) {
				$xtpl->assign( 'post_icon', $post['post_icon'] );

				$xtpl->parse( 'Conversation.Post.PostIcon' );
			}

			$xtpl->assign( 'post_id', $post['post_id'] );

			$post_num = ( $i + 1 ) + $min;
			$i++;

			$xtpl->assign( 'post_num', $post_num );

			$post_time = $post['post_time'];
			$post['post_time']   = $this->mbdate( DATE_LONG, $post['post_time'] );

			$xtpl->assign( 'post_time', $post['post_time'] );

			$edited = null;
			if( $post['post_edited_by'] ) {
				$post['post_edited_time'] = $this->mbdate( DATE_LONG, $post['post_edited_time'] );
				$edited = sprintf( $this->lang->cv_edited, $post['post_edited_time'], $post['post_edited_by'] );
			}
			$xtpl->assign( 'edited', $edited );

			if( $post['post_author'] != USER_GUEST_UID ) {
				$post['user_avatar'] = $this->htmlwidgets->display_avatar( $post );
				$xtpl->assign( 'user_avatar', $post['user_avatar'] );

				$online = ( $post['active_time'] && ($post['active_time'] > $oldtime) && $post['user_active'] );
				if( $online ) {
					$xtpl->parse( 'Conversation.Post.PosterInfoMember.Online' );
				} else {
					$xtpl->parse( 'Conversation.Post.PosterInfoMember.Offline' );
				}

				$xtpl->assign( 'user_id', $post['user_id'] );
				$xtpl->assign( 'user_name', $post['user_name'] );
				$xtpl->assign( 'link_name', $this->htmlwidgets->clean_url( $post['user_name'] ) );
				$xtpl->assign( 'user_title', $post['user_title'] );
				$xtpl->assign( 'membertitle_icon', $post['membertitle_icon'] );
				$xtpl->assign( 'group_name', $post['group_name'] );

				$post['user_posts'] = number_format( $post['user_posts'], 0, null, $this->lang->sep_thousands );
				$xtpl->assign( 'user_posts', $post['user_posts'] );

				$post['user_joined'] = $this->mbdate( DATE_ONLY_LONG, $post['user_joined'] );
				$xtpl->assign( 'user_joined', $post['user_joined'] );

				if( $post['post_ip'] ) {
					$xtpl->assign( 'post_author', $post['post_author'] );
					$xtpl->assign( 'post_ip', $post['post_ip'] );

					$xtpl->parse( 'Conversation.Post.PosterInfoMember.PostIP' );
				}

				if( $this->perms->auth( 'email_use' ) ) {
					if( $post['user_email_show'] ) {
						$post['email'] = $post['user_email'];
					}
				}

				if( !$post['user_pm'] || $this->perms->is_guest ) {
					$post['user_pm'] = null;
				}

				if( $post['user_email_show'] && $this->perms->auth('email_use') ) {
					$xtpl->assign( 'user_email', $post['user_email'] );

					$xtpl->parse( 'Conversation.Post.PosterInfoMember.EmailShow' );
				}

				if( !$post['user_email_show'] && $post['user_email_form'] && $this->perms->auth( 'email_use' ) ) {
					$xtpl->assign( 'user_id', $post['user_id'] );
					$xtpl->assign( 'email_link_name', $this->htmlwidgets->clean_url( $post['user_name'] ) );

					$xtpl->parse( 'Conversation.Post.PosterInfoMember.EmailForm' );
				}

				if( $post['user_pm'] ) {
					$xtpl->assign( 'encoded_name', base64_encode( $post['user_name'] ) );

					$xtpl->parse( 'Conversation.Post.PosterInfoMember.PM' );
				}

				if( $post['user_twitter'] ) {
					$xtpl->assign( 'twitter', 'https://twitter.com/' . $post['user_twitter'] );

					$xtpl->parse( 'Conversation.Post.PosterInfoMember.Twitter' );
				}

				if( $post['user_facebook'] ) {
					$xtpl->assign( 'facebook', $post['user_facebook'] );

					$xtpl->parse( 'Conversation.Post.PosterInfoMember.Facebook' );
				}

				if( $post['user_homepage'] ) {
					$xtpl->assign( 'homepage', $post['user_homepage'] );

					$xtpl->parse( 'Conversation.Post.PosterInfoMember.Homepage' );
				}

				if( $post['user_signature'] && $this->user['user_view_signatures'] ) {
					$post['user_signature'] = '.........................<br>' . $this->format( $post['user_signature'], FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_BBCODE | FORMAT_EMOJIS );
				} else {
					$post['user_signature'] = null;
				}

				$xtpl->parse( 'Conversation.Post.PosterInfoMember' );
			} else {
				$post['user_email_form'] = null;
				$post['user_homepage'] = null;
				$post['user_facebook'] = null;
				$post['user_twitter'] = null;
				$post['user_pm'] = null;
				$post['user_signature'] = null;
				$icons = array();

				$xtpl->assign( 'post_ip', $post['post_ip'] );

				$xtpl->parse( 'Conversation.Post.PosterInfoGuest' );
			}

			$xtpl->assign( 'user_signature', $post['user_signature'] );

         $params = FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_HTMLCHARS;

         if( $post['post_bbcode'] == true )
            $params |= FORMAT_BBCODE;

         if( $post['post_emojis'] == true )
            $params |= FORMAT_EMOJIS;

         $post_text = $this->format( $post['post_text'], $params );

			if( isset( $attachments[$post['post_id']] ) ) {
				$download_perm = $this->perms->auth( 'post_attach_download', -1 );

				foreach( $attachments[$post['post_id']] as $file )
				{
					if( $download_perm ) {
						$ext = strtolower( substr( $file['attach_name'], -4 ) );

						if( ( $ext == '.jpg' ) || ( $ext == '.gif' ) || ( $ext == '.png' ) ) {
							$topic_link = $this->htmlwidgets->clean_url( $post['topic_title'] );
							$post_text .= "<br><br>{$this->lang->cv_attached_image} {$file['attach_name']} ({$file['attach_downloads']} {$this->lang->cv_attached_downloads})<br><img src='{$this->site}/attachments/{$file['attach_file']}' alt='{$file['attach_name']}'>";
							continue;
						}
					}

					$xtpl->assign( 'attach_id', $file['attach_id'] );
					$xtpl->assign( 'attach_name', $file['attach_name'] );

					$filesize = ceil( $file['attach_size'] / 1024 );
					$xtpl->assign( 'filesize', $filesize );

					$xtpl->assign( 'attach_downloads', $file['attach_downloads'] );

					$xtpl->parse( 'Conversation.Post.Attachment' );
				}
			}
			$xtpl->assign( 'post_text', $post_text );

         $xtpl->parse( 'Conversation.Post' );
      }

		$this->conv_readmarker->mark_conv_read( $conv_id, $newest_post_read );

		$xtpl->parse( 'Conversation' );
		return $xtpl->text( 'Conversation' );
   }

   private function reply()
   {
		if( !isset( $this->get['c'] ) ) {
			return $this->message( $this->lang->cv_replying, $this->lang->cv_cant_reply );
		}

		$c = intval( $this->get['c'] );

      $conv = $this->db->fetch( "SELECT *	FROM %pconversations WHERE FIND_IN_SET( '%s', conv_users ) AND conv_id=%d", $this->user['user_id'], $c );

		if( !$conv ) {
			return $this->message( $this->lang->cv_replying, $this->lang->cv_cant_reply );
		}

      $this->lang->cv_reply_topic = sprintf( $this->lang->cv_reply_topic, $conv['conv_title'] );

		/**
		 * Show the form
		 */
		if( !isset( $this->post['submit'] ) ) {
         $attached = null;
         $attached_data = null;
         $upload_error = null;
         $icon = -1;
         $preview = '';
         $quote = '';

         $checkEmot = ' checked="checked"';
         $checkCode = ' checked="checked"';

         if( !isset( $this->post['attached_data'] ) ) {
            $this->post['attached_data'] = array();
         }

         // if( $this->perms->auth( 'post_attach', -1 ) ) {
            // Attach
            if( isset( $this->post['attach'] ) ) {
               $upload_error = $this->attachmentutil->attach( $this->files['attach_upload'], $this->post['attached_data'] );
            // Detach
            } elseif( isset( $this->post['detach'] ) ) {
               $this->attachmentutil->delete( $this->post['attached'], $this->post['attached_data'] );
            }

            $this->attachmentutil->getdata( $attached, $attached_data, $this->post['attached_data'] );
         // }

         $xtpl = new XTemplate( './skins/' . $this->skin . '/convo_posts.xtpl' );

         $xtpl->assign( 'site', $this->site );
         $xtpl->assign( 'skin', $this->skin );
         $xtpl->assign( 'conv_id', $conv['conv_id'] );

         /**
         * Preview
         */
         if( isset( $this->post['preview'] ) || isset( $this->post['attach'] ) || isset( $this->post['detach'] ) ) {
            $title = $this->format( $conv['conv_title'], FORMAT_HTMLCHARS );
            $desc  = $this->format( $conv['conv_description'], FORMAT_HTMLCHARS );

            $params = FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_HTMLCHARS;

            if( isset( $this->post['parseCode'] ) ) {
               $params |= FORMAT_BBCODE;
               $checkCode = ' checked=\'checked\'';
            } else {
               $checkCode = '';
            }

            if( isset( $this->post['parseEmot'] ) ) {
               $params |= FORMAT_EMOJIS;
               $checkEmot = ' checked=\'checked\'';
            } else {
               $checkEmot = '';
            }

            $quote = $this->format( $this->post['post'], FORMAT_HTMLCHARS );
            $preview_text = $this->format( $this->post['post'], $params );

            if( $title != '' ) {
               $preview_title = $title;
               $preview_title = $desc != '' ? $preview_title . ', ' . $desc : $preview_title;
            } else {
               $preview_title = $this->lang->cv_preview;
            }

            $avatar = $this->htmlwidgets->display_avatar( $this->user );

            $signature = null;
            if( $this->user['user_signature'] ) {
               $signature = '.........................<br>' . $this->format( $this->user['user_signature'], FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_BBCODE | FORMAT_EMOJIS );
            }

            $joined = $this->mbdate( DATE_ONLY_LONG, $this->user['user_joined'] );

            $xtpl->assign( 'avatar', $avatar );
            $xtpl->assign( 'uid', $this->user['user_id'] );
            $xtpl->assign( 'uname', $this->user['user_name'] );
            $xtpl->assign( 'link_name', $this->htmlwidgets->clean_url( $this->user['user_name'] ) );
            $xtpl->assign( 'utitle', $this->user['user_title'] );
            $xtpl->assign( 'utitleicon', $this->user['membertitle_icon'] );
            $xtpl->assign( 'cv_level', $this->lang->cv_level );
            $xtpl->assign( 'cv_group', $this->lang->cv_group );
            $xtpl->assign( 'gname', $this->user['group_name'] );
            $xtpl->assign( 'cv_posts', $this->lang->cv_posts );
            $xtpl->assign( 'uposts', $this->user['user_posts'] );
            $xtpl->assign( 'cv_joined', $this->lang->cv_joined );
            $xtpl->assign( 'joined', $joined );

            $xtpl->parse( 'ConvoReply.Preview.PosterMember' );

            if( $this->post['attached_data'] ) {
               $download_perm = $this->perms->auth( 'post_attach_download', -1 );

               foreach( $this->post['attached_data'] as $md5 => $file )
               {
                  if( $download_perm ) {
                     $ext = strtolower( substr( $file, -4 ) );

                     if( ( $ext == '.jpg' ) || ( $ext == '.gif' ) || ( $ext == '.png' ) ) {
                        $preview_text .= "<br><br>{$this->lang->cv_attached} {$file}<br><img src='{$this->site}/attachments/$md5' alt='{$file}'>";
                        continue;
                     }
                  }

                  $preview_text .= "<br><br>{$this->lang->cv_attached} {$file}";
               }
            }

            $xtpl->assign( 'preview_title', $preview_title );
            $xtpl->assign( 'preview_text', $preview_text );
            $xtpl->assign( 'signature', $signature );

            $xtpl->parse( 'ConvoReply.Preview' );
         } // End Preview

         if( isset( $this->get['qu'] ) ) {
            $qu = intval( $this->get['qu'] );

            $query = $this->db->fetch( "SELECT p.post_text, m.user_name FROM %pconv_posts p, %pusers m
               WHERE p.post_id=%d AND p.post_author=m.user_id AND p.post_convo=%d", $qu, $c );

            if( $query['post_text'] != '' ) {
               $quote = '[quote=' . $query['user_name'] . ']' . $this->format( $query['post_text'], FORMAT_CENSOR | FORMAT_HTMLCHARS ) . '[/quote]';
            }
         }

         $xtpl->assign( 'cv_new_reply', $this->lang->cv_reply_topic );

			$icon = isset( $this->post['icon'] ) ? $this->post['icon'] : -1;
			$msg_icons = $this->htmlwidgets->get_icons( $icon );

			$xtpl->assign( 'post_icon', $this->lang->cv_icon );
			$xtpl->assign( 'msg_icons', $msg_icons );

			$bbcode_menu = $this->bbcode->get_bbcode_menu();
			$smilies = $this->bbcode->generate_emoji_links();
			$xtpl->assign( 'smilies', $smilies );
			$xtpl->assign( 'bbcode_menu', $bbcode_menu );
			$xtpl->assign( 'quote', $quote );

			$xtpl->assign( 'cv_options', $this->lang->cv_options );
			$xtpl->assign( 'checkEmot', $checkEmot );
			$xtpl->assign( 'cv_option_emojis', $this->lang->cv_option_emojis );
			$xtpl->assign( 'checkCode', $checkCode );
			$xtpl->assign( 'cv_option_bbcode', $this->lang->cv_option_bbcode );

			// if( $this->perms->auth( 'post_attach', -1 ) ) {
				if( $attached ) {
					$xtpl->assign( 'cv_attach', $this->lang->cv_attach );
					$xtpl->assign( 'attached', $attached );
					$xtpl->assign( 'cv_attach_remove', $this->lang->cv_attach_remove );
					$xtpl->assign( 'attached_data', $attached_data );

					$xtpl->parse( 'ConvoReply.AttachBox.Remove' );
				}

				$xtpl->assign( 'cv_attach_add', $this->lang->cv_attach_add );
				$xtpl->assign( 'cv_attach_disrupt', $this->lang->cv_attach_disrupt );
				$xtpl->assign( 'upload_error', $upload_error );

				$xtpl->parse( 'ConvoReply.AttachBox' );
			// }

         $xtpl->assign( 'cv_reply', $this->lang->reply );
         $xtpl->assign( 'cv_preview', $this->lang->cv_preview );

         $xtpl->assign( 'cv_last_five', $this->lang->cv_last_five );
         $xtpl->assign( 'cv_view_topic', $this->lang->cv_view_topic );

			$query = $this->db->query( "SELECT p.post_emojis, p.post_bbcode, p.post_time, p.post_text, p.post_author, m.user_name
				FROM %pconv_posts p, %pusers m
				WHERE p.post_convo=%d AND p.post_author = m.user_id
				ORDER BY p.post_time DESC
				LIMIT %d", $conv['conv_id'], 5 );

			$xtpl->assign( 'cv_posted', $this->lang->cv_posted );

			while( $last = $this->db->nqfetch( $query ) )
			{
				$params = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR;

				if( $last['post_bbcode'] ) {
               $params |= FORMAT_BBCODE;
				}

				if( $last['post_emojis'] ) {
					$params |= FORMAT_EMOJIS;
				}

				$last['post_text'] = $this->format( $last['post_text'], $params );
				$last['post_time'] = $this->mbdate( DATE_LONG, $last['post_time'] );

				if( $last['post_author'] != USER_GUEST_UID ) {
					$xtpl->assign( 'user_name', $last['user_name'] );
					$xtpl->assign( 'link_name', $this->htmlwidgets->clean_url( $last['user_name'] ) );
					$xtpl->assign( 'post_author', $last['post_author'] );

					$xtpl->parse( 'ConvoReply.ReplyReview.LastUserMember' );
				} else {
					$xtpl->assign( 'user_name', $this->lang->cv_guest );

					$xtpl->parse( 'ConvoReply.ReplyReview.LastUserGuest' );
				}

				$xtpl->assign( 'last_time', $last['post_time'] );
				$xtpl->assign( 'last_text', $last['post_text'] );

				$xtpl->parse( 'ConvoReply.ReplyReview' );
			}

         $xtpl->parse( 'ConvoReply' );
         return $xtpl->text( 'ConvoReply' );
      } // End Form Presentation

		/**
		 * Final submission of form, after all attachments and previews
		 */
		if( !$this->perms->auth( 'pm_noflood' ) && ( $this->user['user_lastpm'] > ( $this->time - $this->sets['flood_time_pm'] ) ) ) {
			return $this->message( $this->lang->cv_private_conversations, sprintf( $this->lang->cv_flood, $this->sets['flood_time_pm'] ) );
		}

		if( trim( $this->post['post'] ) == '' ) {
			return $this->message( $this->lang->cv_posting, $this->lang->cv_must_msg );
		}

		if( !isset( $this->post['icon'] ) )      $this->post['icon'] = '';
		if( !isset( $this->post['parseCode'] ) ) $this->post['parseCode'] = 0;
		if( !isset( $this->post['parseEmot'] ) ) $this->post['parseEmot'] = 0;

		// I'm not sure if the anti-spam code needs to use the escaped strings or not, so I'll feed them whatever the spammer fed me.
		if( !empty( $this->sets['wordpress_api_key'] ) && $this->sets['akismet_posts'] ) {
			if( !$this->perms->auth( 'is_admin' ) && $this->user['user_posts'] < $this->sets['akismet_posts_number'] ) {
				require_once $this->sets['include_path'] . '/lib/akismet.php';

				$spam_checked = false;
				$akismet = null;

				try {
					$akismet = new Akismet( $this );
					$akismet->set_comment_author( $this->user['user_name'] );
					$akismet->set_comment_author_email( $this->user['user_email'] );
					$akismet->set_comment_content( $this->post['post'] );
					$akismet->set_comment_type( 'forum-post' );

					$spam_checked = true;
				}
				// Try and deal with it rather than say something.
				catch(Exception $e) {}

				if( $spam_checked && $akismet != null ) {
               $response = $akismet->is_this_spam();

               if( isset( $response[1] ) && $response[1] == 'true' ) {
                  // Only store this if Akismet has not issues the x-akismet-pro-tip header
                  if( !isset( $response[0]['x-akismet-pro-tip'] ) || $response[0]['x-akismet-pro-tip'] != 'discard' ) {
                     $this->log_action( 'Possible Spam Posted', 0, 0, 0 );

                     // Store the contents of the entire $_SERVER array.
                     $svars = json_encode( $_SERVER );

                     $this->db->query( "INSERT INTO %pspam (spam_topic, spam_author, spam_text, spam_time, spam_emojis, spam_bbcode, spam_count, spam_ip, spam_icon, spam_svars)
                        VALUES (%d, %d, '%s', %d, %d, %d, %d, '%s', '%s', '%s', '%s', '%s')",
                        $t, $this->user['user_id'], $this->post['post'], $this->time, $this->post['parseEmot'], $this->post['parseCode'], $post_count, $this->ip, $this->post['icon'], $svars );
                  }

                  $this->sets['spam_pm_count']++;
                  $this->sets['spam_pending']++;
                  $this->write_sets();

                  return $this->message( $this->lang->cv_posting, $this->lang->cv_akismet_posts_spam );
               }
            }
         }
      }

		$this->db->query( "INSERT INTO %pconv_posts (post_convo, post_author, post_text, post_time, post_emojis, post_bbcode, post_ip, post_icon, post_referrer, post_agent)
			VALUES (%d, %d, '%s', %d, %d, %d, '%s', '%s', '%s', '%s')",
			$c, $this->user['user_id'], $this->post['post'], $this->time, $this->post['parseEmot'], $this->post['parseCode'], $this->ip, $this->post['icon'], $this->referrer, $this->agent );
		$post_id = $this->db->insert_id( 'conv_posts', 'post_id' );

		$this->db->query( "UPDATE %pconversations SET conv_last_post=%d WHERE conv_id=%d", $post_id, $c );

		$this->db->query( "UPDATE %pconversations SET conv_replies=conv_replies+1, conv_edited=%d, conv_last_poster=%d WHERE conv_id=%d", $this->time, $this->user['user_id'], $c );

		if( isset( $this->post['attached_data'] ) /* && $this->perms->auth( 'post_attach', $f ) */ ) {
			$this->attachmentutil->insert( $post_id, $this->post['attached_data'], true );
		}

		$mailer = new mailer( $this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false );
		$mailer->setSubject( "{$this->sets['forum_name']} - {$this->lang->cv_private_conversations}" );
		$mailer->setServer( $this->sets['mailserver'] );

      $ok_pm = explode( ',', $conv['conv_users'] );
      foreach( $ok_pm as $user )
      {
         // Don't send it to the user who just posted the reply. They already know :P
         if( $user == $this->user['user_id'] )
            continue;

         $who = $this->db->fetch( "SELECT user_email, user_pm_mail FROM %pusers WHERE user_id=%d", $user );

         if( $who['user_pm_mail'] ) {
            $message  = "{$this->sets['forum_name']}\n";
				$message .= "{$this->site}/index.php?a=conversations&s=viewconvo&id={$conv['conv_id']}\n\n";
				$message .= $this->user['user_name'] . " " . $this->lang->cv_sent_reply . "\n\n";
				$message .= $this->lang->cv_title . ": " . $this->format( $conv['conv_title'], FORMAT_CENSOR );

				$mailer->setMessage( $message );
				$mailer->setRecipient( $who['user_email'] );
				$mailer->doSend();
         }
      }

		if( isset( $this->post['request_uri'] ) ) {
			header( 'Location: ' . $this->post['request_uri'] );
		} else {
			header( "Location: {$this->site}/index.php?a=conversations&s=viewconvo&id=$c&&p={$post_id}#p{$post_id}" );
		}
   }

   private function invite_users()
   {
 		if( !isset( $this->get['c'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->cv_conversations, $this->lang->cv_not_found_message );
		}

		if( !$this->validator->validate( $this->get['c'], TYPE_INT ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->cv_conversations, $this->lang->cv_not_found_message );
		}

      $c = intval( $this->get['c'] );

		$conv = $this->db->fetch( "SELECT *
			FROM %pconversations c
			WHERE FIND_IN_SET( '%s', c.conv_users )
         AND c.conv_id=%d", $this->user['user_id'], $c );

		if( !$conv ) {
			$this->set_title( $this->lang->cv_conversations );

			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->cv_conversations, $this->lang->cv_not_found_message );
		}

		$users = explode( ',', $this->post['invite_users'] );
		$bad_name = array();
		$bad_pm = array();
		$ok_pm = array();

      foreach( $users as $username )
      {
         	$username = str_replace( '\\', '&#092;', $this->format( trim( $username ), FORMAT_HTMLCHARS | FORMAT_CENSOR ) );
				$who = $this->db->fetch( "SELECT user_id, user_pm, user_name FROM %pusers
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

            if( in_array( $who_user['id'], $users ) )
               continue;

            if( $who['user_id'] != $this->user['user_id'] )
               $ok_pm[] = $who['user_id'];
      }

      if( empty( $ok_pm ) ) {
         return $this->message( $this->lang->cv_private_conversations, $this->lang->cv_cannot_invite );
      }

      $new_users = implode( ',', $ok_pm );
      $new_users = $conv['conv_users'] . ',' . $new_users;

      $this->db->query( "UPDATE %pconversations SET conv_users='%s' WHERE conv_id=%d", $new_users, $c );

		$mailer = new mailer( $this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false );
		$mailer->setSubject( "{$this->sets['forum_name']} - {$this->lang->cv_private_conversations}" );
		$mailer->setServer( $this->sets['mailserver'] );

      foreach( $ok_pm as $user )
      {
         $who = $this->db->fetch( "SELECT user_email, user_pm_mail FROM %pusers WHERE user_id=%d", $user );

         if( $who['user_pm_mail'] ) {
            $message  = "{$this->sets['forum_name']}\n";
				$message .= "{$this->site}/index.php?a=conversations&s=viewconvo&id={$conv['conv_id']}\n\n";
				$message .= $this->user['user_name'] . " " . $this->lang->cv_sent_invite . "\n\n";
				$message .= $this->lang->cv_title . ": " . $this->format( $conv['conv_title'], FORMAT_CENSOR );

				$mailer->setMessage( $message );
				$mailer->setRecipient( $who['user_email'] );
				$mailer->doSend();
         }
      }

		if( $bad_name || $bad_pm ) {
			return $this->message( $this->lang->cv_private_conversations, sprintf( $this->lang->cv_error_invite, implode( '; ', $bad_name ), implode( '; ', $bad_pm ) ) );
		}

      return $this->message( $this->lang->cv_private_conversations, $this->lang->cv_invited );
   }
}