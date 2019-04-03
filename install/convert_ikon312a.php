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
 * Ikonboard 3.12a Conversion Script.
 * Based on work by Yazinin Nick <admin@vk.net.ru>
 *
 * Roger Libiez [Samson] 
 *
 * Script tested on an unmodified Ikonboard 3.12a database.
 * Use with any other version is not advised!
 **/
class conversion
{
	public function __construct( $oldf, $newf )
	{
		$this->oldboard = &$oldf;
		$this->qsf = &$newf;
		$this->converter = 'Ikonboard 3.12a';
	}

	public function execute()
	{
		$this->convert_members();
		$this->convert_pms();
		$this->convert_titles();
		$this->convert_categories();
		$this->convert_forums();
		$this->convert_topics();
		$this->convert_polls();
		$this->convert_posts();

		$prof_count = $this->qsf->db->fetch( "SELECT COUNT(user_id) AS count FROM %pusers" );
		$pm_count = $this->qsf->db->fetch( "SELECT COUNT(pm_id) AS count FROM %ppmsystem" );
		$title_count = $this->qsf->db->fetch( "SELECT COUNT(membertitle_id) AS count FROM %pmembertitles" );
		$cat_count = $this->qsf->db->fetch( "SELECT COUNT(forum_id) AS count FROM %pforums WHERE forum_parent=0" );
		$forum_count = $this->qsf->db->fetch( "SELECT COUNT(forum_id) AS count FROM %pforums WHERE forum_parent != 0" );
		$topic_count = $this->qsf->db->fetch( "SELECT COUNT(topic_id) AS count FROM %ptopics" );
		$poll_count = $this->qsf->db->fetch( "SELECT COUNT(topic_id) AS count FROM %ptopics WHERE topic_modes & %d", TOPIC_POLL );
		$post_count = $this->qsf->db->fetch( "SELECT COUNT(post_id) AS count FROM %pposts" );

   		echo "
		    <span class='half'>
		     <div class='title'>Conversion Step</div>
		     Member Profiles:<br />
		     Private Messages:<br />
		     Member Titles:<br />
		     Forum Structure:
		    </span>

		    <span class='half'>
		     <div class='title'>Results</div>
		     {$prof_count['count']} member profiles converted.<br />
		     {$pm_count['count']} private messages converted.<br />
		     {$title_count['count']} member titles converted.<br />
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
		$this->qsf->db->query( "DROP TABLE IF EXISTS %pikon_ids" );

		$tb = $this->oldboard->db->query( "SHOW TABLES LIKE '%p%%'" );

		while( $tb1 = $this->oldboard->db->nqfetch($tb) )
		{
			foreach( $tb1 as $col => $data )
				$this->oldboard->db->query( "DROP TABLE IF EXISTS %s", $data );
		}
	}

	/*
	 * Remove all of the offending junky HTML Invisionboard encoded into message text.
	 * Thanks to the good people who frequent php.net for posting examples of how to use regex.
	 * It obviously helped alot, especially with Invisionboard's ugly non-validating HTML 4.01
	 */
	private function strip_ikon_tags( $text )
	{
		// The [html] BBCode tag is not supported by Quicksilver Forums, so when the horrid mess is encountered in Ikonboard.......
		$text = preg_replace( "#<!--html-->(.*?)<!--html3-->#", "HTML BLOCK REMOVED", $text );

		// Convert emoticons....
		$text = preg_replace( "#<!--emo&(.+?)-->.+?<!--endemo-->#", "\\1" , $text );

		/* Convert image tags.
		 * We'll even be nice and fix malformed ones in posts.
		 */
		$text = preg_replace( "#<img src=[\"'](\S+?)['\"].+?".">#", "[img]\\1[/img]", $text );
		$text = preg_replace( '/\[img=(.*?)\](.*?)\[\/img\]/si', '[img]\\1[/img]', $text );

		// Convert email tags....
		$text = preg_replace( "#<a href=[\"']mailto:(.+?)['\"]>(.+?)</a>#", "[email=\\1]\\2[/email]", $text );

		// Convert URLs....
		$text = preg_replace( "#<a href=[\"'](.+?)['\"] target=[\"'](.+?)['\"]>(.+?)</a>#", "[url=\\1]\\3[/url]", $text );

		// Convert color tags....
		$text = preg_replace( "#<span style=[\"']color:(.+?)[\"']>(.+?)</span>#", "[color=\\1]\\2[/color]", $text );

		// Font tags are not desired, so they will be summarily parsed out....
		$text = preg_replace( "#<font(.+?)>#", "", $text );
		$text = str_replace ( "</font>", "", $text );

		// Span tags at this point are also not desired.
		$text = preg_replace( "#<span(.+?)>#", "", $text );
		$text = str_replace ( "</span>", "", $text );

		// Reconfigure code tags.
		$text = preg_replace( "#<!--c1-->(.+?)<!--ec1--><br>#", '[code]', $text );
		$text = preg_replace( "#<!--c1-->(.+?)<!--ec1-->#", '[code]', $text );
		$text = preg_replace( "#<!--c2-->(.+?)<!--ec2-->#", '[/code]', $text );

		// Reconfigure SQL tags
		$text = preg_replace( "#<!--sql-->(.+?)<!--sql1-->#", '[code]', $text );
		$text = preg_replace( "#<!--sql2-->(.+?)<!--sql3-->#", '[/code]', $text );

		// Strip flash movies and let people know about it.
		$text = preg_replace( "'<!--Flash[^>]*?>.*?<!--End Flash-->'si", "Flash image stripped during conversion.", $text );

		// Reconfigure quote tags.
		$text = preg_replace( "#<!--QuoteBegin-(.+?)<!--QuoteEBegin-->#", "[quote]", $text );
		$text = preg_replace( "#<!--QuoteEnd-->(.+?)<!--QuoteEEnd-->#", "[/quote]", $text );

		// At a loss as to what this was for....
		$text = preg_replace( "#<!--me(.+?)<!--e-me--><br>#", "", $text );

		// Fix the text formatting tags....
		$text = preg_replace( "#<i>(.+?)</i>#is", "[i]\\1[/i]", $text );
		$text = preg_replace( "#<b>(.+?)</b>#is", "[b]\\1[/b]", $text );
		$text = preg_replace( "#<s>(.+?)</s>#is", "[s]\\1[/s]", $text );
		$text = preg_replace( "#<u>(.+?)</u>#is", "[u]\\1[/u]", $text );
		$text = str_replace( "<br>", "\n\r", $text );
		$text = str_replace( "<center>", "", $text );
		$text = str_replace( "</center>", "", $text );

		// Fix random junk in the post code....
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

	private function convert_members()
	{
		/*
		 * Newer versions of Ikonboard you might have upgraded to store new member IDs in a different format.
		 * Since this is less than ideal, we need to store the offending IDs in a table to be converted.
		 * Safe bet - count up the number of existing Ikon profiles, add one, and start changing their ID numbers from there.
		 * Some people will end up with ID numbers they don't expect, but who cares as long as it works, right?
		 */
		$num = $this->oldboard->db->fetch( "SELECT COUNT(MEMBER_ID) AS count FROM %pmember_profiles" );
		$MID = $num['count'] + 1;

		$this->qsf->db->query( "TRUNCATE %pusers" );
		$this->qsf->db->query( "INSERT INTO %pusers (user_id, user_name, user_group) VALUES (1, 'Guest', 3)" );

		$result = $this->oldboard->db->query( "SELECT * FROM %pmember_profiles" );
		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			while( $row['MEMBER_ID'] >= $MID )
				$MID++;

			if( $row['MEMBER_ID'] == 1 )
				$row['MEMBER_ID'] = 2;

			$row['MEMBER_NAME'] = $this->strip_ikon_tags( $row['MEMBER_NAME'] );
			$row['MEMBER_EMAIL'] = $this->strip_ikon_tags( $row['MEMBER_EMAIL'] );
			$row['WEBSITE'] = $this->strip_ikon_tags( $row['WEBSITE'] );
			$row['LOCATION'] = $this->strip_ikon_tags( $row['LOCATION'] );
			$row['INTERESTS'] = $this->strip_ikon_tags( $row['INTERESTS'] );
			$row['SIGNATURE'] = $this->strip_ikon_tags( $row['SIGNATURE'] );

			$pos = strpos( $row['MEMBER_ID'], '-' );
			if( $pos != false )
			{
				$IDTABLE[] = array( 'uname' => $row['MEMBER_NAME'], 'newid' => $MID, 'oldid' => $row['MEMBER_ID'] );
				$row['MEMBER_ID'] = $MID;
				$MID++;
			}
			if( $row['HIDE_EMAIL'] == '' || $row['HIDE_EMAIL'] == 1 )
				$showmail = 0;
			else
				$showmail = 1;

			if( $row['LAST_LOG_IN'] == '' )
				$row['LAST_LOG_IN'] = $row['MEMBER_JOINED'];
			if( $row['LAST_ACTIVITY'] == '' )
				$row['LAST_ACTIVITY'] = $row['MEMBER_JOINED'];

			/* The default Ikonboard groups they claim you can never alter.
			 * Additional groups will not be converted. Members in these groups will become standard members.
			 */
			if( $row['MEMBER_GROUP'] == 1 )
				$row['MEMBER_GROUP'] = 5;
			else if( $row['MEMBER_GROUP'] == 2 )
				$row['MEMBER_GROUP'] = 3;
			else if( $row['MEMBER_GROUP'] == 3 )
				$row['MEMBER_GROUP'] = 2;
			else if( $row['MEMBER_GROUP'] == 4 )
				$row['MEMBER_GROUP'] = 1;
			else
				$row['MEMBER_GROUP'] = 2;

			$level = $row['MEMBER_LEVEL'] + 1;
			if( $level < 1 )
				$level = 1;

			$pos = strpos( $row['MEMBER_AVATAR'], '://' );
			if( $pos == 4 )
			{
				$avatar = $row['MEMBER_AVATAR'];
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
			if( $row['ICQNUMBER'] )
				$icq = intval( $row['ICQNUMBER'] );

			$this->qsf->db->query( "INSERT INTO %pusers
				(user_id, user_name, user_password, user_joined, user_level, user_title, user_group, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height, user_email, user_email_show, user_homepage, user_posts, user_location, user_icq, user_msn, user_aim, user_yahoo, user_interests, user_signature, user_lastvisit, user_lastpost, user_view_avatars, user_view_signatures, user_regip)
				VALUES( %d, '%s', '%s', %d, %d, '%s', %d, '%s', '%s', %d, %d, '%s', %d, '%s', %d, '%s', %d, '%s', '%s', '%s', '%s', '%s', %d, %d, %d, %d, INET_ATON( '%s' ) )",
				$row['MEMBER_ID'], $row['MEMBER_NAME'], $row['MEMBER_PASSWORD'], $row['MEMBER_JOINED'], $level, $row['MEMBER_TITLE'], $row['MEMBER_GROUP'], $avatar, $type, $width, $height, $row['MEMBER_EMAIL'], $showmail, $row['WEBSITE'], $row['MEMBER_POSTS'], $row['LOCATION'], $icq, $row['MSNNAME'], $row['AOLNAME'], $row['YAHOONAME'], $row['INTERESTS'], $row['SIGNATURE'], $row['LAST_LOG_IN'], $row['LAST_ACTIVITY'], $row['VIEW_AVS'], $row['VIEW_SIGS'], $row['MEMBER_IP'] );
		}

		$this->qsf->db->query( "DROP TABLE IF EXISTS %pikon_ids" );
		$this->qsf->db->query( "CREATE TABLE %pikon_ids
			( old_name varchar(32) NOT NULL, old_id varchar(32) NOT NULL, new_id int(10) unsigned NOT NULL, PRIMARY KEY(old_id) )" );

		for( $x = 0; $x < sizeof( $IDTABLE ); $x++ )
		{
			$name = $IDTABLE[$x]['uname'];
			$oldid = $IDTABLE[$x]['oldid'];
			$newid = $IDTABLE[$x]['newid'];

			$this->qsf->db->query( "INSERT INTO %pikon_ids VALUES( '%s', '%s', %d )", $name, $oldid, $newid );
		}
	}

	private function convert_pms()
	{
		$result = $this->qsf->db->query( "SELECT * FROM %pikon_ids" );
		while( $row = $this->qsf->db->nqfetch($result) )
		{
			$IDTABLE[] = array( 'uname' => $row['old_name'], 'oldid' => $row['old_id'], 'newid' => $row['new_id']  );
		}

		$this->qsf->db->query( "TRUNCATE %ppmsystem" );
		$result= $this->oldboard->db->query( "SELECT * FROM %pmessage_data" );
		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			if( $row['VIRTUAL_DIR'] == "in" || $row['VIRTUAL_DIR'] == "sent" )
			{
				// An empty recipient ID is apparently just a message confirmation. No need to convert this.
				if( $row['RECIPIENT_ID'] != '' )
				{
					if( $row['RECIPIENT_ID'] == 1 )
						$row['RECIPIENT_ID'] = 2;
					if( $row['RECIPIENT_ID'] == 0 )
						$row['RECIPIENT_ID'] = 1;
					if( $row['FROM_ID'] == 1 )
						$row['FROM_ID'] = 2;
					if( $row['FROM_ID'] == 0 )
						$row['FROM_ID'] = 1;
					if( $row['MEMBER_ID'] == 1 )
						$row['MEMBER_ID'] = 2;
					if( $row['MEMBER_ID'] == 0 )
						$row['MEMBER_ID'] = 1;

					for( $x = 0; $x < sizeof( $IDTABLE ); $x++ )
					{
						if( $row['FROM_NAME'] == $IDTABLE[$x]['uname'] )
							$row['FROM_ID'] = $IDTABLE[$x]['newid'];
						if( $row['RECIPIENT_NAME'] == $IDTABLE[$x]['uname'] )
							$row['RECIPIENT_ID'] = $IDTABLE[$x]['newid'];
					}
					$row['TITLE'] = $this->strip_ikon_tags( $row['TITLE'] );
					$row['MESSAGE'] = $this->strip_ikon_tags( $row['MESSAGE'] );

					if( $row['VIRTUAL_DIR'] == "in" )
						$folder = 0;
					else
						$folder = 1;

					$bcc = '';
					if( $folder == 1 )
					{
						$bcc = $row['RECIPIENT_ID'];
						$row['RECIPIENT_ID'] = $row['MEMBER_ID'];
					}
					if( $row['TITLE'] == '' )
						$row['TITLE'] = 'No Title';
					$this->qsf->db->query( "INSERT INTO %ppmsystem 
						(pm_id, pm_to, pm_from, pm_bcc, pm_title, pm_time, pm_message, pm_read, pm_folder)
						VALUES( %d, %d, %d, '%s', '%s', %d, '%s', %d, %d )",
						$row['MESSAGE_ID'], $row['RECIPIENT_ID'], $row['FROM_ID'], $bcc, $row['TITLE'], $row['DATE'], $row['MESSAGE'], $row['READ_STATE'], $folder );
				}
			}
		}
	}

	private function convert_titles()
	{
		$num = $this->oldboard->db->fetch( "SELECT COUNT(ID) AS count FROM %pmember_titles" );

		if( $num['count'] > 0 )
		{
			$this->qsf->db->query( "TRUNCATE %pmembertitles" );

			$result = $this->oldboard->db->query( "SELECT * FROM %pmember_titles" );
			while( $row = $oldboard->db->nqfetch($result) )
			{
				if( $row['PIPS'] < 0 )
					$icon = '0.png';
				else
				{
					$icon = $row['PIPS'];
					$icon .= '.png';
				}
				$this->qsf->db->query( "INSERT INTO %pmembertitles
					(membertitle_id, membertitle_title, membertitle_posts, membertitle_icon)
					VALUES( %d, '%s', %d, '%s' )", $row['ID'], $row['TITLE'], $row['POSTS'], $icon );
			}
		}
	}

	private function convert_categories()
	{
		$this->qsf->db->query( "ALTER TABLE %pforums ADD ib INT(4) NOT NULL" );
		$this->qsf->db->query( "TRUNCATE %pforums" );

		$result = $this->oldboard->db->query( "SELECT * FROM %pcategories" );
		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			if( $row['SUB_CAT_ID'] > 0 )
				$subcat = 1;
			else
				$subcat = 0;
			$this->qsf->db->query( "INSERT INTO %pforums
				(forum_id, forum_parent, forum_name, forum_position, forum_description, forum_subcat)
				VALUES( %d, %d, '%s', %d, '%s', %d )",
				$row['CAT_ID'], $row['SUB_CAT_ID'], $row['CAT_NAME'], $row['CAT_POS'], $row['CAT_DESC'], $subcat );
		}
	}

	private function convert_forums()
	{
		$result = $this->oldboard->db->query( "SELECT * FROM %pforum_info" );
		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			$row['FORUM_NAME'] = $this->strip_ikon_tags( $row['FORUM_NAME'] );
			$row['FORUM_DESC'] = $this->strip_ikon_tags( $row['FORUM_DESC'] );

			$this->qsf->db->query( "INSERT INTO %pforums
				(forum_parent, forum_name, forum_position, forum_description, forum_topics, forum_replies, forum_lastpost, ib)
				VALUES( %d, '%s', %d, '%s', %d, %d, %d, %d )",
				$row['CATEGORY'], $row['FORUM_NAME'], $row['FORUM_POSITION'], $row['FORUM_DESC'], $row['FORUM_TOPICS'], $row['FORUM_POSTS'], $row['FORUM_LAST_POST'], $row['FORUM_ID'] );
		}
	}

	private function convert_topics()
	{
		$result = $this->qsf->db->query( "SELECT * FROM %pikon_ids" );
		while( $row = $this->qsf->db->nqfetch($result) )
		{
			$IDTABLE[] = array( 'uname' => $row['old_name'], 'oldid' => $row['old_id'], 'newid' => $row['new_id']  );
		}

		$this->qsf->db->query( "TRUNCATE %ptopics" );
		$result = $this->oldboard->db->query( "SELECT * FROM %pforum_topics" );

		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			$result1 = $this->qsf->db->query( "SELECT forum_id FROM %pforums WHERE ib=%d", $row['FORUM_ID'] );
			list($tid) = $this->qsf->db->nqfetch_row($result1);

			if( $row['TOPIC_STARTER'] == 1 )
			{
				$row['TOPIC_STARTER'] = 2;
			}
			if( $row['TOPIC_STARTER'] == 0 )
			{
				$row['TOPIC_STARTER'] = 1;
			}
			if( $row['TOPIC_LAST_POSTER'] == 1 )
			{
				$row['TOPIC_LAST_POSTER'] = 2;
			}
			if( $row['TOPIC_LAST_POSTER'] == 0 )
			{
				$row['TOPIC_LAST_POSTER'] = 1;
			}

			// Loop over the remaining members and play games with the topic data to fix the blasted post names for the newer member IDs.
			for( $x = 0; $x < sizeof( $IDTABLE ); $x++ )
			{
				$name = $IDTABLE[$x]['uname'];
				$newid = $IDTABLE[$x]['newid'];

 				if( $row['TOPIC_STARTER_N'] == $name )
				{
					$row['TOPIC_STARTER'] = $newid;
				}
				if( $row['TOPIC_LASTP_N'] == $name )
				{
					$row['TOPIC_LAST_POSTER'] = $newid;
				}
			}
			$topic_modes = TOPIC_PUBLISH;
			if( $row['TOPIC_STATE'] == 'closed' )
				$topic_modes = ($topic_modes | TOPIC_LOCKED);
			if( $row['PIN_STATE'] == '1' )
				$topic_modes = ($topic_modes | TOPIC_PINNED);
			if( $row['POLL_STATE'] == 'open' )
				$topic_modes = ($topic_modes | TOPIC_POLL);

			$row['TOPIC_TITLE'] = $this->strip_ikon_tags( $row['TOPIC_TITLE'] );
			$row['TOPIC_DESC'] = $this->strip_ikon_tags( $row['TOPIC_DESC'] );

			$this->qsf->db->query( "INSERT INTO %ptopics
				(topic_id, topic_forum, topic_title, topic_description, topic_starter, topic_last_poster, topic_posted, topic_edited, topic_replies, topic_views, topic_modes)
				VALUES( %d, %d, '%s', '%s', %d, %d, %d, %d, %d, %d, %d )",
				$row['TOPIC_ID'], $tid, $row['TOPIC_TITLE'], $row['TOPIC_DESC'], $row['TOPIC_STARTER'], $row['TOPIC_START_DATE'], $row['TOPIC_LAST_POSTER'], $row['TOPIC_LAST_DATE'], $row['TOPIC_POSTS'], $row['TOPIC_VIEWS'], $topic_modes );
		}

		$this->qsf->db->query( "TRUNCATE %psubscriptions" );
		$result = $this->oldboard->db->query( "SELECT * FROM %pforum_subscriptions" );
 		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			$result1 = $this->qsf->db->query( "SELECT forum_id FROM %pforums WHERE ib=%d", $row['FORUM_ID'] );
			list($tid) = $this->qsf->db->nqfetch_row($result1);

			if( $row['MEMBER_ID'] == 1 )
			{
				$row['MEMBER_ID'] = 2;
			}
			if( $row['MEMBER_ID'] == 0 )
			{
				$row['MEMBER_ID'] = 1;
			}

			if( $row['TOPIC_ID'] == 0 )
			{
				$subtype = 'forum';
				$item = $tid;
			}
			else
			{
				$subtype = 'topic';
				$item = $row['TOPIC_ID'];
			}

			$expire = time() + 2592000;

			// Loop over the remaining members and play games with the topic data to fix the blasted post names for the newer member IDs.
			for( $x = 0; $x < sizeof( $IDTABLE ); $x++ )
			{
				$name = $IDTABLE[$x]['uname'];
				$newid = $IDTABLE[$x]['newid'];

				if( $row['MEMBER_NAME'] == $name )
				{
					$row['MEMBER_ID'] = $newid;
				}
			}

 			$this->qsf->db->query( "INSERT INTO %psubscriptions
				(subscription_id, subscription_user, subscription_type, subscription_item, subscription_expire)
				VALUES( %d, %d, '%s', %d, %d )", $row['ID'], $row['MEMBER_ID'], $subtype, $item, $expire );
		}

		$this->qsf->db->query( "ALTER TABLE %pforums DROP ib" );
	}

	private function convert_polls()
	{
		$result = $this->qsf->db->query( "SELECT * FROM %pikon_ids" );
		while( $row = $this->qsf->db->nqfetch($result) )
		{
			$IDTABLE[] = array( 'uname' => $row['old_name'], 'oldid' => $row['old_id'], 'newid' => $row['new_id']  );
		}

		$result = $this->oldboard->db->query( "SELECT * FROM %pforum_polls" );

		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			// Split into options and votes
			preg_match_all( '/-->(.+?)~=~(\d+)\|/', $row['POLL_ANSWERS'], $matches, PREG_SET_ORDER );

			$pollanswers = '';
			$voting_data = array();

			foreach ($matches as $match) {
				// Set as option => votes
				$pollanswers .= $match[1] . "\n";
				$voting_data[$match[1]] = $match[2];
			}

			$this->qsf->db->query( "UPDATE %ptopics SET topic_poll_options='%s' WHERE topic_id=%d", $pollanswers, $row['POLL_ID'] );
		}

		$this->qsf->db->query( "TRUNCATE %pvotes" );
		$result = $this->oldboard->db->query( "SELECT * FROM %pforum_poll_voters" );

		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			if( $row['MEMBER_ID'] == 1 )
			{
				$row['MEMBER_ID'] = 2;
			}
			if( $row['MEMBER_ID'] == 0 )
			{
				$row['MEMBER_ID'] = 1;
			}

			for( $x = 0; $x < sizeof( $IDTABLE ); $x++ )
			{
				$oldid = $IDTABLE[$x]['oldid'];
				$newid = $IDTABLE[$x]['newid'];

				if( $row['MEMBER_ID'] == $oldid )
				{
					$row['MEMBER_ID'] = $newid;
				}
			}

			$this->qsf->db->query( "INSERT INTO %pvotes (vote_user, vote_topic) VALUES( %d, %d )", $row['MEMBER_ID'], $row['POLL_ID'] );
		}
	}

	private function convert_posts()
	{
		$this->qsf->db->query( "TRUNCATE %pposts" );
		$num = $this->oldboard->db->fetch( "SELECT COUNT(POST_ID) AS count FROM %pforum_posts" );

		$result = $this->qsf->db->query( "SELECT * FROM %pikon_ids" );
		while( $row = $this->qsf->db->nqfetch($result) )
		{
			$IDTABLE[] = array( 'uname' => $row['old_name'], 'oldid' => $row['old_id'], 'newid' => $row['new_id']  );
		}

		$result = $this->oldboard->db->query( "SELECT * FROM  %pforum_posts" );

		while( $row = $this->oldboard->db->nqfetch($result) )
		{
			if( $row['AUTHOR'] == 1 )
			{
				$row['AUTHOR'] = 2;
			}
			if( $row['AUTHOR'] == 0 )
			{
				$row['AUTHOR'] = 1;
			}

			// Loop over the remaining members and play games with the post data to fix the blasted post names.
			for( $x = 0; $x < sizeof( $IDTABLE ); $x++ )
			{
				$oldid = $IDTABLE[$x]['oldid'];
				$newid = $IDTABLE[$x]['newid'];

				if( $row['AUTHOR'] == $oldid )
				{
					$row['AUTHOR'] = $newid;
				}
			}

			$row['POST'] = $this->strip_ikon_tags( $row['POST'] );

			$this->qsf->db->query( "INSERT INTO %pposts
				(post_id, post_topic, post_author, post_emoticons, post_text, post_time, post_ip)
				VALUES( %d, %d, %d, %d, '%s', %d, INET_ATON('%s') )",
				$row['POST_ID'], $row['TOPIC_ID'], $row['AUTHOR'], $row['ENABLE_EMO'], $row['POST'], $row['POST_DATE'], $row['IP_ADDR'] );
		}
	}
}
?>