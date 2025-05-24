<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\InArrayOnCollectionToContainsCallRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class InArrayCollection
{
    public Collection $items;

    public function setItems()
    {
        return in_array(1, $this->items);
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\InArrayOnCollectionToContainsCallRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class InArrayCollection
{
    public Collection $items;

    public function setItems()
    {
        return $this->items->contains(1);
    }
}

?>
