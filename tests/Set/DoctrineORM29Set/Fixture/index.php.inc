<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Index;

/**
 * @Entity(indexes={@Index(name="search_idx", columns={"name", "c"})}]
 */
class ECommerceProduct
{
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Index;

#[\Doctrine\ORM\Mapping\Entity]
#[\Doctrine\ORM\Mapping\Index(name: 'search_idx', columns: ['name', 'c'])]
class ECommerceProduct
{
}

?>
