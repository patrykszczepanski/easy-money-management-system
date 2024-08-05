<?php

declare(strict_types=1);

namespace App\Shared\Domain\Aggregate;

use AllowDynamicProperties;

#[AllowDynamicProperties]
abstract class AbstractSerializer
{
    public function fromCollection(array $collection): array
    {
        return array_map([$this, 'fromEntity'], $collection);
    }
}
