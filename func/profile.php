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

if( !defined( 'QUICKSILVERFORUMS' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

require_once $set['include_path'] . '/global.php';

/**
 * Viewing a user's profile
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class profile extends qsfglobal
{
	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->site ) : $this->lang->board_noview
			);
		}

		$this->set_title( $this->lang->profile_view_profile );

		$this->tree( $this->lang->profile_list, $this->self . '?a=members' );
		$this->tree( $this->lang->profile_view_profile );

		if( !isset( $this->get['uname'] ) || !isset( $this->get['w'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->profile_profile, $this->lang->profile_must_user );
		}

		if( !$this->validator->validate( $this->get['uname'], TYPE_STRING ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->profile_profile, $this->lang->profile_must_user );
		}

		if( !$this->validator->validate( $this->get['w'], TYPE_INT ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->profile_profile, $this->lang->profile_must_user );
		}

		$uname = strtolower( $this->get['uname'] );
		$uid = intval( $this->get['w'] );

		$profile = $this->db->fetch( "SELECT u.*, g.group_name, a.active_time
			FROM (%pusers u, %pgroups g)
			LEFT JOIN %pactive a ON a.active_id=u.user_id
			WHERE u.user_id=%d AND g.group_id=u.user_group", $uid );

		if( !$profile || ( $uid == USER_GUEST_UID ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->profile_view_profile, $this->lang->profile_no_member );
		}

		if( $uname != $this->htmlwidgets->clean_url( $profile['user_name'] ) ) {
			header( 'HTTP/1.0 404 Not Found' );
			return $this->message( $this->lang->profile_view_profile, $this->lang->profile_no_member );
		}

		if( $profile['user_birthday'] == '1900-01-01' ) {
			$profile['user_birthday'] = null;
		}

		if( !$profile['user_pm'] || $this->perms->is_guest ) {
			$profile['user_pm'] = null;
		}

		$profile['user_avatar'] = $this->htmlwidgets->display_avatar( $profile );

		$user_joined = $this->mbdate( DATE_LONG, $profile['user_joined'] );
		$user_lastvisit = $this->mbdate( DATE_LONG, $profile['user_lastvisit'] );

		$profile['user_email'] = null;

		if( $this->perms->auth( 'email_use' ) ) {
			if( $profile['user_email_show'] ) {
				$profile['user_email'] = "<a href=\"mailto:{$profile['user_email']}\">{$profile['user_email']}</a>";
			} else {
				if( $profile['user_email_form'] ) {
					$link = $this->htmlwidgets->clean_url( $profile['user_name'] );
					$profile['user_email'] = "<a href=\"{$this->site}/email/{$link}-{$profile['user_id']}/\">{$this->lang->profile_private}</a>";
				} else {
					$profile['user_email'] = $this->lang->profile_private;
				}
			}
		}

		if( !$profile['user_twitter'] ) {
			$profile['user_twitter'] = null;
		}

		if( $profile['user_signature'] ) {
			$profile['user_signature'] = $this->format( $profile['user_signature'], FORMAT_HTMLCHARS | FORMAT_CENSOR | FORMAT_EMOJIS | FORMAT_BBCODE | FORMAT_BREAKS );
		} else {
			$profile['user_signature'] = $this->lang->profile_none;
		}

		$xtpl = new XTemplate( './skins/' . $this->skin . '/profile.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );
		$xtpl->assign( 'self', $this->self );
		$xtpl->assign( 'profile_profile', $this->lang->profile_profile );
		$xtpl->assign( 'profile_online', $this->lang->profile_online );
		$xtpl->assign( 'profile_offline', $this->lang->profile_offline );

		if( $profile['user_avatar'] != null ) {
			$xtpl->assign( 'user_avatar', $profile['user_avatar'] );

			$xtpl->parse( 'Profile.Avatar' );
		}

		$online = ( $profile['active_time'] && ( $profile['active_time'] > ( $this->time - 900 ) ) && $profile['user_active'] );
		if( $online ) {
			$xtpl->parse( 'Profile.Online' );
		} else {
			$xtpl->parse( 'Profile.Offline' );
		}

		$xtpl->assign( 'user_name', $profile['user_name'] );
		$xtpl->assign( 'user_title', $profile['user_title'] );
		$xtpl->assign( 'profile_member', $this->lang->profile_member );
		$xtpl->assign( 'group_name', $profile['group_name'] );
		$xtpl->assign( 'profile_posts', $this->lang->profile_posts );
		$xtpl->assign( 'user_posts', $profile['user_posts'] );
		$xtpl->assign( 'profile_joined', $this->lang->profile_joined );
		$xtpl->assign( 'user_joined', $user_joined );

		if( $profile['user_signature'] != $this->lang->profile_none || $profile['user_interests'] ) {
			$avatar_center = ( $profile['user_avatar_width'] ? ( ( $profile['user_avatar_width'] / 2 ) - 3 ) : 22 );

			$xtpl->assign( 'avatar_center', $avatar_center );

			$xtpl->parse( 'Profile.SigBlockHeader' );
		}

		if( $profile['user_interests'] ) {
			$xtpl->assign( 'profile_interest', $this->lang->profile_interest );
			$xtpl->assign( 'user_interests', $profile['user_interests'] );

			$xtpl->parse( 'Profile.Interests' );
		}

		if( $profile['user_signature'] != $this->lang->profile_none ) {
			$xtpl->assign( 'user_signature', $profile['user_signature'] );

			$xtpl->parse( 'Profile.Signature' );
		}

		if( $profile['user_signature'] != $this->lang->profile_none || $profile['user_interests'] ) {
			$xtpl->parse( 'Profile.SigBlockFooter' );
		}

		$xtpl->assign( 'profile_contact', $this->lang->profile_contact );

		if( $profile['user_email'] ) {
			$xtpl->assign( 'profile_email_address', $this->lang->profile_email_address );
			$xtpl->assign( 'user_email', $profile['user_email'] );

			$xtpl->parse( 'Profile.Email' );
		}

		if( $profile['user_pm'] ) {
			$xtpl->assign( 'profile_pm', $this->lang->profile_pm );
			$xtpl->assign( 'user_id', $profile['user_id'] );

			$xtpl->parse( 'Profile.PM' );
		}

		$xtpl->assign( 'profile_info', $this->lang->profile_info );
		$xtpl->assign( 'profile_member_title', $this->lang->profile_member_title );
		$xtpl->assign( 'profile_last_visit', $this->lang->profile_last_visit );
		$xtpl->assign( 'user_lastvisit', $user_lastvisit );

		if( $profile['user_twitter'] ) {
			$xtpl->assign( 'twitter', $this->lang->twitter );
			$xtpl->assign( 'user_twitter', $profile['user_twitter'] );

			$xtpl->parse( 'Profile.Twitter' );
		}

		if( $profile['user_facebook']  ) {
			$xtpl->assign( 'profile_facebook', $this->lang->profile_facebook );
			$xtpl->assign( 'user_facebook', $profile['user_facebook'] );

			$xtpl->parse( 'Profile.Facebook' );
		}

		if( $profile['user_homepage'] ) {
			$xtpl->assign( 'profile_www', $this->lang->profile_www );
			$xtpl->assign( 'user_homepage', $profile['user_homepage'] );

			$xtpl->parse( 'Profile.Homepage' );
		}

		if( $profile['user_birthday'] ) {
			$xtpl->assign( 'profile_bday', $this->lang->profile_bday );
			$xtpl->assign( 'user_birthday', $profile['user_birthday'] );

			$xtpl->parse( 'Profile.Birthday' );
		}

		if( $profile['user_location'] ) {
			$xtpl->assign( 'profile_location', $this->lang->profile_location );
			$xtpl->assign( 'user_location', $profile['user_location'] );

			$xtpl->parse( 'Profile.Location' );
		}

		if( $profile['user_posts'] ) {
			$user_postsPerDay = $profile['user_posts'] / ( ( ( $this->time - $profile['user_joined'] ) / 86400 ) );

			if( $user_postsPerDay > $profile['user_posts'] ) { // It's mathematically correct, but not logical
				$user_postsPerDay = $profile['user_posts'];
			}

			$user_postsPerDay = number_format( $user_postsPerDay, 2, $this->lang->sep_decimals, $this->lang->sep_thousands );

			$fav = $this->db->query( "SELECT COUNT(p.post_id) AS Forumuser_posts, f.forum_id AS Forum, f.forum_name
				FROM %pposts p, %ptopics t, %pforums f
				WHERE p.post_topic=t.topic_id AND t.topic_forum=f.forum_id AND p.post_author=%d
				GROUP BY t.topic_forum
				ORDER BY Forumuser_posts DESC", $uid );

			$final_fav = null;

			while( $f = $this->db->nqfetch( $fav ) )
			{
				if( $this->perms->auth( 'forum_view', $f['Forum'] ) ) {
					$final_fav = $f;
					break;
				}
			}

			$last = $this->db->fetch( "SELECT t.topic_id, t.topic_forum, t.topic_title, p.post_time
				FROM %ptopics t, %pposts p
				WHERE t.topic_id = p.post_topic AND p.post_author=%d
				ORDER BY p.post_time DESC
				LIMIT 1", $profile['user_id'] );

			if( isset( $last['topic_forum'] ) && $this->perms->auth( 'topic_view', $last['topic_forum'] ) ) {
				$topic_link = $this->htmlwidgets->clean_url( $last['topic_title'] );

				if( strlen( $last['topic_title'] ) > 25 ) {
					$last['topic_title'] = substr( $last['topic_title'], 0, 22 ) . '...';
				}

				$lastpost = "<a href=\"{$this->site}/topic/{$topic_link}-{$last['topic_id']}/\">" . $this->format( $last['topic_title'], FORMAT_CENSOR | FORMAT_HTMLCHARS ) . '</a><br />' . $this->mbdate( DATE_LONG, $last['post_time'] );
			} else {
				$lastpost = $this->lang->profile_unkown;
			}

			if( isset( $final_fav['Forum'] ) ) {
				$posts_total = $this->db->fetch( "SELECT COUNT(post_id) as count FROM %pposts WHERE post_author=%d", $uid );

				if( !$posts_total['count'] ) {
					$fav_forum = $this->lang->profile_unkown;
				} else {
					$link = $this->htmlwidgets->clean_url( $final_fav['forum_name'] );
					$fav_forum = sprintf( $this->lang->profile_fav_forum, "<a href=\"{$this->site}/forum/{$link}-{$final_fav['Forum']}/\">{$final_fav['forum_name']}</a>", round( $final_fav['Forumuser_posts'] / $posts_total['count'] * 100 ) );
				}
			} else {
				$fav_forum = $this->lang->profile_unkown;
			}

			$profile['user_posts'] = "<a href=\"{$this->self}?a=search&amp;id=$uid\">" . sprintf( $this->lang->profile_postcount, number_format( $profile['user_posts'], 0, null, $this->lang->sep_thousands ), $user_postsPerDay ) . '</a>';

			$xtpl->assign( 'profile_posts', $this->lang->profile_posts );
			$xtpl->assign( 'user_posts', $profile['user_posts'] );
			$xtpl->assign( 'profile_fav', $this->lang->profile_fav );
			$xtpl->assign( 'fav_forum', $fav_forum );
			$xtpl->assign( 'profile_last_post', $this->lang->profile_last_post );
			$xtpl->assign( 'lastpost', $lastpost );

			$xtpl->parse( 'Profile.Posts' );
		}

		if( $profile['user_uploads'] ) {
			$last = $this->db->fetch( "SELECT file_id, file_name, file_date FROM %pfiles
				WHERE file_submitted=%d ORDER BY file_date DESC LIMIT 1", $uid );

			$lastfile = $this->lang->profile_uploads_none_yet;
			if( isset( $last['file_id'] ) ) {
				$furl = $this->htmlwidgets->clean_url( $last['file_name'] );
				$date = $this->mbdate( DATE_LONG, $last['file_date'] );
				$lastfile = "<a href=\"{$this->site}/files/{$furl}-{$last['file_id']}/\">{$last['file_name']}</a><br />{$date}";
			}

			$usetime = ( ( ( $this->time - $profile['user_joined'] ) / 86400 ) );
			if( $usetime < 1 ) {
				$usetime = 1;
			}
			$uploadsPerDay = $profile['user_uploads'] / $usetime;
			$uploadsPerDay = number_format( $uploadsPerDay, 2, $this->lang->sep_decimals, $this->lang->sep_thousands );
			$uploads = "<a href=\"{$this->self}?a=files&amp;s=search&amp;uid={$uid}\">{$profile['user_uploads']} {$this->lang->profile_uploads_total}, {$uploadsPerDay} {$this->lang->profile_uploads_per_day}</a>";

			$xtpl->assign( 'profile_uploads', $this->lang->profile_uploads );
			$xtpl->assign( 'uploads', $uploads );
			$xtpl->assign( 'profile_upload_last', $this->lang->profile_upload_last );
			$xtpl->assign( 'lastfile', $lastfile );

			$xtpl->parse( 'Profile.Uploads' );
		} 

		$xtpl->parse( 'Profile' );
		return $xtpl->text( 'Profile' );
	}
}
?>