<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Doctrine\Common\Collections\Collection;

final class IncludeLocalSetter
{
    public function run()
    {
        $someVariable = [new ItemType(), new ItemType()];

        $this->setItems($someVariable);
    }

    public function setItems(Collection $collection)
    {
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Fixture;

use Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source\ItemType;
use Doctrine\Common\Collections\Collection;

final class IncludeLocalSetter
{
    public function run()
    {
        $someVariable = [new ItemType(), new ItemType()];

        $this->setItems(new \Doctrine\Common\Collections\ArrayCollection($someVariable));
    }

    public function setItems(Collection $collection)
    {
    }
}

?>
