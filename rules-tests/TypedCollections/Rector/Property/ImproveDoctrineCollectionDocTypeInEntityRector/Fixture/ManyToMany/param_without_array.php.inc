<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\ManyToMany;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

/**
 * @ORM\Entity
 */
final class ParamWithoutArray
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $trainings = [];

    /**
     * @param Collection $collection
     */
    public function setTrainings($collection): void
    {
        $this->trainings = $collection;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\ManyToMany;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

/**
 * @ORM\Entity
 */
final class ParamWithoutArray
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, mappedBy="trainer")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training>
     */
    private $trainings = [];

    /**
     * @param \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training> $collection
     */
    public function setTrainings($collection): void
    {
        $this->trainings = $collection;
    }
}

?>
