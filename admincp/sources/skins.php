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

if( !defined( 'QUICKSILVERFORUMS' ) || !defined( 'QSF_ADMIN' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

/**
 * Skin Management
 *
 * @author Roger Libiez
 * @since 2.0
 */
class skins extends admin
{
	public function execute()
	{
		if( !isset( $this->get['s'] ) )
			$this->get['s'] = null;

		switch( $this->get['s'] )
		{
			case 'enable':
				return $this->enable_skin();

			case 'disable':
				return $this->disable_skin();

			default:
				return $this->list_skins();
		}
		return $this->message( $this->lang->skins_manage_skins, $this->lang->skins_invalid_option );
	}

	private function enable_skin()
	{
		if( !isset( $this->get['dir'] ) ) {
			return $this->message( $this->lang->skins_enable_skin, $this->lang->skins_must_select );
		}

		$dir = trim( $this->get['dir'] );

		if( $dir == 'default' ) {
			return $this->message( $this->lang->skins_enable_skin, $this->lang->skins_no_enable_default );
		}

		$fname = '../skins/' . $dir . '/skin_data.txt';

		$skin_name = '';

		if( file_exists( $fname ) ) {
			$skin_name = file_get_contents( $fname );
		}

		$skin_name = trim( $skin_name );

		$skin = $this->db->fetch( "SELECT * FROM %pskins WHERE skin_dir='%s'", $dir );

		if( !$skin ) {
			$this->db->query( "INSERT INTO %pskins (skin_name, skin_dir, skin_enabled) VALUES ( '%s', '%s', 1 )", $skin_name, $dir );

			return $this->message( $this->lang->skins_enable_skin, $skin_name . $this->lang->skins_is_enabled );
		}

		$this->db->query( 'UPDATE %pskins SET skin_enabled=1 WHERE skin_id=%d', $skin['skin_id'] );

		return $this->message( $this->lang->skins_enable_skin, $skin['skin_name'] . $this->lang->skins_is_enabled );
	}

	private function disable_skin()
	{
		if( !isset( $this->get['id'] ) ) {
			return $this->message( $this->lang->skins_disable_skin, $this->lang->skins_must_select );
		}

		$id = intval( $this->get['id'] );

		if( $id == 1 ) {
			return $this->message( $this->lang->skins_disable_skin, $this->lang->skins_no_enable_default );
		}

		$skin = $this->db->fetch( "SELECT * FROM %pskins WHERE skin_id=%d AND skin_enabled=1", $id );

		if( !$skin ) {
			return $this->message( $this->lang->skins_disable_skin, $this->lang->skins_cant_disable );
		}

		if( !isset( $this->post['confirm'] ) ) {
			$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/skins.xtpl' );

			$xtpl->assign( 'site', $this->site );
			$xtpl->assign( 'skin', $this->skin );
			$xtpl->assign( 'skin_id', $skin['skin_id'] );
			$xtpl->assign( 'skin_name', $skin['skin_name'] );
			$xtpl->assign( 'skins_confirm_disable', $this->lang->skins_confirm_disable );
			$xtpl->assign( 'skins_disable', $this->lang->skins_disable );

			$xtpl->assign( 'token', $this->generate_token() );

			$xtpl->parse( 'DisableForm' );
			return $xtpl->text( 'DisableForm' );
		}

		if( !$this->is_valid_token() ) {
			return $this->message( $this->lang->settings_captcha_delete, $this->lang->invalid_token );
		}

		$this->db->query( 'UPDATE %pskins SET skin_enabled=0 WHERE skin_id=%d', $id );
		$this->db->query( 'UPDATE %pusers SET user_skin=1 WHERE user_skin=%d', $id );

		return $this->message( $this->lang->skins_disable_skin, $skin['skin_name'] . $this->lang->skins_is_disabled );
	}

	private function list_skins()
	{
		$disabled_skins = false;

		$xtpl = new XTemplate( '../skins/' . $this->skin . '/admincp/skins.xtpl' );

		$xtpl->assign( 'site', $this->site );
		$xtpl->assign( 'skin', $this->skin );

		if( $dh = opendir( '../skins/' ) )
		{
			while( ( $item = readdir( $dh ) ) !== false )
			{
				if( $item[0] != '.' && is_dir( '../skins/' . $item ) ) {
					$check_skin = $this->db->fetch( "SELECT skin_dir, skin_enabled FROM %pskins WHERE skin_dir='%s'", $item );

					if( !$check_skin || $check_skin['skin_enabled'] == 0 ) {
						$fname = '../skins/' . $item . '/skin_data.txt';

						if( file_exists( $fname ) ) {
							$disabled_skins = true;

							$skin_name = file_get_contents( $fname );

							$xtpl->assign( 'skin_name', $skin_name );
							$xtpl->assign( 'skin_dir', $item );

							$enable_link = "<a href=\"{$this->site}/admincp/index.php?a=skins&amp;s=enable&amp;dir=$item\">{$this->lang->skins_enable}</a>";
							$xtpl->assign( 'enable_link', $enable_link );

							$xtpl->parse( 'Skins.DisabledSkins.FolderEntry' );
						}
					}
				}
			}
			closedir( $dh );
		}

		$xtpl->assign( 'skins_manage_skins', $this->lang->skins_manage_skins );
		$xtpl->assign( 'skins_disabled', $this->lang->skins_disabled );
		$xtpl->assign( 'skins_enabled', $this->lang->skins_enabled );
		$xtpl->assign( 'skins_name', $this->lang->skins_name );
		$xtpl->assign( 'skins_dir', $this->lang->skins_dir );

		$enabled_skins = $this->db->query( "SELECT * FROM %pskins WHERE skin_enabled=1" );

		while( $skin = $this->db->nqfetch( $enabled_skins ) )
		{
			$xtpl->assign( 'skin_name', $skin['skin_name'] );
			$xtpl->assign( 'skin_dir', $skin['skin_dir'] );

			if( $skin['skin_id'] != 1 ) {
				$disable_link = "<a href=\"{$this->site}/admincp/index.php?a=skins&amp;s=disable&amp;id={$skin['skin_id']}\">{$this->lang->skins_disable}</a>";
				$xtpl->assign( 'disable_link', $disable_link );
			} else {
				$xtpl->assign( 'disable_link', null );
			}

			$xtpl->parse( 'Skins.EnabledEntry' );
		}

		if( $disabled_skins ) {
			$xtpl->parse( 'Skins.DisabledSkins' );
		}

		$xtpl->parse( 'Skins' );
		return $xtpl->text( 'Skins' );
	}
}