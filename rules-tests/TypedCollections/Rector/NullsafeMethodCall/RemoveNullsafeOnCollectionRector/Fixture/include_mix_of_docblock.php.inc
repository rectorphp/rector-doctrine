<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\NullsafeMethodCall\RemoveNullsafeOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class IncludeMixOfDocblock
{
    /**
     * @var Collection<string>|null
     */
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

use Doctrine\Common\Collections\Collection;

final class IncludeMixOfDocblock
{
    /**
     * @var Collection<string>|null
     */
    public Collection $items;

    public function someMethod()
    {
        $values = $this->items->count();
    }
}

?>
