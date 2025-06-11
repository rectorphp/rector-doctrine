<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\AssertSameCountOnCollectionToAssertCountRector\Fixture;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

final class AssertCount extends TestCase
{
    public Collection $items;

    public function someMethod()
    {
        $this->assertSame(10, $this->items->count());
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\AssertSameCountOnCollectionToAssertCountRector\Fixture;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

final class AssertCount extends TestCase
{
    public Collection $items;

    public function someMethod()
    {
        $this->assertCount(10, $this->items);
    }
}

?>
