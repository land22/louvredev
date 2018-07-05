<?php 

namespace LW\LouvreBundle\Twig;


use LW\LouvreBundle\checkDate\lwCheckdate;


class CheckdateExtension
{
  /**
   * @var lwcheckdate
   */

  private $lwcheckdate;


  public function __construct(lwCheckdate $lwcheckdate)

  {

    $this->lwcheckdate = $lwcheckdate;

  }


  public function checkIfArgumentDate($date)

  {

    return $this->lwcheckdate->bnrBillet($date);

  }

}