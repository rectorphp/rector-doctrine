<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\ManyToMany;

use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 */
final class ParamWithoutArray
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $trainings = [];

    /**
     * @param Collection $collection
     */
    public function setTrainings($collection): void
    {
        $this->trainings = $collection;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\ManyToMany;

/**
 * @ORM\Entity
 */
final class ParamWithoutArray
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, mappedBy="trainer")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training>
     */
    private $trainings = [];

    /**
     * @param \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training> $collection
     */
    public function setTrainings($collection): void
    {
        $this->trainings = $collection;
    }
}

?>
