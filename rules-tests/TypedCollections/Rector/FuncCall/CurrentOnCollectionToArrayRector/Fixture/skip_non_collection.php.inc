<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\FuncCall\CurrentOnCollectionToArrayRector\Fixture;

final class SkipNonCollection
{
    /**
     * @var array<int, string>
     */
    public $items;

    public function merge()
    {
        return current($this->items);
    }
}
