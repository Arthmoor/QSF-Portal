<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2010 The QSF Portal Development Team
 * http://www.qsfportal.com/
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2008 The Quicksilver Forums Development Team
 * http://www.quicksilverforums.com/
 * 
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 * http://www.mercuryboard.com/
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

// This file defines the emoticons for the Ashlander 3 skin.

// Left side = Text to replace. Ex: ":alien:" would be what the user types in.
// Right side = Image file to replace the text with. Ex: ":alien:" turns into alien.gif.
// Alt text is not necessary, so if you don't want it, make it blank, like so: alt=""
// All graphic files must go into http://yoururl.com/skins/Default/emoticons/

$this->emotes['click_replacement'][':alien:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/alien.gif" alt=":alien:" />';
$this->emotes['click_replacement'][':biggrin:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/biggrin.gif" alt=":biggrin:" />';
$this->emotes['click_replacement'][':blues:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/blues.gif" alt=":blues:" />';
$this->emotes['click_replacement'][':cool:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/cool.gif" alt=":cool:" />';
$this->emotes['click_replacement'][':cry:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/cry.gif" alt=":cry:" />';
$this->emotes['click_replacement'][':cyclops:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/cyclops.gif" alt=":cyclops:" />';
$this->emotes['click_replacement'][':devil:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/devil.gif" alt=":devil:" />';
$this->emotes['click_replacement'][':evil:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/evil.gif" alt=":evil:" />';
$this->emotes['click_replacement'][':ghostface:']	= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/ghostface.gif" alt=":ghostface:" />';
$this->emotes['click_replacement'][':grinning:']	= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/grinning.gif" alt=":grinning:" />';
$this->emotes['click_replacement'][':lol:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/lol.gif" alt=":lol:" />';
$this->emotes['click_replacement'][':mad:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/mad.gif" alt=":mad:" />';
$this->emotes['click_replacement'][':redface:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/redface.gif" alt=":redface:" />';
$this->emotes['click_replacement'][':robot:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/robot.gif" alt=":robot:" />';
$this->emotes['click_replacement'][':rolleyes:']	= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/rolleyes.gif" alt=":rolleyes:" />';
$this->emotes['click_replacement'][':sad:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/sad.gif" alt=":sad:" />';
$this->emotes['click_replacement'][':smile:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/smile.gif" alt=":smile:" />';
$this->emotes['click_replacement'][':stare:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/stare.gif" alt=":stare:" />';
$this->emotes['click_replacement'][':surprised:']	= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/surprised.gif" alt=":surprised:" />';
$this->emotes['click_replacement'][':thinking:']	= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/thinking.gif" alt=":thinking:" />';
$this->emotes['click_replacement'][':tongue:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/tongue.gif" alt=":tongue:" />';
$this->emotes['click_replacement'][':unclesam:']	= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/unclesam.gif" alt=":unclesam:" />';
$this->emotes['click_replacement'][':wink:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/wink.gif" alt=":wink:" />';
$this->emotes['click_replacement'][':huh:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/huh.gif" alt=":huh:" />';
$this->emotes['click_replacement'][':blink:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/blink.gif" alt=":blink:" />';
$this->emotes['click_replacement'][':facepalm:']	= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/facepalm.gif" alt=":facepalm:" />';
$this->emotes['click_replacement'][':whistle:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/whistle.gif" alt=":whistle:" />';
$this->emotes['click_replacement'][':sick:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/sick.gif" alt=":sick:" />';
$this->emotes['click_replacement'][':headbang:']	= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/headbang.gif" alt=":headbang:" />';
$this->emotes['click_replacement'][':innocent:']	= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/innocent.png" alt=":innocent:" />';
$this->emotes['click_replacement'][':crazy:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/crazy.gif" alt=":crazy:" />';
$this->emotes['click_replacement'][':shrug:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/shrug.gif" alt=":shrug:" />';
$this->emotes['click_replacement'][':ninja:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/ninja.gif" alt=":ninja:" />';
$this->emotes['click_replacement'][':nuke:']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/nuke.gif" alt=":nuke:" />';

// Put emoticon replacements that aren't clickable here. They will still be replaced if the user types them in manually.

$this->emotes['replacement'][':)']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/smile.gif" alt=":)" />';
$this->emotes['replacement'][':(']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/sad.gif" alt=":(" />';
$this->emotes['replacement'][':P']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/tongue.gif" alt=":P" />';
$this->emotes['replacement'][';)']		= '<img src="' . $this->settings['loc_of_board'] . 'skins/' . $this->skin . '/emoticons/wink.gif" alt=";)" />';

?>