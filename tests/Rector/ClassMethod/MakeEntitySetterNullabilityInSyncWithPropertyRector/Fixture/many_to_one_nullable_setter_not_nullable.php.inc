<?php

namespace Rector\Doctrine\Tests\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Source\NullableEntity;

/**
 * @ORM\Entity()
 */
class SkipManyToOneNullableSetterNotNullable
{
    /**
     * @ORM\ManyToOne(targetEntity="NullableEntity")
     * @ORM\JoinColumn(nullable=true)
     */
    private $nullableEntity;

    public function setNullableEntity(?NullableEntity $nullableEntity)
    {
        $this->nullableEntity = $nullableEntity;
    }
}
