<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2007 The QSF Portal Development Team
 * http://www.qsfportal.com/
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2006 The Quicksilver Forums Development Team
 * http://www.quicksilverforums.com/
 * 
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 * http://www.mercuryboard.com/
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
 * New Board Installation
 *
 * @author Jason Warner <jason@mercuryboard.com>
 */
class new_install extends qsfglobal
{
	function install_board( $step )
	{
		switch($step) {
		default:
			$url = preg_replace('/install\/?$/i', '', $this->server_url() . dirname($_SERVER['PHP_SELF']));

			echo "<form action='{$this->self}?mode=new_install&amp;step=2' method='post'>
                              <table border='0' cellpadding='4' cellspacing='0'>\n";

			check_writeable_files();

			include 'templates/newdatabase.php';
			include 'templates/newboardsettings.php';
			include 'templates/newadmin.php';
			include 'templates/newseeddata.php';
			echo "<tr>
                         <td class='subheader' colspan='2' align='center'><input type='submit' value='Continue' /></td>
                         </tr>
                         </table>
                         </form>";
			break;

		case 2:
			$db = new $this->modules['database']($this->post['db_host'], $this->post['db_user'], $this->post['db_pass'], $this->post['db_name'], $this->post['db_port'], $this->post['db_socket'], $this->post['prefix']);

			if (!$db->connection) {
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
			$this->sets['prefix']    = trim(preg_replace('/[^a-zA-Z0-9_]/', '', $this->post['prefix']));

			if (!$this->write_db_sets('../settings.php') && !isset($this->post['downloadsettings'])) {
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
					<input type=\"hidden\" name=\"board_name\" value=\"" . htmlspecialchars($this->post['board_name']) . "\" />\n
					<input type=\"hidden\" name=\"board_url\" value=\"" . htmlspecialchars($this->post['board_url']) . "\" />\n
					<input type=\"hidden\" name=\"admin_name\" value=\"" . htmlspecialchars($this->post['admin_name']) . "\" />\n
					<input type=\"hidden\" name=\"admin_pass\" value=\"" . htmlspecialchars($this->post['admin_pass']) . "\" />\n
					<input type=\"hidden\" name=\"admin_pass2\" value=\"" . htmlspecialchars($this->post['admin_pass2']) . "\" />\n
					<input type=\"hidden\" name=\"admin_email\" value=\"" . htmlspecialchars($this->post['admin_email']) . "\" />\n
					";
				if (isset($this->post['seed_data']) && $this->post['seed_data']) {
					echo "<input type=\"hidden\" name=\"seed_data\" value=\"yes\" />\n";
				}
				echo "<input type=\"submit\" value=\"Force Install\" />
					</form>
					 ";
				break;
			}

			if (!is_readable('./data_tables.php')) {
				echo 'Database connected, settings written, but no tables could be loaded from file: data_tables.php';
				break;
			}

			if (!is_readable(SKIN_FILE)) {
				echo 'Database connected, settings written, but no templates could be loaded from file: ' . SKIN_FILE;
				break;
			}

			if ((trim($this->post['admin_name']) == '')
			|| (trim($this->post['admin_pass']) == '')
			|| (trim($this->post['admin_email']) == '')) {
				echo 'You have not specified an admistrator account. Please go back and correct this error.';
				break;
			}

			if ($this->post['admin_pass'] != $this->post['admin_pass2']) {
				echo 'Your administrator passwords do not match. Please go back and correct this error.';
				break;
			}

			if (isset($this->post['seed_data']) && $this->post['seed_data'] && !is_readable('./seed_data.php')) {
				echo 'Database connected, settings written, but no seed data could be loaded from file: seed_data.php';
				break;
			}

			$queries = array();
			$pre = $this->sets['prefix'];
			$this->pre = $this->sets['prefix'];

			// Create tables
			include './data_tables.php';

			execute_queries($queries, $db);
			$queries = null;
			
			// Create template
			$xmlInfo = new xmlparser();
			$xmlInfo->parse(SKIN_FILE);
			$templatesNode = $xmlInfo->GetNodeByPath('QSFMOD/TEMPLATES');
			packageutil::insert_templates('default', $this->db, $templatesNode);
			unset($templatesNode);
			$xmlInfo = null;

			$this->sets = $this->get_settings($this->sets);
			$this->sets['loc_of_board'] = $this->post['board_url'];
			$this->sets['forum_name'] = $this->post['board_name'];

			$this->post['admin_pass'] = md5($this->post['admin_pass']);

			if (get_magic_quotes_gpc()) {
				$this->unset_magic_quotes_gpc($this->get);
				$this->unset_magic_quotes_gpc($this->post);
				$this->unset_magic_quotes_gpc($this->cookie);
			}

			$this->post['admin_name'] = str_replace(
				array('&amp;#', '\''),
				array('&#', '&#39;'),
				htmlspecialchars($this->post['admin_name'])
			);

			$this->db->query("INSERT INTO %pusers (user_name, user_password, user_group, user_title, user_title_custom, user_joined, user_email, user_timezone)
				VALUES ('%s', '%s', %d, 'Administrator', 1, %d, '%s', %d)",
				$this->post['admin_name'], $this->post['admin_pass'], USER_ADMIN, $this->time, $this->post['admin_email'], $this->sets['servertime']);
			$admin_uid = $this->db->insert_id("users");

			$this->sets['last_member'] = $this->post['admin_name'];
			$this->sets['last_member_id'] = $admin_uid;
			$this->sets['admin_incoming'] = $this->post['admin_email'];
			$this->sets['admin_outgoing'] = $this->post['admin_email'];
			$this->sets['admin_email'] = $this->post['admin_email'];
			$this->sets['members']++;
			$this->sets['installed'] = 1;

			if (isset($this->post['seed_data']) && $this->post['seed_data']) {
				include './seed_data.php';
								
				// Create Category
				$categoryId = $this->create_forum($categoryName, $categoryDesc, 0);
				
				// Create Forum
				$forumId = $this->create_forum($forumName, $forumDesc, $categoryId);
				
				// Create Topic
				$this->db->query("INSERT INTO %ptopics (topic_title, topic_forum, topic_description, topic_starter, topic_icon, topic_posted, topic_edited, topic_last_poster, topic_modes) 
					VALUES ('%s', %d, '%s', %d, '%s', %d, %d, %d, %d)",
					$topicName, $forumId, $topicDesc, $admin_uid, $topicIcon, $this->time, $this->time, $admin_uid, TOPIC_PUBLISH);
				$topicId = $this->db->insert_id("topics");
				
				// Create Post
				$this->db->query("INSERT INTO %pposts (post_topic, post_author, post_text, post_time, post_emoticons, post_mbcode, post_ip, post_icon)
					VALUES (%d, %d, '%s', %d, 1, 1, INET_ATON('%s'), '%s')",
					$topicId, $admin_uid, $topicPost, $this->time, $this->ip, $topicIcon);
				$postId = $this->db->insert_id("posts");
				
				$this->db->query("UPDATE %ptopics SET topic_last_post=%d WHERE topic_id=%d", $postId, $topicId);
					
				$this->db->query("UPDATE %pusers SET user_posts=user_posts+1, user_lastpost=%d WHERE user_id=%d", $this->time, $admin_uid);

				$this->db->query("UPDATE %pforums SET forum_topics=forum_topics+1, forum_lastpost=%d WHERE forum_id=%d", $postId, $forumId);
				
				$this->sets['topics']++;
				$this->sets['posts']++;
			}

			// Stupid as this may look, it appears to be quite necessary to allow categories to work.
			$perms = new $this->modules['file_permissions']($this);
			while ($perms->get_group())
			{
				$perms->add_z(0);
				$perms->update();
			}

			$writeSetsWorked = $this->write_db_sets('../settings.php');
			$this->write_sets();

			if( version_compare( PHP_VERSION, "5.2.0", "<" ) ) {
				setcookie($this->sets['cookie_prefix'] . 'user', $admin_uid, $this->time + $this->sets['logintime'], $this->sets['cookie_path'], $this->sets['cookie_domain'].'; HttpOnly', $this->sets['cookie_secure']);
				setcookie($this->sets['cookie_prefix'] . 'pass', $this->post['admin_pass'], $this->time + $this->sets['logintime'], $this->sets['cookie_path'], $this->sets['cookie_domain'].'; HttpOnly', $this->sets['cookie_secure']);
			} else {
				setcookie($this->sets['cookie_prefix'] . 'user', $admin_uid, $this->time + $this->sets['logintime'], $this->sets['cookie_path'], $this->sets['cookie_domain'], $this->sets['cookie_secure'], true );
				setcookie($this->sets['cookie_prefix'] . 'pass', $this->post['admin_pass'], $this->time + $this->sets['logintime'], $this->sets['cookie_path'], $this->sets['cookie_domain'], $this->sets['cookie_secure'], true );
			}

			if (!$writeSetsWorked) {
				echo "Congratulations! Your board has been installed.<br />
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
					<input type=\"hidden\" name=\"admin_email\" value=\"" . htmlspecialchars($this->post['admin_email']) . "\" />\n
					<input type=\"submit\" value=\"Download settings.php\" />
					</form>
					<br/>\n
					Once this is done: REMEMBER TO DELETE THE INSTALL DIRECTORY!<br /><br />
					<a href='../index.php'>Go to your board.</a>
					 ";
			} else {
				echo "Congratulations! Your portal has been installed.<br />
				An administrator account was registered.<br />
				REMEMBER TO DELETE THE INSTALL DIRECTORY!<br /><br />
				<a href='../index.php'>Go to your portal.</a>";
			}
			break;
		case 3:
			// Give them the settings.php file
			$this->sets['db_host']   = $this->post['db_host'];
			$this->sets['db_user']   = $this->post['db_user'];
			$this->sets['db_pass']   = $this->post['db_pass'];
			$this->sets['db_name']   = $this->post['db_name'];
			$this->sets['db_port']   = $this->post['db_port'];
			$this->sets['db_socket'] = $this->post['db_socket'];
			$this->sets['prefix']    = trim(preg_replace('/[^a-zA-Z0-9_]/', '', $this->post['prefix']));
			$this->sets['admin_email'] = $this->post['admin_email'];

			$settingsFile = $this->create_settings_file();
			ob_clean();
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"settings.php\"");
			echo $settingsFile;
			exit;
			break;
		}
	}

	function server_url()
	{ 
	   $proto = "http" .
		   ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "") . "://";
	   $server = isset($_SERVER['HTTP_HOST']) ?
		   $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
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
	function create_forum($name, $desc, $parent)
	{
		$parent ? $tree = $parent : $tree = '';
		
		$this->db->query("INSERT INTO %pforums
			(forum_tree, forum_parent, forum_name, forum_description, forum_position, forum_subcat) VALUES
			('%s', %d, '%s', '%s', '0', '0')",
			$tree, $parent, $name, $desc);
		
		$forumId = $this->db->insert_id("forums");
		
		$perms = new $this->modules['permissions']($this);
		
		while ($perms->get_group())
		{
			if (!$parent) {
				// Default permissions
				$perms->add_z($forumId);
			} else {
				// Copy permissions
				$perms->add_z($forumId, false);

				foreach ($perms->standard as $perm => $false)
				{
					if (!isset($perms->globals[$perm])) {
						$perms->set_xyz($perm, $forumId, $perms->auth($perm, $parent));
					}
				}
			}
			$perms->update();
		}
		return $forumId;
	}
}
?>
