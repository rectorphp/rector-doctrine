<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class SomeEntity
{
    private $someProperty;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

/**
 * @\Doctrine\ORM\Mapping\Table
 */
final class SomeEntity
{
    /**
     * @\Doctrine\ORM\Mapping\Column(type="string", length=6, nullable=true)
     */
    private $someProperty;
}

?>
