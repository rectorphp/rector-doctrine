<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Source\AnyEntity;

final class ManyTypesToCollection
{
    private $items;

    /**
     * @param Collection<AnyEntity>|AnyEntity[]|null $items
     */
    public function setProductSettings(Collection $items): void
    {
        $this->items = $items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Source\AnyEntity;

final class ManyTypesToCollection
{
    private $items;

    /**
     * @param \Doctrine\Common\Collections\Collection<int, AnyEntity> $items
     */
    public function setProductSettings(Collection $items): void
    {
        $this->items = $items;
    }
}

?>
