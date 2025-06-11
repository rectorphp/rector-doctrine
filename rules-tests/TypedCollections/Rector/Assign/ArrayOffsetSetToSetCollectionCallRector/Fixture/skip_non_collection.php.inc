<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Assign\ArrayOffsetSetToSetCollectionCallRector\Fixture;

final class SkipNonCollection
{
    /**
     * @var array<int, string>
     */
    public $items;

    public function setItems()
    {
        $items = $this->getItems();
        $items[5] = 10;
    }

    private function getItems()
    {
        return $this->items;
    }
}
