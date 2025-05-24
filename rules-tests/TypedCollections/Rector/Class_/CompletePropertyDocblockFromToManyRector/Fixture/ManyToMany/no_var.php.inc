<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\ManyToMany;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training;

/**
 * @ORM\Entity
 */
class NoVar
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $trainings = [];

    #[ORM\ManyToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $practices = [];
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\ManyToMany;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training;

/**
 * @ORM\Entity
 */
class NoVar
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, mappedBy="trainer")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training>
     */
    private $trainings = [];

    /**
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training>
     */
    #[ORM\ManyToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $practices = [];
}

?>
