<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\ManyToMany;

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

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * @\Doctrine\ODM\MongoDB\Mapping\Annotations\Document
 */
class OdmDocument
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany()
     */
    private \Doctrine\Common\Collections\Collection $items;
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }
}

?>
