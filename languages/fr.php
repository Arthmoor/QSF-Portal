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
 * French language module
 *
 * @author Stephane Revel <st_garp98@hotmail.com>
 * @since 1.0.0 Beta 4.0
 **/
class fr
{
	function active()
	{
		$this->active_last_action = 'Dernière action';
		$this->active_modules_active = 'Consulte les utilisateurs(-trices) actifs(-ives)';
		$this->active_modules_board = 'L\'accueil';
		$this->active_modules_cp = 'Panneau de contrôle';
		$this->active_modules_forum = 'Consulte un forum: %s';
		$this->active_modules_help = 'Utilise l\'aide';
		$this->active_modules_login = 'Se connecter / se déconnecter';
		$this->active_modules_members = 'Consulter la liste des membres';
		$this->active_modules_mod = 'Modère';
		$this->active_modules_pm = 'Utilise la messagerie';
		$this->active_modules_post = 'Poste un message';
		$this->active_modules_printer = 'Imprime un sujet: %s';
		$this->active_modules_profile = 'Consulte un profil: %s';
		$this->active_modules_recent = 'Lire les messages récents';
		$this->active_modules_search = 'Cherche';
		$this->active_modules_topic = 'Consulte un sujet: %s';
		$this->active_time = 'Date';
		$this->active_user = 'Utilisateur(-trice)';
		$this->active_users = 'Utilisateurs(-trices) actifs(-ives)';
	}

	function admin()
	{
		$this->admin_add_emoticons = 'Ajouter des émotions';
		$this->admin_add_member_titles = 'Ajouter les titres automatiques de membre';
		$this->admin_add_templates = 'Ajouter les gabarits de HTML';
		$this->admin_ban_ips = 'Protocole d\'Internet d\'interdiction adresse';
		$this->admin_censor = 'Censurer des mots';
		$this->admin_cp_denied = 'Accès interdit';
		$this->admin_cp_warning = 'L\'Admin CP est désactivé jusqu\'a l\'effacement du répertoire <b>install</b> car son existence pose un risque de securité';
		$this->admin_create_forum = 'Créer un forum';
		$this->admin_create_group = 'Créer un group';
		$this->admin_create_help = 'Créer un article d\'aide';
		$this->admin_create_skin = 'Créer une peau';
		$this->admin_db = 'Base de données';
		$this->admin_db_backup = 'Sauvegarder la base de données';
		$this->admin_db_conn = 'Editer les cadres de connexion';
		$this->admin_db_optimize = 'Optimiser la base de données';
		$this->admin_db_query = 'Executer une requete SQL';
		$this->admin_db_restore = 'Restaurer une sauvegarde';
		$this->admin_delete_forum = 'Effacer un forum';
		$this->admin_delete_group = 'Effacer un groupe';
		$this->admin_delete_help = 'Effacer un article d\'aide';
		$this->admin_delete_member = 'Effacer un membre';
		$this->admin_delete_template = 'Effacer le gabarit HTML';
		$this->admin_edit_emoticons = 'Editer ou effacer des émotions';
		$this->admin_edit_forum = 'Editer un forum';
		$this->admin_edit_group_name = 'Editer un nom du groupe';
		$this->admin_edit_group_perms = 'Editer une permissions du groupe';
		$this->admin_edit_help = 'Editer un article d\'aide';
		$this->admin_edit_member = 'Editer un membre';
		$this->admin_edit_member_perms = 'Editer une permissions du membre';
		$this->admin_edit_member_titles = 'Editer ou effacer les titres automatiques de membre';
		$this->admin_edit_settings = 'Editer les cadres de conseil';
		$this->admin_edit_skin = 'Editer ou effacer une peau';
		$this->admin_edit_templates = 'Editer les gabarits de HTML';
		$this->admin_emoticons = 'Emotions';
		$this->admin_export_skin = 'Exporter une peau';
		$this->admin_fix_stats = 'Réparer la statistique de membre';
		$this->admin_forum_order = 'Changer le forum commande';
		$this->admin_forums = 'Forums et Catégories';
		$this->admin_groups = 'Groupes';
		$this->admin_heading = 'Panneau de contrôle administratif de Quicksilver Forums';
		$this->admin_help = 'Aider des Articles';
		$this->admin_install_emoticons = 'Installer des émotions';
		$this->admin_install_skin = 'Installer une peau';
		$this->admin_logs = 'Regarder les actions de modérateur';
		$this->admin_mass_mail = 'Envoyer un e-mail à vos membres';
		$this->admin_members = 'Membres';
		$this->admin_phpinfo = 'Regarder l\'information de PHP';
		$this->admin_prune = 'Elaguer de vieux sujets';
		$this->admin_recount_forums = 'Les sujets de deuxième compte des suffrages et répond';
		$this->admin_settings = 'Cadres';
		$this->admin_settings_add = 'Add new board setting'; //Translate
		$this->admin_skins = 'Peaux';
		$this->admin_stats = 'Centre de statistique';
		$this->admin_upgrade_skin = 'Améliorer une Peau';
		$this->admin_your_board = 'Votre Forums';
	}

	function backup()
	{
		$this->backup_create = 'Sauvegarder la base de données';
		$this->backup_createfile = 'Backup and create a file on server'; //Translate
		$this->backup_done = 'La base de données a été reculée à l\'annuaire Quicksilver Forums principal. ';
		$this->backup_download = 'Backup and download (recommended)'; //Translate
		$this->backup_found = 'Les sauvegardes suivantes ont été trouvées dans l\'annuaire de Quicksilver Forums';
		$this->backup_invalid = 'La sauvegarde n\'a pas l\'air d\'être valide. Aucune modification n\'a été faite à votre base de données.';
		$this->backup_none = 'Aucune sauvegarde n\'a été trouvée dans l\'annuaire de Quicksilver Forums.';
		$this->backup_options = 'Select how you want your backup created'; //Translate
		$this->backup_restore = 'Restaurer la sauvegarde';
		$this->backup_restore_done = 'La base de données a été restaurée avec succès.';
		$this->backup_warning = 'Avertissement : Ceci superposera toutes données existantes utilisées par les Quicksilver Forums.';
	}

	function ban()
	{
		$this->ban = 'interdiction';
		$this->ban_banned_ips = 'Adresses IP interdits';
		$this->ban_banned_members = 'Membres interdits';
		$this->ban_ip = 'Adresse IP d\'interdiction';
		$this->ban_member_explain1 = 'Pour interdire des utilisateurs(-trices), changer leur groupe d\'utilisateur à';
		$this->ban_member_explain2 = 'Dans le membre contrôle.';
		$this->ban_members = 'Interdire des membres';
		$this->ban_nomembers = 'Il n\'y a actuellement aucun membre interdit.';
		$this->ban_one_per_line = 'Une adresse par la ligne.';
		$this->ban_regex_allowed = 'Les expressions régulières sont permises. Vous pouvez utiliser un seul * comme une carte sauvage pour un ou plus de chiffres.';
		$this->ban_settings = 'Interdire des cadres';
		$this->ban_users_banned = 'Les utilisateurs(-trices) interdit(e)s.';
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
		$this->board_active_users = 'Utilisateurs(-trices) actifs(-ives)';
		$this->board_birthdays = 'Anniversaires du jour :';
		$this->board_bottom_page = 'Aller au fond de la page';
		$this->board_can_post = 'Vous pouvez répondre dans ce forum.';
		$this->board_can_topics = 'Vous pouvez voir les messages de ce forum.';
		$this->board_cant_post = 'Vous ne pouvez pas répondre dans ce forum.';
		$this->board_cant_topics = 'Vous ne pouvez pas voir les messages de ce forum.';
		$this->board_forum = 'Forum'; //Translate
		$this->board_guests = 'invités';
		$this->board_last_post = 'Dernier message';
		$this->board_mark = 'Marquer tous les messages comme lus';
		$this->board_mark1 = 'Tous les forums et messages ont été marqués comme lus.';
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = 'membres';
		$this->board_message = 'Message de %s';
		$this->board_most_online = 'La plupart des utilisateurs(-trices) n\'ont jamais étaient en ligne %d sur %s.';
		$this->board_nobday = 'Aucun membre ne fête son anniversaire aujourd\'hui.';
		$this->board_nobody = 'Actuellement aucun membre n\'est en ligne.';
		$this->board_nopost = 'Aucun message.';
		$this->board_noview = 'Vous n\'avez pas la permission de voir les forums';
		$this->board_regfirst = 'Vous n\'avez pas la permission de voir les forums. Si vous vous enregistrez, vous le pourrez.';
		$this->board_replies = 'Réponses';
		$this->board_stats = 'Statistiques';
		$this->board_stats_string = '%s Les utilisateurs ont été enregistré. Bienvenue à notre plus nouveau membre, %s.<br />Il y a %s les sujets de s et %s les réponses de s pour un total de %s les postes. ';
		$this->board_top_page = 'Aller au sommet de la page';
		$this->board_topics = 'Sujets';
		$this->board_users = 'utilisateurs(-trices)';
		$this->board_write_topics = 'Vous pouvez créer un fil de discussions dans ce forum.';
	}

	function censoring()
	{
		$this->censor = 'Censurer des mots';
		$this->censor_one_per_line = 'Un par ligne.';
		$this->censor_regex_allowed = 'Les expressions régulières sont permises. Vous pouvez utiliser un seul * comme un carte sauvage pour un ou plus de caractères.';
		$this->censor_updated = 'La liste des mots a été mise à jour.';
	}

	function cp()
	{
		$this->cp_aim = 'Pseudo AIM';
		$this->cp_already_member = 'Le mél que vous avez entré est déjà attribué à un membre.';
		$this->cp_apr = 'Avril';
		$this->cp_aug = 'Août';
		$this->cp_avatar_current = 'Votre avatar actuel';
		$this->cp_avatar_error = 'Erreur d\'avatar';
		$this->cp_avatar_must_select = 'Vous devez choisir un avatar.';
		$this->cp_avatar_none = 'N\'utilisez pas d\'avatar.';
		$this->cp_avatar_pixels = 'pixels'; //Translate
		$this->cp_avatar_select = 'Choisissez un avatar';
		$this->cp_avatar_size_height = 'La hauteur de l\'avatar doit être comprise entre 1 et ';
		$this->cp_avatar_size_width = 'La largeur de l\'avatar doit être comprise entre 1 et ';
		$this->cp_avatar_upload = 'Télécharger un avatar depuis votre disque dur';
		$this->cp_avatar_upload_failed = 'Erreur de téléchargement de votre avatar. Le fichier n\'existe peut-être pas.';
		$this->cp_avatar_upload_not_image = 'Vous ne pouvez envoyer des images que pour votre avatar.';
		$this->cp_avatar_upload_too_large = 'L\'avatar que vous avez choisi est trop gros. La taille maxiale est %d Ko.';
		$this->cp_avatar_url = 'Indiquez le chemin de votre avatar';
		$this->cp_avatar_use = 'Utilisez l\'avatar que vous avez téléchargé';
		$this->cp_bday = 'Anniversaire';
		$this->cp_been_updated = 'Votre profil a été mis à jour.';
		$this->cp_been_updated1 = 'Votre avatar a été mis à jour. ';
		$this->cp_been_updated_prefs = 'Vos préférences ont été mises à jour. ';
		$this->cp_changing_pass = 'Changer son mot de passe';
		$this->cp_contact_pm = 'Permettre aux autres de vous contacter par le Messenger?';
		$this->cp_cp = 'Profil';
		$this->cp_current_avatar = 'Avatar actuel';
		$this->cp_current_time = 'Il est actuellement %s.';
		$this->cp_custom_title = 'Titre de membre personalisé';
		$this->cp_custom_title2 = 'Ceci est un privilège réservé aux administrateurs';
		$this->cp_dec = 'Décembre';
		$this->cp_editing_avatar = 'Mettre à jour son avatar';
		$this->cp_editing_profile = 'Mettre à jour son profil';
		$this->cp_email = 'Mél';
		$this->cp_email_form = 'Permettre aux autres membres de vous contacter par email?';
		$this->cp_email_invaid = 'Le mél entré n\'est pas valide.';
		$this->cp_err_avatar = 'Erreur en mettant à jour l\'avatar';
		$this->cp_err_updating = 'Erreur en mettant à jour le profil';
		$this->cp_feb = 'Février';
		$this->cp_file_type = 'L\'avatar que vous avez entré n\'est pas valide. Vérifiez que l\'URL est correcte, et que le fichier choisi est au format gif, jpg ou png.';
		$this->cp_format = 'Format du nom';
		$this->cp_gtalk = 'Compte GTalk';
		$this->cp_header = 'Profil';
		$this->cp_height = 'Hauteur';
		$this->cp_icq = 'N° ICQ';
		$this->cp_interest = 'Intérêts';
		$this->cp_jan = 'Janvier';
		$this->cp_july = 'Juillet';
		$this->cp_june = 'Juin';
		$this->cp_label_edit_avatar = 'Editer son avatar';
		$this->cp_label_edit_pass = 'Changer son mot de passe';
		$this->cp_label_edit_prefs = 'Changer ses préférences du forum';
		$this->cp_label_edit_profile = 'Editer son profil';
		$this->cp_label_edit_sig = 'Editer sa signature';
		$this->cp_label_edit_subs = 'Editer ses souscriptions';
		$this->cp_language = 'Langue';
		$this->cp_less_charac = 'Votre nom doit comporter moins de 32 caractères.';
		$this->cp_location = 'Localisation';
		$this->cp_login_first = 'Vous devez être connecté pour accéder à votre profil';
		$this->cp_mar = 'Mars';
		$this->cp_may = 'Mai';
		$this->cp_msn = 'Pseudo MSN';
		$this->cp_must_orig = 'Votre nom doit être identique à celui que vous avez choisi. Vous ne pouvez changer que la casse et l\'espacement.';
		$this->cp_new_notmatch = 'Les deux nouveaux mots de passe que vous avez saisis sont différents.';
		$this->cp_new_pass = 'Nouveau mot de passe';
		$this->cp_no_flash = 'Les avatars au format Flash ne sont pas autorisés sur ce forum.';
		$this->cp_not_exist = 'La date que vous avez spécifiée (%s) n\'existe pas!';
		$this->cp_nov = 'Novembre';
		$this->cp_oct = 'Octobre';
		$this->cp_old_notmatch = 'L\'ancien mot de passe que vous avez saisi est incorrect.';
		$this->cp_old_pass = 'Ancien mot de passe';
		$this->cp_pass_notvaid = 'Votre mot de passe est invalide. Assurez vous que vous ne utilisez que des caractères permis.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = 'Changer ses préférences';
		$this->cp_preview_sig = 'Aperçu de la signature:';
		$this->cp_privacy = 'Options de la vie privée';
		$this->cp_repeat_pass = 'Confirmation du nouveau mot de passe';
		$this->cp_sept = 'Septembre';
		$this->cp_show_active = 'Montrer votre activité pendant l\'utilisation du forum? ';
		$this->cp_show_email = 'Montrer le mél dans le profil?';
		$this->cp_signature = 'Signature'; //Translate
		$this->cp_size_max = 'La taille de l\'avatar que vous avez choisie est trop importante. La taille maximale permise est de %s par %s pixels. ';
		$this->cp_skin = 'Thème du forum';
		$this->cp_sub_change = 'Changer les Abonnements';
		$this->cp_sub_delete = 'Supprimer';
		$this->cp_sub_expire = 'Date d\'expiration';
		$this->cp_sub_name = 'Nom de souscription';
		$this->cp_sub_no_params = 'Aucun paramètre n\'a été donné.';
		$this->cp_sub_success = 'Vous avez souscrit à %s.';
		$this->cp_sub_type = 'Type de souscription';
		$this->cp_sub_updated = 'Les abonnements sélectionnés ont été supprimés.';
		$this->cp_topic_option = 'Options du sujet';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = 'Profil mis à jour';
		$this->cp_updated1 = 'Avatar mis à jour';
		$this->cp_updated_prefs = 'Préférences mises à jour';
		$this->cp_user_exists = 'Un utilisateur avec le même format de nom existe déjà.';
		$this->cp_valided = 'Votre mot de passe a été changé.';
		$this->cp_view_avatar = 'Voir les avatars?';
		$this->cp_view_emoticon = 'Voir les smileys?';
		$this->cp_view_signature = 'Voir les signatures?';
		$this->cp_welcome = 'Bienvenue dans le panneau de contrôle de l\'utilisateur. D\'ici, vous pouvez configurer votre compte. Merci de choisir parmi les options ci-dessous.';
		$this->cp_width = 'Largeur';
		$this->cp_www = 'Page d\'accueil';
		$this->cp_yahoo = 'Pseudo Yahoo';
		$this->cp_zone = 'Fuseau horaire';
	}

	function email()
	{
		$this->email_blocked = 'Ce membre n\'accepte pas de mél envoyé depuis ce formulaire. ';
		$this->email_email = 'Courriel';
		$this->email_msgtext = 'Corps du message :';
		$this->email_no_fields = 'Revenez en arrière et vérifiez que tous les champs ont été remplis.';
		$this->email_no_member = 'Aucun membre ne porte ce nom';
		$this->email_no_perm = 'Vous n\'avez pas la permission d\'envoyer des méls par le forum. ';
		$this->email_sent = 'Votre mél a été envoyé.';
		$this->email_subject = 'Sujet :';
		$this->email_to = 'A :';
	}

	function emot_control()
	{
		$this->emote = 'Emotions';
		$this->emote_add = 'Ajouter des Emotions';
		$this->emote_added = 'Emotion a ajouté. ';
		$this->emote_clickable = 'Cliquable';
		$this->emote_edit = 'Editer les Emotions';
		$this->emote_image = 'Image'; //Translate
		$this->emote_install = 'Installer les émotions';
		$this->emote_install_done = 'Les émotions ont été réinstallées avec succès.';
		$this->emote_install_warning = 'Ceci effacera tous cadres d\'emoticon existants et l\'importation a téléchargé emoticons de votre peau actuellement choisie dans la base de données. ';
		$this->emote_no_text = 'Aucun texte d\'émotion n\'a été donné.';
		$this->emote_text = 'Texte';
	}

	function forum()
	{
		$this->forum_by = 'Par';
		$this->forum_can_post = 'Vous pouvez répondre dans ce forum.';
		$this->forum_can_topics = 'Vous pouvez voir les sujets dans ce forum. ';
		$this->forum_cant_post = 'Vous ne pouvez pas répondre dans ce forum. ';
		$this->forum_cant_topics = 'Vous ne pouvez pas voir les sujets dans ce forum. ';
		$this->forum_dot = 'point';
		$this->forum_dot_detail = 'Affiche ce que vous avez posté dans le sujet';
		$this->forum_forum = 'Forum'; //Translate
		$this->forum_guest = 'Invité';
		$this->forum_hot = 'Chaud';
		$this->forum_icon = 'Icone';
		$this->forum_jump = 'Aller au dernier message de ce sujet';
		$this->forum_last = 'Dernier message';
		$this->forum_locked = 'Verrouillé';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = 'Déplacé';
		$this->forum_msg = 'Message de %s';
		$this->forum_new = 'Nouveau';
		$this->forum_new_poll = 'Créer un nouveau sondage';
		$this->forum_new_topic = 'Créer un nouveau sujet';
		$this->forum_no_topics = 'Il n\'y a aucun sujet dans ce forum';
		$this->forum_noexist = 'Ce forum n\'existe pas.';
		$this->forum_nopost = 'Aucun message';
		$this->forum_not = 'Aïe!';
		$this->forum_noview = 'Vous n\'avez pas la permission de voir les forums.';
		$this->forum_pages = 'Pages'; //Translate
		$this->forum_pinned = 'Epinglé';
		$this->forum_pinned_topic = 'Sujet épinglé';
		$this->forum_poll = 'Sondage';
		$this->forum_regfirst = 'Vous n\'avez pas la permission de voir les forums. Si vous vous enregistrez, vous pourriez le faire.';
		$this->forum_replies = 'Réponses';
		$this->forum_starter = 'Débuté par';
		$this->forum_sub = 'Sous-Forum';
		$this->forum_sub_last_post = 'Dernier message';
		$this->forum_sub_replies = 'Réponses';
		$this->forum_sub_topics = 'Sujets';
		$this->forum_subscribe = 'M\envoyer un email en cas de nouveaux posts dans ce forum. ';
		$this->forum_topic = 'Sujet';
		$this->forum_views = 'Affichages';
		$this->forum_write_topics = 'Vous pouvez créer des sujets dans ce forum. ';
	}

	function forums()
	{
		$this->forum_controls = 'Contrôles du Forum';
		$this->forum_create = 'Créer un forum';
		$this->forum_create_cat = 'Créer une catégorie';
		$this->forum_created = 'Forum crée';
		$this->forum_default_perms = 'Permissions par défaut';
		$this->forum_delete = 'Supprimer le forum';
		$this->forum_delete_warning = 'Etes-vous sûr de vouloir supprimer ce forum, ses sujets et ses messages?<br />Cette action ne peut être défaite.';
		$this->forum_deleted = 'Ce forum a été supprimé';
		$this->forum_description = 'Description'; //Translate
		$this->forum_edit = 'Editer le forum';
		$this->forum_edited = 'Le forum a été edité avec succès.';
		$this->forum_empty = 'Le nom du forum est absent. Veuillez le remplir s\'il vous plaît.';
		$this->forum_is_subcat = 'Ce forum est une sous-catégorie seulement.';
		$this->forum_name = 'Nom';
		$this->forum_no_orphans = 'Un forum ne peut être rendu orphelin en supprimant son parent.';
		$this->forum_none = 'Il n\'y a aucun forum à manipuler.';
		$this->forum_ordered = 'Ordre du forum mis à jour';
		$this->forum_ordering = 'Changer l\'ordre du forum';
		$this->forum_parent = 'Vous ne pouvez modifier le parent d\'un forum ainsi.';
		$this->forum_parent_cat = 'Catégorie d\'un parent';
		$this->forum_quickperm_select = 'Sélectionner un forum existant pour copier ses permissions.';
		$this->forum_quickperms = 'Permissions rapides';
		$this->forum_recount = 'Recompter les sujets et les reponses';
		$this->forum_select_cat = 'Sélectionner une catégorie existante pour créer un forum.';
		$this->forum_subcat = 'Sous-catégorie';
	}

	function groups()
	{
		$this->groups_bad_format = 'Vous devez utiliser %s dans le formattage, qui représente le nom du groupe.';
		$this->groups_based_on = 'basé sur';
		$this->groups_create = 'Créer un groupe';
		$this->groups_create_new = 'Creer un nouveau nom de groupe d\'utilisateur';
		$this->groups_created = 'Groupe creé';
		$this->groups_delete = 'Supprimer le groupe';
		$this->groups_deleted = 'Groupe supprimé.';
		$this->groups_edit = 'Editer le groupe';
		$this->groups_edited = 'Groupe edité.';
		$this->groups_formatting = 'Visualiser le formattage.';
		$this->groups_i_confirm = 'Je confirme vouloir supprimer ce groupe membre.';
		$this->groups_name = 'Nom';
		$this->groups_no_action = 'Aucune action effectuée.';
		$this->groups_no_delete = 'Il n\'y a aucun groupe personalisé à supprimer.<br />Les groupes centraux sont ncessaires pour que Quicksilver Forums puisse fonctionner, et ainsi ne peuvent être supprimés.';
		$this->groups_no_group = 'Aucun groupe n\'a été specifié.';
		$this->groups_no_name = 'Aucun nom de groupe n\'a été specifié.';
		$this->groups_only_custom = 'Note: You can only delete custom member groups. The core groups are necessary for Quicksilver Forums to function.'; //Translate
		$this->groups_the = 'Le groupe';
		$this->groups_to_edit = 'Groupe à edité';
		$this->groups_type = 'Type du groupe';
		$this->groups_will_be = 'sera supprimé.';
		$this->groups_will_become = 'Les utilisateurs du groupe supprimé deviendront';
	}

	function help()
	{
		$this->help_add = 'Ajouter une rubrique d\'aide';
		$this->help_article = 'Contrôle des rubriques d\'aide';
		$this->help_available_files = 'Fichiers d\'aide disponibles';
		$this->help_confirm = 'Etes-vous sûr de vouloir supprimer?';
		$this->help_content = 'Contenu de la rubrique';
		$this->help_delete = 'Effacer la rubrique d\'aide.';
		$this->help_deleted = 'Rubrique d\'aide supprimée.';
		$this->help_edit = 'Editer la rubrique d\'aide';
		$this->help_edited = 'Rubrique d\'aide mise a jour.';
		$this->help_inserted = 'Rubrique inserée dans la base de données.';
		$this->help_no_articles = 'Aucune rubrique d\'aide trouvée dans la base de données.';
		$this->help_no_title = 'Vous ne pouvez créer une rubrique d\'aide sans titre.';
		$this->help_none = 'Il n\'y a aucun fichier d\'aide.';
		$this->help_not_exist = 'Cette rubrique d\'aide n\'existe pas.';
		$this->help_select = 'Veuillez sélectionner une rubrique d\'aide à editer.';
		$this->help_select_delete = 'Veuillez sélectionner une rubrique d\'aide à supprimer.';
		$this->help_title = 'Titre';
	}

	function home()
	{
		$this->home_choose = 'Choississez une tâche pour commencer.';
		$this->home_menu_title = 'Menu de l\'Admin CP';
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
		$this->login_cant_logged = 'La connexion a échouée. Vérifiez que vos nom d\'utilisateur et mot de passe sont corrects.<br /><br />Ils sont sensibles à la casse, donc \'UtIlIsAtEuR\' est différent de \'utilisateur\'. Merci aussi de vérifier que les cookies sont activés dans votre navigateur.';
		$this->login_cookies = 'Vous devez activer les cookies pour vous connecter.';
		$this->login_forgot_pass = 'Mot de passe oublié? ';
		$this->login_header = 'Connexion';
		$this->login_logged = 'Vous êtes maintenant connecté.';
		$this->login_now_out = 'Vous êtes maintenant déconnecté.';
		$this->login_out = 'Déconnexion';
		$this->login_pass = 'Mot de passe';
		$this->login_pass_no_id = 'Aucun membre ne porte le nom d\'utilisateur entré.';
		$this->login_pass_request = 'Afin de compléter la réinitialisation du mot de passe, veuillez cliquer sur le lien envoyé à l\'adresse mél associé à votre compte.';
		$this->login_pass_reset = 'Réinitialiser le mot de passe';
		$this->login_pass_sent = 'Votre mot de passe a été réinitialisé. Le nouveau mot de passe a été envoyé à l\'email associé à votre compte. ';
		$this->login_sure = 'Etes-vous certain de vouloir vous déconnecter de \'%s\' ?';
		$this->login_user = 'Nom d\'utilisateur';
	}

	function logs()
	{
		$this->logs_action = 'Action'; //Translate
		$this->logs_deleted_post = 'Un message supprimé';
		$this->logs_deleted_topic = 'Un sujet supprimé';
		$this->logs_edited_post = 'Un message edité';
		$this->logs_edited_topic = 'Un sujet edité';
		$this->logs_id = 'Identifiants';
		$this->logs_locked_topic = 'Un sujet verrouillé';
		$this->logs_moved_from = 'du forum';
		$this->logs_moved_to = 'au forum';
		$this->logs_moved_topic = 'Un sujet deplacé';
		$this->logs_moved_topic_num = 'A deplacé le sujet #';
		$this->logs_pinned_topic = 'Un sujet epinglé';
		$this->logs_post = 'Message';
		$this->logs_time = 'Heure';
		$this->logs_topic = 'Sujet';
		$this->logs_unlocked_topic = 'Déverrouiller un sujet';
		$this->logs_unpinned_topic = 'Détacher un sujet';
		$this->logs_user = 'Utilisateur';
		$this->logs_view = 'Visualiser les actions du modérateur';
	}

	function main()
	{
		$this->main_activate = 'Votre compte n\'a pas encore été activé. ';
		$this->main_activate_resend = 'Renvoyer l\'email d\'activation';
		$this->main_admincp = 'Administration';
		$this->main_banned = 'Il vous a été interdit de consulter cette partie des forums.';
		$this->main_code = 'Code'; //Translate
		$this->main_cp = 'Profil';
		$this->main_full = 'Complet';
		$this->main_help = 'Aide';
		$this->main_load = 'chargé';
		$this->main_login = 'Connexion';
		$this->main_logout = 'Déconnexion';
		$this->main_mark = 'marquer tout';
		$this->main_mark1 = 'Marquer tous sujets comme a lu';
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = 'Nous sommes désolés, mais %s est actuellement indisponible, à cause d\'un trop grand nombre d\'utilisateurs connectés.';
		$this->main_members = 'Membres';
		$this->main_messenger = 'Messages persos';
		$this->main_new = 'nouveau';
		$this->main_next = 'suivant';
		$this->main_prev = 'précedent';
		$this->main_queries = 'requêtes';
		$this->main_quote = 'Citer';
		$this->main_recent = 'messages récents';
		$this->main_recent1 = 'Consultez les sujets récents depuis votre dernière visite';
		$this->main_register = 'S\'enregistrer';
		$this->main_reminder = 'Rappel';
		$this->main_reminder_closed = 'Les forums sont fermés et consultables uniquement par les administrateurs.';
		$this->main_said = 'a dit';
		$this->main_search = 'Trouve';
		$this->main_topics_new = 'Il y a des nouveaux messages dans ce forum.';
		$this->main_topics_old = 'Il n\'y a pas de nouveaux messages dans ce forum.';
		$this->main_welcome = 'Bienvenue';
		$this->main_welcome_guest = 'Bienvenue invité !';
	}

	function mass_mail()
	{
		$this->mail = 'Mél de Masse';
		$this->mail_announce = 'Annonce de';
		$this->mail_groups = 'Groupes receveurs';
		$this->mail_members = 'membres.';
		$this->mail_message = 'Message'; //Translate
		$this->mail_select_all = 'Tout sélectionner';
		$this->mail_send = 'Envoyer un Mél';
		$this->mail_sent = 'Votre message a été envoyé à';
	}

	function member_control()
	{
		$this->mc = 'Contrôle des membres';
		$this->mc_confirm = 'Etes-vous sûr de vouloir supprimer?';
		$this->mc_delete = 'Supprimer Membre';
		$this->mc_deleted = 'Membre Supprimé.';
		$this->mc_edit = 'Editer Membre';
		$this->mc_edited = 'Membre mis à jour';
		$this->mc_email_invaid = 'L\'adresse mél que vous avez fournie n\'est pas valide.';
		$this->mc_err_updating = 'Erreur dans la mise à jour du profil';
		$this->mc_find = 'Trouver les membres avec un nom contenant';
		$this->mc_found = 'Les membres suivants ont été trouvés. Veuillez en sélectionner un.';
		$this->mc_guest_needed = 'Le compte invité est nécessaire pour que Quicksilver Forums puisse fonctionner.';
		$this->mc_not_found = 'Aucun membre correspondant trouvé.';
		$this->mc_user_aim = 'Nom AIM';
		$this->mc_user_avatar = 'Avatar'; //Translate
		$this->mc_user_avatar_height = 'Hauteur del\'Avatar';
		$this->mc_user_avatar_type = 'Type de l\'Avatar';
		$this->mc_user_avatar_width = 'Largeur de l\'Avatar';
		$this->mc_user_birthday = 'Date de naissance';
		$this->mc_user_email = 'Addresse Mél';
		$this->mc_user_email_show = 'Le mél est publique';
		$this->mc_user_group = 'Groupe';
		$this->mc_user_gtalk = 'Compte GTalk';
		$this->mc_user_homepage = 'Page d\'acceuil';
		$this->mc_user_icq = 'Nombre ICQ';
		$this->mc_user_id = 'Identifiant';
		$this->mc_user_interests = 'Centre d\'intêrets';
		$this->mc_user_joined = 'Membre depuis';
		$this->mc_user_language = 'Langue';
		$this->mc_user_lastpost = 'Dernier message';
		$this->mc_user_lastvisit = 'Dernière Visite';
		$this->mc_user_level = 'Niveau';
		$this->mc_user_location = 'Position géographique';
		$this->mc_user_msn = 'Identité MSN';
		$this->mc_user_name = 'Nom';
		$this->mc_user_pm = 'Acceptant les messages privés';
		$this->mc_user_posts = 'Messages';
		$this->mc_user_signature = 'Signature'; //Translate
		$this->mc_user_skin = 'Peau';
		$this->mc_user_timezone = 'Fuseau horaire';
		$this->mc_user_title = 'Titre de membre';
		$this->mc_user_title_custom = 'Utiliser un titre de membre personalisé';
		$this->mc_user_view_avatars = 'Affichant les Avatars';
		$this->mc_user_view_emoticons = 'Affichant les Emotions';
		$this->mc_user_view_signatures = 'Affichant les Signatures';
		$this->mc_user_yahoo = 'Identité Yahoo';
	}

	function membercount()
	{
		$this->mcount = 'Réparer les statistiques des membres';
		$this->mcount_updated = 'Comptabilisation des membres mis à jour';
	}

	function members()
	{
		$this->members_all = 'tous';
		$this->members_email = 'Mél';
		$this->members_email_member = 'Envoyer un mél à ce membre';
		$this->members_group = 'Groupe';
		$this->members_joined = 'Rejoint';
		$this->members_list = 'Liste des membres';
		$this->members_member = 'Membre';
		$this->members_pm = 'Message Perso';
		$this->members_posts = 'Messages';
		$this->members_send_pm = 'Envoyer un message privé à ce membre';
		$this->members_title = 'Titre';
		$this->members_vist_www = 'Visiter le site web de ce membre';
		$this->members_www = 'Site Web';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Etes-vous sûr de vouloir effacer ce message?';
		$this->mod_confirm_topic_delete = 'Etes-vous sûr de vouloir effacer ce sujet?';
		$this->mod_error_first_post = 'Vous ne pouvez pas effacer le premier message dans un sujet.';
		$this->mod_error_move_category = 'Vous ne pouvez pas déplacer un sujet dans une catégorie.';
		$this->mod_error_move_create = 'Vous n\'avez pas la permission de transférer des sujets à ce forum.';
		$this->mod_error_move_forum = 'Vous ne pouvez pas déplacer un sujet vers un forum qui n\'existe pas. ';
		$this->mod_error_move_global = 'Vous ne pouvez déplacer un sujet global. Veuillez l\'editer avant de le déplacer.';
		$this->mod_error_move_same = 'Le forum vers lequel vous essayez de déplacer ce sujet est le même que celui de départ.';
		$this->mod_label_controls = 'Contrôles de modération';
		$this->mod_label_description = 'Description'; //Translate
		$this->mod_label_emoticon = 'Convertir les smileys en images?';
		$this->mod_label_global = 'Sujet général';
		$this->mod_label_mbcode = 'Formatter le MbCode?';
		$this->mod_label_move_to = 'Déplacer vers ';
		$this->mod_label_options = 'Options'; //Translate
		$this->mod_label_post_delete = 'Effacer le message';
		$this->mod_label_post_edit = 'Editer le message';
		$this->mod_label_post_icon = 'Poster l\'icône';
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = 'Titre';
		$this->mod_label_title_original = 'Titre original ';
		$this->mod_label_title_split = 'Découper le titre';
		$this->mod_label_topic_delete = 'Effacer le sujet';
		$this->mod_label_topic_edit = 'Editer le sujet';
		$this->mod_label_topic_lock = 'Verrouiller le sujet';
		$this->mod_label_topic_move = 'Déplacer le sujet';
		$this->mod_label_topic_move_complete = 'Transférer intégralement le sujet vers un nouveau forum';
		$this->mod_label_topic_move_link = 'Transférer le sujet vers le nouveau forum, et laisser un lien vers le nouvel emplacement dans l\'ancien forum. ';
		$this->mod_label_topic_pin = 'Epingler le sujet';
		$this->mod_label_topic_split = 'Découper le sujet';
		$this->mod_missing_post = 'Le message que vous avez choisi n\'existe pas. ';
		$this->mod_missing_topic = 'Le sujet que vous avez choisi n\'existe pas. ';
		$this->mod_no_action = 'Vous devez choisir une action.';
		$this->mod_no_post = 'Vous devez choisir un message.';
		$this->mod_no_topic = 'Vous devez choisir un sujet.';
		$this->mod_perm_post_delete = 'Vous n\'avez pas le droit d\'effacer ce message.';
		$this->mod_perm_post_edit = 'Vous n\'avez pas le droit d\'éditer ce message.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = 'Vous n\'avez pas le droit d\'effacer ce sujet.';
		$this->mod_perm_topic_edit = 'Vous n\'avez pas le droit d\'éditer ce sujet. ';
		$this->mod_perm_topic_lock = 'Vous n\'avez pas le droit de verrouiller ce sujet. ';
		$this->mod_perm_topic_move = 'Vous n\'avez pas le droit de déplacer ce sujet.';
		$this->mod_perm_topic_pin = 'Vous n\'avez pas le droit d\'épingler ce sujet. ';
		$this->mod_perm_topic_split = 'Vous n\'avez pas la permission de découper ce sujet. ';
		$this->mod_perm_topic_unlock = 'Vous n\'avez pas le droit de déverrouiller ce sujet.';
		$this->mod_perm_topic_unpin = 'Vous n\'avez pas le droit de \'désépingler\' ce sujet.';
		$this->mod_success_post_delete = 'Le message a été effacé.';
		$this->mod_success_post_edit = 'Message édité';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = 'Le sujet a été découpé avec succès. ';
		$this->mod_success_topic_delete = 'Sujet effacé.';
		$this->mod_success_topic_edit = 'Le sujet a été édité avec succès.';
		$this->mod_success_topic_move = 'Le sujet a été déplacé avec succès.';
		$this->mod_success_unpublish = 'This topic has been removed from the published list.'; //Translate
	}

	function optimize()
	{
		$this->optimize = 'Optimiser la base de données';
		$this->optimized = 'Les tables dans la base de données ont été optimisées pour une performance maximale.';
	}

	function perms()
	{
		$this->perm = 'Permission'; //Translate
		$this->perms = 'Permissions'; //Translate
		$this->perms_board_view = 'Visualisier l\'index du board';
		$this->perms_board_view_closed = 'Utiliser Quicksilver Forums quand celui-ci est fermé.';
		$this->perms_do_anything = 'Utiliser Quicksilver Forums';
		$this->perms_edit_for = 'Editer les permissions de';
		$this->perms_email_use = 'Envoyer des méls à des membres à travers le board';
		$this->perms_forum_view = 'Visualiser le forum';
		$this->perms_is_admin = 'Accèder au panneau de contrôle administrateur';
		$this->perms_only_user = 'N\'utiliser que les permissions de groupe pour cet(te) utilisateur(-trice)';
		$this->perms_override_user = 'Ceci remplacera les permissions de groupe de cet(te) utilisateur(-trice).';
		$this->perms_pm_noflood = 'Exemptez du contrôle flood de la messagerie perso';
		$this->perms_poll_create = 'Créer des sondages';
		$this->perms_poll_vote = 'Créer des votes';
		$this->perms_post_attach = 'Attacher les téléchargements aux messages';
		$this->perms_post_attach_download = 'Télécharger les pièces jointes des messages';
		$this->perms_post_create = 'Créer des réponses';
		$this->perms_post_delete = 'Supprimer n\'importe quel message';
		$this->perms_post_delete_own = 'Ne supprimer que les messages crées par l\'utilisateur(-trice)';
		$this->perms_post_edit = 'Editer n\'importe quel message';
		$this->perms_post_edit_own = 'N\'editer que les messages crées par l\'utilisateur(-trice)';
		$this->perms_post_inc_userposts = 'Les messages contribuent au nombre total de messages attribués à un(e) utilisateur(-trice)';
		$this->perms_post_noflood = 'Exemptez du contrôle flood des messages';
		$this->perms_post_viewip = 'Visualiser les adresses IP de l\'utilisateur(-trice)';
		$this->perms_search_noflood = 'Exemptez du contrôle flood des recherches';
		$this->perms_title = 'Contrôle de groupe des utilisateurs';
		$this->perms_topic_create = 'Créer des sujets';
		$this->perms_topic_delete = 'Supprimer n\'importe quel sujet';
		$this->perms_topic_delete_own = 'Ne supprimer que les sujets crées par l\'utilisateur(-trice)';
		$this->perms_topic_edit = 'Editer n\'importe quel sujet';
		$this->perms_topic_edit_own = 'N\'editer que les sujets crées par l\'utilisateur(-trice).';
		$this->perms_topic_global = 'Rendre un sujet visible depuis tous les forums';
		$this->perms_topic_lock = 'Verrouiller n\'importe quel sujet';
		$this->perms_topic_lock_own = 'Verrouiller les sujets crées par l\'utilisateur(-trice).';
		$this->perms_topic_move = 'Déplacer n\'importe quel sujet';
		$this->perms_topic_move_own = 'Ne déplacer que les sujets crées par l\'utilisateur(-trice).';
		$this->perms_topic_pin = 'Epingler n\'importe quel sujet';
		$this->perms_topic_pin_own = 'Epingler les sujets crées par l\'utilisateur(-trice)';
		$this->perms_topic_publish = 'Publish or unpublish any topic'; //Translate
		$this->perms_topic_publish_auto = 'New topics are marked as published'; //Translate
		$this->perms_topic_split = 'Diviser n\'importe quel sujet en plusieurs sujets.';
		$this->perms_topic_split_own = 'Ne diviser en plusieurs sujets que les sujets crées par l\'utilisateur(-trice).';
		$this->perms_topic_unlock = 'Déverrouiller n\'importe quel sujet';
		$this->perms_topic_unlock_mod = 'Déverouiller le verrouillage d\'un(e) modérateur(-trice)';
		$this->perms_topic_unlock_own = 'Ne déverrouiller que les sujets crées par l\'utilisateur(-trice)';
		$this->perms_topic_unpin = 'Détacher n\'importe quel sujet';
		$this->perms_topic_unpin_own = 'Détacher que les sujets crées par l\'utilisateur(-trice)';
		$this->perms_topic_view = 'Visualiser les sujets';
		$this->perms_topic_view_unpublished = 'View unpublished topics'; //Translate
		$this->perms_updated = 'Les permissions ont été mis à jour.';
		$this->perms_user_inherit = 'L\'utilisateur(-trice) héritera les permissions de groupe.';
	}

	function php_info()
	{
		$this->php_error = 'Erreur';
		$this->php_error_msg = 'phpinfo() ne peut être executé. Il semblerait que votre hôte l\'a désactivé.';
	}

	function pm()
	{
		$this->pm_avatar = 'Avatar'; //Translate
		$this->pm_cant_del = 'Vous n\'avez pas la permission de supprimer ce message.';
		$this->pm_delallmsg = 'Supprimer tous les messages';
		$this->pm_delete = 'Supprimer';
		$this->pm_delete_selected = 'Effacer les messages sélectionnés';
		$this->pm_deleted = 'Message supprimé.';
		$this->pm_deleted_all = 'Messages supprimés.';
		$this->pm_error = 'Il y avait des problèmes pour envoyer votre message à certains receveurs.<br /><br />Les membres suivants n\'existent pas: %s<br /><br />Les membres suivants refusent les messages privés: %s';
		$this->pm_fields = 'Votre message n\'a pas pu être envoyé. Vérifiez que tous les champs requis sont remplis.';
		$this->pm_flood = 'Vous avez envoyé un message dans les dernieres %s secondes, et ne pouvez en renvoyer tout de suite.<br /><br />Veuillez réessayer dans quelques secondes.';
		$this->pm_folder_inbox = 'Boîte de réception';
		$this->pm_folder_new = '%s nouveaux';
		$this->pm_folder_sentbox = 'Sent';
		$this->pm_from = 'De';
		$this->pm_group = 'Groupe';
		$this->pm_guest = 'En tant qu\'invité, vous ne pouvez pas utiliser la messagerie privée. Merci de vous connecter ou de vous enregistrer.';
		$this->pm_joined = 'Rejoint';
		$this->pm_messenger = 'Messages persos';
		$this->pm_msgtext = 'Texte du message';
		$this->pm_multiple = 'Veuillez séparer les receveurs avec ;';
		$this->pm_no_folder = 'Vous devez choisir un dossier.';
		$this->pm_no_member = 'Aucun membre n\'a été trouvé avec l\'id spécifié.';
		$this->pm_no_number = 'Ce message n\'existe pas.';
		$this->pm_no_title = 'Pas de sujet';
		$this->pm_nomsg = 'Il n\'y a aucun message dans ce dossier.';
		$this->pm_noview = 'Vous n\'avez pas la permission de voir ce message.';
		$this->pm_offline = 'Ce membre est actuellement déconnecté';
		$this->pm_online = 'Ce membre est actuellement connecté';
		$this->pm_personal = 'Messages privés';
		$this->pm_personal_msging = 'Messagerie privée';
		$this->pm_pm = 'Messages privés';
		$this->pm_posts = 'Messages';
		$this->pm_preview = 'Aperçu';
		$this->pm_recipients = 'Receveurs';
		$this->pm_reply = 'Répondre';
		$this->pm_send = 'Envoyer';
		$this->pm_sendamsg = 'Envoyer un message';
		$this->pm_sendingpm = 'Vous envoyez un message privé';
		$this->pm_sendon = 'Envoyé';
		$this->pm_success = 'Votre messgae a été envoyé correctement.';
		$this->pm_sure_del = 'Etes vous certain de vouloir supprimer ce message ?';
		$this->pm_sure_delall = 'Etes vous certain de vouloir supprimer tous les messages de ce dossier?';
		$this->pm_title = 'Titre';
		$this->pm_to = 'A';
	}

	function post()
	{
		$this->post_attach = 'Fichiers attachés';
		$this->post_attach_add = 'Attacher un fichier';
		$this->post_attach_disrupt = 'Ajouter ou enlever des fichiers attachés ne modifie pas le message en cours d\'édition.';
		$this->post_attach_failed = 'Le téléchargement de la pièce jointe a échoué. Vérifiez que le fichier spécifié existe. ';
		$this->post_attach_not_allowed = 'Des fichiers de ce type ne peuvent pas être attachés.';
		$this->post_attach_remove = 'Enlever le fichier attaché';
		$this->post_attach_too_large = 'La taille du fichier choisi est trop importante. La taille maximum est %d KB.';
		$this->post_cant_create = 'En tant qu\'invité vous n\'avez pas la permission de créer des sujets. Si vous vous enregistrez, vous le pourrez.';
		$this->post_cant_create1 = 'Vous n\'avez pas la permission de créer des sujets.';
		$this->post_cant_enter = 'Votre vote n\'a pas été pris en compte. Peut être avez vous déjà voté ou n\'en avez pas la permission.';
		$this->post_cant_poll = 'En tant qu\'invité, vous n\'avez pas la permission de créer des sondages. Si vous vous enregistrez, vous le pourrez.';
		$this->post_cant_poll1 = 'Vous n\'avez pas le droit de créer des sondages.';
		$this->post_cant_reply = 'Vous n\'avez pas le droit de participer aux sujets dans ce forum';
		$this->post_cant_reply1 = 'En tant qu\'invité, vous n\'avez pas la permission de participer aux sujets. Si vous vous enregistrez, vous le pourrez.';
		$this->post_cant_reply2 = 'Vous n\'avez pas la permission de participer aux sujets.';
		$this->post_closed = 'Ce sujet a été fermé.';
		$this->post_create_poll = 'Créer un sondage';
		$this->post_create_topic = 'Créer un sujet';
		$this->post_creating = 'Créer un sujet';
		$this->post_creating_poll = 'Vous créez un sondage';
		$this->post_flood = 'Vous avez déjà posté un message dans les %s dernières secondes, et ne pouvez plus en poster maintenant.<br /><br />Merci de réessayer dans quelques secondes.';
		$this->post_guest = 'Invité';
		$this->post_icon = 'Icône';
		$this->post_last_five = '5 derniers messages en ordre inverse';
		$this->post_length = 'Vérifier la longueur';
		$this->post_msg = 'Message'; //Translate
		$this->post_must_msg = 'Vous devez saisir un message avant de poster.';
		$this->post_must_options = 'Vous devez saisir des choix avant de poster un sondage.';
		$this->post_must_title = 'Vous devez saisir un titre avant de poster.';
		$this->post_new_poll = 'Nouveau sondage';
		$this->post_new_topic = 'Nouveau sujet';
		$this->post_no_forum = 'Ce forum n\'existe pas';
		$this->post_no_topic = 'Aucun sujet n\'a été spécifié.';
		$this->post_no_vote = 'Vous devez voter parmi les choix proposés.';
		$this->post_option_emoticons = 'Convertir les smileys en images ?';
		$this->post_option_global = 'Faire de ce sujet un sujet général?';
		$this->post_option_mbcode = 'Formater le MbCode?';
		$this->post_optional = 'facultatif';
		$this->post_options = 'Options'; //Translate
		$this->post_poll_options = 'Réponses';
		$this->post_poll_row = 'Une par ligne';
		$this->post_posted = 'Posté le';
		$this->post_posting = 'Vous postez';
		$this->post_preview = 'Aperçu';
		$this->post_reply = 'Répondre';
		$this->post_reply_topic = 'Répondre au sujet';
		$this->post_replying = 'Participe au sujet';
		$this->post_replying1 = 'Répond';
		$this->post_too_many_options = 'Le sondage doit comprendre entre 2 et %d propositions. ';
		$this->post_topic_detail = 'Description du sujet';
		$this->post_topic_title = 'Titre du sujet';
		$this->post_view_topic = 'Voir le sujet en entier';
		$this->post_voting = 'Vous votez';
	}

	function printer()
	{
		$this->printer_back = 'Retour';
		$this->printer_not_found = 'Ce sujet n\'existe pas. Il peut avoir été supprimé, déplacé ou n\'avoir jamais existé.';
		$this->printer_not_found_title = 'Ce sujet n\'existe pas';
		$this->printer_perm_topics = 'Vous n\'avez pas la permission de voir les sujets.';
		$this->printer_perm_topics_guest = 'Vous n\'avez pas la permission de voir les sujets. Si vous vous enregisterez, vous le pourrez.';
		$this->printer_posted_on = 'Posté le';
		$this->printer_send = 'Envoyer à l\'auteur';
	}

	function profile()
	{
		$this->profile_aim_sn = 'AIM';
		$this->profile_av_sign = 'Avatar et signature';
		$this->profile_avatar = 'Avatar'; //Translate
		$this->profile_bday = 'Anniversaire';
		$this->profile_contact = 'Contact'; //Translate
		$this->profile_email_address = 'Adresse email';
		$this->profile_fav = 'Forum préféré';
		$this->profile_fav_forum = '%s (%d%% des posts de ce membre)';
		$this->profile_gtalk = 'Compte GTalk';
		$this->profile_icq_uin = 'ICQ';
		$this->profile_info = 'Information'; //Translate
		$this->profile_interest = 'Intérêts';
		$this->profile_joined = 'S\'est inscrit';
		$this->profile_last_post = 'Dernier message';
		$this->profile_list = 'Liste des membres';
		$this->profile_location = 'Localisation';
		$this->profile_member = 'Groupe';
		$this->profile_member_title = 'Titre';
		$this->profile_msn = 'MSN';
		$this->profile_must_user = 'Vous devez entrer un(e) utilisateur(-trice) pour consulter un profil.';
		$this->profile_no_member = 'Cet(te) utilisateur(-trice) n\'existe pas. Le compte a certainement été supprimé.';
		$this->profile_none = '[ Aucun ]';
		$this->profile_not_post = 'pas encore posté.';
		$this->profile_offline = 'Ce membre est actuellement déconnecté';
		$this->profile_online = 'Ce membre est actuellement connecté';
		$this->profile_pm = 'Messages privés';
		$this->profile_postcount = '%s au total, %s par jour';
		$this->profile_posts = 'Messages';
		$this->profile_private = '[ Privé ]';
		$this->profile_profile = 'Profil';
		$this->profile_signature = 'Signature'; //Translate
		$this->profile_unkown = '[ Inconnu ]';
		$this->profile_view_profile = 'Consultation d\'un profil';
		$this->profile_www = 'Page Perso';
		$this->profile_yahoo = 'Yahoo!';
	}

	function prune()
	{
		$this->prune_action = 'Action de taillage à entreprendre';
		$this->prune_age_day = '1 Jour';
		$this->prune_age_eighthours = '8 Heures';
		$this->prune_age_hour = '1 Heure';
		$this->prune_age_month = '1 Mois';
		$this->prune_age_threemonths = '3 Mois';
		$this->prune_age_week = '1 Semaine';
		$this->prune_age_year = '1 an';
		$this->prune_forums = 'Sélectionner les forums à tailler';
		$this->prune_invalidage = 'Age specifié invalable pour tailler';
		$this->prune_move = 'Déplacer';
		$this->prune_moveto_forum = 'Forum auquel déplacer';
		$this->prune_nodest = 'Aucune destination valable sélectionnée';
		$this->prune_notopics = 'Aucun sujet sélectionné pour être taillé';
		$this->prune_notopics_old = 'Aucun sujet n\'est assez vieux pour être taillé';
		$this->prune_novalidforum = 'Aucun forum valable specifié pour être taillé';
		$this->prune_select_age = 'Sélectionner l\'âge des sujets auquel se limiter pour le taillage';
		$this->prune_select_topics = 'Sélectionner les sujets à tailler ou utiliser Tout Sélectionner';
		$this->prune_success = 'Les sujets ont été taillés';
		$this->prune_title = 'Tailleur de sujet';
		$this->prune_topics_older_than = 'Tailler les sujets plus anciens que';
	}

	function query()
	{
		$this->query = 'L\'interface des requêtes';
		$this->query_fail = 'a echoué';
		$this->query_success = 'a executé avec succès.';
		$this->query_your = 'Votre requête';
	}

	function recent()
	{
		$this->recent_active = 'Sujets actifs depuis votre dernière visite';
		$this->recent_by = 'Par';
		$this->recent_can_post = 'Vous pouvez répondre dans ce forum.';
		$this->recent_can_topics = 'Vous pouvez voir les sujets dans ce forum. ';
		$this->recent_cant_post = 'Vous ne pouvez pas répondre dans ce forum. ';
		$this->recent_cant_topics = 'Vous ne pouvez pas voir les sujets dans ce forum. ';
		$this->recent_dot = 'point';
		$this->recent_dot_detail = 'Affiche ce que vous avez posté dans le sujet';
		$this->recent_forum = 'Forum'; //Translate
		$this->recent_guest = 'Invité';
		$this->recent_hot = 'Chaud';
		$this->recent_icon = 'Icone';
		$this->recent_jump = 'Aller au dernier message de ce sujet';
		$this->recent_last = 'Dernier message';
		$this->recent_locked = 'Verrouillé';
		$this->recent_moved = 'Déplacé';
		$this->recent_msg = 'Message de %s';
		$this->recent_new = 'Nouveau';
		$this->recent_new_poll = 'Créer un nouveau sondage';
		$this->recent_new_topic = 'Créer un nouveau sujet';
		$this->recent_no_topics = 'Il n\'y a aucun sujet dans ce forum';
		$this->recent_noexist = 'Ce forum n\'existe pas.';
		$this->recent_nopost = 'Aucun message';
		$this->recent_not = 'Aïe!';
		$this->recent_noview = 'Vous n\'avez pas la permission de voir les forums.';
		$this->recent_pages = 'Pages'; //Translate
		$this->recent_pinned = 'Epinglé';
		$this->recent_pinned_topic = 'Sujet épinglé';
		$this->recent_poll = 'Sondage';
		$this->recent_regfirst = 'Vous n\'avez pas la permission de voir les forums. Si vous vous enregistrez, vous pourrez le faire.';
		$this->recent_replies = 'Réponses';
		$this->recent_starter = 'Débuté par';
		$this->recent_sub = 'Sous-Forum';
		$this->recent_sub_last_post = 'Dernier message';
		$this->recent_sub_replies = 'Réponses';
		$this->recent_sub_topics = 'Sujets';
		$this->recent_subscribe = 'M\envoyer un email en cas de nouveaux posts dans ce forum. ';
		$this->recent_topic = 'Sujet';
		$this->recent_views = 'Affichages';
		$this->recent_write_topics = 'Vous pouvez créer des sujets dans ce forum. ';
	}

	function register()
	{
		$this->register_activated = 'Votre compte a été activé!';
		$this->register_activating = 'Activation du compte';
		$this->register_activation_error = 'Il y a eu une erreur durant l\'activation su compte. Vérifiez si la barre d\'adresse de votre navigateur contient l\'URL figurant dans l\'email d\'activation. Si le problème persiste, contactez l\'administrateur du forum.';
		$this->register_confirm_passwd = 'Confirmation du mot de passe';
		$this->register_done = 'Vous avez été correctement enregistré ! Vous pouvez maintenant vous connecter.';
		$this->register_email = 'Adresse email';
		$this->register_email_invalid = 'Cette adresse email est incorrecte.';
		$this->register_email_msg = 'Ceci est un mél généré automatiquement par Quicksilver Forums, et envoyé à vous pour';
		$this->register_email_msg2 = 'que vous puissiez activer votre compte avec';
		$this->register_email_msg3 = 'Veuillez cliquer sur le lien suivant, ou le coller dans votre browser web:';
		$this->register_email_used = 'Cette adresse email est déjà prise par un autre membre.';
		$this->register_fields = 'Certains champs n\'ont pas été remplis.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = 'Veuillez taper le texte visible dans l\'image';
		$this->register_image_invalid = 'Pour vérifier que vous êtes un abonneur humain, vous devez taper le texte visible dans l\'image.';
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'Vous avez été inscrit. Un mél a été envoyé à %s contenant les instructions pour activer votre compte. Votre compte sera limité jusqu\'à ce que vous le validez.';
		$this->register_name_invalid = 'Le nom d\'utilisateur est incorrect.';
		$this->register_name_taken = 'Le nom d\'utilisateur est déjà pris.';
		$this->register_new_user = 'Nom d\'utilisateur souhaité';
		$this->register_pass_invalid = 'Le mot de passe entré est incorrect. Assurez vous que vous utilisez des caractères autorisés.';
		$this->register_pass_match = 'Les deux mots de passe entrés sont différents.';
		$this->register_passwd = 'Mot de passe';
		$this->register_reg = 'Envoyer';
		$this->register_reging = 'Enregistrement';
		$this->register_requested = 'Account activation request for:'; //Translate
		$this->register_tos = 'Conditions de service';
		$this->register_tos_i_agree = 'J\'approuve les conditions ci-dessus';
		$this->register_tos_not_agree = 'Vous n\'avez pas approuvé les conditions.';
		$this->register_tos_read = 'Veuillez lire les conditions de service suivantes';
	}

	function rssfeed()
	{
		$this->rssfeed_cannot_find_forum = 'Le forum semble ne pas exister';
		$this->rssfeed_cannot_find_topic = 'Le sujet semble ne pas exister';
		$this->rssfeed_cannot_read_forum = 'Vous n\'avez pas la permission pour lire ce forum';
		$this->rssfeed_cannot_read_topic = 'Vous n\'avez pas la permission pour lire ce sujet';
		$this->rssfeed_error = 'Erreur';
		$this->rssfeed_forum = 'Forum:'; //Translate
		$this->rssfeed_posted_by = 'Poster par';
		$this->rssfeed_topic = 'Sujet:';
	}

	function search()
	{
		$this->search_advanced = 'Options avancées';
		$this->search_avatar = 'Avatar'; //Translate
		$this->search_basic = 'Trove classique';
		$this->search_characters = 'caractères d\'un message';
		$this->search_day = 'jour';
		$this->search_days = 'jours';
		$this->search_exact_name = 'nom exact';
		$this->search_flood = 'Vous avez fait une recherche dans les dernieres %s secondes, et ne pouvez en refaire tout de suite.<br /><br />Veuillez réessayer dans quelques secondes.';
		$this->search_for = 'Trouve les termes';
		$this->search_forum = 'Forum'; //Translate
		$this->search_group = 'Groupe';
		$this->search_guest = 'Invité';
		$this->search_in = 'Trouve dans';
		$this->search_in_posts = 'Chercher seulement dans les mesages';
		$this->search_ip = 'IP'; //Translate
		$this->search_joined = 'Rejoint';
		$this->search_level = 'Niveau du membre';
		$this->search_match = 'Trouve par correspondence';
		$this->search_matches = 'Correspondances';
		$this->search_month = 'mois';
		$this->search_months = 'mois';
		$this->search_mysqldoc = 'Documentation de MySQL';
		$this->search_newer = 'plus récent';
		$this->search_no_results = 'Votre recherche n\'a retourné aucun résultat.';
		$this->search_no_words = 'Vous devez spécifier des phrases à rechercher.<br /><br />Chaque phrase doit contenir plus que 3 charactères, y compris les lettres, les chiffres, les apostrophes, et les tirets de bas.';
		$this->search_offline = 'Ce membre est actuellement déconnecté';
		$this->search_older = 'plus vieux';
		$this->search_online = 'Ce membre est actuellement connecté';
		$this->search_only_display = 'Afficher seulement le premier';
		$this->search_partial_name = 'nom partiel';
		$this->search_post_icon = 'Icône de message';
		$this->search_posted_on = 'Posté le';
		$this->search_posts = 'Messages';
		$this->search_posts_by = 'Seulement dans les messages posté par';
		$this->search_regex = 'Trouve en utilisant des expressions régulières';
		$this->search_regex_failed = 'Votre expression régulière a échouée. Merci de consulter la document de MySQL pour l\'aide sur les expressions régulières. ';
		$this->search_relevance = 'Pertinence du message: %d%%';
		$this->search_replies = 'Réponses';
		$this->search_result = 'Résultats de la recherche';
		$this->search_search = 'Trouve';
		$this->search_select_all = 'Tout sélectionner';
		$this->search_show_posts = 'Affichez les messages';
		$this->search_sound = 'Mots qui ressemblent à';
		$this->search_starter = 'Auteur';
		$this->search_than = 'que';
		$this->search_topic = 'Sujet';
		$this->search_unreg = 'Non-enregistré';
		$this->search_week = 'semaine';
		$this->search_weeks = 'semaines';
		$this->search_year = 'année';
	}

	function settings()
	{
		$this->settings = 'Paramètres';
		$this->settings_active = 'Paramètres des Utilisateurs Actifs';
		$this->settings_allow = 'Permettre';
		$this->settings_antibot = 'Enregistrement Anti-Robot';
		$this->settings_attach_ext = 'Pièces jointes - Extensions de Fichier';
		$this->settings_attach_one_per = 'Un par ligne. Aucun point.';
		$this->settings_avatar = 'Paramètres des Avatars';
		$this->settings_avatar_flash = 'Avatars Flash';
		$this->settings_avatar_max_height = 'Hauteur Maximum des Avatars';
		$this->settings_avatar_max_width = 'Largeur Maximum des Avatars';
		$this->settings_avatar_upload = 'Avatars téléchargés - Taille Max. de Fichier';
		$this->settings_basic = 'Editer les Paramètres du Board';
		$this->settings_blank = 'Utiliser <i>_blank</i> pour une nouvelle fenêtre.';
		$this->settings_board_enabled = 'Le Board est activé';
		$this->settings_board_location = 'Emplacement du Board';
		$this->settings_board_name = 'Nom du Board';
		$this->settings_board_rss = 'Paramètres du fil RSS';
		$this->settings_board_rssfeed_desc = 'Description du fils RSS';
		$this->settings_board_rssfeed_posts = 'Nombre de messages à lister sur le fil RSS';
		$this->settings_board_rssfeed_time = 'Temps de rafraîchissage en minutes';
		$this->settings_board_rssfeed_title = 'Titre du fil RSS';
		$this->settings_clickable = 'Nombre de Smilies par rangée pouvant être cliqué';
		$this->settings_cookie = 'Paramètres des Cookies et des Floods';
		$this->settings_cookie_path = 'Chemin du Cookie';
		$this->settings_cookie_prefix = 'Préfixe du Cookie';
		$this->settings_cookie_time = 'Temps pendant lequel rester connecté';
		$this->settings_db = 'Editer les paramètres de Connexion';
		$this->settings_db_host = 'Hôte de la base de données';
		$this->settings_db_leave_blank = 'Laisser blanc pour rien.';
		$this->settings_db_multiple = 'Pour l\'installation de plusieurs boards sur une seule base de données.';
		$this->settings_db_name = 'Nom de la base de données';
		$this->settings_db_password = 'Mot de passe de la base de données';
		$this->settings_db_port = 'Port de la base de données';
		$this->settings_db_prefix = 'Préfixe des tables';
		$this->settings_db_socket = 'Socket de la base de données';
		$this->settings_db_username = 'Nom d\'utilisateur(-trice) de la base de données';
		$this->settings_debug_mode = 'Debug Mode'; //Translate
		$this->settings_default_lang = 'Langue par défaut';
		$this->settings_default_no = 'Non par défaut';
		$this->settings_default_skin = 'Peau par défaut';
		$this->settings_default_yes = 'Oui par défaut';
		$this->settings_disabled = 'Désactivé';
		$this->settings_disabled_notice = 'A désactivé la notification';
		$this->settings_email = 'Paramètres de mél';
		$this->settings_email_fake = 'Pour l\'affichage seulement. Ne doit pas être une vraie adresse mél.';
		$this->settings_email_from = 'Mél de l\'adresse';
		$this->settings_email_place1 = 'Placer les membres dans le';
		$this->settings_email_place2 = 'groupe jusqu\'à ce qu\'ils vérifient leur mél.';
		$this->settings_email_place3 = 'Ne nécessite pas l\'activation du mél';
		$this->settings_email_real = 'Devrait être une vraie adresse mél.';
		$this->settings_email_reply = 'Addresse Réponse de Mél';
		$this->settings_email_smtp = 'Serveur Mél SMTP';
		$this->settings_email_valid = 'Validation du mél des Nouveaux Membres';
		$this->settings_enabled = 'Activé';
		$this->settings_enabled_modules = 'Modules Activés';
		$this->settings_foreign_link = 'Cible de lien etranger';
		$this->settings_general = 'Paramètres généraux';
		$this->settings_group_after = 'Groupe Après Inscription';
		$this->settings_hot_topic = 'Messages pour un sujet brûlant';
		$this->settings_kilobytes = 'KiloOctets';
		$this->settings_max_attach_size = 'Pièces jointes - Taille de fichier maximum';
		$this->settings_members = 'Paramètres des Membres';
		$this->settings_modname_only = 'Nom du Module seulement. N\'incluez pas .php';
		$this->settings_new = 'New Setting'; //Translate
		$this->settings_new_add = 'Add Board Setting';
		$this->settings_new_added = 'New settings added.'; //Translate
		$this->settings_new_exists = 'That setting already exists. Choose another name for it.'; //Translate
		$this->settings_new_name = 'New setting name'; //Translate
		$this->settings_new_required = 'The new setting name is required.'; //Translate
		$this->settings_new_value = 'New setting value'; //Translate
		$this->settings_no_allow = 'Ne permettez pas';
		$this->settings_nodata = 'Aucune donnée n\'a été envoyée depuis POST';
		$this->settings_one_per = 'Un par ligne';
		$this->settings_pixels = 'Pixels'; //Translate
		$this->settings_pm_flood = 'Contrôle Flood du Messager Perso';
		$this->settings_pm_min_time = 'Temps minimum entre les messages.';
		$this->settings_polls = 'Sondages';
		$this->settings_polls_no = 'Les Utilisateurs(-trices) ne peuvent voter dans un sondage après avoir visualisé ses résultats';
		$this->settings_polls_yes = 'Les Utilisateurs(-trices) peuvent voter dans un sondage après avoir visualisé ses résultats';
		$this->settings_post_flood = 'Contrôle Flood des Messages';
		$this->settings_post_min_time = 'Temps Minimum entre les messages.';
		$this->settings_posts_topic = 'Messages par Page Sujet';
		$this->settings_search_flood = 'Contrôle Flood des Recherches';
		$this->settings_search_min_time = 'Temps minimum entre les recherches.';
		$this->settings_server = 'Paramètres du Serveur';
		$this->settings_server_gzip = 'Compression GZIP';
		$this->settings_server_gzip_msg = 'Augemente la vitesse. Désactiver si le board paraît brouillé ou vide.';
		$this->settings_server_maxload = 'Charge maximum du Serveur';
		$this->settings_server_maxload_msg = 'Désactive le board en cas de charge excessive du serveur. Entrez 0 pour désactiver.';
		$this->settings_server_timezone = 'Fuseau Horaire du Serveur';
		$this->settings_show_avatars = 'Afficher les Avatars';
		$this->settings_show_email = 'Montrer l\'adresse mél';
		$this->settings_show_emotes = 'Montrer les émotions';
		$this->settings_show_notice = 'Affiché quand le board est désactivé';
		$this->settings_show_pm = 'Accepter les messages perso';
		$this->settings_show_sigs = 'Afficher les Signatures';
		$this->settings_spider_agent = 'User Agent de l\'araignée';
		$this->settings_spider_agent_msg = 'Entrez tout ou une partie du HTTP USER AGENT unique de l\'araignée.';
		$this->settings_spider_enable = 'Activer l\'affichage des araignées';
		$this->settings_spider_enable_msg = 'Activer les noms d\'araignées de moteurs de recherche sur Active List.';
		$this->settings_spider_name = 'Nom de l\'araignée';
		$this->settings_spider_name_msg = 'Entrez le nom que vous voulez afficher pour chacune des arraignées ci-dessus dans Active List. Vous devez placer le nom de l\'araignée sur la même ligne que son user agent ci-dessus. Par exemple, si vous placer \'googlebot\' sur la troisième ligne pour l\'user agent placez \'Google\' sur la troisième ligne pour le nom de l\'araignée.';
		$this->settings_timezone = 'Fuseau horaire';
		$this->settings_topics_page = 'Sujets Par Page Forum';
		$this->settings_tos = 'Conditions de service';
		$this->settings_updated = 'Réglages mis à jour.';
	}

	function stats()
	{
		$this->stats = 'Centre des statistiques';
		$this->stats_post_by_month = 'Messages par mois';
		$this->stats_reg_by_month = 'Abonnements par mois';
	}

	function templates()
	{
		$this->add = 'Ajouter des Maquettes HTML';
		$this->add_in = 'Ajouter la maquette à:';
		$this->all_fields_required = 'Tous les champs sont nécessaires pour ajouter une maquette';
		$this->choose_css = 'Choose CSS Template'; //Translate
		$this->choose_set = 'Choississez une collection de maquettes';
		$this->choose_skin = 'Choississez une peau';
		$this->confirm1 = 'Vous êtes sur le point d\'effacer la';
		$this->confirm2 = 'maquette de';
		$this->create_new = 'Creér une nouvelle peau appellée';
		$this->create_skin = 'Créer une peau';
		$this->credit = 'Veuillez s\'il vous plaît ne pas enlever notre seule mention!';
		$this->css_edited = 'CSS file has been updated.'; //Translate
		$this->css_fioerr = 'The file could not be written to, you will need to CHMOD the file manually.'; //Translate
		$this->delete_template = 'Effacer une Maquette';
		$this->directory = 'Répertoire';
		$this->display_name = 'Nom d\'affichage';
		$this->edit_css = 'Edit CSS'; //Translate
		$this->edit_skin = 'Editer une peau';
		$this->edit_templates = 'Editer les Maquettes';
		$this->export_done = 'La peau a été exportée au répertoire principal des Forums QuickSilver.';
		$this->export_select = 'Sélectionner une peau à exporter';
		$this->export_skin = 'Exporter une peau';
		$this->install_done = 'La peau a été installée avec succès';
		$this->install_exists1 = 'Il semblerait que la peau';
		$this->install_exists2 = 'est déjà installée.';
		$this->install_overwrite = 'Enregister par dessus';
		$this->install_skin = 'Installer une peau';
		$this->menu_title = 'Sélectionner une partie de maquette à éditer';
		$this->no_file = 'No such file.'; //Translate
		$this->only_skin = 'Il n\'y a qu\'une peau installée. Vous ne pouvez la supprimer.';
		$this->or_new = 'Ou créer une nouvelle collection de maquettes appellée:';
		$this->select_skin = 'Sélectionner une peau';
		$this->select_skin_edit = 'Sélectionner une peau à éditer';
		$this->select_skin_edit_done = 'La peau a été éditée avec succès.';
		$this->select_template = 'Sélectionner une maquette';
		$this->skin_chmod = 'Un nouveau répertoire ne pouvait être crée pour la peau. Essayez de CHMOD le répertoire des peaux à 775.';
		$this->skin_created = 'Peau créee.';
		$this->skin_deleted = 'La peau a été supprimée avec succès.';
		$this->skin_dir_name = 'Vous devez entrer un nom de peau et un nom de répertoire.';
		$this->skin_dup = 'Une peau avec un nom de répertoire identique a été trouvée. Le répertoire des peaux a été modifié à';
		$this->skin_name = 'Vous devez entrer un nom de peau.';
		$this->skin_none = 'Il n\'y a pas de peaux disponibles à installer.';
		$this->skin_set = 'Collection de peaux.';
		$this->skins_found = 'Les peaux suivantes ont été trouvées dans le répertoire des Forums QuickSilver';
		$this->template_about = 'Variables A propos';
		$this->template_about2 = 'Les variables sont des morceaux de texte qui sont remplacées par des données dynamiques. Les variables commencent toujours avec le signe du dollar, et sont parfois enfermées dans des {parenthèses}.';
		$this->template_add = 'Ajouter';
		$this->template_added = 'Maquette ajoutée.';
		$this->template_clear = 'Effacer';
		$this->template_confirm = 'Vous avez modifié les maquettes. Sauvegarder?';
		$this->template_description = 'Description de la Maquette';
		$this->template_html = 'Maquette HTML';
		$this->template_name = 'Nom de la Maquette';
		$this->template_position = 'Position de la Maquette';
		$this->template_set = 'Collection de Maquettes';
		$this->template_title = 'Titre de la Maquette';
		$this->template_universal = 'Variable Universelle';
		$this->template_universal2 = 'Certaines variables peuvent être utilisées dans n\'importe quelle maquette, tandis que d\'autres ne peuvent qu\'être utilisées dans une seule maquette. Les propriétés de l\'objet $this peuvent être utilisées n\'importe où.';
		$this->template_updated = 'Maquette mis à jour';
		$this->templates = 'Maquettes';
		$this->temps_active = 'Détails des Utilisateurs Actifs';
		$this->temps_admin = '<b>Universel AdminCP</b>';
		$this->temps_ban = 'Interdictions AdminCP';
		$this->temps_board_index = 'Indexe du Board';
		$this->temps_censoring = 'Censure des mots AdminCP';
		$this->temps_cp = 'Panneau de Contrôle des Membres';
		$this->temps_email = 'Envoyer un mél à un membre';
		$this->temps_emot_control = 'Les émotions de l\'AdminCP';
		$this->temps_forum = 'Forums'; //Translate
		$this->temps_forums = 'Forums AdminCP';
		$this->temps_groups = ' Groupes AdminCP';
		$this->temps_help = 'Aide';
		$this->temps_login = 'Se (dé-)connécter';
		$this->temps_logs = 'Fichiers logs du modérateur AdminCP';
		$this->temps_main = '<b>Board Universel</b>';
		$this->temps_mass_mail = 'Mél de masse AdminCP';
		$this->temps_member_control = 'Contrôle des Membres AdminCP';
		$this->temps_members = 'Liste des membres';
		$this->temps_mod = 'Contrôles du modérateur';
		$this->temps_pm = 'Messager Privé';
		$this->temps_polls = 'Sondages';
		$this->temps_post = 'Message';
		$this->temps_printer = 'Sujets imprimables';
		$this->temps_profile = 'Affichage des Profils';
		$this->temps_recent = 'Sujets récents';
		$this->temps_register = 'Enregistrement';
		$this->temps_rssfeed = 'RSS Feed'; //Translate
		$this->temps_search = 'Recherche';
		$this->temps_settings = 'Configurations AdminCP';
		$this->temps_templates = 'Editeur des maquettes de l\'AdminCP';
		$this->temps_titles = 'Titres des membres AdminCP';
		$this->temps_topic_prune = 'Taillage de sujet AdminCP';
		$this->temps_topics = 'Sujets';
		$this->upgrade_skin = 'Mettre à jour la peau';
		$this->upgrade_skin_already = 'a déjà été mis à jour. Rien à faire.';
		$this->upgrade_skin_detail = 'Les peaux mises à jour de cette façon nécessiteront quand même par la suite un mis à jour de la maquette.<br />Veuillez sélectionner une peau pour la mise à jour.';
		$this->upgrade_skin_upgraded = 'peau a été mise à jour';
		$this->upgraded_templates = 'Les maquettes suivantes ont été ajoutées';
	}

	function titles()
	{
		$this->titles_add = 'Ajouter les titres des membres';
		$this->titles_added = 'Titre de membre ajouté';
		$this->titles_control = 'Contrôle des titres des membres';
		$this->titles_edit = 'Editer les titres des membres';
		$this->titles_error = 'Aucun texte de titre ou de messages minimum n\'a été fourni';
		$this->titles_image = 'Image'; //Translate
		$this->titles_minpost = 'Messages minimums';
		$this->titles_nodel_default = 'Removal of the default title has been disabled as it will break your board, please edit it instead.'; //Translate
		$this->titles_title = 'Titre';
	}

	function topic()
	{
		$this->topic_attached = 'Fichier attaché :';
		$this->topic_attached_downloads = 'téléchargements';
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = 'Vous n\'avez pas la permission de télécharger ce fichier.';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = 'Fichier attaché';
		$this->topic_avatar = 'Avatar'; //Translate
		$this->topic_bottom = 'Aller en bas de la page';
		$this->topic_create_poll = 'Créer un nouveau sondage';
		$this->topic_create_topic = 'Créer un nouveau sujet';
		$this->topic_delete = 'Supprimer';
		$this->topic_delete_post = 'Supprimer ce message';
		$this->topic_edit = 'Editer';
		$this->topic_edit_post = 'Editer ce message';
		$this->topic_edited = 'Message édité le %s par %s';
		$this->topic_error = 'Erreur';
		$this->topic_group = 'Groupe';
		$this->topic_guest = 'Innvité';
		$this->topic_ip = 'IP'; //Translate
		$this->topic_joined = 'Rejoint';
		$this->topic_level = 'Niveau du membre';
		$this->topic_links_aim = 'Envoyer un message AIM à %s';
		$this->topic_links_email = 'Envoyer un email à %s';
		$this->topic_links_gtalk = 'Envoyer un message GTalk à %s';
		$this->topic_links_icq = 'Envoyer un message ICQ à %s';
		$this->topic_links_msn = 'Voir le profil MSN de %s\'s';
		$this->topic_links_pm = 'Envoyer un message privé à %s';
		$this->topic_links_web = 'Visiter le site web de %s\'s';
		$this->topic_links_yahoo = 'Envoyer un message à %s avec Yahoo! Messenger';
		$this->topic_lock = 'Verrouiller';
		$this->topic_locked = 'Sujet verrouillé';
		$this->topic_move = 'Déplacer';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = 'Sujet plus récent';
		$this->topic_no_newer = 'Il n\'y a aucun sujet plus récent.';
		$this->topic_no_older = 'Il n\'y a aucun sujet plus ancien.';
		$this->topic_no_votes = 'Il n\'y a pas de vote pour ce sujet.';
		$this->topic_not_found = 'Le sujet n\'a pas été trouvé.';
		$this->topic_not_found_message = 'Le sujet n\'a pas été trouvé. Il peut avoir été supprimé, déplacé ou n\'avoir jamais existé.';
		$this->topic_offline = 'Ce membre est actuellement déconnecté';
		$this->topic_older = 'Sujet plus ancien';
		$this->topic_online = 'Ce membre est actuellement connecté';
		$this->topic_options = 'Options';
		$this->topic_pages = 'Pages'; //Translate
		$this->topic_perm_view = 'Vous n\'avez pas la permission de voir les sujets.';
		$this->topic_perm_view_guest = 'Vous n\'avez pas la permission de voir les sujets. Si vous vous enregistrez, vous le pourrez.';
		$this->topic_pin = 'Epingler';
		$this->topic_posted = 'Posté';
		$this->topic_posts = 'Messages';
		$this->topic_print = 'Voir une version imprimable';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'Emoticons'; //Translate
		$this->topic_qr_open_emoticons = 'Open Clickable Emoticons'; //Translate
		$this->topic_qr_open_mbcode = 'Ouvrir le MBCode';
		$this->topic_quickreply = 'Réponse rapide';
		$this->topic_quote = 'Répondre à une citation';
		$this->topic_reply = 'Repondre au sujet';
		$this->topic_split = 'Découper';
		$this->topic_split_finish = 'Terminer tous les découpages';
		$this->topic_split_keep = 'Ne pas déplacer ce sujet';
		$this->topic_split_move = 'Déplacer ce sujet';
		$this->topic_subscribe = 'M\'envoyer un email quand des réponses sont postées dans ce sujet.';
		$this->topic_top = 'Aller en haut de la page';
		$this->topic_unlock = 'Déverrouiller';
		$this->topic_unpin = 'Désépingler';
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = 'Non enregistré';
		$this->topic_view = 'Consultation des résultats';
		$this->topic_viewing = 'Consultation d\'un sujet ';
		$this->topic_vote = 'Voter';
		$this->topic_vote_count_plur = '%d votes'; //Translate
		$this->topic_vote_count_sing = '%d vote'; //Translate
		$this->topic_votes = 'Votes'; //Translate
	}

	function universal()
	{
		$this->aim = 'AIM'; //Translate
		$this->based_on = 'basé sur';
		$this->board_by = 'Par';
		$this->charset = 'utf-8';
		$this->continue = 'Continuer';
		$this->date_long = 'M j, Y'; //Translate
		$this->date_short = 'n/j/y'; //Translate
		$this->delete = 'Supprimer';
		$this->direction = 'ltr'; //Translate
		$this->edit = 'Editer';
		$this->email = 'Mél';
		$this->gtalk = 'GT'; //Translate
		$this->icq = 'ICQ'; //Translate
		$this->msn = 'MSN'; //Translate
		$this->new_message = 'Nouveau Message';
		$this->new_poll = 'Nouveau sondage';
		$this->new_topic = 'Nouveau sujet';
		$this->no = 'Non';
		$this->powered = 'Alimenté par';
		$this->private_message = 'PM'; //Translate
		$this->quote = 'Citation';
		$this->recount_forums = 'Recounted forums! Total topics: %d. Total posts: %d.'; //Translate
		$this->reply = 'Réponse';
		$this->seconds = 'Secondes';
		$this->select_all = 'Tout sélectionner';
		$this->sep_decimals = ',';
		$this->sep_thousands = ' ';
		$this->spoiler = 'Spoiler'; //Translate
		$this->submit = 'Envoyer';
		$this->subscribe = 'Souscrire';
		$this->time_long = ', g:i a'; //Translate
		$this->time_only = 'g:i a'; //Translate
		$this->today = 'Aujourd\'hui';
		$this->website = 'WWW'; //Translate
		$this->yahoo = 'Yahoo'; //Translate
		$this->yes = 'Oui';
		$this->yesterday = 'Hier';
	}
}
?>
