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

if (!defined('QUICKSILVERFORUMS') || !defined('QSF_ADMIN')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';

/**
 * Database backup
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since 1.0.2
 **/
class backup extends admin
{
	/**
	 * Database backup
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.0.2
	 * @return string HTML
	 **/
	function execute()
	{
		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = '';
		}

		switch( $this->get['s'] )
		{
			case 'create':
				$this->set_title( $this->lang->backup_create );
				$this->tree( $this->lang->backup_create );

				return $this->create_backup();
				break;

			case 'restore':
				$this->set_title( $this->lang->backup_restore );
				$this->tree( $this->lang->backup_restore );

				return $this->restore_backup();
				break;
		}
	}

	/**
	 * Generate a backup
	 *
	 * @author Aaron Smith-Hayes <davionkalhen@gmail.com>
	 * @since 1.3.2
	 * @return string HTML
	 **/
	function create_backup()
	{
		if( !isset( $this->post['submit'] ) ) {
			$token = $this->generate_token();

			$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/db_backup.xtpl' );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'self', $this->self );
			$xtpl->assign( 'options', $this->lang->backup_options );
			$xtpl->assign( 'add_complete', $this->lang->backup_add_complete );
			$xtpl->assign( 'statements', $this->lang->backup_statements );
			$xtpl->assign( 'add_drop', $this->lang->backup_add );
			$xtpl->assign( 'uncheck', $this->lang->backup_uncheck );
			$xtpl->assign( 'backup', $this->lang->backup );

			$xtpl->parse( 'DBBackup.BackupForm' );
			$xtpl->parse( 'DBBackup' );

			return $xtpl->text( 'DBBackup' );
		}

		if( !$this->is_valid_token() ) {
			return $this->message( $this->lang->backup_create, $this->lang->invalid_token );
		}

		srand();
		$mcookie = sha1( crc32( rand() ) );

		$filename = 'backup_'.$this->version.'-'.date('y-m-d-H-i-s').'-'.$mcookie.'.sql';
		$options = "";

		foreach( $this->post as $key => $value )
			$$key = $value;
		if( isset($insert) )
			$options .= " -c";
		if( isset($droptable) )
			$options .= " --add-drop-table";

		$tables = implode( ' ', $this->get_db_tables() );

		$mbdump = "mysqldump ".$options." -p --host=".$this->db->host." --user=".$this->db->user;
		$mbdump .= " --result-file='../packages/".$filename."' ".$this->db->db." ".$tables;

		$fds = array(
				0 => array( 'pipe', 'r' ),
				1 => array( 'pipe', 'w' ),
				2 => array( 'pipe', 'w' )
				);

		$pipes = NULL;

		$proc = proc_open( $mbdump, $fds, $pipes );
		if( $proc === false || !is_resource( $proc ) )
			return $this->message( $this->lang->backup_create, $this->lang->backup_failed );

		fwrite( $pipes[0], $this->db->pass . PHP_EOL );
		fclose( $pipes[0] );

		$stdout = stream_get_contents( $pipes[1] );
		fclose( $pipes[1] );
		$stderr = stream_get_contents( $pipes[2] );
		fclose( $pipes[2] );

		$retval = proc_close( $proc );

		if ( 0 != $retval )
		{
			return $this->message( $this->lang->backup_create, $this->lang->backup_failed . '<br />' . $stderr );
		}

		$buf = $stdout . $stderr;

		$this->chmod( "../packages/" . $filename, 0440 );
		$backup = sprintf( $this->lang->backup_created, "../packages/" );
		return $this->message( $this->lang->backup_create, $backup."<br /><br />". $this->lang->backup_output .": ".$buf, $filename, "../packages/".$filename );
	}

	/**
	 * Restore a backup
	 *
	 * @author Aaron Smith-Hayes <davionkalhen@gmail.com>
	 * @since 1.3.2
	 * @return string HTML
	 **/
	function restore_backup()
	{
		if( !isset( $this->get['restore'] ) )
		{
			if ( ($dir = opendir( "../packages" ) ) === false )
				return $this->message( $this->lang->backup_restore, $this->lang->backup_no_packages );

			$token = $this->generate_token();
			$backups = array();
			while( ( $file = readdir($dir) ) )
			{
				if( strtolower( substr( $file, -4 ) ) != ".sql" )
					continue;
				$backups[] = $file;
			}
			closedir( $dir );

			if( count($backups) <= 0 )
				return $this->message( $this->lang->backup_restore, $this->lang->backup_none );

			$output = $this->lang->backup_warning . "<br /><br />";
			$output .= $this->lang->backup_found . ":<br /><br />";
			$count = 0;

			foreach( $backups as $bkup )
			{
				$output .= "<a href='{$this->self}?a=backup&amp;s=restore&amp;restore=".$bkup."'>".$bkup."</a><br />";
			}
			return $this->message( $this->lang->backup_restore, $output );
		}

		if( !file_exists( "../packages/" . $this->get['restore'] ) )
			return $this->message( $this->lang->backup_restore, $this->lang->backup_noexist );

		if( !$this->is_valid_token() ) {
			return $this->message( $this->lang->backup_create, $this->lang->invalid_token );
		}

		$mbimport = "mysql -p --host=".$this->db->host." --user=".$this->db->user." ".$this->db->db;

		$fds = array(
				0 => array( 'pipe', 'r' ),
				1 => array( 'pipe', 'w' ),
				2 => array( 'pipe', 'w' )
				);

		$pipes = NULL;

		$proc = proc_open( $mbimport, $fds, $pipes );

		if( $proc === false || !is_resource( $proc ) )
			return $this->message( $this->lang->backup_restore, $this->lang->backup_import_fail );

		fwrite( $pipes[0], $this->db->pass . PHP_EOL );
		sleep( 10 );// this is bad and buggy if the mysql server is under load/crap
		fwrite( $pipes[0], '\\.  ../packages/' . $this->get['restore'] . PHP_EOL );
		fclose( $pipes[0] );

		$stdout = stream_get_contents( $pipes[1] );
		fclose( $pipes[1] );
		$stderr = stream_get_contents( $pipes[2] );
		fclose( $pipes[2] );

		$retval = proc_close( $proc );

		if ( 0 != $retval )
		{
			return $this->message( $this->lang->backup_restore, $this->lang->backup_import_fail . '<br />' . $stderr );
		}

		$output = $stdout . $stderr;

		return $this->message( $this->lang->backup_restore, $this->lang->backup_restore_done ."<br />". $this->lang->backup_output .": ".$output );
	}
}
?>