<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\New_\RemoveNewArrayCollectionWrapRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class SkipEmptyCollection
{
    public Collection $items;

    public function someMethod()
    {
        $values = new ArrayCollection();
    }
}
