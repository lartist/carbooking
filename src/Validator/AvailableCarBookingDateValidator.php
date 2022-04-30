<?php

namespace App\Validator;

use App\Entity\CarBooking;
use App\Repository\CarBookingRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class AvailableCarBookingDateValidator extends ConstraintValidator
{

    public function __construct(private CarBookingRepository $carBookingRepository)
    {
    }

    /**
     * @param CarBooking $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof AvailableCarBookingDate) {
            throw new UnexpectedTypeException($constraint, AvailableCarBookingDate::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!$value instanceof CarBooking) {
            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, CarBooking::class);

            // separate multiple types using pipes
            // throw new UnexpectedValueException($value, 'string|int');
        }


        if (
            !empty($this->carBookingRepository->findBy([
                'car' => $value->getCar(),
                'date' => $value->getDate()
            ]))
        ) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ date }}', $value->getDate()->format('Y-m-d'))
                ->atPath('date')
                ->addViolation();
        }
    }
}
