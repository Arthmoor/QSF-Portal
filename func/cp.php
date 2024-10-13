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

/**
 * User Control Panel
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class cp extends qsfglobal
{
	/** Files allowed to be used as avatars **/
	private $fileExtensions = array( 'jpg', 'jpeg', 'gif', 'png' );

	public function execute()
	{
		if( !$this->perms->auth( 'board_view' ) ) {
			$this->lang->board();

			return $this->message(
				sprintf( $this->lang->board_message, $this->sets['forum_name'] ),
				( $this->perms->is_guest ) ? sprintf( $this->lang->board_regfirst, $this->site ) : $this->lang->board_noview
			);
		}

		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		if( $this->perms->is_guest ) {
			return $this->message( $this->lang->cp_cp, $this->lang->cp_login_first );
		}

		$xtpl = new XTemplate( './skins/' . $this->skin . '/cp.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );

		switch( $this->get['s'] )
		{
		case 'cpass':
			$control_page = $this->edit_pass( $xtpl );
			break;

		case 'profile':
			$control_page = $this->edit_profile( $xtpl );
			break;

		case 'avatar':
			$control_page = $this->edit_avatar( $xtpl );
			break;

		case 'prefs':
			$control_page = $this->edit_prefs( $xtpl );
			break;

		case 'subs':
			$control_page = $this->edit_subs( $xtpl );
			break;

		case 'sig':
			$control_page = $this->edit_sig( $xtpl );
			break;

		case 'addsub':
			$control_page = $this->add_sub( );
			break;

		default:
			$this->set_title( $this->lang->cp_cp );
			$this->tree( $this->lang->cp_cp );

			$this->get['s'] = null;

			$xtpl->assign( 'cp_welcome', $this->lang->cp_welcome );

			$xtpl->parse( 'CPHome' );
			$control_page = $xtpl->text( 'CPHome' );
		}

		$xtpl->assign( 'cp_header', $this->lang->cp_header );
		$xtpl->assign( 'cp_label_edit_avatar', $this->lang->cp_label_edit_avatar );
		$xtpl->assign( 'cp_label_edit_pass', $this->lang->cp_label_edit_pass );
		$xtpl->assign( 'cp_label_edit_prefs', $this->lang->cp_label_edit_prefs );
		$xtpl->assign( 'cp_label_edit_profile', $this->lang->cp_label_edit_profile );
		$xtpl->assign( 'cp_label_edit_subs', $this->lang->cp_label_edit_subs );
		$xtpl->assign( 'cp_label_edit_sig', $this->lang->cp_label_edit_sig );
		$xtpl->assign( 'control_page', $control_page );

		$xtpl->parse( 'ControlPanel' );
		return $xtpl->text( 'ControlPanel' );
	}

	private function check_pass( $passA, $passB, $old_pass )
	{
		if( !password_verify( $old_pass, $this->user['user_password'] ) ) {
			return PASS_NOT_VERIFIED;
		}

		if( $passA != $passB ) {
			return PASS_NO_MATCH;
		}

		if( !$this->validator->validate( $passA, TYPE_PASSWORD ) ) {
			return PASS_INVALID;
		}

		return PASS_SUCCESS;
	}

	private function edit_pass( $xtpl )
	{
		$this->set_title ($this->lang->cp_changing_pass );
		$this->tree( $this->lang->cp_cp, "{$this->site}/control_panel/" );
		$this->tree( $this->lang->cp_changing_pass );

		if( !isset($this->post['submit'] ) ) {
			$xtpl->assign( 'cp_label_edit_pass', $this->lang->cp_label_edit_pass );
			$xtpl->assign( 'cp_old_pass', $this->lang->cp_old_pass );
			$xtpl->assign( 'cp_new_pass', $this->lang->cp_new_pass );
			$xtpl->assign( 'cp_repeat_pass', $this->lang->cp_repeat_pass );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'EditPassword' );
			return $xtpl->text( 'EditPassword' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->cp_changing_pass, $this->lang->invalid_token );
			}

			$result = $this->check_pass( $this->post['passA'], $this->post['passB'], $this->post['old_pass'] );

			switch( $result )
			{
			case PASS_NOT_VERIFIED:
				return $this->message( $this->lang->cp_changing_pass, $this->lang->cp_old_notmatch );
				break;

			case PASS_INVALID:
				return $this->message( $this->lang->cp_changing_pass, $this->lang->cp_pass_notvaid );
				break;

			case PASS_NO_MATCH:
				return $this->message( $this->lang->cp_changing_pass, $this->lang->cp_new_notmatch );
				break;

			case PASS_SUCCESS:
				$hashed_pass = $this->qsfp_password_hash( $this->post['passA'] );
				$this->db->query( "UPDATE %pusers SET user_password='%s' WHERE user_id=%d", $hashed_pass, $this->user['user_id'] );

				$options = array( 'expires' => $this->time + $this->sets['logintime'], 'path' => $this->sets['cookie_path'], 'domain' => $this->sets['cookie_domain'], 'secure' => $this->sets['cookie_secure'], 'HttpOnly' => true, 'SameSite' => 'Lax' );

				setcookie( $this->sets['cookie_prefix'] . 'pass', $hashed_pass, $options );

				$_SESSION['pass'] = md5( $hashed_pass . $this->ip );
				$this->user['user_password'] = $hashed_pass;

				return $this->message( $this->lang->cp_changing_pass, sprintf( $this->lang->cp_valided, $this->site ) );
				break;
			}
		}
	}

	private function edit_prefs( $xtpl )
	{
		$this->set_title( $this->lang->cp_preferences );
		$this->tree( $this->lang->cp_cp, "{$this->site}/control_panel/" );
		$this->tree( $this->lang->cp_preferences );

		if( !isset( $this->post['submit'] ) ) {
			$xtpl->assign( 'cp_label_edit_prefs', $this->lang->cp_label_edit_prefs );

			$xtpl->assign( 'cp_zone', $this->lang->cp_zone );

			$time_list = $this->htmlwidgets->select_timezones( $this->user['user_timezone'] );
			$xtpl->assign( 'time_list', $time_list );

			$xtpl->assign( 'cp_skin', $this->lang->cp_skin );
			$skin_list = $this->htmlwidgets->select_skins( $this->user['user_skin'] );
			$xtpl->assign( 'skin_list', $skin_list );

			$xtpl->assign( 'cp_language', $this->lang->cp_language );
			$lang_list = $this->htmlwidgets->select_langs( $this->user['user_language'] );
			$xtpl->assign( 'lang_list', $lang_list );

			$xtpl->assign( 'cp_topic_option', $this->lang->cp_topic_option );

			$ViewAvCheck = $this->user['user_view_avatars'] ? ' checked=\'checked\'' : null;
			$ViewSiCheck = $this->user['user_view_signatures'] ? ' checked=\'checked\'' : null;
			$ViewEmCheck = $this->user['user_view_emojis'] ? ' checked=\'checked\'' : null;
			$user_email_showCheck = $this->user['user_email_show'] ? ' checked=\'checked\'' : null;
			$EmailFormCheck = $this->user['user_email_form'] ? ' checked=\'checked\'' : null;
			$user_pmCheck = $this->user['user_pm'] ? ' checked=\'checked\'' : null;
			$user_pm_mailCheck = $this->user['user_pm_mail'] ? ' checked=\'checked\'' : null;
			$active_check = $this->user['user_active'] ? ' checked=\'checked\'' : null;

			$xtpl->assign( 'ViewAvCheck', $ViewAvCheck );
			$xtpl->assign( 'ViewSiCheck', $ViewSiCheck );
			$xtpl->assign( 'ViewEmCheck', $ViewEmCheck );
			$xtpl->assign( 'user_email_showCheck', $user_email_showCheck );
			$xtpl->assign( 'EmailFormCheck', $EmailFormCheck );
			$xtpl->assign( 'user_pmCheck', $user_pmCheck );
			$xtpl->assign( 'user_pm_mailCheck', $user_pm_mailCheck );
			$xtpl->assign( 'active_check', $active_check );

			$xtpl->assign( 'cp_topic_option', $this->lang->cp_topic_option );
			$xtpl->assign( 'cp_view_avatar', $this->lang->cp_view_avatar );
			$xtpl->assign( 'cp_view_emoji', $this->lang->cp_view_emoji );
			$xtpl->assign( 'cp_view_signature', $this->lang->cp_view_signature );
			$xtpl->assign( 'user_topics_page', $this->user['user_topics_page'] );
			$xtpl->assign( 'cp_topics_page', $this->lang->cp_topics_page );
			$xtpl->assign( 'user_posts_page', $this->user['user_posts_page'] );
			$xtpl->assign( 'cp_posts_page', $this->lang->cp_posts_page );
			$xtpl->assign( 'cp_privacy', $this->lang->cp_privacy );
			$xtpl->assign( 'cp_show_email', $this->lang->cp_show_email );
			$xtpl->assign( 'cp_email_form', $this->lang->cp_email_form );
			$xtpl->assign( 'cp_contact_pm', $this->lang->cp_contact_pm );
			$xtpl->assign( 'cp_contact_pm_email', $this->lang->cp_contact_pm_email );
			$xtpl->assign( 'cp_show_active', $this->lang->cp_show_active );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'EditPreferences' );
			return $xtpl->text( 'EditPreferences' );
		} else {
			$view_avatars = $view_sigs = $view_emojis = $show_email = $email_form = $user_pm = $pm_mail = $active = 0;

			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->cp_updated_prefs, $this->lang->invalid_token );
			}

			if( isset( $this->post['user_view_avatars'] ) ) {
				$view_avatars = 1;
			}

			if( isset( $this->post['user_view_signatures'] ) ) {
				$view_sigs = 1;
			}

			if( isset( $this->post['user_view_emojis'] ) ) {
				$view_emojis = 1;
			}

			if( isset( $this->post['user_email_show'] ) ) {
				$show_email = 1;
			}

			if( isset( $this->post['user_email_form'] ) ) {
				$email_form = 1;
			}

			if( isset( $this->post['user_pm'] ) ) {
				$user_pm = 1;
			}

			if( isset( $this->post['user_pm_mail'] ) ) {
				$pm_mail = 1;
			}

			if( isset( $this->post['user_active'] ) ) {
				$active = 1;
			}

			$posts_per_page = $this->sets['posts_per_page'];
			if( isset( $this->post['user_posts_page'] ) ) {
				$posts_per_page = intval( $this->post['user_posts_page'] );
			}
			if ( $posts_per_page < 0 )
				$posts_per_page = 0;
			if ($posts_per_page > 99)
				$post_per_page = 99;

			$topic_per_page = $this->sets['topics_per_page'];
			if( isset( $this->post['user_topics_page'] ) ) {
				$topics_per_page = intval( $this->post['user_topics_page'] );
			}
			if( $topics_per_page < 0 )
				$topics_per_page = 0;
			if( $topics_per_page > 99 )
				$topics_per_page = 99;

			$this->post['user_language'] = preg_replace( '/[^a-zA-Z0-9\-]/', '', $this->post['user_language'] );

			$this->db->query( "UPDATE %pusers SET user_view_avatars=%d, user_view_signatures=%d, user_view_emojis=%d,
				  user_email_show=%d, user_email_form=%d, user_active=%d, user_pm=%d, user_pm_mail=%d,
				  user_timezone='%s', user_skin='%s', user_language='%s',
				  user_topics_page=%d, user_posts_page=%d
				WHERE user_id=%d",
				$view_avatars, $view_sigs, $view_emojis, $show_email, $email_form, $active,
				$user_pm, $pm_mail, $this->post['user_timezone'], $this->post['user_skin'], $this->post['user_language'],
				$topic_per_page, $posts_per_page, $this->user['user_id'] );

			return $this->message( $this->lang->cp_updated_prefs, $this->lang->cp_been_updated_prefs );
		}
	}

	private function edit_profile( $xtpl )
	{
		if( !$this->perms->auth( 'edit_profile' ) ) {
			return $this->message( $this->lang->cp_editing_profile, $this->lang->cp_no_edit_profile );
		}

		$this->set_title( $this->lang->cp_editing_profile );
		$this->tree( $this->lang->cp_cp, "{$this->site}/control_panel/" );
		$this->tree( $this->lang->cp_editing_profile );

		if( !isset( $this->post['submit'] ) ) {
			list( $year, $mon, $day ) = explode( '-', $this->user['user_birthday'] );

			$day_list   = $this->htmlwidgets->select_days( $day );
			$month_list = $this->htmlwidgets->select_months( $mon );
			$year_list  = $this->htmlwidgets->select_years( $year );

			$xtpl->assign( 'cp_label_edit_profile', $this->lang->cp_label_edit_profile );
			$xtpl->assign( 'cp_format', $this->lang->cp_format );
			$xtpl->assign( 'user_name', $this->user['user_name'] );
			$xtpl->assign( 'cp_email', $this->lang->cp_email );
			$xtpl->assign( 'user_email', $this->user['user_email'] );
			$xtpl->assign( 'cp_pass', $this->lang->cp_pass );
			$xtpl->assign( 'cp_pass2', $this->lang->cp_pass2 );
			$xtpl->assign( 'cp_bday', $this->lang->cp_bday );
			$xtpl->assign( 'month_list', $month_list );
			$xtpl->assign( 'day_list', $day_list );
			$xtpl->assign( 'year_list', $year_list );
			$xtpl->assign( 'cp_location', $this->lang->cp_location );
			$xtpl->assign( 'user_location', $this->user['user_location'] );

			if( $this->perms->auth( 'is_admin' ) ) {
				$xtpl->assign( 'cp_custom_title', $this->lang->cp_custom_title );
				$xtpl->assign( 'cp_custom_title2', $this->lang->cp_custom_title2 );
				$xtpl->assign( 'user_title', $this->user['user_title'] );

				$xtpl->parse( 'EditProfile.Admin' );
			}

			$xtpl->assign( 'cp_interest', $this->lang->cp_interest );
			$xtpl->assign( 'user_interests', $this->user['user_interests'] );
			$xtpl->assign( 'cp_twitter', $this->lang->cp_twitter );
			$xtpl->assign( 'user_twitter', $this->user['user_twitter'] );
			$xtpl->assign( 'cp_facebook', $this->lang->cp_facebook );
			$xtpl->assign( 'user_facebook', $this->user['user_facebook'] );
			$xtpl->assign( 'cp_www', $this->lang->cp_www );
			$xtpl->assign( 'user_homepage', $this->user['user_homepage'] );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			$xtpl->parse( 'EditProfile' );
			return $xtpl->text( 'EditProfile' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->cp_updated, $this->lang->invalid_token );
			}

			$this->post['Newuser_name'] = str_replace( '\\', '&#092;', $this->format( $this->post['Newuser_name'], FORMAT_HTMLCHARS | FORMAT_CENSOR ) );

			if( $this->db->fetch( "SELECT user_id FROM %pusers WHERE REPLACE(LOWER(user_name), ' ', '')='%s' AND user_id != %d",
				$this->post['Newuser_name'], $this->user['user_id'] ) )
			{
				return $this->message( $this->lang->cp_err_updating, $this->lang->cp_user_exists );
			}

			if( strtolower( str_replace( ' ', '', $this->user['user_name'] ) ) != strtolower( str_replace( ' ', '', $this->post['Newuser_name'] ) ) ) {
				return $this->message( $this->lang->cp_err_updating, $this->lang->cp_must_orig );
			}

			if( strlen( $this->post['Newuser_name'] ) > 32 ) {
				return $this->message( $this->lang->cp_err_updating, $this->lang->cp_less_charac );
			}

			$temp_email = $this->post['user_email'];
			if( !$this->validator->validate( $temp_email, TYPE_EMAIL ) ) {
				return $this->message( $this->lang->cp_err_updating, $this->lang->cp_email_invaid );
			}

			if( $this->post['user_email'] != $this->user['user_email'] ) {
				if( !isset( $this->post['passA'] ) ) {
					return $this->message( $this->lang->cp_changing_email, $this->lang->cp_pass_notmatch );
				}

				if( !password_verify( $this->post['passA'], $this->user['user_password'] ) ) {
					return $this->message( $this->lang->cp_changing_email, $this->lang->cp_pass_notmatch );
				}
			}

			if( $this->db->fetch( "SELECT user_email FROM %pusers WHERE user_email='%s' AND user_id !=%d",
				 $this->post['user_email'], $this->user['user_id'] ) )
			{
				return $this->message( $this->lang->cp_err_updating, $this->lang->cp_already_member );
			}

			if( !empty( $this->post['user_homepage'] ) && ( ( substr( $this->post['user_homepage'], 0, 7 ) != 'http://' ) && ( substr( $this->post['user_homepage'], 0, 8 ) != 'https://' ) ) ) {
				$this->post['user_homepage'] = 'http://' . $this->post['user_homepage'];
			}

			if( !empty( $this->post['user_facebook'] ) && ( ( substr( $this->post['user_facebook'], 0, 7 ) != 'http://' ) && ( substr( $this->post['user_facebook'], 0, 8 ) != 'https://' ) ) ) {
				$this->post['user_facebook'] = 'https://' . $this->post['user_facebook'];
			}

			if( strlen( $this->post['day'] ) == 1 ) {
				$this->post['day'] = '0' . $this->post['day'];
			}

			if( strlen( $this->post['month'] ) == 1 ) {
				$this->post['month'] = '0' . $this->post['month'];
			}

			$user_birthday = $this->post['year'] . '-' . $this->post['month'] . '-' . $this->post['day'];

			if( !checkdate( $this->post['month'], $this->post['day'], $this->post['year'] ) && ( $user_birthday != '1900-01-01' ) ) {
				return $this->message( $this->lang->cp_err_updating, sprintf( $this->lang->cp_not_exist, $user_birthday ) );
			}

			// I'm not sure if the anti-spam code needs to use the escaped strings or not, so I'll feed them whatever the spammer fed me.
			if( !empty( $this->sets['wordpress_api_key'] ) && $this->sets['akismet_profiles'] && !empty($this->post['user_homepage'] ) ) {
				require_once $this->sets['include_path'] . '/lib/akismet.php';

				$spam_checked = false;
				$akismet = null;

				try {
					$akismet = new Akismet( $this );
					$akismet->set_comment_author( $this->user['user_name'] );
					$akismet->set_comment_author_email( $this->user['user_email'] );
					$akismet->set_comment_author_url( $this->post['user_homepage'] );
					$akismet->set_comment_content( $this->post['user_interests'] );
					$akismet->set_comment_type( 'user-profile' );

					$spam_checked = true;
				}
				// Try and deal with it rather than say something.
				catch( Exception $e ) {}

				if( $spam_checked && $akismet != null ) {
               $response = $akismet->is_this_spam();

               if( isset( $response[1] ) && $response[1] == 'true' ) {
                  $this->log_action( 'Blocked Profile Update', 0, 0, 0 );

                  $this->sets['spam_profile_count']++;
                  $this->write_sets();

                  return $this->message( $this->lang->cp_err_updating, $this->lang->cp_profile_spam );
               }
				}
			}

			$homepage = '';
			$facebook = '';
			$location = '';
			$interests = '';
			$twitter = '';

			if( isset( $this->post['user_homepage'] ) )
				$homepage  = $this->format( $this->post['user_homepage'], FORMAT_HTMLCHARS );
			if( isset( $this->post['user_facebook'] ) )
				$facebook  = $this->format( $this->post['user_facebook'], FORMAT_HTMLCHARS );
			if( isset( $this->post['user_location'] ) )
				$location  = $this->format( $this->post['user_location'], FORMAT_HTMLCHARS );
			if( isset( $this->post['user_interests'] ) )
				$interests = $this->format( $this->post['user_interests'], FORMAT_HTMLCHARS );
			if( isset( $this->post['user_twitter'] ) )
				$twitter   = $this->format( $this->post['user_twitter'], FORMAT_HTMLCHARS );

			if( $this->perms->auth( 'is_admin' ) ) {
				$query = $this->db->query( "SELECT membertitle_title FROM %pmembertitles" );

				if( !isset( $this->post['user_title'] ) || $this->post['user_title'] == '' ) {
					$usertitle = '';
					$custom_title = 0;
				} else {
					$usertitle = $this->format( $this->post['user_title'], FORMAT_HTMLCHARS );
					$custom_title = 1;
				}

				while( $u = $this->db->nqfetch( $query ) )
				{
					$utitle = $u['membertitle_title'];

					if( strcmp( $utitle, $this->post['user_title'] ) == 0 ) {
						$custom_title = 0;
						$usertitle = $utitle;
						break;
					}
				}
			} else {
				$usertitle = $this->user['user_title'];
				$custom_title = $this->user['user_title_custom'];
			}

			$this->db->query( "UPDATE %pusers SET
				  user_email='%s', user_birthday='%s', user_homepage='%s', user_facebook='%s', user_location ='%s',
				  user_interests='%s', user_twitter='%s', user_title='%s', user_title_custom=%d, user_name='%s'
				WHERE user_id=%d",
				$this->post['user_email'], $user_birthday, $homepage, $facebook, $location,
				$interests, $twitter, $usertitle, $custom_title, $this->post['Newuser_name'],
				$this->user['user_id'] );

			if( $this->post['Newuser_name'] != $this->user['user_name'] ) {
				$this->db->query( "UPDATE %pposts SET post_edited_by='%s' WHERE post_edited_by='%s'",
					$this->post['Newuser_name'], $this->user['user_name'] );
			}

			return $this->message( $this->lang->cp_updated, $this->lang->cp_been_updated );
		}
	}

	private function edit_avatar( $xtpl )
	{
		if( !$this->perms->auth( 'edit_avatar' ) ) {
			return $this->message( $this->lang->cp_editing_avatar, $this->lang->cp_no_edit_avatar );
		}

		$this->set_title( $this->lang->cp_editing_avatar );
		$this->tree( $this->lang->cp_cp, "{$this->site}/control_panel/" );
		$this->tree( $this->lang->cp_editing_avatar );

		if( !isset( $this->post['submit'] ) ) {
			$xtpl->assign( 'cp_label_edit_avatar', $this->lang->cp_label_edit_avatar );
			$xtpl->assign( 'cp_current_avatar', $this->lang->cp_current_avatar );
			$xtpl->assign( 'user_avatar_width', $this->user['user_avatar_width'] );
			$xtpl->assign( 'user_avatar_height', $this->user['user_avatar_height'] );

			if( empty( $this->user['user_avatar'] ) ) {
				$this->user['user_avatar']   = "{$this->site}/skins/{$this->skin}/images/noavatar.png";
				$this->user['user_avatar_width']  = $this->sets['avatar_width'];
				$this->user['user_avatar_height'] = $this->sets['avatar_height'];
			}

			$xtpl->assign( 'cp_label_edit_avatar', $this->lang->cp_label_edit_avatar );
			$xtpl->assign( 'avatar_width', $this->sets['avatar_width'] );
			$xtpl->assign( 'avatar_height', $this->sets['avatar_height'] );

			$avatar_list = $this->htmlwidgets->select_avatars( $this->user['user_avatar'] );
			if( !$avatar_list )
				$xtpl->assign( 'no_display', ' style="display:none;"' );
			$xtpl->assign( 'avatar_list', $avatar_list );

			$xtpl->assign( 'cp_avatar_select', $this->lang->cp_avatar_select );

			$checks[0] = ( $this->user['user_avatar_type'] == 'local' ) ? ' checked=\'checked\'' : null;
			$checks[1] = ( $this->user['user_avatar_type'] == 'url' ) ? ' checked=\'checked\'' : null;
			$checks[2] = ( $this->user['user_avatar_type'] == 'gravatar' ) ? ' checked=\'checked\'' : null;
			$checks[3] = ( $this->user['user_avatar_type'] == 'uploaded' ) ? ' checked=\'checked\'' : null;
			$checks[4] = ( $this->user['user_avatar_type'] == 'none' ) ? ' checked=\'checked\'' : null;

			$xtpl->assign( 'checks0', $checks[0] );
			$xtpl->assign( 'checks1', $checks[1] );
			$xtpl->assign( 'checks2', $checks[2] );
			$xtpl->assign( 'checks3', $checks[3] );
			$xtpl->assign( 'checks4', $checks[4] );

			if( $avatar_list ) {
				$xtpl->assign( 'avatar_select', $avatar_list );
				$xtpl->assign( 'list_line', '<p class="line"></p>' );
			} else
				$xtpl->assign( 'avatar_select', '<option value=""></option>' );

			$avatar = $this->user['user_avatar'];
			$avatar_url = null;
			$gravatar_url = null;

			$localavatarsrc = "{$this->site}/skins/{$this->skin}/images/noavatar.png";

			if( $this->user['user_avatar_type'] == 'local' ) {
				$avatar = "{$this->site}/avatars/$avatar";
				$localavatarsrc = $avatar;
			} elseif( $this->user['user_avatar_type'] == 'url' ) {
				$avatar_url = $avatar;
			} elseif( $this->user['user_avatar_type'] == 'gravatar' )  {
				$gravatar_url = $avatar;
				$avatar = $this->htmlwidgets->get_gravatar( $avatar );
			} elseif( $this->user['user_avatar_type'] == 'uploaded' ) {
				$avatar = "{$this->site}/avatars/uploaded/$avatar";
			} else {
				$avatar = "{$this->site}/skins/{$this->skin}/images/noavatar.png";
			}

			$xtpl->assign( 'avatar', $avatar );
			$xtpl->assign( 'localavatarsrc', $localavatarsrc );
			$xtpl->assign( 'cp_avatar_url', $this->lang->cp_avatar_url );
			$xtpl->assign( 'avatar_url', $avatar_url );
			$xtpl->assign( 'cp_avatar_gravatar', $this->lang->cp_avatar_gravatar );
			$xtpl->assign( 'gravatar_url', $gravatar_url );

			$xtpl->assign( 'cp_avatar_upload', $this->lang->cp_avatar_upload );
			$xtpl->assign( 'cp_avatar_use', $this->lang->cp_avatar_use );
			$xtpl->assign( 'cp_avatar_none', $this->lang->cp_avatar_none );
			$xtpl->assign( 'old_avatar', $this->user['user_avatar'] );

			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );

			// In the HTML 'uploaded' is called 'use_uploaded'
			$init = ($this->user['user_avatar_type'] == 'uploaded') ? 'use_uploaded' : null;
			$xtpl->assign( 'init', $init );

			$xtpl->parse( 'EditAvatar' );
			return $xtpl->text( 'EditAvatar' );
		} else {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->cp_label_edit_avatar, $this->lang->invalid_token );
			}

			$temp = explode( '.',  $this->user['user_avatar'] );
			$fileExtension  = array_pop( $temp );
			if( !in_array( $fileExtension, $this->fileExtensions ) ) {
				$fileExtension = 'avtr';
			}

			switch( $this->post['user_avatar_type'] )
			{
			case 'local':
				if( !isset( $this->post['avatar_local'] ) ) {
					return $this->message( $this->lang->cp_err_avatar, $this->lang->cp_avatar_must_select );
				}

				$image = getimagesize( './avatars/' . $this->post['avatar_local'] );

				if( $image[0] > $this->sets['avatar_width'] )
					$image[0] = $this->sets['avatar_width'];
				if( $image[1] > $this->sets['avatar_height'] )
					$image[1] = $this->sets['avatar_height'];

				$this->user['user_avatar_width']  = $image[0];
				$this->user['user_avatar_height'] = $image[1];

				$avatar = trim( $this->post['avatar_local'] );
				$type = 'local';
				$this->delete_avatar();
				break;

			case 'url':
				if( !preg_match( '/\.(gif|jpg|jpeg|png)$/i', $this->post['avatar_url'] ) ) {
					return $this->message( $this->lang->cp_err_avatar, $this->lang->cp_file_type );
				}

				$image = getimagesize( $this->post['avatar_url'] );
				if( $image === false ) {
					return $this->message( $this->lang->cp_err_avatar, $this->lang->cp_file_type );
				}

				if( $image[0] > $this->sets['avatar_width'] )
					$image[0] = $this->sets['avatar_width'];
				if( $image[1] > $this->sets['avatar_height'] )
					$image[1] = $this->sets['avatar_height'];

				$this->user['user_avatar_width']  = $image[0];
				$this->user['user_avatar_height'] = $image[1];

				$avatar = $this->format( trim( $this->post['avatar_url'] ), FORMAT_HTMLCHARS );
				$type = 'url';
				$this->delete_avatar();
				break;

			case 'upload':
				if( !isset( $this->files['avatar_upload'] ) ) {
					return $this->message( $this->lang->cp_avatar_error, $this->lang->cp_avatar_upload_failed );
				}

				// Get extension
				$tmp = explode( '.',  $this->files['avatar_upload']['name'] );
				$fileExtension  = array_pop( $tmp );
				if( !in_array( $fileExtension, $this->fileExtensions ) ) {
					return $this->message( $this->lang->cp_label_edit_avatar, $this->lang->cp_avatar_upload_not_image );
				}

				$this->delete_avatar();
				$new_fname = './avatars/uploaded/' . $this->user['user_id'] . '.' . $fileExtension;
				$upload = $this->attachmentutil->upload( $this->files['avatar_upload'], $new_fname, $this->sets['avatar_upload_size'], array( 'jpg', 'jpeg', 'gif', 'png' ) );

				switch( $upload )
				{
				case UPLOAD_TOO_LARGE:
					return $this->message( $this->lang->cp_avatar_error, sprintf( $this->lang->cp_avatar_upload_too_large, round( $this->sets['avatar_upload_size']/1024, 1 ) ) );
					break 2;

				case UPLOAD_NOT_ALLOWED:
					return $this->message( $this->lang->cp_avatar_error, $this->lang->cp_avatar_upload_not_image );
					break 2;

				case UPLOAD_FAILURE:
					return $this->message( $this->lang->cp_avatar_error, $this->lang->cp_avatar_upload_failed );
					break 2;
				}

				// Force resize the new avatar
				$image = $this->resize_avatar( $new_fname, $new_fname, $fileExtension, $this->sets['avatar_width'], $this->sets['avatar_height'] );

				$this->user['user_avatar_width']  = $image['width'];
				$this->user['user_avatar_height'] = $image['height'];

				// Allows things such as rsync to backup avatars
				$this->chmod( $new_fname, 0644, false );

				// Deliberate fall through
			case 'use_uploaded':
				$avatar = $this->user['user_id'] . '.' . $fileExtension;
				$type = 'uploaded';
				break;

			case 'gravatar':
				if( !$this->validator->validate( $this->post['avatar_gurl'], TYPE_EMAIL ) ) {
					return $this->message( $this->lang->cp_avatar_error, $this->lang->cp_gravatar_upload_failed );
				}

				$avatar = trim( $this->post['avatar_gurl'] );
				$type = 'gravatar';
				$this->delete_avatar();
				break;

			default:
				$avatar = '';
				$type = 'none';
				$image = getimagesize( "{$this->site}/skins/{$this->skin}/images/noavatar.png" );
				$this->user['user_avatar_width']  = $image[0];
				$this->user['user_avatar_height'] = $image[1];
				$this->delete_avatar();
				break;
			}

			$this->db->query( "UPDATE %pusers SET user_avatar='%s', user_avatar_type='%s', user_avatar_width=%d, user_avatar_height=%d
				WHERE user_id=%d",
				$avatar, $type, $this->user['user_avatar_width'], $this->user['user_avatar_height'], $this->user['user_id'] );

			return $this->message( $this->lang->cp_updated1, $this->lang->cp_been_updated1 );
		}
	}

	private function edit_subs( $xtpl )
	{
		$this->set_title( $this->lang->cp_sub_change );
		$this->tree( $this->lang->cp_cp, "{$this->site}/control_panel/" );
		$this->tree( $this->lang->cp_sub_change );

		$this->db->query( "DELETE FROM %psubscriptions WHERE subscription_expire < %d", $this->time );

		$xtpl->assign( 'cp_label_edit_subs', $this->lang->cp_label_edit_subs );
		$xtpl->assign( 'cp_sub_delete', $this->lang->cp_sub_delete );
		$xtpl->assign( 'cp_sub_type', $this->lang->cp_sub_type );
		$xtpl->assign( 'cp_sub_name', $this->lang->cp_sub_name );
		$xtpl->assign( 'cp_sub_expire', $this->lang->cp_sub_expire );

		if( !isset( $this->post['submit'] ) ) {
			$query = $this->db->query( "SELECT s.subscription_id, s.subscription_type, s.subscription_expire, f.forum_name, f.forum_id, t.topic_title, t.topic_id
				FROM %psubscriptions s
				LEFT JOIN %pforums f ON (s.subscription_type = 'forum' AND f.forum_id = s.subscription_item)
				LEFT JOIN %ptopics t ON (s.subscription_type = 'topic' AND t.topic_id = s.subscription_item)
				WHERE s.subscription_user = %d
				ORDER BY s.subscription_expire", $this->user['user_id'] );

			while( $sub = $this->db->nqfetch( $query ) )
			{
				if( $sub['subscription_type'] == 'topic' ) {
					$sub['item_name'] = $sub['topic_title'];
					$topic_link = $this->htmlwidgets->clean_url( $sub['topic_title'] );
					$link = "{$this->site}/topic/{$topic_link}-{$sub['topic_id']}/";
				} else {
					$sub['item_name'] = $sub['forum_name'];
					$forum_link = $this->htmlwidgets->clean_url( $sub['forum_name'] );
					$link = "{$this->site}/forum/{$forum_link}-{$sub['forum_id']}/";
				}

				$sub['item_name'] = $this->format( $sub['item_name'], FORMAT_HTMLCHARS | FORMAT_CENSOR );
				$sub['subscription_expire'] = $this->mbdate( DATE_LONG, $sub['subscription_expire'] );

				$xtpl->assign( 'subscription_id', $sub['subscription_id'] );
				$xtpl->assign( 'subscription_type', $sub['subscription_type'] );
				$xtpl->assign( 'link', $link );
				$xtpl->assign( 'item_name', $sub['item_name'] );
				$xtpl->assign( 'subscription_expire', $sub['subscription_expire'] );

				$xtpl->parse( 'EditSubs.Row' );
			}
		} else {
			if( isset( $this->post['delete'] ) ) {
				$delSubs = array();

				foreach( $this->post['delete'] as $id => $true )
				{
					$delSubs[] = intval( $id );
				}

				$this->db->query( "DELETE FROM %psubscriptions WHERE subscription_user=%d AND subscription_id IN (%s)",
					$this->user['user_id'], implode( ', ', $delSubs ) );
			}

			return $this->message( $this->lang->cp_sub_change, $this->lang->cp_sub_updated );
		}

		$xtpl->assign( 'submit', $this->lang->submit );

		$xtpl->parse( 'EditSubs' );
		return $xtpl->text( 'EditSubs' );
	}

	/**
	 * Allows better handling over signatures
	 *
	 * @author Jonathan West <jon@quicksilverforums.com>
	 * @since v1.1.6
	 **/
	private function edit_sig( $xtpl )
	{
		if( !$this->perms->auth( 'edit_sig' ) ) {
			return $this->message( $this->lang->cp_label_edit_sig, $this->lang->cp_no_edit_sig );
		}

		if( $this->user['user_group'] == USER_MEMBER && $this->user['user_posts'] < 5 ) {
			return $this->message( $this->lang->cp_label_edit_sig, $this->lang->cp_no_edit_sig );
		}

		$this->set_title( $this->lang->cp_label_edit_sig );
		$this->tree( $this->lang->cp_cp, "{$this->site}/control_panel/" );
		$this->tree( $this->lang->cp_label_edit_sig );
		$params = FORMAT_CENSOR | FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_BBCODE | FORMAT_EMOJIS;

		if( isset( $this->post['submit'] ) ) {
			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->cp_label_edit_sig, $this->lang->invalid_token );
			}

			// I'm not sure if the anti-spam code needs to use the escaped strings or not, so I'll feed them whatever the spammer fed me.
			if( !empty( $this->sets['wordpress_api_key'] ) && $this->sets['akismet_sigs'] ) {
				if( !$this->perms->auth( 'is_admin' ) && $this->user['user_posts'] < $this->sets['akismet_posts_number'] ) {
					require_once $this->sets['include_path'] . '/lib/akismet.php';

					$spam_checked = false;
					$akismet = null;

					try {
						$akismet = new Akismet( $this );
						$akismet->set_comment_author( $this->user['user_name'] );
						$akismet->set_comment_author_email( $this->user['user_email'] );
						$akismet->set_comment_content( $this->post['sig'] );
						$akismet->set_comment_type( 'user-signature' );

						$spam_checked = true;
					}
					// Try and deal with it rather than say something.
					catch(Exception $e) {}

					if( $spam_checked && $akismet != null && $akismet->is_this_spam() ) {
						$this->log_action( 'Blocked Signature Update', 0, 0, 0 );

						$this->sets['spam_sig_count']++;
						$this->write_sets();

						return $this->message( $this->lang->cp_label_edit_sig, $this->lang->cp_label_edit_sig_spam );
					}
				}
			}
			$this->db->query( "UPDATE %pusers SET user_signature='%s' WHERE user_id=%d", $this->post['sig'], $this->user['user_id'] );
		}

		$query = $this->db->query( "SELECT user_signature FROM %pusers WHERE user_id=%d", $this->user['user_id'] );
		$pr = $this->db->nqfetch( $query );
		$preview = $this->format( $pr['user_signature'], $params );
		$edit = $pr['user_signature'];
		$bbcode_menu = $this->bbcode->get_bbcode_menu();
		$smilies = $this->bbcode->generate_emoji_links();

		$xtpl->assign( 'cp_label_edit_sig', $this->lang->cp_label_edit_sig );
		$xtpl->assign( 'cp_preview_sig', $this->lang->cp_preview_sig );
		$xtpl->assign( 'preview', $preview );
		$xtpl->assign( 'smilies', $smilies );
		$xtpl->assign( 'bbcode_menu', $bbcode_menu );
		$xtpl->assign( 'edit', $edit );

		$xtpl->assign( 'token', $this->generate_token() );
		$xtpl->assign( 'submit', $this->lang->submit );

		$xtpl->parse( 'EditSig' );
		return $xtpl->text( 'EditSig' );
	}
	 
	private function add_sub()
	{
		$this->set_title( $this->lang->cp_cp );
		$this->tree( $this->lang->cp_cp );

		if( !isset( $this->get['item'] ) || !isset( $this->get['type'] ) ) {
			return $this->message( $this->lang->cp_cp, $this->lang->cp_sub_no_params );
		}

		$item = intval( $this->get['item'] );

		$expires = $this->time + 2592000; // 30 days

		$this->db->query( "DELETE FROM %psubscriptions WHERE subscription_user=%d AND subscription_type='%s' AND subscription_item=%d",
			$this->user['user_id'], $this->get['type'], $item );
		$this->db->query( "INSERT INTO %psubscriptions (subscription_user, subscription_type, subscription_item, subscription_expire)
			VALUES (%d, '%s', %d, %d)",
			$this->user['user_id'], $this->get['type'], $item, $expires );

		return $this->message( $this->lang->cp_cp, sprintf( $this->lang->cp_sub_success, $this->get['type'] ) );
	}

	/**
	 * Delete the old uploaded avatar if any
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since v1.3.0
	 **/
	private function delete_avatar()
	{
		if( $this->user['user_avatar_type'] == 'uploaded' ) {
			@unlink( "./avatars/uploaded/{$this->user['user_avatar']}" );
		}
	}

	private function resize_avatar( $name, $filename, $ext, $new_w, $new_h )
	{
		$thumb_w = 1;
		$thumb_h = 1;

		$system = explode( '.', $name );
		$src_img = null;

		if( preg_match( '/jpg|jpeg/', $ext ) )
			$src_img = imagecreatefromjpeg( $name );
		else if ( preg_match( '/png/', $ext ) )
			$src_img = imagecreatefrompng( $name );
		else if ( preg_match( '/gif/', $ext ) )
			$src_img = imagecreatefromgif( $name );
		$old_x = imageSX( $src_img );
		$old_y = imageSY( $src_img );

		if( $old_x <= $new_w && $old_y <= $new_h ) {
			$thumb_w = $old_x;
			$thumb_h = $old_y;
		} else {
			if( $old_x > $old_y ) {
				$thumb_w = $new_w;
				$thumb_h = $old_y * ( $new_h / $old_x );
			}
			if( $old_x < $old_y ) {
				$thumb_w = $old_x * ( $new_w / $old_y );
				$thumb_h = $new_h;
			}
			if( $old_x == $old_y ) {
				$thumb_w = $new_w;
				$thumb_h = $new_h;
			}
		}

      $thumb_w = intval( $thumb_w );
      $thumb_h = intval( $thumb_h );
		$dst_img = ImageCreateTrueColor( $thumb_w, $thumb_h );
		imagecopyresampled( $dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y );
		if( preg_match( '/png/', $ext ) )
			imagepng( $dst_img, $filename );
		else if( preg_match( '/jpg|jpeg/', $ext ) )
			imagejpeg( $dst_img, $filename );
		else
			imagegif( $dst_img, $filename );
		imagedestroy( $dst_img );
		imagedestroy( $src_img );
		return array( 'width' => $thumb_w, 'height' => $thumb_h );
	}
}
?>