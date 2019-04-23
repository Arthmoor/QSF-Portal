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
 * Allows searching of the forums
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class search extends qsfglobal
{
	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->self ) : $this->lang->board_noview
			);
		}

		$this->set_title( $this->lang->search_search );

		if( !isset( $this->post['submit'] ) && !isset( $this->get['id'] ) && !isset( $this->get['results'] ) ) {
			return $this->search_form();
		} else {
			if( !$this->perms->auth( 'search_noflood' ) && ( $this->user['user_lastsearch'] > ( $this->time - $this->sets['flood_time_search'] ) ) ) {
				return $this->message( $this->lang->search_search, sprintf( $this->lang->search_flood, $this->sets['flood_time_search'] ) );
			}

			return $this->search_results();
		}
	}

	private function search_form()
	{
		$this->tree( $this->lang->search_search );

		$select = !isset( $this->get['f'] ) ? -1 : $this->get['f'];
		$forum_options = $this->htmlwidgets->select_forums( $select );

		$xtpl = new XTemplate( './skins/' . $this->skin . '/search.xtpl' );

		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'loc_of_board', $this->sets['loc_of_board'] );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'search_search', $this->lang->search_search );
		$xtpl->assign( 'search_basic', $this->lang->search_basic );
		$xtpl->assign( 'search_for', $this->lang->search_for );
		$xtpl->assign( 'search_in', $this->lang->search_in );
		$xtpl->assign( 'search_select_all', $this->lang->search_select_all );
		$xtpl->assign( 'forum_options', $forum_options );
		$xtpl->assign( 'search_advanced', $this->lang->search_advanced );
		$xtpl->assign( 'search_match', $this->lang->search_match );
		$xtpl->assign( 'search_sound', $this->lang->search_sound );
		$xtpl->assign( 'search_regex', $this->lang->search_regex );
		$xtpl->assign( 'search_posts_by', $this->lang->search_posts_by );
		$xtpl->assign( 'search_exact_name', $this->lang->search_exact_name );
		$xtpl->assign( 'search_partial_name', $this->lang->search_partial_name );
		$xtpl->assign( 'search_show_posts', $this->lang->search_show_posts );
		$xtpl->assign( 'search_only_display', $this->lang->search_only_display );
		$xtpl->assign( 'search_characters', $this->lang->search_characters );
		$xtpl->assign( 'search_in_posts', $this->lang->search_in_posts );
		$xtpl->assign( 'search_newer', $this->lang->search_newer );
		$xtpl->assign( 'search_older', $this->lang->search_older );
		$xtpl->assign( 'search_than', $this->lang->search_than );
		$xtpl->assign( 'search_day', $this->lang->search_day );
		$xtpl->assign( 'search_days', $this->lang->search_days );
		$xtpl->assign( 'search_week', $this->lang->search_week );
		$xtpl->assign( 'search_weeks', $this->lang->search_weeks );
		$xtpl->assign( 'search_month', $this->lang->search_month );
		$xtpl->assign( 'search_months', $this->lang->search_months );
		$xtpl->assign( 'search_year', $this->lang->search_year );

		$xtpl->parse( 'Search' );
		return $xtpl->text( 'Search' );
	}

	private function create_word_query( $in, &$sql_data )
	{
		$out = null;
		$in  = explode( ' ', $in );

		foreach( $in as $word )
		{
			$out .= " OR (p.post_text LIKE '%%%s%%')";
			$sql_data[] = $word;
		}

		return '(' . substr( $out, 4 ) . ')';
	}

	private function create_time_query( $way, $time, &$sql_data )
	{
		$time = intval( $time );
		$time = $this->time - ( $time * 86400 );

		if( $way == 'newer' ) {
			$way = '>=';
		} else {
			$way = '<=';
		}

		$sql_data[] = $time;
		return "(p.post_time $way %d)";
	}

	private function create_sound_query( $in )
	{
		$out = null;
		$in  = explode( ' ', $in );

		foreach( $in as $word )
		{
			$word = soundex( $word );
			$out .= " OR (SUBSTRING(SOUNDEX(p.post_text), 1, 4)='$word')";
		}

		return '(' . substr( $out, 4 ) . ')';
	}

	private function create_member_query( $member, $type, &$sql_data )
	{
		if( $type == 'id' ) {
			$sql_data[] = intval( $member );
			return 'm.user_id=%d';
		}

		$member = $this->format( $member, FORMAT_HTMLCHARS | FORMAT_CENSOR );

		$sql_data[] = $member;
		if( $type == 'exact' ) {
			return "m.user_name='%s'";
		} else {
			return "(m.user_name LIKE '%%%s%%')";
		}
	}

	private function search_results()
	{
		$this->tree( $this->lang->search_search, $this->self . '?a=search' );
		$this->tree( $this->lang->search_result );

		// We need to ensure that the query is retained over multiple pages
		if( isset( $this->get['query'] ) ) {
			$this->post['query'] = $this->get['query'];
		}

		if( isset( $this->get['forums'] ) ) {
			$this->post['forums'] = explode( 'f', $this->get['forums'] );
		}

		if( isset( $this->get['searchtype'] ) ) {
			$this->post['searchtype'] = $this->get['searchtype'];
		}

		if( isset( $this->get['time_select'] ) ) {
			$this->post['time_select'] = $this->get['time_select'];
		}

		if( isset( $this->get['time_way_select'] ) ) {
			$this->post['time_way_select'] = $this->get['time_way_select'];
		}

		if( isset( $this->get['member_check'] ) ) {
			$this->post['member_check'] = $this->get['member_check'];
		}

		if( isset( $this->get['member_select'] ) ) {
			$this->post['member_select'] = $this->get['member_select'];
		}

		if( isset( $this->get['member_text'] ) ) {
			$this->post['member_text'] = $this->get['member_text'];
		}

		if( isset( $this->get['showposts_check'] ) ) {
			$this->post['showposts_check'] = $this->get['showposts_check'];
		}

		if( isset( $this->get['limit_chars'] ) ) {
			$this->post['limit_chars'] = $this->get['limit_chars'];
		}

		if( isset( $this->get['limit_check'] ) ) {
			$this->post['limit_check'] = $this->get['limit_check'];
		}

		if( !isset( $this->get['id'] ) ) {
			$this->post['query'] = trim( $this->post['query'] );

			if( !isset( $this->post['forums'] ) ) {
				$this->post['forums'] = array();
			}

			if( $this->post['searchtype'] == 'match' ) {
				$type = 'fulltext';
			}

			if( trim( $this->post['query'] ) == '' ) {
				return $this->message( $this->lang->search_search, $this->lang->search_no_words );
			}
		} else {
			$type = 'id';
		}

		$this->db->query( "UPDATE %pusers SET user_lastsearch=%d WHERE user_id=%d", $this->time, $this->user['user_id'] );

		$sql = 'SELECT ';
		$sql_data = array();

		if( $type == 'fulltext' ) {
			$sql .= "MATCH (p.post_text) AGAINST ('%s') AS score, ";
			$sql_data[] = $this->post['query'];
		}

		$sql .= " p.post_id, p.post_text, p.post_topic, p.post_ip, p.post_author, p.post_icon, p.post_time, p.post_bbcode, p.post_emojis,
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

		if( $type == 'fulltext' ) {
			$sql .= "MATCH (p.post_text) AGAINST ('%s' IN BOOLEAN MODE) AND ";
			$sql_data[] = $this->post['query'];
		} elseif( $type == 'normal' ) {
			if( $this->post['searchtype'] == 'match' ) {
				$sql .= $this->create_word_query( $this->post['query'], $sql_data ) . ' AND ';

			} elseif( $this->post['searchtype'] == 'regex' ) {
				if( @preg_match( "/{$this->post['query']}/", 'anything' ) === false ) {
					return $this->message( $this->lang->search_search, $this->lang->search_regex_failed );
				}

				$sql .= "(p.post_text REGEXP '%s') AND ";
				$sql_data[] = $this->post['query'];

			} else {
				$sql .= $this->create_sound_query( $this->post['query'] ) . ' AND ';
			}
		}

		if( $type != 'id' ) {
			$this->post['limit_chars'] = intval($this->post['limit_chars']);

			// Limit forums being searched
			if( $this->post['forums'] ) {
				if( is_array( $this->post['forums'] ) ) {
					$sql .= 'f.forum_id IN (%s) AND ';

					foreach( $this->post['forums'] as $forums_id => $forums_val )
						$this->post['forums'][$forums_id] = (int)$forums_val;

					$sql_data[] = implode( ',', $this->post['forums'] );
				} else {
					$sql .= 'f.forum_id = \'%d\' AND ';
					$sql_data[] = (int)$this->post['forums'];
				}
                        }

			if( isset( $this->post['time_check'] ) ) {
				$sql .= $this->create_time_query( $this->post['time_way_select'], $this->post['time_select'], $sql_data ) . ' AND ';
			}

			if( isset( $this->post['member_check'] ) ) {
				$sql .= $this->create_member_query( $this->post['member_text'], $this->post['member_select'], $sql_data ) . ' AND ';
			}
		} else {
			$this->post['limit_chars'] = 400; //use default when searching by user id
			$sql .= $this->create_member_query( $this->get['id'], 'id', $sql_data ) . ' AND ';
		}

		$sql .= 'p.post_topic=t.topic_id AND
		t.topic_forum=f.forum_id AND
		m.user_id=p.post_author AND
		m2.user_id=t.topic_starter AND
		m.user_group = g.group_id AND
		mt.membertitle_id = m.user_level';

		if( $type == 'fulltext' ) {
			$sql .= ' HAVING score > 0.2 ORDER BY score DESC';
		} elseif( $type == 'id' ) {
			$sql .= ' ORDER BY p.post_time DESC';
		}

		$this->get['min'] = isset($this->get['min']) ? intval($this->get['min']) : 0;
		$this->get['num'] = isset($this->get['num']) ? intval($this->get['num']) : 10;

		if( $type == 'id' ) {
			$url = "id={$this->get['id']}";
		} else {
			$url = "results=1&amp;" .
			'query=' . $this->format( $this->post['query'], FORMAT_HTMLCHARS ) . '&amp;' .
			'forums=' . implode( 'f', $this->post['forums'] ) . '&amp;' .
			'searchtype=' . $this->format( $this->post['searchtype'], FORMAT_HTMLCHARS ) . '&amp;' .
			'time_select=' . intval( $this->post['time_select'] ) . '&amp;' .
			'time_way_select=' . $this->format( $this->post['time_way_select'] ) . '&amp;' .
			( isset( $this->post['member_check'] ) ? 'member_check=1&amp;' : '' ) .
			'member_select=' . $this->format( $this->post['member_select'] ) . '&amp;' .
			'member_text=' . $this->format( $this->post['member_text'] ) . '&amp;' .
			( isset( $this->post['showposts_check'] ) ? 'showposts_check=1&amp;' : '' ) .
			'limit_chars=' . intval( $this->post['limit_chars'] ) . '&amp;' .
			( isset( $this->post['limit_check'] ) ? 'limit_check=1' : '' );
		}

		$pages_sql = $sql_data;
		array_unshift( $pages_sql, $sql );

		$pages = $this->htmlwidgets->get_pages( $pages_sql, "a=search&amp;$url", $this->get['min'], $this->get['num'] );

		$sql .= " LIMIT %d, %d";
		$sql_data[] = $this->get['min'];
		$sql_data[] = $this->get['num'];

		array_unshift( $sql_data, $sql );
		$query = $this->db->query( $sql_data );

		$results = false;
		$topics = array();
		$posts = array();

		while( $search = $this->db->nqfetch( $query ) )
		{
			if( !$this->perms->auth( 'forum_view', $search['forum_id'] ) || !$this->perms->auth( 'topic_view', $search['forum_id'] ) ) {
				continue;
			}

			if( !isset( $topics[$search['post_topic']] ) ) {
				$topics[$search['post_topic']] = array();
			}

			$topics[$search['post_topic']][] = $search;
		}

		if( $type != 'id' ) {
			$match_finder = str_replace( ' ', '|', preg_quote( preg_replace( '/[+\\-"><]/', '', $this->post['query'] ), '/' ) );
		}

		$oldtime = $this->time - 900;

		$xtpl = new XTemplate( './skins/' . $this->skin . '/search.xtpl' );

		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'search_level', $this->lang->search_level );
		$xtpl->assign( 'search_group', $this->lang->search_group );
		$xtpl->assign( 'search_joined', $this->lang->search_joined );
		$xtpl->assign( 'search_guest', $this->lang->search_guest );
		$xtpl->assign( 'search_unreg', $this->lang->search_unreg );
		$xtpl->assign( 'search_online', $this->lang->search_online );
		$xtpl->assign( 'search_offline', $this->lang->search_offline );
		$xtpl->assign( 'search_posted_on', $this->lang->search_posted_on );
		$xtpl->assign( 'search_posts', $this->lang->search_posts );

		foreach( $topics as $topic )
		{
			$results = true;
			$matches = count( $topic );
			$search  = $topic[0];

			$search['topic_title'] = $this->format( $search['topic_title'], FORMAT_HTMLCHARS | FORMAT_CENSOR );

			if( $search['topic_starter'] != USER_GUEST_UID ) {
				$xtpl->assign( 'topic_starter', $search['topic_starter'] );
				$xtpl->assign( 'topic_starter_name', $search['Starter'] );
				$xtpl->assign( 'topic_starter_link_name', $this->clean_url( $search['Starter'] ) );

				$xtpl->parse( 'Results.Entry.TopicStarterMember' );
			} else {
				$xtpl->assign( 'topic_starter_name', $this->lang->recent_guest );

				$xtpl->parse( 'Results.Entry.TopicStarterGuest' );
			}

			$search['topic_replies']++; // Add first post

			$xtpl->assign( 'post_topic', $search['post_topic'] );
			$xtpl->assign( 'topic_title', $search['topic_title'] );
			$xtpl->assign( 'topic_forum', $search['topic_forum'] );
			$xtpl->assign( 'forum_name', $search['forum_name'] );
			$xtpl->assign( 'matches', $matches );
			$xtpl->assign( 'topic_replies', $search['topic_replies'] );

			if( isset( $this->post['showposts_check'] ) || ( $type == 'id' ) ) {
				foreach( $topic as $match )
				{
					if( isset( $posts[$match['post_id']] ) ) {
						continue;
					}

					$posts[$match['post_id']] = 1;

					if( !isset( $high_score ) && isset( $match['score'] ) ) {
						$high_score = $match['score'];
					}

					if( isset( $this->post['limit_check'] ) && ( $this->post['limit_chars'] > 0 ) ) {
						if( strlen( $match['post_text'] ) > $this->post['limit_chars'] ) {
							$match['post_text'] = substr( $match['post_text'], 0, $this->post['limit_chars'] ) . '...';
						}
					}

					$match['user_joined'] = $this->mbdate( DATE_ONLY_LONG, $match['user_joined'] );

					$match['post_time'] = $this->mbdate( DATE_LONG, $match['post_time'] );

					$match['user_posts'] = number_format( $match['user_posts'], 0, null, $this->lang->sep_thousands );

					$params = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR;

					if( $match['post_bbcode'] ) {
						$params |= FORMAT_BBCODE;
					}

					if( $match['post_emojis'] ) {
						$params |= FORMAT_EMOJIS;
					}

					$match['post_text'] = $this->format( $match['post_text'], $params );

					if( $type != 'id' ) {
						$match['post_text'] = preg_replace( "/($match_finder)/i", "\\0", $match['post_text'] );
					}

					if (isset( $match['score'] ) ) {
						$match['score'] = sprintf( $this->lang->search_relevance, $match['score'] / $high_score * 100 );
					} else {
						$match['score'] = '';
					}

					if( $match['post_author'] != USER_GUEST_UID ) {
						$online = ( $match['active_time'] && ($match['active_time'] > $oldtime) && $match['user_active'] );

						$match['user_avatar'] = $this->htmlwidgets->display_avatar( $match );

						if( $online ) {
							$xtpl->parse( 'Results.Entry.Post.PosterInfoMember.Online' );
						} else {
							$xtpl->parse( 'Results.Entry.Post.PosterInfoMember.Offline' );
						}

						$xtpl->assign( 'user_avatar', $match['user_avatar'] );
						$xtpl->assign( 'post_author', $match['post_author'] );
						$xtpl->assign( 'user_name', $match['user_name'] );
						$xtpl->assign( 'link_name', $this->clean_url( $match['user_name'] ) );
						$xtpl->assign( 'user_title', $match['user_title'] );
						$xtpl->assign( 'membertitle_icon', $match['membertitle_icon'] );
						$xtpl->assign( 'group_name', $match['group_name'] );
						$xtpl->assign( 'user_posts', $match['user_posts'] );
						$xtpl->assign( 'user_joined', $match['user_joined'] );

						$xtpl->parse( 'Results.Entry.Post.PosterInfoMember' );
					} else {
						$xtpl->parse( 'Results.Entry.Post.PosterInfoGuest' );
					}

					$avatar_center = ( $match['user_avatar_width'] ? ( ( $match['user_avatar_width'] / 2 ) - 3 ) : 22 );
					$xtpl->assign( 'avatar_center', $avatar_center );

					$xtpl->assign( 'post_text', $match['post_text'] );
					$xtpl->assign( 'score', $match['score'] );
					$xtpl->assign( 'post_time', $match['post_time'] );

					$xtpl->parse( 'Results.Entry.Post' );
				}
			}
			$xtpl->parse( 'Results.Entry' );
		}

		if( !$results )
			return $this->message( $this->lang->search_search, $this->lang->search_no_results );

		$xtpl->assign( 'search_result', $this->lang->search_result );
		$xtpl->assign( 'search_topic', $this->lang->search_topic );
		$xtpl->assign( 'search_forum', $this->lang->search_forum );
		$xtpl->assign( 'search_replies', $this->lang->search_replies );
		$xtpl->assign( 'search_matches', $this->lang->search_matches );
		$xtpl->assign( 'search_starter', $this->lang->search_starter );
		$xtpl->assign( 'pages', $pages );

		$xtpl->parse( 'Results' );
		return $xtpl->text( 'Results' );
	}
}

function highlight_search_criteria( $search_results, $search_criteria, $bgcolor='yellow' )
{
	if( empty( $search_criteria ) ) return $search_results;

	for( $i = 0; $i < count( $search_criteria ); $i++ ) {
		$search_criteria = '/(' . $search_criteria . ')i';
	}

	$start_tag = "<span style='background-color: $bgcolor'>";
	$end_tag = '</span>';

	return preg_replace( $search_criteria, $start_tag . '\0' . $end_tag, $search_results );
}
?>