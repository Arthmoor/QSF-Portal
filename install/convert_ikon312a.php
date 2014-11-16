<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2010 The QSF Portal Development Team
 * http://www.qsfportal.com/
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2006 The Quicksilver Forums Development Team
 * http://www.quicksilverforums.com/
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

/**
 * Ikonboard 3.12a Conversion Script.
 * Based on work by Yazinin Nick <admin@vk.net.ru>
 *
 * Roger Libiez [Samson] http://www.iguanadons.net
 *
 * Script tested on an unmodified Ikonboard 3.12a database.
 * Use with any other version is not advised!
 **/

define('QUICKSILVERFORUMS', true);

require_once './convert_db.php';
require_once '../settings.php';
$set['include_path'] = '..';
require_once $set['include_path'] . '/defaultutils.php';
require_once $set['include_path'] . '/global.php';

define('CONVERTER_NAME', 'Ikonboard 3.12a');
define('CONVERTER_URL', 'convert_ikon312a.php');
define('CONVERTER_DROPURL', 'convert_ikon312a.php?action=dropikon');
define('CONVERTOR_DROPCONFIRMURL', 'convert_ikon312a.php?action=confirmikondrop');

$db = new $modules['database']( $set['db_host'], $set['db_user'], $set['db_pass'], $set['db_name'], $set['db_port'], $set['db_socket'], $set['prefix'] );
if( !$db->connection )
{
   error( QUICKSILVER_ERROR, 'A connection to the Quicksilver Forums database could not be established. Please check your settings and try again.', __FILE__, __LINE__ );
}
$qsf = new qsfglobal($db);

$olddb = new $modules['database']( $oldset['old_db_host'], $oldset['old_db_user'], $oldset['old_db_pass'], $oldset['old_db_name'], $oldset['old_db_port'], $oldset['old_db_socket'], $oldset['old_prefix'] );
if( !$olddb->connection )
{
   error( QUICKSILVER_ERROR, 'A connection to the Ikonboard database could not be established. Please check your settings and try again.', __FILE__, __LINE__ );
}
$oldboard = new qsfglobal($olddb); // Yes, I know this looks goofy, but we want to try and leverage the Mercury code as much as possible

function write_olddb_sets( $oldset )
{
   $settings = "<?php\n\$oldset = array();\n";

   $db_settings = array(
      'old_db_host'   => $oldset['old_db_host'],
      'old_db_name'   => $oldset['old_db_name'],
      'old_db_pass'   => $oldset['old_db_pass'],
      'old_db_port'   => $oldset['old_db_port'],
      'old_db_socket' => $oldset['old_db_socket'],
      'old_db_user'   => $oldset['old_db_user'],
      'old_dbtype'    => $oldset['old_dbtype'],
      'old_prefix'    => $oldset['old_prefix'],
      'converted'     => $oldset['converted'],
      'profiles'      => $oldset['profiles'],
      'prof_count'    => $oldset['prof_count'],
      'pms'           => $oldset['pms'],
      'pm_count'      => $oldset['pm_count'],
      'titles'        => $oldset['titles'],
      'title_count'   => $oldset['title_count'],
      'cats'          => $oldset['cats'],
      'cat_count'     => $oldset['cat_count'],
      'forums'        => $oldset['forums'],
      'forum_count'   => $oldset['forum_count'],
      'topics'        => $oldset['topics'],
      'topic_count'   => $oldset['topic_count'],
      'polls'         => $oldset['polls'],
      'poll_count'    => $oldset['poll_count'],
      'posts'         => $oldset['posts'],
      'post_count'    => $oldset['post_count'],
      'post_inc'      => $oldset['post_inc']
   );

   foreach( $db_settings as $oldset => $val )
   {
      $settings .= "\$oldset['$oldset'] = '" . str_replace(array('\\', '\''), array('\\\\', '\\\''), $val) . "';\n";
   }

   $settings .= '?' . '>';

   @chmod( $sfile, 0666 );
   $fp = @fopen( './convert_db.php', 'w' );

   if( !$fp )
   {
      return false;
   }

   if( !@fwrite( $fp, $settings ) )
   {
      return false;
   }
   fclose( $fp );
   return true;
}

/*
 * Remove all of the offending junky HTML Ikonboard encoded into message text.
 * Thanks to the good people who frequent php.net for posting examples of how to use regex.
 * It obviously helped alot, especially with Ikonboard's ugly non-validating HTML 4.01
 */
function strip_ikon_tags( $text )
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

if( !isset($_GET['action']) || $_GET['action'] == '' )
{
   if( $oldset['converted'] == 0 )
   {
      $oldset['converted'] = 1;
      $oldset['profiles'] = 0;
      $oldset['prof_count'] = 0;
      $oldset['pms'] = 0;
      $oldset['pm_count'] = 0;
      $oldset['titles'] = 0;
      $oldset['title_count'] = 0;
      $oldset['cats'] = 0;
      $oldset['cat_count'] = 0;
      $oldset['forums'] = 0;
      $oldset['forum_count'] = 0;
      $oldset['topics'] = 0;
      $oldset['topic_count'] = 0;
      $oldset['polls'] = 0;
      $oldset['poll_count'] = 0;
      $oldset['posts'] = 0;
      $oldset['post_count'] = 0;

      write_olddb_sets( $oldset );
   }

   $prof = $oldset['profiles'];
   $prof_count = $oldset['prof_count'];
   $pms = $oldset['pms'];
   $pm_count = $oldset['pm_count'];
   $titles = $oldset['titles'];
   $title_count = $oldset['title_count'];
   $cats = $oldset['cats'];
   $cat_count = $oldset['cat_count'];
   $forums = $oldset['forums'];
   $forum_count = $oldset['forum_count'];
   $topics = $oldset['topics'];
   $topic_count = $oldset['topic_count'];
   $polls = $oldset['polls'];
   $poll_count = $oldset['poll_count'];
   $posts = $oldset['posts'];
   $post_count = $oldset['post_count'];

   include 'templates/convert_header.php';

   echo "<tr>
     <td class='subheader' align='center' style='border-right:0;'>Conversion Step</td>
     <td class='subheader' align='center' style='border-left:0; border-right:0;'>Results</td>
     </tr>
     <tr>
     <td class='tablelight'>&nbsp;</td>
     <td class='tablelight'>&nbsp;</td>
     </tr>
     <tr>
     <td class='tablelight' align='left'><a href='convert_ikon312a.php?action=members'>Convert Member Profiles</a>
     </td>";

   if( $prof_count > 0 )
      echo "<td class='tablelight' align='left'>".$prof_count." member profiles converted.</td>\n";
   else
      echo "<td class='tablelight'>&nbsp;</td>\n";
   echo "</tr>\n";

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_ikon312a.php?action=pmessages'>Convert Private Messages</a></td>\n";
      if( $pms == 1 )
         echo "<td class='tablelight' align='left'>".$pm_count." private messages converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_ikon312a.php?action=mtitles'>Convert Member Titles</a></td>\n";
      if( $titles == 1 )
         echo "<td class='tablelight' align='left'>".$title_count." member titles converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_ikon312a.php?action=categories'>Convert Categories</a></td>\n";
      if( $cats == 1 )
         echo "<td class='tablelight' align='left'>".$cat_count." categories converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $cats == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_ikon312a.php?action=forums'>Convert Forums</a></td>\n";
      if( $forums == 1 )
         echo "<td class='tablelight' align='left'>".$forum_count." forums converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 && $forums == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_ikon312a.php?action=topics'>Convert Topics</a></td>\n";
      if( $topics == 1 )
         echo "<td class='tablelight' align='left'>".$topic_count." topics converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 && $topics == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_ikon312a.php?action=polls'>Convert Polls</a> ( BUGGY )</td>\n";
      if( $polls == 1 )
         echo "<td class='tablelight' align='left'>".$poll_count." polls converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 && $topics == 1 )
   {
      echo "<tr>\n";
      if( $posts == 0 )
      {
         echo "<td class='tablelight' align='left'><a href='convert_ikon312a.php?action=posts'>Convert Posts</a></td>\n";
         echo "<td class='tablelight'>&nbsp;</td>\n";
      }
      else if( $posts == 1 )
      {
         echo "<td class='tablelight' align='left'><a href='convert_ikon312a.php?action=posts&amp;start=".$post_count."&amp;i=".$post_count."'>Continue post conversion</a></td>\n";
         echo "<td class='tablelight' align='left'>".$post_count." posts converted so far.</td>\n";
      }
      else
      {
         echo "<td class='tablelight' align='left'><a href='convert_ikon312a.php?action=posts'>Convert Posts</a></td>\n";
         echo "<td class='tablelight' align='left'>".$post_count." posts converted.</td>\n";
      }
      echo "</tr>\n";
   }

   echo "<tr>\n";
   echo "<td class='tablelight'>&nbsp;</td>\n";
   echo "<td class='tablelight'>&nbsp;</td>\n";
   echo "</tr>\n";

   if( $posts == 2 || $oldset['converted'] == 2 )
   {
      $qsf->db->query( "DROP TABLE IF EXISTS %pikon_ids" );
      $qsf->sets = $qsf->get_settings($qsf->sets);
      $qsf->updateForumTrees();
      $qsf->RecountForums();
      
      include 'templates/convert_finished.php';
   }
   include 'templates/convert_footer.php';
}

else if( $_GET['action'] == 'dropikon' )
{
    include 'templates/convert_header.php';
    include 'templates/convert_destroydata.php';
    include 'templates/convert_footer.php';
}

else if( $_GET['action'] == 'confirmikondrop' )
{
   $qsf->db->query( "DROP TABLE IF EXISTS %pikon_ids" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pactive_sessions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %paddress_books" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pattachments" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pauthorisation" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcalendar" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcategories" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pemail_templates" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_info" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_moderators" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_poll_voters" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_polls" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_posts" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_rules" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_subscriptions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_topics" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %phelp" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmem_groups" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmember_notepads" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmember_profiles" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmember_titles" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmessage_data" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmessage_stats" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmod_email" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmod_posts" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmoderator_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psearch_log" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pssi_templates" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptemplates" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptopic_views" );

   include 'templates/convert_header.php';
   include 'templates/convert_datadestroyed.php';
   include 'templates/convert_footer.php';
}

else if( $_GET['action'] == 'members' )
{
   /*
    * Newer versions of Ikonboard you might have upgraded to store new member IDs in a different format.
    * Since this is less than ideal, we need to store the offending IDs in a table to be converted.
    * Safe bet - count up the number of existing Ikon profiles, add one, and start changing their ID numbers from there.
    * Some people will end up with ID numbers they don't expect, but who cares as long as it works, right?
    */
   $i = 0;
   $num = $oldboard->db->query( "SELECT * FROM %pmember_profiles" );
   $all = $oldboard->db->num_rows( $num );
   $MID = $all + 1;

   $qsf->db->query( "TRUNCATE %pusers" );
   $qsf->db->query( "INSERT INTO %pusers (user_id, user_name, user_group) VALUES (1, 'Guest', 3)" );

   $result = $oldboard->db->query( "SELECT * FROM %pmember_profiles" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      while( $row['MEMBER_ID'] >= $MID )
         $MID++;

      if( $row['MEMBER_ID'] == 1 )
         $row['MEMBER_ID'] = 2;

      $row['MEMBER_NAME'] = strip_ikon_tags( $row['MEMBER_NAME'] );
      $row['MEMBER_EMAIL'] = strip_ikon_tags( $row['MEMBER_EMAIL'] );
      $row['WEBSITE'] = strip_ikon_tags( $row['WEBSITE'] );
      $row['LOCATION'] = strip_ikon_tags( $row['LOCATION'] );
      $row['INTERESTS'] = strip_ikon_tags( $row['INTERESTS'] );
      $row['SIGNATURE'] = strip_ikon_tags( $row['SIGNATURE'] );

      $pos = strpos( $row['MEMBER_ID'], '-' );
      if( $pos != false )
      {
         $IDTABLE[] = array( 'name' => $row['MEMBER_NAME'], 'newid' => $MID, 'oldid' => $row['MEMBER_ID'] );
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
         $width = 64;
         $height = 64;
         $type = "url";
      }
      else
      {
         $avatar = '';
         $width = 0;
         $height = 0;
         $type = "none";
      }

      $icq = 0;
      if( $row['ICQNUMBER'] )
         $icq = intval( $row['ICQNUMBER'] );

      $qsf->db->query( "INSERT INTO %pusers
         (user_id, user_name, user_password, user_joined, user_level, user_title, user_group, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height, user_email, user_email_show, user_homepage, user_posts, user_location, user_icq, user_msn, user_aim, user_yahoo, user_interests, user_signature, user_lastvisit, user_lastpost, user_regip, user_view_avatars, user_view_signatures)
         VALUES( %d, '%s', '%s', %d, %d, '%s', %d, '%s', '%s', %d, %d, '%s', %d, '%s', %d, '%s', %d, '%s', '%s', '%s', '%s', '%s', %d, %d, INET_ATON('%s'), %d, %d )",
         $row['MEMBER_ID'], $row['MEMBER_NAME'], $row['MEMBER_PASSWORD'], $row['MEMBER_JOINED'], $level, $row['MEMBER_TITLE'], $row['MEMBER_GROUP'], $avatar, $type, $width, $height, $row['MEMBER_EMAIL'], $showmail, $row['WEBSITE'], $row['MEMBER_POSTS'], $row['LOCATION'], $icq, $row['MSNNAME'], $row['AOLNAME'], $row['YAHOONAME'], $row['INTERESTS'], $row['SIGNATURE'], $row['LAST_LOG_IN'], $row['LAST_ACTIVITY'], $row['MEMBER_IP'], $row['VIEW_AVS'], $row['VIEW_SIGS'] );
      $i++;
   }

   $qsf->db->query( "DROP TABLE IF EXISTS %pikon_ids" );
   $qsf->db->query( "CREATE TABLE %pikon_ids
      ( old_name varchar(32) NOT NULL, old_id varchar(32) NOT NULL, new_id int(10) unsigned NOT NULL, PRIMARY KEY(old_id) )" );

   for( $x = 0; $x < sizeof( $IDTABLE ); $x++ )
   {
      $name = $IDTABLE[$x]['name'];
      $oldid = $IDTABLE[$x]['oldid'];
      $newid = $IDTABLE[$x]['newid'];

      $qsf->db->query( "INSERT INTO %pikon_ids VALUES( '%s', '%s', %d )", $name, $oldid, $newid );
   }

   $oldset['profiles'] = 1;
   $oldset['prof_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ikon312a.php'>";
}

else if( $_GET['action'] == 'pmessages' )
{
   $result = $qsf->db->query( "SELECT * FROM %pikon_ids" );
   while( $row = $qsf->db->nqfetch($result) )
   {
      $IDTABLE[] = array( 'name' => $row['old_name'], 'oldid' => $row['old_id'], 'newid' => $row['new_id']  );
   }

   $i = 0;
   $qsf->db->query( "TRUNCATE %ppmsystem" );
   $result= $oldboard->db->query( "SELECT * FROM %pmessage_data" );
   while( $row = $oldboard->db->nqfetch($result) )
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
               if( $row['FROM_NAME'] == $IDTABLE[$x]['name'] )
                  $row['FROM_ID'] = $IDTABLE[$x]['newid'];
               if( $row['RECIPIENT_NAME'] == $IDTABLE[$x]['name'] )
                  $row['RECIPIENT_ID'] = $IDTABLE[$x]['newid'];
            }
            $row['TITLE'] = strip_ikon_tags( $row['TITLE'] );
            $row['MESSAGE'] = strip_ikon_tags( $row['MESSAGE'] );

            $i++;

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
               $row['TITLE'] = "No Title";
            $qsf->db->query( "INSERT INTO %ppmsystem 
               (pm_id, pm_to, pm_from, pm_bcc, pm_title, pm_time, pm_message, pm_read, pm_folder)
               VALUES( %d, %d, %d, '%s', '%s', %d, '%s', %d, %d )",
               $row['MESSAGE_ID'], $row['RECIPIENT_ID'], $row['FROM_ID'], $bcc, $row['TITLE'], $row['DATE'], $row['MESSAGE'], $row['READ_STATE'], $folder );
         }
      }
   }

   $oldset['pms'] = 1;
   $oldset['pm_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ikon312a.php'>";
}

else if( $_GET['action'] == 'mtitles' )
{
   $num = $oldboard->db->query( "SELECT * FROM %pmember_titles" );
   $all = $oldboard->db->num_rows( $num );
   $i = 0;

   if( $all > 0 )
   {
      $qsf->db->query( "TRUNCATE %pmembertitles" );

      $result= $oldboard->db->query( "SELECT * FROM %pmember_titles" );
      while( $row = $oldboard->db->nqfetch($result) )
      {
         if( $row['PIPS'] < 0 )
            $icon = '0.png';
         else
         {
            $icon = $row['PIPS'];
            $icon .= '.png';
         }
         $qsf->db->query( "INSERT INTO %pmembertitles
            (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon)
            VALUES( %d, '%s', %d, '%s' )", $row['ID'], $row['TITLE'], $row['POSTS'], $icon );
         $i++;
      }
   }

   $oldset['titles'] = 1;
   $oldset['title_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ikon312a.php'>";
}

else if( $_GET['action'] == 'categories' )
{
   $qsf->db->query( "ALTER TABLE %pforums ADD ib INT(4) NOT NULL" );
   $qsf->db->query( "TRUNCATE %pforums" );

   $result = $oldboard->db->query( "SELECT * FROM %pcategories" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      if( $row['SUB_CAT_ID'] > 0 )
         $subcat = 1;
      else
         $subcat = 0;
      $qsf->db->query( "INSERT INTO %pforums
         (forum_id, forum_parent, forum_name, forum_position, forum_description, forum_subcat)
         VALUES( %d, %d, '%s', %d, '%s', %d )",
         $row['CAT_ID'], $row['SUB_CAT_ID'], $row['CAT_NAME'], $row['CAT_POS'], $row['CAT_DESC'], $subcat );
      $i++;
   }

   $oldset['cats'] = 1;
   $oldset['cat_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ikon312a.php'>";
}

else if( $_GET['action'] == 'forums' )
{
   $result = $oldboard->db->query( "SELECT * FROM %pforum_info" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['FORUM_NAME'] = strip_ikon_tags( $row['FORUM_NAME'] );
      $row['FORUM_DESC'] = strip_ikon_tags( $row['FORUM_DESC'] );
      $qsf->db->query( "INSERT INTO %pforums
         (forum_parent, forum_name, forum_position, forum_description, forum_topics, forum_replies, forum_lastpost, ib)
         VALUES( %d, '%s', %d, '%s', %d, %d, %d, %d )",
         $row['CATEGORY'], $row['FORUM_NAME'], $row['FORUM_POSITION'], $row['FORUM_DESC'], $row['FORUM_TOPICS'], $row['FORUM_POSTS'], $row['FORUM_LAST_POST'], $row['FORUM_ID'] );
      $i++;
   }

   $oldset['forums'] = 1;
   $oldset['forum_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ikon312a.php'>";
}

else if( $_GET['action'] == 'topics' )
{
   $result = $qsf->db->query( "SELECT * FROM %pikon_ids" );
   while( $row = $qsf->db->nqfetch($result) )
   {
      $IDTABLE[] = array( 'name' => $row['old_name'], 'oldid' => $row['old_id'], 'newid' => $row['new_id']  );
   }

   $qsf->db->query( "TRUNCATE %ptopics" );
   $result = $oldboard->db->query( "SELECT * FROM %pforum_topics" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $result1 = $qsf->db->query( "SELECT forum_id FROM %pforums WHERE ib=%d", $row['FORUM_ID'] );
      list($tid) = mysql_fetch_row($result1);

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
         $name = $IDTABLE[$x]['name'];
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
      if( $row['POLL_STATE'] != '0' )
         $topic_modes = ($topic_modes | TOPIC_POLL);

      $row['TOPIC_TITLE'] = strip_ikon_tags( $row['TOPIC_TITLE'] );
      $row['TOPIC_DESC'] = strip_ikon_tags( $row['TOPIC_DESC'] );
      $qsf->db->query( "INSERT INTO %ptopics
         (topic_id, topic_forum, topic_title, topic_description, topic_starter, topic_last_poster, topic_posted, topic_edited, topic_replies, topic_views, topic_modes)
         VALUES( %d, %d, '%s', '%s', %d, %d, %d, %d, %d, %d, %d )",
         $row['TOPIC_ID'], $tid, $row['TOPIC_TITLE'], $row['TOPIC_DESC'], $row['TOPIC_STARTER'], $row['TOPIC_START_DATE'], $row['TOPIC_LAST_POSTER'], $row['TOPIC_LAST_DATE'], $row['TOPIC_POSTS'], $row['TOPIC_VIEWS'], $topic_modes );
      $i++;
   }

   $qsf->db->query( "TRUNCATE %psubscriptions" );
   $result = $oldboard->db->query( "SELECT * FROM %pforum_subscriptions" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $result1 = $qsf->db->query( "SELECT forum_id FROM %pforums WHERE ib=%d", $row['FORUM_ID'] );
      list($tid) = mysql_fetch_row($result1);

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
         $name = $IDTABLE[$x]['name'];
         $newid = $IDTABLE[$x]['newid'];

         if( $row['MEMBER_NAME'] == $name )
         {
            $row['MEMBER_ID'] = $newid;
         }
      }
      $qsf->db->query( "INSERT INTO %psubscriptions
         (subscription_id, subscription_user, subscription_type, subscription_item, subscription_expire)
         VALUES( %d, %d, '%s', %d, %d )", $row['ID'], $row['MEMBER_ID'], $subtype, $item, $expire );
   }

   $qsf->db->query( "ALTER TABLE %pforums DROP ib" );
   $oldset['topics'] = 1;
   $oldset['topic_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ikon312a.php'>";
}

else if( $_GET['action'] == 'polls' )
{
   $result = $qsf->db->query( "SELECT * FROM %pikon_ids" );
   while( $row = $qsf->db->nqfetch($result) )
   {
      $IDTABLE[] = array( 'name' => $row['old_name'], 'oldid' => $row['old_id'], 'newid' => $row['new_id']  );
   }

   $result = $oldboard->db->query( "SELECT * FROM %pforum_polls" );
   $i = 0;

   while( $row = $oldboard->db->nqfetch($result) )
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

      $qsf->db->query( "UPDATE %ptopics SET topic_poll_options='%s' WHERE topic_id=%d", $pollanswers, $row['POLL_ID'] );
      $i++;
   }

   $qsf->db->query( "TRUNCATE %pvotes" );
   $result = $oldboard->db->query( "SELECT * FROM %pforum_poll_voters" );

   while( $row = $oldboard->db->nqfetch($result) )
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
      $qsf->db->query( "INSERT INTO %pvotes (vote_user, vote_topic) VALUES( %d, %d )", $row['MEMBER_ID'], $row['POLL_ID'] );
   }

   $oldset['polls'] = 1;
   $oldset['poll_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ikon312a.php'>";
}

else if( $_GET['action'] == 'posts' )
{
   if( !isset($_GET['start']) || $_GET['start'] == '' )
   {
      $qsf->db->query( "TRUNCATE %pposts" );
      $start = 0;
   }
   else
      $start = $_GET['start'];

   if( !isset($_GET['i']) || $_GET['i'] == '' )
      $i = 0;
   else
      $i = $_GET['i'];

   $result = $qsf->db->query( "SELECT * FROM %pikon_ids" );
   while( $row = $qsf->db->nqfetch($result) )
   {
      $IDTABLE[] = array( 'name' => $row['old_name'], 'oldid' => $row['old_id'], 'newid' => $row['new_id']  );
   }

   $num = $oldboard->db->query( "SELECT * FROM %pforum_posts" );
   $all = $oldboard->db->num_rows( $num );
   $newstart = $start + $oldset['post_inc'];

   $result= $oldboard->db->query( "SELECT * FROM %pforum_posts LIMIT %d, %d", $start, $oldset['post_inc'] );

   while( $row = $oldboard->db->nqfetch($result) )
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

      /* Try and clean up some of the junk in Ikonboard posts. MySQL isn't happy about some of it. */
      $row['POST'] = strip_ikon_tags( $row['POST'] );

      $qsf->db->query( "INSERT INTO %pposts
         (post_id, post_topic, post_author, post_emoticons, post_text, post_time, post_ip)
         VALUES( %d, %d, %d, %d, '%s', %d, INET_ATON('%s') )",
         $row['POST_ID'], $row['TOPIC_ID'], $row['AUTHOR'], $row['ENABLE_EMO'], $row['POST'], $row['POST_DATE'], $row['IP_ADDR'] );
      $i++;
   }
   if( $i == $all )
   {
      $oldset['posts'] = 2;
      $oldset['post_count'] = $i;
      $oldset['converted'] = 2;
      write_olddb_sets( $oldset );
      echo "<meta http-equiv='Refresh' content='0;URL=convert_ikon312a.php'>";
   }
   else
   {
      $oldset['posts'] = 1;
      $oldset['post_count'] = $i;
      write_olddb_sets( $oldset );
      echo "<meta http-equiv='Refresh' content='0;URL=convert_ikon312a.php'>";
   }
}
?>
