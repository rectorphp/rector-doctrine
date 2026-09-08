<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Source\AbstractBaseWithTraitEntity;

class SkipUntypedParentTraitProperty extends AbstractBaseWithTraitEntity
{
    /**
     * @ORM\OneToOne(targetEntity="Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToOneRelationTypeRector\Source\Company")
     */
    protected $company;
}
