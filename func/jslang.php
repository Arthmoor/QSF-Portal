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

require_once $set['include_path'] . '/global.php';
require_once $set['include_path'] . '/lib/JSON.php';

/**
 * Returns JS language data as JSON formatted data
 **/
class jslang extends qsfglobal
{
	/**
	 * Main interface. Get a JSON feed of language variables
	 *
	 * @since 1.3.0
	 * @return string rss output
	 **/
	function execute()
	{
		$this->nohtml = true;
		
		$json = new Services_JSON();
		
		// Add in the height and width settings
		$this->lang->sets = array();
		$this->lang->sets['avatar_width'] = $this->sets['avatar_width'];
		$this->lang->sets['avatar_height'] = $this->sets['avatar_height'];
		
		return $json->encode($this->lang);
	}
	
}
?>
