<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class SilentCoalesce
{
    public Collection $items;

    public function someMethod()
    {
        return $this->items ?? new ArrayCollection();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class SilentCoalesce
{
    public Collection $items;

    public function someMethod()
    {
        return $this->items;
    }
}

?>
