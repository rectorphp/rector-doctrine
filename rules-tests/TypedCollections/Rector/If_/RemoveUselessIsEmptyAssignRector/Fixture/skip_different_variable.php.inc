<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveUselessIsEmptyAssignRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class SkipDifferentVariable
{
    public Collection $items;

    public function someMethod()
    {
        if ($this->items->isEmpty()) {
            $this->another = new ArrayCollection();
        }

        return $this->items;
    }
}
