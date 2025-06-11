<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture\Ternary_;

use Doctrine\Common\Collections\Collection;

final class IsObjectToDirect
{
    public Collection $items;

    public function someMethod()
    {
        return is_object($this->items) ? 1 : 2;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture\Ternary_;

use Doctrine\Common\Collections\Collection;

final class IsObjectToDirect
{
    public Collection $items;

    public function someMethod()
    {
        return 1;
    }
}

?>
