<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Validator\Constraints;

use App\Shared\Domain\Error\EnumErrorAssert;
use Exception;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidUuidV4Validator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof ValidUuidV4) {
            throw new Exception(EnumErrorAssert::CONSTRAINT_TYPE_MISMATCH->value);
        }

        if (null === $value) {
            $this->context->buildViolation(EnumErrorAssert::NOT_BLANK->value)
                ->addViolation()
            ;

            return;
        }

        if (!UuidV4::isValid($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->addViolation()
            ;
        }
    }
}
