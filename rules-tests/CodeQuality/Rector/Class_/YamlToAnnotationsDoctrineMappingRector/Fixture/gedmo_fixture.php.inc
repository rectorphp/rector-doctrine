<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class GedmoFixture
{
    private $created;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

/**
 * @\Gedmo\Mapping\Annotation\SoftDeleteable(fieldName="deleted")
 * @\Doctrine\ORM\Mapping\Table
 */
final class GedmoFixture
{
    /**
     * @\Doctrine\ORM\Mapping\Column
     * @\Gedmo\Mapping\Annotation\Timestampable(on="create")
     */
    private $created;
}

?>
