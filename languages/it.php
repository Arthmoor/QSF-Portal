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
 * Italian language module
 *
 * @author Filippo "Inverno" Bovo <inverno@altervista.org>
 * @author Giuseppe Pignataro <giuseppepignataro@revolutionarymind.org>,
 * @since 1.0.0 RC1
 **/
class it
{
	function active()
	{
		$this->active_last_action = 'Ultima Attività';
		$this->active_modules_active = 'Visualizza Attività Utenti';
		$this->active_modules_board = 'Visualizza Indice';
		$this->active_modules_cp = 'Usa Pannello di Controllo';
		$this->active_modules_forum = 'Visita il forum: %s';
		$this->active_modules_help = 'Usa Help';
		$this->active_modules_login = 'In Connessione o Disconnessione';
		$this->active_modules_members = 'Visualizza Lista Iscritti';
		$this->active_modules_mod = 'Modera';
		$this->active_modules_pm = 'Usa Messaggi Privati';
		$this->active_modules_post = 'Scrive un Messaggio';
		$this->active_modules_printer = 'Stampa la discussione: %s';
		$this->active_modules_profile = 'Visualizza il profilo di: %s';
		$this->active_modules_recent = 'Mostra i messaggi recenti';
		$this->active_modules_search = 'Cerca';
		$this->active_modules_topic = 'Legge la discussione: %s';
		$this->active_time = 'Ora';
		$this->active_user = 'Utente';
		$this->active_users = 'Attività Utenti';
	}

	function admin()
	{
		$this->admin_add_emoticons = 'Aggiungi emoticon';
		$this->admin_add_member_titles = 'Aggiungi titoli utente automatici';
		$this->admin_add_templates = 'Aggiungi template HTML';
		$this->admin_ban_ips = 'Banna IP';
		$this->admin_censor = 'Censura';
		$this->admin_cp_denied = 'Accesso Negato';
		$this->admin_cp_warning = 'Il Pannello d\'Amministrazione resterà disabilitato finchè la cartella <b>install</b> non verrà eliminata, in quanto serio problema di sicurezza.';
		$this->admin_create_forum = 'Crea un forum';
		$this->admin_create_group = 'Crea un gruppo';
		$this->admin_create_help = 'Crea un articolo d\'aiuto';
		$this->admin_create_skin = 'Crea una skin';
		$this->admin_db = 'Database'; //Translate
		$this->admin_db_backup = 'Backup del database';
		$this->admin_db_conn = 'Modifica parametri di connessione';
		$this->admin_db_optimize = 'Ottimizza il database';
		$this->admin_db_query = 'Esegui una query SQL';
		$this->admin_db_restore = 'Rispristina un backup';
		$this->admin_delete_forum = 'Elimina un forum';
		$this->admin_delete_group = 'Elimina un group';
		$this->admin_delete_help = 'Elimina un articolo d\'aiuto help';
		$this->admin_delete_member = 'Elimina un utente';
		$this->admin_delete_template = 'Cancella template HTML';
		$this->admin_edit_emoticons = 'Modifica o cancella emoticon';
		$this->admin_edit_forum = 'Modifica un forum';
		$this->admin_edit_group_name = 'Modifica il nome gruppo';
		$this->admin_edit_group_perms = 'Modifica i permessi gruppo';
		$this->admin_edit_help = 'Modifica un  help article';
		$this->admin_edit_member = 'Modifica un utente';
		$this->admin_edit_member_perms = 'Modifica i permessi utente';
		$this->admin_edit_member_titles = 'Modifica o elimina titoli utente automatici';
		$this->admin_edit_settings = 'Modifica configurazione bacheca';
		$this->admin_edit_skin = 'Modifica o elimina una skin';
		$this->admin_edit_templates = 'Modifica template HTML';
		$this->admin_emoticons = 'Emoticon';
		$this->admin_export_skin = 'Esporta una skin';
		$this->admin_fix_stats = 'Controlla statistiche utenti';
		$this->admin_forum_order = 'Cambia ordine dei forum';
		$this->admin_forums = 'Forum e Categorie';
		$this->admin_groups = 'Gruppi';
		$this->admin_heading = 'Quicksilver Forums Pannello Amministratore';
		$this->admin_help = 'Articoli d\'aiuto';
		$this->admin_install_emoticons = 'Installa emoticon';
		$this->admin_install_skin = 'Installa una skin';
		$this->admin_logs = 'Mostra azioni di moderazione';
		$this->admin_mass_mail = 'Spedisci email ai tuoi utenti';
		$this->admin_members = 'Iscritti';
		$this->admin_phpinfo = 'Mostra informazioni PHP';
		$this->admin_prune = 'Sfoltisci vecchie discussioni';
		$this->admin_recount_forums = 'Riconta discussioni e repliche';
		$this->admin_settings = 'Configurazione';
		$this->admin_settings_add = 'Add new board setting'; //Translate
		$this->admin_skins = 'Skin';
		$this->admin_stats = 'Statistiche';
		$this->admin_upgrade_skin = 'Aggiorna una Skin';
		$this->admin_your_board = 'La tua bacheca';
	}

	function backup()
	{
		$this->backup_create = 'Backup Database'; //Translate
		$this->backup_createfile = 'Backup e file creati sul server';
		$this->backup_done = 'Il backup del database è stato creato nella cartella principale di Quicksilver Forums.';
		$this->backup_download = 'Backup e download (recommandato)';
		$this->backup_found = 'I seguenti backup sono stati trovati nella cartella principale di Quicksilver Forums';
		$this->backup_invalid = 'Il backup sembra non valido. Nessuna modifica apportata al database.';
		$this->backup_none = 'Nussun backup trovato nella cartella principale di Quicksilver Forums.';
		$this->backup_options = 'Seleziona come vuoi che il tuo che il backup venga creato';
		$this->backup_restore = 'Ripristina Backup';
		$this->backup_restore_done = 'Il database è stato ripristinato da un backup.';
		$this->backup_warning = 'Attenzione: Tutti i dati usati da Quicksilver Forums saranno sovrascritti.';
	}

	function ban()
	{
		$this->ban = 'Banna';
		$this->ban_banned_ips = 'Banna IP';
		$this->ban_banned_members = 'Utenti Bannati';
		$this->ban_ip = 'Banna IP';
		$this->ban_member_explain1 = 'Per bannare un utente, cambia il suo gruppo utente in';
		$this->ban_member_explain2 = 'nel controllo utenti.';
		$this->ban_members = 'Banna Utenti';
		$this->ban_nomembers = 'Non ci sono utenti bannati.';
		$this->ban_one_per_line = 'un indirizzo per linea.';
		$this->ban_regex_allowed = 'Espressioni regolari permesse. Puoi utilizzare un singolo * come una wildcard per una o piu\' cifre.';
		$this->ban_settings = 'Configurazione Ban';
		$this->ban_users_banned = 'Utenti bannati.';
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
		$this->board_active_users = 'Attività Utenti';
		$this->board_birthdays = 'Compleanni di Oggi:';
		$this->board_bottom_page = 'Vai alla fine della pagina';
		$this->board_can_post = 'Puoi ripondere alle discussioni.';
		$this->board_can_topics = 'Puoi leggere ma non creare discussioni.';
		$this->board_cant_post = 'Non puoi rispondere alle discussioni.';
		$this->board_cant_topics = 'Non puoi leggere o creare discussioni.';
		$this->board_forum = 'Argomenti';
		$this->board_guests = 'ospiti';
		$this->board_last_post = 'Ultima Discussione';
		$this->board_mark = 'Segna tutti le discussioni come già lette';
		$this->board_mark1 = 'Tutte le discussioni e gli argomenti sono segnati come già letti.';
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = 'iscritti';
		$this->board_message = '%s Messaggio';
		$this->board_most_online = 'Il più alto numero di utenti online è stato di %d il giorno %s.';
		$this->board_nobday = 'Non ci sono compleanni oggi.';
		$this->board_nobody = 'Non ci sono utenti online.';
		$this->board_nopost = 'Nessuna Discussione';
		$this->board_noview = 'Non puoi leggere la bacheca.';
		$this->board_regfirst = 'Non puoi leggere la bacheca. Lo puoi fare solo registrandoti.';
		$this->board_replies = 'Risposte';
		$this->board_stats = 'Statistiche';
		$this->board_stats_string = '%s utenti si sono registrati. Diamo il benvenuto al nostro più recente iscritto: %s.<br /> Ci sono %s discussioni e %s risposte, per un totale di %s messaggi.';
		$this->board_top_page = 'Vai in cima alla pagina';
		$this->board_topics = 'Discussioni';
		$this->board_users = 'utenti';
		$this->board_write_topics = 'Puoi leggere ed inviare nuovi messaggi.';
	}

	function censoring()
	{
		$this->censor = 'Censura';
		$this->censor_one_per_line = 'Una parola per linea.';
		$this->censor_regex_allowed = 'Le Espressioni regolari sono permesse. Puoi utilizzare un singolo * come una wildcard per uno o piu\' caratteri.';
		$this->censor_updated = 'Lista censura aggiornata.';
	}

	function cp()
	{
		$this->cp_aim = 'Nome AIM';
		$this->cp_already_member = 'L\'indirizzo email che hai inserito è già utilizzato da un iscritto.';
		$this->cp_apr = 'Aprile';
		$this->cp_aug = 'Agosto';
		$this->cp_avatar_current = 'Avatar in uso';
		$this->cp_avatar_error = 'Errore Avatar';
		$this->cp_avatar_must_select = 'Devi selezionare un avatar.';
		$this->cp_avatar_none = 'Nessun avatar';
		$this->cp_avatar_pixels = 'pixel';
		$this->cp_avatar_select = 'Seleziona un avatar';
		$this->cp_avatar_size_height = 'L\'altezza del tuo avatar deve essere tra 1 e';
		$this->cp_avatar_size_width = 'La larghezza del tuo avatar deve essere tra 1 e';
		$this->cp_avatar_upload = 'Trasferisci un avatar dal tuo computer';
		$this->cp_avatar_upload_failed = 'Trasferimento avatar Fallito. Il file specificato sembra non esistere.';
		$this->cp_avatar_upload_not_image = 'Poi trasferire solo immagini da usare come avatar.';
		$this->cp_avatar_upload_too_large = 'L\'avatar che hai specificato è troppo pesante. La dimensione massima consentita è %d kilobytes.';
		$this->cp_avatar_url = 'Inserisci l\'URL del tuo avatar';
		$this->cp_avatar_use = 'Usa avatar trasferito';
		$this->cp_bday = 'Compleanno';
		$this->cp_been_updated = 'Il tuo profilo è stato aggiornato.';
		$this->cp_been_updated1 = 'Il tuo avatar è stato traferito.';
		$this->cp_been_updated_prefs = 'Le tue preferenze sono state aggiornate.';
		$this->cp_changing_pass = 'Modifica Password';
		$this->cp_contact_pm = 'Permetti agli altri iscritti di contattarti via messenger?';
		$this->cp_cp = 'Pannello di Controllo';
		$this->cp_current_avatar = 'Avatar Attuale';
		$this->cp_current_time = 'Attualmente sono le %s.';
		$this->cp_custom_title = 'Titolo utente personalizzato';
		$this->cp_custom_title2 = 'E\' un privilegio concesso agli amministratori';
		$this->cp_dec = 'Dicembre';
		$this->cp_editing_avatar = 'Modifica Avatar';
		$this->cp_editing_profile = 'Modifica Profile';
		$this->cp_email = 'Email'; //Translate
		$this->cp_email_form = 'Vuoi ricevere email da altri utenti tramite forum?';
		$this->cp_email_invaid = 'L\'indirizzo email che hai inserito non è valido.';
		$this->cp_err_avatar = 'Errore Aggiornamento Avatar';
		$this->cp_err_updating = 'Errore Aggiornamento Profilo';
		$this->cp_feb = 'Febbraio';
		$this->cp_file_type = 'L\'avatar che hai inserito non è valido. Assicurati che l\'URL sia corretta, e che l\'estensione del file sia: gif, jpg, o png.';
		$this->cp_format = 'Nome';
		$this->cp_gtalk = 'Account GTalk';
		$this->cp_header = 'Pannello di Controllo Utente';
		$this->cp_height = 'Altezza';
		$this->cp_icq = 'Numero ICQ';
		$this->cp_interest = 'Interessi';
		$this->cp_jan = 'Gennaio';
		$this->cp_july = 'Luglio';
		$this->cp_june = 'Giugno';
		$this->cp_label_edit_avatar = 'Modifica Avatar';
		$this->cp_label_edit_pass = 'Modifica Password';
		$this->cp_label_edit_prefs = 'Modifica Preferenze';
		$this->cp_label_edit_profile = 'Modifica Profilo';
		$this->cp_label_edit_sig = 'Modifica Firma';
		$this->cp_label_edit_subs = 'Modifica Sottoscrizioni';
		$this->cp_language = 'Lingua';
		$this->cp_less_charac = 'Il tuo nome deve essere al massimo di 32 caratteri.';
		$this->cp_location = 'Località';
		$this->cp_login_first = 'Devi essere riconosciuto dal sistema (login) per accedere al pannello di controllo.';
		$this->cp_mar = 'Marzo';
		$this->cp_may = 'Maggio';
		$this->cp_msn = 'Identità MSN';
		$this->cp_must_orig = 'Il tuo nome deve essere identico all\'originale. Puoi cambiare solamente le lettere maiscole/minuscole e gli spazi.';
		$this->cp_new_notmatch = 'Le nuove passwords che hai inserito non corrispondono.';
		$this->cp_new_pass = 'Nuova Password';
		$this->cp_no_flash = 'Gli avatar flash non sono permessi su questa bacheca.';
		$this->cp_not_exist = 'La data che hai inserito (%s) non esiste!';
		$this->cp_nov = 'Novembre';
		$this->cp_oct = 'Ottobre';
		$this->cp_old_notmatch = 'La vecchia password che hai inserito non combacia con quella nel nostro database.';
		$this->cp_old_pass = 'Vecchia Password';
		$this->cp_pass_notvaid = 'La tua password non è valida. Assicurati di aver usato solo caratteri validi come lettere, numeri, trattini (-), underscore (_), o spazi.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = 'Modifica Preferenze';
		$this->cp_preview_sig = 'Anteprima Firma:';
		$this->cp_privacy = 'Opzioni Privacy';
		$this->cp_repeat_pass = 'Riscrivi Nuova Password';
		$this->cp_sept = 'Settembre';
		$this->cp_show_active = 'Mostra la tua attività quando navighi nei forum?';
		$this->cp_show_email = 'Mostra l\'indirizzo email nel profilo?';
		$this->cp_signature = 'Firma';
		$this->cp_size_max = 'L\'avatar che hai inserito è troppo grande. La dimensione massima ammessa è %s x %s pixels.';
		$this->cp_skin = 'Skin Bacheca';
		$this->cp_sub_change = 'Cambia Sottoscrizioni';
		$this->cp_sub_delete = 'Cancella';
		$this->cp_sub_expire = 'Data di Termine';
		$this->cp_sub_name = 'Nome Sottoscrizione';
		$this->cp_sub_no_params = 'Nessun parametro inserito.';
		$this->cp_sub_success = 'Ora sei sottoscritto a questo %s.';
		$this->cp_sub_type = 'Tipo Sottoscrizione';
		$this->cp_sub_updated = 'Le sottoscrizioni alle discussioni selezionate sono stati eliminati.';
		$this->cp_topic_option = 'Opzioni Discussione';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = 'Profilo Aggiornato';
		$this->cp_updated1 = 'Avatar Aggiornato';
		$this->cp_updated_prefs = 'Preferenze Aggiornate';
		$this->cp_user_exists = 'Esiste già un utente con questo nome.';
		$this->cp_valided = 'La tua password è stata convalidata ed aggiornata.';
		$this->cp_view_avatar = 'Visualizza Avatars nelle discussioni?';
		$this->cp_view_emoticon = 'Visualizza Faccine nelle discussioni?';
		$this->cp_view_signature = 'Visualizza Signatures nelle discussioni?';
		$this->cp_welcome = 'Benvenuto nel pannello di controllo utenti. Da qui puoi configurare il tuo account selezionando una delle opzioni che vedi qui sopra.';
		$this->cp_width = 'Larghezza';
		$this->cp_www = 'Sito Web';
		$this->cp_yahoo = 'Identità Yahoo';
		$this->cp_zone = 'Fuso Orario';
	}

	function email()
	{
		$this->email_blocked = 'Questo utente non vuole ricevere email dal forum.';
		$this->email_email = 'Email'; //Translate
		$this->email_msgtext = 'Corpo Email:';
		$this->email_no_fields = 'Torna indietro ed assicurati che tutti i campi siano completi.';
		$this->email_no_member = 'Nessun utente trovato con questo nome';
		$this->email_no_perm = 'Non ti è concesso inviare email tramite questo form.';
		$this->email_sent = 'La tua email è stata inviata.';
		$this->email_subject = 'Titolo:';
		$this->email_to = 'A:';
	}

	function emot_control()
	{
		$this->emote = 'Faccine';
		$this->emote_add = 'Aggiungi faccine';
		$this->emote_added = 'Emoticon aggiunto.';
		$this->emote_clickable = 'Cliccabile';
		$this->emote_edit = 'Modifica faccine';
		$this->emote_image = 'Immagine';
		$this->emote_install = 'Installa faccine';
		$this->emote_install_done = 'Le faccine sono state reinstallate.';
		$this->emote_install_warning = 'Questo cancellerà tutte le impostazioni sugli emoticon esistenti e importa gli emotico caricati dal tuo skin corrente nel database.';
		$this->emote_no_text = 'Nessun testo inserito.';
		$this->emote_text = 'Testo';
	}

	function forum()
	{
		$this->forum_by = 'Di';
		$this->forum_can_post = 'Puoi rispondere alle discussioni.';
		$this->forum_can_topics = 'Puoi leggere le discussioni.';
		$this->forum_cant_post = 'Non puoi rispodere alle discussioni.';
		$this->forum_cant_topics = 'Non puoi leggere le discussoni.';
		$this->forum_dot = 'punto';
		$this->forum_dot_detail = 'significa che hai partecipato a questa discussione.';
		$this->forum_forum = 'Forum'; //Translate
		$this->forum_guest = 'Visitatore';
		$this->forum_hot = 'Caldo';
		$this->forum_icon = 'Icone Messaggi';
		$this->forum_jump = 'Vai al nuovo messaggio della discussione';
		$this->forum_last = 'Ultimo messaggio';
		$this->forum_locked = 'Bloccato';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = 'Spostato';
		$this->forum_msg = '%s Messaggi';
		$this->forum_new = 'Nuovo';
		$this->forum_new_poll = 'Crea Nuovo Sondaggio';
		$this->forum_new_topic = 'Crea Nuova Discussione';
		$this->forum_no_topics = 'Non ci sono discussioni in questo forum.';
		$this->forum_noexist = 'Il forum specificato non esiste.';
		$this->forum_nopost = 'Nessun Messaggio';
		$this->forum_not = 'Nessun';
		$this->forum_noview = 'Non hai il permesso di leggere questo forum.';
		$this->forum_pages = 'Pagine';
		$this->forum_pinned = 'Importante';
		$this->forum_pinned_topic = 'Discussione Importante';
		$this->forum_poll = 'Sondaggio';
		$this->forum_regfirst = 'Non hai il permesso di leggere questo forum. Lo potrai fare solo registrandoti.';
		$this->forum_replies = 'Risposte';
		$this->forum_starter = 'Autore';
		$this->forum_sub = 'Sotto-Forum';
		$this->forum_sub_last_post = 'Ultimo Messaggio';
		$this->forum_sub_replies = 'Risposta';
		$this->forum_sub_topics = 'Argomenti';
		$this->forum_subscribe = 'Mandami una e-mail quando qualcuno apre una nuova discussione';
		$this->forum_topic = 'Discussioni';
		$this->forum_views = 'Visite';
		$this->forum_write_topics = 'Puoi aprire nuove discussioni in questo forum.';
	}

	function forums()
	{
		$this->forum_controls = 'Controlli Forum';
		$this->forum_create = 'Crea un Forum';
		$this->forum_create_cat = 'Crea una Categoria';
		$this->forum_created = 'Forum Creato';
		$this->forum_default_perms = 'Permessi di Default';
		$this->forum_delete = 'Elimina Forum';
		$this->forum_delete_warning = 'Vuoi veramente eliminare questo forum, le discussioni e i messaggi?<br />Quest\'azione è irreversibile.';
		$this->forum_deleted = 'Il forum è stato eliminato.';
		$this->forum_description = 'Descrizione';
		$this->forum_edit = 'Modifica Forum';
		$this->forum_edited = 'Il forum è stato modificato.';
		$this->forum_empty = 'Il campo del nome è vuoto. Torna indietro e correggi il problema.';
		$this->forum_is_subcat = 'Questo forum è una sotto-categoria.';
		$this->forum_name = 'Nome';
		$this->forum_no_orphans = 'Non puoi eliminare una categoria non vuota.';
		$this->forum_none = 'Non ci sono forum da modificare.';
		$this->forum_ordered = 'Ordine Forum Aggiornato';
		$this->forum_ordering = 'Cambia Ordine Forum';
		$this->forum_parent = 'Non puoi\'t un forum\ parente in questo modo.';
		$this->forum_parent_cat = 'Categoria Parente';
		$this->forum_quickperm_select = 'seleziona un forum esistente per copiare i permessi.';
		$this->forum_quickperms = 'Permessi Rapidi';
		$this->forum_recount = 'Riconta discussioni e repliche';
		$this->forum_select_cat = 'Seleziona una categoria esistente per creare un forum.';
		$this->forum_subcat = 'Sotto-categoria';
	}

	function groups()
	{
		$this->groups_bad_format = 'Devi inserire %s nella formattazione, il quale rappresenta il nome del gruppo.';
		$this->groups_based_on = 'basato su';
		$this->groups_create = 'Crea un Gruppo';
		$this->groups_create_new = 'Crea un nuovo gruppo utenti chiamato';
		$this->groups_created = 'Gruppo Creato';
		$this->groups_delete = 'Elimina Groppo';
		$this->groups_deleted = 'Groppo Eliminato.';
		$this->groups_edit = 'Modifica Groppo';
		$this->groups_edited = 'Groppo Modificato.';
		$this->groups_formatting = 'Formattazione';
		$this->groups_i_confirm = 'Confermo che voglio eliminare il gruppo.';
		$this->groups_name = 'Nome';
		$this->groups_no_action = 'Nessuna Azione verra\' presa.';
		$this->groups_no_delete = 'Non ci sono gruppi personalizzati da eliminare.<br />Alcuni gruppi sono essenziali al funzionamento di Quicksilver Forums, e non possono essere cancellati.';
		$this->groups_no_group = 'Nessun gruppo specificato.';
		$this->groups_no_name = 'Nessun nome gruppo inserito.';
		$this->groups_only_custom = 'Nota: Puoi solo cancellare i membri dei gruppi personalizzati. I gruppi centrali sono neccesari al funzionamento di Quicksilver Forums.';
		$this->groups_the = 'Il gruppo';
		$this->groups_to_edit = 'Groppo da modificare';
		$this->groups_type = 'Tipo Gruppo';
		$this->groups_will_be = 'saranno cancellati.';
		$this->groups_will_become = 'Gli utenti del gruppo eliminato';
	}

	function help()
	{
		$this->help_add = 'Aggiungi Articolo d\'aiuto';
		$this->help_article = 'Controlli Articoli d\'aiuto';
		$this->help_available_files = 'Aiuto';
		$this->help_confirm = 'Vuoi veramente eliminare l\'articolo?';
		$this->help_content = 'Contenuto articolo';
		$this->help_delete = 'Elimina Articolo d\'aiuto';
		$this->help_deleted = 'Articolo d\'aiuto eliminato.';
		$this->help_edit = 'Modifica Articolo d\'aiuto';
		$this->help_edited = 'Articolo d\'aiuto aggiornato.';
		$this->help_inserted = 'Articolo inserito nel database.';
		$this->help_no_articles = 'Nessun articolo d\'aiuto trovato nel database.';
		$this->help_no_title = 'Non puoi creare un articolo d\'aiuto senza titolo.';
		$this->help_none = 'Non ci sono file d\'aiuto nel database.';
		$this->help_not_exist = 'Questo articolo d\'aiuto non esiste.';
		$this->help_select = 'Seleziona l\'articolo d\'aiuto da modificare';
		$this->help_select_delete = 'Seleziona l\'articolo d\'aiuto da eliminare';
		$this->help_title = 'Titolo';
	}

	function home()
	{
		$this->home_choose = 'Scegli la prossima azione.';
		$this->home_menu_title = 'Menu Pannello d\'Amministrazione';
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
		$this->login_cant_logged = 'Non sei autenticato. Controlla di aver inserito Nome Utente e Password corretti.<br /><br />Sono case sensitive, quindi \'UsErNaMe\' è diverso da \'Username\'. Controlla anche che i cookies siano abilitati nel tuo bowser.';
		$this->login_cookies = 'I Cookies devono essere abilitati se vuoi connetterti.';
		$this->login_forgot_pass = 'Password dimenticata?';
		$this->login_header = 'Connessione';
		$this->login_logged = 'Ora sei connesso.';
		$this->login_now_out = 'Ora sei disconnesso.';
		$this->login_out = 'Disconnessione';
		$this->login_pass = 'Password'; //Translate
		$this->login_pass_no_id = 'Non esiste alcun iscritto con il nome che hai inserito.';
		$this->login_pass_request = 'Per completare il cambio di password, fai clic sul link inviato tramite l\'indirizzo email associato al tuo account.';
		$this->login_pass_reset = 'Resetta Password';
		$this->login_pass_sent = 'La tua password e\' stata sostituita con una casuale. La nuova password è stata spedita all\' indirizzo email associato a questo account.';
		$this->login_sure = 'Sicuro di vorlerti disconnettere da \'%s\'?';
		$this->login_user = 'Nome Utente';
	}

	function logs()
	{
		$this->logs_action = 'Azione';
		$this->logs_deleted_post = 'Ha eliminato un messaggio';
		$this->logs_deleted_topic = 'Ha eliminato una discussione';
		$this->logs_edited_post = 'Ha modificato un messaggio';
		$this->logs_edited_topic = 'Ha modificato una discussione';
		$this->logs_id = 'ID';
		$this->logs_locked_topic = 'Ha bloccato una discussione';
		$this->logs_moved_from = 'dal forum';
		$this->logs_moved_to = 'al forum';
		$this->logs_moved_topic = 'Ha spostato una discussione';
		$this->logs_moved_topic_num = 'Ha spostato la discussione #';
		$this->logs_pinned_topic = 'Ha messo in rilievo una discussione';
		$this->logs_post = 'Messaggio';
		$this->logs_time = 'Data';
		$this->logs_topic = 'Discussione';
		$this->logs_unlocked_topic = 'Ha sbloccato una discussione';
		$this->logs_unpinned_topic = 'Topic sbloccati';
		$this->logs_user = 'Utente';
		$this->logs_view = 'Mostra Azioni di Moderazione';
	}

	function main()
	{
		$this->main_activate = 'Il tuo account non è ancora stato attivato.';
		$this->main_activate_resend = 'Rispedisci Email di Attivazione';
		$this->main_admincp = 'amministrazione';
		$this->main_banned = 'Sei stato bannato da questo forum.';
		$this->main_code = 'Codice';
		$this->main_cp = 'pannello di controllo';
		$this->main_full = 'Completo';
		$this->main_help = 'aiuto';
		$this->main_load = 'carico';
		$this->main_login = 'connettiti';
		$this->main_logout = 'disconnetti';
		$this->main_mark = 'Segna tutto';
		$this->main_mark1 = 'Segna tutte le discussioni come già lette';
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = 'Siamo spiacenti, ma %s è momentaneamente non disponibile, a causa del numero elevato di utenti connessi.';
		$this->main_members = 'iscritti';
		$this->main_messenger = 'messaggistica';
		$this->main_new = 'nuovo';
		$this->main_next = 'avanti';
		$this->main_prev = 'indietro';
		$this->main_queries = 'richieste';
		$this->main_quote = 'Citazione';
		$this->main_recent = 'messaggi recenti';
		$this->main_recent1 = 'Mostra le discussioni dalla tua ultima visita';
		$this->main_register = 'registrati';
		$this->main_reminder = 'Promemoria';
		$this->main_reminder_closed = 'La bacheca è chiusa e visibile solo agli amministratori.';
		$this->main_said = 'ha scritto';
		$this->main_search = 'cerca';
		$this->main_topics_new = 'Ci sono nuovi messaggi in questo forum.';
		$this->main_topics_old = 'Non ci sono nuovi messaggi in questo forum.';
		$this->main_welcome = 'Benvenuto';
		$this->main_welcome_guest = 'Benvenuto!';
	}

	function mass_mail()
	{
		$this->mail = 'E-Mail di Massa';
		$this->mail_announce = 'Annuncio da';
		$this->mail_groups = 'Gruppo destinatari';
		$this->mail_members = 'iscritti.';
		$this->mail_message = 'Messaggi';
		$this->mail_select_all = 'Seleziona Tutti';
		$this->mail_send = 'Invia e-mail';
		$this->mail_sent = 'Il tuo messaggio è stato spedito a';
	}

	function member_control()
	{
		$this->mc = 'Controllo Utenti';
		$this->mc_confirm = 'Vuoi veramente eliminare';
		$this->mc_delete = 'Elimina Utente';
		$this->mc_deleted = 'Utente Eliminato.';
		$this->mc_edit = 'Modifica Utente';
		$this->mc_edited = 'Utente Aggiornato';
		$this->mc_email_invaid = 'L\'indirizzo email non è valido.';
		$this->mc_err_updating = 'Errore di Aggiornamento Profilo';
		$this->mc_find = 'Trova gli utenti nel cui nome è contenuto';
		$this->mc_found = 'Sono stati trovati i seguenti utenti. Scegline uno.';
		$this->mc_guest_needed = 'L\'account guest è necessario a Quicksilver Forums per funzionare correttamente.';
		$this->mc_not_found = 'Nessun iscritto è stato trovato con il criterio dato';
		$this->mc_user_aim = 'AIM Nome';
		$this->mc_user_avatar = 'Avatar'; //Translate
		$this->mc_user_avatar_height = 'Altezza Avatar';
		$this->mc_user_avatar_type = 'Tipo Avatar';
		$this->mc_user_avatar_width = 'Larghezza Avatar';
		$this->mc_user_birthday = 'Data di Nascita';
		$this->mc_user_email = 'Indirizzo Email';
		$this->mc_user_email_show = 'Indirizzo Email Pubblico';
		$this->mc_user_group = 'Groppo';
		$this->mc_user_gtalk = 'Account GTalk';
		$this->mc_user_homepage = 'Sito web';
		$this->mc_user_icq = 'Numero ICQ';
		$this->mc_user_id = 'ID Utente';
		$this->mc_user_interests = 'Interessi';
		$this->mc_user_joined = 'Iscritto dal';
		$this->mc_user_language = 'Lingua';
		$this->mc_user_lastpost = 'Ultimo messaggio';
		$this->mc_user_lastvisit = 'Ultima Visita';
		$this->mc_user_level = 'Livello';
		$this->mc_user_location = 'Località';
		$this->mc_user_msn = 'Identità MSN';
		$this->mc_user_name = 'Nome';
		$this->mc_user_pm = 'Accetta Messaggi Privati';
		$this->mc_user_posts = 'Messaggi';
		$this->mc_user_signature = 'Firma';
		$this->mc_user_skin = 'Skin'; //Translate
		$this->mc_user_timezone = 'Fuso Orario';
		$this->mc_user_title = 'Titolo Utente';
		$this->mc_user_title_custom = 'Utilizza Titolo Utente Personalizzato';
		$this->mc_user_view_avatars = 'Mostra Avatar';
		$this->mc_user_view_emoticons = 'Visualizzando Emoticon';
		$this->mc_user_view_signatures = 'Mostra Firme';
		$this->mc_user_yahoo = 'Identità Yahoo';
	}

	function membercount()
	{
		$this->mcount = 'Controlla Statistiche Utente';
		$this->mcount_updated = 'Statistiche Utente Aggiornate.';
	}

	function members()
	{
		$this->members_all = 'tutti';
		$this->members_email = 'Email'; //Translate
		$this->members_email_member = 'Scrivi Email a questo utente';
		$this->members_group = 'Gruppo';
		$this->members_joined = 'Iscritto il';
		$this->members_list = 'Lista Iscritti';
		$this->members_member = 'Iscritti';
		$this->members_pm = 'MP';
		$this->members_posts = 'Messaggi';
		$this->members_send_pm = 'Scrivi messaggio privato a questo utente';
		$this->members_title = 'Titolo';
		$this->members_vist_www = 'Visita il sito web di questo utente';
		$this->members_www = 'Sito web';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Vuoi veramente cancellare questo messaggio?';
		$this->mod_confirm_topic_delete = 'Vuoi veramente cancellare questa discussione?';
		$this->mod_error_first_post = 'Non puoi cancellare il primo messaggio di una discussione.';
		$this->mod_error_move_category = 'Non puoi spostare una discussione in una categoria.';
		$this->mod_error_move_create = 'Non hai il permesso di muovere le discussioni da questo forum.';
		$this->mod_error_move_forum = 'Non puoi spostare una discussione in forum che non esiste.';
		$this->mod_error_move_global = 'Non puoi spostare una discussione globale. Modifica la discussione prima di muoverla.';
		$this->mod_error_move_same = 'Non puoi muovere una discussione nello stesso forum.';
		$this->mod_label_controls = 'Controlli Moderatore';
		$this->mod_label_description = 'Descrizione';
		$this->mod_label_emoticon = 'Converti Faccine in immagini?';
		$this->mod_label_global = 'Discussione Globale';
		$this->mod_label_mbcode = 'Formatta MbCode?';
		$this->mod_label_move_to = 'Muovi in';
		$this->mod_label_options = 'Opzioni';
		$this->mod_label_post_delete = 'Cancella Messaggio';
		$this->mod_label_post_edit = 'Modifica Messaggio';
		$this->mod_label_post_icon = 'Icona Messaggio';
		$this->mod_label_publish = 'Pubblicato';
		$this->mod_label_title = 'Titolo';
		$this->mod_label_title_original = 'Titolo Originale';
		$this->mod_label_title_split = 'Dividi Titolo';
		$this->mod_label_topic_delete = 'Elimina Discussione';
		$this->mod_label_topic_edit = 'Modifica Discussione';
		$this->mod_label_topic_lock = 'Blocca Discussione';
		$this->mod_label_topic_move = 'Sposta Discussione';
		$this->mod_label_topic_move_complete = 'Sposta l\'intera discussione nel nuovo forum';
		$this->mod_label_topic_move_link = 'Sposta la discussione nel nuovo forum, e lascia il collegamento alla discussione nel vecchio forum.';
		$this->mod_label_topic_pin = 'Pin Discussione';
		$this->mod_label_topic_split = 'Dividi Discussione';
		$this->mod_missing_post = 'Il messaggio specificato non esiste.';
		$this->mod_missing_topic = 'La discussione specificata non esiste.';
		$this->mod_no_action = 'Devi specificare un\'azione.';
		$this->mod_no_post = 'Devi speficare un messaggio.';
		$this->mod_no_topic = 'Devi specifare una discussione.';
		$this->mod_perm_post_delete = 'Non hai il permesso per eliminare questo messaggio.';
		$this->mod_perm_post_edit = 'Non hai il permesso per moficare questo messaggio.';
		$this->mod_perm_publish = 'Non hai il permesso per pubblicare questa discussione.';
		$this->mod_perm_topic_delete = 'Non hai il permesso per eliminare questa discussione.';
		$this->mod_perm_topic_edit = 'Non hai il permesso per modificare questa discussione.';
		$this->mod_perm_topic_lock = 'Non hai il permesso per bloccare questa discussione.';
		$this->mod_perm_topic_move = 'Non hai il permesso per spostare questa discussione.';
		$this->mod_perm_topic_pin = 'Non hai il permesso per pin questa discussione.';
		$this->mod_perm_topic_split = 'Non hai il permesso per dividere questa discussione.';
		$this->mod_perm_topic_unlock = 'Non hai il permesso per sbloccare questa discussione.';
		$this->mod_perm_topic_unpin = 'non hai il permesso per unpin questa discussione.';
		$this->mod_success_post_delete = 'Il messaggio è stato eliminato.';
		$this->mod_success_post_edit = 'Il messaggio è stato modificato.';
		$this->mod_success_publish = 'Questa discussione e\' stata pubblicata con successo.';
		$this->mod_success_split = 'La discussione è stata divisa.';
		$this->mod_success_topic_delete = 'La discussione è stata eliminata.';
		$this->mod_success_topic_edit = 'La discussione è stata modificata.';
		$this->mod_success_topic_move = 'La discussione è stata spostata nel nuovo forum.';
		$this->mod_success_unpublish = 'Questa discussione verra\' rimossa dall\'elenco dei pubblicati.';
	}

	function optimize()
	{
		$this->optimize = 'Ottimizza Database';
		$this->optimized = 'Le tabelle del database sono state ottimizzate per ottenere le massime prestazioni.';
	}

	function perms()
	{
		$this->perm = 'Permesso';
		$this->perms = 'Permessi';
		$this->perms_board_view = 'Mostra l\'indice della bacheca';
		$this->perms_board_view_closed = 'Utilizza Quicksilver Forums quando è chiuso';
		$this->perms_do_anything = 'Utilizza Quicksilver Forums';
		$this->perms_edit_for = 'Modifica permessi per';
		$this->perms_email_use = 'Invia email agli iscritti tramite il forum';
		$this->perms_forum_view = 'Mostra la bacheca';
		$this->perms_is_admin = 'Accedi al pannello d\'amministrazione';
		$this->perms_only_user = 'Utilizza solo i permessi del gruppo per questo utente';
		$this->perms_override_user = 'Così ignorerai i permessi del gruppo per questo utente.';
		$this->perms_pm_noflood = 'Esente dal controllo antiflood nei MP';
		$this->perms_poll_create = 'Crea sondaggi';
		$this->perms_poll_vote = 'Esprimi voti';
		$this->perms_post_attach = 'Upload allegati';
		$this->perms_post_attach_download = 'Download allegati';
		$this->perms_post_create = 'Aggiungi repliche';
		$this->perms_post_delete = 'Elimina ogni tipo di messaggio';
		$this->perms_post_delete_own = 'Elimina solo i messaggi creati dall\'utente';
		$this->perms_post_edit = 'Modifica ogni tipo di messaggio';
		$this->perms_post_edit_own = 'Modifica solo i messaggi creati dall\'utente';
		$this->perms_post_inc_userposts = 'Contributi post al totale conteggio post dell\'utente';
		$this->perms_post_noflood = 'Ignora controllo antiflood messaggi';
		$this->perms_post_viewip = 'Mostra indirizzi IP utenti';
		$this->perms_search_noflood = 'Esente dal controllo antiflood per le ricerche';
		$this->perms_title = 'Accesso al Pannello Utente';
		$this->perms_topic_create = 'Crea discussioni';
		$this->perms_topic_delete = 'Elimina ogni tipo di discussione';
		$this->perms_topic_delete_own = 'Elimina solo le discussioni create dall\'utente';
		$this->perms_topic_edit = 'Modifica ogni tipo di discussione';
		$this->perms_topic_edit_own = 'Modifica solo le discussioni create dall\'utente';
		$this->perms_topic_global = 'Rendi una discussione visibile in tutti i forum';
		$this->perms_topic_lock = 'Blocca ogni tipo di discussione';
		$this->perms_topic_lock_own = 'Blocca solo le discussioni create dall\'utente';
		$this->perms_topic_move = 'Muovi ogni tipo di discussione';
		$this->perms_topic_move_own = 'Muovi solo le discussioni create dall\'utente';
		$this->perms_topic_pin = 'Evidenzia ogni tipo di discussione';
		$this->perms_topic_pin_own = 'Evidenzia solo le discussioni create dall\'utente';
		$this->perms_topic_publish = 'Pubblica o non pubblica qualsiasi discussione';
		$this->perms_topic_publish_auto = 'Le nuove discussioni sono segnate come pubblicate';
		$this->perms_topic_split = 'Dividi ogni tipo di discussione';
		$this->perms_topic_split_own = 'Dividi solo le discussioni create dall\'utente';
		$this->perms_topic_unlock = 'Sblocca ogni tipo di discussione';
		$this->perms_topic_unlock_mod = 'Sblocca un moderatore\'bloccato';
		$this->perms_topic_unlock_own = 'Sblocca solo le discussioni create dall\'utente';
		$this->perms_topic_unpin = 'Togli evidenza da ogni tipo di discussione';
		$this->perms_topic_unpin_own = 'Togli evidenza solo le discussioni create dall\'utente';
		$this->perms_topic_view = 'Mostra discussioni';
		$this->perms_topic_view_unpublished = 'Visualizza discussioni non pubblicate';
		$this->perms_updated = 'Permessi aggiornati.';
		$this->perms_user_inherit = 'Questo utente erediterierà i permessi del groppo.';
	}

	function php_info()
	{
		$this->php_error = 'Errore';
		$this->php_error_msg = 'phpinfo() non puo\' essere eseguito. Questo perche\' il tuo host potrebbe aver disabilitato questa caratteristica.';
	}

	function pm()
	{
		$this->pm_avatar = 'Avatar'; //Translate
		$this->pm_cant_del = 'Non hai il permesso per eliminare questo messaggio.';
		$this->pm_delallmsg = 'Elimina tutti i messaggi';
		$this->pm_delete = 'Elimina';
		$this->pm_delete_selected = 'Elimina Messaggi Selezionati';
		$this->pm_deleted = 'Messaggio eliminato.';
		$this->pm_deleted_all = 'Messaggi eliminati.';
		$this->pm_error = 'Ci sono stati dei problemi a spedire il tuo messaggio.<br /><br />I seguenti destinatari non esistono: %s<br /><br />I seguenti destinatari non desiderano ricevere messaggi: %s';
		$this->pm_fields = 'Il tuo messaggio non è stato inviato. Controlla che di aver compilato tutti i campi necessari.';
		$this->pm_flood = 'Hai già inviato un messaggio negli ultimi %s secondi, devi aspettare un pò.<br /><br />';
		$this->pm_folder_inbox = 'In arrivo';
		$this->pm_folder_new = '%s nuovi';
		$this->pm_folder_sentbox = 'Inviati';
		$this->pm_from = 'Da';
		$this->pm_group = 'Gruppo';
		$this->pm_guest = 'Come visitatore, non puoi usare la messaggistica. Per favore autenticati o registrati.';
		$this->pm_joined = 'Registrato il';
		$this->pm_messenger = 'Messaggistica';
		$this->pm_msgtext = 'Testo messaggio';
		$this->pm_multiple = 'Separa destinari multipli con ; (punto e virgola)';
		$this->pm_no_folder = 'Devi specificare una cartella.';
		$this->pm_no_member = 'Nessun utente trovato con questo id.';
		$this->pm_no_number = 'Nessun messaggio trovato con questo numero.';
		$this->pm_no_title = 'Nessun Titolo';
		$this->pm_nomsg = 'Non ci sono messaggi in questa cartella.';
		$this->pm_noview = 'Non hai il permesso per leggere questo messaggio.';
		$this->pm_offline = 'Questo utente non è attualmente connesso';
		$this->pm_online = 'Questo utente è online';
		$this->pm_personal = 'Messaggistica personale';
		$this->pm_personal_msging = 'Messaggi Personali';
		$this->pm_pm = 'MP';
		$this->pm_posts = 'Messaggi';
		$this->pm_preview = 'Anteprima';
		$this->pm_recipients = 'Destinario/i';
		$this->pm_reply = 'Rispondi';
		$this->pm_send = 'Invia';
		$this->pm_sendamsg = 'Invia un Messaggio';
		$this->pm_sendingpm = 'Invio un PM';
		$this->pm_sendon = 'Inviato il';
		$this->pm_success = 'Il tuo messaggio è stato inviato.';
		$this->pm_sure_del = 'Vuoi veramente eliminare questo messaggio?';
		$this->pm_sure_delall = 'Vuoi veramente eliminare tutti i messaggi in questa cartella?';
		$this->pm_title = 'Titolo';
		$this->pm_to = 'A';
	}

	function post()
	{
		$this->post_attach = 'Allegati';
		$this->post_attach_add = 'Aggiungi Allegato';
		$this->post_attach_disrupt = 'Aggiungendo o togliendo allegati non perderai il contenuto del messaggio.';
		$this->post_attach_failed = 'Trasferimento allegati fallito. Il file specificato sembra non esistere.';
		$this->post_attach_not_allowed = 'Non puoi allegare file di questo tipo.';
		$this->post_attach_remove = 'Rimuovi allegato';
		$this->post_attach_too_large = 'Il file è troppo grande. La dimensione massima consentita è %d kilobytes.';
		$this->post_cant_create = 'Come visitatore, Non hai il permesso per creare nuove discussioni. Lo potrai fare solo registrandoti.';
		$this->post_cant_create1 = 'Non hai il permesso per creare nuove discussioni.';
		$this->post_cant_enter = 'Il tuo voto non è stato considerato. Probabilmente perchè hai già votato, o non hai il permesso per votare.';
		$this->post_cant_poll = 'Come visitatore, Non hai il permesso per creare sondaggi. Lo puoi fare solo registrandoti.';
		$this->post_cant_poll1 = 'Non hai il permesso per creare sondaggi.';
		$this->post_cant_reply = 'Non hai il permesso per rispondere alle discussioni di questo forum.';
		$this->post_cant_reply1 = 'Come visitatore, Non hai il permesso per rispondere alle discussioni. Lo potrai fare solo registrandoti..';
		$this->post_cant_reply2 = 'Non hai il permesso per rispondere alle discussioni.';
		$this->post_closed = 'Questa discussione è stata chiusa.';
		$this->post_create_poll = 'Crea Sondaggio';
		$this->post_create_topic = 'Crea Discussione';
		$this->post_creating = 'Creazione Discussione';
		$this->post_creating_poll = 'Creazione Sondaggio';
		$this->post_flood = 'Hai già inviato messaggi negli ultimi %s secondi, non puoi ancora inviarne altri.<br /><br />Per favore ritrova fra qualche secondo.';
		$this->post_guest = 'Visitatore';
		$this->post_icon = 'Icona Messaggio';
		$this->post_last_five = 'Ultimi Cinque Messaggi In Ordine Inverso';
		$this->post_length = 'Controlla Lunghezza';
		$this->post_msg = 'Messaggio';
		$this->post_must_msg = 'Devi scrivere qualcosa quando invii un messaggio.';
		$this->post_must_options = 'Devi inserire delle opzioni quando crei un sondaggio.';
		$this->post_must_title = 'Devi scrivere un titolo quando crei una discussione.';
		$this->post_new_poll = 'Nuovo sondaggio';
		$this->post_new_topic = 'Nuova discussione';
		$this->post_no_forum = 'Questo forum non è stato trovato.';
		$this->post_no_topic = 'Nessuna discussione specificata.';
		$this->post_no_vote = 'Devi scegliere un\'opzione da votare.';
		$this->post_option_emoticons = 'Convertire emoticon in immagine?';
		$this->post_option_global = 'Imposta come Discussione Globale?';
		$this->post_option_mbcode = 'Formatta MbCode?';
		$this->post_optional = 'facoltativa';
		$this->post_options = 'Opzioni';
		$this->post_poll_options = 'Opzioni Sondaggio';
		$this->post_poll_row = 'Una opzione per riga';
		$this->post_posted = 'Inviato il';
		$this->post_posting = 'Invio';
		$this->post_preview = 'Anteprima';
		$this->post_reply = 'Rispondi';
		$this->post_reply_topic = 'Rispondi alla discussione';
		$this->post_replying = 'Rispondi Alla Discussione';
		$this->post_replying1 = 'Rispondi';
		$this->post_too_many_options = 'Devono essere presenti da 2 a %d opzioni per un sondaggio.';
		$this->post_topic_detail = 'Descrizione Discussione';
		$this->post_topic_title = 'Titolo Discussione';
		$this->post_view_topic = 'Visualizza l\'intera Discussione';
		$this->post_voting = 'Vota';
	}

	function printer()
	{
		$this->printer_back = 'Indietro';
		$this->printer_not_found = 'La discussione non è stata trovata. Potrebbe essere stata spostata, eliminata o potrebbe non essere mai esistita.';
		$this->printer_not_found_title = 'Discussione Non Trovata';
		$this->printer_perm_topics = 'Non hai il permesso per visualizzare la discussione.';
		$this->printer_perm_topics_guest = 'Non hai il permesso per leggere la discussione. Lo potrai fare solo registrandoti.';
		$this->printer_posted_on = 'Inviato il';
		$this->printer_send = 'Invia alla stampante';
	}

	function profile()
	{
		$this->profile_aim_sn = 'Nome AIM';
		$this->profile_av_sign = 'Avatar e Firma';
		$this->profile_avatar = 'Avatar'; //Translate
		$this->profile_bday = 'Compleanno';
		$this->profile_contact = 'Contatto';
		$this->profile_email_address = 'Indirizzo Email';
		$this->profile_fav = 'Forum Preferito';
		$this->profile_fav_forum = '%s (%d%% sono messaggi di questo utente)';
		$this->profile_gtalk = 'Account GTalk';
		$this->profile_icq_uin = 'Numero ICQ';
		$this->profile_info = 'Informazioni';
		$this->profile_interest = 'Interessi';
		$this->profile_joined = 'Iscritto il';
		$this->profile_last_post = 'Ultimo Messaggio';
		$this->profile_list = 'Lista Utenti';
		$this->profile_location = 'Località';
		$this->profile_member = 'Gruppo';
		$this->profile_member_title = 'Titolo';
		$this->profile_msn = 'Identità MSN';
		$this->profile_must_user = 'Devi specificare un utente per vederne il profilo.';
		$this->profile_no_member = 'Non ci sono iscritti con questo user id. L\'account potrebbe essere stato cancellato.';
		$this->profile_none = '[ Nessuno ]';
		$this->profile_not_post = 'non ha ancora inviato messaggi.';
		$this->profile_offline = 'Questo utente non è attualmente connesso';
		$this->profile_online = 'Questo utente è online';
		$this->profile_pm = 'Messaggi Privati';
		$this->profile_postcount = '%s totali, %s al giorno';
		$this->profile_posts = 'Messaggi';
		$this->profile_private = '[ Privato ]';
		$this->profile_profile = 'Profilo';
		$this->profile_signature = 'Firma';
		$this->profile_unkown = '[ Sconosciuto ]';
		$this->profile_view_profile = 'Visualizza Profilo';
		$this->profile_www = 'Sito Web';
		$this->profile_yahoo = 'Identità Yahoo';
	}

	function prune()
	{
		$this->prune_action = 'Opzioni di sfoltimento discussioni';
		$this->prune_age_day = '1 Giorno';
		$this->prune_age_eighthours = '8 Ore';
		$this->prune_age_hour = '1 Ora';
		$this->prune_age_month = '1 Mese';
		$this->prune_age_threemonths = '3 Mesi';
		$this->prune_age_week = '1 Settimana';
		$this->prune_age_year = '1 Anno';
		$this->prune_forums = 'Seleziona forum da sfoltire';
		$this->prune_invalidage = 'Età non valida';
		$this->prune_move = 'Sposta';
		$this->prune_moveto_forum = 'Forum di destinazione';
		$this->prune_nodest = 'Destinazione non valida';
		$this->prune_notopics = 'Nessuna discussione selezionata per lo sfoltimento';
		$this->prune_notopics_old = 'Nessuna discussione è vecchia abbastanza per lo sfoltimento';
		$this->prune_novalidforum = 'Nessun forum valido per lo sfoltimento';
		$this->prune_select_age = 'Seleziona l\'eta\' delle discusioni per limitare l\'annoiamento a';
		$this->prune_select_topics = 'Seleziona le discussioni oppure usa Seleziona Tutto';
		$this->prune_success = 'Discussioni sfoltite';
		$this->prune_title = 'Sfoltimento discussioni';
		$this->prune_topics_older_than = 'Sfoltisci discussioni più vecchie di';
	}

	function query()
	{
		$this->query = 'Interfaccia Query';
		$this->query_fail = 'fallita.';
		$this->query_success = 'eseguita.';
		$this->query_your = 'La tua query';
	}

	function recent()
	{
		$this->recent_active = 'Discussioni attive dall\'ultima visita';
		$this->recent_by = 'Di';
		$this->recent_can_post = 'Puoi rispondere alle discussioni.';
		$this->recent_can_topics = 'Puoi leggere le discussioni.';
		$this->recent_cant_post = 'Non puoi rispodere alle discussioni.';
		$this->recent_cant_topics = 'Non puoi leggere le discussoni.';
		$this->recent_dot = 'punto';
		$this->recent_dot_detail = 'significa che hai partecipato a questa discussione.';
		$this->recent_forum = 'Forum'; //Translate
		$this->recent_guest = 'Visitatore';
		$this->recent_hot = 'Caldo';
		$this->recent_icon = 'Icone Messaggi';
		$this->recent_jump = 'Vai al nuovo messaggio della discussione';
		$this->recent_last = 'Ultimo messaggio';
		$this->recent_locked = 'Bloccato';
		$this->recent_moved = 'Spostato';
		$this->recent_msg = '%s Messaggi';
		$this->recent_new = 'Nuovo';
		$this->recent_new_poll = 'Crea Nuovo Sondaggio';
		$this->recent_new_topic = 'Crea Nuova Discussione';
		$this->recent_no_topics = 'Non ci sono discussioni in questo forum.';
		$this->recent_noexist = 'Il forum specificato non esiste.';
		$this->recent_nopost = 'Nessun Messaggio';
		$this->recent_not = 'Nessun';
		$this->recent_noview = 'Non hai il permesso di leggere questo forum.';
		$this->recent_pages = 'Pagine';
		$this->recent_pinned = 'Importante';
		$this->recent_pinned_topic = 'Discussione Importante';
		$this->recent_poll = 'Sondaggio';
		$this->recent_regfirst = 'Non hai il permesso di leggere questo forum. Lo potrai fare solo registrandoti.';
		$this->recent_replies = 'Risposte';
		$this->recent_starter = 'Autore';
		$this->recent_sub = 'Sotto-Forum';
		$this->recent_sub_last_post = 'Ultimo Messaggio';
		$this->recent_sub_replies = 'Risposta';
		$this->recent_sub_topics = 'Argomenti';
		$this->recent_subscribe = 'Mandami una e-mail quando qualcuno apre una nuova discussione';
		$this->recent_topic = 'Discussioni';
		$this->recent_views = 'Visite';
		$this->recent_write_topics = 'Puoi aprire nuove discussioni in questo forum.';
	}

	function register()
	{
		$this->register_activated = 'Il tuo account è stato attivato!';
		$this->register_activating = 'Attivazione Account';
		$this->register_activation_error = 'C\'è stato un errore durante l\'attivazione del tuo account. Controlla che nella barra indirizzi del tuo browser ci sia l\'intera url contenuta nell\'email che hai ricevuto. Se il problema persiste contatta l\'amministratore.';
		$this->register_confirm_passwd = 'Conferma Password';
		$this->register_done = 'Sei registrato! Ora puoi autenticarti.';
		$this->register_email = 'Indirizzo Email';
		$this->register_email_invalid = 'L\'indirizzo email che hai inserito non è valido.';
		$this->register_email_msg = 'Questo messaggio è stato generato automaticamente da Quicksilver Forums e ti è stato spedito';
		$this->register_email_msg2 = 'per attivare un account su';
		$this->register_email_msg3 = 'Clicca sul link sottostante, o copia/incollalo nel tuo browser:';
		$this->register_email_used = 'L\'indirizzo email che hai inserito risulta già usato da un altro utente.';
		$this->register_fields = 'Non hai completato tutti i campi.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = 'Per favore scrivi il testo che vedi nell\'immagine.';
		$this->register_image_invalid = 'Per verificare che tua sia un utente umano, devi inserire il testo che vedi nell\'immagine.';
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'Sei stato registrato. Un\' email di attivazione è stata spedita a %s con le informazioni necessarie ad attivare il tuo account. Il tuo account sarà limitato finchè non lo attiverai.';
		$this->register_name_invalid = 'Il nome che hai inserito è troppo lungo.';
		$this->register_name_taken = 'Questo nome utente è già in uso.';
		$this->register_new_user = 'Nome Utente Desiderato';
		$this->register_pass_invalid = 'La password che hai inserito non è valida. Assicurati di aver usato solo caratteri validi come lettere, numeri, trattini, underscores, o spazi, e che sia di almeno 5 caratteri.';
		$this->register_pass_match = 'Le passwords inserite non corrispondono.';
		$this->register_passwd = 'Password'; //Translate
		$this->register_reg = 'Registrati';
		$this->register_reging = 'Registrazione';
		$this->register_requested = 'Account activation request for:'; //Translate
		$this->register_tos = 'Termini del Servizio';
		$this->register_tos_i_agree = 'Accetto i termini';
		$this->register_tos_not_agree = 'Non sono d\'accordo.';
		$this->register_tos_read = 'Prego leggi i seguenti termini del servizio';
	}

	function rssfeed()
	{
		$this->rssfeed_cannot_find_forum = 'Il forum sembra non esistere';
		$this->rssfeed_cannot_find_topic = 'La discussione sembra non esistere';
		$this->rssfeed_cannot_read_forum = 'Non hai i permessi per leggere questo forum';
		$this->rssfeed_cannot_read_topic = 'Non hai i permessi per leggere questa discussione';
		$this->rssfeed_error = 'Errore';
		$this->rssfeed_forum = 'Forum:'; //Translate
		$this->rssfeed_posted_by = 'Inviato da';
		$this->rssfeed_topic = 'Discussione:';
	}

	function search()
	{
		$this->search_advanced = 'Opzioni Avanzate';
		$this->search_avatar = 'Avatar'; //Translate
		$this->search_basic = 'Ricerca Semplice';
		$this->search_characters = 'caratteri di un post';
		$this->search_day = 'giorno';
		$this->search_days = 'giorni';
		$this->search_exact_name = 'nome esatto';
		$this->search_flood = 'Hai già eseguito una ricerca negli ultimi %s secondi, devi aspettare un pò.<br /><br />';
		$this->search_for = 'Cerca Per';
		$this->search_forum = 'Forum'; //Translate
		$this->search_group = 'Gruppo';
		$this->search_guest = 'Visitatore';
		$this->search_in = 'Cerca In';
		$this->search_in_posts = 'Cerca solo nei messaggi';
		$this->search_ip = 'IP'; //Translate
		$this->search_joined = 'Iscritto il';
		$this->search_level = 'Livello Utente';
		$this->search_match = 'Cerca Parole Esatte';
		$this->search_matches = 'Corrispondenze';
		$this->search_month = 'mese';
		$this->search_months = 'mesi';
		$this->search_mysqldoc = 'Documentazione MySQL';
		$this->search_newer = 'recenti';
		$this->search_no_results = 'La tua ricerca non ha dato risultati.';
		$this->search_no_words = 'Devi specificare dei termini di ricerca.<br /><br />Ogni termine deve essere più lungo di 3 caratteri, incluse lettere, numeri, apostrofi, e underscore.';
		$this->search_offline = 'Questo utente non è attualmente connesso';
		$this->search_older = 'datati';
		$this->search_online = 'Questo utente è online';
		$this->search_only_display = 'Visualizza solo i primi';
		$this->search_partial_name = 'nome parziale';
		$this->search_post_icon = 'Icona Messaggio';
		$this->search_posted_on = 'Scritto il';
		$this->search_posts = 'Messaggi';
		$this->search_posts_by = 'Solo scritti da';
		$this->search_regex = 'Cerca per Espressioni Regolari';
		$this->search_regex_failed = 'La tua espressione regolare non è valida. Per favore consulta la documentazione MySQL.';
		$this->search_relevance = 'Rilevanza Messaggio: %d%%';
		$this->search_replies = 'Messaggi';
		$this->search_result = 'Risultati Ricerca';
		$this->search_search = 'Cerca';
		$this->search_select_all = 'Seleziona Tutto';
		$this->search_show_posts = 'Mostra direttamente i messaggi';
		$this->search_sound = 'Cerca per Assonanza';
		$this->search_starter = 'Autore';
		$this->search_than = 'di';
		$this->search_topic = 'Discussione';
		$this->search_unreg = 'Non registrato';
		$this->search_week = 'settimana';
		$this->search_weeks = 'settimane';
		$this->search_year = 'anno';
	}

	function settings()
	{
		$this->settings = 'Configurazione';
		$this->settings_active = 'Configurazione Attività Utenti';
		$this->settings_allow = 'Permetti';
		$this->settings_antibot = 'Registrazione Anti-Robot';
		$this->settings_attach_ext = 'Allegati - Estensioni File';
		$this->settings_attach_one_per = 'Uno per linea. Niente punti.';
		$this->settings_avatar = 'Configurazione Avatar';
		$this->settings_avatar_flash = 'Avatar Flash';
		$this->settings_avatar_max_height = 'Altezza Massima Avatar';
		$this->settings_avatar_max_width = 'Larghezza Massima Avatar';
		$this->settings_avatar_upload = 'Avatar Caricati - Dimensione Massima del File';
		$this->settings_basic = 'Modifica Configurazione Bacheca';
		$this->settings_blank = 'Usa <i>_blank</i> per una nuova finestra.';
		$this->settings_board_enabled = 'Bacheca Attiva';
		$this->settings_board_location = 'Indirizzo della bacheca';
		$this->settings_board_name = 'Nome Bacheca';
		$this->settings_board_rss = 'Configurazione RSS Feed';
		$this->settings_board_rssfeed_desc = 'Descrizione RSS Feed Description';
		$this->settings_board_rssfeed_posts = 'Numero dei messaggi nel RSS Feed';
		$this->settings_board_rssfeed_time = 'Tempo di Refresh in minuti';
		$this->settings_board_rssfeed_title = 'Titolo RSS Feed';
		$this->settings_clickable = 'Faccine Cliccabili per Riga';
		$this->settings_cookie = 'Configurazione Cookie e AntiFlood';
		$this->settings_cookie_path = 'Percorso Cookie';
		$this->settings_cookie_prefix = 'Prefisso Cookie';
		$this->settings_cookie_time = 'Tempo per rimanere loggati';
		$this->settings_db = 'Modifica Configurazione Connessione';
		$this->settings_db_host = 'Host Database';
		$this->settings_db_leave_blank = 'Lascia bianco per nessuno.';
		$this->settings_db_multiple = 'Per installazioni multiple sullo stesso database.';
		$this->settings_db_name = 'Nome Database';
		$this->settings_db_password = 'Password Database';
		$this->settings_db_port = 'Porta Database';
		$this->settings_db_prefix = 'Prefisso Tabelle';
		$this->settings_db_socket = 'Socket Database';
		$this->settings_db_username = 'Username Database';
		$this->settings_debug_mode = 'Debug Mode'; //Translate
		$this->settings_default_lang = 'Lingua di Default';
		$this->settings_default_no = 'No Default';
		$this->settings_default_skin = 'Skin di Default';
		$this->settings_default_yes = 'Default Sì';
		$this->settings_disabled = 'Disabilitato';
		$this->settings_disabled_notice = 'Disabilita Avvisi';
		$this->settings_email = 'Impostazioni E-Mail';
		$this->settings_email_fake = 'Solo per visualizzazione. Potrebbe non essere un indirizzo email reale.';
		$this->settings_email_from = 'E-mail Dall\' Indirizzo';
		$this->settings_email_place1 = 'Assegna l\'utente al gruppo';
		$this->settings_email_place2 = 'fino a quando non l\'e-mail non viene verificata';
		$this->settings_email_place3 = 'Non richiede e-mail di attivazione';
		$this->settings_email_real = 'Deve essere un indirizzo email reale.';
		$this->settings_email_reply = 'Indirizzo E-mail Rispondi-a';
		$this->settings_email_smtp = 'Server SMTP Mail';
		$this->settings_email_valid = 'E-mail di Convalida ai Nuovi Iscritti';
		$this->settings_enabled = 'Abilitato';
		$this->settings_enabled_modules = 'Moduli Abilitati';
		$this->settings_foreign_link = 'Obiettivo Link Estraneo';
		$this->settings_general = 'Configurazione Generale';
		$this->settings_group_after = 'Gruppo Dopo la Registrazione';
		$this->settings_hot_topic = 'Messaggi per Discussione Rovente';
		$this->settings_kilobytes = 'Kilobyte';
		$this->settings_max_attach_size = 'Allegati - Dimensione Massima del File';
		$this->settings_members = 'Configurazione Utenti';
		$this->settings_modname_only = 'Solo il nome del modulo. Non inserire .php';
		$this->settings_new = 'New Setting'; //Translate
		$this->settings_new_add = 'Add Board Setting';
		$this->settings_new_added = 'New settings added.'; //Translate
		$this->settings_new_exists = 'That setting already exists. Choose another name for it.'; //Translate
		$this->settings_new_name = 'New setting name'; //Translate
		$this->settings_new_required = 'The new setting name is required.'; //Translate
		$this->settings_new_value = 'New setting value'; //Translate
		$this->settings_no_allow = 'Non permettere';
		$this->settings_nodata = 'Nessun dato e\' stato inviato da POST';
		$this->settings_one_per = 'Uno per linea';
		$this->settings_pixels = 'Pixel';
		$this->settings_pm_flood = 'AntiFlood Messaggi Privati';
		$this->settings_pm_min_time = 'Tempo che deve intercorrere tra due MP.';
		$this->settings_polls = 'Sondaggi';
		$this->settings_polls_no = 'Gli utenti non possono esprimere il voto nei sondaggi dopo aver visto i risultati';
		$this->settings_polls_yes = 'Gli utenti possono esprimere il voto nei sondaggi dopo aver visto i risultati';
		$this->settings_post_flood = 'AntiFlood Messaggi';
		$this->settings_post_min_time = 'Tempo che deve intercorrere tra due messaggi.';
		$this->settings_posts_topic = 'Messaggi per Pagina';
		$this->settings_search_flood = 'AntiFlood per le ricerche';
		$this->settings_search_min_time = 'Tempo che deve intercorrere tra due ricerche.';
		$this->settings_server = 'Configurazione del Server';
		$this->settings_server_gzip = 'Compressione GZIP';
		$this->settings_server_gzip_msg = 'Aumenta la velocità. Disabilitare in caso di problemi.';
		$this->settings_server_maxload = 'Carico Massimo del Server';
		$this->settings_server_maxload_msg = 'Disabilita board sotto un eccesivo sforzo del server. Inserisci 0 per disabilitare.';
		$this->settings_server_timezone = 'Fuso Orario del Server';
		$this->settings_show_avatars = 'Mostra Avatar';
		$this->settings_show_email = 'Mostra Indirizzi Email';
		$this->settings_show_emotes = 'Mostra Faccine';
		$this->settings_show_notice = 'Mostrato quando la bacheca è chiusa';
		$this->settings_show_pm = 'Accetta Messaggi Privati';
		$this->settings_show_sigs = 'Mostra Firme';
		$this->settings_spider_agent = 'User Agent Spider';
		$this->settings_spider_agent_msg = 'Inserisci tutto o parte de HTTP USER AGENT dello spider.';
		$this->settings_spider_enable = 'Abilita Visualizzazione degli Spider';
		$this->settings_spider_enable_msg = 'Abilita visualizzazione del nome degli spider dei motori di ricerca nella lista Attività.';
		$this->settings_spider_name = 'Nome Spider';
		$this->settings_spider_name_msg = 'Inserisci il nome che vuoi visualizzare per ogni spider dell\'elenco qui sopra. Hai bisogno di inserire il nome dello spider nella stessa linea dello spider user agent.Per Esempio, se inserisci \'googlebot\' nella terza linea, inserisci \'Google\' nella terza linea del nome dello Spider.';
		$this->settings_timezone = 'Fuso Orario';
		$this->settings_topics_page = 'Discussioni Per Pagina';
		$this->settings_tos = 'Condizioni di Servizio';
		$this->settings_updated = 'Configurazione aggiornata.';
	}

	function stats()
	{
		$this->stats = 'Statistiche';
		$this->stats_post_by_month = 'Messaggi al Mese';
		$this->stats_reg_by_month = 'Registrazioni al Mese';
	}

	function templates()
	{
		$this->add = 'Aggiungi Template HTML';
		$this->add_in = 'Aggiungi template a:';
		$this->all_fields_required = 'Tutti i campi sono obbligatori per aggiungere un template';
		$this->choose_css = 'Choose CSS Template'; //Translate
		$this->choose_set = 'Scegli il gruppo di template';
		$this->choose_skin = 'Scegli una skin';
		$this->confirm1 = 'Stai per eliminare';
		$this->confirm2 = 'template da';
		$this->create_new = 'Crea una nuova skin chiamata';
		$this->create_skin = 'Crea Skin';
		$this->credit = 'Per favore non rimuovere i crediti!';
		$this->css_edited = 'CSS file has been updated.'; //Translate
		$this->css_fioerr = 'The file could not be written to, you will need to CHMOD the file manually.'; //Translate
		$this->delete_template = 'Elimina Template';
		$this->directory = 'Cartella';
		$this->display_name = 'Nome Mostrato';
		$this->edit_css = 'Edit CSS'; //Translate
		$this->edit_skin = 'Modifica Skin';
		$this->edit_templates = 'Modifica Template';
		$this->export_done = 'Skin esportata nella cartella principale di Quicksilver Forums.';
		$this->export_select = 'Seleziona una skin da esportare';
		$this->export_skin = 'Esporta Skin';
		$this->install_done = 'La skin è stata installata con successo.';
		$this->install_exists1 = 'Sembra che la skin';
		$this->install_exists2 = 'sia già stata installata.';
		$this->install_overwrite = 'Sovrascrivi';
		$this->install_skin = 'Installa Skin';
		$this->menu_title = 'Seleziona la sezione da editare';
		$this->no_file = 'No such file.'; //Translate
		$this->only_skin = 'Hai una sola skin installata. Non puoi eliminare questa skin.';
		$this->or_new = 'Oppure crea un nuovo gruppo di template chiamato:';
		$this->select_skin = 'Seleziona la Skin';
		$this->select_skin_edit = 'Seleziona la Skin da modificare';
		$this->select_skin_edit_done = 'Skin modificata.';
		$this->select_template = 'Seleziona Template';
		$this->skin_chmod = 'La nuova cartella per la skin non può essere creata. Devi rendere scrivibile la cartella delle skin (CHMOD 775 o 777).';
		$this->skin_created = 'Skin creata.';
		$this->skin_deleted = 'Skin eliminata.';
		$this->skin_dir_name = 'Devi inserire il nome della skin ed il nome della cartella.';
		$this->skin_dup = 'E\' stata trovata una skin con un cartella con lo stesso nome. La cartella della skin verra\' cambiata in';
		$this->skin_name = 'Devi inserire un nome per la skin.';
		$this->skin_none = 'Non ci sono skin da installare.';
		$this->skin_set = 'Gruppo Skin';
		$this->skins_found = 'Le seguenti skin sono state trovate nella cartella di Quicksilver Forums';
		$this->template_about = 'Variabili';
		$this->template_about2 = 'Le variabili sono porzioni di testo che verranno sostituite con dei dati. Le variabili iniziano sempre con il simbolo del dollaro e sono talvolta racchiusi fra {parentesi graffe}.';
		$this->template_add = 'Aggiungi';
		$this->template_added = 'Template aggiunto.';
		$this->template_clear = 'Pulisci';
		$this->template_confirm = 'Hai apportato delle modifiche al template. Vuoi salvare i tuoi cambiamenti?';
		$this->template_description = 'Template Descrizione';
		$this->template_html = 'Template HTML'; //Translate
		$this->template_name = 'Nome Template';
		$this->template_position = 'Posistion Template';
		$this->template_set = 'Gruppo Template';
		$this->template_title = 'Titolo Template';
		$this->template_universal = 'Variabile Universale';
		$this->template_universal2 = 'Alcune variabili posso essere utilizzate in alcuni temoplate, mentre altre possono essere utilizzate in un singolo template. Le proprieta\' dell\'oggetto $ questo puo\' essere utilizzato sempre.';
		$this->template_updated = 'Template aggiornato.';
		$this->templates = 'Template';
		$this->temps_active = 'Dettagli Utenti Attivi';
		$this->temps_admin = '<b>AdminCP Universale</b>';
		$this->temps_ban = 'AdminCP Ban';
		$this->temps_board_index = 'Indice Bocheca';
		$this->temps_censoring = 'AdminCP Censure';
		$this->temps_cp = 'Pannello Utente';
		$this->temps_email = 'Email a Membro';
		$this->temps_emot_control = 'AdminCP Faccine';
		$this->temps_forum = 'Forum';
		$this->temps_forums = 'AdminCP Forum';
		$this->temps_groups = 'AdminCP Gruppi';
		$this->temps_help = 'Aiuto';
		$this->temps_login = 'Log In/Out';
		$this->temps_logs = 'AdminCP Log Moderazione';
		$this->temps_main = '<b>Bacheca Universale</b>';
		$this->temps_mass_mail = 'AdminCP Email di Massa';
		$this->temps_member_control = 'AdminCP Controllo Utenti';
		$this->temps_members = 'Lista Iscritti';
		$this->temps_mod = 'Controlli Moderatore';
		$this->temps_pm = 'Messaggi Privati';
		$this->temps_polls = 'Sondaggi';
		$this->temps_post = 'Composizione Messaggi';
		$this->temps_printer = 'Versione Stampabile';
		$this->temps_profile = 'Visualizzazione Profilo';
		$this->temps_recent = 'Discussioni Recenti';
		$this->temps_register = 'Registrazione';
		$this->temps_rssfeed = 'Fedd RSS ';
		$this->temps_search = 'Ricerca';
		$this->temps_settings = 'AdminCP Configurazione';
		$this->temps_templates = 'AdminCP Editor Template';
		$this->temps_titles = 'AdminCP Titoli Utente';
		$this->temps_topic_prune = 'AdminCP Sfoltimento Discussioni';
		$this->temps_topics = 'Discussioni';
		$this->upgrade_skin = 'Aggiornamento Skin';
		$this->upgrade_skin_already = 'è gia aggiornata. Nessun cambiamento effettuato.';
		$this->upgrade_skin_detail = 'Le skin aggiornate con questo metodo, potrebbero richiedere un\'ulteriore modifica manuale.<br />Seleziona la skin da aggiornare';
		$this->upgrade_skin_upgraded = 'è stata aggiornata.';
		$this->upgraded_templates = 'I seguenti template sono stati aggiunti';
	}

	function titles()
	{
		$this->titles_add = 'Aggiungi titolo utente';
		$this->titles_added = 'Titolo utente aggiunto.';
		$this->titles_control = 'Controllo Titoli utente';
		$this->titles_edit = 'Modifica titoli utente';
		$this->titles_error = 'Nessun titolo o messaggi minimi inseriti';
		$this->titles_image = 'Immagine';
		$this->titles_minpost = 'Messaggi minimi';
		$this->titles_nodel_default = 'Removal of the default title has been disabled as it will break your board, please edit it instead.'; //Translate
		$this->titles_title = 'Titolo';
	}

	function topic()
	{
		$this->topic_attached = 'File allegato:';
		$this->topic_attached_downloads = 'download';
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = 'Non hai il permesso per il download di questo file.';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = 'File Allegato';
		$this->topic_avatar = 'Avatar'; //Translate
		$this->topic_bottom = 'Vai alla fine della pagina';
		$this->topic_create_poll = 'Crea Nuovo Sondaggio';
		$this->topic_create_topic = 'Crea Nuova Discussione';
		$this->topic_delete = 'Elimina';
		$this->topic_delete_post = 'Elimina questo messaggio';
		$this->topic_edit = 'Modifica';
		$this->topic_edit_post = 'Modifica questo messaggio';
		$this->topic_edited = 'Ultima modifica %s by %s';
		$this->topic_error = 'Errore';
		$this->topic_group = 'Gruppo';
		$this->topic_guest = 'Visualizza';
		$this->topic_ip = 'IP'; //Translate
		$this->topic_joined = 'Iscritto il';
		$this->topic_level = 'Livello Utente';
		$this->topic_links_aim = 'Invia un messaggio AIM a %s';
		$this->topic_links_email = 'Invia una email a %s';
		$this->topic_links_gtalk = 'Invia un messaggio GTalk a %s';
		$this->topic_links_icq = 'Invia un messaggio ICQ a %s';
		$this->topic_links_msn = 'Visualizza il profilo MSN di %s';
		$this->topic_links_pm = 'Invia un Messaggio Privato %s';
		$this->topic_links_web = 'Visita il sito web di %s';
		$this->topic_links_yahoo = 'Invia un messaggio a %s con Yahoo! Messenger';
		$this->topic_lock = 'Blocca';
		$this->topic_locked = 'Discussione Bloccata';
		$this->topic_move = 'Sposta';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = 'Discussioni recenti';
		$this->topic_no_newer = 'Non ci sono nuove discussioni.';
		$this->topic_no_older = 'Non ci sono vecchie discussioni.';
		$this->topic_no_votes = 'Non ci sono voti per questo sondaggio.';
		$this->topic_not_found = 'Discussione Non Trovata';
		$this->topic_not_found_message = 'La discussione non è stata trovata. Potrebbe essere stata spostata, cancellata o potrebbe non essere mai esistita.';
		$this->topic_offline = 'Questo utente è attualmente scollegato';
		$this->topic_older = 'Discussione Vecchia';
		$this->topic_online = 'Questo utente è online';
		$this->topic_options = 'Opzioni Discussione';
		$this->topic_pages = 'Pagine';
		$this->topic_perm_view = 'Non hai il permesso per leggere le discussioni.';
		$this->topic_perm_view_guest = 'Non hai il permesso per leggere le discussioni. Lo potrai fare solo registrandoti.';
		$this->topic_pin = 'In Rilievo';
		$this->topic_posted = 'Inviato';
		$this->topic_posts = 'Messaggi';
		$this->topic_print = 'Visualizza Stampabile';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'Emoticon';
		$this->topic_qr_open_emoticons = 'Apri Emoticon Cliccabili';
		$this->topic_qr_open_mbcode = 'Apri MBCode';
		$this->topic_quickreply = 'Replica Veloce';
		$this->topic_quote = 'Rispondi riportando questa discussione';
		$this->topic_reply = 'Rispondi alla Discussione';
		$this->topic_split = 'Dividi';
		$this->topic_split_finish = 'Esegui la divisione';
		$this->topic_split_keep = 'Non muovere';
		$this->topic_split_move = 'Dividi e Muovi';
		$this->topic_subscribe = 'Inviami una email quando qualcuno risponde a questa discussione';
		$this->topic_top = 'Vai all\'inizio della pagina';
		$this->topic_unlock = 'Sblocca';
		$this->topic_unpin = 'Non in Rilievo';
		$this->topic_unpublish = 'Non pubblicate';
		$this->topic_unpublished = 'Questa discussione e\' classificata come non pubblicata per questo non hai il permesso di visualizzarla.';
		$this->topic_unreg = 'Non Registrato';
		$this->topic_view = 'Visualizza Risultati';
		$this->topic_viewing = 'Visualizza Discussioni';
		$this->topic_vote = 'Vota';
		$this->topic_vote_count_plur = '%d voti';
		$this->topic_vote_count_sing = '%d voto';
		$this->topic_votes = 'Voti';
	}

	function universal()
	{
		$this->aim = 'AIM'; //Translate
		$this->based_on = 'Basato su';
		$this->board_by = 'Di';
		$this->charset = 'utf-8';
		$this->continue = 'Continua';
		$this->date_long = 'M j, Y'; //Translate
		$this->date_short = 'n/j/y'; //Translate
		$this->delete = 'Elimina';
		$this->direction = 'ltr'; //Translate
		$this->edit = 'Modifica';
		$this->email = 'Email'; //Translate
		$this->gtalk = 'GT'; //Translate
		$this->icq = 'ICQ'; //Translate
		$this->msn = 'MSN'; //Translate
		$this->new_message = 'Nuovo Messaggio';
		$this->new_poll = 'Nuovo Sondaggio';
		$this->new_topic = 'Nuova Discussione';
		$this->no = 'No'; //Translate
		$this->powered = 'Powered by'; //Translate
		$this->private_message = 'PM'; //Translate
		$this->quote = 'Citazione';
		$this->recount_forums = 'Recounted forums! Total topics: %d. Total posts: %d.'; //Translate
		$this->reply = 'Replica';
		$this->seconds = 'Secondi';
		$this->select_all = 'Seleziona Tutto';
		$this->sep_decimals = ',';
		$this->sep_thousands = '.';
		$this->spoiler = 'Spoiler'; //Translate
		$this->submit = 'Invia';
		$this->subscribe = 'Traccia';
		$this->time_long = ', g:i a'; //Translate
		$this->time_only = 'g:i a'; //Translate
		$this->today = 'Oggi';
		$this->website = 'WWW'; //Translate
		$this->yahoo = 'Yahoo'; //Translate
		$this->yes = 'Sì';
		$this->yesterday = 'Ieri';
	}
}
?>
