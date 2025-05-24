<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ArrayAndCollection
{
    public function someMethod(): Collection|array
    {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ArrayAndCollection
{
    public function someMethod(): Collection
    {
    }
}

?>
