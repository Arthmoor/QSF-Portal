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
 * Creates topics, polls, and replies
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.1
 **/
class post extends qsfglobal
{
	function execute()
	{
		if (!isset($this->get['s'])) {
			$this->get['s'] = null;
		}

		switch($this->get['s'])
		{
		case 'vote':
			return $this->vote();
			break;

		case 'results':
			return $this->nullvote();
			break;

		default:
			return $this->makePost($this->get['s']);
			break;
		}
	}

	function makeReview($limit = 5)
	{
		$review = null;

		$query = $this->db->query("SELECT p.post_emoticons, p.post_mbcode, p.post_time, p.post_text, p.post_author, m.user_name
			FROM %pposts p, %pusers m
			WHERE p.post_topic=%d AND p.post_author = m.user_id
			ORDER BY p.post_time DESC
			LIMIT %d", $this->get['t'], $limit);

		while ($last = $this->db->nqfetch($query))
		{
			$params = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR;

			if ($last['post_mbcode']) {
				$params |= FORMAT_MBCODE;
			}

			if ($last['post_emoticons']) {
				$params |= FORMAT_EMOTICONS;
			}

			$last['post_text'] = $this->format($last['post_text'], $params);
			$last['post_time'] = $this->mbdate(DATE_LONG, $last['post_time']);

			if ($last['post_author'] != USER_GUEST_UID) {
				$last['user_name'] = '<a href="' . $this->self . '?a=profile&amp;w=' . $last['post_author'] . '">' . $last['user_name'] . '</a>';
			} else {
				$last['user_name'] = $this->lang->post_guest;
			}

			$review .= eval($this->template('POST_REVIEW_ENTRY'));
		}

		return $review;
	}

	function makePost($s)
	{
		/**
		 * Determine if the user has permission to make a post here and
		 * execute tasks common to both before and after the form submit.
		 */
		switch($s)
		{
		case 'reply':
			if (!isset($this->get['t'])) {
				return $this->message($this->lang->post_replying, $this->lang->post_cant_reply);
			}

			$this->get['t'] = intval($this->get['t']);

			$topic = $this->db->fetch("SELECT t.topic_modes, t.topic_title, f.forum_name, f.forum_id, t.topic_replies
				FROM %ptopics t, %pforums f
				WHERE t.topic_id=%d AND f.forum_id=t.topic_forum", $this->get['t']);

			if ($topic && !$this->perms->auth('post_create', $topic['forum_id'])) {
				if ($this->perms->is_guest) {
					return $this->message($this->lang->post_replying, sprintf($this->lang->post_cant_reply1, $this->self));
				} else {
					return $this->message($this->lang->post_replying, $this->lang->post_cant_reply2);
				}
			}

			if (!$topic) {
				return $this->message($this->lang->post_replying, $this->lang->post_cant_reply);
			}

			if ($topic['topic_modes'] & TOPIC_LOCKED) {
				return $this->message($this->lang->post_replying, $this->lang->post_closed);
			}

			if (strlen($topic['topic_title']) > 30) {
				$shortened_title = substr($topic['topic_title'], 0, 29);
			} else {
				$shortened_title = $topic['topic_title'];
			}

			$shortened_title = $this->format($topic['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS);

			$this->get['f'] = $topic['forum_id'];

			$this->htmlwidgets->tree_forums($topic['forum_id'], true);
			$this->tree($shortened_title, $this->self . '?a=topic&amp;t=' . $this->get['t'] . '&amp;f=' . $topic['forum_id']);
			$this->tree($this->lang->post_replying1);
			break;

		case 'poll':
			if (!isset($this->get['f'])) {
				return $this->message($this->lang->post_creating, $this->lang->post_no_forum);
			}

			$this->get['f'] = intval($this->get['f']);

			if (!$this->perms->auth('poll_create', $this->get['f'])) {
				if ($this->perms->is_guest) {
					return $this->message($this->lang->post_creating_poll, sprintf($this->lang->post_cant_poll, $this->self));
				} else {
					return $this->message($this->lang->post_creating_poll, $this->lang->post_cant_poll1);
				}
			}

			if (!$this->db->num_rows($this->db->query("SELECT forum_id FROM %pforums WHERE forum_id=%d", $this->get['f']))) {
				return $this->message($this->lang->post_creating, $this->lang->post_no_forum);
			}

			$this->htmlwidgets->tree_forums($this->get['f'], true);
			$this->tree($this->lang->post_creating_poll);
			break;

		default: //topic
			if (!isset($this->get['f'])) {
				return $this->message($this->lang->post_creating, $this->lang->post_no_forum);
			}

			$this->get['f'] = intval($this->get['f']);

			if (!$this->perms->auth('topic_create', $this->get['f'])) {
				if ($this->perms->is_guest) {
					return $this->message($this->lang->post_creating, sprintf($this->lang->post_cant_create, $this->self));
				} else {
					return $this->message($this->lang->post_creating, $this->lang->post_cant_create1);
				}
			}

			if (!$this->db->num_rows($this->db->query("SELECT forum_id FROM %pforums WHERE forum_id=%d", $this->get['f']))) {
				return $this->message($this->lang->post_creating, $this->lang->post_no_forum);
			}

			$this->htmlwidgets->tree_forums($this->get['f'], true);
			$this->tree($this->lang->post_creating);
		}

		/**
		 * Show the form
		 */
		if (!isset($this->post['submit'])) {
			$attached = null;
			$attached_data = null;
			$upload_error = null;
			$icon = -1;
			$preview = '';
			$quote = '';

			$checkEmot = ' checked=\'checked\'';
			$checkCode = ' checked=\'checked\'';
			$checkGlob = '';

			$title   = isset($this->post['title']) ? $this->format($this->post['title'], FORMAT_HTMLCHARS) : '';
			$desc    = isset($this->post['desc']) ? $this->format($this->post['desc'], FORMAT_HTMLCHARS) : '';
			$options = isset($this->post['options']) ? $this->format($this->post['options'], FORMAT_HTMLCHARS) : '';

			if (!isset($this->post['attached_data'])) {
				$this->post['attached_data'] = array();
			}

			if ($this->perms->auth('post_attach', $this->get['f'])) {
				// Attach
				if (isset($this->post['attach'])) {
					$upload_error = $this->attachmentutil->attach($this->files['attach_upload'], $this->post['attached_data']);
				// Detach
				} elseif (isset($this->post['detach'])) {
					$this->attachmentutil->delete($this->post['attached'], $this->post['attached_data']);
				}

				$this->attachmentutil->getdata($attached, $attached_data, $this->post['attached_data']);
			}

			/**
			 * Preview
			 */
			if (isset($this->post['preview']) || isset($this->post['attach']) || isset($this->post['detach'])) {
				$quote = $this->format($this->post['post'], FORMAT_HTMLCHARS);

				if (($s == 'topic') || ($s == 'poll')) {
					$title = $this->format($this->post['title'], FORMAT_HTMLCHARS);
					$desc  = $this->format($this->post['desc'], FORMAT_HTMLCHARS);

					if ($s == 'poll') {
						$options = $this->format($this->post['options'], FORMAT_HTMLCHARS);
 					}
				}

				$params = FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_HTMLCHARS;

				if (isset($this->post['parseCode']) && $this->bbcode->quote_check($this->post['post'])) {
					$params |= FORMAT_MBCODE;
					$checkCode = ' checked=\'checked\'';
				} else {
					$checkCode = '';
				}

				if (isset($this->post['parseEmot'])) {
					$params |= FORMAT_EMOTICONS;
					$checkEmot = ' checked=\'checked\'';
				} else {
					$checkEmot = '';
				}

				if (isset($this->post['global_topic'])) {
					$checkGlob = ' checked=\'checked\'';
				} else {
					$checkGlob = '';
				}

				$preview_text = $this->post['post'];
				$quote = $this->format($preview_text, FORMAT_HTMLCHARS);
				$preview_text = $this->format($preview_text, $params);

				if ($title != '') {
					$preview_title = $title;
					$preview_title = $desc != '' ? $preview_title . ', ' . $desc : $preview_title;
				} else {
					$preview_title = $this->lang->post_preview;
				}

				$this->lang->topic();

				if ($this->perms->is_guest) {
					$signature = '';
					$Poster_Info = eval($this->template('POST_POSTER_GUEST'));
				} else {
					if (($this->user['user_avatar_type'] != 'none') && $this->user['user_view_avatars']) {
						if (substr($this->user['user_avatar'], -4) != '.swf') {
							$avatar = "<img src=\"{$this->user['user_avatar']}\" alt=\"Avatar\" width=\"{$this->user['user_avatar_width']}\" height=\"{$this->user['user_avatar_height']}\" /><br /><br />";
						} else {
							$avatar = "<object width=\"{$this->user['user_avatar_width']}\" height=\"{$this->user['user_avatar_height']}\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"><param name=\"movie\" value=\"{$this->user['user_avatar']}\"><param name=\"play\" value=\"true\"><param name=\"loop\" value=\"true\"><param name=\"quality\" value=\"high\"><embed src=\"{$this->user['user_avatar']}\" width=\"{$this->user['user_avatar_width']}\" height=\"{$this->user['user_avatar_height']}\" play=\"true\" loop=\"true\" quality=\"high\"></embed></object><br /><br />";
						}
					} else {
						$avatar = null;
					}

					if ($this->user['user_signature'] && $this->user['user_view_signatures']) {
						$signature = '.........................<br />' . $this->format($this->user['user_signature'], FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_MBCODE | FORMAT_EMOTICONS);
					} else {
						$signature = null;
					}

					$joined = $this->mbdate(DATE_ONLY_LONG, $this->user['user_joined']);

					$Poster_Info = eval($this->template('POST_POSTER_MEMBER'));
				}

				if ($this->post['attached_data']) {
					$this->lang->topic();

					$download_perm = $this->perms->auth('post_attach_download', $this->get['f']);

					foreach ($this->post['attached_data'] as $md5 => $file)
					{
						if ($download_perm) {
							$ext = strtolower(substr($file, -4));

							if (($ext == '.jpg') || ($ext == '.gif') || ($ext == '.png')) {
								$preview_text .= "<br /><br />{$this->lang->topic_attached} {$file}<br /><img src='./attachments/$md5' alt='{$file}' />";
								continue;
							}
						}

						$preview_text .= "<br /><br />{$this->lang->topic_attached} {$file}";
					}
				}

				$preview = eval($this->template('POST_PREVIEW'));
			}

			if ($s == 'reply') {
				if (isset($this->get['qu'])) {
					$this->get['qu'] = intval($this->get['qu']);
					$query = $this->db->fetch("SELECT p.post_text, m.user_name FROM %pposts p, %pusers m
						WHERE p.post_id=%d AND p.post_author=m.user_id AND p.post_topic=%d",
						$this->get['qu'], $this->get['t']);

					if ($query['post_text'] != '') {
						$quote = '[quote=' . $query['user_name'] . ']' . $this->format($query['post_text'], FORMAT_CENSOR | FORMAT_HTMLCHARS) . '[/quote]';
					}
				}
			} else {
				if ($this->perms->auth('topic_global')) {
					$universal_topic = eval($this->template('POST_GLOBAL'));
				} else {
					$universal_topic = '';
				}
			}

			$icon = isset($this->post['icon']) ? $this->post['icon'] : -1;

			$msg_icons = $this->htmlwidgets->get_icons($icon);
			$posticons = eval($this->template('POST_MESSAGE_ICONS'));
			$smilies   = eval($this->template('POST_CLICKABLE_SMILIES'));

			if ($this->perms->auth('post_attach', $this->get['f'])) {
				if ($attached) {
					$remove_box = eval($this->template('POST_ATTACH_REMOVE'));
				} else {
					$remove_box = '';
				}

				$attach_box = eval($this->template('POST_ATTACH'));
			} else {
				$attach_box = null;
			}

			switch($s)
			{
			case 'reply':
				$temp_name = 'POST_REPLY';
				$review    = $this->makeReview(5);
				break;

			case 'poll':
				$temp_name = 'POST_POLL';
				break;

			default:
				$temp_name = 'POST_TOPIC';
			}

			$post_box = eval($this->template($this->post_box()));
			return eval($this->template($temp_name));

		/**
		 * Final submission of form, after all attachments and previews
		 */
		} else {
			if (!$this->perms->auth('post_noflood', $this->get['f']) && ($this->user['user_lastpost'] > ($this->time - $this->sets['flood_time']))) {
				return $this->message($this->lang->post_replying, sprintf($this->lang->post_flood, $this->sets['flood_time']));
			}

			if (trim($this->post['post']) == '') {
				return $this->message($this->lang->post_posting, $this->lang->post_must_msg);
			}

			if (!isset($this->post['icon']))      $this->post['icon'] = '';
			if (!isset($this->post['parseCode'])) $this->post['parseCode'] = 0;
			if (!isset($this->post['parseEmot'])) $this->post['parseEmot'] = 0;

			if ($this->post['parseCode'] && !$this->bbcode->quote_check($this->post['post'])) {
				$this->post['parseCode'] = 0;
			}

			if (($s == 'topic') || ($s == 'poll')) {
				$mode = 0;

				if ($this->perms->auth('topic_global') && isset($this->post['global_topic'])) {
					$mode |= TOPIC_GLOBAL;
				}

				if ($this->perms->auth('topic_publish_auto', $this->get['f'])) {
					$mode |= TOPIC_PUBLISH;
				}

				if (trim($this->post['title']) == '') {
					return $this->message($this->lang->post_posting, $this->lang->post_must_title);
				}

				if ($s == 'poll') {
					if (trim($this->post['options']) == '') {
						return $this->message($this->lang->post_posting, $this->lang->post_must_options);
					}

					$max_options  = 15;
					$option_count = substr_count($this->post['options'], "\n") + 1;

					if (($option_count > $max_options) || ($option_count < 2)) {
						return $this->message($this->lang->post_posting, sprintf($this->lang->post_too_many_options, $max_options));
					}
				}

				$this->sets['topics']++;

				if ($s != 'poll') {
					$this->db->query("INSERT INTO %ptopics (topic_title, topic_forum, topic_description, topic_starter, topic_icon, topic_edited, topic_last_poster, topic_modes)
						VALUES ('%s', %d, '%s', %d, '%s', %d, %d, %d)",
						$this->post['title'], $this->get['f'], $this->post['desc'], $this->user['user_id'],
						$this->post['icon'], $this->time, $this->user['user_id'], $mode);
				} else {
					$mode |= TOPIC_POLL;
					$this->db->query("INSERT INTO %ptopics (topic_title, topic_forum, topic_description, topic_starter, topic_icon, topic_edited, topic_last_poster, topic_modes, topic_poll_options) VALUES
						('%s', %d, '%s', %d, '%s', %d, %d, %d, '%s')",
						$this->post['title'], $this->get['f'], $this->post['desc'], $this->user['user_id'],
						$this->post['icon'], $this->time, $this->user['user_id'], $mode, $this->post['options']);
				}

				$this->get['t'] = $this->db->insert_id("topics");
			}
			
			if ($this->perms->auth('post_inc_userposts', $this->get['f'])) {
				$post_count = 1;
			} else {
				$post_count = 0;
			}

			if ($post_count) {
				$newlevel = $this->get_level($this->user['user_posts'] + 1);
			} else {
				$newlevel = $this->get_level($this->user['user_posts']);
			}
			
			if ($this->user['user_title_custom']) {
				$membertitle = $this->user['user_title'];
			} else {
				$membertitle = $newlevel['user_title'];
			}

			$this->sets['posts']++;
			$this->write_sets();

			/* HTML formatting not implemented at this time
			
			if (isset($this->post['rich'])) {
				$this->post['post'] = $this->format_html_mbcode($this->post['post']);
			}
			*/

			$this->db->query("INSERT INTO %pposts (post_topic, post_author, post_text, post_time, post_emoticons, post_mbcode, post_count, post_ip, post_icon)
				VALUES (%d, %d, '%s', %d, %d, %d, %d, INET_ATON('%s'), '%s')",
				$this->get['t'], $this->user['user_id'], $this->post['post'], $this->time, $this->post['parseEmot'], $this->post['parseCode'], $post_count, $this->ip, $this->post['icon']);
			$post_id = $this->db->insert_id("posts");

			$this->db->query("UPDATE %ptopics SET topic_last_post=%d WHERE topic_id=%d", $post_id, $this->get['t']);

			if ($post_count) {
				$this->db->query("UPDATE %pusers SET user_posts=user_posts+1, user_lastpost=%d, user_level='%s', user_title='%s' WHERE user_id=%d",
					$this->time, $newlevel['user_level'], $membertitle, $this->user['user_id']);
			} else {
				$this->db->query("UPDATE %pusers SET user_lastpost=%d WHERE user_id=%d",
					$this->time, $this->user['user_id']);
			}

			if ($s == 'reply') {
				$this->db->query("UPDATE %ptopics SET topic_replies=topic_replies+1, topic_edited=%d, topic_last_poster=%d WHERE topic_id=%d",
					$this->time, $this->user['user_id'], $this->get['t']);
				$field = 'forum_replies';
			} else {
				$field = 'forum_topics';
			}

			// Update all parent forums if any
			$forums = $this->db->fetch("SELECT forum_tree FROM %pforums WHERE forum_id=%d", $this->get['f']);
			$this->db->query("UPDATE %pforums SET {$field}={$field}+1, forum_lastpost=%d
				WHERE forum_parent > 0 AND forum_id IN (%s) OR forum_id=%d",
				$post_id, $forums['forum_tree'], $this->get['f']);
			
			if (isset($this->post['attached_data']) && $this->perms->auth('post_attach', $this->get['f'])) {
				$this->attachmentutil->insert($post_id, $this->post['attached_data']);
			}

			$this->db->query("DELETE FROM %psubscriptions WHERE subscription_expire < %d", $this->time);
			$subs = $this->db->query("SELECT u.user_email
				FROM %psubscriptions s, %pusers u
				WHERE
				  s.subscription_user = u.user_id AND
				  u.user_id != %d AND
				  ((s.subscription_type = 'topic' AND s.subscription_item = %d) OR
				   (s.subscription_type = 'forum' AND s.subscription_item = %d))",
				$this->user['user_id'], $this->get['t'], $this->get['f']);

			if ($this->db->num_rows($subs)) {
				$emailtopic = $this->db->fetch("SELECT t.topic_title, f.forum_name
					FROM %ptopics t, %pforums f
					WHERE t.topic_id=%d AND t.topic_forum=f.forum_id", $this->get['t']);

				$message  = "{$this->sets['forum_name']}\n";
				$message .= "{$this->sets['loc_of_board']}{$this->mainfile}?a=topic&t={$this->get['t']}\n\n";
				$message .= "A new post has been made in a topic or forum you are subscribed to.\n\n";
				$message .= "Forum: {$emailtopic['forum_name']}\n";
				$message .= "Topic: " . $this->format($emailtopic['topic_title'], FORMAT_CENSOR);

				$mailer = new $this->modules['mailer']($this->sets['admin_incoming'], $this->sets['admin_outgoing'], $this->sets['forum_name'], false);
				$mailer->setSubject("{$this->sets['forum_name']} - Subscriptions");
				$mailer->setMessage($message);
				$mailer->setServer($this->sets['mailserver']);

				while ($sub = $this->db->nqfetch($subs))
				{
					$mailer->setBcc($sub['user_email']);
				}

				$mailer->doSend();
			}

			header('Location: ' . $this->self . '?a=topic&t=' . $this->get['t'] . '&p=' . $post_id . '#p' . $post_id);
		}
	}

	function vote()
	{
		if (!isset($this->get['t'])) {
			return $this->message($this->lang->post_voting, $this->lang->post_no_topic);
		}

		if (!isset($this->post['pollvote'])) {
			return $this->message($this->lang->post_voting, $this->lang->post_no_vote);
		}

		$this->get['t'] = intval($this->get['t']);
		$this->post['pollvote'] = intval($this->post['pollvote']);

		$user_voted = $this->db->fetch("SELECT vote_option FROM %pvotes WHERE vote_user=%d AND vote_topic=%d",
			$this->user['user_id'], $this->get['t']);
		$data = $this->db->fetch("SELECT topic_forum FROM %ptopics WHERE topic_id=%d", $this->get['t']);

		if (!$user_voted && $this->perms->auth('poll_vote', $data['topic_forum'])) {
			$this->db->query("INSERT INTO %pvotes (vote_user, vote_topic, vote_option) VALUES (%d, %d, %d)",
				$this->user['user_id'], $this->get['t'], $this->post['pollvote']);
			header('Location: ' . $this->self . '?a=topic&t=' . $this->get['t']);
			return;
		}

		$this->set_title($this->lang->post_voting);
		return $this->message($this->lang->post_voting, $this->lang->post_cant_enter);
	}

	function nullvote()
	{
		if (!isset($this->get['t'])) {
			return $this->message($this->lang->post_voting, $this->lang->post_no_topic);
		}

		$this->get['t'] = intval($this->get['t']);

		if (!$this->sets['vote_after_results']) {
			$this->db->query("INSERT INTO %pvotes (vote_user, vote_topic, vote_option) VALUES (%d, %d, -1)",
				$this->user['user_id'], $this->get['t']);
		}

		header("Location: {$this->self}?a=topic&t={$this->get['t']}&results=1");
	}
}
?>
