<?php

namespace Rector\Doctrine\Tests\Orm28\Rector\MethodCall\IterateToToIterableRector\Fixture;

use Doctrine\ORM\Internal\Hydration\IterableResult;

class ReplaceWithForeach
{
    public function getResults(): IterableResult
    {
        $results = $this->getEntityManager()->select('e')->from('entity')->getQuery()->iterate();
        foreach ($results as $result) {
            // do something
            $entityIsHere = $result[0];
        }

        return $results;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Orm28\Rector\MethodCall\IterateToToIterableRector\Fixture;

use Doctrine\ORM\Internal\Hydration\IterableResult;

class ReplaceWithForeach
{
    public function getResults(): iterable
    {
        $results = $this->getEntityManager()->select('e')->from('entity')->getQuery()->toIterable();
        foreach ($results as $result) {
            // do something
            $entityIsHere = $result;
        }

        return $results;
    }
}

?>
