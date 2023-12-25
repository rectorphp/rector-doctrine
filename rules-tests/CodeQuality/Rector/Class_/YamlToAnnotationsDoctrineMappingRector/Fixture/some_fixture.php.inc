<?php

namespace Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class SomeEntity
{
    private $someProperty;
}

?>
-----
<?php

namespace Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class SomeEntity
{
    /**
     * @\Doctrine\ORM\Mapping\Column(type="string", length=6, nullable=true)
     */
    private $someProperty;
}

?>
