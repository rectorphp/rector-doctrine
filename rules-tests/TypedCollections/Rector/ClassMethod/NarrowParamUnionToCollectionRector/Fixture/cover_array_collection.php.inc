<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class CoverArrayCollection
{
    /**
     * @param ArrayCollection|string[] $items
     */
    public function someMethod($items)
    {

    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class CoverArrayCollection
{
    /**
     * @param \Doctrine\Common\Collections\Collection<int, string> $items
     */
    public function someMethod($items)
    {

    }
}

?>
