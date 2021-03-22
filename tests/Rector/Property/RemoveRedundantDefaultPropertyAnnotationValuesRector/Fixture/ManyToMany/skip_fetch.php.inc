<?php

namespace Rector\Doctrine\Tests\Rector\Property\RemoveRedundantDefaultPropertyAnnotationValuesRector\Fixture\ManyToMany;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\Rector\Property\RemoveRedundantDefaultPropertyAnnotationValuesRector\Source\Training;

/**
 * @ORM\Entity
 */
class SkipFetch
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, fetch="AUTO")
     */
    private $trainings = [];
}

?>

