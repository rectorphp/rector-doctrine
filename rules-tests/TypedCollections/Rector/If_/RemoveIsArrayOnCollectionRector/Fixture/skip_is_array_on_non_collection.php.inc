<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIsArrayOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SkipIsArrayOnNonCollection
{
    public $items;

    public function someMethod()
    {
        return ! is_array($this->items) ? $this->items : [];
    }

    public function nextMethod()
    {
        return is_array($this->items) ? $this->items : [];
    }

    public function condition()
    {
        if (! is_array($this->items)) {
            return 'yes';
        }

        return 'no';
    }
}
