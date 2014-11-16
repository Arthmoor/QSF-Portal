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
 * Generate a single complete news post.
 *
 * @author Roger Libiez [Samson] http://www.iguanadons.net
 * @since 1.3.5
 **/
class newspost extends qsfglobal
{
	function execute( )
	{
		if (!$this->perms->auth('board_view')) {
			$this->lang->board();
			return $this->message(
				sprintf($this->lang->board_message, $this->sets['forum_name']),
				($this->perms->is_guest) ? sprintf($this->lang->board_regfirst, $this->self) : $this->lang->board_noview
			);
		}

		if( !isset( $this->get['t'] ) ) {
			header('HTTP/1.0 404 Not Found');
			return $this->message( "News", "No such article." );
		}

		$post = intval( $this->get['t'] );
		return $this->getpost( $post );
	}

	function getpost( $post )
	{
		$items = "";

		$row = $this->db->fetch(
		  "SELECT t.*, u.user_name, p.post_id, p.post_author, p.post_text, p.post_mbcode, p.post_emoticons
		    FROM %ptopics t
		    LEFT JOIN %pposts p ON p.post_topic=t.topic_id
		    LEFT JOIN %pusers u ON u.user_id=p.post_author
		    WHERE t.topic_id=%d LIMIT 1", $post );

		if( !$row ) {
			header('HTTP/1.0 404 Not Found');
			return $this->message( "News", "No such article. (2)" );
		}

		$query = $this->db->query("
			SELECT
			  attach_id, attach_name, attach_downloads, attach_size
			FROM
			  %pattach
			WHERE
			  attach_post=%d", $row['post_id'] );

		$this->lang->topic();
		$this->templater->add_templates('topic');
		$attachments = null;

		while ($file = $this->db->nqfetch($query))
		{
			if ($this->perms->auth('post_attach_download', $row['topic_forum'])) {
				$ext = strtolower(substr($file['attach_name'], -4));

				if (($ext == '.jpg') || ($ext == '.gif') || ($ext == '.png') || ($ext == '.bmp')) {
					$row['post_text'] .= "<br /><br />{$this->lang->topic_attached_image} {$file['attach_name']} ({$file['attach_downloads']} {$this->lang->topic_attached_downloads})<br /><img src='{$this->self}?a=topic&amp;s=attach&amp;id={$file['attach_id']}' alt='{$file['attach_name']}' />";
					continue;
				}
			}
			$filesize = ceil($file['attach_size'] / 1024);
			$attachments .= eval($this->template('TOPIC_POST_ATTACHMENT'));
		}

		$params = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR;
		if ($row['post_mbcode']) {
			$params |= FORMAT_MBCODE;
		}
		if ($row['post_emoticons']) {
			$params |= FORMAT_EMOTICONS;
		}

		$topic = $row['topic_title'];
		$uid = $row['post_author'];
		$user = $row['user_name'];
		$date = $this->mbdate( DATE_LONG, $row['topic_posted'] );
		$text = $this->format($row['post_text'], $params);
		$text .= $attachments;

		$text = str_replace( "[more]", "", $text );

		$comments = null;

		$result = $this->db->query( "SELECT *
		   FROM %pposts p
		   LEFT JOIN %pusers u ON u.user_id=p.post_author
		   WHERE post_topic=%d", $row['topic_id'] );

		$show = false;
		$pos = 0;
		while( $comment = $this->db->nqfetch($result) )
		{
			// Skip the first one. The initial "comment" is really the first post.
			if( !$show ) {
				$show = true;
				continue;
			}

			$pos++;
			if ($comment['post_mbcode']) {
				$params |= FORMAT_MBCODE;
			}
			if ($comment['post_emoticons']) {
				$params |= FORMAT_EMOTICONS;
			}

			$c_user = $comment['user_name'];
			$c_date = $this->mbdate( DATE_LONG, $comment['post_time'] );
			$c_text = $this->format( $comment['post_text'], $params );

			if( !strstr( $c_date, $this->lang->today ) && !strstr( $c_date, $this->lang->yesterday ) ) {
				$c_date = "On " . $c_date;
			}
			$comments .= eval($this->template('NEWS_COMMENT'));
		}

		$can_post = false;
		if ($this->perms->auth('post_create', $row['topic_forum'])) {
			$can_post = true;
		}

		$request_uri = $this->self . "?" . $this->query . "#p" . ++$pos;

		return eval($this->template('NEWS_POST'));
	}
}
?>