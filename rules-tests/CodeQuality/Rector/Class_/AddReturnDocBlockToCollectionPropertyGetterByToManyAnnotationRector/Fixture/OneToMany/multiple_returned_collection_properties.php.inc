<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Source\Training;

/**
 * @ORM\Entity
 */
final class Trainer
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $morningTrainings;

    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $eveningTrainings;

    public function getTrainings(): Collection
    {
        if (random_int(0, 1)) {
            return $this->morningTrainings;
        }

        return $this->eveningTrainings;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Source\Training;

/**
 * @ORM\Entity
 */
final class Trainer
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $morningTrainings;

    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $eveningTrainings;

    public function getTrainings(): Collection
    {
        if (random_int(0, 1)) {
            return $this->morningTrainings;
        }

        return $this->eveningTrainings;
    }
}

?>
