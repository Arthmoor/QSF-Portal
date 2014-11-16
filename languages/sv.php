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
 * Swedish language module
 *
 * @author Markus Höglund <markus@pidelipom.com>
 * @author Oskar Bergström <oskar@rapidfish.se
 * @since 1.0.1
 **/
class sv
{
	function active()
	{
		$this->active_last_action = 'Senaste Kommando';
		$this->active_modules_active = 'Visar Aktiva Användare';
		$this->active_modules_board = 'Visar Index';
		$this->active_modules_cp = 'Använder Kontrollpanelen';
		$this->active_modules_forum = 'Visar forum: %s';
		$this->active_modules_help = 'Använder Hjälp';
		$this->active_modules_login = 'Loggar In/Ut';
		$this->active_modules_members = 'Visar Medlemslista';
		$this->active_modules_mod = 'Administrerar';
		$this->active_modules_pm = 'Använder Snabbmeddelande';
		$this->active_modules_post = 'Skapar Inlägg';
		$this->active_modules_printer = 'Skriver inlägg: %s';
		$this->active_modules_profile = 'Visa profil: %s';
		$this->active_modules_recent = 'Kollar nya inlägg';
		$this->active_modules_search = 'Söker';
		$this->active_modules_topic = 'Visa ämne: %s';
		$this->active_time = 'Tid';
		$this->active_user = 'Användare';
		$this->active_users = 'Aktiva Användare';
	}

	function admin()
	{
		$this->admin_add_emoticons = 'Lägg till emoticons';
		$this->admin_add_member_titles = 'lägg till automatiska medlemstitlar';
		$this->admin_add_templates = 'Lägg till HTML mallar';
		$this->admin_ban_ips = 'Blockera IP adresser';
		$this->admin_censor = 'Censurerade ord';
		$this->admin_cp_denied = 'Tillång Nekad';
		$this->admin_cp_warning = 'Admin KP är avstängd tills du har tagit bort <b>install</b> mapp, eftersom den utgör en säkerhets risk.';
		$this->admin_create_forum = 'Skapa ett forum';
		$this->admin_create_group = 'Skapa en grupp';
		$this->admin_create_help = 'Skapa en hjälpartikel';
		$this->admin_create_skin = 'Skapa ett skal';
		$this->admin_db = 'Databas';
		$this->admin_db_backup = 'Gör en backup av databasen';
		$this->admin_db_conn = 'Ändra inställningar för anslutningen';
		$this->admin_db_optimize = 'Optimera databasen';
		$this->admin_db_query = 'Kör ett SQL kommando';
		$this->admin_db_restore = 'Återställ en backup';
		$this->admin_delete_forum = 'Ta bort ett forum';
		$this->admin_delete_group = 'Ta bort en grupp';
		$this->admin_delete_help = 'Ta bort en hjälp artikel';
		$this->admin_delete_member = 'Ta bort en medlem';
		$this->admin_delete_template = 'Ta bort en HTML mall';
		$this->admin_edit_emoticons = 'Ändra eller ta bort emoticons';
		$this->admin_edit_forum = 'Ändra ett forum';
		$this->admin_edit_group_name = 'Ändra en grupps namn';
		$this->admin_edit_group_perms = 'Ändra en grupps rättigheter';
		$this->admin_edit_help = 'Ändra en hjälpartikel';
		$this->admin_edit_member = 'Ändra en medlem';
		$this->admin_edit_member_perms = 'Ändra rättigheter för medlem';
		$this->admin_edit_member_titles = 'Ändra eller ta bort automatiska medlemstitlar';
		$this->admin_edit_settings = 'Ändra foruminställningar';
		$this->admin_edit_skin = 'Ändra eller ta bort ett skal';
		$this->admin_edit_templates = 'Ändra HTML mallar';
		$this->admin_emoticons = 'Emoticons'; //Translate
		$this->admin_export_skin = 'Exportera ett skal';
		$this->admin_fix_stats = 'Justera medlemsstatistiken';
		$this->admin_forum_order = 'Ändra ordning på forumen';
		$this->admin_forums = 'Forum och kategorier';
		$this->admin_groups = 'Grupper';
		$this->admin_heading = 'Quicksilver Forum Admin Kontrollpanel';
		$this->admin_help = 'Hjälpartiklar';
		$this->admin_install_emoticons = 'Installera emoticons';
		$this->admin_install_skin = 'Installera ett skal';
		$this->admin_logs = 'Visa moderatorhändelser';
		$this->admin_mass_mail = 'Skicka e-post till dina medlemmar';
		$this->admin_members = 'Medlemmar';
		$this->admin_phpinfo = 'Visa PHP information';
		$this->admin_prune = 'rensa gamla ämnen';
		$this->admin_recount_forums = 'Räkna om ämnen och svar';
		$this->admin_settings = 'Inställningar';
		$this->admin_settings_add = 'Lägg till ny foruminställning';
		$this->admin_skins = 'Skal';
		$this->admin_stats = 'Statistik';
		$this->admin_upgrade_skin = 'Uppgradera ett skal';
		$this->admin_your_board = 'Ditt Forum';
	}

	function backup()
	{
		$this->backup_create = 'Skapa databasbackup';
		$this->backup_createfile = 'Gör en backup och spara filen på servern';
		$this->backup_done = 'En backup av databasen har skapats i mappen "databases".';
		$this->backup_download = 'Gör en backup och ladda ner filen (Rekommenderas)';
		$this->backup_found = 'Följande backuper hittades i mappen "databases"';
		$this->backup_invalid = 'Backupen verkar inte vara giltig. Inga förändingar gjordes av databasen.';
		$this->backup_none = 'Inga backuper hittades i mappen "databases".';
		$this->backup_options = 'Välj hur du vill ha din backup skapad';
		$this->backup_restore = 'Återställ Backup';
		$this->backup_restore_done = 'Återställningen av Databasen lyckades.';
		$this->backup_warning = 'Varning: Detta kommer att skriva över all befintlig information som används av Quicksilver Forums.';
	}

	function ban()
	{
		$this->ban = 'Blockera';
		$this->ban_banned_ips = 'Blockera IP Adresser';
		$this->ban_banned_members = 'Blockerade Medlemmar';
		$this->ban_ip = 'Blockera IP Adresser';
		$this->ban_member_explain1 = 'för att blockera medlemmar ändra deras användargrupp till';
		$this->ban_member_explain2 = 'i medlemmskontrollen.';
		$this->ban_members = 'Blockera Medlemmar';
		$this->ban_nomembers = 'Det finns just nu inga blockerade medlemmar.';
		$this->ban_one_per_line = 'En adress per rad.';
		$this->ban_regex_allowed = 'Reguljära uttryck är tillåtna. Du kan använda ett * som jokertecken för en eller flera siffror.';
		$this->ban_settings = 'Inställningar för Blockering';
		$this->ban_users_banned = 'Blockerade användare.';
	}

	function bbcode()
	{
		$this->bbcode_arial = 'Arial';
		$this->bbcode_blue = 'Blå';
		$this->bbcode_bold = 'Fet (CTRL-b)';
		$this->bbcode_bold1 = 'F';
		$this->bbcode_chocolate = 'Choklad';
		$this->bbcode_code = 'Kod (CTRL-l)';
		$this->bbcode_code1 = 'Kod';
		$this->bbcode_color = 'Färg';
		$this->bbcode_coral = 'Korall';
		$this->bbcode_courier = 'Courier';
		$this->bbcode_crimson = 'Crimson';
		$this->bbcode_darkblue = 'Mörkblå';
		$this->bbcode_darkred = 'Mörkröd';
		$this->bbcode_deeppink = 'Djuprosa';
		$this->bbcode_email = 'E-post (CTRL-e)';
		$this->bbcode_firered = 'Tegelröd';
		$this->bbcode_font = 'Teckensnitt';
		$this->bbcode_green = 'Grön';
		$this->bbcode_huge = 'Enorm';
		$this->bbcode_image = 'Bild (CTRL-j)';
		$this->bbcode_image1 = 'Bild';
		$this->bbcode_impact = 'Impact';
		$this->bbcode_indigo = 'Indigo';
		$this->bbcode_italic = 'Kursiv (CTRL-i)';
		$this->bbcode_italic1 = 'K';
		$this->bbcode_large = 'Stor';
		$this->bbcode_limegreen = 'Lime Grön';
		$this->bbcode_medium = 'Medium';
		$this->bbcode_orange = 'Orange';
		$this->bbcode_orangered = 'Orangeröd';
		$this->bbcode_php = 'PHP (CTRL-k)';
		$this->bbcode_php1 = 'PHP';
		$this->bbcode_purple = 'Lila';
		$this->bbcode_quote = 'Citat (CTRL-q)';
		$this->bbcode_quote1 = 'Citat';
		$this->bbcode_red = 'Röd';
		$this->bbcode_royalblue = 'Ljusblå';
		$this->bbcode_sandybrown = 'Sand';
		$this->bbcode_seagreen = 'Sjögrön';
		$this->bbcode_sienna = 'Brun';
		$this->bbcode_silver = 'Silver';
		$this->bbcode_size = 'Storlek';
		$this->bbcode_skyblue = 'Himmelsblå';
		$this->bbcode_small = 'Liten';
		$this->bbcode_spoiler = 'Avslöjande (CTRL-r)';
		$this->bbcode_spoiler1 = 'Avslöjande';
		$this->bbcode_strike = 'Genomstruken (CTRL-s)';
		$this->bbcode_strike1 = 'S';
		$this->bbcode_tahoma = 'Tahoma';
		$this->bbcode_teal = 'Turkos';
		$this->bbcode_times = 'Times';
		$this->bbcode_tiny = 'Mini';
		$this->bbcode_tomato = 'Tomat';
		$this->bbcode_underline = 'Understruken (CTRL-u)';
		$this->bbcode_underline1 = 'U';
		$this->bbcode_url = 'URL (CTRL-h)';
		$this->bbcode_url1 = 'URL';
		$this->bbcode_verdana = 'Verdana';
		$this->bbcode_wood = 'Beige';
		$this->bbcode_yellow = 'Gul';
	}

	function board()
	{
		$this->board_active_users = 'Aktiva Användare';
		$this->board_birthdays = 'Dagens Födelsedagar:';
		$this->board_bottom_page = 'Gå till botten av sidan';
		$this->board_can_post = 'Du kan svara i detta forum.';
		$this->board_can_topics = 'Du kan läsa men inte skapa ämnen i detta forum.';
		$this->board_cant_post = 'Du kan inte svara i detta forum.';
		$this->board_cant_topics = 'Du kan inte läsa eller skapa ämnen i detta forum.';
		$this->board_forum = 'Forum';
		$this->board_guests = 'gäster';
		$this->board_last_post = 'Senaste Inlägg';
		$this->board_mark = 'Markerar Inlägg Som Läst';
		$this->board_mark1 = 'Alla inlägg och forum har markerats som lästa.';
		$this->board_markforum = 'Markerar forumet som läst';
		$this->board_markforum1 = 'Alla inlägg i forumet har markerats som lästa.';
		$this->board_members = 'medlemmar';
		$this->board_message = '%s Meddelande';
		$this->board_most_online = 'Flest användare online någonsin var %d %s.';
		$this->board_nobday = 'Inga medlemmar fyller år idag.';
		$this->board_nobody = 'Det är för tillfället inga medlemmar online.';
		$this->board_nopost = 'Inga Inlägg';
		$this->board_noview = 'Du har inte tillåtelse att läsa forumet.';
		$this->board_regfirst = 'Du har inte tillåtelse att läsa forumet. Om du registrerar dig, så kanske du kan.';
		$this->board_replies = 'Svar';
		$this->board_stats = 'Statistik';
		$this->board_stats_string = 'Hittills har %s personer registrerat sig. Våran nyaste medlem är: %s.<br /> Det finns %s ämnen och %s svar vilket totalt är %s inlägg.';
		$this->board_top_page = 'Gå till toppen av sidan';
		$this->board_topics = 'Ämnen';
		$this->board_users = 'användare';
		$this->board_write_topics = 'Du kan läsa och skapa ämnen i detta forum.';
	}

	function censoring()
	{
		$this->censor = 'Censurerade Ord';
		$this->censor_one_per_line = 'Ett per rad.';
		$this->censor_regex_allowed = 'Reguljära uttryck är tillåtna. Du kan använda ett * som jokertecken för ett eller flera tecken.';
		$this->censor_updated = 'Listan på ord uppdaterad.';
	}

	function cp()
	{
		$this->cp_aim = 'AIM namn';
		$this->cp_already_member = 'E-post adressen du skrev in är upptagen.';
		$this->cp_apr = 'April';
		$this->cp_aug = 'Augusti';
		$this->cp_avatar_current = 'Din nuvarande avatar';
		$this->cp_avatar_error = 'Avatar Fel';
		$this->cp_avatar_must_select = 'Du måste välja en avatar.';
		$this->cp_avatar_none = 'Använd inte en avatar';
		$this->cp_avatar_pixels = 'pixlar';
		$this->cp_avatar_select = 'Välj en avatar';
		$this->cp_avatar_size_height = 'Din avatars höjd måste vara mellan 1 och';
		$this->cp_avatar_size_width = 'Din avatars bredd måste vara mellan 1 och';
		$this->cp_avatar_upload = 'Ladda upp en avatar från din hårddisk';
		$this->cp_avatar_upload_failed = 'Uppladdningen av avataren misslyckades. Filen du har valt kanske inte existerar.';
		$this->cp_avatar_upload_not_image = 'Du kan endast ladda upp bilder för att använda som avatar.';
		$this->cp_avatar_upload_too_large = 'Avataren du valt att ladda up är för stor. Max filstorlek är %d kilobyte.';
		$this->cp_avatar_url = 'Skriv in en webadress till din avatar';
		$this->cp_avatar_use = 'Använd din uppladdade avatar';
		$this->cp_bday = 'Födelsedag';
		$this->cp_been_updated = 'Din profil har uppdaterats.';
		$this->cp_been_updated1 = 'Din avatar har uppdaterats.';
		$this->cp_been_updated_prefs = 'Dina inställningar har uppdaterats.';
		$this->cp_changing_pass = 'Ändrar Lösenord';
		$this->cp_contact_pm = 'Tillåt att andra kontaktar dig via messenger?';
		$this->cp_cp = 'Kontrollpanelen';
		$this->cp_current_avatar = 'Nuvarande Avatar';
		$this->cp_current_time = 'Klockan är %s.';
		$this->cp_custom_title = 'Egen Medlemstitel';
		$this->cp_custom_title2 = 'Detta är ett privilegie reserverat för forum administratörer';
		$this->cp_dec = 'December';
		$this->cp_editing_avatar = 'Redigerar Avatar';
		$this->cp_editing_profile = 'Redigerar Profil';
		$this->cp_email = 'E-post';
		$this->cp_email_form = 'Tillåt andra att kontakta dig via epost-formulär?';
		$this->cp_email_invaid = 'E-post adressen du skrivit in är ej giltig.';
		$this->cp_err_avatar = 'Misslyckades Med Att Uppdatera Avatar';
		$this->cp_err_updating = 'Misslyckades Med Att Uppdatera Profil';
		$this->cp_feb = 'Februari';
		$this->cp_file_type = 'Avataren är ej giltig. Försäkra dig om att webadressen är korrekt skriven och att filtypen är .gif, .jpg, eller .png';
		$this->cp_format = 'Namn';
		$this->cp_gtalk = 'GTalk konto';
		$this->cp_header = 'Kontrollpanel';
		$this->cp_height = 'Höjd';
		$this->cp_icq = 'ICQ Nummer';
		$this->cp_interest = 'Intressen';
		$this->cp_jan = 'Januari';
		$this->cp_july = 'Juli';
		$this->cp_june = 'Juni';
		$this->cp_label_edit_avatar = 'Ändra Avatar';
		$this->cp_label_edit_pass = 'Ändra Lösenord';
		$this->cp_label_edit_prefs = 'Ändra Inställningar';
		$this->cp_label_edit_profile = 'Ändra Profil';
		$this->cp_label_edit_sig = 'Ändra Signatur';
		$this->cp_label_edit_subs = 'Ändra Prenumerationer';
		$this->cp_language = 'Språk';
		$this->cp_less_charac = 'Ditt namn måste ha mindre än 32 bokstäver.';
		$this->cp_location = 'Hemort';
		$this->cp_login_first = 'Du måste vara inloggad för att ha tillgång till kontrollpanelen.';
		$this->cp_mar = 'Mars';
		$this->cp_may = 'Maj';
		$this->cp_msn = 'MSN namn';
		$this->cp_must_orig = 'Ditt namn måste vara identiskt med originalet. Du får endast ändra versaler och avstånd.';
		$this->cp_new_notmatch = 'De nya lösenorden du skrev in är olika.';
		$this->cp_new_pass = 'Nytt Lösenord';
		$this->cp_no_flash = 'Flash avatarer är inte tillåtna.';
		$this->cp_not_exist = 'Datumet du skrivit in (%s) finns inte!';
		$this->cp_nov = 'November';
		$this->cp_oct = 'Oktober';
		$this->cp_old_notmatch = 'Ditt gamla lösenord är ej korrekt.';
		$this->cp_old_pass = 'Gammalt Lösenord';
		$this->cp_pass_notvaid = 'Ditt lösenord är ogiltigt. Endast bokstäver, nummer, streck, understreck och mellanslag är tillåtna.';
		$this->cp_posts_page = 'Inlägg per ämnessida. 0 återställer till forumstandard.';
		$this->cp_preferences = 'Ändrar Inställningar';
		$this->cp_preview_sig = 'Förhandsgranska Signatur:';
		$this->cp_privacy = 'Privata Inställningar';
		$this->cp_repeat_pass = 'Repetera Nytt Lösenord';
		$this->cp_sept = 'September';
		$this->cp_show_active = 'Visa dina aktiviteter när du använder forumet?';
		$this->cp_show_email = 'Visa E-post adress i din profil?';
		$this->cp_signature = 'Signatur';
		$this->cp_size_max = 'Avataren är för stor. Max tillåtna storlek är %s x %s pixlar.';
		$this->cp_skin = 'Skal';
		$this->cp_sub_change = 'Ändra prenumerationer';
		$this->cp_sub_delete = 'Radera';
		$this->cp_sub_expire = 'Utgångsdatum';
		$this->cp_sub_name = 'Prenumerationsnamn';
		$this->cp_sub_no_params = 'Inga parametrar givna.';
		$this->cp_sub_success = 'Du prenumererar nu på denna %s.';
		$this->cp_sub_type = 'Prenumerationstyp';
		$this->cp_sub_updated = 'Vald prenumeration har blivit raderad.';
		$this->cp_topic_option = 'Foruminställningar';
		$this->cp_topics_page = 'Ämnen per forumsida. 0 återställer till forumstandard.';
		$this->cp_updated = 'Profil Uppdaterad';
		$this->cp_updated1 = 'Avatar Uppdaterad';
		$this->cp_updated_prefs = 'Inställningar Uppdaterade';
		$this->cp_user_exists = 'En användare med den namnformateringen existerar redan.';
		$this->cp_valided = 'Ditt lösenord är ändrat.';
		$this->cp_view_avatar = 'Visa Avatarer?';
		$this->cp_view_emoticon = 'Visa Emoticons?';
		$this->cp_view_signature = 'Visa Signaturer?';
		$this->cp_welcome = 'Välkommen till kontrollpanelen. Härifrån kan du justera inställningarna för ditt konto. Välj från alternativen ovan.';
		$this->cp_width = 'Bredd';
		$this->cp_www = 'Hemsida';
		$this->cp_yahoo = 'Yahoo namn';
		$this->cp_zone = 'Tidszon';
	}

	function email()
	{
		$this->email_blocked = 'Den medlemmen accepterar ej epost genom vårat formulär.';
		$this->email_email = 'E-post';
		$this->email_msgtext = 'Meddelande:';
		$this->email_no_fields = 'Gå tillbaka och försäkra dig om att samtliga fält är ifyllda.';
		$this->email_no_member = 'Det finns ingen medlem med det namnet.';
		$this->email_no_perm = 'Du har inte rättigheter att sända epost från detta forum';
		$this->email_sent = 'E-post meddelandet har skickats.';
		$this->email_subject = 'Ämne:';
		$this->email_to = 'Till:';
	}

	function emot_control()
	{
		$this->emote = 'Emoticons';
		$this->emote_add = 'Lägg till Emoticons';
		$this->emote_added = 'Emoticon tillagd.';
		$this->emote_clickable = 'Klickbar';
		$this->emote_edit = 'Ändra Emoticons';
		$this->emote_image = 'Bild';
		$this->emote_install = 'Installera Emoticons';
		$this->emote_install_done = 'Ominstallationen av Emoticons lyckades.';
		$this->emote_install_warning = 'Detta kommer att ta bort alla existerande emoticon inställningar och importera uppladdade emoticons från ditt nu valda skal till databasen.';
		$this->emote_no_text = 'Ingen emoticon text gavs.';
		$this->emote_text = 'Text';
	}

	function forum()
	{
		$this->forum_by = 'Av';
		$this->forum_can_post = 'Du kan svara i detta forum.';
		$this->forum_can_topics = 'Du kan läsa ämnen i detta forum.';
		$this->forum_cant_post = 'Du kan inte svara i detta forum.';
		$this->forum_cant_topics = 'Du kan inte läsa ämnen i detta forum.';
		$this->forum_dot = 'Prick';
		$this->forum_dot_detail = 'Visar att du skrivit inlägg i ämnet';
		$this->forum_forum = 'Forum';
		$this->forum_guest = 'Gäst';
		$this->forum_hot = 'Het';
		$this->forum_icon = 'Meddelandeikon';
		$this->forum_jump = 'Hoppa till nyaste inlägg i ämnet';
		$this->forum_last = 'Senaste Inlägg';
		$this->forum_locked = 'Låst';
		$this->forum_mark_read = 'Markera forumet som läst';
		$this->forum_moved = 'Flyttad';
		$this->forum_msg = '%s Meddelande';
		$this->forum_new = 'Ny';
		$this->forum_new_poll = 'Skapa Ny Omröstning';
		$this->forum_new_topic = 'Skapa Nytt Ämne';
		$this->forum_no_topics = 'Det finns inga ämnen att visa i detta forum.';
		$this->forum_noexist = 'Forumet existerar inte.';
		$this->forum_nopost = 'Inga inlägg';
		$this->forum_not = 'Inte';
		$this->forum_noview = 'Du har inte tillåtelse att läsa forum.';
		$this->forum_pages = 'Sidor';
		$this->forum_pinned = 'Klistrad';
		$this->forum_pinned_topic = 'Klistrat Ämne';
		$this->forum_poll = 'Röstning';
		$this->forum_regfirst = 'Du har inte tillåtelse att läsa forum utan att först registrera dig.';
		$this->forum_replies = 'Svar';
		$this->forum_starter = 'Skapare';
		$this->forum_sub = 'Underforum';
		$this->forum_sub_last_post = 'Senaste Inlägg';
		$this->forum_sub_replies = 'Svar';
		$this->forum_sub_topics = 'Ämnen';
		$this->forum_subscribe = 'E-posta mig när nya inlägg skrivits i detta forum.';
		$this->forum_topic = 'Ämne';
		$this->forum_views = 'Visningar';
		$this->forum_write_topics = 'Du kan skapa nya ämnen i detta forum.';
	}

	function forums()
	{
		$this->forum_controls = 'Forum Kontroller';
		$this->forum_create = 'Skapa Forum';
		$this->forum_create_cat = 'Skapa en Kategori';
		$this->forum_created = 'Forum Skapat';
		$this->forum_default_perms = 'Förvalda rättigheter';
		$this->forum_delete = 'Ta bort Forum';
		$this->forum_delete_warning = 'Är du säker på att du vill ta bort detta forum, dess ämnen, och dess inlägg?<br />Denna åtgärd kan inte ångras.';
		$this->forum_deleted = 'Forumet har tagits bort.';
		$this->forum_description = 'Beskrivning';
		$this->forum_edit = 'Ändra Forum';
		$this->forum_edited = 'Forumet har ändrats.';
		$this->forum_empty = 'Forum namnet är tomt. Gå tillbaks och skriv i ett namn.';
		$this->forum_is_subcat = 'Detta forum är en underkategori bara.';
		$this->forum_name = 'Namn';
		$this->forum_no_orphans = 'Du kan inte göra forumet föräldralöst genom att ta bort dess förälder.';
		$this->forum_none = 'Det finns inga forum att manipulera.';
		$this->forum_ordered = 'Forumordning Uppdaterad';
		$this->forum_ordering = 'Ändra Forumordning';
		$this->forum_parent = 'Du kan inte ändra ett forums förälder på det sättet.';
		$this->forum_parent_cat = 'Ovanliggande kategori';
		$this->forum_quickperm_select = 'Välj ett existerande forum för att kopiera dess rättigheter.';
		$this->forum_quickperms = 'Snabbrättigheter';
		$this->forum_recount = 'Räkna om Ämnen och Svar';
		$this->forum_select_cat = 'Välj en existerande kategori för att skapa ett forum.';
		$this->forum_subcat = 'Underkategori';
	}

	function groups()
	{
		$this->groups_bad_format = 'Du måtse använda %s i formateringen, vilket representerar gruppens namn.';
		$this->groups_based_on = 'Baserad på';
		$this->groups_create = 'Skapa Grupp';
		$this->groups_create_new = 'Skapa en ny användargrupp med namnet';
		$this->groups_created = 'Grupp Skapad';
		$this->groups_delete = 'Ta bort Grupp';
		$this->groups_deleted = 'Grupp Borttagen.';
		$this->groups_edit = 'Ändra Grupp';
		$this->groups_edited = 'Grupp Ändrad.';
		$this->groups_formatting = 'Visa Formatering';
		$this->groups_i_confirm = 'Jag bekräftar att jag vill ta bort den här medlemsgruppen.';
		$this->groups_name = 'Namn';
		$this->groups_no_action = 'Ingen åtgärd utfördes.';
		$this->groups_no_delete = 'Det finns inga egna grupper att ta bort.<br />Kärn grupperna behövs för att Quicksilver Forums ska fungera, och kan inte tas bort.';
		$this->groups_no_group = 'Ingen grupp specifierades.';
		$this->groups_no_name = 'Inget gruppnamn gavs.';
		$this->groups_only_custom = 'Notera: Du kan endats ta bort egna medlemsgrupper. Kärn grupperna behövs för att Quicksilver Forums ska fungera.';
		$this->groups_the = 'Gruppen';
		$this->groups_to_edit = 'Grupp som ska ändras';
		$this->groups_type = 'Grupp Typ';
		$this->groups_will_be = 'kommer att tas bort.';
		$this->groups_will_become = 'Användare från den borttagna gruppen kommer att bli';
	}

	function help()
	{
		$this->help_add = 'Lägg till Hjälpartikel';
		$this->help_article = 'Hjälpartikel Kontroll';
		$this->help_available_files = 'Hjälp';
		$this->help_confirm = 'Är du säker på att du vill ta bort';
		$this->help_content = 'Artikelinnehåll';
		$this->help_delete = 'Ta bort Hjälpartikel';
		$this->help_deleted = 'Hjälpartikel Borttagen.';
		$this->help_edit = 'Ändra Hjälpartikele';
		$this->help_edited = 'Hjälpartikel uppdaterad.';
		$this->help_inserted = 'Artikel inlaggd i databasen.';
		$this->help_no_articles = 'Inga hjälpartikelar hittades i databasen.';
		$this->help_no_title = 'Du kan inte skapa en hjälpartikel utan titel.';
		$this->help_none = 'Det finns inga hjälpfiler i databasen';
		$this->help_not_exist = 'Den hjälpartikeln finns inte.';
		$this->help_select = 'Välj en hjälpartikel att ändra';
		$this->help_select_delete = 'Välj en hjälpartikel att ta bort';
		$this->help_title = 'Titel';
	}

	function home()
	{
		$this->home_choose = 'Välj en uppgift för att börja.';
		$this->home_menu_title = 'Admin KP Meny';
	}

	function jsdata()
	{
		$this->jsdata_address = 'Skriv en address';
		$this->jsdata_detail = 'Skriv en beskrivning';
		$this->jsdata_smiles = 'Klickbara Smilies';
		$this->jsdata_url = 'URL';
	}

	function jslang()
	{
		$this->jslang_avatar_size_height = 'Din avatars höjd måste vara mellan 1 och %d pixlar';
		$this->jslang_avatar_size_width = 'Din avatars bredd måste vara mellan 1 och %d pixels';
	}

	function login()
	{
		$this->login_cant_logged = 'Du kunde inte loggas in. Försäkra dig om att ditt användarnamn och lösenord är rätt.<br /><br />De är skiftlägeskänsliga, så \'UsErNaMe\' är inte samma sak som \'Username\'. Se även till så att cookies är aktiverade i din webläsare.';
		$this->login_cookies = 'Cookies måste vara tillåtna för att kunna logga in.';
		$this->login_forgot_pass = 'Jag har glömt mitt lösenord!';
		$this->login_header = 'Loggar In';
		$this->login_logged = 'Du är nu inloggad.';
		$this->login_now_out = 'Du är nu utloggad.';
		$this->login_out = 'Loggar Ut';
		$this->login_pass = 'Lösenord';
		$this->login_pass_no_id = 'Det finns ingen medlem med detta namn.';
		$this->login_pass_request = 'För att slutföra återställningen av lösenordet, var snäll och klicka på länken som skickade till e-postadressen associerad med ditt konto.';
		$this->login_pass_reset = 'Nollställ Lösenordet';
		$this->login_pass_sent = 'Ditt lösenord har nollställts. Det nya lösenordet har skickats till din epostadress som uppgavs i ditt användarkonto.';
		$this->login_sure = 'Är du säker på att du vill logga ut från \'%s\'?';
		$this->login_user = 'Användarnamn';
	}

	function logs()
	{
		$this->logs_action = 'Händelse';
		$this->logs_deleted_post = 'Tog bort ett inlägg';
		$this->logs_deleted_topic = 'Tog bort ett ämne';
		$this->logs_edited_post = 'Ändrade ett inlägg';
		$this->logs_edited_topic = 'Ändrade ett ämne';
		$this->logs_id = 'IDs';
		$this->logs_locked_topic = 'Låste ett ämne';
		$this->logs_moved_from = 'från forum';
		$this->logs_moved_to = 'till forum';
		$this->logs_moved_topic = 'Flyttade ett ämne';
		$this->logs_moved_topic_num = 'Flyttade ämne #';
		$this->logs_pinned_topic = 'Klistrade ett ämne';
		$this->logs_post = 'Inlägg';
		$this->logs_time = 'Tid';
		$this->logs_topic = 'Ämne';
		$this->logs_unlocked_topic = 'Låste upp ett ämne';
		$this->logs_unpinned_topic = 'Klistrade av ett ämne';
		$this->logs_user = 'Användare';
		$this->logs_view = 'Visa Moderatorhändelser';
	}

	function main()
	{
		$this->main_activate = 'Ditt användarkonto har ännu inte aktiverats';
		$this->main_activate_resend = 'Skicka aktiveringsuppgifter igen via epost.';
		$this->main_admincp = 'Admin inställningar';
		$this->main_banned = 'Du har blivit bannlyst från att läsa någonting på detta forum.';
		$this->main_code = 'Kod';
		$this->main_cp = 'kontrollpanelen';
		$this->main_full = 'Fullständig';
		$this->main_help = 'hjälp';
		$this->main_load = 'belastning';
		$this->main_login = 'logga in';
		$this->main_logout = 'logga ut';
		$this->main_mark = 'markera alla';
		$this->main_mark1 = 'Markera alla ämnen som lästa';
		$this->main_markforum_read = 'Markera forumet som lästa';
		$this->main_max_load = 'Tyvärr är %s för tillfället otillgänglig p.g.a. hög belastning.';
		$this->main_members = 'medlemmar';
		$this->main_messenger = 'Snabbmeddelanden';
		$this->main_new = 'ny';
		$this->main_next = 'nästa';
		$this->main_prev = 'förra';
		$this->main_queries = 'förfrågningar';
		$this->main_quote = 'Citera';
		$this->main_recent = 'nya inlägg';
		$this->main_recent1 = 'Visa nya ämnen sen ditt senaste besök';
		$this->main_register = 'registrera';
		$this->main_reminder = 'Påminnelse: Detta forum är stängt och kan endast läsas av administratörer.';
		$this->main_reminder_closed = 'Forumet är stängt! det kan endast ses av administratörer.';
		$this->main_said = 'sade';
		$this->main_search = 'sök';
		$this->main_topics_new = 'Det finns nya inlägg i detta forum.';
		$this->main_topics_old = 'Det finns inga nya inlägg i detta forum.';
		$this->main_welcome = 'Välkommen';
		$this->main_welcome_guest = 'Välkommen!';
	}

	function mass_mail()
	{
		$this->mail = 'E-post till alla';
		$this->mail_announce = 'Tillkännagivande Från';
		$this->mail_groups = 'Mottagangde Grupper';
		$this->mail_members = 'medlemmar.';
		$this->mail_message = 'Meddelande';
		$this->mail_select_all = 'Välj Alla';
		$this->mail_send = 'Skicka E-post';
		$this->mail_sent = 'Ditt meddelande har skickats till';
	}

	function member_control()
	{
		$this->mc = 'Medlemskontroll';
		$this->mc_confirm = 'Är du säker på att du vill ta bort';
		$this->mc_delete = 'Ta bort Medlem';
		$this->mc_deleted = 'Medlem Borttagen.';
		$this->mc_edit = 'Ändra Medlem';
		$this->mc_edited = 'Medlem Uppdaterad';
		$this->mc_email_invaid = 'E-postadressen du anget är inte giltig.';
		$this->mc_err_updating = 'Ett fel uppstod vid uppdatering av profil';
		$this->mc_find = 'Hitta medlemmar vars namn innehåller';
		$this->mc_found = 'Följande medlemmar hittades. Var snäll och välj en.';
		$this->mc_guest_needed = 'Gästkontot behövs för att Quicksilver Forumet ska fungera.';
		$this->mc_not_found = 'Inga medlemmar som matchade hittades';
		$this->mc_user_aim = 'AIM Namn';
		$this->mc_user_avatar = 'Visningsbild';
		$this->mc_user_avatar_height = 'Visningsbild Höjd';
		$this->mc_user_avatar_type = 'Visningsbild Typ';
		$this->mc_user_avatar_width = 'Visningsbild Bredd';
		$this->mc_user_birthday = 'Födelsedag';
		$this->mc_user_email = 'E-post Adress';
		$this->mc_user_email_show = 'E-posten Är Publik';
		$this->mc_user_group = 'Grupp';
		$this->mc_user_gtalk = 'GTalk Konto';
		$this->mc_user_homepage = 'Hemsida';
		$this->mc_user_icq = 'ICQ Nummer';
		$this->mc_user_id = 'Användar ID';
		$this->mc_user_interests = 'Intressen';
		$this->mc_user_joined = 'Medlem Sedan';
		$this->mc_user_language = 'Språk';
		$this->mc_user_lastpost = 'Senaste Inlägg';
		$this->mc_user_lastvisit = 'Senaste Besök';
		$this->mc_user_level = 'Nivå';
		$this->mc_user_location = 'Plats';
		$this->mc_user_msn = 'MSN Identitet';
		$this->mc_user_name = 'Namn';
		$this->mc_user_pm = 'Accepterar Personliga Meddelanden';
		$this->mc_user_posts = 'Inlägg';
		$this->mc_user_signature = 'Signatur';
		$this->mc_user_skin = 'Skal';
		$this->mc_user_timezone = 'Tids Zon';
		$this->mc_user_title = 'Medlemstitel';
		$this->mc_user_title_custom = 'Använd en Egen Medlemstitel';
		$this->mc_user_view_avatars = 'Visar Visningsbilder';
		$this->mc_user_view_emoticons = 'Visar Emoticons';
		$this->mc_user_view_signatures = 'Visar Signaturer';
		$this->mc_user_yahoo = 'Yahoo Identitet';
	}

	function membercount()
	{
		$this->mcount = 'Justera Medlemsstatistiken';
		$this->mcount_updated = 'Medlemsantal Uppdaterat.';
	}

	function members()
	{
		$this->members_all = 'alla';
		$this->members_email = 'E-posta';
		$this->members_email_member = 'Skicka E-post till denna medlem';
		$this->members_group = 'Grupp';
		$this->members_joined = 'Registreringsdatum';
		$this->members_list = 'Medlemslista';
		$this->members_member = 'Medlem';
		$this->members_pm = 'PM';
		$this->members_posts = 'Inlägg';
		$this->members_send_pm = 'Skicka ett personligt meddelande till denna användare';
		$this->members_title = 'Titel';
		$this->members_vist_www = 'Besök denna medlems hemsida';
		$this->members_www = 'Hemsida';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Är du säker på att du vill radera detta inlägg?';
		$this->mod_confirm_topic_delete = 'Är du säker på att du vill radera detta ämne?';
		$this->mod_error_first_post = 'Du kan inte radera första inlägget i ett ämne.';
		$this->mod_error_move_category = 'Du kan inte flytta ett ämne till en kategori.';
		$this->mod_error_move_create = 'Du har inte tillåtelse att flytta ämen till det forumet';
		$this->mod_error_move_forum = 'Du kan inte flytta ett ämne till ett forum som inte existerar.';
		$this->mod_error_move_global = 'Du kan inte flytta ett globalt ämne. Ändra ämnet innan du flyttar det.';
		$this->mod_error_move_same = 'Du kan inte flytta ett ämne till det forum det redan befinner sig i.';
		$this->mod_label_controls = 'Moderatorkontroller';
		$this->mod_label_description = 'Beskrivning';
		$this->mod_label_emoticon = 'Konvertera emoticons till bilder?';
		$this->mod_label_global = 'Ämne i hela forumet';
		$this->mod_label_mbcode = 'Formatera MbKod?';
		$this->mod_label_move_to = 'Flytta till';
		$this->mod_label_options = 'Alternativ';
		$this->mod_label_post_delete = 'Radera Inlägg';
		$this->mod_label_post_edit = 'Redigera Inlägg';
		$this->mod_label_post_icon = 'Inläggsikon';
		$this->mod_label_publish = 'Publicerar';
		$this->mod_label_title = 'Titel';
		$this->mod_label_title_original = 'Original Titel';
		$this->mod_label_title_split = 'Dela Upp Titel';
		$this->mod_label_topic_delete = 'Radera Ämne';
		$this->mod_label_topic_edit = 'Redigera Ämne';
		$this->mod_label_topic_lock = 'Lås Ämne';
		$this->mod_label_topic_move = 'Flytta Ämne';
		$this->mod_label_topic_move_complete = 'Flytta hela ämnet till ett nytt forum';
		$this->mod_label_topic_move_link = 'Flytta hela ämnet till ett nytt forum och lämna en länk dit från det gamla forumet.';
		$this->mod_label_topic_pin = 'Klistra Ämne';
		$this->mod_label_topic_split = 'Dela Upp Ämne';
		$this->mod_missing_post = 'Inlägged existerar inte.';
		$this->mod_missing_topic = 'Ämnet existerar inte.';
		$this->mod_no_action = 'Du måste välja en ändring.';
		$this->mod_no_post = 'Du måste välja ett inlägg.';
		$this->mod_no_topic = 'Du måste välja ett ämne.';
		$this->mod_perm_post_delete = 'Du har inte tillåtelse att radera detta inlägg.';
		$this->mod_perm_post_edit = 'Du har inte tillåtelse att redigera detta inlägg.';
		$this->mod_perm_publish = 'Du har inte rättighet att publicera detta ämne.';
		$this->mod_perm_topic_delete = 'Du har inte tillåtelse att radera detta ämne.';
		$this->mod_perm_topic_edit = 'Du har inte tillåtelse att redigera detta ämne.';
		$this->mod_perm_topic_lock = 'Du har inte tillåtelse att låsa detta ämne.';
		$this->mod_perm_topic_move = 'Du har inte tillåtelse att flytta detta ämne.';
		$this->mod_perm_topic_pin = 'Du har inte tillåtelse att klistra detta ämne.';
		$this->mod_perm_topic_split = 'Du har inte tillåtelse att dela upp detta ämne.';
		$this->mod_perm_topic_unlock = 'Du har inte tillåtelse att låsa upp detta ämne.';
		$this->mod_perm_topic_unpin = 'Du har inte tillåtelse att klistra av detta ämne.';
		$this->mod_success_post_delete = 'Inlägget raderades.';
		$this->mod_success_post_edit = 'Inlägget redigerades.';
		$this->mod_success_publish = 'Ämnet har publicerats.';
		$this->mod_success_split = 'Ämnet har nu blivit uppdelat.';
		$this->mod_success_topic_delete = 'Ämnet raderades.';
		$this->mod_success_topic_edit = 'Ämnet redigerades.';
		$this->mod_success_topic_move = 'Ämnet flyttades till ett nytt forum.';
		$this->mod_success_unpublish = 'Ämnet har tagits bort från listan över publicerade.';
	}

	function optimize()
	{
		$this->optimize = 'Optimera Databasen';
		$this->optimized = 'Tabellerna i databasen har nu optimerats för bästa prestanda.';
	}

	function perms()
	{
		$this->perm = 'Rättighet';
		$this->perms = 'Rättigheter';
		$this->perms_board_view = 'Visa Forumets index';
		$this->perms_board_view_closed = 'Använda Quicksilver Forumet när det är stängt';
		$this->perms_do_anything = 'Använda Quicksilver Forumet';
		$this->perms_edit_for = 'Ändra Rättigheter för';
		$this->perms_email_use = 'Skicka e-post till medlemmarna via forumet';
		$this->perms_forum_view = 'Kolla Forumet';
		$this->perms_is_admin = 'Komma åt adminkotrollpanelen';
		$this->perms_only_user = 'Använd endast grupprättigheter för den här användaren';
		$this->perms_override_user = 'Detta kommer att ersätta grupprättigheterna för den här användaren.';
		$this->perms_pm_noflood = 'Undanta från floodkontrollen för personliga meddelanden';
		$this->perms_poll_create = 'Skapa Röstningar';
		$this->perms_poll_vote = 'Skapa röster';
		$this->perms_post_attach = 'Fäst uppladdningar till inlägget';
		$this->perms_post_attach_download = 'Ladda ner filerna i inlägget';
		$this->perms_post_create = 'Skapa svar';
		$this->perms_post_delete = 'Ta bort valfritt inlägg';
		$this->perms_post_delete_own = 'Ta bort endast inlägg som användaren gjort';
		$this->perms_post_edit = 'Ändra valfritt inlägg';
		$this->perms_post_edit_own = 'Ändra endast inlägg som användaren gjort';
		$this->perms_post_inc_userposts = 'Inläggen adderas till användarens totala antal inlägg';
		$this->perms_post_noflood = 'Undanta från floodkontroll för inlägg';
		$this->perms_post_viewip = 'Kolla användares IP adresser';
		$this->perms_search_noflood = 'Undanta från floodkontroll för sökningar';
		$this->perms_title = 'Kontroll för Användargrupp';
		$this->perms_topic_create = 'Skapa ämnen';
		$this->perms_topic_delete = 'Ta bort valfritt ämne';
		$this->perms_topic_delete_own = 'Ta bort endast ämnen som användaren skapat';
		$this->perms_topic_edit = 'Ändra valfritt ämne';
		$this->perms_topic_edit_own = 'Endast ändra ämnen som användaren skapat';
		$this->perms_topic_global = 'Göra ett ämne synligt från alla forum';
		$this->perms_topic_lock = 'Låsa valfritt ämne';
		$this->perms_topic_lock_own = 'Låsa ämnen användaren har skapat';
		$this->perms_topic_move = 'Flytta valfritt ämne';
		$this->perms_topic_move_own = 'Endast flytta ämnen som användaren skapat';
		$this->perms_topic_pin = 'Klistra valfritt ämne';
		$this->perms_topic_pin_own = 'Klistra ämnen som användaren skapat';
		$this->perms_topic_publish = 'Publicera eller avpublicera valfritt ämne';
		$this->perms_topic_publish_auto = 'Nya ämnen markeras som publicerade';
		$this->perms_topic_split = 'Dela valfritt ämne till flera ämnen';
		$this->perms_topic_split_own = 'Endast dela ämnen användaren skapat till flera ämnen';
		$this->perms_topic_unlock = 'Låsa upp valfritt ämne';
		$this->perms_topic_unlock_mod = 'Låsa upp en moderators lås';
		$this->perms_topic_unlock_own = 'Endast låsa upp ämnen användaren har skapat';
		$this->perms_topic_unpin = 'Klistra av valfritt ämne';
		$this->perms_topic_unpin_own = 'Endast klistra av ämnen som användaren skapat';
		$this->perms_topic_view = 'Kolla på ämnen';
		$this->perms_topic_view_unpublished = 'Kolla  på ej publicerade ämnen';
		$this->perms_updated = 'Rättigheterna har uppdaterats.';
		$this->perms_user_inherit = 'Användaren kommer ärva gruppens rättigheter.';
	}

	function php_info()
	{
		$this->php_error = 'FEL';
		$this->php_error_msg = 'phpinfo() kan inte exekveras. Det verkar som om din värd har stängt av den här funktionen.';
	}

	function pm()
	{
		$this->pm_avatar = 'Visningsbild';
		$this->pm_cant_del = 'Du har inte tillåtelse att radera detta meddelande.';
		$this->pm_delallmsg = 'Radera Alla Meddelanden';
		$this->pm_delete = 'Radera';
		$this->pm_delete_selected = 'Ta bort valda meddelanden';
		$this->pm_deleted = 'Meddelande Raderat.';
		$this->pm_deleted_all = 'Meddelanden Raderade.';
		$this->pm_error = 'Det uppstod problem med att skicka ditt meddelande till vissa mottagare.<br /><br />Följande medlemmar finns inte: %s<br /><br />Följande medlemmar accepterar inte personliga meddelanden: %s';
		$this->pm_fields = 'Meddelandet kunde inte skickat. Försäkra dig om att alla fält är ifyllda.';
		$this->pm_flood = 'Du har skickat ett meddelande under de senaste %s sekunderna, du kan inte skicka ett till just nu.<br /><br />Försök igen om några sekunder.';
		$this->pm_folder_inbox = 'Inkorg';
		$this->pm_folder_new = '%s nya';
		$this->pm_folder_sentbox = 'Sent';
		$this->pm_from = 'Från';
		$this->pm_group = 'Grupp';
		$this->pm_guest = 'Som gäst kan du inte använda snabbmeddelande. Logga in eller registrera dig.';
		$this->pm_joined = 'Gick Med';
		$this->pm_messenger = 'Snabbmeddelande';
		$this->pm_msgtext = 'Meddelandetext';
		$this->pm_multiple = 'Separera flera mottagare med ett ;';
		$this->pm_no_folder = 'Du måste välja en katalog.';
		$this->pm_no_member = 'Inget meddelande kunde hittas med ett sådant ID.';
		$this->pm_no_number = 'Inget meddelande kunde hittas med det numret.';
		$this->pm_no_title = 'Inget Ämne';
		$this->pm_nomsg = 'Det finns inga meddelanden i denna katalog.';
		$this->pm_noview = 'Du har inte tillåtelse att läsa detta meddelande.';
		$this->pm_offline = 'Den här medlemmen är inte inloggad just nu';
		$this->pm_online = 'Den här medlemmen är inloggad just nu';
		$this->pm_personal = 'Snabbmeddelande';
		$this->pm_personal_msging = 'Personligt Meddelande';
		$this->pm_pm = 'PM';
		$this->pm_posts = 'Inlägg';
		$this->pm_preview = 'Förhandsgranska';
		$this->pm_recipients = 'Mottagare';
		$this->pm_reply = 'Svara';
		$this->pm_send = 'Skicka';
		$this->pm_sendamsg = 'Skicka Ett Meddelande';
		$this->pm_sendingpm = 'Skicka Ett PM';
		$this->pm_sendon = 'Skickat den';
		$this->pm_success = 'Ditt meddelande skickades.';
		$this->pm_sure_del = 'Är du säker på att du vill radera detta meddelande?';
		$this->pm_sure_delall = 'Är du säker på att du vill radera alla meddelanden i denna katalog?';
		$this->pm_title = 'Titel';
		$this->pm_to = 'Till';
	}

	function post()
	{
		$this->post_attach = 'Bifogade Filer';
		$this->post_attach_add = 'Bifoga Filer';
		$this->post_attach_disrupt = 'Att lägga till eller ta bort bifogade filer kommer ej att påverka ditt inlägg.';
		$this->post_attach_failed = 'Upladdningen av den bifogade filen misslyckades. Filen du specificerat kanske inte existerar.';
		$this->post_attach_not_allowed = 'Du kan inte bifoga filer av den typen.';
		$this->post_attach_remove = 'Ta Bort Bifogad Fil';
		$this->post_attach_too_large = 'Den bifogade file du valt att ladda upp är för stor. Max storlek är %d kilobyte.';
		$this->post_cant_create = 'Som gäst har du inte tillåtelse att skapa ämnen. Om du registrerar dig kan du ha möjlighet att göra detta.';
		$this->post_cant_create1 = 'Du har inte tillåtelse att skapa ämnen.';
		$this->post_cant_enter = 'Din röst registrerades inte. Endera har du redan röstat eller så har du inte tillåtelse att rösta.';
		$this->post_cant_poll = 'Som gäst har du inte tillåtelse att skapa röstningar. Om du registrerar dig kan du ha möjlighet att göra detta.';
		$this->post_cant_poll1 = 'Du har inte tillåtelse att skapa röstningar.';
		$this->post_cant_reply = 'Du har inte tillåtelse att svara på ämnen i detta forum.';
		$this->post_cant_reply1 = 'Som gäst har du inte tillåtelse att svara på ämnen. Om du registrerar dig kan du ha möjlighet att göra detta.';
		$this->post_cant_reply2 = 'Du har inte tillåtelse att svara på ämnen.';
		$this->post_closed = 'Detta ämne är stängt.';
		$this->post_create_poll = 'Skapa Röstning';
		$this->post_create_topic = 'Skapa Ämne';
		$this->post_creating = 'Skapar Ämne';
		$this->post_creating_poll = 'Skapar Röstning';
		$this->post_flood = 'Du har skrivit ett inlägg de sensate %s sekunderna, därför måste du vänta.<br /><br />Prova igen om ytterliggare några sekunder.';
		$this->post_guest = 'Gäst';
		$this->post_icon = 'Inläggsikon';
		$this->post_last_five = 'Senaste Fem Inläggen I Bakvänd Ordning';
		$this->post_length = 'Kontrollera Längd';
		$this->post_msg = 'Meddelande';
		$this->post_must_msg = 'Du måste skriva något när du gör ett inlägg.';
		$this->post_must_options = 'Du måste inkludera alterntiv när du skapar en ny omröstning.';
		$this->post_must_title = 'Du måste skriva en titel när du skapar ett nytt ämne.';
		$this->post_new_poll = 'Ny Omröstning';
		$this->post_new_topic = 'Nytt Ämne';
		$this->post_no_forum = 'Forumet kunde inte hittas.';
		$this->post_no_topic = 'Inget ämne valt.';
		$this->post_no_vote = 'Du måste välja ett alternativ att rösta på.';
		$this->post_option_emoticons = 'Konvertera Emoticons till bilder?';
		$this->post_option_global = 'Visa ämnet i hela forumet?';
		$this->post_option_mbcode = 'Formatera MbKod?';
		$this->post_optional = 'valfri';
		$this->post_options = 'Alternativ';
		$this->post_poll_options = 'Omröstningsalternativ';
		$this->post_poll_row = 'En på varje rad';
		$this->post_posted = 'Skrivet';
		$this->post_posting = 'Skriver Inlägg';
		$this->post_preview = 'Förhandsgranska';
		$this->post_reply = 'Svara';
		$this->post_reply_topic = 'Svara På Ämne';
		$this->post_replying = 'Svarar På Ämne';
		$this->post_replying1 = 'Svarar';
		$this->post_too_many_options = 'Du måste ha mellan 2 och %d alternativ i en röstning.';
		$this->post_topic_detail = 'Ämnesbeskrivning';
		$this->post_topic_title = 'Ämnestitel';
		$this->post_view_topic = 'Visa Alla Inlägg';
		$this->post_voting = 'Röstar';
	}

	function printer()
	{
		$this->printer_back = 'Tillbaka';
		$this->printer_not_found = 'Ämnet Kunde Ej Hittas. Det kan ha blivit raderat, flyttat eller så har det aldrig existerat.';
		$this->printer_not_found_title = 'Ämne Kunde Ej Hittas';
		$this->printer_perm_topics = 'Du har inte tillåtelse att visa ämnen.';
		$this->printer_perm_topics_guest = 'Du har inte tillåtelse att visa ämnen förrän du registrerat dig.';
		$this->printer_posted_on = 'Skrivet';
		$this->printer_send = 'Skriv Ut';
	}

	function profile()
	{
		$this->profile_aim_sn = 'AIM Namn';
		$this->profile_av_sign = 'Visningsbild och Signatur';
		$this->profile_avatar = 'Visningsbild';
		$this->profile_bday = 'Födelsedag';
		$this->profile_contact = 'Kontakta';
		$this->profile_email_address = 'E-post Adress';
		$this->profile_fav = 'Favorit Forum';
		$this->profile_fav_forum = '%s (%d%% av dessa medlemsinlägg)';
		$this->profile_gtalk = 'GTalk Konto';
		$this->profile_icq_uin = 'ICQ Nummer';
		$this->profile_info = 'Information';
		$this->profile_interest = 'Intressen';
		$this->profile_joined = 'Registrerade sig';
		$this->profile_last_post = 'Senaste Inlägg';
		$this->profile_list = 'Medlemslista';
		$this->profile_location = 'Hemort';
		$this->profile_member = 'Medlemsgrupp';
		$this->profile_member_title = 'Medlemstitel';
		$this->profile_msn = 'Mitt riktiga namn';
		$this->profile_must_user = 'Du måste skriva in en användare för att se en profil.';
		$this->profile_no_member = 'Det finns ingen medlem med det användarnumret. Kontot kan ha blivit raderat.';
		$this->profile_none = '[ Ingen ]';
		$this->profile_not_post = 'har inte gjort något inlägg ännu.';
		$this->profile_offline = 'Den här medlemmen är utloggad just nu';
		$this->profile_online = 'Den här medlemmen är inloggad just nu';
		$this->profile_pm = 'Personliga Meddelanden';
		$this->profile_postcount = '%s totalt, %s per dag';
		$this->profile_posts = 'Inlägg';
		$this->profile_private = '[ Privat ]';
		$this->profile_profile = 'Profil';
		$this->profile_signature = 'Signatur';
		$this->profile_unkown = '[ Okänd ]';
		$this->profile_view_profile = 'Visar Profil';
		$this->profile_www = 'Hemsida';
		$this->profile_yahoo = 'Yahoo namn';
	}

	function prune()
	{
		$this->prune_action = 'rensning som ska göras';
		$this->prune_age_day = '1 Dag';
		$this->prune_age_eighthours = '8 Timmar';
		$this->prune_age_hour = '1 Timme';
		$this->prune_age_month = '1 Månad';
		$this->prune_age_threemonths = '3 Månader';
		$this->prune_age_week = '1 Vecka';
		$this->prune_age_year = '1 år';
		$this->prune_forums = 'Välj forum att rensa';
		$this->prune_invalidage = 'Ogiltig ålder specifierad för rensning';
		$this->prune_move = 'Flytta';
		$this->prune_moveto_forum = 'Forum att flytta till';
		$this->prune_nodest = 'Ingen giltig destination vald';
		$this->prune_notopics = 'Inga ämnen valda för rensning';
		$this->prune_notopics_old = 'Inga ämnen är gamla nog för att rensas';
		$this->prune_novalidforum = 'Inga giltiga forum valda för rensning';
		$this->prune_select_age = 'Välj ålder på ämnen för begränsad rensning';
		$this->prune_select_topics = 'Välj ämnen att rensa eller använd Välj Alla';
		$this->prune_success = 'ämnen har beskurits';
		$this->prune_title = 'ämnes rensare';
		$this->prune_topics_older_than = 'Rensa ämnen äldre än';
	}

	function query()
	{
		$this->query = 'SQL Gränssnitt';
		$this->query_fail = 'Misslyckades.';
		$this->query_success = 'Exekvering lyckad.';
		$this->query_your = 'Ditt kommando';
	}

	function recent()
	{
		$this->recent_active = 'Aktiva ämnen sen senaste besök';
		$this->recent_by = 'Av';
		$this->recent_can_post = 'Du kan svara i detta forum.';
		$this->recent_can_topics = 'Du kan läsa ämnen i detta forum.';
		$this->recent_cant_post = 'Du kan inte svara i detta forum.';
		$this->recent_cant_topics = 'Du kan inte läsa ämnen i detta forum.';
		$this->recent_dot = 'Prick';
		$this->recent_dot_detail = 'Visar att du skrivit inlägg i ämnet';
		$this->recent_forum = 'Forum';
		$this->recent_guest = 'Gäst';
		$this->recent_hot = 'Het';
		$this->recent_icon = 'Meddelandeikon';
		$this->recent_jump = 'Hoppa till nyaste inlägg i ämnet';
		$this->recent_last = 'Senaste Inlägg';
		$this->recent_locked = 'Låst';
		$this->recent_moved = 'Flyttad';
		$this->recent_msg = '%s Meddelande';
		$this->recent_new = 'Ny';
		$this->recent_new_poll = 'Skapa Ny Röstning';
		$this->recent_new_topic = 'Skapa Nytt Ämne';
		$this->recent_no_topics = 'Det finns inga ämnen att visa i detta forum.';
		$this->recent_noexist = 'Forumet existerar inte.';
		$this->recent_nopost = 'Inga inlägg';
		$this->recent_not = 'Inte';
		$this->recent_noview = 'Du har inte tillåtelse att läsa forum.';
		$this->recent_pages = 'Sidor';
		$this->recent_pinned = 'Klistrad';
		$this->recent_pinned_topic = 'Klistrat Ämne';
		$this->recent_poll = 'Omröstning';
		$this->recent_regfirst = 'Du har inte tillåtelse att läsa forum utan att först registrera dig.';
		$this->recent_replies = 'Svar';
		$this->recent_starter = 'Skapare';
		$this->recent_sub = 'Underforum';
		$this->recent_sub_last_post = 'Senaste Inlägg';
		$this->recent_sub_replies = 'Svar';
		$this->recent_sub_topics = 'Ämnen';
		$this->recent_subscribe = 'E-posta mig när nya inlägg skrivits i detta forum.';
		$this->recent_topic = 'Ämne';
		$this->recent_views = 'Visningar';
		$this->recent_write_topics = 'Du kan skapa nya ämnen i detta forum.';
	}

	function register()
	{
		$this->register_activated = 'Ditt konto är aktiverat!';
		$this->register_activating = 'Kontoaktivering';
		$this->register_activation_error = 'Det uppstod ett problem när ditt konto skulle aktiveras. Kolla så att din browser har den kompletta aktiveringsadressen från mejlet. Om problemet kvarstår, kontakta forumets administrator för att få ett nytt aktiveringsmejl.';
		$this->register_confirm_passwd = 'Bekräfta Lösenordet';
		$this->register_done = 'Du är registrerad! Du kan nu logga in.';
		$this->register_email = 'E-post Adress';
		$this->register_email_invalid = 'E-post adressen du skrivit in är ogiltig.';
		$this->register_email_msg = 'Det här är ett automatikst e-post genererat av Quicksilver Forumet, och skickat till dig för att';
		$this->register_email_msg2 = 'du ska kunna aktivera ditt konto';
		$this->register_email_msg3 = 'Klicka på den nedanstående länlen eller klistra in den i din webläsare:';
		$this->register_email_used = 'E-post adressen du skrivit in används redan av en medlem.';
		$this->register_fields = 'Alla fält är inte ifyllda.';
		$this->register_flood = 'Du har redan registrerat dig.';
		$this->register_image = 'Var god skriv av den text som visas i bilden';
		$this->register_image_invalid = 'För att bevisa att det är en människa som registrerar och inte ett datorprogram, skriv av texten som visas i bilden.';
		$this->register_initiated = 'Den här begäran skickades från IP:';
		$this->register_must_activate = 'Du är nu registrerad. Ett epostmeddelande har sänts till %s med information om hur du aktiverar ditt användarkonto. Dina rättigheter i forumet är begränsade tills du utfört aktiveringen.';
		$this->register_name_invalid = 'Namnet du skrev in är för långt.';
		$this->register_name_taken = 'Det medlemsnamnet är redan upptaget.';
		$this->register_new_user = 'Önskat Användarnamn';
		$this->register_pass_invalid = 'Lösenordet du skrev in är ogiltigt. Försäkra dig om att enbart giltiga tecken som bokstäver, nummer, streck, understreck och mellanslag används och att lösenordet är minst 5 bokstäver långt.';
		$this->register_pass_match = 'Lösenorden du skrev in är olika.';
		$this->register_passwd = 'Lösenord';
		$this->register_reg = 'Registrera';
		$this->register_reging = 'Registrerar';
		$this->register_requested = 'Begäran av kontoaktivering för:';
		$this->register_tos = 'Vilkor för användande';
		$this->register_tos_i_agree = 'Jag godkänner ovanstående vilkor';
		$this->register_tos_not_agree = 'Du godkände inte villkoren.';
		$this->register_tos_read = 'Var snäll och läs följande vilkor för tjänsten';
	}

	function rssfeed()
	{
		$this->rssfeed_cannot_find_forum = 'Forumet verkar inte finnas';
		$this->rssfeed_cannot_find_topic = 'Ämnet verkar inte finnas';
		$this->rssfeed_cannot_read_forum = 'Du har inte tillstånd att läsa detta forum';
		$this->rssfeed_cannot_read_topic = 'Du har inte tillstånd att läsa detta ämne';
		$this->rssfeed_error = 'Ett fel uppstod';
		$this->rssfeed_forum = 'Forum:';
		$this->rssfeed_posted_by = 'Skrivet av';
		$this->rssfeed_topic = 'Ämne:';
	}

	function search()
	{
		$this->search_advanced = 'Avancerade Alternativ';
		$this->search_avatar = 'Visningsbild';
		$this->search_basic = 'Enkel Sökning';
		$this->search_characters = 'bokstäverna av ett inlägg';
		$this->search_day = 'dag';
		$this->search_days = 'dagar';
		$this->search_exact_name = 'exakt namn';
		$this->search_flood = 'Du har sökt under de senaste %s sekunderna, och du kan inte söka just nu.<br /><br />Var snäll och försök igen om några sekunder.';
		$this->search_for = 'Sök Efter';
		$this->search_forum = 'Forum';
		$this->search_group = 'Grupp';
		$this->search_guest = 'Gäst';
		$this->search_in = 'Sök inom';
		$this->search_in_posts = 'Sök endast i inlägg';
		$this->search_ip = 'IP';
		$this->search_joined = 'Gick Med';
		$this->search_level = 'Medlemsstatus';
		$this->search_match = 'Sök med matchning';
		$this->search_matches = 'Träffar';
		$this->search_month = 'Månad';
		$this->search_months = 'månader';
		$this->search_mysqldoc = 'MySQL Dokumentation';
		$this->search_newer = 'nyare';
		$this->search_no_results = 'Din sökning gav inget resultat.';
		$this->search_no_words = 'Du måste specificera några söktermer.<br /><br />Varje term måste vara minst 3 tecken inklusive bokstäver, nummer, apostrofer och understreck.';
		$this->search_offline = 'Den här medlemmen är utloggad just nu';
		$this->search_older = 'äldre';
		$this->search_online = 'Den här medlemmen är inloggad just nu';
		$this->search_only_display = 'Visa endast de första';
		$this->search_partial_name = 'delar av namnet';
		$this->search_post_icon = 'Inläggsikon';
		$this->search_posted_on = 'Skrivet';
		$this->search_posts = 'Inlägg';
		$this->search_posts_by = 'Endast inlägg av';
		$this->search_regex = 'Sök med reguljärt uttryck';
		$this->search_regex_failed = 'Ditt uttryck misslyckades. Var god se MSQL-dokumentationen: hjälp för reguljära uttryck ';
		$this->search_relevance = 'Relevans: %d%%';
		$this->search_replies = 'Inlägg';
		$this->search_result = 'Söknings Resultat';
		$this->search_search = 'Sök';
		$this->search_select_all = 'Välj Samtliga';
		$this->search_show_posts = 'Visa matchande inlägg';
		$this->search_sound = 'Sök med ljud';
		$this->search_starter = 'Skapare';
		$this->search_than = 'än';
		$this->search_topic = 'Ämne';
		$this->search_unreg = 'Ej registrerad';
		$this->search_week = 'vecka';
		$this->search_weeks = 'veckor';
		$this->search_year = 'år';
	}

	function settings()
	{
		$this->settings = 'Inställningar';
		$this->settings_active = 'Inställninar för Aktiva Användare';
		$this->settings_allow = 'Tillåt';
		$this->settings_antibot = 'Anti-Robot Registrering';
		$this->settings_attach_ext = 'Bifogade filer - Fil Typer';
		$this->settings_attach_one_per = 'En per rad. Inga punkter.';
		$this->settings_avatar = 'Inställnigar för Visningsbild';
		$this->settings_avatar_flash = 'Flash Visningsbilder';
		$this->settings_avatar_max_height = 'Maximal Höjd på Visningsbild';
		$this->settings_avatar_max_width = 'Maximal Bredd på Visningsbild';
		$this->settings_avatar_upload = 'Ladda upp Visningsbild - Maximal Filstorlek';
		$this->settings_basic = 'Ändra Foruminställningar';
		$this->settings_blank = 'Använd <i>_blank</i> för ett nytt fönster.';
		$this->settings_board_enabled = 'Forum Aktiverat';
		$this->settings_board_location = 'Adress till Forumet';
		$this->settings_board_name = 'Fourmnamn';
		$this->settings_board_rss = 'Inställningar för RSS Matning';
		$this->settings_board_rssfeed_desc = 'Beskrivning av RSS Matningen';
		$this->settings_board_rssfeed_posts = 'Antal inlägg att lista genom RSS Matningen';
		$this->settings_board_rssfeed_time = 'Omladdningstid i minuter';
		$this->settings_board_rssfeed_title = 'RSS Matningens Titel';
		$this->settings_clickable = 'Klickbara Emoticons Per Rad';
		$this->settings_cookie = 'Cookie och Flood Inställningar';
		$this->settings_cookie_path = 'Cookie Sökväg';
		$this->settings_cookie_prefix = 'Cookie Prefix';
		$this->settings_cookie_time = 'Tid för att kvarstå som inloggad';
		$this->settings_db = 'Ändra Inställningar för Anslutning';
		$this->settings_db_host = 'Databas Värd';
		$this->settings_db_leave_blank = 'Lämna tom om ingen.';
		$this->settings_db_multiple = 'För att installera flera forum i en databas.';
		$this->settings_db_name = 'Databasnamn';
		$this->settings_db_password = 'Databaslösenord';
		$this->settings_db_port = 'Databasport';
		$this->settings_db_prefix = 'Tabellprefix';
		$this->settings_db_socket = 'Databassocket';
		$this->settings_db_username = 'Databasanvändarnamn';
		$this->settings_debug_mode = 'Debug Läge';
		$this->settings_default_lang = 'Förvalt Språk';
		$this->settings_default_no = 'Förvalt Nej';
		$this->settings_default_skin = 'Förvalt Skal';
		$this->settings_default_yes = 'Förval Ja';
		$this->settings_disabled = 'Avaktiverad';
		$this->settings_disabled_notice = 'Meddelande vid Avaktiverad';
		$this->settings_email = 'E-Postinställningar';
		$this->settings_email_fake = 'För visning endast. Borde inte vara en riktig e-postadress.';
		$this->settings_email_from = 'E-post Från Adress';
		$this->settings_email_place1 = 'Placera medlemmar i gruppen';
		$this->settings_email_place2 = 'tills de verifierat sin e-post';
		$this->settings_email_place3 = 'Kräv inte e-post aktivering';
		$this->settings_email_real = 'Ska vara en riktig e-postadress.';
		$this->settings_email_reply = 'E-post Svara-Till Adress';
		$this->settings_email_smtp = 'SMTP Post Server';
		$this->settings_email_valid = 'Ny medlems E-postverifiering';
		$this->settings_enabled = 'Aktiverad';
		$this->settings_enabled_modules = 'Aktiverade Moduler';
		$this->settings_foreign_link = 'Mål för Främmande Länkar';
		$this->settings_general = 'Allmäna Inställningar';
		$this->settings_group_after = 'Grupp Efter Registrering';
		$this->settings_hot_topic = 'Inlägg för ett Hett Ämne';
		$this->settings_kilobytes = 'Kilobytes';
		$this->settings_max_attach_size = 'Bifogade filer - Maximal Filstorlek';
		$this->settings_members = 'Medlemsinställningar';
		$this->settings_modname_only = 'Endast modulnamn. Inkludera inte .php';
		$this->settings_new = 'Ny Inställning';
		$this->settings_new_add = 'Lägg till foruminställning';
		$this->settings_new_added = 'Ny inställning har lagts till.';
		$this->settings_new_exists = 'Den inställningen finns redan. Välj ett annat namn för den.';
		$this->settings_new_name = 'Namn på ny inställning';
		$this->settings_new_required = 'Namn på den nya inställningen krävs.';
		$this->settings_new_value = 'Värde på ny inställning';
		$this->settings_no_allow = 'Tillåt Inte';
		$this->settings_nodata = 'Ingen data sändes från POST';
		$this->settings_one_per = 'En per rad';
		$this->settings_pixels = 'Pixlar';
		$this->settings_pm_flood = 'Floodkontroll för Personligt Meddelande';
		$this->settings_pm_min_time = 'Minimum tid mellan meddelanden.';
		$this->settings_polls = 'Omröstningar';
		$this->settings_polls_no = 'Användare kan inte delta i röstning efter att ha kollat dess resultat';
		$this->settings_polls_yes = 'Användare kan delta i röstning efter att ha kollat dess resultat';
		$this->settings_post_flood = 'Floodkontroll för Inlägg';
		$this->settings_post_min_time = 'Minimum tid mellan inlägg.';
		$this->settings_posts_topic = 'Inlägg per sida i ett ämne';
		$this->settings_search_flood = 'Sökning Flood Kontroll';
		$this->settings_search_min_time = 'Minimum tid mellan sökningar.';
		$this->settings_server = 'Serverinställningar';
		$this->settings_server_gzip = 'GZIP Komprimering';
		$this->settings_server_gzip_msg = 'Förbättrar farten. Avaktivera om forumet blir konstigt eller tomt.';
		$this->settings_server_maxload = 'Maximal Serverbelastning';
		$this->settings_server_maxload_msg = 'Avaktivera forumet vid extrem serverbelastning. Skriv 0 för att avaktivera.';
		$this->settings_server_timezone = 'Server Tids Zon';
		$this->settings_show_avatars = 'Visa Visningsbilder';
		$this->settings_show_email = 'Visa E-postadress';
		$this->settings_show_emotes = 'Visa Emoticons';
		$this->settings_show_notice = 'Visas när forumet är avaktiverat';
		$this->settings_show_pm = 'Acceptera Personliga Meddelanden';
		$this->settings_show_sigs = 'Visa Signaturer';
		$this->settings_spider_agent = 'Spindel Användar Agent';
		$this->settings_spider_agent_msg = 'Skriv hela aller en del av spindelns unika HTTP USER AGENT.';
		$this->settings_spider_enable = 'Aktivera Spindel Visning';
		$this->settings_spider_enable_msg = 'Aktivera namnen på sökmotor spindlar på Listan över Aktiva.';
		$this->settings_spider_name = 'Spindel Namn';
		$this->settings_spider_name_msg = 'Skriv in namnet du vill ska visas för varje av de ovanstående spindlarna på Listan över Aktiva. Du måste placera spindelns namn på motsvarande rad som spindelns användar agent ovan. Till exempel, om du placerar \'googlebot\' på den tredje raden av användar agenter måste du placera \'Google\' på den tredje raden för Spindel Namn.';
		$this->settings_timezone = 'Tids Zon';
		$this->settings_topics_page = 'Ämnen Per Forumsida';
		$this->settings_tos = 'Vilkor för Tjänsten';
		$this->settings_updated = 'Inställningarna har uppdaterats.';
	}

	function stats()
	{
		$this->stats = 'Statistik';
		$this->stats_post_by_month = 'Inlägg per Månad';
		$this->stats_reg_by_month = 'Registreringar per Månad';
	}

	function templates()
	{
		$this->add = 'Lägg till HTML Mallar';
		$this->add_in = 'Lägg till mall till:';
		$this->all_fields_required = 'Alla fält krävs för att lägga till en mall';
		$this->choose_css = 'Välj CSS Mall';
		$this->choose_set = 'Välje ett mallpaket';
		$this->choose_skin = 'Välj ett skal';
		$this->confirm1 = 'Du är på väg att ta bort';
		$this->confirm2 = 'mallen från';
		$this->create_new = 'Skapa ett nytt skal med namnet';
		$this->create_skin = 'Skapa Skal';
		$this->credit = 'Var snäll och ta inte bort vårt enda erkännande!';
		$this->css_edited = 'CSS filen har uppdaterats.';
		$this->css_fioerr = 'Kunde inte skriva till filen, du måste CHMOD filen manuellt.';
		$this->delete_template = 'Ta bort Mall';
		$this->directory = 'Mapp';
		$this->display_name = 'Visningsnamn';
		$this->edit_css = 'Ändra CSS';
		$this->edit_skin = 'Ändra Skal';
		$this->edit_templates = 'Ändra Mallar';
		$this->export_done = 'Skal exporterat till mappen skins.';
		$this->export_select = 'Välj ett skal att exportera';
		$this->export_skin = 'Exportera Skal';
		$this->install_done = 'Installationen av skalet har lyckats.';
		$this->install_exists1 = 'Det verkar som om skalet';
		$this->install_exists2 = 'redan är installerat.';
		$this->install_overwrite = 'Skriv Över';
		$this->install_skin = 'Installera Skal';
		$this->menu_title = 'Välj ett mallpaket att ändra';
		$this->no_file = 'Filen finns inte.';
		$this->only_skin = 'Det finns bara ett skal installerat. Du får inte ta bort det här skalet.';
		$this->or_new = 'Eller skapa en ny mall kallad:';
		$this->select_skin = 'Välj ett skal';
		$this->select_skin_edit = 'Välj ett skal att ändra';
		$this->select_skin_edit_done = 'Ändringen av skalet lyckades.';
		$this->select_template = 'Välj Mall';
		$this->skin_chmod = 'En ny mapp kunde inte skapas för skalet. Försök att CHMOD mappen \"skins\" till 775.';
		$this->skin_created = 'Skal Skapat.';
		$this->skin_deleted = 'Borttagning av skalet lyckades.';
		$this->skin_dir_name = 'Du måste ange ett namn och en mapp för skalet.';
		$this->skin_dup = 'Ett skal med samma mapp namn hittades. Skalets mapp ändrades till';
		$this->skin_name = 'Du måste ange namn för skalet.';
		$this->skin_none = 'Det finns inga tillgängliga skal att installera.';
		$this->skin_set = 'Skaluppsättning';
		$this->skins_found = 'Följande skal hittades i mappen skins';
		$this->template_about = 'Om Variabler';
		$this->template_about2 = 'Variabler är delar av text som ersätts med dynamisk data. Variabler börjar med ett dollartecken, och omsluts ibland av {parenteser}.';
		$this->template_add = 'Lägg till';
		$this->template_added = 'Mall tillagd.';
		$this->template_clear = 'Töm';
		$this->template_confirm = 'Du har gjort ändringar i mallarna. Vill du spara dina ändringar?';
		$this->template_description = 'Mallbeskrivning';
		$this->template_html = 'Mall HTML';
		$this->template_name = 'Mall Namn';
		$this->template_position = 'Mallposition';
		$this->template_set = 'Mallupaket';
		$this->template_title = 'Malltitel';
		$this->template_universal = 'Universal Variabel';
		$this->template_universal2 = 'Vissa variabler kan användas i valfri mall, medna andra bara i en mall. Egenskaper för objektet $this kan användas överallt.';
		$this->template_updated = 'Mall uppdaterad.';
		$this->templates = 'Mallar';
		$this->temps_active = 'Detaljer för Aktiva Användare';
		$this->temps_admin = '<b>AdminKP Universal</b>';
		$this->temps_ban = 'AdminKP Blockeringar';
		$this->temps_board_index = 'Forum Index';
		$this->temps_censoring = 'AdminKP Ordcensurering';
		$this->temps_cp = 'Kontrollpanel för Medlem';
		$this->temps_email = 'E-posta en Medlem';
		$this->temps_emot_control = 'AdminKP Emoticons';
		$this->temps_forum = 'Forum';
		$this->temps_forums = 'AdminKP Forum';
		$this->temps_groups = 'AdminKP Grupper';
		$this->temps_help = 'Hjälp';
		$this->temps_login = 'Logga In/Ut';
		$this->temps_logs = 'AdminKP Moderatorloggar';
		$this->temps_main = '<b>Forum Universal</b>';
		$this->temps_mass_mail = 'AdminKP Mass E-post';
		$this->temps_member_control = 'AdminKP Medlemskontroll';
		$this->temps_members = 'Medlemslista';
		$this->temps_mod = 'Moderator Kontroller';
		$this->temps_pm = 'Snabbmeddelanden';
		$this->temps_polls = 'Omröstningar';
		$this->temps_post = 'Inläggshantering';
		$this->temps_printer = 'Skrivar-Vänliga Ämnen';
		$this->temps_profile = 'Profilspaning';
		$this->temps_recent = 'Nya Ämnen';
		$this->temps_register = 'Registrering';
		$this->temps_rssfeed = 'RSS Matning';
		$this->temps_search = 'Sökning';
		$this->temps_settings = 'AdminKP Inställningar';
		$this->temps_templates = 'AdminKP Mallediterare';
		$this->temps_titles = 'AdminKP Medlemstitlar';
		$this->temps_topic_prune = 'AdminKP Ämnesrensning';
		$this->temps_topics = 'Ämnen';
		$this->upgrade_skin = 'Uppdatera Skal';
		$this->upgrade_skin_already = 'var redan uppgraderat. Finns inget att göra.';
		$this->upgrade_skin_detail = 'Skal uppgraderade med denna metod behöver ändå justeras efteråt.<br />Välj ett skal att uppdatera';
		$this->upgrade_skin_upgraded = 'Skalet har uppdaterats.';
		$this->upgraded_templates = 'Följande mallar lades till';
	}

	function titles()
	{
		$this->titles_add = 'Lägg till Medlemstitlar';
		$this->titles_added = 'Medlemstitel Tillagd.';
		$this->titles_control = 'Kontroll för medlemstitel';
		$this->titles_edit = 'Ändra Medlemstitlar';
		$this->titles_error = 'Ingen titeltext eller minimum inlägg angavs';
		$this->titles_image = 'Bild';
		$this->titles_minpost = 'Minimum Inlägg';
		$this->titles_nodel_default = 'Du kan inte längre ta bort en standardtitel eftersom ditt forum kommer sluta fungera då, använd ändringsmöjligheten istället.';
		$this->titles_title = 'Titel';
	}

	function topic()
	{
		$this->topic_attached = 'Bifogad fil:';
		$this->topic_attached_downloads = 'nedladdningar';
		$this->topic_attached_filename = 'Filnamn:';
		$this->topic_attached_image = 'Bifogad bild:';
		$this->topic_attached_perm = 'Du har inte tillåtelse att ladda hem den här filen.';
		$this->topic_attached_size = 'Storlek:';
		$this->topic_attached_title = 'Bifogad Fil';
		$this->topic_avatar = 'Visningsbild';
		$this->topic_bottom = 'Gå till botten av sidan';
		$this->topic_create_poll = 'Skapa Ny Omröstning';
		$this->topic_create_topic = 'Skapa Nytt Ämne';
		$this->topic_delete = 'Radera';
		$this->topic_delete_post = 'Radera detta inlägg';
		$this->topic_edit = 'Redigera';
		$this->topic_edit_post = 'Redigera detta inlägg';
		$this->topic_edited = 'Senast redigerad %s av %s';
		$this->topic_error = 'Fel';
		$this->topic_group = 'Grupp';
		$this->topic_guest = 'Gäst';
		$this->topic_ip = 'IP';
		$this->topic_joined = 'Gick Med';
		$this->topic_level = 'Medelemsnivå';
		$this->topic_links_aim = 'Skicka ett AIM meddelande till %s';
		$this->topic_links_email = 'Skicka ett e-post till %s';
		$this->topic_links_gtalk = 'Skicka ett GTalk meddelande till %s';
		$this->topic_links_icq = 'Skicka ett ICQ meddelande till %s';
		$this->topic_links_msn = 'Visa %s\'s MSN profil';
		$this->topic_links_pm = 'Skicka ett personligt meddelande till %s';
		$this->topic_links_web = 'Besök %s\'s hemsida';
		$this->topic_links_yahoo = 'Skicka ett meddelande till %s med Yahoo! Messenger';
		$this->topic_lock = 'Lås';
		$this->topic_locked = 'Ämnet Låst';
		$this->topic_move = 'Flytta';
		$this->topic_new_post = 'Inlägget är oläst';
		$this->topic_newer = 'Nyare ämnen';
		$this->topic_no_newer = 'Det finns inga nyare ämnen.';
		$this->topic_no_older = 'Det finns inga äldre ämnen.';
		$this->topic_no_votes = 'Det finns inga röster i den här omröstningen.';
		$this->topic_not_found = 'Ämnet Kunde Inte Hittas';
		$this->topic_not_found_message = 'Ämnet kunde inte hittas. Det kan ha blivit raderat, flyttat eller så har det aldrig funnits.';
		$this->topic_offline = 'Den här medlemmen är utloggad just nu';
		$this->topic_older = 'Äldre Ämnen';
		$this->topic_online = 'Den här medlemmen är inloggad just nu';
		$this->topic_options = 'Ämnesalternativ';
		$this->topic_pages = 'Sidor';
		$this->topic_perm_view = 'Du har inte tillåtelse att läsa ämnen.';
		$this->topic_perm_view_guest = 'Du har inte tillåtelse att läsa ämnen innan du registrerat dig.';
		$this->topic_pin = 'Klistra';
		$this->topic_posted = 'Inlaggd';
		$this->topic_posts = 'Inlägg';
		$this->topic_print = 'Visa Utskriftsvänlig';
		$this->topic_publish = 'Publicera';
		$this->topic_qr_emoticons = 'Emoticons';
		$this->topic_qr_open_emoticons = 'Öppna Klickbara Emoticons';
		$this->topic_qr_open_mbcode = 'Öppna MBCode';
		$this->topic_quickreply = 'Snabbsvar';
		$this->topic_quote = 'Svara med ett citat från detta inlägg';
		$this->topic_reply = 'Svara på Ämne';
		$this->topic_split = 'Dela upp';
		$this->topic_split_finish = 'Avsluta all uppdelning';
		$this->topic_split_keep = 'Flytta inte på detta inlägg';
		$this->topic_split_move = 'Flytta detta inlägg';
		$this->topic_subscribe = 'E-posta mig när inlägg skrivits i detta ämne';
		$this->topic_top = 'Gå till toppen av sidan';
		$this->topic_unlock = 'Lås Upp';
		$this->topic_unpin = 'Klistra Av';
		$this->topic_unpublish = 'Avpublicera';
		$this->topic_unpublished = 'Detta ämne är klassat som ej publicerat så du har inte rättighet att kolla det.';
		$this->topic_unreg = 'Oregistrerad';
		$this->topic_view = 'Visa Resultat';
		$this->topic_viewing = 'Visar Ämne';
		$this->topic_vote = 'Rösta';
		$this->topic_vote_count_plur = '%d röster';
		$this->topic_vote_count_sing = '%d röst';
		$this->topic_votes = 'Röster';
	}

	function universal()
	{
		$this->aim = 'AIM';
		$this->based_on = 'baserad på';
		$this->board_by = 'Av';
		$this->charset = 'utf-8';
		$this->continue = 'Fortsätt';
		$this->date_long = 'j M Y';
		$this->date_short = 'y/n/j';
		$this->delete = 'Ta bort';
		$this->direction = 'vth';
		$this->edit = 'Ändra';
		$this->email = 'E-post';
		$this->gtalk = 'GT';
		$this->icq = 'ICQ';
		$this->msn = 'MSN';
		$this->new_message = 'Nytt Meddelande';
		$this->new_poll = 'Ny Omröstning';
		$this->new_topic = 'Nytt Ämne';
		$this->no = 'Nej';
		$this->powered = 'Drivs med';
		$this->private_message = 'PM';
		$this->quote = 'Citera';
		$this->recount_forums = 'Forum omräknade! Totalt ämnen: %d. Totalt inlägg: %d.';
		$this->reply = 'Svara';
		$this->seconds = 'Sekunder';
		$this->select_all = 'Välj alla';
		$this->sep_decimals = ',';
		$this->sep_thousands = ' ';
		$this->spoiler = 'Avslöjande';
		$this->submit = 'Skicka';
		$this->subscribe = 'Prenumerera';
		$this->time_long = ', G:i';
		$this->time_only = 'G:i';
		$this->today = 'Idag';
		$this->website = 'WWW';
		$this->yahoo = 'Yahoo';
		$this->yes = 'Ja';
		$this->yesterday = 'Igår';
	}
}
?>
