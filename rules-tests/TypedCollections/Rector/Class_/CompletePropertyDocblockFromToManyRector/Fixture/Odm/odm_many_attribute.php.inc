<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\Odm;

use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;

#[Document]
final class OdmMany
{
    #[ReferenceMany(targetDocument: Training::class)]
    private $items = [];

    public function getItems()
    {
        return $this->items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\Odm;

use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;

#[Document]
final class OdmMany
{
    /**
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training>
     */
    #[ReferenceMany(targetDocument: Training::class)]
    private $items = [];

    public function getItems()
    {
        return $this->items;
    }
}

?>
