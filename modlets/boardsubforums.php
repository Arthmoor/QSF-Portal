<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005 The Quicksilver Forums Development Team
 *  http://www.quicksilverforums.com/
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
 * Generate a links to sub forums on the board view
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @version 1.0
 **/
class boardsubforums extends modlet
{
	/**
	* Display a links to subforums (if any)
	*
	* @param int forum_id to check for subforums of
	* @author Geoffrey Dunn <geoff@warmage.com>
	* @return string HTML with hyperlinks to subforums
	**/
	function run($param)
	{
	    $parent = intval($param);
	    $forums = $this->qsf->htmlwidgets->forum_array($this->qsf->htmlwidgets->forum_grab(), $parent);
	    
	    if (!$forums) return '';
	    
	    $forum_links = array();
	    foreach ($forums as $f) {
		if ($this->qsf->perms->auth('forum_view', $f['forum_id'])) {
			$forum_links[] = '<a href="' . $this->qsf->self . '?a=forum&amp;f=' . $f['forum_id'] . '">' . $f['forum_name'] . '</a>';
		}
	    }
        
	    return '<br />' . implode(', ', $forum_links);
	}
}
?>

