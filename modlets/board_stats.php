<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2025 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * https://github.com/Arthmoor/Quicksilver-Forums
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

/**
 * Generate board statistics information
 *
 * @author Roger Libiez
 * @since 1.2.2
 **/
class board_stats extends modlet
{
	public function __construct( $forumobject )
	{
		parent::__construct( $forumobject );
	}

	/**
	* Display the board statistics
	*
	* @author Geoffrey Dunn <geoff@warmage.com>
	* @since 1.2.0
	* @return string HTML with current online users and total membercount
	**/
	public function execute( $arg )
	{
		if( !isset( $this->qsf->lang->board_members ) ) {
			$this->qsf->lang->board();
		}

		$stats = $this->getStats();

		if( $this->qsf->user['user_group'] != USER_GUEST && $this->qsf->user['user_group'] != USER_AWAIT ) {
			$this->qsf->lang->board_stats_string = sprintf( $this->qsf->lang->board_stats_string,
			    $stats['MEMBERS'], $stats['LASTMEMBER'], $stats['TOPICS'], $stats['REPLIES'], $stats['POSTS'] );
		} else {
			$name = $this->qsf->htmlwidgets->clean_url( $stats['LASTMEMBER'] );

			$this->qsf->lang->board_stats_string = sprintf( $this->qsf->lang->board_stats_string,
			    $stats['MEMBERS'], "<a href=\"{$this->qsf->site}/profile/{$name}-{$stats['LASTMEMBERID']}/\">{$stats['LASTMEMBER']}</a>",
			    $stats['TOPICS'], $stats['REPLIES'], $stats['POSTS'] );
		}

		$this->qsf->lang->board_most_online = sprintf( $this->qsf->lang->board_most_online, $stats['MOSTONLINE'], $stats['MOSTONLINETIME'] );

		if( $this->qsf->user['user_group'] != USER_GUEST && $this->qsf->user['user_group'] != USER_AWAIT ) {
			$name = $this->qsf->htmlwidgets->clean_url( $stats['LASTMEMBER'] );

			$stats['LASTMEMBER'] = "<a href=\"{$this->qsf->site}/profile/{$name}-{$stats['LASTMEMBERID']}/\">{$stats['LASTMEMBER']}</a>";
		}

		$xtpl = new XTemplate( './skins/' . $this->qsf->skin . '/modlets/board_stats.xtpl' );

		$xtpl->assign( 'site', $this->qsf->site );
		$xtpl->assign( 'skin', $this->qsf->skin );
		$xtpl->assign( 'main_stats', $this->qsf->lang->main_stats );
		$xtpl->assign( 'main_files', $this->qsf->lang->main_files );
		$xtpl->assign( 'main_topics', $this->qsf->lang->main_topics );
		$xtpl->assign( 'main_posts', $this->qsf->lang->main_posts );
		$xtpl->assign( 'main_members', $this->qsf->lang->main_members );
		$xtpl->assign( 'main_member_newest', $this->qsf->lang->main_member_newest );
		$xtpl->assign( 'files', $stats['FILES'] );
		$xtpl->assign( 'topics', $stats['TOPICS'] );
		$xtpl->assign( 'posts', $stats['POSTS'] );
		$xtpl->assign( 'members', $stats['MEMBERS'] );
		$xtpl->assign( 'newest', $stats['LASTMEMBER'] );

		if( $this->qsf->perms->auth( 'is_admin' ) ) {
			$xtpl->assign( 'time_exec', $this->qsf->time_exec );
			$xtpl->assign( 'seconds', $this->qsf->lang->seconds );
			$xtpl->assign( 'querycount', $this->qsf->db->querycount );
			$xtpl->assign( 'main_queries', $this->qsf->lang->main_queries );

			$xtpl->parse( 'BoardStats.Admin' );
		}

		$xtpl->parse( 'BoardStats' );
		return $xtpl->text( 'BoardStats' );
	}

	/**
	 * Gets common board stats
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return array Board stats: LASTMEMBERID, LASTMEMBER, MEMBERS, TOPICS, POSTS, REPLIES, MOSTONLINE, MOSTONLINETIME
	 **/
	private function getStats()
	{
		return array(
			'LASTMEMBERID'   => $this->qsf->sets['last_member_id'],
			'LASTMEMBER'     => $this->qsf->sets['last_member'],
			'MEMBERS'        => number_format( $this->qsf->sets['members'], 0, null, $this->qsf->lang->sep_thousands ),
			'TOPICS'         => number_format( $this->qsf->sets['topics'], 0, null, $this->qsf->lang->sep_thousands ),
			'POSTS'          => number_format( $this->qsf->sets['posts'], 0, null, $this->qsf->lang->sep_thousands ),
			'REPLIES'        => number_format( $this->qsf->sets['posts'] - $this->qsf->sets['topics'], 0, null, $this->qsf->lang->sep_thousands ),
			'MOSTONLINE'     => $this->qsf->sets['mostonline'],
			'MOSTONLINETIME' => $this->qsf->mbdate( DATE_LONG, $this->qsf->sets['mostonlinetime'] ),
			'FILES'          => $this->qsf->sets['file_count']
		);
	}
}
?>