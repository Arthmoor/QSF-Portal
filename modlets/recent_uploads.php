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
 * Create a ul of recent uploads.
 * TODO: figure out how to make links to the files.
 *
 * @author Asylumius (asylumius@gmail.com) 2006
 * @since 1.2.2
 **/
class recent_uploads extends modlet
{	
	function run() {
		$content = "";
		$result = $this->qsf->db->query(
		  "SELECT f.*, u.user_name, c.fcat_name
		    FROM
		     %pfiles f
		    LEFT JOIN %pusers u ON u.user_id = f.file_submitted
		    LEFT JOIN %pfile_categories c ON c.fcat_id = f.file_catid
		    WHERE file_approved=1 ORDER BY file_date DESC LIMIT 5" );
		
		while($file = $this->qsf->db->nqfetch($result))
		{
			$filesize = ceil($file['file_size'] / 1024);
			$fname = $this->qsf->format($file['file_name'], FORMAT_HTMLCHARS );
			$title = "Downloads: {$file['file_downloads']}  Size: {$filesize} KB";

			$content .= "<a href=\"". $this->qsf->self . "?a=files&amp;s=viewfile&amp;fid={$file['file_id']}\" title=\"{$title}\">{$fname}</a>";
			$content .= "<br />Author: {$file['file_author']}<br />Submitted by: <a href=\"{$this->qsf->self}?a=profile&amp;w={$file['file_submitted']}\">{$file['user_name']}</a><hr />";
		}
		return eval($this->qsf->template('MAIN_RECENT_UPLOADS'));
	}
}
?>
