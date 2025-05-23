<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM219Set\Fixture;

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

namespace Rector\Doctrine\Tests\Set\DoctrineORM219Set\Fixture;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Version;

class ECommerceProduct
{
    #[Column(type: 'integer')]
    #[Version]
    protected $version;
}

?>
