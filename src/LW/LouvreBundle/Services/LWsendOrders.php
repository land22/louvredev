<?php
namespace LW\LouvreBundle\Services;
class LWsendOrders{
   
  private $mailer;
  private $locale;

	public function __construct(\Swift_Mailer $mailer, $locale)
	{
	    $this->mailer    = $mailer;
	    $this->locale    = $locale;
	}

	public function sendOrders($booking)
	{

		// Set the body
		$this->mailer->setBody(
		'<html>' .
		' <body>' .
		'  Here is an image <img src="' . // Embed the file
		     $this->mailer->embed(Swift_Image::fromPath('image.png')) .
		   '" alt="Image" />' .
		'  Rest of message' .
		' </body>' .
		'</html>',
		  'text/html' // Mark the content-type as HTML
		);
		// You can embed files from a URL if allow_url_fopen is on in php.ini
		$this->mailer->setBody(
		'<html>' .
		' <body>' .
		'  Here is an image <img src="' .
		     $this->mailer->embed(Swift_Image::fromPath('http://site.tld/logo.png')) .
		   '" alt="Image" />' .
		'  Rest of message' .
		' </body>' .
		'</html>',
		  'text/html'
		);

	}

	  	
	
}