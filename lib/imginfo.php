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

require_once $set['include_path'] . '/lib/types/jpg.php';
require_once $set['include_path'] . '/lib/types/png.php';
require_once $set['include_path'] . '/lib/types/gif.php';

/**
 * Class to read image dimensions
 *
 * @author Matthew Lawrence <matt@quicksilverforums.co.uk>
 * @since 1.3.0 
 **/
class imginfo
{
	var $types = array();

	function imginfo()
	{
		$types = array('jpg', 'gif', 'png');

		foreach ($types as $type) {
			$this->types[$type] = new $type;
		}
	}

	function info($filename)
	{
		$data = file_get_contents($filename);
		$retval = array();

		foreach($this->types as $key => $obj)
		{
			$obj->load($data);

			if ($obj->isType())
			{
				$obj->process();
				
				$retval['type'] = $key;
				$retval['X'] = $obj->X;
				$retval['Y'] = $obj->Y;
				break;
			}
		}

		unset($data);

		if (!isset($retval['type']))
			return null;
		
		return $retval;
	}
}

?>
