<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\FuncCall\ArrayMapOnCollectionToArrayRector\Fixture;

final class SkipNonCollection
{
    /**
     * @var array<int, string>
     */
    public $items;

    public function merge()
    {
        $items = $this->items;

        return array_filter($items, fn ($item) => $item);
    }
}
