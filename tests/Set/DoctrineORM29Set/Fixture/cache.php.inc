<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * An Entity
 *
 * @ORM\Table(name="entity")
 * @ORM\Cache(usage="READ_ONLY", region="entity_cache")
 */
class AnEntity
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * An Entity
 */
#[\Doctrine\ORM\Mapping\Table(name: 'entity')]
#[\Doctrine\ORM\Mapping\Cache(usage: 'READ_ONLY', region: 'entity_cache')]
class AnEntity
{
}

?>
