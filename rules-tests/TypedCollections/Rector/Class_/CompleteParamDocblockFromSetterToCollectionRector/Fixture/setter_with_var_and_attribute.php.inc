<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteParamDocblockFromSetterToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteParamDocblockFromSetterToCollectionRector\Source\Training;

#[ORM\Entity]
class SetterWithVarAndAttribute
{
    /**
     * @var Collection<int, Training>
     */
    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $trainings = [];

    public function setTrainings($trainings)
    {
        $this->trainings = $trainings;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteParamDocblockFromSetterToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteParamDocblockFromSetterToCollectionRector\Source\Training;

#[ORM\Entity]
class SetterWithVarAndAttribute
{
    /**
     * @var Collection<int, Training>
     */
    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $trainings = [];

    /**
     * @param \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteParamDocblockFromSetterToCollectionRector\Source\Training> $trainings
     */
    public function setTrainings($trainings)
    {
        $this->trainings = $trainings;
    }
}

?>
