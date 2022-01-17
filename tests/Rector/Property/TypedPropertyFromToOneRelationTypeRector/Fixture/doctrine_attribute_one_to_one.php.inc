<?php

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Fixture;

use App\Company\Entity\Company;
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

use App\Company\Entity\Company;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class DoctrineOneToOne
{
    #[ORM\OneToOne(targetEntity: Company::class)]
    private ?\App\Company\Entity\Company $company = null;
}

?>
