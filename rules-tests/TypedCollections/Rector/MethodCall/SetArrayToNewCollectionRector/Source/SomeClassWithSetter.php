<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source;

use Doctrine\Common\Collections\Collection;

final class SomeClassWithSetter
{
    /**
     * @param Collection<int, ItemType> $items
     * @param Collection<int, ItemType> $nextItems
     */
    public function setItems(Collection $items, Collection $nextItems): void
    {
    }

    /**
     * @param Collection<int, ItemType> $items
     */
    public function setDocblockItems($items): void
    {
    }
}
