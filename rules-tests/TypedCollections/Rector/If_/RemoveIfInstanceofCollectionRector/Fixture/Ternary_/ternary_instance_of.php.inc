<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture\Ternary_;

use Doctrine\Common\Collections\Collection;

final class TernaryInstanceOf
{
    public Collection $items;

    public function someMethod()
    {
        return $this->items instanceof Collection ? 1 : 2;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture\Ternary_;

use Doctrine\Common\Collections\Collection;

final class TernaryInstanceOf
{
    public Collection $items;

    public function someMethod()
    {
        return 1;
    }
}

?>
