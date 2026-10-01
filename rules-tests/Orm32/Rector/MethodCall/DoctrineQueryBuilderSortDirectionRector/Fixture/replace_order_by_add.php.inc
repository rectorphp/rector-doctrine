<?php

namespace Rector\Doctrine\Tests\Orm32\Rector\MethodCall\DoctrineQueryBuilderSortDirectionRector\Fixture;

use Doctrine\ORM\Query\Expr\OrderBy;

function modifyOrderByAdd(OrderBy $orderBy)
{
    $orderBy->add('u.status', 'ASC');
    $orderBy->add('u.createdAt', 'desc');
    $orderBy->add('u.name');
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Orm32\Rector\MethodCall\DoctrineQueryBuilderSortDirectionRector\Fixture;

use Doctrine\ORM\Query\Expr\OrderBy;

function modifyOrderByAdd(OrderBy $orderBy)
{
    $orderBy->add('u.status', \SortDirection::Ascending);
    $orderBy->add('u.createdAt', \SortDirection::Descending);
    $orderBy->add('u.name');
}

?>
