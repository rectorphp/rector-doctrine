<?php

namespace Rector\Doctrine\Tests\Rector\Class_\ClassAnnotationToNamedArgumentConstructorRector\Fixture;

/**
 * @Annotation
 */
class PublicPropertiesAnnotation
{
    /**
     * @var string
     */
    public $foo;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\Class_\ClassAnnotationToNamedArgumentConstructorRector\Fixture;

/**
 * @Annotation
 * @\Doctrine\Common\Annotations\Annotation\NamedArgumentConstructor
 */
class PublicPropertiesAnnotation
{
    /**
     * @var string
     */
    public $foo;
    public function __construct(string $foo)
    {
        $this->foo = $foo;
    }
}

?>
