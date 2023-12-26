<?php

namespace Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ExtractArrayArgOnQueryBuilderSelectRector\Fixture;

final class SkipNonQueryBuilderObject
{
    function query(mixed $queryBuilder)
    {
        $query = $queryBuilder->select(['u.id', 'p.id']);
    }
}
