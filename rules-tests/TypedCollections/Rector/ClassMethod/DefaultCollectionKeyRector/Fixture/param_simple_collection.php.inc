<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\DefaultCollectionKeyRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SimpleArrayCollection
{
    /**
     * @param Collection<string> $items
     */
    public function someMethod()
    {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\DefaultCollectionKeyRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SimpleArrayCollection
{
    /**
     * @param Collection<int, string> $items
     */
    public function someMethod()
    {
    }
}

?>
