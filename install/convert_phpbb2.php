<?php
/**
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * https://github.com/Arthmoor/Quicksilver-Forums
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
 * phpBB2 Conversion Script
 * Based on work by Yazinin Nick <admin@vk.net.ru>
 *
 * Roger Libiez [Samson] 
 *
 * This convertor has been tested on unmodified databases for versions 2.0.4 and 2.0.14 without errors.
 * It should be reasonably safe to use on any phpBB2 2.0.x version.
 **/
class conversion
{
	public function __construct( $oldf, $newf )
	{
		$this->oldboard = &$oldf;
		$this->qsf = &$newf;
		$this->converter = 'phpBB2 2.x';
	}

	public function execute()
	{
		$this->convert_censors();
		$this->convert_members();
		$this->convert_pms();
		$this->convert_categories();
		$this->convert_forums();
		$this->convert_topics();
		$this->convert_polls();
		$this->convert_posts();

		$censor_count = $this->qsf->db->fetch( "SELECT COUNT(replacement_id) AS count FROM %preplacements" );
		$prof_count = $this->qsf->db->fetch( "SELECT COUNT(user_id) AS count FROM %pusers" );
		$pm_count = $this->qsf->db->fetch( "SELECT COUNT(pm_id) AS count FROM %ppmsystem" );
		$cat_count = $this->qsf->db->fetch( "SELECT COUNT(forum_id) AS count FROM %pforums WHERE forum_parent=0" );
		$forum_count = $this->qsf->db->fetch( "SELECT COUNT(forum_id) AS count FROM %pforums WHERE forum_parent != 0" );
		$topic_count = $this->qsf->db->fetch( "SELECT COUNT(topic_id) AS count FROM %ptopics" );
		$poll_count = $this->qsf->db->fetch( "SELECT COUNT(topic_id) AS count FROM %ptopics WHERE topic_modes & %d", TOPIC_POLL );
		$post_count = $this->qsf->db->fetch( "SELECT COUNT(post_id) AS count FROM %pposts" );

   		echo "
		    <span class='half'>
		     <div class='title'>Conversion Step</div>
		     Censored Words:<br />
		     Member Profiles:<br />
		     Private Messages:<br />
		     Forum Structure:
		    </span>

		    <span class='half'>
		     <div class='title'>Results</div>
		     {$censor_count['count']} censored words converted.<br />
		     {$prof_count['count']} member profiles converted.<br />
		     {$pm_count['count']} private messages converted.<br />
		     {$cat_count['count']} categories converted.<br />
		     {$forum_count['count']} forums converted.<br />
		     {$topic_count['count']} topics converted.<br />
		     {$poll_count['count']} polls converted.<br />
		     {$post_count['count']} posts converted.<br />
		    </span>
		    <p></p>";
	}

	public function destroy_old_data()
	{
		$tb = $this->oldboard->db->query( "SHOW TABLES LIKE '%p%%'" );

		while( $tb1 = $this->oldboard->db->nqfetch($tb) )
		{
			foreach( $tb1 as $col => $data )
				$this->oldboard->db->query( "DROP TABLE IF EXISTS %s", $data );
		}
	}

	private function get_ip( $ip )
	{
		$octet = explode( '.', chunk_split( $ip, 2, '.' ) );
		return hexdec( $octet[0] ) . '.' . hexdec( $octet[1] ) . '.' . hexdec( $octet[2] ) . '.' . hexdec( $octet[3] );
	}

	/*
	 * Remove all of the offending junky HTML Invisionboard encoded into message text.
	 * Thanks to the good people who frequent php.net for posting examples of how to use regex.
	 * It obviously helped alot, especially with Invisionboard's ugly non-validating HTML 4.01
	 */
	private function strip_phpbb2_tags( $text )
	{
		// The [html] BBCode tag is not supported by phpbb2 or Quicksilver Forums, so just strip those off and leave the contents.
		$text = preg_replace( '/\[html\](.+?)\[\/html\]/si', '\\1', $text );

		/* Convert email tags.
		 * phpBB2 does not have an email tag option in their post menu, but it supports manually entering them.
		 */
		$text = preg_replace( '/\[email\](.+?)\[\/email\]/si', '[email]\\1[/email]', $text );
		$text = preg_replace( '/\[email=(.+?)\](.*?)\[\/email\]/si', '[email=\\1]\\2[/email]', $text );

		// Convert URL tags....
		$text = preg_replace( '/\[url=(.*?)\](.*?)\[\/url\]/si', '[url]\\1[/url]', $text );
		$text = preg_replace( '/\[url\](.*?)\[\/url\]/si', '[url]\\1[/url]', $text );

		/* Convert image tags.
		 * We'll even be nice and fix malformed ones in posts.
		 */
		$text = preg_replace( '/\[img=(.*?)\](.*?)\[\/img\]/si', '[img]\\1[/img]', $text );
		$text = preg_replace( '/\[img(.*?)\](.*?)\[\/img(.*?)\]/si', '[img]\\2[/img]', $text );

		// Convert color tags....
		$text = preg_replace( '/\[color=(.*?):(.*?)\](.*?)\[\/color(.*?)\]/si', '[color=\\1]\\3[/color]', $text );

		// Font size tags....
		$text = preg_replace( '/\[size=7:(.*?)\](.*?)\[\/size:(.*?)\]/si', '[size=1]\\2[/size]', $text );
		$text = preg_replace( '/\[size=9:(.*?)\](.*?)\[\/size:(.*?)\]/si', '[size=2]\\2[/size]', $text );
		$text = preg_replace( '/\[size=12:(.*?)\](.*?)\[\/size:(.*?)\]/si', '\\2', $text );
		$text = preg_replace( '/\[size=18:(.*?)\](.*?)\[\/size:(.*?)\]/si', '[size=5]\\2[/size]', $text );
		$text = preg_replace( '/\[size=24:(.*?)\](.*?)\[\/size:(.*?)\]/si', '[size=7]\\2[/size]', $text );
		$text = preg_replace( '/\[size=(.+?):(.*?)\](.*?)\[\/size:(.*?)\]/si', '\\3', $text );

		// Fix the text formatting tags....
		$text = preg_replace( '/\[s\](.*?)\[\/s\]/si', '[s]\\2[/s]', $text ); // <- Not actually supported
		$text = preg_replace( '/\[b:(.*?)\](.*?)\[\/b:(.*?)\]/si', '[b]\\2[/b]', $text );
		$text = preg_replace( '/\[i:(.*?)\](.*?)\[\/i:(.*?)\]/si', '[i]\\2[/i]', $text );
		$text = preg_replace( '/\[u:(.*?)\](.*?)\[\/u:(.*?)\]/si', '[u]\\2[/u]', $text );

		// Reconfigure code tags....
		$text = preg_replace( '/\[code:(.*?)\]/si', '[code]', $text );
		$text = preg_replace( '/\[\/code:(.*?)\]/si', '[/code]', $text );

		// Reconfigure quote tags....
		$text = preg_replace( '/\[quote:(.*?)\]/si', '[quote]', $text );
		$text = preg_replace( '/\[\/quote:(.*?)\]/si', '[/quote]', $text );

		// Now fix the generic junk that's left over....
		$text = str_replace( "&nbsp;", " ", $text );
		$text = str_replace( "&gt;", ">", $text );
		$text = str_replace( "&lt;", "<", $text );
		$text = str_replace( "&amp;", "&", $text );
		$text = str_replace( "&quot;", "\"", $text );
		$text = str_replace( "&#33;", "!", $text );
		$text = str_replace( "&#033;", "!", $text );
		$text = str_replace( "&#34;", "\"", $text );
		$text = str_replace( "&#36;", "$", $text );
		$text = str_replace( "&#036;", "$", $text );
		$text = str_replace( "&#37;", "\%", $text );
		$text = str_replace( "&#39;", "'", $text );
		$text = str_replace( "&#039;", "'", $text );
		$text = str_replace( "&#40;", "(", $text );
		$text = str_replace( "&#41;", ")", $text );
		$text = str_replace( "&#58;", ":", $text );
		$text = str_replace( "&#59;", ";", $text );
		$text = str_replace( "&#60;", "<", $text );
		$text = str_replace( "&#62;", ">", $text );
		$text = str_replace( "&#064;", "@", $text );
		$text = str_replace( "&#64;", "@", $text );
		$text = str_replace( "&#91;", "[", $text );
		$text = str_replace( "&#092;", "\\", $text );
		$text = str_replace( "&#92;", "\\", $text );
		$text = str_replace( "&#92", "\\", $text );
		$text = str_replace( "&#93;", "]", $text );
		$text = str_replace( "&#95;", "\_", $text );
		$text = str_replace( "&#124;", "|", $text );

		return $text;
	}

	private function convert_censors()
	{
		$result = $this->oldboard->db->query( "SELECT * FROM %pwords" );

		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			$this->qsf->db->query( "INSERT INTO %preplacements (replacement_search) VALUES( '%s' )", $row['word'] );
		}
	}

	private function convert_members()
	{
		$this->qsf->db->query( "TRUNCATE %pusers" );
		$this->qsf->db->query( "INSERT INTO %pusers (user_id, user_name, user_group) VALUES (1, 'Guest', 3)" );

		$result = $this->oldboard->db->query( "SELECT * FROM %pusers" );
		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			if( $row['username'] != "Anonymous" )
			{
				if( $row['user_id'] == 1 )
					$row['user_id'] = 2;

				if( $row['user_viewemail'] == '' || $row['user_viewemail'] == 1 )
					$showmail = 1;
				else
					$showmail = 0;

				if( $row['user_lastvisit'] == '' || $row['user_lastvisit'] == 0 )
					$row['user_lastvisit'] = $row['user_regdate'];
				if( $row['user_session_time'] == '' || $row['user_session_time'] == 0 )
					$row['user_session_time'] = $row['user_regdate'];

				$row['username'] = $this->strip_phpbb2_tags( $row['username'] );
				$row['user_email'] = $this->strip_phpbb2_tags( $row['user_email'] );
				$row['user_website'] = $this->strip_phpbb2_tags( $row['user_website'] );
				$row['user_from'] = $this->strip_phpbb2_tags( $row['user_from'] );
				$row['user_interests'] = $this->strip_phpbb2_tags( $row['user_interests'] );
				$row['user_sig'] = $this->strip_phpbb2_tags( $row['user_sig'] );

				// The default phpBB2 groups: You're either an admin or you're not.
				if( $row['user_level'] == 1 )
					$row['user_level'] = 1;
				else
					$row['user_level'] = 2;

				$sql2 = "SELECT * FROM %pbanlist WHERE ban_userid = '{$row['user_id']}'";
				$result2 = $this->oldboard->db->query($sql2);

				while( $row2 = $this->oldboard->db->nqfetch($result2) )
				{
					$row['user_level'] = 4;
				}

				$pos = strpos( $row['user_avatar'], '://' );
				if( $pos == 4 )
				{
					$avatar = $row['user_avatar'];
					$width = 100;
					$height = 100;
					$type = 'url';
				}
				else
				{
					$avatar = '';
					$width = 0;
					$height = 0;
					$type = 'none';
				}

				$icq = 0;
				if( $row['user_icq'] )
					$icq = intval( $row['user_icq'] );

				$this->qsf->db->query( "INSERT INTO %pusers
					(user_id, user_name, user_password, user_joined, user_group, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height, user_email, user_email_show, user_homepage, user_posts, user_location, user_icq, user_msn, user_aim, user_yahoo, user_interests, user_signature, user_lastvisit, user_lastpost, user_view_emoticons, user_view_avatars, user_pm_mail, user_active)
					VALUES( %d, '%s', '%s', %d, %d, '%s', '%s', %d, %d, '%s', %d, '%s', %d, '%s', %d, '%s', '%s', '%s', '%s', '%s', %d, %d, %d, %d, %d, %d )",
					$row['user_id'], $row['username'], $row['user_password'], $row['user_regdate'], $row['user_level'], $avatar, $type, $width, $height, $row['user_email'], $showmail, $row['user_website'], $row['user_posts'], $row['user_from'], $icq, $row['user_msnm'], $row['user_aim'], $row['user_yim'], $row['user_interests'], $row['user_sig'], $row['user_lastvisit'], $row['user_session_time'], $row['user_allowsmile'], $row['user_allowavatar'], $row['user_notify_pm'], $row['user_allow_viewonline'] );
			}
		}
	}

	private function convert_pms()
	{
		$this->qsf->db->query( "TRUNCATE %ppmsystem" );

		$result = $this->oldboard->db->query( "SELECT p.*, t.privmsgs_text_id, t.privmsgs_text
			FROM %pprivmsgs p
			LEFT JOIN %pprivmsgs_text t ON t.privmsgs_text_id = p.privmsgs_id" );
		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			// 0 and 5 are inbox messages, 1 and 2 are sent box messages. Anything else will be discarded.
			if( $row['privmsgs_type'] == 0 || $row['privmsgs_type'] == 5 )
			{
				$folder = 0;
				if( $row['privmsgs_type'] == 5 )
					$readstate = 0;
				else
					$readstate = 1;
 			}
			else if( $row['privmsgs_type'] == 1 || $row['privmsgs_type'] == 2 )
			{
				$folder = 1;
				if( $row['privmsgs_type'] == 1 )
					$readstate = 0;
				else
					$readstate = 1;
			}
			else
				$folder = 2;

			if( $folder == 0 || $folder == 1 )
			{
				if( $row['privmsgs_to_userid'] == 1 )
					$row['privmsgs_to_userid'] = 2;
				if( $row['privmsgs_to_userid'] == 0 )
					$row['privmsgs_to_userid'] = 1;
				if( $row['privmsgs_from_userid'] == 1 )
					$row['privmsgs_from_userid'] = 2;
				if( $row['privmsgs_from_userid'] == 0 )
					$row['privmsgs_from_userid'] = 1;

				$row['privmsgs_subject'] = $this->strip_phpbb2_tags( $row['privmsgs_subject'] );
				$message = $this->strip_phpbb2_tags( $row['privmsgs_text'] );

				$bcc = '';
				if( $folder == 1 )
				{
					$bcc = $row['privmsgs_to_userid'];
					$row['privmsgs_to_userid'] = $row['privmsgs_from_userid'];
				}
				if( $row['privmsgs_subject'] == '' )
					$row['privmsgs_subject'] = 'No Title';
					$ip = $this->get_ip( $row['privmsgs_ip'] );
				$this->qsf->db->query( "INSERT INTO %ppmsystem
					(pm_id, pm_to, pm_from, pm_ip, pm_bcc, pm_title, pm_time, pm_message, pm_read, pm_folder)
					VALUES( %d, %d, %d, INET_ATON('%s'), '%s', '%s', %d, '%s', %d, %d )",
					$row['privmsgs_id'], $row['privmsgs_to_userid'], $row['privmsgs_from_userid'], $ip, $bcc, $row['privmsgs_subject'], $row['privmsgs_date'], $message, $readstate, $folder );
			}
		}
	}

	private function convert_categories()
	{
		$this->qsf->db->query( "ALTER TABLE %pforums ADD phpbb INT(4) NOT NULL" );
		$this->qsf->db->query( "TRUNCATE %pforums" );

		$result = $this->oldboard->db->query( "SELECT * FROM %pcategories" );

		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			$position = $row['cat_order'] / 10;

			$this->qsf->db->query( "INSERT INTO %pforums (forum_id, forum_name, forum_position) VALUES( %d, '%s', %d )",
				$row['cat_id'], $row['cat_title'], $position );
		}
	}

	private function convert_forums()
	{
		$result = $this->oldboard->db->query( "SELECT * FROM %pforums" );

		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			$row['forum_name'] = $this->strip_phpbb2_tags( $row['forum_name'] );
			$row['forum_desc'] = $this->strip_phpbb2_tags( $row['forum_desc'] );
			$position = $row['forum_order'] / 10;
			$num = time();

			$this->qsf->db->query( "INSERT INTO %pforums
				(forum_parent, forum_name, forum_position, forum_description, forum_topics, forum_replies, forum_lastpost, phpbb)
				VALUES( %d, '%s', %d, '%s', %d, %d, %d, %d )",
				$row['cat_id'], $row['forum_name'], $position, $row['forum_desc'], $row['forum_topics'], $row['forum_posts'], $num, $row['forum_id'] );
		}
	}

	private function convert_topics()
	{
		$this->qsf->db->query( "TRUNCATE %ptopics" );
		$result = $this->oldboard->db->query( "SELECT * FROM %ptopics" );

		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			$result1 = $this->qsf->db->query( "SELECT forum_id FROM %pforums WHERE phpbb=%d", $row['forum_id'] );
			list($tid) = $this->qsf->db->nqfetch_row($result1);

			if( $row['topic_poster'] == 1 )
			{
				$row['topic_poster'] = 2;
			}
			if( $row['topic_poster'] == 0 )
			{
				$row['topic_poster'] = 1;
			}

			$topic_modes = TOPIC_PUBLISH;
			if( $row['topic_status'] == 1 )
				$topic_modes = ($topic_modes | TOPIC_LOCKED);
			if( $row['topic_type'] == 1 || $row['topic_type'] == 2 )
				$topic_modes = ($topic_modes | TOPIC_PINNED);
			if( $row['topic_vote'] == 1 )
				$topic_modes = ($topic_modes | TOPIC_POLL);

			$row['topic_title'] = $this->strip_phpbb2_tags( $row['topic_title'] );

			$this->qsf->db->query( "INSERT INTO %ptopics
				(topic_id, topic_forum, topic_title, topic_starter, topic_last_post, topic_last_poster, topic_edited, topic_posted, topic_replies, topic_views, topic_modes)
				VALUES( %d, %d, '%s', %d, %d, %d, %d, %d, %d, %d, %d )",
				$row['topic_id'], $tid, $row['topic_title'], $row['topic_poster'], $row['topic_last_post_id'], $row['topic_poster'], $row['topic_time'], $row['topic_time'], $row['topic_replies'], $row['topic_views'], $topic_modes );
		}

		$this->qsf->db->query( "TRUNCATE %psubscriptions" );
		$result = $this->oldboard->db->query( "SELECT * FROM %ptopics_watch" );

		$expire = time() + 2592000;
		$sub_id = 0;
		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			$sub_id++;

			$this->qsf->db->query( "INSERT INTO %psubscriptions
				(subscription_id, subscription_user, subscription_type, subscription_item, subscription_expire)
				VALUES( %d, %d, 'topic', %d, %d )",
				$sub_id, $row['user_id'], $row['topic_id'], $expire );
		}

		$this->qsf->db->query( "ALTER TABLE %pforums DROP phpbb" );
	}

	private function convert_polls()
	{
		$result = $this->oldboard->db->query( "SELECT * FROM %pvote_results" );

		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			$resulttable[] = array( 'id' >= $row['vote_id'], 'option_id' => $row['vote_option_id'], 'option_text' => $row['vote_option_text'], 'option_result' => $row['vote_result'] );
		}

		$result = $this->oldboard->db->query( "SELECT * FROM %pvote_desc" );

		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			$pdesctable[] = array( 'id' >= $row['topic_id'], 'text' => $row['vote_text'] );
		}

		$this->qsf->db->query( "UPDATE %ptopics SET topic_poll_options='%s' WHERE topic_id=%d", $resulttable['vote_option_text'], $row['topic_id'] );

		$this->qsf->db->query( "TRUNCATE %pvotes" );
		$result = $this->oldboard->db->query( "SELECT * FROM %pvote_voters" );

		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			if( $row['user_id'] == 1 )
			{
				$row['user_id'] = 2;
			}
			if( $row['user_id'] == 0 )
			{
				$row['user_id'] = 1;
			}

			$this->qsf->db->query( "INSERT INTO %pvotes (vote_user, vote_topic) VALUES( %d, %d )", $row['user_id'], $row['vote_id'] );
		}
	}

	private function convert_posts()
	{
		$this->qsf->db->query( "TRUNCATE %pposts" );
		$num = $this->oldboard->db->fetch( "SELECT COUNT(post_id) AS count FROM %pposts" );

		$result= $this->oldboard->db->query( "SELECT p.*, t.post_id, t.post_text
			FROM %pposts p LEFT JOIN %pposts_text t ON t.post_id=p.post_id" );

		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			if( $row['poster_id'] == 1 )
			{
				$row['poster_id'] = 2;
			}
			if( $row['poster_id'] == 0 )
			{
				$row['poster_id'] = 1;
			}

			$message = $this->strip_phpbb2_tags( $row['post_text'] );
			$ip = $this->get_ip( $row['poster_ip'] );

			$this->qsf->db->query( "INSERT INTO %pposts 
				(post_id, post_topic, post_author, post_emoticons, post_mbcode, post_text, post_time, post_ip)
				VALUES( %d, %d, %d, %d, %d, '%s', %d, INET_ATON('%s') )",
				$row['post_id'], $row['topic_id'], $row['poster_id'], $row['enable_smilies'], $row['enable_bbcode'], $message, $row['post_time'], $ip );
		}
	}
}
?>