<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ColumnTypeToTypesConstantRector\Fixture;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

class SkipAlreadyConstant
{
    #[ORM\Column(type: Types::STRING)]
    private $name;
}
