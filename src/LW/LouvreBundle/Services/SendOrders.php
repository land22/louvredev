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
		/*$this->mailer->setFrom('landrywabo8@yde-cu.ovh');
        $this->mailer->setTo($booking->getEmail());
        $this->mailer->setSubject('Informations de reservation pour le musée du louvre');*/
		$html = '<html>' .
		' <body>' .
		'  <h2>MUSEE DU LOUVRE</h2> <img src="' .
		     $this->mailer->embed(Swift_Image::fromPath('assets/images/logo_louvre.png')) .
		   '" alt="Logo musée du louvre" />' .
		'  <p>Vous avez reservé pour la date du : <strong>'.$booking->getVisiteDate().'</strong></p>' .
		'  <p>Qui vous a couté : <strong>'.$booking->getPrice().'€ </strong></p>' .
		'  <p>Le code de reservation est le suivant: <strong>'.$booking->getCodeReservation().'</strong></p>' .
		'  <p> <strong> Liste des noms et prenoms vous avez choisi :</strong></p>'.
		'  <ul>';
         
        foreach ($booking->getTickets() as $value)
		{ 
		  $html .= '<li>'.$value->getFirstname() .' '.$value->getLastname() .'</li>';
		}  
        
          



		/*$this->mailer->setBody(
		
		  .'</ul>'.
		'<p>Merci pour votre reservation !!!</p>'.
		' </body>' .
		'</html>',
		  'text/html'
		);*/

      //$this->mailer->send($this->mailer);
	}

	  	
}