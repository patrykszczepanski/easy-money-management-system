<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Type;

use App\Shared\Application\Service\CryptService;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class EncryptedType extends Type
{
    protected string $name = 'encrypted';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getClobTypeDeclarationSQL($column);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if (empty($value)) {
            return '';
        }

        return CryptService::sha256('encrypt', $value);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): string
    {
        if (empty($value)) {
            return '';
        }

        return CryptService::sha256('decrypt', $value);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
