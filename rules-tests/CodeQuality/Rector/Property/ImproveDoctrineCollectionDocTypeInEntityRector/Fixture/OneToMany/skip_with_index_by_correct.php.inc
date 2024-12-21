<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

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
