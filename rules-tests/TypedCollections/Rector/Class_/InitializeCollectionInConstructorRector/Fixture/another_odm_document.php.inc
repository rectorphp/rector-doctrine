<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\InitializeCollectionInConstructorRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\InitializeCollectionInConstructorRector\Source\RelatedEntity;

/**
 * @MongoDB\Document()
 */
final class AnotherOdmDocument
{
    /**
     * @MongoDB\EmbedMany()
     *
     * @var Collection<int, RelatedEntity>
     */
    protected Collection $items;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\InitializeCollectionInConstructorRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\InitializeCollectionInConstructorRector\Source\RelatedEntity;

/**
 * @MongoDB\Document()
 */
final class AnotherOdmDocument
{
    /**
     * @MongoDB\EmbedMany()
     *
     * @var Collection<int, RelatedEntity>
     */
    protected Collection $items;
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }
}

?>
