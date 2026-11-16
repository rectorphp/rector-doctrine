<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ColumnTypeToTypesConstantRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class SomeColumn
{
    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ColumnTypeToTypesConstantRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class SomeColumn
{
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255)]
    private $name;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::DATETIME_IMMUTABLE)]
    private $createdAt;
}

?>
