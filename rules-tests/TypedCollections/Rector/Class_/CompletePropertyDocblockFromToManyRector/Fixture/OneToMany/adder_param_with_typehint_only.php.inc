<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training;

/**
 * @ORM\Entity
 */
final class AdderParamWithTypehintOnly
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $trainings = [];


    public function addTraining(\Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training $training): self
    {
        if (!$this->trainings->contains($training)) {
            $this->trainings[] = $training;
        }

        return $this;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training;

/**
 * @ORM\Entity
 */
final class AdderParamWithTypehintOnly
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training>
     */
    private $trainings = [];


    public function addTraining(\Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training $training): self
    {
        if (!$this->trainings->contains($training)) {
            $this->trainings[] = $training;
        }

        return $this;
    }
}

?>
