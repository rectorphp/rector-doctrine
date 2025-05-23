<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class AlreadyAssigned
{
    #[OneToMany(targetEntity: 'SomeClass')]
    private $items = [];
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class AlreadyAssigned
{
    #[OneToMany(targetEntity: 'SomeClass')]
    private \Doctrine\Common\Collections\Collection $items;
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }
}

?>
