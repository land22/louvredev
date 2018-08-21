<?php
namespace LW\LouvreBundle\Services;
class SendOrders{
   
	private $mailer;

	public function __construct(\Swift_Mailer $mailer)
	{
	    $this->mailer    = $mailer;
	}


	public function sendOrders($booking)
	{

		$message = new \Swift_Message('Les-reservations');
		$html = '<html>' .
		' <body>' .
		'  <h2>MUSEE DU LOUVRE</h2> <img src="' .
		     $message->embed(\Swift_Image::fromPath('assets/images/logo_louvre.png')) .
		   '" alt="Logo musée du louvre" />' .
		'  <p>Vous avez reservé pour la date du : <strong>' .$booking->getVisiteDate()->format('d-m-Y').'</strong></p>' .
		'  <p>Qui vous a couté : <strong>'.$booking->getPrice().'€ </strong></p>' .
		'  <p>Le code de reservation est le suivant: <strong>'.$booking->getCodeReservation().'</strong></p>' .
		'  <p> <strong> Liste des noms et prenoms vous avez choisi :</strong></p>'.
		'  <ul>';
         
        foreach ($booking->getTickets() as $value)
		{ 
		  $html .= '<li>'.$value->getFirstname() .' '.$value->getLastname() .'</li>';
		}  
        
          $html .= '</ul>'.
		'<p>Merci pour votre reservation !!!</p>'.
		' </body>' .
		'</html>';
            $message->setFrom('landrywabo8@gmail.com');
            $message->setTo($booking->getEmail());
            $message->setSubject('Informations de reservation pour le musée du louvre');
            $message->setBody($html,'text/html');
            

        $this->mailer->send($message);
	}

	  	
}