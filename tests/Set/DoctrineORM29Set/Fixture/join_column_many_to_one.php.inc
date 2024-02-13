<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @Table(name="users")
 * @Entity
 */
class User
{
    /**
     * @ManyToOne(targetEntity="HelloWorld\UserGroup", inversedBy="users")
     * @JoinColumn(name="group_id", referencedColumnName="id")
     */
    protected $group;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

#[Table(name: 'users')]
#[Entity]
class User
{
    #[JoinColumn(name: 'group_id', referencedColumnName: 'id')]
    #[ManyToOne(targetEntity: 'HelloWorld\UserGroup', inversedBy: 'users')]
    protected $group;
}

?>
