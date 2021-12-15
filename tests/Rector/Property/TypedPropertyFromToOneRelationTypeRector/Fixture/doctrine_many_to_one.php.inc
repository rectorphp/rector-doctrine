<?php

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class DoctrineManyToOne
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Company\Entity\Company", inversedBy="userBuildings")
     * @ORM\JoinColumn(name="company_id", nullable=true, referencedColumnName="id")
     */
    private $company2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Company\Entity\Company", inversedBy="userBuildings")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=false)
     */
    private $company3;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class DoctrineManyToOne
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Company\Entity\Company", inversedBy="userBuildings")
     * @ORM\JoinColumn(name="company_id", nullable=true, referencedColumnName="id")
     */
    private ?\App\Company\Entity\Company $company2 = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Company\Entity\Company", inversedBy="userBuildings")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=false)
     */
    private ?\App\Company\Entity\Company $company3 = null;
}

?>
