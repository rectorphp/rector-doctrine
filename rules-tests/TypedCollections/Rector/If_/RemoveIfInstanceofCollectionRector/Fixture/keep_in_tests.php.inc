<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

final class KeepInTests extends TestCase
{
    public function testSomething(?Collection $collection)
    {
        if ($collection instanceof Collection) {
            // Do something with the collection
            $this->assertTrue($collection->isEmpty());
        } else {
            // Handle the case where it's not a collection
            $this->assertFalse(true);
        }
    }
}
