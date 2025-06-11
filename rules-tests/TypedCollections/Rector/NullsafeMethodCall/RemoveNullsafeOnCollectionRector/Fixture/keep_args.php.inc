<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\NullsafeMethodCall\RemoveNullsafeOnCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class KeepArgs
{
    public Collection $items;

    public function someMethod()
    {
        $values = $this->items?->contains(1);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\NullsafeMethodCall\RemoveNullsafeOnCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class KeepArgs
{
    public Collection $items;

    public function someMethod()
    {
        $values = $this->items->contains(1);
    }
}

?>
