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

 if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

/**
 * Generate a link to the PM with a count of unread messages
 *
 * @author Geoffrey Dunn <quicken@swiftdsl.com.au>
 * @since 1.1.5
 **/
class messagelink extends modlet
{
    /**
     *Value carries across any calls ot the run method
     **/
    var $newMessagesCount = false;

    /**
     * Display a link to the message with a count of messages
     *
     * @param string Do we need to display the classname or the text
     * @author Geoffrey Dunn <geoff@warmage.com>
     * @since 1.1.5
     * @return string HTML with hyperlink to pm system
     **/
    function run($param)
    {
        $text = '';
        
        if ($this->newMessagesCount === false) {
            $this->newMessagesCount = $this->qsf->get_messages();
        }
        
        switch($param)
        {
        case 'class':
            if ($this->newMessagesCount > 0) {
                $text = 'navbold';
            } else {
                $text = 'nav';
            }
            break;
        case 'text':
            if ($this->newMessagesCount > 0) {
                $text = " ({$this->newMessagesCount} {$this->qsf->lang->main_new})";
            }
            break;
        default:
            $text = '<!-- ERROR: Invalid paramter: ' . htmlspecialchars($param) . ' passed to modlet messagelink -->';
            break;
        }
        
        return $text;
    }
}
?>
