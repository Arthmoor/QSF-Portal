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
		$this->tree( $this->lang->cv_conversations );

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
		$conv = $this->db->fetch( 'SELECT COUNT(conv_id) AS count FROM %pconversations WHERE %d IN(conv_users)', $this->user['user_id'] );
		$pagelinks = $this->htmlwidgets->get_pages( $conv['count'], "a=conversations&amp;order={$this->get['order']}&amp;asc=$lasc", $min, $n );

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

		$query = $this->db->query( "SELECT c.conv_id, c.conv_title, c.conv_starter, c.conv_last_poster, c.conv_replies, c.conv_posted, c.conv_edited,
				c.conv_icon, c.conv_views, c.conv_users, c.conv_last_post,
				s.user_name AS conv_starter_name, m.user_name AS conv_last_poster_name
			FROM (%pconversations c, %pusers s, %pusers m)
			WHERE %d IN(c.conv_users) AND s.user_id=c.conv_starter AND m.user_id=c.conv_last_poster
			GROUP BY c.conv_id
			ORDER BY $order
			LIMIT %d, %d", $this->user['user_id'], $min, $n );

      $xtpl->assign( 'conv_by', $this->lang->cv_by );

		while( $row = $this->db->nqfetch( $query ) )
		{
         $has_topics = true;

			$row['conv_title'] = $this->format( $row['conv_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS );

			// $row['newpost'] = !$this->readmarker->is_topic_read($row['topic_id'], $row['topic_edited']);

			$Pages = $this->htmlwidgets->get_pages_topic( $row['conv_replies'], 'a=conversations&amp;c=' . $row['conv_id'], ', ', 0, $m );

			if( $row['conv_last_poster'] != USER_GUEST_UID ) {
				$last_poster = '<a href="' . $this->site . '/profile/' . $this->htmlwidgets->clean_url( $row['conv_last_poster_name'] ) . '-' . $row['conv_last_poster'] . '/" class="small">' . $row['conv_last_poster_name'] . '</a>';
			} else {
				$last_poster = $this->lang->cv_guest_user;
			}

			$state = null;
			$row['newpost'] = null;

			//if ($row['newpost']) {
			//	$state = 'new';
			//}

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
            $xtpl->assign( 'conv_icon', "<img src=\"{$this->site}/skins/{$this->skin}/mbicons/{$icon}\" alt=\"{$this->lang->cv_icon}\" class=\"left\" />" );
			}

			$conv_posted = $this->mbdate( DATE_LONG, $row['conv_posted'] );

         $xtpl->assign( 'state', $state );
         $xtpl->assign( 'conv_id', $row['conv_id'] );
         $xtpl->assign( 'conv_posted', $this->mbdate( DATE_LONG, $row['conv_posted'] ) );
         $xtpl->assign( 'conv_title', $row['conv_title'] );

         $conv_link = $this->htmlwidgets->clean_url( $row['conv_title'] );
         $xtpl->assign( 'conv_title_link', $conv_link );

         $Pages = $this->htmlwidgets->get_pages_topic( $row['conv_replies'], "/conversations/{$conv_link}-{$row['conv_id']}", ', ', 0, $m );
         $xtpl->assign( 'Pages', $Pages );

         $xtpl->assign( 'conv_unread', 'conv_unread' );

			if( $row['conv_starter'] != USER_GUEST_UID ) {
				$xtpl->assign( 'conv_starter', $row['conv_starter'] );
				$xtpl->assign( 'conv_starter_name', $row['conv_starter_name'] );
				$xtpl->assign( 'link_name', $this->htmlwidgets->clean_url( $row['conv_starter_name'] ) );

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

			if( $row['conv_last_poster'] != USER_GUEST_UID ) {
				$xtpl->assign( 'conv_last_poster', $row['conv_last_poster'] );
				$xtpl->assign( 'conv_last_poster_name', $row['conv_last_poster_name'] );
				$xtpl->assign( 'link_name_last', $this->htmlwidgets->clean_url( $row['conv_last_poster_name'] ) );

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
			$preview = '';

			$xtpl = new XTemplate( './skins/' . $this->skin . '/conversations.xtpl' );

         $xtpl->assign( 'site', $this->site );
         $xtpl->assign( 'skin', $this->skin );
         $xtpl->assign( 'tree', $this->htmlwidgets->tree );
         $xtpl->assign( 'main_forum_rules', $this->lang->main_forum_rules );
         $xtpl->assign( 'cv_conversations', $this->lang->cv_conversations );
         $xtpl->assign( 'cv_new_convo', $this->lang->cv_new_convo );
         $xtpl->assign( 'cv_to', $this->lang->cv_to );
         $xtpl->assign( 'cv_multiple', $this->lang->cv_multiple );
         $xtpl->assign( 'cv_title', $this->lang->cv_title );

			$xtpl->assign( 'smilies', $this->bbcode->generate_emoji_links() );
			$xtpl->assign( 'bbcode_menu', $this->bbcode->get_bbcode_menu() );

         if( isset( $this->post['preview'] ) ) {
				$preview_text = $this->post['message'];
				$msg = $this->format( $preview_text, FORMAT_HTMLCHARS );
				$preview_text = $this->format( $preview_text, FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_BBCODE | FORMAT_EMOJIS );

				$to = $this->format( $this->post['to'], FORMAT_HTMLCHARS );
				$title = $this->format( $this->post['title'], FORMAT_HTMLCHARS | FORMAT_CENSOR );
				$preview_title = $title;

				$xtpl->assign( 'preview_title', $preview_title );
				$xtpl->assign( 'preview_text', $preview_text );

				$xtpl->parse( 'Conversations.NewConvo.Preview' );
         }

         $xtpl->assign( 'to', $to );
         $xtpl->assign( 'title', $title );
			$xtpl->assign( 'msg', $msg );

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

				$ok_pm[] = $who['user_id'];
      }

      if( empty( $ok_pm ) ) {
         return $this->message( $this->lang->cv_private_conversations, $this->lang->cv_cannot_send );
      }

      $recipients = implode( ',', $ok_pm );
      $recipients = $this->user['user_id'] . ',' . $recipients;

      $this->db->query( "INSERT INTO %pconversations (conv_title, conv_starter, conv_last_poster, conv_icon, conv_posted, conv_edited, conv_users)
			VALUES ('%s', %d, %d, '%s', %d, %d, '%s')", $this->post['title'], $this->user['user_id'], $this->user['user_id'], '', $this->time, $this->time, $recipients );

      $conv_id = $this->db->insert_id( 'conversations', 'conv_id' );

      $this->db->query( "INSERT INTO %pconv_posts (post_convo, post_author, post_time, post_ip, post_icon, post_text, post_referrer, post_agent)
         VALUES (%d, %d, %d, '%s', '%s', '%s', '%s', '%s')", $conv_id, $this->user['user_id'], $this->time, $this->ip, '', $this->post['message'], $this->referrer, $this->agent );

      $post_id = $this->db->insert_id( 'conv_posts', 'post_id' );

      $this->db->query( "UPDATE %pconversations SET conv_last_post=%d WHERE conv_id=%d", $post_id, $conv_id );
      
		$mailer = new mailer( $this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false );
		$mailer->setSubject( "{$this->sets['forum_name']} - {$this->lang->cv_private_conversations}" );
		$mailer->setServer( $this->sets['mailserver'] );

      foreach( $ok_pm as $user )
      {
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
      return "Nothing to see here yet.";
   }   
}