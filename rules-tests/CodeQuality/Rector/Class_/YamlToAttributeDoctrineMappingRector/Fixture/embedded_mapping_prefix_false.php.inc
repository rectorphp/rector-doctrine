<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class EmbeddedMappingPrefixFalse
{
    private $inner;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Table]
final class EmbeddedMappingPrefixFalse
{
    #[\Doctrine\ORM\Mapping\Embedded(class: \App\Currency::class, columnPrefix: false)]
    private $inner;
}

?>
