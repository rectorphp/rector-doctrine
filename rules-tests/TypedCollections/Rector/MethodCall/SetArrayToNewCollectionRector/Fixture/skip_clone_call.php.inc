<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithSetter;

final class SkipCloneCall
{
    public function run()
    {
        $someClassWithSetter = new SomeClassWithSetter();
        $arrayCollection = new ArrayCollection([]);

        $someClassWithSetter->setItems(clone $arrayCollection);
    }
}
