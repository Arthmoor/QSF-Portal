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

/**
 * Show Top 5 Uploaders
 * 
 * @author KingOfSka <kingofska@gmail.com.com>
 * @return string HTML with Top Uploaders and link to their profile
**/
class top_uploaders extends modlet
{
	public function __construct( $forumobject )
	{
		parent::__construct( $forumobject );
	}

	public function execute( $arg )
	{
		$content = '';

		$result = $this->qsf->db->query( "SELECT user_id, user_name, user_uploads FROM %pusers ORDER BY user_uploads DESC LIMIT 5" );

		while( $row = $this->qsf->db->nqfetch( $result ) )
		{
			$user = $row['user_name'];
			$uploads = $row['user_uploads'];
			$uid = $row['user_id'];

			if( $uid == USER_GUEST_UID || $uploads < 1 )
				continue;

			$uPostRef = "<a href=\"{$this->qsf->self}?a=files&amp;s=search&amp;uid={$uid}\">";
			$content .= "<a href=\"{$this->qsf->self}?a=profile&amp;w={$uid}\">{$user}</a> {$uPostRef}($uploads)</a><br />";
		}

		$xtpl = new XTemplate( './skins/' . $this->qsf->skin . '/modlets/top_uploaders.xtpl' );

		$xtpl->assign( 'loc_of_board', $this->qsf->sets['loc_of_board'] );
		$xtpl->assign( 'skin', $this->qsf->skin );
		$xtpl->assign( 'main_top_uploaders', $this->qsf->lang->main_top_uploaders );
		$xtpl->assign( 'content', $content );

		$xtpl->parse( 'TopUploaders' );
		return $xtpl->text( 'TopUploaders' );
	}
}
?>