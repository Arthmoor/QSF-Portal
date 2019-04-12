<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2015 The QSF Portal Development Team
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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

class recent_posts extends modlet
{
	public function __construct( $forumobject )
	{
		parent::__construct( $forumobject );
	}

	/**
	* Display a simplified list of the last 5 posts to the board
	*
	* @param string $param unusued
	* @author Geoffrey Dunn <geoff@warmage.com>
	* @since 1.2.0
	* @return string HTML with current online users and total membercount
	**/
	public function execute( $arg )
	{	
		if( !isset( $this->qsf->lang->board_active_users ) ) {
			$this->qsf->lang->board();
		}
		$content = "";

		$forums_str = $this->qsf->readmarker->create_forum_permissions_string();

		// Handle the unlikely case where the user cannot view ANY forums
		if( $forums_str == "" ) {
			return $content;
		}

		$query = $this->qsf->db->query( "SELECT t.*, u.user_name FROM %ptopics t
			LEFT JOIN %pusers u ON u.user_id = t.topic_last_poster
			WHERE t.topic_forum IN (%s) AND !(t.topic_modes & TOPIC_MOVED)
			ORDER BY topic_edited DESC LIMIT 5", $forums_str );

		while( $row = $this->qsf->db->nqfetch( $query ) )
		{
			$date = $this->qsf->mbdate( DATE_LONG, $row['topic_edited'] );
			$topic_title = $this->qsf->format( $row['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS );

			if( !( $row['topic_modes'] & TOPIC_PUBLISH ) ) {
				if( !$this->qsf->perms->auth( 'topic_view_unpublished', $row['topic_forum'] ) || !$this->qsf->perms->auth( 'topic_view', $row['topic_forum'] ) ) {
					$content .= '';
				} else {
					if( !$this->qsf->readmarker->is_topic_read( $row['topic_id'], $row['topic_edited'] ) ) {
						$content .= "<img src='{$this->qsf->sets['loc_of_board']}/skins/{$this->qsf->skin}/images/icons/star.png' alt='' />&nbsp;";
						$content .= "<a href='{$this->qsf->self}?a=topic&amp;t={$row['topic_id']}&amp;unread=1#unread'>";
					} else {
						$content .= "<a href='{$this->qsf->self}?a=topic&amp;t=".$row['topic_id']."&amp;p=".$row['topic_last_post']."#p".$row['topic_last_post']."'>";
					}

					$content .= "<i>".$topic_title."</i></a><br />";
					$content .= $date ."<br />". $this->qsf->lang->board_by ." <a href=\"{$this->qsf->self}?a=profile&amp;w=".$row['topic_last_poster']."\">". $row['user_name']."</a><hr />";
				}
			} else {
				if( !$this->qsf->perms->auth('topic_view', $row['topic_forum'] ) ) {
					$content .= '';
				} else {
					if( !$this->qsf->readmarker->is_topic_read( $row['topic_id'], $row['topic_edited'] ) ) {
						$content .= "<img src='{$this->qsf->sets['loc_of_board']}/skins/{$this->qsf->skin}/images/icons/star.png' alt='' />&nbsp;";
						$content .= "<a href='{$this->qsf->self}?a=topic&amp;t={$row['topic_id']}&amp;unread=1#unread'>";
					} else {
						$content .= "<a href='{$this->qsf->self}?a=topic&amp;t=".$row['topic_id']."&amp;p=".$row['topic_last_post']."#p".$row['topic_last_post']."'>";
					}

					$content .= $topic_title."</a><br />";
					$content .= $date ."<br />". $this->qsf->lang->board_by ." <a href=\"{$this->qsf->self}?a=profile&amp;w=".$row['topic_last_poster']."\">".$row['user_name']."</a><hr />";
				}
			}
		}

		$xtpl = new XTemplate( './skins/' . $this->qsf->skin . '/modlets/recent_posts.xtpl' );

		$xtpl->assign( 'loc_of_board', $this->qsf->sets['loc_of_board'] );
		$xtpl->assign( 'skin', $this->qsf->skin );
		$xtpl->assign( 'self', $this->qsf->self );
		$xtpl->assign( 'main_recent1', $this->qsf->lang->main_recent1 );
		$xtpl->assign( 'main_recent', $this->qsf->lang->main_recent );
		$xtpl->assign( 'content', $content );

		$xtpl->parse( 'RecentPosts' );
		return $xtpl->text( 'RecentPosts' );
	}
}
?>