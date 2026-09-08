<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromColumnTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class NullDefaultForcesNullableObject
{
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $historyDate = null;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromColumnTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class NullDefaultForcesNullableObject
{
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private ?\DateTimeInterface $historyDate = null;
}

?>
