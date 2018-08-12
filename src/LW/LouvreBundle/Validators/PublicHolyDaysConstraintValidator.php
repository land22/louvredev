<?php 
namespace LW\LouvreBundle\Validators;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraint;


class PublicHolyDaysConstraintValidator extends ConstraintValidator
{
    
    
    
    public function validate($visiteDate, Constraint $constraint)
    {
        
        // On calcule le nombre total de ticket en BDD
        $totalTickets = 0;
                
        
        if ( $totalTickets > 1000 ) {
            $this->context->buildViolation($constraint->message)->atPath('type')->addViolation();
        }
    }
}