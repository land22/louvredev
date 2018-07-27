<?php 
namespace LW\LouvreBundle\Services;

class StripeService {
	private $key; 
	public function __construct($key)
	{ 
	 	$this->key = $key; 
	} 
	public function stripePayment($token, $amount) 
	{ 
		\Stripe\Stripe::setApiKey($this->key);

		$charge = \Stripe\Charge::create(
			array( "amount" => $amount*100, 
		           "currency" => "eur", 
		           "source" => $token, 
		           "description" => "Payement Billetterie Louvre" ));
		return $charge;
	}
}