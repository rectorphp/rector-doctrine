<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\AssertNullOnCollectionToAssertEmptyRector\Fixture;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

final class AssertNullOnCollection extends TestCase
{
    public Collection $items;

    public function someMethod()
    {
        $this->assertNull($this->items);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\AssertNullOnCollectionToAssertEmptyRector\Fixture;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

final class AssertNullOnCollection extends TestCase
{
    public Collection $items;

    public function someMethod()
    {
        $this->assertEmpty($this->items);
    }
}

?>
