<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowReturnUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class ArrayAndCollection
{
    /**
     * @return ArrayCollection|array
     */
    public function someMethod()
    {

    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowReturnUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class ArrayAndCollection
{
    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function someMethod()
    {

    }
}

?>
