<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowReturnUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Source\AnyEntity;

final class NullableUnionCollection
{
    /**
     * @return Collection<int, AnyEntity>
     */
    public function someMethod(): Collection|null
    {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowReturnUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\Source\AnyEntity;

final class NullableUnionCollection
{
    /**
     * @return Collection<int, AnyEntity>
     */
    public function someMethod(): Collection
    {
    }
}

?>
