<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\New_\RemoveNewArrayCollectionWrapRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class RedundantWrap
{
    public Collection $items;

    public function someMethod()
    {
        $values = new ArrayCollection($this->items);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\New_\RemoveNewArrayCollectionWrapRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class RedundantWrap
{
    public Collection $items;

    public function someMethod()
    {
        $values = $this->items;
    }
}

?>
