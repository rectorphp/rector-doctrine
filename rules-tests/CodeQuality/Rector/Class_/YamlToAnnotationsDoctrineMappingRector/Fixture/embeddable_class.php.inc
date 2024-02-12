<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class EmbeddableClass
{
    public $countryCodePrefix;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

/**
 * @\Doctrine\ORM\Mapping\Embeddable
 */
final class EmbeddableClass
{
    /**
     * @\Doctrine\ORM\Mapping\Column(type="string")
     */
    public $countryCodePrefix;
}

?>
