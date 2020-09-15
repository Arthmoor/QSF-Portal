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
 * Creates topics, polls, and replies
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.1
 **/
class post extends qsfglobal
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
			$this->get['s'] = null;
		}

		switch( $this->get['s'] )
		{
		case 'vote':
			return $this->vote();
			break;

		case 'results':
			return $this->nullvote();
			break;

		default:
			return $this->makePost( $this->get['s'] );
			break;
		}
	}

	private function makePost( $s )
	{
		$f = -1;
		$t = -1;

		/**
		 * Determine if the user has permission to make a post here and
		 * execute tasks common to both before and after the form submit.
		 */
		switch( $s )
		{
			case 'reply':
				if( !isset( $this->get['t'] ) ) {
					return $this->message( $this->lang->post_replying, $this->lang->post_cant_reply );
				}

				$t = intval( $this->get['t'] );

				$topic = $this->db->fetch( "SELECT t.topic_modes, t.topic_title, f.forum_name, f.forum_id, t.topic_replies, t.topic_starter
					FROM %ptopics t, %pforums f
					WHERE t.topic_id=%d AND f.forum_id=t.topic_forum", $t );

				if( $topic && !$this->perms->auth( 'post_create', $topic['forum_id'] ) ) {
					if( $this->perms->is_guest ) {
						return $this->message( $this->lang->post_replying, sprintf( $this->lang->post_cant_reply1, $this->self ) );
					} else {
						return $this->message( $this->lang->post_replying, $this->lang->post_cant_reply2 );
					}
				}

				if( !$topic ) {
					return $this->message( $this->lang->post_replying, $this->lang->post_cant_reply );
				}

				if( $topic['topic_modes'] & TOPIC_LOCKED ) {
					return $this->message( $this->lang->post_replying, $this->lang->post_closed );
				}

				if( strlen( $topic['topic_title'] ) > 30 ) {
					$shortened_title = substr( $topic['topic_title'], 0, 29 );
				} else {
					$shortened_title = $topic['topic_title'];
				}

				$shortened_title = $this->format( $topic['topic_title'], FORMAT_CENSOR );

				$f = $topic['forum_id'];

				$this->lang->post_reply_topic = sprintf( $this->lang->post_reply_topic, $topic['topic_title'] );

				$this->htmlwidgets->tree_forums( $topic['forum_id'], true );
				$topic_link = $this->htmlwidgets->clean_url( $topic['topic_title'] );
				$this->tree( $shortened_title, "{$this->site}/topic/{$topic_link}-{$t}/&amp;f={$topic['forum_id']}" );
				$this->tree( $this->lang->post_replying1 );
				break;

			case 'poll':
				if( !isset( $this->get['f'] ) ) {
					return $this->message( $this->lang->post_creating, $this->lang->post_no_forum );
				}

				$f = intval( $this->get['f'] );

				if( !$this->perms->auth( 'poll_create', $f ) ) {
					if( $this->perms->is_guest ) {
						return $this->message( $this->lang->post_creating_poll, sprintf( $this->lang->post_cant_poll, $this->self ) );
					} else {
						return $this->message( $this->lang->post_creating_poll, $this->lang->post_cant_poll1 );
					}
				}

				if( !$this->db->num_rows( $this->db->query( "SELECT forum_id FROM %pforums WHERE forum_id=%d", $f ) ) ) {
					return $this->message( $this->lang->post_creating, $this->lang->post_no_forum );
				}

				$forum = $this->db->fetch( "SELECT forum_name FROM %pforums WHERE forum_id=%d", $f );

				$this->htmlwidgets->tree_forums( $f, true );
				$this->tree( $this->lang->post_creating_poll );
				break;

			default: //topic
				if( !isset( $this->get['f'] ) ) {
					return $this->message( $this->lang->post_creating, $this->lang->post_no_forum );
				}

				$f = intval( $this->get['f'] );

				if( !$this->perms->auth( 'topic_create', $f ) ) {
					if( $this->perms->is_guest ) {
						return $this->message( $this->lang->post_creating, sprintf( $this->lang->post_cant_create, $this->self ) );
					} else {
						return $this->message( $this->lang->post_creating, $this->lang->post_cant_create1 );
					}
				}

				if( !$this->db->num_rows( $this->db->query( "SELECT forum_id FROM %pforums WHERE forum_id=%d", $f ) ) ) {
					return $this->message( $this->lang->post_creating, $this->lang->post_no_forum );
				}

				$forum = $this->db->fetch( "SELECT forum_name FROM %pforums WHERE forum_id=%d", $f );

				$this->htmlwidgets->tree_forums( $f, true );
				$this->tree( $this->lang->post_creating );
		}

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
			$checkGlob = '';
			$global_topic = false;
			$topic_lock = false;
			$topic_pin = false;

			$title   = isset( $this->post['title'] ) ? $this->format( $this->post['title'], FORMAT_HTMLCHARS ) : '';
			$desc    = isset( $this->post['desc'] ) ? $this->format( $this->post['desc'], FORMAT_HTMLCHARS ) : '';
			$options = isset( $this->post['options'] ) ? $this->format( $this->post['options'], FORMAT_HTMLCHARS ) : '';

			if( !isset( $this->post['attached_data'] ) ) {
				$this->post['attached_data'] = array();
			}

			if( $this->perms->auth( 'post_attach', $f ) ) {
				// Attach
				if( isset( $this->post['attach'] ) ) {
					$upload_error = $this->attachmentutil->attach( $this->files['attach_upload'], $this->post['attached_data'] );
				// Detach
				} elseif( isset( $this->post['detach'] ) ) {
					$this->attachmentutil->delete( $this->post['attached'], $this->post['attached_data'] );
				}

				$this->attachmentutil->getdata( $attached, $attached_data, $this->post['attached_data'] );
			}

			$xtpl = new XTemplate( './skins/' . $this->skin . '/post.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );

			/**
			 * Preview
			 */
			if( isset( $this->post['preview'] ) || isset( $this->post['attach'] ) || isset( $this->post['detach'] ) ) {
				if( ( $s == 'topic' ) || ( $s == 'poll' ) ) {
					$title = $this->format( $this->post['title'], FORMAT_HTMLCHARS );
					$desc  = $this->format( $this->post['desc'], FORMAT_HTMLCHARS );

					if( $s == 'poll' ) {
						$options = $this->format( $this->post['options'], FORMAT_HTMLCHARS );
 					}
				}

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

				if( isset( $this->post['global_topic'] ) ) {
					$checkGlob = ' checked=\'checked\'';
				} else {
					$checkGlob = '';
				}

				$quote = $this->format( $this->post['post'], FORMAT_HTMLCHARS );
				$preview_text = $this->format( $this->post['post'], $params );

				if( $title != '' ) {
					$preview_title = $title;
					$preview_title = $desc != '' ? $preview_title . ', ' . $desc : $preview_title;
				} else {
					$preview_title = $this->lang->post_preview;
				}

				$this->lang->topic();

				$signature = null;
				if( $this->perms->is_guest ) {
					$xtpl->assign( 'topic_guest', $this->lang->topic_guest );
					$xtpl->assign( 'topic_unreg', $this->lang->topic_unreg );

					$xtpl->parse( 'Post.Preview.PosterGuest' );
				} else {
					$avatar = $this->htmlwidgets->display_avatar( $this->user );

					if( $this->user['user_signature'] ) {
						$signature = '.........................<br />' . $this->format( $this->user['user_signature'], FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_BBCODE | FORMAT_EMOJIS );
					}

					$joined = $this->mbdate( DATE_ONLY_LONG, $this->user['user_joined'] );

					$xtpl->assign( 'avatar', $avatar );
					$xtpl->assign( 'uid', $this->user['user_id'] );
					$xtpl->assign( 'uname', $this->user['user_name'] );
					$xtpl->assign( 'link_name', $this->htmlwidgets->clean_url( $this->user['user_name'] ) );
					$xtpl->assign( 'utitle', $this->user['user_title'] );
					$xtpl->assign( 'utitleicon', $this->user['membertitle_icon'] );
					$xtpl->assign( 'topic_level', $this->lang->topic_level );
					$xtpl->assign( 'topic_group', $this->lang->topic_group );
					$xtpl->assign( 'gname', $this->user['group_name'] );
					$xtpl->assign( 'topic_posts', $this->lang->topic_posts );
					$xtpl->assign( 'uposts', $this->user['user_posts'] );
					$xtpl->assign( 'topic_joined', $this->lang->topic_joined );
					$xtpl->assign( 'joined', $joined );

					$xtpl->parse( 'Post.Preview.PosterMember' );
				}

				if( $this->post['attached_data'] ) {
					$this->lang->topic();

					$download_perm = $this->perms->auth( 'post_attach_download', $f );

					foreach( $this->post['attached_data'] as $md5 => $file )
					{
						if( $download_perm ) {
							$ext = strtolower( substr( $file, -4 ) );

							if( ( $ext == '.jpg' ) || ( $ext == '.gif' ) || ( $ext == '.png' ) ) {
								$preview_text .= "<br /><br />{$this->lang->topic_attached} {$file}<br /><img src='{$this->site}/attachments/$md5' alt='{$file}' />";
								continue;
							}
						}

						$preview_text .= "<br /><br />{$this->lang->topic_attached} {$file}";
					}
				}

				$xtpl->assign( 'preview_title', $preview_title );
				$xtpl->assign( 'preview_text', $preview_text );
				$xtpl->assign( 'signature', $signature );

				$xtpl->parse( 'Post.Preview' );
			} // End Preview

			if( $s == 'reply' ) {
				if( isset( $this->get['qu'] ) ) {
					$qu = intval( $this->get['qu'] );

					$query = $this->db->fetch("SELECT p.post_text, m.user_name FROM %pposts p, %pusers m
						WHERE p.post_id=%d AND p.post_author=m.user_id AND p.post_topic=%d", $qu, $t );

					if( $query['post_text'] != '' ) {
						$quote = '[quote=' . $query['user_name'] . ']' . $this->format( $query['post_text'], FORMAT_CENSOR | FORMAT_HTMLCHARS ) . '[/quote]';
					}
				}
				$is_owner = $this->user['user_id'] == $topic['topic_starter'];

				if( !($topic['topic_modes'] & TOPIC_LOCKED ) ) {
					if( $this->perms->auth( 'topic_lock', $topic['forum_id'] ) || ( $is_owner && $this->perms->auth( 'topic_lock_own', $topic['forum_id'] ) ) ) {
						$topic_lock = true;
					}
				}

				if( !( $topic['topic_modes'] & TOPIC_PINNED ) ) {
					if( $this->perms->auth( 'topic_pin', $topic['forum_id'] ) || ( $is_owner && $this->perms->auth( 'topic_pin_own', $topic['forum_id'] ) ) ) {
						$topic_pin = true;
					}
				}
			} else {
				if( $this->perms->auth( 'topic_global' ) ) {
					$global_topic = true;
				}

				// Able to lock? Yes if the forum allows "lock any", or if "lock own topics" is allowed.
				// The person creating the topic is assumed to be the owner.
				if( $this->perms->auth( 'topic_lock', $f ) || $this->perms->auth( 'topic_lock_own', $f ) ) {
					$topic_lock = true;
				}

				// Able to pin? Yes if the forum allows "pin any", or if "pin own topics" is allowed.
				// The person creating the topic is assumed to be the owner.
				if( $this->perms->auth( 'topic_pin', $f ) || $this->perms->auth( 'topic_pin_own', $f ) ) {
					$topic_pin = true;
				}
			}

			if( $s == 'poll' ) {
				$xtpl->assign( 'target', "f={$f}" );
				$xtpl->assign( 'icon_file', 'chart_bar_add.png' );
				$xtpl->assign( 'post_new_topic', $this->lang->post_new_poll );
				$xtpl->assign( 'post_create_topic', $this->lang->post_create_poll );
			}
			elseif( $s == 'topic' ) {
				$xtpl->assign( 'target', "f={$f}" );
				$xtpl->assign( 'icon_file', 'new_topic.png' );
				$xtpl->assign( 'post_new_topic', $this->lang->post_new_topic );
				$xtpl->assign( 'post_create_topic', $this->lang->post_create_topic );
			}
			elseif( $s == 'reply' ) {
				$xtpl->assign( 'forum_name', $topic['forum_name'] );
				$xtpl->assign( 'target', "t={$t}" );
				$xtpl->assign( 'icon_file', 'comment_add.png' );
				$xtpl->assign( 'post_new_topic', $this->lang->post_reply_topic );
				$xtpl->assign( 'post_create_topic', $this->lang->post_reply );
			}

			if( $s == 'poll' || $s == 'topic' ) {
				$xtpl->assign( 'forum_name', $forum['forum_name'] );
				$xtpl->assign( 'post_topic_title', $this->lang->post_topic_title );
				$xtpl->assign( 'title', $title );
				$xtpl->assign( 'post_topic_detail', $this->lang->post_topic_detail );
				$xtpl->assign( 'post_optional', $this->lang->post_optional );
				$xtpl->assign( 'desc', $desc );

				$xtpl->parse( 'Post.Topic.New' );
			}

			$icon = isset( $this->post['icon'] ) ? $this->post['icon'] : -1;
			$msg_icons = $this->htmlwidgets->get_icons( $icon );

			$xtpl->assign( 'post_icon', $this->lang->post_icon );
			$xtpl->assign( 'msg_icons', $msg_icons );

			$bbcode_menu = $this->bbcode->get_bbcode_menu();
			$smilies = $this->bbcode->generate_emoji_links();
			$xtpl->assign( 'smilies', $smilies );
			$xtpl->assign( 'bbcode_menu', $bbcode_menu );
			$xtpl->assign( 'quote', $quote );

			$xtpl->assign( 'post_options', $this->lang->post_options );
			$xtpl->assign( 'checkEmot', $checkEmot );
			$xtpl->assign( 'post_option_emojis', $this->lang->post_option_emojis );
			$xtpl->assign( 'checkCode', $checkCode );
			$xtpl->assign( 'post_option_bbcode', $this->lang->post_option_bbcode );

			if( $global_topic && $s != 'reply' ) {
				$xtpl->assign( 'checkGlob', $checkGlob );
				$xtpl->assign( 'post_option_global', $this->lang->post_option_global );

				$xtpl->parse( 'Post.Topic.Global' );
			}

			if( $topic_lock ) {
				$xtpl->assign( 'post_option_lock', $this->lang->post_option_lock );

				$xtpl->parse( 'Post.Topic.Lock' );
			}

			if( $topic_pin ) {
				$xtpl->assign( 'post_option_pin', $this->lang->post_option_pin );

				$xtpl->parse( 'Post.Topic.Pin' );
			}

			if( $this->perms->auth( 'post_attach', $f ) ) {
				if( $attached ) {
					$xtpl->assign( 'post_attach', $this->lang->post_attach );
					$xtpl->assign( 'attached', $attached );
					$xtpl->assign( 'post_attach_remove', $this->lang->post_attach_remove );
					$xtpl->assign( 'attached_data', $attached_data );

					$xtpl->parse( 'Post.Topic.AttachBox.Remove' );
				}

				$xtpl->assign( 'post_attach_add', $this->lang->post_attach_add );
				$xtpl->assign( 'post_attach_disrupt', $this->lang->post_attach_disrupt );
				$xtpl->assign( 'upload_error', $upload_error );

				$xtpl->parse( 'Post.Topic.AttachBox' );
			}

			switch( $s )
			{
				case 'reply':
					$query = $this->db->query( "SELECT p.post_emojis, p.post_bbcode, p.post_time, p.post_text, p.post_author, m.user_name
						FROM %pposts p, %pusers m
						WHERE p.post_topic=%d AND p.post_author = m.user_id
						ORDER BY p.post_time DESC
						LIMIT %d", $t, 5 );

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

							$xtpl->parse( 'Post.Topic.Reply.ReplyReview.LastUserMember' );
						} else {
							$xtpl->assign( 'user_name', $this->lang->post_guest );

							$xtpl->parse( 'Post.Topic.Reply.ReplyReview.LastUserGuest' );
						}

						$xtpl->assign( 'post_posted', $this->lang->post_posted );
						$xtpl->assign( 'last_time', $last['post_time'] );
						$xtpl->assign( 'last_text', $last['post_text'] );

						$xtpl->parse( 'Post.Topic.Reply.ReplyReview' );
					}

					$xtpl->assign( 'post_topic_link', $this->htmlwidgets->clean_url( $topic['topic_title'] ) );
					$xtpl->assign( 'post_last_five', $this->lang->post_last_five );
					$xtpl->assign( 't', $t );
					$xtpl->assign( 'post_view_topic', $this->lang->post_view_topic );

					$xtpl->parse( 'Post.Topic.Reply' );
					break;

				case 'poll':
					$xtpl->assign( 'post_poll_options', $this->lang->post_poll_options );
					$xtpl->assign( 'post_poll_row', $this->lang->post_poll_row );
					$xtpl->assign( 'options', $options );

					$xtpl->parse( 'Post.Topic.PollOptions' );
					break;

				case 'topic':
					break;

				default:
					return $this->message( $this->lang->post_create_topic, "Unknown activity type: $s." );

			} // END: Switch Statement

			$xtpl->assign( 's', $s );
			$xtpl->assign( 'post_preview', $this->lang->post_preview );

			$xtpl->parse( 'Post.Topic' );
			$xtpl->parse( 'Post' );
			return $xtpl->text( 'Post' );
		} else {
			/**
			 * Final submission of form, after all attachments and previews
			 */

			if( !$this->perms->auth( 'post_noflood', $f ) && ( $this->user['user_lastpost'] > ( $this->time - $this->sets['flood_time'] ) ) ) {
				return $this->message( $this->lang->post_replying, sprintf( $this->lang->post_flood, $this->sets['flood_time'] ) );
			}

			if( trim( $this->post['post'] ) == '' ) {
				return $this->message( $this->lang->post_posting, $this->lang->post_must_msg );
			}

			if( !isset( $this->post['icon'] ) )      $this->post['icon'] = '';
			if( !isset( $this->post['parseCode'] ) ) $this->post['parseCode'] = 0;
			if( !isset( $this->post['parseEmot'] ) ) $this->post['parseEmot'] = 0;

			if( $s == 'topic' || $s == 'poll' ) {
				$mode = 0;

				if( $this->perms->auth( 'topic_global') && isset( $this->post['global_topic'] ) ) {
					$mode |= TOPIC_GLOBAL;
				}

				if( $this->perms->auth( 'topic_publish_auto', $f ) ) {
					$mode |= TOPIC_PUBLISH;
				}

				if( isset( $this->post['locktopic'] ) && ( $this->perms->auth( 'topic_lock', $f ) || $this->perms->auth( 'topic_lock_own', $f ) ) ) {
					$mode |= TOPIC_LOCKED;
				}

				if( isset( $this->post['pintopic'] ) && ( $this->perms->auth( 'topic_pin', $f ) || $this->perms->auth( 'topic_pin_own', $f ) ) ) {
					$mode |= TOPIC_PINNED;
				}

				if( trim( $this->post['title'] ) == '' ) {
					return $this->message( $this->lang->post_posting, $this->lang->post_must_title );
				}

				if( $s == 'poll' ) {
					if( trim( $this->post['options'] ) == '' ) {
						return $this->message( $this->lang->post_posting, $this->lang->post_must_options );
					}

					$max_options  = 15;
					$option_count = substr_count( $this->post['options'], "\n" ) + 1;

					if( ( $option_count > $max_options ) || ( $option_count < 2 ) ) {
						return $this->message( $this->lang->post_posting, sprintf( $this->lang->post_too_many_options, $max_options ) );
					}
				}

				$this->sets['topics']++;

				if( $s != 'poll' ) {
					$this->db->query( "INSERT INTO %ptopics (topic_title, topic_forum, topic_description, topic_starter, topic_icon, topic_posted, topic_edited, topic_last_poster, topic_modes, topic_type)
						VALUES ('%s', %d, '%s', %d, '%s', %d, %d, %d, %d, %d)",
						$this->post['title'], $f, $this->post['desc'], $this->user['user_id'],
						$this->post['icon'], $this->time, $this->time, $this->user['user_id'], $mode, TOPIC_TYPE_FORUM );
				} else {
					$mode |= TOPIC_POLL;
					$this->db->query( "INSERT INTO %ptopics (topic_title, topic_forum, topic_description, topic_starter, topic_icon, topic_posted, topic_edited, topic_last_poster, topic_modes, topic_type, topic_poll_options)
						VALUES('%s', %d, '%s', %d, '%s', %d, %d, %d, %d, %d, '%s')",
						$this->post['title'], $f, $this->post['desc'], $this->user['user_id'],
						$this->post['icon'], $this->time, $this->time, $this->user['user_id'], $mode, TOPIC_TYPE_FORUM, $this->post['options'] );
				}

				$t = $this->db->insert_id( 'topics', 'topic_id' );

				// Topic pin and lock were not being tracked here before. Oops.
				if( $mode & TOPIC_PINNED )
					$this->log_action( 'topic_pin', $t );
				if( $mode & TOPIC_LOCKED )
					$this->log_action( 'topic_lock', $t );
			}
			
			if( $this->perms->auth( 'post_inc_userposts', $f ) ) {
				$post_count = 1;
			} else {
				$post_count = 0;
			}

			if( $post_count ) {
				$newlevel = $this->get_level( $this->user['user_posts'] + 1 );
			} else {
				$newlevel = $this->get_level( $this->user['user_posts'] );
			}
			
			if( $this->user['user_title_custom'] ) {
				$membertitle = $this->user['user_title'];
			} else {
				$membertitle = $newlevel['user_title'];
			}

			$this->sets['posts']++;
			$this->write_sets();

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

					if( $spam_checked && $akismet != null && $akismet->is_this_spam() ) {
						$this->log_action( 'Possible Spam Posted', 0, 0, 0 );

						// Store the contents of the entire $_SERVER array.
						$svars = json_encode( $_SERVER );

						$this->db->query( "INSERT INTO %pspam (spam_topic, spam_author, spam_text, spam_time, spam_emojis, spam_bbcode, spam_count, spam_ip, spam_icon, spam_svars)
							VALUES (%d, %d, '%s', %d, %d, %d, %d, '%s', '%s', '%s', '%s', '%s')",
							$t, $this->user['user_id'], $this->post['post'], $this->time, $this->post['parseEmot'], $this->post['parseCode'], $post_count, $this->ip, $this->post['icon'], $svars );

						$this->sets['spam_post_count']++;
						$this->sets['spam_pending']++;
						$this->write_sets();

						return $this->message( $this->lang->post_posting, $this->lang->post_akismet_posts_spam );
					}
				}
			}

			$this->db->query( "INSERT INTO %pposts (post_topic, post_author, post_text, post_time, post_emojis, post_bbcode, post_count, post_ip, post_icon, post_referrer, post_agent)
				VALUES (%d, %d, '%s', %d, %d, %d, %d, '%s', '%s', '%s', '%s')",
				$t, $this->user['user_id'], $this->post['post'], $this->time, $this->post['parseEmot'], $this->post['parseCode'], $post_count, $this->ip, $this->post['icon'], $this->referrer, $this->agent );
			$post_id = $this->db->insert_id( 'posts', 'post_id' );

			$this->db->query( "UPDATE %ptopics SET topic_last_post=%d WHERE topic_id=%d", $post_id, $t );

			if( $post_count ) {
				$this->db->query( "UPDATE %pusers SET user_posts=user_posts+1, user_lastpost=%d, user_level='%s', user_title='%s' WHERE user_id=%d",
					$this->time, $newlevel['user_level'], $membertitle, $this->user['user_id'] );
			} else {
				$this->db->query( "UPDATE %pusers SET user_lastpost=%d WHERE user_id=%d", $this->time, $this->user['user_id'] );
			}

			if( $s == 'reply' ) {
				$mode = $topic['topic_modes'];

				$is_owner = $this->user['user_id'] == $topic['topic_starter'];

				if( isset( $this->post['locktopic'] ) && ( $this->perms->auth( 'topic_lock', $topic['forum_id'] ) || ( $is_owner && $this->perms->auth( 'topic_lock_own', $topic['forum_id'] ) ) ) ) {
					$mode |= TOPIC_LOCKED;
				}

				if( isset( $this->post['pintopic'] ) && ( $this->perms->auth( 'topic_pin', $topic['forum_id'] ) || ( $is_owner && $this->perms->auth( 'topic_pin_own', $topic['forum_id'] ) ) ) ) {
					$mode |= TOPIC_PINNED;
				}

				$this->db->query( "UPDATE %ptopics SET topic_replies=topic_replies+1, topic_modes=%d, topic_edited=%d, topic_last_poster=%d WHERE topic_id=%d",
					$mode, $this->time, $this->user['user_id'], $t );
				$field = 'forum_replies';
			} else {
				$field = 'forum_topics';
			}

			// Update all parent forums if any
			$forums = $this->db->fetch( "SELECT forum_tree FROM %pforums WHERE forum_id=%d", $f );

			$this->db->query( "UPDATE %pforums SET {$field}={$field}+1, forum_lastpost=%d
				WHERE forum_parent > 0 AND forum_id IN (%s) OR forum_id=%d",
				$post_id, $forums['forum_tree'], $f );
			
			if( isset( $this->post['attached_data'] ) && $this->perms->auth( 'post_attach', $f ) ) {
				$this->attachmentutil->insert( $post_id, $this->post['attached_data'], false );
			}

			$this->db->query( "DELETE FROM %psubscriptions WHERE subscription_expire < %d", $this->time );

			$subs = $this->db->query( "SELECT u.user_email FROM %psubscriptions s, %pusers u
				WHERE s.subscription_user = u.user_id AND u.user_id != %d AND
				  ((s.subscription_type = 'topic' AND s.subscription_item = %d) OR
				   (s.subscription_type = 'forum' AND s.subscription_item = %d))",
				$this->user['user_id'], $t, $f );

			if( $this->db->num_rows( $subs ) ) {
				$emailtopic = $this->db->fetch( "SELECT t.topic_title, f.forum_name
					FROM %ptopics t, %pforums f
					WHERE t.topic_id=%d AND t.topic_forum=f.forum_id", $t );

				$topic_link = $this->htmlwidgets->clean_url( $emailtopic['topic_title'] );

				$message  = "{$this->sets['forum_name']}\n";
				$message .= "{$this->site}/topic/{$topic_link}-{$t}/\n\n";
				$message .= "A new post has been made in a topic or forum you are subscribed to.\n\n";
				$message .= "Forum: {$emailtopic['forum_name']}\n";
				$message .= "Topic: " . $this->format( $emailtopic['topic_title'], FORMAT_CENSOR );

				$mailer = new mailer( $this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false );
				$mailer->setSubject( "{$this->sets['forum_name']} - Subscriptions" );
				$mailer->setMessage( $message );
				$mailer->setServer( $this->sets['mailserver'] );

				while( $sub = $this->db->nqfetch( $subs ) )
				{
					$mailer->setBcc( $sub['user_email'] );
				}

				$mailer->doSend();
			}

			if( isset( $this->post['request_uri'] ) ) {
				header( 'Location: ' . $this->post['request_uri'] );
			} else {
				$topic_link = null;
				if( $s == 'topic' || $s == 'poll' )
					$topic_link = $this->htmlwidgets->clean_url( $this->post['title'] );
				else
					$topic_link = $this->htmlwidgets->clean_url( $topic['topic_title'] );
				header( "Location: {$this->site}/topic/{$topic_link}-{$t}/&p={$post_id}#p{$post_id}" );
			}
		}
	}

	private function vote()
	{
		if( !isset( $this->get['t'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->post_voting, $this->lang->post_no_topic );
		}

		if( !isset( $this->post['pollvote'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->post_voting, $this->lang->post_no_vote );
		}

		$t = intval( $this->get['t'] );
		$pollvote = intval( $this->post['pollvote'] );

		$user_voted = $this->db->fetch( "SELECT vote_option FROM %pvotes WHERE vote_user=%d AND vote_topic=%d",	$this->user['user_id'], $t );
		$data = $this->db->fetch( "SELECT topic_title, topic_forum FROM %ptopics WHERE topic_id=%d", $t );

		if( !$user_voted && $this->perms->auth( 'poll_vote', $data['topic_forum'] ) ) {
			$this->db->query( "INSERT INTO %pvotes (vote_user, vote_topic, vote_option) VALUES (%d, %d, %d)", $this->user['user_id'], $t, $pollvote );

			$topic_link = $this->htmlwidgets->clean_url( $data['topic_title'] );
			header( "Location: {$this->site}/topic/{$topic_link}-{$t}" );
			return;
		}

		$this->set_title( $this->lang->post_voting );
		return $this->message( $this->lang->post_voting, $this->lang->post_cant_enter );
	}

	private function nullvote()
	{
		if( !isset( $this->get['t'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->post_voting, $this->lang->post_no_topic );
		}

		$t = intval( $this->get['t'] );
		$tname = $this->htmlwidgets->clean_url( $this->get['tname'] );

		if( !$this->sets['vote_after_results'] ) {
			$this->db->query( "INSERT INTO %pvotes (vote_user, vote_topic, vote_option) VALUES (%d, %d, -1)", $this->user['user_id'], $t );
		}

		header( "Location: {$this->site}/topic/{$tname}-{$t}/&results=1" );
	}
}
?>