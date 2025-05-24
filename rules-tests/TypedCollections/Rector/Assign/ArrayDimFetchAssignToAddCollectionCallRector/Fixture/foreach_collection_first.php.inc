<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Assign\ArrayDimFetchAssignToAddCollectionCallRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ForeachCollectionFirst
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function setItems($item)
    {
        $items = $this->getItems();
        foreach ($items as &$localItem) {
            $localItem = new \stdClass();

            $items[] = $item;
        }
    }

    private function getItems(): Collection
    {
        return $this->items;
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Assign\ArrayDimFetchAssignToAddCollectionCallRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ForeachCollectionFirst
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function setItems($item)
    {
        $items = $this->getItems();
        foreach ($items as &$localItem) {
            $localItem = new \stdClass();

            $items->add($item);
        }
    }

    private function getItems(): Collection
    {
        return $this->items;
    }
}

?>
