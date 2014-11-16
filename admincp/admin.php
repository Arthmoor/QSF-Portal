<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2015 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * http://code.google.com/p/quicksilverforums/
 * 
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 * https://github.com/markelliot/MercuryBoard
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

if (!defined('QUICKSILVERFORUMS') || !defined('QSF_ADMIN')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/global.php';

/**
 * Miscellaneous functions specific to the admin center
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.1
 */
class admin extends qsfglobal
{
	/**
	 * Post constructor initaliser. Take care of admin specific stuff
	 *
	 * @param bool $admin Set to true if we need to setup admin templates
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 **/
	function init($admin = true)
	{
		if (@file_exists('../install/index.php') && !@file_exists('../tools')) {
			exit('<h1>' . $this->lang->admin_cp_warning . '</h1>');
		}

		parent::init($admin);
		
		if (!$this->perms->auth('is_admin') || $this->is_banned()) {
			exit('<h1>' . $this->lang->admin_cp_denied . '</h1>');
		}
	}

	/**
	 * Set to admin tables
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 **/
	function set_table()
	{
		$this->table  = eval($this->template('ADMIN_TABLE'));
		$this->etable = eval($this->template('ADMIN_ETABLE'));
	}
	
	/**
	 * Formats a message (admin cp version)
	 *
	 * @param string $title Title of the message
	 * @param string $message Text of the message
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string HTML
	 */
	function message($title, $message, $link_text = null, $link = null, $redirect = null, $delay = 4)
	{
		if ($link_text) {
			$message .= "<br /><br /><a href=\"$link\">$link_text</a>";
		}

		if ($redirect) {
			@header('Refresh: 4;url=' . $redirect);
		}

		return eval($this->template('ADMIN_MESSAGE'));
	}

	/**
	 * Loads a user_language. Bet you couldn't figure that out...
	 *
	 * @param string $lang Language to load
	 * @param string $a Word set to load
	 * @param string $path Path to the user_languages directory
	 * @param bool $main Load main universal strings
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 3.0
	 * @return object Language
	 **/
	function get_lang($lang, $a = null, $path = '../', $main = true)
	{
		if (isset($this->get['lang'])) {
			$lang = $this->get['lang'];
		}

		if ( strstr($lang, '\\') || strstr($lang, '/') || !file_exists($path . 'languages/' . $lang . '.php')) {
			$lang = 'en';
		}

		include $path . 'languages/' . $lang . '.php';
		$obj = new $lang();

		// Check if language function is available before running it
		if ($a && is_callable(array($obj,$a))) {
			$obj->$a();
		}

		if ($main) {
			$obj->admin();
		}
		$obj->universal();
		return $obj;
	}

	function list_groups($val, $select = 'user_group', $custom_only = false)
	{
		$out = "<select name=\"$select\">";

		if ($custom_only) {
			$groups = $this->db->query("SELECT group_name, group_id FROM %pgroups WHERE group_type='' ORDER BY group_name");
		} else {
			$groups = $this->db->query("SELECT group_name, group_id FROM %pgroups ORDER BY group_name");
		}

		while ($group = $this->db->nqfetch($groups))
		{
			$out .= "<option value=\"{$group['group_id']}\"" . (($val == $group['group_id']) ? ' selected=\"selected\"' : '') . ">" . htmlspecialchars($group['group_name']) . "</option>";
		}

		return $out . '</select>';
	}

	/**
	 * Grabs the current list of table names in the database
	 *
	 * @author Roger Libiez [Samson] http://www.iguanadons.net
	 * @since 1.3.3
	 * @return array
	 **/
	function get_db_tables()
	{
		$tarray = array();

		// This looks a bit strange, but it will pull all of the proper prefixed tables.
		$tb = $this->db->query( "SHOW TABLES LIKE '%p%%'" );
		while( $tb1 = $this->db->nqfetch($tb) )
		{
			foreach( $tb1 as $col => $data )
				$tarray[] = $data;
		}

		return $tarray;
	}
}
?>