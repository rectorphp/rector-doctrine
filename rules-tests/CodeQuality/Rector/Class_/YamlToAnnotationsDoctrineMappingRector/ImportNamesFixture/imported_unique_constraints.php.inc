<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\ImportNamesFixture;

final class ImprotedUniqueConstraints
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\ImportNamesFixture;

use Doctrine\ORM\Mapping\Table;
/**
 * @Table(name="some_table", uniqueConstraints={@\Doctrine\ORM\Mapping\UniqueConstraint(name="key_name",columns={"key_id", "next_key_id"})})
 */
final class ImprotedUniqueConstraints
{
}

?>
