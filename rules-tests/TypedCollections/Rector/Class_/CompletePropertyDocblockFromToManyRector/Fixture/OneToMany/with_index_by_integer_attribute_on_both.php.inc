<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\TrainingWithIntegerIdAttribute;

/**
 * @ORM\Entity
 */
class WithIndexByIntegerAttributeOnBoth
{
    /**
     * @var Collection<int, string>|TrainingWithIntegerIdAttribute[]
     */
    #[ORM\OneToMany(targetEntity: TrainingWithIntegerIdAttribute::class, mappedBy: 'trainer', indexBy: 'id')]
    private $trainings = [];
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\TrainingWithIntegerIdAttribute;

/**
 * @ORM\Entity
 */
class WithIndexByIntegerAttributeOnBoth
{
    /**
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\TrainingWithIntegerIdAttribute>
     */
    #[ORM\OneToMany(targetEntity: TrainingWithIntegerIdAttribute::class, mappedBy: 'trainer', indexBy: 'id')]
    private $trainings = [];
}

?>
