<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM219Set\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ChangeTrackingPolicy;

/**
 * @Entity
 * @ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class User
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM219Set\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ChangeTrackingPolicy;

#[Entity]
#[ChangeTrackingPolicy('DEFERRED_IMPLICIT')]
class User
{
}

?>
