<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithNativeSetter;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithSetter;

final class HandleNativeParamType
{
    public function run()
    {
        $someVariable = [new ItemType(), new ItemType()];

        $someClassWithNativeSetter = new SomeClassWithNativeSetter();
        $someClassWithNativeSetter->setItems($someVariable);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithNativeSetter;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithSetter;

final class HandleNativeParamType
{
    public function run()
    {
        $someVariable = [new ItemType(), new ItemType()];

        $someClassWithNativeSetter = new SomeClassWithNativeSetter();
        $someClassWithNativeSetter->setItems(new \Doctrine\Common\Collections\ArrayCollection($someVariable));
    }
}

?>
