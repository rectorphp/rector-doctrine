<?php

namespace Rector\Doctrine\Tests\Orm32\Rector\MethodCall\DoctrineQueryBuilderSortDirectionRector\Fixture;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\Expr\OrderBy;

function modifyQuery(QueryBuilder $qb, Expr $expr)
{
    $qb->add(
        'orderBy',
        $expr->orderBy('u.status', 'ASC')
    );

    $orderBy = new OrderBy('u.createdAt', 'desc');
    $qb->add('orderBy', $orderBy);

    $ignoreMe = new OrderBy('u.id');
    $qb->add('orderBy', $expr->orderBy('u.name'));
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Orm32\Rector\MethodCall\DoctrineQueryBuilderSortDirectionRector\Fixture;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\Expr\OrderBy;

function modifyQuery(QueryBuilder $qb, Expr $expr)
{
    $qb->add(
        'orderBy',
        $expr->orderBy('u.status', \SortDirection::Ascending)
    );

    $orderBy = new OrderBy('u.createdAt', \SortDirection::Descending);
    $qb->add('orderBy', $orderBy);

    $ignoreMe = new OrderBy('u.id');
    $qb->add('orderBy', $expr->orderBy('u.name'));
}

?>
