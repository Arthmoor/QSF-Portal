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
 * Slovak language module
 *
 * @author Michal Rehak <soyo@inmail.sk>
 * @since 1.1.0
 **/
class sk
{
	function active()
	{
		$this->active_last_action = 'Posledn� akcia';
		$this->active_modules_active = 'Prezeranie akt�vnych u��vate�ov';
		$this->active_modules_board = 'Prezeranie indexu';
		$this->active_modules_cp = 'Pou�itie ovl�dacieho panela';
		$this->active_modules_forum = 'Prezeranie f�ra: %s';
		$this->active_modules_help = 'Pou��vanie helpu';
		$this->active_modules_login = 'Logging In/Out';
		$this->active_modules_members = 'Prezeranie zoznamu �lenov';
		$this->active_modules_mod = 'Moderovanie';
		$this->active_modules_pm = 'Pou��vanie odkazova�a';
		$this->active_modules_post = 'Prispievanie';
		$this->active_modules_printer = 'Vytla�enie t�my: %s';
		$this->active_modules_profile = 'Prezeranie profilu: %s';
		$this->active_modules_recent = 'Prezeranie najnov��ch pr�spevkov';
		$this->active_modules_search = 'Vyh�ad�vanie';
		$this->active_modules_topic = 'Prezeranie t�my: %s';
		$this->active_time = '�as';
		$this->active_user = 'U��vate�';
		$this->active_users = 'Akt�vni u��vatelia';
	}

	function admin()
	{
		$this->admin_add_emoticons = 'Prida� smajl�ky';
		$this->admin_add_member_titles = 'Prida� automatick� tituly u��vate�ov';
		$this->admin_add_templates = 'Prida� HTML �abl�ny';
		$this->admin_ban_ips = 'Zablokova� IP adresu';
		$this->admin_censor = 'Cenz�ra slov';
		$this->admin_cp_denied = 'Pr�stup Zamietnut�';
		$this->admin_cp_warning = 'Administr�torsk� �as� (CP) bude nedostupn�, dokia� nebude vymazan� adres�r <b>install</b>, preto�e predstavuje v�nu bezpe�nostn� dieru pre nain�talovan� f�rum.';
		$this->admin_create_forum = 'Zalo�i� f�rum';
		$this->admin_create_group = 'Zalo�i� skupinu';
		$this->admin_create_help = 'Zalo�i� �l�nok helpu';
		$this->admin_create_skin = 'Zalo�i� skin';
		$this->admin_db = 'Datab�za';
		$this->admin_db_backup = 'Z�lohova� datab�zu';
		$this->admin_db_conn = 'Editova� nastavenie pripojenia';
		$this->admin_db_optimize = 'Optimalizova� datab�zu';
		$this->admin_db_query = 'Spusti� SQL dotaz';
		$this->admin_db_restore = 'Obnovi� zo z�lohy';
		$this->admin_delete_forum = 'Zmaza� f�rum';
		$this->admin_delete_group = 'Zmaza� skupinu';
		$this->admin_delete_help = 'Zmaza� help �l�nok';
		$this->admin_delete_member = 'Zmaza� u��vate�a';
		$this->admin_delete_template = 'Zmaza� HTML �abl�nu';
		$this->admin_edit_emoticons = 'Editova� alebo maza� smajl�ky';
		$this->admin_edit_forum = 'Editova� f�rum';
		$this->admin_edit_group_name = 'Editova� n�zov skupiny';
		$this->admin_edit_group_perms = 'Editova� pr�va skupiny';
		$this->admin_edit_help = 'Editova� help �l�nok';
		$this->admin_edit_member = 'Editova� u��vate�a';
		$this->admin_edit_member_perms = 'Editova� pr�va u��vate�a';
		$this->admin_edit_member_titles = 'Editova� alebo maza� automatick� tituly u��vate�ov';
		$this->admin_edit_settings = 'Editova� nastavenia cel�ho f�ra';
		$this->admin_edit_skin = 'Editova� alebo maza� skin';
		$this->admin_edit_templates = 'Editova� HTML �abl�nu';
		$this->admin_emoticons = 'Smajl�ky';
		$this->admin_export_skin = 'Exportova� skin';
		$this->admin_fix_stats = 'Opravi� �tatistiku u��vate�ov';
		$this->admin_forum_order = 'Zmeni� poradie f�r';
		$this->admin_forums = 'F�ra a kateg�rie';
		$this->admin_groups = 'Skupiny';
		$this->admin_heading = 'Quicksilver Forums - Ovl�dac� Panel Administr�tora';
		$this->admin_help = 'Help �l�nky';
		$this->admin_install_emoticons = 'In�talova� smajl�ky';
		$this->admin_install_skin = 'In�talova� skin';
		$this->admin_logs = 'Prezera� �innos� moder�tora';
		$this->admin_mass_mail = 'Zasla� email Va�im u��vate�om';
		$this->admin_members = 'U��vatelia';
		$this->admin_phpinfo = 'Prezera� inform�cie o PHP';
		$this->admin_prune = 'Preriedi� star� t�my';
		$this->admin_recount_forums = 'Prepo��ta� t�my a reakcie';
		$this->admin_settings = 'Nastavenia';
		$this->admin_settings_add = 'Add new board setting'; //Translate
		$this->admin_skins = 'Skiny';
		$this->admin_stats = '�tatistick� centrum';
		$this->admin_upgrade_skin = 'Upgradova� Skin';
		$this->admin_your_board = 'Va�e f�rum';
	}

	function backup()
	{
		$this->backup_create = 'Z�lohova� Datab�zu';
		$this->backup_createfile = 'Backup and create a file on server'; //Translate
		$this->backup_done = 'Datab�za bola zaz�lohovan� v hlavnom adres�ri Quicksilver Forums.';
		$this->backup_download = 'Backup and download (recommended)'; //Translate
		$this->backup_found = 'Nasleduj�ce z�lohy boli n�jden� v adres�ri Quicksilver Forums';
		$this->backup_invalid = 'T�to z�loha nie je pou�ite�n� - neplatn� form�t. Do datab�zi neboli zap�san� �iadne zmeny.';
		$this->backup_none = 'V adres�ri Quicksilver Forums neboli n�jden� �iadne z�lohy.';
		$this->backup_options = 'Select how you want your backup created'; //Translate
		$this->backup_restore = 'Obnovi� zo z�lohy';
		$this->backup_restore_done = 'Datab�za bola �spe�ne obnoven� zo z�lohy.';
		$this->backup_warning = 'Upozornenie: t�mto bud� v�etky existuj�ce d�ta Quicksilver F�ra prep�san�.';
	}

	function ban()
	{
		$this->ban = 'Zablokova�';
		$this->ban_banned_ips = 'Zablokova� IP Adresu';
		$this->ban_banned_members = 'Zablokovan� u��vatelia';
		$this->ban_ip = 'Zablokovan� IP Adresy';
		$this->ban_member_explain1 = 'Ak chcete zablokova� u��vate�ov, presu�te ich do skupiny';
		$this->ban_member_explain2 = 'v nastaveniach u��vate�ov.';
		$this->ban_members = 'Zablokova� u��vate�ov';
		$this->ban_nomembers = 'Moment�lne nie s� blokovan� �iadni u��vatelia.';
		$this->ban_one_per_line = 'Ka�d� adresa v samostatnom riadku.';
		$this->ban_regex_allowed = 'S� povolen� regul�rne v�razy. M��ete pou�i� znak * ako substit�ciu jedn�ho alebo viacer�ch ��siel.';
		$this->ban_settings = 'Nastavenia blokovan�';
		$this->ban_users_banned = 'Blokovan� u��vatelia.';
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
		$this->board_active_users = 'Akt�vni u��vatelia';
		$this->board_birthdays = 'Dnes m� narodeniny:';
		$this->board_bottom_page = 'Na spodok str�nky';
		$this->board_can_post = 'V tomto f�re m��ete zasiela� odpovede.';
		$this->board_can_topics = 'V tomto f�re m��ete ��ta� pr�spevky, ale nem��ete zaklada� nov� t�my.';
		$this->board_cant_post = 'V tomto f�re nem��ete zasiela� odpovede.';
		$this->board_cant_topics = 'V tomto f�re nem��ete ani zaklada� t�my, ani ��ta� pr�spevky.';
		$this->board_forum = 'F�rum';
		$this->board_guests = 'hosts';
		$this->board_last_post = 'Najnov�� pr�spevok';
		$this->board_mark = 'Prezna� v�etky pr�spevky na "pre��tan�"';
		$this->board_mark1 = 'V�etky pr�spevky a f�ra boli prezna�en� na "pre��tan�"';
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = '�lenovia';
		$this->board_message = '%s Spr�va';
		$this->board_most_online = 'Historicky maxim�lny po�et online u��vate�ov je %d a bol dosiahnut� %s.';
		$this->board_nobday = 'Dnes nem� �iadny �len narodeniny.';
		$this->board_nobody = 'Moment�lne nie je �iadny �len online.';
		$this->board_nopost = '�iadne pr�spevky';
		$this->board_noview = 'Nem�te povolenie na ��tanie tohoto f�ra.';
		$this->board_regfirst = 'Nem�te povolenie na ��tanie tohoto f�ra. Po zaregistrovan� sa mo�no budete ma�.';
		$this->board_replies = 'Odpovede';
		$this->board_stats = '�tatistika';
		$this->board_stats_string = 'Registrovan�ch u��vate�ov: %s. Priv�tajte na�eho najnov�ieho �lena, je to %s.<br />Vo f�re sa celkovo nach�dza %s t�m, %s odpoved� a %s pr�spevkov.';
		$this->board_top_page = 'Na vrch str�nky';
		$this->board_topics = 'T�my';
		$this->board_users = 'u��vatelia';
		$this->board_write_topics = 'V tomto f�re m�te pr�vo prezera� t�my a vytv�rat nov� .';
	}

	function censoring()
	{
		$this->censor = 'Cenzurovan� slov�';
		$this->censor_one_per_line = 'Ka�d� na samostatnom riadku.';
		$this->censor_regex_allowed = 'S� povolen� regul�rne v�razy. M��ete pou�i� znak * ako substit�ciu jedn�ho alebo viacer�ch znakov.';
		$this->censor_updated = 'Zoznam slov bol aktualizovan�.';
	}

	function cp()
	{
		$this->cp_aim = 'AIM Screen Name'; //Translate
		$this->cp_already_member = 'Emailov� adresa, ktor� ste zadali u� bola pridelen� in�mu �lenovi.';
		$this->cp_apr = 'Apr�l';
		$this->cp_aug = 'August'; //Translate
		$this->cp_avatar_current = 'V� s��asn� avatar';
		$this->cp_avatar_error = 'Chyba avatara';
		$this->cp_avatar_must_select = 'Mus�te si vybra� avatara.';
		$this->cp_avatar_none = 'Nepo��va� avatara.';
		$this->cp_avatar_pixels = 'pixels'; //Translate
		$this->cp_avatar_select = 'Vyberte si avatara';
		$this->cp_avatar_size_height = 'V� avatar mus� ma� ve�kos� medzi 1 a';
		$this->cp_avatar_size_width = '��rka Va�eho avatara mus� by� medzi 1 a';
		$this->cp_avatar_upload = 'Uploadova� avatara z	lok�lneho disku';
		$this->cp_avatar_upload_failed = 'Uploadovanie avatara zlyhalo. S�bor neexistuje.';
		$this->cp_avatar_upload_not_image = 'Uploadova� mo�ete iba obr�zky pre Va�aho avatara.';
		$this->cp_avatar_upload_too_large = 'Avatar, ktor�ho ste zadali pre upload je prive�k�. Maxim�lna povolen� ve�kos� je %d kB.';
		$this->cp_avatar_url = 'Zadajte URL v�ho avatara';
		$this->cp_avatar_use = 'Pou�i� uploadovan�ho avatara';
		$this->cp_bday = 'Narodeniny';
		$this->cp_been_updated = 'V� profil bol aktualizovan�.';
		$this->cp_been_updated1 = 'V� avatar bol aktualizovan�.';
		$this->cp_been_updated_prefs = 'Va�e nastavenia boli aktualizovan�.';
		$this->cp_changing_pass = 'Zmena hesla';
		$this->cp_contact_pm = 'Dovol�te ostatn�m, aby V�s kontaktovali cez odkazova�?';
		$this->cp_cp = 'Ovl�dac� panel';
		$this->cp_current_avatar = 'Aktu�lny avatar';
		$this->cp_current_time = 'Teraz je %s.';
		$this->cp_custom_title = 'Zmeni� titul �lena';
		$this->cp_custom_title2 = 'Toto privil�gium je rezervovan� pre administr�tora f�ra';
		$this->cp_dec = 'December'; //Translate
		$this->cp_editing_avatar = 'Zmena avatara';
		$this->cp_editing_profile = 'Zmena profilu';
		$this->cp_email = 'Email'; //Translate
		$this->cp_email_form = 'Dovol�te ostatn�m, aby V�s kontaktovali cez email?';
		$this->cp_email_invaid = 'Email, ktor� ste zadali vyzer� by� neplatn�.';
		$this->cp_err_avatar = 'Chyba pri aktualiz�cii avatara.';
		$this->cp_err_updating = 'Chyba pri aktualiz�cii profilu.';
		$this->cp_feb = 'Febru�r';
		$this->cp_file_type = 'Avatar, ktor�ho ste zadali je neplatn�. Uistite sa, �i m� URL spr�vny form�t a �i je doty�n� s�bor typu gif, jpg alebo png.';
		$this->cp_format = 'Va�e meno sa bude zobrazova� ako';
		$this->cp_gtalk = 'GTalk konto';
		$this->cp_header = 'Ovl�dac� panel u��vate�a';
		$this->cp_height = 'V��ka';
		$this->cp_icq = 'ICQ ��slo';
		$this->cp_interest = 'Z�ujmy';
		$this->cp_jan = 'Janu�r';
		$this->cp_july = 'J�l';
		$this->cp_june = 'J�n';
		$this->cp_label_edit_avatar = 'Zmena avatara';
		$this->cp_label_edit_pass = 'Zmena hesla';
		$this->cp_label_edit_prefs = 'Zmena nastaven�';
		$this->cp_label_edit_profile = 'Zmena profilu';
		$this->cp_label_edit_sig = 'Edit Signature'; //Translate
		$this->cp_label_edit_subs = 'Editovanie objedn�vok';
		$this->cp_language = 'Jazyk';
		$this->cp_less_charac = 'Va�e meno mus� by� krat�ie, ako 32 znakov.';
		$this->cp_location = 'S�dlo';
		$this->cp_login_first = 'Pre pr�stup k Va�emu ovl�daciemu panelu sa mus�te nalogova�.';
		$this->cp_mar = 'Marec';
		$this->cp_may = 'M�j';
		$this->cp_msn = 'MSN Identity'; //Translate
		$this->cp_must_orig = 'Va�e meno sa mus� zhodova� s origin�lom. M��ete zmeni� iba ve�kos� a medzery.';
		$this->cp_new_notmatch = 'Nov� hesl�, ktor� ste zadali, sa nezhoduj�.';
		$this->cp_new_pass = 'Nov� heslo';
		$this->cp_no_flash = 'Avatari typu ShockWaveFlash tu nie s� povolen�.';
		$this->cp_not_exist = 'D�tum, ktor� ste zadali (%s), neexistuje!';
		$this->cp_nov = 'November'; //Translate
		$this->cp_oct = 'Oct�ber';
		$this->cp_old_notmatch = 'P�vodn� heslo, ktor� ste zadali sa nezhoduje s heslom v datab�ze.';
		$this->cp_old_pass = 'P�vodn� heslo';
		$this->cp_pass_notvaid = 'Va�e heslo je neplatn�. Uistite sa, �e obsahuje len platn� znaky ako s� p�smen�, ��sla, poml�ka, podtr��tko alebo medzera.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = 'Zmena nastaven�';
		$this->cp_preview_sig = 'Signature Preview:'; //Translate
		$this->cp_privacy = 'Mo�nosti ochrany s�kromia';
		$this->cp_repeat_pass = 'E�te raz nov� heslo';
		$this->cp_sept = 'September'; //Translate
		$this->cp_show_active = 'Ukazova� Va�u �innos� po�as pou��vania f�ra?';
		$this->cp_show_email = 'Zobrazova� v profile aj email?';
		$this->cp_signature = 'Podpis';
		$this->cp_size_max = 'Prevtelenie, ktor� ste zadali, je prive�k�. Maxim�lna ve�kos� je povolen� %s na %s pixlov.';
		$this->cp_skin = 'Skin f�ra';
		$this->cp_sub_change = 'Zmena objedn�vok';
		$this->cp_sub_delete = 'Zmaza�';
		$this->cp_sub_expire = 'D�tum vypr�ania platnosti';
		$this->cp_sub_name = 'N�zov objedn�vky';
		$this->cp_sub_no_params = 'Neboli zadan� �iadne parametre.';
		$this->cp_sub_success = 'Teraz V�m bud� emailom zasielan� nov� pr�spevky, zdroj: %s.';
		$this->cp_sub_type = 'Typ objedn�vky';
		$this->cp_sub_updated = 'Ozna�en� objedn�vky boli vymazan�.';
		$this->cp_topic_option = 'Mo�nosti t�my';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = 'Profil bol aktualizovan�';
		$this->cp_updated1 = 'Avatar bol aktualizovan�';
		$this->cp_updated_prefs = 'Nastavenia boli aktualizovan�';
		$this->cp_user_exists = 'U��vate� s tak�mto menom u� existuje.';
		$this->cp_valided = 'Va�e heslo bolo overen� a zmenen�.';
		$this->cp_view_avatar = 'Zobrazi� avatara?';
		$this->cp_view_emoticon = 'Zobrazi� smajl�ky?';
		$this->cp_view_signature = 'Zobrazi� podpisy?';
		$this->cp_welcome = 'Bu�te v�tan� v u��vate�skom ovl�dacom paneli. Odtia�to mo�no nastavova� Va�e konto. Vyberte si z nasleduj�cich mo�nost�.';
		$this->cp_width = '��rka';
		$this->cp_www = 'Homepage'; //Translate
		$this->cp_yahoo = 'Yahoo Identity'; //Translate
		$this->cp_zone = '�asov� z�na';
	}

	function email()
	{
		$this->email_blocked = 'Tento �len neprij�ma email z tohoto formul�ra.';
		$this->email_email = 'Email'; //Translate
		$this->email_msgtext = 'Obsah emailu:';
		$this->email_no_fields = 'Vr�te sa o overte, �i s� v�etky polia vyplnen�.';
		$this->email_no_member = '�iaden �len s tak�mto menom sa nena�iel.';
		$this->email_no_perm = 'Nem�te povolenie posiela� emaily z tohoto f�ra.';
		$this->email_sent = 'V� email bol odoslan�.';
		$this->email_subject = 'Predmet:';
		$this->email_to = 'Komu:';
	}

	function emot_control()
	{
		$this->emote = 'Smajl�ky';
		$this->emote_add = 'Prida� smajl�ky';
		$this->emote_added = 'Smajl�ky boli pridan�.';
		$this->emote_clickable = 'Kliknute�n�';
		$this->emote_edit = 'Editova� smajl�ky';
		$this->emote_image = 'Obr�zok';
		$this->emote_install = 'In�talova� smajl�ky';
		$this->emote_install_done = 'Smajl�ky boli �spe�ne znovu nain�talovan�.';
		$this->emote_install_warning = 'T�mto bud� zmazan� v�etky existuj�ce nastavenia smajl�kov a uploadovan� smajl�ky bud� naimportovan� z vybran�ho skinu do datab�zy.';
		$this->emote_no_text = 'Nebol zadan� �iadny text ku smajl�ku.';
		$this->emote_text = 'Text'; //Translate
	}

	function forum()
	{
		$this->forum_by = 'Nap�sal';
		$this->forum_can_post = 'V tomto f�re m��ete odpoveda�.';
		$this->forum_can_topics = 'V tomto f�re si m��ete prezera� t�my.';
		$this->forum_cant_post = 'V tomto f�re nem�te povolenie odpoveda�.';
		$this->forum_cant_topics = 'V tomto f�re nem�te povolenie prezera� t�my.';
		$this->forum_dot = 'dot(to �o je?)';
		$this->forum_dot_detail = 'ukazuje, �e ste pod dan� t�mu prispeli';
		$this->forum_forum = 'F�rum';
		$this->forum_guest = 'Hos�';
		$this->forum_hot = 'd�le�it�';
		$this->forum_icon = 'Ikona spr�vy';
		$this->forum_jump = 'Hop na najnov�ie pr�spevky pod touto t�mou';
		$this->forum_last = 'Najnov�� pr�spevok';
		$this->forum_locked = 'Zamknut�';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = 'Presunut�';
		$this->forum_msg = '%s Spr�va';
		$this->forum_new = 'nov�';
		$this->forum_new_poll = 'Zalo�i� nov� hlasovanie';
		$this->forum_new_topic = 'Zalo�i� nov� t�mu';
		$this->forum_no_topics = 'V tomto f�re nie s� �iadne t�my.';
		$this->forum_noexist = 'Zadan� f�rum neexistuje.';
		$this->forum_nopost = 'Nie s� pr�spevky';
		$this->forum_not = 'menej';
		$this->forum_noview = 'Nem�te povolenie na prezeranie f�r.';
		$this->forum_pages = 'Str�nky';
		$this->forum_pinned = 'Pri�pendlen�';
		$this->forum_pinned_topic = 'Pri�pendlen� t�ma';
		$this->forum_poll = 'Hlasovanie';
		$this->forum_regfirst = 'Nem�te povolenie na prezeranie f�r. Ak sa zaregistrujete, mo�no budete ma�.';
		$this->forum_replies = 'Odpovede';
		$this->forum_starter = 'Zakladate�';
		$this->forum_sub = 'Pod-F�rum';
		$this->forum_sub_last_post = 'Najnov�� pr�spevok';
		$this->forum_sub_replies = 'Odpovede';
		$this->forum_sub_topics = 'T�my';
		$this->forum_subscribe = 'Posla� emailom nov� pr�spevky v tomto f�re';
		$this->forum_topic = 'T�ma';
		$this->forum_views = 'Viden�';
		$this->forum_write_topics = 'V tomto f�re m�te povolenie zaklada� t�my.';
	}

	function forums()
	{
		$this->forum_controls = 'Nastavenia F�r';
		$this->forum_create = 'Zalo�i� F�rum';
		$this->forum_create_cat = 'Zalo�i� Kateg�riu';
		$this->forum_created = 'F�rum bolo zalo�en�';
		$this->forum_default_perms = 'Prednastaven� pr�va';
		$this->forum_delete = 'Zmaza� F�rum';
		$this->forum_delete_warning = 'Ur�ite chcete zmaza� toto f�rum spolu s t�mami a pr�spevkami, ktor� sa v �om nach�dzaj�?<br />Tento krok je nevratn�.';
		$this->forum_deleted = 'F�rum bolo zmazan�.';
		$this->forum_description = 'Popis';
		$this->forum_edit = 'Editova� F�rum';
		$this->forum_edited = 'F�rum bolo �spe�ne zeditovan�.';
		$this->forum_empty = 'N�zov f�ra je pr�zdny. Pros�m, vr�te sa a zadajte n�zov.';
		$this->forum_is_subcat = 'Toto f�rum je iba podkateg�riou.';
		$this->forum_name = 'N�zov';
		$this->forum_no_orphans = 'Nesmiete osirie� f�rum t�m, �e mu zma�ete hierarchick�ho rodi�a.';
		$this->forum_none = 'Nie s� k dispoz�cii �iadne	manipulovate�n� f�ra.';
		$this->forum_ordered = 'Poradie F�r bolo zaktualizovan�';
		$this->forum_ordering = 'Zmeni� Poradie F�r';
		$this->forum_parent = 'T�mto sp�sobom nem��ete zmeni� hierarchick�ho rodi�a f�ra.';
		$this->forum_parent_cat = 'Rodi�ovsk� Kateg�ria';
		$this->forum_quickperm_select = 'Vyberte existuj�ce f�rum, ktor�ho pr�va chcete okop�rova�.';
		$this->forum_quickperms = 'R�chle Pr�va';
		$this->forum_recount = 'Prepo��ta� T�my a Odpovede';
		$this->forum_select_cat = 'Vyberte existuj�cu kateg�riu, pod ktorou chcete zalo�it f�rum.';
		$this->forum_subcat = 'Podkateg�ria';
	}

	function groups()
	{
		$this->groups_bad_format = 'Mus�te pou�i� %s vo form�te, ktor� predstavuje meno skupiny.';
		$this->groups_based_on = 'zalo�en� na';
		$this->groups_create = 'Zalo�i� Skupinu';
		$this->groups_create_new = 'Zalo�i� nov� skupinu u��vate�ov s n�zvom';
		$this->groups_created = 'Skupina bola zalo�en�';
		$this->groups_delete = 'Zmaza� Skupinu';
		$this->groups_deleted = 'Skupina bola Zmazan�.';
		$this->groups_edit = 'Editova� Skupinu';
		$this->groups_edited = 'Skupina bola Zeditovan�.';
		$this->groups_formatting = 'Zobrazi� Form�tovanie';
		$this->groups_i_confirm = 'Potvrdzujem, �e naozaj zmaza� t�to skupinu u��vate�ov.';
		$this->groups_name = 'N�zov';
		$this->groups_no_action = 'Neboli vykonan� �iadne zmeny.';
		$this->groups_no_delete = 'Neexistuje zmazate�n�
	skupina u��vate�ov.<br />Z�kladn� skupiny s� potrebn� pre chod Quicksilver F�ra a preto nesm� by� zmazan�.';
		$this->groups_no_group = 'Nebola zadan� �iadna skupina.';
		$this->groups_no_name = 'Nebol zadan� n�zov skupiny.';
		$this->groups_only_custom = 'Pozn�mka: M��ete maza� iba skupiny u��vae�ov mimo z�kladn�ch skup�n. Z�kladn� skupiny s� potrebne pre chod Quicksilver F�ra.';
		$this->groups_the = 'Skupina';
		$this->groups_to_edit = 'Editovate�n� skupiny';
		$this->groups_type = 'Typ Skupiny';
		$this->groups_will_be = 'bud� zmazan�.';
		$this->groups_will_become = 'U��vatelia zo zmazanej skupiny bud� presunut� do skupiny';
	}

	function help()
	{
		$this->help_add = 'Prida� Help �l�nok';
		$this->help_article = 'Nastavenia Help �l�nku';
		$this->help_available_files = 'Help'; //Translate
		$this->help_confirm = 'Naozaj chcete zmaza�';
		$this->help_content = 'Obsah �l�nku';
		$this->help_delete = 'Zmaza� Help �l�nok';
		$this->help_deleted = 'Help �l�nok bol Zmazan�.';
		$this->help_edit = 'Editova� Help �l�nok';
		$this->help_edited = 'Help �l�nok bol zaktualizovan�.';
		$this->help_inserted = '�l�nok bol zap�san� do datab�zy.';
		$this->help_no_articles = 'V datab�ze moment�lne nie s� �iadne help �l�nky.';
		$this->help_no_title = 'Nem��ete zalo�i� help �l�nok bez n�zvu.';
		$this->help_none = 'V datab�ze nie s� �iadne s�bory s helpom';
		$this->help_not_exist = 'Tento help �l�nok neexistuje.';
		$this->help_select = 'Pros�m, vyberte help �l�nok, ktor� chcete editova�';
		$this->help_select_delete = 'Pros�m, vyberte help �l�nok, ktor� chcete zmaza�';
		$this->help_title = 'N�zov';
	}

	function home()
	{
		$this->home_choose = 'Vyberte si.';
		$this->home_menu_title = 'Administr�torsk� menu (CP)';
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
		$this->login_cant_logged = 'Pravdepodobne nie ste prihl�sen�. Sk�ste skontrolova� V� login a heslo.<br /><br />S� citliv� na ve�k� a mal� znaky, tak�e \'UsErNaMe\' nie je to ist�, �o \'Username\'. A taktie� si overte, �i s� vo Va�om prehliada�i povolen� cookies.';
		$this->login_cookies = 'Pre prihl�senie mus�te povoli� cookies.';
		$this->login_forgot_pass = 'Zabudli ste Va�e heslo?';
		$this->login_header = 'Prihlasovanie';
		$this->login_logged = 'Teraz ste prihl�sen�.';
		$this->login_now_out = 'Teraz ste odhl�sen�.';
		$this->login_out = 'Odhlasovanie';
		$this->login_pass = 'Heslo';
		$this->login_pass_no_id = 'U��vate� so zadan�m menom neexistuje.';
		$this->login_pass_request = 'Pre dokon�enie zresetovania hesla pros�m kliknite na odkaz, zaslan� na emailovu adresu, na ktor� je registrovan� Va�e konto.';
		$this->login_pass_reset = 'Zresetovanie hesla';
		$this->login_pass_sent = 'Va�e heslo bolo zresetovan�. Nov� heslo bolo zaslan� na emailov� adres�, kter� je zregistrovan� k Va�emu kontu';
		$this->login_sure = '\'%s\', ur�ite sa chcete odhl�si�?';
		$this->login_user = 'Meno u��vate�a';
	}

	function logs()
	{
		$this->logs_action = 'Akcia';
		$this->logs_deleted_post = 'Zmazan� pr�spevok';
		$this->logs_deleted_topic = 'Zmazan� t�ma';
		$this->logs_edited_post = 'Zeditovan� pr�spevok';
		$this->logs_edited_topic = 'Zeditovan� t�ma';
		$this->logs_id = 'IDs'; //Translate
		$this->logs_locked_topic = 'Zamknut� t�ma';
		$this->logs_moved_from = 'z f�ra';
		$this->logs_moved_to = 'do f�ra';
		$this->logs_moved_topic = 'Presunut� t�ma';
		$this->logs_moved_topic_num = 'Po�et presunut�ch t�m';
		$this->logs_pinned_topic = 'Pri�pendlen� t�ma';
		$this->logs_post = 'Pr�spevok';
		$this->logs_time = '�as';
		$this->logs_topic = 'T�ma';
		$this->logs_unlocked_topic = 'Odomknut� t�ma';
		$this->logs_unpinned_topic = 'Od�pendlen� t�ma';
		$this->logs_user = 'U��vate�';
		$this->logs_view = 'Prezeranie �innosti moder�tora';
	}

	function main()
	{
		$this->main_activate = 'V� ��et e�te nebol aktivovan�.';
		$this->main_activate_resend = 'Znovu posla� aktiva�n� email';
		$this->main_admincp = 'nastavenia f�r';
		$this->main_banned = 'V�m bolo �ia� komplet cel� f�rum znepr�stupnen�.';
		$this->main_code = 'zdrojov� k�d';
		$this->main_cp = 'ovl�dac� panel';
		$this->main_full = 'Detaily';
		$this->main_help = 'help';
		$this->main_load = 'z�a�';
		$this->main_login = 'prihl�senie';
		$this->main_logout = 'odhl�senie';
		$this->main_mark = 'ozna�i� v�etko';
		$this->main_mark1 = 'Ozna�i� v�etky t�my ako pre��tan�';
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = 'Je n�m ��to, ale %s moment�lne nie je dostupn� kv�li stra�nej mase online u��vate�ov.';
		$this->main_members = '�lenovia';
		$this->main_messenger = 'odkazova�';
		$this->main_new = 'nov�';
		$this->main_next = 'nasleduj�ce';
		$this->main_prev = 'predo�l�';
		$this->main_queries = 'DB dotazov';
		$this->main_quote = 'Cit�cia';
		$this->main_recent = 'najnov�ie pr�spevky';
		$this->main_recent1 = 'Zobrazi� najnov�ie pr�spevky od poslednej n�v�tevy';
		$this->main_register = 'registr�cia';
		$this->main_reminder = 'HoSiPa';
		$this->main_reminder_closed = 'F�rum je uzavret� a pr�stupn� len pre adminov.';
		$this->main_said = 'poviedali';
		$this->main_search = 'h�adanie';
		$this->main_topics_new = 'V tomto f�re s� nejak� nov� pr�spevky';
		$this->main_topics_old = 'V tomto f�re nie s� �iadne nov� pr�spevky';
		$this->main_welcome = 'Vitajte';
		$this->main_welcome_guest = 'Vitajte!';
	}

	function mass_mail()
	{
		$this->mail = 'Hromadn� Mail';
		$this->mail_announce = 'Oznam Od';
		$this->mail_groups = 'Cie�ov� Skupina';
		$this->mail_members = 'u��vatelia.';
		$this->mail_message = 'Spr�va';
		$this->mail_select_all = 'Ozna�i� v�etko';
		$this->mail_send = 'Posla� Mail';
		$this->mail_sent = 'Va�a spr�va bola zaslan� na adresu';
	}

	function member_control()
	{
		$this->mc = 'Nastavenia U��vate�ov';
		$this->mc_confirm = 'Naozaj chcete zmaza�';
		$this->mc_delete = 'Zmaza� U��vate�a';
		$this->mc_deleted = 'U��vate� Zmazan�.';
		$this->mc_edit = 'Editova� U��vate�a';
		$this->mc_edited = 'U��vate� bol Zaktualizovan�';
		$this->mc_email_invaid = 'Email, ktor� ste zadali, je neplatn�.';
		$this->mc_err_updating = 'Error Updating Profile'; //Translate
		$this->mc_find = 'N�js� u��vate�ov, ktor�ch meno obsahuje';
		$this->mc_found = 'Boli n�jden� nasleduj�ci u��vatelia. Pros�m, vyberte jedn�ho.';
		$this->mc_guest_needed = 'Konto guest je potrebn� pre chod Quicksilver F�ra.';
		$this->mc_not_found = 'Neboli n�jden� �iadni u��vatelia';
		$this->mc_user_aim = 'AIM Name'; //Translate
		$this->mc_user_avatar = 'Avatar'; //Translate
		$this->mc_user_avatar_height = 'V��ka Avatara';
		$this->mc_user_avatar_type = 'Typ Avatara';
		$this->mc_user_avatar_width = '��rka Avatara';
		$this->mc_user_birthday = 'Narodeniny';
		$this->mc_user_email = 'Emailov�  Adresa';
		$this->mc_user_email_show = 'Email je pr�stupn� verejnosti';
		$this->mc_user_group = 'Skupina';
		$this->mc_user_gtalk = 'GTalk konto';
		$this->mc_user_homepage = 'Homepage'; //Translate
		$this->mc_user_icq = 'ICQ Number'; //Translate
		$this->mc_user_id = 'ID u��vate�a';
		$this->mc_user_interests = 'Z�ujmy';
		$this->mc_user_joined = 'registr�cia';
		$this->mc_user_language = 'Jazyk';
		$this->mc_user_lastpost = 'Posledn� pr�spevok';
		$this->mc_user_lastvisit = 'Posledn� n�v�teva';
		$this->mc_user_level = 'Level'; //Translate
		$this->mc_user_location = 'S�dlo';
		$this->mc_user_msn = 'MSN Identity'; //Translate
		$this->mc_user_name = 'Meno';
		$this->mc_user_pm = 'Prij�ma osobn� odkazy (PM)';
		$this->mc_user_posts = 'Pr�spevky';
		$this->mc_user_signature = 'Podpis';
		$this->mc_user_skin = 'Skin'; //Translate
		$this->mc_user_timezone = '�asov� P�smo';
		$this->mc_user_title = 'Titul u��vate�a';
		$this->mc_user_title_custom = 'Pou�i� vlastn� titul u��vate�a';
		$this->mc_user_view_avatars = 'Zobrazi� avatarov';
		$this->mc_user_view_emoticons = 'Zobrazi� smajl�ky';
		$this->mc_user_view_signatures = 'Zobrazi� podpis';
		$this->mc_user_yahoo = 'Yahoo Identity'; //Translate
	}

	function membercount()
	{
		$this->mcount = 'Opravi� �tatistiku u��vate�ov';
		$this->mcount_updated = 'Po�et u��vate�ov bol zaktualizovan�.';
	}

	function members()
	{
		$this->members_all = 'v�etko';
		$this->members_email = 'email';
		$this->members_email_member = 'po�li email tomuto �lenovi';
		$this->members_group = 'skupina';
		$this->members_joined = 'registr�cia';
		$this->members_list = 'zoznam �lenov';
		$this->members_member = '�len';
		$this->members_pm = 'odkazova�';
		$this->members_posts = 'pr�spevky';
		$this->members_send_pm = 'posla� tomuto �lenovi odkaz';
		$this->members_title = 'titul';
		$this->members_vist_www = 'nav�t�vi� webstr�nku tohoto �lena';
		$this->members_www = 'webstr�nka';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Ur�ite chcete zmaza� tento pr�spevok?';
		$this->mod_confirm_topic_delete = 'Ur�ite chcete zmaza� t�to t�mu?';
		$this->mod_error_first_post = 'Nem��ete zmaza� prv� pr�spevok pod t�mou.';
		$this->mod_error_move_category = 'Nem��ete presun�� t�mu do kateg�rie.';
		$this->mod_error_move_create = 'Nem��ete pres�va� t�my do zadan�ho f�ra.';
		$this->mod_error_move_forum = 'Nem��ete presun�� t�mu do f�ra. ktor� neexistuje.';
		$this->mod_error_move_global = 'Nem��ete pres�va� glob�lnu t�mu. Zme�te nastavenia t�my, ne� ju presuniete.';
		$this->mod_error_move_same = 'Nem��ete presun�� t�mu do f�ra, v ktorom sa moment�lne nach�dza.';
		$this->mod_label_controls = 'Ovl�danie pre moder�torov';
		$this->mod_label_description = 'Popis';
		$this->mod_label_emoticon = 'Konvertova� textov� smajl�ky na obr�zky?';
		$this->mod_label_global = 'Glob�lna t�ma';
		$this->mod_label_mbcode = 'interpretova� Mb-k�dy?';
		$this->mod_label_move_to = 'Presun�� ..';
		$this->mod_label_options = 'Mo�nosti';
		$this->mod_label_post_delete = 'Zmaza� pr�spevok';
		$this->mod_label_post_edit = 'Editova� pr�spevok';
		$this->mod_label_post_icon = 'Ikona Pr�spevku';
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = 'Nadpis';
		$this->mod_label_title_original = 'P�vodn� nadpis';
		$this->mod_label_title_split = 'Rozdeli� nadpis';
		$this->mod_label_topic_delete = 'Zmaza� t�mu';
		$this->mod_label_topic_edit = 'Editova� t�mu';
		$this->mod_label_topic_lock = 'Zamkn�� t�mu';
		$this->mod_label_topic_move = 'Presun�� t�mu';
		$this->mod_label_topic_move_complete = 'Kompletne presun�� t�mu do nov�ho f�ra';
		$this->mod_label_topic_move_link = 'Presun�� t�mu do nov�ho f�ra a zanecha� link na nov� umiestnenie v p�vodnom f�re.';
		$this->mod_label_topic_pin = 'Pri�pendli� t�mu';
		$this->mod_label_topic_split = 'Rozdeli� t�mu';
		$this->mod_missing_post = '�pecifikovan� pr�spevok neexistuje.';
		$this->mod_missing_topic = '�pecifikovan� t�ma neexistuje.';
		$this->mod_no_action = 'Mus�te �pecifikova� �innos�.';
		$this->mod_no_post = 'Mus�te �pecifikova� pr�spevok.';
		$this->mod_no_topic = 'Mus�te �pecifikova� t�mu.';
		$this->mod_perm_post_delete = 'Nem�te povolenie na zmazanie tohoto pr�spevku.';
		$this->mod_perm_post_edit = 'Nem�te povolenie na edit�ciu tohoto pr�spevku.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = 'Nem�te povolenie na zmazanie tejto t�my.';
		$this->mod_perm_topic_edit = 'Nem�te povolenie na edit�ciu tejto t�my.';
		$this->mod_perm_topic_lock = 'Nem�te povolenie na zamknutie tejto t�my.';
		$this->mod_perm_topic_move = 'Nem�te povolenie na pres�vanie tejto t�my.';
		$this->mod_perm_topic_pin = 'Nem�te povolenie na pri�pendlenie tejto t�my.';
		$this->mod_perm_topic_split = 'Nem�te povolenie na rozdelenie tejto t�my.';
		$this->mod_perm_topic_unlock = 'Nem�te povolenie na odomknutie tejto t�my.';
		$this->mod_perm_topic_unpin = 'Nem�te povolenie na od�pendlenie tejto t�my.';
		$this->mod_success_post_delete = 'Pr�spevok bol �spe�ne zmazan�.';
		$this->mod_success_post_edit = 'Pr�spevok bol �spe�ne zeditovan�.';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = 'T�ma bola �spe�ne rozdelen�.';
		$this->mod_success_topic_delete = 'T�ma bola �spe�ne zmazan�';
		$this->mod_success_topic_edit = 'T�ma bola �spe�ne zeditovan�.';
		$this->mod_success_topic_move = 'T�ma bola �spe�ne presunut� do nov�ho f�ra.';
		$this->mod_success_unpublish = 'This topic has been removed from the published list.'; //Translate
	}

	function optimize()
	{
		$this->optimize = 'Optimalizova� Datab�zu';
		$this->optimized = 'Tabu�ky v datab�ze boli zoptimalizovan� pre maxim�lny v�kon.';
	}

	function perms()
	{
		$this->perm = 'Pr�vo';
		$this->perms = 'Pr�va';
		$this->perms_board_view = 'Zobrazi� index f�r';
		$this->perms_board_view_closed = 'Pou��va� Quicksilver F�rum ak je zatvoren�';
		$this->perms_do_anything = 'Pou��va� Quicksilver F�rum';
		$this->perms_edit_for = 'Editova� pr�va pre';
		$this->perms_email_use = 'Posla� email u��vate�om cez f�rum';
		$this->perms_forum_view = 'Zobrazi� f�rum';
		$this->perms_is_admin = 'Pr�stup k administr�torsk�mu ovl�daciemu panelu (CP)';
		$this->perms_only_user = 'Pre tohoto u��vate�a aplikova� iba pr�va jeho skupiny';
		$this->perms_override_user = 'T�mto prekryjete pr�va skupiny pre tohoto u��vate�a.';
		$this->perms_pm_noflood = 'Vy�a� z kontroly zahltenosti osobn�ho odkazova�a';
		$this->perms_poll_create = 'Zaklada� hlasovania';
		$this->perms_poll_vote = 'Hlasova�';
		$this->perms_post_attach = 'Prip�ja� pr�lohy k pr�spevkom';
		$this->perms_post_attach_download = 'S�ahova� pr�lohy pr�spevkov';
		$this->perms_post_create = 'Vytv�ra� odpovede';
		$this->perms_post_delete = 'Maza� lubovo�n� pr�spevok';
		$this->perms_post_delete_own = 'Maza� iba vlastn� pr�spevky';
		$this->perms_post_edit = 'Editova� lubovo�n� pr�spevok';
		$this->perms_post_edit_own = 'Editova� iba vlastn� pr�spevky';
		$this->perms_post_inc_userposts = 'Posts contribute to user\'s total post count'; //Translate
		$this->perms_post_noflood = 'Vy�a� z kontroly zahltenosti pr�spevkov';
		$this->perms_post_viewip = 'Zobrazova� IP adresu u��vate�ov';
		$this->perms_search_noflood = 'Vy�a� z kontroly	zahltenosti vyhlad�vania';
		$this->perms_title = 'Nastavenia u��vate�skej skupiny';
		$this->perms_topic_create = 'Vytv�ranie t�m';
		$this->perms_topic_delete = 'Mazanie �ubovo�nej t�my';
		$this->perms_topic_delete_own = 'Mazanie vlastn�ch t�m';
		$this->perms_topic_edit = 'Editova� �ubovo�n� t�mu';
		$this->perms_topic_edit_own = 'Editova� iba vlastn� t�my';
		$this->perms_topic_global = 'Zap�na� zobrazenie t�my vo v�etk�ch f�rach';
		$this->perms_topic_lock = 'Zamykanie �ubovo�n�ch t�m';
		$this->perms_topic_lock_own = 'Zamykanie iba vlastn�ch t�m';
		$this->perms_topic_move = 'Pres�vanie �ubovo�n�ch t�m';
		$this->perms_topic_move_own = 'Pres�vanie iba vlastn�ch t�m';
		$this->perms_topic_pin = 'Pri�pendlenie �ubovo�nej t�my';
		$this->perms_topic_pin_own = 'Pri�pendlenie iba vlastn�ch t�m';
		$this->perms_topic_publish = 'Publish or unpublish any topic'; //Translate
		$this->perms_topic_publish_auto = 'New topics are marked as published'; //Translate
		$this->perms_topic_split = 'Rozde�ovanie �ubovo�nej t�my na viacer� t�my';
		$this->perms_topic_split_own = 'Rozde�ovanie iba vlastn�ch t�m na viacer� t�my';
		$this->perms_topic_unlock = 'Odomykanie �ubovo�n�ch t�m';
		$this->perms_topic_unlock_mod = 'Odomykanie z�mku moder�tora';
		$this->perms_topic_unlock_own = 'Odomykanie iba	vlastn�ch z�mkov';
		$this->perms_topic_unpin = 'Od�pendlenie �ubovo�n�ch t�m';
		$this->perms_topic_unpin_own = 'Od�pendlenie iba vlastn�ch t�m';
		$this->perms_topic_view = 'Prezeranie t�m';
		$this->perms_topic_view_unpublished = 'View unpublished topics'; //Translate
		$this->perms_updated = 'Pr�va boli zaktualizovan�.';
		$this->perms_user_inherit = 'U��vate� zded� pr�va skupiny.';
	}

	function php_info()
	{
		$this->php_error = 'Error'; //Translate
		$this->php_error_msg = 'phpinfo() sa ned� zavola�. Pravdepodobne je t�to funkcia zak�zana.';
	}

	function pm()
	{
		$this->pm_avatar = 'Avatar'; //Translate
		$this->pm_cant_del = 'Nem�te povolenie zmaza� tento odkaz.';
		$this->pm_delallmsg = 'Zmaza� v�etky odkazy';
		$this->pm_delete = 'Zmaza�';
		$this->pm_delete_selected = 'Zmaza� ozna�en� spr�vy';
		$this->pm_deleted = 'Odkaz bol zmazan�.';
		$this->pm_deleted_all = 'Odkazy boli zmazan�.';
		$this->pm_error = 'Pri zasielan� mailu niektor�m
	adres�tom sa vyskytli probl�my.<br /><br />Nasleduj�ci u��vatelia neexistuj�: %s<br /><br />Nasleduj�ci u��vatelia neprij�maj� odkazy: %s';
		$this->pm_fields = 'V� odkaz sa ned� posla�. Uistite sa, �e ster vyplnili v�etky povinn� polia.';
		$this->pm_flood = 'Za posledn�ch %s sek�nd ste poslali pr�spevok a moment�lne nem��ete posla� dal��.<br /><br />Pros�m, sk�ste to za nieko�ko sek�nd znovu.';
		$this->pm_folder_inbox = 'Prijat�';
		$this->pm_folder_new = '%s nov�';
		$this->pm_folder_sentbox = 'Odoslan�';
		$this->pm_from = 'Odosielate�:';
		$this->pm_group = 'Skupina';
		$this->pm_guest = 'Ako n�v�tevn�k (guest) nem�te povolenie pou��va� odkazova�. Pros�m nalogujte sa alebo sa zaregistrujte.. alebo sa dajte vypcha�.';
		$this->pm_joined = 'Registr�cia';
		$this->pm_messenger = 'Odkazova�';
		$this->pm_msgtext = 'Text odkazu';
		$this->pm_multiple = 'Viacer�ch adres�tov odde�te znakom ;';
		$this->pm_no_folder = 'Mus�te zada� adres�r.';
		$this->pm_no_member = 'Tak�to ID nem� �iadny �len.';
		$this->pm_no_number = 'Tak�to ��slo nem� �iadny odkaz.';
		$this->pm_no_title = 'Ch�ba predmet';
		$this->pm_nomsg = 'V tomto adres�ri nie s� �iadne odkazy.';
		$this->pm_noview = 'Nem�te povolenie prezera� si tento odkaz.';
		$this->pm_offline = 'Tento u��vate� je moment�lne offline';
		$this->pm_online = 'Tento u��vate� je moment�lne online';
		$this->pm_personal = 'Odkazova�';
		$this->pm_personal_msging = 'Posielanie odkazu';
		$this->pm_pm = 'Odkaz';
		$this->pm_posts = 'Pr�spevky';
		$this->pm_preview = 'N�h�ad';
		$this->pm_recipients = 'Adres�ti';
		$this->pm_reply = 'Odpoveda�';
		$this->pm_send = 'Posla�';
		$this->pm_sendamsg = 'Posla� odkaz';
		$this->pm_sendingpm = 'Posielanie odkazu';
		$this->pm_sendon = 'Odoslan� v';
		$this->pm_success = 'V� odkaz bol �spe�ne zaslan�.';
		$this->pm_sure_del = 'Ur�ite chcete zmaza� tento odkaz?';
		$this->pm_sure_delall = 'Ur�ite chcete zmaza� v�etky odkazy v tomto adres�ri?';
		$this->pm_title = 'Nadpis';
		$this->pm_to = 'Komu';
	}

	function post()
	{
		$this->post_attach = 'Pr�lohy';
		$this->post_attach_add = 'Prida� pr�lohu';
		$this->post_attach_disrupt = 'Prid�vanie alebo uberanie pr�loh nenaru�� V� pr�spevok.';
		$this->post_attach_failed = 'Upload pr�lohy neuspel. S�bor, ktor� ste �pecifikovali asi neexistuje.';
		$this->post_attach_not_allowed = 'S�bory tohoto typu nemo�no prilo�i�.';
		$this->post_attach_remove = 'Odobra� pr�lohu';
		$this->post_attach_too_large = '�pecifikovan� s�bor je prive�k�. Maxim�lna povolen� ve�kos� je %d kB.';
		$this->post_cant_create = 'Ako n�v�tevn�k (guest) nem�te povolenie zaklada� t�my. Ak sa zaregistrujete, mo�no budete ma�.';
		$this->post_cant_create1 = 'Nem�te povolenie zaklada� t�my.';
		$this->post_cant_enter = 'Va�e hlasovanie je neplatn�. bu� ste o tejto ot�zke u� hlasovali alebo nem�te povolenie hlasova�.';
		$this->post_cant_poll = 'Ako n�v�tevn�k (guest) nem�te povolenie zaklada� hlasovania. Ak sa zaregistrujete, mo�no budete ma�.';
		$this->post_cant_poll1 = 'Nem�te povolenie zaklada� hlasovania.';
		$this->post_cant_reply = 'Nem�te povolenie odpoveda� na t�my pod t�mto f�rom.';
		$this->post_cant_reply1 = 'Ako n�v�tevn�k (guest) nem�te povolenie odpoveda� na t�my. Ak sa zaregistrujete, mo�no budete ma�.';
		$this->post_cant_reply2 = 'Nem�te povolenie odpoveda� na t�my.';
		$this->post_closed = 'T�ma bola uzavret�.';
		$this->post_create_poll = 'Zalo�i� hlasovanie';
		$this->post_create_topic = 'Zalo�i� t�mu';
		$this->post_creating = 'Zalo�enie t�my';
		$this->post_creating_poll = 'Zalo�enie hlasovania';
		$this->post_flood = 'Poslali ste pr�spevok v priebehu uplynul�ch %s sek�nd a pr�ve teraz asi nebude mo�n� znova prispie�.<br /><br />Pros�m, sk�ste to znova za nieko�ko sek�nd.';
		$this->post_guest = 'Hos�';
		$this->post_icon = 'Ikona pr�spevku';
		$this->post_last_five = 'Posledn�ch p� pr�spevkov v opa�nom porad�';
		$this->post_length = 'Kontrola d�ky';
		$this->post_msg = 'Pr�spevok';
		$this->post_must_msg = 'Mus�te e�te nap�sa� samotn� odkaz.';
		$this->post_must_options = 'Mus�te zada� mo�n� odpovede pre nov� hlasovanie.';
		$this->post_must_title = 'Mus�te zada� nadpis pre nov� t�mu.';
		$this->post_new_poll = 'Nov� hlasovanie';
		$this->post_new_topic = 'Nov� t�ma';
		$this->post_no_forum = 'Toto f�rum sa nena�lo.';
		$this->post_no_topic = 'Ne�pecifikovali ste t�mu.';
		$this->post_no_vote = 'Ak chcete hlasova�, je vhodn� zvoli� si odpove�.';
		$this->post_option_emoticons = 'Konvertova� textov� smajl�ky na obr�zky?';
		$this->post_option_global = 'Globalizova� t�to t�mu?';
		$this->post_option_mbcode = 'Interpretova� Mb-k�d?';
		$this->post_optional = 'nepovinn�';
		$this->post_options = 'Mo�nosti';
		$this->post_poll_options = 'Mo�nosti hlasovania';
		$this->post_poll_row = 'Jeden na riadok';
		$this->post_posted = 'Zaslan�: ';
		$this->post_posting = 'Posiela sa';
		$this->post_preview = 'N�h�ad';
		$this->post_reply = 'Odpoveda�';
		$this->post_reply_topic = 'Odpoveda� na t�mu';
		$this->post_replying = 'Odpoved� sa na t�mu';
		$this->post_replying1 = 'Odpoved� sa';
		$this->post_too_many_options = 'Hlasovanie mus� ma� minim�lne 2 a maxim�lne %d mo�n�ch odpoved�.';
		$this->post_topic_detail = 'Popis t�my';
		$this->post_topic_title = 'Nadpis t�my';
		$this->post_view_topic = 'Uk�za� cel� t�mu';
		$this->post_voting = 'Hlasuje sa';
	}

	function printer()
	{
		$this->printer_back = 'Sp�';
		$this->printer_not_found = 'T�ma sa nena�la. Mo�no bola zmazan�, presunut� alebo v�bec nebola.';
		$this->printer_not_found_title = 'T�ma sa nena�la';
		$this->printer_perm_topics = 'Nem�te povolenie na prezeranie t�m.';
		$this->printer_perm_topics_guest = 'Nem�te povolenie na prezeranie t�m. Ak sa zaregistrujete, mo�no budete ma�.';
		$this->printer_posted_on = 'Zaslan�: ';
		$this->printer_send = 'Odosla� na tla�iare�';
	}

	function profile()
	{
		$this->profile_aim_sn = 'AIM Name'; //Translate
		$this->profile_av_sign = 'Avatar a podpis';
		$this->profile_avatar = 'Avatar'; //Translate
		$this->profile_bday = 'Narodeniny';
		$this->profile_contact = 'Kontakt';
		$this->profile_email_address = 'Emailov� adresa';
		$this->profile_fav = 'Ob��ben� f�rum';
		$this->profile_fav_forum = '%s (%d%% pr�spevkov tohoto u��vate�a)';
		$this->profile_gtalk = 'GTalk konto';
		$this->profile_icq_uin = 'ICQ Number'; //Translate
		$this->profile_info = 'Inform�cie';
		$this->profile_interest = 'Z�uby';
		$this->profile_joined = 'Registr�cia';
		$this->profile_last_post = 'Najnov�� pr�spevok';
		$this->profile_list = 'Zoznam �lenov';
		$this->profile_location = 'S�dlo';
		$this->profile_member = 'Skupina �lenov';
		$this->profile_member_title = 'Titul �lena';
		$this->profile_msn = 'MSN Identity'; //Translate
		$this->profile_must_user = 'Ak si chcete prezrie� profil, mus�te �pecifikova� u�ivate�a.';
		$this->profile_no_member = 'S tak�mto ID nem�me �iadneho u��vate�a. Mo�no bolo toto konto zru�en�.';
		$this->profile_none = '[ pr�zdne ]';
		$this->profile_not_post = 'e�te sa to nezaslalo.';
		$this->profile_offline = 'Tento u��vate� je moment�lne offline';
		$this->profile_online = 'Tento u��vate� je moment�lne online';
		$this->profile_pm = 'Odkazy';
		$this->profile_postcount = '%s celkovo, %s denne';
		$this->profile_posts = 'Pr�spevky';
		$this->profile_private = '[ Zatajen� ]';
		$this->profile_profile = 'Profil';
		$this->profile_signature = 'Podpis';
		$this->profile_unkown = '[ Nezn�mo ]';
		$this->profile_view_profile = 'Prezeranie profilu';
		$this->profile_www = 'Homepage'; //Translate
		$this->profile_yahoo = 'Yahoo Identity'; //Translate
	}

	function prune()
	{
		$this->prune_action = 'Sp�sob prerie�ovania';
		$this->prune_age_day = '1 De�';
		$this->prune_age_eighthours = '8 Hod�n';
		$this->prune_age_hour = '1 Hod�na';
		$this->prune_age_month = '1 Mesiac';
		$this->prune_age_threemonths = '3 Mesiace';
		$this->prune_age_week = '1 T��de�';
		$this->prune_age_year = '1 Rok';
		$this->prune_forums = 'Vyberte f�rum na preriedenie';
		$this->prune_invalidage = 'Bol zvolen� neplatn� vek na preriedenie';
		$this->prune_move = 'Presun��';
		$this->prune_moveto_forum = 'Cie�ov� f�rum presunu';
		$this->prune_nodest = 'Nebol vybran� platn� cie�';
		$this->prune_notopics = 'Neboli vybran� �iadne t�my na preriedenie';
		$this->prune_notopics_old = '�iadna t�me nie je dostato�ne star� na preriedenie';
		$this->prune_novalidforum = 'Nebolo vybran� platn� f�rum na preriedenie';
		$this->prune_select_age = 'Vyberte vek t�m, ktor� bude limitova� preriedenie';
		$this->prune_select_topics = 'Vyberte t�my na preriedenie alebo pou�ite Vybra� V�etko';
		$this->prune_success = 'T�my boli prerieden�';
		$this->prune_title = 'Prerie�ova� t�m';
		$this->prune_topics_older_than = 'Preriedi� t�my star�ie ako';
	}

	function query()
	{
		$this->query = 'Rozhranie pre mysql dotazy';
		$this->query_fail = 'zlyhal.';
		$this->query_success = '�spe�ne vykonan�.';
		$this->query_your = 'V� dotaz';
	}

	function recent()
	{
		$this->recent_active = 'Akt�vne t�my od poslednej n�v�tevy';
		$this->recent_by = 'Nap�sal';
		$this->recent_can_post = 'V tomto f�re m��ete odpoveda�.';
		$this->recent_can_topics = 'V tomto f�re si m��ete prezera� t�my.';
		$this->recent_cant_post = 'V tomto f�re nem�te povolenie odpoveda�.';
		$this->recent_cant_topics = 'V tomto f�re nem�te povolenie prezera� t�my.';
		$this->recent_dot = 'dot(to �o je?)';
		$this->recent_dot_detail = 'ukazuje, �e ste pod dan� t�mu prispeli';
		$this->recent_forum = 'F�rum';
		$this->recent_guest = 'Hos�';
		$this->recent_hot = 'd�le�it�';
		$this->recent_icon = 'Ikona spr�vy';
		$this->recent_jump = 'Hop na najnov�ie pr�spevky pod touto t�mou';
		$this->recent_last = 'Najnov�� pr�spevok';
		$this->recent_locked = 'Zamknut�';
		$this->recent_moved = 'Presunut�';
		$this->recent_msg = '%s Spr�va';
		$this->recent_new = 'nov�';
		$this->recent_new_poll = 'Zalo�i� nov� hlasovanie';
		$this->recent_new_topic = 'Zalo�i� nov� t�mu';
		$this->recent_no_topics = 'V tomto f�re nie s� �iadne t�my.';
		$this->recent_noexist = 'Zadan� f�rum neexistuje.';
		$this->recent_nopost = 'Nie s� pr�spevky';
		$this->recent_not = 'm�lo';
		$this->recent_noview = 'Nem�te povolenie na prezeranie f�r.';
		$this->recent_pages = 'Str�nky';
		$this->recent_pinned = 'Pri�pendlen�';
		$this->recent_pinned_topic = 'Pri�pendlen� t�ma';
		$this->recent_poll = 'Hlasovanie';
		$this->recent_regfirst = 'Nem�te povolenie na prezeranie f�r. Ak sa zaregistrujete, mo�no budete ma?.';
		$this->recent_replies = 'Odpovede';
		$this->recent_starter = 'Zakladate�';
		$this->recent_sub = 'Pod-F�rum';
		$this->recent_sub_last_post = 'Najnov�� pr�spevok';
		$this->recent_sub_replies = 'Odpovede';
		$this->recent_sub_topics = 'T�my';
		$this->recent_subscribe = 'Posla� emailom nov� pr�spevky v tomto f�re';
		$this->recent_topic = 'T�ma';
		$this->recent_views = 'Viden�';
		$this->recent_write_topics = 'V tomto f�re m�te povolenie zaklada� t�my.';
	}

	function register()
	{
		$this->register_activated = 'Va�e konto bolo aktivovan�!';
		$this->register_activating = 'Aktiv�cia konta';
		$this->register_activation_error = 'Aktivovanie Va�eho konta zlyhalo. Skontrolujte, �i je vo Va�om prehliada�i pl� URL cesta z aktiva�n�ho emailu. Ak probl�m zotrv�va, skontaktujte sa s administr�torom f�ra.';
		$this->register_confirm_passwd = 'Potvrdenie hesla';
		$this->register_done = 'Boli ste zaregistrovan�! Teraz sa m��ete nalogova�.';
		$this->register_email = 'Emailov� adresa';
		$this->register_email_invalid = 'Zadan� emailov� adresa je neplatn�.';
		$this->register_email_msg = 'Toto je automatick� email, vygenerovan� Quicksilver F�rom a bol V�m zasladn� z titulu';
		$this->register_email_msg2 = 'pre V�s, kv�li aktiv�cii konta s';
		$this->register_email_msg3 = 'Pros�m, kliknite na nasleduj�ci link alebo ho skop�rujte do Va�eho web browsera:';
		$this->register_email_used = 'Zadan� emailov� adresa u� bola pridelen� in�mu �lenovi.';
		$this->register_fields = 'Neboli vyplnen� v�etky polia.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = 'Pros�m nap�te text, ktor� je na obr�zku.';
		$this->register_image_invalid = 'Kv�li obmedzeniu automatizovan�ho registrovania mus�te op�sa� text, ktor� vid�te na obr�zku.';
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'Boli ste zaregistrovan�. Na adresu %s bol zaslan� email s inform�ciami oo aktiv�cii Va�eho konta. Va�e konto bude obmedzen�, pokia� si ho neaktivujete.';
		$this->register_name_invalid = 'Zadan� meno je pridlh�.';
		$this->register_name_taken = 'Toto �lensk� meno je u� obsaden�.';
		$this->register_new_user = '�elan� �lensk� meno';
		$this->register_pass_invalid = 'Zadan� heslo je neplatn�. Uistite sa, �e pou��vate len platn� znaky ako s� p�smen�, ��sla, poml�ka, podtr��tko alebo medzera a obsahuje aspo� 5 znakov.';
		$this->register_pass_match = 'Hesl�, ktor� ste zadali sa nezhoduj�.';
		$this->register_passwd = 'Heslo';
		$this->register_reg = 'Registr�cia';
		$this->register_reging = 'Prebieha registr�cia';
		$this->register_requested = 'Account activation request for:'; //Translate
		$this->register_tos = 'Podmienky pou��vania';
		$this->register_tos_i_agree = 'S�hlas�m s vy��ie formulovan�mi podmienkami';
		$this->register_tos_not_agree = 'Nes�hlasili ste s podmienkami.';
		$this->register_tos_read = 'Pros�m, pre��tajte si nasleduj�ce podmienky poskytovania slu�ieb';
	}

	function rssfeed()
	{
		$this->rssfeed_cannot_find_forum = 'The forum does not appear to exist'; //Translate
		$this->rssfeed_cannot_find_topic = 'The topic does nto appear to exist'; //Translate
		$this->rssfeed_cannot_read_forum = 'You do not have permission to read this forum'; //Translate
		$this->rssfeed_cannot_read_topic = 'You do not have permission to read this topic'; //Translate
		$this->rssfeed_error = 'Error'; //Translate
		$this->rssfeed_forum = 'Forum:'; //Translate
		$this->rssfeed_posted_by = 'Autor:';
		$this->rssfeed_topic = 'Topic:'; //Translate
	}

	function search()
	{
		$this->search_advanced = '�al�ie mo�nosti';
		$this->search_avatar = 'Avatar'; //Translate
		$this->search_basic = 'Z�kladn� vyh�ad�vanie';
		$this->search_characters = 'znakov z pr�spevku';
		$this->search_day = 'de�';
		$this->search_days = 'dni';
		$this->search_exact_name = 'presn� n�zov';
		$this->search_flood = 'V priebehu posledn�ch %s sek�nd ste pou�ili vyh�ad�vanie a moment�lne nem��ete vyh�ad�va� znovu.<br /><br />Pros�m, sk�ste to o nieko�ko sek�nd.';
		$this->search_for = 'H�ada�';
		$this->search_forum = 'F�rum';
		$this->search_group = 'Skupina';
		$this->search_guest = 'Hos�';
		$this->search_in = 'H�ada� v';
		$this->search_in_posts = 'H�ada� iba v pr�spevkoch';
		$this->search_ip = 'IP'; //Translate
		$this->search_joined = 'Registr�cia';
		$this->search_level = '�rove� u��vate�a';
		$this->search_match = 'H�adanie (presn� zhoda)';
		$this->search_matches = 'N�lezy';
		$this->search_month = 'mesiac';
		$this->search_months = 'mesiace';
		$this->search_mysqldoc = 'MySQL Dokument�cia';
		$this->search_newer = 'nov��ch';
		$this->search_no_results = 'Va�e h�adanie dopadlo bezv�sledne.';
		$this->search_no_words = 'Ak chcete vyh�ad�va�, mus�te zada� nejak� slov�.<br /><br />Ka�d� slovo mus� ma� viac ako 3 znaky vr�tane p�smen, ��siel, apostrofov a podtr��tok.';
		$this->search_offline = 'Tento u��vate� je moment�lne offline';
		$this->search_older = 'star��ch';
		$this->search_online = 'tento u��vate� je moment�lne online.';
		$this->search_only_display = 'Zobrazi� len prv�ch';
		$this->search_partial_name = '�iasto�n� n�zov name';
		$this->search_post_icon = 'Ikona pr�spevku';
		$this->search_posted_on = 'Zaslan�: ';
		$this->search_posts = 'Pr�spevky';
		$this->search_posts_by = 'Len pr�spevky od u��vate�a';
		$this->search_regex = 'H�ada� pomocou regul�rnych v�razov';
		$this->search_regex_failed = 'V� regul�rny v�raz neuspel. Pros�m prezrite si MySQL documentation, sta� o regul�rnych v�razoch.';
		$this->search_relevance = 'Platnos� pr�spevku: %d%%';
		$this->search_replies = 'Pr�spevky';
		$this->search_result = 'V�sledky h�adania';
		$this->search_search = 'Za�a� h�adanie';
		$this->search_select_all = 'ka�dom';
		$this->search_show_posts = 'Zobrazi� odpovedaj�ce pr�spevky';
		$this->search_sound = 'H�ada� pod�a zvuku (sound)';
		$this->search_starter = 'Zakladate�';
		$this->search_than = 'ako';
		$this->search_topic = 'T�ma';
		$this->search_unreg = 'Nezaregistrovan�';
		$this->search_week = 't��de�';
		$this->search_weeks = 't��dne';
		$this->search_year = 'rok';
	}

	function settings()
	{
		$this->settings = 'Nastavenia';
		$this->settings_active = 'Nastavenia akt�vnych u��vate�ov';
		$this->settings_allow = 'Povoli�';
		$this->settings_antibot = 'Anti-Robot Registr�cia';
		$this->settings_attach_ext = 'Pr�lohy - pr�pony s�borov';
		$this->settings_attach_one_per = 'Ka�d� na samostatnom riadku, bez bodiek.';
		$this->settings_avatar = 'Nastavenia Avatara';
		$this->settings_avatar_flash = 'Flash Avatari';
		$this->settings_avatar_max_height = 'Maxim�lna v��ka Avatara';
		$this->settings_avatar_max_width = 'Maxim�lna ��rka Avatara';
		$this->settings_avatar_upload = 'Uploadovan� Avatari - maxim�lna ve�kost s�boru';
		$this->settings_basic = 'Editova� nastavenia f�r';
		$this->settings_blank = 'Pre nov� okno pou�ite <i>_blank</i>.';
		$this->settings_board_enabled = 'F�rum je pr�stupn�';
		$this->settings_board_location = 'Adresa f�ra';
		$this->settings_board_name = 'N�zov f�ra';
		$this->settings_board_rss = 'Nastavenia RSS Feed';
		$this->settings_board_rssfeed_desc = 'Popis RSS Feed';
		$this->settings_board_rssfeed_posts = 'Po�et pr�spevkov, obsiahnut�ch v RSS Feed';
		$this->settings_board_rssfeed_time = 'Frekvencia obnovovania v min�tach';
		$this->settings_board_rssfeed_title = 'N�zov RSS Feed';
		$this->settings_clickable = 'Kliknute�n� smajl�ky na jeden riadok';
		$this->settings_cookie = 'Nastavenia Cookie a controly zahltenia';
		$this->settings_cookie_path = 'Cesta pre Cookie';
		$this->settings_cookie_prefix = 'Predpona pre Cookie';
		$this->settings_cookie_time = 'Doba platnosti prihl�senia';
		$this->settings_db = 'Editova� nastavenia pripojenia';
		$this->settings_db_host = 'Datab�zov� server (Host)';
		$this->settings_db_leave_blank = 'Nechajte pr�zdne v pr�pade absencie.';
		$this->settings_db_multiple = 'Pre in�tal�ciu viacer�ch f�r do jednej datab�zy.';
		$this->settings_db_name = 'N�zov Datab�zy';
		$this->settings_db_password = 'Heslo do Datab�zy';
		$this->settings_db_port = 'Port pripojenia k Datab�za';
		$this->settings_db_prefix = 'Predpona Tabuliek';
		$this->settings_db_socket = 'Socket Datab�zy';
		$this->settings_db_username = 'Meno u��vate�a pre pripojenie k Datab�ze';
		$this->settings_debug_mode = 'Debug Mode'; //Translate
		$this->settings_default_lang = 'Prednastaven� Jazyk';
		$this->settings_default_no = 'Prednastavi� NIE';
		$this->settings_default_skin = 'Prednastaven� Skin';
		$this->settings_default_yes = 'Prednastavi� �NO';
		$this->settings_disabled = 'Nepr�stupn�';
		$this->settings_disabled_notice = 'Pozn�mka o nepr�stupnosti';
		$this->settings_email = 'Nastavenia E-Mailu';
		$this->settings_email_fake = 'Zobrazovan� email. Toto by nemala by� skuto�n� emailov� adresa.';
		$this->settings_email_from = 'E-mail odosielate�a';
		$this->settings_email_place1 = 'Umiestni� u��vate�ov do';
		$this->settings_email_place2 = 'skupiny, dokia� neoveria platnos� svojej emailovej adresy';
		$this->settings_email_place3 = 'Nevy�adova� aktiv�ciu emailom';
		$this->settings_email_real = 'Toto by nemala by� skuto�n� e-mailov� adresa.';
		$this->settings_email_reply = 'E-mail pre odpove� (odosielate�)';
		$this->settings_email_smtp = 'SMTP Po�tov� Server';
		$this->settings_email_valid = 'Overenie  E-mailu nov�ho u��vate�a';
		$this->settings_enabled = 'Pr�stupn�';
		$this->settings_enabled_modules = 'Povolen� Moduly';
		$this->settings_foreign_link = 'Link, nasmerovan� na cudz� server';
		$this->settings_general = 'Obecn� Nastavenia';
		$this->settings_group_after = 'Skupina po zaregistrovan�';
		$this->settings_hot_topic = 'Pr�spevky na hor�cu t�mu';
		$this->settings_kilobytes = 'Kilobajtov';
		$this->settings_max_attach_size = 'Pr�loha - maxim�lna ve�kos� s�boru';
		$this->settings_members = 'Nastavenia u��vate�ov';
		$this->settings_modname_only = 'Iba n�zvy Modulov. Bez pr�pony .php';
		$this->settings_new = 'New Setting'; //Translate
		$this->settings_new_add = 'Add Board Setting';
		$this->settings_new_added = 'New settings added.'; //Translate
		$this->settings_new_exists = 'That setting already exists. Choose another name for it.'; //Translate
		$this->settings_new_name = 'New setting name'; //Translate
		$this->settings_new_required = 'The new setting name is required.'; //Translate
		$this->settings_new_value = 'New setting value'; //Translate
		$this->settings_no_allow = 'Zak�za�';
		$this->settings_nodata = 'Met�doo POST neboli poslan� �iadne data';
		$this->settings_one_per = 'Ka�d� na samostatn� riadok';
		$this->settings_pixels = 'Pixlov';
		$this->settings_pm_flood = 'Kontrola zahltenosti osobn�ho odkazova�a';
		$this->settings_pm_min_time = 'Minim�lny �as medzi dvoma nasleduj�cimi odkazmi.';
		$this->settings_polls = 'Hlasovania';
		$this->settings_polls_no = 'U��vatelia nem��u hlasova� po zhliadnut� v�sledkov hlasovania';
		$this->settings_polls_yes = 'U��vatelia m��u hlasova� po zhliadnut� v�sledkov hlasovania';
		$this->settings_post_flood = 'Kontrola zahltenia pr�spevkov';
		$this->settings_post_min_time = 'Minim�lny �as medzi dvoma nasleduj�cimi pr�spevkami.';
		$this->settings_posts_topic = 'Po�et pr�spevkov na jednu str�nku t�my';
		$this->settings_search_flood = 'Kontrola zahltenia vyh�ad�vania';
		$this->settings_search_min_time = 'Minim�lny �as medzi dvoma nasleduj�cimi vyh�ad�vaniami.';
		$this->settings_server = 'Nastavenia Servera';
		$this->settings_server_gzip = 'GZIP Kompresia';
		$this->settings_server_gzip_msg = 'Zvy�uje r�chlos�. Zak�te t�to vlasnost, pokia� sa f�rum nezobrazuje spr�vne alebo v�bec.';
		$this->settings_server_maxload = 'Maxim�lna Z�a� Servera';
		$this->settings_server_maxload_msg = 'Znepr�stupni� f�rum pri mimoriadnom za�a�en� servera. Zadajte 0 pre vypnutie tejto vlastnosti.';
		$this->settings_server_timezone = '�asov� P�smo Servera';
		$this->settings_show_avatars = 'Zobrazova� Avatarov';
		$this->settings_show_email = 'Zobrazova� Emailov� Adresy';
		$this->settings_show_emotes = 'Zobrazova� smajl�ky';
		$this->settings_show_notice = 'Zobrazova� f�rum, ak je znepr�stupnen�';
		$this->settings_show_pm = 'Prij�ma� osobn� odkazy';
		$this->settings_show_sigs = 'Zobrazova� Podpisy';
		$this->settings_spider_agent = 'Spider User Agent'; //Translate
		$this->settings_spider_agent_msg = 'Zadajte cel� alebo iba �as� unik�tnej premennej HTTP USER AGENT spidera.';
		$this->settings_spider_enable = 'Povoli� zobrazenia Spidera';
		$this->settings_spider_enable_msg = 'Povoli� n�zvy vyh�ad�vac�ch spiderov v zozname akt�vnych u��vate�ov.';
		$this->settings_spider_name = 'N�zov Spidera';
		$this->settings_spider_name_msg = 'Zadajte n�zov, ktor� sa bude zobrazova� pre ka�d�ho z vy��ie definovan�ch spiderov v zozname akt�vnych u��vate�ov. Mus�te umiestni� n�zov spidera na ten ist� riadok, ako spider user agent, definovan� vy��ie. Napr�klad ak umiestn�te \'googlebot\' do tretieho riadku v agentoch, umiestnite \'Google\' do tretieho riadku v n�zvoch Spiderov.';
		$this->settings_timezone = '�asov� P�smo';
		$this->settings_topics_page = 'Po�et t�m na jednej str�nke f�ra';
		$this->settings_tos = 'Podmienky Pou�itia';
		$this->settings_updated = 'Nastavenia boli zaktualizovan�.';
	}

	function stats()
	{
		$this->stats = '�tatistick� Centrum';
		$this->stats_post_by_month = 'Po�et pr�spevkov na mesiac';
		$this->stats_reg_by_month = 'Po�et registr�ci� na mesiac';
	}

	function templates()
	{
		$this->add = 'Prida� HTML �abl�ny';
		$this->add_in = 'Prida� �abl�nu na:';
		$this->all_fields_required = 'Mus�te vyplni� v�etky polia, aby bola pridan� �abl�na';
		$this->choose_css = 'Choose CSS Template'; //Translate
		$this->choose_set = 'Zvoli� sadu �abl�n';
		$this->choose_skin = 'Zvo�i� skin';
		$this->confirm1 = 'Chyst�te sa zmaza�';
		$this->confirm2 = '�abl�na od';
		$this->create_new = 'Zalo�i� nov� skin s n�zvom';
		$this->create_skin = 'Zalo�i� Skin';
		$this->credit = 'Pros�m, neodstra�ujte n� jedin� kredit!';
		$this->css_edited = 'CSS file has been updated.'; //Translate
		$this->css_fioerr = 'The file could not be written to, you will need to CHMOD the file manually.'; //Translate
		$this->delete_template = 'Zmaza� �abl�nu';
		$this->directory = 'Adres�r';
		$this->display_name = 'Zobrazi� n�zov';
		$this->edit_css = 'Edit CSS'; //Translate
		$this->edit_skin = 'Editova� Skin';
		$this->edit_templates = 'Editova� �abl�nu';
		$this->export_done = 'Skin bol exportovan� do hlavn�ho adres�ra Quicksilver F�ra.';
		$this->export_select = 'Vyberte skin, ktor� chcete exportova�';
		$this->export_skin = 'Exportova� Skin';
		$this->install_done = 'Skin bol �spe�ne nain�talovan�.';
		$this->install_exists1 = 'Tento skin je pravdepodobne';
		$this->install_exists2 = 'u� je nain�talovan�.';
		$this->install_overwrite = 'Prep�sa�';
		$this->install_skin = 'Nain�talova� Skin';
		$this->menu_title = 'Zvo�te sekciu �abl�ny, ktor� chcete editova�';
		$this->no_file = 'No such file.'; //Translate
		$this->only_skin = 'Moment�lne je nain�talovan� iba jeden skin. Tento skin nesmiete zmaza�.';
		$this->or_new = 'Alebo vytvori� nov� skupinu �abl�n s n�zvom:';
		$this->select_skin = 'Zvo�te Skin';
		$this->select_skin_edit = 'Zvo�te skin, ktor� chcete editova�';
		$this->select_skin_edit_done = 'Skin bol �spe�ne zeditovan�.';
		$this->select_template = 'Zvo�te �abl�nu';
		$this->skin_chmod = 'NOv� adres�r pre skin sa nepodarilo vytvori�. Sk�ste pr�kaz CHMOD adres�r skinu 775.';
		$this->skin_created = 'Skin bol vytvoren�.';
		$this->skin_deleted = 'Skin bo �spe�ne zmazan�.';
		$this->skin_dir_name = 'Mus�et zada� n�zov skinu a adres�ra.';
		$this->skin_dup = 'Skin s rovnak�m n�zvom adres�ra u� existuje. N�zov adres�ra skinu bol zmenen� na';
		$this->skin_name = 'Mus�te zada� n�zov skinu.';
		$this->skin_none = 'Neexistuj� �iadne nain�talovate�n� skiny.';
		$this->skin_set = 'Sada Skinov';
		$this->skins_found = 'Nasleduj�ce skiny sa nach�dzaj� v adres�ri Quicksilver F�ra';
		$this->template_about = 'O premenn�ch';
		$this->template_about2 = 'Premenn� s� �asti textu, ktor� s� nahr�dzan� dynamick�mi datami. Premen� sa v�dy za��naj� znakom dol�r a niekedy s� obhrani�en� {z�tvorkami}.';
		$this->template_add = 'Prida�';
		$this->template_added = '�abl�na bola pridan�.';
		$this->template_clear = 'Vy�isti�';
		$this->template_confirm = '�abl�ny boli modifikovan�. Chcete tieto zmeny zap�sa�?';
		$this->template_description = 'Popis �abl�ny';
		$this->template_html = 'HTML �abl�na';
		$this->template_name = 'N�zov �abl�ny';
		$this->template_position = 'Poz�cia �abl�ny';
		$this->template_set = 'Sada �abl�n';
		$this->template_title = 'Nadpis �abl�ny';
		$this->template_universal = 'Univerz�lna Premenn�';
		$this->template_universal2 = 'Niektor� premenn� m��u by� pou�it� v lubovo�nej �ablone, zatia� �o ostatn� s� platn� len v jednej �abl�ne. Vlastnosti objektu $this m��u by� pou�ite v�ade.';
		$this->template_updated = '�ablona bola zaktualizovan�.';
		$this->templates = '�ablony';
		$this->temps_active = 'Detaily akt�vneho u��vate�a';
		$this->temps_admin = '<b>AdminCP Universal</b>'; //Translate
		$this->temps_ban = 'AdminCP Blokovania';
		$this->temps_board_index = 'Index F�r';
		$this->temps_censoring = 'AdminCP Cenz�ra Slov';
		$this->temps_cp = 'Ovl�dac� panel u��vate�a';
		$this->temps_email = 'Posa� Email U��vate�ovi';
		$this->temps_emot_control = 'AdminCP Smajl�ky';
		$this->temps_forum = 'F�ra';
		$this->temps_forums = 'AdminCP F�ra';
		$this->temps_groups = 'AdminCP Skupiny';
		$this->temps_help = 'Help'; //Translate
		$this->temps_login = 'Prihlasovanie a Odhlasovanie';
		$this->temps_logs = 'AdminCP Moderator Logs'; //Translate
		$this->temps_main = '<b>Board Universal</b>'; //Translate
		$this->temps_mass_mail = 'AdminCP Hromadn� Mail';
		$this->temps_member_control = 'AdminCP Nastavenia U��vate�ov';
		$this->temps_members = 'Zoznam U��vate�ov';
		$this->temps_mod = 'Nastavenia Moder�tora';
		$this->temps_pm = 'Osobn� odkazova�';
		$this->temps_polls = 'Hlasovania';
		$this->temps_post = 'Posielanie pr�spevkov';
		$this->temps_printer = 'Rozvrhnutie t#$,1m#(B per tla�';
		$this->temps_profile = 'Zobrazenie Profilu';
		$this->temps_recent = 'Najnov�ie t�my';
		$this->temps_register = 'Registr�cia';
		$this->temps_rssfeed = 'RSS Feed'; //Translate
		$this->temps_search = 'Vyh�ad�vanie';
		$this->temps_settings = 'AdminCP Nastavenia';
		$this->temps_templates = 'AdminCP Editor �abl�n';
		$this->temps_titles = 'AdminCP Tituly U��vate�ov';
		$this->temps_topic_prune = 'AdminCP Topic Pruning'; //Translate
		$this->temps_topics = 'T�my';
		$this->upgrade_skin = 'Upgradova� Skin';
		$this->upgrade_skin_already = 'u� bol zupgradovan�. Neprebehla �iadna akcia.';
		$this->upgrade_skin_detail = 'Skiny zupgradovan� pomocou tejto met�dy bud� na�alej vy�adova� n�sledn� editovanie �abl�n.<br />Vyberte skin na upgradovanie';
		$this->upgrade_skin_upgraded = 'skin bol zupgradovan�.';
		$this->upgraded_templates = 'Boli pridan� nasleduj�ce �abl�ny boli';
	}

	function titles()
	{
		$this->titles_add = 'Prida� Titul U��vate�ov';
		$this->titles_added = 'Titul U��vate�ov bol pridan�.';
		$this->titles_control = 'Member Title Control'; //Translate
		$this->titles_edit = 'Editova� Tituly U��vate�ov';
		$this->titles_error = 'No title text or minimum posts was given'; //Translate
		$this->titles_image = 'Obr�zok';
		$this->titles_minpost = 'Minim�lny pr�spevok';
		$this->titles_nodel_default = 'Removal of the default title has been disabled as it will break your board, please edit it instead.'; //Translate
		$this->titles_title = 'Nadpis';
	}

	function topic()
	{
		$this->topic_attached = 'Prilo�en� s�bor:';
		$this->topic_attached_downloads = 'downloads';
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = 'Nem�te povolenie na download tohoto s�boru.';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = 'Nadpis prilo�en�ho s�boru';
		$this->topic_avatar = 'Avatar'; //Translate
		$this->topic_bottom = 'Na spodok str�nky';
		$this->topic_create_poll = 'Zalo�i� nov� hlasovanie';
		$this->topic_create_topic = 'Zalo�i� nov� t�mu';
		$this->topic_delete = 'Zmaza�';
		$this->topic_delete_post = 'Zmaza� tento pr�spevok';
		$this->topic_edit = 'Editova�';
		$this->topic_edit_post = 'Editova� tento pr�spevok';
		$this->topic_edited = 'Naposledy editovan� v %s u��vate�om %s';
		$this->topic_error = 'Chyba';
		$this->topic_group = 'Skupina';
		$this->topic_guest = 'N�v�tevn�k (Guest)';
		$this->topic_ip = 'IP'; //Translate
		$this->topic_joined = 'Registr�cia';
		$this->topic_level = '�lensk� level';
		$this->topic_links_aim = 'Zasla� AIM spr�vu u��vate�ovi %s';
		$this->topic_links_email = 'Zasla� email u��vate�ovi %s';
		$this->topic_links_gtalk = 'Zasla� GTalk spr�vu u��vate�ovi %s';
		$this->topic_links_icq = 'Zasla� ICQ spr�vu u��vate�ovi %s';
		$this->topic_links_msn = 'Zobrazi�  MSN profil u��vate�a %s';
		$this->topic_links_pm = 'Zasla� odkaz u��vate�ovi %s';
		$this->topic_links_web = 'Nav�t�vi� web str�nku u��vate�a %s';
		$this->topic_links_yahoo = 'Zasla� spr�vu pomocou Yahoo! Messengera u�ivate�ovi %s';
		$this->topic_lock = 'Zamkn��';
		$this->topic_locked = 'T�ma je zamknut�';
		$this->topic_move = 'Presun��';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = 'Newer Topic'; //Translate
		$this->topic_no_newer = 'There is no newer topic.'; //Translate
		$this->topic_no_older = 'There is no older topic.'; //Translate
		$this->topic_no_votes = 'Tu e�te nikto nehlasoval.';
		$this->topic_not_found = 'T�ma sa nena�la';
		$this->topic_not_found_message = 'T�ma sa nena�la. Mo�no bola zmazan�, presunut� alebo nebola v�bec.';
		$this->topic_offline = 'Tento u��vate� je moment�lne offline';
		$this->topic_older = 'Older Topic'; //Translate
		$this->topic_online = 'Tento u��vate� je moment�lne online';
		$this->topic_options = 'Mo�nosti t�my';
		$this->topic_pages = 'Str�nky';
		$this->topic_perm_view = 'Nem�te povolenie na prezeranie t�m.';
		$this->topic_perm_view_guest = 'Nem�te povolenie na prezeranie t�m. Ak sa zaregistrujete, mo�no budete ma�.';
		$this->topic_pin = 'Pri�pendli�';
		$this->topic_posted = 'Odoslan�';
		$this->topic_posts = 'Pr�spevky';
		$this->topic_print = 'Zobrazi� vytla�ite�n� verziu';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'Emoticons'; //Translate
		$this->topic_qr_open_emoticons = 'Open Clickable Emoticons'; //Translate
		$this->topic_qr_open_mbcode = 'Open MBCode'; //Translate
		$this->topic_quickreply = 'Quick Reply'; //Translate
		$this->topic_quote = 'Odpoveda� s cit�ciou z tohoto pr�spevku';
		$this->topic_reply = 'Odpoveda� na t�mu';
		$this->topic_split = 'Rozdeli�';
		$this->topic_split_finish = 'Dokon�i� v�etky rozdelenia';
		$this->topic_split_keep = 'Nepres�va� tento pr�spevok';
		$this->topic_split_move = 'Presun�� tento pr�spevok';
		$this->topic_subscribe = 'Zasielanie emailu s odpove�ami na t�to t�mu';
		$this->topic_top = 'Skok na za�iatok str�nky';
		$this->topic_unlock = 'Odomkn��';
		$this->topic_unpin = 'Od�penli�';
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = 'Neregistrovan�';
		$this->topic_view = 'Zobrazi� v�sledky';
		$this->topic_viewing = 'Prezeranie t�m';
		$this->topic_vote = 'Zahlasova�';
		$this->topic_vote_count_plur = '%d hlasov';
		$this->topic_vote_count_sing = '%d hlas';
		$this->topic_votes = 'Hlasovania';
	}

	function universal()
	{
		$this->aim = 'AIM'; //Translate
		$this->based_on = 'based on';
		$this->board_by = 'Autor:';
		$this->charset = 'windows-1250';
		$this->continue = 'Pokra�ova�';
		$this->date_long = 'M j, Y'; //Translate
		$this->date_short = 'n/j/y'; //Translate
		$this->delete = 'Zmaza�';
		$this->direction = 'ltr'; //Translate
		$this->edit = 'Editova� HTML �abl�ny';
		$this->email = 'Email'; //Translate
		$this->gtalk = 'GT'; //Translate
		$this->icq = 'ICQ'; //Translate
		$this->msn = 'MSN'; //Translate
		$this->new_message = 'Nov� spr�va';
		$this->new_poll = 'Nov� hlasovanie';
		$this->new_topic = 'Nov� t�ma';
		$this->no = 'Nie';
		$this->powered = 'Powered by'; //Translate
		$this->private_message = 'PM'; //Translate
		$this->quote = 'Citova�';
		$this->recount_forums = 'Recounted forums! Total topics: %d. Total posts: %d.'; //Translate
		$this->reply = 'Odpoveda�';
		$this->seconds = 'sec';
		$this->select_all = 'Select All'; //Translate
		$this->sep_decimals = '.'; //Translate
		$this->sep_thousands = ','; //Translate
		$this->spoiler = 'Spoiler'; //Translate
		$this->submit = 'OK';
		$this->subscribe = 'Objedna�';
		$this->time_long = ', g:i a'; //Translate
		$this->time_only = 'g:i a'; //Translate
		$this->today = 'Dnes';
		$this->website = 'WWW'; //Translate
		$this->yahoo = 'Yahoo'; //Translate
		$this->yes = '�no';
		$this->yesterday = 'v�era';
	}
}
?>
