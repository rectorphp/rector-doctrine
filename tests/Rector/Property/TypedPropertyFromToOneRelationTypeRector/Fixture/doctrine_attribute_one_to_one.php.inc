<?php

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class DoctrineOneToOne
{
    #[ORM\OneToOne(targetEntity: "App\Company\Entity\Company")]
    private $company;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class DoctrineOneToOne
{
    #[ORM\OneToOne(targetEntity: "App\Company\Entity\Company")]
    private ?\App\Company\Entity\Company $company = null;
}

?>
