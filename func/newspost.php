<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2015 The QSF Portal Development Team
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
			return $this->message( 'News', 'No such article.' );
		}

		$post = intval( $this->get['t'] );
		return $this->getpost( $post );
	}

	function getpost( $post )
	{
		$items = "";

		$post = $this->db->fetch(
		  "SELECT t.*, u.*, p.post_id, p.post_author, p.post_time, p.post_text, p.post_mbcode, p.post_emoticons, p.post_ip, a.active_time, m.membertitle_icon, g.group_name
		    FROM (%ptopics t, %pgroups g)
		    LEFT JOIN %pposts p ON p.post_topic=t.topic_id
		    LEFT JOIN %pusers u ON u.user_id=p.post_author
		    LEFT JOIN %pactive a ON a.active_id=u.user_id
		    LEFT JOIN %pmembertitles m ON m.membertitle_id=u.user_level
		    WHERE t.topic_id=%d AND u.user_group=g.group_id LIMIT 1", $post );

		if( !$post ) {
			header('HTTP/1.0 404 Not Found');
			return $this->message( 'News', 'No such article. (2)' );
		}

		$query = $this->db->query("
			SELECT
			  attach_id, attach_name, attach_downloads, attach_size
			FROM
			  %pattach
			WHERE
			  attach_post=%d", $post['post_id'] );

		$this->lang->topic();
		$this->templater->add_templates('topic');
		$attachments = null;

		while ($file = $this->db->nqfetch($query))
		{
			if ($this->perms->auth('post_attach_download', $post['topic_forum'])) {
				$ext = strtolower(substr($file['attach_name'], -4));

				if (($ext == '.jpg') || ($ext == '.gif') || ($ext == '.png') || ($ext == '.bmp')) {
					$post['post_text'] .= "<br /><br />{$this->lang->topic_attached_image} {$file['attach_name']} ({$file['attach_downloads']} {$this->lang->topic_attached_downloads})<br /><img src='{$this->self}?a=topic&amp;s=attach&amp;id={$file['attach_id']}' alt='{$file['attach_name']}' />";
					continue;
				}
			}
			$filesize = ceil($file['attach_size'] / 1024);
			$attachments .= eval($this->template('TOPIC_POST_ATTACHMENT'));
		}

		$params = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR;
		if ($post['post_mbcode']) {
			$params |= FORMAT_MBCODE;
		}
		if ($post['post_emoticons']) {
			$params |= FORMAT_EMOTICONS;
		}

		$topic = $post['topic_title'];
		$uid = $post['post_author'];
		$user = $post['user_name'];
		$date = $this->mbdate( DATE_LONG, $post['topic_posted'] );
		$text = $this->format($post['post_text'], $params);
		$text .= $attachments;

		$text = str_replace( "[more]", "", $text );

		$comments = null;

		$result = $this->db->query( "SELECT u.*, p.post_id, p.post_author, p.post_time, p.post_text, p.post_mbcode, p.post_emoticons, p.post_ip, a.active_time, m.membertitle_icon, g.group_name
		   FROM (%pposts p, %pgroups g)
		   LEFT JOIN %pusers u ON u.user_id=p.post_author
		   LEFT JOIN %pactive a ON a.active_id=u.user_id
		   LEFT JOIN %pmembertitles m ON m.membertitle_id=u.user_level
		   WHERE post_topic=%d AND u.user_group=g.group_id", $post['topic_id'] );

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

			$Poster_Info = $this->build_memberinfo($comment, $post['topic_forum']);

			if( !strstr( $c_date, $this->lang->today ) && !strstr( $c_date, $this->lang->yesterday ) ) {
				$c_date = "On " . $c_date;
			}
			$comments .= eval($this->template('NEWS_COMMENT'));
		}

		$can_post = false;
		if ($this->perms->auth('post_create', $post['topic_forum'])) {
			$can_post = true;
		}

		$request_uri = $this->self . "?" . $this->query . "#p" . ++$pos;

		$post['post_time'] = $this->mbdate(DATE_LONG, $post['post_time']);
		$Poster_Info = $this->build_memberinfo($post, $post['topic_forum']);

		$smilies = $this->bbcode->generate_emote_links();
		return eval($this->template('NEWS_POST'));
	}

	function build_memberinfo($post, $forum)
	{
		$oldtime = $this->time - 900;

		$online = ($post['active_time'] && ($post['active_time'] > $oldtime) && $post['user_active']);

		$icons = array(
			'user_email' => array(
				'link'   => '',
				'alt'    => '',
				'img'    => '',
				'target' => '_self',
			),
			'user_homepage' => array(
				'link'   => $post['user_homepage'],
				'alt'    => sprintf($this->lang->topic_links_web, $post['user_name']),
				'img'    => 'www.png',
				'target' => $this->sets['link_target']
			),
			'user_icq' => array(
				'link'   => 'http://wwp.icq.com/scripts/search.dll?to=' . $post['user_icq'],
				'alt'    => sprintf($this->lang->topic_links_icq, $post['user_name']),
				'img'    => 'icq.png',
				'target' => $this->sets['link_target']
			),
			'user_aim' => array(
				'link'   => 'aim:goim?screenname=' . $post['user_aim'],
				'alt'    => sprintf($this->lang->topic_links_aim, $post['user_name']),
				'img'    => 'aim.png',
				'target' => '_self'
			),
			'user_yahoo' => array(
				'link'   => 'http://edit.yahoo.com/config/send_webmesg?.target=' . $post['user_yahoo'] . '&amp;.src=pg',
				'alt'    => sprintf($this->lang->topic_links_yahoo, $post['user_name']),
				'img'    => 'yahoo.png',
				'target' => $this->sets['link_target']
			),
			'user_msn' => array(
				'link'   => 'http://members.msn.com/' . $post['user_msn'],
				'alt'    => sprintf($this->lang->topic_links_msn, $post['user_name']),
				'img'    => 'msn.png',
				'target' => $this->sets['link_target']
			),
			'user_twitter' => array(
				'link'   => 'http://twitter.com/' . $post['user_twitter'],
				'alt'    => sprintf($this->lang->topic_links_twitter, $post['user_name']),
				'img'    => 'twitter.png',
				'target' => $this->sets['link_target']
			),
			'user_pm' => array(
				'link'   => $this->self . '?a=pm&amp;s=send&amp;to=' . $post['user_id'],
				'alt'    => sprintf($this->lang->topic_links_pm, $post['user_name']),
				'img'    => 'pm.png',
				'target' => '_self'
			)
		);

		if ($this->perms->auth('email_use')) {
			if (!$post['user_email_show']) {
				if ($post['user_email_form']) {
					$icons['user_email'] = array(
						'link'   => "{$this->self}?a=email&amp;to={$post['user_id']}",
						'alt'    => sprintf($this->lang->topic_links_email, $post['user_name']),
						'img'    => 'email.png',
						'target' => '_self'
					);
				} else {
					unset($icons['user_email']);
				}
			} else {
				$icons['user_email'] = array(
					'link'   => 'mailto:' . $post['user_email'],
					'alt'    => sprintf($this->lang->topic_links_email, $post['user_name']),
					'img'    => 'email.png',
					'target' => '_self'
				);
			}
		}

		$post['user_posts'] = number_format($post['user_posts'], 0, null, $this->lang->sep_thousands);
		$post['user_joined'] = $this->mbdate(DATE_ONLY_LONG, $post['user_joined']);

		if (!$this->perms->auth('post_viewip', $forum)) {
			$post['post_ip'] = null;
		}

		$post['user_avatar'] = $this->htmlwidgets->display_avatar( $post );

		if ($post['user_signature'] && $this->user['user_view_signatures']) {
			$post['user_signature'] = '.........................<br />' . $this->format($post['user_signature'], FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_MBCODE | FORMAT_EMOTICONS);
		} else {
			$post['user_signature'] = null;
		}

		return eval($this->template('TOPIC_POSTER_MEMBER'));
	}
}
?>