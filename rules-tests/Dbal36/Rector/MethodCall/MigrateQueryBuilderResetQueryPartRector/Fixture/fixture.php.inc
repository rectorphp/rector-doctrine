<?php

namespace Rector\Doctrine\Tests\Dbal36\Rector\MethodCall\MigrateQueryBuilderResetQueryPartRector\Fixture;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\SQLite3\Driver;
use Doctrine\DBAL\Query\QueryBuilder;

final class SomeRepository
{
    public function getQueryPart()
    {
        $connection = new Connection([], new Driver());
        $queryBuilder = new QueryBuilder($connection);
        $queryBuilder->resetQueryPart('distinct');
        $queryBuilder->resetQueryPart('where');
        $queryBuilder->resetQueryPart('groupBy');
        $queryBuilder->resetQueryPart('having');
        $queryBuilder->resetQueryPart('orderBy');

        $queryBuilder->resetQueryPart('select');
        $queryBuilder->resetQueryPart('values');
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Dbal36\Rector\MethodCall\MigrateQueryBuilderResetQueryPartRector\Fixture;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\SQLite3\Driver;
use Doctrine\DBAL\Query\QueryBuilder;

final class SomeRepository
{
    public function getQueryPart()
    {
        $connection = new Connection([], new Driver());
        $queryBuilder = new QueryBuilder($connection);
        $queryBuilder->distinct(false);
        $queryBuilder->resetWhere();
        $queryBuilder->resetGroupBy();
        $queryBuilder->resetHaving();
        $queryBuilder->resetOrderBy();

        $queryBuilder->resetQueryPart('select');
        $queryBuilder->resetQueryPart('values');
    }
}

?>
