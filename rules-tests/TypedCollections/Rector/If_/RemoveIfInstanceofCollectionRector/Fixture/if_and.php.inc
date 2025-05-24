<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class IfAnd
{
    public Collection $items;

    public function someMethod()
    {
        if ($this->items instanceof Collection && $this->items->count() === 2) {
            return null;
        }

        if ($this->items->count() === 5 && $this->items instanceof Collection) {
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

final class IfAnd
{
    public Collection $items;

    public function someMethod()
    {
        if ($this->items->count() === 2) {
            return null;
        }

        if ($this->items->count() === 5) {
            return null;
        }

        return $this->items;
    }
}

?>
