<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2015 The QSF Portal Development Team
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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/lib/database.php';

/**
 * MySQL Abstraction Class
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class db_mysql extends database
{
	var $socket;             // Database Socket @var string

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
	function db_mysql($db_host, $db_user, $db_pass, $db_name, $db_port = 3306, $db_socket = '', $db_prefix)
	{
		parent::database($db_host, $db_user, $db_pass, $db_name, $db_port, $db_socket, $db_prefix);
		$this->socket = $db_socket;

		$this->connection = @mysql_connect("$db_host:$db_port" . (!$this->socket ? '' : ":$db_socket"), $db_user, $db_pass, true);

		if (!@mysql_select_db($db_name, $this->connection)) {
			$this->connection = false;
		}
	}

	function close()
	{
		if( $this->connection )
			@mysql_close( $this->connection );
	}

	/**
	 * Retrieves the insert ID of the last executed query
	 *
	 * @param string $table Table name - unused
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return int Insert ID
	 **/
	function insert_id($table)
	{
		return mysql_insert_id($this->connection);
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
	function query($query)
	{
		$args = array();
		if (is_array($query)) {
			$args = $query; // only use arg 1
		} else {
			$args  = func_get_args();
		}

		$query = $this->_format_query($args);
		
		$this->querycount++;

		$result = mysql_query($query, $this->connection) or error(QUICKSILVER_QUERY_ERROR, mysql_error($this->connection), $query, mysql_errno($this->connection));
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
	function nqfetch($query)
	{
		return mysql_fetch_array($query, MYSQL_ASSOC);
	}

	function nqfetch_row($query)
	{
		return mysql_fetch_row($query);
	}

	/**
	 * Gets the number of rows retrieved by a SELECT
	 *
	 * @param resource $query Executed SQL query
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return int Number of retrieved rows
	 **/
	function num_rows($query)
	{
		return mysql_num_rows($query);
	}

	/**
	 * Gets the number of rows affected by the last executed UPDATE
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return int Number of affected rows
	 **/
	function aff_rows()
	{
		return mysql_affected_rows($this->connection);
	}

	/**
	 * Returns a escaped string
	 *
	 * @author Matthew Lawrence <matt@quicksilverforums.com>
	 * @since 1.3.0
	 * @return string A string with the quotes and other charaters escaped
	 * @param string $string The string to escape
	 **/
	function escape($string)
	{
		return mysql_real_escape_string($string, $this->connection);
	}

	function invalid($errmsg)
	{
		if (stristr($errmsg, 'mysql_fetch_array(): supplied argument is not a valid MySQL result resource'))
			return true;
		
		return false;
	}

	function error_last()
	{
		return mysql_error($this->connection);
	}

	/**
	 * Puts the data into the query using the escape function
	 *
	 * @param string $query SQL query
	 * @param string $args Data to pass into query as escaped strings
	 * @return string Formatted query
	 **/
	function _format_query($query)
	{
		// Format the query string
		$args = array();
		if (is_array($query)) {
			$args = $query; // only use arg 1
		} else {
			$args  = func_get_args();
		}

		$query = array_shift($args);
		$query = str_replace('%p', $this->prefix, $query);
		
		for($i=0; $i<count($args); $i++) {
			$args[$i] = $this->escape($args[$i]);
		}
		array_unshift($args,$query);

		return call_user_func_array('sprintf',$args);
	}
}
?>