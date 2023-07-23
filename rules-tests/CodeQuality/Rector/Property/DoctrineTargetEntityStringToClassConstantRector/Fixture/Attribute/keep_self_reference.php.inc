<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Fixture\Attribute;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class KeepSelfReference
{
    #[ORM\OneToMany(targetEntity: self::class)]
    private $someEntity;
}
