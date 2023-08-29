<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class ManyToOneNotNullable
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

namespace Rector\Doctrine\Tests\CodeQuality\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class ManyToOneNotNullable
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
