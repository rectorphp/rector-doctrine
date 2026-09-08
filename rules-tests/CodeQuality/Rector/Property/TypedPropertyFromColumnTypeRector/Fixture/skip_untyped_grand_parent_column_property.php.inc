<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromColumnTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromColumnTypeRector\Source\AbstractParentScopeEntity;

class SkipUntypedGrandParentColumnProperty extends AbstractParentScopeEntity
{
    /**
     * @ORM\Column(type="string")
     */
    protected $scopes;
}
