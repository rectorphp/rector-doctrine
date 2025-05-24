<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class ArrayCollectionInUnion
{
    public function someMethod(ArrayCollection|array $items)
    {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class ArrayCollectionInUnion
{
    public function someMethod(\Doctrine\Common\Collections\Collection|array $items)
    {
    }
}

?>
