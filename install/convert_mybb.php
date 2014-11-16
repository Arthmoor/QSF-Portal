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
 * myBB Conversion Script
 * Based on work by Yazinin Nick <admin@vk.net.ru>
 *
 * Roger Libiez [Samson] http://www.iguanadons.net
 *
 * This convertor has been tested on unmodified databases for MyBB 1.0 and 1.1
 **/

define('QUICKSILVERFORUMS', true);

require_once './convert_db.php';
require_once '../settings.php';
$set['include_path'] = '..';
require_once $set['include_path'] . '/defaultutils.php';
require_once $set['include_path'] . '/global.php';

// Check for any addons available
include_addons($set['include_path'] . '/addons/');

define('CONVERTER_NAME', 'MyBB 1.0/1.1');
define('CONVERTER_URL', 'convert_mybb.php');
define('CONVERTER_DROPURL', 'convert_mybb.php?action=dropmybb');
define('CONVERTOR_DROPCONFIRMURL', 'convert_ikon312a.php?action=confirmmybbdrop');

$db = new $modules['database']( $set['db_host'], $set['db_user'], $set['db_pass'], $set['db_name'], $set['db_port'], $set['db_socket'], $set['prefix'] );
if( !$db->connection )
{
   error( QUICKSILVER_ERROR, 'A connection to the Quicksilver Forums database could not be established. Please check your settings and try again.', __FILE__, __LINE__ );
}
$qsf = new qsfglobal($db);

$olddb = new $modules['database']( $oldset['old_db_host'], $oldset['old_db_user'], $oldset['old_db_pass'], $oldset['old_db_name'], $oldset['old_db_port'], $oldset['old_db_socket'], $oldset['old_prefix'] );
if( !$olddb->connection )
{
   error( QUICKSILVER_ERROR, 'A connection to the MyBB database could not be established. Please check your settings and try again.', __FILE__, __LINE__ );
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
      'forums'        => $oldset['forums'],
      'forum_count'   => $oldset['forum_count'],
      'topics'        => $oldset['topics'],
      'topic_count'   => $oldset['topic_count'],
      'polls'         => $oldset['polls'],
      'poll_count'    => $oldset['poll_count'],
      'attach'        => $oldset['attach'],
      'attach_count'  => $oldset['attach_count'],
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
function strip_mybb_tags( $text )
{
   // The [html] BBCode tag is not supported by MyBB or Quicksilver Forums, so just strip those off and leave the contents.
   $text = preg_replace( '/\[html\](.+?)\[\/html\]/si', '\\1', $text );

   /* Convert malformed image tags. */
   $text = preg_replace( '/\[img=(.*?)\](.*?)\[\/img\]/si', '[img]\\1[/img]', $text );

   // Font size tags....
   $text = preg_replace( '/\[size=4\](.*?)\[\/size\]/si', '[size=7]\\1[/size]', $text );
   $text = preg_replace( '/\[size=3\](.*?)\[\/size\]/si', '[size=5]\\1[/size]', $text );
   $text = preg_replace( '/\[size=2\](.*?)\[\/size\]/si', '[size=3]\\1[/size]', $text );
   $text = preg_replace( '/\[size=1\](.*?)\[\/size\]/si', '[size=2]\\1[/size]', $text );

   // Text alignment tags....
   $text = preg_replace( '/\[align=(.*?)\](.*?)\[\/align\]/si', '[\\1]\\2[/\\1]', $text );
   $text = preg_replace( '/\[justify\](.*?)\[\/justify\]/si', '\\1', $text );

   // List tags are not supported in QSF.
   $text = preg_replace( '/\[list=(.*?)\](.*?)\[\/list\]/si', '\\2', $text );
   $text = str_replace( "[list]", "", $text );
   $text = str_replace( "[/list]", "", $text );
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
      $oldset['censor'] = 0;
      $oldset['censor_count'] = 0;
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
      $oldset['attach'] = 0;
      $oldset['attach_count'] = 0;
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
   $forums = $oldset['forums'];
   $forum_count = $oldset['forum_count'];
   $topics = $oldset['topics'];
   $topic_count = $oldset['topic_count'];
   $polls = $oldset['polls'];
   $poll_count = $oldset['poll_count'];
   $attach = $oldset['attach'];
   $attach_count = $oldset['attach_count'];
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
     <td class='tablelight' align='left'><a href='convert_mybb.php?action=censor'>Convert Censored Words</a>
     </td>";

   if( $censor_count > 0 )
      echo "<td class='tablelight' align='left'>".$censor_count." censored words converted.</td>\n";
   else
      echo "<td class='tablelight'>&nbsp;</td>\n";
   echo "</tr>\n";

   echo "<tr>
     <td class='tablelight' align='left'><a href='convert_mybb.php?action=members'>Convert Member Profiles</a>
     </td>";

   if( $prof_count > 0 )
      echo "<td class='tablelight' align='left'>".$prof_count." member profiles converted.</td>\n";
   else
      echo "<td class='tablelight'>&nbsp;</td>\n";
   echo "</tr>\n";

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_mybb.php?action=pmessages'>Convert Private Messages</a></td>\n";
      if( $pms == 1 )
         echo "<td class='tablelight' align='left'>".$pm_count." private messages converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_mybb.php?action=mtitles'>Convert Member Titles</a></td>\n";
      if( $titles == 1 )
         echo "<td class='tablelight' align='left'>".$title_count." member titles converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_mybb.php?action=forums'>Convert Forums</a></td>\n";
      if( $forums == 1 )
         echo "<td class='tablelight' align='left'>".$forum_count." forums converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 && $forums == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_mybb.php?action=topics'>Convert Topics</a></td>\n";
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
      echo "<td class='tablelight' align='left'><a href='convert_mybb.php?action=attach'>Convert Attachments</a></td>\n";
      if( $attach == 1 )
         echo "<td class='tablelight' align='left'>".$attach_count." attachments converted. Attached files must be copied manually.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 && $topics == 1 )
   {
      echo "<tr>\n";
      if( $posts == 0 )
      {
         echo "<td class='tablelight' align='left'><a href='convert_mybb.php?action=posts'>Convert Posts</a></td>\n";
         echo "<td class='tablelight'>&nbsp;</td>\n";
      }
      else if( $posts == 1 )
      {
         echo "<td class='tablelight' align='left'><a href='convert_mybb.php?action=posts&amp;start=".$post_count."&amp;i=".$post_count."'>Continue post conversion</a></td>\n";
         echo "<td class='tablelight' align='left'>".$post_count." posts converted so far.</td>\n";
      }
      else
      {
         echo "<td class='tablelight' align='left'><a href='convert_mybb.php?action=posts'>Convert Posts</a></td>\n";
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

else if( $_GET['action'] == 'dropmybb' )
{
    include 'templates/convert_header.php';
    include 'templates/convert_destroydata.php';
    include 'templates/convert_footer.php';
}

else if( $_GET['action'] == 'confirmmybbdrop' )
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

else if( $_GET['action'] == 'censor' )
{
   $result = $oldboard->db->query( "SELECT * FROM %pbadwords" );
   $i = '0';

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $qsf->db->query( "INSERT INTO %preplacements (replacement_search, replacement_type) VALUES( '{$row['badword']}', 'censor' )" );
      $i++;
   }

   $oldset['censor'] = 1;
   $oldset['censor_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_mybb.php'>";
}

else if( $_GET['action'] == 'members' )
{
   $i = 0;
   $qsf->db->query( "TRUNCATE %pusers" );
   $qsf->db->query( "INSERT INTO %pusers (user_id, user_name, user_group) VALUES (1, 'Guest', 3)" );

   $result = $oldboard->db->query( "SELECT * FROM %pusers" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['uid']++;

      if( $row['hideemail'] == '' || $row['hideemail'] == 'no' )
         $showmail = 0;
      else
         $showmail = 1;

      if( $row['pmnotify'] == '' || $row['pmnotify'] == 'no' )
         $pmnotify = 0;
      else
         $pmnotify = 1;

      if( $row['showsigs'] == '' || $row['showsigs'] == 'no' )
         $showsigs = 0;
      else
         $showsigs = 1;

      if( $row['showavatars'] == '' || $row['showavatars'] == 'no' )
         $showavatars = 0;
      else
         $showavatars = 1;

      if( $row['invisible'] == '' || $row['invisible'] == 'no' )
         $invisible = 0;
      else
         $invisible = 1;

      if( $row['receivepms'] == '' || $row['receivepms'] == 'no' )
         $receivepms = 0;
      else
         $receivepms = 1;

      if( $row['lastvisit'] == '' || $row['lastvisit'] == 0 )
         $row['lastvisit'] = $row['regdate'];
      if( $row['lastactive'] == '' || $row['lastactive'] == 0 )
         $row['lastactive'] = $row['regdate'];

      $row['username'] = strip_mybb_tags( $row['username'] );
      if( $row['usertitle'] != '' )
      {
         $usertitle = strip_mybb_tags( $row['usertitle'] );
         $customtitle = 1;
      }
      else
      {
         $usertitle = '';
         $customtitle = 0;
      }
      
      $row['email'] = strip_mybb_tags( $row['email'] );
      $row['website'] = strip_mybb_tags( $row['website'] );
      $row['signature'] = strip_mybb_tags( $row['signature'] );

      // The default MyBB groups
      if( $row['usergroup'] == 2 ) // Member
         $row['usergroup'] = 2;
      else if( $row['usergroup'] == 3 ) // Super-Moderator
         $row['usergroup'] = 6;
      else if( $row['usergroup'] == 4 ) // Admin
         $row['usergroup'] = 1;
      else if( $row['usergroup'] == 5 ) // Awating Activation
         $row['usergroup'] = 5;
      else if( $row['usergroup'] == 7 ) // Banned
         $row['usergroup'] = 4;
      else
         $row['usergroup'] = 2; // anything else becomes a member

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

      $icq = 0;
      if( $row['icq'] )
         $icq = intval( $row['icq'] );

      $qsf->db->query( "INSERT INTO %pusers
         (user_id, user_name, user_password, user_joined, user_title, user_title_custom, user_group, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height, user_email, user_email_show, user_homepage, user_posts, user_icq, user_msn, user_aim, user_yahoo, user_signature, user_lastvisit, user_lastpost, user_pm_mail, user_view_signatures, user_view_avatars, user_active, user_pm, user_regip)
         VALUES( %d, '%s', '%s', %d, '%s', %d, %d, '%s', '%s', %d, %d, '%s', %d, '%s', %d, %d, '%s', '%s', '%s', '%s', %d, %d, %d, INET_ATON('%s') )",
         $row['uid'], $row['username'], $row['password'], $row['regdate'], $usertitle, $customtitle, $row['usergroup'], $avatar, $type, $width, $height, $row['email'], $showmail, $row['website'], $row['postnum'], $icq, $row['msn'], $row['aim'], $row['yahoo'], $row['signature'], $row['lastvisit'], $row['lastactive'], $pmnotify, $showsigs, $showavatars, $invisible, $receivepms, $row['regip'] );
      $i++;
   }

   $oldset['profiles'] = 1;
   $oldset['prof_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_mybb.php'>";
}

else if( $_GET['action'] == 'pmessages' )
{
   $i = 0;
   $qsf->db->query( "TRUNCATE %ppmsystem" );
   $result = $oldboard->db->query( "SELECT * FROM %pprivatemessages" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      // 1 = inbox, 2 = sent box
      if( $row['folder'] == 1 || $row['folder'] == 2 )
      {
         if( $row['folder'] == 1 )
            $folder = 0;
         else
            $folder = 1;
      }
      else
         $folder = 2;

      if( $folder == 0 || $folder == 1 )
      {
         $row['uid']++;
         $row['toid']++;
         $row['fromid']++;

         $row['subject'] = strip_mybb_tags( $row['subject'] );
         $row['message'] = strip_mybb_tags( $row['message'] );
         $i++;

         $bcc = '';
         if( $folder == 1 )
         {
            $bcc = $row['toid'];
            $row['toid'] = $row['fromid'];
         }
         if( $row['subject'] == '' )
            $row['subject'] = "No Title";
         $qsf->db->query( "INSERT INTO %ppmsystem
            (pm_id, pm_to, pm_from, pm_bcc, pm_title, pm_time, pm_message, pm_read, pm_folder)
            VALUES( %d, %d, %d, '%s', '%s', %d, '%s', %d, %d )",
            $row['pmid'], $row['toid'], $row['fromid'], $bcc, $row['subject'], $row['dateline'], $row['message'], $row['status'], $folder );
      }
   }

   $oldset['pms'] = 1;
   $oldset['pm_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_mybb.php'>";
}

else if( $_GET['action'] == 'mtitles' )
{
   $num = $oldboard->db->query( "SELECT * FROM %pusertitles" );
   $all = $oldboard->db->num_rows( $num );
   $i = 0;

   if( $all > 0 )
   {
      $qsf->db->query( "TRUNCATE %pmembertitles" );

      $result= $oldboard->db->query( "SELECT * FROM %pusertitles" );
      while( $row = $oldboard->db->nqfetch($result) )
      {
         if( $row['stars'] < 1 )
            $icon = '1.png';
         else if( $row['stars'] > 5 )
            $icon = '5.png';
         else
            $icon = $row['stars'] . '.png';

         $qsf->db->query( "INSERT INTO %pmembertitles
            (membertitle_id, membertitle_title, membertitle_posts, membertitle_icon)
            VALUES( %d, '%s', %d, '%s' )", $row['utid'], $row['title'], $row['posts'], $icon );
         $i++;
      }
   }

   $oldset['titles'] = 1;
   $oldset['title_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_mybb.php'>";
}

else if( $_GET['action'] == 'forums' )
{
   $qsf->db->query( "TRUNCATE %pforums" );
   $result = $oldboard->db->query( "SELECT * FROM %pforums" );
   $i = 0;

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['name'] = strip_mybb_tags( $row['name'] );
      $row['description'] = strip_mybb_tags( $row['description'] );

      $subcat = 0;
      if( $row['type'] == 'c' && $row['pid'] != 0 )
         $subcat = 1;

      $redirect = 0;
      $desc = $row['description'];
      if( $row['linkto'] != '' )
      {
         $redirect = 1;
         $desc = $row['linkto'];
      }

      $qsf->db->query( "INSERT INTO %pforums
         (forum_id, forum_parent, forum_name, forum_description, forum_topics, forum_replies, forum_lastpost, forum_subcat, forum_redirect)
         VALUES( %d, %d, '%s', '%s', %d, %d, %d, %d, %d )",
         $row['fid'], $row['pid'], $row['name'], $desc, $row['threads'], $row['posts'], $row['lastpost'], $subcat, $redirect );
      $i++;
   }

   $oldset['forums'] = 1;
   $oldset['forum_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_mybb.php'>";
}

else if( $_GET['action'] == 'topics' )
{
   $qsf->db->query( "TRUNCATE %ptopics" );
   $result = $oldboard->db->query( "SELECT * FROM %pthreads" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['uid']++;

      $topic_modes = TOPIC_PUBLISH;
      if( $row['closed'] == 'yes' )
         $topic_modes = ($topic_modes | TOPIC_LOCKED);
      if( $row['sticky'] == 1 )
         $topic_modes = ($topic_modes | TOPIC_PINNED);
      if( $row['poll'] == 1 )
         $topic_modes = ($topic_modes | TOPIC_POLL);

      $row['subject'] = strip_mybb_tags( $row['subject'] );

      $qsf->db->query( "INSERT INTO %ptopics
         (topic_id, topic_forum, topic_title, topic_starter, topic_last_post, topic_last_poster, topic_posted, topic_edited, topic_replies, topic_views, topic_modes)
         VALUES( %d, %d, '%s', %d, %d, %d, %d, %d, %d, %d, %d )",
         $row['tid'], $row['fid'], $row['subject'], $row['uid'], $row['lastposttid'], $row['uid'], $row['dateline'], $row['lastpost'], $row['replies'], $row['views'], $topic_modes );
      $i++;
   }

   $qsf->db->query( "TRUNCATE %psubscriptions" );
   $result = $oldboard->db->query( "SELECT * FROM %pforumsubscriptions" );
   $expire = time() + 2592000;
   $sub_id = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $sub_id++;
      $qsf->db->query( "INSERT INTO %psubscriptions
         (subscription_id, subscription_user, subscription_type, subscription_item, subscription_expire)
         VALUES( %d, %d, 'forum', %d, %d )", $sub_id, $row['uid'], $row['fid'], $expire );
   }

   $sql = "SELECT * FROM %pfavorites";
   $result = $oldboard->db->query($sql);
   while( $row = $oldboard->db->nqfetch($result) )
   {
      if( $row['type'] == 's' )
      {
         $sub_id++;
         $qsf->db->query( "INSERT INTO %psubscriptions
            (subscription_id, subscription_user, subscription_type, subscription_item, subscription_expire)
            VALUES( %d, %d, 'topic', %d, %d )", $sub_id, $row['uid'], $row['tid'], $expire );
      }
   }

   $oldset['topics'] = 1;
   $oldset['topic_count'] = $i;
   write_olddb_sets( $oldset );

   $qsf->db->query( "TRUNCATE %pvotes" );
   $result = $oldboard->db->query( "SELECT p.*, v.pid, v.uid, v.voteoption
      FROM %ppolls p
      LEFT JOIN %ppollvotes v ON v.pid = p.pid" );
   $i = 0;
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $pollanswers = "";
      $polloptions = explode( "||~|~||", $row['options'] );

      foreach( $polloptions as $options => $option )
         $pollanswers .= $option . "\n";
      $qsf->db->query( "UPDATE %ptopics SET topic_poll_options='%s' WHERE topic_id=%d", $pollanswers, $row['tid'] );

      $user = $row['uid'] + 1;
      $vote = $row['voteoption'] - 1;
      $qsf->db->query( "INSERT INTO %pvotes (vote_user, vote_topic, vote_option) VALUES( %d, %d, %d )", $user, $row['tid'], $vote );
      $i++;
   }

   $oldset['polls'] = 1;
   $oldset['poll_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_mybb.php'>";
}

else if( $_GET['action'] == 'attach' )
{
   $qsf->db->query( "TRUNCATE %pattach" );
   $result = $oldboard->db->query( "SELECT * FROM %pattachments" );
   $i = 0;

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $qsf->db->query( "INSERT INTO %pattach
         (attach_id, attach_file, attach_name, attach_post, attach_downloads, attach_size)
         VALUES( %d, '%s', '%s', %d, %d, %d )",
         $row['aid'], $row['attachname'], $row['filename'], $row['pid'], $row['downloads'], $row['filesize'] );
      $i++;

      // TODO: Add code to copy the file from the MyBB folde to the QSF folder.
   }

   $oldset['attach'] = 1;
   $oldset['attach_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_mybb.php'>";
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

   $result= $oldboard->db->query( "SELECT * FROM %pposts LIMIT %d, %d", $start, $oldset['post_inc'] );

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['uid']++;

      $row['message'] = strip_mybb_tags( $row['message'] );

      $smilies = 1;
      if( $row['smilieoff'] == 'yes' )
         $smilies = 0;

      $qsf->db->query( "INSERT INTO %pposts
         (post_id, post_topic, post_author, post_emoticons, post_text, post_time, post_ip, post_edited_time)
         VALUES( %d, %d, %d, %d, '%s', %d, INET_ATON('%s'), %d )",
         $row['pid'], $row['tid'], $row['uid'], $smilies, $row['message'], $row['dateline'], $row['ipaddress'], $row['edittime'] );
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
   echo "<meta http-equiv='Refresh' content='0;URL=convert_mybb.php'>";
}
?>
