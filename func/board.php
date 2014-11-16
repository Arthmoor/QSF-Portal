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
 * Main board view
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class board extends qsfglobal
{
	/**
	 * Sets up title, tree, and HTML
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return void
	 **/
	function execute()
	{
		if (!$this->perms->auth('board_view')) {
			return $this->message(
				sprintf($this->lang->board_message, $this->sets['forum_name']),
				($this->perms->is_guest) ? sprintf($this->lang->board_regfirst, $this->self) : $this->lang->board_noview
			);
		}

		if (!isset($this->get['c'])) {
			$this->get['c'] = 0;
		} else {
			$this->htmlwidgets->tree_forums($this->get['c']);
		}

		if (isset($this->get['s'])) {
			if ($this->get['s'] == 'mark') {
				if (isset($this->get['f']) && intval($this->get['f'])) {
					$forum_id = intval($this->get['f']);
					$forum_data = $this->htmlwidgets->get_forum($forum_id);
					if ($forum_data) {
						$forum_name = $forum_data['forum_name'];
						$this->readmarker->mark_forum_read($forum_id, $this->time);
						return $this->message($this->lang->board_markforum,
							sprintf($this->lang->board_markforum1, $forum_name),
							$this->lang->continue, $this->self, $this->self);
					}
				} else {
					$this->readmarker->mark_all_read($this->time);
					return $this->message($this->lang->board_mark, $this->lang->board_mark1, $this->lang->continue, $this->self, $this->self);
				}
			} else {
				$this->get['s'] = null;
			}
		}

		$query = $this->db->query("
			SELECT
				f.forum_id, f.forum_parent, f.forum_name, f.forum_position, f.forum_description, f.forum_topics, f.forum_replies, f.forum_lastpost,
				t.topic_id as LastTopicID, t.topic_title as user_lastpost, t.topic_edited as LastTime, t.topic_replies,
				m.user_name as user_lastposter, m.user_id as user_lastposterID
			FROM %pforums f
			LEFT JOIN %pposts p ON p.post_id = f.forum_lastpost
			LEFT JOIN %ptopics t ON t.topic_id = p.post_topic
			LEFT JOIN %pusers m ON m.user_id = p.post_author
			ORDER BY f.forum_parent, f.forum_position");

		$_forums = array();

		while ($f = $this->db->nqfetch($query))
		{
			if ($this->perms->auth('forum_view', $f['forum_id'])) {
				$_forums[$f['forum_parent']][$f['forum_position']][$f['forum_id']] = $f;
			}
		}

		$forums    = $this->getForums($_forums, $this->get['c']);

		return eval($this->template('BOARD_MAIN'));
	}

	/**
	 * Creates a list of forums
	 *
	 * @param array $forums Forums
	 * @param int $c Category to retrieve
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return string HTML: list of forums
	 **/
	function getForums($forums, $c)
	{
		if (!isset($forums[$c])) {
			return false;
		}
		
		$endCat = false;

		$return = null;

		foreach ($forums[$c] as $category)
		{
			foreach ($category as $forum)
			{
				if ($forum['forum_parent'] == 0) {
					if ($endCat) {
						$return .= eval($this->template('BOARD_CATEGORY_END'));
					}
					$return .= eval($this->template('BOARD_CATEGORY'));
					$endCat = true;

					if (isset($forums[$forum['forum_id']])) {
						$return .= $this->getForums($forums, $forum['forum_id']);
					}
				} else {
					if ($forum['forum_description']) {
						$forum['forum_description'] = '<br />' . $forum['forum_description'];
					}

					$forum['forum_topics'] = number_format($forum['forum_topics'], 0, null, $this->lang->sep_thousands);
					$forum['forum_replies'] = number_format($forum['forum_replies'], 0, null, $this->lang->sep_thousands);

					if ($this->perms->auth('topic_view', $forum['forum_id'])) {
						if ($this->perms->auth('topic_create', $forum['forum_id'])) {
							$topic_perms = "<a href=\"{$this->self}?a=post&amp;s=topic&amp;f={$forum['forum_id']}\"><img src=\"./skins/{$this->skin}/images/topic_write.png\" alt=\"{$this->lang->board_write_topics}\" title=\"{$this->lang->board_write_topics}\" /></a>";
						} else {
							$topic_perms = "<img src='./skins/{$this->skin}/images/topic_read.png' alt='{$this->lang->board_can_topics}' title='{$this->lang->board_can_topics}' />";
						}

						if ($this->perms->auth('post_create', $forum['forum_id'])) {
							$post_perms = "<img src='./skins/{$this->skin}/images/post_write.png' alt='{$this->lang->board_can_post}' title='{$this->lang->board_can_post}' />";
						} else {
							$post_perms = "<img src='./skins/{$this->skin}/images/post_read.png' alt='{$this->lang->board_cant_post}' title='{$this->lang->board_cant_post}' />";
						}
					} else {
						$topic_perms = "<img src='./skins/{$this->skin}/images/topic_none.png' alt='{$this->lang->board_cant_topics}' title='{$this->lang->board_cant_topics}' />";
						$post_perms = "<img src='./skins/{$this->skin}/images/post_read.png' alt='{$this->lang->board_cant_post}' title='{$this->lang->board_cant_post}' />";
					}

					$topic_new = "<img src='./skins/{$this->skin}/images/topic_old.png' alt='{$this->lang->main_topics_old}' title='{$this->lang->main_topics_old}' />";
					$topic_unread = false;
					$forum_unread = !$this->readmarker->is_forum_read($forum['forum_id'], $forum['LastTime']);

					if ($forum['forum_lastpost']) {
						$topic_unread = !$this->readmarker->is_topic_read($forum['LastTopicID'], $forum['LastTime']);
						if ($topic_unread) {
							$topic_new = "<a href=\"{$this->self}?s=mark&amp;f={$forum['forum_id']}\"><img src=\"./skins/{$this->skin}/images/topic_new.png\" alt=\"{$this->lang->main_topics_new}\" title=\"{$this->lang->main_topics_new}\" /></a>";
						}
						
						$forum['TopicLastTime'] = $forum['LastTime']; // store so skins can access

						$forum['LastTime'] = $this->mbdate(DATE_LONG, $forum['LastTime']);

						if ($forum['user_lastposterID'] != USER_GUEST_UID) {
							$forum['user_lastposter'] = "<a href=\"{$this->self}?a=profile&amp;w={$forum['user_lastposterID']}\" class=\"small\">{$forum['user_lastposter']}</a>";
						}

						$full_title = $forum['user_lastpost'];
						if (strlen($forum['user_lastpost']) > 19) {
							$forum['user_lastpost'] = substr($forum['user_lastpost'], 0, 19) . '...';
						}

						$full_title = $this->format($full_title, FORMAT_CENSOR | FORMAT_HTMLCHARS);
						$forum['user_lastpost'] = $this->format($forum['user_lastpost'], FORMAT_CENSOR | FORMAT_HTMLCHARS);

						$forum['LastTopicID'] .= '&amp;p=' . $forum['forum_lastpost'] . '#p' . $forum['forum_lastpost'];

						$user_lastpostBox = eval($this->template('BOARD_LAST_POST_BOX'));
					} else {
						$user_lastpostBox = $this->lang->board_nopost;
					}

					$return .= eval($this->template('BOARD_FORUM'));
				}
			}
		}

		if ($endCat) {
			$return .= eval($this->template('BOARD_CATEGORY_END'));
		}

		return $return;
	}
}
?>
