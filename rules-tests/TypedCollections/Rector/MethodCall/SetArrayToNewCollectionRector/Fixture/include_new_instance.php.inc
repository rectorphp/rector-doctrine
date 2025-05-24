<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithConstructorCollection;

final class IncludeNewInstance
{
    public function run()
    {
        $someVariable = [new ItemType(), new ItemType()];

        return new SomeClassWithConstructorCollection($someVariable);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithConstructorCollection;

final class IncludeNewInstance
{
    public function run()
    {
        $someVariable = [new ItemType(), new ItemType()];

        return new SomeClassWithConstructorCollection(new \Doctrine\Common\Collections\ArrayCollection($someVariable));
    }
}

?>
