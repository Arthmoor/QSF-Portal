<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005 The Quicksilver Forums Development Team
 *  http://www.quicksilverforums.com/
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

require_once $set['include_path'] . '/lib/htmltools.php';

/**
 * Contains all the functions for generating small pieces of
 * HTML that can not be easily done in a template
 *
 * @author Geoffrey Dunn <geoff@warmage.com>
 * @since 1.2
 **/
class htmlwidgets extends htmltools
{
	var $tree    = null;              // The navigational tree @var string

	/**
	 * Constructor
	 *
	 * @param $qsf - Quicksilver Forums module
	 **/
	function htmlwidgets(&$qsf)
	{
		parent::htmltools($qsf);

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
	function get_pages($rows, $link, $min = 0, $num = 10)
	{
		if (!$num) {
			$num = 10;
		}

		// preliminary row handling
		if (!is_resource($rows)) {
			if (!is_numeric($rows)) {
				$rows = $this->db->num_rows($this->db->query($rows));
			}
		} else {
			$rows = $this->db->num_rows($rows);
		}

		// some base variables
		$current = ceil($min / $num);
		$string  = null;
		$pages   = ceil($rows / $num);
		$end     = ($pages - 1) * $num;

		// check if there's previous articles
		if ($min == 0) {
			$startlink = '&lt;&lt;';
			$previouslink = $this->lang->main_prev;
		} else {
			$startlink = "<a href=\"{$this->self}?$link&amp;min=0&amp;num=$num\" class=\"pagelinks\">&lt;&lt;</a>";
			$prev = $min - $num;
			$previouslink = "<a href=\"{$this->self}?$link&amp;min=$prev&amp;num=$num\" class=\"pagelinks\">{$this->lang->main_prev}</a> ";
		}

		// check for next/end
		if (($min + $num) < $rows) {
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
		if ($b < 0) {
  			$e = $e - $b;
  			$b = 0;
		}

		// check that end coheres to the issues
		if ($e > $pages - 1) {
  			$b = $b - ($e - $pages + 1);
  			$e = ($pages - 1 < $current) ? $pages : $pages - 1;
  			// b may need adjusting again
  			if ($b < 0) {
				$b = 0;
			}
		}

 		// ellipses
		if ($b != 0) {
			$badd = '...';
		} else {
			$badd = '';
		}

		if (($e != $pages - 1) && $rows) {
			$eadd = '...';
		} else {
			$eadd = '';
		}

		// run loop for numbers to the page
		for ($i = $b; $i < $current; $i++)
		{
			$where = $num * $i;
			$string .= ", <a href=\"{$this->self}?$link&amp;min=$where&amp;num=$num\" class=\"bodylinktype\">" . ($i + 1) . '</a>';
		}

		// add in page
		$string .= ', <strong>' . ($current + 1) . '</strong>';

		// run to the end
		for ($i = $current + 1; $i <= $e; $i++)
		{
			$where = $num * $i;
			$string .= ", <a href=\"{$this->self}?$link&amp;min=$where&amp;num=$num\" class=\"bodylinktype\">" . ($i + 1) . '</a>';
		}

		// get rid of preliminary comma. (optimized by jason: mark uses preg_replace() like candy)
		if (substr($string, 0, 1) == ',') {
			$string = substr($string, 1);
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
	function get_pages_topic($records, $link, $sep, $min = 0, $n = 10)
	{
		$records++;
		$pages    = ceil($records / $n);
		$max_page = ($pages - 1) * $n;

		if ($pages == 1) {
			return null;
		}

		$pagelinks = null;
		if ($pages > 3) {
			$countfor = 3;
		} else {
			$countfor = $pages;
		}

		for ($i = 0; $i < $countfor; $i++)
		{
			$minpag = $i * $n;
			$page   = $i + 1;
			$pagelinks .= "<a href=\"{$this->self}?$link&amp;min=$minpag&amp;num=$n\" class=\"pages\">$page</a>{$sep}";
		}

		if (substr($pagelinks, -(strlen($sep))) == $sep) {
			$pagelinks = substr($pagelinks, 0, -(strlen($sep)));
		}

		if ($pages > 3) {
			$ellipsis = ($pages == 4) ? '' : '..';
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
	function select_avatars($current, $relative = '.', $subfolder = '/')
	{
		if (substr($subfolder, -1) != '/') {
			$subfolder .= '/';
		}

		$out = null;
		$dir = opendir($relative . '/avatars' . $subfolder);
		$subDirs = array();

		while (($file = readdir($dir)) !== false)
		{
			if (is_dir('./avatars' . $subfolder . $file)) {
				if ($file == 'uploaded' || $file[0] == '.') continue;
				
				$subDirs[] = $file;
			}

			$split = explode('.', $file);
			$ext   = array_pop($split);
			if (($ext != 'jpg')
			&& ($ext != 'jpeg')
			&& ($ext != 'gif')
			&& ($ext != 'png')) {
				continue;
			}

			$out .= "<option value=\"./avatars$subfolder$file\"" . (("./avatars$subfolder$file" == $current) ? ' selected="selected"' : null) . '>' . implode('.', $split) . "</option>\n";
		}

		foreach ($subDirs as $file) {
			$extra = $this->select_avatars($current, $relative, $subfolder . $file);
			if ($extra) {
				if ($subfolder == '/') {
					$out .= '<optgroup label="' . htmlspecialchars($file) . "\">\n";
					$out .= $extra;
					$out .= "</optgroup>\n";
				} else {
					$out .= "</optgroup>\n";
					$out .= '<optgroup label="' . htmlspecialchars(substr($subfolder . $file, 1)) . "\">\n";
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
	function select_groups($val, $custom_only = false)
	{
		if ($custom_only) {
			$groups = $this->db->query('SELECT group_name, group_id FROM %pgroups WHERE group_type="" ORDER BY group_name');
		} else {
			$groups = $this->db->query('SELECT group_name, group_id FROM %pgroups ORDER BY group_name');
		}

		$out = null;

		while ($group = $this->db->nqfetch($groups))
		{
			$out .= "<option value=\"{$group['group_id']}\"" . (($val == $group['group_id']) ? ' selected="selected"' : '') . ">{$group['group_name']}</option>";
		}

		return $out;
	}

	/**
	 * Create options of "null" to 31 selectable as a day of the month
	 *
	 * @param int $dat current day of the month (if any) 
	 * @return string HTML
	 **/
	function select_days($day)
	{
		$i   = 1;
		$out = "<option value=\"00\"></option>\n";

		while ($i <= 31)
		{
			$out .= "<option value=\"$i\"" . (($i == $day) ? ' selected="selected"' : null) . ">$i</option>\n";
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
	function select_months($mon)
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

		foreach ($month as $digit => $name)
		{
			$out .= "<option value=\"$digit\"" . (($digit == $mon) ? ' selected="selected"' : null) . ">$name</option>\n";
		}

		return $out;
	}

	/**
	 * Create options of "null" to 100 years ago as selectable years
	 *
	 * @param int $year the selected year (if any) 
	 * @return string HTML
	 **/
	function select_years($year)
	{
		$thisyear = gmdate("Y", time()); // Could end up missing the 'current year' if on new years day/eve
		$i        = $thisyear;
		$out      = "<option value='0000'></option>\n";

		while ($i >= $thisyear-100)
		{
			$out .= "<option value=\"$i\"" . (($i == $year) ? ' selected="selected"' : null) . ">$i</option>\n";
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
	function select_skins($skin)
	{
		$out = null;

		$query = $this->db->query("SELECT * FROM %pskins");
		while ($s = $this->db->nqfetch($query))
		{
			if ($s['skin_dir'] == 'default') {
				$s['skin_name'] .= ' (default)';
			}
			$out .= "<option value=\"{$s['skin_dir']}\"" . (($s['skin_dir'] == $skin) ? ' selected="selected"' : null) . ">{$s['skin_name']}</option>\n";
		}

		return $out;
	}

	/**
	 * Create options of different timezones
	 *
	 * @param int $zone current timezone id 
	 * @return string HTML
	 **/
	function select_timezones($zone)
	{
		$out = null;

		$query = $this->db->query("SELECT zone_id, zone_name, zone_offset, zone_updated, zone_abbrev FROM %ptimezones ORDER BY zone_name ASC");
		while($row = $this->db->nqfetch($query))
		{
			if ($row['zone_updated'] < $this->time)
			{
				$tz = new $this->modules['timezone']('timezone/'.$row['zone_name']);
				$tz->magic2();
				if (strlen($tz->abba)<1) $tz->abba='N/A';
				$this->db->query("UPDATE %ptimezones SET zone_offset=%d, zone_updated=%d, zone_abbrev='%s' WHERE zone_id=%d",
					$tz->gmt_offset, $tz->next_update, $tz->abba, $row['zone_id']);
				$row['zone_abbrev'] = $tz->abba;
				$row['zone_offset'] = $tz->gmt_offset;
			}

			$padding = str_repeat('&nbsp;', 30 - strlen($row['zone_name']));

			$out .= '<option value="' . $row['zone_id'] . '"' . (($zone == $row['zone_id']) ? ' selected="selected"' : null) . '>' . 
				$row['zone_name'] . $padding  . ' ' . $row['zone_abbrev']. ' (GMT'.(($row['zone_offset'] >= 0) ? '+' : '') . ($row['zone_offset']/3600). ')</option>'."\n";
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
	function select_forums($select = 0, $parent = 0, $space = '', $identify_category = false)
	{
		$array = $this->forum_grab();
		return $this->_select_forums_recurse($array, $select, $parent, $space, $identify_category);
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
	function _select_forums_recurse($array, $select, $parent, $space, $identify_category = false)
	{
		$arr = $this->forum_array($array, $parent);

		$return = null;
		foreach ($arr as $val)
		{
			if (!$this->perms->auth('forum_view', $val['forum_id'])) {
				continue;
			}

			if ($identify_category && !$val['forum_parent']) {
				$dot = '.';
			} else {
				$dot = null;
			}

			if (($val['forum_id'] != $select) && ($select != -1)) {
				$selected = null;
			} else {
				$selected = ' selected="selected"';
			}

			$return .= '<option value="' . $dot . $val['forum_id'] . '"' . $selected . '>' . $space . $val['forum_name'] . "</option>\n" .
			$this->_select_forums_recurse($array, $select, $val['forum_id'], $space . '&nbsp; &nbsp;');
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
	function select_langs($current, $relative = '.')
	{
		$out   = null;
		$langs = array();
		$dir   = opendir($relative . '/languages');

		while (($file = readdir($dir)) !== false)
		{
			if (is_dir($relative . '/languages/' . $file)) {
				continue;
			}

			$code = substr($file, 0, -4);
			$ext  = substr($file, -4);
			if ($ext != '.php') {
				continue;
			}

			$langs[$code] = $this->get_lang_name($code);
		}

		asort($langs);

		foreach ($langs as $code => $name)
		{
			$out .= "<option value='$code'" . (($code == $current) ? ' selected=\'selected\'' : null) . ">$name</option>\n";
		}

		return $out;
	}

	/**
	 * Fetch the language name for the language code
	 *
	 * @param string $code Two character country code
	 * @return string Language name (in English)
	 **/
	function get_lang_name($code)
	{
		$code = strtolower($code);

		switch($code)
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
	function tree($label, $link = null)
	{
		$this->tree .= ' <b>&raquo;</b> ' . ($link ? "<a href='$link'>$label</a>" : $label);
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
	function tree_forums($f, $linklast = false)
	{
		$forumData = $this->forum_grab_sorted();
		
		if (!isset($forumData[$f])) { //error? lets get out while we can
			return;
		}

		$cat = 1; //first forum is always a category
		$ft  = explode(',', $forumData[$f]['forum_tree']);
		foreach ($ft as $i)
		{
			if ($i) {
				if (!$cat) {
					$this->tree($forumData[$i]['forum_name'], "$this->self?a=forum&amp;f={$i}");
				} else {
					$this->tree($forumData[$i]['forum_name'], "$this->self?a=board&amp;c={$i}");
					$cat = 0;
				}
			}
		}

		if (!$linklast) {
			$this->tree($forumData[$f]['forum_name']);
		} else {
			$this->tree($forumData[$f]['forum_name'], "$this->self?a=forum&amp;f={$f}");
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
	function get_icons($select = -1)
	{
		$i     = 0;
		$icons = array();
		$dir   = opendir("./skins/$this->skin/mbicons");

		while (($file = readdir($dir)) !== false)
		{
			$ext = substr($file, -4);

			if ((($ext == '.gif') || ($ext == '.jpg') || ($ext == '.png')) && !is_dir("./skins/$this->skin/mbicons/$file")) {
				$icons[$i] = $file;
				$i++;
			}
		}

		closedir($dir);
		natsort($icons);

		$msgicons = null;
		$i        = 0;

		foreach ($icons as $icon)
		{
			$msgicons .= "<li><input type=\"radio\" name=\"icon\" id=\"icon$i\" value=\"$icon\"" . (($select == $icon) ? '
				checked=\'checked\'' : null) . " />&nbsp;<label for=\"icon$i\"><img src=\"./skins/$this->skin/mbicons/$icon\" alt=\"{$this->lang->post_icon}\" /></label></li>\n";
			$i++;
		}
		return $msgicons;
	}
}

?>
