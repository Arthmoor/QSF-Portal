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
      $xtpl->assign( 'cv_start_convo', $this->lang->cv_start_convo );
		$xtpl->assign( 'cv_topic', $this->lang->cv_topic );
		$xtpl->assign( 'cv_starter', $this->lang->cv_starter );
		$xtpl->assign( 'cv_replies', $this->lang->cv_replies );
		$xtpl->assign( 'cv_views', $this->lang->cv_views );
		$xtpl->assign( 'cv_last', $this->lang->cv_last );
      $xtpl->assign( 'cv_pages', $this->lang->cv_pages );
 
		$convos = $this->getConvos( $xtpl, $min, $n, $m, $order );
		if( !$convos ) {
         $xtpl->assign( 'cv_no_convos', $this->lang->cv_no_convos );
			$xtpl->parse( 'Conversations.Topics.NoTopics' );
      } else {
         // $convo_TopicList = eval( $this->template( 'CONV_TOPICS_MAIN' ) );
      }

      $xtpl->parse( 'Conversations.Topics' );
      $xtpl->parse( 'Conversations' );
		return $xtpl->text( 'Conversations' );
	}

	private function getConvos( $xtpl, $min, $n, $m, $order )
	{
		$has_topics = false;

		$query = $this->db->query( "SELECT c.conv_id, c.conv_title, c.conv_starter, c.conv_last_poster, c.conv_replies, c.conv_posted, c.conv_edited,
				c.conv_icon, c.conv_views, c.conv_description, c.conv_users, c.conv_last_post,
				s.user_name AS conv_starter_name, m.user_name AS conv_last_poster_name
			FROM (%pconversations c, %pusers s, %pusers m)
			WHERE %d IN(c.conv_users) AND s.user_id=c.conv_starter AND m.user_id=c.conv_last_poster
			GROUP BY c.conv_id
			ORDER BY $order
			LIMIT %d, %d", $this->user['user_id'], $min, $n );

      $xtpl->assign( 'conv_jump', $this->lang->cv_jump );
      $xtpl->assign( 'conv_topic_posted', $this->lang->cv_topic_posted );
      $xtpl->assign( 'conv_by', $this->lang->cv_by );

		while( $row = $this->db->nqfetch( $query ) )
		{
         $has_topics = true;

			$row['conv_title'] = $this->format( $row['conv_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS );

			// $row['newpost'] = !$this->readmarker->is_topic_read($row['topic_id'], $row['topic_edited']);

			$Pages = $this->htmlwidgets->get_pages_topic( $row['conv_replies'], 'a=conversations&amp;c=' . $row['conv_id'], ', ', 0, $m );

			if( !empty( $row['conv_description'] ) ) {
				$row['conv_description'] = '<br />&raquo; ' . $this->format( $row['conv_description'], FORMAT_CENSOR | FORMAT_HTMLCHARS );
			}

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
         $xtpl->assign( 'conv_topic_posted', 'conv_topic_posted' );
         $xtpl->assign( 'conv_posted', $row['conv_posted'] );
         $xtpl->assign( 'conv_title', $row['conv_title'] );

         $conv_link = $this->htmlwidgets->clean_url( $row['conv_title'] );
         $xtpl->assign( 'conv_title_link', $conv_link );

         $Pages = $this->htmlwidgets->get_pages_topic( $row['conv_replies'], "/conversations/{$conv_link}-{$row['conv_id']}", ', ', 0, $m );
         $xtpl->assign( 'Pages', $Pages );

         $xtpl->assign( 'conv_unread', 'conv_unread' );
         $xtpl->assign( 'conv_description', $row['conv_description'] );

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
}