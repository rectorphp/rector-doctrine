<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\FuncCall\ArrayMapOnCollectionToArrayRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ArrayMapOnAssignedVariable
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function merge()
    {
        $items = $this->items;

        return array_map(fn ($item) => $item, $items);
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\FuncCall\ArrayMapOnCollectionToArrayRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ArrayMapOnAssignedVariable
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function merge()
    {
        $items = $this->items;

        return array_map(fn ($item) => $item, $items->toArray());
    }
}

?>
