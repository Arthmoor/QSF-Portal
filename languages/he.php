<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2007 The QSF Portal Development Team
 * http://www.qsfportal.com/
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2006 The Quicksilver Forums Development Team
 * http://www.quicksilverforums.com/
 * 
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 * http://www.mercuryboard.com/
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
 * Hebrew language module
 *
 * @author ��� �
 * @since 1.1.0
 **/
class he
{
	function active()
	{
		$this->active_last_action = '������ ������';
		$this->active_modules_active = '���� ������ ������� ������';
		$this->active_modules_board = '������� ��������';
		$this->active_modules_cp = '����� ���� ���� ����';
		$this->active_modules_file_rating = 'Rating a file'; //Translate
		$this->active_modules_files = 'Browsing files'; //Translate
		$this->active_modules_forum = '%s :���� �� ������';
		$this->active_modules_help = '����� �����';
		$this->active_modules_login = '�����\�����';
		$this->active_modules_members = '���� ������ ���� ������';
		$this->active_modules_mod = '���� �������';
		$this->active_modules_pages = 'Viewing a custom page'; //Translate
		$this->active_modules_pm = '����� �����\'� ����';
		$this->active_modules_post = '����� �����';
		$this->active_modules_profile = '%s :���� �� �������';
		$this->active_modules_recent = '���� �� ������� ��������';
		$this->active_modules_search = '����';
		$this->active_modules_topic = '%s :���� �� ������';
		$this->active_time = '���';
		$this->active_user = '�����';
		$this->active_users = '������� ������';
	}

	function admin()
	{
		$this->admin_add_emoticons = '����� ���� ����';
		$this->admin_add_member_titles = '����� ����� ��� ��������';
		$this->admin_add_templates = 'HTML ����� ������';
		$this->admin_ban_ips = 'IP ����� ������';
		$this->admin_censor = '����� ��������';
		$this->admin_cp_denied = '����� �����';
		$this->admin_cp_warning = '���� ���� ����� ����� ����� �����. <b>������<b> ��� ���� ����� ���� ������ �� ����� ������';
		$this->admin_create_forum = '����� �����';
		$this->admin_create_group = '����� �����';
		$this->admin_create_help = '����� ���� ����';
		$this->admin_create_skin = '����� ����';
		$this->admin_db = '��� ������';
		$this->admin_db_backup = '���� ��� ������';
		$this->admin_db_conn = '����� ������ �������';
		$this->admin_db_optimize = '����� ��� �������';
		$this->admin_db_query = 'SQL ����� ������';
		$this->admin_db_restore = '������ ������';
		$this->admin_delete_forum = '����� �����';
		$this->admin_delete_group = '����� �����';
		$this->admin_delete_help = '����� ���� ����';
		$this->admin_delete_member = '����� ���';
		$this->admin_delete_template = 'HTML ����� �����';
		$this->admin_edit_emoticons = '����� �� ����� ���� ����';
		$this->admin_edit_forum = '����� �����';
		$this->admin_edit_group_file_perms = 'Edit a group\'s file permissions'; //Translate
		$this->admin_edit_group_name = '����� �� �����/��';
		$this->admin_edit_group_perms = '����� ������ �����/��';
		$this->admin_edit_help = '����� ���� ����';
		$this->admin_edit_member = '����� ���';
		$this->admin_edit_member_file_perms = 'Edit a member\'s file permissions'; //Translate
		$this->admin_edit_member_perms = '����� ������ ���/��';
		$this->admin_edit_member_titles = '����� �� ����� ����� ��� ��������';
		$this->admin_edit_settings = '����� ������ ���';
		$this->admin_edit_skin = '���� ����� �� �����';
		$this->admin_edit_templates = 'HTML ����� ������';
		$this->admin_emoticons = '���� ����';
		$this->admin_export_skin = '����� ����';
		$this->admin_fix_stats = '��� ���������� ���';
		$this->admin_forum_order = '����� ��� �������';
		$this->admin_forums = '������� ���������';
		$this->admin_groups = '������';
		$this->admin_heading = 'Quicksilver ��� ����� �� ���� �������� ��';
		$this->admin_help = '����� ����';
		$this->admin_install_emoticons = '����� ���� ����';
		$this->admin_install_skin = '���� �����';
		$this->admin_logs = '����� ������ ����';
		$this->admin_mass_mail = '����� ������ ������';
		$this->admin_members = '�����';
		$this->admin_phpinfo = 'PHP ����� ����';
		$this->admin_prune = '����� ������ �����';
		$this->admin_recount_forums = '����� ������ �������';
		$this->admin_settings = '������';
		$this->admin_settings_add = 'Add new board setting'; //Translate
		$this->admin_skins = '������';
		$this->admin_stats = '���� �����������';
		$this->admin_upgrade_skin = '���� ������';
		$this->admin_your_board = '������ ���';
	}

	function backup()
	{
		$this->backup = 'Backup'; //Translate
		$this->backup_add = 'Add'; //Translate
		$this->backup_add_complete = 'Add complete'; //Translate
		$this->backup_create = '����� ��� ������';
		$this->backup_created = 'Backup successfully created in'; //Translate
		$this->backup_createfile = 'Backup and create a file on server'; //Translate
		$this->backup_done = '.Quicksilver ��� ������� ���� ������� ������ �� �������� ��';
		$this->backup_download = 'Backup and download (recommended)'; //Translate
		$this->backup_failed = 'Failed to create backup.'; //Translate
		$this->backup_found = '.Quicksilver �������� ����� ����� ������� �������� ��';
		$this->backup_import_fail = 'Failed to import backup.'; //Translate
		$this->backup_invalid = '.��� ������ ���� �����. �� ���� ������� ���� �������';
		$this->backup_no_packages = 'Failed to locate packages directory.'; //Translate
		$this->backup_noexist = 'Sorry, that backup does not exist.'; //Translate
		$this->backup_none = '.Quicksilver �� ����� ������� ������� �������� ��';
		$this->backup_options = 'Select how you want your backup created';
		$this->backup_output = 'Output'; //Translate
		$this->backup_restore = '���� �����';
		$this->backup_restore_done = '.��� ������� ����� ������';
		$this->backup_statements = 'statements'; //Translate
		$this->backup_uncheck = 'Unchecking this will NOT empty the database tables before restoring the backup!'; //Translate
		$this->backup_warning = '<b>Warning:</b> This will overwrite all existing data used by QSF Portal.'; //Translate
	}

	function ban()
	{
		$this->ban = '����';
		$this->ban_banned_ips = '������ IP ������';
		$this->ban_banned_members = '����� ������';
		$this->ban_ip = '������ IP ������';
		$this->ban_member_explain1 = '������ �������, ��� �� ����� �������� ���� �';
		$this->ban_member_explain2 = '.���� ���� ��������';
		$this->ban_members = '����� ������';
		$this->ban_nomembers = '��� ���� ����� ������.';
		$this->ban_one_per_line = '.����� ��� ��� ����';
		$this->ban_regex_allowed = '������� ������ ������. �������� ������ � * ����� ��� ���� ����� ��� �� ����.';
		$this->ban_settings = '������ �����';
		$this->ban_users_banned = '.������� ������';
	}

	function bbcode()
	{
		$this->bbcode_arial = 'Arial'; //Translate
		$this->bbcode_blue = 'Blue'; //Translate
		$this->bbcode_bold = 'Bold (CTRL-b)'; //Translate
		$this->bbcode_bold1 = 'B'; //Translate
		$this->bbcode_brightcove = 'Brightcove Video'; //Translate
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
		$this->bbcode_google = 'Google Video'; //Translate
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
		$this->bbcode_youtube = 'Youtube Video'; //Translate
	}

	function board()
	{
		$this->board_active_users = '������� ������';
		$this->board_birthdays = '��� ����� ����:';
		$this->board_bottom_page = '���� ������ �����';
		$this->board_can_post = '��� ���� ����� ������ ���.';
		$this->board_can_topics = '��� ���� ����� ������ �� �� ����� ������ �����.';
		$this->board_cant_post = '���� ���� ����� ������ ���';
		$this->board_cant_topics = '���� ����� ����� �� ����� ������ ������ ���.';
		$this->board_forum = '�����';
		$this->board_forum_url = 'URL Redirect:'; //Translate
		$this->board_guests = '������';
		$this->board_last_post = '����� ������';
		$this->board_mark = '��� �� ������� ������';
		$this->board_mark1 = '�� ������� ������� ����� ������.';
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = '�������';
		$this->board_message = '%s �����';
		$this->board_most_online = '%s � %d ���� �������� ������ ���� ����� ���';
		$this->board_nobday = '��� ��� ����� ����.';
		$this->board_nobody = '��� ���� ����� �������.';
		$this->board_nopost = '��� ������';
		$this->board_noview = '��� �� ������ ����� �����.';
		$this->board_regfirst = '��� �� ������ ����� �����. �� ��� ����, ��� ���� ����� �����.';
		$this->board_replies = '������';
		$this->board_stats = '����������';
		$this->board_stats_string = '������. %s ������ ��"� %s ������ � %s ���� <b /> .%s ������� �����.���� ��� ����� ���  %s';
		$this->board_top_page = '���� ���� �����';
		$this->board_topics = '������';
		$this->board_unread = 'Jump to oldest unread post'; //Translate
		$this->board_users = '�������';
		$this->board_write_topics = '���� ���� ����� ������ ������ ���.';
	}

	function censoring()
	{
		$this->censor = '����� ��������';
		$this->censor_one_per_line = '��� ��� ����.';
		$this->censor_regex_allowed = '������� ������ ������. �������� ������ � * ����� ��� ���� ��� ��� �� ����.';
		$this->censor_updated = '.����� ������ ������';
	}

	function cp()
	{
		$this->cp_aim = '�� ����� �� AIM';
		$this->cp_already_member = '���� �������� ����� ��� ������ �� ��� ����� ���.';
		$this->cp_apr = '�����';
		$this->cp_aug = '������';
		$this->cp_avatar_current = '������ ���';
		$this->cp_avatar_error = '����� �������';
		$this->cp_avatar_must_select = '��� ���� ����� ������.';
		$this->cp_avatar_none = '��� ����� �������';
		$this->cp_avatar_pixels = '�������';
		$this->cp_avatar_select = '��� ������';
		$this->cp_avatar_size_height = '���� ������� ��� ���� ����� ����� 1 �';
		$this->cp_avatar_size_width = '���� ������� ��� ���� ����� ����� 1 �';
		$this->cp_avatar_upload = '���� ������ ����� ���';
		$this->cp_avatar_upload_failed = '���� �� ������ �����. ����� �� ����.';
		$this->cp_avatar_upload_not_image = '��� ���� ���� �� ������ ������� ��� �������.';
		$this->cp_avatar_upload_too_large = '������ ���� ���� ����� ���� ����. ���� �������� ��� %d ��������.';
		$this->cp_avatar_url = '���� URL �� �������';
		$this->cp_avatar_use = '����� ������� �����';
		$this->cp_bday = '��� �����';
		$this->cp_been_updated = '������ ��� �����.';
		$this->cp_been_updated1 = '������ ��� �����.';
		$this->cp_been_updated_prefs = '������ ��� ������.';
		$this->cp_changing_pass = '����� �����';
		$this->cp_contact_pm = '���� ������ ����� �� ������ ������?';
		$this->cp_contact_pm_email = 'Send email notification of personal messages when received?'; //Translate
		$this->cp_cp = '��� ����';
		$this->cp_current_avatar = '������';
		$this->cp_current_time = '���� ����� %s.';
		$this->cp_custom_title = '����� ��� ������ �����';
		$this->cp_custom_title2 = '������ ��� ������ ������ ����';
		$this->cp_dec = '�����';
		$this->cp_editing_avatar = '����� ������';
		$this->cp_editing_profile = '����� ������';
		$this->cp_email = '���� ��������';
		$this->cp_email_form = '����� ������ ����� ��� ���� ��� ���� �������?';
		$this->cp_email_invaid = '���� �������� ������ �����.';
		$this->cp_err_avatar = '����� ����� ������';
		$this->cp_err_updating = '����� ������� ������';
		$this->cp_feb = '������';
		$this->cp_file_type = '������ ������ ����� ����. ����� �� ������ ������� ����, ���� ���� �� ������ ��� gif, jpg, �� png.';
		$this->cp_format = '�� �����';
		$this->cp_gtalk = 'GTalk �����';
		$this->cp_header = '��� ���� ����';
		$this->cp_height = '����';
		$this->cp_icq = '���� ICQ';
		$this->cp_interest = '����� �����';
		$this->cp_jan = '�����';
		$this->cp_july = '����';
		$this->cp_june = '����';
		$this->cp_label_edit_avatar = '����� ������';
		$this->cp_label_edit_pass = '����� �����';
		$this->cp_label_edit_prefs = '����� ������';
		$this->cp_label_edit_profile = '����� ������';
		$this->cp_label_edit_sig = '����� �����';
		$this->cp_label_edit_subs = '����� ������';
		$this->cp_language = '���';
		$this->cp_less_charac = '�� ��� ���� ����� 32 �������.';
		$this->cp_location = '�����';
		$this->cp_login_first = '���� ���� ����� ����� ��� ���� ���� ����.';
		$this->cp_mar = '���';
		$this->cp_may = '���';
		$this->cp_msn = 'MSN ����\'�';
		$this->cp_must_orig = '.��� ��� ���� ����� ��� �����. �������� ����� �� ���� ���� �������';
		$this->cp_new_notmatch = '������ ����� ������ ���� �����.';
		$this->cp_new_pass = '����� ����';
		$this->cp_no_edit_avatar = 'You are not allowed to edit your avatar.'; //Translate
		$this->cp_no_edit_profile = 'You are not allowed to edit your profile.'; //Translate
		$this->cp_no_edit_sig = 'You are not allowed to edit your signature.'; //Translate
		$this->cp_no_flash = '������ ����� ������ ���� ��.';
		$this->cp_not_exist = '���� ����! (%s) ������ ������';
		$this->cp_nov = '������';
		$this->cp_oct = '�������';
		$this->cp_old_notmatch = '������ ����� ������ ���� ����� ��� �������.';
		$this->cp_old_pass = '����� ����';
		$this->cp_pass = 'Password'; //Translate
		$this->cp_pass2 = 'Only required if changing Email'; //Translate
		$this->cp_pass_notmatch = 'The password you entered does not match the one in our database.'; //Translate
		$this->cp_pass_notvaid = '������ ��� �� �����. ���� ����� ����� ������ ������ ���� ������, ������, �� �����, �� ����� �������.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = '���� ������';
		$this->cp_preview_sig = ':���� ������ �� ������';
		$this->cp_privacy = '�������� ������';
		$this->cp_repeat_pass = '���� �� ������ �����';
		$this->cp_sept = '������';
		$this->cp_show_active = '����� �� ��������� ����� ����� ������?';
		$this->cp_show_email = '����� ����� ������ �������?';
		$this->cp_signature = '�����';
		$this->cp_size_max = '�������. %s �� %s ������ ������ ���� ����. ����� �������� ����� ���';
		$this->cp_skin = '���� �� �����';
		$this->cp_sub_change = '���� �����';
		$this->cp_sub_delete = '�����';
		$this->cp_sub_expire = '����� �����';
		$this->cp_sub_name = '�� �����';
		$this->cp_sub_no_params = '�� ����� �������.';
		$this->cp_sub_success = '.%s ���� ���� ��� �';
		$this->cp_sub_type = '��� �����';
		$this->cp_sub_updated = '�������� ����� �����.';
		$this->cp_topic_option = '�������� ������';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = '������ �����';
		$this->cp_updated1 = '������ �����';
		$this->cp_updated_prefs = '������ ������';
		$this->cp_user_exists = '�� ����� �� ��� ����.';
		$this->cp_valided = '������ ����� �����.';
		$this->cp_view_avatar = '������ �������?';
		$this->cp_view_emoticon = '������ �������?';
		$this->cp_view_signature = '������ ������?';
		$this->cp_welcome = '������ ����� ���� ���� ����. ��� ���� ���� ����� ������ �������� ������ ���� ��. ��� ���� ��������� ��� ��� �����.';
		$this->cp_width = '����';
		$this->cp_www = '�� ����';
		$this->cp_yahoo = 'Yahoo ����\'�';
		$this->cp_zone = '����� ����';
	}

	function email()
	{
		$this->email_blocked = '��� ���� ���� ������ ��� ���� ��.';
		$this->email_email = '���� ��������';
		$this->email_msgtext = '��� ����� �����:';
		$this->email_no_fields = '���� ����� ���� ����� ��� ����� �����.';
		$this->email_no_member = '�� ���� ��� ��� ��';
		$this->email_no_perm = '��� �� ������ ����� ������ ��� ����.';
		$this->email_sent = '����� �����.';
		$this->email_subject = '����:';
		$this->email_to = '��:';
	}

	function emot_control()
	{
		$this->emote = '���� ����';
		$this->emote_add = '���� ���� ����';
		$this->emote_added = '��� ���� ������.';
		$this->emote_clickable = '���� ������';
		$this->emote_edit = '����� ���� ����';
		$this->emote_image = '�����';
		$this->emote_install = '����� ���� ����';
		$this->emote_install_done = '���� ���� ������ ���� ������.';
		$this->emote_install_warning = '����� �� ���� �� ������ ���� ����� ������� ������ ���� ���� ������ ������ ����� ���� ���� �������.';
		$this->emote_no_text = '�� ���� ��� ���� �����.';
		$this->emote_text = '����';
	}

	function files()
	{
		$this->file = 'File'; //Translate
		$this->files = 'Files'; //Translate
		$this->files_action_not_allowed = 'Action Not Allowed'; //Translate
		$this->files_action_not_permitted = 'You are not permitted to perform that action!'; //Translate
		$this->files_add_cat = 'Add Category'; //Translate
		$this->files_add_cat_desc = 'Category description'; //Translate
		$this->files_add_cat_done = 'New category has been added.'; //Translate
		$this->files_add_cat_exists = 'A category named %s already exists in %s.'; //Translate
		$this->files_add_cat_name = 'New category name'; //Translate
		$this->files_add_cat_not_allowed = 'You have not been permitted to add categories.'; //Translate
		$this->files_add_cat_parent = 'Parent category'; //Translate
		$this->files_add_cat_qperms = 'Quick Permissions'; //Translate
		$this->files_add_cat_qperms2 = 'Select an existing category to copy its permissions.'; //Translate
		$this->files_add_mod = 'Add Moderator'; //Translate
		$this->files_add_mod2 = 'Add User as Moderator'; //Translate
		$this->files_add_mod_cat = 'To which existing category?'; //Translate
		$this->files_add_mod_made = 'has been made a moderator.'; //Translate
		$this->files_add_mod_not_allowed = 'You do not have permission to add a moderator.'; //Translate
		$this->files_add_mod_nouser = 'That user was not found.'; //Translate
		$this->files_added = 'Date Added'; //Translate
		$this->files_all_fields_required = 'All fields are required.'; //Translate
		$this->files_approval_not_permitted = 'Sorry, you do not have permission to approve, deny or download this file.'; //Translate
		$this->files_approval_waiting = 'Files Awaiting Approval'; //Translate
		$this->files_approve = 'Approve Files'; //Translate
		$this->files_approve2 = 'Approve'; //Translate
		$this->files_approve_error = 'Error. You cannot go this far without a category attached.'; //Translate
		$this->files_approve_none = 'There are no files waiting for approval at this time.'; //Translate
		$this->files_approved = 'has been approved.'; //Translate
		$this->files_author = 'Author'; //Translate
		$this->files_cat = 'Category'; //Translate
		$this->files_cat_edited = 'Category has been edited.'; //Translate
		$this->files_cat_exists = 'A category named %s already exists in %s.'; //Translate
		$this->files_close_window = 'Close window.'; //Translate
		$this->files_comment = 'Add Comment'; //Translate
		$this->files_comment_empty = 'Your comment does not contain anything.'; //Translate
		$this->files_comment_not_permitted = 'You are not permitted to post comments.'; //Translate
		$this->files_comment_posted = 'Your comment has been posted.'; //Translate
		$this->files_comment_specify = 'No file was specified.'; //Translate
		$this->files_comment_user = 'User Comments For'; //Translate
		$this->files_comment_view = 'View Comments'; //Translate
		$this->files_comments = 'Comments'; //Translate
		$this->files_delete_cat = 'Delete Category'; //Translate
		$this->files_delete_cat2 = 'Delete which existing category?'; //Translate
		$this->files_delete_cat_done = 'The category has been deleted.'; //Translate
		$this->files_delete_cat_not_empty = 'The %s category is not empty. Cannot delete.'; //Translate
		$this->files_delete_cat_not_permitted = 'You have not been permitted to delete categories.'; //Translate
		$this->files_delete_confirm = 'Are you sure you want to delete'; //Translate
		$this->files_delete_file = 'Delete File'; //Translate
		$this->files_delete_file_done = 'has been deleted.'; //Translate
		$this->files_delete_file_not_permitted = 'You have not been permitted to delete files.'; //Translate
		$this->files_delete_file_specify = 'You must specify a file to delete.'; //Translate
		$this->files_delete_nocat = 'No such category.'; //Translate
		$this->files_denied = 'has been denied.'; //Translate
		$this->files_deny = 'Deny'; //Translate
		$this->files_desc = 'Description'; //Translate
		$this->files_dl = 'D/L'; //Translate
		$this->files_download = 'Download'; //Translate
		$this->files_download_not_permitted = 'You have not been permitted to download files.'; //Translate
		$this->files_download_specify = 'You must specify a file to download.'; //Translate
		$this->files_downloads = 'Downloads'; //Translate
		$this->files_downloads2 = 'downloads'; //Translate
		$this->files_edit_cat_not_parent = 'You cannot make the category its own parent!'; //Translate
		$this->files_edit_cat_not_permitted = 'You have not been permitted to edit this category.'; //Translate
		$this->files_edit_category = 'Edit Category'; //Translate
		$this->files_edit_file = 'Edit File'; //Translate
		$this->files_edit_mod = 'You can only edit categories that you moderate.'; //Translate
		$this->files_edit_not_permitted = 'You have not been permitted to edit files.'; //Translate
		$this->files_edit_root = 'You cannot edit the root category.'; //Translate
		$this->files_error_duplicate = 'Unable to process: Duplicate filename error.'; //Translate
		$this->files_error_trick = 'You tried to tricks us!'; //Translate
		$this->files_error_unknown = 'Unable to process: Unknown file error.'; //Translate
		$this->files_exists = 'A file like that already exists in the database.'; //Translate
		$this->files_fix_stats = 'Fix File Stats'; //Translate
		$this->files_fix_stats2 = 'The file stats have been corrected.'; //Translate
		$this->files_has_updated = 'has been updated with new information.'; //Translate
		$this->files_index = 'File Index'; //Translate
		$this->files_invalid_option = 'Invalid option flag'; //Translate
		$this->files_moderator = 'Moderator'; //Translate
		$this->files_modify_info = 'Modify File Information'; //Translate
		$this->files_move = 'Move'; //Translate
		$this->files_move_category = 'Move %s to which category?'; //Translate
		$this->files_move_file = 'Move File'; //Translate
		$this->files_move_no_category = 'No such category.'; //Translate
		$this->files_move_not_permitted = 'You have not been permitted to move files.'; //Translate
		$this->files_moved_file = 'has been moved.'; //Translate
		$this->files_name = 'Name'; //Translate
		$this->files_rate = 'Rate File'; //Translate
		$this->files_rate_already = 'You have already rated this file.'; //Translate
		$this->files_rate_average = 'Average'; //Translate
		$this->files_rate_excellent = 'Excellent'; //Translate
		$this->files_rate_good = 'Good'; //Translate
		$this->files_rate_please = 'Please rate this file'; //Translate
		$this->files_rate_poor = 'Poor'; //Translate
		$this->files_rate_sucks = 'Sucks!'; //Translate
		$this->files_rate_thank = 'Thank you for rating this file.'; //Translate
		$this->files_rate_valid = 'You must provide a valid file.'; //Translate
		$this->files_rating = 'Rating'; //Translate
		$this->files_recent = 'Recent Uploads'; //Translate
		$this->files_recent_uploads = 'Files uploaded in the last 10 days'; //Translate
		$this->files_remove_mod = 'Remove Moderator'; //Translate
		$this->files_remove_mod_cat = 'Which category\'s moderator would you like to remove?'; //Translate
		$this->files_remove_mod_done = 'The moderator for that category has been removed.'; //Translate
		$this->files_remove_mod_not_permitted = 'You do not have permission to remove a moderator.'; //Translate
		$this->files_revised = 'Revised on'; //Translate
		$this->files_revisions = 'Revisions'; //Translate
		$this->files_search = 'File Search'; //Translate
		$this->files_search2 = 'Search'; //Translate
		$this->files_search3 = 'Search Files'; //Translate
		$this->files_search_advanced = 'Advanced Search'; //Translate
		$this->files_search_basic = 'Basic Search'; //Translate
		$this->files_search_by = 'Search By'; //Translate
		$this->files_search_day = 'day'; //Translate
		$this->files_search_days = 'days'; //Translate
		$this->files_search_display_first = 'Display the first'; //Translate
		$this->files_search_display_more = 'Display files with more than'; //Translate
		$this->files_search_error = 'You have to search by atleast the name, author or descripton.'; //Translate
		$this->files_search_error_none = 'No files found.'; //Translate
		$this->files_search_for = 'Search For'; //Translate
		$this->files_search_in = 'Search In'; //Translate
		$this->files_search_minimum_rating = 'Minimum Rating'; //Translate
		$this->files_search_month = 'month'; //Translate
		$this->files_search_months = 'months'; //Translate
		$this->files_search_newer = 'newer'; //Translate
		$this->files_search_older = 'older'; //Translate
		$this->files_search_results = 'Search results for'; //Translate
		$this->files_search_results2 = 'results'; //Translate
		$this->files_search_week = 'week'; //Translate
		$this->files_search_weeks = 'weeks'; //Translate
		$this->files_search_year = 'year'; //Translate
		$this->files_size = 'File Size'; //Translate
		$this->files_submitted_by = 'Submitted by'; //Translate
		$this->files_top20 = 'Top 20 Downloads'; //Translate
		$this->files_type = 'File Type'; //Translate
		$this->files_update = 'Update'; //Translate
		$this->files_update_approval_not_permitted = 'You do not have the permission to approve this update.'; //Translate
		$this->files_update_approve = 'Approve Update'; //Translate
		$this->files_update_approve_failed = 'Failed to copy update into downloads directory!'; //Translate
		$this->files_update_approved = 'The update has been approved.'; //Translate
		$this->files_update_denied = 'Update has been denied and purged.'; //Translate
		$this->files_update_deny = 'Deny Update'; //Translate
		$this->files_update_desc = 'The description has been updated.'; //Translate
		$this->files_update_file = 'Update File'; //Translate
		$this->files_update_file_need_desc = 'The description field must be filled in.'; //Translate
		$this->files_update_not_exist = 'This file does not exist and cannot be updated.'; //Translate
		$this->files_update_not_exist2 = 'You cannot approve updates that do not exist!'; //Translate
		$this->files_update_not_permitted = 'You do not have the permission to update this file.'; //Translate
		$this->files_update_pending = 'Your update has been uploaded and is pending approval.'; //Translate
		$this->files_updated = 'Last Updated'; //Translate
		$this->files_upload = 'Upload File'; //Translate
		$this->files_upload_no_root = 'Cannot upload to the Root category.'; //Translate
		$this->files_upload_not_permitted = 'You have not been permitted to upload files.'; //Translate
		$this->files_upload_pending = 'The file has been uploaded and is pending approval.'; //Translate
		$this->files_uploaded = 'The file has been uploaded.'; //Translate
		$this->files_view = 'View File'; //Translate
		$this->files_view_archive = 'Archive'; //Translate
		$this->files_view_c = 'C Source'; //Translate
		$this->files_view_cat_not_permitted = 'You are not permitted to view this category.'; //Translate
		$this->files_view_cpp = 'C++ Source'; //Translate
		$this->files_view_java = 'Java Source'; //Translate
		$this->files_view_perl = 'Perl Script'; //Translate
		$this->files_view_php = 'PHP Source'; //Translate
		$this->files_view_plain = 'Plain Text'; //Translate
		$this->files_view_python = 'Python Script'; //Translate
		$this->files_view_specify = 'You must specify a file id to view.'; //Translate
	}

	function forum()
	{
		$this->forum_by = '�� ���';
		$this->forum_can_post = '��� ���� ����� ������ ���.';
		$this->forum_can_topics = '��� ���� ����� ������ ������ ���.';
		$this->forum_cant_post = '��� �� ���� ����� ������ ���.';
		$this->forum_cant_topics = '��� �� ���� ����� ������ ������ ���.';
		$this->forum_dot = '�����';
		$this->forum_dot_detail = '���� ����� ������';
		$this->forum_forum = '�����';
		$this->forum_guest = '����';
		$this->forum_hot = '��';
		$this->forum_icon = '������ �� ����';
		$this->forum_jump = '���� ������ ������ �����';
		$this->forum_last = '����� ������';
		$this->forum_locked = '����';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = '�����';
		$this->forum_msg = '%s �����';
		$this->forum_new = '���';
		$this->forum_new_poll = '���� ��� ���';
		$this->forum_new_topic = '���� ���� ���';
		$this->forum_no_topics = '��� ������ ����� ������ ��.';
		$this->forum_noexist = '������ ������ �� ����.';
		$this->forum_nopost = '��� ������';
		$this->forum_not = '��';
		$this->forum_noview = '��� �� ������ ����� �������� ����.';
		$this->forum_pages = '������';
		$this->forum_pinned = '����';
		$this->forum_pinned_topic = '���� ����';
		$this->forum_poll = '���';
		$this->forum_regfirst = '���� ����� ����� ������. �� �����, ����� ����� �����.';
		$this->forum_replies = '������';
		$this->forum_starter = '�����';
		$this->forum_sub = '��-�����';
		$this->forum_sub_last_post = '����� ������';
		$this->forum_sub_replies = '������';
		$this->forum_sub_topics = '������';
		$this->forum_subscribe = '��� �� ����� ���� ������� ������ ��';
		$this->forum_topic = '����';
		$this->forum_topic_posted = 'Posted'; //Translate
		$this->forum_unread = 'Jump to oldest unread post'; //Translate
		$this->forum_views = '�����';
		$this->forum_write_topics = '���� ����� ����� ������ ������ ��.';
	}

	function forums()
	{
		$this->forum_controls = '���� ������';
		$this->forum_create = '����� �����';
		$this->forum_create_cat = '��� �������';
		$this->forum_created = '������ ����';
		$this->forum_default_perms = '������ ����� ����';
		$this->forum_delete = '����� �����';
		$this->forum_delete_warning = '����� �� �� �����. <br />��� ��� ���� ���� ����� �� ������ ��� ���� �������� ���������?';
		$this->forum_deleted = '������ ����.';
		$this->forum_description = '����';
		$this->forum_edit = '����� �����';
		$this->forum_edited = '������ ���� ������.';
		$this->forum_empty = '�� ���� �� ������. ��� ���� ��� ��.';
		$this->forum_is_subcat = '����� �� ��� ��-������� ����.';
		$this->forum_is_url = 'This forum is a URL redirect. The description should be the URL to redirect to.'; //Translate
		$this->forum_name = '��';
		$this->forum_no_orphans = '���� ���� ����� ����� �"� ����� ����� ���.';
		$this->forum_none = '��� ������� ������.';
		$this->forum_ordered = '��� �������� �����';
		$this->forum_ordering = '��� ��� ��������';
		$this->forum_parent = '���� ���� ����� �� �� ������/�� ����� ��.';
		$this->forum_parent_cat = '�������� ��';
		$this->forum_quickperm_select = '��� ������ ���� ���� ������ �� ������� ���.';
		$this->forum_quickperms = '������ ������';
		$this->forum_recount = '����� ������ �������';
		$this->forum_select_cat = '��� ������� ����� ���� ����� �����.';
		$this->forum_subcat = '��-�������';
		$this->forum_url = 'URL Redirect'; //Translate
	}

	function groups()
	{
		$this->groups_bad_format = 'You must use %s in the format, which represents the group name.'; //Translate
		$this->groups_based_on = '������ ��';
		$this->groups_create = '����� �����';
		$this->groups_create_new = '��� ����� ������� ���� ���';
		$this->groups_created = '����� �����';
		$this->groups_delete = '����� �����';
		$this->groups_deleted = '����� �����.';
		$this->groups_edit = '����� �����';
		$this->groups_edited = '����� �����.';
		$this->groups_formatting = '��� �����';
		$this->groups_i_confirm = '��� ���� ������� ����� �� ����� ������.';
		$this->groups_name = '��';
		$this->groups_no_action = '�� ����� �����.';
		$this->groups_no_delete = ' , ����� ������ ������.Quicksilver ������ ����� ������� ������� �������� ��<br />��� ������ ������� ����� ������.';
		$this->groups_no_group = '�� ������ �����.';
		$this->groups_no_name = '�� ���� �� ������.';
		$this->groups_only_custom = '.Quicksilver ����: �������� ����� �� ������ ������� �����. ������ ����� ������� ������� �������� ��';
		$this->groups_the = '������';
		$this->groups_to_edit = '����� ������';
		$this->groups_type = '��� �����';
		$this->groups_will_be = '�����.';
		$this->groups_will_become = '������� ������� ������ �����';
	}

	function help()
	{
		$this->help_add = '����� ���� ����';
		$this->help_article = '���� ���� ����';
		$this->help_available_files = '����';
		$this->help_confirm = '��� ��� ���� ���� �����';
		$this->help_content = '���� ����';
		$this->help_delete = '����� ���� ����';
		$this->help_deleted = '���� ���� ����.';
		$this->help_edit = '����� ���� ����';
		$this->help_edited = '���� ���� �����.';
		$this->help_inserted = '���� ����� ���� �������.';
		$this->help_no_articles = '�� ����� ����� ���� ���� �������';
		$this->help_no_title = '��� ������ ����� ���� ���� ��� �����.';
		$this->help_none = '��� ���� ���� ���� ������';
		$this->help_not_exist = '���� ���� �� �� ����.';
		$this->help_select = '��� ����� ���� ������.';
		$this->help_select_delete = '��� ����� ���� ������.';
		$this->help_title = '�����';
	}

	function home()
	{
		$this->home_choose = '������ ��� ������.';
		$this->home_menu_title = '����� ��� ���� ����';
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
		$this->login = 'Login'; //Translate
		$this->login_cant_logged = '������ ���. cookies . �����, ���� �������\'Username\' \' ���� �UsErNaMe\' ���� ������ ������� ����� �������, �"�<br /><br />�� ������� ������ ������. ���� ��� ������ ������� ������.';
		$this->login_cookies = '���� ������ ������. cookies ���� �����';
		$this->login_forgot_pass = '���� �� ������?';
		$this->login_header = '�����';
		$this->login_logged = '���� ����� �����\�.';
		$this->login_now_out = '���� ����� �����\�.';
		$this->login_out = '�����';
		$this->login_pass = '�����';
		$this->login_pass_no_id = '�� ���� ��� �� �� ������ ������.';
		$this->login_pass_request = '������ ����� ������, ��� �� ������ ������ ����� ������� �� ������.';
		$this->login_pass_reset = '����� �����';
		$this->login_pass_sent = '������ �����. ������ ����� ����� ����� ������� �� ������.';
		$this->login_sure = '��� ���� ���� ���� ������ � \'%s\'?';
		$this->login_user = '�� �����';
	}

	function logs()
	{
		$this->logs_action = '�����';
		$this->logs_category = 'Category'; //Translate
		$this->logs_category_created = 'Created a file category'; //Translate
		$this->logs_category_deleted = 'Deleted a file category'; //Translate
		$this->logs_category_edited = 'Edited a file category'; //Translate
		$this->logs_category_from = 'from category'; //Translate
		$this->logs_category_in = 'in category'; //Translate
		$this->logs_deleted_post = '����� �����';
		$this->logs_deleted_topic = '����� �����';
		$this->logs_edited_post = '����� �����';
		$this->logs_edited_topic = '����� �����';
		$this->logs_file = 'File'; //Translate
		$this->logs_file_deleted = 'Deleted a file'; //Translate
		$this->logs_file_edited = 'Edited a file'; //Translate
		$this->logs_file_moved = 'Moved a file'; //Translate
		$this->logs_file_update_approved = 'Approved a file update'; //Translate
		$this->logs_file_update_denied = 'Denied a file update'; //Translate
		$this->logs_file_updated = 'Updated a file'; //Translate
		$this->logs_id = 'IDs'; //Translate
		$this->logs_locked_topic = '����� �����';
		$this->logs_mod_add = 'Set a file moderator'; //Translate
		$this->logs_mod_remove = 'Removed a file moderator'; //Translate
		$this->logs_moved_from = '�������';
		$this->logs_moved_to = '������';
		$this->logs_moved_topic = '������ �����';
		$this->logs_moved_topic_num = '������ ����� #';
		$this->logs_pinned_topic = '����� �����';
		$this->logs_post = '�����';
		$this->logs_time = '���';
		$this->logs_topic = '����';
		$this->logs_unlocked_topic = '������ �����';
		$this->logs_unpinned_topic = '����� �����';
		$this->logs_user = '�����';
		$this->logs_view = '��� ������ ����';
	}

	function main()
	{
		$this->main_activate = '������ �� ����� �����.';
		$this->main_activate_resend = '��� ���� ���� �����';
		$this->main_admincp = '��� ���� �� ����';
		$this->main_affiliates = 'Affiliates'; //Translate
		$this->main_banned = '����� ��� ������ ���� ����� �������.';
		$this->main_code = '���';
		$this->main_cp = '��� ����';
		$this->main_files = 'Files'; //Translate
		$this->main_forum = 'Forum'; //Translate
		$this->main_full = '���';
		$this->main_guests = 'Guests'; //Translate
		$this->main_help = '����';
		$this->main_home = 'Home'; //Translate
		$this->main_load = '����';
		$this->main_login = '�����';
		$this->main_logout = '�����';
		$this->main_mark = '��� ���';
		$this->main_mark1 = '��� �� �� ������� ������';
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = '�� ����, ��� ���� ���� �� ������� �������. %s ��� �������, ���� �';
		$this->main_member_newest = 'Newest Member'; //Translate
		$this->main_members = '�������';
		$this->main_messenger = '������ ������';
		$this->main_new = '���';
		$this->main_news = 'News'; //Translate
		$this->main_next = '���';
		$this->main_pages = 'Pages'; //Translate
		$this->main_posted_by = 'Posted by'; //Translate
		$this->main_posts = 'Posts'; //Translate
		$this->main_prev = '�����';
		$this->main_queries = '�������';
		$this->main_quote = '�����';
		$this->main_recent = '������ �������';
		$this->main_recent1 = '��� ������� �������� ��� ������ ������';
		$this->main_recent_uploads = 'Recent Uploads'; //Translate
		$this->main_register = '�����';
		$this->main_reminder = '������: ����� �� ���� ����� ������ �� �"� ������.';
		$this->main_reminder_closed = '������ ���� ����� ����� �� �"� ������';
		$this->main_said = '���';
		$this->main_search = '�����';
		$this->main_stats = 'Stats'; //Translate
		$this->main_top_posters = 'Top Posters'; //Translate
		$this->main_top_uploaders = 'Top Uploaders'; //Translate
		$this->main_topics = 'Topics'; //Translate
		$this->main_topics_new = '�� ������ ����� ������ ���.';
		$this->main_topics_old = '��� ������ ����� ������ ���.';
		$this->main_users_online = 'Users Online'; //Translate
		$this->main_welcome = '���� ���';
		$this->main_welcome_guest = '���� ���!';
	}

	function mass_mail()
	{
		$this->mail = '���� ������';
		$this->mail_announce = '����� �';
		$this->mail_groups = '������ ������';
		$this->mail_members = '�����.';
		$this->mail_message = '�����';
		$this->mail_select_all = '��� ���';
		$this->mail_send = '��� ������';
		$this->mail_sent = '������ ����� �';
	}

	function member_control()
	{
		$this->mc = '���� ���';
		$this->mc_confirm = '��� ��� ���� ���� �����';
		$this->mc_delete = '����� ���';
		$this->mc_deleted = '��� ����.';
		$this->mc_edit = '����� ���';
		$this->mc_edited = '��� �����';
		$this->mc_email_invaid = '����� ������� ������ ���� �����.';
		$this->mc_err_updating = '����� ������ �������';
		$this->mc_find = '��� ����� �� ���� �������';
		$this->mc_found = '������ ����� �����. ��� ��� ���.';
		$this->mc_guest_banned = 'You cannot ban Guests, this would cause your board to become unusable.'; //Translate
		$this->mc_guest_needed = 'Quicksilver ����� ����� ����� ������� �������� ��';
		$this->mc_not_found = '�� ����� ����� �������';
		$this->mc_user_aim = 'AIM ��';
		$this->mc_user_avatar = '������';
		$this->mc_user_avatar_height = '���� ������';
		$this->mc_user_avatar_type = '��� ������';
		$this->mc_user_avatar_width = '���� ������';
		$this->mc_user_birthday = '��� �����';
		$this->mc_user_email = '����� ������';
		$this->mc_user_email_show = '������� ������';
		$this->mc_user_group = '�����';
		$this->mc_user_gtalk = '����� GTalk';
		$this->mc_user_homepage = '�� ����';
		$this->mc_user_icq = 'ICQ ����';
		$this->mc_user_id = '���� �����';
		$this->mc_user_interests = '����� �����';
		$this->mc_user_joined = '��� ���';
		$this->mc_user_language = '���';
		$this->mc_user_lastpost = '����� ������';
		$this->mc_user_lastvisit = '����� �����';
		$this->mc_user_level = '���';
		$this->mc_user_location = '�����';
		$this->mc_user_msn = '����� MSN';
		$this->mc_user_name = '��';
		$this->mc_user_pm = '���� ������ ������';
		$this->mc_user_pm_mail = 'Email Private Messages'; //Translate
		$this->mc_user_posts = '������';
		$this->mc_user_regip = 'Registration IP'; //Translate
		$this->mc_user_signature = '�����';
		$this->mc_user_skin = '����';
		$this->mc_user_timezone = '���� ���';
		$this->mc_user_title = '����� ���';
		$this->mc_user_title_custom = '����� ������ ��� ������ �����';
		$this->mc_user_uploads = 'Uploads'; //Translate
		$this->mc_user_view_avatars = '����� ������';
		$this->mc_user_view_emoticons = '����� ���� ����';
		$this->mc_user_view_signatures = '����� ������';
		$this->mc_user_yahoo = '����� Yhoo';
	}

	function membercount()
	{
		$this->mcount = '��� ���������� �����';
		$this->mcount_updated = '����� ����� ������.';
	}

	function members()
	{
		$this->members_all = '���';
		$this->members_email = '���� ��������';
		$this->members_email_member = '��� ���� �������� ������';
		$this->members_group = '�����';
		$this->members_joined = '����� �������';
		$this->members_list = '����� �������';
		$this->members_member = '�����';
		$this->members_pm = '����� �����';
		$this->members_posts = '������';
		$this->members_send_pm = '��� ����� ����� ������';
		$this->members_title = '�����';
		$this->members_vist_www = '��� ���� ���� �� �����';
		$this->members_www = '��� ����';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = '?��� ��� ���� ���� ����� �� ������';
		$this->mod_confirm_topic_delete = '?��� ��� ���� ���� ����� �� ������';
		$this->mod_error_first_post = '.���� ���� ����� �� ������ ������� �����';
		$this->mod_error_move_category = '.���� ���� ������ ���� ��������';
		$this->mod_error_move_create = '��� �� ������ ������ ������ ������ ���.';
		$this->mod_error_move_forum = '.���� ���� ������ ���� ������ ��� ����';
		$this->mod_error_move_global = '.���� ���� ������ ���� ������. ���� �� ����� ���� ������';
		$this->mod_error_move_same = '���� ���� ������ ���� ������ �� ��� ��� ����.';
		$this->mod_label_controls = '��� �����';
		$this->mod_label_description = '����';
		$this->mod_label_emoticon = '?����� ���� ���� �������';
		$this->mod_label_global = '���� ������';
		$this->mod_label_mbcode = 'Format MbCode?'; //Translate
		$this->mod_label_move_to = '���� �';
		$this->mod_label_options = '��������';
		$this->mod_label_post_delete = '��� �����';
		$this->mod_label_post_edit = '���� �����';
		$this->mod_label_post_icon = '���� ������';
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = '�����';
		$this->mod_label_title_original = '����� ����';
		$this->mod_label_title_split = '��� �����';
		$this->mod_label_topic_delete = '��� ����';
		$this->mod_label_topic_edit = '���� ����';
		$this->mod_label_topic_lock = '��� ����';
		$this->mod_label_topic_move = '���� ����';
		$this->mod_label_topic_move_complete = '���� �� �� ����� ����� ������ ����';
		$this->mod_label_topic_move_link = '.���� �� ����� ������ ����, ����� ����� ���� ������ ����';
		$this->mod_label_topic_pin = '��� ����';
		$this->mod_label_topic_split = '��� ����';
		$this->mod_missing_post = '.������ ������� �� �����';
		$this->mod_missing_topic = '.����� ������ �� ����';
		$this->mod_no_action = '.����� ����� �����';
		$this->mod_no_post = '.����� ����� �����';
		$this->mod_no_topic = '.����� ����� ����';
		$this->mod_perm_post_delete = '.��� �� ������ ������ ����� ��';
		$this->mod_perm_post_edit = '��� �� ������ ������ ����� ��.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = '.��� �� ������ ������ ���� ��';
		$this->mod_perm_topic_edit = '.��� �� ������ ������ ���� ��';
		$this->mod_perm_topic_lock = '.��� �� ������ ������ ���� ��';
		$this->mod_perm_topic_move = '��� �� ������ ������ ���� ��';
		$this->mod_perm_topic_pin = '.��� �� ������ ������ ���� ��';
		$this->mod_perm_topic_split = '.��� �� ������ ������ ���� ��';
		$this->mod_perm_topic_unlock = '.��� �� ������ ����� ����� ����� ��';
		$this->mod_perm_topic_unpin = '.��� �� ������ ����� ����� ����� ��';
		$this->mod_success_post_delete = '.������ ����� ������';
		$this->mod_success_post_edit = '.������ ����� ������';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = '.����� ���� ������';
		$this->mod_success_topic_delete = '.����� ���� ������';
		$this->mod_success_topic_edit = '����� ���� ������';
		$this->mod_success_topic_move = '.����� ����� ������ ������ ����';
		$this->mod_success_unpublish = 'This topic has been removed from the published list.'; //Translate
	}

	function news()
	{
		$this->news_comments = 'comment(s)'; //Translate
		$this->news_more = 'Read more...'; //Translate
		$this->news_previous = 'Previous news...'; //Translate
	}

	function optimize()
	{
		$this->optimize = '���� ��� ������';
		$this->optimized = '.������� ���� ������� ������ �������� ��������';
	}

	function page()
	{
		$this->page = 'Page'; //Translate
		$this->page_action_not_allowed = 'Action not allowed!'; //Translate
		$this->page_contents = 'Contents'; //Translate
		$this->page_create = 'Create Page'; //Translate
		$this->page_create2 = 'Create'; //Translate
		$this->page_create_not_permitted = 'You are not permitted to create pages.'; //Translate
		$this->page_created = 'Page created.'; //Translate
		$this->page_creating = 'Creating a page'; //Translate
		$this->page_delete = 'Delete a page'; //Translate
		$this->page_delete_confirm = 'Are you sure you want to delete this page forever? This process is irreversable.'; //Translate
		$this->page_delete_not_permitted = 'You are not permitted to delete pages.'; //Translate
		$this->page_deleted = 'Page deleted.'; //Translate
		$this->page_edit = 'Edit Page'; //Translate
		$this->page_edit_done = 'Page successfully edited.'; //Translate
		$this->page_edit_not_permitted = 'You are not permitted to edit pages.'; //Translate
		$this->page_editing = 'Editing a page'; //Translate
		$this->page_not_exist = 'That page does not exist!'; //Translate
		$this->page_title = 'Title'; //Translate
		$this->page_viewing = 'Viewing a page'; //Translate
		$this->pages = 'Pages'; //Translate
		$this->pages_none = 'There are no custom pages yet.'; //Translate
	}

	function perms()
	{
		$this->perm = '������';
		$this->perms = '������';
		$this->perms_board_view = '��� �� ������ ������';
		$this->perms_board_view_closed = '���� ������ Quicksilver ����� �������� ��';
		$this->perms_create_pages = 'Can create custom pages'; //Translate
		$this->perms_delete_pages = 'Can delete custom pages'; //Translate
		$this->perms_do_anything = '����� �������� �� Quicksilver ';
		$this->perms_edit_avatar = 'Can edit user avatar'; //Translate
		$this->perms_edit_for = '���� ������ �';
		$this->perms_edit_pages = 'Can edit custom pages'; //Translate
		$this->perms_edit_profile = 'Can edit user profile'; //Translate
		$this->perms_edit_sig = 'Can edit signatures'; //Translate
		$this->perms_email_use = '����� ������ ������ ��� ������';
		$this->perms_for = 'Permissions For'; //Translate
		$this->perms_forum_view = '��� �� ������';
		$this->perms_group = 'Group'; //Translate
		$this->perms_guest1 = 'You cannot stop Guests from using the board. The board would become unusable by anyone.'; //Translate
		$this->perms_guest2 = 'You cannot stop the Guest Group from using the board. The board would become unusable by anyone.'; //Translate
		$this->perms_is_admin = '����� ���� ���� ����';
		$this->perms_only_user = '����� �� ������� ����� ������ ��';
		$this->perms_override_user = '.�� ����� �� ������ ������ ������ ��';
		$this->perms_pm_noflood = 'Exempt from personal messenger flood control'; //Translate
		$this->perms_poll_create = '����� �����';
		$this->perms_poll_vote = '����� ������';
		$this->perms_post_attach = 'Attach uploads to posts'; //Translate
		$this->perms_post_attach_download = 'Download post attachments'; //Translate
		$this->perms_post_create = '����� ������';
		$this->perms_post_delete = '����� �� �����';
		$this->perms_post_delete_own = '����� ������� �� ������ �� ���';
		$this->perms_post_edit = '����� �� �����';
		$this->perms_post_edit_own = '����� ������ �� ������ �� ���';
		$this->perms_post_inc_userposts = 'Posts contribute to user\'s total post count'; //Translate
		$this->perms_post_noflood = 'Exempt from post flood control'; //Translate
		$this->perms_post_viewip = '�� ������ IP ���� ����� �';
		$this->perms_search_noflood = 'Exempt from search flood control'; //Translate
		$this->perms_title = '���� ����� �����';
		$this->perms_topic_create = '����� ������';
		$this->perms_topic_delete = '����� �� ����';
		$this->perms_topic_delete_own = '����� ������ �� ������ �� ���';
		$this->perms_topic_edit = '����� �� ����';
		$this->perms_topic_edit_own = '����� ������ �� ������ �� ���';
		$this->perms_topic_global = '���� ����� ������ ��� ��������';
		$this->perms_topic_lock = '����� �� ����';
		$this->perms_topic_lock_own = '����� ������ �� ������ �� ���';
		$this->perms_topic_move = '����� ����';
		$this->perms_topic_move_own = '����� ������ �� ������ �� ���';
		$this->perms_topic_pin = '����� �� �����';
		$this->perms_topic_pin_own = '����� ������� �� ������ �� ���';
		$this->perms_topic_publish = 'Publish or unpublish any topic'; //Translate
		$this->perms_topic_publish_auto = 'New topics are marked as published'; //Translate
		$this->perms_topic_split = '����� ���� ������ ������';
		$this->perms_topic_split_own = '����� ������ ����� ������ �� ������ �� ���';
		$this->perms_topic_unlock = '����� ����� �� ����';
		$this->perms_topic_unlock_mod = '����� ����� �� �����/�';
		$this->perms_topic_unlock_own = '����� ����� ������ �� ������ �� ���';
		$this->perms_topic_unpin = '����� ����� �� ����';
		$this->perms_topic_unpin_own = '����� ����� ������ �� ������ �� ���';
		$this->perms_topic_view = '���� ������';
		$this->perms_topic_view_unpublished = 'View unpublished topics'; //Translate
		$this->perms_updated = '.������� ������';
		$this->perms_user = 'User'; //Translate
		$this->perms_user_inherit = '.������ ���� �� ������ ������/��';
	}

	function php_info()
	{
		$this->php_error = '�����';
		$this->php_error_msg = '����� ����� ����� ����� ������ ��.\' .phpinfo() �� ���� ����';
	}

	function pm()
	{
		$this->pm_avatar = '������';
		$this->pm_cant_del = '��� �� ����� ���� ����� ��.';
		$this->pm_delallmsg = '��� �� �������';
		$this->pm_delete = '���';
		$this->pm_delete_selected = '����� ������ ������';
		$this->pm_deleted = '����� �����.';
		$this->pm_deleted_all = '������ �����.';
		$this->pm_error = '%s ������ ����� �� ������ ������ ������:<br /><br />%s ������ ����� �� ������:<br /><br />����� ���� ������ ������ ����� �������.';
		$this->pm_fields = '.������ �� �����. ���� ����� ����� �����';
		$this->pm_flood = '��� ��� ��� ��� �����. <br /><br />�����, ���� ���� ����� ��� ��� �����. %s ���� ����� ����';
		$this->pm_folder_inbox = '���� ����';
		$this->pm_folder_new = '%s ���';
		$this->pm_folder_sentbox = '����';
		$this->pm_from = '�';
		$this->pm_group = '�����';
		$this->pm_guest = '.�����, ���� ���� ������ �����\'�. ��� ����� ������ �� �����';
		$this->pm_joined = '�����';
		$this->pm_messenger = '����\'� ����';
		$this->pm_msgtext = '���� �����';
		$this->pm_multiple = '; ���� ������ ������ ��';
		$this->pm_no_folder = '.���� ����� �����';
		$this->pm_no_member = '�� ����� ����� �� ���� ��';
		$this->pm_no_number = '�� ����� ����� ����� ��';
		$this->pm_no_title = '��� ����';
		$this->pm_nomsg = '.��� ������ ������';
		$this->pm_noview = '��� �� ������ ����� ����� ��.';
		$this->pm_offline = '��� �� ���� �� ����';
		$this->pm_online = '��� �� ���� ����';
		$this->pm_personal = '����\'� ����';
		$this->pm_personal_msging = '���� �����';
		$this->pm_pm = '����� �����';
		$this->pm_posts = '������';
		$this->pm_preview = '���� ������';
		$this->pm_recipients = '������';
		$this->pm_reply = '�����';
		$this->pm_send = ' ��� ';
		$this->pm_sendamsg = '��� ����� �����';
		$this->pm_sendingpm = '���� ����� �����';
		$this->pm_sendon = '���� �';
		$this->pm_sent_mail = 'has sent you a private message.'; //Translate
		$this->pm_success = '����� ��� ����� ������.';
		$this->pm_sure_del = '���� ����\� ������� ����� ����� ��?';
		$this->pm_sure_delall = '���� ���� ������� ����� �� �������?';
		$this->pm_title = '�����';
		$this->pm_to = '��';
	}

	function post()
	{
		$this->post_attach = '����� �������';
		$this->post_attach_add = '���� ���� ';
		$this->post_attach_disrupt = '.����� �� ���� �� ����� �� ����� �� ������';
		$this->post_attach_failed = '����� ����� �����. ����� ������ �� ����.';
		$this->post_attach_not_allowed = '.���� ���� ������ ����� ���� ��';
		$this->post_attach_remove = '���� ����� �������';
		$this->post_attach_too_large = '.Kb %d ������ ������ ������ ������ ����. ����� ������ ���';
		$this->post_cant_create = '.�����, ���� ���� ����� ������. �� �����, ���� ����� ������';
		$this->post_cant_create1 = '.��� �� ������ ����� ������';
		$this->post_cant_enter = '.����� ��� �� ������. ����� ���� ����� ���� ��, �� ���� �� ������ �����';
		$this->post_cant_poll = '�����, ���� ���� ����� �����. �� �����, ���� ����� �����';
		$this->post_cant_poll1 = '.��� �� ������ ����� �����';
		$this->post_cant_reply = '.��� �� ������ ����� ������� ������ ��';
		$this->post_cant_reply1 = '�����, ���� ���� ����� �������. �� �����, ���� ����� �������.';
		$this->post_cant_reply2 = '.��� �� ������ ����� �������';
		$this->post_closed = '.����� ��� ����';
		$this->post_create_poll = '��� ���';
		$this->post_create_topic = '��� ����';
		$this->post_creating = '���� ����';
		$this->post_creating_poll = '���� ���';
		$this->post_flood = '��� ��� ��� ��� �����. <br /><br />�����, ���� ���� ����� ��� ��� �����. %s ���� ����� ����';
		$this->post_guest = '����';
		$this->post_icon = '���� ������';
		$this->post_last_five = '���� ������� �������� ���� ����';
		$this->post_length = '���� ����';
		$this->post_msg = '�����';
		$this->post_must_msg = '.���� ����� �����';
		$this->post_must_options = '���� ����� �������� ������ ���.';
		$this->post_must_title = '���� ����� ����� ������ ���� ���.';
		$this->post_new_poll = '��� ���';
		$this->post_new_topic = '���� ���';
		$this->post_no_forum = '.������ �� ����';
		$this->post_no_topic = '.�� ����� ����';
		$this->post_no_vote = '���� ����� ������ ���� ������.';
		$this->post_option_emoticons = '?����� ���� ���� �������';
		$this->post_option_global = '?����� ���� �� ������';
		$this->post_option_lock = 'Lock topic after posting?'; //Translate
		$this->post_option_mbcode = 'Format MbCode?'; //Translate
		$this->post_option_pin = 'Pin topic after posting?'; //Translate
		$this->post_optional = '����';
		$this->post_options = '��������';
		$this->post_poll_options = '�������� ���';
		$this->post_poll_row = '��� ��� ����';
		$this->post_posted = '����� �����';
		$this->post_posting = '����� �����';
		$this->post_preview = '����� ������';
		$this->post_reply = '�����';
		$this->post_reply_topic = '����� �����';
		$this->post_replying = '���� �����';
		$this->post_replying1 = '����';
		$this->post_too_many_options = '.�������� ���� %d ���� ����� ��� 2 �';
		$this->post_topic_detail = '���� ����';
		$this->post_topic_title = '����� ����';
		$this->post_view_topic = '��� �� �� �����';
		$this->post_voting = '�����';
	}

	function profile()
	{
		$this->profile_aim_sn = '�� ����� �� AIM';
		$this->profile_av_sign = '����� ������';
		$this->profile_avatar = '�����';
		$this->profile_bday = '��� �����';
		$this->profile_contact = '����� ���';
		$this->profile_email_address = '����� ���� ��������';
		$this->profile_fav = '����� �����';
		$this->profile_fav_forum = '%s (%d%% ������ �� ����/��)';
		$this->profile_gtalk = 'GTalk �����';
		$this->profile_icq_uin = '���� ICQ';
		$this->profile_info = '����';
		$this->profile_interest = '����� ����������';
		$this->profile_joined = '�����';
		$this->profile_last_post = '����� ������';
		$this->profile_list = '����� �����';
		$this->profile_location = '�����';
		$this->profile_member = '����� �����';
		$this->profile_member_title = '�����';
		$this->profile_msn = 'MSN ����\'�';
		$this->profile_must_user = '.���� ������ ��� ��� ����� ������';
		$this->profile_no_member = '.��� ����� �� ���� ��. ������ ����� ����';
		$this->profile_none = '[ ��� ]';
		$this->profile_not_post = '�� ��� ������.';
		$this->profile_offline = '��� �� ���� �� ����';
		$this->profile_online = '��� �� ���� ����';
		$this->profile_pm = '������ ������';
		$this->profile_postcount = '%s ��"�, %s ����';
		$this->profile_posts = '������';
		$this->profile_private = '[ ���� ]';
		$this->profile_profile = '������';
		$this->profile_signature = '�����';
		$this->profile_unkown = '[ �� ���� ]';
		$this->profile_upload_last = 'Last Upload'; //Translate
		$this->profile_uploads = 'Uploads'; //Translate
		$this->profile_uploads_none = 'No uploads yet.'; //Translate
		$this->profile_uploads_none_yet = 'None yet.'; //Translate
		$this->profile_uploads_per_day = 'per day'; //Translate
		$this->profile_uploads_total = 'total'; //Translate
		$this->profile_view_profile = '���� ������� ��';
		$this->profile_www = '��� ����';
		$this->profile_yahoo = '���� ����\'�';
	}

	function prune()
	{
		$this->prune_action = '����� ����� ������';
		$this->prune_age_day = '��� ���';
		$this->prune_age_eighthours = ' 8 ����';
		$this->prune_age_hour = '��� ���';
		$this->prune_age_month = '���� ���';
		$this->prune_age_threemonths = '3 ������';
		$this->prune_age_week = '���� ���';
		$this->prune_age_year = '��� ���';
		$this->prune_forums = '��� ������� ������';
		$this->prune_invalidage = '����� ��� �� ��� ������';
		$this->prune_move = '����';
		$this->prune_moveto_forum = '����� ������ ����';
		$this->prune_nodest = '�� ���� ���';
		$this->prune_notopics = '�� ����� ������ ������';
		$this->prune_notopics_old = '��� ������ ����� ����� ������';
		$this->prune_novalidforum = '�� ����� ������� ������ ������';
		$this->prune_select_age = '��� ���� ������� ���� ������ �� ������';
		$this->prune_select_topics = '��� ������ ������ �� ��� ����';
		$this->prune_success = '������ �����';
		$this->prune_title = '����� ����';
		$this->prune_topics_older_than = '����� ������ ��� �';
	}

	function query()
	{
		$this->query = '���� ������';
		$this->query_fail = '.����';
		$this->query_success = '.���� ������';
		$this->query_your = '������ ���';
	}

	function recent()
	{
		$this->recent_active = '������ ������ ������� ������';
		$this->recent_by = '�� ���';
		$this->recent_can_post = '��� ���� ����� ������ ���.';
		$this->recent_can_topics = '��� ���� ����� ������ ������ ���.';
		$this->recent_cant_post = '��� �� ���� ����� ������ ���.';
		$this->recent_cant_topics = '��� �� ���� ����� ������ ������ ���.';
		$this->recent_dot = '�����';
		$this->recent_dot_detail = '���� ����� ����� ��';
		$this->recent_forum = '�����';
		$this->recent_guest = '����';
		$this->recent_hot = '��';
		$this->recent_icon = '������ �� ����';
		$this->recent_jump = '���� ������ ������ �����';
		$this->recent_last = '����� ������';
		$this->recent_locked = '����';
		$this->recent_moved = '�����';
		$this->recent_msg = '%s �����';
		$this->recent_new = '���';
		$this->recent_new_poll = '���� ��� ���';
		$this->recent_new_topic = '���� ���� ���';
		$this->recent_no_topics = '.��� ������ ����� ������ ��';
		$this->recent_noexist = '������ ������ �� ����.';
		$this->recent_nopost = '��� ������';
		$this->recent_not = '��';
		$this->recent_noview = '��� �� ������ ����� �������� ����.';
		$this->recent_pages = '������';
		$this->recent_pinned = '����';
		$this->recent_pinned_topic = '���� ����';
		$this->recent_poll = '���';
		$this->recent_regfirst = '���� ���� ����� ��������. �� �����, ���� ����� ��������.';
		$this->recent_replies = '������';
		$this->recent_starter = '�����';
		$this->recent_sub = '��-�����';
		$this->recent_sub_last_post = '����� ������';
		$this->recent_sub_replies = '������';
		$this->recent_sub_topics = '������';
		$this->recent_subscribe = '��� �� ���� ������� ������ ��';
		$this->recent_topic = '����';
		$this->recent_topic_posted = 'Posted'; //Translate
		$this->recent_views = '�����';
		$this->recent_write_topics = '.�������� ����� ������ ������ ��';
	}

	function register()
	{
		$this->register_activated = '!������ �����';
		$this->register_activating = '����� �����';
		$this->register_activation_error = '.����� ���� ������ ������. ���� ����� ������ ������ ������ ����� ������. �� ����� �����, ��� ����� ������ ������ ���� �� �������';
		$this->register_confirm_passwd = '��� �����';
		$this->register_done = '.����� ������. �������� ������ ������';
		$this->register_email = '����� ������';
		$this->register_email_invalid = '.����� ������� ������ �����';
		$this->register_email_msg = '���� Quicksilver ��� ���� ������� ����� ����� ��������� ��';
		$this->register_email_msg2 = '������ �� ������ ��';
		$this->register_email_msg3 = '��� ��� �� ������ ���, �� ���� ���� ����� ������� ������:';
		$this->register_email_used = '����� ������� ������ ����� ��� ����.';
		$this->register_fields = '�� �� ����� �����.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = '��� ���� �� ����� ����� ������.';
		$this->register_image_invalid = '���� ����� ���� ����� �����, ����� ������ �� ����� ����� ������.';
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'You have been registered. An email has been sent to %s with information on how to activate your account. Your account will be limited until you activate it.'; //Translate
		$this->register_name_invalid = '��� ������ ���� ����.';
		$this->register_name_taken = '�� ���� ������ ��� ����.';
		$this->register_new_user = '�� ����� ������';
		$this->register_pass_invalid = ' ������ ������ �� �����. ���� ����� ����� ������ ������ ���� ������, ������, �� �����, �� ����� ������� ����� 5 ����� �����.';
		$this->register_pass_match = '������ ������ �� �����.';
		$this->register_passwd = '�����';
		$this->register_reg = '�����';
		$this->register_reging = '�����';
		$this->register_requested = 'Account activation request for:'; //Translate
		$this->register_tos = '���� �����';
		$this->register_tos_i_agree = '��� ����� ������ ��"�.';
		$this->register_tos_not_agree = '�� ����� ������.';
		$this->register_tos_read = '��� ��� �� ���� ������ �����';
	}

	function rssfeed()
	{
		$this->rssfeed_cannot_find_forum = '������ �� ����';
		$this->rssfeed_cannot_find_topic = '����� �� ����';
		$this->rssfeed_cannot_read_forum = '��� �� ������ ����� ����� ��';
		$this->rssfeed_cannot_read_topic = '��� �� ������ ����� ���� ��';
		$this->rssfeed_error = '�����';
		$this->rssfeed_forum = '�����:';
		$this->rssfeed_posted_by = '���� �"�';
		$this->rssfeed_topic = '����:';
	}

	function search()
	{
		$this->search_advanced = '�������� �������';
		$this->search_avatar = '������';
		$this->search_basic = '����� �����';
		$this->search_characters = '������� �����';
		$this->search_day = '���';
		$this->search_days = '����';
		$this->search_exact_name = '�� ������';
		$this->search_flood = '��� ��� ��� ��� ��� �����. <br /><br />�����, ����� ���� ���� ����� �����. %s ����� ����� ����';
		$this->search_for = '��� ���';
		$this->search_forum = '�����';
		$this->search_group = '�����';
		$this->search_guest = '����';
		$this->search_in = '��� �';
		$this->search_in_posts = '��� �� �������';
		$this->search_ip = 'IP'; //Translate
		$this->search_joined = '�����';
		$this->search_level = '���� ���';
		$this->search_match = '��� ��� ������';
		$this->search_matches = '������';
		$this->search_month = '����';
		$this->search_months = '������';
		$this->search_mysqldoc = 'MySQL �����';
		$this->search_newer = '���';
		$this->search_no_results = '�� ����� ������ ������';
		$this->search_no_words = '�� ����� ���� ����� ��� 3 �����, ���� ������, ������, ������. <br /><br />����� ����� ������� ������.';
		$this->search_offline = '���� ���� �� �����';
		$this->search_older = '���';
		$this->search_online = '���� ���� �����';
		$this->search_only_display = '��� �� �����';
		$this->search_partial_name = '�� ����';
		$this->search_post_icon = '���� ������';
		$this->search_posted_on = '����� �';
		$this->search_posts = '������';
		$this->search_posts_by = '�� ������� �"�';
		$this->search_regex = '��� �"� ����� ����';
		$this->search_regex_failed = '����� ������ ���� MySQL ������ ����� ����. ��� ��� ������';
		$this->search_relevance = '%d%% ������ �����:';
		$this->search_replies = '������';
		$this->search_result = '������ �����';
		$this->search_search = ' ��� ';
		$this->search_select_all = '��� ���';
		$this->search_show_posts = '��� ������ �������';
		$this->search_sound = '��� ��� ���';
		$this->search_starter = '�����';
		$this->search_than = '-�';
		$this->search_topic = '����';
		$this->search_unreg = '�� ����';
		$this->search_week = '����';
		$this->search_weeks = '������';
		$this->search_year = '���';
	}

	function settings()
	{
		$this->settings = '������';
		$this->settings_active = '������ ����� ������';
		$this->settings_allow = '����';
		$this->settings_antibot = '���� ����� �������';
		$this->settings_attach_ext = '����� ������� - ������ �����';
		$this->settings_attach_one_per = '��� �����. ��� ������.';
		$this->settings_avatar = '������ ������';
		$this->settings_avatar_flash = '������� ����';
		$this->settings_avatar_max_height = '������� ���� ������';
		$this->settings_avatar_max_width = '������� ���� �����';
		$this->settings_avatar_upload = '�������� ������ - ���� ���� �����.';
		$this->settings_basic = '����� ������ ���.';
		$this->settings_blank = '����� ���. </i>_blank<i> ����� �';
		$this->settings_board_enabled = '��� ����.';
		$this->settings_board_location = '����� ����';
		$this->settings_board_name = '�� ���';
		$this->settings_board_rss = 'RSS ������ ����';
		$this->settings_board_rssfeed_desc = 'RSS ����� ����';
		$this->settings_board_rssfeed_posts = 'RSS ���� ������� ������ �����';
		$this->settings_board_rssfeed_time = '��� ������ �����';
		$this->settings_board_rssfeed_title = 'RSS ����� ����';
		$this->settings_clickable = '���� ���� ������ �����';
		$this->settings_cookie = 'Cookie and Flood Settings'; //Translate
		$this->settings_cookie_domain = 'Cookie Domain'; //Translate
		$this->settings_cookie_path = 'Cookie ���� �';
		$this->settings_cookie_prefix = 'Cookie ������ �';
		$this->settings_cookie_secure = 'Cookie Security'; //Translate
		$this->settings_cookie_secured = 'Is your site SSL secured?'; //Translate
		$this->settings_cookie_time = 'Time to Remain Logged In'; //Translate
		$this->settings_db = '����� ������ �������';
		$this->settings_db_host = '���� ��� �������';
		$this->settings_db_leave_blank = '���� ��� �����';
		$this->settings_db_multiple = '������ ����� ������ �� ��� ������ ���.';
		$this->settings_db_name = '�� ��� �������';
		$this->settings_db_password = '����� ��� �������';
		$this->settings_db_port = '��� ������� Port';
		$this->settings_db_prefix = '������ �����';
		$this->settings_db_socket = '��� ������� Socket';
		$this->settings_db_username = '�� ����� ��� �������';
		$this->settings_debug_mode = 'Debug Mode'; //Translate
		$this->settings_default_lang = '��� ����� �����';
		$this->settings_default_no = '���� ����� �����';
		$this->settings_default_skin = '���� ����� �����';
		$this->settings_default_yes = '�� ����� �����';
		$this->settings_disabled = '������';
		$this->settings_disabled_notice = '����� ������';
		$this->settings_email = '������ ������';
		$this->settings_email_fake = '������ ����. �� ����� ����� ������ ����.';
		$this->settings_email_from = '������ ������';
		$this->settings_email_place1 = '��� ����� �';
		$this->settings_email_place2 = '����� �� ������ �� ������� ����';
		$this->settings_email_place3 = '�� ����� ������ �����';
		$this->settings_email_real = '���� ������ ������ ������.';
		$this->settings_email_reply = '������ ����� ������';
		$this->settings_email_smtp = 'SMTP ��� ����';
		$this->settings_email_valid = '���� ������ �� ��� ���';
		$this->settings_enabled = '�����';
		$this->settings_enabled_modules = '������� �������';
		$this->settings_foreign_link = '��� ����� ���';
		$this->settings_general = '������ ������';
		$this->settings_google_id = 'Google Analytics ID'; //Translate
		$this->settings_google_msg = 'Leave blank if you do not have an Analytics account, or if you do not want to track this site using Analytics.'; //Translate
		$this->settings_group_after = '����� ���� �����';
		$this->settings_hot_topic = '������ ������� ����';
		$this->settings_kilobytes = '����������';
		$this->settings_max_attach_size = '����� ������� - ���� ���� �����.';
		$this->settings_members = '������ ���';
		$this->settings_modname_only = '.php �� ����� ����. �� �����';
		$this->settings_new = 'New Setting'; //Translate
		$this->settings_new_add = 'Add Board Setting';
		$this->settings_new_added = 'New settings added.'; //Translate
		$this->settings_new_exists = 'That setting already exists. Choose another name for it.'; //Translate
		$this->settings_new_name = 'New setting name'; //Translate
		$this->settings_new_required = 'The new setting name is required.'; //Translate
		$this->settings_new_value = 'New setting value'; //Translate
		$this->settings_no_allow = '�� �����';
		$this->settings_nodata = '�� ���� ���� �������';
		$this->settings_one_per = '��� ��� ����';
		$this->settings_pixels = '�������';
		$this->settings_pm_flood = 'Personal Messenger Flood Control'; //Translate
		$this->settings_pm_min_time = '��� ������� ��� ������.';
		$this->settings_polls = '�����';
		$this->settings_polls_no = '������� ���� ������ ������ ���� ���� ������ �������';
		$this->settings_polls_yes = '������� ������ ������ ���� ���� ������ �������';
		$this->settings_post_flood = 'Post Flood Control'; //Translate
		$this->settings_post_min_time = '��� ������� ��� ������.';
		$this->settings_posts_topic = '������ ����� ���';
		$this->settings_search_flood = 'Search Flood Control'; //Translate
		$this->settings_search_min_time = '��� ������� ��� �������';
		$this->settings_server = '������ ���';
		$this->settings_server_gzip = 'GZIP �����';
		$this->settings_server_gzip_msg = '����� �� �������. ���� �� ���� ���� ������ �� ���.';
		$this->settings_server_maxload = '����� ��� ������';
		$this->settings_server_maxload_msg = '���� ��� ����� �� ����. ���� 0 �������.';
		$this->settings_server_timezone = '���� ��� ����';
		$this->settings_show_avatars = '��� �������';
		$this->settings_show_email = '��� ����� ������';
		$this->settings_show_emotes = '��� ���� ����';
		$this->settings_show_notice = '��� ������ ������';
		$this->settings_show_pm = '��� ������ ������';
		$this->settings_show_sigs = '��� ������';
		$this->settings_spider_agent = 'Spider User Agent'; //Translate
		$this->settings_spider_agent_msg = 'Enter all or part of the spider\'s unique HTTP USER AGENT.'; //Translate
		$this->settings_spider_enable = 'Enable Spider Display'; //Translate
		$this->settings_spider_enable_msg = 'Enable the names of search engine spiders on Active List.'; //Translate
		$this->settings_spider_name = 'Spider Name'; //Translate
		$this->settings_spider_name_msg = 'Enter the name that you wish to display for each of the above spiders on Active List. You need to place the spider\'s name on the same line as the spider\'s user agent above. For example, if you place \'googlebot\' on the third line for the user agent place \'Google\' on the third line for the Spider Name.'; //Translate
		$this->settings_timezone = '���� ���';
		$this->settings_topics_page = '������ ��� �����';
		$this->settings_tos = '���� �����';
		$this->settings_updated = '������� ������.';
	}

	function stats()
	{
		$this->stats = '���� �����������';
		$this->stats_post_by_month = '������ ��� ����';
		$this->stats_reg_by_month = '������ ��� ����';
	}

	function templates()
	{
		$this->add = 'HTML ���� �����';
		$this->add_in = '���� ����� �:';
		$this->all_fields_required = '�� ����� ���� ������ �����';
		$this->choose_css = 'Choose CSS Template'; //Translate
		$this->choose_set = '��� ������ ������';
		$this->choose_skin = '��� ����';
		$this->confirm1 = '��� ���� ����� ��';
		$this->confirm2 = '������ �';
		$this->create_new = '��� ���� ��� ���';
		$this->create_skin = '��� ����';
		$this->credit = '��� �� ���� �� ������ ����!';
		$this->css_edited = 'CSS file has been updated.'; //Translate
		$this->css_fioerr = 'The file could not be written to, you will need to CHMOD the file manually.'; //Translate
		$this->delete_template = '��� �����';
		$this->directory = '�������';
		$this->display_name = '�� �����';
		$this->edit_css = 'Edit CSS'; //Translate
		$this->edit_skin = '���� ����';
		$this->edit_templates = '���� ������';
		$this->export_done = '.Quicksilver ����� ���� �������� ������ �� �������� ��';
		$this->export_select = '��� ���� ������';
		$this->export_skin = '���� ����';
		$this->install_done = '����� ����� ������.';
		$this->install_exists1 = '����� ������';
		$this->install_exists2 = '��� �����.';
		$this->install_overwrite = '����';
		$this->install_skin = '���� ����';
		$this->menu_title = '��� �� ��� ������ ������';
		$this->no_file = 'No such file.'; //Translate
		$this->only_skin = '�� ���� ��� �����. �� ���� ���� ��.';
		$this->or_new = '�� ��� ����� ������ ���:';
		$this->select_skin = '��� ����';
		$this->select_skin_edit = '��� ���� ������';
		$this->select_skin_edit_done = '����� ���� ������.';
		$this->select_template = '��� �����';
		$this->skin_chmod = '�� ������� ����� ������� �����. ��� ����� �� ��� ������� ����� � 775.';
		$this->skin_created = '���� ����.';
		$this->skin_deleted = '����� ���� ������.';
		$this->skin_dir_name = '���� ������ �� ���� ��� �������.';
		$this->skin_dup = '���� �� �� ������� ���� ����. ������� ������� ����� �';
		$this->skin_name = '���� ����� �� ����.';
		$this->skin_none = '��� ������ ������ ������.';
		$this->skin_set = '����� ����';
		$this->skins_found = 'Quicksilver ������� ����� ����� �������� �������� ��';
		$this->template_about = '����� ������';
		$this->template_about2 = '������ �� ���� ���� �������� ���� ������. ������ ���� ������� �� ���� ���� ������� ������ � {�������}';
		$this->template_add = '����';
		$this->template_added = '����� �����.';
		$this->template_clear = '���';
		$this->template_confirm = '����� ������� �������. ��� ������ ����� �� ��������?';
		$this->template_description = '����� �����';
		$this->template_html = 'HTML �����';
		$this->template_name = '�� �����';
		$this->template_position = '����� �����';
		$this->template_set = '����� �����';
		$this->template_title = '����� �����';
		$this->template_universal = '������ �����������';
		$this->template_universal2 = '��� ����. $this ���� ������ ������� ������� ��� �����, ���� ������� ����� ������� ������ �����. ���� ������ �������� ��������';
		$this->template_updated = '����� ������.';
		$this->templates = '������';
		$this->temps_active = '���� ������� ������';
		$this->temps_admin = '<b>���� ���� ����������</b>';
		$this->temps_backup = 'AdminCP Database Backup'; //Translate
		$this->temps_ban = '���� ���� �������';
		$this->temps_board_index = '������ ���';
		$this->temps_censoring = '���� ���� ������ ��������';
		$this->temps_cp = '��� ���� ���';
		$this->temps_email = '��� ���� ����';
		$this->temps_emot_control = '���� ���� ����� ����';
		$this->temps_forum = '�������';
		$this->temps_forums = '���� ���� ��������';
		$this->temps_groups = '���� ���� �������';
		$this->temps_help = '����';
		$this->temps_login = '�����/����� ������';
		$this->temps_logs = '���� ���� ������� ������';
		$this->temps_main = '<b>��� ���������</b>';
		$this->temps_mass_mail = '���� ���� ������� ����� �����';
		$this->temps_member_control = '���� ���� ���� ���� ���';
		$this->temps_members = '����� �����';
		$this->temps_mod = '���� ������';
		$this->temps_newspost = 'News Posts'; //Translate
		$this->temps_pm = '����\'� ����';
		$this->temps_polls = '�����';
		$this->temps_post = '�����';
		$this->temps_printer = 'Printer-Friendly Topics'; //Translate
		$this->temps_profile = '����� �������';
		$this->temps_recent = '������ �������';
		$this->temps_register = '�����';
		$this->temps_rssfeed = 'RSS Feed'; //Translate
		$this->temps_search = '�����';
		$this->temps_settings = '���� ���� �������';
		$this->temps_templates = '���� ���� ����� ������';
		$this->temps_titles = '���� ���� ������� �����';
		$this->temps_topic_prune = '���� ���� ������ ������';
		$this->temps_topics = '������';
		$this->upgrade_skin = '���� ����';
		$this->upgrade_skin_already = '��� �����. ��� �� ����.';
		$this->upgrade_skin_detail = '��� ����� �������\' <br />�� ���� ����� �� ������ ���� ������ ������ ����� ��.';
		$this->upgrade_skin_upgraded = '����� �����.';
		$this->upgraded_templates = '������� ����� ����� �� ������';
	}

	function titles()
	{
		$this->titles_add = '���� ����� ���';
		$this->titles_added = '����� ��� �������.';
		$this->titles_control = '���� ����� ���';
		$this->titles_edit = '���� ����� ���';
		$this->titles_error = '�� ����� ����� ���� �� ������� ������';
		$this->titles_image = '�����';
		$this->titles_minpost = '������� ������';
		$this->titles_nodel_default = 'Removal of the default title has been disabled as it will break your board, please edit it instead.'; //Translate
		$this->titles_title = '�����';
	}

	function topic()
	{
		$this->topic_attached = '���� �����:';
		$this->topic_attached_downloads = '������';
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = '��� �� ������ ������ ���� ��';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = '���� �����';
		$this->topic_avatar = '������';
		$this->topic_bottom = '�� ������ �����';
		$this->topic_create_poll = '��� ��� ���';
		$this->topic_create_topic = '��� ���� ���';
		$this->topic_delete = '���';
		$this->topic_delete_post = '��� ����� ��';
		$this->topic_edit = '�����';
		$this->topic_edit_post = '���� ����� ��';
		$this->topic_edited = '%s �"� %s ����� ������� �';
		$this->topic_error = '�����';
		$this->topic_group = '�����';
		$this->topic_guest = '����';
		$this->topic_ip = 'IP'; //Translate
		$this->topic_joined = '����� �������';
		$this->topic_level = '��� �� �����';
		$this->topic_links_aim = '%s � AIM ��� �����';
		$this->topic_links_email = '%s � ������ ��� ';
		$this->topic_links_gtalk = '%s � GTalk ��� �����';
		$this->topic_links_icq = '%s � ICQ ��� �����';
		$this->topic_links_msn = '%s �� MSN ��� �������';
		$this->topic_links_pm = '%s � ����� ��� �����';
		$this->topic_links_web = '%s ��� ����/�� ��';
		$this->topic_links_yahoo = '%s � YAHOO ����\'� ��� ����� ��';
		$this->topic_lock = '���';
		$this->topic_locked = '���� ����';
		$this->topic_move = '����';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = '���� ���';
		$this->topic_no_newer = '��� ������ �����.';
		$this->topic_no_older = '��� ������ �����.';
		$this->topic_no_votes = '��� ������ ���� ��.';
		$this->topic_not_found = '����� �� ����';
		$this->topic_not_found_message = '�� ����� ������. ����� ���� �����,������ ����� �� ����� �����.';
		$this->topic_offline = '���� ���� �� �����';
		$this->topic_older = '����� ����';
		$this->topic_online = '���� ���� �����';
		$this->topic_options = '�������� �����';
		$this->topic_pages = '������';
		$this->topic_perm_view = '��� �� ������ ����� �������.';
		$this->topic_perm_view_guest = '��� �� ������ ����� �������. �� �����, ����� ����� �����.';
		$this->topic_pin = '���';
		$this->topic_posted = '�����';
		$this->topic_posts = '������';
		$this->topic_print = '��� ������';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = '���� ����';
		$this->topic_qr_open_emoticons = '��� ���� ���� ������';
		$this->topic_qr_open_mbcode = 'MBCode ���';
		$this->topic_quickreply = '����� ����� �����';
		$this->topic_quote = '���� ����� �� ����� ������ ��';
		$this->topic_reply = '���� �����';
		$this->topic_split = '�����';
		$this->topic_split_finish = '���� �� ��������';
		$this->topic_split_keep = '�� ����� ����� ��';
		$this->topic_split_move = '���� ����� ��';
		$this->topic_subscribe = '��� �� ���� ������� ������ ��';
		$this->topic_top = '���� ���� ���';
		$this->topic_unlock = '��� �����';
		$this->topic_unpin = '��� �����';
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = '�� ����';
		$this->topic_view = '���� ������';
		$this->topic_viewing = '���� ������';
		$this->topic_vote = '�����';
		$this->topic_vote_count_plur = '%d ������';
		$this->topic_vote_count_sing = '%d �����';
		$this->topic_votes = '������';
	}

	function universal()
	{
		$this->aim = 'AIM'; //Translate
		$this->based_on = '����� ��';
		$this->board_by = '�� ���';
		$this->charset = 'windows-1255';
		$this->continue = '����';
		$this->date_long = 'M j, Y'; //Translate
		$this->date_short = 'n/j/y'; //Translate
		$this->delete = '�����';
		$this->direction = 'rtl';
		$this->edit = '�����';
		$this->email = '������';
		$this->gmt = '[GMT] ';
		$this->gmt_nev1 = '[GMT-1:00] ';
		$this->gmt_nev10 = '[GMT-10:00] ';
		$this->gmt_nev11 = '[GMT-11:00] ';
		$this->gmt_nev12 = '[GMT-12:00] ';
		$this->gmt_nev2 = '[GMT-2:00] ';
		$this->gmt_nev3 = '[GMT-3:00] ';
		$this->gmt_nev35 = '[GMT-3:30] ';
		$this->gmt_nev4 = '[GMT-4:00] ';
		$this->gmt_nev5 = '[GMT-5:00] ';
		$this->gmt_nev6 = '[GMT-6:00] ';
		$this->gmt_nev7 = '[GMT-7:00] ';
		$this->gmt_nev8 = '[GMT-8:00] ';
		$this->gmt_nev9 = '[GMT-9:00] ';
		$this->gmt_pos1 = '[GMT+1:00] ';
		$this->gmt_pos10 = '[GMT+10:00] ';
		$this->gmt_pos11 = '[GMT+11:00] ';
		$this->gmt_pos12 = '[GMT+12:00] ';
		$this->gmt_pos2 = '[GMT+2:00] ';
		$this->gmt_pos3 = '[GMT+3:00] ';
		$this->gmt_pos35 = '[GMT+3:30] ';
		$this->gmt_pos4 = '[GMT+4:00] ';
		$this->gmt_pos45 = '[GMT+4:30] ';
		$this->gmt_pos5 = '[GMT+5:00] ';
		$this->gmt_pos55 = '[GMT+5:30] ';
		$this->gmt_pos6 = '[GMT+6:00] ';
		$this->gmt_pos7 = '[GMT+7:00] ';
		$this->gmt_pos8 = '[GMT+8:00] ';
		$this->gmt_pos9 = '[GMT+9:00] ';
		$this->gmt_pos95 = '[GMT+9:30] ';
		$this->gtalk = 'GT'; //Translate
		$this->icq = 'ICQ'; //Translate
		$this->msn = 'MSN'; //Translate
		$this->new_message = '����� ����';
		$this->new_poll = '��� ���';
		$this->new_topic = '����� ����';
		$this->no = '��';
		$this->powered = 'Powered by'; //Translate
		$this->private_message = 'PM'; //Translate
		$this->quote = '�����';
		$this->recount_forums = 'Recounted forums! Total topics: %d. Total posts: %d.'; //Translate
		$this->reply = '���';
		$this->seconds = '�����';
		$this->select_all = '��� ���';
		$this->sep_decimals = '.'; //Translate
		$this->sep_thousands = ','; //Translate
		$this->spoiler = '�������';
		$this->submit = '�����';
		$this->subscribe = '�����';
		$this->time_long = ', g:i a'; //Translate
		$this->time_only = 'g:i a'; //Translate
		$this->today = '����';
		$this->website = 'WWW'; //Translate
		$this->yahoo = 'Yahoo'; //Translate
		$this->yes = '��';
		$this->yesterday = '�����';
	}
}
?>
