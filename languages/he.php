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
 * Hebrew language module
 *
 * @author דוד ר
 * @since 1.1.0
 **/
class he
{
	function active()
	{
		$this->active_last_action = 'פעילות אחרונה';
		$this->active_modules_active = 'צופה ברשימת משתמשים פעילים';
		$this->active_modules_board = 'באינדקס הפורומים';
		$this->active_modules_cp = 'משתמש בלוח בקרה אישי';
		$this->active_modules_forum = '%s :מציג את הפורום';
		$this->active_modules_help = 'משתמש בעזרה';
		$this->active_modules_login = 'מתחבר\מתנתק';
		$this->active_modules_members = 'צופה ברשימת חברי הפורום';
		$this->active_modules_mod = 'מסדר פורומים';
		$this->active_modules_pm = 'משתמש המסנג\'ר פרטי';
		$this->active_modules_post = 'מפרסם הודעה';
		$this->active_modules_printer = '%s :מדפיס את ההודעה';
		$this->active_modules_profile = '%s :מציג את הפרופיל';
		$this->active_modules_recent = 'מציג את ההודעות האחרונות';
		$this->active_modules_search = 'מחפש';
		$this->active_modules_topic = '%s :מציג את ההודעה';
		$this->active_time = 'זמן';
		$this->active_user = 'משתמש';
		$this->active_users = 'משתמשים פעילים';
	}

	function admin()
	{
		$this->admin_add_emoticons = 'הוספת סמלי הבעה';
		$this->admin_add_member_titles = 'הוספת כותרת חבר אוטומטית';
		$this->admin_add_templates = 'HTML הוספת תבניות';
		$this->admin_ban_ips = 'IP חסימת כתובות';
		$this->admin_censor = 'מילים מצונזרות';
		$this->admin_cp_denied = 'הגישה נדחתה';
		$this->admin_cp_warning = 'מאחר והיא יוצרת בעיית אבטחה חמורה. <b>ההתקנה<b> לוח בקרת המנהל יהיה מנוטרל עד מחיקת ספריית';
		$this->admin_create_forum = 'יצירת פורום';
		$this->admin_create_group = 'יצירת קבוצה';
		$this->admin_create_help = 'יצירת מאמר עזרה';
		$this->admin_create_skin = 'יצירת סקין';
		$this->admin_db = 'מסד נתונים';
		$this->admin_db_backup = 'גבוי מסד נתונים';
		$this->admin_db_conn = 'עריכת הגדרות התחברות';
		$this->admin_db_optimize = 'ייעול מסד הנתונים';
		$this->admin_db_query = 'SQL ביצוע שאילתת';
		$this->admin_db_restore = 'שיחזור מגיבוי';
		$this->admin_delete_forum = 'מחיקת פורום';
		$this->admin_delete_group = 'מחיקת קבוצה';
		$this->admin_delete_help = 'מחיקת מאמר עזרה';
		$this->admin_delete_member = 'מחיקת חבר';
		$this->admin_delete_template = 'HTML מחיקת תבנית';
		$this->admin_edit_emoticons = 'עריכה או מחיקת סמלי הבעה';
		$this->admin_edit_forum = 'עריכת פורום';
		$this->admin_edit_group_name = 'עריכת שם קבוצה/ות';
		$this->admin_edit_group_perms = 'עריכת הרשאות קבוצה/ות';
		$this->admin_edit_help = 'עריכת מאמר עזרה';
		$this->admin_edit_member = 'עריכת חבר';
		$this->admin_edit_member_perms = 'עריכת הרשאות חבר/ים';
		$this->admin_edit_member_titles = 'עריכה או מחיקת כותרת חבר אוטומטית';
		$this->admin_edit_settings = 'עריכת הגדרות לוח';
		$this->admin_edit_skin = 'סקין עריכה או מחיקת';
		$this->admin_edit_templates = 'HTML עריכת תבניות';
		$this->admin_emoticons = 'סמלי הבעה';
		$this->admin_export_skin = 'ייצוא סקין';
		$this->admin_fix_stats = 'סדר סטטיסטיקות חבר';
		$this->admin_forum_order = 'שינוי סדר הפרומים';
		$this->admin_forums = 'פורומים וקטגוריות';
		$this->admin_groups = 'קבוצות';
		$this->admin_heading = 'Quicksilver לוח הבקרה של מנהל הפורומים של';
		$this->admin_help = 'מאמרי עזרה';
		$this->admin_install_emoticons = 'התקנת סמלי הבעה';
		$this->admin_install_skin = 'סקין התקנת';
		$this->admin_logs = 'תצוגת פעילות מנהל';
		$this->admin_mass_mail = 'שליחת אימייל לחברים';
		$this->admin_members = 'חברים';
		$this->admin_phpinfo = 'PHP תצוגת מידע';
		$this->admin_prune = 'מחיקת הודעות ישנות';
		$this->admin_recount_forums = 'ספירת הודעות ותגובות';
		$this->admin_settings = 'הגדרות';
		$this->admin_settings_add = 'Add new board setting'; //Translate
		$this->admin_skins = 'סקינים';
		$this->admin_stats = 'מרכז הסטטיסטיקות';
		$this->admin_upgrade_skin = 'סקין שידרוג';
		$this->admin_your_board = 'הפורום שלך';
	}

	function backup()
	{
		$this->backup_create = 'גיבוי מסד נתונים';
		$this->backup_createfile = 'Backup and create a file on server'; //Translate
		$this->backup_done = '.Quicksilver מסד הנתונים גובה לספרייה הראשית של הפורומים של';
		$this->backup_download = 'Backup and download (recommended)'; //Translate
		$this->backup_found = '.Quicksilver הגיבויים הבאים נמצאו בספריית הפורומים של';
		$this->backup_invalid = '.אין אפשרות לבצע גיבוי. לא נעשו שינויים במסד הנתונים';
		$this->backup_none = '.Quicksilver לא נמצאו גיבויים בספריית הפורומים של';
		$this->backup_options = 'Select how you want your backup created'; //Translate
		$this->backup_restore = 'שחזר גיבוי';
		$this->backup_restore_done = '.מסד הנתונים שוחזר בהצלחה';
		$this->backup_warning = '.Quicksilver אזהרה: פעולה זו תשכתב את כל הנתונים בשימוש הפורומים של';
	}

	function ban()
	{
		$this->ban = 'חסום';
		$this->ban_banned_ips = 'חסומות IP כתובות';
		$this->ban_banned_members = 'חברים חסומים';
		$this->ban_ip = 'חסומות IP כתובות';
		$this->ban_member_explain1 = 'לחסימת משתמשים, שנה את קבוצת המשתמשים שלהם ל';
		$this->ban_member_explain2 = '.בלוח בקרת המשתמשים';
		$this->ban_members = 'חברים חסומים';
		$this->ban_nomembers = 'אין כרגע חברים חסומים.';
		$this->ban_one_per_line = '.כתובת אחת לכל שורה';
		$this->ban_regex_allowed = 'ביטויים רגילים מורשים. באפשרותך להשתמש ב * בודדה כתו כללי לספרה אחת או יותר.';
		$this->ban_settings = 'הגדרות חסימה';
		$this->ban_users_banned = '.משתמשים חסומים';
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
		$this->board_active_users = 'משתמשים פעילים';
		$this->board_birthdays = 'ימי הולדת היום:';
		$this->board_bottom_page = 'עבור לתחתית העמוד';
		$this->board_can_post = 'אתה יכול להגיב בפורום הזה.';
		$this->board_can_topics = 'אתה יכול לצפות בפורום אך לא לפרסם נושאים חדשים.';
		$this->board_cant_post = 'אינן יכול להגיב בפורום הזה';
		$this->board_cant_topics = 'אינך מורשה לקרוא או לפרסם הודעות בפורום הזה.';
		$this->board_forum = 'פורום';
		$this->board_guests = 'אורחים';
		$this->board_last_post = 'הודעה אחרונה';
		$this->board_mark = 'סמן כל ההודעות כנקראו';
		$this->board_mark1 = 'כל ההודועת פורומים סומנו כנקראו.';
		$this->board_markforum = 'Marking Forum As Read'; //Translate
		$this->board_markforum1 = 'All posts in the forum %s have been marked as read.'; //Translate
		$this->board_members = 'משתמשים';
		$this->board_message = '%s הודעה';
		$this->board_most_online = '%s ב %d מספר המשתמשים המירבי שהיה מחובר הוא';
		$this->board_nobday = 'אין ימי הולדת היום.';
		$this->board_nobody = 'אין כרגע משתמש מחוברים.';
		$this->board_nopost = 'אין הודעות';
		$this->board_noview = 'אין לך הרשאות לראות פורום.';
		$this->board_regfirst = 'אין לך הרשאות לראות פורום. אם אתה נרשם, אתה יכול לראות פורום.';
		$this->board_replies = 'תגובות';
		$this->board_stats = 'סטטיסטיקות';
		$this->board_stats_string = 'הודעות. %s תגובות סה"כ %s נושאים ו %s ישנם <b /> .%s משתמשים נרשמו.ברוך הבא משתמש חדש  %s';
		$this->board_top_page = 'עבור לראש העמוד';
		$this->board_topics = 'נושאים';
		$this->board_users = 'משתמשים';
		$this->board_write_topics = 'הינך יכול לראות ולכתוב בפורום הזה.';
	}

	function censoring()
	{
		$this->censor = 'מילים מצונזרות';
		$this->censor_one_per_line = 'אחת בכל שורה.';
		$this->censor_regex_allowed = 'ביטויים רגילים מורשים. באפשרותך להשתמש ב * בודדה כתו כללי לתו אחד או יותר.';
		$this->censor_updated = '.רשימת המילים עודכנה';
	}

	function cp()
	{
		$this->cp_aim = 'שם משתמש של AIM';
		$this->cp_already_member = 'דואר אלקטרוני שכתבת כבר בשימוש על ידי משתמש אחר.';
		$this->cp_apr = 'אפריל';
		$this->cp_aug = 'אוגוסט';
		$this->cp_avatar_current = 'אווטרה שלך';
		$this->cp_avatar_error = 'שגיאה באווטרה';
		$this->cp_avatar_must_select = 'אתה חייב לבחור אווטרה.';
		$this->cp_avatar_none = 'ללא שימוש באווטרה';
		$this->cp_avatar_pixels = 'פיקסלים';
		$this->cp_avatar_select = 'בחר אווטרה';
		$this->cp_avatar_size_height = 'אורך האווטרה שלך חייב להיות באורך 1 ו';
		$this->cp_avatar_size_width = 'רוחב האווטרה שלך חייב להיות ברוחב 1 ו';
		$this->cp_avatar_upload = 'העלת אווטרה ממחשב שלך';
		$this->cp_avatar_upload_failed = 'העלה של אווטרה נכשלה. הקובץ לא קיים.';
		$this->cp_avatar_upload_not_image = 'אתה יכול לעות רק תמונות ולהשתמש בהן כאווטרה.';
		$this->cp_avatar_upload_too_large = 'אווטרה שאתה רוצה לעלות גדול מידי. קובל המקסימלי הוא %d קילובייט.';
		$this->cp_avatar_url = 'קישר URL אל האווטרה';
		$this->cp_avatar_use = 'השתמש באווטרה שהעלת';
		$this->cp_bday = 'יום הולדת';
		$this->cp_been_updated = 'פרופיל שלך עודכן.';
		$this->cp_been_updated1 = 'אווטרה שלך הועלה.';
		$this->cp_been_updated_prefs = 'הגדרות שלך עודכנו.';
		$this->cp_changing_pass = 'עריכת סיסמא';
		$this->cp_contact_pm = 'הרשה לאחרים לשלוח לך הודעות פרטיות?';
		$this->cp_cp = 'לוח בקרה';
		$this->cp_current_avatar = 'אווטרה';
		$this->cp_current_time = 'השעה עכשיו %s.';
		$this->cp_custom_title = 'כותרת חבר מותאמת אישית';
		$this->cp_custom_title2 = 'זכויות אלו שמורות למנהלי הלוח';
		$this->cp_dec = 'דצמבר';
		$this->cp_editing_avatar = 'ערכית אווטרה';
		$this->cp_editing_profile = 'ערכית פרופיל';
		$this->cp_email = 'דואר אלקטרוני';
		$this->cp_email_form = 'לאפשר לאחרים ליצור קשר עימך דרך טופס האימייל?';
		$this->cp_email_invaid = 'דואר אלקטרוני שהכנסת שגויי.';
		$this->cp_err_avatar = 'שגיאה בהעלת אווטרה';
		$this->cp_err_updating = 'שגיאה בעידכון פרופיל';
		$this->cp_feb = 'פברואר';
		$this->cp_file_type = 'אווטרה שהכנסת איננו נכון. תבדוק אם הקישור לאווטרה נכון, וסוג קובץ של אווטרה הוא gif, jpg, או png.';
		$this->cp_format = 'שם משתמש';
		$this->cp_gtalk = 'GTalk חשבון';
		$this->cp_header = 'לוח בקרה אישי';
		$this->cp_height = 'אורך';
		$this->cp_icq = 'מספר ICQ';
		$this->cp_interest = 'תחומי עניין';
		$this->cp_jan = 'ינואר';
		$this->cp_july = 'יולי';
		$this->cp_june = 'יוני';
		$this->cp_label_edit_avatar = 'עריכת אווטרה';
		$this->cp_label_edit_pass = 'עריכת סיסמא';
		$this->cp_label_edit_prefs = 'עריכת הגדרות';
		$this->cp_label_edit_profile = 'עריכת פרופיל';
		$this->cp_label_edit_sig = 'עריכת חתימה';
		$this->cp_label_edit_subs = 'ערכית מינויי';
		$this->cp_language = 'שפה';
		$this->cp_less_charac = 'שם שלך יכול להיות 32 מקסימום.';
		$this->cp_location = 'מיקום';
		$this->cp_login_first = 'הינך חייב להיות מחובר כדי לגשת ללוח בקרה.';
		$this->cp_mar = 'מרץ';
		$this->cp_may = 'מאי';
		$this->cp_msn = 'MSN מסנג\'ר';
		$this->cp_must_orig = '.השם שלך חייב להיות זהה למקור. באפשרותך לשנות את גודל האות ורווחים';
		$this->cp_new_notmatch = 'הסיסמא החדשה שהכנסת אינה תואמת.';
		$this->cp_new_pass = 'סיסמא חדשה';
		$this->cp_no_flash = 'אווטרה בפלאש אסורים בלוח זה.';
		$this->cp_not_exist = 'אינו קיים! (%s) התאריך שציינת';
		$this->cp_nov = 'נובמבר';
		$this->cp_oct = 'אוקטובר';
		$this->cp_old_notmatch = 'הסיסמא הישנה שהקלדת אינה קיימת במס הנתונים.';
		$this->cp_old_pass = 'סיסמא ישנה';
		$this->cp_pass_notvaid = 'הסיסמא שלך לא תקינה. וודא שהינך משתמש בתווים תקינים כגון אותיות, מספרים, קו מפריד, קו תחתון ורווחים.';
		$this->cp_posts_page = 'Posts per topic page. 0 resets to board default.'; //Translate
		$this->cp_preferences = 'משנה הגדרות';
		$this->cp_preview_sig = ':הצגה מוקדמת של החתימה';
		$this->cp_privacy = 'אפשרויות פרטיות';
		$this->cp_repeat_pass = 'חזור על הסיסמא החדשה';
		$this->cp_sept = 'ספטמבר';
		$this->cp_show_active = 'להציג את פעילותייך כשאתה משתמש בפורום?';
		$this->cp_show_email = 'להציג כתובת אימייל בפרופיל?';
		$this->cp_signature = 'חתימה';
		$this->cp_size_max = 'פיקסלים. %s על %s האווטר שהכנסת גדול מידי. הגודל המקסימלי המותר הוא';
		$this->cp_skin = 'סקין של פורום';
		$this->cp_sub_change = 'משנה רישום';
		$this->cp_sub_delete = 'מחיקה';
		$this->cp_sub_expire = 'תאריך תפוגה';
		$this->cp_sub_name = 'שם רישום';
		$this->cp_sub_no_params = 'לא ניתנו פרמטרים.';
		$this->cp_sub_success = '.%s הינך רשום כעת ל';
		$this->cp_sub_type = 'סוג הרשמה';
		$this->cp_sub_updated = 'הרישומים שנבחר נמחקו.';
		$this->cp_topic_option = 'אפשרויות נושאים';
		$this->cp_topics_page = 'Topics per forum page. 0 resets to board default.'; //Translate
		$this->cp_updated = 'פרופיל עודכן';
		$this->cp_updated1 = 'אווטרה עודכן';
		$this->cp_updated_prefs = 'הגדרות הודכנו';
		$this->cp_user_exists = 'שם משתמש זה כבר קיים.';
		$this->cp_valided = 'סיסמתך שונתה ותקפה.';
		$this->cp_view_avatar = 'להראות אווטרים?';
		$this->cp_view_emoticon = 'להראות סמיילים?';
		$this->cp_view_signature = 'להראות חתימות?';
		$this->cp_welcome = 'ברוכים הבאים ללוח בקרה אישי. כאן הינך יכול לערוך ולשנות אפשרויות שפורום נותן לך. אנא בחרו מאפשרויות שיש לכם למעלה.';
		$this->cp_width = 'רוחב';
		$this->cp_www = 'דף הבית';
		$this->cp_yahoo = 'Yahoo מסנג\'ר';
		$this->cp_zone = 'איזור הזמן';
	}

	function email()
	{
		$this->email_blocked = 'החר אינו מקבל מיילים דרך טופס זה.';
		$this->email_email = 'דואר אלקטרוני';
		$this->email_msgtext = 'גוף הודעת המייל:';
		$this->email_no_fields = 'חזור אחורה בכדי לוודא שכל השדות מלאים.';
		$this->email_no_member = 'לא נמצא חבר בשם זה';
		$this->email_no_perm = 'אין לך הרשאות לשלוח אימייל דרך הלוח.';
		$this->email_sent = 'הודעה נשלחה.';
		$this->email_subject = 'נושא:';
		$this->email_to = 'אל:';
	}

	function emot_control()
	{
		$this->emote = 'סמלי הבעה';
		$this->emote_add = 'הוסף סמלי הבעה';
		$this->emote_added = 'סמל הבעה התווסף.';
		$this->emote_clickable = 'ניתן ללחיצה';
		$this->emote_edit = 'עריכת סמלי הבעה';
		$this->emote_image = 'תמונה';
		$this->emote_install = 'התקנה סמלי הבעה';
		$this->emote_install_done = 'סמלי הבעה הותקנו מחדש בהצלחה.';
		$this->emote_install_warning = 'פעולה זו תמחק את הגדרות סמלי ההבעה הקיימים ותייבא סמלי הבעה שהועלו מהסקין שכרגע נבחר למסד הנתונים.';
		$this->emote_no_text = 'לא ניתן מלל לסמל ההבעה.';
		$this->emote_text = 'טקסט';
	}

	function forum()
	{
		$this->forum_by = 'על ידי';
		$this->forum_can_post = 'אתה יכול להגיב בפורום הזה.';
		$this->forum_can_topics = 'אתה יכול לראות נושאים בפורום הזה.';
		$this->forum_cant_post = 'אתה לא יכול להגיב בפורום הזה.';
		$this->forum_cant_topics = 'אתה לא יכול לראות נושאים בפורום הזה.';
		$this->forum_dot = 'נקודה';
		$this->forum_dot_detail = 'מראה שהגבת להודעה';
		$this->forum_forum = 'פורום';
		$this->forum_guest = 'אורח';
		$this->forum_hot = 'חם';
		$this->forum_icon = 'אייקון של נושא';
		$this->forum_jump = 'קפוץ להודעה אחרונה בנושא';
		$this->forum_last = 'הודעה אחרונה';
		$this->forum_locked = 'נעול';
		$this->forum_mark_read = 'Mark forum as read'; //Translate
		$this->forum_moved = 'מועבר';
		$this->forum_msg = '%s הודעה';
		$this->forum_new = 'חדש';
		$this->forum_new_poll = 'פרסם סקר חדש';
		$this->forum_new_topic = 'פרסם נושא חדש';
		$this->forum_no_topics = 'אין נושאים להצגה בפורום זה.';
		$this->forum_noexist = 'הפורום שצויין לא קיים.';
		$this->forum_nopost = 'אין הודעות';
		$this->forum_not = 'לא';
		$this->forum_noview = 'אין לך הרשאות לצפות בפורומים האלה.';
		$this->forum_pages = 'עמודים';
		$this->forum_pinned = 'נעוץ';
		$this->forum_pinned_topic = 'נושא נעוץ';
		$this->forum_poll = 'סקר';
		$this->forum_regfirst = 'אינך מורשה לצפות בפורום. אם תירשם, ייתכן ותוכל לצפות.';
		$this->forum_replies = 'תגובות';
		$this->forum_starter = 'מפרסם';
		$this->forum_sub = 'תת-פורום';
		$this->forum_sub_last_post = 'הודעה אחרונה';
		$this->forum_sub_replies = 'תגובות';
		$this->forum_sub_topics = 'נושאים';
		$this->forum_subscribe = 'שלח לי הודעת מייל כשיגיבו לפורום זה';
		$this->forum_topic = 'נושא';
		$this->forum_views = 'צפיות';
		$this->forum_write_topics = 'הינך מורשה ליצור הודעות בפורום זה.';
	}

	function forums()
	{
		$this->forum_controls = 'בקרת הפורום';
		$this->forum_create = 'יצירת פורום';
		$this->forum_create_cat = 'צור קטגוריה';
		$this->forum_created = 'הפורום נוצר';
		$this->forum_default_perms = 'הרשאות ברירת מחדל';
		$this->forum_delete = 'מחיקת פורום';
		$this->forum_delete_warning = 'פעולה זו לא הפיכה. <br />האם אתה בטוח רוצה למחוק את הפורום הזה כולל הודעותיו ותגובותיו?';
		$this->forum_deleted = 'הפורום נמחק.';
		$this->forum_description = 'תאור';
		$this->forum_edit = 'עריכת פורום';
		$this->forum_edited = 'הפורום נערך בהצלחה.';
		$this->forum_empty = 'לא ניתן שם לפורום. אנא חזור ותן שם.';
		$this->forum_is_subcat = 'פורום זה הוא תת-קטגוריה בלבד.';
		$this->forum_name = 'שם';
		$this->forum_no_orphans = 'אינך יכול לייתם פורום ע"י מחיקת פורום האב.';
		$this->forum_none = 'אין פורומים לתפעול.';
		$this->forum_ordered = 'סדר הפורומים עודכן';
		$this->forum_ordering = 'שנה סדר הפורומים';
		$this->forum_parent = 'אינך יכול לשנות את אב הפורום/ים בצורה זו.';
		$this->forum_parent_cat = 'קטגוריית אב';
		$this->forum_quickperm_select = 'בחר בפורום קיים בכדי להעתיק את ההרשאות שלו.';
		$this->forum_quickperms = 'הרשאות מהירות';
		$this->forum_recount = 'ספירת נושאים ותגובות';
		$this->forum_select_cat = 'בחר בטגרויה קיימת בכדי ליצור פורום.';
		$this->forum_subcat = 'תת-קטגוריה';
	}

	function groups()
	{
		$this->groups_bad_format = 'You must use %s in the format, which represents the group name.'; //Translate
		$this->groups_based_on = 'מבוססת על';
		$this->groups_create = 'יצירת קבוצה';
		$this->groups_create_new = 'צור קבוצת משתמשים לדשה בשם';
		$this->groups_created = 'קבוצה נוצרה';
		$this->groups_delete = 'מחיקת קבוצה';
		$this->groups_deleted = 'קבוצה נמחקה.';
		$this->groups_edit = 'עריכת קבוצה';
		$this->groups_edited = 'קבוצה נערכה.';
		$this->groups_formatting = 'הצג תבנית';
		$this->groups_i_confirm = 'אני מאשר שברצוני למחוק את קבוצת החברים.';
		$this->groups_name = 'שם';
		$this->groups_no_action = 'לא נעשתה פעולה.';
		$this->groups_no_delete = ' , ואינן ניתנות למחיקה.Quicksilver קבוצות הליבה חיוניות לתיפקוד הפורומים של<br />אין קבוצות מותאמות אישית למחיקה.';
		$this->groups_no_group = 'לא צויינה קבוצה.';
		$this->groups_no_name = 'לא ניתן שם לקבוצה.';
		$this->groups_only_custom = '.Quicksilver הערה: באפשרותך למחוק רק קבוצות מותאמות אישית. קבוצות הליבה חיוניות לתיפקוד הפורומים של';
		$this->groups_the = 'הקבוצה';
		$this->groups_to_edit = 'קבוצה לעריכה';
		$this->groups_type = 'סוג קבוצה';
		$this->groups_will_be = 'תימחק.';
		$this->groups_will_become = 'משתמשים מהקבוצה המחוקה יהפכו';
	}

	function help()
	{
		$this->help_add = 'הוספת מאמר עזרה';
		$this->help_article = 'בקרת מאמר עזרה';
		$this->help_available_files = 'עזרה';
		$this->help_confirm = 'האם אתה בטוח רוצה למחוק';
		$this->help_content = 'תוכן מאמר';
		$this->help_delete = 'מחיקת מאמר עזרה';
		$this->help_deleted = 'מאמר עזרה נמחק.';
		$this->help_edit = 'עריכת מאמר עזרה';
		$this->help_edited = 'מאמר עזרה עודכן.';
		$this->help_inserted = 'מאמר הוכנס למסד הנתונים.';
		$this->help_no_articles = 'לא נמצאו מאמרי עזרה במסד הנתונים';
		$this->help_no_title = 'אין אפשרות ליצור מאמר עזרה ללא כותרת.';
		$this->help_none = 'אין קבצי עזרה במסד נתונים';
		$this->help_not_exist = 'מאמר עזרה זה לא קיים.';
		$this->help_select = 'בחר במאמר עזרה לעריכה.';
		$this->help_select_delete = 'בחר במאמר עזרה למחיקה.';
		$this->help_title = 'כותרת';
	}

	function home()
	{
		$this->home_choose = 'להתחלה בחר במשימה.';
		$this->home_menu_title = 'תפריט לוח בקרת מנהל';
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
		$this->login_cant_logged = 'בדפדפן שלך. cookies . בנוסף, בדוק שמאופשר\'Username\' \' שונה מUsErNaMe\' ישנה רגישות לאותיות קטנות וגדולות, ז"א<br /><br />לא התאפשרה כניסתך למערכת. בדוק ששם המשתמש והסיסמא נכונים.';
		$this->login_cookies = 'בכדי להיכנס למערכת. cookies חובה לאפשר';
		$this->login_forgot_pass = 'שכחת את הסיסמא?';
		$this->login_header = 'מתחבר';
		$this->login_logged = 'הינך עכשיו מחובר\ת.';
		$this->login_now_out = 'הינך עכשיו מנותק\ת.';
		$this->login_out = 'מתנתק';
		$this->login_pass = 'סיסמא';
		$this->login_pass_no_id = 'לא קיים חבר עם שם המשתמש שהכנסת.';
		$this->login_pass_request = 'להשלמת איפוס סיסמתך, לחץ על הקישור שקיבלת במייל המשוייך עם חשבונך.';
		$this->login_pass_reset = 'איפוס סיסמא';
		$this->login_pass_sent = 'סיסמתך אופסה. הסיסמא החדשה נשלחה למייל המשוייך עם חשבונך.';
		$this->login_sure = 'אתה בטוח שאתה רוצה להתנתק מ \'%s\'?';
		$this->login_user = 'שם משתמש';
	}

	function logs()
	{
		$this->logs_action = 'פעולה';
		$this->logs_deleted_post = 'נמחקה תגובה';
		$this->logs_deleted_topic = 'נמחקה הודעה';
		$this->logs_edited_post = 'נערכה תגובה';
		$this->logs_edited_topic = 'נערכה הודעה';
		$this->logs_id = 'IDs'; //Translate
		$this->logs_locked_topic = 'ננעלה הודעה';
		$this->logs_moved_from = 'מהפורום';
		$this->logs_moved_to = 'לפורום';
		$this->logs_moved_topic = 'הועברה הודעה';
		$this->logs_moved_topic_num = 'הועברה הודעה #';
		$this->logs_pinned_topic = 'ננעצה הודעה';
		$this->logs_post = 'תגובה';
		$this->logs_time = 'זמן';
		$this->logs_topic = 'נושא';
		$this->logs_unlocked_topic = 'שוחררה הודעה';
		$this->logs_unpinned_topic = 'נותקה הודעה';
		$this->logs_user = 'משתמש';
		$this->logs_view = 'הצג פעילות מבקר';
	}

	function main()
	{
		$this->main_activate = 'חשבונך לא הופעל עדיין.';
		$this->main_activate_resend = 'שלח מחדש מייל הפעלה';
		$this->main_admincp = 'לוח בקרה של מנהל';
		$this->main_banned = 'נחסמה ממך הצפייה בחלק כלשהו מהפורום.';
		$this->main_code = 'קוד';
		$this->main_cp = 'לוח בקרה';
		$this->main_full = 'מלא';
		$this->main_help = 'עזרה';
		$this->main_load = 'טוען';
		$this->main_login = 'התחבר';
		$this->main_logout = 'התנתק';
		$this->main_mark = 'סמן הכל';
		$this->main_mark1 = 'סמן את כל ההודעות כנקראו';
		$this->main_markforum_read = 'Mark forum as read'; //Translate
		$this->main_max_load = 'לא נגיש, עקב מספר גדול של משתמשים מחוברים. %s אנו מצטערים, כרגע ה';
		$this->main_members = 'משתמשים';
		$this->main_messenger = 'הודעות פרטיות';
		$this->main_new = 'חדש';
		$this->main_next = 'הבא';
		$this->main_prev = 'הקודם';
		$this->main_queries = 'שאילתות';
		$this->main_quote = 'ציטוט';
		$this->main_recent = 'תגובות אחרונות';
		$this->main_recent1 = 'צפה בנודעות האחרונות מאז ביקורך האחרון';
		$this->main_register = 'הרשמה';
		$this->main_reminder = 'תזכורת: פורום זה סגור ומותר לצפייה רק ע"י מנהלים.';
		$this->main_reminder_closed = 'הפורום סגור ומותר לפייה רק ע"י מנהלים';
		$this->main_said = 'אמר';
		$this->main_search = 'חיפוש';
		$this->main_topics_new = 'יש הודועת חדשות בפורום הזה.';
		$this->main_topics_old = 'אין הודועת חדשות בפורום הזה.';
		$this->main_welcome = 'ברוך הבא';
		$this->main_welcome_guest = 'ברוך הבא!';
	}

	function mass_mail()
	{
		$this->mail = 'דואר קבוצתי';
		$this->mail_announce = 'הודעה מ';
		$this->mail_groups = 'קבוצות מקבלים';
		$this->mail_members = 'חברים.';
		$this->mail_message = 'הודעה';
		$this->mail_select_all = 'בחר הכל';
		$this->mail_send = 'שלח אימייל';
		$this->mail_sent = 'הודעתך נשלחה ל';
	}

	function member_control()
	{
		$this->mc = 'בקרת חבר';
		$this->mc_confirm = 'האם אתה בטוח רוצה למחוק';
		$this->mc_delete = 'מחיקת חבר';
		$this->mc_deleted = 'חבר נמחק.';
		$this->mc_edit = 'עריכת חבר';
		$this->mc_edited = 'חבר עודכן';
		$this->mc_email_invaid = 'כתובת האימייל שהכנסת אינה תקינה.';
		$this->mc_err_updating = 'שגיאה בעדכון הפרופיל';
		$this->mc_find = 'מצא חברים עם שמות המכילים';
		$this->mc_found = 'החברים הבאים נמצאו. אנא בחר אחד.';
		$this->mc_guest_needed = 'Quicksilver חשבון האורח חיוני לפעילות הפורומים של';
		$this->mc_not_found = 'לא נמצאו חברים מתאימים';
		$this->mc_user_aim = 'AIM שם';
		$this->mc_user_avatar = 'אווטרה';
		$this->mc_user_avatar_height = 'גובה אווטרה';
		$this->mc_user_avatar_type = 'סוג אווטרה';
		$this->mc_user_avatar_width = 'רוחב אווטרה';
		$this->mc_user_birthday = 'יום הולדת';
		$this->mc_user_email = 'כתובת אימייל';
		$this->mc_user_email_show = 'האימייל ציבורי';
		$this->mc_user_group = 'קבוצה';
		$this->mc_user_gtalk = 'חשבון GTalk';
		$this->mc_user_homepage = 'דף הבית';
		$this->mc_user_icq = 'ICQ מספר';
		$this->mc_user_id = 'מספר משתמש';
		$this->mc_user_interests = 'תחומי עניין';
		$this->mc_user_joined = 'חבר מאז';
		$this->mc_user_language = 'שפה';
		$this->mc_user_lastpost = 'תגובה אחרונה';
		$this->mc_user_lastvisit = 'ביקור אחרון';
		$this->mc_user_level = 'רמה';
		$this->mc_user_location = 'מיקום';
		$this->mc_user_msn = 'חשבון MSN';
		$this->mc_user_name = 'שם';
		$this->mc_user_pm = 'קבלת הודעות פרטיות';
		$this->mc_user_posts = 'תגובות';
		$this->mc_user_signature = 'חתימה';
		$this->mc_user_skin = 'סקין';
		$this->mc_user_timezone = 'אזור זמן';
		$this->mc_user_title = 'כותרת חבר';
		$this->mc_user_title_custom = 'השתמש בכותרת חבר מותאמת אישית';
		$this->mc_user_view_avatars = 'להציג אווטרה';
		$this->mc_user_view_emoticons = 'להציג סמלי הבעה';
		$this->mc_user_view_signatures = 'להציג חתימות';
		$this->mc_user_yahoo = 'חשבון Yhoo';
	}

	function membercount()
	{
		$this->mcount = 'סדר סטטיסטיקות חברים';
		$this->mcount_updated = 'ספירת חברים עודכנה.';
	}

	function members()
	{
		$this->members_all = 'הכל';
		$this->members_email = 'דואר אלקטרוני';
		$this->members_email_member = 'שלח דואר אלקטרוני למשתמש';
		$this->members_group = 'קבוצה';
		$this->members_joined = 'תאריך הצטרפות';
		$this->members_list = 'רשימת משתמשים';
		$this->members_member = 'משתמש';
		$this->members_pm = 'הודעה פרטית';
		$this->members_posts = 'הודעות';
		$this->members_send_pm = 'שלח הודעה פרטית למשתמש';
		$this->members_title = 'כותרת';
		$this->members_vist_www = 'בקר באתר הבית של משתמש';
		$this->members_www = 'אתר הבית';
	}

	function mod()
	{
		$this->mod_confirm_post_delete = '?האם אתה בטוח רוצה למחוק את ההודעה';
		$this->mod_confirm_topic_delete = '?האם אתה בטוח רוצה למחוק את ההודעה';
		$this->mod_error_first_post = '.אינך יכול למחוק את ההודעה הראשונה בנושא';
		$this->mod_error_move_category = '.אינך יכול להעביר נושא לקטגוריה';
		$this->mod_error_move_create = 'אין לך הרשאות להעביר נושאים לפורום הזה.';
		$this->mod_error_move_forum = '.אינך יכול להעביר נושא לפורום שלא קיים';
		$this->mod_error_move_global = '.אינך יכול להעביר נושא גלובלי. ערוך את הנושא לפני העברתו';
		$this->mod_error_move_same = 'אינך יכול להעביר נושא לפורום בו הוא כבר קיים.';
		$this->mod_label_controls = 'כלי אחראי';
		$this->mod_label_description = 'תאור';
		$this->mod_label_emoticon = '?להמיר סמלי הבעה לתמונות';
		$this->mod_label_global = 'נושא גלובלי';
		$this->mod_label_mbcode = 'Format MbCode?'; //Translate
		$this->mod_label_move_to = 'העבר ל';
		$this->mod_label_options = 'אפשרויות';
		$this->mod_label_post_delete = 'מחק הודעה';
		$this->mod_label_post_edit = 'ערוך הודעה';
		$this->mod_label_post_icon = 'הכנס אייקון';
		$this->mod_label_publish = 'Publishing'; //Translate
		$this->mod_label_title = 'כותרת';
		$this->mod_label_title_original = 'כותרת מקור';
		$this->mod_label_title_split = 'פצל כותרת';
		$this->mod_label_topic_delete = 'מחק נושא';
		$this->mod_label_topic_edit = 'ערוך נושא';
		$this->mod_label_topic_lock = 'נעל נושא';
		$this->mod_label_topic_move = 'העבר נושא';
		$this->mod_label_topic_move_complete = 'העבר את כל תכולת הנושא לפורום החדש';
		$this->mod_label_topic_move_link = '.העבר את הנושא לפורום החדש, והשאר קישור אליו בפורום הישן';
		$this->mod_label_topic_pin = 'נעץ נושא';
		$this->mod_label_topic_split = 'פצל נושא';
		$this->mod_missing_post = '.ההודעה שצויינה לא קיימת';
		$this->mod_missing_topic = '.הנושא שצויין לא קיים';
		$this->mod_no_action = '.עלייך לציין פעולה';
		$this->mod_no_post = '.עלייך לציין הודעה';
		$this->mod_no_topic = '.עלייך לציין נושא';
		$this->mod_perm_post_delete = '.אין לך הרשאות למחיקת הודעה זו';
		$this->mod_perm_post_edit = 'אין לך הרשאות לעריכת הודעה זו.';
		$this->mod_perm_publish = 'You do not have permission to publish this topic.'; //Translate
		$this->mod_perm_topic_delete = '.אין לך הרשאות למחיקת נושא זה';
		$this->mod_perm_topic_edit = '.אין לך הרשאות לעריכת נושא זה';
		$this->mod_perm_topic_lock = '.אין לך הרשאות למעילת נושא זה';
		$this->mod_perm_topic_move = 'אין לך הרשאות להעברת נושא זה';
		$this->mod_perm_topic_pin = '.אין לך הרשאות לנעיצת נושא זה';
		$this->mod_perm_topic_split = '.אין לך הרשאות לפיצול נושא זה';
		$this->mod_perm_topic_unlock = '.אין לך הרשאות להסרת נעילה מנושא זה';
		$this->mod_perm_topic_unpin = '.אין לך הרשאות להסרת נעיצה לנושא זה';
		$this->mod_success_post_delete = '.ההודעה נמחקה בהצלחה';
		$this->mod_success_post_edit = '.ההודעה נערכה בהצלחה';
		$this->mod_success_publish = 'This topic was successfully published.'; //Translate
		$this->mod_success_split = '.הנושא פוצל בהצלחה';
		$this->mod_success_topic_delete = '.הנושא נמחק בהצלחה';
		$this->mod_success_topic_edit = 'הנושא נערך בהצלחה';
		$this->mod_success_topic_move = '.הנושא הועבר בהצלחה לפורום החדש';
		$this->mod_success_unpublish = 'This topic has been removed from the published list.'; //Translate
	}

	function optimize()
	{
		$this->optimize = 'ייעל מסד נתונים';
		$this->optimized = '.הטבלאות במסד הנתונים ייועלו לביצועים מקסימלים';
	}

	function perms()
	{
		$this->perm = 'הרשאות';
		$this->perms = 'הרשאות';
		$this->perms_board_view = 'הצג את אינדקס הפורום';
		$this->perms_board_view_closed = 'כשהם סגורים Quicksilver השתמש בפורומים של';
		$this->perms_do_anything = 'השתמש בפורומים של Quicksilver ';
		$this->perms_edit_for = 'ערוך הרשאות ל';
		$this->perms_email_use = 'שליחת מיילים לחברים דרך הפורום';
		$this->perms_forum_view = 'הצג את הפורום';
		$this->perms_is_admin = 'כניסה ללוח בקרת מנהל';
		$this->perms_only_user = 'השתמש רק בהרשאות קבוצה למשתמש זה';
		$this->perms_override_user = '.זה יעקוף את הרשאות הקבוצה למשתמש זה';
		$this->perms_pm_noflood = 'Exempt from personal messenger flood control'; //Translate
		$this->perms_poll_create = 'יצירת סקרים';
		$this->perms_poll_vote = 'יצירת הצבעות';
		$this->perms_post_attach = 'Attach uploads to posts'; //Translate
		$this->perms_post_attach_download = 'Download post attachments'; //Translate
		$this->perms_post_create = 'יצירת תגובות';
		$this->perms_post_delete = 'מחיקת כל הודעה';
		$this->perms_post_delete_own = 'מחיקת ההודעות רק שמשתמש זה יצר';
		$this->perms_post_edit = 'עריכת כל הודעה';
		$this->perms_post_edit_own = 'עריכת הודעות רק שמשתמש זה יצר';
		$this->perms_post_inc_userposts = 'Posts contribute to user\'s total post count'; //Translate
		$this->perms_post_noflood = 'Exempt from post flood control'; //Translate
		$this->perms_post_viewip = 'של המשתמש IP הצגת כתובת ה';
		$this->perms_search_noflood = 'Exempt from search flood control'; //Translate
		$this->perms_title = 'בקרת קבוצת משתמש';
		$this->perms_topic_create = 'יצירת נושאים';
		$this->perms_topic_delete = 'מחיקת כל נושא';
		$this->perms_topic_delete_own = 'מחיקת נושאים רק שמשתמש זה יצר';
		$this->perms_topic_edit = 'עריכת כל נושא';
		$this->perms_topic_edit_own = 'עריכת נושאים רק שמשתמש זה יצר';
		$this->perms_topic_global = 'גרום לנושא להראות מכל הפורומים';
		$this->perms_topic_lock = 'נעילת כל נושא';
		$this->perms_topic_lock_own = 'נעילת נושאים רק שמשתמש זה יצר';
		$this->perms_topic_move = 'העברת נושא';
		$this->perms_topic_move_own = 'העברת נושאים רק שמשתמש זה יצר';
		$this->perms_topic_pin = 'נעיצה כל הנושא';
		$this->perms_topic_pin_own = 'נעיצת הנושאים רק שמשתמש זה יצר';
		$this->perms_topic_publish = 'Publish or unpublish any topic'; //Translate
		$this->perms_topic_publish_auto = 'New topics are marked as published'; //Translate
		$this->perms_topic_split = 'פיצול נושא נושאים מרובים';
		$this->perms_topic_split_own = 'פיצול נושאים למספר נושאים רק שמשתמש זה יצר';
		$this->perms_topic_unlock = 'פתיחת נעילת כל נושא';
		$this->perms_topic_unlock_mod = 'פתיחת נעילה של אחראי/ם';
		$this->perms_topic_unlock_own = 'פתיחת נעילת נושאים רק שמשתמש זה יצר';
		$this->perms_topic_unpin = 'פתיחת נעיצת כל נושא';
		$this->perms_topic_unpin_own = 'פתיחת נעיצת נושאים רק שמשתמש זה יצר';
		$this->perms_topic_view = 'הצגת נושאים';
		$this->perms_topic_view_unpublished = 'View unpublished topics'; //Translate
		$this->perms_updated = '.ההרשאות עודכנו';
		$this->perms_user_inherit = '.המשתמש יירש את הרשאות הקבוצה/ות';
	}

	function php_info()
	{
		$this->php_error = 'שגיאה';
		$this->php_error_msg = 'כנראה שהשרת המארח ניטרל אפשרות זו.\' .phpinfo() אי אפשר לבצע';
	}

	function pm()
	{
		$this->pm_avatar = 'אווטרה';
		$this->pm_cant_del = 'אין לך הרשאה למחק הודעה זו.';
		$this->pm_delallmsg = 'מחק כל ההודעות';
		$this->pm_delete = 'מחק';
		$this->pm_delete_selected = 'מחיקת הודעות נבחרות';
		$this->pm_deleted = 'הודעה נמחקה.';
		$this->pm_deleted_all = 'הודועת נמחקו.';
		$this->pm_error = '%s החברים הבאים לא מקבלים הודעות אישיות:<br /><br />%s החברים הבאים לא קיימים:<br /><br />נוצרו מספר שגיאות בשליחת הודעה לנמענים.';
		$this->pm_fields = '.הודעתך לא נשלחה. וודא ששדות החובה מלאים';
		$this->pm_flood = 'נסה שוב עוד כמה שניות. <br /><br />שניות, אינך יכול לשלוח עוד אחת עכשיו. %s שלחת הודעה לפני';
		$this->pm_folder_inbox = 'דואר נכנס';
		$this->pm_folder_new = '%s חדש';
		$this->pm_folder_sentbox = 'נשלח';
		$this->pm_from = 'מ';
		$this->pm_group = 'קבוצה';
		$this->pm_guest = '.כאורח, אינך יכול להשתמש במסנג\'ר. אנא הכינס למערכת או הירשם';
		$this->pm_joined = 'הצטרף';
		$this->pm_messenger = 'מסנג\'ר פרטי';
		$this->pm_msgtext = 'תוכן הודעה';
		$this->pm_multiple = '; הפרד נמענים מרובים עם';
		$this->pm_no_folder = '.חובה לציין תיקיה';
		$this->pm_no_member = 'לא נמצאו חברים עם מספר זה';
		$this->pm_no_number = 'לא נמצאה הודעה במספר זה';
		$this->pm_no_title = 'אין נושא';
		$this->pm_nomsg = '.אין הודעות בתיקיה';
		$this->pm_noview = 'אין לך הרשאות לקרוא הודעה זו.';
		$this->pm_offline = 'חבר זה כרגע לא פעיל';
		$this->pm_online = 'חבר זה כרגע פעיל';
		$this->pm_personal = 'מסנג\'ר פרטי';
		$this->pm_personal_msging = 'שולח הודעה';
		$this->pm_pm = 'הודעה פרטית';
		$this->pm_posts = 'הודעות';
		$this->pm_preview = 'הצגה מוקדמת';
		$this->pm_recipients = 'נמענים';
		$this->pm_reply = 'תגובה';
		$this->pm_send = ' שלח ';
		$this->pm_sendamsg = 'שלח הודעה פרטית';
		$this->pm_sendingpm = 'שולח הודעה פרטית';
		$this->pm_sendon = 'נשלח ב';
		$this->pm_success = 'הודעה שלך נשלחה בהצלחה.';
		$this->pm_sure_del = 'הינן בטוח\ה שברצונך למחוק הודעה זו?';
		$this->pm_sure_delall = 'הינך בטוח שברצונך למחוק כל ההודעות?';
		$this->pm_title = 'כותרת';
		$this->pm_to = 'אל';
	}

	function post()
	{
		$this->post_attach = 'קבצים מצורפים';
		$this->post_attach_add = 'הוסף קובץ ';
		$this->post_attach_disrupt = '.הוספה או הסרה של קבצים לא ישבשו את הודעתך';
		$this->post_attach_failed = 'העלאת הקובץ נכשלה. ייתכן והקובץ לא קיים.';
		$this->post_attach_not_allowed = '.אינך יכול להוסיף קבצים מסוג זה';
		$this->post_attach_remove = 'הסרת קבצים מצורפים';
		$this->post_attach_too_large = '.Kb %d הקבצים שציינת להעלאה גדולים מידי. הגודל המירבי הוא';
		$this->post_cant_create = '.כאורח, אינך יכול ליצור נושאים. אם תירשם, תוכל ליצור נושאים';
		$this->post_cant_create1 = '.אין לך הרשאות ליצור נושאים';
		$this->post_cant_enter = '.ההצבע שלך לא התקבלה. כנראה שכבר הצבעת לסקר זה, או שאין לך הרשאות הצבעה';
		$this->post_cant_poll = 'כאורח, אינך יכול ליצור סקרים. אם תירשם, תוכל ליצור סקרים';
		$this->post_cant_poll1 = '.אין לך הרשאות ליצור סקרים';
		$this->post_cant_reply = '.אין לך הרשאות להגיב לנושאים בפורום זה';
		$this->post_cant_reply1 = 'כאורח, אינך יכול להגיב לנושאים. אם תירשם, תוכל להגיב לנושאים.';
		$this->post_cant_reply2 = '.אין לך הרשאות להגיב לנושאים';
		$this->post_closed = '.הנושא הזה נסגר';
		$this->post_create_poll = 'צור סקר';
		$this->post_create_topic = 'צור נושא';
		$this->post_creating = 'יוצר נושא';
		$this->post_creating_poll = 'יוצר סקר';
		$this->post_flood = 'נסה שוב עוד כמה שניות. <br /><br />שניות, אינך יכול לשלוח עוד אחת עכשיו. %s שלחת הודעה לפני';
		$this->post_guest = 'אורח';
		$this->post_icon = 'הכנס אייקון';
		$this->post_last_five = 'חמשת ההודעות האחרונות בסדר הפוך';
		$this->post_length = 'בדוק אורך';
		$this->post_msg = 'הודעה';
		$this->post_must_msg = '.חובה לכתוב הודעה';
		$this->post_must_options = 'חובה ליצור אפשרויות ביצירת סקר.';
		$this->post_must_title = 'חובה לרשום כותרת ביצירת נושא חדש.';
		$this->post_new_poll = 'סקר חדש';
		$this->post_new_topic = 'נושא חדש';
		$this->post_no_forum = '.הפורום לא נמצא';
		$this->post_no_topic = '.לא צויין נושא';
		$this->post_no_vote = 'חובה לבחור אפשרות בכדי להצביע.';
		$this->post_option_emoticons = '?להמיר סמלי הבעה לתמונות';
		$this->post_option_global = '?לעשות נושא זה גלובלי';
		$this->post_option_mbcode = 'Format MbCode?'; //Translate
		$this->post_optional = 'רשות';
		$this->post_options = 'אפשרויות';
		$this->post_poll_options = 'אפשרויות סקר';
		$this->post_poll_row = 'אחד בכל שורה';
		$this->post_posted = 'הודעה פעילה';
		$this->post_posting = 'מכניס הודעה';
		$this->post_preview = 'תצוגה מקדימה';
		$this->post_reply = 'להגיב';
		$this->post_reply_topic = 'תגובה לנושא';
		$this->post_replying = 'מגיב לנושא';
		$this->post_replying1 = 'מגיב';
		$this->post_too_many_options = '.אפשרויות לסקר %d חובה שיהיו בין 2 ל';
		$this->post_topic_detail = 'תאור נושא';
		$this->post_topic_title = 'כותרת נושא';
		$this->post_view_topic = 'הצג את כל הנושא';
		$this->post_voting = 'מצביע';
	}

	function printer()
	{
		$this->printer_back = 'אחורה';
		$this->printer_not_found = '.הנושא לא נמצא. ייתכן שהוא נמחק, הועבר או לא היה קיים';
		$this->printer_not_found_title = 'הנושא לא נמצא';
		$this->printer_perm_topics = 'אין לך הרשאות לראות נושאים.';
		$this->printer_perm_topics_guest = 'אינך יכול לראות נושאים. אם תירשם, תוכל לראות נושאים';
		$this->printer_posted_on = 'הודעה פעילה';
		$this->printer_send = 'שלח להדפסה';
	}

	function profile()
	{
		$this->profile_aim_sn = 'שם משתמש של AIM';
		$this->profile_av_sign = 'אווטר וחתימה';
		$this->profile_avatar = 'אווטר';
		$this->profile_bday = 'יום הולדת';
		$this->profile_contact = 'יצירת קשר';
		$this->profile_email_address = 'כתובת דואר אלקטרוני';
		$this->profile_fav = 'פורום מועדף';
		$this->profile_fav_forum = '%s (%d%% הודעות של החבר/ים)';
		$this->profile_gtalk = 'GTalk חשבון';
		$this->profile_icq_uin = 'מספר ICQ';
		$this->profile_info = 'מידע';
		$this->profile_interest = 'תחומי התענייניות';
		$this->profile_joined = 'הצטרף';
		$this->profile_last_post = 'הודעה אחרונה';
		$this->profile_list = 'רשימת חברים';
		$this->profile_location = 'מיקום';
		$this->profile_member = 'קבוצת משתמש';
		$this->profile_member_title = 'כותרת';
		$this->profile_msn = 'MSN מסנג\'ר';
		$this->profile_must_user = '.חובה להקליד חבר כדי לראות פרופיל';
		$this->profile_no_member = '.אין חברים עם מספר זה. המשתמש כנראה נמחק';
		$this->profile_none = '[ ללא ]';
		$this->profile_not_post = 'לא כתב הודעות.';
		$this->profile_offline = 'חבר זה כרגע לא פעיל';
		$this->profile_online = 'חבר זה כרגע פעיל';
		$this->profile_pm = 'הודעות פרטיות';
		$this->profile_postcount = '%s סה"כ, %s ליום';
		$this->profile_posts = 'הודועת';
		$this->profile_private = '[ פרטי ]';
		$this->profile_profile = 'פרופיל';
		$this->profile_signature = 'חתימה';
		$this->profile_unkown = '[ לא ידוע ]';
		$this->profile_view_profile = 'צופה בפרופיל של';
		$this->profile_www = 'אתר הבית';
		$this->profile_yahoo = 'יאהו מסנג\'ר';
	}

	function prune()
	{
		$this->prune_action = 'פעולת קיצוץ לביצוע';
		$this->prune_age_day = 'יום אחד';
		$this->prune_age_eighthours = ' 8 שעות';
		$this->prune_age_hour = 'שעה אחת';
		$this->prune_age_month = 'חודש אחד';
		$this->prune_age_threemonths = '3 חודשים';
		$this->prune_age_week = 'שבוע אחד';
		$this->prune_age_year = 'שנה אחת';
		$this->prune_forums = 'בחר פורומים לקיצוץ';
		$this->prune_invalidage = 'צויין גיל לא תקף לקיצוץ';
		$this->prune_move = 'העבר';
		$this->prune_moveto_forum = 'פורום להעביר אליו';
		$this->prune_nodest = 'לא נבחר יעד';
		$this->prune_notopics = 'לא נבחרו נושאים לקיצוץ';
		$this->prune_notopics_old = 'אין נושאים ישנים מספיק לקיצוץ';
		$this->prune_novalidforum = 'לא נבחרו פורומים קיימים לקיצוץ';
		$this->prune_select_age = 'בחר בגיל הנושאים בכדי להגביל את הקיצוץ';
		$this->prune_select_topics = 'בחר נושאים לקיצוץ או בחר בהכל';
		$this->prune_success = 'נושאים קוצצו';
		$this->prune_title = 'קיצוץ נושא';
		$this->prune_topics_older_than = 'קיצוץ נושאים ישן מ';
	}

	function query()
	{
		$this->query = 'ממשק שאילתה';
		$this->query_fail = '.נכשל';
		$this->query_success = '.בוצע בהצלחה';
		$this->query_your = 'השאילה שלך';
	}

	function recent()
	{
		$this->recent_active = 'נושאים פעילים מהביקור האחרון';
		$this->recent_by = 'על ידי';
		$this->recent_can_post = 'אתה יכול להגיב בפורום הזה.';
		$this->recent_can_topics = 'אתה יכול לראות נושאים בפורום הזה.';
		$this->recent_cant_post = 'אתה לא יכול להגיב בפורום הזה.';
		$this->recent_cant_topics = 'אתה לא יכול לראות נושאים בפורום הזה.';
		$this->recent_dot = 'נקודה';
		$this->recent_dot_detail = 'מראה שהגבת לנושא זה';
		$this->recent_forum = 'פורום';
		$this->recent_guest = 'אורח';
		$this->recent_hot = 'חם';
		$this->recent_icon = 'אייקון של נושא';
		$this->recent_jump = 'קפוץ להודעה אחרונה בנושא';
		$this->recent_last = 'הודעה אחרונה';
		$this->recent_locked = 'נעול';
		$this->recent_moved = 'מועבר';
		$this->recent_msg = '%s הודעה';
		$this->recent_new = 'חדש';
		$this->recent_new_poll = 'פרסם סקר חדש';
		$this->recent_new_topic = 'פרסם נושא חדש';
		$this->recent_no_topics = '.אין נושאים להצגה בפורום זה';
		$this->recent_noexist = 'הפורום שצויין לא קיים.';
		$this->recent_nopost = 'אין הודעות';
		$this->recent_not = 'לא';
		$this->recent_noview = 'אין לך הרשאות לצפות בפורומים האלה.';
		$this->recent_pages = 'עמודים';
		$this->recent_pinned = 'נעוץ';
		$this->recent_pinned_topic = 'נושא נעוץ';
		$this->recent_poll = 'סקר';
		$this->recent_regfirst = 'אינך יכול להביט בפורומים. אם תירשם, תוכל להביט בפורומים.';
		$this->recent_replies = 'תגובות';
		$this->recent_starter = 'מפרסם';
		$this->recent_sub = 'תת-פורום';
		$this->recent_sub_last_post = 'הודעה אחרונה';
		$this->recent_sub_replies = 'תגובות';
		$this->recent_sub_topics = 'נושאים';
		$this->recent_subscribe = 'שלח לי מייל כשהגיבו בפורום זה';
		$this->recent_topic = 'נושא';
		$this->recent_views = 'צפיות';
		$this->recent_write_topics = '.באפשרותך ליצור נושאים בפורום זה';
	}

	function register()
	{
		$this->register_activated = '!חשבונך הופעל';
		$this->register_activating = 'הפעלת חשבון';
		$this->register_activation_error = '.נוצרה בעיה בהפעלת חשבונך. וודא במייל ההפעלה שנמצאת הכתובת המלאה להפעלה. אם הבעיה נמשכת, פנה למנהל הפורום לשליחה מחדש של האימייל';
		$this->register_confirm_passwd = 'אשר סיסמה';
		$this->register_done = '.נרשמת בהצלחה. באפשרותך להיכנס למערכת';
		$this->register_email = 'כתובת אימייל';
		$this->register_email_invalid = '.כתובת האימייל שהקלדת שגויה';
		$this->register_email_msg = 'בכדי Quicksilver זהו מייל אוטומטי שנשלח אלייך מהפורומים של';
		$this->register_email_msg2 = 'שתפעיל את חשבונך עם';
		$this->register_email_msg3 = 'אנא לחץ על הקישור הבא, או הדבק אותו לשורת הכתובות בדפדפן:';
		$this->register_email_used = 'כתובת האימייל שהקלדת שייכת כבר לחבר.';
		$this->register_fields = 'לא כל השדות מלאים.';
		$this->register_flood = 'You have registered already.'; //Translate
		$this->register_image = 'אנא הקלד את הטקסט המוצג בתמונה.';
		$this->register_image_invalid = 'בכדי לוודא שזהו רישום אמיתי, עלייך להקליד את הטקסט המוצג בתמונה.';
		$this->register_initiated = 'This request was initiated from IP:'; //Translate
		$this->register_must_activate = 'You have been registered. An email has been sent to %s with information on how to activate your account. Your account will be limited until you activate it.'; //Translate
		$this->register_name_invalid = 'השם שהקלדת ארוך מידי.';
		$this->register_name_taken = 'שם החבר שהקלדת כבר תפוס.';
		$this->register_new_user = 'שם משתמש שהתבקש';
		$this->register_pass_invalid = ' הסיסמה שהקלדת לא תקינה. וודא שהינך משתמש בתווים תקינים כגון אותיות, מספרים, קו מפריד, קו תחתון ורווחים ושהיא 5 תווים לפחות.';
		$this->register_pass_match = 'הסיסמה שהקלדת לא תואמת.';
		$this->register_passwd = 'סיסמה';
		$this->register_reg = 'הירשם';
		$this->register_reging = 'רישום';
		$this->register_requested = 'Account activation request for:'; //Translate
		$this->register_tos = 'תנאי שימוש';
		$this->register_tos_i_agree = 'אני מסכים לתנאים הנ"ל.';
		$this->register_tos_not_agree = 'לא הסכמת לתנאים.';
		$this->register_tos_read = 'אנא קרא את תנאי השימוש הבאים';
	}

	function rssfeed()
	{
		$this->rssfeed_cannot_find_forum = 'הפורום לא קיים';
		$this->rssfeed_cannot_find_topic = 'הנושא לא קיים';
		$this->rssfeed_cannot_read_forum = 'אין לך הרשאות לקרוא פורום זה';
		$this->rssfeed_cannot_read_topic = 'אין לך הרשאות לקרוא נושא זה';
		$this->rssfeed_error = 'שגיאה';
		$this->rssfeed_forum = 'פורום:';
		$this->rssfeed_posted_by = 'משלח ע"י';
		$this->rssfeed_topic = 'נושא:';
	}

	function search()
	{
		$this->search_advanced = 'אפשרויות מתקדמות';
		$this->search_avatar = 'אווטרה';
		$this->search_basic = 'חיפוש בסיסי';
		$this->search_characters = 'מאפייני הודעה';
		$this->search_day = 'יום';
		$this->search_days = 'ימים';
		$this->search_exact_name = 'שם מדוייק';
		$this->search_flood = 'אנא נסה שוב עוד כמה שניות. <br /><br />שניות, ואינך יכול לבצע חיפוש עכשיו. %s ביצעת חיפוש לפני';
		$this->search_for = 'חפש אחר';
		$this->search_forum = 'פורום';
		$this->search_group = 'קבוצה';
		$this->search_guest = 'אורח';
		$this->search_in = 'חפש ב';
		$this->search_in_posts = 'חפש רק בהודעות';
		$this->search_ip = 'IP'; //Translate
		$this->search_joined = 'הצטרף';
		$this->search_level = 'דרגת חבר';
		$this->search_match = 'חפש לפי התאמות';
		$this->search_matches = 'התאמות';
		$this->search_month = 'חודש';
		$this->search_months = 'חודשים';
		$this->search_mysqldoc = 'MySQL תיעוד';
		$this->search_newer = 'חדש';
		$this->search_no_results = 'לא נמצאו תוצאות לחיפוש';
		$this->search_no_words = 'כל ביטוי חייב להיות מעל 3 תווים, כולל אותיות, מספרים, גרשיים. <br /><br />עלייך לציין ביטויים לחיפוש.';
		$this->search_offline = 'החבר כרגע לא מחובר';
		$this->search_older = 'ישן';
		$this->search_online = 'החבר כרגע מחובר';
		$this->search_only_display = 'הצג רק ראשון';
		$this->search_partial_name = 'שם חלקי';
		$this->search_post_icon = 'הכנס אייקון';
		$this->search_posted_on = 'פורסם ב';
		$this->search_posts = 'הודעות';
		$this->search_posts_by = 'רק בהודעות ע"י';
		$this->search_regex = 'חפש ע"י ביטוי רגיל';
		$this->search_regex_failed = 'לעזרה בחיפוש רגיל MySQL החיפוש הרגיל נכשל. אנא פנה לתיעוד';
		$this->search_relevance = '%d%% שייכות הודעה:';
		$this->search_replies = 'הודעות';
		$this->search_result = 'תוצאות חיפוש';
		$this->search_search = ' חפש ';
		$this->search_select_all = 'בחר הכל';
		$this->search_show_posts = 'הצג הודעות מתאימות';
		$this->search_sound = 'חפש לפי קול';
		$this->search_starter = 'מזניק';
		$this->search_than = '-מ';
		$this->search_topic = 'נושא';
		$this->search_unreg = 'לא רשום';
		$this->search_week = 'שבוע';
		$this->search_weeks = 'שבועות';
		$this->search_year = 'שנה';
	}

	function settings()
	{
		$this->settings = 'הגדרות';
		$this->settings_active = 'הגדרות חברים פעילים';
		$this->settings_allow = 'אפשר';
		$this->settings_antibot = 'מונע רישום אוטומטי';
		$this->settings_attach_ext = 'קבצים מצורפים - סיומות קבצים';
		$this->settings_attach_one_per = 'אחד לשורה. ללא נקודות.';
		$this->settings_avatar = 'הגדרות אווטרה';
		$this->settings_avatar_flash = 'אווטרים פלאש';
		$this->settings_avatar_max_height = 'מקסימום גובה אווטרה';
		$this->settings_avatar_max_width = 'מקסימום רוחב אווטר';
		$this->settings_avatar_upload = 'האווטרים שהועלו - גודל קובץ מירבי.';
		$this->settings_basic = 'עריכת הגדרות לוח.';
		$this->settings_blank = 'לחלון חדש. </i>_blank<i> השתמש ב';
		$this->settings_board_enabled = 'לוח פעיל.';
		$this->settings_board_location = 'מיקום הלוח';
		$this->settings_board_name = 'שם לוח';
		$this->settings_board_rss = 'RSS הגדרות הזנת';
		$this->settings_board_rssfeed_desc = 'RSS תיאור הזנת';
		$this->settings_board_rssfeed_posts = 'RSS מספר ההודעות לרישום בהזנת';
		$this->settings_board_rssfeed_time = 'זמן ריענון בדקות';
		$this->settings_board_rssfeed_title = 'RSS כותרת הזנת';
		$this->settings_clickable = 'סמלי הבעה לחיצים לשורה';
		$this->settings_cookie = 'Cookie and Flood Settings'; //Translate
		$this->settings_cookie_path = 'Cookie נתיב ה';
		$this->settings_cookie_prefix = 'Cookie תחילית ה';
		$this->settings_cookie_time = 'Time to Remain Logged In'; //Translate
		$this->settings_db = 'עריכת הגדרות התחברות';
		$this->settings_db_host = 'מארח מסד הנתונים';
		$this->settings_db_leave_blank = 'השאר ריק לכלום';
		$this->settings_db_multiple = 'להתקנת לוחות מרובים על מסד נתונים אחד.';
		$this->settings_db_name = 'שם מסד הנתונים';
		$this->settings_db_password = 'סיסמת מסד הנתונים';
		$this->settings_db_port = 'מסד הנתונים Port';
		$this->settings_db_prefix = 'תחילית הטבלה';
		$this->settings_db_socket = 'מסד הנתונים Socket';
		$this->settings_db_username = 'שם משתמש מסד הנתונים';
		$this->settings_debug_mode = 'Debug Mode'; //Translate
		$this->settings_default_lang = 'שפת ברירת המחדל';
		$this->settings_default_no = 'מספר ברירת המחדל';
		$this->settings_default_skin = 'סקין ברירת המחדל';
		$this->settings_default_yes = 'כן ברירת המחדל';
		$this->settings_disabled = 'מנוטרל';
		$this->settings_disabled_notice = 'הודעת ניטרול';
		$this->settings_email = 'הגדרות אימייל';
		$this->settings_email_fake = 'לתצוגה בלבד. לא מחייב כתובת אימייל תקפה.';
		$this->settings_email_from = 'אימייל מכתובת';
		$this->settings_email_place1 = 'מקם חברים ב';
		$this->settings_email_place2 = 'קבוצה עד שיאמתו את האימייל שלהם';
		$this->settings_email_place3 = 'לא לדרוש אימייל הפעלה';
		$this->settings_email_real = 'חייב בכתובת אימייל אמיתית.';
		$this->settings_email_reply = 'אימייל תשובה לכתובת';
		$this->settings_email_smtp = 'SMTP שרת דואר';
		$this->settings_email_valid = 'תוקף אימייל של חבר חדש';
		$this->settings_enabled = 'מופעל';
		$this->settings_enabled_modules = 'מודולים מופעלים';
		$this->settings_foreign_link = 'יעד קישור חוץ';
		$this->settings_general = 'הגדרות כלליות';
		$this->settings_group_after = 'קבוצה אחרי רישום';
		$this->settings_hot_topic = 'הודעות לנושאים חמים';
		$this->settings_kilobytes = 'קילובייטים';
		$this->settings_max_attach_size = 'קבצים מצורפים - גודל קובץ מירבי.';
		$this->settings_members = 'הגדרות חבר';
		$this->settings_modname_only = '.php שם מודול בלבד. אל תכלול';
		$this->settings_new = 'New Setting'; //Translate
		$this->settings_new_add = 'Add Board Setting';
		$this->settings_new_added = 'New settings added.'; //Translate
		$this->settings_new_exists = 'That setting already exists. Choose another name for it.'; //Translate
		$this->settings_new_name = 'New setting name'; //Translate
		$this->settings_new_required = 'The new setting name is required.'; //Translate
		$this->settings_new_value = 'New setting value'; //Translate
		$this->settings_no_allow = 'לא לאפשר';
		$this->settings_nodata = 'לא נשלח נתון מההודעה';
		$this->settings_one_per = 'אחד בכל שורה';
		$this->settings_pixels = 'פיקסלים';
		$this->settings_pm_flood = 'Personal Messenger Flood Control'; //Translate
		$this->settings_pm_min_time = 'זמן מינימלי בין הודעות.';
		$this->settings_polls = 'סקרים';
		$this->settings_polls_no = 'משתמשים אינם יכולים להצביע לסקר לאחר שהביטו בתוצאות';
		$this->settings_polls_yes = 'משתמשים יכולים להצביע בסקר לאחר שהביטו בתוצאות';
		$this->settings_post_flood = 'Post Flood Control'; //Translate
		$this->settings_post_min_time = 'זמן מינימלי בין הודעות.';
		$this->settings_posts_topic = 'הודעות לנושא בדף';
		$this->settings_search_flood = 'Search Flood Control'; //Translate
		$this->settings_search_min_time = 'זמן מינימלי בין חיפושים';
		$this->settings_server = 'הגדרות שרת';
		$this->settings_server_gzip = 'GZIP דחיסת';
		$this->settings_server_gzip_msg = 'משפרת את המהירות. נטרל אם הלוח נראה מבולגן או ריק.';
		$this->settings_server_maxload = 'טעינת שרת מירבית';
		$this->settings_server_maxload_msg = 'נטרל לוח שמאמץ את השרת. הקלד 0 לניטרול.';
		$this->settings_server_timezone = 'אזור זמן השרת';
		$this->settings_show_avatars = 'הצג אווטרים';
		$this->settings_show_email = 'הצג כתובת אימייל';
		$this->settings_show_emotes = 'הצג סמלי הבעה';
		$this->settings_show_notice = 'הצג כשהלוח מנוטרל';
		$this->settings_show_pm = 'קבל הודעות פרטיות';
		$this->settings_show_sigs = 'הצג חתימות';
		$this->settings_spider_agent = 'Spider User Agent'; //Translate
		$this->settings_spider_agent_msg = 'Enter all or part of the spider\'s unique HTTP USER AGENT.'; //Translate
		$this->settings_spider_enable = 'Enable Spider Display'; //Translate
		$this->settings_spider_enable_msg = 'Enable the names of search engine spiders on Active List.'; //Translate
		$this->settings_spider_name = 'Spider Name'; //Translate
		$this->settings_spider_name_msg = 'Enter the name that you wish to display for each of the above spiders on Active List. You need to place the spider\'s name on the same line as the spider\'s user agent above. For example, if you place \'googlebot\' on the third line for the user agent place \'Google\' on the third line for the Spider Name.'; //Translate
		$this->settings_timezone = 'אזור זמן';
		$this->settings_topics_page = 'נושאים לדף פורום';
		$this->settings_tos = 'תנאי שימוש';
		$this->settings_updated = 'ההגדרות עודכנו.';
	}

	function stats()
	{
		$this->stats = 'מרכז הסטטיסטיקות';
		$this->stats_post_by_month = 'הודעות לפי חודש';
		$this->stats_reg_by_month = 'הרשמות לפי חודש';
	}

	function templates()
	{
		$this->add = 'HTML הוסף תבנית';
		$this->add_in = 'הוסף תבנית ל:';
		$this->all_fields_required = 'כל השדות חובה להוספת תבנית';
		$this->choose_css = 'Choose CSS Template'; //Translate
		$this->choose_set = 'בחר בקבוצת תבניות';
		$this->choose_skin = 'בחר סקין';
		$this->confirm1 = 'אתה עומד למחוק את';
		$this->confirm2 = 'התבנית מ';
		$this->create_new = 'צור סקין חדש בשם';
		$this->create_skin = 'צור סקין';
		$this->credit = 'אנא אל תסיר את הקרדיט שלנו!';
		$this->css_edited = 'CSS file has been updated.'; //Translate
		$this->css_fioerr = 'The file could not be written to, you will need to CHMOD the file manually.'; //Translate
		$this->delete_template = 'מחק תבנית';
		$this->directory = 'סיפרייה';
		$this->display_name = 'שם תצוגה';
		$this->edit_css = 'Edit CSS'; //Translate
		$this->edit_skin = 'ערוך סקין';
		$this->edit_templates = 'ערוך תבניות';
		$this->export_done = '.Quicksilver הסקין יוצא לסיפרייה הראשית של הפורומים של';
		$this->export_select = 'בחר סקין לייצוא';
		$this->export_skin = 'ייצא סקין';
		$this->install_done = 'הסקין הותקן בהצלחה.';
		$this->install_exists1 = 'כנראה שהסקין';
		$this->install_exists2 = 'כבר מותקן.';
		$this->install_overwrite = 'החלף';
		$this->install_skin = 'התקן סקין';
		$this->menu_title = 'בחר את קטע התבנית לעריכה';
		$this->no_file = 'No such file.'; //Translate
		$this->only_skin = 'רק סקין אחד מותקן. אל תמחק סקין זה.';
		$this->or_new = 'או צור קבוצת תבניות בשם:';
		$this->select_skin = 'בחר סקין';
		$this->select_skin_edit = 'בחר סקין לעריכה';
		$this->select_skin_edit_done = 'הסקין נערך בהצלחה.';
		$this->select_template = 'בחר תבנית';
		$this->skin_chmod = 'לא התאפשרה יצירת סיפרייה לסקין. נסה לשנות את מצב סיפריית הסקין ל 775.';
		$this->skin_created = 'סקין נוצר.';
		$this->skin_deleted = 'הסקין נמחק בהצלחה.';
		$this->skin_dir_name = 'חובה להכניס שם סקין ושם סיפרייה.';
		$this->skin_dup = 'סקין עם שם סיפרייה דומה נמצא. סיפריית הסקינים שונתה ל';
		$this->skin_name = 'חובה לרשום שם סקין.';
		$this->skin_none = 'אין סקינים זמינים להתקנה.';
		$this->skin_set = 'הגדרת סקין';
		$this->skins_found = 'Quicksilver הסקינים הבאים נמצאו בסיפריית הפורומים של';
		$this->template_about = 'אודות משתנים';
		$this->template_about2 = 'משתנים הם חלקי טקסט המחליפים מידע דינאמי. משתנים תמיד מתחילים עם סימן דולר ולפעמים תחומים ב {סוגריים}';
		$this->template_add = 'הוסף';
		$this->template_added = 'תבנית הוספה.';
		$this->template_clear = 'נקה';
		$this->template_confirm = 'ביצעת שינויים בתבניות. האם ברצונך לשמור את השינויים?';
		$this->template_description = 'תיאור תבנית';
		$this->template_html = 'HTML תבנית';
		$this->template_name = 'שם תבנית';
		$this->template_position = 'מיקום תבנית';
		$this->template_set = 'הגדרת תבנית';
		$this->template_title = 'כותרת תבנית';
		$this->template_universal = 'משתנים אוניברסליים';
		$this->template_universal2 = 'בכל מקום. $this אפשר להשתמש במשתנים מסוימים בכל תבנית, בזמן שמשתנים אחרים אפשריים לתבנית בודדת. אפשר להשתמש במאפייני האובייקט';
		$this->template_updated = 'תבנית עודכנה.';
		$this->templates = 'תבניות';
		$this->temps_active = 'פרטי משתמשים פעילים';
		$this->temps_admin = '<b>בקרת מנהל אוניברסלית</b>';
		$this->temps_ban = 'בקרת מנהל לחסומים';
		$this->temps_board_index = 'אינדקס לוח';
		$this->temps_censoring = 'בקרת מנהל למילים מצונזרות';
		$this->temps_cp = 'לוח בקרת חבר';
		$this->temps_email = 'שלח מייל לחבר';
		$this->temps_emot_control = 'בקרת מנהל לסמלי הבעה';
		$this->temps_forum = 'פורומים';
		$this->temps_forums = 'בקרת מנהל לפורומים';
		$this->temps_groups = 'בקרת מנהל לקבוצות';
		$this->temps_help = 'עזרה';
		$this->temps_login = 'כניסה/יציאה למערכת';
		$this->temps_logs = 'בקרת מנהל לכניסות אחראים';
		$this->temps_main = '<b>לוח אוניברסלי</b>';
		$this->temps_mass_mail = 'בקרת מנהל לאימייל בכמות גדולה';
		$this->temps_member_control = 'בקרת מנהל ללוח בקרת חבר';
		$this->temps_members = 'רשימת חברים';
		$this->temps_mod = 'בקרת אחראים';
		$this->temps_pm = 'מסנג\'ר פרטי';
		$this->temps_polls = 'סקרים';
		$this->temps_post = 'מפרסם';
		$this->temps_printer = 'Printer-Friendly Topics'; //Translate
		$this->temps_profile = 'צפייה בפרופיל';
		$this->temps_recent = 'נושאים אחרונים';
		$this->temps_register = 'הרשמה';
		$this->temps_rssfeed = 'RSS Feed'; //Translate
		$this->temps_search = 'חיפוש';
		$this->temps_settings = 'בקרת מנהל להגדרות';
		$this->temps_templates = 'בקרת מנהל לעורך התבנית';
		$this->temps_titles = 'בקרת מנהל לכותרות חברים';
		$this->temps_topic_prune = 'בקרת מנהל לחיתוך נושאים';
		$this->temps_topics = 'נושאים';
		$this->upgrade_skin = 'שדרג סקין';
		$this->upgrade_skin_already = 'כבר עודכן. אין מה לבצע.';
		$this->upgrade_skin_detail = 'בחר בסקין לשידרוג\' <br />יש צורך לערוך את התבנית לאחר שידרוג סקינים בשיטה זו.';
		$this->upgrade_skin_upgraded = 'הסקין שודרג.';
		$this->upgraded_templates = 'התבניות הבאות הוספו או שודרגו';
	}

	function titles()
	{
		$this->titles_add = 'הוסף כותרת חבר';
		$this->titles_added = 'כותרת חבר התווספה.';
		$this->titles_control = 'בקרץ כותרת חבר';
		$this->titles_edit = 'ערוך כותרת חבר';
		$this->titles_error = 'לא ניתנו כותרת טקסט או מינימום הודעות';
		$this->titles_image = 'תמונה';
		$this->titles_minpost = 'מינימום הודעות';
		$this->titles_nodel_default = 'Removal of the default title has been disabled as it will break your board, please edit it instead.'; //Translate
		$this->titles_title = 'כותרת';
	}

	function topic()
	{
		$this->topic_attached = 'קובץ מצורף:';
		$this->topic_attached_downloads = 'הורדות';
		$this->topic_attached_filename = 'Filename:'; //Translate
		$this->topic_attached_image = 'Attached image:'; //Translate
		$this->topic_attached_perm = 'אין לך הרשאות להוריד קובץ זה';
		$this->topic_attached_size = 'Size:'; //Translate
		$this->topic_attached_title = 'קובץ מצורף';
		$this->topic_avatar = 'אווטרה';
		$this->topic_bottom = 'גש לתחתית העמוד';
		$this->topic_create_poll = 'צור סקר חדש';
		$this->topic_create_topic = 'צור נושא חדש';
		$this->topic_delete = 'מחק';
		$this->topic_delete_post = 'מחק הודעה זו';
		$this->topic_edit = 'עריכה';
		$this->topic_edit_post = 'ערוך הודעה זו';
		$this->topic_edited = '%s ע"י %s נערכה לאחרונה ב';
		$this->topic_error = 'שגיאה';
		$this->topic_group = 'קבוצה';
		$this->topic_guest = 'אורח';
		$this->topic_ip = 'IP'; //Translate
		$this->topic_joined = 'תאריך הצטרפות';
		$this->topic_level = 'רמה של משתמש';
		$this->topic_links_aim = '%s ל AIM שלח הודעת';
		$this->topic_links_email = '%s ל אימייל שלח ';
		$this->topic_links_gtalk = '%s ל GTalk שלח הודעת';
		$this->topic_links_icq = '%s ל ICQ שלח הודעת';
		$this->topic_links_msn = '%s של MSN צפה בפרופיל';
		$this->topic_links_pm = '%s ל פרטית שלח הודעה';
		$this->topic_links_web = '%s בקר באתר/ים של';
		$this->topic_links_yahoo = '%s ל YAHOO מסנג\'ר שלח הודעה עם';
		$this->topic_lock = 'נעל';
		$this->topic_locked = 'נושא נעול';
		$this->topic_move = 'העבר';
		$this->topic_new_post = 'Post is unread'; //Translate
		$this->topic_newer = 'נושא חדש';
		$this->topic_no_newer = 'אין נושאים חדשים.';
		$this->topic_no_older = 'אין נושאים ישנים.';
		$this->topic_no_votes = 'אין הצבעות לסקר זה.';
		$this->topic_not_found = 'נוששא לא קיים';
		$this->topic_not_found_message = 'לא נמצאה ההודעה. ייתכן והיא נמחקה,הועברה ואולי לא הייתה קיימת.';
		$this->topic_offline = 'החבר כרגע לא מחובר';
		$this->topic_older = 'הודעה ישנה';
		$this->topic_online = 'החבר כרגע מחובר';
		$this->topic_options = 'אפשרויות הודעה';
		$this->topic_pages = 'עמודים';
		$this->topic_perm_view = 'אין לך הרשאות לצפות בהודעות.';
		$this->topic_perm_view_guest = 'אין לך הרשאות לצפות בהודעות. אם תירשם, ייתכן ותוכל לצפות.';
		$this->topic_pin = 'נעץ';
		$this->topic_posted = 'פורסם';
		$this->topic_posts = 'הודועת';
		$this->topic_print = 'הצג להדפסה';
		$this->topic_publish = 'Publish'; //Translate
		$this->topic_qr_emoticons = 'סמלי הבעה';
		$this->topic_qr_open_emoticons = 'פתח סמלי הבעה נלחצים';
		$this->topic_qr_open_mbcode = 'MBCode פתח';
		$this->topic_quickreply = 'הוספת תגובה מהירה';
		$this->topic_quote = 'הוסף תגובה עם ציטוט מתגובה זו';
		$this->topic_reply = 'הוסף תגובה';
		$this->topic_split = 'פיצול';
		$this->topic_split_finish = 'סיים כל הפיצולים';
		$this->topic_split_keep = 'אל תעביר תגובה זו';
		$this->topic_split_move = 'העבר תגובה זו';
		$this->topic_subscribe = 'שלח לי מייל כשהגיבו להודעה זו';
		$this->topic_top = 'עבור לראש הדף';
		$this->topic_unlock = 'בטל נעילה';
		$this->topic_unpin = 'בטח נעיצה';
		$this->topic_unpublish = 'UnPublish'; //Translate
		$this->topic_unpublished = 'This topic is classed as unpublished so you do not have permission to view it.'; //Translate
		$this->topic_unreg = 'לא רשום';
		$this->topic_view = 'הראה תוצאות';
		$this->topic_viewing = 'מציג הודעות';
		$this->topic_vote = 'הצבעה';
		$this->topic_vote_count_plur = '%d הצבעות';
		$this->topic_vote_count_sing = '%d הצבעה';
		$this->topic_votes = 'הצבעות';
	}

	function universal()
	{
		$this->aim = 'AIM'; //Translate
		$this->based_on = 'מבוסס על';
		$this->board_by = 'על ידי';
		$this->charset = 'windows-1255';
		$this->continue = 'המשך';
		$this->date_long = 'M j, Y'; //Translate
		$this->date_short = 'n/j/y'; //Translate
		$this->delete = 'מחיקה';
		$this->direction = 'rtl';
		$this->edit = 'עריכה';
		$this->email = 'אימייל';
		$this->gtalk = 'GT'; //Translate
		$this->icq = 'ICQ'; //Translate
		$this->msn = 'MSN'; //Translate
		$this->new_message = 'הודעה חדשה';
		$this->new_poll = 'סקר חדש';
		$this->new_topic = 'הודעה חדשה';
		$this->no = 'לא';
		$this->powered = 'Powered by'; //Translate
		$this->private_message = 'PM'; //Translate
		$this->quote = 'ציטוט';
		$this->recount_forums = 'Recounted forums! Total topics: %d. Total posts: %d.'; //Translate
		$this->reply = 'השב';
		$this->seconds = 'שניות';
		$this->select_all = 'בחר הכל';
		$this->sep_decimals = '.'; //Translate
		$this->sep_thousands = ','; //Translate
		$this->spoiler = 'ספויילר';
		$this->submit = 'אישור';
		$this->subscribe = 'הרשמה';
		$this->time_long = ', g:i a'; //Translate
		$this->time_only = 'g:i a'; //Translate
		$this->today = 'היום';
		$this->website = 'WWW'; //Translate
		$this->yahoo = 'Yahoo'; //Translate
		$this->yes = 'כן';
		$this->yesterday = 'אתמול';
	}
}
?>
