<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source;

use Doctrine\Common\Collections\Collection;

final class StaticCallSetter
{
    /**
     * @param Collection<int, ItemType> $items
     */
    public static function setItems(Collection $items)
    {
    }
}
