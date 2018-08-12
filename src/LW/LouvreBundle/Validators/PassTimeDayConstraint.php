<?php 
namespace LW\LouvreBundle\Validators;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */

class PassTimeDayConstraint extends Constraint
{
    public $message = "A partir de 14h il n'est plus possible de reserver le billet pour la journée !!!";
}
