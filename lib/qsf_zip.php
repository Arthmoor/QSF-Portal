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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

/**
 * Simplified version of ZipLib
 *
 * @author Bouchon <bouchon@maxg.info>
 * @link http://maxg.info
 * @since 1.0.2
 **/

class qsf_zip
{
	var $datasec = array();
	var $ctrl_dir = array();
	var $old_offset = 0;

	function add($files, $name = '.')
	{
		if (!is_array($files)) {
			$files = array($files);
		}

		foreach ($files as $file)
		{
			if (is_dir($file)) {
				$this->add_dir($name);
				$this->spider($file, $name);
			} else {
				$fp = fopen($file, 'r');
				$this->add_file(fread($fp, filesize($file)), $file);
				fclose($fp);
			}
		}
	}

	function spider($dir, $name)
	{
		$dp = opendir($dir);

		while (($file = readdir($dp)) !== false)
		{
			if (($file == '.') || ($file == '..') || ($file == 'CVS') || ($file{0} == '.')) {
				continue;
			}

			$real_path = $dir . '/' . $file;
			$zip_path = $name . '/' . $file;

			if (is_dir($real_path)) {
				$this->add_dir($zip_path);
				$this->spider($real_path, $zip_path);
			} else {
				$fp = fopen($real_path, 'r');
				if (0 == ($tmp = filesize($real_path))) {
					$this->add_file('', $zip_path);
				} else {
					$this->add_file(fread($fp, $tmp), $zip_path);
				}
				fclose($fp);
			}
		}

		closedir($dp);
	}

	function get_file()
	{
		$data = implode('', $this->datasec);
		$ctrl = implode('', $this->ctrl_dir);

		return
		$data .
		$ctrl .
		"\x50\x4b\x05\x06" .
		"\x00\x00" .
		"\x00\x00" .
		pack('v', count($this->ctrl_dir)) .
		pack('v', count($this->ctrl_dir)) .
		pack('V', strlen($ctrl)) .
		pack('V', strlen($data)) .
		"\x00\x00";
	}

	function add_dir($name)
	{
		$name = str_replace('\\', '/', $name);

		if (substr($name, -1) != '/') {
			$name .= '/';
		}

		$local_header  = "\x50\x4b\x03\x04"; // local file header signature
		$local_header .= "\x0a\x00"; // version needed to extract
		$local_header .= "\x00\x00"; // general purpose bit flag
		$local_header .= "\x00\x00"; // compression method
		$local_header .= "\x00\x00"; // last mod file time
		$local_header .= "\x00\x00"; // last mod file date
		$local_header .= pack('V', 0); // crc-32
		$local_header .= pack('V', 0); // compressed size
		$local_header .= pack('V', 0); // uncompressed size
		$local_header .= pack('v', strlen($name)); // file name length
		$local_header .= pack('v', 0); // extra field length
		$local_header .= $name; // file name

		$central_header  = "\x50\x4b\x01\x02"; // central file header signature
		$central_header .= "\x00\x00"; // version made by
		$central_header .= "\x0a\x00"; // version needed to extract
		$central_header .= "\x00\x00"; // general purpose bit flag
		$central_header .= "\x00\x00"; // compression method
		$central_header .= "\x00\x00"; // last mod file time
		$central_header .= "\x00\x00"; // last mod file date
		$central_header .= pack('V', 0); // crc-32
		$central_header .= pack('V', 0); // compressed size
		$central_header .= pack('V', 0); // uncompressed size
		$central_header .= pack('v', strlen($name)); // file name length
		$central_header .= pack('v', 0); // extra field length
		$central_header .= pack('v', 0); // file comment length
		$central_header .= pack('v', 0); // disk number start
		$central_header .= pack('v', 0); // internal file attributes
		$central_header .= pack('V', 16); // external file attributes
		$central_header .= pack('V', $this->old_offset); // relative offset of local header
		$central_header .= $name; // file name

		$this->old_offset += strlen($local_header);
		$this->datasec[]   = $local_header;
		$this->ctrl_dir[]  = $central_header;
	}

	function add_file($data, $name)
	{
		$name = str_replace('\\', '/', $name);

		$len = strlen($data);
		$crc = crc32($data);

		$local_header  = "\x50\x4b\x03\x04"; // local file header signature
		$local_header .= "\x14\x00"; // version needed to extract
		$local_header .= "\x00\x00"; // general purpose bit flag
		$local_header .= "\x08\x00"; // compression method
		$local_header .= "\x00\x00"; // last mod file time
		$local_header .= "\x00\x00"; // last mod file date
		$local_header .= pack('V', $crc); // crc-32
		$local_header .= pack('V', $len); // compressed size
		$local_header .= pack('V', $len); // uncompressed size
		$local_header .= pack('v', strlen($name)); // file name length
		$local_header .= pack('v', 0); // extra field length
		$local_header .= $name; // file name
		$local_header .= $data; // file data

		$central_header  = "\x50\x4b\x01\x02"; // central file header signature
		$central_header .= "\x00\x00"; // version made by
		$central_header .= "\x14\x00"; // version needed to extract
		$central_header .= "\x00\x00"; // general purpose bit flag
		$central_header .= "\x08\x00"; // compression method
		$central_header .= "\x00\x00"; // last mod file time
		$central_header .= "\x00\x00"; // last mod file date
		$central_header .= pack('V', $crc); // crc-32
		$central_header .= pack('V', $len); // compressed size
		$central_header .= pack('V', $len); // uncompressed size
		$central_header .= pack('v', strlen($name)); // file name length
		$central_header .= pack('v', 0); // extra field length
		$central_header .= pack('v', 0); // file comment length
		$central_header .= pack('v', 0); // disk number start
		$central_header .= pack('v', 32); // internal file attributes
		$central_header .= pack('V', 0); // external file attributes
		$central_header .= pack('V', $this->old_offset); // relative offset of local header
		$central_header .= $name; // file name

		$this->old_offset += strlen($local_header);
		$this->datasec[]   = $local_header;
		$this->ctrl_dir[]  = $central_header;
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

	function extract($zip_name, $to)
	{
		if (substr($to, -1) != '/') {
			$to .= '/';
		}

		if (!is_dir($to)) {
			@mkdir($to,0777);
			@chmod($to,0777);
		}

		$zip  = fopen($zip_name, 'rb');
		$size = filesize($zip_name);
		fseek($zip, $size - 22);

		// End of central dir record
		$data = unpack('Vsig/vdisk/vdisk_start/vdisk_entries/ventries/Vsize/Voffset/vcommentsize', fread($zip, 22));

		rewind($zip);

		for ($i = 0; $i < $data['entries']; $i++)
		{
			// Local file header
			$header = unpack('Vsig/vversion/vflag/vcompression/vmtime/vmdate/Vcrc/Vcompressed_size/Vsize/vfilename_len/vextra_len', fread($zip, 30));

			$header['filename'] = fread($zip, $header['filename_len']);

			if ($header['mdate'] && $header['mtime']) {
				$hour    = ($header['mtime'] & 0xF800) >> 11;
				$minute  = ($header['mtime'] & 0x07E0) >> 5;
				$seconde = ($header['mtime'] & 0x001F) * 2;
				$year    = (($header['mdate'] & 0xFE00) >> 9) + 1980;
				$month   = ($header['mdate'] & 0x01E0) >> 5;
				$day     = $header['mdate'] & 0x001F;

				$header['mtime'] = mktime($hour, $minute, $seconde, $month, $day, $year);
			} else {
				$header['mtime'] = time();
			}

			if ((substr($header['filename'], -1) == '/') || ($header['filename'] == '.') || ($header['filename'] == '..')) {
				if (!is_dir($to . $header['filename'])) {
					mkdir($to . $header['filename']);
					$this->chmod($to . $header['filename'],0777);
				}

				continue;
			}

			$this->chmod($to . $header['filename'], 0777);
			$fp = fopen($to . $header['filename'], 'wb');

			while ($header['compressed_size'])
			{
				if ($header['compressed_size'] < 2048) {
					$read_size = $header['compressed_size'];
				} else {
					$read_size = 2048;
				}

				$binary_data = pack('a' . $read_size, fread($zip, $read_size));
				fwrite($fp, $binary_data, $read_size);
				$header['compressed_size'] -= $read_size;
			}

			fclose($fp);
			touch($to . $header['filename'], $header['mtime']);
		}

		fclose($zip);
	}

	function write_zip($destination)
	{
		$fp = fopen($destination, 'wb');
		fwrite($fp, $this->get_file());
		fclose($fp);
	}
}
?>
