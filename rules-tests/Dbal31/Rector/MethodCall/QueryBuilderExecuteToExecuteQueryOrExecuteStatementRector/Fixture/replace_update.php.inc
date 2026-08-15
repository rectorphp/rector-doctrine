<?php

declare(strict_types=1);

namespace Rector\Tests\Doctrine\Dbal31\Rector\MethodCall\QueryBuilderExecuteToExecuteQueryOrExecuteStatementRector\Fixture;

use Doctrine\DBAL\Query\QueryBuilder;

final class ReplaceUpdate
{
    public function run(QueryBuilder $queryBuilder): void
    {
        $queryBuilder
            ->update('user', 'u')
            ->set('u.active', ':active')
            ->where('u.id = :id')
            ->execute();
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Tests\Doctrine\Dbal31\Rector\MethodCall\QueryBuilderExecuteToExecuteQueryOrExecuteStatementRector\Fixture;

use Doctrine\DBAL\Query\QueryBuilder;

final class ReplaceUpdate
{
    public function run(QueryBuilder $queryBuilder): void
    {
        $queryBuilder
            ->update('user', 'u')
            ->set('u.active', ':active')
            ->where('u.id = :id')
            ->executeStatement();
    }
}

?>
