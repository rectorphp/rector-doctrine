<?php

namespace Rector\Doctrine\Tests\Orm28\Rector\MethodCall\IterateToToIterableRector\Fixture;

use Doctrine\ORM\Internal\Hydration\IterableResult;

class Replace
{
    public function getResults(): IterableResult
    {
        return $this->getEntityManager()->select('e')->from('entity')->getQuery()->iterate();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Orm28\Rector\MethodCall\IterateToToIterableRector\Fixture;

use Doctrine\ORM\Internal\Hydration\IterableResult;

class Replace
{
    public function getResults(): iterable
    {
        return $this->getEntityManager()->select('e')->from('entity')->getQuery()->toIterable();
    }
}

?>
