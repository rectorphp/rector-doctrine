<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm;

/**
 * @ORM\Entity
 */
class ToManyIntersection
{
    /**
     * @ORM\OneToMany(targetEntity="TrainingTerm", mappedBy="training")
     * @var Collection<TrainingTerm>
     */
    private $training;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm;

/**
 * @ORM\Entity
 */
class ToManyIntersection
{
    /**
     * @ORM\OneToMany(targetEntity="TrainingTerm", mappedBy="training")
     * @var Collection<TrainingTerm>
     */
    private \Doctrine\Common\Collections\Collection $training;
}

?>
