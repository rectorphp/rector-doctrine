<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class BoolDefaultFalse
{
    public $someProperty;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

/**
 * @\Doctrine\ORM\Mapping\Table
 */
final class BoolDefaultFalse
{
    /**
     * @\Doctrine\ORM\Mapping\Column(type="boolean", unique=true, options={"default"=false, "size"=100, "where"="name IS NULL"})
     */
    public $someProperty;
}

?>
