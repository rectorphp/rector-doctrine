<?php

namespace Rector\Doctrine\Tests\Orm28\Rector\MethodCall\IterateToToIterableRector\Fixture;

class SkipIterateMixed
{
    public function getResults(mixed $query): iterable
    {
        return $query->iterate();
    }
}
