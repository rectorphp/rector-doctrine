<?php

namespace Rector\Doctrine\Tests\Rector\AttributeGroup\RemoveEmptyTableAttributeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'skip_not_empty')]
#[ORM\Entity]
class SkipNotEmpty
{
}
