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
 * Invision Power Board 2.1 Conversion Script
 * Based on work by Yazinin Nick <admin@vk.net.ru>
 *
 * Roger Libiez [Samson]
 *
 * Script tested on an unmodified Invision Power Board 2.1 database.
 * Use with any other version has not been validated!
 **/

define('QUICKSILVERFORUMS', true);

require_once './convert_db.php';
require_once '../settings.php';
$set['include_path'] = '..';
require_once $set['include_path'] . '/defaultutils.php';
require_once $set['include_path'] . '/global.php';

// Check for any addons available
include_addons($set['include_path'] . '/addons/');

define('CONVERTER_NAME', 'Invision Power Board 2.1');
define('CONVERTER_URL', 'convert_ipb21.php');
define('CONVERTER_DROPURL', 'convert_ipb21.php?action=dropipb21');
define('CONVERTOR_DROPCONFIRMURL', 'convert_ipb21.php?action=confirmipb21drop');

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

/*
 * Remove all of the offending junky HTML Invisionboard encoded into message text.
 * Thanks to the good people who frequent php.net for posting examples of how to use regex.
 * It obviously helped alot, especially with Invisionboard's ugly non-validating XHTML 1.0 - Oh the irony
 */
function strip_ipb21_tags( $text )
{
   // The [html] BBCode tag is not supported by Quicksilver Forums, so when the horrid mess is encountered in Invisionboard.....
   $text = preg_replace( "#<!--html-->(.+?)<!--html1-->#", "", $text );
   $text = preg_replace( "#<!--html2-->(.+?)<!--html3-->#", "", $text );

   // Convert emoticons....
   $text = preg_replace( "#emoid=[\"]:(\S+?):[\"]#", "\\1", $text );
   $text = preg_replace( "#<img src=[\"']style_emoticons/(.*?)/>#", "", $text );

   // Convert font tags. Man are these UGLY.
   $text = preg_replace( "#<!--fonto:(.+?)-->(.+?)<!--/fonto-->#", "[font=\\1]", $text );
   $text = str_replace( "<!--fontc--></span><!--/fontc-->", "[/font]", $text );

   // Convert size tags, also very ugly.
   $text = preg_replace( "#<!--sizeo:(.+?)-->.+?<!--/sizeo-->#", "[size=\\1]", $text );
   $text = preg_replace( "#<!--sizec-->.+?<!--/sizec-->#", "[/size]", $text );

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
   $text = preg_replace( "#<!--coloro:(.+?)-->(.+?)<!--/coloro-->#", "[color=\\1]", $text );
   $text = str_replace( "<!--colorc--></span><!--/colorc-->", "[/color]", $text );

   // List tags are not supported in QSF.
   $text = preg_replace( '/\[list=(.*?)\](.*?)\[\/list\]/si', '\\2', $text );
   $text = str_replace( "[list]", "", $text );
   $text = str_replace( "[/list]", "", $text );
   $text = str_replace( "[*]", "", $text );

   // Indent tags are not supported in QSF.
   $text = str_replace( "[indent]", "", $text );
   $text = str_replace( "[/indent]", "", $text );

   // Font tags are not desired, so they will be summarily parsed out....
   $text = preg_replace( "#<font(.+?)>#", "", $text );
   $text = str_replace ( "</font>", "", $text );

   // Span tags at this point are also not desired.
   $text = preg_replace( "#<span(.+?)>#", "", $text );
   $text = str_replace ( "</span>", "", $text );

   // Reconfigure code tags.
   $text = preg_replace( "#<!--c1-->(.+?)<!--ec1--><br />#", '[code]', $text );
   $text = preg_replace( "#<!--c1-->(.+?)<!--ec1-->#", '[code]', $text );
   $text = preg_replace( "#<!--c2-->(.+?)<!--ec2-->#", '[/code]', $text );

   // Reconfigure SQL tags
   $text = preg_replace( "#<!--sql-->(.+?)<!--sql1-->#", "[code]", $text );
   $text = preg_replace( "#<!--sql2-->(.+?)<!--sql3-->#", "[/code]", $text );

   // Strip flash movies and let people know about it.
   $text = preg_replace( "#<!--Flash (.+?)-->.+?<!--End Flash-->#e", "Flash image stripped during conversion.", $text );

   // Reconfigure quote tags.
   $text = preg_replace( "#<!--quoteo-->(.+?)<!--quotec-->#", "[quote]", $text );
   $text = preg_replace( "#<!--quoteo-{1,2}([^>]+?)\+([^>]+?)-->(.+?)<!--quotec-->#" , "[quote=\\1,\\2]" , $text );
   $text = preg_replace( "#<!--quoteo-{1,2}([^>]+?)\+-->(.+?)<!--quotec-->#" , "[quote=\\1]" , $text );
   $text = preg_replace( "#<!--QuoteEnd-->(.+?)<!--QuoteEEnd-->#", "[/quote]", $text );

   // Fix the text formatting tags....
   $text = preg_replace( "#<i>(.+?)</i>#is", "[i]\\1[/i]", $text );
   $text = preg_replace( "#<b>(.+?)</b>#is", "[b]\\1[/b]", $text );
   $text = preg_replace( "#<s>(.+?)</s>#is", "[s]\\1[/s]", $text );
   $text = preg_replace( "#<strike>(.+?)</strike>#is", "[s]\\1[/s]", $text );
   $text = preg_replace( "#<u>(.+?)</u>#is", "[u]\\1[/u]", $text );
   $text = preg_replace( "#<blockquote>(.+?)</blockquote>#is", "\\1", $text );
   $text = preg_replace( "#<div align=(.+?)>(.+?)</div>#is", "\\2", $text );
   $text = str_replace( "<br>", "\n", $text );
   $text = str_replace( "<br />", "\n", $text );

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
   $cats = $oldset['cats'];
   $cat_count = $oldset['cat_count'];
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
     <td class='tablelight' align='left'><a href='convert_ipb21.php?action=censor'>Convert Censored Words</a>
     </td>";

   if( $censor_count > 0 )
      echo "<td class='tablelight' align='left'>".$censor_count." censored words converted.</td>\n";
   else
      echo "<td class='tablelight'>&nbsp;</td>\n";
   echo "</tr>\n";

   echo "<tr>
     <td class='tablelight' align='left'><a href='convert_ipb21.php?action=members'>Convert Member Profiles</a>
     </td>";

   if( $prof_count > 0 )
      echo "<td class='tablelight' align='left'>".$prof_count." member profiles converted.</td>\n";
   else
      echo "<td class='tablelight'>&nbsp;</td>\n";
   echo "</tr>\n";

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_ipb21.php?action=pmessages'>Convert Private Messages</a></td>\n";
      if( $pms == 1 )
         echo "<td class='tablelight' align='left'>".$pm_count." private messages converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_ipb21.php?action=mtitles'>Convert Member Titles</a></td>\n";
      if( $titles == 1 )
         echo "<td class='tablelight' align='left'>".$title_count." member titles converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_ipb21.php?action=forums'>Convert Forums</a></td>\n";
      if( $forums == 1 )
         echo "<td class='tablelight' align='left'>".$forum_count." forums converted.</td>\n";
      else
         echo "<td class='tablelight'>&nbsp;</td>\n";
      echo "</tr>\n";
   }

   if( $prof == 1 && $forums == 1 )
   {
      echo "<tr>\n";
      echo "<td class='tablelight' align='left'><a href='convert_ipb21.php?action=topics'>Convert Topics</a></td>\n";
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
      echo "<td class='tablelight' align='left'><a href='convert_ipb21.php?action=attach'>Convert Attachments</a></td>\n";
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
         echo "<td class='tablelight' align='left'><a href='convert_ipb21.php?action=posts'>Convert Posts</a></td>\n";
         echo "<td class='tablelight'>&nbsp;</td>\n";
      }
      else if( $posts == 1 )
      {
         echo "<td class='tablelight' align='left'><a href='convert_ipb21.php?action=posts&start=".$post_count."&i=".$post_count."'>Continue post conversion</a></td>\n";
         echo "<td class='tablelight' align='left'>".$post_count." posts converted so far.</td>\n";
      }
      else
      {
         echo "<td class='tablelight' align='left'><a href='convert_ipb21.php?action=posts'>Convert Posts</a></td>\n";
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

else if( $_GET['action'] == 'dropipb21' )
{
    include 'templates/convert_header.php';
    include 'templates/convert_destroydata.php';
    include 'templates/convert_footer.php';
}

else if( $_GET['action'] == 'confirmipb21drop' )
{
   $oldboard->db->query( "DROP TABLE IF EXISTS %padmin_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %padmin_permission_keys" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %padmin_permission_rows" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %padmin_sessions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pannouncements" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pattachments" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pattachments_type" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pbadwords" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pbanfilters" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pbulk_mail" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcache_store" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcal_calendars" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcal_events" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcalendar_events" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcomponents" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pconf_settings" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pconf_settings_titles" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcontacts" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pcustom_bbcode" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pdnames_change" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pemail_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pemoticons" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pfaq" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_perms" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforum_tracker" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pforums" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pgroups" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %planguages" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %plogin_methods" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmail_error_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmail_queue" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmember_extra" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmembers" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmembers_converge" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmembers_partial" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmessage_text" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmessage_topics" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmoderator_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pmoderators" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ppfields_content" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ppfields_data" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ppolls" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pposts" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %preg_antispam" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %prss_export" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %prss_import" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %prss_imported" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psearch_results" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psessions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pskin_macro" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pskin_sets" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pskin_templates" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pskin_templates_cache" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pspider_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psubscription_currency" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psubscription_extra" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psubscription_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psubscription_methods" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psubscription_trans" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %psubscriptions" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptask_logs" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptask_manager" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptemplate_diff_changes" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptemplate_diff_session" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptemplates_diff_import" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptitles" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptopic_markers" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptopic_mmod" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptopic_ratings" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptopic_views" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptopics" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptopics_read" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %ptracker" );
   $oldboard->db->query( "DROP TABLE IF EXISTS %pupgrade_history" );
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
   $i = 0;

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $qsf->db->query( "INSERT INTO %preplacements (replacement_search, replacement_type) VALUES( '%s', 'censor' )", $row['type'] );
      $i++;
   }

   $oldset['censor'] = 1;
   $oldset['censor_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ipb21.php'>";
}

else if( $_GET['action'] == 'members' )
{
   $qsf->db->query( "TRUNCATE %pusers" );
   $qsf->db->query( "INSERT INTO %pusers VALUES( 1, 'Guest', '', 0, 1, '', 0, 3, 'default', 'en', '', 'none', 0, 0, '', 0, 0, '0000-00-00', '151', '', 0, 0, '', 0, '', '', '', 0, 1, '', '', '', 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, '' )" );

   $i = 0;
   $result = $oldboard->db->query( "SELECT u.*, m.* FROM %pmembers u LEFT JOIN %pmember_extra m ON m.id=u.id" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      if( $row['id'] > 0 )
      {
         $row['id']++;

         if( $row['hide_email'] == '' || $row['hide_email'] == 1 )
            $showmail = 0;
         else
            $showmail = 1;

         $row['name'] = strip_ipb21_tags( $row['name'] );
         $row['email'] = strip_ipb21_tags( $row['email'] );
         $row['website'] = strip_ipb21_tags( $row['website'] );
         $row['location'] = strip_ipb21_tags( $row['location'] );
         $row['interests'] = strip_ipb21_tags( $row['interests'] );
         $row['signature'] = strip_ipb21_tags( $row['signature'] );

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
         else if( $row['mgroup'] == 6 )
            $row['mgroup'] = 6;
         else
            $row['mgroup'] = 2;

         if( $row['avatar_type'] == 'url' )
         {
            $avatar = $row['avatar_location'];
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

         $qsf->db->query( "INSERT INTO %pusers VALUES( %d, '%s', 'INVALID', %d, 1, '%s', 0, %d, 'default', 'en', '%s', '%s', %d, %d, '%s', %d, 1, '%s', 151, '%s', %d, '%s', %d, '%s', '%s', '', 1, 1, '%s', '%s', '%s', %d, 0, %d, 0, 0, 1, 1, 1, 0, 0, '' )",
            $row['id'], $row['name'], $row['joined'], $row['title'], $row['mgroup'], $avatar, $type, $width, $height, $row['email'], $showmail, $bday, $row['website'], $row['posts'], $row['location'], $row['icq_number'], $row['msnname'], $row['aim_name'], $row['yahoo'], $row['interests'], $row['signature'], $row['last_visit'], $row['last_activity'] );
         $i++;
      }
   }

   $oldset['profiles'] = 1;
   $oldset['prof_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ipb21.php'>";
}

else if( $_GET['action'] == 'pmessages' )
{
   $i = 0;
   $qsf->db->query( "TRUNCATE %ppmsystem" );
   $result = $oldboard->db->query( "SELECT m.*, u.*
      FROM %pmessage_topics m
      LEFT JOIN %pmessage_text u ON u.msg_id = m.mt_id" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      if( $row['mt_vid_folder'] == "in" || $row['mt_vid_folder'] == "sent" )
      {
         // Empty and N/A recipient IDs are no good!
         if( $row['mt_to_id'] != '' && $row['mt_to_id'] != 'N/A' )
         {
            $row['mt_to_id']++;
            $row['mt_from_id']++;

            $row['mt_title'] = strip_ipb21_tags( $row['mt_title'] );
            $row['msg_post'] = strip_ipb21_tags( $row['msg_post'] );

            $i++;

            if( $row['mt_vid_folder'] == "in" )
               $folder = 0;
            else
               $folder = 1;

            $bcc = '';
            if( $folder == 1 )
            {
               $bcc = $row['mt_to_id'];
               $row['mt_to_id'] = $row['mt_from_id'];
            }

            if( $row['mt_title'] == '' )
               $row['mt_title'] = "No Title";

            $qsf->db->query( "INSERT INTO %ppmsystem VALUES( %d, %d, %d, 0, '%s', '%s', %d, '%s', %d, %d )",
               $row['mt_id'], $row['mt_to_id'], $row['mt_from_id'], $bcc, $row['mt_title'], $row['mt_date'], $row['msg_post'], $row['mt_read'], $folder );
         }
      }
   }
   $oldset['pms'] = 1;
   $oldset['pm_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ipb21.php'>";
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
         $qsf->db->query( "INSERT INTO %pmembertitles VALUES( %d, '%s', %d, '%s' )", $row['id'], $row['title'], $row['posts'], $icon );
         $i++;
      }
   }

   $oldset['titles'] = 1;
   $oldset['title_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ipb21.php'>";
}

else if( $_GET['action'] == 'forums' )
{
   $qsf->db->query( "TRUNCATE %pforums" );
   $result = $oldboard->db->query( "SELECT * FROM %pforums" );
   $i = 0;

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['name'] = strip_ipb21_tags( $row['name'] );
      $row['description'] = strip_ipb21_tags( $row['description'] );

      if( $row['sub_can_post'] == 0 && $row['parent_id'] > 0 )
         $subcat = 1;
      else
         $subcat = 0;

      $qsf->db->query( "INSERT INTO %pforums VALUES( %d, %d, '', '%s', %d, '%s', %d, %d, %d, %d )",
         $row['id'], $row['parent_id'], $row['name'], $row['position'], $row['description'], $row['topics'], $row['posts'], $row['last_post'], $subcat );
      $i++;
   }

   $oldset['forums'] = 1;
   $oldset['forum_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ipb21.php'>";
}

else if( $_GET['action'] == 'topics' )
{
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

      $row['title'] = strip_ipb21_tags( $row['title'] );
      $row['description'] = strip_ipb21_tags( $row['description'] );

      $qsf->db->query( "INSERT INTO %ptopics VALUES( %d, %d, '%s', '%s', %d, 0, %d, '', %d, %d, %d, %d, 0, '' )",
         $row['tid'], $row['forum_id'], $row['title'], $row['description'], $row['starter_id'], $row['last_poster_id'], $row['last_post'], $row['posts'], $row['views'], $topic_modes );
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

      $expire = time() + 2592000;
      $qsf->db->query( "INSERT INTO %psubscriptions VALUES( %d, %d, 'forum', %d, %d )", $row['frid'], $row['member_id'], $row['forum_id'], $expire );
      if( $row['frid'] > $frows )
         $frows = $row['frid'];
   }

   $result = $oldboard->db->query( "SELECT * FROM %ptracker" );
   while( $row = $oldboard->db->nqfetch($result) )
   {
      $row['member_id']++;

      $lineid = $row['trid'] + $frows;
      $expire = time() + 2592000;
      $qsf->db->query( "INSERT INTO %psubscriptions VALUES( %d, %d, 'topic', %d, %d )", $lineid, $row['member_id'], $row['topic_id'], $expire );
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
      $qsf->db->query( "INSERT INTO %pvotes VALUES( %d, %d, '' )", $row['member_id'], $row['tid'] );
   }

   $oldset['polls'] = 1;
   $oldset['poll_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ipb21.php'>";
}

else if( $_GET['action'] == 'attach' )
{
   $qsf->db->query( "TRUNCATE %pattach" );
   $result = $oldboard->db->query( "SELECT * FROM %pattachments" );
   $i = 0;

   while( $row = $oldboard->db->nqfetch($result) )
   {
      $qsf->db->query( "INSERT INTO %pattach VALUES( %d, '%s', '%s', %d, %d, %d )",
         $row['attach_id'], $row['attach_location'], $row['attach_file'], $row['attach_pid'], $row['attach_hits'], $row['attach_filesize'] );
      $i++;
   }

   $oldset['attach'] = 1;
   $oldset['attach_count'] = $i;
   write_olddb_sets( $oldset );
   echo "<meta http-equiv='Refresh' content='0;URL=convert_ipb21.php'>";
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
      $row['post'] = strip_ipb21_tags( $row['post'] );

      $qsf->db->query( "INSERT INTO %pposts VALUES( %d, %d, %d, %d, 1, 1, '%s', %d, '', INET_ATON('%s'), '%s', %d )",
         $row['pid'], $row['topic_id'], $row['author_id'], $row['use_emo'], $row['post'], $row['post_date'], $row['ip_address'], $row['edit_name'], $row['edit_time'] );
      $i++;
   }
   if( $i == $all )
   {
      $oldset['posts'] = 2;
      $oldset['post_count'] = $i;
      $oldset['converted'] = 2;
      write_olddb_sets( $oldset );
      echo "<meta http-equiv='Refresh' content='0;URL=convert_ipb21.php'>";
   }
   else
   {
      $oldset['posts'] = 1;
      $oldset['post_count'] = $i;
      write_olddb_sets( $oldset );
      echo "<meta http-equiv='Refresh' content='0;URL=convert_ipb21.php'>";
   }
}
?>
