<?php

namespace Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class SomeManyToOne
{
    private $sharedItems;
}

?>
-----
<?php

namespace Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class SomeManyToOne
{
    /**
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="App\Entity\Item", nullable=false, inversedBy="itemIds")
     */
    private $sharedItems;
}

?>
