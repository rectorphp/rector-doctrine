<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\FuncCall\ArrayMapOnCollectionToArrayRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ArrayMapRun
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function merge()
    {
        return array_map(fn ($item) => $item, $this->items);
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\FuncCall\ArrayMapOnCollectionToArrayRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ArrayMapRun
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function merge()
    {
        return array_map(fn ($item) => $item, $this->items->toArray());
    }
}

?>
