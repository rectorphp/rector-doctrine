<?php

namespace Rector\Doctrine\Tests\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Product
{
    /**
     * @ORM\ManyToOne(targetEntity="DefaultEntity")
     */
    private $defaultEntity;

    /**
     * @ORM\ManyToOne(targetEntity="NotNullableEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $notNullableEntity;

    /**
     * @ORM\ManyToOne(targetEntity="NullableEntity")
     * @ORM\JoinColumn(nullable=true)
     */
    private $nullableEntity;

    public function setDefaultEntity(DefaultEntity $defaultEntity)
    {
        $this->defaultEntity = $defaultEntity;
    }

    public function setNotNullableEntity(?NotNullableEntity $notNullableEntity)
    {
        $this->notNullableEntity = $notNullableEntity;
    }

    public function setNullableEntity(NullableEntity $nullableEntity)
    {
        $this->nullableEntity = $nullableEntity;
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
     * @ORM\ManyToOne(targetEntity="DefaultEntity")
     */
    private $defaultEntity;

    /**
     * @ORM\ManyToOne(targetEntity="NotNullableEntity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $notNullableEntity;

    /**
     * @ORM\ManyToOne(targetEntity="NullableEntity")
     * @ORM\JoinColumn(nullable=true)
     */
    private $nullableEntity;

    public function setDefaultEntity(?DefaultEntity $defaultEntity)
    {
        $this->defaultEntity = $defaultEntity;
    }

    public function setNotNullableEntity(NotNullableEntity $notNullableEntity)
    {
        $this->notNullableEntity = $notNullableEntity;
    }

    public function setNullableEntity(?NullableEntity $nullableEntity)
    {
        $this->nullableEntity = $nullableEntity;
    }
}

?>
