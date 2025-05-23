<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

/**
 * @Entity
 */
class IncludeAnnotation
{
    /**
     * @ManyToMany(targetEntity="SomeClass")
     */
    private $items = [];
    public function __construct()
    {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

/**
 * @Entity
 */
class IncludeAnnotation
{
    /**
     * @ManyToMany(targetEntity="SomeClass")
     */
    private \Doctrine\Common\Collections\Collection $items;
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }
}

?>
