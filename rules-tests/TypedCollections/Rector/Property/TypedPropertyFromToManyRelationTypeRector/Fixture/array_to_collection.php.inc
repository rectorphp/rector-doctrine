<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm;

/**
 * @ORM\Entity
 */
class ArrayToCollection
{
    /**
     * @ORM\OneToMany(targetEntity="Pehapkari\Training\Entity\TrainingTerm", mappedBy="training")
     * @var Collection<TrainingTerm>
     */
    private array $training;
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
class ArrayToCollection
{
    /**
     * @ORM\OneToMany(targetEntity="Pehapkari\Training\Entity\TrainingTerm", mappedBy="training")
     * @var Collection<TrainingTerm>
     */
    private \Doctrine\Common\Collections\Collection $training;
}

?>
