<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

/**
 * @ORM\Entity
 */
class WithIndexBy
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer", "indexBy"="id")
     * @var Collection<int, string>|Training[]
     */
    private $trainings = [];
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

/**
 * @ORM\Entity
 */
class WithIndexBy
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer", "indexBy"="id")
     * @var \Doctrine\Common\Collections\Collection<string, \Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training>
     */
    private $trainings = [];
}

?>
