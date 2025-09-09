<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionDocblockGenericTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

final class SkipNoTypeAdded
{
    public function getItems(): Collection
    {
        $collection = new ArrayCollection();

        return $collection;
    }
}
