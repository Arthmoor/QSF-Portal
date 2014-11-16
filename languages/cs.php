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
 * Czech language module
 *
 * @author Yarda Horák <ryan69@seznam.cz>
 * @since 1.1.0
 **/
class cs
{
	function active()
	{
		$this->active_last_action = 'Akce';
		$this->active_modules_active = 'Prohlíí si aktivní uivatele';
		$this->active_modules_board = 'Je na úvodní stránce';
		$this->active_modules_cp = 'Pouívá kontrolní panel';
		$this->active_modules_forum = 'Prohlíí si fórum: %s';
		$this->active_modules_help = 'Pouívá nápovìdu';
		$this->active_modules_login = 'Vstupuje/Odchází';
		$this->active_modules_members = 'Prohlíí si seznam èlenù';
		$this->active_modules_mod = 'Moderovat';
		$this->active_modules_pm = 'Pouívá Messenger';
		$this->active_modules_post = 'Píe nový pøíspìvek';
		$this->active_modules_printer = 'Tiskne si téma: %s';
		$this->active_modules_profile = 'Prohlíí si profil: %s';
		$this->active_modules_recent = 'Prohlíí si nové pøíspìvky';
		$this->active_modules_search = 'Hledání';
		$this->active_modules_topic = 'Prohlíí si téma: %s';
		$this->active_time = 'Èas';
		$this->active_user = 'Uivatel';
		$this->active_users = 'Aktivní uivatelé';
	}

	function admin()
	{
		$this->admin_add_emoticons = 'Pøidat smajlíky';
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
		$this->backup_none = 'No backups were found in the Quicksilver Forums directory.'; //Translate
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
		$this->board_active_users = 'Aktivní uivatelé';
		$this->board_birthdays = 'Dnes má narozeniny:';
		$this->board_bottom_page = 'Pøejit dolù na stránku';
		$this->board_can_post = 'V tomto fóru mùete odpovídat.';
		$this->board_can_topics = 'Mùete prohlíet, ale nemùete vytváøet témata v tomto fóru. Prosím, zaregistrujte se.';
		$this->board_cant_post = 'Nemùete odpovídat v tomto fóru. Prosím, zaregistrujte se.';
		$this->board_cant_topics = 'Nemùete prohlíet ani vytváøet témata v tomto fóru. Prosím, zaregistrujte se.';
		$this->board_forum = 'Fórum';
		$this->board_guests = 'hosté';
		$this->board_last_post = 'Poslední pøíspìvek';
		$this->board_mark = 'Oznaèit pøíspìvek jako pøeètený';
		$this->board_mark1 = 'Vechny pøíspìvky a fóra byly oznaèeny jako pøeètené.';
		$this->board_markforum = 'Oznaèit fórum jako pøeètené';
		$this->board_markforum1 = 'Vechny pøíspìvky ve fóru %s byly oznaèeny jako pøeètené.';
		$this->board_members = 'registrovaní ';
		$this->board_message = '%s Zpráva';
		$this->board_most_online = 'Nejvíce uivatelù online (%d) tu bylo %s.';
		$this->board_nobday = 'ádny èlen dnes nemá narozeniny.';
		$this->board_nobody = 'ádný èlen není on-line.';
		$this->board_nopost = 'ádné pøíspìvky';
		$this->board_noview = 'Nemáte povolení prohlíet fórum.';
		$this->board_regfirst = 'Nemáte povolení prohlíet fórum. Musíte se nejdøív zaregistrovat.';
		$this->board_replies = 'Odpovìdí';
		$this->board_stats = 'Statistiky';
		$this->board_stats_string = '%s uivatelù je registrováno. Ná nejnovìjí èlen má pøezdívku %s.<br />Najdete zde %s témat a %s odpovìdí, celkem of %s pøíspìvkù.';
		$this->board_top_page = 'Pøejít nahoru na stránku';
		$this->board_topics = 'Témat';
		$this->board_users = 'uivatelù je on-line';
		$this->board_write_topics = 'Mùete prohlíet a vytváøet témata v tomto fóru.';
	}

	function censoring()
	{
		$this->censor = 'Cenzorovaná slova';
		$this->censor_one_per_line = 'Jedno na øádek.';
		$this->censor_regex_allowed = 'Regular expressions are allowed. You can use a single * as a wildcard for one or more characters.'; //Translate
		$this->censor_updated = 'Slovník byl aktualizován.'; //Translate
	}

	function cp()
	{
		$this->cp_aim = 'AIM';
		$this->cp_already_member = 'Vámi zadaná e-mailová adresa je ji pouita jiným èlenem..';
		$this->cp_apr = 'Dubna';
		$this->cp_aug = 'Srpna';
		$this->cp_avatar_current = 'Stávající avatar';
		$this->cp_avatar_error = 'Chybný avatar';
		$this->cp_avatar_must_select = 'Musíte vybrat avatar.';
		$this->cp_avatar_none = 'Nemá avatar';
		$this->cp_avatar_pixels = 'pixelù';
		$this->cp_avatar_select = 'Vyberte avatar';
		$this->cp_avatar_size_height = 'Avatar musí mít íøku mezi 1 d';
		$this->cp_avatar_size_width = 'Avatar musí mít výku mezi 1 d';
		$this->cp_avatar_upload = 'Nahrát avatara z Vaeho disku';
		$this->cp_avatar_upload_failed = 'Chyba pøi nahrávání avatara. Soubour zøejmì neexistuje.';
		$this->cp_avatar_upload_not_image = 'Mùete nahrát jen avatar ?na be used for your avatar?.';
		$this->cp_avatar_upload_too_large = 'Avatar je pøíli velký. Maximální velikost je %d kilobytù.';
		$this->cp_avatar_url = 'URL Vaeho avatara';
		$this->cp_avatar_use = 'Pouít nahraný avatar';
		$this->cp_bday = 'Datum narození';
		$this->cp_been_updated = 'Vá profil byl zmìnìn.';
		$this->cp_been_updated1 = 'Vá avatar byl nahrán.';
		$this->cp_been_updated_prefs = 'Nastavení bylo zmìnìno.';
		$this->cp_changing_pass = 'Zmìnit heslo';
		$this->cp_contact_pm = 'Umonit ostatním uivatelùm, aby mi mohli zasílat soukromé zprávy';
		$this->cp_cp = 'Nastavení';
		$this->cp_current_avatar = 'Stávající avatar';
		$this->cp_current_time = 'Nyní je %s.';
		$this->cp_custom_title = 'Osobní titulek';
		$this->cp_custom_title2 = 'Tato volba je pøístupná jen administrátorùm';
		$this->cp_dec = 'Prosince';
		$this->cp_editing_avatar = 'Zmìnit avatar';
		$this->cp_editing_profile = 'Zmìnit profil';
		$this->cp_email = 'E-mail';
		$this->cp_email_form = 'Umonit ostatním uivatelùm  kontaktovat mnì pøes e-mail';
		$this->cp_email_invaid = 'Vámi vloená e-mailová adresa je neplatná.';
		$this->cp_err_avatar = 'Chyba pøi nahrávání avatara';
		$this->cp_err_updating = 'Chyba pøi zmìnì profilu';
		$this->cp_feb = 'Února';
		$this->cp_file_type = 'Vámi vloený avatar je neplatný. Ujistìte se e URL je ve správném tvaru, a formát obrázku je gif, jpg, nebo png.';
		$this->cp_format = 'Jméno-pøezdívka';
		$this->cp_gtalk = 'GTalk úèet';
		$this->cp_header = 'Kontrolní panel uivatele';
		$this->cp_height = 'Výka';
		$this->cp_icq = 'ICQ (bez mezer, pomlèek, atd.).';
		$this->cp_interest = 'Záliby';
		$this->cp_jan = 'Ledna';
		$this->cp_july = 'Èervence';
		$this->cp_june = 'Èervna';
		$this->cp_label_edit_avatar = 'Zmìnit avatar';
		$this->cp_label_edit_pass = 'Zmìnit heslo';
		$this->cp_label_edit_prefs = 'Zmìnit nastavení';
		$this->cp_label_edit_profile = 'Zmìnit profil';
		$this->cp_label_edit_sig = 'Zmìnit podpis';
		$this->cp_label_edit_subs = 'Zmìnit zasílání infomailù';
		$this->cp_language = 'Jazyk';
		$this->cp_less_charac = 'Vae jméno mùe obsahovat max. 32 znakù.';
		$this->cp_location = 'Mìsto';
		$this->cp_login_first = 'Musíte být pøihlaeni, aby ste mohli pouívat kontrolní panel.';
		$this->cp_mar = 'Bøezna';
		$this->cp_may = 'Kvìtna';
		$this->cp_msn = 'MSN';
		$this->cp_must_orig = 'Vae jméno musí být stejné jako pùvodní. Mùete jen zmìnit zpùsob jeho zobrazení (napø. pøidáním mezer atd.).';
		$this->cp_new_notmatch = 'Vami zadané nové heslo je neplatné.';
		$this->cp_new_pass = 'Nové heslo';
		$this->cp_no_flash = 'Obrázky ve Flashi nejsou povoleny.';
		$this->cp_not_exist = 'patnì zadaný datum (%s) !';
		$this->cp_nov = 'Listopadu';
		$this->cp_oct = 'Øíjna';
		$this->cp_old_notmatch = 'Heslo nesouhlasí s heslem v databázi.';
		$this->cp_old_pass = 'Staré heslo';
		$this->cp_pass_notvaid = 'Vae heslo je neplatné. Ujistìte se, e pouívaté jen platné znaky - písmena, èíslice, pomlèky, podrtítka, nebo mezery.';
		$this->cp_posts_page = 'Pøíspìvkù na stránku. Zvolte 0 pro výchozí nastavení.';
		$this->cp_preferences = 'Zmìnit záliby';
		$this->cp_preview_sig = 'Náhled podpisu:';
		$this->cp_privacy = 'Privátní volby';
		$this->cp_repeat_pass = 'Zopakujte nové heslo';
		$this->cp_sept = 'Záøí';
		$this->cp_show_active = 'Být viditelný pro ostatní uivatele, pokud se pøihlasím na fórum';
		$this->cp_show_email = 'Zobrazit mojí e-mailovou adresu v profilu';
		$this->cp_signature = 'Podpis';
		$this->cp_size_max = 'Velikost avatara je pøíli velká (max. %s na %s pixelù).';
		$this->cp_skin = 'Vzhled fóra';
		$this->cp_sub_change = 'Zmìnit zasílání infomailù';
		$this->cp_sub_delete = 'Smazat';
		$this->cp_sub_expire = 'E-maily budou zásílany do';
		$this->cp_sub_name = 'Název tématu';
		$this->cp_sub_no_params = 'ádné parametry nebyly zadány.';
		$this->cp_sub_success = 'Nyní jste zapsáni k odbìru nových pøíspìvkù z tématu %s.';
		$this->cp_sub_type = 'Sekce';
		$this->cp_sub_updated = 'Zasílaní informaèních e-mailù o tomto tématu bylo zrueno.';
		$this->cp_topic_option = 'Zobrazovat';
		$this->cp_topics_page = 'Témat na stránku. Zvolte 0 pro výchozí nastavení.';
		$this->cp_updated = 'Profil zmìnìn';
		$this->cp_updated1 = 'Avatar zmìnìn';
		$this->cp_updated_prefs = 'Nastavení zmìnìno';
		$this->cp_user_exists = 'Uivatel s tímto jménem ji existuje.';
		$this->cp_valided = 'Vae heslo bylo zmìnìno.';
		$this->cp_view_avatar = 'obrázky';
		$this->cp_view_emoticon = 'smajlíci';
		$this->cp_view_signature = 'podpisy';
		$this->cp_welcome = 'Vítejte v ovládacím panelu pro registrované uivatele. Odtud mùete mìnit Vá úèet. Prosím vyberte si z moností nahoøe.';
		$this->cp_width = 'íøka';
		$this->cp_www = 'WWW stránky';
		$this->cp_yahoo = 'Yahoo';
		$this->cp_zone = 'Èasové pásmo';
	}

	function email()
	{
		$this->email_blocked = 'Tento èlen neakceptuje pøijmutí e-mailových zpráv.';
		$this->email_email = 'E-mail';
		$this->email_msgtext = 'Zpráva:';
		$this->email_no_fields = 'Vra?te se a ujistìte se, e jste vyplnili vechny údaje.';
		$this->email_no_member = 'Pod tímto jménem nebyl nalezen ádný èlen';
		$this->email_no_perm = 'Nemáte povolení posílat e-mailové zprávy v tomto fóru.';
		$this->email_sent = 'E-mail byl odeslán.';
		$this->email_subject = 'Pøedmìt:';
		$this->email_to = 'Pro:';
	}

	function emot_control()
	{
		$this->emote = 'Smajlíci';
		$this->emote_add = 'Pøidat smajlíka';
		$this->emote_added = 'Smajlík pøidán.';
		$this->emote_clickable = 'Klikatelný';
		$this->emote_edit = 'Zmìnit smajlíka';
		$this->emote_image = 'Obrázek';
		$this->emote_install = 'Nainstalovat smajlíky';
		$this->emote_install_done = 'Emoticons have been successfully reinstalled.'; //Translate
		$this->emote_install_warning = 'This will erase all existing emoticon settings and import uploaded emoticons from your currently selected skin into the database.'; //Translate
		$this->emote_no_text = 'No emoticon text was given.'; //Translate
		$this->emote_text = 'Text';
	}

	function forum()
	{
		$this->forum_by = 'Od';
		$this->forum_can_post = 'V tomto fóru mùete odpovídat.';
		$this->forum_can_topics = 'V tomto fóru mùete prohlíet témata.';
		$this->forum_cant_post = 'V tomto fóru nemùete odpovídat. Prosím, zaregistrujte se.';
		$this->forum_cant_topics = 'V tomto fóru nemùete prohlíet témata. Prosím, zaregistrujte se.';
		$this->forum_dot = 'teèka';
		$this->forum_dot_detail = 'ukazuje, e jste v tomto fóru odpovídal(a)';
		$this->forum_forum = 'Fórum';
		$this->forum_guest = 'Host';
		$this->forum_hot = '"HOT"';
		$this->forum_icon = 'Ikonka zprávy';
		$this->forum_jump = 'Pøeskoèit na nejnovìjí pøíspìvek v tomto tématu.';
		$this->forum_last = 'Poslední pøíspìvek';
		$this->forum_locked = 'Zamknuto';
		$this->forum_mark_read = 'Oznaèit fórum jako pøeètené';
		$this->forum_moved = 'Pøesunuto';
		$this->forum_msg = '%s Zpráva';
		$this->forum_new = 'Nové';
		$this->forum_new_poll = 'Vytvoøit nové téma s anketou';
		$this->forum_new_topic = 'Vytvoøit nové téma';
		$this->forum_no_topics = 'Ve fóru nejsou ádné pøíspìvky k zobrazení.';
		$this->forum_noexist = 'Fórum neexistuje.';
		$this->forum_nopost = 'ádné pøíspìvky';
		$this->forum_not = 'Ne';
		$this->forum_noview = 'Nemáte opravnìní prohlíet fórum.';
		$this->forum_pages = 'Stránky';
		$this->forum_pinned = 'Dùleité';
		$this->forum_pinned_topic = 'Zapinováné téma';
		$this->forum_poll = 'Anketa';
		$this->forum_regfirst = 'Nemáte oprávnìní prohlíet fórum. Nejprve se musíte zaregistrovat.';
		$this->forum_replies = 'Odpovìdí';
		$this->forum_starter = 'Zaloil(a)';
		$this->forum_sub = 'Sub-fórum';
		$this->forum_sub_last_post = 'Poslední pøíspìvek';
		$this->forum_sub_replies = 'Odpovìdí';
		$this->forum_sub_topics = 'Témat';
		$this->forum_subscribe = 'Informovat mnì e-mailem o nových pøíspìvcích';
		$this->forum_topic = 'Téma';
		$this->forum_views = 'Schlédnuto';
		$this->forum_write_topics = 'V tomto fóru mùete vytváøet témata.';
	}

	function forums()
	{
		$this->forum_controls = 'Nastevní fóra';
		$this->forum_create = 'Vytvoøit fórum';
		$this->forum_create_cat = 'Vytvoøit kategorii';
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
		$this->help_available_files = 'Nápovìda';
		$this->help_confirm = 'Are you sure you want to delete'; //Translate
		$this->help_content = 'Article content'; //Translate
		$this->help_delete = 'Delete Help Article'; //Translate
		$this->help_deleted = 'Help Article Deleted.'; //Translate
		$this->help_edit = 'Edit Help Article'; //Translate
		$this->help_edited = 'Help article updated.'; //Translate
		$this->help_inserted = 'Article inserted into the database.'; //Translate
		$this->help_no_articles = 'No help articles were found in the database.'; //Translate
		$this->help_no_title = 'You can\'t create a help article without a title.'; //Translate
		$this->help_none = 'Databáze neobsahuje ádnou nápovìdu';
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
		$this->jslang_avatar_size_height = 'íøka vaeho avatara musí být mezi 1 a %d pixely';
		$this->jslang_avatar_size_width = 'Výka vaeho avatara musí být mezi 1 a %d pixely';
	}

	function login()
	{
		$this->login_cant_logged = 'Pøihláení bylo neúspìné. Zkontrolujte, e zadané jméno a heslo jsou správné.<br /><br />Aplikace rozeznává malá a velká písmena! \'hEsLo\' není \'heslo\'. Zkontrolujte si také, e máte ve svém prohlíeci povoleny Cookies.';
		$this->login_cookies = 'Pro pøihláení musí být ve Vaem prohlíeèi povoleny Cookies';
		$this->login_forgot_pass = 'Zapomnìli jste heslo?';
		$this->login_header = 'Pøihláení';
		$this->login_logged = 'Nyní jste pøihláeni.';
		$this->login_now_out = 'Nyní jste odhláeni.';
		$this->login_out = 'Odhláení';
		$this->login_pass = 'Heslo';
		$this->login_pass_no_id = 'Pod tímto jménem není registrován ádný uivatel.';
		$this->login_pass_request = 'To complete the password reset, please click on the link sent to the email address associated with your account.'; //Translate
		$this->login_pass_reset = 'Obnovit heslo';
		$this->login_pass_sent = 'Vae heslo bylo obnoveno. Nové heslo bylo odesláno na e-mailovou adresu, kterou jste zadali pøi pøi registraci Vaeho úètu.';
		$this->login_sure = 'Jste si jisti, e se chcete odhlásit z \'%s\'?';
		$this->login_user = 'Uivatelské jméno';
	}

	function logs()
	{
		$this->logs_action = 'Akce';
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
		$this->main_activate = 'Dosud jste neaktivovali Vai registraci.';
		$this->main_activate_resend = 'Poslat znovu aktivaèní E-mail';
		$this->main_admincp = 'administrace';
		$this->main_banned = 'Máte zakázáno prohlíet jakoukoli èást tohoto fóra.';
		$this->main_code = 'Kód';
		$this->main_cp = 'nastavení';
		$this->main_full = 'Plné';
		$this->main_help = 'nápovìda';
		$this->main_load = 'zatíení';
		$this->main_login = 'pøihláení';
		$this->main_logout = 'odhláení';
		$this->main_mark = 'mark all';
		$this->main_mark1 = 'Oznaèit vechny témata jako pøeètená';
		$this->main_markforum_read = 'Oznaèit fórum jako pøeètené';
		$this->main_max_load = 'Omlováme se, ale %s je v nyní nedostupné, protoe server je pøetíen.';
		$this->main_members = 'èlenové';
		$this->main_messenger = 'messenger';
		$this->main_new = 'nové';
		$this->main_next = 'dalí';
		$this->main_prev = 'pøedchozí';
		$this->main_queries = 'poadavkù';
		$this->main_quote = 'Citovat';
		$this->main_recent = 'recent posts';
		$this->main_recent1 = 'Zobrazit nové pøíspìvky od vaí poslední návtìvy';
		$this->main_register = 'registrace';
		$this->main_reminder = 'Upozornìní:';
		$this->main_reminder_closed = 'Fórum je nyní uzavøeno, pøístupné jen administrátorùm.';
		$this->main_said = 'øekl(a)';
		$this->main_search = 'hledat';
		$this->main_topics_new = 'Ve fóru je nový pøíspìvek.';
		$this->main_topics_old = 'Ve fóru nejsou ádné nové pøíspìvky.';
		$this->main_welcome = 'Vítejte';
		$this->main_welcome_guest = 'Vítejte!!';
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
		$this->members_all = 'vichni';
		$this->members_email = 'E-mail';
		$this->members_email_member = 'Poslat E-mail tomuto èlenovi';
		$this->members_group = 'Skupina';
		$this->members_joined = 'Zaloeno';
		$this->members_list = 'Seznam èlenù';
		$this->members_member = 'Èlen';
		$this->members_pm = 'Osobní zpráva';
		$this->members_posts = 'Pøíspìvkù';
		$this->members_send_pm = 'Poslat tomuto uivateli soukromou zprávu';
		$this->members_title = 'Titul';
		$this->members_vist_www = 'Otevøít èlenovy www stránky';
		$this->members_www = 'www';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Jste si jisti e chcete smazat tento pøíspìvek?';
		$this->mod_confirm_topic_delete = 'Jste si jisti e chcete smazat toto téma?';
		$this->mod_error_first_post = 'Nemùete smazat první pøíspìvek v diskusi.';
		$this->mod_error_move_category = 'Nemùete pøesunout toto téma.';
		$this->mod_error_move_create = 'You do not have permission to move topics to that forum.'; //Translate
		$this->mod_error_move_forum = 'Nemùete pøesunout téma do diskuse, která neexistuje.';
		$this->mod_error_move_global = 'You cannot move a global topic. Edit the topic before moving it.'; //Translate
		$this->mod_error_move_same = 'Nemùete pøesunout téma do diskuse, ve které u je.';
		$this->mod_label_controls = 'Úprava pøíspìvku';
		$this->mod_label_description = 'Popis';
		$this->mod_label_emoticon = 'Pøevést textové "smajlíky" na obrázkové?';
		$this->mod_label_global = 'Veobecné téma';
		$this->mod_label_mbcode = 'Zformátovat MbCodem?';
		$this->mod_label_move_to = 'Pøesunout do';
		$this->mod_label_options = 'Volby';
		$this->mod_label_post_delete = 'Smazat pøíspìvek';
		$this->mod_label_post_edit = 'Editovat pøíspìvek';
		$this->mod_label_post_icon = 'Post Icon'; //Translate
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = 'Název';
		$this->mod_label_title_original = 'Pùvodní název';
		$this->mod_label_title_split = 'Spojit témata';
		$this->mod_label_topic_delete = 'Smazat téma';
		$this->mod_label_topic_edit = 'Editovat téma';
		$this->mod_label_topic_lock = 'Zamknout téma';
		$this->mod_label_topic_move = 'Pøesunout téma';
		$this->mod_label_topic_move_complete = 'Pøesunout célé téma do nové diskuse';
		$this->mod_label_topic_move_link = 'Pøesunou téma do nové diskuse, a nechat na nìj odkaz ve staré diskusi.';
		$this->mod_label_topic_pin = 'Zvýraznit téma';
		$this->mod_label_topic_split = 'Spojit témata';
		$this->mod_missing_post = 'Zadaný pøíspìvìk neexistuje.';
		$this->mod_missing_topic = 'Zadané téma neexistuje.';
		$this->mod_no_action = 'Musíte zvolit úkol.';
		$this->mod_no_post = 'Musíte zvolit pøíspìvek.';
		$this->mod_no_topic = 'Musíte zvolit téma..';
		$this->mod_perm_post_delete = 'Nemáte oprávnìní mazat pøíspìvky.';
		$this->mod_perm_post_edit = 'Nemáte oprávnìní editovat pøíspìvky.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = 'Nemáte oprávnìní mazat toto téma.';
		$this->mod_perm_topic_edit = 'Nemáte oprávnìní editovat toto téma.';
		$this->mod_perm_topic_lock = 'Nemáte oprávnìní zamknout toto téma.';
		$this->mod_perm_topic_move = 'Nemáte oprávnìní pøesunout toto téma.';
		$this->mod_perm_topic_pin = 'Nemáte oprávnìní zvýraznit toto téma.';
		$this->mod_perm_topic_split = 'Nemáte oprávnìní spojit tato témata.';
		$this->mod_perm_topic_unlock = 'Nemáte oprávnìní odemknout toto téma.';
		$this->mod_perm_topic_unpin = 'Nemáte oprávnìní odpinovat toto téma.';
		$this->mod_success_post_delete = 'Pøíspìvek byl úspìnì smazán.';
		$this->mod_success_post_edit = 'Pøíspìvìk byl úspìnì zmìnìn.';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = 'Témata byly úspìnì spojeny.';
		$this->mod_success_topic_delete = 'Téma bylo úspìnì smazáno.';
		$this->mod_success_topic_edit = 'Téma bylo úspìnì zmìnìno.';
		$this->mod_success_topic_move = 'Téma bylo úspìnì pøesunuto do nové diskuse.';
		$this->mod_success_unpublish = 'This topic has been removed from the published list.'; //Translate
	}

	function optimize()
	{
		$this->optimize = 'Optimalizovat databázi';
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
		$this->php_error = 'Chyba';
		$this->php_error_msg = 'phpinfo() can not be executed. It appears that your host has disabled this feature.'; //Translate
	}

	function pm()
	{
		$this->pm_avatar = 'Avatar';
		$this->pm_cant_del = 'Nemáte oprávnìní smazat tuto zprávu.';
		$this->pm_delallmsg = 'Smazat vechny zprávy';
		$this->pm_delete = 'Smazat';
		$this->pm_delete_selected = 'Smazat oznaèené zprávy';
		$this->pm_deleted = 'Zpráva smazána.';
		$this->pm_deleted_all = 'Zprávy smazány.';
		$this->pm_error = 'There were problems sending your message to some of the recipients.<br /><br />The following members do not exist: %s<br /><br />The following members are not accepting personal messages: %s'; //Translate
		$this->pm_fields = 'Zpráva nemohla bý odeslána. Ujistìte se, e jste vyplnili vechny povinné údaje.';
		$this->pm_flood = 'You have sent a message in the past %s seconds, and you may not send another right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->pm_folder_inbox = 'Schránka';
		$this->pm_folder_new = '%s nové';
		$this->pm_folder_sentbox = 'Sent';
		$this->pm_from = 'Od';
		$this->pm_group = 'Skupina';
		$this->pm_guest = 'Jako HOST nemùete pouívat Messenger. Prosím pøihlate se nebo se zaregistrujte.';
		$this->pm_joined = 'Zaloeno';
		$this->pm_messenger = 'Messenger';
		$this->pm_msgtext = 'Text zprávy';
		$this->pm_multiple = 'Více pøíjemcù mezi sebou oddìlte støedníkem - ;';
		$this->pm_no_folder = 'Musíte vybrat adresáø.';
		$this->pm_no_member = 'ádný èlen nebyl nalezen pod tímto ID.';
		$this->pm_no_number = 'ádná zpráva nebyla nalezena pod tímto èíslem.';
		$this->pm_no_title = 'ádný pøedmìt';
		$this->pm_nomsg = 'V této sloce nejsou ádné zprávy.';
		$this->pm_noview = 'Nemáte oprávnìní prohlíet tuto zprávu.';
		$this->pm_offline = 'Tento èlen je nyní nepøítomen';
		$this->pm_online = 'Tento èlen je nyní pøítomen';
		$this->pm_personal = 'Osobní Messenger';
		$this->pm_personal_msging = 'Osobní Messaging';
		$this->pm_pm = 'Soukromá zpráva';
		$this->pm_posts = 'Pøíspìvkù';
		$this->pm_preview = 'Náhled';
		$this->pm_recipients = 'Pøíjemci';
		$this->pm_reply = 'Odpovìï';
		$this->pm_send = 'Poslat';
		$this->pm_sendamsg = 'Poslat privátní zprávu';
		$this->pm_sendingpm = 'Poslat privátní zprávu';
		$this->pm_sendon = 'Posláno';
		$this->pm_success = 'Vae zpráva byla úspìnì odeslána.';
		$this->pm_sure_del = 'Jste si jisti, e chcete smazat tuto zprávu?';
		$this->pm_sure_delall = 'Jste si jisti, e chcete smazat vechny zprávy v této sloce?';
		$this->pm_title = 'Pøedmìt';
		$this->pm_to = 'Pro';
	}

	function post()
	{
		$this->post_attach = 'Pøílohy';
		$this->post_attach_add = 'Pøidat pøílohu';
		$this->post_attach_disrupt = 'Pøidáním nebo odebráním pøílohy nenaruíte Vá pøíspìvek.';
		$this->post_attach_failed = 'Chyba pøi náhrávání pøílohy. Soubor neexistuje.';
		$this->post_attach_not_allowed = 'Nemùete pøiloit soubor tohoto typu.';
		$this->post_attach_remove = 'Odstranit pøílohu';
		$this->post_attach_too_large = 'Pøíloha je pøíli velká (max. %d KB).';
		$this->post_cant_create = 'Jako host nemáte oprávnìní vytváøet témata. Prosím pøihlate se nebo se zaregistrujte.';
		$this->post_cant_create1 = 'Nemáte oprávnìní vytváøet témata.';
		$this->post_cant_enter = 'Vá hlas nemohl být zapoèítán. buï ste ji hlasovali, or nemáte oprávnìní hlasovat.';
		$this->post_cant_poll = 'Jako host nemáte oprávnìní vytváøet téma s anketou. Prosím pøihlate se nebo se zaregistrujte.';
		$this->post_cant_poll1 = 'Nemáte oprávnìní vytváøet téma s anketou.';
		$this->post_cant_reply = 'Nemáte oprávnìní odpovídat na téma v této diskusi.';
		$this->post_cant_reply1 = 'Jako host nemáte oprávnìní odpovídat na témata. Musíte být zaregistrováni, abyste mohli zasílat pøíspìvky.';
		$this->post_cant_reply2 = 'Nemáte oprávnìní odpovídat na témata.';
		$this->post_closed = 'Toto téma bylo zavøeno.';
		$this->post_create_poll = 'Vytvoøit téma s anketou';
		$this->post_create_topic = 'Vytvoøit téma';
		$this->post_creating = 'Vytvoøit téma';
		$this->post_creating_poll = 'Vytvoøit téma s anketou';
		$this->post_flood = 'Odpovídal(a) jste v pøedelých  %s vteøinách, nyní jetì nemùete odeslat dalí pøíspìvek.<br /><br />Prosím zkuste to za nìkolik vteøin.';
		$this->post_guest = 'Host';
		$this->post_icon = 'Ikonka tématu';
		$this->post_last_five = 'Posledních 5 pøíspìvkù';
		$this->post_length = 'Zkontrolovat délku';
		$this->post_msg = 'Zpráva';
		$this->post_must_msg = 'Musíte napsat nìjaký text, kdy chcete zaloit nové téma.';
		$this->post_must_options = 'Musíte urèit volby, kdy chtete zaloit nové téma s anketou.';
		$this->post_must_title = 'Musíte vloit název nového tématu, kdy ho chcete zaloit.';
		$this->post_new_poll = 'Nová anketa';
		$this->post_new_topic = 'Nové téma';
		$this->post_no_forum = 'ádné téma nebylo nalezeno.';
		$this->post_no_topic = 'ádné téma nebylo vybráno.';
		$this->post_no_vote = 'Musíte vybrat monosti hlasování pro anketu.';
		$this->post_option_emoticons = 'Pøevést textové "smajlíky" na obrázkové?';
		$this->post_option_global = 'Udìlat toto téma globálním?';
		$this->post_option_mbcode = 'Formátovat MbCodem? (doporuèeno)';
		$this->post_optional = 'volitelné';
		$this->post_options = 'Volby';
		$this->post_poll_options = 'Volby ankety';
		$this->post_poll_row = 'Jedna monost na kadý øádek';
		$this->post_posted = 'Posláno';
		$this->post_posting = 'Zapoèítáno';
		$this->post_preview = 'Náhled';
		$this->post_reply = 'Odeslat';
		$this->post_reply_topic = 'Odpovìdìt na téma';
		$this->post_replying = 'Odpovìdìt na téma';
		$this->post_replying1 = 'Odpovìdìt';
		$this->post_too_many_options = 'Musí být mezi 2 a %d volbami k hlasování.';
		$this->post_topic_detail = 'Popis tématu';
		$this->post_topic_title = 'Název tématu';
		$this->post_view_topic = 'Prohlédnout celé téma';
		$this->post_voting = 'Hlasování';
	}

	function printer()
	{
		$this->printer_back = 'Zpìt';
		$this->printer_not_found = 'Téma  nebylo nalezeno. Buï bylo smazáno, pøesunuto, nebo neexistuje.';
		$this->printer_not_found_title = 'Téma nenalezeno';
		$this->printer_perm_topics = 'Nemáte oprávnìní prohlíet téma.';
		$this->printer_perm_topics_guest = 'Nemáte oprávnìní prohlíet téma. Nejprve se musíte zaregistrovat.';
		$this->printer_posted_on = 'Posláno';
		$this->printer_send = 'Poslat na tisk';
	}

	function profile()
	{
		$this->profile_aim_sn = 'AIM';
		$this->profile_av_sign = 'Avatar a podpis';
		$this->profile_avatar = 'Avatar';
		$this->profile_bday = 'Vìk / narozeniny';
		$this->profile_contact = 'Kontakt';
		$this->profile_email_address = 'E-mailová adresa';
		$this->profile_fav = 'Oblíbené fórum';
		$this->profile_fav_forum = '%s (%d%% ze vech pøíspìvkù uivatele)';
		$this->profile_gtalk = 'GTalk úèet';
		$this->profile_icq_uin = 'ICQ';
		$this->profile_info = 'Informace';
		$this->profile_interest = 'Zájmy';
		$this->profile_joined = 'Zaloeno';
		$this->profile_last_post = 'Poslední pøíspìvek';
		$this->profile_list = 'Seznam èlenù';
		$this->profile_location = 'Bydlitì';
		$this->profile_member = 'Uivatelská skupina';
		$this->profile_member_title = 'Èlenský titul';
		$this->profile_msn = 'MSN';
		$this->profile_must_user = 'Abyste mohli prohlíet profil, musíte nejprve vybrat nìjakého uivatele.';
		$this->profile_no_member = 'Pod tímto ID nebyl nalezen ádny èlen. Je moné, e jeho úèet byl smazán.';
		$this->profile_none = '[ ádný ]';
		$this->profile_not_post = 'jetì nepøispíval(a).';
		$this->profile_offline = 'Tento èlen je nyní nepøítomen';
		$this->profile_online = 'Tento èlen je nyní pøítomen';
		$this->profile_pm = 'Privátní zpráva';
		$this->profile_postcount = '%s celkem, %s za den';
		$this->profile_posts = 'Celkem pøíspìvkù';
		$this->profile_private = '[ Osobní ]';
		$this->profile_profile = 'Profil';
		$this->profile_signature = 'Podpis';
		$this->profile_unkown = '[ Neznámý ]';
		$this->profile_view_profile = 'Prohlédnout profil';
		$this->profile_www = 'WWW stránky';
		$this->profile_yahoo = 'Yahoo';
	}

	function prune()
	{
		$this->prune_action = 'Prune action to take'; //Translate
		$this->prune_age_day = '1 den';
		$this->prune_age_eighthours = '8 hodin';
		$this->prune_age_hour = '1 hodina';
		$this->prune_age_month = '1 mìsíc';
		$this->prune_age_threemonths = '3 mìsíce';
		$this->prune_age_week = '1 týden';
		$this->prune_age_year = '1 rok';
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
		$this->recent_active = 'Aktivní témata od vaí návtìvy'; //Translate
		$this->recent_by = 'Od';
		$this->recent_can_post = 'V tomto fóru mùete odpovídat.';
		$this->recent_can_topics = 'V tomto fóru mùete prohlíet témata.';
		$this->recent_cant_post = 'V tomto fóru nemùete odpovídat. Prosím, zaregistrujte se.';
		$this->recent_cant_topics = 'V tomto fóru nemùete prohlíet témata. Prosím, zaregistrujte se.';
		$this->recent_dot = 'teèka';
		$this->recent_dot_detail = 'ukazuje, e jste v tomto fóru odpovídal(a)';
		$this->recent_forum = 'Fórum';
		$this->recent_guest = 'Host';
		$this->recent_hot = '"HOT"';
		$this->recent_icon = 'Ikonka zprávy';
		$this->recent_jump = 'Pøeskoèit na nejnovìjí pøíspìvek v tomto tématu.';
		$this->recent_last = 'Poslední pøíspìvek';
		$this->recent_locked = 'Zamknuto';
		$this->recent_moved = 'Pøesunuto';
		$this->recent_msg = '%s Zpráva';
		$this->recent_new = 'Nové';
		$this->recent_new_poll = 'Vytvoøit nové téma s anketou';
		$this->recent_new_topic = 'Vytvoøit nové téma';
		$this->recent_no_topics = 'Ve fóru nejsou ádné pøíspìvky k zobrazení.';
		$this->recent_noexist = 'Fórum neexistuje.';
		$this->recent_nopost = 'ádné pøíspìvky';
		$this->recent_not = 'Ne';
		$this->recent_noview = 'Nemáte opravnìní prohlíet fórum.';
		$this->recent_pages = 'Stránky';
		$this->recent_pinned = 'Dùleité';
		$this->recent_pinned_topic = 'Zapinováné téma';
		$this->recent_poll = 'Anketa';
		$this->recent_regfirst = 'Nemáte oprávnìní prohlíet fórum. Nejprve se musíte zaregistrovat.';
		$this->recent_replies = 'Odpovìdí';
		$this->recent_starter = 'Zaloil(a)';
		$this->recent_sub = 'Sub-fórum';
		$this->recent_sub_last_post = 'Poslední pøíspìvek';
		$this->recent_sub_replies = 'Odpovìdí';
		$this->recent_sub_topics = 'Témat';
		$this->recent_subscribe = 'Informovat mnì e-mailem o nových pøíspìvcích';
		$this->recent_topic = 'Téma';
		$this->recent_views = 'Schlédnuto';
		$this->recent_write_topics = 'V tomto fóru mùete vytváøet témata.';
	}

	function register()
	{
		$this->register_activated = 'Vá úèet byl aktivován!';
		$this->register_activating = 'Aktivace úètu';
		$this->register_activation_error = 'Pøi aktivaci Vaeho úètu nastala chyba. Zkontrolujte, zda aktivaèní e-mail obsahuje celou URL adresu. Pokud potíe pøetrvají, kontaktujte administrátora tohoto fóra.';
		$this->register_confirm_passwd = 'Potvrïte heslo';
		$this->register_done = 'Registrace probìhla úspìnì. Nyní se prosím pøihlate.';
		$this->register_email = 'E-mailová adresa';
		$this->register_email_invalid = 'Vámi zadaná e-mailová adresa je neplatná.';
		$this->register_email_msg = 'This is an automated email generated by Quicksilver Forums, and sent to you in order'; //Translate
		$this->register_email_msg2 = 'for you to activate your account with'; //Translate
		$this->register_email_msg3 = 'Please click the following link, or paste it in to your web browser:'; //Translate
		$this->register_email_used = 'Vámi zadanou e-mailovou adresu ji pouívá jiný èlen.';
		$this->register_fields = 'Nejsou vyplnìny vechny údaje.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = 'Prosím zadejte text, který vidíte na obrázku.';
		$this->register_image_invalid = 'Musíte zadat text, který vidíte na obrázku.';
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'ádost o registraci byla podána. Na adresu %s byl zaslán e-mail s informacemi, jak aktivovat Vá úèet. Dokud nebude úèet aktivován, budete mít na fóru omezené nìkteré funkce.';
		$this->register_name_invalid = 'Vámi zadané jméno je pøíli dlouhé.';
		$this->register_name_taken = 'Vámi zadané jméno je ji obsazeno.';
		$this->register_new_user = 'Uivatelské jméno';
		$this->register_pass_invalid = 'Vámi zadané heslo je neplatné. Ujistìte se, e pouívaté jen platné znaky - písmena, èíslice, pomlèky, podrtítka, nebo mezery a heslo má alespoò 5 znakù.';
		$this->register_pass_match = 'Vámi zadané heslo neodpovídá.';
		$this->register_passwd = 'Heslo';
		$this->register_reg = 'Registrovat!';
		$this->register_reging = 'Registrace';
		$this->register_requested = 'Account activation request for:'; //Translate
		$this->register_tos = 'Podmínky registrace';
		$this->register_tos_i_agree = 'Souhlasím s výe uvedenými podmínkami';
		$this->register_tos_not_agree = 'You did not agree to the terms.'; //Translate
		$this->register_tos_read = 'prosím pøeètìte si následující podmínky registrace';
	}

	function rssfeed()
	{
		$this->rssfeed_cannot_find_forum = 'The forum does not appear to exist'; //Translate
		$this->rssfeed_cannot_find_topic = 'The topic does nto appear to exist'; //Translate
		$this->rssfeed_cannot_read_forum = 'You do not have permission to read this forum'; //Translate
		$this->rssfeed_cannot_read_topic = 'You do not have permission to read this topic'; //Translate
		$this->rssfeed_error = 'Chyba';
		$this->rssfeed_forum = 'Fórum:';
		$this->rssfeed_posted_by = 'Pøíspìvek od';
		$this->rssfeed_topic = 'Téma:';
	}

	function search()
	{
		$this->search_advanced = 'Rozíøené hledání';
		$this->search_avatar = 'Avatar';
		$this->search_basic = 'Zákládní hledání';
		$this->search_characters = 'znakù z pøíspìvku';
		$this->search_day = 'den';
		$this->search_days = 'dny';
		$this->search_exact_name = 'pøesné znìní';
		$this->search_flood = 'You have searched in the past %s seconds, and you may not search right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->search_for = 'Vyhledat';
		$this->search_forum = 'Fórum';
		$this->search_group = 'Skupina';
		$this->search_guest = 'Host';
		$this->search_in = 'Hledat v';
		$this->search_in_posts = 'Hledat jen v pøíspìvcích';
		$this->search_ip = 'IP';
		$this->search_joined = 'Zaloeno';
		$this->search_level = 'Úroveò';
		$this->search_match = 'vyhledat jen pøesnì zadaný výraz (napø. zadáte-li "AIM", ve výsledcích budou jen pøíspìvky, které obsahují právì slovo "AIM"';
		$this->search_matches = 'Oznaèené';
		$this->search_month = 'mìsíc';
		$this->search_months = 'mìsíce';
		$this->search_mysqldoc = 'Dokumentace MySQL';
		$this->search_newer = 'novìjích';
		$this->search_no_results = 'ádné výsledky nebyly nalezeny.';
		$this->search_no_words = 'Musíte urèit alespoò jednu podmínku pro vyhledávání.<br/><br/>Kadá podmínka musí obsahovat alespoò 3 znaky, (vèetnì písmen, èísel, apostrofù, a podtrítek).';
		$this->search_offline = 'Tento èlen je nyní nepøítomen';
		$this->search_older = 'starích';
		$this->search_online = 'Tento èlen je nyní pøítomen';
		$this->search_only_display = 'Zobrazit jen prvních';
		$this->search_partial_name = 'èásteèné znìní';
		$this->search_post_icon = 'Ikona pøíspìvku';
		$this->search_posted_on = 'Posláno';
		$this->search_posts = 'Pøíspìvky';
		$this->search_posts_by = 'Jen v pøíspìvcích od';
		$this->search_regex = 'vyhledat i slova obsahující hledaný výraz (napø. zadáte-li "hledat", ve výsledcích budou pøíspìvky obsahující slovo "hledat", ale i "vyhledat", "hledání" atd.';
		$this->search_regex_failed = 'Hledanému výrazu nic neodpovídá. Prohlédnìte si prosím dokumentaci MySQL pro nápovìdu "pøesného znìní".';
		$this->search_relevance = 'Hledanému výrazu odpovídá na %d%%';
		$this->search_replies = 'Pøíspìvky';
		$this->search_result = 'Vyhledat výsledky';
		$this->search_search = 'Vyhledat';
		$this->search_select_all = 'Oznaèit ve';
		$this->search_show_posts = 'Zobrazit jen pøíspìvky (jinak se zobrazí téma celé téma)';
		$this->search_sound = 'vyhledat i slova podobná zadanému výrazu';
		$this->search_starter = 'Zaloil(a)';
		$this->search_than = 'ne';
		$this->search_topic = 'Téma';
		$this->search_unreg = 'Neregistrovaní';
		$this->search_week = 'týden';
		$this->search_weeks = 'týdny';
		$this->search_year = 'rok';
	}

	function settings()
	{
		$this->settings = 'Nastavení';
		$this->settings_active = 'Active Users Settings'; //Translate
		$this->settings_allow = 'Povolit'; //Translate
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
		$this->topic_attached = 'Pøíloha:';
		$this->topic_attached_downloads = 'x shlédnuto';
		$this->topic_attached_filename = 'Soubor:';
		$this->topic_attached_image = 'Pøiloený obrázek:';
		$this->topic_attached_perm = 'Nemáte oprávnìní stáhnout tento soubor.';
		$this->topic_attached_size = 'Velikost:';
		$this->topic_attached_title = 'Pøíloha';
		$this->topic_avatar = 'Avatar';
		$this->topic_bottom = 'Pøejít dolù na stránku';
		$this->topic_create_poll = 'Vytvoøit nové téma s anketou';
		$this->topic_create_topic = 'Vytvoøit nové téma';
		$this->topic_delete = 'Smazat';
		$this->topic_delete_post = 'Smazat tento pøíspìvek';
		$this->topic_edit = 'Editovat';
		$this->topic_edit_post = 'Editovat tento pøíspìvek';
		$this->topic_edited = 'Poslední zmìna: %s od %s';
		$this->topic_error = 'Chyba';
		$this->topic_group = 'Skupina';
		$this->topic_guest = 'Host';
		$this->topic_ip = 'IP';
		$this->topic_joined = 'Zaloeno';
		$this->topic_level = 'Úroveò';
		$this->topic_links_aim = 'Poslat AIM zprávu uivateli %s';
		$this->topic_links_email = 'Poslat e-mail uivateli %s';
		$this->topic_links_gtalk = 'Poslat GTalk zprávu uivateli %s';
		$this->topic_links_icq = 'Poslat ICQ zprávu uivateli %s';
		$this->topic_links_msn = 'Poslat MSN zprávu uivateli %s';
		$this->topic_links_pm = 'Poslat privátní zprávu uivateli %s';
		$this->topic_links_web = 'Otevøít www stránky uivatele %s';
		$this->topic_links_yahoo = 'Proslat zprávu %s pøes Yahoo! Messenger';
		$this->topic_lock = 'Zamknout';
		$this->topic_locked = 'Téma zamèeno';
		$this->topic_move = 'Pøesunout';
		$this->topic_new_post = 'Pøíspìvek není pøeèten';
		$this->topic_newer = 'Novìjí téma';
		$this->topic_no_newer = 'Není tu ádné novìjí téma.';
		$this->topic_no_older = 'Není tu ádné starí téma.';
		$this->topic_no_votes = 'V této anketì nejsou zaznamenány ádné hlasy.';
		$this->topic_not_found = 'Téma nenalezeno';
		$this->topic_not_found_message = 'Téma  nebylo nalezeno. Buï bylo smazáno, pøesunuto, nebo neexistuje.';
		$this->topic_offline = 'This member is currently offline'; //Translate
		$this->topic_older = 'Starí téma';
		$this->topic_online = 'This member is currently online'; //Translate
		$this->topic_options = 'Volby tématu';
		$this->topic_pages = 'Stránky';
		$this->topic_perm_view = 'Nemáte oprávnìní prohlíet témata.';
		$this->topic_perm_view_guest = 'Nemáte oprávnìní prohlíet témata. Musíte se nejprve zaregistrovat.';
		$this->topic_pin = 'Zvýraznit';
		$this->topic_posted = 'Posláno';
		$this->topic_posts = 'Pøíspìvkù';
		$this->topic_print = 'Verze pro tisk';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'Smajlíci';
		$this->topic_qr_open_emoticons = 'Open Clickable Emoticons'; //Translate
		$this->topic_qr_open_mbcode = 'Otevøít MBCode';
		$this->topic_quickreply = 'Rychlá odpovìï';
		$this->topic_quote = 'Do odpovìdi "ocitovat" tento pøíspìvek';
		$this->topic_reply = 'Odpovìdìt na téma';
		$this->topic_split = 'Spojit';
		$this->topic_split_finish = 'Dokonèit celé spojení';
		$this->topic_split_keep = 'Nepøesouvat tento pøíspìvek';
		$this->topic_split_move = 'Pøesunout tento pøíspìvek';
		$this->topic_subscribe = 'Zaslat informace na mùj e-mail, pokud se zde objeví nový pøíspìvek';
		$this->topic_top = 'Jít na zaèátek stránky';
		$this->topic_unlock = 'Odemknout';
		$this->topic_unpin = 'Zruit zvýraznìní';
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = 'Neregistrován';
		$this->topic_view = 'Prohlédnout výsledky';
		$this->topic_viewing = 'Prohlíet téma';
		$this->topic_vote = 'Hlasovat';
		$this->topic_vote_count_plur = '%d hlasù';
		$this->topic_vote_count_sing = '%d hlas';
		$this->topic_votes = 'hlasù celkem';
	}

	function universal()
	{
		$this->aim = 'AIM';
		$this->based_on = 'based on';
		$this->board_by = 'Od:';
		$this->charset = 'utf-8';
		$this->continue = 'Pokraèovat';
		$this->date_long = 'M j, Y';
		$this->date_short = 'n/j/y';
		$this->delete = 'Smazat';
		$this->direction = 'ltr';
		$this->edit = 'Editovat';
		$this->email = 'Email';
		$this->gtalk = 'GT';
		$this->icq = 'ICQ';
		$this->msn = 'MSN';
		$this->new_message = 'Nová zpráva';
		$this->new_poll = 'Nová anketa';
		$this->new_topic = 'Nové téma';
		$this->no = 'Ne';
		$this->powered = 'Powered by';
		$this->private_message = 'PM';
		$this->quote = 'Citovat';
		$this->recount_forums = 'Recounted forums! Total topics: %d. Total posts: %d.'; //Translate
		$this->reply = 'Odpovìdìt';
		$this->seconds = 'Vteøin';
		$this->select_all = 'Vybrat ve';
		$this->sep_decimals = ',';
		$this->sep_thousands = '.';
		$this->spoiler = 'Spoiler'; //Translate
		$this->submit = 'Odeslat';
		$this->subscribe = 'Subscribe'; //Translate
		$this->time_long = ', g:i a'; //Translate
		$this->time_only = 'g:i a'; //Translate
		$this->today = 'dnes';
		$this->website = 'WWW';
		$this->yahoo = 'Yahoo';
		$this->yes = 'Ano';
		$this->yesterday = 'vèera';
	}
}
?>

