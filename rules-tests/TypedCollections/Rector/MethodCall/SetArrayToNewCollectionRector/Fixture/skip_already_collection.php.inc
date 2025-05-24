<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithSetter;

final class SkipAlreadyCollection
{
    public function run()
    {
        $someVariable = [new ItemType(), new ItemType()];

        $someClassWithSetter = new SomeClassWithSetter();
        $someClassWithSetter->setItems(new ArrayCollection($someVariable));
    }
}
