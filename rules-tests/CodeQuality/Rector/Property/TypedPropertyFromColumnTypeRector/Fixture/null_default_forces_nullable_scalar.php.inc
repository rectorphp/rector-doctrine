<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromColumnTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class NullDefaultForcesNullableScalar
{
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $surname = null;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromColumnTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class NullDefaultForcesNullableScalar
{
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private ?string $surname = null;
}

?>
