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

require_once $set['include_path'] . '/admincp/admin.php';

/**
 * Word censoring controls
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 3.0
 **/
class censoring extends admin
{
	/**
	 * Provides controls for censoring words
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 3.0
	 * @return string HTML form or message
	 **/
	function execute()
	{
		$this->set_title($this->lang->censor);
		$this->tree($this->lang->censor);

		if (!isset($this->post['submit'])) {
			$words = null;

			$query = $this->db->query("SELECT * FROM %preplacements WHERE replacement_type='censor' ORDER BY replacement_id");
			while ($word = $this->db->nqfetch($query))
			{
				$words .= str_replace('(.*?)', '*', $word['replacement_search']) . "\n";
			}

			$words = rtrim($words);

			return eval($this->template('ADMIN_CENSOR_FORM'));
		} else {
			$words = preg_replace('/[^a-zA-Z0-9\s\*"\'=]/', '', $this->post['words']);
			$words = str_replace('*', '(.*?)', $words);
			$words = explode("\n", $words);

			$this->db->query("DELETE FROM %preplacements WHERE replacement_type='censor'");

			foreach ($words as $word)
			{
				$word = trim($word);
				if ($word) {
					$this->db->query("INSERT INTO %preplacements (replacement_search, replacement_replace, replacement_type) VALUES ('%s', '', 'censor')", $word);
				}
			}

			return $this->message($this->lang->censor, $this->lang->censor_updated);
		}
	}
}
?>
