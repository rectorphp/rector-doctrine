<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training;

/**
 * @ORM\Entity
 */
class SkipWithIndexByCorrect
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer", "indexBy"="id")
     * @var Collection<string, Training>
     */
    private $trainings = [];
}
