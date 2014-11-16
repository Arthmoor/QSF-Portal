<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2010 The QSF Portal Development Team
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

 if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

/**
 * Simple script that can include a php or html file
 * The output is buffered and returned
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @since 1.3.1
 **/
class mod_include extends modlet
{
	/**
	 * Include a specified file
	 *
	 * @param string File to include
	 * @return string HTML to return
	**/
	function run($param)
	{
		if (!is_readable($param)) {
			return "<!-- ERROR: cannot open file $param -->";
		}

		ob_start();

		include $param;

		$text = ob_get_contents();

		ob_end_clean();

		return $text;
	}
}
?>
