<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2008 The QSF Portal Development Team
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
 * Invisionboard 1.31f Conversion Script
 * Based on work by Yazinin Nick <admin@vk.net.ru>
 *
 * Roger Libiez [Samson] http://www.iguanadons.net
 *
 * Script tested on an unmodified Invisionboard 1.31f database.
 * Use with any other version is not advised!
 **/

define('QUICKSILVERFORUMS', true);

require_once './convert_db.php';
require_once '../settings.php';
$set['include_path'] = '..';
require_once $set['include_path'] . '/defaultutils.php';
require_once $set['include_path'] . '/global.php';

define('CONVERTER_NAME', 'Invisionboard 1.31f');
define('CONVERTER_URL', 'convert_invision131f.php');
define('CONVERTER_DROPURL', 'convert_invision131f?action=dropinvision');
define('CONVERTOR_DROPCONFIRMURL', 'convert_invision131f?action=confirminvisiondrop');

$db = new $modules['database']( $set['db_host'], $set['db_user'], $set['db_pass'], $set['db_name'], $set['db_port'], $set['db_socket'], $set['prefix'] );
if( !$db->connection )
{
   error( QUICKSILVER_ERROR, 'A connection to the Quicksilver Forums database could not be established. Please check your settings and try again.', __FILE__, __LINE__ );
}
$qsf = new qsfglobal($db);

$olddb = new $modules['database']( $oldset['old_db_host'], $oldset['old_db_user'], $oldset['old_db_pass'], $oldset['old_db_name'], $oldset['old_db_port'], $oldset['old_db_socket'], $oldset['old_prefix'] );
if( !$olddb->connection )
{
   error( QUICKSILVER_ERROR, 'A connection to the Invisionboard database could not be established. Please check your settings and try again.', __FILE__, __LINE__ );
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
 * Remove all of the offending junky HTML Invisionboard encoded into message text.
 * Thanks to the good people who frequent php.net for posting examples of how to use regex.
 * It obviously helped alot, especially with Invisionboard's ugly non-validating HTML 4.01
 */
function strip_invision_tags( $text )
{
   // The [html] BBCode tag is not supported by Quicksilver Forums, so when the horrid mess is encountered in Invisionboard.....
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
   $text = preg_replace( "#<span style=[\'']color:(.+?)[\'']>(.+?)</span>#", "[color=\\1]\\2[/color]", $text );

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

   // Fix the text formatting tags....
   $text = preg_replace( "#<i>(.+?)</i>#is", "[i]\\1[/i]", $text );
   $text = preg_replace( "#<b>(.+?)</b>#is", "[b]\\1[/b]", $text );
   $text = preg_replace( "#<s>(.+?)</s>#is", "[s]\\1[/s]", $text );
   $text = preg_replace( "#<u>(.+?)</u>#is", "[u]\\1[/u]", $text );
   $text = str_replace( "<br>", "\n", $text );

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
      $oldset['censor'] = 0;
      $oldset['censor_count'] = 0;
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

   $censor = $oldset['censor'];
   $censor_count = $oldset['censor_count'];
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
     <td class='tablelight' align='left'><a href='convert_invision131f.php?action=censor'>Convert Censored Words</a>
     </td>";

   if( $censor_count > 0 )
      echo "<td class='tablelight' align='left'>".$censor_count." censored words converted.</td>\n";
   else
      echo "<td class='tablelight'>&nbsp;</td>\n";
   echo "</tr>\n";

   echo "<tr>
     <td class='tablelight' align='left'><a href='convert_invision131f.php?action=members'>Convert Member Profiles</a>
     </td>";

   if( $prof_count > 0 )
      echo "<td class='tablelight' align='left'>".$prof_count." member profiles converted.</td>\n";
   else
      echo "<td class='tablelight'>&nbsp;</td>\n";
   echo "</tr>\n";

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_invision131f.php?action=pmessages'>Convert Private Messages</a></td>\n";
      if( $pms == 1 )
         echo "<td class='tablelight' align='left'>".$pm_count." private messages converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_invision131f.php?action=mtitles'>Convert Member Titles</a></td>\n";
      if( $titles == 1 )
         echo "<td class='tablelight' align='left'>".$title_count." member titles converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_invision131f.php?action=forum'>Convert Forum Structure</a></td>\n";
      if( $cats == 1 )
         echo "<td class='tablelight' align='left'>".$cat_count." categories converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $cats == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight'>&nbsp;</td>\n";
      if( $forums == 1 )
         echo "<td class='tablelight' align='left'>".$forum_count." forums converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 && $forums == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight'>&nbsp;</td>\n";
      if( $topics == 1 )
         echo "<td class='tablelight' align='left'>".$topic_count." topics converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 && $topics == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight'>&nbsp;</td>\n";
      if( $polls == '1' )
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
         echo "<td class='tablelight' align='left'><a href='convert_invision131f.php?action=posts'>Convert Posts</a></td>\n";
         echo "<td class='tablelight'>&nbsp;</td>\n";
      }
      else if( $posts == 1 )
      {
         echo "<td class='tablelight' align='left'><a href='convert_invision131f.php?action=posts&start=".$post_count."&i=".$post_count."'>Continue post conversion</a></td>\n";
         echo "<td class='tablelight' align='left'>".$post_count." posts converted so far.</td>\n";
      }
      else
      {
         echo "<td class='tablelight' align='left'><a href='convert_invision131f.php?action=posts'>Convert Posts</a></td>\n";
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

else if( $_GET['action'] == 'dropinvision' )
{
    include 'templates/convert_header.php';
    include 'templates/convert_destroydata.php';
    include 'templates/convert_footer.php';
}

else if( $_GET['action'] == 'confirminvisiondrop' )
{
   $oldboard->db->query( "DROP TABLE IF EXISTS %padmin_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %padmin_sessions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pattachments" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pbadwords" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcache_store" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcalendar_events" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcategories" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcontacts" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcss" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pemail_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pemoticons" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pfaq" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_perms" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_tracker" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforums" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pgroups" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pimages" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %planguages" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmacro" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmacro_name" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmember_extra" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmembers" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmessages" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmoderator_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmoderators" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ppfields_content" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ppfields_data" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ppolls" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pposts" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %preg_antispam" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %prules" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psearch_results" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psessions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pskin_templates" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pskins" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pspider_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pstats" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psubscription_currency" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psubscription_extra" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psubscription_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psubscription_methods" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psubscription_trans" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psubscriptions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptemplates" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptitles" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptmpl_names" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptopic_mmod" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptopics" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptracker" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pvalidating" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pvoters" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pwarn_logs" );

   include 'templates/convert_header.php';
   include 'templates/convert_datadestroyed.php';
   include 'templates/convert_footer.php';
}

else if( $_GET['action'] == 'censor' )
{
   $result = $oldboard->db->query( "SELECT * FROM %pbadwords" );
   $i = '0';

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $qsf->db->query( "INSERT INTO %preplacements (replacement_search, replacement_type) VALUES( '%s', 'censor' )", $row['type'] );
      $i++;
   }

   $oldset['censor'] = 1;
   $oldset['censor_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_invision131f.php'>";
}

else if( $_GET['action'] == 'members' )
{
   $qsf->db->query( "TRUNCATE %pusers" );
   $qsf->db->query( "INSERT INTO %pusers (user_id, user_name, user_group) VALUES (1, 'Guest', 3)" );

   $i = 0;
   $result = $oldboard->db->query( "SELECT * FROM %pmembers" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      if( $row['id'] == 0 )
         ;
      else
      {
         $row['id']++;

         if( $row['hide_email'] == '' || $row['hide_email'] == 1 )
            $showmail = 0;
         else
            $showmail = 1;

         $row['name'] = strip_invision_tags( $row['name'] );
         $row['email'] = strip_invision_tags( $row['email'] );
         $row['website'] = strip_invision_tags( $row['website'] );
         $row['location'] = strip_invision_tags( $row['location'] );
         $row['interests'] = strip_invision_tags( $row['interests'] );
         $row['signature'] = strip_invision_tags( $row['signature'] );

         if( $row['last_visit'] == '' )
            $row['last_visit'] = $row['joined'];
         if( $row['last_activity'] == '' )
            $row['last_activity'] = $row['joined'];

         /* The default Invisionboard groups they claim you can never alter.
          * Additional groups will not be converted. Members in these groups will become standard members.
          */
         if( $row['mgroup'] == 1 )
            $row['mgroup'] = 5;
         else if( $row['mgroup'] == 2 )
            $row['mgroup'] = 3;
         else if( $row['mgroup'] == 3 )
            $row['mgroup'] = 2;
         else if( $row['mgroup'] == 4 )
            $row['mgroup'] = 1;
         else if( $row['mgroup'] == 5 )
            $row['mgroup'] = 4;
         else
            $row['mgroup'] = 2;

         $pos = strpos( $row['avatar'], '://' );
         if( $pos == 4 )
         {
            $avatar = $row['avatar'];
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
         if( $row['bday_year'] != '' && $row['bday_month'] != '' && $row['bday_day'] != '' )
            $bday = sprintf( "%04d-%02d-%02d", $row['bday_year'], $row['bday_month'], $row['bday_day'] );
         else
            $bday = "0000-00-00";

         $icq = 0;
         if( $row['icq_number'] )
            $icq = intval( $row['icq_number'] );

         $qsf->db->query( "INSERT INTO %pusers
            (user_id, user_name, user_password, user_joined, user_title, user_group, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height, user_email, user_email_show, user_birthday, user_homepage, user_posts, user_location, user_icq, user_msn, user_aim, user_yahoo, user_interests, user_signature, user_lastvisit, user_lastpost, user_pm_mail, user_view_signatures, user_view_avatars, user_regip)
            VALUES( %d, '%s', '%s', %d, '%s', %d, '%s', '%s', %d, %d, '%s', %d, '%s', '%s', %d, '%s', %d, '%s', '%s', '%s', '%s', '%s', %d, %d, %d, %d, %d, INET_ATON('%s') )",
            $row['id'], $row['name'], $row['password'], $row['joined'], $row['title'], $row['mgroup'], $avatar, $type, $width, $height, $row['email'], $showmail, $bday, $row['website'], $row['posts'], $row['location'], $icq, $row['msnname'], $row['aim_name'], $row['yahoo'], $row['interests'], $row['signature'], $row['last_visit'], $row['last_activity'], $row['email_pm'], $row['view_sigs'], $row['view_avs'], $row['ip_address'] );
         $i++;
      }
   }

   $oldset['profiles'] = 1;
   $oldset['prof_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_invision131f.php'>";
}

else if( $_GET['action'] == 'pmessages' )
{
   $i = 0;
   $qsf->db->query( "TRUNCATE %ppmsystem" );
   $result = $oldboard->db->query( "SELECT * FROM %pmessages" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      if( $row['vid'] == "in" || $row['vid'] == "sent" )
      {
         // Empty and N/A recipient IDs are no good!
         if( $row['recipient_id'] != '' && $row['recipient_id'] != 'N/A' )
         {
            $row['recipient_id']++;
            $row['from_id']++;

            $row['title'] = strip_invision_tags( $row['title'] );
            $row['message'] = strip_invision_tags( $row['message'] );

            $i++;

            if( $row['vid'] == "in" )
               $folder = 0;
            else
               $folder = 1;

            $bcc = '';
            if( $folder == 1 )
            {
               $bcc = $row['recipient_id'];
               $row['recipient_id'] = $row['from_id'];
            }

            if( $row['title'] == '' )
               $row['title'] = "No Title";

            $qsf->db->query( "INSERT INTO %ppmsystem
               (pm_id, pm_to, pm_from, pm_bcc, pm_title, pm_time, pm_message, pm_read, pm_folder)
               VALUES( %d, %d, %d, '%s', '%s', %d, '%s', %d, %d )",
               $row['msg_id'], $row['recipient_id'], $row['from_id'], $bcc, $row['title'], $row['msg_date'], $row['message'], $row['read_state'], $folder );
         }
      }
   }
   $oldset['pms'] = 1;
   $oldset['pm_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_invision131f.php'>";
}

else if( $_GET['action'] == 'mtitles' )
{
   $num = $oldboard->db->query( "SELECT * FROM %ptitles" );
   $all = $oldboard->db->num_rows( $num );
   $i = 0;

   if( $all > 0 )
   {
      $qsf->db->query( "TRUNCATE %pmembertitles" );

      $result = $oldboard->db->query( "SELECT * FROM %ptitles" );
      while( $row = $oldboard->db->nqfetch($result) )
      {
         if( $row['pips'] > 5 )
            $icon = '5.png';
         else if( $row['pips'] < 1 )
            $icon = '1.png';
         else
         {
            $icon = $row['pips'];
            $icon .= '.png';
         }
         $qsf->db->query( "INSERT INTO %pmembertitles
            (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon)
            VALUES( %d, '%s', %d, '%s' )",
            $row['id'], $row['title'], $row['posts'], $icon );
         $i++;
      }
   }

   $oldset['titles'] = 1;
   $oldset['title_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_invision131f.php'>";
}

else if( $_GET['action'] == 'forum' )
{
   $qsf->db->query( "TRUNCATE %pforums" );

   $result = $oldboard->db->query( "SELECT * FROM %pcategories" );
   $i = 0;
   $fid = 1;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      if( $row['name'] != '-' )
      {
         $forum_table[] = array( 'new_id' => $fid++, 'cat' => $row['id'], 'parent' => -2, 'name' => $row['name'], 'position' => $row['position'], 'description' => $row['description'], 'topics' => 0, 'replies' => 0, 'lastpost' => 0, 'old_id' => $row['id'], 'old_subcat' => 0 );
         $i++;
      }
   }

   $oldset['cats'] = 1;
   $oldset['cat_count'] = $i;
   write_olddb_sets( $oldset );

   $result = $oldboard->db->query( "SELECT * FROM %pforums" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      if( $row['last_post'] == '' )
         $row['last_post'] = 0;
      if( $row['sub_can_post'] == 0 )
         $subcat = 1;
      else
         $subcat = 0;
      $forum_table[] = array( 'new_id' => $fid++, 'cat' => $row['category'], 'parent' => $row['parent_id'], 'name' => $row['name'], 'position' => $row['position'], 'description' => $row['description'], 'topics' => $row['topics'], 'replies' => $row['posts'], 'lastpost' => $row['last_post'], 'old_id' => $row['id'], 'old_subcat' => $subcat );
   }

   for( $x = 0; $x < sizeof( $forum_table ); $x++ )
   {
      $cat = $forum_table[$x]['cat'];
      $parent = $forum_table[$x]['parent'];
      $name = $forum_table[$x]['name'];
      $name = strip_invision_tags( $name );
      $position = $forum_table[$x]['position'];
      $description = $forum_table[$x]['description'];
      $description = strip_invision_tags( $description );
      $topics = $forum_table[$x]['topics'];
      $replies = $forum_table[$x]['replies'];
      $last_post = $forum_table[$x]['lastpost'];
      $id = $forum_table[$x]['old_id'];
      $subcat = $forum_table[$x]['old_subcat'];

      if( $parent == -2 )
         $parent = 0;
      else if( $parent == -1 )
      {
         for( $y = 0; $y < sizeof( $forum_table ); $y++ )
         {
            if( $forum_table[$y]['old_id'] == $cat && $forum_table[$y]['parent'] == -2 )
            {
               $parent = $forum_table[$y]['new_id'];
               break;
            }
         }
      }
      else
      {
         for( $y = 0; $y < sizeof( $forum_table ); $y++ )
         {
            if( $forum_table[$y]['old_id'] == $parent && $forum_table[$y]['parent'] == -1 )
            {
               $parent = $forum_table[$y]['new_id'];
               break;
            }
         }
      }

      $qsf->db->query( "INSERT INTO %pforums
         (forum_parent, forum_name, forum_position, forum_description, forum_topics, forum_replies, forum_lastpost, forum_subcat)
         VALUES( %d, '%s', %d, '%s', %d, %d, %d, %d )",
         $parent, $name, $position, $description, $topics, $replies, $last_post, $subcat );
      $i++;
   }

   $oldset['forums'] = 1;
   $oldset['forum_count'] = $i;
   write_olddb_sets( $oldset );

   $qsf->db->query( "TRUNCATE %ptopics" );
   $result = $oldboard->db->query( "SELECT * FROM %ptopics" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['starter_id']++;
      $row['last_poster_id']++;

      $topic_modes = TOPIC_PUBLISH;
      if( $row['state'] == 'closed' )
         $topic_modes = ($topic_modes | TOPIC_LOCKED);
      if( $row['pinned'] == 1 )
         $topic_modes = ($topic_modes | TOPIC_PINNED);
      if( $row['poll_state'] != 0 )
         $topic_modes = ($topic_modes | TOPIC_POLL);

      $row['title'] = strip_invision_tags( $row['title'] );
      $row['description'] = strip_invision_tags( $row['description'] );

      $fid = 0;
      for( $x = 0; $x < sizeof( $forum_table ); $x++ )
      {
         if( $row['forum_id'] == $forum_table[$x]['old_id'] && $forum_table[$x]['parent'] > -2 )
         {
            $fid = $forum_table[$x]['new_id'];
            break;
         }
      }
      $qsf->db->query( "INSERT INTO %ptopics
         (topic_id, topic_forum, topic_title, topic_description, topic_starter, topic_last_poster, topic_last_post, topic_posted, topic_replies, topic_views, topic_modes)
         VALUES( %d, %d, '%s', '%s', %d, %d, %d, %d, %d, %d, %d )",
         $row['tid'], $fid, $row['title'], $row['description'], $row['starter_id'], $row['last_poster_id'], $row['last_post'], $row['start_date'], $row['posts'], $row['views'], $topic_modes );
      $i++;
   }

   $oldset['topics'] = 1;
   $oldset['topic_count'] = $i;
   write_olddb_sets( $oldset );

   $qsf->db->query( "TRUNCATE %psubscriptions" );
   $result = $qsf->db->query( "SELECT * FROM %pforum_tracker" );
   $frows = 0;
   while( $row = $qsf->db->nqfetch($result) )
   {
      $row['member_id']++;

      $fid = 0;
      for( $x = 0; $x < sizeof( $forum_table ); $x++ )
      {
         if( $row['forum_id'] == $forum_table[$x]['old_id'] )
         {
            $fid = $forum_table[$x]['new_id'];
            break;
         }
      }
      $expire = time() + 2592000;
      $qsf->db->query( "INSERT INTO %psubscriptions
         (subscription_id, subscription_user, subscription_type, subscription_item, subscription_expire)
         VALUES( %d, %d, 'forum', %d, %d )", $row['frid'], $row['member_id'], $fid, $expire );
      if( $row['frid'] > $frows )
         $frows = $row['frid'];
   }

   $result = $oldboard->db->query( "SELECT * FROM %ptracker" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['member_id']++;

      $lineid = $row['trid'] + $frows;
      $expire = time() + 2592000;
      $qsf->db->query( "INSERT INTO %psubscriptions
         (subscription_id, subscription_user, subscription_type, subscription_item, subscription_expire)
         VALUES( %d, %d, 'topic', %d, %d )", $lineid, $row['member_id'], $row['topic_id'], $expire );
   }

   $result = $oldboard->db->query( "SELECT * FROM %ppolls" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $qsf->db->query( "UPDATE %ptopics SET topic_poll_options='%s' WHERE topic_id=%d", $row['choices'], $row['tid'] );
      $i++;
   }

   $qsf->db->query( "TRUNCATE %pvotes" );
   $result = $oldboard->db->query( "SELECT * FROM %pvoters" );

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['member_id']++;
      $qsf->db->query( "INSERT INTO %pvotes (vote_user, vote_topic) VALUES( %d, %d )", $row['member_id'], $row['tid'] );
   }

   $oldset['polls'] = 1;
   $oldset['poll_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_invision131f.php'>";
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

   $result = $oldboard->db->query( "SELECT * FROM  %pposts LIMIT %d, %d", $start, $oldset['post_inc'] );

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['author_id']++;

      /* Try and clean up some of the junk in Invisionboard posts. MySQL isn't happy about some of it. */
      $row['post'] = strip_invision_tags( $row['post'] );

      $qsf->db->query( "INSERT INTO %pposts
         (post_id, post_topic, post_author, post_emoticons, post_text, post_time, post_ip, post_edited_by, post_edited_time)
         VALUES( %d, %d, %d, %d, '%s', %d, INET_ATON('%s'), '%s', %d )",
         $row['pid'], $row['topic_id'], $row['author_id'], $row['use_emo'], $row['post'], $row['post_date'], $row['ip_address'], $row['edit_name'], $row['edit_time'] );
      $i++;
   }
   if( $i == $all )
   {
      $oldset['posts'] = 2;
      $oldset['post_count'] = $i;
      $oldset['converted'] = 2;
      write_olddb_sets( $oldset );
      echo "<meta http-equiv='Refresh' content='0;URL=convert_invision131f.php'>";
   }
   else
   {
      $oldset['posts'] = 1;
      $oldset['post_count'] = $i;
      write_olddb_sets( $oldset );
      echo "<meta http-equiv='Refresh' content='0;URL=convert_invision131f.php'>";
   }
}
?>
