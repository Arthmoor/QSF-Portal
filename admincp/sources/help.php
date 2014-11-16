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
 * Help Article Control
 *
 * @author Jared Kuolt <icenine@networkstoday.com>
 * @since 1.1.0
 **/

class help extends admin
{
	function execute()
	{
		$this->set_title($this->lang->help_article);
		$this->tree($this->lang->help_article);

		if (!isset($this->get['s'])) {
			$this->get['s'] = null;
		}

		$ret = null;

		if ($this->get['s'] == 'new') {
			$link = 'a=help&amp;s=new';
		} elseif ($this->get['s'] == 'edit') {
			$link = 'a=help&amp;s=edit';
		} elseif ($this->get['s'] == 'delete') {
			$link = 'a=help&amp;s=delete';
		} else {
			$link = 'a=help';
		}

		switch($this->get['s'])
		{
		case 'new':
			if (!isset($this->post['submit'])) {
				return $this->message($this->lang->help_add,"
				<form action='{$this->self}?a=help&amp;s=new&amp;' method='post'><div>
				<b>{$this->lang->help_title}:</b><br />
				<input name='title' type='text' size='40' class='input' /><br /><br />
				<b>{$this->lang->help_content}</b>
				<textarea name='article' cols='100' rows='15' id='article' class='input'></textarea><br /><br />
				<input type='submit' name='submit' value='{$this->lang->submit}' /></div>
				</form>");
			} else {
				if (trim($this->post['title']) == '') {
					return $this->message($this->lang->help_add, $this->lang->help_no_title);
				}

				$query = $this->db->query("INSERT INTO %phelp VALUES ('', '%s', '%s')", $this->post['title'], $this->post['article']);

				return $this->message($this->lang->help_add, $this->lang->help_inserted);
			}
			break;

		case 'edit':
			if (!isset($this->get['id'])) {
				$query = $this->db->query("SELECT help_id, help_title FROM %phelp ORDER by help_title DESC");

				if (!$this->db->num_rows($query)) {
					return $this->message($this->lang->help_edit, $this->lang->help_no_articles);
				} else {
					while ($file = $this->db->nqfetch($query))
					{
						$title = $this->format($file['help_title'], FORMAT_HTMLCHARS);
						$ret .= "<a href='{$this->self}?$link&amp;id=" . $file['help_id'] . "'>{$title}</a><br />";
					}

					return $this->message($this->lang->help_edit, "{$this->lang->help_select}:<br /><br />$ret");
				}
			} else {
				if (!isset($this->post['submit'])) {
					$id = intval($this->get['id']);

					$query = $this->db->query("SELECT * FROM %phelp WHERE help_id=%d", $id);

					if (!$this->db->num_rows($query)) {
						return $this->message($this->lang->help_edit, $this->lang->help_not_exist);
					} else {
						$content = $this->db->nqfetch($query);

						$title   = $this->format($content['help_title'], FORMAT_HTMLCHARS);
						$article = $this->format($content['help_article'], FORMAT_HTMLCHARS);

						return $this->message($this->lang->help_edit, "
						<form action='{$this->self}?a=help&amp;s=edit&amp;id={$id}' method='post'><div>
						<b>{$this->lang->help_title}:</b><br />
						<input name='title' type='text' value='{$title}' size='40' class='input' /><br /><br />
						<b>{$this->lang->help_content}:</b><br />
						<textarea name='article' cols='100' rows='15' id='article' class='input'>{$article}</textarea>
						<input type='submit' name='submit' value='{$this->lang->submit}' /></div>
						</form>");
					}
				} else {
					$id = intval($this->get['id']);

					if (trim($this->post['title']) == '') {
						return $this->message($this->lang->help_add, $this->lang->help_no_title);
					}

					$query = $this->db->query("UPDATE %phelp SET help_title='%s', help_article='%s' WHERE help_id=%d",
						$this->post['title'], $this->post['article'], $id);

					return $this->message($this->lang->help_edit, $this->lang->help_edited);
				}
			}
			break;

		case 'delete':
			if (!isset($this->post['submit'])) {
				if(!isset($this->get['id'])){
					$query = $this->db->query("SELECT help_id, help_title FROM %phelp ORDER by help_title DESC");

					if (!$this->db->num_rows($query)) {
						return $this->message($this->lang->help_delete, $this->lang->help_no_articles);
					} else {
						while ($file = $this->db->nqfetch($query))
						{
							$ret .= "<a href='$this->self?$link&amp;id=" . $file['help_id'] . "'>{$file['help_title']}</a><br />";
						}

						return $this->message($this->lang->help_delete, "{$this->lang->help_select_delete}:<br /><br />$ret");
					}
				} else {
					$query   = $this->db->query("SELECT help_id, help_title FROM %phelp WHERE help_id=%d", intval($this->get['id']));
					$content = $this->db->nqfetch($query);

					$ret = "{$this->lang->help_confirm} <b>{$content['help_title']}</b>?<br /><br />
							<form action='{$this->self}?a=help&amp;s=delete&amp;id={$this->get['id']}' method='post'><div>
							<input type='submit' name='submit' value='{$this->lang->delete}' /></div>
							</form>";

					return $this->message($this->lang->help_delete, $ret);
				}

			} else {
				$query = $this->db->query("DELETE FROM %phelp WHERE help_id=%d", intval($this->get['id']));
				return $this->message($this->lang->help_delete, $this->lang->help_deleted);
			}
			break;
		}
	}
}
?>
