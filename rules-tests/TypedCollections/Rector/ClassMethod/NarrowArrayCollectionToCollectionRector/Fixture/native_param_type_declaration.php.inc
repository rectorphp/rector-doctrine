<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class NativeParamTypeDeclaration
{
    private $items;

    /**
     * @param \Doctrine\Common\Collections\Collection<int, string> $items
     */
    public function someMethod(ArrayCollection $items): void
    {
        $this->items = $items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class NativeParamTypeDeclaration
{
    private $items;

    /**
     * @param \Doctrine\Common\Collections\Collection<int, string> $items
     */
    public function someMethod(\Doctrine\Common\Collections\Collection $items): void
    {
        $this->items = $items;
    }
}

?>
