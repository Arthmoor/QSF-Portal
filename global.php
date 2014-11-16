<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005-2006 The Quicksilver Forums Development Team
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

/**
 * The Quicksilver Forums Core
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class qsfglobal
{
	var $name    = 'Quicksilver Forums'; // The name of the software @var string
	var $version = 'v1.3.1';            // Quicksilver Forums' version @var string
	var $server  = array();           // Alias for $_SERVER @var array
	var $get     = array();           // Alias for $_GET @var array
	var $post    = array();           // Alias for $_POST @var array
	var $cookie  = array();           // Alias for $_COOKIE @var array
	var $files   = array();           // Alias for $_FILES @var array
	var $user    = array();           // Information about the user @var array
	var $sets    = array();           // Settings @var array
	var $modules = array();           // Module Settings @var array

	var $nohtml  = false;             // To display no board wrapper @var bool
	var $time;                        // The current Unix time @var int
	var $ip;                          // The user's IP address @var string
	var $agent;                       // The browser's user agent @var string
	var $self;                        // Alias for $PHP_SELF @var string
	var $mainfile = 'index.php';	  // Combined with set['loc_of_board'] to make full url
	var $db;                          // Database object @var object
	var $perms;                       // Permissions object @var object
	var $skin;                        // The user's selected skin @var string
	var $table;                       // Start to an HTML table @var string
	var $etable;                      // End to an HTML table @var string
	var $lang;                        // Loaded words @var object
	var $query;                       // The query string @var string
	var $tz_adjust;                   // Timezone offset in seconds
	var $feed_links = null;		  // HTML of RSS link tags

	var $attachmentutil;		  // Attachment handler @var object
	var $htmlwidgets;		  // HTML widget handler @var object
	var $templater;			  // Template handler @var object
	var $bbcode;			  // BBCode formatter @var object
	var $readmarker;		  // Handles tracking what posts are read and unread
	var $validator;			  // Handler for checking usernames, passwords, etc
	var $activeutil;		  // Handler user activity
	
	var $debug_mode = false;	  // Switch to tell if debugging info is allowed

	/**
	 * Constructor; sets up variables
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 **/
	function qsfglobal($db=null)
	{
		$this->db      = $db;
		$this->time    = time();
		$this->query   = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
		$this->ip      = $_SERVER['REMOTE_ADDR'];
		$this->agent   = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
		$this->agent   = substr($this->agent, 0, 99); // Cut off after 100 characters.
		$this->self    = $_SERVER['PHP_SELF'];
		$this->server  = $_SERVER;
		$this->get     = $_GET;
		$this->post    = $_POST;
		$this->cookie  = $_COOKIE;
		$this->files   = $_FILES;
		$this->query   = htmlspecialchars($this->query);

		// Undo any magic quote slashes!
		if (get_magic_quotes_gpc()) {
			$this->unset_magic_quotes_gpc($this->get);
			$this->unset_magic_quotes_gpc($this->post);
			$this->unset_magic_quotes_gpc($this->cookie);
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
	function init($admin = false)
	{
		if ($this->sets['debug_mode']) {
			$this->debug_mode = true;
		}

		$this->perms = new $this->modules['permissions']($this);
		
		/* set timezone offset */
		if ($this->user['zone_updated'] < $this->time)
		{
			$tz = new $this->modules['timezone']('timezone/'.$this->user['zone_name']);
			$tz->magic2();
			if (strlen($tz->abba)<1) $tz->abba='N/A';
			$this->db->query("UPDATE %ptimezones SET zone_offset=%d, zone_updated=%d, zone_abbrev='%s' WHERE zone_id=%d",
				$tz->gmt_offset, $tz->next_update, $tz->abba, $this->user['zone_id']);
		} else {
			$this->tz_adjust = $this->user['zone_offset'];
		}
		
		$this->attachmentutil = new $this->modules['attach']($this);
		$this->htmlwidgets = new $this->modules['widgets']($this);
		$this->templater = new $this->modules['templater']($this);
		$this->bbcode = new $this->modules['bbcode']($this);
		$this->validator = new $this->modules['validator']();
		$this->readmarker = new $this->modules['readmarker']($this); 
		$this->activeutil = new $this->modules['active']($this);

		$this->templater->init_templates($this->get['a'], $admin);
		
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

		if (strstr($lang, '/') || !file_exists($path . 'languages/' . $lang . '.php')) {
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

			$load = split('load averages?: ', $load);
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
		$count = $this->db->fetch("SELECT COUNT(pm_id) AS messages FROM %ppmsystem WHERE pm_to=%d AND pm_folder=%d" . (!$seen ? " AND pm_read=0" : null),
			$this->user['user_id'], $folder);
		return $count['messages'];
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
		$settings = $this->db->fetch("SELECT settings_data FROM %psettings LIMIT 1");

		return array_merge($sets, unserialize($settings['settings_data']));
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
				if (preg_match("/$ip/", $this->ip)) {
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
	 * @param bool $useToday true if dates should substitute date with 'today' or 'yesterday'
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string Human-readable, formatted Unix timestamp
	 **/
	function mbdate($format, $time = 0, $useToday = true)
	{
		if (!$time) {
			$time = $this->time;
		}

		$time += $this->tz_adjust;

		if (is_int($format)) {
			switch($format)
			{
			case DATE_LONG:
				$date_format = $this->lang->date_long;
				$time_format = $this->lang->time_long;
				break;

			case DATE_SHORT:
				$date_format = $this->lang->date_short;
				$time_format = $this->lang->time_long;
				break;

			case DATE_ONLY_LONG:
				$date_format = $this->lang->date_long;
				$time_format = '';
				break;

			case DATE_TIME:
				$date_format = '';
				$time_format = $this->lang->time_only;
				break;

			case DATE_ISO822: // Standard, no localisation
				$date_format = 'D, j M Y';
				$time_format = ' H:i:s T';
				break;

			default: // DATE_ONLY_SHORT
				$date_format = $this->lang->date_short;
				$time_format = '';
				break;
			}

			if (!$useToday) {
				$date = gmdate($date_format, $time);
			} else if ($date_format) {
				$date = gmdate($date_format, $time);
				$today = gmdate($date_format, $this->time + $this->tz_adjust);
				$yesterday = gmdate($date_format, ($this->time - DAY_IN_SECONDS) + $this->tz_adjust);

				if ($today == $date) {
					$date = $this->lang->today;
				} elseif ($yesterday == $date) {
					$date = $this->lang->yesterday;
				}
			} else {
				$date = '';
			}

			return $date . gmdate($time_format, $time);
		} else {
			return gmdate($format, $time);
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
	 * Sets magic_quotes_gpc to off
	 *
	 * @param array $array Array to stripslashes
	 **/
	function unset_magic_quotes_gpc(&$array)
	{
		$keys = array_keys($array);
		for($i = 0; $i < count($array); $i++)
		{
			if (is_array($array[$keys[$i]])) {
				$this->unset_magic_quotes_gpc($array[$keys[$i]]);
			} else {
				$array[$keys[$i]] = stripslashes($array[$keys[$i]]);
			}
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
	 * Handles debug information when $debug is set in the query string
	 *
	 * @param int $load Server load
	 * @param int $totaltime Time to execute the board
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return void
	 **/
	function show_debug($load, $totaltime)
	{
		include './func/debug.php';

		return $out; // This is set in debug.php
	}

	/**
	 * Adds a link tag for an RSS feed available from the page
	 * Will ignore the request if no feed title is set in settings
	 *
	 * @param string $url Url to access the feed
	 * @param string $subtitle Title to indentify the feed as (optional)
	 * @author Geoffrey Dunn <geoff@warmage.com
	 * @since 1.1.9
	 **/
	function add_feed($url, $subtitle='')
	{
		if ($this->sets['rss_feed_title']) {
			if ($subtitle) {
				$subtitle = ' - ' . $subtitle;
			}
			$this->feed_links .= "<link rel=\"alternate\" title=\"{$this->sets['rss_feed_title']}$subtitle\" href=\"$url\" type=\"application/rss+xml\" />\n";
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
			'installed' => $this->sets['installed']
			);
				
		$file = "<?php\n\$set = array();\n";
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
			'include_path'
		);

		$sets = array();
		foreach ($this->sets as $set => $val)
		{
			if (!in_array($set, $db_settings)) {
				$sets[$set] = $val;
			}
		}

		$this->db->query("UPDATE %psettings SET settings_data='%s'", serialize($sets));
	}
	
	/* Forum utility functions */

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

		$this->write_sets();
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
}

?>
