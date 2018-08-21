<?php

namespace LW\LouvreBundle\Validators;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SoldDaysConstraint extends Constraint
{
    public $message = "Trop de tickets réservés à la date choisie, Veuillez sélectionner une autre date";
}
