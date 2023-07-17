<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Fixture\Attribute;

use Doctrine\ORM\Mapping as ORM;

final class KeepSelf
{
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    #[ORM\JoinColumn(onDelete: 'SET NULL')]
    private ?self $parent = null;
}
