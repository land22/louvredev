<?php 
namespace LW\LouvreBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
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
  //Action pour vérifier la date disponible
  public function avaibleDateAction($date_visite)
  {      
    $checkdate = $this->container->get('louvre.checkdate');
    $totalBillet = $checkdate->getTotalBillets($date_visite);
    $code1 = random_bytes(1);
    $code = sha1($code1);
    $code = md5(uniqid().time());
    dump($code);
    die();

    $response = new JsonResponse(array('totalBillet' => $totalBillet));
    return $response;
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
      /*$code = random_bytes(1);
      $codeReservation = md5($code);
      $codeReservation = substr($codeReservation , 0,9);*/
      $codeReservation = md5(uniqid().time());
      $codeReservation = strtoupper(substr($codeReservation , 0,9));

     $session->get('booking')->setCodeReservation($codeReservation);
     $session->get('booking')->setEmail($request->request->get('email_order'));
     $em = $this->getDoctrine()->getManager();
     /*$em->persist($session->get('booking'));
     $em->flush(); */
     $serviceMailer = $this->container->get('louvre.sendOrders');
     $serviceMailer->sendOrders($session->get('booking'));
     $this->addFlash('info','Votre reservation a été éffectuée avec success veuillez consulter votre mail !!!');
      return $this->redirectToRoute('lw_louvre_homepage');
    } 
    

  }
}