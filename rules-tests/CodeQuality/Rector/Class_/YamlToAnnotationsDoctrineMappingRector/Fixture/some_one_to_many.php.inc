<?php

namespace Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class SomeOneToMany
{
    private $singleItem;
}

?>
-----
<?php

namespace Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class SomeOneToMany
{
    /**
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="App\Entity\Item", mappedBy="itemIds", cascade=persist, orderBy=ASC)
     */
    private $singleItem;
}

?>
