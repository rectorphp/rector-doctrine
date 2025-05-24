<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Fixture\Odm;

/**
 * @\Doctrine\ODM\MongoDB\Mapping\Annotations\Document
 */
final class OdmMany
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany(targetDocument="\Rector\Doctrine\Tests\TypedCollections\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Source\Training")
     */
    private $items = [];

    public function getItems()
    {
        return $this->items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Fixture\Odm;

/**
 * @\Doctrine\ODM\MongoDB\Mapping\Annotations\Document
 */
final class OdmMany
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany(targetDocument="\Rector\Doctrine\Tests\TypedCollections\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Source\Training")
     */
    private $items = [];

    /**
     * @return \Doctrine\Common\Collections\Collection<int, \\Rector\Doctrine\Tests\TypedCollections\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Source\Training>
     */
    public function getItems()
    {
        return $this->items;
    }
}

?>
