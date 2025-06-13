<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\FuncCall\ArrayMapOnCollectionToArrayRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ArrayFilterToArray
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function merge()
    {
        $items = $this->items;

        return array_filter($items, fn ($item) => $item);
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\FuncCall\ArrayMapOnCollectionToArrayRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ArrayFilterToArray
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function merge()
    {
        $items = $this->items;

        return array_filter($items->toArray(), fn ($item) => $item);
    }
}

?>
