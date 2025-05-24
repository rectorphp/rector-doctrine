<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\ReturnArrayToNewArrayCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ReturnArrayItems
{
    public function getItems(): Collection
    {
        $items = [1, 2, 3];
        $items[] = 4;

        return $items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\ReturnArrayToNewArrayCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ReturnArrayItems
{
    public function getItems(): Collection
    {
        $items = [1, 2, 3];
        $items[] = 4;

        return new \Doctrine\Common\Collections\ArrayCollection($items);
    }
}

?>
