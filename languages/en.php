<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2020 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * https://github.com/Arthmoor/Quicksilver-Forums
 *
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 * https://github.com/markelliot/MercuryBoard
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

if( !defined( 'QUICKSILVERFORUMS' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
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
	public function active()
	{
		$this->active_last_action = 'Last Action';
		$this->active_modules_active = 'Viewing the active users';
		$this->active_modules_board = 'Viewing the board index';
		$this->active_modules_cp = 'Using the control panel';
		$this->active_modules_file_rating = 'Rating a file';
		$this->active_modules_files = 'Browsing files';
		$this->active_modules_forum = 'Viewing a forum: %s';
		$this->active_modules_login = 'Logging in or out';
		$this->active_modules_members = 'Viewing the member list';
		$this->active_modules_mod = 'Moderating';
		$this->active_modules_newspost = 'Viewing a newspost: %s';
		$this->active_modules_pages = 'Viewing a custom page';
		$this->active_modules_pm = 'Using the messenger';
		$this->active_modules_post = 'Posting';
		$this->active_modules_profile = 'Viewing a profile: %s';
		$this->active_modules_recent = 'Viewing recent posts';
		$this->active_modules_search = 'Searching';
		$this->active_modules_topic = 'Viewing a topic: %s';
		$this->active_time = 'Time';
		$this->active_user = 'User';
		$this->active_users = 'Active Users';
	}

	public function admin()
	{
		$this->admin_add_member_titles = 'Add automatic member titles';
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
		$this->admin_db_optimize = 'Optimize the database';
		$this->admin_db_query = 'Execute an SQL query';
		$this->admin_db_repair = 'Repair the database';
		$this->admin_db_restore = 'Restore a backup';
		$this->admin_delete_forum = 'Delete a forum';
		$this->admin_delete_group = 'Delete a group';
		$this->admin_delete_help = 'Delete a help article';
		$this->admin_delete_member = 'Delete a member';
		$this->admin_edit_forum = 'Edit a forum';
		$this->admin_edit_group_file_perms = 'Edit a group\'s file permissions';
		$this->admin_edit_group_name = 'Edit a group\'s name';
		$this->admin_edit_group_perms = 'Edit a group\'s permissions';
		$this->admin_edit_help = 'Edit a help article';
		$this->admin_edit_member = 'Edit a member';
		$this->admin_edit_member_file_perms = 'Edit a member\'s file permissions';
		$this->admin_edit_member_perms = 'Edit a member\'s permissions';
		$this->admin_edit_member_titles = 'Edit or delete automatic member titles';
		$this->admin_edit_settings = 'Edit board settings';
		$this->admin_edit_skin = 'Edit or delete a skin';
		$this->admin_emojis = 'Emoji Controls';
		$this->admin_export_skin = 'Export a skin';
		$this->admin_fix_stats = 'Fix the member statistics';
		$this->admin_forum_order = 'Change the forum ordering';
		$this->admin_forums = 'Forums and Categories';
		$this->admin_groups = 'Groups';
		$this->admin_heading = 'QSF Portal Admin Control Panel';
		$this->admin_logs = 'View moderator actions';
		$this->admin_manage_skins = 'Manage Skins';
		$this->admin_mass_mail = 'Send an email to your members';
		$this->admin_members = 'Members';
		$this->admin_phpinfo = 'View PHP information';
		$this->admin_prune = 'Prune old topics';
		$this->admin_recount_forums = 'Recount topics and replies';
		$this->admin_settings = 'Settings';
		$this->admin_settings_add = 'Add new board setting';
		$this->admin_skins = 'Skins';
		$this->admin_stats = 'Statistics center';
		$this->admin_your_board = 'Your Board';
		$this->admin_new_captcha = 'Add new captcha pair';
		$this->admin_list_captcha = 'List existing captcha pairs';
	}

	public function backup()
	{
		$this->backup = 'Backup';
		$this->backup_add = 'Add';
		$this->backup_add_complete = 'Add complete';
		$this->backup_create = 'Backup Database';
		$this->backup_created = 'Backup successfully created in %s';
		$this->backup_createfile = 'Backup and create a file on server';
		$this->backup_done = 'The database has been backed up to the packages directory.';
		$this->backup_download = 'Backup and download (recommended)';
		$this->backup_failed = 'Failed to create backup.';
		$this->backup_found = 'The following backups were found in the packages directory';
		$this->backup_import_fail = 'Failed to import backup.';
		$this->backup_invalid = 'The backup does not appear to be valid. No changes were made to your database.';
		$this->backup_no_packages = 'Failed to locate packages directory.';
		$this->backup_noexist = 'Sorry, that backup does not exist.';
		$this->backup_none = 'No backups were found in the packages directory.';
		$this->backup_options = 'Database Backup Options';
		$this->backup_restore = 'Restore Backup';
		$this->backup_restore_done = 'The database has been restored successfully.';
		$this->backup_statements = 'statements';
		$this->backup_uncheck = 'Unchecking this will NOT empty the database tables before restoring the backup!';
		$this->backup_warning = '<b>Warning:</b> This will overwrite all existing data used by QSF Portal.';
	}

	public function ban()
	{
		$this->ban = 'Ban';
		$this->ban_banned_ips = 'Ban IP Addresses';
		$this->ban_banned_members = 'Banned Members';
		$this->ban_cidr = 'You can also ban by CIDR ranges. CIDR ranges can be easily obtained by looking the IP up at arin.net';
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

	public function board()
	{
		$this->board_active_users = 'Active Users';
		$this->board_birthdays = 'Today\'s Birthdays';
		$this->board_bottom_page = 'Go to the bottom of the page';
		$this->board_can_post = 'You can reply in this forum.';
		$this->board_can_topics = 'You can view but not create topics in this forum.';
		$this->board_cant_post = 'You cannot reply in this forum.';
		$this->board_cant_topics = 'You cannot view or create topics in this forum.';
		$this->board_forum = 'Forum';
		$this->board_forum_url = 'URL Redirect:';
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
		$this->board_unread = 'Jump to oldest unread post';
		$this->board_users = 'users';
		$this->board_write_topics = 'You can view and create topics in this forum.';
	}

	public function censoring()
	{
		$this->censor = 'Censor Words';
		$this->censor_one_per_line = 'One per line.';
		$this->censor_regex_allowed = 'Regular expressions are allowed. You can use a single * as a wildcard for one or more characters.';
		$this->censor_updated = 'Word list updated.';
	}

	public function conversations()
	{
		$this->cv_conversations = 'Private Conversations';
		$this->cv_attach = 'Attachments';
		$this->cv_attach_add = 'Add Attachment';
		$this->cv_attach_disrupt = 'Adding or removing attachments will not disrupt your post.';
      $this->cv_attached_downloads = 'Downloads';
		$this->cv_attach_failed = 'The attachment upload failed. The file you specified may not exist.';
      $this->cv_attached_image = 'Attached image:';
		$this->cv_attach_not_allowed = 'You cannot attach files of that type.';
		$this->cv_attach_remove = 'Remove Attachment';
		$this->cv_attach_too_large = 'The specified file is too large. The maximum size is %d KB.';
      $this->cv_attached = 'Attached file:';
      $this->cv_attached_downloads = 'Downloads';
      $this->cv_attached_filename = 'Filename:';
      $this->cv_attached_size = 'Size:';
      $this->cv_bottom = 'Go to the bottom of the page';
		$this->cv_by = 'By';
      $this->cv_cannot_send = 'The conversation cannot be started. The recipients may not exist, or they all have private conversations disabled.';
      $this->cv_edited = 'Last edited %s by %s';
      $this->cv_error = 'There were problems starting a conversation with some of the recipients.<br /><br />The following members do not exist: %s<br /><br />The following members are not accepting private conversations: %s';
      $this->cv_flood = 'You have started a conversation in the past %s seconds, and you may not send another right now.<br /><br />Please try again in a few seconds.';
      $this->cv_group = 'Group';
		$this->cv_guest = 'As a guest, you cannot use private conversations. Please login or register.';
		$this->cv_guest_user = 'Guest';
		$this->cv_icon = 'Message Icon';
      $this->cv_joined = 'Joined';
		$this->cv_jump = 'Jump to newest post in topic';
		$this->cv_last = 'Last Post';
      $this->cv_multiple = 'Separate multiple recipients with commas.';
      $this->cv_msg = 'Message';
		$this->cv_new_convo = 'New Conversation';
      $this->cv_newer = 'Newer Conversation';
      $this->cv_new_post = 'Post is unread';
		$this->cv_no_convos = 'You have no private conversations to display.';
      $this->cv_no_message = 'No message content was provided for the conversation you are trying to start.';
      $this->cv_no_recipients = 'You cannot start a conversation without specifying at least one recipient.';
      $this->cv_no_title = 'A conversation requires a title. Please go back and enter one.';
      $this->cv_not_found_message = 'The conversation could not be found. It may have been deleted, moved, or perhaps never existed.';
      $this->cv_no_newer = 'There is no newer conversation.';
		$this->cv_no_older = 'There is no older conversation.';
      $this->cv_older = 'Older Conversation';
		$this->cv_offline = 'This member is currently offline';
		$this->cv_online = 'This member is currently online';
		$this->cv_option_emojis = 'Convert emojis into images?';
		$this->cv_option_bbcode = 'Format BBCode?';
      $this->cv_options = 'Options';
		$this->cv_pages = 'Pages';
      $this->cv_post = 'Post';
      $this->cv_posts = 'Posts';
      $this->cv_preview = 'Preview';
      $this->cv_private_conversations = 'Private Conversations';
      $this->cv_quickreply = 'Quick Reply';
      $this->cv_quote = 'Reply with a quote from this post';
		$this->cv_replies = 'Replies';
      $this->cv_reply = 'Reply to Topic';
      $this->cv_sent_mail = 'has started a private conversation with you.';
      $this->cv_started = 'Your conversation has been started.';
		$this->cv_starter = 'Starter';
      $this->cv_title = 'Title';
      $this->cv_to = 'To';
      $this->cv_top = 'Go to the top of the page';
		$this->cv_topic = 'Topic';
		$this->cv_topic_posted = 'Posted';
		$this->cv_unread = 'Jump to oldest unread post';
      $this->cv_unreg = 'Unregistered';
		$this->cv_views = 'Views';
      $this->cv_viewing = 'Viewing Conversation';
	}

	public function cp()
	{
		$this->cp_already_member = 'The email address you entered is already assigned to a member.';
		$this->cp_apr = 'April';
		$this->cp_aug = 'August';
		$this->cp_avatar_current = 'Your current avatar';
		$this->cp_avatar_error = 'Avatar Error';
		$this->cp_avatar_gravatar = 'Specify a Gravatar email address';
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
		$this->cp_gravatar_upload_failed = 'The email address you entered was not a valid format.';
		$this->cp_bday = 'Birthday';
		$this->cp_been_updated = 'Your profile has been updated.';
		$this->cp_been_updated1 = 'Your avatar has been updated.';
		$this->cp_been_updated_prefs = 'Your preferences have been updated.';
		$this->cp_changing_email = 'Change Email Address';
		$this->cp_changing_pass = 'Editing Password';
		$this->cp_contact_pm = 'Allow others to contact you via the messenger?';
		$this->cp_contact_pm_email = 'Send email notification of personal messages when received?';
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
		$this->cp_facebook = 'Facebook Page';
		$this->cp_feb = 'February';
		$this->cp_file_type = 'The avatar you entered is not valid. Make sure the url is correctly formatted, and the file type is either gif, jpg, or png.';
		$this->cp_format = 'Name Formatting';
		$this->cp_header = 'User Control Panel';
		$this->cp_height = 'Height';
		$this->cp_interest = 'Interests';
		$this->cp_jan = 'January';
		$this->cp_july = 'July';
		$this->cp_june = 'June';
		$this->cp_label_edit_avatar = 'Edit Avatar';
		$this->cp_label_edit_pass = 'Edit Password';
		$this->cp_label_edit_prefs = 'Edit Preferences';
		$this->cp_label_edit_profile = 'Edit Profile';
		$this->cp_label_edit_sig = 'Edit Signature';
		$this->cp_label_edit_sig_spam = 'Your signature update has been blocked due to spam filtering restrictions.';
		$this->cp_label_edit_subs = 'Edit Subscriptions';
		$this->cp_language = 'Language';
		$this->cp_less_charac = 'Your name must be less than 32 characters.';
		$this->cp_location = 'Location';
		$this->cp_login_first = 'You must be logged in to access your control panel.';
		$this->cp_mar = 'March';
		$this->cp_may = 'May';
		$this->cp_must_orig = 'Your name must be identical to the original. You may only change the letter case and spacing.';
		$this->cp_new_notmatch = 'The new passwords you entered do not match.';
		$this->cp_new_pass = 'New Password';
		$this->cp_no_edit_avatar = 'You are not allowed to edit your avatar.';
		$this->cp_no_edit_profile = 'You are not allowed to edit your profile.';
		$this->cp_no_edit_sig = 'You are not allowed to edit your signature.';
		$this->cp_no_flash = 'Flash avatars are not allowed on this board.';
		$this->cp_not_exist = 'The date you specified (%s) does not exist!';
		$this->cp_nov = 'November';
		$this->cp_oct = 'October';
		$this->cp_old_notmatch = 'The old password you entered does not match the one in our database.';
		$this->cp_old_pass = 'Old Password';
		$this->cp_pass = 'Password';
		$this->cp_pass2 = 'Only required if changing Email';
		$this->cp_pass_notmatch = 'The password you entered does not match the one in our database.';
		$this->cp_pass_notvaid = 'Your password is not valid. Make sure it uses only valid characters such as letters, numbers, dashes, underscores, or spaces.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.';
		$this->cp_preferences = 'Changing Preferences';
		$this->cp_preview_sig = 'Signature Preview:';
		$this->cp_privacy = 'Privacy Options';
		$this->cp_profile_spam = 'Your profile URL update has been blocked due to spam filter restrictions.';
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
		$this->cp_twitter = 'Twitter Username';
		$this->cp_updated = 'Profile Updated';
		$this->cp_updated1 = 'Avatar Updated';
		$this->cp_updated_prefs = 'Preferences Updated';
		$this->cp_user_exists = 'A user with that name formatting already exists.';
		$this->cp_valided = 'Your password was validated and changed.';
		$this->cp_view_avatar = 'View Avatars?';
		$this->cp_view_emoji = 'View Emojis?';
		$this->cp_view_signature = 'View Signatures?';
		$this->cp_welcome = 'Welcome to the user control panel. From here, you can configure your account. Please choose from the options above.';
		$this->cp_width = 'Width';
		$this->cp_www = 'Blog or Other Homepage';
		$this->cp_zone = 'Time Zone';
	}

	public function db_repair()
	{
		$this->repair_db = 'Repair Database';
		$this->repaired_db = 'The tables in the database have been repaired.';
	}

	public function email()
	{
		$this->email_akismet_email_spam = 'Your email has been flagged as spam and has not been delivered.';
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

	public function emoji_control()
	{
		$this->emoji = 'Emoji Controls';
		$this->emoji_add = 'Add New Emoji';
		$this->emoji_added = 'Emoji added.';
		$this->emoji_back = 'Back to Emoji Controls';
		$this->emoji_clickable = 'Clickable';
		$this->emoji_controls = 'QSF Portal Emoji Controls';
		$this->emoji_edit_or_delete = 'Edit or Delete Emoji';
		$this->emoji_image = 'Image File';
		$this->emoji_invalid_image = 'Invalid image type %s. Valid file types are jpg, png and gif.';
		$this->emoji_image_failed = 'Image failed to upload!';
		$this->emoji_no_text = 'No emoji text was given.';
		$this->emoji_text = 'Text';
	}

	public function files()
	{
		$this->file = 'File';
		$this->files = 'Files';
		$this->files_action_not_allowed = 'Action Not Allowed';
		$this->files_action_not_permitted = 'You are not permitted to perform that action!';
		$this->files_add_cat = 'Add Category';
		$this->files_add_cat_desc = 'Category description';
		$this->files_add_cat_done = 'New category has been added.';
		$this->files_add_cat_exists = 'A category named %s already exists in %s.';
		$this->files_add_cat_name = 'New category name';
		$this->files_add_cat_not_allowed = 'You have not been permitted to add categories.';
		$this->files_add_cat_parent = 'Parent category';
		$this->files_add_cat_qperms = 'Quick Permissions';
		$this->files_add_cat_qperms2 = 'Select an existing category to copy its permissions.';
		$this->files_add_mod = 'Add Moderator';
		$this->files_add_mod2 = 'Add User as Moderator';
		$this->files_add_mod_cat = 'To which existing category?';
		$this->files_add_mod_made = 'has been made a moderator.';
		$this->files_add_mod_not_allowed = 'You do not have permission to add a moderator.';
		$this->files_add_mod_nouser = 'That user was not found.';
		$this->files_added = 'Date Added';
		$this->files_all_fields_required = 'All fields are required.';
		$this->files_approval_not_permitted = 'Sorry, you do not have permission to approve, deny or download this file.';
		$this->files_approval_waiting = 'Files Awaiting Approval';
		$this->files_approve = 'Approve Files';
		$this->files_approve2 = 'Approve';
		$this->files_approve_error = 'Error. You cannot go this far without a category attached.';
		$this->files_approve_none = 'There are no files waiting for approval at this time.';
		$this->files_approved = 'has been approved.';
		$this->files_author = 'Author';
		$this->files_cat = 'Category';
		$this->files_cat_edited = 'Category has been edited.';
		$this->files_cat_exists = 'A category named %s already exists in %s.';
		$this->files_close_window = 'Close window.';
		$this->files_comment = 'Add Comment';
		$this->files_comment_empty = 'Your comment does not contain anything.';
		$this->files_comment_not_permitted = 'You are not permitted to post comments.';
		$this->files_comment_posted = 'Your comment has been posted.';
		$this->files_comment_specify = 'No file was specified.';
		$this->files_comment_user = 'User Comments For';
		$this->files_comment_view = 'View Comments';
		$this->files_comments = 'Comments';
		$this->files_delete_cat = 'Delete Category';
		$this->files_delete_cat2 = 'Delete which existing category?';
		$this->files_delete_cat_done = 'The category has been deleted.';
		$this->files_delete_cat_not_empty = 'The %s category is not empty. Cannot delete.';
		$this->files_delete_cat_not_exist = 'The category does not exist. It may have been deleted, or never existed.';
		$this->files_delete_cat_not_permitted = 'You have not been permitted to delete categories.';
		$this->files_delete_confirm = 'Are you sure you want to delete';
		$this->files_delete_file = 'Delete File';
		$this->files_delete_file_done = 'has been deleted.';
		$this->files_delete_file_not_permitted = 'You have not been permitted to delete files.';
		$this->files_delete_file_specify = 'You must specify a file to delete.';
		$this->files_delete_nocat = 'No such category.';
		$this->files_delete_root = 'You cannot delete the root category.';
		$this->files_denied = 'has been denied.';
		$this->files_deny = 'Deny';
		$this->files_desc = 'Description';
		$this->files_dl = 'D/L';
		$this->files_download = 'Download';
		$this->files_download_not_permitted = 'You have not been permitted to download files.';
		$this->files_download_specify = 'You must specify a file to download.';
		$this->files_downloads = 'Downloads';
		$this->files_downloads2 = 'downloads';
		$this->files_edit_cat_not_parent = 'You cannot make the category its own parent!';
		$this->files_edit_cat_not_permitted = 'You have not been permitted to edit this category.';
		$this->files_edit_category = 'Edit Category';
		$this->files_edit_file = 'Edit File';
		$this->files_edit_mod = 'You can only edit categories that you moderate.';
		$this->files_edit_not_permitted = 'You have not been permitted to edit files.';
		$this->files_edit_root = 'You cannot edit the root category.';
		$this->files_error_duplicate = 'Unable to process: Duplicate filename error.';
		$this->files_error_trick = 'You tried to tricks us!';
		$this->files_error_unknown = 'Unable to process: Unknown file error.';
		$this->files_exists = 'A file like that already exists in the database.';
		$this->files_fix_stats = 'Fix File Stats';
		$this->files_fix_stats2 = 'The file stats have been corrected.';
		$this->files_has_updated = 'has been updated with new information.';
		$this->files_index = 'File Index';
		$this->files_invalid_category = 'An invalid category was entered. Please check the URL.';
		$this->files_invalid_file = 'An invalid file ID was entered. Please check the URL.';
		$this->files_invalid_option = 'Invalid option flag';
		$this->files_moderator = 'Moderator';
		$this->files_modify_info = 'Modify File Information';
		$this->files_move = 'Move';
		$this->files_move_category = 'Move %s to which category?';
		$this->files_move_file = 'Move File';
		$this->files_move_no_category = 'No such category.';
		$this->files_move_not_permitted = 'You have not been permitted to move files.';
		$this->files_moved_file = 'has been moved.';
		$this->files_name = 'Name';
		$this->files_rate = 'Rate File';
		$this->files_rate_already = 'You have already rated this file.';
		$this->files_rate_average = 'Average';
		$this->files_rate_excellent = 'Excellent';
		$this->files_rate_good = 'Good';
		$this->files_rate_please = 'Please rate this file';
		$this->files_rate_poor = 'Poor';
		$this->files_rate_sucks = 'Sucks!';
		$this->files_rate_thank = 'Thank you for rating this file.';
		$this->files_rate_valid = 'You must provide a valid file.';
		$this->files_rating = 'Rating';
		$this->files_recent = 'Recent Uploads';
		$this->files_recent_uploads = 'Files uploaded in the last 10 days';
		$this->files_recent_uploads_none = 'No files have been uploaded in the last 10 days.';
		$this->files_remove_mod = 'Remove Moderator';
		$this->files_remove_mod_cat = 'Which category\'s moderator would you like to remove?';
		$this->files_remove_mod_done = 'The moderator for that category has been removed.';
		$this->files_remove_mod_not_permitted = 'You do not have permission to remove a moderator.';
		$this->files_revised = 'Revised on';
		$this->files_revisions = 'Revisions';
		$this->files_search = 'File Search';
		$this->files_search2 = 'Search';
		$this->files_search3 = 'Search Files';
		$this->files_search_advanced = 'Advanced Search';
		$this->files_search_basic = 'Basic Search';
		$this->files_search_by = 'Search By';
		$this->files_search_day = 'day';
		$this->files_search_days = 'days';
		$this->files_search_display_first = 'Display the first';
		$this->files_search_display_more = 'Display files with more than';
		$this->files_search_error = 'You have to search by at least the name, author or descripton.';
		$this->files_search_error_something = 'You must provide something to search for.';
		$this->files_search_error_none = 'No files found.';
		$this->files_search_for = 'Search For';
		$this->files_search_in = 'Search In';
		$this->files_search_minimum_rating = 'Minimum Rating';
		$this->files_search_month = 'month';
		$this->files_search_months = 'months';
		$this->files_search_newer = 'newer';
		$this->files_search_older = 'older';
		$this->files_search_results = 'Search results for';
		$this->files_search_results2 = 'results';
		$this->files_search_than = 'than';
		$this->files_search_week = 'week';
		$this->files_search_weeks = 'weeks';
		$this->files_search_year = 'year';
		$this->files_size = 'File Size';
		$this->files_submitted_by = 'Submitted by';
		$this->files_top20 = 'Recent Uploads';
		$this->files_type = 'File Type';
		$this->files_update = 'Update';
		$this->files_update_approval_not_permitted = 'You do not have the permission to approve this update.';
		$this->files_update_approve = 'Approve Update';
		$this->files_update_approve_failed = 'Failed to copy update into downloads directory!';
		$this->files_update_approved = 'The update has been approved.';
		$this->files_update_denied = 'Update has been denied and purged.';
		$this->files_update_deny = 'Deny Update';
		$this->files_update_desc = 'The file information has been updated.';
		$this->files_update_exists = 'A file by that name already exists in the database.';
		$this->files_update_file = 'Update File';
		$this->files_update_file_need_desc = 'The description field must be filled in.';
		$this->files_update_not_exist = 'This file does not exist and cannot be updated.';
		$this->files_update_not_exist2 = 'You cannot approve updates that do not exist!';
		$this->files_update_not_permitted = 'You do not have the permission to update this file.';
		$this->files_update_pending = 'Your update has been uploaded and is pending approval.';
		$this->files_updated = 'Last Updated';
		$this->files_upload = 'Upload File';
		$this->files_upload_no_root = 'Cannot upload to the Root category.';
		$this->files_upload_not_permitted = 'You have not been permitted to upload files.';
		$this->files_upload_pending = 'The file has been uploaded and is pending approval.';
		$this->files_upload_rules = 'Upload Rules';
		$this->files_uploaded = 'The file has been uploaded.';
		$this->files_version = 'Version';
		$this->files_view = 'View File';
		$this->files_view_archive = 'Archive';
		$this->files_view_c = 'C Source';
		$this->files_view_category = 'View Category';
		$this->files_view_cat_not_permitted = 'You are not permitted to view this category.';
		$this->files_view_cpp = 'C++ Source';
		$this->files_view_java = 'Java Source';
		$this->files_view_perl = 'Perl Script';
		$this->files_view_php = 'PHP Source';
		$this->files_view_plain = 'Plain Text';
		$this->files_view_python = 'Python Script';
		$this->files_view_specify = 'You must specify a file id to view.';
	}

	public function forum()
	{
		$this->forum_by = 'By';
		$this->forum_can_post = 'You can reply in this forum.';
		$this->forum_can_topics = 'You can view topics in this forum.';
		$this->forum_cant_post = 'You cannot reply in this forum.';
		$this->forum_cant_topics = 'You cannot view topics in this forum.';
		$this->forum_dot = 'dot';
		$this->forum_dot_detail = 'Shows that you have posted in the topic';
		$this->forum_forum = 'Forum';
		$this->forum_forum_url = 'URL Redirect:';
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
		$this->forum_topic_posted = 'Posted';
		$this->forum_unread = 'Jump to oldest unread post';
		$this->forum_views = 'Views';
		$this->forum_write_topics = 'You can create topics in this forum.';
	}

	public function forums()
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
		$this->forum_is_news = 'This forum is where front page news posts are created.';
		$this->forum_is_subcat = 'This forum is a subcategory only.';
		$this->forum_is_url = 'This forum is a URL redirect. The description should be the URL to redirect to.';
		$this->forum_name = 'Name';
		$this->forum_news = 'News Forum';
		$this->forum_news_error = 'The news post forum cannot also be a subcategory or a URL redirect.';
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
		$this->forum_url = 'URL Redirect';
	}

	public function groups()
	{
		$this->groups_bad_format = 'You must use %s in the format, which represents the group name.';
		$this->groups_based_on = 'based on';
		$this->groups_controls = 'Group Controls';
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
		$this->groups_no_delete = 'There are no custom groups to delete.<br />The core groups are necessary for QSF Portal to function, and cannot be deleted.';
		$this->groups_no_group = 'No group was specified.';
		$this->groups_no_name = 'No group name was given.';
		$this->groups_only_custom = 'Note: You can only delete custom member groups. The core groups are necessary for QSF Portal to function.';
		$this->groups_the = 'The group';
		$this->groups_to_edit = 'Group to edit';
		$this->groups_type = 'Group Type';
		$this->groups_will_be = 'will be deleted.';
		$this->groups_will_become = 'Users from the deleted group will become';
	}

	public function home()
	{
		$this->home_choose = 'Choose a task to begin.';
		$this->home_menu_title = 'Admin CP Menu';
	}

	public function login()
	{
		$this->login = 'Login';
		$this->login_cant_logged = 'You could not be logged in. Check to see that your user name and password are correct.<br /><br />They are case sensitive, so \'UsErNaMe\' is different from \'Username\'. Also, check to see that cookies are enabled in your browser.';
		$this->login_cookies = 'Cookies must be enabled to login.';
		$this->login_did_not_request = 'If you do not want to reset your password, please ignore or delete this email.';
		$this->login_did_request = 'If you did request this, go to the below URL to continue with the password reset:';
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
		$this->login_request_done = 'Your password has been reset to:';
		$this->login_request_done2 = 'You should log in and update it immediately for better security.';
		$this->login_request_ip = 'This request was sent from IP:';
		$this->login_someome_requested = 'Someone has requested a password reset for your forum account,';
		$this->login_sure = 'Are you sure you wish to logoff from \'%s\'?';
		$this->login_user = 'User Name';
	}

	public function logs()
	{
		$this->logs_action = 'Action';
		$this->logs_category = 'Category';
		$this->logs_category_created = 'Created a file category';
		$this->logs_category_deleted = 'Deleted a file category';
		$this->logs_category_edited = 'Edited a file category';
		$this->logs_category_from = 'from category';
		$this->logs_category_in = 'in category';
		$this->logs_deleted_post = 'Deleted a post';
		$this->logs_deleted_topic = 'Deleted a topic';
		$this->logs_edited_post = 'Edited a post';
		$this->logs_edited_topic = 'Edited a topic';
		$this->logs_file = 'File';
		$this->logs_file_deleted = 'Deleted a file';
		$this->logs_file_edited = 'Edited a file';
		$this->logs_file_moved = 'Moved a file';
		$this->logs_file_update_approved = 'Approved a file update';
		$this->logs_file_update_denied = 'Denied a file update';
		$this->logs_file_updated = 'Updated a file';
		$this->logs_id = 'IDs';
		$this->logs_locked_topic = 'Locked a topic';
		$this->logs_mod_add = 'Set a file moderator';
		$this->logs_mod_remove = 'Removed a file moderator';
		$this->logs_moved_from = 'from forum';
		$this->logs_moved_to = 'to forum';
		$this->logs_moved_topic = 'Moved a topic';
		$this->logs_moved_topic_num = 'Moved topic #';
		$this->logs_pinned_topic = 'Pinned a topic';
		$this->logs_post = 'Post';
		$this->logs_published_topic = 'Published a topic';
		$this->logs_reported_spam = 'Reported spam';
		$this->logs_time = 'Time';
		$this->logs_topic = 'Topic';
		$this->logs_unlocked_topic = 'Unlocked a topic';
		$this->logs_unpinned_topic = 'Unpinned a topic';
		$this->logs_unpublished_topic = 'Unpublished a topic';
		$this->logs_user = 'User';
		$this->logs_view = 'View Moderator Actions';
	}

	public function main()
	{
		$this->main_activate = 'Your account has not yet been activated.';
		$this->main_activate_resend = 'Resend Activation Email';
		$this->main_admincp = 'Admin CP';
		$this->main_affiliates = 'Related Links';
		$this->main_banned = 'You have been banned from viewing any portion of this board.';
		$this->main_code = 'Code';
		$this->main_cp = 'Control Panel';
		$this->main_files = 'Files';
		$this->main_forum = 'Forum';
		$this->main_forum_rules = 'Forum Rules';
		$this->main_full = 'Full';
		$this->main_guests = 'Guests';
		$this->main_help = 'Help';
		$this->main_home = 'Home';
		$this->main_load = 'load';
		$this->main_login = 'Login';
		$this->main_logout = 'Logout';
		$this->main_mark = 'Mark all';
		$this->main_mark1 = 'Mark all topics as read';
		$this->main_markforum_read = 'Mark forum as read';
		$this->main_member_newest = 'Newest Member';
		$this->main_members = 'Members';
		$this->main_messenger = 'Messenger';
		$this->main_new = 'new';
		$this->main_news = 'News';
		$this->main_next = 'next';
		$this->main_pages = 'Pages';
		$this->main_posted_by = 'Posted by';
		$this->main_posts = 'Posts';
		$this->main_prev = 'prev';
		$this->main_queries = 'queries';
		$this->main_quote = 'Quote';
		$this->main_recent = 'Recent Posts';
		$this->main_recent1 = 'View recent topics since your last visit';
		$this->main_recent_uploads = 'Recent Uploads';
		$this->main_register = 'Register';
		$this->main_reminder = 'Reminder';
		$this->main_reminder_closed = 'The board is closed and only viewable to admins.';
		$this->main_said = 'said';
		$this->main_search = 'Search';
		$this->main_spam_controls = 'Spam Controls';
		$this->main_stats = 'Stats';
		$this->main_top_posters = 'Top Posters';
		$this->main_top_uploaders = 'Top Uploaders';
		$this->main_topics = 'Topics';
		$this->main_topics_new = 'There are new posts in this forum.';
		$this->main_topics_old = 'There are no new posts in this forum.';
		$this->main_tos_files = 'Terms of Service: Uploads';
		$this->main_tos_forums = 'Terms of Service: Forums';
		$this->main_users_online = 'Users Online';
		$this->main_visitors = 'Today\'s Visitors:';
		$this->main_welcome = 'Welcome';
		$this->main_welcome_guest = 'Welcome!';
	}

	public function mass_mail()
	{
		$this->mail = 'Mass Mail';
		$this->mail_announce = 'Announcement From';
		$this->mail_groups = 'Recipient Groups';
		$this->mail_members = 'members.';
		$this->mail_message = 'Message';
		$this->mail_select_all = 'Select All';
		$this->mail_send = 'Send Mail';
		$this->mail_sent = 'Your message has been sent to';
		$this->mail_subject = 'Subject';
	}

	public function member_control()
	{
		$this->mc = 'Member Control';
		$this->mc_confirm = 'Are you sure you want to delete';
		$this->mc_confirm_bot = 'Are you sure you want to report <b>%s</b> as a spambot?';
		$this->mc_delete = 'Delete Member';
		$this->mc_deleted = 'Member Deleted.';
		$this->mc_edit = 'Edit Member';
		$this->mc_edited = 'Member Updated';
		$this->mc_email_invaid = 'The email address you entered is invalid.';
		$this->mc_err_updating = 'Error Updating Profile';
		$this->mc_find = 'Find members with names containing';
		$this->mc_found = 'The following members were found. Please select one.';
		$this->mc_guest_banned = 'You cannot ban Guests, this would cause your board to become unusable.';
		$this->mc_guest_needed = 'The guest account is necessary for QSF Portal to function.';
		$this->mc_not_found = 'No members were found matching';
		$this->mc_report_spambot = 'Report as Spambot';
		$this->mc_user_avatar = 'Avatar';
		$this->mc_user_avatar_height = 'Avatar Height';
		$this->mc_user_avatar_type = 'Avatar Type';
		$this->mc_user_avatar_width = 'Avatar Width';
		$this->mc_user_birthday = 'Birthday';
		$this->mc_user_email = 'Email Address';
		$this->mc_user_email_show = 'Email Is Public';
		$this->mc_user_facebook = 'Facebook Page';
		$this->mc_user_group = 'Group';
		$this->mc_user_twitter = 'Twitter ID';
		$this->mc_user_homepage = 'Blog or Other Homepage';
		$this->mc_user_id = 'User ID';
		$this->mc_user_interests = 'Interests';
		$this->mc_user_joined = 'Member Since';
		$this->mc_user_language = 'Language';
		$this->mc_user_lastpost = 'Last Post';
		$this->mc_user_lastvisit = 'Last Visit';
		$this->mc_user_level = 'Level';
		$this->mc_user_location = 'Location';
		$this->mc_user_name = 'Name';
		$this->mc_user_pm = 'Accepting Private Messages';
		$this->mc_user_pm_mail = 'Email Private Messages';
		$this->mc_user_posts = 'Posts';
		$this->mc_user_regemail = 'Registration Email';
		$this->mc_user_regip = 'Registration IP';
		$this->mc_user_server_data = 'HTTP Raw Data';
		$this->mc_user_signature = 'Signature';
		$this->mc_user_skin = 'Skin';
		$this->mc_user_timezone = 'Time Zone';
		$this->mc_user_title = 'Member Title';
		$this->mc_user_title_custom = 'Use a Custom Member Title';
		$this->mc_user_uploads = 'Uploads';
		$this->mc_user_view_avatars = 'Viewing Avatars';
		$this->mc_user_view_emojis = 'Viewing Emojis';
		$this->mc_user_view_signatures = 'Viewing Signatures';
	}

	public function membercount()
	{
		$this->mcount = 'Fix Member Statistics';
		$this->mcount_updated = 'Member Count Updated.';
	}

	public function members()
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
		$this->members_visit_facebook = 'Visit this member\'s Facebook page';
		$this->members_visit_twitter = 'Visit this member\'s Twitter page';
		$this->members_visit_www = 'Visit this member\'s web site';
		$this->members_www = 'Web Sites';
	}

	public function mod()
	{
		$this->mod_confirm_post_delete = 'Are you sure you want to delete this post?';
		$this->mod_confirm_post_delete_spam = 'Are you sure you want to delete this post and report it as spam?';
		$this->mod_confirm_topic_delete = 'Are you sure you want to delete the topic?';
		$this->mod_delete_post_locked = 'You cannot delete a post in a locked topic.';
		$this->mod_edit_post_locked = 'You cannot edit a post in a locked topic.';
		$this->mod_edit_post_old = 'You cannot edit a post older than %d hours.';
		$this->mod_error_first_post = 'You cannot delete the first post in a topic.';
		$this->mod_error_move_category = 'You cannot move a topic to a category.';
		$this->mod_error_move_create = 'You do not have permission to move topics to that forum.';
		$this->mod_error_move_forum = 'You cannot move a topic to a forum that does not exist.';
		$this->mod_error_move_global = 'You cannot move a global topic. Edit the topic before moving it.';
		$this->mod_error_move_same = 'You cannot move a topic to the forum it is already in.';
		$this->mod_ip_view = 'View IP History';
		$this->mod_ip_view_not_allowed = 'You are not permitted to view poster IP history.';
		$this->mod_ip_view_posted = '%s has posted from the following IP addresses:<br />';
		$this->mod_label_controls = 'Moderator Controls';
		$this->mod_label_description = 'Description';
		$this->mod_label_emoji = 'Convert emojis into images?';
		$this->mod_label_global = 'Global Topic';
		$this->mod_label_bbcode = 'Format BBCode?';
		$this->mod_label_move_to = 'Move to';
		$this->mod_label_options = 'Options';
		$this->mod_label_post_delete = 'Delete Post';
		$this->mod_label_post_edit = 'Editing post in topic: ';
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

	public function news()
	{
		$this->news_comments = 'comment(s)';
		$this->news_more = 'Read more...';
		$this->news_previous = 'Previous news...';
	}

	public function newspost()
	{
		$this->newspost_comments = 'Comments:';
		$this->newspost_news = 'News';
		$this->newspost_no_article = 'No such article exists.';
		$this->newspost_post_comment = 'Post Comment';
		$this->newspost_post_emojis = 'Convert emojis into images?';
		$this->newspost_post_bbcode = 'Format BBCode?';
	}

	public function optimize()
	{
		$this->optimize = 'Optimize Database';
		$this->optimized = 'The tables in the database have been optimized for maximum performance.';
	}

	public function page()
	{
		$this->page = 'Page';
		$this->page_action_not_allowed = 'Action not allowed!';
		$this->page_contents = 'Contents';
		$this->page_create = 'Create Page';
		$this->page_create2 = 'Create';
		$this->page_create_not_permitted = 'You are not permitted to create pages.';
		$this->page_created = 'Page created.';
		$this->page_creating = 'Creating a page';
		$this->page_delete = 'Delete a page';
		$this->page_delete_confirm = 'Are you sure you want to delete this page forever? This process is irreversable.';
		$this->page_delete_not_permitted = 'You are not permitted to delete pages.';
		$this->page_deleted = 'Page deleted.';
		$this->page_edit = 'Edit Page';
		$this->page_edit_done = 'Page successfully edited.';
		$this->page_edit_not_permitted = 'You are not permitted to edit pages.';
		$this->page_editing = 'Editing a page';
		$this->page_format_bbcode = 'Format BBCode?';
		$this->page_format_breaks = 'Format Breaks?';
		$this->page_format_censor = 'Censor Contents?';
		$this->page_format_emojis = 'Format Emojis?';
		$this->page_format_html = 'Format HTML?';
		$this->page_not_exist = 'That page does not exist!';
		$this->page_title = 'Title';
		$this->page_viewing = 'Viewing a page';
		$this->pages = 'Pages';
		$this->pages_none = 'There are no custom pages yet.';
	}

	public function perms()
	{
		$this->perm = 'Permission';
		$this->perms = 'Permissions';
		$this->perms_board_view = 'View the board index';
		$this->perms_board_view_closed = 'Use QSF Portal when it is closed';
		$this->perms_create_pages = 'Can create custom pages';
		$this->perms_delete_pages = 'Can delete custom pages';
		$this->perms_do_anything = 'Use QSF Portal';
		$this->perms_edit_avatar = 'Can edit user avatar';
		$this->perms_edit_for = 'Edit permissions for';
		$this->perms_edit_pages = 'Can edit custom pages';
		$this->perms_edit_profile = 'Can edit user profile';
		$this->perms_edit_sig = 'Can edit signatures';
		$this->perms_email_use = 'Send emails to members via the board';
		$this->perms_for = 'Permissions For';
		$this->perms_forum = 'Forum Permissions';
		$this->perms_forum_view = 'View the forum';
		$this->perms_global = 'Global Permissions';
		$this->perms_group = 'Group';
		$this->perms_guest1 = 'You cannot stop Guests from using the board. The board would become unusable by anyone.';
		$this->perms_guest2 = 'You cannot stop the Guest Group from using the board. The board would become unusable by anyone.';
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
		$this->perms_post_delete_old = 'Delete posts after time limit expires';
		$this->perms_post_delete_own = 'Delete only posts the user has created';
		$this->perms_post_edit = 'Edit any post';
		$this->perms_post_edit_old = 'Edit posts after time limit expires';
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
		$this->perms_topic_unlock_own = 'Unlock only topics the user has created';
		$this->perms_topic_unpin = 'Unpin any topic';
		$this->perms_topic_unpin_own = 'Unpin only topics the user has created';
		$this->perms_topic_view = 'View topics';
		$this->perms_topic_view_unpublished = 'View unpublished topics';
		$this->perms_update = 'Update Permissions';
		$this->perms_updated = 'Permissions have been updated.';
		$this->perms_user = 'User';
		$this->perms_user_inherit = 'The user will inherit the group\'s permissions.';
	}

	public function php_info()
	{
		$this->php_error = 'Error';
		$this->php_error_msg = 'phpinfo() can not be executed. It appears that your host has disabled this feature.';
	}

	public function pm()
	{
		$this->pm_avatar = 'Avatar';
		$this->pm_cant_del = 'You do not have permission to delete this message.';
		$this->pm_delallmsg = 'Delete All Messages';
		$this->pm_delete = 'Delete';
		$this->pm_delete_selected = 'Delete Selected Messages';
		$this->pm_deleted = 'Message deleted.';
		$this->pm_deleted_all = 'Messages deleted.';
		$this->pm_error = 'There were problems sending your message to some of the recipients.<br /><br />The following members do not exist: %s<br /><br />The following members are not accepting personal messages: %s';
		$this->pm_fields = 'Your message could not be sent. Make sure all required fields are filled in.';
		$this->pm_flood = 'You have sent a message in the past %s seconds, and you may not send another right now.<br /><br />Please try again in a few seconds.';
		$this->pm_folder_inbox = 'Inbox';
		$this->pm_folder_new = '%s new';
		$this->pm_folder_sentbox = 'Outbox';
		$this->pm_from = 'From';
		$this->pm_group = 'Group';
		$this->pm_guest = 'As a guest, you cannot use the messenger. Please login or register.';
		$this->pm_joined = 'Joined';
		$this->pm_mark_unread = 'Message marked as unread.';
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
		$this->pm_sent_mail = 'has sent you a private message.';
		$this->pm_success = 'Your message was sent successfully.';
		$this->pm_sure_del = 'Are you sure you want to delete this message?';
		$this->pm_sure_delall = 'Are you sure you want to delete all messages from this folder?';
		$this->pm_title = 'Title';
		$this->pm_to = 'To';
	}

	public function post()
	{
		$this->post_akismet_posts_spam = 'Your post has been flagged as spam and must be approved by a moderator.';
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
		$this->post_new_poll = 'Creating new poll in:';
		$this->post_new_topic = 'Posting new topic in:';
		$this->post_no_forum = 'That forum was not found.';
		$this->post_no_topic = 'No topic was specified.';
		$this->post_no_vote = 'You must choose an option to vote for.';
		$this->post_option_emojis = 'Convert emojis into images?';
		$this->post_option_global = 'Make this topic global?';
		$this->post_option_lock = 'Lock topic after posting?';
		$this->post_option_bbcode = 'Format BBCode?';
		$this->post_option_pin = 'Pin topic after posting?';
		$this->post_optional = 'optional';
		$this->post_options = 'Options';
		$this->post_poll_options = 'Poll Options';
		$this->post_poll_row = 'One per line';
		$this->post_posted = 'Posted';
		$this->post_posting = 'Posting';
		$this->post_preview = 'Preview';
		$this->post_reply = 'Reply';
		$this->post_reply_topic = 'Replying to topic \'%s\' in:';
		$this->post_replying = 'Replying To Topic';
		$this->post_replying1 = 'Replying';
		$this->post_too_many_options = 'You must have between 2 and %d options to a poll.';
		$this->post_topic_detail = 'Topic Description';
		$this->post_topic_title = 'Topic Title';
		$this->post_view_topic = 'View Entire Topic';
		$this->post_voting = 'Voting';
	}

	public function profile()
	{
		$this->profile_av_sign = 'Avatar and Signature';
		$this->profile_avatar = 'Avatar';
		$this->profile_bday = 'Birthday';
		$this->profile_contact = 'Contact';
		$this->profile_email_address = 'Email Address';
		$this->profile_facebook = 'Facebook Page';
		$this->profile_fav = 'Favorite Forum';
		$this->profile_fav_forum = '%s (%d%% of this member\'s posts)';
		$this->profile_info = 'Information';
		$this->profile_interest = 'Interests';
		$this->profile_joined = 'Joined';
		$this->profile_last_post = 'Last Post';
		$this->profile_last_visit = 'Last Visited';
		$this->profile_list = 'Member List';
		$this->profile_location = 'Location';
		$this->profile_member = 'Member Group';
		$this->profile_member_title = 'Member Title';
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
		$this->profile_twitter = 'Twitter ID';
		$this->profile_unkown = '[ Unknown ]';
		$this->profile_upload_last = 'Last Upload';
		$this->profile_uploads = 'Uploads';
		$this->profile_uploads_none = 'No uploads yet.';
		$this->profile_uploads_none_yet = 'None yet.';
		$this->profile_uploads_per_day = 'per day';
		$this->profile_uploads_total = 'total';
		$this->profile_view_profile = 'Viewing Profile';
		$this->profile_www = 'Blog or Other Homepage';
	}

	public function prune()
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
		$this->prune_old_topics = 'Prune Old Topics';
		$this->prune_select_age = 'Select age of topics to limit pruning to';
		$this->prune_select_topics = 'Select topics to prune or use Select All';
		$this->prune_success = 'Topics have been pruned';
		$this->prune_title = 'Topic Pruner';
		$this->prune_topics_older_than = 'Prune topics older than';
	}

	public function query()
	{
		$this->query = 'Query Interface';
		$this->query_fail = 'failed.';
		$this->query_success = 'executed successfully.';
		$this->query_your = 'Your query';
	}

	public function recent()
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
		$this->recent_topic_posted = 'Posted';
		$this->recent_views = 'Views';
		$this->recent_write_topics = 'You can create topics in this forum.';
	}

	public function register()
	{
		$this->register_activated = 'Your account has been activated!';
		$this->register_activating = 'Account Activation';
		$this->register_activation_error = 'There was an error while activating your account. Check to see if your browser contains the full url in the activation email. If the problem persists, contact the board administrator to have your email resent.';
		$this->register_akismet_ureg_spam = 'Registration blocked by spam filtering. If you believe this to be in error, please contact the administration.';
		$this->register_confirm_passwd = 'Confirm Password';
		$this->register_cookie_required = 'You must enable cookies in order to register on this site.';
		$this->register_done = 'You have been registered! You can now login.';
		$this->register_email = 'Email Address';
		$this->register_email_invalid = 'The email address you entered is invalid.';
		$this->register_email_msg = 'This is an automated email generated by QSF Portal, and sent to you in order';
		$this->register_email_msg2 = 'for you to activate your account with';
		$this->register_email_msg3 = 'Please click the following link, or paste it in to your web browser:';
		$this->register_email_used = 'The email address you entered is already assigned to a member.';
		$this->register_fields = 'Not all fields are filled in.';
		$this->register_flood = 'You have registered already.';
		$this->register_image = 'Please type the text shown in the image.';
		$this->register_image_invalid = 'To verify you are a human registrant, you must type the text as shown in the image.';
		$this->register_initiated = 'This request was initiated from IP:';
		$this->register_math_ask = 'Please answer the following';
		$this->register_math_fail = 'You failed to correctly answer the question. Please try again.';
		$this->register_must_activate = 'You have been registered. An email has been sent to %s with information on how to activate your account. Your account will be limited until you activate it.';
		$this->register_name_invalid = 'The name you entered is too long.';
		$this->register_name_taken = 'That member name is already taken.';
		$this->register_new_user = 'Desired User Name';
		$this->register_pass_invalid = 'The password you entered is not valid. Make sure it uses only valid characters such as letters, numbers, dashes, underscores, or spaces, and is at least 5 characters.';
		$this->register_pass_match = 'The passwords you entered do not match.';
		$this->register_passwd = 'Password';
		$this->register_reg = 'Register';
		$this->register_reging = 'Registering';
		$this->register_registration_disabled = 'New user registration has been disabled on this site.';
		$this->register_requested = 'Account activation request for:';
		$this->register_tos = 'Terms of Service';
		$this->register_tos_i_agree = 'I agree to the above terms';
		$this->register_tos_missing = 'The administrators have not yet written terms of service for this site. Registrations are disabled until they do so.';
		$this->register_tos_not_agree = 'You did not agree to the terms.';
		$this->register_tos_read = 'Please read the following terms of service:';
		$this->register_what_is = 'What is ';
	}

	public function rssfeed()
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

	public function search()
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

	public function settings()
	{
		$this->settings = 'Settings';
		$this->settings_active = 'Active Users Settings';
		$this->settings_allow = 'Allow';
		$this->settings_akismet_email_enable = 'Email Form Protection';
		$this->settings_akismet_email_enable_msg = 'Spam filter protection for the user email forms.';
		$this->settings_akismet_posts_enable = 'Forum Post Protection';
		$this->settings_akismet_posts_enable_msg = 'Spam filter protection for forum posts.';
		$this->settings_akismet_posts_number = 'Number of posts before a user is exempt from spam filtering.';
		$this->settings_akismet_profiles_enable = 'User Profile Protection';
		$this->settings_akismet_profiles_enable_msg = 'Spam filter protection for user profiles.';
		$this->settings_akismet_ureg_enable = 'User Registration Protection';
		$this->settings_akismet_ureg_enable_msg = 'Spam filter protection for new user registrations.';
		$this->settings_akismet_sigs_enable = 'User Signature Protection';
		$this->settings_akismet_sigs_enable_msg = 'Spam filter protection for user signatures.';
		$this->settings_antibot = 'Anti-Robot Registration';
		$this->settings_attach_ext = 'Post Attachments - Allowed File Extensions';
		$this->settings_attach_one_per = 'One per line. No periods.';
		$this->settings_avatar = 'Avatar Settings';
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
		$this->settings_captcha_pair = 'Add Captcha Pair';
		$this->settings_captcha_added = 'New captcha pair was added successfully.';
		$this->settings_captcha_answer = 'Answer';
		$this->settings_captcha_delete = 'Delete Captcha Pair';
		$this->settings_captcha_deleted = 'Captcha pair has been deleted successfully.';
		$this->settings_captcha_display = 'Display Captcha Pairs';
		$this->settings_captcha_edit = 'Edit Captcha Pair';
		$this->settings_captcha_edited = 'Captcha pair has been updated successfully.';
		$this->settings_captcha_invalid = 'Invalid captcha pair value specified.';
		$this->settings_captcha_missing = 'The question and answer must both be filled in.';
		$this->settings_captcha_new_answer = 'New Captcha Answer';
		$this->settings_captcha_new_question = 'New Captcha Question';
		$this->settings_captcha_no_pair = 'No such captcha pair exists.';
		$this->settings_captcha_question = 'Question';
		$this->settings_cookie = 'Cookie and Flood Settings';
		$this->settings_cookie_domain = 'Cookie Domain';
		$this->settings_cookie_path = 'Cookie Path';
		$this->settings_cookie_prefix = 'Cookie Prefix';
		$this->settings_cookie_secure = 'Cookie Security';
		$this->settings_cookie_secured = 'Is your site SSL secured?';
		$this->settings_cookie_time = 'Time to Remain Logged In';
		$this->settings_default_lang = 'Default Language';
		$this->settings_default_no = 'Default No';
		$this->settings_default_skin = 'Default Skin';
		$this->settings_default_yes = 'Default Yes';
		$this->settings_disabled = 'Disabled';
		$this->settings_disabled_notice = 'Disabled Notice';
		$this->settings_edit_post_age = 'Hours until post cannot be edited or deleted';
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
		$this->settings_files = 'File Settings';
		$this->settings_file_approval = 'File Uploads - Approval Required?';
		$this->settings_front_page_links = 'Front Page Links';
		$this->settings_general = 'General Settings';
		$this->settings_google_id = 'Google Analytics Code';
		$this->settings_google_msg = 'Copy and paste the Javascript Tracking Code snippet from your Google Analytics account for this site here to enable Analytics.';
		$this->settings_group_after = 'Group After Registration';
		$this->settings_hot_topic = 'Posts for a Hot Topic';
		$this->settings_kilobytes = 'Kilobytes';
		$this->settings_left_sidebar = 'Left Sidebar';
		$this->settings_max_attach_size = 'Post Attachments - Maximum File Size';
		$this->settings_members = 'Member Settings';
		$this->settings_meta_keywords = 'Meta Keywords';
		$this->settings_meta_description = 'Meta Description';
		$this->settings_mobile_icons = 'Mobile Icon Meta Tags';
		$this->settings_mobile_icons_desc = 'Link tags for optional mobile icons (ie: Apple Touch, Android, etc).';
		$this->settings_mobile_icons_details = 'See here for details.';
		$this->settings_new = 'New Setting';
		$this->settings_new_add = 'Add New Board Setting';
		$this->settings_new_added = 'New settings added.';
		$this->settings_new_array = 'Check here if this is a new array. Separate elements of the array with commas.';
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
		$this->settings_registrations = 'New User Registrations';
		$this->settings_right_sidebar = 'Right Sidebar';
		$this->settings_search_flood = 'Search Flood Control';
		$this->settings_search_min_time = 'Minimum time between searches.';
		$this->settings_security = 'Security Settings';
		$this->settings_security_caution = 'CAUTION - These settings should only be used if you do not have direct control over the web server configuration and the headers are not already being sent by the site your installation is hosted on. Duplicating security headers can cause conflicting information that may render your site inoperable.';
		$this->settings_security_test = 'Check your header responses with a trusted testing site such as <a href="https://securityheaders.com/">Security Headers</a> before attempting to enable or adjust any of these settings.';
		$this->settings_security_csp = 'Content-Security-Policy';
		$this->settings_security_csp_detail = 'Check this box to enable the <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP">Content-Security-Policy security header</a>.';
		$this->settings_security_csp_warning = 'This is a complex and often detailed policy. Please note that this field performs NO VALIDATION on the input you provide. You will need to determine policy based on your site\'s individual needs. Incorrect setup can lead to your site functioning improperly or failing to load at all.';
		$this->settings_security_fp = 'Feature-Policy';
		$this->settings_security_fp_detail = 'Check this box to enable the <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Feature-Policy">Feature-Policy security header</a>.';
		$this->settings_security_fp_warning = 'This policy can have numerous directives to enable or deny. NO VALIDATION is performed on the input in this field. Incorrect setup may lead to your site functioning improperly.';
		$this->settings_security_ect = 'Expect-CT';
		$this->settings_security_ect_detail = 'Check this box to enable the <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Expect-CT">Expect-CT security header</a>.';
		$this->settings_security_ect_max_age = 'Maximum age for the header to be valid, in seconds:';
		$this->settings_security_ect_warning = 'NOTE: Test this with short duration values in case your Certificate Authority is non-compliant with this tag. If they are not, you will not be able to connect to the site until the timer expires.';
		$this->settings_security_htts = 'Strict Transport Security';
		$this->settings_security_htts_detail = 'Check this box to enable the <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Strict-Transport-Security">HSTS security header</a>.';
		$this->settings_security_htts_max_age = 'Maximum age for the header to be valid, in seconds:';
		$this->settings_security_htts_warning = 'NOTE: If you need to disable this header for some reason, set the max age to 0 but leave it enabled for awhile. This will give the site a chance to update everyone\'s browsers with the new policy before you disable it completely.';
		$this->settings_security_xcto = 'X-Content-Type-Options';
		$this->settings_security_xcto_detail = 'Check this box to enable the <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Content-Type-Options">X-Content-Type-Options security header</a>.';
		$this->settings_security_xcto_explain = 'Enabling this option blocks CSS requsts for types other than text/css and Script requests for unrecognized Javascript MIME types.';
		$this->settings_security_xfo = 'X-Frame-Options';
		$this->settings_security_xfo_deny = 'Deny - No sites can put this one in frames.';
		$this->settings_security_xfo_detail = 'Check this box to enable the <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Frame-Options">X-Frame-Options security header</a>.';
		$this->settings_security_xfo_frames = 'Frames are only allowed from the specified origin:';
		$this->settings_security_xfo_same = 'Same Origin - Only this site is allowed to put itself in frames [Default]';
		$this->settings_server = 'Server Settings';
		$this->settings_server_timezone = 'Server Time Zone';
		$this->settings_show_avatars = 'Show Avatars';
		$this->settings_show_email = 'Show Email Address';
		$this->settings_show_emojis = 'Show Emojis';
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
		$this->settings_tos_files = 'Terms of Service: Uploads';
		$this->settings_updated = 'Settings have been updated.';
		$this->settings_validating_user_purge_time = 'Number of days to wait before purging unvalidated user accounts.';
		$this->settings_wordpress_id = 'Wordpress API Key';
		$this->settings_wordpress_msg = 'Enter your Wordpress API Key here. It is required before the anti-spam filters will work. An API key may be obtained at: ';
	}

	public function skins()
	{
		$this->skins_dir = 'Stored in Folder';
		$this->skins_confirm_disable = 'Are you sure you wish to disable this skin? Anyone using it will be reset to the site default skin.';
		$this->skins_disable = 'Disable';
		$this->skins_disable_skin = 'Disable Skin';
		$this->skins_disabled = 'Skins Found on Server';
		$this->skins_enable = 'Enable';
		$this->skins_enabled = 'Skins Enabled';
		$this->skins_enable_skin = 'Enable Skin';
		$this->skins_invalid_option = 'Invalid option selected.';
		$this->skins_is_disabled = ' has been disabled. All users set to use it are now using the site default skin.';
		$this->skins_is_enabled = ' has been enabled and is now available for all users.';
		$this->skins_manage_skins = 'Manage Skins';
		$this->skins_must_select = 'You must select a skin before you can delete one.';
		$this->skins_name = 'Skin Name';
		$this->skins_no_disable_default = 'You cannot disable the default skin for the site.';
		$this->skins_no_disable_default = 'You cannot enable the default skin for the site, as it is always enabled.';
		$this->skins_cant_disable = 'The skin you specified either does not exist or is already disabled.';
	}

	public function spam_control()
	{
		$this->spam_action = 'Action';
		$this->spam_all_deleted = 'All flagged spam has been deleted.';
		$this->spam_author = 'Author';
		$this->spam_clear_all = 'Clear Entire Table';
		$this->spam_control = 'Spam Control';
		$this->spam_controls = 'Akismet: Spam Controls';
		$this->spam_deleted = 'Spam Deleted';
		$this->spam_false_positive = 'The post has been approved and Akismet notified of a false positive.';
		$this->spam_invalid_option = 'Invalid option passed.';
		$this->spam_message1 = 'Forum posts flagged as spam. Click on <span style="color:yellow">Not Spam</span> to allow posting and notify Akismet of a false positive.';
		$this->spam_message2 = 'Click on <span style="color:yellow">Delete</span> to remove it now. Spam left here will be deleted after 30 days automatically.';
		$this->spam_no_post = 'There is no such spam post.';
		$this->spam_no_view = 'You do not have permission to view this module.';
		$this->spam_not_spam = 'Not Spam';
		$this->spam_text = 'Text';
	}

	public function stats()
	{
		$this->stats = 'Statistics Center';
		$this->stats_false_neg = 'False Negatives';
		$this->stats_false_pos = 'False Positives';
		$this->stats_forum_posts = 'Forum Posts';
		$this->stats_post_by_month = 'Posts by Month';
		$this->stats_prof = 'Profiles';
		$this->stats_reg = 'Registrations';
		$this->stats_reg_by_month = 'Registrations by Month';
		$this->stats_sig = 'Signatures';
		$this->stats_spam_statistics = 'Spam Statistics';
	}

	public function titles()
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

	public function topic()
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
		$this->topic_delete_spam = 'Report this post as spam';
		$this->topic_edit = 'Edit';
		$this->topic_edit_post = 'Edit this post';
		$this->topic_edited = 'Last edited %s by %s';
		$this->topic_error = 'Error';
		$this->topic_group = 'Group';
		$this->topic_guest = 'Guest';
		$this->topic_ip = 'IP';
		$this->topic_joined = 'Joined';
		$this->topic_level = 'Member Level';
		$this->topic_links_email = 'Send an email to %s';
		$this->topic_links_facebook = 'Visit this member\'s Facebook page';
		$this->topic_links_twitter = 'Visit %s\'s Twitter page';
		$this->topic_links_pm = 'Send a personal messsage to %s';
		$this->topic_links_web = 'Visit %s\'s web site';
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
		$this->topic_qr_emojis = 'Emojis';
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

	public function universal()
	{
		$this->based_on = 'Based on';
		$this->board_by = 'By';
		$this->charset = 'utf-8';
		$this->continue = 'Continue';
		$this->date = 'Date';
		$this->date_long = 'M j, Y';
		$this->date_short = 'n/j/y';
		$this->default = 'Default';
		$this->delete = 'Delete';
		$this->direction = 'ltr';
		$this->edit = 'Edit';
		$this->email = 'Email';
		$this->error = 'Error';
		$this->error_404 = 'The page you are trying to reach either does not exist, or has been deleted.';
		$this->gmt_nev12  = 'GMT-12    - Baker Island/International Dateline West';
		$this->gmt_nev11  = 'GMT-11    - Pacific: Midway Islands';
		$this->gmt_nev10a = 'GMT-10    - USA: Alaska (Aleutian Islands)';
		$this->gmt_nev10  = 'GMT-10    - USA: Hawaii Time Zone';
		$this->gmt_nev09  = 'GMT-9     - USA: Alaska Time Zone';
		$this->gmt_nev08  = 'GMT-8     - US/Canada: Pacific Time Zone';
		$this->gmt_nev07a = 'GMT-7     - US/Canada: Mountain Time Zone';
		$this->gmt_nev07  = 'GMT-7     - USA: Mountain Time Zone (Arizona)';
		$this->gmt_nev06  = 'GMT-6     - US/Canada: Central Time Zone';
		$this->gmt_nev05  = 'GMT-5     - US/Canada: Eastern Time Zone';
		$this->gmt_nev04  = 'GMT-4     - US/Canada: Atlantic Time Zone';
		$this->gmt_nev03b = 'GMT-3.5   - Canada: Newfoundland';
		$this->gmt_nev03a = 'GMT-3     - Argentina';
		$this->gmt_nev03  = 'GMT-3     - Brazil: Sao Paulo';
		$this->gmt_nev02  = 'GMT-2     - Brazil: Atlantic islands/Noronha';
		$this->gmt_nev01  = 'GMT-1     - Europe: Portugal/Azores';
		$this->gmt_00000  = 'GMT       - Europe: Greenwich Mean Time (UK/Ireland)';
		$this->gmt_0000a  = 'GMT       - Europe: Greenwich Mean Time (Iceland)';
		$this->gmt_pos01  = 'GMT+1     - Europe: France/Germany/Spain';
		$this->gmt_pos02  = 'GMT+2     - Europe: Greece (Athens)';
		$this->gmt_pos03  = 'GMT+3     - Europe: Russia (Moscow)';
		$this->gmt_pos03a = 'GMT+3.5   - Asia: Iran';
		$this->gmt_pos04  = 'GMT+4     - Asia: Oman/United Arab Emerites';
		$this->gmt_pos04a = 'GMT+4.5   - Asia: Afghanistan';
		$this->gmt_pos05  = 'GMT+5     - Asia: Pakistan';
		$this->gmt_pos05a = 'GMT+5.5   - Asia: India';
		$this->gmt_pos06  = 'GMT+6     - Asia: Kazakhstan';
		$this->gmt_pos06a = 'GMT+6.5   - Asia: Myanmar';
		$this->gmt_pos07  = 'GMT+7     - Asia: Thailand/Cambodia/Laos';
		$this->gmt_pos08  = 'GMT+8     - Asia: China/Mongolia/Phillipines';
		$this->gmt_pos08a = 'GMT+8     - Australia: Western (Perth)';
		$this->gmt_pos08b = 'GMT+8.75  - Australia: Western (Eucla)';
		$this->gmt_pos09  = 'GMT+9     - Asia: Japan/Korea/New Guinea';
		$this->gmt_pos09a = 'GMT+9.5   - Australia: New South Wales (Yancowinna)';
		$this->gmt_pos09b = 'GMT+9.5   - Australia: Northern Territory (Darwin)';
		$this->gmt_pos10  = 'GMT+10    - Australia: Queensland';
		$this->gmt_pos10a = 'GMT+10    - Australia: Tasmania';
		$this->gmt_pos10b = 'GMT+10    - Australia: Victoria/New South Wales';
		$this->gmt_pos10c = 'GMT+10.5  - Australia: Lord Howe Island';
		$this->gmt_pos11  = 'GMT+11    - Pacific: Solomon Islands/Vanuatu/New Caledonia';
		$this->gmt_pos12  = 'GMT+12    - Asia: Kamchatka';
		$this->gmt_pos12a = 'GMT+12    - Pacific: New Zealand/Fiji';
		$this->gmt_pos12b = 'GMT+12    - Pacific: Tuvalu/Marshall Islands';
		$this->gmt_pos12c = 'GMT+12.75 - Pacific: Chatham Islands';
		$this->gmt_pos13  = 'GMT+13    - Pacific: Tonga/Phoenix Islands';
		$this->gmt_pos14  = 'GMT+14    - Pacific: Line Islands';

		$this->invalid_token = 'The security validation token used to verify you are authorized to perform this action is either invalid or expired. Please try again.';
		$this->new_message = 'New Message';
		$this->new_poll = 'New Poll';
		$this->new_topic = 'New Topic';
		$this->no = 'No';
		$this->none = 'None';
		$this->powered = 'Powered by';
		$this->private_message = 'PM';
		$this->quote = 'Quote';
		$this->recount_forums = 'Recounted forums! Total topics: %d. Total posts: %d.';
		$this->reply = 'Reply';
		$this->seconds = 'Seconds';
		$this->select_all = 'Select All';
		$this->sep_decimals = '.';
		$this->sep_thousands = ',';
		$this->spam = 'Spam';
		$this->spoiler = 'Spoiler';
		$this->submit = 'Submit';
		$this->subscribe = 'Subscribe';
		$this->time_long = ' g:i a';
		$this->time_only = 'g:i a';
		$this->today = 'Today';
		$this->topic = 'Topic';
		$this->twitter = 'Twitter';
		$this->website = 'WWW';
		$this->yes = 'Yes';
		$this->yesterday = 'Yesterday';
	}
}
?>