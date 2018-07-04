<?php 
namespace LW\LouvreBundle\checkDate;
use Doctrine\ORM\EntityManager;

class lwCheckdate
{

	/**
	*@var $em
	*/
	protected $em;
	public function __construct(EntityManager $EntityManager)
	{
		$this->em = $EntityManager;
	}
	/**
   * Vérifie le nombre de billet pour une date précise
   *
   * @param date $date
   * @return int
   */

  public function bnrBillet()

  {      
   $repository = $this->em
  ->getRepository('LWLouvreBundle:Orders');

   $query = $repository->createQueryBuilder('o')
          ->select('COUNT(o)')
          ->getQuery();
      $orders = $query->getSingleScalarResult();

      return $orders;


  }
}