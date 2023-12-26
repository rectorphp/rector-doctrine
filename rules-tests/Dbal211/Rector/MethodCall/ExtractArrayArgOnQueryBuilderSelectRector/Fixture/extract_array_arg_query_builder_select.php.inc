<?php

namespace Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ExtractArrayArgOnQueryBuilderSelectRector\Fixture;

final class SomeClass
{
    function query(\Doctrine\DBAL\Query\QueryBuilder $queryBuilder)
    {
        $query = $queryBuilder->select(['u.id', 'p.id']);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ExtractArrayArgOnQueryBuilderSelectRector\Fixture;

final class SomeClass
{
    function query(\Doctrine\DBAL\Query\QueryBuilder $queryBuilder)
    {
        $query = $queryBuilder->select('u.id', 'p.id');
    }
}

?>
