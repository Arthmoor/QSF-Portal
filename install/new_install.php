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

if( !defined( 'QUICKSILVERFORUMS' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

require_once $set['include_path'] . '/global.php';

/**
 * New Board Installation
 *
 * @author Jason Warner <jason@mercuryboard.com>
 */
class new_install extends qsfglobal
{
	/**
	 * Creates the contents of a settings file
	 *
	 * @since 1.3.0
	 * @return string Contents for settings file
	 **/
	private function create_settings_file()
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

		$file = "<?php\n\$set = array();\n\nif( !defined( 'QUICKSILVERFORUMS' ) ) {\n       header( 'HTTP/1.0 403 Forbidden' );\n       die;\n}\n\n";

		foreach( $settings as $set => $val )
		{
			$file .= "\$set['$set'] = '" . str_replace( array( '\\', '\'' ), array( '\\\\', '\\\'' ), $val ) . "';\n";
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
	private function write_db_sets( $sfile = '../settings.php' )
	{
		$settings = $this->create_settings_file();

		$this->chmod( $sfile, 0666 );
		$fp = @fopen( $sfile, 'w' );

		if( !$fp ) {
			return false;
		}

		if( !@fwrite( $fp, $settings ) ) {
			return false;
		}

		fclose( $fp );

		return true;
	}

	private function server_url()
	{
		$proto = "http" . ( ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == "on" ) ? "s" : "" ) . "://";
		$server = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];

		return $proto . $server;
	}

	/**
	 * Creates a category or forum
	 *
	 * @param string $name Name of the forum
	 * @param string $desc Description of the forum
	 * @param int $parent Parent id of the forum (0 if a category)
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.9
	 * @return int id of the forum created
	 **/
	private function create_forum( $name, $desc, $parent )
	{
		$parent ? $tree = $parent : $tree = '';

		$this->db->query( "INSERT INTO %pforums
			(forum_tree, forum_parent, forum_name, forum_description, forum_position, forum_subcat) VALUES
			('%s', %d, '%s', '%s', '0', '0')",
			$tree, $parent, $name, $desc );

		$forumId = $this->db->insert_id( "forums" );

		$perms = new permissions( $this );

		while( $perms->get_group() )
		{
			if( !$parent ) {
				// Default permissions
				$perms->add_z( $forumId );
			} else {
				// Copy permissions
				$perms->add_z( $forumId, false );

				foreach( $perms->standard as $perm => $false )
				{
					if( !isset( $perms->globals[$perm] ) ) {
						$perms->set_xyz( $perm, $forumId, $perms->auth( $perm, $parent ) );
					}
				}
			}
			$perms->update();
		}
		return $forumId;
	}

	public function install_board( $step )
	{
		switch( $step ) {
		default:
			$timezones = $this->htmlwidgets->select_timezones( 'Europe/London' );

			$url = preg_replace( '/install\/?$/i', '', $this->server_url() . dirname( $_SERVER['PHP_SELF'] ) );

echo "<form action='{$this->self}?mode=new_install&amp;step=2' method='post'>
 <div class='article'>
  <div class='title' style='text-align:center'>New {$this->name} Installation</div>
  <div class='title'>Directory Permissions</div>";

			check_writeable_files();
			if( !is_writeable( '../settings.php' ) ) {
				echo "<br /><br />Settings file cannot be written to. The installer cannot continue until this problem is corrected.</div>";
				break;
			}

echo "    <p></p>
  <div class='title' style='text-align:center'>New Database Configuration</div>

  <span class='field'>Host Server:</span>
  <span class='form'><input class='input' type='text' name='db_host' value='{$this->sets['db_host']}' /></span>
  <p class='line'></p>

  <span class='field'>Database Type:</span>
  <span class='form'>MySQLi</span>
  <p class='line'></p>

  <span class='field'>Database Name:</span>
  <span class='form'><input class='input' type='text' name='db_name' value='{$this->sets['db_name']}' /></span>
  <p class='line'></p>

  <span class='field'>Database Username:</span>
  <span class='form'><input class='input' type='text' name='db_user' value='{$this->sets['db_user']}' /></span>
  <p class='line'></p>

  <span class='field'>Database Password:</span>
  <span class='form'><input class='input' type='password' name='db_pass' value='' /></span>
  <p class='line'></p>

  <span class='field'>Table Prefix:</span>
  <span class='form'>
   <input class='input' type='text' name='prefix' value='{$this->sets['prefix']}' /> This should only be changed if you need to install multiple QSFP sites in the same database.
  </span>
  <p class='line'></p>

  <span class='field'>Database Port:</span>
  <span class='form'><input class='input' type='text' name='db_port' value='{$this->sets['db_port']}' /> Blank for none</span>
  <p class='line'></p>

  <span class='field'>Database Socket:</span>
  <span class='form'><input class='input' type='text' name='db_socket' value='{$this->sets['db_socket']}' /> Blank for none</span>
  <p></p>

  <div class='title' style='text-align:center'>New Site Settings</div>

  <span class='field'>Site Name:</span>
  <span class='form'><input class='input' type='text' name='site_name' value='{$this->name}' size='75' /></span>
  <p class='line'></p>

  <span class='field'>Site URL:</span>
  <span class='form'><input class='input' type='text' name='site_url' value='{$url}' size='75' /></span>
  <p></p>

  <span class='field'>Server Timezone:</span>
  <span class='form'><select class='select' name='timezone'>{$timezones}</select></span>
  <p></p>

  <div class='title' style='text-align:center'>Administrator Account Settings</div>

  <span class='field'>User Name:</span>
  <span class='form'><input class='input' type='text' name='admin_name' size='30' maxlength='30' /></span>
  <p class='line'></p>

  <span class='field'>User Password:</span>
  <span class='form'><input class='input' type='password' name='admin_pass' size='30' /></span>
  <p class='line'></p>

  <span class='field'>Password (confirmation):</span>
  <span class='form'><input class='input' type='password' name='admin_pass2' size='30' /></span>
  <p class='line'></p>

  <span class='field'>User Timezone:</span>
  <span class='form'><select class='select' name='user_timezone'>{$timezones}</select></span>
  <p class='line'></p>

  <span class='field'>Contact Email:</span>
  <span class='form'>
   <input class='input' type='text' name='admin_email' size='50' maxlength='100' value='{$this->sets['admin_email']}' />
   This is where messages from the system will be sent. Needs to be a real address.
  </span>
  <p class='line'></p>

  <span class='field'>System Email:</span>
  <span class='form'>
   <input class='input' type='text' name='contact_email' size='50' maxlength='100' />
   Address the system sends mail as. Can be either real or fake.
  </span>
  <p class='line'></p>

  <div style='text-align:center'>
   <input type='hidden' name='db_type' value='mysqli' />
   <input type='submit' name='submit' value='Continue' />
  </div>
 </div>
</form>";
break;

		case 2:
  echo "<div class='article'>
  <div class='title'>New {$this->name} Installation</div>";

			$dbt = 'db_' . $this->post['db_type'];

			$db = new $dbt( $this->post['db_host'], $this->post['db_user'], $this->post['db_pass'], $this->post['db_name'], $this->post['db_port'], $this->post['db_socket'], $this->post['prefix'] );

			if( !$db->connection ) {
				echo "Couldn't connect to a database using the specified information.";
				break;
			}
			$this->db = &$db;

			$this->sets['db_host']   = $this->post['db_host'];
			$this->sets['db_user']   = $this->post['db_user'];
			$this->sets['db_pass']   = $this->post['db_pass'];
			$this->sets['db_name']   = $this->post['db_name'];
			$this->sets['db_port']   = $this->post['db_port'];
			$this->sets['db_socket'] = $this->post['db_socket'];
			$this->sets['dbtype']    = $this->post['db_type'];
			$this->sets['prefix']    = trim( preg_replace( '/[^a-zA-Z0-9_]/', '', $this->post['prefix'] ) );

			if( !$this->write_db_sets( '../settings.php' ) && !isset( $this->post['downloadsettings'] ) ) {
				echo "The database connection was ok, but settings.php could not be updated.<br />\n";
				echo "You can CHMOD settings.php to 0666 and hit reload to try again<br/>\n";
				echo "Or you can force the install to continue and download the new settings.php file ";
				echo "so you can later place it on the website manually<br/>\n";
				echo "<form action=\"{$this->self}?mode=new_install&amp;step=2\" method=\"post\">\n
					<input type=\"hidden\" name=\"downloadsettings\" value=\"yes\" />\n
					<input type=\"hidden\" name=\"db_host\" value=\"" . htmlspecialchars($this->post['db_host']) . "\" />\n
					<input type=\"hidden\" name=\"db_name\" value=\"" . htmlspecialchars($this->post['db_name']) . "\" />\n
					<input type=\"hidden\" name=\"db_user\" value=\"" . htmlspecialchars($this->post['db_user']) . "\" />\n
					<input type=\"hidden\" name=\"db_pass\" value=\"" . htmlspecialchars($this->post['db_pass']) . "\" />\n
					<input type=\"hidden\" name=\"db_port\" value=\"" . htmlspecialchars($this->post['db_port']) . "\" />\n
					<input type=\"hidden\" name=\"db_socket\" value=\"" . htmlspecialchars($this->post['db_socket']) . "\" />\n
					<input type=\"hidden\" name=\"prefix\" value=\"" . htmlspecialchars($this->post['prefix']) . "\" />\n
					<input type=\"hidden\" name=\"dbtype\" value=\"" . htmlspecialchars($this->post['db_type']) . "\" />\n
					<input type=\"hidden\" name=\"site_name\" value=\"" . htmlspecialchars($this->post['site_name']) . "\" />\n
					<input type=\"hidden\" name=\"site_url\" value=\"" . htmlspecialchars($this->post['site_url']) . "\" />\n
					<input type=\"hidden\" name=\"admin_name\" value=\"" . htmlspecialchars($this->post['admin_name']) . "\" />\n
					<input type=\"hidden\" name=\"admin_pass\" value=\"" . htmlspecialchars($this->post['admin_pass']) . "\" />\n
					<input type=\"hidden\" name=\"admin_pass2\" value=\"" . htmlspecialchars($this->post['admin_pass2']) . "\" />\n
					<input type=\"hidden\" name=\"admin_email\" value=\"" . htmlspecialchars($this->post['admin_email']) . "\" />\n
					";
				echo "<input type=\"submit\" value=\"Force Install\" />
					</form>
					 ";
				break;
			}

			if( !is_readable( './' . $this->sets['dbtype'] . '_data_tables.php' ) ) {
				echo 'Database connected, settings written, but no tables could be loaded from file: ./' . $this->sets['dbtype'] . '_data_tables.php';
				break;
			}

			if( ( trim( $this->post['admin_name'] ) == '' )
			|| ( trim( $this->post['admin_pass'] ) == '' )
			|| ( trim( $this->post['admin_email'] ) == '' ) ) {
				echo 'You have not specified an admistrator account. Please go back and correct this error.';
				break;
			}

			if( $this->post['admin_pass'] != $this->post['admin_pass2'] ) {
				echo 'Your administrator passwords do not match. Please go back and correct this error.';
				break;
			}

			$queries = array();
			$pre = $this->sets['prefix'];
			$this->pre = $this->sets['prefix'];

			// Create tables
			include './' . $this->sets['dbtype'] . '_data_tables.php';

			execute_queries( $queries, $db );
			$queries = null;
			
			$this->sets = $this->get_settings( $this->sets );
			$this->sets['loc_of_board'] = $this->post['site_url'];
			$this->sets['forum_name'] = $this->post['site_name'];

			$admin_pass = $this->qsfp_password_hash( $this->post['admin_pass'] );

			$this->post['admin_name'] = str_replace(
				array( '&amp;#', '\'' ),
				array( '&#', '&#39;' ),
				htmlspecialchars( $this->post['admin_name'] )
			);

			$this->sets['spam_post_count'] = 0;
			$this->sets['spam_email_count'] = 0;
			$this->sets['spam_reg_count'] = 0;
			$this->sets['spam_sig_count'] = 0;
			$this->sets['spam_profile_count'] = 0;
			$this->sets['ham_count'] = 0;
			$this->sets['spam_false_count'] = 0;
			$this->sets['spam_pending'] = 0;
			$this->sets['wordpress_api_key'] = '';
			$this->sets['akismet_email'] = 0;
			$this->sets['akismet_ureg'] = 0;
			$this->sets['akismet_sigs'] = 0;
			$this->sets['akismet_posts'] = 0;
			$this->sets['akismet_posts_number'] = 5;
			$this->sets['akismet_profiles'] = 0;

			$this->sets['attach_types'] = array( 'jpg', 'gif', 'png', 'bmp', 'zip', 'tgz', 'gz', 'rar', '7z' );
			$this->sets['attach_upload_size'] = 51200;
			$this->sets['avatar_height'] = 100;
			$this->sets['avatar_upload_size'] = 51200;
			$this->sets['avatar_width'] = 100;
			$this->sets['banned_ips'] = array();
			$this->sets['edit_post_age'] = 0;
			$this->sets['closed'] = 0;
			$this->sets['closedtext'] = 'This site is currently down for maintenance. Please check back later.';

			$server = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
			$this->sets['cookie_domain'] = $server;

			$path = dirname( $_SERVER['PHP_SELF'] );
			$path = str_replace( 'install', '', $path );
			$this->sets['cookie_path'] = $path;

			$this->sets['cookie_prefix'] = 'qsfp_';
			$this->sets['cookie_secure'] = 0;

			$this->sets['emailactivation'] = 1;
			$this->sets['flood_time'] = 30;
			$this->sets['hot_limit'] = 20;
			$this->sets['logintime'] = 31536000;
			$this->sets['mailserver'] = 'localhost';
			$this->sets['analytics_code'] = '';
			$this->sets['mostonline'] = 0;
			$this->sets['mostonlinetime'] = 0;
			$this->sets['posts'] = 0;
			$this->sets['posts_per_page'] = 15;
			$this->sets['register_image'] = 0;
			$this->sets['servertime'] = $this->post['timezone'];
			$this->sets['topics'] = 0;
			$this->sets['topics_per_page'] = 20;
			$this->sets['vote_after_results'] = 0;
			$this->sets['default_skin'] = 1;
			$this->sets['default_email_shown'] = 0;
			$this->sets['default_lang'] = 'en';
			$this->sets['default_group'] = 2;
			$this->sets['default_timezone'] = 'Europe/London';
			$this->sets['default_pm'] = 1;
			$this->sets['default_view_avatars'] = 1;
			$this->sets['default_view_sigs'] = 1;
			$this->sets['default_view_emots'] = 1;
			$this->sets['flood_time_pm'] = 30;
			$this->sets['flood_time_search'] = 10;
			$this->sets['spider_active'] = 1;
			$this->sets['spider_name'] = array(
				'googlebot' 	=> 'Google',
				'yahoo'		=> 'Yahoo!',
				'bingbot'	=> 'Bing'
			);
			$this->sets['file_count'] = 0;
			$this->sets['file_approval'] = 0;
			$this->sets['code_approval'] = 0;
			$this->sets['rss_feed_title'] = '';
			$this->sets['rss_feed_desc'] = '';
			$this->sets['rss_feed_posts'] = 5;
			$this->sets['rss_feed_time'] = 60;
			$this->sets['registrations_allowed'] = 1;
			$this->sets['left_sidebar_links'] = array();
			$this->sets['right_sidebar_links'] = array();


			$this->db->query( "INSERT INTO %pusers (user_name, user_password, user_group, user_title, user_title_custom, user_joined, user_email, user_timezone, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height, user_signature)
				VALUES ('%s', '%s', %d, 'Administrator', 1, %d, '%s', '%s', '%s', '%s', %d, %d, '%s')",
				$this->post['admin_name'], $admin_pass, USER_ADMIN, $this->time, $this->post['admin_email'], $this->post['user_timezone'], './avatars/avatar.jpg', 'local', 100, 100, '' );
			$admin_uid = $this->db->insert_id( "users" );

			$this->sets['last_member'] = $this->post['admin_name'];
			$this->sets['last_member_id'] = $admin_uid;
			$this->sets['admin_incoming'] = $this->post['admin_email'];
			$this->sets['admin_outgoing'] = $this->post['contact_email'];
			$this->sets['admin_email'] = $this->post['admin_email'];
			$this->sets['members'] = 1;
			$this->sets['installed'] = 1;
			$this->sets['app_version'] = $this->version;

			$topicName = "Welcome to {$this->name}";
			$topicDesc = '';
			$topicIcon = 'exclaim.gif';
			$topicPost = "Congratulations on your successful install of {$this->name} {$this->version}. A couple of places you should visit now that things are up and running:

[b]Admin CP[/b]
In the Admin CP, you can configure the details of your site from the Board Settings menu. Then from there you can start creating more forums for your site.
 
[b]Control Panel[/b]
The control panel is where you and your future members can configure their user data such as avatars, signatures, and their profiles.

[b]Help[/b]
Should you need assistance with something, have an issue to report, or just want to drop by and show your appreciation, the project's [url=https://github.com/Arthmoor/QSF-Portal]GitHub[/url] page is the place do to it.

Have fun and enjoy your new site!";

			// Create Category
			$categoryId = $this->create_forum( 'Discussion', '', 0 );

			// Create Forum - Make News Forum
			$forumId = $this->create_forum( 'News Posts', 'The main page news forum. Only administrators can see this or post in it. Posts here appear as front page news items.', $categoryId );

			// Create Topic
			$this->db->query( "INSERT INTO %ptopics (topic_title, topic_forum, topic_description, topic_starter, topic_icon, topic_posted, topic_edited, topic_last_poster, topic_modes) 
				VALUES ('%s', %d, '%s', %d, '%s', %d, %d, %d, %d)",
				$topicName, $forumId, $topicDesc, $admin_uid, $topicIcon, $this->time, $this->time, $admin_uid, TOPIC_PUBLISH );
			$topicId = $this->db->insert_id( "topics" );

			// Create Post
			$this->db->query( "INSERT INTO %pposts (post_topic, post_author, post_text, post_time, post_emoticons, post_mbcode, post_ip, post_icon)
				VALUES (%d, %d, '%s', %d, 1, 1, '%s', '%s')",
				$topicId, $admin_uid, $topicPost, $this->time, $this->ip, $topicIcon );
			$postId = $this->db->insert_id( "posts" );

			$this->db->query( "UPDATE %ptopics SET topic_last_post=%d WHERE topic_id=%d", $postId, $topicId );

			$this->db->query( "UPDATE %pusers SET user_posts=user_posts+1, user_lastpost=%d WHERE user_id=%d", $this->time, $admin_uid );

			$this->db->query( "UPDATE %pforums SET forum_topics=forum_topics+1, forum_lastpost=%d WHERE forum_id=%d", $postId, $forumId );

			$this->sets['topics']++;
			$this->sets['posts']++;

			// Create second forum - Public chat
			$forumId = $this->create_forum( 'Chat', "Welcome to {$this->sets['forum_name']}. Introduce yourself, ask a question, or join in on any conversations here.", $categoryId );

			// This looks totally dumb considering we did this once already, but it appears necessary.
			$this->db->query( "UPDATE %pgroups SET group_perms='%s' WHERE group_id=1",
				'{"board_view":true,"board_view_closed":true,"do_anything":true,"edit_avatar":true,"edit_profile":true,"edit_sig":true,"email_use":true,"forum_view":{"1":true,"2":true,"3":true},"is_admin":true,"page_create":true,"page_delete":true,"page_edit":true,"pm_noflood":true,"poll_create":{"1":true,"2":true,"3":true},"poll_vote":{"1":true,"2":true,"3":true},"post_attach":{"1":true,"2":true,"3":true},"post_attach_download":{"1":true,"2":true,"3":true},"post_create":{"1":true,"2":true,"3":true},"post_delete":{"1":true,"2":true,"3":true},"post_delete_old":{"1":true,"2":true,"3":true},"post_delete_own":{"1":true,"2":true,"3":true},"post_edit":{"1":true,"2":true,"3":true},"post_edit_old":{"1":true,"2":true,"3":true},"post_edit_own":{"1":true,"2":true,"3":true},"post_inc_userposts":{"1":true,"2":true,"3":true},"post_noflood":{"1":true,"2":true,"3":true},"post_viewip":{"1":true,"2":true,"3":true},"search_noflood":true,"topic_create":{"1":true,"2":true,"3":true},"topic_delete":{"1":true,"2":true,"3":true},"topic_delete_own":{"1":true,"2":true,"3":true},"topic_edit":{"1":true,"2":true,"3":true},"topic_edit_own":{"1":true,"2":true,"3":true},"topic_global":true,"topic_lock":{"1":true,"2":true,"3":true},"topic_lock_own":{"1":true,"2":true,"3":true},"topic_move":{"1":true,"2":true,"3":true},"topic_move_own":{"1":true,"2":true,"3":true},"topic_pin":{"1":true,"2":true,"3":true},"topic_pin_own":{"1":true,"2":true,"3":true},"topic_publish":{"1":true,"2":true,"3":true},"topic_publish_auto":{"1":true,"2":true,"3":true},"topic_split":{"1":true,"2":true,"3":true},"topic_split_own":{"1":true,"2":true,"3":true},"topic_unlock":{"1":true,"2":true,"3":true},"topic_unlock_own":{"1":true,"2":true,"3":true},"topic_unpin":{"1":true,"2":true,"3":true},"topic_unpin_own":{"1":true,"2":true,"3":true},"topic_view":{"1":true,"2":true,"3":true},"topic_view_unpublished":{"1":true,"2":true,"3":true}}'
				);
			$this->db->query( "UPDATE %pgroups SET group_file_perms='%s' WHERE group_id=1",
				'{"add_category":true,"approve_files":true,"category_view":true,"delete_category":true,"delete_files":true,"download_files":true,"edit_category":true,"edit_files":true,"move_files":true,"post_comment":true,"upload_files":true}'
				);

			$this->db->query( "UPDATE %pgroups SET group_perms='%s' WHERE group_id=2",
				'{"board_view":true,"board_view_closed":false,"do_anything":true,"edit_avatar":true,"edit_profile":true,"edit_sig":true,"email_use":true,"forum_view":{"1":true,"2":false,"3":true},"is_admin":false,"page_create":false,"page_delete":false,"page_edit":false,"pm_noflood":false,"poll_create":{"1":true,"2":false,"3":true},"poll_vote":{"1":true,"2":false,"3":true},"post_attach":{"1":true,"2":false,"3":true},"post_attach_download":{"1":true,"2":false,"3":true},"post_create":{"1":true,"2":true,"3":true},"post_delete":{"1":false,"2":false,"3":false},"post_delete_old":{"1":false,"2":false,"3":false},"post_delete_own":{"1":false,"2":false,"3":false},"post_edit":{"1":false,"2":false,"3":false},"post_edit_old":{"1":false,"2":false,"3":false},"post_edit_own":{"1":true,"2":false,"3":true},"post_inc_userposts":{"1":true,"2":false,"3":true},"post_noflood":{"1":false,"2":false,"3":false},"post_viewip":{"1":false,"2":false,"3":false},"search_noflood":false,"topic_create":{"1":true,"2":false,"3":true},"topic_delete":{"1":false,"2":false,"3":false},"topic_delete_own":{"1":false,"2":false,"3":false},"topic_edit":{"1":false,"2":false,"3":false},"topic_edit_own":{"1":true,"2":false,"3":true},"topic_global":false,"topic_lock":{"1":false,"2":false,"3":false},"topic_lock_own":{"1":false,"2":false,"3":false},"topic_move":{"1":false,"2":false,"3":false},"topic_move_own":{"1":false,"2":false,"3":false},"topic_pin":{"1":false,"2":false,"3":false},"topic_pin_own":{"1":false,"2":false,"3":false},"topic_publish":{"1":false,"2":false,"3":false},"topic_publish_auto":{"1":true,"2":false,"3":true},"topic_split":{"1":false,"2":false,"3":false},"topic_split_own":{"1":false,"2":false,"3":false},"topic_unlock":{"1":false,"2":false,"3":false},"topic_unlock_own":{"1":false,"2":false,"3":false},"topic_unpin":{"1":false,"2":false,"3":false},"topic_unpin_own":{"1":false,"2":false,"3":false},"topic_view":{"1":true,"2":false,"3":true},"topic_view_unpublished":{"1":false,"2":false,"3":false}}'
				);
			$this->db->query( "UPDATE %pgroups SET group_file_perms='%s' WHERE group_id=2",
				'{"add_category":false,"approve_files":false,"category_view":true,"delete_category":false,"delete_files":false,"download_files":true,"edit_category":false,"edit_files":false,"move_files":false,"post_comment":true,"upload_files":true}'
				);

			$this->db->query( "UPDATE %pgroups SET group_perms='%s' WHERE group_id=3",
				'{"board_view":true,"board_view_closed":false,"do_anything":true,"edit_avatar":false,"edit_profile":false,"edit_sig":false,"email_use":false,"forum_view":{"1":true,"2":true,"3":true},"is_admin":false,"page_create":false,"page_delete":false,"page_edit":false,"pm_noflood":false,"poll_create":{"1":false,"2":false,"3":false},"poll_vote":{"1":false,"2":false,"3":false},"post_attach":{"1":false,"2":false,"3":false},"post_attach_download":{"1":false,"2":false,"3":false},"post_create":{"1":false,"2":false,"3":false},"post_delete":{"1":false,"2":false,"3":false},"post_delete_old":{"1":false,"2":false,"3":false},"post_delete_own":{"1":false,"2":false,"3":false},"post_edit":{"1":false,"2":false,"3":false},"post_edit_old":{"1":false,"2":false,"3":false},"post_edit_own":{"1":false,"2":false,"3":false},"post_inc_userposts":{"1":false,"2":false,"3":false},"post_noflood":{"1":false,"2":false,"3":false},"post_viewip":{"1":false,"2":false,"3":false},"search_noflood":false,"topic_create":{"1":false,"2":false,"3":false},"topic_delete":{"1":false,"2":false,"3":false},"topic_delete_own":{"1":false,"2":false,"3":false},"topic_edit":{"1":false,"2":false,"3":false},"topic_edit_own":{"1":false,"2":false,"3":false},"topic_global":false,"topic_lock":{"1":false,"2":false,"3":false},"topic_lock_own":{"1":false,"2":false,"3":false},"topic_move":{"1":false,"2":false,"3":false},"topic_move_own":{"1":false,"2":false,"3":false},"topic_pin":{"1":false,"2":false,"3":false},"topic_pin_own":{"1":false,"2":false,"3":false},"topic_publish":{"1":false,"2":false,"3":false},"topic_publish_auto":{"1":false,"2":false,"3":false},"topic_split":{"1":false,"2":false,"3":false},"topic_split_own":{"1":false,"2":false,"3":false},"topic_unlock":{"1":false,"2":false,"3":false},"topic_unlock_own":{"1":false,"2":false,"3":false},"topic_unpin":{"1":false,"2":false,"3":false},"topic_unpin_own":{"1":false,"2":false,"3":false},"topic_view":{"1":true,"2":true,"3":true},"topic_view_unpublished":{"1":false,"2":false,"3":false}}'
				);
			$this->db->query( "UPDATE %pgroups SET group_file_perms='%s' WHERE group_id=3",
				'{"add_category":false,"approve_files":false,"category_view":true,"delete_category":false,"delete_files":false,"download_files":true,"edit_category":false,"edit_files":false,"move_files":false,"post_comment":false,"upload_files":false}'
				);

			$this->db->query( "UPDATE %pgroups SET group_perms='%s' WHERE group_id=4",
				'{"board_view":false,"board_view_closed":false,"do_anything":false,"edit_avatar":false,"edit_profile":false,"edit_sig":false,"email_use":false,"forum_view":{"1":false,"2":false,"3":false},"is_admin":false,"page_create":false,"page_delete":false,"page_edit":false,"pm_noflood":false,"poll_create":{"1":false,"2":false,"3":false},"poll_vote":{"1":false,"2":false,"3":false},"post_attach":{"1":false,"2":false,"3":false},"post_attach_download":{"1":false,"2":false,"3":false},"post_create":{"1":false,"2":false,"3":false},"post_delete":{"1":false,"2":false,"3":false},"post_delete_old":{"1":false,"2":false,"3":false},"post_delete_own":{"1":false,"2":false,"3":false},"post_edit":{"1":false,"2":false,"3":false},"post_edit_old":{"1":false,"2":false,"3":false},"post_edit_own":{"1":false,"2":false,"3":false},"post_inc_userposts":{"1":false,"2":false,"3":false},"post_noflood":{"1":false,"2":false,"3":false},"post_viewip":{"1":false,"2":false,"3":false},"search_noflood":false,"topic_create":{"1":false,"2":false,"3":false},"topic_delete":{"1":false,"2":false,"3":false},"topic_delete_own":{"1":false,"2":false,"3":false},"topic_edit":{"1":false,"2":false,"3":false},"topic_edit_own":{"1":false,"2":false,"3":false},"topic_global":false,"topic_lock":{"1":false,"2":false,"3":false},"topic_lock_own":{"1":false,"2":false,"3":false},"topic_move":{"1":false,"2":false,"3":false},"topic_move_own":{"1":false,"2":false,"3":false},"topic_pin":{"1":false,"2":false,"3":false},"topic_pin_own":{"1":false,"2":false,"3":false},"topic_publish":{"1":false,"2":false,"3":false},"topic_publish_auto":{"1":false,"2":false,"3":false},"topic_split":{"1":false,"2":false,"3":false},"topic_split_own":{"1":false,"2":false,"3":false},"topic_unlock":{"1":false,"2":false,"3":false},"topic_unlock_own":{"1":false,"2":false,"3":false},"topic_unpin":{"1":false,"2":false,"3":false},"topic_unpin_own":{"1":false,"2":false,"3":false},"topic_view":{"1":false,"2":false,"3":false},"topic_view_unpublished":{"1":false,"2":false,"3":false}}'
				);
			$this->db->query( "UPDATE %pgroups SET group_file_perms='%s' WHERE group_id=4",
				'{"add_category":false,"approve_files":false,"category_view":false,"delete_category":false,"delete_files":false,"download_files":false,"edit_category":false,"edit_files":false,"move_files":false,"post_comment":false,"upload_files":false}'
				);

			$this->db->query( "UPDATE %pgroups SET group_perms='%s' WHERE group_id=5",
				'{"board_view":true,"board_view_closed":false,"do_anything":true,"edit_avatar":true,"edit_profile":false,"edit_sig":false,"email_use":false,"forum_view":{"1":false,"2":false,"3":true},"is_admin":false,"page_create":false,"page_delete":false,"page_edit":false,"pm_noflood":false,"poll_create":{"1":false,"2":false,"3":false},"poll_vote":{"1":false,"2":false,"3":false},"post_attach":{"1":false,"2":false,"3":false},"post_attach_download":{"1":false,"2":false,"3":false},"post_create":{"1":false,"2":false,"3":false},"post_delete":{"1":false,"2":false,"3":false},"post_delete_old":{"1":false,"2":false,"3":false},"post_delete_own":{"1":false,"2":false,"3":false},"post_edit":{"1":false,"2":false,"3":false},"post_edit_old":{"1":false,"2":false,"3":false},"post_edit_own":{"1":false,"2":false,"3":false},"post_inc_userposts":{"1":false,"2":false,"3":false},"post_noflood":{"1":false,"2":false,"3":false},"post_viewip":{"1":false,"2":false,"3":false},"search_noflood":false,"topic_create":{"1":false,"2":false,"3":false},"topic_delete":{"1":false,"2":false,"3":false},"topic_delete_own":{"1":false,"2":false,"3":false},"topic_edit":{"1":false,"2":false,"3":false},"topic_edit_own":{"1":false,"2":false,"3":false},"topic_global":false,"topic_lock":{"1":false,"2":false,"3":false},"topic_lock_own":{"1":false,"2":false,"3":false},"topic_move":{"1":false,"2":false,"3":false},"topic_move_own":{"1":false,"2":false,"3":false},"topic_pin":{"1":false,"2":false,"3":false},"topic_pin_own":{"1":false,"2":false,"3":false},"topic_publish":{"1":false,"2":false,"3":false},"topic_publish_auto":{"1":false,"2":false,"3":false},"topic_split":{"1":false,"2":false,"3":false},"topic_split_own":{"1":false,"2":false,"3":false},"topic_unlock":{"1":false,"2":false,"3":false},"topic_unlock_own":{"1":false,"2":false,"3":false},"topic_unpin":{"1":false,"2":false,"3":false},"topic_unpin_own":{"1":false,"2":false,"3":false},"topic_view":{"1":false,"2":false,"3":true},"topic_view_unpublished":{"1":false,"2":false,"3":false}}'
				);
			$this->db->query( "UPDATE %pgroups SET group_file_perms='%s' WHERE group_id=5",
				'{"add_category":false,"approve_files":false,"category_view":true,"delete_category":false,"delete_files":false,"download_files":true,"edit_category":false,"edit_files":false,"move_files":false,"post_comment":false,"upload_files":false}'
				);

			$this->db->query( "UPDATE %pgroups SET group_perms='%s' WHERE group_id=6",
				'{"board_view":true,"board_view_closed":true,"do_anything":true,"edit_avatar":true,"edit_profile":true,"edit_sig":true,"email_use":true,"forum_view":{"1":true,"2":false,"3":true},"is_admin":false,"page_create":false,"page_delete":false,"page_edit":true,"pm_noflood":true,"poll_create":{"1":true,"2":false,"3":true},"poll_vote":{"1":true,"2":false,"3":true},"post_attach":{"1":true,"2":false,"3":true},"post_attach_download":{"1":true,"2":true,"3":true},"post_create":{"1":true,"2":true,"3":true},"post_delete":{"1":true,"2":false,"3":true},"post_delete_old":{"1":true,"2":false,"3":true},"post_delete_own":{"1":false,"2":false,"3":false},"post_edit":{"1":true,"2":false,"3":true},"post_edit_old":{"1":true,"2":false,"3":true},"post_edit_own":{"1":false,"2":false,"3":false},"post_inc_userposts":{"1":true,"2":false,"3":true},"post_noflood":{"1":true,"2":false,"3":true},"post_viewip":{"1":true,"2":false,"3":true},"search_noflood":true,"topic_create":{"1":true,"2":false,"3":true},"topic_delete":{"1":true,"2":false,"3":true},"topic_delete_own":{"1":false,"2":false,"3":false},"topic_edit":{"1":true,"2":false,"3":true},"topic_edit_own":{"1":false,"2":false,"3":false},"topic_global":true,"topic_lock":{"1":true,"2":false,"3":true},"topic_lock_own":{"1":false,"2":false,"3":false},"topic_move":{"1":true,"2":false,"3":true},"topic_move_own":{"1":false,"2":false,"3":false},"topic_pin":{"1":true,"2":false,"3":true},"topic_pin_own":{"1":false,"2":false,"3":false},"topic_publish":{"1":true,"2":false,"3":true},"topic_publish_auto":{"1":true,"2":false,"3":true},"topic_split":{"1":true,"2":false,"3":true},"topic_split_own":{"1":false,"2":false,"3":false},"topic_unlock":{"1":true,"2":false,"3":true},"topic_unlock_own":{"1":false,"2":false,"3":false},"topic_unpin":{"1":true,"2":false,"3":true},"topic_unpin_own":{"1":false,"2":false,"3":false},"topic_view":{"1":true,"2":false,"3":true},"topic_view_unpublished":{"1":true,"2":false,"3":true}}'
				);
			$this->db->query( "UPDATE %pgroups SET group_file_perms='%s' WHERE group_id=6",
				'{"add_category":true,"approve_files":true,"category_view":true,"delete_category":true,"delete_files":true,"download_files":true,"edit_category":true,"edit_files":true,"move_files":true,"post_comment":true,"upload_files":true}'
				);

			// Stupid as this may look, it appears to be quite necessary to allow categories to work.
			$perms = new file_permissions( $this );
			while( $perms->get_group() )
			{
				$perms->add_z( 0 );
				$perms->update();
			}

			$writeSetsWorked = $this->write_db_sets( '../settings.php' );
			$this->write_sets();

			setcookie( $this->sets['cookie_prefix'] . 'user', $admin_uid, $this->time + $this->sets['logintime'], $this->sets['cookie_path'], $this->sets['cookie_domain'], $this->sets['cookie_secure'], true );
			setcookie( $this->sets['cookie_prefix'] . 'pass', $admin_pass, $this->time + $this->sets['logintime'], $this->sets['cookie_path'], $this->sets['cookie_domain'], $this->sets['cookie_secure'], true );

			if( !$writeSetsWorked ) {
				echo "Congratulations! Your site has been installed.<br />
				An administrator account was registered.<br />";
				echo "Click here to download your settings.php file. You must put this file on the webhost before the board is ready to use<br/>\n";
				echo "<form action=\"{$this->self}?mode=new_install&amp;step=3\" method=\"post\">\n
					<input type=\"hidden\" name=\"db_host\" value=\"" . htmlspecialchars($this->post['db_host']) . "\" />\n
					<input type=\"hidden\" name=\"db_name\" value=\"" . htmlspecialchars($this->post['db_name']) . "\" />\n
					<input type=\"hidden\" name=\"db_user\" value=\"" . htmlspecialchars($this->post['db_user']) . "\" />\n
					<input type=\"hidden\" name=\"db_pass\" value=\"" . htmlspecialchars($this->post['db_pass']) . "\" />\n
					<input type=\"hidden\" name=\"db_port\" value=\"" . htmlspecialchars($this->post['db_port']) . "\" />\n
					<input type=\"hidden\" name=\"db_socket\" value=\"" . htmlspecialchars($this->post['db_socket']) . "\" />\n
					<input type=\"hidden\" name=\"prefix\" value=\"" . htmlspecialchars($this->post['prefix']) . "\" />\n
					<input type=\"hidden\" name=\"dbtype\" value=\"" . htmlspecialchars($this->post['db_type']) . "\" />\n
					<input type=\"hidden\" name=\"admin_email\" value=\"" . htmlspecialchars($this->post['admin_email']) . "\" />\n
					<input type=\"submit\" value=\"Download settings.php\" />
					</form>
					<br/>\n
					Once this is done: REMEMBER TO DELETE THE INSTALL DIRECTORY!<br /><br />
					<a href='../index.php'>Go to your board.</a>
					 ";
			} else {
				echo "Congratulations! Your portal has been installed.<br />
				An administrator account was registered.<br /><br />
				<span style='color:yellow; font-weight:bold;'>REMEMBER TO DELETE THE INSTALL DIRECTORY!</span><br /><br />
				<a href='../index.php'>Go to your site.</a>";
			}
			echo '</div>';

			break;

		case 3:
			// Give them the settings.php file
			$this->sets['db_host']   = $this->post['db_host'];
			$this->sets['db_user']   = $this->post['db_user'];
			$this->sets['db_pass']   = $this->post['db_pass'];
			$this->sets['db_name']   = $this->post['db_name'];
			$this->sets['db_port']   = $this->post['db_port'];
			$this->sets['db_socket'] = $this->post['db_socket'];
			$this->sets['prefix']    = trim( preg_replace( '/[^a-zA-Z0-9_]/', '', $this->post['prefix'] ) );
			$this->sets['dbtype']    = $this->post['db_type'];
			$this->sets['admin_email'] = $this->post['admin_email'];

			$settingsFile = $this->create_settings_file();
			ob_clean();
			header( "Content-type: application/octet-stream" );
			header( "Content-Disposition: attachment; filename=\"settings.php\"" );
			echo $settingsFile;
			exit;
			break;
		}
	}
}
?>