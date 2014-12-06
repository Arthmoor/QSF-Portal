<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2015 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * http://code.google.com/p/quicksilverforums/
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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/global.php';

class conversation extends qsfglobal
{
	function execute()
	{
		if (!$this->perms->auth('board_view')) {
			$this->lang->board();
			return $this->message(
				sprintf($this->lang->board_message, $this->sets['forum_name']),
				($this->perms->is_guest) ? sprintf($this->lang->board_regfirst, $this->self) : $this->lang->board_noview
			);
		}

		$this->set_title($this->lang->cv_conversation);
		$this->tree($this->lang->cv_conversation);

		if ($this->perms->is_guest) {
			return $this->message($this->lang->cv_conversation, sprintf($this->lang->pm_guest, $this->self, $this->self));
		}

		if (isset($this->get['num'])) {
			$n = intval($this->get['num']);
		} elseif ($this->user['user_topics_page'] > 0) {
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
				$order = 'c.conv_title';
			} elseif ($this->get['order'] == 'starter') {
				$order = 'conv_starter_name';
			} elseif ($this->get['order'] == 'replies') {
				$order = 'c.conv_replies';
			} elseif ($this->get['order'] == 'views') {
				$order = 'c.conv_views';
			} else {
				$this->get['order'] = '';
				$order = 'c.conv_edited';
			}

			if (!$this->get['asc']) {
				$order .= ' DESC';
			}
		} else {
			$this->get['order'] = '';
			$order = 'c.conv_edited DESC';
		}

		// Figure out if it will need page navigation links
		$conv = $this->db->fetch( 'SELECT COUNT(conv_id) AS count FROM %pconversations' );
		$pagelinks = $this->htmlwidgets->get_pages($conv['count'], "a=conversations&amp;order={$this->get['order']}&amp;asc=$lasc", $min, $n);

		$convos = $this->getConvos($min, $n, $m, $order);
		if( !$convos )
			$convos = eval($this->template('CONV_NO_TOPICS'));

		$convo_TopicList = eval($this->template('CONV_TOPICS_MAIN'));
		return eval($this->template('CONV_MAIN'));
	}

	function getConvos($min, $n, $m, $order)
	{
		$out = null;

		$query = $this->db->query("
			SELECT	c.conv_id, c.conv_title, c.conv_starter, c.conv_last_poster, c.conv_replies, c.conv_posted, c.conv_edited,
				c.conv_icon, c.conv_views, c.conv_description, c.conv_users, c.conv_last_post,
				s.user_name AS conv_starter_name, m.user_name AS conv_last_poster_name
			FROM (%pconversations c, %pusers s, %pusers m)
			WHERE %d IN(c.conv_users) AND s.user_id=c.conv_starter AND m.user_id=c.conv_last_poster
			GROUP BY c.conv_id
			ORDER BY $order
			LIMIT %d, %d", $this->user['user_id'], $min, $n );

		while ($row = $this->db->nqfetch($query))
		{
			$row['conv_title'] = $this->format($row['conv_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS);

			// $row['newpost'] = !$this->readmarker->is_topic_read($row['topic_id'], $row['topic_edited']);

			$Pages = $this->htmlwidgets->get_pages_topic($row['conv_replies'], 'a=conversation&amp;c=' . $row['conv_id'], ', ', 0, $m);

			if (!empty($row['conv_description'])) {
				$row['conv_description'] = '<br />&raquo; ' . $this->format($row['conv_description'], FORMAT_CENSOR | FORMAT_HTMLCHARS);
			}

			if ($row['conv_last_poster'] != USER_GUEST_UID) {
				$last_poster = '<a href="' . $this->self . '?a=profile&amp;w=' . $row['conv_last_poster'] . '" class="small">' . $row['conv_last_poster_name'] . '</a>';
			} else {
				$last_poster = $this->lang->cv_guest_user;
			}

			if ($row['conv_starter'] != USER_GUEST_UID) {
				$row['conv_starter'] = '<a href="' . $this->self . '?a=profile&amp;w=' . $row['conv_starter'] . '" class="small">' . $row['conv_starter_name'] . '</a>';
			} else {
				$row['conv_starter'] = $this->lang->cv_guest_user;
			}

			$state = null;
			$row['newpost'] = null;

			//if ($row['newpost']) {
			//	$state = 'new';
			//}

			if ($row['conv_replies'] < $this->sets['hot_limit']) {
				$state .= 'open';
			} else {
				$state .= 'hot';
			}

			$jump = '&amp;p=' . $row['conv_last_post'] . '#p' . $row['conv_last_post'];

			$row['edited'] = $row['conv_edited']; // Store so skin can access
			$row['conv_edited'] = $this->mbdate(DATE_LONG, $row['conv_edited']);

			$row['conv_replies']  = number_format($row['conv_replies'], 0, null, $this->lang->sep_thousands);
			$row['conv_views']  = number_format($row['conv_views'], 0, null, $this->lang->sep_thousands);

			$row['icon'] = $row['conv_icon']; // Store so skin can still access
			if ($row['conv_icon']) {
				$row['conv_icon'] = '<img src="' . $this->sets['loc_of_board'] . '/skins/' . $this->skin . '/mbicons/' . $row['conv_icon'] . '" alt="' . $this->lang->cv_icon . '" />';
			}

			$conv_posted = $this->mbdate(DATE_LONG, $row['conv_posted']);

			$out .= eval($this->template('CONV_TOPIC'));
		}
		return $out;
	}
}