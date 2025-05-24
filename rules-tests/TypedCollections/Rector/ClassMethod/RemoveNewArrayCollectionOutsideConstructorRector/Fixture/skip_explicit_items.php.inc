<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNewArrayCollectionOutsideConstructorRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class SkipExplicitItems
{
    public Collection $items;

    public function anotherMethod($someItems)
    {
        $this->items = new ArrayCollection($someItems);
    }
}
