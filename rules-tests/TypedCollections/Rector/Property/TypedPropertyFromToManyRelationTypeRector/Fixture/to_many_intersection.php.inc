<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 */
class ToManyIntersection
{
    /**
     * @ORM\OneToMany(targetEntity="Pehapkari\Training\Entity\TrainingTerm", mappedBy="training")
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

/**
 * @ORM\Entity
 */
class ToManyIntersection
{
    /**
     * @ORM\OneToMany(targetEntity="Pehapkari\Training\Entity\TrainingTerm", mappedBy="training")
     * @var \Doctrine\Common\Collections\Collection<int, \Pehapkari\Training\Entity\TrainingTerm>
     */
    private \Doctrine\Common\Collections\Collection $training;
}

?>
