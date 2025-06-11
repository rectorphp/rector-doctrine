<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Expression\RemoveAssertNotNullOnCollectionRector\Fixture;

final class SkipNonCollection
{
    public array $items;

    public function someMethod()
    {
        \PHPUnit\Framework\Assert::assertNotNull($this->items);
    }
}
