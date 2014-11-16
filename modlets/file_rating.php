<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2008 The QSF Portal Development Team
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

/**
 * Display a file rating, and provide a rating link.
 * Useful for download type sites.
 *
 * @author Roger Libiez [Samson] http://www.iguanadons.net
 **/
class file_rating extends modlet
{
	var $rating;

	function show_rating( $file )
	{
		$can_rate = true;
		$has_rated = false;

		$file_rating = $this->qsf->db->fetch( "SELECT file_rating, file_catid FROM %pfiles WHERE file_id=%d", $file );

                if (!$this->qsf->file_perms->auth('upload_files', $file_rating['file_catid'])) {
                        $can_rate = false;
                }

		if( $can_rate ) {
			$file_rated = $this->qsf->db->fetch( "SELECT file_id FROM %pfileratings WHERE user_id=%d AND file_id=%d", $this->qsf->user['user_id'] , $file );

			if( $file_rated['file_id'] == $file ) {
				$has_rated = true;
			}
		}

		if( $can_rate && !$has_rated ) {
			$rating = "<b><a href=\"{$this->qsf->self}?a=filerating&amp;f={$file}\" target=\"qsf_rating\" onclick=\"window.open('{$this->qsf->self}?a=filerating&amp;f={$file}','qsf_rating','width=400,height=200,resize,scrollbars=yes')\">{$this->qsf->lang->files_rating}:</a></b> <img src=\"./skins/{$this->qsf->skin}/images/{$file_rating['file_rating']}.png\" alt=\"\" />";
		}
		else {
			$rating = "<b>{$this->qsf->lang->files_rating}:</b> <img src=\"./skins/{$this->qsf->skin}/images/{$file_rating['file_rating']}.png\" alt=\"\" />";
		}
		return $rating;
	}

	function run( $arg )
	{
		$file = intval( $arg );

		$this->rating = $this->show_rating( $file );
		return $this->rating;
	}
}
?>
