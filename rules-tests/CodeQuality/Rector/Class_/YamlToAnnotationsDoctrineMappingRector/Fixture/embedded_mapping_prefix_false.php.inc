<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class EmbeddedMappingPrefixFalse
{
    private $inner;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

/**
 * @\Doctrine\ORM\Mapping\Table
 */
final class EmbeddedMappingPrefixFalse
{
    /**
     * @\Doctrine\ORM\Mapping\Embedded(class="App\Currency", columnPrefix=false)
     */
    private $inner;
}

?>
