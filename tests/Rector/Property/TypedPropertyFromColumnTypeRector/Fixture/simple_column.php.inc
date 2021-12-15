<?php

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromColumnTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class SimpleColumn
{
    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $surname;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromColumnTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class SimpleColumn
{
    /**
     * @ORM\Column(type="string")
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $surname = null;
}

?>
