<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithSetter;

final class SomeFileWithSettingsArray
{
    public function run()
    {
        $someClassWithSetter = new SomeClassWithSetter();
        $someClassWithSetter->setItems([new ItemType(), new ItemType()]);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\SomeClassWithSetter;

final class SomeFileWithSettingsArray
{
    public function run()
    {
        $someClassWithSetter = new SomeClassWithSetter();
        $someClassWithSetter->setItems(new \Doctrine\Common\Collections\ArrayCollection([new ItemType(), new ItemType()]));
    }
}

?>
