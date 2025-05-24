<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionParamTypeSetterToCollectionPropertyRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveNullFromParamCollection
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function setItems(Collection $items = null)
    {
        $this->items = $items;
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionParamTypeSetterToCollectionPropertyRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveNullFromParamCollection
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function setItems(Collection $items)
    {
        $this->items = $items;
    }
}

?>
