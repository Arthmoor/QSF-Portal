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

if( !defined( 'QUICKSILVERFORUMS') || !defined('QSF_ADMIN' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

/**
 * Statistics
 *
 * @author Roger Libiez
 * @since 2.0
 */
class stats extends admin
{
	public function execute()
	{
		$this->set_title( $this->lang->stats );
		$this->tree( $this->lang->stats );
		$graphs = null;

		/**
		 * Spam
		 */
		$spam_posts = $this->sets['spam_post_count'];
		$spam_email = $this->sets['spam_email_count'];
		$spam_reg = $this->sets['spam_reg_count'];
		$spam_sig = $this->sets['spam_sig_count'];
		$spam_prof = $this->sets['spam_profile_count'];
		$spam_ham = $this->sets['ham_count'];
		$spam_false = $this->sets['spam_false_count'];

		$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/stats.xtpl' );

		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'stats', $this->lang->stats );
		$xtpl->assign( 'stats_spam_statistics', $this->lang->stats_spam_statistics );
		$xtpl->assign( 'stats_forum_posts', $this->lang->stats_forum_posts );
		$xtpl->assign( 'spam_posts', $spam_posts );
		$xtpl->assign( 'stats_false_pos', $this->lang->stats_false_pos );
		$xtpl->assign( 'spam_ham', $spam_ham );
		$xtpl->assign( 'stats_false_neg', $this->lang->stats_false_neg );
		$xtpl->assign( 'spam_false', $spam_false );
		$xtpl->assign( 'email', $this->lang->email );
		$xtpl->assign( 'spam_email', $spam_email );
		$xtpl->assign( 'stats_reg', $this->lang->stats_reg );
		$xtpl->assign( 'spam_reg', $spam_reg );
		$xtpl->assign( 'stats_sig', $this->lang->stats_sig );
		$xtpl->assign( 'spam_sig', $spam_sig );
		$xtpl->assign( 'stats_prof', $this->lang->stats_prof );
		$xtpl->assign( 'spam_prof', $spam_prof );

		/**
		 * Posts
		 */
		$query = $this->db->query( "SELECT COUNT(post_id) AS posts, FROM_UNIXTIME(post_time, '%%b %%Y') AS month FROM %pposts GROUP BY month ORDER BY post_time" );

		$data = array();
		$total = 0;
		while( $item = $this->db->nqfetch( $query ) )
		{
			if( isset( $item['posts'] ) )
				$data[$item['month']] = $item['posts'];
			else
				$item['posts'] = 0;

			$total += intval( $item['posts'] );
		}

		if( !$data )
			$data = array( 0, 0 );

		$xtpl->assign( 'stats_post_by_month', $this->lang->stats_post_by_month );

		foreach( $data as $month => $stat )
		{
			if( !isset( $data[$month] ) )
				$data[$month] = 0;

			if( $total == 0 ) {
				$width = 0;
			} else {
				$width = round( ( $stat / $total ) * 100 ) * 6;
			}

			$xtpl->assign( 'month', $month );
			$xtpl->assign( 'stat', $stat );
			$xtpl->assign( 'width', $width );

			$xtpl->parse( 'Stats.Post' );
		}

		/**
		 * Registrations
		 */
		$query = $this->db->query( "SELECT COUNT(user_id) AS users, FROM_UNIXTIME(user_joined, '%%b %%Y') AS month FROM %pusers WHERE user_joined != 0 GROUP BY month ORDER BY user_joined" );

		$data = array();
		$total = 0;

		while( $item = $this->db->nqfetch( $query ) )
		{
			$data[$item['month']] = $item['users'];
			$total += intval( $item['users'] );
		}

		$xtpl->assign( 'stats_reg_by_month', $this->lang->stats_reg_by_month );

		foreach( $data as $month => $stat )
		{
			if( !isset( $data[$month] ) )
				$data[$month] = 0;
			if( $total == 0 ) {
				$width = 0;
			} else {
				$width = round( ( $stat / $total ) * 100 ) * 6;
			}

			$xtpl->assign( 'month', $month );
			$xtpl->assign( 'stat', $stat );
			$xtpl->assign( 'width', $width );

			$xtpl->parse( 'Stats.Registration' );
		}

		$xtpl->parse( 'Stats' );
		return $xtpl->text( 'Stats' );
	}
}
?>