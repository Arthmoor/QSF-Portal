<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2015 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * http://code.google.com/p/quicksilverforums/
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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/global.php';

/**
 * Displays a list of registered members
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since Beta 2.0
 **/
class members extends qsfglobal
{
	function execute()
	{
		if (!$this->perms->auth('board_view')) {
			$this->lang->board();
			return $this->message(
				sprintf($this->lang->board_message, $this->sets['forum_name']),
				($this->perms->is_guest) ? sprintf($this->lang->board_regfirst, $this->self) : $this->lang->board_noview
			);
		}

		$this->set_title($this->lang->members_list);
		$this->tree($this->lang->members_list);

		$this->get['min'] = isset($this->get['min']) ? intval($this->get['min']) : 0;
		$this->get['num'] = isset($this->get['num']) ? intval($this->get['num']) : 25;
		$asc = 0;

		if (isset($this->get['order'], $this->get['asc'])) {
			$order = $this->get['order'];

			switch($this->get['order'])
			{
			case 'posts':
				$sortby = 'm.user_posts';
				break;

			case 'group':
				$sortby = 'm.user_group';
				break;

			case 'joined':
				$sortby = 'm.user_joined';
				break;

			default:
				$order = 'member';
				$sortby = 'm.user_name';
				break;
			}

			if (!$this->get['asc']) {
				$sortby .= ' DESC';
			}

			$asc  = ($this->get['asc'] == 0) ? 1 : 0;
			$lasc = ($this->get['asc'] == 0) ? 0 : 1;

		} else {
			$lasc = 1;
			$order = 'member';
			$sortby = 'm.user_name ASC';
		}

		if (!isset($this->get['l'])) {
			$l = null;
		} else {
			$l = strtoupper(preg_replace('/[^A-Za-z]/', '', $this->get['l']));
		}

		if ($l) {
		$PageNums = $this->htmlwidgets->get_pages(
			array("SELECT user_id FROM %pusers m, %pgroups g
			WHERE m.user_group = g.group_id AND m.user_id != %d AND UPPER(LEFT(LTRIM(m.user_name), 1)) = '%s'",
			USER_GUEST_UID, $l),
			"a=members&amp;l={$l}&amp;order=$order&amp;asc=$lasc", $this->get['min'], $this->get['num']);
		} else {
		$PageNums = $this->htmlwidgets->get_pages(
			array("SELECT user_id FROM %pusers m, %pgroups g WHERE m.user_group = g.group_id AND m.user_id != %d", USER_GUEST_UID),
			"a=members&amp;l={$l}&amp;order=$order&amp;asc=$lasc", $this->get['min'], $this->get['num']);
		}

		$result = $this->db->query("
			SELECT
				m.user_joined, m.user_email_show, m.user_email_form, m.user_email, m.user_pm, m.user_name, m.user_id, m.user_posts, m.user_title, m.user_homepage, m.user_group,
				g.group_name
			FROM
				%pusers m,
				%pgroups g
			WHERE
				m.user_group = g.group_id AND
				m.user_id != %d" .
				($l ? " AND UPPER(LEFT(LTRIM(m.user_name), 1)) = '{$l}'" : '') . "
			ORDER BY
				{$sortby}
			LIMIT
				%d, %d",
			USER_GUEST_UID, $this->get['min'], $this->get['num']);

		$Members = null;

		while ($member = $this->db->nqfetch($result))
		{
			$member['user_joined'] = $this->mbdate(DATE_ONLY_LONG, $member['user_joined']);

			// Do not display members awaiting activation, or members with zero posts to guests or other members awaiting activation. Discourages spambots.
			if( $this->user['user_id'] == USER_GUEST_UID || $this->user['user_group'] == USER_AWAIT ) {
				if( $member['user_group'] == USER_AWAIT )
					continue;

				if( $member['user_posts'] < 1 )
					continue;
			}

			if ($this->perms->auth('email_use')) {
				if ($member['user_email_show']) {
					$member['email'] = $member['user_email'];
				}
			}

			if (!empty($member['user_homepage'])) {
				$member['homepage'] = $member['user_homepage']; // Store so skin can access directly
			}

			if (!$member['user_pm'] || $this->perms->is_guest) {
				$member['user_pm'] = null;
			}

			$Members .= eval($this->template('MEMBERS_MEMBER'));
		}

		return eval($this->template('MEMBERS_MAIN'));
	}
}
?>