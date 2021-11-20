<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\FixturePhp81;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * @ORM\Table(indexes={@Index(name="search_idx", columns={"name", "c"})}]
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

#[\Doctrine\ORM\Mapping\Table(indexes: [new \Doctrine\ORM\Mapping\Index(name: 'search_idx', columns: ['name', 'c'])])]
class TableAndNestedIndex
{
}

?>
