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

require_once $set['include_path'] . '/global.php';

/**
 * Board Upgrade
 *
 * @author Jason Warner <jason@mercuryboard.com>
 */
class upgrade extends qsfglobal
{
	private $database = null;

	// Override for upgrade purposes.
	public function get_settings( $sets )
	{
		$settings = $this->db->fetch( 'SELECT settings_data FROM %psettings LIMIT 1' );

		return array_merge( $sets, json_decode( $settings['settings_data'], true ) );
	}

	public function upgrade_board( $step )
	{
		$this->database = 'db_' . $this->sets['dbtype'];

		switch( $step ) {
		default:
			echo "<form action='{$this->self}?mode=upgrade&amp;step=2' method='post'>
			 <div class='article'>
			  <div class='title' style='text-align:center'>Upgrade {$this->name}</div>";

			$db = new $this->database( $this->sets['db_host'], $this->sets['db_user'], $this->sets['db_pass'], $this->sets['db_name'],
				$this->sets['db_port'], $this->sets['db_socket'], $this->sets['prefix'] );

			if( !$db->connection )
			{
				echo "Couldn't select database: " . $db->error();
				break;
			}

  			echo "<div class='title'>Directory Permissions</div>";

			check_writeable_files();

			$this->db = $db;
			$this->pre = $this->sets['prefix'];
			$this->sets = $this->get_settings( $this->sets );

			$v_message = 'To determine what version you are running, check the bottom of your AdminCP page. Or check the CHANGES file and look for the latest revision mentioned there.';
			if( isset( $this->sets['app_version'] ) )
				$v_message = 'The upgrade script has determined you are currently using ' . $this->sets['app_version'];

			echo "<br><br><strong>{$v_message}</strong>";

			if( isset( $this->sets['app_version'] ) && $this->sets['app_version'] == $this->version ) {
				echo "<br><br>The detected version of {$this->name} is the same as the version you are trying to upgrade to. The upgrade cannot be processed.";
			} elseif( isset( $this->settings['app_version'] ) && $this->settings['app_version'] > $this->version ) {
            echo "<br><br><strong>The detected version of {$this->name} is newer than the version you are trying to upgrade to. The upgrade cannot be processed.</strong>";
         } elseif( isset( $this->settings['app_version'] ) {
            echo "	<br><br><strong>Current detected version: " . $this->settings['app_version'] . "</strong>
               <br><br><strong>Upgrading to version: " . $this->version . "</strong>
 
					<div style='text-align:center'>
					 <input type='submit' value='Proceed With Upgrade'>
					 <input type='hidden' name='mode' value='upgrade'>
					 <input type='hidden' name='step' value='2'>
					</div>";
         } else {
				echo "<div class='title' style='text-align:center'>Upgrade from what version?</div>
			       <span class='half'>
				<div class='title'>QSF Portal</div>

				<span class='field'><input type='radio' name='from' value='1.5.1' id='151'></span>
				<span class='form'><label for='151'>QSF Portal v1.5.1</label></span>
				<p class='line'></p>
			       </span>

				<p></p>

				<div style='text-align:center'>
				 <input type='submit' value='Continue'>
				 <input type='hidden' name='mode' value='upgrade'>
				 <input type='hidden' name='step' value='2'>
				</div>";
			}
			echo "    </div>
			    </form>\n";
			break;

		case 2:
			echo "<div class='article'>
			  <div class='title' style='text-align:center'>Upgrade {$this->name}</div>";
			@set_time_limit( 600 );

			$db = new $this->database( $this->sets['db_host'], $this->sets['db_user'], $this->sets['db_pass'], $this->sets['db_name'],
				$this->sets['db_port'], $this->sets['db_socket'], $this->sets['prefix'] );

			if( !$db->connection ) {
				if( $this->get['step'] == 15 ) {
					$sets_error = '<br>Could not connect with the specified information.';
				} else {
					$sets_error = null;
				}

				break;
			}

			$queries = array();
			$pre = $this->sets['prefix'];
			$full_template_list = false;
			$template_list = array();
			$new_permissions = array();
			$new_file_perms = array();

			$this->sets['installed'] = 1;

			$this->pre  = $this->sets['prefix'];
			$this->db   = $db;

			// Missing breaks are deliberate. Upgrades from older versions need to step through all of this.
         if( isset( $this->post['from'] ) )
         {
            switch( $this->post['from'] )
            {
               // Examples for setting new perms
               // $new_permissions['post_inc_userposts'] = true;
               // $new_permissions['topic_publish_auto'] = true; // will publish on posting
               // $new_permissions['topic_publish'] = false;
               // $new_permissions['topic_view_unpublished'] = false;

               // $new_file_perms['download_files'] = true;
               // $new_file_perms['upload_files'] = false;
               // $new_file_perms['approve_files'] = false;
               // $new_file_perms['edit_files'] = false;

               case '1.5.1':
                  // New settings
                  $this->sets['registrations_allowed'] = 1;
                  $this->sets['validation_purge_timeout'] = 10;
                  $this->sets['analytics_code'] = '';
                  $this->sets['default_skin'] = 1;
                  $this->sets['default_timezone'] = 'Europe/London';
                  $this->sets['servertime'] = 'Europe/London';
                  $this->sets['left_sidebar_links'] = array();
                  $this->sets['right_sidebar_links'] = array();
                  $this->sets['htts_enabled'] = 0;
                  $this->sets['htts_max_age'] = 0;
                  $this->sets['xfo_enabled'] = 0;
                  $this->sets['xfo_policy'] = 1;
                  $this->sets['xfo_allowed_origin'] = '';
                  $this->sets['xcto_enabled'] = 0;
                  $this->sets['csp_enabled'] = 0;
                  $this->sets['csp_details'] = '';
                  $this->sets['fp_enabled'] = 0;
                  $this->sets['fp_details'] = '';
                  $this->sets['conversations'] = 0;
                  $this->sets['spam_pm_count'] = 0;

                  // Deleted settings
                  unset( $this->sets['analytics_id'] );
                  unset( $this->sets['link_target'] );
                  unset( $this->sets['max_load'] );
                  unset( $this->sets['debug_mode'] );

                  // Queries to run
                  $queries[] = 'ALTER TABLE %pactive CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %pattach CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %pcaptcha CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %pfile_categories CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %pfilecomments CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %pfiles CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %pforums CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %pgroups CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %plogs CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %pmembertitles CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %ppmsystem CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %pposts CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %preplacements CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %psettings CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %pspam CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %psubscriptions CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %ptopics CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %pupdates CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
                  $queries[] = 'ALTER TABLE %pusers CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';

                  $queries[] = 'ALTER TABLE %ptopics CHANGE topic_description topic_description varchar(255)';
                  $queries[] = 'ALTER TABLE %psettings ADD settings_version smallint(2) NOT NULL default 1 AFTER settings_id';
                  $queries[] = 'ALTER TABLE %psettings ADD settings_mobile_icons text AFTER settings_meta_description';
                  $queries[] = 'ALTER TABLE %pforums ADD forum_news tinyint(1) unsigned NOT NULL default 0 AFTER forum_redirect';
                  $queries[] = 'ALTER TABLE %pposts CHANGE post_emoticons post_emojis tinyint(1) unsigned NOT NULL default 1';
                  $queries[] = 'ALTER TABLE %pposts CHANGE post_mbcode post_bbcode tinyint(1) unsigned NOT NULL default 1';
                  $queries[] = 'ALTER TABLE %pspam CHANGE spam_emoticons spam_emojis tinyint(1) unsigned NOT NULL default 1';
                  $queries[] = 'ALTER TABLE %pspam CHANGE spam_mbcode spam_bbcode tinyint(1) unsigned NOT NULL default 1';
                  $queries[] = "ALTER TABLE %pactive CHANGE active_user_agent active_user_agent varchar(255) NOT NULL default 'Unknown'";
                  $queries[] = 'ALTER TABLE %pusers CHANGE user_view_emoticons user_view_emojis tinyint(1) unsigned NOT NULL default 1';
                  $queries[] = 'ALTER TABLE %pusers CHANGE user_password user_password varchar(255) NOT NULL';
                  $queries[] = "ALTER TABLE %pusers CHANGE user_timezone user_timezone varchar(255) NOT NULL default 'Europe/London'";
                  $queries[] = "UPDATE %pusers SET user_timezone='Europe/London'";
                  $queries[] = "ALTER TABLE %pusers ADD user_facebook varchar(255) NOT NULL default '' AFTER user_twitter";
                  $queries[] = 'ALTER TABLE %pusers ADD user_lastcvallread int(10) unsigned NOT NULL default 0 AFTER user_lastallread';
                  $queries[] = 'ALTER TABLE %pusers DROP COLUMN user_icq';
                  $queries[] = 'ALTER TABLE %pusers DROP COLUMN user_aim';
                  $queries[] = 'ALTER TABLE %pusers DROP COLUMN user_msn';
                  $queries[] = 'ALTER TABLE %pusers DROP COLUMN user_yahoo';
                  $queries[] = 'ALTER TABLE %pusers DROP COLUMN user_skin';
                  $queries[] = 'ALTER TABLE %pusers ADD user_skin int(10) unsigned NOT NULL default 1 AFTER user_group';
                  $queries[] = 'UPDATE %pusers SET user_skin=1';
                  $queries[] = 'ALTER TABLE %pattach ADD attach_pm tinyint(1) unsigned NOT NULL default 0 AFTER attach_size';

                  $queries[] = 'ALTER TABLE %pusers DROP COLUMN user_birthday';
                  $queries[] = 'ALTER TABLE %pusers DROP COLUMN user_email_show';

                  $queries[] = 'ALTER TABLE %pvotes ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci';
                  $queries[] = 'ALTER TABLE %pvalidation ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pusers ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pupdates ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %ptopics ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %psubscriptions ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pspam ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pskins ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %psettings ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %preplacements ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %preadmarks ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci';
                  $queries[] = 'ALTER TABLE %pposts ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %ppmsystem ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %ppages ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pmembertitles ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %plogs ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pgroups ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pforums ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pfile_categories ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pfiles ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pfileratings ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci';
                  $queries[] = 'ALTER TABLE %pfilecomments ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pemojis ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pconv_readmarks ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pconv_posts ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pconversations ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pcaptcha ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pattach ENGINE=InnoDB';
                  $queries[] = 'ALTER TABLE %pactive ENGINE=InnoDB';

                  $queries[] = "CREATE TABLE %pvalidation (
                     validate_id int(10) unsigned NOT NULL,
                     validate_hash varchar(255) NOT NULL,
                     validate_time int(10) unsigned NOT NULL,
                     validate_ip varchar(40) NOT NULL DEFAULT '127.0.0.1',
                     validate_user_agent varchar(255) NOT NULL,
                     PRIMARY KEY (validate_id)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

                  $queries[] = "DROP TABLE IF EXISTS %phelp";
                  $queries[] = "DROP TABLE IF EXISTS %ptemplates";

                  $queries[] = "DROP TABLE IF EXISTS %pskins";
                  $queries[] = "CREATE TABLE %pskins (
                     skin_id int(12) unsigned NOT NULL auto_increment,
                     skin_name varchar(255) NOT NULL default '',
                     skin_dir varchar(255) NOT NULL default '',
                     skin_enabled tinyint(1) unsigned NOT NULL default '0',
                     PRIMARY KEY  (skin_id)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

                  $queries[] = "INSERT INTO %pskins (skin_name, skin_dir, skin_enabled) VALUES ( 'Ashlander 4', 'default', 1 )";

                  $queries[] = "CREATE TABLE %pemojis (
                     emoji_id int(10) unsigned NOT NULL auto_increment,
                     emoji_string varchar(15) NOT NULL default '',
                     emoji_image varchar(255) NOT NULL default '',
                     emoji_clickable tinyint(1) unsigned NOT NULL default '1',
                     PRIMARY KEY  (emoji_id)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':alien:', 'alien.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':biggrin:', 'biggrin.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':blues:', 'blues.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':cool:', 'cool.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':cry:', 'cry.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':cyclops:', 'cyclops.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':devil:', 'devil.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':evil:', 'evil.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':ghostface:', 'ghostface.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':grinning:', 'grinning.png', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':lol:', 'lol.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':mad:', 'angry.png', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':redface:', 'redface.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':robot:', 'robot.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':rolleyes:', 'rolleyes.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':sad:', 'sad.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':smile:', 'smile.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':stare:', 'stare.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':surprised:', 'surprised.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':thinking:', 'thinking.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':tongue:', 'tongue.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':unclesam:', 'unclesam.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':wink:', 'wink.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':huh:', 'huh.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':blink:', 'blink.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':facepalm:', 'facepalm.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':whistle:', 'whistle.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':sick:', 'sick.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':headbang:', 'headbang.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':innocent:', 'innocent.png', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':crazy:', 'crazy.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':rofl:', 'rofl.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':lmao:', 'lmao.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':shrug:', 'shrug.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':ninja:', 'ninja.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':nuke:', 'nuke.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':wub:', 'wub.png', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':imp:', 'imp.png', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':banana:', 'dancingbanana.gif', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':cricket:', 'cricket.png', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':troll:', 'trollface.png', 1 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':(', 'sad.png', 0 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':P', 'tongue.png', 0 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (';)', 'wink.png', 0 )";
                  $queries[] = "INSERT INTO %pemojis (emoji_string, emoji_image, emoji_clickable) VALUES (':)', 'smile.gif', 0 )";

                  $queries[] = "CREATE TABLE %pconversations (
                     conv_id int(10) unsigned NOT NULL auto_increment,
                     conv_title varchar(75) NOT NULL default '',
                     conv_description varchar(255),
                     conv_starter int(10) unsigned NOT NULL default '0',
                     conv_last_post int(10) unsigned NOT NULL default '0',
                     conv_last_poster int(10) unsigned NOT NULL default '0',
                     conv_icon varchar(32) NOT NULL default '',
                     conv_posted int(10) unsigned NOT NULL default '0',
                     conv_edited int(10) unsigned NOT NULL default '0',
                     conv_replies smallint(5) unsigned NOT NULL default '0',
                     conv_views smallint(5) unsigned NOT NULL default '0',
                     conv_users varchar(255) NOT NULL default '',
                     PRIMARY KEY  (conv_id),
                     KEY User (conv_starter)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

                  $queries[] = "CREATE TABLE %pconv_posts (
                     post_id int(10) unsigned NOT NULL auto_increment,
                     post_convo int(10) unsigned NOT NULL,
                     post_author int(10) unsigned NOT NULL,
                     post_time int(10) unsigned NOT NULL default '0',
                     post_edited_by varchar(32) default '',
                     post_edited_time int(10) unsigned NOT NULL default '0',
                     post_emojis tinyint(1) unsigned NOT NULL default '1',
                     post_bbcode tinyint(1) unsigned NOT NULL default '1',
                     post_ip varchar(40) NOT NULL default '127.0.0.1',
                     post_icon varchar(32),
                     post_text text NOT NULL,
                     post_referrer tinytext,
                     post_agent tinytext,
                     PRIMARY KEY  (post_id),
                     KEY Conversation (post_convo),
                     FULLTEXT KEY post_text (post_text)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

                  $queries[] = "CREATE TABLE %pconv_readmarks (
                     readmark_user int(10) unsigned NOT NULL default '0',
                     readmark_conv int(10) unsigned NOT NULL default '0',
                     readmark_lastread int(10) unsigned NOT NULL default '0',
                     PRIMARY KEY  (readmark_user,readmark_conv)
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";               

                  execute_queries( $queries, $this->db );
                  $this->settings['app_version'] = 2.0;
                  $queries = array();
               default:
                  break;
            }
			}

         // Missing breaks are deliberate. Upgrades from older versions need to step through all of this.
         switch( $this->settings['app_version'] )
         {
            // 2.0 to 2.0.1
            case 2.01:

            default:
               break;
         }
			execute_queries( $queries, $this->db );

			$queries = array();

			// New fields in forum tables need to be fixed.
			$this->updateForumTrees();
			$this->RecountForums();

			$this->perms = new permissions( $this );
			$this->file_perms = new file_permissions( $this );

			// Check if new permissions need to be added
			if( !empty( $new_permissions ) ) {
				foreach( $new_permissions as $id => $default )
				{
					// Groups
					while( $this->perms->get_group() )
					{
						$perm_on = $default;
						if( $this->perms->auth( 'is_admin' ) ) $perm_on = true;
						if( !$this->perms->auth( 'do_anything' ) ) $perm_on = false;
						if( $this->perms->is_guest ) $perm_on = false;
						$this->perms->add_perm( $id, $perm_on );
						$this->perms->update();
					}

					// Users
					while( $this->perms->get_group( true ) )
					{
						$perm_on = $default;
						if( $this->perms->auth( 'is_admin' ) ) $perm_on = true;
						if( !$this->perms->auth( 'do_anything' ) ) $perm_on = false;
						if( $this->perms->is_guest ) $perm_on = false;
						$this->perms->add_perm( $id, $perm_on );
						$this->perms->update();
					}
				}
			}

			// Check if new file permissions need to be added
			if( !empty( $new_file_perms ) ) {
				foreach( $new_file_perms as $id => $default )
				{
					// Groups
					while( $this->file_perms->get_group() )
					{
						$perm_on = $default;
						$this->file_perms->add_perm( $id, $perm_on );
						$this->file_perms->update();
					}

					// Users
					while( $this->file_perms->get_group( true ) )
					{
						$perm_on = $default;
						$this->file_perms->add_perm( $id, $perm_on );
						$this->file_perms->update();
					}
				}
			}

			$this->sets['app_version'] = $this->version;
			$this->write_sets();

			echo "<div class='title' style='text-align:center'>Upgrade Successful</div>
			  <span style='color:yellow; font-weight:bold;'>REMEMBER TO DELETE THE INSTALL DIRECTORY!</span><br><br>
			  <a href='../index.php'>Go to your site.</a>
			 </div>";
			break;
		}
	}
}
?>