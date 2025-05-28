<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionSetterParamNativeTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;

interface CoverContractToo
{
    private $items;

    /**
     * @param Collection<int, string> $items
     */
    public function setItems($items): void;
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionSetterParamNativeTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;

interface CoverContractToo
{
    private $items;

    /**
     * @param Collection<int, string> $items
     */
    public function setItems(\Doctrine\Common\Collections\Collection $items): void;
}

?>
