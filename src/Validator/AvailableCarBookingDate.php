<?php

namespace App\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class AvailableCarBookingDate extends Constraint
{
    public $message = 'La date "{{ date }}" n\'est pas disponible';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
