<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class SomeEntity
{
    private $someProperty;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Table]
final class SomeEntity
{
    #[\Doctrine\ORM\Mapping\Column(name: 'some_property_id', type: 'string', length: 6, nullable: true)]
    private $someProperty;
}

?>
