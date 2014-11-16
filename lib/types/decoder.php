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
 * Interface to decide what a file is and it's dimentions
 *
 * @author Matthew Lawrence <matt@quicksilverforums.co.uk>
 * @since 1.2.2 
 **/
class decoder
{
	var $data;
	var $index;

	var $X;
	var $Y;

	function read($bytes)
	{
		$offset = $this->index;
		$this->index += $bytes;
		return substr($this->data, $offset, $bytes);
	}

	function read_byte()
	{
		$b1 = unpack('C', $this->read(1));
		return $b1[1];
	}
	
	function read_short()
	{/* big */
		$s1 = unpack('n', $this->read(2));
		return $s1[1];
	}

	function read_short2()
	{/* little */
		$s1 = unpack('v', $this->read(2));
		return $s1[1];
	}
	
	function read_long()
	{
		$l1 = unpack('N', $this->read(4));
		return $l1[1];
	}

	function seek_fwd($nbytes)
	{
		$this->index += $nbytes;
	}

	function load(&$data)
	{
		$this->data = $data;
	}

	function isType($bin)
	{
		return false;
	}

	function process()
	{
		$this->X = -1;
		$this->Y = -1;
		return false;
	}
}

?>
