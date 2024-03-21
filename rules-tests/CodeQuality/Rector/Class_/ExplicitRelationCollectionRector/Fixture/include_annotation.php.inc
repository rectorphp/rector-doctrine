<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToMany;

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

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToMany;

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
