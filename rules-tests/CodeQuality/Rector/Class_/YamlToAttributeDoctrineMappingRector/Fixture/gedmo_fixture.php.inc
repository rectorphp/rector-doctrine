<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class TimestampableGedmo
{
    private $created;

    private $updated;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Table]
final class TimestampableGedmo
{
    #[\Doctrine\ORM\Mapping\Column]
    #[\Gedmo\Mapping\Annotation\Timestampable(on: 'create')]
    private $created;

    #[\Doctrine\ORM\Mapping\Column]
    #[\Gedmo\Mapping\Annotation\Timestampable(on: 'update', field: ['another_field', 'next_field'])]
    private $updated;
}

?>
