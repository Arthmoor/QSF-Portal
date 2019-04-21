<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2019 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
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
require_once $set['include_path'] . '/modlets/users_online.php';

/**
 * Portal front page view
 *
 * @author Roger Libiez
 * @since 1.2.2
 **/
class main extends qsfglobal
{
	/**
	 * Construct the main portal page
	 *
	 **/
	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->self ) : $this->lang->board_noview
			);
		}

		$this->lang->news();
		$items = $this->getposts( 2 ); // FIXME: Have this set up to use a forum flag for news posts.

		$xtpl = new XTemplate( './skins/' . $this->skin . '/main.xtpl' );

		$xtpl->assign( 'loc_of_board', $this->sets['loc_of_board'] );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'main_news', $this->lang->main_news );
		$xtpl->assign( 'items', $items );

		$modlet = new users_online( $this );

		$users_online = $modlet->execute( true );

		$xtpl->assign( 'users_online', $users_online );

		$xtpl->parse( 'Main' );
		return $xtpl->text( 'Main' );
	}

	private function getposts( $forums )
	{
		$items = "";

		$result = $this->db->query(
		  "SELECT t.*, u.user_name, p.post_author, p.post_text, p.post_mbcode, p.post_emoticons
		    FROM %ptopics t
		    LEFT JOIN %pposts p ON p.post_topic=t.topic_id
		    LEFT JOIN %pusers u ON u.user_id=p.post_author
		    WHERE topic_forum IN ($forums) GROUP BY t.topic_id ORDER BY t.topic_posted DESC" );

		// Display the first 5 news posts in the normal boxes.
		$x = 0;
		while( $row = $this->db->nqfetch( $result ) )
		{
			$params = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR;
			if( $row['post_mbcode'] ) {
				$params |= FORMAT_MBCODE;
			}

			if( $row['post_emoticons'] ) {
				$params |= FORMAT_EMOTICONS;
			}

			$topic = $row['topic_title'];
			$uid = $row['post_author'];
			$user = $row['user_name'];
			$date = $this->mbdate( DATE_LONG, $row['topic_posted'] );
			$text = $this->format( $row['post_text'], $params );

			$pos = strrpos( $text, "[more]" );

			if( $pos !== false ) {
				$text = substr( $text, 0, $pos );
				$text .= "<span style=\"white-space:nowrap\">( <a href=\"{$this->self}?a=newspost&amp;t={$row['topic_id']}\">{$this->lang->news_more}</a> )</span>";
			}

			$comments = "<a href=\"{$this->self}?a=newspost&amp;t={$row['topic_id']}\">{$row['topic_replies']} {$this->lang->news_comments}</a>";

			$xtpl = new XTemplate( './skins/' . $this->skin . '/main.xtpl' );

			$xtpl->assign( 'loc_of_board', $this->sets['loc_of_board'] );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'topic', $topic );
			$xtpl->assign( 'text', $text );
			$xtpl->assign( 'comments', $comments );
			$xtpl->assign( 'main_posted_by', $this->lang->main_posted_by );
			$xtpl->assign( 'user', $user );
			$xtpl->assign( 'date', $date );

			$xtpl->parse( 'NewsItem' );
			$items .= $xtpl->text( 'NewsItem' );

			if( ++$x == 5 )
				break;
		}

		// Make simple links to the rest.
		if( $x == 5 ) {
			$items .= "<select class=\"select\" onchange=\"get_newspost(this,'{$this->self}')\">";
			$items .= "<option value=\"\">{$this->lang->news_previous}</option>";
			while( $row = $this->db->nqfetch( $result ) )
			{
				$items .= "<option value=\"{$row['topic_id']}\">{$row['topic_title']}</option>";
			}
			$items .= "</select>";
		}
		return $items;
	}
}
?>