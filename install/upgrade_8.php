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

if (!defined('INSTALLER')) {
	exit('Use index.php to upgrade.');
}

$need_templates = false;

$queries[] = "UPDATE %ptemplates SET template_html='<p class=\'copyright\'>
  {\$qsf->lang->main_powered} <a href=\'http://www.mercuryboard.com\' class=\'small\'><b>MercuryBoard</b></a> [{\$qsf->version}]<br>
  &copy; 2001-2004 The Mercury Development Team
</p>' WHERE template_name='MAIN_COPYRIGHT'";
$queries[] = "UPDATE %ptemplates SET template_html='<table width=\'95%\' align=\'center\' border=\'0\' cellpadding=\'4\' cellspacing=\'0\'>
  <tr>
    <td align=\'right\'>
      <a href=\'{\$this->self}?a=pm&amp;s=send&amp;re={\$pm[\'pm_id\']}\'><img src=\'./skins/{\$this->skin}/images/message_reply.gif\' border=\'0\' title=\'{\$this->lang->pm_reply}\' alt=\'{\$this->lang->pm_reply}\'></a>
      <a href=\'{\$this->self}?a=pm&amp;s=send\'><img src=\'./skins/{\$this->skin}/images/new_message.gif\' border=\'0\' title=\'{\$this->lang->pm_sendamsg}\' alt=\'{\$this->lang->pm_sendamsg}\'></a>
      <a href=\'{\$this->self}?a=pm&amp;s=delete&amp;m={\$pm[\'pm_id\']}\'><img src=\'./skins/{\$this->skin}/images/delete_message.gif\' border=\'0\' title=\'{\$this->lang->pm_delete}\' alt=\'{\$this->lang->pm_delete}\'></a>
    </td>
  </tr>
</table>

{\$this->table}
  <tr>
    <td colspan=\'2\' class=\'header\'>{\$pm[\'pm_title\']}</td>
  </tr>
<tr>
  <td class=\'tablelight\'>
    <table border=\'0\' width=\'100%\' cellpadding=\'4\' cellspacing=\'0\'>
      <tr>
        <td width=\'20%\' rowspan=\'3\' class=\'tablelight\' valign=\'top\'>
          <b><a href=\'{\$this->self}?a=profile&amp;w={\$pm[\'pm_from\']}\'>{\$pm[\'user_name\']}</a><br>
          {\$pm[\'user_title\']}</b><br><br>
          {\$pm[\'user_avatar\']}
          {\$this->lang->pm_group}: {\$pm[\'group_name\']}<br>
          {\$this->lang->pm_posts}: {\$pm[\'user_posts\']}<br>
          {\$this->lang->pm_joined}: {\$pm[\'user_joined\']}<br><br>
        </td>
      </tr>
      <tr>
        <td width=\'80%\' class=\'tablelight\' valign=\'top\'>
          <span class=\'medium\'>{\$pm[\'pm_message\']}</span>
        </td>
      </tr>
      <tr>
        <td valign=\'bottom\' class=\'tablelight\'>
          <table border=\'0\' cellpadding=\'0\' cellspacing=\'0\' width=\'100%\'>
            <tr>
              <td class=\'tablelight\'><span=\'signature\'>{\$pm[\'user_signature\']}</span><hr noshade size=\'1\'></td>
            </tr>
            <tr>
              <td class=\'tablelight\'>{\$this->lang->pm_sendon} {\$pm[\'pm_time\']}</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td class=\'footer\'>&nbsp;</td>
</tr>
{\$this->etable}

<table width=\'95%\' align=\'center\' border=\'0\' cellpadding=\'4\' cellspacing=\'0\'>
  <tr>
    <td align=\'right\'>
      <a href=\'{\$this->self}?a=pm&amp;s=send&amp;re={\$pm[\'pm_id\']}\'><img src=\'./skins/{\$this->skin}/images/message_reply.gif\' border=\'0\' title=\'{\$this->lang->pm_reply}\' alt=\'{\$this->lang->pm_reply}\'></a>
      <a href=\'{\$this->self}?a=pm&amp;s=send\'><img src=\'./skins/{\$this->skin}/images/new_message.gif\' border=\'0\' title=\'{\$this->lang->pm_sendamsg}\' alt=\'{\$this->lang->pm_sendamsg}\'></a>
      <a href=\'{\$this->self}?a=pm&amp;s=delete&amp;m={\$pm[\'pm_id\']}\'><img src=\'./skins/{\$this->skin}/images/delete_message.gif\' border=\'0\' title=\'{\$this->lang->pm_delete}\' alt=\'{\$this->lang->pm_delete}\'></a>
    </td>
  </tr>
</table>
</table>' WHERE template_name='PM_VIEW'";
$queries[] = "UPDATE %ptemplates SET template_html='{\$this->table}
  <tr>
    <td colspan=\'2\' class=\'header\'>{\$this->lang->profile_view_profile}: {\$profile[\'user_name\']}</td>
  </tr>
  <tr>
    <td width=\'50%\' class=\'subheader\' align=\'center\'>{\$this->lang->profile_contact}</td>
    <td width=\'50%\' class=\'subheader\' align=\'center\'>{\$this->lang->profile_info}</td>
  </tr>
  <tr>
    <td class=\'tablelight\' valign=\'top\'>
      <table border=\'0\' width=\'100%\' cellpadding=\'3\' cellspacing=\'0\'>
        <tr>
          <td width=\'30%\'><b>{\$this->lang->profile_email_address}</b></td>
          <td width=\'70%\'>{\$profile[\'user_email\']}</td>
        </tr>
        <tr>
          <td><b>{\$this->lang->profile_aim_sn}</b></td>
          <td>{\$profile[\'user_aim\']}</td>
        </tr>
        <tr>
          <td><b>{\$this->lang->profile_icq_uin}</b></td>
          <td>{\$profile[\'user_icq\']}</td>
        </tr>
        <tr>
          <td><b>{\$this->lang->profile_yahoo}</b></td>
          <td>{\$profile[\'user_yahoo\']}</td>
        </tr>
        <tr>
          <td><b>{\$this->lang->profile_msn}</b></td>
          <td>{\$profile[\'user_msn\']}</td>
        </tr>
        <tr>
          <td><b>{\$this->lang->profile_pm}</b></td>
          <td>{\$profile[\'user_pm\']}</td>
        </tr>
      </table>
    </td>
    <td class=\'tablelight\' valign=\'top\'>
      <table border=\'0\' width=\'100%\' cellpadding=\'3\' cellspacing=\'0\'>
        <tr>
          <td width=\'30%\'><b>{\$this->lang->profile_member}</b></td>
          <td width=\'70%\'>{\$profile[\'group_name\']}</td>
        </tr>
        <tr>
          <td><b>{\$this->lang->profile_member_title}</b></td>
          <td>{\$profile[\'user_title\']}</td>
        </tr>
        <tr>
          <td><b>{\$this->lang->profile_www}</b></td>
          <td>{\$profile[\'user_homepage\']}</td>
        </tr>
        <tr>
          <td><b>{\$this->lang->profile_bday}</b></td>
          <td>{\$profile[\'user_birthday\']}</td>
        </tr>
        <tr>
          <td><b>{\$this->lang->profile_location}</b></td>
          <td>{\$profile[\'user_location\']}</td>
        </tr>
        <tr>
          <td><b>{\$this->lang->profile_interest}</b></td>
          <td>{\$profile[\'user_interests\']}</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width=\'50%\' class=\'subheader\' align=\'center\'>{\$this->lang->profile_posts}</td>
    <td width=\'50%\' class=\'subheader\' align=\'center\'>{\$this->lang->profile_av_sign}</td>
  </tr>
  <tr>
    <td class=\'tablelight\' valign=\'top\'>
      {\$PostInfo}
    </td>
    <td class=\'tablelight\' valign=\'top\'>
      <table border=\'0\' width=\'100%\' cellpadding=\'3\' cellspacing=\'0\'>
        <tr>
          <td width=\'30%\'><b>{\$this->lang->profile_avatar}</b></td>
          <td width=\'70%\'>{\$profile[\'user_avatar\']}</td>
        </tr>
        <tr>
          <td colspan=\'2\'><hr noshade size=\'1\'></td>
        </tr>
        <tr>
          <td><b>{\$this->lang->profile_signature}</b></td>
          <td>{\$profile[\'user_signature\']}</td>
        </tr>
      </table>
    </td>
  </tr>
{\$this->etable}' WHERE template_name='PROFILE_MAIN'";

$queries[] = "DELETE FROM %pactive";
$queries[] = "ALTER TABLE %pactive ADD active_session varchar(32) NOT NULL default '',
DROP PRIMARY KEY,
ADD UNIQUE KEY active_session (active_session),
ADD UNIQUE KEY active_ip (active_ip)";

$queries[] = "ALTER TABLE %pgroups
MODIFY group_format varchar(255) NOT NULL default '%%s',
ADD group_perms text NOT NULL";

$queries[] = "DROP TABLE IF EXISTS %pperms";

$queries[] = "ALTER TABLE %pusers ADD user_perms text NOT NULL AFTER user_view_emoticons";

$queries[] = "UPDATE %pgroups SET group_perms='a:34:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:1;s:11:\"do_anything\";b:1;s:8:\"is_admin\";b:1;s:9:\"email_use\";b:1;s:10:\"forum_view\";b:1;s:11:\"post_viewip\";b:1;s:10:\"topic_view\";b:1;s:11:\"poll_create\";b:1;s:9:\"poll_vote\";b:1;s:11:\"post_create\";b:1;s:12:\"topic_create\";b:1;s:12:\"post_noflood\";b:1;s:11:\"post_delete\";b:1;s:15:\"post_delete_own\";b:1;s:12:\"topic_delete\";b:1;s:16:\"topic_delete_own\";b:1;s:9:\"post_edit\";b:1;s:13:\"post_edit_own\";b:1;s:10:\"topic_edit\";b:1;s:14:\"topic_edit_own\";b:1;s:10:\"topic_lock\";b:1;s:14:\"topic_lock_own\";b:1;s:12:\"topic_unlock\";b:1;s:16:\"topic_unlock_mod\";b:1;s:16:\"topic_unlock_own\";b:1;s:9:\"topic_pin\";b:1;s:13:\"topic_pin_own\";b:1;s:11:\"topic_unpin\";b:1;s:15:\"topic_unpin_own\";b:1;s:10:\"topic_move\";b:1;s:14:\"topic_move_own\";b:1;s:11:\"post_attach\";b:1;s:20:\"post_attach_download\";b:1;}' WHERE group_id=1";
$queries[] = "UPDATE %pgroups SET group_perms='a:34:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:1;s:8:\"is_admin\";b:0;s:9:\"email_use\";b:1;s:10:\"forum_view\";b:1;s:11:\"post_viewip\";b:0;s:10:\"topic_view\";b:1;s:11:\"poll_create\";b:1;s:9:\"poll_vote\";b:1;s:11:\"post_create\";b:1;s:12:\"topic_create\";b:1;s:12:\"post_noflood\";b:0;s:11:\"post_delete\";b:0;s:15:\"post_delete_own\";b:1;s:12:\"topic_delete\";b:0;s:16:\"topic_delete_own\";b:1;s:9:\"post_edit\";b:0;s:13:\"post_edit_own\";b:1;s:10:\"topic_edit\";b:0;s:14:\"topic_edit_own\";b:1;s:10:\"topic_lock\";b:0;s:14:\"topic_lock_own\";b:1;s:12:\"topic_unlock\";b:0;s:16:\"topic_unlock_mod\";b:0;s:16:\"topic_unlock_own\";b:1;s:9:\"topic_pin\";b:0;s:13:\"topic_pin_own\";b:0;s:11:\"topic_unpin\";b:0;s:15:\"topic_unpin_own\";b:1;s:10:\"topic_move\";b:0;s:14:\"topic_move_own\";b:1;s:11:\"post_attach\";b:1;s:20:\"post_attach_download\";b:1;}' WHERE group_id=2";
$queries[] = "UPDATE %pgroups SET group_perms='a:34:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:1;s:8:\"is_admin\";b:0;s:9:\"email_use\";b:0;s:10:\"forum_view\";b:1;s:11:\"post_viewip\";b:0;s:10:\"topic_view\";b:1;s:11:\"poll_create\";b:0;s:9:\"poll_vote\";b:1;s:11:\"post_create\";b:0;s:12:\"topic_create\";b:0;s:12:\"post_noflood\";b:0;s:11:\"post_delete\";b:0;s:15:\"post_delete_own\";b:0;s:12:\"topic_delete\";b:0;s:16:\"topic_delete_own\";b:0;s:9:\"post_edit\";b:0;s:13:\"post_edit_own\";b:0;s:10:\"topic_edit\";b:0;s:14:\"topic_edit_own\";b:0;s:10:\"topic_lock\";b:0;s:14:\"topic_lock_own\";b:0;s:12:\"topic_unlock\";b:0;s:16:\"topic_unlock_mod\";b:0;s:16:\"topic_unlock_own\";b:0;s:9:\"topic_pin\";b:0;s:13:\"topic_pin_own\";b:0;s:11:\"topic_unpin\";b:0;s:15:\"topic_unpin_own\";b:0;s:10:\"topic_move\";b:0;s:14:\"topic_move_own\";b:0;s:11:\"post_attach\";b:0;s:20:\"post_attach_download\";b:0;}' WHERE group_id=3";
$queries[] = "UPDATE %pgroups SET group_perms='a:34:{s:10:\"board_view\";b:0;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:0;s:8:\"is_admin\";b:0;s:9:\"email_use\";b:0;s:10:\"forum_view\";b:0;s:11:\"post_viewip\";b:0;s:10:\"topic_view\";b:0;s:11:\"poll_create\";b:0;s:9:\"poll_vote\";b:0;s:11:\"post_create\";b:0;s:12:\"topic_create\";b:0;s:12:\"post_noflood\";b:0;s:11:\"post_delete\";b:0;s:15:\"post_delete_own\";b:0;s:12:\"topic_delete\";b:0;s:16:\"topic_delete_own\";b:0;s:9:\"post_edit\";b:0;s:13:\"post_edit_own\";b:0;s:10:\"topic_edit\";b:0;s:14:\"topic_edit_own\";b:0;s:10:\"topic_lock\";b:0;s:14:\"topic_lock_own\";b:0;s:12:\"topic_unlock\";b:0;s:16:\"topic_unlock_mod\";b:0;s:16:\"topic_unlock_own\";b:0;s:9:\"topic_pin\";b:0;s:13:\"topic_pin_own\";b:0;s:11:\"topic_unpin\";b:0;s:15:\"topic_unpin_own\";b:0;s:10:\"topic_move\";b:0;s:14:\"topic_move_own\";b:0;s:11:\"post_attach\";b:0;s:20:\"post_attach_download\";b:0;}' WHERE group_id=4";
$queries[] = "UPDATE %pgroups SET group_perms='a:34:{s:10:\"board_view\";b:1;s:17:\"board_view_closed\";b:0;s:11:\"do_anything\";b:1;s:8:\"is_admin\";b:0;s:9:\"email_use\";b:0;s:10:\"forum_view\";b:1;s:11:\"post_viewip\";b:1;s:10:\"topic_view\";b:1;s:11:\"poll_create\";b:0;s:9:\"poll_vote\";b:1;s:11:\"post_create\";b:1;s:12:\"topic_create\";b:0;s:12:\"post_noflood\";b:0;s:11:\"post_delete\";b:0;s:15:\"post_delete_own\";b:0;s:12:\"topic_delete\";b:0;s:16:\"topic_delete_own\";b:0;s:9:\"post_edit\";b:0;s:13:\"post_edit_own\";b:0;s:10:\"topic_edit\";b:0;s:14:\"topic_edit_own\";b:0;s:10:\"topic_lock\";b:0;s:14:\"topic_lock_own\";b:0;s:12:\"topic_unlock\";b:0;s:16:\"topic_unlock_mod\";b:0;s:16:\"topic_unlock_own\";b:0;s:9:\"topic_pin\";b:0;s:13:\"topic_pin_own\";b:0;s:11:\"topic_unpin\";b:0;s:15:\"topic_unpin_own\";b:0;s:10:\"topic_move\";b:0;s:14:\"topic_move_own\";b:0;s:11:\"post_attach\";b:0;s:20:\"post_attach_download\";b:0;}' WHERE group_id=5";

/**
 * To do:
 * Add forums to the group permissions cube
 */

$queries[] = "UPDATE %pusers SET user_email_form=0 WHERE user_id=1";
?>
