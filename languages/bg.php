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
 * Bulgarian language module
 *
 * @author Vratza Online <info@vratza.com>
 * @since 1.1.0
 **/
class bg
{
	function active()
	{
		$this->active_last_action = 'Последно действие';
		$this->active_modules_active = 'Преглежда активните потребители';
		$this->active_modules_board = 'Преглежда Главната страница';
		$this->active_modules_cp = 'Използва контролния си панел';
		$this->active_modules_forum = 'Viewing a forum: %s'; //Translate
		$this->active_modules_help = 'Използва Помощ';
		$this->active_modules_login = 'Влиза/Излиза';
		$this->active_modules_members = 'Преглежда списъка с потребителите';
		$this->active_modules_mod = 'Модерира';
		$this->active_modules_pm = 'Използва Messenger';
		$this->active_modules_post = 'Пише мнение';
		$this->active_modules_printer = 'Printing a topic: %s'; //Translate
		$this->active_modules_profile = 'Viewing a profile: %s'; //Translate
		$this->active_modules_recent = 'Viewing recent posts'; //Translate
		$this->active_modules_search = 'Търси из форума';
		$this->active_modules_topic = 'Viewing a topic: %s'; //Translate
		$this->active_time = 'Време';
		$this->active_user = 'Потребител';
		$this->active_users = 'Потребители онлайн';
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
		$this->board_active_users = 'Потребители онлайн';
		$this->board_birthdays = 'Днес рожден ден има:';
		$this->board_bottom_page = 'Go to the bottom of the page'; //Translate
		$this->board_can_post = 'Можете да отговаряте в този форум';
		$this->board_can_topics = 'Можете да четете, но не можете да създавате нова тема в този форум.';
		$this->board_cant_post = 'Не можете да отговаряте в този форум.';
		$this->board_cant_topics = 'Не можете да четете и да пускате мнение в този форум.';
		$this->board_forum = 'Форум';
		$this->board_guests = 'Гости';
		$this->board_last_post = 'Последно мнение';
		$this->board_mark = 'Маркирайте мненията като прочетени';
		$this->board_mark1 = 'ВСИЧКИ мнения и форуми са маркирани като прочетени.';
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = 'Потребители';
		$this->board_message = '%s Съобщение';
		$this->board_most_online = 'The most users ever online was %d on %s.'; //Translate
		$this->board_nobday = 'Няма потребители с рожден ден днес.';
		$this->board_nobody = 'Няма регистрирани потребители онлайн.';
		$this->board_nopost = 'Няма мнения';
		$this->board_noview = 'Нямате разрешение да преглеждате този форум.';
		$this->board_regfirst = 'Нямате разрешение да преглеждате този форум, Ако се регистрирате, може да получите такова.';
		$this->board_replies = 'Отговори';
		$this->board_stats = 'Статистика';
		$this->board_stats_string = '%s users have registered. Welcome to our newest member, %s.<br />There are %s topics and %s replies for a total of %s posts.'; //Translate
		$this->board_top_page = 'Go to the top of the page'; //Translate
		$this->board_topics = 'Теми';
		$this->board_users = 'Потребители';
		$this->board_write_topics = 'Можете да четете и да пускате мнения в този форум.';
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
		$this->cp_aim = 'AIM потребителско име';
		$this->cp_already_member = 'Има регистриран потребител с email адреса, който си въвел.';
		$this->cp_apr = 'Април';
		$this->cp_aug = 'Август';
		$this->cp_avatar_current = 'Вашият текущ аватар';
		$this->cp_avatar_error = 'Грешка в аватара';
		$this->cp_avatar_must_select = 'Изберете аватар.';
		$this->cp_avatar_none = 'Няма да използвам аватар';
		$this->cp_avatar_pixels = 'пиксела';
		$this->cp_avatar_select = 'Избери аватар';
		$this->cp_avatar_size_height = 'Височината на аватара трябва да е между 1 и ';
		$this->cp_avatar_size_width = 'Широчината на аватара трябва да е между 1 и';
		$this->cp_avatar_upload = 'Качи аватар от компютъра си';
		$this->cp_avatar_upload_failed = 'Грешка при качване на аватар. Файлът, който се опитвате да добавите може би не съществува.';
		$this->cp_avatar_upload_not_image = 'Можете да добавяте картинки, които да използвате само за аватар.';
		$this->cp_avatar_upload_too_large = 'Аватарът, който искате е твърде голям. Максималният размер е %d KB.';
		$this->cp_avatar_url = 'URL  адрес за аватар';
		$this->cp_avatar_use = 'Използвай аватара, който си качил';
		$this->cp_bday = 'Рожден ден';
		$this->cp_been_updated = 'Профилът ти беше обновен успешно.';
		$this->cp_been_updated1 = 'Аватарът беше сменен успешно.';
		$this->cp_been_updated_prefs = 'Настройките бяха обновени успешно.';
		$this->cp_changing_pass = 'Редакция на парола';
		$this->cp_contact_pm = 'Позволяваш ли другите потребители да се свързват с теб посредством месинджър?';
		$this->cp_cp = 'Контролен панел';
		$this->cp_current_avatar = 'Сегашен аватар';
		$this->cp_current_time = 'В момента е %s.';
		$this->cp_custom_title = 'Custom Member Title'; //Translate
		$this->cp_custom_title2 = 'This is a privledge reserved for board administrators'; //Translate
		$this->cp_dec = 'Декември';
		$this->cp_editing_avatar = 'Редактиране на аватар';
		$this->cp_editing_profile = 'Редактиране на профил';
		$this->cp_email = 'Email'; //Translate
		$this->cp_email_form = 'Позволяваш ли на останалите потребители да се звързват с теб, посредтством email?';
		$this->cp_email_invaid = 'email адресът, кйто си въвел е невалиден.';
		$this->cp_err_avatar = 'Грешка при промяна на аватар.';
		$this->cp_err_updating = 'Грешка при промяна на профил';
		$this->cp_feb = 'Февруари';
		$this->cp_file_type = 'Аватарът, който си въвел не е валиден. Увери се, че си въвел правилно URL  адрес или, че форматът е  gif, jpg, или png.';
		$this->cp_format = 'Потребителско име';
		$this->cp_gtalk = 'GTalk Account'; //Translate
		$this->cp_header = 'Потребителски контролен панел';
		$this->cp_height = 'Височина';
		$this->cp_icq = 'ICQ номер';
		$this->cp_interest = 'Интереси';
		$this->cp_jan = 'Януари';
		$this->cp_july = 'Юли';
		$this->cp_june = 'Юни';
		$this->cp_label_edit_avatar = 'Редакция на аватар';
		$this->cp_label_edit_pass = 'Редакция на парола';
		$this->cp_label_edit_prefs = 'Редакция на настройки';
		$this->cp_label_edit_profile = 'Редакция на профил';
		$this->cp_label_edit_sig = 'Edit Signature'; //Translate
		$this->cp_label_edit_subs = 'Редакция на записването';
		$this->cp_language = 'Език';
		$this->cp_less_charac = 'Потребителското име трябва да е по-малко от 32 символа.';
		$this->cp_location = 'Местоположение';
		$this->cp_login_first = 'Трябва да влезете регистриран, за да може да използвате контролния си панел.';
		$this->cp_mar = 'Март';
		$this->cp_may = 'Май';
		$this->cp_msn = 'MSN Id';
		$this->cp_must_orig = 'Моля използвайте същото име.';
		$this->cp_new_notmatch = 'Паролите не съвпадат.';
		$this->cp_new_pass = 'Нова парола';
		$this->cp_no_flash = 'Flash аватари не са разрешени.';
		$this->cp_not_exist = 'дата, която сте въвели  (%s)е невалидна !';
		$this->cp_nov = 'Ноември';
		$this->cp_oct = 'Октомври';
		$this->cp_old_notmatch = 'Паролата, която сте въвели е грешна.';
		$this->cp_old_pass = 'Стара парола';
		$this->cp_pass_notvaid = 'Грешна парола.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = 'Промяна на настойки';
		$this->cp_preview_sig = 'Signature Preview:'; //Translate
		$this->cp_privacy = 'Privacy Options'; //Translate
		$this->cp_repeat_pass = 'Повтори паролата';
		$this->cp_sept = 'Септември';
		$this->cp_show_active = 'Show your activities when you are using the board?'; //Translate
		$this->cp_show_email = 'Покажи моя email?';
		$this->cp_signature = 'Подпис';
		$this->cp_size_max = 'Размерът на аватара е твърде голям. Максималният рарешен разме е  %s на %s пиксела.';
		$this->cp_skin = 'Board Skin'; //Translate
		$this->cp_sub_change = 'Changing Subscriptions'; //Translate
		$this->cp_sub_delete = 'Изтрий';
		$this->cp_sub_expire = 'Дата на изтичане';
		$this->cp_sub_name = 'Име';
		$this->cp_sub_no_params = 'Няма зададени параметри.';
		$this->cp_sub_success = 'Вече си записан %s.';
		$this->cp_sub_type = 'Тип на записване';
		$this->cp_sub_updated = 'Избраните записи за изтрити.';
		$this->cp_topic_option = 'Опции';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = 'Профилът е променен';
		$this->cp_updated1 = 'Аватрът е обновен';
		$this->cp_updated_prefs = 'Настройките с обновени';
		$this->cp_user_exists = 'Има потребител с такова потребителско име.';
		$this->cp_valided = 'Паролата беше променена.';
		$this->cp_view_avatar = 'Искаш ли да виждаш аватарите??';
		$this->cp_view_emoticon = 'Искаш ли да виждаш усмивките?';
		$this->cp_view_signature = 'Искаш ли да виждаш подписите?';
		$this->cp_welcome = 'Добре дошъл в твоя потребителски контролен панел. От тук можеш да настроииш своя акаунт. Моля, избери от опциите горе.';
		$this->cp_width = 'Широчина';
		$this->cp_www = 'Homepage'; //Translate
		$this->cp_yahoo = 'Yahoo Id';
		$this->cp_zone = 'Часова зона';
	}

	function email()
	{
		$this->email_blocked = 'Не можете да изпращте email на топзи потребител посредство формата.';
		$this->email_email = 'Email'; //Translate
		$this->email_msgtext = 'Email текст:';
		$this->email_no_fields = 'Върнете с еобратно и се уверете, че всички полета са попълнени.';
		$this->email_no_member = 'Няма намерени потребители с такова име';
		$this->email_no_perm = 'Нямате право да изпращате email през този форум.';
		$this->email_sent = 'Твоят email беше изпратен.';
		$this->email_subject = 'Тена:';
		$this->email_to = 'До:';
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
		$this->forum_by = 'На';
		$this->forum_can_post = 'Можете да отговаряте в този форум.';
		$this->forum_can_topics = 'Можете да разглеждате теми в този форум.';
		$this->forum_cant_post = 'Не можете да отговаряте в този форум.';
		$this->forum_cant_topics = 'Не можете да разглеждате теми в този форум.';
		$this->forum_dot = 'dot'; //Translate
		$this->forum_dot_detail = 'показва, че сте писали в този форум';
		$this->forum_forum = 'Форум';
		$this->forum_guest = 'Гост';
		$this->forum_hot = 'Гореща тема';
		$this->forum_icon = 'Икона на съобщението';
		$this->forum_jump = 'Иди на най-новото мнение';
		$this->forum_last = 'Последно мнение';
		$this->forum_locked = 'Заключена';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = 'Преместена';
		$this->forum_msg = '%s съобщение';
		$this->forum_new = 'Нови мнения';
		$this->forum_new_poll = 'Създай нова анкета';
		$this->forum_new_topic = 'Създай нова тема';
		$this->forum_no_topics = 'Няма теми в този форум.';
		$this->forum_noexist = 'Този форум не съществува.';
		$this->forum_nopost = 'Няма мнения';
		$this->forum_not = 'Няма';
		$this->forum_noview = 'Намате разрешение да преглеждате този форум.';
		$this->forum_pages = 'Страници';
		$this->forum_pinned = 'Забодена';
		$this->forum_pinned_topic = 'Забодена тема';
		$this->forum_poll = 'Анкета';
		$this->forum_regfirst = 'Нямате разрешение да преглеждате този форум, Ако се регистрирате, може да получите такова.';
		$this->forum_replies = 'Отговори';
		$this->forum_starter = 'Starter'; //Translate
		$this->forum_sub = 'Подфорум';
		$this->forum_sub_last_post = 'Последно мнение';
		$this->forum_sub_replies = 'Отговори';
		$this->forum_sub_topics = 'Теми';
		$this->forum_subscribe = 'Уведоми ме, когато някой напише ново мнение';
		$this->forum_topic = 'Тема';
		$this->forum_views = 'Прегледа';
		$this->forum_write_topics = 'Можете да пускате нова тема.';
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
		$this->help_available_files = 'Помощ';
		$this->help_confirm = 'Are you sure you want to delete'; //Translate
		$this->help_content = 'Article content'; //Translate
		$this->help_delete = 'Delete Help Article'; //Translate
		$this->help_deleted = 'Help Article Deleted.'; //Translate
		$this->help_edit = 'Edit Help Article'; //Translate
		$this->help_edited = 'Help article updated.'; //Translate
		$this->help_inserted = 'Article inserted into the database.'; //Translate
		$this->help_no_articles = 'No help articles were found in the database.'; //Translate
		$this->help_no_title = 'You can\'t create a help article without a title.'; //Translate
		$this->help_none = 'Няма help файлове';
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
		$this->login_cant_logged = 'You could not be logged in. Check to see that your user name and password are correct.<br /><br />They are case sensitive, so \'UsErNaMe\' is different from \'Username\'. Also, check to see that cookies are enabled in your browser.'; //Translate
		$this->login_cookies = 'Cookies трябва да са разрешени.';
		$this->login_forgot_pass = 'Forgot your password?'; //Translate
		$this->login_header = 'Влез';
		$this->login_logged = 'Не сте влезли.';
		$this->login_now_out = 'Излязохте успешно.';
		$this->login_out = 'Logging Out'; //Translate
		$this->login_pass = 'Парола';
		$this->login_pass_no_id = 'There is no member with the user name you entered.'; //Translate
		$this->login_pass_request = 'To complete the password reset, please click on the link sent to the email address associated with your account.'; //Translate
		$this->login_pass_reset = 'Reset Password'; //Translate
		$this->login_pass_sent = 'Your password has been reset. The new password has been sent to the email address associated with your account.'; //Translate
		$this->login_sure = 'Сигурен ли си, че искаш да излезеш \'%s\'?';
		$this->login_user = 'Потребителско име';
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
		$this->main_activate = 'Акаунта ти не е активиран.';
		$this->main_activate_resend = 'Изпрати отново Email за активация';
		$this->main_admincp = 'Администраторски контролен панел';
		$this->main_banned = 'Имаш забрана да влизаш във форум.';
		$this->main_code = 'Code'; //Translate
		$this->main_cp = 'Контролен панел';
		$this->main_full = 'Пълен';
		$this->main_help = 'help';
		$this->main_load = 'зареждане';
		$this->main_login = 'login';
		$this->main_logout = 'logout';
		$this->main_mark = 'mark all';
		$this->main_mark1 = 'Mark all topics as read'; //Translate
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = 'Много съжаляваме, но,  %s временно е недостъпен, защото има има голям брой потребители онлайн.';
		$this->main_members = 'потребители';
		$this->main_messenger = 'messenger';
		$this->main_new = 'нов';
		$this->main_next = 'Следваща';
		$this->main_prev = 'Предишна';
		$this->main_queries = 'queries'; //Translate
		$this->main_quote = 'Цитат';
		$this->main_recent = 'recent posts';
		$this->main_recent1 = 'View recent topics since your last visit'; //Translate
		$this->main_register = 'Регистрирай се';
		$this->main_reminder = 'Напомняне';
		$this->main_reminder_closed = 'Форумът е затворен.';
		$this->main_said = 'каза';
		$this->main_search = 'Търсене';
		$this->main_topics_new = 'Има нови мнения.';
		$this->main_topics_old = 'Няма нови мнения.';
		$this->main_welcome = 'Добре дошъл';
		$this->main_welcome_guest = 'Добре дошъл!';
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
		$this->mc_user_signature = 'Подпис';
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
		$this->members_all = 'всички';
		$this->members_email = 'Email'; //Translate
		$this->members_email_member = 'Изпрати Email на този потребител';
		$this->members_group = 'Група';
		$this->members_joined = 'Присъединил се на';
		$this->members_list = 'Списък с потребителите';
		$this->members_member = 'Потребител';
		$this->members_pm = 'ЛС';
		$this->members_posts = 'Мнения';
		$this->members_send_pm = 'Изпрати лично съобщение на този потребител';
		$this->members_title = 'Заглавие';
		$this->members_vist_www = 'Посети страницата на този потребител\'';
		$this->members_www = 'Web Site'; //Translate
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Сигурен ли си, че искаш да изтриеш това мнение?';
		$this->mod_confirm_topic_delete = 'Сигурен ли си, че искаш да изтриеш тази тема?';
		$this->mod_error_first_post = 'Не можеш да изтриеш първото мнение в тема.';
		$this->mod_error_move_category = 'Не можеш да преместиш тема в друга категория.';
		$this->mod_error_move_create = 'You do not have permission to move topics to that forum.'; //Translate
		$this->mod_error_move_forum = 'Не можеш да преместиш тема във форум, който не съществува.';
		$this->mod_error_move_global = 'You cannot move a global topic. Edit the topic before moving it.'; //Translate
		$this->mod_error_move_same = 'Не можеш да преместиш тема във форум, в който тя вече същестува.';
		$this->mod_label_controls = 'Moderator Controls'; //Translate
		$this->mod_label_description = 'Описание';
		$this->mod_label_emoticon = 'Превърни емотиконите в картинки?';
		$this->mod_label_global = 'Global Topic'; //Translate
		$this->mod_label_mbcode = 'Format MbCode?'; //Translate
		$this->mod_label_move_to = 'Премести в';
		$this->mod_label_options = 'Опции';
		$this->mod_label_post_delete = 'Изтрий мнение';
		$this->mod_label_post_edit = 'Редактирай мнение';
		$this->mod_label_post_icon = 'Post Icon'; //Translate
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = 'Заглавие';
		$this->mod_label_title_original = 'Original Title'; //Translate
		$this->mod_label_title_split = 'Split Title'; //Translate
		$this->mod_label_topic_delete = 'Изтрий тема';
		$this->mod_label_topic_edit = 'Редактирай тема';
		$this->mod_label_topic_lock = 'Заключи тема';
		$this->mod_label_topic_move = 'Премести тема';
		$this->mod_label_topic_move_complete = 'Изцяло прехвърли темата в нов форум';
		$this->mod_label_topic_move_link = 'Прехвърли темата в нов форум и остави линк към нея в стария.';
		$this->mod_label_topic_pin = 'Закована тема';
		$this->mod_label_topic_split = 'Split Topic'; //Translate
		$this->mod_missing_post = 'Няма таково мнение.';
		$this->mod_missing_topic = 'Няма такава тема.';
		$this->mod_no_action = 'Трябва да избереш действие.';
		$this->mod_no_post = 'Трябва да избереш мнение .';
		$this->mod_no_topic = 'Трябва да избереш тема.';
		$this->mod_perm_post_delete = 'Нямаш разрешение да изтриеш това мнение.';
		$this->mod_perm_post_edit = 'Нямаш разрешение да редактираш това мнение.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = 'Нямаш разрешение да изтриеш тази тема.';
		$this->mod_perm_topic_edit = 'Нямаш разрешение да редактираш това мнение.';
		$this->mod_perm_topic_lock = 'Нямаш разрешение да заключиш тази тема.';
		$this->mod_perm_topic_move = 'Нямаш разрешение да преместваш тази тема.';
		$this->mod_perm_topic_pin = 'Нямаш разрешение да заковаваш теми.';
		$this->mod_perm_topic_split = 'You do not have permission to split this topic.'; //Translate
		$this->mod_perm_topic_unlock = 'Нямаш разрешение да отключваш темата.';
		$this->mod_perm_topic_unpin = 'нямаш разрешение да откачаш темата.';
		$this->mod_success_post_delete = 'Мнението беше успешно изтрито.';
		$this->mod_success_post_edit = 'Мнението беше успешно редактирано.';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = 'The topic was successfully split.'; //Translate
		$this->mod_success_topic_delete = 'Темата беше успешно изтрита.';
		$this->mod_success_topic_edit = 'Темата беше успешно изтрита.';
		$this->mod_success_topic_move = 'Темата беше успешно преместена в нов форум.';
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
		$this->pm_cant_del = 'Нямате разрешение да изтриете това съобщение.';
		$this->pm_delallmsg = 'Изтрий всички съобщения';
		$this->pm_delete = 'Изтрий';
		$this->pm_delete_selected = 'Delete Selected Messages'; //Translate
		$this->pm_deleted = 'Съобщението е изтрито.';
		$this->pm_deleted_all = 'Съобщенията са изтрити.';
		$this->pm_error = 'There were problems sending your message to some of the recipients.<br /><br />The following members do not exist: %s<br /><br />The following members are not accepting personal messages: %s'; //Translate
		$this->pm_fields = 'Съобщението не може да бъде изпратено.';
		$this->pm_flood = 'You have sent a message in the past %s seconds, and you may not send another right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->pm_folder_inbox = 'Inbox'; //Translate
		$this->pm_folder_new = '%s нови';
		$this->pm_folder_sentbox = 'Sent';
		$this->pm_from = 'От';
		$this->pm_group = 'Група';
		$this->pm_guest = 'Тъй като си гост, не можеш да използваш месинджъра. Влез или се регистрирай.';
		$this->pm_joined = 'Присъединил се на';
		$this->pm_messenger = 'Messenger'; //Translate
		$this->pm_msgtext = 'текст на съобщението';
		$this->pm_multiple = 'Separate multiple recipients with ;'; //Translate
		$this->pm_no_folder = 'Трябва да избереш папка.';
		$this->pm_no_member = 'Няма намерен такъв потребител.';
		$this->pm_no_number = 'Не е намерено такова съобщение.';
		$this->pm_no_title = 'Няма тема';
		$this->pm_nomsg = 'Няма съобщения в тази папка.';
		$this->pm_noview = 'Нямате разрешение да видите тези съобщения.';
		$this->pm_offline = 'This member is currently offline'; //Translate
		$this->pm_online = 'This member is currently online'; //Translate
		$this->pm_personal = 'Personal Messenger'; //Translate
		$this->pm_personal_msging = 'Personal Messaging'; //Translate
		$this->pm_pm = 'ЛС';
		$this->pm_posts = 'Мнения';
		$this->pm_preview = 'Preview'; //Translate
		$this->pm_recipients = 'Recipients'; //Translate
		$this->pm_reply = 'Отговори';
		$this->pm_send = 'Изпрати';
		$this->pm_sendamsg = 'Изпрати съобщение';
		$this->pm_sendingpm = 'Изпрати ЛС';
		$this->pm_sendon = 'Изпратено';
		$this->pm_success = 'Съобщението е изпратено успешно.';
		$this->pm_sure_del = 'Сигурен ли си, че искаш да изтриеш това съобщение?';
		$this->pm_sure_delall = 'Сигурен ли си, че искаш да изтриеш всички съощения в тази папка?';
		$this->pm_title = 'Заглавие';
		$this->pm_to = 'До';
	}

	function post()
	{
		$this->post_attach = 'Прикачени файлове';
		$this->post_attach_add = 'Добави прикачен файл';
		$this->post_attach_disrupt = 'Добавянето или изтриването на прикачени файлове няма да попречи на писането на мнение.';
		$this->post_attach_failed = 'Прикачването на файл беше неуспешно.';
		$this->post_attach_not_allowed = 'You cannot attach files of that type.'; //Translate
		$this->post_attach_remove = 'Изтрий прикачения файл';
		$this->post_attach_too_large = 'The specified file is too large. The maximum size is %d KB.'; //Translate
		$this->post_cant_create = 'Ти си гост  и нямаш право да пускаш мнение';
		$this->post_cant_create1 = 'Нямаш право да пускаш нова тема.';
		$this->post_cant_enter = 'Гласът ти не беше приет. Или си гласувал вече за тази анкета или нямаш право да гласуваш в нея.';
		$this->post_cant_poll = 'Ти си гост и нямаш право да пускаш нова анкета.';
		$this->post_cant_poll1 = 'You do not have permission to create polls.'; //Translate
		$this->post_cant_reply = 'Нямаш разрешение да пускаш нова тема в този форум.';
		$this->post_cant_reply1 = 'Ти си гост и нямаш право да отговаряш';
		$this->post_cant_reply2 = 'Ти си гост и нямаш право да отговаряш в темите.';
		$this->post_closed = 'Тази тема е затворена.';
		$this->post_create_poll = 'Създай анкета';
		$this->post_create_topic = 'Напиши тема';
		$this->post_creating = 'Писане на тема';
		$this->post_creating_poll = 'Създаване на анкета';
		$this->post_flood = 'Написал си съобщение преди  %s секунди, не можеш да пуснеш ново толкова скоро.<br /><br />Опитай след няколко секунди.';
		$this->post_guest = 'Гост';
		$this->post_icon = 'Икона на съобщението';
		$this->post_last_five = 'Последните 5 мнения в обратен ред';
		$this->post_length = 'Провери дължината';
		$this->post_msg = 'Съобщение';
		$this->post_must_msg = 'Трябва да напишеш съобщение, когато пускаш нова тема.';
		$this->post_must_options = 'Трябва да изброиш отговори, когато пускаш нова анкета.';
		$this->post_must_title = 'трябва да напиешеш заглавие, когато пускаш нова тема.';
		$this->post_new_poll = 'Нова анкета';
		$this->post_new_topic = 'Нова тема';
		$this->post_no_forum = 'Няма такъв форум.';
		$this->post_no_topic = 'Няма избрана тема.';
		$this->post_no_vote = 'Трябва да избереш отговор, за да гласуваш.';
		$this->post_option_emoticons = 'Превърни емотиконите в картинки?';
		$this->post_option_global = 'Make this topic global?'; //Translate
		$this->post_option_mbcode = 'Format MbCode?'; //Translate
		$this->post_optional = 'optional'; //Translate
		$this->post_options = 'Опции';
		$this->post_poll_options = 'Опции на анкетата';
		$this->post_poll_row = 'По един на ред';
		$this->post_posted = 'Пуснат на';
		$this->post_posting = 'Мнение';
		$this->post_preview = 'Preview'; //Translate
		$this->post_reply = 'Отговор';
		$this->post_reply_topic = 'Отговор на темата';
		$this->post_replying = 'Отговори на темата';
		$this->post_replying1 = 'Отговаря';
		$this->post_too_many_options = 'Трава д аима между два и %d отговора на анкета.';
		$this->post_topic_detail = 'Описание на темата';
		$this->post_topic_title = 'Заглавие на темата';
		$this->post_view_topic = 'Виж цялата тема';
		$this->post_voting = 'Гласуване';
	}

	function printer()
	{
		$this->printer_back = 'Обратно';
		$this->printer_not_found = 'не може да бъде намерена такава тема.';
		$this->printer_not_found_title = 'Не е намерена темата';
		$this->printer_perm_topics = 'Нямаш разрешение да видиш тази тема.';
		$this->printer_perm_topics_guest = 'Нямаш разрешение да видиш тази тема.';
		$this->printer_posted_on = 'Пусната на';
		$this->printer_send = 'Изпринтирай';
	}

	function profile()
	{
		$this->profile_aim_sn = 'AIM потребителско име';
		$this->profile_av_sign = 'Аватар и подпис';
		$this->profile_avatar = 'Аватар';
		$this->profile_bday = 'Рожден ден';
		$this->profile_contact = 'Контакт';
		$this->profile_email_address = 'Email адрес';
		$this->profile_fav = 'Любим форум';
		$this->profile_fav_forum = '%s (%d%% of this member\'s posts)'; //Translate
		$this->profile_gtalk = 'GTalk Account'; //Translate
		$this->profile_icq_uin = 'ICQ номер';
		$this->profile_info = 'Информация';
		$this->profile_interest = 'Интреси';
		$this->profile_joined = 'Joined'; //Translate
		$this->profile_last_post = 'Последно мнение';
		$this->profile_list = 'Списък с потребители';
		$this->profile_location = 'Място';
		$this->profile_member = 'Потребителска група';
		$this->profile_member_title = 'Ранг на потребителя';
		$this->profile_msn = 'MSN Id';
		$this->profile_must_user = 'трябва да въведеш потребителско име, за да видиш профила.';
		$this->profile_no_member = 'Няма такъв потребител.';
		$this->profile_none = '[ Няма ]';
		$this->profile_not_post = 'не е писал мнение все още.';
		$this->profile_offline = 'This member is currently offline'; //Translate
		$this->profile_online = 'This member is currently online'; //Translate
		$this->profile_pm = 'Private Messages'; //Translate
		$this->profile_postcount = '%s total, %s per day'; //Translate
		$this->profile_posts = 'Мнения';
		$this->profile_private = '[ Скрит ]';
		$this->profile_profile = 'Профил';
		$this->profile_signature = 'Подпис';
		$this->profile_unkown = '[ Непознат ]';
		$this->profile_view_profile = 'Преглежда профил';
		$this->profile_www = 'Homepage'; //Translate
		$this->profile_yahoo = 'Yahoo Id';
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
		$this->recent_by = 'На';
		$this->recent_can_post = 'Можете да отговаряте в този форум.';
		$this->recent_can_topics = 'Можете да разглеждате теми в този форум.';
		$this->recent_cant_post = 'Не можете да отговаряте в този форум.';
		$this->recent_cant_topics = 'Не можете да разглеждате теми в този форум.';
		$this->recent_dot = 'dot'; //Translate
		$this->recent_dot_detail = 'показва, че сте писали в този форум';
		$this->recent_forum = 'Форум';
		$this->recent_guest = 'Гост';
		$this->recent_hot = 'Гореща тема';
		$this->recent_icon = 'Икона на съобщението';
		$this->recent_jump = 'Иди на най-новото мнение';
		$this->recent_last = 'Последно мнение';
		$this->recent_locked = 'Заключена';
		$this->recent_moved = 'Преместена';
		$this->recent_msg = '%s съобщение';
		$this->recent_new = 'Нови мнения';
		$this->recent_new_poll = 'Създай нова анкета';
		$this->recent_new_topic = 'Създай нова тема';
		$this->recent_no_topics = 'Няма теми в този форум.';
		$this->recent_noexist = 'Този форум не съществува.';
		$this->recent_nopost = 'Няма мнения';
		$this->recent_not = 'Няма';
		$this->recent_noview = 'Намате разрешение да преглеждате този форум.';
		$this->recent_pages = 'Страници';
		$this->recent_pinned = 'Забодена';
		$this->recent_pinned_topic = 'Забодена тема';
		$this->recent_poll = 'Анкета';
		$this->recent_regfirst = 'Нямате разрешение да преглеждате този форум, Ако се регистрирате, може да получите такова.';
		$this->recent_replies = 'Отговори';
		$this->recent_starter = 'Starter'; //Translate
		$this->recent_sub = 'Подфорум';
		$this->recent_sub_last_post = 'Последно мнение';
		$this->recent_sub_replies = 'Отговори';
		$this->recent_sub_topics = 'Теми';
		$this->recent_subscribe = 'Уведоми ме, когато някой напише ново мнение';
		$this->recent_topic = 'Тема';
		$this->recent_views = 'Прегледа';
		$this->recent_write_topics = 'Можете да пускате нова тема.';
	}

	function register()
	{
		$this->register_activated = 'Акаунта беше активиран!';
		$this->register_activating = 'Активиране на акаунт';
		$this->register_activation_error = 'Има грешка при активиране на акаунта. Провери дали това е пълния URL адрес от email-а, който получи. Ако проблемът продължи, моля свържи се с администратора на форума.';
		$this->register_confirm_passwd = 'Потвърди парола';
		$this->register_done = 'Регистрира се успешно, можеш да влезеш.';
		$this->register_email = 'Email адрес';
		$this->register_email_invalid = 'email адресът, който въведе е неуспешен.';
		$this->register_email_msg = 'This is an automated email generated by Quicksilver Forums, and sent to you in order'; //Translate
		$this->register_email_msg2 = 'for you to activate your account with'; //Translate
		$this->register_email_msg3 = 'Please click the following link, or paste it in to your web browser:'; //Translate
		$this->register_email_used = 'Има регистриран потребител с email адреса, който си въвел.';
		$this->register_fields = 'Не всички задължителни полета са попълнени.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = 'Please type the text shown in the image.'; //Translate
		$this->register_image_invalid = 'To verify you are a human registrant, you must type the text as shown in the image.'; //Translate
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'You have been registered. An email has been sent to %s with information on how to activate your account. Your account will be limited until you activate it.'; //Translate
		$this->register_name_invalid = 'Името е твърде дълго.';
		$this->register_name_taken = 'Има регистриран потребител с това име.';
		$this->register_new_user = 'Желано потребителско име';
		$this->register_pass_invalid = 'невалидна парола. Паролата трябва да е поне 5 симовла дължина.';
		$this->register_pass_match = 'паролите не съвпадат.';
		$this->register_passwd = 'Парола';
		$this->register_reg = 'Регистрирай';
		$this->register_reging = 'Регистриране';
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
		$this->search_advanced = 'Разширени опции';
		$this->search_avatar = 'Avatar'; //Translate
		$this->search_basic = 'Основно търсене';
		$this->search_characters = 'Символите в мнение';
		$this->search_day = 'ден';
		$this->search_days = 'дни';
		$this->search_exact_name = 'точно съвпадение';
		$this->search_flood = 'You have searched in the past %s seconds, and you may not search right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->search_for = 'Търсене за';
		$this->search_forum = 'Форум';
		$this->search_group = 'Group'; //Translate
		$this->search_guest = 'Гост';
		$this->search_in = 'Търсене в';
		$this->search_in_posts = 'Търси само в мнения';
		$this->search_ip = 'IP'; //Translate
		$this->search_joined = 'Присъединил се на';
		$this->search_level = 'Member Level'; //Translate
		$this->search_match = 'Търсене по съвпадение';
		$this->search_matches = 'съвпадение';
		$this->search_month = 'месец';
		$this->search_months = 'месеци';
		$this->search_mysqldoc = 'MySQL Documentation'; //Translate
		$this->search_newer = 'по-нови';
		$this->search_no_results = 'Няма резултати от зададеното търсене.';
		$this->search_no_words = 'Трябва да зададеш думи за търсене.<br /><br />Всяка дума трябва да е с най-малко три символа.';
		$this->search_offline = 'This member is currently offline'; //Translate
		$this->search_older = 'по-стари';
		$this->search_online = 'This member is currently online'; //Translate
		$this->search_only_display = 'Покажи само първото';
		$this->search_partial_name = 'частично';
		$this->search_post_icon = 'Икона на мнение';
		$this->search_posted_on = 'Пуснато на';
		$this->search_posts = 'Мнения';
		$this->search_posts_by = 'Само в съобщения на';
		$this->search_regex = 'Търсене в обичайни изрази';
		$this->search_regex_failed = 'Your regular expression failed. Please see the MySQL documentation for regular expression help.'; //Translate
		$this->search_relevance = 'Връзка в мнение: %d%%';
		$this->search_replies = 'Мнения';
		$this->search_result = 'Резултати от търсене';
		$this->search_search = 'Търси';
		$this->search_select_all = 'Избери всички';
		$this->search_show_posts = 'Покажи мненията, които съвпадат';
		$this->search_sound = 'Търсене по смисъл';
		$this->search_starter = 'Започващ';
		$this->search_than = 'than'; //Translate
		$this->search_topic = 'Тема';
		$this->search_unreg = 'Unregistered'; //Translate
		$this->search_week = 'седмица';
		$this->search_weeks = 'седмици';
		$this->search_year = 'година';
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
		$this->topic_attached = 'Прикачи фай:';
		$this->topic_attached_downloads = 'downloads';
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = 'Нямаш разрешение да свалиш този файл.';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = 'Прикачен файл';
		$this->topic_avatar = 'Avatar'; //Translate
		$this->topic_bottom = 'Go to the bottom of the page'; //Translate
		$this->topic_create_poll = 'Създай нова анкета';
		$this->topic_create_topic = 'Създай нова тема';
		$this->topic_delete = 'Изтрий';
		$this->topic_delete_post = 'Изтрий това мнение';
		$this->topic_edit = 'Редактирай';
		$this->topic_edit_post = 'Редактирай това мнение';
		$this->topic_edited = 'Последна редакция на %s от %s';
		$this->topic_error = 'Грешка';
		$this->topic_group = 'Група';
		$this->topic_guest = 'Гост';
		$this->topic_ip = 'IP'; //Translate
		$this->topic_joined = 'Присъединил се на';
		$this->topic_level = 'Ниво на потребителя';
		$this->topic_links_aim = 'Изпрати AIM съобщение на %s';
		$this->topic_links_email = 'Изпрати email на %s';
		$this->topic_links_gtalk = 'Send a GTalk message to %s'; //Translate
		$this->topic_links_icq = 'Изпрати  ICQ съобщение на %s';
		$this->topic_links_msn = 'Виж %s\'s MSN профила на потребителя';
		$this->topic_links_pm = 'Изпрати лично съобщение на %s';
		$this->topic_links_web = 'Посети страницата на потребителя %s\'';
		$this->topic_links_yahoo = 'изпрати съобщение на %s през Yahoo! Messenger';
		$this->topic_lock = 'Заключи';
		$this->topic_locked = 'Темата е заключена';
		$this->topic_move = 'Премести';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = 'Newer Topic'; //Translate
		$this->topic_no_newer = 'There is no newer topic.'; //Translate
		$this->topic_no_older = 'There is no older topic.'; //Translate
		$this->topic_no_votes = 'Няма гласове за тази анкета.';
		$this->topic_not_found = 'Няма намерена тема';
		$this->topic_not_found_message = 'Няма такава тема.';
		$this->topic_offline = 'This member is currently offline'; //Translate
		$this->topic_older = 'Older Topic'; //Translate
		$this->topic_online = 'This member is currently online'; //Translate
		$this->topic_options = 'Опция на темата';
		$this->topic_pages = 'страници';
		$this->topic_perm_view = 'Нямаш разрешение да преглеждаш тази тема.';
		$this->topic_perm_view_guest = 'Нямаш разрешение да преглеждаш тази тема.';
		$this->topic_pin = 'Закови';
		$this->topic_posted = 'Posted'; //Translate
		$this->topic_posts = 'Мнения';
		$this->topic_print = 'Виж във версия за принтиране';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'Emoticons'; //Translate
		$this->topic_qr_open_emoticons = 'Open Clickable Emoticons'; //Translate
		$this->topic_qr_open_mbcode = 'Open MBCode'; //Translate
		$this->topic_quickreply = 'Quick Reply'; //Translate
		$this->topic_quote = 'Отговори с цитат от това мнение';
		$this->topic_reply = 'Отговори на темата';
		$this->topic_split = 'Split'; //Translate
		$this->topic_split_finish = 'Finish All Splitting'; //Translate
		$this->topic_split_keep = 'Do not move this post'; //Translate
		$this->topic_split_move = 'Move this post'; //Translate
		$this->topic_subscribe = 'Уведоми ме, когато някой отговори по темата';
		$this->topic_top = 'Go to the top of the page'; //Translate
		$this->topic_unlock = 'Отключи';
		$this->topic_unpin = 'Освободи';
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = 'Нерегистриран';
		$this->topic_view = 'Виж резултати';
		$this->topic_viewing = 'Виж тема';
		$this->topic_vote = 'Гласувай';
		$this->topic_vote_count_plur = '%d гласа';
		$this->topic_vote_count_sing = '%d глас';
		$this->topic_votes = 'Гласове';
	}

	function universal()
	{
		$this->aim = 'AIM'; //Translate
		$this->based_on = 'based on';
		$this->board_by = 'От';
		$this->charset = 'windows-1251';
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
		$this->sep_decimals = '.'; //Translate
		$this->sep_thousands = ','; //Translate
		$this->spoiler = 'Spoiler'; //Translate
		$this->submit = 'Изпрати';
		$this->subscribe = 'Subscribe'; //Translate
		$this->time_long = ', g:i a'; //Translate
		$this->time_only = 'g:i a'; //Translate
		$this->today = 'Today'; //Translate
		$this->website = 'WWW'; //Translate
		$this->yahoo = 'Yahoo'; //Translate
		$this->yes = 'Yes'; //Translate
		$this->yesterday = 'Yesterday'; //Translate
	}
}
?>
