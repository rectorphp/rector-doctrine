<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\TrainingWithIntegerId;

/**
 * @ORM\Entity
 */
class WithIndexByInteger
{
    /**
     * @ORM\OneToMany(targetEntity=TrainingWithIntegerId::class, mappedBy="trainer", "indexBy"="id")
     * @var Collection<int, string>|TrainingWithIntegerId[]
     */
    private $trainings = [];
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\TrainingWithIntegerId;

/**
 * @ORM\Entity
 */
class WithIndexByInteger
{
    /**
     * @ORM\OneToMany(targetEntity=TrainingWithIntegerId::class, mappedBy="trainer", "indexBy"="id")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\TrainingWithIntegerId>
     */
    private $trainings = [];
}

?>
