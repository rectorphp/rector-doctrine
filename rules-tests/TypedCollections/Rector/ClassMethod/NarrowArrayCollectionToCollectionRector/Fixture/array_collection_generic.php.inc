<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class ArrayCollectionGeneric
{
    /**
     * @return ArrayCollection<int, string>
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

final class ArrayCollectionGeneric
{
    /**
     * @return \Doctrine\Common\Collections\Collection<int, string>
     */
    public function someMethod()
    {
    }
}

?>
