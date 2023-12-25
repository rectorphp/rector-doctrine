<?php

namespace Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class GedmoFixture
{
    private $created;
}

?>
-----
<?php

namespace Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\Fixture;

/**
 * @\Gedmo\Mapping\Annotation\SoftDeleteable(fieldName="deleted")
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
