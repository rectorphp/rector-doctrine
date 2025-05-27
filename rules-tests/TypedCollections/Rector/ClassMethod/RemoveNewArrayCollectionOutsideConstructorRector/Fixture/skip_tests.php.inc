<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNewArrayCollectionOutsideConstructorRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

final class SkipTests extends TestCase
{
    public function testThis()
    {
        $setupArray = new ArrayCollection();

        $this->assertInstanceOf(Collection::class, $setupArray);
    }
}
