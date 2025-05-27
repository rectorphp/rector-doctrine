<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIsArrayOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class NegatedIsArrayTernary
{
    public Collection $items;

    public function someMethod()
    {
        return is_array($this->items) === false ? $this->items->toArray() : $this->items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIsArrayOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class NegatedIsArrayTernary
{
    public Collection $items;

    public function someMethod()
    {
        return $this->items->toArray();
    }
}

?>
