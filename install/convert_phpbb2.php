<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2007 The QSF Portal Development Team
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
 * phpBB2 Conversion Script
 * Based on work by Yazinin Nick <admin@vk.net.ru>
 *
 * Roger Libiez [Samson] http://www.iguanadons.net
 *
 * This convertor has been tested on unmodified databases for versions 2.0.4 and 2.0.14 without errors.
 * It should be reasonably safe to use on any phpBB2 2.0.x version.
 **/

define('QUICKSILVERFORUMS', true);

require_once './convert_db.php';
require_once '../settings.php';
$set['include_path'] = '..';
require_once $set['include_path'] . '/defaultutils.php';
require_once $set['include_path'] . '/global.php';

// Check for any addons available
include_addons($set['include_path'] . '/addons/');

define('CONVERTER_NAME', 'phpBB2 2.x');
define('CONVERTER_URL', 'convert_phpbb2.php');
define('CONVERTER_DROPURL', 'convert_phpbb2.php?action=dropphpbb');
define('CONVERTOR_DROPCONFIRMURL', 'convert_phpbb2.php?action=confirmphpbbdrop');

$db = new $modules['database']( $set['db_host'], $set['db_user'], $set['db_pass'], $set['db_name'], $set['db_port'], $set['db_socket'], $set['prefix'] );
if( !$db->connection )
{
   error( QUICKSILVER_ERROR, 'A connection to the Quicksilver Forums database could not be established. Please check your settings and try again.', __FILE__, __LINE__ );
}
$qsf = new qsfglobal($db);

$olddb = new $modules['database']( $oldset['old_db_host'], $oldset['old_db_user'], $oldset['old_db_pass'], $oldset['old_db_name'], $oldset['old_db_port'], $oldset['old_db_socket'], $oldset['old_prefix'] );
if( !$olddb->connection )
{
   error( QUICKSILVER_ERROR, 'A connection to the phpBB2 database could not be established. Please check your settings and try again.', __FILE__, __LINE__ );
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
      'censor'        => $oldset['censor'],
      'censor_count'  => $oldset['censor_count'],
      'profiles'      => $oldset['profiles'],
      'prof_count'    => $oldset['prof_count'],
      'pms'           => $oldset['pms'],
      'pm_count'      => $oldset['pm_count'],
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

function get_ip( $ip )
{
   $octet = explode( '.', chunk_split( $ip, 2, '.' ) );
   return hexdec( $octet[0] ) . '.' . hexdec( $octet[1] ) . '.' . hexdec( $octet[2] ) . '.' . hexdec( $octet[3] );
}

/*
 * This really should not have been necessary for phpBB2 but they stuck a bunch of weird
 * UID tags onto everything in their post text, so naturally we must get rid of it all.
 */
function strip_phpbb2_tags( $text )
{
   global $qsf;

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

if( !isset($_GET['action']) || $_GET['action'] == '' )
{
   if( $oldset['converted'] == 0 )
   {
      $oldset['converted'] = 1;
      $oldset['censor'] = 0;
      $oldset['censor_count'] = 0;
      $oldset['profiles'] = 0;
      $oldset['prof_count'] = 0;
      $oldset['pms'] = 0;
      $oldset['pm_count'] = 0;
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

   $censor = $oldset['censor'];
   $censor_count = $oldset['censor_count'];
   $prof = $oldset['profiles'];
   $prof_count = $oldset['prof_count'];
   $pms = $oldset['pms'];
   $pm_count = $oldset['pm_count'];
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
     <td class='tablelight' align='left'><a href='convert_phpbb2.php?action=censor'>Convert Censored Words</a>
     </td>";

   if( $censor_count > 0 )
      echo "<td class='tablelight' align='left'>".$censor_count." censored words converted.</td>\n";
   else
      echo "<td class='tablelight'>&nbsp;</td>\n";
   echo "</tr>\n";

   echo "<tr>
     <td class='tablelight' align='left'><a href='convert_phpbb2.php?action=members'>Convert Member Profiles</a>
     </td>";

   if( $prof_count > 0 )
      echo "<td class='tablelight' align='left'>".$prof_count." member profiles converted.</td>\n";
   else
      echo "<td class='tablelight'>&nbsp;</td>\n";
   echo "</tr>\n";

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_phpbb2.php?action=pmessages'>Convert Private Messages</a></td>\n";
      if( $pms == 1 )
         echo "<td class='tablelight' align='left'>".$pm_count." private messages converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_phpbb2.php?action=categories'>Convert Categories</a></td>\n";
      if( $cats == 1 )
         echo "<td class='tablelight' align='left'>".$cat_count." categories converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $cats == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_phpbb2.php?action=forums'>Convert Forums</a></td>\n";
      if( $forums == 1 )
         echo "<td class='tablelight' align='left'>".$forum_count." forums converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 && $forums == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_phpbb2.php?action=topics'>Convert Topics</a></td>\n";
      if( $topics == 1 )
         echo "<td class='tablelight' align='left'>".$topic_count." topics converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 && $topics == 1 )
   {
      echo "<tr>\n";
      if( $posts == 0 )
      {
         echo "<td class='tablelight' align='left'><a href='convert_phpbb2.php?action=posts'>Convert Posts</a></td>\n";
         echo "<td class='tablelight'>&nbsp;</td>\n";
      }
      else if( $posts == 1 )
      {
         echo "<td class='tablelight' align='left'><a href='convert_phpbb2.php?action=posts&amp;start=".$post_count."&amp;i=".$post_count."'>Continue post conversion</a></td>\n";
         echo "<td class='tablelight' align='left'>".$post_count." posts converted so far.</td>\n";
      }
      else
      {
         echo "<td class='tablelight' align='left'><a href='convert_phpbb2.php?action=posts'>Convert Posts</a></td>\n";
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
      $qsf->sets = $qsf->get_settings($qsf->sets);
      $qsf->updateForumTrees();
      $qsf->RecountForums();

      include 'templates/convert_finished.php';
   }
   include 'templates/convert_footer.php';
}

else if( $_GET['action'] == 'dropphpbb' )
{
    include 'templates/convert_header.php';
    include 'templates/convert_destroydata.php';
    include 'templates/convert_footer.php';
}

else if( $_GET['action'] == 'confirmphpbbdrop' )
{
   $oldboard->db->query( "DROP TABLE IF EXISTS %pauth_access" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pbanlist" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcategories" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pconfig" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pconfirm" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pdisallow" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_prune" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforums" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pgroups" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pposts" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pposts_text" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pprivmsgs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pprivmsgs_text" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pranks" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psearch_results" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psearch_wordlist" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psearch_wordmatch" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psessions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psessions_keys" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psmilies" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pthemes" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pthemes_name" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptopics" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptopics_watch" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %puser_group" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pusers" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pvote_desc" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pvote_results" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pvote_voters" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pwords" );

   include 'templates/convert_header.php';
   include 'templates/convert_datadestroyed.php';
   include 'templates/convert_footer.php';
}

else if( $_GET['action'] == 'censor' )
{
   $result = $oldboard->db->query( "SELECT * FROM %pwords" );
   $i = 0;

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $qsf->db->query( "INSERT INTO %preplacements (replacement_search, replacement_type) VALUES( '%s', 'censor' )", $row['word'] );
      $i++;
   }

   $oldset['censor'] = 1;
   $oldset['censor_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_phpbb2.php'>";
}

else if( $_GET['action'] == 'members' )
{
   $qsf->db->query( "TRUNCATE %pusers" );
   $qsf->db->query( "INSERT INTO %pusers (user_id, user_name, user_group) VALUES (1, 'Guest', 3)" );

   $i = 0;
   $result = $oldboard->db->query( "SELECT * FROM %pusers" );
   while( $row = $oldboard->db->nqfetch($result) )
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

         $row['username'] = strip_phpbb2_tags( $row['username'] );
         $row['user_email'] = strip_phpbb2_tags( $row['user_email'] );
         $row['user_website'] = strip_phpbb2_tags( $row['user_website'] );
         $row['user_from'] = strip_phpbb2_tags( $row['user_from'] );
         $row['user_interests'] = strip_phpbb2_tags( $row['user_interests'] );
         $row['user_sig'] = strip_phpbb2_tags( $row['user_sig'] );

         // The default phpBB2 groups: You're either an admin or you're not.
         if( $row['user_level'] == 1 )
            $row['user_level'] = 1;
         else
            $row['user_level'] = 2;

         $sql2 = "SELECT * FROM %pbanlist WHERE ban_userid = '{$row['user_id']}'";
         $result2 = $oldboard->db->query($sql2);
         while( $row2 = $oldboard->db->nqfetch($result2) )
         {
            $row['user_level'] = 4;
         }

         $pos = strpos( $row['user_avatar'], '://' );
         if( $pos == 4 )
         {
            $avatar = $row['user_avatar'];
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
         if( $row['user_icq'] )
            $icq = intval( $row['user_icq'] );

         $qsf->db->query( "INSERT INTO %pusers
            (user_id, user_name, user_password, user_joined, user_group, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height, user_email, user_email_show, user_homepage, user_posts, user_location, user_icq, user_msn, user_aim, user_yahoo, user_interests, user_signature, user_lastvisit, user_lastpost, user_view_emoticons, user_view_avatars, user_pm_mail, user_active)
            VALUES( %d, '%s', '%s', %d, %d, '%s', '%s', %d, %d, '%s', %d, '%s', %d, '%s', %d, '%s', '%s', '%s', '%s', '%s', %d, %d, %d, %d, %d, %d )",
            $row['user_id'], $row['username'], $row['user_password'], $row['user_regdate'], $row['user_level'], $avatar, $type, $width, $height, $row['user_email'], $showmail, $row['user_website'], $row['user_posts'], $row['user_from'], $icq, $row['user_msnm'], $row['user_aim'], $row['user_yim'], $row['user_interests'], $row['user_sig'], $row['user_lastvisit'], $row['user_session_time'], $row['user_allowsmile'], $row['user_allowavatar'], $row['user_notify_pm'], $row['user_allow_viewonline'] );
         $i++;
      }
   }

   $oldset['profiles'] = 1;
   $oldset['prof_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_phpbb2.php'>";
}

else if( $_GET['action'] == 'pmessages' )
{
   $i = 0;
   $qsf->db->query( "TRUNCATE %ppmsystem" );

   $result = $oldboard->db->query( "SELECT p.*, t.privmsgs_text_id, t.privmsgs_text
      FROM %pprivmsgs p
      LEFT JOIN %pprivmsgs_text t ON t.privmsgs_text_id = p.privmsgs_id" );
   while( $row = $oldboard->db->nqfetch($result) )
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

         $row['privmsgs_subject'] = strip_phpbb2_tags( $row['privmsgs_subject'] );
         $message = strip_phpbb2_tags( $row['privmsgs_text'] );

         $i++;

         $bcc = '';
         if( $folder == 1 )
         {
            $bcc = $row['privmsgs_to_userid'];
            $row['privmsgs_to_userid'] = $row['privmsgs_from_userid'];
         }
         if( $row['privmsgs_subject'] == '' )
            $row['privmsgs_subject'] = "No Title";
         $ip = get_ip( $row['privmsgs_ip'] );
         $qsf->db->query( "INSERT INTO %ppmsystem
            (pm_id, pm_to, pm_from, pm_ip, pm_bcc, pm_title, pm_time, pm_message, pm_read, pm_folder)
            VALUES( %d, %d, %d, INET_ATON('%s'), '%s', '%s', %d, '%s', %d, %d )",
            $row['privmsgs_id'], $row['privmsgs_to_userid'], $row['privmsgs_from_userid'], $ip, $bcc, $row['privmsgs_subject'], $row['privmsgs_date'], $message, $readstate, $folder );
      }
   }

   $oldset['pms'] = 1;
   $oldset['pm_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_phpbb2.php'>";
}

else if( $_GET['action'] == 'categories' )
{
   $qsf->db->query( "ALTER TABLE %pforums ADD phpbb INT(4) NOT NULL" );
   $qsf->db->query( "TRUNCATE %pforums" );

   $result = $oldboard->db->query( "SELECT * FROM %pcategories" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $position = $row['cat_order'] / 10;
      $qsf->db->query( "INSERT INTO %pforums (forum_id, forum_name, forum_position) VALUES( %d, '%s', %d )",
         $row['cat_id'], $row['cat_title'], $position );
      $i++;
   }

   $oldset['cats'] = 1;
   $oldset['cat_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_phpbb2.php'>";
}

else if( $_GET['action'] == 'forums' )
{
   $result = $oldboard->db->query( "SELECT * FROM %pforums" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['forum_name'] = strip_phpbb2_tags( $row['forum_name'] );
      $row['forum_desc'] = strip_phpbb2_tags( $row['forum_desc'] );
      $position = $row['forum_order'] / 10;
      $num = time();
      $qsf->db->query( "INSERT INTO %pforums
         (forum_parent, forum_name, forum_position, forum_description, forum_topics, forum_replies, forum_lastpost, phpbb)
         VALUES( %d, '%s', %d, '%s', %d, %d, %d, %d )",
         $row['cat_id'], $row['forum_name'], $position, $row['forum_desc'], $row['forum_topics'], $row['forum_posts'], $num, $row['forum_id'] );
      $i++;
   }

   $oldset['forums'] = 1;
   $oldset['forum_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_phpbb2.php'>";
}

else if( $_GET['action'] == 'topics' )
{
   $qsf->db->query( "TRUNCATE %ptopics" );
   $result = $oldboard->db->query( "SELECT * FROM %ptopics" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $result1 = $qsf->db->query( "SELECT forum_id FROM %pforums WHERE phpbb=%d", $row['forum_id'] );
      list($tid) = mysql_fetch_row($result1);

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

      $row['topic_title'] = strip_phpbb2_tags( $row['topic_title'] );
      $qsf->db->query( "INSERT INTO %ptopics
         (topic_id, topic_forum, topic_title, topic_starter, topic_last_post, topic_last_poster, topic_edited, topic_posted, topic_replies, topic_views, topic_modes)
         VALUES( %d, %d, '%s', %d, %d, %d, %d, %d, %d, %d, %d )",
         $row['topic_id'], $tid, $row['topic_title'], $row['topic_poster'], $row['topic_last_post_id'], $row['topic_poster'], $row['topic_time'], $row['topic_time'], $row['topic_replies'], $row['topic_views'], $topic_modes );
      $i++;
   }

   $qsf->db->query( "TRUNCATE %psubscriptions" );
   $result = $oldboard->db->query( "SELECT * FROM %ptopics_watch" );
   $expire = time() + 2592000;
   $sub_id = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $sub_id++;
      $qsf->db->query( "INSERT INTO %psubscriptions
         (subscription_id, subscription_user, subscription_type, subscription_item, subscription_expire)
         VALUES( %d, %d, 'topic', %d, %d )",
         $sub_id, $row['user_id'], $row['topic_id'], $expire );
   }
   $qsf->db->query( "ALTER TABLE %pforums DROP phpbb" );
   $oldset['topics'] = 1;
   $oldset['topic_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_phpbb2.php'>";
}

else if( $_GET['action'] == 'polls' )
{
   $result = $oldboard->db->query( "SELECT * FROM %pvote_results" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $resulttable[] = array( 'id' >= $row['vote_id'], 'option_id' => $row['vote_option_id'], 'option_text' => $row['vote_option_text'], 'option_result' => $row['vote_result'] );
   }

   $result = $oldboard->db->query( "SELECT * FROM %pvote_vote_desc" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $pdesctable[] = array( 'id' >= $row['topic_id'], 'text' => $row['vote_text'] );
   }

   $qsf->db->query( "UPDATE %ptopics SET topic_poll_options='%s' WHERE topic_id=%d", $row['POLL_ANSWERS'], $row['POLL_ID'] );
   $i++;

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
      $qsf->db->query( "INSERT INTO %pvotes (vote_user, vote_topic) VALUES( %d, %d )", $row['MEMBER_ID'], $row['POLL_ID'] );
   }

   $oldset['polls'] = 1;
   $oldset['poll_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_phpbb2.php'>";
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

   $num = $oldboard->db->query( "SELECT * FROM %pposts" );
   $all = $oldboard->db->num_rows( $num );

   $newstart = $start + $oldset['post_inc'];

   $result= $oldboard->db->query( "SELECT p.*, t.post_id, t.post_text
      FROM %pposts p LEFT JOIN %pposts_text t ON t.post_id=p.post_id LIMIT %d, %d", $start, $oldset['post_inc'] );

   while( $row = $oldboard->db->nqfetch($result) )
   {
      if( $row['poster_id'] == 1 )
      {
         $row['poster_id'] = 2;
      }
      if( $row['poster_id'] == 0 )
      {
         $row['poster_id'] = 1;
      }

      $message = strip_phpbb2_tags( $row['post_text'] );

      $ip = get_ip( $row['poster_ip'] );
      $qsf->db->query( "INSERT INTO %pposts 
          (post_id, post_topic, post_author, post_emoticons, post_mbcode, post_text, post_time, post_ip)
          VALUES( %d, %d, %d, %d, %d, '%s', %d, INET_ATON('%s') )",
          $row['post_id'], $row['topic_id'], $row['poster_id'], $row['enable_smilies'], $row['enable_bbcode'], $message, $row['post_time'], $ip );
      $i++;
   }
   if( $i == $all )
   {
      $oldset['posts'] = 2;
      $oldset['post_count'] = $i;
      $oldset['converted'] = 2;
      write_olddb_sets( $oldset );
      echo "<meta http-equiv='Refresh' content='0;URL=convert_phpbb2.php'>";
   }
   else
   {
      $oldset['posts'] = 1;
      $oldset['post_count'] = $i;
      write_olddb_sets( $oldset );
      echo "<meta http-equiv='Refresh' content='0;URL=convert_phpbb2.php'>";
   }
}
?>
