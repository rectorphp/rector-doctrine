<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNewArrayCollectionOutsideConstructorRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class SkipRemoveMethods
{
    public Collection $items;

    public function removeItems()
    {
        $this->items = new ArrayCollection();
    }
}
