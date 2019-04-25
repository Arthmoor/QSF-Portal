<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2019 The QSF Portal Development Team
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

if( !defined( 'QUICKSILVERFORUMS' ) || !defined( 'QSF_ADMIN' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';

/**
 * Query Interface
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since RC1
 **/
class query extends admin
{
	/**
	 * Query Interface
	 *
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since RC1
	 * @return string HTML
	 **/
	public function execute()
	{
		$this->set_title( $this->lang->query );
		$this->tree( $this->lang->query );

		if( !isset( $this->post['submit'] ) ) {
			$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/query.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'query', $this->lang->query );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'Query' );

			return $xtpl->text( 'Query' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->query, $this->lang->invalid_token );
			}

			$result = $this->db->query( $this->post['sql'] );

			if( $result ) {
				$sql = htmlspecialchars( $this->post['sql'] );
				$show_headers = true;

				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/query.xtpl' );

				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'skin', $this->skin );
				$xtpl->assign( 'query', $this->lang->query );

				$xtpl->assign( 'token', $this->generate_token() );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'Query' );

				$out = $xtpl->text( 'Query' );

				$out .= '<div class="article">';

				while( $row = $this->db->nqfetch( $result ) )
				{
					if( $show_headers ) {
						$out .= "<span class=\"head\">\n";

						foreach( $row as $col => $data )
						{
							$out .= "<span class='starter'>$col</span>\n";
						}

						$out .= "</span>\n<p></p>";

						$show_headers = false;
					}

					foreach( $row as $col => $data )
					{
						$out .= "<span class='starter'>" . $this->format($data, FORMAT_HTMLCHARS) . "</span>\n";
					}
					$out .= "<p class='list_line'></p>\n";
				}
				return $out . '</div>';
			} else {
				return $this->message( $this->lang->query, $this->lang->query_your . ' ' . ($result ? $this->lang->query_success : $this->lang->query_failed) );
			}
		}
	}
}
?>