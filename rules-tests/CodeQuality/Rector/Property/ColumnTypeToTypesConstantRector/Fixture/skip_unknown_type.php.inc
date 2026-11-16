<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ColumnTypeToTypesConstantRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class SkipUnknownType
{
    #[ORM\Column(type: 'uuid')]
    private $id;

    #[ORM\JoinColumn(name: 'string')]
    private $other;
}
