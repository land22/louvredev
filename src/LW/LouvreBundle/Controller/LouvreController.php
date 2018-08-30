<?php

namespace LW\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use LW\LouvreBundle\Entity\Orders;
use LW\LouvreBundle\Entity\Tickets;
use LW\LouvreBundle\Form\OrdersType;

class LouvreController extends Controller {

    /**
     * 
     * @return type
     */
    public function indexAction() {
        return $this->render('LWLouvreBundle:Louvre:index.html.twig');
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function billeterieAction(Request $request) {
        // on va générer notre formulaire
        $booking = new Orders();
        $form = $this->get('form.factory')->create(OrdersType::class, $booking);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
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
                    'nbBillets' => $request->get('nbr_billet', ''),
        ));
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function stripeFormAction(Request $request) {
        $session = $request->getSession();
        if ($session->get('booking') == null) {
            return $this->redirectToRoute('lw_louvre_homepage');
        } else {
            return $this->render('LWLouvreBundle:Louvre:stripe_pay.html.twig');
        }
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function stripePaymentAction(Request $request) {
        //Ajouter la tva de 20% au prix total
        $session = $request->getSession();
        if ($session->get('booking') == null) {
            return $this->redirectToRoute('lw_louvre_homepage');
        }


        $prixTotal = $session->get('booking')->getPrice() * 1.2;
        $prixTotal = intval($prixTotal);
        $session->get('booking')->setPrice($prixTotal);

        //debut code pour stripe
        $serviceStripe = $this->container->get('louvre_louvre.stripe');
        $responseStripe = $serviceStripe->stripePayment($request->request->get('stripeToken'), $session->get('booking')->getPrice());

        if (empty($responseStripe)) {
            $this->addFlash('notice', 'Erreur votre reservation n\'a pas été pris en compte. Merci de bien vouloir recommancer !!!');
            $session->remove('booking');
            return $this->redirectToRoute('lw_louvre_billeterie');
        } else { //en cas de reussite on enregistre en base de donnée
            $codeReservation = md5(uniqid() . time());
            $codeReservation = strtoupper(substr($codeReservation, 0, 9));

            $session->get('booking')->setCodeReservation($codeReservation);
            $session->get('booking')->setEmail($request->request->get('email_order'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($session->get('booking'));
            $em->flush();
            $serviceMailer = $this->container->get('louvre.sendOrders');
            $serviceMailer->sendOrders($session->get('booking'));
            $this->addFlash('info', 'Votre réservation a bien été effectuée. 
Un mail vous a été envoyé à l\'adresse email précédemment indiquée.
A très bientôt. !!!');
            $session->clear();
            return $this->redirectToRoute('lw_louvre_homepage');
        }
    }

}
