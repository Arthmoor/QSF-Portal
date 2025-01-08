<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2025 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
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

if( !defined( 'QUICKSILVERFORUMS' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

/**
 * Downloads file browser
 *
 * @author Roger Libiez, Davion, Asylumius
 * @since 1.2.2
 **/
class files extends qsfglobal
{
	private $cat_array; // Used to generate category trees

	/**
	 * Build the file browser information
	 *
	 **/
	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->site ) : $this->lang->board_noview
			);
		}

		static $cat_array = false;
		$this->cat_array = &$cat_array;
      $this->tree( $this->lang->files );
      $this->set_title( $this->lang->files );
		$dowload = false;

		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		if( !isset( $this->get['fname'] ) ) {
			$this->get['fname'] = null;
		}

		$cid = 0;
		if( isset( $this->get['cid'] ) ) {
			if( !is_numeric( $this->get['cid'] ) ) {
				return $this->message( $this->lang->files, $this->lang->files_invalid_category );
			}
			$cid = intval( $this->get['cid'] );
		}

		$fid = 0;
		if( isset( $this->get['fid'] ) ) {
			if( !is_numeric( $this->get['fid'] ) ) {
				return $this->message( $this->lang->files, $this->lang->files_invalid_file );
			}
			$fid = intval( $this->get['fid'] );
		}

		$xtpl = new XTemplate( './skins/' . $this->skin . '/files.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'files', $this->lang->files );
		$xtpl->assign( 'files_upload_rules', $this->lang->files_upload_rules );
		$xtpl->assign( 'files_index', $this->lang->files_index );
		$xtpl->assign( 'files_search2', $this->lang->files_search2 );
		$xtpl->assign( 'files_recent', $this->lang->files_recent );

		$upload = null;
		if( $this->file_perms->auth( 'upload_files', $cid ) )
			$upload = "| <a href=\"{$this->site}/files/upload/{$cid}/\">{$this->lang->files_upload}</a>";

		$approve = null;
		if( $this->file_perms->auth( 'approve_files', $cid ) )
			$approve = "| <a href=\"{$this->site}/index.php?a=files&amp;s=filequeue\">{$this->lang->files_approve}</a>";

		$addcat = null;
		if( $this->file_perms->auth( 'add_category', $cid ) )
			$addcat = "| <a href=\"{$this->site}/index.php?a=files&amp;s=addcategory&amp;cid={$cid}\">{$this->lang->files_add_cat}</a>";

		$editcat = null;
		if( $this->file_perms->auth( 'edit_category', $cid ) )
			$editcat = "| <a href=\"{$this->site}/index.php?a=files&amp;s=editcategory&amp;cid={$cid}\">{$this->lang->files_edit_category}</a>";

		$delcat = null;
		if( $this->file_perms->auth( 'delete_category', $cid ) )
			$delcat = "| <a href=\"{$this->site}/index.php?a=files&amp;s=deletecategory&amp;cid={$cid}\">{$this->lang->files_delete_cat}</a>";

		$xtpl->assign( 'upload', $upload );
		$xtpl->assign( 'approve', $approve );
		$xtpl->assign( 'addcat', $addcat );
		$xtpl->assign( 'editcat', $editcat );
		$xtpl->assign( 'delcat', $delcat );

		$admin = null;
		if( $this->perms->auth('is_admin') ) {
			$admin .= "| <a href=\"{$this->site}/index.php?a=files&amp;s=fixcount\">{$this->lang->files_fix_stats}</a>";
		}
		$xtpl->assign( 'admin', $admin );

		$filejump = $this->get_categories( $cid, false );
		$xtpl->assign( 'filejump', $filejump );

		$xtpl->assign( 'main_search', $this->lang->main_search );

		switch( $this->get['s'] )
		{
			case 'recent':
				$file_page = $this->recent_uploads( $xtpl );
				break;

			case 'filequeue':
				$file_page = $this->view_filequeue( $xtpl );
				break;

			case 'addcategory':
				$file_page = $this->add_category( $xtpl, $cid );
				break;

			case 'editcategory':
				$file_page = $this->edit_category( $xtpl, $cid );
				break;

			case 'deletecategory':
				$file_page = $this->delete_category( $xtpl, $cid );
				break;

			case 'viewfile':
				$file_page = $this->show_file( $xtpl, $fid );
				break;

			case 'download':
				return $this->download_file( $xtpl, $fid );
				break;

			case 'upload':
				$file_page = $this->upload_file( $xtpl, $cid );
				break;

			case 'delete':
				$file_page = $this->delete_file( $xtpl, $cid );
				break;

			case 'update':
				$file_page = $this->update_file( $xtpl, $cid, $fid );
				break;

			case 'move':
				$file_page = $this->move_file( $xtpl );
				break;

			case 'edit':
				$file_page = $this->edit_file( $xtpl );
				break;

			case 'search':
				$file_page = $this->file_search( $xtpl );
				break;

			case 'addcomment':
				$file_page = $this->add_comment( $xtpl, $cid );
				break;

			case 'listcomments':
				$file_page = $this->list_comments( $xtpl );
				break;

			case 'fixcount':
				$file_page = $this->fix_filecount();
				break;

			default:
				$file_page = $this->display_categories( $xtpl, $cid );
				break;
		}

		// Add RSS feed link for recent uploads
		$this->add_feed( $this->site . '/index.php?a=rssfeed&amp;files=1', "{$this->lang->files_recent}" );

		$xtpl->assign( 'file_page', $file_page );

		$xtpl->parse( 'Files' );
		return $xtpl->text( 'Files' );
	}

	private function fix_filecount()
	{
		if( !$this->perms->auth( 'is_admin' ) ) {
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

      $count_query = $this->db->prepare_query( 'SELECT COUNT(file_id) files FROM %pfiles WHERE file_approved=1 AND file_catid=?' );
      $count_query->bind_param( 'i', $category_id );

		while( ( $cat = $this->db->nqfetch( $cats ) ) )
		{
         $category_id = $cat['fcat_id'];
         $this->db->execute_query( $count_query );
         $result = $count_query->get_result();
         $count = $this->db->nqfetch( $result );

			$this->increase_cat_count( $cat['fcat_id'], $count['files'] );
		}
      $count_query->close();
		$this->update_category_trees();

		$dirname = './downloads/';
		$dir = opendir( $dirname );

		$files = array();
		$confirmed_files = array();
		$confirmed_count = 0;
		while( ( $dl = readdir( $dir ) ) !== false )
		{
			if( is_dir( $dirname . $dl ) ) {
				continue;
			}

			$files[] = $dl;
		}

		// This bit here will clean up leftover files no longer associated with a database entry.
		$file_query = $this->db->query( 'SELECT file_md5name FROM %pfiles' );

		while( $fq = $this->db->nqfetch( $file_query ) )
		{
			if( in_array( $fq['file_md5name'], $files ) ) {
				$files = $this->array_remove_value( $files, $fq['file_md5name'] );
				$confirmed_count++;
			}
		}

		foreach( $files as $key => $fname )
			unlink( './downloads/'. $fname );

		return $this->message( $this->lang->files_fix_stats, $this->lang->files_fix_stats2 );
	}

	private function edit_file( $xtpl )
	{
		$id = intval( $this->get['fid'] );

		$stmt = $this->db->prepare_query( 'SELECT f.*, u.user_name FROM %pfiles f LEFT JOIN %pusers u ON user_id=file_submitted WHERE file_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $file = $this->db->nqfetch( $result );
      $stmt->close();

		if( !$this->file_perms->auth( 'edit_files', $file['file_catid'] ) ) {
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_edit_not_permitted );
		}

		if( !isset( $this->post['submit'] ) ) {
			foreach( $file as $key => $value )
				$$key = $value;

			$tree = $this->get_filetree( $file_catid, true );
			$list = $this->get_categories( $file_catid, true );
			$date = $this->mbdate( DATE_ONLY_LONG, $file_date );
			$filesize = $this->format_filesize( $file_size );
			$file_desc_preview = $this->format( $file_description, FORMAT_HTMLCHARS | FORMAT_CENSOR | FORMAT_BBCODE | FORMAT_BREAKS );
         $file_description = $this->format( $file_description, FORMAT_HTMLCHARS );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'tree', $tree );
			$xtpl->assign( 'file_name', $file_name );
			$xtpl->assign( 'files_desc', $this->lang->files_desc );
         $xtpl->assign( 'file_desc_preview', $file_desc_preview );
			$xtpl->assign( 'file_description', $file_description );
			$xtpl->assign( 'files_author', $this->lang->files_author );
			$xtpl->assign( 'file_author', $file_author );
			$xtpl->assign( 'files_submitted_by', $this->lang->files_submitted_by );
			$xtpl->assign( 'user_name', $user_name );
			$xtpl->assign( 'files_size', $this->lang->files_size );
			$xtpl->assign( 'filesize', $filesize );
			$xtpl->assign( 'files_added', $this->lang->files_added );
			$xtpl->assign( 'date', $date );
			$xtpl->assign( 'files_downloads', $this->lang->files_downloads );
			$xtpl->assign( 'file_downloads', $file_downloads );
			$xtpl->assign( 'id', $id );
			$xtpl->assign( 'files_modify_info', $this->lang->files_modify_info );
			$xtpl->assign( 'files_name', $this->lang->files_name );
			$xtpl->assign( 'files_version', $this->lang->files_version );
			$xtpl->assign( 'file_fileversion', $file_fileversion );
			$xtpl->assign( 'files_cat', $this->lang->files_cat );
			$xtpl->assign( 'list', $list );
			$xtpl->assign( 'bbcode_menu', $this->bbcode->get_bbcode_menu() );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'Edit' );
			return $xtpl->text( 'Edit' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->files_edit_file, $this->lang->invalid_token );
			}

			if( empty( $this->post['file_author'] ) || empty( $this->post['file_name'] ) || empty( $this->post['file_description'] ) || empty( $this->post['file_category'] ) ) {
				return $this->message( $this->lang->files_edit_file, $this->lang->files_all_fields_required );
			}

			$name = $this->post['file_name'];
			$furl = $this->htmlwidgets->clean_url( $name );
			$catid = intval( $this->post['file_category'] );
			$author = $this->post['file_author'];
			$version = $this->post['file_version'];
			$desc = $this->post['file_description'];

			$this->log_action( 'file_edit', $id );
			$stmt = $this->db->prepare_query( 'UPDATE %pfiles SET file_name=?, file_catid=?, file_author=?, file_fileversion=?, file_description=? WHERE file_id=?' );

         $stmt->bind_param( 'sisssi', $name, $catid, $author, $version, $desc, $id );
         $this->db->execute_query( $stmt );
         $stmt->close();

			return $this->message( $this->lang->files_edit_file, "{$file['file_name']} " . $this->lang->files_has_updated, "{$this->lang->continue}", "{$this->site}/files/{$furl}-{$id}/" );
		}
	}

	private function move_file( $xtpl )
	{
		$id = intval( $this->get['fid'] );

		$stmt = $this->db->prepare_query( 'SELECT file_id, file_name, file_catid FROM %pfiles WHERE file_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $file = $this->db->nqfetch( $result );
      $stmt->close();

		if( !$this->file_perms->auth( 'move_files', $file['file_catid'] ) ) {
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_move_not_permitted );
		}

		if( !isset( $this->post['submit'] ) ) {
			$list = $this->get_categories( $file['file_catid'], true );
			$move_file = sprintf( $this->lang->files_move_category, "<strong>{$file['file_name']}</strong>" );

         $xtpl->assign( 'id', $id );
			$xtpl->assign( 'files_move_file', $this->lang->files_move_file );
			$xtpl->assign( 'move_file', $move_file );
			$xtpl->assign( 'list', $list );

			$xtpl->assign( 'token', $this->generate_token() );

			$xtpl->parse( 'Move' );
			return $xtpl->text( 'Move' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->files_move_file, $this->lang->invalid_token );
			}

			$catid = intval( $this->post['category'] );

			$stmt = $this->db->prepare_query( 'SELECT fcat_name FROM %pfile_categories WHERE fcat_id=?' );

         $stmt->bind_param( 'i', $catid );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $cat = $this->db->nqfetch( $result );
         $stmt->close();

			if( !$cat ) {
				return $this->message( $this->lang->files_move_file, $this->lang->files_move_no_category, "{$this->lang->continue}", "{$this->site}/index.php?a=files&amp;s=move&amp;fid={$id}" );
			}

			$this->log_action( 'file_move', $file['file_id'], $file['file_catid'], $catid );
			$this->decrease_cat_count( $file['file_catid'] );
			$this->increase_cat_count( $catid );

			$stmt = $this->db->prepare_query( 'UPDATE %pfiles SET file_catid=? WHERE file_id=?' );

         $stmt->bind_param( 'ii', $catid, $id );
         $this->db->execute_query( $stmt );
         $stmt->close();

			return $this->message( $this->lang->files_move_file, "<strong>{$file['file_name']}</strong> " . $this->lang->files_moved_file, "{$this->lang->continue}", "{$this->site}/files/category/{$catid}/" );
		}
	}

	private function view_filequeue( $xtpl )
	{
		if( !isset( $this->get['f'] ) ) {
			$this->get['f'] = null;
		}

		if( isset( $this->get['u'] ) )
			$getUpdate = true;
		else
			$getUpdate = false;

		if( isset( $this->get['cid'] ) )
		{
			$cid = $this->get['cid'];

			if( !$this->file_perms->auth( 'approve_files', $cid ) ) {
				return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_approval_not_permitted );
			}
		}

		if( !$this->get['f'] ) {
			$i = 0;

			$files = "<div class=\"article\"><div class=\"title\">{$this->lang->files_approval_waiting}</div></div>";

			$query = $this->db->query( 'SELECT f.*, u.user_name FROM %pfiles f LEFT JOIN %pusers u ON u.user_id=f.file_submitted WHERE file_approved=0' );

			$updates = false;

			while( $file = $this->db->nqfetch( $query ) )
			{
            foreach( $file as $key => $value )
               $$key = $value;

				if( !$this->file_perms->auth( 'approve_files', $file_catid ) )
					continue;
				$i++;
				$date = $this->mbdate( DATE_ONLY_LONG, $file_date );
				$filesize = $this->format_filesize( $file_size );
				$file_description = $this->format( $file_description, FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_BBCODE );
				$cid = 0;

				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'file_name', $file_name );
				$xtpl->assign( 'files_desc', $this->lang->files_desc );
				$xtpl->assign( 'file_description', $file_description );
				$xtpl->assign( 'files_submitted_by', $this->lang->files_submitted_by );
				$xtpl->assign( 'user_name', $user_name );
				$xtpl->assign( 'files_author', $this->lang->files_author );
				$xtpl->assign( 'file_author', $file_author );
				$xtpl->assign( 'files_size', $this->lang->files_size );
				$xtpl->assign( 'filesize', $filesize );
				$xtpl->assign( 'files_added', $this->lang->files_added );
				$xtpl->assign( 'date', $date );
				$xtpl->assign( 'file_id', $file_id );
				$xtpl->assign( 'file_catid', $file_catid );
				$xtpl->assign( 'files_download', $this->lang->files_download );
				$xtpl->assign( 'files_approve2', $this->lang->files_approve2 );
				$xtpl->assign( 'files_deny', $this->lang->files_deny );

				$xtpl->parse( 'ApproveNew' );
				$files .= $xtpl->text( 'ApproveNew' );
			}

			$updates = true;

			$query = $this->db->query( 'SELECT p.*, f.file_catid, u.user_name FROM %pupdates p
			    LEFT JOIN %pusers u ON u.user_id=p.update_updater
			    LEFT JOIN %pfiles f ON f.file_id=p.update_updating' );

			while( $update = $this->db->nqfetch( $query ) )
			{
				foreach( $update as $key => $value )
					$$key = $value;

				if( !$this->file_perms->auth( 'approve_files', $file_catid ) )
					continue;

				$i++;
				$file_name = $update_name;
				$date = $this->mbdate( DATE_ONLY_LONG, $update_date );
				$filesize = $this->format_filesize( $update_size );
				$file_description = $this->format( $update_description, FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_BBCODE );

				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'file_name', $file_name );
				$xtpl->assign( 'files_update', $this->lang->files_update );
				$xtpl->assign( 'file_description', $file_description );
				$xtpl->assign( 'files_submitted_by', $this->lang->files_submitted_by );
				$xtpl->assign( 'user_name', $user_name );
				$xtpl->assign( 'files_size', $this->lang->files_size );
				$xtpl->assign( 'filesize', $filesize );
				$xtpl->assign( 'files_added', $this->lang->files_added );
				$xtpl->assign( 'date', $date );
				$xtpl->assign( 'update_id', $update_id );
				$xtpl->assign( 'file_catid', $file_catid );
				$xtpl->assign( 'files_download', $this->lang->files_download );
				$xtpl->assign( 'files_approve2', $this->lang->files_approve2 );
				$xtpl->assign( 'files_deny', $this->lang->files_deny );

				$xtpl->parse( 'ApproveUpdate' );
				$files .= $xtpl->text( 'ApproveUpdate' );
			}

			if( $i == 0 ) {
				return $this->message( $this->lang->files_approve, $this->lang->files_approve_none );
			}
			return $files;
		}

		if( !isset( $this->get['cid'] ) )
			return $this->message( $this->lang->files_approve, $this->lang->files_approve_error );

		if( $this->get['f'] == 'approve' )
		{
			$id = intval( $this->get['fid'] );
			if( $getUpdate )
				return $this->approve_update( $cid, $id );

			$stmt = $this->db->prepare_query( 'SELECT file_name, file_submitted, file_catid FROM %pfiles WHERE file_id=?' );

         $stmt->bind_param( 'i', $id );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $file = $this->db->nqfetch( $result );
         $stmt->close();

			$stmt = $this->db->prepare_query( 'UPDATE %pfiles SET file_approved=1 WHERE file_id=?' );

         $stmt->bind_param( 'i', $id );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$stmt = $this->db->prepare_query( 'UPDATE %pusers SET user_uploads=user_uploads+1 WHERE user_id=?' );

         $stmt->bind_param( 'i', $file['file_submitted'] );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$this->increase_cat_count( $file['file_catid'] );

			$this->sets['code_approval']--;
			$this->sets['file_count']++;
			$this->write_sets();

			return $this->message( $this->lang->files_approve, "{$file['file_name']} " . $this->lang->files_approved, $this->lang->continue, "{$this->site}/index.php?a=files&amp;s=filequeue" );
		}

		if( $this->get['f'] == 'deny' ) {
			$id = intval( $this->get['fid'] );

			if( $getUpdate )
				return $this->deny_update( $id );

			$stmt = $this->db->prepare_query( 'SELECT file_submitted FROM %pfiles WHERE file_id=?' );

         $stmt->bind_param( 'i', $id );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $file = $this->db->nqfetch( $result );
         $stmt->close();

			$name = $this->remove_file( $id );

			$this->sets['code_approval']--;
			$this->write_sets();

			return $this->message( $this->lang->files_approve, "{$name} " . $this->lang->files_denied, $this->lang->continue, "{$this->site}/index.php?a=files&amp;s=filequeue");
		}

		if( $this->get['f'] == 'download' ) {
			$id = intval( $this->get['fid'] );

			if( !$getUpdate )
			{
				$stmt = $this->db->prepare_query( 'SELECT file_filename, file_md5name, file_catid, file_size FROM %pfiles WHERE file_id=?' );

            $stmt->bind_param( 'i', $id );
            $this->db->execute_query( $stmt );

            $result = $stmt->get_result();
            $file = $this->db->nqfetch( $result );
            $stmt->close();

				$filename = $file['file_filename'];
				$md5name = $file['file_md5name'];
				$size = $file['file_size'];
				$basepath = "./downloads/";
			}
			else
			{
				$stmt = $this->db->prepare_query( 'SELECT update_name, update_md5name, update_updating, update_size FROM %pupdates WHERE update_id=?' );

            $stmt->bind_param( 'i', $id );
            $this->db->execute_query( $stmt );

            $result = $stmt->get_result();
            $update = $this->db->nqfetch( $result );
            $stmt->close();

				$filename = $update['update_name'];
				$md5name = $update['update_md5name'];
				$size = $update['update_size'];
				$basepath = './updates/';
			}

			$this->nohtml = true;

			// Need to terminate and unlock the session at this point or the site will stall for the current user.
			session_write_close();

			ini_set( "zlib.output_compression", "Off" );
			header( "Content-Type: application/octet-stream" );
			header( "Content-Disposition: attachment; filename=\"{$filename}\"" );
			header( "Content-Length: " . $size );
			header( "X-Robots-Tag: noarchive, nosnippet, noindex" );
			echo file_get_contents( './downloads/' . $md5name );
		}
		return $this->message( $this->lang->files_approve, $this->lang->files_invalid_option, $this->lang->continue, "{$this->site}/index.php?a=files&amp;s=filequeue" );
	}

	private function edit_category( $xtpl, $cid )
	{
		if( !$this->file_perms->auth( 'edit_category', $cid ) ) {
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_edit_cat_not_permitted );
		}

		if( $cid == 0 ) {
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_edit_root );
		}

		if( !isset( $this->post['submit'] ) ) {
			$stmt = $this->db->prepare_query( 'SELECT fcat_name, fcat_parent, fcat_description FROM %pfile_categories WHERE fcat_id=?' );

         $stmt->bind_param( 'i', $cid );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $cat = $this->db->nqfetch( $result );
         $stmt->close();

			$list = $this->get_categories( $cat['fcat_parent'], true );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'cid', $cid );
			$xtpl->assign( 'files_edit_category', $this->lang->files_edit_category );
			$xtpl->assign( 'files_name', $this->lang->files_name );
			$xtpl->assign( 'fcat_name', $cat['fcat_name'] );
			$xtpl->assign( 'files_add_cat_parent', $this->lang->files_add_cat_parent );
			$xtpl->assign( 'list', $list );
			$xtpl->assign( 'files_desc', $this->lang->files_desc );
			$xtpl->assign( 'fcat_description', $cat['fcat_description'] );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'edit', $this->lang->edit );

			$xtpl->parse( 'EditCategory' );
			return $xtpl->text( 'EditCategory' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->files_edit_category, $this->lang->invalid_token );
			}

			$parent = intval( $this->post['parent'] );
			$name = $this->post['cat_name'];
			$desc = $this->post['catdesc'];
			$longpath = $this->get_longpath( $parent );

			$stmt = $this->db->prepare_query( 'SELECT * FROM %pfile_categories WHERE fcat_id=?' );

         $stmt->bind_param( 'i', $cid );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $cat = $this->db->nqfetch( $result );
         $stmt->close();

			if( !$this->file_perms->auth( 'edit_category', $parent ) ) {
				return $this->message( $this->lang->files_edit_category, $this->lang->files_edit_mod );
			}

			if( $this->is_parent( $cat['fcat_id'], $parent ) ) {
				return $this->message( $this->lang->files_edit_category, $this->lang->files_edit_cat_not_parent );
			}

			$stmt = $this->db->prepare_query( 'SELECT fcat_id, fcat_name, fcat_parent FROM %pfile_categories WHERE fcat_name=?' );

         $stmt->bind_param( 's', $name );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $ecat = $this->db->nqfetch( $result );
         $stmt->close();

			if( $ecat && $ecat['fcat_parent'] == $parent ) {
				if( $parent == 0 ) {
					$path = "Root";
				} else {
					$path = $longpath;
				}
				if( $ecat['fcat_id'] != $cid ) {
					$exists = sprintf( $this->lang->files_cat_exists, $name, $path );
					return $this->message( $this->lang->files_edit_category, $exists );
				}
			}

			if( $parent != 0 ) {
				$longpath .= "/{$name}";
			} else {
				$longpath .= $name;
			}
			$stmt = $this->db->prepare_query( 'UPDATE %pfile_categories SET fcat_name=?, fcat_parent=?, fcat_longpath=?, fcat_description=? WHERE fcat_id=?' );

         $stmt->bind_param( 'sissi', $name, $parent, $longpath, $desc, $cid );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$this->update_children_longpath( $cat['fcat_id'] );
			$this->update_category_trees();
			$this->log_action( 'file_edit_category', $cid );
			return $this->message( $this->lang->files_edit_category, $this->lang->files_cat_edited, $this->lang->continue, "{$this->site}/files/category/{$cid}/" );
		}
	}

	private function delete_category( $xtpl, $cid )
	{
		if( !$this->file_perms->auth( 'delete_category', $cid ) ) {
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_delete_cat_not_permitted );
		}

		if( !isset( $this->post['submit'] ) ) {
			$list = $this->get_categories( $cid, true );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'files_delete_cat', $this->lang->files_delete_cat );
			$xtpl->assign( 'files_delete_cat2', $this->lang->files_delete_cat2 );
			$xtpl->assign( 'list', $list );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'delete', $this->lang->delete );

			$xtpl->parse( 'DeleteCategory' );
			return $xtpl->text( 'DeleteCategory' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->files_delete_cat, $this->lang->invalid_token );
			}

			if( !isset( $this->post['category'] ) ) {
				return $this->message( $this->lang->files_delete_cat, $this->lang->files_delete_nocat, $this->lang->continue, "{$this->site}/files/" );
			}

			$catid = intval( $this->post['category'] );

			if( !$this->file_perms->auth( 'delete_category', $catid ) ) {
				return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_delete_cat_not_permitted );
			}

			if( $catid == 0 ) {
				return $this->message( $this->lang->files_delete_cat, $this->lang->files_delete_root, $this->lang->continue, "{$this->site}/files/" );
			}

			$stmt = $this->db->prepare_query( 'SELECT fcat_name, fcat_parent, fcat_count FROM %pfile_categories WHERE fcat_id=?' );

         $stmt->bind_param( 'i', $catid );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $cat = $this->db->nqfetch( $result );
         $stmt->close();

			if( !$cat ) {
				return $this->message( $this->lang->files_delete_cat, $this->lang->files_delete_nocat, $this->lang->continue, "{$this->site}/files/" );
			}

			$count = $cat['fcat_count'];

			if( $count > 0 ) {
				$not_exist = sprintf( $this->lang->files_delete_cat_not_empty, $cat['fcat_name'] );
				return $this->message( $this->lang->files_delete_cat, $this->lang->files_delete_cat_not_empty, $this->lang->continue, "{$this->site}/files/category/{$catid}/" );
			}

			$stmt = $this->db->prepare_query( 'DELETE FROM %pfile_categories WHERE fcat_id=?' );

         $stmt->bind_param( 'i', $catid );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$perms = new file_permissions( $this );

			// Groups
			while( $perms->get_group() )
			{
				$perms->remove_z( $catid );
				$perms->update();
			}

			// Users
			while( $perms->get_group( true ) )
			{
				$perms->remove_z( $catid );
				$perms->update();
			}

			$this->log_action( 'file_delete_category', $catid );
			return $this->message( $this->lang->files_delete_cat, $this->lang->files_delete_cat_done, $this->lang->continue, "{$this->site}/files/{$cat['fcat_parent']}/" );
		}
	}

	private function add_category( $xtpl, $cid )
	{
		if( !$this->file_perms->auth( 'add_category', $cid ) ) {
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_add_cat_not_allowed );
		}

		if( !isset( $this->post['submit'] ) ) {
			$list = $this->get_categories( $cid, true );
			$cats_exist = $this->db->fetch( 'SELECT COUNT(fcat_id) AS count FROM %pfile_categories' );

			if( $cats_exist['count'] ) {
				$quickperms = $list;
			} else {
				$quickperms = '<option value="0" selected="selected">Root</option>';
			}

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'cid', $cid );
			$xtpl->assign( 'files_add_cat', $this->lang->files_add_cat );
			$xtpl->assign( 'files_add_cat_name', $this->lang->files_add_cat_name );
			$xtpl->assign( 'files_add_cat_parent', $this->lang->files_add_cat_parent );
			$xtpl->assign( 'list', $list );
			$xtpl->assign( 'files_add_cat_desc', $this->lang->files_add_cat_desc );
			$xtpl->assign( 'files_add_cat_qperms', $this->lang->files_add_cat_qperms );
			$xtpl->assign( 'files_add_cat_qperms2', $this->lang->files_add_cat_qperms2 );
			$xtpl->assign( 'quickperms', $quickperms );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'files_add_cat', $this->lang->files_add_cat );

			$xtpl->parse( 'AddCategory' );
			return $xtpl->text( 'AddCategory' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->files_add_cat, $this->lang->invalid_token );
			}

			$parent = intval( $this->post['parent'] );
			$name = $this->post['cat_name'];
			$longpath = $this->get_longpath( $parent );

			if( !$this->file_perms->auth( 'add_category', $parent ) ) {
				return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_add_cat_not_allowed );
			}

			$stmt = $this->db->prepare_query( 'SELECT fcat_name, fcat_parent FROM %pfile_categories WHERE fcat_name=?' );

         $stmt->bind_param( 's', $name );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $cat = $this->db->nqfetch( $result );
         $stmt->close();

			if( $cat && $cat['fcat_parent'] == $parent ) {
				if( $parent == 0 ) {
					$path = 'Root';
				} else {
					$path = $longpath;
				}
				$exists = sprintf( $this->lang->files_add_cat_exists, $name, $path );
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

			$stmt = $this->db->prepare_query( 'INSERT INTO %pfile_categories (fcat_parent, fcat_name, fcat_longpath, fcat_tree, fcat_description) VALUES( ?, ?, ?, ?, ? )' );

         $stmt->bind_param( 'issss', $parent, $name, $longpath, $tree, $desc );
         $this->db->execute_query( $stmt );
         $stmt->close();

         $newid = $this->db->insert_id( );
			$perms = new file_permissions( $this );

			while( $perms->get_group() )
			{
				// Full permissions (note: the banned group is still false)
				if( $this->post['sync'] == -2 ) {
					$perms->add_z( $newid, ( $perms->group != USER_BANNED ) );

				// No permissions
				} elseif( $this->post['sync'] == -1 ) {
					$perms->add_z( $newid, false );

				// Copy another category
				} else {
					$perms->add_z( $newid, false );

					foreach( $perms->standard as $perm => $false )
					{
						if( !isset( $perms->globals[$perm] ) ) {
							$perms->set_xyz( $perm, $newid, $perms->auth( $perm, $this->post['sync'] ) );
						}
					}
				}
				$perms->update();
			}

			$this->log_action( 'file_new_category', $newid );
			return $this->message( $this->lang->files_add_cat, $this->lang->files_add_cat_done, $this->lang->continue, "{$this->site}/category/files/{$parent}/" );
		}
	}

	private function delete_file( $xtpl, $cid )
	{
		if( !$this->file_perms->auth( 'delete_files', $cid ) ) {
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_delete_file_not_permitted );
		}

		if( !isset( $this->get['fid'] ) ) {
			return $this->message( $this->lang->files_delete_file, $this->lang->files_delete_file_specify );
		}

		$id = intval( $this->get['fid'] );

		if( !isset( $this->post['submit'] ) ) {
			$stmt = $this->db->prepare_query( 'SELECT file_name, file_id FROM %pfiles WHERE file_id=?' );

         $stmt->bind_param( 'i', $id );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $file = $this->db->nqfetch( $result );
         $stmt->close();

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'file_id', $file['file_id'] );
			$xtpl->assign( 'cid', $cid );
			$xtpl->assign( 'files_delete_file', $this->lang->files_delete_file );
			$xtpl->assign( 'files_delete_confirm', $this->lang->files_delete_confirm );
			$xtpl->assign( 'file_name', $file['file_name'] );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'delete', $this->lang->delete );

			$xtpl->parse( 'DeleteFile' );
			return $xtpl->text( 'DeleteFile' );
		}

		if( !$this->is_valid_token() ) {
			return $this->message( $this->lang->files_delete_file, $this->lang->invalid_token );
		}

		$name = $this->remove_file( $id, true );
		$this->log_action( 'file_delete', $id );

		return $this->message( $this->lang->files_delete_file, "{$name} " . $this->lang->files_delete_file_done, $this->lang->continue, "{$this->site}/files/category/{$cid}/" );
	}

	private function update_file( $xtpl, $cid, $fid )
	{
		$file_upload = false;

		if( !$this->file_perms->auth( 'upload_files' ) || !$this->is_submitter( $fid, $cid ) )
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_update_not_permitted );

		$stmt = $this->db->prepare_query( 'SELECT file_name, file_md5name, file_fileversion, file_description FROM %pfiles WHERE file_id=?' );

      $stmt->bind_param( 'i', $fid );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $file = $this->db->nqfetch( $result );
      $stmt->close();

		if( !$file )
			return $this->message( $this->lang->files_update_file, $this->lang->files_update_not_exist, $this->lang->continue, "{$this->site}/files/category/{$cid}/" );

		if( !isset( $this->post['submit'] ) )
		{
			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'cid', $cid );
			$xtpl->assign( 'fid', $fid );
			$xtpl->assign( 'files_update_file', $this->lang->files_update_file );
			$xtpl->assign( 'files_update_file', $file['file_name'] );
			$xtpl->assign( 'file', $this->lang->file );
			$xtpl->assign( 'files_version', $this->lang->files_version );
			$xtpl->assign( 'version', $file['file_fileversion'] );
			$xtpl->assign( 'files_desc', $this->lang->files_desc );
			$xtpl->assign( 'bbcode_menu', $this->bbcode->get_bbcode_menu() );
			$xtpl->assign( 'desc', $file['file_description'] );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'files_update_file', $this->lang->files_update_file );

			$xtpl->parse( 'UpdateFile' );
			return $xtpl->text( 'UpdateFile' );
		}

		if( !$this->is_valid_token() ) {
			return $this->message( $this->lang->files_update_file, $this->lang->invalid_token );
		}

		if( empty( $this->post['file_description'] ) )
			return $this->message( $this->lang->files_update_file, $this->lang->files_update_file_need_desc, $this->lang->continue, "{$this->site}/index.php?a=files&amp;s=update&amp;fid={$fid}&amp;cid={$cid}" );

		$desc = $this->post['file_description'];
		$version = $this->post['file_version'];

		if( !empty( $this->files['code_update']['name'] ) ) {
			$file_upload = true; // File present. Need to process the full update query.

			$filename = basename( $this->files['code_update']['name'] );
			$md5name = md5( $filename.microtime() );
			$date = $this->time;
			$size = intval( $this->files['code_update']['size'] );
			$path = "./updates/".$md5name;
			$userId = $this->user['user_id'];

			$stmt = $this->db->prepare_query( 'SELECT update_name FROM %pupdates WHERE update_name=?' );

         $stmt->bind_param( 's', $filename );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $update = $this->db->nqfetch( $result );
         $stmt->close();

			if( $update && $update['update_name'] == $filename )
				return $this->message( $this->lang->files_update_file, $this->lang->files_update_exists, $this->lang->continue, "{$this->site}/index.php?a=files&amp;s=update&amp;fid={$fid}&amp;cid={$cid}" );

			if( is_uploaded_file( $this->files['code_update']['tmp_name'] ) )
			{
				if( file_exists( $path ) )
					return $this->message( $this->lang->files_update_file, $this->lang->files_exists, $this->lang->continue, "{$this->site}/index.php?a=files&amp;s=update&amp;fid={$fid}&amp;cid={$cid}" );
				else
				{
					if( !move_uploaded_file( $this->files['code_update']['tmp_name'], $path ) )
						return $this->message( $this->lang->files_update_file, $this->lang->files_error_unknown, $this->lang->continue, "{$this->site}/index.php?a=files&amp;s=update&amp;fid={$fid}&amp;cid={$cid}" );
				}
			}
			else
				return $this->message( $this->lang->files_update_file, $this->lang->files_error_trick );

			// Permissions update to allow rsync to back this file up
			$this->chmod( $path, 0644, false );
		}

		$approved = 0;
		if( $this->perms->auth('is_admin') || $this->sets['file_approval'] == 0 ) // Now, nobody needs approval if file approvals are off in the ACP.
			$approved = 1;

		if( $file_upload ) {
			if( $approved ) {
				$newpath = './downloads/' . $md5name;
				unlink( './downloads/' . $file['file_md5name'] );
				if( !copy( './updates/' . $md5name, $newpath ) )
					return $this->message( $this->lang->files_update_file, $this->lang->files_update_approve_failed );
				unlink( './updates/' . $md5name );

				$stmt = $this->db->prepare_query( 'UPDATE %pfiles SET 
					file_description=?, file_md5name=?, file_size=?, file_filename=?, file_fileversion=?, file_revdate=?,
					file_revision=file_revision+1 WHERE file_id=?' );

            $stmt->bind_param( 'ssissii', $desc, $md5name, $size, $filename, $version, $date, $fid );
            $this->db->execute_query( $stmt );
            $stmt->close();

				$this->log_action( 'file_update', $fid );
				return $this->message( $this->lang->files_upload, $this->lang->files_uploaded, $this->lang->continue, "{$this->site}/files/category/{$cid}/" );
			} else {
				$stmt = $this->db->prepare_query( 'INSERT INTO %pupdates (update_name, update_fileversion, update_updating, update_description, update_md5name, update_date, update_size, update_updater)
					VALUES( ?, ?, ?, ?, ?, ?, ?, ? )' );

            $stmt->bind_param( 'ssissiii', $filename, $version, $fid, $desc, $md5name, $date, $size, $userId );
            $this->db->execute_query( $stmt );
            $stmt->close();

				$this->log_action( 'file_update', $fid );
				$this->sets['code_approval']++;
				$this->write_sets();

				return $this->message( $this->lang->files_update_file, $this->lang->files_update_pending, $this->lang->continue, "{$this->site}/files/category/{$cid}/" );
			}
		} else {
			$stmt = $this->db->prepare_query( 'UPDATE %pfiles SET file_fileversion=?, file_description=? WHERE file_id=?' );

         $stmt->bind_param( 'ssissiii', $version, $desc, $fid);
         $this->db->execute_query( $stmt );
         $stmt->close();

			return $this->message( $this->lang->files_update_file, $this->lang->files_update_desc, $this->lang->continue, "{$this->site}/files/category/{$cid}/" );
		}
	}

	private function deny_update( $uid )
	{
		$stmt = $this->db->prepare_query( 'SELECT update_md5name, update_updater FROM %pupdates WHERE update_id=?' );

      $stmt->bind_param( 'i', $uid );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $update = $this->db->nqfetch( $result );
      $stmt->close();

		@unlink( './updates/' . $update['update_md5name'] );

		$this->sets['code_approval']--;
		$this->write_sets();

		$stmt = $this->db->prepare_query( 'DELETE FROM %pupdates WHERE update_id=?' );

      $stmt->bind_param( 'i', $uid );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$this->log_action( 'file_deny_update', $uid );

		return $this->message( $this->lang->files_update_deny, $this->lang->files_update_denied, $this->lang->continue, "{$this->site}/index.php?a=files&amp;s=filequeue}" );
	}

	private function approve_update( $cid, $uid )
	{
		if( !$this->file_perms->auth('approve_files', $cid ) ) {
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_update_approval_not_permitted, $this->lang->continue, "{$this->site}/files/category/{$cid}/" );
		}
		
		$stmt = $this->db->prepare_query( 'SELECT * FROM %pupdates WHERE update_id=?' );

      $stmt->bind_param( 'i', $uid );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $update = $this->db->nqfetch( $result );
      $stmt->close();

		if( !$update )
			return $this->message( $this->lang->files_update_approve, $this->lang->files_update_not_exist2, $this->lang->continue, "{$this->site}/files/category/{$cid}/" );

		$fid = $update['update_updating'];
		$stmt = $this->db->prepare_query( 'SELECT * FROM %pfiles WHERE file_id=?' );

      $stmt->bind_param( 'i', $fid );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $file = $this->db->nqfetch( $result );
      $stmt->close();

		if( !$file )
			return $this->message( $this->lang->files_update_approve, $this->lang->files_update_not_exist, $this->lang->continue, "{$this->site}/files/category/{$cid}/" );

		$newpath = './downloads/' . $update['update_md5name'];
		if( $update['update_md5name'] != $file['file_md5name'] && file_exists( $newpath ) )
			return $this->message( $this->lang->files_update_approve, $this->lang->files_update_exists );

		unlink( './downloads/' . $file['file_md5name'] );
		if( !copy( './updates/' . $update['update_md5name'], $newpath ) )
			return $this->message( $this->lang->files_update_approve, $this->lang->files_update_approve_failed );

		unlink( './updates/' . $update['update_md5name'] );

		$desc = $update['update_description'];
		$md5name = $update['update_md5name'];
		$filename = $update['update_name'];
		$version = $update['update_fileversion'];
		$size = $update['update_size'];
		$date = intval( $update['update_date'] );

		$stmt = $this->db->prepare_query( 'UPDATE %pfiles SET file_description=?, file_md5name=?, file_size=?, file_filename=?, file_fileversion=?, file_revdate=?, file_revision=file_revision+1 WHERE file_id=?' );

      $stmt->bind_param( 'ssissii', $desc, $md5name, $size, $filename, $version, $date, $fid );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %pupdates WHERE update_id=?' );

      $stmt->bind_param( 'i', $uid );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$this->sets['code_approval']--;
		$this->write_sets();
		$this->log_action( 'file_approve_update', $uid, $fid );

		return $this->message( $this->lang->files_update_approve, $this->lang->files_update_approved, $this->lang->continue, "{$this->site}/index.php?a=files&amp;s=filequeue" );
	}

	private function upload_file( $xtpl, $cid )
	{
		if( !$this->file_perms->auth( 'upload_files', $cid ) ) {
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_upload_not_permitted );
		}

		if( !isset( $this->post['submit'] ) ) {
			$list = $this->get_upload_categories( $cid );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'files_name', $this->lang->files_name );
			$xtpl->assign( 'files_author', $this->lang->files_author );
			$xtpl->assign( 'files_version', $this->lang->files_version );
			$xtpl->assign( 'files_cat', $this->lang->files_cat );
			$xtpl->assign( 'list', $list );
			$xtpl->assign( 'file', $this->lang->file );
			$xtpl->assign( 'files_desc', $this->lang->files_desc );
			$xtpl->assign( 'bbcode_menu', $this->bbcode->get_bbcode_menu() );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'files_upload', $this->lang->files_upload );

			$xtpl->parse( 'UploadFile' );
			return $xtpl->text( 'UploadFile' );
		}

		//if( !$this->is_valid_token() ) {
		//	return $this->message( $this->lang->files_upload, $this->lang->invalid_token );
		//}

		$catid = intval( $this->post['file_category'] );
		if( $catid == 0 ) {
			return $this->message( $this->lang->files_upload, $this->lang->files_upload_no_root );
		}

		if( empty( $this->files['code_upload']['name'] ) || empty( $this->post['file_author'] ) || empty( $this->post['file_name'] ) || empty( $this->post['file_description'] ) || empty( $this->post['file_category'] ) ) {
			return $this->message( $this->lang->files_upload, $this->lang->files_all_fields_required );
		}

		$filename = basename( $this->files['code_upload']['name'] );
		$md5name = md5( $filename . microtime() );
		$newhome = './downloads/' . $md5name;

		$name = $this->post['file_name'];
		$version = $this->post['file_version'];
		$size = intval( $this->files['code_upload']['size'] );
		$author = $this->post['file_author'];
		$desc = $this->post['file_description'];
		$uid = $this->user['user_id'];
		$date = $this->time;

		$stmt = $this->db->prepare_query( 'SELECT file_filename FROM %pfiles WHERE file_filename=?' );

      $stmt->bind_param( 's', $filename );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $file = $this->db->nqfetch( $result );
      $stmt->close();

		if( isset( $file['file_filename'] ) && $file['file_filename'] == $filename ) {
			return $this->message( $this->lang->files_upload, $this->lang->files_update_exists );
		}

		if( is_uploaded_file( $this->files['code_upload']['tmp_name'] ) ) {
			if( file_exists( $newhome ) ) {
				return $this->message( $this->lang->files_upload, $this->lang->files_error_duplicate );
			} else {
				if( !move_uploaded_file( $this->files['code_upload']['tmp_name'], $newhome ) ) {
					return $this->message( $this->lang->files_upload, $this->lang->files_error_unknown );
				}
			}
		} else {
			return $this->message( $this->lang->files_upload, $this->lang->files_error_trick );
		}

		// Permissions update to allow rsync to back this file up
		$this->chmod( $newhome, 0644, false );

		$approved = 0;
		if( $this->perms->auth('is_admin') || $this->sets['file_approval'] == 0 ) // Now, nobody needs approval if file approvals are off in the ACP.
			$approved = 1;

		$stmt = $this->db->prepare_query( 'INSERT INTO %pfiles (file_name, file_catid, file_filename, file_md5name, file_author, file_fileversion, file_size, file_date, file_submitted, file_description, file_approved)
			VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )' );

      $stmt->bind_param( 'sissssiiisi', $name, $catid, $filename, $md5name, $author, $version, $size, $date, $uid, $desc, $approved );
      $this->db->execute_query( $stmt );
      $stmt->close();

		if( $approved == 0 ) {
			$this->sets['code_approval']++;
			$this->write_sets();
			return $this->message( $this->lang->files_upload, $this->lang->files_upload_pending, $this->lang->continue, "{$this->site}/files/category/{$catid}/" );
		} else {
			$stmt = $this->db->prepare_query( 'UPDATE %pusers SET user_uploads=user_uploads+1 WHERE user_id=?' );

         $stmt->bind_param( 'i', $uid );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$this->increase_cat_count( $catid );

			$this->sets['file_count']++;
			$this->write_sets();
			return $this->message( $this->lang->files_upload, $this->lang->files_uploaded, $this->lang->continue, "{$this->site}/files/category/{$catid}/" );
		}
	}

	private function download_file( $fid )
	{
		if( !isset( $this->get['fid'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->files_download, $this->lang->files_download_specify );
		}

		$id = intval( $this->get['fid'] );

		$stmt = $this->db->prepare_query( 'SELECT file_filename, file_md5name, file_catid, file_size FROM %pfiles WHERE file_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $file = $this->db->nqfetch( $result );
      $stmt->close();

      if( !$file ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->files_download, $this->lang->files_invalid_file );
		}

      if( !$this->file_perms->auth( 'download_files', $file['file_catid'] ) ) {
         return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_download_not_permitted );
      }

		$this->nohtml = true;
		$stmt = $this->db->prepare_query( 'UPDATE %pfiles SET file_downloads=file_downloads+1 WHERE file_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		// Need to terminate and unlock the session at this point or the site will stall for the current user.
		session_write_close();

		ini_set( "zlib.output_compression", "Off" );
		header( "Connection: close" );
		header( "Content-Type: application/octet-stream" );
		header( "Content-Disposition: attachment; filename=\"{$file['file_filename']}\"" );
		header( "Content-Length: " . $file['file_size'] );
		header( "X-Robots-Tag: noarchive, nosnippet, noindex" );
		// directly pass through file to output buffer
		@readfile( './downloads/' . $file['file_md5name'] );
	}

	// NOTE: Need to change function around so it only prints a <table> if there is at least one result. -Asy
	private function display_categories( $xtpl, $cid )
	{
		$break = 0;
		$desc = null;

		if( $cid != 0 ) {
			$stmt = $this->db->prepare_query( 'SELECT fcat_id, fcat_moderator, fcat_description FROM %pfile_categories WHERE fcat_id=?' );

         $stmt->bind_param( 'i', $cid );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $cat = $this->db->nqfetch( $result );
         $stmt->close();

			if( !$cat && $cid != 0 ) {
				header( 'HTTP/1.0 404 Not Found' );
				return $this->message( $this->lang->files_delete_nocat, $this->lang->files_delete_cat_not_exist );
			}
			$desc = $cat['fcat_description'];
		}

		if( !$this->file_perms->auth( 'category_view', $cid ) )
			return $this->message( $this->lang->files_view_category, $this->lang->files_view_cat_not_permitted );

		$tree = $this->get_filetree( $cid );
		$cats = $this->cat_array; // The cat_array is already populated by get_filetree, take advantage.

		$catlinks = '';
		foreach( $cats as $category )
		{
			if( $category['fcat_parent'] != $cid )
				continue;

			$id = $category['fcat_id'];

			// Don't display a category link for root
			if( $id == 0 )
				continue;

			if( !$this->file_perms->auth( 'category_view', $id ) )
				continue;

			$name = $category['fcat_name'];
			$count = $category['fcat_count'];

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'id', $id );
			$xtpl->assign( 'name', $name );
			$xtpl->assign( 'count', $count );

			$xtpl->parse( 'CategoryLink' );
			$catlinks .= $xtpl->text( 'CategoryLink' );
			$xtpl->reset( 'CategoryLink' );

			if( !( ++$break % 5 ) ) {
				$catlinks .= '<br>';
			}
		}

		$displaycat = $this->display_category( $xtpl, $cid, $desc );

		$xtpl->assign( 'tree', $tree );
		$xtpl->assign( 'catlinks', $catlinks );
		$xtpl->assign( 'displaycat', $displaycat );

		$xtpl->parse( 'FileCategories' );
		return $xtpl->text( 'FileCategories' );
	}

	private function display_category( $xtpl, $cid, $desc )
	{
		$i = 0;
		$catitems = '';
		$query = array();

		if( $cid == 0 ) {
			$query = $this->db->query( 'SELECT f.*, u.user_name, u.user_id FROM %pfiles f
			    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
			    WHERE f.file_approved=1
			    ORDER BY f.file_date DESC LIMIT 20' );
		} else {
			$query = $this->db->query( 'SELECT f.*, u.user_name, u.user_id FROM %pfiles f
			    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
			    WHERE f.file_catid=%d AND file_approved=1
			    ORDER BY f.file_date DESC', $cid );
		}

		while( $row = $this->db->nqfetch( $query ) )
		{
			foreach( $row as $key => $value )
				$$key = $value;

			if( !$this->file_perms->auth( 'category_view', $file_catid ) )
				continue;

			$date = $this->mbdate( DATE_ONLY_LONG, $file_date );

			$revdate = null;
			if( $file_revdate > 0 )
				$revdate = $this->mbdate( DATE_ONLY_LONG, $file_revdate );

			$i++;
			$size = $this->format_filesize( $file_size );
			$file_url = $this->htmlwidgets->clean_url( $file_name );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'file_url', $file_url );
			$xtpl->assign( 'file_id', $file_id );
			$xtpl->assign( 'file_name', $file_name );
			$xtpl->assign( 'file_fileversion', $file_fileversion );
			$xtpl->assign( 'user_id', $user_id );
			$xtpl->assign( 'user_name', $user_name );

         if( $user_id != USER_GUEST_UID ) {
            $link_name = $this->htmlwidgets->clean_url( $user_name );
            $link_name = "<a href=\"{$this->site}/profile/{$link_name}-{$user_id}/\">{$user_name}</a>";
         }
         else
            $link_name = $user_name;
         
			$xtpl->assign( 'link_name', $link_name );

			$xtpl->assign( 'date', $date );
			$xtpl->assign( 'revdate', $revdate );
			$xtpl->assign( 'file_downloads', $file_downloads );
			$xtpl->assign( 'size', $size );
			$xtpl->assign( 'file_comments', $file_comments );
			$xtpl->assign( 'file_rating', $file_rating );

			$xtpl->parse( 'FileCategory.Item' );
		}

		if( $desc ) {
			$xtpl->assign( 'desc', $desc );

			$xtpl->parse( 'FileCategory.Desc' );
		}

		if( $cid == 0 ) {
			$xtpl->assign( 'files_top20', $this->lang->files_top20 );

			$xtpl->parse( 'FileCategory.Top20' );
		}

		if( $i > 0 ) {
			$xtpl->assign( 'files_name', $this->lang->files_name );
			$xtpl->assign( 'files_version', $this->lang->files_version );
			$xtpl->assign( 'files_submitted_by', $this->lang->files_submitted_by );
			$xtpl->assign( 'files_added', $this->lang->files_added );
			$xtpl->assign( 'files_updated', $this->lang->files_updated );
			$xtpl->assign( 'files_dl', $this->lang->files_dl );
			$xtpl->assign( 'files_size', $this->lang->files_size );
			$xtpl->assign( 'files_comments', $this->lang->files_comments );
			$xtpl->assign( 'files_rating', $this->lang->files_rating );

			$xtpl->parse( 'FileCategory.Header' );
		}

		$xtpl->parse( 'FileCategory' );
		return $xtpl->text( 'FileCategory' );
	}

	private function recent_uploads( $xtpl )
	{
		$catitems = '';

		$date = $this->time - 864000; // 10 days old
		$stmt = $this->db->prepare_query( 'SELECT f.*, u.user_name, u.user_id FROM %pfiles f
		    LEFT JOIN %pusers u ON u.user_id=f.file_submitted
		    WHERE f.file_date>= ? AND f.file_approved=1
		    ORDER BY f.file_date DESC, f.file_name' );

      $stmt->bind_param( 'i', $date );
      $this->db->execute_query( $stmt );

      $query = $stmt->get_result();
      $stmt->close();

		$i = 0;
		while( $row = $this->db->nqfetch( $query ) )
		{
			foreach( $row as $key => $value )
				$$key = $value;

			if( !$this->file_perms->auth( 'category_view', $file_catid ) )
				continue;

			$date = $this->mbdate( DATE_ONLY_LONG, $file_date );

			$revdate = null;
			if( $file_revdate > 0 )
				$revdate = $this->mbdate( DATE_ONLY_LONG, $file_revdate );

			$i++;
			$size = $this->format_filesize( $file_size );
			$file_url = $this->htmlwidgets->clean_url( $file_name );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'file_url', $file_url );
			$xtpl->assign( 'file_id', $file_id );
			$xtpl->assign( 'file_name', $file_name );
			$xtpl->assign( 'file_fileversion', $file_fileversion );
			$xtpl->assign( 'user_id', $user_id );
			$xtpl->assign( 'user_name', $user_name );

         if( $user_id != USER_GUEST_UID ) {
            $link_name = $this->htmlwidgets->clean_url( $user_name );
            $link_name = "<a href=\"{$this->site}/profile/{$link_name}-{$user_id}/\">{$user_name}</a>";
         }
         else
            $link_name = $user_name;
         
			$xtpl->assign( 'link_name', $link_name );

			$xtpl->assign( 'date', $date );
			$xtpl->assign( 'revdate', $revdate );
			$xtpl->assign( 'file_downloads', $file_downloads );
			$xtpl->assign( 'size', $size );
			$xtpl->assign( 'file_comments', $file_comments );
			$xtpl->assign( 'file_rating', $file_rating );

			$xtpl->parse( 'RecentUploads.Item' );
		}

		if( $i < 1 ) {
			return $this->message( $this->lang->files_recent_uploads, $this->lang->files_recent_uploads_none );
		}

		$xtpl->assign( 'files_recent_uploads', $this->lang->files_recent_uploads );
		$xtpl->assign( 'files_name', $this->lang->files_name );
		$xtpl->assign( 'files_version', $this->lang->files_version );
		$xtpl->assign( 'files_submitted_by', $this->lang->files_submitted_by );
		$xtpl->assign( 'files_added', $this->lang->files_added );
		$xtpl->assign( 'files_updated', $this->lang->files_updated );
		$xtpl->assign( 'files_dl', $this->lang->files_dl );
		$xtpl->assign( 'files_size', $this->lang->files_size );
		$xtpl->assign( 'files_comments', $this->lang->files_comments );
		$xtpl->assign( 'files_rating', $this->lang->files_rating );

		$xtpl->parse( 'RecentUploads' );
		return $xtpl->text( 'RecentUploads' );
	}

	private function show_file( $xtpl, $fid )
	{
		if( $fid == 0 ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->files_view, $this->lang->files_view_specify );
		}
		$file = '';

		$stmt = $this->db->prepare_query( 'SELECT f.*, u.user_name FROM %pfiles f LEFT JOIN %pusers u ON u.user_id=f.file_submitted WHERE file_id=?' );

      $stmt->bind_param( 'i', $fid );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $query = $this->db->nqfetch( $result );
      $stmt->close();

      if( !$query ) {
			header( 'HTTP/1.0 404 Not Found' );
         return $this->message( $this->lang->files_view, $this->lang->files_comment_specify );
		}

		//if( $this->htmlwidgets->clean_url( $query['file_name'] ) != $this->get['fname'] ) {
		//	header('HTTP/1.0 404 Not Found');
		//	return $this->message( $this->lang->files_view, $this->lang->files_invalid_file );
		//}

		foreach( $query as $key => $value )
			$$key = $value;

		if( !$this->file_perms->auth( 'category_view', $file_catid ) )
			return $this->message( $this->lang->files_view, $this->lang->files_view_cat_not_permitted );

		$tree = $this->get_filetree( $file_catid, true );
		$cid = $file_catid;
		$date = $this->mbdate( DATE_ONLY_LONG, $file_date );

		$rdate = null;
		if( $file_revision > 0 )
			$rdate = $this->mbdate( DATE_ONLY_LONG, $file_revdate );

		$file_extension = strtolower( substr( strrchr( $file_filename, '.' ) , 1 ) );
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

		$filesize = $this->format_filesize( $file_size );
		$file_description = $this->format( $file_description, FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_BBCODE );
		$filename = $this->format( $file_filename, FORMAT_HTMLCHARS );

      $this->set_title( $this->lang->files . ': ' . $file_name );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'tree', $tree );
		$xtpl->assign( 'file_name', $file_name );
		$xtpl->assign( 'files_author', $this->lang->files_author );
		$xtpl->assign( 'files_submitted_by', $this->lang->files_submitted_by );
		$xtpl->assign( 'files_version', $this->lang->files_version );
		$xtpl->assign( 'files_dl', $this->lang->files_dl );
		$xtpl->assign( 'files_size', $this->lang->files_size );
		$xtpl->assign( 'files_added', $this->lang->files_added );
		$xtpl->assign( 'files_updated', $this->lang->files_updated );

		$xtpl->assign( 'file_author', $file_author );
		$xtpl->assign( 'user_name', $user_name );
		$xtpl->assign( 'file_fileversion', $file_fileversion );
		$xtpl->assign( 'file_downloads', $file_downloads );
		$xtpl->assign( 'filesize', $filesize );
		$xtpl->assign( 'date', $date );
		$xtpl->assign( 'rdate', $rdate );

		$xtpl->assign( 'files_desc', $this->lang->files_desc );
		$xtpl->assign( 'file_description', $file_description );
		$xtpl->assign( 'files_revisions', $this->lang->files_revisions );
		$xtpl->assign( 'file_revision', $file_revision );

		$rating = $this->show_rating( $file_id );
		$xtpl->assign( 'rating', $rating );

		$xtpl->assign( 'file_id', $file_id );
		$xtpl->assign( 'files_download', $this->lang->files_download );
		$xtpl->assign( 'files_comments', $this->lang->files_comments );
		$xtpl->assign( 'file_comments', $file_comments );

		$update = null;
		if( $this->is_submitter( $file_id, $file_catid ) )
			$update = " | <a href=\"{$this->site}/index.php?a=files&amp;s=update&amp;fid={$file_id}&amp;cid={$file_catid}\">{$this->lang->files_update}</a>";
		$xtpl->assign( 'update', $update );

		$move = null;
		if( $this->file_perms->auth( 'move_files', $cid ) )
			$move = " | <a href=\"{$this->site}/index.php?a=files&amp;s=move&amp;fid={$file_id}\">{$this->lang->files_move}</a>";
		$xtpl->assign( 'move', $move );

		$edit = null;
		if( $this->file_perms->auth( 'edit_files', $cid ) )
			$edit = " | <a href=\"{$this->site}/index.php?a=files&amp;s=edit&amp;fid={$file_id}\">{$this->lang->edit}</a>";
		$xtpl->assign( 'edit', $edit );

		$delete = null;
		if( $this->file_perms->auth( 'delete_files', $cid ) )
			$delete = " | <a href=\"{$this->site}/index.php?a=files&amp;s=delete&amp;fid={$file_id}&amp;cid={$cid}\">{$this->lang->delete}</a>";
		$xtpl->assign( 'delete', $delete );

		$xtpl->parse( 'FileDetails' );
		return $xtpl->text( 'FileDetails' );
	}

	private function show_rating( $fid )
	{
		$can_rate = true;
		$has_rated = false;

		$stmt = $this->db->prepare_query( 'SELECT file_rating, file_catid FROM %pfiles WHERE file_id=?' );

      $stmt->bind_param( 'i', $fid );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $file_rating = $this->db->nqfetch( $result );
      $stmt->close();

      if( !$this->file_perms->auth( 'upload_files', $file_rating['file_catid'] ) ) {
         $can_rate = false;
      }

		if( $can_rate ) {
			$stmt = $this->db->prepare_query( 'SELECT file_id FROM %pfileratings WHERE user_id=? AND file_id=?' );

         $stmt->bind_param( 'ii', $this->user['user_id'], $fid );
         $this->db->execute_query( $stmt );

         $result = $stmt->get_result();
         $file_rated = $this->db->nqfetch( $result );
         $stmt->close();

			if( isset( $file_rated['file_id'] ) && $file_rated['file_id'] == $fid ) {
				$has_rated = true;
			}
		}

		if( $can_rate && !$has_rated ) {
			$rating = "<b><a href=\"{$this->site}/index.php?a=filerating&amp;f={$fid}\" target=\"qsf_rating\" onclick=\"CenterPopUp('{$this->site}/index.php?a=filerating&amp;f={$fid}','qsf_rating',400,200)\">{$this->lang->files_rating}:</a></b> <img src=\"{$this->site}/skins/{$this->skin}/images/{$file_rating['file_rating']}.png\" alt=\"\">";
		}
		else {
			$rating = "<b>{$this->lang->files_rating}:</b> <img src=\"{$this->site}/skins/{$this->skin}/images/{$file_rating['file_rating']}.png\" alt=\"\">";
		}
		return $rating;
	}

	private function file_search( $xtpl )
	{
		if( !isset( $this->post['submit'] ) )
		{
			if( isset( $this->get['uid'] ) )	{
            $uid = 0;
           	if( !is_numeric( $this->get['uid'] ) ) {
               return $this->message( $this->lang->files, $this->lang->files_invalid_user );
            }

			   $uid = intval( $this->get['uid'] );
				$stmt = $this->db->prepare_query( 'SELECT user_name from %pusers WHERE user_id=?' );

            $stmt->bind_param( 'i', $uid );
            $this->db->execute_query( $stmt );

            $result = $stmt->get_result();
            $uname = $this->db->nqfetch( $result );
            $stmt->close();

            if( $uname == null ) {
               return $this->message( $this->lang->files, $this->lang->files_invalid_user );
            }

				$stmt = $this->db->prepare_query( 'SELECT * FROM %pfiles WHERE file_submitted=? AND file_approved=1 ORDER BY file_name' );

            $stmt->bind_param( 'i', $uid );
            $this->db->execute_query( $stmt );

            $query = $stmt->get_result();
            $stmt->close();

				return $this->run_search( $xtpl, $query, 'User: ' . $uname['user_name'] );
			}
			$selectItems = $this->nestedSelect();

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'files_search', $this->lang->files_search );
			$xtpl->assign( 'files_search_basic', $this->lang->files_search_basic );
			$xtpl->assign( 'files_search_for', $this->lang->files_search_for );
			$xtpl->assign( 'files_search_in', $this->lang->files_search_in );
			$xtpl->assign( 'select_all', $this->lang->select_all );
			$xtpl->assign( 'selectItems', $selectItems );

			$xtpl->assign( 'files_search_advanced', $this->lang->files_search_advanced );
			$xtpl->assign( 'files_search_by', $this->lang->files_search_by );
			$xtpl->assign( 'files_name', $this->lang->files_name );
			$xtpl->assign( 'files_desc', $this->lang->files_desc );
			$xtpl->assign( 'files_author', $this->lang->files_author );
			$xtpl->assign( 'files_search_display_more', $this->lang->files_search_display_more );
			$xtpl->assign( 'files_downloads2', $this->lang->files_downloads2 );
			$xtpl->assign( 'files_search_display_first', $this->lang->files_search_display_first );
			$xtpl->assign( 'files_search_results2', $this->lang->files_search_results2 );
			$xtpl->assign( 'files_search_minimum_rating', $this->lang->files_search_minimum_rating );
			$xtpl->assign( 'files_search3', $this->lang->files_search3 );
			$xtpl->assign( 'files_search_newer', $this->lang->files_search_newer );
			$xtpl->assign( 'files_search_older', $this->lang->files_search_older );
			$xtpl->assign( 'files_search_than', $this->lang->files_search_than );
			$xtpl->assign( 'files_search_day', $this->lang->files_search_day );
			$xtpl->assign( 'files_search_days', $this->lang->files_search_days );
			$xtpl->assign( 'files_search_week', $this->lang->files_search_week );
			$xtpl->assign( 'files_search_weeks', $this->lang->files_search_weeks );
			$xtpl->assign( 'files_search_month', $this->lang->files_search_month );
			$xtpl->assign( 'files_search_months', $this->lang->files_search_months );
			$xtpl->assign( 'files_search_year', $this->lang->files_search_year );

			$xtpl->assign( 'files_search2', $this->lang->files_search2 );

			$xtpl->parse( 'FileSearch' );
			return $xtpl->text( 'FileSearch' );
		}

		if( !isset( $this->post['query'] ) || empty( $this->post['query'] ) ) {
			return $this->message( $this->lang->files_search, $this->lang->files_search_error_something, $this->lang->continue, "{$this->site}/files/search/" );
		}

		$query = 'SELECT * FROM %pfiles WHERE (';
		$searchFor = $this->post['query'];
		$searchBy = false;

		if( isset( $this->post['sName'] ) )
		{
			$searchBy = true;
			$name = "file_name LIKE '%%%s%%' ";
		}

		if( isset( $this->post['sDesc'] ) )
		{
			if( isset( $name ) )
			   $name .= 'OR ';
			$desc = "file_description LIKE '%%%s%%' ";
			$searchBy = true;
		}

		if( isset( $this->post['sAuth'] ) )
		{
			if( isset( $desc ) )
				$desc .= 'OR ';
			else if( isset( $name ) )
			   $name .= 'OR ';
			$auth = "file_author LIKE '%%%s%%' ";
			$searchBy = true;
		}
		if( isset( $name ) )
			$query .= $name;
		if( isset( $desc ) )
			$query .= $desc;
		if( isset( $auth ) )
			$query .= $auth;

		if( !$searchBy )
			return $this->message( $this->lang->files_search, $this->lang->files_search_error, $this->lang->continue, "{$this->site}/files/search/" );

		$query .= ") AND (file_downloads >= {$this->post['downCount']} ";
		$query .= 'AND file_approved=1 ';

		if( isset( $this->post['useRating'] ) )
			$query .= "AND file_rating >= {$this->post['minRating']} ";

		if( isset( $this->post['byTime'] ) )
		{
			if( $this->post['time_way_select'] == 'newer' )
				$way = '>=';
			else
				$way = '<=';

			$time = intval( $this->post['time_select'] );
			$time = $this->time - ( $time * 86400 );
			$query .= 'AND file_date ' . $way . ' ' . $time . ' ';
		}

		$inCats = $this->post['cats'];
		if( $inCats != 'all' )
		{
			$catsQuery = ' ) AND (';
			for( $i = 0; $i < sizeof( $inCats ) ; $i++ )
			{
				$catsQuery .= 'file_catid = ' . $inCats[$i] . ' ';
				if( $i != sizeof( $inCats ) -1 )
					$catsQuery .= 'OR ';
			}
			$query .= $catsQuery;
		}
		$query .= ') LIMIT ' . $this->post['dispCount'];
		$results = $this->db->query( $query, $searchFor, $searchFor, $searchFor ); // Yes, intentional. Hackish, but intentional.

		return $this->run_search( $xtpl, $results, $searchFor );
	}

	// Search query hijacks the file category templates
	private function run_search( $xtpl, $query, $qString )
	{
		$i = 0;
		$found = 0;
		$tree = '';

		$catitems = '';
		if( $this->db->num_rows( $query ) == 0 )
			return $this->message( $this->lang->files_search, $this->lang->files_search_error_none, $this->lang->continue, "{$this->site}/files/search/" );

      $file_query = $this->db->prepare_query( 'SELECT user_name, user_id FROM %pusers WHERE user_id=?' );
      $file_query->bind_param( 'i', $file_submitted );

		while( $row = $this->db->nqfetch( $query ) ) {
			$found++;
			foreach( $row as $key => $value )
				$$key = $value;

			if( !$this->file_perms->auth( 'category_view', $file_catid ) )
				continue;

			$date = $this->mbdate( DATE_ONLY_LONG, $file_date );

			$revdate = null;
			if( $file_revdate > 0 )
				$revdate = $this->mbdate( DATE_ONLY_LONG, $file_revdate );

         $this->db->execute_query( $file_query );
         $result = $file_query->get_result();
         $user = $this->db->nqfetch( $result );

			$file_description = $this->format( $file_description, FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_BBCODE );

			$user_id = $user['user_id'];
			$user_name = $user['user_name'];
			$size = $this->format_filesize( $file_size );
			$file_url = $this->htmlwidgets->clean_url( $file_name );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'file_url', $file_url );
			$xtpl->assign( 'file_id', $file_id );
			$xtpl->assign( 'file_name', $file_name );
			$xtpl->assign( 'file_fileversion', $file_fileversion );
			$xtpl->assign( 'user_id', $user_id );
			$xtpl->assign( 'user_name', $user_name );

         if( $user_id != USER_GUEST_UID ) {
            $link_name = $this->htmlwidgets->clean_url( $user_name );
            $link_name = "<a href=\"{$this->site}/profile/{$link_name}-{$user_id}/\">{$user_name}</a>";
         }
         else
            $link_name = $user_name;
         
			$xtpl->assign( 'link_name', $link_name );

			$xtpl->assign( 'date', $date );
			$xtpl->assign( 'revdate', $revdate );
			$xtpl->assign( 'file_downloads', $file_downloads );
			$xtpl->assign( 'size', $size );
			$xtpl->assign( 'file_comments', $file_comments );
			$xtpl->assign( 'file_rating', $file_rating );

			$xtpl->parse( 'FileSearchResults.Item' );
		}
      $file_query->close();

		$xtpl->assign( 'files_search_results', $this->lang->files_search_results );
		$xtpl->assign( 'qString', $qString );
		$xtpl->assign( 'files_name', $this->lang->files_name );
		$xtpl->assign( 'files_version', $this->lang->files_version );
		$xtpl->assign( 'files_submitted_by', $this->lang->files_submitted_by );
		$xtpl->assign( 'files_added', $this->lang->files_added );
		$xtpl->assign( 'files_updated', $this->lang->files_updated );
		$xtpl->assign( 'files_dl', $this->lang->files_dl );
		$xtpl->assign( 'files_size', $this->lang->files_size );
		$xtpl->assign( 'files_comments', $this->lang->files_comments );
		$xtpl->assign( 'files_rating', $this->lang->files_rating );

		$xtpl->parse( 'FileSearchResults' );
		return $xtpl->text( 'FileSearchResults' );
	}

	private function add_comment( $xtpl, $cid )
	{
		if( !$this->file_perms->auth( 'post_comment', $cid ) ) {
			return $this->message( $this->lang->files_action_not_allowed, $this->lang->files_comment_not_permitted );
		}

		$id = isset( $this->get['fid'] ) ? $this->get['fid'] : 0;

		if( !isset( $this->post['addcomment'] ) ) {
			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'id', $id );
			$xtpl->assign( 'files_comment', $this->lang->files_comment );

			$xtpl->parse( 'AddComment' );
			return $xtpl->text( 'AddComment' );
		} else {
			$text = $this->post['commentbody'];
			if( empty( $text ) ) {
				return $this->message( $this->lang->files_comment, $this->lang->files_comment_empty );
			}

			$uid = $this->user['user_id'];
			$stmt = $this->db->prepare_query( 'INSERT INTO %pfilecomments (file_id,comment_text,user_id) VALUES( ?, ?, ? )' );

         $stmt->bind_param( 'isi', $id, $text, $uid );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$stmt = $this->db->prepare_query( 'UPDATE %pfiles SET file_comments=file_comments+1 WHERE file_id=?' );

         $stmt->bind_param( 'i', $id );
         $this->db->execute_query( $stmt );
         $stmt->close();

         return $this->message( $this->lang->files_comment, $this->lang->files_comment_posted, $this->lang->continue, "{$this->site}/index.php?a=files&amp;s=viewfile&amp;fid={$id}" );
		}
	}

	private function list_comments( $xtpl )
	{
		$id = isset( $this->get['fid'] ) ? $this->get['fid'] : 0;

		if( $id == 0 ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->files_comment_view, $this->lang->files_comment_specify );
		}

		$stmt = $this->db->prepare_query( 'SELECT file_id FROM %pfiles WHERE file_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $query = $this->db->nqfetch( $result );
      $stmt->close();

      if( !$query ) {
			header( 'HTTP/1.0 404 Not Found' );
         return $this->message( $this->lang->files_comment_view, $this->lang->files_comment_specify );
		}

		$stmt = $this->db->prepare_query( 'SELECT file_name, file_catid FROM %pfiles WHERE file_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $cfile = $this->db->nqfetch( $result );
      $stmt->close();

		$comments = '';

		$stmt = $this->db->prepare_query( 'SELECT c.*, u.user_name FROM %pfilecomments c
		    LEFT JOIN %pusers u ON u.user_id=c.user_id
		    WHERE c.file_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );

      $query = $stmt->get_result();
      $stmt->close();

		while( $row = $this->db->nqfetch( $query ) ) {
			$fid = $row['file_id'];
			$user_name = $row['user_name'];
			$text = $this->format( $row['comment_text'], FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_BBCODE );

			$xtpl->assign( 'board_by', $this->lang->board_by );
			$xtpl->assign( 'user_name', $user_name );
			$xtpl->assign( 'text', $text );

			$xtpl->parse( 'ListComments.Item' );
		}
		$cid = $cfile['file_catid'];
		$can_comment = $this->file_perms->auth( 'post_comment', $cid );

		$xtpl->assign( 'files_comment_user', $this->lang->files_comment_user );
		$xtpl->assign( 'file_name', $cfile['file_name'] );

		if( $can_comment ) {
			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'cid', $cid );
			$xtpl->assign( 'id', $id );
			$xtpl->assign( 'files_comment', $this->lang->files_comment );

			$xtpl->parse( 'ListComments.Add' );
		}

		$xtpl->parse( 'ListComments' );
		return $xtpl->text( 'ListComments' );
	}

	// Utility Functions
	private function format_filesize( $bytes, $decimals = 2 )
	{
		$sz = 'BKMGTP';
		$factor = floor( ( strlen( $bytes ) - 1 ) / 3 );

		if( $factor == 0 )
			return sprintf( "%.{$decimals}f ", $bytes / pow( 1024, $factor ) ) . @$sz[$factor];
		else
			return sprintf( "%.{$decimals}f ", $bytes / pow( 1024, $factor ) ) . @$sz[$factor] . 'B';
	}

	private function nestedSelect( $cid = 0, $nest = 0, $selectArray = array() )
	{
		$stmt = $this->db->prepare_query( 'SELECT fcat_name, fcat_id, fcat_parent FROM %pfile_categories WHERE fcat_parent=? AND fcat_id != 0' );

      $stmt->bind_param( 'i', $cid );
      $this->db->execute_query( $stmt );

      $cats = $stmt->get_result();
      $stmt->close();

		if( $cats && $this->db->num_rows( $cats ) <= 0 )
			return '';

		$selectItems = '';
		$nestSpace = '';

		for( $i = 0; $i < $nest; $i++ )
			$nestSpace .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		while( $row = $this->db->nqfetch( $cats ) )
		{
			$sArray = array();
			$toAdd = $this->nestedSelect( $row['fcat_id'], $nest+1, $sArray );
			array_push( $selectArray, $row['fcat_id'] );
			$selectArray = array_merge( $selectArray, $sArray );
			array_push( $sArray, $row['fcat_id'] );
			$selectItems .= "<option value='{$row['fcat_id']}' selected='selected' ondblclick='select_all_children(".implode(", ", $sArray).")'>{$nestSpace}{$row['fcat_name']}</option>\n";
			$selectItems .= $toAdd;
			if( $cid == 0 )
				$selectArray = array();
		}
		return $selectItems;
	}

	private function remove_file( $id, $count = false )
	{
		$stmt = $this->db->prepare_query( 'SELECT * FROM %pfiles WHERE file_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $file = $this->db->nqfetch( $result );
      $stmt->close();

		@unlink( './downloads/' . $file['file_md5name'] );
		$stmt = $this->db->prepare_query( 'DELETE FROM %pfiles WHERE file_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %pfileratings WHERE file_id=?', $id );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'DELETE FROM %pfilecomments WHERE file_id=?' );

      $stmt->bind_param( 'i', $id );
      $this->db->execute_query( $stmt );
      $stmt->close();

		if( $count ) {
			$this->decrease_cat_count( $file['file_catid'] );
			$stmt = $this->db->prepare_query( 'UPDATE %pfile_categories SET fcat_count=fcat_count-1 WHERE fcat_id=?' );

         $stmt->bind_param( 'i', $file['file_catid'] );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$stmt = $this->db->prepare_query( 'UPDATE %pusers SET user_uploads=user_uploads-1 WHERE user_id=?' );

         $stmt->bind_param( 'i', $file['file_submitted'] );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$this->sets['file_count']--;
			$this->write_sets();
		}
		return $file['file_name'];
	}

	/*
	 * Builds the file navigation tree into a global array.
	 * Since this function gets called on many subscreens, the global array can save a whole lotta queries! -- Samson
	 */
	private function get_filetree( $cid, $linklast = false )
	{
		$cats = $this->category_array();

		$filetree = "<strong>&raquo;</strong> <a href=\"{$this->site}/files/\">Root</a>";

		if( $cid != 0 )
		{
			$parents = explode( ',', $cats[$cid]['fcat_tree'] );

			foreach( $parents as $parent )
			{
				if( !isset( $cats[$parent] ) )
					continue;

				$catname = $cats[$parent]['fcat_name'];
				$filetree .= " <strong>&raquo;</strong> <a href=\"{$this->site}/files/category/{$parent}/\">";
				$filetree .= $catname . '</a>';
			}

			$catname = $cats[$cid]['fcat_name'];

			if( !$linklast ) {
				$filetree .= ' <strong>&raquo;</strong> ';
				$filetree .= $catname;
			} else {
				$filetree .= ' <strong>&raquo;</strong> ';
				$filetree .= "<a href=\"{$this->site}/files/category/{$cid}/\">{$catname}</a>";
			}
		}
		return $filetree;
	}

	/*
	 * Grabs a list of all file categories, sorted by the longpath.
	 * Used in various dialogues for easier category selections.
	 */
	private function get_categories( $cid, $num_select )
	{
		$list = '';

		$query = $this->db->query( 'SELECT * FROM %pfile_categories ORDER BY fcat_longpath ASC' );

		while( $cat = $this->db->nqfetch( $query ) )
		{
			$selected = '';

			if( $cid == $cat['fcat_id'] ) {
				$selected = ' selected="selected"';
			}

			if( !$this->file_perms->auth( 'category_view', $cat['fcat_id'] ) )
				continue;

			if( $num_select )
				$list .= "<option value=\"{$cat['fcat_id']}\"{$selected}>{$cat['fcat_longpath']}</option>\n";
			else
				$list .= "<option value=\"{$cat['fcat_id']}/\"{$selected}>{$cat['fcat_longpath']}</option>\n";
		}
		return $list;
	}

	/*
	 * Grabs a list of all file categories, sorted by the longpath.
	 * Used in the upload dialogue, because you can have hidden categories that still allow uploads for one-way submissions.
	 */
	private function get_upload_categories( $cid )
	{
		$list = '';

		$query = $this->db->query( 'SELECT * FROM %pfile_categories ORDER BY fcat_longpath ASC' );

		while( $cat = $this->db->nqfetch( $query ) )
		{
			$selected = '';

			if( $cid == $cat['fcat_id'] ) {
				$selected = ' selected="selected"';
			}

			if( !$this->file_perms->auth( 'upload_files', $cat['fcat_id'] ) )
				continue;
			$list .= "<option value=\"{$cat['fcat_id']}\"{$selected}>{$cat['fcat_longpath']}</option>\n";
		}
		return $list;
	}

	private function is_submitter( $fid, $cid )
	{
		$stmt = $this->db->prepare_query( 'SELECT file_submitted FROM %pfiles WHERE file_id=?' );

      $stmt->bind_param( 'i', $fid );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $file = $this->db->nqfetch( $result );
      $stmt->close();

		if( !$file )
			return false;

		if( $this->perms->is_guest )
			return false;

		if( $this->file_perms->auth( 'edit_files', $cid ) )
			return true;

		if( $file['file_submitted'] != $this->user['user_id'] )
			return false;

		return true;
	}

	private function get_longpath( $cid )
	{
		$stmt = $this->db->prepare_query( 'SELECT fcat_longpath FROM %pfile_categories WHERE fcat_id=?' );

      $stmt->bind_param( 'i', $cid );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $path = $this->db->nqfetch( $result );
      $stmt->close();

		if( isset( $path['fcat_longpath'] ) )
			return $path['fcat_longpath'];

		return '';
	}

	// Gotta recursively update all the children of this parent. Don't want longpaths being all fuxored. - Davion
	private function update_children_longpath( $cid )
	{
		$stmt = $this->db->prepare_query( 'SELECT fcat_id, fcat_name FROM %pfile_categories WHERE fcat_parent=?' );

      $stmt->bind_param( 'i', $cid );
      $this->db->execute_query( $stmt );

      $query = $stmt->get_result();
      $stmt->close();

      $file_query = $this->db->prepare_query( 'UPDATE %pfile_categories SET fcat_longpath=? WHERE fcat_id=?' );
      $file_query->bind_param( 'si', $newpath, $cat_id );

		while( $row = $this->db->nqfetch( $query ) )
		{
			$newpath = $this->get_longpath( $cid ) ;
			$newpath .= '/' . $row['fcat_name'];

         $cat_id = $row['fcat_id'];
         $this->db->execute_query( $file_query );

			$this->update_children_longpath( $row['fcat_id'] );
		}
      $file_query->close();
	}

	private function get_subcat( $cid )
	{
      $stmt = $this->db->prepare_query( 'SELECT fcat_parent FROM %pfile_categories WHERE fcat_id=?' );

      $stmt->bind_param( 'i', $cid );
      $this->db->execute_query( $stmt );

      $query = $stmt->get_result();
      $stmt->close();

      if( $row = $this->db->nqfetch( $query ) ) {
         return $row['fcat_parent'];
      }
	}

	// We want to see if cid is it's own parent, or being put into a catagory to which it is a parent of.
	// $pid is going to become the parent of $cid. If $cid == $pid bad. If $pid's parents are children of $cid, bad.
	// ... I hope! :) - Davion
	private function is_parent( $cid, $pid )
	{
		$onCat = $pid;

		while( 1 )
		{
			if( $onCat == $cid )
				return true;

			$onCat = $this->get_subcat( $onCat );
			if( $onCat == 0 )
				break;
		}
		return false;
	}

	private function create_tree( $array, $id )
	{
		foreach( $array as $cat ) {
			if( $cat['fcat_id'] == $id ) {
				return preg_replace( '/^,/', '', $cat['fcat_tree'] . ",$id" );
			}
		}
	}

	private function category_array()
	{
		if( $this->cat_array === false ) {
			$this->cat_array = array();

			$q = $this->db->query( 'SELECT * FROM %pfile_categories ORDER BY fcat_name' );

			while( $f = $this->db->nqfetch( $q ) )
			{
				$this->cat_array[$f['fcat_id']] = $f;
			}
			return $this->cat_array;
		}
		return $this->cat_array;
	}

	// Stole^H^H^H^H^HBorrowed this from forums.php updateForumTrees()
	private function update_category_trees()
	{
		$cats = array();
		$catTree = array();

		// Build tree structure of 'id' => 'parent' structure
		$q = $this->db->query( 'SELECT fcat_id, fcat_parent FROM %pfile_categories ORDER BY fcat_parent' );

		while( $f = $this->db->nqfetch( $q ) )
		{
			if( $f['fcat_parent'] ) {
				$cats[$f['fcat_id']] = $f['fcat_parent'];
			}
		}

		// Run through group
		$q = $this->db->query( 'SELECT fcat_parent FROM %pfile_categories GROUP BY fcat_parent' );

      $file_query = $this->db->prepare_query( 'UPDATE %pfile_categories SET fcat_tree=? WHERE fcat_parent=?' );
      $file_query->bind_param( 'si', $tree, $cat_id );

		while( $f = $this->db->nqfetch( $q ) )
		{
         $tree = '';
			if( $f['fcat_parent'] ) {
				$tree = $this->buildTree( $cats, $f['fcat_parent'] );
			}

         $cat_id = $f['fcat_parent'];
         $this->db->execute_query( $file_query );
		}
      $file_query->close();
	}

	private function buildTree( $catsArray, $parent )
	{
		$tree = '';

		if( isset( $catsArray[$parent] ) && $catsArray[$parent] ) {
			$tree = $this->buildTree( $catsArray, $catsArray[$parent] );
			$tree .= ',';
		}

		$tree .= $parent;

		return $tree;
	}

	private function increase_cat_count( $cid, $value = 1 )
	{
		$stmt = $this->db->prepare_query( 'SELECT * FROM %pfile_categories WHERE fcat_id=?' );

      $stmt->bind_param( 'i', $cid );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $category = $this->db->nqfetch( $result );
      $stmt->close();

		$parents = explode( ',', $category['fcat_tree'] );

      $file_query = $this->db->prepare_query( 'UPDATE %pfile_categories SET fcat_count=fcat_count + ? WHERE fcat_id=?' );
      $file_query->bind_param( 'ii', $value, $parent );

		foreach( $parents as $parent ) {
         $this->db->execute_query( $file_query );
      }
      $file_query->close();

		$stmt = $this->db->prepare_query( 'UPDATE %pfile_categories SET fcat_count=fcat_count + ? WHERE fcat_id=?' );

      $stmt->bind_param( 'ii', $value, $cid );
      $this->db->execute_query( $stmt );
      $stmt->close();
	}

	private function decrease_cat_count( $cid, $value = 1 )
	{
		$stmt = $this->db->prepare_query( 'SELECT * FROM %pfile_categories WHERE fcat_id=?' );

      $stmt->bind_param( 'i', $cid );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $category = $this->db->nqfetch( $result );
      $stmt->close();

		$parents = explode( ',', $category['fcat_tree'] );

      $file_query = $this->db->prepare_query( 'UPDATE %pfile_categories SET fcat_count=fcat_count - ? WHERE fcat_id=?' );
      $file_query->bind_param( 'ii', $value, $parent );

		foreach( $parents as $parent ) {
         $this->db->execute_query( $file_query );
      }
      $file_query->close();

		$stmt = $this->db->prepare_query( 'UPDATE %pfile_categories SET fcat_count=fcat_count - ? WHERE fcat_id=?' );

      $stmt->bind_param( 'ii', $value, $cid );
      $this->db->execute_query( $stmt );
      $stmt->close();
	}

	private function array_remove_value()
	{
		$args = func_get_args();

		return array_diff( $args[0], array_slice( $args, 1 ) );
	}
}
?>