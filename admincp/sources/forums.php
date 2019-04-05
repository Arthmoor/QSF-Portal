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

if (!defined('QUICKSILVERFORUMS') || !defined('QSF_ADMIN')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';

/**
 * Forum Controls
 *
 * @author Mark Elliot <mark.elliot@mercuryboard.com>
 * @since Beta 2.1
 **/
class forums extends admin
{
	/**
	 * Forum Controls
	 *
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string HTML
	 **/
	function execute()
	{
		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = '';
		}

		$forums_exist = $this->db->fetch( "SELECT COUNT(forum_id) AS count FROM %pforums" );

		if( !$forums_exist['count'] && ( $this->get['s'] != 'add' ) ) {
			return $this->message( $this->lang->forum_controls, $this->lang->forum_none, $this->lang->forum_create, "$this->self?a=forums&amp;s=add" );
		}

		switch( $this->get['s'] )
		{
		case 'edit':
			$this->set_title( $this->lang->forum_edit );

			if( isset( $this->get['id'] ) ) {
				$id = intval( $this->get['id'] );

				$f = $this->db->fetch( "SELECT forum_name, forum_description, forum_parent, forum_subcat, forum_redirect FROM %pforums WHERE forum_id=%d", $id );

				$this->tree( $this->lang->forum_edit, "{$this->self}?a=forums&amp;s=edit" );
				$this->tree( $f['forum_name'] );

				if( isset( $this->post['editforum'] ) ) {
					if( !$this->is_valid_token() ) {
						return $this->message( $this->lang->forum_edit, $this->lang->invalid_token );
					}
					return $this->EditForum( $id );
				} else {
					$token = $this->generate_token();

					$forum = $this->htmlwidgets->select_forums( $f['forum_parent'] );

					$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/forums.xtpl' );

					$xtpl->assign( 'self', $this->self );
					$xtpl->assign( 'id', $id );
					$xtpl->assign( 'forum_edit', $this->lang->forum_edit );
					$xtpl->assign( 'forum_name', $f['forum_name'] );
					$xtpl->assign( 'forum_parent_cat', $this->lang->forum_parent_cat );
					$xtpl->assign( 'forum_create_cat', $this->lang->forum_create_cat );
					$xtpl->assign( 'forum_select', $forum );
					$xtpl->assign( 'forum_edit_name', $this->lang->forum_name );
					$xtpl->assign( 'forum_edit_description', $this->lang->forum_description );
					$xtpl->assign( 'forum_description', $f['forum_description'] );
					$xtpl->assign( 'forum_subcat', $this->lang->forum_subcat );
					$xtpl->assign( 'forum_is_subcat', $this->lang->forum_is_subcat );

					$checked = null;
					if( $f['forum_subcat'] )
						$checked = "checked";
					$xtpl->assign( 'checked', $checked );

					$xtpl->assign( 'token', $this->generate_token() );
					$xtpl->assign( 'submit', $this->lang->submit );

					$xtpl->parse( 'Forums.EditForm' );
					$xtpl->parse( 'Forums' );

					return $xtpl->text( 'Forums' );
				}
			} else {
				$this->tree( $this->lang->forum_edit );

				return $this->message( $this->lang->forum_edit, '<div style="text-align:left">' . $this->Text( $this->htmlwidgets->forum_grab(), "$this->self?a=forums&amp;s=edit&amp;id=" ) . '</div>' );
			}
			break;

		case 'delete':
			$this->set_title( $this->lang->forum_delete );

			if( isset( $this->get['id'] ) ) {
				$id = intval( $this->get['id'] );

				$f = $this->db->fetch( "SELECT forum_name FROM %pforums WHERE forum_id=%d", $id );

				$this->tree( $this->lang->forum_delete, "{$this->self}?a=forums&amp;s=delete" );
				$this->tree( $f['forum_name'] );

				if( isset( $this->post['submit'] ) ) {
					if( !$this->is_valid_token() ) {
						return $this->message( $this->lang->forum_edit, $this->lang->invalid_token );
					}
					return $this->DeleteForum( $id );
				} else {
					$token = $this->generate_token();

					$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/forums.xtpl' );

					$xtpl->assign( 'self', $this->self );
					$xtpl->assign( 'id', $id );
					$xtpl->assign( 'forum_delete', $this->lang->forum_delete );
					$xtpl->assign( 'forum_name', $f['forum_name'] );
					$xtpl->assign( 'forum_delete_warning', $this->lang->forum_delete_warning );

					$xtpl->assign( 'token', $this->generate_token() );
					$xtpl->assign( 'submit', $this->lang->submit );

					$xtpl->parse( 'Forums.DeleteForm' );
					$xtpl->parse( 'Forums' );

					return $xtpl->text( 'Forums' );
				}
			} else {
				$this->tree( $this->lang->forum_delete );
				return $this->message( $this->lang->forum_delete, '<div style="text-align:left">' . $this->Text($this->htmlwidgets->forum_grab(), "$this->self?a=forums&amp;s=delete&amp;id=") . '</div>' );
			}
			break;

		case 'add':
			$this->set_title( $this->lang->forum_create );
			$this->tree( $this->lang->forum_create );

			if( isset( $this->post['addforum'] ) ) {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->forum_create, $this->lang->invalid_token );
				}

				return $this->message( $this->lang->forum_create, $this->AddForum() );
			} else {
				$select = $this->htmlwidgets->select_forums();

				if( $forums_exist['count'] ) {
					$quickperms = $select;
				} else {
					$quickperms = "<option value='-3' selected='selected'>{$this->lang->forum_default_perms}</option>";
				}

				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/forums.xtpl' );

				$xtpl->assign( 'self', $this->self );
				$xtpl->assign( 'forum_create', $this->lang->forum_create );
				$xtpl->assign( 'forum_parent_cat', $this->lang->forum_parent_cat );
				$xtpl->assign( 'forum_select_cat', $this->lang->forum_select_cat );
				$xtpl->assign( 'forum_create_cat', $this->lang->forum_create_cat );
				$xtpl->assign( 'forum_select', $select );
				$xtpl->assign( 'forum_name', $this->lang->forum_name );
				$xtpl->assign( 'forum_description', $this->lang->forum_description );
				$xtpl->assign( 'forum_quickperms', $this->lang->forum_quickperms );
				$xtpl->assign( 'forum_quickperm_select', $this->lang->forum_quickperm_select );
				$xtpl->assign( 'quickperms', $quickperms );
				$xtpl->assign( 'forum_subcat', $this->lang->forum_subcat );
				$xtpl->assign( 'forum_is_subcat', $this->lang->forum_is_subcat );
				$xtpl->assign( 'token', $this->generate_token() );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'Forums.AddForm' );
				$xtpl->parse( 'Forums' );

				return $xtpl->text( 'Forums' );
			}
			break;

		case 'order':
			$this->set_title( $this->lang->forum_ordering );
			$this->tree( $this->lang->forum_ordering );

			if( isset( $this->post['orderforum'] ) ) {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->forum_ordering, $this->lang->invalid_token );
				}
				return $this->message( $this->lang->forum_ordering, $this->OrderUpdate() );
			}

			$forum = $this->InputBox( $this->htmlwidgets->forum_grab() );

			$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/forums.xtpl' );

			$xtpl->assign( 'self', $this->self );
			$xtpl->assign( 'forum_ordering', $this->lang->forum_ordering );
			$xtpl->assign( 'forum', $forum );
			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'Forums.OrderForm' );
			$xtpl->parse( 'Forums' );

			return $xtpl->text( 'Forums' );

			break;

		case 'count':
			$this->set_title( $this->lang->forum_recount );
			$this->tree( $this->lang->forum_recount );

			$this->RecountForums();

			$this->write_sets();

			return $this->message( $this->lang->forum_recount, sprintf( $this->lang->recount_forums, $this->sets['topics'], $this->sets['posts'] ) );
			break;
		}
	}

	/**
	 * Returns true if $check is found in the children of $id
	 *
	 * @param array $array Array of forums
	 * @param int $id Used as parent
	 * @param int $check ID of parent to check in list
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return bool True if $check is found amongst the children of $id
	 **/
	function CheckParent($array, $id, $check)
	{
		$arr = $this->htmlwidgets->forum_array($array, $id);
		if ($arr) {
			foreach ($arr as $val) {
				if ($val['forum_id'] == $check) {
					return true;
				} else {
					return $this->CheckParent($array, $val['forum_id'], $check);
				}
			}
		}
		return false;
	}

	/**
	 * Creates the list of forums preceeding $id in $array
	 *
	 * @param array $array Array of forums
	 * @param int $id Used as reference point for tree construction
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string List of forums preceding $id in $array
	 **/
	function CreateTree($array, $id)
	{
		for ($i = 0; $i < count($array); $i++) {
			if ($array[$i]['forum_id'] == $id) {
				return preg_replace('/^,/', '', $array[$i]['forum_tree'] . ",$id");
			}
		}
	}

	private function buildTree( $forumsArray, $parent )
	{
		$tree = '';

		if( isset( $forumsArray[$parent] ) && $forumsArray[$parent] ) {
			$tree = $this->buildTree( $forumsArray, $forumsArray[$parent] );
			$tree .= ',';
		}

		$tree .= $parent;

		return $tree;
	}

	/**
	 * Update Forum Trees
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 **/
	private function updateForumTrees()
	{
		$forums = array();
		$forumTree = array();

		// Build tree structure of 'id' => 'parent' structure
		$q = $this->db->query( "SELECT forum_id, forum_parent FROM %pforums ORDER BY forum_parent" );

		while( $f = $this->db->nqfetch( $q ) )
		{
			if( $f['forum_parent'] ) {
				$forums[$f['forum_id']] = $f['forum_parent'];
			}
		}

		// Run through group
		$q = $this->db->query( "SELECT forum_parent FROM %pforums GROUP BY forum_parent" );

		while( $f = $this->db->nqfetch( $q ) )
		{
			if ($f['forum_parent']) {
				$tree = $this->buildTree( $forums, $f['forum_parent'] );
			} else {
				$tree = '';
			}

			$this->db->query( "UPDATE %pforums SET forum_tree='%s' WHERE forum_parent=%d", $tree, $f['forum_parent'] );
		}
	}

	/**
	 * Cleans up orphaned topics and posts that no longer have valid hierarchy data.
	 *
	 * @author Roger Libiez [Samson] 
	 * @since 1.4.3
	**/
	function CleanOrphans()
	{
		$topic_purge = null;

		$topics = $this->db->query( 'SELECT topic_id, topic_forum FROM %ptopics' );
		while( $topic = $this->db->nqfetch( $topics ) )
		{
			$exists = $this->db->fetch( 'SELECT forum_id FROM %pforums WHERE forum_id=%d', $topic['topic_forum'] );
			if( !$exists )
				$topic_purge .= "topic_id={$topic['topic_id']} OR ";
		}

		if( $topic_purge ) {
			$topic_purge = substr($topic_purge, 0, -4);
			$this->db->query( "DELETE FROM %ptopics WHERE $topic_purge" );
		}

		$post_purge = null;

		$posts = $this->db->query( 'SELECT post_id, post_topic FROM %pposts' );
		while( $post = $this->db->nqfetch( $posts ) )
		{
			$exists2 = $this->db->fetch( 'SELECT topic_id FROM %ptopics WHERE topic_id=%d', $post['post_topic'] );
			if( !$exists2 )
				$post_purge .= "post_id={$post['post_id']} OR ";
		}

		if( $post_purge ) {
			$post_purge = substr($post_purge, 0, -4);
			$this->db->query( "DELETE FROM %pposts WHERE $post_purge" );
		}
	}

	/**
	 * Removes forum $id as well as all posts/topics for $id
	 *
	 * @param int $id ID of forum
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string Completion message
	 **/
	function DeleteForum($id)
	{
		if ($this->htmlwidgets->forum_array($this->htmlwidgets->forum_grab(), $id)) {
			return $this->message($this->lang->forum_delete, $this->lang->forum_no_orphans);
		}

		$topics = null;

		$query = $this->db->query("SELECT topic_id FROM %ptopics WHERE topic_forum=%d", $id);
		while ($data = $this->db->nqfetch($query))
		{
			$topics .= "post_topic={$data['topic_id']} OR ";
		}

		if ($topics) {
			$this->db->query("DELETE FROM %pposts WHERE " . substr($topics, 0, -4));
			$this->db->query("DELETE FROM %ptopics WHERE topic_forum=%d", $id);
		}

		$this->db->query("DELETE FROM %pforums WHERE forum_id=%d", $id);

		$perms = new permissions($this);

		// Groups
		while ($perms->get_group())
		{
			$perms->remove_z($id);
			$perms->update();
		}

		// Users
		while ($perms->get_group(true))
		{
			$perms->remove_z($id);
			$perms->update();
		}

		// Recount after the carnage so the board totals are correct.
		$this->RecountForums();
		$this->write_sets();

		// Clean up any orphans that got left behind, because this process apparently isn't perfect.
		$this->CleanOrphans();

		return $this->message($this->lang->forum_delete, $this->lang->forum_deleted);
	}

	/**
	 * Updates forum $id
	 *
	 * @param integer $id ID of forum
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string Completion message
	 **/
	function EditForum($id)
	{
		if (trim($this->post['name']) == '') {
			return $this->message($this->lang->forum_edit, $this->lang->forum_empty);
		}

		$subcat = isset($this->post['subcat']) ? 1 : 0;
		$redirect = isset($this->post['redirect']) ? 1 : 0;

		$forums = $this->htmlwidgets->forum_grab();
		if (($this->post['parent'] == $id) || $this->CheckParent($forums, $id, $this->post['parent'])) {
			return $this->message($this->lang->forum_edit, $this->lang->forum_parent);
		}

		$this->db->query("UPDATE %pforums SET
			  forum_parent=%d, forum_name='%s', forum_description='%s', forum_subcat=%d, forum_redirect=%d
			  WHERE forum_id=%d",
			  $this->post['parent'], $this->post['name'], $this->post['description'], $subcat, $redirect, $id);

		$this->updateForumTrees();

		return $this->message($this->lang->forum_edit, $this->lang->forum_edited);
	}

	/**
	 * Adds a forum with parameters from $this->post
	 *
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string Completion message
	 **/
	function AddForum()
	{
		if (trim($this->post['name']) == '') {
			return $this->lang->forum_empty;
		}

		$forums = $this->htmlwidgets->forum_grab();

		$forums_arr = $this->htmlwidgets->forum_array($forums, $this->post['parent']);
		$position   = $forums_arr ? count($forums_arr) : 0;
		$subcat     = isset($this->post['subcat']) ? 1 : 0;
		$redirect   = isset($this->post['redirect']) ? 1 : 0;

		$this->db->query("INSERT INTO %pforums
			(forum_tree, forum_parent, forum_name, forum_description, forum_position, forum_subcat, forum_redirect)
			VALUES('%s', %d, '%s', '%s', %d, %d, %d)",
			$this->CreateTree($forums, $this->post['parent']),
			$this->post['parent'], $this->post['name'], $this->post['description'], $position, $subcat, $redirect);

		$id = $this->db->insert_id("forums");

		$perms = new permissions($this);

		while ($perms->get_group())
		{
			// Full permissions (note: the banned group is still false)
			if ($this->post['sync'] == -2) {
				$perms->add_z($id, ($perms->group != USER_BANNED));

			// Default permissions (only works if there are no forums already created)
			} elseif ($this->post['sync'] == -3) {
				$perms->add_z($id);

			// No permissions
			} elseif ($this->post['sync'] == -1) {
				$perms->add_z($id, false);

			// Copy another forum
			} else {
				$perms->add_z($id, false);

				foreach ($perms->standard as $perm => $false)
				{
					if (!isset($perms->globals[$perm])) {
						$perms->set_xyz($perm, $id, $perms->auth($perm, $this->post['sync']));
					}
				}
			}

			$perms->update();
		}

		return $this->lang->forum_created;
	}

	/**
	 * Updates the position of all forums based on $this->post data
	 *
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string Completion message
	 **/
	function OrderUpdate()
	{
		$q = $this->db->query("SELECT forum_id FROM %pforums ORDER BY forum_id ASC");
		while ($f = $this->db->nqfetch($q))
		{
			$this->db->query("UPDATE %pforums SET forum_position=%d WHERE forum_id=%d",
				$this->post["_{$f['forum_id']}"], $f['forum_id']);
		}
		return $this->lang->forum_ordered;
	}

	/**
	 * Creates a heirarchial list of all HTML forums with an input box in front with id _$forum_id
	 *
	 * @param array $array Array of forums
	 * @param int $parent Used to degredate down through the recursive loop
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string A heirarchial HTML list of all the forums with an input box in front with id _$forum_id
	 **/
	function InputBox($array, $parent = 0)
	{
		$arr = $this->htmlwidgets->forum_array($array, $parent);

		if ($arr) {
			$return = "<ul>\n";
			foreach ($arr as $val) {
				$return .= "<li><input class='input' name='_{$val['forum_id']}' value='{$val['forum_position']}' size='2' /> {$val['forum_name']}";
				$return .= $this->InputBox($array, $val['forum_id']);
				$return .= "</li>\n";
			}
			$return .= "</ul>\n";
			return $return;
		}
	}

	/**
	 * Creates a heirarchial HTML list of all forums
	 *
	 * @param array $array Array of forums
	 * @param string $link Link to plug into list
	 * @param int $parent Used to degredate down through the recursive loop
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string A heirarchial HTML list of all the forums
	 **/
	function Text($array, $link = "", $parent = 0)
	{
		$arr = $this->htmlwidgets->forum_array($array, $parent);

		if ($arr) {
			$return = null;
			foreach ($arr as $val) {
				$return .= '<ul>' . "
				<li><a href='{$link}{$val['forum_id']}'>{$val['forum_name']}</a></li>" .
				$this->Text($array, $link, $val['forum_id']) . '</ul>';
			}
			return $return;
		}
	}
}
?>