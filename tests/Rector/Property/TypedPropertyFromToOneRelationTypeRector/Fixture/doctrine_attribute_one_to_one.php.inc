<?php

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Fixture;

use Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Source\Company;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class DoctrineOneToOne
{
    #[ORM\OneToOne(targetEntity: Company::class)]
    private $company;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Fixture;

use Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Source\Company;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class DoctrineOneToOne
{
    #[ORM\OneToOne(targetEntity: Company::class)]
    private ?\Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Source\Company $company = null;
}

?>
