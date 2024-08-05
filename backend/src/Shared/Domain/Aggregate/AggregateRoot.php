<?php

declare(strict_types=1);

namespace App\Shared\Domain\Aggregate;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Infrastructure\Symfony\Trait\TimestampableZoneEntityTrait;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

abstract class AggregateRoot
{
    use SoftDeleteableEntity;
    use TimestampableZoneEntityTrait;

    private array $domainEvents = [];

    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final public function record(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
}
