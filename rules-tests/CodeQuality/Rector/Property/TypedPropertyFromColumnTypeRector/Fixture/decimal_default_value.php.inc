<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromColumnTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class DecimalDefaultValue
{
    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     */
    private $totalShippingCostDec = 0;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromColumnTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class DecimalDefaultValue
{
    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     */
    private string $totalShippingCostDec = '0';
}

?>
