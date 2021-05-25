<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\OneToMany;

class Product
{
    /**
     * @OneToMany(targetEntity="Feature", mappedBy="product")
     */
    private $features;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\OneToMany;

class Product
{
    #[\Doctrine\ORM\Mapping\OneToMany(targetEntity: 'Feature', mappedBy: 'product')]
    private $features;
}

?>
