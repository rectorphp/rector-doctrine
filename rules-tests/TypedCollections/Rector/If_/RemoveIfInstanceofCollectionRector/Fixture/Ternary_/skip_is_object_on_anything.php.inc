<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture\Ternary_;

final class SkipIsObjectOnAnything
{
    public $items;

    public function someMethod()
    {
        return is_object($this->items) ? 1 : 2;
    }
}
