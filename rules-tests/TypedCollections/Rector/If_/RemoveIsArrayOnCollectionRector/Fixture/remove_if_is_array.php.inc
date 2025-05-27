<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIsArrayOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveIfIsArray
{
    public Collection $items;

    public function someMethod()
    {
        if (is_array($this->items)) {
            return 1;
        }

        return 2;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIsArrayOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveIfIsArray
{
    public Collection $items;

    public function someMethod()
    {
        return 2;
    }
}

?>
