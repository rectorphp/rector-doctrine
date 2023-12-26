<?php

namespace Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ExtractArrayArgOnQueryBuilderSelectRector\Fixture;

final class SkipNonArrayArg
{
    function query(\Doctrine\DBAL\Query\QueryBuilder $queryBuilder)
    {
        $query = $queryBuilder->select('u.id');
    }
}
