<?php

declare(strict_types=1);

namespace App\EMMS\User\Domain\ValueObject;

use App\Shared\Domain\Error\EnumErrorAssert;
use App\Shared\Infrastructure\Symfony\Trait\HydrateStaticTrait;
use Symfony\Component\Validator\Constraints as Assert;

class UserInputDTO
{
    use HydrateStaticTrait;

    #[Assert\Type('string')]
    #[Assert\NotBlank(message: EnumErrorAssert::NOT_BLANK->value)]
    #[Assert\Length(min: 5, max: 255, minMessage: EnumErrorAssert::INVALID_MIN_LENGTH->value, maxMessage: EnumErrorAssert::INVALID_MAX_LENGTH->value)]
    public string $email;

    #[Assert\Type('string')]
    #[Assert\NotBlank(message: EnumErrorAssert::NOT_BLANK->value)]
    #[Assert\Length(min: 4, max: 32, minMessage: EnumErrorAssert::INVALID_MIN_LENGTH->value, maxMessage: EnumErrorAssert::INVALID_MAX_LENGTH->value)]
    public string $firstName;

    #[Assert\Type('string')]
    #[Assert\NotBlank(message: EnumErrorAssert::NOT_BLANK->value)]
    #[Assert\Length(min: 4, max: 64, minMessage: EnumErrorAssert::INVALID_MIN_LENGTH->value, maxMessage: EnumErrorAssert::INVALID_MAX_LENGTH->value)]
    public string $lastName;

    /** @todo('create custom validator for this') */
    #[Assert\Type('string')]
    #[Assert\NotBlank(message: EnumErrorAssert::NOT_BLANK->value)]
    #[Assert\Length(min: 4, max: 64, minMessage: EnumErrorAssert::INVALID_MIN_LENGTH->value, maxMessage: EnumErrorAssert::INVALID_MAX_LENGTH->value)]
    public string $role;
}
