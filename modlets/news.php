<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2007 The QSF Portal Development Team
 * http://www.qsfportal.com/
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
	function getposts( $forum )
	{
		$items = "";

		$result = $this->qsf->db->query(
		  "SELECT t.*, u.user_name, p.post_author, p.post_text, p.post_mbcode, p.post_emoticons
		    FROM %ptopics t
		    LEFT JOIN %pposts p ON p.post_topic=t.topic_id
		    LEFT JOIN %pusers u ON u.user_id=p.post_author
		    WHERE t.topic_forum=%d ORDER BY t.topic_edited DESC LIMIT 5", $forum );

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
			$date = $this->qsf->mbdate( DATE_LONG, $row['topic_edited'] );
			$text = $this->qsf->format($row['post_text'], $params);
			
			$items .= eval($this->qsf->template('MAIN_NEWS_ITEM'));
		}
		return $items;
	}

	function run( $arg )
	{
		$forum = intval( $arg );

		return $this->getposts( $forum );
	}
}
?>
