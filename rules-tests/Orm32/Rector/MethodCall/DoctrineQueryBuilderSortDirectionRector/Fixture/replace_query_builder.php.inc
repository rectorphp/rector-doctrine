<?php

namespace Rector\Doctrine\Tests\Orm32\Rector\MethodCall\DoctrineQueryBuilderSortDirectionRector\Fixture;

use Doctrine\ORM\QueryBuilder;


function someFunction(QueryBuilder $qb)
{
    $qb->orderBy('e.id', 'ASC');
    $qb->addOrderBy('e.id', \Doctrine\Common\Collections\Criteria\Criteria::ASC);
    $qb->addOrderBy('e.id', \Doctrine\Common\Collections\Criteria\Criteria::DESC);
    $qb
        ->addOrderBy('e.name', \Doctrine\Common\Collections\Order::Ascending)
        ->addOrderBy('e.name', \Doctrine\Common\Collections\Order::Descending);
    $qb->addOrderBy('e.name', 'desc');
    $qb->addOrderBy('e.title', 'DeSc');
}

class NotAQueryBuilder
{
    public function orderBy(string $field, string $dir): void
    {
    }
}

function ignoreNonQueryBuilder(NotAQueryBuilder $notQb)
{
    $notQb->orderBy('e.id', 'ASC');
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Orm32\Rector\MethodCall\DoctrineQueryBuilderSortDirectionRector\Fixture;

use Doctrine\ORM\QueryBuilder;


function someFunction(QueryBuilder $qb)
{
    $qb->orderBy('e.id', \SortDirection::Ascending);
    $qb->addOrderBy('e.id', \SortDirection::Ascending);
    $qb->addOrderBy('e.id', \SortDirection::Descending);
    $qb
        ->addOrderBy('e.name', \SortDirection::Ascending)
        ->addOrderBy('e.name', \SortDirection::Descending);
    $qb->addOrderBy('e.name', \SortDirection::Descending);
    $qb->addOrderBy('e.title', \SortDirection::Descending);
}

class NotAQueryBuilder
{
    public function orderBy(string $field, string $dir): void
    {
    }
}

function ignoreNonQueryBuilder(NotAQueryBuilder $notQb)
{
    $notQb->orderBy('e.id', 'ASC');
}

?>
