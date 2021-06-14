<?php

namespace Rector\Doctrine\Tests\Rector\Class_\ClassAnnotationToNamedArgumentConstructorRector\Fixture;

use Doctrine\Common\Annotations\Annotation\NamedArgumentConstructor;

/**
 * @Annotation
 * @NamedArgumentConstructor
 */
final class SomeAnnotation
{
    /**
     * @var string
     */
    private $foo;

    public function __construct(array $values)
    {
        $this->foo = $values['foo'];
    }
}
