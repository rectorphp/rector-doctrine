<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\ReturnCollectionDocblockRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SkipAlreadySet
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    /**
     * @return Collection<int, string>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }
}
