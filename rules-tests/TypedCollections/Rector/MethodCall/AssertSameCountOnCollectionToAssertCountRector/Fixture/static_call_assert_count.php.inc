<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\AssertSameCountOnCollectionToAssertCountRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Webmozart\Assert\Assert;

final class StaticCallAssertCount
{
    public Collection $items;

    public function someMethod()
    {
        Assert::assertSame(10, $this->items->count());
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\AssertSameCountOnCollectionToAssertCountRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Webmozart\Assert\Assert;

final class StaticCallAssertCount
{
    public Collection $items;

    public function someMethod()
    {
        Assert::assertCount(10, $this->items);
    }
}

?>
