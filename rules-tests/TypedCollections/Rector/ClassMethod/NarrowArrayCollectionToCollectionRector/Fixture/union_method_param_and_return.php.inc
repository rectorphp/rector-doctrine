<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class UnionMethodParamAndReturn
{
    /**
     * @param ArrayCollection|string[] $items
     * @return ArrayCollection|string[]
     */
    public function something($items)
    {
        return $items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class UnionMethodParamAndReturn
{
    /**
     * @param \Doctrine\Common\Collections\Collection|string[] $items
     * @return \Doctrine\Common\Collections\Collection|string[]
     */
    public function something($items)
    {
        return $items;
    }
}

?>
