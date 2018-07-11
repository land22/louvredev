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
   * @param DateTime $date_vi
   * @return int $orders
   */

  public function bnrBillet($date_vi)

  {      
   $repositoryOrders = $this->em->getRepository('LWLouvreBundle:Orders');
  //on recupère l'id de order de la date de visite choisi
  $result = $repositoryOrders->findByVisiteDate($date_vi);
  $repositoryTicket = $this->em->getRepository('LWLouvreBundle:Ticket');

   $query = $repositoryTicket->createQueryBuilder('t')
                             ->innerJoin('t.order', 'o')
                             ->addSelect('o')
                             ->where('o.visiteDate = :visiteDate')
                             ->setParameter('visiteDate', $date_vi)
                             ->getQuery();
      $orders = $query->getSingleScalarResult();

      return $orders;


  }
}