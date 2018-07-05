<?php 
namespace LW\LouvreBundle\Services\checkDate;
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
   * @param date $date_vi
   * @return int $orders
   */

  public function bnrBillet($date_vi)

  {      
   $repository = $this->em
  ->getRepository('LWLouvreBundle:Orders');

   $query = $repository->createQueryBuilder('o')
           ->select('COUNT(o)')
           ->where('o.visiteDate = :date_vi')
           ->setParameter('date_vi', $date_vi)
           ->getQuery();
      $orders = $query->getSingleScalarResult();

      return $orders;


  }
}