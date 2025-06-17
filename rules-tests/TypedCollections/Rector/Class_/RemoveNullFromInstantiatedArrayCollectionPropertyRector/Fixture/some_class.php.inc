<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\RemoveNullFromInstantiatedArrayCollectionPropertyRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class SomeClass
{
    private ?Collection $trainings = null;

    public function __construct()
    {
        $this->trainings = new ArrayCollection();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\RemoveNullFromInstantiatedArrayCollectionPropertyRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class SomeClass
{
    private \Doctrine\Common\Collections\Collection $trainings;

    public function __construct()
    {
        $this->trainings = new ArrayCollection();
    }
}

?>
