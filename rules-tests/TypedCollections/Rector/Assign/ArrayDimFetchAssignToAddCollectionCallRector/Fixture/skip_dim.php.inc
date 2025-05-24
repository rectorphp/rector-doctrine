<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Assign\ArrayDimFetchAssignToAddCollectionCallRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SkipDim
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function setItems($item)
    {
        $this->items[5] = $item;
    }
}
