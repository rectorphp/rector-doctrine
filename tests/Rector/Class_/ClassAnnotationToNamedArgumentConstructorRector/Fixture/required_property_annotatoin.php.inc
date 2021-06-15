<?php

namespace Rector\Doctrine\Tests\Rector\Class_\ClassAnnotationToNamedArgumentConstructorRector\Fixture;

/**
 * @Annotation
 */
class RequiredPropertyAnnotation
{
    /**
     * @var string
     */
    private $foo;

    public function __construct(array $values)
    {
        if (! isset($values['foo'])) {
            throw new \InvalidArgumentException();
        }

        $this->foo = $values['foo'];
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
class RequiredPropertyAnnotation
{
    /**
     * @var string
     */
    private $foo;

    public function __construct(string $foo)
    {
        $this->foo = $foo;
    }
}

?>
