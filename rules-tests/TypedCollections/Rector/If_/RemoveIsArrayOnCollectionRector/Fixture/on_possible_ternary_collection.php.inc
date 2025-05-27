<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIsArrayOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class OnPossibleTernaryCollection
{
    public $items;

    public function someMethod()
    {
        $arrayItems = is_array($this->items) === false ? $this->items->toArray() : $this->items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIsArrayOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class OnPossibleTernaryCollection
{
    public Collection $items;

    public function someMethod()
    {
        $arrayItems = $this->items->toArray();
    }
}

?>
