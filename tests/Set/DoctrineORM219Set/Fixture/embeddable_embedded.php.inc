<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM219Set\Fixture;

use Doctrine\ORM\Mapping\Embeddable;
use Doctrine\ORM\Mapping\Embedded;

/**
 * @Embeddable
 */
class Address
{
}

class User
{
    /**
     * @Embedded(class="Address")
     */
    private $address;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM219Set\Fixture;

use Doctrine\ORM\Mapping\Embeddable;
use Doctrine\ORM\Mapping\Embedded;

#[Embeddable]
class Address
{
}

class User
{
    #[Embedded(class: \Address::class)]
    private $address;
}

?>
