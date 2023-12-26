<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

final class UniqueConstraints
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\Fixture;

/**
 * @\Doctrine\ORM\Mapping\Table(uniqueConstraints={@\Doctrine\ORM\Mapping\UniqueConstraint(name="key_name", columns={"key_id", "next_key_id"})})
 */
final class UniqueConstraints
{
}

?>
