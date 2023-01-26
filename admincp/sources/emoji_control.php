<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2019 The QSF Portal Development Team
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

if( !defined( 'QUICKSILVERFORUMS' ) || !defined( 'QSF_ADMIN' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';

class emoji_control extends admin
{
	public function execute()
	{
		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		switch( $this->get['s'] )
		{
		case null:
		case 'edit':
			$this->set_title( $this->lang->emoji );
			$this->tree( $this->lang->emoji );

			$out = null;
			$edit_id = isset( $this->get['edit'] ) ? intval( $this->get['edit'] ) : 0;
			$delete_id = isset( $this->get['delete'] ) ? intval( $this->get['delete'] ) : 0;

			if( isset( $this->get['delete'] ) ) {
				$this->db->query( 'DELETE FROM %pemojis WHERE emoji_id=%d', $delete_id );
			}

			if( !isset( $this->get['edit'] ) ) {
				$this->get['edit'] = null;
			}

			if( isset( $this->post['submit'] ) && ( trim( $this->post['new_string'] ) != '' ) && ( trim( $this->post['new_image'] ) != '' ) ) {
				$new_click = intval( isset( $this->post['new_click'] ) );
				$this->db->query( "UPDATE %pemojis SET emoji_string='%s', emoji_image='%s', emoji_clickable=%d WHERE emoji_id=%d",
					$this->post['new_string'], $this->post['new_image'], $new_click, $edit_id );
				$this->get['edit'] = null;
			}

			$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/emoji_control.xtpl' );

			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'emoji_controls', $this->lang->emoji_controls );

			$add_form_action = $this->site . '/admincp/index.php?a=emoji_control&amp;s=add';
			$xtpl->assign( 'add_form_action', $add_form_action );

			$xtpl->assign( 'emoji_add', $this->lang->emoji_add );
			$xtpl->assign( 'emoji_text', $this->lang->emoji_text );
			$xtpl->assign( 'emoji_image', $this->lang->emoji_image );

			$em_add_list = $this->list_emojis( 'New' );
			$xtpl->assign( 'em_add_list', $em_add_list );

			$xtpl->assign( 'emoji_clickable', $this->lang->emoji_clickable );

			$form_action = $this->site . '/admincp/index.php?a=emoji_control&amp;s=edit&amp;edit=' . $edit_id;
			$xtpl->assign( 'form_action', $form_action );

			$xtpl->assign( 'emoji_edit_or_delete', $this->lang->emoji_edit_or_delete );

			$query = $this->db->query( 'SELECT * FROM %pemojis ORDER BY emoji_clickable, emoji_string ASC' );
			while( $data = $this->db->nqfetch( $query ) )
			{
				$em_id = $data['emoji_id'];
				$em_string = $data['emoji_string'];
				$em_image = $data['emoji_image'];

				if( !$this->get['edit'] || ( $edit_id != $data['emoji_id'] ) ) {
					$xtpl->assign( 'em_string', $em_string );
					$xtpl->assign( 'em_image', $em_image );

					$xtpl->assign( 'img_src', "<img src=\"{$this->site}/emojis/{$em_image}\" alt=\"{$em_string}\">" );

					if( $data['emoji_clickable'] == 0 )
						$xtpl->assign( 'em_clickable', $this->lang->no );
					else
						$xtpl->assign( 'em_clickable', $this->lang->yes );

					$xtpl->assign( 'em_edit', "<a href=\"{$this->site}/admincp/index.php?a=emoji_control&amp;s=edit&amp;edit={$em_id}\">{$this->lang->edit}</a>" );
				} else {
					$xtpl->assign( 'em_string', "<input name=\"new_string\" value=\"{$em_string}\" class=\"input\">" );

					$em_list = $this->list_emojis( $em_image );
					$xtpl->assign( 'em_image', "<select name=\"new_image\" onchange='document.emoji_preview.src=\"../emojis/\"+this.options[selectedIndex].value'>{$em_list}</select>" );

					$checked = '';
					if( $data['emoji_clickable'] == 1 )
						$checked = 'checked';
					$xtpl->assign( 'em_clickable', "<input type=\"checkbox\" name=\"new_click\" {$checked}>" );

					$xtpl->assign( 'img_src', "<img name=\"emoji_preview\" src=\"{$this->site}/emojis/{$em_image}\" alt=\"{$em_string}\">" );

					$xtpl->assign( 'em_edit', "<input type=\"submit\" name=\"submit\" value=\"{$this->lang->edit}\">" );
				}

				$em_delete = '<a href="' . $this->site . '/admincp/index.php?a=emoji_control&amp;s=edit&amp;delete=' . $em_id . '">' . $this->lang->delete . '</a>';
				$xtpl->assign( 'em_delete', $em_delete );

				$xtpl->parse( 'Emojis.SingleEntry' );
			}

			$xtpl->parse( 'Emojis' );
			return $xtpl->text( 'Emojis' );
			break;

		case 'add':
			$this->set_title( $this->lang->emoji_add );
			$this->tree( $this->lang->emoji_add );

			if( !isset( $this->post['submit'] ) ) {
				$this->get['s'] = null;
				$this->execute();
				return;
			} else {
				$new_clickable = intval( isset( $this->post['new_click'] ) );
				$new_string = isset( $this->post['new_string'] ) ? $this->post['new_string'] : '';

				if( trim( $new_string ) == '') {
					return $this->message( $this->lang->emoji_add, $this->lang->emoji_no_text );
				}

				$new_image = '';
				if( $this->post['existing_image'] != 'New' )
					$new_image = $this->post['existing_image'];
				else {
					if( isset( $this->files['new_image'] ) && $this->files['new_image']['error'] == UPLOAD_ERR_OK ) {
						$fname = $this->files['new_image']['tmp_name'];
						$system = explode( '.', $this->files['new_image']['name'] );
						$ext = strtolower( end( $system ) );

						if( !preg_match( '/jpg|jpeg|png|gif/', $ext ) ) {
							return $this->message( $this->lang->emoji_add, sprintf( $this->lang->emoji_invalid_image, $ext ) );
						} else {
							$new_fname = '../emojis/' . $this->files['new_image']['name'];
							if ( !move_uploaded_file( $fname, $new_fname ) )
								return $this->message( $this->lang->emoji_add, $this->lang->emoji_image_failed );
							else
								$new_image = $this->files['new_image']['name'];
						}
					}
				}

				$this->db->query( "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES ('%s', '%s', %d )", $new_string, $new_image, $new_clickable );

				return $this->message( $this->lang->emoji_add, $this->lang->emoji_added, $this->lang->emoji_back, $this->site . '/admincp/index.php?a=emoji_control' );
			}
			break;
		}
	}

	private function list_emojis( $select )
	{
		$dirname = "../emojis/";

		$out = null;
		$files = array();

		if( $select == 'New' )
			$out .= '\n<option value="New" selected="selected">New</option>';

		$dir = opendir( $dirname );
		while( ( $emo = readdir( $dir ) ) !== false )
		{
			$ext = substr( $emo, -3 );
			if( ( $ext != 'png' ) && ( $ext != 'gif' ) && ( $ext != 'jpg' ) ) {
				continue;
			}

			if( is_dir( $dirname . $emo ) ) {
				continue;
			}

			$files[] = $emo;
		}

		sort( $files );

		foreach( $files as $key => $name ) {
			$out .= "\n<option value='$name'" . (($name == $select) ? ' selected' : '') . ">$name</option>";
		}
		return $out;
	}
}
?>