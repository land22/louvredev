<?php 
namespace LW\LouvreBundle\Validators;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraint;


class PublicHolyDaysConstraintValidator extends ConstraintValidator
{
    
    
    
    public function validate($visiteDate, Constraint $constraint)
    {
        $weekDay = $visiteDate->format('D');
        $MonthDays = $visiteDate->format('d-m');
                
        
        if ( ($weekDay == "Sun") OR  ($weekDay == "Tue") OR ($MonthDays == "01-05") OR ($MonthDays == "01-11") OR ($MonthDays == "25-12")) {
            $this->context->buildViolation($constraint->message)->atPath('type')->addViolation();
        }
    }
}