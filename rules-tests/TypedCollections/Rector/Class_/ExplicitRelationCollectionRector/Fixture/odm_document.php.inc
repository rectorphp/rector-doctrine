<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

/**
 * @\Doctrine\ODM\MongoDB\Mapping\Annotations\Document
 */
class OdmDocument
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany()
     */
    private $items = [];
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

/**
 * @\Doctrine\ODM\MongoDB\Mapping\Annotations\Document
 */
class OdmDocument
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany()
     */
    private $items = [];
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }
}

?>
