<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2010 The QSF Portal Development Team
 * http://www.qsfportal.com/
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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/global.php';

/**
 * Downloads file browser
 *
 * @author Roger Libiez [Samson] http://www.iguanadons.net, Davion, Asylumius
 * @since 1.2.2
 **/
class files extends qsfglobal
{
	var $cat_array; // Used to generate category trees

	/**
	 * Build the file browser information
	 *
	 **/
	function execute()
	{
		if (!$this->perms->auth('board_view')) {
			$this->lang->board();
			return $this->message(
				sprintf($this->lang->board_message, $this->sets['forum_name']),
				($this->perms->is_guest) ? sprintf($this->lang->board_regfirst, $this->self) : $this->lang->board_noview
			);
		}

		static $cat_array = false;
		$this->cat_array = &$cat_array;

                $this->tree($this->lang->files);
                $this->set_title($this->lang->files);
		$dowload = false;

		if (!isset($this->get['s'])) {
			$this->get['s'] = null;
		}

		$cid = 0;
		if( isset($this->get['cid']) ) {
			if( !is_numeric($this->get['cid']) ) {
				return $this->message( $this->lang->files, $this->lang->files_invalid_category );
			}
			$cid = intval($this->get['cid']);
		}

		$fid = 0;
		if( isset($this->get['fid']) ) {
			if( !is_numeric($this->get['fid']) ) {
				return $this->message( $this->lang->files, $this->lang->files_invalid_file );
			}
			$fid = intval($this->get['fid']);
		}

		switch($this->get['s'])
		{
			case 'recent':
				$file_page = $this->recent_uploads();
				break;
			case 'filequeue':
				$file_page = $this->view_filequeue();
				break;
			case 'addcategory':
				$file_page = $this->add_category($cid);
				break;
			case 'editcategory':
				$file_page = $this->edit_category($cid);
				break;
			case 'deletecategory':
				$file_page = $this->delete_category($cid);
				break;
			case 'addmoderator':
				$file_page = $this->add_moderator($cid);
				break;
			case 'remmoderator':
				$file_page = $this->rem_moderator($cid);
				break;
			case 'viewfile':
				$file_page = $this->show_file($fid);
				break;
			case 'download':
				return $this->download_file($cid);
				break;
			case 'upload':
				$file_page = $this->upload_file($cid);
				break;
			case 'delete':
				$file_page = $this->delete_file($cid);
				break;
			case 'update':
				$file_page = $this->update_file($cid, $fid);
				break;
			case 'move':
				$file_page = $this->move_file();
				break;
			case 'edit':
				$file_page = $this->edit_file();
				break;
			case 'search':
				$file_page = $this->file_search();
				break;
			case 'addcomment':
				$file_page = $this->add_comment($cid);
				break;
			case 'listcomments':
				$file_page = $this->list_comments();
				break;
			case 'fixcount':
				$file_page = $this->fix_filecount();
				break;

			default:
				$file_page = $this->display_categories($cid);
				break;
		}

		$upload = false;
		if ($this->file_perms->auth('upload_files', $cid))
			$upload = true;

		$approve = false;
		if ($this->file_perms->auth('approve_files', $cid))
			$approve = true;

		$addcat = false;
		if ($this->file_perms->auth('add_category', $cid))
			$addcat = true;

		$editcat = false;
		if ($this->file_perms->auth('edit_category', $cid))
			$editcat = true;

		$delcat = false;
		if ($this->file_perms->auth('delete_category', $cid))
			$delcat = true;

		// Add RSS feed link for recent uploads
		$this->add_feed($this->sets['loc_of_board'] . $this->mainfile . '?a=rssfeed&amp;files=1', "{$this->lang->files_recent}");

		$filejump = $this->get_categories($cid);
		return eval($this->template('FILES_MAIN'));
	}

	function fix_filecount()
	{
		if( !$this->perms->auth('is_admin') ) {
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_action_not_permitted );
		}

                $query = $this->db->fetch( 'SELECT COUNT(file_id) files FROM %pfiles WHERE file_approved=1' );
		$query2 = $this->db->fetch( 'SELECT COUNT(file_id) files FROM %pfiles WHERE file_approved=0' );
		$query3 = $this->db->fetch( 'SELECT COUNT(update_id) files FROM %pupdates' );

		$this->sets['file_count'] = $query['files'];
		$this->sets['code_approval'] = $query2['files'] + $query3['files'];
		$this->write_sets();

		$this->db->query( 'UPDATE %pfile_categories SET fcat_count=0' );
		$cats = $this->db->query( 'SELECT fcat_id FROM %pfile_categories' );
		while( ( $cat = $this->db->nqfetch($cats) ) )
		{
			$count = $this->db->fetch( 'SELECT COUNT(file_id) files FROM %pfiles WHERE file_approved=1 AND file_catid=%d', $cat['fcat_id'] );
			$this->increase_cat_count( $cat['fcat_id'], $count['files'] );
		}
		$this->update_category_trees();

		return $this->message( $this->lang->files_fix_stats, $this->lang->files_fix_stats2 );
	}

	function edit_file()
	{
		$id = intval( $this->get['fid'] );
		$file = $this->db->fetch(
		  'SELECT f.*, u.user_name
		    FROM %pfiles f
		    LEFT JOIN %pusers u ON user_id=file_submitted
		    WHERE file_id=%d', $id );

		if (!$this->file_perms->auth('edit_files', $file['file_catid'])) {
			return $this->message($this->lang->files_action_not_allowed, $this->lang->files_edit_not_permitted);
		}

		if (!isset($this->post['submit'])) {
			foreach($file as $key => $value)
				$$key = $value;

			$tree = $this->get_filetree($file_catid, true);
			$list = $this->get_categories($file_catid);
			$date = $this->mbdate( DATE_ONLY_LONG, $file_date );
			$filesize = ceil($file_size / 1024);
			$file_desc = $this->format($file_description, FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_MBCODE);

			return eval($this->template('FILE_EDIT'));
		} else {
			if (empty($this->post['file_author']) || empty($this->post['file_name']) || empty($this->post['file_description']) || empty($this->post['file_category'])) {
				return $this->message($this->lang->files_edit_file, $this->lang->files_all_fields_required);
			}

			$name = $this->post['file_name'];
			$catid = intval( $this->post['file_category'] );
			$author = $this->post['file_author'];
			$desc = $this->post['file_description'];

			$this->log_action( 'file_edit', $id );
			$this->db->query( "UPDATE %pfiles SET file_name='%s', file_catid=%d, file_author='%s', file_description='%s' WHERE file_id=%d", $name, $catid, $author, $desc, $id );
			return $this->message( $this->lang->files_edit_file, "{$file['file_name']} " . $this->lang->files_has_updated, "{$this->lang->continue}", "{$this->self}?a=files&amp;s=viewfile&amp;fid={$id}" );
		}
	}

	function move_file()
	{
		$id = intval( $this->get['fid'] );
		$file = $this->db->fetch( 'SELECT file_id, file_name, file_catid FROM %pfiles WHERE file_id=%d', $id );

		if (!$this->file_perms->auth('move_files', $file['file_catid'])) {
			return $this->message($this->lang->files_action_not_allowed, $this->lang->files_move_not_permitted);
		}

		if (!isset($this->post['submit'])) {
			$list = $this->get_categories($file['file_catid']);
			$move_file = sprintf($this->lang->files_move_category, "<strong>{$file['file_name']}</strong>");

			return $this->message( $this->lang->files_move_file, "
			<form action=\"{$this->self}?a=files&amp;s=move&amp;fid={$id}\" method=\"post\">
			 <div>{$move_file}
			  <select name=\"category\">
			   {$list}
			  </select>
			  <input type=\"submit\" name=\"submit\" value=\"{$this->lang->files_move_file}\" />
			 </div>
			</form>" );
		} else {
			$catid = intval( $this->post['category'] );

			$cat = $this->db->fetch( 'SELECT fcat_name FROM %pfile_categories WHERE fcat_id=%d', $catid );
			if (!$cat) {
				return $this->message( $this->lang->files_move_file, $this->lang->files_move_no_category, "{$this->lang->continue}", "{$this->self}?a=files&amp;s=move&amp;fid={$id}" );
			}

			$this->log_action( 'file_move', $file['file_id'], $file['file_catid'], $catid );
			$this->decrease_cat_count( $file['file_catid'] );
			$this->increase_cat_count( $catid );
			$this->db->query( 'UPDATE %pfiles SET file_catid=%d WHERE file_id=%d', $catid, $id );
			return $this->message( $this->lang->files_move_file, "<strong>{$file['file_name']}</strong> " . $this->lang->files_moved_file, "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$catid}" );
		}
	}

	function view_filequeue()
	{
		if (!isset($this->get['f'])) {
			$this->get['f'] = null;
		}
		if (isset($this->get['u']))
			$getUpdate = true;
		else
			$getUpdate = false;

		if(isset($this->get['cid']))
		{
			$cid = $this->get['cid'];

			if (!$this->file_perms->auth('approve_files', $cid)) {
				return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_approval_not_permitted );
			}
		}
		
		if (!$this->get['f']) {
			$i = 0;

			$files = "<div class=\"article\"><div class=\"title\">{$this->lang->files_approval_waiting}</div></div>";

			$query = $this->db->query(
			  'SELECT f.*, u.user_name
			    FROM %pfiles f
			    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
			    WHERE file_approved=0' );

			$updates = false;
			while ($file = $this->db->nqfetch($query))
			{
	                        foreach($file as $key => $value)
	                                $$key = $value;
				if (!$this->file_perms->auth('approve_files', $file_catid))
					continue;
				$i++;
				$date = $this->mbdate( DATE_ONLY_LONG, $file_date );
				$filesize = ceil($file_size / 1024);
				$file_description = $this->format( $file_description, FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_MBCODE );
				$cid=0;
				$files .= eval($this->template('FILE_APPROVAL'));
			}

			$updates = true;
			$query = $this->db->query(
			  'SELECT p.*, f.file_catid, u.user_name
			    FROM %pupdates p
			    LEFT JOIN %pusers u ON u.user_id=p.update_updater
			    LEFT JOIN %pfiles f ON f.file_id=p.update_updating' );

			while( $update = $this->db->nqfetch($query) )
			{
				foreach($update as $key => $value)
					$$key = $value;

				if (!$this->file_perms->auth('approve_files', $file_catid))
					continue;

				$i++;
				$file_name = $update_name;
				$date = $this->mbdate(DATE_ONLY_LONG, $update_date);
				$filesize = ceil($update_size / 1024);

				$file_description = $this->format( $update_description, FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_MBCODE );
				
				$files .= eval($this->template('FILE_APPROVAL'));
			}

			if ($i == 0) {
				return $this->message( $this->lang->files_approve, $this->lang->files_approve_none );
			}
			return $files;
		}

		if(!isset($this->get['cid']) )
			return $this->message($this->lang->files_approve, $this->lang->files_approve_error);
		if ($this->get['f'] == 'approve')
		{
			$id = intval( $this->get['fid'] );
			if($getUpdate)
				return $this->approve_update($cid, $id);
			$file = $this->db->fetch( "SELECT file_name, file_submitted, file_catid FROM %pfiles WHERE file_id=%d", $id );
			$this->db->query( 'UPDATE %pfiles SET file_approved=1 WHERE file_id=%d', $id );
			$this->db->query( 'UPDATE %pusers SET user_uploads=user_uploads+1 WHERE user_id=%d', $file['file_submitted'] );
			$this->increase_cat_count( $file['file_catid'] );

			$this->sets['code_approval']--;
			$this->sets['file_count']++;
			$this->write_sets();
			return $this->message( $this->lang->files_approve, "{$file['file_name']} " . $this->lang->files_approved, $this->lang->continue, "{$this->self}?a=files&amp;s=filequeue" );
		}

		if ($this->get['f'] == 'deny') {
			$id = intval( $this->get['fid'] );
			// if(!isset($this->post['submit'] ) )
			//	return eval($this->template('FILE_DENY') );
			
			if($getUpdate)
				return $this->deny_update($id);
			$file = $this->db->fetch( 'SELECT file_submitted FROM %pfiles WHERE file_id=%d', $id );
			$name = $this->remove_file($id);

			// $message = "Thank you for submitting your file, it was however denied for the following reason: ".$this->post['reason'];
			// $this->systemPM($file['file_submitted'], "Your file submission was denied.", $message);

			$this->sets['code_approval']--;
			$this->write_sets();
			return $this->message( $this->lang->files_approve, "{$name} " . $this->lang->files_denied, $this->lang->continue, "{$this->self}?a=files&amp;s=filequeue");
		}

		if ($this->get['f'] == 'download') {
			$id = intval( $this->get['fid'] );
			
			if(!$getUpdate)
			{
				$file = $this->db->fetch( 'SELECT file_filename, file_md5name, file_catid, file_size FROM %pfiles WHERE file_id=%d', $id );
				$filename = $file['file_filename'];
				$md5name = $file['file_md5name'];
				$size = $file['file_size'];
				$basepath = "./downloads/";
			}
			else
			{
				$update = $this->db->fetch( 'SELECT update_name, update_md5name, update_updating, update_size FROM %pupdates WHERE update_id=%d', $id );
				$filename = $update['update_name'];
				$md5name = $update['update_md5name'];
				$size = $update['update_size'];
				$basepath = './updates/';
			}
			
			$this->nohtml = true;

			// Need to terminate and unlock the session at this point or the site will stall for the current user.
			session_write_close();

			ini_set("zlib.output_compression", "Off");
			header("Content-Type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"{$filename}\"");
			header("Content-Length: " . $size);
			header("X-Robots-Tag: noarchive, nosnippet, noindex");
			echo file_get_contents( './downloads/' . $md5name);
		}
		return $this->message($this->lang->files_approve, $this->lang->files_invalid_option, $this->lang->continue, "{$this->self}?a=files&amp;s=filequeue");
	}

	function edit_category($cid)
	{
		if (!$this->file_perms->auth('edit_category', $cid)) {
			return $this->message($this->lang->files_action_not_allowed, $this->lang->files_edit_cat_not_permitted);
		}

		if ($cid == 0) {
			return $this->message($this->lang->files_action_not_allowed, $this->lang->files_edit_root);
		}

		if (!isset($this->post['submit'])) {
			$cat = $this->db->fetch( 'SELECT fcat_name, fcat_parent, fcat_description FROM %pfile_categories WHERE fcat_id=%d', $cid );
			$list = $this->get_categories($cat['fcat_parent']);

			return eval($this->template('FILE_EDIT_CAT'));
		} else {
			$parent = intval($this->post['parent']);
			$name = $this->post['cat_name'];
			$desc = $this->post['catdesc'];
			$longpath = $this->get_longpath($parent);

			$cat = $this->db->fetch( 'SELECT * FROM %pfile_categories WHERE fcat_id=%d', $cid );
			if (!$this->file_perms->auth('edit_category', $parent)) {
				return $this->message($this->lang->files_edit_category, $this->lang->files_edit_mod);
			}

			if ($this->is_parent($cat['fcat_id'], $parent) ) {
				return $this->message($this->lang->files_edit_category, $this->lang->files_edit_cat_not_parent);
			}

			$ecat = $this->db->fetch( "SELECT fcat_id, fcat_name, fcat_parent FROM %pfile_categories WHERE fcat_name='%s'", $name );
			if ($ecat && $ecat['fcat_parent'] == $parent) {
				if ($parent == 0) {
					$path = "Root";
				} else {
					$path = $longpath;
				}
				if ($ecat['fcat_id'] != $cid) {
					$exists = sprintf($this->lang->files_cat_exists, $name, $path);
					return $this->message($this->lang->files_edit_category, $exists);
				}
			}

			if ($parent != 0) {
				$longpath .= "/{$name}";
			} else {
				$longpath .= $name;
			}
			$this->db->query( "UPDATE %pfile_categories SET fcat_name='%s', fcat_parent=%d, fcat_longpath='%s', fcat_description='%s' WHERE fcat_id=%d", $name, $parent, $longpath, $desc, $cid );
			$this->update_children_longpath($cat['fcat_id']);
			$this->update_category_trees();
			$this->log_action( 'file_edit_category', $cid );
			return $this->message( $this->lang->files_edit_category, $this->lang->files_cat_edited, $this->lang->continue, "{$this->self}?a=files&amp;cid={$cid}" );
		}
	}

	// FIXME: There's work to be done here. Appropriate permissions on the user need to be set.
	function add_moderator($cid)
	{
		if (!$this->perms->auth('is_admin'))
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_add_mod_not_allowed );
		
		if(!isset($this->post['submit']))
		{
			$list = $this->get_categories($cid);
			
			return $this->message($this->lang->files_add_mod, "
			<form action=\"{$this->self}?a=files&amp;s=addmoderator\" method=\"post\">
				<span class=\"field\">{$this->lang->files_add_mod2}:</span>
				<span class=\"form\"><input type=\"text\" name=\"mod_name\" value \"\" maxlength=\"32\" />
					{$this->lang->files_add_mod_cat}
					<select name=\"parent\">
						{$list}
					</select></span>

					<p class=\"line\"></p>

					<input type=\"submit\" name=\"submit\" value=\"{$this->lang->submit}\" />
			</form>");		
		}
		else
		{
			$parent = intval($this->post['parent']);
			$name = $this->post['mod_name'];
			if( !( $newMod = $this->db->fetch( "SELECT user_id, user_name FROM %pusers WHERE user_name='%s'", $name ) ) )
				return $this->message( $this->lang->files_add_mod, $this->lang->files_add_mod_nouser );
			$this->db->query( 'UPDATE %pfile_categories SET fcat_moderator=%d WHERE fcat_id=%d', $newMod['user_id'], $parent );
			$this->log_action( 'file_add_moderator', $newMod['user_id'], $cid );
			return $this->message( $this->lang->files_add_mod, "{$newMod['user_name']} " . $this->lang->files_add_mod_made );
		}
	}

	// FIXME: There's work to be done here. Appropriate permissions on the user need to be unset.
	function rem_moderator($cid)
	{
		if (!$this->perms->auth('is_admin'))
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_remove_mod_not_permitted );
		
		if(!isset($this->post['submit']))
		{
			$list = $this->get_categories($cid);
			
			return $this->message($this->lang->files_remove_mod, "
			<form action=\"{$this->self}?a=files&amp;s=remmoderator\" method=\"post\">
				<div>{$this->lang->files_remove_mod_cat}
						<select name=\"parent\">
							{$list}
						</select>
					<input type=\"submit\" name=\"submit\" value=\"{$this->lang->submit}\" />
				</div>
			</form>");		
		}
		else
		{
			$parent = intval($this->post['parent']);
			$this->db->query( 'UPDATE %pfile_categories SET fcat_moderator=0 WHERE fcat_id=%d', $parent );
			$this->log_action( 'file_rem_moderator', $parent );
			return $this->message( $this->lang->files_remove_mod, $this->lang->files_remove_mod_done );
		}
	}

	function delete_category($cid)
	{
		if (!$this->file_perms->auth('delete_category', $cid)) {
			return $this->message($this->lang->files_action_not_allowed, $this->lang->files_delete_cat_not_permitted);
		}

		if (!isset($this->post['submit'])) {
			$list = $this->get_categories($cid);

			return $this->message($this->lang->files_delete_cat, "
			<form action=\"{$this->self}?a=files&amp;s=deletecategory\" method=\"post\">
			 <div>{$this->lang->files_delete_cat2}
			  <select name=\"category\">
			   {$list}
			  </select>
			  <input type=\"submit\" name=\"submit\" value=\"{$this->lang->delete}\" />
			 </div>
			</form>");
		} else {
			if (!isset($this->post['category'])) {
				return $this->message($this->lang->files_delete_cat, $this->lang->files_delete_nocat, $this->lang->continue, "{$this->self}?a=files");
			}

			$catid = intval( $this->post['category'] );

			if (!$this->file_perms->auth('delete_category', $catid)) {
				return $this->message($this->lang->files_action_not_allowed, $this->lang->files_delete_cat_not_permitted);
			}

			if ($catid == 0) {
				return $this->message($this->lang->files_delete_cat, $this->lang->files_delete_root, $this->lang->continue, "{$this->self}?a=files");
			}

			$cat = $this->db->fetch( 'SELECT fcat_name, fcat_parent, fcat_count FROM %pfile_categories WHERE fcat_id=%d', $catid );
			if (!$cat) {
				return $this->message( $this->lang->files_delete_cat, $this->lang->files_delete_nocat, $this->lang->continue, "{$this->self}?a=files" );
			}

			$count = $cat['fcat_count'];

			if ($count > 0) {
				$not_exist = sprintf($this->lang->files_delete_cat_not_empty, $cat['fcat_name']);
				return $this->message($this->lang->files_delete_cat, $this->lang->files_delete_cat_not_empty, $this->lang->continue, "{$this->self}?a=files&amp;cid={$catid}");
			}

			$this->db->query( 'DELETE FROM %pfile_categories WHERE fcat_id=%d', $catid );

			$perms = new $this->modules['file_permissions']($this);

			// Groups
			while ($perms->get_group())
			{
				$perms->remove_z($catid);
				$perms->update();
			}

			// Users
			while ($perms->get_group(true))
			{
				$perms->remove_z($catid);
				$perms->update();
			}

			$this->log_action( 'file_delete_category', $catid );
			return $this->message( $this->lang->files_delete_cat, $this->lang->files_delete_cat_done, $this->lang->continue, "{$this->self}?a=files&amp;cid={$cat['fcat_parent']}" );
		}
	}

	function add_category($cid)
	{
		if (!$this->file_perms->auth('add_category', $cid)) {
			return $this->message($this->lang->files_action_not_allowed, $this->lang->files_add_cat_not_allowed);
		}

		if (!isset($this->post['submit'])) {
			$list = $this->get_categories($cid);
			$cats_exist = $this->db->fetch('SELECT COUNT(fcat_id) AS count FROM %pfile_categories');

			if ($cats_exist['count']) {
				$quickperms = $list;
			} else {
				$quickperms = '<option value="0" selected="selected">Root</option>';
			}

			return eval($this->template('FILE_ADD_CAT'));
		} else {
			$parent = intval($this->post['parent']);
			$name = $this->post['cat_name'];
			$longpath = $this->get_longpath($parent);

			if (!$this->file_perms->auth('add_category', $parent)) {
				return $this->message($this->lang->files_action_not_allowed, $this->lang->files_add_cat_not_allowed);
			}

			$cat = $this->db->fetch( "SELECT fcat_name, fcat_parent FROM %pfile_categories WHERE fcat_name='%s'", $name );
			if ($cat && $cat['fcat_parent'] == $parent) {
				if ($parent == 0) {
					$path = 'Root';
				} else {
					$path = $longpath;
				}
				$exists = sprintf($this->lang->files_add_cat_exists, $name, $path);
				return $this->message( $this->lang->files_add_cat, $exists );
			}

			if( $parent == 0 )
				$longpath .= $name;
			else
				$longpath .= "/$name";

			$desc = $this->post['catdesc'];

			$cats = $this->category_array();
			$tree = '';
			if( $parent != 0 )
				$tree = $this->create_tree( $cats, $parent );

			$this->db->query( "INSERT INTO %pfile_categories (fcat_parent, fcat_name, fcat_longpath, fcat_tree, fcat_description)
			 VALUES( %d, '%s', '%s', '%s', '%s' )", $parent, $name, $longpath, $tree, $desc );

			$newid = $this->db->insert_id('file_categories');
			$perms = new $this->modules['file_permissions']($this);

			while ($perms->get_group())
			{
				// Full permissions (note: the banned group is still false)
				if ($this->post['sync'] == -2) {
					$perms->add_z($newid, ($perms->group != USER_BANNED));

				// No permissions
				} elseif ($this->post['sync'] == -1) {
					$perms->add_z($newid, false);

				// Copy another category
				} else {
					$perms->add_z($newid, false);

					foreach ($perms->standard as $perm => $false)
					{
						if (!isset($perms->globals[$perm])) {
							$perms->set_xyz($perm, $newid, $perms->auth($perm, $this->post['sync']));
						}
					}
				}

				$perms->update();
			}

			$this->log_action( 'file_new_category', $newid );
			return $this->message( $this->lang->files_add_cat, $this->lang->files_add_cat_done, $this->lang->continue, "{$this->self}?a=files&amp;cid={$parent}" );
		}
	}

	function delete_file($cid)
	{
		if (!$this->file_perms->auth('delete_files', $cid)) {
			return $this->message($this->lang->files_action_not_allowed, $this->lang->files_delete_file_not_permitted);
		}

		if (!isset($this->get['fid'])) {
			return $this->message($this->lang->files_delete_file, $this->lang->files_delete_file_specify);
		}

		$id = intval($this->get['fid']);
		$out = "";
		if (!isset($this->post['submit'])) {
			$file = $this->db->fetch( 'SELECT file_name, file_id FROM %pfiles WHERE file_id=%d', $id );

			$out .= eval($this->template('FILE_DELETE'));
		} else {
			$name = $this->remove_file($id, true);
			$this->log_action( 'file_delete', $id );
			$out .= $this->message( $this->lang->files_delete_file, "{$name} " . $this->lang->files_delete_file_done, $this->lang->continue, "{$this->self}?a=files&amp;cid={$cid}" );
		}
		return $out;
	}

	function update_file($cid, $fid)
	{
		$file_upload = false;

		if(!$this->file_perms->auth('upload_files') || !$this->is_submitter($fid, $cid))
			return $this->message($this->lang->files_action_not_allowed, $this->lang->files_update_not_permitted);

		$file = $this->db->fetch( 'SELECT file_description FROM %pfiles WHERE file_id=%d', $fid );
		if(!$file)
			return $this->message( $this->lang->files_update_file, $this->lang->files_update_not_exist, $this->lang->continue, "{$this->self}?a=files&amp;cid={$cid}" );

		if(!isset($this->post['submit']) )
		{
			return eval($this->template('FILE_UPDATE'));
		}

		if( empty($this->post['file_description']) )
			return $this->message($this->lang->files_update_file, $this->lang->files_update_file_need_desc, $this->lang->continue, "{$this->self}?a=files&amp;s=update&amp;fid={$fid}&amp;cid={$cid}");

		$desc = $this->post['file_description'];

		if(!empty($this->files['code_update']['name'])) {
			$file_upload = true; // File present. Need to process the full update query.

			$filename = basename($this->files['code_update']['name']);
			$md5name = md5($filename.microtime());
			$date = $this->time;
			$size = intval( $this->files['code_update']['size']);
			$path = "./updates/".$md5name;
			$userId = $this->user['user_id'];

			$update = $this->db->fetch( "SELECT update_name FROM %pupdates WHERE update_name='%s'", $filename );
			if($update['update_name'] == $filename )
				return $this->message( $this->lang->files_update_file, $this->lang->files_update_exists, $this->lang->continue, "{$this->self}?a=files&amp;s=update&amp;fid={$fid}&amp;cid={$cid}" );

			if( is_uploaded_file($this->files['code_update']['tmp_name']))
			{
				if(file_exists($path) )
					return $this->message ($this->lang->files_update_file, $this->lang->files_exists, $this->lang->continue, "{$this->self}?a=files&amp;s=update&amp;fid={$fid}&amp;cid={$cid}"); 
				else
				{
					if(!move_uploaded_file($this->files['code_update']['tmp_name'], $path) )
						return $this->message($this->lang->files_update_file, $this->lang->files_error_unknown, $this->lang->continue, "{$this->self}?a=files&amp;s=update&amp;fid={$fid}&amp;cid={$cid}"); 
				}
			}
			else 
				return $this->message( $this->lang->files_update_file, $this->lang->files_error_trick );

			// Permissions update to allow rsync to back this file up
			$this->chmod( $path, 0644, false );
		}

		if( $file_upload ) {
			$this->db->query("INSERT INTO %pupdates
			(update_name, update_updating, update_description, update_md5name, update_date, update_size, update_updater)
			VALUES( '%s', %d, '%s', '%s', %d, %d, %d )", $filename, $fid, $desc, $md5name, $date, $size, $userId );

			$this->log_action( 'file_update', $fid );
			$this->sets['code_approval']++;
			$this->write_sets();

			return $this->message( $this->lang->files_update_file, $this->lang->files_update_pending, $this->lang->continue, "{$this->self}?a=files&amp;cid={$cid}" );
		} else {
			$this->db->query( "UPDATE %pfiles SET file_description='%s' WHERE file_id=%d", $desc, $fid );
			return $this->message( $this->lang->files_update_file, $this->lang->files_update_desc, $this->lang->continue, "{$this->self}?a=files&amp;cid={$cid}" );
		}
	}

	function deny_update($uid)
	{
		$update = $this->db->fetch( 'SELECT update_md5name, update_updater FROM %pupdates WHERE update_id=%d', $uid );
		// $message = "Thank you for submitting your file update, it was however denied for the following reason: ".$this->post['reason'];
		// $this->systemPM($update['update_updater'], "Your file update was denied.", $message);
		@unlink('./updates/' . $update['update_md5name']);

		$this->sets['code_approval']--;
		$this->write_sets();
		$this->db->query( 'DELETE FROM %pupdates WHERE update_id=%d', $uid );
		$this->log_action( 'file_deny_update', $uid );
		return $this->message( $this->lang->files_update_deny, $this->lang->files_update_denied, $this->lang->continue, "{$this->self}?a=files&amp;s=filequeue}" );
	}

	function approve_update($cid, $uid)
	{
		if (!$this->file_perms->auth('approve_files', $cid)) {
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_update_approval_not_permitted, $this->lang->continue, "{$this->self}?a=files&amp;cid={$cid}" );
		}
		
		$update = $this->db->fetch( 'SELECT * FROM %pupdates WHERE update_id=%d', $uid );
		if(!$update)
			return $this->message( $this->lang->files_update_approve, $this->lang->files_update_not_exist2, $this->lang->continue, "{$this->self}?a=files&amp;cid={$cid}" );
		
		$fid = $update['update_updating'];
		$file = $this->db->fetch( 'SELECT * FROM %pfiles WHERE file_id=%d', $fid );
		if(!$file)
			return $this->message( $this->lang->files_update_approve, $this->lang->files_update_not_exist, $this->lang->continue, "{$this->self}?a=files&amp;cid={$cid}" );
		
		$newpath = './downloads/' . $update['update_md5name'];
		if($update['update_md5name'] != $file['file_md5name'] && file_exists($newpath))
			return $this->message($this->lang->files_update_approve, $this->lang->files_update_exists);
		
		@unlink('./downloads/' . $file['md5name']);
		if(!copy('./updates/' . $update['update_md5name'], $newpath) )
			return $this->message($this->lang->files_update_approve, $this->lang->files_update_approve_failed);
		@unlink('./updates/' . $update['update_md5name']);
		
		$desc = $update['update_description'];
		$md5name = $update['update_md5name'];
		$filename = $update['update_name'];
		$size = $update['update_size'];
		$date = intval($update['update_date']);

		$this->db->query( "UPDATE %pfiles SET 
			file_description='%s', 
			file_md5name='%s',
			file_size=%d,
			file_filename='%s',
			file_revdate=%d,
			file_revision=file_revision+1 WHERE file_id=%d",
			 $desc, $md5name, $size, $filename, $date, $fid );
		$this->db->query( 'DELETE FROM %pupdates WHERE update_id=%d', $uid );

		$this->sets['code_approval']--;
		$this->write_sets();
		$this->log_action( 'file_approve_update', $uid, $fid );
		return $this->message( $this->lang->files_update_approve, $this->lang->files_update_approved, $this->lang->continue, "{$this->self}?a=files&amp;s=filequeue" );
	}
	
	function upload_file($cid)
	{
		if (!$this->file_perms->auth('upload_files', $cid)) {
			return $this->message($this->lang->files_action_not_allowed, $this->lang->files_upload_not_permitted);
		}

		if (!isset($this->post['submit'])) {
			$list = $this->get_categories($cid);

			return eval($this->template('FILE_UPLOAD'));
		}

		$catid = intval( $this->post['file_category'] );
		if ($catid == 0) {
			return $this->message( $this->lang->files_upload, $this->lang->files_upload_no_root);
		}

		if (empty($this->files['code_upload']['name']) || empty($this->post['file_author']) || empty($this->post['file_name']) || empty($this->post['file_description']) || empty($this->post['file_category'])) {
			return $this->message($this->lang->files_upload, $this->lang->files_all_fields_required);
		}

		$filename = basename($this->files['code_upload']['name']);
		$md5name = md5($filename . microtime());
		$newhome = './downloads/' . $md5name;

		$name = $this->post['file_name'];
		$size = intval( $this->files['code_upload']['size'] );
		$author = $this->post['file_author'];
		$desc = $this->post['file_description'];
		$uid = $this->user['user_id'];
		$date = $this->time;

		$file = $this->db->fetch( "SELECT file_filename FROM %pfiles WHERE file_filename='%s'", $filename );
		if ($file['file_filename'] == $filename) {
			return $this->message( $this->lang->files_upload, $this->lang->files_update_exists );
		}

		if (is_uploaded_file($this->files['code_upload']['tmp_name'])) {
			if (file_exists($newhome)) {
				return $this->message( $this->lang->files_upload, $this->lang->files_error_duplicate );
			} else {
				if (!move_uploaded_file($this->files['code_upload']['tmp_name'], $newhome)) {
					return $this->message( $this->lang->files_upload, $this->lang->files_error_unknown );
				}
			}
		} else {
			return $this->message( $this->lang->files_upload, $this->lang->files_error_trick );
		}

		// Permissions update to allow rsync to back this file up
		$this->chmod( $newhome, 0644, false );

		$approved = 0;
		if( $this->perms->auth('is_admin') ) // Because admins shouldn't have to get approval
			$approved = 1;

		$this->db->query( "INSERT INTO %pfiles 
		 (file_name, file_catid, file_filename, file_md5name, file_author, file_size, file_date, file_submitted, file_description, file_approved)
		 VALUES( '%s', %d, '%s', '%s', '%s', %d, %d, %d, '%s', %d )",
		  $name, $catid, $filename, $md5name, $author, $size, $date, $uid, $desc, $approved );

		if( $approved == 0 ) {
			$this->sets['code_approval']++;
			$this->write_sets();
			return $this->message( $this->lang->files_upload, $this->lang->files_upload_pending, $this->lang->continue, "{$this->self}?a=files&amp;cid={$catid}" );
		} else {
			$this->db->query( 'UPDATE %pusers SET user_uploads=user_uploads+1 WHERE user_id=%d', $uid );
			$this->increase_cat_count( $catid );

			$this->sets['file_count']++;
			$this->write_sets();
			return $this->message( $this->lang->files_upload, $this->lang->files_uploaded, $this->lang->continue, "{$this->self}?a=files&amp;cid={$catid}" );
		}
	}

	function download_file($cid)
	{
                if (!$this->file_perms->auth('download_files', $cid)) {
                        return $this->message($this->lang->files_action_not_allowed, $this->lang->files_download_not_permitted);
                }

		if (!isset($this->get['fid'])) {
			header('HTTP/1.0 404 Not Found');
			return $this->message($this->lang->files_download, $this->lang->files_download_specify);
		}

		$id = intval($this->get['fid']);

		$file = $this->db->fetch( 'SELECT file_filename, file_md5name, file_size FROM %pfiles WHERE file_id=%d', $id );

		$this->nohtml = true;
		$this->db->query( 'UPDATE %pfiles SET file_downloads=file_downloads+1 WHERE file_id=%d', $id );

		// Need to terminate and unlock the session at this point or the site will stall for the current user.
		session_write_close();

		ini_set("zlib.output_compression", "Off");
		header("Connection: close");
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"{$file['file_filename']}\"");
		header("Content-Length: " . $file['file_size']);
		header("X-Robots-Tag: noarchive, nosnippet, noindex");
		// directly pass through file to output buffer
		@readfile( './downloads/' . $file['file_md5name'] );
	}

	// NOTE: Need to change function around so it only prints a <table> if there is at least one result. -Asy
	function display_categories($cid)
	{
		$break = 0;
		$desc = "";

		if( $cid != 0 ) {
			$cat = $this->db->fetch( 'SELECT fcat_id, fcat_moderator, fcat_description FROM %pfile_categories WHERE fcat_id=%d', $cid );
			if (!$cat && $cid != 0 ) {
				header('HTTP/1.0 404 Not Found');
				return $this->message( $this->lang->files_delete_nocat, 'The category does not exist. It may have been deleted, or never existed.' );
			}
			$desc = $cat['fcat_description'];
		}

		$tree = $this->get_filetree($cid);
		$cats = $this->cat_array; // The cat_array is already populated by get_filetree, take advantage.

		$catlinks = "";
		foreach( $cats as $category )
		{
			if( $category['fcat_parent'] != $cid )
				continue;

			$id = $category['fcat_id'];

			// Don't display a category link for root
			if( $id == 0 )
				continue;

			if (!$this->file_perms->auth('category_view', $id))
				continue;

			$name = $category['fcat_name'];
			$count = $category['fcat_count'];

			$catlinks .= eval($this->template('FILE_CATLINK'));
			if (!(++$break % 5) ) {
				$catlinks .= '<br />';
			}
		}

		if( ($modId = $this->get_parent_mod($cats, $cid) ) != 0 )
		{
			$someMod = $this->db->fetch( 'SELECT user_name, user_id FROM %pusers WHERE user_id=%d', $modId );
			$moder = $someMod['user_name'];
			$moderid = $someMod['user_id'];
		}

		$displaycat = $this->display_category($cid,$desc);
		return eval($this->template('FILE_CATS'));
	}

	function recent_uploads()
	{
		$catitems = '';

		$date = $this->time - 864000; // 10 days old
		$query = $this->db->query(
		  'SELECT f.*, u.user_name, u.user_id
		    FROM %pfiles f
		    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
		    WHERE f.file_date>=%d AND f.file_approved=1
		    ORDER BY f.file_date DESC, f.file_name', $date );

		$i = 0;
		while( $row = $this->db->nqfetch( $query ) )
		{
			foreach($row as $key => $value)
				$$key = $value;

			if (!$this->file_perms->auth('category_view', $file_catid))
				continue;

			$i++;
                        if ($i % 2 == 0) {
                                $class = 'tablelight';
                        } else {
                                $class = 'tabledark';
                        }

			$date = $this->mbdate( DATE_ONLY_LONG, $file_date );

                        if( $file_revdate < 1 )
                                $revdate = '';
                        else
                                $revdate = $this->mbdate( DATE_ONLY_LONG, $file_revdate );

			$catitems .= eval($this->template('FILE_CATITEM'));
		}
		if( $i < 1 ) {
			return '';
		}
		else {
			return eval($this->template('FILE_RECENT'));
		}
	}

	function display_category($cid,$desc)
	{
		$i = 0;
		$catitems = "";
		$query = array();

		if($cid == 0) {
			$query = $this->db->query(
			  'SELECT f.*, u.user_name, u.user_id
			    FROM %pfiles f
			    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
			    WHERE f.file_approved=1
			    ORDER BY f.file_downloads DESC LIMIT 20' );
		} else {
			$query = $this->db->query(
			  'SELECT f.*, u.user_name, u.user_id
			    FROM %pfiles f
			    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
			    WHERE f.file_catid=%d AND file_approved=1
			    ORDER BY f.file_name ASC', $cid );
		}

		while( $row = $this->db->nqfetch( $query ) )
		{
			foreach($row as $key => $value)
				$$key = $value;

			if (!$this->file_perms->auth('category_view', $file_catid))
				continue;

			$i++;
                        if ($i % 2 == 0) {
                                $class = 'tablelight';
                        } else {
                                $class = 'tabledark';
                        }

			$date = $this->mbdate( DATE_ONLY_LONG, $file_date );
			if( $file_revdate < 1 )
				$revdate = '';
			else
				$revdate = $this->mbdate( DATE_ONLY_LONG, $file_revdate );

			$catitems .= eval($this->template('FILE_CATITEM'));
		}
		return eval($this->template('FILE_CATEGORY'));
	}

	function show_file($fid)
	{
		if ($fid == 0) {
			header('HTTP/1.0 404 Not Found');
			return $this->message( $this->lang->files_view, $this->lang->files_view_specify );
		}
		$file = "";

		$query = $this->db->fetch(
		  'SELECT f.*, u.user_name
		    FROM %pfiles f
		    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
		    WHERE file_id=%d', $fid );

                if (!$query) {
			header('HTTP/1.0 404 Not Found');
                        return $this->message( $this->lang->files_view, $this->lang->files_comment_specify );
		}

		foreach($query as $key => $value)
			$$key = $value;

		if (!$this->file_perms->auth('category_view', $file_catid))
			return $this->message( $this->lang->files_view, $this->lang->files_view_cat_not_permitted );

		$tree = $this->get_filetree($file_catid,true);
		$cid = $file_catid;
		$date = $this->mbdate( DATE_ONLY_LONG, $file_date );

		if($file_revision > 0)
			$rdate = $this->mbdate(DATE_ONLY_LONG, $file_revdate);
		$file_extension = strtolower(substr(strrchr($file_filename,'.'),1));
		switch( $file_extension ) 
		{
			case 'h': case 'c': $fileType = $this->lang->files_view_c; break;
			case 'txt': $fileType = $this->lang->files_view_plain; break;
			case 'php': $fileType = $this->lang->files_view_php; break;
			case 'pl': $fileType = $this->lang->files_view_perl; break;
			case 'py': $fileType = $this->lang->files_view_python; break;
			case 'cpp': case 'hh': case 'hpp': case 'cc': $fileType = $this->lang->files_view_cpp; break;
			case 'java': $fileType = $this->lang->files_view_java; break;
			case 'gz': case 'tgz': case 'zip': case 'rar': case '7z':
			case 'bz2': case 'tbz2': $fileType = $this->lang->files_view_archive; break;
			default: $fileType = $file_extension;
		}
		$filesize = ceil($file_size / 1024);
		$file_description = $this->format($file_description, FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_MBCODE);

		$move = false;
		if ($this->file_perms->auth('move_files', $cid))
			$move = true;
		$edit = false;
		if ($this->file_perms->auth('edit_files', $cid))
			$edit = true;
		$delete = false;
		if ($this->file_perms->auth('delete_files', $cid))
			$delete = true;

		return eval($this->template('FILE_DETAILS'));
	}

	function file_search()
	{
		if(!isset($this->post['submit'] ) )
		{
			if( isset($this->get['uid'] ) )
			{
				$uid = $this->get['uid'];
				$query = $this->db->query('SELECT * FROM %pfiles WHERE file_submitted=%d AND file_approved=1', $uid);
				return $this->run_search($query, 'UserID: '.$uid);
			}
			$selectItems = $this->nestedSelect();
			return eval($this->template('FILE_SEARCH'));
		}

		$query = 'SELECT * FROM %pfiles WHERE (';
		$searchFor = $this->post['query'];
		$searchBy = false;

		if(isset($this->post['sName']) )
		{
			$searchBy = true;
			$name = "file_name LIKE '%%%s%%' ";
		}

		if(isset($this->post['sDesc']) )
		{
			if(isset($name) )
			   $name .= 'OR ';
			$desc = "file_description LIKE '%%%s%%' ";
			$searchBy = true;
		}

		if(isset($this->post['sAuth']) )
		{
			if(isset($desc) )
				$desc .= 'OR ';
			else if(isset($name) )
			   $name .= 'OR ';
			$auth = "file_author LIKE '%%%s%%' ";
			$searchBy = true;
		}
		if(isset($name) )
			$query .= $name;
		if(isset($desc) )
			$query .= $desc;
		if(isset($auth) )
			$query .= $auth;

		if(!$searchBy)
			return $this->message($this->lang->files_search_error, $this->lang->continue, "{$this->self}?a=files&amp;s=search");

		$query .= ") AND (file_downloads >= {$this->post['downCount']} ";
		$query .= 'AND file_approved=1 ';
		if(isset($this->post['useRating']) )
			$query .= "AND file_rating >= {$this->post['minRating']} ";
		if(isset($this->post['byTime']) )
		{
			if ($this->post['time_way_select'] == 'newer')
				$way = '>=';
			else
				$way = '<=';
			
			$time = intval($this->post['time_select'] );
			$time = $this->time - ($time * 86400);
			$query .= 'AND file_date ' . $way . ' ' . $time . ' ';
		}

		$inCats = $this->post['cats'];
		if($inCats != 'all')
		{
			$catsQuery = ' ) AND (';
			for($i = 0; $i < sizeof($inCats) ; $i++ )
			{
				$catsQuery .= 'file_catid = ' . $inCats[$i] . ' ';
				if($i != sizeof($inCats)-1 )
					$catsQuery .= 'OR ';
			}
			$query .= $catsQuery;
		}
		$query .= ') LIMIT ' . $this->post['dispCount'];
		$results = $this->db->query($query, $searchFor, $searchFor, $searchFor); // Yes, intentional. Hackish, but intentional.
		return $this->run_search($results, $searchFor);
	}

	// Search query hijacks the file category templates
	function run_search($query, $qString)
	{
		$i = 0;
		$found = 0;
		$tree = '';

		$catitems = '';
		if($this->db->num_rows($query) == 0 )
			return $this->message($this->lang->files_search, $this->lang->files_search_error_none, $this->lang->continue, "{$this->self}?a=files&amp;s=search");
		while ($row = $this->db->nqfetch($query)) {
			$found++;
			foreach ($row as $key => $value)
				$$key = $value;

			if (!$this->file_perms->auth('category_view', $file_catid))
				continue;

			$date = $this->mbdate( DATE_ONLY_LONG, $file_date );

                        if( $file_revdate < 1 )
                                $revdate = '';
                        else
                                $revdate = $this->mbdate( DATE_ONLY_LONG, $file_revdate );

			$filesize = ceil($file_size / 1024);
			$user = $this->db->fetch( 'SELECT user_name, user_id FROM %pusers WHERE user_id=%d', $file_submitted );
			$file_description = $this->format($file_description, FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_MBCODE);

			$i++;
			if ($i % 2 == 0) 
				$class = 'tablelight';
			else
				$class = 'tabledark';

			$user_id = $user['user_id'];
			$user_name = $user['user_name'];
			$catitems .= eval($this->template('FILE_CATITEM'));
		}
		$cid = -1; // Neede this because FILE_CATEGORY also does the Top 20 Downloads listing for root
		return eval($this->template('FILES_SEARCHRESULT'));
	}

	function add_comment($cid)
	{
		if (!$this->file_perms->auth('post_comment', $cid)) {
			return $this->message($this->lang->files_action_not_allowed, $this->lang->files_comment_not_permitted);
		}

		$id = isset($this->get['fid']) ? $this->get['fid'] : 0;

		if (!isset($this->post['addcomment'])) {
			return eval($this->template('FILE_COMMENT_ADD'));
		} else {
			$text = $this->post['commentbody'];
			if (empty($text)) {
				return $this->message($this->lang->files_comment, $this->lang->files_comment_empty);
			}
			$uid = $this->user['user_id'];
			$this->db->query( "INSERT INTO %pfilecomments (file_id,comment_text,user_id) VALUES( %d, '%s', %d )", $id, $text, $uid );
			$this->db->query( 'UPDATE %pfiles SET file_comments=file_comments+1 WHERE file_id=%d', $id );

                        return $this->message($this->lang->files_comment, $this->lang->files_comment_posted, $this->lang->continue, "{$this->self}?a=files&amp;s=viewfile&amp;fid={$id}");
		}
	}

	function list_comments()
	{
		$id = isset($this->get['fid']) ? $this->get['fid'] : 0;

		if ($id == 0) {
			header('HTTP/1.0 404 Not Found');
			return $this->message($this->lang->files_comment_view, $this->lang->files_comment_specify);
		}

		$file = $this->show_file($id);
		$cfile = $this->db->fetch( 'SELECT file_name, file_catid FROM %pfiles WHERE file_id=%d', $id );

		$comments = '';

		$i = 0;
		$class = '';

		$query = $this->db->query(
		  'SELECT c.*, u.user_name
		    FROM %pfilecomments c
		    LEFT JOIN %pusers u ON u.user_id=c.user_id
		    WHERE c.file_id=%d', $id, $id );

		while( $row = $this->db->nqfetch( $query ) ) {
			$fid = $row['file_id'];
			$user_name = $row['user_name'];
			$text = $this->format($row['comment_text'], FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_MBCODE);

			$i++;
                        if ($i % 2 == 0) {
                                $class = 'tablelight';
                        } else {
                                $class = 'tabledark';
                        }
			$comments .= eval($this->template('FILE_COMMENT'));
		}
		$cid = $cfile['file_catid'];
		$can_comment = $this->file_perms->auth('post_comment', $cid);
		return eval($this->template('FILE_COMMENT_LIST'));
	}

	// Utility Functions

	function nestedSelect($cid = 0, $nest = 0, $selectArray = array())
	{
		$cats = $this->db->query( 'SELECT fcat_name, fcat_id, fcat_parent FROM %pfile_categories WHERE fcat_parent=%d', $cid );
		if($cats && $this->db->num_rows($cats) <= 0 )
			return '';

		$selectItems = '';
		$nestSpace = '';
		for($i = 0; $i < $nest; $i++ )
			$nestSpace .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		while( $row = $this->db->nqfetch($cats) )
		{
			$sArray = array();
			$toAdd = $this->nestedSelect($row['fcat_id'], $nest+1, $sArray);
			array_push($selectArray, $row['fcat_id']);
			$selectArray = array_merge($selectArray, $sArray);
			array_push($sArray, $row['fcat_id']);
			$selectItems .= "<option value='{$row['fcat_id']}' selected='selected' ondblclick='select_all_children(".implode($sArray, ", ").")'>{$nestSpace}{$row['fcat_name']}</option>\n";
			$selectItems .= $toAdd;
			if($cid == 0)
				$selectArray = array();
		}
		return $selectItems;
	}

	function remove_file($id, $count = false)
	{
		$file = $this->db->fetch( 'SELECT * FROM %pfiles WHERE file_id=%d', $id );

		@unlink('./downloads/' . $file['file_md5name']);
		$this->db->query( 'DELETE FROM %pfiles WHERE file_id=%d', $id );
		$this->db->query( 'DELETE FROM %pfileratings WHERE file_id=%d', $id );
		$this->db->query( 'DELETE FROM %pfilecomments WHERE file_id=%d', $id );
		if ($count) {
			$this->decrease_cat_count( $file['file_catid'] );
			$this->db->query( 'UPDATE %pfile_categories SET fcat_count=fcat_count-1 WHERE fcat_id=%d', $file['file_catid'] );
			$this->db->query( 'UPDATE %pusers SET user_uploads=user_uploads-1 WHERE user_id=%d', $file['file_submitted'] );
			$this->sets['file_count']--;
			$this->write_sets();
		}
		return $file['file_name'];
	}

	// Takes advantage of $cats being defined as $this->cat_array. If this is not true, will probably break. -- Samson
	function get_parent_mod($cats, $cid)
	{
		if( $cid == 0 )
			return 0;

		if($cats[$cid]['fcat_moderator'] != 0)
			return $cats[$cid]['fcat_moderator'];

		$pt = explode( ',', $cats[$cid]['fcat_tree'] );
		$parents = array_reverse( $pt );

		foreach( $parents as $parent )
		{
			if(!isset($cats[$parent]))
				continue;

			if($cats[$parent]['fcat_moderator'] != 0)
				return $cats[$parent]['fcat_moderator'];
		}
		return 0;
	}

	/*
	 * Builds the file navigation tree into a global array.
	 * Since this function gets called on many subscreens, the global array can save a whole lotta queries! -- Samson
	 */
	function get_filetree($cid, $linklast = false)
	{
		$cats = $this->category_array();

		$filetree = "<strong>&raquo;</strong> <a href=\"{$this->self}?a=files&amp;cid=0\">Root</a>";

		if( $cid != 0 )
		{
			$parents = explode( ',', $cats[$cid]['fcat_tree'] );

			foreach( $parents as $parent )
			{
				if(!isset($cats[$parent]))
					continue;

				$catname = $cats[$parent]['fcat_name'];
				$filetree .= " <strong>&raquo;</strong> <a href=\"{$this->self}?a=files&amp;cid={$parent}\">";
				$filetree .= $catname . '</a>';
			}

			$catname = $cats[$cid]['fcat_name'];

			if (!$linklast) {
				$filetree .= ' <strong>&raquo;</strong> ';
				$filetree .= $catname;
			} else {
				$filetree .= ' <strong>&raquo;</strong> ';
				$filetree .= "<a href=\"{$this->self}?a=files&amp;cid={$cid}\">{$catname}</a>";
			}
		}
		return $filetree;
	}

	/*
	 * Grabs a list of all file categories, sorted by the longpath.
	 * Used in various dialogues for easier category selections.
	 */
	function get_categories($cid)
	{
		$list = '';

		$query = $this->db->query( 'SELECT * FROM %pfile_categories ORDER BY fcat_longpath ASC' );
		while ($cat = $this->db->nqfetch($query))
		{
			$selected = '';
			if ($cid == $cat['fcat_id']) {
				$selected = ' selected="selected"';
			}

			if(!$this->file_perms->auth('category_view', $cat['fcat_id']))
				continue;
			$list .= "<option value=\"{$cat['fcat_id']}\"{$selected}>{$cat['fcat_longpath']}</option>\n";
		}
		return $list;
	}

	function is_submitter($fid, $cid)
	{
		$file = $this->db->fetch( 'SELECT file_submitted FROM %pfiles WHERE file_id=%d', $fid );
		if(!$file)
			return false;
		if ($this->perms->is_guest)
			return false;
		if ($this->file_perms->auth('edit_files', $cid))
			return true;
		if($file['file_submitted'] != $this->user['user_id'])
			return false;
		return true;
	}

	function get_longpath($cid)
	{
		$path = $this->db->fetch( 'SELECT fcat_longpath FROM %pfile_categories WHERE fcat_id=%d', $cid );
		if( isset($path['fcat_longpath']))
			return $path['fcat_longpath'];
		return '';
	}

	// Gotta recursively update all the children of this parent. Don't want longpaths being all fuxored. - Davion
	function update_children_longpath($cid)
	{
		$query = $this->db->query( 'SELECT fcat_id, fcat_name FROM %pfile_categories WHERE fcat_parent=%d', $cid );
		while( $row = $this->db->nqfetch( $query ) )
		{
			$newpath = $this->get_longpath($cid);
			$newpath .= '/' . $row['fcat_name'];

			$this->db->query( "UPDATE %pfile_categories SET fcat_longpath='%s' WHERE fcat_id=%d", $newpath, $row['fcat_id'] );
			$this->update_children_longpath($row['fcat_id']);
		}
	}

	function get_subcat($cid)
	{
                $query = $this->db->query( 'SELECT fcat_parent FROM %pfile_categories WHERE fcat_id=%d', $cid );
                if ($row = $this->db->nqfetch( $query ) ) {
                        return $row['fcat_parent'];
                }
	}

	// We want to see if cid is it's own parent, or being put into a catagory to which it is a parent of.
	// $pid is going to become the parent of $cid. If $cid == $pid bad. If $pid's parents are children of $cid, bad.
	// ... I hope! :) - Davion
	function is_parent($cid, $pid)
	{
		$onCat = $pid;
	
		while(1)
		{
			if($onCat == $cid)
				return true;
			$onCat = $this->get_subcat($onCat);
			if($onCat == 0 )
				break;
		}
		return false;
	}

	function create_tree($array, $id)
	{
		foreach ($array as $cat) {
			if ($cat['fcat_id'] == $id) {
				return preg_replace('/^,/', '', $cat['fcat_tree'] . ",$id");
			}
		}
	}

	function category_array()
	{
		if( $this->cat_array === false ) {
			$this->cat_array = array();

			$q = $this->db->query( 'SELECT * FROM %pfile_categories ORDER BY fcat_name' );

			while ($f = $this->db->nqfetch($q))
			{
				$this->cat_array[$f['fcat_id']] = $f;
			}
			return $this->cat_array;
		}
		return $this->cat_array;
	}

	// Stole^H^H^H^H^HBorrowed this from global.php updateForumTrees()
	function update_category_trees()
	{
		$cats = array();
		$catTree = array();
		
		// Build tree structure of 'id' => 'parent' structure
		$q = $this->db->query( 'SELECT fcat_id, fcat_parent FROM %pfile_categories ORDER BY fcat_parent' );
		
		while ($f = $this->db->nqfetch($q))
		{
			if ($f['fcat_parent']) {
				$cats[$f['fcat_id']] = $f['fcat_parent'];
			}
		}
		
		// Run through group
		$q = $this->db->query( 'SELECT fcat_parent FROM %pfile_categories GROUP BY fcat_parent' );

		while ($f = $this->db->nqfetch($q))
		{
			if ($f['fcat_parent']) {
				$tree = $this->buildTree($cats, $f['fcat_parent']);
			} else {
				$tree = '';
			}
		
			$this->db->query( "UPDATE %pfile_categories SET fcat_tree='%s' WHERE fcat_parent=%d", $tree, $f['fcat_parent'] );
		}
	}

	function buildTree($catsArray, $parent)
	{
		$tree = '';
		if (isset($catsArray[$parent]) && $catsArray[$parent]) {
			$tree = $this->buildTree($catsArray, $catsArray[$parent]);
			$tree .= ',';
		}
		$tree .= $parent;
		return $tree;
	}

	function increase_cat_count($cid, $value=1)
	{
		$category = $this->db->fetch('SELECT * FROM %pfile_categories WHERE fcat_id=%d', $cid);
		$parents = explode(',', $category['fcat_tree']);
		foreach($parents as $parent)
			$this->db->query('UPDATE %pfile_categories SET fcat_count=fcat_count+%d WHERE fcat_id=%d', $value, $parent);
		$this->db->query('UPDATE %pfile_categories SET fcat_count=fcat_count+%d WHERE fcat_id=%d', $value, $cid);
	}

	function decrease_cat_count($cid, $value=1)
	{
		$category = $this->db->fetch('SELECT * FROM %pfile_categories WHERE fcat_id=%d', $cid);
		$parents = explode(',', $category['fcat_tree']);
		foreach($parents as $parent)
			$this->db->query('UPDATE %pfile_categories SET fcat_count=fcat_count-%d WHERE fcat_id=%d',$value, $parent);
		$this->db->query('UPDATE %pfile_categories SET fcat_count=fcat_count-%d WHERE fcat_id=%d', $value, $cid);
	}
}
?>