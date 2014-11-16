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

require_once $set['include_path'] . '/global.php';

/**
 * File Ratings
 *
 * @author Roger Libiez (Samson) <samson@afkmud.com>
 **/
class filerating extends qsfglobal
{
        /**
         * Main interface. Process display after clicking on a "rating" link.
         *
         **/
        function execute()
        {
		$this->templater->add_templates('Files');

                $this->nohtml = true;
                $this->templater->debug_mode = false; // This is a stripped pop-up window.
		$rating = "";

		if (!isset($this->get['f'])) {
			return $this->qsf->message("Rate File", "You must provide a valid file.");
		}

		if (!isset($this->post['rate'])) {
			$file_rated = $this->db->fetch( "SELECT file_id FROM %pfileratings WHERE user_id=%d AND file_id=%d", $this->user['user_id'], $this->get['f'] );

			if( $file_rated['file_id'] != $this->get['f'] ) {
				$rating .= "<body><form action=\"{$this->self}?a=filerating&amp;f={$this->get['f']}\" method=\"post\"><div>
					Please rate this code:<br /><br />
					<select name=\"rate\">
						<option value=\"1\">1 - Sucks!</option>
						<option value=\"2\">2 - Poor</option>
						<option value=\"3\">3 - Average</option>
						<option value=\"4\">4 - Good</option>
						<option value=\"5\" selected=\"selected\">5 - Excellent!</option>
					</select>
					<input type=\"submit\" value=\"{$this->lang->submit}\" /></div>
				</form></body></html>";
			}
			else {
				$rating .= "You have already rated this code.";
			}
		}
		else {
			$file = $this->db->fetch( "SELECT file_rating_total, file_rating_votes FROM %pfiles WHERE file_id=%d", $this->get['f'] );

			$votes = $file['file_rating_votes'] + 1;
			$newrate = ( $file['file_rating_total'] + $this->post['rate'] ) / $votes;

			$this->db->query( "INSERT INTO %pfileratings (user_id, file_id) VALUES( %d, %d )", $this->user['user_id'], $this->get['f'] );

			$this->db->query( "UPDATE %pfiles SET file_rating_total=%d, file_rating_votes=%d, file_rating=%d WHERE file_id=%d",
				$file['file_rating_total'] + $this->post['rate'], $votes, $newrate, $this->get['f'] );

			$rating .= "Thank you for rating this code.";
		}
		return eval($this->template('FILE_RATING'));
        }
}
?>
