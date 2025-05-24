<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Empty_\EmptyOnCollectionToIsEmptyCallRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SimpleEmpty
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function setItems()
    {
        return empty($this->items);
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Empty_\EmptyOnCollectionToIsEmptyCallRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SimpleEmpty
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function setItems()
    {
        return $this->items->isEmpty();
    }
}

?>
