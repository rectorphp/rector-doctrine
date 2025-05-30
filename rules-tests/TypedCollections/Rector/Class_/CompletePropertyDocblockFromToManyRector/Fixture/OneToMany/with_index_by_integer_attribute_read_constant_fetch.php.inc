<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\TrainingWithIntegerIdAttributeConstantFetch;

/**
 * @ORM\Entity
 */
class WithIndexByIntegerAttributeReadConstantFetch
{
    /**
     * @var Collection<int, string>|TrainingWithIntegerIdAttributeConstantFetch[]
     */
    #[ORM\OneToMany(targetEntity: TrainingWithIntegerIdAttributeConstantFetch::class, mappedBy: 'trainer', indexBy: 'id')]
    private $trainings = [];

    /**
     * @var Collection<int, string>|TrainingWithIntegerIdAttributeConstantFetch[]
     */
    #[ORM\OneToMany(targetEntity: TrainingWithIntegerIdAttributeConstantFetch::class, mappedBy: 'trainer', indexBy: 'id2')]
    private $trainings2 = [];
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\TrainingWithIntegerIdAttributeConstantFetch;

/**
 * @ORM\Entity
 */
class WithIndexByIntegerAttributeReadConstantFetch
{
    /**
     * @var \Doctrine\Common\Collections\Collection<string, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\TrainingWithIntegerIdAttributeConstantFetch>
     */
    #[ORM\OneToMany(targetEntity: TrainingWithIntegerIdAttributeConstantFetch::class, mappedBy: 'trainer', indexBy: 'id')]
    private $trainings = [];

    /**
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\TrainingWithIntegerIdAttributeConstantFetch>
     */
    #[ORM\OneToMany(targetEntity: TrainingWithIntegerIdAttributeConstantFetch::class, mappedBy: 'trainer', indexBy: 'id2')]
    private $trainings2 = [];
}

?>
