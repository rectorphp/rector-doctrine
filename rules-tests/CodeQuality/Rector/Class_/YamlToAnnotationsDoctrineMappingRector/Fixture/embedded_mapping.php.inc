<?php

namespace Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class EmbeddedMapping
{
    private $inner;
}

?>
-----
<?php

namespace Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class EmbeddedMapping
{
    /**
     * @\Doctrine\ORM\Mapping\Embedded(class="App\Currency", columnPrefix="currency_")
     */
    private $inner;
}

?>
