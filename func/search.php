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
 * Allows searching of the forums
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class search extends qsfglobal
{
	function execute()
	{
		$this->set_title($this->lang->search_search);

		if (!isset($this->post['submit']) && !isset($this->get['id']) && !isset($this->get['results'])) {
			return $this->search_form();
		} else {
			if (!$this->perms->auth('search_noflood') && ($this->user['user_lastsearch'] > ($this->time - $this->sets['flood_time_search']))) {
				return $this->message($this->lang->search_search, sprintf($this->lang->search_flood, $this->sets['flood_time_search']));
			}

			return $this->search_results();
		}
	}

	function search_form()
	{
		$this->tree($this->lang->search_search);

		$select = !isset($this->get['f']) ? -1 : $this->get['f'];
		$forum_options = $this->htmlwidgets->select_forums($select);

		return eval($this->template('SEARCH_MAIN'));
	}

	function create_word_query($in, &$sql_data)
	{
		$out = null;
		$in  = explode(' ', $in);

		foreach ($in as $word)
		{
			$out .= " OR (p.post_text LIKE '%%%s%%')";
			$sql_data[] = $word;
		}

		return '(' . substr($out, 4) . ')';
	}

	function create_time_query($way, $time, &$sql_data)
	{
		$time = intval($time);
		$time = $this->time - ($time * 86400);

		if ($way == 'newer') {
			$way = '>=';
		} else {
			$way = '<=';
		}

		$sql_data[] = $time;
		return "(p.post_time $way %d)";
	}

	function create_sound_query($in)
	{
		$out = null;
		$in  = explode(' ', $in);

		foreach ($in as $word)
		{
			$word = soundex($word);
			$out .= " OR (SUBSTRING(SOUNDEX(p.post_text), 1, 4)='$word')";
		}

		return '(' . substr($out, 4) . ')';
	}

	function create_member_query($member, $type, &$sql_data)
	{
		if ($type == 'id') {
			$sql_data[] = intval($member);
			return 'm.user_id=%d';
		}

		$member = $this->format($member, FORMAT_HTMLCHARS | FORMAT_CENSOR);

		$sql_data[] = $member;
		if ($type == 'exact') {
			return "m.user_name='%s'";
		} else {
			return "(m.user_name LIKE '%%%s%%')";
		}
	}

	function search_results()
	{
		$this->tree($this->lang->search_search, $this->self . '?a=search');
		$this->tree($this->lang->search_result);

		// We need to ensure that the query is retained over multiple pages
		if (isset($this->get['query'])) {
			$this->post['query'] = $this->get['query'];
		}

		if (isset($this->get['forums'])) {
			$this->post['forums'] = explode('f', $this->get['forums']);
		}

		if (isset($this->get['searchtype'])) {
			$this->post['searchtype'] = $this->get['searchtype'];
		}

		if (isset($this->get['time_select'])) {
			$this->post['time_select'] = $this->get['time_select'];
		}

		if (isset($this->get['time_way_select'])) {
			$this->post['time_way_select'] = $this->get['time_way_select'];
		}

		if (isset($this->get['member_check'])) {
			$this->post['time_way_select'] = $this->get['member_check'];
		}

		if (isset($this->get['member_select'])) {
			$this->post['member_select'] = $this->get['member_select'];
		}

		if (isset($this->get['member_text'])) {
			$this->post['member_text'] = $this->get['member_text'];
		}

		if (isset($this->get['showposts_check'])) {
			$this->post['showposts_check'] = $this->get['showposts_check'];
		}

		if (isset($this->get['limit_chars'])) {
			$this->post['limit_chars'] = $this->get['limit_chars'];
		}

		if (isset($this->get['limit_check'])) {
			$this->post['limit_check'] = $this->get['limit_check'];
		}

		if(!isset($this->get['id'])) {
			$this->post['query'] = trim($this->post['query']);

			if (!isset($this->post['forums'])) {
				$this->post['forums'] = array();
			}

			$this->define_mysql_version();

			// Fulltext searching available in 3.23.23
			if ((MYSQL_INT_VERSION >= 32323) && ($this->post['searchtype'] == 'match')) {
				$type = 'fulltext';

				// Boolean searching available in 4.0.1
				if (MYSQL_INT_VERSION >= 40001) {
					$boolean = ' IN BOOLEAN MODE';
				} else {
					$boolean = '';
				}
			} else {
				$type = 'normal';

				if ($this->post['searchtype'] != 'regex') {
					$this->post['query'] = preg_split('/[^a-zA-Z0-9_\']/', $this->post['query'], -1, PREG_SPLIT_NO_EMPTY);
					$size = count($this->post['query']);

					for ($i = 0; $i < $size; $i++)
					{
						if (strlen($this->post['query'][$i]) < 4) {
							unset($this->post['query'][$i]);
						}
					}

					$this->post['query'] = implode(' ', $this->post['query']);
				}
			}

			if (trim($this->post['query']) == '') {
				return $this->message($this->lang->search_search, $this->lang->search_no_words);
			}
		} else {
			$type = 'id';
		}

		$this->db->query("UPDATE %pusers SET user_lastsearch=%d WHERE user_id=%d",
			$this->time, $this->user['user_id']);

		$sql = 'SELECT ';
		$sql_data = array();

		if ($type == 'fulltext') {
			$sql .= "MATCH (p.post_text) AGAINST ('%s') AS score, ";
			$sql_data[] = $this->post['query'];
		}

		$sql .= "
			p.post_id, p.post_text, p.post_topic, INET_NTOA(p.post_ip) as post_ip, p.post_author, p.post_icon, p.post_time, p.post_mbcode, p.post_emoticons,
			m.user_name, m.user_title, m.user_avatar_type, m.user_avatar, m.user_avatar_width, m.user_avatar_height, m.user_posts, m.user_joined, m.user_level, m.user_active,
			m2.user_name AS Starter,
			t.topic_title, t.topic_forum, t.topic_replies, t.topic_starter,
			mt.membertitle_icon,
			g.group_name,
			f.forum_name, f.forum_id,
			a.active_time
		FROM
			(%pposts p,
			%ptopics t,
			%pforums f,
			%pusers m,
			%pusers m2,
			%pmembertitles mt,
			%pgroups g)
		LEFT JOIN %pactive a ON a.active_id=m.user_id
		WHERE ";

		if ($type == 'fulltext') {
			$sql .= "MATCH (p.post_text) AGAINST ('%s'$boolean) AND ";
			$sql_data[] = $this->post['query'];
		} elseif ($type == 'normal') {
			if ($this->post['searchtype'] == 'match') {
				$sql .= $this->create_word_query($this->post['query'], $sql_data) . ' AND ';

			} elseif ($this->post['searchtype'] == 'regex') {
				if (@preg_match("/{$this->post['query']}/", 'anything') === false) {
					return $this->message($this->lang->search_search, $this->lang->search_regex_failed, $this->lang->search_mysqldoc, 'http://www.mysql.com/doc/en/Regexp.html');
				}

				$sql .= "(p.post_text REGEXP '%s') AND ";
				$sql_data[] = $this->post['query'];

			} else {
				$sql .= $this->create_sound_query($this->post['query']) . ' AND ';
			}
		}

		if ($type != 'id') {
			$this->post['limit_chars'] = intval($this->post['limit_chars']);

			// Limit forums being searched
			if ($this->post['forums']) {
				$sql .= 'f.forum_id IN (%s) AND ';
				$sql_data[] = implode(',', $this->post['forums']);
			}

			if (isset($this->post['time_check'])) {
				$sql .= $this->create_time_query($this->post['time_way_select'], $this->post['time_select'], $sql_data) . ' AND ';
			}

			if (isset($this->post['member_check'])) {
				$sql .= $this->create_member_query($this->post['member_text'], $this->post['member_select'], $sql_data) . ' AND ';
			}
		} else {
			$this->post['limit_chars'] = 400; //use default when searching by user id
			$sql .= $this->create_member_query($this->get['id'], 'id', $sql_data) . ' AND ';
		}

		$sql .= 'p.post_topic=t.topic_id AND
		t.topic_forum=f.forum_id AND
		m.user_id=p.post_author AND
		m2.user_id=t.topic_starter AND
		m.user_group = g.group_id AND
		mt.membertitle_id = m.user_level';

		if ($type == 'fulltext') {
			$sql .= ' HAVING score > 0.2 ORDER BY score DESC';
		} elseif ($type == 'id') {
			$sql .= ' ORDER BY p.post_time DESC';
		}

		$this->get['min'] = isset($this->get['min']) ? intval($this->get['min']) : 0;
		$this->get['num'] = isset($this->get['num']) ? intval($this->get['num']) : 10;

		if ($type == 'id') {
			$url = "id={$this->get['id']}";
		} else {
			$url = "results=1&amp;" .
			'query=' . $this->format($this->post['query'], FORMAT_HTMLCHARS) . '&amp;' .
			'forums=' . implode('f', $this->post['forums']) . '&amp;' .
			'searchtype=' . $this->format($this->post['searchtype'], FORMAT_HTMLCHARS) . '&amp;' .
			'time_select=' . intval($this->post['time_select']) . '&amp;' .
			'time_way_select=' . $this->format($this->post['time_way_select']) . '&amp;' .
			(isset($this->post['member_check']) ? 'member_check=1&amp;' : '') .
			'member_select=' . $this->format($this->post['member_select']) . '&amp;' .
			'member_text=' . $this->format($this->post['member_text']) . '&amp;' .
			(isset($this->post['showposts_check']) ? 'showposts_check=1&amp;' : '') .
			'limit_chars=' . intval($this->post['limit_chars']) . '&amp;' .
			(isset($this->post['limit_check']) ? 'limit_check=1' : '');
		}

		$pages_sql = $sql_data;
		array_unshift($pages_sql,$sql);
		
		$pages = $this->htmlwidgets->get_pages($pages_sql, "a=search&amp;$url", $this->get['min'], $this->get['num']);

		$sql .= " LIMIT %d, %d";
		$sql_data[] = $this->get['min'];
		$sql_data[] = $this->get['num'];

		array_unshift($sql_data,$sql);
		$query = $this->db->query($sql_data);

		$results = null;
		$topics = array();
		$posts = array();

		while ($search = $this->db->nqfetch($query))
		{
			if (!$this->perms->auth('forum_view', $search['forum_id']) || !$this->perms->auth('topic_view', $search['forum_id'])) {
				continue;
			}

			if (!isset($topics[$search['post_topic']])) {
				$topics[$search['post_topic']] = array();
			}

			$topics[$search['post_topic']][] = $search;
		}

		if ($type != 'id') {
			$match_finder = str_replace(' ', '|', preg_quote(preg_replace('/[+\\-"><]/', '', $this->post['query']), '/'));
		}

		$i = 0;
		$oldtime = $this->time - 900;

		foreach ($topics as $topic)
		{
			$matches = count($topic);
			$search  = $topic[0];

			$search['topic_title'] = $this->format($search['topic_title'], FORMAT_HTMLCHARS | FORMAT_CENSOR);

			$topic_starter = ($search['topic_starter'] != USER_GUEST_UID) ? "<a href='{$this->self}?a=profile&amp;w={$search['topic_starter']}'>{$search['Starter']}</a>" : $search['Starter'];
			$search['topic_replies']++; // Add first post

			$results .= eval($this->template('SEARCH_RESULTS_ENTRY'));

			if (isset($this->post['showposts_check']) || ($type == 'id')) {
				foreach ($topic as $match)
				{
					if (isset($posts[$match['post_id']])) {
						continue;
					}

					if ($i % 2 == 0) {
						$class = 'tablelight';
					} else {
						$class = 'tabledark';
					}

					$i++;

					$posts[$match['post_id']] = 1;

					if (!isset($high_score) && isset($match['score'])) {
						$high_score = $match['score'];
					}

					if (isset($this->post['limit_check']) && ($this->post['limit_chars'] > 0)) {
						if (strlen($match['post_text']) > $this->post['limit_chars']) {
							$match['post_text'] = substr($match['post_text'], 0, $this->post['limit_chars']) . '...';
						}
					}

					if ($match['post_icon']) {
						$match['post_icon'] = "<img src='./skins/$this->skin/mbicons/{$match['post_icon']}' alt='{$this->lang->search_post_icon}' style='margin-right:5px' />";
					}

					$match['user_joined'] = $this->mbdate(DATE_ONLY_LONG, $match['user_joined']);

					if ($this->perms->auth('post_viewip', $match['forum_id'])) {
						$match['post_ip'] = "{$this->lang->search_ip}: {$match['post_ip']}";
					} else {
						$match['post_ip'] = null;
					}

					$match['post_time'] = $this->mbdate(DATE_LONG, $match['post_time']);

					$params = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR;

					if ($match['post_mbcode']) {
						$params |= FORMAT_MBCODE;
					}

					if ($match['post_emoticons']) {
						$params |= FORMAT_EMOTICONS;
					}

					$match['post_text'] = $this->format($match['post_text'], $params);

					if ($type != 'id') {
						// $match['post_text'] = preg_replace("/($match_finder)/i", "<span style='color:#FF0000; font-weight:bold'>\\0</span>", $match['post_text']);
						$match['post_text'] = preg_replace("/($match_finder)/i", "\\0", $match['post_text']);
					}

					if (isset($match['score'])) {
						$match['score'] = sprintf($this->lang->search_relevance, $match['score'] / $high_score * 100);
					} else {
						$match['score'] = '';
					}

					if ($match['post_author'] != USER_GUEST_UID) {
						$online = ($match['active_time'] && ($match['active_time'] > $oldtime) && $match['user_active']);

						if (($match['user_avatar_type'] != 'none') && $this->user['user_view_avatars']) {
							if (substr($match['user_avatar'], -4) != '.swf') {
								$match['user_avatar'] = "<img src='{$match['user_avatar']}' alt='{$this->lang->search_avatar}' width='{$match['user_avatar_width']}' height='{$match['user_avatar_height']}' /><br /><br />";
							} else {
								$match['user_avatar'] = "<object width='{$match['user_avatar_width']}' height='{$match['user_avatar_height']}' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'><param name='movie' value='{$match['user_avatar']}'><param name='play' value='true'><param name='loop' value='true'><param name='quality' value='high'><embed src='{$match['user_avatar']}' width='{$match['user_avatar_width']}' height='{$match['user_avatar_height']}' play='true' loop='true' quality='high'></embed></object><br /><br />";
							}
						} else {
							$match['user_avatar'] = null;
						}

						$Poster_Info = eval($this->template('SEARCH_RESULTS_MEMBER_INFO'));
					} else {
						$Poster_Info = eval($this->template('SEARCH_RESULTS_GUEST_INFO'));
					}

					$results .= eval($this->template('SEARCH_RESULTS_POST'));
				}
			}
		}

		return $results
		       ? eval($this->template('SEARCH_RESULTS_MAIN'))
		       : $this->message($this->lang->search_search, $this->lang->search_no_results);
	}

	/**
	 * Defines MYSQL_INT_VERSION, which contains a MySQL version as an integer.
	 * Based on code from phpMyAdmin's defines.lib.php3 (http://www.phpmyadmin.net)
	 *
	 * @return void
	 **/
	function define_mysql_version()
	{
		$result = mysql_query('SELECT VERSION() AS version');
		if ($result != FALSE && @mysql_num_rows($result) > 0) {
			$row   = mysql_fetch_array($result);
			$match = explode('.', $row['version']);
		} else {
			$result = @mysql_query('SHOW VARIABLES LIKE \'version\'');
			if ($result != FALSE && @mysql_num_rows($result) > 0) {
				$row   = mysql_fetch_row($result);
				$match = explode('.', $row[1]);
			}
		}

		if (!isset($match) || !isset($match[0])) {
			$match[0] = 3;
		}
		if (!isset($match[1])) {
			$match[1] = 21;
		}
		if (!isset($match[2])) {
			$match[2] = 0;
		}

		define('MYSQL_INT_VERSION', (int)sprintf('%d%02d%02d', $match[0], $match[1], intval($match[2])));
	}
}

function highlight_search_criteria($search_results, $search_criteria, $bgcolor='yellow')
{
	if (empty($search_criteria)) return $search_results;
	
	for ($i=0; $i<count($search_criteria); $i++) {
		$search_criteria = '/(' . $search_criteria . ')i';
	}
	
	$start_tag = "<span style='background-color: $bgcolor'>";
	$end_tag = '</span>';

	return preg_replace($search_criteria, $start_tag . '\0' . $end_tag, $search_results);
}

?>
