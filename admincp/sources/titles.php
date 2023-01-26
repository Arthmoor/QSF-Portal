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

class titles extends admin
{
	public function execute()
	{
		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		switch( $this->get['s'] )
		{
		case 'add':
			$this->set_title( $this->lang->titles_add );
			$this->tree( $this->lang->titles_add );

			if( !isset( $this->post['submit'] ) ) {
				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/titles.xtpl' );

				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'skin', $this->skin );
				$xtpl->assign( 'titles_add', $this->lang->titles_add );
				$xtpl->assign( 'titles_title', $this->lang->titles_title );
				$xtpl->assign( 'titles_image', $this->lang->titles_image );

				$image_list = $this->list_title_images( -1 );
				$xtpl->assign( 'image_list', $image_list );

				$xtpl->assign( 'titles_minpost', $this->lang->titles_minpost );
				$xtpl->assign( 'token', $this->generate_token() );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'Titles.AddForm' );
				$xtpl->parse( 'Titles' );

				return $xtpl->text( 'Titles' );
			} else {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->titles_control, $this->lang->invalid_token );
				}

				if( ( trim( $this->post['new_title'] ) == '' ) || ( trim( $this->post['new_posts'] ) == '' ) ) {
					return $this->message( $this->lang->titles_control, $this->lang->titles_error );
				}

				$this->db->query( "INSERT INTO %pmembertitles (membertitle_title, membertitle_icon, membertitle_posts)
					VALUES ('%s', '%s', %d)",
					$this->post['new_title'], $this->post['new_icon'], intval( $this->post['new_posts'] ) );
				$this->update_titles();

				return $this->message( $this->lang->titles_add, $this->lang->titles_added );
			}
			break;

		default:
			$this->set_title( $this->lang->titles_edit );
			$this->tree( $this->lang->titles_edit );

			if( isset( $this->get['delete'] ) && 1 == intval( $this->get['delete'] ) ) {
				return $this->message( $this->lang->titles_control, $this->lang->titles_nodel_default );
			}

			if( isset( $this->get['delete'] ) ) {
				$this->db->query( "DELETE FROM %pmembertitles WHERE membertitle_id=%d", intval( $this->get['delete'] ) );
				$this->update_titles();
			}

			if( !isset( $this->get['edit'] ) ) {
				$this->get['edit'] = null;
			} else {
				$this->get['edit'] = intval( $this->get['edit'] );
			}

			if( isset( $this->post['submit'] ) && ( trim( $this->post['new_posts'] ) != '' ) && ( trim( $this->post['new_title'] ) != '' ) ) {
				$this->db->query( "UPDATE %pmembertitles SET membertitle_title='%s', membertitle_posts=%d, membertitle_icon='%s' WHERE membertitle_id=%d",
					$this->post['new_title'], intval( $this->post['new_posts'] ), $this->post['new_icon'], $this->get['edit'] );
				$this->get['edit'] = null;

				$this->update_titles();
			}

			$query = $this->db->query( "SELECT * FROM %pmembertitles" );

			$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/titles.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'edit', $this->get['edit'] );
			$xtpl->assign( 'titles_edit', $this->lang->titles_edit );
			$xtpl->assign( 'titles_title', $this->lang->titles_title );
			$xtpl->assign( 'titles_image', $this->lang->titles_image );
			$xtpl->assign( 'titles_minpost', $this->lang->titles_minpost );

			while( $data = $this->db->nqfetch( $query ) )
			{
				$title_link = null;
				$image_link = null;
				$icon = null;
				$edit_link = null;
				$delete_link = null;
				$posts_link = null;

				if( !$this->get['edit'] || ( $this->get['edit'] != $data['membertitle_id'] ) ) {
					$title_link = $data['membertitle_title'];
					$image_link = "<img src=\"../skins/default/images/{$data['membertitle_icon']}\" alt=\"{$data['membertitle_icon']}\">";
					$icon = $data['membertitle_icon'];
					$posts_link = $data['membertitle_posts'];
					$edit_link = "<a href=\"{$this->site}/admincp/index.php?a=titles&amp;s=edit&amp;edit={$data['membertitle_id']}\">{$this->lang->edit}</a>";
					$delete_link = "<a href=\"{$this->site}/admincp/index.php?a=titles&amp;s=edit&amp;delete={$data['membertitle_id']}\">{$this->lang->delete}</a>";
				} else {
					$options = $this->list_title_images( $data['membertitle_icon'] );

					$icon = "<select name=\"new_icon\" onchange=\"document.title_preview.src='../skins/{$this->skin}/images/'+this.options[selectedIndex].value\">";
					$icon .= $options;
					$icon .= '</select>';

					$title_link = "<input name=\"new_title\" value=\"{$data['membertitle_title']}\">";
					$image_link = "<img src=\"../skins/default/images/{$data['membertitle_icon']}\" id=\"title_preview\">";
					$posts_link = "<input name=\"new_posts\" value=\"{$data['membertitle_posts']}\" size=\"8\">";
					$edit_link = "<input type=\"submit\" name=\"submit\" value=\"{$this->lang->edit}\">";
					$delete_link = "<a href=\"{$this->site}/admincp/index.php?a=titles&amp;s=edit&amp;delete={$data['membertitle_id']}\">{$this->lang->delete}</a>";
				}

				$xtpl->assign( 'title_link', $title_link );
				$xtpl->assign( 'image_link', $image_link );
				$xtpl->assign( 'icon', $icon );
				$xtpl->assign( 'posts_link', $posts_link );
				$xtpl->assign( 'edit_link', $edit_link );
				$xtpl->assign( 'delete_link', $delete_link );

				$xtpl->parse( 'Titles.EditForm.Entry' );
			}

			$xtpl->parse( 'Titles.EditForm' );
			$xtpl->parse( 'Titles' );

			return $xtpl->text( 'Titles' );
			break;
		}
	}

	private function list_title_images( $select )
	{
		$dirname = "../skins/{$this->skin}/images/";

		$out = null;

		$dir = opendir( $dirname );
		while( ( $emo = readdir( $dir ) ) !== false )
		{
			$ext = substr( $emo, -3 );
			if( ( $ext != 'png' )
			&& ( $ext != 'gif' )
			&& ( $ext != 'bmp' )
			&& ( $ext != 'jpg' ) ) {
				continue;
			}

			if( is_dir( $dirname . $emo ) ) {
				continue;
			}

			$name = substr( $emo, 0, -4 );
			$out .= "\n<option value='$emo'" . (($emo == $select) ? ' selected="selected"' : '') . ">$emo</option>";
		}

		return $out;
	}

	private function update_titles()
	{
		$titles = $this->db->query( "SELECT * FROM %pmembertitles ORDER BY membertitle_posts" );
		$last_count = 0;
		$last_level = 0;
		$last_title = '';

		while( $title = $this->db->nqfetch( $titles ) )
		{
			$this->db->query( "UPDATE %pusers SET user_title='%s', user_level='%s'
				WHERE (user_title_custom = 0) AND (user_posts >= %d) AND (user_posts < %d)",
				$last_title, $last_level, $last_count, $title['membertitle_posts'] );

			$last_count = $title['membertitle_posts'];
			$last_level = $title['membertitle_id'];
		}

		// We need this to take care of the users who have more posts than are set by any title
		$this->db->query( "UPDATE %pusers SET user_title='%d', user_level='%s'
			WHERE (user_title_custom = 0) AND (user_posts >= %d)",
			$last_title, $last_level, $last_count );
	}
}
?>