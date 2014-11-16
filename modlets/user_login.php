<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2007 The QSF Portal Development Team
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
 * Create a quicklogin box for users to log in with.
 *
 * @author Roger Libiez [Samson] http://www.iguanadons.net
 * @since 1.3.1
 **/
class user_login extends modlet
{	
	function run($param) {
		if( $this->qsf->perms->is_guest ) {
			$this->qsf->lang->login(); // For login words
			$this->qsf->lang->register(); // For registration word

			$request_uri = $this->get_uri();
			if (substr($request_uri, -8) == 'register') {
				$request_uri = $this->qsf->self;
			}
			return eval($this->qsf->template('MAIN_USER_LOGIN'));
		}
		return "";
	}

	function get_uri()
	{
		if (!isset($this->qsf->server['REQUEST_URI'])) {
			return $this->qsf->sets['loc_of_board'];
		}

		$url = @parse_url($this->qsf->server['REQUEST_URI']);
		if ($url === false) {
			return $this->qsf->sets['loc_of_board'];
		}

		if (isset($this->query) && strpos( "http://", $this->query ) !== false ) {
			error(QUICKSILVER_NOTICE, "BAD BOT! You should know better than that!");
		}

		if (!isset($url['path'])) {
			return $this->qsf->sets['loc_of_board'];
		}

		if (!empty($url['query']) && !stristr($url['query'], 'login')) {
			return $this->qsf->format($url['path'] . (!empty($url['query']) ? '?' . $url['query'] : null), FORMAT_HTMLCHARS);
		} else {
			return $this->qsf->sets['loc_of_board'];
		}
	}
}
?>
