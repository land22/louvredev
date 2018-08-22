<?php 
namespace LW\LouvreBundle\Validators;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraint;


class PassTimeDayConstraintValidator extends ConstraintValidator
{
    
    
    /**
     * 
     * @param type $typeOrder
     * @param Constraint $constraint
     */
    public function validate($typeOrder, Constraint $constraint)
    {
        
       $date = new \DateTime();
       $var = $date->format('H');
       if ( $var >= "14" AND $typeOrder == "Journée" ) {
            $this->context->buildViolation($constraint->message)->atPath('type')->addViolation();
       }
    }
}