<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\ReturnArrayToNewArrayCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ReturnNewArray
{
    public function getItems(): Collection
    {
        return [];
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\ReturnArrayToNewArrayCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ReturnNewArray
{
    public function getItems(): Collection
    {
        return new \Doctrine\Common\Collections\ArrayCollection([]);
    }
}

?>
