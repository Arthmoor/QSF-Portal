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

require_once $set['include_path'] . '/global.php';

class help extends qsfglobal
{
	function execute()
	{
		$this->tree($this->lang->help_available_files);
		$this->set_title($this->lang->help_available_files);

		$h = array();
		$q = $this->db->query("SELECT help_id, help_title, help_article FROM %phelp ORDER BY help_title");

		while ($r = $this->db->nqfetch($q))
		{
			$h[] = $r;
		}

		if ($h) {
			$top = null;
			foreach ($h as $ar)
			{
				$top .= eval($this->template('HELP_SIMPLE_ENTRY'));
			}

			$desc = null;
			foreach ($h as $ar)
			{
				$desc .= eval($this->template('HELP_DESCRIPTIVE_ENTRY'));
			}

			return eval($this->template('HELP_FULL'));
		} else {
			return $this->message($this->lang->help_available_files, $this->lang->help_none);
		}
	}
}
?>
