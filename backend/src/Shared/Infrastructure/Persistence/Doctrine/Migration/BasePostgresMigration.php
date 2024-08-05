<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Migration;

use Doctrine\Migrations\AbstractMigration;

use function sprintf;

abstract class BasePostgresMigration extends AbstractMigration
{
    protected function createEnumTypeSql(string $name, array $values): string
    {
        return sprintf("CREATE TYPE %s AS ENUM ('%s')", $name, implode("', '", $values));
    }

    protected function dropTypeSql(string $name): string
    {
        return sprintf('DROP TYPE %s', $name);
    }

    protected function renameTypeSql(string $name, string $newName): string
    {
        return sprintf('ALTER TYPE %s RENAME TO %s', $name, $newName);
    }

    protected function alterColumnEnumTypeSql(string $table, string $column, string $type): string
    {
        return sprintf('ALTER TABLE %s ALTER COLUMN %s TYPE %s USING %2$s::text::%3$s', $table, $column, $type);
    }

    protected function processEnumUpdate(string $type, array $values, array $tableMap): void
    {
        $oldType = sprintf('%s_old', $type);
        $this->addSql($this->renameTypeSql($type, $oldType));

        $this->addSql($this->createEnumTypeSql($type, $values));
        foreach ($tableMap as $table => $column) {
            $this->addSql($this->alterColumnEnumTypeSql($table, $column, $type));
        }

        $this->addSql($this->dropTypeSql($oldType));
    }
}
