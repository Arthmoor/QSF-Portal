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
 * http://code.google.com/p/quicksilverforums/
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

define('LATEST', 37);   // ID of most recent upgrade script

require_once $set['include_path'] . '/lib/' . $set['dbtype'] . '.php';
require_once $set['include_path'] . '/global.php';
require_once $set['include_path'] . '/lib/xmlparser.php';
require_once $set['include_path'] . '/lib/packageutil.php';

/**
 * Board Upgrade
 *
 * @author Jason Warner <jason@mercuryboard.com>
 */
class upgrade extends qsfglobal
{
	// Override for upgrade purposes.
	function get_settings($sets)
	{
		$settings = $this->db->fetch("SELECT settings_data FROM %psettings LIMIT 1");

		return array_merge($sets, json_decode($settings['settings_data'], true));
	}

	function upgrade_board( $step )
	{
		switch($step) {
		default:
			echo "<form action='{$this->self}?mode=upgrade&amp;step=2' method='post'>
 <div class='article'>
  <div class='title' style='text-align:center'>Upgrade {$this->name}</div>";

			$db = new $this->modules['database']($this->sets['db_host'], $this->sets['db_user'], $this->sets['db_pass'], $this->sets['db_name'],
				$this->sets['db_port'], $this->sets['db_socket'], $this->sets['prefix']);

			if ( !$db->connection )
			{
				echo "Couldn't select database: " . $db->error();
				break;
			}

  			echo "<div class='title'>Directory Permissions</div>";

			check_writeable_files();

			$this->db = $db;
			$this->pre = $this->sets['prefix'];
			$this->sets = $this->get_settings($this->sets);

			$v_message = 'To determine what version you are running, check the bottom of your AdminCP page. Or check the CHANGES file and look for the latest revision mentioned there.';
			if( isset($this->sets['app_version']) )
				$v_message = 'The upgrade script has determined you are currently using ' . $this->sets['app_version'];

			echo "<br /><br /><strong>{$v_message}</strong>";

			if( isset($this->sets['app_version']) && $this->sets['app_version'] == $this->version ) {
				echo "<br /><br />The detected version of {$this->name} is the same as the version you are trying to upgrade to. The upgrade cannot be processed.";
			} else {
				echo "<div class='title' style='text-align:center'>Upgrade from what version?</div>
			       <span class='half'>
				<div class='title'>QSF Portal</div>

				<span class='field'><input type='radio' name='from' value='38' id='upgrade38' /></span>
				<span class='form'><label for='upgrade38'>QSF Portal v1.5.2</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='37' id='upgrade37' /></span>
				<span class='form'><label for='upgrade37'>QSF Portal v1.5.1</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='36' id='upgrade36' /></span>
				<span class='form'><label for='upgrade36'>QSF Portal v1.5</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='35' id='upgrade35' /></span>
				<span class='form'><label for='upgrade35'>QSF Portal v1.4.6</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='34' id='upgrade34' /></span>
				<span class='form'><label for='upgrade34'>QSF Portal v1.4.5</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='33' id='upgrade33' /></span>
				<span class='form'><label for='upgrade33'>QSF Portal v1.4.4</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='32' id='upgrade32' /></span>
				<span class='form'><label for='upgrade32'>QSF Portal v1.4.3</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='31' id='upgrade31' /></span>
				<span class='form'><label for='upgrade31'>QSF Portal v1.4.2</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='30' id='upgrade30' /></span>
				<span class='form'><label for='upgrade30'>QSF Portal v1.4.1</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='29' id='upgrade29' /></span>
				<span class='form'><label for='upgrade29'>QSF Portal v1.4.0</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='28' id='upgrade28' /></span>
				<span class='form'><label for='upgrade28'>QSF Portal v1.3.5</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='27' id='upgrade27' /></span>
				<span class='form'><label for='upgrade27'>QSF Portal v1.3.4</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='26' id='upgrade26' /></span>
				<span class='form'><label for='upgrade26'>QSF Portal v1.3.3</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='25' id='upgrade25' /></span>
				<span class='form'><label for='upgrade25'>QSF Portal v1.3.2</label></span>
			       </span>

			       <span class='half'>
    				<div class='title'>Quicksilver Forums</div>

				<span class='field'><input type='radio' name='from' value='24' id='upgrade24' /></span>
				<span class='form'><label for='upgrade24'>QSF Portal v1.3.1</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='23' id='upgrade23' /></span>
				<span class='form'><label for='upgrade23'>Quicksilver Forums v1.3.1</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='22' id='upgrade22' /></span>
				<span class='form'><label for='upgrade22'>Quicksilver Forums v1.3.0</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='21' id='upgrade21' /></span>
				<span class='form'><label for='upgrade21'>Quicksilver Forums v1.2.1</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='20' id='upgrade20' /></span>
				<span class='form'><label for='upgrade20'>Quicksilver Forums v1.2.0</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='19' id='upgrade19' /></span>
				<span class='form'><label for='upgrade19'>Quicksilver Forums v1.1.9</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='18' id='upgrade18' /></span>
				<span class='form'><label for='upgrade18'>Quicksilver Forums v1.1.8</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='17' id='upgrade17' /></span>
				<span class='form'><label for='upgrade17'>Quicksilver Forums v1.1.7</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='16' id='upgrade16' /></span>
				<span class='form'><label for='upgrade16'>Quicksilver Forums v1.1.6</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='15' id='upgrade15' /></span>
				<span class='form'><label for='upgrade15'>Quicksilver Forums v1.1.5</label></span>
			       </span>

			       <span class='half'>
				<div class='title'>MercuryBoard</div>

				<span class='field'><input type='radio' name='from' value='14' id='upgrade14' /></span>
				<span class='form'><label for='upgrade14'>MercuryBoard v1.1.4</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='13' id='upgrade13' /></span>
				<span class='form'><label for='upgrade13'>MercuryBoard v1.1.3</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='12' id='upgrade12' /></span>
				<span class='form'><label for='upgrade12'>MercuryBoard v1.1.2</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='11' id='upgrade11' /></span>
				<span class='form'><label for='upgrade11'>MercuryBoard v1.1.1</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='10' id='upgrade10' /></span>
				<span class='form'><label for='upgrade10'>MercuryBoard v1.1.0</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='9' id='upgrade9' /></span>
				<span class='form'><label for='upgrade9'>MercuryBoard v1.0.2</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='8' id='upgrade8' /></span>
				<span class='form'><label for='upgrade8'>MercuryBoard v1.0.1</label></span>
				<p class='line'></p>

				<span class='field'><input type='radio' name='from' value='7' id='upgrade7' /></span>
				<span class='form'><label for='upgrade7'>MercuryBoard v1.0.0</label></span>
			       </span>
				<p></p>

				<div style='text-align:center'>
				 <input type='submit' value='Continue' />
				 <input type='hidden' name='mode' value='upgrade' />
				 <input type='hidden' name='step' value='2' />
				</div>";
			}
			echo "    </div>
			    </form>\n";
			break;

		case 2:
 <div class='article'>
  <div class='title' style='text-align:center'>Upgrade {$this->name}</div>";
			@set_time_limit(600);

			// Check to see if all upgrade files are intact
			$check = $this->post['from'];
			while ($check <= LATEST)
			{
				if (!is_readable("./upgrade_$check.php")) {
					echo "A file required for upgrading was not found: upgrade_$check.php";
					break 2;
				}
				$check++;
			}
			$check = $this->post['from'];

			$db = new $this->modules['database']($this->sets['db_host'], $this->sets['db_user'], $this->sets['db_pass'], $this->sets['db_name'],
				$this->sets['db_port'], $this->sets['db_socket'], $this->sets['prefix']);

			if (!$db->connection) {
				if ($this->get['step'] == 15) {
					$sets_error = '<br />Could not connect with the specified information.';
				} else {
					$sets_error = null;
				}

				include 'templates/upgradefromdatabase.php';
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

			// We can't get settings from the database unless we're already running >= 1.1.0
			if ($check >= 10) {
				$this->sets = $this->get_settings($this->sets);
			}

			$this->perms = new $this->modules['permissions']($this);
			$this->file_perms = new $this->modules['file_permissions']($this);

			while ($check <= LATEST)
			{
				include "./upgrade_{$check}.php";
				$check++;

				// This gets really complicated so be careful
				if (is_bool($need_templates)) {
					if ($need_templates) {
						$full_template_list = true;
					}
				} else {
					$template_list = array_unique(array_merge($template_list, $need_templates));
				}
			}

			/**
			 * The order this next block executes is important.
			 * 1. Verify we can upgrade templates
			 * 2. Upgrade board
			 * 3. Upgrade templates
			 *
			 * Because the query used to upgrade templates is for
			 * the most recent version of the board, we must run
			 * it after the board is fully upgraded.
			 **/

			if ($need_templates && !is_readable('skin_default.xml')) {
				echo 'No templates could be loaded from skin_default.xml';
				break;
			}

			execute_queries($queries, $this->db);

			$queries = array();
			
			// Check the default skin still exists
			$result = $this->db->fetch("SELECT * FROM %pskins WHERE skin_dir='default'");
			if (!$result) {
				$this->db->query("INSERT INTO %pskins (skin_name, skin_dir) VALUES ('Ashlander 3', 'default')");
				$full_template_list = true;
			}
			
			$skinsupdated = "The following templates were upgraded:<br /><br /><span class='tiny'>";
			$didsomething = false;
			$result = $this->db->query("SELECT * FROM %pskins");

			while ($row = $this->db->nqfetch($result))
			{
				$skin = $row['skin_dir'];

				// QSF or MB default skin in default location
				if (($row['skin_name'] == 'QSF Comet Portal' || $row['skin_name'] == 'QSF Comet' || $row['skin_name'] == 'Blue Comet' || $row['skin_name'] == 'Candy Corn') && $skin == 'default') {
					if ($full_template_list || $template_list) {
						if ($full_template_list) {
							$template_list = null;
							$this->db->query("DELETE FROM %ptemplates WHERE template_skin='default'");
						
							$skinsupdated .= $row['skin_name'] . ": Full Template Replacement<br />";
						} else {
							$template_list_string = '';
							foreach ($template_list as $temp_name) {
								$template_list_string .= "'$temp_name',";
								$skinsupdated .= $row['skin_name'] . ": " . $temp_name ."<br />";
							}
							$template_list_string = substr($template_list_string, 0, -1);
							$this->db->query("DELETE FROM %ptemplates WHERE template_name IN ($template_list_string) AND template_skin='default'");
						}
						
						// Create template
						$xmlInfo = new xmlparser();
						$xmlInfo->parse('skin_default.xml');
						$templatesNode = $xmlInfo->GetNodeByPath('QSFMOD/TEMPLATES');
						packageutil::insert_templates('default', $this->db, $templatesNode, $template_list);
						unset($templatesNode);
						$xmlInfo = null;
						
						$didsomething = true;
					}
					if ($row['skin_name'] == 'QSF Comet' || $row['skin_name'] == 'QSF Comet Portal' || $row['skin_name'] == 'Blue Comet' || $row['skin_name'] == 'Candy Corn') {
						$this->db->query("UPDATE %pskins SET skin_name='Ashlander 3' WHERE skin_dir='%s'", $skin);
					}
				}
				else
				{
					// Other skins
					$xmlInfo = new xmlparser();
					$xmlInfo->parse('skin_default.xml');
					$templatesNode = $xmlInfo->GetNodeByPath('QSFMOD/TEMPLATES');
					$temp_names = packageutil::list_templates($templatesNode);
					$temps_to_insert = array();
						
					foreach ($temp_names as $temp_name)
					{
						$miss = $this->db->query("SELECT template_name FROM %ptemplates WHERE template_skin='%s' AND template_name='%s'",
							$skin, $temp_name);

						if ($this->db->num_rows($miss) < 1) {
							$skinsupdated .= $row['skin_name'] . ": Added: " . $temp_name ."<br />";
							$temps_to_insert[] = $temp_name;
						}
					}
					
					if ($temps_to_insert) {
						$templatesNode = $xmlInfo->GetNodeByPath('QSFMOD/TEMPLATES');
						packageutil::insert_templates($skin, $this->db, $templatesNode, $temps_to_insert);
						$didsomething = true;
					}
					unset($templatesNode);
					$xmlInfo = null;
				}

				/* Iterate over all our templates. This is excessive, but only needs to be done once anyway. */
				$sql = "SELECT template_html, template_name FROM {$this->pre}templates WHERE template_skin='{$skin}'";
				$query = $this->db->query($sql);

				while ($row2 = $this->db->nqfetch($query))
				{
					if( strstr( $row2['template_html'], '{$messageclass}' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('{$messageclass}', '<MODLET messagelink(class)>', $row2['template_html']);
						$updated_temps[] = $row['template_name'];
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '{$MessageLink}' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('{$MessageLink}', '<MODLET messagelink(text)>', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '$mercury' ) ) {
						$didsomething = true;
               		        	        $row2['template_html'] = str_replace('$mercury', '$qsf', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '$qsfboard' ) ) {
						$didsomething = true;
                       	        		$row2['template_html'] = str_replace('$qsfboard', '$quicksilverforums', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '$qsf->lang->main_powered' ) ) {
						$didsomething = true;
	                                	$row2['template_html'] = str_replace('$qsf->lang->main_powered', '$qsf->lang->powered', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '$qsf->lang->main_seconds' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('$qsf->lang->main_seconds', '$qsf->lang->seconds', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '$this->lang->pm_inbox' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('$this->lang->pm_inbox', '$foldername', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '$this->lang->board_topics_new' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('$this->lang->board_topics_new', '$this->lang->main_topics_new', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '$this->lang->forum_topics_new' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('$this->lang->forum_topics_new', '$this->lang->main_topics_new', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '$this->lang->recent_topics_new' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('$this->lang->recent_topics_new', '$this->lang->main_topics_new', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], 'post_mbcode_' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('post_mbcode_', 'mbcode_', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '$qsf->tree' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('$qsf->tree', '$qsf->htmlwidgets->tree', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '$admin->tree' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('$admin->tree', '$admin->htmlwidgets->tree', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '$this->tree' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('$this->tree', '$this->htmlwidgets->tree', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '{$active[\'TOTALCOUNT\']}' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('{$active[\'TOTALCOUNT\']}', 'Skin Update Required', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '{$active[\'MEMBERCOUNT\']}' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('{$active[\'MEMBERCOUNT\']}', 'Skin Update Required', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '{$active[\'GUESTCOUNT\']}' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('{$active[\'GUESTCOUNT\']}', 'Skin Update Required', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
					if( strstr( $row2['template_html'], '{$active[\'USERS\']}' ) ) {
						$didsomething = true;
						$row2['template_html'] = str_replace('{$active[\'USERS\']}', 'Skin Update Required', $row2['template_html']);
						$skinsupdated .= $row['skin_name'] . " Modified: " . $row2['template_name'] . "<br />";
						$this->db->query("UPDATE %ptemplates SET template_html='%s' WHERE template_skin='%s' AND template_name='%s'",
							$row2['template_html'], $skin, $row2['template_name']);
					}
				}
			}

			// New fields in forum tables need to be fixed in case the old install was a conversion
			$this->updateForumTrees();
			$this->RecountForums();
			
			// Check if new permissions need to be added
			if (!empty($new_permissions)) {
				foreach ($new_permissions as $id => $default)
				{
					// Groups
					while ($this->perms->get_group())
					{
						$perm_on = $default;
						if ($this->perms->auth('is_admin')) $perm_on = true;
						if (!$this->perms->auth('do_anything')) $perm_on = false;
						if ($this->perms->is_guest) $perm_on = false;
						$this->perms->add_perm($id, $perm_on);
						$this->perms->update();
					}
			
					// Users
					while ($this->perms->get_group(true))
					{
						$perm_on = $default;
						if ($this->perms->auth('is_admin')) $perm_on = true;
						if (!$this->perms->auth('do_anything')) $perm_on = false;
						if ($this->perms->is_guest) $perm_on = false;
						$this->perms->add_perm($id, $perm_on);
						$this->perms->update();
					}
				}
			}

			// Check if new file permissions need to be added
			if (!empty($new_file_perms)) {
				foreach ($new_file_perms as $id => $default)
				{
					// Groups
					while ($this->file_perms->get_group())
					{
						$perm_on = $default;
						$this->file_perms->add_perm($id, $perm_on);
						$this->file_perms->update();
					}
			
					// Users
					while ($this->file_perms->get_group(true))
					{
						$perm_on = $default;
						$this->file_perms->add_perm($id, $perm_on);
						$this->file_perms->update();
					}
				}
			}

			$this->sets['app_version'] = $this->version;
			$this->write_sets();

			$message ='';
			if ($didsomething) {
				$message = $skinsupdated . "</span>";
			}
			echo "$message
			  <div class='title' style='text-align:center'>Upgrade Successful</div>
			  <a href='../index.php'>Go to your site.</a>
			 </div>";
			break;
		}
	}
}
?>