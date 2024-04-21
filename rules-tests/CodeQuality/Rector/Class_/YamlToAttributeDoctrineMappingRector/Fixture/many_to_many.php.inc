<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class ManyToMany
{
    public $myObjects;

    public $theirObjects;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Table]
final class ManyToMany
{
    #[\Doctrine\ORM\Mapping\ManyToMany(targetEntity: \App\SomeTargetEntity::class, inversedBy: 'theirObjects')]
    #[\Doctrine\ORM\Mapping\JoinTable(name: 'owned_objects')]
    #[\Doctrine\ORM\Mapping\JoinColumn(name: 'owner_id', referencedColumnName: 'some_id', onDelete: 'cascade')]
    #[\Doctrine\ORM\Mapping\InverseJoinColumn(name: 'object_id', referencedColumnName: 'some_id', onDelete: 'cascade')]
    public $myObjects;

    #[\Doctrine\ORM\Mapping\ManyToMany(targetEntity: \App\SomeTargetEntity::class, mappedBy: 'myObjects')]
    public $theirObjects;
}

?>
