<?php
namespace LW\LouvreBundle\tarifDate;



class LWtarifDate{
   /**
   * Vérifie si le texte est un spam ou non
   *
   * @param date $date
   * @return int $tarif
   */
	  public function tarif($date) {
	  	$current_date = new \DateTime('now');
	  	

	  	$age = $current_date->diff($date, true)->y;

	  	//cas pour tarif normal
	  	 if ($age >= 12 && $age < 60) {
	  	 	$tarif = 16;
	  	 }
	  	 //cas pour tarif enfant 
	  	 if ($age >= 4 && $age < 12 ) {
	  	 	$tarif = 8;
	  	 }
	  	 //cas pour tarif senior
	  	 if ($age >= 20) {
	  	 	$tarif = 12;
	  	 }
	  	 //cas pour tarif enfant (tout petit)
	  	 if ($age < 4 ) {
	  	 	$tarif = 0;
	  	 }

	  	 return $tarif;

	  }
}