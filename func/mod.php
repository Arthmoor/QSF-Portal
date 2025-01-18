<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2025 The QSF Portal Development Team
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

/**
 * Controls moderator actions
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class mod extends qsfglobal
{
	/**
	 * Choose a moderating action
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 4.0
	 * @return string HTML Output
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

		$this->set_title( $this->lang->mod_label_controls );

		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		switch( $this->get['s'] )
		{
		case 'del_topic':
			return $this->del_topic();
			break;

		case 'del_post':
			return $this->del_post();
			break;

		case 'lock':
			return $this->lock_topic();
			break;

		case 'pin':
			return $this->pin_topic();
			break;

		case 'edit_topic':
			return $this->edit_topic();
			break;

		case 'edit_post':
			return $this->edit_post();
			break;

		case 'move':
			return $this->move_topic();
			break;

		case 'split':
			return $this->split_topic();
			break;
			
		case 'publish':
			return $this->publish_topic();
			break;

		case 'viewips':
			return $this->view_ip_history();
			break;

		default:
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_no_action, $this->lang->continue, "javascript:history.go(-1)" );
			break;
		}
	}

	/**
	 * Moves a topic
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.0.0
	 * @return string message
	 **/
	private function move_topic()
	{
		$this->tree( $this->lang->mod_label_controls, $this->site . '/index.php?a=mod' );
		$this->tree( $this->lang->mod_label_topic_move );

		// Parameters check
		if( !isset( $this->get['t'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_no_topic, $this->lang->continue, "javascript:history.go(-1)" );
		}

		$t = intval( $this->get['t'] );

		$stmt = $this->db->prepare_query( 'SELECT topic_title, topic_forum, topic_starter, topic_modes, topic_poll_options FROM %ptopics WHERE topic_id=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $topic = $this->db->nqfetch( $result );
      $stmt->close();

		// Existence check
		if( !isset( $topic['topic_title'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_missing_topic, $this->lang->continue, "javascript:history.go(-1)" );
		}

		if( $topic['topic_modes'] & TOPIC_GLOBAL ) {
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_error_move_global, $this->lang->continue, "javascript:history.go(-1)" );
		}

		// Permissions check
		$is_owner = $this->user['user_id'] == $topic['topic_starter'];

		$topic_link = $this->htmlwidgets->clean_url( $topic['topic_title'] );

		if( !$this->perms->auth( 'topic_move', $topic['topic_forum'] ) && ( !$is_owner || ( $is_owner && !$this->perms->auth( 'topic_move_own', $topic['topic_forum'] ) ) ) ) {
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_perm_topic_move, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/" );
		}

		if( !isset( $this->post['submit'] ) ) {
			$forumlist = $this->htmlwidgets->select_forums( true, $topic['topic_forum'] );

			$xtpl = new XTemplate( './skins/' . $this->skin . '/mod.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 't', $t );
			$xtpl->assign( 'mod_label_topic_move', $this->lang->mod_label_topic_move );
			$xtpl->assign( 'mod_label_move_to', $this->lang->mod_label_move_to );
			$xtpl->assign( 'forumlist', $forumlist );
			$xtpl->assign( 'mod_label_options', $this->lang->mod_label_options );
			$xtpl->assign( 'mod_label_topic_move_complete', $this->lang->mod_label_topic_move_complete );
			$xtpl->assign( 'mod_label_topic_move_link', $this->lang->mod_label_topic_move_link );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'ModMoveTopic' );
			return $xtpl->text( 'ModMoveTopic' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->mod_label_controls, $this->lang->invalid_token );
			}

			$this->post['newforum'] = intval( $this->post['newforum'] );

			if( $this->post['newforum'] == $topic['topic_forum'] ) {
				return $this->message( $this->lang->mod_label_controls, $this->lang->mod_error_move_same, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/" );
			}

			if( !$this->perms->auth( 'topic_create', $this->post['newforum'] ) ) {
				return $this->message( $this->lang->mod_label_controls, $this->lang->mod_error_move_create, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/" );
			}

			$stmt = $this->db->prepare_query( 'SELECT forum_parent FROM %pforums WHERE forum_id=?' );

         $stmt->bind_param( 'i', $this->post['newforum'] );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $target = $this->db->nqfetch( $result );
         $stmt->close();

			if( !isset( $target['forum_parent'] ) ) {
				return $this->message( $this->lang->mod_label_controls, $this->lang->mod_error_move_forum, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/" );
			} elseif( !$target['forum_parent'] ) {
				return $this->message( $this->lang->mod_label_controls, $this->lang->mod_error_move_category, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/" );
			}

			if( $this->post['operation'] == 'lock' ) {
				$this->db->clone_row( 'topics', 'topic_id', $t );
				$newtopic = $this->db->insert_id( );

				$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_modes=?, topic_moved=? WHERE topic_id=? OR topic_moved=?' );

            $mode = intval( $topic['topic_modes'] | TOPIC_MOVED );
            $stmt->bind_param( 'iiii', $mode, $newtopic, $t, $t );
            $this->db->execute_query( $stmt );
            $stmt->close();
			} else {
				$newtopic = $t;
			}

			$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_forum=? WHERE topic_id=?' );

         $stmt->bind_param( 'ii', $this->post['newforum'], $newtopic );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$stmt = $this->db->prepare_query( 'UPDATE %pposts SET post_topic=? WHERE post_topic=?' );

         $stmt->bind_param( 'ii', $newtopic, $t );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$stmt = $this->db->prepare_query( 'UPDATE %pvotes SET vote_topic=? WHERE vote_topic=?' );

         $stmt->bind_param( 'ii', $newtopic, $t );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$this->update_subscriptions( $newtopic, $t );
			$this->htmlwidgets->update_last_post( $topic['topic_forum'] );
			$this->htmlwidgets->update_last_post( $this->post['newforum'] );

			$stmt = $this->db->prepare_query( 'SELECT topic_replies FROM %ptopics WHERE topic_id=?' );

         $stmt->bind_param( 'i', $newtopic );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $ammount = $this->db->nqfetch( $result );
         $stmt->close();

			$ammount = intval( $ammount['topic_replies'] );

			$this->htmlwidgets->update_count_move( $topic['topic_forum'], $this->post['newforum'], $ammount );

			$this->log_action( 'topic_move', $t, $topic['topic_forum'], $this->post['newforum'] );

			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_success_topic_move, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$newtopic}/", "{$this->site}/topic/{$topic_link}-{$newtopic}/" );
		}
	}

	/**
	 * Edits a post
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.0.0
	 * @return string message
	 **/
	private function edit_post()
	{
		$this->tree( $this->lang->mod_label_controls, $this->site . '/index.php?a=mod' );
		$this->tree( $this->lang->mod_label_post_edit );

		// Parameters check
		if( !isset( $this->get['p'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_no_post, $this->lang->continue, "javascript:history.go(-1)" );
		}

		$p = intval( $this->get['p'] );

		$stmt = $this->db->prepare_query( 'SELECT p.post_text, p.post_author, p.post_emojis, p.post_bbcode, p.post_topic, p.post_icon, p.post_time, t.topic_title, t.topic_forum, t.topic_replies,
				u.*, m.membertitle_icon, g.group_name
			FROM (%pposts p, %ptopics t)
			LEFT JOIN %pusers u ON u.user_id = p.post_author
			LEFT JOIN %pmembertitles m ON m.membertitle_id = u.user_level
			LEFT JOIN %pgroups g ON g.group_id = u.user_group
			WHERE t.topic_id=p.post_topic AND p.post_id=?' );

      $stmt->bind_param( 'i', $p );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $data = $this->db->nqfetch( $result );
      $stmt->close();

		// Existence check
		if( !isset( $data['post_text'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_missing_post,  $this->lang->continue, "javascript:history.go(-1)" );
		}

		// Permissions check
		$is_owner = $this->user['user_id'] == $data['post_author'];

		$topic_link = $this->htmlwidgets->clean_url( $data['topic_title'] );

		if( !$this->perms->auth( 'post_edit', $data['topic_forum'] ) && ( !$is_owner || ( $is_owner && !$this->perms->auth( 'post_edit_own', $data['topic_forum'] ) ) ) ) {
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_perm_post_edit, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$data['post_topic']}/" );
		}

		// Locked topic?
		$stmt = $this->db->prepare_query( 'SELECT topic_modes FROM %ptopics WHERE topic_id=?' );

      $stmt->bind_param( 'i', $data['post_topic'] );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $topic = $this->db->nqfetch( $result );
      $stmt->close();

		if( $topic['topic_modes'] & TOPIC_LOCKED ) {
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_edit_post_locked, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$data['post_topic']}/" );
		}

		// Too old?
		$hours = $this->sets['edit_post_age'];
		if( !$this->perms->auth( 'post_edit_old', $data['topic_forum'] ) && $hours > 0 && $this->time - ( $hours * 60 * 60) > $data['post_time'] ) {
			return $this->message( $this->lang->mod_label_controls, sprintf( $this->lang->mod_edit_post_old, $hours ), $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$data['post_topic']}/" );
		}

		if( !isset( $this->post['submit'] ) ) {
			$emot_check = $data['post_emojis'] ? ' checked' : null;
			$code_check = $data['post_bbcode'] ? ' checked' : null;
			$attached = null;
			$attached_data = null;
			$upload_error = null;
			$icon = $data['post_icon'] ? $data['post_icon'] : -1;

			$this->lang->post();
			
			if( isset( $this->post['post'] ) ) {
				$data['post_text'] = $this->post['post'];
			}
			
			// Handle attachment stuff
			if( !isset( $this->post['attached_data'] ) ) {
				$this->post['attached_data'] = $this->attachmentutil->build_attached_data( $p, false );
			}

			if( $this->perms->auth( 'post_attach', $data['topic_forum'] ) ) {
				// Attach
				if( isset( $this->post['attach'] ) ) {
					$upload_error = $this->attachmentutil->attach_now( $p, $this->files['attach_upload'], $this->post['attached_data'], false );
				// Detach
				} elseif( isset( $this->post['detach'] ) ) {
					$this->attachmentutil->delete_now( $p, $this->post['attached'], $this->post['attached_data'], false );
				}

				$this->attachmentutil->getdata( $attached, $attached_data, $this->post['attached_data'] );
			}

			$xtpl = new XTemplate( './skins/' . $this->skin . '/mod.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );

			/**
			 * Preview
			 */
			if( isset( $this->post['preview'] ) || isset( $this->post['attach'] ) || isset( $this->post['detach'] ) ) {
				$this->lang->topic();

				$params = FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_HTMLCHARS;

				if( isset( $this->post['code'] ) ) {
					$params |= FORMAT_BBCODE;
					$code_check = ' checked=\'checked\'';
				} else {
					$code_check = '';
				}

				if( isset( $this->post['emojis'] ) ) {
					$params |= FORMAT_EMOJIS;
					$emot_check = ' checked=\'checked\'';
				} else {
					$emot_check = '';
				}

				$quote = $this->format( $this->post['post'], FORMAT_HTMLCHARS );
				$preview_text = $this->format( $this->post['post'], $params );

				$xtpl->assign( 'preview_title', $this->lang->post_preview );

				$signature = null;
				if( $this->perms->is_guest ) {
					$xtpl->assign( 'topic_guest', $this->lang->topic_guest );
					$xtpl->assign( 'topic_unreg', $this->lang->topic_unreg );

					$xtpl->parse( 'ModEditPost.Preview.PosterGuest' );
				} else {
					$avatar = $this->htmlwidgets->display_avatar( $data );

					if( $data['user_signature'] ) {
						$signature = '.........................<br>' . $this->format( $data['user_signature'], FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_BBCODE | FORMAT_EMOJIS );
					}

					$joined = $this->mbdate( DATE_ONLY_LONG, $data['user_joined'] );

					$xtpl->assign( 'avatar', $avatar );
					$xtpl->assign( 'uid', $data['user_id'] );
					$xtpl->assign( 'uname', $data['user_name'] );
					$xtpl->assign( 'link_name', $this->htmlwidgets->clean_url( $data['user_name'] ) );
					$xtpl->assign( 'utitle', $data['user_title'] );
					$xtpl->assign( 'utitleicon', $data['membertitle_icon'] );
					$xtpl->assign( 'topic_level', $this->lang->topic_level );
					$xtpl->assign( 'topic_group', $this->lang->topic_group );
					$xtpl->assign( 'gname', $data['group_name'] );
					$xtpl->assign( 'topic_posts', $this->lang->topic_posts );
					$xtpl->assign( 'uposts', $data['user_posts'] );
					$xtpl->assign( 'topic_joined', $this->lang->topic_joined );
					$xtpl->assign( 'joined', $joined );

					$xtpl->parse( 'ModEditPost.Preview.PosterMember' );
				}

				if( $this->post['attached_data'] ) {
					$download_perm = $this->perms->auth( 'post_attach_download', $data['topic_forum'] );

					foreach( $this->post['attached_data'] as $md5 => $file )
					{
						if( $download_perm ) {
							$ext = strtolower( substr( $file, -4 ) );

							if( ( $ext == '.jpg' ) || ( $ext == '.gif' ) || ( $ext == '.png' ) ) {
								$preview_text .= "<br><br>{$this->lang->topic_attached} {$file}<br><img src='{$this->site}/attachments/$md5' alt='{$file}'>";
								continue;
							}
						}

						$preview_text .= "<br><br>{$this->lang->topic_attached} {$file}";
					}
				}

				$xtpl->assign( 'preview_text', $preview_text );
				$xtpl->assign( 'signature', $signature );

				$xtpl->parse( 'ModEditPost.Preview' );
			}

			$quote = $this->format( $data['post_text'], FORMAT_HTMLCHARS );

			$icon = isset( $this->post['icon'] ) ? $this->post['icon'] : $icon;
			$msg_icons = $this->htmlwidgets->get_icons( $icon );
			$msg_icons = "<li><input type=\"radio\" name=\"icon\" value=\"None\">{$this->lang->none}&nbsp;</li>" . $msg_icons;

			if( $this->perms->auth( 'post_attach', $data['topic_forum'] ) ) {
				if( $attached ) {
					$xtpl->assign( 'post_attach', $this->lang->post_attach );
					$xtpl->assign( 'attached', $attached );
					$xtpl->assign( 'post_attach_remove', $this->lang->post_attach_remove );
					$xtpl->assign( 'attached_data', $attached_data );

					$xtpl->parse( 'ModEditPost.AttachBox.Remove' );
				}

				$xtpl->assign( 'post_attach_add', $this->lang->post_attach_add );
				$xtpl->assign( 'post_attach_disrupt', $this->lang->post_attach_disrupt );
				$xtpl->assign( 'upload_error', $upload_error );

				$xtpl->parse( 'ModEditPost.AttachBox' );
			}

			$xtpl->assign( 'p', $p );
			$xtpl->assign( 'mod_label_post_edit', $this->lang->mod_label_post_edit );
			$xtpl->assign( 'topic_title', $data['topic_title'] );
			$xtpl->assign( 'post_icon', $this->lang->post_icon );
			$xtpl->assign( 'msg_icons', $msg_icons );
			$xtpl->assign( 'smilies', $this->bbcode->generate_emoji_links() );
			$xtpl->assign( 'bbcode_menu', $this->bbcode->get_bbcode_menu() );
			$xtpl->assign( 'quote', $quote );
			$xtpl->assign( 'mod_label_options', $this->lang->mod_label_options );
			$xtpl->assign( 'emot_check', $emot_check );
			$xtpl->assign( 'mod_label_emoji', $this->lang->mod_label_emoji );
			$xtpl->assign( 'code_check', $code_check );
			$xtpl->assign( 'mod_label_bbcode', $this->lang->mod_label_bbcode );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );
			$xtpl->assign( 'post_preview', $this->lang->post_preview );

			$xtpl->parse( 'ModEditPost' );
			return $xtpl->text( 'ModEditPost' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->mod_label_controls, $this->lang->invalid_token );
			}

			$emot = isset( $this->post['emojis'] ) ? 1 : 0;
			$code = isset( $this->post['code'] ) ? 1 : 0;

			$this->log_action( 'post_edit', $p );
			$icon = isset( $this->post['icon'] ) ? $this->post['icon'] : '';
			if( $icon == 'None' )
				$icon = '';

			$stmt = $this->db->prepare_query( 'UPDATE %pposts SET post_text=?, post_emojis=?, post_bbcode=?, post_edited_by=?, post_edited_time=?, post_icon=? WHERE post_id=?' );

         $stmt->bind_param( 'siisisi', $this->post['post'], $emot , $code, $this->user['user_name'], $this->time, $icon, $p );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$stmt = $this->db->prepare_query( 'SELECT p.post_id FROM %pposts p, %ptopics t
				WHERE p.post_topic=t.topic_id AND t.topic_id=?
				ORDER BY p.post_time LIMIT 1' );

         $stmt->bind_param( 'i', $data['post_topic'] );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $first = $this->db->nqfetch( $result );
         $stmt->close();

			if( $first['post_id'] == $p ) {
				$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_icon=? WHERE topic_id=?' );

            $stmt->bind_param( 'si', $icon, $data['post_topic'] );
            $this->db->execute_query( $stmt );
            $stmt->close();
			}

			$jump = '&amp;p=' . $p . '#p' . $p;

			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_success_post_edit, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$data['post_topic']}/$jump", "{$this->site}/topic/{$topic_link}-{$data['post_topic']}/$jump" );
		}
	}

	/**
	 * Edits a topic
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.0.0
	 * @return string message
	 **/
	function edit_topic()
	{
		$this->tree( $this->lang->mod_label_controls, $this->site . '/index.php?a=mod' );
		$this->tree( $this->lang->mod_label_topic_edit );

		// Parameters check
		if( !isset( $this->get['t'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_no_topic,  $this->lang->continue, "javascript:history.go(-1)" );
		}

		$t = intval( $this->get['t'] );
		$stmt = $this->db->prepare_query( 'SELECT topic_title, topic_description, topic_starter, topic_forum, topic_modes FROM %ptopics WHERE topic_id=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $topic = $this->db->nqfetch( $result );
      $stmt->close();

		// Existence check
		if( !isset( $topic['topic_title'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_missing_topic, $this->lang->continue, "javascript:history.go(-1)" );
		}

		// Permissions check
		$is_owner = $this->user['user_id'] == $topic['topic_starter'];

		if( !$this->perms->auth( 'topic_edit', $topic['topic_forum']) && ( !$is_owner || ( $is_owner && !$this->perms->auth( 'topic_edit_own', $topic['topic_forum'] ) ) ) ) {
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_perm_topic_edit );
		}

		if( !isset( $this->post['submit'] ) ) {
			$topic['topic_title'] = $this->format( $topic['topic_title'], FORMAT_HTMLCHARS );
			$topic['topic_description'] = $this->format( $topic['topic_description'], FORMAT_HTMLCHARS );

			$xtpl = new XTemplate( './skins/' . $this->skin . '/mod.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 't', $t );
			$xtpl->assign( 'mod_label_topic_edit', $this->lang->mod_label_topic_edit );
			$xtpl->assign( 'mod_label_title', $this->lang->mod_label_title );
			$xtpl->assign( 'topic_title', $topic['topic_title'] );
			$xtpl->assign( 'mod_label_description', $this->lang->mod_label_description );
			$xtpl->assign( 'topic_description', $topic['topic_description'] );

			if( $this->perms->auth( 'topic_global' ) ) {
				$checkGlob = null;

				if( $topic['topic_modes'] & TOPIC_GLOBAL ) {
					$checkGlob = ' checked="checked"';
				}

				$xtpl->assign( 'mod_label_global', $this->lang->mod_label_global );
				$xtpl->assign( 'checkGlob', $checkGlob );

				$xtpl->parse( 'ModEditTopic.Global' );
			}

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'ModEditTopic' );
			return $xtpl->text( 'ModEditTopic' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->mod_label_controls, $this->lang->invalid_token );
			}

			if( $this->perms->auth( 'topic_global' ) ) {
				if( isset( $this->post['global_topic'] ) && !( $topic['topic_modes'] & TOPIC_GLOBAL ) ) {
					$topic['topic_modes'] |= TOPIC_GLOBAL;
				} elseif( !isset( $this->post['global_topic'] ) && ( $topic['topic_modes'] & TOPIC_GLOBAL ) ) {
					$topic['topic_modes'] ^= TOPIC_GLOBAL;
				}
			}

			$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_title=?, topic_description=?, topic_modes=? WHERE topic_id=?' );

         $stmt->bind_param( 'ssii', $this->post['title'], $this->post['desc'], $topic['topic_modes'], $t );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$this->log_action( 'topic_edit', $t );

			$topic_link = $this->htmlwidgets->clean_url( $this->post['title'] );

			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_success_topic_edit, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/", "{$this->site}/topic/{$topic_link}-{$t}/" );
		}
	}

	/**
	 * Pins a topic
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.0.0
	 * @return string message
	 **/
	private function pin_topic()
	{
		$this->tree( $this->lang->mod_label_controls, $this->site . '/index.php?a=mod' );
		$this->tree( $this->lang->mod_label_topic_pin );

		// Parameters check
		if( !isset( $this->get['t'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_no_topic, $this->lang->continue, "javascript:history.go(-1)" );
		}

		$t = intval( $this->get['t'] );
		$stmt = $this->db->prepare_query( 'SELECT topic_title, topic_modes, topic_starter, topic_forum FROM %ptopics WHERE topic_id=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $topic = $this->db->nqfetch( $result );
      $stmt->close();

		// Existence check
		if( !$topic ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_missing_topic, $this->lang->continue, "javascript:history.go(-1)" );
		}

		// Permissions check
		$is_owner = $this->user['user_id'] == $topic['topic_starter'];

		$topic_link = $this->htmlwidgets->clean_url( $topic['topic_title'] );

		if( !($topic['topic_modes'] & TOPIC_PINNED ) ) {
			if( !$this->perms->auth( 'topic_pin', $topic['topic_forum'] ) && ( !$is_owner || ( $is_owner && !$this->perms->auth( 'topic_pin_own', $topic['topic_forum'] ) ) ) ) {
				return $this->message( $this->lang->mod_label_controls, $this->lang->mod_perm_topic_pin, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/" );
			} else {
				$this->log_action( 'topic_pin', $t );
				$this->pin( $t, $topic['topic_modes'] );
			}
		} else {
			if( !$this->perms->auth( 'topic_unpin', $topic['topic_forum'] ) && ( !$is_owner || ( $is_owner && !$this->perms->auth( 'topic_unpin_own', $topic['topic_forum'] ) ) ) ) {
				return $this->message( $this->lang->mod_label_controls, $this->lang->mod_perm_topic_unpin, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/" );
			} else {
				$this->log_action( 'topic_unpin', $t );
				$this->unpin( $t, $topic['topic_modes'] );
			}
		}

		header( "Location:  {$this->site}/topic/{$topic_link}-{$t}/" );
	}

	/**
	 * Locks a topic
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.0.0
	 * @return string message
	 **/
	private function lock_topic()
	{
		$this->tree( $this->lang->mod_label_controls, $this->site . '/index.php?a=mod' );
		$this->tree( $this->lang->mod_label_topic_lock );

		// Parameters check
		if( !isset( $this->get['t'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_no_topic, $this->lang->continue, "javascript:history.go(-1)" );
		}

		$t = intval( $this->get['t'] );
		$stmt = $this->db->prepare_query( 'SELECT topic_title, topic_modes, topic_starter, topic_forum FROM %ptopics WHERE topic_id=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $topic = $this->db->nqfetch( $result );
      $stmt->close();

		// Existence check
		if( !$topic ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_missing_topic, $this->lang->continue, "javascript:history.go(-1)" );
		}

		// Permissions check
		$is_owner = $this->user['user_id'] == $topic['topic_starter'];

		$topic_link = $this->htmlwidgets->clean_url( $topic['topic_title'] );

		if( !( $topic['topic_modes'] & TOPIC_LOCKED ) ) {
			if( !$this->perms->auth( 'topic_lock', $topic['topic_forum'] ) && ( !$is_owner || ( $is_owner && !$this->perms->auth( 'topic_lock_own', $topic['topic_forum'] ) ) ) ) {
				return $this->message( $this->lang->mod_label_controls, $this->lang->mod_perm_topic_lock, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/" );
			} else {
				$this->log_action( 'topic_lock', $t );
				$lock = $this->lock( $t, $topic['topic_modes'] );
			}
		} else {
			if( !$this->perms->auth( 'topic_unlock', $topic['topic_forum'] ) && ( !$is_owner || ( $is_owner && !$this->perms->auth( 'topic_unlock_own', $topic['topic_forum'] ) ) ) ) {
				return $this->message( $this->lang->mod_label_controls, $this->lang->mod_perm_topic_unlock, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/" );
			} else {
				$this->log_action( 'topic_unlock', $t );
				$lock = $this->unlock( $t, $topic['topic_modes'] );
			}
		}

		header( "Location:  {$this->site}/topic/{$topic_link}-{$t}/" );
	}

	/**
	 * Deletes a post
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.0.0
	 * @return string message
	 **/
	private function del_post()
	{
		$this->tree( $this->lang->mod_label_controls, $this->site . '/index.php?a=mod' );
		$this->tree( $this->lang->mod_label_post_delete );

		// Parameters check
		if( !isset( $this->get['p'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_no_post,  $this->lang->continue, "javascript:history.go(-1)" );
		}

		$spam = false;
		if( isset( $this->get['c'] ) )
			$spam = true;

		$p = intval( $this->get['p'] );

		$stmt = $this->db->prepare_query( 'SELECT p.post_id, p.post_author, p.post_topic, p.post_time, p.post_text, p.post_ip, p.post_referrer, p.post_agent,
			t.topic_id, t.topic_forum, t.topic_replies, t.topic_title
			FROM %pposts p,	%ptopics t
			WHERE p.post_id=? AND p.post_topic=t.topic_id' );

      $stmt->bind_param( 'i', $p );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $post = $this->db->nqfetch( $result );
      $stmt->close();

		// Existence check
		if( !isset( $post['post_id'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_missing_post, $this->lang->continue, "javascript:history.go(-1)" );
		}

		$stmt = $this->db->prepare_query( 'SELECT p.post_id FROM %pposts p, %ptopics t
			WHERE p.post_topic=t.topic_id AND t.topic_id=?
			ORDER BY p.post_time LIMIT 1' );

      $stmt->bind_param( 'i', $post['topic_id'] );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $first = $this->db->nqfetch( $result );
      $stmt->close();

		if( $first['post_id'] == $p && !$spam ) {
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_error_first_post );
		}

		// Permissions check
		$is_owner = $this->user['user_id'] == $post['post_author'];

		$topic_link = $this->htmlwidgets->clean_url( $post['topic_title'] );

		if( !$this->perms->auth( 'post_delete', $post['topic_forum'] ) && ( !$is_owner || ( $is_owner && !$this->perms->auth( 'post_delete_own', $post['topic_forum'] ) ) ) ) {
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_perm_post_delete, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$post['topic_id']}/" );
		}

		// Locked topic?
		$stmt = $this->db->prepare_query( 'SELECT topic_modes FROM %ptopics WHERE topic_id=?' );

      $stmt->bind_param( 'i', $post['post_topic'] );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $topic = $this->db->nqfetch( $result );
      $stmt->close();

		if( $topic['topic_modes'] & TOPIC_LOCKED ) {
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_delete_post_locked, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$post['post_topic']}/" );
		}

		// Too old?
		$hours = $this->sets['edit_post_age'];
		if( !$this->perms->auth( 'post_delete_old', $post['topic_forum'] ) && $hours > 0 && $this->time - ( $hours * 60 * 60 ) > $post['post_time'] ) {
			return $this->message( $this->lang->mod_label_controls, sprintf( $this->lang->mod_edit_post_old, $hours ), $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$post['post_topic']}/" );
		}

		// Confirmation check
		if( !isset( $this->get['confirm'] ) ) {
			if( !$spam )
				return $this->message( $this->lang->mod_label_controls, $this->lang->mod_confirm_post_delete, $this->lang->continue, "{$this->site}/index.php?a=mod&amp;s=del_post&amp;p=$p&amp;confirm=1" );
			else
				return $this->message( $this->lang->mod_label_controls, $this->lang->mod_confirm_post_delete_spam, $this->lang->continue, "{$this->site}/index.php?a=mod&amp;s=del_post&amp;p=$p}&amp;confirm=1&amp;c=spam" );
		}

		$stmt = $this->db->prepare_query( 'SELECT MAX(p.post_id) AS prev_post FROM %pposts p
			WHERE p.post_topic = ? AND p.post_time < ?' );

      $stmt->bind_param( 'ii', $post['post_topic'], $post['post_time'] );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $prev = $this->db->nqfetch( $result );
      $stmt->close();

		$jump = '&amp;p=' . $prev['prev_post'] . '#p' . $prev['prev_post'];

		if( $spam ) {
			// Time to report the spammer before we delete the post. Hopefully this is enough info to strike back with.
			$stmt = $this->db->prepare_query( 'SELECT user_name FROM %pusers WHERE user_id=?' );

         $stmt->bind_param( 'i', $post['post_author'] );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $user = $this->db->nqfetch( $result );
         $stmt->close();

			require_once $this->sets['include_path'] . '/lib/akismet.php';
			$akismet = new Akismet( $this );
			$akismet->set_comment_author( $user['user_name'] );
			$akismet->set_comment_content( $post['post_text'] );
			$akismet->set_comment_ip( $post['post_ip'] );
			$akismet->set_comment_referrer( $post['post_referrer'] );
			$akismet->set_comment_useragent( $post['post_agent'] );
			$akismet->set_comment_type( 'forum-post' );
			$akismet->set_comment_time( $post['post_time'] );

			$akismet->submit_spam();

			$this->sets['spam_post_count']++;
			$this->sets['spam_false_count']++;
			$this->write_sets();
		}

		$this->htmlwidgets->delete_post( $p );

		if( $spam ) {
			$this->log_action( 'spam_delete', $p );
		} else {
			$this->log_action( 'post_delete', $p );
		}

		return $this->message( $this->lang->mod_label_controls, $this->lang->mod_success_post_delete, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$post['topic_id']}/$jump", "{$this->site}/topic/{$topic_link}-{$post['topic_id']}/$jump" );
	}

	/**
	 * Deletes a single topic
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.0.0
	 * @return string message
	 **/
	private function del_topic()
	{
		$this->tree( $this->lang->mod_label_controls, $this->site . '/index.php?a=mod' );
		$this->tree( $this->lang->mod_label_topic_delete );

		// Parameters check
		if( !isset( $this->get['t'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_no_topic, $this->lang->continue, "javascript:history.go(-1)" );
		}

		$t = intval( $this->get['t'] );

		$stmt = $this->db->prepare_query( 'SELECT t.topic_id, t.topic_forum, t.topic_starter, t.topic_title, f.forum_name
			FROM %ptopics t
			LEFT JOIN %pforums f ON f.forum_id=t.topic_forum
			WHERE topic_id=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $topic = $this->db->nqfetch( $result );
      $stmt->close();

		// Existence check
		if( !isset( $topic['topic_id'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_missing_topic, $this->lang->continue, "javascript:history.go(-1)" );
		}

		// Permissions check
		$is_owner = $this->user['user_id'] == $topic['topic_starter'];

		$topic_link = $this->htmlwidgets->clean_url( $topic['topic_title'] );

		if( !$this->perms->auth( 'topic_delete', $topic['topic_forum'] ) && ( !$is_owner || ( $is_owner && !$this->perms->auth( 'topic_delete_own', $topic['topic_forum'] ) ) ) ) {
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_perm_topic_delete, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/" );
		}

		// Confirmation check
		if( !isset( $this->get['confirm'] ) ) {
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_confirm_topic_delete, $this->lang->continue, "{$this->site}/index.php?a=mod&amp;s=del_topic&amp;t={$t}&amp;confirm=1" );
		}

		$this->htmlwidgets->delete_topic( $t );

		$this->log_action( 'topic_delete', $t );

		$forum_link = $this->htmlwidgets->clean_url( $topic['forum_name'] );
		return $this->message( $this->lang->mod_label_controls, $this->lang->mod_success_topic_delete, $this->lang->continue, "{$this->site}/forum/{$forum_link}-{$topic['topic_forum']}/", "{$this->site}/forum/{$forum_link}-{$topic['topic_forum']}/" );
	}

	/**
	 * Publish / UnPublish
	 *
	 * @author Jonathan West <jon@quicksilverforums.com>
	 * @since 1.2.0
	 * @return string message
	 **/
	private function publish_topic()
	{
		$this->tree( $this->lang->mod_label_controls, $this->site . '/index.php?a=mod' );
		$this->tree( $this->lang->mod_label_publish );

		// Parameters check
		if( !isset( $this->get['t'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_no_topic,  $this->lang->continue, "javascript:history.go(-1)" );
		}

		$t = intval( $this->get['t'] );
		$stmt = $this->db->prepare_query( 'SELECT topic_title, topic_modes, topic_forum FROM %ptopics WHERE topic_id=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $topic = $this->db->nqfetch( $result );
      $stmt->close();

		// Existence check
		if( !$topic ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_missing_topic,  $this->lang->continue, "javascript:history.go(-1)" );
		}

		$topic_link = $this->htmlwidgets->clean_url( $topic['topic_title'] );

		// Check permissions
		if( !$this->perms->auth( 'topic_publish', $topic['topic_forum'] ) ) {
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_perm_publish, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/" );
		}

		if( !( $topic['topic_modes'] & TOPIC_PUBLISH ) ) {
			$this->log_action( 'topic_publish', $t );
			$this->publish( $t, $topic['topic_modes'] );
		} else {
			$this->log_action( 'topic_unpublish', $t );
			$this->unpublish( $t, $topic['topic_modes'] );
		}

		header( "Location: {$this->site}/topic/{$topic_link}-{$t}/" );
	}

	/**
	 * Splits a topic
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.1.0
	 * @return string message
	 **/
	private function split_topic()
	{
		$this->tree( $this->lang->mod_label_controls, $this->site . '/index.php?a=mod' );
		$this->tree( $this->lang->mod_label_topic_split );

		// Parameters check
		if( !isset( $this->get['t'] ) || !isset( $this->post['posttarget'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_no_topic, $this->lang->continue, "javascript:history.go(-1)" );
		}

		$t = intval( $this->get['t'] );
		$stmt = $this->db->prepare_query( 'SELECT topic_id, topic_forum, topic_starter, topic_title, topic_modes FROM %ptopics WHERE topic_id=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $topic = $this->db->nqfetch( $result );
      $stmt->close();

		// Existence check
		if( !isset( $topic['topic_id'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_missing_topic, $this->lang->continue, "javascript:history.go(-1)" );
		}

		// Permissions check
		$is_owner = $this->user['user_id'] == $topic['topic_starter'];

		$topic_link = $this->htmlwidgets->clean_url( $topic['topic_title'] );

		if( !$this->perms->auth( 'topic_split', $topic['topic_forum'] ) && ( !$is_owner || ( $is_owner && !$this->perms->auth( 'topic_split_own', $topic['topic_forum'] ) ) ) ) {
			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_perm_topic_split, $this->lang->continue, "{$this->site}/topic/{$topic_link}-{$t}/" );
		}

		if( !isset( $this->post['submitsplit'] ) ) {
			$posttarget = htmlspecialchars( json_encode( $this->post['posttarget'] ) );

			$display[1] = in_array( '1', $this->post['posttarget'] ) ? '' : 'display:none';
			$display[2] = in_array( '2', $this->post['posttarget'] ) ? '' : 'display:none';
			$display[3] = in_array( '3', $this->post['posttarget'] ) ? '' : 'display:none';
			$display[4] = in_array( '4', $this->post['posttarget'] ) ? '' : 'display:none';

			$topic['topic_title'] = $this->format( $topic['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS );

			$xtpl = new XTemplate( './skins/' . $this->skin . '/mod.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 't', $t );
			$xtpl->assign( 'posttarget', $posttarget );
			$xtpl->assign( 'mod_label_topic_split', $this->lang->mod_label_topic_split );
			$xtpl->assign( 'mod_label_title_original', $this->lang->mod_label_title_original );
			$xtpl->assign( 'topic_title', $topic['topic_title'] );
			$xtpl->assign( 'topic_description', $topic['topic_description'] );
			$xtpl->assign( 'mod_label_title_split', $this->lang->mod_label_title_split );
			$xtpl->assign( 'display1', $display[1] );
			$xtpl->assign( 'display2', $display[2] );
			$xtpl->assign( 'display3', $display[3] );
			$xtpl->assign( 'display4', $display[4] );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'ModSplitTopic' );
			return $xtpl->text( 'ModSplitTopic' );
		} else {
			$posttarget = json_decode( $this->post['posttarget'], true );
			$where = array();
			$moved = 0;

			foreach( $posttarget as $post => $target )
			{
				if( $target ) {
					if( !isset( $where[$target] ) ) {
						$where[$target] = array( 'count' => -1, 'posts' => array() );
					}

					$where[$target]['count']++;
					$where[$target]['posts'][] = $post;

					$moved++;
				}
			}

         $topic_update_query = $this->db->prepare_query( "UPDATE %ptopics SET topic_title=?, topic_replies=?, topic_views=0, topic_description='', topic_modes=? WHERE topic_id=?" );
         $topic_update_query->bind_param( 'siii', $topicx, $wherex, $mode, $id );

         $post_update_query = $this->db->prepare_query( 'UPDATE %pposts SET post_topic=? WHERE post_id IN (?)' );
         $post_update_query->bind_param( 'is', $id, $in );

         $id_query = $this->db->prepare_query( 'SELECT post_author, post_icon, post_time FROM %pposts WHERE post_topic=? ORDER BY post_time ASC' );
         $id_query->bind_param( 'i', $id );

         $topic_update_query = $this->db->prepare_query( 'UPDATE %ptopics SET topic_starter=?, topic_icon=? WHERE topic_id=?' );
         $topic_update_query->bind_param( 'isi', $author, $icon, $id );

			for( $x = 1; $x <= 4; $x++ )
			{
				if( isset( $where[$x] ) ) {
					$this->db->clone_row( 'topics', 'topic_id', $t );
					$id = $this->db->insert_id( );

					if( $topic['topic_modes'] & TOPIC_PUBLISH ) {
						$mode = TOPIC_PUBLISH;
					} else {
						$mode = 0;
					}

               $topicx = $this->post['topic'][$x];
               $wherex = $where[$x]['count'];
               $this->db->execute_query( $topic_update_query );

               $in = implode( ',', $where[$x]['posts'] );
               $this->db->execute_query( $post_update_query );

					$this->htmlwidgets->update_last_post_topic( $id );

               $this->db->execute_query( $id_query );
               $result = $id_query->get_result();
               $posts = $this->db->nqfetch( $result );

               $author = $posts['post_author'];
               $icon = $posts['post_icon'];
               $this->db->execute_query( $topic_update_query );
				}
			}
         $topic_update_query->close();
         $post_update_query->close();
         $id_query->close();
         $topic_update_query->close();

			$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_replies=topic_replies-? WHERE topic_id=?' );

         $stmt->bind_param( 'ii', $moved, $t );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$this->htmlwidgets->update_last_post_topic( $t );
			$this->htmlwidgets->update_last_post( $topic['topic_forum'] );
			$this->log_action( 'topic_split', $t );

			return $this->message( $this->lang->mod_label_controls, $this->lang->mod_success_split );
		}
	}

	/**
	 * Lists IPs used by a member when posting
	 *
	 * @author Roger Libiez
	 * @since 1.4.3
	 * @return evaluated HTML template
	 **/
	private function view_ip_history()
	{
		$t = intval( $this->get['t'] );
		$id = intval( $this->get['w'] );

      if( !$this->validator->validate( $t, TYPE_INT ) )
         return $this->message( $this->lang->mod_ip_view, $this->lang->mod_ip_view_not_allowed );

      if( !$this->validator->validate( $id, TYPE_INT ) )
         return $this->message( $this->lang->mod_ip_view, $this->lang->mod_ip_view_not_allowed );

		$stmt = $this->db->prepare_query( 'SELECT topic_forum FROM %ptopics WHERE topic_id=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $topic = $this->db->nqfetch( $result );
      $stmt->close();

      if( !$topic )
         return $this->message( $this->lang->mod_ip_view, $this->lang->mod_ip_view_not_allowed );

		if( !$this->perms->auth( 'post_viewip', $topic['topic_forum'] ) ) {
			return $this->message( $this->lang->mod_ip_view, $this->lang->mod_ip_view_not_allowed );
		}

		$user = $this->db->prepare_query( 'SELECT user_name FROM %pusers WHERE user_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $user = $this->db->nqfetch( $result );
      $stmt->close();

      if( !$user )
         return $this->message( $this->lang->mod_ip_view, $this->lang->mod_ip_view_no_user );

		$stmt = $this->db->prepare_query( 'SELECT post_ip FROM %pposts WHERE post_author=? GROUP BY post_ip' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );

      $iplist = $stmt->get_result();
      $stmt->close();

		$out = '';
		while( $ip = $this->db->nqfetch( $iplist ) )
		{
			$out .= "<br>" . $ip['post_ip'];
		}

		return $this->message( $this->lang->mod_ip_view, sprintf( $this->lang->mod_ip_view_posted, $user['user_name'] ) . $out );
	}

	/**
	 * Locks a topic
	 *
	 * @param int $t Topic ID
	 * @param int $topic_modes Topic modes
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return void
	 **/
	private function lock( $t, $topic_modes )
	{
		$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_modes=? WHERE topic_id=?' );

      $modes = $topic_modes | TOPIC_LOCKED;
      $stmt->bind_param( 'ii', $modes, $t );
      $this->db->execute_query( $stmt );
      $stmt->close();
	}

	/**
	 * Unlocks a topic
	 *
	 * @param int $t Topic ID
	 * @param int $topic_modes Topic modes
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return void
	 **/
	private function unlock( $t, $topic_modes )
	{
		$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_modes=? WHERE topic_id=?' );

      $modes = $topic_modes ^ TOPIC_LOCKED;
      $stmt->bind_param( 'ii', $modes, $t );
      $this->db->execute_query( $stmt );
      $stmt->close();
	}

	/**
	 * Pins a topic
	 *
	 * @param int $t Topic ID
	 * @param int $topic_modes Topic modes
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return void
	 **/
	private function pin( $t, $topic_modes )
	{
		$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_modes=? WHERE topic_id=?' );

      $modes = $topic_modes | TOPIC_PINNED;
      $stmt->bind_param( 'ii', $modes, $t );
      $this->db->execute_query( $stmt );
      $stmt->close();
	}

	/**
	 * Unpins a topic
	 *
	 * @param int $t Topic ID
	 * @param int $topic_modes Topic modes
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return void
	 **/
	private function unpin( $t, $topic_modes )
	{
		$stmt = $this->db->prepare_query( 'SELECT topic_forum FROM %ptopics WHERE topic_id=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $topic = $this->db->nqfetch( $result );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_modes=? WHERE topic_id=? OR topic_moved=?' );

      $modes = $topic_modes ^ TOPIC_PINNED;
      $stmt->bind_param( 'iii', $modes, $t, $t );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$this->htmlwidgets->update_last_post( $topic['topic_forum'] );
	}

	/**
	 * Publishes a topic
	 *
	 * @param int $t Topic ID
	 * @param int $topic_modes Topic modes
	 * @since 1.2
	 **/
	private function publish( $t, $topic_modes )
	{
		$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_modes=? WHERE topic_id=?' );

      $modes = $topic_modes | TOPIC_PUBLISH;
      $stmt->bind_param( 'ii', $modes, $t );
      $this->db->execute_query( $stmt );
      $stmt->close();
	}

	/**
	 * Unpublishes a topic
	 *
	 * @param int $t Topic ID
	 * @param int $topic_modes Topic modes
	 * @since 1.2
	 **/
	private function unpublish( $t, $topic_modes )
	{
		$stmt = $this->db->prepare_query( 'UPDATE %ptopics SET topic_modes=? WHERE topic_id=?' );

      $modes = $topic_modes ^ TOPIC_PUBLISH;
      $stmt->bind_param( 'ii', $modes, $t );
      $this->db->execute_query( $stmt );
      $stmt->close();
	}

	/**
	 * Checks Subscriptions to make sure subscribed members can
	 * still view the forum where the topic has been moved too
	 *
	 * @param $newtopic integer of the selected topic
	 * @author Jonathan West <jon@quicksilverforums.com>
	 * @since 1.3.2
	 **/
	private function update_subscriptions( $newtopic, $t )
	{
		$stmt = $this->db->prepare_query( 'SELECT s.subscription_user, s.subscription_item, s.subscription_type,
				u.user_id, u.user_group, u.user_perms, g.group_id, g.group_perms, t.topic_forum
				FROM (%psubscriptions s, %pusers u, %pgroups g, %ptopics t)
				WHERE s.subscription_user=u.user_id
				AND u.user_group=g.group_id
				AND t.topic_id=?' );

      $stmt->bind_param( 'i', $t );
      $this->db->execute_query( $stmt );

      $query = $stmt->get_result();
      $stmt->close();

      $delete_query = $this->db->prepare_query( 'DELETE FROM %psubscriptions WHERE subscription_user=? AND subscription_item=?' );
      $delete_query->bind_param( 'ii', $sub_user, $sub_item );

      $update_query = $this->db->prepare_query( "UPDATE %psubscriptions SET subscription_item=? WHERE subscription_item=? AND subscription_type='topic'" );
      $update_query->bind_param( 'ii', $newtopic, $t );

		while( $sub = $this->db->nqfetch( $query ) )
		{
			$perms = new permissions( $this );
			$perms->db = &$this->db;
			$perms->pre = &$this->pre;
			$perms->get_perms( $sub['user_group'], $sub['user_id'], ( $sub['user_perms'] ? $sub['user_perms'] : $sub['group_perms'] ) );

			if( !$perms->auth( 'forum_view', $sub['topic_forum'] ) ) {
            $sub_user = $sub['user_id'];
            $sub_item = $sub['subscription_item'];
            $this->db->execute_query( $delete_query );
			} else {
            $this->db->execute_query( $update_query );
			}
		}
      $delete_query->close();
      $update_query->close();
	}
}
?>