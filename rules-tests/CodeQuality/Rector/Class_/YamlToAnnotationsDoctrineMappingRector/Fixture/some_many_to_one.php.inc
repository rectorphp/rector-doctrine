<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class SomeManyToOne
{
    private $sharedItems;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

/**
 * @\Doctrine\ORM\Mapping\Table
 */
final class SomeManyToOne
{
    /**
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="App\Entity\Item", nullable=false, inversedBy="itemIds")
     */
    private $sharedItems;
}

?>
