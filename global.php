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

if( !defined('QUICKSILVERFORUMS' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

// Constants used throughout the codebase.

/* Error Reporting */
define( 'QUICKSILVER_NOTICE', 3 );
define( 'QUICKSILVER_ERROR', 5 );
define( 'QUICKSILVER_QUERY_ERROR', 6 );

/* Uploading */
define( 'UPLOAD_TOO_LARGE', 1 );
define( 'UPLOAD_NOT_ALLOWED', 2 );
define( 'UPLOAD_FAILURE', 3 );
define( 'UPLOAD_SUCCESS', 4 );

/* Password Changing */
define( 'PASS_NOT_VERIFIED', 1 );
define( 'PASS_NO_MATCH', 2 );
define( 'PASS_INVALID', 3 );
define( 'PASS_SUCCESS', 4 );

/* Time Formatting */
define( 'DATE_LONG', 1 );
define( 'DATE_SHORT', 2 );
define( 'DATE_ONLY_LONG', 3 );
define( 'DATE_ONLY_SHORT', 4 );
define( 'DATE_TIME', 5 );
define( 'DATE_ISO822', 6 ); // For RSS feeds

/* Text Formatting */
define( 'FORMAT_MBCODE', 1 );
define( 'FORMAT_EMOTICONS', 2 );
define( 'FORMAT_CENSOR', 4 );
define( 'FORMAT_BREAKS', 16 );
define( 'FORMAT_HTMLCHARS', 32 );

/* Topic States */
define( 'TOPIC_LOCKED', 1 );
define( 'TOPIC_MOVED', 2 );
define( 'TOPIC_POLL', 4 );
define( 'TOPIC_POLL_ONLY', 8 );
define( 'TOPIC_PINNED', 16 );
define( 'TOPIC_GLOBAL', 32 );
define( 'TOPIC_DELETED', 64 );
define( 'TOPIC_PUBLISH', 128 );

/* Topic Types - These are not bitflags */
define( 'TOPIC_TYPE_FORUM', 1 );
define( 'TOPIC_TYPE_FILE', 2 );
define( 'TOPIC_TYPE_GALLERY', 3 );
define( 'TOPIC_TYPE_ARTICLE', 4 );

/* Users */
define( 'USER_GUEST_UID', 1 );

/* User Groups */
define( 'USER_ADMIN', 1 );
define( 'USER_MEMBER', 2 );
define( 'USER_GUEST', 3 );
define( 'USER_BANNED', 4 );
define( 'USER_AWAIT', 5 );
define( 'USER_MODS', 6 );

/* Types for validation */
define( 'TYPE_BOOLEAN', 1 ); // Variable should be 1 or 0 and will be changed to true or false
define( 'TYPE_UINT', 2 ); // Variable should be an integer that is also >= 0
define( 'TYPE_INT', 3 ); // Variable should be an integer
define( 'TYPE_FLOAT', 4 ); // Variable is a floating point number
define( 'TYPE_STRING', 5 ); // Variable is a string (essentially anything except array or object)
define( 'TYPE_ARRAY', 6 ); // Variable is an array. Probably better to use is_array()
define( 'TYPE_OBJECT', 7 ); // Variable is an object. Can put in a class in the range to check if object's ancestry
define( 'TYPE_USERNAME', 8 ); // Check if it's okay to use as a username
define( 'TYPE_PASSWORD', 9 ); // Check if string is okay to use as a password
define( 'TYPE_EMAIL', 10 ); // Check if string is a valid email

/**
 * The QSF Portal Core
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class qsfglobal
{
	var $name    = 'QSF Portal';      // The name of the software @var string
	var $version = '2.0';             // QSF Portal version @var int
	var $server  = array();           // Alias for $_SERVER @var array
	var $get     = array();           // Alias for $_GET @var array
	var $post    = array();           // Alias for $_POST @var array
	var $cookie  = array();           // Alias for $_COOKIE @var array
	var $files   = array();           // Alias for $_FILES @var array
	var $user    = array();           // Information about the user @var array
	var $sets    = array();           // Settings @var array
	var $censor  = array();           // Curse words to filter @var array
	var $emoticons = array();	  // Array of emoticons used for processing post formatting
	var $nohtml  = false;             // To display no board wrapper @var bool
	var $time;                        // The current Unix time @var int
	var $ip;                          // The user's IP address @var string
	var $agent;                       // The browser's user agent @var string
	var $referrer;                    // The browser's referrer setting @var string
	var $self;                        // Alias for $PHP_SELF @var string
	var $db;                          // Database object @var object
	var $perms;                       // Permissions object @var object
	var $file_perms;		  // File permissions object @var object
	var $skin;                        // The user's selected skin @var string
	var $table;                       // Start to an HTML table @var string
	var $etable;                      // End to an HTML table @var string
	var $lang;                        // Loaded words @var object
	var $query;                       // The query string @var string
	var $time_exec;                   // Execution time for the whole page
	var $feed_links = null;		  // HTML of RSS link tags

	var $attachmentutil;		  // Attachment handler @var object
	var $htmlwidgets;		  // HTML widget handler @var object
	var $templater;			  // Template handler @var object
	var $bbcode;			  // BBCode formatter @var object
	var $readmarker;		  // Handles tracking what posts are read and unread
	var $validator;			  // Handler for checking usernames, passwords, etc
	var $activeutil;		  // Handler user activity
	
	var $xtpl = null;		  // Global template instance

	/**
	 * Constructor; sets up variables
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 **/
	function __construct( $db = null )
	{
		$this->db       = $db;
		$this->time     = time();
		$this->query    = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
		$this->ip       = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
		$this->agent    = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "N/A";
		$this->agent    = substr($this->agent, 0, 99); // Cut off after 100 characters.
		$this->referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'N/A';
		$this->self     = $_SERVER['PHP_SELF'];
		$this->server   = $_SERVER;
		$this->get      = $_GET;
		$this->post     = $_POST;
		$this->cookie   = $_COOKIE;
		$this->files    = $_FILES;
		$this->query    = htmlspecialchars( $this->query );

		if( version_compare( PHP_VERSION, "5.5.0", "<" ) ) {
			die( 'PHP version does not meet minimum requirements. Contact your system administrator.' );
		}
	}

	/**
	 * Post constructor initaliser. By this time we have a user and a database
	 *
	 * Note: This is never run for special tools such as installs or upgrades
	 *
	 * @param bool $admin Set to true if we need to setup admin templates
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 **/
	function init( $admin = false )
	{
		$this->perms = new permissions( $this );
		$this->file_perms = new file_permissions( $this );
		$this->attachmentutil = new attachutil( $this );
		$this->htmlwidgets = new htmlwidgets( $this );
		$this->templater = new templater( $this );
		$this->bbcode = new bbcode( $this );
		$this->validator = new tool();
		$this->readmarker = new readmarker( $this );
		$this->activeutil = new activeutil( $this );

		$this->templater->init_templates( $this->get['a'], $admin );

		$replace = $this->db->query( 'SELECT * FROM %preplacements ORDER BY LENGTH(replacement_search) DESC' );

		while( $r = $this->db->nqfetch( $replace ) )
		{
			$this->censor[] = '/' . $r['replacement_search'] . '/i';
		}

		$emotes = $this->db->query( 'SELECT * FROM %pemoticons' );
		while( $e = $this->db->nqfetch( $emotes ) )
		{
			if( $e['emote_clickable'] == 1 )
				$this->emoticons['click_replacement'][$e['emote_string']] = '<img src="' . $this->site . '/emoticons/' . $e['emote_image'] . '" alt="' . $e['emote_string'] . '" />';
			else
				$this->emoticons['replacement'][$e['emote_string']] = '<img src="' . $this->site . '/emoticons/' . $e['emote_image'] . '" alt="' . $e['emote_string'] . '" />';
		}

		$this->set_table();
	}
	
	/**
	 * Run actions that can be delayed until after output is sent
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2.0
	 **/
	function cleanup()
	{
		// Handle active users
		if ($this->perms->is_guest) {
			$this->activeutil->update($this->get['a']);
		} else {
			$this->activeutil->update($this->get['a'], $this->user['user_id']);
		}
		
		$this->readmarker->cleanup();
	}
	
	/**
	 * Set values for $this->table and $this->etable
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2.0
	 **/
	function set_table()
	{
		$this->table  = eval($this->template('MAIN_TABLE'));
		$this->etable = eval($this->template('MAIN_ETABLE'));
	}
	
	/**
	 * Get the template for eval (templater interface)
	 *
	 * @param string $piece Name of the template to return
	 **/
	function template($piece)
	{
		return $this->templater->template($piece);
	}

	/**
	 * Combines two array to make a new array, the first array becomes the keys
	 * and the second becomes the values
	 *
	 * @author Matthew Wells <ragnarok@squarehybrid.com>
	 * @since Spiders in Active List Mod
	 * @return Array
	 **/
	function array_combine($keys, $vals)
	{
		for ($i = 0; $i < count($keys); $i++) {
			$array[$keys[$i]] = $vals[$i];
		}

		return $array;
	}

	/**
	 * Attempts to CHMOD a directory or file
	 *
	 * @param string $path Path to CHMOD
	 * @param int $mode New CHMOD value
	 * @param bool $recursive True for recursive
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.1.5
	 * @return void
	 **/
	function chmod($path, $mode, $recursive = false)
	{
		if (!$recursive || !is_dir($path)) {
			@chmod($path, $mode);
			return;
		}

		$dir = opendir($path);
		while (($file = readdir($dir)) !== false)
		{
			if(($file == '.') || ($file == '..')) {
				continue;
			}

			$fullpath = $path . '/' . $file;
			if(!is_dir($fullpath)) {
				@chmod($fullpath, $mode);
			} else {
				$this->chmod($fullpath, $mode, true);
			}
		}

		closedir($dir);
		@chmod($path, $mode);
	}

	/**
	 * Formats a string (interface to bbcode object)
	 *
	 * @param string $in Input
	 * @param int $options Options
	 * @return string Formatted string
	 **/
	function format($in, $options = 0)
	{
		return $this->bbcode->format($in, $options);
	}

	/**
	 * Adds an entry to the navigation tree (interface to html widgets)
	 *
	 * @param string $label Label for the tree entry
	 * @param string $link URL to link to
	 **/
	function tree($label, $link = null)
	{
		$this->htmlwidgets->tree($label, $link);
	}

	/**
	 * Hash a given string into a password suitable for database use
	 *
	 * @param string $pass The supplied password to hash
	 * @author Samson
	 * @since 1.6
	 */
	function qsfp_password_hash($pass)
	{
		$options = [ 'cost' => 12, ];
		$newpass = password_hash( $pass, PASSWORD_DEFAULT, $options );

		return $newpass;
	}

	/**
	 * Generates a random pronounceable password
	 *
	 * @param int $length Length of password
	 * @author http://www.zend.com/codex.php?id=215&single=1
	 * @since 1.1.0
	 */
	function generate_pass($length)
	{
		$vowels = array('a', 'e', 'i', 'o', 'u');
		$cons = array('b', 'c', 'd', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'r', 's', 't', 'u', 'v', 'w', 'tr',
		'cr', 'br', 'fr', 'th', 'dr', 'ch', 'ph', 'wr', 'st', 'sp', 'sw', 'pr', 'sl', 'cl');

		$num_vowels = count($vowels);
		$num_cons = count($cons);

		$password = '';

		for ($i = 0; $i < $length; $i++)
		{
			$password .= $cons[rand(0, $num_cons - 1)] . $vowels[rand(0, $num_vowels - 1)];
		}

		return substr($password, 0, $length);
	}
	
	/**
	 * Loads a user_language. Bet you couldn't figure that out...
	 *
	 * @param string $lang Language to load
	 * @param string $a Word set to load
	 * @param string $path Path to the user_languages directory
	 * @param bool $main Load main universal strings
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 3.0
	 * @return object Language
	 **/
	function get_lang($lang, $a = null, $path = './', $main = true)
	{
		if (isset($this->get['lang'])) {
			$lang = $this->get['lang'];
		}

		if (strstr($lang, '/') || strstr($lang, '\\') || !file_exists($path . 'languages/' . $lang . '.php')) {
			$lang = 'en';
		}

		include $path . 'languages/' . $lang . '.php';
		$obj = new $lang();

		// Check if language function is available before running it
		if ($a && is_callable(array($obj,$a))) {
			$obj->$a();
		}

		if ($main) {
			$obj->main();
		}
		$obj->universal();
		return $obj;
	}

	/**
	 * Gets information about a member's level and title
	 *
	 * @param int $posts Member's post count
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return array Array of information about the member:<br /><i>string user_title</i> - default member title for that post count<br /><i>int user_level</i> - default member level for that post count
	 **/
	function get_level($posts)
	{
		$memtitle = array(
			'user_title' => '',
			'user_level' => '0'
		);

		$titles = $this->db->query("SELECT * FROM %pmembertitles WHERE membertitle_posts <= %d ORDER BY membertitle_posts", $posts);

		while ($title = $this->db->nqfetch($titles))
		{
			if ($posts >= $title['membertitle_posts']) {
				$memtitle['user_title'] = $title['membertitle_title'];
				$memtitle['user_level'] = $title['membertitle_id'];
			} else {
				break;
			}
		}

		return $memtitle;
	}

	/**
	 * Retrieves the current server load
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return int Server load
	 **/
	function get_load()
	{
		if (get_cfg_var('safe_mode') || stristr(PHP_OS, 'WIN')) {
			return 0;
		}

		if (@file_exists('/proc/loadavg')) {
			$file = @fopen('/proc/loadavg', 'r');

			if (!$file) {
				return 0;
			}

			$load = explode(' ', fread($file, 6));
			fclose($file);
		} else {
			$load = @exec('uptime');

			if (!$load) {
				return 0;
			}

			$load = preg_split('/load average:/', $load);
			$load = explode(',', $load[1]);
		}

		return trim($load[0]);
	}

	/**
	 * Retrieves the number of personal messages the user has received
	 *
	 * @param bool $seen True to retreive all messages, false to retrieve only unread messages
	 * @param int $folder The folder to check user_pms for
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return int Count of personal messages
	 **/
	function get_messages($seen = false, $folder = 0)
	{
		if($this->perms->is_guest)
			return 0;

		$count = $this->db->fetch("SELECT COUNT(pm_id) AS messages FROM %ppmsystem WHERE pm_to=%d AND pm_folder=%d" . (!$seen ? " AND pm_read=0" : null),
			$this->user['user_id'], $folder);
		return $count['messages'];
	}

	function get_files()
	{
		$count = 0;

		if($this->perms->is_guest)
			return 0;

		if($this->perms->auth('is_admin'))
			return $this->sets['code_approval'];

		$query = $this->db->query( "SELECT file_catid FROM %pfiles WHERE file_approved=0" );
		while( $file = $this->db->nqfetch($query) )
		{
			if( !$this->file_perms->auth( 'approve_files', $file['file_catid'] ) )
				continue;
			$count++;
		}
		return $count;
	}

	function cidrmatch( $cidr )
	{
		$ip = decbin( ip2long($this->ip) );
		list( $cidr1, $cidr2, $cidr3, $cidr4, $bits ) = sscanf( $cidr, '%d.%d.%d.%d/%d' );
		$cidr = decbin( ip2long( "$cidr1.$cidr2.$cidr3.$cidr4" ) );
		for( $i = strlen($ip); $i < 32; $i++ )
			$ip = "0$ip";
		for( $i = strlen($cidr); $i < 32; $i++ )
			$cidr = "0$cidr";
		return !strcmp( substr($ip, 0, $bits), substr($cidr, 0, $bits) );
	}

	function is_ipv6( $ip )
	{
		return( substr_count( $ip, ":" ) > 0 && substr_count( $ip, "." ) == 0 );
	}

	/**
	 * Determines if a user has been banned
	 *
	 * @return bool True if the user is banned, false if the user is not
	 **/
	function is_banned()
	{
		//Ban by user group
		if (!$this->perms->auth('do_anything')) {
			return true;
		}

		//Ban by IP
		if ($this->sets['banned_ips']) {
			foreach ($this->sets['banned_ips'] as $ip)
			{
				$ip = stripslashes($ip);

				if( $this->is_ipv6( $this->ip ) ) {
					if( strcasecmp( $ip, $this->ip ) == 0 )
						return true;
				}

				if ( ( strstr($ip, '/') && $this->cidrmatch($ip) ) || strcasecmp( $ip, $this->ip ) == 0 ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Used as a replacement for date() which deals with time zones
	 *
	 * @param mixed $format Date format using date() keywords. Either a date constant or a string.
	 * @param int $time Timestamp. If left out, uses current time
	 * @param bool $useToday [no longer used]
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string Human-readable, formatted Unix timestamp
	 **/
	function mbdate( $format, $time = 0, $useToday = true )
	{
		if( !$time ) {
			$time = $this->time;
		}

		$timezone = $this->user['user_timezone'];
		if( $this->user['user_id'] == USER_GUEST_UID )
			$timezone = $this->sets['servertime'];

		$dt = new DateTime();
		$dt->setTimezone( new DateTimeZone( $timezone ) );
		$dt->setTimestamp( $time );

		if( is_int( $format ) ) {
			switch($format)
			{
			case DATE_LONG:
				$date_format = $this->lang->date_long . $this->lang->time_long;
				break;

			case DATE_SHORT:
				$date_format = $this->lang->date_short . $this->lang->time_long;
				break;

			case DATE_ONLY_LONG:
				$date_format = $this->lang->date_long;
				break;

			case DATE_TIME:
				$date_format = $this->lang->time_only;
				break;

			case DATE_ISO822: // Standard, no localisation
				$date_format = 'D, j M Y H:i:s T';
				break;

			default: // DATE_ONLY_SHORT
				$date_format = $this->lang->date_short;
				break;
			}

			return $dt->format( $date_format );
		} else {
			return $dt->format( $format );
		}
	}

	/**
	 * Formats a message, error, or notice
	 *
	 * @param string $title Title of the message
	 * @param string $message Text of the message
	 * @param string $link_text Text for a link
	 * @param string $link Destination for a link
	 * @param string $redirect Target for an automated redirect
	 * @param int $delay Sets an optional delay for automated redirect
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return string HTML-formatted message
	 **/
	function message($title, $message, $link_text = null, $link = null, $redirect = null, $delay = 4)
	{
		if ($link_text) {
			$message .= '<br /><br /><a href="' . $link . '">' . $link_text . '</a>';
		}

		if ($redirect) {
			@header('Refresh: '.$delay.';url=' . $redirect);
		}

		return eval($this->template('MAIN_MESSAGE'));
	}

	/**
	 * Selects a post editing template
	 *
	 * @param int $f Forum to test moderator abilities in
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 4.0
	 * @return array Moderator permissions
	 **/
	function post_box()
	{
		return 'POST_BOX_PLAIN'; // Not quite ready for Beta 4

		if (preg_match('/MSIE ([0-9]\.[0-9]{1,2})/', $this->agent, $browser)) {
			if (floor($browser[1]) >= 4) {
				if (!isset($this->get['rich'])) { //if ($this->user['post_style'] == 'rich') {
					return 'POST_BOX_RICH';
				} else {
					return 'POST_BOX_PLAIN';
				}
			}
		} else {
			return 'POST_BOX_PLAIN';
		}
	}

	/**
	 * Sets the title of the page
	 *
	 * @param string $title The title
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return void
	 **/
	function set_title($title)
	{
		$this->title = "{$this->sets['forum_name']} - $title";
	}

	/**
	 * Adds a link tag for an RSS feed available from the page
	 * Will ignore the request if no feed title is set in settings
	 *
	 * @param string $url Url to access the feed
	 * @param string $subtitle Title to indentify the feed as (optional)
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.9
	 **/
	function add_feed($url, $subtitle='')
	{
		if ($this->sets['rss_feed_title']) {
			if ($subtitle) {
				$subtitle = ' - ' . $subtitle;
			}
			$title = htmlspecialchars( $this->sets['rss_feed_title'] );
			$subtitle = htmlspecialchars( $subtitle );
			$this->feed_links .= "<link rel=\"alternate\" title=\"$title$subtitle\" href=\"$url\" type=\"application/rss+xml\" />\n";
		}
	}
	
	/**
	 * Creates the contents of a settings file
	 *
	 * @since 1.3.0
	 * @return string Contents for settings file
	 **/
	function create_settings_file()
	{
		$settings = array(
			'db_host'   => $this->sets['db_host'],
			'db_name'   => $this->sets['db_name'],
			'db_pass'   => $this->sets['db_pass'],
			'db_port'   => $this->sets['db_port'],
			'db_socket' => $this->sets['db_socket'],
			'db_user'   => $this->sets['db_user'],
			'dbtype'    => $this->sets['dbtype'],
			'prefix'    => $this->sets['prefix'],
			'installed' => $this->sets['installed'],
			'admin_email' => $this->sets['admin_email']
			);
				
		$file = "<?php\n\$set = array();\n\nif (!defined('QUICKSILVERFORUMS')) {\n       header('HTTP/1.0 403 Forbidden');\n       die;\n}\n\n";

		foreach ($settings as $set => $val)
		{
			$file .= "\$set['$set'] = '" . str_replace(array('\\', '\''), array('\\\\', '\\\''), $val) . "';\n";
		}

		$file .= '?' . '>';
		return $file;
	}
	

	/**
	 * Saves all data in the $this->sets array into a file
	 *
	 * @param string $sfile File to write settings into (default is settings.php)
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.1.0
	 * @return bool True on success, false on failure
	 **/
	function write_db_sets($sfile = './settings.php')
	{
		$settings = $this->create_settings_file();

		$this->chmod($sfile, 0666);
		$fp = @fopen($sfile, 'w');

		if (!$fp) {
			return false;
		}

		if (!@fwrite($fp, $settings)) {
			return false;
		}

		fclose($fp);

		return true;
	}

	/**
	 * Saves all data in the $this->sets array to the database
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return void
	 **/
	function write_sets()
	{
		$db_settings = array(
			'db_host',
			'db_name',
			'db_pass',
			'db_port',
			'db_socket',
			'db_user',
			'dbtype',
			'prefix',
			'installed',
			'include_path',
			'admin_email',
			'meta_keywords',
			'meta_description',
			'settings_version'
		);

		$sets = array();
		foreach ($this->sets as $set => $val)
		{
			if (!in_array($set, $db_settings)) {
				$sets[$set] = $val;
			}
		}

		$this->db->query("UPDATE %psettings SET settings_data='%s'", json_encode($sets));
	}

	/**
	 * Loads settings
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.1.0
	 * @return array Settings
	 **/
	function get_settings($sets)
	{
		// Converts old serialized array into a json encoded array due to potential exploits in the PHP serialize/unserialize functions.
		$settings_array = array();

		$settings = $this->db->fetch("SELECT settings_version, settings_meta_keywords, settings_meta_description, settings_data FROM %psettings LIMIT 1");
		$sets['meta_keywords'] = $settings['settings_meta_keywords'];
		$sets['meta_description'] = $settings['settings_meta_description'];

		if( $settings['settings_version'] == 1 ) {
			$settings_array = array_merge($sets, unserialize($settings['settings_data']));
			$this->db->query("UPDATE %psettings SET settings_version=2");
			$this->sets = $settings_array;
			$this->write_sets();

			$perms = $this->db->query( 'SELECT group_id, group_perms, group_file_perms FROM %pgroups' );

			// Settings version 1 also means the perm arrays are not updated so they need fixing now too.
			while( ($perm = $this->db->nqfetch($perms)) )
			{
				$forum_array = unserialize( $perm['group_perms'] );
				$file_array = unserialize( $perm['group_file_perms'] );

				$new_forum_array = json_encode( $forum_array );
				$new_file_array = json_encode( $file_array );

				$this->db->query( "UPDATE %pgroups SET group_perms='%s', group_file_perms='%s' WHERE group_id=%d",
					$new_forum_array, $new_file_array, $perm['group_id'] );
			}
		} else {
			$settings_array = array_merge($sets, json_decode($settings['settings_data'], true));
		}
		return $settings_array;
	}

	/* Forum utility functions */

 	/**
	 * Used to update member statistics
	 *
	 * @author Roger Libiez [Samson]
	 * @since 1.5
	 * @return void
	**/
	function ResetMemberStats()
	{
		$member = $this->db->fetch( "SELECT user_id, user_name FROM %pusers ORDER BY user_id DESC LIMIT 1" );
		$counts = $this->db->fetch( "SELECT COUNT(user_id) AS count FROM %pusers" );

		$this->sets['last_member'] = $member['user_name'];
		$this->sets['last_member_id'] = $member['user_id'];
		$this->sets['members'] = $counts['count']-1; // Subtract el guesto

		// Try to fix user post counts.
		$users = $this->db->query( "SELECT user_id, user_posts FROM %pusers" );
		while( ( $user = $this->db->nqfetch( $users ) ) )
		{
			$uid = $user['user_id'];

			$posts = $this->db->fetch( "SELECT COUNT(post_id) count FROM %pposts WHERE post_author=%d AND post_count=1", $uid );
			if( $posts['count'] && $posts['count'] > 0 ) {
				$this->db->query( "UPDATE %pusers SET user_posts=%d WHERE user_id=%d", $posts['count'], $uid );
			} else {
				$this->db->query( "UPDATE %pusers SET user_posts=0 WHERE user_id=%d", $uid );
			}
		}
	}

	/**
	 * Used to update topic and reply counts for every forum.
	 *
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string Completion message
	 **/
	function RecountForums()
	{
		// Recount all topics and posts - NiteShdw
		$q = $this->db->query("SELECT topic_id, COUNT(post_id) AS replies FROM %ptopics, %pposts WHERE post_topic=topic_id GROUP BY topic_id");
		
		while ($f = $this->db->nqfetch($q))
		{
			$treplies = $f['replies'] - 1;
			$this->db->query("UPDATE %ptopics SET topic_replies=%d WHERE topic_id=%d", $treplies, $f['topic_id']);
		}

		$q = $this->db->query("SELECT forum_id FROM %pforums WHERE forum_parent = 0");
		$this->sets['posts'] = 0;
		$this->sets['topics'] = 0;

		while ($f = $this->db->nqfetch($q))
		{
			$results = $this->countTopicsAndReplies($f['forum_id']);

			$this->sets['posts'] += $results['replies'];
			$this->sets['topics'] += $results['topics'];
		}
	}
	
	/**
	 * Used for recursive topic and reply counting
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @param Forum to count
	 * @return Array containing topic Count, reply Count, last post, last post time
	 **/
	function countTopicsAndReplies($forum)
	{
		// Initalise locals
		$topicCount = 0;
		$replyCount = 0;
		$lastPostTime = 0;
		$lastPost = 0;
		
		// Check for subforums
		$q = $this->db->query("SELECT forum_id FROM %pforums WHERE forum_parent=%d", $forum);
		while ($f = $this->db->nqfetch($q))
		{
			$results = $this->countTopicsAndReplies($f['forum_id']);
			$topicCount += $results['topics'];
			$replyCount += $results['replies'];
			if ($results['lastPostTime'] > $lastPostTime) {
				$lastPostTime = $results['lastPostTime'];
				$lastPost = $results['lastPost'];
			}
		}
		
		// Count topics on this forum
		$tc = $this->db->fetch('SELECT COUNT(topic_id) tc FROM %ptopics 
				WHERE NOT(topic_modes & %d) AND topic_forum=%d', TOPIC_MOVED, $forum);
		$rc = $this->db->fetch('SELECT COUNT(p.post_id) rc
				FROM %pposts p, %ptopics t 
				WHERE p.post_topic=t.topic_id AND topic_forum=%d', $forum);
		$lp = $this->db->fetch('SELECT p.post_time pt, p.post_id post
				FROM %pposts p, %ptopics t 
				WHERE p.post_topic=t.topic_id AND topic_forum=%d
				ORDER BY p.post_time DESC LIMIT 1', $forum);
		
		$topicCount += $tc['tc'];
		$replyCount += $rc['rc'];
		if ($lp['pt'] > $lastPostTime) {
			$lastPostTime = $lp['pt'];
			$lastPost = $lp['post'];
		}
		
		// Update the details
		$this->db->query("UPDATE %pforums SET forum_replies=%d,
				forum_topics=%d, forum_lastpost=%d WHERE forum_id=%d",
				$replyCount - $topicCount, $topicCount, $lastPost, $forum);
		
		return array('topics' => $topicCount, 'replies' => $replyCount, 'lastPost' => $lastPost, 'lastPostTime' => $lastPostTime);
	}
	
	/**
	 * Update Forum Trees
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 **/
	function updateForumTrees()
	{
		$forums = array();
		$forumTree = array();
		
		// Build tree structure of 'id' => 'parent' structure
		$q = $this->db->query("SELECT forum_id, forum_parent FROM %pforums ORDER BY forum_parent");
		
		while ($f = $this->db->nqfetch($q))
		{
			if ($f['forum_parent']) {
				$forums[$f['forum_id']] = $f['forum_parent'];
			}
		}
		
		// Run through group
		$q = $this->db->query("SELECT forum_parent FROM %pforums GROUP BY forum_parent");

		while ($f = $this->db->nqfetch($q))
		{
			if ($f['forum_parent']) {
				$tree = $this->buildTree($forums, $f['forum_parent']);
			} else {
				$tree = '';
			}
		
			$this->db->query("UPDATE %pforums SET forum_tree='%s' WHERE forum_parent=%d", $tree, $f['forum_parent']);
		}
	}
	
	function buildTree($forumsArray, $parent)
	{
		$tree = '';
		if (isset($forumsArray[$parent]) && $forumsArray[$parent]) {
			$tree = $this->buildTree($forumsArray, $forumsArray[$parent]);
			$tree .= ',';
		}
		$tree .= $parent;
		return $tree;
	}

	/**
	 * Adds a moderator log entry
	 *
	 * @param string $action The action that was taken
	 * @param int $data1 The data acted upon (post ID, forum ID, etc)
	 * @param int $data2 Additional data, if necessary
	 * @param int $data3 Additional data, if necessary
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.1.0
	 * @return void
	 **/
	function log_action($action, $data1, $data2 = 0, $data3 = 0)
	{
		$this->db->query("INSERT INTO %plogs (log_user, log_time, log_action, log_data1, log_data2, log_data3)
			VALUES (%d, %d, '%s', %d, %d, %d)",
			$this->user['user_id'], $this->time, $action, $data1, $data2, $data3);
	}

	/**
	 * Generates a random security token for forms.
	 *
	 * @author Roger Libiez
	 * @return string Generated security token.
	 * @since 1.1.9
	 */
	function generate_token()
	{
		$token = md5(uniqid(mt_rand(), true));
		$_SESSION['token'] = $token;
		$_SESSION['token_time'] = $this->time + 7200; // Token is valid for 2 hours.

		return $token;
	}

	/**
	 * Checks to be sure a submitted security token matches the one the form is expecting.
	 *
	 * @author Roger Libiez
	 * @return false if invalid, true if valid
	 * @since 1.1.9
	 */
	function is_valid_token()
	{
		if( !isset($_SESSION['token']) || !isset($_SESSION['token_time']) || !isset($this->post['token']) ) {
			return false;
		}

		if( $_SESSION['token'] != $this->post['token'] ) {
			return false;
		}

		$age = $this->time - $_SESSION['token_time'];

		if( $age > 7200 )
			return false;

		return true;
	}

	/**
	 * Reformats a URL so it has no spaces in it.
	 *
	 * @author Roger Libiez
	 * @return string
	 * @since 1.6
	 */
	function clean_url( $link )
	{
		$link = preg_replace( "/[^a-zA-Z0-9\- ]/", "", $link );
		$link = str_replace( ' ', '-', $link );

		return $link;
	}
}
?>