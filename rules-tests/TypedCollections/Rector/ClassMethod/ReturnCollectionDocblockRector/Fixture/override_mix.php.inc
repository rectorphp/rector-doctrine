<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\ReturnCollectionDocblockRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class OverrideMix
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    /**
     * @return Collection|string[]
     */
    public function getItems()
    {
        return $this->items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\ReturnCollectionDocblockRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class OverrideMix
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    /**
     * @return \Doctrine\Common\Collections\Collection<int, string>
     */
    public function getItems()
    {
        return $this->items;
    }
}

?>
