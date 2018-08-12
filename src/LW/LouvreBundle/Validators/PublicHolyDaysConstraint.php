<?php 
namespace LW\LouvreBundle\Validators;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PublicHolyDaysConstraint extends Constraint
{
    public $message = "Désolez,vous ne pouvez pas reserver à cette date veuillez choisir une autre date !!!";
}
