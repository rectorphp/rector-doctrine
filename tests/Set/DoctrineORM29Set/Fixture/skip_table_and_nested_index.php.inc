<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * @ORM\Table(indexes={@Index(name="search_idx", columns={"name", "c"})}]
 */
class SkipTableAndNestedIndex
{
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

#[ORM\Table]
#[Index(name: 'search_idx', columns: ['name', 'c'])]
class SkipTableAndNestedIndex
{
}

?>
