<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionSetterParamNativeTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ReplaceEmptyArray
{
    private $items;

    /**
     * @param Collection<int, string> $items
     */
    public function setItems($items = []): void
    {
        $this->items = $items;
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionSetterParamNativeTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ReplaceEmptyArray
{
    private $items;

    /**
     * @param Collection<int, string> $items
     */
    public function setItems(\Doctrine\Common\Collections\Collection $items): void
    {
        $this->items = $items;
    }
}

?>
