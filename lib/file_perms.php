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
 * File permissions class
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since 1.3.2
 * @Copied from forum permissions
 **/
class file_permissions
{
	public $cube = array();
	public $group;
	public $user;
	public $db;
	public $pre;
	public $is_guest;
	public $globals = array();
	public $standard = array(
                'download_files' => false,
                'upload_files' => false,
		'approve_files' => false,
		'edit_files' => false,
		'move_files' => false,
		'delete_files' => false,
		'post_comment' => false,
		'category_view' => false,
		'edit_category' => false,
		'delete_category' => false,
		'add_category' => false
	);

	/**
	 * Constructor; sets up variables
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.2
	 **/
	public function __construct( &$qsf )
	{
		$this->db  = &$qsf->db;
		$this->pre = &$qsf->pre;

		if( !empty( $qsf->user ) ) {
			$this->get_perms( $qsf->user['user_group'], $qsf->user['user_id'], ( $qsf->user['user_file_perms'] ? $qsf->user['user_file_perms'] : $qsf->user['group_file_perms'] ) );
		}
	}

	/**
	 * Initialise the permissions object cube
	 *
	 * @param int $group Group id to load perms from. Set to -1 if using user perms
	 * @param int $user User id. Checked against USER_GUEST_UID as loaded as perms if group is set to -1
	 * @param mixed $perms Optional array of permissions to use instead of group or user perms from the database
	 **/
	public function get_perms( $group, $user, $perms = false )
	{
		if( !$perms ) {
			if ($group != -1) {
				$data  = $this->db->fetch( "SELECT group_file_perms FROM %pgroups WHERE group_id=%d", $group );
				$perms = $data['group_file_perms'];
			} else {
				$data  = $this->db->fetch( "SELECT user_file_perms, user_group FROM %pusers WHERE user_id=%d", $user );
				$perms = $data['user_file_perms'];
				$group = $data['user_group'];
			}
		}

		$this->cube = json_decode( $perms, true );
		if( !$this->cube ) {
			$this->cube = $this->standard;
		}

		$this->is_guest = ( ( $user == USER_GUEST_UID ) || ( $group == USER_GUEST ) );
		$this->group = $group;
		$this->user  = $user;
	}

	/**
	 * Query if a permission is turned on or not
	 *
	 * @param string $y Indentifier of the permission being queried
	 * @param mixed $z Category to check the permission against
	 *
	 * @return true if found the permission and it is on
	 **/
	public function auth( $y, $z = false )
	{
		if( !isset( $this->cube[$y] ) ) {
			return false;
		}

		if( $z === false ) {
			return !is_array( $this->cube[$y] ) ? $this->cube[$y] : !in_array( false, $this->cube[$y] );
		} else {
			return is_array( $this->cube[$y] ) ? ( isset( $this->cube[$y][$z] ) && $this->cube[$y][$z] ) : $this->cube[$y];
		}
	}

	/**
	 * Run through the cube and rebuild all permissions to on or off
	 *
	 * @param bool $bool What value to assign to all permissions
	 **/
	public function reset_cube( $bool )
	{
		$cube = $this->standard;
		$cats = array();

		$cats[0] = $bool; // Root category
		$query = $this->db->query( "SELECT fcat_id FROM %pfile_categories ORDER BY fcat_id" );

		while( $cat = $this->db->nqfetch( $query ) )
		{
			$cats[$cat['fcat_id']] = $bool;
		}

		foreach( $cube as $y => $z )
		{
			if( !isset( $this->globals[$y] ) && $cats ) {
				$cube[$y] = $cats;
			} else {
				$cube[$y] = $bool;
			}
		}

		$this->cube = $cube;
	}

	/**
	 * Turn on or off a specific permission. Also turn on or off for all categories
	 * that permission applies to
	 *
	 * @param string $y Indentifier of the permission being queried
	 * @param bool $bool What value to assign to all permissions
	 **/
	public function set_xy( $y, $bool )
	{
		if( !isset( $this->cube[$y] ) ) {
			if( !isset( $this->globals[$y] ) ) {
				// Create an array of all the forums
				$z = $this->cube[reset( array_diff( array_keys( $this->standard ), array_keys( $this->globals ) ) )];

				if( is_array( $z ) ) { // We have forums
					$z = array_keys( $array );

					$this->cube[$y] = array();

					foreach( $z as $zkey )
					{
						$this->cube[$y][$zkey] = $bool;
					}
				} else { // No forums
					$this->cube[$y] = $bool;
				}
			} else {
				$this->cube[$y] = $bool;
			}
		} else {
			if( isset( $this->globals[$y] ) || is_bool( $this->cube[$y] ) ) {
				$this->cube[$y] = $bool;
			} else {
				foreach( $this->cube[$y] as $zkey => $zval )
				{
					$this->cube[$y][$zkey] = $bool;
				}
			}
		}
	}

	/**
	 * Turn on or off a specific permission for a specific category
	 *
	 * @param string $y Indentifier of the permission being queried
	 * @param int $z Forum to check the permission against
	 * @param bool $bool What value to assign to all permissions
	 **/
	public function set_xyz( $y, $z, $bool )
	{
		// Only allow z modifications on non-global permissions if there are categories
		if( !isset( $this->globals[$y] ) && is_array( $this->cube[$y] ) ) {
			$this->cube[$y][$z] = $bool;
		}
	}

	/**
	 * Run through the cube and add a new category
	 *
	 * @param int $z Forum to create
	 * @param mixed $bool Category to copy permissions from. -1 if this is the first
	 *	category and to use a default. true or false to set all values to that
	 **/
	public function add_z( $z, $bool = -1 )
	{
		foreach( $this->cube as $y => $zval )
		{
			if( isset( $this->globals[$y] ) ) {
				continue;
			}

			if( !is_bool( $this->cube[$y] ) ) {
				$this->cube[$y][$z] = $bool;
			} else {
				if( $bool === -1 ) {
					$this->cube[$y] = array( $z => $this->cube[$y] );
				} else {
					$this->cube[$y] = array( $z => $bool );
				}
			}
		}
	}

	/**
	 * Run through the cube and remove the specified category
	 *
	 * @param int $z Category to remove
	 **/
	public function remove_z( $z )
	{
		foreach( $this->cube as $y => $zval )
		{
			if( isset( $this->globals[$y] ) ) {
				continue;
			}

			// Removing the last forum?
			if( count( $this->cube[$y] ) == 1 ) {
				$this->cube[$y] = $this->cube[$y][$z];
			} else {
				unset( $this->cube[$y][$z] );
			}
		}
	}

	/**
	 * This will load a new group for each while iteration
	 *
	 * while ($perms->get_group())
	 * {
	 *     $perms->set_xy();
	 *     $perms->update();
	 * }
	 *
	 * @param bool $users If true load user permissions instead of group permissions
	 **/
	public function get_group( $users = false )
	{
		static $start = true;
		static $groups = array();
		static $p = 0;

		if( $start ) {
			$start = false;

			if( $users ) {
				$query = $this->db->query( "SELECT user_id, user_file_perms FROM %pusers WHERE user_file_perms != ''" );
			} else {
				$query = $this->db->query( "SELECT group_id, group_file_perms FROM %pgroups" );
			}

			while( $group = $this->db->nqfetch( $query ) )
			{
				$groups[] = $group;
			}
		}

		if( $p < count( $groups ) ) {
			if( $users ) {
				$this->get_perms( -1, $groups[$p]['user_id'], $groups[$p]['user_file_perms'] );
			} else {
				$this->get_perms( $groups[$p]['group_id'], -1, $groups[$p]['group_file_perms'] );
			}

			$p++;

			return true;
		} else {
			$start = true;
			$groups = array();
			$p = 0;

			return false;
		}
	}

	/**
	 * Turn on or off a specific permission for a specific category
	 *
	 * Note: This is only used for upgrades
	 *
	 * @param string $y Indentifier of the permission being added
	 * @param bool $bool What value to assign to all permissions
	 **/
	public function add_perm( $y, $bool )
	{
		$new_global = isset( $this->globals[$y] );

		if( !isset( $this->standard[$y] ) )
			return; // Don't allow the action!

		$category_view_array = $this->cube['category_view']; // Use this to find the exisitng forums

		if( !$new_global && is_array( $category_view_array ) ) {
			foreach( array_keys( $category_view_array ) as $cat ) {
				$this->cube[$y][$cat] = $bool;
			}
		} else {
			$this->cube[$y] = $bool;
		}
	}

	/**
	 * Save the permissions back to the database
	 **/
	public function update()
	{
		if( $this->cube ) {
			ksort( $this->cube );
			$serialized = json_encode( $this->cube );
		} else {
			$serialized = '';
		}

		if( $this->user == -1 ) {
			$this->db->query( "UPDATE %pgroups SET group_file_perms='%s' WHERE group_id=%d", $serialized, $this->group );
		} else {
			$this->db->query( "UPDATE %pusers SET user_file_perms='%s' WHERE user_id=%d", $serialized, $this->user );
		}
	}
}
?>