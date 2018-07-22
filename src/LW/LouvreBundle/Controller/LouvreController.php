<?php 
namespace LW\LouvreBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use LW\LouvreBundle\Entity\Orders;
use LW\LouvreBundle\Entity\Ticket;
use LW\LouvreBundle\Form\OrdersType;
// Importation du fichier nécéssaire pour charger automatique les fichiers de stripe
require_once('../vendor/autoload.php');

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
              //service pour calculer les tarifs des billets
              $serviceTarifDate = $this->container->get('lw_louvre.tarifDate');
              $serviceTarifDate->calculTarif($booking);
              //service pour calculer le nombre total des billets
              $checkdate = $this->container->get('lw_louvre.checkdate');
              $totalBillets = $checkdate->getTotalBillets($booking->getVisiteDate());
              if($totalBillets <= 1000)
               {
                 $session = $request->getSession();
                 $session->set('booking', $booking);
                 return $this->redirectToRoute('lw_louvre_stripe_form');
               }
               if ($totalBillets > 1000)
               {
               $this->addFlash('notice','Les réservations sont complètes pour cette date veuillez choisir une autre date !!!');
               } 
              
            } 
        }
         return $this->render('LWLouvreBundle:Louvre:billeterie.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function avaibleDateAction(){
        
          $current_date = "2018-07-17";
          $checkdate = $this->container->get('lw_louvre.checkdate');
            $result = $checkdate->getTotalBillets($current_date);
            $random = random_bytes(5);

                echo"<pre>";
              echo "<br />";
           // foreach ($result as $value) {
              dump($random);
           // }
              
              die();
    }

    public function stripeFormAction(Request $request)
    {     
         return $this->render('LWLouvreBundle:Louvre:stripe_pay.html.twig');       
    }

     public function stripePaymentAction(Request $request)
    {
           $session = $request->getSession();

        \Stripe\Stripe::setApiKey('sk_test_MgZ8tjk4OcFvwrkTCP9NHmji');
         \Stripe\Charge::create(['amount' => $session->get('booking')->getPrice()*100,
                                'currency' => 'EUR',
                                'description' => 'payement du billet sur le site du musée de louvre',
                                'source' => $request->request->get('stripeToken')]);
         return $this->redirectToRoute('lw_louvre_homepage');     
    }
}