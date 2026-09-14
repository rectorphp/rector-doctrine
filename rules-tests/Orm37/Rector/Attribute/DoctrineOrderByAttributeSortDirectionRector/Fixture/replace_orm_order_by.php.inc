<?php

namespace Rector\Doctrine\Tests\Orm37\Rector\Attribute\DoctrineOrderByAttributeSortDirectionRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Order;

class ReplaceOrderByAscWithClassConstant
{
    #[ORM\OrderBy(['createdAt' => 'ASC'])]
    protected \DateTimeInterface $messages;

    #[ORM\OrderBy(['updatedAt' => 'desc', 'id' => Order::Ascending])]
    protected \DateTimeInterface $logs;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Orm37\Rector\Attribute\DoctrineOrderByAttributeSortDirectionRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Order;

class ReplaceOrderByAscWithClassConstant
{
    #[ORM\OrderBy(['createdAt' => \SortDirection::Ascending])]
    protected \DateTimeInterface $messages;

    #[ORM\OrderBy(['updatedAt' => \SortDirection::Descending, 'id' => \SortDirection::Ascending])]
    protected \DateTimeInterface $logs;
}

?>
