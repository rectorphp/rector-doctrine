<?php

namespace Rector\Doctrine\Tests\Orm28\Rector\MethodCall\IterateToToIterableRector\Fixture;

use Doctrine\ORM\Internal\Hydration\IterableResult;

class ReplaceWithForeach
{
    public function getResults(IterableResult $iterableResult)
    {
        foreach ($iterableResult as $result) {
            // do something
            $entityIsHere = $result[0];
        }
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Orm28\Rector\MethodCall\IterateToToIterableRector\Fixture;

use Doctrine\ORM\Internal\Hydration\IterableResult;

class ReplaceWithForeach
{
    public function getResults(IterableResult $iterableResult)
    {
        foreach ($iterableResult as $result) {
            // do something
            $entityIsHere = $result;
        }
    }
}

?>
