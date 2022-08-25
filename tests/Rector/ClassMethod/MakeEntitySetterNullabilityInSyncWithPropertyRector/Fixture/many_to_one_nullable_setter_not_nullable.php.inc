<?php

namespace Rector\Doctrine\Tests\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class ManyToOneNullableSetterNotNullable
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

?>
