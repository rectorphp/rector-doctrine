<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithSetter;

final class HandleDocBlockParamType
{
    public function run()
    {
        $someVariable = [new ItemType(), new ItemType()];

        $someClassWithSetter = new SomeClassWithSetter();
        $someClassWithSetter->setDocblockItemsWithNullable($someVariable);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithSetter;

final class HandleDocBlockParamType
{
    public function run()
    {
        $someVariable = [new ItemType(), new ItemType()];

        $someClassWithSetter = new SomeClassWithSetter();
        $someClassWithSetter->setDocblockItemsWithNullable(new \Doctrine\Common\Collections\ArrayCollection($someVariable));
    }
}

?>
