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
 * Forum view
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 */
class forum extends qsfglobal
{
	function execute()
	{
		if (!isset($this->get['f'])) {
			return $this->message($this->lang->forum_forum, $this->lang->forum_noexist);
		}

		$f = intval($this->get['f']);

		if (!$this->perms->auth('forum_view', $f)) {
			return $this->message(
				sprintf($this->lang->forum_msg, $this->sets['forum_name']),
				($this->perms->is_guest) ? sprintf($this->lang->forum_regfirst, $this->self) : $this->lang->forum_noview
			);
		}

		if (isset($this->get['num'])) {
			$n = intval($this->get['num']);
		} elseif ($this->user['user_topics_page'] != 0) {
			$n = $this->user['user_topics_page'];
		} else {
			$n = $this->sets['topics_per_page'];
		}

		if ($this->user['user_posts_page'] != 0) {
			$m = $this->user['user_posts_page'];
		} else {
			$m = $this->sets['posts_per_page'];
		}

		$min = isset($this->get['min']) ? intval($this->get['min']) : 0;
		$asc = isset($this->get['asc']) ? intval(!$this->get['asc']) : 1;
		$lasc = $asc ? 0 : 1;

		if (isset($this->get['order'])) {
			if ($this->get['order'] == 'title') {
				$order = 't.topic_title';
			} elseif ($this->get['order'] == 'starter') {
				$order = 'topic_starter_name';
			} elseif ($this->get['order'] == 'replies') {
				$order = 't.topic_replies';
			} elseif ($this->get['order'] == 'views') {
				$order = 't.topic_views';
			} else {
				$this->get['order'] = '';
				$order = 't.topic_edited';
			}

			if (!$this->get['asc']) {
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
		$exists = $this->db->fetch("SELECT forum_parent, forum_name, forum_subcat FROM %pforums WHERE forum_id=%d", $f);
		if (!isset($exists['forum_parent']) || !$exists['forum_parent']) {
			return $this->message($this->lang->forum_forum, $this->lang->forum_noexist);
		}
		
		// Add RSS feed link for forum
		$this->add_feed($this->sets['loc_of_board'] . $this->mainfile . '?a=rssfeed&amp;f=' . $f,
			"{$this->lang->forum_forum}: {$exists['forum_name']}");

		$this->set_title($exists['forum_name']);

		$topic = $this->db->fetch("SELECT COUNT(topic_id) AS count FROM %ptopics WHERE topic_forum=%d", $f);

		$pagelinks = $this->htmlwidgets->get_pages($topic['count'], "a=forum&amp;f=$f&amp;order={$this->get['order']}&amp;asc=$lasc", $min, $n);
		$SubForums = $this->getSubs($f);
		$forumjump = $this->htmlwidgets->select_forums($f, 0, null, true);

		if($exists['forum_subcat'] == '0') {
			$topics = $this->getTopics($f, $min, $n, $m, $order);

			if (!$topics) {
				$topics = eval($this->template('FORUM_NO_TOPICS'));
			}
			$Forum_TopicList = eval($this->template('FORUM_TOPICS_MAIN'));
		} else {
			$Forum_TopicList = null;
		}

		$this->htmlwidgets->tree_forums($f);

		if ($SubForums) {
			$Forum_SubMain = eval($this->template('FORUM_SUBFORUM_MAIN'));
		} else {
			$Forum_SubMain = null;
		}

		return eval($this->template('FORUM_MAIN'));
	}

	function getSubs($f)
	{
		$out = null;

		$query = $this->db->query("
			SELECT
				f.forum_id, f.forum_parent, f.forum_name, f.forum_position, f.forum_description, f.forum_topics, f.forum_replies, f.forum_lastpost,
				t.topic_id as LastTopicID, t.topic_title as user_lastpost, t.topic_edited as LastTime,
				m.user_name as user_lastposter, m.user_id as user_lastposterID
			FROM %pforums f
			LEFT JOIN %pposts p ON p.post_id = f.forum_lastpost
			LEFT JOIN %ptopics t ON t.topic_id = p.post_topic
			LEFT JOIN %pusers m ON m.user_id = p.post_author
			WHERE f.forum_parent=%d
			ORDER BY f.forum_parent, f.forum_position", $f);

		if ($forum = $this->db->nqfetch($query)) {
			$this->templater->add_templates('board');
			do{
				if (!$this->perms->auth('forum_view', $forum['forum_id'])) {
					continue;
				}

				if ($forum['forum_description']) {
					$forum['forum_description'] = '<br />' . $forum['forum_description'];
				}

				$topic_new = "<img src='./skins/{$this->skin}/images/topic_old.png' alt='{$this->lang->main_topics_old}' title='{$this->lang->main_topics_old}' />";
				$topic_unread = false;
				$forum_unread = !$this->readmarker->is_forum_read($forum['forum_id'], $forum['LastTime']);

				if ($this->perms->auth('topic_view', $forum['forum_id'])) {
					if ($this->perms->auth('topic_create', $forum['forum_id'])) {
						$topic_perms = "<a href=\"{$this->self}?a=post&amp;s=topic&amp;f={$forum['forum_id']}\"><img src=\"./skins/{$this->skin}/images/topic_write.png\" alt=\"{$this->lang->forum_write_topics}\" title=\"{$this->lang->forum_write_topics}\" /></a>";
					} else {
						$topic_perms = "<img src='./skins/{$this->skin}/images/topic_read.png' alt='{$this->lang->forum_can_topics}' title='{$this->lang->forum_can_topics}' />";
					}

					if ($this->perms->auth('post_create', $forum['forum_id'])) {
						$post_perms = "<img src='./skins/{$this->skin}/images/post_write.png' alt='{$this->lang->forum_can_post}' title='{$this->lang->forum_can_post}' />";
					} else {
						$post_perms = "<img src='./skins/{$this->skin}/images/post_read.png' alt='{$this->lang->forum_cant_post}' title='{$this->lang->forum_cant_post}' />";
					}
				} else {
					$topic_perms = "<img src='./skins/{$this->skin}/images/topic_none.png' alt='{$this->lang->forum_cant_topics}' title='{$this->lang->forum_cant_topics}' />";
					$post_perms = "<img src='./skins/{$this->skin}/images/post_read.png' alt='{$this->lang->forum_cant_post}' title='{$this->lang->forum_cant_post}' />";
				}

				if ($forum['forum_lastpost']) {
					$topic_unread = !$this->readmarker->is_forum_read($forum['forum_id'], $forum['LastTime']);
					if ($topic_unread) {
						$topic_new = "<a href=\"{$this->self}?s=mark&amp;f={$forum['forum_id']}\"><img src=\"./skins/{$this->skin}/images/topic_new.png\" alt=\"{$this->lang->main_topics_new}\" title=\"{$this->lang->main_topics_new}\" /></a>";
					}

					$forum['TopicLastTime'] = $forum['LastTime']; // Store so skin can access
					$forum['LastTime'] = $this->mbdate(DATE_LONG, $forum['LastTime']);

					if ($forum['user_lastposterID']) {
						$forum['user_lastposter'] = '<a href="' . $this->self . '?a=profile&amp;w=' . $forum['user_lastposterID'] . '" class="small">' . $forum['user_lastposter'] . '</a>';
					}

					$full_title = $forum['user_lastpost'];
					if (strlen($forum['user_lastpost']) > 19) {
						$forum['user_lastpost'] = substr($forum['user_lastpost'], 0, 19) . '...';
					}

					$user_lastpostBox = eval($this->template('BOARD_LAST_POST_BOX'));
				} else {
					$user_lastpostBox = $this->lang->forum_nopost;
				}

				$out .= eval($this->template('BOARD_FORUM'));
			}
			while ($forum = $this->db->nqfetch($query));
		}

		return $out;
	}

	function getTopics($f, $min, $n, $m, $order)
	{
		$out = null;

		$query = $this->db->query("
			SELECT
				DISTINCT(p.post_author) as dot,
				t.topic_id, t.topic_title, t.topic_last_poster, t.topic_starter, t.topic_replies, t.topic_modes,
				t.topic_edited, t.topic_icon, t.topic_views, t.topic_description, t.topic_moved, t.topic_forum,
				s.user_name AS topic_starter_name, m.user_name AS topic_last_poster_name, p.post_id AS topic_last_post
			FROM
				(%ptopics t,
				%pusers s)
			LEFT JOIN %pposts p ON (t.topic_id = p.post_topic AND p.post_author = %d)
			LEFT JOIN %pusers m ON m.user_id = t.topic_last_poster
			WHERE
				((t.topic_forum = %d) OR (t.topic_modes & %d)) AND
				s.user_id = t.topic_starter
			GROUP BY t.topic_id
			ORDER BY
				(t.topic_modes & %d) DESC,
				$order
			LIMIT
				%d, %d",
			$this->user['user_id'], $f, TOPIC_GLOBAL, TOPIC_PINNED, $min, $n);

		while ($row = $this->db->nqfetch($query))
		{
			$row['topic_title'] = $this->format($row['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS);
			
			$row['newpost'] = !$this->readmarker->is_topic_read($row['topic_id'], $row['topic_edited']);

			$Pages = $this->htmlwidgets->get_pages_topic($row['topic_replies'], 'a=topic&amp;t=' . $row['topic_id'] . '&amp;f=' . $f, ', ', 0, $m);

			if (!empty($row['topic_description'])) {
				$row['topic_description'] = '<br />&raquo; ' . $this->format($row['topic_description'], FORMAT_CENSOR | FORMAT_HTMLCHARS);
			}

			if ($row['topic_last_poster'] != USER_GUEST_UID) {
				$last_poster = '<a href="' . $this->self . '?a=profile&amp;w=' . $row['topic_last_poster'] . '" class="small">' . $row['topic_last_poster_name'] . '</a>';
			} else {
				$last_poster = $this->lang->forum_guest;
			}

			if ($row['topic_starter'] != USER_GUEST_UID) {
				$row['topic_starter'] = '<a href="' . $this->self . '?a=profile&amp;w=' . $row['topic_starter'] . '" class="small">' . $row['topic_starter_name'] . '</a>';
			} else {
				$row['topic_starter'] = $this->lang->forum_guest;
			}

			$state = null;

			if ($row['topic_modes'] & TOPIC_MOVED) {
				$state = 'moved';
				$row['topic_id'] = $row['topic_moved'];

			} elseif ($row['topic_modes'] & TOPIC_LOCKED) {
				if ($row['newpost']) {
					$state = 'new';
				}
				$state .= 'locked';
			} else {
				if ($row['newpost']) {
					$state = 'new';
				}

				if (($this->user['user_id'] != USER_GUEST_UID) && $row['dot']) {
					$state .= 'dot';
				}

				if ($row['topic_replies'] < $this->sets['hot_limit']) {
					$state .= 'open';
				} else {
					$state .= 'hot';
				}
			}

			$jump = '&amp;p=' . $row['topic_last_post'] . '#p' . $row['topic_last_post'];

			$row['edited'] = $row['topic_edited']; // Store so skin can access
			$row['topic_edited'] = $this->mbdate(DATE_LONG, $row['topic_edited']);
			$row['topic_views']  = number_format($row['topic_views'], 0, null, $this->lang->sep_thousands);

			if ($row['topic_modes'] & TOPIC_PINNED) {
				$row['topic_title'] = "<b>" . $row['topic_title'] . "</b>";
			}
			if (!($row['topic_modes'] & TOPIC_PUBLISH)) {
				$row['topic_title'] = "<i>" . $row['topic_title'] . "</i>";
			}
			
			$row['icon'] = $row['topic_icon']; // Store so skin can still access
			if ($row['topic_modes'] & TOPIC_POLL) {
				$row['topic_icon'] = '<img src="./skins/' . $this->skin . '/images/poll.png" alt="' . $this->lang->forum_icon . '" />';
			} else {
				if ($row['topic_icon']) {
					$row['topic_icon'] = '<img src="./skins/' . $this->skin . '/mbicons/' . $row['topic_icon'] . '" alt="' . $this->lang->forum_icon . '" />';
				}
			}

			if (!($row['topic_modes'] & TOPIC_PUBLISH)) {
				if (!$this->perms->auth('topic_view_unpublished', $row['topic_forum'])) {
					$out .= '';
				}else{
					$out .= eval($this->template('FORUM_TOPIC'));
				}
			}else{
				$out .= eval($this->template('FORUM_TOPIC'));
			}
		}

		return $out;
	}
}
?>
