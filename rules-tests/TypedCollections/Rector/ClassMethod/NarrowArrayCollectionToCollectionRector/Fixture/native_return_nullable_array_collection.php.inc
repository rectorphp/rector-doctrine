<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class NativeReturnNullableArrayCollection
{
    private $items;

    public function someMethod(): ?ArrayCollection
    {
        return $this->items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class NativeReturnNullableArrayCollection
{
    private $items;

    public function someMethod(): ?\Doctrine\Common\Collections\Collection
    {
        return $this->items;
    }
}

?>
