<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteParamDocblockFromToManyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteParamDocblockFromToManyRector\Source\Training;

/**
 * @ORM\Entity
 */
final class ParamWithoutArray
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, mappedBy="trainer")
     * @var Collection<int, Training>
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

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteParamDocblockFromToManyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteParamDocblockFromToManyRector\Source\Training;

/**
 * @ORM\Entity
 */
final class ParamWithoutArray
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, mappedBy="trainer")
     * @var Collection<int, Training>
     */
    private $trainings = [];

    /**
     * @param \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteParamDocblockFromToManyRector\Source\Training> $collection
     */
    public function setTrainings($collection): void
    {
        $this->trainings = $collection;
    }
}

?>
