<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use RuntimeException;

use function count;

final class DomainEventMapping
{
    private array $mapping;

    public function __construct(iterable $mapping)
    {
        $this->mapping = $this->extractEvents($mapping);
    }

    public function for(string $name)
    {
        if (!isset($this->mapping[$name])) {
            throw new RuntimeException("The Domain Event Class for <{$name}> doesn't exist or has no subscribers");
        }

        return $this->mapping[$name];
    }

    private function extractEvents(iterable $mapping): array
    {
        return array_reduce($mapping, static fn (array $result, DomainEventSubscriber $subscriber) => array_merge(
            $result,
            array_combine(
                array_map(static fn (string $eventClass) => $eventClass::eventName(), $subscriber::subscribedTo()),
                array_fill(0, count($subscriber::subscribedTo()), $subscriber)
            )
        ), []);
    }
}
