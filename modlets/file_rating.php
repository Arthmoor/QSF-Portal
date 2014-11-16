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

/**
 * Display a file rating, and provide a rating link.
 * Useful for download type sites.
 *
 * @author Roger Libiez [Samson]
 **/
class file_rating extends modlet
{
	var $rating;

	function show_rating( $file )
	{
		$can_rate = true;
		$has_rated = false;

		$file_rating = $this->qsf->db->fetch( "SELECT file_rating FROM %pfiles WHERE file_id=%d", $file );

                if (!$this->qsf->perms->auth('submit_files')) {
                        $can_rate = false;
                }

		if( $can_rate ) {
			$file_rated = $this->qsf->db->fetch( "SELECT file_id FROM %pfileratings WHERE user_id=%d AND file_id=%d", $this->qsf->user['user_id'] , $file );

			if( $file_rated['file_id'] == $file ) {
				$has_rated = true;
			}
		}

		if( $can_rate && !$has_rated ) {
			$rating = "<b><a href=\"{$this->qsf->self}?a=filerating&amp;f={$file}\" target=\"qsf_rating\" onclick=\"window.open('{$this->qsf->self}?a=filerating&amp;f={$file}','qsf_rating','width=400,height=200,resize,scrollbars=yes')\">Rating:</a></b> <img src=\"./skins/{$this->qsf->skin}/images/{$file_rating['file_rating']}.png\" alt=\"\" />";
		}
		else {
			$rating = "<b>Rating:</b> <img src=\"./skins/{$this->qsf->skin}/images/{$file_rating['file_rating']}.png\" alt=\"\" />";
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
