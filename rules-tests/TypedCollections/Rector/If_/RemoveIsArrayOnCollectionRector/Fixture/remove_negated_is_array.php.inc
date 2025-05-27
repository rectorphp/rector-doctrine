<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIsArrayOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveNegatedIsArray
{
    public Collection $items;

    public function someMethod()
    {
        if (! is_array($this->items)) {
            $items = $this->items->toArray();
        }
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIsArrayOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveNegatedIsArray
{
    public Collection $items;

    public function someMethod()
    {
        $items = $this->items->toArray();
    }
}

?>
