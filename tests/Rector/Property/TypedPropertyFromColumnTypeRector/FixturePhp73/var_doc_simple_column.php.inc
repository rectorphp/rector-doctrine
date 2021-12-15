<?php

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromColumnTypeRector\FixturePhp73;

use Doctrine\ORM\Mapping as ORM;

class VarDocSimpleColumn
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

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromColumnTypeRector\FixturePhp73;

use Doctrine\ORM\Mapping as ORM;

class VarDocSimpleColumn
{
    /**
     * @ORM\Column(type="string")
     * @var string|null
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $surname;
}

?>
