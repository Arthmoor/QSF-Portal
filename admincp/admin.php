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
	var $iterator = 0;              // The current number of iterations @var int @access protected
	var $iterator_values = array(); // Values to be iterated @var array @access protected
	var $iterator_last;             // Last selected value @var mixed @access protected

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
	function message($title, $message, $link_text = null, $link = null, $redirect = null)
	{
		if ($link_text) {
			$message .= "<br /><br /><a href='$link'>$link_text</a>";
		}

		if ($redirect) {
			@header('Refresh: 4;url=' . $redirect);
		}

		return eval($this->template('ADMIN_MESSAGE'));
	}

	/**
	 * Starts the iterator. Parameters (unlimited) specify the values to cycle
	 *
	 * @author Jason Warner <jason@mercuryboard.com
	 * @since Beta 3.0
	 * @return void
	 */
	function iterator_init()
	{
		$this->iterator_values = func_get_args();
	}

	/**
	 * Returns the last selected value
	 *
	 * @author Jason Warner <jason@mercuryboard.com
	 * @since Beta 3.0
	 * @return mixed Last selected value
	 */
	function lastValue()
	{
		return $this->iterator_last;
	}

	/**
	 * Advances the position in the array by one
	 *
	 * @author Jason Warner <jason@mercuryboard.com
	 * @since Beta 3.0
	 * @return mixed Current value in the array
	 */
	function iterate()
	{
		if ($this->iterator >= count($this->iterator_values)) {
			$this->iterator = 0;
		}

		$ret = $this->iterator_values[$this->iterator];

		$this->iterator++;
		$this->iterator_last = $ret;
		return $ret;
	}

	/**
	 * Copies a directory and its files, recursively
	 *
	 * @param $from_path Source directory
	 * @param $to_path Destination directory
	 * @author See http://www.php.net/copy
	 * @since Beta 3.0
	 * @return bool True on success, false on failure
	 */
	function dir_copy($from_path, $to_path)
	{
		if (!file_exists($to_path)) {
			$ret = @mkdir($to_path, 0777);

			if (!$ret) {
				return false;
			}
		}

		if (file_exists($from_path) && is_dir($from_path)) {
			$handle = opendir($from_path);

			while (($file = readdir($handle)) !== false)
			{
				if (($file != '.') && ($file != '..') && ($file != 'CVS')) {
					if (is_dir($from_path . $file)) {
						$this->dir_copy($from_path . $file . '/', $to_path . $file . '/');
					}

					if (is_file($from_path . $file)) {
						copy($from_path . $file, $to_path . $file);
					}
				}
			}
			closedir($handle);
		}

		return true;
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

		if (strstr($lang, '/') || !file_exists($path . 'languages/' . $lang . '.php')) {
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

	/**
	 * Creates a heirarchial HTML list of all forums
	 *
	 * @param array $array Array of forums
	 * @param string $link Link to plug into list
	 * @param int $parent Used to degredate down through the recursive loop
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string A heirarchial HTML list of all the forums
	 **/
	function Text($array, $link = "", $parent = 0)
	{
		$arr = $this->htmlwidgets->forum_array($array, $parent);

		if ($arr) {
			$return = null;
			foreach ($arr as $val) {
				$return .= '<ul>' . "
				<li><a href='{$link}{$val['forum_id']}'>{$val['forum_name']}</a></li>" .
				$this->Text($array, $link, $val['forum_id']) . '</ul>';
			}
			return $return;
		}
	}

	/**
	 * Creates a heirarchial list of all HTML forums with an input box in front with id _$forum_id
	 *
	 * @param array $array Array of forums
	 * @param int $parent Used to degredate down through the recursive loop
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string A heirarchial HTML list of all the forums with an input box in front with id _$forum_id
	 **/
	function InputBox($array, $parent = 0)
	{
		$arr = $this->htmlwidgets->forum_array($array, $parent);

		if ($arr) {
			$return = "<ul>\n";
			foreach ($arr as $val) {
				$return .= "<li><input class='input' name='_{$val['forum_id']}' value='{$val['forum_position']}' size='2' /> {$val['forum_name']}";
				$return .= $this->InputBox($array, $val['forum_id']);
				$return .= "</li>\n";
			}
			$return .= "</ul>\n";
			return $return;
		}
	}

	/**
	 * A list of checkboxes (all forums in correct order)
	 *
	 * @param array $array Array of forums
	 * @param int $select Checkbox to check
	 * @param int $parent Used to degredate down through the recursive loop
	 * @param string $space Used to increment the spacing before the text in the box
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 4.0
	 * @return string Options for an HTML select box (all forums in correct order)
	 **/
	function CheckBox($array, $select = 0, $parent = 0, $space = '')
	{
		$arr = $this->htmlwidgets->forum_array($array, $parent);

		if ($arr) {
			$return = null;
			foreach ($arr as $val) {
				if ($val['forum_id'] == $select) {
					$selected = " checked='checked'";
				} else {
					$selected = null;
				}
				$return .= "<input type='checkbox' id='forum_{$val['forum_id']}' name='forums[{$val['forum_id']}]'{$selected} />{$space}<label for='forum_{$val['forum_id']}'>{$val['forum_name']}</label><br />\n" .
				$this->CheckBox($array, $select, $val['forum_id'], $space . '&nbsp; &nbsp; &nbsp;');
			}
			return $return;
		}
	}

	function list_groups($val, $select = 'user_group', $custom_only = false)
	{
		$out = "<select name='$select'>";

		if ($custom_only) {
			$groups = $this->db->query('SELECT group_name, group_id FROM %pgroups WHERE group_type="" ORDER BY group_name');
		} else {
			$groups = $this->db->query('SELECT group_name, group_id FROM %pgroups ORDER BY group_name');
		}

		while ($group = $this->db->nqfetch($groups))
		{
			$out .= "<option value='{$group['group_id']}'" . (($val == $group['group_id']) ? ' selected=\'selected\'' : '') . ">" . htmlspecialchars($group['group_name']) . "</option>";
		}

		return $out . '</select>';
	}

	/**
	 * Executes an array of queries
	 *
	 * @param $queries
	 * @param $db
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.0.2
	 * @return void
	 **/
	function execute_queries($queries)
	{
		foreach ($queries as $query)
		{
			$this->db->query($query);
		}
	}
}
?>
