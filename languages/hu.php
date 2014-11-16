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
 * Hungarian language module
 *
 * @author Szász Attila <helpdesk@maximedia.hu>
 * @since 1.0.0
 **/
class hu
{
	function active()
	{
		$this->active_last_action = 'Utolsó mûvelet';
		$this->active_modules_active = 'Aktív tagok';
		$this->active_modules_board = 'Index';
		$this->active_modules_cp = 'Beállítások megjelenítése';
		$this->active_modules_forum = 'Viewing a forum: %s'; //Translate
		$this->active_modules_help = 'Segítség';
		$this->active_modules_login = 'Ki/Bejelentkezés';
		$this->active_modules_members = 'Tagok listája';
		$this->active_modules_mod = 'Moderálás';
		$this->active_modules_pm = 'Üzenetküldõ';
		$this->active_modules_post = 'Beírás';
		$this->active_modules_printer = 'Printing a topic: %s'; //Translate
		$this->active_modules_profile = 'Viewing a profile: %s'; //Translate
		$this->active_modules_recent = 'Viewing recent posts'; //Translate
		$this->active_modules_search = 'Keresés';
		$this->active_modules_topic = 'Viewing a topic: %s'; //Translate
		$this->active_time = 'Idõ';
		$this->active_user = 'Tag';
		$this->active_users = 'Aktív tagok';
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
		$this->board_active_users = 'Aktív felhasználók';
		$this->board_birthdays = 'Szülinapok:';
		$this->board_bottom_page = 'Go to the bottom of the page'; //Translate
		$this->board_can_post = 'Válaszolhatsz ebben a fórumban.';
		$this->board_can_topics = 'Belenézhetsz, de nem írhatsz ebbe a fórumba.';
		$this->board_cant_post = 'Nem válaszolhatsz ebben a fórumban.';
		$this->board_cant_topics = 'Nem nézheted meg, és nem írhatsz ebbe a fórumba.';
		$this->board_forum = 'Fórum';
		$this->board_guests = 'vendég';
		$this->board_last_post = 'Utolsó beírás';
		$this->board_mark = 'Beírás olvasottként jelölése';
		$this->board_mark1 = 'Minden beírás olvasottként van jelölve.';
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = 'tag';
		$this->board_message = '%s üzenet';
		$this->board_most_online = 'The most users ever online was %d on %s.'; //Translate
		$this->board_nobday = 'Ma senkinek sincs szülinapja.';
		$this->board_nobody = 'Egyetlen tag sincs bejelentkezve.';
		$this->board_nopost = 'Nincs beírás';
		$this->board_noview = 'Nincs jogod ide benézni.';
		$this->board_regfirst = 'Nincs jogod ide benézni. HA regisztrálod magad, akkor igen.';
		$this->board_replies = 'Válaszok';
		$this->board_stats = 'Statisztikák';
		$this->board_stats_string = '%s regisztrált tag. Üdvözöljük legújabb tagunkat, %s -t.<br /> Összesen %s téma és %s válasz a(z) %s beírásra.';
		$this->board_top_page = 'Go to the top of the page'; //Translate
		$this->board_topics = 'Témák';
		$this->board_users = 'tag';
		$this->board_write_topics = 'Jogod van témát nyitni ebben a fórumban.';
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
		$this->cp_aim = 'AIM név';
		$this->cp_already_member = 'Az általad megadott email címet már valaki használja.';
		$this->cp_apr = 'Április';
		$this->cp_aug = 'Augusztus';
		$this->cp_avatar_current = 'Kiskép';
		$this->cp_avatar_error = 'Kiskép hiba';
		$this->cp_avatar_must_select = 'Ki kell választanod egy kisképet.';
		$this->cp_avatar_none = 'Ne használjon kisképet.';
		$this->cp_avatar_pixels = 'pixel';
		$this->cp_avatar_select = 'Válassz egy kisképet';
		$this->cp_avatar_size_height = 'A kisképed magassága: 1 - ';
		$this->cp_avatar_size_width = 'A kisképed szélessége: 1 - ';
		$this->cp_avatar_upload = 'Tölts fel egy kisképet a gépedrõl';
		$this->cp_avatar_upload_failed = 'A kiskép feltöltése nem sikerült. Az általad megadott fájl talán nem létezik.';
		$this->cp_avatar_upload_not_image = 'Csak saját használatra tölthetsz fel kisképet.';
		$this->cp_avatar_upload_too_large = 'A feltöltésre váró kiskép túl nagy. A maximum méret: %d kilobyte.';
		$this->cp_avatar_url = 'Add meg az URL címet a kisképhez';
		$this->cp_avatar_use = 'Feltöltött kiskép használata';
		$this->cp_bday = 'Szülinap';
		$this->cp_been_updated = 'Az adatlapd frissítve lett.';
		$this->cp_been_updated1 = 'A kisképed felülírva.';
		$this->cp_been_updated_prefs = 'Beállításaid frissítve.';
		$this->cp_changing_pass = 'Jelszó szerkesztése';
		$this->cp_contact_pm = 'Megengeded, hogy a többiek priviben felkeressenek?';
		$this->cp_cp = 'Beállítópult';
		$this->cp_current_avatar = 'Aktuális kiskép';
		$this->cp_current_time = 'Most %s.';
		$this->cp_custom_title = 'Custom Member Title'; //Translate
		$this->cp_custom_title2 = 'This is a privledge reserved for board administrators'; //Translate
		$this->cp_dec = 'December'; //Translate
		$this->cp_editing_avatar = 'Kiskép szerkesztése';
		$this->cp_editing_profile = 'Adatlap szerkesztése';
		$this->cp_email = 'Email'; //Translate
		$this->cp_email_form = 'Küldhetnek emailt neked a többi tagok?';
		$this->cp_email_invaid = 'A beírt email cím nem helyes.';
		$this->cp_err_avatar = 'Kiskép feltöltési hiba';
		$this->cp_err_updating = 'Adatlap frissítési hiba';
		$this->cp_feb = 'Február';
		$this->cp_file_type = 'A megadott URL alatt nics meg a kép. Elfogadott terjesztések: gif, jpg, png.';
		$this->cp_format = 'Név szerkesztése';
		$this->cp_gtalk = 'GTalk Account'; //Translate
		$this->cp_header = 'Felhasználói vezérlõpult';
		$this->cp_height = 'Magasság';
		$this->cp_icq = 'ICQ szám';
		$this->cp_interest = 'Érdeklõdés';
		$this->cp_jan = 'Január';
		$this->cp_july = 'Július';
		$this->cp_june = 'Június';
		$this->cp_label_edit_avatar = 'Kiskép szerkesztése';
		$this->cp_label_edit_pass = 'Jelszó szerkesztése';
		$this->cp_label_edit_prefs = 'Testreszabás';
		$this->cp_label_edit_profile = 'Adatlap szerkesztése';
		$this->cp_label_edit_sig = 'Edit Signature'; //Translate
		$this->cp_label_edit_subs = 'Beiratkozások szerkesztése';
		$this->cp_language = 'Nyelv';
		$this->cp_less_charac = 'A neved 32 karakternél rövidebb kell legyen.';
		$this->cp_location = 'Lakhely';
		$this->cp_login_first = 'Be kell jelentkezned!';
		$this->cp_mar = 'Március';
		$this->cp_may = 'Május';
		$this->cp_msn = 'MSN név';
		$this->cp_must_orig = 'A nevednek egyeznie kell az eredetivel. Csak kis-nagybetût változtathatsz.';
		$this->cp_new_notmatch = 'Az új jelszavak nem találnak.';
		$this->cp_new_pass = 'Új jelszó';
		$this->cp_no_flash = 'Tiltottak kisképe villog.';
		$this->cp_not_exist = 'A megadott (%s) dátum nem létezik!';
		$this->cp_nov = 'November'; //Translate
		$this->cp_oct = 'Október';
		$this->cp_old_notmatch = 'A régi jelszó nem egyezik az általunk tárolttal.';
		$this->cp_old_pass = 'Régi jelszó';
		$this->cp_pass_notvaid = 'A megadott jelszó nem helyes formátumban van.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = 'Testreszabás';
		$this->cp_preview_sig = 'Signature Preview:'; //Translate
		$this->cp_privacy = 'Személyes opciók';
		$this->cp_repeat_pass = 'Új jelszó újra';
		$this->cp_sept = 'Szeptember';
		$this->cp_show_active = 'Mutassuk a tevékenységeid, miközben az oldalt használod?';
		$this->cp_show_email = 'Megjeleníted az email címet az adatlapon?';
		$this->cp_signature = 'Aláírás';
		$this->cp_size_max = 'A megadott kiskép túl nagy. A maximális méret: %s - %s pixel.';
		$this->cp_skin = 'Asztal huzat';
		$this->cp_sub_change = 'Feliratkozások megváltoztatása';
		$this->cp_sub_delete = 'Töröl';
		$this->cp_sub_expire = 'Lejárati dátum';
		$this->cp_sub_name = 'Feliratkozási név';
		$this->cp_sub_no_params = 'Nem adtál meg paramétert.';
		$this->cp_sub_success = 'Feliratkoztál erre: %s.';
		$this->cp_sub_type = 'Feliratkozás típusa';
		$this->cp_sub_updated = 'A kiválasztott feliratkozásokat töröltük.';
		$this->cp_topic_option = 'Téma beállításai';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = 'Adatlap frissítve';
		$this->cp_updated1 = 'Kiskép frissítve';
		$this->cp_updated_prefs = 'Beállítások frissítve';
		$this->cp_user_exists = 'Már van ilyen nevû felhasználó.';
		$this->cp_valided = 'A jelszavad sikeresen frissítve.';
		$this->cp_view_avatar = 'Kisképek megtekintése?';
		$this->cp_view_emoticon = 'Emotikonok megtekintése?';
		$this->cp_view_signature = 'Aláírások megtekintése?';
		$this->cp_welcome = 'Üdvözölünk a vezérlõpulton. Itt beállíthatod az adataid. Válassz az alábbi lehetõségekbõl.';
		$this->cp_width = 'Szélesség';
		$this->cp_www = 'Honlap';
		$this->cp_yahoo = 'Yahoo név';
		$this->cp_zone = 'Idõzóna';
	}

	function email()
	{
		$this->email_blocked = 'A kiválasztott tag nem fogad emailt ezen a felületen keresztül';
		$this->email_email = 'Email'; //Translate
		$this->email_msgtext = 'Email test:';
		$this->email_no_fields = 'Menj vissza és tölts ki minden adatot.';
		$this->email_no_member = 'Nincs ilyen nevû tag';
		$this->email_no_perm = 'Nincs jogod emailt küldeni errõl a felületrõl.';
		$this->email_sent = 'Az emailed elküldtük.';
		$this->email_subject = 'Téma:';
		$this->email_to = 'Címzett:';
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
		$this->forum_by = 'Feladó';
		$this->forum_can_post = 'Válaszolhatsz ebben a fórumban.';
		$this->forum_can_topics = 'Megtekintheted a témákat ebben a fórumban.';
		$this->forum_cant_post = 'Nem válaszolhatsz ebben a fórumban.';
		$this->forum_cant_topics = 'Nem nézhetsz ide be.';
		$this->forum_dot = 'pont';
		$this->forum_dot_detail = 'megmutatja, ha írtál ide';
		$this->forum_forum = 'Fórum';
		$this->forum_guest = 'Vendég';
		$this->forum_hot = 'Forró';
		$this->forum_icon = 'Üzenet ikonja';
		$this->forum_jump = 'Ugrás a legújabb bejegyzésre';
		$this->forum_last = 'Utolsó bejegyzés';
		$this->forum_locked = 'Zárolva';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = 'Áthelyezve';
		$this->forum_msg = '%s üzenet';
		$this->forum_new = 'Új';
		$this->forum_new_poll = 'Új szavazógép';
		$this->forum_new_topic = 'Új téma nyitása';
		$this->forum_no_topics = 'Nincsenek témák ebben a fórumban.';
		$this->forum_noexist = 'A megadott fórum nem létezik.';
		$this->forum_nopost = 'Nincs beírás';
		$this->forum_not = 'Nem';
		$this->forum_noview = 'Nincs jogod ide benézni.';
		$this->forum_pages = 'oldal';
		$this->forum_pinned = 'Kitûzött';
		$this->forum_pinned_topic = 'Tiltott téma';
		$this->forum_poll = 'Szavazógép';
		$this->forum_regfirst = 'Nincs jogod ide benézni. HA regisztrálod magad, akkor igen.';
		$this->forum_replies = 'Válaszok';
		$this->forum_starter = 'Témanyitó';
		$this->forum_sub = 'Altéma';
		$this->forum_sub_last_post = 'Utolsó bejegyzés';
		$this->forum_sub_replies = 'Válaszok';
		$this->forum_sub_topics = 'Témák';
		$this->forum_subscribe = 'E-mail küldése új bejegyzéskor';
		$this->forum_topic = 'Téma';
		$this->forum_views = 'Megjelenítések';
		$this->forum_write_topics = 'Nyithatsz témákat ebben a fórumban.';
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
		$this->help_available_files = 'Segítség';
		$this->help_confirm = 'Are you sure you want to delete'; //Translate
		$this->help_content = 'Article content'; //Translate
		$this->help_delete = 'Delete Help Article'; //Translate
		$this->help_deleted = 'Help Article Deleted.'; //Translate
		$this->help_edit = 'Edit Help Article'; //Translate
		$this->help_edited = 'Help article updated.'; //Translate
		$this->help_inserted = 'Article inserted into the database.'; //Translate
		$this->help_no_articles = 'No help articles were found in the database.'; //Translate
		$this->help_no_title = 'You can\'t create a help article without a title.'; //Translate
		$this->help_none = 'A Segítség nem elérhetõ. Sajnáljuk.';
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
		$this->login_cookies = 'A Cookie-k engedélyezve kell legyenek a belépéshez.';
		$this->login_forgot_pass = 'Elfeletetted a jelszavad?';
		$this->login_header = 'Bejelentkezés...';
		$this->login_logged = 'Be vagy jelentkezve.';
		$this->login_now_out = 'Ki vagy jelentkezve.';
		$this->login_out = 'Kijelentkezés...';
		$this->login_pass = 'Jelszó';
		$this->login_pass_no_id = 'Nincs ilyen nevû tagunk.';
		$this->login_pass_request = 'To complete the password reset, please click on the link sent to the email address associated with your account.'; //Translate
		$this->login_pass_reset = 'Jelszó nullázása';
		$this->login_pass_sent = 'A jelszavad nulláztuk. Az új jelszót elküldtük az email címedre.';
		$this->login_sure = 'Biztos kijelentkezik \'%s\'?';
		$this->login_user = 'Név';
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
		$this->main_activate = 'A fiókod még nem aktív.';
		$this->main_activate_resend = 'Aktiváló email újraküldése';
		$this->main_admincp = 'admin felület';
		$this->main_banned = 'A moderátorok kitiltottak innen.';
		$this->main_code = 'Kód';
		$this->main_cp = 'Vezérlõpult';
		$this->main_full = 'Teljes';
		$this->main_help = 'segítség';
		$this->main_load = 'betöltés';
		$this->main_login = 'bejelentkezés';
		$this->main_logout = 'kijelentkezés';
		$this->main_mark = 'mark all';
		$this->main_mark1 = 'Mark all topics as read'; //Translate
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = 'Sajnáljuk, de %s nem elérhetõ, túl sok a bejelentkezett felhasználó.';
		$this->main_members = 'tagok';
		$this->main_messenger = 'üzenõ';
		$this->main_new = 'új';
		$this->main_next = 'következõ';
		$this->main_prev = 'elõzõ';
		$this->main_queries = 'kérés';
		$this->main_quote = 'Idézet';
		$this->main_recent = 'recent posts';
		$this->main_recent1 = 'View recent topics since your last visit'; //Translate
		$this->main_register = 'regisztráció';
		$this->main_reminder = 'Emlékeztetõ';
		$this->main_reminder_closed = 'Az oldal zárva vanr és csak a karbantartók láthatják.';
		$this->main_said = 'mondta';
		$this->main_search = 'keresés';
		$this->main_topics_new = 'Nincs új téma ebben a fórumban.';
		$this->main_topics_old = 'Nincs új beírás ebben a fórumban.';
		$this->main_welcome = 'Üdvözölünk';
		$this->main_welcome_guest = 'Üdvözölünk!';
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
		$this->members_all = 'minden';
		$this->members_email = 'Email'; //Translate
		$this->members_email_member = 'Email küldése ennek a tagnak';
		$this->members_group = 'Csoport';
		$this->members_joined = 'Belépett';
		$this->members_list = 'Tagok listája';
		$this->members_member = 'Tag';
		$this->members_pm = 'Privi';
		$this->members_posts = 'Beírások';
		$this->members_send_pm = 'Privát üzenet küldése';
		$this->members_title = 'Cím';
		$this->members_vist_www = 'A tag honlapjának meglátogatása';
		$this->members_www = 'Honlap';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Biztos, hogy törölni akarod ezt a beírást?';
		$this->mod_confirm_topic_delete = 'Biztos, hogy törölni akarod ezt a témát?';
		$this->mod_error_first_post = 'Nem törölheted az elsõ beírást.';
		$this->mod_error_move_category = 'Nem helyezhetsz át egy témát egy kategóriába.';
		$this->mod_error_move_create = 'You do not have permission to move topics to that forum.'; //Translate
		$this->mod_error_move_forum = 'Nem helyezhetsz át egy témát egy nemlétezõ fórumba.';
		$this->mod_error_move_global = 'You cannot move a global topic. Edit the topic before moving it.'; //Translate
		$this->mod_error_move_same = 'Nem helyezhetsz át egy témát ugyanabba a fórumba.';
		$this->mod_label_controls = 'Moderátor beállításai';
		$this->mod_label_description = 'Leírás';
		$this->mod_label_emoticon = 'Konvertáljuk az emotikonokat képekké?';
		$this->mod_label_global = 'Globális téma';
		$this->mod_label_mbcode = 'MbKód formázás?';
		$this->mod_label_move_to = 'Áthelyezés';
		$this->mod_label_options = 'Opciók';
		$this->mod_label_post_delete = 'Beírás törlése';
		$this->mod_label_post_edit = 'Beírás szerkesztése';
		$this->mod_label_post_icon = 'Post Icon'; //Translate
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = 'Cím';
		$this->mod_label_title_original = 'Eredeti cím';
		$this->mod_label_title_split = 'Cím darabolása';
		$this->mod_label_topic_delete = 'Téma törlése';
		$this->mod_label_topic_edit = 'Téma szerkesztése';
		$this->mod_label_topic_lock = 'Téma zárolása';
		$this->mod_label_topic_move = 'Téma áthelyezése';
		$this->mod_label_topic_move_complete = 'Téma teljes áthelyezése az új fórumba';
		$this->mod_label_topic_move_link = 'Téma teljes áthelyezése az új fórumba, és link hagyása a régiben.';
		$this->mod_label_topic_pin = 'Téma kitûzése';
		$this->mod_label_topic_split = 'Téma darabolása';
		$this->mod_missing_post = 'Az illetõ beírás nem létezik.';
		$this->mod_missing_topic = 'Az illetõ téma nem létezik.';
		$this->mod_no_action = 'Meg kell adni egy mûveletet.';
		$this->mod_no_post = 'Meg kell adni egy beírást.';
		$this->mod_no_topic = 'Meg kell adni egy témát.';
		$this->mod_perm_post_delete = 'Nincs jogod törölni ezt a beírást.';
		$this->mod_perm_post_edit = 'Nincs jogod szerkeszteni ezt a beírást.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = 'Nincs jogod törölni ezt a témát.';
		$this->mod_perm_topic_edit = 'Nincs jogod szerkeszteni ezt a témát.';
		$this->mod_perm_topic_lock = 'Nincs jogod zárolni ezt a témát.';
		$this->mod_perm_topic_move = 'Nincs jogod áthelyezni ezt a témát.';
		$this->mod_perm_topic_pin = 'Nincs jogod kitûzni ezt a témát.';
		$this->mod_perm_topic_split = 'Nincs jogod darabolni a témát.';
		$this->mod_perm_topic_unlock = 'Nincs jogod kioldani ezt a témát.';
		$this->mod_perm_topic_unpin = 'Nincs jogod levenni a kitûzést errõl a témáról.';
		$this->mod_success_post_delete = 'A beírás sikeresen törölve.';
		$this->mod_success_post_edit = 'A beírás sikeresen szerkesztve.';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = 'A témát sikeresen daraboltuk.';
		$this->mod_success_topic_delete = 'A téma sikeresen törölve.';
		$this->mod_success_topic_edit = 'A téma sikeresen szerkesztve.';
		$this->mod_success_topic_move = 'A téma sikeresen át lett helyezve.';
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
		$this->pm_cant_del = 'Nincs jogod törölni ezt az üzenetet.';
		$this->pm_delallmsg = 'Minden üzenet törlése';
		$this->pm_delete = 'Töröl';
		$this->pm_delete_selected = 'Delete Selected Messages'; //Translate
		$this->pm_deleted = 'Üzenet törölve.';
		$this->pm_deleted_all = 'Üzenetek törölve.';
		$this->pm_error = 'There were problems sending your message to some of the recipients.<br /><br />The following members do not exist: %s<br /><br />The following members are not accepting personal messages: %s'; //Translate
		$this->pm_fields = 'Az üzenetet nem lehet elküldeni. Minen kért mezõ ki van töltve?';
		$this->pm_flood = 'You have sent a message in the past %s seconds, and you may not send another right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->pm_folder_inbox = 'Beérkezett üzenetek';
		$this->pm_folder_new = '%s új';
		$this->pm_folder_sentbox = 'Sent';
		$this->pm_from = 'Feladó';
		$this->pm_group = 'Csoport';
		$this->pm_guest = 'Látogatóként nem használhatod az üzenõt. Jelentkezz be, vagy regisztrálj';
		$this->pm_joined = 'regisztrálva';
		$this->pm_messenger = 'Üzenõ';
		$this->pm_msgtext = 'Üzenet szövege';
		$this->pm_multiple = 'Separate multiple recipients with ;'; //Translate
		$this->pm_no_folder = 'Meg kell adni egy mappát.';
		$this->pm_no_member = 'nincs ilyen tag.';
		$this->pm_no_number = 'Nincs ilyen számú üzenet.';
		$this->pm_no_title = 'Nincs téma';
		$this->pm_nomsg = 'Nincs üzenet ebben a mappában.';
		$this->pm_noview = 'Nincs jogod megnézni ezt az üzenenetet.';
		$this->pm_offline = 'This member is currently offline'; //Translate
		$this->pm_online = 'This member is currently online'; //Translate
		$this->pm_personal = 'Privát üzenõ';
		$this->pm_personal_msging = 'Privát üzenet küldése';
		$this->pm_pm = 'PÜ';
		$this->pm_posts = 'Beírás';
		$this->pm_preview = 'Preview'; //Translate
		$this->pm_recipients = 'Recipients'; //Translate
		$this->pm_reply = 'Válasz';
		$this->pm_send = 'Küldés';
		$this->pm_sendamsg = 'Üzenet küldése';
		$this->pm_sendingpm = 'Privát üzenet küldése';
		$this->pm_sendon = 'Elküldve';
		$this->pm_success = 'Sikeres küldés.';
		$this->pm_sure_del = 'Biztos, hogy törölni akarod ezt az üzenetet?';
		$this->pm_sure_delall = 'Biztos, hogy törölni akarsz minden üzenetet?';
		$this->pm_title = 'Téma';
		$this->pm_to = 'Címzett';
	}

	function post()
	{
		$this->post_attach = 'Csatolások';
		$this->post_attach_add = 'Csatolás hozzáadása';
		$this->post_attach_disrupt = 'A csatolás hozzáadása vagy megszakítása nem tünteti el az üzeneted.';
		$this->post_attach_failed = 'A csatolás feltöltése nem sikerült.';
		$this->post_attach_not_allowed = 'Nem csatolhatsz ilyen fájltípust.';
		$this->post_attach_remove = 'Csatolás eltávolítása';
		$this->post_attach_too_large = 'Túl nagy a megadott fájl. Maximális méret: %d kilobyte.';
		$this->post_cant_create = 'Vendégként nincs jogod témát nyitni. Regisztrálj!';
		$this->post_cant_create1 = 'Nincs jogod témát nyitni.';
		$this->post_cant_enter = 'Nem szavazhatsz. Lehet, hogy már szavaztál, vagy nincs jogod hozzá.';
		$this->post_cant_poll = 'Vendégként nem hozhatsz létre szavazógépet. Regisztrálj!';
		$this->post_cant_poll1 = 'nincs jogod szavazógépet indítani.';
		$this->post_cant_reply = 'Nincs jogod válaszolni ebben a fórumban.';
		$this->post_cant_reply1 = 'Vendégként nem válaszolhatsz ebben a fórumban. Regisztrálj!';
		$this->post_cant_reply2 = 'Nnics jogod válaszolni a témára.';
		$this->post_closed = 'A téma zárva van.';
		$this->post_create_poll = 'Szavazógép létrehozása';
		$this->post_create_topic = 'Téma nyitása';
		$this->post_creating = 'Téma nyitása';
		$this->post_creating_poll = 'Szavazógép létrehozása';
		$this->post_flood = 'Az elmúlt %s másodpercben már írtál.<br /><br />Próbáld újra pár másodperc múlva.';
		$this->post_guest = 'Vendég';
		$this->post_icon = 'Ikon küldése';
		$this->post_last_five = 'Utolsó öt beírás fordított sorrendben';
		$this->post_length = 'Méret ellenõrzése';
		$this->post_msg = 'Üzenet';
		$this->post_must_msg = 'Be kell írni egy üzenetet.';
		$this->post_must_options = 'Meg kell adni választási lehetõségeket.';
		$this->post_must_title = 'Meg kell adni egy címet.';
		$this->post_new_poll = 'Új szavazógép';
		$this->post_new_topic = 'Új téma';
		$this->post_no_forum = 'Az illetõ fórum nincs meg.';
		$this->post_no_topic = 'Nincs megadva téma.';
		$this->post_no_vote = 'Válassz, mire szavazol.';
		$this->post_option_emoticons = 'Emotikonok képpé alakítása?';
		$this->post_option_global = 'Globálissá tesszük a témát?';
		$this->post_option_mbcode = 'MbKód formázás?';
		$this->post_optional = 'választható';
		$this->post_options = 'Opciók';
		$this->post_poll_options = 'Szavazógép opciók';
		$this->post_poll_row = 'Soronként egy';
		$this->post_posted = 'Feladva';
		$this->post_posting = 'Feladás';
		$this->post_preview = 'Preview'; //Translate
		$this->post_reply = 'Válasz';
		$this->post_reply_topic = 'Témára válaszol';
		$this->post_replying = 'Témára válaszol';
		$this->post_replying1 = 'Válaszol';
		$this->post_too_many_options = 'A szavazógép 2 és %d közötti opciókból áll.';
		$this->post_topic_detail = 'Téma leírása';
		$this->post_topic_title = 'Téma címe';
		$this->post_view_topic = 'Tejles megjelenítés';
		$this->post_voting = 'Szavazás';
	}

	function printer()
	{
		$this->printer_back = 'Vissza';
		$this->printer_not_found = 'A téma nem található. Lehet, hogy épp törölték, vagy áthelyezték.';
		$this->printer_not_found_title = 'Nincs meg a téma';
		$this->printer_perm_topics = 'Nincs jogod megnézni a témákat.';
		$this->printer_perm_topics_guest = 'Nincs jogod megnézni a témákat. Regisztrálj!';
		$this->printer_posted_on = 'Feladva';
		$this->printer_send = 'Nyomtatás';
	}

	function profile()
	{
		$this->profile_aim_sn = 'AIM név';
		$this->profile_av_sign = 'Kiskép és aláírás';
		$this->profile_avatar = 'Kiskép';
		$this->profile_bday = 'Szül. dátum';
		$this->profile_contact = 'Elérés';
		$this->profile_email_address = 'Email cím';
		$this->profile_fav = 'Kedvenc fórum';
		$this->profile_fav_forum = '%s (%d%% of this member\'s posts)'; //Translate
		$this->profile_gtalk = 'GTalk Account'; //Translate
		$this->profile_icq_uin = 'ICQ szám';
		$this->profile_info = 'Információ';
		$this->profile_interest = 'Érdeklõdés';
		$this->profile_joined = 'Joined'; //Translate
		$this->profile_last_post = 'Utolsó beírás';
		$this->profile_list = 'Tagok listája';
		$this->profile_location = 'Lakhely';
		$this->profile_member = 'Tagok csoportja';
		$this->profile_member_title = 'Tag szintje';
		$this->profile_msn = 'MSN név';
		$this->profile_must_user = 'Meg kell adni egy tagot.';
		$this->profile_no_member = 'Nincs ilyen tag. Lehet, hogy törölték.';
		$this->profile_none = '[ Üres ]';
		$this->profile_not_post = 'még nem írt sehová.';
		$this->profile_offline = 'This member is currently offline'; //Translate
		$this->profile_online = 'This member is currently online'; //Translate
		$this->profile_pm = 'Privát üzenetek';
		$this->profile_postcount = '%s total, %s per day'; //Translate
		$this->profile_posts = 'Hozzászólás';
		$this->profile_private = '[ Privi ]';
		$this->profile_profile = 'Adatlap';
		$this->profile_signature = 'Aláírás';
		$this->profile_unkown = '[ Ismeretlen ]';
		$this->profile_view_profile = 'Adatlap megtekintése';
		$this->profile_www = 'Honlap';
		$this->profile_yahoo = 'Yahoo név';
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
		$this->recent_by = 'Feladó';
		$this->recent_can_post = 'Válaszolhatsz ebben a fórumban.';
		$this->recent_can_topics = 'Megtekintheted a témákat ebben a fórumban.';
		$this->recent_cant_post = 'Nem válaszolhatsz ebben a fórumban.';
		$this->recent_cant_topics = 'Nem nézhetsz ide be.';
		$this->recent_dot = 'pont';
		$this->recent_dot_detail = 'megmutatja, ha írtál ide';
		$this->recent_forum = 'Fórum';
		$this->recent_guest = 'Vendég';
		$this->recent_hot = 'Forró';
		$this->recent_icon = 'Üzenet ikonja';
		$this->recent_jump = 'Ugrás a legújabb bejegyzésre';
		$this->recent_last = 'Utolsó bejegyzés';
		$this->recent_locked = 'Zárolva';
		$this->recent_moved = 'Áthelyezve';
		$this->recent_msg = '%s üzenet';
		$this->recent_new = 'Új';
		$this->recent_new_poll = 'Új szavazógép';
		$this->recent_new_topic = 'Új téma nyitása';
		$this->recent_no_topics = 'Nincsenek témák ebben a fórumban.';
		$this->recent_noexist = 'A megadott fórum nem létezik.';
		$this->recent_nopost = 'Nincs beírás';
		$this->recent_not = 'Nem';
		$this->recent_noview = 'Nincs jogod ide benézni.';
		$this->recent_pages = 'oldal';
		$this->recent_pinned = 'Kitûzött';
		$this->recent_pinned_topic = 'Tiltott téma';
		$this->recent_poll = 'Szavazógép';
		$this->recent_regfirst = 'Nincs jogod ide benézni. HA regisztrálod magad, akkor igen.';
		$this->recent_replies = 'Válaszok';
		$this->recent_starter = 'Témanyitó';
		$this->recent_sub = 'Altéma';
		$this->recent_sub_last_post = 'Utolsó bejegyzés';
		$this->recent_sub_replies = 'Válaszok';
		$this->recent_sub_topics = 'Témák';
		$this->recent_subscribe = 'E-mail küldése új bejegyzéskor';
		$this->recent_topic = 'Téma';
		$this->recent_views = 'Megjelenítések';
		$this->recent_write_topics = 'Nyithatsz témákat ebben a fórumban.';
	}

	function register()
	{
		$this->register_activated = 'Regisztrációd aktiválva!';
		$this->register_activating = 'Regisztráció aktiválása';
		$this->register_activation_error = 'Hiba történt aktiválás közben. Az aktiválási emailt ellenõrizd. Ha a probléma továbbra is fennáll, írj az adminnak, hogy még egyszer küldje el az emailt.';
		$this->register_confirm_passwd = 'Jelszó újra';
		$this->register_done = 'sikeres regisztráció! Most már beléphetsz.';
		$this->register_email = 'Email cím';
		$this->register_email_invalid = 'A megadott email cím hibás.';
		$this->register_email_msg = 'This is an automated email generated by Quicksilver Forums, and sent to you in order'; //Translate
		$this->register_email_msg2 = 'for you to activate your account with'; //Translate
		$this->register_email_msg3 = 'Please click the following link, or paste it in to your web browser:'; //Translate
		$this->register_email_used = 'A megadott email címen már valaki regisztrált.';
		$this->register_fields = 'Nincs kitöltve minden mezõ.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = 'Kérlek, írd be a képen látható szöveget.';
		$this->register_image_invalid = 'Annak érdekében, hogy ellenõrizni lehessen a feliratkozó emberi mivoltát, be kell írni a képen látható szöveget.';
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'Sikeresen feliratkozotál. Elküldtünk egy emailt a %s címre a szükséges aktiválási részletekkel. A fiókod korlátozott lesz, amíg nincs aktiválva.';
		$this->register_name_invalid = 'A megadott név túl hosszú.';
		$this->register_name_taken = 'Ez a név már foglalt.';
		$this->register_new_user = 'Tag név';
		$this->register_pass_invalid = 'A megadott jelszó nem helyes formátumú, vagy rövidebb, mint 5 karakter.';
		$this->register_pass_match = 'A beírt jelszavak nem találnak.';
		$this->register_passwd = 'Jelszó';
		$this->register_reg = 'Regisztrálás';
		$this->register_reging = 'Regisztráció';
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
		$this->search_advanced = 'További lehetõségek';
		$this->search_avatar = 'Avatar'; //Translate
		$this->search_basic = 'Alapkeresés';
		$this->search_characters = 'karakter egy beírásban';
		$this->search_day = 'nap';
		$this->search_days = 'nap';
		$this->search_exact_name = 'pontos név';
		$this->search_flood = 'You have searched in the past %s seconds, and you may not search right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->search_for = 'Keresés';
		$this->search_forum = 'Fórum';
		$this->search_group = 'Group'; //Translate
		$this->search_guest = 'Vendég';
		$this->search_in = 'Keresés';
		$this->search_in_posts = 'Csak a beírásokban keress.';
		$this->search_ip = 'IP'; //Translate
		$this->search_joined = 'belépett';
		$this->search_level = 'Member Level'; //Translate
		$this->search_match = 'Találatok alapján keress';
		$this->search_matches = 'Találatok';
		$this->search_month = 'hónap';
		$this->search_months = 'hónap';
		$this->search_mysqldoc = 'MySQL Dokumentáció';
		$this->search_newer = 'soha';
		$this->search_no_results = 'Nincs találat.';
		$this->search_no_words = 'Meg kell adni pár keresési kritériumot.<br /><br />Mindenik legalább 3 karakter hosszú kell legyen.';
		$this->search_offline = 'This member is currently offline'; //Translate
		$this->search_older = 'régebbi';
		$this->search_online = 'This member is currently online'; //Translate
		$this->search_only_display = 'Csak az elsõt jeleníti meg';
		$this->search_partial_name = 'részleges név';
		$this->search_post_icon = 'Ikon beírása';
		$this->search_posted_on = 'Feladva';
		$this->search_posts = 'Beírások';
		$this->search_posts_by = 'Csak a beírásokban';
		$this->search_regex = 'Közönséges kifejezés';
		$this->search_regex_failed = 'A szabványos kifejezés hibás. Olvasd el a MySQL dokumentációt, ahol többet megtudhatsz a szabványos kifejezésekrõl.';
		$this->search_relevance = 'Beírás fontossága: %d%%';
		$this->search_replies = 'Beírás';
		$this->search_result = 'Keresés eredménye';
		$this->search_search = 'Keresés';
		$this->search_select_all = 'Mindent kijelöl';
		$this->search_show_posts = 'Talált beírások';
		$this->search_sound = 'Keresés hang alapján';
		$this->search_starter = 'Témanyitó';
		$this->search_than = 'mint';
		$this->search_topic = 'Téma';
		$this->search_unreg = 'Unregistered'; //Translate
		$this->search_week = 'hét';
		$this->search_weeks = 'hét';
		$this->search_year = 'év';
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
		$this->topic_attached = 'Csatolt fájl:';
		$this->topic_attached_downloads = 'letöltés';
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = 'Nincs jogod letölteni ezt a fájlt.';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = 'Csatolt fájl';
		$this->topic_avatar = 'Avatar'; //Translate
		$this->topic_bottom = 'Go to the bottom of the page'; //Translate
		$this->topic_create_poll = 'Új szavazógép létrehozása';
		$this->topic_create_topic = 'Új téma indítása';
		$this->topic_delete = 'Törlés';
		$this->topic_delete_post = 'Beírás törlése';
		$this->topic_edit = 'Szerkesztés';
		$this->topic_edit_post = 'Beírás szerkesztése';
		$this->topic_edited = 'Utoljára szerkesztve: %s, %s által.';
		$this->topic_error = 'Hiba';
		$this->topic_group = 'Csoport';
		$this->topic_guest = 'Vendég';
		$this->topic_ip = 'IP'; //Translate
		$this->topic_joined = 'belépett';
		$this->topic_level = 'Tag szintje';
		$this->topic_links_aim = 'AIM üzenet elküldve %s részére.';
		$this->topic_links_email = 'Email elküldve %s részére.';
		$this->topic_links_gtalk = 'Send a GTalk message to %s'; //Translate
		$this->topic_links_icq = 'ICQ üzenet elküldve %s részére.';
		$this->topic_links_msn = '%s MSN adatlapja';
		$this->topic_links_pm = 'Privát üzenet küldése %s részére';
		$this->topic_links_web = '%s honlapjának meglátogatása';
		$this->topic_links_yahoo = 'Yahoo! Messenger üzenet küldése %s részére';
		$this->topic_lock = 'Zárol';
		$this->topic_locked = 'Téma lezárva';
		$this->topic_move = 'Áthelyez';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = 'Newer Topic'; //Translate
		$this->topic_no_newer = 'There is no newer topic.'; //Translate
		$this->topic_no_older = 'There is no older topic.'; //Translate
		$this->topic_no_votes = 'Itt még nem szavazott senki.';
		$this->topic_not_found = 'Téma nem található';
		$this->topic_not_found_message = 'Nem találom a témát.';
		$this->topic_offline = 'This member is currently offline'; //Translate
		$this->topic_older = 'Older Topic'; //Translate
		$this->topic_online = 'This member is currently online'; //Translate
		$this->topic_options = 'Téma beállításai';
		$this->topic_pages = 'Oldal';
		$this->topic_perm_view = 'Nincs jogod megnézni a témákat.';
		$this->topic_perm_view_guest = 'Nnics jogod megnézni a témákat. Regisztrálj!';
		$this->topic_pin = 'Kitûzve';
		$this->topic_posted = 'Feladva';
		$this->topic_posts = 'Beírás';
		$this->topic_print = 'Nyomtatható változat';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'Emoticons'; //Translate
		$this->topic_qr_open_emoticons = 'Open Clickable Emoticons'; //Translate
		$this->topic_qr_open_mbcode = 'Open MBCode'; //Translate
		$this->topic_quickreply = 'Quick Reply'; //Translate
		$this->topic_quote = 'Idézve válaszol';
		$this->topic_reply = 'Válasz erre';
		$this->topic_split = 'Darabol';
		$this->topic_split_finish = 'Minden darabolás kész';
		$this->topic_split_keep = 'Ne mozdítsd el ezt a beírást';
		$this->topic_split_move = 'Mozdítsd el a beírást';
		$this->topic_subscribe = 'Email küldése, ha itt hozzászólnak a témához.';
		$this->topic_top = 'Oldal tetejére ugrás';
		$this->topic_unlock = 'Felold';
		$this->topic_unpin = 'Kitûzést levesz';
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = 'Nem regisztrált';
		$this->topic_view = 'Eredmények megtekintése';
		$this->topic_viewing = 'Téma megtekintése';
		$this->topic_vote = 'Szavazás';
		$this->topic_vote_count_plur = '%d szavazat';
		$this->topic_vote_count_sing = '%d szavazat';
		$this->topic_votes = 'Szavazatok';
	}

	function universal()
	{
		$this->aim = 'AIM'; //Translate
		$this->based_on = 'based on';
		$this->board_by = 'Feladó';
		$this->charset = 'utf-8';
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
		$this->submit = 'Mehet';
		$this->subscribe = 'Subscribe'; //Translate
		$this->time_long = ', g:i a'; //Translate
		$this->time_only = 'g:i a'; //Translate
		$this->today = 'Ma';
		$this->website = 'WWW'; //Translate
		$this->yahoo = 'Yahoo'; //Translate
		$this->yes = 'Yes'; //Translate
		$this->yesterday = 'Tegnap';
	}
}
?>
