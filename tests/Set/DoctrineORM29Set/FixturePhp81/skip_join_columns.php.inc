<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\FixturePhp81;

use Doctrine\ORM\Mapping as ORM;

// there are not attributes yet https://github.com/doctrine/orm/blob/9a74ae6280714aa4fe30960bce9c715535939fd3/lib/Doctrine/ORM/Mapping/JoinColumns.php#L11
class SkipJoinColumns
{
    /**
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entity_id", referencedColumnName="id"),
     *   @ORM\JoinColumn(name="entity_type", referencedColumnName="entity_type"),
     * })
     **/
    protected $page;
}
