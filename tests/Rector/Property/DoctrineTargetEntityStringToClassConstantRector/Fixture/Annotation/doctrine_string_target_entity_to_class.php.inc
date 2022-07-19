<?php

namespace Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Fixture\Annotation;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\AnotherClass;

final class MyEntity
{
    /**
     * @ORM\Embedded(class="AnotherClass")
     */
    private $other;

    /**
     * @ORM\OneToMany(targetEntity="AnotherClass")
     */
    private readonly ?Collection $items;

    /**
     * @ORM\ManyToOne(targetEntity="AnotherClass")
     */
    private readonly ?Collection $items2;

    /**
     * @ORM\ManyToMany(targetEntity="AnotherClass")
     */
    private readonly ?Collection $items3;

    /**
     * @ORM\OneToOne(mappedBy="class", targetEntity="AnotherClass")
     */
    private readonly ?Collection $items4;

    /**
     * @ORM\ManyToOne(targetEntity="UnresolvableClass")
     */
    private readonly ?Collection $items5;

    /**
     * @ORM\ManyToOne(targetEntity="App:AnotherClass")
     */
    private readonly ?Collection $items6;

    /**
     * @ORM\ManyToOne(targetEntity="Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\AnotherClass")
     */
    private readonly ?Collection $items7;

    public function addItem(AnotherClass $myOtherEntity): void
    {
        $this->items->add($myOtherEntity);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Fixture\Annotation;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\AnotherClass;

final class MyEntity
{
    /**
     * @ORM\Embedded(class=\Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\AnotherClass::class)
     */
    private $other;

    /**
     * @ORM\OneToMany(targetEntity=\Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\AnotherClass::class)
     */
    private readonly ?Collection $items;

    /**
     * @ORM\ManyToOne(targetEntity=\Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\AnotherClass::class)
     */
    private readonly ?Collection $items2;

    /**
     * @ORM\ManyToMany(targetEntity=\Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\AnotherClass::class)
     */
    private readonly ?Collection $items3;

    /**
     * @ORM\OneToOne(mappedBy="class", targetEntity=\Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\AnotherClass::class)
     */
    private readonly ?Collection $items4;

    /**
     * @ORM\ManyToOne(targetEntity="UnresolvableClass")
     */
    private readonly ?Collection $items5;

    /**
     * @ORM\ManyToOne(targetEntity="App:AnotherClass")
     */
    private readonly ?Collection $items6;

    /**
     * @ORM\ManyToOne(targetEntity=\Rector\Doctrine\Tests\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\Source\AnotherClass::class)
     */
    private readonly ?Collection $items7;

    public function addItem(AnotherClass $myOtherEntity): void
    {
        $this->items->add($myOtherEntity);
    }
}

?>
