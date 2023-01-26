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

/**
 * Views a topic
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class topic extends qsfglobal
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

		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = '';
		}

		switch( $this->get['s'] ) {
			case 'attach':
				return $this->get_attachment();
				break;

			default:
				return $this->get_topic();
		}
	}

	private function get_topic()
	{
		if( !isset( $this->get['tname'] ) || !isset( $this->get['t'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->topic_error, $this->lang->topic_not_found_message );
		}

		if( !$this->validator->validate( $this->get['tname'], TYPE_STRING ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->topic_error, $this->lang->topic_not_found_message );
		}

		if( !$this->validator->validate( $this->get['t'], TYPE_INT ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->topic_error, $this->lang->topic_not_found_message );
		}

		$num = $min = $postnum = 0;
		$unread = false;

		$topicnum = intval( $this->get['t'] );
		$tname = strtolower( $this->get['tname'] );

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
		if( $topicnum < 0 )
			$topicnum = 0;

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
		
		$topic = $this->db->fetch( "SELECT t.topic_title, t.topic_description, t.topic_modes, t.topic_starter, t.topic_forum,
				t.topic_icon, t.topic_edited, t.topic_replies, t.topic_poll_options, t.topic_type, f.forum_name
			FROM %ptopics t, %pforums f
			WHERE t.topic_id=%d AND t.topic_type=%d AND f.forum_id=t.topic_forum", $topicnum, TOPIC_TYPE_FORUM );

		if( !$topic || $tname != $this->htmlwidgets->clean_url( $topic['topic_title'] ) ) {
			$this->set_title( $this->lang->topic_not_found );

			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->topic_error, $this->lang->topic_not_found_message );
		}

		if( !( $topic['topic_modes'] & TOPIC_PUBLISH ) && !$this->perms->auth( 'topic_view_unpublished', $topic['topic_forum'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->topic_error, $this->lang->topic_unpublished );
		}

		if( !$this->perms->auth( 'topic_view', $topic['topic_forum'] ) ) {
			header( 'HTTP/1.0 403 Forbidden' );

			return $this->message( $this->lang->topic_error, ( $this->perms->is_guest ) ? sprintf( $this->lang->topic_perm_view_guest, $this->self ) : $this->lang->topic_perm_view	);
		}

		if( $this->get['view'] ) {
			if( $this->get['view'] == 'older' ) {
				$order = 'DESC';
				$where = "topic_edited < %d";
				
				if( $topic['topic_modes'] & TOPIC_PINNED ) {
					$where .= ' OR ';
				} else {
					$where .= ' AND ';
				}
				$where .= "(topic_modes & " . TOPIC_PINNED . ") = 0";
			} else {
				$order = 'ASC';
				$where = "topic_edited > %d";

				if( !( $topic['topic_modes'] & TOPIC_PINNED ) ) {
					$where .= ' OR ';
				} else {
					$where .= ' AND ';
				}
				$where .= "(topic_modes & " . TOPIC_PINNED . ") = " . TOPIC_PINNED;
			}
 
			$new_topic = $this->db->fetch( "SELECT topic_id, topic_title FROM %ptopics
					WHERE topic_forum=%d AND topic_type=%d AND ($where)
					ORDER BY (topic_modes & %d) $order, topic_edited $order
					LIMIT 1", $topic['topic_forum'], TOPIC_TYPE_FORUM, $topic['topic_edited'], TOPIC_PINNED );

			if( $new_topic ) {
                                // Move to that topic
				$topic_link = $this->htmlwidgets->clean_url( $new_topic['topic_title'] );
				header( "Location: {$this->site}/topic/{$topic_link}-{$new_topic['topic_id']}" );
				return;
                        } else {
				header( 'HTTP/1.0 404 Not Found' );

				if( $this->get['view'] == 'older' ) {
					return $this->message( $this->lang->topic_not_found, $this->lang->topic_no_older );
				} else {
					return $this->message( $this->lang->topic_not_found, $this->lang->topic_no_newer );
				}
			}
                }

		if( $unread ) {
			// Jump to the first unread post (or the last post)
			$timeread = $this->readmarker->topic_last_read( $topicnum );

			$posts = $this->db->fetch( "SELECT COUNT(post_id) posts FROM %pposts WHERE post_topic=%d AND post_time < %d", $topicnum, $timeread );

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
			$posts = $this->db->fetch( "SELECT COUNT(post_id) posts FROM %pposts WHERE post_topic=%d AND post_id < %d", $topicnum, $postnum );

			if( $posts )
				$postCount = $posts['posts'] + 1;
			else
				$postCount = 0;

			$min = 0; // Start at the first page regardless
			while( $postCount > ( $min + $num ) ) {
				$min += $num;
			}
		}

		$this->db->query( "UPDATE %ptopics SET topic_views=topic_views+1 WHERE topic_id=%d", $topicnum );

		$topic['topic_title'] = $this->format( $topic['topic_title'], FORMAT_CENSOR );
		$title_html = $this->format( $topic['topic_title'], FORMAT_HTMLCHARS );

		$topic_link = $this->htmlwidgets->clean_url( $topic['topic_title'] );

		// Add RSS feed link for forum and topic
		$this->lang->forum(); // needed for 'Forum' and 'Topic'

		$this->add_feed( $this->site . '/index.php?a=rssfeed&amp;f=' . $topic['topic_forum'], "{$this->lang->forum_forum}: {$topic['forum_name']}" );
		$this->add_feed( $this->site . '/index.php?a=rssfeed&amp;t=' . $topicnum, "{$this->lang->forum_topic}: $title_html" );

      $title_short = $topic['topic_title'];

		if( strlen( $topic['topic_title'] ) > 30 ) {
			$title_short = substr( $topic['topic_title'], 0, 29 ) . '...';
		}

		$this->set_title( $this->lang->topic_viewing . ': ' . $title_html );

		$this->htmlwidgets->tree_forums( $topic['topic_forum'], true );
		$this->tree( $title_short );

		if( $topic['topic_description'] != null && trim( $topic['topic_description'] ) != '' ) {
			$topic['topic_description'] = $this->format( $topic['topic_description'], FORMAT_HTMLCHARS | FORMAT_CENSOR );
		} else {
			$topic['topic_description'] = null;
		}

		$user_started_topic = ( $this->user['user_id'] == $topic['topic_starter'] );
		$opts = array();

		if( $topic['topic_modes'] & TOPIC_LOCKED ) {
			if( $this->perms->auth( 'topic_unlock', $topic['topic_forum'] ) || ( $this->perms->auth( 'topic_unlock_own', $topic['topic_forum'] ) && $user_started_topic ) ) {
				$opts[] = '<a href="' . $this->site . '/index.php?a=mod&amp;s=lock&amp;t=' . $topicnum . '">' . $this->lang->topic_unlock . '</a>';
			}
		} else {
			if( $this->perms->auth( 'topic_lock', $topic['topic_forum'] ) || ( $this->perms->auth( 'topic_lock_own', $topic['topic_forum'] ) && $user_started_topic ) ) {
				$opts[] = '<a href="' . $this->site . '/index.php?a=mod&amp;s=lock&amp;t=' . $topicnum . '">' . $this->lang->topic_lock . '</a>';
			}
		}

		if( $topic['topic_modes'] & TOPIC_PINNED ) {
			if( $this->perms->auth( 'topic_unpin', $topic['topic_forum'] ) || ( $this->perms->auth( 'topic_unpin_own', $topic['topic_forum'] ) && $user_started_topic ) ) {
				$opts[] = '<a href="' . $this->site . '/index.php?a=mod&amp;s=pin&amp;t=' . $topicnum . '">' . $this->lang->topic_unpin . '</a>';
			}
		} else {
			if( $this->perms->auth( 'topic_pin', $topic['topic_forum'] ) || ( $this->perms->auth( 'topic_pin_own', $topic['topic_forum'] ) && $user_started_topic ) ) {
				$opts[] = '<a href="' . $this->site . '/index.php?a=mod&amp;s=pin&amp;t=' . $topicnum . '">' . $this->lang->topic_pin . '</a>';
			}
		}

		if( $this->perms->auth( 'topic_delete', $topic['topic_forum'] ) || ( $this->perms->auth( 'topic_delete_own', $topic['topic_forum'] ) && $user_started_topic ) ) {
			$opts[] = '<a href="' . $this->site . '/index.php?a=mod&amp;s=del_topic&amp;t=' . $topicnum . '">' . $this->lang->topic_delete . '</a>';
		}

		if( $this->perms->auth( 'topic_move', $topic['topic_forum'] ) || ( $this->perms->auth( 'topic_move_own', $topic['topic_forum'] ) && $user_started_topic ) ) {
			$opts[] = '<a href="' . $this->site . '/index.php?a=mod&amp;s=move&amp;t=' . $topicnum . '">' . $this->lang->topic_move . '</a>';
		}

		if( $this->perms->auth( 'topic_edit', $topic['topic_forum'] ) || ( $this->perms->auth( 'topic_edit_own', $topic['topic_forum'] ) && $user_started_topic ) ) {
			$opts[] = '<a href="' . $this->site . '/index.php?a=mod&amp;s=edit_topic&amp;t=' . $topicnum . '">' . $this->lang->topic_edit . '</a>';
		}

		if( $topic['topic_modes'] & TOPIC_PUBLISH ) {
			if( $this->perms->auth( 'topic_publish', $topic['topic_forum'] ) ) {
				$opts[] = '<a href="' . $this->site . '/index.php?a=mod&amp;s=publish&amp;t=' . $topicnum . '">' . $this->lang->topic_unpublish . '</a>';
			}
		} else {
			if( $this->perms->auth( 'topic_publish', $topic['topic_forum'] ) ) {
				$opts[] = '<a href="' . $this->site . '/index.php?a=mod&amp;s=publish&amp;t=' . $topicnum . '">' . $this->lang->topic_publish . '</a>';
			}
		}
		$splitmode = false;

		if( $this->perms->auth( 'topic_split', $topic['topic_forum'] ) || ( $this->perms->auth( 'topic_split_own', $topic['topic_forum'] ) && $user_started_topic ) ) {
			if( $this->get['s'] == 'split' ) {
				$splitmode = true;
				$min = 0;
				$num = $topic['topic_replies'] + 1;
			}

			$opts[] = "<a href=\"{$this->site}/topic/{$topic_link}-{$topicnum}/&amp;s=split\">{$this->lang->topic_split}</a>";
		}

		$topic_icon = null;
		if( $topic['topic_icon'] ) {
			$topic_icon = $topic['topic_icon'];
		}

		if( !$opts ) {
			$mod_opts = '&nbsp;';
		} else {
			$mod_opts = $this->lang->topic_options . ': [ ' . implode(' | ', $opts) . ' ]';
		}

		$PollDisplay = null;
		if( $topic['topic_modes'] & TOPIC_POLL ) {
			$PollDisplay = $this->get_poll( $topicnum, $topic['topic_title'], $topic['topic_forum'], $title_html, $topic['topic_modes'], $topic['topic_poll_options'] );
 		}

		$query = $this->db->query( "SELECT a.attach_id, a.attach_name, a.attach_downloads, a.attach_size, p.post_id
			FROM %pposts p, %pattach a
			WHERE p.post_topic = %d AND a.attach_post = p.post_id",	$topicnum );

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
			FROM (%pposts p, %pusers m, %pgroups g)
			LEFT JOIN %pactive a ON a.active_id=m.user_id
			LEFT JOIN %pmembertitles t ON t.membertitle_id=m.user_level
			WHERE p.post_topic = %d AND p.post_author = m.user_id AND m.user_group = g.group_id
			GROUP BY p.post_id
			ORDER BY p.post_time
			LIMIT %d, %d",
			$topicnum, $min, $num );

		$i = 0;
		$split = '';
		$oldtime = $this->time - 900;
		$newest_post_read = 0;
		$first_unread_post = false;

		$this->lang->members();

		$xtpl = new XTemplate( './skins/' . $this->skin . '/topic.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'tree', $this->htmlwidgets->tree );
		$xtpl->assign( 'main_forum_rules', $this->lang->main_forum_rules );
		$xtpl->assign( 'main_mark1', $this->lang->main_mark1 );
		$xtpl->assign( 'main_mark', $this->lang->main_mark );
		$xtpl->assign( 'main_recent1', $this->lang->main_recent1 );
		$xtpl->assign( 'main_recent', $this->lang->main_recent );
		$xtpl->assign( 'PollDisplay', $PollDisplay );
		$xtpl->assign( 'topicnum', $topicnum );
		$xtpl->assign( 'topic_title_link', $this->htmlwidgets->clean_url( $topic['topic_title'] ) );
		$xtpl->assign( 'reply', $this->lang->reply );

		$can_post = false;
		if( $this->perms->auth( 'post_create', $topic['topic_forum'] ) ) {
			$can_post = true;
		}

		if( $can_post ) {
			$xtpl->assign( 'topic_forum', $topic['topic_forum'] );
			$xtpl->assign( 'topic_create_poll', $this->lang->topic_create_poll );
			$xtpl->assign( 'new_poll', $this->lang->new_poll );
			$xtpl->assign( 'topic_subscribe', $this->lang->topic_subscribe );
			$xtpl->assign( 'subscribe', $this->lang->subscribe );
			$xtpl->assign( 'topic_create_topic', $this->lang->topic_create_topic );
			$xtpl->assign( 'new_topic', $this->lang->new_topic );

			$xtpl->parse( 'Topic.CanPostTop' );
			$xtpl->parse( 'Topic.CanPostBottom' );
		}

		if( $topic['topic_modes'] & TOPIC_LOCKED ) {
			$xtpl->assign( 'topic_locked', $this->lang->topic_locked );

			$xtpl->parse( 'Topic.LockedTop' );
			$xtpl->parse( 'Topic.LockedBottom' );
		}

		$can_reply = false;
		if( $this->perms->auth( 'post_create', $topic['topic_forum'] ) && !( $topic['topic_modes'] & TOPIC_LOCKED ) ) {
			$can_reply = true;
		}

		if( $can_reply ) {
			$xtpl->assign( 'topic_reply', $this->lang->topic_reply );
			$xtpl->assign( 'topic_quickreply', $this->lang->topic_quickreply );

			$xtpl->parse( 'Topic.ReplyTop' );
			$xtpl->parse( 'Topic.ReplyBottom' );
		}

		$xtpl->assign( 'title_html', $title_html );
		$xtpl->assign( 'topic_newer', $this->lang->topic_newer );
		$xtpl->assign( 'topic_older', $this->lang->topic_older );

		$xtpl->assign( 'topic_description', $topic['topic_description'] );

		$pagelinks = $this->htmlwidgets->get_pages( $topic['topic_replies'] + 1, "/topic/{$topic_link}-{$topicnum}/", $min, $num );

		$xtpl->assign( 'topic_pages', $this->lang->topic_pages );
		$xtpl->assign( 'pagelinks', $pagelinks );

		if( strpos( $mod_opts, '&nbsp' ) === false ) {
			$xtpl->assign( 'mod_opts', $mod_opts );

			$xtpl->parse( 'Topic.ModPageLinksTop' );
			$xtpl->parse( 'Topic.ModPageLinksBottom' );
		} else {
			$xtpl->parse( 'Topic.PageLinksTop' );
			$xtpl->parse( 'Topic.PageLinksBottom' );
		}

		$xtpl->assign( 'topic_new_post', $this->lang->topic_new_post );
		$xtpl->assign( 'topic_top', $this->lang->topic_top );
		$xtpl->assign( 'topic_bottom', $this->lang->topic_bottom );
		$xtpl->assign( 'topic_delete_spam', $this->lang->topic_delete_spam );
		$xtpl->assign( 'spam', $this->lang->spam );
		$xtpl->assign( 'topic_delete_post', $this->lang->topic_delete_post );
		$xtpl->assign( 'delete', $this->lang->delete );
		$xtpl->assign( 'topic_edit_post', $this->lang->topic_edit_post );
		$xtpl->assign( 'edit', $this->lang->edit );
		$xtpl->assign( 'topic_quote', $this->lang->topic_quote );
		$xtpl->assign( 'quote', $this->lang->quote );
		$xtpl->assign( 'topic_attached', $this->lang->topic_attached );
		$xtpl->assign( 'topic_attached_filename', $this->lang->topic_attached_filename );
		$xtpl->assign( 'topic_attached_size', $this->lang->topic_attached_size );
		$xtpl->assign( 'topic_attached_downloads', $this->lang->topic_attached_downloads );
		$xtpl->assign( 'topic_guest', $this->lang->topic_guest );
		$xtpl->assign( 'topic_unreg', $this->lang->topic_unreg );
		$xtpl->assign( 'topic_online', $this->lang->topic_online );
		$xtpl->assign( 'topic_offline', $this->lang->topic_offline );
		$xtpl->assign( 'topic_group', $this->lang->topic_group );
		$xtpl->assign( 'topic_posts', $this->lang->topic_posts );
		$xtpl->assign( 'topic_joined', $this->lang->topic_joined );
		$xtpl->assign( 'topic_split_keep', $this->lang->topic_split_keep );
		$xtpl->assign( 'topic_split_move', $this->lang->topic_split_move );
		$xtpl->assign( 'topic_split_finish', $this->lang->topic_split_finish );
		$xtpl->assign( 'members_email_member', $this->lang->members_email_member );
		$xtpl->assign( 'members_send_pm', $this->lang->members_send_pm );
		$xtpl->assign( 'members_visit_twitter', $this->lang->members_visit_twitter );
		$xtpl->assign( 'members_visit_facebook', $this->lang->members_visit_facebook );
		$xtpl->assign( 'members_visit_www', $this->lang->members_visit_www );

		while( $post = $this->db->nqfetch( $query ) )
		{
			$newest_post_read = $post['post_time'];
			$post['newpost'] = !$this->readmarker->is_post_read( $topicnum, $post['post_time'] );

			if( $first_unread_post === false && $post['newpost'] ) {
				$xtpl->parse( 'Topic.Post.FirstUnread' );

				$first_unread_post = true;
			} else if( $first_unread_post === true ) {
				$first_unread_post = false;
			}

			if( $post['newpost'] ) {
				$xtpl->parse( 'Topic.Post.NewPost' );
			}

			if( !( $post['newpost'] ) && !( $post['post_icon'] ) ) {
				$xtpl->parse( 'Topic.Post.NewPostTopic' );
			} elseif( $post['post_icon'] ) {
				$xtpl->assign( 'post_icon', $post['post_icon'] );

				$xtpl->parse( 'Topic.Post.PostIcon' );
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
				$edited = sprintf( $this->lang->topic_edited, $post['post_edited_time'], $post['post_edited_by'] );
			}
			$xtpl->assign( 'edited', $edited );

			$hours = $this->sets['edit_post_age'];

			$can_delete = false;
			$user_created_post = ( $this->user['user_id'] == $post['post_author'] );
			if( $this->perms->auth( 'post_delete', $topic['topic_forum'] ) || ( $user_created_post && $this->perms->auth( 'post_delete_own', $topic['topic_forum'] ) ) ) {
				if( !( $topic['topic_modes'] & TOPIC_LOCKED ) )
					$can_delete = true;
				if( $hours > 0 && $this->time - ( $hours * 60 * 60 ) > $post_time )
					$can_delete = false;
				if( $this->perms->auth( 'post_delete_old', $topic['topic_forum'] ) )
					$can_delete = true;
			}

			if( $can_delete ) {
				$xtpl->parse( 'Topic.Post.CanDelete' );
			}

			$can_edit = false;
			if( $this->perms->auth( 'post_edit', $topic['topic_forum'] ) || ( $user_created_post && $this->perms->auth( 'post_edit_own', $topic['topic_forum'] ) ) ) {
				if( !( $topic['topic_modes'] & TOPIC_LOCKED ) )
					$can_edit = true;
				if( $hours > 0 && $this->time - ( $hours * 60 * 60 ) > $post_time )
					$can_edit = false;
				if( $this->perms->auth( 'post_edit_old', $topic['topic_forum'] ) )
					$can_edit = true;
			}

			if( $can_edit ) {
				$xtpl->parse( 'Topic.Post.CanEdit' );
			}

			$can_reply = false;
			if( $this->perms->auth( 'post_create', $topic['topic_forum'] ) && !( $topic['topic_modes'] & TOPIC_LOCKED ) ) {
				$can_reply = true;
			}

			if( $can_reply ) {
				$xtpl->parse( 'Topic.Post.CanReply' );
			}

			$params = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR;

			if( $post['post_bbcode'] ) {
				$params |= FORMAT_BBCODE;
			}

			if( $post['post_emojis'] ) {
				$params |= FORMAT_EMOJIS;
			}

			$post['post_text'] = $this->format( $post['post_text'], $params );

			if( $splitmode && $i ) {
				$xtpl->parse( 'Topic.Post.SplitSelect' );
			}

			if( isset( $this->get['hl'] ) ) {
				$post['post_text'] = str_replace( $this->get['hl'], "<span style='color:#FF0000; font-weight:bold'>{$this->get['hl']}</span>", $post['post_text'] );
			}

			if( !$this->perms->auth( 'post_viewip', $topic['topic_forum'] ) ) {
				$post['post_ip'] = null;
			}

			if( $post['post_author'] != USER_GUEST_UID ) {
				$post['user_avatar'] = $this->htmlwidgets->display_avatar( $post );
				$xtpl->assign( 'user_avatar', $post['user_avatar'] );

				$online = ( $post['active_time'] && ($post['active_time'] > $oldtime) && $post['user_active'] );
				if( $online ) {
					$xtpl->parse( 'Topic.Post.PosterInfoMember.Online' );
				} else {
					$xtpl->parse( 'Topic.Post.PosterInfoMember.Offline' );
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

					$xtpl->parse( 'Topic.Post.PosterInfoMember.PostIP' );
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

					$xtpl->parse( 'Topic.Post.PosterInfoMember.EmailShow' );
				}

				if( !$post['user_email_show'] && $post['user_email_form'] && $this->perms->auth( 'email_use' ) ) {
					$xtpl->assign( 'user_id', $post['user_id'] );
					$xtpl->assign( 'email_link_name', $this->htmlwidgets->clean_url( $post['user_name'] ) );

					$xtpl->parse( 'Topic.Post.PosterInfoMember.EmailForm' );
				}

				if( $post['user_pm'] ) {
					$xtpl->assign( 'encoded_name', base64_encode( $post['user_name'] ) );

					$xtpl->parse( 'Topic.Post.PosterInfoMember.PM' );
				}

				if( $post['user_twitter'] ) {
					$xtpl->assign( 'twitter', 'https://twitter.com/' . $post['user_twitter'] );

					$xtpl->parse( 'Topic.Post.PosterInfoMember.Twitter' );
				}

				if( $post['user_facebook'] ) {
					$xtpl->assign( 'facebook', $post['user_facebook'] );

					$xtpl->parse( 'Topic.Post.PosterInfoMember.Facebook' );
				}

				if( $post['user_homepage'] ) {
					$xtpl->assign( 'homepage', $post['user_homepage'] );

					$xtpl->parse( 'Topic.Post.PosterInfoMember.Homepage' );
				}

				if( $post['user_signature'] && $this->user['user_view_signatures'] ) {
					$post['user_signature'] = '.........................<br>' . $this->format( $post['user_signature'], FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_BBCODE | FORMAT_EMOJIS );
				} else {
					$post['user_signature'] = null;
				}

				$xtpl->parse( 'Topic.Post.PosterInfoMember' );
			} else {
				$post['user_email_form'] = null;
				$post['user_homepage'] = null;
				$post['user_facebook'] = null;
				$post['user_twitter'] = null;
				$post['user_pm'] = null;
				$post['user_signature'] = null;
				$icons = array();

				$xtpl->assign( 'post_ip', $post['post_ip'] );

				$xtpl->parse( 'Topic.Post.PosterInfoGuest' );
			}

			$xtpl->assign( 'user_signature', $post['user_signature'] );

			if( isset( $attachments[$post['post_id']] ) ) {
				$download_perm = $this->perms->auth( 'post_attach_download', $topic['topic_forum'] );

				foreach( $attachments[$post['post_id']] as $file )
				{
					if( $download_perm ) {
						$ext = strtolower( substr( $file['attach_name'], -4 ) );

						if( ( $ext == '.jpg' ) || ( $ext == '.gif' ) || ( $ext == '.png' ) ) {
							$topic_link = $this->htmlwidgets->clean_url( $post['topic_title'] );
							$post['post_text'] .= "<br><br>{$this->lang->topic_attached_image} {$file['attach_name']} ({$file['attach_downloads']} {$this->lang->topic_attached_downloads})<br><img src='{$this->site}/attachments/{$file['attach_file']}' alt='{$file['attach_name']}'>";
							continue;
						}
					}

					$xtpl->assign( 'attach_id', $file['attach_id'] );
					$xtpl->assign( 'attach_name', $file['attach_name'] );

					$filesize = ceil( $file['attach_size'] / 1024 );
					$xtpl->assign( 'filesize', $filesize );

					$xtpl->assign( 'attach_downloads', $file['attach_downloads'] );

					$xtpl->parse( 'Topic.Post.Attachment' );
				}
			}
			$xtpl->assign( 'post_text', $post['post_text'] );

			$xtpl->parse( 'Topic.Post' );
		}

		$this->readmarker->mark_topic_read( $topicnum, $newest_post_read );

		// Quickreply
		if( $can_reply ) {
			$this->lang->post();

			$xtpl->assign( 'post_msg', $this->lang->post_msg );
			$xtpl->assign( 'post_option_emojis', $this->lang->post_option_emojis );
			$xtpl->assign( 'post_option_bbcode', $this->lang->post_option_bbcode );
			$xtpl->assign( 'post_preview', $this->lang->post_preview );

			$xtpl->assign( 'bbcode_menu', $this->bbcode->get_bbcode_menu() );
			$xtpl->assign( 'smilies', $this->bbcode->generate_emoji_links() );

			$xtpl->parse( 'Topic.QuickReplyBox' );
		}

		$xtpl->parse( 'Topic' );
		return $xtpl->text( 'Topic' );
	}

	private function get_attachment()
	{
		if( !isset( $this->get['id'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->topic_attached_title, $this->lang->topic_attached_perm );
		}

		$id = intval( $this->get['id'] );

		if( $id < 0 )
			$id = 0;

		$data = $this->db->fetch( "SELECT a.attach_name, a.attach_file, a.attach_size, t.topic_forum
			FROM %pattach a, %pposts p, %ptopics t
			WHERE a.attach_post = p.post_id AND p.post_topic = t.topic_id AND a.attach_id = %d", $id );

		if( $this->perms->auth( 'post_attach_download', $data['topic_forum'] ) ) {
			$this->nohtml = true;

			$this->db->query( "UPDATE %pattach SET attach_downloads=attach_downloads+1 WHERE attach_id=%d", $id );

			// Need to terminate and unlock the session at this point or the site will stall for the current user.
			session_write_close();

			ini_set( "zlib.output_compression", "Off" );
			header( "Connection: close" );
			header( 'Content-Description: File Transfer' );
			header( "Content-Type: application/octet-stream" );
			header( "Content-Disposition: attachment; filename=\"{$data['attach_name']}\"" );
			header( "Content-Length: " . $data['attach_size'] );
			header( "X-Robots-Tag: noarchive, nosnippet, noindex" );

			// directly pass through file to output buffer
			@readfile( './attachments/' . $data['attach_file'] );
		} else {
			return $this->message( $this->lang->topic_attached_title, $this->lang->topic_attached_perm );
		}
	}

	private function get_poll( $t, $tname, $f, $title_html, $topic_modes, $options )
	{
		$user_voted = $this->db->fetch( "SELECT vote_option FROM %pvotes WHERE vote_user=%d AND vote_topic=%d", $this->user['user_id'], $t );

		$xtpl = new XTemplate( './skins/' . $this->skin . '/topic.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'title_html', $title_html );

		if( $user_voted || !$this->perms->auth( 'poll_vote', $f ) || ( $topic_modes & TOPIC_LOCKED ) || ( isset( $this->get['results'] ) && $this->sets['vote_after_results'] ) ) {
			$votes = $this->db->query( "SELECT vote_option FROM %pvotes WHERE vote_topic=%d AND vote_option != -1", $t );

			$results = array();
			$total_votes = 0;

			while( $vote = $this->db->nqfetch( $votes ) )
			{
				if( isset( $results[$vote['vote_option']] ) ) {
					$results[$vote['vote_option']]++;
				} else {
					$results[$vote['vote_option']] = 1;
				}

				$total_votes++;
			}

			if( !$total_votes ) {
				return $this->message( $this->lang->topic_no_votes, $this->lang->topic_no_votes );
			}

			$xtpl->assign( 'topic_votes', $this->lang->topic_votes );
			$xtpl->assign( 'total_votes', $total_votes );

			$options = explode( "\n", $options );
			foreach( $options as $i => $option )
			{
				if( trim( $option ) == '' ) {
					continue;
				}

				if( !isset( $results[$i] ) ) {
					$results[$i] = 0;
				}

				$option = $this->format( $option, FORMAT_BBCODE | FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_EMOJIS );
				$xtpl->assign( 'option', $option );

				$percent = round( $results[$i] / $total_votes * 100, 2 );
				$width   = round( $results[$i] / $total_votes * 100 ) * 2;

				if( $results[$i] != 1 ) {
					$votes = sprintf( $this->lang->topic_vote_count_plur, $results[$i] );
				} else {
					$votes = sprintf( $this->lang->topic_vote_count_sing, $results[$i] );
				}

				$xtpl->assign( 'width', $width );
				$xtpl->assign( 'percent', $percent );
				$xtpl->assign( 'votes', $votes );

				$xtpl->parse( 'PollResults.Entry' );
			}

			$xtpl->parse( 'PollResults' );
			return $xtpl->text( 'PollResults' );
		} else {
			$xtpl->assign( 'topic_link_name', $this->htmlwidgets->clean_url( $tname ) );
			$xtpl->assign( 't', $t );
			$xtpl->assign( 'topic_view', $this->lang->topic_view );
			$xtpl->assign( 'topic_vote', $this->lang->topic_vote );

			$options  = explode( "\n", $options );

			foreach( $options as $i => $option )
			{
				if( trim( $option ) == '' ) {
					continue;
				}

				$option = $this->format( $option, FORMAT_BBCODE | FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_EMOJIS );

				$xtpl->assign( 'i', $i );
				$xtpl->assign( 'option', $option );

				$xtpl->parse( 'Poll.Option' );
			}

			$xtpl->parse( 'Poll' );
			return $xtpl->text( 'Poll' );
		}
	}
}
?>