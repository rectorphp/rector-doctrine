<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Source\SomeInstance;

final class SkipNonCollection
{
    public Collection $items;

    public function __construct($item)
    {
        $this->items = new ArrayCollection();
        if ($item instanceof SomeInstance) {
            echo 'check';
        }
    }
}

?>
