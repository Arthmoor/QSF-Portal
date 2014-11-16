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
 * Norwegian language module
 *
 * @author JGS <sag1@online.no>
 * @author Ingvild Karlsen <supposedly@yahoo.com>
 * @since 1.1.0
 **/
class no
{
       function active()
       {
               $this->active_last_action = 'Siste kommando';
               $this->active_modules_active = 'Viser aktive brukere';
               $this->active_modules_board = 'Viser index';
               $this->active_modules_cp = 'Bruker kontrollpanelet';
               $this->active_modules_forum = 'Leser et forum: %s';
               $this->active_modules_help = 'Bruker hjelp';
               $this->active_modules_login = 'Logger inn/ut';
               $this->active_modules_members = 'Viser medlemsliste';
               $this->active_modules_mod = 'Administrerer';
               $this->active_modules_pm = 'Bruker Messenger';
               $this->active_modules_post = 'Skriver innlegg';
               $this->active_modules_printer = 'Skriver ut et emne: %s';
               $this->active_modules_profile = 'Leser en profil: %s';
               $this->active_modules_recent = 'Leser nye innlegg';
               $this->active_modules_search = 'Søker';
               $this->active_modules_topic = 'Leser et emne: %s';
               $this->active_time = 'Tid';
               $this->active_user = 'Bruker';
               $this->active_users = 'Aktive brukere';
       }

       function admin()
       {
               $this->admin_add_emoticons = 'Legg til smilies';
               $this->admin_add_member_titles = 'Legg til automatiske medlemstitler';
               $this->admin_add_templates = 'Legg til HTML-maler';
               $this->admin_ban_ips = 'Blokkér IP-addresser';
               $this->admin_censor = 'Sensurér ord';
               $this->admin_cp_denied = 'Nektet tilgang';
               $this->admin_cp_warning = 'Admin-kontrollpanelet er slått av til du sletter <b>install</b>-mappen, ettersom den er en alvorlig sikkerhetsrisiko.';
               $this->admin_create_forum = 'Lag et forum';
               $this->admin_create_group = 'Lag en gruppe';
               $this->admin_create_help = 'Lag en hjelpeartikkel';
               $this->admin_create_skin = 'Lag et skall';
               $this->admin_db = 'Database';
               $this->admin_db_backup = 'Sikkerhetskopiér databasen';
               $this->admin_db_conn = 'Endre innstillinger for tilkobling';
               $this->admin_db_optimize = 'Optimisér databasen';
               $this->admin_db_query = 'Start en SQL-forespørsel';
               $this->admin_db_restore = 'Gjenopprett sikkerhetskopi';
               $this->admin_delete_forum = 'Slett et forum';
               $this->admin_delete_group = 'Slett en gruppe';
               $this->admin_delete_help = 'Slett en hjelpeartikkel';
               $this->admin_delete_member = 'Slett et medlem';
               $this->admin_delete_template = 'Slett en HTML-mal';
               $this->admin_edit_emoticons = 'Endre eller slett smilies';
               $this->admin_edit_forum = 'Endre et forum';
               $this->admin_edit_group_name = 'Endre et gruppenavn';
               $this->admin_edit_group_perms = 'Endre en gruppes tillatelser';
               $this->admin_edit_help = 'Endre en hjelpeartikkel';
               $this->admin_edit_member = 'Endre et medlem';
               $this->admin_edit_member_perms = 'Endre et medlems tillatelser';
               $this->admin_edit_member_titles = 'Endre eller slett automatiske medlemstitler';
               $this->admin_edit_settings = 'Endre innstillinger';
               $this->admin_edit_skin = 'Endre eller slett et skall';
               $this->admin_edit_templates = 'Endre HTML-maler';
               $this->admin_emoticons = 'smilies';
               $this->admin_export_skin = 'Eksportér et skall';
               $this->admin_fix_stats = 'Justér medlemsstatistikken';
               $this->admin_forum_order = 'Endre forumrekkefølgen';
               $this->admin_forums = 'Fora og kategorier';
               $this->admin_groups = 'Grupper';
               $this->admin_heading = 'Quicksilver Forums Admin-kontrollpanel';
               $this->admin_help = 'Hjelpeartikler';
               $this->admin_install_emoticons = 'Installér smilies';
               $this->admin_install_skin = 'Installér et skall';
               $this->admin_logs = 'Se på moderatorenes handlinger';
               $this->admin_mass_mail = 'Send epost til medlemmene dine';
               $this->admin_members = 'Medlemmer';
               $this->admin_phpinfo = 'Se på PHP-informasjon';
               $this->admin_prune = 'Rydd i gamle emner';
               $this->admin_recount_forums = 'Regn om emner og svar';
               $this->admin_settings = 'Innstillinger';
               $this->admin_settings_add = 'Legg til nye innstillinger';
               $this->admin_skins = 'Skall';
               $this->admin_stats = 'Statistikksenter';
               $this->admin_upgrade_skin = 'Oppgradér et skall';
               $this->admin_your_board = 'Din gruppe';
       }

       function backup()
       {
               $this->backup_create = 'Sikkerhetskopiér database';
               $this->backup_createfile = 'Sikkerhetskopiér og lag en fil på server';
               $this->backup_done = 'Databasen har blitt sikkerhetskopiert til Quicksilver Forums hovedregister.';
               $this->backup_download = 'Sikkerhetskopiér og last ned (anbefales)';
               $this->backup_found = 'Følgende sikkerhetskopier ble funnet i Quicksilver Forums register';
               $this->backup_invalid = 'Sikkerhetskopien ser ikke ut til å være korrekt. Ingen endringer i databasen har blitt lagret.';
               $this->backup_none = 'Ingen sikkerhetskopier ble funnet i Quicksilver Forums register.';
               $this->backup_options = 'Velg måten du vil sikkerhetskopiere på';
               $this->backup_restore = 'Gjenopprett sikkerhetskopi';
               $this->backup_restore_done = 'Databasen har blitt gjenopprettet.';
               $this->backup_warning = 'Advarsel: Dette overskriver all eksisterende data brukt av Quicksilver Forums.';
       }

       function ban()
       {
               $this->ban = 'Blokkér';
               $this->ban_banned_ips = 'Blokkér IP-adresser';
               $this->ban_banned_members = 'Blokkerte medlemmer';
               $this->ban_ip = 'Blokkér IP-adresser';
               $this->ban_member_explain1 = 'For å blokkere brukere, endre brukergruppen deres til';
               $this->ban_member_explain2 = 'under medlemskontrollen.';
               $this->ban_members = 'Blokkér medlemmer';
               $this->ban_nomembers = 'Det finnes ingen blokkerte medlemmer.';
               $this->ban_one_per_line = 'Én adresse pr. linje.';
               $this->ban_regex_allowed = 'Vanlige kommandoer er tillatt. Du kan bytte ut ett eller flere sifre med en asterisk (*).';
               $this->ban_settings = 'Blokkér innstillinger';
               $this->ban_users_banned = 'Brukere er blokkert.';
       }

       function bbcode()
       {
               $this->bbcode_arial = 'Arial';
               $this->bbcode_blue = 'Blå';
               $this->bbcode_bold = 'Fet (CTRL-b)';
               $this->bbcode_bold1 = 'F';
               $this->bbcode_chocolate = 'Sjokolade';
               $this->bbcode_code = 'Kode (CTRL-l)';
               $this->bbcode_code1 = 'Kode';
               $this->bbcode_color = 'Farge';
               $this->bbcode_coral = 'Korall';
               $this->bbcode_courier = 'Courier';
               $this->bbcode_crimson = 'Karmosinrød';
               $this->bbcode_darkblue = 'Mørkeblå';
               $this->bbcode_darkred = 'Mørkerød';
               $this->bbcode_deeppink = 'Gammelrosa';
               $this->bbcode_email = 'Epost (CTRL-e)';
               $this->bbcode_firered = 'Mursteinsrød';
               $this->bbcode_font = 'Skrifttype';
               $this->bbcode_green = 'Grønn';
               $this->bbcode_huge = 'Størst';
               $this->bbcode_image = 'Bilde (CTRL-j)';
               $this->bbcode_image1 = 'IMG';
               $this->bbcode_impact = 'Impact';
               $this->bbcode_indigo = 'Indigo';
               $this->bbcode_italic = 'Kursiv (CTRL-i)';
               $this->bbcode_italic1 = 'K';
               $this->bbcode_large = 'Stor';
               $this->bbcode_limegreen = 'Limegrønn';
               $this->bbcode_medium = 'Medium';
               $this->bbcode_orange = 'Oransje';
               $this->bbcode_orangered = 'Oransjerød';
               $this->bbcode_php = 'PHP (CTRL-k)';
               $this->bbcode_php1 = 'PHP';
               $this->bbcode_purple = 'Lilla';
               $this->bbcode_quote = 'Sitat (CTRL-q)';
               $this->bbcode_quote1 = 'Sitat';
               $this->bbcode_red = 'Rød';
               $this->bbcode_royalblue = 'Kongeblå';
               $this->bbcode_sandybrown = 'Sandfarget';
               $this->bbcode_seagreen = 'Sjøgrønn';
               $this->bbcode_sienna = 'Rødbrun';
               $this->bbcode_silver = 'Sølvgrå';
               $this->bbcode_size = 'Størrelse';
               $this->bbcode_skyblue = 'Himmelblå';
               $this->bbcode_small = 'Liten';
               $this->bbcode_spoiler = 'Spoiler (CTRL-r)';
               $this->bbcode_spoiler1 = 'Spoiler';
               $this->bbcode_strike = 'Gjennomstreking (CTRL-s)';
               $this->bbcode_strike1 = 'G';
               $this->bbcode_tahoma = 'Tahoma';
               $this->bbcode_teal = 'Blågrønn';
               $this->bbcode_times = 'Times';
               $this->bbcode_tiny = 'Minst';
               $this->bbcode_tomato = 'Tomatrød';
               $this->bbcode_underline = 'Understreking (CTRL-u)';
               $this->bbcode_underline1 = 'U';
               $this->bbcode_url = 'URL (CTRL-h)';
               $this->bbcode_url1 = 'URL';
               $this->bbcode_verdana = 'Verdana';
               $this->bbcode_wood = 'Trefarget';
               $this->bbcode_yellow = 'Gul';
       }

       function board()
       {
               $this->board_active_users = 'Aktive brukere';
               $this->board_birthdays = 'Fødselsdag i dag:';
               $this->board_bottom_page = 'Gå til slutten av siden';
               $this->board_can_post = 'Du kan svare i dette forumet.';
               $this->board_can_topics = 'Du kan lese, men ikke opprette emner i dette forumet.';
               $this->board_cant_post = 'Du kan ikke svare i dette forumet.';
               $this->board_cant_topics = 'Du kan ikke lese eller opprette emner i dette forumet.';
               $this->board_forum = 'Forum';
               $this->board_guests = 'gjester';
               $this->board_last_post = 'Siste innlegg';
               $this->board_mark = 'Markér innlegg som lest';
               $this->board_mark1 = 'Alle innlegg og fora har blitt markert som lest.';
               $this->board_markforum = 'Markér forum som lest';
               $this->board_markforum1 = 'Alle innlegg i forumet %s har blitt markert som lest.';
               $this->board_members = 'medlemmer';
               $this->board_message = '%s melding';
               $this->board_most_online = 'Høyest antall samtidige brukere var %d den %s.';
               $this->board_nobday = 'Ingen medlemmer fyller år i dag.';
               $this->board_nobody = 'Det er ingen medlemmer online.';
               $this->board_nopost = 'Ingen innlegg';
               $this->board_noview = 'Du har ikke tillatelse til å lese forumet.';
               $this->board_regfirst = 'Du har ikke tillatelse til å lese forumet før du registrerer deg.';
               $this->board_replies = 'Svar';
               $this->board_stats = 'Statistikk';
               $this->board_stats_string = '%s brukere er registrert. Velkommen til vårt nyeste medlem, %s.<br />Det er %s emner og %s svar med en total på %s innlegg.';
               $this->board_top_page = 'Gå til toppen av siden';
               $this->board_topics = 'Emner';
               $this->board_users = 'Brukere';
               $this->board_write_topics = 'Du kan lese og opprette emner i dette forumet.';
       }

       function censoring()
       {
               $this->censor = 'Sensurér ord';
               $this->censor_one_per_line = 'Én pr. linje.';
               $this->censor_regex_allowed = 'Vanlige kommandoer er tillatt. Du kan bytte ut ett eller flere sifre med en asterisk (*).';
               $this->censor_updated = 'Ordliste oppdatert.';
       }

       function cp()
       {
               $this->cp_aim = 'AIM-navn';
               $this->cp_already_member = 'Epostadressen du skrev inn er i bruk.';
               $this->cp_apr = 'April';
               $this->cp_aug = 'August';
               $this->cp_avatar_current = 'Din nåværende avatar';
               $this->cp_avatar_error = 'Avatar-feil';
               $this->cp_avatar_must_select = 'Du må velge en avatar.';
               $this->cp_avatar_none = 'Ikke bruk avatar';
               $this->cp_avatar_pixels = 'punkter';
               $this->cp_avatar_select = 'Velg en avatar';
               $this->cp_avatar_size_height = 'Høyden på avataren må være mellom 1 og';
               $this->cp_avatar_size_width = 'Bredden på avataren må være mellom 1 og';
               $this->cp_avatar_upload = 'Last opp en avatar fra harddisken';
               $this->cp_avatar_upload_failed = 'Opplastingen av avataren gikk galt. Filen du har valgt finnes ikke.';
               $this->cp_avatar_upload_not_image = 'Du kan bare laste opp bilder til å bruke som avatar.';
               $this->cp_avatar_upload_too_large = 'Avataren du valgte å laste opp er for stor. Maks størrelse er %d kilobyte.';
               $this->cp_avatar_url = 'Skriv inn webadressen til avataren din';
               $this->cp_avatar_use = 'Bruk den opplastede avataren din';
               $this->cp_bday = 'Fødselsdag';
               $this->cp_been_updated = 'Din profil er oppdatert.';
               $this->cp_been_updated1 = 'Din avatar er oppdatert.';
               $this->cp_been_updated_prefs = 'Dine innstillinger er oppdatert.';
               $this->cp_changing_pass = 'Endre passord';
               $this->cp_contact_pm = 'Tillate at andre brukere kontakter deg via meldinger?';
               $this->cp_cp = 'Kontrollpanel';
               $this->cp_current_avatar = 'Nåværende avatar';
               $this->cp_current_time = 'Klokken er %s.';
               $this->cp_custom_title = 'Egendefinert medlemstittel';
               $this->cp_custom_title2 = 'Dette er et privilegium forbeholdt administratorer';
               $this->cp_dec = 'Desember';
               $this->cp_editing_avatar = 'Endre avatar';
               $this->cp_editing_profile = 'Endre profil';
               $this->cp_email = 'Epost';
               $this->cp_email_form = 'Tillate at andre brukere kan kontakte deg via epost?';
               $this->cp_email_invaid = 'Epostadressen du skrev inn er ugyldig.';
               $this->cp_err_avatar = 'Mislykket oppdatering av avatar';
               $this->cp_err_updating = 'Oppdatering av profil gikk galt';
               $this->cp_feb = 'Februar';
               $this->cp_file_type = 'Avataren er ugyldig. Forsikre deg om at web-adressen er korrekt og at filtypen er .gif, .jpg, eller .png';
               $this->cp_format = 'Navn';
               $this->cp_gtalk = 'GTalk-konto';
               $this->cp_header = 'Kontrollpanel';
               $this->cp_height = 'Høyde';
               $this->cp_icq = 'ICQ-nummer';
               $this->cp_interest = 'Interesser';
               $this->cp_jan = 'Januar';
               $this->cp_july = 'Juli';
               $this->cp_june = 'Juni';
               $this->cp_label_edit_avatar = 'Endre avatar';
               $this->cp_label_edit_pass = 'Endre passord';
               $this->cp_label_edit_prefs = 'Endre innstillinger';
               $this->cp_label_edit_profile = 'Endre profil';
               $this->cp_label_edit_sig = 'Endre signatur';
               $this->cp_label_edit_subs = 'Endre abonnement';
               $this->cp_language = 'Språk';
               $this->cp_less_charac = 'Navnet ditt må være kortere enn 32 bokstaver.';
               $this->cp_location = 'Sted';
               $this->cp_login_first = 'Du må være innlogget for å ha tilgang til kontrollpanelet.';
               $this->cp_mar = 'Mars';
               $this->cp_may = 'Mai';
               $this->cp_msn = 'MSN-navn';
               $this->cp_must_orig = 'Ditt navn må være identisk med det originale. Du får bare endre store/små bokstaver og mellomrom.';
               $this->cp_new_notmatch = 'De nye passordene er ikke identiske.';
               $this->cp_new_pass = 'Nytt passord';
               $this->cp_no_flash = 'Flash-avatarer er ikke tillatt.';
               $this->cp_not_exist = 'Datoen du oppga (%s) er ugyldig!';
               $this->cp_nov = 'November';
               $this->cp_oct = 'Oktober';
               $this->cp_old_notmatch = 'Ditt gamle passord er feil.';
               $this->cp_old_pass = 'Gammelt passord';
               $this->cp_pass_notvaid = 'Ditt passord er ugyldig. Kun bokstaver, sifre, bindestreker, understreker og mellomrom er tillatt.';
               $this->cp_posts_page = 'Innlegg per emneside. 0 tilbakesetter forumets innstillinger.';
               $this->cp_preferences = 'Endre innstillinger';
               $this->cp_preview_sig = 'Forhåndsvisning av signatur:';
               $this->cp_privacy = 'Sikkerhetsinnstillinger';
               $this->cp_repeat_pass = 'Oppgi nytt passord igjen';
               $this->cp_sept = 'September';
               $this->cp_show_active = 'Vise handlingene dine når du bruker diskusjonsgruppen?';
               $this->cp_show_email = 'Vise epostadresse i profilen din?';
               $this->cp_signature = 'Signatur';
               $this->cp_size_max = 'Avataren er for stor. Maks størrelse er %s x %s punkter.';
               $this->cp_skin = 'Skall';
               $this->cp_sub_change = 'Endre abonnement';
               $this->cp_sub_delete = 'Slette';
               $this->cp_sub_expire = 'Gyldig til dato';
               $this->cp_sub_name = 'Abonnementnavn';
               $this->cp_sub_no_params = 'Ingen parametre oppgitt.';
               $this->cp_sub_success = 'Du abonnerer nå på dette %s.';
               $this->cp_sub_type = 'Abonnementstype';
               $this->cp_sub_updated = 'Det valgte abonnementet er slettet.';
               $this->cp_topic_option = 'Forumvalg';
               $this->cp_topics_page = 'Emner per forumside. 0 tilbakesetter forumets innstillinger.';
               $this->cp_updated = 'Profilen er oppdatert';
               $this->cp_updated1 = 'Avataren er oppdatert';
               $this->cp_updated_prefs = 'Innstillinger er oppdatert';
               $this->cp_user_exists = 'En bruker med dette navnet finnes allerede.';
               $this->cp_valided = 'Ditt passord er validert og endret.';
               $this->cp_view_avatar = 'Vise avatarer?';
               $this->cp_view_emoticon = 'Vise smilies?';
               $this->cp_view_signature = 'Vise signaturer?';
               $this->cp_welcome = 'Velkommen til kontrollpanelet. Her kan du endre brukerkontoen din. Velg fra alternativene over.';
               $this->cp_width = 'Bredde';
               $this->cp_www = 'Hjemmeside';
               $this->cp_yahoo = 'Yahoo-navn';
               $this->cp_zone = 'Tidssone';
       }

       function email()
       {
               $this->email_blocked = 'Du kan ikke sende e-post til denne brukeren.';
               $this->email_email = 'E-post';
               $this->email_msgtext = 'Melding:';
               $this->email_no_fields = 'Gå tilbake og kontrollér at alle feltene er utfylt.';
               $this->email_no_member = 'Det finnes ikke noe medlem med det navnet.';
               $this->email_no_perm = 'Du har ikke tilgang til å sende epost via forumet.';
               $this->email_sent = 'Epostmeldingen er sendt.';
               $this->email_subject = 'Emne:';
               $this->email_to = 'Til:';
       }

       function emot_control()
       {
               $this->emote = 'smilies';
               $this->emote_add = 'Legg til smilies';
               $this->emote_added = 'Smiley er lagt til.';
               $this->emote_clickable = 'Klikkbar';
               $this->emote_edit = 'Endre smilies';
               $this->emote_image = 'Bilde';
               $this->emote_install = 'Installér smilies';
               $this->emote_install_done = 'smilies er blitt installert på nytt.';
               $this->emote_install_warning = 'Dette vil slette alle de eksisterende innstillingene for smilies og importere opplastede smilies fra ditt valgte skall inn i databasen.';
               $this->emote_no_text = 'Ingen tekst ble satt for smileyen.';
               $this->emote_text = 'Tekst';
       }

       function forum()
       {
               $this->forum_by = 'Av';
               $this->forum_can_post = 'Du kan svare i dette forumet.';
               $this->forum_can_topics = 'Du kan lese emner i dette forumet.';
               $this->forum_cant_post = 'Du kan ikke svare i dette forumet.';
               $this->forum_cant_topics = 'Du kan ikke lese emner i dette forumet.';
               $this->forum_dot = 'punktum';
               $this->forum_dot_detail = 'Viser at du har skrevet innlegg under dette emnet';
               $this->forum_forum = 'Forum';
               $this->forum_guest = 'Gjest';
               $this->forum_hot = 'Populær';
               $this->forum_icon = 'Meldingsikon';
               $this->forum_jump = 'Hoppe til nyeste innlegg i emnet';
               $this->forum_last = 'Siste innlegg';
               $this->forum_locked = 'Lest';
               $this->forum_mark_read = 'Markér forum som lest';
               $this->forum_moved = 'Flyttet';
               $this->forum_msg = '%s melding';
               $this->forum_new = 'Ny';
               $this->forum_new_poll = 'Lage ny avstemming';
               $this->forum_new_topic = 'Lage nytt emne';
               $this->forum_no_topics = 'Det finnes ingen emner å vise i dette forumet.';
               $this->forum_noexist = 'Forumet eksisterer ikke.';
               $this->forum_nopost = 'Ingen innlegg';
               $this->forum_not = 'Ikke';
               $this->forum_noview = 'Du har ikke tillatelse til å se på forumet.';
               $this->forum_pages = 'Sider';
               $this->forum_pinned = 'Markert';
               $this->forum_pinned_topic = 'Markert emne';
               $this->forum_poll = 'Avstemmning';
               $this->forum_regfirst = 'Du har ikke tilgang til å se på forum uten å registrere deg først.';
               $this->forum_replies = 'Svar';
               $this->forum_starter = 'Opprettet av';
               $this->forum_sub = 'Underforum';
               $this->forum_sub_last_post = 'Siste innlegg';
               $this->forum_sub_replies = 'Svar';
               $this->forum_sub_topics = 'Emner';
               $this->forum_subscribe = 'Motta epost når det kommer nye innlegg i dette forum.';
               $this->forum_topic = 'Emne';
               $this->forum_views = 'Visninger';
               $this->forum_write_topics = 'Du kan lage nye emner i dette forumet.';
       }

       function forums()
       {
               $this->forum_controls = 'Forumkontroller';
               $this->forum_create = 'Lag et forum';
               $this->forum_create_cat = 'Lag en kategori';
               $this->forum_created = 'Forum opprettet';
               $this->forum_default_perms = 'Standardtillatelser';
               $this->forum_delete = 'Slett forum';
               $this->forum_delete_warning = 'Er du sikker på at du vil slette dette forumet, dets emner og innlegg?<br />Denne beslutningen kan ikke gjøres om.';
               $this->forum_deleted = 'Forumet har blitt slettet.';
               $this->forum_description = 'Beskrivelse';
               $this->forum_edit = 'Endre forum';
               $this->forum_edited = 'Forumet ble endret.';
               $this->forum_empty = 'Forumtittelen er blank. Vennligst gå tilbake og skriv inn et navn.';
               $this->forum_is_subcat = 'Dette forumet er kun en underkategori.';
               $this->forum_name = 'Navn';
               $this->forum_no_orphans = 'Du kan ikke slette et forum ved å slette forumet over.';
               $this->forum_none = 'Det finnes ingen fora å jobbe med.';
               $this->forum_ordered = 'Forumrekkefølgen er oppdatert';
               $this->forum_ordering = 'Endre forumrekkefølgen';
               $this->forum_parent = 'Du kan ikke endre overforumet til et forum på den måten.';
               $this->forum_parent_cat = 'Overkategori';
               $this->forum_quickperm_select = 'Velg et eksisterende forum for å kopiere dets tillatelser.';
               $this->forum_quickperms = 'Hurtigtillatelser';
               $this->forum_recount = 'Regn om emner og svar';
               $this->forum_select_cat = 'Velg en eksisterende kategori for å lage et forum.';
               $this->forum_subcat = 'Underkategori';
       }

       function groups()
       {
               $this->groups_bad_format = 'Du må bruke %s i formatet, som representerer gruppenavnet.';
               $this->groups_based_on = 'basert på';
               $this->groups_create = 'Lag gruppe';
               $this->groups_create_new = 'Lag en ny gruppe kalt';
               $this->groups_created = 'Gruppe opprettet.';
               $this->groups_delete = 'Slett gruppe';
               $this->groups_deleted = 'Gruppe slettet.';
               $this->groups_edit = 'Endre gruppe';
               $this->groups_edited = 'Gruppe endret.';
               $this->groups_formatting = 'Vis formatering';
               $this->groups_i_confirm = 'Jeg bekrefter at jeg vil slette denne medlemsgruppen.';
               $this->groups_name = 'Navn';
               $this->groups_no_action = 'Ingen handling ble gjort.';
               $this->groups_no_delete = 'Det finnes ingen egendefinerte grupper å slette.<br />Kjernegruppene er nødvendige for at Quicksilver Forums skal fungere og kan ikke slettes.';
               $this->groups_no_group = 'Ingen gruppe spesifisert.';
               $this->groups_no_name = 'Intet gruppenavn spesifisert.';
               $this->groups_only_custom = 'Merk: Du kan kun slette egendefinerte medlemsgrupper. Kjernegruppene er nødvendige for at Quicksilver Forums skal fungere.';
               $this->groups_the = 'Gruppen';
               $this->groups_to_edit = 'Gruppe som skal endres';
               $this->groups_type = 'Type gruppe';
               $this->groups_will_be = 'vil bli slettet.';
               $this->groups_will_become = 'Brukere fra den slettede gruppen vil bli';
       }

       function help()
       {
               $this->help_add = 'Legg til hjelpeartikkel';
               $this->help_article = 'Kontroll for hjelpeartikler';
               $this->help_available_files = 'Hjelp';
               $this->help_confirm = 'Er du sikker på at du vil slette';
               $this->help_content = 'Artikkelinnhold';
               $this->help_delete = 'Slett hjelpeartikkel';
               $this->help_deleted = 'Hjelpeartikkel slettet.';
               $this->help_edit = 'Endre hjelpeartikkel';
               $this->help_edited = 'Hjelpeartikkel oppdatert.';
               $this->help_inserted = 'Artikkel satt inn i databasen.';
               $this->help_no_articles = 'Ingen hjelpeartikler ble funnet i databasen.';
               $this->help_no_title = 'Du kan ikke opprette en hjelpeartikkel uten en tittel.';
               $this->help_none = 'Det finnes ingen hjelpefiler i databasen';
               $this->help_not_exist = 'Den hjelpeartikkelen finnes ikke.';
               $this->help_select = 'Vennligst velg en artikkel å endre';
               $this->help_select_delete = 'Vennligst velg en artikkel å slette';
               $this->help_title = 'Tittel';
       }

       function home()
       {
               $this->home_choose = 'Velg en handling for å begynne.';
               $this->home_menu_title = 'Admin-kontrollpanel';
       }

       function jsdata()
       {
               $this->jsdata_address = 'Skriv inn adresse';
               $this->jsdata_detail = 'Sett inn beskrivelse';
               $this->jsdata_smiles = 'Klikkbare smilies';
               $this->jsdata_url = 'URL';
       }

       function jslang()
       {
               $this->jslang_avatar_size_height = 'Høyden på din avatar må være mellom 1 og %d piksler';
               $this->jslang_avatar_size_width = 'Bredden på din avatar må være mellom 1 og %d piksler';
       }

       function login()
       {
               $this->login_cant_logged = 'Du kunne ikke logges inn. Forsikre deg om at brukernavn og passord er riktig.<br /><br />Pass på store og små bokstaver, slik \'UsErNaMe\' ikke er det samme som \'Username\'. Informasjonskapsler (cookies) må være aktivert.';
               $this->login_cookies = 'Informasjonskapsler (cookies) må være aktivert for å kunne logge inn.';
               $this->login_forgot_pass = 'Glemt passordet?';
               $this->login_header = 'Logger inn';
               $this->login_logged = 'Du er nå innlogget.';
               $this->login_now_out = 'Du er nå avlogget.';
               $this->login_out = 'Logger ut';
               $this->login_pass = 'Passord';
               $this->login_pass_no_id = 'Det finnes ikke noe medlem med brukernavnet du skrev inn.';
               $this->login_pass_request = 'For å fullføre annulleringen av passordet, vennligst klikk på linken som har blitt sendt til epostadressen forbundet med kontoen.';
               $this->login_pass_reset = 'Annullér passord';
               $this->login_pass_sent = 'Passordet har blitt annullert. Det nye passordet har blitt sendt til epostadressen forbundet med kontoen.';
               $this->login_sure = 'Er du sikker på at du vil logge ut fra \'%s\'?';
               $this->login_user = 'Brukernavn';
       }

       function logs()
       {
               $this->logs_action = 'Handling';
               $this->logs_deleted_post = 'Slettet et innlegg';
               $this->logs_deleted_topic = 'Slettet et emne';
               $this->logs_edited_post = 'Endret et innlegg';
               $this->logs_edited_topic = 'Endret et emne';
               $this->logs_id = 'ID\'er';
               $this->logs_locked_topic = 'Låste et emne';
               $this->logs_moved_from = 'fra forum';
               $this->logs_moved_to = 'til forum';
               $this->logs_moved_topic = 'Flyttet et emne';
               $this->logs_moved_topic_num = 'Flyttet emne nr.';
               $this->logs_pinned_topic = 'Markerte et emne';
               $this->logs_post = 'Innlegg';
               $this->logs_time = 'Tid';
               $this->logs_topic = 'Emne';
               $this->logs_unlocked_topic = 'Gjenåpnet et emne';
               $this->logs_unpinned_topic = 'Fjernet markeringen på et emne';
               $this->logs_user = 'Bruker';
               $this->logs_view = 'Se på moderatorenes handlinger';
       }

       function main()
       {
               $this->main_activate = 'Ditt brukernavn er ikke aktivert ennå.';
               $this->main_activate_resend = 'Send aktivasjonsepost på nytt';
               $this->main_admincp = 'Admin-kontrollpanel';
               $this->main_banned = 'Du har blitt utelukket fra dette forumet.';
               $this->main_code = 'Kode';
               $this->main_cp = 'Kontrollpanel';
               $this->main_full = 'Full';
               $this->main_help = 'Hjelp';
               $this->main_load = 'Belastning';
               $this->main_login = 'Logg inn';
               $this->main_logout = 'Logg ut';
               $this->main_mark = 'Markér alle';
               $this->main_mark1 = 'Markér alle emner som lest';
               $this->main_markforum_read = 'Markér forum som lest';
               $this->main_max_load = 'Dessverre er %s utilgjengelig pga. for mange samtidige brukere.';
               $this->main_members = 'Medlemmer';
               $this->main_messenger = 'Meldinger';
               $this->main_new = 'Ny';
               $this->main_next = 'Neste';
               $this->main_prev = 'Forrige';
               $this->main_queries = 'Uttrekk';
               $this->main_quote = 'Sitere';
               $this->main_recent = 'Nye innlegg';
               $this->main_recent1 = 'Vis innlegg siden sist du besøkte forumet';
               $this->main_register = 'Registrere';
               $this->main_reminder = 'Påminnelse';
               $this->main_reminder_closed = 'Dette forumet er stengt og kan bare leses av administratoren.';
               $this->main_said = 'sa';
               $this->main_search = 'Søk';
               $this->main_topics_new = 'Det finnes nye innlegg i dette forumet.';
               $this->main_topics_old = 'Det finnes ingen nye innlegg i dette forumet.';
               $this->main_welcome = 'Velkommen';
               $this->main_welcome_guest = 'Velkommen!';
       }

       function mass_mail()
       {
               $this->mail = 'Masse-epost';
               $this->mail_announce = 'Beskjed fra';
               $this->mail_groups = 'Mottakergrupper';
               $this->mail_members = 'medlemmer.';
               $this->mail_message = 'Melding';
               $this->mail_select_all = 'Velg alle';
               $this->mail_send = 'Send epost';
               $this->mail_sent = 'Meldingen din har blitt sendt til';
       }

       function member_control()
       {
               $this->mc = 'Medlemskontroll';
               $this->mc_confirm = 'Er du sikker på at du vil slette';
               $this->mc_delete = 'Slett medlem';
               $this->mc_deleted = 'Medlem slettet.';
               $this->mc_edit = 'Endre medlem';
               $this->mc_edited = 'Medlem oppdatert.';
               $this->mc_email_invaid = 'Epostadressen du oppga er ugyldig.';
               $this->mc_err_updating = 'Kunne ikke oppdatere profilen';
               $this->mc_find = 'Finn medlemmer med navn som inneholder';
               $this->mc_found = 'Følgende medlemmer ble funnet. Vennligst velg et medlem.';
               $this->mc_guest_needed = 'Gjestekontoen er nødvendig for at Quicksilver Forums skal fungere.';
               $this->mc_not_found = 'Ingen medlemmer funnet som passet';
               $this->mc_user_aim = 'AIM-navn';
               $this->mc_user_avatar = 'Avatar';
               $this->mc_user_avatar_height = 'Avatar-høyde';
               $this->mc_user_avatar_type = 'Avatar-type';
               $this->mc_user_avatar_width = 'Avatar-bredde';
               $this->mc_user_birthday = 'Fødselsdag';
               $this->mc_user_email = 'Epostadresse';
               $this->mc_user_email_show = 'Epostadressen er synlig for alle';
               $this->mc_user_group = 'Gruppe';
               $this->mc_user_gtalk = 'GTalk-konto';
               $this->mc_user_homepage = 'Hjemmeside';
               $this->mc_user_icq = 'ICQ-nummer';
               $this->mc_user_id = 'Bruker-ID';
               $this->mc_user_interests = 'Interesser';
               $this->mc_user_joined = 'Medlem siden';
               $this->mc_user_language = 'Språk';
               $this->mc_user_lastpost = 'Siste innlegg';
               $this->mc_user_lastvisit = 'Siste besøk';
               $this->mc_user_level = 'Nivå';
               $this->mc_user_location = 'Sted';
               $this->mc_user_msn = 'MSN-navn';
               $this->mc_user_name = 'Navn';
               $this->mc_user_pm = 'Tillater private meldinger';
               $this->mc_user_posts = 'Innlegg';
               $this->mc_user_signature = 'Signatur';
               $this->mc_user_skin = 'Skall';
               $this->mc_user_timezone = 'Tidssone';
               $this->mc_user_title = 'Medlemstittel';
               $this->mc_user_title_custom = 'Bruk egendefinert medlemstittel';
               $this->mc_user_view_avatars = 'Kan se avatarer';
               $this->mc_user_view_emoticons = 'Kan se smilies';
               $this->mc_user_view_signatures = 'Kan se signaturer';
               $this->mc_user_yahoo = 'Yahoo!-navn';
       }

       function membercount()
       {
               $this->mcount = 'Justér medlemsstatistikken';
               $this->mcount_updated = 'Medlemsstatistikk oppdatert.';
       }

       function members()
       {
               $this->members_all = 'Alle';
               $this->members_email = 'Epost';
               $this->members_email_member = 'Send e-post til denne brukeren';
               $this->members_group = 'Gruppe';
               $this->members_joined = 'Registreringsdato';
               $this->members_list = 'Medlemsliste';
               $this->members_member = 'Medlem';
               $this->members_pm = 'PM';
               $this->members_posts = 'Innlegg';
               $this->members_send_pm = 'Send en personlig melding til denne brukeren';
               $this->members_title = 'Tittel';
               $this->members_vist_www = 'Besøk denne brukerens hjemmeside';
               $this->members_www = 'Hjemmeside';
       }

       function mod()
       {
               $this->mod_confirm_post_delete = 'Er du sikker på at du vil slette dette innlegget?';
               $this->mod_confirm_topic_delete = 'Er du sikker på at du vil slette dette emnet?';
               $this->mod_error_first_post = 'Du kan ikke slette det første innlegget i et emne.';
               $this->mod_error_move_category = 'Du kan ikke flytte et emne til en kategori.';
               $this->mod_error_move_create = 'Du har ikke lov til å flytte emner til det forumet.';
               $this->mod_error_move_forum = 'Du kan ikke flytte et emne til et forum som ikke eksisterer.';
               $this->mod_error_move_global = 'Du kan ikke flytte et globalt emne. Endre emnet før du flytter det.';
               $this->mod_error_move_same = 'Du kan ikke flytte et emne til det forum det allerede befinner seg i.';
               $this->mod_label_controls = 'Moderatorkontroller';
               $this->mod_label_description = 'Beskrivelse';
               $this->mod_label_emoticon = 'Konvertere smilies til bilder?';
               $this->mod_label_global = 'Globalt emne';
               $this->mod_label_mbcode = 'Formatere MbKode?';
               $this->mod_label_move_to = 'Flytte til';
               $this->mod_label_options = 'Alternativ';
               $this->mod_label_post_delete = 'Slette innlegg';
               $this->mod_label_post_edit = 'Redigere innlegg';
               $this->mod_label_post_icon = 'Innleggsikon';
               $this->mod_label_publish = 'Publisere';
               $this->mod_label_title = 'Tittel';
               $this->mod_label_title_original = 'Opprinnelig tittel';
               $this->mod_label_title_split = 'Del opp tittel';
               $this->mod_label_topic_delete = 'Slette emne';
               $this->mod_label_topic_edit = 'Redigere emne';
               $this->mod_label_topic_lock = 'Lese emne';
               $this->mod_label_topic_move = 'Flytte emne';
               $this->mod_label_topic_move_complete = 'Flytte hele emnet til et nytt forum';
               $this->mod_label_topic_move_link = 'Flytte hele emnet til et nytt forum og legge igjen en link dit fra det gamle forumet.';
               $this->mod_label_topic_pin = 'Markér emne';
               $this->mod_label_topic_split = 'Del opp emne';
               $this->mod_missing_post = 'Innlegget eksisterer ikke.';
               $this->mod_missing_topic = 'Emnet eksisterer ikke.';
               $this->mod_no_action = 'Du må foreta et valg.';
               $this->mod_no_post = 'Du må velge et innlegg.';
               $this->mod_no_topic = 'Du må velge et emne.';
               $this->mod_perm_post_delete = 'Du har ikke tillatelse til å slette dette innlegget.';
               $this->mod_perm_post_edit = 'Du har ikke tillatelse til å redigere dette innlegget.';
               $this->mod_perm_publish = 'Du har ikke tillatelse til å publisere dette emnet.';
               $this->mod_perm_topic_delete = 'Du har ikke tillatelse til å slette dette emnet.';
               $this->mod_perm_topic_edit = 'Du har ikke tillatelse til å redigere dette emnet.';
               $this->mod_perm_topic_lock = 'Du har ikke tillatelse til å lese dette emnet.';
               $this->mod_perm_topic_move = 'Du har ikke tillatelse til å flytte dette emnet.';
               $this->mod_perm_topic_pin = 'Du har ikke tillatelse til å markere dette emnet.';
               $this->mod_perm_topic_split = 'Du har ikke tillatelse til å dele opp dette emnet.';
               $this->mod_perm_topic_unlock = 'Du har ikke tillatelse til å låse opp dette emnet.';
               $this->mod_perm_topic_unpin = 'Du har ikke tillatelse til å fjerne markeringen av dette emnet.';
               $this->mod_success_post_delete = 'Innlegget er slettet.';
               $this->mod_success_post_edit = 'Innlegget er redigert.';
               $this->mod_success_publish = 'Emnet ble publisert.';
               $this->mod_success_split = 'Emnet ble delt opp.';
               $this->mod_success_topic_delete = 'Emnet er slettet.';
               $this->mod_success_topic_edit = 'Emnet er redigert.';
               $this->mod_success_topic_move = 'Emnet er flyttet til til et nytt forum.';
               $this->mod_success_unpublish = 'Emnet er fjernet fra publikasjonslisten.';
       }

       function optimize()
       {
               $this->optimize = 'Optimér database';
               $this->optimized = 'Tabellene i databasen har blitt optimert for maksimal utnyttelse.';
       }

       function perms()
       {
               $this->perm = 'Tillatelse';
               $this->perms = 'Tillatelser';
               $this->perms_board_view = 'Se på forumets innholdsliste';
               $this->perms_board_view_closed = 'Bruke Quicksilver Forums når det er stengt';
               $this->perms_do_anything = 'Bruke Quicksilver Forums';
               $this->perms_edit_for = 'Endre tillatelser for';
               $this->perms_email_use = 'Sende epost til medlemmer via diskusjonsgruppen';
               $this->perms_forum_view = 'Se på forumet';
               $this->perms_is_admin = 'Tilgang til admin-kontrollpanelet';
               $this->perms_only_user = 'Bruk kun gruppetillatelser på denne brukeren';
               $this->perms_override_user = 'Dette vil overkjøre gruppetillatelsene for denne brukeren.';
               $this->perms_pm_noflood = 'Unnlatt fra PM-overflodskontroll';
               $this->perms_poll_create = 'Lage avstemninger';
               $this->perms_poll_vote = 'Lage stemmer';
               $this->perms_post_attach = 'Legge ved filer til innlegg';
               $this->perms_post_attach_download = 'Laste ned innleggsvedlegg';
               $this->perms_post_create = 'Legge inn svar';
               $this->perms_post_delete = 'Slette alle typer innlegg';
               $this->perms_post_delete_own = 'Slette kun innlegg brukeren har laget';
               $this->perms_post_edit = 'Endre alle typer innlegg';
               $this->perms_post_edit_own = 'Endre kun innlegg brukeren har laget';
               $this->perms_post_inc_userposts = 'Innlegg blir lagt til brukerens totale innleggsantall';
               $this->perms_post_noflood = 'Unnlatt fra overflodskontroll for innlegg';
               $this->perms_post_viewip = 'Se på brukeres IP-adresser';
               $this->perms_search_noflood = 'Unnlatt fra overflodskontroll for søkefunksjonen';
               $this->perms_title = 'Brukergruppekontroll';
               $this->perms_topic_create = 'Lage emner';
               $this->perms_topic_delete = 'Slette alle typer emner';
               $this->perms_topic_delete_own = 'Slette kun emner brukeren har laget';
               $this->perms_topic_edit = 'Endre alle typer emner';
               $this->perms_topic_edit_own = 'Endre kun emner brukeren har laget';
               $this->perms_topic_global = 'La et emne være synlig fra alle fora';
               $this->perms_topic_lock = 'Låse alle typer emner';
               $this->perms_topic_lock_own = 'Låse kun emner brukeren har laget';
               $this->perms_topic_move = 'Flytte alle typer emner';
               $this->perms_topic_move_own = 'Flytte kun emner brukeren har laget';
               $this->perms_topic_pin = 'Markere alle typer emner';
               $this->perms_topic_pin_own = 'Markere kun emner brukeren har laget';
               $this->perms_topic_publish = 'Publisere eller avpublisere alle typer emner';
               $this->perms_topic_publish_auto = 'Nye emner blir satt som publisert';
               $this->perms_topic_split = 'Dele opp alle typer emner i flere emner';
               $this->perms_topic_split_own = 'Dele opp kun emner brukeren har laget i flere emner';
               $this->perms_topic_unlock = 'Låse opp alle typer emner';
               $this->perms_topic_unlock_mod = 'Låse opp en moderators lås';
               $this->perms_topic_unlock_own = 'Låse opp kun emner brukeren har laget';
               $this->perms_topic_unpin = 'Avmarkere alle typer emner';
               $this->perms_topic_unpin_own = 'Avmarkere kun emner brukeren har laget';
               $this->perms_topic_view = 'Se på emner';
               $this->perms_topic_view_unpublished = 'Lese upubliserte emner';
               $this->perms_updated = 'Tillatelser har blitt oppdatert.';
               $this->perms_user_inherit = 'Brukeren vil arve gruppens tillatelser.';
       }

       function php_info()
       {
               $this->php_error = 'Feil';
               $this->php_error_msg = 'phpinfo() kan ikke kjøres. Det ser ut til at verten din har slått av denne muligheten.';
       }

       function pm()
       {
               $this->pm_avatar = 'Avatar';
               $this->pm_cant_del = 'Du har ikke tillatelse til å slette denne meldingen.';
               $this->pm_delallmsg = 'Slett alle meldinger';
               $this->pm_delete = 'Slette';
               $this->pm_delete_selected = 'Slett valgte meldinger';
               $this->pm_deleted = 'Meldingen er slettet.';
               $this->pm_deleted_all = 'Meldingene er slettet.';
               $this->pm_error = 'Meldingen kunne ikke sendes til enkelte av mottakerne.<br /><br />Følgende medlemmer finnes ikke: %s<br /><br />Følgende medlemmer tillater ikke personlige meldinger: %s';
               $this->pm_fields = 'Meldingen kunne ikke sendes. Forsikre deg om at alle felt er utfylt.';
               $this->pm_flood = 'Du har sendt en melding i løpet av de siste %s sekundene, og får ikke lov til å sende en ny ennå.<br /><br />Vennligst prøv igjen om noen sekunder.';
               $this->pm_folder_inbox = 'Innboks';
               $this->pm_folder_new = '%s nye';
               $this->pm_folder_sentbox = 'Sendt';
               $this->pm_from = 'Fra';
               $this->pm_group = 'Gruppe';
               $this->pm_guest = 'Som gjest kan du ikke benytte meldinger. Logg inn eller registrér deg.';
               $this->pm_joined = 'Innmeldt';
               $this->pm_messenger = 'Meldinger';
               $this->pm_msgtext = 'Meldingstekst';
               $this->pm_multiple = 'Separér forskjellige mottakere med ;';
               $this->pm_no_folder = 'Du må velge en mappe.';
               $this->pm_no_member = 'Ingen bruker ble funnet med denne ID.';
               $this->pm_no_number = 'Ingen melding ble funnet med det det nummeret.';
               $this->pm_no_title = 'Emne mangler';
               $this->pm_nomsg = 'Det finnes ingen meldinger i denne mappen.';
               $this->pm_noview = 'Du har ikke tillatelse til å lese denne meldingen.';
               $this->pm_offline = 'Dette medlemmet er offline';
               $this->pm_online = 'Dette medlemmet er online';
               $this->pm_personal = 'Meldinger';
               $this->pm_personal_msging = 'Personlig melding';
               $this->pm_pm = 'PM';
               $this->pm_posts = 'Innlegg';
               $this->pm_preview = 'Forhåndsvisning';
               $this->pm_recipients = 'Mottakere';
               $this->pm_reply = 'Svar';
               $this->pm_send = 'Send';
               $this->pm_sendamsg = 'Send en melding';
               $this->pm_sendingpm = 'Send en personlig melding';
               $this->pm_sendon = 'Sending pågår';
               $this->pm_success = 'Meldingen er sendt.';
               $this->pm_sure_del = 'Er du sikker på at du vil slette denne meldingen?';
               $this->pm_sure_delall = 'Er du sikker på at du vil slette alle meldinger i denne mappen?';
               $this->pm_title = 'Tittel';
               $this->pm_to = 'Til';
       }

       function post()
       {
               $this->post_attach = 'Vedlegg';
               $this->post_attach_add = 'Legg ved filer';
               $this->post_attach_disrupt = 'Legge til eller fjerne filer vil ikke påvirke innlegget ditt.';
               $this->post_attach_failed = 'Opplasting av vedlegget gikk galt. Filen du spesifiserte finnes muligens ikke.';
               $this->post_attach_not_allowed = 'Du kan ikke legge ved filer av den typen.';
               $this->post_attach_remove = 'Ta bort vedlagte fil';
               $this->post_attach_too_large = 'Den vedlagte filen er for stor. Maksimal størrelse er %d kilobyte.';
               $this->post_cant_create = 'Som gjest har du ikke tillatelse til å legge inn nytt emne. Hvis du registrerer deg kan du ha mulighet til å gjøre dette.';
               $this->post_cant_create1 = 'Du har ikke tillatelse til å legge inn nytt emne.';
               $this->post_cant_enter = 'Din stemme ble ikke registrert. Enten har du allerede stemt eller så har du ikke tilgang til å stemme.';
               $this->post_cant_poll = 'Som gjest har du ikke tillatelse til å lage avstenminger. Hvis du registrerer deg kan du ha mulighet til å gjøre dette.';
               $this->post_cant_poll1 = 'Du har ikke tillatelse til å lage avstemninger.';
               $this->post_cant_reply = 'Du har ikke tillatelse til å svare på emner i dette forumet.';
               $this->post_cant_reply1 = 'Som gjest har du ikke tillatelse til å svare på emner. Hvis du registrerer deg kan du ha mulighet til å gjøre dette.';
               $this->post_cant_reply2 = 'Du har ikke tillatelse til å svare på emnet.';
               $this->post_closed = 'Dette emnet er stengt.';
               $this->post_create_poll = 'Lage avstemning';
               $this->post_create_topic = 'Lage emne';
               $this->post_creating = 'Lager emne';
               $this->post_creating_poll = 'Lager avstemning';
               $this->post_flood = 'Du har lagt inn et innlegg de siste %s sekundene, og kan ikke legge inn et nytt innlegg ennå.<br /><br />Prøv igjen om noen sekunder.';
               $this->post_guest = 'Gjest';
               $this->post_icon = 'Innleggsikon';
               $this->post_last_five = 'siste fem innlegg i omvendt rekkefølge';
               $this->post_length = 'Kontrollere lengden';
               $this->post_msg = 'Melding';
               $this->post_must_msg = 'Du må skrive en melding i innlegget.';
               $this->post_must_options = 'Du må inkludere alternativ når du lager en avstemning.';
               $this->post_must_title = 'Du må skrive en tittel når du skal lage et nytt emne.';
               $this->post_new_poll = 'Ny avstemning';
               $this->post_new_topic = 'Nytt emne';
               $this->post_no_forum = 'Forumet finnes ikke.';
               $this->post_no_topic = 'Intet emne er valgt.';
               $this->post_no_vote = 'Du må velge et alternativ når du skal stemme.';
               $this->post_option_emoticons = 'Konvertere smilies til bilder?';
               $this->post_option_global = 'Gjøre dette emnet globalt?';
               $this->post_option_mbcode = 'Formatere MbKod?';
               $this->post_optional = 'Valgfri';
               $this->post_options = 'Alternativ';
               $this->post_poll_options = 'Avstemningsvalg';
               $this->post_poll_row = 'Én pr. linje';
               $this->post_posted = 'Skrevet';
               $this->post_posting = 'Skriver innlegg';
               $this->post_preview = 'Forhåndsvisning';
               $this->post_reply = 'Svare';
               $this->post_reply_topic = 'Svare på emne';
               $this->post_replying = 'Svarer på emne';
               $this->post_replying1 = 'Svarer';
               $this->post_too_many_options = 'Du må ha mellom 2 og %d alternativ i en avstemning.';
               $this->post_topic_detail = 'Emnebeskrivelse';
               $this->post_topic_title = 'Emnetittel';
               $this->post_view_topic = 'Vise alle innlegg';
               $this->post_voting = 'Stemmer';
       }

       function printer()
       {
               $this->printer_back = 'Tilbake';
               $this->printer_not_found = 'Emnet finnes ikke. Det kan ha blitt slettet, flyttet eller det har aldri eksistert.';
               $this->printer_not_found_title = 'Emnet finnes ikke';
               $this->printer_perm_topics = 'Du har ikke tillatelse til å se på emner.';
               $this->printer_perm_topics_guest = 'Du har ikke tillatelse til å se emner. Hvis du registrerer deg kan du ha mulighet til å gjøre dette.';
               $this->printer_posted_on = 'Skrevet';
               $this->printer_send = 'Skriv ut';
       }

       function profile()
       {
               $this->profile_aim_sn = 'AIM-navn';
               $this->profile_av_sign = 'Avatar og signatur';
               $this->profile_avatar = 'Avatar';
               $this->profile_bday = 'Fødselsdag';
               $this->profile_contact = 'Kontakt';
               $this->profile_email_address = 'Epostadresse';
               $this->profile_fav = 'Favorittforum';
               $this->profile_fav_forum = '%s (%d%% av dette medlemmets innlegg)';
               $this->profile_gtalk = 'GTalk-konto';
               $this->profile_icq_uin = 'ICQ-nummer';
               $this->profile_info = 'Informasjon';
               $this->profile_interest = 'Interesser';
               $this->profile_joined = 'Medlem siden';
               $this->profile_last_post = 'Siste innlegg';
               $this->profile_list = 'Medlemsliste';
               $this->profile_location = 'Plassering';
               $this->profile_member = 'Medlemsgruppe';
               $this->profile_member_title = 'Medlemstittel';
               $this->profile_msn = 'MSN-navn';
               $this->profile_must_user = 'Du må skrive inn et brukernavn for å se på en profil.';
               $this->profile_no_member = 'Det finnes ingen brukere med denne bruker-ID. Kontoen kan være slettet.';
               $this->profile_none = '[ Ingen ]';
               $this->profile_not_post = 'har ikke skrevet noen innlegg ennå.';
               $this->profile_offline = 'Dette medlemmet er offline';
               $this->profile_online = 'Dette medlemmet er online';
               $this->profile_pm = 'Send en personlig melding til denne brukeren';
               $this->profile_postcount = '%s totalt, %s pr. dag';
               $this->profile_posts = 'Innlegg';
               $this->profile_private = '[ Privat ]';
               $this->profile_profile = 'Profil';
               $this->profile_signature = 'Signatur';
               $this->profile_unkown = '[ Ukjent ]';
               $this->profile_view_profile = 'Viser profil';
               $this->profile_www = 'Hjemmeside';
               $this->profile_yahoo = 'Yahoo!-navn';
       }

       function prune()
       {
               $this->prune_action = 'Oppryddingsvalg';
               $this->prune_age_day = '1 dag';
               $this->prune_age_eighthours = '8 timer';
               $this->prune_age_hour = '1 time';
               $this->prune_age_month = '1 måned';
               $this->prune_age_threemonths = '3 måneder';
               $this->prune_age_week = '1 uke';
               $this->prune_age_year = '1 år';
               $this->prune_forums = 'Velg fora å rydde opp i';
               $this->prune_invalidage = 'Ugyldig alder spesifisert for opprydding';
               $this->prune_move = 'Flytt';
               $this->prune_moveto_forum = 'Forum å flytte til';
               $this->prune_nodest = 'Mål er ikke valgt';
               $this->prune_notopics = 'Ingen emner valgt for opprydding';
               $this->prune_notopics_old = 'Ingen emner er gamle nok for opprydding';
               $this->prune_novalidforum = 'Fora for opprydding er ikke valgt';
               $this->prune_select_age = 'Velg alder på emner som skal ryddes opp i';
               $this->prune_select_topics = 'Velg emner å rydde opp i eller bruk Velg alle';
               $this->prune_success = 'Emner er blitt ryddet opp i';
               $this->prune_title = 'Emneopprydder';
               $this->prune_topics_older_than = 'Rydd opp i emner eldre enn';
       }

       function query()
       {
               $this->query = 'SQL-grensesnitt';
               $this->query_fail = 'mislyktes.';
               $this->query_success = 'lyktes.';
               $this->query_your = 'Din forespørsel';
       }

       function recent()
       {
               $this->recent_active = 'Aktive emner siden siste besøk';
               $this->recent_by = 'Av';
               $this->recent_can_post = 'Du kan svare i dette forumet.';
               $this->recent_can_topics = 'Du kan lese emner i dette forumet.';
               $this->recent_cant_post = 'Du kan ikke svare i dette forumet.';
               $this->recent_cant_topics = 'Du kan ikke se på emner i dette forumet.';
               $this->recent_dot = 'punktum';
               $this->recent_dot_detail = 'Viser at du skrevet innlegg i dette emnet';
               $this->recent_forum = 'Forum';
               $this->recent_guest = 'Gjest';
               $this->recent_hot = 'Populær';
               $this->recent_icon = 'Meldingsikon';
               $this->recent_jump = 'Hoppe til nyeste innlegg i emnet';
               $this->recent_last = 'Siste innlegg';
               $this->recent_locked = 'Lest';
               $this->recent_moved = 'Flyttet';
               $this->recent_msg = '%s melding';
               $this->recent_new = 'Ny';
               $this->recent_new_poll = 'Lage ny avstemning';
               $this->recent_new_topic = 'Lage nytt emne';
               $this->recent_no_topics = 'Det finnes ingen emner å vise i dette forumet.';
               $this->recent_noexist = 'Forumet eksisterer ikke.';
               $this->recent_nopost = 'Ingen innlegg';
               $this->recent_not = 'Ikke';
               $this->recent_noview = 'Du har ikke tillatelse til å se på forum.';
               $this->recent_pages = 'Sider';
               $this->recent_pinned = 'Markert';
               $this->recent_pinned_topic = 'Markert emne';
               $this->recent_poll = 'Avstemning';
               $this->recent_regfirst = 'Du har ikke tilgang til å se på forumet uten først å ha registrert deg.';
               $this->recent_replies = 'Svar';
               $this->recent_starter = 'Opprettet av';
               $this->recent_sub = 'Underforum';
               $this->recent_sub_last_post = 'Siste innlegg';
               $this->recent_sub_replies = 'Svar';
               $this->recent_sub_topics = 'Emner';
               $this->recent_subscribe = 'Motta epost når det kommer nye innlegg i dette forumet.';
               $this->recent_topic = 'Emne';
               $this->recent_views = 'Visninger';
               $this->recent_write_topics = 'Du kan lage nye emner i dette forumet.';
       }

       function register()
       {
               $this->register_activated = 'Din brukerkonto er aktivert!';
               $this->register_activating = 'Brukerkonto-aktivering';
               $this->register_activation_error = 'Det oppstod en feil da brukerkontoen din skulle aktiveres. Kontrollér at nettleseren din har den fullstendige aktivasjonsadressen fra eposten. Om problemet vedvarer, kontakt forumets administrator for å få tilsendt en ny epost med aktivasjonslink.';
               $this->register_confirm_passwd = 'Bekreft passordet';
               $this->register_done = 'Du er registrert! Du kan nå logge inn.';
               $this->register_email = 'Epostadresse';
               $this->register_email_invalid = 'Epostadressen du skrev inn er ugyldig.';
               $this->register_email_msg = 'Dette er en automatisk epost laget av Quicksilver Forums og sendt deg';
               $this->register_email_msg2 = 'for å la deg aktivere kontoen din hos';
               $this->register_email_msg3 = 'Vennligst klikk på følgende link eller lim den inn i nettleseren din:';
               $this->register_email_used = 'Epostadressen du skrev inn er allerede i bruk.';
               $this->register_fields = 'Alle felt er ikke utfylt.';
               $this->register_flood = 'Du er allerede registrert.';
               $this->register_image = 'Vennligst skriv inn teksten på bildet.';
               $this->register_image_invalid = 'For å forsikre oss om at du er en person, må du skrive inn teksten som er vist på bildet.';
               $this->register_initiated = 'Denne forespørselen ble igangsatt fra IP:';
               $this->register_must_activate = 'Du er registrert. En epost er blitt sendt til %s med informasjon om hvordan du skal aktivere kontoen. Kontoen din vil være redusert inntil du aktiverer den.';
               $this->register_name_invalid = 'Navnet du skrev inn er for langt.';
               $this->register_name_taken = 'Det medlemsnavnet er allerede i bruk.';
               $this->register_new_user = 'Ønsket brukernavn';
               $this->register_pass_invalid = 'Passordet du skrev inn er ugyldig. Forsikre deg om at det bare inneholder gyldige tegn, som bokstaver, sifre, bindestreker, understreker og mellomrom. Passordet må også inneholde minst 5 tegn.';
               $this->register_pass_match = 'Passordene du skrev inn er ikke like.';
               $this->register_passwd = 'Passord';
               $this->register_reg = 'Registrere';
               $this->register_reging = 'Registrering';
               $this->register_requested = 'Kontoaktivering forespurt av:';
               $this->register_tos = 'Bruksvilkår';
               $this->register_tos_i_agree = 'Jeg aksepterer de ovennevnte vilkår';
               $this->register_tos_not_agree = 'Du aksepterte ikke vilkårene.';
               $this->register_tos_read = 'Vennligst les følgende bruksvilkår';
       }

       function rssfeed()
       {
               $this->rssfeed_cannot_find_forum = 'Forumet ser ikke ut til å eksistere';
               $this->rssfeed_cannot_find_topic = 'Emnet ser ikke ut til å eksistere';
               $this->rssfeed_cannot_read_forum = 'Du har ikke tilgang til dette forumet';
               $this->rssfeed_cannot_read_topic = 'Du har ikke tilgang til dette emnet';
               $this->rssfeed_error = 'Feil';
               $this->rssfeed_forum = 'Forum:';
               $this->rssfeed_posted_by = 'Skrevet av';
               $this->rssfeed_topic = 'Emne:';
       }

       function search()
       {
               $this->search_advanced = 'Avanserte alternativer';
               $this->search_avatar = 'Avatar';
               $this->search_basic = 'Enkelt søk';
               $this->search_characters = 'tegnene i et innlegg';
               $this->search_day = 'dag';
               $this->search_days = 'dager';
               $this->search_exact_name = 'eksakt navn';
               $this->search_flood = 'Du har lagt inn et søk i løpet av de siste %s sekundene, og får ikke lov til å søke igjen ennå.<br /><br />Vennligst prøv igjen om noen sekunder.';
               $this->search_for = 'Søk etter';
               $this->search_forum = 'Forum';
               $this->search_group = 'Gruppe';
               $this->search_guest = 'Gjest';
               $this->search_in = 'Søk i';
               $this->search_in_posts = 'Søk kun i innlegg';
               $this->search_ip = 'IP';
               $this->search_joined = 'Innmeldt';
               $this->search_level = 'Medlemsnivå';
               $this->search_match = 'Søk etter ord';
               $this->search_matches = 'Treff';
               $this->search_month = 'måned';
               $this->search_months = 'måneder';
               $this->search_mysqldoc = 'MySQL-dokumentasjon';
               $this->search_newer = 'nyere';
               $this->search_no_results = 'Ditt søk ga ingen resultater.';
               $this->search_no_words = 'Du må oppgi noen søkeord.<br /><br />Hvert søkeord må ha minst 3 tegn medregnet bokstaver, sifre, apostrofer og understreker.';
               $this->search_offline = 'Dette medlemmet er offline';
               $this->search_older = 'eldre';
               $this->search_online = 'Dette medlemmet er online';
               $this->search_only_display = 'Vise kun de første';
               $this->search_partial_name = 'deler av navnet';
               $this->search_post_icon = 'Innleggsikon';
               $this->search_posted_on = 'Skrevet';
               $this->search_posts = 'Innlegg';
               $this->search_posts_by = 'Kun i innlegg av';
               $this->search_regex = 'Søk med vanlige kommandoer';
               $this->search_regex_failed = 'Din kommando mislyktes. Vennligst les MySQL-dokumentasjonen for hjelp med kommandoer.';
               $this->search_relevance = 'Relevans: %d%%';
               $this->search_replies = 'Innlegg';
               $this->search_result = 'Søkeresultat';
               $this->search_search = 'Søk';
               $this->search_select_all = 'Velg alle';
               $this->search_show_posts = 'Vis innlegg med treff';
               $this->search_sound = 'Søk fonetisk';
               $this->search_starter = 'Skaper';
               $this->search_than = 'enn';
               $this->search_topic = 'Emne';
               $this->search_unreg = 'Uregistrert';
               $this->search_week = 'uke';
               $this->search_weeks = 'uker';
               $this->search_year = 'år';
       }

       function settings()
       {
               $this->settings = 'Innstillinger';
               $this->settings_active = 'Innstillinger for aktive brukere';
               $this->settings_allow = 'Tillat';
               $this->settings_antibot = 'Anti-Robot-registrering';
               $this->settings_attach_ext = 'Vedlegg - filtyper';
               $this->settings_attach_one_per = 'Én pr. linje. Ingen punktum.';
               $this->settings_avatar = 'Avatar-innstillinger';
               $this->settings_avatar_flash = 'Flash-avatarer';
               $this->settings_avatar_max_height = 'Maksimal avatarhøyde';
               $this->settings_avatar_max_width = 'Maksimal avatarbredde';
               $this->settings_avatar_upload = 'Opplastede avatarer - maks filstørrelse';
               $this->settings_basic = 'Endre innstillinger for diskusjonsgruppen';
               $this->settings_blank = 'Bruk <i>_blank</i> for nytt vindu.';
               $this->settings_board_enabled = 'Diskusjonsgruppe åpnet';
               $this->settings_board_location = 'Diskusjonsgruppen befinner seg i/på';
               $this->settings_board_name = 'Navn';
               $this->settings_board_rss = 'Innstillinger for RSS';
               $this->settings_board_rssfeed_desc = 'Beskrivelse for RSS';
               $this->settings_board_rssfeed_posts = 'Antall innlegg som listes opp via RSS';
               $this->settings_board_rssfeed_time = 'Oppdateringsperiode i minutter';
               $this->settings_board_rssfeed_title = 'Tittel for RSS';
               $this->settings_clickable = 'Klikkbare smilies pr. rad';
               $this->settings_cookie = 'Innstillinger for informasjonskapsler og overflod';
               $this->settings_cookie_path = 'Sti for informasjonskapsler';
               $this->settings_cookie_prefix = 'Prefiks for informasjonskapsler';
               $this->settings_cookie_time = 'Innloggingstid';
               $this->settings_db = 'Endre tilkoblingsinnstillinger';
               $this->settings_db_host = 'Database-vert';
               $this->settings_db_leave_blank = 'La stå åpent hvis ingenting.';
               $this->settings_db_multiple = 'For å installere flere diskusjonsgrupper på én database.';
               $this->settings_db_name = 'Databasenavn';
               $this->settings_db_password = 'Databasepassord';
               $this->settings_db_port = 'Databaseport';
               $this->settings_db_prefix = 'Prefiks for tabell';
               $this->settings_db_socket = 'Databaseutgang';
               $this->settings_db_username = 'Brukernavn for database';
               $this->settings_debug_mode = 'Analysemodus';
               $this->settings_default_lang = 'Standardspråk';
               $this->settings_default_no = 'Standardnummer';
               $this->settings_default_skin = 'Standardskall';
               $this->settings_default_yes = 'Ja er standard';
               $this->settings_disabled = 'Avslått';
               $this->settings_disabled_notice = 'Beskjed avslått';
               $this->settings_email = 'Epostinnstillinger';
               $this->settings_email_fake = 'Kun for å vise fram. Bør ikke være en ordentlig epostadresse.';
               $this->settings_email_from = 'Avsenderadresse for epost';
               $this->settings_email_place1 = 'Plassér medlemmer i gruppen';
               $this->settings_email_place2 = 'inntil de verifiserer epostadressen sin';
               $this->settings_email_place3 = 'Trenger ikke epostaktivering';
               $this->settings_email_real = 'Bør være en ordentlig epostadresse.';
               $this->settings_email_reply = 'Svaradresse for epost';
               $this->settings_email_smtp = 'SMTP-mailserver';
               $this->settings_email_valid = 'Nytt medlems epostvalidering';
               $this->settings_enabled = 'I bruk';
               $this->settings_enabled_modules = 'Moduler i bruk';
               $this->settings_foreign_link = 'Mål for fremmed link';
               $this->settings_general = 'Generelle innstillinger';
               $this->settings_group_after = 'Gruppe etter registrering';
               $this->settings_hot_topic = 'Antall innlegg som kvalifiserer til populært emne';
               $this->settings_kilobytes = 'Kilobyte';
               $this->settings_max_attach_size = 'Vedlegg - maksimal filstørrelse';
               $this->settings_members = 'Medlemsinnstillinger';
               $this->settings_modname_only = 'Kun modulnavn. Ikke inkludér .php';
               $this->settings_new = 'Ny innstilling';
               $this->settings_new_add = 'Legg til foruminnstilling';
               $this->settings_new_added = 'Nye innstillinger lagt til.';
               $this->settings_new_exists = 'Den innstillingen finnes allerede. Velg et annet navn for den.';
               $this->settings_new_name = 'Nytt innstillingsnavn';
               $this->settings_new_required = 'Det nye innstillingsnavnet er nødvendig.';
               $this->settings_new_value = 'Ny innstillingsstørrelse';
               $this->settings_no_allow = 'Ikke tillat';
               $this->settings_nodata = 'Ingen data ble sendt fra POST';
               $this->settings_one_per = 'Én pr. linje';
               $this->settings_pixels = 'Punkter';
               $this->settings_pm_flood = 'Overflodkontroll for personlig meldingsassistent';
               $this->settings_pm_min_time = 'Minimumsperiode mellom meldinger.';
               $this->settings_polls = 'Avstemninger';
               $this->settings_polls_no = 'Brukere kan ikke stemme etter å ha sett resultatet av avstemningen';
               $this->settings_polls_yes = 'Brukere kan stemme etter å ha sett resultatet av avstemningen';
               $this->settings_post_flood = 'Overflodkontroll for innlegg';
               $this->settings_post_min_time = 'Minimumsperiode mellom innlegg.';
               $this->settings_posts_topic = 'Innlegg per side under hvert emne';
               $this->settings_search_flood = 'Overflodkontroll for søk';
               $this->settings_search_min_time = 'Minimumsperiode mellom søk.';
               $this->settings_server = 'Serverinnstillinger';
               $this->settings_server_gzip = 'GZIP-komprimering';
               $this->settings_server_gzip_msg = 'Forbedrer hastighet. Slå av dersom diskusjonsgruppen virker rotete eller tom.';
               $this->settings_server_maxload = 'Maksimal serverbelastning';
               $this->settings_server_maxload_msg = 'Stenger diskusjonsgruppen under voldsomt serverpress. Skriv 0 for å stenge.';
               $this->settings_server_timezone = 'Serverens tidssone';
               $this->settings_show_avatars = 'Vis avatarer';
               $this->settings_show_email = 'Vis epostadresse';
               $this->settings_show_emotes = 'Vis smilies';
               $this->settings_show_notice = 'Vises når diskusjonsgruppen er stengt';
               $this->settings_show_pm = 'Motta personlige meldinger';
               $this->settings_show_sigs = 'Vis signaturer';
               $this->settings_spider_agent = 'Spider brukeragent';
               $this->settings_spider_agent_msg = 'Skriv inn hele eller deler av spiderens unike HTTP brukeragent.';
               $this->settings_spider_enable = 'Slå på Spider-visning';
               $this->settings_spider_enable_msg = 'Tillat navn på søkemaskin-spidere på listen over aktive brukere.';
               $this->settings_spider_name = 'Spider-navn';
               $this->settings_spider_name_msg = 'Skriv inn navnet du vil vise på listen over aktive brukere for hver av de enkelte spiderene ovenfor. Du må plassere spiderens navn på samme linje som spiderens brukeragent. For eksempel; hvis du plasserer \'googlebot\' på tredje linje under brukeragent, må du skrive inn \'Google\' på tredje linje under Spider-navn.';
               $this->settings_timezone = 'Tidssone';
               $this->settings_topics_page = 'Emner per forumside';
               $this->settings_tos = 'Bruksvilkår';
               $this->settings_updated = 'Innstillinger oppdatert.';
       }

       function stats()
       {
               $this->stats = 'Statistikksenter';
               $this->stats_post_by_month = 'Innlegg pr. måned';
               $this->stats_reg_by_month = 'Registreringer pr. måned';
       }

       function templates()
       {
               $this->add = 'Legg til HTML-maler';
               $this->add_in = 'Legg mal til i:';
               $this->all_fields_required = 'Alle felt må fylles ut for å legge til en mal';
               $this->choose_css = 'Velg CSS-mal';
               $this->choose_set = 'Velg et malsett';
               $this->choose_skin = 'Velg et skall';
               $this->confirm1 = 'Du er i ferd med å slette malen';
               $this->confirm2 = 'fra';
               $this->create_new = 'Lag et nytt skall kalt';
               $this->create_skin = 'Lag skall';
               $this->credit = 'Vennligst ikke fjern vår eneste tilknytning til forumet!';
               $this->css_edited = 'CSS-filen har blitt oppdatert.';
               $this->css_fioerr = 'Filen kunne ikke bli skrevet til; du må CHMOD filen manuelt.';
               $this->delete_template = 'Slett mal';
               $this->directory = 'Mappe';
               $this->display_name = 'Visningsnavn';
               $this->edit_css = 'Redigér CSS';
               $this->edit_skin = 'Endre skall';
               $this->edit_templates = 'Endre maler';
               $this->export_done = 'Skallet ble eksportert til hovedregisteret til Quicksilver Forums.';
               $this->export_select = 'Velg et skall å eksportere';
               $this->export_skin = 'Eksportér skall';
               $this->install_done = 'Skallet ble installert.';
               $this->install_exists1 = 'Det ser ut til at skallet';
               $this->install_exists2 = 'allerede er installert.';
               $this->install_overwrite = 'Overskriv';
               $this->install_skin = 'Installér skall';
               $this->menu_title = 'Velg en malseksjon å endre';
               $this->no_file = 'Filen ikke funnet.';
               $this->only_skin = 'Det er kun ett skall installert. Du kan ikke slette dette skallet.';
               $this->or_new = 'Eller lag et nytt malsett kalt:';
               $this->select_skin = 'Velg et skall';
               $this->select_skin_edit = 'Velg et skall å redigere';
               $this->select_skin_edit_done = 'Skallet ble redigert.';
               $this->select_template = 'Velg mal';
               $this->skin_chmod = 'Kunne ikke opprette ny mappe for skallet. Forsøk å CHMOD skallmappen til 775.';
               $this->skin_created = 'Skall opprettet.';
               $this->skin_deleted = 'Skall slettet.';
               $this->skin_dir_name = 'Du må skrive inn navn for skallet og mappen.';
               $this->skin_dup = 'En mappe med likt navn ble funnet. Skallets mappe ble endret til';
               $this->skin_name = 'Du må skrive inn et skallnavn.';
               $this->skin_none = 'Det finnes ikke noen skall å installere.';
               $this->skin_set = 'Skallsett';
               $this->skins_found = 'Følgende skall ble funnet i Quicksilver Forums register';
               $this->template_about = 'Om variabler';
               $this->template_about2 = 'Variabler er deler av tekst som blir byttet ut med dynamisk data. Variabler begynner alltid med et dollartegn og er av og til satt mellom {klammer}.';
               $this->template_add = 'Legg til';
               $this->template_added = 'Mal lagt til.';
               $this->template_clear = 'Visk ut';
               $this->template_confirm = 'Du har forandret malen. Vil du lagre endringene?';
               $this->template_description = 'Beskrivelse av malen';
               $this->template_html = 'Malens HTML';
               $this->template_name = 'Malens navn';
               $this->template_position = 'Malens posisjon';
               $this->template_set = 'Malsett';
               $this->template_title = 'Maltittel';
               $this->template_universal = 'Universalvariabel';
               $this->template_universal2 = 'Noen variabler kan brukes i en hvilken som helst mal, mens andre kun kan brukes i en enkel mal. Egenskapene til objektet $this kan bli brukt overalt.';
               $this->template_updated = 'Mal oppdatert.';
               $this->templates = 'Maler';
               $this->temps_active = 'Detaljer om aktive brukere';
               $this->temps_admin = '<b>Admin-kontrollpanel universalt</b>';
               $this->temps_ban = 'Admin-kontrollpanel: Blokkeringer';
               $this->temps_board_index = 'Gruppeinnhold';
               $this->temps_censoring = 'Admin-kontrollpanel: Sensur av ord';
               $this->temps_cp = 'Medlemskontroller';
               $this->temps_email = 'Send epost til medlem';
               $this->temps_emot_control = 'Admin-kontrollpanel: Smilies';
               $this->temps_forum = 'Fora';
               $this->temps_forums = 'Admin-kontrollpanel: Fora';
               $this->temps_groups = 'Admin-kontrollpanel: Grupper';
               $this->temps_help = 'Hjelp';
               $this->temps_login = 'Inn-/Utlogging';
               $this->temps_logs = 'Admin-kontrollpanel: Moderatorlogger';
               $this->temps_main = '<b>Diskusjonsgruppe universalt</b>';
               $this->temps_mass_mail = 'Admin-kontrollpanel: Masseutsendelse';
               $this->temps_member_control = 'Admin-kontrollpanel: Medlemskontroll';
               $this->temps_members = 'Medlemsliste';
               $this->temps_mod = 'Moderatorkontroll';
               $this->temps_pm = 'Personlig meldingsassistent';
               $this->temps_polls = 'Avstemninger';
               $this->temps_post = 'Innlegg';
               $this->temps_printer = 'Skrivervennlige emner';
               $this->temps_profile = 'Ser på profil';
               $this->temps_recent = 'Nye emner';
               $this->temps_register = 'Registrering';
               $this->temps_rssfeed = 'RSS';
               $this->temps_search = 'Søker';
               $this->temps_settings = 'Admin-kontrollpanel: Innstillinger';
               $this->temps_templates = 'Admin-kontrollpanel: Redigeringsverktøy for maler';
               $this->temps_titles = 'Admin-kontrollpanel: Medlemstitler';
               $this->temps_topic_prune = 'Admin-kontrollpanel: Emneopprydding';
               $this->temps_topics = 'Emner';
               $this->upgrade_skin = 'Oppgradér skall';
               $this->upgrade_skin_already = 'var allerede oppgradert. Har ingenting å gjøre.';
               $this->upgrade_skin_detail = 'Skall som blir oppgradert på denne måten behøver fremdeles malredigering etterpå.<br />Velg et skall å oppgradere';
               $this->upgrade_skin_upgraded = 'skall har blitt oppgradert.';
               $this->upgraded_templates = 'Følgende maler ble lagt til eller oppgradert';
       }

       function titles()
       {
               $this->titles_add = 'Legg til medlemstitler';
               $this->titles_added = 'Medlemstittel lagt til.';
               $this->titles_control = 'Kontroll for medlemstitler';
               $this->titles_edit = 'Endre medlemstitler';
               $this->titles_error = 'Ingen titteltekst eller minimumsinnlegg ble gitt';
               $this->titles_image = 'Bilde';
               $this->titles_minpost = 'Minimumsinnlegg';
               $this->titles_nodel_default = 'Fjerning av opprinnelig tittel er ikke mulig da det vil ødelegge forumet; vennligst redigér den i stedet.';
               $this->titles_title = 'Tittel';
       }

       function topic()
       {
               $this->topic_attached = 'Vedlagt fil:';
               $this->topic_attached_downloads = 'nedlastninger';
               $this->topic_attached_filename = 'Filnavn:';
               $this->topic_attached_image = 'Vedlagt bilde:';
               $this->topic_attached_perm = 'Du har ikke tilgang til å laste ned denne filen.';
               $this->topic_attached_size = 'Størrelse:';
               $this->topic_attached_title = 'Vedlagt fil';
               $this->topic_avatar = 'Avatar';
               $this->topic_bottom = 'Gå til slutten av siden';
               $this->topic_create_poll = 'Lage ny avstemning';
               $this->topic_create_topic = 'Lage nytt emne';
               $this->topic_delete = 'Slette';
               $this->topic_delete_post = 'Slette dette innlegget';
               $this->topic_edit = 'Redigere';
               $this->topic_edit_post = 'Redigere dette innlegget';
               $this->topic_edited = 'Sist redigert den %s av %s';
               $this->topic_error = 'Feil';
               $this->topic_group = 'Gruppe';
               $this->topic_guest = 'Gjest';
               $this->topic_ip = 'IP';
               $this->topic_joined = 'Innmeldt';
               $this->topic_level = 'Medlemsnivå';
               $this->topic_links_aim = 'Send en AIM-melding til %s';
               $this->topic_links_email = 'Send en epost til %s';
               $this->topic_links_gtalk = 'Send en GTalk-melding til %s';
               $this->topic_links_icq = 'Send en ICQ-melding til %s';
               $this->topic_links_msn = 'Vise %s sin MSN-profil';
               $this->topic_links_pm = 'Send en personlig melding til %s';
               $this->topic_links_web = 'Besøk %s sin hjemmeside';
               $this->topic_links_yahoo = 'Send en melding til %s med Yahoo! Messenger';
               $this->topic_lock = 'Les';
               $this->topic_locked = 'Emnet er låst';
               $this->topic_move = 'Flytte';
               $this->topic_new_post = 'Innlegget er ulest';
               $this->topic_newer = 'Nyere emne';
               $this->topic_no_newer = 'Det finnes ikke noe nyere emne.';
               $this->topic_no_older = 'Det finnes ikke noe eldre emne.';
               $this->topic_no_votes = 'Det finnes ingen stemmer i denne avstemningen.';
               $this->topic_not_found = 'Emnet finnes ikke';
               $this->topic_not_found_message = 'Emnet finnes ikke. Det kan ha blitt slettet, flyttet eller så har det aldri eksistert.';
               $this->topic_offline = 'Dette medlemmet er offline';
               $this->topic_older = 'Eldre emne';
               $this->topic_online = 'Dette medlemmet er online';
               $this->topic_options = 'Alternativ for emne';
               $this->topic_pages = 'Sider';
               $this->topic_perm_view = 'Du har ikke tillatelse til å lese emner.';
               $this->topic_perm_view_guest = 'Du har ikke tillatelse til å lese emner før du har registrert deg.';
               $this->topic_pin = 'Markér';
               $this->topic_posted = 'Lagt inn';
               $this->topic_posts = 'Innlegg';
               $this->topic_print = 'Vise i utskriftsvennlig format';
               $this->topic_publish = 'Publisér';
               $this->topic_qr_emoticons = 'Smilies';
               $this->topic_qr_open_emoticons = 'Åpne klikkbare smilies';
               $this->topic_qr_open_mbcode = 'Åpne MBCode';
               $this->topic_quickreply = 'Hurtigsvar';
               $this->topic_quote = 'Sitér dette innlegget i et svar';
               $this->topic_reply = 'Svare på emne';
               $this->topic_split = 'Del opp';
               $this->topic_split_finish = 'Avslutt all oppdeling';
               $this->topic_split_keep = 'Ikke flytt dette innlegget';
               $this->topic_split_move = 'Flytt dette innlegget';
               $this->topic_subscribe = 'Motta e-post når det kommer nye innlegg i dette emnet.';
               $this->topic_top = 'Gå til toppen av siden';
               $this->topic_unlock = 'Lås opp';
               $this->topic_unpin = 'Fjerne markering';
               $this->topic_unpublish = 'Avpublisér';
               $this->topic_unpublished = 'Dette emnet er klassifisert som upublisert, så derfor har du ikke lov til å lese det.';
               $this->topic_unreg = 'Uregistrert';
               $this->topic_view = 'Vise resultat';
               $this->topic_viewing = 'Viser emne';
               $this->topic_vote = 'Stem';
               $this->topic_vote_count_plur = '%d stemmer';
               $this->topic_vote_count_sing = '%d stemme';
               $this->topic_votes = 'Stemmer';
       }

       function universal()
       {
               $this->aim = 'AIM';
               $this->based_on = 'basert på';
               $this->board_by = 'Av';
               $this->charset = 'utf-8';
               $this->continue = 'Fortsett';
               $this->date_long = 'j. F Y';
               $this->date_short = 'j/n/y';
               $this->delete = 'Slett';
               $this->direction = 'vth';
               $this->edit = 'Endre';
               $this->email = 'Epost';
               $this->gtalk = 'GTalk';
               $this->icq = 'ICQ';
               $this->msn = 'MSN';
               $this->new_message = 'Ny melding';
               $this->new_poll = 'Ny avstemning';
               $this->new_topic = 'Nytt emne';
               $this->no = 'Nei';
               $this->powered = 'Basert på';
               $this->private_message = 'PM';
               $this->quote = 'Sitat';
               $this->recount_forums = 'Rekalkulert fora! Totalt antall emner: %d. Totalt antall innlegg: %d.';
               $this->reply = 'Svar';
               $this->seconds = 'Sekunder';
               $this->select_all = 'Velg alle';
               $this->sep_decimals = ',';
               $this->sep_thousands = ' ';
               $this->spoiler = 'Spoiler';
               $this->submit = 'Send';
               $this->subscribe = 'Abonnér';
               $this->time_long = ', G:i';
               $this->time_only = 'G:i';
               $this->today = 'I dag';
               $this->website = 'WWW';
               $this->yahoo = 'Yahoo!';
               $this->yes = 'Ja';
               $this->yesterday = 'I går';
       }
}
?>
