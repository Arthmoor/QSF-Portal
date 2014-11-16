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
 * Dutch language module
 *
 * @author Daniël Rokven <rokven@gmail.com>
 * @author Sander Knape <hetisik@gmail.com>
 * @author Bart Verellen <bartverellen@gmail.com>
 * @since 1.0.0 Beta 4.0
 **/
class nl
{
	function active()
	{
		$this->active_last_action = 'Laatste actie';
		$this->active_modules_active = 'Bekijkt actieve gebruikers';
		$this->active_modules_board = 'Bekijkt index';
		$this->active_modules_cp = 'Gebruikt controlepaneel';
		$this->active_modules_forum = 'Het bekijken van een forum: %s';
		$this->active_modules_help = 'Gebruikt help';
		$this->active_modules_login = 'Logt in/uit';
		$this->active_modules_members = 'Bekijkt Gebruikerslijst';
		$this->active_modules_mod = 'Modereren';
		$this->active_modules_pm = 'Gebruikt Messenger';
		$this->active_modules_post = 'Bezig met een bericht te plaatsen';
		$this->active_modules_printer = 'Onderwerp afdrukken %s';
		$this->active_modules_profile = 'Het bekijken van profiel: %s';
		$this->active_modules_recent = 'Recente berichten bekijken';
		$this->active_modules_search = 'Zoekt';
		$this->active_modules_topic = 'Het bekijken van onderwerp: %s';
		$this->active_time = 'Tijd';
		$this->active_user = 'Gebruiker';
		$this->active_users = 'Actieve gebruikers';
	}

	function admin()
	{
		$this->admin_add_emoticons = 'Emoticons toevoegen';
		$this->admin_add_member_titles = 'Automatisch groepsnamen toevoegen';
		$this->admin_add_templates = 'HTML sjablonen toevoegen';
		$this->admin_ban_ips = 'IP addressen bannen';
		$this->admin_censor = 'Woorden censureren';
		$this->admin_cp_denied = 'Toegang  geweigerd';
		$this->admin_cp_warning = 'De Admin CP is uitgeschakeld totdat u uw <b>install</b> directory heeft verwijderd, daar het een groot veiligheidsrisico vertoont.';
		$this->admin_create_forum = 'Opstarten van een forum';
		$this->admin_create_group = 'Opstarten van een groep';
		$this->admin_create_help = 'Opstarten van een hulp artikel';
		$this->admin_create_skin = 'Ontwerp een skin';
		$this->admin_db = 'Database'; //Translate
		$this->admin_db_backup = 'Maak een backup van de database aan.';
		$this->admin_db_conn = 'Aanpassen van netwerk opties';
		$this->admin_db_optimize = 'Optimaliseer de database';
		$this->admin_db_query = 'Voer een SQL query uit';
		$this->admin_db_restore = 'Herstel de backup';
		$this->admin_delete_forum = 'Forum verwijderen';
		$this->admin_delete_group = 'Groep verwijderen';
		$this->admin_delete_help = 'Help artikel verwijderen';
		$this->admin_delete_member = 'Gebruiker verwijderen';
		$this->admin_delete_template = 'HTML sjabloon verwijderen';
		$this->admin_edit_emoticons = 'Aanpassen of verwijderen van emoticons';
		$this->admin_edit_forum = 'Forum aanpassen';
		$this->admin_edit_group_name = 'Groepsnaam aanpassen';
		$this->admin_edit_group_perms = 'Groepsrechten aanpassen';
		$this->admin_edit_help = 'Help artikel aanpassen';
		$this->admin_edit_member = 'Gebruikersopties aanpassen';
		$this->admin_edit_member_perms = 'Verander een gebruiker zijn rechten';
		$this->admin_edit_member_titles = 'Automatisch aanpassen of verwijderen van gebruikersgroepen';
		$this->admin_edit_settings = 'Verander board opties';
		$this->admin_edit_skin = 'Verander of verwijder een skin';
		$this->admin_edit_templates = 'Verander HTML templates';
		$this->admin_emoticons = 'Emoticons'; //Translate
		$this->admin_export_skin = 'Exporteer a skin';
		$this->admin_fix_stats = 'Herstel de gebruiker zijn statistieken';
		$this->admin_forum_order = 'Verander de forum instellingen';
		$this->admin_forums = 'Forums en Categories';
		$this->admin_groups = 'Groepen';
		$this->admin_heading = 'Quicksilver Forums Admin Control Panel'; //Translate
		$this->admin_help = 'Help Artikels';
		$this->admin_install_emoticons = 'Emoticons installeren';
		$this->admin_install_skin = 'Installeer een skin';
		$this->admin_logs = 'Bekijk moderator acties';
		$this->admin_mass_mail = 'Stuur een e-mail naar jouw gebruikers';
		$this->admin_members = 'Gebruikers';
		$this->admin_phpinfo = 'Bekijk PHP informatie';
		$this->admin_prune = 'Prune old topics'; //Translate
		$this->admin_recount_forums = 'Tel de onderwerpen en antwoorden opnieuw';
		$this->admin_settings = 'Settings'; //Translate
		$this->admin_settings_add = 'Add new board setting'; //Translate
		$this->admin_skins = 'Skins'; //Translate
		$this->admin_stats = 'Statestieken center';
		$this->admin_upgrade_skin = 'Upgrade a Skin'; //Translate
		$this->admin_your_board = 'Uw bestuurskamer';
	}

	function backup()
	{
		$this->backup_create = 'Maak een backup van de database';
		$this->backup_createfile = 'Backup and create a file on server'; //Translate
		$this->backup_done = 'De database heeft een backup gemaakt in de Quicksilver Forums.';
		$this->backup_download = 'Backup and download (recommended)'; //Translate
		$this->backup_found = 'De volgende backups werden niet terug gevonden in de Quicksilver directory';
		$this->backup_invalid = 'De backup is niet geldig. Er werden geen veranderingen in uw database aangebracht.';
		$this->backup_none = 'Er werden geen backups teruggevonden in de Quicksilver Forums.';
		$this->backup_options = 'Select how you want your backup created'; //Translate
		$this->backup_restore = 'Herstel de backup';
		$this->backup_restore_done = 'De database is met succes herstelt.';
		$this->backup_warning = 'Waarschuwing: Deze toepassing zal alle bestaande data, gebruikt door Quicksilver Forums, overschijven.';
	}

	function ban()
	{
		$this->ban = 'Ban'; //Translate
		$this->ban_banned_ips = 'Ban IP Addressen';
		$this->ban_banned_members = 'Verbannen gebruikers';
		$this->ban_ip = 'Verban IP Addressen';
		$this->ban_member_explain1 = 'Om gebruikers te bannen: verander hun gebruikersgroep in';
		$this->ban_member_explain2 = 'In de gebruikersinstellingen.';
		$this->ban_members = 'Verbannen gebruikers';
		$this->ban_nomembers = 'Er zijn momenteel geen gebannen gebruikers.';
		$this->ban_one_per_line = 'Een adres per lijn.';
		$this->ban_regex_allowed = 'Vaste uitdrukkingen zijn toegelaten. Je kan een * gebruiken als wildcard voor een of meer digits.';
		$this->ban_settings = 'Ban opties';
		$this->ban_users_banned = 'Gebannen gebruikers.';
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
		$this->board_active_users = 'Actieve gebruikers';
		$this->board_birthdays = 'Gebruikers die jarig zijn vandaag:';
		$this->board_bottom_page = 'Ga naar onderaan de pagina';
		$this->board_can_post = 'Je mag reacties plaatsen';
		$this->board_can_topics = 'Je mag onderwerpen bekijken in dit forum.';
		$this->board_cant_post = 'Je mag niet antwoorden.';
		$this->board_cant_topics = 'Je mag geen onderwerpen bekijken in dit forum.';
		$this->board_forum = 'Forum'; //Translate
		$this->board_guests = 'Gasten';
		$this->board_last_post = 'Laatst geplaatst op';
		$this->board_mark = 'Markeer berichten als gelezen';
		$this->board_mark1 = 'Alle berichten en forums zijn als gelezen gemarkeerd.';
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = 'Gebruikers';
		$this->board_message = '%s bericht';
		$this->board_most_online = 'Grootst aantal gebruikers online was %d op %s.';
		$this->board_nobday = 'Er is geen lid jarig vandaag';
		$this->board_nobody = 'Er zijn geen gebruikers online';
		$this->board_nopost = 'Geen Onderwerpen';
		$this->board_noview = 'Je hebt geen bevoegdheid om de berichten op dit forum te bekijken.';
		$this->board_regfirst = 'Je hebt geen toestemming om het forum te bekijken. Als u zich registreert, kunt u het wel.';
		$this->board_replies = 'Antwoorden';
		$this->board_stats = 'Statistieken';
		$this->board_stats_string = '%s gebruikers hebben zich geregistreerd. Ons nieuwste lid is, %s.<br />Er zijn %s Onderwerpen en %s antwoorden in een totaal van %s berichten.';
		$this->board_top_page = 'Ga naar bovenaan de pagina';
		$this->board_topics = 'Onderwerpen';
		$this->board_users = 'Gebruikers';
		$this->board_write_topics = 'Je mag nieuwe onderwerpen plaatsen in dit forum.';
	}

	function censoring()
	{
		$this->censor = 'Censureer Woorden';
		$this->censor_one_per_line = 'Een per regel.';
		$this->censor_regex_allowed = 'Vaste uitdrukkingen zijn toegelaten. Je kan een * gebruiken als wildcard voor een of meer digits.';
		$this->censor_updated = 'Woordenlijst bijgewerkt.';
	}

	function cp()
	{
		$this->cp_aim = 'AIM naam:';
		$this->cp_already_member = 'Het opgegeven e-mail adres bestaat al.';
		$this->cp_apr = 'April'; //Translate
		$this->cp_aug = 'Augustus';
		$this->cp_avatar_current = 'Huidige avatar';
		$this->cp_avatar_error = 'Avatar fout';
		$this->cp_avatar_must_select = 'Je moet een avatar kiezen.';
		$this->cp_avatar_none = 'Gebruik geen avatar';
		$this->cp_avatar_pixels = 'pixels'; //Translate
		$this->cp_avatar_select = 'Selecteer een avatar';
		$this->cp_avatar_size_height = 'Uw avatar hoogte moet tussen 1 en zijn';
		$this->cp_avatar_size_width = 'Uw avatar breedte moet tussen 1 en zijn';
		$this->cp_avatar_upload = 'Upload een avatar vanaf u harde schijf';
		$this->cp_avatar_upload_failed = 'Het uploaden van uw avatar is mislukt. Het gegeven bestand bestaat misschien niet.';
		$this->cp_avatar_upload_not_image = 'U kunt alleen afbeeldingen gebruiken als avatar.';
		$this->cp_avatar_upload_too_large = 'De door jou gegeven avatar is te groot. Het maximum is %d kilobytes.';
		$this->cp_avatar_url = 'Upload Avatar vanaf een Internet lokatie (URL)';
		$this->cp_avatar_use = 'Selecteer een bestand op je computer';
		$this->cp_bday = 'Verjaardag:';
		$this->cp_been_updated = 'Uw profiel is gewijzigd.';
		$this->cp_been_updated1 = 'Uw avatar is gewijzigd.';
		$this->cp_been_updated_prefs = 'Uw instellingen zijn gewijzigd.';
		$this->cp_changing_pass = 'Verander je wachtwoord';
		$this->cp_contact_pm = 'Sta toe dat anderen je privé berichten sturen?';
		$this->cp_cp = 'Controlepaneel';
		$this->cp_current_avatar = 'Huidige avatar';
		$this->cp_current_time = 'Het is nu %s.';
		$this->cp_custom_title = 'Gebruik gebruikerstitel';
		$this->cp_custom_title2 = 'Dit is een privilege voorbehouden voor bestuur administrators.';
		$this->cp_dec = 'December'; //Translate
		$this->cp_editing_avatar = 'Verander uw avatar';
		$this->cp_editing_profile = 'Wijzigen van profiel';
		$this->cp_email = 'E-mail:';
		$this->cp_email_form = 'Anderen toestaan om e-mails naar jou te sturen.';
		$this->cp_email_invaid = 'Het opgegeven e-mailadres is ongeldig.';
		$this->cp_err_avatar = 'Er is een fout opgetreden tijdens het uploaden van uw avatar.';
		$this->cp_err_updating = 'Er is een fout opgetreden tijdens het updaten van uw profiel.';
		$this->cp_feb = 'Februari';
		$this->cp_file_type = 'De avatar die u heeft opgegeven is ongeldig. Controleer of u het adres goed heeft ingevoerd. Het mag alleen een .gif, .jpg of een .png bestand zijn.';
		$this->cp_format = 'Gebruikersnaam:';
		$this->cp_gtalk = 'GTalk Account'; //Translate
		$this->cp_header = 'Persoonlijke instellingen';
		$this->cp_height = 'Hoogte';
		$this->cp_icq = 'ICQ Nummer:';
		$this->cp_interest = 'Hobby:';
		$this->cp_jan = 'Januari';
		$this->cp_july = 'Juli';
		$this->cp_june = 'Juni';
		$this->cp_label_edit_avatar = 'Verander uw avatar';
		$this->cp_label_edit_pass = 'Verander uw wachtwoord';
		$this->cp_label_edit_prefs = 'Verander uw forum instellingen';
		$this->cp_label_edit_profile = 'Wijzig Profiel';
		$this->cp_label_edit_sig = 'Aanpassen van Signature';
		$this->cp_label_edit_subs = 'Wijzig Abonnement';
		$this->cp_language = 'Taal';
		$this->cp_less_charac = 'Uw gebruikersnaam mag niet meer dan 32 tekens bevatten.';
		$this->cp_location = 'Locatie:';
		$this->cp_login_first = 'U moet ingelogd zijn om toegang te krijgen tot uw instellingen.';
		$this->cp_mar = 'Maart';
		$this->cp_may = 'Mei';
		$this->cp_msn = 'MSN-adres:';
		$this->cp_must_orig = 'U gebruikersnaam moet identiek aan het origineel zijn. U mag alleen gewone letters veranderen naar hoofdletters en cijfers toevoegen.';
		$this->cp_new_notmatch = 'Het nieuwe wachtwoord dat u heeft opgegeven komt niet overeen.';
		$this->cp_new_pass = 'Nieuw wachtwoord';
		$this->cp_no_flash = 'Flash-avatars zijn niet toegestaan.';
		$this->cp_not_exist = 'De datum die u heeft ingevoerd: (%s) bestaat niet!';
		$this->cp_nov = 'November'; //Translate
		$this->cp_oct = 'Oktober';
		$this->cp_old_notmatch = 'Het oude wachtwoord dat u heeft ingegeven komt niet overeen met het wachtwoord in onze database.';
		$this->cp_old_pass = 'Oude wachtwoord';
		$this->cp_pass_notvaid = 'Uw wachtwoord is ongeldig. Zorg ervoor dat u alleen de toegestane leestekens zoals letters, nummers, verbindingsstreepjes, onderstreeptekens of spaties gebruikt.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = 'Verander je forum instellingen';
		$this->cp_preview_sig = 'Signature Preview:'; //Translate
		$this->cp_privacy = 'Privé Opties';
		$this->cp_repeat_pass = 'Herhaal het nieuwe wachtwoord';
		$this->cp_sept = 'September'; //Translate
		$this->cp_show_active = 'Toon uw activiteiten wanneer u het forum gebruikt?';
		$this->cp_show_email = 'E-mailadres laten zien in profiel?';
		$this->cp_signature = 'Handtekening:';
		$this->cp_size_max = 'De ingevoerde afmetingen voor uw avatar zijn te groot. De maximaal toegestane grootte is %s bij %s pixels.';
		$this->cp_skin = 'Uiterlijk Forum';
		$this->cp_sub_change = 'Wijzig Abonnement';
		$this->cp_sub_delete = 'Verwijder';
		$this->cp_sub_expire = 'Verloop datum';
		$this->cp_sub_name = 'Abonnement naam';
		$this->cp_sub_no_params = 'Er werden geen parameters ingegeven.';
		$this->cp_sub_success = 'Je bent nu geabonneerd op %s.';
		$this->cp_sub_type = 'Type Abonnement';
		$this->cp_sub_updated = 'De geselecteerde abonnementen zijn verwijderd.';
		$this->cp_topic_option = 'De opties van het onderwerp';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = 'Profiel is bijgewerkt';
		$this->cp_updated1 = 'Avatar is bijgewerkt';
		$this->cp_updated_prefs = 'Instellingen zijn bijgewerkt';
		$this->cp_user_exists = 'Er is al een gebruiker met deze naam geregistreerd.';
		$this->cp_valided = 'Uw wachtwoord is bevestigd en werd veranderd.';
		$this->cp_view_avatar = 'Laat Avatars zien?';
		$this->cp_view_emoticon = 'Laat smilies zien?';
		$this->cp_view_signature = 'Laat handtekening zien?';
		$this->cp_welcome = 'Welkom op je profiel. Hier kunt u uw account naar wens veranderen. Selecteer een van de bovenstaande opties.';
		$this->cp_width = 'Breedte';
		$this->cp_www = 'Homepage:';
		$this->cp_yahoo = 'Yahoo adres:';
		$this->cp_zone = 'Tijdszone';
	}

	function email()
	{
		$this->email_blocked = 'Deze gebruiker wil geen e-mail ontvangen.';
		$this->email_email = 'E-mail:';
		$this->email_msgtext = 'E-mail uiterlijk:';
		$this->email_no_fields = 'Ga terug en controleer of alle velden ingevuld zijn.';
		$this->email_no_member = 'Er is geen gebruiker gevonden met deze naam';
		$this->email_no_perm = 'U heeft geen toestemming om e-mails te sturen via dit forum.';
		$this->email_sent = 'U e-mail is verstuurd.';
		$this->email_subject = 'Onderwerp:';
		$this->email_to = 'Naar:';
	}

	function emot_control()
	{
		$this->emote = 'Emoticons'; //Translate
		$this->emote_add = 'Emoticons toevoegen';
		$this->emote_added = 'Emoticon toegevoegd.';
		$this->emote_clickable = 'Aanklikbaar';
		$this->emote_edit = 'Emoticons aanpassen';
		$this->emote_image = 'Afbeelding';
		$this->emote_install = 'Emoticons installeren';
		$this->emote_install_done = 'Emoticons zijn succesvol geinstalleerd';
		$this->emote_install_warning = ' Dit zal de bestaande emoticons wissen en geuploade emoticons van uw huidig geselecteerde skin naar de database importeren.';
		$this->emote_no_text = 'Er werd geen emoticons-tekst ingegeven';
		$this->emote_text = 'Tekst';
	}

	function forum()
	{
		$this->forum_by = 'Door';
		$this->forum_can_post = 'U kan reageren op de berichten in dit forum.';
		$this->forum_can_topics = 'U kan de onderwerpen in dit forum bekijken.';
		$this->forum_cant_post = 'U kan niet reageren op berichten in dit forum.';
		$this->forum_cant_topics = 'U kan geen onderwerpen in dit forum bekijken.';
		$this->forum_dot = 'punt';
		$this->forum_dot_detail = 'Laat uw bericht zien in dit onderwerp.';
		$this->forum_forum = 'Forum'; //Translate
		$this->forum_guest = 'Gast';
		$this->forum_hot = 'Hot item';
		$this->forum_icon = 'Berichten icoontje';
		$this->forum_jump = 'Ga naar het laatste bericht geplaatst in dit onderwerp.';
		$this->forum_last = 'Laatste bericht';
		$this->forum_locked = 'Gesloten';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = 'Verplaatst';
		$this->forum_msg = '%s bericht';
		$this->forum_new = 'Nieuw';
		$this->forum_new_poll = 'Creeër een stembus';
		$this->forum_new_topic = 'Start  een nieuw onderwerp op.';
		$this->forum_no_topics = 'Er zijn geen onderwerpen in dit forum om weer te geven.';
		$this->forum_noexist = 'Het gekozen forum bestaat niet.';
		$this->forum_nopost = 'Geen bericht';
		$this->forum_not = 'Niet';
		$this->forum_noview = 'U heeft geen rechten om de berichten in dit forum te bekijken.';
		$this->forum_pages = 'Pagina';
		$this->forum_pinned = 'Sticky';
		$this->forum_pinned_topic = 'Sticky onderwerp';
		$this->forum_poll = 'Stembus';
		$this->forum_regfirst = 'U heeft geen toestemming om het forum te bekijken. Als u je nu registreert, kunt u dit wel.';
		$this->forum_replies = 'Antwoord';
		$this->forum_starter = 'Auteur';
		$this->forum_sub = 'Sub-forum';
		$this->forum_sub_last_post = 'Laatste bericht';
		$this->forum_sub_replies = 'Antwoorden';
		$this->forum_sub_topics = 'Onderwerpen';
		$this->forum_subscribe = 'Stuur mij een e-mail als er berichten geplaatst zijn in dit onderwerp';
		$this->forum_topic = 'Onderwerp';
		$this->forum_views = 'Bekeken';
		$this->forum_write_topics = 'U kan onderwerpen aanmaken in dit forum.';
	}

	function forums()
	{
		$this->forum_controls = 'Forum instellingen';
		$this->forum_create = 'Maak een forum aan.';
		$this->forum_create_cat = 'Maak een Categorie aan.';
		$this->forum_created = 'Forum aangemaakt.';
		$this->forum_default_perms = 'Standaard toestemmingen';
		$this->forum_delete = 'Forum verwijderen';
		$this->forum_delete_warning = 'Bent u zeker dat u dit forum, zijn onderwerpen en zijn antwoorden wilt verwijderen?<br /> Deze actie kan niet ingetrokken worden.';
		$this->forum_deleted = 'Het forum is verwijderd.';
		$this->forum_description = 'Beschrijving';
		$this->forum_edit = 'Pas het forum aan';
		$this->forum_edited = 'Het forum is succesvol aangepast.';
		$this->forum_empty = 'Er werd geen forumnaam ingevoerd. Ga terug en voer een naam in.';
		$this->forum_is_subcat = 'Dit forum is alleen maar een subcategorie.';
		$this->forum_name = 'Naam';
		$this->forum_no_orphans = 'U kan geen forum losmaken door het moederforum te verwijderen.';
		$this->forum_none = 'Er kunnen geen forums gemanipuleert worden.';
		$this->forum_ordered = 'De forumstijl is geupdated.';
		$this->forum_ordering = 'Verander de forumstijl';
		$this->forum_parent = 'Hierdoor kan je geen moederforum veranderen. ';
		$this->forum_parent_cat = 'Moederforum categorie';
		$this->forum_quickperm_select = 'Selecteer een bestaand forum om zijn toelatingen te koppieren.';
		$this->forum_quickperms = 'Snelle toelatingen';
		$this->forum_recount = 'Tel de onderwerpen en antwoorden opnieuw';
		$this->forum_select_cat = 'Selecteer een bestaande categorie om een forum te maken.';
		$this->forum_subcat = 'Subcategorie';
	}

	function groups()
	{
		$this->groups_bad_format = 'You must use %s in the format, which represents the group name.'; //Translate
		$this->groups_based_on = 'Gebaseerd op ';
		$this->groups_create = 'Maak een groep aan.';
		$this->groups_create_new = 'Maak een nieuwe gebruikersgroep aan genaamd';
		$this->groups_created = 'Nieuwe groep aangemaakt.';
		$this->groups_delete = 'Verwijder de groep.';
		$this->groups_deleted = 'Groep verwijderd.';
		$this->groups_edit = 'Pas de groep aan.';
		$this->groups_edited = 'Groep aangepast.';
		$this->groups_formatting = 'Vertoon formatering';
		$this->groups_i_confirm = 'Ik bevestig dat ik deze gebruikersgroep wil verwijderen.';
		$this->groups_name = 'Naam';
		$this->groups_no_action = 'Er werd geen actie ondernomen.';
		$this->groups_no_delete = 'Er zijn geen vaste groepen om te verwijderen.<br /> De hoofdgroepen zijn noodzakelijk voor de Quicksilver Forums om te kunnen functioneren.';
		$this->groups_no_group = 'Er werd geen groep gespecifieert.';
		$this->groups_no_name = 'Er werd geen groepsnaam ingegeven.';
		$this->groups_only_custom = 'Note: Je kan alleen vaste gebruikersgroepen verwijderen. De hoofdgroepen zijn noodzakelijk voor de Quicksilver Forums om te kunnen functioneren.';
		$this->groups_the = 'De groep';
		$this->groups_to_edit = 'Groepen die aangepast worden';
		$this->groups_type = 'Type van groep';
		$this->groups_will_be = 'zal verwijderd worden.';
		$this->groups_will_become = 'Gebruikers van de verwijderde groep zullen';
	}

	function help()
	{
		$this->help_add = 'Voeg een hulpartikel toe.';
		$this->help_article = 'Hulpartikel opties';
		$this->help_available_files = 'Beschikbare hulp onderwerpen';
		$this->help_confirm = 'Bent u zeker dat u hetvolgende wilt verwijderen?';
		$this->help_content = 'Inhoud van het artikel';
		$this->help_delete = 'Verwijder het hulpartikel';
		$this->help_deleted = 'Het hulpartikel is verwijderd.';
		$this->help_edit = 'Pas het hulpartikel aan';
		$this->help_edited = ' Het hulpartikel is geupdated.';
		$this->help_inserted = ' Artikel aan de database toegevoegd.';
		$this->help_no_articles = 'Er werden geen hulpartikels in de database gevonden.';
		$this->help_no_title = 'U kan geen hulpartikel maken zonder er een titel aan te geven.';
		$this->help_none = 'Er zijn geen help onderwerpen in de database';
		$this->help_not_exist = 'Dat hulpartikel bestaat niet.';
		$this->help_select = 'Selecteer een hulpartikel om het aan te passen';
		$this->help_select_delete = 'Selecteer een hulpartikel om het te verwijderen';
		$this->help_title = 'Titel';
	}

	function home()
	{
		$this->home_choose = 'Selecteer een taak om te beginnen.';
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
		$this->login_cant_logged = 'U kon niet worden ingelogd. Controleer uw gebruikersnaam en wachtwoord.<br /><br />Ze zijn hoofdletter gevoelig, dus \'GeBrUiKeRsNaAm\' is anders dan \'Gebruikersnaam\'. Bent u er zeker van dat de cookies zijn ingeschakeld in uw browser.';
		$this->login_cookies = 'Uw browser moet cookies accepteren om te kunnen inloggen.';
		$this->login_forgot_pass = 'Wachtwoord vergeten?';
		$this->login_header = 'Inloggen';
		$this->login_logged = 'U bent nu ingelogd.';
		$this->login_now_out = 'U bent nu uitgelogd.';
		$this->login_out = 'Uitloggen';
		$this->login_pass = 'Wachtwoord';
		$this->login_pass_no_id = 'Er bestaat hier geen gebruiker met de door u opgegeven gebruikersnaam.';
		$this->login_pass_request = 'Om het resetten van uw wachtwoord te voltooien, moet u op de link klikken in de naar u verzonden email.';
		$this->login_pass_reset = 'Zet wachtwoord terug';
		$this->login_pass_sent = 'Uw wachtwoord is gereset. Het nieuwe wachtwoord is verzonden naar het e-mailadres dat verbonden is aan uw gebruikersnaam.';
		$this->login_sure = 'Bent u zeker dat u wilt uitloggen in \'%s\'?';
		$this->login_user = 'Gebruikersnaam';
	}

	function logs()
	{
		$this->logs_action = 'Actie';
		$this->logs_deleted_post = 'U heeft een antwoord verwijderd.';
		$this->logs_deleted_topic = 'Onderwep verwijderd';
		$this->logs_edited_post = 'Antwoord aangepast';
		$this->logs_edited_topic = 'Onderwep aangepast';
		$this->logs_id = 'IDs'; //Translate
		$this->logs_locked_topic = 'Onderwerp gesloten';
		$this->logs_moved_from = 'van forum';
		$this->logs_moved_to = 'naar forum';
		$this->logs_moved_topic = 'Onderwerp verplaatst';
		$this->logs_moved_topic_num = 'Onderwerp # verplaatst';
		$this->logs_pinned_topic = 'Een onderwerp sticky gemaakt';
		$this->logs_post = 'Antwoord';
		$this->logs_time = 'Tijd';
		$this->logs_topic = 'Onderwerp';
		$this->logs_unlocked_topic = 'Een topic heropend';
		$this->logs_unpinned_topic = 'Een onderwerp van sticky verwijderd';
		$this->logs_user = 'Gebruiker';
		$this->logs_view = 'Bekijk de moderator acties';
	}

	function main()
	{
		$this->main_activate = 'Uw account is nog niet geactiveerd.';
		$this->main_activate_resend = 'Verstuur activatie e-mail opnieuw';
		$this->main_admincp = 'Beheerder instellingen';
		$this->main_banned = 'U bent geblokkeerd op dit forum.';
		$this->main_code = 'Code'; //Translate
		$this->main_cp = 'Instellingen';
		$this->main_full = 'Vol';
		$this->main_help = 'Help'; //Translate
		$this->main_load = 'Laad';
		$this->main_login = 'Log in';
		$this->main_logout = 'Log uit';
		$this->main_mark = 'Markeer alles';
		$this->main_mark1 = 'Markeer alle forums als gelezen';
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = 'Onze excuses, maar %s is nu niet beschikbaar wegens een te groot aantal ingelogde gebruikers.';
		$this->main_members = 'Gebruikers';
		$this->main_messenger = 'Privé berichten';
		$this->main_new = 'Nieuw';
		$this->main_next = 'Volgende';
		$this->main_prev = 'Vorige';
		$this->main_queries = 'Wachtrijen';
		$this->main_quote = 'Citaat';
		$this->main_recent = 'Recente berichten';
		$this->main_recent1 = 'Bekijk alle berichten na u laatste aanmelding.';
		$this->main_register = 'Registreren';
		$this->main_reminder = 'Attentie';
		$this->main_reminder_closed = 'Het forum is gesloten en alleen te zien door beheerders.';
		$this->main_said = 'Schreef';
		$this->main_search = 'Zoeken';
		$this->main_topics_new = 'Er zijn nieuwe berichten in dit forum.';
		$this->main_topics_old = 'Er zijn geen nieuwe berichten in dit forum.';
		$this->main_welcome = 'Welkom';
		$this->main_welcome_guest = 'Welkom gast!';
	}

	function mass_mail()
	{
		$this->mail = 'Mass Mail'; //Translate
		$this->mail_announce = 'Aankondiging van';
		$this->mail_groups = 'Ontvangende groepen';
		$this->mail_members = 'Gebruikers.';
		$this->mail_message = 'Bericht';
		$this->mail_select_all = 'Selecteer iedereen';
		$this->mail_send = 'Verstuur het bericht';
		$this->mail_sent = 'U bericht is verstuurt naar';
	}

	function member_control()
	{
		$this->mc = 'Gebruikersopties';
		$this->mc_confirm = 'Bent u zeker dat u # wilt verwijderen?';
		$this->mc_delete = 'Verwijder gebruiker';
		$this->mc_deleted = 'Gebruiker is verwijderd.';
		$this->mc_edit = 'Pas gebruiker aan';
		$this->mc_edited = 'Gebruiker geupdatet';
		$this->mc_email_invaid = 'Het door u opgegeven email adres is onjuist.';
		$this->mc_err_updating = 'Fout tijdens het upgraden van uw profiel.';
		$this->mc_find = 'Zoek gebruikers waarin hetvolgende voorkomt:';
		$this->mc_found = 'De volgende gebruikers werden gevonden. Selecteer er een van.';
		$this->mc_guest_needed = 'Het gastenaccount is noodzakelijk voor Quicksilver Forums om te kunnen functioneren.';
		$this->mc_not_found = 'Er werden geen gebruikers teruggevonden met de gegevens';
		$this->mc_user_aim = 'AIM Naam';
		$this->mc_user_avatar = 'Avatar'; //Translate
		$this->mc_user_avatar_height = 'Hoogte Avatar';
		$this->mc_user_avatar_type = 'Type Avatar';
		$this->mc_user_avatar_width = 'Breedte Avatar';
		$this->mc_user_birthday = 'Verjaardag';
		$this->mc_user_email = 'E-mail adres';
		$this->mc_user_email_show = 'E-mail is zichtbaar voor andere gebruikers';
		$this->mc_user_group = 'Groep';
		$this->mc_user_gtalk = 'GTalk Account'; //Translate
		$this->mc_user_homepage = 'Homepage'; //Translate
		$this->mc_user_icq = 'ICQ Nummer';
		$this->mc_user_id = 'Gebruiker\'s ID';
		$this->mc_user_interests = 'Intresses';
		$this->mc_user_joined = 'Gebruiker sinds';
		$this->mc_user_language = 'Taal';
		$this->mc_user_lastpost = 'Laaste Bericht';
		$this->mc_user_lastvisit = 'Laatst bekeken';
		$this->mc_user_level = 'Level'; //Translate
		$this->mc_user_location = 'Woonplaats';
		$this->mc_user_msn = 'MSN Messenger';
		$this->mc_user_name = 'Naam';
		$this->mc_user_pm = 'Accepteer privé berichten';
		$this->mc_user_posts = 'Berichten';
		$this->mc_user_signature = 'Handtekening';
		$this->mc_user_skin = 'Skin'; //Translate
		$this->mc_user_timezone = 'Tijdszone';
		$this->mc_user_title = 'Gebruikerstitel';
		$this->mc_user_title_custom = 'Gebruik een vaste gebruikerstitel';
		$this->mc_user_view_avatars = 'Avatars aan het bekijken';
		$this->mc_user_view_emoticons = 'Emoticons aan het bekijken';
		$this->mc_user_view_signatures = 'Handtekeningen aan het bekijken';
		$this->mc_user_yahoo = 'Yahoo Messenger';
	}

	function membercount()
	{
		$this->mcount = 'Herstel de gebruikersstatistieken';
		$this->mcount_updated = 'Gebruikersaantal geupdatet';
	}

	function members()
	{
		$this->members_all = 'Alles';
		$this->members_email = 'E-mail:';
		$this->members_email_member = 'Stuur E-mail naar deze gebruiker';
		$this->members_group = 'Groep';
		$this->members_joined = 'Lid sinds';
		$this->members_list = 'Gebruikerslijst';
		$this->members_member = 'gebruiker';
		$this->members_pm = 'PB';
		$this->members_posts = 'Antwoorden';
		$this->members_send_pm = 'Stuur deze gebruiker een PB';
		$this->members_title = 'Titel';
		$this->members_vist_www = 'Bezoek de website van deze gebruiker';
		$this->members_www = 'Website:';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Weet u zeker dat u dit bericht wil verwijderen?';
		$this->mod_confirm_topic_delete = 'Weet u zeker dat u dit onderwerp wil verwijderen?';
		$this->mod_error_first_post = 'Je kan het eerste bericht in een onderwerp niet verwijderen.';
		$this->mod_error_move_category = 'Je kan een onderwerp niet verplaatsen naar een categorie';
		$this->mod_error_move_create = 'Je hebt geen toestemming om de topics naar dat forum te verplaatsen.';
		$this->mod_error_move_forum = 'Je kan een onderwerp niet verplaatsen naar een forum dat niet bestaat.';
		$this->mod_error_move_global = 'You cannot move a global topic. Edit the topic before moving it.'; //Translate
		$this->mod_error_move_same = 'Je kan een onderwerp niet verplaatsen naar het forum waar het al staat.';
		$this->mod_label_controls = 'Moderator Beheer';
		$this->mod_label_description = 'Omschrijving';
		$this->mod_label_emoticon = 'Smilies omzetten naar afbeeldingen?';
		$this->mod_label_global = 'Globaal Onderwerp';
		$this->mod_label_mbcode = 'Formaat MbCode?';
		$this->mod_label_move_to = 'Verplaats naar';
		$this->mod_label_options = 'Opties';
		$this->mod_label_post_delete = 'Verwijder bericht';
		$this->mod_label_post_edit = 'Bewerk bericht';
		$this->mod_label_post_icon = 'Post Icon'; //Translate
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = 'Titel';
		$this->mod_label_title_original = 'Oorspronkelijke Titel';
		$this->mod_label_title_split = 'Gespleten Titel';
		$this->mod_label_topic_delete = 'Verwijder onderwerp';
		$this->mod_label_topic_edit = 'Bewerk onderwerp';
		$this->mod_label_topic_lock = 'Sluit onderwerp';
		$this->mod_label_topic_move = 'Verplaats onderwerp';
		$this->mod_label_topic_move_complete = 'Breng het onderwerp volledig over naar het nieuwe forum';
		$this->mod_label_topic_move_link = 'Breng het onderwerp naar het nieuwe forum over, en laat een link in zijn nieuwe plaats in het oude forum.';
		$this->mod_label_topic_pin = 'Zet onderwerp vast';
		$this->mod_label_topic_split = 'Gespleten Onderwerp';
		$this->mod_missing_post = 'Het bericht dat je omschreef kan niet worden gevonden.';
		$this->mod_missing_topic = 'Het onderwerp dat je omschreef kan niet worden gevonden.';
		$this->mod_no_action = 'Je moet een actie kiezen.';
		$this->mod_no_post = 'Je moet een bericht specificeren.';
		$this->mod_no_topic = 'Je moet een onderwerp specificeren.';
		$this->mod_perm_post_delete = 'Je hebt geen toestemming om dit bericht te verwijderen.';
		$this->mod_perm_post_edit = 'Je hebt geen toestemming om dit bericht te bewerken.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = 'Je hebt geen toestemming om dit onderwerp te verwijderen.';
		$this->mod_perm_topic_edit = 'Je hebt geen toestemming om dit onderwerp te bewerken.';
		$this->mod_perm_topic_lock = 'Je hebt geen toestemming om dit onderwerp te sluiten.';
		$this->mod_perm_topic_move = 'Je hebt geen toestemming om dit onderwerp te verplaatsen.';
		$this->mod_perm_topic_pin = 'Je hebt geen toestemming om dit onderwerp vast te zetten.';
		$this->mod_perm_topic_split = 'Je hebt geen toestemming om dit onderwerp te verdelen.';
		$this->mod_perm_topic_unlock = 'Je hebt geen toestemming om dit onderwerp te openen.';
		$this->mod_perm_topic_unpin = 'Je hebt geen toestemming om dit onderwerp los te zetten.';
		$this->mod_success_post_delete = 'Het bericht is verwijderd.';
		$this->mod_success_post_edit = 'Bericht gewijzigd';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = 'Het onderwerp is met succes opgedeeld.';
		$this->mod_success_topic_delete = 'Onderwerp verwijderd.';
		$this->mod_success_topic_edit = 'Het onderwerp is succesvol gewijzigd.';
		$this->mod_success_topic_move = 'Het onderwerp is succesvol verplaatst.';
		$this->mod_success_unpublish = 'This topic has been removed from the published list.'; //Translate
	}

	function optimize()
	{
		$this->optimize = 'Optimaliseer de Database';
		$this->optimized = 'De tables in de database zijn geoptimaliseerd voor maximunprestaties.';
	}

	function perms()
	{
		$this->perm = 'Toelating';
		$this->perms = 'Toelatingen';
		$this->perms_board_view = 'Bekijk de board index';
		$this->perms_board_view_closed = 'Gebruik Quicksilver Forums wanneer het gesloten is.';
		$this->perms_do_anything = 'Gebruik Quicksilver Forums';
		$this->perms_edit_for = 'Pas toelatingen aan voor';
		$this->perms_email_use = 'Verstuur e-mails naar andere gebruikers via het board';
		$this->perms_forum_view = 'Bekijk het forum';
		$this->perms_is_admin = 'Verschaf toegang tot het administrators controlepaneel';
		$this->perms_only_user = 'Gebruik alleen groepstoelatingen voor deze gebruiker';
		$this->perms_override_user = 'This will override the group permissions for this user.'; //Translate
		$this->perms_pm_noflood = 'Stel vrij van persoonlijke bericht flood controle';
		$this->perms_poll_create = 'Start een poll op';
		$this->perms_poll_vote = 'Creeër stemmen';
		$this->perms_post_attach = 'Maak uploads vast aan berichten';
		$this->perms_post_attach_download = 'Download bericht attachments';
		$this->perms_post_create = 'Nieuw antwoord';
		$this->perms_post_delete = 'Verwijder alle berichten';
		$this->perms_post_delete_own = 'Verwijder alleen berichten die de gebruiker gemaakt heeft';
		$this->perms_post_edit = 'Pas eender welk bericht aan';
		$this->perms_post_edit_own = 'Pas enkel berichten aan die de oprichter gemaakt heeft';
		$this->perms_post_inc_userposts = 'Posts contribute to user\'s total post count'; //Translate
		$this->perms_post_noflood = 'STel vrij van berichten flood controle';
		$this->perms_post_viewip = 'Bekijk de gebruiker zijn IP adressen';
		$this->perms_search_noflood = 'Stel vrij van zoek flood controle';
		$this->perms_title = 'Gebruikersgroep controlepaneel';
		$this->perms_topic_create = 'Start Onderwerpen op';
		$this->perms_topic_delete = 'Verwijder elk onderwerp';
		$this->perms_topic_delete_own = 'erwijder alleen berichten die de gebruiker gemaakt heeft';
		$this->perms_topic_edit = 'Pas elk onderwerp aan';
		$this->perms_topic_edit_own = 'Pas enkel onderwerpen aan dat de opstichter aangemaakt heeft';
		$this->perms_topic_global = 'Maak een onderwerp zichtbaar voor alle forums';
		$this->perms_topic_lock = 'Doe elk onderwerp op slot';
		$this->perms_topic_lock_own = 'Sluit alle onderwerpen die de opstichter aangemaakt heeft';
		$this->perms_topic_move = 'Verplaats elk onderwerp';
		$this->perms_topic_move_own = 'Verplaats enkel onderwerpen die de opstichter aangemaakt heeft';
		$this->perms_topic_pin = 'Maak elk onderwerp als sticky';
		$this->perms_topic_pin_own = 'Maak elk onderwerp, dat de opstichter heeft gemaakt, als sticky';
		$this->perms_topic_publish = 'Publish or unpublish any topic'; //Translate
		$this->perms_topic_publish_auto = 'New topics are marked as published'; //Translate
		$this->perms_topic_split = 'Verander alle onderwerpen in verschillende nieuwe onderwerpen';
		$this->perms_topic_split_own = 'Verander alle onderwerpen die de opstichter heeft aangemaakt in nieuwe onderwerpen';
		$this->perms_topic_unlock = 'Unlock elk onderwerp';
		$this->perms_topic_unlock_mod = 'Unlock een moderators slotje';
		$this->perms_topic_unlock_own = 'Unlock  alleen onderwerpen die de opstichter opgestart heeft';
		$this->perms_topic_unpin = 'Verwijder sticky van alle onderwerpen';
		$this->perms_topic_unpin_own = 'Verwijder sticky van de onderwerpen die de opstichter aangemaakt heeft.';
		$this->perms_topic_view = 'Bekijk onderwerpen';
		$this->perms_topic_view_unpublished = 'View unpublished topics'; //Translate
		$this->perms_updated = 'Toelatingen zijn geupdate.';
		$this->perms_user_inherit = 'De opstichter zal de groepstoelatingen erven.';
	}

	function php_info()
	{
		$this->php_error = 'Foutmelding';
		$this->php_error_msg = 'phpinfo() kan niet uitgevoerd worden. Uw host heeft deze eigenschap onbruikbaar gemaakt.';
	}

	function pm()
	{
		$this->pm_avatar = 'Avatar'; //Translate
		$this->pm_cant_del = 'Je hebt geen rechten om dit bericht te verwijderen';
		$this->pm_delallmsg = 'Verwijder alle berichten';
		$this->pm_delete = 'Verwijder';
		$this->pm_delete_selected = 'Verwijder de geselecteerde berichten';
		$this->pm_deleted = 'Bericht verwijderd.';
		$this->pm_deleted_all = 'Berichten verwijderd.';
		$this->pm_error = 'Er waren problemen met het versturen van je bericht naar sommige ontvangers.<br /><br />De volgende gebruikers bestaan niet: %s<br /><br />The volgende gebruikers accepteren persoonlijke berichten niet: %s';
		$this->pm_fields = 'Je bericht kon niet worden verstuurd, zorg ervoor dat alle velden ingevuld zijn.';
		$this->pm_flood = 'Je hebt al een bericht geplaatst in de laatste %s seconden.<br /><br />Probeer het in enkele seconden nog eens.';
		$this->pm_folder_inbox = 'Postvak In';
		$this->pm_folder_new = '%s nieuw';
		$this->pm_folder_sentbox = 'Verstuurd';
		$this->pm_from = 'Van';
		$this->pm_group = 'Groep';
		$this->pm_guest = 'Als gast, kunt u geen privé berichten versturen. Login of Registreer, aub.';
		$this->pm_joined = 'Lid sinds';
		$this->pm_messenger = 'Privé berichten';
		$this->pm_msgtext = 'Bericht:';
		$this->pm_multiple = 'Scheid verschillende ontvangers met een ;';
		$this->pm_no_folder = 'U moet een map kiezen.';
		$this->pm_no_member = 'Er is geen gebruiker met dat id gevonden.';
		$this->pm_no_number = 'er is geen bericht gevonden met dat nummer';
		$this->pm_no_title = 'Geen onderwerp';
		$this->pm_nomsg = 'Er zijn geen berichten in je Postvak In';
		$this->pm_noview = 'Je hebt geen rechten om dit bericht te bekijken';
		$this->pm_offline = 'Deze gebruiker is momenteel offline';
		$this->pm_online = 'Deze gebruiker is momenteel online';
		$this->pm_personal = 'Persoonlijke messenger';
		$this->pm_personal_msging = 'PB sturen';
		$this->pm_pm = 'PB';
		$this->pm_posts = 'Antwoorden';
		$this->pm_preview = 'Voorbeeld';
		$this->pm_recipients = 'Ontvangers';
		$this->pm_reply = 'Beantwoord';
		$this->pm_send = 'Verstuur';
		$this->pm_sendamsg = 'Stuur een bericht';
		$this->pm_sendingpm = 'Stuur een PB';
		$this->pm_sendon = 'Verstuurd op';
		$this->pm_success = 'Je privé bericht is met succes verstuurd';
		$this->pm_sure_del = 'Weet je zeker dat u dit bericht wilt verwijderen?';
		$this->pm_sure_delall = 'Weet je zeker dat je alle berichten wilt verwijderen in deze map??';
		$this->pm_title = 'Titel:';
		$this->pm_to = 'Aan:';
	}

	function post()
	{
		$this->post_attach = 'Bijlagen';
		$this->post_attach_add = 'Bijlage toevoegen';
		$this->post_attach_disrupt = 'Het toevoegen of verwijderen van bijlagen zal je bericht niet verstoren.';
		$this->post_attach_failed = 'Het uploaden van de bijlage is mislukt. Het bestand bestaat misschien niet.';
		$this->post_attach_not_allowed = 'Je kunt dit type bestand niet als bijlage toevoegen.';
		$this->post_attach_remove = 'Bijlage verwijderen';
		$this->post_attach_too_large = 'Het bestand is te groot. De maximum grootte is %d KB.';
		$this->post_cant_create = 'Als gast, hebt je geen toestemming om onderwerpen tot stand te brengen. Als je je registreert, kun je je onderwerp plaatsen.';
		$this->post_cant_create1 = 'Je hebt geen rechten om een onderwerp aan te maken.';
		$this->post_cant_enter = 'Je stem kon niet worden verwerkt, of je hebt al gestemd of je heeft geen rechten om te stemmen';
		$this->post_cant_poll = 'Als gast, heb je geen toestemming om een stembus te plaatsen. Als je je registreert, kun je je stembus plaatsen.';
		$this->post_cant_poll1 = 'Je hebt geen rechten om een stembus aan te maken.';
		$this->post_cant_reply = 'Je hebt geen rechten om te reageren op dit onderwerp';
		$this->post_cant_reply1 = 'Als gast, heb je geen toestemming om op onderwerpen te antwoorden. Als u registreert, kunt u berichten plaatsen.';
		$this->post_cant_reply2 = 'Je hebt geen rechten om op onderwerpen te reageren';
		$this->post_closed = 'Dit onderwerp is gesloten';
		$this->post_create_poll = 'Maak een stembus';
		$this->post_create_topic = 'Maak onderwerp';
		$this->post_creating = 'Maak onderwerp';
		$this->post_creating_poll = 'Creeër stembus';
		$this->post_flood = 'Je hebt een bericht geplaatst in de afgelopen %s seconden, en je kunt op dit ogenblik geen bericht plaatsen<br /><br />probeer aub nog eens over een paar seconden.';
		$this->post_guest = 'Gast';
		$this->post_icon = 'Bericht Icoontje';
		$this->post_last_five = 'Laatste 5 berichten in omgekeerde volgorde';
		$this->post_length = 'Controleer lengte';
		$this->post_msg = 'Bericht';
		$this->post_must_msg = 'Je moet een bericht ingeven als je deze wilt plaatsen.';
		$this->post_must_options = 'Je moet de opties ingeven bij het maken van een nieuwe stembus.';
		$this->post_must_title = 'Je moet een titel ingeven bij het maken van een nieuw onderwerp.';
		$this->post_new_poll = 'Nieuwe stembus';
		$this->post_new_topic = 'Nieuw onderwerp';
		$this->post_no_forum = 'Het betreffende forum kon niet gevonden worden.';
		$this->post_no_topic = 'Er werd geen onderwerp gespecificeerd.';
		$this->post_no_vote = 'Je moet een keuze maken om te stemmen.';
		$this->post_option_emoticons = 'Zet smilies om naar plaatjes';
		$this->post_option_global = 'Maak dit onderwerp globaal?';
		$this->post_option_mbcode = 'formaat MbCode?';
		$this->post_optional = 'Opties';
		$this->post_options = 'Opties';
		$this->post_poll_options = 'stembus Opties';
		$this->post_poll_row = 'Een per rij';
		$this->post_posted = 'Geplaatst op';
		$this->post_posting = 'Plaats';
		$this->post_preview = 'Voorbeeld';
		$this->post_reply = 'Beantwoorden';
		$this->post_reply_topic = 'Antwoord op onderwerp';
		$this->post_replying = 'Reageer op onderwerp';
		$this->post_replying1 = 'Reageer';
		$this->post_too_many_options = 'Je moet tussen de 2 en %d keuzemogelijkheden aanmaken bij een stembus.';
		$this->post_topic_detail = 'Beschrijving van onderwerp';
		$this->post_topic_title = 'Titel van onderwerp';
		$this->post_view_topic = 'Bekijk gehele onderwerp';
		$this->post_voting = 'Stemmen';
	}

	function printer()
	{
		$this->printer_back = 'Terug';
		$this->printer_not_found = 'Het onderwerp kon niet worden gevonden.het kan zijn dat het is verwijderd, verplaatst of nooit bestaan heeft';
		$this->printer_not_found_title = 'Onderwerp niet gevonden';
		$this->printer_perm_topics = 'Je hebt geen rechten om de onderwerpen te bekijken.';
		$this->printer_perm_topics_guest = 'Je hebt geen toestemming om onderwerpen te bekijken. Als je je registreert, kun je hem wel bekijken.';
		$this->printer_posted_on = 'Geplaatst op';
		$this->printer_send = 'Stuur naar printer';
	}

	function profile()
	{
		$this->profile_aim_sn = 'AIM:';
		$this->profile_av_sign = 'Avatar and handtekening';
		$this->profile_avatar = 'Avatar'; //Translate
		$this->profile_bday = 'Verjaardag:';
		$this->profile_contact = 'Contact'; //Translate
		$this->profile_email_address = 'E-mail:';
		$this->profile_fav = 'Favoriete forum:';
		$this->profile_fav_forum = '%s (%d%% van de berichten van deze gebruiker)';
		$this->profile_gtalk = 'GTalk Account'; //Translate
		$this->profile_icq_uin = 'ICQ:';
		$this->profile_info = 'Informatie';
		$this->profile_interest = 'Wat ik kwijt wil:';
		$this->profile_joined = 'Aangemeld';
		$this->profile_last_post = 'Laatste bericht';
		$this->profile_list = 'Gebruikers Lijst';
		$this->profile_location = 'Locatie:';
		$this->profile_member = 'Groep:';
		$this->profile_member_title = 'Titel:';
		$this->profile_msn = 'MSN:';
		$this->profile_must_user = 'Je moet een gebruiker invullen voordat je een profiel kunt bekijken.';
		$this->profile_no_member = 'Er is geen gebruiker met dit ID. Het kan zijn dat zijn account verwijderd is.';
		$this->profile_none = '[ Geen ]';
		$this->profile_not_post = 'Heeft nog niets geplaatst.';
		$this->profile_offline = 'Deze gebruiker is momenteel offline';
		$this->profile_online = 'Deze gebruiker is momenteel online';
		$this->profile_pm = 'Privé Berichten';
		$this->profile_postcount = '%s totaal, %s per dag';
		$this->profile_posts = 'Berichten:';
		$this->profile_private = '[ Prive ]';
		$this->profile_profile = 'Profiel';
		$this->profile_signature = 'Handtekening:';
		$this->profile_unkown = '[ Onbekend ]';
		$this->profile_view_profile = 'Bekijk Profiel van';
		$this->profile_www = 'Homepage:';
		$this->profile_yahoo = 'Yahoo:';
	}

	function prune()
	{
		$this->prune_action = 'Prune action to take'; //Translate
		$this->prune_age_day = '1 Dag';
		$this->prune_age_eighthours = '8 Uren';
		$this->prune_age_hour = '1 Uur';
		$this->prune_age_month = '1 Maand';
		$this->prune_age_threemonths = '3 Maanden';
		$this->prune_age_week = '1 Week'; //Translate
		$this->prune_age_year = '1 Jaar';
		$this->prune_forums = 'Select forums to prune'; //Translate
		$this->prune_invalidage = 'Invalid age specified for pruning'; //Translate
		$this->prune_move = 'Verplaats';
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
		$this->query = 'Vraagkoppeling';
		$this->query_fail = 'Mislukt.';
		$this->query_success = 'Succesvol uitgevoerd.';
		$this->query_your = 'Uw vraag';
	}

	function recent()
	{
		$this->recent_active = 'Actieve onderwerpen na uw laatste bezoek.';
		$this->recent_by = 'Door';
		$this->recent_can_post = 'Je kunt reageren op de berichten in dit forum.';
		$this->recent_can_topics = 'Je kunt de onderwerpen in dit forum bekijken.';
		$this->recent_cant_post = 'Je kunt niet reageren op berichten in dit forum.';
		$this->recent_cant_topics = 'Je kunt geen onderwerpen in dit forum bekijken.';
		$this->recent_dot = 'punt';
		$this->recent_dot_detail = 'Laat je bericht zien in dit onderwerp';
		$this->recent_forum = 'Forum'; //Translate
		$this->recent_guest = 'Gast';
		$this->recent_hot = 'Hot item';
		$this->recent_icon = 'Berichten icoontje';
		$this->recent_jump = 'Ga naar het laatste bericht van dit onderwerp';
		$this->recent_last = 'Laatste bericht';
		$this->recent_locked = 'Gesloten';
		$this->recent_moved = 'Verplaatst';
		$this->recent_msg = '%s bericht';
		$this->recent_new = 'Nieuw';
		$this->recent_new_poll = 'Creeër een stembus';
		$this->recent_new_topic = 'Start nieuw onderwerp';
		$this->recent_no_topics = 'Er zijn geen onderwerpen om weer te geven op dit forum.';
		$this->recent_noexist = 'Het gekozen forum bestaat niet.';
		$this->recent_nopost = 'Geen bericht';
		$this->recent_not = 'Niet';
		$this->recent_noview = 'Je hebt geen rechten de berichten op dit forum te bekijken.';
		$this->recent_pages = 'Pagina';
		$this->recent_pinned = 'Sticky';
		$this->recent_pinned_topic = 'Sticky onderwerp';
		$this->recent_poll = 'Stembus';
		$this->recent_regfirst = 'Je hebt geen toestemming om het forum te bekijken. Als je je registreert, kunt je dit wel.';
		$this->recent_replies = 'Antwoord';
		$this->recent_starter = 'Auteur';
		$this->recent_sub = 'Sub-forum';
		$this->recent_sub_last_post = 'Laatste bericht';
		$this->recent_sub_replies = 'Antwoorden';
		$this->recent_sub_topics = 'Onderwerpen';
		$this->recent_subscribe = 'Stuur een e-mail als er berichten geplaatst zijn in dit onderwerp';
		$this->recent_topic = 'Onderwerp';
		$this->recent_views = 'Bekeken';
		$this->recent_write_topics = 'Je kan onderwerpen aanmaken in dit forum.';
	}

	function register()
	{
		$this->register_activated = 'Je aanmelding is voltooid!';
		$this->register_activating = 'Account activatie';
		$this->register_activation_error = 'Er was een fout geconstateerd tijdens het activeren van je registratie. Kijk in je browser na of er het hele adres uit je activatie e-mail staat. Mocht dit probleem zich voor blijven doen, neem dan contact op met de beheerder van dit forum om het mailtje opnieuw gestuurd te krijgen.';
		$this->register_confirm_passwd = 'Bevestig wachtwoord';
		$this->register_done = 'Je bent geregistreerd! Je kunt nu inloggen.';
		$this->register_email = 'E-mail';
		$this->register_email_invalid = 'Je hebt een ongeldig E-mail adres ingevoerd.';
		$this->register_email_msg = 'Dit is een automatische e-mail verzonden door Quicksilver Forums om hetvolgende';
		$this->register_email_msg2 = 'Voor u om u account te activeren met';
		$this->register_email_msg3 = 'Klik op de volgende link, of kopieer hem naar een internetbrowser:';
		$this->register_email_used = 'Het door jou ingegeven E-mail adres is al aan een andere gebruiker toegewezen.';
		$this->register_fields = 'Je hebt niet alle velden ingevuld.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = 'Gelieve de tekst in te geven die in het beeld wordt getoond.';
		$this->register_image_invalid = 'Om te verifiëren dat je een menselijke registrant bent en geen robot, moet je de tekst zoals aangetoond in het beeld typen.';
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'Je bent geregistreerd. Er is een e-mail gestuurd naar %s met de activerings-informatie. Je account heeft beperkte mogelijkheden tot je account geactiveerd is.';
		$this->register_name_invalid = 'Je hebt een ongeldige naam ingevoerd.';
		$this->register_name_taken = 'Die gebruikersnaam is al bezet.';
		$this->register_new_user = 'gewenste gebruikersnaam';
		$this->register_pass_invalid = 'Het ingegeven wachtwoord is niet juist. Controleer of je alleen geldige leestekens zoals letters, nummers, streepjes, onderstreeptekens of spaties hebt gebruikt, en het op zijn minst uit 5 leestekens bestaat.';
		$this->register_pass_match = 'De wachtwoorden komen niet overeen.';
		$this->register_passwd = 'Wachtwoord';
		$this->register_reg = 'Registreer';
		$this->register_reging = 'Aan het registreren';
		$this->register_requested = 'Account activation request for:'; //Translate
		$this->register_tos = 'Gebruikersvoorwaarden';
		$this->register_tos_i_agree = 'Ik stem toe met de voorwaarden';
		$this->register_tos_not_agree = 'U heeft niet toegestemd met de voorwaarden.';
		$this->register_tos_read = 'Lees de voorwaarden';
	}

	function rssfeed()
	{
		$this->rssfeed_cannot_find_forum = 'Het forum blijkt niet te bestaan.';
		$this->rssfeed_cannot_find_topic = 'Het onderwerp blijkt niet te bestaan.';
		$this->rssfeed_cannot_read_forum = 'U heeft niet de toestemming om dit forum te bezichtigen.';
		$this->rssfeed_cannot_read_topic = 'U heeft niet de toestemming om dit onderwerp te lezen.';
		$this->rssfeed_error = 'Fout';
		$this->rssfeed_forum = 'Forum:'; //Translate
		$this->rssfeed_posted_by = 'Geplaatst door';
		$this->rssfeed_topic = 'Onderwerp:';
	}

	function search()
	{
		$this->search_advanced = 'Geavanceerd';
		$this->search_avatar = 'Avatar'; //Translate
		$this->search_basic = 'Normaal';
		$this->search_characters = 'Karakters van bericht';
		$this->search_day = 'Dag';
		$this->search_days = 'Dagen';
		$this->search_exact_name = 'Nauwkeurige naam';
		$this->search_flood = 'Je hebt al naar bericht gezocht in de laatste %s seconden.<br /><br />Probeer het in enkele seconden nog eens.';
		$this->search_for = 'Zoeken op';
		$this->search_forum = 'Forum'; //Translate
		$this->search_group = 'Groep';
		$this->search_guest = 'Gast';
		$this->search_in = 'Zoeken in';
		$this->search_in_posts = 'Zoek ALLEEN in berichten';
		$this->search_ip = 'IP-Adres';
		$this->search_joined = 'Geregistreerd:';
		$this->search_level = 'Gebruikers level';
		$this->search_match = 'Zoek naar overeenkomsten';
		$this->search_matches = 'Overeenkomsten';
		$this->search_month = 'Maand';
		$this->search_months = 'Maanden';
		$this->search_mysqldoc = 'MySQL Documentatie';
		$this->search_newer = 'Nieuwer';
		$this->search_no_results = 'Geen zoekresultaten.';
		$this->search_no_words = 'Je moet een zoekterm invullen.<br /><br />Elke term moet langer zijn dan 3 karakters, letters, nummers, apostrof en onderstrepingen ook meegeteld.';
		$this->search_offline = 'Deze gebruiker is momenteel offline';
		$this->search_older = 'Ouder';
		$this->search_online = 'Deze gebruiker is momenteel online.';
		$this->search_only_display = 'Toon alleen eerste';
		$this->search_partial_name = 'Gedeelte naam';
		$this->search_post_icon = 'Bericht pictogram';
		$this->search_posted_on = 'Geplaatst op';
		$this->search_posts = 'berichten';
		$this->search_posts_by = 'Alleen in berichten van';
		$this->search_regex = 'Zoeken op regelmatige uitdrukkingen';
		$this->search_regex_failed = 'Uw regelmatige ontbroken uitdrukking. Gelieve te zien de MySQL- documentatie voor regelmatige uitdrukking helpen.';
		$this->search_relevance = 'Bericht Relevantie: %d%%';
		$this->search_replies = 'Antwoorden';
		$this->search_result = 'Zoek resultaten';
		$this->search_search = 'Zoeken';
		$this->search_select_all = 'Selecteer alles';
		$this->search_show_posts = 'Toon overeenkomende berichten';
		$this->search_sound = 'Hoort zich aan als';
		$this->search_starter = 'Gestart door';
		$this->search_than = 'dan';
		$this->search_topic = 'Onderwerp';
		$this->search_unreg = 'Niet geregistreerd';
		$this->search_week = 'Week';
		$this->search_weeks = 'Weken';
		$this->search_year = 'Jaar';
	}

	function settings()
	{
		$this->settings = 'Opties';
		$this->settings_active = 'Opties van actieve gebruikers';
		$this->settings_allow = 'Toestaan';
		$this->settings_antibot = 'Anti-Robot Registratie';
		$this->settings_attach_ext = 'Bijlagen - File Extensions';
		$this->settings_attach_one_per = 'One per line. No periods.'; //Translate
		$this->settings_avatar = 'Avatar opties';
		$this->settings_avatar_flash = 'Flash Avatars'; //Translate
		$this->settings_avatar_max_height = 'Maximum Avatar hoogte';
		$this->settings_avatar_max_width = 'Maximum Avatar breedte';
		$this->settings_avatar_upload = 'Geuploade Avatars - Maximale bestandsgrootte';
		$this->settings_basic = 'Pas de Board Opties aan.';
		$this->settings_blank = 'gebruik <i>_blank</i> voor een nieuw venster.';
		$this->settings_board_enabled = 'Board Enabled'; //Translate
		$this->settings_board_location = 'Location of Board'; //Translate
		$this->settings_board_name = 'Board Naam';
		$this->settings_board_rss = 'RSS Feed Opties';
		$this->settings_board_rssfeed_desc = 'RSS Feed Beschrijving';
		$this->settings_board_rssfeed_posts = 'Number of posts to list on RSS Feed'; //Translate
		$this->settings_board_rssfeed_time = 'Refresh time in minutes'; //Translate
		$this->settings_board_rssfeed_title = 'RSS Feed Titel';
		$this->settings_clickable = 'Aanklikbare smlies per rij';
		$this->settings_cookie = 'Cookie and Flood Opties';
		$this->settings_cookie_path = 'Cookie Path'; //Translate
		$this->settings_cookie_prefix = 'Cookie Prefix'; //Translate
		$this->settings_cookie_time = 'Time to Remain Logged In'; //Translate
		$this->settings_db = 'Edit Connection Settings'; //Translate
		$this->settings_db_host = 'Database Host'; //Translate
		$this->settings_db_leave_blank = 'Laat voor niemand blank.';
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
		$this->settings_email = 'E-mail Opties';
		$this->settings_email_fake = 'For display only. Should not be a real e-mail address.'; //Translate
		$this->settings_email_from = 'E-mail From Address'; //Translate
		$this->settings_email_place1 = 'Place members in the'; //Translate
		$this->settings_email_place2 = 'group until they verify their e-mail'; //Translate
		$this->settings_email_place3 = 'E-mail activatie is niet nodig.';
		$this->settings_email_real = 'Zou een geldig e-mail adres moeten zijn.';
		$this->settings_email_reply = 'E-mail Reply-To Address'; //Translate
		$this->settings_email_smtp = 'SMTP Mail Server'; //Translate
		$this->settings_email_valid = 'New Member E-mail Validation'; //Translate
		$this->settings_enabled = 'Enabled'; //Translate
		$this->settings_enabled_modules = 'Enabled Modules'; //Translate
		$this->settings_foreign_link = 'Foreign Link Target'; //Translate
		$this->settings_general = 'General Opties';
		$this->settings_group_after = 'Group After Registration'; //Translate
		$this->settings_hot_topic = 'Posts for a Hot Topic'; //Translate
		$this->settings_kilobytes = 'Kilobytes'; //Translate
		$this->settings_max_attach_size = 'Bijlage - maximale bestandsgrootte';
		$this->settings_members = 'Ledenopties';
		$this->settings_modname_only = 'Module name only. Do not include .php'; //Translate
		$this->settings_new = 'New Setting'; //Translate
		$this->settings_new_add = 'Add Board Setting';
		$this->settings_new_added = 'New settings added.'; //Translate
		$this->settings_new_exists = 'That setting already exists. Choose another name for it.'; //Translate
		$this->settings_new_name = 'New setting name'; //Translate
		$this->settings_new_required = 'The new setting name is required.'; //Translate
		$this->settings_new_value = 'New setting value'; //Translate
		$this->settings_no_allow = 'Sta niet toe';
		$this->settings_nodata = 'Er werd geen data verzonden van POST';
		$this->settings_one_per = 'Een per lijn';
		$this->settings_pixels = 'Pixels'; //Translate
		$this->settings_pm_flood = 'Personal Messenger Flood Control'; //Translate
		$this->settings_pm_min_time = 'Minimale tijd tussen het versturen van PB\'en.';
		$this->settings_polls = 'Polls'; //Translate
		$this->settings_polls_no = 'Gebruikers kunnen niet in een poll stemmen nadat ze de resultaten gezien hebben';
		$this->settings_polls_yes = 'Gebruikers kunnen in een poll meestemmen na de resultaten gezien te hebben.';
		$this->settings_post_flood = 'Post Flood Control'; //Translate
		$this->settings_post_min_time = 'Minimale tijd tussen posten van berichten.';
		$this->settings_posts_topic = 'Posts Per Topic Page'; //Translate
		$this->settings_search_flood = 'Search Flood Control'; //Translate
		$this->settings_search_min_time = 'Minimale tijd tussen het zoeken.';
		$this->settings_server = 'Server Opties';
		$this->settings_server_gzip = 'GZIP Compression'; //Translate
		$this->settings_server_gzip_msg = 'Improves speed. Disable if the board appears jumbled or blank.'; //Translate
		$this->settings_server_maxload = 'Maximum Server Load'; //Translate
		$this->settings_server_maxload_msg = 'Disables board under excessive server strain. Enter 0 to disable.'; //Translate
		$this->settings_server_timezone = 'Server Tijdszone';
		$this->settings_show_avatars = 'Laat Avatars zien';
		$this->settings_show_email = 'Laat E-mailadres zien';
		$this->settings_show_emotes = 'Laat Emoticons zien';
		$this->settings_show_notice = 'Shown when the board is disabled'; //Translate
		$this->settings_show_pm = 'Aanvaard Privé Berichten';
		$this->settings_show_sigs = 'Laat handtekeningen zien';
		$this->settings_spider_agent = 'Spider User Agent'; //Translate
		$this->settings_spider_agent_msg = 'Enter all or part of the spider\'s unique HTTP USER AGENT.'; //Translate
		$this->settings_spider_enable = 'Enable Spider Display'; //Translate
		$this->settings_spider_enable_msg = 'Enable the names of search engine spiders on Active List.'; //Translate
		$this->settings_spider_name = 'Spider Naam';
		$this->settings_spider_name_msg = 'Enter the name that you wish to display for each of the above spiders on Active List. You need to place the spider\'s name on the same line as the spider\'s user agent above. For example, if you place \'googlebot\' on the third line for the user agent place \'Google\' on the third line for the Spider Name.'; //Translate
		$this->settings_timezone = 'Tijdszone';
		$this->settings_topics_page = 'Onderwerpen per forumpagina';
		$this->settings_tos = 'Voorwaarden';
		$this->settings_updated = 'Opties zijn geupdate.';
	}

	function stats()
	{
		$this->stats = 'Statistics Center'; //Translate
		$this->stats_post_by_month = 'Aantal bercihten geplaatst per maand';
		$this->stats_reg_by_month = 'Registraties per maand';
	}

	function templates()
	{
		$this->add = 'Voeg HTML Templates toe';
		$this->add_in = 'Add template to:'; //Translate
		$this->all_fields_required = 'All fields are required to add a template'; //Translate
		$this->choose_css = 'Choose CSS Template'; //Translate
		$this->choose_set = 'Kies een template set';
		$this->choose_skin = 'Kies een skin';
		$this->confirm1 = 'You are about to delete the'; //Translate
		$this->confirm2 = 'template from'; //Translate
		$this->create_new = 'Maak een nieuwe skin aan, genaamd';
		$this->create_skin = 'Maak een skin';
		$this->credit = 'Please do not remove our only credit!'; //Translate
		$this->css_edited = 'CSS file has been updated.'; //Translate
		$this->css_fioerr = 'The file could not be written to, you will need to CHMOD the file manually.'; //Translate
		$this->delete_template = 'Verwijder Template';
		$this->directory = 'Directory'; //Translate
		$this->display_name = 'Toon naam';
		$this->edit_css = 'Edit CSS'; //Translate
		$this->edit_skin = 'Pas de Skin aan';
		$this->edit_templates = 'Pas Templates aan';
		$this->export_done = 'Skin exported to the main Quicksilver Forums directory.';
		$this->export_select = 'Selecteer een skin voor te exporteren';
		$this->export_skin = 'Exporteer Skin';
		$this->install_done = 'Deze skin is met succes geinstalleerd.';
		$this->install_exists1 = 'Deze skin is';
		$this->install_exists2 = 'reeds geinstalleerd.';
		$this->install_overwrite = 'Overschrijf';
		$this->install_skin = 'Installeer Skin';
		$this->menu_title = 'Selecteer een template section om aan te passen';
		$this->no_file = 'No such file.'; //Translate
		$this->only_skin = 'Er is slechts 1 skin geïnstalleerd. U mag deze skin niet verwijderen.';
		$this->or_new = 'Or create new template set named:'; //Translate
		$this->select_skin = 'Selecteer een Skin';
		$this->select_skin_edit = 'Selecteer een skin om aan te passen';
		$this->select_skin_edit_done = 'Skin succesvol aangepast.';
		$this->select_template = 'Selecteer Template';
		$this->skin_chmod = 'A new directory could not be created for the skin. Try to CHMOD the skins directory to 775.'; //Translate
		$this->skin_created = 'Skin aangemaakt.';
		$this->skin_deleted = 'Skin succesvol verwijderd.';
		$this->skin_dir_name = 'You must enter a skin name and directory name.'; //Translate
		$this->skin_dup = 'A skin with a duplicate directory name was found. The skin\'s directory was changed to'; //Translate
		$this->skin_name = 'Je moet een skin naam ingeven.';
		$this->skin_none = 'Er zijn geen skin beschikbaar om te installeren.';
		$this->skin_set = 'Skin Set'; //Translate
		$this->skins_found = 'The following skins were found in the Quicksilver Forums directory';
		$this->template_about = 'About Variables'; //Translate
		$this->template_about2 = 'Variables are pieces of text that are replaced with dynamic data. Variables always begin with a dollar sign, and are sometimes enclosed in {braces}.'; //Translate
		$this->template_add = 'Toevoegen';
		$this->template_added = 'Template toegevoegd.';
		$this->template_clear = 'Wis';
		$this->template_confirm = 'U heeft veranderingen in de templates toegebracht. Wilt u deze veranderingen opslagen?';
		$this->template_description = 'Template Beschrijving';
		$this->template_html = 'Template HTML'; //Translate
		$this->template_name = 'Template naam';
		$this->template_position = 'Template Plaats';
		$this->template_set = 'Template Set'; //Translate
		$this->template_title = 'Template titel';
		$this->template_universal = 'Universal Variable'; //Translate
		$this->template_universal2 = 'Some variables can be used in any template, while others can only be used in a single template. Properties of the object $this can be used anywhere.'; //Translate
		$this->template_updated = 'Templates geupdate.';
		$this->templates = 'Templates'; //Translate
		$this->temps_active = 'Active Users Detail'; //Translate
		$this->temps_admin = '<b>AdminCP Universal</b>'; //Translate
		$this->temps_ban = 'AdminCP Bans'; //Translate
		$this->temps_board_index = 'Board Index'; //Translate
		$this->temps_censoring = 'AdminCP Word Censoring'; //Translate
		$this->temps_cp = 'Gebruikers controlepaneel';
		$this->temps_email = 'Verzend een e-mail naar een gebruiker';
		$this->temps_emot_control = 'AdminCP Emoticons'; //Translate
		$this->temps_forum = 'Forums'; //Translate
		$this->temps_forums = 'AdminCP Forums'; //Translate
		$this->temps_groups = 'AdminCP Groups'; //Translate
		$this->temps_help = 'Help'; //Translate
		$this->temps_login = 'Log In/Uit';
		$this->temps_logs = 'AdminCP Moderator Logs'; //Translate
		$this->temps_main = '<b>Board Universal</b>'; //Translate
		$this->temps_mass_mail = 'AdminCP Mass Mail'; //Translate
		$this->temps_member_control = 'AdminCP Member Control'; //Translate
		$this->temps_members = 'Gebruikerslijst';
		$this->temps_mod = 'Moderator Opties';
		$this->temps_pm = 'Privé Messenger';
		$this->temps_polls = 'Polls'; //Translate
		$this->temps_post = 'Posting'; //Translate
		$this->temps_printer = 'Printer-Friendly Topics'; //Translate
		$this->temps_profile = 'Profiel bekijken';
		$this->temps_recent = 'Recente onderwerpen';
		$this->temps_register = 'Registreren';
		$this->temps_rssfeed = 'RSS Feed'; //Translate
		$this->temps_search = 'Zoeken';
		$this->temps_settings = 'AdminCP Opties';
		$this->temps_templates = 'AdminCP Template Editor'; //Translate
		$this->temps_titles = 'AdminCP Member Titles'; //Translate
		$this->temps_topic_prune = 'AdminCP Topic Pruning'; //Translate
		$this->temps_topics = 'Onderwerpen';
		$this->upgrade_skin = 'Upgrade Skin'; //Translate
		$this->upgrade_skin_already = 'was already upgraded. Nothing to do.'; //Translate
		$this->upgrade_skin_detail = 'Skins upgraded using this method will still require template editing afterwards.<br />Select a skin to upgrade'; //Translate
		$this->upgrade_skin_upgraded = 'skin has been upgraded.'; //Translate
		$this->upgraded_templates = 'The following templates were added or upgraded'; //Translate
	}

	function titles()
	{
		$this->titles_add = 'Voeg groepsnaam toe';
		$this->titles_added = 'Groepsnaam toegevoegd.';
		$this->titles_control = 'Member Title Control'; //Translate
		$this->titles_edit = 'Pas groepsnamen aan';
		$this->titles_error = 'No title text or minimum posts was given'; //Translate
		$this->titles_image = 'Afbeelding';
		$this->titles_minpost = 'Minimum Berichten';
		$this->titles_nodel_default = 'Removal of the default title has been disabled as it will break your board, please edit it instead.'; //Translate
		$this->titles_title = 'Titel';
	}

	function topic()
	{
		$this->topic_attached = 'Bijgesloten bestand:';
		$this->topic_attached_downloads = 'Downloads'; //Translate
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = 'Je hebt geen toestemming om dit bestand te downloaden.';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = 'Bijgesloten bestand';
		$this->topic_avatar = 'Avatar'; //Translate
		$this->topic_bottom = 'Ga naar onderaan de pagina';
		$this->topic_create_poll = 'Start nieuwe stembus';
		$this->topic_create_topic = 'Start nieuw onderwerp';
		$this->topic_delete = 'Verwijder';
		$this->topic_delete_post = 'Verwijder dit onderwerp';
		$this->topic_edit = 'Bewerk';
		$this->topic_edit_post = 'Bewerk dit onderwerp';
		$this->topic_edited = 'Laatst bewerkt op %s door %s';
		$this->topic_error = 'Fout';
		$this->topic_group = 'Groep';
		$this->topic_guest = 'Gast';
		$this->topic_ip = 'IP-Adres';
		$this->topic_joined = 'Lid sinds';
		$this->topic_level = 'Gebruikers afdeling';
		$this->topic_links_aim = 'Stuur een AIM bericht naar %s';
		$this->topic_links_email = 'Stuur een e-mail naar %s';
		$this->topic_links_gtalk = 'Stuur een GTalk bericht naar %s';
		$this->topic_links_icq = 'Stuur een ICQ bericht naar %s';
		$this->topic_links_msn = 'Bekijk %s\'s MSN profiel';
		$this->topic_links_pm = 'Stuur een persoonlijk bericht naar %s';
		$this->topic_links_web = 'Bezoek %s\'s website';
		$this->topic_links_yahoo = 'Stuur een bericht naar %s met Yahoo! Messenger';
		$this->topic_lock = 'Sluiten';
		$this->topic_locked = 'Onderwerp gesloten';
		$this->topic_move = 'Verplaats';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = 'Newer Topic'; //Translate
		$this->topic_no_newer = 'There is no newer topic.'; //Translate
		$this->topic_no_older = 'There is no older topic.'; //Translate
		$this->topic_no_votes = 'Er zijn nog geen stemmen in deze stembus.';
		$this->topic_not_found = 'Onderwerp niet gevonden';
		$this->topic_not_found_message = 'Het onderwerp kan niet gevonden worden. Het is mogelijk verwijderd';
		$this->topic_offline = 'Deze gebruiker is momenteel offline';
		$this->topic_older = 'Older Topic'; //Translate
		$this->topic_online = 'Deze gebruiker is momenteel online';
		$this->topic_options = 'Onderwerp opties';
		$this->topic_pages = 'Bladzijden';
		$this->topic_perm_view = 'Je hebt geen rechten om dit onderwerp bekijken.';
		$this->topic_perm_view_guest = 'Je hebt geen toestemming om onderwerpen te bekijken. Als je je registreert, kun je deze wel bekijken.';
		$this->topic_pin = 'Sticky';
		$this->topic_posted = 'Geplaatst';
		$this->topic_posts = 'berichten';
		$this->topic_print = 'Printervriendelijk';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'Emoticons'; //Translate
		$this->topic_qr_open_emoticons = 'Open Clickable Emoticons'; //Translate
		$this->topic_qr_open_mbcode = 'Open MBCode'; //Translate
		$this->topic_quickreply = 'Quick Reply'; //Translate
		$this->topic_quote = 'Citeer';
		$this->topic_reply = 'Antwoord op onderwerp';
		$this->topic_split = 'Verdeel';
		$this->topic_split_finish = 'Beëindig Al het Verdelen';
		$this->topic_split_keep = 'Verplaats dit bericht niet';
		$this->topic_split_move = 'Verplaats dit bericht';
		$this->topic_subscribe = 'Stuur me een E-mail wanneer er gereageerd is op dit onderwerp';
		$this->topic_top = 'Ga naar bovenaan de pagina';
		$this->topic_unlock = 'Heropenen';
		$this->topic_unpin = 'Unsticky';
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = 'Ongeregistreerd';
		$this->topic_view = 'Bekijk resultaten';
		$this->topic_viewing = 'Bekijk onderwerp';
		$this->topic_vote = 'Stem';
		$this->topic_vote_count_plur = '%d stemmen';
		$this->topic_vote_count_sing = '%d stem';
		$this->topic_votes = 'Stemmen';
	}

	function universal()
	{
		$this->aim = 'AIM'; //Translate
		$this->based_on = 'Gebaseerd op';
		$this->board_by = 'Door';
		$this->charset = 'utf-8';
		$this->continue = 'Verder gaan';
		$this->date_long = 'M j, Y'; //Translate
		$this->date_short = 'n/j/y'; //Translate
		$this->delete = 'Verwijderen';
		$this->direction = 'ltr'; //Translate
		$this->edit = 'Aanpassen';
		$this->email = 'E-mail';
		$this->gtalk = 'GT'; //Translate
		$this->icq = 'ICQ'; //Translate
		$this->msn = 'MSN'; //Translate
		$this->new_message = 'Nieuw Bericht';
		$this->new_poll = 'Nieuwe Poll';
		$this->new_topic = 'Nieuw Onderwerp';
		$this->no = 'Nee';
		$this->powered = 'Powered by'; //Translate
		$this->private_message = 'PB';
		$this->quote = 'Citeer';
		$this->recount_forums = 'Recounted forums! Total topics: %d. Total posts: %d.'; //Translate
		$this->reply = 'Antwoord';
		$this->seconds = 'Seconden';
		$this->select_all = 'Selecteer alles';
		$this->sep_decimals = ',';
		$this->sep_thousands = '.';
		$this->spoiler = 'Spoiler'; //Translate
		$this->submit = 'Verzend';
		$this->subscribe = 'Toeschrijven aan';
		$this->time_long = ', g:i a'; //Translate
		$this->time_only = 'g:i a'; //Translate
		$this->today = 'Vandaag';
		$this->website = 'WWW'; //Translate
		$this->yahoo = 'Yahoo'; //Translate
		$this->yes = 'Ja';
		$this->yesterday = 'Gisteren';
	}
}
?>
