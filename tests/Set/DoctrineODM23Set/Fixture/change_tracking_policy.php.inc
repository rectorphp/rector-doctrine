<?php

namespace Rector\Doctrine\Tests\Set\DoctrineODM23Set\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 * @MongoDB\ChangeTrackingPolicy("DEFERRED_IMPLICIT")
 */
class User
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineODM23Set\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[\Doctrine\ODM\MongoDB\Mapping\Annotations\Document]
#[\Doctrine\ODM\MongoDB\Mapping\Annotations\ChangeTrackingPolicy(value: 'DEFERRED_IMPLICIT')]
class User
{
}

?>
