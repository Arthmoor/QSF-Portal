<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2025 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * https://github.com/Arthmoor/Quicksilver-Forums
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
 * Contains all the functions commonly used for handling attachments
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @since 1.1.8
 **/
class attachutil
{
   private $db;
   private $sets;
   private $lang;

	/**
	 * Constructor
	 *
	 * @param $qsf - Quicksilver Forums module
	 **/
	public function __construct( &$qsf )
	{
		$this->db  = &$qsf->db;
		$this->sets = &$qsf->sets;
		$this->lang = &$qsf->lang;
	}

	/**
	 * Processes an attachment upload
	 *
	 * @param array $file file upload information
	 * @param array $attached_data attachments to insert
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.8
	 **/
	public function attach( &$file, &$attached_data )
	{
		$upload_error = null; // Null is no error

		if( !isset( $file ) ) {
			$upload_error = $this->lang->post_attach_failed;
		} else {
			$md5 = md5( $file['name'] . microtime() );

			$ret = $this->upload( $file, './attachments/' . $md5, $this->sets['attach_upload_size'], $this->sets['attach_types'] );

			switch( $ret )
			{
				case UPLOAD_TOO_LARGE:
					$upload_error = sprintf( $this->lang->post_attach_too_large, round( $this->sets['attach_upload_size'] / 1024, 1 ) );
					break;

				case UPLOAD_NOT_ALLOWED:
					$upload_error = $this->lang->post_attach_not_allowed;
					break;

				case UPLOAD_SUCCESS:
					$attached_data[$md5] = $file['name'];
					break;

				default:
					$upload_error = $this->lang->post_attach_failed;
			}
		}
		return $upload_error;
	}

	/**
	 * Deletes a file off disk and removes it from the attachment data
	 *
	 * @param string $filename md5 encoded filename
	 * @param array $attached_data attachments to insert
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.8
	 **/
	public function delete( $filename, &$attached_data )
	{
		unset( $attached_data[$filename] );
		@unlink( './attachments/' . $filename );
	}

	/**
	 * Processes an attachment upload and stores the record in the database
	 *
	 * @param int $post_id post to attach the file to
	 * @param array $file file upload information
	 * @param array $attached_data attachments to insert
    * @param bool $convo whether or not the attachment is for a conversation
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.9
	 **/
	public function attach_now( $post_id, &$file, &$attached_data, $convo = false )
	{
		$temp_attached_data = array();
		$error = $this->attach( $file, $temp_attached_data );

		if( $error == null ) {
			$md5 = key( $temp_attached_data );
			$filename = $temp_attached_data[$md5];

         $stmt = $this->db->prepare_query( 'INSERT INTO %pattach ( attach_file, attach_name, attach_post, attach_size, attach_pm ) VALUES ( ?, ?, ?, ?, ?)' );

         $filesize = filesize( './attachments/' . $md5 );
         $stmt->bind_param( 'ssiii', $md5, $filename, $post_id, $filesize, $convo );
         $this->db->execute_query( $stmt );
         $stmt->close();

			$attached_data = array_merge( $attached_data, $temp_attached_data );
		}
		return $error;
	}

	/**
	 * Deletes a file off disk and removes it from the attachment data
	 *
	 * @param int $post_id post to attach the file to
	 * @param string $filename md5 encoded filename
	 * @param array $attached_data attachments to insert
    * @param bool $convo whether or not the attachment is for a conversation
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.9
	 **/
	public function delete_now( $post_id, $filename, &$attached_data, $convo = false )
	{
		$this->delete( $filename, $attached_data );

      $stmt = $this->db->prepare_query( 'DELETE FROM %pattach WHERE attach_post=? AND attach_file=? AND attach_pm=?' );

      $stmt->bind_param( 'isi', $post_id, $filename, $convo );
      $this->db->execute_query( $stmt );
      $stmt->close();
	}

	/**
	 * Processes attach data and builds form elements
	 *
	 * @param string $options string to store option tags
	 * @param string $hiddennames string to store hidden input tags
	 * @param array $attached_data attachments to insert
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.8
	 **/
	public function getdata( &$options, &$hiddennames, $attached_data )
	{
		foreach( $attached_data as $md5 => $file )
		{
			$file = htmlspecialchars( $file );

			$options .= "<option value='$md5'>$file</option>\n";
			$hiddennames .= "<input type='hidden' name='attached_data[$md5]' value='$file'>\n";
		}
	}

	/**
	 * Adds an attachment record to the database
	 *
	 * @param int $post_id id number of the post we're attaching to
	 * @param array $attached_data attachments to insert
    * @param bool $convo whether or not the post ID is for a conversation
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.8
	 **/
	public function insert( $post_id, $attached_data, $convo = false )
	{
      $insert_query = $this->db->prepare_query( 'INSERT INTO %pattach (attach_file, attach_name, attach_post, attach_size, attach_pm) VALUES ( ?, ?, ?, ?, ? )' );
      $insert_query->bind_param( 'ssiii', $md5, $filename, $post_id, $filesize, $convo );

		foreach( $attached_data as $md5 => $filename )
		{
         $filesize = filesize( './attachments/' . $md5 );
         $this->db->execute_query( $insert_query );
		}
      $insert_query->close();
	}

	/**
	 * Uploads a file
	 *
	 * @param array $file Post-uploaded file
	 * @param string $destination Where to put the uploaded file
	 * @param int $max_size Maximum file size to accept, in bytes
	 * @param array $allowed_types File extensions to allow
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 3.0
	 * @return int Result of the upload attempt
	 **/
	public function upload( $file, $destination, $max_size, $allowed_types )
	{
		if( $file['size'] > $max_size ) {
			return UPLOAD_TOO_LARGE;
		}

		$temp = explode( '.', $file['name'] );
		$ext = strtolower( end( $temp ) );

		if( !in_array( $ext, $allowed_types ) ) {
			return UPLOAD_NOT_ALLOWED;
		}

		if( is_uploaded_file( $file['tmp_name'] ) ) {
			$result = @move_uploaded_file( $file['tmp_name'], str_replace( '\\', '/', $destination ) );

			if( $result ) {
				return UPLOAD_SUCCESS;
			}
		}
		return UPLOAD_FAILURE;
	}

	/**
	 * Fetch attachment data from database and return it as an array
	 *
	 * @param int $post_id Post to get attachments for
    * @param bool $convo whether or not the post ID is for a conversation
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.9
	 * @return array $attached_data attachments to for post
	 **/
	public function build_attached_data( $post_id, $convo = false )
	{
		$attached_data = array();

      $stmt = $this->db->prepare_query( 'SELECT attach_file, attach_name FROM %pattach WHERE attach_post=? AND attach_pm=?' );

      $stmt->bind_param( 'ii', $post_id, $convo );
      $this->db->execute_query( $stmt );

      $query = $stmt->get_result();
      $stmt->close();

		while( $row = $this->db->nqfetch( $query ) )
		{
			$attached_data[$row['attach_file']] = $row['attach_name'];
		}

		return $attached_data;
	}
}
?>