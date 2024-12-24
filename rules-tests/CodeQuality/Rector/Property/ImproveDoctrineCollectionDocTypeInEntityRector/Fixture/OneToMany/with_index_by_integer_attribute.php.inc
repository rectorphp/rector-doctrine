<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\TrainingWithIntegerIdAttribute;

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

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\TrainingWithIntegerIdAttribute;

/**
 * @ORM\Entity
 */
class WithIndexByIntegerAttribute
{
    /**
     * @ORM\OneToMany(targetEntity=TrainingWithIntegerIdAttribute::class, mappedBy="trainer", "indexBy"="id")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\TrainingWithIntegerIdAttribute>
     */
    private $trainings = [];
}

?>
