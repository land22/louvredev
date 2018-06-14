<?php

namespace LW\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LouvreController extends Controller
{
    public function indexAction()
    {
        return $this->render('LWLouvreBundle:Louvre:index.html.twig');
    }

    public function billeterieAction()
    {
        return $this->render('LWLouvreBundle:Louvre:billeterie.html.twig');
    }
}
