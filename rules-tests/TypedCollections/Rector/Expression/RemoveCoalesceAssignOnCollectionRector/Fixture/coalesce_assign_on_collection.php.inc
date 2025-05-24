<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Expression\RemoveCoalesceAssignOnCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class CoalesceAssignOnCollection
{
    public Collection $items;

    public function someMethod()
    {
        $this->items ??= new ArrayCollection();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Expression\RemoveCoalesceAssignOnCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class CoalesceAssignOnCollection
{
    public Collection $items;

    public function someMethod()
    {
    }
}

?>
