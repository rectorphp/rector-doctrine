<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\NarrowPropertyUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SomePropertyWithManyTypes
{
    /**
     * @var Collection|int[]
     */
    public $items;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\NarrowPropertyUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SomePropertyWithManyTypes
{
    /**
     * @var \Doctrine\Common\Collections\Collection<int, int>
     */
    public $items;
}

?>
