<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\ReturnCollectionDocblockRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SomeFileWithSettingsArray
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function getItems(): Collection
    {
        return $this->items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\ReturnCollectionDocblockRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SomeFileWithSettingsArray
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    /**
     * @return \Doctrine\Common\Collections\Collection<int, string>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }
}

?>
