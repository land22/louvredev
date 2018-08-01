<?php 
namespace LW\LouvreBundle\Services;
use Doctrine\ORM\EntityManager;

class Checkdate
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
     * Retourne le nombre de billet pour une date donnée
     * @param string $visiteDate
     * @return number
     */
    public function getTotalBillets($visiteDate) {
        
        $totalTickets = 0;
        if ( $visiteDate ) {
            $dateTimeVisite      = new \DateTime($visiteDate);
            $totalTickets        = 0;
            $ordersOfCurrentDay  = $this->em->getRepository('LWLouvreBundle:Orders')->findBy(array('visiteDate'=> $dateTimeVisite ));
            if ( !empty($ordersOfCurrentDay) ) {
                foreach ( $ordersOfCurrentDay as $row )
                {
                    $billets = $this->em->getRepository('LWLouvreBundle:Ticket')->findBy( array('order'=> $row->getId()) );
                    $totalTickets += sizeof($billets);
                }
            }
        }
        return $totalTickets;
    }

}