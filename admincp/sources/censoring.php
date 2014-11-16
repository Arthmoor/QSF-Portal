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
			$token = $this->generate_token();

			$query = $this->db->query("SELECT * FROM %preplacements ORDER BY replacement_id");
			while ($word = $this->db->nqfetch($query))
			{
				$words .= str_replace('(.*?)', '*', $word['replacement_search']) . "\n";
			}

			$words = rtrim($words);

			return eval($this->template('ADMIN_CENSOR_FORM'));
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->censor, $this->lang->invalid_token );
			}

			$words = preg_replace('/[^a-zA-Z0-9\s\*"\'=]/', '', $this->post['words']);
			$words = str_replace('*', '(.*?)', $words);
			$words = explode("\n", $words);

			$this->db->query("TRUNCATE TABLE %preplacements");

			foreach ($words as $word)
			{
				$word = trim($word);
				if ($word) {
					$this->db->query("INSERT INTO %preplacements (replacement_search) VALUES ('%s')", $word);
				}
			}

			return $this->message($this->lang->censor, $this->lang->censor_updated);
		}
	}
}
?>