<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2015 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
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
 * Generate front page news items
 *
 * @author Roger Libiez [Samson] 
 * @since 1.2.2
 **/
class news extends modlet
{
	/**
	* Display the last 5 posted news items on the front page
	*
	* @param string $param unusued
	* @author Roger Libiez [Samson] 
	* @since 1.2.2
	* @return string HTML with last 5 news items posted
	**/
	function run($param)
	{
		$args = func_get_args();
		$this->qsf->lang->news();

		foreach( $args as $k => $v )
			$args[$k] = intval($v);
		return $this->getposts( implode( ',', $args ) );
	}

	function getposts( $forums )
	{
		$items = "";

		$result = $this->qsf->db->query(
		  "SELECT t.*, u.user_name, p.post_author, p.post_text, p.post_mbcode, p.post_emoticons
		    FROM %ptopics t
		    LEFT JOIN %pposts p ON p.post_topic=t.topic_id
		    LEFT JOIN %pusers u ON u.user_id=p.post_author
		    WHERE topic_forum IN ($forums) GROUP BY t.topic_id ORDER BY t.topic_posted DESC" );

		// Display the first 5 news posts in the normal boxes.
		$x = 0;
		while( $row = $this->qsf->db->nqfetch($result) )
		{
			$params = FORMAT_HTMLCHARS | FORMAT_BREAKS | FORMAT_CENSOR;
			if ($row['post_mbcode']) {
				$params |= FORMAT_MBCODE;
			}
			if ($row['post_emoticons']) {
				$params |= FORMAT_EMOTICONS;
			}

			$topic = $row['topic_title'];
			$uid = $row['post_author'];
			$user = $row['user_name'];
			$date = $this->qsf->mbdate( DATE_LONG, $row['topic_posted'] );
			$text = $this->qsf->format($row['post_text'], $params);

			$pos = strrpos( $text, "[more]" );

			if( $pos !== false ) {
				$text = substr( $text, 0, $pos );
				$text .= "<span style=\"white-space:nowrap\">( <a href=\"{$this->qsf->self}?a=newspost&amp;t={$row['topic_id']}\">{$this->qsf->lang->news_more}</a> )</span>";
			}

			$comments = "<a href=\"{$this->qsf->self}?a=newspost&amp;t={$row['topic_id']}\">{$row['topic_replies']} {$this->qsf->lang->news_comments}</a>";
			$items .= eval($this->qsf->template('MAIN_NEWS_ITEM'));

			if( ++$x == 5 )
				break;
		}

		// Make simple links to the rest.
		if( $x == 5 ) {
			$items .= "<select class=\"select\" onchange=\"get_newspost(this,'{$this->qsf->self}')\">";
			$items .= "<option value=\"\">{$this->qsf->lang->news_previous}</option>";
			while( $row = $this->qsf->db->nqfetch($result) )
			{
				$items .= "<option value=\"{$row['topic_id']}\">{$row['topic_title']}</option>";
			}
			$items .= "</select>";
		}
		return $items;
	}
}
?>