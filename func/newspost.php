<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2025 The QSF Portal Development Team
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
 * Generate a single complete news post.
 *
 * @author Roger Libiez
 * @since 1.3.5
 **/
class newspost extends qsfglobal
{
	public function execute( )
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->site ) : $this->lang->board_noview
			);
		}

		if( !isset( $this->get['tname'] ) || !isset( $this->get['t'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->newspost_news, $this->lang->newspost_no_article );
		}

		if( !$this->validator->validate( $this->get['tname'], TYPE_STRING ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->newspost_news, $this->lang->newspost_no_article );
		}

		if( !$this->validator->validate( $this->get['t'], TYPE_INT ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->newspost_news, $this->lang->newspost_no_article );
		}

		$post_id = intval( $this->get['t'] );
		$post_name = strtolower( $this->get['tname'] );

		return $this->getpost( $post_id, $post_name );
	}

	private function getpost( $post_id, $post_name )
	{
		$items = '';

		$stmt = $this->db->prepare_query( 'SELECT t.*, u.*, p.post_id, p.post_author, p.post_time, p.post_text, p.post_bbcode, p.post_emojis, p.post_ip, a.active_time, m.membertitle_icon, g.group_name
		    FROM (%ptopics t, %pgroups g)
		    LEFT JOIN %pposts p ON p.post_topic=t.topic_id
		    LEFT JOIN %pusers u ON u.user_id=p.post_author
		    LEFT JOIN %pactive a ON a.active_id=u.user_id
		    LEFT JOIN %pmembertitles m ON m.membertitle_id=u.user_level
		    WHERE t.topic_id=? AND u.user_group=g.group_id
		    ORDER BY p.post_time LIMIT 1' );

      $stmt->bind_param( 'i',  $post_id );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $post = $this->db->nqfetch( $result );
      $stmt->close();

		if( !$post || $post_name != $this->htmlwidgets->clean_url( $post['topic_title'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->newspost_news, $this->lang->newspost_no_article );
		}

		$stmt = $this->db->prepare_query( 'SELECT attach_id, attach_name, attach_downloads, attach_size FROM %pattach WHERE attach_post=?' );

      $stmt->bind_param( 'i',  $post_id );
      $this->db->execute_query( $stmt );

      $query = $stmt->get_result();
      $stmt->close();

		$this->lang->topic();

		$post['post_time'] = $this->mbdate( DATE_LONG, $post['post_time'] );

		$xtpl = new XTemplate( './skins/' . $this->skin . '/newspost.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'topic', $post['topic_title'] );
		$xtpl->assign( 'post_time', $post['post_time'] );
		$xtpl->assign( 'topic_attached', $this->lang->topic_attached );
		$xtpl->assign( 'topic_attached_filename', $this->lang->topic_attached_filename );
		$xtpl->assign( 'topic_attached_size', $this->lang->topic_attached_size );
		$xtpl->assign( 'topic_attached_downloads', $this->lang->topic_attached_downloads );
		$xtpl->assign( 'topicnum', $post_id );

		$Poster_Info = $this->build_memberinfo( $post, $post['topic_forum'] );
		$xtpl->assign( 'PosterInfo', $Poster_Info );

		$params = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR;
		if( $post['post_bbcode'] ) {
			$params |= FORMAT_BBCODE;
		}
		if( $post['post_emojis'] ) {
			$params |= FORMAT_EMOJIS;
		}

		$text = $this->format( $post['post_text'], $params );
		$text = str_replace( '[more]', '', $text );
		$xtpl->assign( 'text', $text );

		$attachments = null;

		while( $file = $this->db->nqfetch( $query ) )
		{
			if( $this->perms->auth( 'post_attach_download', $post['topic_forum'] ) ) {
				$ext = strtolower( substr( $file['attach_name'], -4 ) );

				if( ( $ext == '.jpg' ) || ( $ext == '.gif' ) || ( $ext == '.png' ) ) {
					$topic_link = $this->htmlwidgets->clean_url( $post['topic_title'] );
					$post['post_text'] .= "<br><br>{$this->lang->topic_attached_image} {$file['attach_name']} ({$file['attach_downloads']} {$this->lang->topic_attached_downloads})<br><img src='{$this->site}/attachments/{$file['attach_file']}' alt='{$file['attach_name']}'>";
					continue;
				}
			}
			$filesize = ceil( $file['attach_size'] / 1024 );

			$xtpl->assign( 'attach_id', $file['attach_id'] );
			$xtpl->assign( 'attach_name', $file['attach_name'] );
			$xtpl->assign( 'filesize', $filesize );
			$xtpl->assign( 'attach_downloads', $file['attach_downloads'] );

			$xtpl->parse( 'NewsPost.Attachment' );
		}

		$xtpl->assign( 'newspost_comments', $this->lang->newspost_comments );

		$comments = null;

		$stmt = $this->db->prepare_query( 'SELECT u.*, p.post_id, p.post_author, p.post_time, p.post_text, p.post_bbcode, p.post_emojis, p.post_ip, a.active_time, m.membertitle_icon, g.group_name
			FROM (%pposts p, %pgroups g)
			LEFT JOIN %pusers u ON u.user_id=p.post_author
			LEFT JOIN %pactive a ON a.active_id=u.user_id
			LEFT JOIN %pmembertitles m ON m.membertitle_id=u.user_level
			WHERE post_topic=? AND u.user_group=g.group_id
			ORDER BY p.post_time' );

      $stmt->bind_param( 'i',  $post_id );
      $this->db->execute_query( $stmt );

      $result = $stmt->get_result();
      $stmt->close();

		$show = false;
		$pos = 0;
		while( $comment = $this->db->nqfetch( $result ) )
		{
			// Skip the first one. The initial "comment" is really the first post.
			if( !$show ) {
				$show = true;
				continue;
			}

			$pos++;
			if( $comment['post_bbcode'] ) {
				$params |= FORMAT_BBCODE;
			}
			if( $comment['post_emojis'] ) {
				$params |= FORMAT_EMOJIS;
			}

			$c_user = $comment['user_name'];
			$c_date = $this->mbdate( DATE_LONG, $comment['post_time'] );
			$c_text = $this->format( $comment['post_text'], $params );

			$Poster_Info = $this->build_memberinfo( $comment, $post['topic_forum'] );

			$xtpl->assign( 'pos', $pos );
			$xtpl->assign( 'CommenterInfo', $Poster_Info );
			$xtpl->assign( 'c_text', $c_text );
			$xtpl->assign( 'c_date', $c_date );
			$xtpl->assign( 'post_id', $post_id );
			$xtpl->assign( 'link_title', $this->htmlwidgets->clean_url( $post['topic_title'] ) );

			$xtpl->parse( 'NewsPost.Comment' );
		}

		$can_post = false;
		if( $this->perms->auth( 'post_create', $post['topic_forum'] ) ) {
			$can_post = true;
		}

		if( $can_post ) {
			$xtpl->assign( 't', $post_id );
			$xtpl->assign( 'newspost_post_comment', $this->lang->newspost_post_comment );
			$xtpl->assign( 'smilies', $this->bbcode->generate_emoji_links() );
			$xtpl->assign( 'bbcode_menu', $this->bbcode->get_bbcode_menu() );
			$xtpl->assign( 'newspost_post_emojis', $this->lang->newspost_post_emojis );
			$xtpl->assign( 'newspost_post_bbcode', $this->lang->newspost_post_bbcode );
			$xtpl->assign( 'reply', $this->lang->reply );

			$request_uri = $this->self . "?" . $this->query . "#p" . ++$pos;
			$xtpl->assign( 'request_uri', $request_uri );

			$xtpl->parse( 'NewsPost.CommentForm' );
		}

		$xtpl->parse( 'NewsPost' );
		return $xtpl->text( 'NewsPost' );
	}

	private function build_memberinfo( $post, $forum )
	{
		$oldtime = $this->time - 900;

		$online = ( $post['active_time'] && ( $post['active_time'] > $oldtime ) && $post['user_active'] );

		$post['user_posts'] = number_format( $post['user_posts'], 0, null, $this->lang->sep_thousands );
		$post['user_joined'] = $this->mbdate( DATE_ONLY_LONG, $post['user_joined'] );

		if( !$this->perms->auth( 'post_viewip', $forum ) ) {
			$post['post_ip'] = null;
		}

		$post['user_avatar'] = $this->htmlwidgets->display_avatar( $post );

		if( $post['user_signature'] && $this->user['user_view_signatures'] ) {
			$post['user_signature'] = '.........................<br>' . $this->format( $post['user_signature'], FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_BBCODE | FORMAT_EMOJIS );
		} else {
			$post['user_signature'] = null;
		}

		$this->lang->members();

		$xtpl = new XTemplate( './skins/' . $this->skin . '/newspost.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'user_avatar', $post['user_avatar'] );
		$xtpl->assign( 'topic_online', $this->lang->topic_online );
		$xtpl->assign( 'topic_offline', $this->lang->topic_offline );
		$xtpl->assign( 'members_email_member', $this->lang->members_email_member );
		$xtpl->assign( 'members_send_pm', $this->lang->members_send_pm );
		$xtpl->assign( 'members_visit_twitter', $this->lang->members_visit_twitter );
		$xtpl->assign( 'members_visit_facebook', $this->lang->members_visit_facebook );
		$xtpl->assign( 'members_visit_www', $this->lang->members_visit_www );

		if( $online )
			$xtpl->parse( 'MemberInfo.Online' );
		else
			$xtpl->parse( 'MemberInfo.Offline' );

		$xtpl->assign( 'user_id', $post['user_id'] );
		$xtpl->assign( 'user_name', $post['user_name'] );
		$xtpl->assign( 'link_name', $this->htmlwidgets->clean_url( $post['user_name'] ) );
		$xtpl->assign( 'user_title', $post['user_title'] );
		$xtpl->assign( 'membertitle_icon', $post['membertitle_icon'] );
		$xtpl->assign( 'topic_group', $this->lang->topic_group );
		$xtpl->assign( 'group_name', $post['group_name'] );
		$xtpl->assign( 'topic_posts', $this->lang->topic_posts );
		$xtpl->assign( 'user_posts', $post['user_posts'] );
		$xtpl->assign( 'topic_joined', $this->lang->topic_joined );
		$xtpl->assign( 'user_joined', $post['user_joined'] );

		if( $post['post_ip'] ) {
			$xtpl->assign( 'post_author', $post['post_author'] );
			$xtpl->assign( 'post_ip', $post['post_ip'] );

			$xtpl->parse( 'MemberInfo.PostIP' );
		}

		if( !$post['user_pm'] || $this->perms->is_guest ) {
			$post['user_pm'] = null;
		}

		$this->lang->members(); // Time to cheat!

		if( $post['user_email_form'] && $this->perms->auth( 'email_use' ) ) {
			$xtpl->assign( 'user_id', $post['user_id'] );
			$xtpl->assign( 'email_link_name', $this->htmlwidgets->clean_url( $post['user_name'] ) );

			$xtpl->parse( 'MemberInfo.EmailForm' );
		}

		if( $post['user_pm'] ) {
			$xtpl->assign( 'encoded_name', base64_encode( $post['user_name'] ) );

			$xtpl->parse( 'MemberInfo.PM' );
		}

		if( $post['user_twitter'] ) {
			$xtpl->assign( 'twitter', 'https://x.com/' . $post['user_twitter'] );

			$xtpl->parse( 'MemberInfo.Twitter' );
		}

		if( $post['user_facebook'] ) {
			$xtpl->assign( 'facebook', $post['user_facebook'] );

			$xtpl->parse( 'MemberInfo.Facebook' );
		}

		if( $post['user_homepage'] ) {
			$xtpl->assign( 'homepage', $post['user_homepage'] );

			$xtpl->parse( 'MemberInfo.Homepage' );
		}

		$xtpl->parse( 'MemberInfo' );
		return $xtpl->text( 'MemberInfo' );
	}
}
?>