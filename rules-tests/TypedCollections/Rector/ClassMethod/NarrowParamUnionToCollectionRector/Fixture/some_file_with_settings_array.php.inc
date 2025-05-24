<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SomePropertyWithManyTypes
{
    /**
     * @param Collection|string[] $items
     */
    public function someMethod($items)
    {

    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SomePropertyWithManyTypes
{
    /**
     * @param \Doctrine\Common\Collections\Collection<int, string> $items
     */
    public function someMethod($items)
    {

    }
}

?>
