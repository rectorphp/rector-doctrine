<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class IdMappingConstructor
{
    public function __construct(
        private $id,
    ) {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Table]
final class IdMappingConstructor
{
    public function __construct(
        #[\Doctrine\ORM\Mapping\Id]
        #[\Doctrine\ORM\Mapping\Column(type: 'integer')]
        #[\Doctrine\ORM\Mapping\GeneratedValue(strategy: 'AUTO')]
        private $id,
    ) {
    }
}

?>
