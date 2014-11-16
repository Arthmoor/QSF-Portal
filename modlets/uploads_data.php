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
 * Add user upload data to profile view
 * 
 * @author Roger Libiez [Samson] http://www.iguanadons.net
**/
class uploads_data extends modlet
{
	function run($uid)
	{
		$user = $this->qsf->db->fetch( "SELECT user_uploads, user_joined FROM %pusers WHERE user_id=%d", $uid );

		if( $user['user_uploads'] ) {
			$last = $this->qsf->db->fetch( "SELECT file_id, file_name, file_date FROM %pfiles
				WHERE file_submitted=%d ORDER BY file_date DESC LIMIT 1", $uid );

			$lastfile = $this->qsf->lang->profile_uploads_none_yet;
			if(isset($last['file_id'])) {
				$date = $this->qsf->mbdate(DATE_LONG, $last['file_date']);
				$lastfile = "<a href=\"{$this->qsf->self}?a=files&amp;s=viewfile&amp;fid={$last['file_id']}\" rel=\"nofollow\">{$last['file_name']}</a><br />{$date}";
			}

			$usetime = ( ( ( $this->qsf->time - $user['user_joined'] ) / 86400 ) );
			if( $usetime < 1 ) {
				$usetime = 1;
			}
			$uploadsPerDay = $user['user_uploads'] / $usetime;
			$uploadsPerDay = number_format($uploadsPerDay, 2, $this->qsf->lang->sep_decimals, $this->qsf->lang->sep_thousands);
			$uploads = "<a href=\"{$this->qsf->self}?a=files&amp;s=search&amp;uid={$uid}\" rel=\"nofollow\">{$user['user_uploads']} {$this->qsf->lang->profile_uploads_total}, {$uploadsPerDay} {$this->qsf->lang->profile_uploads_per_day}</a>";

			return eval($this->qsf->template('PROFILE_UPLOADS'));
		} else {
			return "";
		}
	}
}
?>
