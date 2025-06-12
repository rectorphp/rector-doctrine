<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNullFromNullableCollectionTypeRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class RemoveUnionFromPropertyDocblock
{
    /**
     * @var Collection<int, string>|null
     */
    private Collection $collection;

    public function __construct()
    {
        $this->collection = new ArrayCollection([]);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNullFromNullableCollectionTypeRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class RemoveUnionFromPropertyDocblock
{
    /**
     * @var \Doctrine\Common\Collections\Collection<int, string>
     */
    private Collection $collection;

    public function __construct()
    {
        $this->collection = new ArrayCollection([]);
    }
}

?>
