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
 * Member maintenance
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 3.0
 **/
class membercount extends admin
{
	/**
	 * Recounts the number of members
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 3.0
	 * @version 1.0.0
	 * @Intensive queries, but not used much.
	 * @return string Message
	 **/
	public function execute()
	{
		$this->set_title( $this->lang->mcount );
		$this->tree( $this->lang->mcount );

		$this->ResetMemberStats();
		$this->write_sets();

		return $this->message( $this->lang->mcount, $this->lang->mcount_updated );
	}

 	/**
	 * Used to update member statistics
	 *
	 * @author Roger Libiez
	 * @since 1.5
	 * @return void
	**/
	private function ResetMemberStats()
	{
		$member = $this->db->fetch( 'SELECT user_id, user_name FROM %pusers ORDER BY user_id DESC LIMIT 1' );
		$counts = $this->db->fetch( 'SELECT COUNT(user_id) AS count FROM %pusers' );

		$this->sets['last_member'] = $member['user_name'];
		$this->sets['last_member_id'] = $member['user_id'];
		$this->sets['members'] = $counts['count'] - 1; // Subtract guest

		// Try to fix user post counts.
		$users = $this->db->query( 'SELECT user_id, user_posts FROM %pusers' );

      $count_query = $this->db->prepare_query( 'SELECT COUNT(post_id) count FROM %pposts WHERE post_author=? AND post_count=1' );
      $count_query->bind_param( 'i', $user_id );

      $post_query = $this->db->prepare_query( 'UPDATE %pusers SET user_posts=? WHERE user_id=?' );
      $post_query->bind_param( 'ii', $post_count, $user_id );

		while( ( $user = $this->db->nqfetch( $users ) ) )
		{
			$user_id = $user['user_id'];
         $post_count = 0;

         $this->db->execute_query( $count_query );
         $result = $count_query->get_result();
			$posts = $this->db->nqfetch( $result );

			if( $posts['count'] && $posts['count'] > 0 ) {
            $post_count = $posts['count'];
			}
         $this->db->execute_query( $post_query );
		}
      $count_query->close();
      $post_query->close();
	}
}
?>