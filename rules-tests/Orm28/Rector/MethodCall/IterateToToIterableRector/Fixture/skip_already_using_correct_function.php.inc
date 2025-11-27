<?php

namespace Rector\Doctrine\Tests\Orm28\Rector\MethodCall\IterateToToIterableRector\Fixture;

class SkipAlreadyUsingCorrectFunction
{
    public function getResults(): iterable
    {
        return $this->getEntityManager()->select('e')->from('entity')->getQuery()->toIterable();
    }
}
