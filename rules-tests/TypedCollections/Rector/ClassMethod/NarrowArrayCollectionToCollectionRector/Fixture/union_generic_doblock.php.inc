<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class UnionGenericDocblock
{
    /**
     * @var ArrayCollection<string>|string[]
     */
    private $items;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class UnionGenericDocblock
{
    /**
     * @var \Doctrine\Common\Collections\Collection<string>|string[]
     */
    private $items;
}

?>
