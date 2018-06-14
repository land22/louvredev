<?php

namespace LW\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LWLouvreBundle:Default:index.html.twig');
    }
}
