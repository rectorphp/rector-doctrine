<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class EmbeddedMapping
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
final class EmbeddedMapping
{
    /**
     * @\Doctrine\ORM\Mapping\Embedded(class="App\Currency", columnPrefix="currency_")
     */
    private $inner;
}

?>
