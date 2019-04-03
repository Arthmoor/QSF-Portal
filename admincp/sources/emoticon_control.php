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
 * https://github.com/Arthmoor/Quicksilver-Forums
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

class emoticon_control extends admin
{
	function execute()
	{
		if (!isset($this->get['s'])) {
			$this->get['s'] = null;
		}

		switch($this->get['s'])
		{
		case null:
		case 'edit':
			$this->set_title($this->lang->emote);
			$this->tree($this->lang->emote);

			$out = null;
			$edit_id = isset($this->get['edit']) ? intval($this->get['edit']) : 0;
			$delete_id = isset($this->get['delete']) ? intval($this->get['delete']) : 0;

			if (isset($this->get['delete'])) {
				$this->db->query('DELETE FROM %pemoticons WHERE emote_id=%d', $delete_id );
			}

			if (!isset($this->get['edit'])) {
				$this->get['edit'] = null;
			}

			if (isset($this->post['submit']) && (trim($this->post['new_string']) != '') && (trim($this->post['new_image']) != '')) {
				$new_click = intval( isset($this->post['new_click']) );
				$this->db->query("UPDATE %pemoticons SET emote_string='%s', emote_image='%s', emote_clickable=%d WHERE emote_id=%d",
					$this->post['new_string'], $this->post['new_image'], $new_click, $edit_id );
				$this->get['edit'] = null;
			}

			$query = $this->db->query('SELECT * FROM %pemoticons ORDER BY emote_clickable,emote_string ASC');
			while ($data = $this->db->nqfetch($query))
			{
				$em_id = $data['emote_id'];
				$em_string = $data['emote_string'];
				$em_image = $data['emote_image'];
				$em_clickable = $this->lang->yes;
				if( $data['emote_clickable'] == 0 )
					$em_clickable = $this->lang->no;

				$em_edit = '<a href="' . $this->site . '/admincp/index.php?a=emoticon_control&amp;s=edit&amp;edit=' . $data['emote_id'] . '">' . $this->lang->edit . '</a>';
				$em_delete = '<a href="' . $this->site . '/admincp/index.php?a=emoticon_control&amp;s=edit&amp;delete=' . $data['emote_id'] . '">' . $this->lang->delete . '</a>';

				if ( !$this->get['edit'] || ($edit_id != $data['emote_id']) ) {
					$img_src = '<img src="' . $this->site . '/emoticons/' . $em_image . '" alt="' . $em_string . '" />';
					$out .= eval($this->template('ADMIN_EMOTICONS_DISPLAY'));
				} else {
					$checked = '';
					if( $data['emote_clickable'] == 1 )
						$checked = 'checked';

					$img_src = '<img name="emot_preview" src="' . $this->site . '/emoticons/' . $em_image . '" alt="' . $em_string . '" />';
					$em_list = $this->list_emoticons( $em_image );
					$out .= eval($this->template('ADMIN_EMOTICONS_EDIT'));
				}
			}

			$form_action = $this->site . '/admincp/index.php?a=emoticon_control&amp;s=edit&amp;edit=' . $edit_id;
			$add_form_action = $this->site . '/admincp/index.php?a=emoticon_control&amp;s=add';
			$em_add_list = $this->list_emoticons( 'New' );

			return eval($this->template('ADMIN_EMOTICONS_EDIT_CONTROL'));
			break;

		case 'add':
			$this->set_title($this->lang->emote_add);
			$this->tree($this->lang->emote_add);

			if (!isset($this->post['submit'])) {
				$this->get['s'] = null;
				$this->execute();
				return;
			} else {
				$new_clickable = intval( isset($this->post['new_click']) );
				$new_string = isset($this->post['new_string']) ? $this->post['new_string'] : '';

				if (trim($new_string) == '') {
					return $this->message($this->lang->emote_add, $this->lang->emote_no_text);
				}

				$new_image = '';
				if( $this->post['existing_image'] != 'New' )
					$new_image = $this->post['existing_image'];
				else {
					if( isset( $this->files['new_image'] ) && $this->files['new_image']['error'] == UPLOAD_ERR_OK ) {
						$fname = $this->files['new_image']['tmp_name'];
						$system = explode( '.', $this->files['new_image']['name'] );
						$ext = strtolower(end($system));

						if ( !preg_match( '/jpg|jpeg|png|gif/', $ext ) ) {
							return $this->message( $this->lang->emote_add, sprintf($this->lang->emote_invalid_image, $ext) );
						} else {
							$new_fname = '../emoticons/' . $this->files['new_image']['name'];
							if ( !move_uploaded_file( $fname, $new_fname ) )
								return $this->message( $this->lang->emote_add, $this->lang->emote_image_failed );
							else
								$new_image = $this->files['new_image']['name'];
						}
					}
				}

				$this->db->query("INSERT INTO %pemoticons (emote_string, emote_image, emote_clickable) VALUES ('%s', '%s', %d )", $new_string, $new_image, $new_clickable );

				return $this->message($this->lang->emote_add, $this->lang->emote_added, $this->lang->emote_back, $this->site . '/admincp/index.php?a=emoticon_control' );
			}
			break;
		}
	}

	function list_emoticons($select)
	{
		$dirname = "../emoticons/";

		$out = null;
		$files = array();

		if( $select == 'New' )
			$out .= '\n<option value="New" selected="selected">New</option>';

		$dir = opendir($dirname);
		while (($emo = readdir($dir)) !== false)
		{
			$ext = substr($emo, -3);
			if (($ext != 'png')
			&& ($ext != 'gif')
			&& ($ext != 'jpg')) {
				continue;
			}

			if (is_dir($dirname . $emo)) {
				continue;
			}

			$files[] = $emo;
		}

		sort($files);

		foreach( $files as $key => $name ) {
			$out .= "\n<option value='$name'" . (($name == $select) ? ' selected' : '') . ">$name</option>";
		}
		return $out;
	}
}
?>