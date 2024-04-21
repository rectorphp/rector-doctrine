<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class ManyToOneJoinColumn
{
    public $anotherObject;

    public $simpleObject;

    public $objectWithSingleJoinColumnNotation;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Table]
final class ManyToOneJoinColumn
{
    #[\Doctrine\ORM\Mapping\ManyToOne(targetEntity: \App\SomeTargetEntity::class)]
    #[\Doctrine\ORM\Mapping\JoinColumn(name: 'only_column_name', referencedColumnName: 'some_id')]
    public $anotherObject;

    #[\Doctrine\ORM\Mapping\ManyToOne(targetEntity: \App\SomeTargetEntity::class)]
    #[\Doctrine\ORM\Mapping\JoinColumn(name: 'first_column_name', referencedColumnName: 'some_id')]
    #[\Doctrine\ORM\Mapping\JoinColumn(name: 'second_column_name', referencedColumnName: 'some_id')]
    public $simpleObject;

    #[\Doctrine\ORM\Mapping\ManyToOne(targetEntity: \App\SomeTargetEntity::class)]
    #[\Doctrine\ORM\Mapping\JoinColumn(name: 'single_column_notation', referencedColumnName: 'some_id')]
    public $objectWithSingleJoinColumnNotation;
}

?>
