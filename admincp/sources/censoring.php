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

if( !defined( 'QUICKSILVERFORUMS') || !defined('QSF_ADMIN' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

/**
 * Word censoring controls
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 3.0
 **/
class censoring extends admin
{
	/**
	 * Provides controls for censoring words
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 3.0
	 * @return string HTML form or message
	 **/
	public function execute()
	{
		$this->set_title( $this->lang->censor );
		$this->tree( $this->lang->censor );

		if( !isset( $this->post['submit'] ) ) {
			$words = null;
			$token = $this->generate_token();

			$query = $this->db->query( 'SELECT * FROM %preplacements ORDER BY replacement_id' );
			while( $word = $this->db->nqfetch( $query ) )
			{
				$words .= str_replace( '(.*?)', '*', $word['replacement_search'] ) . "\n";
			}

			$words = rtrim( $words );

			$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/censor.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'censor', $this->lang->censor );
			$xtpl->assign( 'censor_one_per_line', $this->lang->censor_one_per_line );
			$xtpl->assign( 'censor_regex_allowed', $this->lang->censor_regex_allowed );
			$xtpl->assign( 'words', $words );
			$xtpl->assign( 'submit', $this->lang->submit );
			$xtpl->assign( 'token', $this->generate_token() );

			$xtpl->parse( 'Censor' );
			return $xtpl->text( 'Censor' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->censor, $this->lang->invalid_token );
			}

			$words = preg_replace( '/[^a-zA-Z0-9\s\*"\'=]/', '', $this->post['words'] );
			$words = str_replace( '*', '(.*?)', $words );
			$words = explode( "\n", $words );

			$this->db->query( 'TRUNCATE TABLE %preplacements' );

         $word_query = $this->db->prepare_query( 'INSERT INTO %preplacements (replacement_search) VALUES ( ? )' );
         $word_query->bind_param( 's', $word );

			foreach( $words as $word )
			{
				$word = trim( $word );
				if( $word ) {
               $this->db->execute_query( $word_query );
				}
			}
         $word_query->close();

			return $this->message( $this->lang->censor, $this->lang->censor_updated );
		}
	}
}
?>