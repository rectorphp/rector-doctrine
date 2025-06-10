<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionSetterParamNativeTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;

interface SetItemsWithArray
{
    private $items;

    /**
     * @param Collection<int, string> $items
     */
    public function setItems($values, $items = []): void;
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionSetterParamNativeTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;

interface SetItemsWithArray
{
    private $items;

    /**
     * @param Collection<int, string> $items
     */
    public function setItems($values, \Doctrine\Common\Collections\Collection $items): void;
}

?>
