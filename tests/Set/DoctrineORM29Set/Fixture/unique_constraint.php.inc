<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @UniqueConstraint(name="ean", columns={"ean"})
 */
class ECommerceProduct
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\UniqueConstraint;

#[\Doctrine\ORM\Mapping\UniqueConstraint(name: 'ean', columns: ['ean'])]
class ECommerceProduct
{
}

?>
