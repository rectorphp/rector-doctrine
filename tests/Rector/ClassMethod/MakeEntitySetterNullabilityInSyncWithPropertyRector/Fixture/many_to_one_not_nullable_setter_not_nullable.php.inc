<?php

namespace Rector\Doctrine\Tests\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Product
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
-----
<?php

namespace Rector\Doctrine\Tests\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Product
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
