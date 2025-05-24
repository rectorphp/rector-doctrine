<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class SimpleArrayCollection
{
    /**
     * @return ArrayCollection
     */
    public function someMethod()
    {

    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class SimpleArrayCollection
{
    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function someMethod()
    {

    }
}

?>
