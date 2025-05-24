<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithSetter;

final class SkipCloneFromAnotherMethod
{
    public function run()
    {
        $someClassWithSetter =  new SomeClassWithSetter();
        $arrayCollection = clone $this->getCollection();

        $someClassWithSetter->setItems(clone $arrayCollection);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection<int, string>
     */
    private function getCollection()
    {
        return [];
    }
}
