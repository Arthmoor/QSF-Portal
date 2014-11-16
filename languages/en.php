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
 * English language module
 *
 * @author Jason Warner <jason@mercuryboard.com>
 * @since 1.0.0 Beta 3.0
 **/
class en
{
	function active()
	{
		$this->active_last_action = 'Last Action';
		$this->active_modules_active = 'Viewing the active users';
		$this->active_modules_board = 'Viewing the board index';
		$this->active_modules_cp = 'Using the control panel';
		$this->active_modules_forum = 'Viewing a forum: %s';
		$this->active_modules_help = 'Viewing a help topic';
		$this->active_modules_login = 'Logging in or out';
		$this->active_modules_members = 'Viewing the member list';
		$this->active_modules_mod = 'Moderating';
		$this->active_modules_pm = 'Using the messenger';
		$this->active_modules_post = 'Posting';
		$this->active_modules_printer = 'Printing a topic: %s';
		$this->active_modules_profile = 'Viewing a profile: %s';
		$this->active_modules_recent = 'Viewing recent posts';
		$this->active_modules_search = 'Searching';
		$this->active_modules_topic = 'Viewing a topic: %s';
		$this->active_time = 'Time';
		$this->active_user = 'User';
		$this->active_users = 'Active Users';
	}

	function admin()
	{
		$this->admin_add_emoticons = 'Add emoticons';
		$this->admin_add_member_titles = 'Add automatic member titles';
		$this->admin_add_templates = 'Add HTML templates';
		$this->admin_ban_ips = 'Ban IP addresses';
		$this->admin_censor = 'Censor words';
		$this->admin_cp_denied = 'Access Denied';
		$this->admin_cp_warning = 'The Admin CP is disabled until you delete your <b>install</b> directory, as it poses a serious security risk.';
		$this->admin_create_forum = 'Create a forum';
		$this->admin_create_group = 'Create a group';
		$this->admin_create_help = 'Create a help article';
		$this->admin_create_skin = 'Create a skin';
		$this->admin_db = 'Database';
		$this->admin_db_backup = 'Backup the database';
		$this->admin_db_conn = 'Edit connection settings';
		$this->admin_db_optimize = 'Optimize the database';
		$this->admin_db_query = 'Execute an SQL query';
		$this->admin_db_restore = 'Restore a backup';
		$this->admin_delete_forum = 'Delete a forum';
		$this->admin_delete_group = 'Delete a group';
		$this->admin_delete_help = 'Delete a help article';
		$this->admin_delete_member = 'Delete a member';
		$this->admin_delete_template = 'Delete HTML template';
		$this->admin_edit_emoticons = 'Edit or delete emoticons';
		$this->admin_edit_forum = 'Edit a forum';
		$this->admin_edit_group_name = 'Edit a group\'s name';
		$this->admin_edit_group_perms = 'Edit a group\'s permissions';
		$this->admin_edit_help = 'Edit a help article';
		$this->admin_edit_member = 'Edit a member';
		$this->admin_edit_member_perms = 'Edit a member\'s permissions';
		$this->admin_edit_member_titles = 'Edit or delete automatic member titles';
		$this->admin_edit_settings = 'Edit board settings';
		$this->admin_edit_skin = 'Edit or delete a skin';
		$this->admin_edit_templates = 'Edit HTML templates';
		$this->admin_emoticons = 'Emoticons';
		$this->admin_export_skin = 'Export a skin';
		$this->admin_fix_stats = 'Fix the member statistics';
		$this->admin_forum_order = 'Change the forum ordering';
		$this->admin_forums = 'Forums and Categories';
		$this->admin_groups = 'Groups';
		$this->admin_heading = 'Quicksilver Forums Admin Control Panel';
		$this->admin_help = 'Help Articles';
		$this->admin_install_emoticons = 'Install emoticons';
		$this->admin_install_skin = 'Install a skin';
		$this->admin_logs = 'View moderator actions';
		$this->admin_mass_mail = 'Send an email to your members';
		$this->admin_members = 'Members';
		$this->admin_phpinfo = 'View PHP information';
		$this->admin_prune = 'Prune old topics';
		$this->admin_recount_forums = 'Recount topics and replies';
		$this->admin_settings = 'Settings';
		$this->admin_settings_add = 'Add new board setting';
		$this->admin_skins = 'Skins';
		$this->admin_stats = 'Statistics center';
		$this->admin_upgrade_skin = 'Upgrade a Skin';
		$this->admin_your_board = 'Your Board';
	}

	function backup()
	{
		$this->backup_create = 'Backup Database';
		$this->backup_createfile = 'Backup and create a file on server';
		$this->backup_done = 'The database has been backed up to the packages directory.';
		$this->backup_download = 'Backup and download (recommended)';
		$this->backup_found = 'The following backups were found in the packages directory';
		$this->backup_invalid = 'The backup does not appear to be valid. No changes were made to your database.';
		$this->backup_none = 'No backups were found in the packages directory.';
		$this->backup_options = 'Select how you want your backup created';
		$this->backup_restore = 'Restore Backup';
		$this->backup_restore_done = 'The database has been restored successfully.';
		$this->backup_warning = 'Warning: This will overwrite all existing data used by Quicksilver Forums.';
	}

	function ban()
	{
		$this->ban = 'Ban';
		$this->ban_banned_ips = 'Ban IP Addresses';
		$this->ban_banned_members = 'Banned Members';
		$this->ban_ip = 'Ban IP Addresses';
		$this->ban_member_explain1 = 'To ban users, change their user group to';
		$this->ban_member_explain2 = 'in the member controls.';
		$this->ban_members = 'Ban Members';
		$this->ban_nomembers = 'There are currently no banned members.';
		$this->ban_one_per_line = 'One address per line.';
		$this->ban_regex_allowed = 'Regular expressions are allowed. You can use a single * as a wildcard for one or more digits.';
		$this->ban_settings = 'Ban Settings';
		$this->ban_users_banned = 'Users banned.';
	}

	function bbcode()
	{
		$this->bbcode_arial = 'Arial';
		$this->bbcode_blue = 'Blue';
		$this->bbcode_bold = 'Bold (CTRL-b)';
		$this->bbcode_bold1 = 'B';
		$this->bbcode_chocolate = 'Chocolate';
		$this->bbcode_code = 'Code (CTRL-l)';
		$this->bbcode_code1 = 'Code';
		$this->bbcode_color = 'Color';
		$this->bbcode_coral = 'Coral';
		$this->bbcode_courier = 'Courier';
		$this->bbcode_crimson = 'Crimson';
		$this->bbcode_darkblue = 'Dark Blue';
		$this->bbcode_darkred = 'Dark Red';
		$this->bbcode_deeppink = 'Deep Pink';
		$this->bbcode_email = 'Email (CTRL-e)';
		$this->bbcode_firered = 'Firebrick Red';
		$this->bbcode_font = 'Font';
		$this->bbcode_green = 'Green';
		$this->bbcode_huge = 'Huge';
		$this->bbcode_image = 'Image (CTRL-j)';
		$this->bbcode_image1 = 'IMG';
		$this->bbcode_impact = 'Impact';
		$this->bbcode_indigo = 'Indigo';
		$this->bbcode_italic = 'Italic (CTRL-i)';
		$this->bbcode_italic1 = 'I';
		$this->bbcode_large = 'Large';
		$this->bbcode_limegreen = 'Lime Green';
		$this->bbcode_medium = 'Medium';
		$this->bbcode_orange = 'Orange';
		$this->bbcode_orangered = 'Orange Red';
		$this->bbcode_php = 'PHP (CTRL-k)';
		$this->bbcode_php1 = 'PHP';
		$this->bbcode_purple = 'Purple';
		$this->bbcode_quote = 'Quote (CTRL-q)';
		$this->bbcode_quote1 = 'Quote';
		$this->bbcode_red = 'Red';
		$this->bbcode_royalblue = 'Royal Blue';
		$this->bbcode_sandybrown = 'Sandy Brown';
		$this->bbcode_seagreen = 'Sea Green';
		$this->bbcode_sienna = 'Sienna';
		$this->bbcode_silver = 'Silver';
		$this->bbcode_size = 'Size';
		$this->bbcode_skyblue = 'Sky Blue';
		$this->bbcode_small = 'Small';
		$this->bbcode_spoiler = 'Spoiler (CTRL-r)';
		$this->bbcode_spoiler1 = 'Spoiler';
		$this->bbcode_strike = 'Strikethrough (CTRL-s)';
		$this->bbcode_strike1 = 'S';
		$this->bbcode_tahoma = 'Tahoma';
		$this->bbcode_teal = 'Teal';
		$this->bbcode_times = 'Times';
		$this->bbcode_tiny = 'Tiny';
		$this->bbcode_tomato = 'Tomato';
		$this->bbcode_underline = 'Underline (CTRL-u)';
		$this->bbcode_underline1 = 'U';
		$this->bbcode_url = 'URL (CTRL-h)';
		$this->bbcode_url1 = 'URL';
		$this->bbcode_verdana = 'Verdana';
		$this->bbcode_wood = 'Burly Wood';
		$this->bbcode_yellow = 'Yellow';
	}

	function board()
	{
		$this->board_active_users = 'Active Users';
		$this->board_birthdays = 'Today\'s Birthdays';
		$this->board_bottom_page = 'Go to the bottom of the page';
		$this->board_can_post = 'You can reply in this forum.';
		$this->board_can_topics = 'You can view but not create topics in this forum.';
		$this->board_cant_post = 'You cannot reply in this forum.';
		$this->board_cant_topics = 'You cannot view or create topics in this forum.';
		$this->board_forum = 'Forum';
		$this->board_guests = 'guests';
		$this->board_last_post = 'Last Post';
		$this->board_mark = 'Marking Posts As Read';
		$this->board_mark1 = 'All posts and forums have been marked as read.';
		$this->board_markforum = 'Marking Forum As Read';
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.';
		$this->board_members = 'members';
		$this->board_message = '%s Message';
		$this->board_most_online = 'The most users ever online was %d on %s.';
		$this->board_nobday = 'There are no member birthdays today.';
		$this->board_nobody = 'There are currently no members online.';
		$this->board_nopost = 'No Posts';
		$this->board_noview = 'You do not have permission to view the board.';
		$this->board_regfirst = 'You do not have permission to view the board. If you register, you may be able to.';
		$this->board_replies = 'Replies';
		$this->board_stats = 'Statistics';
		$this->board_stats_string = '%s users have registered. Welcome to our newest member, %s.<br />There are %s topics and %s replies for a total of %s posts.';
		$this->board_top_page = 'Go to the top of the page';
		$this->board_topics = 'Topics';
		$this->board_users = 'users';
		$this->board_write_topics = 'You can view and create topics in this forum.';
	}

	function censoring()
	{
		$this->censor = 'Censor Words';
		$this->censor_one_per_line = 'One per line.';
		$this->censor_regex_allowed = 'Regular expressions are allowed. You can use a single * as a wildcard for one or more characters.';
		$this->censor_updated = 'Word list updated.';
	}

	function cp()
	{
		$this->cp_aim = 'AIM Screen Name';
		$this->cp_already_member = 'The email address you entered is already assigned to a member.';
		$this->cp_apr = 'April';
		$this->cp_aug = 'August';
		$this->cp_avatar_current = 'Your current avatar';
		$this->cp_avatar_error = 'Avatar Error';
		$this->cp_avatar_must_select = 'You must select an avatar.';
		$this->cp_avatar_none = 'Do not use an avatar';
		$this->cp_avatar_pixels = 'pixels';
		$this->cp_avatar_select = 'Select an avatar';
		$this->cp_avatar_size_height = 'Your avatar height must be between 1 and';
		$this->cp_avatar_size_width = 'Your avatar width must be between 1 and';
		$this->cp_avatar_upload = 'Upload an avatar from your hard drive';
		$this->cp_avatar_upload_failed = 'The avatar upload failed. The file you specified may not exist.';
		$this->cp_avatar_upload_not_image = 'You can only upload images to be used for your avatar.';
		$this->cp_avatar_upload_too_large = 'The avatar you specified to upload is too large. The maximum size is %d kilobytes.';
		$this->cp_avatar_url = 'Specify a URL for your avatar';
		$this->cp_avatar_use = 'Use your uploaded avatar';
		$this->cp_bday = 'Birthday';
		$this->cp_been_updated = 'Your profile has been updated.';
		$this->cp_been_updated1 = 'Your avatar has been updated.';
		$this->cp_been_updated_prefs = 'Your preferences have been updated.';
		$this->cp_changing_pass = 'Editing Password';
		$this->cp_contact_pm = 'Allow others to contact you via the messenger?';
		$this->cp_cp = 'Control Panel';
		$this->cp_current_avatar = 'Current Avatar';
		$this->cp_current_time = 'It is currently %s.';
		$this->cp_custom_title = 'Custom Member Title';
		$this->cp_custom_title2 = 'This is a privledge reserved for board administrators';
		$this->cp_dec = 'December';
		$this->cp_editing_avatar = 'Editing Avatar';
		$this->cp_editing_profile = 'Editing Profile';
		$this->cp_email = 'Email';
		$this->cp_email_form = 'Allow others to contact you via the email form?';
		$this->cp_email_invaid = 'The email address you entered is invalid.';
		$this->cp_err_avatar = 'Error Updating Avatar';
		$this->cp_err_updating = 'Error Updating Profile';
		$this->cp_feb = 'February';
		$this->cp_file_type = 'The avatar you entered is not valid. Make sure the url is correctly formatted, and the file type is either gif, jpg, or png.';
		$this->cp_format = 'Name Formatting';
		$this->cp_gtalk = 'GTalk Account';
		$this->cp_header = 'User Control Panel';
		$this->cp_height = 'Height';
		$this->cp_icq = 'ICQ Number';
		$this->cp_interest = 'Interests';
		$this->cp_jan = 'January';
		$this->cp_july = 'July';
		$this->cp_june = 'June';
		$this->cp_label_edit_avatar = 'Edit Avatar';
		$this->cp_label_edit_pass = 'Edit Password';
		$this->cp_label_edit_prefs = 'Edit Preferences';
		$this->cp_label_edit_profile = 'Edit Profile';
		$this->cp_label_edit_sig = 'Edit Signature';
		$this->cp_label_edit_subs = 'Edit Subscriptions';
		$this->cp_language = 'Language';
		$this->cp_less_charac = 'Your name must be less than 32 characters.';
		$this->cp_location = 'Location';
		$this->cp_login_first = 'You must be logged in to access your control panel.';
		$this->cp_mar = 'March';
		$this->cp_may = 'May';
		$this->cp_msn = 'MSN Identity';
		$this->cp_must_orig = 'Your name must be identical to the original. You may only change the letter case and spacing.';
		$this->cp_new_notmatch = 'The new passwords you entered do not match.';
		$this->cp_new_pass = 'New Password';
		$this->cp_no_flash = 'Flash avatars are not allowed on this board.';
		$this->cp_not_exist = 'The date you specified (%s) does not exist!';
		$this->cp_nov = 'November';
		$this->cp_oct = 'October';
		$this->cp_old_notmatch = 'The old password you entered does not match the one in our database.';
		$this->cp_old_pass = 'Old Password';
		$this->cp_pass_notvaid = 'Your password is not valid. Make sure it uses only valid characters such as letters, numbers, dashes, underscores, or spaces.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.';
		$this->cp_preferences = 'Changing Preferences';
		$this->cp_preview_sig = 'Signature Preview:';
		$this->cp_privacy = 'Privacy Options';
		$this->cp_repeat_pass = 'Repeat New Password';
		$this->cp_sept = 'September';
		$this->cp_show_active = 'Show your activities when you are using the board?';
		$this->cp_show_email = 'Show email address in profile?';
		$this->cp_signature = 'Signature';
		$this->cp_size_max = 'The avatar size you entered is too large. The maximum size allowed is %s by %s pixels.';
		$this->cp_skin = 'Board Skin';
		$this->cp_sub_change = 'Changing Subscriptions';
		$this->cp_sub_delete = 'Delete';
		$this->cp_sub_expire = 'Expiration Date';
		$this->cp_sub_name = 'Subscription Name';
		$this->cp_sub_no_params = 'No parameters were given.';
		$this->cp_sub_success = 'You are now subscribed to this %s.';
		$this->cp_sub_type = 'Subscription Type';
		$this->cp_sub_updated = 'Selected subscriptions have been deleted.';
		$this->cp_topic_option = 'Topic Options';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.';
		$this->cp_updated = 'Profile Updated';
		$this->cp_updated1 = 'Avatar Updated';
		$this->cp_updated_prefs = 'Preferences Updated';
		$this->cp_user_exists = 'A user with that name formatting already exists.';
		$this->cp_valided = 'Your password was validated and changed.';
		$this->cp_view_avatar = 'View Avatars?';
		$this->cp_view_emoticon = 'View Emoticons?';
		$this->cp_view_signature = 'View Signatures?';
		$this->cp_welcome = 'Welcome to the user control panel. From here, you can configure your account. Please choose from the options above.';
		$this->cp_width = 'Width';
		$this->cp_www = 'Homepage';
		$this->cp_yahoo = 'Yahoo Identity';
		$this->cp_zone = 'Time Zone';
	}

	function email()
	{
		$this->email_blocked = 'That member is not accepting email through this form.';
		$this->email_email = 'Email';
		$this->email_msgtext = 'Email Body:';
		$this->email_no_fields = 'Go back and make sure that all fields are filled in.';
		$this->email_no_member = 'No member was found by that name';
		$this->email_no_perm = 'You do not have permission to send email through the board.';
		$this->email_sent = 'Your email has been sent.';
		$this->email_subject = 'Subject:';
		$this->email_to = 'To:';
	}

	function emot_control()
	{
		$this->emote = 'Emoticons';
		$this->emote_add = 'Add Emoticons';
		$this->emote_added = 'Emoticon added.';
		$this->emote_clickable = 'Clickable';
		$this->emote_edit = 'Edit Emoticons';
		$this->emote_image = 'Image';
		$this->emote_install = 'Install Emoticons';
		$this->emote_install_done = 'Emoticons have been successfully reinstalled.';
		$this->emote_install_warning = 'This will erase all existing emoticon settings and import uploaded emoticons from your currently selected skin into the database.';
		$this->emote_no_text = 'No emoticon text was given.';
		$this->emote_text = 'Text';
	}

	function forum()
	{
		$this->forum_by = 'By';
		$this->forum_can_post = 'You can reply in this forum.';
		$this->forum_can_topics = 'You can view topics in this forum.';
		$this->forum_cant_post = 'You cannot reply in this forum.';
		$this->forum_cant_topics = 'You cannot view topics in this forum.';
		$this->forum_dot = 'dot';
		$this->forum_dot_detail = 'Shows that you have posted in the topic';
		$this->forum_forum = 'Forum';
		$this->forum_guest = 'Guest';
		$this->forum_hot = 'Hot';
		$this->forum_icon = 'Message Icon';
		$this->forum_jump = 'Jump to newest post in topic';
		$this->forum_last = 'Last Post';
		$this->forum_locked = 'Locked';
		$this->forum_mark_read = 'Mark forum as read';
		$this->forum_moved = 'Moved';
		$this->forum_msg = '%s Message';
		$this->forum_new = 'New';
		$this->forum_new_poll = 'Create New Poll';
		$this->forum_new_topic = 'Create New Topic';
		$this->forum_no_topics = 'There are no topics to display for this forum.';
		$this->forum_noexist = 'The specified forum does not exist.';
		$this->forum_nopost = 'No posts';
		$this->forum_not = 'Not';
		$this->forum_noview = 'You do not have permission to view forums.';
		$this->forum_pages = 'Pages';
		$this->forum_pinned = 'Pinned';
		$this->forum_pinned_topic = 'Pinned Topic';
		$this->forum_poll = 'Poll';
		$this->forum_regfirst = 'You do not have permission to view forums. If you register, you may be able to.';
		$this->forum_replies = 'Replies';
		$this->forum_starter = 'Starter';
		$this->forum_sub = 'Sub-Forum';
		$this->forum_sub_last_post = 'Last Post';
		$this->forum_sub_replies = 'Replies';
		$this->forum_sub_topics = 'Topics';
		$this->forum_subscribe = 'E-mail me when posts are made in this forum';
		$this->forum_topic = 'Topic';
		$this->forum_views = 'Views';
		$this->forum_write_topics = 'You can create topics in this forum.';
	}

	function forums()
	{
		$this->forum_controls = 'Forum Controls';
		$this->forum_create = 'Create Forum';
		$this->forum_create_cat = 'Create a Category';
		$this->forum_created = 'Forum Created';
		$this->forum_default_perms = 'Default Permissions';
		$this->forum_delete = 'Delete Forum';
		$this->forum_delete_warning = 'Are you sure you want to delete this forum, its topics, and its posts?<br />This action cannot be reversed.';
		$this->forum_deleted = 'The forum has been deleted.';
		$this->forum_description = 'Description';
		$this->forum_edit = 'Edit Forum';
		$this->forum_edited = 'The forum was edited successfully.';
		$this->forum_empty = 'The forum name is empty. Please go back and enter a name.';
		$this->forum_is_subcat = 'This forum is a subcategory only.';
		$this->forum_name = 'Name';
		$this->forum_no_orphans = 'You cannot orphan a forum by deleting its parent.';
		$this->forum_none = 'There are no forums to manipulate.';
		$this->forum_ordered = 'Forum Order Updated';
		$this->forum_ordering = 'Change Forum Ordering';
		$this->forum_parent = 'You can\'t change a forum\'s parent in that way.';
		$this->forum_parent_cat = 'Parent Category';
		$this->forum_quickperm_select = 'Select an existing forum to copy its permissions.';
		$this->forum_quickperms = 'Quick Permissions';
		$this->forum_recount = 'Recount Topics and Replies';
		$this->forum_select_cat = 'Select an existing category to create a forum.';
		$this->forum_subcat = 'Subcategory';
	}

	function groups()
	{
		$this->groups_bad_format = 'You must use %s in the format, which represents the group name.';
		$this->groups_based_on = 'based on';
		$this->groups_create = 'Create Group';
		$this->groups_create_new = 'Create a new user group named';
		$this->groups_created = 'Group Created';
		$this->groups_delete = 'Delete Group';
		$this->groups_deleted = 'Group Deleted.';
		$this->groups_edit = 'Edit Group';
		$this->groups_edited = 'Group Edited.';
		$this->groups_formatting = 'Display Formatting';
		$this->groups_i_confirm = 'I confirm that I want to delete this member group.';
		$this->groups_name = 'Name';
		$this->groups_no_action = 'No action was taken.';
		$this->groups_no_delete = 'There are no custom groups to delete.<br />The core groups are necessary for Quicksilver Forums to function, and cannot be deleted.';
		$this->groups_no_group = 'No group was specified.';
		$this->groups_no_name = 'No group name was given.';
		$this->groups_only_custom = 'Note: You can only delete custom member groups. The core groups are necessary for Quicksilver Forums to function.';
		$this->groups_the = 'The group';
		$this->groups_to_edit = 'Group to edit';
		$this->groups_type = 'Group Type';
		$this->groups_will_be = 'will be deleted.';
		$this->groups_will_become = 'Users from the deleted group will become';
	}

	function help()
	{
		$this->help_add = 'Add Help Article';
		$this->help_article = 'Help Article Control';
		$this->help_available_files = 'Help';
		$this->help_confirm = 'Are you sure you want to delete';
		$this->help_content = 'Article content';
		$this->help_delete = 'Delete Help Article';
		$this->help_deleted = 'Help Article Deleted.';
		$this->help_edit = 'Edit Help Article';
		$this->help_edited = 'Help article updated.';
		$this->help_inserted = 'Article inserted into the database.';
		$this->help_no_articles = 'No help articles were found in the database.';
		$this->help_no_title = 'You can\'t create a help article without a title.';
		$this->help_none = 'There are no help files in the database.';
		$this->help_not_exist = 'That help article does not exist.';
		$this->help_select = 'Please select a help article to edit';
		$this->help_select_delete = 'Please select a help article to delete';
		$this->help_title = 'Title';
	}

	function home()
	{
		$this->home_choose = 'Choose a task to begin.';
		$this->home_menu_title = 'Admin CP Menu';
	}

	function jsdata()
	{
		$this->jsdata_address = 'Enter an address';
		$this->jsdata_detail = 'Enter a description';
		$this->jsdata_smiles = 'Clickable Smilies';
		$this->jsdata_url = 'URL';
	}

	function jslang()
	{
		$this->jslang_avatar_size_height = 'Your avatar height must be between 1 and %d pixels';
		$this->jslang_avatar_size_width = 'Your avatar width must be between 1 and %d pixels';
	}

	function login()
	{
		$this->login_cant_logged = 'You could not be logged in. Check to see that your user name and password are correct.<br /><br />They are case sensitive, so \'UsErNaMe\' is different from \'Username\'. Also, check to see that cookies are enabled in your browser.';
		$this->login_cookies = 'Cookies must be enabled to login.';
		$this->login_forgot_pass = 'Forgot your password?';
		$this->login_header = 'Logging In';
		$this->login_logged = 'You are now logged in.';
		$this->login_now_out = 'You are now logged out.';
		$this->login_out = 'Logging Out';
		$this->login_pass = 'Password';
		$this->login_pass_no_id = 'There is no member with the user name you entered.';
		$this->login_pass_request = 'To complete the password reset, please click on the link sent to the email address associated with your account.';
		$this->login_pass_reset = 'Reset Password';
		$this->login_pass_sent = 'Your password has been reset. The new password has been sent to the email address associated with your account.';
		$this->login_sure = 'Are you sure you wish to logoff from \'%s\'?';
		$this->login_user = 'User Name';
	}

	function logs()
	{
		$this->logs_action = 'Action';
		$this->logs_deleted_post = 'Deleted a post';
		$this->logs_deleted_topic = 'Deleted a topic';
		$this->logs_edited_post = 'Edited a post';
		$this->logs_edited_topic = 'Edited a topic';
		$this->logs_id = 'IDs';
		$this->logs_locked_topic = 'Locked a topic';
		$this->logs_moved_from = 'from forum';
		$this->logs_moved_to = 'to forum';
		$this->logs_moved_topic = 'Moved a topic';
		$this->logs_moved_topic_num = 'Moved topic #';
		$this->logs_pinned_topic = 'Pinned a topic';
		$this->logs_post = 'Post';
		$this->logs_time = 'Time';
		$this->logs_topic = 'Topic';
		$this->logs_unlocked_topic = 'Unlocked a topic';
		$this->logs_unpinned_topic = 'Unpinned a topic';
		$this->logs_user = 'User';
		$this->logs_view = 'View Moderator Actions';
	}

	function main()
	{
		$this->main_activate = 'Your account has not yet been activated.';
		$this->main_activate_resend = 'Resend Activation Email';
		$this->main_admincp = 'Admin CP';
		$this->main_banned = 'You have been banned from viewing any portion of this board.';
		$this->main_code = 'Code';
		$this->main_cp = 'Control Panel';
		$this->main_full = 'Full';
		$this->main_help = 'Help';
		$this->main_load = 'load';
		$this->main_login = 'Login';
		$this->main_logout = 'Logout';
		$this->main_mark = 'Mark all';
		$this->main_mark1 = 'Mark all topics as read';
		$this->main_markforum_read = 'Mark forum as read';
		$this->main_max_load = 'We are sorry, but %s is currently unavailable, due to a massive amount of connected users.';
		$this->main_members = 'Members';
		$this->main_messenger = 'Messenger';
		$this->main_new = 'new';
		$this->main_next = 'next';
		$this->main_prev = 'prev';
		$this->main_queries = 'queries';
		$this->main_quote = 'Quote';
		$this->main_recent = 'Recent posts';
		$this->main_recent1 = 'View recent topics since your last visit';
		$this->main_register = 'Register';
		$this->main_reminder = 'Reminder';
		$this->main_reminder_closed = 'The board is closed and only viewable to admins.';
		$this->main_said = 'said';
		$this->main_search = 'Search';
		$this->main_topics_new = 'There are new posts in this forum.';
		$this->main_topics_old = 'There are no new posts in this forum.';
		$this->main_welcome = 'Welcome';
		$this->main_welcome_guest = 'Welcome!';
	}

	function mass_mail()
	{
		$this->mail = 'Mass Mail';
		$this->mail_announce = 'Announcement From';
		$this->mail_groups = 'Recipient Groups';
		$this->mail_members = 'members.';
		$this->mail_message = 'Message';
		$this->mail_select_all = 'Select All';
		$this->mail_send = 'Send Mail';
		$this->mail_sent = 'Your message has been sent to';
	}

	function member_control()
	{
		$this->mc = 'Member Control';
		$this->mc_confirm = 'Are you sure you want to delete';
		$this->mc_delete = 'Delete Member';
		$this->mc_deleted = 'Member Deleted.';
		$this->mc_edit = 'Edit Member';
		$this->mc_edited = 'Member Updated';
		$this->mc_email_invaid = 'The email address you entered is invalid.';
		$this->mc_err_updating = 'Error Updating Profile';
		$this->mc_find = 'Find members with names containing';
		$this->mc_found = 'The following members were found. Please select one.';
		$this->mc_guest_needed = 'The guest account is necessary for Quicksilver Forums to function.';
		$this->mc_not_found = 'No members were found matching';
		$this->mc_user_aim = 'AIM Name';
		$this->mc_user_avatar = 'Avatar';
		$this->mc_user_avatar_height = 'Avatar Height';
		$this->mc_user_avatar_type = 'Avatar Type';
		$this->mc_user_avatar_width = 'Avatar Width';
		$this->mc_user_birthday = 'Birthday';
		$this->mc_user_email = 'Email Address';
		$this->mc_user_email_show = 'Email Is Public';
		$this->mc_user_group = 'Group';
		$this->mc_user_gtalk = 'GTalk Account';
		$this->mc_user_homepage = 'Homepage';
		$this->mc_user_icq = 'ICQ Number';
		$this->mc_user_id = 'User ID';
		$this->mc_user_interests = 'Interests';
		$this->mc_user_joined = 'Member Since';
		$this->mc_user_language = 'Language';
		$this->mc_user_lastpost = 'Last Post';
		$this->mc_user_lastvisit = 'Last Visit';
		$this->mc_user_level = 'Level';
		$this->mc_user_location = 'Location';
		$this->mc_user_msn = 'MSN Identity';
		$this->mc_user_name = 'Name';
		$this->mc_user_pm = 'Accepting Private Messages';
		$this->mc_user_posts = 'Posts';
		$this->mc_user_signature = 'Signature';
		$this->mc_user_skin = 'Skin';
		$this->mc_user_timezone = 'Time Zone';
		$this->mc_user_title = 'Member Title';
		$this->mc_user_title_custom = 'Use a Custom Member Title';
		$this->mc_user_view_avatars = 'Viewing Avatars';
		$this->mc_user_view_emoticons = 'Viewing Emoticons';
		$this->mc_user_view_signatures = 'Viewing Signatures';
		$this->mc_user_yahoo = 'Yahoo Identity';
	}

	function membercount()
	{
		$this->mcount = 'Fix Member Statistics';
		$this->mcount_updated = 'Member Count Updated.';
	}

	function members()
	{
		$this->members_all = 'all';
		$this->members_email = 'Email';
		$this->members_email_member = 'Email this member';
		$this->members_group = 'Group';
		$this->members_joined = 'Joined';
		$this->members_list = 'Member List';
		$this->members_member = 'Member';
		$this->members_pm = 'PM';
		$this->members_posts = 'Posts';
		$this->members_send_pm = 'Send this user a personal message';
		$this->members_title = 'Title';
		$this->members_vist_www = 'Visit this member\'s web site';
		$this->members_www = 'Web Site';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = 'Are you sure you want to delete this post?';
		$this->mod_confirm_topic_delete = 'Are you sure you want to delete the topic?';
		$this->mod_error_first_post = 'You cannot delete the first post in a topic.';
		$this->mod_error_move_category = 'You cannot move a topic to a category.';
		$this->mod_error_move_create = 'You do not have permission to move topics to that forum.';
		$this->mod_error_move_forum = 'You cannot move a topic to a forum that does not exist.';
		$this->mod_error_move_global = 'You cannot move a global topic. Edit the topic before moving it.';
		$this->mod_error_move_same = 'You cannot move a topic to the forum it is already in.';
		$this->mod_label_controls = 'Moderator Controls';
		$this->mod_label_description = 'Description';
		$this->mod_label_emoticon = 'Convert emoticons into images?';
		$this->mod_label_global = 'Global Topic';
		$this->mod_label_mbcode = 'Format MbCode?';
		$this->mod_label_move_to = 'Move to';
		$this->mod_label_options = 'Options';
		$this->mod_label_post_delete = 'Delete Post';
		$this->mod_label_post_edit = 'Edit Post';
		$this->mod_label_post_icon = 'Post Icon';
		$this->mod_label_publish = 'Publishing';
		$this->mod_label_title = 'Title';
		$this->mod_label_title_original = 'Original Title';
		$this->mod_label_title_split = 'Split Title';
		$this->mod_label_topic_delete = 'Delete Topic';
		$this->mod_label_topic_edit = 'Edit Topic';
		$this->mod_label_topic_lock = 'Lock Topic';
		$this->mod_label_topic_move = 'Move Topic';
		$this->mod_label_topic_move_complete = 'Completely transfer the topic to the new forum';
		$this->mod_label_topic_move_link = 'Transfer the topic to the new forum, and leave a link to its new location in the old forum.';
		$this->mod_label_topic_pin = 'Pin Topic';
		$this->mod_label_topic_split = 'Split Topic';
		$this->mod_missing_post = 'The specified post does not exist.';
		$this->mod_missing_topic = 'The specified topic does not exist.';
		$this->mod_no_action = 'You must specify an action.';
		$this->mod_no_post = 'You must specify a post.';
		$this->mod_no_topic = 'You must specify a topic.';
		$this->mod_perm_post_delete = 'You do not have permission to delete this post.';
		$this->mod_perm_post_edit = 'You do not have permission to edit this post.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.';
		$this->mod_perm_topic_delete = 'You do not have permission to delete this topic.';
		$this->mod_perm_topic_edit = 'You do not have permission to edit this topic.';
		$this->mod_perm_topic_lock = 'You do not have permission to lock this topic.';
		$this->mod_perm_topic_move = 'You do not have permission to move this topic.';
		$this->mod_perm_topic_pin = 'You do not have permission to pin this topic.';
		$this->mod_perm_topic_split = 'You do not have permission to split this topic.';
		$this->mod_perm_topic_unlock = 'You do not have permission to unlock this topic.';
		$this->mod_perm_topic_unpin = 'You do not have permission to unpin this topic.';
		$this->mod_success_post_delete = 'The post was successfully deleted.';
		$this->mod_success_post_edit = 'The post was successfully edited.';
		$this->mod_success_publish = 'This topic was successfully published.';
		$this->mod_success_split = 'The topic was successfully split.';
		$this->mod_success_topic_delete = 'The topic was successfully deleted.';
		$this->mod_success_topic_edit = 'The topic was successfully edited.';
		$this->mod_success_topic_move = 'The topic was successfully moved to a new forum.';
		$this->mod_success_unpublish = 'This topic has been removed from the published list.';
	}

	function optimize()
	{
		$this->optimize = 'Optimize Database';
		$this->optimized = 'The tables in the database have been optimized for maximum performance.';
	}

	function perms()
	{
		$this->perm = 'Permission';
		$this->perms = 'Permissions';
		$this->perms_board_view = 'View the board index';
		$this->perms_board_view_closed = 'Use Quicksilver Forums when it is closed';
		$this->perms_do_anything = 'Use Quicksilver Forums';
		$this->perms_edit_for = 'Edit permissions for';
		$this->perms_email_use = 'Send emails to members via the board';
		$this->perms_forum_view = 'View the forum';
		$this->perms_is_admin = 'Access the admin control panel';
		$this->perms_only_user = 'Use only group permissions for this user';
		$this->perms_override_user = 'This will override the group permissions for this user.';
		$this->perms_pm_noflood = 'Exempt from personal messenger flood control';
		$this->perms_poll_create = 'Create polls';
		$this->perms_poll_vote = 'Create votes';
		$this->perms_post_attach = 'Attach uploads to posts';
		$this->perms_post_attach_download = 'Download post attachments';
		$this->perms_post_create = 'Create replies';
		$this->perms_post_delete = 'Delete any post';
		$this->perms_post_delete_own = 'Delete only posts the user has created';
		$this->perms_post_edit = 'Edit any post';
		$this->perms_post_edit_own = 'Edit only posts the user has created';
		$this->perms_post_inc_userposts = 'Posts contribute to user\'s total post count';
		$this->perms_post_noflood = 'Exempt from post flood control';
		$this->perms_post_viewip = 'View user IP addresses';
		$this->perms_search_noflood = 'Exempt from search flood control';
		$this->perms_title = 'User Group Control';
		$this->perms_topic_create = 'Create topics';
		$this->perms_topic_delete = 'Delete any topic';
		$this->perms_topic_delete_own = 'Delete only topics the user has created';
		$this->perms_topic_edit = 'Edit any topic';
		$this->perms_topic_edit_own = 'Edit only topics the user has created';
		$this->perms_topic_global = 'Make a topic visible from all forums';
		$this->perms_topic_lock = 'Lock any topic';
		$this->perms_topic_lock_own = 'Lock topics the user has created';
		$this->perms_topic_move = 'Move any topic';
		$this->perms_topic_move_own = 'Move only topics the user has created';
		$this->perms_topic_pin = 'Pin any topic';
		$this->perms_topic_pin_own = 'Pin topics the user has created';
		$this->perms_topic_publish = 'Publish or unpublish any topic';
		$this->perms_topic_publish_auto = 'New topics are marked as published';
		$this->perms_topic_split = 'Split any topic into multiple topics';
		$this->perms_topic_split_own = 'Split only topics the user has created into multiple topics';
		$this->perms_topic_unlock = 'Unlock any topic';
		$this->perms_topic_unlock_mod = 'Unlock a moderator\'s lock';
		$this->perms_topic_unlock_own = 'Unlock only topics the user has created';
		$this->perms_topic_unpin = 'Unpin any topic';
		$this->perms_topic_unpin_own = 'Unpin only topics the user has created';
		$this->perms_topic_view = 'View topics';
		$this->perms_topic_view_unpublished = 'View unpublished topics';
		$this->perms_updated = 'Permissions have been updated.';
		$this->perms_user_inherit = 'The user will inherit the group\'s permissions.';
	}

	function php_info()
	{
		$this->php_error = 'Error';
		$this->php_error_msg = 'phpinfo() can not be executed. It appears that your host has disabled this feature.';
	}

	function pm()
	{
		$this->pm_avatar = 'Avatar';
		$this->pm_cant_del = 'You do not have permission to delete this message.';
		$this->pm_delallmsg = 'Delete All Messages';
		$this->pm_delete = 'Delete';
		$this->pm_delete_selected = 'Delete Selected Messages';
		$this->pm_deleted = 'Message deleted.';
		$this->pm_deleted_all = 'Messages deleted.';
		$this->pm_error = 'There were problems sending your message to some of the recipients.<br /><br />The following members do not exist: %s<br /><br />The following members are not accepting personal messages: %s';
		$this->pm_fields = 'Your message could not be send. Make sure all required fields are filled in.';
		$this->pm_flood = 'You have sent a message in the past %s seconds, and you may not send another right now.<br /><br />Please try again in a few seconds.';
		$this->pm_folder_inbox = 'Inbox';
		$this->pm_folder_new = '%s new';
		$this->pm_folder_sentbox = 'Outbox';
		$this->pm_from = 'From';
		$this->pm_group = 'Group';
		$this->pm_guest = 'As a guest, you cannot use the messenger. Please login or register.';
		$this->pm_joined = 'Joined';
		$this->pm_messenger = 'Messenger';
		$this->pm_msgtext = 'Message Text';
		$this->pm_multiple = 'Separate multiple recipients with ;';
		$this->pm_no_folder = 'You must specify a folder.';
		$this->pm_no_member = 'No member was found with that id.';
		$this->pm_no_number = 'No message was found with that number.';
		$this->pm_no_title = 'No Subject';
		$this->pm_nomsg = 'There are no messages in this folder.';
		$this->pm_noview = 'You do not have permission to view this message.';
		$this->pm_offline = 'This member is currently offline';
		$this->pm_online = 'This member is currently online';
		$this->pm_personal = 'Personal Messenger';
		$this->pm_personal_msging = 'Personal Messaging';
		$this->pm_pm = 'PM';
		$this->pm_posts = 'Posts';
		$this->pm_preview = 'Preview';
		$this->pm_recipients = 'Recipients';
		$this->pm_reply = 'Reply';
		$this->pm_send = 'Send';
		$this->pm_sendamsg = 'Send A Message';
		$this->pm_sendingpm = 'Sending A PM';
		$this->pm_sendon = 'Sent';
		$this->pm_success = 'Your message was sent successfully.';
		$this->pm_sure_del = 'Are you sure you want to delete this message?';
		$this->pm_sure_delall = 'Are you sure you want to delete all messages from this folder?';
		$this->pm_title = 'Title';
		$this->pm_to = 'To';
	}

	function post()
	{
		$this->post_attach = 'Attachments';
		$this->post_attach_add = 'Add Attachment';
		$this->post_attach_disrupt = 'Adding or removing attachments will not disrupt your post.';
		$this->post_attach_failed = 'The attachment upload failed. The file you specified may not exist.';
		$this->post_attach_not_allowed = 'You cannot attach files of that type.';
		$this->post_attach_remove = 'Remove Attachment';
		$this->post_attach_too_large = 'The specified file is too large. The maximum size is %d KB.';
		$this->post_cant_create = 'As a guest, you do not have permission to create topics. If you register, you may be able to create topics.';
		$this->post_cant_create1 = 'You do not have permission to create topics.';
		$this->post_cant_enter = 'Your vote could not be entered. Either you have already voted in this poll, or you do not have permission to vote.';
		$this->post_cant_poll = 'As a guest, you do not have permission to create polls. If you register, you may be able to create them.';
		$this->post_cant_poll1 = 'You do not have permission to create polls.';
		$this->post_cant_reply = 'You do not have permission to reply to topics in this forum.';
		$this->post_cant_reply1 = 'As a guest, you do not have permission to reply to topics. If you register, you may be able to post.';
		$this->post_cant_reply2 = 'You do not have permission to reply to topics.';
		$this->post_closed = 'This topic has been closed.';
		$this->post_create_poll = 'Create Poll';
		$this->post_create_topic = 'Create Topic';
		$this->post_creating = 'Creating Topic';
		$this->post_creating_poll = 'Creating Poll';
		$this->post_flood = 'You have posted in the past %s seconds, and you may not post right now.<br /><br />Please try again in a few seconds.';
		$this->post_guest = 'Guest';
		$this->post_icon = 'Post Icon';
		$this->post_last_five = 'Last Five Posts In Reverse Order';
		$this->post_length = 'Check Length';
		$this->post_msg = 'Message';
		$this->post_must_msg = 'You must include a message when posting.';
		$this->post_must_options = 'You must include options when creating a new poll.';
		$this->post_must_title = 'You must include a title when creating a new topic.';
		$this->post_new_poll = 'New poll';
		$this->post_new_topic = 'New topic';
		$this->post_no_forum = 'That forum was not found.';
		$this->post_no_topic = 'No topic was specified.';
		$this->post_no_vote = 'You must choose an option to vote for.';
		$this->post_option_emoticons = 'Convert emoticons into images?';
		$this->post_option_global = 'Make this topic global?';
		$this->post_option_mbcode = 'Format MbCode?';
		$this->post_optional = 'optional';
		$this->post_options = 'Options';
		$this->post_poll_options = 'Poll Options';
		$this->post_poll_row = 'One per line';
		$this->post_posted = 'Posted';
		$this->post_posting = 'Posting';
		$this->post_preview = 'Preview';
		$this->post_reply = 'Reply';
		$this->post_reply_topic = 'Reply to topic';
		$this->post_replying = 'Replying To Topic';
		$this->post_replying1 = 'Replying';
		$this->post_too_many_options = 'You must have between 2 and %d options to a poll.';
		$this->post_topic_detail = 'Topic Description';
		$this->post_topic_title = 'Topic Title';
		$this->post_view_topic = 'View Entire Topic';
		$this->post_voting = 'Voting';
	}

	function printer()
	{
		$this->printer_back = 'Back';
		$this->printer_not_found = 'The topic could not be found. It may have been deleted, moved, or may have never existed.';
		$this->printer_not_found_title = 'Topic Not Found';
		$this->printer_perm_topics = 'You do not have permission to view topics.';
		$this->printer_perm_topics_guest = 'You do not have permission to view topics. If you register, you may be able to.';
		$this->printer_posted_on = 'Posted';
		$this->printer_send = 'Send to printer';
	}

	function profile()
	{
		$this->profile_aim_sn = 'AIM Name';
		$this->profile_av_sign = 'Avatar and Signature';
		$this->profile_avatar = 'Avatar';
		$this->profile_bday = 'Birthday';
		$this->profile_contact = 'Contact';
		$this->profile_email_address = 'Email Address';
		$this->profile_fav = 'Favorite Forum';
		$this->profile_fav_forum = '%s (%d%% of this member\'s posts)';
		$this->profile_gtalk = 'GTalk Account';
		$this->profile_icq_uin = 'ICQ Number';
		$this->profile_info = 'Information';
		$this->profile_interest = 'Interests';
		$this->profile_joined = 'Joined';
		$this->profile_last_post = 'Last Post';
		$this->profile_list = 'Member List';
		$this->profile_location = 'Location';
		$this->profile_member = 'Member Group';
		$this->profile_member_title = 'Member Title';
		$this->profile_msn = 'MSN Identity';
		$this->profile_must_user = 'You must enter a user to view a profile.';
		$this->profile_no_member = 'There is no member with that user id. The account may have been deleted.';
		$this->profile_none = '[ None ]';
		$this->profile_not_post = 'has not yet posted.';
		$this->profile_offline = 'This member is currently offline';
		$this->profile_online = 'This member is currently online';
		$this->profile_pm = 'Private Messages';
		$this->profile_postcount = '%s total, %s per day';
		$this->profile_posts = 'Posts';
		$this->profile_private = '[ Private ]';
		$this->profile_profile = 'Profile';
		$this->profile_signature = 'Signature';
		$this->profile_unkown = '[ Unknown ]';
		$this->profile_view_profile = 'Viewing Profile';
		$this->profile_www = 'Homepage';
		$this->profile_yahoo = 'Yahoo Identity';
	}

	function prune()
	{
		$this->prune_action = 'Prune action to take';
		$this->prune_age_day = '1 Day';
		$this->prune_age_eighthours = '8 Hours';
		$this->prune_age_hour = '1 Hour';
		$this->prune_age_month = '1 Month';
		$this->prune_age_threemonths = '3 Months';
		$this->prune_age_week = '1 Week';
		$this->prune_age_year = '1 Year';
		$this->prune_forums = 'Select forums to prune';
		$this->prune_invalidage = 'Invalid age specified for pruning';
		$this->prune_move = 'Move';
		$this->prune_moveto_forum = 'Forum to move to';
		$this->prune_nodest = 'No valid destination selected';
		$this->prune_notopics = 'No topics selected for pruning';
		$this->prune_notopics_old = 'No topics are old enough for pruning';
		$this->prune_novalidforum = 'No valid forums specified to prune';
		$this->prune_select_age = 'Select age of topics to limit pruning to';
		$this->prune_select_topics = 'Select topics to prune or use Select All';
		$this->prune_success = 'Topics have been pruned';
		$this->prune_title = 'Topic Pruner';
		$this->prune_topics_older_than = 'Prune topics older than';
	}

	function query()
	{
		$this->query = 'Query Interface';
		$this->query_fail = 'failed.';
		$this->query_success = 'executed successfully.';
		$this->query_your = 'Your query';
	}

	function recent()
	{
		$this->recent_active = 'Active topics since last visit';
		$this->recent_by = 'By';
		$this->recent_can_post = 'You can reply in this forum.';
		$this->recent_can_topics = 'You can view topics in this forum.';
		$this->recent_cant_post = 'You cannot reply in this forum.';
		$this->recent_cant_topics = 'You cannot view topics in this forum.';
		$this->recent_dot = 'dot';
		$this->recent_dot_detail = 'Shows that you have posted in the topic';
		$this->recent_forum = 'Forum';
		$this->recent_guest = 'Guest';
		$this->recent_hot = 'Hot';
		$this->recent_icon = 'Message Icon';
		$this->recent_jump = 'Jump to newest post in topic';
		$this->recent_last = 'Last Post';
		$this->recent_locked = 'Locked';
		$this->recent_moved = 'Moved';
		$this->recent_msg = '%s Message';
		$this->recent_new = 'New';
		$this->recent_new_poll = 'Create New Poll';
		$this->recent_new_topic = 'Create New Topic';
		$this->recent_no_topics = 'There are no topics since you last visited.';
		$this->recent_noexist = 'The specified forum does not exist.';
		$this->recent_nopost = 'No posts';
		$this->recent_not = 'Not';
		$this->recent_noview = 'You do not have permission to view forums.';
		$this->recent_pages = 'Pages';
		$this->recent_pinned = 'Pinned';
		$this->recent_pinned_topic = 'Pinned Topic';
		$this->recent_poll = 'Poll';
		$this->recent_regfirst = 'You do not have permission to view forums. If you register, you may be able to.';
		$this->recent_replies = 'Replies';
		$this->recent_starter = 'Starter';
		$this->recent_sub = 'Sub-Forum';
		$this->recent_sub_last_post = 'Last Post';
		$this->recent_sub_replies = 'Replies';
		$this->recent_sub_topics = 'Topics';
		$this->recent_subscribe = 'E-mail me when posts are made in this forum';
		$this->recent_topic = 'Topic';
		$this->recent_views = 'Views';
		$this->recent_write_topics = 'You can create topics in this forum.';
	}

	function register()
	{
		$this->register_activated = 'Your account has been activated!';
		$this->register_activating = 'Account Activation';
		$this->register_activation_error = 'There was an error while activating your account. Check to see if your browser contains the full url in the activation email. If the problem persists, contact the board administrator to have your email resent.';
		$this->register_confirm_passwd = 'Confirm Password';
		$this->register_done = 'You have been registered! You can now login.';
		$this->register_email = 'Email Address';
		$this->register_email_invalid = 'The email address you entered is invalid.';
		$this->register_email_msg = 'This is an automated email generated by Quicksilver Forums, and sent to you in order';
		$this->register_email_msg2 = 'for you to activate your account with';
		$this->register_email_msg3 = 'Please click the following link, or paste it in to your web browser:';
		$this->register_email_used = 'The email address you entered is already assigned to a member.';
		$this->register_fields = 'Not all fields are filled in.';
		$this->register_flood = 'You have registered already.';
		$this->register_image = 'Please type the text shown in the image.';
		$this->register_image_invalid = 'To verify you are a human registrant, you must type the text as shown in the image.';
		$this->register_initiated = 'This request was initiated from IP:';
		$this->register_must_activate = 'You have been registered. An email has been sent to %s with information on how to activate your account. Your account will be limited until you activate it.';
		$this->register_name_invalid = 'The name you entered is too long.';
		$this->register_name_taken = 'That member name is already taken.';
		$this->register_new_user = 'Desired User Name';
		$this->register_pass_invalid = 'The password you entered is not valid. Make sure it uses only valid characters such as letters, numbers, dashes, underscores, or spaces, and is at least 5 characters.';
		$this->register_pass_match = 'The passwords you entered do not match.';
		$this->register_passwd = 'Password';
		$this->register_reg = 'Register';
		$this->register_reging = 'Registering';
		$this->register_requested = 'Account activation request for:';
		$this->register_tos = 'Terms of Service';
		$this->register_tos_i_agree = 'I agree to the above terms';
		$this->register_tos_not_agree = 'You did not agree to the terms.';
		$this->register_tos_read = 'Please read the following terms of service';
	}

	function rssfeed()
	{
		$this->rssfeed_cannot_find_forum = 'The forum does not appear to exist';
		$this->rssfeed_cannot_find_topic = 'The topic does nto appear to exist';
		$this->rssfeed_cannot_read_forum = 'You do not have permission to read this forum';
		$this->rssfeed_cannot_read_topic = 'You do not have permission to read this topic';
		$this->rssfeed_error = 'Error';
		$this->rssfeed_forum = 'Forum:';
		$this->rssfeed_posted_by = 'Posted by';
		$this->rssfeed_topic = 'Topic:';
	}

	function search()
	{
		$this->search_advanced = 'Advanced Options';
		$this->search_avatar = 'Avatar';
		$this->search_basic = 'Basic Search';
		$this->search_characters = 'characters of a post';
		$this->search_day = 'day';
		$this->search_days = 'days';
		$this->search_exact_name = 'exact name';
		$this->search_flood = 'You have searched in the past %s seconds, and you may not search right now.<br /><br />Please try again in a few seconds.';
		$this->search_for = 'Search For';
		$this->search_forum = 'Forum';
		$this->search_group = 'Group';
		$this->search_guest = 'Guest';
		$this->search_in = 'Search In';
		$this->search_in_posts = 'Only search in posts';
		$this->search_ip = 'IP';
		$this->search_joined = 'Joined';
		$this->search_level = 'Member Level';
		$this->search_match = 'Search by matching';
		$this->search_matches = 'Matches';
		$this->search_month = 'month';
		$this->search_months = 'months';
		$this->search_mysqldoc = 'MySQL Documentation';
		$this->search_newer = 'newer';
		$this->search_no_results = 'Your search returned no results.';
		$this->search_no_words = 'You must specify some search terms.<br /><br />Each term must be longer than 3 characters, including letters, numbers, apostrophes, and underscores.';
		$this->search_offline = 'This member is currently offline';
		$this->search_older = 'older';
		$this->search_online = 'This member is currently online';
		$this->search_only_display = 'Only display first';
		$this->search_partial_name = 'partial name';
		$this->search_post_icon = 'Post Icon';
		$this->search_posted_on = 'Posted';
		$this->search_posts = 'Posts';
		$this->search_posts_by = 'Only in posts by';
		$this->search_regex = 'Search by regular expression';
		$this->search_regex_failed = 'Your regular expression failed. Please see the MySQL documentation for regular expression help.';
		$this->search_relevance = 'Post Relevance: %d%%';
		$this->search_replies = 'Posts';
		$this->search_result = 'Search Results';
		$this->search_search = 'Search';
		$this->search_select_all = 'Select All';
		$this->search_show_posts = 'Show matched posts';
		$this->search_sound = 'Search by sound';
		$this->search_starter = 'Starter';
		$this->search_than = 'than';
		$this->search_topic = 'Topic';
		$this->search_unreg = 'Unregistered';
		$this->search_week = 'week';
		$this->search_weeks = 'weeks';
		$this->search_year = 'year';
	}

	function settings()
	{
		$this->settings = 'Settings';
		$this->settings_active = 'Active Users Settings';
		$this->settings_allow = 'Allow';
		$this->settings_antibot = 'Anti-Robot Registration';
		$this->settings_attach_ext = 'Attachments - File Extensions';
		$this->settings_attach_one_per = 'One per line. No periods.';
		$this->settings_avatar = 'Avatar Settings';
		$this->settings_avatar_flash = 'Flash Avatars';
		$this->settings_avatar_max_height = 'Maximum Avatar Height';
		$this->settings_avatar_max_width = 'Maximum Avatar Width';
		$this->settings_avatar_upload = 'Uploaded Avatars - Max File Size';
		$this->settings_basic = 'Edit Board Settings';
		$this->settings_blank = 'Use <i>_blank</i> for a new window.';
		$this->settings_board_enabled = 'Board Enabled';
		$this->settings_board_location = 'Location of Board';
		$this->settings_board_name = 'Board Name';
		$this->settings_board_rss = 'RSS Feed Settings';
		$this->settings_board_rssfeed_desc = 'RSS Feed Description';
		$this->settings_board_rssfeed_posts = 'Number of posts to list on RSS Feed';
		$this->settings_board_rssfeed_time = 'Refresh time in minutes';
		$this->settings_board_rssfeed_title = 'RSS Feed Title';
		$this->settings_clickable = 'Clickable Smilies Per Row';
		$this->settings_cookie = 'Cookie and Flood Settings';
		$this->settings_cookie_path = 'Cookie Path';
		$this->settings_cookie_prefix = 'Cookie Prefix';
		$this->settings_cookie_time = 'Time to Remain Logged In';
		$this->settings_db = 'Edit Connection Settings';
		$this->settings_db_host = 'Database Host';
		$this->settings_db_leave_blank = 'Leave blank for none.';
		$this->settings_db_multiple = 'For installing multiple boards on one database.';
		$this->settings_db_name = 'Database Name';
		$this->settings_db_password = 'Database Password';
		$this->settings_db_port = 'Database Port';
		$this->settings_db_prefix = 'Table Prefix';
		$this->settings_db_socket = 'Database Socket';
		$this->settings_db_username = 'Database Username';
		$this->settings_debug_mode = 'Debug Mode';
		$this->settings_default_lang = 'Default Language';
		$this->settings_default_no = 'Default No';
		$this->settings_default_skin = 'Default Skin';
		$this->settings_default_yes = 'Default Yes';
		$this->settings_disabled = 'Disabled';
		$this->settings_disabled_notice = 'Disabled Notice';
		$this->settings_email = 'E-Mail Settings';
		$this->settings_email_fake = 'For display only. Should not be a real e-mail address.';
		$this->settings_email_from = 'E-mail From Address';
		$this->settings_email_place1 = 'Place members in the';
		$this->settings_email_place2 = 'group until they verify their e-mail';
		$this->settings_email_place3 = 'Do not require e-mail activation';
		$this->settings_email_real = 'Should be a real e-mail address.';
		$this->settings_email_reply = 'E-mail Reply-To Address';
		$this->settings_email_smtp = 'SMTP Mail Server';
		$this->settings_email_valid = 'New Member E-mail Validation';
		$this->settings_enabled = 'Enabled';
		$this->settings_enabled_modules = 'Enabled Modules';
		$this->settings_foreign_link = 'Foreign Link Target';
		$this->settings_general = 'General Settings';
		$this->settings_group_after = 'Group After Registration';
		$this->settings_hot_topic = 'Posts for a Hot Topic';
		$this->settings_kilobytes = 'Kilobytes';
		$this->settings_max_attach_size = 'Attachments - Maximum File Size';
		$this->settings_members = 'Member Settings';
		$this->settings_modname_only = 'Module name only. Do not include .php';
		$this->settings_new = 'New Setting';
		$this->settings_new_add = 'Add New Board Setting';
		$this->settings_new_added = 'New settings added.';
		$this->settings_new_exists = 'That setting already exists. Choose another name for it.';
		$this->settings_new_name = 'New setting name';
		$this->settings_new_required = 'The new setting name is required.';
		$this->settings_new_value = 'New setting value';
		$this->settings_no_allow = 'Do Not Allow';
		$this->settings_nodata = 'No data was sent from POST';
		$this->settings_one_per = 'One per line';
		$this->settings_pixels = 'Pixels';
		$this->settings_pm_flood = 'Personal Messenger Flood Control';
		$this->settings_pm_min_time = 'Minimum time between messages.';
		$this->settings_polls = 'Polls';
		$this->settings_polls_no = 'Users cannot vote in a poll after viewing its results';
		$this->settings_polls_yes = 'Users can vote in a poll after viewing its results';
		$this->settings_post_flood = 'Post Flood Control';
		$this->settings_post_min_time = 'Minimum time between posts.';
		$this->settings_posts_topic = 'Posts Per Topic Page';
		$this->settings_search_flood = 'Search Flood Control';
		$this->settings_search_min_time = 'Minimum time between searches.';
		$this->settings_server = 'Server Settings';
		$this->settings_server_gzip = 'GZIP Compression';
		$this->settings_server_gzip_msg = 'Improves speed. Disable if the board appears jumbled or blank.';
		$this->settings_server_maxload = 'Maximum Server Load';
		$this->settings_server_maxload_msg = 'Disables board under excessive server strain. Enter 0 to disable.';
		$this->settings_server_timezone = 'Server Time Zone';
		$this->settings_show_avatars = 'Show Avatars';
		$this->settings_show_email = 'Show Email Address';
		$this->settings_show_emotes = 'Show Emoticons';
		$this->settings_show_notice = 'Shown when the board is disabled';
		$this->settings_show_pm = 'Accept Personal Messages';
		$this->settings_show_sigs = 'Show Signatures';
		$this->settings_spider_agent = 'Spider User Agent';
		$this->settings_spider_agent_msg = 'Enter all or part of the spider\'s unique HTTP USER AGENT.';
		$this->settings_spider_enable = 'Enable Spider Display';
		$this->settings_spider_enable_msg = 'Enable the names of search engine spiders on Active List.';
		$this->settings_spider_name = 'Spider Name';
		$this->settings_spider_name_msg = 'Enter the name that you wish to display for each of the above spiders on Active List. You need to place the spider\'s name on the same line as the spider\'s user agent above. For example, if you place \'googlebot\' on the third line for the user agent place \'Google\' on the third line for the Spider Name.';
		$this->settings_timezone = 'Time Zone';
		$this->settings_topics_page = 'Topics Per Forum Page';
		$this->settings_tos = 'Terms of Service';
		$this->settings_updated = 'Settings have been updated.';
	}

	function stats()
	{
		$this->stats = 'Statistics Center';
		$this->stats_post_by_month = 'Posts by Month';
		$this->stats_reg_by_month = 'Registrations by Month';
	}

	function templates()
	{
		$this->add = 'Add HTML Templates';
		$this->add_in = 'Add template to:';
		$this->all_fields_required = 'All fields are required to add a template';
		$this->choose_css = 'Choose CSS Template';
		$this->choose_set = 'Choose a template set';
		$this->choose_skin = 'Choose a skin';
		$this->confirm1 = 'You are about to delete the';
		$this->confirm2 = 'template from';
		$this->create_new = 'Create a new skin named';
		$this->create_skin = 'Create Skin';
		$this->credit = 'Please do not remove our only credit!';
		$this->css_edited = 'CSS file has been updated.';
		$this->css_fioerr = 'The file could not be written to, you will need to CHMOD the file manually.';
		$this->delete_template = 'Delete Template';
		$this->directory = 'Directory';
		$this->display_name = 'Display Name';
		$this->edit_css = 'Edit CSS';
		$this->edit_skin = 'Edit Skin';
		$this->edit_templates = 'Edit Templates';
		$this->export_done = 'Skin exported to the skins directory.';
		$this->export_select = 'Select a skin to export';
		$this->export_skin = 'Export Skin';
		$this->install_done = 'The skin has been installed successfully.';
		$this->install_exists1 = 'It appears that the skin';
		$this->install_exists2 = 'is already installed.';
		$this->install_overwrite = 'Overwrite';
		$this->install_skin = 'Install Skin';
		$this->menu_title = 'Select a template section to edit';
		$this->no_file = 'No such file.';
		$this->only_skin = 'There is only one skin installed. You may not delete this skin.';
		$this->or_new = 'Or create new template set named:';
		$this->select_skin = 'Select a Skin';
		$this->select_skin_edit = 'Select a skin to edit';
		$this->select_skin_edit_done = 'Skin successfully edited.';
		$this->select_template = 'Select Template';
		$this->skin_chmod = 'A new directory could not be created for the skin. Try to CHMOD the skins directory to 775.';
		$this->skin_created = 'Skin created.';
		$this->skin_deleted = 'Skin successfully deleted.';
		$this->skin_dir_name = 'You must enter a skin name and directory name.';
		$this->skin_dup = 'A skin with a duplicate directory name was found. The skin\'s directory was changed to';
		$this->skin_name = 'You must enter a skin name.';
		$this->skin_none = 'There are no skins available to install.';
		$this->skin_set = 'Skin Set';
		$this->skins_found = 'The following skins were found in the skins directory';
		$this->template_about = 'About Variables';
		$this->template_about2 = 'Variables are pieces of text that are replaced with dynamic data. Variables always begin with a dollar sign, and are sometimes enclosed in {braces}.';
		$this->template_add = 'Add';
		$this->template_added = 'Template added.';
		$this->template_clear = 'Clear';
		$this->template_confirm = 'You have made changes to the templates. Do you want to save your changes?';
		$this->template_description = 'Template Description';
		$this->template_html = 'Template HTML';
		$this->template_name = 'Template Name';
		$this->template_position = 'Template Position';
		$this->template_set = 'Template Set';
		$this->template_title = 'Template Title';
		$this->template_universal = 'Universal Variable';
		$this->template_universal2 = 'Some variables can be used in any template, while others can only be used in a single template. Properties of the object $this can be used anywhere.';
		$this->template_updated = 'Template updated.';
		$this->templates = 'Templates';
		$this->temps_active = 'Active Users Detail';
		$this->temps_admin = '<b>AdminCP Universal</b>';
		$this->temps_ban = 'AdminCP Bans';
		$this->temps_board_index = 'Board Index';
		$this->temps_censoring = 'AdminCP Word Censoring';
		$this->temps_cp = 'Member Control Panel';
		$this->temps_email = 'Email A Member';
		$this->temps_emot_control = 'AdminCP Emoticons';
		$this->temps_forum = 'Forums';
		$this->temps_forums = 'AdminCP Forums';
		$this->temps_groups = 'AdminCP Groups';
		$this->temps_help = 'Help';
		$this->temps_login = 'Logging In/Out';
		$this->temps_logs = 'AdminCP Moderator Logs';
		$this->temps_main = '<b>Board Universal</b>';
		$this->temps_mass_mail = 'AdminCP Mass Mail';
		$this->temps_member_control = 'AdminCP Member Control';
		$this->temps_members = 'Member List';
		$this->temps_mod = 'Moderator Controls';
		$this->temps_pm = 'Private Messenger';
		$this->temps_polls = 'Polls';
		$this->temps_post = 'Posting';
		$this->temps_printer = 'Printer-Friendly Topics';
		$this->temps_profile = 'Profile Viewing';
		$this->temps_recent = 'Recent Topics';
		$this->temps_register = 'Registration';
		$this->temps_rssfeed = 'RSS Feed';
		$this->temps_search = 'Searching';
		$this->temps_settings = 'AdminCP Settings';
		$this->temps_templates = 'AdminCP Template Editor';
		$this->temps_titles = 'AdminCP Member Titles';
		$this->temps_topic_prune = 'AdminCP Topic Pruning';
		$this->temps_topics = 'Topics';
		$this->upgrade_skin = 'Upgrade Skin';
		$this->upgrade_skin_already = 'was already upgraded. Nothing to do.';
		$this->upgrade_skin_detail = 'Skins upgraded using this method will still require template editing afterwards.<br />Select a skin to upgrade';
		$this->upgrade_skin_upgraded = 'skin has been upgraded.';
		$this->upgraded_templates = 'The following templates were added or upgraded';
	}

	function titles()
	{
		$this->titles_add = 'Add Member Titles';
		$this->titles_added = 'Member Title added.';
		$this->titles_control = 'Member Title Control';
		$this->titles_edit = 'Edit Member Titles';
		$this->titles_error = 'No title text or minimum posts was given';
		$this->titles_image = 'Image';
		$this->titles_minpost = 'Minimum Posts';
		$this->titles_nodel_default = 'Removal of the default title has been disabled as it will break your board, please edit it instead.';
		$this->titles_title = 'Title';
	}

	function topic()
	{
		$this->topic_attached = 'Attached file:';
		$this->topic_attached_downloads = 'Downloads';
		$this->topic_attached_filename = 'Filename:';
		$this->topic_attached_image = 'Attached image:';
		$this->topic_attached_perm = 'You do not have permission to download this file.';
		$this->topic_attached_size = 'Size:';
		$this->topic_attached_title = 'Attached File';
		$this->topic_avatar = 'Avatar';
		$this->topic_bottom = 'Go to the bottom of the page';
		$this->topic_create_poll = 'Create New Poll';
		$this->topic_create_topic = 'Create New Topic';
		$this->topic_delete = 'Delete';
		$this->topic_delete_post = 'Delete this post';
		$this->topic_edit = 'Edit';
		$this->topic_edit_post = 'Edit this post';
		$this->topic_edited = 'Last edited %s by %s';
		$this->topic_error = 'Error';
		$this->topic_group = 'Group';
		$this->topic_guest = 'Guest';
		$this->topic_ip = 'IP';
		$this->topic_joined = 'Joined';
		$this->topic_level = 'Member Level';
		$this->topic_links_aim = 'Send an AIM message to %s';
		$this->topic_links_email = 'Send an email to %s';
		$this->topic_links_gtalk = 'Send a GTalk message to %s';
		$this->topic_links_icq = 'Send an ICQ messsage to %s';
		$this->topic_links_msn = 'View %s\'s MSN profile';
		$this->topic_links_pm = 'Send a personal messsage to %s';
		$this->topic_links_web = 'Visit %s\'s web site';
		$this->topic_links_yahoo = 'Send a message to %s with Yahoo! Messenger';
		$this->topic_lock = 'Lock';
		$this->topic_locked = 'Topic Locked';
		$this->topic_move = 'Move';
		$this->topic_new_post = 'Post is unread';
		$this->topic_newer = 'Newer Topic';
		$this->topic_no_newer = 'There is no newer topic.';
		$this->topic_no_older = 'There is no older topic.';
		$this->topic_no_votes = 'There are no votes for this poll.';
		$this->topic_not_found = 'Topic Not Found';
		$this->topic_not_found_message = 'The topic could not be found. It may have been deleted, moved, perhaps never existed.';
		$this->topic_offline = 'This member is currently offline';
		$this->topic_older = 'Older Topic';
		$this->topic_online = 'This member is currently online';
		$this->topic_options = 'Topic Options';
		$this->topic_pages = 'Pages';
		$this->topic_perm_view = 'You do not have permission to view topics.';
		$this->topic_perm_view_guest = 'You do not have permission to view topics. If you register, you may be able to.';
		$this->topic_pin = 'Pin';
		$this->topic_posted = 'Posted';
		$this->topic_posts = 'Posts';
		$this->topic_print = 'View Printable';
		$this->topic_publish = 'Publish';
		$this->topic_qr_emoticons = 'Emoticons';
		$this->topic_qr_open_emoticons = 'Open Clickable Emoticons';
		$this->topic_qr_open_mbcode = 'Open MBCode';
		$this->topic_quickreply = 'Quick Reply';
		$this->topic_quote = 'Reply with a quote from this post';
		$this->topic_reply = 'Reply to Topic';
		$this->topic_split = 'Split';
		$this->topic_split_finish = 'Finish All Splitting';
		$this->topic_split_keep = 'Do not move this post';
		$this->topic_split_move = 'Move this post';
		$this->topic_subscribe = 'E-mail me when replies are made to this topic';
		$this->topic_top = 'Go to the top of the page';
		$this->topic_unlock = 'Unlock';
		$this->topic_unpin = 'Unpin';
		$this->topic_unpublish = 'UnPublish';
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.';
		$this->topic_unreg = 'Unregistered';
		$this->topic_view = 'View Results';
		$this->topic_viewing = 'Viewing Topic';
		$this->topic_vote = 'Vote';
		$this->topic_vote_count_plur = '%d votes';
		$this->topic_vote_count_sing = '%d vote';
		$this->topic_votes = 'Votes';
	}

	function universal()
	{
		$this->aim = 'AIM';
		$this->based_on = 'Based on';
		$this->board_by = 'By';
		$this->charset = 'utf-8';
		$this->continue = 'Continue';
		$this->date_long = 'M j, Y';
		$this->date_short = 'n/j/y';
		$this->delete = 'Delete';
		$this->direction = 'ltr';
		$this->edit = 'Edit';
		$this->email = 'Email';
		$this->gtalk = 'GT';
		$this->icq = 'ICQ';
		$this->msn = 'MSN';
		$this->new_message = 'New Message';
		$this->new_poll = 'New Poll';
		$this->new_topic = 'New Topic';
		$this->no = 'No';
		$this->powered = 'Powered by';
		$this->private_message = 'PM';
		$this->quote = 'Quote';
		$this->recount_forums = 'Recounted forums! Total topics: %d. Total posts: %d.';
		$this->reply = 'Reply';
		$this->seconds = 'Seconds';
		$this->select_all = 'Select All';
		$this->sep_decimals = '.';
		$this->sep_thousands = ',';
		$this->spoiler = 'Spoiler';
		$this->submit = 'Submit';
		$this->subscribe = 'Subscribe';
		$this->time_long = ', g:i a';
		$this->time_only = 'g:i a';
		$this->today = 'Today';
		$this->website = 'WWW';
		$this->yahoo = 'Yahoo';
		$this->yes = 'Yes';
		$this->yesterday = 'Yesterday';
	}
}
?>
