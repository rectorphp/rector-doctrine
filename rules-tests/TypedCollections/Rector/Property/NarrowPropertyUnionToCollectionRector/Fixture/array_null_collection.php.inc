<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\NarrowPropertyUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class SomePropertyWithManyTypes
{
    /**
     * @var ArrayCollection<int>|null
     */
    public $items;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\NarrowPropertyUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class SomePropertyWithManyTypes
{
    /**
     * @var \Doctrine\Common\Collections\Collection<int>|null
     */
    public $items;
}

?>
