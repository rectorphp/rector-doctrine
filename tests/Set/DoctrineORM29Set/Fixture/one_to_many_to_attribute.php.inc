<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\OneToMany;

class OneToManyToAttribute
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

class OneToManyToAttribute
{
    #[OneToMany(targetEntity: 'Feature', mappedBy: 'product')]
    private $features;
}

?>
