<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2010 The QSF Portal Development Team
 * http://www.qsfportal.com/
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
 * Create a ul of recent uploads.
 * TODO: figure out how to make links to the files.
 *
 * @author Asylumius (asylumius@gmail.com) 2006
 * @since 1.2.2
 **/
class recent_uploads extends modlet
{
	var $cat_data;

	function run($param)
	{
		$this->cat_data = false;
		$content = "";

		$cats = $this->create_category_permissions_string();

		// Handle the unlikely case where the user cannot view ANY forums
		if ($cats == "") {
			return $content;
		}

		$result = $this->qsf->db->query(
		  "SELECT f.*, u.user_name, c.fcat_name
		    FROM
		     %pfiles f
		    LEFT JOIN %pusers u ON u.user_id = f.file_submitted
		    LEFT JOIN %pfile_categories c ON c.fcat_id = f.file_catid
		    WHERE file_approved=1 AND c.fcat_id IN (%s) ORDER BY file_date DESC LIMIT 5", $cats );
		
		while($file = $this->qsf->db->nqfetch($result))
		{
			$filesize = ceil($file['file_size'] / 1024);
			$fname = $this->qsf->format($file['file_name'], FORMAT_CENSOR | FORMAT_HTMLCHARS );
			$title = "Downloads: {$file['file_downloads']}  Size: {$filesize} KB";
			$author = $this->qsf->format($file['file_author'], FORMAT_CENSOR | FORMAT_HTMLCHARS );

			$content .= "<a href=\"". $this->qsf->self . "?a=files&amp;s=viewfile&amp;fid={$file['file_id']}\" title=\"{$title}\">{$fname}</a>";
			$content .= "<br />Author: {$author}<br />Submitted by: <a href=\"{$this->qsf->self}?a=profile&amp;w={$file['file_submitted']}\">{$file['user_name']}</a><hr />";
		}
		return eval($this->qsf->template('MAIN_RECENT_UPLOADS'));
	}

	/**
	 * Get a list of forums the user can view
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return string comma delimited list for us in SQL
	 **/
	function create_category_permissions_string()
	{
		$categories = array();
		$allCats = $this->_load_cat_data();
		
		foreach ($allCats as $row)
		{
			if ($this->qsf->file_perms->auth('category_view', $row['fcat_id']))
			{
				$categories[] = $row['fcat_id'];
			}
		}
		return implode(', ', $categories);
	}

	/**
	 * Load the forum data into a static array so we don't have to run
	 * multiple queries for the same data
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2.0
	 **/
	function _load_cat_data()
	{
		if ($this->cat_data === false) {
			$this->cat_data = array();
			
			$q = $this->qsf->db->query("SELECT * FROM %pfile_categories");

			while ($f = $this->qsf->db->nqfetch($q))
			{
				$this->cat_data[] = $f;
			}
		}
		return $this->cat_data;
	}
}
?>