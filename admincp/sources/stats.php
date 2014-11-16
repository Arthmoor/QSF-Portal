<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2007 The QSF Portal Development Team
 * http://www.qsfportal.com/
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2006 The Quicksilver Forums Development Team
 * http://www.quicksilverforums.com/
 * 
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 * http://www.mercuryboard.com/
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

if (!defined('QUICKSILVERFORUMS') || !defined('QSF_ADMIN')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';

class stats extends admin
{
	function execute()
	{
		$this->set_title($this->lang->stats);
		$this->tree($this->lang->stats);

		/**
		 * Posts
		 */
		$query = $this->db->query("
		SELECT
		    COUNT(post_id) AS posts,
		    FROM_UNIXTIME(post_time, '%%b %%y') AS month
		FROM %pposts
		GROUP BY month
		ORDER BY post_time");

		$data = array();
		$total = 0;
		while ($item = $this->db->nqfetch($query))
		{
			if ( isset($item['posts']) )
				$data[$item['month']] = $item['posts'];
			else
				$item['posts'] = 0;
			
			$total += intval($item['posts']);
		}

		if (!$data)
			$data = array(0, 0);

		$graphs = null;
		$Stats = null;
		$title = $this->lang->stats_post_by_month;
		foreach( $data as $month => $stat )
		{
			if ( !isset( $data[$month] ) )
				$data[$month] = 0;

			if ($total == 0) {
				$width = 0;
			} else {
				$width = round($stat / $total * 100) * 2;
			}
			$Stats .= eval($this->template('STAT_STAT'));
		}
		$graphs .= eval($this->template('STAT_GRAPH'));

		/**
		 * Registrations
		 */
		$query = $this->db->query("
		SELECT
		    COUNT(user_id) AS users,
		    FROM_UNIXTIME(user_joined, '%%b %%y') AS month
		FROM %pusers
		WHERE user_joined != 0
		GROUP BY month
		ORDER BY user_joined");

		$data = array();
		$total = 0;

		while ($item = $this->db->nqfetch($query))
		{
			$data[$item['month']] = $item['users'];
			$total += intval($item['users']);
		}
		$Stats = null;
		$title = $this->lang->stats_reg_by_month;
		foreach( $data as $month => $stat )
		{
			if ( !isset( $data[$month] ) )
				$data[$month] = 0;
			if ($total == 0) {
				$width = 0;
			} else {
				$width = round($stat / $total * 100) * 2;
			}
			$Stats .= eval($this->template('STAT_STAT'));
		}
		$graphs .= eval($this->template('STAT_GRAPH'));

		return eval($this->template('STAT_PAGE'));
	}
}
?>
