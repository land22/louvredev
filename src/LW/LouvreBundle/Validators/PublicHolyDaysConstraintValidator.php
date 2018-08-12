<?php 
namespace LW\LouvreBundle\Validators;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraint;


class PublicHolyDaysConstraintValidator extends ConstraintValidator
{
    
    
    
    public function validate($visiteDate, Constraint $constraint)
    {  //recupération du jour de la semaine choisi 
        $weekDay = $visiteDate->format('D');
       //recupération du jour du mois choisi 
        $MonthDays = $visiteDate->format('d-m');
        //recupération de la date courante
        $date = new \DateTime();

        if ( ($visiteDate < $date) OR ($weekDay == "Sun") OR  ($weekDay == "Tue") OR ($MonthDays == "01-05") OR ($MonthDays == "01-11") OR ($MonthDays == "25-12")) {
            $this->context->buildViolation($constraint->message)->atPath('type')->addViolation();
        }
    }
}