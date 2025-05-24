<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class ArrayCollectionAndNull
{
    /**
     * @param ArrayCollection|null $items
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

final class ArrayCollectionAndNull
{
    /**
     * @param \Doctrine\Common\Collections\Collection|null $items
     */
    public function someMethod($items)
    {

    }
}

?>
