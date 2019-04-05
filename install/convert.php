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

require_once $set['include_path'] . '/global.php';
require_once $set['include_path'] . '/lib/xmlparser.php';
require_once $set['include_path'] . '/lib/packageutil.php';

/**
 * Convert From Another Board
 *
 * @author Roger Libiez [Samson]
 * @Since 1.1.5
 */
class convert extends qsfglobal
{
	function server_url()
	{
		$proto = "http" .
		((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "") . "://";

		$server = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];

		return $proto . $server;
	}

	function convert_board( $step )
	{
		switch($step) {
		default:
			$url = preg_replace('/install\/?$/i', '', $this->server_url() . dirname($_SERVER['PHP_SELF']));

echo "<form action='{$this->self}?mode=convert&amp;step=2' method='post'>
 <div class='article'>
  <div class='title' style='text-align:center'>Convert Old Forum to {$this->name}</div>
  <div class='title'>Directory Permissions</div>";

			check_writeable_files();

			if(!is_writeable('../settings.php')) {
				echo "Settings file cannot be written to. The installer cannot continue until this problem is corrected.";
				break;
			}

echo "    <p></p>
  <div class='title' style='text-align:center'>Old Forum</div>
  <div class='title'>What forum software are you converting from?</div>

  <span class='field'>Select forum:</span>
  <span class='form'>
   <select name='old_forum'>
    <option value=''>Forum</option>
    <option value='convert_ipb21.php'>Invision Power Board 2.1</option>
    <option value='convert_ikon312a.php'>Ikonboard 3.1.x</option>
    <option value='convert_invision131f.php'>Invisionboard 1.31f</option>
    <option value='convert_phpbb2.php'>phpBB2 2.x (any 2.x version)</option>
   </select>
  </span>
  <p class='line'></p>
 
  <div class='title' style='text-align:center'>Old Board Database Information</div>
   <span class='field'>Host Server:</span>
   <span class='form'><input class='input' type='text' name='old_db_host' value='localhost' /></span>
   <p class='line'></p>
   
   <span class='field'>Database Name:</span>
   <span class='form'><input class='input' type='text' name='old_db_name' value='' /></span>
   <p class='line'></p>

   <span class='field'>Database Username:</span>
   <span class='form'><input class='input' type='text' name='old_db_user' value='' /></span>
   <p class='line'></p>

   <span class='field'>Database Password:</span>
   <span class='form'><input class='input' type='password' name='old_db_pass' value='' /></span>
   <p class='line'></p>

   <span class='field'>Database Port:</span>
   <span class='form'><input class='input' type='text' name='old_db_port' value='' /> Blank for none</span>
   <p class='line'></p>

   <span class='field'>Database Socket:</span>
   <span class='form'><input class='input' type='text' name='old_db_socket' value='' /> Blank for none</span>
   <p class='line'></p>

   <span class='field'>Table Prefix:</span>
   <span class='form'><input class='input' type='text' name='old_prefix' value='' /> This must match the prefix of your existing tables.</span>
   <p class='line'></p>

   <span class='field'>Number of posts to convert at a time:</span>
   <span class='form'><input class='input' type='text' name='post_inc' value='500' /></span>
   <p class='line'></p>

   <span class='field'>Remove old board data when done?</span>
   <span class='form'>
    <input class='check' type='checkbox' name='post_destroyold' value='1' id='destroy' /><label for='destroy'>A backup will be stored in the packages folder.</label>
   </span>
   <p></p>

  <div class='title' style='text-align:center'>New Board Database Configuration</div>

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
   <input class='input' type='text' name='prefix' value='{$this->sets['prefix']}' /> This should only be changed if you need to install multiple QSF sites in the same database.
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
   <input type='hidden' name='dbtype' value='mysqli' />
   <input type='submit' name='submit' value='Continue' />
  </div>
 </div>
</form>";
break;

		case 2:
  echo "<div class='article'>
  <div class='title' style='text-align:center'>Convert Old Forum to {$this->name}</div>";

			if (!isset($this->post['old_forum']) || $this->post['old_forum'] == '' ) {
				echo "You have not selected a forum to convert from. Please go back and correct this error.";
				break;
			}

			$database = 'db_' . $this->post['dbtype'];

			$oldboard = new qsfglobal;
			$oldboard->db = new $database($this->post['old_db_host'], $this->post['old_db_user'], $this->post['old_db_pass'], $this->post['old_db_name'], $this->post['old_db_port'], $this->post['old_db_socket'], $this->post['old_prefix']);

			if (!$oldboard->db->connection) {
				echo "Couldn't connect to your old database using the specified information.";
				break;
			}

			$this->db = new $database($this->post['db_host'], $this->post['db_user'], $this->post['db_pass'], $this->post['db_name'], $this->post['db_port'], $this->post['db_socket'], $this->post['prefix']);

			if (!$this->db->connection) {
				echo "Couldn't connect to your new database using the specified information.";
				break;
			}

			$oldboard->sets['old_db_host']   = $this->post['old_db_host'];
			$oldboard->sets['old_db_user']   = $this->post['old_db_user'];
			$oldboard->sets['old_db_pass']   = $this->post['old_db_pass'];
			$oldboard->sets['old_db_name']   = $this->post['old_db_name'];
			$oldboard->sets['old_db_port']   = $this->post['old_db_port'];
			$oldboard->sets['old_db_socket'] = $this->post['old_db_socket'];
			$oldboard->sets['post_inc']      = $this->post['post_inc'];
			$oldboard->sets['old_prefix']    = trim(preg_replace('/[^a-zA-Z0-9_]/', '', $this->post['old_prefix']));
			$oldboard->sets['converted']     = '0';

			$this->sets['db_host']   = $this->post['db_host'];
			$this->sets['db_user']   = $this->post['db_user'];
			$this->sets['db_pass']   = $this->post['db_pass'];
			$this->sets['db_name']   = $this->post['db_name'];
			$this->sets['db_port']   = $this->post['db_port'];
			$this->sets['db_socket'] = $this->post['db_socket'];
			$this->sets['prefix']    = trim(preg_replace('/[^a-zA-Z0-9_]/', '', $this->post['prefix']));
			$this->sets['dbtype']    = $this->post['dbtype'];
			$this->sets['installed'] = 1;

			if( isset($this->post['post_destroyold']) ) {
				if(!is_writeable('../packages')) {
					echo "The packages folder is not writeable. Your backup cannot be created and the installer cannot continue until this is corrected.";
					break 2;
				}

				$filename = 'OLD_DB_BACKUP.sql';
				$options = ' -c --add-drop-table';

				$tarray = array();

				$tb = $oldboard->db->query( "SHOW TABLES LIKE '%p%%'" );
				while( $tb1 = $oldboard->db->nqfetch($tb) )
				{
					foreach( $tb1 as $col => $data )
						$tarray[] = $data;
				}

				$tables = implode( ' ', $tarray );

				$mbdump = "mysqldump ".$options." -p --host=".$oldboard->db->host." --user=".$oldboard->db->user;
				$mbdump .= " --result-file='../packages/".$filename."' ".$oldboard->db->db." ".$tables;

				$fds = array(
					0 => array( 'pipe', 'r' ),
					1 => array( 'pipe', 'w' ),
					2 => array( 'pipe', 'w' )
				);

				$pipes = NULL;

				$proc = proc_open( $mbdump, $fds, $pipes );

				fwrite( $pipes[0], $this->db->pass . PHP_EOL );
				fclose( $pipes[0] );

				$stdout = stream_get_contents( $pipes[1] );
				fclose( $pipes[1] );
				$stderr = stream_get_contents( $pipes[2] );
				fclose( $pipes[2] );

				proc_close( $proc );
			}

			if (!$this->write_db_sets('../settings.php')) {
				echo 'The new database connection was ok, but settings.php could not be updated.<br /><br />CHMOD settings.php to 0666.';
				break;
			}

			$filename = './' . $this->sets['dbtype'] . '_data_tables.php';
			if (!is_readable($filename)) {
				echo 'New database connected, settings written, but no data could be loaded from ' . $filename;
				break;
			}

			if (!is_readable('skin_default.xml')) {
				echo 'New database connected, settings written, but no templates could be loaded from file: skin_default.xml';
				break;
			}

			$queries = array();
			$pre = $this->sets['prefix'];
			$this->pre = $this->sets['prefix'];

			// Create tables
			include './' . $this->sets['dbtype'] . '_data_tables.php';

			execute_queries($queries, $this->db);
			$queries = array();
			
			// Create template
			$xmlInfo = new xmlparser();
			$xmlInfo->parse('skin_default.xml');
			$templatesNode = $xmlInfo->GetNodeByPath('QSFMOD/TEMPLATES');
			packageutil::insert_templates('default', $this->db, $templatesNode);
			unset($templatesNode);
			$xmlInfo = null;

			$this->pre = $this->sets['prefix'];

			$this->sets = $this->get_settings($this->sets);
			$this->sets['loc_of_board'] = $this->post['site_url'];
			$this->sets['forum_name'] = $this->post['site_name'];

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

			$this->sets['attach_types'] = array('jpg', 'gif', 'png', 'bmp', 'zip', 'tgz', 'gz', 'rar', '7z');
			$this->sets['attach_upload_size'] = 51200;
			$this->sets['avatar_height'] = 100;
			$this->sets['avatar_upload_size'] = 51200;
			$this->sets['avatar_width'] = 100;
			$this->sets['banned_ips'] = array();
			$this->sets['edit_post_age'] = 0;
			$this->sets['closed'] = 0;
			$this->sets['closedtext'] = 'This site is currently down for maintenance. Please check back later.';

			$server = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
			$this->sets['cookie_domain'] = $server;

			$path = dirname($_SERVER['PHP_SELF']);
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
			$this->sets['servertime'] = 0;
			$this->sets['topics'] = 0;
			$this->sets['topics_per_page'] = 20;
			$this->sets['vote_after_results'] = 0;
			$this->sets['default_skin'] = 'default';
			$this->sets['default_email_shown'] = 0;
			$this->sets['default_lang'] = 'en';
			$this->sets['default_group'] = 2;
			$this->sets['default_timezone'] = 0;
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

			$this->sets['admin_incoming'] = $this->post['admin_email'];
			$this->sets['admin_outgoing'] = $this->post['contact_email'];
			$this->sets['installed'] = 1;
			$this->sets['app_version'] = $this->version;

			// Here's to hoping this actually works as planned!
			require( './' . $this->post['old_forum'] );
			$convert = new conversion($oldboard, $this);

			echo "<div class='title' style='text-align:center'>{$convert->converter} Converter</div>";

			$convert->execute();

			$this->RecountForums();
			$this->ResetMemberStats();

			$this->write_sets();

  			echo "<div class='title' style='text-align:center'>Final Results</div>
			  Your {$convert->converter} forum has been converted successfuly.<br />
			  Members may need to use the 'lost password' form to be able to login again.<br /><br />
			  <span style='color:yellow; font-weight:bold;'>The install folder should be removed for security purposes.</span><br />";
			  if( isset($this->post['post_destroyold']) ) {
				$convert->destroy_old_data();
				echo "<br /><strong>Your old forum data was destroyed. A backup file of the old database is available in the packages folder.</strong><br />";
			  }
			echo "<br /><a href='../index.php'>Go to your site.</a></div>";

			break;
		}
	}
}
?>