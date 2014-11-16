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
 * Spanish language module
 *
 * @author Oscar Puertas <info@sitiosmexico.net>
 * @since 1.1.0
 **/
class es
{
	function active()
	{
		$this->active_last_action = 'Última acción';
		$this->active_modules_active = 'Desplegando usuarios activos';
		$this->active_modules_board = 'Desplegando el íindice';
		$this->active_modules_cp = 'Usando el panel de control';
		$this->active_modules_forum = 'Viewing a forum: %s'; //Translate
		$this->active_modules_help = 'Usando la ayuda';
		$this->active_modules_login = 'Firmandose o Saliendo';
		$this->active_modules_members = 'Desplegando la lista de miembros';
		$this->active_modules_mod = 'Moderando';
		$this->active_modules_pm = 'Usando mensajero';
		$this->active_modules_post = 'Publicando';
		$this->active_modules_printer = 'Printing a topic: %s'; //Translate
		$this->active_modules_profile = 'Viewing a profile: %s'; //Translate
		$this->active_modules_recent = 'Viewing recent posts'; //Translate
		$this->active_modules_search = 'Buscando';
		$this->active_modules_topic = 'Viewing a topic: %s'; //Translate
		$this->active_time = 'Tiempo';
		$this->active_user = 'Usuario';
		$this->active_users = 'Usuarios activos';
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
		$this->board_active_users = 'Usuarios activos';
		$this->board_birthdays = 'Cumpleaños de Hoy';
		$this->board_bottom_page = 'Go to the bottom of the page'; //Translate
		$this->board_can_post = 'Puede contestar en este foro';
		$this->board_can_topics = 'Puede ver, más no crear tópicos en este foro';
		$this->board_cant_post = 'No puede responder en este foro';
		$this->board_cant_topics = 'No puede ver o crear tópicos en este foro';
		$this->board_forum = 'Foro';
		$this->board_guests = 'Invitados';
		$this->board_last_post = 'Último mensaje';
		$this->board_mark = 'Marcar todos los mensajes como leidos';
		$this->board_mark1 = 'Todos los mensajes se han marcado como leidos';
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = 'Miembros';
		$this->board_message = '%s Mensaje';
		$this->board_most_online = 'The most users ever online was %d on %s.'; //Translate
		$this->board_nobday = 'No hay cumpleaños de miembros hoy';
		$this->board_nobody = 'No hay miembros en línea';
		$this->board_nopost = 'No hay mensajes';
		$this->board_noview = 'No tiene permiso para ver la lista de mensajes';
		$this->board_regfirst = 'No tiene permiso para ver la lista de mensajes, pero si se registra, podrá tener esa capacidad';
		$this->board_replies = 'Respuestas';
		$this->board_stats = 'Estadísticas';
		$this->board_stats_string = '%s users have registered. Welcome to our newest member, %s.<br />There are %s topics and %s replies for a total of %s posts.'; //Translate
		$this->board_top_page = 'Go to the top of the page'; //Translate
		$this->board_topics = 'tópicos';
		$this->board_users = 'Usuarios';
		$this->board_write_topics = 'Puede ver y crear tópicos en este foro';
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
		$this->cp_aim = 'AIM Screen Name'; //Translate
		$this->cp_already_member = 'El correo electrónico que ha inscrito ya esta asignado a otro miembro';
		$this->cp_apr = 'Abril';
		$this->cp_aug = 'Agosto';
		$this->cp_avatar_current = 'Su avatar actual';
		$this->cp_avatar_error = 'Error de avatar';
		$this->cp_avatar_must_select = 'Debe de seleccionar un avatar.';
		$this->cp_avatar_none = 'No usar un avatar';
		$this->cp_avatar_pixels = 'pixeles';
		$this->cp_avatar_select = 'seccionar un avatar';
		$this->cp_avatar_size_height = 'La altura de su avatar debe de estar entre 1 y';
		$this->cp_avatar_size_width = 'El Ancho de su avatar debe de estar entre 1 y';
		$this->cp_avatar_upload = 'Cargar un avatar de su disco duro';
		$this->cp_avatar_upload_failed = 'La carga de su avatar fallo. El Archivo no existe';
		$this->cp_avatar_upload_not_image = 'Solo puede cargar imagenes para ser usada como su avatar';
		$this->cp_avatar_upload_too_large = 'El archivo de avatar que especifico es muy grande, el tamaño maximo es de %d kilobytes.';
		$this->cp_avatar_url = 'Especificar un URL para su avatar';
		$this->cp_avatar_use = 'Usar su avatar cargado';
		$this->cp_bday = 'Cumpleaños';
		$this->cp_been_updated = 'Su perfíl ha sido actualizados';
		$this->cp_been_updated1 = 'Su avatar ha sido actualizado';
		$this->cp_been_updated_prefs = 'Sus preferencias han sido actualizadas';
		$this->cp_changing_pass = 'Editanto Password';
		$this->cp_contact_pm = 'Permitir a otros contactarle via mensajero?';
		$this->cp_cp = 'Panel de control';
		$this->cp_current_avatar = 'Avatar actual';
		$this->cp_current_time = 'Son las %s.';
		$this->cp_custom_title = 'Custom Member Title'; //Translate
		$this->cp_custom_title2 = 'This is a privledge reserved for board administrators'; //Translate
		$this->cp_dec = 'Diciembre';
		$this->cp_editing_avatar = 'Editando Avatar';
		$this->cp_editing_profile = 'Editing Profile'; //Translate
		$this->cp_email = 'Correo electrónico';
		$this->cp_email_form = 'Permitir a otros contactarlo via formulario de correo electrónico?';
		$this->cp_email_invaid = 'La cuenta de correo electrónico que especifico es invalida';
		$this->cp_err_avatar = 'Error al actualizar su avatar';
		$this->cp_err_updating = 'Error al actualizar perfíl';
		$this->cp_feb = 'Febrero';
		$this->cp_file_type = 'El avatar que especifico no es valido, cerciorese del formato. Los formatos validos son gif, jpg, o png';
		$this->cp_format = 'Nombre de usuario';
		$this->cp_gtalk = 'GTalk Account'; //Translate
		$this->cp_header = 'Panel de control del usuario';
		$this->cp_height = 'Altura';
		$this->cp_icq = 'Numero de ICQ';
		$this->cp_interest = 'Intereses o actividades';
		$this->cp_jan = 'Enero';
		$this->cp_july = 'Julio';
		$this->cp_june = 'June'; //Translate
		$this->cp_label_edit_avatar = 'Editar Avatar';
		$this->cp_label_edit_pass = 'Editar Password';
		$this->cp_label_edit_prefs = 'Editar Preferencias';
		$this->cp_label_edit_profile = 'Editar perfíl';
		$this->cp_label_edit_sig = 'Edit Signature'; //Translate
		$this->cp_label_edit_subs = 'Editar Suscripciones';
		$this->cp_language = 'Idioma';
		$this->cp_less_charac = 'Su nOmbre de usuario debe ser menor de 32 caracteres';
		$this->cp_location = 'Ubicación';
		$this->cp_login_first = 'Debe de estar firmado para accesar al panel de control';
		$this->cp_mar = 'Marzo';
		$this->cp_may = 'Mayo';
		$this->cp_msn = 'Identidad de MSN';
		$this->cp_must_orig = 'Su nombre debe de ser identico al original. Puede cambiar a mayusculas o el espaciado';
		$this->cp_new_notmatch = 'Los passwords especificados no coinciden';
		$this->cp_new_pass = 'Nuevo Password';
		$this->cp_no_flash = 'Los avatares en Flash No se permiten';
		$this->cp_not_exist = 'The date you specified (%s) does not exist!'; //Translate
		$this->cp_nov = 'Noviembre';
		$this->cp_oct = 'Octubre';
		$this->cp_old_notmatch = 'El antiguo Password especificano no coincide con el de la base de datos';
		$this->cp_old_pass = 'Password antiguo';
		$this->cp_pass_notvaid = 'Su password no es valido, asegurese que usa caracteres validos como letras, numeros, guiones, guiones bajos, etc.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = 'Cambiando Preferencias';
		$this->cp_preview_sig = 'Signature Preview:'; //Translate
		$this->cp_privacy = 'Opciones de privacidad';
		$this->cp_repeat_pass = 'Repetir el nuevo password';
		$this->cp_sept = 'Septiembre';
		$this->cp_show_active = 'Show your activities when you are using the board?'; //Translate
		$this->cp_show_email = 'Mostrar correo electrónico en perfíl?';
		$this->cp_signature = 'Firma';
		$this->cp_size_max = 'El avatar especifiaco es muy grande. El tamaño maximo permitido es %s por %s pixeles.';
		$this->cp_skin = 'Esquema de despliegue';
		$this->cp_sub_change = 'Cambiando suscripciones';
		$this->cp_sub_delete = 'Borrar';
		$this->cp_sub_expire = 'Fecha de expiracion';
		$this->cp_sub_name = 'Nombre de suscripcion';
		$this->cp_sub_no_params = 'No fueron dados parametros';
		$this->cp_sub_success = 'Esta ahora suscrito a %s.';
		$this->cp_sub_type = 'Tipo de suscripcion';
		$this->cp_sub_updated = 'Las suscripciones seleccionadas han sido borradas';
		$this->cp_topic_option = 'Opciones de tópico';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = 'perfíl actualizado';
		$this->cp_updated1 = 'Avatar actualizado';
		$this->cp_updated_prefs = 'Preferencias actualizadas';
		$this->cp_user_exists = 'Ese nombre de usuario ya existe previamente';
		$this->cp_valided = 'Su password ha sido validado y cambiado';
		$this->cp_view_avatar = 'Ver avatars?';
		$this->cp_view_emoticon = 'Ver emoticons?';
		$this->cp_view_signature = 'Ver firmas?';
		$this->cp_welcome = 'Bienvenido al panel de control de usuario. Aqui podrá configurar su cuenta. Seleccione de las opciones arriba';
		$this->cp_width = 'Anchura';
		$this->cp_www = 'Pagina Personal';
		$this->cp_yahoo = 'Identidad de Yahoo!';
		$this->cp_zone = 'Zona Horaria';
	}

	function email()
	{
		$this->email_blocked = 'Ese miembro no acepta correo desde este formulario';
		$this->email_email = 'Correo electrónico';
		$this->email_msgtext = 'Cuerpo del mensaje:';
		$this->email_no_fields = 'regrese y asegurese que todos los campos esten completos';
		$this->email_no_member = 'No existe un miembro con ese nombre';
		$this->email_no_perm = 'No tiene permiso de enviar correo a traves de este sistema';
		$this->email_sent = 'Su correo ha sido enviado';
		$this->email_subject = 'Titulo:';
		$this->email_to = 'A:';
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
		$this->forum_by = 'De';
		$this->forum_can_post = 'Puede contester en este foro';
		$this->forum_can_topics = 'Puede ver tópicos en este foro';
		$this->forum_cant_post = 'No puede responder en este foro';
		$this->forum_cant_topics = 'No puede ver tópicos en este foro';
		$this->forum_dot = 'punto';
		$this->forum_dot_detail = 'Muestra que ha publicado o contestado en este tópico';
		$this->forum_forum = 'Foro';
		$this->forum_guest = 'Invitado';
		$this->forum_hot = 'Activo';
		$this->forum_icon = 'Ícono de Mensaje';
		$this->forum_jump = 'Brincar al tópico más reciente';
		$this->forum_last = 'Ultima publicación';
		$this->forum_locked = 'Bloqueado';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = 'Movido';
		$this->forum_msg = '%s Mensaje';
		$this->forum_new = 'Nuevo';
		$this->forum_new_poll = 'Crear una nueva encuesta';
		$this->forum_new_topic = 'Crear nuevo tópico';
		$this->forum_no_topics = 'No hay tópicos para desplegar en este foro';
		$this->forum_noexist = 'El foro especificado no existe';
		$this->forum_nopost = 'No hay publicaciones';
		$this->forum_not = 'No';
		$this->forum_noview = 'No tiene permiso para ver foros';
		$this->forum_pages = 'Paginas';
		$this->forum_pinned = 'Fijado';
		$this->forum_pinned_topic = 'tópico Fijado';
		$this->forum_poll = 'Encuesta';
		$this->forum_regfirst = 'No tiene permiso para ver los foros, si se registra, podrá hacerlo';
		$this->forum_replies = 'Respuestas';
		$this->forum_starter = 'Iniciador';
		$this->forum_sub = 'Sub-Foro';
		$this->forum_sub_last_post = 'Ultima publicación';
		$this->forum_sub_replies = 'Respuestas';
		$this->forum_sub_topics = 'tópicos';
		$this->forum_subscribe = 'Notificarme via correo electrónico cuando se publique en este foro';
		$this->forum_topic = 'tópico';
		$this->forum_views = 'Vistas';
		$this->forum_write_topics = 'Puede crear tópicos en este foro';
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
		$this->help_available_files = 'Ayuda';
		$this->help_confirm = 'Are you sure you want to delete'; //Translate
		$this->help_content = 'Article content'; //Translate
		$this->help_delete = 'Delete Help Article'; //Translate
		$this->help_deleted = 'Help Article Deleted.'; //Translate
		$this->help_edit = 'Edit Help Article'; //Translate
		$this->help_edited = 'Help article updated.'; //Translate
		$this->help_inserted = 'Article inserted into the database.'; //Translate
		$this->help_no_articles = 'No help articles were found in the database.'; //Translate
		$this->help_no_title = 'You can\'t create a help article without a title.'; //Translate
		$this->help_none = 'No hay archivos de ayuda en la base de datos';
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
		$this->login_cant_logged = 'No pudo firmarse, verifique que su nombre de usuario y/o password sea correcto.<br /><br />Ambos son sensibles a mayusculas y minusculas, por lo que \'UsUARIO\' es diferente de \'Usuario\'. Tambien verifique, que las cookies estén habilitadas en su sistema o navegador.';
		$this->login_cookies = 'Las cookies deben de estar habilitadas para firmarse';
		$this->login_forgot_pass = 'Forgot your password?'; //Translate
		$this->login_header = 'Firmandose';
		$this->login_logged = 'Ahora esta usted firmado';
		$this->login_now_out = 'Ahora esta fuera del sistema';
		$this->login_out = 'Saliendo';
		$this->login_pass = 'Password'; //Translate
		$this->login_pass_no_id = 'There is no member with the user name you entered.'; //Translate
		$this->login_pass_request = 'To complete the password reset, please click on the link sent to the email address associated with your account.'; //Translate
		$this->login_pass_reset = 'Reset Password'; //Translate
		$this->login_pass_sent = 'Your password has been reset. The new password has been sent to the email address associated with your account.'; //Translate
		$this->login_sure = 'Esta segura que quiere salir de \'%s\'?';
		$this->login_user = 'Nombre de usuario';
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
		$this->main_activate = 'Su cuenta ha sido activada';
		$this->main_activate_resend = 'Reenviar Correo de activacion';
		$this->main_admincp = 'admin cp';
		$this->main_banned = 'Le ha sido prohibido ver cualquier parte de este sistema';
		$this->main_code = 'Codigo';
		$this->main_cp = 'Panel de control';
		$this->main_full = 'Completo';
		$this->main_help = 'Ayuda';
		$this->main_load = 'Cargar';
		$this->main_login = 'Firmar';
		$this->main_logout = 'Salir';
		$this->main_mark = 'mark all';
		$this->main_mark1 = 'Mark all topics as read'; //Translate
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = 'Lo sentimos pero, %s no esta actualmente disponible debido a la cantidad masiva de usuaruios conectados';
		$this->main_members = 'Miembros';
		$this->main_messenger = 'Mensajero';
		$this->main_new = 'Nuevo';
		$this->main_next = 'Siguiente';
		$this->main_prev = 'Anterior';
		$this->main_queries = 'Busquedas';
		$this->main_quote = 'Quote'; //Translate
		$this->main_recent = 'recent posts';
		$this->main_recent1 = 'View recent topics since your last visit'; //Translate
		$this->main_register = 'Registar';
		$this->main_reminder = 'Recordatorio';
		$this->main_reminder_closed = 'El sistema esta cerrado y esta solo disponible para administradores';
		$this->main_said = 'Dijo';
		$this->main_search = 'Busqueda';
		$this->main_topics_new = 'Hay nuevos mensajes en este foro';
		$this->main_topics_old = 'No hay nuevos mensajes en este foro';
		$this->main_welcome = 'Bienvenido';
		$this->main_welcome_guest = 'Bienvenido Invitado';
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
		$this->members_all = 'Todos';
		$this->members_email = 'Correo electrónico';
		$this->members_email_member = 'enviar correo electrónico a este miembro';
		$this->members_group = 'Grupo';
		$this->members_joined = 'Se unio';
		$this->members_list = 'Lista de Miembros';
		$this->members_member = 'Miembro';
		$this->members_pm = 'PM'; //Translate
		$this->members_posts = 'Publicaciones';
		$this->members_send_pm = 'Enviar a este miembro un mensaje personal';
		$this->members_title = 'Titulo';
		$this->members_vist_www = 'Visitar el sitio web de este miembro';
		$this->members_www = 'sitio Web';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Esta seguro de borrar esta publicación?';
		$this->mod_confirm_topic_delete = 'Esta seguro de borrar este tópico?';
		$this->mod_error_first_post = 'No puede borrar la primera publicación en un tópico';
		$this->mod_error_move_category = 'No puede mover un tópico a una categoria';
		$this->mod_error_move_create = 'You do not have permission to move topics to that forum.'; //Translate
		$this->mod_error_move_forum = 'No puede mover un tópico a un foro que no existe';
		$this->mod_error_move_global = 'You cannot move a global topic. Edit the topic before moving it.'; //Translate
		$this->mod_error_move_same = 'No puede mover un tópico al foro al que ya existe';
		$this->mod_label_controls = 'Controles de moderador';
		$this->mod_label_description = 'Descripcion';
		$this->mod_label_emoticon = 'Convertir emoticons a imagenes?';
		$this->mod_label_global = 'Global Topic'; //Translate
		$this->mod_label_mbcode = 'Formatear MbCode?';
		$this->mod_label_move_to = 'Mover a';
		$this->mod_label_options = 'Opciones';
		$this->mod_label_post_delete = 'Borrar publicación';
		$this->mod_label_post_edit = 'Editar publicación';
		$this->mod_label_post_icon = 'Post Icon'; //Translate
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = 'Titulo';
		$this->mod_label_title_original = 'Original Title'; //Translate
		$this->mod_label_title_split = 'Split Title'; //Translate
		$this->mod_label_topic_delete = 'Borrar tópico';
		$this->mod_label_topic_edit = 'Editar tópico';
		$this->mod_label_topic_lock = 'Bloquear tópico';
		$this->mod_label_topic_move = 'Mover tópico';
		$this->mod_label_topic_move_complete = 'Transferir completamente el tópico al nuevo foro';
		$this->mod_label_topic_move_link = 'Transferir el tópico la nuevo foro, y dejar una liga a su nueva ubicacion en el foro anterior';
		$this->mod_label_topic_pin = 'Fijar tópico';
		$this->mod_label_topic_split = 'Split Topic'; //Translate
		$this->mod_missing_post = 'La publicación especificada no existe';
		$this->mod_missing_topic = 'El tópico especificado no existe';
		$this->mod_no_action = 'Debe especificar una acción';
		$this->mod_no_post = 'Debe especificar una publicación';
		$this->mod_no_topic = 'Debe especificar un tópico';
		$this->mod_perm_post_delete = 'No tiene permiso para borrar esta publicación';
		$this->mod_perm_post_edit = 'No tiene permiso de editar esta publicación';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = 'No tiene permiso de borrar este tópico';
		$this->mod_perm_topic_edit = 'No tiene permiso de editar este tópico';
		$this->mod_perm_topic_lock = 'No tiene permiso de bloquear este tópico';
		$this->mod_perm_topic_move = 'No tiene permiso de mover este tópico';
		$this->mod_perm_topic_pin = 'No tiene permiso para fijar este tópico';
		$this->mod_perm_topic_split = 'You do not have permission to split this topic.'; //Translate
		$this->mod_perm_topic_unlock = 'No tiene permiso para desbloquear este tópico';
		$this->mod_perm_topic_unpin = 'No tiene permiso de quitar la fijacion a este tópico';
		$this->mod_success_post_delete = 'La publicación fue borrada satisfactoriamente';
		$this->mod_success_post_edit = 'La publicación fue editada satisfactoriamente';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = 'The topic was successfully split.'; //Translate
		$this->mod_success_topic_delete = 'El tópico fue borrado satisfactoriamente';
		$this->mod_success_topic_edit = 'El tópico fue editado satisfactoriamente';
		$this->mod_success_topic_move = 'El tópico fue movido satisfactoriamente al nuevo foro';
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
		$this->pm_cant_del = 'No tiene permiso de borrar este mensaje';
		$this->pm_delallmsg = 'Borrar todos los mensajes';
		$this->pm_delete = 'Borrar';
		$this->pm_delete_selected = 'Delete Selected Messages'; //Translate
		$this->pm_deleted = 'Mensaje Borrado';
		$this->pm_deleted_all = 'Mensajes Borrados';
		$this->pm_error = 'There were problems sending your message to some of the recipients.<br /><br />The following members do not exist: %s<br /><br />The following members are not accepting personal messages: %s'; //Translate
		$this->pm_fields = 'Su mensaje no pudo ser enviado, asegurese de que todos los campos esten completos';
		$this->pm_flood = 'You have sent a message in the past %s seconds, and you may not send another right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->pm_folder_inbox = 'Bandeja de Entrada';
		$this->pm_folder_new = '%s nuevos';
		$this->pm_folder_sentbox = 'Sent';
		$this->pm_from = 'De';
		$this->pm_group = 'Grupo';
		$this->pm_guest = 'como invitado no puede usar el mensajero, si lo desea, puede registrarse';
		$this->pm_joined = 'Se unio';
		$this->pm_messenger = 'Mensajero';
		$this->pm_msgtext = 'Texo del mensaje';
		$this->pm_multiple = 'Separate multiple recipients with ;'; //Translate
		$this->pm_no_folder = 'Debe especificar una carpeta';
		$this->pm_no_member = 'No se encontraron miembros con esa identificacion';
		$this->pm_no_number = 'No se encontraron mensajes con ese numero';
		$this->pm_no_title = 'Sin Titulo';
		$this->pm_nomsg = 'No hay mensajes en esta carpeta';
		$this->pm_noview = 'No tiene permiso para ver este mensaje';
		$this->pm_offline = 'This member is currently offline'; //Translate
		$this->pm_online = 'This member is currently online'; //Translate
		$this->pm_personal = 'Mensajero Personal';
		$this->pm_personal_msging = 'Mensajeria Personal';
		$this->pm_pm = 'MP';
		$this->pm_posts = 'Publicaciones';
		$this->pm_preview = 'Preview'; //Translate
		$this->pm_recipients = 'Recipients'; //Translate
		$this->pm_reply = 'Respuestas';
		$this->pm_send = 'Enviar';
		$this->pm_sendamsg = 'Enviar Mensaje';
		$this->pm_sendingpm = 'Enviando MP';
		$this->pm_sendon = 'Enviado';
		$this->pm_success = 'Su mensaje fue enviado satisfactoriamente';
		$this->pm_sure_del = 'Esta seguro de borrar este mensaje?';
		$this->pm_sure_delall = 'Esta seguro de borrar todos los mensajes de esta carpeta?';
		$this->pm_title = 'Titulo';
		$this->pm_to = 'A';
	}

	function post()
	{
		$this->post_attach = 'Anexos';
		$this->post_attach_add = 'Agregar Anexos';
		$this->post_attach_disrupt = 'Agregar o borrar anexos no modificara su publicación';
		$this->post_attach_failed = 'La carga del anexo fallo. El archivo especificado puede que no insista';
		$this->post_attach_not_allowed = 'No puede anexar archivos de ese tipo';
		$this->post_attach_remove = 'Remover Anexo';
		$this->post_attach_too_large = 'El archivo es demasiado grande, el tamaño máximo es %d KB.';
		$this->post_cant_create = 'Como Invitado, no tiene permiso de crear tópicos. Si lo desea, puede registrarse para hacerlo';
		$this->post_cant_create1 = 'No tiene permiso para crear tópicos';
		$this->post_cant_enter = 'Su voto no pudo ser incluido, porque ya había votado en esta encuesta o no tiene permiso para votar';
		$this->post_cant_poll = 'As a guest, you do not have permission to create polls. If you register, you may be able to create them.'; //Translate
		$this->post_cant_poll1 = 'No tiene permiso para crear encuestas';
		$this->post_cant_reply = 'No tiene permiso para responder a tópicos en este foro';
		$this->post_cant_reply1 = 'Como Invitado, no tiene permiso para responder a tópicos. Si lo desea, puede registrarse para hacerlo';
		$this->post_cant_reply2 = 'You do not have permission to reply to topics.'; //Translate
		$this->post_closed = 'Este tópico ha sido cerrado';
		$this->post_create_poll = 'Crear encuesta';
		$this->post_create_topic = 'Crear tópico';
		$this->post_creating = 'Creando tópico';
		$this->post_creating_poll = 'Creando Encuesta';
		$this->post_flood = 'Ha hecho una publicación en los pasados %s segundos, y no puede hacerlo ahora mismo.<br /><br />Por favor intente más tarde.';
		$this->post_guest = 'Invitado';
		$this->post_icon = 'Ícono de publicación';
		$this->post_last_five = 'Ultimas cinco publicaciones en orden inverso';
		$this->post_length = 'Revise la longitud';
		$this->post_msg = 'Mensaje';
		$this->post_must_msg = 'Debe incluir un mensaje cuando publica';
		$this->post_must_options = 'Debe incluir opciones cuando crea una encuesta';
		$this->post_must_title = 'Debe incluir un titulo cuando crea un tópico';
		$this->post_new_poll = 'Nueva Encuesta';
		$this->post_new_topic = 'Nuevo tópico';
		$this->post_no_forum = 'El foro no fue encontrado';
		$this->post_no_topic = 'No fue especificado ningun tópico';
		$this->post_no_vote = 'Debe escojer una opcion para votar por esta';
		$this->post_option_emoticons = 'Convertir emoticons a imagenes?';
		$this->post_option_global = 'Make this topic global?'; //Translate
		$this->post_option_mbcode = 'Formatear MbCode?';
		$this->post_optional = 'opcional';
		$this->post_options = 'Opciones';
		$this->post_poll_options = 'Opciones de encuesta';
		$this->post_poll_row = 'Uno por línea';
		$this->post_posted = 'Publicado en';
		$this->post_posting = 'Publicando';
		$this->post_preview = 'Preview'; //Translate
		$this->post_reply = 'Responder';
		$this->post_reply_topic = 'Responder al tópico';
		$this->post_replying = 'Respondiendo a tópico';
		$this->post_replying1 = 'Respondiendo';
		$this->post_too_many_options = 'Tiene entre 2 y %d opciones para una encuesta';
		$this->post_topic_detail = 'Descripción del tópico';
		$this->post_topic_title = 'Titulo del tópico';
		$this->post_view_topic = 'Ver el tópico completo';
		$this->post_voting = 'Votando';
	}

	function printer()
	{
		$this->printer_back = 'Atras';
		$this->printer_not_found = 'El tópico no fue encontrado, pudo haber sido borrado, movido o pudo nunca haber existido';
		$this->printer_not_found_title = 'tópico no encontrado';
		$this->printer_perm_topics = 'No tiene permiso para ver los tópicos';
		$this->printer_perm_topics_guest = 'No tiene permiso para ver los tópicos, si desea inscribirse, podrá hacerlo';
		$this->printer_posted_on = 'Publicado el';
		$this->printer_send = 'Enviado a la impresora';
	}

	function profile()
	{
		$this->profile_aim_sn = 'AIM Name'; //Translate
		$this->profile_av_sign = 'Avatar y Firma';
		$this->profile_avatar = 'Avatar'; //Translate
		$this->profile_bday = 'Cumpleaños';
		$this->profile_contact = 'Contacto';
		$this->profile_email_address = 'Correo electrónico';
		$this->profile_fav = 'Forum Favorito';
		$this->profile_fav_forum = '%s (%d%% of this member\'s posts)'; //Translate
		$this->profile_gtalk = 'GTalk Account'; //Translate
		$this->profile_icq_uin = 'Numero ICQ';
		$this->profile_info = 'Informacion';
		$this->profile_interest = 'Intereses';
		$this->profile_joined = 'Joined'; //Translate
		$this->profile_last_post = 'Ultima publicación';
		$this->profile_list = 'Lista de Miembros';
		$this->profile_location = 'Ubicacion';
		$this->profile_member = 'Grupo de Miembros';
		$this->profile_member_title = 'Titulo de Miembro';
		$this->profile_msn = 'Identidad MSN';
		$this->profile_must_user = 'Debe de teclear un nombre de usuario para ver su perfíl';
		$this->profile_no_member = 'No hay ningun miembro con esa identificacion de  Usuario. la cuenta pudo haber sido borrada';
		$this->profile_none = '[ Ninguno ]';
		$this->profile_not_post = 'No ha publicado todavia';
		$this->profile_offline = 'This member is currently offline'; //Translate
		$this->profile_online = 'This member is currently online'; //Translate
		$this->profile_pm = 'mensajes privados';
		$this->profile_postcount = '%s total, %s per day'; //Translate
		$this->profile_posts = 'Publicaciones';
		$this->profile_private = '[ Privado ]';
		$this->profile_profile = 'perfíl';
		$this->profile_signature = 'Firma';
		$this->profile_unkown = '[ Desconocido ]';
		$this->profile_view_profile = 'Desplegando perfíl';
		$this->profile_www = 'Pagina Personal';
		$this->profile_yahoo = 'Identidad de Yahoo!';
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
		$this->recent_by = 'De';
		$this->recent_can_post = 'Puede contester en este foro';
		$this->recent_can_topics = 'Puede ver tópicos en este foro';
		$this->recent_cant_post = 'No puede responder en este foro';
		$this->recent_cant_topics = 'No puede ver tópicos en este foro';
		$this->recent_dot = 'punto';
		$this->recent_dot_detail = 'Muestra que ha publicado o contestado en este tópico';
		$this->recent_forum = 'Foro';
		$this->recent_guest = 'Invitado';
		$this->recent_hot = 'Activo';
		$this->recent_icon = 'Ícono de Mensaje';
		$this->recent_jump = 'Brincar al tópico más reciente';
		$this->recent_last = 'Ultima publicación';
		$this->recent_locked = 'Bloqueado';
		$this->recent_moved = 'Movido';
		$this->recent_msg = '%s Mensaje';
		$this->recent_new = 'Nuevo';
		$this->recent_new_poll = 'Crear una nueva encuesta';
		$this->recent_new_topic = 'Crear nuevo tópico';
		$this->recent_no_topics = 'No hay tópicos para desplegar en este foro';
		$this->recent_noexist = 'El foro especificado no existe';
		$this->recent_nopost = 'No hay publicaciones';
		$this->recent_not = 'No';
		$this->recent_noview = 'No tiene permiso para ver foros';
		$this->recent_pages = 'Paginas';
		$this->recent_pinned = 'Fijado';
		$this->recent_pinned_topic = 'tópico Fijado';
		$this->recent_poll = 'Encuesta';
		$this->recent_regfirst = 'No tiene permiso para ver los foros, si se registra, podrá hacerlo';
		$this->recent_replies = 'Respuestas';
		$this->recent_starter = 'Iniciador';
		$this->recent_sub = 'Sub-Foro';
		$this->recent_sub_last_post = 'Ultima publicación';
		$this->recent_sub_replies = 'Respuestas';
		$this->recent_sub_topics = 'tópicos';
		$this->recent_subscribe = 'Notificarme via correo electrónico cuando se publique en este foro';
		$this->recent_topic = 'tópico';
		$this->recent_views = 'Vistas';
		$this->recent_write_topics = 'Puede crear tópicos en este foro';
	}

	function register()
	{
		$this->register_activated = 'Su cuenta ha sido activada!';
		$this->register_activating = 'Activacion de cuenta';
		$this->register_activation_error = 'Ha habido un error al activar su cuenta, verifique si su navegador contiene la cadena completa (url) enviada por correo. Si el problema persiste, contacte al administrador del sistema para reenviar el correo.';
		$this->register_confirm_passwd = 'Confirmar Password';
		$this->register_done = 'ya ha sido registrado, ahora se podrá firmar normalmente';
		$this->register_email = 'Correo electrónico';
		$this->register_email_invalid = 'La cuenta de correo electrónico es invalida, por favor verifiquela';
		$this->register_email_msg = 'This is an automated email generated by Quicksilver Forums, and sent to you in order'; //Translate
		$this->register_email_msg2 = 'for you to activate your account with'; //Translate
		$this->register_email_msg3 = 'Please click the following link, or paste it in to your web browser:'; //Translate
		$this->register_email_used = 'La cuenta de correo electrónico ya esta registrada por otro miembro';
		$this->register_fields = 'No todos los campos estan completos';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = 'Please type the text shown in the image.'; //Translate
		$this->register_image_invalid = 'To verify you are a human registrant, you must type the text as shown in the image.'; //Translate
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'You have been registered. An email has been sent to %s with information on how to activate your account. Your account will be limited until you activate it.'; //Translate
		$this->register_name_invalid = 'El nombre que tecleo es demasiado largo';
		$this->register_name_taken = 'El Nomre Usuario ya esta en uso por otro miembro';
		$this->register_new_user = 'Nombre de usuario deseado';
		$this->register_pass_invalid = 'El password que tecleo no es valido. Verifique que contiene caracteres validos como letras, numeros, guiones, o espacios, y que tengan por lo menos 5 caracteres';
		$this->register_pass_match = 'Los passwords especificados no coinciden';
		$this->register_passwd = 'Password'; //Translate
		$this->register_reg = 'Registro';
		$this->register_reging = 'Registrandose';
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
		$this->search_advanced = 'Opciones Advanzadas';
		$this->search_avatar = 'Avatar'; //Translate
		$this->search_basic = 'Busqueda Basica';
		$this->search_characters = 'Caracteres de la publicación';
		$this->search_day = 'dia';
		$this->search_days = 'dias';
		$this->search_exact_name = 'Nombre exacto';
		$this->search_flood = 'You have searched in the past %s seconds, and you may not search right now.<br /><br />Please try again in a few seconds.'; //Translate
		$this->search_for = 'Buscar';
		$this->search_forum = 'Foro';
		$this->search_group = 'Group'; //Translate
		$this->search_guest = 'Invitado';
		$this->search_in = 'Buscar en';
		$this->search_in_posts = 'Buscar solo en publicaciones';
		$this->search_ip = 'IP'; //Translate
		$this->search_joined = 'Joined'; //Translate
		$this->search_level = 'Member Level'; //Translate
		$this->search_match = 'Buscar por coincidencia';
		$this->search_matches = 'Coincidencias';
		$this->search_month = 'Mes';
		$this->search_months = 'months'; //Translate
		$this->search_mysqldoc = 'Documentacion MySQL';
		$this->search_newer = 'Más reciente';
		$this->search_no_results = 'Su busqueda no produjo resultados';
		$this->search_no_words = 'Debe especificar algunos términos para buscar.<br /><br />Cada uno de los términos de busqueda deberan ser de más de 4 caracteres, incluyendo Letras, Numeros, apostrofes y guiones bajos';
		$this->search_offline = 'This member is currently offline'; //Translate
		$this->search_older = 'Más antiguo';
		$this->search_online = 'This member is currently online'; //Translate
		$this->search_only_display = 'Solo desplegar el primero';
		$this->search_partial_name = 'Nombre parcial';
		$this->search_post_icon = 'Ícono de publicación';
		$this->search_posted_on = 'Publicado en';
		$this->search_posts = 'Publicaciones';
		$this->search_posts_by = 'Solo publicaciones hechas por';
		$this->search_regex = 'Buscar por expresiones regulares';
		$this->search_regex_failed = 'Su expresion regular fallo, por favor revise la documentacion de MySQL para la ayuda de expresiones regulares';
		$this->search_relevance = 'Relevancia de la publicación: %d%%';
		$this->search_replies = 'publicación';
		$this->search_result = 'Resultados de la busqueda';
		$this->search_search = 'Buscar';
		$this->search_select_all = 'Seleccionar todos';
		$this->search_show_posts = 'Mostrar publicaciones coincidentes';
		$this->search_sound = 'Buscar foneticamente';
		$this->search_starter = 'Iniciador';
		$this->search_than = 'than'; //Translate
		$this->search_topic = 'tópico';
		$this->search_unreg = 'Unregistered'; //Translate
		$this->search_week = 'Semana';
		$this->search_weeks = 'Semanas';
		$this->search_year = 'Año';
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
		$this->topic_attached = 'Archivo anexo:';
		$this->topic_attached_downloads = 'Descargas';
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = 'Usted no tiene permiso para descargar este archivo.';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = 'Archivo anexo';
		$this->topic_avatar = 'Avatar'; //Translate
		$this->topic_bottom = 'Go to the bottom of the page'; //Translate
		$this->topic_create_poll = 'Crear una nueva encuesta';
		$this->topic_create_topic = 'Crear un nuevo tópico';
		$this->topic_delete = 'Borrar';
		$this->topic_delete_post = 'Borrar esta publicación';
		$this->topic_edit = 'Editar';
		$this->topic_edit_post = 'Editar esta publicación';
		$this->topic_edited = 'La ultima modificacuón fue %s hecha por %s';
		$this->topic_error = 'Error'; //Translate
		$this->topic_group = 'Grupo';
		$this->topic_guest = 'Invitado';
		$this->topic_ip = 'IP'; //Translate
		$this->topic_joined = 'Se unio';
		$this->topic_level = 'Nivel de Miembro';
		$this->topic_links_aim = 'enviar un mensaje AIM a%s';
		$this->topic_links_email = 'Enviar correo electrónico a %s';
		$this->topic_links_gtalk = 'Send a GTalk message to %s'; //Translate
		$this->topic_links_icq = 'Enviar Mensaje ICQ a %s';
		$this->topic_links_msn = 'Ver el peril de MSN de %s';
		$this->topic_links_pm = 'Enviar un mensaje personal a %s';
		$this->topic_links_web = 'Visitar el sitio web de %s';
		$this->topic_links_yahoo = 'Enviar un mensaje a %s con Yahoo! Messenger';
		$this->topic_lock = 'Bloquear';
		$this->topic_locked = 'tópico bloqueado';
		$this->topic_move = 'Mover';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = 'Newer Topic'; //Translate
		$this->topic_no_newer = 'There is no newer topic.'; //Translate
		$this->topic_no_older = 'There is no older topic.'; //Translate
		$this->topic_no_votes = 'No existen votos para esta encuesta';
		$this->topic_not_found = 'tópico No encontrado';
		$this->topic_not_found_message = 'El tópico no fue encontrado, pudo haber sido borrado, movido o pudo nunca haber existido';
		$this->topic_offline = 'This member is currently offline'; //Translate
		$this->topic_older = 'Older Topic'; //Translate
		$this->topic_online = 'This member is currently online'; //Translate
		$this->topic_options = 'Opciones de tópico';
		$this->topic_pages = 'Paginas';
		$this->topic_perm_view = 'No tiene permiso de ver estos tópicos';
		$this->topic_perm_view_guest = 'No tiene permiso de ver estos tópicos, si se registra, podrá hacerlo';
		$this->topic_pin = 'Fijar';
		$this->topic_posted = 'Posted'; //Translate
		$this->topic_posts = 'Publicaciones';
		$this->topic_print = 'Ver versión imprimible';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'Emoticons'; //Translate
		$this->topic_qr_open_emoticons = 'Open Clickable Emoticons'; //Translate
		$this->topic_qr_open_mbcode = 'Open MBCode'; //Translate
		$this->topic_quickreply = 'Quick Reply'; //Translate
		$this->topic_quote = 'Responder citando a esta publicación';
		$this->topic_reply = 'Responder al tópico';
		$this->topic_split = 'Split'; //Translate
		$this->topic_split_finish = 'Finish All Splitting'; //Translate
		$this->topic_split_keep = 'Do not move this post'; //Translate
		$this->topic_split_move = 'Move this post'; //Translate
		$this->topic_subscribe = 'Enviarme correo electrónico cuando otros respondan a este tópico';
		$this->topic_top = 'Go to the top of the page'; //Translate
		$this->topic_unlock = 'Desbloquear';
		$this->topic_unpin = 'Quitar la fijación';
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = 'No registrado';
		$this->topic_view = 'Ver resultados';
		$this->topic_viewing = 'Desplegando tópico';
		$this->topic_vote = 'Vote'; //Translate
		$this->topic_vote_count_plur = '%d votos';
		$this->topic_vote_count_sing = '%d voto';
		$this->topic_votes = 'Votos';
	}

	function universal()
	{
		$this->aim = 'AIM'; //Translate
		$this->based_on = 'based on';
		$this->board_by = 'Por';
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
		$this->submit = 'Enviar';
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
