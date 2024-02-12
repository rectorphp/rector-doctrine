<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class SomeOrderBy
{
    public $categoryEvents;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

/**
 * @\Doctrine\ORM\Mapping\Entity
 * @\Doctrine\ORM\Mapping\Table
 */
final class SomeOrderBy
{
    /**
     * @\Doctrine\ORM\Mapping\OneToMany(targetEntity="App\SomeTargetEntity")
     * @\Doctrine\ORM\Mapping\OrderBy({"id"="ASC"})
     */
    public $categoryEvents;
}

?>
