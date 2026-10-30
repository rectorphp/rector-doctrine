<?php

namespace Rector\Doctrine\Tests\Orm37\Rector\MethodCall\DoctrineQueryBuilderSortDirectionRector\Fixture;

use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\ORM\QueryBuilder;
use SortDirection as Direction;

function skipExistingSortDirection(QueryBuilder $queryBuilder, Expr $expr): void
{
    $queryBuilder
        ->orderBy('s.ordering', Direction::Ascending)
        ->addOrderBy('s.date', Direction::Descending);

    $expr->orderBy('s.ordering', Direction::Ascending);

    $orderBy = new OrderBy('s.ordering', Direction::Ascending);
    $orderBy->add('s.date', Direction::Descending);

    $queryBuilder->orderBy('s.ordering', \SortDirection::Ascending);
    $queryBuilder->addOrderBy('s.date', \SortDirection::Descending);
}
