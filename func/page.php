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
 * Custom pages code. Lightweight CMS.
 *
 * @author Kiasyn
 * @since 1.3.1
 **/
class page extends qsfglobal
{
	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->self ) : $this->lang->board_noview
			);
		}

		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		if( !isset( $this->get['p'] ) ) {
			$p = 0;
		} else {
			$p = intval( $this->get['p'] );
			if( $p < 0 ) {
				$p = 0;
			}
		}

		switch( $this->get['s'] )
		{
			case 'create': return $this->create_page();	break;
			case 'edit':   return $this->edit_page( $p );	break;
			case 'delete': return $this->delete_page( $p );	break;
		}

		if( $p ) // Specific page asked for
			return $this->view_page( $p );

		$this->set_title( $this->lang->pages );
		$this->tree( $this->lang->pages );

		$result = $this->db->query( "SELECT page_id, page_title, page_contents FROM %ppages" );

		$xtpl = new XTemplate( './skins/' . $this->skin . '/page.xtpl' );

		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'loc_of_board', $this->sets['loc_of_board'] );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'pages', $this->lang->pages );

		if( $this->db->num_rows( $result ) == 0 ) {
			$xtpl->assign( 'pages_none', $this->lang->pages_none );

			if( $this->perms->auth( 'page_create' ) ) {
				$xtpl->assign( 'page_create2', $this->lang->page_create2 );

				$xtpl->parse( 'PagesNone.CreateLink' );
			}

			$xtpl->parse( 'PagesNone' );
			return $xtpl->text( 'PagesNone' );
		}

		while( $page = $this->db->nqfetch( $result ) )
		{
			$param = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_MBCODE | FORMAT_EMOTICONS;
			$page['page_title'] = $this->format( $page['page_title'], $param );

			$xtpl->assign( 'page_id', $page['page_id'] );
			$xtpl->assign( 'page_title', $page['page_title'] );

			$xtpl->parse( 'PagesList.Page' );
		}

		if( $this->perms->auth( 'page_create' ) ) {
			$xtpl->assign( 'page_create2', $this->lang->page_create2 );

			$xtpl->parse( 'PagesList.CreateLink' );
		}

		$xtpl->parse( 'PagesList' );
		return $xtpl->text( 'PagesList' );
	}

	private function view_page( $p )
	{
		$this->tree( $this->lang->pages, "$this->self?a=page" );

		$page = $this->db->fetch( "SELECT page_id, page_title, page_contents, page_flags FROM %ppages WHERE page_id=%d", $p );

		if( $page ) {
			$this->tree( $page['page_title'] );
			$this->set_title( $page['page_title'] );

			$param = FORMAT_HTMLCHARS | FORMAT_CENSOR;
			$page['page_title'] = $this->format( $page['page_title'], $param );

			// This may seem a bit confusing, but it works. The page edit option "Format HTML" is really telling the code the opposite, so it needs to be flipped here.
			if( $page['page_flags'] & FORMAT_HTMLCHARS )
				$page['page_flags'] = $page['page_flags'] ^ FORMAT_HTMLCHARS;
			else
				$page['page_flags'] = $page['page_flags'] | FORMAT_HTMLCHARS;

			$page['page_contents'] = $this->format( $page['page_contents'], $page['page_flags'] );
		} else {
			$this->set_title( $this->lang->page_viewing );
			$this->tree( $this->lang->page_viewing );

			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->page, $this->lang->page_not_exist );
		}

		$xtpl = new XTemplate( './skins/' . $this->skin . '/page.xtpl' );

		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'page_title', $page['page_title'] );
		$xtpl->assign( 'page_contents', $page['page_contents'] );

		if( $this->perms->auth( 'page_create' ) ) {
			$xtpl->assign( 'page_create2', $this->lang->page_create2 );

			$xtpl->parse( 'PagesPage.CreateLink' );
		}

		if( $this->perms->auth( 'page_edit' ) ) {
			$xtpl->assign( 'edit', $this->lang->edit );
			$xtpl->assign( 'p', $p );

			$xtpl->parse( 'PagesPage.EditLink' );
		}

		if( $this->perms->auth( 'page_delete' ) ) {
			$xtpl->assign( 'delete', $this->lang->delete );
			$xtpl->assign( 'p', $p );

			$xtpl->parse( 'PagesPage.DeleteLink' );
		}

		$xtpl->parse( 'PagesPage' );
		return $xtpl->text( 'PagesPage' );
	}

	private function edit_page( $p )
	{
		if( !$this->perms->auth( 'page_edit' ) )
			return $this->message( $this->lang->page_action_not_allowed, $this->lang->page_edit_not_permitted );

		$this->set_title( $this->lang->page_editing );
		$this->tree( $this->lang->pages, "$this->self?a=page" );
		$this->tree( $this->lang->page_editing );
		
		$page = $this->db->fetch( "SELECT page_id as id, page_title as title, page_contents as contents, page_flags as flags FROM %ppages
			WHERE page_id=%d", $p );

		if( !$page ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->page_editing, $this->lang->page_not_exist );
		}

		$bb = FORMAT_MBCODE;
		$em = FORMAT_EMOTICONS;
		$cn = FORMAT_CENSOR;
		$nl = FORMAT_BREAKS;
		$html = FORMAT_HTMLCHARS;

		$bbbox = $page['flags'] & FORMAT_MBCODE ? " checked=\"checked\"" : null;
		$embox = $page['flags'] & FORMAT_EMOTICONS ? " checked=\"checked\"" : null;
		$cnbox = $page['flags'] & FORMAT_CENSOR ? " checked=\"checked\"" : null;
		$nlbox = $page['flags'] & FORMAT_BREAKS ? " checked=\"checked\"" : null;
		$htmlbox = $page['flags'] & FORMAT_HTMLCHARS ? " checked=\"checked\"" : null;

		if( !isset( $this->post['submit'] ) ) {
			$xtpl = new XTemplate( './skins/' . $this->skin . '/page.xtpl' );

			$xtpl->assign( 'self', $this->self );
			$xtpl->assign( 'loc_of_board', $this->sets['loc_of_board'] );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'p', $p );
			$xtpl->assign( 'page_edit', $this->lang->page_edit );
			$xtpl->assign( 'page_title', $this->lang->page_title );
			$xtpl->assign( 'title', $page['title'] );
			$xtpl->assign( 'page_contents', $this->lang->page_contents );
			$xtpl->assign( 'contents', $page['contents'] );
			$xtpl->assign( 'html', $html );
			$xtpl->assign( 'bb', $bb );
			$xtpl->assign( 'em', $em );
			$xtpl->assign( 'cn', $cn );
			$xtpl->assign( 'nl', $nl );
			$xtpl->assign( 'bbbox', $bbbox );
			$xtpl->assign( 'embox', $embox );
			$xtpl->assign( 'cnbox', $cnbox );
			$xtpl->assign( 'nlbox', $nlbox );
			$xtpl->assign( 'htmlbox', $htmlbox );
			$xtpl->assign( 'page_format_html', $this->lang->page_format_html );
			$xtpl->assign( 'page_format_bbcode', $this->lang->page_format_bbcode );
			$xtpl->assign( 'page_format_emoticons', $this->lang->page_format_emoticons );
			$xtpl->assign( 'page_format_breaks', $this->lang->page_format_breaks );
			$xtpl->assign( 'page_format_censor', $this->lang->page_format_censor );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'PagesEdit' );
			return $xtpl->text( 'PagesEdit' );
		}

		if( !$this->is_valid_token() ) {
			return $this->message( $this->lang->page_editing, $this->lang->invalid_token );
		}

		$flags = 0;
		if( isset( $this->post['flags'] ) )
			foreach( $this->post['flags'] as $flag )
				$flags |= intval( $flag );

		$this->db->query( "UPDATE %ppages SET page_title='%s', page_contents='%s', page_flags=%d WHERE page_id=%d",
			$this->post['title'], $this->post['contents'], $flags, $p );

		return $this->message( $this->lang->page_editing, $this->lang->page_edit_done, $this->lang->continue, "{$this->self}?a=page&amp;p={$p}" );
	}

	private function create_page()
	{
		if( !$this->perms->auth('page_create') )
			return $this->message( $this->lang->page_action_not_allowed, $this->lang->page_create_not_permitted );

		$this->set_title( $this->lang->page_creating );
		$this->tree( $this->lang->pages, "$this->self?a=page" );
		$this->tree( $this->lang->page_creating );

		$bb = FORMAT_MBCODE;
		$em = FORMAT_EMOTICONS;
		$cn = FORMAT_CENSOR;
		$nl = FORMAT_BREAKS;
		$html = FORMAT_HTMLCHARS;

		if( !isset( $this->post['submit'] ) ) {
			$xtpl = new XTemplate( './skins/' . $this->skin . '/page.xtpl' );

			$xtpl->assign( 'self', $this->self );
			$xtpl->assign( 'loc_of_board', $this->sets['loc_of_board'] );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'page_create', $this->lang->page_create );
			$xtpl->assign( 'page_title', $this->lang->page_title );
			$xtpl->assign( 'page_contents', $this->lang->page_contents );
			$xtpl->assign( 'page_format_html', $this->lang->page_format_html );
			$xtpl->assign( 'page_format_bbcode', $this->lang->page_format_bbcode );
			$xtpl->assign( 'page_format_emoticons', $this->lang->page_format_emoticons );
			$xtpl->assign( 'page_format_breaks', $this->lang->page_format_breaks );
			$xtpl->assign( 'page_format_censor', $this->lang->page_format_censor );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'PagesCreate' );
			return $xtpl->text( 'PagesCreate' );
		}

		if( !$this->is_valid_token() ) {
			return $this->message( $this->lang->page_creating, $this->lang->invalid_token );
		}

		$flags = 0;
		if( isset( $this->post['flags'] ) )
			foreach( $this->post['flags'] as $flag )
				$flags |= intval( $flag );

		$this->db->query( "INSERT INTO %ppages (page_title,page_contents,page_flags) VALUES('%s', '%s', %d)", $this->post['title'], $this->post['contents'], $flags );
		$p = $this->db->insert_id( "%ppages" );

		return $this->message( $this->lang->page_creating, $this->lang->page_created, $this->lang->continue, "{$this->self}?a=page&amp;p={$p}" );
	}

	private function delete_page( $p )
	{
		if( !$this->perms->auth( 'page_delete' ) )
			return $this->message( $this->lang->page_action_not_allowed, $this->lang->page_delete_not_permitted );

		$this->set_title( $this->lang->page_delete );
		$this->tree( $this->lang->pages, "$this->self?a=page" );
		$this->tree( $this->lang->page_delete );

		$page = $this->db->fetch( "SELECT page_id FROM %ppages WHERE page_id=%d", $p );

		if( !$page ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->page_delete, $this->lang->page_not_exist );
		}

		if( !isset( $this->get['confirm'] ) )
			return $this->message( $this->lang->page_delete, $this->lang->page_delete_confirm, $this->lang->continue, "{$this->self}?a=page&amp;p={$p}&amp;&amp;s=delete&amp;confirm=1" );

		$this->db->query( "DELETE FROM %ppages WHERE page_id=%d", $p );
		return $this->message( $this->lang->page_delete, $this->lang->page_deleted, $this->lang->continue, "$this->self?a=page" );
	}
}
?>