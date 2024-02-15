<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class SomeOrderBy
{
    public $categoryEvents;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Entity]
#[\Doctrine\ORM\Mapping\Table]
final class SomeOrderBy
{
    #[\Doctrine\ORM\Mapping\OneToMany(targetEntity: \App\SomeTargetEntity::class)]
    #[\Doctrine\ORM\Mapping\OrderBy(['id' => 'ASC'])]
    public $categoryEvents;
}

?>
