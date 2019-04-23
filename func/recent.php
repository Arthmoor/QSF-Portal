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
 * Recent view
 *
 * Displays the topics since last board visit.
 *
 * @author Geoffrey Dunn <quicken@swiftdsl.com.au>
 * @since 1.1.5
 **/
class recent extends qsfglobal
{
	private $has_topics = false; // Set this to true if at least one topic exists to display.

	/**
	 * Main interface. Display a list of topics considered unread
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return string html output for module
	 **/
	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->self ) : $this->lang->board_noview
			);
		}

		// No forum need be specified

		if( isset( $this->get['num'] ) ) {
			$n = intval( $this->get['num'] );
		} elseif( $this->user['user_topics_page'] != 0 ) {
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

		$this->set_title( $this->lang->recent_active );
        	$this->tree( $this->lang->recent_active );

		$forums_str = $this->readmarker->create_forum_permissions_string();

		// Handle the unlikely case where the user cannot view ANY forums
		if( $forums_str == "" ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->recent_forum, $this->lang->recent_noexist );
		}

		$topicCount = $this->countTopics( $forums_str );

		$pagelinks = $this->htmlwidgets->get_pages( $topicCount, 'a=recent', $min, $n );

		$forumjump = $this->htmlwidgets->select_forums( 0, 0, null, true );

		$xtpl = new XTemplate( './skins/' . $this->skin . '/recent.xtpl' );

		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'recent_jump', $this->lang->recent_jump );
		$xtpl->assign( 'recent_by', $this->lang->recent_by );
		$xtpl->assign( 'recent_topic_posted', $this->lang->recent_topic_posted );

		$this->display_topics( $xtpl, $forums_str, $min, $n, $m );

		if( !$this->has_topics ) {
			$xtpl->assign( 'recent_no_topics', $this->lang->recent_no_topics );

			$xtpl->parse( 'Recent.NoTopics' );
		}

		$xtpl->assign( 'main_recent', $this->lang->main_recent );
		$xtpl->assign( 'recent_topic', $this->lang->recent_topic );
		$xtpl->assign( 'recent_starter', $this->lang->recent_starter );
		$xtpl->assign( 'recent_forum', $this->lang->recent_forum );
		$xtpl->assign( 'recent_last', $this->lang->recent_last );
		$xtpl->assign( 'forumjump', $forumjump );
		$xtpl->assign( 'recent_pages', $this->lang->recent_pages );
		$xtpl->assign( 'pagelinks', $pagelinks );
		$xtpl->assign( 'recent_new', $this->lang->recent_new );
		$xtpl->assign( 'recent_hot', $this->lang->recent_hot );
		$xtpl->assign( 'recent_pinned', $this->lang->recent_pinned );
		$xtpl->assign( 'recent_moved', $this->lang->recent_moved );
		$xtpl->assign( 'recent_not', $this->lang->recent_not );
		$xtpl->assign( 'recent_poll', $this->lang->recent_poll );
		$xtpl->assign( 'recent_locked', $this->lang->recent_locked );
		$xtpl->assign( 'recent_dot_detail', $this->lang->recent_dot_detail );

		$xtpl->parse( 'Recent' );
		return $xtpl->text( 'Recent' );
	}
	
	/**
	 * Get a count of all the topics available since the user's last visit
	 *
	 * @param string $forum_str Comma delimited list of forums the user can view
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return int count of topics
	 **/
	private function countTopics( $forums_str )
	{
		$query = $this->db->fetch( "SELECT COUNT(topic_id) AS count FROM %ptopics
			WHERE topic_forum IN (%s) AND topic_edited >= %d",
			$forums_str, $this->user['user_lastvisit'] );

		return $query['count'];
	}

	/**
	 * Fetch the output to display for the list of topics. Based off topics.php
	 *
	 * @param string $forum_str Comma delimited list of forums the user can view
	 * @param int $min First entry to display
	 * @param int $n Number of entries to display
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return string html output
	 **/
	private function display_topics( $xtpl, $forums_str, $min, $n, $m )
	{
		$query = $this->db->query( "SELECT DISTINCT(t.topic_id), p.post_author as dot,
				t.topic_title, t.topic_last_poster, t.topic_starter, t.topic_replies, t.topic_modes,
				t.topic_posted, t.topic_edited, t.topic_icon, t.topic_views, t.topic_description, t.topic_moved, t.topic_forum,
				t.topic_last_post, f.forum_id, f.forum_name,
				s.user_name AS topic_starter_name,
				m.user_name AS topic_last_poster_name
			FROM (%ptopics t, %pforums f, %pusers m, %pusers s)
			LEFT JOIN %pposts p ON (t.topic_id = p.post_topic AND p.post_author = %d)
			LEFT JOIN %preadmarks rm ON (t.topic_id = rm.readmark_topic AND rm.readmark_user = %d)
			WHERE t.topic_forum IN (%s) AND (t.topic_edited >= %d OR (t.topic_edited >= %d AND (rm.readmark_lastread IS NULL OR rm.readmark_lastread < t.topic_edited) ))
				AND t.topic_forum = f.forum_id AND m.user_id = t.topic_last_poster AND s.user_id = t.topic_starter AND t.topic_modes & %d = 0
			ORDER BY t.topic_modes & %d DESC, t.topic_edited DESC
			LIMIT %d, %d",
			$this->user['user_id'], $this->user['user_id'], $forums_str, $this->user['user_lastvisit'],
			$this->user['user_lastallread'], TOPIC_MOVED, TOPIC_PINNED, $min, $n );

		while( $row = $this->db->nqfetch( $query ) )
		{
			$row['topic_title'] = $this->format( $row['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS );
			$row['forum_name'] = $this->format( $row['forum_name'], FORMAT_HTMLCHARS );

			$row['newpost'] = !$this->readmarker->is_topic_read( $row['topic_id'], $row['topic_edited'] );

			$Pages = $this->htmlwidgets->get_pages_topic( $row['topic_replies'], 'a=topic&amp;t=' . $row['topic_id'], ', ', 0, $m );

			if( !empty( $row['topic_description'] ) ) {
				$row['topic_description'] = '<br />&raquo; ' . $this->format( $row['topic_description'], FORMAT_CENSOR | FORMAT_HTMLCHARS );
			}

			if( $row['topic_last_poster'] != USER_GUEST_UID ) {
				$xtpl->assign( 'topic_last_poster', $row['topic_last_poster'] );
				$xtpl->assign( 'topic_last_poster_name', $row['topic_last_poster_name'] );
				$xtpl->assign( 'topic_last_poster_link_name', $this->clean_url( $row['topic_last_poster_name'] ) );

				$xtpl->parse( 'Recent.Topic.LastPosterMember' );
			} else {
				$xtpl->assign( 'topic_last_poster_name', $this->lang->recent_guest );

				$xtpl->parse( 'Recent.Topic.LastPosterGuest' );
			}

			if( $row['topic_starter'] != USER_GUEST_UID ) {
				$xtpl->assign( 'topic_starter', $row['topic_starter'] );
				$xtpl->assign( 'topic_starter_name', $row['topic_starter_name'] );
				$xtpl->assign( 'topic_starter_link_name', $this->clean_url( $row['topic_starter_name'] ) );

				$xtpl->parse( 'Recent.Topic.TopicStarterMember' );
			} else {
				$xtpl->assign( 'topic_starter_name', $this->lang->recent_guest );

				$xtpl->parse( 'Recent.Topic.TopicStarterGuest' );
			}

			$state = null;

			if( $row['topic_modes'] & TOPIC_MOVED ) {
				$state = 'moved';
				$row['topic_id'] = $row['topic_moved'];

			} elseif( $row['topic_modes'] & TOPIC_LOCKED ) {
				if( $row['newpost'] ) {
					$state = 'new';
				}
				$state .= 'locked';
			} else {
				if( $row['newpost'] ) {
					$state = 'new';
				}

				if( ( $this->user['user_id'] != USER_GUEST_UID ) && $row['dot'] ) {
					$state .= 'dot';
				}

				if( $row['topic_replies'] < $this->sets['hot_limit'] ) {
					$state .= 'open';
				} else {
					$state .= 'hot';
				}
			}

			$jump = '&amp;p=' . $row['topic_last_post'] . '#p' . $row['topic_last_post'];

			$row['edited'] = $row['topic_edited']; // Store so skin can access
			$row['topic_edited'] = $this->mbdate( DATE_LONG, $row['topic_edited'] );
			$row['topic_views']  = number_format( $row['topic_views'], 0, null, $this->lang->sep_thousands );

			if( $row['topic_modes'] & TOPIC_PINNED ) {
				$row['topic_title'] = "<strong>" . $row['topic_title'] . "</strong>";
			}

			if( !( $row['topic_modes'] & TOPIC_PUBLISH ) ) {
				$row['topic_title'] = "<i>" . $row['topic_title'] . "</i>";
			}

			$icon = $row['topic_icon']; // Store so skin can still access
			$topic_icon = null;

			if( $row['topic_modes'] & TOPIC_POLL ) {
				$topic_icon = "<img src=\"{$this->site}/skins/{$this->skin}/images/icons/chart_bar.png\" alt=\"{$this->lang->recent_icon}\" />";
			} else {
				if( $row['topic_icon'] ) {
					$topic_icon = "<img src=\"{$this->site}/skins/{$this->skin}/mbicons/{$row['topic_icon']}\" alt=\"{$this->lang->recent_icon}\" />";
				}
			}

			$topic_posted = $this->mbdate( DATE_LONG, $row['topic_posted'] );

			$show_this_topic = true;
			if( !( $row['topic_modes'] & TOPIC_PUBLISH ) ) {
				if( !$this->perms->auth( 'topic_view_unpublished', $row['topic_forum'] ) ) {
					$show_this_topic = false;
				}
			}

			if( $show_this_topic == true ) {
				$this->has_topics = true;

				$xtpl->assign( 'state', $state );

				if( $row['topic_modes'] & TOPIC_POLL )
					$xtpl->assign( 'poll', 'poll' );

				if( $row['topic_modes'] & TOPIC_PINNED ) {
					$xtpl->assign( 'pinned', '<div class="pinned">&nbsp;</div>' );
				} else {
					$xtpl->assign( 'pinned', '&nbsp;' );
				}

				if( $icon ) {
					$xtpl->assign( 'topic_icon', "<img src=\"{$this->site}/skins/{$this->skin}/mbicons/{$icon}\" alt=\"{$this->lang->recent_icon}\" class=\"left\" />" );
				} elseif( $topic_icon ) {
					$xtpl->assign( 'topic_icon', $topic_icon );
				} else {
					$xtpl->assign( 'topic_icon', null );
				}

				$xtpl->assign( 'topic_id', $row['topic_id'] );
				$xtpl->assign( 'topic_posted', $topic_posted );
				$xtpl->assign( 'topic_title', $row['topic_title'] );
				$xtpl->assign( 'Pages', $Pages );
				$xtpl->assign( 'topic_description', $row['topic_description'] );
				$xtpl->assign( 'forum_id', $row['forum_id'] );
				$xtpl->assign( 'forum_name', $row['forum_name'] );
				$xtpl->assign( 'topic_edited', $row['topic_edited'] );
				$xtpl->assign( 'jump', $jump );

				$xtpl->parse( 'Recent.Topic' );
			}
		}
	}
}
?>