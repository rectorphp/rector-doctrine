<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class SoftdeletableGedmo
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

/**
 * @\Gedmo\Mapping\Annotation\SoftDeleteable(fieldName="deleted")
 * @\Doctrine\ORM\Mapping\Table
 */
final class SoftdeletableGedmo
{
}

?>
