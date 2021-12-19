<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\FixturePhp81;

use Doctrine\ORM\Mapping as ORM;

final class DecoupleJoinColumns
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

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\FixturePhp81;

use Doctrine\ORM\Mapping as ORM;

final class DecoupleJoinColumns
{
    #[ORM\JoinColumn(name: 'entity_id', referencedColumnName: 'id')]
    #[ORM\JoinColumn(name: 'entity_type', referencedColumnName: 'entity_type')]
    protected $page;
}

?>
