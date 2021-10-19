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

namespace MarfaTech\Component\DbalEnumType\Driver\PDOMySql;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\PDOMySql\Driver;
use MarfaTech\Component\DbalEnumType\Schema\EnumAwareMySqlSchemaManager;

class EnumAwareDriver extends Driver
{
    /**
     * {@inheritdoc}
     */
    public function getSchemaManager(Connection $conn)
    {
        return new EnumAwareMySqlSchemaManager($conn);
    }
}
