<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2010 The QSF Portal Development Team
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

require_once $set['include_path'] . '/global.php';

/**
 * File Ratings
 *
 * @author Roger Libiez [Samson] http://www.iguanadons.net
 **/
class filerating extends qsfglobal
{
        /**
         * Main interface. Process display after clicking on a "rating" link.
         *
         **/
        function execute()
        {
		if (!$this->perms->auth('board_view')) {
			$this->lang->board();
			return $this->message(
				sprintf($this->lang->board_message, $this->sets['forum_name']),
				($this->perms->is_guest) ? sprintf($this->lang->board_regfirst, $this->self) : $this->lang->board_noview
			);
		}

		$this->templater->add_templates('Files');
		$this->lang->files();

                $this->nohtml = true;
                $this->templater->debug_mode = false; // This is a stripped pop-up window.
		$rating = "";

		if (!isset($this->get['f'])) {
			header('HTTP/1.0 404 Not Found');
			return $this->message($this->lang->files_rate, $this->lang->files_rate_valid);
		}

		if (!isset($this->post['rate'])) {
			$file_rated = $this->db->fetch( "SELECT file_id FROM %pfileratings WHERE user_id=%d AND file_id=%d", $this->user['user_id'], $this->get['f'] );

			if( $file_rated['file_id'] != $this->get['f'] ) {
				$rating .= "<body><form action=\"{$this->self}?a=filerating&amp;f={$this->get['f']}\" method=\"post\"><div>
					{$this->lang->files_rate_please}:<br /><br />
					<select name=\"rate\">
						<option value=\"1\">1 - {$this->lang->files_rate_sucks}</option>
						<option value=\"2\">2 - {$this->lang->files_rate_poor}</option>
						<option value=\"3\">3 - {$this->lang->files_rate_average}</option>
						<option value=\"4\">4 - {$this->lang->files_rate_good}</option>
						<option value=\"5\" selected=\"selected\">5 - {$this->lang->files_rate_excellent}</option>
					</select>
					<input type=\"submit\" value=\"{$this->lang->submit}\" /></div>
				</form></body></html>";
			}
			else {
				$rating .= $this->lang->files_rate_already;
			}
		}
		else {
			$file = $this->db->fetch( "SELECT file_rating_total, file_rating_votes FROM %pfiles WHERE file_id=%d", $this->get['f'] );

			$votes = $file['file_rating_votes'] + 1;
			$newrate = ( $file['file_rating_total'] + $this->post['rate'] ) / $votes;

			$this->db->query( "INSERT INTO %pfileratings (user_id, file_id) VALUES( %d, %d )", $this->user['user_id'], $this->get['f'] );

			$this->db->query( "UPDATE %pfiles SET file_rating_total=%d, file_rating_votes=%d, file_rating=%d WHERE file_id=%d",
				$file['file_rating_total'] + $this->post['rate'], $votes, $newrate, $this->get['f'] );

			$rating .= $this->lang->files_rate_thank;
		}
		return eval($this->template('FILE_RATING'));
        }
}
?>
