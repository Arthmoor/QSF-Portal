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

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

require_once $set['include_path'] . '/lib/htmltools.php';

/**
 * Represents a node or an element in the DOM tree
 *
 * @author Matthew Lawrence <matt@quicksilverforums.co.uk>
 * @author Davion <http://forums.quicksilverforums.com/index.php?a=pm&s=send&to=389>
 * @since 1.3.2
 **/
class node
{
	var $type;	// What type of node it is, this is taken from between the [] brackets [li] would become 'li'
	var $attribute;	// Holds the elements attribute if it exists; [element=value][/element] would be 'value'
	var $text;	// The textual contents that exists between opening and closing elements
	var $children;	// Array of child nodes
	var $parent;	// The parent node of this instance

	/**
	 * Constructor
	 *
	 * @param string $type The type of node this instance represents
	 * @param string $text The contents of a text node
	 * @param string $attribute The attribute of the opening tag if it exists
	 * @param node $parent The parent node of the current instance
	 **/
	function node( $type, $text = null, $attribute = null, &$parent )
	{
		$this->type = $type ? htmlentities($type) : $type;
		$this->attribute = $attribute ? htmlentities($attribute) : $attribute;
		$this->text = $text;
		$this->children = null;
		$this->parent = &$parent;
	}
}

/**
 * BB Code formatter
 *
 * @author Matthew Lawrence <matt@quicksilverforums.co.uk>
 * @author Davion <http://forums.quicksilverforums.com/index.php?a=pm&s=send&to=389>
 * @since 1.2
 **/
class bbcode extends htmltools
{
	var $user_view_emoticons = true;
	
	var $max_url_length = 60;	// Maximum length of a url before applying trimming
	var $line;			// The current line that the parser is on
	var $char;			// The current charater that the parser is on
	var $data;			// The raw post data
	var $stack;			// A stack that records the depth of the tree and the types of the node at each level
	var $root;			// The root node in the DOM-style tree
	var $error;			// Array of errors in order of occurence if any
	var $rejoin;			// Name of the current element that is being processed ( where the end tag re-joins in the stream )
	var $options;                   // Formatting options passed from the format() call.
	var $block_branch = array( 'code', 'php', 'url' ); // Array of elements that we don't create children of
	var $handlers = array(
				'b'	=>	'_process_b',
				'url'	=>	'_process_url',
				'quote' =>	'_process_quote',
				'php'	=>	'_process_php',
				'code'	=>	'_process_code',
				'left' => 	'_process_lrj',
				'right' =>	'_process_lrj',
				'justified' =>	'_process_lrj',
				'center' =>	'_process_lrj',
				'spoiler' =>	'_process_spoiler',
				'u'	=>	'_process_u',
				's'	=>	'_process_s',
				'i'	=>	'_process_i',
				'font'	=>	'_process_font',
				'size'	=>	'_process_size',
				'colour' =>	'_process_colour',
				'color' =>	'_process_colour',
				'email' =>	'_process_email',
				'sub'	=>	'_process_sub',
				'sup'	=>	'_process_sup',
				'indent' =>	'_process_indent',
				'img'	=>	'_process_img',
				'h1'	=>	'_process_h',
				'h2'	=>	'_process_h',
				'h3'	=>	'_process_h',
				'h4'	=>	'_process_h',
				'h5'	=>	'_process_h',
				'h6'	=>	'_process_h',
				'ul'	=>	'_process_ul',
				'li'	=>	'_process_li',
				'youtube' =>	'_process_youtube',
				'gvideo' =>	'_process_google_video',
				'bcove' =>	'_process_brightcove'
				);	// associtive array of an element and of the method to invoke to process the element/node

	/**
	 * Constructor
	 *
	 * @param object $qsf Main action object
	 * @param bool $createChild Weather to create an instance of itself or not.
	 **/
	function bbcode(&$qsf, $createChild = true)
	{
		parent::htmltools($qsf);
		
		$this->user_view_emoticons = $qsf->user['user_view_emoticons'];

		if ($createChild) {
			$this->clone = &new bbcode( $qsf, false );
		}
	}

	/**
	 * Formats a string
	 *
	 * @param string $in Input
	 * @param int $options Options
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 3.0
	 * @return string Formatted string
	 **/
	function format($in, $options = 0)
	{	
		$maxwordsize = 40; // Maximum size a word can get before it's cut into a abbr tag

		if (!$options) {
			$this->options = FORMAT_BREAKS | FORMAT_HTMLCHARS | FORMAT_CENSOR;
		}

		if ($options & FORMAT_CENSOR) {
			if (!$this->replaces_loaded) {
				$this->get_replaces();
			}

			$in = $this->_do_censor($in);
		}

		$strtr = array();

		// Use of FORMAT_MBCODE implies FORMAT_HTMLCHARS otherwise the output could be un-safe.
		if( ($options & FORMAT_HTMLCHARS && !($options & FORMAT_MBCODE) ) ) {
			$in = htmlentities($in, ENT_COMPAT, 'UTF-8');
		}

		if (($options & FORMAT_MBCODE)) {
			$in = $this->_pre_parse_links( $in );
			$this->reset( $in );

			// make sure the class is aware of the current options
			$this->options = $this->clone->options = $options;

			// create the html from the Mbcode
			if ( $this->make_tree() )
			{
				$in = $this->make_html();
			} else {
				$in = $this->make_html();
			}
		}

		if ($options & FORMAT_BREAKS) {
			$strtr["\n"] = "<br />\n";
		}

		// Don't format emoticons if we processing mbcode
		if ($this->user_view_emoticons && ($options & FORMAT_EMOTICONS) && !( $options & FORMAT_MBCODE )) {
			if (!$this->replaces_loaded) {
				$this->get_replaces();
			}

			$strtr = array_merge($strtr, $this->emotes['replacement']);
		} 

		$in = strtr($in, $strtr);

		// FIXME: Hackish workaround.
		// Bug reported: http://forums.quicksilverforums.com/index.php?a=topic&t=1134&p=6784#p6784
		$in = str_replace( "[root]", "", $in );
		$in = str_replace( "[/root]", "", $in );
		return $in;
	}

	/**
	 * Resets the class to a safe initilisation state
	 *
	 * @param string $data The raw post data
	 * @author Matthew Lawrence <matt@quicksilverforums.co.uk> and Davion
	 **/
	function reset( &$data )
	{
		$this->line = 1; // some people like counting at 1...
		$this->char = 1;
		$this->data = &$data;
		$this->stack = array();
		$this->error = array();
		$this->root = null;
		$this->rejoin = null;
		$this->allow_branch = true;
	}

	/**
	 * Preparse text for links and email addresses.
	 * Converts the results into URL and EMAIL tags.
	 *
	 * @param string $in Text to parse
	 * @return string $in with parsing applied.
	 **/
	function _pre_parse_links( $in )
	{
		$parse = array(
			'matches' => array('~(^|\s)([a-z0-9-_.]+@[a-z0-9-.]+\.[a-z0-9-_.]+)~i',
				'~(^|\s)(http|https|ftp)://(\w+[^\s\[\]]+)~ise'),
			'replacements' => array('\\1[email]\\2[/email]',
				'\'\\1[url]\\2://\\3[/url]\'')
		);

		return preg_replace($parse['matches'], $parse['replacements'], $in);
	}

	/**
	 * Builds the DOM-style tree using $this->root as the root node
	 *
	 * @author Matthew Lawrence <matt@quicksilverforums.co.uk> and Davion
	 **/
	function make_tree( )
	{
		$len = strlen( $this->data );
		$this->root = &new node( 'root', null, null, $null );
		$curser = &$this->root;
		$last_node = -1;

		for ( $ix=0; $ix<$len; $ix++ )
		{
			/* update the stats */
			$this->char++;

			if ("\n" === $this->data{$ix}) {
				$this->char = 1;
				$this->line++;
			}

			/* look for the start of a tag/element */
			if ( '[' === $this->data{$ix} ) {
				$temp = $this->_find_endof_tag( $ix, $len - $ix );

				if ( false == $temp ) {
					$this->error[] = 'Could not find end of tag on line ' . $this->line . ' at charater ' . $this->char;
					continue;
				}

				$element =  $this->_tostring( $ix + 1, $temp );

				/* check for bogus tags like [] or [/] and ignore them */
				$trimed = trim( $element );
				$trim_len = strlen( $trimed );
				if ( 0 == $trim_len || ( 1 == $trim_len && '/' == $trimed{0} ) )
					continue;

				list( $element, $attribute ) = $this->_extract_attribute( $element );
				$element = strtolower( $element );

				/* make sure we are allowed to branch */
				if ( !$this->allow_branch && $element !== $this->rejoin )
					continue;
				else
					$this->allow_branch = true;

				// don't allow unknown bbcode
				if ( !array_key_exists( $element, $this->handlers ) )
				{
					// take into account end tags
					if ( ( '/' !== $element{0} && !array_key_exists( substr( $element, 0 ), $this->handlers ) )
					|| ( '/' === $element{0} && !array_key_exists( substr( $element, 1 ), $this->handlers ) ) )
					{
						continue;
					}
				}

				$text = $this->_tostring( $last_node + 1, $ix );

				if ( 0 != strlen( $text ) )
				{
					$__temp = &new node( 'text', $text, null, $curser );
					$curser->children[] = &$__temp;
				}
				unset( $text );

				if ( '/' === $element{0} ) {
					$this->_pop( substr( $element, 1 ) );

					$__temp = &$curser->parent;
					$curser = &$__temp;
				} else {
					if ( false == $this->_push( $element ) )
						return false;

					if ( in_array( $element, $this->block_branch ) ) {
						$this->allow_branch = false;
						$this->rejoin = '/' . $element;
					}

					$__temp = &new node( $element, null, $attribute, $curser );
					$curser->children[] = &$__temp;
					$curser = &$__temp;
				}

				$ix = $temp;
				$last_node = $ix;
			}
		}

		/* check for orphaned opening tags */
		if ( 0 != count( $this->stack ) ) {
			$temp = 'Missing close tag for ' . end( $this->stack ) . '.';
			if ( 1 != count( $this->stack ) )
				$temp .= ' (' . ( count( $this->stack ) - 1 ) . ' More...)';
			$this->error[] = $temp;
		}

		/* append any text after the last tags if needed */
		if ( $last_node !== $ix ) {
			$text = $this->_tostring( $last_node + 1, $ix );

			if ( 0 != strlen( $text ) )
			{
				$__temp = &new node( 'text', $text, null, $curser );
				$curser->children[] = &$__temp;
			}
			unset( $text );
		}

		return true;
	}

	/**
	 * Takes the root node and traverses the DOM tree generated by make_tree() producing formatted XHTML.
	 * This method is recursive.
	 *
	 * @param node $node Do not set this to anything other than $this->root
	 * @author Matthew Lawrence <matt@quicksilverforums.co.uk> and Davion
	 **/
	function make_html( $node = null )
	{
		$node = ($node) ? $node : $this->root;
		$strtr = array();
		$html = null;

		/* handle text as text is special */
		if( 'text' === $node->type )
		{
			/* code blocks are a special case */
			if ( $node->parent && 'php' !== $node->parent->type )
			{
				$node->text = htmlentities( $node->text, ENT_NOQUOTES, 'UTF-8' );
			}

			$__temp = &$node->parent;
			$parent_type = $__temp->type;
			/* turn things into emotes if requested */
			if ($this->user_view_emoticons && ($this->options & FORMAT_EMOTICONS) && !in_array( $parent_type, $this->block_branch ) )
			{
				if (!$this->replaces_loaded)
					$this->get_replaces();

				$strtr = null;
				$strtr = $this->emotes['replacement'];
				$node->text = strtr( $node->text, $strtr );
			}
		
			return str_replace( '  ', '&nbsp; ', $node->text ); 
		}

		/* generate any childs html with */
		if( 0 !== ($count = count( $node->children ) ) ) {
			for( $ix=0; $ix<$count; $ix++ )
				$html .= $this->make_html( $node->children[$ix] );
		}

		$node->text = $html;

		/* bail out early on the root node */
		if ( null === $node->parent )
			return $html;

		/* process the current node */
		if ( isset( $this->handlers[ $node->type ] ) ) {
			$method = $this->handlers[ $node->type ];
			return $this->$method( $node );
		} else {
			return '[' . $node->type . (($node->attribute) ? '=' . htmlentities( $node->attribute ) : null ) . ']' . $html;
		}
	}

	function _get_code_html($lines)
	{
		$height = ($lines * 14) + 14;
		
		$code_html = array();
		$code_html['start_php'] = '<div class="code phpcode"><div class="codetitle">PHP:</div><pre style="height:' . $height . 'px;" class="phpdata">';
		$code_html['start_code'] = '<div class="code"><div class="codetitle">Code:</div><pre style="height:' . $height . 'px;" class="codedata">';
		$code_html['end'] = '</pre></div>';
		return $code_html;
	}

	/**
	 * Formats code with line numbers and optionally syntax highlighting
	 *
	 * PRIVATE
	 *
	 * @param string $input Code to be formatted
	 * @param bool $php True to format as PHP
	 * @param int $start Starting line to count from
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since Beta 2.1
	 * @return string PHP-highlighted string
	 **/
	function _format_code($input, $php, $start = 1)
	{
		if ($php) {
			if( version_compare( PHP_VERSION, "5.0.0", ">=" ) ) {
				$input = html_entity_decode($input, ENT_COMPAT, 'UTF-8'); // contents is html so undo it
			}

			if (strpos($input, '<?') === false) {
				$input  = '<?php ' . $input . '?>';
				$tagged = true;
			}

			ob_start();

			@highlight_string($input);
			$input = ob_get_contents();

			ob_end_clean();
			// Replace php4 font tags with span tags
			$input = preg_replace('/<font color="#([0-9A-F]+)">/', '<span style="color: #$1">', $input);
			$input = preg_replace('/<\/font>/', '</span>', $input);
			// Trim pointless space
			$input = preg_replace('/^<code><span style="color: #000000">\s(.+)\s<\/span>\s<\/code>$/', '<span style="color: #000000">$1</span>', $input);
		}

		if (isset($tagged)) {
			$input = str_replace(array('&lt;?php&nbsp;', '?&gt;'), '', $input);
		}
		
		if ($php) {
			$lines = explode('<br />', $input);
		} else {
			$lines = explode("\n", $input);
		}
		$count = count($lines);

		$col1 = '';
		$col2 = '';

		for ($i = 0; $i < $count; $i++)
		{
			$col1 .= $start . "\n";
			$col2 .= $lines[$i];
			$start++;
		}
		
		$codehtml = $this->_get_code_html($count);

		$return = '';
		if ($php) {
			$return = $codehtml['start_php'];
		} else {
			$return = $codehtml['start_code'];
		}
		$return .= $col2;
		$return .= $codehtml['end'];

		return $return;
	}

	function _process_code(&$node)
	{
		return $this->_format_code($node->text, false);
	}

	function _process_php(&$node)
	{
		return $this->_format_code($node->text, true);
	}

	function _process_img(&$node)
	{
		return '<img src="' . htmlentities($node->text) . '" alt="' . htmlentities($node->text) . '" />';
	}
	
	function _process_b(&$node)
	{
		return '<strong>' . $node->text . '</strong>';
	}

	function _process_i(&$node)
	{
		return '<em>' . $node->text . '</em>';
	}

	function _process_h(&$node)
	{
		return '<'.$node->type.'>'.$node->text.'</'.$node->type.'>';
	}

	function _process_ul(&$node)
	{
		return '<ul>'.$node->text.'</ul>';
	}

	function _process_li(&$node)
	{
		return '<li>'.$node->text.'</li>';
	}

	function _process_u(&$node)
	{
		return '<span style="text-decoration:underline;">'. $node->text . '</span>';
	}

	function _process_s(&$node)
	{
		return '<span style="text-decoration:line-through;">'. $node->text .'</span>';
	}

	function _process_sup(&$node)
	{
		return '<sup>'.$node->text.'</sup>';
	}

	function _process_sub(&$node)
	{
		return '<sub>'.$node->text.'</sub>';
	}

	function _process_indent(&$node)
	{
		return '<p style="text-indent:2em">'.$node->text.'</p>';
	}

	function _process_email(&$node)
	{
		$addr = $node->text;

		if($node->attribute) {
			$addr = $node->attribute;
			$node->text = htmlentities($node->text);
		}

		if(strpos($addr, '@') === false || strpos($addr, '.') == false )
			return '[email]' . $node->text . '[\email]';

		return '<a href="mailto:' . $addr . '">'. $node->text . '</a>';
	}

	function _process_lrj(&$node)
	{
		return '<p style="text-align:'.$node->type.'">'.$node->text.'</p>';
	}

	function _process_colour(&$node)
	{
		return '<span style="color:'.$node->attribute.'">'.$node->text.'</span>';
	}

	function _process_font(&$node)
	{
		return '<span style="font-family:'.$node->attribute.'">'.$node->text.'</span>';
	}

	function _process_size(&$node)
	{
		return '<span style="font-size:'.$node->attribute.'ex">'.$node->text.'</span>';
	}
	
	function _process_spoiler(&$node)
	{
		return '<div class="spoilerbox"><strong>'.$this->lang->spoiler.':</strong><div class="spoiler">'.$node->text.'</div></div>';
	}
	
	function _process_quote(&$node)
	{
		$quoter = $this->lang->quote.':';
		if( $node->attribute ) {
			$node->attribute = $node->attribute;
			if( strstr($node->attribute,'[url') ) {
				$this->clone->reset( $node->attribute );

				if ( true != $this->clone->make_tree() ) {
					foreach( $qparser->error as $error )
						$this->error[] = $error;
				} else {
					$node->attribute = $this->clone->make_html();
				}
			}
				
			$quoter = $node->attribute;
			$quoter .= ' '.$this->lang->main_said.':';
		}

		return '<div class="quotebox"><strong>' . $quoter . '</strong><div class="quote">' . $node->text . '</div></div>';
	}
	
	function _process_url(&$node)
	{
		if ( $node->attribute )	{
			$url = $node->attribute;
		} else {
			if ( 1 === count( $node->children ) )
				$url = $node->text;
			else
				return '[url]' . $node->text . '[/url]' ;
		}

		return '<a href="' . $url . '">' . $node->text . '</a>';
	}

	function _process_youtube(&$node)
	{
		return '<object width="425" height="350"><param name="movie" value="http://www.youtube.com/v/'.$node->text.'"></param><embed src="http://www.youtube.com/v/'.$node->text.'" type="application/x-shockwave-flash" width="425" height="350"></embed></object>';
	}

	function _process_google_video(&$node)
	{
		return '<embed style="width:400px; height:326px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId='.$node->text.'&amp;hl=en" flashvars=""> </embed>';
	}

	function _process_brightcove(&$node)
	{
		return '<embed src="http://admin.brightcove.com/destination/player/player.swf" bgcolor="#FFFFFF" flashVars="allowFullScreen=true&amp;initVideoId='.$node->text.'&amp;servicesURL=http://services.brightcove.com/services&amp;viewerSecureGatewayURL=https://services.brightcove.com/services/amfgateway&amp;cdnURL=http://admin.brightcove.com&amp;autoStart=false" base="http://admin.brightcove.com" name="bcPlayer" width="486" height="412" allowFullScreen="true" allowScriptAccess="always" seamlesstabbing="false" type="application/x-shockwave-flash" swLiveConnect="true" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></embed>';
	}

	/**
	 * Extracts an attribute from the given element ( if one exists )
	 *
	 * @param string $element The element to try and extract the attribute from
	 * @return array An array, at position 0 the element and at position 1 the attribute (null if not found)
	 **/
	function _extract_attribute($element)
	{
		if( ( $vstart = strpos( $element, '=' ) ) != false )
			return array( substr($element, 0, $vstart), substr($element, $vstart+1) );
		return array( $element, null );
	}

	/**
	 * Searches for the closing of an element up to the given limit taking account of nested brackets
	 *
	 * @param int $position The position to start searching from
	 * @param int $limit The number of charaters to parse before giving up looking for the end of the tag
	 * @return int The position of the closing charater or ERROR on error
	 */
	function _find_endof_tag( $position, $limit = 10 )
	{
		$nest = 0;
		$limit += $position;

		for ( $ix = $position+1; $ix < $limit; $ix++ )
		{
			if ( '[' === $this->data{$ix} )
				++$nest;

			if ( ']' === $this->data{$ix} )	{
				if($nest-- <= 0 )
					return $ix;
			}
		}

		return false;
	}

	/**
	 * Translates two array indexs into a string using the array of the raw data currently being processed
	 *
	 * @param int $from Where to start building the string from
	 * @param int $to Where to terminate the string
	 * @return string The string of all the values between the two given array indexes
	 **/
	function _tostring( $from, $to )
	{
		$string = null;
		for( $ix=$from; $ix<$to; $ix++ )
		{
			$string .= $this->data{$ix};
		}
		return $string;
	}

	/**
	 * Pushes the given item onto the end of the stack
	 *
	 * @param string $item The item to be pushed onto the stack
	 **/
	function _push( $item )
	{
		$this->stack[] = $item;
		return true;
	}

	/**
	 * Removes the last item pushed onto the stack
	 *
	 * @param string $item The textual name of the last item pushed onto the stack, this is used to validate the correct order of elements
	 **/
	function _pop( $item )
	{
		$end = end( $this->stack );
		if ( $end !== $item )
		{
			if ( 0 == strlen( $end ) ) {
				$end = 'N/A';
				$this->error[] = 'Suspected wrong order of tags given, use [' . $item . '][/' . $item . '] and not [/' . $item . '][' . $item . ']';
			}

			$this->error[] = 'Unexpected tag ' . $item . ' found on line ' . $this->line . ' at charater ' . $this->char . ' (expecting ' . $end . ')';
			return false;
		}

		array_pop( $this->stack );

		return true;
	}

	/**
	 * Handle formatting out censored workds
	 *
	 * PROTECTED
	 *
	 * @param string $in Unformatted input
	 * @return string result with censored words replaced
	 **/
	function _do_censor($in)
	{
		if ($this->censor) {
			$in = preg_replace($this->censor, '####', $in);
		}
		return $in;
	}
}
?>
