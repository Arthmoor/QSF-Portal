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
	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->site ) : $this->lang->board_noview
			);
		}

		$c = 0;
		if( isset( $this->get['c'] ) ) {
			$c = intval( $this->get['c'] );
			$this->htmlwidgets->tree_forums( $c );
		}

		if( isset( $this->get['s'] ) ) {
			if( $this->get['s'] == 'mark' ) {
				if( isset( $this->get['f'] ) && intval( $this->get['f'] ) ) {
					$forum_id = intval( $this->get['f'] );
					$forum_data = $this->htmlwidgets->get_forum( $forum_id );

					if( $forum_data ) {
						$forum_name = $forum_data['forum_name'];
						$link_name = $this->clean_url( $forum_name );

						$this->readmarker->mark_forum_read( $forum_id, $this->time );

						return $this->message( $this->lang->board_markforum,
							sprintf( $this->lang->board_markforum1, $forum_name ),
							$this->lang->continue, "{$this->site}/forum/{$link_name}-{$forum_id}/", "$this->site/forum/{$link_name}-{$forum_id}/" );
					}
				} else {
					$this->readmarker->mark_all_read( $this->time );

					return $this->message( $this->lang->board_mark, $this->lang->board_mark1, $this->lang->continue, "{$this->site}/board/", "{$this->site}/board/" );
				}
			} else {
				$this->get['s'] = null;
			}
		}

		$query = $this->db->query( "SELECT
				f.forum_id, f.forum_parent, f.forum_name, f.forum_position, f.forum_description, f.forum_topics, f.forum_replies, f.forum_lastpost, f.forum_redirect,
				t.topic_id as LastTopicID, t.topic_title as user_lastpost, t.topic_edited as LastTime, t.topic_replies,
				m.user_name as user_lastposter, m.user_id as user_lastposterID
			FROM %pforums f
			LEFT JOIN %pposts p ON p.post_id = f.forum_lastpost
			LEFT JOIN %ptopics t ON t.topic_id = p.post_topic
			LEFT JOIN %pusers m ON m.user_id = p.post_author
			ORDER BY f.forum_parent, f.forum_position" );

		$_forums = array();

		while( $f = $this->db->nqfetch( $query ) )
		{
			if( $this->perms->auth( 'forum_view', $f['forum_id'] ) ) {
				$_forums[$f['forum_parent']][$f['forum_position']][$f['forum_id']] = $f;
			}
		}

		$xtpl = new XTemplate( './skins/' . $this->skin . '/board.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'tree', $this->htmlwidgets->tree );
		$xtpl->assign( 'main_forum_rules', $this->lang->main_forum_rules );
		$xtpl->assign( 'main_mark1', $this->lang->main_mark1 );
		$xtpl->assign( 'main_mark', $this->lang->main_mark );
		$xtpl->assign( 'main_recent1', $this->lang->main_recent1 );
		$xtpl->assign( 'main_recent', $this->lang->main_recent );

		$forums = $this->getForums( $_forums, $c );

		if( $c > 0 ) {
			$query = $this->db->fetch( "SELECT forum_name FROM %pforums WHERE forum_id = %d", $c );

			$xtpl->assign( 'cat_name', $query['forum_name'] );
			$xtpl->assign( 'board_forum', $this->lang->board_forum );
			$xtpl->assign( 'board_topics', $this->lang->board_topics );
			$xtpl->assign( 'board_replies', $this->lang->board_replies );
			$xtpl->assign( 'board_last_post', $this->lang->board_last_post );
			$xtpl->assign( 'forums', $forums );

			$xtpl->parse( 'Category' );
			return $xtpl->text( 'Category' );
		}

		$xtpl->assign( 'forums', $forums );

		$xtpl->parse( 'BoardIndex' );
		return $xtpl->text( 'BoardIndex' );
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
	private function getForums( $forums, $c )
	{
		if( !isset( $forums[$c] ) ) {
			return false;
		}

		$endCat = false;

		$return = null;

		$xtpl = new XTemplate( './skins/' . $this->skin . '/board.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'board_bottom_page', $this->lang->board_bottom_page );
		$xtpl->assign( 'board_top_page', $this->lang->board_top_page );
		$xtpl->assign( 'board_forum', $this->lang->board_forum );
		$xtpl->assign( 'board_topics', $this->lang->board_topics );
		$xtpl->assign( 'board_replies', $this->lang->board_replies );
		$xtpl->assign( 'board_last_post', $this->lang->board_last_post );
		$xtpl->assign( 'board_forum_url', $this->lang->board_forum_url );
		$xtpl->assign( 'main_topics_new', $this->lang->main_topics_new );
		$xtpl->assign( 'main_topics_old', $this->lang->main_topics_old );
		$xtpl->assign( 'board_by', $this->lang->board_by );

		foreach( $forums[$c] as $category )
		{
			foreach( $category as $forum )
			{
				$forum['forum_name'] = $this->format( $forum['forum_name'], FORMAT_HTMLCHARS );

				if( $forum['forum_parent'] == 0 ) {
					if( $endCat ) {
						$return .= '</div>';
					}

					$xtpl->assign( 'fid', $forum['forum_id'] );
					$xtpl->assign( 'fname', $forum['forum_name'] );
					$xtpl->assign( 'cat_link_name', $this->clean_url( $forum['forum_name'] ) );

					$xtpl->parse( 'CategoryIndex' );
					$return .= $xtpl->text( 'CategoryIndex' );

					$xtpl->reset( 'CategoryIndex' );

					$endCat = true;

					if( isset( $forums[$forum['forum_id']] ) ) {
						$return .= $this->getForums( $forums, $forum['forum_id'] );
					}
				} else {
					if( $forum['forum_description'] && !$forum['forum_redirect'] ) {
						$forum['forum_description'] = '<br />' . $forum['forum_description'];
					}

					$forum['forum_topics'] = number_format( $forum['forum_topics'], 0, null, $this->lang->sep_thousands );
					$forum['forum_replies'] = number_format( $forum['forum_replies'], 0, null, $this->lang->sep_thousands );

					$topic_unread = false;
					$forum_unread = !$this->readmarker->is_forum_read( $forum['forum_id'], $forum['LastTime'] );

					$user_lastpostBox = null;

					if( $forum['forum_lastpost'] ) {
						$topic_unread = !$this->readmarker->is_topic_read( $forum['LastTopicID'], $forum['LastTime'] );

						$forum['LastTime'] = $this->mbdate( DATE_LONG, $forum['LastTime'] );

						if( $forum['user_lastposterID'] != USER_GUEST_UID ) {
							$xtpl->assign( 'user_lastposterID', $forum['user_lastposterID'] );
							$xtpl->assign( 'user_lastposter', $forum['user_lastposter'] );
							$xtpl->assign( 'user_link_name', $this->clean_url( $forum['user_lastposter'] ) );

							$xtpl->parse( 'LastPostBox.UserInfo' );
						}

						$full_title = $forum['user_lastpost'];
						if( strlen( $forum['user_lastpost']) > 19 ) {
							$forum['user_lastpost'] = substr( $forum['user_lastpost'], 0, 19 ) . '...';
						}

						$full_title = $this->format( $full_title, FORMAT_CENSOR | FORMAT_HTMLCHARS );
						$forum['user_lastpost'] = $this->format( $forum['user_lastpost'], FORMAT_CENSOR | FORMAT_HTMLCHARS );

						$forum['forum_lastpost_topic'] = $forum['LastTopicID'];
						$forum['LastTopicID'] .= '/&amp;p=' . $forum['forum_lastpost'] . '#p' . $forum['forum_lastpost'];

						if( $topic_unread ) {
							$xtpl->assign( 'forum_lastpost_topic', $forum['forum_lastpost_topic'] );

							$xtpl->parse( 'LastPostBox.TopicUnread' );
						}

						$xtpl->assign( 'forum_last_topic_link', $this->clean_url( $full_title ) );
						$xtpl->assign( 'LastTopicID', $forum['LastTopicID'] );
						$xtpl->assign( 'full_title', $full_title );
						$xtpl->assign( 'user_lastpost', $forum['user_lastpost'] );
						$xtpl->assign( 'LastTime', $forum['LastTime'] );

						$xtpl->parse( 'LastPostBox' );
						$user_lastpostBox = $xtpl->text( 'LastPostBox' );

						$xtpl->reset( 'LastPostBox' );
					} else {
						$user_lastpostBox = $this->lang->board_nopost;
					}

					if( $forum['forum_redirect'] ) {
						$xtpl->assign( 'fdesc', $forum['forum_description'] );
						$xtpl->assign( 'fname', $forum['forum_name'] );

						$xtpl->parse( 'ForumRedirect' );
						$return .= $xtpl->text( 'ForumRedirect' );

						$xtpl->reset( 'ForumRedirect' );
					} else {
						if( $forum_unread ) {
							$xtpl->parse( 'BoardForum.ForumUnread' );
						} else {
							$xtpl->parse( 'BoardForum.ForumRead' );
						}

						$xtpl->assign( 'fid', $forum['forum_id'] );
						$xtpl->assign( 'fname', $forum['forum_name'] );
						$xtpl->assign( 'forum_link_name', $this->clean_url( $forum['forum_name'] ) );
						$xtpl->assign( 'fdesc', $forum['forum_description'] );
						$xtpl->assign( 'ftopics', $forum['forum_topics'] );
						$xtpl->assign( 'freplies', $forum['forum_replies'] );
						$xtpl->assign( 'user_lastpostBox', $user_lastpostBox );

						$xtpl->parse( 'BoardForum' );
						$return .= $xtpl->text( 'BoardForum' );

						$xtpl->reset( 'BoardForum' );
					}
				}
			}
		}

		if( $endCat ) {
			$return .= '</div>';
		}

		return $return;
	}
}
?>