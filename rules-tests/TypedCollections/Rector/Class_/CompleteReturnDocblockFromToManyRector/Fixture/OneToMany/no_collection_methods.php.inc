<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Trainer
{
    /**
     * @ORM\Column(type="integer")
     */
    private int $id = 1;

    public function getId(): int
    {
        return $this->id;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Fixture\OneToMany;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Trainer
{
    /**
     * @ORM\Column(type="integer")
     */
    private int $id = 1;

    public function getId(): int
    {
        return $this->id;
    }
}

?>
