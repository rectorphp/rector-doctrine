<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class ParamArrayCollection
{
    /**
     * @param ArrayCollection $items
     */
    public function someMethod($items)
    {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class ParamArrayCollection
{
    /**
     * @param \Doctrine\Common\Collections\Collection $items
     */
    public function someMethod($items)
    {
    }
}

?>
