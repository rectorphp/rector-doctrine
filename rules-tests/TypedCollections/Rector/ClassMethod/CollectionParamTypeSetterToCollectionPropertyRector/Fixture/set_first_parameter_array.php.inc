<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionParamTypeSetterToCollectionPropertyRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SetFirstParameterArray
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function setItems(array $items)
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

final class SetFirstParameterArray
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function setItems(\Doctrine\Common\Collections\Collection $items)
    {
        $this->items = $items;
    }
}

?>
