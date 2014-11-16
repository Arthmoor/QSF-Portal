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
 * Modify the files link with number of pending approvals.
 * This modlet borrows alot of duplicated code from the files.php module.
 *
 * @author Roger Libiez <Samson>
 * @since 1.2.2
 **/
class codelink extends modlet
{
	var $cat_array; // Used to generate category trees

	function category_array()
	{
		if( $this->cat_array === false ) {
			$this->cat_array = array();

			$q = $this->qsf->db->query( "SELECT * FROM %pfile_categories ORDER BY fcat_name" );

			while ($f = $this->qsf->db->nqfetch($q))
			{
				$this->cat_array[$f['fcat_id']] = $f;
			}
			return $this->cat_array;
		}
		return $this->cat_array;
	}

	function get_subcat($cid)
	{
                $query = $this->qsf->db->query( "SELECT fcat_parent FROM %pfile_categories WHERE fcat_id=%d", $cid );
                if ($row = $this->qsf->db->nqfetch( $query ) ) {
                        return $row['fcat_parent'];
                }
	}

	/*
	 * Runs the category array to see if the current user is the moderator of category $cid.
	 */
	function is_moderator($cats, $cid)
	{
		if( $this->qsf->perms->auth('is_admin') )
			return true;

		if( $cid == 0 )
			return false;

		// First pass: Category is directly assigned to user.
		foreach( $cats as $category )
		{
			if( $category['fcat_id'] == $cid && $category['fcat_moderator'] == $this->qsf->user['user_id'] )
				return true;
		}

		// Second pass: Climb up the category tree and see if this user moderates the parent.
		// Moderating the parent means you moderate all of its children too.
		$onCat = $cid;
		while( $parent = $cats[$onCat]['fcat_parent'] )
		{
			if( $cats[$parent]['fcat_moderator'] == $this->qsf->user['user_id'] )
				return true;
			if( $parent == 0 )
				break;
			$onCat = $parent;
		}
		return false;
	}

	function get_count()
	{
		$count = 0;

		if($this->qsf->perms->auth('is_admin'))
			return $this->qsf->sets['code_approval'];

		if($this->qsf->perms->auth('is_guest'))
			return 0;

		$cats = $this->category_array();
		$query = $this->qsf->db->query( "SELECT file_catid FROM %pfiles WHERE file_approved=0" );
		while( $file = $this->qsf->db->nqfetch($query) )
		{
			if( !$this->is_moderator( $cats, $file['file_catid'] ) )
				continue;
			$count++;
		}
		return $count;
	}

	function run($param)
	{
		static $cat_array = false;
		$this->cat_array = &$cat_array;

		$text = '';

		$newcount = $this->get_count();

		switch($param)
		{
			case 'class':
				if ($newcount != 0) {
					$text = 'navbold';
				} else {
					$text = 'nav';
				}
			break;

			case 'text':
				if ($newcount != 0) {
					$text = " ({$newcount} {$this->qsf->lang->main_new})";
				}
			break;

			default:
				$text = '<!-- ERROR: Invalid paramter: ' . htmlspecialchars($param) . ' passed to modlet codelink -->';
			break;
		}
		return $text;
	}
}
?>
