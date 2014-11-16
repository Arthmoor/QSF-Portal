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
 * Forum Controls
 *
 * @author Mark Elliot <mark.elliot@mercuryboard.com>
 * @since Beta 2.1
 **/
class forums extends admin
{
	/**
	 * Forum Controls
	 *
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string HTML
	 **/
	function execute()
	{
		if (!isset($this->get['s'])) {
			$this->get['s'] = '';
		}

		$forums_exist = $this->db->fetch('SELECT COUNT(forum_id) AS count FROM %pforums');

		if (!$forums_exist['count'] && ($this->get['s'] != 'add')) {
			return $this->message($this->lang->forum_controls, $this->lang->forum_none, $this->lang->forum_create, "$this->self?a=forums&amp;s=add");
		}

		switch ($this->get['s'])
		{
		case 'edit':
			$this->set_title($this->lang->forum_edit);

			if (isset($this->get['id'])) {
				$f = $this->db->fetch("SELECT forum_name, forum_description, forum_parent, forum_subcat FROM %pforums WHERE forum_id=%d", $this->get['id']);

				$this->tree('Edit a Forum', "{$this->self}?a=forums&amp;s=edit");
				$this->tree($f['forum_name']);

				if (isset($this->post['editforum'])) {
					return $this->EditForum($this->get['id']);
				} else {
					$forum = $this->htmlwidgets->select_forums($f['forum_parent']);
					return eval($this->template('ADMIN_FORUM_EDIT'));
				}
			} else {
				$this->tree($this->lang->forum_edit);
				return $this->message($this->lang->forum_edit, '<div style="text-align:left">' . $this->Text($this->htmlwidgets->forum_grab(), "$this->self?a=forums&amp;s=edit&amp;id=") . '</div>');
			}
			break;

		case 'delete':
			$this->set_title($this->lang->forum_delete);

			if (isset($this->get['id'])) {
				$f = $this->db->fetch("SELECT forum_name FROM %pforums WHERE forum_id=%d", intval($this->get['id']));

				$this->tree('Delete a Forum', "{$this->self}?a=forums&amp;s=delete");
				$this->tree($f['forum_name']);

				if (isset($this->get['confirm'])) {
					return $this->DeleteForum($this->get['id']);
				} else {
					return $this->message($this->lang->forum_delete, $this->lang->forum_delete_warning, $this->lang->forum_delete, "$this->self?a=forums&s=delete&id={$this->get['id']}&amp;confirm=1");
				}
			} else {
				$this->tree($this->lang->forum_delete);
				return $this->message($this->lang->forum_delete, '<div style="text-align:left">' . $this->Text($this->htmlwidgets->forum_grab(), "$this->self?a=forums&amp;s=delete&amp;id=") . '</div>');
			}
			break;

		case 'add':
			$this->set_title($this->lang->forum_create);
			$this->tree($this->lang->forum_create);

			if (isset($this->post['addforum'])) {
				return $this->message($this->lang->forum_create, $this->AddForum());
			} else {
				$select = $this->htmlwidgets->select_forums();

				if ($forums_exist['count']) {
					$quickperms = $select;
				} else {
					$quickperms = "<option value='-3' selected='selected'>{$this->lang->forum_default_perms}</option>";
				}
				return eval($this->template('ADMIN_FORUM_ADD'));
			}
			break;

		case 'order':
			$this->set_title($this->lang->forum_ordering);
			$this->tree($this->lang->forum_ordering);

			if (isset($this->post['orderforum'])) {
				return $this->message($this->lang->forum_ordering, $this->OrderUpdate());
			}
			$forum = $this->InputBox($this->htmlwidgets->forum_grab());
			return eval($this->template('ADMIN_FORUM_ORDER'));
			break;

		case 'count':
			$this->set_title($this->lang->forum_recount);
			$this->tree($this->lang->forum_recount);
			$this->RecountForums();
			return $this->message($this->lang->forum_recount, sprintf($this->lang->recount_forums, $this->sets['topics'], $this->sets['posts']) );
			break;
		}
	}

	/**
	 * Returns true if $check is found in the children of $id
	 *
	 * @param array $array Array of forums
	 * @param int $id Used as parent
	 * @param int $check ID of parent to check in list
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return bool True if $check is found amongst the children of $id
	 **/
	function CheckParent($array, $id, $check)
	{
		$arr = $this->htmlwidgets->forum_array($array, $id);
		if ($arr) {
			foreach ($arr as $val) {
				if ($val['forum_id'] == $check) {
					return true;
				} else {
					return $this->CheckParent($array, $val['forum_id'], $check);
				}
			}
		}
		return false;
	}

	/**
	 * Creates the list of forums preceeding $id in $array
	 *
	 * @param array $array Array of forums
	 * @param int $id Used as reference point for tree construction
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string List of forums preceding $id in $array
	 **/
	function CreateTree($array, $id)
	{
		for ($i = 0; $i < count($array); $i++) {
			if ($array[$i]['forum_id'] == $id) {
				return preg_replace('/^,/', '', $array[$i]['forum_tree'] . ",$id");
			}
		}
	}

	/**
	 * Removes forum $id as well as all posts/topics for $id
	 *
	 * @param int $id ID of forum
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string Completion message
	 **/
	function DeleteForum($id)
	{
		if ($this->htmlwidgets->forum_array($this->htmlwidgets->forum_grab(), $id)) {
			return $this->message($this->lang->forum_delete, $this->lang->forum_no_orphans);
		}

		$topics = null;

		$query = $this->db->query("SELECT topic_id FROM %ptopics WHERE topic_forum=%d", $id);
		while ($data = $this->db->nqfetch($query))
		{
			$topics .= "post_topic={$data['topic_id']} OR ";
		}

		if ($topics) {
			$this->db->query("DELETE FROM %pposts WHERE " . substr($topics, 0, -4));
			$this->db->query("DELETE FROM %ptopics WHERE topic_forum=%d", $id);
		}

		$this->db->query("DELETE FROM %pforums WHERE forum_id=%d", $id);

		$perms = new $this->modules['permissions']($this);

		// Groups
		while ($perms->get_group())
		{
			$perms->remove_z($id);
			$perms->update();
		}

		// Users
		while ($perms->get_group(true))
		{
			$perms->remove_z($id);
			$perms->update();
		}

		return $this->message($this->lang->forum_delete, $this->lang->forum_deleted);
	}

	/**
	 * Updates forum $id
	 *
	 * @param integer $id ID of forum
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string Completion message
	 **/
	function EditForum($id)
	{
		if (trim($this->post['name']) == '') {
			return $this->message($this->lang->forum_edit, $this->lang->forum_empty);
		}

		$subcat = isset($this->post['subcat']) ? 1 : 0;
		$forums = $this->htmlwidgets->forum_grab();
		if (($this->post['parent'] == $id) || $this->CheckParent($forums, $id, $this->post['parent'])) {
			return $this->message($this->lang->forum_edit, $this->lang->forum_parent);
		}

		$this->db->query("UPDATE %pforums SET
			  forum_parent=%d, forum_name='%s', forum_description='%s', forum_subcat=%d
			  WHERE forum_id=%d",
			  $this->post['parent'], $this->post['name'], $this->post['description'], $subcat, $id);

		$this->updateForumTrees();

		return $this->message($this->lang->forum_edit, $this->lang->forum_edited);
	}

	/**
	 * Adds a forum with parameters from $this->post
	 *
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string Completion message
	 **/
	function AddForum()
	{
		if (trim($this->post['name']) == '') {
			return $this->lang->forum_empty;
		}

		$forums = $this->htmlwidgets->forum_grab();

		$forums_arr = $this->htmlwidgets->forum_array($forums, $this->post['parent']);
		$position   = $forums_arr ? count($forums_arr) : 0;
		$subcat     = isset($this->post['subcat']) ? 1 : 0;

		$this->db->query("INSERT INTO %pforums
			(forum_tree, forum_parent, forum_name, forum_description, forum_position, forum_subcat) VALUES
			('%s', '%s', '%s', '%s', '%s', '%s')",
			$this->CreateTree($forums, $this->post['parent']),
			$this->post['parent'], $this->post['name'], $this->post['description'], $position, $subcat);

		$id = $this->db->insert_id("forums");

		$perms = new $this->modules['permissions']($this);

		while ($perms->get_group())
		{
			// Full permissions (note: the banned group is still false)
			if ($this->post['sync'] == -2) {
				$perms->add_z($id, ($perms->group != USER_BANNED));

			// Default permissions (only works if there are no forums already created)
			} elseif ($this->post['sync'] == -3) {
				$perms->add_z($id);

			// No permissions
			} elseif ($this->post['sync'] == -1) {
				$perms->add_z($id, false);

			// Copy another forum
			} else {
				$perms->add_z($id, false);

				foreach ($perms->standard as $perm => $false)
				{
					if (!isset($perms->globals[$perm])) {
						$perms->set_xyz($perm, $id, $perms->auth($perm, $this->post['sync']));
					}
				}
			}

			$perms->update();
		}

		return $this->lang->forum_created;
	}

	/**
	 * Updates the position of all forums based on $this->post data
	 *
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string Completion message
	 **/
	function OrderUpdate()
	{
		$q = $this->db->query("SELECT forum_id FROM %pforums ORDER BY forum_id ASC");
		while ($f = $this->db->nqfetch($q))
		{
			$this->db->query("UPDATE %pforums SET forum_position='%s' WHERE forum_id=%d",
				$this->post["_{$f['forum_id']}"], $f['forum_id']);
		}
		return $this->lang->forum_ordered;
	}
}
?>
