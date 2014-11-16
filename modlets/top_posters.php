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

/**
 * Show Top 10 Posters
 * 
 * @author KingOfSka <kingofska@gmail.com>
 * @return string HTML with Top Posters and link to their profile
**/
class top_posters extends modlet
{
	function run($param)
	{
		$content = "";
		$result = $this->qsf->db->query( "SELECT user_id, user_name, user_posts FROM %pusers ORDER BY user_posts DESC LIMIT 5" );

		while($row = mysql_fetch_array($result))
		{
			$user = $row['user_name'];
			$post = $row['user_posts'];
			$uid = $row['user_id'];

			if( $uid == USER_GUEST_UID || $post < 1 )
			   continue;

			$uPostRef = "<a href=\"{$this->qsf->self}?a=search&amp;id={$uid}\">";
			$content .= "<a href=\"{$this->qsf->self}?a=profile&amp;w={$uid}\">{$user}</a> {$uPostRef}($post)</a><br />";
		}
		return eval($this->qsf->template('MAIN_TOP_POSTERS'));
	}
}
?>
