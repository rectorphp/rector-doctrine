<?php

namespace Rector\Doctrine\Tests\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Product
{
    /**
     * @ORM\ManyToOne(targetEntity="AnotherEntity")
     */
    private $anotherEntity;

    /**
     * @ORM\ManyToOne(targetEntity="AnotherEntity2")
     * @ORM\JoinColumn(nullable=false)
     */
    private $anotherEntity2;

    /**
     * @ORM\ManyToOne(targetEntity="AnotherEntity2")
     * @ORM\JoinColumn(nullable=true)
     */
    private $anotherEntity3;

    public function setAnotherEntity(AnotherEntity $anotherEntity)
    {
        $this->anotherEntity = $anotherEntity;
    }

    public function setAnotherEntity2(?AnotherEntity $anotherEntity2)
    {
        $this->anotherEntity2 = $anotherEntity2;
    }

    public function setAnotherEntity3(AnotherEntity2 $anotherEntity3)
    {
        $this->anotherEntity3 = $anotherEntity3;
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
     * @ORM\ManyToOne(targetEntity="AnotherEntity")
     */
    private $anotherEntity;

    /**
     * @ORM\ManyToOne(targetEntity="AnotherEntity2")
     * @ORM\JoinColumn(nullable=false)
     */
    private $anotherEntity2;

    /**
     * @ORM\ManyToOne(targetEntity="AnotherEntity2")
     * @ORM\JoinColumn(nullable=true)
     */
    private $anotherEntity3;

    public function setAnotherEntity(?AnotherEntity $anotherEntity)
    {
        $this->anotherEntity = $anotherEntity;
    }

    public function setAnotherEntity2(AnotherEntity $anotherEntity2)
    {
        $this->anotherEntity2 = $anotherEntity2;
    }

    public function setAnotherEntity3(?AnotherEntity2 $anotherEntity3)
    {
        $this->anotherEntity3 = $anotherEntity3;
    }
}

?>
