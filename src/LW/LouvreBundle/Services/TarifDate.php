<?php
namespace LW\LouvreBundle\Services;



class TarifDate{
   /**
   * Vérifie si le texte est un spam ou non
   *
   * @param array $booking
   * @return int $somme
   */
	  public function calculTarif($booking) {

	  	$current_date = new \DateTime('now');
	  	$somme = 0;
	  	
	    foreach ($booking->getTickets() as $value) {

	    	//pour les tarifs reduits qui est égal à 10 €

	       if ($value->getReduit() == true )
	       {
	       	$somme = $somme + 10;
	       	$value->setPrice(10);
	       } //end if
	       else {
		         //opération pour trouver l'age d'une personne
			  	$age = $current_date->diff($value->getBirthday(), true)->y;

			  	//cas pour tarif normal avec pour tarif = 16€
			  	 if ($age >= 12 && $age < 60) {
			  	 	$somme = $somme + 16;
			  	 	$value->setPrice(16);
			  	 }
			  	 //cas pour tarif enfant avec pour tarif = 8€
			  	 elseif ($age >= 4 && $age < 12 ) {
			  	 	$somme = $somme + 8;
			  	 	$value->setPrice(8);
			  	 }
			  	 //cas pour tarif senior avec pour tarif = 12€
			  	 elseif ($age >= 20) {
			  	 	$somme = $somme + 12;
			  	 	$value->setPrice(12);
			  	 }
			  	 //cas pour tarif enfant (tout petit) avec pour tarif = 0€
			  	 else {
			  	 	$somme = $somme + 0;
			  	 	$value->setPrice(0);
		  	    }
		  	} //end else

		} //end foreach
      $booking->setPrice($somme);
	}
	
}