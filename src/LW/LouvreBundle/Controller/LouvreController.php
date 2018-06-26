<?php

namespace LW\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use LW\LouvreBundle\Entity\Orders;
use LW\LouvreBundle\Form\OrdersType;

// Importation des fichiers de stripe
require('stripe/init.php');
use \stripe\Stripe;
use \stripe\Subscription;
use \stripe\Customer;
use \stripe\Charge;

class LouvreController extends Controller
{
    public function indexAction()
    {
        return $this->render('LWLouvreBundle:Louvre:index.html.twig');
    }

    public function billeterieAction(Request $request)
    {
                // on va générer notre formulaire
        $booking = new Orders();
        $form = $this->get('form.factory')->create(OrdersType::class, $booking);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                echo"<pre>";
              var_dump($form->getData());
              die();
            } 
        }
         return $this->render('LWLouvreBundle:Louvre:billeterie.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function stripe_payAction(Request $request)
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
         \stripe\Stripe::setApiKey("sk_test_MgZ8tjk4OcFvwrkTCP9NHmji");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
         $token = $request->request->get('stripeToken');
                $charge = \Stripe\Charge::create([
            'amount' => 999,
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
             ]);


                // on va générer notre formulaire
         return $this->render('LWLouvreBundle:Louvre:stripe_pay.html.twig');
    }
}
