<?php

declare(strict_types=1);

namespace Rector\Tests\Doctrine\Dbal31\Rector\MethodCall\QueryBuilderExecuteToExecuteQueryOrExecuteStatementRector\Fixture;

use Doctrine\DBAL\Query\QueryBuilder;

final class Skip
{
    public function run(QueryBuilder $queryBuilder): void
    {
        $queryBuilder
            ->where('u.id = :id')
            ->execute();
    }
}
