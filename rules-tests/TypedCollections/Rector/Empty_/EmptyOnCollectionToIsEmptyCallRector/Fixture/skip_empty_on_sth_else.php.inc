<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Empty_\EmptyOnCollectionToIsEmptyCallRector\Fixture;

final class SkipEmptyOnSthElse
{
    /**
     * @var array<int, string>
     */
    public $items;

    public function setItems()
    {
        return empty($this->items);
    }
}
