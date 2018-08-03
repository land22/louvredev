<?php 
namespace LW\LouvreBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use LW\LouvreBundle\Entity\Orders;
use LW\LouvreBundle\Entity\Tickets;
use LW\LouvreBundle\Form\OrdersType;

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
    if ($form->isSubmitted()) 
    {
      if($form->isValid())
      {
      //service pour calculer les tarifs des billets
        $serviceTarifDate = $this->container->get('louvre.tarifDate');
        $serviceTarifDate->calculTarif($booking);
        //service pour calculer le nombre total des billets
        $checkdate = $this->container->get('louvre.checkdate');
        $session = $request->getSession();
        $session->set('booking', $booking);
        return $this->redirectToRoute('lw_louvre_stripe_form');
      } 
    }
   return $this->render('LWLouvreBundle:Louvre:billeterie.html.twig', array(
            'form' => $form->createView(),
        ));
  }
  public function avaibleDateAction()
  {      
    $current_date = "2018-05-06";
    $checkdate = $this->container->get('lw_louvre.checkdate');
    $result = new \DateTime($current_date);
    $random = random_bytes(5);
    echo"<pre>";
    echo "<br />";
    // foreach ($result as $value) {
    dump($result);
    // }
              
   die();
  }
    //Action pour le formulaire de stripe
  public function stripeFormAction(Request $request)
  {     
    return $this->render('LWLouvreBundle:Louvre:stripe_pay.html.twig');       
  }
  //Action pour le payement stripe
  public function stripePaymentAction(Request $request)
  {
    //Ajouter la tva de 20% au prix total
    $session = $request->getSession();
    $prixTotal = $session->get('booking')->getPrice()*1.2;
    $prixTotal = intval($prixTotal);
    $session->get('booking')->setPrice($prixTotal);

    //debut code pour stripe
    $serviceStripe = $this->container->get('louvre_louvre.stripe');
    $responseStripe = $serviceStripe->stripePayment($request->request->get('stripeToken'),$session->get('booking')->getPrice());

    if (empty($responseStripe))
    {
      $this->addFlash('notice','Erreur votre reservation n\'a pas été pris en compte veuillez recommancez !!!');
      $session->remove('booking');
      return $this->redirectToRoute('lw_louvre_billeterie');
    }
    else 
    { //en cas de reussite on enregistre en base de donnée
     $session->get('booking')->setCodeReservation(random_int(0,1000));
     $session->get('booking')->setEmail('landrywabo8@gmail.com');
     $em = $this->getDoctrine()->getManager();
     $em->persist($session->get('booking'));
     $em->flush(); 
     $this->addFlash('info','Votre reservation a été éffectuée avec success veuillez consulter votre mail !!!');
      return $this->redirectToRoute('lw_louvre_homepage');
    } 
    

  }
}