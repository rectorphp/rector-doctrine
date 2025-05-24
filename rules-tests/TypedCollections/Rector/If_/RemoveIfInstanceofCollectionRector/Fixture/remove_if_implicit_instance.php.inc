<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveIfImplicitInstance
{
    public Collection $items;

    public function someMethod()
    {
        if ($this->items) {
            $this->items->remove(0);
        }
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveIfImplicitInstance
{
    public Collection $items;

    public function someMethod()
    {
        $this->items->remove(0);
    }
}

?>
