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
		$this->active_last_action = 'Posledná akcia';
		$this->active_modules_active = 'Prezeranie aktívnych uívate¾ov';
		$this->active_modules_board = 'Prezeranie indexu';
		$this->active_modules_cp = 'Pouitie ovládacieho panela';
		$this->active_modules_forum = 'Prezeranie fóra: %s';
		$this->active_modules_help = 'Pouívanie helpu';
		$this->active_modules_login = 'Logging In/Out';
		$this->active_modules_members = 'Prezeranie zoznamu èlenov';
		$this->active_modules_mod = 'Moderovanie';
		$this->active_modules_pm = 'Pouívanie odkazovaèa';
		$this->active_modules_post = 'Prispievanie';
		$this->active_modules_printer = 'Vytlaèenie témy: %s';
		$this->active_modules_profile = 'Prezeranie profilu: %s';
		$this->active_modules_recent = 'Prezeranie najnovších príspevkov';
		$this->active_modules_search = 'Vyh¾adávanie';
		$this->active_modules_topic = 'Prezeranie témy: %s';
		$this->active_time = 'Èas';
		$this->active_user = 'Uívate¾';
		$this->active_users = 'Aktívni uívatelia';
	}

	function admin()
	{
		$this->admin_add_emoticons = 'Prida smajlíky';
		$this->admin_add_member_titles = 'Prida automatické tituly uívate¾ov';
		$this->admin_add_templates = 'Prida HTML šablóny';
		$this->admin_ban_ips = 'Zablokova IP adresu';
		$this->admin_censor = 'Cenzúra slov';
		$this->admin_cp_denied = 'Prístup Zamietnutı';
		$this->admin_cp_warning = 'Administrátorská èas (CP) bude nedostupná, dokia¾ nebude vymazanı adresár <b>install</b>, pretoe predstavuje vánu bezpeènostnú dieru pre nainštalované fórum.';
		$this->admin_create_forum = 'Zaloi fórum';
		$this->admin_create_group = 'Zaloi skupinu';
		$this->admin_create_help = 'Zaloi èlánok helpu';
		$this->admin_create_skin = 'Zaloi skin';
		$this->admin_db = 'Databáza';
		$this->admin_db_backup = 'Zálohova databázu';
		$this->admin_db_conn = 'Editova nastavenie pripojenia';
		$this->admin_db_optimize = 'Optimalizova databázu';
		$this->admin_db_query = 'Spusti SQL dotaz';
		$this->admin_db_restore = 'Obnovi zo zálohy';
		$this->admin_delete_forum = 'Zmaza fórum';
		$this->admin_delete_group = 'Zmaza skupinu';
		$this->admin_delete_help = 'Zmaza help èlánok';
		$this->admin_delete_member = 'Zmaza uívate¾a';
		$this->admin_delete_template = 'Zmaza HTML šablónu';
		$this->admin_edit_emoticons = 'Editova alebo maza smajlíky';
		$this->admin_edit_forum = 'Editova fórum';
		$this->admin_edit_group_name = 'Editova názov skupiny';
		$this->admin_edit_group_perms = 'Editova práva skupiny';
		$this->admin_edit_help = 'Editova help èlánok';
		$this->admin_edit_member = 'Editova uívate¾a';
		$this->admin_edit_member_perms = 'Editova práva uívate¾a';
		$this->admin_edit_member_titles = 'Editova alebo maza automatické tituly uívate¾ov';
		$this->admin_edit_settings = 'Editova nastavenia celého fóra';
		$this->admin_edit_skin = 'Editova alebo maza skin';
		$this->admin_edit_templates = 'Editova HTML šablónu';
		$this->admin_emoticons = 'Smajlíky';
		$this->admin_export_skin = 'Exportova skin';
		$this->admin_fix_stats = 'Opravi štatistiku uívate¾ov';
		$this->admin_forum_order = 'Zmeni poradie fór';
		$this->admin_forums = 'Fóra a kategórie';
		$this->admin_groups = 'Skupiny';
		$this->admin_heading = 'Quicksilver Forums - Ovládací Panel Administrátora';
		$this->admin_help = 'Help Èlánky';
		$this->admin_install_emoticons = 'Inštalova smajlíky';
		$this->admin_install_skin = 'Inštalova skin';
		$this->admin_logs = 'Prezera èinnos moderátora';
		$this->admin_mass_mail = 'Zasla email Vašim uívate¾om';
		$this->admin_members = 'Uívatelia';
		$this->admin_phpinfo = 'Prezera informácie o PHP';
		$this->admin_prune = 'Preriedi staré témy';
		$this->admin_recount_forums = 'Prepoèíta témy a reakcie';
		$this->admin_settings = 'Nastavenia';
		$this->admin_settings_add = 'Add new board setting'; //Translate
		$this->admin_skins = 'Skiny';
		$this->admin_stats = 'Štatistické centrum';
		$this->admin_upgrade_skin = 'Upgradova Skin';
		$this->admin_your_board = 'Vaše fórum';
	}

	function backup()
	{
		$this->backup_create = 'Zálohova Databázu';
		$this->backup_createfile = 'Backup and create a file on server'; //Translate
		$this->backup_done = 'Databáza bola zazálohovaná v hlavnom adresári Quicksilver Forums.';
		$this->backup_download = 'Backup and download (recommended)'; //Translate
		$this->backup_found = 'Nasledujúce zálohy boli nájdené v adresári Quicksilver Forums';
		$this->backup_invalid = 'Táto záloha nie je pouite¾ná - neplatnı formát. Do databázi neboli zapísané iadne zmeny.';
		$this->backup_none = 'V adresári Quicksilver Forums neboli nájdené iadne zálohy.';
		$this->backup_options = 'Select how you want your backup created'; //Translate
		$this->backup_restore = 'Obnovi zo zálohy';
		$this->backup_restore_done = 'Databáza bola úspešne obnovená zo zálohy.';
		$this->backup_warning = 'Upozornenie: tımto budú všetky existujúce dáta Quicksilver Fóra prepísané.';
	}

	function ban()
	{
		$this->ban = 'Zablokova';
		$this->ban_banned_ips = 'Zablokova IP Adresu';
		$this->ban_banned_members = 'Zablokovaní uívatelia';
		$this->ban_ip = 'Zablokované IP Adresy';
		$this->ban_member_explain1 = 'Ak chcete zablokova uívate¾ov, presuòte ich do skupiny';
		$this->ban_member_explain2 = 'v nastaveniach uívate¾ov.';
		$this->ban_members = 'Zablokova uívate¾ov';
		$this->ban_nomembers = 'Momentálne nie sú blokovaní iadni uívatelia.';
		$this->ban_one_per_line = 'Kadá adresa v samostatnom riadku.';
		$this->ban_regex_allowed = 'Sú povolené regulárne vırazy. Môete poui znak * ako substitúciu jedného alebo viacerıch èísiel.';
		$this->ban_settings = 'Nastavenia blokovaní';
		$this->ban_users_banned = 'Blokovaní uívatelia.';
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
		$this->board_active_users = 'Aktívni uívatelia';
		$this->board_birthdays = 'Dnes má narodeniny:';
		$this->board_bottom_page = 'Na spodok stránky';
		$this->board_can_post = 'V tomto fóre môete zasiela odpovede.';
		$this->board_can_topics = 'V tomto fóre môete èíta príspevky, ale nemôete zaklada nové témy.';
		$this->board_cant_post = 'V tomto fóre nemôete zasiela odpovede.';
		$this->board_cant_topics = 'V tomto fóre nemôete ani zaklada témy, ani èíta príspevky.';
		$this->board_forum = 'Fórum';
		$this->board_guests = 'hosts';
		$this->board_last_post = 'Najnovší príspevok';
		$this->board_mark = 'Preznaè všetky príspevky na "preèítané"';
		$this->board_mark1 = 'Všetky príspevky a fóra boli preznaèené na "preèítané"';
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = 'èlenovia';
		$this->board_message = '%s Správa';
		$this->board_most_online = 'Historicky maximálny poèet online uívate¾ov je %d a bol dosiahnutı %s.';
		$this->board_nobday = 'Dnes nemá iadny èlen narodeniny.';
		$this->board_nobody = 'Momentálne nie je iadny èlen online.';
		$this->board_nopost = 'iadne príspevky';
		$this->board_noview = 'Nemáte povolenie na èítanie tohoto fóra.';
		$this->board_regfirst = 'Nemáte povolenie na èítanie tohoto fóra. Po zaregistrovaní sa mono budete ma.';
		$this->board_replies = 'Odpovede';
		$this->board_stats = 'Štatistika';
		$this->board_stats_string = 'Registrovanıch uívate¾ov: %s. Privítajte našeho najnovšieho èlena, je to %s.<br />Vo fóre sa celkovo nachádza %s tém, %s odpovedí a %s príspevkov.';
		$this->board_top_page = 'Na vrch stránky';
		$this->board_topics = 'Témy';
		$this->board_users = 'uívatelia';
		$this->board_write_topics = 'V tomto fóre máte právo prezera témy a vytvárat nové .';
	}

	function censoring()
	{
		$this->censor = 'Cenzurované slová';
		$this->censor_one_per_line = 'Kadé na samostatnom riadku.';
		$this->censor_regex_allowed = 'Sú povolené regulárne vırazy. Môete poui znak * ako substitúciu jedného alebo viacerıch znakov.';
		$this->censor_updated = 'Zoznam slov bol aktualizovanı.';
	}

	function cp()
	{
		$this->cp_aim = 'AIM Screen Name'; //Translate
		$this->cp_already_member = 'Emailová adresa, ktorú ste zadali u bola pridelená inému èlenovi.';
		$this->cp_apr = 'Apríl';
		$this->cp_aug = 'August'; //Translate
		$this->cp_avatar_current = 'Váš súèasnı avatar';
		$this->cp_avatar_error = 'Chyba avatara';
		$this->cp_avatar_must_select = 'Musíte si vybra avatara.';
		$this->cp_avatar_none = 'Nepoíva avatara.';
		$this->cp_avatar_pixels = 'pixels'; //Translate
		$this->cp_avatar_select = 'Vyberte si avatara';
		$this->cp_avatar_size_height = 'Váš avatar musí ma ve¾kos medzi 1 a';
		$this->cp_avatar_size_width = 'Šírka Vašeho avatara musí by medzi 1 a';
		$this->cp_avatar_upload = 'Uploadova avatara z	lokálneho disku';
		$this->cp_avatar_upload_failed = 'Uploadovanie avatara zlyhalo. Súbor neexistuje.';
		$this->cp_avatar_upload_not_image = 'Uploadova moete iba obrázky pre Vašaho avatara.';
		$this->cp_avatar_upload_too_large = 'Avatar, ktorého ste zadali pre upload je prive¾kı. Maximálna povolená ve¾kos je %d kB.';
		$this->cp_avatar_url = 'Zadajte URL vášho avatara';
		$this->cp_avatar_use = 'Poui uploadovaného avatara';
		$this->cp_bday = 'Narodeniny';
		$this->cp_been_updated = 'Váš profil bol aktualizovanı.';
		$this->cp_been_updated1 = 'Váš avatar bol aktualizovanı.';
		$this->cp_been_updated_prefs = 'Vaše nastavenia boli aktualizované.';
		$this->cp_changing_pass = 'Zmena hesla';
		$this->cp_contact_pm = 'Dovolíte ostatnım, aby Vás kontaktovali cez odkazovaè?';
		$this->cp_cp = 'Ovládací panel';
		$this->cp_current_avatar = 'Aktuálny avatar';
		$this->cp_current_time = 'Teraz je %s.';
		$this->cp_custom_title = 'Zmeni titul èlena';
		$this->cp_custom_title2 = 'Toto privilégium je rezervované pre administrátora fóra';
		$this->cp_dec = 'December'; //Translate
		$this->cp_editing_avatar = 'Zmena avatara';
		$this->cp_editing_profile = 'Zmena profilu';
		$this->cp_email = 'Email'; //Translate
		$this->cp_email_form = 'Dovolíte ostatnım, aby Vás kontaktovali cez email?';
		$this->cp_email_invaid = 'Email, ktorı ste zadali vyzerá by neplatnı.';
		$this->cp_err_avatar = 'Chyba pri aktualizácii avatara.';
		$this->cp_err_updating = 'Chyba pri aktualizácii profilu.';
		$this->cp_feb = 'Február';
		$this->cp_file_type = 'Avatar, ktorého ste zadali je neplatnı. Uistite sa, èi má URL správny formát a èi je dotyènı súbor typu gif, jpg alebo png.';
		$this->cp_format = 'Vaše meno sa bude zobrazova ako';
		$this->cp_gtalk = 'GTalk konto';
		$this->cp_header = 'Ovládací panel uívate¾a';
		$this->cp_height = 'Vıška';
		$this->cp_icq = 'ICQ èíslo';
		$this->cp_interest = 'Záujmy';
		$this->cp_jan = 'Január';
		$this->cp_july = 'Júl';
		$this->cp_june = 'Jún';
		$this->cp_label_edit_avatar = 'Zmena avatara';
		$this->cp_label_edit_pass = 'Zmena hesla';
		$this->cp_label_edit_prefs = 'Zmena nastavení';
		$this->cp_label_edit_profile = 'Zmena profilu';
		$this->cp_label_edit_sig = 'Edit Signature'; //Translate
		$this->cp_label_edit_subs = 'Editovanie objednávok';
		$this->cp_language = 'Jazyk';
		$this->cp_less_charac = 'Vaše meno musí by kratšie, ako 32 znakov.';
		$this->cp_location = 'Sídlo';
		$this->cp_login_first = 'Pre prístup k Vašemu ovládaciemu panelu sa musíte nalogova.';
		$this->cp_mar = 'Marec';
		$this->cp_may = 'Máj';
		$this->cp_msn = 'MSN Identity'; //Translate
		$this->cp_must_orig = 'Vaše meno sa musí zhodova s originálom. Môete zmeni iba ve¾kos a medzery.';
		$this->cp_new_notmatch = 'Nové heslá, ktoré ste zadali, sa nezhodujú.';
		$this->cp_new_pass = 'Nové heslo';
		$this->cp_no_flash = 'Avatari typu ShockWaveFlash tu nie sú povolené.';
		$this->cp_not_exist = 'Dátum, ktorı ste zadali (%s), neexistuje!';
		$this->cp_nov = 'November'; //Translate
		$this->cp_oct = 'Octóber';
		$this->cp_old_notmatch = 'Pôvodné heslo, ktoré ste zadali sa nezhoduje s heslom v databáze.';
		$this->cp_old_pass = 'Pôvodné heslo';
		$this->cp_pass_notvaid = 'Vaše heslo je neplatné. Uistite sa, e obsahuje len platné znaky ako sú písmená, èísla, pomlèka, podtrítko alebo medzera.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = 'Zmena nastavení';
		$this->cp_preview_sig = 'Signature Preview:'; //Translate
		$this->cp_privacy = 'Monosti ochrany súkromia';
		$this->cp_repeat_pass = 'Ešte raz nové heslo';
		$this->cp_sept = 'September'; //Translate
		$this->cp_show_active = 'Ukazova Vašu èinnos poèas pouívania fóra?';
		$this->cp_show_email = 'Zobrazova v profile aj email?';
		$this->cp_signature = 'Podpis';
		$this->cp_size_max = 'Prevtelenie, ktoré ste zadali, je prive¾ké. Maximálna ve¾kos je povolená %s na %s pixlov.';
		$this->cp_skin = 'Skin fóra';
		$this->cp_sub_change = 'Zmena objednávok';
		$this->cp_sub_delete = 'Zmaza';
		$this->cp_sub_expire = 'Dátum vypršania platnosti';
		$this->cp_sub_name = 'Názov objednávky';
		$this->cp_sub_no_params = 'Neboli zadané iadne parametre.';
		$this->cp_sub_success = 'Teraz Vám budú emailom zasielané nové príspevky, zdroj: %s.';
		$this->cp_sub_type = 'Typ objednávky';
		$this->cp_sub_updated = 'Oznaèené objednávky boli vymazané.';
		$this->cp_topic_option = 'Monosti témy';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = 'Profil bol aktualizovanı';
		$this->cp_updated1 = 'Avatar bol aktualizovanı';
		$this->cp_updated_prefs = 'Nastavenia boli aktualizované';
		$this->cp_user_exists = 'Uívate¾ s takımto menom u existuje.';
		$this->cp_valided = 'Vaše heslo bolo overené a zmenené.';
		$this->cp_view_avatar = 'Zobrazi avatara?';
		$this->cp_view_emoticon = 'Zobrazi smajlíky?';
		$this->cp_view_signature = 'Zobrazi podpisy?';
		$this->cp_welcome = 'Buïte vítanı v uívate¾skom ovládacom paneli. Odtia¾to mono nastavova Vaše konto. Vyberte si z nasledujúcich moností.';
		$this->cp_width = 'Šírka';
		$this->cp_www = 'Homepage'; //Translate
		$this->cp_yahoo = 'Yahoo Identity'; //Translate
		$this->cp_zone = 'Èasová zóna';
	}

	function email()
	{
		$this->email_blocked = 'Tento èlen neprijíma email z tohoto formulára.';
		$this->email_email = 'Email'; //Translate
		$this->email_msgtext = 'Obsah emailu:';
		$this->email_no_fields = 'Vráte sa o overte, èi sú všetky polia vyplnené.';
		$this->email_no_member = 'iaden èlen s takımto menom sa nenašiel.';
		$this->email_no_perm = 'Nemáte povolenie posiela emaily z tohoto fóra.';
		$this->email_sent = 'Váš email bol odoslanı.';
		$this->email_subject = 'Predmet:';
		$this->email_to = 'Komu:';
	}

	function emot_control()
	{
		$this->emote = 'Smajlíky';
		$this->emote_add = 'Prida smajlíky';
		$this->emote_added = 'Smajlíky boli pridané.';
		$this->emote_clickable = 'Kliknute¾né';
		$this->emote_edit = 'Editova smajlíky';
		$this->emote_image = 'Obrázok';
		$this->emote_install = 'Inštalova smajlíky';
		$this->emote_install_done = 'Smajlíky boli úspešne znovu nainštalované.';
		$this->emote_install_warning = 'Tımto budú zmazané všetky existujúce nastavenia smajlíkov a uploadované smajlíky budú naimportované z vybraného skinu do databázy.';
		$this->emote_no_text = 'Nebol zadanı iadny text ku smajlíku.';
		$this->emote_text = 'Text'; //Translate
	}

	function forum()
	{
		$this->forum_by = 'Napísal';
		$this->forum_can_post = 'V tomto fóre môete odpoveda.';
		$this->forum_can_topics = 'V tomto fóre si môete prezera témy.';
		$this->forum_cant_post = 'V tomto fóre nemáte povolenie odpoveda.';
		$this->forum_cant_topics = 'V tomto fóre nemáte povolenie prezera témy.';
		$this->forum_dot = 'dot(to èo je?)';
		$this->forum_dot_detail = 'ukazuje, e ste pod danú tému prispeli';
		$this->forum_forum = 'Fórum';
		$this->forum_guest = 'Hos';
		$this->forum_hot = 'dôleité';
		$this->forum_icon = 'Ikona správy';
		$this->forum_jump = 'Hop na najnovšie príspevky pod touto témou';
		$this->forum_last = 'Najnovší príspevok';
		$this->forum_locked = 'Zamknuté';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = 'Presunuté';
		$this->forum_msg = '%s Správa';
		$this->forum_new = 'nové';
		$this->forum_new_poll = 'Zaloi nové hlasovanie';
		$this->forum_new_topic = 'Zaloi novú tému';
		$this->forum_no_topics = 'V tomto fóre nie sú iadne témy.';
		$this->forum_noexist = 'Zadané fórum neexistuje.';
		$this->forum_nopost = 'Nie sú príspevky';
		$this->forum_not = 'menej';
		$this->forum_noview = 'Nemáte povolenie na prezeranie fór.';
		$this->forum_pages = 'Stránky';
		$this->forum_pinned = 'Prišpendlené';
		$this->forum_pinned_topic = 'Prišpendlená téma';
		$this->forum_poll = 'Hlasovanie';
		$this->forum_regfirst = 'Nemáte povolenie na prezeranie fór. Ak sa zaregistrujete, mono budete ma.';
		$this->forum_replies = 'Odpovede';
		$this->forum_starter = 'Zakladate¾';
		$this->forum_sub = 'Pod-Fórum';
		$this->forum_sub_last_post = 'Najnovší príspevok';
		$this->forum_sub_replies = 'Odpovede';
		$this->forum_sub_topics = 'Témy';
		$this->forum_subscribe = 'Posla emailom nové príspevky v tomto fóre';
		$this->forum_topic = 'Téma';
		$this->forum_views = 'Videné';
		$this->forum_write_topics = 'V tomto fóre máte povolenie zaklada témy.';
	}

	function forums()
	{
		$this->forum_controls = 'Nastavenia Fór';
		$this->forum_create = 'Zaloi Fórum';
		$this->forum_create_cat = 'Zaloi Kategóriu';
		$this->forum_created = 'Fórum bolo zaloené';
		$this->forum_default_perms = 'Prednastavené práva';
		$this->forum_delete = 'Zmaza Fórum';
		$this->forum_delete_warning = 'Urèite chcete zmaza toto fórum spolu s témami a príspevkami, ktoré sa v òom nachádzajú?<br />Tento krok je nevratnı.';
		$this->forum_deleted = 'Fórum bolo zmazané.';
		$this->forum_description = 'Popis';
		$this->forum_edit = 'Editova Fórum';
		$this->forum_edited = 'Fórum bolo úspešne zeditované.';
		$this->forum_empty = 'Názov fóra je prázdny. Prosím, vráte sa a zadajte názov.';
		$this->forum_is_subcat = 'Toto fórum je iba podkategóriou.';
		$this->forum_name = 'Názov';
		$this->forum_no_orphans = 'Nesmiete osirie fórum tım, e mu zmaete hierarchického rodièa.';
		$this->forum_none = 'Nie sú k dispozícii iadne	manipulovate¾né fóra.';
		$this->forum_ordered = 'Poradie Fór bolo zaktualizované';
		$this->forum_ordering = 'Zmeni Poradie Fór';
		$this->forum_parent = 'Tımto spôsobom nemôete zmeni hierarchického rodièa fóra.';
		$this->forum_parent_cat = 'Rodièovská Kategória';
		$this->forum_quickperm_select = 'Vyberte existujúce fórum, ktorého práva chcete okopírova.';
		$this->forum_quickperms = 'Rıchle Práva';
		$this->forum_recount = 'Prepoèíta Témy a Odpovede';
		$this->forum_select_cat = 'Vyberte existujúcu kategóriu, pod ktorou chcete zaloit fórum.';
		$this->forum_subcat = 'Podkategória';
	}

	function groups()
	{
		$this->groups_bad_format = 'Musíte poui %s vo formáte, ktorı predstavuje meno skupiny.';
		$this->groups_based_on = 'zaloenı na';
		$this->groups_create = 'Zaloi Skupinu';
		$this->groups_create_new = 'Zaloi novú skupinu uívate¾ov s názvom';
		$this->groups_created = 'Skupina bola zaloená';
		$this->groups_delete = 'Zmaza Skupinu';
		$this->groups_deleted = 'Skupina bola Zmazaná.';
		$this->groups_edit = 'Editova Skupinu';
		$this->groups_edited = 'Skupina bola Zeditovaná.';
		$this->groups_formatting = 'Zobrazi Formátovanie';
		$this->groups_i_confirm = 'Potvrdzujem, e naozaj zmaza túto skupinu uívate¾ov.';
		$this->groups_name = 'Názov';
		$this->groups_no_action = 'Neboli vykonané iadne zmeny.';
		$this->groups_no_delete = 'Neexistuje zmazate¾ná
	skupina uívate¾ov.<br />Základné skupiny sú potrebné pre chod Quicksilver Fóra a preto nesmú by zmazané.';
		$this->groups_no_group = 'Nebola zadaná iadna skupina.';
		$this->groups_no_name = 'Nebol zadanı názov skupiny.';
		$this->groups_only_custom = 'Poznámka: Môete maza iba skupiny uívae¾ov mimo základnıch skupín. Základné skupiny sú potrebne pre chod Quicksilver Fóra.';
		$this->groups_the = 'Skupina';
		$this->groups_to_edit = 'Editovate¾né skupiny';
		$this->groups_type = 'Typ Skupiny';
		$this->groups_will_be = 'budú zmazané.';
		$this->groups_will_become = 'Uívatelia zo zmazanej skupiny budú presunutı do skupiny';
	}

	function help()
	{
		$this->help_add = 'Prida Help Èlánok';
		$this->help_article = 'Nastavenia Help Èlánku';
		$this->help_available_files = 'Help'; //Translate
		$this->help_confirm = 'Naozaj chcete zmaza';
		$this->help_content = 'Obsah Èlánku';
		$this->help_delete = 'Zmaza Help Èlánok';
		$this->help_deleted = 'Help Èlánok bol Zmazanı.';
		$this->help_edit = 'Editova Help Èlánok';
		$this->help_edited = 'Help èlánok bol zaktualizovanı.';
		$this->help_inserted = 'Èlánok bol zapísanı do databázy.';
		$this->help_no_articles = 'V databáze momentálne nie sú iadne help èlánky.';
		$this->help_no_title = 'Nemôete zaloi help èlánok bez názvu.';
		$this->help_none = 'V databáze nie sú iadne súbory s helpom';
		$this->help_not_exist = 'Tento help èlánok neexistuje.';
		$this->help_select = 'Prosím, vyberte help èlánok, ktorı chcete editova';
		$this->help_select_delete = 'Prosím, vyberte help èlánok, ktorı chcete zmaza';
		$this->help_title = 'Názov';
	}

	function home()
	{
		$this->home_choose = 'Vyberte si.';
		$this->home_menu_title = 'Administrátorské menu (CP)';
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
		$this->login_cant_logged = 'Pravdepodobne nie ste prihlásenı. Skúste skontrolova Váš login a heslo.<br /><br />Sú citlivé na ve¾ké a malé znaky, take \'UsErNaMe\' nie je to isté, èo \'Username\'. A taktie si overte, èi sú vo Vašom prehliadaèi povolené cookies.';
		$this->login_cookies = 'Pre prihlásenie musíte povoli cookies.';
		$this->login_forgot_pass = 'Zabudli ste Vaše heslo?';
		$this->login_header = 'Prihlasovanie';
		$this->login_logged = 'Teraz ste prihlásenı.';
		$this->login_now_out = 'Teraz ste odhlásenı.';
		$this->login_out = 'Odhlasovanie';
		$this->login_pass = 'Heslo';
		$this->login_pass_no_id = 'Uívate¾ so zadanım menom neexistuje.';
		$this->login_pass_request = 'Pre dokonèenie zresetovania hesla prosím kliknite na odkaz, zaslanı na emailovu adresu, na ktorú je registrované Vaše konto.';
		$this->login_pass_reset = 'Zresetovanie hesla';
		$this->login_pass_sent = 'Vaše heslo bolo zresetované. Nové heslo bolo zaslané na emailovú adresú, která je zregistrovaná k Vašemu kontu';
		$this->login_sure = '\'%s\', urèite sa chcete odhlási?';
		$this->login_user = 'Meno uívate¾a';
	}

	function logs()
	{
		$this->logs_action = 'Akcia';
		$this->logs_deleted_post = 'Zmazanı príspevok';
		$this->logs_deleted_topic = 'Zmazaná téma';
		$this->logs_edited_post = 'Zeditovanı príspevok';
		$this->logs_edited_topic = 'Zeditovaná téma';
		$this->logs_id = 'IDs'; //Translate
		$this->logs_locked_topic = 'Zamknutá téma';
		$this->logs_moved_from = 'z fóra';
		$this->logs_moved_to = 'do fóra';
		$this->logs_moved_topic = 'Presunutá téma';
		$this->logs_moved_topic_num = 'Poèet presunutıch tém';
		$this->logs_pinned_topic = 'Prišpendlená téma';
		$this->logs_post = 'Príspevok';
		$this->logs_time = 'Èas';
		$this->logs_topic = 'Téma';
		$this->logs_unlocked_topic = 'Odomknutá téma';
		$this->logs_unpinned_topic = 'Odšpendlená téma';
		$this->logs_user = 'Uívate¾';
		$this->logs_view = 'Prezeranie èinnosti moderátora';
	}

	function main()
	{
		$this->main_activate = 'Váš úèet ešte nebol aktivovanı.';
		$this->main_activate_resend = 'Znovu posla aktivaènı email';
		$this->main_admincp = 'nastavenia fór';
		$this->main_banned = 'Vám bolo ia¾ komplet celé fórum zneprístupnené.';
		$this->main_code = 'zdrojovı kód';
		$this->main_cp = 'ovládací panel';
		$this->main_full = 'Detaily';
		$this->main_help = 'help';
		$this->main_load = 'záa';
		$this->main_login = 'prihlásenie';
		$this->main_logout = 'odhlásenie';
		$this->main_mark = 'oznaèi všetko';
		$this->main_mark1 = 'Oznaèi všetky témy ako preèítané';
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = 'Je nám ¾úto, ale %s momentálne nie je dostupné kvôli strašnej mase online uívate¾ov.';
		$this->main_members = 'èlenovia';
		$this->main_messenger = 'odkazovaè';
		$this->main_new = 'nové';
		$this->main_next = 'nasledujúce';
		$this->main_prev = 'predošlé';
		$this->main_queries = 'DB dotazov';
		$this->main_quote = 'Citácia';
		$this->main_recent = 'najnovšie príspevky';
		$this->main_recent1 = 'Zobrazi najnovšie príspevky od poslednej návštevy';
		$this->main_register = 'registrácia';
		$this->main_reminder = 'HoSiPa';
		$this->main_reminder_closed = 'Fórum je uzavreté a prístupné len pre adminov.';
		$this->main_said = 'poviedali';
		$this->main_search = 'h¾adanie';
		$this->main_topics_new = 'V tomto fóre sú nejaké nové príspevky';
		$this->main_topics_old = 'V tomto fóre nie sú iadne nové príspevky';
		$this->main_welcome = 'Vitajte';
		$this->main_welcome_guest = 'Vitajte!';
	}

	function mass_mail()
	{
		$this->mail = 'Hromadnı Mail';
		$this->mail_announce = 'Oznam Od';
		$this->mail_groups = 'Cie¾ová Skupina';
		$this->mail_members = 'uívatelia.';
		$this->mail_message = 'Správa';
		$this->mail_select_all = 'Oznaèi všetko';
		$this->mail_send = 'Posla Mail';
		$this->mail_sent = 'Vaša správa bola zaslaná na adresu';
	}

	function member_control()
	{
		$this->mc = 'Nastavenia Uívate¾ov';
		$this->mc_confirm = 'Naozaj chcete zmaza';
		$this->mc_delete = 'Zmaza Uívate¾a';
		$this->mc_deleted = 'Uívate¾ Zmazanı.';
		$this->mc_edit = 'Editova Uívate¾a';
		$this->mc_edited = 'Uívate¾ bol Zaktualizovanı';
		$this->mc_email_invaid = 'Email, ktorı ste zadali, je neplatnı.';
		$this->mc_err_updating = 'Error Updating Profile'; //Translate
		$this->mc_find = 'Nájs uívate¾ov, ktorıch meno obsahuje';
		$this->mc_found = 'Boli nájdení nasledujúci uívatelia. Prosím, vyberte jedného.';
		$this->mc_guest_needed = 'Konto guest je potrebné pre chod Quicksilver Fóra.';
		$this->mc_not_found = 'Neboli nájdení iadni uívatelia';
		$this->mc_user_aim = 'AIM Name'; //Translate
		$this->mc_user_avatar = 'Avatar'; //Translate
		$this->mc_user_avatar_height = 'Vıška Avatara';
		$this->mc_user_avatar_type = 'Typ Avatara';
		$this->mc_user_avatar_width = 'Šírka Avatara';
		$this->mc_user_birthday = 'Narodeniny';
		$this->mc_user_email = 'Emailová  Adresa';
		$this->mc_user_email_show = 'Email je prístupnı verejnosti';
		$this->mc_user_group = 'Skupina';
		$this->mc_user_gtalk = 'GTalk konto';
		$this->mc_user_homepage = 'Homepage'; //Translate
		$this->mc_user_icq = 'ICQ Number'; //Translate
		$this->mc_user_id = 'ID uívate¾a';
		$this->mc_user_interests = 'Záujmy';
		$this->mc_user_joined = 'registrácia';
		$this->mc_user_language = 'Jazyk';
		$this->mc_user_lastpost = 'Poslednı príspevok';
		$this->mc_user_lastvisit = 'Posledná návšteva';
		$this->mc_user_level = 'Level'; //Translate
		$this->mc_user_location = 'Sídlo';
		$this->mc_user_msn = 'MSN Identity'; //Translate
		$this->mc_user_name = 'Meno';
		$this->mc_user_pm = 'Prijíma osobné odkazy (PM)';
		$this->mc_user_posts = 'Príspevky';
		$this->mc_user_signature = 'Podpis';
		$this->mc_user_skin = 'Skin'; //Translate
		$this->mc_user_timezone = 'Èasové Pásmo';
		$this->mc_user_title = 'Titul uívate¾a';
		$this->mc_user_title_custom = 'Poui vlastnı titul uívate¾a';
		$this->mc_user_view_avatars = 'Zobrazi avatarov';
		$this->mc_user_view_emoticons = 'Zobrazi smajlíky';
		$this->mc_user_view_signatures = 'Zobrazi podpis';
		$this->mc_user_yahoo = 'Yahoo Identity'; //Translate
	}

	function membercount()
	{
		$this->mcount = 'Opravi štatistiku uívate¾ov';
		$this->mcount_updated = 'Poèet uívate¾ov bol zaktualizovanı.';
	}

	function members()
	{
		$this->members_all = 'všetko';
		$this->members_email = 'email';
		$this->members_email_member = 'pošli email tomuto èlenovi';
		$this->members_group = 'skupina';
		$this->members_joined = 'registrácia';
		$this->members_list = 'zoznam èlenov';
		$this->members_member = 'èlen';
		$this->members_pm = 'odkazovaè';
		$this->members_posts = 'príspevky';
		$this->members_send_pm = 'posla tomuto èlenovi odkaz';
		$this->members_title = 'titul';
		$this->members_vist_www = 'navštívi webstránku tohoto èlena';
		$this->members_www = 'webstránka';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Urèite chcete zmaza tento príspevok?';
		$this->mod_confirm_topic_delete = 'Urèite chcete zmaza túto tému?';
		$this->mod_error_first_post = 'Nemôete zmaza prvı príspevok pod témou.';
		$this->mod_error_move_category = 'Nemôete presunú tému do kategórie.';
		$this->mod_error_move_create = 'Nemôete presúva témy do zadaného fóra.';
		$this->mod_error_move_forum = 'Nemôete presunú tému do fóra. ktoré neexistuje.';
		$this->mod_error_move_global = 'Nemôete presúva globálnu tému. Zmeòte nastavenia témy, ne ju presuniete.';
		$this->mod_error_move_same = 'Nemôete presunú tému do fóra, v ktorom sa momentálne nachádza.';
		$this->mod_label_controls = 'Ovládanie pre moderátorov';
		$this->mod_label_description = 'Popis';
		$this->mod_label_emoticon = 'Konvertova textové smajlíky na obrázky?';
		$this->mod_label_global = 'Globálna téma';
		$this->mod_label_mbcode = 'interpretova Mb-kódy?';
		$this->mod_label_move_to = 'Presunú ..';
		$this->mod_label_options = 'Monosti';
		$this->mod_label_post_delete = 'Zmaza príspevok';
		$this->mod_label_post_edit = 'Editova príspevok';
		$this->mod_label_post_icon = 'Ikona Príspevku';
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = 'Nadpis';
		$this->mod_label_title_original = 'Pôvodnı nadpis';
		$this->mod_label_title_split = 'Rozdeli nadpis';
		$this->mod_label_topic_delete = 'Zmaza tému';
		$this->mod_label_topic_edit = 'Editova tému';
		$this->mod_label_topic_lock = 'Zamknú tému';
		$this->mod_label_topic_move = 'Presunú tému';
		$this->mod_label_topic_move_complete = 'Kompletne presunú tému do nového fóra';
		$this->mod_label_topic_move_link = 'Presunú tému do nového fóra a zanecha link na nové umiestnenie v pôvodnom fóre.';
		$this->mod_label_topic_pin = 'Prišpendli tému';
		$this->mod_label_topic_split = 'Rozdeli tému';
		$this->mod_missing_post = 'Špecifikovanı príspevok neexistuje.';
		$this->mod_missing_topic = 'Špecifikovaná téma neexistuje.';
		$this->mod_no_action = 'Musíte špecifikova èinnos.';
		$this->mod_no_post = 'Musíte špecifikova príspevok.';
		$this->mod_no_topic = 'Musíte špecifikova tému.';
		$this->mod_perm_post_delete = 'Nemáte povolenie na zmazanie tohoto príspevku.';
		$this->mod_perm_post_edit = 'Nemáte povolenie na editáciu tohoto príspevku.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = 'Nemáte povolenie na zmazanie tejto témy.';
		$this->mod_perm_topic_edit = 'Nemáte povolenie na editáciu tejto témy.';
		$this->mod_perm_topic_lock = 'Nemáte povolenie na zamknutie tejto témy.';
		$this->mod_perm_topic_move = 'Nemáte povolenie na presúvanie tejto témy.';
		$this->mod_perm_topic_pin = 'Nemáte povolenie na prišpendlenie tejto témy.';
		$this->mod_perm_topic_split = 'Nemáte povolenie na rozdelenie tejto témy.';
		$this->mod_perm_topic_unlock = 'Nemáte povolenie na odomknutie tejto témy.';
		$this->mod_perm_topic_unpin = 'Nemáte povolenie na odšpendlenie tejto témy.';
		$this->mod_success_post_delete = 'Príspevok bol úspešne zmazanı.';
		$this->mod_success_post_edit = 'Príspevok bol úspešne zeditovanı.';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = 'Téma bola úspešne rozdelená.';
		$this->mod_success_topic_delete = 'Téma bola úspešne zmazaná';
		$this->mod_success_topic_edit = 'Téma bola úspešne zeditovaná.';
		$this->mod_success_topic_move = 'Téma bola úspešne presunutá do nového fóra.';
		$this->mod_success_unpublish = 'This topic has been removed from the published list.'; //Translate
	}

	function optimize()
	{
		$this->optimize = 'Optimalizova Databázu';
		$this->optimized = 'Tabu¾ky v databáze boli zoptimalizované pre maximálny vıkon.';
	}

	function perms()
	{
		$this->perm = 'Právo';
		$this->perms = 'Práva';
		$this->perms_board_view = 'Zobrazi index fór';
		$this->perms_board_view_closed = 'Pouíva Quicksilver Fórum ak je zatvorené';
		$this->perms_do_anything = 'Pouíva Quicksilver Fórum';
		$this->perms_edit_for = 'Editova práva pre';
		$this->perms_email_use = 'Posla email uívate¾om cez fórum';
		$this->perms_forum_view = 'Zobrazi fórum';
		$this->perms_is_admin = 'Prístup k administrátorskému ovládaciemu panelu (CP)';
		$this->perms_only_user = 'Pre tohoto uívate¾a aplikova iba práva jeho skupiny';
		$this->perms_override_user = 'Tımto prekryjete práva skupiny pre tohoto uívate¾a.';
		$this->perms_pm_noflood = 'Vyòa z kontroly zahltenosti osobného odkazovaèa';
		$this->perms_poll_create = 'Zaklada hlasovania';
		$this->perms_poll_vote = 'Hlasova';
		$this->perms_post_attach = 'Pripája prílohy k príspevkom';
		$this->perms_post_attach_download = 'Sahova prílohy príspevkov';
		$this->perms_post_create = 'Vytvára odpovede';
		$this->perms_post_delete = 'Maza lubovo¾nı príspevok';
		$this->perms_post_delete_own = 'Maza iba vlastné príspevky';
		$this->perms_post_edit = 'Editova lubovo¾nı príspevok';
		$this->perms_post_edit_own = 'Editova iba vlastné príspevky';
		$this->perms_post_inc_userposts = 'Posts contribute to user\'s total post count'; //Translate
		$this->perms_post_noflood = 'Vyòa z kontroly zahltenosti príspevkov';
		$this->perms_post_viewip = 'Zobrazova IP adresu uívate¾ov';
		$this->perms_search_noflood = 'Vyòa z kontroly	zahltenosti vyhladávania';
		$this->perms_title = 'Nastavenia uívate¾skej skupiny';
		$this->perms_topic_create = 'Vytváranie tém';
		$this->perms_topic_delete = 'Mazanie ¾ubovo¾nej témy';
		$this->perms_topic_delete_own = 'Mazanie vlastnıch tém';
		$this->perms_topic_edit = 'Editova ¾ubovo¾nú tému';
		$this->perms_topic_edit_own = 'Editova iba vlastné témy';
		$this->perms_topic_global = 'Zapína zobrazenie témy vo všetkıch fórach';
		$this->perms_topic_lock = 'Zamykanie ¾ubovo¾nıch tém';
		$this->perms_topic_lock_own = 'Zamykanie iba vlastnıch tém';
		$this->perms_topic_move = 'Presúvanie ¾ubovo¾nıch tém';
		$this->perms_topic_move_own = 'Presúvanie iba vlastnıch tém';
		$this->perms_topic_pin = 'Prišpendlenie ¾ubovo¾nej témy';
		$this->perms_topic_pin_own = 'Prišpendlenie iba vlastnıch tém';
		$this->perms_topic_publish = 'Publish or unpublish any topic'; //Translate
		$this->perms_topic_publish_auto = 'New topics are marked as published'; //Translate
		$this->perms_topic_split = 'Rozde¾ovanie ¾ubovo¾nej témy na viaceré témy';
		$this->perms_topic_split_own = 'Rozde¾ovanie iba vlastnıch tém na viaceré témy';
		$this->perms_topic_unlock = 'Odomykanie ¾ubovo¾nıch tém';
		$this->perms_topic_unlock_mod = 'Odomykanie zámku moderátora';
		$this->perms_topic_unlock_own = 'Odomykanie iba	vlastnıch zámkov';
		$this->perms_topic_unpin = 'Odšpendlenie ¾ubovo¾nıch tém';
		$this->perms_topic_unpin_own = 'Odšpendlenie iba vlastnıch tém';
		$this->perms_topic_view = 'Prezeranie tém';
		$this->perms_topic_view_unpublished = 'View unpublished topics'; //Translate
		$this->perms_updated = 'Práva boli zaktualizované.';
		$this->perms_user_inherit = 'Uívate¾ zdedí práva skupiny.';
	}

	function php_info()
	{
		$this->php_error = 'Error'; //Translate
		$this->php_error_msg = 'phpinfo() sa nedá zavola. Pravdepodobne je táto funkcia zakázana.';
	}

	function pm()
	{
		$this->pm_avatar = 'Avatar'; //Translate
		$this->pm_cant_del = 'Nemáte povolenie zmaza tento odkaz.';
		$this->pm_delallmsg = 'Zmaza všetky odkazy';
		$this->pm_delete = 'Zmaza';
		$this->pm_delete_selected = 'Zmaza oznaèené správy';
		$this->pm_deleted = 'Odkaz bol zmazanı.';
		$this->pm_deleted_all = 'Odkazy boli zmazané.';
		$this->pm_error = 'Pri zasielaní mailu niektorım
	adresátom sa vyskytli problémy.<br /><br />Nasledujúci uívatelia neexistujú: %s<br /><br />Nasledujúci uívatelia neprijímajú odkazy: %s';
		$this->pm_fields = 'Váš odkaz sa nedá posla. Uistite sa, e ster vyplnili všetky povinné polia.';
		$this->pm_flood = 'Za poslednıch %s sekúnd ste poslali príspevok a momentálne nemôete posla další.<br /><br />Prosím, skúste to za nieko¾ko sekúnd znovu.';
		$this->pm_folder_inbox = 'Prijaté';
		$this->pm_folder_new = '%s nové';
		$this->pm_folder_sentbox = 'Odoslané';
		$this->pm_from = 'Odosielate¾:';
		$this->pm_group = 'Skupina';
		$this->pm_guest = 'Ako návštevník (guest) nemáte povolenie pouíva odkazovaè. Prosím nalogujte sa alebo sa zaregistrujte.. alebo sa dajte vypcha.';
		$this->pm_joined = 'Registrácia';
		$this->pm_messenger = 'Odkazovaè';
		$this->pm_msgtext = 'Text odkazu';
		$this->pm_multiple = 'Viacerıch adresátov odde¾te znakom ;';
		$this->pm_no_folder = 'Musíte zada adresár.';
		$this->pm_no_member = 'Takéto ID nemá iadny èlen.';
		$this->pm_no_number = 'Takéto èíslo nemá iadny odkaz.';
		$this->pm_no_title = 'Chıba predmet';
		$this->pm_nomsg = 'V tomto adresári nie sú iadne odkazy.';
		$this->pm_noview = 'Nemáte povolenie prezera si tento odkaz.';
		$this->pm_offline = 'Tento uívate¾ je momentálne offline';
		$this->pm_online = 'Tento uívate¾ je momentálne online';
		$this->pm_personal = 'Odkazovaè';
		$this->pm_personal_msging = 'Posielanie odkazu';
		$this->pm_pm = 'Odkaz';
		$this->pm_posts = 'Príspevky';
		$this->pm_preview = 'Náh¾ad';
		$this->pm_recipients = 'Adresáti';
		$this->pm_reply = 'Odpoveda';
		$this->pm_send = 'Posla';
		$this->pm_sendamsg = 'Posla odkaz';
		$this->pm_sendingpm = 'Posielanie odkazu';
		$this->pm_sendon = 'Odoslané v';
		$this->pm_success = 'Váš odkaz bol úspešne zaslanı.';
		$this->pm_sure_del = 'Urèite chcete zmaza tento odkaz?';
		$this->pm_sure_delall = 'Urèite chcete zmaza všetky odkazy v tomto adresári?';
		$this->pm_title = 'Nadpis';
		$this->pm_to = 'Komu';
	}

	function post()
	{
		$this->post_attach = 'Prílohy';
		$this->post_attach_add = 'Prida prílohu';
		$this->post_attach_disrupt = 'Pridávanie alebo uberanie príloh nenaruší Váš príspevok.';
		$this->post_attach_failed = 'Upload prílohy neuspel. Súbor, ktorı ste špecifikovali asi neexistuje.';
		$this->post_attach_not_allowed = 'Súbory tohoto typu nemono priloi.';
		$this->post_attach_remove = 'Odobra prílohu';
		$this->post_attach_too_large = 'Špecifikovanı súbor je prive¾kı. Maximálna povolená ve¾kos je %d kB.';
		$this->post_cant_create = 'Ako návštevník (guest) nemáte povolenie zaklada témy. Ak sa zaregistrujete, mono budete ma.';
		$this->post_cant_create1 = 'Nemáte povolenie zaklada témy.';
		$this->post_cant_enter = 'Vaše hlasovanie je neplatné. buï ste o tejto otázke u hlasovali alebo nemáte povolenie hlasova.';
		$this->post_cant_poll = 'Ako návštevník (guest) nemáte povolenie zaklada hlasovania. Ak sa zaregistrujete, mono budete ma.';
		$this->post_cant_poll1 = 'Nemáte povolenie zaklada hlasovania.';
		$this->post_cant_reply = 'Nemáte povolenie odpoveda na témy pod tımto fórom.';
		$this->post_cant_reply1 = 'Ako návštevník (guest) nemáte povolenie odpoveda na témy. Ak sa zaregistrujete, mono budete ma.';
		$this->post_cant_reply2 = 'Nemáte povolenie odpoveda na témy.';
		$this->post_closed = 'Téma bola uzavretá.';
		$this->post_create_poll = 'Zaloi hlasovanie';
		$this->post_create_topic = 'Zaloi tému';
		$this->post_creating = 'Zaloenie témy';
		$this->post_creating_poll = 'Zaloenie hlasovania';
		$this->post_flood = 'Poslali ste príspevok v priebehu uplynulıch %s sekúnd a práve teraz asi nebude moné znova prispie.<br /><br />Prosím, skúste to znova za nieko¾ko sekúnd.';
		$this->post_guest = 'Hos';
		$this->post_icon = 'Ikona príspevku';
		$this->post_last_five = 'Poslednıch pä príspevkov v opaènom poradí';
		$this->post_length = 'Kontrola dåky';
		$this->post_msg = 'Príspevok';
		$this->post_must_msg = 'Musíte ešte napísa samotnı odkaz.';
		$this->post_must_options = 'Musíte zada moné odpovede pre nové hlasovanie.';
		$this->post_must_title = 'Musíte zada nadpis pre novú tému.';
		$this->post_new_poll = 'Nové hlasovanie';
		$this->post_new_topic = 'Nová téma';
		$this->post_no_forum = 'Toto fórum sa nenašlo.';
		$this->post_no_topic = 'Nešpecifikovali ste tému.';
		$this->post_no_vote = 'Ak chcete hlasova, je vhodné zvoli si odpoveï.';
		$this->post_option_emoticons = 'Konvertova textové smajlíky na obrázky?';
		$this->post_option_global = 'Globalizova túto tému?';
		$this->post_option_mbcode = 'Interpretova Mb-kód?';
		$this->post_optional = 'nepovinné';
		$this->post_options = 'Monosti';
		$this->post_poll_options = 'Monosti hlasovania';
		$this->post_poll_row = 'Jeden na riadok';
		$this->post_posted = 'Zaslané: ';
		$this->post_posting = 'Posiela sa';
		$this->post_preview = 'Náh¾ad';
		$this->post_reply = 'Odpoveda';
		$this->post_reply_topic = 'Odpoveda na tému';
		$this->post_replying = 'Odpovedá sa na tému';
		$this->post_replying1 = 'Odpovedá sa';
		$this->post_too_many_options = 'Hlasovanie musí ma minimálne 2 a maximálne %d monıch odpovedí.';
		$this->post_topic_detail = 'Popis témy';
		$this->post_topic_title = 'Nadpis témy';
		$this->post_view_topic = 'Ukáza celú tému';
		$this->post_voting = 'Hlasuje sa';
	}

	function printer()
	{
		$this->printer_back = 'Spä';
		$this->printer_not_found = 'Téma sa nenašla. Mono bola zmazaná, presunutá alebo vôbec nebola.';
		$this->printer_not_found_title = 'Téma sa nenašla';
		$this->printer_perm_topics = 'Nemáte povolenie na prezeranie tém.';
		$this->printer_perm_topics_guest = 'Nemáte povolenie na prezeranie tém. Ak sa zaregistrujete, mono budete ma.';
		$this->printer_posted_on = 'Zaslané: ';
		$this->printer_send = 'Odosla na tlaèiareò';
	}

	function profile()
	{
		$this->profile_aim_sn = 'AIM Name'; //Translate
		$this->profile_av_sign = 'Avatar a podpis';
		$this->profile_avatar = 'Avatar'; //Translate
		$this->profile_bday = 'Narodeniny';
		$this->profile_contact = 'Kontakt';
		$this->profile_email_address = 'Emailová adresa';
		$this->profile_fav = 'Ob¾úbené fórum';
		$this->profile_fav_forum = '%s (%d%% príspevkov tohoto uívate¾a)';
		$this->profile_gtalk = 'GTalk konto';
		$this->profile_icq_uin = 'ICQ Number'; //Translate
		$this->profile_info = 'Informácie';
		$this->profile_interest = 'Zá¾uby';
		$this->profile_joined = 'Registrácia';
		$this->profile_last_post = 'Najnovší príspevok';
		$this->profile_list = 'Zoznam èlenov';
		$this->profile_location = 'Sídlo';
		$this->profile_member = 'Skupina èlenov';
		$this->profile_member_title = 'Titul èlena';
		$this->profile_msn = 'MSN Identity'; //Translate
		$this->profile_must_user = 'Ak si chcete prezrie profil, musíte špecifikova uivate¾a.';
		$this->profile_no_member = 'S takımto ID nemáme iadneho uívate¾a. Mono bolo toto konto zrušené.';
		$this->profile_none = '[ prázdne ]';
		$this->profile_not_post = 'ešte sa to nezaslalo.';
		$this->profile_offline = 'Tento uívate¾ je momentálne offline';
		$this->profile_online = 'Tento uívate¾ je momentálne online';
		$this->profile_pm = 'Odkazy';
		$this->profile_postcount = '%s celkovo, %s denne';
		$this->profile_posts = 'Príspevky';
		$this->profile_private = '[ Zatajená ]';
		$this->profile_profile = 'Profil';
		$this->profile_signature = 'Podpis';
		$this->profile_unkown = '[ Neznámo ]';
		$this->profile_view_profile = 'Prezeranie profilu';
		$this->profile_www = 'Homepage'; //Translate
		$this->profile_yahoo = 'Yahoo Identity'; //Translate
	}

	function prune()
	{
		$this->prune_action = 'Spôsob prerieïovania';
		$this->prune_age_day = '1 Deò';
		$this->prune_age_eighthours = '8 Hodín';
		$this->prune_age_hour = '1 Hodína';
		$this->prune_age_month = '1 Mesiac';
		$this->prune_age_threemonths = '3 Mesiace';
		$this->prune_age_week = '1 Tıdeò';
		$this->prune_age_year = '1 Rok';
		$this->prune_forums = 'Vyberte fórum na preriedenie';
		$this->prune_invalidage = 'Bol zvolenı neplatnı vek na preriedenie';
		$this->prune_move = 'Presunú';
		$this->prune_moveto_forum = 'Cie¾ové fórum presunu';
		$this->prune_nodest = 'Nebol vybranı platnı cie¾';
		$this->prune_notopics = 'Neboli vybrané iadne témy na preriedenie';
		$this->prune_notopics_old = 'iadna téme nie je dostatoène stará na preriedenie';
		$this->prune_novalidforum = 'Nebolo vybrané platné fórum na preriedenie';
		$this->prune_select_age = 'Vyberte vek tém, ktorı bude limitova preriedenie';
		$this->prune_select_topics = 'Vyberte témy na preriedenie alebo pouite Vybra Všetko';
		$this->prune_success = 'Témy boli preriedené';
		$this->prune_title = 'Prerieïovaè tém';
		$this->prune_topics_older_than = 'Preriedi témy staršie ako';
	}

	function query()
	{
		$this->query = 'Rozhranie pre mysql dotazy';
		$this->query_fail = 'zlyhal.';
		$this->query_success = 'úspešne vykonanı.';
		$this->query_your = 'Váš dotaz';
	}

	function recent()
	{
		$this->recent_active = 'Aktívne témy od poslednej návštevy';
		$this->recent_by = 'Napísal';
		$this->recent_can_post = 'V tomto fóre môete odpoveda.';
		$this->recent_can_topics = 'V tomto fóre si môete prezera témy.';
		$this->recent_cant_post = 'V tomto fóre nemáte povolenie odpoveda.';
		$this->recent_cant_topics = 'V tomto fóre nemáte povolenie prezera témy.';
		$this->recent_dot = 'dot(to èo je?)';
		$this->recent_dot_detail = 'ukazuje, e ste pod danú tému prispeli';
		$this->recent_forum = 'Fórum';
		$this->recent_guest = 'Hos';
		$this->recent_hot = 'dôleité';
		$this->recent_icon = 'Ikona správy';
		$this->recent_jump = 'Hop na najnovšie príspevky pod touto témou';
		$this->recent_last = 'Najnovší príspevok';
		$this->recent_locked = 'Zamknuté';
		$this->recent_moved = 'Presunuté';
		$this->recent_msg = '%s Správa';
		$this->recent_new = 'nové';
		$this->recent_new_poll = 'Zaloi nové hlasovanie';
		$this->recent_new_topic = 'Zaloi novú tému';
		$this->recent_no_topics = 'V tomto fóre nie sú iadne témy.';
		$this->recent_noexist = 'Zadané fórum neexistuje.';
		$this->recent_nopost = 'Nie sú príspevky';
		$this->recent_not = 'málo';
		$this->recent_noview = 'Nemáte povolenie na prezeranie fór.';
		$this->recent_pages = 'Stránky';
		$this->recent_pinned = 'Prišpendlené';
		$this->recent_pinned_topic = 'Prišpendlená téma';
		$this->recent_poll = 'Hlasovanie';
		$this->recent_regfirst = 'Nemáte povolenie na prezeranie fór. Ak sa zaregistrujete, mono budete ma?.';
		$this->recent_replies = 'Odpovede';
		$this->recent_starter = 'Zakladate¾';
		$this->recent_sub = 'Pod-Fórum';
		$this->recent_sub_last_post = 'Najnovší príspevok';
		$this->recent_sub_replies = 'Odpovede';
		$this->recent_sub_topics = 'Témy';
		$this->recent_subscribe = 'Posla emailom nové príspevky v tomto fóre';
		$this->recent_topic = 'Téma';
		$this->recent_views = 'Videné';
		$this->recent_write_topics = 'V tomto fóre máte povolenie zaklada témy.';
	}

	function register()
	{
		$this->register_activated = 'Vaše konto bolo aktivované!';
		$this->register_activating = 'Aktivácia konta';
		$this->register_activation_error = 'Aktivovanie Vašeho konta zlyhalo. Skontrolujte, èi je vo Vašom prehliadaèi plá URL cesta z aktivaèného emailu. Ak problém zotrváva, skontaktujte sa s administrátorom fóra.';
		$this->register_confirm_passwd = 'Potvrdenie hesla';
		$this->register_done = 'Boli ste zaregistrovanı! Teraz sa môete nalogova.';
		$this->register_email = 'Emailová adresa';
		$this->register_email_invalid = 'Zadaná emailová adresa je neplatná.';
		$this->register_email_msg = 'Toto je automatickı email, vygenerovanı Quicksilver Fórom a bol Vám zasladnı z titulu';
		$this->register_email_msg2 = 'pre Vás, kvôli aktivácii konta s';
		$this->register_email_msg3 = 'Prosím, kliknite na nasledujúci link alebo ho skopírujte do Vašeho web browsera:';
		$this->register_email_used = 'Zadaná emailová adresa u bola pridelená inému èlenovi.';
		$this->register_fields = 'Neboli vyplnené všetky polia.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = 'Prosím napíšte text, ktorı je na obrázku.';
		$this->register_image_invalid = 'Kvôli obmedzeniu automatizovaného registrovania musíte opísa text, ktorı vidíte na obrázku.';
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'Boli ste zaregistrovanı. Na adresu %s bol zaslanı email s informáciami oo aktivácii Vašeho konta. Vaše konto bude obmedzené, pokia¾ si ho neaktivujete.';
		$this->register_name_invalid = 'Zadané meno je pridlhé.';
		$this->register_name_taken = 'Toto èlenské meno je u obsadené.';
		$this->register_new_user = 'elané èlenské meno';
		$this->register_pass_invalid = 'Zadané heslo je neplatné. Uistite sa, e pouívate len platné znaky ako sú písmená, èísla, pomlèka, podtrítko alebo medzera a obsahuje aspoò 5 znakov.';
		$this->register_pass_match = 'Heslá, ktoré ste zadali sa nezhodujú.';
		$this->register_passwd = 'Heslo';
		$this->register_reg = 'Registrácia';
		$this->register_reging = 'Prebieha registrácia';
		$this->register_requested = 'Account activation request for:'; //Translate
		$this->register_tos = 'Podmienky pouívania';
		$this->register_tos_i_agree = 'Súhlasím s vyššie formulovanımi podmienkami';
		$this->register_tos_not_agree = 'Nesúhlasili ste s podmienkami.';
		$this->register_tos_read = 'Prosím, preèítajte si nasledujúce podmienky poskytovania sluieb';
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
		$this->search_advanced = 'Ïalšie monosti';
		$this->search_avatar = 'Avatar'; //Translate
		$this->search_basic = 'Základné vyh¾adávanie';
		$this->search_characters = 'znakov z príspevku';
		$this->search_day = 'deò';
		$this->search_days = 'dni';
		$this->search_exact_name = 'presnı názov';
		$this->search_flood = 'V priebehu poslednıch %s sekúnd ste pouili vyh¾adávanie a momentálne nemôete vyh¾adáva znovu.<br /><br />Prosím, skúste to o nieko¾ko sekúnd.';
		$this->search_for = 'H¾ada';
		$this->search_forum = 'Fórum';
		$this->search_group = 'Skupina';
		$this->search_guest = 'Hos';
		$this->search_in = 'H¾ada v';
		$this->search_in_posts = 'H¾ada iba v príspevkoch';
		$this->search_ip = 'IP'; //Translate
		$this->search_joined = 'Registrácia';
		$this->search_level = 'Úroveò uívate¾a';
		$this->search_match = 'H¾adanie (presná zhoda)';
		$this->search_matches = 'Nálezy';
		$this->search_month = 'mesiac';
		$this->search_months = 'mesiace';
		$this->search_mysqldoc = 'MySQL Dokumentácia';
		$this->search_newer = 'novších';
		$this->search_no_results = 'Vaše h¾adanie dopadlo bezvısledne.';
		$this->search_no_words = 'Ak chcete vyh¾adáva, musíte zada nejaké slová.<br /><br />Kadé slovo musí ma viac ako 3 znaky vrátane písmen, èísiel, apostrofov a podtrítok.';
		$this->search_offline = 'Tento uívate¾ je momentálne offline';
		$this->search_older = 'starších';
		$this->search_online = 'tento uívate¾ je momentálne online.';
		$this->search_only_display = 'Zobrazi len prvıch';
		$this->search_partial_name = 'èiastoènı názov name';
		$this->search_post_icon = 'Ikona príspevku';
		$this->search_posted_on = 'Zaslané: ';
		$this->search_posts = 'Príspevky';
		$this->search_posts_by = 'Len príspevky od uívate¾a';
		$this->search_regex = 'H¾ada pomocou regulárnych vırazov';
		$this->search_regex_failed = 'Váš regulárny vıraz neuspel. Prosím prezrite si MySQL documentation, sta o regulárnych vırazoch.';
		$this->search_relevance = 'Platnos príspevku: %d%%';
		$this->search_replies = 'Príspevky';
		$this->search_result = 'Vısledky h¾adania';
		$this->search_search = 'Zaèa h¾adanie';
		$this->search_select_all = 'kadom';
		$this->search_show_posts = 'Zobrazi odpovedajúce príspevky';
		$this->search_sound = 'H¾ada pod¾a zvuku (sound)';
		$this->search_starter = 'Zakladate¾';
		$this->search_than = 'ako';
		$this->search_topic = 'Téma';
		$this->search_unreg = 'Nezaregistrovanı';
		$this->search_week = 'tıdeò';
		$this->search_weeks = 'tıdne';
		$this->search_year = 'rok';
	}

	function settings()
	{
		$this->settings = 'Nastavenia';
		$this->settings_active = 'Nastavenia aktívnych uívate¾ov';
		$this->settings_allow = 'Povoli';
		$this->settings_antibot = 'Anti-Robot Registrácia';
		$this->settings_attach_ext = 'Prílohy - prípony súborov';
		$this->settings_attach_one_per = 'Kadı na samostatnom riadku, bez bodiek.';
		$this->settings_avatar = 'Nastavenia Avatara';
		$this->settings_avatar_flash = 'Flash Avatari';
		$this->settings_avatar_max_height = 'Maximálna vıška Avatara';
		$this->settings_avatar_max_width = 'Maximálna šírka Avatara';
		$this->settings_avatar_upload = 'Uploadovaní Avatari - maximálna ve¾kost súboru';
		$this->settings_basic = 'Editova nastavenia fór';
		$this->settings_blank = 'Pre nové okno pouite <i>_blank</i>.';
		$this->settings_board_enabled = 'Fórum je prístupné';
		$this->settings_board_location = 'Adresa fóra';
		$this->settings_board_name = 'Názov fóra';
		$this->settings_board_rss = 'Nastavenia RSS Feed';
		$this->settings_board_rssfeed_desc = 'Popis RSS Feed';
		$this->settings_board_rssfeed_posts = 'Poèet príspevkov, obsiahnutıch v RSS Feed';
		$this->settings_board_rssfeed_time = 'Frekvencia obnovovania v minútach';
		$this->settings_board_rssfeed_title = 'Názov RSS Feed';
		$this->settings_clickable = 'Kliknute¾né smajlíky na jeden riadok';
		$this->settings_cookie = 'Nastavenia Cookie a controly zahltenia';
		$this->settings_cookie_path = 'Cesta pre Cookie';
		$this->settings_cookie_prefix = 'Predpona pre Cookie';
		$this->settings_cookie_time = 'Doba platnosti prihlásenia';
		$this->settings_db = 'Editova nastavenia pripojenia';
		$this->settings_db_host = 'Databázovı server (Host)';
		$this->settings_db_leave_blank = 'Nechajte prázdne v prípade absencie.';
		$this->settings_db_multiple = 'Pre inštaláciu viacerıch fór do jednej databázy.';
		$this->settings_db_name = 'Názov Databázy';
		$this->settings_db_password = 'Heslo do Databázy';
		$this->settings_db_port = 'Port pripojenia k Databáza';
		$this->settings_db_prefix = 'Predpona Tabuliek';
		$this->settings_db_socket = 'Socket Databázy';
		$this->settings_db_username = 'Meno uívate¾a pre pripojenie k Databáze';
		$this->settings_debug_mode = 'Debug Mode'; //Translate
		$this->settings_default_lang = 'Prednastavenı Jazyk';
		$this->settings_default_no = 'Prednastavi NIE';
		$this->settings_default_skin = 'Prednastavenı Skin';
		$this->settings_default_yes = 'Prednastavi ÁNO';
		$this->settings_disabled = 'Neprístupné';
		$this->settings_disabled_notice = 'Poznámka o neprístupnosti';
		$this->settings_email = 'Nastavenia E-Mailu';
		$this->settings_email_fake = 'Zobrazovanı email. Toto by nemala by skutoèná emailová adresa.';
		$this->settings_email_from = 'E-mail odosielate¾a';
		$this->settings_email_place1 = 'Umiestni uívate¾ov do';
		$this->settings_email_place2 = 'skupiny, dokia¾ neoveria platnos svojej emailovej adresy';
		$this->settings_email_place3 = 'Nevyadova aktiváciu emailom';
		$this->settings_email_real = 'Toto by nemala by skutoèná e-mailová adresa.';
		$this->settings_email_reply = 'E-mail pre odpoveï (odosielate¾)';
		$this->settings_email_smtp = 'SMTP Poštovı Server';
		$this->settings_email_valid = 'Overenie  E-mailu nového uívate¾a';
		$this->settings_enabled = 'Prístupné';
		$this->settings_enabled_modules = 'Povolené Moduly';
		$this->settings_foreign_link = 'Link, nasmerovanı na cudzí server';
		$this->settings_general = 'Obecné Nastavenia';
		$this->settings_group_after = 'Skupina po zaregistrovaní';
		$this->settings_hot_topic = 'Príspevky na horúcu tému';
		$this->settings_kilobytes = 'Kilobajtov';
		$this->settings_max_attach_size = 'Príloha - maximálna ve¾kos súboru';
		$this->settings_members = 'Nastavenia uívate¾ov';
		$this->settings_modname_only = 'Iba názvy Modulov. Bez prípony .php';
		$this->settings_new = 'New Setting'; //Translate
		$this->settings_new_add = 'Add Board Setting';
		$this->settings_new_added = 'New settings added.'; //Translate
		$this->settings_new_exists = 'That setting already exists. Choose another name for it.'; //Translate
		$this->settings_new_name = 'New setting name'; //Translate
		$this->settings_new_required = 'The new setting name is required.'; //Translate
		$this->settings_new_value = 'New setting value'; //Translate
		$this->settings_no_allow = 'Zakáza';
		$this->settings_nodata = 'Metódoo POST neboli poslané iadne data';
		$this->settings_one_per = 'Kadı na samostatnı riadok';
		$this->settings_pixels = 'Pixlov';
		$this->settings_pm_flood = 'Kontrola zahltenosti osobného odkazovaèa';
		$this->settings_pm_min_time = 'Minimálny èas medzi dvoma nasledujúcimi odkazmi.';
		$this->settings_polls = 'Hlasovania';
		$this->settings_polls_no = 'Uívatelia nemôu hlasova po zhliadnutí vısledkov hlasovania';
		$this->settings_polls_yes = 'Uívatelia môu hlasova po zhliadnutí vısledkov hlasovania';
		$this->settings_post_flood = 'Kontrola zahltenia príspevkov';
		$this->settings_post_min_time = 'Minimálny èas medzi dvoma nasledujúcimi príspevkami.';
		$this->settings_posts_topic = 'Poèet príspevkov na jednu stránku témy';
		$this->settings_search_flood = 'Kontrola zahltenia vyh¾adávania';
		$this->settings_search_min_time = 'Minimálny èas medzi dvoma nasledujúcimi vyh¾adávaniami.';
		$this->settings_server = 'Nastavenia Servera';
		$this->settings_server_gzip = 'GZIP Kompresia';
		$this->settings_server_gzip_msg = 'Zvyšuje rıchlos. Zakáte túto vlasnost, pokia¾ sa fórum nezobrazuje správne alebo vôbec.';
		$this->settings_server_maxload = 'Maximálna Záa Servera';
		$this->settings_server_maxload_msg = 'Zneprístupni fórum pri mimoriadnom zaaení servera. Zadajte 0 pre vypnutie tejto vlastnosti.';
		$this->settings_server_timezone = 'Èasové Pásmo Servera';
		$this->settings_show_avatars = 'Zobrazova Avatarov';
		$this->settings_show_email = 'Zobrazova Emailové Adresy';
		$this->settings_show_emotes = 'Zobrazova smajlíky';
		$this->settings_show_notice = 'Zobrazova fórum, ak je zneprístupnené';
		$this->settings_show_pm = 'Prijíma osobné odkazy';
		$this->settings_show_sigs = 'Zobrazova Podpisy';
		$this->settings_spider_agent = 'Spider User Agent'; //Translate
		$this->settings_spider_agent_msg = 'Zadajte celú alebo iba èas unikátnej premennej HTTP USER AGENT spidera.';
		$this->settings_spider_enable = 'Povoli zobrazenia Spidera';
		$this->settings_spider_enable_msg = 'Povoli názvy vyh¾adávacích spiderov v zozname aktívnych uívate¾ov.';
		$this->settings_spider_name = 'Názov Spidera';
		$this->settings_spider_name_msg = 'Zadajte názov, ktorı sa bude zobrazova pre kadého z vyššie definovanıch spiderov v zozname aktívnych uívate¾ov. Musíte umiestni názov spidera na ten istı riadok, ako spider user agent, definovanı vyššie. Napríklad ak umiestníte \'googlebot\' do tretieho riadku v agentoch, umiestnite \'Google\' do tretieho riadku v názvoch Spiderov.';
		$this->settings_timezone = 'Èasové Pásmo';
		$this->settings_topics_page = 'Poèet tém na jednej stránke fóra';
		$this->settings_tos = 'Podmienky Pouitia';
		$this->settings_updated = 'Nastavenia boli zaktualizované.';
	}

	function stats()
	{
		$this->stats = 'Štatistické Centrum';
		$this->stats_post_by_month = 'Poèet príspevkov na mesiac';
		$this->stats_reg_by_month = 'Poèet registrácií na mesiac';
	}

	function templates()
	{
		$this->add = 'Prida HTML Šablóny';
		$this->add_in = 'Prida šablónu na:';
		$this->all_fields_required = 'Musíte vyplni všetky polia, aby bola pridané šablóna';
		$this->choose_css = 'Choose CSS Template'; //Translate
		$this->choose_set = 'Zvoli sadu šablón';
		$this->choose_skin = 'Zvo¾i skin';
		$this->confirm1 = 'Chystáte sa zmaza';
		$this->confirm2 = 'Šablóna od';
		$this->create_new = 'Zaloi novı skin s názvom';
		$this->create_skin = 'Zaloi Skin';
		$this->credit = 'Prosím, neodstraòujte náš jedinı kredit!';
		$this->css_edited = 'CSS file has been updated.'; //Translate
		$this->css_fioerr = 'The file could not be written to, you will need to CHMOD the file manually.'; //Translate
		$this->delete_template = 'Zmaza Šablónu';
		$this->directory = 'Adresár';
		$this->display_name = 'Zobrazi názov';
		$this->edit_css = 'Edit CSS'; //Translate
		$this->edit_skin = 'Editova Skin';
		$this->edit_templates = 'Editova Šablónu';
		$this->export_done = 'Skin bol exportovanı do hlavného adresára Quicksilver Fóra.';
		$this->export_select = 'Vyberte skin, ktorı chcete exportova';
		$this->export_skin = 'Exportova Skin';
		$this->install_done = 'Skin bol úspešne nainštalovanı.';
		$this->install_exists1 = 'Tento skin je pravdepodobne';
		$this->install_exists2 = 'u je nainštalovanı.';
		$this->install_overwrite = 'Prepísa';
		$this->install_skin = 'Nainštalova Skin';
		$this->menu_title = 'Zvo¾te sekciu šablóny, ktorú chcete editova';
		$this->no_file = 'No such file.'; //Translate
		$this->only_skin = 'Momentálne je nainštalovanı iba jeden skin. Tento skin nesmiete zmaza.';
		$this->or_new = 'Alebo vytvori novú skupinu šablôn s názvom:';
		$this->select_skin = 'Zvo¾te Skin';
		$this->select_skin_edit = 'Zvo¾te skin, ktorı chcete editova';
		$this->select_skin_edit_done = 'Skin bol úspešne zeditovanı.';
		$this->select_template = 'Zvo¾te šablónu';
		$this->skin_chmod = 'NOvı adresár pre skin sa nepodarilo vytvori. Skúste príkaz CHMOD adresár skinu 775.';
		$this->skin_created = 'Skin bol vytvorenı.';
		$this->skin_deleted = 'Skin bo úspešne zmazanı.';
		$this->skin_dir_name = 'Musíet zada názov skinu a adresára.';
		$this->skin_dup = 'Skin s rovnakım názvom adresára u existuje. Názov adresára skinu bol zmenenı na';
		$this->skin_name = 'Musíte zada názov skinu.';
		$this->skin_none = 'Neexistujú iadne nainštalovate¾né skiny.';
		$this->skin_set = 'Sada Skinov';
		$this->skins_found = 'Nasledujúce skiny sa nachádzajú v adresári Quicksilver Fóra';
		$this->template_about = 'O premennıch';
		$this->template_about2 = 'Premenné sú èasti textu, ktoré sú nahrádzané dynamickımi datami. Premené sa vdy zaèínajú znakom dolár a niekedy sú obhranièené {zátvorkami}.';
		$this->template_add = 'Prida';
		$this->template_added = 'Šablóna bola pridaná.';
		$this->template_clear = 'Vyèisti';
		$this->template_confirm = 'Šablóny boli modifikované. Chcete tieto zmeny zapísa?';
		$this->template_description = 'Popis Šablóny';
		$this->template_html = 'HTML Šablóna';
		$this->template_name = 'Názov Šablóny';
		$this->template_position = 'Pozícia Šablóny';
		$this->template_set = 'Sada Šablón';
		$this->template_title = 'Nadpis Šablóny';
		$this->template_universal = 'Univerzálna Premenná';
		$this->template_universal2 = 'Niektoré premenné môu by pouité v lubovo¾nej šablone, zatia¾ èo ostatné sú platné len v jednej šablóne. Vlastnosti objektu $this môu by pouite všade.';
		$this->template_updated = 'Šablona bola zaktualizovaná.';
		$this->templates = 'Šablony';
		$this->temps_active = 'Detaily aktívneho uívate¾a';
		$this->temps_admin = '<b>AdminCP Universal</b>'; //Translate
		$this->temps_ban = 'AdminCP Blokovania';
		$this->temps_board_index = 'Index Fór';
		$this->temps_censoring = 'AdminCP Cenzúra Slov';
		$this->temps_cp = 'Ovládací panel uívate¾a';
		$this->temps_email = 'Posa Email Uívate¾ovi';
		$this->temps_emot_control = 'AdminCP Smajlíky';
		$this->temps_forum = 'Fóra';
		$this->temps_forums = 'AdminCP Fóra';
		$this->temps_groups = 'AdminCP Skupiny';
		$this->temps_help = 'Help'; //Translate
		$this->temps_login = 'Prihlasovanie a Odhlasovanie';
		$this->temps_logs = 'AdminCP Moderator Logs'; //Translate
		$this->temps_main = '<b>Board Universal</b>'; //Translate
		$this->temps_mass_mail = 'AdminCP Hromadnı Mail';
		$this->temps_member_control = 'AdminCP Nastavenia Uívate¾ov';
		$this->temps_members = 'Zoznam Uívate¾ov';
		$this->temps_mod = 'Nastavenia Moderátora';
		$this->temps_pm = 'Osobnı odkazovaè';
		$this->temps_polls = 'Hlasovania';
		$this->temps_post = 'Posielanie príspevkov';
		$this->temps_printer = 'Rozvrhnutie t#$,1m#(B per tlaè';
		$this->temps_profile = 'Zobrazenie Profilu';
		$this->temps_recent = 'Najnovšie témy';
		$this->temps_register = 'Registrácia';
		$this->temps_rssfeed = 'RSS Feed'; //Translate
		$this->temps_search = 'Vyh¾adávanie';
		$this->temps_settings = 'AdminCP Nastavenia';
		$this->temps_templates = 'AdminCP Editor Šablón';
		$this->temps_titles = 'AdminCP Tituly Uívate¾ov';
		$this->temps_topic_prune = 'AdminCP Topic Pruning'; //Translate
		$this->temps_topics = 'Témy';
		$this->upgrade_skin = 'Upgradova Skin';
		$this->upgrade_skin_already = 'u bol zupgradovanı. Neprebehla iadna akcia.';
		$this->upgrade_skin_detail = 'Skiny zupgradované pomocou tejto metódy budú naïalej vyadova následné editovanie šablôn.<br />Vyberte skin na upgradovanie';
		$this->upgrade_skin_upgraded = 'skin bol zupgradovanı.';
		$this->upgraded_templates = 'Boli pridané nasledujúce šablóny boli';
	}

	function titles()
	{
		$this->titles_add = 'Prida Titul Uívate¾ov';
		$this->titles_added = 'Titul Uívate¾ov bol pridanı.';
		$this->titles_control = 'Member Title Control'; //Translate
		$this->titles_edit = 'Editova Tituly Uívate¾ov';
		$this->titles_error = 'No title text or minimum posts was given'; //Translate
		$this->titles_image = 'Obrázok';
		$this->titles_minpost = 'Minimálny príspevok';
		$this->titles_nodel_default = 'Removal of the default title has been disabled as it will break your board, please edit it instead.'; //Translate
		$this->titles_title = 'Nadpis';
	}

	function topic()
	{
		$this->topic_attached = 'Priloenı súbor:';
		$this->topic_attached_downloads = 'downloads';
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = 'Nemáte povolenie na download tohoto súboru.';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = 'Nadpis priloeného súboru';
		$this->topic_avatar = 'Avatar'; //Translate
		$this->topic_bottom = 'Na spodok stránky';
		$this->topic_create_poll = 'Zaloi nové hlasovanie';
		$this->topic_create_topic = 'Zaloi novú tému';
		$this->topic_delete = 'Zmaza';
		$this->topic_delete_post = 'Zmaza tento príspevok';
		$this->topic_edit = 'Editova';
		$this->topic_edit_post = 'Editova tento príspevok';
		$this->topic_edited = 'Naposledy editovanı v %s uívate¾om %s';
		$this->topic_error = 'Chyba';
		$this->topic_group = 'Skupina';
		$this->topic_guest = 'Návštevník (Guest)';
		$this->topic_ip = 'IP'; //Translate
		$this->topic_joined = 'Registrácia';
		$this->topic_level = 'Èlenskı level';
		$this->topic_links_aim = 'Zasla AIM správu uívate¾ovi %s';
		$this->topic_links_email = 'Zasla email uívate¾ovi %s';
		$this->topic_links_gtalk = 'Zasla GTalk správu uívate¾ovi %s';
		$this->topic_links_icq = 'Zasla ICQ správu uívate¾ovi %s';
		$this->topic_links_msn = 'Zobrazi  MSN profil uívate¾a %s';
		$this->topic_links_pm = 'Zasla odkaz uívate¾ovi %s';
		$this->topic_links_web = 'Navštívi web stránku uívate¾a %s';
		$this->topic_links_yahoo = 'Zasla správu pomocou Yahoo! Messengera uivate¾ovi %s';
		$this->topic_lock = 'Zamknú';
		$this->topic_locked = 'Téma je zamknutá';
		$this->topic_move = 'Presunú';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = 'Newer Topic'; //Translate
		$this->topic_no_newer = 'There is no newer topic.'; //Translate
		$this->topic_no_older = 'There is no older topic.'; //Translate
		$this->topic_no_votes = 'Tu ešte nikto nehlasoval.';
		$this->topic_not_found = 'Téma sa nenašla';
		$this->topic_not_found_message = 'Téma sa nenašla. Mono bola zmazané, presunutá alebo nebola vôbec.';
		$this->topic_offline = 'Tento uívate¾ je momentálne offline';
		$this->topic_older = 'Older Topic'; //Translate
		$this->topic_online = 'Tento uívate¾ je momentálne online';
		$this->topic_options = 'Monosti témy';
		$this->topic_pages = 'Stránky';
		$this->topic_perm_view = 'Nemáte povolenie na prezeranie tém.';
		$this->topic_perm_view_guest = 'Nemáte povolenie na prezeranie tém. Ak sa zaregistrujete, mono budete ma.';
		$this->topic_pin = 'Prišpendli';
		$this->topic_posted = 'Odoslané';
		$this->topic_posts = 'Príspevky';
		$this->topic_print = 'Zobrazi vytlaèite¾nú verziu';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'Emoticons'; //Translate
		$this->topic_qr_open_emoticons = 'Open Clickable Emoticons'; //Translate
		$this->topic_qr_open_mbcode = 'Open MBCode'; //Translate
		$this->topic_quickreply = 'Quick Reply'; //Translate
		$this->topic_quote = 'Odpoveda s citáciou z tohoto príspevku';
		$this->topic_reply = 'Odpoveda na tému';
		$this->topic_split = 'Rozdeli';
		$this->topic_split_finish = 'Dokonèi všetky rozdelenia';
		$this->topic_split_keep = 'Nepresúva tento príspevok';
		$this->topic_split_move = 'Presunú tento príspevok';
		$this->topic_subscribe = 'Zasielanie emailu s odpoveïami na túto tému';
		$this->topic_top = 'Skok na zaèiatok stránky';
		$this->topic_unlock = 'Odomknú';
		$this->topic_unpin = 'Odšpenli';
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = 'Neregistrovanı';
		$this->topic_view = 'Zobrazi vısledky';
		$this->topic_viewing = 'Prezeranie tém';
		$this->topic_vote = 'Zahlasova';
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
		$this->continue = 'Pokraèova';
		$this->date_long = 'M j, Y'; //Translate
		$this->date_short = 'n/j/y'; //Translate
		$this->delete = 'Zmaza';
		$this->direction = 'ltr'; //Translate
		$this->edit = 'Editova HTML Šablóny';
		$this->email = 'Email'; //Translate
		$this->gtalk = 'GT'; //Translate
		$this->icq = 'ICQ'; //Translate
		$this->msn = 'MSN'; //Translate
		$this->new_message = 'Nová správa';
		$this->new_poll = 'Nové hlasovanie';
		$this->new_topic = 'Nová téma';
		$this->no = 'Nie';
		$this->powered = 'Powered by'; //Translate
		$this->private_message = 'PM'; //Translate
		$this->quote = 'Citova';
		$this->recount_forums = 'Recounted forums! Total topics: %d. Total posts: %d.'; //Translate
		$this->reply = 'Odpoveda';
		$this->seconds = 'sec';
		$this->select_all = 'Select All'; //Translate
		$this->sep_decimals = '.'; //Translate
		$this->sep_thousands = ','; //Translate
		$this->spoiler = 'Spoiler'; //Translate
		$this->submit = 'OK';
		$this->subscribe = 'Objedna';
		$this->time_long = ', g:i a'; //Translate
		$this->time_only = 'g:i a'; //Translate
		$this->today = 'Dnes';
		$this->website = 'WWW'; //Translate
		$this->yahoo = 'Yahoo'; //Translate
		$this->yes = 'Áno';
		$this->yesterday = 'vèera';
	}
}
?>
