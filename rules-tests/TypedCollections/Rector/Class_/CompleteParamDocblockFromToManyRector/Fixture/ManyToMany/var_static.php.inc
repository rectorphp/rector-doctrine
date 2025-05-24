<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\ManyToMany;

use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training;

/**
 * @ORM\Entity
 */
class VarStatic
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, mappedBy="trainer")
     * @var Collection|Training[]
     */
    private $trainings = [];

    /**
     * @var string
     */
    private static $value = '';

    public static function getValue()
    {
        return self::$value;
    }

    public static function setValue(string $value)
    {
        self::$value = $value;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\ManyToMany;

/**
 * @ORM\Entity
 */
class VarStatic
{
    /**
     * @ORM\ManyToMany(targetEntity=Training::class, mappedBy="trainer")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training>
     */
    private $trainings = [];

    /**
     * @var string
     */
    private static $value = '';

    public static function getValue()
    {
        return self::$value;
    }

    public static function setValue(string $value)
    {
        self::$value = $value;
    }
}

?>
