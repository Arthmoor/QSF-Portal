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

require_once $set['include_path'] . '/lib/forumutils.php';

/**
 * Contains all the functions for generating small pieces of
 * HTML that can not be easily done in a template
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @since 1.2
 **/
class htmlwidgets extends forumutils
{
	public $tree    = null;              // The navigational tree @var string

	/**
	 * Constructor
	 *
	 * @param $qsf - Quicksilver Forums module
	 **/
	public function __construct( &$qsf )
	{
		parent::__construct( $qsf );

		$this->lang = &$qsf->lang;
		$this->self = $qsf->self;
		$this->skin = $qsf->skin;
		$this->user = $qsf->user;
		$this->sets = $qsf->sets;

		// Need the time for timezone stuff
		$this->time = &$qsf->time;
	}

	/**
	 * Creates HTML-formatted page numbers
	 *
	 * @param mixed $rows Can be either a resource, query, or number; number of total entries for pagination
	 * @param string $link Query string to attach to link
	 * @param int $min First entry to display
	 * @param int $num Number of entries per page
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 1.0
	 * @return string HTML-formatted page numbers
	 **/
	public function get_pages( $rows, $link, $min = 0, $num = 10 )
	{
		if( !$num ) {
			$num = 10;
		}

		// preliminary row handling
		if( !is_resource( $rows ) ) {
			if( !is_numeric( $rows ) ) {
				$rows = $this->db->num_rows( $this->db->query( $rows ) );
			}
		} else {
			$rows = $this->db->num_rows( $rows );
		}

		// some base variables
		$current = ceil( $min / $num );
		$string  = null;
		$pages   = ceil( $rows / $num );
		$end     = ( $pages - 1 ) * $num;

		// check if there's previous articles
		if( $min == 0 ) {
			$startlink = '&lt;&lt;';
			$previouslink = $this->lang->main_prev;
		} else {
			$startlink = "<a href=\"{$this->self}?$link&amp;min=0&amp;num=$num\" class=\"pagelinks\">&lt;&lt;</a>";
			$prev = $min - $num;
			$previouslink = "<a href=\"{$this->self}?$link&amp;min=$prev&amp;num=$num\" class=\"pagelinks\">{$this->lang->main_prev}</a> ";
		}

		// check for next/end
		if( ( $min + $num ) < $rows ) {
			$next = $min + $num;
  			$nextlink = "<a href=\"{$this->self}?$link&amp;min=$next&amp;num=$num\" class=\"pagelinks\">{$this->lang->main_next}</a>";
  			$endlink = "<a href=\"{$this->self}?$link&amp;min=$end&amp;num=$num\" class=\"pagelinks\">&gt;&gt;</a>";
		} else {
  			$nextlink = $this->lang->main_next;
  			$endlink = '&gt;&gt;';
		}

		// setup references
		$b = $current - 2;
		$e = $current + 2;

		// set end and beginning of loop
		if( $b < 0 ) {
  			$e = $e - $b;
  			$b = 0;
		}

		// check that end coheres to the issues
		if( $e > $pages - 1 ) {
  			$b = $b - ( $e - $pages + 1 );
  			$e = ( $pages - 1 < $current ) ? $pages : $pages - 1;
  			// b may need adjusting again
  			if( $b < 0 ) {
				$b = 0;
			}
		}

 		// ellipses
		if( $b != 0 ) {
			$badd = '...';
		} else {
			$badd = '';
		}

		if( ( $e != $pages - 1 ) && $rows ) {
			$eadd = '...';
		} else {
			$eadd = '';
		}

		// run loop for numbers to the page
		for( $i = $b; $i < $current; $i++ )
		{
			$where = $num * $i;
			$string .= ", <a href=\"{$this->self}?$link&amp;min=$where&amp;num=$num\" class=\"bodylinktype\">" . ($i + 1) . '</a>';
		}

		// add in page
		$string .= ', <strong>' . ($current + 1) . '</strong>';

		// run to the end
		for( $i = $current + 1; $i <= $e; $i++ )
		{
			$where = $num * $i;
			$string .= ", <a href=\"{$this->self}?$link&amp;min=$where&amp;num=$num\" class=\"bodylinktype\">" . ($i + 1) . '</a>';
		}

		// get rid of preliminary comma. (optimized by jason: mark uses preg_replace() like candy)
		if( substr( $string, 0, 1 ) == ',' ) {
			$string = substr( $string, 1 );
		}

		return "<span class=\"pagelinks\">$startlink $previouslink $badd $string $eadd $nextlink $endlink</span>";
	}

	/**
	 * Creates HTML-formatted page numbers for topics - see get_pages()
	 *
	 * @param int $records Number of replies in the topic
	 * @param int $link Query string to attach to link
	 * @param string $sep Separator for pages
	 * @param int $min First entry to display
	 * @param int $n Number of entries to display
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 2.0
	 * @return
	 **/
	public function get_pages_topic( $records, $link, $sep, $min = 0, $n = 10 )
	{
		$records++;
		$pages    = ceil( $records / $n );
		$max_page = ( $pages - 1 ) * $n;

		if( $pages == 1 ) {
			return null;
		}

		$pagelinks = null;
		if( $pages > 3 ) {
			$countfor = 3;
		} else {
			$countfor = $pages;
		}

		for( $i = 0; $i < $countfor; $i++ )
		{
			$minpag = $i * $n;
			$page   = $i + 1;
			$pagelinks .= "<a href=\"{$this->self}?$link&amp;min=$minpag&amp;num=$n\" class=\"pages\">$page</a>{$sep}";
		}

		if( substr( $pagelinks, -( strlen( $sep ) ) ) == $sep ) {
			$pagelinks = substr( $pagelinks, 0, -( strlen( $sep ) ) );
		}

		if( $pages > 3 ) {
			$ellipsis = ( $pages == 4 ) ? '' : '..';
			$pagelinks .= "$sep<a href=\"{$this->self}?$link&amp;min=$max_page&amp;num=$n\" class=\"pages\">{$ellipsis}{$pages}</a>";
		}

		$pagelinks = "( $pagelinks )";

		return $pagelinks;
	}

	/**
	 * Look at all the avatars avaialble and make them selectable options
	 *
	 * @param string $current filename of the current avatar (if any)
	 * @param string $relative Path to look for avatars in (optional)
	 * @return string HTML
	 **/
	public function select_avatars( $current, $relative = '.', $subfolder = '/' )
	{
		if( substr( $subfolder, -1 ) != '/' ) {
			$subfolder .= '/';
		}

		$out = null;
		$dir = opendir( $relative . '/avatars' . $subfolder );
		$subDirs = array();

		while( ( $file = readdir( $dir ) ) !== false )
		{
			if( is_dir( './avatars' . $subfolder . $file ) ) {
				if( $file == 'uploaded' || $file[0] == '.' )
					continue;

				$subDirs[] = $file;
			}

			$split = explode( '.', $file );
			$ext   = array_pop( $split );
			if( ( $ext != 'jpg' )
			&& ( $ext != 'jpeg' )
			&& ( $ext != 'gif' )
			&& ( $ext != 'png' ) ) {
				continue;
			}

			$out .= "<option value=\"./avatars$subfolder$file\"" . ( ( "./avatars$subfolder$file" == $current ) ? ' selected="selected"' : null ) . '>' . implode('.', $split) . "</option>\n";
		}

		foreach( $subDirs as $file ) {
			$extra = $this->select_avatars( $current, $relative, $subfolder . $file );

			if( $extra ) {
				if( $subfolder == '/' ) {
					$out .= '<optgroup label="' . htmlspecialchars( $file ) . "\">\n";
					$out .= $extra;
					$out .= "</optgroup>\n";
				} else {
					$out .= "</optgroup>\n";
					$out .= '<optgroup label="' . htmlspecialchars( substr( $subfolder . $file, 1 ) ) . "\">\n";
					$out .= $extra;
				}
			}
		}

		return $out;
	}

	/**
	 * Create options of group names
	 *
	 * @param int $var group_id of the selected group
	 * @param bool $custom_only Show only groups that are not part of the built in groups
	 * @return string HTML
	 **/
	public function select_groups( $val, $custom_only = false )
	{
		if( $custom_only ) {
			$groups = $this->db->query( "SELECT group_name, group_id FROM %pgroups WHERE group_type='' ORDER BY group_name" );
		} else {
			$groups = $this->db->query( "SELECT group_name, group_id FROM %pgroups ORDER BY group_name" );
		}

		$out = null;

		while( $group = $this->db->nqfetch( $groups ) )
		{
			$out .= "<option value=\"{$group['group_id']}\"" . ( ( $val == $group['group_id'] ) ? ' selected="selected"' : '' ) . ">{$group['group_name']}</option>";
		}

		return $out;
	}

	/**
	 * Create options of "null" to 31 selectable as a day of the month
	 *
	 * @param int $dat current day of the month (if any)
	 * @return string HTML
	 **/
	public function select_days( $day )
	{
		$i   = 1;
		$out = "<option value=\"00\"></option>\n";

		while( $i <= 31 )
		{
			$out .= "<option value=\"$i\"" . ( ( $i == $day ) ? ' selected="selected"' : null ) . ">$i</option>\n";
			$i++;
		}

		return $out;
	}

	/**
	 * Create options of "null" to 12 selectable months
	 *
	 * @param int $mon current month (if any) 
	 * @return string HTML
	 **/
	public function select_months( $mon )
	{
		$i   = 1;
		$out = null;

		$month = array(
			'00' => '',
			'1'  => $this->lang->cp_jan,
			'2'  => $this->lang->cp_feb,
			'3'  => $this->lang->cp_mar,
			'4'  => $this->lang->cp_apr,
			'5'  => $this->lang->cp_may,
			'6'  => $this->lang->cp_june,
			'7'  => $this->lang->cp_july,
			'8'  => $this->lang->cp_aug,
			'9'  => $this->lang->cp_sept,
			'10' => $this->lang->cp_oct,
			'11' => $this->lang->cp_nov,
			'12' => $this->lang->cp_dec
		);

		foreach( $month as $digit => $name )
		{
			$out .= "<option value=\"$digit\"" . ( ( $digit == $mon ) ? ' selected="selected"' : null ) . ">$name</option>\n";
		}

		return $out;
	}

	/**
	 * Create options of "null" to 100 years ago as selectable years
	 *
	 * @param int $year the selected year (if any)
	 * @return string HTML
	 **/
	public function select_years( $year )
	{
		$thisyear = gmdate( "Y", time() ); // Could end up missing the 'current year' if on new years day/eve
		$i        = $thisyear;
		$out      = "<option value='0000'></option>\n";

		while( $i >= $thisyear - 100 )
		{
			$out .= "<option value=\"$i\"" . ( ( $i == $year ) ? ' selected="selected"' : null ) . ">$i</option>\n";
			$i--;
		}

		return $out;
	}

	/**
	 * Generates a select box of skins
	 *
	 * @param string $skin user_skin to select
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 4.0
	 * @return string HTML
	 **/
	public function select_skins( $skin )
	{
		$out = null;

		$query = $this->db->query( "SELECT * FROM %pskins" );
		while( $s = $this->db->nqfetch( $query ) )
		{
			if( $s['skin_id'] == $this->sets['default_skin'] ) {
				$s['skin_name'] .= " [{$this->lang->default}]";
			}
			$out .= "<option value=\"{$s['skin_id']}\"" . (($s['skin_id'] == $skin) ? ' selected="selected"' : null) . ">{$s['skin_name']}</option>\n";
		}

		return $out;
	}

	public function select_timezones( $zone )
	{
		$out = null;

		$zones = array(
			'-12'			=> $this->lang->gmt_nev12,
			'Pacific/Pago_Pago'	=> $this->lang->gmt_nev11,
			'America/Adak'		=> $this->lang->gmt_nev10a,
			'Pacific/Honolulu'	=> $this->lang->gmt_nev10,
			'America/Anchorage'	=> $this->lang->gmt_nev09,
			'America/Los_Angeles'	=> $this->lang->gmt_nev08,
			'America/Denver'	=> $this->lang->gmt_nev07a,
			'America/Phoenix'	=> $this->lang->gmt_nev07,
			'America/Chicago'	=> $this->lang->gmt_nev06,
			'America/New_York'	=> $this->lang->gmt_nev05,
			'America/Halifax'	=> $this->lang->gmt_nev04,
			'America/St_Johns'	=> $this->lang->gmt_nev03b,
			'America/Argentina/Buenos_Aires'	=> $this->lang->gmt_nev03a,
			'America/Sao_Paulo'	=> $this->lang->gmt_nev03,
			'America/Noronha'	=> $this->lang->gmt_nev02,
			'Atlantic/Azores'	=> $this->lang->gmt_nev01,
			'Europe/London'		=> $this->lang->gmt_00000,
			'Atlantic/Reykjavik'	=> $this->lang->gmt_0000a,
			'Europe/Berlin'		=> $this->lang->gmt_pos01,
			'Europe/Athens'		=> $this->lang->gmt_pos02,
			'Europe/Moscow'		=> $this->lang->gmt_pos03,
			'Asia/Tehran'		=> $this->lang->gmt_pos03a,
			'Asia/Dubai'		=> $this->lang->gmt_pos04,
			'Asia/Kabul'		=> $this->lang->gmt_pos04a,
			'Asia/Karachi'		=> $this->lang->gmt_pos05,
			'Asia/Kolkata'		=> $this->lang->gmt_pos05a,
			'Asia/Almaty'		=> $this->lang->gmt_pos06,
			'Asia/Yangon'		=> $this->lang->gmt_pos06a,
			'Asia/Bangkok'  	=> $this->lang->gmt_pos07,
			'Asia/Shanghai'		=> $this->lang->gmt_pos08,
			'Australia/Perth'	=> $this->lang->gmt_pos08a,
			'Australia/Eucla'	=> $this->lang->gmt_pos08b,
			'Asia/Tokyo'		=> $this->lang->gmt_pos09,
			'Australia/Broken_Hill'	=> $this->lang->gmt_pos09a,
			'Australia/Darwin'	=> $this->lang->gmt_pos09b,
			'Australia/Brisbane'    => $this->lang->gmt_pos10,
			'Australia/Hobart'	=> $this->lang->gmt_pos10a,
			'Australia/Melbourne'	=> $this->lang->gmt_pos10b,
			'Australia/Lord_Howe'	=> $this->lang->gmt_pos10c,
			'Pacific/Bougainville'	=> $this->lang->gmt_pos11,
			'Asia/Kamchatka'	=> $this->lang->gmt_pos12,
			'Pacific/Auckland'	=> $this->lang->gmt_pos12a,
			'Pacific/Funafuti'	=> $this->lang->gmt_pos12b,
			'Pacific/Chatham'	=> $this->lang->gmt_pos12c,
			'Pacific/Tongatapu'	=> $this->lang->gmt_pos13,
			'Pacific/Kiritimati'	=> $this->lang->gmt_pos14
		);

		foreach( $zones as $offset => $zone_name )
		{
			$out .= "<option value='$offset'" . ( ( $offset == $zone ) ? ' selected=\'selected\'' : null ) . ">$zone_name</option>\n";
		}

		return $out;
	}

	/**
	 * Options for an HTML select box (all forums in correct order)
	 *
	 * @param int $select Option to set as selected (-1 for all)
	 * @param int $parent Used to degredate down through the recursive loop
	 * @param string $space Used to increment the spacing before the text in the box
	 * @param bool $identify_category Set to true to place a period before the value of a category
	 * @return string Options for an HTML select box (all forums in correct order)
	 **/
	public function select_forums( $select = 0, $parent = 0, $space = '', $identify_category = false )
	{
		$array = $this->forum_grab();

		return $this->_select_forums_recurse( $array, $select, $parent, $space, $identify_category );
	}

	/**
	 * Options for an HTML select box (all forums in correct order)
	 *
	 * PRIVATE
	 *
	 * @param array $array Array of forums to look through
	 * @param int $select Option to set as selected (-1 for all)
	 * @param int $parent Used to degredate down through the recursive loop
	 * @param string $space Used to increment the spacing before the text in the box
	 * @param bool $identify_category Set to true to place a period before the value of a category
	 * @author Mark Elliot <mark.elliot@mercuryboard.com>
	 * @since Beta 4.0
	 * @return string Options for an HTML select box (all forums in correct order)
	 **/
	private function _select_forums_recurse( $array, $select, $parent, $space, $identify_category = false )
	{
		$arr = $this->forum_array( $array, $parent );

		$return = null;

		foreach( $arr as $val )
		{
			if( !$this->perms->auth( 'forum_view', $val['forum_id'] ) ) {
				continue;
			}

			if( $identify_category && !$val['forum_parent'] ) {
				$dot = '.';
			} else {
				$dot = null;
			}

			if( ( $val['forum_id'] != $select ) && ( $select != -1 ) ) {
				$selected = null;
			} else {
				$selected = ' selected="selected"';
			}

			$return .= '<option value="' . $dot . $val['forum_id'] . '"' . $selected . '>' . $space . $val['forum_name'] . "</option>\n" .
			$this->_select_forums_recurse( $array, $select, $val['forum_id'], $space . '&nbsp; &nbsp;' );
		}

		return $return;
	}

	/**
	 * Create options of selectable languages
	 *
	 * @param string $current The current language being used
	 * @param string $relative Path to look for avatars in (optional)
	 * @return string HTML
	 **/
	public function select_langs( $current, $relative = '.' )
	{
		$out   = null;
		$langs = array();
		$dir   = opendir( $relative . '/languages' );

		while( ( $file = readdir( $dir ) ) !== false )
		{
			if( is_dir( $relative . '/languages/' . $file ) ) {
				continue;
			}

			$code = substr( $file, 0, -4 );
			$ext  = substr( $file, -4 );

			if( $ext != '.php' ) {
				continue;
			}

			$langs[$code] = $this->get_lang_name( $code );
		}

		asort( $langs );

		foreach( $langs as $code => $name )
		{
			$out .= "<option value='$code'" . ( ( $code == $current ) ? ' selected=\'selected\'' : null ) . ">$name</option>\n";
		}

		return $out;
	}

	/**
	 * Fetch the language name for the language code
	 *
	 * @param string $code Two character country code
	 * @return string Language name (in English)
	 **/
	public function get_lang_name( $code )
	{
		$code = strtolower( $code );

		switch( $code )
		{
			case 'bg': return 'Bulgarian'; break;
			case 'zh': return 'Chinese'; break;
			case 'cs': return 'Czech'; break;
			case 'nl': return 'Dutch'; break;
			case 'en': return 'English'; break;
			case 'fi': return 'Finnish'; break;
			case 'fr': return 'French'; break;
			case 'de': return 'German'; break;
			case 'he': return 'Hebrew'; break;
			case 'hu': return 'Hungarian'; break;
			case 'id': return 'Indonesian'; break;
			case 'it': return 'Italian'; break;
			case 'no': return 'Norwegian'; break;
			case 'pt': return 'Portuguese'; break;
			case 'ru': return 'Russian'; break;
			case 'sk': return 'Slovak'; break;
			case 'es': return 'Spanish'; break;
			case 'sv': return 'Swedish'; break;
			default: return $code; break;
		}
	}

	/**
	 * Adds an entry to the navigation tree
	 *
	 * @param string $label Label for the tree entry
	 * @param string $link URL to link to
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return void
	 **/
	public function tree( $label, $link = null )
	{
		$label = htmlspecialchars( $label );

		$this->tree .= ' <b>&raquo;</b> ' . ( $link ? "<a href='$link'>$label</a>" : $label );
	}

	/**
	 * Traces a forum back to the parent category and adds entries to the tree - see tree()
	 *
	 * @param int $f Forum to generate tree for
	 * @param bool $linklast True to make the last entry a link (default is false)
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return void
	 **/
	public function tree_forums( $f, $linklast = false )
	{
		$forumData = $this->forum_grab_sorted();

		if( !isset( $forumData[$f] ) ) { //error? lets get out while we can
			return;
		}

		$cat = 1; //first forum is always a category
		$ft  = explode( ',', $forumData[$f]['forum_tree'] );

		foreach( $ft as $i )
		{
			if( $i ) {
				if( !$cat ) {
					$this->tree( $forumData[$i]['forum_name'], "$this->self?a=forum&amp;f={$i}" );
				} else {
					$this->tree( $forumData[$i]['forum_name'], "$this->self?a=board&amp;c={$i}" );
					$cat = 0;
				}
			}
		}

		if( !$linklast ) {
			$this->tree( $forumData[$f]['forum_name'] );
		} else {
			$this->tree( $forumData[$f]['forum_name'], "$this->self?a=forum&amp;f={$f}" );
		}
	}

	/**
	 * Retrieves message icons and puts them into a unordered list
	 *
	 * @param string $select Icon to select
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.0
	 * @return string HTML-formatted message icons
	 **/
	public function get_icons( $select = -1 )
	{
		$i     = 0;
		$icons = array();
		$dir   = opendir( "./skins/$this->skin/mbicons" );

		while( ( $file = readdir( $dir ) ) !== false )
		{
			$ext = substr( $file, -4 );

			if( ( ( $ext == '.gif' ) || ( $ext == '.jpg' ) || ( $ext == '.png' ) ) && !is_dir( "./skins/$this->skin/mbicons/$file" ) ) {
				$icons[$i] = $file;
				$i++;
			}
		}

		closedir( $dir );
		natsort( $icons );

		$msgicons = null;
		$i        = 0;

		foreach( $icons as $icon )
		{
			$msgicons .= "<li><input type=\"radio\" name=\"icon\" id=\"icon$i\" value=\"$icon\"" . ( ( $select == $icon ) ? '
				checked=\'checked\'' : null ) . " />&nbsp;<label for=\"icon$i\"><img src=\"{$this->sets['loc_of_board']}/skins/$this->skin/mbicons/$icon\" alt=\"{$this->lang->post_icon}\" /></label></li>\n";
			$i++;
		}
		return $msgicons;
	}

	/**
	 * Retreives a Gravatar URL for members who use them. See: https://en.gravatar.com/
	 *
	 * @param string $avatar Text containing the Gravatar email address (user specified)
	 * @return string URL for the Gravatar image
	 * @author Roger Libiez
	 * @since 1.5.2
	 **/
	public function get_gravatar( $avatar )
	{
		$gravatar = 'https://secure.gravatar.com/avatar/';
		$gravatar .= md5( strtolower( trim( $avatar ) ) );
		$gravatar .= "?s={$this->sets['avatar_width']}&amp;r=pg";

		return $gravatar;
	}

	/**
	 * Display a user's avatar when desired.
	 *
	 * @param string $user SQL resource array of user data
	 * @return string URL for the desired avatar image, or NULL if not desired/unavailable.
	 * @author Roger Libiez
	 * @since 1.5.2
	 **/
	public function display_avatar( $user )
	{
		$url = null;
		$avatar = $user['user_avatar'];

		if( $user['user_avatar_type'] != 'none' && $this->user['user_view_avatars'] ) {
			if( $user['user_avatar_type'] == 'gravatar' )
				$avatar = $this->get_gravatar( $user['user_avatar'] );

			$url = "<img src=\"{$avatar}\" alt=\"\" style=\"width:{$user['user_avatar_width']}px; height:{$user['user_avatar_height']}px;\" />";
		}

		return $url;
	}
}
?>