<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\TrainingWithIntegerIdAttribute;

/**
 * @ORM\Entity
 */
class WithIndexByIntegerAttribute
{
    /**
     * @ORM\OneToMany(targetEntity=TrainingWithIntegerIdAttribute::class, mappedBy="trainer", "indexBy"="id")
     * @var Collection<int, string>|TrainingWithIntegerIdAttribute[]
     */
    private $trainings = [];
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\TrainingWithIntegerIdAttribute;

/**
 * @ORM\Entity
 */
class WithIndexByIntegerAttribute
{
    /**
     * @ORM\OneToMany(targetEntity=TrainingWithIntegerIdAttribute::class, mappedBy="trainer", "indexBy"="id")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\TrainingWithIntegerIdAttribute>
     */
    private $trainings = [];
}

?>
