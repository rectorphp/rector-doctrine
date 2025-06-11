<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\AssertNullOnCollectionToAssertEmptyRector\Fixture;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

final class SkipAssertNullOnAnythingElse extends TestCase
{
    public $items;

    public function someMethod()
    {
        $this->assertNull($this->items);
    }
}
