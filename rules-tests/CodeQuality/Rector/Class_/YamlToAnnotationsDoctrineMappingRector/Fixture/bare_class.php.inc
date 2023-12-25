<?php

namespace Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class BareClass
{
}

?>
-----
<?php

namespace Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\Fixture;

/**
 * @\Doctrine\ORM\Mapping\Table(table="transaction")
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="App\Repository\SomeRepository")
 */
final class BareClass
{
}

?>
