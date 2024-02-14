<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

final class SoftdeletableGedmo
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Gedmo\Mapping\Annotation\SoftDeleteable(fieldName: 'deleted', timeAware: false, someNumber: 100)]
#[\Doctrine\ORM\Mapping\Table]
final class SoftdeletableGedmo
{
}

?>
