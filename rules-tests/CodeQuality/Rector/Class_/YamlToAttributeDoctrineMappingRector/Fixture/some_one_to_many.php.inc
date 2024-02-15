<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class SomeOneToMany
{
    private $singleItem;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Table]
final class SomeOneToMany
{
    #[\Doctrine\ORM\Mapping\OneToMany(targetEntity: \App\Entity\Item::class, mappedBy: 'itemIds', cascade: ['persist'])]
    private $singleItem;
}

?>
