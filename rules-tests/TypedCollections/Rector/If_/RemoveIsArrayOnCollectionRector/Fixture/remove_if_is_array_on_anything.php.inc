<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIsArrayOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveIfIsArrayOnAnything
{
    public Collection $items;

    public function someMethod()
    {
        if (is_array([1, 2, 3])) {
            return 1;
        }

        return 2;
    }
}
