<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNewArrayCollectionOutsideConstructorRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class NoAssignOutsideConstructor
{
    public Collection $items;

    public function anotherMethod()
    {
        $this->items = new ArrayCollection();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNewArrayCollectionOutsideConstructorRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class NoAssignOutsideConstructor
{
    public Collection $items;

    public function anotherMethod()
    {
    }
}

?>
