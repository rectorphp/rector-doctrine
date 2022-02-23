<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\FixturePhp81;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * @ORM\Table(indexes={@Index(name="search_idx", columns={"name", "c"})}, uniqueConstraints={@ORM\UniqueConstraint(name="name_idx", columns={"name"})}]
 */
class TableAndNestedIndex
{
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\FixturePhp81;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

#[ORM\Table(indexes: [new Index(name: 'search_idx', columns: ['name', 'c'])], uniqueConstraints: [new ORM\UniqueConstraint(name: 'name_idx', columns: ['name'])])]
class TableAndNestedIndex
{
}

?>
