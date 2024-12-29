<?php
/**
 * QSF Portal
 * Copyright (c) 2006-2025 The QSF Portal Development Team
 * https://github.com/Arthmoor/QSF-Portal
 *
 * Based on:
 *
 * Quicksilver Forums
 * Copyright (c) 2005-2011 The Quicksilver Forums Development Team
 * https://github.com/Arthmoor/Quicksilver-Forums
 *
 * MercuryBoard
 * Copyright (c) 2001-2006 The Mercury Development Team
 * https://github.com/markelliot/MercuryBoard
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

if( !defined( 'QUICKSILVERFORUMS' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	die;
}

/**
 * A simple class that makes good use of the mail() function.
 *
 * @author Daniel Wilhelm II Murdoch <wilhelm@cyberxtreme.org>
 * @since RC1
 **/
class mailer
{
	private $sender;      // Name to be displayed in From field. @access private @var string
	private $outgoing;    // Outgoing email address @access private @var string
	private $incoming;    // Incoming email address @access private @var string
	private $text;        // Email body @access private @var string
	private $subject;     // Email Subject @access private @var string
	private $mail_server; // Mail Server @access private @var string
	private $list;        // Formatted Bcc list @access private @var string
	private $recipient;   // Recipient for single send mode @access private @var string
	private $bcc;         // Blind Carbon Copy recipients @access private @var array
	private $headers;     // Headers to be used for email @access private @var array
	private $html;        // Determines whether message will be sent in HTML format. @access private @var boolean

	/**
	 * This initializes instance variables / objects.
	 *
	 * @author Daniel Wilhelm II Murdoch <wilhelm@cyberxtreme.org>
	 * @since RC1
	 * @return void
	 **/
	public function __construct( $in, $out, $sender, $html )
	{
		$this->outgoing = $out;
		$this->incoming = $in;
		$this->sender   = $sender;
		$this->html     = false;

		$this->mail_server = 'localhost';
		$this->recipient = '';
		$this->text      = '';
		$this->subject   = '';
		$this->list      = '';

		$this->bcc     = array();
		$this->headers = array();
	}

	/**
	 * Adds a new recipient to Bcc.
	 *
	 * @param string $email User's email
	 * @author Daniel Wilhelm II Murdoch <wilhelm@cyberxtreme.org>
	 * @since RC1
	 * @return void
	 **/
	public function setBcc( $email )
	{
		$this->bcc[] = $email;
	}

	/**
	 * Builds the Bcc list and assigns the corresponding header.
	 *
	 * @author Daniel Wilhelm II Murdoch <wilhelm@cyberxtreme.org>
	 * @since RC1
	 * @return boolean true if bcc recipients exist
	 **/
	private function doBcc()
	{
		if( !$this->bcc ) {
			return false;
		}

		$this->list .= implode( ', ', $this->bcc );
		$this->setHeader( 'Bcc: ' . $this->list );

		return true;
	}

	/**
	 * Sets a recipient for single send mode.
	 *
	 * @param string $recipient Email address
	 * @author Daniel Wilhelm II Murdoch <wilhelm@cyberxtreme.org>
	 * @since RC1
	 * @return void
	 **/
	public function setRecipient( $recipient )
	{
		$this->recipient = $recipient;
	}

	/**
	 * Sets the email's subject
	 *
	 * @param string $subject Email Subject
	 * @author Daniel Wilhelm II Murdoch <wilhelm@cyberxtreme.org>
	 * @since RC1
	 * @return void
	 **/
	public function setSubject( $subject )
	{
		// Basic security check
		$subject = str_replace( array( "\n", "\r" ), array( ' ', ' ' ), $subject );
		$this->subject = $subject;
	}

	/**
	 * Sets the email's message body
	 *
	 * @param string $subject Email Subject
	 * @author Daniel Wilhelm II Murdoch <wilhelm@cyberxtreme.org>
	 * @since RC1
	 * @return void
	 **/
	public function setMessage( $message )
	{
		$this->text = $message;
	}

	/**
	 * Adds a key / value to the current list of headers.
	 *
	 * @param string $header New header
	 * @author Daniel Wilhelm II Murdoch <wilhelm@cyberxtreme.org>
	 * @since RC1
	 * @return void
	 **/
	public function setHeader( $header )
	{
		// Basic security check
		$header = str_replace( array( "\n", "\r" ), array( ' ', ' ' ), $header );
		$this->headers[] = $header;
	}

	/**
	 * Changes the SMTP mail server
	 *
	 * @param string $server Mail Server
	 * @author Jason Warner <jason@mercuryboard.com>
	 * @since RC1
	 * @return void
	 **/
	public function setServer( $server )
	{
		$this->mail_server = $server;
	}

	/**
	 * Build the email message and send it off!
	 *
	 * @author Daniel Wilhelm II Murdoch <wilhelm@cyberxtreme.org>
	 * @since RC1
	 * @return boolean true on success
	 **/
	public function doSend()
	{
		if ( !strlen( $this->subject ) ) {
			return false;
		}

		$this->setHeader( 'From: ' . $this->sender . ' <' . $this->outgoing . '>' );
		$this->setHeader( 'Reply-To: ' . $this->incoming );

		if( !strlen( $this->recipient ) ) {
			$this->doBcc();

			$to = $this->sender . ' <' . $this->outgoing . '>';
		} else {
			$to = $this->recipient;
		}

		if( $this->mail_server ) {
			@ini_set( 'SMTP', $this->mail_server );
		}

		if( mail( $to, $this->subject, $this->text, implode( "\n", $this->headers ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}
?>