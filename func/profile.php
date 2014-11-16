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
 * Viewing a user's profile
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class profile extends qsfglobal
{
	function execute()
	{
		$this->set_title($this->lang->profile_view_profile);

		$this->tree($this->lang->profile_list, $this->self . '?a=members');
		$this->tree($this->lang->profile_view_profile);

		if (!isset($this->get['w'])) {
			return $this->message($this->lang->profile_profile, $this->lang->profile_must_user);
		}

		$user = intval($this->get['w']);

		$profile = $this->db->fetch("SELECT m.*, g.group_name, a.active_time
			FROM (%pusers m, %pgroups g)
			LEFT JOIN %pactive a ON a.active_id=m.user_id
			WHERE m.user_id=%d AND g.group_id=m.user_group", $user);

		if (!$profile || ($user == USER_GUEST_UID)) {
			return $this->message($this->lang->profile_view_profile, $this->lang->profile_no_member);
		}

		if ($profile['user_posts']) {
			$user_postsPerDay = $profile['user_posts'] / ((($this->time - $profile['user_joined']) / 86400));

			if ($user_postsPerDay > $profile['user_posts']) { // It's mathematically correct, but not logical
				$user_postsPerDay = $profile['user_posts'];
			}

			$user_postsPerDay = number_format($user_postsPerDay, 2, $this->lang->sep_decimals, $this->lang->sep_thousands);

			$fav = $this->db->query("SELECT COUNT(p.post_id) AS Forumuser_posts, f.forum_id AS Forum, f.forum_name
				FROM %pposts p, %ptopics t, %pforums f
				WHERE p.post_topic=t.topic_id AND t.topic_forum=f.forum_id AND p.post_author=%d
				GROUP BY t.topic_forum
				ORDER BY Forumuser_posts DESC", $user);

			$final_fav = null;

			while ($f = $this->db->nqfetch($fav))
			{
					if ($this->perms->auth('forum_view', $f['Forum'])) {
						$final_fav = $f;
						break;
					}
			}

			$last = $this->db->fetch("SELECT t.topic_id, t.topic_forum, t.topic_title, p.post_time
				FROM %ptopics t, %pposts p
				WHERE t.topic_id = p.post_topic AND p.post_author=%d
				ORDER BY p.post_time DESC
				LIMIT 1", $profile['user_id']);

			if (isset($last['topic_forum']) && $this->perms->auth('topic_view', $last['topic_forum'])) {
				if (strlen($last['topic_title']) > 25) {
					$last['topic_title'] = substr($last['topic_title'], 0, 22) . '...';
				}

				$lastpost = '<a href="' . $this->self . '?a=topic&amp;t=' . $last['topic_id'] . '">' . $this->format($last['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS) . '</a><br />' . $this->mbdate(DATE_LONG, $last['post_time']);
			} else {
				$lastpost = $this->lang->profile_unkown;
			}

			if (isset($final_fav['Forum'])) {
				$posts_total = $this->db->fetch('SELECT COUNT(post_id) as count FROM %pposts WHERE post_author=%d', $user);

				if (!$posts_total['count']) {
					$fav_forum = $this->lang->profile_unkown;
				} else {
					$fav_forum = sprintf($this->lang->profile_fav_forum, "<a href='{$this->self}?a=forum&amp;f={$final_fav['Forum']}'>{$final_fav['forum_name']}</a>", round($final_fav['Forumuser_posts'] / $posts_total['count'] * 100));
				}
			} else {
				$fav_forum = $this->lang->profile_unkown;
			}

			$profile['user_posts'] = "<a href='{$this->self}?a=search&amp;id=$user'>" . sprintf($this->lang->profile_postcount, number_format($profile['user_posts'], 0, null, $this->lang->sep_thousands), $user_postsPerDay) . '</a>';

			$PostInfo = eval($this->template('PROFILE_POST_INFO'));
		} else {
			$PostInfo = eval($this->template('PROFILE_NO_POSTS'));
		}

		$online = ($profile['active_time'] && ($profile['active_time'] > ($this->time - 900)) && $profile['user_active']);

		if ($profile['user_birthday'] == '0000-00-00') {
			$profile['user_birthday'] = null;
		}

		if (!$profile['user_icq']) {
			$profile['user_icq'] = null;
		}

		if ($profile['user_pm']) {
			$profile['user_pm'] = "<a href='{$this->self}?a=pm&amp;s=send&amp;to={$profile['user_id']}'><img src='./skins/{$this->skin}/images/pm.png' alt='{$this->lang->profile_pm}' /></a>";
		} else {
			$profile['user_pm'] = null;
		}

		if ($profile['user_avatar_type'] != 'none') {
			$profile['user_avatar'] = "<img src='{$profile['user_avatar']}' alt='{$this->lang->profile_avatar}' width='{$profile['user_avatar_width']}' height='{$profile['user_avatar_height']}' />";
		} else {
			$profile['user_avatar'] = $this->lang->profile_none;
		}

		if ($profile['user_homepage']) {
			$profile['user_homepage'] = "<a href='{$profile['user_homepage']}'>{$profile['user_homepage']}</a>";
		}

		$profile['user_joined'] = $this->mbdate(DATE_LONG, $profile['user_joined']);

		if ($profile['user_email_show']) {
			$profile['user_email'] = "<a href='mailto:{$profile['user_email']}'>{$profile['user_email']}</a>";
		} else {
			if ($profile['user_email_form']) {
				$profile['user_email'] = "<a href='{$this->self}?a=email&amp;to={$profile['user_id']}'>{$this->lang->profile_private}</a>";
			} else {
				$profile['user_email'] = $this->lang->profile_private;
			}
		}

		if ($profile['user_signature']) {
			$profile['user_signature'] = $this->format($profile['user_signature'], FORMAT_HTMLCHARS | FORMAT_CENSOR | FORMAT_EMOTICONS | FORMAT_MBCODE | FORMAT_BREAKS);
		} else {
			$profile['user_signature'] = $this->lang->profile_none;
		}

		return eval($this->template('PROFILE_MAIN'));
	}
}
?>
