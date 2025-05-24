<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowReturnUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SomePropertyWithManyTypes
{
    /**
     * @return Collection|string[]
     */
    public function someMethod()
    {

    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowReturnUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SomePropertyWithManyTypes
{
    /**
     * @return \Doctrine\Common\Collections\Collection<int, string>
     */
    public function someMethod()
    {

    }
}

?>
