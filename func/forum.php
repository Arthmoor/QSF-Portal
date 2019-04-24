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
 * Forum view
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 */
class forum extends qsfglobal
{
	private $has_topics = false; // Set this to true if at least one topic exists to display.

	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->site ) : $this->lang->board_noview
			);
		}

		if( !isset( $this->get['fname'] ) || !isset( $this->get['f'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->forum_forum, $this->lang->forum_noexist );
		}

		if( !$this->validator->validate( $this->get['fname'], TYPE_STRING ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->forum_forum, $this->lang->forum_noexist );
		}

		if( !$this->validator->validate( $this->get['f'], TYPE_INT ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->forum_forum, $this->lang->forum_noexist );
		}

		$fname = strtolower( $this->get['fname'] );
		$f = intval( $this->get['f'] );

		if( !$this->perms->auth( 'forum_view', $f ) ) {
			return $this->message(
				sprintf( $this->lang->forum_msg, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->forum_regfirst, $this->site ) : $this->lang->forum_noview
			);
		}

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
		$asc = isset( $this->get['asc'] ) ? intval( !$this->get['asc'] ) : 1;
		$lasc = $asc ? 0 : 1;

		if( isset( $this->get['order'] ) ) {
			if( $this->get['order'] == 'title' ) {
				$order = 't.topic_title';
			} elseif( $this->get['order'] == 'starter' ) {
				$order = 'topic_starter_name';
			} elseif( $this->get['order'] == 'replies' ) {
				$order = 't.topic_replies';
			} elseif( $this->get['order'] == 'views' ) {
				$order = 't.topic_views';
			} else {
				$this->get['order'] = '';
				$order = 't.topic_edited';
			}

			if( !$this->get['asc'] ) {
				$order .= ' DESC';
			}
		} else {
			$this->get['order'] = '';
			$order = 't.topic_edited DESC';
		}

		/**
		 * Check if the forum exists. We also cause an error if
		 * $exists['forum_parent'] is 0 because categories can't be viewed as forums.
		 */
		$exists = $this->db->fetch( "SELECT forum_id, forum_parent, forum_name, forum_subcat FROM %pforums WHERE forum_id=%d", $f );

		if( !isset( $exists['forum_parent'] ) || !$exists['forum_parent'] ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->forum_forum, $this->lang->forum_noexist );
		}

		if( $fname != $this->htmlwidgets->clean_url( $exists['forum_name'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->forum_forum, $this->lang->forum_noexist );
		}

		// Add RSS feed link for forum
		$this->add_feed( $this->site . '/index.php?a=rssfeed&amp;f=' . $f, "{$this->lang->forum_forum}: {$exists['forum_name']}" );

		$this->set_title( $exists['forum_name'] );

		$topic = $this->db->fetch( "SELECT COUNT(topic_id) AS count FROM %ptopics WHERE topic_forum=%d AND topic_type=%d", $f, TOPIC_TYPE_FORUM );

		$link_name = $this->htmlwidgets->clean_url( $exists['forum_name'] );
		$pagelinks = $this->htmlwidgets->get_pages( $topic['count'], "forum/{$link_name}-{$f}/&amp;order={$this->get['order']}&amp;asc=$lasc", $min, $n );
		$forumjump = $this->htmlwidgets->select_forums( $f, 0, null, true );

		$can_post = false;
		if( $this->perms->auth( 'topic_create', $exists['forum_id'] ) ) {
			$can_post = true;
		}

		$this->htmlwidgets->tree_forums( $f );

		$xtpl = new XTemplate( './skins/' . $this->skin . '/forum.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'tree', $this->htmlwidgets->tree );
		$xtpl->assign( 'main_forum_rules', $this->lang->main_forum_rules );
		$xtpl->assign( 'main_mark1', $this->lang->main_mark1 );
		$xtpl->assign( 'main_mark', $this->lang->main_mark );
		$xtpl->assign( 'main_recent1', $this->lang->main_recent1 );
		$xtpl->assign( 'main_recent', $this->lang->main_recent );

		$this->display_subforums( $xtpl, $f, $exists );

		if( $exists['forum_subcat'] == 0 ) {
			$this->display_topics( $xtpl, $f, $min, $n, $m, $order ); // Yes, this is a bit odd looking but it works.

			if( !$this->has_topics ) {
				$xtpl->assign( 'forum_no_topics', $this->lang->forum_no_topics );

				$xtpl->parse( 'Forum.Topics.NoTopics' );
			} else {
				$xtpl->assign( 'f', $f );
				$xtpl->assign( 'min', $min );
				$xtpl->assign( 'n', $n );
				$xtpl->assign( 'asc', $asc );
				$xtpl->assign( 'forum_mark_read', $this->lang->forum_mark_read );
				$xtpl->assign( 'forum_name', $exists['forum_name'] );
				$xtpl->assign( 'forum_link_name', $this->htmlwidgets->clean_url( $exists['forum_name'] ) );
				$xtpl->assign( 'forum_topic', $this->lang->forum_topic );
				$xtpl->assign( 'forum_starter', $this->lang->forum_starter );
				$xtpl->assign( 'forum_replies', $this->lang->forum_replies );
				$xtpl->assign( 'forum_views', $this->lang->forum_views );
				$xtpl->assign( 'forum_last', $this->lang->forum_last );

				if( $can_post ) {
					$xtpl->assign( 'forum_subscribe', $this->lang->forum_subscribe );
					$xtpl->assign( 'subscribe', $this->lang->subscribe );
					$xtpl->assign( 'forum_new_poll', $this->lang->forum_new_poll );
					$xtpl->assign( 'new_poll', $this->lang->new_poll );
					$xtpl->assign( 'forum_new_topic', $this->lang->forum_new_topic );
					$xtpl->assign( 'new_topic', $this->lang->new_topic );

					$xtpl->parse( 'Forum.Topics.CanPostTop' );
					$xtpl->parse( 'Forum.Topics.CanPostBottom' );
				}

				$xtpl->assign( 'forumjump', $forumjump );
				$xtpl->assign( 'forum_pages', $this->lang->forum_pages );
				$xtpl->assign( 'pagelinks', $pagelinks );
				$xtpl->assign( 'forum_new', $this->lang->forum_new );
				$xtpl->assign( 'forum_hot', $this->lang->forum_hot );
				$xtpl->assign( 'forum_pinned', $this->lang->forum_pinned );
				$xtpl->assign( 'forum_moved', $this->lang->forum_moved );
				$xtpl->assign( 'forum_not', $this->lang->forum_not );
				$xtpl->assign( 'forum_poll', $this->lang->forum_poll );
				$xtpl->assign( 'forum_locked', $this->lang->forum_locked );
				$xtpl->assign( 'forum_dot_detail', $this->lang->forum_dot_detail );

				$xtpl->parse( 'Forum.Topics' );
			}
		}

		$xtpl->parse( 'Forum.SubForum' );
		$xtpl->parse( 'Forum' );
		return $xtpl->text( 'Forum' );
	}

	private function display_subforums( $xtpl, $f, $exists )
	{
		$query = $this->db->query( "SELECT f.forum_id, f.forum_parent, f.forum_name, f.forum_position, f.forum_description, f.forum_topics, f.forum_replies, f.forum_lastpost, f.forum_redirect,
				t.topic_id as LastTopicID, t.topic_title as user_lastpost, t.topic_edited as LastTime,
				m.user_name as user_lastposter, m.user_id as user_lastposterID
			FROM %pforums f
			LEFT JOIN %pposts p ON p.post_id = f.forum_lastpost
			LEFT JOIN %ptopics t ON t.topic_id = p.post_topic
			LEFT JOIN %pusers m ON m.user_id = p.post_author
			WHERE f.forum_parent=%d
			ORDER BY f.forum_parent, f.forum_position", $f );

		$xtpl->assign( 'forum_sub', $this->lang->forum_sub );
		$xtpl->assign( 'forum_forum_url', $this->lang->forum_forum_url );
		$xtpl->assign( 'forum_sub_topics', $this->lang->forum_sub_topics );
		$xtpl->assign( 'forum_sub_replies', $this->lang->forum_sub_replies );
		$xtpl->assign( 'forum_sub_last_post', $this->lang->forum_sub_last_post );
		$xtpl->assign( 'main_topics_new', $this->lang->main_topics_new );
		$xtpl->assign( 'main_topics_old', $this->lang->main_topics_old );
		$xtpl->assign( 'forum_topic_posted', $this->lang->forum_topic_posted );
		$xtpl->assign( 'forum_jump', $this->lang->forum_jump );
		$xtpl->assign( 'forum_by', $this->lang->forum_by );

		if( $forum = $this->db->nqfetch( $query ) ) {
			do {
				if( !$this->perms->auth( 'forum_view', $forum['forum_id'] ) ) {
					continue;
				}

				if( $forum['forum_description'] && !$forum['forum_redirect'] ) {
					$forum['forum_description'] = '<br />' . $forum['forum_description'];
				}

				$topic_unread = false;
				$forum_unread = !$this->readmarker->is_forum_read( $forum['forum_id'], $forum['LastTime'] );

				$xtpl->assign( 'forum_name', $exists['forum_name'] );

				if( $forum['forum_redirect'] ) {
					$xtpl->assign( 'fdesc', $forum['forum_description'] );
					$xtpl->assign( 'fname', $forum['forum_name'] );

					$xtpl->parse( 'Forum.SubForum.Redirect' );
				}
				else {
					$xtpl->assign( 'fid', $forum['forum_id'] );
					$xtpl->assign( 'fname', $forum['forum_name'] );
					$xtpl->assign( 'forum_link_name', $this->htmlwidgets->clean_url( $forum['forum_name'] ) );
					$xtpl->assign( 'fdesc', $forum['forum_description'] );
					$xtpl->assign( 'ftopics', $forum['forum_topics'] );
					$xtpl->assign( 'freplies', $forum['forum_replies'] );

					if( $forum['forum_lastpost'] ) {
						$topic_unread = !$this->readmarker->is_forum_read( $forum['forum_id'], $forum['LastTime'] );

						$forum['LastTime'] = $this->mbdate( DATE_LONG, $forum['LastTime'] );
						$forum['forum_lastpost_topic'] = $forum['LastTopicID'];

						if( $forum['user_lastposterID'] != USER_GUEST_UID ) {
							$xtpl->assign( 'user_lastposterID', $forum['user_lastposterID'] );
							$xtpl->assign( 'user_lastposter', $forum['user_lastposter'] );
							$xtpl->assign( 'link_name', $this->htmlwidgets->clean_url( $forum['user_lastposter'] ) );

							$xtpl->parse( 'Forum.SubForum.Normal.LastPostBox.UserInfo' );
						}

						$full_title = $this->format( $forum['user_lastpost'], FORMAT_CENSOR | FORMAT_HTMLCHARS );
						$forum['user_lastpost'] = $this->format( $forum['user_lastpost'], FORMAT_CENSOR | FORMAT_HTMLCHARS );

						if( strlen( $forum['user_lastpost'] ) > 19 ) {
							$forum['user_lastpost'] = substr( $forum['user_lastpost'], 0, 19 ) . '...';
						}

						if( $forum_unread ) {
							$xtpl->parse( 'Forum.SubForum.Normal.ForumUnread' );
						} else {
							$xtpl->parse( 'Forum.SubForum.Normal.ForumRead' );
						}

						if( $topic_unread ) {
							$xtpl->assign( 'forum_lastpost_topic', $forum['forum_lastpost_topic'] );

							$xtpl->parse( 'Forum.SubForum.Normal.LastPostBox.TopicUnread' );
						}

						$xtpl->assign( 'forum_last_topic_link', $this->htmlwidgets->clean_url( $full_title ) );
						$xtpl->assign( 'LastTopicID', $forum['LastTopicID'] );
						$xtpl->assign( 'full_title', $full_title );
						$xtpl->assign( 'user_lastpost', $forum['user_lastpost'] );
						$xtpl->assign( 'LastTime', $forum['LastTime'] );

						$xtpl->parse( 'Forum.SubForum.Normal.LastPostBox' );
					}
					$xtpl->parse( 'Forum.SubForum.Normal' );
				}
			}
			while( $forum = $this->db->nqfetch( $query ) );
		}
	}

	private function display_topics( $xtpl, $f, $min, $n, $m, $order )
	{
		$query = $this->db->query( "SELECT DISTINCT(p.post_author) as dot,
				t.topic_id, t.topic_title, t.topic_last_poster, t.topic_starter, t.topic_replies, t.topic_modes,
				t.topic_posted, t.topic_edited, t.topic_icon, t.topic_views, t.topic_description, t.topic_moved, t.topic_forum,
				s.user_name AS topic_starter_name, m.user_name AS topic_last_poster_name, t.topic_last_post, t.topic_type
			FROM (%ptopics t, %pusers s)
			LEFT JOIN %pposts p ON (t.topic_id = p.post_topic AND p.post_author = %d)
			LEFT JOIN %pusers m ON m.user_id = t.topic_last_poster
			WHERE ((t.topic_forum = %d) OR (t.topic_modes & %d)) AND t.topic_type=%d AND s.user_id = t.topic_starter
			GROUP BY t.topic_id
			ORDER BY (t.topic_modes & %d) DESC, $order
			LIMIT %d, %d",
			$this->user['user_id'], $f, TOPIC_GLOBAL, TOPIC_TYPE_FORUM, TOPIC_PINNED, $min, $n );

		while( $row = $this->db->nqfetch( $query ) )
		{
			$row['topic_title'] = $this->format( $row['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS );

			$row['newpost'] = !$this->readmarker->is_topic_read( $row['topic_id'], $row['topic_edited'] );

			$topic_link = $this->htmlwidgets->clean_url( $row['topic_title'] );
			$Pages = $this->htmlwidgets->get_pages_topic( $row['topic_replies'], "/topic/{$topic_link}-{$row['topic_id']}/&amp;f={$f}", ', ', 0, $m );

			if( !empty( $row['topic_description'] ) ) {
				$row['topic_description'] = '<br />&raquo; ' . $this->format( $row['topic_description'], FORMAT_CENSOR | FORMAT_HTMLCHARS );
			}

			$state = null;

			if( $row['topic_modes'] & TOPIC_MOVED ) {
				$state = 'moved';
				$row['topic_id'] = $row['topic_moved'];

				$Pages = $this->htmlwidgets->get_pages_topic( $row['topic_replies'], "/topic/{$topic_link}-{$row['topic_id']}/&amp;f={$f}", ', ', 0, $m );
			} elseif( $row['topic_modes'] & TOPIC_LOCKED ) {
				if( $row['newpost'] ) {
					$state = 'new';
				}
				$state .= 'locked';
			} else {
				if( $row['newpost'] ) {
					$state = 'new';
				}

				if( ( $this->user['user_id'] != USER_GUEST_UID) && $row['dot'] ) {
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

			$moved = null;
			if( $row['topic_modes'] & TOPIC_MOVED ) {
				$moved = $this->lang->forum_moved . ': ';
				$row['topic_replies'] = '--';
				$row['topic_views'] = '--';
			} else {
				$row['topic_replies']  = number_format( $row['topic_replies'], 0, null, $this->lang->sep_thousands );
				$row['topic_views']  = number_format( $row['topic_views'], 0, null, $this->lang->sep_thousands );
			}

			if( $row['topic_modes'] & TOPIC_PINNED ) {
				$row['topic_title'] = "<strong>" . $row['topic_title'] . "</strong>";
			}

			if( !( $row['topic_modes'] & TOPIC_PUBLISH ) ) {
				$row['topic_title'] = "<i>" . $row['topic_title'] . "</i>";
			}
			
			$icon = $row['topic_icon']; // Store so skin can still access
			$topic_icon = null;

			if( $row['topic_modes'] & TOPIC_POLL ) {
				$topic_icon = '<img src="' . $this->site . '/skins/' . $this->skin . '/images/icons/chart_bar.png" alt="' . $this->lang->forum_icon . '" />';
			} else {
				if( $row['topic_icon'] ) {
					$topic_icon = '<img src="' . $this->site . '/skins/' . $this->skin . '/mbicons/' . $row['topic_icon'] . '" alt="' . $this->lang->forum_icon . '" />';
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

				if( $row['topic_modes'] & TOPIC_POLL ) {
					$xtpl->assign( 'poll', 'poll' );
				} else {
					$xtpl->assign( 'poll', null );
				}

				if( $row['topic_modes'] & TOPIC_PINNED ) {
					$xtpl->assign( 'pinned', '<div class="pinned">&nbsp;</div>' );
				} else {
					$xtpl->assign( 'pinned', '&nbsp;' );
				}

				if( $icon ) {
					$xtpl->assign( 'topic_icon', "<img src=\"{$this->site}/skins/{$this->skin}/mbicons/{$icon}\" alt=\"{$this->lang->forum_icon}\" class=\"left\" />" );
				} elseif( $topic_icon ) {
					$xtpl->assign( 'topic_icon', $topic_icon );
				} else {
					$xtpl->assign( 'topic_icon', null );
				}

				$xtpl->assign( 'moved', $moved );
				$xtpl->assign( 'topic_id', $row['topic_id'] );
				$xtpl->assign( 'topic_posted', $topic_posted );
				$xtpl->assign( 'topic_title', $row['topic_title'] );
				$xtpl->assign( 'topic_title_link', $this->htmlwidgets->clean_url( $row['topic_title'] ) );
				$xtpl->assign( 'Pages', $Pages );

				if( $row['newpost'] ) {
					$xtpl->assign( 'forum_unread', $this->lang->forum_unread );

					$xtpl->parse( 'Forum.Topics.ForumTopic.NewPost' );
				}

				if( $row['topic_last_poster'] != USER_GUEST_UID ) {
					$xtpl->assign( 'topic_last_poster', $row['topic_last_poster'] );
					$xtpl->assign( 'topic_last_poster_name', $row['topic_last_poster_name'] );
					$xtpl->assign( 'link_name_last', $this->htmlwidgets->clean_url( $row['topic_last_poster_name'] ) );

					$xtpl->parse( 'Forum.Topics.ForumTopic.LastPosterMember' );
				} else {
					$xtpl->assign( 'topic_last_poster_name', $this->lang->forum_guest );

					$xtpl->parse( 'Forum.Topics.ForumTopic.LastPosterGuest' );
				}

				if( $row['topic_starter'] != USER_GUEST_UID ) {
					$xtpl->assign( 'topic_starter', $row['topic_starter'] );
					$xtpl->assign( 'topic_starter_name', $row['topic_starter_name'] );
					$xtpl->assign( 'link_name', $this->htmlwidgets->clean_url( $row['topic_starter_name'] ) );

					$xtpl->parse( 'Forum.Topics.ForumTopic.TopicStarterMember' );
				} else {
					$xtpl->assign( 'topic_starter_name', $this->lang->forum_guest );

					$xtpl->parse( 'Forum.Topics.ForumTopic.TopicStarterGuest' );
				}

				$xtpl->assign( 'topic_description', $row['topic_description'] );
				$xtpl->assign( 'topic_replies', $row['topic_replies'] );
				$xtpl->assign( 'topic_views', $row['topic_views'] );
				$xtpl->assign( 'topic_edited', $row['topic_edited'] );
				$xtpl->assign( 'jump', $jump );

				$xtpl->parse( 'Forum.Topics.ForumTopic' );
			}
		}
	}
}
?>