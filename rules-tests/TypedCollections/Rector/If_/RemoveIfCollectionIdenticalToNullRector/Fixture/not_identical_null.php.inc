<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfCollectionIdenticalToNullRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class NotIdenticalNull
{
    public Collection $items;

    public function someMethod()
    {
        if ($this->items !== null && $this->items->isEmpty()) {
            return true;
        }

        return false;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfCollectionIdenticalToNullRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class NotIdenticalNull
{
    public Collection $items;

    public function someMethod()
    {
        if ($this->items->isEmpty()) {
            return true;
        }

        return false;
    }
}

?>
