<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithSetter;

final class HandleMultiArgs
{
    public function run()
    {
        $someVariable = [new ItemType(), new ItemType()];
        $nextVariable = [new ItemType(), new ItemType()];

        $someClassWithSetter = new SomeClassWithSetter();
        $someClassWithSetter->setItems($someVariable, $nextVariable);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithSetter;

final class HandleMultiArgs
{
    public function run()
    {
        $someVariable = [new ItemType(), new ItemType()];
        $nextVariable = [new ItemType(), new ItemType()];

        $someClassWithSetter = new SomeClassWithSetter();
        $someClassWithSetter->setItems(new \Doctrine\Common\Collections\ArrayCollection($someVariable), new \Doctrine\Common\Collections\ArrayCollection($nextVariable));
    }
}

?>
