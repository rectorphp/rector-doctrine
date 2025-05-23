<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany;

use Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

/**
 * @ORM\Entity
 */
class VarWithoutCollection
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     * @var Training[]
     */
    private $trainings = [];
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany;

/**
 * @ORM\Entity
 */
class VarWithoutCollection
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training>
     */
    private $trainings = [];
}

?>
