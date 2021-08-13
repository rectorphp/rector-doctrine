<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineODM23Set\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document()
 * @MongoDB\Index(name="search_idx", keys={"name", "c"})
 */
class ECommerceProduct
{
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineODM23Set\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[\Doctrine\ODM\MongoDB\Mapping\Annotations\Document]
#[\Doctrine\ODM\MongoDB\Mapping\Annotations\Index(name: 'search_idx', keys: ['name', 'c'])]
class ECommerceProduct
{
}

?>
