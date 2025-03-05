<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM219Set\Fixture;

use Doctrine\ORM\Mapping as ORM;

class UnwrapJoinColumns
{
    /**
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entity_id", referencedColumnName="id"),
     *   @ORM\JoinColumn(name="entity_type", referencedColumnName="entity_type"),
     * })
     */
    protected $page;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM219Set\Fixture;

use Doctrine\ORM\Mapping as ORM;

class UnwrapJoinColumns
{
    #[ORM\JoinColumn(name: 'entity_id', referencedColumnName: 'id')]
    #[ORM\JoinColumn(name: 'entity_type', referencedColumnName: 'entity_type')]
    protected $page;
}

?>
