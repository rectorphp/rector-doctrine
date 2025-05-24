<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Trainer
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $trainings;

    /**
     * @return \Doctrine\Common\Collections\Collection<\Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Source\Training>
     */
    public function getTrainings()
    {
        return $this->trainings;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Trainer
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $trainings;

    /**
     * @return \Doctrine\Common\Collections\Collection<int, \Training>
     */
    public function getTrainings()
    {
        return $this->trainings;
    }
}

?>
