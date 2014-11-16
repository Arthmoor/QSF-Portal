<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2007 The QSF Portal Development Team
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

if (!defined('QUICKSILVERFORUMS') && !defined('QSF_ADMIN') ) {
	header('HTTP/1.0 403 Forbidden');
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
	function execute()
	{
		if (!isset($this->get['s'])) {
			$this->get['s'] = null;
		}

		if (!isset($this->get['p'])) {
			$p = 0;
		} else {
			$p = intval( $this->get['p'] );
			if ($p < 0) {
				$p = 0;
			}
		}

		switch( $this->get['s'] )
		{
			case 'create':	return $this->create_page();	break;
			case 'edit':	return $this->edit_page($p);	break;
			case 'delete':	return $this->delete_page($p);	break;
		}

		if ($p) // Specific page asked for
			return $this->view_page($p);

		$this->set_title($this->lang->pages);
		$this->tree($this->lang->pages);

		$result = $this->db->query("SELECT page_id, page_title, page_contents FROM %ppages");

		if ( $this->db->num_rows($result) == 0 )
			return eval($this->template('PAGE_NONE'));

		$Pages = null;
		$i = 0;
		while ( $page = $this->db->nqfetch($result) )
		{
			$i++;
			if ( $i % 2 == 0 )
				$class = 'tablelight';
			else
				$class = 'tabledark';
			$param = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_MBCODE | FORMAT_EMOTICONS;
			$page['page_title'] = $this->format($page['page_title'], $param );
			$Pages .= eval($this->template('PAGE_ENTRY'));
		}
		return eval($this->template('PAGE_LIST'));
	}

	function view_page($p)
	{
		$this->tree( $this->lang->pages, "$this->self?a=page" );

		$page = $this->db->fetch("SELECT page_id, page_title, page_contents FROM %ppages WHERE page_id=%d", $p);

		if ( $page ) {
			$param = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR | FORMAT_MBCODE | FORMAT_EMOTICONS;
			$page['page_title'] = $this->format($page['page_title'], $param );
			$page['page_contents'] = $this->format($page['page_contents'], FORMAT_CENSOR );
			$this->tree($page['page_title']);
			$this->set_title($page['page_title']);
		} else {
			$this->set_title($this->lang->page_viewing);
			$this->tree($this->lang->page_viewing);
			return $this->message($this->lang->page, $this->lang->page_not_exist);
		}
		return eval($this->template('PAGE_PAGE'));
	}

	function edit_page($p)
	{
		if (!$this->perms->auth('page_edit'))
			return $this->message($this->lang->page_action_not_allowed, $this->lang->page_edit_not_permitted);

		$this->set_title( $this->lang->page_editing );
		$this->tree( $this->lang->pages, "$this->self?a=page" );
		$this->tree( $this->lang->page_editing );
		
		$page = $this->db->fetch("
		SELECT
			page_id as id, page_title as title, page_contents as contents
		FROM
			%ppages
		WHERE
			page_id=%d", $p);

		if ( !$page )
			return $this->message($this->lang->page_editing, $this->lang->page_not_exist);

		if (!isset($this->post['submit']))
 			return eval($this->template('PAGE_EDIT'));

		$this->db->query("UPDATE %ppages SET page_title='%s', page_contents='%s' WHERE page_id=%d",
			$this->post['title'], $this->post['contents'], $p );

		return $this->message($this->lang->page_editing, $this->lang->page_edit_done, $this->lang->continue, "{$this->self}?a=page&amp;p={$p}");
	}

	function create_page()
	{
		if ( !$this->perms->auth('page_create') )
			return $this->message( $this->lang->page_action_not_allowed, $this->lang->page_create_not_permitted );

		$this->set_title( $this->lang->page_creating );
		$this->tree( $this->lang->pages, "$this->self?a=page" );
		$this->tree( $this->lang->page_creating );

		if ( !isset($this->post['submit']) )
			return eval($this->template('PAGE_CREATE'));

		$this->db->query("INSERT INTO %ppages (page_title,page_contents) VALUES('%s', '%s')",
			$this->post['title'], $this->post['contents']);
		$p = $this->db->insert_id("%ppages");
		return $this->message($this->lang->page_creating, $this->lang->page_created, $this->lang->continue, "{$this->self}?a=page&amp;p={$p}");
	}

	function delete_page($p)
	{
		if ( !$this->perms->auth('page_delete') )
			return $this->message($this->lang->page_action_not_allowed, $this->lang->page_delete_not_permitted);

		$this->set_title( $this->lang->page_delete );
		$this->tree( $this->lang->pages, "$this->self?a=page" );
		$this->tree( $this->lang->page_delete );

		$page = $this->db->fetch("SELECT page_id FROM %ppages WHERE page_id=%d", $p);

		if ( !$page )
			return $this->message($this->lang->page_delete, $this->lang->page_not_exist);

		if ( !isset($this->get['confirm']) )
			return $this->message($this->lang->page_delete, $this->lang->page_delete_confirm,
			$this->lang->continue, "{$this->self}?a=page&amp;p={$p}&amp;&amp;s=delete&amp;confirm=1" );

		$this->db->query("DELETE FROM %ppages WHERE page_id=%d", $p);
		return $this->message($this->lang->page_delete, $this->lang->page_deleted, $this->lang->continue, "$this->self?a=page");
	}
}
?>
