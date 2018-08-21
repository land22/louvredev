<?php
namespace LW\LouvreBundle\Validators;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;


class SoldDaysConstraintValidator extends ConstraintValidator
{
    
    /**
     * @var EntityManager
     */
    protected $em;
    
    public function __construct(EntityManager $entityManager)
    {        
        $this->em = $entityManager;
    }
    
    public function validate($visiteDate, Constraint $constraint)
    {
        
        // On calcule le nombre total de ticket en BDD
        $totalTickets = 0;
        if ( $visiteDate ) {
            $dateTimeVisite      = $visiteDate;
            $totalTickets        = 0;
            $ordersOfCurrentDay  = $this->em->getRepository('LWLouvreBundle:Orders')->findBy(array('createdDate'=> $dateTimeVisite ));
            if ( !empty($ordersOfCurrentDay) ) {
                foreach ( $ordersOfCurrentDay as $row )
                {
                    $billets = $this->em->getRepository('LWLouvreBundle:Ticket')->findBy( array('order'=> $row->getId()) );
                    $totalTickets += sizeof($billets);
                }
            }
        }        
        
        if ( $totalTickets > 1000 ) {
            $this->context->buildViolation($constraint->message)->atPath('type')->addViolation();
        }
    }
}
