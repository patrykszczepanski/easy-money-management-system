<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Trait;

trait HydrateStaticTrait
{
    public static function hydrate(array $values): self
    {
        $dto = new self();

        foreach ($values as $key => $value) {
            if (property_exists($dto, $key)) {
                $dto->{$key} = $value;
            }
        }

        return $dto;
    }
}
