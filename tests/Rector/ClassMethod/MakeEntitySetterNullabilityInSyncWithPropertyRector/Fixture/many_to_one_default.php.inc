<?php

namespace Rector\Doctrine\Tests\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class ManyToOneDefault
{
    /**
     * @ORM\ManyToOne(targetEntity="DefaultEntity")
     */
    private $defaultEntity;

    public function setDefaultEntity(DefaultEntity $defaultEntity)
    {
        $this->defaultEntity = $defaultEntity;
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
class ManyToOneDefault
{
    /**
     * @ORM\ManyToOne(targetEntity="DefaultEntity")
     */
    private $defaultEntity;

    public function setDefaultEntity(DefaultEntity $defaultEntity)
    {
        $this->defaultEntity = $defaultEntity;
    }
}

?>
