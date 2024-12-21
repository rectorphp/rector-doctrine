<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Source\Training;

#[ORM\Entity()]
class SkipWithIndexBy
{
    /**
     * @var Collection|Training[]
     */
    #[ORM\OneToMany(targetEntity: Training::class, indexBy: "id", mappedBy: "trainer")]
    private $trainings = [];

    public function getTrainings()
    {
        return $this->trainings;
    }

    public function setTrainings($trainings)
    {
        $this->trainings = $trainings;
    }
}
