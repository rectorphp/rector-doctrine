<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class InstanceofEqualsFalse
{
    public Collection $items;

    public function someMethod()
    {
        if ($this->items instanceof Collection === false) {
            return null;
        }

        return $this->items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class InstanceofEqualsFalse
{
    public Collection $items;

    public function someMethod()
    {
        return $this->items;
    }
}

?>
