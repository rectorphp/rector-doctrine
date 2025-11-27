<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\AssertSameCountOnCollectionToAssertCountRector\Fixture;

use PHPUnit\Framework\TestCase;

final class SkipAssertCountOnSomethingElse extends TestCase
{
    public array $items;

    public function someMethod()
    {
        $this->assertSame(10, $this->items->count());
    }
}
