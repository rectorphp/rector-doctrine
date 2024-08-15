<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany\Attribute;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

#[ORM\Entity]
class VarAndAttribute
{
    /**
     * @var Collection|Training[]
     */
    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $trainings = [];

    public function setTrainings($trainings)
    {
        $this->trainings = $trainings;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany\Attribute;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

#[ORM\Entity]
class VarAndAttribute
{
    /**
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training>
     */
    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $trainings = [];

    /**
     * @param Collection|\Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training[] $trainings
     */
    public function setTrainings($trainings)
    {
        $this->trainings = $trainings;
    }
}

?>
