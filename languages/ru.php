<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005 The Quicksilver Forums Development Team
 *  http://www.quicksilverforums.com/
 * 
 * based off MercuryBoard
 * Copyright (c) 2001-2005 The Mercury Development Team
 *  http://www.mercuryboard.com/
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

/**
 * Russian language module
 *
 * @author Alexey Loshkarev <elf@pechkin.ru>
 * @author Polkop <polkop@tut.by>
 * @since 1.1.2
 **/
class ru
{
	function active()
	{
		$this->active_last_action = '��������� ��������';
		$this->active_modules_active = '������������� ������ �������� �������������';
		$this->active_modules_board = '����� �� �������';
		$this->active_modules_cp = '����� � ����������� ������';
		$this->active_modules_forum = '������������� �����: %s';
		$this->active_modules_help = '������ �����';
		$this->active_modules_login = '���������';
		$this->active_modules_members = '������� ������ �������������';
		$this->active_modules_mod = '����������';
		$this->active_modules_pm = '����� ��������� ���������';
		$this->active_modules_post = '����� ���������';
		$this->active_modules_printer = '�������� ����: %s';
		$this->active_modules_profile = '������� �������: %s';
		$this->active_modules_recent = 'Viewing recent posts'; //Translate
		$this->active_modules_search = '����';
		$this->active_modules_topic = '������� ����: %s';
		$this->active_time = '�����';
		$this->active_user = '������������';
		$this->active_users = '�������� ������������';
	}

	function admin()
	{
		$this->admin_add_emoticons = 'Add emoticons'; //Translate
		$this->admin_add_member_titles = 'Add automatic member titles'; //Translate
		$this->admin_add_templates = 'Add HTML templates'; //Translate
		$this->admin_ban_ips = 'Ban IP addresses'; //Translate
		$this->admin_censor = 'Censor words'; //Translate
		$this->admin_cp_denied = 'Access Denied'; //Translate
		$this->admin_cp_warning = 'The Admin CP is disabled until you delete your <b>install</b> directory, as it poses a serious security risk.'; //Translate
		$this->admin_create_forum = 'Create a forum'; //Translate
		$this->admin_create_group = 'Create a group'; //Translate
		$this->admin_create_help = 'Create a help article'; //Translate
		$this->admin_create_skin = 'Create a skin'; //Translate
		$this->admin_db = 'Database'; //Translate
		$this->admin_db_backup = 'Backup the database'; //Translate
		$this->admin_db_conn = 'Edit connection settings'; //Translate
		$this->admin_db_optimize = 'Optimize the database'; //Translate
		$this->admin_db_query = 'Execute an SQL query'; //Translate
		$this->admin_db_restore = 'Restore a backup'; //Translate
		$this->admin_delete_forum = 'Delete a forum'; //Translate
		$this->admin_delete_group = 'Delete a group'; //Translate
		$this->admin_delete_help = 'Delete a help article'; //Translate
		$this->admin_delete_member = 'Delete a member'; //Translate
		$this->admin_delete_template = 'Delete HTML template'; //Translate
		$this->admin_edit_emoticons = 'Edit or delete emoticons'; //Translate
		$this->admin_edit_forum = 'Edit a forum'; //Translate
		$this->admin_edit_group_name = 'Edit a group\'s name'; //Translate
		$this->admin_edit_group_perms = 'Edit a group\'s permissions'; //Translate
		$this->admin_edit_help = 'Edit a help article'; //Translate
		$this->admin_edit_member = 'Edit a member'; //Translate
		$this->admin_edit_member_perms = 'Edit a member\'s permissions'; //Translate
		$this->admin_edit_member_titles = 'Edit or delete automatic member titles'; //Translate
		$this->admin_edit_settings = 'Edit board settings'; //Translate
		$this->admin_edit_skin = 'Edit or delete a skin'; //Translate
		$this->admin_edit_templates = 'Edit HTML templates'; //Translate
		$this->admin_emoticons = 'Emoticons'; //Translate
		$this->admin_export_skin = 'Export a skin'; //Translate
		$this->admin_fix_stats = 'Fix the member statistics'; //Translate
		$this->admin_forum_order = 'Change the forum ordering'; //Translate
		$this->admin_forums = 'Forums and Categories'; //Translate
		$this->admin_groups = 'Groups'; //Translate
		$this->admin_heading = 'Quicksilver Forums Admin Control Panel'; //Translate
		$this->admin_help = 'Help Articles'; //Translate
		$this->admin_install_emoticons = 'Install emoticons'; //Translate
		$this->admin_install_skin = 'Install a skin'; //Translate
		$this->admin_logs = 'View moderator actions'; //Translate
		$this->admin_mass_mail = 'Send an email to your members'; //Translate
		$this->admin_members = 'Members'; //Translate
		$this->admin_phpinfo = 'View PHP information'; //Translate
		$this->admin_prune = 'Prune old topics'; //Translate
		$this->admin_recount_forums = 'Recount topics and replies'; //Translate
		$this->admin_settings = 'Settings'; //Translate
		$this->admin_settings_add = 'Add new board setting'; //Translate
		$this->admin_skins = 'Skins'; //Translate
		$this->admin_stats = 'Statistics center'; //Translate
		$this->admin_upgrade_skin = 'Upgrade a Skin'; //Translate
		$this->admin_your_board = 'Your Board'; //Translate
	}

	function backup()
	{
		$this->backup_create = 'Backup Database'; //Translate
		$this->backup_createfile = 'Backup and create a file on server'; //Translate
		$this->backup_done = 'The database has been backed up to the main Quicksilver Forums directory.';
		$this->backup_download = 'Backup and download (recommended)'; //Translate
		$this->backup_found = 'The following backups were found in the Quicksilver Forums directory';
		$this->backup_invalid = 'The backup does not appear to be valid. No changes were made to your database.'; //Translate
		$this->backup_none = 'No backups were found in the Quicksilver Forums directory.';
		$this->backup_options = 'Select how you want your backup created'; //Translate
		$this->backup_restore = 'Restore Backup'; //Translate
		$this->backup_restore_done = 'The database has been restored successfully.'; //Translate
		$this->backup_warning = 'Warning: This will overwrite all existing data used by Quicksilver Forums.'; //Translate
	}

	function ban()
	{
		$this->ban = 'Ban'; //Translate
		$this->ban_banned_ips = 'Ban IP Addresses'; //Translate
		$this->ban_banned_members = 'Banned Members'; //Translate
		$this->ban_ip = 'Ban IP Addresses'; //Translate
		$this->ban_member_explain1 = 'To ban users, change their user group to'; //Translate
		$this->ban_member_explain2 = 'in the member controls.'; //Translate
		$this->ban_members = 'Ban Members'; //Translate
		$this->ban_nomembers = 'There are currently no banned members.'; //Translate
		$this->ban_one_per_line = 'One address per line.'; //Translate
		$this->ban_regex_allowed = 'Regular expressions are allowed. You can use a single * as a wildcard for one or more digits.'; //Translate
		$this->ban_settings = 'Ban Settings'; //Translate
		$this->ban_users_banned = 'Users banned.'; //Translate
	}

	function bbcode()
	{
		$this->bbcode_arial = 'Arial'; //Translate
		$this->bbcode_blue = 'Blue'; //Translate
		$this->bbcode_bold = 'Bold (CTRL-b)'; //Translate
		$this->bbcode_bold1 = 'B'; //Translate
		$this->bbcode_chocolate = 'Chocolate'; //Translate
		$this->bbcode_code = 'Code (CTRL-l)'; //Translate
		$this->bbcode_code1 = 'Code'; //Translate
		$this->bbcode_color = 'Color'; //Translate
		$this->bbcode_coral = 'Coral'; //Translate
		$this->bbcode_courier = 'Courier'; //Translate
		$this->bbcode_crimson = 'Crimson'; //Translate
		$this->bbcode_darkblue = 'Dark Blue'; //Translate
		$this->bbcode_darkred = 'Dark Red'; //Translate
		$this->bbcode_deeppink = 'Deep Pink'; //Translate
		$this->bbcode_email = 'Email (CTRL-e)'; //Translate
		$this->bbcode_firered = 'Firebrick Red'; //Translate
		$this->bbcode_font = 'Font'; //Translate
		$this->bbcode_green = 'Green'; //Translate
		$this->bbcode_huge = 'Huge'; //Translate
		$this->bbcode_image = 'Image (CTRL-j)'; //Translate
		$this->bbcode_image1 = 'IMG'; //Translate
		$this->bbcode_impact = 'Impact'; //Translate
		$this->bbcode_indigo = 'Indigo'; //Translate
		$this->bbcode_italic = 'Italic (CTRL-i)'; //Translate
		$this->bbcode_italic1 = 'I'; //Translate
		$this->bbcode_large = 'Large'; //Translate
		$this->bbcode_limegreen = 'Lime Green'; //Translate
		$this->bbcode_medium = 'Medium'; //Translate
		$this->bbcode_orange = 'Orange'; //Translate
		$this->bbcode_orangered = 'Orange Red'; //Translate
		$this->bbcode_php = 'PHP (CTRL-k)'; //Translate
		$this->bbcode_php1 = 'PHP'; //Translate
		$this->bbcode_purple = 'Purple'; //Translate
		$this->bbcode_quote = 'Quote (CTRL-q)'; //Translate
		$this->bbcode_quote1 = 'Quote'; //Translate
		$this->bbcode_red = 'Red'; //Translate
		$this->bbcode_royalblue = 'Royal Blue'; //Translate
		$this->bbcode_sandybrown = 'Sandy Brown'; //Translate
		$this->bbcode_seagreen = 'Sea Green'; //Translate
		$this->bbcode_sienna = 'Sienna'; //Translate
		$this->bbcode_silver = 'Silver'; //Translate
		$this->bbcode_size = 'Size'; //Translate
		$this->bbcode_skyblue = 'Sky Blue'; //Translate
		$this->bbcode_small = 'Small'; //Translate
		$this->bbcode_spoiler = 'Spoiler (CTRL-r)'; //Translate
		$this->bbcode_spoiler1 = 'Spoiler'; //Translate
		$this->bbcode_strike = 'Strikethrough (CTRL-s)'; //Translate
		$this->bbcode_strike1 = 'S'; //Translate
		$this->bbcode_tahoma = 'Tahoma'; //Translate
		$this->bbcode_teal = 'Teal'; //Translate
		$this->bbcode_times = 'Times'; //Translate
		$this->bbcode_tiny = 'Tiny'; //Translate
		$this->bbcode_tomato = 'Tomato'; //Translate
		$this->bbcode_underline = 'Underline (CTRL-u)'; //Translate
		$this->bbcode_underline1 = 'U'; //Translate
		$this->bbcode_url = 'URL (CTRL-h)'; //Translate
		$this->bbcode_url1 = 'URL'; //Translate
		$this->bbcode_verdana = 'Verdana'; //Translate
		$this->bbcode_wood = 'Burly Wood'; //Translate
		$this->bbcode_yellow = 'Yellow'; //Translate
	}

	function board()
	{
		$this->board_active_users = '�������� ������������';
		$this->board_birthdays = '����������� ��� ��������';
		$this->board_bottom_page = 'Go to the bottom of the page'; //Translate
		$this->board_can_post = '�� ������ �������� � ���� ������.';
		$this->board_can_topics = '�� ������ ������, �� �� ��������� ���� � ���� ������.';
		$this->board_cant_post = '�� �� ������ �������� � ���� ������.';
		$this->board_cant_topics = '�� �� ������ ������ ��� ��������� ���� � ���� ������.';
		$this->board_forum = '�����';
		$this->board_guests = '�����';
		$this->board_last_post = '��������� ���������';
		$this->board_mark = '�������� ��� ��������� ��� �����������';
		$this->board_mark1 = '��� ��������� � ������ ���� �������� ��� �����������.';
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = '������������';
		$this->board_message = '%s ���������';
		$this->board_most_online = '������������ ����� ������������� �� ������ -  %d  ���� %s.';
		$this->board_nobday = '������� ��� ���� �������� ������ ������.';
		$this->board_nobody = '���� ������ ������.';
		$this->board_nopost = '��� ���������';
		$this->board_noview = '� ���� ��� ���� ������������� ��� ������.';
		$this->board_regfirst = '���� �� �� ���������������, �� �� ������ ������� �� ������.';
		$this->board_replies = '�������';
		$this->board_stats = '����������';
		$this->board_stats_string = '%s ������������� ����������������. ������������ ������ ������������, %s.<br />����� %s ��� � %s ������� � %s ����������.';
		$this->board_top_page = 'Go to the top of the page'; //Translate
		$this->board_topics = '���';
		$this->board_users = '������������(-��)';
		$this->board_write_topics = '�� ������ ������ � ��������� ���� � ���� ������.';
	}

	function censoring()
	{
		$this->censor = 'Censor Words'; //Translate
		$this->censor_one_per_line = 'One per line.'; //Translate
		$this->censor_regex_allowed = 'Regular expressions are allowed. You can use a single * as a wildcard for one or more characters.'; //Translate
		$this->censor_updated = 'Word list updated.'; //Translate
	}

	function cp()
	{
		$this->cp_aim = '��� � AIM';
		$this->cp_already_member = '��������� ����� ��� ������������ ����� �� ���������������� �������������.';
		$this->cp_apr = '������';
		$this->cp_aug = '������';
		$this->cp_avatar_current = '���� ������� �������';
		$this->cp_avatar_error = '������ ��� ������ � ��������';
		$this->cp_avatar_must_select = '�� ������ ������� �������.';
		$this->cp_avatar_none = '�� ����������� �������';
		$this->cp_avatar_pixels = '��������';
		$this->cp_avatar_select = '������ �������';
		$this->cp_avatar_size_height = '������ ������� ������ ���� ����� 1 �';
		$this->cp_avatar_size_width = '������ ������� ������ ���� ����� 1 �';
		$this->cp_avatar_upload = '��������� ������� � �����';
		$this->cp_avatar_upload_failed = '������ ��� �������� �������. ��������, �� ���������� ����, ������� �� ������.';
		$this->cp_avatar_upload_not_image = '�� ������ ������ ��������� �������� � �������� ����� �������.';
		$this->cp_avatar_upload_too_large = '��������� ������� ������� �������. ������������ ����� - %d ��������.';
		$this->cp_avatar_url = '����� URL � ����� �������';
		$this->cp_avatar_use = '������������ ����������� �������';
		$this->cp_bday = '���� ��������';
		$this->cp_been_updated = '���� ������� ��� ��������.';
		$this->cp_been_updated1 = '���� ������ ���� ���������.';
		$this->cp_been_updated_prefs = '���� ��������� ���� ���������.';
		$this->cp_changing_pass = '��������� ������';
		$this->cp_contact_pm = '��������� ������ ������ ���� ������ ���������?';
		$this->cp_cp = '����������� ������';
		$this->cp_current_avatar = '������� ������';
		$this->cp_current_time = '������ %s.';
		$this->cp_custom_title = 'Custom Member Title'; //Translate
		$this->cp_custom_title2 = 'This is a privledge reserved for board administrators'; //Translate
		$this->cp_dec = '�������';
		$this->cp_editing_avatar = '�������������� �������';
		$this->cp_editing_profile = '�������������� �������';
		$this->cp_email = '����� Email';
		$this->cp_email_form = '��������� ������ ������ ��� �� ����������� �����?';
		$this->cp_email_invaid = '��������� ����� �������.';
		$this->cp_err_avatar = '������ ���������� �������';
		$this->cp_err_updating = '������ ���������� �������';
		$this->cp_feb = '�������';
		$this->cp_file_type = '��������� ������� ��������. �������, ��� URL ��������� ������ � ��� ����� - gif,jpg ��� png.';
		$this->cp_format = '�������������� �����';
		$this->cp_gtalk = 'GTalk Account'; //Translate
		$this->cp_header = '����������� ������';
		$this->cp_height = '������';
		$this->cp_icq = '����� ICQ';
		$this->cp_interest = '��������';
		$this->cp_jan = '������';
		$this->cp_july = '����';
		$this->cp_june = '����';
		$this->cp_label_edit_avatar = '�������� �������';
		$this->cp_label_edit_pass = '�������� ������';
		$this->cp_label_edit_prefs = '�������� ���������';
		$this->cp_label_edit_profile = '������������� �������';
		$this->cp_label_edit_sig = 'Edit Signature'; //Translate
		$this->cp_label_edit_subs = '�������� ��������';
		$this->cp_language = '����';
		$this->cp_less_charac = '��� ������ ���� ������ 32-� ��������.';
		$this->cp_location = '��������������';
		$this->cp_login_first = '����� ����������� ����� ������ � ����������� ������.';
		$this->cp_mar = '����';
		$this->cp_may = '���';
		$this->cp_msn = '������������� MSN';
		$this->cp_must_orig = '��� ������ ���� ���������� � ����������. �� ������ �������� ������ ������� ���� � ���������� ����� �������.';
		$this->cp_new_notmatch = '����� ������ �� ���������.';
		$this->cp_new_pass = '����� ������';
		$this->cp_no_flash = '������������� ������� � ��� ���������.';
		$this->cp_not_exist = '��������� ���� (%s) �� ����������!';
		$this->cp_nov = '������';
		$this->cp_oct = '�������';
		$this->cp_old_notmatch = '��������� ������ ������ �� ��������� � ������� � ����.';
		$this->cp_old_pass = '������ ������';
		$this->cp_pass_notvaid = '���� ������ �������. �������, ��� ������������ ������ ���������� �������, ����� ��� �����, �����, ����, ������������� ��� �������.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = '��������� ��������';
		$this->cp_preview_sig = 'Signature Preview:'; //Translate
		$this->cp_privacy = '��������� ������������';
		$this->cp_repeat_pass = '������� ����� ������';
		$this->cp_sept = '��������';
		$this->cp_show_active = '���������� ���� ���������� ��� ��������� �������?';
		$this->cp_show_email = '���������� ����� email � �������?';
		$this->cp_signature = '�������';
		$this->cp_size_max = '������ ��������� ������� ������� �������. ����������� ����������� ������ - %s �� %s ��������.';
		$this->cp_skin = '���� ������';
		$this->cp_sub_change = '��������� ��������';
		$this->cp_sub_delete = '�������';
		$this->cp_sub_expire = '���� �����������';
		$this->cp_sub_name = '�������� ��������';
		$this->cp_sub_no_params = '�� ������ ���������.';
		$this->cp_sub_success = '������ �� �������� �� %s.';
		$this->cp_sub_type = '��� ��������';
		$this->cp_sub_updated = '��������� �������� ���� �������.';
		$this->cp_topic_option = '��������� ���';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = '������� ��������';
		$this->cp_updated1 = '������� ���������';
		$this->cp_updated_prefs = '��������� ���������';
		$this->cp_user_exists = '������������ � ���������� ���������������� ������ ��� ����������.';
		$this->cp_valided = '���� ������ ��� �������� � �������.';
		$this->cp_view_avatar = '���������� �������?';
		$this->cp_view_emoticon = '���������� ������?';
		$this->cp_view_signature = '���������� �������?';
		$this->cp_welcome = '����� ���������� � ����������� ������. ��� �� ������ ��������� ���� �������. ������ ������ �����.';
		$this->cp_width = '������';
		$this->cp_www = '�������� ��������';
		$this->cp_yahoo = '������������� Yahoo';
		$this->cp_zone = '������� ����';
	}

	function email()
	{
		$this->email_blocked = '���� ������������ �� ��������� ��������� email ����� ��� ������.';
		$this->email_email = '����� Email';
		$this->email_msgtext = '���� Email:';
		$this->email_no_fields = '������� � ������� ��� ����.';
		$this->email_no_member = '�� ������ ������������ � ����� ������';
		$this->email_no_perm = '� ���� ��� ���� �������� ��������� ����� ��� ������.';
		$this->email_sent = '��������� email ���� �������.';
		$this->email_subject = '����:';
		$this->email_to = '����:';
	}

	function emot_control()
	{
		$this->emote = 'Emoticons'; //Translate
		$this->emote_add = 'Add Emoticons'; //Translate
		$this->emote_added = 'Emoticon added.'; //Translate
		$this->emote_clickable = 'Clickable'; //Translate
		$this->emote_edit = 'Edit Emoticons'; //Translate
		$this->emote_image = 'Image'; //Translate
		$this->emote_install = 'Install Emoticons'; //Translate
		$this->emote_install_done = 'Emoticons have been successfully reinstalled.'; //Translate
		$this->emote_install_warning = 'This will erase all existing emoticon settings and import uploaded emoticons from your currently selected skin into the database.'; //Translate
		$this->emote_no_text = 'No emoticon text was given.'; //Translate
		$this->emote_text = 'Text'; //Translate
	}

	function forum()
	{
		$this->forum_by = '�������';
		$this->forum_can_post = '�� ������ �������� � ���� ������.';
		$this->forum_can_topics = '�� ������ ������ ���� � ���� ������.';
		$this->forum_cant_post = '�� �� ������ �������� � ���� ������.';
		$this->forum_cant_topics = '�� �� ������ ������ ���� � ���� ������.';
		$this->forum_dot = '�����';
		$this->forum_dot_detail = '��������, ��� �� ����� � ���� ����';
		$this->forum_forum = '�����';
		$this->forum_guest = '�����';
		$this->forum_hot = '�������';
		$this->forum_icon = '������ ���������';
		$this->forum_jump = '������� � ���������� ��������� � ����';
		$this->forum_last = '��������� ���������';
		$this->forum_locked = '�������';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = '����������';
		$this->forum_msg = '%s Message'; //Translate
		$this->forum_new = '�����';
		$this->forum_new_poll = '������� �����������';
		$this->forum_new_topic = '������� ����� ����';
		$this->forum_no_topics = '� ���� ������ ��� ��� ��� �����������.';
		$this->forum_noexist = '��������� ����� �� ����������.';
		$this->forum_nopost = '��� ���������';
		$this->forum_not = '��';
		$this->forum_noview = '� ���� ��� ����� ������ ����� ������.';
		$this->forum_pages = '�������';
		$this->forum_pinned = '�����������';
		$this->forum_pinned_topic = '������������� ����';
		$this->forum_poll = '�����������';
		$this->forum_regfirst = '� ������������������ ������������� ��� ����� ��������� �������.';
		$this->forum_replies = '�������';
		$this->forum_starter = '�����';
		$this->forum_sub = '��������';
		$this->forum_sub_last_post = '��������� ���������';
		$this->forum_sub_replies = '�������';
		$this->forum_sub_topics = '���';
		$this->forum_subscribe = '��������� �� e-mail �� ������� � ���� ������';
		$this->forum_topic = '����';
		$this->forum_views = '����������';
		$this->forum_write_topics = '�� ������ ��������� ���� � ���� ������.';
	}

	function forums()
	{
		$this->forum_controls = 'Forum Controls'; //Translate
		$this->forum_create = 'Create Forum'; //Translate
		$this->forum_create_cat = 'Create a Category'; //Translate
		$this->forum_created = 'Forum Created'; //Translate
		$this->forum_default_perms = 'Default Permissions'; //Translate
		$this->forum_delete = 'Delete Forum'; //Translate
		$this->forum_delete_warning = 'Are you sure you want to delete this forum, its topics, and its posts?<br />This action cannot be reversed.'; //Translate
		$this->forum_deleted = 'The forum has been deleted.'; //Translate
		$this->forum_description = 'Description'; //Translate
		$this->forum_edit = 'Edit Forum'; //Translate
		$this->forum_edited = 'The forum was edited successfully.'; //Translate
		$this->forum_empty = 'The forum name is empty. Please go back and enter a name.'; //Translate
		$this->forum_is_subcat = 'This forum is a subcategory only.'; //Translate
		$this->forum_name = 'Name'; //Translate
		$this->forum_no_orphans = 'You cannot orphan a forum by deleting its parent.'; //Translate
		$this->forum_none = 'There are no forums to manipulate.'; //Translate
		$this->forum_ordered = 'Forum Order Updated'; //Translate
		$this->forum_ordering = 'Change Forum Ordering'; //Translate
		$this->forum_parent = 'You can\'t change a forum\'s parent in that way.'; //Translate
		$this->forum_parent_cat = 'Parent Category'; //Translate
		$this->forum_quickperm_select = 'Select an existing forum to copy its permissions.'; //Translate
		$this->forum_quickperms = 'Quick Permissions'; //Translate
		$this->forum_recount = 'Recount Topics and Replies'; //Translate
		$this->forum_select_cat = 'Select an existing category to create a forum.'; //Translate
		$this->forum_subcat = 'Subcategory'; //Translate
	}

	function groups()
	{
		$this->groups_bad_format = 'You must use %s in the format, which represents the group name.'; //Translate
		$this->groups_based_on = 'based on'; //Translate
		$this->groups_create = 'Create Group'; //Translate
		$this->groups_create_new = 'Create a new user group named'; //Translate
		$this->groups_created = 'Group Created'; //Translate
		$this->groups_delete = 'Delete Group'; //Translate
		$this->groups_deleted = 'Group Deleted.'; //Translate
		$this->groups_edit = 'Edit Group'; //Translate
		$this->groups_edited = 'Group Edited.'; //Translate
		$this->groups_formatting = 'Display Formatting'; //Translate
		$this->groups_i_confirm = 'I confirm that I want to delete this member group.'; //Translate
		$this->groups_name = 'Name'; //Translate
		$this->groups_no_action = 'No action was taken.'; //Translate
		$this->groups_no_delete = 'There are no custom groups to delete.<br />The core groups are necessary for Quicksilver Forums to function, and cannot be deleted.'; //Translate
		$this->groups_no_group = 'No group was specified.'; //Translate
		$this->groups_no_name = 'No group name was given.'; //Translate
		$this->groups_only_custom = 'Note: You can only delete custom member groups. The core groups are necessary for Quicksilver Forums to function.'; //Translate
		$this->groups_the = 'The group'; //Translate
		$this->groups_to_edit = 'Group to edit'; //Translate
		$this->groups_type = 'Group Type'; //Translate
		$this->groups_will_be = 'will be deleted.'; //Translate
		$this->groups_will_become = 'Users from the deleted group will become'; //Translate
	}

	function help()
	{
		$this->help_add = 'Add Help Article'; //Translate
		$this->help_article = 'Help Article Control'; //Translate
		$this->help_available_files = '������';
		$this->help_confirm = 'Are you sure you want to delete'; //Translate
		$this->help_content = 'Article content'; //Translate
		$this->help_delete = 'Delete Help Article'; //Translate
		$this->help_deleted = 'Help Article Deleted.'; //Translate
		$this->help_edit = 'Edit Help Article'; //Translate
		$this->help_edited = 'Help article updated.'; //Translate
		$this->help_inserted = 'Article inserted into the database.'; //Translate
		$this->help_no_articles = 'No help articles were found in the database.'; //Translate
		$this->help_no_title = 'You can\'t create a help article without a title.'; //Translate
		$this->help_none = '� ���� ������ ��� ������ ������.';
		$this->help_not_exist = 'That help article does not exist.'; //Translate
		$this->help_select = 'Please select a help article to edit'; //Translate
		$this->help_select_delete = 'Please select a help article to delete'; //Translate
		$this->help_title = 'Title'; //Translate
	}

	function home()
	{
		$this->home_choose = 'Choose a task to begin.'; //Translate
		$this->home_menu_title = 'Admin CP Menu'; //Translate
	}

	function jsdata()
	{
		$this->jsdata_address = 'Enter an address'; //Translate
		$this->jsdata_detail = 'Enter a description'; //Translate
		$this->jsdata_smiles = 'Clickable Smilies'; //Translate
		$this->jsdata_url = 'URL'; //Translate
	}

	function jslang()
	{
		$this->jslang_avatar_size_height = 'Your avatar height must be between 1 and %d pixels'; //Translate
		$this->jslang_avatar_size_width = 'Your avatar width must be between 1 and %d pixels'; //Translate
	}

	function login()
	{
		$this->login_cant_logged = '���������� �����. ������� ������������ ����� ����� � ������.<br /><br />��� ��������-��������, ��� ������ ��� \'UsErNaMe\' ���������� �� \'Username\'. ����� �������, ��� � ����� �������� �������� cookie.';
		$this->login_cookies = '��� ����� ��������� ���������� cookies.';
		$this->login_forgot_pass = '����� ������?';
		$this->login_header = '����';
		$this->login_logged = '���� ����������.';
		$this->login_now_out = '����� ����������.';
		$this->login_out = '�����';
		$this->login_pass = '������';
		$this->login_pass_no_id = '������������ � ����� ������ �� ����������.';
		$this->login_pass_request = '�������� ������ � ������, ������������ �� ��� �����, ����� ��������� ��������� ������ ������.';
		$this->login_pass_reset = '�������� ������';
		$this->login_pass_sent = '���� ������ ��� �������. ����� ������ ��� ������ �� ����� email, ��������� ��� �����������.';
		$this->login_sure = '������������� ������ ����� �� \'%s\'?';
		$this->login_user = '��� ������������';
	}

	function logs()
	{
		$this->logs_action = 'Action'; //Translate
		$this->logs_deleted_post = 'Deleted a post'; //Translate
		$this->logs_deleted_topic = 'Deleted a topic'; //Translate
		$this->logs_edited_post = 'Edited a post'; //Translate
		$this->logs_edited_topic = 'Edited a topic'; //Translate
		$this->logs_id = 'IDs'; //Translate
		$this->logs_locked_topic = 'Locked a topic'; //Translate
		$this->logs_moved_from = 'from forum'; //Translate
		$this->logs_moved_to = 'to forum'; //Translate
		$this->logs_moved_topic = 'Moved a topic'; //Translate
		$this->logs_moved_topic_num = 'Moved topic #'; //Translate
		$this->logs_pinned_topic = 'Pinned a topic'; //Translate
		$this->logs_post = 'Post'; //Translate
		$this->logs_time = 'Time'; //Translate
		$this->logs_topic = 'Topic'; //Translate
		$this->logs_unlocked_topic = 'Unlocked a topic'; //Translate
		$this->logs_unpinned_topic = 'Unpinned a topic'; //Translate
		$this->logs_user = 'User'; //Translate
		$this->logs_view = 'View Moderator Actions'; //Translate
	}

	function main()
	{
		$this->main_activate = '���� ������� ��� �� ��� �������������.';
		$this->main_activate_resend = '������� ������������� ������ ������';
		$this->main_admincp = '�������';
		$this->main_banned = '���� ��� ������� �� ���� �������.';
		$this->main_code = '���';
		$this->main_cp = '����������� ������';
		$this->main_full = '������ �����';
		$this->main_help = '������';
		$this->main_load = '��������';
		$this->main_login = '����';
		$this->main_logout = '�����';
		$this->main_mark = 'mark all';
		$this->main_mark1 = 'Mark all topics as read'; //Translate
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = '��������, %s ������ ���������� ��-�� �������� ���������� �����������.';
		$this->main_members = '������������';
		$this->main_messenger = '���������';
		$this->main_new = '�����';
		$this->main_next = '��������';
		$this->main_prev = '����������';
		$this->main_queries = '��������';
		$this->main_quote = '������';
		$this->main_recent = 'recent posts';
		$this->main_recent1 = 'View recent topics since your last visit'; //Translate
		$this->main_register = '�����������';
		$this->main_reminder = '������������';
		$this->main_reminder_closed = '������ ������� � �������� ������ ���������������.';
		$this->main_said = '������';
		$this->main_search = '�����';
		$this->main_topics_new = '� ������ ���� ����� ���������.';
		$this->main_topics_old = '� ������ ��� ����� ���������.';
		$this->main_welcome = '����� ����������';
		$this->main_welcome_guest = '����� ����������!';
	}

	function mass_mail()
	{
		$this->mail = 'Mass Mail'; //Translate
		$this->mail_announce = 'Announcement From'; //Translate
		$this->mail_groups = 'Recipient Groups'; //Translate
		$this->mail_members = 'members.'; //Translate
		$this->mail_message = 'Message'; //Translate
		$this->mail_select_all = 'Select All'; //Translate
		$this->mail_send = 'Send Mail'; //Translate
		$this->mail_sent = 'Your message has been sent to'; //Translate
	}

	function member_control()
	{
		$this->mc = 'Member Control'; //Translate
		$this->mc_confirm = 'Are you sure you want to delete'; //Translate
		$this->mc_delete = 'Delete Member'; //Translate
		$this->mc_deleted = 'Member Deleted.'; //Translate
		$this->mc_edit = 'Edit Member'; //Translate
		$this->mc_edited = 'Member Updated'; //Translate
		$this->mc_email_invaid = 'The email address you entered is invalid.'; //Translate
		$this->mc_err_updating = 'Error Updating Profile'; //Translate
		$this->mc_find = 'Find members with names containing'; //Translate
		$this->mc_found = 'The following members were found. Please select one.'; //Translate
		$this->mc_guest_needed = 'The guest account is necessary for Quicksilver Forums to function.'; //Translate
		$this->mc_not_found = 'No members were found matching'; //Translate
		$this->mc_user_aim = 'AIM Name'; //Translate
		$this->mc_user_avatar = 'Avatar'; //Translate
		$this->mc_user_avatar_height = 'Avatar Height'; //Translate
		$this->mc_user_avatar_type = 'Avatar Type'; //Translate
		$this->mc_user_avatar_width = 'Avatar Width'; //Translate
		$this->mc_user_birthday = 'Birthday'; //Translate
		$this->mc_user_email = 'Email Address'; //Translate
		$this->mc_user_email_show = 'Email Is Public'; //Translate
		$this->mc_user_group = 'Group'; //Translate
		$this->mc_user_gtalk = 'GTalk Account'; //Translate
		$this->mc_user_homepage = 'Homepage'; //Translate
		$this->mc_user_icq = 'ICQ Number'; //Translate
		$this->mc_user_id = 'User ID'; //Translate
		$this->mc_user_interests = 'Interests'; //Translate
		$this->mc_user_joined = 'Member Since'; //Translate
		$this->mc_user_language = 'Language'; //Translate
		$this->mc_user_lastpost = 'Last Post'; //Translate
		$this->mc_user_lastvisit = 'Last Visit'; //Translate
		$this->mc_user_level = 'Level'; //Translate
		$this->mc_user_location = 'Location'; //Translate
		$this->mc_user_msn = 'MSN Identity'; //Translate
		$this->mc_user_name = 'Name'; //Translate
		$this->mc_user_pm = 'Accepting Private Messages'; //Translate
		$this->mc_user_posts = 'Posts'; //Translate
		$this->mc_user_signature = 'Signature'; //Translate
		$this->mc_user_skin = 'Skin'; //Translate
		$this->mc_user_timezone = 'Time Zone'; //Translate
		$this->mc_user_title = 'Member Title'; //Translate
		$this->mc_user_title_custom = 'Use a Custom Member Title'; //Translate
		$this->mc_user_view_avatars = 'Viewing Avatars'; //Translate
		$this->mc_user_view_emoticons = 'Viewing Emoticons'; //Translate
		$this->mc_user_view_signatures = 'Viewing Signatures'; //Translate
		$this->mc_user_yahoo = 'Yahoo Identity'; //Translate
	}

	function membercount()
	{
		$this->mcount = 'Fix Member Statistics'; //Translate
		$this->mcount_updated = 'Member Count Updated.'; //Translate
	}

	function members()
	{
		$this->members_all = '���';
		$this->members_email = '����� Email';
		$this->members_email_member = '�������� Email';
		$this->members_group = '������';
		$this->members_joined = '�������������';
		$this->members_list = '������ �������������';
		$this->members_member = '������������';
		$this->members_pm = '��������� ���������';
		$this->members_posts = '���������';
		$this->members_send_pm = '������� ��������� ��������� ����� ������������';
		$this->members_title = '���������';
		$this->members_vist_www = '�������� ��������� ����� ������������';
		$this->members_www = '�������� ���������';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = '�� ������������� ������ ������� ��� ���������?';
		$this->mod_confirm_topic_delete = '�� ������������� ������ ������� ��� ����??';
		$this->mod_error_first_post = '���������� ������� ������ ��������� � ����.';
		$this->mod_error_move_category = '����� ����������� ���� � ���������.';
		$this->mod_error_move_create = '� ���� ��� ����� ���������� ���� � ���� �����.';
		$this->mod_error_move_forum = '������ ����������� ���� � �������������� �����.';
		$this->mod_error_move_global = 'You cannot move a global topic. Edit the topic before moving it.'; //Translate
		$this->mod_error_move_same = '���� ��� ��������� � ���� ������.';
		$this->mod_label_controls = '����� ����������';
		$this->mod_label_description = '��������';
		$this->mod_label_emoticon = '�������� ������ �� ��������?';
		$this->mod_label_global = '���������� ����';
		$this->mod_label_mbcode = '������������ MbCode?';
		$this->mod_label_move_to = '����������� �';
		$this->mod_label_options = '���������';
		$this->mod_label_post_delete = '������� ���������';
		$this->mod_label_post_edit = '�������� ���������';
		$this->mod_label_post_icon = 'Post Icon'; //Translate
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = '���������';
		$this->mod_label_title_original = '������������ ���������';
		$this->mod_label_title_split = '��������� ���������';
		$this->mod_label_topic_delete = '������� ����';
		$this->mod_label_topic_edit = '�������� ����';
		$this->mod_label_topic_lock = '������������� ����';
		$this->mod_label_topic_move = '����������� ����';
		$this->mod_label_topic_move_complete = '��������� ����������� ���� � ����� �����';
		$this->mod_label_topic_move_link = '����������� ���� � ����� ����� � �������� ������ �� �ţ � ������ ������.';
		$this->mod_label_topic_pin = '���������� ����';
		$this->mod_label_topic_split = '��������� ����';
		$this->mod_missing_post = '��������� ��������� �� ����������.';
		$this->mod_missing_topic = '��������� ���� �� ����������.';
		$this->mod_no_action = '�� ������� ��������.';
		$this->mod_no_post = '�� ������� ���������.';
		$this->mod_no_topic = '�� ������� ����.';
		$this->mod_perm_post_delete = '� ���� ��� ����� ������� ��� ���������.';
		$this->mod_perm_post_edit = '� ���� ��� ����� �������� ��� ���������.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = '� ���� ��� ����� ������� ��� ����.';
		$this->mod_perm_topic_edit = '� ���� ��� ����� �������� ��� ����.';
		$this->mod_perm_topic_lock = '� ���� ��� ����� ����������� ��� ����.';
		$this->mod_perm_topic_move = '� ���� ��� ����� ���������� ��� ����.';
		$this->mod_perm_topic_pin = '� ���� ��� ����� ����������� ��� ����.';
		$this->mod_perm_topic_split = '� ���� ��� ����� ��������� ��� ����.';
		$this->mod_perm_topic_unlock = '� ���� ��� ����� �������������� ��� ����.';
		$this->mod_perm_topic_unpin = '� ���� ��� ����� ���������� ��� ����.';
		$this->mod_success_post_delete = '��������� ���� ������� �������.';
		$this->mod_success_post_edit = '��������� ���� ������� ��������.';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = '���� ���� ������� ���������.';
		$this->mod_success_topic_delete = '���� ���� ������� �������.';
		$this->mod_success_topic_edit = '���� ���� ������� ��������.';
		$this->mod_success_topic_move = '���� ���� ������� ���������� � ����� �����.';
		$this->mod_success_unpublish = 'This topic has been removed from the published list.'; //Translate
	}

	function optimize()
	{
		$this->optimize = 'Optimize Database'; //Translate
		$this->optimized = 'The tables in the database have been optimized for maximum performance.'; //Translate
	}

	function perms()
	{
		$this->perm = 'Permission'; //Translate
		$this->perms = 'Permissions'; //Translate
		$this->perms_board_view = 'View the board index'; //Translate
		$this->perms_board_view_closed = 'Use Quicksilver Forums when it is closed'; //Translate
		$this->perms_do_anything = 'Use Quicksilver Forums'; //Translate
		$this->perms_edit_for = 'Edit permissions for'; //Translate
		$this->perms_email_use = 'Send emails to members via the board'; //Translate
		$this->perms_forum_view = 'View the forum'; //Translate
		$this->perms_is_admin = 'Access the admin control panel'; //Translate
		$this->perms_only_user = 'Use only group permissions for this user'; //Translate
		$this->perms_override_user = 'This will override the group permissions for this user.'; //Translate
		$this->perms_pm_noflood = 'Exempt from personal messenger flood control'; //Translate
		$this->perms_poll_create = 'Create polls'; //Translate
		$this->perms_poll_vote = 'Create votes'; //Translate
		$this->perms_post_attach = 'Attach uploads to posts'; //Translate
		$this->perms_post_attach_download = 'Download post attachments'; //Translate
		$this->perms_post_create = 'Create replies'; //Translate
		$this->perms_post_delete = 'Delete any post'; //Translate
		$this->perms_post_delete_own = 'Delete only posts the user has created'; //Translate
		$this->perms_post_edit = 'Edit any post'; //Translate
		$this->perms_post_edit_own = 'Edit only posts the user has created'; //Translate
		$this->perms_post_inc_userposts = 'Posts contribute to user\'s total post count'; //Translate
		$this->perms_post_noflood = 'Exempt from post flood control'; //Translate
		$this->perms_post_viewip = 'View user IP addresses'; //Translate
		$this->perms_search_noflood = 'Exempt from search flood control'; //Translate
		$this->perms_title = 'User Group Control'; //Translate
		$this->perms_topic_create = 'Create topics'; //Translate
		$this->perms_topic_delete = 'Delete any topic'; //Translate
		$this->perms_topic_delete_own = 'Delete only topics the user has created'; //Translate
		$this->perms_topic_edit = 'Edit any topic'; //Translate
		$this->perms_topic_edit_own = 'Edit only topics the user has created'; //Translate
		$this->perms_topic_global = 'Make a topic visible from all forums'; //Translate
		$this->perms_topic_lock = 'Lock any topic'; //Translate
		$this->perms_topic_lock_own = 'Lock topics the user has created'; //Translate
		$this->perms_topic_move = 'Move any topic'; //Translate
		$this->perms_topic_move_own = 'Move only topics the user has created'; //Translate
		$this->perms_topic_pin = 'Pin any topic'; //Translate
		$this->perms_topic_pin_own = 'Pin topics the user has created'; //Translate
		$this->perms_topic_publish = 'Publish or unpublish any topic'; //Translate
		$this->perms_topic_publish_auto = 'New topics are marked as published'; //Translate
		$this->perms_topic_split = 'Split any topic into multiple topics'; //Translate
		$this->perms_topic_split_own = 'Split only topics the user has created into multiple topics'; //Translate
		$this->perms_topic_unlock = 'Unlock any topic'; //Translate
		$this->perms_topic_unlock_mod = 'Unlock a moderator\'s lock'; //Translate
		$this->perms_topic_unlock_own = 'Unlock only topics the user has created'; //Translate
		$this->perms_topic_unpin = 'Unpin any topic'; //Translate
		$this->perms_topic_unpin_own = 'Unpin only topics the user has created'; //Translate
		$this->perms_topic_view = 'View topics'; //Translate
		$this->perms_topic_view_unpublished = 'View unpublished topics'; //Translate
		$this->perms_updated = 'Permissions have been updated.'; //Translate
		$this->perms_user_inherit = 'The user will inherit the group\'s permissions.'; //Translate
	}

	function php_info()
	{
		$this->php_error = 'Error'; //Translate
		$this->php_error_msg = 'phpinfo() can not be executed. It appears that your host has disabled this feature.'; //Translate
	}

	function pm()
	{
		$this->pm_avatar = 'Avatar'; //Translate
		$this->pm_cant_del = '� ���� ��� ����� �������� ����� ���������.';
		$this->pm_delallmsg = '������� ��� ���������';
		$this->pm_delete = '�������';
		$this->pm_delete_selected = 'Delete Selected Messages'; //Translate
		$this->pm_deleted = '��������� �������.';
		$this->pm_deleted_all = '��������� �������.';
		$this->pm_error = '�� ������� �������� ���� ��������� ��������� �����.<br /><br />��� ������������ �� ����������: %s<br /><br />��� ������������ �� ��������� ������� ���������: %s';
		$this->pm_fields = '���������� ��������� ���� ���������. �������, ��� ��� ����������� ���� ���������.';
		$this->pm_flood = 'You have sent a message in the past %s seconds, and you may not send another right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->pm_folder_inbox = '��������';
		$this->pm_folder_new = '%s �����';
		$this->pm_folder_sentbox = '������������';
		$this->pm_from = '��';
		$this->pm_group = '������';
		$this->pm_guest = '�� �� ������ ���������� ��������� ���������������������.';
		$this->pm_joined = '�������������';
		$this->pm_messenger = '���������';
		$this->pm_msgtext = '����� ���������';
		$this->pm_multiple = '����������� ��������� ����� ����� � ������� (;)';
		$this->pm_no_folder = '����� �����.';
		$this->pm_no_member = '�� ������ ������������ � ����� �������.';
		$this->pm_no_number = '�� ������� ��������� � ����� �������.';
		$this->pm_no_title = '��� ����';
		$this->pm_nomsg = '� ���� ����� ��� ���������.';
		$this->pm_noview = '� ���� ��� ���� ��������� ����� ���������.';
		$this->pm_offline = 'This member is currently offline'; //Translate
		$this->pm_online = '���� ������������ ������ online';
		$this->pm_personal = '������ ���������';
		$this->pm_personal_msging = '������ ���������';
		$this->pm_pm = '��';
		$this->pm_posts = '���������';
		$this->pm_preview = 'Preview'; //Translate
		$this->pm_recipients = '����������';
		$this->pm_reply = '��������';
		$this->pm_send = '�������';
		$this->pm_sendamsg = '������� ���������';
		$this->pm_sendingpm = '������� ���������';
		$this->pm_sendon = '�������';
		$this->pm_success = '���� ��������� ���� ������� �������.';
		$this->pm_sure_del = '�� ������������� ������ ������� ��� ���������?';
		$this->pm_sure_delall = '�� ������������� ������ ������� ��� ��������� � ���� �����?';
		$this->pm_title = '���������';
		$this->pm_to = '����';
	}

	function post()
	{
		$this->post_attach = '��������';
		$this->post_attach_add = '�������� ��������';
		$this->post_attach_disrupt = '���������� ��� �������� �������� �� ��������� ���� ���������.';
		$this->post_attach_failed = '������ �������� ��������. ��������� ���� �� ����������.';
		$this->post_attach_not_allowed = '������ ������������ �������� ����� ����.';
		$this->post_attach_remove = '������� ��������';
		$this->post_attach_too_large = '��������� ���� ������� �������. ������������ ������ - %d ��.';
		$this->post_cant_create = '�������������������� ������ ��������� ����.';
		$this->post_cant_create1 = '� ���� ��� ���� �������� ����.';
		$this->post_cant_enter = '����������� �� ���� ���������. ���� �� ��� ��������� ���, ���� � ���� ��� ����� ����������.';
		$this->post_cant_poll = '�������������������� ������ ��������� �����������.';
		$this->post_cant_poll1 = '� ���� ��� ����� ��������� �����������.';
		$this->post_cant_reply = '� ���� ��� ����� �������� � ���� ������.';
		$this->post_cant_reply1 = '�������������������� ������ �������� � ����.';
		$this->post_cant_reply2 = '� ���� ��� ����� �������� � ����.';
		$this->post_closed = '���� �������.';
		$this->post_create_poll = '������� �����������';
		$this->post_create_topic = '������� ����';
		$this->post_creating = '��������� ����';
		$this->post_creating_poll = '��������� �����������';
		$this->post_flood = '�� ������� � ������� ��������� %s ������ � �� ������ ������ ����� ������<br /><br />������� ����� ��������� ������.';
		$this->post_guest = '�����';
		$this->post_icon = '������ ���������';
		$this->post_last_five = '��������� 5 ��������� � �������� �������';
		$this->post_length = '��������� �����';
		$this->post_msg = '���������';
		$this->post_must_msg = '�� ������ ������ ���������.';
		$this->post_must_options = '�� ������ ������ ������ �����������.';
		$this->post_must_title = '��������� ���������.';
		$this->post_new_poll = '����� �����������';
		$this->post_new_topic = '����� ����';
		$this->post_no_forum = '���� ����� �� ������.';
		$this->post_no_topic = '�� ������� ����.';
		$this->post_no_vote = '�� ������ ������� �����, �� ������� ���������.';
		$this->post_option_emoticons = '������������ ����������� ������?';
		$this->post_option_global = '������� ���� ����������?';
		$this->post_option_mbcode = '������������ MbCode?';
		$this->post_optional = '�����������';
		$this->post_options = '���������';
		$this->post_poll_options = '��������� �����������';
		$this->post_poll_row = '���� �� �������';
		$this->post_posted = '����������';
		$this->post_posting = '���������';
		$this->post_preview = '��������������� ��������';
		$this->post_reply = '��������';
		$this->post_reply_topic = '�������� �� ����';
		$this->post_replying = '������� �� ����';
		$this->post_replying1 = '�������';
		$this->post_too_many_options = '������ ���� �� 2-� �� %d ������� � �����������.';
		$this->post_topic_detail = '�������� ����';
		$this->post_topic_title = '��������� ����';
		$this->post_view_topic = '���������� ��� ����';
		$this->post_voting = '�������';
	}

	function printer()
	{
		$this->printer_back = '�����';
		$this->printer_not_found = '���� �� �������. ��� ����� ���� �������, ���������� ��� ������ ������� �� ������������.';
		$this->printer_not_found_title = '���� �� �������';
		$this->printer_perm_topics = '� ���� ��� ����� �������� ����.';
		$this->printer_perm_topics_guest = '� ���� ��� ����� �������� ����. ���� �����������������, ��������, �����.';
		$this->printer_posted_on = '����������';
		$this->printer_send = '�����������';
	}

	function profile()
	{
		$this->profile_aim_sn = '��� � AIM';
		$this->profile_av_sign = '������� � �������';
		$this->profile_avatar = '�������';
		$this->profile_bday = '���� ��������';
		$this->profile_contact = '�������';
		$this->profile_email_address = '����� email';
		$this->profile_fav = '������� �����';
		$this->profile_fav_forum = '%s (%d%% ��������� ����� ������������)';
		$this->profile_gtalk = 'GTalk Account'; //Translate
		$this->profile_icq_uin = '����� ICQ';
		$this->profile_info = '����������';
		$this->profile_interest = '��������';
		$this->profile_joined = '�������������';
		$this->profile_last_post = '��������� ���������';
		$this->profile_list = '������ �������������';
		$this->profile_location = '��������������';
		$this->profile_member = '������';
		$this->profile_member_title = '���������';
		$this->profile_msn = '������������� MSN';
		$this->profile_must_user = '�� ������ ������� ������������, ��� � �������� �������.';
		$this->profile_no_member = '���� ������������ � ����� �������. ��� ������� ��� ���� ������.';
		$this->profile_none = '[ ��� ]';
		$this->profile_not_post = '��� �� �����.';
		$this->profile_offline = 'This member is currently offline'; //Translate
		$this->profile_online = '���� ������������ ������ online';
		$this->profile_pm = '��������� ���������';
		$this->profile_postcount = '%s �����, %s � ����';
		$this->profile_posts = '���������';
		$this->profile_private = '[ �������� ]';
		$this->profile_profile = '�������';
		$this->profile_signature = '�������';
		$this->profile_unkown = '[ ���������� ]';
		$this->profile_view_profile = '�������� �������';
		$this->profile_www = '�������� ��������';
		$this->profile_yahoo = '������������� Yahoo';
	}

	function prune()
	{
		$this->prune_action = 'Prune action to take'; //Translate
		$this->prune_age_day = '1 Day'; //Translate
		$this->prune_age_eighthours = '8 Hours'; //Translate
		$this->prune_age_hour = '1 Hour'; //Translate
		$this->prune_age_month = '1 Month'; //Translate
		$this->prune_age_threemonths = '3 Months'; //Translate
		$this->prune_age_week = '1 Week'; //Translate
		$this->prune_age_year = '1 Year'; //Translate
		$this->prune_forums = 'Select forums to prune'; //Translate
		$this->prune_invalidage = 'Invalid age specified for pruning'; //Translate
		$this->prune_move = 'Move'; //Translate
		$this->prune_moveto_forum = 'Forum to move to'; //Translate
		$this->prune_nodest = 'No valid destination selected'; //Translate
		$this->prune_notopics = 'No topics selected for pruning'; //Translate
		$this->prune_notopics_old = 'No topics are old enough for pruning'; //Translate
		$this->prune_novalidforum = 'No valid forums specified to prune'; //Translate
		$this->prune_select_age = 'Select age of topics to limit pruning to'; //Translate
		$this->prune_select_topics = 'Select topics to prune or use Select All'; //Translate
		$this->prune_success = 'Topics have been pruned'; //Translate
		$this->prune_title = 'Topic Pruner'; //Translate
		$this->prune_topics_older_than = 'Prune topics older than'; //Translate
	}

	function query()
	{
		$this->query = 'Query Interface'; //Translate
		$this->query_fail = 'failed.'; //Translate
		$this->query_success = 'executed successfully.'; //Translate
		$this->query_your = 'Your query'; //Translate
	}

	function recent()
	{
		$this->recent_active = 'Active topics since last visit'; //Translate
		$this->recent_by = '�������';
		$this->recent_can_post = '�� ������ �������� � ���� ������.';
		$this->recent_can_topics = '�� ������ ������ ���� � ���� ������.';
		$this->recent_cant_post = '�� �� ������ �������� � ���� ������.';
		$this->recent_cant_topics = '�� �� ������ ������ ���� � ���� ������.';
		$this->recent_dot = '�����';
		$this->recent_dot_detail = '��������, ��� �� ����� � ���� ����';
		$this->recent_forum = '�����';
		$this->recent_guest = '�����';
		$this->recent_hot = '�������';
		$this->recent_icon = '������ ���������';
		$this->recent_jump = '������� � ���������� ��������� � ����';
		$this->recent_last = '��������� ���������';
		$this->recent_locked = '�������';
		$this->recent_moved = '����������';
		$this->recent_msg = '%s Message'; //Translate
		$this->recent_new = '�����';
		$this->recent_new_poll = '������� �����������';
		$this->recent_new_topic = '������� ����� ����';
		$this->recent_no_topics = '� ���� ������ ��� ��� ��� �����������.';
		$this->recent_noexist = '��������� ����� �� ����������.';
		$this->recent_nopost = '��� ���������';
		$this->recent_not = '��';
		$this->recent_noview = '� ���� ��� ����� ������ ����� ������.';
		$this->recent_pages = '�������';
		$this->recent_pinned = '�����������';
		$this->recent_pinned_topic = '������������� ����';
		$this->recent_poll = '�����������';
		$this->recent_regfirst = '� ������������������ ������������� ��� ����� ��������� �������.';
		$this->recent_replies = '�������';
		$this->recent_starter = '�����';
		$this->recent_sub = '��������';
		$this->recent_sub_last_post = '��������� ���������';
		$this->recent_sub_replies = '�������';
		$this->recent_sub_topics = '���';
		$this->recent_subscribe = '��������� �� e-mail �� ������� � ���� ������';
		$this->recent_topic = '����';
		$this->recent_views = '����������';
		$this->recent_write_topics = '�� ������ ��������� ���� � ���� ������.';
	}

	function register()
	{
		$this->register_activated = '���� ������� ��� ����������!';
		$this->register_activating = '��������� ��������';
		$this->register_activation_error = '��������� ������ ��� ��������� ��������. �������, �������� �� ������� ������ ����� �� �������������� ������. ���� �������� �� �������, ������� � ��������������� ��� ������������ ������.';
		$this->register_confirm_passwd = '��������� ������';
		$this->register_done = '�� ��� ���������������. ������ �� ������ �����.';
		$this->register_email = '����� email';
		$this->register_email_invalid = '��������� ����� email �������.';
		$this->register_email_msg = 'This is an automated email generated by Quicksilver Forums, and sent to you in order'; //Translate
		$this->register_email_msg2 = 'for you to activate your account with'; //Translate
		$this->register_email_msg3 = 'Please click the following link, or paste it in to your web browser:'; //Translate
		$this->register_email_used = '��������� ����� email ��� ������������ ����� �� �������������.';
		$this->register_fields = '�� ��� ���� ���������.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = '����������, ������� �����, ������������ �� ��������.';
		$this->register_image_invalid = '����� ��������, ��� �� �������, � �� ������� �����, ����� �����, ������������ �� ��������.';
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = '�� �����������������. �� ����� %s ��� ������ email � ������������ �� ����������� ������ ��������. ����� ������� ������ ���������� �������������� �������.';
		$this->register_name_invalid = '������� ������� ���.';
		$this->register_name_taken = '����� ��� ��� ������.';
		$this->register_new_user = '�������� ���';
		$this->register_pass_invalid = '��������� ������ �������. ������ ������ ��������� ������ ���������� �������, ����� ��� �����, �����, ����, ������������� ��� ������, � ���� �� ����� 5 ��������.';
		$this->register_pass_match = '������ �� ���������.';
		$this->register_passwd = '������';
		$this->register_reg = '�����������';
		$this->register_reging = '��������������';
		$this->register_requested = 'Account activation request for:'; //Translate
		$this->register_tos = 'Terms of Service'; //Translate
		$this->register_tos_i_agree = 'I agree to the above terms'; //Translate
		$this->register_tos_not_agree = 'You did not agree to the terms.'; //Translate
		$this->register_tos_read = 'Please read the following terms of service'; //Translate
	}

	function rssfeed()
	{
		$this->rssfeed_cannot_find_forum = 'The forum does not appear to exist'; //Translate
		$this->rssfeed_cannot_find_topic = 'The topic does nto appear to exist'; //Translate
		$this->rssfeed_cannot_read_forum = 'You do not have permission to read this forum'; //Translate
		$this->rssfeed_cannot_read_topic = 'You do not have permission to read this topic'; //Translate
		$this->rssfeed_error = 'Error'; //Translate
		$this->rssfeed_forum = 'Forum:'; //Translate
		$this->rssfeed_posted_by = 'Posted by'; //Translate
		$this->rssfeed_topic = 'Topic:'; //Translate
	}

	function search()
	{
		$this->search_advanced = '�������������� ���������';
		$this->search_avatar = 'Avatar'; //Translate
		$this->search_basic = '������� �����';
		$this->search_characters = '�������� ���������';
		$this->search_day = '����';
		$this->search_days = '����';
		$this->search_exact_name = '������ ���';
		$this->search_flood = 'You have searched in the past %s seconds, and you may not search right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->search_for = '������';
		$this->search_forum = '�����';
		$this->search_group = '������';
		$this->search_guest = '�����';
		$this->search_in = '������ �';
		$this->search_in_posts = '������ ������ � ����������';
		$this->search_ip = 'IP-�����';
		$this->search_joined = '�������������';
		$this->search_level = '������� ������������';
		$this->search_match = '������ ����������';
		$this->search_matches = '����������';
		$this->search_month = '�����';
		$this->search_months = '�������';
		$this->search_mysqldoc = '������������ �� MySQL';
		$this->search_newer = '�����';
		$this->search_no_results = '�� ������ ������� ������ �� �������.';
		$this->search_no_words = '�� ������ ������ ������� ������.<br /><br />������ ������� ������ ���� ������� 3-� ��������, ������� �����, �����, ��������� � �������������.';
		$this->search_offline = 'This member is currently offline'; //Translate
		$this->search_older = '������';
		$this->search_online = '���� ������������ ������ online';
		$this->search_only_display = '���������� ������';
		$this->search_partial_name = '�������� �����';
		$this->search_post_icon = '������ ���������';
		$this->search_posted_on = '����������';
		$this->search_posts = '���������';
		$this->search_posts_by = '������ � ����������';
		$this->search_regex = '������ � ������� ���������� ���������';
		$this->search_regex_failed = '������ � ���������� ����������. �������� ������������ �� MySQL � ���������� ����������.';
		$this->search_relevance = '������������� ���������: %d%%';
		$this->search_replies = '���������';
		$this->search_result = '���������� ������';
		$this->search_search = '������';
		$this->search_select_all = '�������� �ӣ';
		$this->search_show_posts = '���������� ���������� ���������';
		$this->search_sound = '������ ���������';
		$this->search_starter = '�����';
		$this->search_than = '���';
		$this->search_topic = '����';
		$this->search_unreg = '��������������������';
		$this->search_week = '������';
		$this->search_weeks = '������';
		$this->search_year = '���';
	}

	function settings()
	{
		$this->settings = 'Settings'; //Translate
		$this->settings_active = 'Active Users Settings'; //Translate
		$this->settings_allow = 'Allow'; //Translate
		$this->settings_antibot = 'Anti-Robot Registration'; //Translate
		$this->settings_attach_ext = 'Attachments - File Extensions'; //Translate
		$this->settings_attach_one_per = 'One per line. No periods.'; //Translate
		$this->settings_avatar = 'Avatar Settings'; //Translate
		$this->settings_avatar_flash = 'Flash Avatars'; //Translate
		$this->settings_avatar_max_height = 'Maximum Avatar Height'; //Translate
		$this->settings_avatar_max_width = 'Maximum Avatar Width'; //Translate
		$this->settings_avatar_upload = 'Uploaded Avatars - Max File Size'; //Translate
		$this->settings_basic = 'Edit Board Settings'; //Translate
		$this->settings_blank = 'Use <i>_blank</i> for a new window.'; //Translate
		$this->settings_board_enabled = 'Board Enabled'; //Translate
		$this->settings_board_location = 'Location of Board'; //Translate
		$this->settings_board_name = 'Board Name'; //Translate
		$this->settings_board_rss = 'RSS Feed Settings'; //Translate
		$this->settings_board_rssfeed_desc = 'RSS Feed Description'; //Translate
		$this->settings_board_rssfeed_posts = 'Number of posts to list on RSS Feed'; //Translate
		$this->settings_board_rssfeed_time = 'Refresh time in minutes'; //Translate
		$this->settings_board_rssfeed_title = 'RSS Feed Title'; //Translate
		$this->settings_clickable = 'Clickable Smilies Per Row'; //Translate
		$this->settings_cookie = 'Cookie and Flood Settings'; //Translate
		$this->settings_cookie_path = 'Cookie Path'; //Translate
		$this->settings_cookie_prefix = 'Cookie Prefix'; //Translate
		$this->settings_cookie_time = 'Time to Remain Logged In'; //Translate
		$this->settings_db = 'Edit Connection Settings'; //Translate
		$this->settings_db_host = 'Database Host'; //Translate
		$this->settings_db_leave_blank = 'Leave blank for none.'; //Translate
		$this->settings_db_multiple = 'For installing multiple boards on one database.'; //Translate
		$this->settings_db_name = 'Database Name'; //Translate
		$this->settings_db_password = 'Database Password'; //Translate
		$this->settings_db_port = 'Database Port'; //Translate
		$this->settings_db_prefix = 'Table Prefix'; //Translate
		$this->settings_db_socket = 'Database Socket'; //Translate
		$this->settings_db_username = 'Database Username'; //Translate
		$this->settings_debug_mode = 'Debug Mode'; //Translate
		$this->settings_default_lang = 'Default Language'; //Translate
		$this->settings_default_no = 'Default No'; //Translate
		$this->settings_default_skin = 'Default Skin'; //Translate
		$this->settings_default_yes = 'Default Yes'; //Translate
		$this->settings_disabled = 'Disabled'; //Translate
		$this->settings_disabled_notice = 'Disabled Notice'; //Translate
		$this->settings_email = 'E-Mail Settings'; //Translate
		$this->settings_email_fake = 'For display only. Should not be a real e-mail address.'; //Translate
		$this->settings_email_from = 'E-mail From Address'; //Translate
		$this->settings_email_place1 = 'Place members in the'; //Translate
		$this->settings_email_place2 = 'group until they verify their e-mail'; //Translate
		$this->settings_email_place3 = 'Do not require e-mail activation'; //Translate
		$this->settings_email_real = 'Should be a real e-mail address.'; //Translate
		$this->settings_email_reply = 'E-mail Reply-To Address'; //Translate
		$this->settings_email_smtp = 'SMTP Mail Server'; //Translate
		$this->settings_email_valid = 'New Member E-mail Validation'; //Translate
		$this->settings_enabled = 'Enabled'; //Translate
		$this->settings_enabled_modules = 'Enabled Modules'; //Translate
		$this->settings_foreign_link = 'Foreign Link Target'; //Translate
		$this->settings_general = 'General Settings'; //Translate
		$this->settings_group_after = 'Group After Registration'; //Translate
		$this->settings_hot_topic = 'Posts for a Hot Topic'; //Translate
		$this->settings_kilobytes = 'Kilobytes'; //Translate
		$this->settings_max_attach_size = 'Attachments - Maximum File Size'; //Translate
		$this->settings_members = 'Member Settings'; //Translate
		$this->settings_modname_only = 'Module name only. Do not include .php'; //Translate
		$this->settings_new = 'New Setting'; //Translate
		$this->settings_new_add = 'Add Board Setting';
		$this->settings_new_added = 'New settings added.'; //Translate
		$this->settings_new_exists = 'That setting already exists. Choose another name for it.'; //Translate
		$this->settings_new_name = 'New setting name'; //Translate
		$this->settings_new_required = 'The new setting name is required.'; //Translate
		$this->settings_new_value = 'New setting value'; //Translate
		$this->settings_no_allow = 'Do Not Allow'; //Translate
		$this->settings_nodata = 'No data was sent from POST'; //Translate
		$this->settings_one_per = 'One per line'; //Translate
		$this->settings_pixels = 'Pixels'; //Translate
		$this->settings_pm_flood = 'Personal Messenger Flood Control'; //Translate
		$this->settings_pm_min_time = 'Minimum time between messages.'; //Translate
		$this->settings_polls = 'Polls'; //Translate
		$this->settings_polls_no = 'Users cannot vote in a poll after viewing its results'; //Translate
		$this->settings_polls_yes = 'Users can vote in a poll after viewing its results'; //Translate
		$this->settings_post_flood = 'Post Flood Control'; //Translate
		$this->settings_post_min_time = 'Minimum time between posts.'; //Translate
		$this->settings_posts_topic = 'Posts Per Topic Page'; //Translate
		$this->settings_search_flood = 'Search Flood Control'; //Translate
		$this->settings_search_min_time = 'Minimum time between searches.'; //Translate
		$this->settings_server = 'Server Settings'; //Translate
		$this->settings_server_gzip = 'GZIP Compression'; //Translate
		$this->settings_server_gzip_msg = 'Improves speed. Disable if the board appears jumbled or blank.'; //Translate
		$this->settings_server_maxload = 'Maximum Server Load'; //Translate
		$this->settings_server_maxload_msg = 'Disables board under excessive server strain. Enter 0 to disable.'; //Translate
		$this->settings_server_timezone = 'Server Time Zone'; //Translate
		$this->settings_show_avatars = 'Show Avatars'; //Translate
		$this->settings_show_email = 'Show Email Address'; //Translate
		$this->settings_show_emotes = 'Show Emoticons'; //Translate
		$this->settings_show_notice = 'Shown when the board is disabled'; //Translate
		$this->settings_show_pm = 'Accept Personal Messages'; //Translate
		$this->settings_show_sigs = 'Show Signatures'; //Translate
		$this->settings_spider_agent = 'Spider User Agent'; //Translate
		$this->settings_spider_agent_msg = 'Enter all or part of the spider\'s unique HTTP USER AGENT.'; //Translate
		$this->settings_spider_enable = 'Enable Spider Display'; //Translate
		$this->settings_spider_enable_msg = 'Enable the names of search engine spiders on Active List.'; //Translate
		$this->settings_spider_name = 'Spider Name'; //Translate
		$this->settings_spider_name_msg = 'Enter the name that you wish to display for each of the above spiders on Active List. You need to place the spider\'s name on the same line as the spider\'s user agent above. For example, if you place \'googlebot\' on the third line for the user agent place \'Google\' on the third line for the Spider Name.'; //Translate
		$this->settings_timezone = 'Time Zone'; //Translate
		$this->settings_topics_page = 'Topics Per Forum Page'; //Translate
		$this->settings_tos = 'Terms of Service'; //Translate
		$this->settings_updated = 'Settings have been updated.'; //Translate
	}

	function stats()
	{
		$this->stats = 'Statistics Center'; //Translate
		$this->stats_post_by_month = 'Posts by Month'; //Translate
		$this->stats_reg_by_month = 'Registrations by Month'; //Translate
	}

	function templates()
	{
		$this->add = 'Add HTML Templates'; //Translate
		$this->add_in = 'Add template to:'; //Translate
		$this->all_fields_required = 'All fields are required to add a template'; //Translate
		$this->choose_css = 'Choose CSS Template'; //Translate
		$this->choose_set = 'Choose a template set'; //Translate
		$this->choose_skin = 'Choose a skin'; //Translate
		$this->confirm1 = 'You are about to delete the'; //Translate
		$this->confirm2 = 'template from'; //Translate
		$this->create_new = 'Create a new skin named'; //Translate
		$this->create_skin = 'Create Skin'; //Translate
		$this->credit = 'Please do not remove our only credit!'; //Translate
		$this->css_edited = 'CSS file has been updated.'; //Translate
		$this->css_fioerr = 'The file could not be written to, you will need to CHMOD the file manually.'; //Translate
		$this->delete_template = 'Delete Template'; //Translate
		$this->directory = 'Directory'; //Translate
		$this->display_name = 'Display Name'; //Translate
		$this->edit_css = 'Edit CSS'; //Translate
		$this->edit_skin = 'Edit Skin'; //Translate
		$this->edit_templates = 'Edit Templates'; //Translate
		$this->export_done = 'Skin exported to the main Quicksilver Forums directory.';
		$this->export_select = 'Select a skin to export'; //Translate
		$this->export_skin = 'Export Skin'; //Translate
		$this->install_done = 'The skin has been installed successfully.'; //Translate
		$this->install_exists1 = 'It appears that the skin'; //Translate
		$this->install_exists2 = 'is already installed.'; //Translate
		$this->install_overwrite = 'Overwrite'; //Translate
		$this->install_skin = 'Install Skin'; //Translate
		$this->menu_title = 'Select a template section to edit'; //Translate
		$this->no_file = 'No such file.'; //Translate
		$this->only_skin = 'There is only one skin installed. You may not delete this skin.'; //Translate
		$this->or_new = 'Or create new template set named:'; //Translate
		$this->select_skin = 'Select a Skin'; //Translate
		$this->select_skin_edit = 'Select a skin to edit'; //Translate
		$this->select_skin_edit_done = 'Skin successfully edited.'; //Translate
		$this->select_template = 'Select Template'; //Translate
		$this->skin_chmod = 'A new directory could not be created for the skin. Try to CHMOD the skins directory to 775.'; //Translate
		$this->skin_created = 'Skin created.'; //Translate
		$this->skin_deleted = 'Skin successfully deleted.'; //Translate
		$this->skin_dir_name = 'You must enter a skin name and directory name.'; //Translate
		$this->skin_dup = 'A skin with a duplicate directory name was found. The skin\'s directory was changed to'; //Translate
		$this->skin_name = 'You must enter a skin name.'; //Translate
		$this->skin_none = 'There are no skins available to install.'; //Translate
		$this->skin_set = 'Skin Set'; //Translate
		$this->skins_found = 'The following skins were found in the Quicksilver Forums directory';
		$this->template_about = 'About Variables'; //Translate
		$this->template_about2 = 'Variables are pieces of text that are replaced with dynamic data. Variables always begin with a dollar sign, and are sometimes enclosed in {braces}.'; //Translate
		$this->template_add = 'Add'; //Translate
		$this->template_added = 'Template added.'; //Translate
		$this->template_clear = 'Clear'; //Translate
		$this->template_confirm = 'You have made changes to the templates. Do you want to save your changes?'; //Translate
		$this->template_description = 'Template Description'; //Translate
		$this->template_html = 'Template HTML'; //Translate
		$this->template_name = 'Template Name'; //Translate
		$this->template_position = 'Template Position'; //Translate
		$this->template_set = 'Template Set'; //Translate
		$this->template_title = 'Template Title'; //Translate
		$this->template_universal = 'Universal Variable'; //Translate
		$this->template_universal2 = 'Some variables can be used in any template, while others can only be used in a single template. Properties of the object $this can be used anywhere.'; //Translate
		$this->template_updated = 'Template updated.'; //Translate
		$this->templates = 'Templates'; //Translate
		$this->temps_active = 'Active Users Detail'; //Translate
		$this->temps_admin = '<b>AdminCP Universal</b>'; //Translate
		$this->temps_ban = 'AdminCP Bans'; //Translate
		$this->temps_board_index = 'Board Index'; //Translate
		$this->temps_censoring = 'AdminCP Word Censoring'; //Translate
		$this->temps_cp = 'Member Control Panel'; //Translate
		$this->temps_email = 'Email A Member'; //Translate
		$this->temps_emot_control = 'AdminCP Emoticons'; //Translate
		$this->temps_forum = 'Forums'; //Translate
		$this->temps_forums = 'AdminCP Forums'; //Translate
		$this->temps_groups = 'AdminCP Groups'; //Translate
		$this->temps_help = 'Help'; //Translate
		$this->temps_login = 'Logging In/Out'; //Translate
		$this->temps_logs = 'AdminCP Moderator Logs'; //Translate
		$this->temps_main = '<b>Board Universal</b>'; //Translate
		$this->temps_mass_mail = 'AdminCP Mass Mail'; //Translate
		$this->temps_member_control = 'AdminCP Member Control'; //Translate
		$this->temps_members = 'Member List'; //Translate
		$this->temps_mod = 'Moderator Controls'; //Translate
		$this->temps_pm = 'Private Messenger'; //Translate
		$this->temps_polls = 'Polls'; //Translate
		$this->temps_post = 'Posting'; //Translate
		$this->temps_printer = 'Printer-Friendly Topics'; //Translate
		$this->temps_profile = 'Profile Viewing'; //Translate
		$this->temps_recent = 'Recent Topics'; //Translate
		$this->temps_register = 'Registration'; //Translate
		$this->temps_rssfeed = 'RSS Feed'; //Translate
		$this->temps_search = 'Searching'; //Translate
		$this->temps_settings = 'AdminCP Settings'; //Translate
		$this->temps_templates = 'AdminCP Template Editor'; //Translate
		$this->temps_titles = 'AdminCP Member Titles'; //Translate
		$this->temps_topic_prune = 'AdminCP Topic Pruning'; //Translate
		$this->temps_topics = 'Topics'; //Translate
		$this->upgrade_skin = 'Upgrade Skin'; //Translate
		$this->upgrade_skin_already = 'was already upgraded. Nothing to do.'; //Translate
		$this->upgrade_skin_detail = 'Skins upgraded using this method will still require template editing afterwards.<br />Select a skin to upgrade'; //Translate
		$this->upgrade_skin_upgraded = 'skin has been upgraded.'; //Translate
		$this->upgraded_templates = 'The following templates were added or upgraded'; //Translate
	}

	function titles()
	{
		$this->titles_add = 'Add Member Titles'; //Translate
		$this->titles_added = 'Member Title added.'; //Translate
		$this->titles_control = 'Member Title Control'; //Translate
		$this->titles_edit = 'Edit Member Titles'; //Translate
		$this->titles_error = 'No title text or minimum posts was given'; //Translate
		$this->titles_image = 'Image'; //Translate
		$this->titles_minpost = 'Minimum Posts'; //Translate
		$this->titles_nodel_default = 'Removal of the default title has been disabled as it will break your board, please edit it instead.'; //Translate
		$this->titles_title = 'Title'; //Translate
	}

	function topic()
	{
		$this->topic_attached = '��������� ����:';
		$this->topic_attached_downloads = '��� �������';
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = '� ���� ��� ���� ��������� ���� ����.';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = '��������� ����';
		$this->topic_avatar = '�������';
		$this->topic_bottom = 'Go to the bottom of the page'; //Translate
		$this->topic_create_poll = '����� �����������';
		$this->topic_create_topic = '����� ����';
		$this->topic_delete = '�������';
		$this->topic_delete_post = '������� ��� ���������';
		$this->topic_edit = '��������';
		$this->topic_edit_post = '�������� ��� ���������';
		$this->topic_edited = '��������� ��� ��������������� %s, ������������  %s';
		$this->topic_error = '������';
		$this->topic_group = '������';
		$this->topic_guest = '�����';
		$this->topic_ip = 'IP-�����';
		$this->topic_joined = '�������������';
		$this->topic_level = '������� ������������';
		$this->topic_links_aim = '������� AIM-��������� %s';
		$this->topic_links_email = '������� email %s';
		$this->topic_links_gtalk = 'Send a GTalk message to %s'; //Translate
		$this->topic_links_icq = '������� ICQ-��������� %s';
		$this->topic_links_msn = '���������� MSN-������� %s';
		$this->topic_links_pm = '������� ��������� ��������� %s';
		$this->topic_links_web = '�������� �������� ��������� %s';
		$this->topic_links_yahoo = '������� Yahoo-��������� %s';
		$this->topic_lock = '�������������';
		$this->topic_locked = '���� �������������';
		$this->topic_move = '�����������';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = 'Newer Topic'; //Translate
		$this->topic_no_newer = 'There is no newer topic.'; //Translate
		$this->topic_no_older = 'There is no older topic.'; //Translate
		$this->topic_no_votes = '����� �� ���������.';
		$this->topic_not_found = '���� �� �������';
		$this->topic_not_found_message = '���� �� �������. � ����� ������� ��� �����������. ��������, ��� ������� � �� ������������.';
		$this->topic_offline = 'This member is currently offline'; //Translate
		$this->topic_older = 'Older Topic'; //Translate
		$this->topic_online = '���� ������������ ������ online';
		$this->topic_options = '��������� ����';
		$this->topic_pages = '��������';
		$this->topic_perm_view = '� ���� ��� ����� �������� ����.';
		$this->topic_perm_view_guest = '� ���� ��� ����� �������� ����. ���� �����������������, �������� � �����';
		$this->topic_pin = '����������';
		$this->topic_posted = '����������';
		$this->topic_posts = '���������';
		$this->topic_print = '������ ��� ������';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'Emoticons'; //Translate
		$this->topic_qr_open_emoticons = 'Open Clickable Emoticons'; //Translate
		$this->topic_qr_open_mbcode = 'Open MBCode'; //Translate
		$this->topic_quickreply = 'Quick Reply'; //Translate
		$this->topic_quote = '�������� � ��������������';
		$this->topic_reply = '��������';
		$this->topic_split = '���������';
		$this->topic_split_finish = '��������� ��� ����������';
		$this->topic_split_keep = '�� ���������� ��� ���������';
		$this->topic_split_move = '����������� ��� ���������';
		$this->topic_subscribe = '��������� ���� �� e-mail ��� ������� � ���� ����';
		$this->topic_top = '����� ';
		$this->topic_unlock = '��������������';
		$this->topic_unpin = '���������';
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = '�� ���������������';
		$this->topic_view = '���������� ����������';
		$this->topic_viewing = '�������� ����';
		$this->topic_vote = '�����';
		$this->topic_vote_count_plur = '%d �������';
		$this->topic_vote_count_sing = '%d �����';
		$this->topic_votes = '�����(-��)';
	}

	function universal()
	{
		$this->aim = 'AIM'; //Translate
		$this->based_on = 'based on';
		$this->board_by = '�������';
		$this->charset = 'koi8-r';
		$this->continue = 'Continue'; //Translate
		$this->date_long = 'M j, Y'; //Translate
		$this->date_short = 'n/j/y'; //Translate
		$this->delete = 'Delete'; //Translate
		$this->direction = 'ltr'; //Translate
		$this->edit = 'Edit'; //Translate
		$this->email = 'Email'; //Translate
		$this->gtalk = 'GT'; //Translate
		$this->icq = 'ICQ'; //Translate
		$this->msn = 'MSN'; //Translate
		$this->new_message = 'New Message'; //Translate
		$this->new_poll = 'New Poll'; //Translate
		$this->new_topic = 'New Topic'; //Translate
		$this->no = 'No'; //Translate
		$this->powered = 'Powered by'; //Translate
		$this->private_message = 'PM'; //Translate
		$this->quote = 'Quote'; //Translate
		$this->recount_forums = 'Recounted forums! Total topics: %d. Total posts: %d.'; //Translate
		$this->reply = 'Reply'; //Translate
		$this->seconds = 'Seconds'; //Translate
		$this->select_all = 'Select All'; //Translate
		$this->sep_decimals = ',';
		$this->sep_thousands = '.';
		$this->spoiler = 'Spoiler'; //Translate
		$this->submit = '���������';
		$this->subscribe = 'Subscribe'; //Translate
		$this->time_long = ', g:i a'; //Translate
		$this->time_only = 'g:i a'; //Translate
		$this->today = '�������';
		$this->website = 'WWW'; //Translate
		$this->yahoo = 'Yahoo'; //Translate
		$this->yes = 'Yes'; //Translate
		$this->yesterday = '�����';
	}
}
?>
