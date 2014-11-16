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

		include '../lib/jpgraph/jpgraph.php';
		include '../lib/jpgraph/jpgraph_bar.php';

		if (!defined('IMG_PNG')) {
			JpGraphError::Raise("This PHP installation is not configured with PNG support. Please recompile PHP with GD and JPEG support to run JpGraph. (Constant IMG_PNG does not exist)");
		}

		/**
		 * Posts
		 */
		$query = $this->db->query("SELECT COUNT(post_id) AS posts, FROM_UNIXTIME(post_time, '%%b %%y') AS month
			FROM %pposts GROUP BY month	ORDER BY post_time");

		$data = array();
		while ($item = $this->db->nqfetch($query))
		{
			$data[$item['month']] = $item['posts'];
		}

		if (!$data) {
			$data = array(0, 0);
		}

		$graph = new Graph(400, 300, 'auto');
		$graph->SetScale('textint');

		$graph->SetColor('aliceblue');
		$graph->SetMarginColor('white');

		$graph->xaxis->SetTickLabels(array_keys($data));
		$graph->yaxis->scale->SetGrace(20);
		$graph->title->Set($this->lang->stats_post_by_month);

		$temp = array_values($data);
		$barplot = new BarPlot($temp);
		$barplot->SetFillColor('darkorange');

		$graph->add($barplot);
		$graph->Stroke("../stats/{$this->time}1.png");

		/**
		 * Registrations
		 */
		$query = $this->db->query("SELECT COUNT(user_id) AS users, FROM_UNIXTIME(user_joined, '%%b %%y') AS month
			FROM %pusers
			WHERE user_joined != 0
			GROUP BY month
			ORDER BY user_joined");

		$data = array();
		while ($item = $this->db->nqfetch($query))
		{
			$data[$item['month']] = $item['users'];
		}

		$graph = new Graph(400, 300, 'auto');
		$graph->SetScale('textint');

		$graph->SetColor('aliceblue');
		$graph->SetMarginColor('white');

		$graph->xaxis->SetTickLabels(array_keys($data));
		$graph->yaxis->scale->SetGrace(20);
		$graph->title->Set($this->lang->stats_reg_by_month);

		$temp = array_values($data);
		$barplot = new BarPlot($temp);
		$barplot->SetFillColor('darkorange');

		$graph->add($barplot);
		$graph->Stroke("../stats/{$this->time}2.png");

		return $this->message($this->lang->stats,
		"<img src='../stats/{$this->time}1.png' alt='{$this->lang->stats_post_by_month}' /><br /><br />
		<img src='../stats/{$this->time}2.png' alt='{$this->lang->stats_reg_by_month}' />");
	}
}
?>
