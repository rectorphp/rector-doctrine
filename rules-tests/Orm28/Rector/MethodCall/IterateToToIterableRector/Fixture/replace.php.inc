<?php

namespace Rector\Doctrine\Tests\Orm28\Rector\MethodCall\IterateToToIterableRector\Fixture;

class Replace
{
    public function getResults(\Doctrine\ORM\Query $query): iterable
    {
        return $query->iterate();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Orm28\Rector\MethodCall\IterateToToIterableRector\Fixture;

class Replace
{
    public function getResults(\Doctrine\ORM\Query $query): iterable
    {
        return $query->toIterable();
    }
}

?>
