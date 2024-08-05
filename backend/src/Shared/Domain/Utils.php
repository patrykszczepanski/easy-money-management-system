<?php

declare(strict_types=1);

namespace App\Shared\Domain;

use DateTimeInterface;
use RuntimeException;

use const JSON_ERROR_NONE;
use const JSON_THROW_ON_ERROR;

final class Utils
{
    public static function dateToString(DateTimeInterface $date): string
    {
        return $date->format(DateTimeInterface::ATOM);
    }

    public static function jsonEncode(array $values): string
    {
        return json_encode($values, JSON_THROW_ON_ERROR);
    }

    public static function jsonDecode(string $json): array
    {
        $data = json_decode($json, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new RuntimeException('Unable to parse response body into JSON: '.json_last_error());
        }

        return $data;
    }
}
