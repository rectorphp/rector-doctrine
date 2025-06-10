<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNullFromNullableCollectionTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SkipUnlessSingleParam
{
    private $collection;

    public function setItems(?Collection $collection, int $counter = 25): void
    {
        $this->collection = $collection;
    }
}
