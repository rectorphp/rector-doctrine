<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Source\AnyEntity;

final class ParamNullable
{
    /**
     * @param ?Collection<AnyEntity> $items
     */
    public function someMethod(Collection $items)
    {

    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Source\AnyEntity;

final class ParamNullable
{
    /**
     * @param Collection<int, AnyEntity> $items
     */
    public function someMethod(Collection $items)
    {

    }
}

?>
