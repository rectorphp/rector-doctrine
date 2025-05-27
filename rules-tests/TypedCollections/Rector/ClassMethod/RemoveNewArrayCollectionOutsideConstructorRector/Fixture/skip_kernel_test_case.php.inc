<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNewArrayCollectionOutsideConstructorRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class SkipKernelTestCase extends KernelTestCase
{
    public function testThis()
    {
        $setupArray = new ArrayCollection();

        $this->assertInstanceOf(Collection::class, $setupArray);
    }
}
