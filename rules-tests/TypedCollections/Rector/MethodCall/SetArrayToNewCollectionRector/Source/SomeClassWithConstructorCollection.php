<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source;

use Doctrine\Common\Collections\Collection;

final class SomeClassWithConstructorCollection
{
    /**
     * @param Collection<int, ItemType> $items
     */
    public function __construct(Collection $items)
    {
    }
}
