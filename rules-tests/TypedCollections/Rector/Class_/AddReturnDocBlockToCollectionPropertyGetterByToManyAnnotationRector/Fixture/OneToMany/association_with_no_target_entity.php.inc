<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 */
final class Trainer
{
    /**
     * @ORM\OneToMany
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

use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 */
final class Trainer
{
    /**
     * @ORM\OneToMany
     */
    private $trainings;

    public function getTrainings(): Collection
    {
        return $this->trainings;
    }
}

?>
