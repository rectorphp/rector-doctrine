<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Assign\ArrayOffsetSetToSetCollectionCallRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SkipWithoutDim
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function setItems()
    {
        $items = $this->getItems();
        $items[] = 10;
    }

    private function getItems(): Collection
    {
        return $this->items;
    }
}
