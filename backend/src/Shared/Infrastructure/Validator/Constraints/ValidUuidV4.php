<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Validator\Constraints;

use App\Shared\Domain\Error\EnumErrorAssert;
use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class ValidUuidV4 extends Constraint
{
    public string $message = EnumErrorAssert::INVALID_UUID->value;

    public function validatedBy(): string
    {
        return ValidUuidV4Validator::class;
    }
}
