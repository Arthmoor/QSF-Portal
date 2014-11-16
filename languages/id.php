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
 * Indonesian language module
 *
 * @author Deco <deco1895@yahoo.com>
 * @since 1.1.0
 **/
class id
{
	function active()
	{
		$this->active_last_action = 'Aksi terakhir';
		$this->active_modules_active = 'Lihat aktif';
		$this->active_modules_board = 'Lihat Index';
		$this->active_modules_cp = 'Menggunakan Control Panel';
		$this->active_modules_forum = 'Viewing a forum: %s'; //Translate
		$this->active_modules_help = 'Memakai Bantuan';
		$this->active_modules_login = 'Logging In/Out';
		$this->active_modules_members = 'Lihat Daftar Anggota';
		$this->active_modules_mod = 'Moderating'; //Translate
		$this->active_modules_pm = 'Memakai Messenger';
		$this->active_modules_post = 'Posting'; //Translate
		$this->active_modules_printer = 'Printing a topic: %s'; //Translate
		$this->active_modules_profile = 'Viewing a profile: %s'; //Translate
		$this->active_modules_recent = 'Viewing recent posts'; //Translate
		$this->active_modules_search = 'Mencari';
		$this->active_modules_topic = 'Viewing a topic: %s'; //Translate
		$this->active_time = 'Time'; //Translate
		$this->active_user = 'User'; //Translate
		$this->active_users = 'User Aktif';
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
		$this->board_active_users = 'User Aktif';
		$this->board_birthdays = 'Hari ini Ulang Tahun:';
		$this->board_bottom_page = 'Go to the bottom of the page'; //Translate
		$this->board_can_post = 'Anda dapat membalas forum ini.';
		$this->board_can_topics = 'Anda hanya dapat melihat tetapi anda tidak bisa membuat topik baru.';
		$this->board_cant_post = 'Anda tidak bisa meReply di forum ini.';
		$this->board_cant_topics = 'Anda tidak dapat melihat atau membuat topik baru di forum ini.';
		$this->board_forum = 'Forum'; //Translate
		$this->board_guests = 'Tamu';
		$this->board_last_post = 'Posting terakhir';
		$this->board_mark = 'Marking Posts As Read'; //Translate
		$this->board_mark1 = 'All posts and forums have been marked as read.'; //Translate
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = 'Anggota';
		$this->board_message = '%s Pesan';
		$this->board_most_online = 'The most users ever online was %d on %s.'; //Translate
		$this->board_nobday = 'Tidak ada anggota yang berulang tahun hari ini.';
		$this->board_nobody = 'Tidak ada anggota yang online.';
		$this->board_nopost = 'Tidak ada Post';
		$this->board_noview = 'Anda tidak punya izin untuk melihat board.';
		$this->board_regfirst = 'Anda tidak punya izin untuk melihat board. Jika anda mendaftar, Anda baru bisa melihatnya.';
		$this->board_replies = 'Balasan';
		$this->board_stats = 'Statistik';
		$this->board_stats_string = '%s users have registered. Welcome to our newest member, %s.<br />There are %s topics and %s replies for a total of %s posts.'; //Translate
		$this->board_top_page = 'Go to the top of the page'; //Translate
		$this->board_topics = 'Topik';
		$this->board_users = 'user';
		$this->board_write_topics = 'Anda dapat melihat dan membuat topik di forum ini.';
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
		$this->cp_aim = 'AIM';
		$this->cp_already_member = 'The email address you entered is already assigned to a member.'; //Translate
		$this->cp_apr = 'April'; //Translate
		$this->cp_aug = 'Agustus';
		$this->cp_avatar_current = 'Avatar yang anda pakai';
		$this->cp_avatar_error = 'Avatar Error'; //Translate
		$this->cp_avatar_must_select = 'Anda harus memilih Avatar.';
		$this->cp_avatar_none = 'Avatar tidak ditampilkan';
		$this->cp_avatar_pixels = 'pixels'; //Translate
		$this->cp_avatar_select = 'Pilih avatar';
		$this->cp_avatar_size_height = 'Tinggi avatar anda harus 1 sampai';
		$this->cp_avatar_size_width = 'Lebar avatar anda harus 1 sampai';
		$this->cp_avatar_upload = 'Upload avatar melalui file koleksi anda';
		$this->cp_avatar_upload_failed = 'Upload avatar gagal. Tipe file yang anda upload tidak terdaftar dalam list database kami.';
		$this->cp_avatar_upload_not_image = 'Anda hanya dapat mengupload file image seagai avatar anda.';
		$this->cp_avatar_upload_too_large = 'File avatar terlalu besar. Maximum adalah %d kilobytes.';
		$this->cp_avatar_url = 'Berikan URL untuk avatar anda';
		$this->cp_avatar_use = 'Tampilkan avatar';
		$this->cp_bday = 'Tanggal Lahir';
		$this->cp_been_updated = 'Profile telah diupdate.';
		$this->cp_been_updated1 = 'Avatar telah diupdate.';
		$this->cp_been_updated_prefs = 'Preference berhasil diupdate.';
		$this->cp_changing_pass = 'Editing Password'; //Translate
		$this->cp_contact_pm = 'Memperbolehkan yang lain untuk menghubungi anda via messenger?';
		$this->cp_cp = 'Control Panel'; //Translate
		$this->cp_current_avatar = 'Avatar digunakan';
		$this->cp_current_time = 'It is currently %s.'; //Translate
		$this->cp_custom_title = 'Custom Member Title'; //Translate
		$this->cp_custom_title2 = 'This is a privledge reserved for board administrators'; //Translate
		$this->cp_dec = 'Desember';
		$this->cp_editing_avatar = 'Mengedit Avatar';
		$this->cp_editing_profile = 'Mengedit Profil';
		$this->cp_email = 'Email'; //Translate
		$this->cp_email_form = 'Memperbolehkan yang lain untuk mengirim email kepada anda?';
		$this->cp_email_invaid = 'Alamat email yang anda masukan tidak sah.';
		$this->cp_err_avatar = 'Error Mengupdate Avatar';
		$this->cp_err_updating = 'Error Mengupdate Profile';
		$this->cp_feb = 'Februari';
		$this->cp_file_type = 'Avatar yang anda masukan tidak valid. Periksa dengan benar URL yang anda berikan, dan harus bertipe gif, jpg, atau png.';
		$this->cp_format = 'Format Nama';
		$this->cp_gtalk = 'GTalk Account'; //Translate
		$this->cp_header = 'User Control Panel'; //Translate
		$this->cp_height = 'Tinggi';
		$this->cp_icq = 'Nomor ICQ';
		$this->cp_interest = 'Kesukaan';
		$this->cp_jan = 'Januari';
		$this->cp_july = 'Juli';
		$this->cp_june = 'Juni';
		$this->cp_label_edit_avatar = 'Edit Avatar'; //Translate
		$this->cp_label_edit_pass = 'Edit Password'; //Translate
		$this->cp_label_edit_prefs = 'Edit Preference';
		$this->cp_label_edit_profile = 'Edit Profil';
		$this->cp_label_edit_sig = 'Edit Signature'; //Translate
		$this->cp_label_edit_subs = 'Edit Subscription';
		$this->cp_language = 'Bahasa';
		$this->cp_less_charac = 'Nama anda tidak boleh lebih dari 32 karakter.';
		$this->cp_location = 'Lokasi';
		$this->cp_login_first = 'Anda harus Log in terlebih dahulu untuk mengakses control panel anda.';
		$this->cp_mar = 'Maret';
		$this->cp_may = 'Mei';
		$this->cp_msn = 'MSN Identitas';
		$this->cp_must_orig = 'Nama anda harus nama asli.';
		$this->cp_new_notmatch = 'Password baru yang anda masukkan tidak cocok.';
		$this->cp_new_pass = 'Password baru';
		$this->cp_no_flash = 'Avatar Flash tidak diperbolehkan.';
		$this->cp_not_exist = 'Waktu yang anda maksud (%s) tidak ada!';
		$this->cp_nov = 'November'; //Translate
		$this->cp_oct = 'Oktober';
		$this->cp_old_notmatch = 'Password lama yang anda masukkan tidak cocok dalam database kami.';
		$this->cp_old_pass = 'Password lama';
		$this->cp_pass_notvaid = 'Password tidak valid. Pastikan anda mengetik dengan benar.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = 'Rubah Preference';
		$this->cp_preview_sig = 'Signature Preview:'; //Translate
		$this->cp_privacy = 'Option Pribadi';
		$this->cp_repeat_pass = 'Ulangi password baru';
		$this->cp_sept = 'September'; //Translate
		$this->cp_show_active = 'Show your activities when you are using the board?'; //Translate
		$this->cp_show_email = 'Tampilkan alamat email di profil?';
		$this->cp_signature = 'Signature'; //Translate
		$this->cp_size_max = 'Avatar terlalu besar. Yang diperbolehkan adalah %s by %s pixel.';
		$this->cp_skin = 'Board Skin'; //Translate
		$this->cp_sub_change = 'Merubah Subscription';
		$this->cp_sub_delete = 'Hapus';
		$this->cp_sub_expire = 'Tanggal Berakhir';
		$this->cp_sub_name = 'Nama Subscription';
		$this->cp_sub_no_params = 'Tidak ada paramater yang diberikan.';
		$this->cp_sub_success = 'Anda sekarang disubscribe ke %s.';
		$this->cp_sub_type = 'Tipe Subscription';
		$this->cp_sub_updated = 'Subscription berhasil dihapus.';
		$this->cp_topic_option = 'Option Topik';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = 'Profil diupdate';
		$this->cp_updated1 = 'Avatar diupdate';
		$this->cp_updated_prefs = 'Preference diupdated';
		$this->cp_user_exists = 'User dengan nama tersebut sudah ada.';
		$this->cp_valided = 'Password telah divalidasi dan dirubah.';
		$this->cp_view_avatar = 'Perlihatkan Avatar?';
		$this->cp_view_emoticon = 'Perlihatkan Emoticon ?';
		$this->cp_view_signature = 'Perlihatkan Signature ?';
		$this->cp_welcome = 'Selamat datang di user control panel. Disini anda dapat merubah setting konfigurasi account anda. Silahkan pilih option diatas.';
		$this->cp_width = 'Lebar';
		$this->cp_www = 'Homepage'; //Translate
		$this->cp_yahoo = 'Yahoo Identitas';
		$this->cp_zone = 'Zona Waktu';
	}

	function email()
	{
		$this->email_blocked = 'Member tidak mau menerima email dari form ini.';
		$this->email_email = 'Email'; //Translate
		$this->email_msgtext = 'Email Body:'; //Translate
		$this->email_no_fields = 'Silahkan kembali dan pastikan semua field terisi.';
		$this->email_no_member = 'Tidak ada anggota yang ditemukan dengan nama itu';
		$this->email_no_perm = 'Anda tidak punya izin mengirim email.';
		$this->email_sent = 'Email anda terkirim.';
		$this->email_subject = 'Subjek:';
		$this->email_to = 'Untuk:';
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
		$this->forum_by = 'Oleh';
		$this->forum_can_post = 'Anda dapat membalas forum ini.';
		$this->forum_can_topics = 'Anda dapat melihat topik dalam forum ini.';
		$this->forum_cant_post = 'Anda tidak bisa membalas kedalam forum ini.';
		$this->forum_cant_topics = 'Anda tidak bisa melihat topik dalam forum ini.';
		$this->forum_dot = 'dot'; //Translate
		$this->forum_dot_detail = 'Ditampilkan jika anda telah posting di salah satu topik';
		$this->forum_forum = 'Forum'; //Translate
		$this->forum_guest = 'Tamu';
		$this->forum_hot = 'Hot'; //Translate
		$this->forum_icon = 'Icon pesan';
		$this->forum_jump = 'Lompat ke posting baru di dalam topik';
		$this->forum_last = 'Posting terakhir';
		$this->forum_locked = 'Dikunci';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = 'Pindah';
		$this->forum_msg = '%s Pesan';
		$this->forum_new = 'Baru';
		$this->forum_new_poll = 'Buat polling baru';
		$this->forum_new_topic = 'Buat topik baru';
		$this->forum_no_topics = 'Tdak ada topik untuk ditampilkan di forum ini.';
		$this->forum_noexist = 'Forum yang dimaksud tidak ada.';
		$this->forum_nopost = 'Tidak ada post';
		$this->forum_not = 'Tidak';
		$this->forum_noview = 'Anda tidak punya izin untuk melihat forum.';
		$this->forum_pages = 'Halaman';
		$this->forum_pinned = 'Selesai';
		$this->forum_pinned_topic = 'Topik selesai';
		$this->forum_poll = 'Polling';
		$this->forum_regfirst = 'Anda tidak punya kewenangan untuk melihat forum. Jika telah terdaftar, baru anda bisa melihatnya.';
		$this->forum_replies = 'Balasan';
		$this->forum_starter = 'Dimulai';
		$this->forum_sub = 'Sub-Forum'; //Translate
		$this->forum_sub_last_post = 'Posting teralhir';
		$this->forum_sub_replies = 'Balasan';
		$this->forum_sub_topics = 'Topik';
		$this->forum_subscribe = 'Kirimkan E-mail ke saya ketika topik ini dibalas';
		$this->forum_topic = 'Topik';
		$this->forum_views = 'Dilihat';
		$this->forum_write_topics = 'Anda dapat membuat topik di forum ini.';
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
		$this->help_available_files = 'Help'; //Translate
		$this->help_confirm = 'Are you sure you want to delete'; //Translate
		$this->help_content = 'Article content'; //Translate
		$this->help_delete = 'Delete Help Article'; //Translate
		$this->help_deleted = 'Help Article Deleted.'; //Translate
		$this->help_edit = 'Edit Help Article'; //Translate
		$this->help_edited = 'Help article updated.'; //Translate
		$this->help_inserted = 'Article inserted into the database.'; //Translate
		$this->help_no_articles = 'No help articles were found in the database.'; //Translate
		$this->help_no_title = 'You can\'t create a help article without a title.'; //Translate
		$this->help_none = 'Tidak ada file help di database';
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
		$this->login_cant_logged = 'Anda tidak bisa login. Cek username dan password yang benar.<br /><br />Karena case sensitif, jadi \'UsErNaMe\' berbeda dari \'Username\'. Juga, cek apakah cookies browser anda sudah diaktifkan.';
		$this->login_cookies = 'Cookies harus enable untuk login.';
		$this->login_forgot_pass = 'Forgot your password?'; //Translate
		$this->login_header = 'Logging In'; //Translate
		$this->login_logged = 'Anda sekarang log in.';
		$this->login_now_out = 'Anda sekarang log out.';
		$this->login_out = 'Logging Out'; //Translate
		$this->login_pass = 'Password'; //Translate
		$this->login_pass_no_id = 'There is no member with the user name you entered.'; //Translate
		$this->login_pass_request = 'To complete the password reset, please click on the link sent to the email address associated with your account.'; //Translate
		$this->login_pass_reset = 'Reset Password'; //Translate
		$this->login_pass_sent = 'Your password has been reset. The new password has been sent to the email address associated with your account.'; //Translate
		$this->login_sure = 'Anda yakin ingin log off sebagai \'%s\'?';
		$this->login_user = 'User Name'; //Translate
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
		$this->main_activate = 'Account anda belum diaktifkan.';
		$this->main_activate_resend = 'Resend Email Aktifasi';
		$this->main_admincp = 'admin cp';
		$this->main_banned = 'Maaf anda telah didisable.';
		$this->main_code = 'Code'; //Translate
		$this->main_cp = 'Control panel';
		$this->main_full = 'Debug';
		$this->main_help = 'Help'; //Translate
		$this->main_load = 'load'; //Translate
		$this->main_login = 'login';
		$this->main_logout = 'logout';
		$this->main_mark = 'mark all';
		$this->main_mark1 = 'Mark all topics as read'; //Translate
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = 'Maaf, %s sudah tidak ada, karena banyaknya user yang terkoneksi.';
		$this->main_members = 'Anggota';
		$this->main_messenger = 'Messenger'; //Translate
		$this->main_new = 'baru';
		$this->main_next = 'selanjutnya';
		$this->main_prev = 'sebelumnya';
		$this->main_queries = 'query';
		$this->main_quote = 'Quote'; //Translate
		$this->main_recent = 'recent posts';
		$this->main_recent1 = 'View recent topics since your last visit'; //Translate
		$this->main_register = 'Daftar';
		$this->main_reminder = 'Mengingatkan';
		$this->main_reminder_closed = 'Forum ditutup hanya admin saja yang diperbolehkan.';
		$this->main_said = 'berkata';
		$this->main_search = 'Cari';
		$this->main_topics_new = 'Tidak ada posting-posting baru di forum ini.';
		$this->main_topics_old = 'Tidak ada posting baru di forum ini.';
		$this->main_welcome = 'Selamat datang';
		$this->main_welcome_guest = 'Selamat datang!';
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
		$this->members_all = 'Semua';
		$this->members_email = 'Email'; //Translate
		$this->members_email_member = 'Email ke anggota ini';
		$this->members_group = 'Grup';
		$this->members_joined = 'Bergabung';
		$this->members_list = 'Daftar Anggota';
		$this->members_member = 'Anggota';
		$this->members_pm = 'PM'; //Translate
		$this->members_posts = 'Posts'; //Translate
		$this->members_send_pm = 'Kirim pesan pribadi ke user ini';
		$this->members_title = 'Title'; //Translate
		$this->members_vist_www = 'Kunjungi \'s web site';
		$this->members_www = 'Web Site'; //Translate
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Apakah anda yakin ingin menghapus posting ini?';
		$this->mod_confirm_topic_delete = 'Apakah anda yakin ingin menghapus topik ini?';
		$this->mod_error_first_post = 'Anda tidak bisa mendelete topik diurutan pertama.';
		$this->mod_error_move_category = 'Anda tidak bisa memindahkan topik ke kategory.';
		$this->mod_error_move_create = 'You do not have permission to move topics to that forum.'; //Translate
		$this->mod_error_move_forum = 'Anda tidak bisa memindahkan topik ke forum yang sudah tidak ada.';
		$this->mod_error_move_global = 'You cannot move a global topic. Edit the topic before moving it.'; //Translate
		$this->mod_error_move_same = 'Anda tidak bisa memindahkan topik ke forum yang sudah ada topik tersebut.';
		$this->mod_label_controls = 'Moderator Kontrol';
		$this->mod_label_description = 'Deskripsi';
		$this->mod_label_emoticon = 'Konvert emoticon kedalam gambar ?';
		$this->mod_label_global = 'Global Topic'; //Translate
		$this->mod_label_mbcode = 'Format MbCode?'; //Translate
		$this->mod_label_move_to = 'Pindah ke';
		$this->mod_label_options = 'Option';
		$this->mod_label_post_delete = 'Hapus Posting';
		$this->mod_label_post_edit = 'Edit Posting';
		$this->mod_label_post_icon = 'Post Icon'; //Translate
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = 'Judul';
		$this->mod_label_title_original = 'Original Title'; //Translate
		$this->mod_label_title_split = 'Split Title'; //Translate
		$this->mod_label_topic_delete = 'Hapus Topik';
		$this->mod_label_topic_edit = 'Edit Topik';
		$this->mod_label_topic_lock = 'Kunci Topik';
		$this->mod_label_topic_move = 'Pindahkan Topik';
		$this->mod_label_topic_move_complete = 'Menyelesaikan transfer topik kedalam forum baru';
		$this->mod_label_topic_move_link = 'Transfer topik ke forum baru, tinggalkan link ke lokasi baru di forum lama.';
		$this->mod_label_topic_pin = 'Pin Topik';
		$this->mod_label_topic_split = 'Split Topic'; //Translate
		$this->mod_missing_post = 'Posting yang dimaksud tidak ada.';
		$this->mod_missing_topic = 'Topik yang dimaksud tidak ada.';
		$this->mod_no_action = 'Anda harus menentukan aksi.';
		$this->mod_no_post = 'Anda harus menentukan posting.';
		$this->mod_no_topic = 'Anda harus menentukan topik.';
		$this->mod_perm_post_delete = 'Anda tidak punya izin untuk menghapus posting ini.';
		$this->mod_perm_post_edit = 'Anda tidak punya izin untuk mengedit posting ini.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = 'Anda tidak punya izin untuk menghapus posting ini.';
		$this->mod_perm_topic_edit = 'Anda tidak punya izin untuk mengedit posting ini.';
		$this->mod_perm_topic_lock = 'Anda tidak punya izin untuk mengunci topik ini.';
		$this->mod_perm_topic_move = 'Anda tidak punya izin untuk memindahkan topik ini.';
		$this->mod_perm_topic_pin = 'Anda tidak punya izin untuk memberi pin topik ini.';
		$this->mod_perm_topic_split = 'You do not have permission to split this topic.'; //Translate
		$this->mod_perm_topic_unlock = 'Anda tidak punya izin untuk membuka kunci topik ini.';
		$this->mod_perm_topic_unpin = 'Anda tidak punya izin untuk membuka pin topik ini.';
		$this->mod_success_post_delete = 'Posting berhasil dihapus.';
		$this->mod_success_post_edit = 'Posting berhasil diedit.';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = 'The topic was successfully split.'; //Translate
		$this->mod_success_topic_delete = 'Posting berhasil dihapus.';
		$this->mod_success_topic_edit = 'Posting berhasil diedit.';
		$this->mod_success_topic_move = 'Posting berhasil dipindahkan ke forum baru.';
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
		$this->pm_cant_del = 'Anda tidak punya izin untuk menghapus pesan ini.';
		$this->pm_delallmsg = 'Hapus semua pesan';
		$this->pm_delete = 'Hapus';
		$this->pm_delete_selected = 'Delete Selected Messages'; //Translate
		$this->pm_deleted = 'Pesan dihapus.';
		$this->pm_deleted_all = 'Pesan dihapus.';
		$this->pm_error = 'There were problems sending your message to some of the recipients.<br /><br />The following members do not exist: %s<br /><br />The following members are not accepting personal messages: %s'; //Translate
		$this->pm_fields = 'Pesan anda tidak bisa dikirim. Pastikan semua field diisi.';
		$this->pm_flood = 'You have sent a message in the past %s seconds, and you may not send another right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->pm_folder_inbox = 'Inbox'; //Translate
		$this->pm_folder_new = '%s Baru';
		$this->pm_folder_sentbox = 'Sent';
		$this->pm_from = 'Dari';
		$this->pm_group = 'Grup';
		$this->pm_guest = 'Sebagai tamu, anda tidak bisa memakai messenger. Silahkan login atau mendaftar.';
		$this->pm_joined = 'Bergabung';
		$this->pm_messenger = 'Messenger'; //Translate
		$this->pm_msgtext = 'Pesan';
		$this->pm_multiple = 'Separate multiple recipients with ;'; //Translate
		$this->pm_no_folder = 'You must specify a folder.'; //Translate
		$this->pm_no_member = 'Tidak ada anggota yang ditemukan dengan id itu.';
		$this->pm_no_number = 'Tidak ada pesan ditemukan dengan nomor itu.';
		$this->pm_no_title = 'Tidak ada subjek';
		$this->pm_nomsg = 'Tidak ada pesan dalam folder.';
		$this->pm_noview = 'Anda tidak punya izin untuk melihat pesan.';
		$this->pm_offline = 'This member is currently offline'; //Translate
		$this->pm_online = 'This member is currently online'; //Translate
		$this->pm_personal = 'Personal Messenger'; //Translate
		$this->pm_personal_msging = 'Personal Messaging'; //Translate
		$this->pm_pm = 'PM'; //Translate
		$this->pm_posts = 'Posts'; //Translate
		$this->pm_preview = 'Preview'; //Translate
		$this->pm_recipients = 'Recipients'; //Translate
		$this->pm_reply = 'Reply'; //Translate
		$this->pm_send = 'Kirim';
		$this->pm_sendamsg = 'Kirim pesan';
		$this->pm_sendingpm = 'Mengirim Pesan Pribadi';
		$this->pm_sendon = 'Terkirim pada';
		$this->pm_success = 'Pesan anda berhasil dikirim.';
		$this->pm_sure_del = 'Anda yakin ingin menghapus pesan ini?';
		$this->pm_sure_delall = 'Anda yakin ingin menghapus semua pesan dalam folder ini?';
		$this->pm_title = 'Judul';
		$this->pm_to = 'Untuk';
	}

	function post()
	{
		$this->post_attach = 'Attachment';
		$this->post_attach_add = 'Tambah Attachment';
		$this->post_attach_disrupt = 'membuang atau menambah attachment tidak akan mempengaruhi posting yang telah anda tulis.';
		$this->post_attach_failed = 'Upload file attachment gagal. type file tidak sesuai dengan database kami.';
		$this->post_attach_not_allowed = 'Anda tidak bisa menyisipkan file type tersebut.';
		$this->post_attach_remove = 'Buang Attachment';
		$this->post_attach_too_large = 'File terlalu besar. Batas maksimal adalah %d KB.';
		$this->post_cant_create = 'Sebagai tamu, Anda tidak punya izin untuk membuat topik. jika anda mendaftar, anda baru bisa membuatnya.';
		$this->post_cant_create1 = 'Anda tidak punya izin untuk membuat topik.';
		$this->post_cant_enter = 'Voting anda ditolak. anda sudah pernah ikut vote, atau anda sudah pernah mengikutinya.';
		$this->post_cant_poll = 'Sebagai tamu, anda tidak punya izin untuk membuat poll. jika anda mendaftar, anda mungkin dapat membuatnya.';
		$this->post_cant_poll1 = 'Anda tidak punya izin untk membuat poll.';
		$this->post_cant_reply = 'Anda tidak punya izin untuk membalas topik di forum ini.';
		$this->post_cant_reply1 = 'Sebagai guest, Anda tidak punya izin untuk membalas topik. jika anda mendaftar, anda baru bisa.';
		$this->post_cant_reply2 = 'Anda tidak punya izin untuk membuat balasan ke topik.';
		$this->post_closed = 'Topik ini telah ditutup.';
		$this->post_create_poll = 'Buat polling';
		$this->post_create_topic = 'Buat Topik';
		$this->post_creating = 'Buat Topik';
		$this->post_creating_poll = 'Buat poll';
		$this->post_flood = 'posting anda tercatak %s detik, anda tidak bisa posting sekarang.<br /><br />Coba beberapa detik lagi.';
		$this->post_guest = 'Tamu';
		$this->post_icon = 'Post Icon'; //Translate
		$this->post_last_five = 'Lima posting terakhir dalam tampilan terbalik';
		$this->post_length = 'Cek panjang karakter';
		$this->post_msg = 'Message'; //Translate
		$this->post_must_msg = 'Anda harus menulis pesan ketika posting.';
		$this->post_must_options = 'You must include options when creating a new poll.'; //Translate
		$this->post_must_title = 'You must include a title when creating a new topic.'; //Translate
		$this->post_new_poll = 'Polling baru';
		$this->post_new_topic = 'Topik baru';
		$this->post_no_forum = 'Forum tidak ada.';
		$this->post_no_topic = 'Tidak ada topik yang dimaksud.';
		$this->post_no_vote = 'Anda harus memilih option untuk voting.';
		$this->post_option_emoticons = 'Konvert emoticon ke image ?';
		$this->post_option_global = 'Make this topic global?'; //Translate
		$this->post_option_mbcode = 'Format MbCode?'; //Translate
		$this->post_optional = 'optional'; //Translate
		$this->post_options = 'Option';
		$this->post_poll_options = 'Polling Option';
		$this->post_poll_row = 'Satu per baris';
		$this->post_posted = 'Diposting pada';
		$this->post_posting = 'Posting'; //Translate
		$this->post_preview = 'Preview'; //Translate
		$this->post_reply = 'Reply'; //Translate
		$this->post_reply_topic = 'Reply to topic'; //Translate
		$this->post_replying = 'Replying To Topic'; //Translate
		$this->post_replying1 = 'Replying'; //Translate
		$this->post_too_many_options = 'Anda harus mgisi 2 %d option kedalam polling.';
		$this->post_topic_detail = 'Deskripsi Topik';
		$this->post_topic_title = 'Judul Topik';
		$this->post_view_topic = 'Lihat seputar topik';
		$this->post_voting = 'Voting'; //Translate
	}

	function printer()
	{
		$this->printer_back = 'Kembali';
		$this->printer_not_found = 'Topik tidak dapat ditemukan. kemungkinan sudah dihapus, dipindahkan, atau memang tidak ada.';
		$this->printer_not_found_title = 'Topik tidak ditemukan';
		$this->printer_perm_topics = 'Anda tidak punya untuk melihat topik.';
		$this->printer_perm_topics_guest = 'Anda tidak punya izin untuk melihat topik. Jika anda mendaftar , anda baru bisa.';
		$this->printer_posted_on = 'Diposting pada';
		$this->printer_send = 'Kirim ke printer';
	}

	function profile()
	{
		$this->profile_aim_sn = 'AIM';
		$this->profile_av_sign = 'Avatar dan Signature';
		$this->profile_avatar = 'Avatar'; //Translate
		$this->profile_bday = 'Tanggal Lahir';
		$this->profile_contact = 'Kontak';
		$this->profile_email_address = 'Alamat Email';
		$this->profile_fav = 'Forum Favorit';
		$this->profile_fav_forum = '%s (%d%% of this member\'s posts)'; //Translate
		$this->profile_gtalk = 'GTalk Account'; //Translate
		$this->profile_icq_uin = 'Nomor ICQ';
		$this->profile_info = 'Informasi';
		$this->profile_interest = 'Kesukaan';
		$this->profile_joined = 'Joined'; //Translate
		$this->profile_last_post = 'Posting terakhir';
		$this->profile_list = 'Daftar Anggota';
		$this->profile_location = 'Lokasi';
		$this->profile_member = 'Grup Anggota';
		$this->profile_member_title = 'Status user';
		$this->profile_msn = 'Identitas MSN';
		$this->profile_must_user = 'Anda harus mengisi user untuk melihat profil';
		$this->profile_no_member = 'Tidak ada member dengan user id tersebut. Kemungkinan account sudah dihapus.';
		$this->profile_none = '[ None ]'; //Translate
		$this->profile_not_post = 'Belum memposting';
		$this->profile_offline = 'This member is currently offline'; //Translate
		$this->profile_online = 'This member is currently online'; //Translate
		$this->profile_pm = 'Pesan pribadi';
		$this->profile_postcount = '%s total, %s per day'; //Translate
		$this->profile_posts = 'Post';
		$this->profile_private = '[ Pribadi ]';
		$this->profile_profile = 'Profil';
		$this->profile_signature = 'Signature'; //Translate
		$this->profile_unkown = '[ Unknown ]'; //Translate
		$this->profile_view_profile = 'Lihat Profil';
		$this->profile_www = 'Homepage'; //Translate
		$this->profile_yahoo = 'Yahoo Identitas';
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
		$this->recent_by = 'Oleh';
		$this->recent_can_post = 'Anda dapat membalas forum ini.';
		$this->recent_can_topics = 'Anda dapat melihat topik dalam forum ini.';
		$this->recent_cant_post = 'Anda tidak bisa membalas kedalam forum ini.';
		$this->recent_cant_topics = 'Anda tidak bisa melihat topik dalam forum ini.';
		$this->recent_dot = 'dot'; //Translate
		$this->recent_dot_detail = 'Ditampilkan jika anda telah posting di salah satu topik';
		$this->recent_forum = 'Forum'; //Translate
		$this->recent_guest = 'Tamu';
		$this->recent_hot = 'Hot'; //Translate
		$this->recent_icon = 'Icon pesan';
		$this->recent_jump = 'Lompat ke posting baru di dalam topik';
		$this->recent_last = 'Posting terakhir';
		$this->recent_locked = 'Dikunci';
		$this->recent_moved = 'Pindah';
		$this->recent_msg = '%s Pesan';
		$this->recent_new = 'Baru';
		$this->recent_new_poll = 'Buat polling baru';
		$this->recent_new_topic = 'Buat topik baru';
		$this->recent_no_topics = 'Tdak ada topik untuk ditampilkan di forum ini.';
		$this->recent_noexist = 'Forum yang dimaksud tidak ada.';
		$this->recent_nopost = 'Tidak ada post';
		$this->recent_not = 'Tidak';
		$this->recent_noview = 'Anda tidak punya izin untuk melihat forum.';
		$this->recent_pages = 'Halaman';
		$this->recent_pinned = 'Selesai';
		$this->recent_pinned_topic = 'Topik selesai';
		$this->recent_poll = 'Polling';
		$this->recent_regfirst = 'Anda tidak punya kewenangan untuk melihat forum. Jika telah terdaftar, baru anda bisa melihatnya.';
		$this->recent_replies = 'Balasan';
		$this->recent_starter = 'Dimulai';
		$this->recent_sub = 'Sub-Forum'; //Translate
		$this->recent_sub_last_post = 'Posting teralhir';
		$this->recent_sub_replies = 'Balasan';
		$this->recent_sub_topics = 'Topik';
		$this->recent_subscribe = 'Kirimkan E-mail ke saya ketika topik ini dibalas';
		$this->recent_topic = 'Topik';
		$this->recent_views = 'Dilihat';
		$this->recent_write_topics = 'Anda dapat membuat topik di forum ini.';
	}

	function register()
	{
		$this->register_activated = 'Account telah diaktifkan';
		$this->register_activating = 'Aktivasi Account';
		$this->register_activation_error = 'Terjadi error ketika mengaktifkan account anda. cek browser anda untuk melihat full URL aktifasi. Jika terjadi masalah, Hubungi administrator untuk mengirimkan Email ke anda.';
		$this->register_confirm_passwd = 'Konfirmasi Password';
		$this->register_done = 'Anda teah terdaftar! Anda dapat login sekarang.';
		$this->register_email = 'Alamat Email';
		$this->register_email_invalid = 'Alamat Email yang anda masukkan salah.';
		$this->register_email_msg = 'This is an automated email generated by Quicksilver Forums, and sent to you in order'; //Translate
		$this->register_email_msg2 = 'for you to activate your account with'; //Translate
		$this->register_email_msg3 = 'Please click the following link, or paste it in to your web browser:'; //Translate
		$this->register_email_used = 'Email yang anda masukkan sudah dipakai oleh anggota lain.';
		$this->register_fields = 'Semua field tidak diisi.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = 'Please type the text shown in the image.'; //Translate
		$this->register_image_invalid = 'To verify you are a human registrant, you must type the text as shown in the image.'; //Translate
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'Anda telah terdaftar. Email telah terkirim ke %s dengan informasi dan cara untuk mengaktifkan account. Aktifasi account dibatasi hingga anda mengaktifkannya.';
		$this->register_name_invalid = 'Nama yang anda isikan terlalu panjang.';
		$this->register_name_taken = 'Nama member sudah ada.';
		$this->register_new_user = 'Desired User Name'; //Translate
		$this->register_pass_invalid = 'Password tidak valid. Isikan dengan huruf, nomor, dash, garis bawah, atau spasi, dan harus lebih dari 5 character.';
		$this->register_pass_match = 'Password yang dimasukkan tidak cocok.';
		$this->register_passwd = 'Password'; //Translate
		$this->register_reg = 'Daftar';
		$this->register_reging = 'Mendaftar';
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
		$this->search_advanced = 'Bantuan Tambahan';
		$this->search_avatar = 'Avatar'; //Translate
		$this->search_basic = 'Pencarian Sederhana';
		$this->search_characters = 'Karakter posting';
		$this->search_day = 'Hari';
		$this->search_days = 'Hari';
		$this->search_exact_name = 'nama eksak';
		$this->search_flood = 'You have searched in the past %s seconds, and you may not search right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->search_for = 'Mencari untuk kata';
		$this->search_forum = 'Forum'; //Translate
		$this->search_group = 'Group'; //Translate
		$this->search_guest = 'Guest'; //Translate
		$this->search_in = 'Cari di';
		$this->search_in_posts = 'Cari di posting-posting topik';
		$this->search_ip = 'IP'; //Translate
		$this->search_joined = 'Bergabung';
		$this->search_level = 'Member Level'; //Translate
		$this->search_match = 'Cari dengan kecocokan';
		$this->search_matches = 'Matches'; //Translate
		$this->search_month = 'Bulan';
		$this->search_months = 'Bulan';
		$this->search_mysqldoc = 'MySQL Dokumentasi';
		$this->search_newer = 'Baru';
		$this->search_no_results = 'Pencarian anda gagal.';
		$this->search_no_words = 'Anda harus menspesifikasikan search terms.<br /><br />Masing-masing term harus lebih dari, contoh : huruf, nomor, apostrop, dan garis bawah.';
		$this->search_offline = 'This member is currently offline'; //Translate
		$this->search_older = 'Lama';
		$this->search_online = 'This member is currently online'; //Translate
		$this->search_only_display = 'Tampilkan dengan pertama';
		$this->search_partial_name = 'nama partial';
		$this->search_post_icon = 'Post Icon'; //Translate
		$this->search_posted_on = 'Posted on';
		$this->search_posts = 'Post';
		$this->search_posts_by = 'Hanya di post oleh';
		$this->search_regex = 'Cari dengan ekspresi regular';
		$this->search_regex_failed = 'Regular ekspresi anda gagal. Lihat MySQL dokumentasi untuk melihat bantuan regular ekspresi.';
		$this->search_relevance = 'Post Relevansi: %d%%';
		$this->search_replies = 'Post';
		$this->search_result = 'Hasil pencarian';
		$this->search_search = 'Cari';
		$this->search_select_all = 'Plih semua';
		$this->search_show_posts = 'Tampilkan kecocokan';
		$this->search_sound = 'Cari dengan suara';
		$this->search_starter = 'Starter'; //Translate
		$this->search_than = 'than'; //Translate
		$this->search_topic = 'Topik';
		$this->search_unreg = 'Unregistered'; //Translate
		$this->search_week = 'Minggu';
		$this->search_weeks = 'Minggu';
		$this->search_year = 'Tahun';
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
		$this->topic_attached = 'Sisipkan file:';
		$this->topic_attached_downloads = 'download';
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = 'Anda tidak punya izin untuk mendownload file ini.';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = 'Sisipkan File';
		$this->topic_avatar = 'Avatar'; //Translate
		$this->topic_bottom = 'Go to the bottom of the page'; //Translate
		$this->topic_create_poll = 'Buat Poll baru';
		$this->topic_create_topic = 'Buat Topik baru';
		$this->topic_delete = 'Delete'; //Translate
		$this->topic_delete_post = 'Hapus posting ini';
		$this->topic_edit = 'Edit'; //Translate
		$this->topic_edit_post = 'Edit this post'; //Translate
		$this->topic_edited = 'Terakhir diedit pada %s oleh %s';
		$this->topic_error = 'Error'; //Translate
		$this->topic_group = 'Grup';
		$this->topic_guest = 'Tamu';
		$this->topic_ip = 'IP'; //Translate
		$this->topic_joined = 'Bergabung';
		$this->topic_level = 'Level anggota';
		$this->topic_links_aim = 'Kirim pesan melalui AIM ke %s';
		$this->topic_links_email = 'Kirim Email ke %s';
		$this->topic_links_gtalk = 'Send a GTalk message to %s'; //Translate
		$this->topic_links_icq = 'Kirim pesan ICQ ke %s';
		$this->topic_links_msn = 'View %s\'s MSN profile'; //Translate
		$this->topic_links_pm = 'Kirim pesan pribadi ke %s';
		$this->topic_links_web = 'Kunjungi web site %s\'s';
		$this->topic_links_yahoo = 'Kirim pesan ke %s dengan Yahoo! Messenger';
		$this->topic_lock = 'Kunci';
		$this->topic_locked = 'Topik dikunci';
		$this->topic_move = 'Pindahkan';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = 'Newer Topic'; //Translate
		$this->topic_no_newer = 'There is no newer topic.'; //Translate
		$this->topic_no_older = 'There is no older topic.'; //Translate
		$this->topic_no_votes = 'Tidak ada voting untuk polling ini.';
		$this->topic_not_found = 'Topik tidak ditemukan';
		$this->topic_not_found_message = 'Topik tidak bisa ditemukan. Kemungkinan sudah dihapus, Dipindahkan, atau mungkin tidak ada.';
		$this->topic_offline = 'This member is currently offline'; //Translate
		$this->topic_older = 'Older Topic'; //Translate
		$this->topic_online = 'This member is currently online'; //Translate
		$this->topic_options = 'Topik Option';
		$this->topic_pages = 'Halaman';
		$this->topic_perm_view = 'Anda tidak punya izin untuk melihat topik ini.';
		$this->topic_perm_view_guest = 'Anda tidak punya izin untuk melihat topik ini.Jika mendaftar sebagai member, baru anda bisa melihatnya.';
		$this->topic_pin = 'Pin'; //Translate
		$this->topic_posted = 'Posted'; //Translate
		$this->topic_posts = 'Post';
		$this->topic_print = 'Lihat Print preview';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'Emoticons'; //Translate
		$this->topic_qr_open_emoticons = 'Open Clickable Emoticons'; //Translate
		$this->topic_qr_open_mbcode = 'Open MBCode'; //Translate
		$this->topic_quickreply = 'Quick Reply'; //Translate
		$this->topic_quote = 'Balas dengan kutip dari posting ini';
		$this->topic_reply = 'Balas ke Topik';
		$this->topic_split = 'Split'; //Translate
		$this->topic_split_finish = 'Finish All Splitting'; //Translate
		$this->topic_split_keep = 'Do not move this post'; //Translate
		$this->topic_split_move = 'Move this post'; //Translate
		$this->topic_subscribe = 'Kirimkan E-mail ke saya jika topik ini dibalas';
		$this->topic_top = 'Go to the top of the page'; //Translate
		$this->topic_unlock = 'Unlock'; //Translate
		$this->topic_unpin = 'Unpin'; //Translate
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = 'Tidak terdaftar';
		$this->topic_view = 'Lihat Hasil';
		$this->topic_viewing = 'Lihat Topic';
		$this->topic_vote = 'Vote'; //Translate
		$this->topic_vote_count_plur = '%d votes'; //Translate
		$this->topic_vote_count_sing = '%d vote'; //Translate
		$this->topic_votes = 'Votes'; //Translate
	}

	function universal()
	{
		$this->aim = 'AIM'; //Translate
		$this->based_on = 'based on';
		$this->board_by = 'Oleh';
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
		$this->sep_decimals = '.'; //Translate
		$this->sep_thousands = ','; //Translate
		$this->spoiler = 'Spoiler'; //Translate
		$this->submit = 'Submit'; //Translate
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
