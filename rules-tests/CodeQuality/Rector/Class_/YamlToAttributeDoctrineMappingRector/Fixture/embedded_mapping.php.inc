<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class EmbeddedMapping
{
    private $inner;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Table]
final class EmbeddedMapping
{
    #[\Doctrine\ORM\Mapping\Embedded(class: \App\Currency::class, columnPrefix: 'currency_')]
    private $inner;
}

?>
