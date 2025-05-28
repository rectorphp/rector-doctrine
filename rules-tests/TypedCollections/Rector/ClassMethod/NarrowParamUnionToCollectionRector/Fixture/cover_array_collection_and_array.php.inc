<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class ArrayCollectionAndArray
{
    /**
     * @param ArrayCollection|array<float, string> $items
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

final class ArrayCollectionAndArray
{
    /**
     * @param \Doctrine\Common\Collections\Collection<float, string> $items
     */
    public function someMethod($items)
    {

    }
}

?>
