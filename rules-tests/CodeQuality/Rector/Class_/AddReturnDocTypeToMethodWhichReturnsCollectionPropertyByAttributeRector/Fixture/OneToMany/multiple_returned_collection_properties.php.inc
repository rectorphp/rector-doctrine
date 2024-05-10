<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocTypeToMethodWhichReturnsCollectionPropertyByAttributeRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

#[ORM\Entity]
final class AdderParam
{
    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $morningTrainings;

    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $eveningTrainings;

    public function getTrainings(): Collection
    {
        return random_int(0, 1) ? $this->morningTrainings : $this->eveningTrainings;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocTypeToMethodWhichReturnsCollectionPropertyByAttributeRector\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

#[ORM\Entity]
final class AdderParam
{
    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $morningTrainings;

    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $eveningTrainings;

    public function getTrainings(): Collection
    {
        return random_int(0, 1) ? $this->morningTrainings : $this->eveningTrainings;
    }
}

?>