<?php
namespace LW\LouvreBundle\Services;
class SendOrders{
   
  private $mailer;
  private $locale;

	public function __construct(\Swift_Mailer $mailer, $locale)
	{
	    $this->mailer    = $mailer;
	    $this->locale    = $locale;
	}

	public function sendOrders($booking)
	{
		$this->mailer->setBody(
		'<html>' .
		' <body>' .
		'  Here is an image <img src="' .
		     $this->mailer->embed(Swift_Image::fromPath('assets/images/logo_louvre.png')) .
		   '" alt="Image" />' .
		'  Rest of message' .
		' </body>' .
		'</html>',
		  'text/html'
		);

	}

	  	
	
}