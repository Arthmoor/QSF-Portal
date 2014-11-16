<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2015 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * http://code.google.com/p/quicksilverforums/
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

		$help = $this->db->query("SELECT help_id, help_title, help_article FROM %phelp");

		$top = null;
		$desc = null;
		while ($row = $this->db->nqfetch($help))
		{
			$params = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_MBCODE;

			$id = $row['help_id'];
			$title = $this->format( $row['help_title'], FORMAT_HTMLCHARS );
			$article = $this->format( $row['help_article'], $params );

			$top .= eval($this->template('HELP_SIMPLE_ENTRY'));
			$desc .= eval($this->template('HELP_DESCRIPTIVE_ENTRY'));
		}

		if( $top != null )
			return eval($this->template('HELP_FULL'));
		else
			return $this->message($this->lang->help_available_files, $this->lang->help_none);
	}
}
?>