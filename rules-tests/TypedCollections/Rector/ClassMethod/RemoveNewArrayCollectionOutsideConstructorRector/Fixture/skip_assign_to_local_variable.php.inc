<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNewArrayCollectionOutsideConstructorRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class SkipAssignToLocalVariable
{
    public function create(array $someItems): ArrayCollection
    {
        $items = new ArrayCollection();

        return $items;
    }
}
