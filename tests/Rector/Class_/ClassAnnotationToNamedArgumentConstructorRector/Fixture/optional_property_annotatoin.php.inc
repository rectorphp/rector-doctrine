<?php

namespace Rector\Doctrine\Tests\Rector\Class_\ClassAnnotationToNamedArgumentConstructorRector\Fixture;

/**
 * @Annotation
 */
final class OptionalPropertyAnnotation
{
    /**
     * @var string
     */
    private $foo;

    public function __construct(array $values)
    {
        if (! isset($values['foo'])) {
            $this->foo = $values['foo'];
        }
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\Class_\ClassAnnotationToNamedArgumentConstructorRector\Fixture;

/**
 * @Annotation
 * @\Doctrine\Common\Annotations\Annotation\NamedArgumentConstructor
 */
final class OptionalPropertyAnnotation
{
    /**
     * @var string
     */
    private $foo;

    public function __construct(?string $foo = null)
    {
        $this->foo = $foo;
    }
}

?>
