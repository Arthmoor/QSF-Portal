<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005 The Quicksilver Forums Development Team
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

if (!defined('QUICKSILVERFORUMS') || !defined('QSF_ADMIN')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';
require_once $set['include_path'] . '/lib/packageutil.php';

/**
 * Database backup
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since 1.0.2
 **/
class backup extends admin
{
	var $tables = array(
		'active',
		'attach',
		'forums',
		'groups',
		'help',
		'logs',
		'membertitles',
		'pmsystem',
		'posts',
		'readmarks',
		'replacements',
		'settings',
		'skins',
		'subscriptions',
		'topics',
		'users',
		'votes'
	);

	/**
	 * Database backup
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.0.2
	 * @return string HTML
	 **/
	function execute()
	{
		if (!isset($this->get['s'])) {
			$this->get['s'] = '';
		}

		switch($this->get['s'])
		{
		case 'create':
			$this->set_title($this->lang->backup_create);
			$this->tree($this->lang->backup_create);

			return $this->create_backup();
			break;

		case 'restore':
			$this->set_title($this->lang->backup_restore);
			$this->tree($this->lang->backup_restore);

			return $this->restore_backup();
			break;
		}
	}

	/**
	 * Generate a backup
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.0.2
	 * @return string HTML
	 **/
	function create_backup()
	{
		if (!isset($this->get['option'])) {
			return $this->message($this->lang->backup_options, "<ul>
				<li><a href=\"{$this->self}?a=backup&amp;s=create&amp;option=download\">{$this->lang->backup_download}</a></li>
				<li><a href=\"{$this->self}?a=backup&amp;s=create&amp;option=file\">{$this->lang->backup_createfile}</a></li>
				</ul>");
		} else if ($this->get['option'] == 'download') {
			$this->nohtml = true;
			$fullBackupName = "backup_" . $this->version . "-" . date('y-m-d-H-i-s');
	
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"$fullBackupName.xml\"");
			
			echo "<?xml version='1.0' encoding='utf-8'?>\n";
			echo "<qsfmod>\n";
			echo "  <title>Backup: " . $this->version . " - " . date('y-m-d-H-i-s') . "</title>\n";
			echo "  <type>backup</type>\n";
			echo "  <version>{$this->version}-" . date('y-m-d-H-i-s') . "</version>\n";
			echo "  <description></description>\n";
			echo "  <authorname>Backup Tool</authorname>\n";
			echo "  <files>\n";
			echo "    <file>packages/$fullBackupName.xml</file>\n";
			echo "  </files>\n";
			echo "  <templates>\n";
			echo "  </templates>\n";
			echo "  <install>\n";
			$this->create_dump($this->tables);
			echo "  </install>\n";
			echo "  <uninstall>\n";
			$this->create_truncate($this->tables);
			echo "  </uninstall>\n";
			echo "</qsfmod>\n";
			
		} else if ($this->get['option'] == 'file') {
			$fullBackupName = "backup_" . $this->version . "-" . date('y-m-d-H-i-s');

			if (file_exists("../packages/$fullBackupName.xml")) {
				die("../packages/$fullBackupName.xml already exists!");
			}
			
			$xmlFile = fopen("../packages/$fullBackupName.xml", 'w');
			
			if ($xmlFile === false) {
				return $this->message($this->lang->backup_create, "Error: Could not open file ../packages/$fullBackupName.xml for writing");
			}
			
			fwrite($xmlFile, "<?xml version='1.0' encoding='utf-8'?>\n");
			fwrite($xmlFile, "<qsfmod>\n");
			fwrite($xmlFile, "  <title>Backup: " . $this->version . " - " . date('y-m-d-H-i-s') . "</title>\n");
			fwrite($xmlFile, "  <type>backup</type>\n");
			fwrite($xmlFile, "  <version>{$this->version}-" . date('y-m-d-H-i-s') . "</version>\n");
			fwrite($xmlFile, "  <description></description>\n");
			fwrite($xmlFile, "  <authorname>Backup Tool</authorname>\n");
			fwrite($xmlFile, "  <files>\n");
			fwrite($xmlFile, "    <file>packages/$fullBackupName.xml</file>\n");
			fwrite($xmlFile, "  </files>\n");
			fwrite($xmlFile, "  <templates>\n");
			fwrite($xmlFile, "  </templates>\n");
			fwrite($xmlFile, "  <install>\n");
			$this->create_dump($this->tables, $xmlFile);
			fwrite($xmlFile, "  </install>\n");
			fwrite($xmlFile, "  <uninstall>\n");
			$this->create_truncate($this->tables, $xmlFile);
			fwrite($xmlFile, "  </uninstall>\n");
			fwrite($xmlFile, "</qsfmod>\n");

			fclose($xmlFile);
						
			$tarTool = new archive_tar();
			$tarTool->open_file_writer("../packages/$fullBackupName", true);
			$tarTool->add_as_file("packages/$fullBackupName.xml", 'package.txt');
			$tarTool->add_file("../packages/$fullBackupName.xml", "packages/$fullBackupName.xml");
			$filename = $tarTool->close_file();
			
			@unlink("../packages/$fullBackupName.xml");
			
			$this->chmod($filename, 0777);
			
			return $this->message($this->lang->backup_create, $this->lang->backup_done, $filename, "../packages/$filename");
		}
	}

	/**
	 * Restore a backup
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since 1.0.2
	 * @return string HTML
	 **/
	function restore_backup()
	{
		if (!isset($this->get['restore'])) {
			$tarTool = new archive_tar();

			$xmlInfo = new xmlparser();

			$new_backup_box = '';

			$packages = packageutil::scan_packages();

			foreach ($packages as $package) {
				if ($package['type'] != 'backup')
					continue; // skip other mods

				$new_backup_box .= "  <li><a href=\"{$this->self}?a=backup&amp;s=restore&amp;restore=";

				if (strtolower(substr($package['file'], -7)) == '.tar.gz')
				{
					$new_backup_box .= urlencode(substr($package['file'], 0, -7)) . "\" ";
				}
				else
				{
					$new_backup_box .= urlencode(substr($package['file'], 0, -4)) . "\" ";
				}

				if ($package['desc'])
					$new_backup_box .= "title=\"" . htmlspecialchars($package['desc']) . "\"";

				$new_backup_box .= ">";

				$new_backup_box .= "<strong>" . htmlspecialchars($package['title']) . "</strong></a>";
				$new_backup_box .= " " . htmlspecialchars($package['version']);
				$new_backup_box .= " (" . htmlspecialchars($package['author']) . ")";

				$new_backup_box .= "</li>\n";
			}

			if ($new_backup_box) {
				return $this->message($this->lang->backup_restore, "
				<div>
					{$this->lang->backup_found}:<br /><br />
					$new_backup_box
					
					<b>{$this->lang->backup_warning}</b>
				</div>");
			} else {
				return $this->message($this->lang->backup_restore, $this->lang->backup_none);
			}
		} else {
			$tarTool = new archive_tar();

			// Open and parse the XML file
			$xmlInfo = new xmlparser();

			if (file_exists('../packages/' . $this->get['restore'] . '.xml'))
			{
				$xmlInfo->parse('../packages/' . $this->get['restore'] . '.xml');
			}
			else if (file_exists('../packages/' . $this->get['restore'] . '.tar'))
			{
				$tarTool->open_file_reader('../packages/' . $this->get['restore'] . '.tar');

				$xmlFilename = $tarTool->extract_file('package.txt');
				
				$xmlInfo->parseTar($tarTool, $xmlFilename);
			}
			else if (file_exists('../packages/' . $this->get['restore'] . '.tar.gz')
				&& $tarTool->can_gunzip())
			{
				$tarTool->open_file_reader('../packages/' . $this->get['restore'] . '.tar.gz');

				$xmlFilename = $tarTool->extract_file('package.txt');
				
				$xmlInfo->parseTar($tarTool, $xmlFilename);
			}
			else
			{
				return $this->message($this->lang->backup_restore, $this->lang->backup_invalid);
			}

			// Run the uninstall queries
			packageutil::run_queries($this->db, $xmlInfo->GetNodeByPath('QSFMOD/UNINSTALL'));

			// Run the install queries
			packageutil::run_queries($this->db, $xmlInfo->GetNodeByPath('QSFMOD/INSTALL'));

			// Done!
			return $this->message($this->lang->backup_restore, $this->lang->backup_restore_done);
		}
	}

	
	/**
	 * Dumps a database
	 *
	 * @param array $tables Array of table names
	 * @param bool $fileHandle Open file to write to. If false then echo data
	 * @since 1.3.1
	 **/
	function create_dump($tables, $fileHandle = false) {
		foreach ($tables as $table)
		{
			$query = $this->db->query("SELECT * FROM %p$table");
			while ($row = $this->db->nqfetch($query))
			{
				$insert_keys = array_keys($row);
				$columns = count($insert_keys);
				
				$sql = "INSERT INTO %p$table ";
				$sql .= '(' . implode(', ', $insert_keys) .') VALUES';
				$sql .= '(' . implode(', ', array_fill(0, $columns, "'%s'")) .')';
				
				$xml ="    <query>\n      <sql>$sql</sql>\n";
				foreach ($insert_keys as $key) {
					$xml .= "      <data>" . htmlspecialchars($row[$key]) . "</data>\n";
				}
				$xml .= "    </query>\n";
				
				if ($fileHandle === false) {
					echo $xml;
				} else {
					fwrite($fileHandle, $xml);
				}
			}
		}
	}

	/**
	 * Creates XML formatted queries to truncate tables
	 *
	 * @param array $tables Array of table names
	 * @param bool $fileHandle Open file to write to. If false then echo data
	 * @since 1.3.1
	 **/
	function create_truncate($tables, $fileHandle = false) {
		foreach ($tables as $table)
		{
			$xml = "    <query>\n";
			$xml .= "      <sql>DELETE FROM %p$table</sql>\n";
			$xml .= "    </query>\n";

			if ($fileHandle === false) {
				echo $xml;
			} else {
				fwrite($fileHandle, $xml);
			}
		}
	}
}
?>
