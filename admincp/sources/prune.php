<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2015 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * http://code.google.com/p/quicksilverforums/
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

class prune extends admin
{
	function execute()
	{
		$this->set_title($this->lang->prune_title);
		$this->tree($this->lang->prune_title);

		if (!isset($this->post['submit'])) {
			$token = $this->generate_token();

			// Stage 1
			$forum_options = $this->htmlwidgets->select_forums(-1, 0);
			return eval($this->template('ADMIN_PRUNE_FORM'));
		} else if (isset($this->post['age'])) {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->prune_title, $this->lang->invalid_token );
			}

			// Stage 2
			
			if (!$this->validator->validate($this->post['age'], TYPE_UINT)) {
				return $this->message($this->lang->prune_title, $this->lang->prune_invalidage);
			}
			$age = $this->post['age'];
			$age = time() - ($age * 3600); // age is in hours
			
			if (!isset($this->post['forums']) || !$this->validator->validate($this->post['forums'], TYPE_ARRAY) || count($this->post['forums']) == 0) {
				return $this->message($this->lang->prune_title, $this->lang->prune_novalidforum);
			}
			$forums = implode(', ', $this->post['forums']);
			
			$topics = '';
			
			$query = $this->db->query("SELECT * FROM %ptopics 
					WHERE topic_edited < %d AND topic_forum in (%s)
					ORDER BY topic_edited", $age, $forums);
					
			if ($this->db->num_rows($query) == 0) {
				return $this->message($this->lang->prune_title, $this->lang->prune_notopics_old);
			}

			$topicCount = 0;
			
			while ($topic = $this->db->nqfetch($query)) {
				$topic['topic_title'] = $this->format($topic['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS);
				if (!empty($topic['topic_description'])) {
					$topic['topic_description'] = '<br />&raquo; ' . $this->format($topic['topic_description'], FORMAT_CENSOR | FORMAT_HTMLCHARS);
				}
			
				$topics .= eval($this->template('ADMIN_PRUNE_TOPIC'));
				$topicCount++;
			}

			$token = $this->generate_token();
			$movetoForum = $this->htmlwidgets->select_forums(0, 0, null, false);
			return eval($this->template('ADMIN_PRUNE_TOPICLIST'));
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->prune_title, $this->lang->invalid_token );
			}

			// Stage 3
			if (!isset($this->post['forums'])) {
				return $this->message($this->lang->prune_title, $this->lang->prune_novalidforum);
			}

			if (!isset($this->post['topics']) || !$this->validator->validate($this->post['topics'], TYPE_ARRAY) || count($this->post['topics']) == 0) {
				return $this->message($this->lang->prune_title, $this->lang->prune_notopics);
			}
			
			$actionIsMove = true; // default to non-destructive
			if (isset($this->post['prune_action']) && $this->post['prune_action'] == 'delete') {
				$actionIsMove = false;
			} elseif (!isset($this->post['dest']) || !$this->validator->validate($this->post['age'], TYPE_UINT)) {
				return $this->message($this->lang->prune_title, $this->lang->prune_nodest);
			}
			
			if ($actionIsMove) {
				// Check the destination is a real forum and not a category or some other rubish
				$dest = $this->db->fetch("SELECT * FROM %pforums WHERE forum_id=%d", $this->post['dest']);
				if (!$dest || $dest['forum_parent'] == 0 || $dest['forum_subcat'] == 1) {
					// Can't move to a category!
					return $this->message($this->lang->prune_title, $this->lang->prune_nodest);
				}
				
				foreach ($this->post['topics'] as $t) {
					$this->db->query("UPDATE %ptopics SET topic_forum=%d WHERE topic_id=%d", $this->post['dest'], $t);
					$this->db->query("DELETE FROM %psubscriptions WHERE subscription_item=%d AND subscription_type='topic'", $t);
				}
	
				$this->countTopicsAndReplies($this->post['dest']);
			} else {
				// Delete them!
				foreach ($this->post['topics'] as $t) {
					$this->htmlwidgets->delete_topic($t);
				}
				
			}
			
			// Recount forums included in prune
			foreach (explode(',', $this->post['forums']) as $forum) {
				$this->countTopicsAndReplies($forum);
			}
			
			return $this->message($this->lang->prune_title, $this->lang->prune_success);
		}
	}
}
?>