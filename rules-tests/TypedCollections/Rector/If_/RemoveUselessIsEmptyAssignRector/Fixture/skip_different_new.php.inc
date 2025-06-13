<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveUselessIsEmptyAssignRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class SkipDifferentNew
{
    public Collection $items;

    public function someMethod()
    {
        if ($this->items->isEmpty()) {
            $this->items = new \stdClass();
        }

        return $this->items;
    }
}
