<?php

namespace LW\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use LW\LouvreBundle\Entity\Orders;
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
        if ($form->isSubmitted()) {
            
        }
         return $this->render('LWLouvreBundle:Louvre:billeterie.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
