<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @Entity(uniqueConstraints={@UniqueConstraint(name="ean", columns={"ean"})})
 */
class ECommerceProduct
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\UniqueConstraint;

#[\Doctrine\ORM\Mapping\Entity]
#[\Doctrine\ORM\Mapping\UniqueConstraint(name: 'ean', columns: ['ean'])]
class ECommerceProduct
{
}

?>
