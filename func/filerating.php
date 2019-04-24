<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2019 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
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
 * File Ratings
 *
 * @author Roger Libiez
 **/
class filerating extends qsfglobal
{
        /**
         * Main interface. Process display after clicking on a "rating" link.
         *
         **/
        function execute()
        {
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->site ) : $this->lang->board_noview );
		}

                $this->nohtml = true;

		$this->lang->files();

		if( !isset( $this->get['f'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->files_rate, $this->lang->files_rate_valid );
		}

		$xtpl = new XTemplate( './skins/' . $this->skin . '/filerating.xtpl' );

		$xtpl->assign( 'language', $this->user['user_language'] );
		$xtpl->assign( 'charset', $this->lang->charset );
		$xtpl->assign( 'files_rate', $this->lang->files_rate );
		$xtpl->assign( 'files_close_window', $this->lang->files_close_window );

		if( !isset( $this->post['rate'] ) ) {
			$file_rated = $this->db->fetch( "SELECT file_id FROM %pfileratings WHERE user_id=%d AND file_id=%d", $this->user['user_id'], $this->get['f'] );

			if( $file_rated['file_id'] != $this->get['f'] ) {
				$xtpl->assign( 'self', $this->self );
				$xtpl->assign( 'skin', $this->skin );
				$xtpl->assign( 'f', $this->get['f'] );
				$xtpl->assign( 'files_rate_please', $this->lang->files_rate_please );
				$xtpl->assign( 'files_rate_sucks', $this->lang->files_rate_sucks );
				$xtpl->assign( 'files_rate_poor', $this->lang->files_rate_poor );
				$xtpl->assign( 'files_rate_average', $this->lang->files_rate_average );
				$xtpl->assign( 'files_rate_good', $this->lang->files_rate_good );
				$xtpl->assign( 'files_rate_excellent', $this->lang->files_rate_excellent );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'FileRating.RateForm' );
			}
			else {
				$xtpl->assign( 'other', $this->lang->files_rate_already );

				$xtpl->parse( 'FileRating.Other' );
			}
		}
		else {
			$file = $this->db->fetch( "SELECT file_rating_total, file_rating_votes FROM %pfiles WHERE file_id=%d", $this->get['f'] );

			$votes = $file['file_rating_votes'] + 1;
			$newrate = ( $file['file_rating_total'] + $this->post['rate'] ) / $votes;

			$this->db->query( "INSERT INTO %pfileratings (user_id, file_id) VALUES( %d, %d )", $this->user['user_id'], $this->get['f'] );

			$this->db->query( "UPDATE %pfiles SET file_rating_total=%d, file_rating_votes=%d, file_rating=%d WHERE file_id=%d",
				$file['file_rating_total'] + $this->post['rate'], $votes, $newrate, $this->get['f'] );

			$xtpl->assign( 'other', $this->lang->files_rate_thank );

			$xtpl->parse( 'FileRating.Other' );
		}

		$xtpl->parse( 'FileRating' );
		return $xtpl->text( 'FileRating' );
        }
}
?>