<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNullFromNullableCollectionTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SomeParamNullable
{
    private $collection;

    public function setItems(?Collection $collection): void
    {
        $this->collection = $collection;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNullFromNullableCollectionTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SomeParamNullable
{
    private $collection;

    public function setItems(Collection $collection): void
    {
        $this->collection = $collection;
    }
}

?>
