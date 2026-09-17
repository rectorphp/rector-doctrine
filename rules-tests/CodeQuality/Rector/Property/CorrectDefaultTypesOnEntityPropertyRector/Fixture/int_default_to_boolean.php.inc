<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\CorrectDefaultTypesOnEntityPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class IntDefaultToBoolean
{
    /**
     * @ORM\Column(name="is_int", type="boolean")
     */
    private $isInt = 0;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\CorrectDefaultTypesOnEntityPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class IntDefaultToBoolean
{
    /**
     * @ORM\Column(name="is_int", type="boolean")
     */
    private $isInt = false;
}

?>
