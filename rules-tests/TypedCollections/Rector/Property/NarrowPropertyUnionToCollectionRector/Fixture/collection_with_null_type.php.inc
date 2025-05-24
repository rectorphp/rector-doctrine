<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\NarrowPropertyUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class CollectionWithNullType
{
    /**
     * @var Collection<int>|null
     */
    public Collection $items;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\NarrowPropertyUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class CollectionWithNullType
{
    /**
     * @var Collection<int>
     */
    public Collection $items;
}

?>
