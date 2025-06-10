<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\NullsafeMethodCall\RemoveNullsafeOnCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class RedundantNullsafeOnCollection
{
    public Collection $items;

    public function someMethod()
    {
        $values = $this->items?->count();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\NullsafeMethodCall\RemoveNullsafeOnCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class RedundantNullsafeOnCollection
{
    public Collection $items;

    public function someMethod()
    {
        $values = $this->items->count();
    }
}

?>
