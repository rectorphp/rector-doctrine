<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionDocblockGenericTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionDocblockGenericTypeRector\Source\RandomHouse;

final class MultipleItemsAdded
{
    public function getItems(): Collection
    {
        $collection = new ArrayCollection();
        $collection->add(new RandomHouse());

        $collection->add(new RandomHouse());

        return $collection;
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionDocblockGenericTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionDocblockGenericTypeRector\Source\RandomHouse;

final class MultipleItemsAdded
{
    /**
     * @return \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionDocblockGenericTypeRector\Source\RandomHouse>
     */
    public function getItems(): Collection
    {
        $collection = new ArrayCollection();
        $collection->add(new RandomHouse());

        $collection->add(new RandomHouse());

        return $collection;
    }
}

?>
