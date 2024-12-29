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
 * The QSF Portal Core
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class qsfglobal
{
	public $name    = 'QSF Portal';      // The name of the software @public string
	public $version = '2.0';             // QSF Portal version @public float
	public $server  = array();           // Alias for $_SERVER @public array
	public $get     = array();           // Alias for $_GET @public array
	public $post    = array();           // Alias for $_POST @public array
	public $cookie  = array();           // Alias for $_COOKIE @public array
	public $files   = array();           // Alias for $_FILES @public array
	public $user    = array();           // Information about the user @public array
	public $sets    = array();           // Settings @public array
	public $censor  = array();           // Curse words to filter @public array
	public $emojis  = array();           // Array of emojis used for processing post formatting
	public $nohtml  = false;             // To display no board wrapper @public bool
	public $time;                        // The current Unix time @public int
	public $ip;                          // The user's IP address @public string
	public $agent;                       // The browser's user agent @public string
	public $referrer;                    // The browser's referrer setting @public string
	public $self;                        // Alias for $PHP_SELF @public string
	public $site;			                // Root URL for the site @public string
	public $db;                          // Database object @public object
	public $perms;                       // Permissions object @public object
	public $file_perms;		             // File permissions object @public object
	public $skin;                        // The user's selected skin @public string
	public $lang;                        // Loaded words @public object
	public $query;                       // The query string @public string
	public $time_exec;                   // Execution time for the whole page
	public $feed_links = null;	          // HTML of RSS link tags
   public $title;                       // Page Title for Modules

   public $pre;
   public $user_cl;

	public $attachmentutil;   // Attachment handler @public object
	public $htmlwidgets;		  // HTML widget handler @public object
	public $bbcode;			  // BBCode formatter @public object
	public $readmarker;		  // Handles tracking what posts are read and unread
   public $conv_readmarker;  // Handles tracking which private conversatons have been read
	public $validator;		  // Handler for checking usernames, passwords, etc
	public $activeutil;		  // Handler user activity

	public $xtpl = null;		  // Global zTemplate instance

	/**
	 * Constructor; sets up variables
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 **/
	public function __construct( $db = null )
	{
		$this->db       = $db;
		$this->time     = time();
		$this->query    = isset( $_SERVER['QUERY_STRING'] ) ? $_SERVER['QUERY_STRING'] : null;
		$this->ip       = isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
		$this->agent    = isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : "N/A";
		$this->agent    = substr( $this->agent, 0, 254 ); // Cut off after 255 characters.
		$this->referrer = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : 'N/A';
		$this->referrer = substr( $this->referrer, 0, 254 ); // Cut off after 255 characters.
		$this->self     = $_SERVER['PHP_SELF'];
		$this->server   = $_SERVER;
		$this->get      = $_GET;
		$this->post     = $_POST;
		$this->cookie   = $_COOKIE;
		$this->files    = $_FILES;
		$this->query    = htmlspecialchars( $this->query );
      $this->title    = '';
	}

	/**
	 * Post constructor initaliser. By this time we have a user and a database
	 *
	 * Note: This is never run for special tools such as installs or upgrades
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 **/
	public function init( $admin = false )
	{
		$this->perms = new permissions( $this );
		$this->file_perms = new file_permissions( $this );
		$this->attachmentutil = new attachutil( $this );
		$this->htmlwidgets = new htmlwidgets( $this );
		$this->bbcode = new bbcode( $this );
		$this->validator = new tool();
		$this->readmarker = new readmarker( $this );
      $this->conv_readmarker = new conv_readmarker( $this );
		$this->activeutil = new activeutil( $this );

		$replace = $this->db->query( 'SELECT * FROM %preplacements ORDER BY LENGTH(replacement_search) DESC' );

		while( $r = $this->db->nqfetch( $replace ) )
		{
			$this->censor[] = '/' . $r['replacement_search'] . '/i';
		}

		$emojis = $this->db->query( 'SELECT * FROM %pemojis' );
		while( $e = $this->db->nqfetch( $emojis ) )
		{
			if( $e['emoji_clickable'] == 1 )
				$this->emojis['click_replacement'][$e['emoji_string']] = '<img src="' . $this->site . '/emojis/' . $e['emoji_image'] . '" alt="' . $e['emoji_string'] . '">';
			else
				$this->emojis['replacement'][$e['emoji_string']] = '<img src="' . $this->site . '/emojis/' . $e['emoji_image'] . '" alt="' . $e['emoji_string'] . '">';
		}
	}

	/**
	 * Run actions that can be delayed until after output is sent
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2.0
	 **/
	public function cleanup()
	{
		// Handle active users
		if( $this->perms->is_guest ) {
			$this->activeutil->update( $this->get['a'] );
		} else {
			$this->activeutil->update( $this->get['a'], $this->user['user_id'] );
		}

		$this->readmarker->cleanup();
      $this->conv_readmarker->cleanup();
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
	public function chmod( $path, $mode, $recursive = false )
	{
		if( !$recursive || !is_dir( $path ) ) {
			@chmod( $path, $mode );
			return;
		}

		$dir = opendir( $path );
		while( ( $file = readdir( $dir ) ) !== false )
		{
			if( ( $file == '.' ) || ( $file == '..' ) ) {
				continue;
			}

			$fullpath = $path . '/' . $file;
			if( !is_dir( $fullpath ) ) {
				@chmod( $fullpath, $mode );
			} else {
				$this->chmod( $fullpath, $mode, true );
			}
		}

		closedir( $dir );
		@chmod( $path, $mode );
	}

	/**
	 * Formats a string (interface to bbcode object)
	 *
	 * @param string $in Input
	 * @param int $options Options
	 * @return string Formatted string
	 **/
	public function format( $in, $options = FORMAT_BBCODE )
	{
		return $this->bbcode->format( $in, $options );
	}

	/**
	 * Adds an entry to the navigation tree (interface to html widgets)
	 *
	 * @param string $label Label for the tree entry
	 * @param string $link URL to link to
	 **/
	public function tree( $label, $link = null )
	{
		$this->htmlwidgets->tree( $label, $link );
	}

	/**
	 * Hash a given string into a password suitable for database use
	 *
	 * @param string $pass The supplied password to hash
	 * @author Roger Libiez
	 * @since 2.0
	 */
	public function qsfp_password_hash( $pass )
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
	public function generate_pass( $length )
	{
		$vowels = array( 'a', 'e', 'i', 'o', 'u' );
		$cons = array( 'b', 'c', 'd', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'r', 's', 't', 'u', 'v', 'w', 'tr',
		'cr', 'br', 'fr', 'th', 'dr', 'ch', 'ph', 'wr', 'st', 'sp', 'sw', 'pr', 'sl', 'cl' );

		$num_vowels = count( $vowels );
		$num_cons = count( $cons );

		$password = '';

		for( $i = 0; $i < $length; $i++ )
		{
			$password .= $cons[rand(0, $num_cons - 1)] . $vowels[rand(0, $num_vowels - 1)];
		}

		return substr( $password, 0, $length );
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
	public function get_lang( $lang, $a = null, $path = './', $main = true )
	{
		if( isset( $this->get['lang'] ) ) {
			$lang = $this->get['lang'];
		}

		if( strstr( $lang, '/' ) || strstr( $lang, '\\' ) || !file_exists( $path . 'languages/' . $lang . '.php' ) ) {
			$lang = 'en';
		}

		include $path . 'languages/' . $lang . '.php';
		$obj = new $lang();

		// Check if language function is available before running it
		if( $a && is_callable( array( $obj, $a ) ) ) {
			$obj->$a();
		}

		if( $main ) {
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
	 * @return array Array of information about the member:<br><i>string user_title</i> - default member title for that post count<br><i>int user_level</i> - default member level for that post count
	 **/
	public function get_level( $posts )
	{
		$memtitle = array(
			'user_title' => '',
			'user_level' => '0'
		);

		$stmt = $this->db->prepare_query( 'SELECT * FROM %pmembertitles WHERE membertitle_posts <= ? ORDER BY membertitle_posts' );

      $stmt->bind_param( 'i', $posts );
      $this->db->execute_query( $stmt );

      $titles = $stmt->get_result();
      $stmt->close();

		while( $title = $this->db->nqfetch( $titles ) )
		{
			if( $posts >= $title['membertitle_posts'] ) {
				$memtitle['user_title'] = $title['membertitle_title'];
				$memtitle['user_level'] = $title['membertitle_id'];
			} else {
				break;
			}
		}

		return $memtitle;
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
	public function get_messages( $seen = false, $folder = 0 )
	{
		if( $this->perms->is_guest )
			return 0;

		$stmt = $this->db->prepare_query( 'SELECT COUNT(pm_id) AS messages FROM %ppmsystem WHERE pm_to=? AND pm_folder=?' . ( !$seen ? ' AND pm_read=0' : null ) );

      $stmt->bind_param( 'ii', $this->user['user_id'], $folder );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $count = $this->db->nqfetch( $result );
      $stmt->close();

		return $count['messages'];
	}

	public function get_files()
	{
		$count = 0;

		if( $this->perms->is_guest )
			return 0;

		if( $this->perms->auth( 'is_admin' ) )
			return $this->sets['code_approval'];

		$query = $this->db->query( 'SELECT file_catid FROM %pfiles WHERE file_approved=0' );
		while( $file = $this->db->nqfetch( $query ) )
		{
			if( !$this->file_perms->auth( 'approve_files', $file['file_catid'] ) )
				continue;
			$count++;
		}
		return $count;
	}

	private function cidrmatch( $cidr )
	{
		$ip = decbin( ip2long( $this->ip ) );
		list( $cidr1, $cidr2, $cidr3, $cidr4, $bits ) = sscanf( $cidr, '%d.%d.%d.%d/%d' );
		$cidr = decbin( ip2long( "$cidr1.$cidr2.$cidr3.$cidr4" ) );
		for( $i = strlen( $ip ); $i < 32; $i++ )
			$ip = "0$ip";
		for( $i = strlen( $cidr ); $i < 32; $i++ )
			$cidr = "0$cidr";
		return !strcmp( substr( $ip, 0, $bits ), substr( $cidr, 0, $bits ) );
	}

	private function is_ipv6( $ip )
	{
		return( substr_count( $ip, ":" ) > 0 && substr_count( $ip, "." ) == 0 );
	}

	/**
	 * Determines if a user has been banned
	 *
	 * @return bool True if the user is banned, false if the user is not
	 **/
	public function is_banned()
	{
		// Ban by user group
		if( !$this->perms->auth( 'do_anything' ) ) {
			return true;
		}

		// Ban by IP
		if( $this->sets['banned_ips'] ) {
			foreach( $this->sets['banned_ips'] as $ip )
			{
				$ip = stripslashes( $ip );

				if( $this->is_ipv6( $this->ip ) ) {
					if( strcasecmp( $ip, $this->ip ) == 0 )
						return true;
				}

				if( ( strstr( $ip, '/' ) && $this->cidrmatch( $ip ) ) || strcasecmp( $ip, $this->ip ) == 0 ) {
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
	public function mbdate( $format, $time = 0, $useToday = true )
	{
		if( !$time ) {
			$time = $this->time;
		}

		$timezone = $this->user['user_timezone'];
		if( $this->user['user_id'] == USER_GUEST_UID )
			$timezone = $this->sets['servertime'];

		$dt = new DateTime();

      try {
         $dt->setTimezone( new DateTimeZone( $timezone ) );
      }
      catch( Exception $e ) {
         error( QUICKSILVER_PHP_ERROR, $e->getMessage(), __FILE__, __LINE__ );
      }

		$dt->setTimestamp( $time );

		if( is_int( $format ) ) {
			switch( $format )
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
	public function message( $title, $message, $link_text = null, $link = null, $redirect = null, $delay = 4 )
	{
		if( $link_text ) {
			$message .= '<br><br><a href="' . $link . '">' . $link_text . '</a>';
		}

		if( $redirect ) {
			@header( 'Refresh: '.$delay.';url=' . $redirect );
		}

		$this->xtpl->assign( 'title', $title );
		$this->xtpl->assign( 'message', $message );

		$this->xtpl->parse( 'Index.Message' );
	}

	/**
	 * Sets the title of the page
	 *
	 * @param string $title The title
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return void
	 **/
	public function set_title( $title )
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
	public function add_feed( $url, $subtitle = '' )
	{
		if( $this->sets['rss_feed_title'] ) {
			if( $subtitle ) {
				$subtitle = ' - ' . $subtitle;
			}

			$title = htmlspecialchars( $this->sets['rss_feed_title'] );
			$subtitle = htmlspecialchars( $subtitle );
			$this->feed_links .= "<link rel=\"alternate\" title=\"$title$subtitle\" href=\"$url\" type=\"application/rss+xml\">\n";
		}
	}

	/**
	 * Saves all data in the $this->sets array to the database
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return void
	 **/
	public function write_sets()
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
			'mobile_icons',
			'settings_version',
			'settings_tos',
			'settings_tos_files'
		);

		$sets = array();
		foreach( $this->sets as $set => $val )
		{
			if( !in_array( $set, $db_settings ) ) {
				$sets[$set] = $val;
			}
		}

		$stmt = $this->db->prepare_query( 'UPDATE %psettings SET settings_data=?' );

      $data = json_encode( $sets );
      $stmt->bind_param( 's', $data );
      $this->db->execute_query( $stmt );
      $stmt->close();
	}

	/**
	 * Loads settings
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.1.0
	 * @return array Settings
	 **/
	public function get_settings( $sets )
	{
		// Converts old serialized array into a json encoded array due to potential exploits in the PHP serialize/unserialize functions.
		$settings_array = array();

		$settings = $this->db->fetch( 'SELECT settings_version, settings_meta_keywords, settings_meta_description, settings_mobile_icons, settings_data FROM %psettings LIMIT 1' );
		$sets['meta_keywords'] = $settings['settings_meta_keywords'];
		$sets['meta_description'] = $settings['settings_meta_description'];
		$sets['mobile_icons'] = $settings['settings_mobile_icons'];

		if( $settings['settings_version'] == 1 ) {
			$settings_array = array_merge( $sets, unserialize( $settings['settings_data'] ) );
			$this->db->query( 'UPDATE %psettings SET settings_version=2' );
			$this->sets = $settings_array;
			$this->write_sets();

			$perms = $this->db->query( 'SELECT group_id, group_perms, group_file_perms FROM %pgroups' );

			// Settings version 1 also means the perm arrays are not updated so they need fixing now too.
         $perms_query = $this->db->prepare_query( 'UPDATE %pgroups SET group_perms=?, group_file_perms=? WHERE group_id=?' );
         $perms_query->bind_param( 'ssi', $new_forum_array, $new_file_array, $group_id );

			while( ( $perm = $this->db->nqfetch( $perms ) ) )
			{
				$forum_array = unserialize( $perm['group_perms'] );
				$file_array = unserialize( $perm['group_file_perms'] );

				$new_forum_array = json_encode( $forum_array );
				$new_file_array = json_encode( $file_array );
            $group_id = $perm['group_id'];

            $this->db->execute_query( $perms_query );
			}
         $perms_query->close();
		} else {
			$settings_array = array_merge( $sets, json_decode( $settings['settings_data'], true ) );
		}
		return $settings_array;
	}

	/* Forum utility functions */

	/**
	 * Used to update topic and reply counts for every forum.
	 *
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string Completion message
	 **/
	public function RecountForums()
	{
		// Recount all topics and posts - NiteShdw
		$q = $this->db->query( 'SELECT topic_id, COUNT(post_id) AS replies FROM %ptopics, %pposts WHERE post_topic=topic_id GROUP BY topic_id' );

      $topic_query = $this->db->prepare_query( 'UPDATE %ptopics SET topic_replies=? WHERE topic_id=?' );
      $topic_query->bind_param( 'ii', $treplies, $topic_id );

		while( $f = $this->db->nqfetch( $q ) )
		{
			$treplies = $f['replies'] - 1;
         $topic_id = $f['topic_id'];

         $this->db->execute_query( $topic_query );
		}
      $topic_query->close();

		$q = $this->db->query( 'SELECT forum_id FROM %pforums WHERE forum_parent = 0' );
		$this->sets['posts'] = 0;
		$this->sets['topics'] = 0;

		while( $f = $this->db->nqfetch( $q ) )
		{
			$results = $this->countTopicsAndReplies( $f['forum_id'] );

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
	public function countTopicsAndReplies( $forum )
	{
		// Initalise locals
		$topicCount = 0;
		$replyCount = 0;
		$lastPostTime = 0;
		$lastPost = 0;

		// Check for subforums
		$stmt = $this->db->prepare_query( 'SELECT forum_id FROM %pforums WHERE forum_parent=?' );

      $stmt->bind_param( 'i', $forum );
      $this->db->execute_query( $stmt );

      $q = $stmt->get_result();
      $stmt->close();

		while( $f = $this->db->nqfetch( $q ) )
		{
			$results = $this->countTopicsAndReplies( $f['forum_id'] );
			$topicCount += $results['topics'];
			$replyCount += $results['replies'];
			if( $results['lastPostTime'] > $lastPostTime ) {
				$lastPostTime = $results['lastPostTime'];
				$lastPost = $results['lastPost'];
			}
		}

		// Count topics on this forum
		$stmt = $this->db->prepare_query( 'SELECT COUNT(topic_id) tc FROM %ptopics WHERE NOT(topic_modes & ?) AND topic_forum=?' );

      $tflag = intval( TOPIC_MOVED );
      $stmt->bind_param( 'ii', $tflag, $forum );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $tc = $this->db->nqfetch( $result );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'SELECT COUNT(p.post_id) rc FROM %pposts p, %ptopics t WHERE p.post_topic=t.topic_id AND topic_forum=?' );

      $stmt->bind_param( 'i', $forum );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $rc = $this->db->nqfetch( $result );
      $stmt->close();

		$stmt = $this->db->prepare_query( 'SELECT p.post_time pt, p.post_id post FROM %pposts p, %ptopics t WHERE p.post_topic=t.topic_id AND topic_forum=? ORDER BY p.post_time DESC LIMIT 1' );

      $stmt->bind_param( 'i', $forum );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $lp = $this->db->nqfetch( $result );
      $stmt->close();

		$topicCount += $tc['tc'];
		$replyCount += $rc['rc'];
		if( isset( $lp['pt'] ) && $lp['pt'] > $lastPostTime ) {
			$lastPostTime = $lp['pt'];
			$lastPost = $lp['post'];
		}

		// Update the details
		$stmt = $this->db->prepare_query( 'UPDATE %pforums SET forum_replies=?, forum_topics=?, forum_lastpost=? WHERE forum_id=?' );

      $count = $replyCount - $topicCount;
      $stmt->bind_param( 'iiii', $count, $topicCount, $lastPost, $forum );
      $this->db->execute_query( $stmt );
      $stmt->close();

		return array( 'topics' => $topicCount, 'replies' => $replyCount, 'lastPost' => $lastPost, 'lastPostTime' => $lastPostTime );
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
	public function log_action( $action, $data1, $data2 = 0, $data3 = 0 )
	{
		$stmt = $this->db->prepare_query( 'INSERT INTO %plogs (log_user, log_time, log_action, log_data1, log_data2, log_data3 ) VALUES( ?, ?, ?, ?, ?, ? )' );

      $stmt->bind_param( 'iisiii', $this->user['user_id'], $this->time, $action, $data1, $data2, $data3 );
      $this->db->execute_query( $stmt );
      $stmt->close();
	}

	/**
	 * Generates a random security token for forms.
	 *
	 * @author Roger Libiez
	 * @return string Generated security token.
	 * @since 1.1.9
	 */
	public function generate_token()
	{
		$token = bin2hex( random_bytes( 32 ) );

		$_SESSION['token'] = $token;
		$_SESSION['token_time'] = $this->time + 3600; // Token is valid for 1 hour.

		return $token;
	}

	/**
	 * Checks to be sure a submitted security token matches the one the form is expecting.
	 *
	 * @author Roger Libiez
	 * @return false if invalid, true if valid
	 * @since 1.1.9
	 */
	public function is_valid_token()
	{
		if( !isset( $_SESSION['token'] ) || !isset( $_SESSION['token_time'] ) || !isset( $this->post['token'] ) ) {
			return false;
		}

		if( !hash_equals( $_SESSION['token'], $this->post['token'] ) ) {
			return false;
		}

		$age = $this->time - $_SESSION['token_time'];

		if( $age > 3600 ) // Token is valid for 1 hour.
			return false;

		return true;
	}

	public function get_uri()
	{
		if( !isset( $this->server['REQUEST_URI'] ) ) {
			return $this->self;
		}

		$url = @parse_url( $this->server['REQUEST_URI'] );
		if( $url === false ) {
			return $this->self;
		}

		if( $this->query && strpos( 'http://', $this->query ) !== false ) {
			error( QUICKSILVER_NOTICE, 'BAD BOT! You should know better than that!' );
		}

		if( !isset( $url['path'] ) ) {
			return $this->self;
		}

		if( !empty( $url['query'] ) && !stristr( $url['query'], 'login' ) ) {
			return $this->format( $url['path'] . ( !empty( $url['query'] ) ? '?' . $url['query'] : null ), FORMAT_HTMLCHARS );
		} else {
			return $this->self;
		}
	}
}
?>