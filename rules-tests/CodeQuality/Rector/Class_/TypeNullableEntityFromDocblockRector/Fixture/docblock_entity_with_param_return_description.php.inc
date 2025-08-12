<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\TypeNullableEntityFromDocblockRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class DocblockEntityWithParamReturnDescription
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue
     */
    private $name;

    /**
     * @return string some description
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name some description
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
}


?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\TypeNullableEntityFromDocblockRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class DocblockEntityWithParamReturnDescription
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue
     */
    private ?string $name = null;

    /**
     * @return string some description
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name some description
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}


?>
