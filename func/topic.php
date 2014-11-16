<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005 The Quicksilver Forums Development Team
 *  http://www.quicksilverforums.com/
 * 
 * based off MercuryBoard
 * Copyright (c) 2001-2005 The Mercury Development Team
 *  http://www.mercuryboard.com/
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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
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
	function execute()
	{
		if (!isset($this->get['s'])) {
			$this->get['s'] = '';
		}

		switch($this->get['s']) {
		case 'attach':
			return $this->get_attachment();
			break;

		default:
			return $this->get_topic();
		}
	}

	function get_topic()
	{
		if (isset($this->get['num'])) {
			$this->get['num'] = intval($this->get['num']);
		} elseif ($this->user['user_posts_page'] != 0) {
			$this->get['num'] = $this->user['user_posts_page'];
		} else {
			$this->get['num'] = $this->sets['posts_per_page'];
		}
		$this->get['min'] = isset($this->get['min']) ? intval($this->get['min']) : 0;
		$this->get['t']   = isset($this->get['t'])   ? intval($this->get['t'])   : 0;
		if (isset($this->get['view'])) {
                        $this->validator->validate($this->get['view'], TYPE_STRING, array('newer', 'older'), false);
                } else {
                        $this->get['view']  = false;
                }
		if (isset($this->get['p'])) {
                        $this->validator->validate($this->get['p'], TYPE_UINT);
                } else {
                        $this->get['p']  = false;
                }
		if (isset($this->get['unread'])) {
                        $this->get['unread']  = true;
                } else {
                        $this->get['unread']  = false;
                }
		
		$topic = $this->db->fetch('
			SELECT
				t.topic_title, t.topic_description, t.topic_modes, t.topic_starter, t.topic_forum,
				t.topic_edited, t.topic_replies, t.topic_poll_options, f.forum_name
			FROM
				%ptopics t, %pforums f
			WHERE
				t.topic_id=%d AND
				f.forum_id=t.topic_forum',
			$this->get['t']);

		if (!$topic) {
			$this->set_title($this->lang->topic_not_found);
			return $this->message($this->lang->topic_error, $this->lang->topic_not_found_message);
		}
		
		if (!($topic['topic_modes'] & TOPIC_PUBLISH) && !$this->perms->auth('topic_view_unpublished', $topic['topic_forum'])) {
			return $this->message($this->lang->topic_error, $this->lang->topic_unpublished);
		}

		if (!$this->perms->auth('topic_view', $topic['topic_forum'])) {
			return $this->message(
				$this->lang->topic_error,
				($this->perms->is_guest) ? sprintf($this->lang->topic_perm_view_guest, $this->self) : $this->lang->topic_perm_view
			);
		}

		if ($this->get['view']) {
			if ($this->get['view'] == 'older') {
				$order = 'DESC';
				$where = "topic_edited < %d";
				
				if ($topic['topic_modes'] & TOPIC_PINNED) {
					$where .= ' OR ';
				} else {
					$where .= ' AND ';
				}
				$where .= "(topic_modes & " . TOPIC_PINNED . ") = 0";
			} else {
				$order = 'ASC';
				$where = "topic_edited > %d";
				if (!($topic['topic_modes'] & TOPIC_PINNED)) {
					$where .= ' OR ';
				} else {
					$where .= ' AND ';
				}
				$where .= "(topic_modes & " . TOPIC_PINNED . ") = " . TOPIC_PINNED;
            }
 
			$new_topic = $this->db->fetch("
					SELECT topic_id FROM %ptopics
					WHERE topic_forum=%d AND
						($where)
					ORDER BY (topic_modes & %d) $order,
						topic_edited $order
					LIMIT 1",
					$topic['topic_forum'], $topic['topic_edited'], TOPIC_PINNED);

			if ($new_topic) {
                                // Move to that topic
				header('Location: ' . $this->self . '?a=topic&t=' . $new_topic['topic_id']);
				return;
                        } else {
				if ($this->get['view'] == 'older') {
					return $this->message($this->lang->topic_not_found, $this->lang->topic_no_older);
				} else {
					return $this->message($this->lang->topic_not_found, $this->lang->topic_no_newer);
				}
			}
                }
		if ($this->get['unread']) {
			// Jump to the first unread post (or the last post)
			$timeread = $this->readmarker->topic_last_read($topic['topic_forum']);
			$posts = $this->db->fetch("SELECT COUNT(post_id) posts FROM %pposts WHERE post_topic = %d AND post_time < %d",
				$this->get['t'], $timeread);
			if ($posts) $postCount = $posts['posts'] + 1;
			else $postCount = 0;
			$this->get['min'] = 0; // Start at the first page regardless
			while ($postCount > ($this->get['min'] + $this->get['num'])) {
				$this->get['min'] += $this->get['num'];
			}
		}
		if ($this->get['p']) {
			// We need to find what page this post exists on!
			$posts = $this->db->fetch("SELECT COUNT(post_id) posts FROM %pposts WHERE post_topic = %d AND post_id < %d",
				$this->get['t'], $this->get['p']);
			if ($posts) $postCount = $posts['posts'] + 1;
			else $postCount = 0;
			$this->get['min'] = 0; // Start at the first page regardless
			while ($postCount > ($this->get['min'] + $this->get['num'])) {
				$this->get['min'] += $this->get['num'];
			}
		}

		$this->db->query('UPDATE %ptopics SET topic_views=topic_views+1 WHERE topic_id=%d', $this->get['t']);

		$topic['topic_title'] = $this->format($topic['topic_title'], FORMAT_CENSOR);
		$title_html = $this->format($topic['topic_title'], FORMAT_HTMLCHARS);

		// Add RSS feed link for forum and topic
		$this->lang->forum(); // needed for 'Forum' and 'Topic'
		$this->add_feed($this->sets['loc_of_board'] . $this->mainfile . '?a=rssfeed&amp;f=' . $topic['topic_forum'],
			"{$this->lang->forum_forum}: {$topic['forum_name']}");
		$this->add_feed($this->sets['loc_of_board'] . $this->mainfile . '?a=rssfeed&amp;t=' . $this->get['t'],
			"{$this->lang->forum_topic}: $title_html");

		if (strlen($topic['topic_title']) > 30) {
			$title_short = substr($topic['topic_title'], 0, 29) . '...';
		} else {
			$title_short = $topic['topic_title'];
		}
		$title_short = $this->format($title_short, FORMAT_HTMLCHARS);

		$this->set_title($this->lang->topic_viewing . ': ' . $title_html);

		$this->htmlwidgets->tree_forums($topic['topic_forum'], true);
		$this->tree($title_short);

		if (trim($topic['topic_description']) != '') {
			$topic['topic_description'] = ', ' . $this->format($topic['topic_description'], FORMAT_HTMLCHARS | FORMAT_CENSOR);
		} else {
			$topic['topic_description'] = null;
		}

		$user_started_topic = ($this->user['user_id'] == $topic['topic_starter']);
		$opts = array();

		if ($topic['topic_modes'] & TOPIC_LOCKED) {
			$replylink = '<img src="./skins/' . $this->skin . '/images/noreply.png" alt="' . $this->lang->topic_locked . '" />';

			if ($this->perms->auth('topic_unlock', $topic['topic_forum']) || ($this->perms->auth('topic_unlock_own', $topic['topic_forum']) && $user_started_topic)) {
				$opts[] = '<a href="' . $this->self . '?a=mod&amp;s=lock&amp;t=' . $this->get['t'] . '">' . $this->lang->topic_unlock . '</a>';
			}
		} else {
			$replylink = '<a href="' . $this->self . '?a=post&amp;s=reply&amp;t=' . $this->get['t'] . '"><img src="./skins/' . $this->skin . '/images/addreply.png" alt="' . $this->lang->topic_reply . '" /></a>';

			if ($this->perms->auth('topic_lock', $topic['topic_forum']) || ($this->perms->auth('topic_lock_own', $topic['topic_forum']) && $user_started_topic)) {
				$opts[] = '<a href="' . $this->self . '?a=mod&amp;s=lock&amp;t=' . $this->get['t'] . '">' . $this->lang->topic_lock . '</a>';
			}
		}

		if ($topic['topic_modes'] & TOPIC_PINNED) {
			if ($this->perms->auth('topic_unpin', $topic['topic_forum']) || ($this->perms->auth('topic_unpin_own', $topic['topic_forum']) && $user_started_topic)) {
				$opts[] = '<a href="' . $this->self . '?a=mod&amp;s=pin&amp;t=' . $this->get['t'] . '">' . $this->lang->topic_unpin . '</a>';
			}
		} else {
			if ($this->perms->auth('topic_pin', $topic['topic_forum']) || ($this->perms->auth('topic_pin_own', $topic['topic_forum']) && $user_started_topic)) {
				$opts[] = '<a href="' . $this->self . '?a=mod&amp;s=pin&amp;t=' . $this->get['t'] . '">' . $this->lang->topic_pin . '</a>';
			}
		}

		if ($this->perms->auth('topic_delete', $topic['topic_forum']) || ($this->perms->auth('topic_delete_own', $topic['topic_forum']) && $user_started_topic)) {
			$opts[] = '<a href="' . $this->self . '?a=mod&amp;s=del_topic&amp;t=' . $this->get['t'] . '">' . $this->lang->topic_delete . '</a>';
		}

		if ($this->perms->auth('topic_move', $topic['topic_forum']) || ($this->perms->auth('topic_move_own', $topic['topic_forum']) && $user_started_topic)) {
			$opts[] = '<a href="' . $this->self . '?a=mod&amp;s=move&amp;t=' . $this->get['t'] . '">' . $this->lang->topic_move . '</a>';
		}

		if ($this->perms->auth('topic_edit', $topic['topic_forum']) || ($this->perms->auth('topic_edit_own', $topic['topic_forum']) && $user_started_topic)) {
			$opts[] = '<a href="' . $this->self . '?a=mod&amp;s=edit_topic&amp;t=' . $this->get['t'] . '">' . $this->lang->topic_edit . '</a>';
		}

		if ($topic['topic_modes'] & TOPIC_PUBLISH) {
			if ($this->perms->auth('topic_publish', $topic['topic_forum'])) {
				$opts[] = '<a href="' . $this->self . '?a=mod&amp;s=publish&amp;t=' . $this->get['t'] . '">' . $this->lang->topic_unpublish . '</a>';
			}
		} else {
			if ($this->perms->auth('topic_publish', $topic['topic_forum'])) {
				$opts[] = '<a href="' . $this->self . '?a=mod&amp;s=publish&amp;t=' . $this->get['t'] . '">' . $this->lang->topic_publish . '</a>';
			}
		}
		$splitmode = false;

		if ($this->perms->auth('topic_split', $topic['topic_forum']) || ($this->perms->auth('topic_split_own', $topic['topic_forum']) && $user_started_topic)) {
			if ($this->get['s'] == 'split') {
				$this->templater->add_templates('mod');
				$splitmode = true;
				$this->get['min'] = 0;
				$this->get['num'] = $topic['topic_replies'] + 1;
			}

			$opts[] = '<a href="' . $this->self . '?a=topic&amp;s=split&amp;t=' . $this->get['t'] . '">' . $this->lang->topic_split . '</a>';
		}

		if (!$opts) {
			$mod_opts = '&nbsp;';
		} else {
			$mod_opts = $this->lang->topic_options . ': [ ' . implode(' | ', $opts) . ' ]';
		}

		if ($topic['topic_modes'] & TOPIC_POLL) {
			$this->templater->add_templates('poll');
			$PollDisplay = $this->get_poll($this->get['t'], $topic['topic_forum'], $title_html, $topic['topic_modes'], $topic['topic_poll_options']);
 		} else {
			$PollDisplay = null;
		}

		$posts = null;

		$query = $this->db->query("
			SELECT
			  a.attach_id, a.attach_name, a.attach_downloads, a.attach_size,
			  p.post_id
			FROM
			  %pposts p, %pattach a
			WHERE
			  p.post_topic = %d AND
			  a.attach_post = p.post_id",
			$this->get['t']);

		$attachments = array();

		while ($attach = $this->db->nqfetch($query))
		{
			if (!isset($attachments[$attach['post_id']])) {
				$attachments[$attach['post_id']] = array();
			}

			$attachments[$attach['post_id']][] = $attach;
		}

		$query = $this->db->query("
			SELECT
			  p.post_emoticons, p.post_mbcode, p.post_time, p.post_text, p.post_author, p.post_id, INET_NTOA(p.post_ip) as post_ip, p.post_icon, p.post_edited_by, p.post_edited_time,
			  m.user_joined, m.user_signature, m.user_posts, m.user_id, m.user_title, m.user_group, m.user_avatar, m.user_name, m.user_email, m.user_aim, m.user_gtalk,
			  m.user_icq, m.user_yahoo, m.user_homepage, m.user_avatar_type, m.user_avatar_width, m.user_avatar_height, m.user_msn, m.user_pm, m.user_email_show, m.user_email_form, m.user_active,
			  t.membertitle_icon,
			  g.group_name,
			  a.active_time
			FROM
			  (%pposts p, %pusers m, %pgroups g)
			LEFT JOIN %pactive a ON a.active_id=m.user_id
			LEFT JOIN %pmembertitles t ON t.membertitle_id=m.user_level
			WHERE
			  p.post_topic = %d AND
			  p.post_author = m.user_id AND
			  m.user_group = g.group_id
			GROUP BY p.post_id
			ORDER BY
			  p.post_time
			LIMIT %d, %d",
			$this->get['t'], $this->get['min'], $this->get['num']);

		$i = 0;
		$split = '';
		$oldtime = $this->time - 900;
		$newest_post_read = 0;
		$first_unread_post = false;

		while ($post = $this->db->nqfetch($query))
		{
			if ($i % 2 == 0) {
				$class = 'tablelight';
			} else {
				$class = 'tabledark';
			}

			$newest_post_read = $post['post_time'];
			$post['newpost'] = !$this->readmarker->is_post_read($this->get['t'], $post['post_time']);
			if ($first_unread_post === false && $post['newpost']) {
				$first_unread_post = true;
			} else if ($first_unread_post === true) {
				$first_unread_post = 0;
			}
			$post['post_time']   = $this->mbdate(DATE_LONG, $post['post_time']);
			$post['user_joined'] = $this->mbdate(DATE_ONLY_LONG, $post['user_joined']);

			$params = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR;

			if ($post['post_mbcode']) {
				$params |= FORMAT_MBCODE;
			}

			if ($post['post_emoticons']) {
				$params |= FORMAT_EMOTICONS;
			}

			$post['post_text'] = $this->format($post['post_text'], $params);

			if ($splitmode && $i) {
				$split = eval($this->template('MOD_SPLIT_SELECT'));
			}

			if (isset($this->get['hl'])) {
				$post['post_text'] = str_replace($this->get['hl'], "<span style='color:#FF0000; font-weight:bold'>{$this->get['hl']}</span>", $post['post_text']);
			}

			$Poster_Icons = null;

			if ($post['post_author'] != USER_GUEST_UID) {
				$online = ($post['active_time'] && ($post['active_time'] > $oldtime) && $post['user_active']);

				$icons = array(
					'user_email' => array(
						'link'   => '',
						'alt'    => '',
						'img'    => '',
						'target' => '_self',
					),
					'user_homepage' => array(
						'link'   => $post['user_homepage'],
						'alt'    => sprintf($this->lang->topic_links_web, $post['user_name']),
						'img'    => 'www.png',
						'target' => $this->sets['link_target']
					),
					'user_icq' => array(
						'link'   => 'http://wwp.icq.com/scripts/search.dll?to=' . $post['user_icq'],
						'alt'    => sprintf($this->lang->topic_links_icq, $post['user_name']),
						'img'    => 'icq.png',
						'target' => $this->sets['link_target']
					),
					'user_aim' => array(
						'link'   => 'aim:goim?screenname=' . $post['user_aim'],
						'alt'    => sprintf($this->lang->topic_links_aim, $post['user_name']),
						'img'    => 'aim.png',
						'target' => '_self'
					),
					'user_yahoo' => array(
						'link'   => 'http://edit.yahoo.com/config/send_webmesg?.target=' . $post['user_yahoo'] . '&amp;.src=pg',
						'alt'    => sprintf($this->lang->topic_links_yahoo, $post['user_name']),
						'img'    => 'yahoo.png',
						'target' => $this->sets['link_target']
					),
					'user_msn' => array(
						'link'   => 'http://members.msn.com/' . $post['user_msn'],
						'alt'    => sprintf($this->lang->topic_links_msn, $post['user_name']),
						'img'    => 'msn.png',
						'target' => $this->sets['link_target']
					),
					'user_gtalk' => array(
						'link'   => 'http://talk.google.com/',
						'alt'    => sprintf($this->lang->topic_links_gtalk, $post['user_name']),
						'img'    => 'gtalk.png',
						'target' => $this->sets['link_target']
					),
					'user_pm' => array(
						'link'   => $this->self . '?a=pm&amp;s=send&amp;to=' . $post['user_id'],
						'alt'    => sprintf($this->lang->topic_links_pm, $post['user_name']),
						'img'    => 'pm.png',
						'target' => '_self'
					)
				);

				if (!$post['user_email_show']) {
					if ($post['user_email_form']) {
						$icons['user_email'] = array(
							'link'   => "{$this->self}?a=email&amp;to={$post['user_id']}",
							'alt'    => sprintf($this->lang->topic_links_email, $post['user_name']),
							'img'    => 'email.png',
							'target' => '_self'
						);
					} else {
						unset($icons['user_email']);
					}
				} else {
					$icons['user_email'] = array(
						'link'   => 'mailto:' . $post['user_email'],
						'alt'    => sprintf($this->lang->topic_links_email, $post['user_name']),
						'img'    => 'email.png',
						'target' => '_self'
					);
				}

				$post['user_posts'] = number_format($post['user_posts'], 0, null, $this->lang->sep_thousands);
				$Poster_Icons = null;

				foreach ($icons as $iname => $icon)
				{
					if ($post[$iname]) {
						$Poster_Icons .= "<a href=\"{$icon['link']}\"" . ($icon['target'] ? " onclick=\"window.open(this.href,'{$icon['target']}');return false;\"" : '') . "><img src='./skins/$this->skin/images/{$icon['img']}' alt=\"{$icon['alt']}\" /></a> ";
					}
				}

				if (($post['user_avatar_type'] != 'none') && $this->user['user_view_avatars']) {
					if (substr($post['user_avatar'], -4) != '.swf') {
						$post['user_avatar'] = "<img src='{$post['user_avatar']}' alt='{$this->lang->topic_avatar}' width='{$post['user_avatar_width']}' height='{$post['user_avatar_height']}' /><br /><br />";
					} else {
						$post['user_avatar'] = "<object width='{$post['user_avatar_width']}' height='{$post['user_avatar_height']}' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'><param name='movie' value='{$post['user_avatar']}'><param name='play' value='true'><param name='loop' value='true'><param name='quality' value='high'><embed src='{$post['user_avatar']}' width='{$post['user_avatar_width']}' height='{$post['user_avatar_height']}' play='true' loop='true' quality='high'></embed></object><br /><br />";
					}
				} else {
					$post['user_avatar'] = null;
				}

				if ($post['user_signature'] && $this->user['user_view_signatures']) {
					$post['user_signature'] = '.........................<br />' . $this->format($post['user_signature'], FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_MBCODE | FORMAT_EMOTICONS);
				} else {
					$post['user_signature'] = null;
				}

				$Poster_Info = eval($this->template('TOPIC_POSTER_MEMBER'));

			} else {
				$post['user_email_form'] = null;
				$post['user_homepage'] = null;
				$post['user_icq'] = null;
				$post['user_aim'] = null;
				$post['user_yahoo'] = null;
				$post['user_msn'] = null;
				$post['user_gtalk'] = null;
				$post['user_pm'] = null;
				$Poster_Info = eval($this->template('TOPIC_POSTER_GUEST'));
				$post['user_signature'] = null;
				$icons = array();
			}

			if ($post['post_icon']) {
				$post['post_icon'] = "<img src='./skins/$this->skin/mbicons/{$post['post_icon']}' alt='*' style='margin-right:5px' />";
			}

			if (!$post['post_edited_by']) {
				$edited = null;
			} else {
				$post['post_edited_time'] = $this->mbdate(DATE_LONG, $post['post_edited_time']);
				$edited = sprintf($this->lang->topic_edited, $post['post_edited_time'], $post['post_edited_by']);
			}

			if ($this->perms->auth('post_viewip', $topic['topic_forum'])) {
				$post['post_ip'] = "{$this->lang->topic_ip}: {$post['post_ip']}";
			} else {
				$post['post_ip'] = null;
			}

			if (isset($attachments[$post['post_id']])) {
				$download_perm = $this->perms->auth('post_attach_download', $topic['topic_forum']);

				foreach ($attachments[$post['post_id']] as $file)
				{
					if ($download_perm) {
						$ext = strtolower(substr($file['attach_name'], -4));

						if (($ext == '.jpg') || ($ext == '.gif') || ($ext == '.png') || ($ext == '.bmp')) {
							$post['post_text'] .= "<br /><br />{$this->lang->topic_attached_image} {$file['attach_name']} ({$file['attach_downloads']} {$this->lang->topic_attached_downloads})<br /><img src='{$this->self}?a=topic&amp;s=attach&amp;id={$file['attach_id']}' alt='{$file['attach_name']}' />";
							continue;
						}
					}
					$filesize = ceil($file['attach_size'] / 1024);
					$post_attachment = eval($this->template('TOPIC_POST_ATTACHMENT'));
					$post['post_text'] .= $post_attachment;
				}
			}

			$user_created_post = ($this->user['user_id'] == $post['post_author']);
			$options = null;

			$can_edit = false; // Shortcut for skin
			if ($this->perms->auth('post_edit', $topic['topic_forum']) || ($user_created_post && $this->perms->auth('post_edit_own', $topic['topic_forum']))) {
				$can_edit = true;
				$options .= '<a href="' . $this->self . '?a=mod&amp;s=edit_post&amp;p=' . $post['post_id'] . '&amp;min=' . $this->get['min'] . '"><img alt="' . $this->lang->topic_edit_post . '" src="./skins/' . $this->skin . '/images/edit.png" /></a>';
			}

			$can_delete = false; // Shortcut for skin
			if ($this->perms->auth('post_delete', $topic['topic_forum']) || ($user_created_post && $this->perms->auth('post_delete_own', $topic['topic_forum']))) {
				$can_delete = true;
				$options .= ' <a href="' . $this->self . '?a=mod&amp;s=del_post&amp;p=' . $post['post_id'] . '"><img alt="' . $this->lang->topic_delete_post . '" src="./skins/' . $this->skin . '/images/delete.png" /></a>';
			}

			$posts .= eval($this->template('TOPIC_POST'));
			$i++;
		}

		$pagelinks = $this->htmlwidgets->get_pages($topic['topic_replies'] + 1, 'a=topic&amp;t=' . $this->get['t'], $this->get['min'], $this->get['num']);
		
		$this->readmarker->mark_topic_read($this->get['t'], $newest_post_read);

		// Quickreply
		$this->lang->post();
		$quickreply = eval($this->template('TOPIC_QUICKREPLY'));

		return eval($this->template('TOPIC_MAIN'));
	}

	function get_attachment()
	{
		if (!isset($this->get['id'])) {
			return $this->message($this->lang->topic_attached_title, $this->lang->topic_attached_perm);
		}

		$this->get['id'] = intval($this->get['id']);

		$data = $this->db->fetch("
			SELECT
			  a.attach_name, a.attach_file, t.topic_forum
			FROM
			  %pattach a, %pposts p, %ptopics t
			WHERE
			  a.attach_post = p.post_id AND
			  p.post_topic = t.topic_id AND
			  a.attach_id = %d", $this->get['id']);

		if ($this->perms->auth('post_attach_download', $data['topic_forum'])) {
			$this->nohtml = true;
			$this->db->query("UPDATE %pattach SET attach_downloads=attach_downloads+1 WHERE attach_id=%d", $this->get['id']);

			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"{$data['attach_name']}\"");
			readfile('./attachments/' . $data['attach_file']);
		} else {
			return $this->message($this->lang->topic_attached_title, $this->lang->topic_attached_perm);
		}
	}

	function get_poll($t, $f, $title_html, $topic_modes, $options)
	{
		$user_voted = $this->db->fetch('SELECT vote_option FROM %pvotes WHERE vote_user=%d AND vote_topic=%d', $this->user['user_id'], $t);

		if ($user_voted || !$this->perms->auth('poll_vote', $f) || ($topic_modes & TOPIC_LOCKED) || (isset($this->get['results']) && $this->sets['vote_after_results'])) {
			$votes = $this->db->query("SELECT vote_option FROM %pvotes WHERE vote_topic=%d AND vote_option != -1", $t);

			$results = array();
			$total_votes = 0;

			while ($vote = $this->db->nqfetch($votes))
			{
				if (isset($results[$vote['vote_option']])) {
					$results[$vote['vote_option']]++;
				} else {
					$results[$vote['vote_option']] = 1;
				}

				$total_votes++;
			}

			if (!$total_votes) {
				return $this->message($this->lang->topic_no_votes, $this->lang->topic_no_votes);
			}

			$out = null;

			$options = explode("\n", $options);
			foreach ($options as $i => $option)
			{
				if (trim($option) == '') {
					continue;
				}

				if (!isset($results[$i])) {
					$results[$i] = 0;
				}

				$option    = $this->format($option, FORMAT_MBCODE | FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_EMOTICONS);

				$percent = round($results[$i] / $total_votes * 100, 2);
				$width   = round($results[$i] / $total_votes * 100) * 2;

				if ($results[$i] != 1) {
					$votes = sprintf($this->lang->topic_vote_count_plur, $results[$i]);
				} else {
					$votes = sprintf($this->lang->topic_vote_count_sing, $results[$i]);
				}

				$out .= eval($this->template('POLL_RESULTS_ENTRY'));
			}

			return eval($this->template('POLL_RESULTS_MAIN'));
		} else {
			$pollopts = null;
			$options  = explode("\n", $options);

			foreach ($options as $i => $option)
			{
				if (trim($option) == '') {
					continue;
				}

				$option    = $this->format($option, FORMAT_MBCODE | FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_EMOTICONS);
				$pollopts .= eval($this->template('POLL_OPTION'));
			}

			return eval($this->template('POLL_MAIN'));
		}
	}
}
?>
