<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Version;

class ECommerceProduct
{
    /**
     * @Column(type="integer")
     * @Version
     */
    protected $version;
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Version;

class ECommerceProduct
{
    #[\Doctrine\ORM\Mapping\Column(type: 'integer')]
    #[\Doctrine\ORM\Mapping\Version]
    protected $version;
}

?>
