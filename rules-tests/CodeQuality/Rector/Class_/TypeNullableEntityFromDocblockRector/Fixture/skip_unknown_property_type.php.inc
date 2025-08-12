<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\TypeNullableEntityFromDocblockRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class SkipUnknownPropertyType
{
    #[ORM\Id]
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
