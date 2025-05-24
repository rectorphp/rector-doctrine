<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Assign\ArrayDimFetchAssignToAddCollectionCallRector\Fixture;

final class SkipNonCollection
{
    /**
     * @var array<int, string>
     */
    public $items;

    public function setItems($item)
    {
        $this->items[] = $item;
    }
}
