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
 * Class read a jpeg's dimentions
 *
 * @author Matthew Lawrence <matt@quicksilverforums.co.uk>
 * @since 1.2.2 
 **/
class jpg extends decoder
{

	/* returns true if data is of a jpeg type 
	 * NOTE: we only check if the file is a jfif file type! */
	function isType()
	{
		$this->index = 0;

		/* magic jfif numbers */
		if (0xFF == $this->read_byte() && 0xD8 == $this->read_byte())
			return true;

		return false;
	}

	/* extract the image dimentions */
	function process()
	{
		/* search for the frame block */
		$wanting = 0xC0;
		
		$dat = array();

		/* if it's not in the first 30 blocks then stuff it */
		for ($ix = 0; $ix < 30; $ix++)
		{/* TODO: if anyone wants to do it a better way then feel free. */
			$dat[0] = $this->read_byte();
			$dat[1] = $this->read_byte();
			$dat[2] = $this->read_short();

			if ($wanting == $dat[1])
			{
				$p  = $this->read_byte();
				$this->Y = $this->read_short();
				$this->X = $this->read_short();
				break;
			}

			$this->seek_fwd($dat[2]-2);
		}
	}

}

?>
