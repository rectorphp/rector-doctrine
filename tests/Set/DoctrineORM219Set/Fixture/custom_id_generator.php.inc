<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM219Set\Fixture;

use Doctrine\ORM\Mapping\CustomIdGenerator;

class User
{
    /**
     * @CustomIdGenerator(class="MyIdGenerator")
     */
    private $id;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM219Set\Fixture;

use Doctrine\ORM\Mapping\CustomIdGenerator;

class User
{
    #[CustomIdGenerator(class: \MyIdGenerator::class)]
    private $id;
}

?>
