<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionSetterParamNativeTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;

class KeepNonFirstNullable
{
    private $items;

    /**
     * @param Collection<int, string> $items
     */
    public function setItems(int $key, $items = null): void
    {
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionSetterParamNativeTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;

class KeepNonFirstNullable
{
    private $items;

    /**
     * @param Collection<int, string> $items
     */
    public function setItems(int $key, ?\Doctrine\Common\Collections\Collection $items = null): void
    {
    }
}

?>
