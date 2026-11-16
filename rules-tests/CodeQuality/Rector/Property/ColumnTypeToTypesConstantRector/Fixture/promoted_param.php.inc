<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ColumnTypeToTypesConstantRector\Fixture;

use Doctrine\ORM\Mapping\Column;

class PromotedParam
{
    public function __construct(
        #[Column(type: 'integer')]
        private int $count
    ) {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ColumnTypeToTypesConstantRector\Fixture;

use Doctrine\ORM\Mapping\Column;

class PromotedParam
{
    public function __construct(
        #[Column(type: \Doctrine\DBAL\Types\Types::INTEGER)]
        private int $count
    ) {
    }
}

?>
