<?php

namespace Rector\Doctrine\Tests\Set\TypedCollections\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\Set\TypedCollections\Source\SomeItem;

abstract class RemoveNullableOnParamArray
{

    /**
     * @param array|ArrayCollection|SomeItem[] $items
     */
    public function handleAllocations(int $counter, $items = []): void
    {
        foreach ($items as $item) {
        }
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\TypedCollections\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\Set\TypedCollections\Source\SomeItem;

abstract class RemoveNullableOnParamArray
{

    /**
     * @param Collection<int, SomeItem> $items
     */
    public function handleAllocations(int $counter, Collection $items): void
    {
        foreach ($items as $item) {
        }
    }
}

?>
