<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Fixture\OneToMany;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

final class Trainer
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $trainings;

    public function getTrainings(): Collection
    {
        return $this->trainings;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Fixture\OneToMany;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

final class Trainer
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $trainings;

    public function getTrainings(): Collection
    {
        return $this->trainings;
    }
}

?>
