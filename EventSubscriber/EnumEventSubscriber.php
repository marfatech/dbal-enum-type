<?php

declare(strict_types=1);

/*
 * This file is part of the DbalEnumType package.
 *
 * (c) MarfaTech <https://marfa-tech.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MarfaTech\Component\DbalEnumType\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\DBAL\Event\SchemaColumnDefinitionEventArgs;
use Doctrine\DBAL\Events;
use MarfaTech\Component\DbalEnumType\Exception\EnumException;
use MarfaTech\Component\DbalEnumType\Schema\EnumAwareMySqlSchemaManager;
use MarfaTech\Component\DbalEnumType\Type\AbstractEnumType;

use function mb_strtolower;

class EnumEventSubscriber implements EventSubscriber
{
    /**
     * @param SchemaColumnDefinitionEventArgs $args
     *
     * @throws EnumException
     */
    public function onSchemaColumnDefinition(SchemaColumnDefinitionEventArgs $args)
    {
        $schemaManager = $args->getConnection()->getSchemaManager();

        if (!$schemaManager instanceof EnumAwareMySqlSchemaManager) {
            return;
        }

        $column = $schemaManager->getPortableTableColumnDefinition($args->getTableColumn());
        $type = $column->getType();

        if (!$type instanceof AbstractEnumType) {
            return;
        }

        $mysqlType = $args->getTableColumn()['Type'];
        $mysqlType = mb_strtolower($mysqlType);

        $enumDeclaration = $type->getSQLDeclaration($column->toArray(), $args->getDatabasePlatform());
        $enumDeclaration = mb_strtolower($enumDeclaration);

        if ($enumDeclaration === $mysqlType) {
            return;
        }

        $column->setCustomSchemaOptions(['enum_changed' => true]);

        $args->setColumn($column);
        $args->preventDefault();
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::onSchemaColumnDefinition => 'onSchemaColumnDefinition'
        ];
    }
}
