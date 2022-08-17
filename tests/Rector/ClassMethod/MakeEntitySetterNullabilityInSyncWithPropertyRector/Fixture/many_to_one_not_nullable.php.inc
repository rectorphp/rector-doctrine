<?php

namespace Rector\Doctrine\Tests\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Source\NotNullableEntity;

/**
 * @ORM\Entity()
 */
final class ManyToOneNotNullable
{
    /**
     * @ORM\ManyToOne(targetEntity="NotNullableEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $notNullableEntity;

    public function setNotNullableEntity(?NotNullableEntity $notNullableEntity)
    {
        $this->notNullableEntity = $notNullableEntity;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Source\NotNullableEntity;

/**
 * @ORM\Entity()
 */
final class ManyToOneNotNullable
{
    /**
     * @ORM\ManyToOne(targetEntity="NotNullableEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $notNullableEntity;

    public function setNotNullableEntity(NotNullableEntity $notNullableEntity)
    {
        $this->notNullableEntity = $notNullableEntity;
    }
}

?>
