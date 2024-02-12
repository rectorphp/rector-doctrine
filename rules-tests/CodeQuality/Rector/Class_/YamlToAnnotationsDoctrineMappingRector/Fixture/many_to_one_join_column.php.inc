<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class ManyToOneJoinColumn
{
    public $anotherObject;

    public $simpleObject;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

/**
 * @\Doctrine\ORM\Mapping\Table
 */
final class ManyToOneJoinColumn
{
    /**
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="App\SomeTargetEntity")
     * @\Doctrine\ORM\Mapping\JoinColumn(name="only_column_name", referencedColumnName="some_id")
     */
    public $anotherObject;

    /**
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="App\SomeTargetEntity")
     * @\Doctrine\ORM\Mapping\JoinColumns(@\Doctrine\ORM\Mapping\JoinColumn(name="first_column_name", referencedColumnName="some_id"), @\Doctrine\ORM\Mapping\JoinColumn(name="second_column_name", referencedColumnName="some_id"))
     */
    public $simpleObject;
}

?>
