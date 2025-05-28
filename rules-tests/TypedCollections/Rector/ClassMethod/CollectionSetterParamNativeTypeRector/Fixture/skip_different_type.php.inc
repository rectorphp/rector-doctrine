<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionSetterParamNativeTypeRector\Fixture;

final class SkipDifferentType
{
    private $items;

    /**
     * @param int[] $items
     */
    public function setItems($items): void
    {
        $this->items = $items;
    }
}
