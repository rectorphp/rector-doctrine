<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Expression\RemoveAssertNotNullOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class AlsoIncludeMessage
{
    public Collection $items;

    public function someMethod()
    {
        \PHPUnit\Framework\Assert::assertNotNull($this->items, 'some message');
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Expression\RemoveAssertNotNullOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class AlsoIncludeMessage
{
    public Collection $items;

    public function someMethod()
    {
    }
}

?>
