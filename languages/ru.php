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
		$this->active_last_action = 'Последнее действие';
		$this->active_modules_active = 'Просматривает список активных пользователей';
		$this->active_modules_board = 'Сидит на главной';
		$this->active_modules_cp = 'Лазит в контрольной панели';
		$this->active_modules_forum = 'Просматривает форум: %s';
		$this->active_modules_help = 'Читает хелпы';
		$this->active_modules_login = 'Логинится';
		$this->active_modules_members = 'Смотрит список пользователей';
		$this->active_modules_mod = 'Модерирует';
		$this->active_modules_pm = 'Пишет приватное сообщение';
		$this->active_modules_post = 'Пишет сообщение';
		$this->active_modules_printer = 'Печатает тему: %s';
		$this->active_modules_profile = 'Смотрит профиль: %s';
		$this->active_modules_recent = 'Viewing recent posts'; //Translate
		$this->active_modules_search = 'Ищет';
		$this->active_modules_topic = 'Смотрит тему: %s';
		$this->active_time = 'Время';
		$this->active_user = 'Пользователь';
		$this->active_users = 'Активные пользователи';
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
		$this->board_active_users = 'Активные пользователи';
		$this->board_birthdays = 'Сегодняшние дни рождения';
		$this->board_bottom_page = 'Go to the bottom of the page'; //Translate
		$this->board_can_post = 'Ты можешь отвечать в этом форуме.';
		$this->board_can_topics = 'Ты можешь читать, но не создавать темы в этом форуме.';
		$this->board_cant_post = 'Ты не можешь отвечать в этом форуме.';
		$this->board_cant_topics = 'Ты не можешь читать или создавать темы в этом форуме.';
		$this->board_forum = 'Форум';
		$this->board_guests = 'гости';
		$this->board_last_post = 'Последнее сообщение';
		$this->board_mark = 'Отметить все сообщения как прочитанные';
		$this->board_mark1 = 'Все сообщения и форумы были отмечены как прочитанные.';
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = 'пользователи';
		$this->board_message = '%s сообщение';
		$this->board_most_online = 'Максимальное число пользователей на форуме -  %d  было %s.';
		$this->board_nobday = 'Сегодня нет дней рождений членов форума.';
		$this->board_nobody = 'Нету никого онлайн.';
		$this->board_nopost = 'Нет сообщений';
		$this->board_noview = 'У тебя нет прав просматривать эти форумы.';
		$this->board_regfirst = 'Пока ты не зарегистрирован, ты не можешь попасть на форумы.';
		$this->board_replies = 'Ответов';
		$this->board_stats = 'Статистика';
		$this->board_stats_string = '%s пользователей зарегистрировано. Приветствуем нового пользователя, %s.<br />Всего %s тем и %s ответов в %s сообщениях.';
		$this->board_top_page = 'Go to the top of the page'; //Translate
		$this->board_topics = 'Тем';
		$this->board_users = 'пользователь(-ей)';
		$this->board_write_topics = 'Ты можешь читать и создавать темы в этом форуме.';
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
		$this->cp_aim = 'Имя в AIM';
		$this->cp_already_member = 'Введенный адрес уже используется одним из регистрированных пользователей.';
		$this->cp_apr = 'Апрель';
		$this->cp_aug = 'Август';
		$this->cp_avatar_current = 'Твоя текущая аватара';
		$this->cp_avatar_error = 'Ошибка при работе с аватарой';
		$this->cp_avatar_must_select = 'Ты должен выбрать аватару.';
		$this->cp_avatar_none = 'Не ипользовать аватару';
		$this->cp_avatar_pixels = 'пикселов';
		$this->cp_avatar_select = 'Выбери аватару';
		$this->cp_avatar_size_height = 'Высота аватары должна быть между 1 и';
		$this->cp_avatar_size_width = 'Ширина аватары должна быть между 1 и';
		$this->cp_avatar_upload = 'Загрузить аватару с диска';
		$this->cp_avatar_upload_failed = 'Ошибка при загрузке аватары. Возможно, не существует файл, который ты указал.';
		$this->cp_avatar_upload_not_image = 'Ты можешь только загрузить картинку в качестве своей аватары.';
		$this->cp_avatar_upload_too_large = 'Выбранная аватара слишком большая. Максимальный разме - %d килобайт.';
		$this->cp_avatar_url = 'Укажи URL к своей аватаре';
		$this->cp_avatar_use = 'Использовать загруженную аватару';
		$this->cp_bday = 'День рождения';
		$this->cp_been_updated = 'Твой профиль был обновлен.';
		$this->cp_been_updated1 = 'Твоя автара была обновлена.';
		$this->cp_been_updated_prefs = 'Твои настройки были обновлены.';
		$this->cp_changing_pass = 'Изменение пароля';
		$this->cp_contact_pm = 'Разрешить другим писать тебе личные сообщения?';
		$this->cp_cp = 'Контрольная панель';
		$this->cp_current_avatar = 'Текущая автара';
		$this->cp_current_time = 'Сейчас %s.';
		$this->cp_custom_title = 'Custom Member Title'; //Translate
		$this->cp_custom_title2 = 'This is a privledge reserved for board administrators'; //Translate
		$this->cp_dec = 'Декабрь';
		$this->cp_editing_avatar = 'Редактирование аватары';
		$this->cp_editing_profile = 'Редактирование профиля';
		$this->cp_email = 'Адрес Email';
		$this->cp_email_form = 'Разрешить другим писать мне по электронной почте?';
		$this->cp_email_invaid = 'Введенный адрес неверен.';
		$this->cp_err_avatar = 'Ошибка обновления аватары';
		$this->cp_err_updating = 'Ошибка обновления профиля';
		$this->cp_feb = 'Февраль';
		$this->cp_file_type = 'Введенная аватара неверная. Убедись, что URL правильно введен и тип файла - gif,jpg или png.';
		$this->cp_format = 'Форматирование имени';
		$this->cp_gtalk = 'GTalk Account'; //Translate
		$this->cp_header = 'Контрольная панель';
		$this->cp_height = 'Высота';
		$this->cp_icq = 'Номер ICQ';
		$this->cp_interest = 'Интересы';
		$this->cp_jan = 'Январь';
		$this->cp_july = 'Июль';
		$this->cp_june = 'Июнь';
		$this->cp_label_edit_avatar = 'Изменить аватару';
		$this->cp_label_edit_pass = 'Изменить пароль';
		$this->cp_label_edit_prefs = 'Изменить настройки';
		$this->cp_label_edit_profile = 'Редактировать профиль';
		$this->cp_label_edit_sig = 'Edit Signature'; //Translate
		$this->cp_label_edit_subs = 'Изменить подписки';
		$this->cp_language = 'Язык';
		$this->cp_less_charac = 'Имя должно быть короче 32-х символов.';
		$this->cp_location = 'Местоположение';
		$this->cp_login_first = 'Нужно залогинится перед входом в контрольную панель.';
		$this->cp_mar = 'Март';
		$this->cp_may = 'Май';
		$this->cp_msn = 'Идентификатор MSN';
		$this->cp_must_orig = 'Имя должно быть идентичным с оригиналом. Ты можешь изменить только регистр букв и промежутки между буквами.';
		$this->cp_new_notmatch = 'Новые пароли не совпадают.';
		$this->cp_new_pass = 'Новый пароль';
		$this->cp_no_flash = 'Анимированные аватары у нас запрещены.';
		$this->cp_not_exist = 'Указанная дата (%s) не существует!';
		$this->cp_nov = 'Ноябрь';
		$this->cp_oct = 'Октябрь';
		$this->cp_old_notmatch = 'Введенный старый пароль не совпадает с данными в базе.';
		$this->cp_old_pass = 'Старый пароль';
		$this->cp_pass_notvaid = 'Твой пароль неверен. Убедись, что использованы только корректные символы, такие как буквы, числа, тире, подчеркивание или пробелы.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = 'Изменение настроек';
		$this->cp_preview_sig = 'Signature Preview:'; //Translate
		$this->cp_privacy = 'Настройки безопасности';
		$this->cp_repeat_pass = 'Повтори новый пароль';
		$this->cp_sept = 'Сентябрь';
		$this->cp_show_active = 'Показывать твою активность при посещении форумов?';
		$this->cp_show_email = 'Показывать адрес email в профиле?';
		$this->cp_signature = 'Подпись';
		$this->cp_size_max = 'Размер указанной аватары слишком большой. Максимально разрешенный размер - %s на %s пикселов.';
		$this->cp_skin = 'Скин формов';
		$this->cp_sub_change = 'Изменение подписок';
		$this->cp_sub_delete = 'Удалить';
		$this->cp_sub_expire = 'Дата устаревания';
		$this->cp_sub_name = 'Название подписки';
		$this->cp_sub_no_params = 'Не заданы параметры.';
		$this->cp_sub_success = 'Теперь ты подписан на %s.';
		$this->cp_sub_type = 'Тип подписки';
		$this->cp_sub_updated = 'Выбранные подписки были удалены.';
		$this->cp_topic_option = 'Настройки тем';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = 'Профиль обновлен';
		$this->cp_updated1 = 'Аватара обновлена';
		$this->cp_updated_prefs = 'Настройки обновлены';
		$this->cp_user_exists = 'Пользователь с аналогично сформатированным именем уже существует.';
		$this->cp_valided = 'Твой пароль был проверен и изменен.';
		$this->cp_view_avatar = 'Показывать аватары?';
		$this->cp_view_emoticon = 'Показывать смайлы?';
		$this->cp_view_signature = 'Показывать подписи?';
		$this->cp_welcome = 'Добро пожаловать в контрольную панель. Тут ты можешь настроить свой аккаунт. Выбери нужный пункт.';
		$this->cp_width = 'Ширина';
		$this->cp_www = 'Домашняя страница';
		$this->cp_yahoo = 'Идентификатор Yahoo';
		$this->cp_zone = 'Часовой пояс';
	}

	function email()
	{
		$this->email_blocked = 'Этот пользователь не принимает сообщения email через эти форумы.';
		$this->email_email = 'Адрес Email';
		$this->email_msgtext = 'Тело Email:';
		$this->email_no_fields = 'Вернись и заполни все поля.';
		$this->email_no_member = 'Не найден пользователь с таким именем';
		$this->email_no_perm = 'У тебя нет прав посылать сообщения через эти форумы.';
		$this->email_sent = 'Сообщение email было послано.';
		$this->email_subject = 'Тема:';
		$this->email_to = 'Кому:';
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
		$this->forum_by = 'Написал';
		$this->forum_can_post = 'Ты можешь отвечать в этом форуме.';
		$this->forum_can_topics = 'Ты можешь читать темы в этом форуме.';
		$this->forum_cant_post = 'ты не можешь отвечать в этом форуме.';
		$this->forum_cant_topics = 'Ты не можешь читать темы в этом форуме.';
		$this->forum_dot = 'точка';
		$this->forum_dot_detail = 'означает, что ты писал в этой теме';
		$this->forum_forum = 'Форум';
		$this->forum_guest = 'Гость';
		$this->forum_hot = 'Горячее';
		$this->forum_icon = 'Иконка сообщения';
		$this->forum_jump = 'Перейти к последнему сообщению в теме';
		$this->forum_last = 'Последнее сообщение';
		$this->forum_locked = 'Закрыта';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = 'Перемещена';
		$this->forum_msg = '%s Message'; //Translate
		$this->forum_new = 'Новая';
		$this->forum_new_poll = 'Создать голосование';
		$this->forum_new_topic = 'Создать новую тему';
		$this->forum_no_topics = 'В этом форуме нет тем для отображения.';
		$this->forum_noexist = 'Указанный форум не существует.';
		$this->forum_nopost = 'Нет сообщений';
		$this->forum_not = 'Не';
		$this->forum_noview = 'У тебя нет права чтения этого форума.';
		$this->forum_pages = 'Страниц';
		$this->forum_pinned = 'Прикреплена';
		$this->forum_pinned_topic = 'Прикрепленная тема';
		$this->forum_poll = 'Голосование';
		$this->forum_regfirst = 'У нерегистрированных пользователей нет права просмотра форумов.';
		$this->forum_replies = 'Ответов';
		$this->forum_starter = 'Начал';
		$this->forum_sub = 'Подфорум';
		$this->forum_sub_last_post = 'Последнее сообщение';
		$this->forum_sub_replies = 'Ответов';
		$this->forum_sub_topics = 'Тем';
		$this->forum_subscribe = 'Уведомить по e-mail об ответах в этом форуме';
		$this->forum_topic = 'Тема';
		$this->forum_views = 'Просмотров';
		$this->forum_write_topics = 'Ты можешь создавать темы в этом форуме.';
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
		$this->help_available_files = 'Помощь';
		$this->help_confirm = 'Are you sure you want to delete'; //Translate
		$this->help_content = 'Article content'; //Translate
		$this->help_delete = 'Delete Help Article'; //Translate
		$this->help_deleted = 'Help Article Deleted.'; //Translate
		$this->help_edit = 'Edit Help Article'; //Translate
		$this->help_edited = 'Help article updated.'; //Translate
		$this->help_inserted = 'Article inserted into the database.'; //Translate
		$this->help_no_articles = 'No help articles were found in the database.'; //Translate
		$this->help_no_title = 'You can\'t create a help article without a title.'; //Translate
		$this->help_none = 'В базе данных нет файлов помощи.';
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
		$this->login_cant_logged = 'Невозможно войти. Проверь корректность ввода имени и пароля.<br /><br />Они регистро-зависимы, это значит что \'UsErNaMe\' отличается от \'Username\'. Также проверь, что в твоем браузере включены cookie.';
		$this->login_cookies = 'Для входа требуются включенные cookies.';
		$this->login_forgot_pass = 'Забыл пароль?';
		$this->login_header = 'Вход';
		$this->login_logged = 'Вход произведен.';
		$this->login_now_out = 'Выход произведен.';
		$this->login_out = 'Выход';
		$this->login_pass = 'Пароль';
		$this->login_pass_no_id = 'Пользователя с таким именем не существует.';
		$this->login_pass_request = 'Откройте ссылку в письме, отправленном на ваш адрес, чтобы завершить процедуру сброса пароля.';
		$this->login_pass_reset = 'Сбросить пароль';
		$this->login_pass_sent = 'Твой пароль был сброшен. Новый пароль был выслан на адрес email, указанный при регистрации.';
		$this->login_sure = 'Действительно хочешь выйти из \'%s\'?';
		$this->login_user = 'Имя пользователя';
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
		$this->main_activate = 'Твой аккаунт еще не был активизирован.';
		$this->main_activate_resend = 'Выслать активационное письмо заново';
		$this->main_admincp = 'админка';
		$this->main_banned = 'Тебе был забанен на этих форумах.';
		$this->main_code = 'Код';
		$this->main_cp = 'контрольная панель';
		$this->main_full = 'Полный отчет';
		$this->main_help = 'помощь';
		$this->main_load = 'загрузка';
		$this->main_login = 'вход';
		$this->main_logout = 'выход';
		$this->main_mark = 'mark all';
		$this->main_mark1 = 'Mark all topics as read'; //Translate
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = 'Извините, %s сейчас недоступны из-за большого количества посетителей.';
		$this->main_members = 'пользователи';
		$this->main_messenger = 'сообщения';
		$this->main_new = 'новый';
		$this->main_next = 'следущая';
		$this->main_prev = 'предыдущая';
		$this->main_queries = 'запросов';
		$this->main_quote = 'Цитата';
		$this->main_recent = 'recent posts';
		$this->main_recent1 = 'View recent topics since your last visit'; //Translate
		$this->main_register = 'регистрация';
		$this->main_reminder = 'Напоминатель';
		$this->main_reminder_closed = 'Форумы закрыты и доступны только администраторам.';
		$this->main_said = 'сказал';
		$this->main_search = 'поиск';
		$this->main_topics_new = 'В форуме есть новые сообщения.';
		$this->main_topics_old = 'В форуме нет новых сообщений.';
		$this->main_welcome = 'Добро пожаловать';
		$this->main_welcome_guest = 'Добро пожаловать!';
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
		$this->members_all = 'все';
		$this->members_email = 'Адрес Email';
		$this->members_email_member = 'Написать Email';
		$this->members_group = 'Группа';
		$this->members_joined = 'Присоединился';
		$this->members_list = 'Список пользователей';
		$this->members_member = 'Пользователь';
		$this->members_pm = 'Приватное сообщение';
		$this->members_posts = 'Сообщений';
		$this->members_send_pm = 'Послать приватное сообщение этому пользователю';
		$this->members_title = 'Заголовок';
		$this->members_vist_www = 'Посетить страничку этого пользователя';
		$this->members_www = 'Домашняя страничка';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Ты действительно хочешь удалить это сообщение?';
		$this->mod_confirm_topic_delete = 'Ты действительно хочешь удалить эту тему??';
		$this->mod_error_first_post = 'Невозможно удалить первое сообщение в теме.';
		$this->mod_error_move_category = 'Нелья переместить тему в категорию.';
		$this->mod_error_move_create = 'У тебя нет права перемещать темы в этот форум.';
		$this->mod_error_move_forum = 'Нельзя переместить тему в несуществующий форум.';
		$this->mod_error_move_global = 'You cannot move a global topic. Edit the topic before moving it.'; //Translate
		$this->mod_error_move_same = 'Тема уже находится в этом форуме.';
		$this->mod_label_controls = 'Пульт модератора';
		$this->mod_label_description = 'Описание';
		$this->mod_label_emoticon = 'Заменять смайлы на картинки?';
		$this->mod_label_global = 'Глобальная тема';
		$this->mod_label_mbcode = 'Использовать MbCode?';
		$this->mod_label_move_to = 'Переместить в';
		$this->mod_label_options = 'Настройки';
		$this->mod_label_post_delete = 'Удалить сообщение';
		$this->mod_label_post_edit = 'Изменить сообщение';
		$this->mod_label_post_icon = 'Post Icon'; //Translate
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = 'Заголовок';
		$this->mod_label_title_original = 'Оригинальный заголовок';
		$this->mod_label_title_split = 'Разделить заголовок';
		$this->mod_label_topic_delete = 'Удалить тему';
		$this->mod_label_topic_edit = 'Изменить тему';
		$this->mod_label_topic_lock = 'Заблокировать тему';
		$this->mod_label_topic_move = 'Переместить тему';
		$this->mod_label_topic_move_complete = 'Полностью переместить тему в новый форум';
		$this->mod_label_topic_move_link = 'Переместить тему в новый форум и оставить ссылку не неё в старом форуме.';
		$this->mod_label_topic_pin = 'Прикрепить тему';
		$this->mod_label_topic_split = 'Разделить тему';
		$this->mod_missing_post = 'Указанное сообщение не существует.';
		$this->mod_missing_topic = 'Указанная тема не существует.';
		$this->mod_no_action = 'Не выбрана действие.';
		$this->mod_no_post = 'Не выбрано сообщение.';
		$this->mod_no_topic = 'Не выбрана тема.';
		$this->mod_perm_post_delete = 'У тебя нет права удалять это сообщение.';
		$this->mod_perm_post_edit = 'У тебя нет права изменять это сообщение.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = 'У тебя нет права удалять эту тему.';
		$this->mod_perm_topic_edit = 'У тебя нет права изменять эту тему.';
		$this->mod_perm_topic_lock = 'У тебя нет права блокировать эту тему.';
		$this->mod_perm_topic_move = 'У тебя нет права перемещать эту тему.';
		$this->mod_perm_topic_pin = 'У тебя нет права прикреплять эту тему.';
		$this->mod_perm_topic_split = 'У тебя нет права разделять эту тему.';
		$this->mod_perm_topic_unlock = 'У тебя нет права разблокировать эту тему.';
		$this->mod_perm_topic_unpin = 'У тебя нет права откреплять эту тему.';
		$this->mod_success_post_delete = 'Сообщение было успешно удалено.';
		$this->mod_success_post_edit = 'Сообщение было успешно изменено.';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = 'Тема была успешно разделена.';
		$this->mod_success_topic_delete = 'Тема была успешно удалена.';
		$this->mod_success_topic_edit = 'Тема была успешно изменена.';
		$this->mod_success_topic_move = 'Тема была успешно перемещена в новый форум.';
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
		$this->pm_cant_del = 'У тебя нет права удаления этого сообщения.';
		$this->pm_delallmsg = 'Удалить все сообщения';
		$this->pm_delete = 'Удалить';
		$this->pm_delete_selected = 'Delete Selected Messages'; //Translate
		$this->pm_deleted = 'Сообщение удалено.';
		$this->pm_deleted_all = 'Сообщения удалены.';
		$this->pm_error = 'Не удалось отослать ваше сообщение некоторым людям.<br /><br />Эти пользователи не существуют: %s<br /><br />Эти пользователи не принимают никаких сообщений: %s';
		$this->pm_fields = 'Невозможно отправить твое сообщение. Проверь, что все необходимые поля заполнены.';
		$this->pm_flood = 'You have sent a message in the past %s seconds, and you may not send another right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->pm_folder_inbox = 'Входящие';
		$this->pm_folder_new = '%s новых';
		$this->pm_folder_sentbox = 'Отправленные';
		$this->pm_from = 'От';
		$this->pm_group = 'Группа';
		$this->pm_guest = 'Ты не можешь отправлять сообщения незарегистрировавшись.';
		$this->pm_joined = 'Присоединился';
		$this->pm_messenger = 'Сообщения';
		$this->pm_msgtext = 'Текст сообщения';
		$this->pm_multiple = 'Перечислите адресатов через точку с запятой (;)';
		$this->pm_no_folder = 'Укажи папку.';
		$this->pm_no_member = 'Не найден пользователь с таким номером.';
		$this->pm_no_number = 'Не найдено сообщение с таким номером.';
		$this->pm_no_title = 'Без темы';
		$this->pm_nomsg = 'В этой папке нет сообщений.';
		$this->pm_noview = 'У тебя нет прав просмотра этого сообщения.';
		$this->pm_offline = 'This member is currently offline'; //Translate
		$this->pm_online = 'Этот пользователь сейчас online';
		$this->pm_personal = 'Личные сообщения';
		$this->pm_personal_msging = 'Личные сообщения';
		$this->pm_pm = 'ПС';
		$this->pm_posts = 'Сообщений';
		$this->pm_preview = 'Preview'; //Translate
		$this->pm_recipients = 'Получатели';
		$this->pm_reply = 'Ответить';
		$this->pm_send = 'Послать';
		$this->pm_sendamsg = 'Послать сообщение';
		$this->pm_sendingpm = 'Посылаю сообщение';
		$this->pm_sendon = 'Послано';
		$this->pm_success = 'Твое сообщение было успешно послано.';
		$this->pm_sure_del = 'Ты действительно хочешь удалить это сообщение?';
		$this->pm_sure_delall = 'Ты действительно хочешь удалить все сообщения в этой папке?';
		$this->pm_title = 'Заголовок';
		$this->pm_to = 'Кому';
	}

	function post()
	{
		$this->post_attach = 'Вложения';
		$this->post_attach_add = 'Добавить вложение';
		$this->post_attach_disrupt = 'Добавление или удаление вложений не разрушает твое сообщение.';
		$this->post_attach_failed = 'Ошибка загрузки вложения. Указанный файл не существует.';
		$this->post_attach_not_allowed = 'Нельзя использовать вложения этого типа.';
		$this->post_attach_remove = 'Удалить вложение';
		$this->post_attach_too_large = 'Указанный файл слишком большой. Максимальный размер - %d КБ.';
		$this->post_cant_create = 'Незарегистрированным нельзя создавать темы.';
		$this->post_cant_create1 = 'У тебя нет прав создания темы.';
		$this->post_cant_enter = 'Голосование не было добавлено. Либо ты уже голосовал тут, либо у тебя нет права голосовать.';
		$this->post_cant_poll = 'Незарегистрированным нельзя создавать голосование.';
		$this->post_cant_poll1 = 'У тебя нет права создавать голосование.';
		$this->post_cant_reply = 'У тебя нет права отвечать в этом форуме.';
		$this->post_cant_reply1 = 'Незарегистрированным нельзя отвечать в теме.';
		$this->post_cant_reply2 = 'У тебя нет права отвечать в теме.';
		$this->post_closed = 'Тема закрыта.';
		$this->post_create_poll = 'Создать голосование';
		$this->post_create_topic = 'Создать тему';
		$this->post_creating = 'Создается тема';
		$this->post_creating_poll = 'Создается голосование';
		$this->post_flood = 'Ты отвечал в течении последних %s секунд и не можешь писать прямо сейчас<br /><br />Повтори через несколько секунд.';
		$this->post_guest = 'Гость';
		$this->post_icon = 'Иконка сообщения';
		$this->post_last_five = 'Последние 5 сообщений в обратном порядке';
		$this->post_length = 'Проверить длину';
		$this->post_msg = 'Сообщение';
		$this->post_must_msg = 'Ты должен ввести сообщение.';
		$this->post_must_options = 'Ты должен ввести пункты голосования.';
		$this->post_must_title = 'Требуется заголовок.';
		$this->post_new_poll = 'Новое голосование';
		$this->post_new_topic = 'Новая тема';
		$this->post_no_forum = 'Этот форум не найден.';
		$this->post_no_topic = 'Не выбрана тема.';
		$this->post_no_vote = 'Ты должен выбрать пункт, за который голосуешь.';
		$this->post_option_emoticons = 'Использовать графические смайлы?';
		$this->post_option_global = 'Сделать тему глобальной?';
		$this->post_option_mbcode = 'Использовать MbCode?';
		$this->post_optional = 'опционально';
		$this->post_options = 'Настройки';
		$this->post_poll_options = 'Настройки голосования';
		$this->post_poll_row = 'Один на строчку';
		$this->post_posted = 'Отправлено';
		$this->post_posting = 'Отправляю';
		$this->post_preview = 'Предварительный просмотр';
		$this->post_reply = 'Ответить';
		$this->post_reply_topic = 'Ответить на тему';
		$this->post_replying = 'Отвечаю на тему';
		$this->post_replying1 = 'Отвечаю';
		$this->post_too_many_options = 'Должно быть от 2-х до %d пунктов в голосовании.';
		$this->post_topic_detail = 'Описание темы';
		$this->post_topic_title = 'Заголовок темы';
		$this->post_view_topic = 'Посмотреть всю тему';
		$this->post_voting = 'Голосую';
	}

	function printer()
	{
		$this->printer_back = 'Назад';
		$this->printer_not_found = 'Тема не найдена. Она могла быть удалена, перемещена или вообще никогда не существовала.';
		$this->printer_not_found_title = 'Тема не найдена';
		$this->printer_perm_topics = 'У тебя нет права смотреть темы.';
		$this->printer_perm_topics_guest = 'У тебя нет права смотреть темы. Если зарегистрируешься, возможно, будет.';
		$this->printer_posted_on = 'Отправлено';
		$this->printer_send = 'Распечатать';
	}

	function profile()
	{
		$this->profile_aim_sn = 'Имя в AIM';
		$this->profile_av_sign = 'Аватара и подпись';
		$this->profile_avatar = 'Аватара';
		$this->profile_bday = 'День рождения';
		$this->profile_contact = 'Контакт';
		$this->profile_email_address = 'Адрес email';
		$this->profile_fav = 'Любимый форум';
		$this->profile_fav_forum = '%s (%d%% сообщений этого пользователя)';
		$this->profile_gtalk = 'GTalk Account'; //Translate
		$this->profile_icq_uin = 'Номер ICQ';
		$this->profile_info = 'Информация';
		$this->profile_interest = 'Интересы';
		$this->profile_joined = 'Присоединился';
		$this->profile_last_post = 'Последнее сообщение';
		$this->profile_list = 'Список пользователей';
		$this->profile_location = 'Местоположение';
		$this->profile_member = 'Группа';
		$this->profile_member_title = 'Заголовок';
		$this->profile_msn = 'Идентификатор MSN';
		$this->profile_must_user = 'Ты должен указать пользователя, что б смотреть профиль.';
		$this->profile_no_member = 'Нету пользователя с таким номером. Его аккаунт мог быть удален.';
		$this->profile_none = '[ нет ]';
		$this->profile_not_post = 'еще не писал.';
		$this->profile_offline = 'This member is currently offline'; //Translate
		$this->profile_online = 'Этот пользователь сейчас online';
		$this->profile_pm = 'Приватные сообщения';
		$this->profile_postcount = '%s всего, %s в день';
		$this->profile_posts = 'Сообщений';
		$this->profile_private = '[ Приватно ]';
		$this->profile_profile = 'Профиль';
		$this->profile_signature = 'Подпись';
		$this->profile_unkown = '[ Неизвестно ]';
		$this->profile_view_profile = 'Просмотр профиля';
		$this->profile_www = 'Домашняя страница';
		$this->profile_yahoo = 'Идентификатор Yahoo';
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
		$this->recent_by = 'Написал';
		$this->recent_can_post = 'Ты можешь отвечать в этом форуме.';
		$this->recent_can_topics = 'Ты можешь читать темы в этом форуме.';
		$this->recent_cant_post = 'ты не можешь отвечать в этом форуме.';
		$this->recent_cant_topics = 'Ты не можешь читать темы в этом форуме.';
		$this->recent_dot = 'точка';
		$this->recent_dot_detail = 'означает, что ты писал в этой теме';
		$this->recent_forum = 'Форум';
		$this->recent_guest = 'Гость';
		$this->recent_hot = 'Горячее';
		$this->recent_icon = 'Иконка сообщения';
		$this->recent_jump = 'Перейти к последнему сообщению в теме';
		$this->recent_last = 'Последнее сообщение';
		$this->recent_locked = 'Закрыта';
		$this->recent_moved = 'Перемещена';
		$this->recent_msg = '%s Message'; //Translate
		$this->recent_new = 'Новая';
		$this->recent_new_poll = 'Создать голосование';
		$this->recent_new_topic = 'Создать новую тему';
		$this->recent_no_topics = 'В этом форуме нет тем для отображения.';
		$this->recent_noexist = 'Указанный форум не существует.';
		$this->recent_nopost = 'Нет сообщений';
		$this->recent_not = 'Не';
		$this->recent_noview = 'У тебя нет права чтения этого форума.';
		$this->recent_pages = 'Страниц';
		$this->recent_pinned = 'Прикреплена';
		$this->recent_pinned_topic = 'Прикрепленная тема';
		$this->recent_poll = 'Голосование';
		$this->recent_regfirst = 'У нерегистрированных пользователей нет права просмотра форумов.';
		$this->recent_replies = 'Ответов';
		$this->recent_starter = 'Начал';
		$this->recent_sub = 'Подфорум';
		$this->recent_sub_last_post = 'Последнее сообщение';
		$this->recent_sub_replies = 'Ответов';
		$this->recent_sub_topics = 'Тем';
		$this->recent_subscribe = 'Уведомить по e-mail об ответах в этом форуме';
		$this->recent_topic = 'Тема';
		$this->recent_views = 'Просмотров';
		$this->recent_write_topics = 'Ты можешь создавать темы в этом форуме.';
	}

	function register()
	{
		$this->register_activated = 'Твой аккаунт был актвирован!';
		$this->register_activating = 'Активация аккаунта';
		$this->register_activation_error = 'Произошла ошибка при активации аккаунта. Проверь, содержит ли браузер полный адрес из активационного письма. Если проблема не исчезла, свяжись с администратором для переотправки письма.';
		$this->register_confirm_passwd = 'Подтверди пароль';
		$this->register_done = 'Ты был зарегистрирован. Теперь ты можешь войти.';
		$this->register_email = 'Адрес email';
		$this->register_email_invalid = 'Введенный адрес email неверен.';
		$this->register_email_msg = 'This is an automated email generated by Quicksilver Forums, and sent to you in order'; //Translate
		$this->register_email_msg2 = 'for you to activate your account with'; //Translate
		$this->register_email_msg3 = 'Please click the following link, or paste it in to your web browser:'; //Translate
		$this->register_email_used = 'Введенный адрес email уже используется одним из пользователей.';
		$this->register_fields = 'Не все поля заполнены.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = 'Пожалуйста, введите текст, изображенный на картинке.';
		$this->register_image_invalid = 'Чтобы убедится, что ты человек, а не поганый робот, введи текст, изображенный на картинке.';
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'Ты зарегистрировался. На адрес %s был выслан email с инструкциями по активизации твоего аккаунта. Перед началом работы необходимо активизировать аккаунт.';
		$this->register_name_invalid = 'Слишком длинное имя.';
		$this->register_name_taken = 'Такое имя уже занято.';
		$this->register_new_user = 'Желаемое имя';
		$this->register_pass_invalid = 'Введенный пароль неверен. Пароль должен содержать только нормальные символы, такие как буквы, числа, тире, подчеркивание или пробел, и быть не менее 5 символов.';
		$this->register_pass_match = 'Пароли не совпадают.';
		$this->register_passwd = 'Пароль';
		$this->register_reg = 'Регистрация';
		$this->register_reging = 'Регистрируется';
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
		$this->search_advanced = 'Дополнительные настройки';
		$this->search_avatar = 'Avatar'; //Translate
		$this->search_basic = 'Простой поиск';
		$this->search_characters = 'символов сообщения';
		$this->search_day = 'день';
		$this->search_days = 'дней';
		$this->search_exact_name = 'точное имя';
		$this->search_flood = 'You have searched in the past %s seconds, and you may not search right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->search_for = 'Искать';
		$this->search_forum = 'Форум';
		$this->search_group = 'Группа';
		$this->search_guest = 'Гость';
		$this->search_in = 'Искать в';
		$this->search_in_posts = 'Искать только в сообщениях';
		$this->search_ip = 'IP-адрес';
		$this->search_joined = 'Присоединился';
		$this->search_level = 'Уровень пользователя';
		$this->search_match = 'Искать совпадения';
		$this->search_matches = 'Совпадения';
		$this->search_month = 'месяц';
		$this->search_months = 'месяцев';
		$this->search_mysqldoc = 'Документация по MySQL';
		$this->search_newer = 'новее';
		$this->search_no_results = 'По твоему запросу ничего не найдено.';
		$this->search_no_words = 'Ты должен задать условия поиска.<br /><br />Каждое условие должно быть длиннее 3-х символов, включая буквы, числа, апострофы и подчеркивания.';
		$this->search_offline = 'This member is currently offline'; //Translate
		$this->search_older = 'старше';
		$this->search_online = 'Этот пользователь сейчас online';
		$this->search_only_display = 'Показывать первые';
		$this->search_partial_name = 'фрагмент имени';
		$this->search_post_icon = 'Иконка сообщения';
		$this->search_posted_on = 'Отправлено';
		$this->search_posts = 'Сообщения';
		$this->search_posts_by = 'Только в сообщениях';
		$this->search_regex = 'Искать с помощью регулярных выражений';
		$this->search_regex_failed = 'Ошибка в регулярных выражениях. Прочитай документацию на MySQL о регулярных выражениях.';
		$this->search_relevance = 'Релевантность сообщения: %d%%';
		$this->search_replies = 'Сообщений';
		$this->search_result = 'Результаты поиска';
		$this->search_search = 'Искать';
		$this->search_select_all = 'Выделить всё';
		$this->search_show_posts = 'Показывать подходяшие сообщения';
		$this->search_sound = 'Искать созвучные';
		$this->search_starter = 'Начал';
		$this->search_than = 'чем';
		$this->search_topic = 'Тема';
		$this->search_unreg = 'Незарегистрированный';
		$this->search_week = 'неделя';
		$this->search_weeks = 'недели';
		$this->search_year = 'год';
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
		$this->topic_attached = 'Вложенный файл:';
		$this->topic_attached_downloads = 'раз скачано';
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = 'У тебя нет прав скачивать этот файл.';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = 'Вложенный файл';
		$this->topic_avatar = 'Аватара';
		$this->topic_bottom = 'Go to the bottom of the page'; //Translate
		$this->topic_create_poll = 'Новое голосование';
		$this->topic_create_topic = 'Новая тема';
		$this->topic_delete = 'Удалить';
		$this->topic_delete_post = 'Удалить это сообщение';
		$this->topic_edit = 'Изменить';
		$this->topic_edit_post = 'Изменить это сообщение';
		$this->topic_edited = 'Последний раз редактировалось %s, редактировал  %s';
		$this->topic_error = 'Ошибка';
		$this->topic_group = 'Группа';
		$this->topic_guest = 'Гость';
		$this->topic_ip = 'IP-адрес';
		$this->topic_joined = 'Присоединился';
		$this->topic_level = 'Уровень пользователя';
		$this->topic_links_aim = 'Послать AIM-сообщение %s';
		$this->topic_links_email = 'Послать email %s';
		$this->topic_links_gtalk = 'Send a GTalk message to %s'; //Translate
		$this->topic_links_icq = 'Послать ICQ-сообщение %s';
		$this->topic_links_msn = 'Посмотреть MSN-профиль %s';
		$this->topic_links_pm = 'Послать приватное сообщение %s';
		$this->topic_links_web = 'Посетить домашнюю страничку %s';
		$this->topic_links_yahoo = 'Послать Yahoo-сообщение %s';
		$this->topic_lock = 'Заблокировать';
		$this->topic_locked = 'Тема заблокирована';
		$this->topic_move = 'Переместить';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = 'Newer Topic'; //Translate
		$this->topic_no_newer = 'There is no newer topic.'; //Translate
		$this->topic_no_older = 'There is no older topic.'; //Translate
		$this->topic_no_votes = 'Никто не голосовал.';
		$this->topic_not_found = 'Тема не найдена';
		$this->topic_not_found_message = 'Тема не найдена. Её могли удалить или переместить. Возможно, она никогда и не существовала.';
		$this->topic_offline = 'This member is currently offline'; //Translate
		$this->topic_older = 'Older Topic'; //Translate
		$this->topic_online = 'Этот пользователь сейчас online';
		$this->topic_options = 'Настройки темы';
		$this->topic_pages = 'Страницы';
		$this->topic_perm_view = 'У тебя нет права смотреть темы.';
		$this->topic_perm_view_guest = 'У тебя нет права смотреть темы. Если зарегистрируешься, возможно и будет';
		$this->topic_pin = 'Прикрепить';
		$this->topic_posted = 'Отправлено';
		$this->topic_posts = 'Сообщений';
		$this->topic_print = 'Версия для печати';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'Emoticons'; //Translate
		$this->topic_qr_open_emoticons = 'Open Clickable Emoticons'; //Translate
		$this->topic_qr_open_mbcode = 'Open MBCode'; //Translate
		$this->topic_quickreply = 'Quick Reply'; //Translate
		$this->topic_quote = 'Ответить с цитатированием';
		$this->topic_reply = 'Ответить';
		$this->topic_split = 'Разделить';
		$this->topic_split_finish = 'Завершить все разделения';
		$this->topic_split_keep = 'Не перемещать это сообщение';
		$this->topic_split_move = 'Переместить это сообщение';
		$this->topic_subscribe = 'Уведомить меня по e-mail при ответах в этой теме';
		$this->topic_top = 'Вверх ';
		$this->topic_unlock = 'Разблокировать';
		$this->topic_unpin = 'Открепить';
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = 'Не зарегистрирован';
		$this->topic_view = 'Посмотреть результаты';
		$this->topic_viewing = 'Просмотр темы';
		$this->topic_vote = 'Голос';
		$this->topic_vote_count_plur = '%d голосов';
		$this->topic_vote_count_sing = '%d голос';
		$this->topic_votes = 'голос(-ов)';
	}

	function universal()
	{
		$this->aim = 'AIM'; //Translate
		$this->based_on = 'based on';
		$this->board_by = 'Написал';
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
		$this->submit = 'Отправить';
		$this->subscribe = 'Subscribe'; //Translate
		$this->time_long = ', g:i a'; //Translate
		$this->time_only = 'g:i a'; //Translate
		$this->today = 'Сегодня';
		$this->website = 'WWW'; //Translate
		$this->yahoo = 'Yahoo'; //Translate
		$this->yes = 'Yes'; //Translate
		$this->yesterday = 'Вчера';
	}
}
?>
