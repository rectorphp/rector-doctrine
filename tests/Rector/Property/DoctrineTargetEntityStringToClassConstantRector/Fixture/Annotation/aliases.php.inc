<?php

namespace Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Fixture\Annotation;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\{AnotherClass as AnotherClassA, AnotherClass as AnotherClassB};
use Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\AnotherClass as AnotherClassC;

final class MyEntity
{
    # Cannot be handled for now @see https://github.com/rectorphp/rector/issues/7150
    #/**
    # * @ORM\Embedded(class="AnotherClassA")
    # */
    private $other;

    # Cannot be handled for now @see https://github.com/rectorphp/rector/issues/7150
    #/**
    # * @ORM\OneToMany(targetEntity="AnotherClassB")
    # */
    private readonly ?Collection $items;

    /**
     * @ORM\OneToMany(targetEntity="AnotherClassC")
     */
    private readonly ?Collection $items2;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Fixture\Annotation;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\{AnotherClass as AnotherClassA, AnotherClass as AnotherClassB};
use Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\AnotherClass as AnotherClassC;

final class MyEntity
{
    # Cannot be handled for now @see https://github.com/rectorphp/rector/issues/7150
    #/**
    # * @ORM\Embedded(class="AnotherClassA")
    # */
    private $other;

    # Cannot be handled for now @see https://github.com/rectorphp/rector/issues/7150
    #/**
    # * @ORM\OneToMany(targetEntity="AnotherClassB")
    # */
    private readonly ?Collection $items;

    /**
     * @ORM\OneToMany(targetEntity=\Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\AnotherClass::class)
     */
    private readonly ?Collection $items2;
}

?>
