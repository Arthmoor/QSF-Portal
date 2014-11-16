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
 * vBulliten Conversion Script
 * Based on work by Yazinin Nick <admin@vk.net.ru>
 *
 * Roger Libiez [Samson] http://www.iguanadons.net
 *
 * This convertor has only had limited testing on a vBulliten 3.5.1 live demo database
 **/

define('QUICKSILVERFORUMS', true);

require_once './convert_db.php';
require_once '../settings.php';
$set['include_path'] = '..';
require_once $set['include_path'] . '/defaultutils.php';
require_once $set['include_path'] . '/global.php';

// Check for any addons available
include_addons($set['include_path'] . '/addons/');

define('CONVERTER_NAME', 'vBulliten 3.5 Converter');
define('CONVERTER_URL', 'convert_vb351.php');
define('CONVERTER_DROPURL', 'convert_vb351.php?action=dropvb');
define('CONVERTOR_DROPCONFIRMURL', 'convert_vb351.php?action=confirmvbdrop');

$db = new $modules['database']( $set['db_host'], $set['db_user'], $set['db_pass'], $set['db_name'], $set['db_port'], $set['db_socket'], $set['prefix'] );
if( !$db->connection )
{
   error( QUICKSILVER_ERROR, 'A connection to the Quicksilver Forums database could not be established. Please check your settings and try again.', __FILE__, __LINE__ );
}
$qsf = new qsfglobal($db);

$olddb = new $modules['database']( $oldset['old_db_host'], $oldset['old_db_user'], $oldset['old_db_pass'], $oldset['old_db_name'], $oldset['old_db_port'], $oldset['old_db_socket'], $oldset['old_prefix'] );
if( !$olddb->connection )
{
   error( QUICKSILVER_ERROR, 'A connection to the vBulliten database could not be established. Please check your settings and try again.', __FILE__, __LINE__ );
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

/* Not as much as usual to do here thanks to the nice clean database storage */
function strip_vb_tags( $text )
{
   // The [html] BBCode tag is not supported by Quicksilver Forums, so just strip those off and leave the contents.
   $text = preg_replace( '/\[html\](.+?)\[\/html\]/si', '\\1', $text );

   /* Convert malformed image tags. */
   $text = preg_replace( '/\[img=(.*?)\](.*?)\[\/img\]/si', '[img]\\1[/img]', $text );

   // Text alignment tags...
   $text = str_replace( "[LEFT]", "[left]", $text );
   $text = str_replace( "[CENTER]", "[center]", $text );
   $text = str_replace( "[RIGHT]", "[right]", $text );
   $text = str_replace( "[/LEFT]", "[/left]", $text );
   $text = str_replace( "[/CENTER]", "[/center]", $text );
   $text = str_replace( "[/RIGHT]", "[/right]", $text );

   // List tags are not supported in QSF.
   $text = preg_replace( '/\[list=(.*?)\](.*?)\[\/list\]/si', '\\2', $text );
   $text = str_replace( "[LIST]", "", $text );
   $text = str_replace( "[/LIST]", "", $text );
   $text = str_replace( "[*]", "", $text );

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
      $oldset['profiles'] = 0;
      $oldset['prof_count'] = 0;
      $oldset['pms'] = 0;
      $oldset['pm_count'] = 0;
      $oldset['titles'] = 0;
      $oldset['title_count'] = 0;
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
     <td class='tablelight' align='left'><a href='convert_vb351.php?action=members'>Convert Member Profiles</a>
     </td>";

   if( $prof_count > 0 )
      echo "<td class='tablelight' align='left'>".$prof_count." member profiles converted.</td>\n";
   else
      echo "<td class='tablelight'>&nbsp;</td>\n";
   echo "</tr>\n";

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_vb351.php?action=pmessages'>Convert Private Messages</a></td>\n";
      if( $pms == 1 )
         echo "<td class='tablelight' align='left'>".$pm_count." private messages converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_vb351.php?action=mtitles'>Convert Member Titles</a></td>\n";
      if( $titles == 1 )
         echo "<td class='tablelight' align='left'>".$title_count." member titles converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_vb351.php?action=forums'>Convert Forums</a></td>\n";
      if( $forums == 1 )
         echo "<td class='tablelight' align='left'>".$forum_count." forums converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 && $forums == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_vb351.php?action=topics'>Convert Topics</a></td>\n";
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
         echo "<td class='tablelight' align='left'><a href='convert_vb351.php?action=posts'>Convert Posts</a></td>\n";
         echo "<td class='tablelight'>&nbsp;</td>\n";
      }
      else if( $posts == 1 )
      {
         echo "<td class='tablelight' align='left'><a href='convert_vb351.php?action=posts&amp;start=".$post_count."&amp;i=".$post_count."'>Continue post conversion</a></td>\n";
         echo "<td class='tablelight' align='left'>".$post_count." posts converted so far.</td>\n";
      }
      else
      {
         echo "<td class='tablelight' align='left'><a href='convert_vb351.php?action=posts'>Convert Posts</a></td>\n";
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

else if( $_GET['action'] == 'dropvb' )
{
    include 'templates/convert_header.php';
    include 'templates/convert_destroydata.php';
    include 'templates/convert_footer.php';
}

else if( $_GET['action'] == 'confirmvbdrop' )
{
   $oldboard->db->query( "DROP TABLE IF EXISTS %padminlog" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %padminoptions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pannouncements" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pattachments" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pattachtypes" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pawaitingactivation" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pbadwords" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pbanned" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pdatacache" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pevents" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pfavorites" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforumpermissions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforums" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforumsubscriptions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pgroupleaders" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %phelpdocs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %phelpsections" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %picons" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pjoinrequests" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmoderatorlog" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmoderators" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ppolls" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ppollvotes" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pposts" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pprivatemessages" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pprofilefields" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pregimages" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %preportedposts" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %preputation" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psearchlog" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psessions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psettinggroups" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psettings" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psmilies" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptemplates" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptemplatesets" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pthemes" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pthreadratings" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pthreads" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pthreadsread" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %puserfields" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pusergroups" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pusers" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pusertitles" );

   include 'templates/convert_header.php';
   include 'templates/convert_datadestroyed.php';
   include 'templates/convert_footer.php';
}

else if( $_GET['action'] == 'members' )
{
   $i = 0;
   $qsf->db->query( "TRUNCATE %pusers" );
   $qsf->db->query( "INSERT INTO %pusers (user_id, user_name, user_group) VALUES (1, 'Guest', 3)" );

   $result = $oldboard->db->query( "SELECT m.*, f.userid, f.signature
      FROM %puser m
      LEFT JOIN %pusertextfield f ON f.userid = m.userid" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['userid']++;

      $showmail = 0; // No discernable setting for this - erring on the side of caution

      if( $row['lastvisit'] == '' || $row['lastvisit'] == 0 )
         $row['lastvisit'] = $row['joindate'];
      if( $row['lastactivity'] == '' || $row['lastactivity'] == 0 )
         $row['lastactivity'] = $row['joindate'];

      $row['username'] = strip_vb_tags( $row['username'] );
      $row['usertitle'] = strip_vb_tags( $row['usertitle'] );
      $row['email'] = strip_vb_tags( $row['email'] );
      $row['homepage'] = strip_vb_tags( $row['homepage'] );
      $row['signature'] = strip_vb_tags( $row['signature'] );

      // The default vB groups
      if( $row['usergroupid'] == 1 ) // Guests
         $row['usergroupid'] = 3;
      if( $row['usergroupid'] == 2 ) // Member
         $row['usergroupid'] = 2;
      else if( $row['usergroupid'] == 3 || $row['usergroupid'] == 4 ) // Awating Activation
         $row['usergroupid'] = 5;
      else if( $row['usergroupid'] == 5 ) // Super Moderators
         $row['usergroupid'] = 6;
      else if( $row['usergroupid'] == 6 ) // Admins
         $row['usergroupid'] = 1;
      else if( $row['usergroupid'] == 8 ) // Banned
         $row['usergroupid'] = 4;
      else
         $row['usergroupid'] = 2; // anything else becomes a member

      $icq = 0;
      if( $row['icq'] )
         $icq = intval( $row['icq'] );

      $qsf->db->query( "INSERT INTO %pusers
         (user_id, user_name, user_password, user_joined, user_title, user_title_custom, user_group, user_email, user_email_show, user_birthday, user_homepage, user_posts, user_icq, user_msn, user_aim, user_yahoo, user_signature, user_lastvisit, user_lastpost, user_regip)
         VALUES( %d, '%s', '%s', %d, '%s', %d, %d, '%s', %d, '%s', '%s', %d, %d, '%s', '%s', '%s', '%s', %d, %d, INET_ATON('%s') )",
         $row['userid'], $row['username'], $row['password'], $row['joindate'], $row['usertitle'], $row['customtitle'], $row['usergroupid'], $row['email'], $showmail, $row['birthday'], $row['homepage'], $row['posts'], $icq, $row['msn'], $row['aim'], $row['yahoo'], $row['signature'], $row['lastvisit'], $row['lastactivity'], $row['ipaddress'] );
      $i++;
   }

   $oldset['profiles'] = 1;
   $oldset['prof_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_vb351.php'>";
}

else if( $_GET['action'] == 'pmessages' )
{
   $i = 0;
   $qsf->db->query( "TRUNCATE %ppmsystem" );
   $result = $oldboard->db->query( "SELECT p.*, m.*
      FROM %ppm p
      LEFT JOIN %ppmtext m ON m.pmtextid = p.pmtextid" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      // 0 = inbox, -1 = sent box
      if( $row['folder'] == 0 || $row['folder'] == -1 )
      {
         if( $row['folder'] == 0 )
            $folder = 0;
         else
            $folder = 1;
      }
      else
         $folder = 2;

      if( $folder == 0 || $folder == 1 )
      {
         $row['userid']++;
         $row['fromuserid']++;

         $row['title'] = strip_vb_tags( $row['title'] );
         $row['message'] = strip_vb_tags( $row['message'] );
         $i++;

         $bcc = '';
         if( $folder == 1 )
         {
            $bcc = $row['userid'];
         //   $row['toid'] = $row['fromid'];
         }
         if( $row['subject'] == '' )
            $row['subject'] = "No Title";
         $qsf->db->query( "INSERT INTO %ppmsystem
            (pm_id, pm_to, pm_from, pm_bcc, pm_title, pm_time, pm_message, pm_read, pm_folder)
            VALUES( %d, %d, %d, '%s', '%s', %d, '%s', %d, %d )",
            $row['pmid'], $row['userid'], $row['fromuserid'], $bcc, $row['title'], $row['dateline'], $row['message'], $row['messageread'], $folder );
      }
   }

   $oldset['pms'] = 1;
   $oldset['pm_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_vb351.php'>";
}

else if( $_GET['action'] == 'mtitles' )
{
   $num = $oldboard->db->query( "SELECT * FROM %pusertitle" );
   $all = $oldboard->db->num_rows( $num );
   $i = 0;

   if( $all > 0 )
   {
      $qsf->db->query( "TRUNCATE %pmembertitles" );

      $result= $oldboard->db->query( "SELECT * FROM %pusertitle" );
      while( $row = $oldboard->db->nqfetch($result) )
      {
         if( $row['usertitleid'] < 1 )
            $icon = '1.png';
         else if( $row['usertitleid'] > 5 )
            $icon = '5.png';
         else
            $icon = $row['usertitleid'] . '.png';

         $qsf->db->query( "INSERT INTO %pmembertitles
            (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon)
            VALUES( %d, '%s', %d, '%s' )", $row['usertitleid'], $row['title'], $row['minposts'], $icon );
         $i++;
      }
   }

   $oldset['titles'] = 1;
   $oldset['title_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_vb351.php'>";
}

else if( $_GET['action'] == 'forums' )
{
   $qsf->db->query( "TRUNCATE %pforums" );
   $result = $oldboard->db->query( "SELECT * FROM %pforum" );
   $i = 0;

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['title'] = strip_vb_tags( $row['title'] );
      $row['description'] = strip_vb_tags( $row['description'] );

      // Insufficient data at this time to determine if a forum is really a subcategory.
      $subcat = 0;

      if( $row['parentid'] == -1 )
         $row['parentid'] = '0';

      $redirect = 0;
      $desc = $row['descrioption'];
      if( $row['link'] != '' )
      {
         $redirect = 1;
         $desc = $row['link'];
      }

      $qsf->db->query( "INSERT INTO %pforums
         (forum_id, forum_parent, forum_name, forum_description, forum_topics, forum_replies, forum_lastpost, forum_subcat, forum_redirect)
         VALUES( %d, %d, '%s', '%s', %d, %d, %d, %d, %d )",
         $row['forumid'], $row['parentid'], $row['title'], $desc, $row['threadcount'], $row['replycount'], $row['lastpost'], $subcat, $redirect );
      $i++;
   }

   $oldset['forums'] = 1;
   $oldset['forum_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_vb351.php'>";
}

else if( $_GET['action'] == 'topics' )
{
   $qsf->db->query( "TRUNCATE %ptopics" );
   $result = $oldboard->db->query( "SELECT * FROM %pthread" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['postuserid']++;

      $topic_modes = TOPIC_PUBLISH;
      if( $row['open'] == 0 )
         $topic_modes = ($topic_modes | TOPIC_LOCKED);
      if( $row['sticky'] == 1 )
         $topic_modes = ($topic_modes | TOPIC_PINNED);
      if( $row['pollid'] > 0 )
         $topic_modes = ($topic_modes | TOPIC_POLL);

      $row['title'] = strip_vb_tags( $row['title'] );
      $qsf->db->query( "INSERT INTO %ptopics
         (topic_id, topic_forum, topic_title, topic_starter, topic_last_poster, topic_edited, topic_replies, topic_views, topic_modes)
         VALUES( %d, %d, '%s', %d, %d, %d, %d, %d, %d )",
         $row['threadid'], $row['forumid'], $row['title'], $row['postuserid'], $row['postuserid'], $row['dateline'], $row['replycount'], $row['views'], $topic_modes );
      $i++;
   }

   $qsf->db->query( "TRUNCATE %psubscriptions" );
   $result = $oldboard->db->query( "SELECT * FROM %psubscribeforum" );
   $expire = time() + 2592000;
   $sub_id = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $sub_id++;
      $qsf->db->query( "INSERT INTO %psubscriptions
         (subscription_id, subscription_user, subscription_type, subscription_item, subscription_expire)
         VALUES( %d, %d, 'forum', %d, %d )", $sub_id, $row['userid'], $row['forumid'], $expire );
   }

   $result = $oldboard->db->query( "SELECT * FROM %psubscribethread" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $sub_id++;
      $qsf->db->query( "INSERT INTO %psubscriptions
         (subscription_id, subscription_user, subscription_type, subscription_item, subscription_expire)
         VALUES( %d, %d, 'topic', %d, %d )", $sub_id, $row['userid'], $row['threadid'], $expire );
   }

   $oldset['topics'] = 1;
   $oldset['topic_count'] = $i;
   write_olddb_sets( $oldset );

   $qsf->db->query( "TRUNCATE %pvotes" );

   $result = $oldboard->db->query( "SELECT p.*, v.pollid, v.userid, v.voteoption
      FROM %ppoll p
      LEFT JOIN %ppollvote v ON v.pollid = p.pollid" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $result2 = $oldboard->db->query( "SELECT * FROM %pthread WHERE pollid=%d", $row['pollid'] );
      while( $row2 = $oldboard->db->nqfetch($result2) )
      {
         $tid = $row2['threadid'];
      }

      $pollanswers = "";
      $polloptions = explode( "|||", $row['options'] );

      foreach( $polloptions as $options => $option )
         $pollanswers .= $option . "\n";
      $qsf->db->query( "UPDATE %ptopics SET topic_poll_options='%s' WHERE topic_id=%d", $pollanswers, $tid );

      $user = $row['userid'] + 1;
      $vote = $row['voteoption'] - 1;
      $qsf->db->query( "INSERT INTO %pvotes (vote_user, vote_topic, vote_option) VALUES( %d, %d, %d )", $user, $tid, $vote );
      $i++;
   }

   $oldset['polls'] = 1;
   $oldset['poll_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_vb351.php'>";
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

   $num = $oldboard->db->query( "SELECT * FROM %ppost" );
   $all = $oldboard->db->num_rows( $num );
   $newstart = $start + $oldset['post_inc'];

   $result= $oldboard->db->query( "SELECT * FROM %ppost LIMIT %d, %d", $start, $oldset['post_inc'] );

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['userid']++;

      $row['pagetext'] = strip_vb_tags( $row['pagetext'] );

      $smilies = 0;
      if( $row['allowsmilie'] == 1 )
         $smilies = 1;

      $qsf->db->query( "INSERT INTO %pposts
         (post_id, post_topic, post_author, post_emoticons, post_text, post_time, post_ip)
         VALUES( %d, %d, %d, %d, '%s', %d, INET_ATON('%s') )",
         $row['postid'], $row['threadid'], $row['userid'], $smilies, $row['pagetext'], $row['dateline'], $row['ipaddress'] );
      $i++;
   }
   if( $i == $all )
   {
      $oldset['posts'] = 2;
      $oldset['post_count'] = $i;
      $oldset['converted'] = 2;
   }
   else
   {
      $oldset['posts'] = 1;
      $oldset['post_count'] = $i;
   }
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_vb351.php'>";
}
?>
