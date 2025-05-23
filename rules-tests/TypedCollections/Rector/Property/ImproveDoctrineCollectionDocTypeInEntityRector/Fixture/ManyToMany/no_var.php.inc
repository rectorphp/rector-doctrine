<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\ManyToMany;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

/**
 * @ORM\Entity
 */
class NoVar
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $trainings = [];
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\ManyToMany;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

/**
 * @ORM\Entity
 */
class NoVar
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, mappedBy="trainer")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training>
     */
    private $trainings = [];
}

?>
