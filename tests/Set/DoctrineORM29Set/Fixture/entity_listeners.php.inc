<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\EntityListeners;

/**
 * @Entity
 * @EntityListeners({"App\MyListener"})
 */
class User
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\EntityListeners;

#[\Doctrine\ORM\Mapping\Entity]
#[\Doctrine\ORM\Mapping\EntityListeners(['App\MyListener'])]
class User
{
}

?>
