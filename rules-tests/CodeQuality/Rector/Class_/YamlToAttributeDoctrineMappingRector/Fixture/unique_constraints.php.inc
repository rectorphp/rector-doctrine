<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class UniqueConstraints
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Table]
#[\Doctrine\ORM\Mapping\UniqueConstraint(name: 'key_name', columns: ['key_id', 'next_key_id'])]
final class UniqueConstraints
{
}

?>
