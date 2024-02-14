<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class InheritanceMap
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

/**
 * @\Doctrine\ORM\Mapping\Table
 * @\Doctrine\ORM\Mapping\InheritanceType("SINGLE_TABLE")
 * @\Doctrine\ORM\Mapping\DiscriminatorColumn(name="discr", type="string")
 * @\Doctrine\ORM\Mapping\DiscriminatorMap({"first"="App\Entity\First"})
 */
final class InheritanceMap
{
}

?>
