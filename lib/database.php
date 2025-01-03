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

if( !defined( 'QUICKSILVERFORUMS' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

/**
 * Generic Database Inteface
 *
 * @since 1.1.9
 **/
class database
{
	public $connection = false; // Connection link identifier @var resource
	public $query_time  = 0;    // Time spent executing queries @var int
	public $querycount = 0;     // Number of executed queries @var int
	public $get;                // Alias for $_GET @var array
	public $post;               // Alias for $_POST @var array
	public $host;               // Database Server @var string
	public $user;               // Database User Name @var string
	public $pass;               // Database Password @var string
	public $db;                 // Database Name @var string
	public $port = 3306;        // Database Port @var int
	public $prefix = 'qsfp_';   // Database Table Prefix @var string
	public $queries_exec = 0;

	/**
	 * Constructor; sets up variables and connection
	 *
	 * @param string $db_host Server
	 * @param string $db_user User Name
	 * @param string $db_pass Password
	 * @param string $db_name Database Name
	 * @param int $db_port Database Port
	 * @param string $db_socket Database Socket
	 * @param string $db_prefix Prefix applied to all database queries
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return void
	 **/
	public function __construct( $db_host, $db_user, $db_pass, $db_name, $db_port, $db_socket, $db_prefix )
	{
		$this->host   = $db_host;
		$this->user   = $db_user;
		$this->pass   = $db_pass;
		$this->db     = $db_name;
		$this->port   = $db_port;
		$this->prefix = $db_prefix;
	}

	/**
	 * Retrieves the insert ID of the last executed query
	 * Interface version
	 *
	 * @param string $table Table name - unused
	 * @return int Insert ID
	 **/
	public function insert_id( )
	{
		return null;
	}

	/**
	 * Executes a query
	 * Interface version
	 *
	 * @param string $query SQL query
	 * @return resource Executed query
	 **/
	public function query( $query )
	{
		return null;
	}

	/**
	 * Executes a query and fetches it into an array
	 *
	 * @param string $query SQL query
	 * @param string $args Data to pass into query as escaped strings
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return array Fetched rows
	 **/
	public function fetch( $query )
	{
		$args = array();

		if( is_array( $query ) ) {
			$args = $query; // only use arg 1
		} else {
			$args  = func_get_args();
		}

		return $this->nqfetch( $this->query( $args ) );
	}

	/**
	 * Fetches an executed query into an array
	 * Interface version
	 *
	 * @param resource $query Executed SQL query
	 * @return array Fetched rows
	 **/
	public function nqfetch( $query )
	{
		return array();
	}

	/**
	 * Gets the number of rows retrieved by a SELECT
	 * Interface version
	 *
	 * @param resource $query Executed SQL query
	 * @return int Number of retrieved rows
	 **/
	public function num_rows( $query )
	{
		return 0;
	}

	/**
	 * Clones a row
	 *
	 * @param string $table MySQL table to select from
	 * @param string $unique_col Name of a unique column by which to find the row. This column is not given an explicit value in the cloned row.
	 * @param string $unique_id The value of $unique_col in the original row
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 4.0
	 * @return void
	 */
	public function clone_row( $table, $unique_col, $unique_id )
	{
		$cols = null;
		$vals = null;

		$result = $this->fetch( 'SELECT * FROM %p' . $table . ' WHERE ' . $unique_col . '=' . $unique_id );
		foreach( $result as $col => $val )
		{
			if( $col == $unique_col ) {
				continue;
			}

			$cols .= $col . ', ';
			$vals .= '"' . $this->escape( $val ) . '", ';
		}

		$this->query( 'INSERT INTO %p' . $table . ' (' . substr( $cols, 0, -2 ) . ') VALUES (' . substr( $vals, 0, -2 ) . ')' );
	}

	/**
	 * Gets the number of rows affected by the last executed UPDATE
	 * Interface version
	 *
	 * @return int Number of affected rows
	 **/
	public function aff_rows()
	{
		return 0;
	}

	/**
	 * Returns a escaped string
	 *
	 * @since 1.3.0
	 * @return string A string with the quotes and other charaters escaped
	 * @param string $string The string to escape
	 **/
	private function escape( $string )
	{
		return addslashes( $string );
	}

	/**
	 * Puts the data into the query using the escape function
	 *
	 * @param string $query SQL query
	 * @param string $args Data to pass into query as escaped strings
	 * @return string Formatted query
	 **/
	private function _format_query( $query )
	{
		// Format the query string
		$args = array();

		if( is_array( $query ) ) {
			$args = $query; // only use arg 1
		} else {
			$args  = func_get_args();
		}

		$query = array_shift( $args );
		$query = str_replace( '%p', $this->prefix, $query );

		for( $i = 0; $i < count( $args ); $i++ ) {
			$args[$i] = $this->escape( $args[$i] );
		}
		array_unshift( $args, $query );

		return call_user_func_array( 'sprintf', $args );
	}

	public function prepare_query( $query )
	{
		return false;
	}

	public function execute_query( $stmt )
	{
		return false;
	}
}
?>