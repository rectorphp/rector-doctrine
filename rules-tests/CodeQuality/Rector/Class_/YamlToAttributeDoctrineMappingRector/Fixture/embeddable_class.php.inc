<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class EmbeddableClass
{
    public $countryCodePrefix;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Embeddable]
final class EmbeddableClass
{
    #[\Doctrine\ORM\Mapping\Column(type: 'string')]
    public $countryCodePrefix;
}

?>
