<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class IfEqualsNull
{
    public Collection $items;

    public function someMethod()
    {
        if ($this->items === null) {
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

final class IfEqualsNull
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
