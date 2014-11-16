<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2008 The QSF Portal Development Team
 * http://www.qsfportal.com/
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
 * Modify the files link with number of pending approvals.
 * This modlet borrows alot of duplicated code from the files.php module.
 *
 * @author Roger Libiez [Samson] http://www.iguanadons.net
 * @since 1.2.2
 **/
class codelink extends modlet
{
	function get_count()
	{
		$count = 0;

		if($this->qsf->perms->auth('is_admin'))
			return $this->qsf->sets['code_approval'];

		if($this->qsf->perms->auth('is_guest'))
			return 0;

		$query = $this->qsf->db->query( "SELECT file_catid FROM %pfiles WHERE file_approved=0" );
		while( $file = $this->qsf->db->nqfetch($query) )
		{
			if( !$this->qsf->file_perms->auth( 'approve_files', $file['file_catid'] ) )
				continue;
			$count++;
		}
		return $count;
	}

	function run($param)
	{
		$text = '';

		$newcount = $this->get_count();

		switch($param)
		{
			case 'class':
				if ($newcount != 0) {
					$text = 'navbold';
				} else {
					$text = 'nav';
				}
			break;

			case 'text':
				if ($newcount != 0) {
					$text = " ({$newcount} {$this->qsf->lang->main_new})";
				}
			break;

			default:
				$text = '<!-- ERROR: Invalid paramter: ' . htmlspecialchars($param) . ' passed to modlet codelink -->';
			break;
		}
		return $text;
	}
}
?>
