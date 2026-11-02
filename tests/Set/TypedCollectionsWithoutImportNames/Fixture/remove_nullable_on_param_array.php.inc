<?php

namespace Rector\Doctrine\Tests\Set\TypedCollectionsWithoutImportNames\Fixture;

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

namespace Rector\Doctrine\Tests\Set\TypedCollectionsWithoutImportNames\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\Set\TypedCollections\Source\SomeItem;

abstract class RemoveNullableOnParamArray
{

    /**
     * @param \Doctrine\Common\Collections\Collection<int, SomeItem> $items
     */
    public function handleAllocations(int $counter, \Doctrine\Common\Collections\Collection $items): void
    {
        foreach ($items as $item) {
        }
    }
}

?>
