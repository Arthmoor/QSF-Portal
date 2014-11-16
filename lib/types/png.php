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

require_once $set['include_path'] . '/lib/types/decoder.php';

/**
 * Class read a png's dimentions
 *
 * @author Matthew Lawrence <matt@quicksilverforums.co.uk>
 * @since 1.2.2 
 **/
class png extends decoder
{

	/* returns true if data has the png signature */
	function isType()
	{
		$this->index = 0;

		if (137 != $this->read_byte()) return false;
		if ( 80 != $this->read_byte()) return false;
		if ( 78 != $this->read_byte()) return false;
		if ( 71 != $this->read_byte()) return false;
		if ( 13 != $this->read_byte()) return false;
		if ( 10 != $this->read_byte()) return false;
		if ( 26 != $this->read_byte()) return false;
		if ( 10 != $this->read_byte()) return false;

		return true;
	}

	/* extract the image dimentions */
	function process()
	{
		for ($ix = 0; $ix<30; $ix++)
		{
			if (73 != $this->read_byte())
				continue;

			if (72 == $this->read_byte() &&
			    68 == $this->read_byte() &&
			    82 == $this->read_byte())
			{
				$this->X = $this->read_long();
				$this->Y = $this->read_long();
				break;
			}
		}
	}

}

?>
