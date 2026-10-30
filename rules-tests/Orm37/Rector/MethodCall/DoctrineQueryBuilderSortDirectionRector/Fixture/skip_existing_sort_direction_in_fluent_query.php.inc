<?php

namespace Rector\Doctrine\Tests\Orm37\Rector\MethodCall\DoctrineQueryBuilderSortDirectionRector\Fixture;

use Doctrine\ORM\QueryBuilder;
use SortDirection;

class SkipExistingSortDirectionInFluentQuery
{
    public function findSeries(QueryBuilder $queryBuilder): array
    {
        return $queryBuilder
            ->orderBy('s.ordering', SortDirection::Ascending)
            ->addOrderBy('s.date', SortDirection::Descending)
            ->getQuery()
            ->getResult();
    }
}
