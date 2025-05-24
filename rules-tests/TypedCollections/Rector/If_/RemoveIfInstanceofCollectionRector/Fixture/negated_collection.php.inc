<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class NegatedCollection
{
    public Collection $items;

    public function someMethod()
    {
        if (! $this->items) {
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

final class NegatedCollection
{
    public Collection $items;

    public function someMethod()
    {
        if ($this->items->isEmpty()) {
            return null;
        }

        return $this->items;
    }
}

?>
