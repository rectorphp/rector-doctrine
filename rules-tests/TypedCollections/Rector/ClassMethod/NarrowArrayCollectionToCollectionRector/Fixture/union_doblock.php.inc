<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class UnionDocblock
{
    /**
     * @var ArrayCollection|string[]
     */
    private $items;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class UnionDocblock
{
    /**
     * @var \Doctrine\Common\Collections\Collection|string[]
     */
    private $items;
}

?>
