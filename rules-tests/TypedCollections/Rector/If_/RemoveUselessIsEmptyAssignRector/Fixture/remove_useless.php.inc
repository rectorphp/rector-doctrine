<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveUselessIsEmptyAssignRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class RemoveUseless
{
    public Collection $items;

    public function someMethod()
    {
        if ($this->items->isEmpty()) {
            $this->items = new ArrayCollection();
        }

        return $this->items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveUselessIsEmptyAssignRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class RemoveUseless
{
    public Collection $items;

    public function someMethod()
    {
        return $this->items;
    }
}

?>
