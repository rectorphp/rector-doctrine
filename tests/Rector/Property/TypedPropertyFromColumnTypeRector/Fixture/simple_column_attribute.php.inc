<?php

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromColumnTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class SimpleColumnAttribute
{
    #[Column(type: 'string')]
    private $name;
  
    #[Column(type: 'string', nullable: true)]
    private $surname;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromColumnTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class SimpleColumnAttribute
{
    #[Column(type: 'string')]
    private ?string $name = null;

    #[Column(type: 'string', nullable: true)]
    private ?string $surname = null;
}

?>
