<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2007 The QSF Portal Development Team
 * http://www.qsfportal.com/
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2006 The Quicksilver Forums Development Team
 * http://www.quicksilverforums.com/
 * 
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 * http://www.mercuryboard.com/
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

class perms extends admin
{
	function execute()
	{
		$perms_obj = new $this->modules['permissions']($this);

		if (isset($this->get['s']) && ($this->get['s'] == 'user')) {
			if (!isset($this->get['id'])) {
				header("Location: $this->self?a=member&amp;s=perms");
			}

			$this->post['group'] = intval($this->get['id']);

			$mode  = 'user';
			$title = 'User Control';
			$link  = '&amp;s=user&amp;id=' . $this->post['group'];

			$perms_obj->get_perms(-1, $this->post['group']);
		} else {
			if (!isset($this->post['group'])) {
				return $this->message('User Groups', "
				<form action='$this->self?a=perms' method='post'><div>
					{$this->lang->perms_edit_for}
					<select name='group'>
					" . $this->htmlwidgets->select_groups(-1) . "
					</select>
					<input type='submit' value='{$this->lang->submit}' /></div>
				</form>");
			}

			$this->post['group'] = intval($this->post['group']);

			$mode  = 'group';
			$title = $this->lang->perms_title;
			$link  = null;

			$perms_obj->get_perms($this->post['group'], -1);
		}

		$this->set_title($title);
		$this->tree($title);

		$forums_only = $this->db->query("SELECT forum_id, forum_name FROM %pforums ORDER BY forum_name");

		$forums_list = array();
		while ($forum = $this->db->nqfetch($forums_only))
		{
			$forums_list[] = $forum;
		}

		$perms = array(
				'board_view'		=> $this->lang->perms_board_view,
				'board_view_closed'	=> $this->lang->perms_board_view_closed,
				'do_anything'		=> $this->lang->perms_do_anything,
				'is_admin'		=> $this->lang->perms_is_admin,
				'edit_avatar'		=> $this->lang->perms_edit_avatar,
				'edit_profile'		=> $this->lang->perms_edit_profile,
				'edit_sig'		=> $this->lang->perms_edit_sig,
				'page_edit'             => $this->lang->perms_edit_pages, // Added for CMS
				'page_create'           => $this->lang->perms_create_pages, // Added for CMS
				'page_delete'           => $this->lang->perms_delete_pages, // Added for CMS
				'email_use'		=> $this->lang->perms_email_use,
				'topic_global'		=> $this->lang->perms_topic_global,
				'pm_noflood'		=> $this->lang->perms_pm_noflood,
				'search_noflood'	=> $this->lang->perms_search_noflood,
				'forum_view'		=> $this->lang->perms_forum_view,
				'post_viewip'		=> $this->lang->perms_post_viewip,
				'topic_view'		=> $this->lang->perms_topic_view,
				'topic_view_unpublished' => $this->lang->perms_topic_view_unpublished,
				'poll_create'		=> $this->lang->perms_poll_create,
				'poll_vote'		=> $this->lang->perms_poll_vote,
				'post_create'		=> $this->lang->perms_post_create,
				'topic_create'		=> $this->lang->perms_topic_create,
				'post_inc_userposts'	=> $this->lang->perms_post_inc_userposts,
				'post_noflood'		=> $this->lang->perms_post_noflood,
				'post_delete'		=> $this->lang->perms_post_delete,
				'post_delete_own'	=> $this->lang->perms_post_delete_own,
				'topic_delete'		=> $this->lang->perms_topic_delete,
				'topic_delete_own'	=> $this->lang->perms_topic_delete_own,
				'post_edit'		=> $this->lang->perms_post_edit,
				'post_edit_own'		=> $this->lang->perms_post_edit_own,
				'topic_edit'		=> $this->lang->perms_topic_edit,
				'topic_edit_own'	=> $this->lang->perms_topic_edit_own,
				'topic_lock'		=> $this->lang->perms_topic_lock,
				'topic_lock_own'	=> $this->lang->perms_topic_lock_own,
				'topic_unlock'		=> $this->lang->perms_topic_unlock,
				'topic_unlock_mod'	=> $this->lang->perms_topic_unlock_mod,
				'topic_unlock_own'	=> $this->lang->perms_topic_unlock_own,
				'topic_pin'		=> $this->lang->perms_topic_pin,
				'topic_pin_own'		=> $this->lang->perms_topic_pin_own,
				'topic_publish'		=> $this->lang->perms_topic_publish,
				'topic_publish_auto'	=> $this->lang->perms_topic_publish_auto,
				'topic_split'		=> $this->lang->perms_topic_split,
				'topic_split_own'	=> $this->lang->perms_topic_split_own,
				'topic_unpin'		=> $this->lang->perms_topic_unpin,
				'topic_unpin_own'	=> $this->lang->perms_topic_unpin_own,
				'topic_move'		=> $this->lang->perms_topic_move,
				'topic_move_own'	=> $this->lang->perms_topic_move_own,
				'post_attach'		=> $this->lang->perms_post_attach,
				'post_attach_download'	=> $this->lang->perms_post_attach_download
		);

		if (!isset($this->post['submit'])) {
			$count = count($forums_list) + 1;

			if ($mode == 'user') {
				$query = $this->db->fetch("SELECT user_name, user_perms FROM %pusers WHERE user_id=%d", $this->post['group']);
				$label = "{$this->lang->perms_user} '{$query['user_name']}'";
			} else {
				$query = $this->db->fetch("SELECT group_name FROM %pgroups WHERE group_id=%d", $this->post['group']);
				$label = "{$this->lang->perms_group} '{$query['group_name']}'";
			}

			$out = "
			<script type='text/javascript'>
			<!--
			function checkrow(element, check)
			{
				var elements = document.forms['form'].elements;
				var count    = elements.length;

				for (var i=0; i<count; i++) {
					var current = elements[i];
					var temp = current.name.split('[');

					if (!temp[1]) continue;
					temp2 = temp[1].split(']');

					if (temp2[0] == element) {
						current.checked = check;
					}
				}
			}

			function changeall(element, check)
			{
				if (!check) {
					checkallbox(element, false);
				} else if (areallchecked(element)) {
					checkallbox(element, true);
				}
			}

			function checkallbox(element, check)
			{
				var elements = document.forms['form'].elements;
				var count    = elements.length;

				var allchecked = true;

				for (var i=0; i<count; i++) {
					var current = elements[i];

					if (current.name == ('perms[' + element + '][-1]')) {
						current.checked = check;
					}
				}
			}

			function areallchecked(element)
			{
				var elements = document.forms['form'].elements;
				var count    = elements.length;

				var allchecked = true;

				for (var i=0; i<count; i++) {
					var current = elements[i];

					if (current.name == ('perms[' + element + '][-1]')) {
						continue;
					}

					var temp = current.name.split('[');

					if (!temp[1]) continue;
					temp2 = temp[1].split(']');

					if (temp2[0] == element) {
						if (!current.checked) {
							allchecked = false;
							break;
						}
					}
				}

				return allchecked;
			}
			//-->
			</script>

			<form id='form' action='$this->self?a=perms$link' method='post'>
			<div align='center'><span style='font-size:14px;'><b>" . $this->lang->perms_for . " $label</b></span>";

			if ($mode == 'user') {
				$out .= "<br />{$this->lang->perms_override_user}<br /><br />
				<div style='border:1px dashed #ff0000; width:25%; padding:5px'><input type='checkbox' name='usegroup' id='usegroup' style='vertical-align:middle'" . (!$query['user_perms'] ? ' checked' : '') . " /> <label for='usegroup' style='vertical-align:middle'>{$this->lang->perms_only_user}</label></div>";
			}

			$out .= "</div>" .
			$this->table . "
			<tr>
				<td colspan='" . ($count + 1) . "' class='header'>$label</td>
			</tr>";

			$out .= $this->show_headers($forums_list);

			$this->iterator_init('tablelight', 'tabledark');

			$i = 0;
			foreach ($perms as $perm => $label)
			{
				$out .= "
				<tr>
					<td class='" . $this->iterate() . "'>$label</td>
					<td class='" . $this->lastValue() . "' align='center'>
						<input type='checkbox' name='perms[$perm][-1]' id='perms_{$perm}' onclick='checkrow(\"$perm\", this.checked)'" . ($perms_obj->auth($perm) ? ' checked=\'checked\'' : '') . " />All
					</td>";

				if (!isset($perms_obj->globals[$perm])) {
					foreach ($forums_list as $forum)
					{
						if ($perms_obj->auth($perm, $forum['forum_id'])) {
							$checked = " checked='checked'";
						} else {
							$checked = '';
						}

						$out .= "\n<td class='" . $this->lastValue() . "' align='center'><input type='checkbox' name='perms[$perm][{$forum['forum_id']}]' onclick='changeall(\"$perm\", this.checked)'$checked /></td>";
					}
				} elseif ($forums_list) {
					$out .= "\n<td class='" . $this->lastValue() . "' colspan='$count' align='center'>N/A</td>";
				}

				$out .= "
				</tr>";

				$i++;
				if (($i % 12) == 0) {
					$out .= $this->show_headers($forums_list);
				}
			}

			return $out . "
			<tr>
				<td colspan='" . ($count + 1) . "' class='footer' align='center'><input type='hidden' name='group' value='{$this->post['group']}' /><input type='submit' name='submit' value='Update Permissions' /></td>
			</tr>" . $this->etable . "</form>";
		} else {
			if (($mode == 'user') && isset($this->post['usegroup'])) {
				$perms_obj->cube = '';
				$perms_obj->update();
				return $this->message($this->lang->perms, $this->lang->perms_user_inherit);
			}

			$perms_obj->reset_cube(false);

			if (!isset($this->post['perms'])) {
				$this->post['perms'] = array();
			}

			foreach ($this->post['perms'] as $name => $data)
			{
				if (isset($data[-1]) || isset($data['-1']) || (count($data) == count($forums_list))) {
					$perms_obj->set_xy($name, true);
				} else {
					foreach ($data as $forum => $on)
					{
						$perms_obj->set_xyz($name, intval($forum), true);
					}
				}
			}

			$perms_obj->update();

			return $this->message($this->lang->perms, $this->lang->perms_updated);
		}
	}

	function show_headers($forums_list)
	{
		$out = "<tr>
		<td class='subheader' colspan='2' valign='bottom'>{$this->lang->perm}</td>";

		foreach ($forums_list as $forum)
		{
			$out .= "\n<td class='subheader' align='center' valign='middle'>{$forum['forum_name']}</td>";
		}

		return $out . '</tr>';
	}
}
?>
