<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class ManyToOneJoinColumn
{
    public $anotherObject;
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
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="App\SomeTargetEntity", inversedBy="inverstedProperty")
     * @\Doctrine\ORM\Mapping\JoinColumns(@\Doctrine\ORM\Mapping\JoinColumn(name="join_column_name", referencedColumnName="some_id"))
     */
    public $anotherObject;
}

?>
