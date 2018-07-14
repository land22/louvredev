<?php 
namespace LW\LouvreBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use LW\LouvreBundle\Entity\Orders;
use LW\LouvreBundle\Entity\Ticket;
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
              $serviceTarifDate = $this->container->get('lw_louvre.tarifDate');
              $serviceTarifDate->calculTarif($booking);
                /*echo"<pre>";
              echo "<br />";
               
              die();*/
             $session = $request->getSession();
              $session->set('booking', $booking);
              return $this->redirectToRoute('lw_louvre_stripe_pay');
              
            } 
        }
         return $this->render('LWLouvreBundle:Louvre:billeterie.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function avaibleDateAction(){
         /* $repository = $this
              ->getDoctrine()
              ->getManager()
              ->getRepository('LWLouvreBundle:Ticket');
          $result = $repository->find(1);*/
          
          $current_date = date("Y-m-d");
          $checkdate = $this->container->get('lw_louvre.checkdate');
            $result = $checkdate->bnrBillet($current_date);

                echo"<pre>";
              echo "<br />";
           // foreach ($result as $value) {
              var_dump($current_date);
           // }
              
              die();
    }

    public function stripe_payAction(Request $request)
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
       /* \stripe\Stripe::setApiKey("sk_test_MgZ8tjk4OcFvwrkTCP9NHmji");
        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->request->get('stripeToken');
                $charge = \Stripe\Charge::create([
            'amount' => 999,
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
             ]);*/
                // on va générer notre formulaire
         return $this->render('LWLouvreBundle:Louvre:stripe_pay.html.twig');
          /*$tarif_fnt = $this->container->get('lw_louvre.checkdate');
          $date = "2018-05-05";
          $total = $tarif_fnt->bnrBillet($date);
                echo"<pre>";
              echo "<br />";
              var_dump($total);
              die();*/
    }
}