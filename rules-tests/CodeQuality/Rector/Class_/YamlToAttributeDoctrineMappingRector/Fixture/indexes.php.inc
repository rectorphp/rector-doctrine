<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class Indexes
{
    private $id;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Table]
#[\Doctrine\ORM\Mapping\Index(name: 'IDX_WHAT_EVER', columns: ['some', 'column'])]
final class Indexes
{
    private $id;
}

?>
