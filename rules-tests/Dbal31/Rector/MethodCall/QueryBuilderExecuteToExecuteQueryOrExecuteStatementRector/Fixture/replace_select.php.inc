<?php

declare(strict_types=1);

namespace Rector\Tests\Doctrine\Dbal31\Rector\MethodCall\QueryBuilderExecuteToExecuteQueryOrExecuteStatementRector\Fixture;

use Doctrine\DBAL\Query\QueryBuilder;

final class ReplaceSelect
{
    public function run(QueryBuilder $queryBuilder): void
    {
        $queryBuilder
            ->select('u.id')
            ->from('user', 'u')
            ->where('u.active = true')
            ->execute();
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Tests\Doctrine\Dbal31\Rector\MethodCall\QueryBuilderExecuteToExecuteQueryOrExecuteStatementRector\Fixture;

use Doctrine\DBAL\Query\QueryBuilder;

final class ReplaceSelect
{
    public function run(QueryBuilder $queryBuilder): void
    {
        $queryBuilder
            ->select('u.id')
            ->from('user', 'u')
            ->where('u.active = true')
            ->executeQuery();
    }
}

?>
