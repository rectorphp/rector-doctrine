<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Expression\RemoveAssertNotNullOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SomeClass
{
    public Collection $items;

    public function someMethod()
    {
        \PHPUnit\Framework\Assert::assertNotNull($this->items);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Expression\RemoveAssertNotNullOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SomeClass
{
    public Collection $items;

    public function someMethod()
    {
    }
}

?>
