<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\DefaultCollectionKeyRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ReturnSimpleCollection
{
    /**
     * @return Collection<string>
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

final class ReturnSimpleCollection
{
    /**
     * @return Collection<int, string>
     */
    public function someMethod()
    {
    }
}

?>
