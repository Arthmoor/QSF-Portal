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
 * Recent view
 *
 * Displays the topics since last board visit.
 *
 * @author Geoffrey Dunn <quicken@swiftdsl.com.au>
 * @since 1.1.5
 **/
class recent extends qsfglobal
{
	/**
	 * Main interface. Display a list of topics considered unread
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return string html output for module
	 **/
	function execute()
	{
		// No forum need be specified

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

		$this->set_title($this->lang->recent_active);
        
		$forums_str = $this->readmarker->create_forum_permissions_string();

		// Handle the unlikely case where the user cannot view ANY forums
		if ($forums_str == "") {
			return $this->message($this->lang->recent_forum, $this->lang->recent_noexist);
		}
        
		$topicCount = $this->countTopics($forums_str);

		$pagelinks = $this->htmlwidgets->get_pages($topicCount, 'a=recent', $min, $n);

		$forumjump = $this->htmlwidgets->select_forums(0, 0, null, true);

		$topics = $this->getTopics($forums_str, $min, $n, $m);

		if (!$topics) {
			$topics = eval($this->template('RECENT_NO_TOPICS'));
		}

		return eval($this->template('RECENT_MAIN'));
	}
	
	/**
	 * Get a count of all the topics available since the user's last visit
	 *
	 * @param string $forum_str Comma delimited list of forums the user can view
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return int count of topics
	 **/
	function countTopics($forums_str)
	{
		$query = $this->db->fetch("SELECT COUNT(topic_id) AS count
			FROM %ptopics
			WHERE topic_forum IN (%s) AND topic_edited >= %d",
			$forums_str, $this->user['user_lastvisit']);

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
	function getTopics($forums_str, $min, $n, $m)
	{
		$out = null;

		$query = $this->db->query("SELECT
				DISTINCT(t.topic_id), p.post_author as dot,
				t.topic_title, t.topic_last_poster, t.topic_starter, t.topic_replies, t.topic_modes,
				t.topic_edited, t.topic_icon, t.topic_views, t.topic_description, t.topic_moved, t.topic_forum,
				t.topic_last_post, f.forum_id, f.forum_name,
				s.user_name AS topic_starter_name,
				m.user_name AS topic_last_poster_name
			FROM
				(%ptopics t,
				%pforums f,
				%pusers m,
				%pusers s)
			LEFT JOIN %pposts p ON (t.topic_id = p.post_topic AND p.post_author = %d)
			LEFT JOIN %preadmarks rm ON (t.topic_id = rm.readmark_topic AND rm.readmark_user = %d)
			WHERE
				t.topic_forum IN (%s) AND
				(t.topic_edited >= %d OR
				 (t.topic_edited >= %d AND
				  (rm.readmark_lastread IS NULL OR rm.readmark_lastread < t.topic_edited)
				)) AND
				t.topic_forum = f.forum_id AND
				m.user_id = t.topic_last_poster AND
				s.user_id = t.topic_starter AND
				t.topic_modes & %d = 0
			ORDER BY
				t.topic_modes & %d DESC,
				t.topic_edited DESC
			LIMIT
				%d, %d",
			$this->user['user_id'], $this->user['user_id'], $forums_str, $this->user['user_lastvisit'],
			$this->user['user_lastallread'], TOPIC_MOVED, TOPIC_PINNED, $min, $n);

		while ($row = $this->db->nqfetch($query))
		{
			$row['topic_title'] = $this->format($row['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS);

			$row['newpost'] = !$this->readmarker->is_topic_read($row['topic_id'], $row['topic_edited']);

			$Pages = $this->htmlwidgets->get_pages_topic($row['topic_replies'], 'a=topic&amp;t=' . $row['topic_id'], ', ', 0, $m);

			if (!empty($row['topic_description'])) {
				$row['topic_description'] = '<br />&raquo; ' . $this->format($row['topic_description'], FORMAT_CENSOR | FORMAT_HTMLCHARS);
			}

			if ($row['topic_last_poster'] != USER_GUEST_UID) {
				$last_poster = '<a href="' . $this->self . '?a=profile&amp;w=' . $row['topic_last_poster'] . '" class="small">' . $row['topic_last_poster_name'] . '</a>';
			} else {
				$last_poster = $this->lang->recent_guest;
			}

			if ($row['topic_starter'] != USER_GUEST_UID) {
				$row['topic_starter'] = '<a href="' . $this->self . '?a=profile&amp;w=' . $row['topic_starter'] . '" class="small">' . $row['topic_starter_name'] . '</a>';
			} else {
				$row['topic_starter'] = $this->lang->recent_guest;
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
			$row['topic_edited'] = $this->mbdate('g:i a, M j, Y', $row['topic_edited']);
			$row['topic_views']  = number_format($row['topic_views'], 0, null, $this->lang->sep_thousands);

			if ($row['topic_modes'] & TOPIC_PINNED) {
				$row['topic_title'] = "<b>" . $row['topic_title'] . "</b>";
			}
			if (!($row['topic_modes'] & TOPIC_PUBLISH)) {
				$row['topic_title'] = "<i>" . $row['topic_title'] . "</i>";
			}
			$row['icon'] = $row['topic_icon']; // Store so skin can access
			if ($row['topic_modes'] & TOPIC_POLL) {
				$row['topic_icon'] = '<img src="./skins/' . $this->skin . '/images/poll.png" alt="' . $this->lang->recent_icon . '" />';
			} else {
				if ($row['topic_icon']) {
					$row['topic_icon'] = '<img src="./skins/' . $this->skin . '/mbicons/' . $row['topic_icon'] . '" alt="' . $this->lang->recent_icon . '" />';
				}
			}

			if (!($row['topic_modes'] & TOPIC_PUBLISH)) {
				if (!$this->perms->auth('topic_view_unpublished', $row['topic_forum'])) {
					$out .= '';
				}else{
					$out .= eval($this->template('RECENT_TOPIC'));
				}
			}else{
				$out .= eval($this->template('RECENT_TOPIC'));
			}
		}

		return $out;
	}
}
?>
