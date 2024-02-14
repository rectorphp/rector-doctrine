<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class SomeManyToOne
{
    private $sharedItems;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Table]
final class SomeManyToOne
{
    #[\Doctrine\ORM\Mapping\ManyToOne(targetEntity: \App\Entity\Item::class, nullable: false, inversedBy: 'itemIds')]
    private $sharedItems;
}

?>
