<?php

namespace Rector\Doctrine\Tests\Rector\Class_\MoveCurrentDateTimeDefaultInEntityToConstructorRector\Fixture;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $when = null;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\Class_\MoveCurrentDateTimeDefaultInEntityToConstructorRector\Fixture;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $when;
}

?>
