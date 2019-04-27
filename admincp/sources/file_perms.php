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

if( !defined( 'QUICKSILVERFORUMS') || !defined('QSF_ADMIN' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';

class file_perms extends admin
{
	public function execute()
	{
		$this->lang->perms(); // Load up permissions related translations
		$perms_obj = new file_permissions( $this );

		if( isset( $this->get['s'] ) && ( $this->get['s'] == 'user' ) ) {
			if( !isset( $this->get['id'] ) ) {
				header( "Location: {$this->site}/admincp/index.php?a=member_control&amp;s=file_perms" );
			}

			$this->post['group'] = intval( $this->get['id'] );

			$mode  = 'user';
			$title = 'User Control';
			$link  = '&amp;s=user&amp;id=' . $this->post['group'];

			$perms_obj->get_perms( -1, $this->post['group'] );
		} else {
			if( !isset( $this->post['group'] ) ) {
				return $this->message( 'User Groups', "
				<form action='$this->site/admincp/index.php?a=file_perms' method='post'><div>
					{$this->lang->perms_edit_for}
					<select name='group'>
					" . $this->htmlwidgets->select_groups(-1) . "
					</select>
					<input type='submit' value='{$this->lang->submit}' /></div>
				</form>" );
			}

			$this->post['group'] = intval( $this->post['group'] );

			$mode  = 'group';
			$title = $this->lang->perms_title;
			$link  = null;

			$perms_obj->get_perms( $this->post['group'], -1 );
		}

		$this->set_title( $title );
		$this->tree( $title );

		$cats_only = $this->db->query( 'SELECT fcat_id, fcat_name FROM %pfile_categories ORDER BY fcat_name' );

		$cats_list = array();
		$cats_list[] = array( 'fcat_id' => 0, 'fcat_name' => 'Root' );

		while( $cat = $this->db->nqfetch( $cats_only ) )
		{
			if( $cat['fcat_id'] == 0 )
				continue;
			$cats_list[] = $cat;
		}

		$perms = array(
                                'download_files'        => 'Download files',
                                'upload_files'          => 'Upload files',
				'approve_files'		=> 'Approve files',
				'edit_files'		=> 'Edit files',
				'move_files'		=> 'Move files',
				'delete_files'		=> 'Delete files',
				'post_comment'		=> 'Post comments',
				'category_view'		=> 'View category',
				'edit_category'		=> 'Edit category',
				'delete_category'	=> 'Delete category',
				'add_category'		=> 'Add category'
		);

		if( !isset( $this->post['submit'] ) ) {
			$token = $this->generate_token();

			$count = count( $cats_list ) + 1;

			if( $mode == 'user' ) {
				$query = $this->db->fetch( 'SELECT user_name, user_file_perms FROM %pusers WHERE user_id=%d', $this->post['group'] );
				$label = "User '{$query['user_name']}'";
			} else {
				$query = $this->db->fetch( 'SELECT group_name FROM %pgroups WHERE group_id=%d', $this->post['group'] );
				$label = "Group '{$query['group_name']}'";
			}

			$out = "
			<script src='$this->site/javascript/permissions.js' async defer></script>

			<form id='form' action='$this->site/admincp/index.php?a=file_perms$link' method='post'>
			<div class='article'><div class='title'><img src='$this->site/skins/$this->skin/images/icons/downloads.png' alt='' /> File Permissions For $label</div>";

			if( $mode == 'user' ) {
				$out .= "<br />{$this->lang->perms_override_user}<br /><br />
				<div style='border:1px dashed #ff0000; width:25%; padding:5px'><input type='checkbox' name='usegroup' id='usegroup' style='vertical-align:middle'" . (!$query['user_file_perms'] ? ' checked' : '') . " /> <label for='usegroup' style='vertical-align:middle'>{$this->lang->perms_only_user}</label></div>";
			}

			$out .= "</div>
			<div class='article'><table>
			<tr>
				<td colspan='" . ($count + 1) . "' class='header'>$label</td>
			</tr>";

			$out .= $this->show_headers( $cats_list );

			$i = 0;
			foreach( $perms as $perm => $label )
			{
				$out .= "
				<tr>
					<td>$label</td>
					<td align='center'>
						<input type='checkbox' name='perms[$perm][-1]' id='perms_{$perm}' onclick='checkrow(\"$perm\", this.checked)'" . ($perms_obj->auth($perm) ? ' checked=\'checked\'' : '') . " />All
					</td>";

				if( !isset( $perms_obj->globals[$perm] ) ) {
					foreach( $cats_list as $cat )
					{
						if( $perms_obj->auth( $perm, $cat['fcat_id'] ) ) {
							$checked = " checked='checked'";
						} else {
							$checked = '';
						}

						$out .= "\n<td align='center'><input type='checkbox' name='perms[$perm][{$cat['fcat_id']}]' onclick='changeall(\"$perm\", this.checked)'$checked /></td>";
					}
				} elseif( $cats_list ) {
					$out .= "\n<td colspan='$count' align='center'>N/A</td>";
				}

				$out .= "
				</tr>";

				$i++;
				if( ( $i % 12 ) == 0 ) {
					$out .= $this->show_headers( $cats_list );
				}
			}

			return $out . "
			<tr>
				<td colspan='" . ($count + 1) . "' class='footer' align='center'><input type='hidden' name='token' value='{$token}' /><input type='hidden' name='group' value='{$this->post['group']}' /><input type='submit' name='submit' value='Update File Permissions' /></td>
			</tr></table></div></form>";
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->perms, $this->lang->invalid_token );
			}

			if( ( $mode == 'user' ) && isset( $this->post['usegroup'] ) ) {
				$perms_obj->cube = '';
				$perms_obj->update();
				return $this->message( $this->lang->perms, $this->lang->perms_user_inherit );
			}

			$perms_obj->reset_cube( false );

			if( !isset( $this->post['perms'] ) ) {
				$this->post['perms'] = array();
			}

			foreach( $this->post['perms'] as $name => $data )
			{
				if( isset( $data[-1] ) || isset( $data['-1'] ) || ( count($data) == count( $cats_list ) ) ) {
					$perms_obj->set_xy( $name, true );
				} else {
					foreach( $data as $cat => $on )
					{
						$perms_obj->set_xyz( $name, intval($cat), true );
					}
				}
			}

			$perms_obj->update();

			return $this->message( $this->lang->perms, $this->lang->perms_updated );
		}
	}

	private function show_headers( $cats_list )
	{
		$out = "<tr>
		<td class='subheader' colspan='2' valign='bottom'>{$this->lang->perm}</td>";

		foreach ($cats_list as $cat)
		{
			$out .= "\n<td class='subheader' align='center' valign='middle'>{$cat['fcat_name']}</td>";
		}

		return $out . '</tr>';
	}
}
?>