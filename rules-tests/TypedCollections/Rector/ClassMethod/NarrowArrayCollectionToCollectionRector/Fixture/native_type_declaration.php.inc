<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class NativeTypeDeclaration
{
    public function someMethod($items): ArrayCollection
    {
        return new ArrayCollection([1, 2, 3]);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class NativeTypeDeclaration
{
    public function someMethod($items): \Doctrine\Common\Collections\Collection
    {
        return new ArrayCollection([1, 2, 3]);
    }
}

?>
