<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class RemoveNegatedIsArray
{
    public Collection $items;

    public function someMethod()
    {
        if (! $this->items instanceof Collection) {
            $this->items = new ArrayCollection();
        }
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class RemoveNegatedIsArray
{
    public Collection $items;

    public function someMethod()
    {
    }
}

?>
