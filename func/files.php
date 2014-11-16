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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/global.php';

/**
 * Downloads file browser
 *
 * @author 
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
		static $cat_array = false;
		$this->cat_array = &$cat_array;

                $this->tree("Files");
                $this->set_title("Files");
		$dowload = false;

		if (!isset($this->get['s'])) {
			$this->get['s'] = null;
		} 

		$cid = isset($this->get['cid']) ? $this->get['cid'] : 0;
		$fid = isset($this->get['fid']) ? $this->get['fid'] : 0;
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
			case 'restrict':
				$file_page = $this->toggle_restrict($cid);
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
				return $this->download_file();
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
				$file_page = $this->add_comment();
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
		return eval($this->template('FILES_MAIN'));
	}

	function fix_filecount()
	{
		if( !$this->perms->auth('is_admin') ) {
			return $this->message( "Action not allowed", "You are not permitted to perform that action!" );
		}

                $query = $this->db->fetch( "SELECT COUNT(file_id) files FROM %pfiles WHERE file_approved=1" );
		$query2 = $this->db->fetch( "SELECT COUNT(file_id) files FROM %pfiles WHERE file_approved=0" );
		$query3 = $this->db->fetch( "SELECT COUNT(update_id) files FROM %pupdates" );

		$this->sets['file_count'] = $query['files'];
		$this->sets['code_approval'] = $query2['files'] + $query3['files'];
		$this->write_sets();

		$cats = $this->db->query( "SELECT * FROM %pfile_categories" );
		while( ( $cat = $this->db->nqfetch($cats) ) )
		{
			$count = $this->db->fetch( "SELECT COUNT(file_id) files FROM %pfiles WHERE file_approved=1 AND file_catid=%d", $cat['fcat_id'] );
			$this->db->query( "UPDATE %pfile_categories SET fcat_count=%d WHERE fcat_id=%d", $count['files'], $cat['fcat_id'] );
		}
		$this->update_category_trees();
		return $this->message( "Fix File Stats", "The file count has been corrected." );
	}

	function edit_file()
	{
		$id = intval( $this->get['fid'] );
		$file = $this->db->fetch(
		  "SELECT f.*, u.user_name
		    FROM %pfiles f
		    LEFT JOIN %pusers u ON user_id=file_submitted
		    WHERE file_id=%d", $id );

		if (!$this->is_moderator( $file['file_catid']) ) {
			return $this->message("Edit File", "You have not been permitted to edit files.");
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
				return $this->message("Edit File", "All fields are required.");
			}

			$name = $this->post['file_name'];
			$catid = intval( $this->post['file_category'] );
			$author = $this->post['file_author'];
			$desc = $this->post['file_description'];

			$this->db->query( "UPDATE %pfiles SET file_name='%s', file_catid=%d, file_author='%s', file_description='%s' WHERE file_id=%d", $name, $catid, $author, $desc, $id );
			return $this->message( "Edit File", "{$file['file_name']} had been updated with new information.", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=viewfile&amp;fid={$id}" );
		}
	}

	function move_file()
	{
		$id = intval( $this->get['fid'] );
		$file = $this->db->fetch( "SELECT file_name, file_catid FROM %pfiles WHERE file_id=%d", $id );
		if (!$this->is_moderator($file['file_catid']) ){
			return $this->message("Edit File", "You have not been permitted to edit files.");
		}

		if (!isset($this->post['submit'])) {
			$list = $this->get_categories($file['file_catid']);

			return $this->message( "Move File", "
			<form action=\"{$this->self}?a=files&amp;s=move&amp;fid={$id}\" method=\"post\">
			 <div>Move <strong>{$file['file_name']}</strong> to which category?
			  <select name=\"category\">
			   {$list}
			  </select>
			  <input type=\"submit\" name=\"submit\" value=\"Move\" />
			 </div>
			</form>" );
		} else {
			$catid = intval( $this->post['category'] );

			$cat = $this->db->fetch( "SELECT name FROM %pfile_categories WHERE fcat_id=%d", $catid );
			if (!$cat) {
				return $this->message( "Move File", "No such category.", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=move&amp;fid={$id}" );
			}

			$this->db->query( "UPDATE %pfiles SET file_catid=%d WHERE file_id=%d", $catid, $id );
			return $this->message( "Move File", "<strong>{$file['file_name']}</strong> has been moved.", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$catid}" );
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

		if(isset($this->get['cid']) )
		{
			$cid = $this->get['cid'];
			if(!$this->is_moderator($cid) )
				return $this->message( "File Approval", "Sorry, you do not have permission to approve, deny or download this file." );
		}
		
		if (!$this->get['f']) {
			$i = 0;

			$files = "<div class=\"header\" style=\"text-align:center\">Files Awaiting Approval</div><br />";

			$query = $this->db->query(
			  "SELECT f.*, u.user_name
			    FROM %pfiles f
			    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
			    WHERE file_approved=0" );

			$updates = false;
			while ($file = $this->db->nqfetch($query))
			{
	                        foreach($file as $key => $value)
	                                $$key = $value;
				if(!$this->is_moderator($file_catid) )
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
			  "SELECT p.*, f.file_catid, u.user_name
			    FROM %pupdates p
			    LEFT JOIN %pusers u ON u.user_id=p.update_updater
			    LEFT JOIN %pfiles f ON f.file_id=p.update_updating" );

			while( $update = $this->db->nqfetch($query) )
			{
				foreach($update as $key => $value)
					$$key = $value;

				if(!$this->is_moderator($file_catid) )
					continue;

				$i++;
				$file_name = $update_name;
				$date = $this->mbdate(DATE_ONLY_LONG, $update_date);
				$filesize = ceil($update_size / 1024);

				$file_description = $this->format( $update_description, FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_MBCODE );
				
				$files .= eval($this->template('FILE_APPROVAL'));
			}

			if ($i == 0) {
				return $this->message( "Approve Files", "There are no files waiting for approval at this time." );
			}
			return $files;
		}

		if(!isset($this->get['cid']) )
			return $this->message("Approve Files", "Error. You can't go this far without a category attached.");
		if ($this->get['f'] == 'approve')
		{
			$id = intval( $this->get['fid'] );
			if($getUpdate)
				return $this->approve_update($cid, $id);
			$file = $this->db->fetch( "SELECT file_name, file_submitted, file_catid FROM %pfiles WHERE file_id=%d", $id );
			$this->db->query( "UPDATE %pfiles SET file_approved=1 WHERE file_id=%d", $id );
			$this->db->query( "UPDATE %pusers SET user_uploads=user_uploads+1 WHERE user_id=%d", $file['file_submitted'] );
			$this->db->query( "UPDATE %pfile_categories SET fcat_count=fcat_count+1 WHERE fcat_id=%d", $file['file_catid'] );

			$this->sets['code_approval']--;
			$this->sets['file_count']++;
			$this->write_sets();
			return $this->message( "Approve Files", "{$file['file_name']} has been approved.", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=filequeue" );
		}

		if ($this->get['f'] == 'deny') {
			$id = intval( $this->get['fid'] );
			if(!isset($this->post['submit'] ) )
				return eval($this->template('FILE_DENY') );
			
			if($getUpdate)
				return $this->deny_update($id);
			$file = $this->db->fetch( "SELECT file_submitted FROM %pfiles WHERE file_id=%d", $id );
			$name = $this->remove_file($id);

			// $message = "Thank you for submitting your file, it was however denied for the following reason: ".$this->post['reason'];
			// $this->systemPM($file['file_submitted'], "Your file submission was denied.", $message);

			$this->sets['code_approval']--;
			$this->write_sets();
			return $this->message( "Approve Files", "{$name} has been denied.", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=filequeue");
		}

		if ($this->get['f'] == 'download') {
			$id = intval( $this->get['fid'] );
			
			if(!$getUpdate)
			{
				$file = $this->db->fetch( "SELECT file_filename, file_md5name, file_catid FROM %pfiles WHERE file_id=%d", $id );
				$filename = $file['file_filename'];
				$md5name = $file['file_md5name'];
				$basepath = "./downloads/";
			}
			else
			{
				$update = $this->db->fetch( "SELECT update_name, update_md5name, update_updating FROM %pupdates WHERE update_id=%d", $id );
				$filename = $update['update_name'];
				$md5name = $update['update_md5name'];
				$basepath = "./updates/";
			}
			
			$this->nohtml = true;
			
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"{$filename}\"");
			readfile($basepath . $md5name);
		}
		return $this->message("Approve Files", "Invalid option flag", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=filequeue");
	}

	function edit_category($cid)
	{
		if (!$this->is_moderator($cid)) {
			return $this->message("Edit Category", "You have not been permitted to edit categories.");
		}

		if ($cid == 0) {
			return $this->message("Edit Category", "You cannot edit the root category.");
		}

		if (!isset($this->post['submit'])) {
			$cat = $this->db->fetch( "SELECT fcat_name, fcat_parent, fcat_restricted FROM %pfile_categories WHERE fcat_id=%d", $cid );
			$list = $this->get_categories($cat['fcat_parent']);

			$selected = "";
			if ($cat['fcat_parent'] == 0) {
				$selected = " selected=\"selected\"";
			}
			$restricted = $cat['fcat_restricted'];

			return $this->message("Edit Category", "
			<form action=\"{$this->self}?a=files&amp;s=editcategory&amp;cid={$cid}\" method=\"post\">
			 <div>Name: <input type=\"text\" name=\"cat_name\" value=\"{$cat['fcat_name']}\" maxlength=\"32\" /></div>
			 <div>Parent Category:
			  <select name=\"parent\">
			   <option value=\"0\"{$selected}>/</option>
			   {$list}
			  </select>
			 </div>
			 <input type=\"checkbox\" name=\"restricted\" value=\"1\" id=\"restricted\" /><label for\"restricted\">Category is restricted?</label><br /><br />
			 <div><input type=\"submit\" name=\"submit\" value=\"Edit\" /></div>
			</form>" );
		} else {
			$parent = intval($this->post['parent']);
			$name = $this->post['cat_name'];
			$longpath = $this->get_longpath($parent);

			$cat = $this->db->fetch( "SELECT * FROM %pfile_categories WHERE fcat_id=%d", $cid );
			if(!$this->is_moderator($parent) )
				return $this->message("Edit Category", "You can only edit categories that you moderate.");
			if ($this->is_parent($cat['fcat_id'], $parent) ) {
				return $this->message("Edit Category", "You can't make the category its own parent!");
			}

			$ecat = $this->db->fetch( "SELECT fcat_name, fcat_parent FROM %pfile_categories WHERE fcat_name='%s'", $name );
			if ($ecat && $ecat['fcat_parent'] == $parent) {
				if ($parent == 0) {
					$path = "Root";
				} else {
					$path = $longpath;
				}
				return $this->message("Edit Category", "A category named \"{$name}\" already exists in {$path}.");
			}

			$restricted = isset($this->post['restricted']) ? 1 : 0;

			$longpath .= "/{$name}";
			$this->db->query( "UPDATE %pfile_categories SET fcat_name='%s', fcat_parent=%d, fcat_longpath='%s', fcat_restricted=%d WHERE id=%d", $name, $parent, $longpath, $restricted, $cid );
			$this->update_children_longpath($cat['id']);
			$this->update_category_trees();
			return $this->message( "Edit Category", "Category \"{$name}\" has been edited.", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$cid}" );
		}
	}

	function delete_category($cid)
	{
		if (!$this->is_moderator($cid)) {
			return $this->message("Delete Category", "You have not been permitted to delete categories.");
		}

		if (!isset($this->post['submit'])) {
			$list = $this->get_categories($cid);

			return $this->message("Delete Category", "
			<form action=\"{$this->self}?a=files&amp;s=deletecategory\" method=\"post\">
			 <div>Delete which existing category?
			  <select name=\"category\">
			   {$list}
			  </select>
			  <input type=\"submit\" name=\"submit\" value=\"Delete\" />
			 </div>
			</form>");
		} else {
			if (!isset($this->post['category'])) {
				return $this->message("Delete Category", "No such category.", "{$this->lang->continue}", "{$this->self}?a=files");
			}

			$catid = intval( $this->post['category'] );
			if (!$this->is_moderator($catid)) {
				return $this->message("Delete Category", "You have not been permitted to delete categories.");
			}

			$cat = $this->db->fetch( "SELECT fcat_name, fcat_parent, fcat_count FROM %pfile_categories WHERE fcat_id=%d", $catid );
			if (!$cat) {
				return $this->message( "Delete Category", "No such category.", "{$this->lang->continue}", "{$this->self}?a=files" );
			}

			$count = $cat['fcat_count'];

			if ($count > 0) {
				return $this->message("Delete Category", "The {$cat['fcat_name']} category is not empty. Cannot delete.", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$catid}");
			}

			$this->db->query( "DELETE FROM %pfile_categories WHERE fcat_id=%d", $catid );

			return $this->message( "Delete Category", "The {$cat['fcat_name']} category has been deleted.", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$cat['fcat_parent']}" );
		}
	}

	function toggle_restrict($cid)
	{
		if (!$this->perms->auth('is_admin'))
                        return $this->message( "Toggle Restriction", "You don't have permission to toggle the restricted flag.", "{$this->lang->continue}", "{$this->self}?a=files&cid={$cid}");
		
		$cat = $this->db->fetch( "SELECT fcat_restricted, fcat_name FROM %pfile_categories WHERE fcat_id=%d", $cid );
		if( $cat == NULL )
			return $this->message( "Toggle Restriction", "We could not grab that category. Try again.", "{$this->lang->continue}", "{$this->self}?a=files&cid={$cid}" );
		
		if( $cat['fcat_restricted'] == 0 )
		{
			$this->db->query( "UPDATE %pfile_categories SET fcat_restricted=1 WHERE fcat_id=%d", $cid );
			return $this->message("Toggle Restriction", "This category is now restricted.", "{$this->lang->continue}", "{$this->self}?a=files&cid={$cid}");
		}

		$this->db->query( "UPDATE %pfile_categories SET fcat_restricted=0 WHERE fcat_id=%d", $cid );
		return $this->message("Toggle Restriction", "This is category is no longer restricted.", "{$this->lang->continue}", "{$this->self}?a=files&cid={$cid}" );
	}

	function add_moderator($cid)
	{
		if (!$this->perms->auth('is_admin'))
			return $this->message( "Add Moderator", "You don't have permission to add a moderator." );
		
		if(!isset($this->post['submit']))
		{
			$list = $this->get_categories($cid);
			
			return $this->message("Add Moderator", "
			<form action=\"{$this->self}?a=files&amp;s=addmoderator\" method=\"post\">
				<div>Add User as Moderator:<br />
					<input type=\"text\" name=\"mod_name\" value \"\" maxlength=\"32\" /><br /> <br />
						To which existing category?
						<select name=\"parent\">
			  				<option value=\"0\">/</option>
							{$list}
						</select>
					<input type=\"submit\" name=\"submit\" value=\"Add\" />
				</div>
			</form>");		
		}
		else
		{
			$parent = intval($this->post['parent']);
			$name = $this->post['mod_name'];
			if( !( $newMod = $this->db->fetch( "SELECT user_id, user_name FROM %pusers WHERE user_name='%s'", $name ) ) )
				return $this->message( "Add Moderator", "That user was not found to add." );
			$this->db->query( "UPDATE %pfile_categories SET fcat_moderator=%d WHERE fcat_id=%d", $newMod['user_id'], $parent );
			return $this->message( "Add Moderator", "Success! {$newMod['user_name']} has been made a moderator." );
		}
	}

	function rem_moderator($cid)
	{
		if (!$this->perms->auth('is_admin'))
			return $this->message( "Remove Moderator", "You don't have permission to remove a moderator." );
		
		if(!isset($this->post['submit']))
		{
			$list = $this->get_categories($cid);
			
			return $this->message("Remove Moderator", "
			<form action=\"{$this->self}?a=files&amp;s=remmoderator\" method=\"post\">
				<div>	Which categories moderator would you like to remove?
						<select name=\"parent\">
			  				<option value=\"0\">/</option>
							{$list}
						</select>
					<input type=\"submit\" name=\"submit\" value=\"Remove\" />
				</div>
			</form>");		
		}
		else
		{
			$parent = intval($this->post['parent']);
			$this->db->query( "UPDATE %pfile_categories SET fcat_moderator=0 WHERE fcat_id=%d", $parent );
			return $this->message( "Remove Moderator", "Success! The moderator for that category has been removed." );
		}
	}

	function add_category($cid)
	{
		if (!$this->is_moderator($cid)) {
			return $this->message("Add Category", "You have not been permitted to add categories.");
		}

		if (!isset($this->post['submit'])) {
			$list = $this->get_categories($cid);

			return $this->message("Add Category", "
			<form action=\"{$this->self}?a=files&amp;s=addcategory&amp;cid={$cid}\" method=\"post\">
			 <div>Add new category named:<br />
			 <input type=\"text\" name=\"cat_name\" value=\"\" maxlength=\"32\" /><br /><br />
			 To which existing category?
			  <select name=\"parent\">
			   <option value=\"0\">/</option>
			   {$list}
			  </select><br />
			  <input type=\"checkbox\" name=\"restricted\" value=\"0\" id=\"restricted\" /><label for\"restricted\">Category is restricted?</label><br /><br />
			  <input type=\"submit\" name=\"submit\" value=\"Add\" />
			 </div>
			</form>");
		} else {
			$parent = intval($this->post['parent']);
			$name = $this->post['cat_name'];
			$longpath = $this->get_longpath($parent);

			if (!$this->is_moderator($parent)) {
				return $this->message("Add Category", "You have not been permitted to add categories.");
			}

			$cat = $this->db->fetch( "SELECT fcat_name, fcat_parent FROM %pfile_categories WHERE fcat_name='%s'", $name );
			if ($cat && $cat['fcat_parent'] == $parent) {
				if ($parent == 0) {
					$path = "Root";
				} else {
					$path = $longpath;
				}
				return $this->message( "Add Category", "A category named \"{$name}\" already exists in {$path}." );
			}

			$restricted = isset($this->post['restricted']) ? 1 : 0;

			$longpath .= "/{$name}";

			$cats = $this->category_array();
			$tree = '';
			if( $parent != 0 )
				$tree = $this->create_tree( $cats, $parent );

			$this->db->query( "INSERT INTO %pfile_categories (fcat_parent, fcat_name, fcat_longpath, fcat_restricted, fcat_tree) VALUES( %d, '%s', '%s', %d, '%s' )", $parent, $name, $longpath, $restricted, $tree );

			return $this->message( "Add Category", "New category \"{$name}\" has been added.", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$parent}" );
		}
	}

	function delete_file($cid)
	{
		if (!$this->is_moderator($cid)) {
			return $this->message("Delete File", "You have not been permitted to delete files.");
		}

		if (!isset($this->get['fid'])) {
			return $this->message("Delete File", "You must specify a file to delete.");
		}

		$id = intval($this->get['fid']);
		$out = "";
		if (!isset($this->post['submit'])) {
			$file = $this->db->fetch( "SELECT file_name, file_id FROM %pfiles WHERE file_id=%d", $id );

			$out .= eval($this->template('FILE_DELETE'));
		} else {
			$name = $this->remove_file($id, true);

			$out .= $this->message( "Delete File", "{$name} has been deleted.", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$cid}" );
		}
		return $out;
	}

	function update_file($cid, $fid)
	{
		$file_upload = false;

		if(!$this->perms->auth('submit_files') || !$this->is_submitter($fid, $cid))
			return $this->message("Update File", "You do not have the permission to update this file.");

		$file = $this->db->fetch( "SELECT file_description FROM %pfiles WHERE file_id=%d", $fid );
		if(!$file)
			return $this->message( "Update File", "This file does not exist and cannot be updated. Try submitting new!", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$cid}" );

		if(!isset($this->post['submit']) )
		{
			return eval($this->template('FILE_UPDATE'));
		}

		if( empty($this->post['file_description']) )
			return $this->message("Update File", "The description field must be filled in.", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=update&amp;fid={$fid}&amp;cid={$cid}");

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
				return $this->message( "Update File", "A file like that already exists in our database.", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=update&amp;fid={$fid}&amp;cid={$cid}" );

			if( is_uploaded_file($this->files['code_update']['tmp_name']))
			{
				if(file_exists($path) )
					return $this->message ("Update File", "A file like that already exists.", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=update&amp;fid={$fid}&amp;cid={$cid}"); 
				else
				{
					if(!move_uploaded_file($this->files['code_update']['tmp_name'], $path) )
						return $this->message("Update File", "Unable to process: Unknown file error.", "{this->lang->continue}", "{$this->self}?a=files&amp;s=update&amp;fid={$fid}&amp;cid={$cid}"); 
				}
			} 
			else 
				return $this->message( "Update File", "You tried to tricks us!" );

			// Permissions update to allow rsync to back this file up
			$this->chmod( $path, 0644, false );
		}

		if( $file_upload ) {
			$this->db->query("INSERT INTO %pupdates
			(update_name, update_updating, update_description, update_md5name, update_date, update_size, update_updater)
			VALUES( '%s', %d, '%s', '%s', %d, %d, %d )", $filename, $fid, $desc, $md5name, $date, $size, $userId );

			$this->sets['code_approval']++;
			$this->write_sets();

			return $this->message( "Update File", "Your update has been uploaded and is pending approval.", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$cid}" );
		} else {
			$this->db->query( "UPDATE %pfiles SET file_description='%s' WHERE file_id=%d", $desc, $fid );
			return $this->message( "Update File", "The description has been updated.", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$cid}" );
		}
	}

	function deny_update($uid)
	{
		$update = $this->db->fetch( "SELECT update_md5name, update_updater FROM %pupdates WHERE update_id=%d", $uid );
		// $message = "Thank you for submitting your file update, it was however denied for the following reason: ".$this->post['reason'];
		// $this->systemPM($update['update_updater'], "Your file update was denied.", $message);
		@unlink("./updates/".$update['update_md5name']);

		$this->sets['code_approval']--;
		$this->write_sets();
		$this->db->query( "DELETE FROM %pupdates WHERE update_id=%d", $uid );
		return $this->message( "Deny Update", "Update has been denied and purged.", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=filequeue}" );
	}

	function approve_update($cid, $uid)
	{
		if(!$this->is_moderator($cid) )
			return $this->message( "Approve Update", "You do not have the permission to approve this update.", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$cid}" );
		
		$update = $this->db->fetch( "SELECT * FROM %pupdates WHERE update_id=%d", $uid );
		if(!$update)
			return $this->message( "Approve Update", "You can't approve updates that don't exist!", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$cid}" );
		
		$fid = $update['update_updating'];
		$file = $this->db->fetch( "SELECT * FROM %pfiles WHERE file_id=%d", $fid );
		if(!$file)
			return $this->message( "Approve Update", "Updating file has not been found.", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$cid}" );
		
		$newpath = "./downloads/".$update['update_md5name'];
		if($update['update_md5name'] != $file['file_md5name'] && file_exists($newpath))
			return $this->message("Approve Update", "Cannot update. A file with that name already exists.");
		
		@unlink("./downloads/".$file['md5name']);
		if(!copy("./updates/".$update['update_md5name'], $newpath) )
			return $this->message("Approve Update", "Failed to copy update into downloads directory!");
		@unlink("./updates/".$update['update_md5name']);
		
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
		$this->db->query( "DELETE FROM %pupdates WHERE update_id=%d", $uid );

		$this->sets['code_approval']--;
		$this->write_sets();
		return $this->message( "Approve Updates", "The update has been approved.", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=filequeue" );
	}
	
	function upload_file($cid)
	{
		if (!$this->perms->auth('submit_files')) {
			return $this->message("Upload File", "You have not been permitted to upload files.");
		}

		$cat = $this->db->fetch( "SELECT fcat_restricted FROM %pfile_categories WHERE fcat_id=%d", $cid );
		if ($cat['fcat_restricted'] && !$this->is_moderator($cid)) {
			return $this->message("Upload File", "This category is not available for general uploads.");
		}

		if (!isset($this->post['submit'])) {
			$list = $this->get_categories($cid);

			return eval($this->template('FILE_UPLOAD'));
		}

		if (empty($this->files['code_upload']['name']) || empty($this->post['file_author']) || empty($this->post['file_name']) || empty($this->post['file_description']) || empty($this->post['file_category'])) {
			return $this->message("Submit File", "All fields are required for uploads.");
		}

		$filename = basename($this->files['code_upload']['name']);
		$md5name = md5($filename . microtime());
		$newhome = "./downloads/" . $md5name;

		$name = $this->post['file_name'];
		$size = intval( $this->files['code_upload']['size'] );
		$catid = intval( $this->post['file_category'] );
		$author = $this->post['file_author'];
		$desc = $this->post['file_description'];
		$uid = $this->user['user_id'];
		$date = $this->time;

		$file = $this->db->fetch( "SELECT file_filename FROM %pfiles WHERE file_filename='%s'", $filename );
		if ($file['file_filename'] == $filename) {
			return $this->message( "Submit File", "A file by that name already exists in the database." );
		}

		if (is_uploaded_file($this->files['code_upload']['tmp_name'])) {
			if (file_exists($newhome)) {
				return $this->message( "Submit File", "Unable to process: duplicate filename error." );
			} else {
				if (!move_uploaded_file($this->files['code_upload']['tmp_name'], $newhome)) {
					return $this->message( "Submit File", "Unable to process: Unknown file error." );
				}
			}
		} else {
			return $this->message( "Submit File", "You tried to tricks us!" );
		}

		// Permissions update to allow rsync to back this file up
		$this->chmod( $newhome, 0644, false );

		$this->db->query( "INSERT INTO %pfiles 
		 (file_name, file_catid, file_filename, file_md5name, file_author, file_size, file_date, file_submitted, file_description)
		 VALUES( '%s', %d, '%s', '%s', '%s', %d, %d, %d, '%s' )",
		  $name, $catid, $filename, $md5name, $author, $size, $date, $uid, $desc );

		$this->sets['code_approval']++;
		$this->write_sets();
		return $this->message( "Submit File", "The file has been uploaded and is pending approval.", "{$this->lang->continue}", "{$this->self}?a=files&amp;cid={$catid}" );
	}

	function download_file()
	{
                if (!$this->perms->auth('download_files')) {
                        return $this->message("Download File", "You have not been permitted to download files.");
                }

		if (!isset($this->get['fid'])) {
			return $this->message("Download File", "You must specify a file to download.");
		}

		$id = intval($this->get['fid']);

		$file = $this->db->fetch( "SELECT file_filename, file_md5name FROM %pfiles WHERE file_id=%d", $id );

		$this->nohtml = true;
		$this->db->query( "UPDATE %pfiles SET file_downloads=file_downloads+1 WHERE file_id=%d", $id );

		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"{$file['file_filename']}\"");
		readfile('./downloads/' . $file['file_md5name']);
	}

	// NOTE: Need to change function around so it only prints a <table> if there is at least one result. -Asy
	function display_categories($cid)
	{
		$break = 0;

		if( $cid != 0 ) {
			$cat = $this->db->fetch( "SELECT fcat_id, fcat_moderator FROM %pfile_categories WHERE fcat_id=%d", $cid );
			if (!$cat && $cid != 0 ) {
				return $this->message( "Error", "The category does not exist. It may have been deleted, or never existed." );
			}
		}

		$tree = $this->get_filetree($cid);
		$cats = $this->cat_array; // The cat_array is already populated by get_filetree, take advantage.

		$catlinks = "";
		foreach( $cats as $category )
		{
			if( $category['fcat_parent'] != $cid )
				continue;

			$id = $category['fcat_id'];
			$name = $category['fcat_name'];
			$count = $category['fcat_count'];

			if( !( $break % 5 ) ) {
				$catlinks .= "<tr>";
			}
			$catlinks .= eval($this->template('FILE_CATLINK'));
			if (!(++$break % 5) ) {
				$catlinks .= "</tr>";
			}
		}

		if( ($modId = $this->get_parent_mod($cats, $cid) ) != 0 )
		{
			$someMod = $this->db->fetch( "SELECT user_name, user_id FROM %pusers WHERE user_id=%d", $modId );
			$moder = $someMod['user_name'];
			$moderid = $someMod['user_id'];
		}

		$displaycat = $this->display_category($cid);
		return eval($this->template('FILE_CATS'));
	}

	function recent_uploads()
	{
		$catitems = "";

		$date = $this->time - 864000; // 10 days old
		$query = $this->db->query(
		  "SELECT f.*, u.user_name, u.user_id
		    FROM %pfiles f
		    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
		    WHERE f.file_date>=%d AND f.file_approved=1
		    ORDER BY f.file_date DESC, f.file_name", $date );

		$i = 0;
		while( $row = $this->db->nqfetch( $query ) )
		{
			foreach($row as $key => $value)
				$$key = $value;

			$i++;
                        if ($i % 2 == 0) {
                                $class = 'tablelight';
                        } else {
                                $class = 'tabledark';
                        }

			$date = $this->mbdate( DATE_ONLY_LONG, $file_date );

			$catitems .= eval($this->template('FILE_CATITEM'));
		}
		if( $i < 1 ) {
			return "";
		}
		else {
			return eval($this->template('FILE_RECENT'));
		}
	}

	function display_category($cid)
	{
		$i = 0;
		$catitems = "";
		$query = array();

		if($cid == 0) {
			$query = $this->db->query(
			  "SELECT f.*, u.user_name, u.user_id
			    FROM %pfiles f
			    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
			    WHERE f.file_approved=1
			    ORDER BY f.file_downloads DESC LIMIT 20" );
		} else {
			$query = $this->db->query(
			  "SELECT f.*, u.user_name, u.user_id
			    FROM %pfiles f
			    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
			    WHERE f.file_catid=%d AND file_approved=1
			    ORDER BY f.file_name ASC", $cid );
		}
		while( $row = $this->db->nqfetch( $query ) )
		{
			foreach($row as $key => $value)
				$$key = $value;

			$i++;
                        if ($i % 2 == 0) {
                                $class = 'tablelight';
                        } else {
                                $class = 'tabledark';
                        }

			$date = $this->mbdate( DATE_ONLY_LONG, $file_date );

			$catitems .= eval($this->template('FILE_CATITEM'));
		}
		if( $i < 1 ) {
			return "";
		}
		else {
			return eval($this->template('FILE_CATEGORY'));
		}
	}

	function show_file($fid)
	{
		if ($fid == 0) {
			return $this->message( "View File", "No file id was supplied." );
		}
		$file = "";

		$query = $this->db->fetch(
		  "SELECT f.*, u.user_name
		    FROM %pfiles f
		    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
		    WHERE file_id=%d", $fid );

		foreach($query as $key => $value)
			$$key = $value;

		$tree = $this->get_filetree($file_catid,true);
		$cid = $file_catid;
		$date = $this->mbdate( DATE_ONLY_LONG, $file_date );

		if($file_revision > 0)
			$rdate = $this->mbdate(DATE_ONLY_LONG, $file_revdate);
		$file_extension = strtolower(substr(strrchr($file_filename,"."),1));
		switch( $file_extension ) 
		{
			case "h": case "c": $fileType = "C Source"; break;
			case "txt": $fileType = "Plain Text"; break;
			case "php": $fileType = "Php Source"; break;
			case "pl": $fileType = "Perl Script"; break;
			case "py": $fileType = "Python Script"; break;
			case "cpp": case "hh": case "hpp": case "cc": $fileType = "C++ Source"; break;
			case "java": $fileType = "Java Source"; break;
			case "gz": case "tgz": case "zip": case "rar":
			case "bz2": case "tbz2": $fileType="Archive"; break;
			default: $fileType=$file_extension;
		}
		$filesize = ceil($file_size / 1024);
		$file_description = $this->format($file_description, FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_MBCODE);

		return eval($this->template('FILE_DETAILS'));
	}

	function file_search()
	{
		if(!isset($this->post['submit'] ) )
		{
			if( isset($this->get['uid'] ) )
			{
				$uid = $this->get['uid'];
				$query = $this->db->query("SELECT * FROM %pfiles WHERE file_submitted=%d AND file_approved=1", $uid);
				return $this->run_search($query, "UserID: ".$uid);
			}
			$selectItems = $this->nestedSelect();
			return eval($this->template("FILE_SEARCH"));
		}
		
		$query = "SELECT * FROM %pfiles WHERE (";
		$searchFor = $this->post['query'];
		$searchBy = false;

		if(isset($this->post['sName']) )
		{
			$searchBy = true;
			$name = "file_name LIKE '%%".$searchFor."%%' ";
		}

		if(isset($this->post['sDesc']) )
		{
			if(isset($name) )
			   $name .= "OR ";
			$desc = "file_description LIKE '%%".$searchFor."%%' ";
			$searchBy = true;
		}

		if(isset($this->post['sAuth']) )
		{
			if(isset($desc) )
				$desc .= "OR ";
			else if(isset($name) )
			   $name .= "OR ";
			$auth = "file_author LIKE '%%".$searchFor."%%' ";
			$searchBy = true;
		}
		if(isset($name) )
			$query .= $name;
		if(isset($desc) )
			$query .= $desc;
		if(isset($auth) )
			$query .= $auth;

		if(!$searchBy)
			return $this->message("You have to search by atleast the name, author or descripton.", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=search");

		$query .= ") AND (file_downloads >= ".$this->post['downCount']." ";
		$query .= "AND file_approved=1 ";
		if(isset($this->post['useRating']) )
			$query .= "AND file_rating >= ".$this->post['minRating']." ";
		if(isset($this->post['byTime']) )
		{
			if ($this->post['time_way_select'] == 'newer')
				$way = '>=';
			else
				$way = '<=';
			
			$time = intval($this->post['time_select'] );
			$time = $this->time - ($time * 86400);
			$query .= "AND file_date ".$way." ".$time." ";
		}

		$inCats = $this->post['cats'];
		if($inCats != "all")
		{
			$catsQuery = " ) AND (";
			for($i = 0; $i < sizeof($inCats) ; $i++ )
			{
				$catsQuery .= "file_catid = ".$inCats[$i]." ";
				if($i != sizeof($inCats)-1 )
					$catsQuery .= "OR ";
			}
			$query .= $catsQuery;
		}
		$query .= ") LIMIT ".$this->post['dispCount'];
		$results = $this->db->query($query);
		return $this->run_search($results, $searchFor);
	}

	// Search query hijacks the file category templates
	function run_search($query, $qString)
	{
		$i = 0;
		$found = 0;
		$tree = "";

		$catitems = "";
		if($this->db->num_rows($query) == 0 )
			return $this->message("File Search", "No files found.", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=search");
		while ($row = $this->db->nqfetch($query)) {
			$found++;
			foreach ($row as $key => $value)
				$$key = $value;
			$date = $this->mbdate( DATE_ONLY_LONG, $file_date );
			$filesize = ceil($file_size / 1024);
			$user = $this->db->fetch( "SELECT user_name, user_id FROM %pusers WHERE user_id=%d", $file_submitted );
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

	function add_comment()
	{
		if ($this->perms->auth('is_guest')) {
			return $this->message("Add Comment", "Guests may not post file comments.");
		}

		$id = isset($this->get['fid']) ? $this->get['fid'] : 0;

		if (!isset($this->post['addcomment'])) {
			return eval($this->template('FILE_COMMENT_ADD'));
		} else {
			$text = $this->post['commentbody'];
			if (empty($text)) {
				return $this->message("Add Comment", "Your comment doesn't contain anything.");
			}
			$uid = $this->user['user_id'];
			$this->db->query( "INSERT INTO %pfilecomments (file_id,comment_text,user_id) VALUES( %d, '%s', %d )", $id, $text, $uid );
			$this->db->query( "UPDATE %pfiles SET file_comments=file_comments+1 WHERE file_id=%d", $id );

                        return $this->message("Add Comment", "Your comment has been posted.", "{$this->lang->continue}", "{$this->self}?a=files&amp;s=viewfile&amp;fid={$id}");
		}
	}

	function list_comments()
	{
		$id = isset($this->get['fid']) ? $this->get['fid'] : 0;

		if ($id == 0) {
			return $this->message("View Comments", "No file was specified.");
		}

		$file = $this->show_file($id);
		$cfile = $this->db->fetch( "SELECT file_name FROM %pfiles WHERE file_id=%d", $id );

		$comments = "";

		$i = 0;
		$class = "";

		$query = $this->db->query(
		  "SELECT c.*, u.user_name
		    FROM %pfilecomments c
		    LEFT JOIN %pusers u ON u.user_id=c.user_id
		    WHERE c.file_id=%d", $id );

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
		return eval($this->template('FILE_COMMENT_LIST'));
	}

	// Utility Functions

	function nestedSelect($cid = 0, $nest = 0, &$selectArray = array())
	{
		$cats = $this->db->query( "SELECT fcat_name, fcat_id, fcat_parent FROM %pfile_categories WHERE fcat_parent=%d", $cid );
		if($cats && $this->db->num_rows($cats) <= 0 )
			return "";
		$selectItems = '';
		$nestSpace = '';
		for($i = 0; $i < $nest; $i++ )
			$nestSpace .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		while( $row = $this->db->nqfetch($cats) )
		{
			$sArray=array();
			$toAdd = $this->nestedSelect($row['fcat_id'], $nest+1, &$sArray);
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
		$file = $this->db->fetch( "SELECT * FROM %pfiles WHERE file_id=%d", $id );

		@unlink("./downloads/" . $file['file_md5name']);
		$this->db->query( "DELETE FROM %pfiles WHERE file_id=%d", $id );
		$this->db->query( "DELETE FROM %pfileratings WHERE file_id=%d", $id );
		$this->db->query( "DELETE FROM %pfilecomments WHERE file_id=%d", $id );
		if ($count) {
			$this->db->query( "UPDATE %pusers SET user_uploads=user_uploads-1 WHERE user_id=%d", $file['file_submitted'] );
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

		$pt = explode( ",", $cats[$cid]['fcat_tree'] );
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
			$parents = explode( ",", $cats[$cid]['fcat_tree'] );

			foreach( $parents as $parent )
			{
				if(!isset($cats[$parent]))
					continue;

				$catname = $cats[$parent]['fcat_name'];
				$filetree .= " <strong>&raquo;</strong> <a href=\"{$this->self}?a=files&amp;cid={$parent}\">";
				$filetree .= $catname."</a>";
			}

			$catname = $cats[$cid]['fcat_name'];

			if (!$linklast) {
				$filetree .= " <strong>&raquo;</strong> ";
				$filetree .= $catname;
			} else {
				$filetree .= " <strong>&raquo;</strong> ";
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
		$list = "";

		$query = $this->db->query( "SELECT * FROM %pfile_categories ORDER BY fcat_longpath ASC" );
		while ($cat = $this->db->nqfetch($query))
		{
			$selected = "";
			if ($cid == $cat['fcat_id']) {
				$selected = " selected=\"selected\"";
			}

			if($cat['fcat_restricted'] && !$this->is_moderator($cat['fcat_id']))
				continue;
			$list .= "<option value=\"{$cat['fcat_id']}\"{$selected}>{$cat['fcat_longpath']}</option>\n";
		}
		return $list;
	}

	function is_submitter($fid, $cid)
	{
		$file = $this->db->fetch( "SELECT file_submitted FROM %pfiles WHERE file_id=%d", $fid );
		if(!$file)
			return false;
		if($this->is_moderator($cid) )
			return true;
		if($file['file_submitted'] != $this->user['user_id'] )
			return false;
		return true;
	}

	/*
	 * Runs the category array to see if the current user is the moderator of category $cid.
	 */
	function is_moderator($cid)
	{
		if( $this->perms->auth('is_admin') )
			return true;

		if( $cid == 0 )
			return false;

		$cats = $this->category_array();

		// First pass: Category is directly assigned to user.
		foreach( $cats as $category )
		{
			if( $category['fcat_id'] == $cid && $category['fcat_moderator'] == $this->user['user_id'] )
				return true;
		}

		// Second pass: Climb up the category tree and see if this user moderates the parent.
		// Moderating the parent means you moderate all of its children too.
		$onCat = $cid;
		while( $parent = $cats[$onCat]['fcat_parent'] )
		{
			if( $cats[$parent]['fcat_moderator'] == $this->user['user_id'] )
				return true;
			if( $parent == 0 )
				break;
			$onCat = $parent;
		}
		return false;
	}

	function get_longpath($cid)
	{
		$path = $this->db->fetch( "SELECT fcat_longpath FROM %pfile_categories WHERE fcat_id=%d", $cid );
		if( isset($path['fcat_longpath']))
			return $path['fcat_longpath'];
		return "";
	}

	// Gotta recursively update all the children of this parent. Don't want longpaths being all fuxored. - Davion
	function update_children_longpath($cid)
	{
		$query = $this->db->query( "SELECT fcat_id, fcat_name FROM %pfile_categories WHERE fcat_parent=%d", $cid );
		while( $row = $this->db->nqfetch( $query ) )
		{
			$newpath = $this->get_longpath($cid);
			$newpath .= "/" . $row['fcat_name'];

			$this->db->query( "UPDATE %pfile_categories SET fcat_longpath='%s' WHERE fcat_id=%d", $newpath, $row['fcat_id'] );
			$this->update_children_longpath($row['fcat_id']);
		}
	}

	function get_subcat($cid)
	{
                $query = $this->db->query( "Select fcat_parent FROM %pfile_categories WHERE fcat_id=%d", $cid );
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
		for ($i = 1; $i < count($array); $i++) {
			if ($array[$i]['fcat_id'] == $id) {
				return preg_replace('/^,/', '', $array[$i]['fcat_tree'] . ",$id");
			}
		}
	}

	function category_array()
	{
		if( $this->cat_array === false ) {
			$this->cat_array = array();

			$q = $this->db->query( "SELECT * FROM %pfile_categories ORDER BY fcat_name" );

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
		$q = $this->db->query( "SELECT fcat_id, fcat_parent FROM %pfile_categories ORDER BY fcat_parent" );
		
		while ($f = $this->db->nqfetch($q))
		{
			if ($f['fcat_parent']) {
				$cats[$f['fcat_id']] = $f['fcat_parent'];
			}
		}
		
		// Run through group
		$q = $this->db->query( "SELECT fcat_parent FROM %pfile_categories GROUP BY fcat_parent" );

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
}
?>
