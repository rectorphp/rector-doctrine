<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\NarrowPropertyUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\NarrowPropertyUnionToCollectionRector\Source\SomeIterableObject;

final class NarrowIntersection
{
    /**
     * @var (Collection & iterable<SomeIterableObject>)
     */
    public $items;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\NarrowPropertyUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class NarrowIntersection
{
    /**
     * @var Collection<int, SomeIterableObject>
     */
    public $items;
}

?>
