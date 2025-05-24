<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Source\Training;

#[ORM\Entity]
final class AttributeGetterWithReturnType
{
    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $trainings;

    public function getTrainings(): Collection
    {
        return $this->trainings;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Source\Training;

#[ORM\Entity]
final class AttributeGetterWithReturnType
{
    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $trainings;

    /**
     * @return \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Source\Training>
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }
}

?>
