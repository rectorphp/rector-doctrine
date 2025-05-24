<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveIfInstance
{
    public Collection $items;

    public function someMethod()
    {
        if ($this->items instanceof  Collection) {
            $this->items->remove(0);
        }
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveIfInstance
{
    public Collection $items;

    public function someMethod()
    {
        $this->items->remove(0);
    }
}

?>
