<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping as ORM;

class Entity
{
    /**
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entity_id", referencedColumnName="id"),
     *   @ORM\JoinColumn(name="entity_type", referencedColumnName="entity_type"),
     * })
     **/
    protected $page;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping as ORM;

class Entity
{
    #[\Doctrine\ORM\Mapping\JoinColumns(['(name="entity_id", referencedColumnName="id")', '(name="entity_type", referencedColumnName="entity_type")', '}'])]
    protected $page;
}

?>
