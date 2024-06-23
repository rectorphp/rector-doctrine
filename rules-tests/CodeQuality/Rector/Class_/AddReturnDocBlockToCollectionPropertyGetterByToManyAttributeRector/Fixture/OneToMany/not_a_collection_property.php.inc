<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAttributeRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAttributeRector\Source\Training;

#[ORM\Entity]
final class Trainer
{
    private $trainings;

    public function getTrainings(): Collection
    {
        return $this->trainings;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAttributeRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAttributeRector\Source\Training;

#[ORM\Entity]
final class Trainer
{
    private $trainings;

    public function getTrainings(): Collection
    {
        return $this->trainings;
    }
}

?>
