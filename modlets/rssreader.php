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
 * Generate a nicely formatted result of an RSS feed
 *
 * @author Geoffrey Dunn <quicken@swiftdsl.com.au>
 * @since 1.1.5
 **/
class rssreader extends modlet
{
	/**
	 * Value carries across any calls ot the run method
	 **/
	var $rssFeeds = array();
	
	/**
	 * Cache period
	 **/
	var $cacheFilesFor = DAY_IN_SECONDS;
	
	var $titleTemplate;
	var $itemTemplate;
	var $rssreaderTemplate;
	
	/**
	 * Fetch and display the feed specified in the parameter
	 *
	 * @param string Rss feed URL
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return string HTML with feed results
	 **/
	function run($param)
	{
		if (!function_exists('xml_parser_create')) {
			return "<!-- XML functions not enabled -->";
		}
		if (!isset($this->rssFeeds[$param])) {
			$result = $this->read_URL($param);
			if ($result !== true) {
				return $result;
			}
		}
		$this->load_templates();
		
		// Get the title
		$node = $this->rssFeeds[$param]->GetNodeByPath('RSS/CHANNEL');

		if (!isset($node['child']))
			return null;

		$item = $this->build_array_from_node($node['child']);
		$title = eval($this->titleTemplate);
		
		// Go through each item on the feed
		$nodes = $this->extract_items($node);
		$rssItems = '';
		
		// Build into a nice block
		foreach ($nodes as $node) {
			$item = $this->build_array_from_node($node);
			$rssItems .= eval($this->itemTemplate);
		}
		
		return eval($this->rssreaderTemplate);
	}

	/**
	 * Look through an XML node and process any settings
	 * worth looking at into an associative array
	 *
	 * @param object XML node
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return array associative array
	 **/
	function build_array_from_node($node)
	{
		// Build into a nice block
		$item = array();
		// Set defaults
		$item['description'] = '';
		$item['link'] = '#';
		$item['title'] = 'No Title!';
		
		// Look for settings
		foreach ($node as $value) {
			switch ($value['name']) {
			case 'LINK':
				$item['link'] = htmlspecialchars($value['content']);
				break;
			case 'TITLE':
				$item['title'] = $value['content'];
				break;
			case 'DESCRIPTION':
				if (isset($value['content'])) {
					$item['description'] = htmlspecialchars($value['content']);
				}
				break;
			case 'PUBDATE':
				$item['date'] = $value['content'];
				break;
			}
		}
		return $item;
	}
	
	/**
	 * Look through an XML node pull out an array
	 * of all the item nodes within
	 *
	 * @param object XML node
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return array associative array
	 **/
	function extract_items($node)
	{
		// Build into a nice block
		$items = array();
		foreach ($node['child'] as $value) {
			if ($value['name'] == 'ITEM') {
				$items[] = $value['child'];
			}
		}
		return $items;
	}
	
	/**
	 * Read the RSS from the feed or cache
	 *
	 * @param string Rss feed URL
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 * @return mixed string if error message, true if okay
	 *
	 * @todo Make it read the TTL in the cache file to determine if it
	 *       should get the feed or not
	 **/
	function read_URL($url)
	{
		$this->rssFeeds[$url] = new xmlparser();

		// Check if RSS cache directory exists
		if (!is_dir('../databases/rsscache/')) {
			@mkdir('../databases/rsscache/');
			$this->qsf->chmod('../databases/rsscache', 0777, false);
		}
		
		// Check if the cached file is there
		$cacheFilename = '../databases/rsscache/' . md5($url) . '.xml';
		$maxFileAge = time() - $this->cacheFilesFor;
		if (!file_exists($cacheFilename) || filectime($cacheFilename) < $maxFileAge) {
			// Download the file
			$lines = @file($url);
			if (!$lines) {
				return "<!-- ERROR rssreader could not open $url -->";
			}
			
			// save the file
			$f=@fopen($cacheFilename,"w");

			if ($f) {
				foreach($lines as $line)
				{
				     fputs($f,$line);
				}
				fclose($f);
				$this->qsf->chmod($cacheFilename, 0777, false);
			}
			
			$result = $this->rssFeeds[$url]->parseArray($lines);
			if ($result !== true) {
				// Had an error trying to open the result
				unset($this->rssFeeds[$url]);
				return "<!-- ERROR rssreader $result -->";
			}
		} else {
			// Read the file
			$result = $this->rssFeeds[$url]->parse($cacheFilename);
			if ($result !== true) {
				// Had an error trying to open the result
				unset($this->rssFeeds[$url]);
				return "<!-- ERROR rssreader $result -->";
			}
		}
		return true;
	}
	
	/**
	 * Look at the loaded templates for ones we can use
	 *
	 * @author Geoffrey Dunn <geoff@warmage.com>
	 * @since 1.1.5
	 **/
	function load_templates()
	{
		if ($this->qsf->templater->temp_set(array('MODLET_RSSREADER_TITLE', 'MODLET_RSSREADER_ITEM', 'MODLET_RSSREADER_MAIN'))) {
			$this->titleTemplate = $this->qsf->template('MODLET_RSSREADER_TITLE');
			$this->itemTemplate = $this->qsf->template('MODLET_RSSREADER_ITEM');
			$this->rssreaderTemplate = $this->qsf->template('MODLET_RSSREADER_MAIN');
		} else if ($this->qsf->templater->temp_set(array('MAIN_RSSREADER_TITLE', 'MAIN_RSSREADER_ITEM', 'MAIN_RSSREADER_MAIN'))) {
			$this->titleTemplate = $this->qsf->template('MAIN_RSSREADER_TITLE');
			$this->itemTemplate = $this->qsf->template('MAIN_RSSREADER_ITEM');
			$this->rssreaderTemplate = $this->qsf->template('MAIN_RSSREADER_MAIN');
		} else if ($this->qsf->templater->temp_set(array('ADMIN_RSSREADER_TITLE', 'ADMIN_RSSREADER_ITEM', 'ADMIN_RSSREADER_MAIN'))) {
			$this->titleTemplate = $this->qsf->template('ADMIN_RSSREADER_TITLE');
			$this->itemTemplate = $this->qsf->template('ADMIN_RSSREADER_ITEM');
			$this->rssreaderTemplate = $this->qsf->template('ADMIN_RSSREADER_MAIN');
		} else {
			// Fallback templates
			$this->titleTemplate = 'return "<li class=\"rsstitle\"><a href=\"{$item[\'link\']}\">{$item[\'title\']}</a></li>";';
			$this->itemTemplate = 'return "<li><a href=\"{$item[\'link\']}\" title=\"{$item[\'description\']}\">{$item[\'title\']}</a></li>";';
			$this->rssreaderTemplate = 'return "<ul class=\"rssreader\">{$title}{$rssItems}</ul>";';
		}
	}
}
?>
