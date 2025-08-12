<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\TypeNullableEntityFromDocblockRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AttributeEntity
{
    /**
     * @var string
     */
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    #[ORM\GeneratedValue]
    private $name;


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
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

#[ORM\Entity]
class AttributeEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    #[ORM\GeneratedValue]
    private ?string $name = null;


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}


?>
