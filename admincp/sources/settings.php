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

if( !defined( 'QUICKSILVERFORUMS' ) || !defined( 'QSF_ADMIN' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

require_once $set['include_path'] . '/admincp/admin.php';

class settings extends admin
{
	public function execute()
	{
		if( !isset( $this->get['s'] ) ) {
			$this->get['s'] = null;
		}

		switch( $this->get['s'] )
		{
		case 'showcaptcha':
			$this->set_title( $this->lang->settings_captcha_display );
			$this->tree( $this->lang->settings_captcha_display );

			$list = $this->db->query( 'SELECT * FROM %pcaptcha' );

			$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/settings_captcha.xtpl' );

			$xtpl->assign( 'settings_captcha_display', $this->lang->settings_captcha_display );

			while( $item = $this->db->nqfetch( $list ) )
			{
				$question = $item['cap_question'];
				$answer = $item['cap_answer'];
				$cap_id = $item['cap_id'];

				$xtpl->assign( 'settings_captcha_question', $this->lang->settings_captcha_question );
				$xtpl->assign( 'question', $question );
				$xtpl->assign( 'settings_captcha_answer', $this->lang->settings_captcha_answer );
				$xtpl->assign( 'answer', $answer );
				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'cap_id', $cap_id );
				$xtpl->assign( 'edit', $this->lang->edit );
				$xtpl->assign( 'delete', $this->lang->delete );

				$xtpl->parse( 'Captchas.Display.Entry' );
			}

			$xtpl->parse( 'Captchas.Display' );
			$xtpl->parse( 'Captchas' );

			return $xtpl->text( 'Captchas' );
			break;

		case 'deletecaptcha':
			$this->set_title( $this->lang->settings_captcha_delete );
			$this->tree( $this->lang->settings_captcha_delete );

			if( !isset( $this->post['submit'] ) ) {
				$c = intval( $this->get['c'] );

				if( $c < 1 )
					return $this->message( $this->lang->settings_captcha_delete, $this->lang->settings_captcha_invalid );

				$cap = $this->db->fetch( 'SELECT * FROM %pcaptcha WHERE cap_id=%d', $c );

				if( !$cap )
					return $this->message( $this->lang->settings_captcha_delete, $this->lang->settings_captcha_no_pair );

				$cap_id = $cap['cap_id'];
				$question = $cap['cap_question'];
				$answer = $cap['cap_answer'];

				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/settings_captcha.xtpl' );

				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'cap_id', $cap_id );
				$xtpl->assign( 'settings_captcha_delete', $this->lang->settings_captcha_delete );
				$xtpl->assign( 'settings_captcha_question', $this->lang->settings_captcha_question );
				$xtpl->assign( 'question', $question );
				$xtpl->assign( 'settings_captcha_answer', $this->lang->settings_captcha_answer );
				$xtpl->assign( 'answer', $answer );
				$xtpl->assign( 'token', $this->generate_token() );
				$xtpl->assign( 'delete', $this->lang->delete );

				$xtpl->parse( 'Captchas.DeleteForm' );
				$xtpl->parse( 'Captchas' );

				return $xtpl->text( 'Captchas' );
			}

			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->settings_captcha_delete, $this->lang->invalid_token );
			}

			$c = intval( $this->get['c'] );
			$cap = $this->db->fetch( 'SELECT * FROM %pcaptcha WHERE cap_id=%d', $c );

			if( !$cap )
				return $this->message( $this->lang->settings_captcha_delete, $this->lang->settings_captcha_no_pair );

			$this->db->query( "DELETE FROM %pcaptcha WHERE cap_id=%d", $c );

			return $this->message( $this->lang->settings_captcha_delete, $this->lang->settings_captcha_deleted );
			break;

		case 'editcaptcha':
			$this->set_title( $this->lang->settings_captcha_edit );
			$this->tree( $this->lang->settings_captcha_edit );

			if( !isset( $this->post['submit'] ) ) {
				$c = intval( $this->get['c'] );

				if( $c < 1 )
					return $this->message( $this->lang->settings_captcha_edit, $this->lang->settings_captcha_invalid );

				$cap = $this->db->fetch( 'SELECT * FROM %pcaptcha WHERE cap_id=%d', $c );

				if( !$cap )
					return $this->message( $this->lang->settings_captcha_edit, $this->lang->settings_captcha_no_pair );

				$cap_id = $cap['cap_id'];
				$question = $cap['cap_question'];
				$answer = $cap['cap_answer'];

				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/settings_captcha.xtpl' );

				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'cap_id', $cap_id );
				$xtpl->assign( 'settings_captcha_edit', $this->lang->settings_captcha_edit );
				$xtpl->assign( 'settings_captcha_question', $this->lang->settings_captcha_question );
				$xtpl->assign( 'question', $question );
				$xtpl->assign( 'settings_captcha_answer', $this->lang->settings_captcha_answer );
				$xtpl->assign( 'answer', $answer );
				$xtpl->assign( 'token', $this->generate_token() );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'Captchas.EditForm' );
				$xtpl->parse( 'Captchas' );

				return $xtpl->text( 'Captchas' );
			}

			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->settings_captcha_edit, $this->lang->invalid_token );
			}

			$c = intval( $this->get['c'] );
			$cap = $this->db->fetch( 'SELECT * FROM %pcaptcha WHERE cap_id=%d', $c );

			if( !$cap )
				return $this->message( $this->lang->settings_captcha_edit, $this->lang->settings_captcha_no_pair );

			$this->db->query( "UPDATE %pcaptcha SET cap_question='%s', cap_answer='%s' WHERE cap_id=%d", $this->post['cap_question'], $this->post['cap_answer'], $c );

			return $this->message( $this->lang->settings_captcha_edit, $this->lang->settings_captcha_edited );
			break;

		case 'captcha':
			$this->set_title( $this->lang->settings_captcha_pair );
			$this->tree( $this->lang->settings_captcha_pair );

			if( !isset( $this->post['submit'] ) ) {
				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/settings_captcha.xtpl' );

				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'settings_captcha_pair', $this->lang->settings_captcha_pair );
				$xtpl->assign( 'settings_captcha_new_question', $this->lang->settings_captcha_new_question );
				$xtpl->assign( 'settings_captcha_new_answer', $this->lang->settings_captcha_new_answer );
				$xtpl->assign( 'token', $this->generate_token() );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'Captchas.AddForm' );
				$xtpl->parse( 'Captchas' );

				return $xtpl->text( 'Captchas' );
			}

			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->settings_captcha_pair, $this->lang->invalid_token );
			}

			if( empty( $this->post['cap_question'] ) || empty( $this->post['cap_answer'] ) )
				return $this->message( $this->lang->settings_captcha_pair, $this->lang->settings_captcha_missing );

			$this->db->query( "INSERT INTO %pcaptcha (cap_question, cap_answer) VALUES( '%s', '%s' )", $this->post['cap_question'], $this->post['cap_answer'] );

			return $this->message( $this->lang->settings_captcha_pair, $this->lang->settings_captcha_added );
			break;

		case 'add':
			$this->set_title( $this->lang->settings_new_add );
			$this->tree( $this->lang->settings_new_add );

			if( !isset( $this->post['submit'] ) ) {
				$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/settings.xtpl' );

				$xtpl->assign( 'site', $this->site );
				$xtpl->assign( 'settings_new', $this->lang->settings_new );
				$xtpl->assign( 'settings_new_name', $this->lang->settings_new_name );
				$xtpl->assign( 'settings_new_value', $this->lang->settings_new_value );
				$xtpl->assign( 'settings_new_array', $this->lang->settings_new_array );
				$xtpl->assign( 'token', $this->generate_token() );
				$xtpl->assign( 'submit', $this->lang->submit );

				$xtpl->parse( 'Settings.AddForm' );
				$xtpl->parse( 'Settings' );

				return $xtpl->text( 'Settings' );
			}
			else {
				if( !$this->is_valid_token() ) {
					return $this->message( $this->lang->settings_new, $this->lang->invalid_token );
				}

				if( empty( $this->post['new_setting'] ) ) {
					return $this->message( $this->lang->settings_new, $this->lang->settings_new_required );
				}

				$new_setting = $this->post['new_setting'];

				if( isset( $this->sets[$new_setting] ) ) {
					return $this->message( $this->lang->settings_new, $this->lang->settings_new_exists );
				}

				$is_new_array = isset( $this->post['is_array'] );

				if( $is_new_array )
					$new_value = explode( ',', $this->post['new_value'] );
				else
					$new_value = $this->post['new_value'];

				$this->sets[$new_setting] = $new_value;
				$this->write_sets();

				return $this->message( $this->lang->settings_new, $this->lang->settings_new_added );
			}
			break;

		case 'basic':
			$this->set_title( $this->lang->settings_basic );
			$this->tree( $this->lang->settings_basic );

			$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/settings.xtpl' );
			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'token', $this->generate_token() );
			$xtpl->assign( 'submit', $this->lang->submit );
			$xtpl->assign( 'enabled', $this->lang->settings_enabled );
			$xtpl->assign( 'disabled', $this->lang->settings_disabled );
			$xtpl->assign( 'yes', $this->lang->settings_default_yes );
			$xtpl->assign( 'no', $this->lang->settings_default_no );
			$xtpl->assign( 'option_yes', $this->lang->yes );
			$xtpl->assign( 'option_no', $this->lang->no );

			$xtpl->assign( 'settings_general', $this->lang->settings_general );
			$xtpl->assign( 'settings_board_enabled', $this->lang->settings_board_enabled );

			$enable_checked = null;
			if( !$this->sets['closed'] )
				$enable_checked = "checked=\"checked\"";
			$xtpl->assign( 'enable_checked', $enable_checked );

			$disable_checked = null;
			if( $this->sets['closed'] )
				$disable_checked = "checked=\"checked\"";
			$xtpl->assign( 'disable_checked', $disable_checked );

			$xtpl->assign( 'settings_enabled', $this->lang->settings_enabled );
			$xtpl->assign( 'settings_disabled', $this->lang->settings_disabled );

			$xtpl->assign( 'settings_disabled_notice', $this->lang->settings_disabled_notice );
			$xtpl->assign( 'settings_show_notice', $this->lang->settings_show_notice );
			$xtpl->assign( 'closedtext', $this->format( $this->sets['closedtext'], FORMAT_HTMLCHARS ) );

			$xtpl->assign( 'settings_board_name', $this->lang->settings_board_name );
			$xtpl->assign( 'forum_name', $this->format( $this->sets['forum_name'], FORMAT_HTMLCHARS ) );

			$xtpl->assign( 'settings_board_location', $this->lang->settings_board_location );
			$xtpl->assign( 'loc_of_board', $this->sets['loc_of_board'] );

			$xtpl->assign( 'settings_meta_keywords', $this->lang->settings_meta_keywords );
			$xtpl->assign( 'meta_keywords', htmlspecialchars( $this->sets['meta_keywords'] ) );

			$xtpl->assign( 'settings_meta_description', $this->lang->settings_meta_description );
			$xtpl->assign( 'meta_desc', htmlspecialchars( $this->sets['meta_description'] ) );

			$xtpl->assign( 'settings_mobile_icons', $this->lang->settings_mobile_icons );
			$xtpl->assign( 'mobile_icons', htmlspecialchars( $this->sets['mobile_icons'] ) );
			$xtpl->assign( 'settings_mobile_icons_desc', $this->lang->settings_mobile_icons_desc );
			$xtpl->assign( 'settings_mobile_icons_details', $this->lang->settings_mobile_icons_details );

			$xtpl->assign( 'settings_topics_page', $this->lang->settings_topics_page );
			$xtpl->assign( 'topics_per_page', $this->sets['topics_per_page'] );

			$xtpl->assign( 'settings_posts_topic', $this->lang->settings_posts_topic );
			$xtpl->assign( 'posts_per_page', $this->sets['posts_per_page'] );

			$xtpl->assign( 'settings_hot_topic', $this->lang->settings_hot_topic );
			$xtpl->assign( 'hot_limit', $this->sets['hot_limit'] );

			$xtpl->assign( 'settings_edit_post_age', $this->lang->settings_edit_post_age );
			$xtpl->assign( 'edit_post_age', $this->sets['edit_post_age'] );

			$xtpl->assign( 'settings_antibot', $this->lang->settings_antibot );

			$antibot_enabled = null;
			if( $this->sets['register_image'] )
				$antibot_enabled = "checked=\"checked\"";
			$xtpl->assign( 'antibot_enabled', $antibot_enabled );

			$antibot_disabled = null;
			if( !$this->sets['register_image'] )
				$antibot_disabled = "checked=\"checked\"";
			$xtpl->assign( 'antibot_disabled', $antibot_disabled );

			$xtpl->assign( 'settings_registrations', $this->lang->settings_registrations );

			$registrations_enabled = null;
			if( $this->sets['registrations_allowed'] )
				$registrations_enabled = "checked=\"checked\"";
			$xtpl->assign( 'registrations_enabled', $registrations_enabled );

			$registrations_disabled = null;
			if( !$this->sets['registrations_allowed'] )
				$registrations_disabled = "checked=\"checked\"";
			$xtpl->assign( 'registrations_disabled', $registrations_disabled );

			$xtpl->assign( 'settings_tos', $this->lang->settings_tos );
			$tos = $this->db->fetch( "SELECT settings_tos FROM %psettings" );
			$xtpl->assign( 'tos_text', htmlspecialchars( $tos['settings_tos'] ) );

			$xtpl->assign( 'settings_tos_files', $this->lang->settings_tos_files );
			$tos = $this->db->fetch( "SELECT settings_tos_files FROM %psettings" );
			$xtpl->assign( 'tos_files_text', htmlspecialchars( $tos['settings_tos_files'] ) );

			$xtpl->assign( 'settings', $this->lang->settings );
			$xtpl->assign( 'settings_wordpress_id', $this->lang->settings_wordpress_id );
			$xtpl->assign( 'settings_wordpress_msg', $this->lang->settings_wordpress_msg );
			$xtpl->assign( 'wordpress_api_key', $this->sets['wordpress_api_key'] );

			$xtpl->assign( 'settings_akismet_email_enable', $this->lang->settings_akismet_email_enable );
			$xtpl->assign( 'settings_akismet_email_enable_msg', $this->lang->settings_akismet_email_enable_msg );

			$akismet_email_enabled = null;
			if( $this->sets['akismet_email'] )
				$akismet_email_enabled = "checked=\"checked\"";
			$xtpl->assign( 'akismet_email_enabled', $akismet_email_enabled );

			$akismet_email_disabled = null;
			if( !$this->sets['akismet_email'] )
				$akismet_email_disabled = "checked=\"checked\"";
			$xtpl->assign( 'akismet_email_disabled', $akismet_email_disabled );

			$xtpl->assign( 'settings_akismet_ureg_enable', $this->lang->settings_akismet_ureg_enable );
			$xtpl->assign( 'settings_akismet_ureg_enable_msg', $this->lang->settings_akismet_ureg_enable_msg );

			$akismet_ureg_enabled = null;
			if( $this->sets['akismet_ureg'] )
				$akismet_ureg_enabled = "checked=\"checked\"";
			$xtpl->assign( 'akismet_ureg_enabled', $akismet_ureg_enabled );

			$akismet_ureg_disabled = null;
			if( !$this->sets['akismet_ureg'] )
				$akismet_ureg_disabled = "checked=\"checked\"";
			$xtpl->assign( 'akismet_ureg_disabled', $akismet_ureg_disabled );

			$xtpl->assign( 'settings_akismet_profiles_enable', $this->lang->settings_akismet_profiles_enable );
			$xtpl->assign( 'settings_akismet_profiles_enable_msg', $this->lang->settings_akismet_profiles_enable_msg );

			$akismet_profiles_enabled = null;
			if( $this->sets['akismet_profiles'] )
				$akismet_profiles_enabled = "checked=\"checked\"";
			$xtpl->assign( 'akismet_profiles_enabled', $akismet_profiles_enabled );

			$akismet_profiles_disabled = null;
			if( !$this->sets['akismet_profiles'] )
				$akismet_profiles_disabled = "checked=\"checked\"";
			$xtpl->assign( 'akismet_profiles_disabled', $akismet_profiles_disabled );

			$xtpl->assign( 'settings_akismet_sigs_enable', $this->lang->settings_akismet_sigs_enable );
			$xtpl->assign( 'settings_akismet_sigs_enable_msg', $this->lang->settings_akismet_sigs_enable_msg );

			$akismet_sigs_enabled = null;
			if( $this->sets['akismet_sigs'] )
				$akismet_sigs_enabled = "checked=\"checked\"";
			$xtpl->assign( 'akismet_sigs_enabled', $akismet_sigs_enabled );

			$akismet_sigs_disabled = null;
			if( !$this->sets['akismet_sigs'] )
				$akismet_sigs_disabled = "checked=\"checked\"";
			$xtpl->assign( 'akismet_sigs_disabled', $akismet_sigs_disabled );

			$xtpl->assign( 'settings_akismet_posts_enable', $this->lang->settings_akismet_posts_enable );
			$xtpl->assign( 'settings_akismet_posts_enable_msg', $this->lang->settings_akismet_posts_enable_msg );

			$akismet_posts_enabled = null;
			if( $this->sets['akismet_posts'] )
				$akismet_posts_enabled = "checked=\"checked\"";
			$xtpl->assign( 'akismet_posts_enabled', $akismet_posts_enabled );

			$akismet_posts_disabled = null;
			if( !$this->sets['akismet_posts'] )
				$akismet_posts_disabled = "checked=\"checked\"";
			$xtpl->assign( 'akismet_posts_disabled', $akismet_posts_disabled );

			$xtpl->assign( 'settings_members', $this->lang->settings_members );

			$xtpl->assign( 'settings_default_skin', $this->lang->settings_default_skin );
			$selectSkins = $this->htmlwidgets->select_skins( $this->sets['default_skin'] );
			$xtpl->assign( 'selectSkins', $selectSkins );

			$xtpl->assign( 'settings_default_lang', $this->lang->settings_default_lang );
			$defaultlang = $this->htmlwidgets->select_langs($this->sets['default_lang'], '..');
			$xtpl->assign( 'defaultlang', $defaultlang );

			$xtpl->assign( 'settings_group_after', $this->lang->settings_group_after );
			$selectGroups = $this->htmlwidgets->select_groups( $this->sets['default_group'] );
			$xtpl->assign( 'selectGroups', $selectGroups );

			$xtpl->assign( 'settings_timezone', $this->lang->settings_timezone );
			$selectTimezones = $this->htmlwidgets->select_timezones( $this->sets['default_timezone'] );
			$xtpl->assign( 'selectTimezones', $selectTimezones );

			$xtpl->assign( 'settings_show_avatars', $this->lang->settings_show_avatars );

			$view_avatars_enabled = null;
			if( $this->sets['default_view_avatars'] )
				$view_avatars_enabled = "checked=\"checked\"";
			$xtpl->assign( 'view_avatars_enabled', $view_avatars_enabled );

			$view_avatars_disabled = null;
			if( !$this->sets['default_view_avatars'] )
				$view_avatars_disabled = "checked=\"checked\"";
			$xtpl->assign( 'view_avatars_disabled', $view_avatars_disabled );

			$xtpl->assign( 'settings_show_sigs', $this->lang->settings_show_sigs );

			$view_sigs_enabled = null;
			if( $this->sets['default_view_sigs'] )
				$view_sigs_enabled = "checked=\"checked\"";
			$xtpl->assign( 'view_sigs_enabled', $view_sigs_enabled );

			$view_sigs_disabled = null;
			if( !$this->sets['default_view_sigs'] )
				$view_sigs_disabled = "checked=\"checked\"";
			$xtpl->assign( 'view_sigs_disabled', $view_sigs_disabled );

			$xtpl->assign( 'settings_show_emojis', $this->lang->settings_show_emojis );

			$view_emojis_enabled = null;
			if( $this->sets['default_view_emots'] )
				$view_emojis_enabled = "checked=\"checked\"";
			$xtpl->assign( 'view_emojis_enabled', $view_emojis_enabled );

			$view_emojis_disabled = null;
			if( !$this->sets['default_view_emots'] )
				$view_emojis_disabled = "checked=\"checked\"";
			$xtpl->assign( 'view_emojis_disabled', $view_emojis_disabled );

			$xtpl->assign( 'settings_show_pm', $this->lang->settings_show_pm );

			$accept_pms_enabled = null;
			if( $this->sets['default_pm'] )
				$accept_pms_enabled = "checked=\"checked\"";
			$xtpl->assign( 'accept_pms_enabled', $accept_pms_enabled );

			$accept_pms_disabled = null;
			if( !$this->sets['default_pm'] )
				$accept_pms_disabled = "checked=\"checked\"";
			$xtpl->assign( 'accept_pms_disabled', $accept_pms_disabled );

			$xtpl->assign( 'settings_show_email', $this->lang->settings_show_email );

			$show_email_enabled = null;
			if( $this->sets['default_email_shown'] )
				$show_email_enabled = "checked=\"checked\"";
			$xtpl->assign( 'show_email_enabled', $show_email_enabled );

			$show_email_disabled = null;
			if( !$this->sets['default_email_shown'] )
				$show_email_disabled = "checked=\"checked\"";
			$xtpl->assign( 'show_email_disabled', $show_email_disabled );

			$xtpl->assign( 'settings_polls', $this->lang->settings_polls );
			$xtpl->assign( 'settings_polls_yes', $this->lang->settings_polls_yes );
			$xtpl->assign( 'settings_polls_no', $this->lang->settings_polls_no );

			$vote_after_enabled = null;
			if( $this->sets['vote_after_results'] )
				$vote_after_enabled = "checked=\"checked\"";
			$xtpl->assign( 'vote_after_enabled', $vote_after_enabled );

			$vote_after_disabled = null;
			if( !$this->sets['vote_after_results'] )
				$vote_after_disabled = "checked=\"checked\"";
			$xtpl->assign( 'vote_after_disabled', $vote_after_disabled );

			$xtpl->assign( 'settings_akismet_posts_number', $this->lang->settings_akismet_posts_number );
			$xtpl->assign( 'akismet_posts_number', $this->sets['akismet_posts_number'] );

			$xtpl->assign( 'settings_avatar', $this->lang->settings_avatar );
			$xtpl->assign( 'settings_avatar_max_width', $this->lang->settings_avatar_max_width );
			$xtpl->assign( 'settings_pixels', $this->lang->settings_pixels );
			$xtpl->assign( 'avatar_width', $this->sets['avatar_width'] );
			$xtpl->assign( 'settings_avatar_max_height', $this->lang->settings_avatar_max_height );
			$xtpl->assign( 'avatar_height', $this->sets['avatar_height'] );
			$xtpl->assign( 'settings_avatar_upload', $this->lang->settings_avatar_upload );
			$xtpl->assign( 'settings_kilobytes', $this->lang->settings_kilobytes );
			$avatarsize = ( $this->sets['avatar_upload_size'] / 1024 );
			$xtpl->assign( 'avatarsize', $avatarsize );

			$xtpl->assign( 'settings_files', $this->lang->settings_files );
			$xtpl->assign( 'settings_max_attach_size', $this->lang->settings_max_attach_size );
			$attachsize = ( $this->sets['attach_upload_size'] / 1024 );
			$xtpl->assign( 'attachsize', $attachsize );
			$xtpl->assign( 'settings_attach_ext', $this->lang->settings_attach_ext );
			$xtpl->assign( 'settings_attach_one_per', $this->lang->settings_attach_one_per );
			$attachtypes = implode( "\r\n", $this->sets['attach_types'] );
			$xtpl->assign( 'attachtypes', $attachtypes );

			$xtpl->assign( 'settings_file_approval', $this->lang->settings_file_approval );

			$file_approval_enabled = null;
			if( $this->sets['file_approval'] )
				$file_approval_enabled = "checked=\"checked\"";
			$xtpl->assign( 'file_approval_enabled', $file_approval_enabled );

			$file_approval_disabled = null;
			if( !$this->sets['file_approval'] )
				$file_approval_disabled = "checked=\"checked\"";
			$xtpl->assign( 'file_approval_disabled', $file_approval_disabled );

			$xtpl->assign( 'settings_email', $this->lang->settings_email );
			$xtpl->assign( 'settings_email_reply', $this->lang->settings_email_reply );
			$xtpl->assign( 'settings_email_real', $this->lang->settings_email_real );
			$xtpl->assign( 'admin_incoming', $this->sets['admin_incoming'] );
			$xtpl->assign( 'settings_email_smtp', $this->lang->settings_email_smtp );
			$xtpl->assign( 'mailserver', $this->sets['mailserver'] );
			$xtpl->assign( 'settings_email_from', $this->lang->settings_email_from );
			$xtpl->assign( 'settings_email_fake', $this->lang->settings_email_fake );
			$xtpl->assign( 'admin_outgoing', $this->sets['admin_outgoing'] );

			$xtpl->assign( 'settings_email_valid', $this->lang->settings_email_valid );

			$email_validation_enabled = null;
			if( $this->sets['emailactivation'] )
				$email_validation_enabled = "checked=\"checked\"";
			$xtpl->assign( 'email_validation_enabled', $email_validation_enabled );

			$email_validation_disabled = null;
			if( !$this->sets['emailactivation'] )
				$email_validation_disabled = "checked=\"checked\"";
			$xtpl->assign( 'email_validation_disabled', $email_validation_disabled );

			$group = $this->db->fetch ("SELECT group_name FROM %pgroups WHERE group_id=%d", USER_AWAIT );
			$xtpl->assign( 'group_name', $group['group_name'] );

			$xtpl->assign( 'settings_email_place1', $this->lang->settings_email_place1 );
			$xtpl->assign( 'settings_email_place2', $this->lang->settings_email_place2 );
			$xtpl->assign( 'settings_email_place3', $this->lang->settings_email_place3 );

			$xtpl->assign( 'settings_cookie', $this->lang->settings_cookie );
			$xtpl->assign( 'settings_cookie_time', $this->lang->settings_cookie_time );
			$xtpl->assign( 'seconds', $this->lang->seconds );
			$xtpl->assign( 'logintime', $this->sets['logintime'] );
			$xtpl->assign( 'settings_post_flood', $this->lang->settings_post_flood );
			$xtpl->assign( 'settings_post_min_time', $this->lang->settings_post_min_time );
			$xtpl->assign( 'flood_time', $this->sets['flood_time'] );
			$xtpl->assign( 'settings_pm_flood', $this->lang->settings_pm_flood );
			$xtpl->assign( 'settings_pm_min_time', $this->lang->settings_pm_min_time );
			$xtpl->assign( 'flood_time_pm', $this->sets['flood_time_pm'] );
			$xtpl->assign( 'settings_search_flood', $this->lang->settings_search_flood );
			$xtpl->assign( 'settings_search_min_time', $this->lang->settings_search_min_time );
			$xtpl->assign( 'flood_time_search', $this->sets['flood_time_search'] );
			$xtpl->assign( 'settings_cookie_prefix', $this->lang->settings_cookie_prefix );
			$xtpl->assign( 'cookie_prefix', $this->sets['cookie_prefix'] );
			$xtpl->assign( 'settings_cookie_path', $this->lang->settings_cookie_path );
			$xtpl->assign( 'cookie_path', $this->sets['cookie_path'] );
			$xtpl->assign( 'settings_cookie_domain', $this->lang->settings_cookie_domain );
			$xtpl->assign( 'cookie_domain', $this->sets['cookie_domain'] );

			$xtpl->assign( 'settings_cookie_secure', $this->lang->settings_cookie_secure );
			$xtpl->assign( 'settings_cookie_secured', $this->lang->settings_cookie_secured );

			$cookie_security_enabled = null;
			if( $this->sets['cookie_secure'] )
				$cookie_security_enabled = "checked=\"checked\"";
			$xtpl->assign( 'cookie_security_enabled', $cookie_security_enabled );

			$cookie_security_disabled = null;
			if( !$this->sets['cookie_secure'] )
				$cookie_security_disabled = "checked=\"checked\"";
			$xtpl->assign( 'cookie_security_disabled', $cookie_security_disabled );

			$xtpl->assign( 'settings_server', $this->lang->settings_server );
			$xtpl->assign( 'settings_server_timezone', $this->lang->settings_server_timezone );
			$severTimezones = $this->htmlwidgets->select_timezones( $this->sets['servertime'] );
			$xtpl->assign( 'severTimezones', $severTimezones );
			$xtpl->assign( 'settings_google_id', $this->lang->settings_google_id );
			$xtpl->assign( 'settings_google_msg', $this->lang->settings_google_msg );
			$xtpl->assign( 'analytics_code', $this->sets['analytics_code'] );

			$xtpl->assign( 'settings_active', $this->lang->settings_active );
			$xtpl->assign( 'settings_spider_enable', $this->lang->settings_spider_enable );
			$xtpl->assign( 'settings_spider_enable_msg', $this->lang->settings_spider_enable_msg );

			$spider_display_enabled = null;
			if( $this->sets['spider_active'] )
				$spider_display_enabled = "checked=\"checked\"";
			$xtpl->assign( 'spider_display_enabled', $spider_display_enabled );

			$spider_display_disabled = null;
			if( !$this->sets['spider_active'] )
				$spider_display_disabled = "checked=\"checked\"";
			$xtpl->assign( 'spider_display_disabled', $spider_display_disabled );

			$xtpl->assign( 'settings_spider_agent', $this->lang->settings_spider_agent );
			$xtpl->assign( 'settings_spider_agent_msg', $this->lang->settings_spider_agent_msg );
			$xtpl->assign( 'settings_one_per', $this->lang->settings_one_per );

			$spideragents = implode( "\r\n", array_keys( $this->sets['spider_name'] ) );
			$xtpl->assign( 'spideragents', $spideragents );

			$xtpl->assign( 'settings_spider_name', $this->lang->settings_spider_name );
			$xtpl->assign( 'settings_spider_name_msg', $this->lang->settings_spider_name_msg );

			$spidernames = implode( "\r\n", $this->sets['spider_name'] );
			$xtpl->assign( 'spidernames', $spidernames );

			$xtpl->assign( 'settings_board_rss', $this->lang->settings_board_rss );
			$xtpl->assign( 'settings_board_rssfeed_title', $this->lang->settings_board_rssfeed_title );
			$xtpl->assign( 'rss_feed_title', $this->sets['rss_feed_title'] );
			$xtpl->assign( 'settings_board_rssfeed_desc', $this->lang->settings_board_rssfeed_desc );
			$xtpl->assign( 'rss_feed_desc', $this->sets['rss_feed_desc'] );
			$xtpl->assign( 'settings_board_rssfeed_posts', $this->lang->settings_board_rssfeed_posts );
			$xtpl->assign( 'rss_feed_posts', $this->sets['rss_feed_posts'] );
			$xtpl->assign( 'settings_board_rssfeed_time', $this->lang->settings_board_rssfeed_time );
			$xtpl->assign( 'rss_feed_time', $this->sets['rss_feed_time'] );

			$xtpl->assign( 'settings_front_page_links', $this->lang->settings_front_page_links );
			$xtpl->assign( 'settings_left_sidebar', $this->lang->settings_left_sidebar );
			$xtpl->assign( 'settings_right_sidebar', $this->lang->settings_right_sidebar );

			$left_links = implode( "\r\n", $this->sets['left_sidebar_links'] );
			$xtpl->assign( 'left_links', $left_links );

			$right_links = implode( "\r\n", $this->sets['right_sidebar_links'] );
			$xtpl->assign( 'right_links', $right_links );

			$xtpl->assign( 'settings_security', $this->lang->settings_security );
			$xtpl->assign( 'settings_security_htts', $this->lang->settings_security_htts );
			$xtpl->assign( 'settings_security_htts_detail', $this->lang->settings_security_htts_detail );
			$xtpl->assign( 'settings_security_htts_max_age', $this->lang->settings_security_htts_max_age );
			$xtpl->assign( 'settings_security_htts_warning', $this->lang->settings_security_htts_warning );
			$xtpl->assign( 'settings_security_xss', $this->lang->settings_security_xss );
			$xtpl->assign( 'settings_security_xss_detail', $this->lang->settings_security_xss_detail );
			$xtpl->assign( 'settings_security_xss_disabled', $this->lang->settings_security_xss_disabled );
			$xtpl->assign( 'settings_security_xss_sanitize', $this->lang->settings_security_xss_sanitize );
			$xtpl->assign( 'settings_security_xss_block', $this->lang->settings_security_xss_block );
			$xtpl->assign( 'settings_security_xfo', $this->lang->settings_security_xfo );
			$xtpl->assign( 'settings_security_xfo_detail', $this->lang->settings_security_xfo_detail );
			$xtpl->assign( 'settings_security_xfo_deny', $this->lang->settings_security_xfo_deny );
			$xtpl->assign( 'settings_security_xfo_frames', $this->lang->settings_security_xfo_frames );
			$xtpl->assign( 'settings_security_xfo_same', $this->lang->settings_security_xfo_same );
			$xtpl->assign( 'settings_security_xcto', $this->lang->settings_security_xcto );
			$xtpl->assign( 'settings_security_xcto_detail', $this->lang->settings_security_xcto_detail );
			$xtpl->assign( 'settings_security_xcto_explain', $this->lang->settings_security_xcto_explain );
			$xtpl->assign( 'settings_security_ect', $this->lang->settings_security_ect );
			$xtpl->assign( 'settings_security_ect_detail', $this->lang->settings_security_ect_detail );
			$xtpl->assign( 'settings_security_ect_max_age', $this->lang->settings_security_ect_max_age );
			$xtpl->assign( 'settings_security_ect_warning', $this->lang->settings_security_ect_warning );
			$xtpl->assign( 'settings_security_csp', $this->lang->settings_security_csp );
			$xtpl->assign( 'settings_security_csp_detail', $this->lang->settings_security_csp_detail );
			$xtpl->assign( 'settings_security_csp_warning', $this->lang->settings_security_csp_warning );

			$xtpl->assign( 'htts_enabled', $this->sets['htts_enabled'] ? ' checked="checked"' : null );
			$xtpl->assign( 'htts_max_age', $this->sets['htts_max_age'] );

			$xtpl->assign( 'xss_enabled', $this->sets['xss_enabled'] ? ' checked="checked"' : null );
			if( $this->sets['xss_policy'] == 0 ) {
				$xtpl->assign( 'xss_policy0', ' checked="checked"' );
				$xtpl->assign( 'xss_policy1', null );
				$xtpl->assign( 'xss_policy2', null );
			} elseif( $this->sets['xss_policy'] == 1 ) {
				$xtpl->assign( 'xss_policy0', null );
				$xtpl->assign( 'xss_policy1', ' checked="checked"' );
				$xtpl->assign( 'xss_policy2', null );
			} elseif( $this->sets['xss_policy'] == 2 ) {
				$xtpl->assign( 'xss_policy0', null );
				$xtpl->assign( 'xss_policy1', null );
				$xtpl->assign( 'xss_policy2', ' checked="checked"' );
			}

			$xtpl->assign( 'xfo_enabled', $this->sets['xfo_enabled'] ? ' checked="checked"' : null );
			if( $this->sets['xfo_policy'] == 0 ) {
				$xtpl->assign( 'xfo_policy0', ' checked="checked"' );
				$xtpl->assign( 'xfo_policy1', null );
				$xtpl->assign( 'xfo_policy2', null );
			} elseif( $this->sets['xfo_policy'] == 1 ) {
				$xtpl->assign( 'xfo_policy0', null );
				$xtpl->assign( 'xfo_policy1', ' checked="checked"' );
				$xtpl->assign( 'xfo_policy2', null );
			} elseif( $this->sets['xfo_policy'] == 2 ) {
				$xtpl->assign( 'xfo_policy0', null );
				$xtpl->assign( 'xfo_policy1', null );
				$xtpl->assign( 'xfo_policy2', ' checked="checked"' );
			}
			$xtpl->assign( 'xfo_allowed_origin', $this->sets['xfo_allowed_origin'] );

			$xtpl->assign( 'xcto_enabled', $this->sets['xcto_enabled'] ? ' checked="checked"' : null );

			$xtpl->assign( 'ect_enabled', $this->sets['ect_enabled'] ? ' checked="checked"' : null );
			$xtpl->assign( 'ect_max_age', $this->sets['ect_max_age'] );

			$xtpl->assign( 'csp_enabled', $this->sets['csp_enabled'] ? ' checked="checked"' : null );
			$xtpl->assign( 'csp_details', $this->sets['csp_details'] );

			$xtpl->parse( 'Settings.EditForm' );
			$xtpl->parse( 'Settings' );

			return $xtpl->text( 'Settings' );
			break;

		case 'update':
			if( !$this->post ) {
				return $this->message( $this->lang->settings, $this->lang->settings_nodata );
				break;
			}

			if( !$this->is_valid_token() ) {
				return $this->message( $this->lang->settings, $this->lang->invalid_token );
			}

			$tos_text = $this->post['tos'];
			$tos_files_text = $this->post['tos_files'];
			$meta_keywords = $this->post['meta_keywords'];
			$meta_description = $this->post['meta_description'];
			$mobile_icons = $this->post['mobile_icons'];

			$vartypes = array(
				'db_host' => 'string',
				'db_name' => 'string',
				'db_user' => 'string',
				'db_pass' => 'string',
				'db_port' => 'string',
				'db_socket' => 'string',
				'prefix' => 'string',

				'forum_name' => 'string',
				'loc_of_board' => 'string',
				'closed' => 'bool',
				'closedtext' => 'string',
				'attach_upload_size' => 'kilobytes',
				'attach_types' => 'array',
				'topics_per_page' => 'int',
				'posts_per_page' => 'int',
				'hot_limit' => 'int',
				'default_skin' => 'int',
				'default_email_shown' => 'bool',
				'default_lang' => 'string',
				'default_group' => 'int',
				'default_timezone' => 'string',
				'default_pm' => 'bool',
				'default_view_avatars' => 'bool',
				'default_view_sigs' => 'bool',
				'default_view_emots' => 'bool',
				'link_target' => 'string',
				'vote_after_results' => 'bool',
				'register_image' => 'bool',
				'admin_incoming' => 'string',
				'mailserver' => 'string',
				'admin_outgoing' => 'string',
				'emailactivation' => 'bool',
				'logintime' => 'int',
				'flood_time' => 'int',
				'flood_time_pm' => 'int',
				'flood_time_search' => 'int',
				'cookie_prefix' => 'string',
				'cookie_path' => 'string',
				'cookie_domain' => 'string',
				'cookie_secure' => 'bool',
				'avatar_width' => 'int',
				'avatar_height' => 'int',
				'avatar_upload_size' => 'kilobytes',
				'servertime' => 'string',
				'max_load' => 'float',
				'analytics_code' => 'string',
				'spider_active' => 'bool',
				'spider_agent' => 'array',
				'spider_name' => 'array',
				'registrations_allowed' => 'bool',
				'rss_feed_posts' => 'int',
				'rss_feed_time' => 'int',
				'rss_feed_title' => 'string',
				'rss_feed_desc' => 'string',
				'edit_post_age' => 'int',
				'wordpress_api_key' => 'string',
				'akismet_email' => 'bool',
				'akismet_ureg' => 'bool',
				'akismet_sigs' => 'bool',
				'akismet_posts' => 'bool',
				'akismet_profiles' => 'bool',
				'akismet_posts_number' => 'int',
				'file_approval' => 'bool',
				'left_sidebar_links' => 'array',
				'right_sidebar_links' => 'array',
				'htts_enabled' => 'checkbox',
				'htts_max_age' => 'int',
				'xfo_enabled' => 'checkbox',
				'xfo_policy' => 'int',
				'xfo_allowed_origin' => 'string',
				'xss_enabled' => 'checkbox',
				'xss_policy' => 'int',
				'xcto_enabled' => 'checkbox',
				'ect_enabled' => 'checkbox',
				'ect_max_age' => 'int',
				'csp_enabled' => 'checkbox',
				'csp_details' => 'string'
			);

			foreach( $this->post as $var => $val )
			{
				if( $var == 'tos' || $var == 'tos_files' || $var == 'token' || $var == 'meta_keywords' || $var == 'meta_description' || $var == 'mobile_icons' )
					continue;
				if( ( $vartypes[$var] == 'int' ) || ( $vartypes[$var] == 'bool' ) ) {
					$val = intval( $val );
				} elseif( $vartypes[$var] == 'checkbox' ) {
					$val = isset( $this->post[$var] );
				} elseif( $vartypes[$var] == 'float' ) {
					$val = (float)$val;
				} elseif( $vartypes[$var] == 'kilobytes' ) {
					$val = intval( $val ) * 1024;
				} elseif( $vartypes[$var] == 'array' ) {
					$val = explode( "\n", $val );
					$count = count( $val );

					for( $i = 0; $i < $count; $i++ )
					{
						$val[$i] = trim( $val[$i] );
					}
				} elseif( $vartypes[$var] == 'string' ) {
					$val = $val;
				}

				if( $var == 'cookie_path' && $val != '/' ) {
					$newval = '';

					if( $val{0} != '/' )
						$newval .= '/';
					$newval .= $val;

					if( $val{strlen($val)-1} != '/' )
						$newval .= '/';
					$val = $newval;
				}

				$this->sets[$var] = $val;
			}

			$new_spider_names = array();
			foreach( $this->sets['spider_agent'] as $key => $spider_name )
			{
				$new_spider_names[strtolower($spider_name)] = $this->sets['spider_name'][$key];
			}
			unset( $this->sets['spider_agent'] );
			$this->sets['spider_name'] = $new_spider_names;

			$this->db->query( "UPDATE %pusers SET user_language='%s', user_skin='%s' WHERE user_id=%d",
				$this->post['default_lang'], $this->post['default_skin'], USER_GUEST_UID );
			$this->write_sets();
			$this->db->query( "UPDATE %psettings SET settings_tos='%s'", $tos_text );
			$this->db->query( "UPDATE %psettings SET settings_tos_files='%s'", $tos_files_text );
			$this->db->query( "UPDATE %psettings SET settings_meta_keywords='%s'", $meta_keywords );
			$this->db->query( "UPDATE %psettings SET settings_meta_description='%s'", $meta_description );
			$this->db->query( "UPDATE %psettings SET settings_mobile_icons='%s'", $mobile_icons );

			return $this->message( $this->lang->settings, $this->lang->settings_updated );
			break;
		}
	}
}
?>