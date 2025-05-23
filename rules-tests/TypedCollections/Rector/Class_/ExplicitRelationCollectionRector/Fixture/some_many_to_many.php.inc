<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToMany;

#[Entity]
class SomeManyToMany
{
    #[ManyToMany(targetEntity: 'SomeClass')]
    private $items = [];
    public function __construct()
    {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToMany;

#[Entity]
class SomeManyToMany
{
    #[ManyToMany(targetEntity: 'SomeClass')]
    private \Doctrine\Common\Collections\Collection $items;
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }
}

?>
