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
 *  https://github.com/Arthmoor/Quicksilver-Forums
 *
 * Based on MercuryBoard
 * Copyright (c) 2001-2005 The Mercury Development Team
 *  https://github.com/markelliot/MercuryBoard
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

require_once $set['include_path'] . '/lib/database.php';

/**
 * MySQLi Abstraction Class
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @author Roger Libiez
 * @since 1.5.1
 **/
class db_mysqli extends database
{
	public $current_query;

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
		parent::__construct( $db_host, $db_user, $db_pass, $db_name, $db_port, $db_socket, $db_prefix );

		$this->connection = new mysqli( $db_host, $db_user, $db_pass, $db_name /* , $db_port, $db_socket */ );

		if( !$this->connection->select_db( $db_name ) ) {
			$this->connection = false;
		}
	}

	public function close()
	{
		if( $this->connection )
			$this->connection->close();
	}

	/**
	 * Retrieves the insert ID of the last executed query
	 *
	 * @param string $table Table name - unused
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return int Insert ID
    *
    * Modified due to apparently not working every time it's called. Now returns the SELECT MAX() from the specified table and column. Returns that as an integer.
	 **/
	public function insert_id( )
	{
      // $result = $this->fetch( "SELECT MAX(%s) AS max_value FROM %s", $column, $this->prefix . $table );

      // return $result['max_value'];

		return $this->connection->insert_id;
	}

	/**
	 * Executes a query
	 *
	 * @param string $query SQL query
	 * @param string $args Data to pass into query as escaped strings
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return resource Executed query
	 **/
	public function query( $query )
	{
		$args = array();

		if( is_array( $query ) ) {
			$args = $query; // only use arg 1
		} else {
			$args = func_get_args();
		}

		$query = $this->_format_query( $args );

		$this->querycount++;

      $this->current_query = $query;

      try {
         $result = $this->connection->query( $query );
      }
      catch( Exception $e ) {
         error( QUICKSILVER_QUERY_ERROR, $this->connection->error, $query, $this->connection->errno );
      }
		return $result;
	}

	/**
	 * Fetches an executed query into an array
	 *
	 * @param resource $query Executed SQL query
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return array Fetched rows
	 **/
	public function nqfetch( $query )
	{
		return $query->fetch_assoc( );
	}

	public function nqfetch_row( $query )
	{
		return $query->fetch_row();
	}

	/**
	 * Gets the number of rows retrieved by a SELECT
	 *
	 * @param resource $query Executed SQL query
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return int Number of retrieved rows
	 **/
	public function num_rows( $result )
	{
		return $result->num_rows;
	}

	/**
	 * Gets the number of rows affected by the last executed UPDATE
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return int Number of affected rows
	 **/
	public function aff_rows()
	{
		return $this->connection->affected_rows;
	}

	/**
	 * Returns a escaped string
	 *
	 * @author Matthew Lawrence <matt@quicksilverforums.com>
	 * @since 1.3.0
	 * @return string A string with the quotes and other charaters escaped
	 * @param string $string The string to escape
	 **/
	private function escape( $string )
	{
		return $this->connection->real_escape_string( $string );
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
		$query = str_replace( '%p', $this->prefix, $query );

		$stmt = $this->connection->prepare( $query );

		if( $stmt == false ) {
			error( QUICKSILVER_QUERY_ERROR, $this->connection->error, $query, $this->connection->errno );
		}

		$this->current_query = $query;

		return $stmt;
	}

	public function execute_query( $stmt )
	{
		$time_now   = explode( ' ', microtime() );
		$time_start = $time_now[1] + $time_now[0];

		if( !$stmt->execute() ) {
			error( QUICKSILVER_QUERY_ERROR, $this->connection->error, $this->current_query, $this->connection->errno );
		}

		$this->querycount++;

		$time_now  = explode( ' ', microtime() );
		$time_exec = round( $time_now[1] + $time_now[0] - $time_start, 5 );
		$this->query_time = $time_exec;
		$this->queries_exec += $time_exec;
	}
}
?>